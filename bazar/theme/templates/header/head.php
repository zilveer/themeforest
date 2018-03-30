<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

$yit_core_assets_url = yit_remove_protocol_url(YIT_CORE_ASSETS_URL);
$yit_theme_template_direcory_uri = yit_remove_protocol_url(YIT_THEME_TEMPLATES_URL);
$get_template_directory_uri = yit_remove_protocol_url(get_template_directory_uri());
$get_stylesheet_directory = yit_remove_protocol_url(get_stylesheet_directory());

$stylesheet_url = yit_remove_protocol_url( yit_get_bloginfo( 'stylesheet_url' ) );

$ping_back_url =  yit_remove_protocol_url( yit_get_bloginfo( 'pingback_url' ) );

$rss2_url = yit_remove_protocol_url( yit_get_bloginfo( 'rss2_url' ) );
$comments_rss2_url = yit_remove_protocol_url( yit_get_bloginfo( 'comments_rss2_url' ) );

yit_meta_tags() ?>

<!-- PINGBACK & WP STANDARDS -->
<link rel="pingback" href="<?php echo $ping_back_url; ?>" />

<?php

global $is_IE;

wp_register_style( 'reset-bootstrap', yit_ssl_url( YIT_CORE_ASSETS_URL ) . '/css/reset-bootstrap.css' );
wp_register_style( 'main-style', get_bloginfo( 'stylesheet_url' ), array( 'reset-bootstrap' ) );
// enqueue style if is not child theme link: https://codex.wordpress.org/it:Temi_Child
if( ! is_child_theme() ) {
    wp_enqueue_style( 'reset-bootstrap' );
    wp_enqueue_style( 'main-style' );
}

yit_wp_enqueue_style( 10, 'yit-font-awesome', $yit_core_assets_url . '/css/font-awesome.css', false, '2.0', 'all' );
if( yit_ie_version() == 7 )
    { yit_wp_enqueue_style( 10, 'font-awesome-ie7', $yit_core_assets_url . '/css/font-awesome-ie7.css', false, '2.0', 'all' ); }

// colorbox - easing - flexslider - images loaded - tiptip
//wp_enqueue_script( 'jquery-colorbox', get_template_directory_uri() .'/theme/assets/js/jquery.colorbox-min.js', array('jquery'), '1.0', true);
//wp_enqueue_script( 'jquery-easing', get_template_directory_uri() .'/theme/assets/js/jquery.easing.js', array('jquery'), '1.3', true);
//wp_enqueue_script( 'jquery-flexslider', get_template_directory_uri() .'/theme/assets/js/jquery.flexslider-min.js', array('jquery'), '', true);
//wp_enqueue_script( 'jquery-imagesLoaded', get_template_directory_uri() .'/theme/assets/js/jquery.imagesLoaded.js' );
//wp_register_script( 'jquery-tipTip', get_template_directory_uri() .'/theme/assets/js/jquery.tipTip.minified.js', array('jquery'), '1.0', true);
//wp_enqueue_script( 'jquery-tipTip' );
wp_enqueue_script( 'jquery-colorbox-easing-flexslider-imagesloaded-tiptip', $get_template_directory_uri .'/theme/assets/js/jquery.commonlibraries.js', array('jquery'), '1.1', true);

//place holder
if( $is_IE ) {
    wp_enqueue_script( 'jquery-placeholder-plugin', $yit_core_assets_url . '/js/jquery.placeholder.js', array('jquery'), '1.0', true );
}

// masonry
wp_register_script( 'yit-jquery-masonry', $get_template_directory_uri .'/theme/assets/js/jquery.masonry.js', array('jquery'), '1.0', true);

// carouFredSel
wp_register_script( 'caroufredsel', $get_template_directory_uri .'/theme/assets/js/jquery.carouFredSel-6.1.0-packed.js' );

// jquery cookie
wp_register_script( 'jquery-cookie', $yit_core_assets_url . '/js/jq-cookie.js', array('jquery') );

wp_register_script( 'touch-swipe', $get_template_directory_uri .'/theme/assets/js/jquery.touchSwipe.min.js' );
wp_register_script( 'ba-throttle-debounce', $get_template_directory_uri .'/theme/assets/js/jquery.ba-throttle-debounce.min.js' );
wp_register_script( 'mousewheel', $get_template_directory_uri .'/theme/assets/js/jquery.mousewheel.min.js' );

// BlackAndWhite
wp_register_script( 'black-and-white', $get_template_directory_uri .'/theme/assets/js/jQuery.BlackAndWhite.js' );

// Resize
wp_register_script( 'resize', $get_template_directory_uri .'/theme/assets/js/jquery.resize.js', array('jquery'), '1.0', true);

// Selectbox
wp_register_script( 'jquery-selectbox', $get_template_directory_uri .'/theme/assets/js/jquery.selectbox.js', array('jquery'), '0.2', true);


//Custom Javascript
//wp_enqueue_script( 'yit-browser', YIT_CORE_ASSETS_URL . '/js/yit/yit_browser.js', array('jquery'), '1.0', true);
wp_enqueue_script( 'yit-layout', $get_template_directory_uri .'/theme/assets/js/yit/jquery.layout.js', array('jquery'), '1.0', true);

if( is_child_theme() && file_exists( $get_stylesheet_directory . '/js/jquery.custom.js' ) ) {
    wp_enqueue_script( 'jquery-custom', $get_stylesheet_directory . '/js/jquery.custom.js' , array( 'jquery' ), '1.0', true );
} else {
    wp_enqueue_script( 'jquery-custom', $get_template_directory_uri . '/js/jquery.custom.js' , array( 'jquery' ), '1.0', true );
}


$jquery_custom_l10n = array(
    'map_close' => __( '[x] Close', 'yit' ),
    'map_open' => __( '[x] Open', 'yit' )
);
wp_localize_script( 'jquery-custom', 'l10n_handler', $jquery_custom_l10n );

/* We add some JavaScript to pages with the comment form
 * to support sites with threaded comments (when in use).
 */
if ( is_singular() && get_option( 'thread_comments' ) )
    wp_enqueue_script( 'comment-reply' );

// Enqueue blog styles
do_action( 'yit_enqueue_blog_stuffs' );

yit_wp_enqueue_style( 10, 'colorbox', $get_template_directory_uri .'/theme/assets/css/colorbox.css' );
yit_wp_enqueue_style( 10, 'comments', $yit_theme_template_direcory_uri . '/comments/css/style.css' );
?>

<script type="text/javascript">
	var yit_responsive_menu_type = "<?php echo yit_get_option('responsive-menu'); ?>";
	var yit_responsive_menu_text = "<?php _e('NAVIGATE TO...','yit'); ?>";
</script>

<?php if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() )  ): ?>

    <!-- [favicon] begin -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php yit_favicon() ?>" />
    <link rel="icon" type="image/x-icon" href="<?php yit_favicon() ?>" />
    <!-- [favicon] end -->

    <!-- Touch icons more info: http://mathiasbynens.be/notes/touch-icons -->
    <?php yit_print_mobile_favicons() ;?>

<?php endif; ?>

<!-- Feed RSS2 URL -->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name') ?> Feed" href="<?php echo $rss2_url; ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name') ?> Comments Feed" href="<?php echo $comments_rss2_url; ?>" />