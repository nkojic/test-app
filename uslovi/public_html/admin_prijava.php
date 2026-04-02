<?php
/**
 * admin_prijava.php
 * - Login (auth: username/userpass iz /secure/db_config.php)
 * - Prikaz tabele "kontakti" (READ) sa sortiranjem + paginacijom (30 po strani)
 * - Slanje emaila preko SMTP (PHPMailer) ka selektovanim kontaktima (checkbox u prvoj koloni)
 *
 * Preduslov (bez composer-a):
 * public_html/phpmailer/src/{PHPMailer.php,SMTP.php,Exception.php}
 */

declare(strict_types=1);
session_start();

/* ---------------- PHPMailer (ZIP varijanta) ---------------- */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/phpmailer/src/Exception.php';
require __DIR__ . '/phpmailer/src/PHPMailer.php';
require __DIR__ . '/phpmailer/src/SMTP.php';

/* ---------------- SMTP SETTINGS ---------------- */
const SMTP_HOST = 'mail.bowencentar.rs';
const SMTP_PORT = 465;
const SMTP_USER = 'office@bowencentar.rs';
const SMTP_FROM_NAME = 'Bowen Centar';

// SMTP lozinka se čita iz /secure/db_config.php (ključ: mailpass)
$SMTP_PASS = '';

/* ---------------- HELPERS ---------------- */
function h(?string $s): string {
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}
function safe_equals(string $a, string $b): bool {
    return function_exists('hash_equals') ? hash_equals($a, $b) : ($a === $b);
}
function load_config(): array {
    $configPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'secure' . DIRECTORY_SEPARATOR . 'db_config.php';
    if (!is_file($configPath)) return ['error' => 'Konfiguracioni fajl nije pronađen (secure/db_config.php).'];
    $cfg = require $configPath;
    if (!is_array($cfg)) return ['error' => 'Konfiguracioni fajl nije vratio niz (array).'];
    foreach (['host','name','user','pass','charset','username','userpass','mailpass'] as $k) {
        if (!array_key_exists($k, $cfg)) return ['error' => "U konfiguraciji nedostaje ključ: {$k}."];
    }
    return [
        'db' => [
            'host'    => (string)$cfg['host'],
            'name'    => (string)$cfg['name'],
            'user'    => (string)$cfg['user'],
            'pass'    => (string)$cfg['pass'],
            'charset' => (string)$cfg['charset'],
        ],
        'auth_user' => (string)$cfg['username'],
        'auth_pass' => (string)$cfg['userpass'],
        'mail_pass' => (string)$cfg['mailpass'],
        'error'     => null,
    ];
}
function db_pdo(array $dbCfg): PDO {
    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', $dbCfg['host'], $dbCfg['name'], $dbCfg['charset']);
    return new PDO($dsn, $dbCfg['user'], $dbCfg['pass'], [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
}
function build_query(array $overrides = []): string {
    $q = array_merge($_GET, $overrides);
    foreach ($q as $k => $v) { if ($v === null) unset($q[$k]); }
    return '?' . http_build_query($q);
}

/* ---------------- INIT ---------------- */
$config   = load_config();
$cfgError = $config['error'] ?? null;

// SMTP lozinka (mailbox) – iz konfiguracije (userpass)
$SMTP_PASS = (string)($config['mail_pass'] ?? '');


$loginError       = '';
$emailStatus      = '';
$emailStatusType  = 'ok';

// Anti-duplikat token za slanje mejla (sprečava višestruki submit)
if (empty($_SESSION['mail_token'])) {
    $_SESSION['mail_token'] = bin2hex(random_bytes(16));
}

// Flash poruka (posle PRG redirect-a)
if (!empty($_SESSION['flash_emailStatus'])) {
    $emailStatus = (string)$_SESSION['flash_emailStatus'];
    $emailStatusType = (string)($_SESSION['flash_emailStatusType'] ?? 'ok');
    unset($_SESSION['flash_emailStatus'], $_SESSION['flash_emailStatusType']);
}

/* ---------------- LOGOUT ---------------- */
if (isset($_GET['logout'])) {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], (bool)$p['secure'], (bool)$p['httponly']);
    }
    session_destroy();
    header('Location: admin_prijava.php');
    exit;
}

