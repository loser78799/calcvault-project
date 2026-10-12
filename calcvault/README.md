# CalcVault - setup and guide

## 1. Upload to Hostinger (5 minutes)
1. hPanel > Websites > Manage > **File Manager** > open `public_html` (delete the default placeholder file).
2. Upload `calcvault.zip`, right-click it > **Extract** (extract so `index.php` sits directly inside `public_html`).
3. hPanel > Advanced > **PHP Configuration**: choose PHP 8.1 or newer.
4. hPanel > Security > **SSL**: turn on the free SSL certificate and force HTTPS.
5. Create an email on your domain (hPanel > Emails), e.g. `hello@yourdomain.com`.
6. Edit `config.php` in File Manager and set: CONTACT_EMAIL (already set), MAIL_FROM, ADMIN_PASSWORD, LEGAL_DATE.
7. Visit your site. Open `yourdomain.com/admin/` to read contact messages.

## 2. How contact messages reach you
Every message is (a) emailed to CONTACT_EMAIL and (b) saved in `data/messages.json`, which you can read
(and delete from) at `yourdomain.com/admin/` with your ADMIN_PASSWORD. Even if email delivery fails, the message is never lost.

## 3a. EASIEST way to add a tool: the upload page
Go to `yourdomain.com/admin/tools`, log in, choose your tool's .html file (or paste its code), fill the name/icon/category
and press Publish. It is live instantly and appears in the menu, homepage, footer and sitemap. You can also hide or delete tools there.
Via File Manager you can do the same: create a folder in `tools/` containing just `index.html` (and optionally `tool.json`).

## 3b. Advanced: tools written in PHP (copy the template)
1. In File Manager open the `tools` folder.
2. Copy the folder `_template` and rename the copy to your tool's URL name, lowercase with dashes
   (example: `bmi-calculator` -> yourdomain.com/tools/bmi-calculator/).
3. Open `tool.json` in your new folder and edit:
   - name: shown everywhere
   - description: one short sentence
   - icon: any emoji
   - category: groups tools in the header menu and filter chips (new category names are created automatically)
   - keywords: extra search words
   - order: lower numbers appear first
4. Open `index.php` in your new folder and replace the section marked "YOUR TOOL GOES HERE" with your tool
   (HTML + JavaScript). Update the "About this tool" text for SEO.
5. Save. That is all: the tool appears automatically in the header Tools menu, homepage, footer, Tools page and sitemap.

Tips
- Hide a tool temporarily: add `"hidden": true` to its tool.json, or rename the folder to start with `_`.
- Remove a tool: delete its folder.
- The included Percentage Calculator is a working example. Delete `tools/percentage-calculator` when you no longer need it.
- Useful ready-made classes for tool UIs: `.panel`, `.row`, `.field`, `.input`, `.result`, `.tabs`, `.chip-b`, `.btn`, `.btn-p`.

## 4. Other things you will want to edit
- Ads/analytics code: paste into `includes/head-extra.php` (loads on every page).
- Colors: `assets/css/style.css`, the `:root` block at the top.
- Homepage text: `index.php`. About text: `about.php`.
- Legal pages: `privacy-policy.php`, `terms.php`, `disclaimer.php`. They are solid templates, but have them reviewed for your country and business.
- Website in a subfolder instead of the domain root? Set BASE in `config.php` (for example '/calcvault').

## 5. File map
index.php, about.php, contact.php, privacy-policy.php, terms.php, disclaimer.php, 404.php
tools/ (one folder per tool; tools/index.php is the "all tools" page)
admin/index.php (message inbox)  |  includes/ (header, footer, tool scanner)  |  assets/ (css, js, favicon)
data/ (stored messages, blocked from the web)  |  sitemap.php + robots.php (served as /sitemap.xml and /robots.txt)
