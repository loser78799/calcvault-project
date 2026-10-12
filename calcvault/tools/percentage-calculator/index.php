<?php
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

  <div class="panel">
    <div class="tabs" id="tabs">
      <button class="chip-b on" data-m="1">X% of Y</button>
      <button class="chip-b" data-m="2">X is what % of Y</button>
      <button class="chip-b" data-m="3">% change</button>
    </div>
    <div class="row">
      <div class="field"><label for="x" id="lx">Percentage (X)</label><input class="input" id="x" type="number" step="any" value="15"></div>
      <div class="field"><label for="y" id="ly">Number (Y)</label><input class="input" id="y" type="number" step="any" value="200"></div>
    </div>
    <div class="result"><small id="rl">Result</small><strong id="out">30</strong><small id="note" style="margin-top:6px"></small></div>
  </div>

  <div class="tool-body">
    <h2>How the percentage calculator works</h2>
    <p>Pick one of the three modes, enter your two numbers and the answer updates instantly. Nothing is sent anywhere; the math runs in your browser.</p>
    <ul>
      <li><strong>X% of Y:</strong> multiply Y by X and divide by 100. Example: 15% of 200 = 30.</li>
      <li><strong>X is what % of Y:</strong> divide X by Y and multiply by 100. Example: 30 is 15% of 200.</li>
      <li><strong>Percentage change:</strong> subtract the old value from the new value, divide by the old value and multiply by 100.</li>
    </ul>
    <h2>Handy uses</h2>
    <p>Work out discounts while shopping, tips at a restaurant, exam scores, price increases, tax amounts and growth between two numbers.</p>
  </div>

  <?php $more = more_tools($tool['slug']); if ($more): ?>
    <h2 style="font-size:1.6rem;margin:50px 0 22px">More tools you may like</h2>
    <div class="grid g3"><?php foreach ($more as $m) echo tool_card($m); ?></div>
  <?php endif; ?>
</div>
<script>
(function(){
  var mode = 1, $ = function(i){ return document.getElementById(i); };
  var labels = {1:['Percentage (X)','Number (Y)','X% of Y'], 2:['Number (X)','Total (Y)','X is what % of Y'], 3:['Old value','New value','Percentage change']};
  var fmt = function(n){ return isFinite(n) ? (Math.round(n * 1e6) / 1e6).toLocaleString(undefined, {maximumFractionDigits: 6}) : '-'; };
  function calc(){
    var x = parseFloat($('x').value), y = parseFloat($('y').value), r, note = '';
    if (isNaN(x) || isNaN(y)) { $('out').textContent = '-'; $('note').textContent = ''; return; }
    if (mode === 1) { r = x * y / 100; $('out').textContent = fmt(r); note = x + '% of ' + y + ' = ' + fmt(r); }
    if (mode === 2) { r = y === 0 ? NaN : x / y * 100; $('out').textContent = isFinite(r) ? fmt(r) + '%' : '-'; note = isFinite(r) ? x + ' is ' + fmt(r) + '% of ' + y : 'Y cannot be zero'; }
    if (mode === 3) { r = x === 0 ? NaN : (y - x) / Math.abs(x) * 100; $('out').textContent = isFinite(r) ? (r > 0 ? '+' : '') + fmt(r) + '%' : '-'; note = isFinite(r) ? (r >= 0 ? 'An increase of ' : 'A decrease of ') + fmt(Math.abs(r)) + '%' : 'Old value cannot be zero'; }
    $('note').textContent = note;
  }
  document.querySelectorAll('#tabs button').forEach(function(b){
    b.addEventListener('click', function(){
      document.querySelectorAll('#tabs button').forEach(function(o){ o.classList.remove('on'); });
      b.classList.add('on'); mode = +b.dataset.m;
      $('lx').textContent = labels[mode][0]; $('ly').textContent = labels[mode][1]; $('rl').textContent = labels[mode][2];
      calc();
    });
  });
  $('x').addEventListener('input', calc); $('y').addEventListener('input', calc); calc();
})();
</script>
<?php include ROOT . '/includes/footer.php'; ?>
