<?php if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

/**
 * default theme constants - do not change
 *
 * @since 1.0
 */
 
define('UT_THEME_NAME', 'Brooklyn');
define('UT_THEME_VERSION', '4.1.1');

/* activates all admin features of option tree */
define('UT_DEV_MODE', false ); /* deprecated */

/* layout loader */ 
include_once( get_template_directory() . '/admin/ut-layout-loader.php' ); /* deprecated */

/* migration tool */
include_once( get_template_directory() . '/admin/ut-migration-tool.php' );

/* load unite framework , will be the new core of next bklyn versions */
require_once( 'unite/unite-init.php' );



/**
 * Helper Function: to detect already installed plugin
 *
 * @since 1.0
 */

if ( !function_exists( 'ut_is_plugin_active' ) ) {
    
    function ut_is_plugin_active( $plugin ) {
        
        if( is_multisite() && array_key_exists( $plugin , get_site_option('active_sitewide_plugins', array() ) ) ) {
                        
            return array_key_exists( $plugin , get_site_option('active_sitewide_plugins', array() ) );
            
        } elseif( is_multisite() && in_array( $plugin, (array) get_option( 'active_plugins', array() ) ) ) {
                        
            return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
            
        } else {
            
            return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
            
        }        
        
    }
    
}

/*
|--------------------------------------------------------------------------
| Option Tree Integration - deprecated will be removed in a future version 
|--------------------------------------------------------------------------
*/

/* only include these files if option tree is not active as a plugin */
if( !ut_is_plugin_active('option-tree/ot-loader.php') ) {

    add_filter( 'ot_show_new_layout', '__return_true' ); // activate layout management
    add_filter( 'ot_theme_mode'     , '__return_true' ); // acitvate theme mode
    
    if( !UT_DEV_MODE ) {
        add_filter( 'ot_show_pages', '__return_false' ); // hide ot docs & settings
    }
    
    include_once( THEME_DOCUMENT_ROOT . '/admin/ot-loader.php' );
    include_once( THEME_DOCUMENT_ROOT . '/admin/ut-admin-loader.php' );
    
    
    /* MetaBoxes */
    include_once( THEME_DOCUMENT_ROOT . '/admin/metaboxes/ut-metabox-main-panel.php' );
    include_once( THEME_DOCUMENT_ROOT . '/admin/metaboxes/ut-metabox-onepage-settings.php');
    include_once( THEME_DOCUMENT_ROOT . '/admin/metaboxes/ut-metabox-page-settings.php' ); 
    include_once( THEME_DOCUMENT_ROOT . '/admin/metaboxes/ut-metabox-hero-settings.php' );
    include_once( THEME_DOCUMENT_ROOT . '/admin/metaboxes/ut-metabox-header-settings.php' );
    include_once( THEME_DOCUMENT_ROOT . '/admin/metaboxes/ut-metabox-csection-settings.php' );
    //include_once( THEME_DOCUMENT_ROOT . '/admin/metaboxes/ut-metabox-navigation-settings.php' ); @todo
    include_once( THEME_DOCUMENT_ROOT . '/admin/metaboxes/ut-metabox-color-settings.php' );
    
    
    if( ut_is_plugin_active('ut-portfolio/ut-portfolio.php') ) {
        include_once( THEME_DOCUMENT_ROOT . '/admin/metaboxes/ut-metabox-portfolio-settings.php' );
    }
        
    include_once( THEME_DOCUMENT_ROOT . '/admin/ut-sidebar-settings.php' );   
    include_once( THEME_DOCUMENT_ROOT . '/admin/ut-theme-options.php' );
    include_once( THEME_DOCUMENT_ROOT . '/admin/includes/ut-google-fonts.php' );
    
} else {
    
    function ut_notify_user_ot_detected() {
        
        $alert = '<div class="ut-alert red" style="position:fixed; z-index:9999; width:100%; text-align:center;">';
            $alert .= esc_html__('Option Tree Plugin has been detected! Please deactivate this Plugin to prevent themecrashes and failures!', 'unitedthemes' );
         $alert .= '</div>';
        
        echo $alert;
        
    }
    
    /* display user information on front page with the help of the ut_before_header_hook */
    add_action( 'ut_before_header_hook', 'ut_notify_user_ot_detected' );

}






if( is_admin() ){
        
    /* theme demo importer */
    include_once( THEME_DOCUMENT_ROOT . '/admin/ut-demo-importer.php' );
    
}





/**
 * Visual Composer
 *
 * @since     4.0
 */

include_once( THEME_DOCUMENT_ROOT . '/vc/vc-config.php' );
include_once( THEME_DOCUMENT_ROOT . '/vc/vc-params.php' );
include_once( THEME_DOCUMENT_ROOT . '/vc/vc-filters.php' );


/**
 * Woocommerce
 */

if( ut_is_plugin_active('woocommerce/woocommerce.php') ) {
    
    /* remove default woocommerce content wrapper */
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action( 'woocommerce_after_main_content' , 'woocommerce_output_content_wrapper_end', 10);
    
}


/**
 * Default Content Width
 */
 
if ( !isset( $content_width ) ) {
    $content_width = 1170; /* pixels */
}


/**
 * Load required files
 */
include_once( THEME_DOCUMENT_ROOT . '/inc/sidebars/index.php' );    /* deprecated */
include_once( THEME_DOCUMENT_ROOT . '/inc/ut-theme-hooks.php' );    /* deprecated */



