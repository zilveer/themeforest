<?php
/**
 * TemplateMela
 * @copyright  Copyright (c) 2010 TemplateMela. (http://www.templatemela.com)
 * @license    http://www.templatemela.com/license/
 */
?>
<?php 
//  Creating Widget 
// Reference : http://codex.wordpress.org/Widgets_API

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override templatemela_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 
 * @uses register_sidebar
 */
function templatemela_register_sidebars() {
	register_sidebar( array(
		'name' => __( 'Header Area', 'templatemela' ),
		'id' => 'header-widget',
		'description' => __( 'The primary widget area on header', 'templatemela' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s tab_content">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="top-arrow"> </div> <h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Area', 'templatemela' ),
		'id' => 'footer-widget',
		'description' => __( 'The footer widget area', 'templatemela' ),
		'before_widget' => '<aside id="%1$s" class="footer-widget widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );		
	
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'templatemela' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'templatemela' ),
		'before_widget' => '<aside id="%1$s" class="%2$s widget">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'templatemela' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'templatemela' ),
		'before_widget' => '<aside id="%1$s" class="%2$s widget">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'templatemela' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'templatemela' ),
		'before_widget' => '<aside id="%1$s" class="%2$s widget">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'templatemela' ),
		'id' => 'forth-footer-widget-area',
		'description' => __( 'The forth footer widget area', 'templatemela' ),
		'before_widget' => '<aside id="%1$s" class="%2$s widget">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Menu Category Widget Area', 'templatemela' ),
		'id' => 'menu-category',
		'description' => __( 'The menu category widget area', 'templatemela' ),
		'before_widget' => '',
		'after_widget' => " ",
		'before_title' => ' ',
		'after_title' => ' ',
	) );
	
	register_sidebar( array(
		'name' => __( 'Header Search Widget Area', 'templatemela' ),
		'id' => 'header-search',
		'description' => __( 'The header search widget area', 'templatemela' ),
		'before_widget' => '',
		'after_widget' => " ",
		'before_title' => ' ',
		'after_title' => ' ',
	) );
	register_sidebar( array(
		'name' => __( 'Header CMS Widget Area', 'templatemela' ),
		'id' => 'header-cms',
		'description' => __( 'The header cms widget area', 'templatemela' ),
		'before_widget' => '',
		'after_widget' => " ",
		'before_title' => ' ',
		'after_title' => ' ',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Content Block Widget area' , 'templatemela' ),
		'id' => 'footer-block',
		'description' => __( 'The Footer Block widget area', 'templatemela' ),
		'before_widget' => '',
		'after_widget' => " ",
		'before_title' => ' ',
		'after_title' => ' ',
	) );
	register_sidebar( array(
		'name' => __( 'Brand Logo Widget Area', 'templatemela' ),
		'id' => 'brand-logo',
		'description' => __( 'The Brand Logo widget area', 'templatemela' ),
		'before_widget' => '',
		'after_widget' => " ",
		'before_title' => ' ',
		'after_title' => ' ',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Payment Block Widget Area', 'templatemela' ),
		'id' => 'footer-payment',
		'description' => __( 'Footer Payment Block widget area', 'templatemela' ),
		'before_widget' => '',
		'after_widget' => " ",
		'before_title' => ' ',
		'after_title' => ' ',
	) );
}
/**
 * Register sidebars by running templatemela_widgets_init() on the widgets_init hook. 
 */
add_action( 'widgets_init', 'templatemela_register_sidebars' );
include_once(TEMPLATEPATH . '/templatemela/widgets/tm-aboutus.php');
include_once(TEMPLATEPATH . '/templatemela/widgets/tm-advertise.php');
include_once(TEMPLATEPATH . '/templatemela/widgets/tm-flickr.php');
include_once(TEMPLATEPATH . '/templatemela/widgets/tm-follow-us.php');
include_once(TEMPLATEPATH . '/templatemela/widgets/tm-footer-contactus.php');
include_once(TEMPLATEPATH . '/templatemela/widgets/tm-header-contact.php');
include_once(TEMPLATEPATH . '/templatemela/widgets/tm-static-links.php');
include_once(TEMPLATEPATH . '/templatemela/widgets/tm-static-text.php');
include_once(TEMPLATEPATH . '/templatemela/widgets/tm-left-banner.php');
include_once(TEMPLATEPATH . '/templatemela/widgets/tm-cmsblock.php');
?>