<?php
http_response_code(404);
$page_title = 'Page not found'; $noindex = true;
include __DIR__ . '/includes/header.php';
?>
<section class="phero" style="padding:120px 0">
  <div class="container">
    <h1 style="font-size:clamp(5rem,16vw,11rem)"><span class="grad">404</span></h1>
    <h2 style="font-size:1.8rem;margin-bottom:14px">This page is not in the vault</h2>
    <p>The link may be broken or the page may have moved. Try one of these instead.</p>
    <div class="hero-btns" style="justify-content:center;margin-top:30px"><a class="btn btn-p" href="<?= BASE ?>/">Go home</a><a class="btn" href="<?= BASE ?>/tools/">Browse tools</a></div>
  </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
