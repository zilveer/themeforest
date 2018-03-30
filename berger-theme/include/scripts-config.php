<?php
/**
 * Created by Clapat.
 * Date: 29/05/14
 * Time: 6:26 AM
 */

if ( ! function_exists( 'clapat_bg_load_scripts' ) ){

    function clapat_bg_load_scripts() {

        // Register css files
        wp_register_style( 'cbg_flexslider', get_template_directory_uri() . '/css/flexslider.css', TRUE);

        wp_register_style( 'cbg_fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', TRUE);

        wp_register_style( 'cbg_sliders', get_template_directory_uri() . '/css/sliders.css', TRUE);
        
        if( function_exists('is_woocommerce') ){

			wp_register_style( 'cbg_shop', get_template_directory_uri() . '/css/shop.css' );
        }
        
		wp_register_style( 'cbg_colorbox', get_template_directory_uri() . '/css/colorbox.css', TRUE);
                
        // Register scripts
        wp_register_script(
            'cbg_plugins',
            get_template_directory_uri() . '/js/plugins.js',
            'jquery',
            false,
            true
        );

        wp_register_script(
            'cbg_scriptsjs',
            get_template_directory_uri() . '/js/scripts.js',
            'jquery',
            false,
            true
        );
        
        wp_register_script(
            'cbg_customjs',
            get_template_directory_uri() . '/js/custom_js.js',
            'jquery',
            false,
            true
        );
		
        wp_enqueue_style('cbg_flexslider');
        wp_enqueue_style('cbg_sliders');
        
    	if ( function_exists( 'vc_set_as_theme' ) ) {
        	//to allow using visual composer in pages loaded with AJAX
        	wp_enqueue_style( 'js_composer_front' );
        }
        
        if( function_exists('is_woocommerce') ){
        	wp_enqueue_style('cbg_shop');
        }
        
        wp_enqueue_style('cbg_colorbox');
        wp_enqueue_style('theme', get_stylesheet_uri(), array('cbg_sliders', 'cbg_colorbox'));
        wp_enqueue_style('cbg_fontawesome');

		// enqueue standard font style
        $protocol = is_ssl() ? 'https' : 'http';
        wp_enqueue_style( 'clapat-berger-font', "".$protocol."://fonts.googleapis.com/css?family=Montserrat:400,700");

        // enqueue scripts
        wp_enqueue_script(
            'jquery'
        );
        
		wp_enqueue_script(
            'cbg_plugins'
        );

        if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
		
        if ( function_exists( 'vc_set_as_theme' ) ) {
        	//to allow using visual composer in pages loaded with AJAX
        	wp_enqueue_script( 'wpb_composer_front_js' );
        }
        
        wp_enqueue_script(
            'cbg_scriptsjs'
        );

        // enqueue all scripts parameters here, pages from menu are ajax links
		global $clapat_bg_theme_options; 

		wp_localize_script( 'cbg_scriptsjs',
                    'FullScreenSliderOptions',
                    array(  "slider_direction"   => $clapat_bg_theme_options['clapat_bg_slider_direction'],
                            "slider_speed"       => ($clapat_bg_theme_options['clapat_bg_slider_speed'] * 1000),
                            "slider_autoplay"    => ($clapat_bg_theme_options['clapat_bg_slider_autoplay'] ? true : false),
							"slider_controls"    => ($clapat_bg_theme_options['clapat_bg_slider_arrow_cursor'] ? "" : "#static-slider-nav"),
                            "slider_transition"  => $clapat_bg_theme_options['clapat_bg_slider_transition'] ) );
                    
		wp_localize_script( 'cbg_scriptsjs',
							'ClapatMapOptions',
							array(  "map_marker_image"   	=> esc_js( esc_url ( $clapat_bg_theme_options["clapat_bg_map_marker"]["url"] ) ),
									"map_address"       	=> $clapat_bg_theme_options['clapat_bg_map_address'],
									"map_zoom"    			=> $clapat_bg_theme_options['clapat_bg_map_zoom'],
									"marker_title"  		=> $clapat_bg_theme_options['clapat_bg_map_company_name'],
									"marker_text"  			=> $clapat_bg_theme_options['clapat_bg_map_company_info'],
									"map_type" 				=> $clapat_bg_theme_options['clapat_bg_map_type'],
									"map_api_key"			=> $clapat_bg_theme_options['clapat_bg_map_api_key'] ) );
							
		wp_localize_script( 'cbg_scriptsjs',
							'ClapatSecondaryMenuOptions',
							array(  "filters_on"       	=> $clapat_bg_theme_options['clapat_bg_portfolio_secondary_menu_hide'],
									"filters_off"    	=> $clapat_bg_theme_options['clapat_bg_portfolio_secondary_menu_show'],
									"contact_on"       	=> $clapat_bg_theme_options['clapat_bg_map_secondary_menu_hide'],
									"contact_off"    	=> $clapat_bg_theme_options['clapat_bg_map_secondary_menu_show'],
									"search_on"       	=> $clapat_bg_theme_options['clapat_bg_blog_secondary_menu_hide'],
									"search_off"    	=> $clapat_bg_theme_options['clapat_bg_blog_secondary_menu_show'],
									"share_on"       	=> $clapat_bg_theme_options['clapat_bg_blog_post_secondary_menu_hide'],
									"share_off"    		=> $clapat_bg_theme_options['clapat_bg_blog_post_secondary_menu_show'],
									"prod_filters_on"  	=> $clapat_bg_theme_options['clapat_bg_shop_filters_hide'],
									"prod_filters_off" 	=> $clapat_bg_theme_options['clapat_bg_shop_filters_show'] ) );

		wp_enqueue_script(
            'cbg_customjs'
        );					
							
    }

}

add_action('wp_enqueue_scripts', 'clapat_bg_load_scripts');



if ( ! function_exists( 'clapat_bg_admin_load_scripts' ) ){

    function clapat_bg_admin_load_scripts() {

        wp_register_script(
            'templateformatjs',
            get_template_directory_uri() . '/js/templateformat.js',
            'jquery',
            false,
            true
        );

        wp_enqueue_script(
            'templateformatjs'
        );

    }

}

add_action( 'admin_enqueue_scripts', 'clapat_bg_admin_load_scripts' );