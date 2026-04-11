<?php
// UTF-8 output
header('Content-Type: text/html; charset=utf-8');

// Flash poruke + PRG
if (session_status() === PHP_SESSION_NONE) {
    $sp = ini_get('session.save_path');
    if ($sp && !is_dir($sp)) { session_save_path(sys_get_temp_dir()); }
    session_start();

// -----------------------------
// Anti-bot: Honeypot + Rate limit
// -----------------------------
function antibot_check($action) {
    $hp = $_POST['website'] ?? '';
    if (!empty($hp)) return 'Neispravan zahtev.';

    $ts = isset($_POST['form_ts']) ? (int)$_POST['form_ts'] : 0;
    if ($ts <= 0) return 'Neispravan zahtev.';
    if ((time() - $ts) < 3) return 'Molimo pokušajte ponovo.';

    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $key = hash('sha256', $ip . '|' . $action);
    $file = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'nl_rl_' . $key . '.json';

    $window_seconds = 10 * 60;
    $limit = 5;
    if ($action === 'unsubscribe_request') $limit = 4;
    if ($action === 'delete_request') $limit = 3;

    $now = time();
    $events = [];

    if (file_exists($file)) {
        $raw = @file_get_contents($file);
        $decoded = json_decode($raw, true);
        if (is_array($decoded)) $events = $decoded;
    }

    $events = array_values(array_filter($events, function($t) use ($now, $window_seconds) {
        return is_int($t) && ($t >= ($now - $window_seconds));
    }));

    if (count($events) >= $limit) {
        return 'Previše zahteva u kratkom vremenu. Pokušajte ponovo za nekoliko minuta.';
    }

    $events[] = $now;
    @file_put_contents($file, json_encode($events), LOCK_EX);

    return null;
}

function antibot_fail($msg_target, $message) {
    $_SESSION['error_msg'] = $message;
    $_SESSION['msg_target'] = $msg_target;
    $anchor = ($msg_target === 'unsubscribe') ? 'unsubscribe-form' : (($msg_target === 'delete') ? 'delete-form' : 'newsletter-form');
    header('Location: kontakt.php#' . $anchor);
    exit;
}
}

// -----------------------------
// DB config — prilagoditi putanju za novi hosting
// -----------------------------
define('DB_CONFIG_PATH', __DIR__ . '/../secure/db_config.php');

function get_db_config() {
    if (!file_exists(DB_CONFIG_PATH)) {
        error_log('DB config file not found: ' . DB_CONFIG_PATH);
        return null;
    }
    $cfg = require DB_CONFIG_PATH;
    if (!is_array($cfg)) {
        error_log('DB config invalid (not array): ' . DB_CONFIG_PATH);
        return null;
    }
    foreach (['host','name','user','pass'] as $k) {
        if (!array_key_exists($k, $cfg) || $cfg[$k] === '') {
            error_log('DB config missing/empty key: ' . $k);
            return null;
        }
    }
    if (!isset($cfg['charset']) || $cfg['charset'] === '') {
        $cfg['charset'] = 'utf8mb4';
    }
    return $cfg;
}

$success_msg = $_SESSION['success_msg'] ?? '';
$error_msg   = $_SESSION['error_msg'] ?? '';
$msg_target  = $_SESSION['msg_target'] ?? 'subscribe';
unset($_SESSION['msg_target']);
$scroll_target_id = ($msg_target === 'unsubscribe') ? 'unsubscribe-form' : (($msg_target === 'delete') ? 'delete-form' : 'newsletter-form');
$scroll_to_form = (!empty($success_msg) || !empty($error_msg));
unset($_SESSION['success_msg'], $_SESSION['error_msg']);

// Sticky vrednosti forme
$form = $_SESSION['form'] ?? [];
unset($_SESSION['form']);
$ime      = $form['ime'] ?? '';
$prezime  = $form['prezime'] ?? '';
$email    = $form['email'] ?? '';
$datum    = $form['datum_rodjenja'] ?? '';
$newsletter = (int)($form['newsletter'] ?? 0);

$unsub_form  = $_SESSION['unsub_form'] ?? [];
$del_form    = $_SESSION['del_form'] ?? [];
unset($_SESSION['unsub_form'], $_SESSION['del_form']);
$unsub_email = $unsub_form['email'] ?? '';
$del_email   = $del_form['email'] ?? '';