include_once( THEME_DOCUMENT_ROOT . '/inc/ut-image-resize.php' );
include_once( THEME_DOCUMENT_ROOT . '/inc/ut-theme-postformat-tools.php' );
include_once( THEME_DOCUMENT_ROOT . '/inc/ut-theme-gallery.php' );
include_once( THEME_DOCUMENT_ROOT . '/inc/ut-prepare-header.php' );
include_once( THEME_DOCUMENT_ROOT . '/inc/ut-prepare-hero.php' );
include_once( THEME_DOCUMENT_ROOT . '/inc/ut-prepare-front-page.php' );
include_once( THEME_DOCUMENT_ROOT . '/inc/ut-prepare-csection.php' );
include_once( THEME_DOCUMENT_ROOT . '/inc/ut-section-player.php' );
include_once( THEME_DOCUMENT_ROOT . '/inc/ut-menu-walker.php' );




/* can be placed within the child theme */
if( file_exists( STYLE_DOCUMENT_ROOT . '/inc/ut-custom-css.php' ) ) {
    
    /* file inside child theme */
    include_once( STYLE_DOCUMENT_ROOT . '/inc/ut-custom-css.php' ) ;

} else {
    
    /* file inside main theme */
    include_once( THEME_DOCUMENT_ROOT . '/inc/ut-custom-css.php' ) ;    
    
}

/* can be placed within the child theme */
if( file_exists( STYLE_DOCUMENT_ROOT . '/inc/ut-custom-js.php' ) ) {
    
    /* file inside child theme */
    include_once( STYLE_DOCUMENT_ROOT . '/inc/ut-custom-js.php' );

} else {
    
    /* file inside main theme */
    include_once( THEME_DOCUMENT_ROOT . '/inc/ut-custom-js.php' );
    
}

include_once( THEME_DOCUMENT_ROOT . '/inc/css/navigation.php' );
include_once( THEME_DOCUMENT_ROOT . '/inc/css/front.php' );
include_once( THEME_DOCUMENT_ROOT . '/inc/css/blog.php' );
include_once( THEME_DOCUMENT_ROOT . '/inc/css/page.php' );
include_once( THEME_DOCUMENT_ROOT . '/inc/css/footer.php' ) ;


/*
|--------------------------------------------------------------------------
| include all custom widgets
|--------------------------------------------------------------------------
*/
foreach ( glob( dirname(__FILE__)."/widgets/*.php" ) as $filename ){
    include_once( $filename );
}


