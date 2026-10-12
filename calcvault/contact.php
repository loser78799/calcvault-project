<?php
session_start();
require_once __DIR__ . '/includes/functions.php';

$topics = ['General question', 'Suggest a new tool', 'Report a bug or wrong result', 'Business or partnership', 'Privacy or legal', 'Something else'];
$errors = []; $old = ['name' => '', 'email' => '', 'topic' => $topics[0], 'message' => ''];
$sent = isset($_GET['sent']);

if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(16));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $k => $_) $old[$k] = trim((string)($_POST[$k] ?? ''));
    $old['name']  = trim(preg_replace('/[\r\n]+/', ' ', $old['name']));
    $old['email'] = trim(preg_replace('/[\r\n]+/', '', $old['email']));

    if (!hash_equals($_SESSION['csrf'], (string)($_POST['csrf'] ?? ''))) $errors[] = 'Your session expired. Please reload the page and try again.';
    if (!empty($_POST['website'])) { header('Location: ' . BASE . '/contact?sent=1'); exit; }          // honeypot: bots get a fake success
    if (time() - (int)($_SESSION['form_time'] ?? 0) < 3) $errors[] = 'That was very fast. Please try again.';
    if (time() - (int)($_SESSION['last_sent'] ?? 0) < 60) $errors[] = 'Please wait a minute before sending another message.';
    if (mb_strlen($old['name']) < 2 || mb_strlen($old['name']) > 80) $errors[] = 'Please enter your name (2 to 80 characters).';
    if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL) || mb_strlen($old['email']) > 120) $errors[] = 'Please enter a valid email address.';
    if (!in_array($old['topic'], $topics, true)) $old['topic'] = $topics[0];
    if (mb_strlen($old['message']) < 10 || mb_strlen($old['message']) > 3000) $errors[] = 'Your message should be between 10 and 3000 characters.';

    if (!$errors) {
        $rec = ['id' => bin2hex(random_bytes(8)), 'date' => date('Y-m-d H:i:s'), 'name' => $old['name'], 'email' => $old['email'],
                'topic' => $old['topic'], 'message' => $old['message'], 'ip' => $_SERVER['REMOTE_ADDR'] ?? ''];
        $saved = save_message($rec);                                   // 1) stored in data/messages.json (view at /admin/)
        $body  = "New message from the " . SITE_NAME . " contact form\n\nName: {$rec['name']}\nEmail: {$rec['email']}\nTopic: {$rec['topic']}\nDate: {$rec['date']}\n\n{$rec['message']}\n";
        $hdrs  = "From: " . SITE_NAME . " <" . MAIL_FROM . ">\r\nReply-To: {$rec['email']}\r\nContent-Type: text/plain; charset=UTF-8\r\n";
        $mailed = @mail(CONTACT_EMAIL, '[' . SITE_NAME . '] ' . $rec['topic'] . ' - ' . $rec['name'], $body, $hdrs);   // 2) emailed to you
        if ($saved || $mailed) {
            $_SESSION['last_sent'] = time(); $_SESSION['csrf'] = bin2hex(random_bytes(16));
            header('Location: ' . BASE . '/contact?sent=1'); exit;
        }
        $errors[] = 'Sorry, we could not deliver your message right now. Please try again later.';
    }
}
$_SESSION['form_time'] = time();

$page_title = 'Contact Us';
$page_desc  = 'Questions, bug reports or tool ideas? Send CalcVault a message. We read every one.';
$active = 'contact';
include __DIR__ . '/includes/header.php';
?>
<section class="phero">
  <div class="container">
    <span class="eyebrow"><i></i> We read every message</span>
    <h1><span class="grad">Let's talk</span></h1>
    <p>Got a question, found a bug or want a new tool? Drop us a note and we will get back to you.</p>
  </div>
</section>

<section class="container" style="padding:40px 0 100px">
  <div class="contact-grid">
    <div class="info-list">
      <div class="card info"><div class="ico">💡</div><div><h3>Suggest a tool</h3><p>Tell us what you wish existed. Popular ideas get built first.</p></div></div>
      <div class="card info"><div class="ico">🐞</div><div><h3>Report a problem</h3><p>Include the tool name and the numbers you entered so we can reproduce it.</p></div></div>
      <div class="card info"><div class="ico">🤝</div><div><h3>Partnerships</h3><p>Interested in working together? Choose "Business or partnership" in the form.</p></div></div>
      <div class="card info"><div class="ico">⏱️</div><div><h3>Response time</h3><p>We aim to reply within two to three working days.</p></div></div>
    </div>

    <div class="panel">
      <h2 style="font-size:1.7rem;margin-bottom:6px">Send us a message</h2>
      <p class="muted" style="margin-bottom:24px">All fields are required.</p>
      <?php if ($sent): ?><div class="alert ok">Thank you! Your message is on its way to us. We will reply to your email soon.</div><?php endif; ?>
      <?php if ($errors): ?><div class="alert err">Please fix the following:<ul><?php foreach ($errors as $er) echo '<li>' . e($er) . '</li>'; ?></ul></div><?php endif; ?>
      <form method="post" action="<?= BASE ?>/contact" novalidate>
        <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
        <div class="hp" aria-hidden="true"><label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
        <div class="row">
          <div class="field"><label for="name">Your name</label><input class="input" id="name" name="name" maxlength="80" value="<?= e($old['name']) ?>" autocomplete="name" required></div>
          <div class="field"><label for="email">Email address</label><input class="input" id="email" type="email" name="email" maxlength="120" value="<?= e($old['email']) ?>" autocomplete="email" required></div>
        </div>
        <div class="field"><label for="topic">Topic</label>
          <select class="input" id="topic" name="topic"><?php foreach ($topics as $t): ?><option <?= $old['topic'] === $t ? 'selected' : '' ?>><?= e($t) ?></option><?php endforeach; ?></select></div>
        <div class="field"><label for="message">Message</label><textarea class="input" id="message" name="message" maxlength="3000" required><?= e($old['message']) ?></textarea></div>
        <button class="btn btn-p" type="submit" style="width:100%">Send message</button>
        <p class="muted" style="font-size:.85rem;margin-top:14px">By sending this form you agree to our <a href="<?= BASE ?>/privacy-policy" style="color:var(--c)">privacy policy</a>.</p>
      </form>
    </div>
  </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
