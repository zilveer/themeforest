<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Set Content Width
// **********************************************************************//  
if (!isset( $content_width )) $content_width = 1170;

// **********************************************************************// 
// ! Include CSS and JS
// **********************************************************************// 
if(!function_exists('etheme_enqueue_scripts')) {
    function etheme_enqueue_scripts() {
       global $etheme_responsive;

        if ( !is_admin() ) {
            
            $script_depends = array();

            if(class_exists('WooCommerce')) {
                $script_depends = array('wc-add-to-cart-variation');
            }
            
            wp_enqueue_script('jquery');
            // HEAD wp_enqueue_script('modernizr', get_template_directory_uri().'/js/modernizr.js');
            wp_enqueue_script('head', get_template_directory_uri().'/js/head.min.js');
            // HEAD wp_enqueue_script('classie', get_template_directory_uri().'/js/classie.js');
            wp_enqueue_script('plugins', get_template_directory_uri().'/js/plugins.min.js',array(),false,true);
            // PLUGINS wp_enqueue_script('jquery-cookie', get_template_directory_uri().'/js/cookie.js',array(),false,true);
            wp_enqueue_script('hoverIntent', get_template_directory_uri().'/js/jquery.hoverIntent.js',array(),false,true);
            // HEAD wp_enqueue_script('owlcarousel', get_template_directory_uri().'/js/owl.carousel.min.js');
            // PLUGINS wp_enqueue_script('magnific-popup', get_template_directory_uri().'/js/jquery.magnific-popup.min.js',array(),false,true);
            // PLUGINS wp_enqueue_script('et_masonry', get_template_directory_uri().'/js/jquery.masonry.min.js',array(),false,true);
            // PLUGINS wp_enqueue_script('mediaelement-and-player', get_template_directory_uri().'/js/mediaelement-and-player.min.js',array(),false,true);
            // PLUGINS wp_enqueue_script('emodal', get_template_directory_uri().'/js/emodal.js',array(),false,true);
            // PLUGINS wp_enqueue_script('waypoint', get_template_directory_uri().'/js/waypoints.min.js',array(),false,true);
            // PLUGINS wp_enqueue_script('mousewheel', get_template_directory_uri().'/js/jquery.mousewheel.js',array(),false,true);
            if(class_exists('WooCommerce') && is_product())
                wp_enqueue_script('zoom', get_template_directory_uri().'/js/zoom.js',array(),false,true);
            // HEAD wp_enqueue_script('swiper', get_template_directory_uri().'/js/swiper.min.js');
            wp_enqueue_script('etheme', get_template_directory_uri().'/js/etheme.min.js',$script_depends,false,true);
            //wp_enqueue_script('etheme', get_template_directory_uri().'/js/theme.min.js',$script_depends,false,true);
            
            
            $etConf = array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'noresults' => __('No results were found!', ET_DOMAIN),
                'successfullyAdded' => __('successfully added to your shopping cart', ET_DOMAIN),
                'view_mode_default' => etheme_get_option('view_mode'),
                'catsAccordion' => etheme_get_option('cats_accordion'),
                'contBtn' => __('Continue shopping', ET_DOMAIN),
                'checkBtn' => __('Checkout', ET_DOMAIN),
                'warningAdded' => __('unfortunately this product was not added to cart', ET_DOMAIN),
                
            );
            
            if (class_exists('WooCommerce')) {
                global $woocommerce;
                $etConf['checkoutUrl'] = esc_url( WC()->cart->get_checkout_url() );
            } 

            wp_dequeue_script('prettyPhoto-init' );

            wp_localize_script( 'etheme', 'etConfig', $etConf);

        }
    }
}

add_action( 'wp_enqueue_scripts', 'etheme_enqueue_scripts', 130);


if (!function_exists('etheme_enqueue_ultimate_scripts')) {
    // Enqueue Ultimate Addons for VC scripts.

    function etheme_enqueue_ultimate_scripts() {
        wp_enqueue_script('ultimate-modernizr');
        wp_enqueue_script('jquery_ui');
        wp_enqueue_script('masonry');
        wp_enqueue_script('googleapis');
        wp_enqueue_script('ultimate-script');
        wp_enqueue_script('ultimate-modal-all');
        wp_enqueue_style('ultimate-style-min');
        wp_enqueue_style("ult-icons");  
    }
}


// **********************************************************************// 
// ! Screet chat fix
// **********************************************************************// 

define('SC_CHAT_LICENSE_KEY', '69e13e4c-3dfd-4a70-83c8-3753507f5ae8');
if(!function_exists('etheme_chat_init')) {
    function etheme_chat_init () {
        update_option('sc_chat_validate_license', 1);
    }  
}

add_action( 'after_setup_theme', 'etheme_chat_init');


// **********************************************************************// 
// ! Theme 3d plugins
// **********************************************************************// 
add_action( 'init', 'etheme_3d_plugins' );
if(!function_exists('etheme_3d_plugins')) {
    function etheme_3d_plugins() {
        if(function_exists( 'set_revslider_as_theme' )){
            set_revslider_as_theme();
        }
        if(function_exists( 'set_ess_grid_as_theme' )){
            set_ess_grid_as_theme();
        }
    } 
}

if(!function_exists('etheme_vcSetAsTheme')) {
    add_action( 'vc_before_init', 'etheme_vcSetAsTheme' );
    function etheme_vcSetAsTheme() {
        if(function_exists( 'vc_set_as_theme' )){
            vc_set_as_theme();
        }
    } 
}


