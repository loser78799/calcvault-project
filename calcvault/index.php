<?php
$page_desc = 'CalcVault is a growing vault of free online calculators, converters and everyday tools. Fast, private, mobile friendly and no sign-up needed.';
$active = 'home';
include __DIR__ . '/includes/header.php';
$tools = get_tools();
$featured = array_slice($tools, 0, 6);
$soon = max(0, 3 - count($featured));
$cats = [
  ['🧮','Math & Calculators','Percentages, fractions, averages and the everyday sums you keep Googling.'],
  ['💰','Finance','Loans, savings, tax, discounts, currency and budgeting helpers.'],
  ['❤️','Health & Fitness','BMI, calories, water intake, pace and body-metrics tools.'],
  ['📏','Unit Converters','Length, weight, temperature, area, speed and data size conversions.'],
  ['✍️','Text Tools','Word counter, case converter, text cleaners and quick formatters.'],
  ['📅','Date & Time','Age calculator, date difference, time zones and countdowns.'],
  ['💻','Developer Tools','Encoders, formatters, generators and tiny utilities for builders.'],
  ['🎨','Design & Media','Color pickers, palettes, image helpers and creative utilities.'],
];
?>
<section class="hero">
  <div class="grid-floor"></div>
  <div class="container hero-in">
    <div>
      <span class="eyebrow"><i></i> New tools are added regularly</span>
      <h1><span class="grad">Every tool you need,</span> locked in one beautiful vault.</h1>
      <p class="lead">CalcVault is a collection of free online calculators, converters and everyday utilities. Open a tool, get your answer in seconds, and get on with your day. No sign-up, no clutter.</p>
      <div class="hero-btns">
        <a class="btn btn-p" href="<?= BASE ?>/tools/">Explore all tools &rarr;</a>
        <a class="btn" href="#why">Why CalcVault</a>
      </div>
      <div class="badges"><span>100% free to use</span><span>No account needed</span><span>Private by design</span><span>Works on any device</span></div>
    </div>
    <div class="scene" id="scene" aria-hidden="true">
      <div class="stage" id="stage">
        <div class="ring r1"></div><div class="ring r2"></div>
        <div class="cube"><div class="face f1">+</div><div class="face f2">&minus;</div><div class="face f3">&times;</div><div class="face f4">&divide;</div><div class="face f5">%</div><div class="face f6">=</div></div>
        <div class="chip c1">&radic;</div><div class="chip c2">%</div><div class="chip c3">&pi;</div><div class="chip c4">&Sigma;</div>
      </div>
    </div>
  </div>
</section>

<div class="marq" aria-hidden="true"><div class="marq-track">
  <?php for ($k = 0; $k < 2; $k++) foreach (['Percentage','Loan & EMI','BMI','Unit converter','Age calculator','Word counter','Currency','Discount','Tip split','Date difference','Color picker','Password generator'] as $m) echo "<span>$m</span>"; ?>
</div></div>

<section class="sec" id="tools">
  <div class="container">
    <div class="sec-head">
      <h2>Fresh from the vault</h2>
      <p>Our latest and most useful tools. Each one is built to be quick, clear and easy on the eyes.</p>
    </div>
    <div class="grid g3">
      <?php foreach ($featured as $t) echo tool_card($t); ?>
      <?php for ($i = 0; $i < $soon; $i++): ?>
        <div class="card soon"><div class="ico">🔒</div><h3>New tool loading</h3><p>Another useful tool is being built right now. Want to see something specific? Tell us.</p><span class="tc-foot"><span class="pill">Coming soon</span><a class="go" href="<?= BASE ?>/contact">Suggest one &rarr;</a></span></div>
      <?php endfor; ?>
    </div>
    <div style="text-align:center;margin-top:46px"><a class="btn" href="<?= BASE ?>/tools/">View every tool &rarr;</a></div>
  </div>
</section>

<section class="sec" id="why">
  <div class="container">
    <div class="sec-head">
      <h2>Built different, on purpose</h2>
      <p>Most tool sites bury the answer under pop-ups and menus. CalcVault does the opposite.</p>
    </div>
    <div class="grid g3">
      <div class="card"><div class="ico">⚡</div><h3>Fast from the first click</h3><p>Lightweight pages and instant results. Type your numbers and the answer is already there.</p></div>
      <div class="card"><div class="ico">🛡️</div><h3>Private by design</h3><p>Our calculators work right in your browser, so the numbers you type stay on your device.</p></div>
      <div class="card"><div class="ico">📱</div><h3>Works everywhere</h3><p>Phone, tablet, laptop or desktop. Every tool adapts to your screen and stays easy to use.</p></div>
      <div class="card"><div class="ico">🎯</div><h3>Clear and accurate</h3><p>Plain labels, sensible defaults and clearly explained results so you can trust what you see.</p></div>
      <div class="card"><div class="ico">🧼</div><h3>Zero clutter</h3><p>No account walls, no forced downloads and no confusing menus. Just the tool you came for.</p></div>
      <div class="card"><div class="ico">🌱</div><h3>Always growing</h3><p>New tools land in the vault regularly, and your suggestions help decide what we build next.</p></div>
    </div>
  </div>
</section>