/*
|--------------------------------------------------------------------------
| Enqueue scripts and styles
|--------------------------------------------------------------------------
*/
if ( ! function_exists( 'unitedthemes_scripts' ) ) :

    function unitedthemes_scripts() {
                
        $min = NULL;
            
        if( !WP_DEBUG ){
            $min = '.min';
        }        
        
        /*
        |--------------------------------------------------------------------------
        | CSS
        |--------------------------------------------------------------------------
        */
        
        /* Fonts */
        wp_enqueue_style(
            'main-font-face',
            THEME_WEB_ROOT . '/css/ut-fontface' . $min . '.css'
        );        
        
        /* Google Fonts */
        ut_create_google_font_link();
                
        /* Grid and Responsive */
        wp_enqueue_style(
            'ut-responsive-grid',
            THEME_WEB_ROOT . '/css/ut-responsive-grid' . $min . '.css' 
        );
                
        /* Flexslider */
        wp_enqueue_style(
            'ut-flexslider',
            THEME_WEB_ROOT . '/css/flexslider' . $min . '.css'
        );
        
        /* lightbox script */
        $ut_lightbox_script = ot_get_option('ut_lightbox_script' , 'prettyphoto'); 
                
        if( $ut_lightbox_script == 'prettyphoto' ) :
        
            /* Prettyphoto */
            wp_enqueue_style(
                'ut-prettyphoto',
                THEME_WEB_ROOT . '/css/prettyPhoto' . $min . '.css'
            );
        
        else :
            
            /* Lightgallery */
            wp_enqueue_style(
                'ut-lightgallery',
                THEME_WEB_ROOT . '/assets/vendor/lightGallery/css/lightgallery' . $min . '.css'
            );
            
        endif;
        
        /* Main Navigation */
        wp_enqueue_style(
            'ut-superfish',
            THEME_WEB_ROOT . '/css/ut-superfish' . $min . '.css'
        );
        
        /* Animate CSS */
        wp_enqueue_style(
            'ut-animate',
            THEME_WEB_ROOT . '/css/ut.animate' . $min . '.css'
        );
        
        /* fancy slider */
        if( ut_return_hero_config( 'ut_hero_type' ) == 'transition' ) {
            
            wp_enqueue_style(
                'ut-fancy-slider',
                THEME_WEB_ROOT . '/css/ut-fancyslider' . $min . '.css'
            );
            
        }
        
        /* Main CSS */
        wp_enqueue_style(
            'unitedthemes-style',
            get_stylesheet_uri(),
            array(), 
            UT_THEME_VERSION
        );
        
        /*
        |--------------------------------------------------------------------------
        | JavaScript
        |--------------------------------------------------------------------------
        */    
                
        /* base javaScripts header */
        wp_enqueue_script( 'jquery' );
        
        /* cookie law - todo */
        /*if( ot_get_option('ut_activate_cookie_law' , 'off') == 'on' ) {
            wp_enqueue_script( 'ut-cookie'             , THEME_WEB_ROOT . '/js/jquery.ckie.min.js', array('jquery') , '1.4.1' );
            wp_enqueue_script( 'ut-cookie-law'         , THEME_WEB_ROOT . '/js/jquery.ckie.law.js', array('jquery') , '1.0' );
        }*/        
        
        /* preloader */
        if( ot_get_option('ut_use_image_loader') == 'on' ) {
            
            $loader_for = ot_get_option('ut_use_image_loader_on');
            $loader_match = false;
            
            if( !empty( $loader_for ) && is_array( $loader_for ) ) :    
            
                foreach( $loader_for as $key => $conditional ) {
                
                    if( $conditional() && $conditional != 'is_singular' ) {

                        $loader_match = true;
                        
                        /* front page gets handeled as a page too */
                        if( $conditional == 'is_page' && is_front_page() ) {
                            
                            $loader_match = false;
                        
                        } elseif( $conditional == 'is_single' && is_singular('portfolio') ) {
                           
                            $loader_match = false;
                                
                        } else {
                        
                            /* we have a match , so we can stop the loop */
                            break;
                        
                        }
                        
                    }
                    
                    if( $conditional( 'portfolio' ) && $conditional == 'is_singular' ) {
                        
                        $loader_match = true;
                        break;
                    
                    }
                
                }
            
            endif;
            
            if( $loader_match ) : 
            
                wp_enqueue_script(
                    'ut-loader',
                    THEME_WEB_ROOT . '/js/jquery.queryloader2' . $min . '.js',
                    array('jquery'),
                    '2.9.0',
                    false
                );                 
            
            endif;
                        
        }    
        
         wp_enqueue_script( 
            'ut-smartresize',
            THEME_WEB_ROOT . '/js/jquery.ut.smartresize' . $min . '.js', 
            array('jquery'), 
            '1.0'
        );
        
        /* browser and mobile detection */
        wp_enqueue_script( 
            'modernizr',
            THEME_WEB_ROOT . '/js/modernizr' . $min . '.js', 
            array('jquery'), 
            '2.6.2'
        );
                        
        /* comment reply*/
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }        
        
        /* 
         * base Java Scripts // output in footer 
         */
           
        /* easing */
        wp_enqueue_script(
            'ut-easing',
            THEME_WEB_ROOT . '/js/jquery.easing' . $min . '.js',
            array('jquery'),
            '1.3',
            true
        );
        
        /* superfish navigation */
        wp_enqueue_script(
            'ut-superfish',
            THEME_WEB_ROOT . '/js/superfish' . $min . '.js', 
            array('jquery'), 
            '1.7.4',
            true 
        );        
        
        /* smothscroll only for chrome desktop */
        if( ot_get_option( 'ut_smooth_scroll' , 'on' ) == 'on' && preg_match("/chrome/",strtolower($_SERVER['HTTP_USER_AGENT'])) && !unite_mobile_detection()->isMobile() ) {
            
            /* now check if user is using a Windows PC */
            $user_agent = getenv("HTTP_USER_AGENT");
            
            if( strpos($user_agent, "Win") !== false ) {
                
                wp_enqueue_script(
                    'ut-smoothscroll',
                    THEME_WEB_ROOT . '/js/SmoothScroll' . $min . '.js', 
                    array('jquery'),
                    '0.9.9',
                    true
                );
                
            }
            
        }
        
        /* retina images */
        wp_enqueue_script( 
            'ut-retina',
            THEME_WEB_ROOT . '/js/retina.min.js', 
            array('jquery'), 
            '1.3',
            true
        );
        
        
        /* background video player , load only when needed */
        if( !unite_mobile_detection()->isMobile() && ut_return_hero_config('ut_hero_type') == 'video' || !unite_mobile_detection()->isMobile() && ut_return_hero_config('ut_hero_type') == 'tabs' && ut_return_hero_config('ut_video_containment', 'hero') == 'body' ) :
            
            wp_enqueue_script(
                'ut-bgvid',
                THEME_WEB_ROOT . '/js/jquery.mb.YTPlayer' . $min . '.js',
                array('jquery'),
                '1.7.15', 
                true
            ); 
            
        endif;
        
        /* rain effect, load only when needed */
        if( ut_return_hero_config( 'ut_hero_rain_effect' , 'off' ) == 'on' ) {
            
            wp_enqueue_script(
                'ut-rain',
                THEME_WEB_ROOT . '/js/rainyday' . $min . '.js', 
                array('jquery'),
                '1.0',
                true
            );
                        
        }
        
        /* selfhosted video player */
        if( ut_return_hero_config('ut_video_source' , 'youtube') == 'selfhosted' ) {
           
            wp_enqueue_script(
                'ut-video',
                THEME_WEB_ROOT . '/js/ut-videoplayer' . $min . '.js', 
                array('jquery'),
                '1.0',
                true
            );
            
        }
        
        /* fancy slider */
        if( ut_return_hero_config( 'ut_hero_type' ) == 'transition' ) {
            
            wp_enqueue_script(
                'ut-fancy-slider',
                THEME_WEB_ROOT . '/js/ut-fancyslider' . $min . '.js',
                array('jquery'),
                '1.0',
                true
            );
            
        }
        
        /* overlay animation effect */
       if( ut_return_hero_config( 'ut_hero_overlay_effect', 'off' ) == 'on' ) {
            
            
            wp_enqueue_script(
                'ut-greensock-tweenlite', 
                THEME_WEB_ROOT . '/js/greensock/TweenLite' . $min . '.js', 
                array(), 
                '1.0',
                true 
            );            
            
            wp_enqueue_script(
                'ut-greensock-easepack',
                THEME_WEB_ROOT . '/js/greensock/EasePack' . $min . '.js',
                array('ut-greensock-tweenlite'),
                '1.0',
                true
            );
                        
            wp_enqueue_script(
                'ut-animation-frame', 
                THEME_WEB_ROOT . '/js/greensock/AnimationFrame.js', 
                array('ut-greensock-easepack'),
                '1.0',
                true
            );
            
            /* connecting dots overlay */
            if( ut_return_hero_config( 'ut_hero_overlay_effect_style' ) == 'dots' ) {
                
                wp_enqueue_script(
                    'ut-connecting-dots',
                    THEME_WEB_ROOT . '/js/canvas.connectingdots' . $min . '.js', 
                    array('ut-animation-frame'),
                    '1.0', 
                    true
                );            
                
            }
            
            /* rising bubbles overlay */
            if( ut_return_hero_config( 'ut_hero_overlay_effect_style' ) == 'bubbles' ) {
                
                wp_enqueue_script(
                    'ut-rising-bubbles',
                    THEME_WEB_ROOT . '/js/canvas.risingbubbles' . $min . '.js', 
                    array('ut-animation-frame'),
                    '1.0',
                    true
                );
                
            }
            
        }
        
        /* flexslider for slider headers */
        wp_enqueue_script(
            'ut-flexslider-js', 
            THEME_WEB_ROOT . '/js/jquery.flexslider' . $min . '.js',
            '2.2.2',
            true
        ); 
        
        /* parallax for section backgrounds */
        wp_enqueue_script(
            'ut-parallax',
            THEME_WEB_ROOT . '/js/jquery.parallax' . $min . '.js',
            array('jquery'), 
            '1.1.3',
            true
        );
        
        /* scroll to section */
        wp_enqueue_script(
            'ut-scrollTo',
            THEME_WEB_ROOT . '/js/jquery.scrollTo' . $min . '.js',
            array('jquery'),
            '1.4.6', 
            true
        );
        
        /* simple waypoints */
        wp_enqueue_script(
            'ut-waypoints',
            THEME_WEB_ROOT . '/js/jquery.waypoints' . $min . '.js', 
            array('jquery'),
            '2.0.5',
            true
        );        
        
        /* lightbox script */
        $ut_lightbox_script = ot_get_option('ut_lightbox_script' , 'prettyphoto'); 
        
        if( $ut_lightbox_script == 'prettyphoto' ) :
        
            /* prettyphoto */
            wp_enqueue_script(
                'ut-prettyphoto',
                THEME_WEB_ROOT . '/js/jquery.prettyPhoto' . $min . '.js', 
                array('jquery'), 
                '3.1.6',
                true
            );
        
        else :
            
            /* lightgallery */            
            wp_enqueue_script(
                'ut-lightgallery-js',
                THEME_WEB_ROOT . '/assets/vendor/lightGallery/js/lightgallery-all' . $min . '.js' , 
                array('jquery'),
                '1.2.6',
                true            
            );             
        
        endif;        
                
        /* Fit Vid for embeded videos*/    
        wp_enqueue_script( 
            'ut-fitvid',
            THEME_WEB_ROOT . '/js/jquery.fitvids' . $min. '.js',
            array('jquery'),
            '1.0.3', 
            true
        );        
        
        /* fit text for hero style 11 */    
        if( ut_return_hero_config('ut_hero_style' , 'ut-hero-style-1') == 'ut-hero-style-11' ) {
            
            wp_enqueue_script(
                'ut-fittext',
                THEME_WEB_ROOT . '/js/jquery.fittext' . $min. '.js',
                array('jquery'),
                '1.2', 
                true
            );
            
        }
                
        /* ut social share */
        wp_enqueue_script(
            'ut-social-share',
            THEME_WEB_ROOT . '/js/ut-share' . $min. '.js', 
            array('jquery'),
            '1.0', 
            true
        );  
        
        /* lazy load */
        wp_enqueue_script(
            'ut-lazyload-js',
            THEME_WEB_ROOT . '/js/jquery.lazyload' . $min. '.js',
            array('jquery'),
            '1.9.7',
            false
        );
        
        
        /* Custom JavaScripts - you can use this file inside the child theme or use the footer java hook */
        wp_enqueue_script(
            'unitedthemes-init', 
            STYLE_WEB_ROOT . '/js/ut-init' . $min . '.js',
            array('jquery'), 
            UT_THEME_VERSION, true
        );
        
        /* retina logos with fallback */
        $ut_activate_page_hero = get_post_meta( get_the_ID() , 'ut_activate_page_hero' , true );  
        
        $sitelogo_retina = !is_front_page() && !is_home() && ( $ut_activate_page_hero == 'off' || empty( $ut_activate_page_hero ) ) ? get_theme_mod( 'ut_site_logo_alt_retina' ) ? get_theme_mod( 'ut_site_logo_alt_retina' ) : get_theme_mod( 'ut_site_logo_retina' ) : get_theme_mod( 'ut_site_logo_retina' );                        
        $alternate_logo_retina = get_theme_mod( 'ut_site_logo_alt_retina' ) ? get_theme_mod( 'ut_site_logo_alt_retina' ) : get_theme_mod( 'ut_site_logo_retina' );
        
        $retina_logos = array('sitelogo_retina' => $sitelogo_retina , 'alternate_logo_retina' => $alternate_logo_retina );        
        
        wp_localize_script('unitedthemes-init' , 'retina_logos' , $retina_logos );
        
        /* pre loader settings */
        $loader_settings = array( 'loader_logo' => ot_get_option('ut_image_loader_logo'), 'style' => ot_get_option( 'ut_image_loader_style', 'style_one' ), 'loader_percentage' => ot_get_option( 'ut_show_loader_percentage', 'on' ), 'loader_text' => ot_get_option( 'ut_image_loader_text', 'loading' ) );
        wp_localize_script('unitedthemes-init' , 'preloader_settings' , $loader_settings );
        
        
        /* set volume for rain effect */        
        if( ut_return_hero_config('ut_hero_rain_sound' , 'off') == 'on' ) {
        
            wp_localize_script( 'wp-mediaelement', '_wpmejsSettings', array(
                'pluginPath' => includes_url( 'js/mediaelement/', 'relative' ),
                'startVolume' => 0.1
            ) );
        
        }
        
        
    }
    
    add_action( 'wp_enqueue_scripts', 'unitedthemes_scripts' );

