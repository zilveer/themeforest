<?php
require_once ('admin/index.php');

add_filter('widget_text', 'do_shortcode');
/*
 * Css
 */
add_action( 'wp_enqueue_scripts', 			'cshero_google_font' );
add_action( 'wp_enqueue_scripts', 			'cshero_css' );
/*
 * Js
 */
add_action( 'wp_enqueue_scripts', 			'cshero_js' );
/*
 * Header
 */
add_action( 'wp_head', 						'cshero_favicon' );
/*
 * VC Template
 */
if(function_exists("vc_set_shortcodes_templates_dir")){
	vc_set_shortcodes_templates_dir(get_stylesheet_directory()."/vc_templates/");
}
/*
* TGM
*/
require_once(ADMIN_PATH . 'tgm-plugin-activation/class-tgm-plugin-activation.php');
require_once(ADMIN_PATH . 'tgm-plugin-activation/plugin-options.php');
/*
 * Favicon
 */
function cshero_favicon(){
	global $smof_data;
	$icon = get_stylesheet_directory_uri()."/favicon.ico";
	if($smof_data["favicon"]){
		$icon = $smof_data["favicon"];
	}
	echo '<link type="image/x-icon" href="'.esc_url($icon).'" rel="shortcut icon">';
}
/*
 * Google Font
 */
function cshero_google_font(){
	global $smof_data;
	if ($smof_data['body_font_options'] == 'Google Font' && $smof_data['google_body_font_family'] && $smof_data['body_font_family_selector']){
		wp_enqueue_style('google-body-font-family', 'http://fonts.googleapis.com/css?family='.urlencode($smof_data["google_body_font_family"]).':400,400italic,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese');
	}
	if ($smof_data['header_font_options'] == 'Google Font' && $smof_data['google_header_font_family'] && $smof_data['header_font_family_selector']){
		wp_enqueue_style('google-header-font-family', 'http://fonts.googleapis.com/css?family='.urlencode($smof_data["google_header_font_family"]).':400,400italic,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese');
	}
	for ($i = 0 ; $i <= 10 ; $i++){
		if ($smof_data["other_font_options_$i"] == 'Google Font' && $smof_data["google_other_font_family_$i"] && $smof_data["other_font_family_selector_$i"]){
			wp_enqueue_style("google-other-font-family_$i", 'http://fonts.googleapis.com/css?family='.urlencode($smof_data["google_other_font_family_$i"]).':400,400italic,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese');
		}
	}
}
/*
 * Cshero CSS
*/

function getCSSite(){
	$blog = explode('/', home_url());
	$name=$blog[count($blog)-1];
	if(get_option('cs-body-class','-1')!='-1'){
		$name=get_option('cs-body-class');
	}
	$site_prefix = str_replace('wp-consilium', '', $name);
	if($site_prefix!=''){
		if(!file_exists(get_template_directory() . "/css/style".$site_prefix.".css")){
			$site_prefix = '';
		}
	}
	update_option('cs-body-class',$site_prefix);
	return $site_prefix;
}
/** Generate Header Css */
add_action('wp_head', 'cshero_header_css_callback');

function cshero_header_css_callback(){
    global $smof_data;
    ob_start();
    require_once 'framework/includes/header-extend.php';
    echo '<style>'.cshero_compressCss(ob_get_clean()).'</style>';
}

function cshero_css(){
	global $smof_data;

	/* register */
	wp_register_style('bootstrap', get_template_directory_uri().'/css/bootstrap.min.css',array(), '3.2.0');
	wp_register_style('colorbox', get_template_directory_uri().'/css/colorbox.css', array(), '1.5.10');
	wp_register_style('font-awesome', get_template_directory_uri().'/css/font-awesome.min.css', array(), '4.1.0');
	wp_register_style('font-ionicons', get_template_directory_uri().'/css/ionicons.min.css', array(), '1.5.2');

	/** Dynamic */
	wp_enqueue_style( 'bootstrap' );
	wp_enqueue_style( 'font-awesome' );
	wp_enqueue_style( 'font-ionicons' );
	
	if(class_exists('WooCommerce')){
	    wp_enqueue_style( 'wp_nuvo', get_template_directory_uri() . "/css/woocommerce.css", array(), '1.0.0');
	}
	wp_enqueue_style( 'animate-elements', get_template_directory_uri() . "/css/cs-animate-elements.css", array(), '1.0.0');
	/*end prefix*/
	wp_enqueue_style( 'style', get_template_directory_uri() . "/style.css", array(), '1.0.0');
}
/*
 * Cshero JS
 */
function cshero_js(){
	global $smof_data;

	$site_prefix=getCSSite();
	/* register */
	wp_register_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.min.js',array(), '3.2.0');
	wp_register_script( 'jquery-easing', get_template_directory_uri().'/js/jquery.easing.min.js',array(), '1.3.1');
	wp_register_script( 'jquery-colorbox', get_template_directory_uri() . '/js/jquery.colorbox.min.js', array(), '1.5.10');
	wp_register_script( 'masonry-pkgd', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array(), '3.1.5');
	if($smof_data['smooth_scroll'] == '1'){
        wp_register_script( 'smoothscroll', get_template_directory_uri().'/js/cs-smoothscroll.min.js');
        wp_enqueue_script( 'smoothscroll' );
    }
	/* load base script */
	wp_enqueue_script("jquery");
	wp_enqueue_script("bootstrap");

	wp_deregister_script( 'jquery-cookie' );
	wp_enqueue_script( 'parallax', get_template_directory_uri().'/js/cs_parallax.js');
	wp_enqueue_script( 'jquery-cookie', get_template_directory_uri().'/js/jquery_cookie.min.js');

    wp_enqueue_script( 'main', get_template_directory_uri().'/js/main.js',array(), '1.0.0');

	if(isset($smof_data['enable_one_page']) && $smof_data['enable_one_page'] == '1'){
		wp_enqueue_script( 'jquery-easing' );
		wp_enqueue_script( 'jquery-nav', get_template_directory_uri().'/js/jquery.nav.js',array(), '3.0.0');
		wp_register_script( 'custom-nav', get_template_directory_uri().'/js/custom-nav.js',array(), '1.0.0');
		wp_localize_script( 'custom-nav', 'one_page', array('scrollSpeed'=>$smof_data['page_scroll_speed'], 'scrollOffset'=>$smof_data['page_scroll_offset'], 'easing'=>$smof_data['page_scroll_easing']) );
		wp_enqueue_script( 'custom-nav' );
	}
    $show_sticky_header = $smof_data['header_sticky'];
    if(is_page() && get_post_meta(get_the_ID(), 'cs_show_sticky_header', true) == 'show'){
        $show_sticky_header = '1';
    }
	if($show_sticky_header == '1'){
		wp_enqueue_script( 'sticky', get_template_directory_uri().'/js/sticky.js',array(), '1.0.0');
	}
    if( $smof_data['page_loader'] == '1'){
        wp_enqueue_script( 'pageloading', get_template_directory_uri().'/js/pageloading.js');
    }
}