<section class="sec">
  <div class="container split">
    <div class="mock-wrap" aria-hidden="true">
      <div class="mock">
        <div class="mock-disp"><small id="mockExp">1,250 × 8%</small><strong id="mockRes">100</strong></div>
        <div class="keys"><i>7</i><i>8</i><i>9</i><i class="op">&divide;</i><i>4</i><i>5</i><i>6</i><i class="op">&times;</i><i>1</i><i>2</i><i>3</i><i class="op">&minus;</i><i>0</i><i>.</i><i class="eq">=</i></div>
      </div>
    </div>
    <div>
      <h2>Answers in seconds, not minutes</h2>
      <p>You should not need a spreadsheet to work out a discount or a degree to convert a unit. CalcVault tools are designed around one question: how quickly can you get a correct answer?</p>
      <ul class="ticks">
        <li><span><b>Instant results.</b> Values update as you type, so there is no submit button to hunt for.</span></li>
        <li><span><b>Helpful explanations.</b> Many tools show the formula so you understand the result, not just the number.</span></li>
        <li><span><b>Copy-friendly.</b> Grab the answer and paste it wherever you need it.</span></li>
        <li><span><b>Dark and easy on the eyes.</b> A comfortable look for late-night work and early-morning checks.</span></li>
      </ul>
    </div>
  </div>
</section>

<section class="sec" id="how">
  <div class="container">
    <div class="sec-head"><h2>How CalcVault works</h2><p>Three simple steps from question to answer.</p></div>
    <div class="grid g3 steps">
      <div class="card step"><h3>Find your tool</h3><p>Browse the Tools menu, search by name or pick a category. Everything is one click away.</p></div>
      <div class="card step"><h3>Enter your numbers</h3><p>Fill in a few fields. We keep every form short, labelled clearly and ready on mobile.</p></div>
      <div class="card step"><h3>Get your answer</h3><p>See the result right away, check the details and use it however you like. That is it.</p></div>
    </div>
  </div>
</section>

<section class="sec">
  <div class="container">
    <div class="sec-head"><h2>Explore by category</h2><p>The vault is organised so you can always find what you need. These are the areas we are building out.</p></div>
    <div class="grid g4">
      <?php foreach ($cats as $c): ?>
        <a class="card" href="<?= BASE ?>/tools/?cat=<?= urlencode($c[1]) ?>"><div class="ico"><?= $c[0] ?></div><h3><?= e($c[1]) ?></h3><p><?= e($c[2]) ?></p></a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="sec">
  <div class="container">
    <div class="stats">
      <div class="stat"><b><span data-count="100">0</span>%</b><span>Free to use</span></div>
      <div class="stat"><b data-count="0">0</b><span>Sign-ups required</span></div>
      <div class="stat"><b><span data-count="24">0</span>/7</b><span>Always available</span></div>
      <div class="stat"><b>&infin;</b><span>Times you can use a tool</span></div>
    </div>
  </div>
</section>

<section class="sec">
  <div class="container split">
    <div>
      <h2>Your data is your business</h2>
      <p>We built CalcVault around a simple belief: using a calculator should not cost you your privacy. Our tools run in your browser, we do not ask you to create an account and we only collect the basic information needed to keep the site working and secure.</p>
      <p style="margin-top:14px">Read exactly how everything works in our <a href="<?= BASE ?>/privacy-policy" style="color:var(--c);text-decoration:underline">privacy policy</a>. It is written in plain language.</p>
      <div class="hero-btns" style="margin-top:28px"><a class="btn" href="<?= BASE ?>/privacy-policy">Read privacy policy</a><a class="btn" href="<?= BASE ?>/about">About CalcVault</a></div>
    </div>
    <div class="grid g2">
      <div class="card"><div class="ico">🔐</div><h3>No accounts</h3><p>Use every tool without signing up or logging in.</p></div>
      <div class="card"><div class="ico">🧠</div><h3>Local math</h3><p>Calculations happen on your device.</p></div>
      <div class="card"><div class="ico">🚫</div><h3>No selling data</h3><p>We never sell your personal information.</p></div>
      <div class="card"><div class="ico">✅</div><h3>Transparent</h3><p>Clear policies, easy to find and read.</p></div>
    </div>
  </div>
</section>

<section class="sec">
  <div class="container">
    <div class="sec-head"><h2>Questions, answered</h2><p>Everything you might want to know before you start.</p></div>
    <div class="faq">
      <details><summary>Is CalcVault really free?</summary><p>Yes. Every tool in the vault is free to use, with no sign-up and no hidden paywalls. The site may show advertising to help cover running costs.</p></details>
      <details><summary>Do I need to create an account?</summary><p>No. Open a tool and use it straight away. We do not have user accounts.</p></details>
      <details><summary>Are the results accurate?</summary><p>We test our tools carefully and explain formulas where it helps. Still, results are for general information, so please double-check anything important such as medical, legal or financial decisions. See our <a href="<?= BASE ?>/disclaimer" style="color:var(--c)">disclaimer</a>.</p></details>
      <details><summary>Does CalcVault store the numbers I type?</summary><p>Our calculators run in your browser, so the values you enter are not sent to us. Read the privacy policy for the full picture.</p></details>
      <details><summary>Can I suggest a new tool?</summary><p>Please do. Use the <a href="<?= BASE ?>/contact" style="color:var(--c)">contact page</a> and tell us what you need. Popular requests move to the top of our list.</p></details>
      <details><summary>Does it work on my phone?</summary><p>Yes. Every page is responsive and designed to feel great on phones, tablets and desktops.</p></details>
      <details><summary>I found a bug or a wrong result. What should I do?</summary><p>Send us a message with the tool name and what you entered. We will look into it and fix it quickly.</p></details>
    </div>
  </div>
</section>

<section class="sec">
  <div class="container">
    <div class="cta">
      <h2><span class="grad">Missing a tool?</span> Tell us and we will build it.</h2>
      <p>The vault grows with your ideas. Send us the calculator or converter you wish existed.</p>
      <div class="hero-btns" style="justify-content:center;margin:0"><a class="btn btn-p" href="<?= BASE ?>/contact">Suggest a tool</a><a class="btn" href="<?= BASE ?>/tools/">Browse tools</a></div>
    </div>
  </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