endif;

/*
|--------------------------------------------------------------------------
| Custom template tags for this theme
|--------------------------------------------------------------------------
*/
require get_template_directory() . '/inc/ut-template-tags.php';


/*
|--------------------------------------------------------------------------
| Custom functions that act independently of the theme templates.
|--------------------------------------------------------------------------
*/
require get_template_directory() . '/inc/ut-extras.php';


/*
|--------------------------------------------------------------------------
| WordPress Customizer
|--------------------------------------------------------------------------
*/
require get_template_directory() . '/inc/ut-customizer.php';


/*
|--------------------------------------------------------------------------
| Recognized Font Families
|--------------------------------------------------------------------------
*/

if ( !function_exists( 'ut_recognized_font_styles' ) ) {

    function ut_recognized_font_styles() {
      
      return apply_filters( 'ut_recognized_font_styles', array(
            "extralight" => "ralewayextralight",
            "light"      => "ralewaylight",
            "regular"    => "ralewayregular",
            "medium"     => "ralewaymedium",
            "semibold"   => "ralewaysemibold",
            "bold"       => "ralewaybold"        
      ));
      
    }
    
}

if ( !function_exists( 'ut_recognized_families' ) ) {

    function ut_recognized_font_families( $basefonts ) {
            
          $newfonts = array(
                "ralewayextralight"     => "Raleway Extralight",
                "ralewaylight"          => "Raleway Light",
                "ralewayregular"        => "Raleway Regular",
                "ralewaymedium"         => "Raleway Medium",
                "ralewaysemibold"       => "Raleway Semibold",
                "ralewaybold"           => "Raleway Bold"        
        );
        
        $basefonts = array_merge( $basefonts , $newfonts );
        return $basefonts;
      
    }
    
}

