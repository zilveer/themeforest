<?php

    /*
    *
    *	Swift Framework Main Class
    *	------------------------------------------------
    *	Swift Framework v3.0
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    */

    /* CORE FILES
    ================================================== */
    include_once( SF_FRAMEWORK_PATH . '/core/sf-base.php' );
    include_once( SF_FRAMEWORK_PATH . '/core/sf-breadcrumbs.php' );
    include_once( SF_FRAMEWORK_PATH . '/core/sf-comments.php' );
    include_once( SF_FRAMEWORK_PATH . '/core/sf-footer.php' );
    include_once( SF_FRAMEWORK_PATH . '/core/sf-formatting.php' );
    include_once( SF_FRAMEWORK_PATH . '/core/sf-functions.php' );
    include_once( SF_FRAMEWORK_PATH . '/core/sf-get-template.php' );
    include_once( SF_FRAMEWORK_PATH . '/core/sf-head.php' );
    include_once( SF_FRAMEWORK_PATH . '/core/sf-header.php' );
    include_once( SF_FRAMEWORK_PATH . '/core/sf-media.php' );
    include_once( SF_FRAMEWORK_PATH . '/core/sf-menus.php' );
    include_once( SF_FRAMEWORK_PATH . '/core/sf-page-heading.php' );
    include_once( SF_FRAMEWORK_PATH . '/core/sf-pagination.php' );
    include_once( SF_FRAMEWORK_PATH . '/core/sf-directory.php' );
    if ( sf_woocommerce_activated() ) {
        include_once( SF_FRAMEWORK_PATH . '/core/sf-supersearch.php' );
    }
    include_once( SF_FRAMEWORK_PATH . '/core/sf-woocommerce.php' );


    /* CONTENT FILES
    ================================================== */
    include_once( SF_FRAMEWORK_PATH . '/content/sf-blog.php' );
    include_once( SF_FRAMEWORK_PATH . '/content/sf-campaign-detail.php' );
    include_once( SF_FRAMEWORK_PATH . '/content/sf-download.php' );
    include_once( SF_FRAMEWORK_PATH . '/content/sf-galleries.php' );
    include_once( SF_FRAMEWORK_PATH . '/content/sf-pageslider.php' );
    include_once( SF_FRAMEWORK_PATH . '/content/sf-portfolio.php' );
    include_once( SF_FRAMEWORK_PATH . '/content/sf-portfolio-detail.php' );
    include_once( SF_FRAMEWORK_PATH . '/content/sf-post-detail.php' );
    include_once( SF_FRAMEWORK_PATH . '/content/sf-post-formats.php' );
    include_once( SF_FRAMEWORK_PATH . '/content/sf-products.php' );


    /* MEGA MENU
    ================================================== */
    include_once( SF_FRAMEWORK_PATH . '/sf-megamenu/sf-megamenu.php' );


    /* DISABLE MASTER SLIDER AUTO UPDATE
    ================================================== */
    add_filter( 'masterslider_disable_auto_update', '__return_true' );

?>
