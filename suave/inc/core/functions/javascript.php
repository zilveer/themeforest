<?php

/* ----------------------------------------------------------------------------------- */
/*  Register and load common JS
  /*----------------------------------------------------------------------------------- */

function cg_register_production_js() {
    global $cg_live_preview;

    if ( !is_admin() ) {
        wp_enqueue_script( 'cg_waypoints', CG_JS . '/dist/waypoints.min.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'cg_bootstrap_js', CG_BOOTSTRAP_JS . '/bootstrap.min.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'cg_magnific-popup', CG_JS . '/src/cond/jquery.magnific-popup.min.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'cg_owlcarousel', CG_JS . '/src/cond/owl.carousel.min.js', array( 'jquery' ), '', false );
        wp_enqueue_script( 'cg_modernizr', CG_JS . '/src/cond/modernizr.custom.min.js', array( 'jquery' ), '', false );
        wp_enqueue_script( 'cg_ticker', CG_JS . '/src/cond/inewsticker.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'cg_quickview', CG_JS . '/src/cond/cg_quickview.js', array( 'jquery' ), '', true );
        wp_localize_script( 'cg_quickview', 'cg_ajax', array( 'cg_ajax_url' => admin_url( 'admin-ajax.php' ) ) );

        // Minified versions of all plugins in /js/src/plugins
        wp_enqueue_script( 'cg_commercegurus_plugins_js', CG_JS . '/dist/plugins.min.js', array( 'jquery' ), '', true );

        if ( isset( $cg_live_preview ) ) {
            wp_enqueue_script( 'cg-dynamicjs', CG_JS . '/src/cond/cgdynamic.php', array(), '', true );
            wp_enqueue_script( 'cg-jqueryui', CG_JS . '/src/cond/jquery-ui.min.js', array(), '', true );
            wp_enqueue_script( 'cg-livepreviewjs', CG_JS . '/src/cond/livepreview.js', array(), '', true );
        }

        // Minified commercegurus.js call from /js/src/commercegurus.js
        wp_enqueue_script( 'cg_commercegurus_js', CG_JS . '/dist/commercegurus.min.js', array( 'jquery' ), '', true );
    }
}

//add_action( 'wp_enqueue_scripts', 'cg_register_production_js' );

function cg_register_debug_js() {
    global $cg_live_preview;

    if ( !is_admin() ) {

        //Loading from unminified source

        wp_enqueue_script( 'cg_waypoints', CG_JS . '/dist/waypoints.min.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'cg_bootstrap_js', CG_BOOTSTRAP_JS . '/bootstrap.min.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'cg_magnific-popup', CG_JS . '/src/cond/jquery.magnific-popup.min.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'cg_modernizr', CG_JS . '/src/cond/modernizr.custom.min.js', array( 'jquery' ), '', false );
        wp_enqueue_script( 'cg_ticker', CG_JS . '/src/cond/inewsticker.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'cg_quickview', CG_JS . '/src/cond/cg_quickview.js', array( 'jquery' ), '', true );
        wp_localize_script( 'cg_quickview', 'cg_ajax', array( 'cg_ajax_url' => admin_url( 'admin-ajax.php' ) ) );

        wp_enqueue_script( 'cg_classie_js', CG_JS . '/src/plugins/classie.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'cg_uisearch_js', CG_JS . '/src/plugins/uisearch.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'cg_bootstrap_select_js', CG_JS . '/src/plugins/bootstrap-select.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'cg_owlcarousel', CG_JS . '/src/cond/owl.carousel.min.js', array( 'jquery' ), '', false );
        wp_enqueue_script( 'cg_jrespond', CG_JS . '/src/plugins/jRespond.min.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'cg_qtip', CG_JS . '/src/plugins/jquery.qtip.min.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'cg_tipr', CG_JS . '/src/plugins/tipr.min.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'cg_cookie', CG_JS . '/src/plugins/cookie.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'cg_meanmenu', CG_JS . '/src/plugins/jquery.meanmenu.min.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'cg_flexslider', CG_JS . '/src/plugins/jquery.flexslider-min.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'vc_jquery_skrollr_js', CG_JS . '/src/plugins/skrollr.js', array( 'jquery' ), '', true );

        if ( isset( $cg_live_preview ) ) {
            wp_enqueue_script( 'cg-dynamicjs', CG_JS . '/src/cond/capdynamic.php', array(), '', true );
            wp_enqueue_script( 'cg-jqueryui', CG_JS . '/src/cond/jquery-ui.min.js', array(), '', true );
            wp_enqueue_script( 'cg-livepreviewjs', CG_JS . '/src/cond/livepreview.js', array(), '', true );
        }

        // Full source commerceugurus.js call
        wp_enqueue_script( 'cg_commercegurus_js', CG_JS . '/src/commercegurus.js', array( 'jquery' ), '', true );
    }
}

//uncomment the next line if you wish to enqueue individual js files. If you uncomment the next line you will also need to comment out
//line 30 above-> add_action( 'init', 'cg_register_production_js' );
add_action( 'wp_enqueue_scripts', 'cg_register_debug_js' );

// load portfolio scripts only on portfolio template
function cg_showcase_js() {
    if ( (is_page_template( 'template-showcase-4col.php' )) || (is_page_template( 'template-showcase-4col-alt.php' )) || (is_page_template( 'template-showcase-3col.php' )) || (is_page_template( 'template-showcase-2col.php' )) ) {
        wp_enqueue_script( 'cg_imagesloaded', CG_JS . '/src/cond/imagesloaded.pkgd.min.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'cg_isotope', CG_JS . '/src/cond/isotope.pkgd.min.js', array( 'jquery' ), '1.0', false );
        wp_enqueue_script( 'cg_showcasejs', CG_JS . '/src/cond/jquery.tfshowcase.js', array( 'jquery' ), '1.0', false );
    }
}

add_action( 'wp_enqueue_scripts', 'cg_showcase_js' );

/**
 * Enqueue scripts and styles
 */
function cg_scripts() {

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    if ( is_singular() && wp_attachment_is_image() ) {
        wp_enqueue_script( 'cg-keyboard-image-navigation', CG_JS . '/src/cond/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
    }
}

add_action( 'wp_enqueue_scripts', 'cg_scripts' );

?>