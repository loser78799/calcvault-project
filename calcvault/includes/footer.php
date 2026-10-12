<?php $B = BASE; $ft = array_slice(get_tools(), 0, 6); ?>
</main>
<footer class="ftr">
  <div class="container">
    <div class="ftr-top">
      <div class="ftr-brand">
        <a class="logo" href="<?= $B ?>/"><span class="logo-mark"><?= logo_svg('lgf') ?></span><span>Calc<b class="grad">Vault</b></span></a>
        <p>A growing vault of free online tools for everyday math, money, health, text and more. Fast, private and built to be pleasant to use.</p>
      </div>
      <div>
        <h4>Popular tools</h4>
        <ul>
          <?php if (!$ft): ?><li><span class="muted">Coming soon</span></li><?php endif; ?>
          <?php foreach ($ft as $t): ?><li><a href="<?= e($t['url']) ?>"><?= e($t['name']) ?></a></li><?php endforeach; ?>
          <li><a href="<?= $B ?>/tools/">All tools</a></li>
        </ul>
      </div>
      <div>
        <h4>Company</h4>
        <ul>
          <li><a href="<?= $B ?>/about">About us</a></li>
          <li><a href="<?= $B ?>/contact">Contact us</a></li>
          <li><a href="<?= $B ?>/contact">Suggest a tool</a></li>
          <li><a href="<?= $B ?>/sitemap.xml">Sitemap</a></li>
        </ul>
      </div>
      <div>
        <h4>Legal</h4>
        <ul>
          <li><a href="<?= $B ?>/privacy-policy">Privacy policy</a></li>
          <li><a href="<?= $B ?>/terms">Terms &amp; conditions</a></li>
          <li><a href="<?= $B ?>/disclaimer">Disclaimer</a></li>
        </ul>
      </div>
    </div>
    <div class="ftr-bot">
      <span>&copy; <?= date('Y') ?> <?= e(SITE_NAME) ?>. All rights reserved.</span>
      <span class="muted">Results are for general information. Please verify important figures.</span>
    </div>
  </div>
</footer>
<button class="totop" aria-label="Back to top">&uarr;</button>
<script src="<?= $B ?>/assets/js/main.js?v=1"></script>
</body>
</html>