if(!defined('YITH_REFER_ID')) {
    define('YITH_REFER_ID', '1028760');
}




// **********************************************************************// 
// ! Ititialize theme css configuration
// **********************************************************************// 
add_action('wp_head', 'etheme_init');
if(!function_exists('etheme_init')) {
    function etheme_init() {
        global $etheme_responsive, $post;
	    	
        ?>

            <style type="text/css">

                <?php if ( etheme_get_option('sale_icon') ) : ?>
                    .label-icon.sale-label { 
                        width: <?php echo (etheme_get_option('sale_icon_width')) ? etheme_get_option('sale_icon_width') : 67 ?>px; 
                        height: <?php echo (etheme_get_option('sale_icon_height')) ? etheme_get_option('sale_icon_height') : 67 ?>px;
                    }            
                    .label-icon.sale-label { background-image: url(<?php echo (etheme_get_option('sale_icon_url')) ? etheme_get_option('sale_icon_url') : get_template_directory_uri() .'/images/label-sale.png' ?>); }
                <?php endif; ?>
                
                <?php if ( etheme_get_option('new_icon') ) : ?>
                    .label-icon.new-label { 
                        width: <?php echo (etheme_get_option('new_icon_width')) ? etheme_get_option('new_icon_width') : 67 ?>px; 
                        height: <?php echo (etheme_get_option('new_icon_height')) ? etheme_get_option('new_icon_height') : 67 ?>px;
                    }            
                    .label-icon.new-label { background-image: url(<?php echo (etheme_get_option('new_icon_url')) ? etheme_get_option('new_icon_url') : get_template_directory_uri() .'/images/label-new.png' ?>); }
                    
                <?php endif; ?>

            </style>

            <style type="text/css">
                <?php 
                    $bread_bg = etheme_get_option('breadcrumb_bg'); 
                    $post_id = 0;
                    if( ! empty($post) ) {
                        $post_id = $post->ID;
                    }
                    if(is_singular('etheme_portfolio')) {
                        $post_id = etheme_tpl2id('portfolio.php');
                    }
                    if(( is_singular('page') || is_singular('etheme_portfolio') ) && has_post_thumbnail($post_id)) {
                        $bread_bg['background-image'] = wp_get_attachment_url( get_post_thumbnail_id($post_id), 'large'); 
                    }
                ?>
                .page-heading {
                
                    <?php if(!empty($bread_bg['background-color'])): ?>  background-color: <?php echo $bread_bg['background-color']; ?>;<?php endif; ?>
                    <?php if(!empty($bread_bg['background-image'])): ?>  background-image: url(<?php echo $bread_bg['background-image']; ?>) ; <?php endif; ?>
                    <?php if(!empty($bread_bg['background-attachment'])): ?>  background-attachment: <?php echo $bread_bg['background-attachment']; ?>;<?php endif; ?>
                    <?php if(!empty($bread_bg['background-size'])): ?>  background-size: <?php echo $bread_bg['background-size']; ?>;<?php endif; ?>
                    <?php if(!empty($bread_bg['background-repeat'])): ?>  background-repeat: <?php echo $bread_bg['background-repeat']; ?>;<?php  endif; ?>
                    <?php if(!empty($bread_bg['background-color'])): ?>  background-color: <?php echo $bread_bg['background-color']; ?>;<?php  endif; ?>
                    <?php if(!empty($bread_bg['background-position'])): ?>  background-position: <?php echo $bread_bg['background-position']; ?>;<?php endif; ?>
                }

                <?php 
                    $custom_css = etheme_get_option('custom_css');
                    $custom_css_desktop = etheme_get_option('custom_css_desktop');
                    $custom_css_tablet = etheme_get_option('custom_css_tablet');
                    $custom_css_wide_mobile = etheme_get_option('custom_css_wide_mobile');
                    $custom_css_mobile = etheme_get_option('custom_css_mobile');
                    if($custom_css != '') {
                        echo $custom_css;
                    }
                    if($custom_css_desktop != '') {
                        echo '@media (min-width: 992px) { ' . $custom_css_desktop . ' }'; 
                    }
                    if($custom_css_tablet != '') {
                        echo '@media (min-width: 768px) and (max-width: 991px) {' . $custom_css_tablet . ' }'; 
                    }
                    if($custom_css_wide_mobile != '') {
                        echo '@media (min-width: 481px) and (max-width: 767px) { ' . $custom_css_wide_mobile . ' }'; 
                    }
                    if($custom_css_mobile != '') {
                        echo '@media (max-width: 480px) { ' . $custom_css_mobile . ' }'; 
                    }
                 ?>

                 <?php 
                    $background_img = etheme_get_option('background_img');
                  ?>

                 .bordered .body-border-left, 
                 .bordered .body-border-top, 
                 .bordered .body-border-right, 
                 .bordered .body-border-bottom {
                    <?php if(!empty($background_img['background-color'])): ?>  background-color: <?php echo $background_img['background-color']; ?>;<?php endif; ?>
                 }
            </style>
        <?php
    }
}


if(!function_exists('et_load_textdomain')) {

	add_action('after_setup_theme', 'et_load_textdomain');
	
	function et_load_textdomain(){
		/**
		* Load theme translations
		*/  
		load_theme_textdomain( ET_DOMAIN, get_template_directory() . '/languages' );
	
		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );
	}
}