//add_filter('ot_recognized_font_families' , 'ut_recognized_font_families');


/*
|--------------------------------------------------------------------------
| Custom Search Form 
| due to WP echo on get_search_form Bug we need to make use a filter
|--------------------------------------------------------------------------
*/
if ( !function_exists( 'ut_searchform_filter' ) ) {

    function ut_searchform_filter( $form ) {

    $searchform = '<form role="search" method="get" class="search-form" id="searchform" action="' . esc_url( home_url( '/' ) ) . '">
        <label>
            <span>' .__( 'Search for:' , 'unitedthemes' ) . '</span>
            <input type="search" class="search-field" placeholder="' .esc_attr__( 'To search type and hit enter' , 'unitedthemes' ) . '" value="' . esc_attr( get_search_query() ) . '" name="s" title="' . __( 'Search for:' , 'unitedthemes' ) . '">
        </label>
        <input type="submit" class="search-submit" value="' . esc_attr__( 'Search' , 'unitedthemes' ) . '">
        </form>';
        
        return $searchform; 
    }
    
    add_filter( 'get_search_form', 'ut_searchform_filter' );

}

/*
|--------------------------------------------------------------------------
| helper function :  add editor styles
|--------------------------------------------------------------------------
*/
if ( !function_exists( 'ut_add_editor_styles' ) ) {

    function ut_add_editor_styles() {
        add_editor_style( 'ut-editor.css' );
    }
    add_action( 'init', 'ut_add_editor_styles' );
    
}


/*
|--------------------------------------------------------------------------
| helper function : return image ID by URL
|--------------------------------------------------------------------------
*/
if ( !function_exists( 'ut_get_image_id' ) ) {
    
    function ut_get_image_id($image_url) {
        
        global $wpdb;
        
        if( empty($image_url) ) {
            return;
        }
        
        $prefix = $wpdb->prefix;
        $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $prefix . "posts" . " WHERE guid='%s';", $image_url )); 
        
        return isset($attachment[0]) ? $attachment[0] : ''; 
            
            
    }

}

