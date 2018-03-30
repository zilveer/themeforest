<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Return an array with the css and scripts to include
 *
 * @package Yithemes
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 * @since 2.0.0
 * @return mixed array
 *
 */

/**
 * Include responsive css file after all stylesheets loaded
 */
function yit_global_object() {
    
    wp_localize_script( 'jquery', 'yit', array(
        'isRtl' => is_rtl(),
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'responsive_menu_text' => __( 'Navigate to...', 'yit' ),
		'added_to_cart' => __( 'added to cart', 'yit' ),
		'added_to_cart_ico' => __( 'added', 'yit' ),
		'price_filter_slider' => yit_get_option( 'shop-price-filter-style' ),
        'load_gif' => YIT_THEME_ASSETS_URL . '/images/search.gif'
    ));
    
}

add_action( 'wp_enqueue_scripts', 'yit_global_object', 100 );



function yit_dequeue_styles(){
    wp_dequeue_style( 'yit-faq' );
    wp_dequeue_script( 'yit-faq-frontend' );
}
add_action( 'wp_enqueue_scripts', 'yit_dequeue_styles', 100 );
add_action( 'wp_footer', 'yit_dequeue_styles', 2 );

/**
 * Include responsive css file after all stylesheets loaded
 */
function yit_responsive_and_custom_assets() {
    yit_get_option( 'general-activate-responsive' ) == 'yes' ? wp_enqueue_style( 'responsive' ) : wp_enqueue_style( 'non-responsive' );
    wp_enqueue_style( 'custom' );
}
add_action( 'wp_enqueue_scripts', 'yit_responsive_and_custom_assets', 100 );

