<?php

$incdir = get_template_directory() . '/includes/';

/*-----------------------------------------------------------------------------------*/
/*	Load Theme Specific Components
/*-----------------------------------------------------------------------------------*/

require_once($incdir .'meta/post-meta.php');
require_once($incdir .'meta/seo-meta.php');

/*-----------------------------------------------------------------------------------*/
/*	Load Framework Sections
/*-----------------------------------------------------------------------------------*/

require_once($incdir .'options/general-settings.php');
require_once($incdir .'options/styling-options.php');
require_once($incdir .'options/post-options.php');

/*-----------------------------------------------------------------------------------*/
/*	Load Widgets
/*-----------------------------------------------------------------------------------*/

require_once($incdir .'widgets/widget-ad125.php');
require_once($incdir .'widgets/widget-tweets.php');
require_once($incdir .'widgets/widget-flickr.php');
require_once($incdir .'widgets/widget-video.php');

?>