// -----------------------------
// Helper funkcije
// -----------------------------
function h($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }

function current_base_url() {
    $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    $scheme = $https ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $script = $_SERVER['SCRIPT_NAME'] ?? '/kontakt.php';
    $dir = rtrim(str_replace('\\', '/', dirname($script)), '/');
    return $scheme . '://' . $host . ($dir ? $dir : '');
}

function send_mail_html($to, $subject, $htmlBody) {
    $cfg = get_db_config();
    if (!$cfg) { error_log('send_mail_html: missing db_config'); return false; }

    $smtpPass = (string)($cfg['mailpass'] ?? '');
    if ($smtpPass === '') { error_log('send_mail_html: missing mailpass in db_config.php'); return false; }

    $paths = [__DIR__ . '/phpmailer/src/', __DIR__ . '/../phpmailer/src/'];
    $found = false;
    foreach ($paths as $base) {
        if (file_exists($base . 'PHPMailer.php') && file_exists($base . 'SMTP.php') && file_exists($base . 'Exception.php')) {
            require_once $base . 'Exception.php';
            require_once $base . 'PHPMailer.php';
            require_once $base . 'SMTP.php';
            $found = true;
            break;
        }
    }
    if (!$found) { error_log('send_mail_html: PHPMailer src not found'); return false; }

    $safeSubject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
    $template = '<!doctype html><html lang="sr"><head><meta charset="utf-8"><title>' . $safeSubject . '</title></head>
<body style="margin:0;padding:0;background:#f4f4f6;">
  <div style="max-width:640px;margin:0 auto;padding:24px;">
    <div style="background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 8px 24px rgba(0,0,0,.08);">
      <div style="background:#111827;color:#fff;padding:16px 20px;font-family:Arial,sans-serif;">
        <div style="font-size:16px;font-weight:700;">Inner Dynamic Method</div>
        <div style="font-size:13px;opacity:.9;margin-top:2px;">Newsletter</div>
      </div>
      <div style="padding:18px 20px;font-family:Arial,sans-serif;color:#111827;font-size:14px;line-height:1.45;">' . $htmlBody . '</div>
      <div style="padding:12px 20px;font-family:Arial,sans-serif;color:#6b7280;font-size:12px;border-top:1px solid #e5e7eb;">
        Ova poruka je poslata sa innerdynamicmethod.rs
      </div>
    </div>
  </div>
</body></html>';

    $SMTP_HOST = '';       // TODO: popuniti za novi hosting
    $SMTP_PORT = 465;
    $SMTP_USER = '';       // TODO: popuniti za novi hosting
    $SMTP_FROM_NAME = 'Inner Dynamic Method';

    try {
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = $SMTP_HOST;
        $mail->Port       = $SMTP_PORT;
        $mail->SMTPAuth   = true;
        $mail->Username   = $SMTP_USER;
        $mail->Password   = $smtpPass;
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
        $mail->CharSet    = 'UTF-8';
        $mail->Encoding   = 'base64';
        $mail->setFrom($SMTP_USER, $SMTP_FROM_NAME);
        $mail->addReplyTo($SMTP_USER, $SMTP_FROM_NAME);
        $mail->addAddress($to);
        $mail->Subject = 'Inner Dynamic Method - Newsletter - ' . $subject;
        $mail->isHTML(true);
        $mail->Body    = $template;
        $mail->AltBody = trim(preg_replace('/\s+/', ' ', strip_tags($htmlBody)));
        return $mail->send();
    } catch (Throwable $e) {
        error_log('send_mail_html PHPMailer error: ' . $e->getMessage());
        return false;
    }
}

function make_token() { return bin2hex(random_bytes(32)); }

function ensure_actions_table($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS newsletter_actions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(150) NOT NULL,
        action ENUM('unsubscribe','delete') NOT NULL,
        token VARCHAR(128) NOT NULL,
        expires_at DATETIME NOT NULL,
        used_at DATETIME NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UNIQUE KEY uniq_token (token),
        INDEX idx_email (email)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    @$conn->query($sql);
}