/**
 * minimize CSS styles
 *
 * @since 1.1.0
 */
function cshero_compressCss($buffer){

    /* remove comments */
    $buffer = preg_replace("!/\*[^*]*\*+([^/][^*]*\*+)*/!", "", $buffer);
    /* remove tabs, spaces, newlines, etc. */
    $buffer = str_replace("	", " ", $buffer); //replace tab with space
    $arr = array("\r\n", "\r", "\n", "\t", "  ", "    ", "    ");
    $rep = array("", "", "", "", " ", " ", " ");
    $buffer = str_replace($arr, $rep, $buffer);
    /* remove whitespaces around {}:, */
    $buffer = preg_replace("/\s*([\{\}:,])\s*/", "$1", $buffer);
    /* remove last ; */
    $buffer = str_replace(';}', "}", $buffer);

    return $buffer;
}
/*
* Detect mobile
*/
function isMobile(){
	if(preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|playbook|sagem|sharp|sie-|silk|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT']))
		{return true;}
	else
		{return false;}
}

if ( is_singular() ){ wp_enqueue_script( "comment-reply" );}
#-----------------------------------------------------------------#
# Content Width
# T_add
#-----------------------------------------------------------------#
if (!isset( $content_width )) $content_width = '669px';
#-----------------------------------------------------------------#
# Load Header
# T_add
#-----------------------------------------------------------------#
function cshero_header(){
	global $smof_data,$header_setings,$post;

	$pageHeader = '';
	if(!empty($post)){
	    $pageHeader = get_post_meta($post->ID, 'cs_page_header', true);
	}
	if(empty($pageHeader) || $pageHeader=='0'){
		if($smof_data["header_layout"]!='custom'){
			get_template_part('framework/headers/header',$smof_data["header_layout"]);
		} else{
			?>
			<header id="cshero-header" class="cs-header-custom<?php if($header_setings->header_fixed == '1'){ echo ' transparentFixed';} ?>">
			<?php
			echo do_shortcode(get_post(str_replace('cs-header-', '', $smof_data["cs-header-id"]))->post_content);
			get_template_part('framework/headers/sticky-header');
			?>
			</header>
			<?php
		}
	}
	else{
		if(strstr($pageHeader,'cs-header-')){
			?>
			<header id="cshero-header" class="cs-header-custom<?php if($header_setings->header_fixed == '1'){ echo ' transparentFixed';} ?>">
			<?php
			echo do_shortcode(get_post(str_replace('cs-header-', '', $pageHeader))->post_content);
			get_template_part('framework/headers/sticky-header');
			?>
			</header>
			<?php
		}
		else{
			get_template_part('framework/headers/header',$pageHeader);
		}
	}

}
#-----------------------------------------------------------------#
# Load footer
# T_add
#-----------------------------------------------------------------#
function cshero_footer(){
	global $smof_data;
	switch ($smof_data["footer_layout"]){
		case 'f1':
			get_template_part('framework/footer/footer-v1');
			break;
		case 'f2':
			get_template_part('framework/footer/footer-v2');
			break;
		case 'f3':
			get_template_part('framework/footer/footer-v3');
			break;
		case 'f4':
			get_template_part('framework/footer/footer-v4');
			break;
		case 'f5':
			get_template_part('framework/footer/footer-v5');
		break;
	}
}

/**
 * CMS Theme setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * CMS Theme supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since 1.0.0
 */

add_action( 'after_setup_theme', 'wp_nuvo_setup' );

function wp_nuvo_setup() {
	
	load_theme_textdomain( 'wp_nuvo', get_template_directory().'/languages');
	// Register Navigation
	register_nav_menu('main_navigation', esc_html__('Main Navigation','wp_nuvo'));
	register_nav_menu('top_navigation', esc_html__('Top Navigation','wp_nuvo'));
	register_nav_menu('left_navigation', esc_html__('Left Navigation','wp_nuvo'));
	register_nav_menu('right_navigation', esc_html__('Right Navigation','wp_nuvo'));
	register_nav_menu('404_pages', esc_html__('404 Useful Pages','wp_nuvo'));
	register_nav_menu('sticky_navigation', esc_html__('Sticky Header Navigation','wp_nuvo'));
	
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-header');
	add_theme_support( 'custom-background');
	add_theme_support( 'wp_nuvo');
	// Default RSS feed links
	add_theme_support('automatic-feed-links');
	// Post Formats
	add_theme_support('post-formats', array('gallery', 'link', 'image', 'quote', 'video', 'audio', 'chat'));
	#-----------------------------------------------------------------#
	# Add post thumbnail functionality
	# T_add
	#-----------------------------------------------------------------#
	add_theme_support('post-thumbnails');
	add_image_size('related-img', 180, 138, true);
	add_image_size('portfolio-one', 540, 272, true);
	add_image_size('portfolio-two', 460, 295, true);
	add_image_size('portfolio-three', 300, 214, true);
	add_image_size('portfolio-four', 220, 161, true);
	add_image_size('portfolio-full', 940, 400, true);
	add_image_size('recent-posts', 700, 441, true);
	add_image_size('recent-works-thumbnail', 66, 66, true);
}

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since Fox
 */

add_action( 'widgets_init', 'wp_nuvo_widgets_init' );

function wp_nuvo_widgets_init() {
	
	register_sidebar(array(
		'name' => 'Blog Sidebar',
		'id' => 'cshero-blog-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="heading"><h3 class="wg-title"><span>',
		'after_title' => '</span></h3></div>',
	));
	register_sidebar(array(
		'name' => 'Menu Sidebar',
		'id' => 'cshero-menu-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="heading"><h3 class="wg-title"><span>',
		'after_title' => '</span></h3></div>',
	));
	register_sidebar(array(
		'name' => 'Sidebar Left',
		'id' => 'cshero-widget-left',
		'before_widget' => '<div id="%1$s" class="header-top-widget-col %2$s">',
		'after_widget' => '<div style="clear:both;"></div></div>',
		'before_title' => '<h3 class="wg-title"><span>',
		'after_title' => '</span></h3>',
	));
	register_sidebar(array(
		'name' => 'Sidebar Right',
		'id' => 'cshero-widget-right',
		'before_widget' => '<div id="%1$s" class="header-top-widget-col %2$s">',
		'after_widget' => '<div style="clear:both;"></div></div>',
		'before_title' => '<h3 class="wg-title"><span>',
		'after_title' => '</span></h3>',
	));
	register_sidebar(array(
		'name' => 'Sidebar Hidden Menu',
		'id' => 'cshero-widget-hidden-menu',
		'before_widget' => '<div id="%1$s" class="hidden-menu-widget-col %2$s">',
		'after_widget' => '<div style="clear:both;"></div></div>',
		'before_title' => '<h3 class="wg-title"><span>',
		'after_title' => '</span></h3>',
	));
    register_sidebar(array(
        'name' => 'Header Top Widget 1',
        'id' => 'cshero-header-top-widget-1',
        'before_widget' => '<div id="%1$s" class="header-top-widget-col %2$s">',
        'after_widget' => '<div style="clear:both;"></div></div>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Header Top Widget 2',
        'id' => 'cshero-header-top-widget-2',
        'before_widget' => '<div id="%1$s" class="header-top-widget-col %2$s">',
        'after_widget' => '<div style="clear:both;"></div></div>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Header Top Widget 3',
        'id' => 'cshero-header-top-widget-3',
        'before_widget' => '<div id="%1$s" class="header-top-widget-col %2$s">',
        'after_widget' => '<div style="clear:both;"></div></div>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Header Content Widget 1',
        'id' => 'cshero-header-content-widget-1',
        'before_widget' => '<div id="%1$s" class="header-top-widget-col %2$s">',
        'after_widget' => '<div style="clear:both;"></div></div>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Header Content Widget 2',
        'id' => 'cshero-header-content-widget-2',
        'before_widget' => '<div id="%1$s" class="header-top-widget-col %2$s">',
        'after_widget' => '<div style="clear:both;"></div></div>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Bottom Widget 1',
        'id' => 'cshero-bottom-widget-1',
        'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
        'after_widget' => '<div style="clear:both;"></div></div>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Bottom Widget 2',
        'id' => 'cshero-bottom-widget-2',
        'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
        'after_widget' => '<div style="clear:both;"></div></div>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Bottom Widget 3',
        'id' => 'cshero-bottom-widget-3',
        'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
        'after_widget' => '<div style="clear:both;"></div></div>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
        'name' => 'Bottom Widget 4',
        'id' => 'cshero-bottom-widget-4',
        'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
        'after_widget' => '<div style="clear:both;"></div></div>',
        'before_title' => '<h3 class="wg-title"><span>',
        'after_title' => '</span></h3>',
    ));
	register_sidebar(array(
    	'name' => 'Footer Widget 1',
    	'id' => 'cshero-footer-widget-1',
    	'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
    	'after_widget' => '<div style="clear:both;"></div></div>',
    	'before_title' => '<h3 class="wg-title"><span>',
    	'after_title' => '</span></h3>',
	));
	register_sidebar(array(
    	'name' => 'Footer Widget 2',
    	'id' => 'cshero-footer-widget-2',
    	'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
    	'after_widget' => '<div style="clear:both;"></div></div>',
    	'before_title' => '<h3 class="wg-title"><span>',
    	'after_title' => '</span></h3>',
	));
	register_sidebar(array(
    	'name' => 'Footer Widget 3',
    	'id' => 'cshero-footer-widget-3',
    	'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
    	'after_widget' => '<div style="clear:both;"></div></div>',
    	'before_title' => '<h3 class="wg-title"><span>',
    	'after_title' => '</span></h3>',
	));
	register_sidebar(array(
    	'name' => 'Footer Widget 4',
    	'id' => 'cshero-footer-widget-4',
    	'before_widget' => '<div id="%1$s" class="footer-widget-col %2$s">',
    	'after_widget' => '<div style="clear:both;"></div></div>',
    	'before_title' => '<h3 class="wg-title"><span>',
    	'after_title' => '</span></h3>',
	));
	register_sidebar(array(
    	'name' => 'Footer Bottom Widget 1',
    	'id' => 'cshero-slidingbar-bottom-widget-1',
    	'before_widget' => '<div id="%1$s" class="slidingbar-widget-col %2$s">',
    	'after_widget' => '<div style="clear:both;"></div></div>',
    	'before_title' => '<h3 class="wg-title"><span>',
    	'after_title' => '</span></h3>',
	));
	register_sidebar(array(
    	'name' => 'Footer Bottom Widget 2',
    	'id' => 'cshero-slidingbar-bottom-widget-2',
    	'before_widget' => '<div id="%1$s" class="slidingbar-widget-col %2$s">',
    	'after_widget' => '<div style="clear:both;"></div></div>',
    	'before_title' => '<h3 class="wg-title"><span>',
    	'after_title' => '</span></h3>',
	));
    register_sidebar(array(
        'name' => 'Newsletter',
        'id' => 'cshero-slidingbar-newsletter',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
    ));
    register_sidebar(array(
        'name' => 'Woocommerce Sidebar',
        'id' => 'woocommerce_sidebar',
        'before_widget' => '<div id="%1$s" class="slidingbar-widget-col %2$s">',
    	'after_widget' => '<div style="clear:both;"></div></div>',
    	'before_title' => '<h3 class="wg-title"><span>',
    	'after_title' => '</span></h3>',
    ));
    register_sidebar(array(
    	'name' => 'Debug',
    	'id' => 'cshero-debug-widget',
    	'before_widget' => '<div id="%1$s" class="debug-widget-col %2$s">',
    	'after_widget' => '<div style="clear:both;"></div></div>',
    	'before_title' => '<h3 class="wg-title"><span>',
    	'after_title' => '</span></h3>',
	));
    register_sidebar(array(
    	'name' => 'Custom Button Action',
    	'id' => 'cshero-custom-button-widget',
    	'before_widget' => '<div id="%1$s" class="custom-button-widget-col %2$s">',
    	'after_widget' => '<div style="clear:both;"></div></div>',
    	'before_title' => '<h3 class="wg-title"><span>',
    	'after_title' => '</span></h3>',
	));
}



#-----------------------------------------------------------------#
# register widget footer bottom
#-----------------------------------------------------------------#
function cshero_sidebar_header_top(){
	global $smof_data;
	if($smof_data['header_top_widgets']){
		for ($i = 1 ; $i <= (int)$smof_data['header_top_widgets_columns']; $i++){
			echo "<div class='header-top-".$i." ".esc_attr($smof_data['header_top_widgets_'.$i.''])."'>";
			if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Header Top Widget $i")):
			endif;
			echo "</div>";
		}
	}
}
#-----------------------------------------------------------------#
# register widget footer top
#-----------------------------------------------------------------#
function cshero_sidebar_footer_top(){
	global $smof_data;
	if($smof_data['footer_top_widgets']){
		for ($i = 1 ; $i <= (int)$smof_data['footer_top_widgets_columns']; $i++){
			echo "<div class='footer-top-".$i." ".esc_attr($smof_data['footer_top_widgets_'.$i.''])."'>";
			dynamic_sidebar("cshero-footer-widget-$i");
			echo "</div>";
		}
	}
}
#-----------------------------------------------------------------#
# register widget footer bottom
# T_add
#-----------------------------------------------------------------#
function cshero_sidebar_footer_bottom(){
	global $smof_data;
	if($smof_data['footer_bottom_widgets']){
	 for ($i = 1 ; $i <= (int)$smof_data['footer_bottom_widgets_columns']; $i++){
	 	echo "<div class='footer-bottom-".$i." ".esc_attr($smof_data['footer_bottom_widgets_'.$i.''])."'>";
	 	dynamic_sidebar("cshero-slidingbar-bottom-widget-$i");
	 	echo "</div>";
		}
	}
}
/*
 * Breadcrumb
*/
function cshero_breadcrumb() {
	global $smof_data;
	/* === OPTIONS === */
	$text['home'] = $smof_data['breacrumb_home_prefix']; // text for the 'Home' link
	$text['category'] = 'Archive by Category "%s"'; // text for a category page
	$text['search'] = 'Search Results for "%s" Query'; // text for a search results page
	$text['tag'] = 'Posts Tagged "%s"'; // text for a tag page
	$text['author'] = 'Articles Posted by %s'; // text for an author page
	$text['404'] = 'Error 404'; // text for the 404 page
	$show_current = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
	$show_on_home = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
	$show_title = 1; // 1 - show the title for the links, 0 - don't show
	$delimiter = ' / '; // delimiter between crumbs
	$before = '<span class="current">'; // tag before the current crumb
	$after = '</span>'; // tag after the current crumb
	/* === END OF OPTIONS === */
	global $post;
	$home_link = home_url('/');
	$link_attr = ' rel="v:url" property="v:title"';
	$link = '<a href="%1$s">%2$s</a>';
	$parent_id = $parent_id_2 = isset($post->post_parent)?($post->post_parent?$post->post_parent:null):null;
	$frontpage_id = get_option('page_on_front');
	if (is_home() || is_front_page()) {
		if ($show_on_home == 1)
			echo '<a href="' . $home_link . '">' . $text['home'] . '</a>';
	} else {
		if ($show_home_link == 1) {
			echo '<a href="' . $home_link . '">' . $text['home'] . '</a>';
			if ($frontpage_id == 0 || $parent_id != $frontpage_id)
				echo $delimiter;
		}
		if (is_category()) {
			$this_cat = get_category(get_query_var('cat'), false);
			if ($this_cat->parent != 0) {
				$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
				if ($show_current == 0)
					$cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0)
					$cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
			}
			if ($show_current == 1)
				echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;
		} elseif (is_search()) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;
		} elseif (is_day()) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F')) . $delimiter;
			echo $before . get_the_time('d') . $after;
		} elseif (is_month()) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo $before . get_the_time('F') . $after;
		} elseif (is_year()) {
			echo $before . get_the_time('Y') . $after;
		} elseif (is_single() && !is_attachment()) {
			if (get_post_type() != 'post') {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($show_current == 1)
					echo $delimiter . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category();
				$cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($show_current == 0)
					$cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>', $cats);
				if ($show_title == 0)
					$cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
				if ($show_current == 1)
					echo $before . get_the_title() . $after;
			}
		} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;
		} elseif (is_attachment()) {
			$parent = get_post($parent_id);
			$cat = get_the_category($parent->ID);
			if(!empty($cat)){
    			$cat = $cat[0];
    			$cats = get_category_parents($cat, TRUE, $delimiter);
    			//$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
    			//$cats = str_replace('</a>', '</a>' . $link_after, $cats);
    			if ($show_title == 0)
    				$cats = preg_replace('/ title="(.*?)"/', '', $cats);
    			echo $cats;
			}
			printf($link, get_permalink($parent), $parent->post_title);
			if ($show_current == 1)
				echo $delimiter . $before . get_the_title() . $after;
		} elseif (is_page() && !$parent_id) {
			if ($show_current == 1)
				echo $before . get_the_title() . $after;
		} elseif (is_page() && $parent_id) {
			if ($parent_id != $frontpage_id) {
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					if ($parent_id != $frontpage_id) {
						$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					}
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $breadcrumbs[$i];
					if ($i != count($breadcrumbs) - 1)
						echo $delimiter;
				}
			}
			if ($show_current == 1) {
				if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id))
					echo $delimiter;
				echo $before . get_the_title() . $after;
			}
		} elseif (is_tag()) {
			echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
		} elseif (is_author()) {
			global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;
		} elseif (is_404()) {
			echo $before . $text['404'] . $after;
		}
		if (get_query_var('paged')) {
			if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
				echo ' ';
			echo esc_html__(' / Page', 'wp_nuvo') . ' ' . get_query_var('paged');
			if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
				echo '';
		}
	}
}
if(!function_exists('cshero_generetor_blog_layout')){
	function cshero_generetor_blog_layout() {
		global $smof_data,$cat;
		$layout = new stdClass();
		$layout->blog = 'col-md-12';
		$layout->left_col = null;
		$layout->right_col = null;
		$cat_data = get_option("category_".$cat);
		$category_layout = $smof_data['blog_layout'];

		if(is_category() && !empty($cat_data)){
			if($cat_data['category_layout'] && $cat_data['category_layout'] != ''){
				$category_layout = $cat_data['category_layout'];
			}
		}
		$main = 'col-xs-12 col-sm-8 col-md-8 col-lg-8';
		$sidebar_col = 'col-xs-12 col-sm-4 col-md-4 col-lg-4';
		if($category_layout){
			if ( is_active_sidebar( 'cshero-blog-sidebar' ) && $category_layout == 'left-fixed' ){
				$layout->blog = $main;
				$layout->left_col = $sidebar_col;
				$layout->right_col = null;
			} elseif (is_active_sidebar( 'cshero-blog-sidebar' ) && $category_layout == 'right-fixed'){
				$layout->blog = $main;
				$layout->left_col = null;
				$layout->right_col = $sidebar_col;
			} else {
				$layout->blog = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
				$layout->left_col = null;
				$layout->right_col = null;
			}
		}
		return $layout;
	}
}
/*
 * Layout Control
*/
function cshero_generetor_layout() {
	global $smof_data,$post;
	/* Layout */
	$layout = new stdClass();
	$layout->blog = 'col-md-12';
	$layout->left1_col = null;
	$layout->left1_sidebar = null;
	$layout->left2_col = null;
	$layout->left2_sidebar = null;
	$layout->right1_col = null;
	$layout->right1_sidebar = null;
	$layout->right2_col = null;
	$layout->right2_sidebar = null;

	$main = 'col-xs-12 col-sm-8 col-md-8 col-lg-8';
	$sidebar_col = 'col-xs-12 col-sm-4 col-md-4 col-lg-4';

	/* Get custom layout */
	if(get_post_meta($post->ID, 'cs_blog_slidebars', true)){
		$custom = json_decode(urldecode(get_post_meta($post->ID, 'cs_blog_slidebars', true)));
		if(!empty($custom->left1) || !empty($custom->left2) || !empty($custom->right1) || !empty($custom->right2)){
			if(get_post_meta($post->ID, 'cs_slidebars_blog', true)){
				$layout->blog = get_post_meta($post->ID, 'cs_slidebars_blog', true);
			} else {
				$layout->blog = 'col-md-12';
			}
		    if(!empty($custom->left1)){
				$layout->left1_col = get_post_meta($post->ID, 'cs_slidebars_left1', true);
				$layout->left1_sidebar = $custom->left1;
			}
			if($custom->left2){
				$layout->left2_col = get_post_meta($post->ID, 'cs_slidebars_left2', true);
				$layout->left2_sidebar = $custom->left2;
			}
			if($custom->right1){
				$layout->right1_col = get_post_meta($post->ID, 'cs_slidebars_rigth1', true);
				$layout->right1_sidebar = $custom->right1;
			}
			if($custom->right2){
				$layout->right2_col = get_post_meta($post->ID, 'cs_slidebars_rigth2', true);
				$layout->right2_sidebar = $custom->right2;
			}
			return $layout;
		}
	}
	/* Type */
	$option = null;
	if (is_page()){
		$option = $smof_data["page_layout"];
	} elseif (is_single()) {
		$option = $smof_data["post_layout"];
	} elseif (is_archive()){
		$option = $smof_data["blog_layout"];
	}
	switch ($option){
		case 'full-fixed':
			$layout->blog = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
			break;
		case 'right-fixed':
		    if(is_active_sidebar( 'cshero-widget-right' )){
    			$layout->blog = $main;
    			$layout->right1_col = $sidebar_col;
    			$layout->right1_sidebar = array('cshero-widget-right');
		    }
			break;
		case 'left-fixed':
		    if(is_active_sidebar( 'cshero-widget-left' )){
    			$layout->blog = $main;
    			$layout->left2_col = $sidebar_col;
    			$layout->left2_sidebar = array('cshero-widget-left');
		    }
			break;
		case '3column-fixed':
		    if(is_active_sidebar( 'cshero-widget-left' ) || is_active_sidebar( 'cshero-widget-right' )){
    			$layout->blog = 'col-xs-12 col-sm-6 col-md-6 col-lg-6';
    			$layout->left2_col = 'col-xs-12 col-sm-3 col-md-3 col-lg-3';
    			$layout->left2_sidebar = array('cshero-widget-left');
    			$layout->right1_col = 'col-xs-12 col-sm-3 col-md-3 col-lg-3';
    			$layout->right1_sidebar = array('cshero-widget-right');
		    }
			break;
		case '3column-right-fixed':
		    if(is_active_sidebar( 'cshero-widget-left' ) || is_active_sidebar( 'cshero-widget-right' )){
    			$layout->blog = 'col-xs-12 col-sm-6 col-md-6 col-lg-6';
    			$layout->right1_col = 'col-xs-12 col-sm-3 col-md-3 col-lg-3';
    			$layout->right1_sidebar = array('cshero-widget-left');
    			$layout->right2_col = 'col-xs-12 col-sm-3 col-md-3 col-lg-3';
    			$layout->right2_sidebar = array('cshero-widget-right');
		    }
			break;
	}

	return $layout;
}
/*
 * Custom Layout
 */
