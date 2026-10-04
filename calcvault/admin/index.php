<?php
session_start();
require_once __DIR__ . '/../includes/functions.php';
if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(16));
$err = '';

if (isset($_GET['logout'])) { session_destroy(); header('Location: ./'); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    if (hash_equals(ADMIN_PASSWORD, (string)$_POST['password'])) { session_regenerate_id(true); $_SESSION['adm'] = 1; header('Location: ./'); exit; }
    sleep(1); $err = 'Wrong password.';
}
$in = !empty($_SESSION['adm']);
if ($in && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']) && hash_equals($_SESSION['csrf'], (string)($_POST['csrf'] ?? ''))) {
    delete_message((string)$_POST['delete']); header('Location: ./'); exit;
}
$page_title = 'Inbox'; $noindex = true;
include __DIR__ . '/../includes/header.php';
?>
<div class="adm">
<?php if (!$in): ?>
  <div class="panel" style="max-width:440px;margin:60px auto">
    <h1 style="font-size:1.8rem;margin-bottom:18px">Admin login</h1>
    <?php if ($err): ?><div class="alert err"><?= e($err) ?></div><?php endif; ?>
    <form method="post"><div class="field"><label for="pw">Password</label><input class="input" id="pw" type="password" name="password" required autofocus></div><button class="btn btn-p" style="width:100%">Log in</button></form>
  </div>
<?php else: $msgs = load_messages(); ?>
  <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:26px">
    <h1 style="font-size:2rem">Inbox <span class="pill"><?= count($msgs) ?></span></h1>
    <div style="display:flex;gap:8px"><a class="btn btn-p btn-sm" href="tools">Upload / manage tools</a><a class="btn btn-sm" href="?logout=1">Log out</a></div>
  </div>
  <?php if (!$msgs): ?><div class="msg"><p class="muted">No messages yet. They will appear here as soon as someone uses the contact form.</p></div><?php endif; ?>
  <?php foreach ($msgs as $m): ?>
    <div class="msg">
      <div class="msg-h"><div><strong><?= e($m['name']) ?></strong> &middot; <a href="mailto:<?= e($m['email']) ?>" style="color:var(--c)"><?= e($m['email']) ?></a><br><span class="muted"><?= e($m['date']) ?> &middot; <?= e($m['topic']) ?></span></div>
        <div style="display:flex;gap:8px"><a class="btn btn-sm" href="mailto:<?= e($m['email']) ?>?subject=<?= rawurlencode('Re: ' . $m['topic']) ?>">Reply</a>
        <form method="post" onsubmit="return confirm('Delete this message?')"><input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>"><button class="btn btn-sm" name="delete" value="<?= e($m['id']) ?>">Delete</button></form></div></div>
      <pre><?= e($m['message']) ?></pre>
    </div>
  <?php endforeach; ?>
<?php endif; ?>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
