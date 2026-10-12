<?php
require_once __DIR__ . '/../includes/functions.php';
$page_title = 'All Tools';
$page_desc  = 'Browse every free online tool in the CalcVault vault: calculators, converters and everyday utilities.';
$active = 'tools';
include __DIR__ . '/../includes/header.php';
$tools = get_tools(); $cats = array_keys(tools_by_category());
?>
<section class="phero">
  <div class="container">
    <span class="eyebrow"><i></i> <?= count($tools) ?> tool<?= count($tools) === 1 ? '' : 's' ?> in the vault</span>
    <h1><span class="grad">Browse the vault</span></h1>
    <p>Search by name or pick a category. Every tool is free, fast and works on any device.</p>
    <div class="search"><input class="input" id="toolSearch" type="search" placeholder="Search tools (e.g. percentage, BMI, loan)" aria-label="Search tools"></div>
  </div>
</section>
<section class="container" style="padding-bottom:60px">
  <?php if ($cats): ?>
  <div class="chips">
    <button class="chip-b on" data-cat="all">All</button>
    <?php foreach ($cats as $c): ?><button class="chip-b" data-cat="<?= e($c) ?>"><?= e($c) ?></button><?php endforeach; ?>
  </div>
  <?php endif; ?>
  <div class="grid g3">
    <?php foreach ($tools as $t) echo tool_card($t); ?>
  </div>
  <div class="empty" id="noRes" <?= $tools ? '' : 'style="display:block"' ?>>
    <h3>Nothing here yet</h3>
    <p style="margin-top:8px"><?= $tools ? 'No tools match your search. Try a different word or category.' : 'The first tools are being added soon.' ?> <a href="<?= BASE ?>/contact" style="color:var(--c)">Suggest a tool</a></p>
  </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