/* ---------------- LOGIN ---------------- */
if (!$cfgError && $_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'login') {
    $inUser = trim((string)($_POST['username'] ?? ''));
    $inPass = (string)($_POST['password'] ?? '');

    if ($inUser === '' || $inPass === '') {
        $loginError = 'Unesite i korisničko ime i lozinku.';
    } else {
        if (safe_equals($inUser, $config['auth_user']) && safe_equals($inPass, $config['auth_pass'])) {
            $_SESSION['auth'] = true;
            if (function_exists('session_regenerate_id')) session_regenerate_id(true);
            header('Location: admin_prijava.php');
            exit;
        } else {
            $loginError = 'Pogrešan username ili password.';
        }
    }
}
$authorized = (!empty($_SESSION['auth']) && $_SESSION['auth'] === true);

/* ---------------- TABLE PARAMS ---------------- */
$allowedCols = ['id','ime','prezime','email','datum_rodjenja','newsletter','created_at'];
$sort  = $_GET['sort']  ?? 'id';
$order = $_GET['order'] ?? 'ASC';
if (!in_array($sort, $allowedCols, true)) $sort = 'id';
$order = strtoupper((string)$order) === 'DESC' ? 'DESC' : 'ASC';
$page    = max(1, (int)($_GET['page'] ?? 1));
$perPage = 30;
$offset  = ($page - 1) * $perPage;

/* ---------------- READ + SEND MAIL ---------------- */
$data  = [];
$total = 0;

