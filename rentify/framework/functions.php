<?php


require_once(  get_template_directory() . '/framework/admin/allBreadcrumbs/arrowcrumbs.php' );

/*-------------------------------------------------------------------------
  START INITIALIZE FILE LINK
------------------------------------------------------------------------- */

require_once(  get_template_directory() . '/framework/constants.php' );
require_once(  get_template_directory() . '/framework/visual-composer/shortcodes.php' );
require_once(  get_template_directory() . '/framework/ext/extensions-setup.php' );
require_once(  get_template_directory() . '/framework/ext/rentify-catagories_one.php' );
require_once(  get_template_directory() . '/framework/ext/rentify-newsletter-subscription.php' );
require_once(  get_template_directory() . '/framework/ext/rentify-contact-info.php' );
require_once(  get_template_directory() . '/framework/ext/rentify-social.php' );
require_once(  get_template_directory() . '/framework/ext/rentify-company.php' );
require_once(  get_template_directory() . '/framework/ext/rentify-legal.php' );
require_once(  get_template_directory() . '/framework/ext/rentify-logo.php' );
require_once(  get_template_directory() . '/framework/ext/rentify-archives.php' );
require_once(  get_template_directory() . '/framework/ext/rentify-tag.php' );
require_once(  get_template_directory() . '/framework/ext/rentify-social.php' );
require_once(  get_template_directory() . '/framework/ext/rentify-categories.php' );
require_once(  get_template_directory() . '/framework/theme/style.php' );
require_once(  get_template_directory() . '/framework/theme/scripts.php' );
require_once(  get_template_directory() . '/framework/theme/rentify-image.php' );
require_once(  get_template_directory() . '/framework/theme/rentify-wpml.php' );
require_once(  get_template_directory() . '/framework/admin/functions.php' );
require_once(  get_template_directory() . '/framework/admin/theme-functions.php' );
require_once(  get_template_directory() . '/framework/admin/breadcrumbs.php' );
require_once(  get_template_directory() . '/framework/admin/allBreadcrumbs/arrowcrumbs.php' );
require_once(  get_template_directory() . '/framework/admin/rentify-menu-walker.php' );
require_once(  get_template_directory() . '/framework/admin/rentify-nav-menu-walker-two.php' );
require_once(  get_template_directory() . '/framework/admin/rentify-image.php' );


/*-------------------------------------------------------------------------
  END INITIALIZE FILE LINK
------------------------------------------------------------------------- */


/*-------------------------------------------------------------------------
  START ENQUEUING REDUX OPTION FRAMEWORK
------------------------------------------------------------------------- */

if ( !class_exists( 'ReduxFramework' ) && file_exists(  get_template_directory()  . '/framework/redux/ReduxCore/framework.php' ) ) {
    require_once(  get_template_directory()  . '/framework/redux/ReduxCore/framework.php' );
}
if ( !isset( $petra_option_data ) && file_exists(  get_template_directory()  . '/framework/redux/config/config.php' ) ) {
    require_once(  get_template_directory()  . '/framework/redux/config/config.php' );
}

/*-------------------------------------------------------------------------
  END ENQUEUING REDUX OPTION FRAMEWORK
------------------------------------------------------------------------- */


/*-------------------------------------------------------------------------
  START FUNCTION FOR NAV MENU ACTIVE CLASS
------------------------------------------------------------------------- */

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}

/*-------------------------------------------------------------------------
  END FUNCTION FOR NAV MENU ACTIVE CLASS
------------------------------------------------------------------------- */



