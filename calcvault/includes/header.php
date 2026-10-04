<?php
require_once __DIR__ . '/functions.php';
$title   = isset($page_title) ? $page_title . ' | ' . SITE_NAME : SITE_NAME . ' - ' . SITE_TAGLINE;
$desc    = $page_desc ?? 'CalcVault is a growing vault of free online calculators, converters and everyday tools. Fast, private and no sign-up.';
$active  = $active ?? '';
$noindex = $noindex ?? false;
$canon   = SITE_URL . strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
$cats    = tools_by_category();
$B       = BASE;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($title) ?></title>
<meta name="description" content="<?= e($desc) ?>">
<meta name="theme-color" content="#04040a">
<?php if ($noindex): ?><meta name="robots" content="noindex,nofollow"><?php endif; ?>
<link rel="canonical" href="<?= e($canon) ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= e(SITE_NAME) ?>">
<meta property="og:title" content="<?= e($title) ?>">
<meta property="og:description" content="<?= e($desc) ?>">
<meta property="og:url" content="<?= e($canon) ?>">
<meta name="twitter:card" content="summary">
<link rel="icon" type="image/svg+xml" href="<?= $B ?>/assets/img/favicon.svg">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= $B ?>/assets/css/style.css?v=1">
<script>document.documentElement.classList.add('js')</script>
<?php include __DIR__ . '/head-extra.php'; ?>
<?= $head_extra ?? '' ?>
</head>
<body>
<div class="bg-fx" aria-hidden="true"><i class="blob b1"></i><i class="blob b2"></i><i class="blob b3"></i></div>

<header class="hdr">
  <div class="container nav">
    <a class="logo" href="<?= $B ?>/" aria-label="<?= e(SITE_NAME) ?> home">
      <span class="logo-mark"><?= logo_svg('lgh') ?></span><span>Calc<b class="grad">Vault</b></span>
    </a>
    <button class="burger" aria-label="Toggle menu" aria-expanded="false"><span></span><span></span><span></span></button>
    <ul class="menu">
      <li><a href="<?= $B ?>/" class="<?= $active==='home'?'active':'' ?>">Home</a></li>
      <li class="has-dd">
        <button class="dd-btn <?= $active==='tools'?'active':'' ?>" aria-haspopup="true">Tools <svg width="12" height="12" viewBox="0 0 12 12"><path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.8" fill="none" stroke-linecap="round"/></svg></button>
        <div class="dd">
          <?php if (!$cats): ?>
            <p class="dd-empty">Tools are on the way. Check back soon.</p>
          <?php else: foreach ($cats as $cat => $list): ?>
            <span class="dd-cat"><?= e($cat) ?></span>
            <?php foreach ($list as $t): ?>
              <a class="dd-item" href="<?= e($t['url']) ?>"><span class="dd-ico"><?= e($t['icon']) ?></span><span><strong><?= e($t['name']) ?></strong><small><?= e(mb_strimwidth($t['description'], 0, 52, '…')) ?></small></span></a>
            <?php endforeach; endforeach; endif; ?>
          <a class="dd-all" href="<?= $B ?>/tools/">Browse all tools &rarr;</a>
        </div>
      </li>
      <li><a href="<?= $B ?>/about" class="<?= $active==='about'?'active':'' ?>">About</a></li>
      <li><a href="<?= $B ?>/contact" class="<?= $active==='contact'?'active':'' ?>">Contact</a></li>
      <li class="menu-cta"><a class="btn btn-p btn-sm" href="<?= $B ?>/tools/">Explore tools</a></li>
    </ul>
  </div>
</header>
<main>