if ($authorized && !$cfgError) {
    $pdo = db_pdo($config['db']);
    $total = (int)$pdo->query("SELECT COUNT(*) FROM kontakti")->fetchColumn();

    $stmt = $pdo->prepare("SELECT id, ime, prezime, email, datum_rodjenja, newsletter, created_at
                           FROM kontakti
                           ORDER BY $sort $order
                           LIMIT :lim OFFSET :off");
    $stmt->bindValue(':lim', $perPage, PDO::PARAM_INT);
    $stmt->bindValue(':off', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'send_mail') {
        $postedToken = (string)($_POST['mail_token'] ?? '');
        $sessionToken = (string)($_SESSION['mail_token'] ?? '');
        if ($postedToken === '' || $sessionToken === '' || !hash_equals($sessionToken, $postedToken)) {
            $emailStatusType = 'err';
            $emailStatus = 'Forma je već poslata ili je istekla. Osvežite stranicu i pokušajte ponovo.';
            // PRG redirect sa flash porukom
            $_SESSION['flash_emailStatus'] = $emailStatus;
            $_SESSION['flash_emailStatusType'] = $emailStatusType;
            header('Location: ' . build_query());
            exit;
        }
        // Rotiraj token odmah da spreči duple zahteve (double-click / refresh)
        $_SESSION['mail_token'] = bin2hex(random_bytes(16));


        $subject = trim((string)($_POST['subject'] ?? ''));
        $body    = trim((string)($_POST['body'] ?? ''));
        $recips  = $_POST['recipients'] ?? [];
        if (!is_array($recips)) $recips = [];

        $emails = [];
        foreach ($recips as $e) {
            $e = trim((string)$e);
            if ($e !== '' && filter_var($e, FILTER_VALIDATE_EMAIL)) $emails[] = $e;
        }
        $emails = array_values(array_unique($emails));

        if (count($emails) === 0) {
            $emailStatusType = 'err';
            $emailStatus = 'Niste izabrali nijednog primaoca (čekirajte bar jedan kontakt).';
        } elseif ($subject === '' || $body === '') {
            $emailStatusType = 'err';
            $emailStatus = 'Unesite i subject i tekst mejla.';
        } elseif ($SMTP_PASS === '') {
            $emailStatusType = 'err';
            $emailStatus = 'SMTP lozinka nije podešena (čita se iz secure/db_config.php, ključ: mailpass).';
        } else {
            $sent = 0; $failed = 0;

            foreach ($emails as $to) {
                $mail = new PHPMailer(true);
                try {
                    $mail->CharSet = 'UTF-8';
                    $mail->isSMTP();
                    $mail->Host       = SMTP_HOST;
                    $mail->SMTPAuth   = true;
                    $mail->Username   = SMTP_USER;
                    $mail->Password   = $SMTP_PASS;
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port       = SMTP_PORT;

                    $mail->setFrom(SMTP_USER, SMTP_FROM_NAME);
                    $mail->addReplyTo(SMTP_USER, SMTP_FROM_NAME);
                    $mail->addAddress($to);

                    $mail->isHTML(true);
                    $mail->Encoding = 'base64';

                    // Ako je korisnik uneo HTML, koristi ga kao fragment; u suprotnom, pretvori tekst u HTML.
                    $isHtml = (bool)preg_match('/<\s*(p|br|div|span|table|tr|td|html|body|a|strong|em|ul|ol|li)\b/i', $body);
                    if ($isHtml) {
                        $contentHtml = $body;
                        $plainText = trim(strip_tags($body));
                    } else {
                        $safe = htmlspecialchars($body, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                        $contentHtml = nl2br($safe);
                        $plainText = $body;
                    }

                    // Minimalni "Outlook-friendly" HTML wrapper
                    $htmlBody = '<!doctype html><html><head><meta charset="utf-8"></head><body style="margin:0;padding:0;background:#ffffff;">'
                        . '<div style="font-family:Arial,Helvetica,sans-serif;font-size:14px;line-height:1.5;color:#222;padding:16px;">'
                        . $contentHtml
                        . '<div style="margin-top:16px;font-size:12px;color:#666;">Bowen Centar</div>'
                        . '</div></body></html>';

                    $mail->Subject = $subject;
                    $mail->Body    = $htmlBody;
                    $mail->AltBody = $plainText;

                    $mail->send();
                    $sent++;
                } catch (Exception $e) {
                    $failed++;
                    error_log('PHPMailer error to ' . $to . ': ' . $mail->ErrorInfo);
                }
            }

            if ($sent > 0 && $failed === 0) {
                $emailStatusType = 'ok';
                $emailStatus = "Mejl uspešno poslat na: {$sent} primaoca.";
            } elseif ($sent > 0 && $failed > 0) {
                $emailStatusType = 'err';
                $emailStatus = "Delimično poslato: uspešno {$sent}, neuspešno {$failed}.";
            } else {
                $emailStatusType = 'err';
                $emailStatus = "Slanje nije uspelo (proverite SMTP parametre/lozinku).";
            }
        }
        // PRG: flash poruka + redirect (sprečava resubmit na refresh)
        $_SESSION['flash_emailStatus'] = $emailStatus;
        $_SESSION['flash_emailStatusType'] = $emailStatusType;
        header('Location: ' . build_query());
        exit;
    }
}
?>
<!doctype html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin</title>
    <style>
        *,*::before,*::after{box-sizing:border-box}
        body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;background:#f5f5f5;margin:0}
        .wrap{max-width:1200px;margin:40px auto;padding:0 16px}
        .card{background:#fff;border:1px solid #ddd;border-radius:12px;padding:20px;box-shadow:0 2px 10px rgba(0,0,0,.04)}
        h1,h2{margin:0 0 16px}
        label{display:block;font-size:14px;margin:12px 0 6px}
        input,textarea{width:100%;display:block;max-width:100%;padding:10px 12px;border:1px solid #ccc;border-radius:10px;font-size:14px}
        textarea{min-height:220px;resize:vertical}
        button{margin-top:14px;width:100%;padding:10px 12px;border:0;border-radius:10px;background:#111;color:#fff;font-size:14px;cursor:pointer}
        button:hover{opacity:.92}
        .msg{margin-top:12px;font-size:14px}
        .err{color:#b00020}
        .ok{color:#0b6b0b}
        .topbar{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:14px}
        .logout{font-size:14px;text-decoration:none;color:#111}
        .layout{display:flex;gap:16px;align-items:flex-start}
        .left{flex: 1 1 70%}
        .right{flex: 0 0 340px}
        @media (max-width: 980px){ .layout{flex-direction:column} .right{flex:1 1 auto} }
        table{width:100%;border-collapse:collapse}
        th,td{padding:10px 8px;border-bottom:1px solid #eee;text-align:left;vertical-align:top;font-size:14px}
        th a{text-decoration:none;color:#111}
        th a:hover{text-decoration:underline}
        .pagination{margin-top:14px;display:flex;flex-wrap:wrap;gap:6px}
        .pagination a{display:inline-block;padding:6px 10px;border:1px solid #ddd;border-radius:8px;text-decoration:none;color:#111;background:#fafafa;font-size:14px}
        .pagination a.active{background:#111;color:#fff;border-color:#111}
        .hint{font-size:12px;color:#666;margin-top:8px}
        .chk{width:18px;height:18px}
        .muted{color:#666;font-size:13px}
        .smallcard{background:#fafafa;border:1px solid #eee;border-radius:12px;padding:14px}
        .smallcard h3{margin:0 0 10px;font-size:16px}
    </style>
</head>
<body>
<div class="wrap">
    <div class="card">
        <?php if (!$authorized): ?>
            <h1>Admin prijava</h1>

            <?php if ($cfgError): ?>
                <div class="msg err"><?= h($cfgError) ?></div>
            <?php endif; ?>

            <?php if ($loginError): ?>
                <div class="msg err"><?= h($loginError) ?></div>
            <?php endif; ?>

            <form method="post" action="admin_prijava.php" autocomplete="off">
                <input type="hidden" name="action" value="login">
                <label for="username">Username</label>
                <input id="username" name="username" type="text" required>

                <label for="password">Password</label>
                <input id="password" name="password" type="password" required>

                <button type="submit" <?= $cfgError ? 'disabled' : '' ?>>Prijava</button>
            </form>
        <?php else: ?>

            <div class="topbar">
                <h2>Kontakti</h2>
                <a class="logout" href="<?= h(build_query(['logout' => 1])) ?>">Logout</a>
            </div>

            <form method="post" action="<?= h(build_query()) ?>">
                <input type="hidden" name="action" value="send_mail">
                <input type="hidden" name="mail_token" value="<?= h((string)($_SESSION['mail_token'] ?? '')) ?>">

                <div class="layout">
                    <div class="left">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width:42px;">
                                        <input class="chk" type="checkbox" id="check_all" onclick="toggleAll(this)">
                                    </th>
                                    <?php
                                    $cols = $data[0] ?? null;
                                    if (is_array($cols)) {
                                        foreach (array_keys($cols) as $col) {
                                            $nextOrder = ($sort === $col && $order === 'ASC') ? 'DESC' : 'ASC';
                                            $link = build_query(['sort' => $col, 'order' => $nextOrder]);
                                            echo '<th><a href="'.h($link).'">'.h($col).'</a></th>';
                                        }
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($data) === 0): ?>
                                    <tr><td colspan="99">Nema podataka.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($data as $row): ?>
                                        <tr>
                                            <td><input class="chk" type="checkbox" name="recipients[]" value="<?= h((string)($row['email'] ?? '')) ?>"></td>
                                            <?php foreach ($row as $v): ?>
                                                <td><?= h((string)$v) ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <?php $pages = (int)ceil($total / $perPage); if ($pages < 1) $pages = 1; ?>
                        <div class="pagination">
                            <?php for ($i = 1; $i <= $pages; $i++): ?>
                                <?php $plink = build_query(['page' => $i]); ?>
                                <a class="<?= $i === $page ? 'active' : '' ?>" href="<?= h($plink) ?>"><?= $i ?></a>
                            <?php endfor; ?>
                        </div>

                        <div class="hint">Prikaz: <?= (int)$perPage ?> po strani • Ukupno: <?= (int)$total ?></div>
                    </div>

                    <div class="right">
                        <div class="smallcard">
                            <h3>Slanje mejla</h3>

                            <?php if ($emailStatus): ?>
                                <div class="msg <?= $emailStatusType === 'err' ? 'err' : 'ok' ?>"><?= h($emailStatus) ?></div>
                            <?php endif; ?>

                            <label for="subject">Subject</label>
                            <input id="subject" name="subject" type="text" placeholder="Naslov mejla">

                            <label for="body">Tekst mejla</label>
                            <textarea id="body" name="body" placeholder="Unesite tekst mejla..."></textarea>

                            <button type="submit">Pošalji mejl izabranim kontaktima</button>
                            <div class="hint">Označite primaoce u tabeli (checkbox u prvoj koloni).</div>
                        </div>
                    </div>
                </div>
            </form>

            <script>
                // Spreči dupli submit
                (function(){
                    const form = document.querySelector('form input[name="action"][value="send_mail"]')?.closest('form');
                    if(form){
                        form.addEventListener('submit', function(){
                            const btn = form.querySelector('button[type="submit"]');
                            if(btn){ btn.disabled = true; btn.textContent = 'Šaljem...'; }
                        });
                    }
                })();

                function toggleAll(master){
                    const boxes = document.querySelectorAll('input[name="recipients[]"]');
                    for(const b of boxes){ b.checked = master.checked; }
                }
            </script>

        <?php endif; ?>
    </div>
</div>
</body>
</html>
