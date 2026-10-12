<?php
require_once __DIR__ . '/../includes/functions.php';
$slug = preg_replace('/[^A-Za-z0-9_-]/', '', $_GET['slug'] ?? '');
$file = __DIR__ . '/' . $slug . '/index.html';
$tool = null;
foreach (get_tools() as $t) if ($t['slug'] === $slug) $tool = $t;
if ($slug === '' || $slug[0] === '_' || !$tool || !is_file($file)) { include ROOT . '/404.php'; exit; }

$html = file_get_contents($file);
$styles = '';
if (preg_match('~<head[^>]*>(.*?)</head>~is', $html, $m)) {            // keep the tool's own <style>, stylesheets and library scripts
    preg_match_all('~<style\b[^>]*>.*?</style>|<link\b[^>]*rel=["\']stylesheet["\'][^>]*>|<script\b[^>]*\bsrc=[^>]*>\s*</script>~is', $m[1], $mm);
    $styles = implode("\n", $mm[0]);
}
if (preg_match('~<body[^>]*>(.*)</body>~is', $html, $m)) $body = $m[1];
else $body = preg_replace('~<!DOCTYPE[^>]*>|</?html[^>]*>|<head\b.*?</head>~is', '', $html);

$page_title = $tool['name']; $page_desc = $tool['description'] ?: 'Free online tool: ' . $tool['name'];
$active = 'tools'; $head_extra = $styles;
include ROOT . '/includes/header.php';
?>
<div class="container tool-wrap">
  <nav class="crumbs"><a href="<?= BASE ?>/">Home</a> / <a href="<?= BASE ?>/tools/">Tools</a> / <?= e($tool['name']) ?></nav>
  <div class="tool-top">
    <div class="ico"><?= e($tool['icon']) ?></div>
    <div><h1><?= e($tool['name']) ?></h1><?php if ($tool['description']): ?><p><?= e($tool['description']) ?></p><?php endif; ?></div>
  </div>
  <div class="panel"><?= $body ?></div>
  <?php $more = more_tools($tool['slug']); if ($more): ?>
    <h2 style="font-size:1.6rem;margin:50px 0 22px">More tools you may like</h2>
    <div class="grid g3"><?php foreach ($more as $mt) echo tool_card($mt); ?></div>
  <?php endif; ?>
</div>
<?php include ROOT . '/includes/footer.php'; ?>
