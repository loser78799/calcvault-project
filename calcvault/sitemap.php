<?php
require_once __DIR__ . '/includes/functions.php';
header('Content-Type: application/xml; charset=utf-8');
$urls = ['/', '/tools/', '/about', '/contact', '/privacy-policy', '/terms', '/disclaimer'];
foreach (get_tools() as $t) $urls[] = '/tools/' . $t['slug'] . '/';
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($urls as $u) echo '  <url><loc>' . e(SITE_URL . $u) . '</loc></url>' . "\n";
echo '</urlset>';
