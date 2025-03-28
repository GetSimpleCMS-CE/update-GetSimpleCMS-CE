<div align="center">

# GetSimple CMS Community Edition

![image](https://github.com/GetSimpleCMS-CE/GetSimpleCMS-CE/assets/6113504/621eea2d-7db2-4115-8d33-89c941e45103)

[![CMS - GetSimpleCMS CE](https://img.shields.io/badge/CMS-GetSimpleCMS_CE-blue)](https://getsimple-ce.ovh/)
![PHP - v7.4-8.x](https://img.shields.io/badge/PHP-v7.4--8.x-orange)
![DataBase](https://img.shields.io/badge/FlatFile-purple)
![GitHub Release](https://img.shields.io/github/v/release/GetSimpleCMS-CE/GetSimpleCMS-CE?color=yellow)
[![Documentation - Available](https://img.shields.io/badge/Documentation-Available-red)](https://github.com/GetSimpleCMS-CE/GetSimpleCMS-CE/wiki)
[![License](https://img.shields.io/badge/License-GPL--3.0-green)](#license)

</div>


<hr/>


## What is GetSimple CMS CE? ℹ️

GetSimple CMS is a lightweight, user-friendly content management system designed for simplicity and efficiency. It is flat-file based, meaning it doesn’t require a database, making it ideal for smaller websites and quick deployments. With its intuitive interface, anyone can easily create and manage content without extensive technical knowledge. GetSimple CMS offers fast performance, robust security, and easy customization with themes and plugins. Perfect for small business websites, portfolios, and blogs, it allows users to focus on their content without the complexity of larger CMS platforms.

Its intuitive interface is specifically designed for ease of use, catering to non-technical users while still offering customization options for developers. Additionally, GetSimple emphasizes minimalism and efficiency, making it an excellent choice for smaller projects like portfolios, blogs, and business websites. Unlike many larger CMS platforms, GetSimple provides all the essential features without unnecessary complexity.

Now supporting php7.4-8.x.

- :globe_with_meridians: Official CE Website - https://getsimple-ce.ovh/
- :heart: Help support the GetSimple CE CMS Project: https://gofund.me/04cdcb3d


<hr><hr>


## REQUIREMENTS 📋

- UNIX/Linux hosting, (Windows tested with minor limitations)
- PHP 7.4+
- Apache server. (LiteSpeed is exceptable, but depending on host, may have limitations. Nginx may not support working with .htaccess files).
- SimpleXML (GS uses XML files to store data)
- ZipArchive (Needed for making zip backups of your website.)
- Apache mod_rewrite (Needed if you want to use FancyURLs)
- cURL
- GD Library (Needed in order to create thumbnails of uploaded images)
- **No MySQL databases are required** 


<hr><hr>


## What's New ⭐

- New: UpdateCE plugin included. Easily update your install to the latest version.
- New: Replaced Fancybox with SimpleLightbox
- New: Arabic language added

### Updates:

- Updated: Massive Admin 6.x
- Updated: Codemirror
- Updated: Install/Upgrade Email
- Updated: Support Page
- Updated: Support > Error Log
- Updated: Backup > Website Archives

### Fixes:

- Fixed: Menu Manager
- Fixed: Email HTML rendering issue
- Fixed: Password reset functionality
- Fixed: Components copy code issue
- Fixed: jCrop

### Removals:

- Removed: Deprecated Uploadify
- Removed: Outdated demo templates & plugins
- Removed: Unused/dead files

### Security & Hotfixes:

- Hotfixes: Remote command execution vulnerability #1352  (https://github.com/GetSimpleCMS/GetSimpleCMS/issues/1352)
- Hotfixes: Cross-Site Scripting Vulnerability #1360 (https://github.com/GetSimpleCMS/GetSimpleCMS/issues/1360)

### Other:

- Miscellaneous cleanup, fixes, and improvements


<hr><hr>

## Upgrade

> ⚠️ GetSimple v3.3.16 or newer required.
> 
> Always create a backup to protect against the unexpected!

- Overwrite existing files.
- Update your existing `gsconfig.php` with the following:

Add New:
```
# Login Page Default Language;
$LANG = 'en_EN'; // es_ES, pl_PL, de_DE, uk_UK, etc.

# Sort admin page list by title or menu
define('GSSORTPAGELISTBY','menu');
```

Replace section:
```
# WYSIWYG editor height (default 500)
# define('GSEDITORHEIGHT', '400');

# WYSIWYG toolbars (advanced, basic or [custom config]) 
# define('GSEDITORTOOL', 'advanced');

# WYSIWYG editor language (default en)
# define('GSEDITORLANG', 'en');

# WYSIWYG Editor Options
# define('GSEDITOROPTIONS', '');
```
With updated:
```
# WYSIWYG editor height (default 500)
# define('GSEDITORHEIGHT', '400');

# WYSIWYG editor language (default en)
# define('GSEDITORLANG', 'en');

# WYSIWYG toolbars (advanced, basic, advanced, island, CEbar or [custom config])
define('GSEDITORTOOL', "CEbar");

# WYSIWYG Editor Options
define('GSEDITOROPTIONS', '
extraPlugins:"fontawesome5,youtube,codemirror,cmsgrid,colorbutton,oembed,simplebutton,spacingsliders",
disableNativeSpellChecker : false,
forcePasteAsPlainText : true
');
```

<hr><hr>


## Team 💻
The following individuals generously donate their time to further developing this "Community Edition" version, please consider supporting their efforts:

### :computer: multi / multicolor :video_game: ###
**Multi** is a versatile freelance programmer and designer from Poland, skilled in both front-end and back-end development.
[![Donate](https://img.shields.io/badge/Donate-PayPal-blue.svg)](https://www.paypal.com/donate/?hosted_button_id=TW6PXVCTM5A72)

### :computer: risingisland /islander :palm_tree: ###
**RisingIsland** is a self-employed web developer and graphic designer originally from California, who has spent the past 20 years residing in Spain.
[![Donate](https://img.shields.io/badge/Donate-PayPal-blue.svg)](https://www.paypal.com/donate/?hosted_button_id=QTTWMSSQDYB82)


<hr><hr>


## LICENSE :bookmark_tabs:

This software package is licensed under the GNU GENERAL PUBLIC LICENSE v3. 
LICENSE.txt is located within this download's zip file.

It would be great if you would link back to https://getsimple-ce.ovh/ if you use it.
