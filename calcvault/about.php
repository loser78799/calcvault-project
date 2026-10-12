<?php
$page_title = 'About Us';
$page_desc  = 'Learn what CalcVault is, why we build free online tools, and the principles that guide everything we make.';
$active = 'about';
include __DIR__ . '/includes/header.php';
?>
<section class="phero">
  <div class="container">
    <span class="eyebrow"><i></i> About CalcVault</span>
    <h1><span class="grad">Small tools. Big relief.</span></h1>
    <p>CalcVault exists to take the friction out of everyday numbers, conversions and quick tasks, with tools that are fast, honest and a pleasure to use.</p>
  </div>
</section>

<section class="sec" style="padding-top:60px">
  <div class="container split">
    <div class="scene" style="height:380px" aria-hidden="true">
      <div class="stage" style="animation:none">
        <div class="ring r1"></div><div class="ring r2"></div>
        <div class="cube" style="width:150px;height:150px"><div class="face f1" style="transform:translateZ(75px)">C</div><div class="face f2" style="transform:rotateY(90deg) translateZ(75px)">V</div><div class="face f3" style="transform:rotateY(180deg) translateZ(75px)">&Sigma;</div><div class="face f4" style="transform:rotateY(-90deg) translateZ(75px)">%</div><div class="face f5" style="transform:rotateX(90deg) translateZ(75px)">+</div><div class="face f6" style="transform:rotateX(-90deg) translateZ(75px)">=</div></div>
      </div>
    </div>
    <div>
      <h2>Why we built the vault</h2>
      <p>Everyone has been there: you need a quick percentage, a loan estimate or a unit conversion, and the first result is a page full of pop-ups, auto-playing banners and a calculator buried at the bottom.</p>
      <p style="margin-top:14px">We thought it should be better. CalcVault is our answer: a growing collection of tools where the tool comes first. Clean layout, clear labels, instant results and a design you actually enjoy looking at.</p>
      <p style="margin-top:14px">Each tool is built carefully, tested on real devices and explained in plain language, so you know what the numbers mean and not only what they are.</p>
    </div>
  </div>
</section>

<section class="sec">
  <div class="container">
    <div class="sec-head"><h2>Our mission and vision</h2><p>Where we are headed and how we plan to get there.</p></div>
    <div class="grid g2">
      <div class="card"><div class="ico">🎯</div><h3>Mission</h3><p>Make everyday calculations and conversions effortless for everyone by offering free, accurate, privacy-respecting tools that load fast and work on any device.</p></div>
      <div class="card"><div class="ico">🔭</div><h3>Vision</h3><p>To become the most trusted and best-looking vault of online tools on the web: a place people bookmark because it saves them time, every time.</p></div>
    </div>
  </div>
</section>

<section class="sec">
  <div class="container">
    <div class="sec-head"><h2>What we stand for</h2><p>Four principles guide every tool we ship.</p></div>
    <div class="grid g4">
      <div class="card"><div class="ico">⚡</div><h3>Speed</h3><p>If a tool is slow, it is not finished. We keep pages light and results instant.</p></div>
      <div class="card"><div class="ico">🔒</div><h3>Privacy</h3><p>No accounts and no unnecessary tracking. Your inputs stay on your device.</p></div>
      <div class="card"><div class="ico">🧭</div><h3>Clarity</h3><p>Plain words, honest results and formulas explained where it helps.</p></div>
      <div class="card"><div class="ico">💎</div><h3>Craft</h3><p>Good design is part of usefulness. We sweat the details so you do not have to.</p></div>
    </div>
  </div>
</section>

<section class="sec">
  <div class="container">
    <div class="sec-head"><h2>What you will find here</h2><p>The vault is organised into focused categories, with more arriving all the time.</p></div>
    <div class="grid g3">
      <div class="card"><div class="ico">🧮</div><h3>Calculators</h3><p>Percentages, loans, discounts, averages and other everyday math made simple.</p></div>
      <div class="card"><div class="ico">🔁</div><h3>Converters</h3><p>Units, currencies, dates and formats converted quickly and accurately.</p></div>
      <div class="card"><div class="ico">🛠️</div><h3>Utilities</h3><p>Text helpers, generators and small developer and design tools for daily tasks.</p></div>
    </div>
  </div>
</section>

<section class="sec">
  <div class="container">
    <div class="sec-head"><h2>The road ahead</h2><p>CalcVault is young and moving fast. Here is how we think about the journey.</p></div>
    <div class="tl">
      <div class="tl-i"><h3>The vault opens</h3><p>We launch with a clean foundation, a beautiful design and our first set of tools.</p></div>
      <div class="tl-i"><h3>The library grows</h3><p>New calculators, converters and utilities arrive regularly across every category.</p></div>
      <div class="tl-i"><h3>Smarter and richer tools</h3><p>We add saved results, shareable links and deeper explanations to the tools that benefit most.</p></div>
      <div class="tl-i"><h3>Built with you</h3><p>Your messages shape the roadmap. The most requested tools get built first.</p></div>
    </div>
  </div>
</section>

<section class="sec">
  <div class="container">
    <div class="stats">
      <div class="stat"><b><span data-count="100">0</span>%</b><span>Free to use</span></div>
      <div class="stat"><b data-count="0">0</b><span>Accounts needed</span></div>
      <div class="stat"><b><span data-count="8">0</span></b><span>Categories planned</span></div>
      <div class="stat"><b>&infin;</b><span>Room to grow</span></div>
    </div>
  </div>
</section>

<section class="sec">
  <div class="container">
    <div class="cta">
      <h2>Have an idea? <span class="grad">Let us hear it.</span></h2>
      <p>Whether it is a tool request, a bug report or a hello, we read every message.</p>
      <div class="hero-btns" style="justify-content:center;margin:0"><a class="btn btn-p" href="<?= BASE ?>/contact">Contact us</a><a class="btn" href="<?= BASE ?>/tools/">Explore tools</a></div>
    </div>
  </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