/*
|--------------------------------------------------------------------------
|  helper function : return true if current page is blog related
|--------------------------------------------------------------------------
*/
if ( !function_exists( 'ut_is_blog_related' ) ) {
    
    function ut_is_blog_related() {
    
        return ( is_home() || is_tag() || is_search() || is_archive() || is_category() ) ? true : false;
        
    }
    
}

/*
|--------------------------------------------------------------------------
| helper function : returns needed meta data of the current page
|--------------------------------------------------------------------------
*/

if( !function_exists('ut_return_meta') ) {

    function ut_return_meta( $key = '' ) {
        
        if( empty($key) ) {
            return;
        }
        
        global $post, $wp_query;
        
        // woo commerce shop ID
        if( function_exists('is_shop') ) {
            
            if( is_shop() ) {
                $pageID = get_option('woocommerce_shop_page_id');
            }
            
        }
        
        // blog page ID
        if( is_home() || ut_is_blog_related() ) {
            
            $pageID = get_option('page_for_posts');
        
        // all other pages
        } else {
            
            $pageID = ( isset($wp_query->post) ) ? $wp_query->post->ID : NULL;
            
        }
        
        if ( !empty($key) ) {
            
            return get_post_meta( $pageID , $key , true);
             
        } else {
            
            return get_post_meta( $pageID );
            
        }
        
    }
        
}

/*
|--------------------------------------------------------------------------
| helper function : fix wordpress w3c rel
|--------------------------------------------------------------------------
*/

if( !function_exists('ut_replace_cat_tag') ) {
    
    function ut_replace_cat_tag ( $text ) {
        $text = preg_replace('/rel="category tag"/', 'data-rel="category tag"', $text); return $text;
    }
    add_filter( 'the_category', 'ut_replace_cat_tag' );
    
}


/*
|--------------------------------------------------------------------------
| helper function : default menu output
|--------------------------------------------------------------------------
*/
if( !function_exists('ut_default_menu') ) {
    function ut_default_menu() {
        require_once ( THEME_DOCUMENT_ROOT . '/inc/ut-default-menu.php');
    }
}


/*
|--------------------------------------------------------------------------
| helper function : QTranslate Quicktags Support for Meta and Theme Options
|--------------------------------------------------------------------------
*/
if ( ! function_exists( 'ut_translate_meta' ) ) :
    
    function ut_translate_meta($content) {
        
        if( function_exists ( 'qtrans_useCurrentLanguageIfNotFoundShowAvailable' ) ) {
            return qtrans_useCurrentLanguageIfNotFoundShowAvailable($content);
        }
        
        if( function_exists ( 'ppqtrans_useCurrentLanguageIfNotFoundShowAvailable' ) ) {
            return ppqtrans_useCurrentLanguageIfNotFoundShowAvailable($content);
        }
        
        if( function_exists ( 'qtranxf_useCurrentLanguageIfNotFoundShowAvailable' ) ) {
            return qtranxf_useCurrentLanguageIfNotFoundShowAvailable($content);
        }
        
        return $content;
        
    }
    
endif;

/*
|--------------------------------------------------------------------------
| helper function : Create Google Font URL
|--------------------------------------------------------------------------
*/
if ( ! function_exists( 'ut_create_google_font_link' ) ) :
    
    function ut_create_google_font_link() {
        
        global $wpdb;
        
        /* needed vars */
        $google_url = '//fonts.googleapis.com/css?family=';
                
        /* available google fonts */
        $google_fonts = ut_recognized_google_fonts();
        
        /* catch for all google typography settings */
        $option_keys = array();
        
        /* already loaded fonts*/
        $already_loaded = array();
        
        /* custom array of all affected option tree options */
        $google_options = array(
            
            'ut_body_font_type'                         => 'ut_google_body_font_style',
            'ut_blockquote_font_type'                   => 'ut_google_blockquote_font_style',
            'ut_front_hero_font_type'                   => 'ut_google_front_page_hero_font_style',
            'ut_blog_hero_font_type'                    => 'ut_google_blog_hero_font_style',
            'ut_global_headline_font_type'              => 'ut_global_google_headline_font_style',
            'ut_global_lead_font_type'                  => 'ut_google_lead_font_style',
            'ut_global_h1_font_type'                    => 'ut_h1_google_font_style',
            'ut_global_h2_font_type'                    => 'ut_h2_google_font_style',
            'ut_global_h3_font_type'                    => 'ut_h3_google_font_style',
            'ut_global_h4_font_type'                    => 'ut_h4_google_font_style',
            'ut_global_h5_font_type'                    => 'ut_h5_google_font_style',
            'ut_global_h6_font_type'                    => 'ut_h6_google_font_style',
            'ut_csection_header_font_type'              => 'ut_csection_header_google_font_style',
            'ut_global_portfolio_title_font_type'       => 'ut_google_portfolio_title_font_style',
            'ut_global_portfolio_category_font_type'    => 'ut_google_portfolio_category_font_style',
            'ut_footer_widgets_headline_font_type'      => 'ut_footer_widgets_headline_google_font_style',
            'ut_global_blog_widgets_headline_font_type' => 'ut_global_blog_widgets_headline_google_font_style',
            'ut_global_navigation_font_type'            => 'ut_global_navigation_google_font_style'       
        
        );
        
        /* fill option keys */
        foreach( $google_options as $key => $google_option) {
            
            if( ot_get_option( $key , 'ut-font' ) == 'ut-google' ) {
                
                $option_keys[$key] = ot_get_option($google_option);
            
            }
            
        }  
                
        /* query meta values */
        /* $meta_keys = $wpdb->get_results( $wpdb->prepare("
            SELECT p.ID, pm.meta_value FROM {$wpdb->postmeta} pm
            LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
            WHERE pm.meta_key = '%s' 
            AND p.post_type = '%s'
        ", 'ut_section_header_font_type' , 'page')); */        
        
        /* create query string */        
        foreach( $option_keys as $key => $option ) {
            
            if( isset( $google_fonts[$option['font-id']] ) ) {
                
                /* reset */
                $query_args   = array();
                $query_string = '';
                
                /* replace whitespace with + */
                $family = preg_replace("/\s+/" , '+' , $google_fonts[$option['font-id']]['family'] );
                
                /* query args */
                $query_args['family'] = $family . ':' . ( !empty($option['font-weight']) ? $option['font-weight'] : '' ) . ( !empty($option['font-style']) ? '|' . $option['font-style'] : '' );
                
                if( !empty( $option['font-subset'] ) ) {
                    $query_args['subset'] = $option['font-subset'];
                }
                
                $query_string = add_query_arg( $query_args, $google_url );
                
                if( !in_array( $query_string, $already_loaded ) ) {
                
                    wp_enqueue_style( $key, $query_string );
                    $already_loaded[] = $query_string;
                    
                }
                    
            }
                    
        }
        
    }
    
