<?php
add_action( 'wp_enqueue_scripts', 'tfuse_add_css' );
add_action( 'wp_enqueue_scripts', 'tfuse_add_js' );

if ( ! function_exists( 'tfuse_add_css' ) ) :
    // This function include files of css.
    function tfuse_add_css()
    {
		wp_register_style( 'bootstrap',  tfuse_get_file_uri('/css/bootstrap.css', false, '') );
        wp_enqueue_style( 'bootstrap' );
        
        wp_register_style( 'style', get_stylesheet_uri());
        wp_enqueue_style( 'style' );
		
		wp_register_style( 'fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,800,700italic,800italic,300italic');
		wp_enqueue_style( 'fonts' );
		
        wp_register_style( 'screen_css', tfuse_get_file_uri('/screen.css'));
        wp_enqueue_style( 'screen_css' );

        wp_register_style( 'custom', tfuse_get_file_uri('/custom.css'), false, '' );
        wp_enqueue_style( 'custom' );

        wp_register_style( 'cusel', tfuse_get_file_uri('/css/cusel.css'), false, '' );
        wp_enqueue_style( 'cusel' );

        wp_register_style( 'custom_admin', tfuse_get_file_uri('/css/custom_admin.css'), false, '' );
        wp_enqueue_style( 'custom_admin`' );
        
        wp_register_style( 'prettyPhoto', TFUSE_ADMIN_CSS . '/prettyPhoto.css', false, '' );
        wp_enqueue_style( 'prettyPhoto' );
        
        wp_register_style( 'shCore', tfuse_get_file_uri('/css/shCore.css'), true, '' );
        wp_enqueue_style( 'shCore' );

        wp_register_style( 'shThemeDefault', tfuse_get_file_uri('/css/shThemeDefault.css'), true, '' );
        wp_enqueue_style( 'shThemeDefault' );
    }
endif;


if ( ! function_exists( 'tfuse_add_js' ) ) :
    // This function include files of javascript.
    function tfuse_add_js()
    {
        wp_register_script( 'modernizr', tfuse_get_file_uri('/js/libs/modernizr.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'modernizr' );	
		
        wp_register_script( 'respond', tfuse_get_file_uri('/js/libs/respond.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'respond' );

        wp_register_script( 'bootstrap', tfuse_get_file_uri('/js/bootstrap.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'bootstrap' );

        wp_register_script( 'jquery.easing', tfuse_get_file_uri('/js/jquery.easing.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.easing' );
		
		wp_register_script( 'hoverIntent', tfuse_get_file_uri('/js/hoverIntent.js'), array('jquery'), '', true );
        wp_enqueue_script( 'hoverIntent' );

        wp_register_script( 'general', tfuse_get_file_uri('/js/general.js'), array('jquery'), '', true );
        wp_enqueue_script( 'general' );
		
		wp_register_script( 'carouFredSel', tfuse_get_file_uri('/js/jquery.carouFredSel.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'carouFredSel' );
		
		wp_register_script( 'touchSwipe', tfuse_get_file_uri('/js/jquery.touchSwipe.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'touchSwipe' );

        wp_register_script( 'cusel-min', tfuse_get_file_uri('/js/cusel-min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'cusel-min' );

        wp_register_script( 'prettyPhoto', TFUSE_ADMIN_JS . '/jquery.prettyPhoto.js', array('jquery'), '3.1.4', true );
        wp_enqueue_script( 'prettyPhoto' );
        
        wp_register_script( 'jquery.gmap', tfuse_get_file_uri('/js/jquery.gmap.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.gmap' );

        if ( tfuse_options('enable_preload_css') )
        {
            wp_register_script( 'preloadCssImages', tfuse_get_file_uri('/js/preloadCssImages.js'), array('jquery'), '5.0', true );
            wp_enqueue_script( 'preloadCssImages' );
        }
    }
endif;