return array(

    'style'  => array(
        'bootstrap-twitter' => array(
            'src'       => YIT_THEME_ASSETS_URL . '/bootstrap/css/bootstrap.min.css',
            'enqueue'   => true
        ),
        'font-awesome' => array(
            'src'       => YIT_CORE_ASSETS_URL . '/css/font-awesome.min.css',
            'enqueue'   => true
        ),
        'font-entypo' => array(
            'src'       => YIT_CORE_ASSETS_URL . '/css/font-entypo.css',
            'enqueue'   => true
        ),
        'theme-stylesheet' => array(
            'src'       => get_stylesheet_uri(),
            'enqueue'   => true
        ),
        'shortcodes' => array(
            'src'       => YIT_THEME_ASSETS_URL . '/css/shortcodes.css',
            'enqueue'   => true
        ),
        'widgets-theme' => array(
            'src'       => YIT_THEME_ASSETS_URL . '/css/widgets.css',
            'enqueue'   => true
        ),
        'comment-stylesheet' => array(
            'src'       => YIT_THEME_ASSETS_URL . '/css/comment.css',
            'enqueue'   => true
        ),
        'idangerous-swiper' => array(
            'src'       => YIT_THEME_ASSETS_URL . '/css/swiper.css',
            'enqueue'   => true
        ),
        'animate' => array(
            'src' => YIT_THEME_ASSETS_URL . '/css/animate.css',
            'enqueue'   => true,
			'use_in_mobile' => false
        ),
        'prettyPhoto' => array(
            'src' => YIT_THEME_ASSETS_URL . '/css/prettyPhoto.css',
            'enqueue'   => false
        ),
        'buddyPress' => ! ( function_exists( 'buddypress' ) ) ? false : array(
            'src' => YIT_THEME_ASSETS_URL . '/css/buddyPress.css',
            'enqueue'   => true
        ),
        'bbPress' => ! ( function_exists( 'bbpress' ) ) ? false : array(
            'src'       => YIT_THEME_ASSETS_URL . '/css/bbPress.css',
            'enqueue'   => true
        ),
        'owl-slider' => array(
            'src'       => YIT_THEME_ASSETS_URL . '/css/owl.css',
            'enqueue'   => true
        ),
		'responsive' => array(
			'src'       => YIT_THEME_ASSETS_URL . '/css/responsive.css',
		),
        'non-responsive' => array(
			'src'       => YIT_THEME_ASSETS_URL . '/css/non-responsive.css',
		),
        'custom' => array(
			'src'       => YIT_STYLESHEET_URL . '/'.yit_custom_style_filename(),
		),
    ),

    'script' => array(
        'bootstrap-twitter' => array(
            'src'       => YIT_THEME_ASSETS_URL . '/bootstrap/js/bootstrap.min.js',
            'enqueue'   => true,
            'deps'      => array('jquery'),
        ),
        'jquery-commonlibraries' => array(
            'src'       => YIT_THEME_ASSETS_URL . '/js/jquery.commonlibraries.js',
            'enqueue'   => true,
            'deps'      => array('jquery'),
        ),
		'classie' => array(
			'src'       => YIT_THEME_ASSETS_URL . '/js/classie.js',
			'enqueue'   => true,
			'deps'      => array( 'jquery' ),
		),
		'modernizr' => array(
			'src'       => YIT_THEME_ASSETS_URL . '/js/modernizr.custom.js',
			'enqueue'   => true,
			'deps'      => array( 'jquery' ),
		),
        'owl-carousel'  => array(
            'src'       => YIT_THEME_ASSETS_URL . '/js/owl.carousel.min.js',
            'enqueue'   => true,
            'deps'      => array('jquery'),
        ),
		'idangerous-swiper' => array(
			'src'       => YIT_THEME_ASSETS_URL . '/js/swiper.min.js',
			'enqueue'   => true,
			'deps'      => array('jquery'),
		),
        'yit_woocommerce' => !( function_exists( 'WC' ) ) ? false : array(
            'src'       => YIT_THEME_ASSETS_URL . '/js/woocommerce.js',
            'enqueue'   => true,
            'deps'      => array('jquery'),
        ),
        'yit_woocommerce_2_3' => ( !function_exists( 'WC' ) || version_compare( preg_replace( '/-beta-([0-9]+)/', '', WC()->version ), '2.3', '<' ) ) ? false : array(
            'src'       => YIT_THEME_ASSETS_URL . '/js/woocommerce_2.3.js',
            'enqueue'   => true,
            'deps'      => array('jquery'),
        ),
        'shortcodes' => array(
            'src'       => YIT_THEME_ASSETS_URL . '/js/shortcodes.js',
            'enqueue'   => true,
            'deps'      => array('jquery', 'idangerous-swiper'),
        ),
        'images-slider' => array(
            'src'       => YIT_THEME_ASSETS_URL . '/js/images.slider.js',
            'enqueue'   => true,
            'deps'      => array('idangerous-swiper'),
        ),
        'jquery-parallax' => array(
            'src'       => YIT_THEME_ASSETS_URL . '/js/jquery.parallax.js',
            'enqueue'   => true,
            'deps'      => array('jquery'),
        ),
        'page-slider' => array(
            'src'       => YIT_THEME_ASSETS_URL . '/js/page-slider.js',
            'enqueue'   => true,
            'deps'      => array('jquery'),
        ),
        'yit-shortcodes-twitter' => array(
            'src'       => YIT_THEME_ASSETS_URL . '/js/twitter.min.js',
            'enqueue'   => false,
            'deps'      => array('jquery'),
        ),
		'yit-shortcodes-twitter-text' => array(
			'src'       => YIT_THEME_ASSETS_URL . '/js/twitter-text.min.js',
			'enqueue'   => false,
			'deps'      => array( 'jquery', 'yit-shortcodes-twitter' ),
		),
        'prettyPhoto' => array(
            'src'       => YIT_THEME_ASSETS_URL . '/js/jquery.prettyPhoto.min.js',
            'enqueue'   => false,
            'deps'      => array( 'jquery' ),
        ),
        'jquery-placeholder' => array(
            'src'       => YIT_THEME_ASSETS_URL. '/js/jquery.placeholder.js',
            'enqueue'   => true,
            'deps'      => array( 'jquery' ),
        ),
		'yit-common' => array(
			'src'       => YIT_THEME_ASSETS_URL . '/js/common.js',
			'enqueue'   => true,
			'deps'      => array( 'jquery', 'jquery-masonry' ),
			'localize' => array(
				'responsive_menu_text' => __( 'Navigate to...', 'yit' ),
				'responsive_menu_close' => __( 'Close', 'yit' )
			)
		),
    ),

);