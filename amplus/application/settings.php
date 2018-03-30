<?php
/**
 * Theme constants
 */

@define("BFI_ENABLE_PAGEBUILDER", false);
@define("BFI_ENABLE_PAGEMEDIA", true);
@define("BFI_CONTENTWIDTH", 920);

// @define("BFI_LIVEPREVIEWMODE", true);
// add_filter('show_admin_bar', '__return_false');

// post thumbnail support
@define("BFI_ENABLE_PORTFOLIO_FEATURED_IMAGE", true);
add_theme_support( 'post-thumbnails' );