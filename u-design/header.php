<?php 
/**
 * @package WordPress
 * @subpackage U-Design
 */
if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $udesign_options, $style, $current_slider, $udesign_responsive;
// get the current color scheme subdirectory
$style = ( $udesign_options['color_scheme'] ) ? "style{$udesign_options['color_scheme']}": "style1";
$current_slider = $udesign_options['current_slider'];
$udesign_responsive = $udesign_options['enable_responsive'];
$udesign_responsive_body_class = ( $udesign_responsive ) ? 'u-design-responsive-on' : '';
$udesign_menu_auto_arrows = ( $udesign_options['show_menu_auto_arrows'] ) ? 'u-design-menu-auto-arrows-on' : '';
$udesign_menu_drop_shadows = ( $udesign_options['show_menu_drop_shadows'] ) ? 'u-design-menu-drop-shadows-on' : '';
$udesign_fixed_main_menu = ( $udesign_options['fixed_main_menu'] ) ? 'u-design-fixed-menu-on' : '';
$udesign_responsive_pinch_to_zoom = ( $udesign_options['responsive_pinch_to_zoom'] ) ? '' : ', maximum-scale=1.0';
set_theme_mod( 'udesign_include_container', !udesign_check_page_layout_option( 'no_container' ) ); // page specific layout options based on "U-Design Options" metabox selection

?>
<?php udesign_html_before(); ?>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<?php udesign_head_top(); ?>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php // add 'viewport' meta
if ( $udesign_responsive ) echo '<meta name="viewport" content="width=device-width, initial-scale=1.0'.$udesign_responsive_pinch_to_zoom.'" />'; ?>

<?php wp_head(); ?>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php // Load only if less than WordPress 4.2, if newer it's loaded in functions.php with 'wp_script_add_data' for the IE condisionals
global $wp_version;
if ( version_compare( $wp_version, '4.2.0', '<' ) ) : ?>
<!--[if lt IE 9]>
    <script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/scripts/respond.min.js"></script>
<![endif]-->
<?php endif; ?>

<?php echo $udesign_options['google_analytics']; ?>
<?php udesign_head_bottom(); ?>
</head>
<body  <?php udesign_inside_body_tag(); ?> <?php body_class( array ($udesign_responsive_body_class, $udesign_menu_auto_arrows, $udesign_menu_drop_shadows, $udesign_fixed_main_menu) ); ?>>
<?php udesign_body_top(); ?>
    
    <div id="wrapper-1">
<?php   udesign_top_wrapper_before(); ?>
<?php   $udesign_include_header = !udesign_check_page_layout_option( 'no_header' );
        if( $udesign_include_header ) : ?>
            <div id="top-wrapper">
<?php           udesign_top_wrapper_top(); ?>
                <div id="top-elements" class="container_24">
<?php               udesign_top_elements_inside( is_front_page() ); ?>
                </div>
                <!-- end top-elements -->
<?php           udesign_top_wrapper_bottom( is_front_page() ); ?>
            </div>
            <!-- end top-wrapper -->
<?php   endif; ?>
	<div class="clear"></div>
        
<?php   udesign_top_wrapper_after( is_front_page() ); ?>

<?php	if( is_front_page() ) : 
    
            udesign_front_page_slider_before();

	    if( $current_slider == '1' ) :
		include( trailingslashit( get_template_directory() ) . 'sliders/flashmo/grid_slider/grid_slider_display.php' );
	    elseif( $current_slider == '2' ) :
		include( trailingslashit( get_template_directory() ) . 'sliders/piecemaker/piecemaker_display.php' );
	    elseif( $current_slider == '3' ) :
		include( trailingslashit( get_template_directory() ) . 'sliders/piecemaker_2/piecemaker_display.php' );
	    elseif ( $current_slider == '4' ) :
		include( trailingslashit( get_template_directory() ) . 'sliders/cycle/cycle1/cycle1_display.php' );
	    elseif ( $current_slider == '5' ) :
		include( trailingslashit( get_template_directory() ) . 'sliders/cycle/cycle2/cycle2_display.php' );
	    elseif ( $current_slider == '6' ) :
		include( trailingslashit( get_template_directory() ) . 'sliders/cycle/cycle3/cycle3_display.php' );
	    elseif ( $current_slider == '8' ) : ?>
		<div id="rev-slider-header">
<?php               // Load Revolution slider
                    if ( class_exists('RevSliderFront') && $udesign_options['rev_slider_shortcode'] ) {
                        $rvslider = new RevSlider();
                        $arrSliders = $rvslider->getArrSliders();
                        if( !empty( $arrSliders ) ) {
                            echo do_shortcode( $udesign_options['rev_slider_shortcode'] );
                        }
                    } ?>
		</div>
		<!-- end rev-slider-header -->
<?php	    elseif ( $current_slider == '7' ) : // no slider ?>
		<div id="page-content-title">
		    <div id="page-content-header" class="container_24">
			<div id="page-title">
<?php                       if ( $udesign_options['no_slider_text'] ) echo '<h2>' . $udesign_options['no_slider_text'] . '</h2>'; ?>
			</div>
		    </div>
		    <!-- end page-content-header -->
		</div>
		<!-- end page-content-title -->
<?php	    endif; ?>
                
<?php       udesign_front_page_slider_after(); ?>

	    <div class="clear"></div>
<?php


            // home-page-before-content Widget Area
            $before_cont_1_is_active = sidebar_exist_and_active('home-page-before-content');
            if ( $before_cont_1_is_active  ) : // hide this area if no widgets are active...
?>
                <div id="before-content">
                    <div id="before-content-column" class="container_24">
                        <div class="home-page-divider"></div>
<?php
                        if ( $before_cont_1_is_active ) {
                            echo get_dynamic_column( 'before-cont-box-1', 'column_3_of_3 home-cont-box', 'home-page-before-content' );
                        } ?>
                        <div class="home-page-divider"></div>
                    </div>
                    <!-- end before-content-column -->
                </div>
                <!-- end before-content -->

		<div class="clear"></div>

<?php	    endif; ?>

<?php       udesign_home_page_content_before(); ?>
	    <div id="home-page-content">
<?php           udesign_home_page_content_top(); ?>

<?php	else : // NOT front page ?>

<?php       udesign_page_content_before(); ?>
	    <div id="page-content">
<?php           udesign_page_content_top(); // this hook is used to insert the breadcrumbs ?>

<?php	endif;




