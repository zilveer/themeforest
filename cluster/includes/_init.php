<?php

/* Include Theme Options -------------------------------------------------------------------------*/
require_once('options/general-settings.php');
require_once('options/portfolio-settings.php');
require_once('options/site-settings.php');
require_once('options/styling-options.php');
require_once('options/social-settings.php');


/* Include Theme Widgets -------------------------------------------------------------------------*/
require_once('widgets/widget-clients.php');
require_once('widgets/widget-latest-post.php');
require_once('widgets/widget-portfolio.php');
require_once('widgets/widget-services.php');
require_once('widgets/widget-services-section.php');
require_once('widgets/widget-static-content.php');

require_once('widgets/widget-featured-portfolio.php');


/* Include Meta Boxes -------------------------------------------------------------------------*/
if( stag_get_option('general_disable_seo_settings') == 'off' ) {
  require_once('meta/seo-meta.php');
}

require_once('meta/portfolio-meta.php');
require_once('meta/page-meta.php');
require_once('meta/post-meta.php');

require_once('theme-shortcodes.php');