endif;


/*
|--------------------------------------------------------------------------
| Helper Function: add lazy load for all content images
|--------------------------------------------------------------------------
*/

if( !function_exists('ut_add_image_placeholders') ) :

    function ut_add_image_placeholders( $content ) {
        
        if( is_feed() || is_preview() )
            return $content;
        
        /* Don't lazy-load if the content has already been run through previously */
        if ( false !== strpos( $content, 'data-original' ) ) {
            return $content;
        }
        
        $placeholder_image = NULL;
        
        // This is a pretty simple regex, but it works
        $content = preg_replace( '#<img([^>]+?)src=[\'"]?([^\'"\s>]+)[\'"]?([^>]*)>#', sprintf( '<img${1}src="%s" data-original="${2}"${3}><noscript><img${1}src="${2}"${3}></noscript>', $placeholder_image ), $content );
        $content = preg_replace('/(<img.*? class=".*?)(".*?>)/', '$1 utlazy$2', $content);
        
        return $content;
        
    }
    
    //add_filter( 'the_content', 'ut_add_image_placeholders', 99 );
        
endif;


/*
|--------------------------------------------------------------------------
| Helper Function: adds a px value to integers if necessary
|--------------------------------------------------------------------------
*/

if( !function_exists('ut_add_px_value') ) :

    function ut_add_px_value( $option ) {
        
        if (strpos($option,'px') !== false) {
            
            return $option;
        
        } else {
            
            return $option . 'px';
        
        }
        
    }
        
endif;

/*
|--------------------------------------------------------------------------
| Helper Function: create background video player
|--------------------------------------------------------------------------
*/

if( !function_exists('ut_dynamic_conditional') ) :

    function ut_dynamic_conditional($option = '') {
        
        if(empty($option)) {
            return false;
        }
        
        $dynamic_for = ot_get_option($option);
        $dynamic_match = false;
        
        if( !empty($dynamic_for) && is_array($dynamic_for) ) {
            
            foreach( $dynamic_for as $key => $conditional ) {
                
                if( $conditional() && $conditional != 'is_singular' ) {

                    $dynamic_match = true;
                    
                    /* front page gets handeled as a page too */
                    if( $conditional == 'is_page' && is_front_page() ) {
                        
                        $dynamic_match = false;
                    
                    } elseif( $conditional == 'is_single' && is_singular('portfolio') ) {
                       
                        $dynamic_match = false;
                            
                    } else {
                    
                        /* we have a match , so we can stop the loop */
                        break;
                    
                    }
                    
                }
                
                if( $conditional('portfolio') && $conditional == 'is_singular' ) {
                    
                    $dynamic_match = true;
                    break;
                
                }
            
            }
            
        }
        
        return $dynamic_match;
        
    }
    
endif;


if( !function_exists('ut_meta_description') ) :

    function ut_meta_description() { ?>
        
        <!-- Title -->
        <title><?php wp_title( '|', true, 'right' ); ?></title>
        <meta name="description" content="<?php bloginfo('description'); ?>">  
        
    <?php }

    add_action('ut_meta_theme_hook', 'ut_meta_description' );
    
endif;