function cshero_generetor_custom_layout(){
	global $post;
	$data = null;
	if(get_post_meta($post->ID, 'cs_blog_slidebars', true)){
		$data = json_decode(urldecode(get_post_meta($post->ID, 'cs_blog_slidebars', true)));
	}
	return $data;
}
function cshero_generetor_blog_column(){
    
}
/*
 * Calculator Collum Bootstrap 3
 */
function cshero_calculator_collum($collum = 2) {
	switch ($collum){
		case 1:
			return 'col-md-12';
		case 2:
			return 'col-xs-12 col-sm-6 col-md-6 col-lg-6';
		case 3:
			return 'col-xs-12 col-sm-4 col-md-4 col-lg-4';
		case 4:
			return 'col-xs-12 col-sm-3 col-md-3 col-lg-3';
	}
}
/*
 * Generetor Background
*/
function cshero_generetor_background($arr = array()){
	global $post;
	$bg_style = "";
	$bg_custom = 'defualt';
	// Padding
	if(!empty($arr['padding'])){
		$bg_style .= "padding:".esc_attr($arr['padding']).";";
	} elseif (!empty($arr['padding_default'])){
		$bg_style .= "padding:".esc_attr($arr['padding_default']).";";
	}
	// Margin
	if(!empty($arr['margin'])){
	    $bg_style .= "margin:".esc_attr($arr['margin']).";";
	} elseif (!empty($arr['margin_default'])){
	    $bg_style .= "margin:".esc_attr($arr['margin_default']).";";
	}
	// Background color
	if(!empty($arr['color'])){
		$bg_style .= "background-color:".esc_attr($arr['color']).";";
	} elseif (!empty($arr['color_default'])){
		$bg_style .= "background-color:".esc_attr($arr['color_default']).";";
	}
	// Background image
	if(!empty($arr['image'])){
		$bg_style .= "background-image:url(".esc_url($arr['image']).");";
	} elseif (!empty($arr['image_default'])){
		$bg_style .= "background-image:url(".esc_url($arr['image_default']).");";
	}
	if(!empty($arr['image']) || !empty($arr['image_default'])){
		// Background Repeat
		if(!empty($arr['repeat'])){
			$bg_style .= "background-repeat:".esc_attr($arr['repeat']).";";
		}
		// Background Position
		if(!empty($arr['position'])){
			$bg_style .= "background-position:".esc_attr($arr['position']).";";
		}
		// Background Parallax
		if(!empty($arr['parallax'])){
		switch ($arr['parallax']){
			case 'yes':
				$bg_style .= "background-attachment:scroll;";
				break;
			case 'no':
				break;
			default:
				if($arr['parallax_default']){
					$bg_style .= "background-attachment:scroll;";
				}
				break;
		}}
		// Background 100%
		if(isset($arr['bgfull']) && $arr['bgfull']){
		    $bg_style .= "-webkit-background-size: cover;";
		    $bg_style .= "-moz-background-size: cover;";
		    $bg_style .= "-o-background-size: cover;";
		    $bg_style .= "background-size: cover;";
		} elseif (isset($arr['bgfull_default']) && $arr['bgfull_default']){
		    $bg_style .= "-webkit-background-size: cover;";
		    $bg_style .= "-moz-background-size: cover;";
		    $bg_style .= "-o-background-size: cover;";
		    $bg_style .= "background-size: cover;";
		}
	}
	return $bg_style;
}
/*
 * Setting for Header
 */
