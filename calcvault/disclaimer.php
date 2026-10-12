<?php
$page_title = 'Disclaimer';
$page_desc  = 'Important information about the accuracy and intended use of results from CalcVault tools.';
include __DIR__ . '/includes/header.php';
?>
<section class="phero"><div class="container"><h1><span class="grad">Disclaimer</span></h1><p>Please read this to understand how to use the results our tools give you.</p></div></section>
<div class="container prose"><div class="box">
<p class="updated">Last updated: <?= e(LEGAL_DATE) ?></p>

<h2>General information only</h2>
<p>All tools, calculators, converters and content on <?= e(SITE_NAME) ?> are provided for general informational and educational purposes. They are meant to help you with quick estimates and everyday tasks.</p>

<h2>Not professional advice</h2>
<p>Nothing on this website is financial, investment, tax, legal, medical, health or other professional advice. For example, a loan estimate is not a loan offer, and a BMI result is not a medical diagnosis. Always consult a qualified professional before making important decisions.</p>

<h2>Accuracy of results</h2>
<p>We do our best to keep every tool accurate and up to date. However, we make no guarantee that results are complete, current or free from error. Rounding, assumptions, changing rates or regulations, and incorrect inputs can all affect outcomes. Please double-check anything important.</p>

<h2>Use at your own risk</h2>
<p>You are responsible for how you use the results. <?= e(SITE_NAME) ?> is not liable for any loss or damage resulting from reliance on the information or tools provided.</p>

<h2>External links and advertising</h2>
<p>The website may contain links to third-party sites and may show advertisements. We do not control or endorse those sites or advertisers, and inclusion does not imply recommendation.</p>

<h2>Contact</h2>
<p>If you spot an error in a tool, please let us know through our <a href="<?= BASE ?>/contact">contact page</a>. We appreciate the help.</p>
</div></div>
<?php include __DIR__ . '/includes/footer.php'; ?>
