<?php
session_start();
require_once __DIR__ . '/../includes/functions.php';
if (empty($_SESSION['adm'])) { header('Location: ./'); exit; }
if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(16));
$ok = ''; $err = '';
$valid = fn($s) => (bool)preg_match('/^[a-z0-9][a-z0-9_-]*$/i', $s);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['csrf'], (string)($_POST['csrf'] ?? ''))) $err = 'Session expired. Reload the page and try again.';
    else {
        $act = $_POST['action'] ?? '';
        if ($act === 'add') {
            $html = '';
            if (!empty($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
                $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
                if (!in_array($ext, ['html', 'htm'], true)) $err = 'Only .html or .htm files can be uploaded here.';
                elseif ($_FILES['file']['size'] > 2 * 1024 * 1024) $err = 'That file is larger than 2 MB.';
                else $html = file_get_contents($_FILES['file']['tmp_name']);
            } else $html = (string)($_POST['code'] ?? '');
            $name = trim((string)($_POST['name'] ?? ''));
            if (!$err && trim($html) === '') $err = 'Upload an HTML file or paste your tool code.';
            if (!$err && $name === '' && preg_match('~<title[^>]*>(.*?)</title>~is', $html, $m)) $name = trim(strip_tags($m[1]));
            if (!$err && $name === '') $err = 'Please enter a tool name.';
            if (!$err) {
                $slug = slugify($name); $dir = ROOT . '/tools/' . $slug; $n = 2;
                while (file_exists($dir)) { $dir = ROOT . '/tools/' . $slug . '-' . $n; $n++; }
                $slug = basename($dir);
                $meta = ['name' => $name, 'description' => trim((string)($_POST['description'] ?? '')), 'icon' => trim((string)($_POST['icon'] ?? '')) ?: '🧮',
                         'category' => trim((string)($_POST['category'] ?? '')) ?: 'General', 'keywords' => '', 'order' => (int)($_POST['order'] ?? 50)];
                if (@mkdir($dir, 0755) && file_put_contents("$dir/index.html", $html) !== false && file_put_contents("$dir/tool.json", json_encode($meta, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) !== false)
                    $ok = 'Published! Your tool is live at <a href="' . e(BASE . '/tools/' . $slug . '/') . '" style="color:var(--c);text-decoration:underline">' . e(SITE_URL . '/tools/' . $slug . '/') . '</a> and already appears in the menu.';
                else $err = 'Could not save the tool. Check that the tools folder is writable (permissions 755).';
            }
        } elseif (in_array($act, ['toggle', 'delete'], true) && $valid((string)($_POST['slug'] ?? ''))) {
            $d = ROOT . '/tools/' . $_POST['slug'];
            if (is_dir($d) && $_POST['slug'][0] !== '_') {
                if ($act === 'delete') { rrmdir($d); $ok = 'Tool deleted.'; }
                else {
                    $f = "$d/tool.json"; $m = is_file($f) ? (json_decode(file_get_contents($f), true) ?: []) : [];
                    $m['hidden'] = empty($m['hidden']); file_put_contents($f, json_encode($m, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                    $ok = $m['hidden'] ? 'Tool hidden from the site.' : 'Tool is visible again.';
                }
            }
        }
    }
}
$page_title = 'Manage tools'; $noindex = true;
$all = all_tool_dirs(); $cats = array_keys(tools_by_category());
include __DIR__ . '/../includes/header.php';
?>
<div class="adm">
  <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:26px">
    <h1 style="font-size:2rem">Upload &amp; manage tools</h1>
    <div style="display:flex;gap:8px"><a class="btn btn-sm" href="./">Inbox</a><a class="btn btn-sm" href="./?logout=1">Log out</a></div>
  </div>
  <?php if ($ok): ?><div class="alert ok"><?= $ok ?></div><?php endif; ?>
  <?php if ($err): ?><div class="alert err"><?= e($err) ?></div><?php endif; ?>

  <div class="panel" style="margin-bottom:34px">
    <h2 style="font-size:1.5rem;margin-bottom:6px">Add a new tool</h2>
    <p class="muted" style="margin-bottom:22px">Upload a single .html file (or paste its code). It goes live instantly and is added to the header menu, homepage, footer and sitemap.</p>
    <form method="post" enctype="multipart/form-data">
      <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>"><input type="hidden" name="action" value="add">
      <div class="row">
        <div class="field"><label for="file">HTML file</label><input class="input" id="file" type="file" name="file" accept=".html,.htm"></div>
        <div class="field"><label for="nm">Tool name</label><input class="input" id="nm" name="name" maxlength="80" placeholder="e.g. BMI Calculator (blank = use the page title)"></div>
      </div>
      <div class="field"><label for="ds">Short description</label><input class="input" id="ds" name="description" maxlength="160" placeholder="One sentence shown on tool cards and in the menu"></div>
      <div class="row">
        <div class="field"><label for="ic">Icon (an emoji)</label><input class="input" id="ic" name="icon" maxlength="4" placeholder="🧮"></div>
        <div class="field"><label for="ct">Category</label><input class="input" id="ct" name="category" list="cl" maxlength="40" placeholder="Math & Calculators"><datalist id="cl"><?php foreach ($cats as $c) echo '<option value="' . e($c) . '">'; ?></datalist></div>
        <div class="field"><label for="od">Order (lower = first)</label><input class="input" id="od" type="number" name="order" value="50"></div>
      </div>
      <div class="field"><label for="cd">...or paste the tool code instead of uploading</label><textarea class="input" id="cd" name="code" placeholder="Paste full HTML here (with its CSS and JavaScript)"></textarea></div>
      <button class="btn btn-p" type="submit">Publish tool</button>
    </form>
  </div>

  <h2 style="font-size:1.5rem;margin-bottom:16px">Your tools (<?= count($all) ?>)</h2>
  <?php if (!$all): ?><div class="msg"><p class="muted">No tools yet. Add your first one above.</p></div><?php endif; ?>
  <?php foreach ($all as $t): ?>
    <div class="msg"><div class="msg-h" style="margin:0;align-items:center">
      <div><strong><?= e($t['icon'] . ' ' . $t['name']) ?></strong> <span class="pill"><?= e($t['type']) ?></span> <?= $t['hidden'] ? '<span class="pill">Hidden</span>' : '' ?><br><span class="muted">/tools/<?= e($t['slug']) ?>/</span></div>
      <form method="post" style="display:flex;gap:8px;flex-wrap:wrap" onsubmit="return this.action.value!=='delete'||confirm('Delete this tool permanently?')">
        <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>"><input type="hidden" name="slug" value="<?= e($t['slug']) ?>">
        <a class="btn btn-sm" href="<?= e(BASE . '/tools/' . $t['slug'] . '/') ?>" target="_blank">View</a>
        <button class="btn btn-sm" name="action" value="toggle"><?= $t['hidden'] ? 'Show' : 'Hide' ?></button>
        <button class="btn btn-sm" name="action" value="delete">Delete</button>
      </form></div></div>
  <?php endforeach; ?>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
