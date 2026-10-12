<?php
/* ============  CALCVAULT SETTINGS — edit these first  ============ */
define('SITE_NAME',     'CalcVault');
define('SITE_TAGLINE',  'Free online tools, beautifully simple.');
define('CONTACT_EMAIL', 'r.abubakar2515@gmail.com');      // contact-form messages are emailed HERE
define('MAIL_FROM',     'no-reply@yourdomain.com'); // must be an email on YOUR domain (create it in Hostinger > Emails)
define('ADMIN_PASSWORD','ChangeThisNow!2026');      // password for yourdomain.com/admin/ (message inbox)
define('LEGAL_DATE',    'October 3, 2026');         // "last updated" date shown on legal pages
define('BASE',          '');                        // '' = site is in the domain root. Use '/folder' if inside a subfolder.
date_default_timezone_set('UTC');                   // e.g. 'Asia/Karachi' to show local time in the inbox
/* ================================================================ */

define('ROOT', __DIR__);
$__https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
define('SITE_URL', $__https . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . BASE);
