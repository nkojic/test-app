<?php
$lang_sr_url = '/kontakt.php';
$lang_en_url = $_SERVER['REQUEST_URI'];

// UTF-8 output (da bi poruke i forma bile ispravno prikazane)
header('Content-Type: text/html; charset=utf-8');

// Flash poruke + PRG (Post/Redirect/Get) da:
// 1) spreči dupli submit na refresh
// 2) automatski skroluje na formu preko #newsletter-form
if (session_status() === PHP_SESSION_NONE) {
    session_start();

// -----------------------------
// Anti-bot: Honeypot + Rate limit (defined early)
// -----------------------------
function antibot_check($action) {
    $hp = $_POST['website'] ?? '';
    if (!empty($hp)) return 'Invalid request.';

    $ts = isset($_POST['form_ts']) ? (int)$_POST['form_ts'] : 0;
    if ($ts <= 0) return 'Invalid request.';
    if ((time() - $ts) < 3) return 'Please try again.';

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
        return 'Too many requests in a short time. Please try again in a few minutes.';
    }

    $events[] = $now;
    @file_put_contents($file, json_encode($events), LOCK_EX);

    return null;
}

function antibot_fail($msg_target, $message) {
    $_SESSION['error_msg'] = $message;
    $_SESSION['msg_target'] = $msg_target;
    $anchor = ($msg_target === 'unsubscribe') ? 'unsubscribe-form' : (($msg_target === 'delete') ? 'delete-form' : 'newsletter-form');
    header('Location: /en/Contact.php#' . $anchor);
    exit;
}
}


// -----------------------------
// DB config (van public_html)
// -----------------------------
define('DB_CONFIG_PATH', '/home/bowencen/secure/db_config.php');

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

$msg_target = $_SESSION['msg_target'] ?? 'subscribe';
unset($_SESSION['msg_target']);
$scroll_target_id = ($msg_target === 'unsubscribe') ? 'unsubscribe-form' : (($msg_target === 'delete') ? 'delete-form' : 'newsletter-form');
$scroll_to_form = (!empty($success_msg) || !empty($error_msg));
unset($_SESSION['success_msg'], $_SESSION['error_msg']);

// Sticky vrednosti forme (da posle greške polja ostanu popunjena)
$form = $_SESSION['form'] ?? [];
unset($_SESSION['form']);
$ime = $form['ime'] ?? '';
$prezime = $form['prezime'] ?? '';
$email = $form['email'] ?? '';
$datum = $form['datum_rodjenja'] ?? '';
$newsletter = (int)($form['newsletter'] ?? 0);

// Sticky vrednosti za odjavu/brisanje
$unsub_form = $_SESSION['unsub_form'] ?? [];
$del_form   = $_SESSION['del_form'] ?? [];
unset($_SESSION['unsub_form'], $_SESSION['del_form']);
$unsub_email = $unsub_form['email'] ?? '';
$del_email   = $del_form['email'] ?? '';




// -----------------------------
// Newsletter: helper funkcije
// -----------------------------
function h($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }

function current_base_url() {
    // Vraća SAMO root domen (bez putanje), da se izbegne dupliranje /en kada se pozove iz /en/ foldera.
    $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    $scheme = $https ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    return $scheme . '://' . $host;
}


function send_mail_html($to, $subject, $htmlBody) {
    // SMTP slanje preko PHPMailer (bolja isporučivost, naročito za Hotmail/Outlook)
    $cfg = get_db_config();
    if (!$cfg) {
        error_log('send_mail_html: missing db_config');
        return false;
    }

    // SMTP lozinka (mailbox) mora biti u eksternom fajlu kao: 'mailpass' => '...'
    $smtpPass = (string)($cfg['mailpass'] ?? '');
    if ($smtpPass === '') {
        error_log('send_mail_html: missing mailpass in db_config.php');
        return false;
    }

    // PHPMailer include (radi i iz /en/ foldera)
    $paths = [
        __DIR__ . '/phpmailer/src/',
        __DIR__ . '/../phpmailer/src/',
    ];

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
    if (!$found) {
        error_log('send_mail_html: PHPMailer src not found');
        return false;
    }

    // Minimalni HTML template (sadrži isti sadržaj kao ranije, samo upakovan)
    $safeSubject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
    $template = '<!doctype html>
<html lang="sr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>' . $safeSubject . '</title>
</head>
<body style="margin:0;padding:0;background:#f4f4f6;">
  <div style="max-width:640px;margin:0 auto;padding:24px;">
    <div style="background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 8px 24px rgba(0,0,0,.08);">
      <div style="background:#111827;color:#fff;padding:16px 20px;font-family:Arial,Helvetica,sans-serif;">
        <div style="font-size:16px;font-weight:700;">Bowen centar</div>
        <div style="font-size:13px;opacity:.9;margin-top:2px;">Newsletter</div>
      </div>
      <div style="padding:18px 20px;font-family:Arial,Helvetica,sans-serif;color:#111827;font-size:14px;line-height:1.45;">
        ' . $htmlBody . '
      </div>
      <div style="padding:12px 20px;font-family:Arial,Helvetica,sans-serif;color:#6b7280;font-size:12px;border-top:1px solid #e5e7eb;">
        This message was sent from bowencentar.rs
      </div>
    </div>
  </div>
</body>
</html>';

    // SMTP settings (kao na admin strani)
    $SMTP_HOST = 'mail.bowencentar.rs';
    $SMTP_PORT = 465;
    $SMTP_USER = 'office@bowencentar.rs';
    $SMTP_FROM_NAME = 'Bowen centar';

    try {
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = $SMTP_HOST;
        $mail->Port       = $SMTP_PORT;
        $mail->SMTPAuth   = true;
        $mail->Username   = $SMTP_USER;
        $mail->Password   = $smtpPass;
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;

        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        // From/Reply-To
        $mail->setFrom($SMTP_USER, $SMTP_FROM_NAME);
        $mail->addReplyTo($SMTP_USER, $SMTP_FROM_NAME);

        // To
        $mail->addAddress($to);

        // Subject sa prefiksom
        $mail->Subject = 'Bowen centar - Newsletter - ' . $subject;

        $mail->isHTML(true);
        $mail->Body    = $template;
        $mail->AltBody = trim(preg_replace('/\s+/', ' ', strip_tags($htmlBody)));

        return $mail->send();
    } catch (Throwable $e) {
        error_log('send_mail_html PHPMailer error: ' . $e->getMessage());
        return false;
    }
}

