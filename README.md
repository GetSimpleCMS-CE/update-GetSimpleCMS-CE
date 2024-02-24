### GetSimple CMS 3.3.19.1 COMMUNITY EDITION 
The official unofficial GS update repo. Helping to bridge the gap in PHP compatibility. 

What has changed in this version of the Community Edition?

🚀 **_Added support for php7.4-8.2_**


**Whats New in this Update:**

⭐ Massive Admin 5 update!

**Recent Updates:**

🌐 11 default languages included (de, es, en, fr, it, ja, nl, pl, pt, ru, uk)

⭐ New gsconfig option (set login page language)

⭐ Massive Admin included by default (responsive admin + user manager + much much more...).

⭐ New Admin themes option.

⭐ ResponsiveCE default template (front-end starter theme).

⭐ New ckEditor plugins (Codemirror, YouTube, FontAwesome, etc.).

⭐ New Soport Page options (view errorlog & phpInfo).

⭐ New gsconfig option (view page tree by Title or Menu order).

⭐ New Copy Component code button.

⭐ Other minor fixes and cleanup.

**Previous Updates:**

- Fix deprecated Text-encoding HTML-ENTITIES for php8.2.
- Hotfixes: form action reflection, add phar to blacklist, .htaccess
- Fix bug in Components if none exist.
- Fix non numeric error on gsdebug.
- Fix vulnerability #1335 (https://github.com/GetSimpleCMS/GetSimpleCMS/issues/1335)
- Fix error message (empty log file) #1312 (https://github.com/GetSimpleCMS/GetSimpleCMS/pull/1312)
- Fix missing php7 extension on file_ext_blacklist #1237 (https://github.com/GetSimpleCMS/GetSimpleCMS/issues/1237)
- Add .webp support for GetSimple CMS #1350 (https://github.com/GetSimpleCMS/GetSimpleCMS/pull/1350)
- Add thumbnail creation on upload.
- Update Google Fonts to local in Innovation theme (for German GDPR).
- Changed function name do to deprecated class constructor.
- Further 8.x compatibility from Topic with fixes ([Forum Thread](http://get-simple.info/forums/showthread.php?tid=16548))

=====================
## Upgrade Instructions:
=====================
- Always create a backup to protect against the unexpected!
- Overwrite existing files with the files included in this patch.
- Update your existing "gsconfig.php" with the following:

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
