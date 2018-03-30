<?php

/*
Purpose of this file is to list all functions that are handled by our AIT Theme Framework,
but Theme-Check/ThemeForest-Check plugin cannot find them due to it's limited regular expressions.
Please see below locations where you can find given functions if you'd like to check it manually
or make additional changes to your code.
*/

// Support for automatic-feed-links is added in theme's ait-theme/config/@theme-configuration.php, in configruation array
// and later in framework this array is iterated and all theme support is added by add_theme_support() function
"add_theme_support('automatic-feed-links')";

// For Theme-Check this is mandatory,
// but we do not use them in our themes
'add_theme_support( "custom-header"';
'add_theme_support( "custom-background"';

// body_class() is handled via our WpLatte: <body {!$wp->bodyHtmlClass}>, see template file header.php
// Definition of bodyHtmlClass is in wplatte.min.php on line 396 and is identical to body_class() function
"<body body_class(";