if( !function_exists('ut_installation_note') ) :

    function ut_installation_note() { ?>
        
        <div class="grid-container section-content">
                            
            <div class="grid-100 mobile-grid-100 tablet-grid-100">
                    
            <div class="section-content">
                <div class="ut-install-note">
                
                <h2><?php _e( 'Setup Information' , 'unitedthemes' ); ?></h2>
                
                <p>
                <?php _e( 'Thank you for purchasing our theme. We hope you enjoy our product! If you have any questions that are beyond the scope of the help file, please feel free to contact us on our Support Forum at.' , 'unitedthemes' ); ?>
                <a href="http://support.unitedthemes.com/">http://support.unitedthemes.com</a>
                </p>
                
                <p>
                <?php _e( 'Information: There are no Pages are assigned to the menu yet or the assigned pages are not set to menutype "Section"! Please read the delivered documentation carefully. We recommend to start with the "Start from Scratch Setup" documentation part.' , 'unitedthemes' ); ?> <br />
                </p>
                
                <p><strong><?php _e( 'Useful links to start with:' , 'unitedthemes' ); ?></strong></p>
                
                <ul>
                    <li><a href="<?php echo home_url(); ?>/wp-admin/themes.php?page=install-required-plugins"><?php _e( 'Install required plugins', 'unitedthemes' ); ?></a></li>
                    <li><a href="<?php echo home_url(); ?>/wp-admin/customize.php"><?php _e( 'Customize Theme', 'unitedthemes' ); ?></a></li>
                    <li><a href="<?php echo home_url(); ?>/wp-admin/themes.php?page=ot-theme-options"><?php _e( 'Theme Options', 'unitedthemes' ); ?></a></li>
                    <li><a href="<?php echo home_url(); ?>/wp-admin/nav-menus.php"><?php _e( 'Set Up Your Menu', 'unitedthemes' ); ?></a></li>
                </ul>
                </div>
                
            </div>
            
        </div>
        
    <?php }
   
endif;


/*
|--------------------------------------------------------------------------
| Helper Function: returns sidebar id for current page
|--------------------------------------------------------------------------
*/
if( !function_exists('ut_get_sidebar_settings') ) {

	function ut_get_sidebar_settings() {
        
        /* create sidebar settings array */
        $sidebar_settings = array();
        
        /* assign primary sidebar */
        $sidebar_settings['primary_sidebar'] = ut_return_meta('ut_select_sidebar');        
        
        /* return sidebar config */
        return $sidebar_settings;
            
    }

}


/*
|--------------------------------------------------------------------------
| Helper Function: return true if a page related page is displayed
|--------------------------------------------------------------------------
*/
if ( !function_exists( 'ut_is_page_related' ) ) {
	
    function ut_is_page_related() {
	
		return ( is_404() || is_attachment() || is_search() ) ? true : false;
		
	}
    
}


/*
|--------------------------------------------------------------------------
| Helper Function: hatom microformat data
|--------------------------------------------------------------------------
*/
if ( !function_exists( 'add_brooklyn_hatom_data' ) ) {

    function add_brooklyn_hatom_data( $content ) {
    
        if (is_home() || is_singular() || is_archive() ) {
                        
            $content .= '<div class="brookly-hatom-data" style="display:none;visibility:hidden;">';
                $content .= '<span class="entry-title">' . get_the_title() . '</span>';
                $content .= '<span class="updated"> ' . get_the_modified_time('F jS, Y') . '</span>';
                $content .= '<span class="author vcard"><span class="fn">' . get_the_author() . '</span></span>';
            $content .= '</div>';
            
        }
     
        return $content;
        
     }
    
    add_filter('the_content', 'add_brooklyn_hatom_data');
    
}

/*
|--------------------------------------------------------------------------
| Helper Function: removes numerics from section ID's and replaces them 
| to avoid CSS styling issues
|--------------------------------------------------------------------------
*/
if ( !function_exists( 'ut_clean_section_id' ) ) {

    function ut_clean_section_id( $slug ) {
        
        /* check if slug contains any numbers */
        if ( !preg_match('/[0-9]/', $slug) ) {
            return $slug;        
        }
        
        $slug    = str_split($slug);
        $newslug = '';
        
        $dictionary  = array(
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine'
        );
        
        foreach($slug as $char) {
            
            if( ctype_digit($char) ) {
                
                $newslug.= $dictionary[$char];
                
            } else {
                
                $newslug.= $char;
                
            }
            
        }
        
        return $newslug;
        
            
    }

}

if( !function_exists( 'autoplay_vimeo_oembed' ) ) {

    function autoplay_vimeo_oembed( $provider, $url, $args ) {
        
        if (strpos($provider, 'vimeo')!==FALSE) {
            $provider = esc_url_raw( add_query_arg('autoplay', 0, $provider) );
        }
        return $provider;
        
    }
    add_filter('oembed_fetch_url', 'autoplay_vimeo_oembed', 10, 3);

}


/**
 * If the specified query is a search query, then modify the post_type array
 * to support a the 'portfolio' custom post type.
 *
 * @since    1.0.0
 *
 * @param    object    $query    The current search query.
 * @return   object    $query    The modified query supporting CPTs.
 */
 
if( !function_exists( 'ut_filter_search' ) ) {

    function ut_filter_search( $query ) {
        
        if ( ! $query->is_search ) {
            return $query;
        }
        
        
        $query->set( 'post_type', array( 'post', 'page', 'portfolio' ) );
        
        return $query;
        
    }
    
    add_filter( 'pre_get_posts', 'ut_filter_search' );

}

/**
 * Helper function to print arrays
 *
 * @param     array     Array to print 
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
 
if( !function_exists( 'ut_print' ) ) :
     
    function ut_print( $array ) {
                
        echo '<pre class="ut-print">';
            print_r( $array );
        echo '</pre>';
       
    }

endif;