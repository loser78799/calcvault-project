<?php
require_once __DIR__ . '/../config.php';

function e($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

/* Reads every folder inside /tools that has tool.json + index.php.
   This is what fills the header menu, homepage, footer and tools page automatically. */
function get_tools(){
    static $tools = null;
    if ($tools !== null) return $tools;
    $tools = [];
    foreach (glob(ROOT . '/tools/*', GLOB_ONLYDIR) ?: [] as $dir) {
        $slug = basename($dir);
        if ($slug[0] === '_') continue; // folders starting with _ are ignored (templates/drafts)
        if (!is_file("$dir/index.php") && !is_file("$dir/index.html")) continue;
        $m = is_file("$dir/tool.json") ? json_decode(file_get_contents("$dir/tool.json"), true) : [];
        if (!is_array($m) || !empty($m['hidden'])) continue;
        $tools[] = [
            'slug'        => $slug,
            'name'        => $m['name'] ?? ucwords(str_replace('-', ' ', $slug)),
            'description' => $m['description'] ?? '',
            'icon'        => $m['icon'] ?? '🧮',
            'category'    => $m['category'] ?? 'General',
            'keywords'    => $m['keywords'] ?? '',
            'order'       => (int)($m['order'] ?? 100),
            'url'         => BASE . '/tools/' . $slug . '/',
        ];
    }
    usort($tools, fn($a, $b) => [$a['order'], $a['name']] <=> [$b['order'], $b['name']]);
    return $tools;
}

function tools_by_category(){
    $out = [];
    foreach (get_tools() as $t) $out[$t['category']][] = $t;
    ksort($out);
    return $out;
}

function current_tool($dir){
    $slug = basename($dir);
    foreach (get_tools() as $t) if ($t['slug'] === $slug) return $t;
    $m = is_file("$dir/tool.json") ? json_decode(file_get_contents("$dir/tool.json"), true) : [];
    return ['slug'=>$slug,'name'=>$m['name'] ?? 'Tool','description'=>$m['description'] ?? '','icon'=>$m['icon'] ?? '🧮','category'=>$m['category'] ?? 'General','keywords'=>'','order'=>100,'url'=>BASE.'/tools/'.$slug.'/'];
}

function tool_card($t){
    $s = strtolower($t['name'].' '.$t['description'].' '.$t['category'].' '.$t['keywords']);
    return '<a class="card tool-card" href="'.e($t['url']).'" data-tool data-cat="'.e($t['category']).'" data-search="'.e($s).'">'
         . '<div class="ico">'.e($t['icon']).'</div><h3>'.e($t['name']).'</h3><p>'.e($t['description']).'</p>'
         . '<span class="tc-foot"><span class="pill">'.e($t['category']).'</span><span class="go">Open tool &rarr;</span></span></a>';
}

function more_tools($exceptSlug = '', $limit = 3){
    $list = array_values(array_filter(get_tools(), fn($t) => $t['slug'] !== $exceptSlug));
    return array_slice($list, 0, $limit);
}

function logo_svg($id = 'lg'){
    return '<svg viewBox="0 0 32 32" fill="none" aria-hidden="true"><defs><linearGradient id="'.$id.'" x1="2" y1="2" x2="30" y2="30"><stop stop-color="#8b5cf6"/><stop offset=".55" stop-color="#22d3ee"/><stop offset="1" stop-color="#f472b6"/></linearGradient></defs><path d="M16 2l12 7v14l-12 7L4 23V9z" stroke="url(#'.$id.')" stroke-width="2.2" stroke-linejoin="round"/><path d="M16 9l6 3.5v7L16 23l-6-3.5v-7z" fill="url(#'.$id.')"/></svg>';
}

/* ---- contact messages storage (data/messages.json, blocked from the web by .htaccess) ---- */
function messages_file(){ return ROOT . '/data/messages.json'; }

function write_messages($fp, $arr){
    ftruncate($fp, 0); rewind($fp);
    fwrite($fp, json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    fflush($fp); flock($fp, LOCK_UN); fclose($fp);
}
function save_message($rec){
    $fp = @fopen(messages_file(), 'c+');
    if (!$fp) return false;
    flock($fp, LOCK_EX);
    $arr = json_decode(stream_get_contents($fp), true);
    if (!is_array($arr)) $arr = [];
    array_unshift($arr, $rec);
    write_messages($fp, $arr);
    return true;
}
function load_messages(){
    $a = is_file(messages_file()) ? json_decode(file_get_contents(messages_file()), true) : [];
    return is_array($a) ? $a : [];
}
function delete_message($id){
    $fp = @fopen(messages_file(), 'c+'); if (!$fp) return;
    flock($fp, LOCK_EX);
    $arr = json_decode(stream_get_contents($fp), true) ?: [];
    $arr = array_values(array_filter($arr, fn($m) => ($m['id'] ?? '') !== $id));
    write_messages($fp, $arr);
}

/* ---- helpers for the admin tool uploader ---- */
function slugify($t){
    $t = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $t), '-'));
    return $t !== '' ? $t : 'tool';
}
function rrmdir($d){
    if (!is_dir($d)) return;
    foreach (scandir($d) as $f) { if ($f === '.' || $f === '..') continue; $p = "$d/$f"; is_dir($p) ? rrmdir($p) : @unlink($p); }
    @rmdir($d);
}
function all_tool_dirs(){ // includes hidden tools, for the admin list
    $out = [];
    foreach (glob(ROOT . '/tools/*', GLOB_ONLYDIR) ?: [] as $d) {
        $slug = basename($d); if ($slug[0] === '_') continue;
        $m = is_file("$d/tool.json") ? (json_decode(file_get_contents("$d/tool.json"), true) ?: []) : [];
        $out[] = ['slug' => $slug, 'name' => $m['name'] ?? ucwords(str_replace('-', ' ', $slug)), 'hidden' => !empty($m['hidden']), 'icon' => $m['icon'] ?? '🧮', 'type' => is_file("$d/index.php") ? 'PHP' : 'HTML'];
    }
    return $out;
}