// -----------------------------
// Potvrda akcije iz email-a (GET)
// -----------------------------
if (isset($_GET['confirm'], $_GET['type'], $_GET['token'])) {
    $type  = trim($_GET['type']);
    $token = trim($_GET['token']);

    $db = get_db_config();
    if (!$db) {
        $_SESSION['error_msg'] = 'Greška pri povezivanju sa bazom.';
        header('Location: kontakt.php#newsletter-form');
        exit;
    }
    mysqli_report(MYSQLI_REPORT_OFF);
    $conn = new mysqli($db['host'], $db['user'], $db['pass'], $db['name']);
    if ($conn->connect_error) {
        error_log('DB connect error (confirm): ' . $conn->connect_error);
        $_SESSION['error_msg'] = 'Greška pri povezivanju sa bazom.';
        header('Location: kontakt.php#newsletter-form');
        exit;
    }
    $conn->set_charset($db['charset'] ?? 'utf8mb4');
    ensure_actions_table($conn);

    $stmt = $conn->prepare("SELECT email, action, expires_at, used_at FROM newsletter_actions WHERE token=? LIMIT 1");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res ? $res->fetch_assoc() : null;
    $stmt->close();

    if (!$row) { $_SESSION['error_msg'] = 'Nevažeći ili istekao link.'; header('Location: kontakt.php#newsletter-form'); exit; }
    if (!empty($row['used_at'])) { $_SESSION['error_msg'] = 'Ovaj link je već iskorišćen.'; header('Location: kontakt.php#newsletter-form'); exit; }
    if (strtotime($row['expires_at']) < time()) { $_SESSION['error_msg'] = 'Link je istekao.'; header('Location: kontakt.php#newsletter-form'); exit; }
    if ($row['action'] !== $type) { $_SESSION['error_msg'] = 'Neispravan tip akcije.'; header('Location: kontakt.php#newsletter-form'); exit; }

    $email_c = $row['email'];
    if ($type === 'unsubscribe') {
        $u = $conn->prepare("UPDATE kontakti SET newsletter=0 WHERE email=?");
        if ($u) { $u->bind_param("s", $email_c); $u->execute(); $u->close(); }
        $_SESSION['success_msg'] = 'Uspešno ste odjavljeni sa newsletter-a.';
        $anchor = '#unsubscribe-form';
    } elseif ($type === 'delete') {
        $d = $conn->prepare("DELETE FROM kontakti WHERE email=?");
        if ($d) { $d->bind_param("s", $email_c); $d->execute(); $d->close(); }
        $_SESSION['success_msg'] = 'Vaši podaci su obrisani iz baze.';
        $anchor = '#delete-form';
    } else {
        $_SESSION['error_msg'] = 'Nepoznata akcija.';
        $anchor = '#newsletter-form';
    }

    $m = $conn->prepare("UPDATE newsletter_actions SET used_at=NOW() WHERE token=?");
    if ($m) { $m->bind_param("s", $token); $m->execute(); $m->close(); }
    $conn->close();
    header('Location: kontakt.php' . $anchor);
    exit;
}

