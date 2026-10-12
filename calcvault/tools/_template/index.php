<?php
/* TOOL TEMPLATE - copy this whole folder, rename it (e.g. "bmi-calculator"), edit tool.json
   and replace the marked sections below. The tool appears in the header, homepage,
   footer, Tools page and sitemap automatically. Folders starting with "_" are ignored. */
require_once __DIR__ . '/../../includes/functions.php';
$tool       = current_tool(__DIR__);
$page_title = $tool['name'];
$page_desc  = $tool['description'];
$active     = 'tools';
include ROOT . '/includes/header.php';
?>
<div class="container tool-wrap">
  <nav class="crumbs"><a href="<?= BASE ?>/">Home</a> / <a href="<?= BASE ?>/tools/">Tools</a> / <?= e($tool['name']) ?></nav>
  <div class="tool-top">
    <div class="ico"><?= e($tool['icon']) ?></div>
    <div><h1><?= e($tool['name']) ?></h1><p><?= e($tool['description']) ?></p></div>
  </div>

  <!-- ====== 1. YOUR TOOL GOES HERE ====== -->
  <div class="panel">
    <div class="row">
      <div class="field"><label for="a">Input A</label><input class="input" id="a" type="number" value="10"></div>
      <div class="field"><label for="b">Input B</label><input class="input" id="b" type="number" value="5"></div>
    </div>
    <div class="result"><small>Result</small><strong id="out">15</strong></div>
  </div>
  <script>
    const a = document.getElementById('a'), b = document.getElementById('b'), out = document.getElementById('out');
    function calc(){ out.textContent = (parseFloat(a.value) || 0) + (parseFloat(b.value) || 0); }
    a.addEventListener('input', calc); b.addEventListener('input', calc); calc();
  </script>

  <!-- ====== 2. SEO TEXT: explain the tool (helps Google rank it) ====== -->
  <div class="tool-body">
    <h2>About this tool</h2>
    <p>Describe what the tool does, how to use it and the formula behind it.</p>
  </div>

  <!-- ====== 3. MORE TOOLS (automatic, keep as is) ====== -->
  <?php $more = more_tools($tool['slug']); if ($more): ?>
    <h2 style="font-size:1.6rem;margin:50px 0 22px">More tools you may like</h2>
    <div class="grid g3"><?php foreach ($more as $m) echo tool_card($m); ?></div>
  <?php endif; ?>
</div>
<?php include ROOT . '/includes/footer.php'; ?>