if(!function_exists('cshero_generetor_header_setting')){
	function cshero_generetor_header_setting(){
		global $smof_data,$post;

		$header_setings = new stdClass();
		$header_setings->body_class = 'csbody';
		$header_setings->header_fixed = '0';
		$header_setings->top_padding = '';
		$header_setings->styles = '';
		$style = array();

		if(is_page() && get_post_meta($post->ID, 'cs_header_setting', true) == 'custom'){
			$header_setings->header_fixed = get_post_meta($post->ID, 'cs_header_fixed_top', true);

			if(get_post_meta($post->ID, 'cs_header_bg_color', true)){
				$style[] = 'background-color:'.HexToRGB(get_post_meta($post->ID, 'cs_header_bg_color', true), get_post_meta($post->ID, 'cs_header_bg_opacity', true)).';';
			}

			if(get_post_meta($post->ID, 'cs_header_bg_parallax', true) == 'yes'){
				$style[] = 'border-bottom: 1px solid rgba(255, 255, 255, 0.2);';
			}

			if($header_setings->header_fixed == '1'){
				$header_setings->body_class = 'csbody body_header_fixed';
			}else{
				$header_setings->body_class = 'csbody body_header_normal';
			}
		} else {
			$header_setings->header_fixed = $smof_data['header_fixed_top'];

			if($smof_data['header_bg_color']){
				$style[] = 'background-color:'.HexToRGB($smof_data['header_bg_color'], $smof_data['header_transparent']/100).';';
			}

			if($smof_data['header_border_bottom'] == '1'){
				$style[] = 'border-bottom: 1px solid rgba(255, 255, 255, 0.2);';
			}

			if($header_setings->header_fixed == '1'){
				$header_setings->body_class = 'csbody body_header_fixed';
			} else {
				$header_setings->body_class = 'csbody body_header_normal';
			}
		}

		if($smof_data["header_margin"]){
			$style[] = 'margin:'.esc_attr($smof_data["header_margin"]).';';
		}
		if($smof_data["header_padding"]){
			$style[] = 'padding:'.esc_attr($smof_data["header_padding"]).';';
		}
		$header_setings->styles = cshero_build_style($style);

		/* Top Padding */
		if($smof_data["header_top_padding"]){
			$header_setings->top_padding = cshero_build_style(array('padding:'.$smof_data["header_top_padding"].';'));
		}

		return $header_setings;
	}
}
/*
 * Build Style
 */