// -----------------------------
// POST obrada
// -----------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = trim($_POST['action'] ?? 'subscribe');

    // A) PRIJAVA
    if ($action === 'subscribe') {
        $ime     = trim($_POST['ime'] ?? '');
        $prezime = trim($_POST['prezime'] ?? '');
        $email   = trim($_POST['email'] ?? '');
        $datum   = trim($_POST['datum_rodjenja'] ?? '');
        $newsletter = isset($_POST['newsletter']) ? 1 : 0;

        if ($ime === '' || $prezime === '' || $email === '') {
            $_SESSION['error_msg'] = 'Molimo popunite obavezna polja: ime, prezime i email.';
            $_SESSION['form'] = compact('ime','prezime','email','datum','newsletter');
            header('Location: kontakt.php#newsletter-form'); exit;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_msg'] = 'Uneta je neispravna email adresa.';
            $_SESSION['form'] = compact('ime','prezime','email','datum','newsletter');
            header('Location: kontakt.php#newsletter-form'); exit;
        }

        $db = get_db_config();
        if (!$db) {
            $_SESSION['error_msg'] = 'Greška pri povezivanju sa bazom.';
            header('Location: kontakt.php#newsletter-form'); exit;
        }
        mysqli_report(MYSQLI_REPORT_OFF);
        $conn = new mysqli($db['host'], $db['user'], $db['pass'], $db['name']);
        if ($conn->connect_error) {
            $_SESSION['error_msg'] = 'Greška pri povezivanju sa bazom.';
            $_SESSION['form'] = compact('ime','prezime','email','datum','newsletter');
            header('Location: kontakt.php#newsletter-form'); exit;
        }
        $conn->set_charset($db['charset'] ?? 'utf8mb4');

        $check = $conn->prepare("SELECT id FROM kontakti WHERE email=? LIMIT 1");
        $check->bind_param("s", $email);
        $check->execute();
        $exists = $check->get_result()->fetch_assoc();
        $check->close();

        if ($exists) {
            $_SESSION['error_msg'] = 'Vaši podaci su već uneti u bazu (ova email adresa je već prijavljena).';
            $_SESSION['msg_target'] = 'subscribe';
            header('Location: kontakt.php#newsletter-form'); exit;
        }

        $stmt = $conn->prepare("INSERT INTO kontakti (ime, prezime, email, datum_rodjenja, newsletter) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $ime, $prezime, $email, $datum, $newsletter);
        if ($stmt->execute()) {
            $_SESSION['success_msg'] = 'Uspešno ste poslali prijavu.';
        } else {
            $_SESSION['error_msg'] = ($stmt->errno === 1062)
                ? 'Vaši podaci su već uneti u bazu.'
                : 'Došlo je do greške pri upisu.';
            $_SESSION['form'] = compact('ime','prezime','email','datum','newsletter');
        }
        $stmt->close(); $conn->close();
        header('Location: kontakt.php#newsletter-form'); exit;
    }

    // B) ODJAVA
    if ($action === 'unsubscribe_request') {
        $u_email = trim($_POST['unsub_email'] ?? '');
        if ($u_email === '' || !filter_var($u_email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_msg'] = 'Unesite ispravnu email adresu za odjavu.';
            $_SESSION['unsub_form'] = ['email'=>$u_email];
            header('Location: kontakt.php#unsubscribe-form'); exit;
        }

        $db = get_db_config();
        if (!$db) { $_SESSION['error_msg'] = 'Greška pri povezivanju sa bazom.'; header('Location: kontakt.php#unsubscribe-form'); exit; }
        mysqli_report(MYSQLI_REPORT_OFF);
        $conn = new mysqli($db['host'], $db['user'], $db['pass'], $db['name']);
        if ($conn->connect_error) {
            $_SESSION['error_msg'] = 'Greška pri povezivanju sa bazom.';
            $_SESSION['unsub_form'] = ['email'=>$u_email];
            header('Location: kontakt.php#unsubscribe-form'); exit;
        }
        $conn->set_charset($db['charset'] ?? 'utf8mb4');
        ensure_actions_table($conn);

        $chk = $conn->prepare("SELECT id FROM kontakti WHERE email=? LIMIT 1");
        $chk->bind_param("s", $u_email); $chk->execute();
        $exists = $chk->get_result()->fetch_assoc(); $chk->close();
        if (!$exists) {
            $_SESSION['error_msg'] = 'Ova email adresa nije pronađena u bazi.';
            $_SESSION['unsub_form'] = ['email'=>$u_email];
            header('Location: kontakt.php#unsubscribe-form'); exit;
        }

        $token = make_token();
        $ins = $conn->prepare("INSERT INTO newsletter_actions (email, action, token, expires_at) VALUES (?, 'unsubscribe', ?, DATE_ADD(NOW(), INTERVAL 24 HOUR))");
        $ins->bind_param("ss", $u_email, $token);
        if (!$ins->execute()) {
            $_SESSION['error_msg'] = 'Došlo je do greške pri obradi zahteva.';
            $_SESSION['unsub_form'] = ['email'=>$u_email];
            header('Location: kontakt.php#unsubscribe-form'); exit;
        }
        $ins->close();

        $link = current_base_url() . "/kontakt.php?confirm=1&type=unsubscribe&token=" . urlencode($token);
        $body = "<p>Zahtev za odjavu sa newsletter-a je primljen.</p>
                 <p>Ako želite da se odjavite, kliknite na sledeći link (važi 24h):</p>
                 <p><a href=\"" . h($link) . "\">Potvrdi odjavu</a></p>
                 <p>Ako niste vi poslali ovaj zahtev, ignorišite ovu poruku.</p>";
        if (!send_mail_html($u_email, "Potvrda odjave sa newsletter-a", $body)) {
            $_SESSION['error_msg'] = 'Nije moguće poslati email.';
            $_SESSION['unsub_form'] = ['email'=>$u_email];
            header('Location: kontakt.php#unsubscribe-form'); exit;
        }
        $conn->close();
        $_SESSION['success_msg'] = 'Poslat je email za potvrdu odjave. Proverite inbox/spam.';
        header('Location: kontakt.php#unsubscribe-form'); exit;
    }

    // C) BRISANJE PODATAKA
    if ($action === 'delete_request') {
        $d_email = trim($_POST['del_email'] ?? '');
        if ($d_email === '' || !filter_var($d_email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_msg'] = 'Unesite ispravnu email adresu za brisanje podataka.';
            $_SESSION['del_form'] = ['email'=>$d_email];
            header('Location: kontakt.php#delete-form'); exit;
        }

        $db = get_db_config();
        if (!$db) { $_SESSION['error_msg'] = 'Greška pri povezivanju sa bazom.'; header('Location: kontakt.php#delete-form'); exit; }
        mysqli_report(MYSQLI_REPORT_OFF);
        $conn = new mysqli($db['host'], $db['user'], $db['pass'], $db['name']);
        if ($conn->connect_error) {
            $_SESSION['error_msg'] = 'Greška pri povezivanju sa bazom.';
            $_SESSION['del_form'] = ['email'=>$d_email];
            header('Location: kontakt.php#delete-form'); exit;
        }
        $conn->set_charset($db['charset'] ?? 'utf8mb4');
        ensure_actions_table($conn);

        $chk = $conn->prepare("SELECT id FROM kontakti WHERE email=? LIMIT 1");
        $chk->bind_param("s", $d_email); $chk->execute();
        $exists = $chk->get_result()->fetch_assoc(); $chk->close();
        if (!$exists) {
            $_SESSION['error_msg'] = 'Ova email adresa nije pronađena u bazi.';
            $_SESSION['del_form'] = ['email'=>$d_email];
            header('Location: kontakt.php#delete-form'); exit;
        }

        $token = make_token();
        $ins = $conn->prepare("INSERT INTO newsletter_actions (email, action, token, expires_at) VALUES (?, 'delete', ?, DATE_ADD(NOW(), INTERVAL 24 HOUR))");
        $ins->bind_param("ss", $d_email, $token);
        if (!$ins->execute()) {
            $_SESSION['error_msg'] = 'Došlo je do greške pri obradi zahteva.';
            $_SESSION['del_form'] = ['email'=>$d_email];
            header('Location: kontakt.php#delete-form'); exit;
        }
        $ins->close();

        $link = current_base_url() . "/kontakt.php?confirm=1&type=delete&token=" . urlencode($token);
        $body = "<p>Zahtev za brisanje podataka je primljen.</p>
                 <p>Ako želite da obrišete svoje podatke, kliknite na sledeći link (važi 24h):</p>
                 <p><a href=\"" . h($link) . "\">Potvrdi brisanje</a></p>
                 <p><strong>Pažnja:</strong> Ova akcija nepovratno briše vaše podatke.</p>
                 <p>Ako niste vi poslali ovaj zahtev, ignorišite ovu poruku.</p>";
        if (!send_mail_html($d_email, "Potvrda brisanja podataka", $body)) {
            $_SESSION['error_msg'] = 'Nije moguće poslati email.';
            $_SESSION['del_form'] = ['email'=>$d_email];
            header('Location: kontakt.php#delete-form'); exit;
        }
        $conn->close();
        $_SESSION['success_msg'] = 'Poslat je email za potvrdu brisanja. Proverite inbox/spam.';
        header('Location: kontakt.php#delete-form'); exit;
    }

    $_SESSION['error_msg'] = 'Nepoznata akcija.';
    header('Location: kontakt.php#newsletter-form');
    exit;
}

// -----------------------------
// Prikaz stranice
// -----------------------------
$meta_description = 'Kontaktirajte Inner Dynamic Method i zakažite coaching, Wingwave® ili Points of You® sesiju. Dostupni smo putem telefona, emaila ili kontakt forme.';
$meta_keywords    = 'kontakt, zakazivanje sesije, coaching Beograd, Inner Dynamic Method kontakt';
$page_title       = 'Kontakt | Inner Dynamic Method';
$body_class       = 'contactus page body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive';
$current_page     = 'kontakt';
$page_hero_icon   = 'icon-icon_mail';
$page_hero_title  = 'Kontakt';
$page_hero_bg     = 'images/hero.webp';
$header_scheme    = 'scheme_original';
$header_position  = 'top_panel_position_above';
$extra_head_html = '<style>
.newsletter-block { padding:28px 22px; margin:28px auto; border:1px solid rgba(0,0,0,0.08); border-radius:8px; }
.newsletter-block--alt { background:rgba(0,0,0,0.02); }
.newsletter-divider { max-width:770px; margin:18px auto 0; border:0; border-top:1px solid rgba(0,0,0,0.10); }
.newsletter-subtitle { text-align:center; font-size:13px; opacity:.8; margin-top:6px; }
</style>';

$lang_en_url      = '/en/contact.php';
include 'includes/header.php';
?>
        <section class="top_panel_image"<?php if (!empty($page_hero_bg)) echo ' style="background-image:url(' . $page_hero_bg . ');"'; ?>>
            <div class="top_panel_image_hover"></div>
            <div class="top_panel_image_header">
                <div class="top_panel_image_icon <?php echo $page_hero_icon; ?>"></div>
                <h1 class="top_panel_image_title entry-title"><?php echo htmlspecialchars($page_hero_title); ?></h1>
            </div>
        </section>
        <div class="page_content_wrap page_paddings_yes">
            <div class="content_wrap">
                <div class="content">
                    <article class="post_item post_item_single page">
                        <section class="post_content">
                            <div class="sc_row row sc_row-fluid">
                                <div class="column sc_column_container sc_col-sm-12">
                                    <div class="sc_column-inner ">
                                        <div class="wrapper">
                                            <div class="sc_section sc_section_block cu_mrg_5">
                                                <div class="sc_section_inner">
                                                    <h6 class="sc_section_subtitle sc_item_subtitle">Kontaktirajte nas</h6>
                                                    <h2 class="sc_section_title sc_item_title line_hide">Kako do nas</h2>
                                                    <h5 class="sc_title sc_title_regular sc_align_center">Inner Dynamic Method se nalazi u Beogradu, u blizini Autokomande.</h5>
                                                    <h5 class="sc_title sc_title_regular sc_align_center">Veoma pristupačna lokacija iz svih delova grada, bilo da dolazite gradskim prevozom ili kolima.</h5>
                                                    <div class="sc_section_content_wrap">
                                                        <div class="columns_wrap sc_columns columns_nofluid">
                                                            <div class="column-1_3 sc_column_item">
                                                                <h5 class="sc_title sc_title_regular sc_align_center">O Inner Dynamic Method</h5>
                                                                <div class="text_column content_element ">
                                                                    <div class="wrapper">
                                                                        <p>Promenite obrazac koji vas koči. Zakažite sesiju i napravite prvi korak ka unutrašnjoj promeni već danas!</p>
                                                                    </div>
                                                                </div>
                                                                <div class="sc_empty_space em_height_3"><span class="sc_empty_space_inner"></span></div>
                                                            </div>
                                                            <div class="column-1_3 sc_column_item">
                                                                <h5 class="sc_title sc_title_regular sc_align_center">Radno vreme</h5>
                                                                <div class="text_column content_element ">
                                                                    <div class="wrapper">
                                                                        <p>Ponedeljak&#8211;Petak: 9h &#8211; 20h
                                                                            <br/> Subota: 9h &#8211; 14h
                                                                            <br/> Nedelja: Ne radimo
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="sc_empty_space em_height_3"><span class="sc_empty_space_inner"></span></div>
                                                            </div>
                                                            <div class="column-1_3 sc_column_item">
                                                                <h5 class="sc_title sc_title_regular sc_align_center">Kontakt</h5>
                                                                <div class="text_column content_element ">
                                                                    <div class="wrapper">
                                                                        <p>Dobropoljska 35, Beograd
                                                                            <br/> Email: <a href="mailto:office@innerdynamiccoaching.rs">office@innerdynamiccoaching.rs</a>
                                                                            <br/> Telefon: <a href="tel:0641112202">064 111 22 02</a>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="sc_empty_space em_height_3"><span class="sc_empty_space_inner"></span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sc_empty_space em_height_1"><span class="sc_empty_space_inner"></span></div>
                                            <iframe class="sc_googlemap"
                                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5441.67495838286!2d20.45742885563288!3d44.79220807107094!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7012ffe9ee83%3A0x887cb8ed5df92f80!2sDobropoljska%2035%2C%20Beograd!5e1!3m2!1sen!2srs!4v1766699249508!5m2!1sen!2srs"
                                                aria-label="Dobropoljska 35, Beograd"></iframe>
                                            <div class="sc_empty_space em_height_3-7"><span class="sc_empty_space_inner"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="sc_row row sc_row-fluid">
                                <div class="column sc_column_container sc_col-sm-12">
                                    <div class="sc_column-inner">
                                        <div class="wrapper">
                                            <div class="sc_section sc_section_block aligncenter max_width cu_width-770">
                                                <div class="sc_section_inner newsletter-block newsletter-block--alt">
                                                    <h2 id="newsletter-form" class="sc_title sc_title_regular cu_mrg_5">Prijava na newsletter</h2>
                                                    <div class="sc_section_content_wrap">
                                                        <form method="post" action="kontakt.php" class="sc_form sc_form_style_form_3">
                                                            <input type="hidden" name="newsletter_form" value="1">
                                                            <input type="hidden" name="action" value="subscribe">
                                                            <?php if (!empty($success_msg) && $msg_target === 'subscribe'): ?>
                                                                <div class="sc_infobox sc_infobox_style_success" style="margin:0 0 15px 0;">
                                                                    <?php echo h($success_msg); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if ($scroll_to_form && (!empty($success_msg) || !empty($error_msg))): ?>
                                                                <script>(function(){ var el=document.getElementById('<?php echo $scroll_target_id; ?>'); if(el){el.scrollIntoView({behavior:'smooth',block:'start'});} })();</script>
                                                            <?php endif; ?>
                                                            <?php if (!empty($error_msg) && $msg_target === 'subscribe'): ?>
                                                                <div class="sc_infobox sc_infobox_style_error" style="margin:0 0 15px 0;">
                                                                    <?php echo h($error_msg); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="sc_form_info">
                                                                <div class="sc_form_item sc_form_field label_over">
                                                                    <input type="text" name="ime" placeholder="Ime" value="<?php echo h($ime); ?>" required>
                                                                </div>
                                                                <div class="sc_form_item sc_form_field label_over">
                                                                    <input type="text" name="prezime" placeholder="Prezime" value="<?php echo h($prezime); ?>" required>
                                                                </div>
                                                                <div class="sc_form_item sc_form_field label_over">
                                                                    <input type="email" name="email" placeholder="Email" value="<?php echo h($email); ?>" required>
                                                                </div>
                                                                <div class="sc_form_item sc_form_field label_over">
                                                                    <div class="sc_form_item sc_form_field label_over" style="display:flex;gap:10px;flex-wrap:wrap;">
                                                                        <input type="hidden" name="datum_rodjenja" id="datum_rodjenja_iso" value="<?php echo h($datum); ?>">
                                                                        <select id="dob_day" aria-label="Dan rođenja" style="min-width:110px;">
                                                                            <option value="">Dan</option>
                                                                            <?php for($d=1;$d<=31;$d++) { $v=sprintf('%02d',$d); echo '<option value="'.$v.'">'.$v.'</option>'; } ?>
                                                                        </select>
                                                                        <select id="dob_month" aria-label="Mesec rođenja" style="min-width:130px;">
                                                                            <option value="">Mesec</option>
                                                                            <?php for($m=1;$m<=12;$m++) { $v=sprintf('%02d',$m); echo '<option value="'.$v.'">'.$v.'</option>'; } ?>
                                                                        </select>
                                                                        <select id="dob_year" aria-label="Godina rođenja" style="min-width:140px;">
                                                                            <option value="">Godina</option>
                                                                            <?php for($y=date('Y');$y>=1926;$y--) echo '<option value="'.$y.'">'.$y.'</option>'; ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="newsletter-subtitle">Datum rođenja nije obavezan. Ako ga unosite, izaberite dan/mesec/godinu.</div>
                                                                </div>
                                                                <div class="sc_form_item" style="display:none;">
                                                                    <input type="checkbox" name="newsletter" value="1" checked="checked">
                                                                </div>
                                                            </div>
                                                            <div class="sc_form_item sc_form_button" style="text-align:center;">
                                                                <button class="sc_button sc_button_style_filled sc_button_size_medium">
                                                                    <span class="overlay"><span class="first">Pošalji podatke i prijavi se za newsletter</span><span class="second">Pošalji podatke i prijavi se za newsletter</span></span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Odjava sa newsletter-a -->
                            <div class="sc_section sc_section_block aligncenter max_width cu_width-770" style="margin-top:30px;">
                                <div class="sc_section_inner newsletter-block">
                                    <hr class="newsletter-divider">
                                    <h3 id="unsubscribe-form" class="sc_title sc_title_regular cu_mrg_5" style="font-size:24px;">Odjava sa newsletter-a</h3>
                                    <?php if (!empty($success_msg) && $msg_target === 'unsubscribe'): ?>
                                        <div class="sc_infobox sc_infobox_style_success" style="margin:15px 0;"><?php echo h($success_msg); ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($error_msg) && $msg_target === 'unsubscribe'): ?>
                                        <div class="sc_infobox sc_infobox_style_error" style="margin:15px 0;"><?php echo h($error_msg); ?></div>
                                    <?php endif; ?>
                                    <div class="sc_section_content_wrap">
                                        <form method="post" action="kontakt.php" class="sc_form sc_form_style_form_3" style="margin-top:10px;">
                                            <input type="hidden" name="action" value="unsubscribe_request">
                                            <div class="sc_form_info">
                                                <div class="sc_form_item sc_form_field label_over">
                                                    <input type="email" name="unsub_email" placeholder="Unesite email adresu" value="<?php echo h($unsub_email); ?>" required>
                                                </div>
                                            </div>
                                            <div class="sc_form_item sc_form_button" style="display:flex;justify-content:center;">
                                                <button class="sc_button sc_button_style_filled sc_button_size_medium" type="submit">
                                                    <span class="overlay"><span class="first">Pošalji link za odjavu</span><span class="second">Pošalji link za odjavu</span></span>
                                                </button>
                                            </div>
                                            <div style="font-size:14px;opacity:.9;text-align:center;margin-top:8px;">Na email će vam stići link za potvrdu odjave (važi 24h).</div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Brisanje podataka -->
                            <div class="sc_section sc_section_block aligncenter max_width cu_width-770" style="margin-top:25px;">
                                <div class="sc_section_inner newsletter-block newsletter-block--alt">
                                    <hr class="newsletter-divider">
                                    <h3 id="delete-form" class="sc_title sc_title_regular cu_mrg_5" style="font-size:24px;">Izbriši moje podatke</h3>
                                    <?php if (!empty($success_msg) && $msg_target === 'delete'): ?>
                                        <div class="sc_infobox sc_infobox_style_success" style="margin:15px 0;"><?php echo h($success_msg); ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($error_msg) && $msg_target === 'delete'): ?>
                                        <div class="sc_infobox sc_infobox_style_error" style="margin:15px 0;"><?php echo h($error_msg); ?></div>
                                    <?php endif; ?>
                                    <div class="sc_section_content_wrap">
                                        <form method="post" action="kontakt.php" class="sc_form sc_form_style_form_3" style="margin-top:10px;">
                                            <input type="hidden" name="action" value="delete_request">
                                            <div class="sc_form_info">
                                                <div class="sc_form_item sc_form_field label_over">
                                                    <input type="email" name="del_email" placeholder="Unesite email adresu" value="<?php echo h($del_email); ?>" required>
                                                </div>
                                            </div>
                                            <div class="sc_form_item sc_form_button" style="display:flex;justify-content:center;">
                                                <button class="sc_button sc_button_style_filled sc_button_size_medium" type="submit">
                                                    <span class="overlay"><span class="first">Pošalji link za brisanje</span><span class="second">Pošalji link za brisanje</span></span>
                                                </button>
                                            </div>
                                            <div style="font-size:14px;opacity:.9;text-align:center;margin-top:8px;">Na email će vam stići link za potvrdu brisanja (važi 24h). Ova akcija je nepovratna.</div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </section>
                    </article>
                </div>
            </div>
        </div>
<?php include 'includes/footer.php'; ?>
