<?php if(! defined('ABSPATH')){ return; }
/*--------------------------------------------------------------------------------------------------

	File: theme-options.php

	Description: This file contains all the theme's admin panel options

--------------------------------------------------------------------------------------------------*/

/*--------------------------------------------------------------------------------------------------
	Start General Options
--------------------------------------------------------------------------------------------------*/
$admin_options = array();

include( dirname(__file__). '/theme-options-pages/general-options/general-options.php' );
include( dirname(__file__). '/theme-options-pages/general-options/header-advanced-options.php' );
include( dirname(__file__). '/theme-options-pages/general-options/logo-options.php' );
include( dirname(__file__). '/theme-options-pages/general-options/header-options.php' );
// include( dirname(__file__). '/theme-options-pages/general-options/infocard-options.php' );
include( dirname(__file__). '/theme-options-pages/general-options/cta-options.php' );
include( dirname(__file__). '/theme-options-pages/general-options/nav-options.php' );
include( dirname(__file__). '/theme-options-pages/general-options/footer-options.php' );
include( dirname(__file__). '/theme-options-pages/general-options/default-header-options.php' );
include( dirname(__file__). '/theme-options-pages/general-options/google-analytics-options.php' );
include( dirname(__file__). '/theme-options-pages/general-options/mailchimp-options.php' );
include( dirname(__file__). '/theme-options-pages/general-options/recaptcha-options.php' );

/* Google fonts setup */
include( dirname(__file__). '/theme-options-pages/font-options/general-font-options.php' );

/* Font options */
include( dirname(__file__). '/theme-options-pages/font-options/headings-options.php' );
include( dirname(__file__). '/theme-options-pages/font-options/body-fonts-options.php' );
// include( dirname(__file__). '/theme-options-pages/font-options/main-menu-font-options.php' );
include( dirname(__file__). '/theme-options-pages/font-options/alternative-font-options.php' );

/* Blog options */
include( dirname(__file__). '/theme-options-pages/blog-options/archive-options.php' );
include( dirname(__file__). '/theme-options-pages/blog-options/single-blog-item-options.php' );

/* Portfolio options */
include( dirname(__file__). '/theme-options-pages/portfolio-options.php' );

/* Documentation options */
include( dirname(__file__). '/theme-options-pages/documentation-options.php' );

/* Layout options */
include( dirname(__file__). '/theme-options-pages/layout-options.php' );

/* PB templates */
include( dirname(__file__). '/theme-options-pages/pb-templates.php' );

/* Color options */
include( dirname(__file__). '/theme-options-pages/color-options/color-options.php' );
include( dirname(__file__). '/theme-options-pages/color-options/color-options-palette.php' );

/* Unlimited headers options */
include( dirname(__file__). '/theme-options-pages/unlimited-headers-options.php' );

/* Unlimited sidebars options */
include( dirname(__file__). '/theme-options-pages/unlimited-sidebars.php' );

/* Coming soon options */
include( dirname(__file__). '/theme-options-pages/coming-soon-options.php' );

/* 404 options */
include( dirname(__file__). '/theme-options-pages/404-page-options.php' );

/* advanced options */
include( dirname(__file__). '/theme-options-pages/advanced-options.php' );