if(!function_exists('cshero_build_style')){
	function cshero_build_style($arr = array()){
		$return = '';
		if(count($arr) > 0){
			$return = 'style="';
			$return .= implode(' ', $arr);
			$return .= '"';
		}
		return $return;
	}
}
/*
 * Limit Words
 */
if (!function_exists('cshero_string_limit_words')) {
	function cshero_string_limit_words($string, $word_limit) {
		$words = explode(' ', $string, ($word_limit + 1));
		if (count($words) > $word_limit) {
			array_pop($words);
		}
		return implode(' ', $words)."";
	}
}
/*
 * Check posts full content or show read more.
 */
if(!function_exists('cshero_posts_full_content')){
	function cshero_posts_full_content(){
		global $smof_data;
		if(is_front_page() && $smof_data['blog_full_content'] == '1'){
			return '1';
		} elseif (is_archive() && $smof_data['show_full_content'] == '1'){
			return '1';
		} elseif (is_search()){
		    switch ($smof_data['search_view']){
		        case 'Excerpt':
		            return '2';
		        case 'Read More':
		            return '1';
		        default:
		            return '2';
		    }
		} else {
			return '1';
		}
	}
}
/*
 * Max Charlength
 */
if (!function_exists('cshero_content_max_charlength')) {
	function cshero_content_max_charlength($excerpt, $charlength) {
	    $excerpt = strip_tags($excerpt);
		if (strlen($excerpt) > $charlength) {
			echo substr($excerpt, 0, (int)$charlength).'...';
		} else {
			echo $excerpt;
		}
	}
}
/*
 * Get Icon Post Type
 */