function make_token() {
    return bin2hex(random_bytes(32));
}

// Kreira tabelu za akcije ako ne postoji (ako hosting dozvoljava CREATE)
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
    $type  = trim($_GET['type']); // unsubscribe | delete
    $token = trim($_GET['token']);

    // DB konekcija (isti parametri kao u POST delu)
    $db = get_db_config();
    if (!$db) {
        $_SESSION['error_msg'] = 'Database connection error.';
        $_SESSION['msg_target'] = $_SESSION['msg_target'] ?? 'subscribe';
        header('Location: /en/Contact.php#' . (($_SESSION['msg_target'] === 'unsubscribe') ? 'unsubscribe-form' : (($_SESSION['msg_target'] === 'delete') ? 'delete-form' : 'newsletter-form')));
        exit;
    }
    $db_host = $db['host'];
    $db_name = $db['name'];
    $db_user = $db['user'];
    $db_pass = $db['pass'];
    mysqli_report(MYSQLI_REPORT_OFF);
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        error_log('DB connect error (confirm): ' . $conn->connect_error);
        $_SESSION['error_msg'] = 'Database connection error.';
        header('Location: /en/Contact.php#newsletter-form');
        exit;
    }
    $conn->set_charset($db['charset'] ?? 'utf8mb4');
    ensure_actions_table($conn);

    // Validacija tokena
    $stmt = $conn->prepare("SELECT email, action, expires_at, used_at FROM newsletter_actions WHERE token=? LIMIT 1");
    if (!$stmt) {
        error_log('DB prepare error (confirm select): ' . $conn->error);
        $_SESSION['error_msg'] = 'Database query preparation error.';
        header('Location: /en/Contact.php#newsletter-form');
        exit;
    }
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res ? $res->fetch_assoc() : null;
    $stmt->close();

    if (!$row) {
        $_SESSION['error_msg'] = 'Invalid or expired link.';
        header('Location: /en/Contact.php#newsletter-form');
        exit;
    }
    if (!empty($row['used_at'])) {
        $_SESSION['error_msg'] = 'This link has already been used.';
        header('Location: /en/Contact.php#newsletter-form');
        exit;
    }
    $expires = strtotime($row['expires_at']);
    if ($expires !== false && $expires < time()) {
        $_SESSION['error_msg'] = 'This link has expired. Please submit a new request.';
        header('Location: /en/Contact.php#newsletter-form');
        exit;
    }
    if ($row['action'] !== $type) {
        $_SESSION['error_msg'] = 'Invalid action type.';
        header('Location: /en/Contact.php#newsletter-form');
        exit;
    }

    $email_c = $row['email'];

    if ($type === 'unsubscribe') {
        // Pretpostavka: 1=prijavljen, 0=odjavljen
        $u = $conn->prepare("UPDATE kontakti SET newsletter=0 WHERE email=?");
        if ($u) {
            $u->bind_param("s", $email_c);
            $u->execute();
            $u->close();
        }
        $_SESSION['success_msg'] = 'You have successfully unsubscribed from the newsletter.';
        $anchor = '#unsubscribe-form';
    } elseif ($type === 'delete') {
        $d = $conn->prepare("DELETE FROM kontakti WHERE email=?");
        if ($d) {
            $d->bind_param("s", $email_c);
            $d->execute();
            $d->close();
        }
        $_SESSION['success_msg'] = 'Your data has been deleted from the database.';
        $anchor = '#delete-form';
    } else {
        $_SESSION['error_msg'] = 'Unknown action.';
        $anchor = '#newsletter-form';
    }

    // mark used
    $m = $conn->prepare("UPDATE newsletter_actions SET used_at=NOW() WHERE token=?");
    if ($m) {
        $m->bind_param("s", $token);
        $m->execute();
        $m->close();
    }
    $conn->close();

    header('Location: Contact.php' . $anchor);
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = trim($_POST['action'] ?? 'subscribe');

    // -----------------------------
    // A) PRIJAVA / AŽURIRANJE (postojeća forma)
    // -----------------------------
    if ($action === 'subscribe') {

        // --- 1) Uzimanje i osnovno čišćenje ulaza ---
        $ime    = trim($_POST['ime'] ?? '');
        $prezime= trim($_POST['prezime'] ?? '');
        $email  = trim($_POST['email'] ?? '');
        $datum  = trim($_POST['datum_rodjenja'] ?? '');
        $newsletter = isset($_POST['newsletter']) ? 1 : 0;

        // --- 2) Validacija (datum nije obavezan) ---
        if ($ime === '' || $prezime === '' || $email === '') {
            $_SESSION['error_msg'] = 'Please fill in the required fields: first name, last name, and email.';
            $_SESSION['form'] = ['ime'=>$ime,'prezime'=>$prezime,'email'=>$email,'datum_rodjenja'=>$datum,'newsletter'=>$newsletter];
            header('Location: /en/Contact.php#newsletter-form');
            exit;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_msg'] = 'The email address you entered is invalid.';
            $_SESSION['form'] = ['ime'=>$ime,'prezime'=>$prezime,'email'=>$email,'datum_rodjenja'=>$datum,'newsletter'=>$newsletter];
            header('Location: /en/Contact.php#newsletter-form');
            exit;
        }

        // --- 3) DB konekcija ---
        $db = get_db_config();
    if (!$db) {
        $_SESSION['error_msg'] = 'Database connection error.';
        $_SESSION['msg_target'] = $_SESSION['msg_target'] ?? 'subscribe';
        header('Location: /en/Contact.php#' . (($_SESSION['msg_target'] === 'unsubscribe') ? 'unsubscribe-form' : (($_SESSION['msg_target'] === 'delete') ? 'delete-form' : 'newsletter-form')));
        exit;
    }
    $db_host = $db['host'];
    $db_name = $db['name'];
    $db_user = $db['user'];
    $db_pass = $db['pass'];
        mysqli_report(MYSQLI_REPORT_OFF);
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

        if ($conn->connect_error) {
            error_log('DB connect error: ' . $conn->connect_error);
            $_SESSION['error_msg'] = 'Database connection error.';
            $_SESSION['form'] = ['ime'=>$ime,'prezime'=>$prezime,'email'=>$email,'datum_rodjenja'=>$datum,'newsletter'=>$newsletter];
            header('Location: /en/Contact.php#newsletter-form');
            exit;
        }

        $conn->set_charset($db['charset'] ?? 'utf8mb4');

        // --- 4) Provera da li email već postoji (UNIQUE) ---
        $check = $conn->prepare("SELECT id FROM kontakti WHERE email=? LIMIT 1");
        if (!$check) {
            error_log('DB prepare error (check): ' . $conn->error);
            $_SESSION['error_msg'] = 'Database query preparation error.';
            $_SESSION['form'] = ['ime'=>$ime,'prezime'=>$prezime,'email'=>$email,'datum_rodjenja'=>$datum,'newsletter'=>$newsletter];
            header('Location: /en/Contact.php#newsletter-form');
            exit;
        }
        $check->bind_param("s", $email);
        $check->execute();
        $res = $check->get_result();
        $exists = $res ? $res->fetch_assoc() : null;
        $check->close();

        if ($exists) {
            // Email je UNIQUE: ako već postoji, ne dozvoljavamo izmenu podataka preko forme za prijavu.
            $_SESSION['error_msg'] = 'Your details are already in the database (this email address is already subscribed).';
            $_SESSION['msg_target'] = 'subscribe';
            header('Location: /en/Contact.php#newsletter-form');
            exit;
        }

        // --- 5) Insert ---
        $stmt = $conn->prepare("INSERT INTO kontakti (ime, prezime, email, datum_rodjenja, newsletter) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            error_log('DB prepare error (insert): ' . $conn->error);
            $_SESSION['error_msg'] = 'Database query preparation error.';
            $_SESSION['form'] = ['ime'=>$ime,'prezime'=>$prezime,'email'=>$email,'datum_rodjenja'=>$datum,'newsletter'=>$newsletter];
            header('Location: /en/Contact.php#newsletter-form');
            exit;
        }

        $stmt->bind_param("ssssi", $ime, $prezime, $email, $datum, $newsletter);

        if ($stmt->execute()) {
            $_SESSION['success_msg'] = 'Your subscription request has been sent.';
        } else {
            if ($stmt->errno === 1062) {
                $_SESSION['error_msg'] = 'Your details are already in the database (this email address is already subscribed).';
            $_SESSION['msg_target'] = 'subscribe';
            } else {
                error_log('DB execute error (insert): ' . $stmt->error);
                $_SESSION['error_msg'] = 'An error occurred while saving your data.';
                $_SESSION['form'] = ['ime'=>$ime,'prezime'=>$prezime,'email'=>$email,'datum_rodjenja'=>$datum,'newsletter'=>$newsletter];
            }
        }

        $stmt->close();
        $conn->close();

        header('Location: /en/Contact.php#newsletter-form');
        exit;
    }

    // -----------------------------
    // B) ODJAVA (email potvrda)
    // -----------------------------
    if ($action === 'unsubscribe_request') {

        $u_email = trim($_POST['unsub_email'] ?? '');
        if ($u_email === '' || !filter_var($u_email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_msg'] = 'Please enter a valid email address to unsubscribe.';
            $_SESSION['unsub_form'] = ['email'=>$u_email];
            header('Location: /en/Contact.php#unsubscribe-form');
            exit;
        }

        $db = get_db_config();
    if (!$db) {
        $_SESSION['error_msg'] = 'Database connection error.';
        $_SESSION['msg_target'] = $_SESSION['msg_target'] ?? 'subscribe';
        header('Location: /en/Contact.php#' . (($_SESSION['msg_target'] === 'unsubscribe') ? 'unsubscribe-form' : (($_SESSION['msg_target'] === 'delete') ? 'delete-form' : 'newsletter-form')));
        exit;
    }
    $db_host = $db['host'];
    $db_name = $db['name'];
    $db_user = $db['user'];
    $db_pass = $db['pass'];
        mysqli_report(MYSQLI_REPORT_OFF);
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

        if ($conn->connect_error) {
            error_log('DB connect error (unsub): ' . $conn->connect_error);
            $_SESSION['error_msg'] = 'Database connection error.';
            $_SESSION['unsub_form'] = ['email'=>$u_email];
            header('Location: /en/Contact.php#unsubscribe-form');
            exit;
        }

        $conn->set_charset($db['charset'] ?? 'utf8mb4');
        ensure_actions_table($conn);

        $chk = $conn->prepare("SELECT id FROM kontakti WHERE email=? LIMIT 1");
        if (!$chk) {
            error_log('DB prepare error (unsub check): ' . $conn->error);
            $_SESSION['error_msg'] = 'Database query preparation error.';
            $_SESSION['unsub_form'] = ['email'=>$u_email];
            header('Location: /en/Contact.php#unsubscribe-form');
            exit;
        }
        $chk->bind_param("s", $u_email);
        $chk->execute();
        $res = $chk->get_result();
        $exists = $res ? $res->fetch_assoc() : null;
        $chk->close();

        if (!$exists) {
            $_SESSION['error_msg'] = 'This email address was not found in our database.';
            $_SESSION['unsub_form'] = ['email'=>$u_email];
            header('Location: /en/Contact.php#unsubscribe-form');
            exit;
        }

        $token = make_token();
        $ins = $conn->prepare("INSERT INTO newsletter_actions (email, action, token, expires_at) VALUES (?, 'unsubscribe', ?, DATE_ADD(NOW(), INTERVAL 24 HOUR))");
        if (!$ins) {
            error_log('DB prepare error (unsub token): ' . $conn->error);
            $_SESSION['error_msg'] = 'Database query preparation error.';
            $_SESSION['unsub_form'] = ['email'=>$u_email];
            header('Location: /en/Contact.php#unsubscribe-form');
            exit;
        }
        $ins->bind_param("ss", $u_email, $token);
        if (!$ins->execute()) {
            error_log('DB execute error (unsub token): ' . $ins->error);
            $_SESSION['error_msg'] = 'An error occurred while processing your request.';
            $_SESSION['unsub_form'] = ['email'=>$u_email];
            header('Location: /en/Contact.php#unsubscribe-form');
            exit;
        }
        $ins->close();

        $link = current_base_url() . "/en/Contact.php?confirm=1&type=unsubscribe&token=" . urlencode($token);
        $body = "<p>Zahtev za odjavu sa newsletter-a je primljen.</p>
                 <p>To unsubscribe, click the link below (valid for 24h):</p>
                 <p><a href=\"" . h($link) . "\">Potvrdi odjavu</a></p>
                 <p>If you did not request this, please ignore this message.</p>";

        if (!send_mail_html($u_email, " Unsubscribe Confirmation", $body)) {
            $_SESSION['error_msg'] = 'Unable to send email. Please check your inbox/spam or your hosting mail() settings.';
            $_SESSION['unsub_form'] = ['email'=>$u_email];
            header('Location: /en/Contact.php#unsubscribe-form');
            exit;
        }

        $conn->close();

        $_SESSION['success_msg'] = 'A confirmation email for unsubscription has been sent. Please check your inbox/spam.';
        header('Location: /en/Contact.php#unsubscribe-form');
        exit;
    }

    // -----------------------------
    // C) BRISANJE PODATAKA (email potvrda)
    // -----------------------------
    if ($action === 'delete_request') {

        $d_email = trim($_POST['del_email'] ?? '');
        if ($d_email === '' || !filter_var($d_email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_msg'] = 'Please enter a valid email address to delete your data.';
            $_SESSION['del_form'] = ['email'=>$d_email];
            header('Location: /en/Contact.php#delete-form');
            exit;
        }

        $db = get_db_config();
    if (!$db) {
        $_SESSION['error_msg'] = 'Database connection error.';
        $_SESSION['msg_target'] = $_SESSION['msg_target'] ?? 'subscribe';
        header('Location: /en/Contact.php#' . (($_SESSION['msg_target'] === 'unsubscribe') ? 'unsubscribe-form' : (($_SESSION['msg_target'] === 'delete') ? 'delete-form' : 'newsletter-form')));
        exit;
    }
    $db_host = $db['host'];
    $db_name = $db['name'];
    $db_user = $db['user'];
    $db_pass = $db['pass'];
        mysqli_report(MYSQLI_REPORT_OFF);
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

        if ($conn->connect_error) {
            error_log('DB connect error (delete): ' . $conn->connect_error);
            $_SESSION['error_msg'] = 'Database connection error.';
            $_SESSION['del_form'] = ['email'=>$d_email];
            header('Location: /en/Contact.php#delete-form');
            exit;
        }

        $conn->set_charset($db['charset'] ?? 'utf8mb4');
        ensure_actions_table($conn);

        $chk = $conn->prepare("SELECT id FROM kontakti WHERE email=? LIMIT 1");
        if (!$chk) {
            error_log('DB prepare error (delete check): ' . $conn->error);
            $_SESSION['error_msg'] = 'Database query preparation error.';
            $_SESSION['del_form'] = ['email'=>$d_email];
            header('Location: /en/Contact.php#delete-form');
            exit;
        }
        $chk->bind_param("s", $d_email);
        $chk->execute();
        $res = $chk->get_result();
        $exists = $res ? $res->fetch_assoc() : null;
        $chk->close();

        if (!$exists) {
            $_SESSION['error_msg'] = 'This email address was not found in our database.';
            $_SESSION['del_form'] = ['email'=>$d_email];
            header('Location: /en/Contact.php#delete-form');
            exit;
        }

        $token = make_token();
        $ins = $conn->prepare("INSERT INTO newsletter_actions (email, action, token, expires_at) VALUES (?, 'delete', ?, DATE_ADD(NOW(), INTERVAL 24 HOUR))");
        if (!$ins) {
            error_log('DB prepare error (delete token): ' . $conn->error);
            $_SESSION['error_msg'] = 'Database query preparation error.';
            $_SESSION['del_form'] = ['email'=>$d_email];
            header('Location: /en/Contact.php#delete-form');
            exit;
        }
        $ins->bind_param("ss", $d_email, $token);
        if (!$ins->execute()) {
            error_log('DB execute error (delete token): ' . $ins->error);
            $_SESSION['error_msg'] = 'An error occurred while processing your request.';
            $_SESSION['del_form'] = ['email'=>$d_email];
            header('Location: /en/Contact.php#delete-form');
            exit;
        }
        $ins->close();

        $link = current_base_url() . "/en/Contact.php?confirm=1&type=delete&token=" . urlencode($token);
        $body = "<p>Zahtev za brisanje podataka je primljen.</p>
                 <p>To delete your data, click the link below (valid for 24h):</p>
                 <p><a href=\"" . h($link) . "\">Potvrdi brisanje</a></p>
                 <p><strong>Warning:</strong> This action permanently deletes your data.</p>
                 <p>If you did not request this, please ignore this message.</p>";

        if (!send_mail_html($d_email, "Data Deletion Confirmation", $body)) {
            $_SESSION['error_msg'] = 'Unable to send email. Please check your inbox/spam or your hosting mail() settings.';
            $_SESSION['del_form'] = ['email'=>$d_email];
            header('Location: /en/Contact.php#delete-form');
            exit;
        }

        $conn->close();

        $_SESSION['success_msg'] = 'A confirmation email for deletion has been sent. Please check your inbox/spam.';
        header('Location: /en/Contact.php#delete-form');
        exit;
    }

    $_SESSION['error_msg'] = 'Unknown action.';
    header('Location: /en/Contact.php#newsletter-form');
    exit;
}

?><!DOCTYPE html>


<html lang="en-US" class="scheme_original">

<head>
    <title>Bowen Center – Bowen Therapy for Pain and Stress Relief.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <meta name="description" content="Bowen Center – Belgrade. Bowen therapy to relieve pain and reduce stress. Dr Danijela Marić Pavlović, an experienced therapist, supports holistic recovery and well-being." />
	<meta name="keywords" content="Bowen, therapy, pain, stress relief, recovery">
	<meta name="author" content="Danijela Marić Pavlović">
	<link rel="icon" type="image/png" sizes="32x32" href="/images/fav.png">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-5HK5X5PZ31"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-5HK5X5PZ31');
</script>
    <link rel='stylesheet' href='/css/admin_icon.min.css' type='text/css' media='all' />
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Droid+Serif:400,400i,700,700i|Montserrat:400,700|Mr+De+Haviland|Open+Sans:300,400,600,700,800|Raleway:100,200,300,300i,400,400i,500,600,700,700i,800,900&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese' type='text/css' media='all' />
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css?ver=4.3.0' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/fontello/css/fontello.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/core.animation.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/shortcodes.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/instagram-widget.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/skin.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/custom-style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/skin.responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/custom.responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' href='js/vendor/grid.layout/grid.layout.min.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/core.messages.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/plugins.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/custom.css' type='text/css' media='all' />

<style>
/* Newsletter forms – visual separation */
.newsletter-block{
  padding: 28px 22px;
  margin: 28px auto;
  border: 1px solid rgba(0,0,0,0.08);
  border-radius: 8px;
}
.newsletter-block--alt{
  background: rgba(0,0,0,0.02);
}
.newsletter-divider{
  max-width: 770px;
  margin: 18px auto 0 auto;
  border: 0;
  border-top: 1px solid rgba(0,0,0,0.10);
}
.newsletter-subtitle{
  text-align:center;
  font-size: 13px;
  opacity: .8;
  margin-top: 6px;
}
</style>

</head>

<body class="contactus page body_filled theme_skin_less article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide preloader wpb-js-composer sc_responsive">
<div id="page_preloader"></div>
<div class="body_wrap">
    <div class="page_wrap">
        <div class="top_panel_fixed_wrap"></div>
        <div class="header_mobile">
            <div class="content_wrap">
                <div class="menu_button icon-menu"></div>
                <div class="logo">
                    <a href="/en/Index.php">
                        <img src="/images/Logo.png" class="logo_main" alt="" width="238" height="56">
                    </a>
                </div>
                <div class="menu_main_cart top_panel_icon">
                    <a href="#" class="top_panel_cart_button" data-items="0" data-summa="&pound;0.00">
                        <span class="contact_icon icon-icon_bag_alt"></span>
                    </a>
                    <ul class="widget_area sidebar_cart sidebar">
                        <li>
                            <div class="widget woocommerce widget_shopping_cart">
                                <div class="hide_cart_widget_if_empty">
                                    <div class="widget_shopping_cart_content">
                                        <ul class="cart_list product_list_widget ">
                                            <li class="empty">No products in the cart.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="side_wrap">
                <div class="close">Close</div>
                <div class="panel_top">
                   
                    <?php include("meni_responsive.php") ?>
                    <div class="search_wrap search_style_regular search_state_fixed search_ajax">
                        <div class="search_form_wrap">
                            <form role="search" method="get" class="search_form" action="#">
                                <button type="submit" class="search_submit icon-search-1" title="Start search"></button>
                                <input type="text" class="search_field" placeholder="Search" value="" name="s" />
                            </form>
                        </div>
                        <div class="search_results widget_area scheme_original">
                            <a class="search_results_close icon-cancel"></a>
                            <div class="search_results_content"></div>
                        </div>
                    </div>
                </div>
                <div class="panel_bottom">
                </div>
            </div>
            <div class="mask"></div>
        </div>
        <?php include("meni.php") ?>
        <section class="top_panel_image">
            <div class="top_panel_image_hover"></div>
            <div class="top_panel_image_header">
                <div class="top_panel_image_icon icon-book-open"></div>
                <h1 class="top_panel_image_title entry-title">Bowen Center – Book a Session</h1>
                
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
                                                    <h6 class="sc_section_subtitle sc_item_subtitle">Contact us</h6>
                                                    <h2 class="sc_section_title sc_item_title line_hide">HOW TO FIND US</h2>
                                                    <h5 class="sc_title sc_title_regular sc_align_center">The Bowen Center is located in Belgrade, near Autokomanda.</h5>
                                                    <h5 class="sc_title sc_title_regular sc_align_center">Easily accessible from all parts of the city, whether you arrive by public transport or by car. There is no paid parking zone.</h5>
                                                    <div class="sc_section_content_wrap">
                                                        <div class="columns_wrap sc_columns columns_nofluid">
                                                            <div class="column-1_3 sc_column_item">
                                                                <h5 class="sc_title sc_title_regular sc_align_center">ABOUT THE BOWEN CENTER</h5>
                                                                <div class="text_column content_element ">
                                                                    <div class="wrapper">
                                                                        <p>Your body knows how to regenerate — you just need to give it the opportunity. Release tension, calm your mind, and book your Bowen treatment today!</p>
                                                                    </div>
                                                                </div>
                                                                <div class="sc_empty_space em_height_3">
                                                                    <span class="sc_empty_space_inner"></span>
                                                                </div>
                                                            </div>
                                                            <div class="column-1_3 sc_column_item">
                                                                <h5 class="sc_title sc_title_regular sc_align_center">Working hours</h5>
                                                                <div class="text_column content_element ">
                                                                    <div class="wrapper">
                                                                        <p>Monday–Friday: 9am &#8211; 8pm
                                                                            <br/> Saturday: 9am &#8211; 2pm
                                                                            <br/> Sunday: Closed
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="sc_empty_space em_height_3">
                                                                    <span class="sc_empty_space_inner"></span>
                                                                </div>
                                                            </div>
                                                            <div class="column-1_3 sc_column_item">
                                                                <h5 class="sc_title sc_title_regular sc_align_center">Contact</h5>
                                                                <div class="text_column content_element ">
                                                                    <div class="wrapper">
                                                                        <p>Dobropoljska 35, Beograd
                                                                            <br/> Email:
                                                                            <a href="mailto:office@bowencentar.rs">office@bowencentar.rs</a>
                                                                            <br/> Phone: <a href="tel:0641112202">064 111 22 02</a>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="sc_empty_space em_height_3">
                                                                    <span class="sc_empty_space_inner"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sc_empty_space em_height_1">
                                                <span class="sc_empty_space_inner"></span>
                                            </div>
                                            <iframe  class="sc_googlemap"
											src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5441.67495838286!2d20.45742885563288!3d44.79220807107094!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7012ffe9ee83%3A0x887cb8ed5df92f80!2sDobropoljska%2035%2C%20Beograd!5e1!3m2!1sen!2srs!4v1766699249508!5m2!1sen!2srs"	
											aria-label="56-34 Waldron St Flushing, NY 11368, USA"></iframe>
                                            <div class="sc_empty_space em_height_3-7">
                                                <span class="sc_empty_space_inner"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="sc_row row sc_row-fluid">
                                <div class="column sc_column_container sc_col-sm-12">
                                    <div class="sc_column-inner ">
                                        <div class="wrapper">
                                            <div class="sc_section sc_section_block aligncenter max_width cu_width-770">
                                                <div class="sc_section_inner">
                                                    <div class="sc_section_content_wrap">
                                                        <h2 class="sc_title sc_title_regular cu_mrg_5">have any questions?</h2>
                                                        <div id="sc_form_629_wrap" class="sc_form_wrap">
                                                            <div id="sc_form_629" class="sc_form sc_form_style_form_3">
                                                                <form id="sc_form_629_form" data-formtype="form_3" method="post" action="includes/sendmail.php">
                                                                    <div class="sc_form_info">
                                                                        <div class="sc_form_item sc_form_field label_over">
                                                                            <label class="required" for="sc_form_username">Name</label>
                                                                            <input id="sc_form_username" type="text" name="username" placeholder="Your Name">
                                                                        </div>
                                                                        <div class="sc_form_item sc_form_field label_over">
                                                                            <label class="required" for="sc_form_email">E-mail</label>
                                                                            <input id="sc_form_email" type="text" name="email" placeholder="E-mail Address">
                                                                        </div>
                                                                        <div class="sc_form_item sc_form_field label_over">
                                                                            <label class="required" for="sc_form_subj">Subject</label>
                                                                            <input id="sc_form_subj" type="text" name="subject" placeholder="Subject">
                                                                        </div>
                                                                    </div>
                                                                    <div class="sc_form_item sc_form_message label_over">
                                                                        <label class="required" for="sc_form_message">Message</label>
                                                                        <textarea id="sc_form_message" name="message" placeholder="Your Message"></textarea>
                                                                    </div>
                                                                    <div class="sc_form_item sc_form_button" style="display:flex;justify-content:center;align-items:center;clear:both;">
                                                                        <button class="sc_button sc_button_style_filled sc_button_size_medium">
                                                                            <span class="overlay"><span class="first">Submit message</span><span class="second">Submit message</span></span></button>
                                                                    </div>
                                                                    <div class="result sc_infobox"></div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                            
                            <div class="sc_row row sc_row-fluid">
    <div class="column sc_column_container sc_col-sm-12">
        <div class="sc_column-inner">
            <div class="wrapper">

                <div class="sc_section sc_section_block aligncenter max_width cu_width-770">
                    <div class="sc_section_inner newsletter-block newsletter-block--alt">

                        <h2 id="newsletter-form" class="sc_title sc_title_regular cu_mrg_5">Newsletter subscription</h2>

                        <div class="sc_section_content_wrap">

                            <form method="post" action="/en/Contact.php" class="sc_form sc_form_style_form_3">
                                <input type="hidden" name="newsletter_form" value="1">
                                <input type="hidden" name="action" value="subscribe">
                                <?php if (!empty($success_msg) && $msg_target === 'subscribe'): ?>
                                    <div class="sc_infobox sc_infobox_style_success" style="margin: 0 0 15px 0;">
                                        <?php echo htmlspecialchars($success_msg, ENT_QUOTES, 'UTF-8'); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($scroll_to_form && (!empty($success_msg) || !empty($error_msg))): ?>
                                    <script>
                                        (function(){
                                            var el = document.getElementById('<?php echo $scroll_target_id; ?>');
                                            if (el) { el.scrollIntoView({behavior:'smooth', block:'start'}); }
                                        })();
                                    </script>
                                <?php endif; ?>

                                <?php if (!empty($error_msg) && $msg_target === 'subscribe'): ?>
                                    <div class="sc_infobox sc_infobox_style_error" style="margin: 0 0 15px 0;">
                                        <?php echo htmlspecialchars($error_msg, ENT_QUOTES, 'UTF-8'); ?>
                                    </div>
                                <?php endif; ?>


                                <div class="sc_form_info">

                                    <div class="sc_form_item sc_form_field label_over">
                                        <input type="text" name="ime" placeholder="First name" value="<?php echo htmlspecialchars($ime, ENT_QUOTES, 'UTF-8'); ?>" required>
                                    </div>

                                    <div class="sc_form_item sc_form_field label_over">
                                        <input type="text" name="prezime" placeholder="Last name" value="<?php echo htmlspecialchars($prezime, ENT_QUOTES, 'UTF-8'); ?>" required>
                                    </div>

                                    <div class="sc_form_item sc_form_field label_over">
                                        <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>" required>
                                    </div>

                                    <div class="sc_form_item sc_form_field label_over">
                                        
<div class="sc_form_item sc_form_field label_over" style="display:flex; gap:10px; flex-wrap:wrap;">
  <input type="hidden" name="datum_rodjenja" id="datum_rodjenja_iso" value="<?php echo htmlspecialchars($datum, ENT_QUOTES, 'UTF-8'); ?>">
  <select id="dob_day" aria-label="Day of birth" style="min-width:110px;">
    <option value="">Day</option>
    <option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
  </select>
  <select id="dob_month" aria-label="Month of birth" style="min-width:130px;">
    <option value="">Month</option>
    <option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>
  </select>
  <select id="dob_year" aria-label="Year of birth" style="min-width:140px;">
    <option value="">Year</option>
    <option value="2026">2026</option><option value="2025">2025</option><option value="2024">2024</option><option value="2023">2023</option><option value="2022">2022</option><option value="2021">2021</option><option value="2020">2020</option><option value="2019">2019</option><option value="2018">2018</option><option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option>
  </select>
</div>
<div class="newsletter-subtitle">Date of birth is optional. If you enter it, please select day/month/year.</div>

                                    </div>

                                    <div class="sc_form_item" style="display:none;">
                                        <label>
                                            <input type="checkbox" name="newsletter" value="1" checked="checked" >
                                            Prijavljujem se na newsletter
                                        </label>
                                    </div>

                                </div>

                                <div class="sc_form_item sc_form_button" style="text-align:center;">
                                    <button class="sc_button sc_button_style_filled sc_button_size_medium">
                                        <span class="overlay"><span class="first">Submit and subscribe to the newsletter</span><span class="second">Submit and subscribe to the newsletter</span></span></button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- NEWSLETTER: odjava i brisanje (email potvrda) -->
<div class="sc_section sc_section_block aligncenter max_width cu_width-770" style="margin-top:30px;">
  <div class="sc_section_inner newsletter-block">
    <hr class="newsletter-divider">
<h3 id="unsubscribe-form" class="sc_title sc_title_regular cu_mrg_5" style="font-size:24px;">Unsubscribe from the newsletter</h3>
        <?php if (!empty($success_msg) && $msg_target === 'unsubscribe'): ?>
            <div class="sc_infobox sc_infobox_style_success" style="margin: 15px 0 15px 0;">
                <?php echo htmlspecialchars($success_msg, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error_msg) && $msg_target === 'unsubscribe'): ?>
            <div class="sc_infobox sc_infobox_style_error" style="margin: 15px 0 15px 0;">
                <?php echo htmlspecialchars($error_msg, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

    <div class="sc_section_content_wrap">

      <form method="post" action="/en/Contact.php" class="sc_form sc_form_style_form_3" style="margin-top:10px;">
        <input type="hidden" name="action" value="unsubscribe_request">

        <div class="sc_form_info">
          <div class="sc_form_item sc_form_field label_over">
            <input type="email" name="unsub_email" placeholder="Enter your email address" value="<?php echo htmlspecialchars($unsub_email, ENT_QUOTES, 'UTF-8'); ?>" required>
          </div>
        </div>

        <div class="sc_form_item sc_form_button" style="display:flex; justify-content:center;">
          <button class="sc_button sc_button_style_filled sc_button_size_medium" type="submit">
            <span class="overlay"><span class="first">Send unsubscribe link</span><span class="second">Send unsubscribe link</span></span></button>
        </div>

        <div style="font-size:14px; opacity:.9; text-align:center; margin-top:8px;">
          You will receive an email with a confirmation link to unsubscribe (valid for 24h).
        </div>
      </form>

    </div>
  </div>
</div>

<div class="sc_section sc_section_block aligncenter max_width cu_width-770" style="margin-top:25px;">
  <div class="sc_section_inner newsletter-block newsletter-block--alt">
    <hr class="newsletter-divider">
<h3 id="delete-form" class="sc_title sc_title_regular cu_mrg_5" style="font-size:24px;">Delete my data</h3>
        <?php if (!empty($success_msg) && $msg_target === 'delete'): ?>
            <div class="sc_infobox sc_infobox_style_success" style="margin: 15px 0 15px 0;">
                <?php echo htmlspecialchars($success_msg, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error_msg) && $msg_target === 'delete'): ?>
            <div class="sc_infobox sc_infobox_style_error" style="margin: 15px 0 15px 0;">
                <?php echo htmlspecialchars($error_msg, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

    <div class="sc_section_content_wrap">

      <form method="post" action="/en/Contact.php" class="sc_form sc_form_style_form_3" style="margin-top:10px;">
        <input type="hidden" name="action" value="delete_request">

        <div class="sc_form_info">
          <div class="sc_form_item sc_form_field label_over">
            <input type="email" name="del_email" placeholder="Enter your email address" value="<?php echo htmlspecialchars($del_email, ENT_QUOTES, 'UTF-8'); ?>" required>
          </div>
        </div>

        <div class="sc_form_item sc_form_button" style="display:flex; justify-content:center;">
          <button class="sc_button sc_button_style_filled sc_button_size_medium" type="submit">
            <span class="overlay"><span class="first">Send deletion link</span><span class="second">Send deletion link</span></span></button>
        </div>

        <div style="font-size:14px; opacity:.9; text-align:center; margin-top:8px;">
          You will receive an email with a confirmation link to delete your data (valid for 24h). This action is irreversible.
        </div>
      </form>

    </div>
  </div>
</div>
<!-- /NEWSLETTER: odjava i brisanje -->

<!-- kraj dodatka-->
                        </section>
                    </article>
                    
                </div>
            </div>
        </div>
       <?php include("footer.php") ?>
    </div>
</div>

<a href="#" class="scroll_to_top icon-up" title="Scroll to top"></a>

<script type='text/javascript' src='/js/vendor/jquery/jquery.js'></script>
<script type='text/javascript' src='/js/vendor/jquery/jquery-migrate.min.js'></script>
<script type='text/javascript' src='/js/vendor/modernizr.min.js'></script>
<script type='text/javascript' src='/js/custom/custom.js'></script>
<script type='text/javascript' src='/js/vendor/superfish.js'></script>
<script type='text/javascript' src='/js/vendor/jquery.slidemenu.js'></script>
<script type='text/javascript' src='/js/custom/core.utils.js'></script>
<script type='text/javascript' src='/js/custom/core.init.js'></script>
<script type='text/javascript' src='/js/custom/theme.init.js'></script>
<script type='text/javascript' src='/js/vendor/social-share.js'></script>
<script type='text/javascript' src='/js/custom/theme.shortcodes.js'></script>
<script type='text/javascript' src='/js/custom/core.messages.js'></script>
<script type='text/javascript' src='/js/vendor/grid.layout/grid.layout.min.js'></script>
<script type='text/javascript' src='/js/vendor/jquery/core.min.js'></script>

<script>
(function(){
  var iso = document.getElementById('datum_rodjenja_iso');
  var d = document.getElementById('dob_day');
  var m = document.getElementById('dob_month');
  var y = document.getElementById('dob_year');

  if(iso && iso.value && d && m && y){
    var parts = iso.value.split('-');
    if(parts.length === 3){
      y.value = parts[0] || '';
      m.value = parts[1] || '';
      d.value = parts[2] || '';
    }
  }

  function syncISO(){
    if(!iso || !d || !m || !y) return;
    if(d.value && m.value && y.value){
      iso.value = y.value + '-' + m.value + '-' + d.value;
    } else {
      iso.value = '';
    }
  }

  if(d) d.addEventListener('change', syncISO);
  if(m) m.addEventListener('change', syncISO);
  if(y) y.addEventListener('change', syncISO);

  // bind submit for the first (subscribe) form
  var subscribeForm = document.querySelector('form[action="/en/Contact.php"][method="post"] input[name="action"][value="subscribe"]');
  if(subscribeForm){
    var form = subscribeForm.closest('form');
    if(form) form.addEventListener('submit', function(){ syncISO(); });
  }
})();
</script>
<?php
// --- Toast notif (fallback) ---
// Prikazuje istu poruku kao u headeru prve forme (success/error), nezavisno od scroll-a.
$__toast_text = $success_msg !== '' ? $success_msg : $error_msg;
$__toast_type = $success_msg !== '' ? 'success' : 'error';
if ($__toast_text !== ''):
?>
<div id="bc-toast" class="bc-toast bc-toast-<?php echo $__toast_type; ?>" role="status" aria-live="polite" aria-atomic="true">
  <div class="bc-toast-body"><?php echo htmlspecialchars($__toast_text, ENT_QUOTES, 'UTF-8'); ?></div>
</div>

<style>
  .bc-toast{
    position: fixed;
    top: 20px;
    right: 20px;
    max-width: min(520px, calc(100vw - 40px));
    padding: 14px 16px;
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0,0,0,.25);
    z-index: 999999;
    opacity: 0;
    transform: translateY(-10px);
    transition: opacity .25s ease, transform .25s ease;
    font-size: 14px;
    line-height: 1.35;
  }
  .bc-toast.bc-show{ opacity: 1; transform: translateY(0); }
  .bc-toast-success{ background: #1f7a3a; color: #fff; }
  .bc-toast-error{ background: #b3261e; color: #fff; }
</style>

<script>
(function(){
  var t = document.getElementById('bc-toast');
  if(!t) return;
  // pokaži posle layout-a da bi tranzicija radila pouzdano
  requestAnimationFrame(function(){
    t.classList.add('bc-show');
    // auto-hide posle 3s
    window.setTimeout(function(){
      t.classList.remove('bc-show');
      window.setTimeout(function(){ if(t && t.parentNode) t.parentNode.removeChild(t); }, 350);
    }, 3000);
  });
})();
</script>
<?php endif; ?>
</body>

</html>