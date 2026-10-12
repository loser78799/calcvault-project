<?php
$page_title = 'Terms & Conditions';
$page_desc  = 'The terms and conditions that apply when you use the CalcVault website and its online tools.';
include __DIR__ . '/includes/header.php';
?>
<section class="phero"><div class="container"><h1><span class="grad">Terms &amp; Conditions</span></h1><p>Please read these terms before using the website and tools.</p></div></section>
<div class="container prose"><div class="box">
<p class="updated">Last updated: <?= e(LEGAL_DATE) ?></p>

<h2>1. Acceptance of terms</h2>
<p>By accessing or using <?= e(SITE_NAME) ?> at <?= e(SITE_URL) ?> (the "Website"), you agree to be bound by these Terms and Conditions and our <a href="<?= BASE ?>/privacy-policy">Privacy Policy</a>. If you do not agree, please do not use the Website.</p>

<h2>2. Use of the Website</h2>
<p>You may use the Website and its tools for lawful personal or business purposes. You agree not to:</p>
<ul>
  <li>Use the Website in a way that violates any law or regulation.</li>
  <li>Attempt to gain unauthorised access to the Website, servers or related systems.</li>
  <li>Interfere with or disrupt the Website, including through automated requests, scraping at excessive volume or malicious code.</li>
  <li>Copy, resell or redistribute our tools or content as your own without permission.</li>
  <li>Use the contact form to send spam, abusive or unlawful content.</li>
</ul>

<h2>3. Accuracy and no professional advice</h2>
<p>Our tools provide general-purpose calculations and conversions. While we work hard to make them accurate, we do not guarantee that results are error-free, complete or suitable for your situation. Results are not financial, medical, legal, tax or other professional advice. Always verify important figures and consult a qualified professional before making significant decisions. See our <a href="<?= BASE ?>/disclaimer">Disclaimer</a>.</p>

<h2>4. Intellectual property</h2>
<p>The Website, including its design, text, graphics, logos, code and tools, is owned by or licensed to <?= e(SITE_NAME) ?> and protected by intellectual property laws. You may view and use the tools for their intended purpose, but you may not reproduce, modify or distribute our materials without written permission.</p>

<h2>5. User submissions</h2>
<p>If you send us feedback, ideas or tool suggestions, you agree we may use them to improve the Website without obligation or compensation to you. Please do not send confidential information through the contact form.</p>

<h2>6. Advertising and third-party links</h2>
<p>The Website may display advertisements and links to third-party websites. We do not control or endorse third-party content, products or services, and we are not responsible for any loss or damage from your dealings with them.</p>

<h2>7. Availability</h2>
<p>We aim to keep the Website available at all times, but we do not guarantee uninterrupted access. We may modify, suspend or discontinue any tool or part of the Website at any time without notice.</p>

<h2>8. Disclaimer of warranties</h2>
<p>The Website and all tools are provided "as is" and "as available", without warranties of any kind, whether express or implied, including fitness for a particular purpose, accuracy and non-infringement.</p>

<h2>9. Limitation of liability</h2>
<p>To the fullest extent permitted by law, <?= e(SITE_NAME) ?> and its owners will not be liable for any direct, indirect, incidental, consequential or special damages, including loss of profits, data or business, arising from your use of, or inability to use, the Website or its tools.</p>

<h2>10. Indemnification</h2>
<p>You agree to indemnify and hold harmless <?= e(SITE_NAME) ?> and its owners from any claims, losses or expenses arising from your misuse of the Website or your breach of these terms.</p>

<h2>11. Termination</h2>
<p>We may restrict or block access to the Website for anyone who violates these terms or misuses the service, at our discretion and without notice.</p>

<h2>12. Governing law</h2>
<p>These terms are governed by the laws applicable in the jurisdiction in which the Website owner is based, without regard to conflict-of-law rules. Any disputes will be handled by the competent courts of that jurisdiction.</p>

<h2>13. Changes to these terms</h2>
<p>We may update these terms from time to time. The "Last updated" date shows the most recent revision. By continuing to use the Website after changes are posted, you accept the updated terms.</p>

<h2>14. Contact</h2>
<p>If you have questions about these Terms and Conditions, please use our <a href="<?= BASE ?>/contact">contact page</a>.</p>
</div></div>
<?php include __DIR__ . '/includes/footer.php'; ?>