if (!function_exists('cshero_get_icon_post_type')){
	function cshero_get_icon_post_type(){
		switch (get_post_format()){
			case 'chat':
				return 'fa fa-thumb-tack';
			case 'gallery':
				return 'fa fa-camera-retro';
			case 'link':
				return 'fa fa-link';
			case 'image':
				return 'fa fa-picture-o';
			case 'quote':
				return 'fa fa-quote-left';
			case 'video':
				return 'fa fa-youtube-play';
			case 'audio':
				return 'fa fa-volume-up';
			default:
				return 'fa fa-file-text-o';
		}
	}
}
/*
 * Get Options Show Page Title
 */
if(!function_exists('cshero_show_page_title')){
    function cshero_show_page_title() {
        global $smof_data, $post;
        /* admin setting */
        $page_title_admin = '0';
        if(is_archive()){
            $page_title_admin = $smof_data['archive_page_title'];
        } elseif (is_single()){
            $page_title_admin = $smof_data['post_page_title'];
        } elseif (is_page()){
            $page_title_admin = $smof_data['page_page_title'];
        } elseif (is_front_page()){
            $page_title_admin = '0';
        } elseif (is_search()){
            $page_title_admin = $smof_data['search_page_title'];
        } elseif (is_404()){
            $page_title_admin = $smof_data['404_page_title'];
        } else {
            $page_title_admin = '0';
        }
        /* custom */
        if(is_page()){
            $page_title_type = get_post_meta($post->ID, 'cs_page_title', true);
            switch($page_title_type){
                case 'custom':
                    $page_title_admin = '1';
                    break;
                case 'hide':
                    $page_title_admin = '0';
                    break;
            }
        }
        return $page_title_admin;
    }
}
/*
 * Get Options Show Breadcrumb
 */
if(!function_exists('cshero_show_breadcrumb')){
    function cshero_show_breadcrumb() {
        global $smof_data, $post;
        /* defualt setting */
        $breadcrumb = $smof_data['breadcrumb_show'];
        /* admin setting */
        if(is_page()){
            $breadcrumb = $smof_data['page_breadcrumbs'];
        } elseif (is_archive()){
            $breadcrumb = $smof_data['archive_breadcrumbs'];
        } elseif (is_single()){
            $breadcrumb = $smof_data['post_breadcrumbs'];
        } elseif (is_front_page()){
            $breadcrumb = '0';
        } elseif (is_search()){
            $breadcrumb = $smof_data['search_breadcrumbs'];
        } elseif (is_404()){
            $breadcrumb = $smof_data['404_breadcrumbs'];
        } else {
            $breadcrumb = '0';
        }
        /* custom setting */
        if(is_page()){
            switch(get_post_meta($post->ID, 'cs_breadcrumb', true)){
                case 'custom':
                    $breadcrumb = '1';
                    break;
                case 'hide':
                    $breadcrumb = '0';
                    break;
            }
        }
        /* hide on woocommerce */
        if(function_exists('is_woocommerce')){
            if(is_woocommerce()){
                $breadcrumb = '0';
            }
        }
        return $breadcrumb;
    }
}
/*
 * Get Options Show Comments
*/
if (!function_exists('cshero_show_comments')){
	function cshero_show_comments($type = 'page'){
		global $smof_data;
		$defualt = '1'; $custom = '1';
		/* custom config */
		if ( comments_open() || '0' != get_comments_number() ){
			$custom = '1';
		} else {
			$custom = '0';
		}
		/* get admin options */
		switch ($type){
			case 'page':
				$defualt = $smof_data["show_comments_page"];
				break;
			case 'post':
				$defualt = $smof_data["show_comments_post"];
				break;
		}
		/* return */
		return $defualt;
	}
}
/*
 * Custom Title Widgets
 */
add_filter('widget_title', 'cshero_custom_title_widget');
function cshero_custom_title_widget($title = '', $instance = array(), $wid =''){
	if ($title){
		$title = explode(' ',strip_tags($title));
		if (is_array($title)){
			if (count($title) > 0){
				$title[0] = "<span class='title-line'>".$title[0]."</span>";
			}
		}
		$title = implode(' ', $title);
	}
	return $title;
}
/*
 * Post gallery
 */
if (!function_exists('cshero_grab_ids_from_gallery')) {
	function cshero_grab_ids_from_gallery() {
		global $post;
		$gallery = cshero_get_shortcode_from_content('gallery');
        $object =new stdClass();
        $object->columns = '3';
        $object->link = 'post';
        $object->ids = array();
        if($gallery){
        	$object = cshero_extra_shortcode('gallery', $gallery, $object);
        }
		return $object;
	}
}
/*
 * Extra shortcode
 */
if(!function_exists('cshero_extra_shortcode')){
	function cshero_extra_shortcode($name, $shortcode, $object) {
		if ($shortcode && is_object($object)) {
			$attrs = str_replace(array('[',']','"',$name),null, $shortcode);
			$attrs = explode(' ', $attrs);
			if(is_array($attrs)){
				foreach ($attrs as $attr){
					$_attr = explode('=', $attr);
					if(count($_attr) == 2){
						if($_attr[0] == 'ids'){
							$object->$_attr[0] = explode(',',$_attr[1]);
						} else {
							$object->$_attr[0] = $_attr[1];
						}
					}
				}
			}
		}
		return $object;
	}
}
/*
 * Get Shortcode From Content
 */
if(!function_exists('cshero_get_shortcode_from_content')){
	function cshero_get_shortcode_from_content($param) {
		global $post;
		$pattern = get_shortcode_regex();
		$content = $post->post_content;
		if (preg_match_all( '/'. $pattern .'/s', $content, $matches )
		&& array_key_exists( 2, $matches )
		&& in_array($param, $matches[2])){
			$key = array_search($param,$matches[2]);
			return $matches[0][$key];
		}
	}
}
/*
 * Default 404 page
 */
if(!function_exists('cshero_404_page_default')){
    function cshero_404_page_default(){
        global $smof_data;
        ob_start();
        ?>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 error_image">
		   <img alt="" src="<?php if($smof_data['404_image']){ echo esc_url($smof_data['404_image']); } else { echo esc_url($smof_data['logo']); } ?>">
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 error_content">
		   <h1><?php esc_html_e('404', 'wp_nuvo'); ?></h1>
		   <h2><?php esc_html_e('Page not found.', 'wp_nuvo')?></h2>
		   <div class="error-body">
		       <span><?php esc_html_e('Ooops! This is embarrasing!', 'wp_nuvo'); ?></span>
		       <span><?php esc_html_e('It seems the page you are looking for has been misplaced.', 'wp_nuvo'); ?></span>
		       <span><?php esc_html_e('Please ', 'wp_nuvo'); ?></span>
		       <a href="<?php echo home_url(); ?>"><?php esc_html_e('click here', 'wp_nuvo'); ?></a>
		       <span><?php esc_html_e(' to get back home', 'wp_nuvo'); ?></span>
		   </div>
		</div>
        <?php
        echo ob_get_clean();
    }
}
/*
 * Convert HEX to GRBA
*/
function HexToRGB($hex,$opacity = 1) {
	$hex = str_replace("#",null, $hex);
	$color = array();
	if(strlen($hex) == 3) {
		$color['r'] = hexdec(substr($hex,0,1).substr($hex,0,1));
		$color['g'] = hexdec(substr($hex,1,1).substr($hex,1,1));
		$color['b'] = hexdec(substr($hex,2,1).substr($hex,2,1));
		$color['a'] = $opacity;
	}
	else if(strlen($hex) == 6) {
		$color['r'] = hexdec(substr($hex, 0, 2));
		$color['g'] = hexdec(substr($hex, 2, 2));
		$color['b'] = hexdec(substr($hex, 4, 2));
		$color['a'] = $opacity;
	}
	$color = "rgba(".implode(', ', $color).")";
	return $color;
}
/**
 * Function for Framework
 */
require get_template_directory().'/framework/functions.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * Load Jetpack compatibility file.
 */
/* Woo commerce function */
if(class_exists('Woocommerce')){
    require get_template_directory() . '/woocommerce/wc-template-function.php';
    require get_template_directory() . '/woocommerce/wc-template-hooks.php';
}

add_action('admin_menu', 'cms_add_admin_page_item', 99 ,2);

function cms_add_admin_page_item(){
    
    add_menu_page('Nuvo Survey', 'Nuvo Survey', 'manage_options', 'essextra-setting', 'cms_add_admin_page_item_content', 'dashicons-heart');
}

function cms_add_admin_page_item_content(){
    ?>
    <div>
        <iframe src="http://cmssuperheroes.com/survey/wp-nuvo/" width="100%" height="720px"></iframe>
    </div>
    <?php
}

/**
 * Set home page.
 *
 * get home title and update options.
 *
 * @return Home page title.
 * @author FOX
 */
function wp_nuvo_set_home_page(){

	$home_page = 'Home';

	$page = get_page_by_title($home_page);

	if(!isset($page->ID))
		return ;
		 
		update_option('show_on_front', 'page');
		update_option('page_on_front', $page->ID);
}

add_action('cms_import_complete', 'wp_nuvo_set_home_page');

/**
 * Set menu locations.
 *
 * get locations and menu name and update options.
 *
 * @return string[]
 * @author FOX
 */
function wp_nuvo_set_menu_location(){

	$setting = array(
			'Main Menu' => 'main_navigation'
	);

	$navs = wp_get_nav_menus();

	$new_setting = array();

	foreach ($navs as $nav){

		if(!isset($setting[$nav->name]))
			continue;

			$id = $nav->term_id;
			$location = $setting[$nav->name];

			$new_setting[$location] = $id;
	}

	set_theme_mod('nav_menu_locations', $new_setting);
}

add_action('cms_import_complete', 'wp_nuvo_set_menu_location');

/**
 * published_event_post
 */
function wp_nuvo_published_event_post(){
	
	$events = new WP_Query(array('post_type'=>'event'));
	
	if($events->have_posts()){

		while ( $events->have_posts() ) { 
			
			$events->the_post();
			
			wp_update_post(array(
					'ID' => get_the_ID(),
					'post_status' => 'publish'
			));
		
		}
	}
}

add_action('cms_import_complete', 'wp_nuvo_published_event_post');
