<?php

// // DO NOT MODIFY
// define("THEME_SLUG", 'the_retailer'); 
// define("THEME_NAME", 'The Retailer');

/*********************************************/
/**************** INCLUDES *******************/
/*********************************************/

// -----------------------------------------------------------------------------
// String to Slug
// -----------------------------------------------------------------------------

if ( ! function_exists( 'getbowtied_string_to_slug' ) ) :
function getbowtied_string_to_slug($str) {
	$str = strtolower(trim($str));
	$str = preg_replace('/[^a-z0-9-]/', '_', $str);
	$str = preg_replace('/-+/', "_", $str);
	return $str;
}
endif;

// -----------------------------------------------------------------------------
// Theme Name
// -----------------------------------------------------------------------------

if ( ! function_exists( 'getbowtied_theme_name' ) ) :
function getbowtied_theme_name() {
	$getbowtied_theme = wp_get_theme();
	return $getbowtied_theme->get('Name');
}
endif;

// -----------------------------------------------------------------------------
// Theme Slug
// -----------------------------------------------------------------------------

if ( ! function_exists( 'getbowtied_theme_slug' ) ) :
function getbowtied_theme_slug() {
	$getbowtied_theme = wp_get_theme();
	return getbowtied_string_to_slug( $getbowtied_theme->get('Name') );
}
endif;


// -----------------------------------------------------------------------------
// Theme Author
// -----------------------------------------------------------------------------

if ( ! function_exists( 'getbowtied_theme_author' ) ) :
function getbowtied_theme_author() {
	$getbowtied_theme = wp_get_theme();
	return $getbowtied_theme->get('Author');
}
endif;

// -----------------------------------------------------------------------------
// Theme Description
// -----------------------------------------------------------------------------

if ( ! function_exists( 'getbowtied_theme_description' ) ) :
function getbowtied_theme_description() {
	$getbowtied_theme = wp_get_theme();
	return $getbowtied_theme->get('Description');
}
endif;


// -----------------------------------------------------------------------------
// Theme Version
// -----------------------------------------------------------------------------

if ( ! function_exists( 'getbowtied_theme_version' ) ) :
function getbowtied_theme_version() {
	$getbowtied_theme = wp_get_theme(get_template());
	return $getbowtied_theme->get('Version');
}
endif;


if ( is_admin() )
{
	if ( ! class_exists('Getbowtied_Admin_Pages') )
	{
		if (current_user_can('administrator')):
			require_once( get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php' );
			require_once( get_template_directory() . '/inc/tgm/plugins.php' );
			include_once('admin/admin.php');
		endif;
	}
}


include_once('admin/index.php'); // Load Theme Options
include_once('inc/custom_styles.php'); // Load Custom Styles
include_once('inc/paginate.php'); // Load Pagination
include_once('inc/widgets/connect.php'); // Load Widget Connect
include_once('inc/widgets/social-media.php'); // Load Widget Social Media
include_once('inc/widgets/recent-posts.php'); // Load Widget Recent Posts

add_theme_support( 'woocommerce');
add_theme_support( "title-tag" );
add_theme_support( "custom-header" );

/**********************************************/
/************* Theme Options Array ************/
/**********************************************/

$theretailer_theme_options = $smof_data;
include_once('inc/fonts_from_google.php'); // Load Fonts from Google

/******************************************************************************/
/***************** add links/menus to the admin bar ***************************/
/******************************************************************************/
function theretailer_admin_bar_render() {
	global $wp_admin_bar;
	$wp_admin_bar->add_menu( array(
		'parent' => 'appearance', // use 'false' for a root menu, or pass the ID of the parent menu
		'id' => 'theretailer_theme_options_admin_bar_link', // link ID, defaults to a sanitized title value
		'title' => __('Theme Options', 'theretailer'), // link title
		'href' => admin_url( 'admin.php?page=optionsframework'), // name of file
		'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
	));
}
if (current_user_can('administrator')):
	add_action( 'wp_before_admin_bar_render', 'theretailer_admin_bar_render' );
endif;

/*********************************************/
/****************** STYLES *******************/
/*********************************************/

function theretailer_styles() {	

	global $theretailer_theme_options;
	
	wp_enqueue_style('getbowtied-font-awesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css', array(), '4.6.3', 'all' );
	wp_enqueue_style('getbowtied-fonts', get_template_directory_uri() . '/fonts/getbowtied-fonts/style.css', array(), '1.0', 'all' );
	wp_enqueue_style('linea-fonts', get_template_directory_uri() . '/fonts/linea-fonts/styles.css', array(), '1.0', 'all' );
	wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/owl/owl.carousel.css', array(), 'v1.3.3', 'all' );
	// wp_enqueue_style('audioplayer', get_template_directory_uri() . '/css/audioplayer.css', array(), '1.0', 'all' );
	wp_enqueue_style('select2', get_template_directory_uri() . '/css/select2.css', array(), '3.4.5', 'all' );
	wp_enqueue_style('fresco', get_template_directory_uri() . '/css/fresco/fresco.css', array(), '1.2.7', 'all' );
	if ((isset($theretailer_theme_options['progress_bar'])) && ($theretailer_theme_options['progress_bar'] == "1")) {
		wp_enqueue_style('nprogress', get_template_directory_uri() . '/css/nprogress.css', array(), '0.1.6', 'all' );
	}
	wp_enqueue_style('swiper-slider', get_template_directory_uri() . '/css/swiper.css', array(), '3.3.1', 'all' );
	wp_enqueue_style('stylesheet', get_stylesheet_uri(), array(), NULL, 'all');
	
}  
add_action( 'wp_enqueue_scripts', 'theretailer_styles', 99 );

// admin area
function the_retailer_admin_styles() {
    if ( is_admin() ) {
		
		wp_enqueue_style('the_retailer_admin_custom', get_template_directory_uri() .'/css/wp-admin-custom.css', false, NULL, 'all');
		
		if (class_exists('WPBakeryVisualComposerAbstract')) { 
			wp_enqueue_style('the_retailer_visual_composer', get_template_directory_uri() .'/css/visual-composer.css', false, "1.0", 'all');
			wp_enqueue_style('the_retailer_linea_fonts', get_template_directory_uri() .'/fonts/linea-fonts/styles.css', false, "1.0", 'all');
		}
    }
}
add_action( 'admin_enqueue_scripts', 'the_retailer_admin_styles' );




/*********************************************/
/****************** SCRIPTS ******************/
/*********************************************/


function theretailer_scripts() {  

	global $theretailer_theme_options;
	
	wp_enqueue_script('youtube-api', 'https://www.youtube.com/iframe_api', array(), NULL, TRUE);
	wp_enqueue_script('vimeo-api', 'https://secure-a.vimeocdn.com/js/froogaloop2.min.js', array(), NULL, TRUE);	

	if ((isset($theretailer_theme_options['progress_bar'])) && ($theretailer_theme_options['progress_bar'] == "1")) {
		wp_enqueue_script('nprogress', get_template_directory_uri() . '/js/nprogress.js', array('jquery'), '0.1.6', TRUE);
	}

	wp_enqueue_script('hoverIntent', get_template_directory_uri() . '/js/hoverIntent.js', array('jquery'), '1', TRUE);
	wp_enqueue_script('footable', get_template_directory_uri() . '/js/footable-0.1.js', array('jquery'), '0.1', TRUE);
	wp_enqueue_script('customSelect', get_template_directory_uri() . '/js/jquery.customSelect.min.js', array('jquery'), '0.3.0', TRUE);
	wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), 'v1.3.3', TRUE);
	wp_enqueue_script('select2', get_template_directory_uri() . '/js/select2.min.js', array('jquery'), '3.4.5', TRUE);
	// wp_enqueue_script('audioplayer', get_template_directory_uri() . '/js/audioplayer.min.js', array('jquery'), '1.0', TRUE);
	wp_enqueue_script('fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), '1.0.3', TRUE);
	wp_enqueue_script('fresco', get_template_directory_uri() . '/js/fresco.js', array('jquery'), '1.4.11', TRUE);
	wp_enqueue_script('mixitup', get_template_directory_uri() . '/js/jquery.mixitup.min.js', array('jquery'), '2.1.1', TRUE);
	wp_enqueue_script('stellar', get_template_directory_uri() . '/js/jquery.stellar.min.js', array('jquery'), '0.6.2', TRUE);
	wp_enqueue_script('swiper', get_template_directory_uri() . '/js/swiper.jquery.min.js', array('jquery'), '3.3.1', TRUE);
	wp_enqueue_script('init', get_template_directory_uri() . '/js/init.js', array('jquery'), NULL, TRUE);
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	

}

add_action( 'wp_enqueue_scripts', 'theretailer_scripts', 99 );



/******************************************************************************/
/******************** Revolution Slider set as Theme **************************/
/******************************************************************************/

if(function_exists('set_revslider_as_theme')) {
	set_revslider_as_theme();
}


/******************************************************************************/
/*************************** Visual Composer **********************************/
/******************************************************************************/

if (class_exists('WPBakeryVisualComposerAbstract')) {
	
	add_action( 'init', 'visual_composer_stuff' );
	function visual_composer_stuff() {
		
		// Modify and remove existing shortcodes from VC
		include_once('inc/shortcodes/visual-composer/custom_vc.php');
		
		// VC Templates
		$vc_templates_dir = get_template_directory() . '/inc/shortcodes/visual-composer/vc_templates/';
		vc_set_template_dir($vc_templates_dir);
		
		// Add new shortcodes to VC
		include_once('inc/shortcodes/visual-composer/from-the-blog.php');
		include_once('inc/shortcodes/visual-composer/banner.php');
		include_once('inc/shortcodes/visual-composer/team-members.php');
		include_once('inc/shortcodes/visual-composer/featured-products-slider.php');
		include_once('inc/shortcodes/visual-composer/icon-box.php');
		include_once('inc/shortcodes/visual-composer/recent-work-filtered.php');
		include_once('inc/shortcodes/visual-composer/title-subtitle.php');
		include_once('inc/shortcodes/visual-composer/slider.php');
		
		// Add new Shop shortcodes to VC
		if (class_exists('WooCommerce')) {
			include_once('inc/shortcodes/visual-composer/wc-recent-products.php');
			include_once('inc/shortcodes/visual-composer/wc-featured-products.php');
			include_once('inc/shortcodes/visual-composer/wc-products-by-category.php');
			include_once('inc/shortcodes/visual-composer/wc-products-by-attribute.php');
			include_once('inc/shortcodes/visual-composer/wc-product-by-id-sku.php');
			include_once('inc/shortcodes/visual-composer/wc-products-by-ids-skus.php');
			include_once('inc/shortcodes/visual-composer/wc-sale-products.php');
			include_once('inc/shortcodes/visual-composer/wc-top-rated-products.php');
			include_once('inc/shortcodes/visual-composer/wc-best-selling-products.php');
			include_once('inc/shortcodes/visual-composer/wc-add-to-cart-button.php');
			include_once('inc/shortcodes/visual-composer/wc-product-categories.php');
		}
		
		// Remove vc_teaser
		if (is_admin()) :
			function remove_vc_teaser() {
				remove_meta_box('vc_teaser', '' , 'side');
			}
			add_action( 'admin_head', 'remove_vc_teaser' );
		endif;
	
	}

}

add_action( 'vc_before_init', 'theretailer_vcSetAsTheme' );
function theretailer_vcSetAsTheme() {
	vc_manager()->disableUpdater(true);
	vc_set_as_theme();
}



// Add new Shortcodes
include_once('inc/shortcodes/mixed/recent-products-mixed.php');
include_once('inc/shortcodes/mixed/featured-products-mixed.php');
include_once('inc/shortcodes/mixed/sale-products-mixed.php');
include_once('inc/shortcodes/mixed/best-selling-products-mixed.php');
include_once('inc/shortcodes/mixed/products-by-category-mixed.php');
include_once('inc/shortcodes/mixed/products-mixed.php');
include_once('inc/shortcodes/mixed/products-by-attribute-mixed.php');
include_once('inc/shortcodes/mixed/top-rated-products-mixed.php');





/*********************************************/
/***** adding shortcodes to excerpts *********/
/*********************************************/

add_filter('the_excerpt', 'do_shortcode');

/*********************************************/
/******* modify the excerpt read more ********/
/*********************************************/

function new_excerpt_more( $excerpt ) {
	global $post;
	$excerpt_more = '';
	$trans = array(
		"[...]" => $excerpt_more, //Wordpress < v3.5.2
		"[&hellip;]" => $excerpt_more //Wordpress >= v3.6
	);
	return strtr($excerpt, $trans);
}
add_filter( 'wp_trim_excerpt', 'new_excerpt_more' );



/**********************************************/
/**************** TAXONOMIES ******************/
/**********************************************/

//flush_rewrite_rules();

// create Portfolio
add_action( 'init', 'create_portfolio_item' );
function create_portfolio_item() {
	
	$labels = array(
		'name' => _x('Portfolio', 'post type general name', 'theretailer'),
		'singular_name' => _x('Portfolio Item', 'post type singular name', 'theretailer'),
		'add_new' => _x('Add New', 'Portfolio Item', 'theretailer'),
		'add_new_item' => __('Add New Portfolio item', 'theretailer'),
		'edit_item' => __('Edit Portfolio item', 'theretailer'),
		'new_item' => __('New Portfolio item', 'theretailer'),
		'all_items' => __('All Portfolio items', 'theretailer'),
		'view_item' => __('View Portfolio item', 'theretailer'),
		'search_items' => __('Search Portfolio item', 'theretailer'),
		'not_found' =>  __('No Portfolio item found', 'theretailer'),
		'not_found_in_trash' => __('No Portfolio item found in Trash', 'theretailer'), 
		'parent_item_colon' => '',
		'menu_name' => 'Portfolio'
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'show_in_nav_menus' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => true,
		'menu_position' => 4,
		'supports' => array('title', 'editor', 'thumbnail'),
		'rewrite' => array('slug' => 'portfolio-item'),
		'with_front' => FALSE
	);
	
	register_post_type('portfolio',$args);
	
}

// create Portfolio Taxonomy
	
add_action( 'init', 'create_portfolio_categories' );
function create_portfolio_categories() {
$labels = array(
	'name'                       => _x('Portfolio Categories', 'taxonomy general name', 'theretailer'),
	'singular_name'              => _x('Portfolio Category', 'taxonomy singular name', 'theretailer'),
	'search_items'               => __('Search Portfolio Categories', 'theretailer'),
	'popular_items'              => __('Popular Portfolio Categories', 'theretailer'),
	'all_items'                  => __('All Portfolio Categories', 'theretailer'),
	'edit_item'                  => __('Edit Portfolio Category', 'theretailer'),
	'update_item'                => __('Update Portfolio Category', 'theretailer'),
	'add_new_item'               => __('Add New Portfolio Category', 'theretailer'),
	'new_item_name'              => __('New Portfolio Category Name', 'theretailer'),
	'separate_items_with_commas' => __('Separate Portfolio Categories with commas', 'theretailer'),
	'add_or_remove_items'        => __('Add or remove Portfolio Categories', 'theretailer'),
	'choose_from_most_used'      => __('Choose from the most used Portfolio Categories', 'theretailer'),
	'not_found'                  => __('No Portfolio Category found.', 'theretailer'),
	'menu_name'                  => __('Portfolio Categories', 'theretailer'),
);

$args = array(
	'hierarchical'          => true,
	'labels'                => $labels,
	'show_ui'               => true,
	'show_admin_column'     => true,
	'query_var'             => true,
	'rewrite'               => array( 'slug' => 'portfolio-category' ),
);

register_taxonomy("portfolio_filter", "portfolio", $args);
}

add_filter( 'option_posts_per_page', 'tdd_tax_filter_posts_per_page' );
function tdd_tax_filter_posts_per_page( $value ) {
    return (is_tax('portfolio_filter')) ? 1 : $value;
}


/***************************************************/
/**************** Enable excerpts ******************/
/***************************************************/

add_action('init', 'theretailer_post_type_support');
function theretailer_post_type_support() {
	add_post_type_support( 'page', 'excerpt' );
	add_post_type_support( 'portfolio', 'excerpt' );
}


/******************************************************/
/**************** CUSTOM IMAGE SIZES ******************/
/******************************************************/

add_image_size('portfolio-details', 1180, 2000, true);
add_image_size('recent_posts_shortcode', 480, 480, true);
add_image_size('portfolio_4_col', 220, 165, true); //4X3
add_image_size('portfolio_3_col', 300, 225, true); //4X3
add_image_size('portfolio_2_col', 460, 345, true); //4X3
add_image_size('review_thumb', 140, 140, true);

/******************************************************/
/******************* SHORTCODES ***********************/
/******************************************************/


// [full_column]
function content_grid_12($params = array(), $content = null) {	
	$content = do_shortcode($content);
	$full_column = '<div class="content_grid_12 clr">'.$content.'</div>';
	return $full_column;
}

// [one_half]
function content_grid_6($params = array(), $content = null) {	
	$content = do_shortcode($content);
	$one_half = '<div class="content_grid_6">'.$content.'</div>';
	return $one_half;
}

// [one_third]
function content_grid_4($params = array(), $content = null) {	
	$content = do_shortcode($content);
	$one_third = '<div class="content_grid_4">'.$content.'</div>';
	return $one_third;
}

// [two_third]
function content_grid_2_3($params = array(), $content = null) {	
	$content = do_shortcode($content);
	$two_third = '<div class="content_grid_2_3">'.$content.'</div>';
	return $two_third;
}

// [one_fourth]
function content_grid_3($params = array(), $content = null) {	
	$content = do_shortcode($content);
	$one_fourth = '<div class="content_grid_3">'.$content.'</div>';
	return $one_fourth;
}

// [one_sixth]
function content_grid_2($params = array(), $content = null) {	
	$content = do_shortcode($content);
	$one_sixth = '<div class="content_grid_2">'.$content.'</div>';
	return $one_sixth;
}

// [one_twelves]
function content_grid_1($params = array(), $content = null) {	
	$content = do_shortcode($content);
	$one_twelves = '<div class="content_grid_1">'.$content.'</div>';
	return $one_twelves;
}

// [column_demo]
function column_demo($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'bgcolor' => '#ccc'
	), $params));
	
	$content = do_shortcode($content);
	$column_demo = '<div class="column_demo" style="background-color:'.$bgcolor.'">'.$content.'</div>';
	return $column_demo;
}

// [separator]
function shortcode_separator($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'top_space' => '10px',
		'bottom_space' => '30px'
	), $params));
	$separator = '
		<div class="clr"></div><div class="content_hr" style="margin-top:'.$top_space.';margin-bottom:'.$bottom_space.'"></div><div class="clr"></div>
	';
	return $separator;
}

// [empty_separator]
function shortcode_empty_separator($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'top_space' => '10px',
		'bottom_space' => '30px'
	), $params));
	$empty_separator = '
		<div class="clr"></div><div class="empty_separator" style="margin-top:'.$top_space.';margin-bottom:'.$bottom_space.'"></div><div class="clr"></div>
	';
	return $empty_separator;
}

// [featured_box]
function shortcode_big_box_txt_bg($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'title' => 'Title',
		'background_url' => ''
	), $params));
	
	$content = do_shortcode($content);
	$featured_box = '
		<div class="shortcode_big_box_txt_bg_wrapper" style="background-image:url('.$background_url.')">
		<div class="shortcode_big_box_txt_bg">
			<h3>'.$title.'</h3>
			<div class="sep"></div>
			<h5>'.$content.'</h5>
		</div>
		</div>
	';
	return $featured_box;
}

// [text_block]
function shortcode_text_block($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'title' => 'Title'
	), $params));
	
	$content = do_shortcode($content);
	$text_block = '		
		<div class="shortcode_text_block">
			<h3>'.$title.'</h3>
			<p>'.$content.'</p>
		</div>
	';
	return $text_block;
}

// [featured_1]
function shortcode_featured_1($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'image_url' => '',
		'title' => 'Title',
		'button_text' => 'Link button',
		'button_url' => '#'
	), $params));
	
	if (is_numeric($image_url)) {
		$image_url = wp_get_attachment_url($image_url);
	}
	
	$content = do_shortcode($content);
	$featured_1 = '		
		<div class="shortcode_featured_1">
			<div class="shortcode_featured_1_img_placeholder"><img src="'.$image_url.'" alt="" /></div>
			<h3>'.$title.'</h3>
			<p>'.$content.'</p>
			<a href="'.$button_url.'">'.$button_text.'</a>
		</div>
	';
	return $featured_1;
}

//[section_title]

function section_title($params = array(), $content = null) {
	
	$content = do_shortcode($content);
	$section_title = '<div class="section_title">'.$content.'</div>';
	return $section_title;
}


// [tabgroup]
function tabgroup( $params, $content = null ) {
	$GLOBALS['tabs'] = array();
	$GLOBALS['tab_count'] = 0;
	$i = 1;
	$randomid = rand();
	
	extract(shortcode_atts(array(
		'title' => 'Title'
	), $params));

	do_shortcode($content);

	if( is_array( $GLOBALS['tabs'] ) ){
	
		foreach( $GLOBALS['tabs'] as $tab ){	
			$tabs[] = '<li class="tab"><a href="#panel'.$randomid.$i.'">'.$tab['title'].'</a></li>';
			$panes[] = '<div class="panel" id="panel'.$randomid.$i.'"><p>'.do_shortcode($tab['content']).'</p></div>';
			$i++;
		}
		$return = '
		<div class="shortcode_tabgroup">
			<h3>'.$title.'</h3>
			<ul class="tabs">'.implode( "\n", $tabs ).'</ul><div class="panels">'.implode( "\n", $panes ).'</div><div class="clr"></div></div>';
	}
	return $return;
}

function tab( $params, $content = null) {
	extract(shortcode_atts(array(
			'title' => ''
	), $params));
	
	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );
	$GLOBALS['tab_count']++;
}

// [team_member]
function team_member($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'image_url' => '',
		'name' => 'Name',
		'role' => 'Role'
	), $params));
	
	if (is_numeric($image_url)) {
		$image_url = wp_get_attachment_url($image_url);
	}
	
	$content = do_shortcode($content);
	$team_member = '
		<div class="shortcode_meet_the_team">
			<div class="shortcode_meet_the_team_img_placeholder"><img src="'.$image_url.'" alt="" /></div>
			<h3>'.$name.'</h3>
			<div class="small_sep"></div>
			<div class="role">'.$role.'</div>
			<p>'.$content.'</p>
		</div>
	';
	return $team_member;
}

// [bold_title]
function bold_title($params = array(), $content = null) {
	$bold_title = '
		<h2 class="bold_title"><span>'.$content.'</span></h2>
	';
	return $bold_title;
}

// [our_services]
function our_services($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'image_url' => '',
		'title' => 'Title',
		'link_name' => '',
		'link_url' => ''
	), $params));
	
	if (is_numeric($image_url)) {
		$image_url = wp_get_attachment_url($image_url);
	}
	
	$content = do_shortcode($content);
	$our_services = '		
		<div class="shortcode_our_services">
			<div class="shortcode_our_services_img_placeholder"><img src="'.$image_url.'" alt="" /></div>
			<h3>'.$title.'</h3>
			<div class="small_sep"></div>
			<p>'.$content.'</p>
			<a href="'.$link_url.'">'.$link_name.'</a>
		</div>
	';
	return $our_services;
}

// [icon_box]
function icon_box_shortcode($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'icon' => '',
		'icon_position' => 'top',
		'icon_style' => 'normal',
		'icon_color' => '#000',
		'icon_bg_color' => '#ffffff',
		'title' => '',
		'link_name' => '',
		'link_url' => ''
	), $params));
	
	if (is_numeric($icon)) {
		$icon = wp_get_attachment_url($icon);
	}
	
	/*switch ($icon_style) {
		case "normal":
			break;
		case "outlined":
			break;
		case "bg_color":
			break;
	}*/
	
	$title_markup = "";
	$content_markup = "";
	$button_markup = "";
	
	if ($title != "") $title_markup = '<h3 class="title">' . $title . '</h3>';
	if ($content != "") $content_markup = '<p>' . do_shortcode($content) . '</p>';
	if ($link_name != "") $button_markup = '<a class="icon_box_read_more" href="' . $link_url . '">' . $link_name . '</a>';
	
	$icon_box_markup = '		
		<div class="shortcode_icon_box icon_position_'.$icon_position.' icon_style_'.$icon_style.'">
			<div class="icon_wrapper" style="background-color:'.$icon_bg_color.'; border-color:'.$icon_color.'">
				<div class="icon '.$icon.'" style="color:'.$icon_color.'"></div>
			</div>'
			.$title_markup
			.$content_markup
			.$button_markup.
		'</div>
	';
	return $icon_box_markup;
}

// [accordion]
function accordion($atts, $content=null, $code) {

	extract(shortcode_atts(array(
		'open' => '1',
		'title' => 'Title'
	), $atts));

	if (!preg_match_all("/(.?)\[(accordion-item)\b(.*?)(?:(\/))?\](?:(.+?)\[\/accordion-item\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} 
	else {
		$output = '';
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
						
			$output .= '<div class="accordion-title"><a href="#">' . $matches[3][$i]['title'] . '</a></div><div class="accordion-inner">' . do_shortcode(trim($matches[5][$i])) .'</div>';
		}
		return '<h3 class="accordion_h3">'.$title.'</h3><div class="accordion" rel="'.$open.'">' . $output . '</div>';
		
	}	
}

// [container]
function shortcode_container($params = array(), $content = null) {
	
	$content = do_shortcode($content);
	$container = '		
		<div class="shortcode_container">'.$content.'<div class="clr"></div></div>';
	return $container;
}

// [banner_simple]
function banner_simple($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'title' => 'Title',
		'subtitle' => 'Subtitle',
		'link_url' => '',
		'new_tab'  => '',
		'title_color' => '#fff',
		'subtitle_color' => '#fff',
		'border_color' => '#000',
		'inner_stroke' => '2px',
		'inner_stroke_color' => '#fff',
		'bg_color' => '#000',
		'bg_image' => '',
		'h_padding' => '20px',
		'v_padding' => '20px',
		'sep_padding' => '5px',
		'sep_color' => '#fff',
		'with_bullet' => 'no',
		'bullet_text' => '',
		'bullet_bg_color' => '',
		'bullet_text_color' => ''
	), $params));
	
	if (is_numeric($bg_image)) {
		$bg_image = wp_get_attachment_url($bg_image);
	}

	if ($new_tab == 'true')
	{
		$link_tab = 'onclick="window.open(\''.$link_url.'\', \'_blank\');"';
	}
	else 
	{
		$link_tab = 'onclick="location.href=\''.$link_url.'\';"';
	}
	
	$content = do_shortcode($content);
	$banner_simple = '
		<div class="shortcode_banner_simple" '.$link_tab.' style="background-color:'.$border_color.'; background-image:url('.$bg_image.')">
			<div class="shortcode_banner_simple_inside" style="padding:'.$v_padding.' '.$h_padding.'; background-color:'.$bg_color.'; border: '.$inner_stroke.'px solid '.$inner_stroke_color.'">
				<div><h3 style="color:'.$title_color.' !important">'.$title.'</h3></div>
				<div class="shortcode_banner_simple_sep" style="margin:'.$sep_padding.' auto; background-color:'.$sep_color.';"></div>
				<div><h4 style="color:'.$subtitle_color.' !important">'.$subtitle.'</h4></div>
			</div>';
	if ($with_bullet == 'yes') {
		$banner_simple .= '<div class="shortcode_banner_simple_bullet" style="background:'.$bullet_bg_color.'; color:'.$bullet_text_color.'"><span>'.$bullet_text.'</span></div>';
	}
	$banner_simple .= '</div>';
	return $banner_simple;
}


// [banner_simple_height]
function banner_simple_height($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'title' => 'Title',
		'subtitle' => 'Subtitle',
		'link_url' => '',
		'new_tab'  => '',
		'title_color' => '#fff',
		'subtitle_color' => '#fff',
		'inner_stroke' => '2px',
		'inner_stroke_color' => '#fff',
		'bg_color' => '#000',
		'bg_image' => '',
		'height' => 'auto',
		'sep_padding' => '5px',
		'sep_color' => '#fff',
		'with_bullet' => 'no',
		'bullet_text' => '',
		'bullet_bg_color' => '',
		'bullet_text_color' => ''
	), $params));
	
	$banner_with_img = '';
	if (is_numeric($bg_image)) {
		$bg_image = wp_get_attachment_url($bg_image);
		$banner_with_img = 'banner_with_img';
	}

	if ($new_tab == 'true')
	{
		$link_tab = 'onclick="window.open(\''.$link_url.'\', \'_blank\');"';
	}
	else 
	{
		$link_tab = 'onclick="location.href=\''.$link_url.'\';"';
	}
	
	$content = do_shortcode($content);
	$banner_simple_height = '
		<div class="shortcode_banner_simple_height '.$banner_with_img.'" '.$link_tab.'>
			<div class="shortcode_banner_simple_height_inner">
				<div class="shortcode_banner_simple_height_bkg" style="background-color:'.$bg_color.'; background-image:url('.$bg_image.')"></div>
			
				<div class="shortcode_banner_simple_height_inside" style="height:'.$height.'; border: '.$inner_stroke.'px solid '.$inner_stroke_color.'">
					<div class="shortcode_banner_simple_height_content">
						<div><h3 style="color:'.$title_color.' !important">'.$title.'</h3></div>
						<div class="shortcode_banner_simple_height_sep" style="margin:'.$sep_padding.' auto; background-color:'.$sep_color.';"></div>
						<div><h4 style="color:'.$subtitle_color.' !important">'.$subtitle.'</h4></div>
					</div>
				</div>
			</div>';
	if ($with_bullet == 'yes') {
		$banner_simple_height .= '<div class="shortcode_banner_simple_height_bullet" style="background:'.$bullet_bg_color.'; color:'.$bullet_text_color.'"><span>'.$bullet_text.'</span></div>';
	}
	$banner_simple_height .= '</div>';
	return $banner_simple_height;
}


// [custom_featured_products]
function shortcode_custom_featured_products($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" => '',
		'per_page'  => '12',
        'orderby' => 'date',
        'order' => 'desc'
	), $atts));
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if (class_exists('WooCommerce')) {
	?>  
    
	<script>
	jQuery(document).ready(function($) {
		
		var featured_products_slider = $("#featured-products-<?php echo $sliderrandomid ?>");
		
		if ( $(".gbtr_items_slider_id_<?php echo $sliderrandomid ?>").parents('.wpb_column').hasClass('vc_span6') ) {
			
			featured_products_slider.owlCarousel({
				items:2,
				itemsDesktop : false,
				itemsDesktopSmall :false,
				itemsTablet: false,
				itemsMobile : false,
				lazyLoad : true,
				/*autoHeight : true,*/
		
			});
			
		} else {
		
			featured_products_slider.owlCarousel({
				items:4,
				itemsDesktop : false,
				itemsDesktopSmall :false,
				itemsTablet: [770,3],
				itemsMobile : [480,2],
				lazyLoad : true,
				/*autoHeight : true,*/
		
			});
		}
	
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_left',function(){ 
			featured_products_slider.trigger('owl.prev');
		})
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_right',function(){ 
			featured_products_slider.trigger('owl.next');
		})
	
	});
	</script>
	
    <div class="slider-master-wrapper featured-products-wrapper gbtr_items_slider_id_<?php echo $sliderrandomid ?> <?php if ( $title=='' ) echo 'slider-without-title'?>">
    
        <div class="gbtr_items_sliders_header">
            <div class="gbtr_items_sliders_title">
                <div class="gbtr_featured_section_title"><strong><?php echo $title ?></strong></div>
            </div>
            <div class="gbtr_items_sliders_nav">                        
                <a class='big_arrow_right'></a>
                <a class='big_arrow_left'></a>
                <div class='clr'></div>
            </div>
        </div>
    
        <div class="gbtr_bold_sep"></div>   
    
        <div class="slider-wrapper">
			<div class="slider" id="featured-products-<?php echo $sliderrandomid ?>">
				<?php
		
				$args = array(
					'post_status' => 'publish',
					'post_type' => 'product',
					'ignore_sticky_posts'   => 1,
					'meta_key' => '_featured',
					'meta_value' => 'yes',
					'posts_per_page' => $per_page,
					'orderby' => $orderby,
					'order' => $order,
				);
				
				$products = new WP_Query( $args );
				
				if ( $products->have_posts() ) : ?>
							
					<?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    	<ul><?php woocommerce_get_template_part( 'content', 'product' ); ?></ul>
					<?php endwhile; // end of the loop. ?>
					
				<?php
				
				endif; 
				
				?>
			</div><!--.slider-->
		</div><!--.slider-wrapper-->
    
    </div>
    
    <?php } ?>

	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


// [custom_on_sale_products]
function shortcode_custom_on_sale_products($atts, $content = null) {
	global $woocommerce;
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" => '',
		'per_page'  => '12',
        'orderby' => 'date',
        'order' => 'desc'
	), $atts));
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if (class_exists('WooCommerce')) {
	?>
    
	<script>
	jQuery(document).ready(function($) {
		
		var on_sale_products_slider = $("#products-on-sale-<?php echo $sliderrandomid ?>");
		
		if ( $(".gbtr_items_slider_id_<?php echo $sliderrandomid ?>").parents('.wpb_column').hasClass('vc_span6') ) {
			
			on_sale_products_slider.owlCarousel({
				items:2,
				itemsDesktop : false,
				itemsDesktopSmall :false,
				itemsTablet: false,
				itemsMobile : false,
				lazyLoad : true,
				/*autoHeight : true,*/
		
			});
			
		} else {
		
			on_sale_products_slider.owlCarousel({
				items:4,
				itemsDesktop : false,
				itemsDesktopSmall :false,
				itemsTablet: [770,3],
				itemsMobile : [480,2],
				lazyLoad : true,
				/*autoHeight : true,*/
			});
			
		}
		
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_left',function(){ 
			on_sale_products_slider.trigger('owl.prev');
		})
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_right',function(){ 
			on_sale_products_slider.trigger('owl.next');
		})
		
	});
	</script>
    
    <div class="slider-master-wrapper on_sale_products_wrapper gbtr_items_slider_id_<?php echo $sliderrandomid ?> <?php if ( $title=='' ) echo 'slider-without-title'?>">
    
        <div class="gbtr_items_sliders_header">
            <div class="gbtr_items_sliders_title">
                <div class="gbtr_featured_section_title"><strong><?php echo $title ?></strong></div>
            </div>
            <div class="gbtr_items_sliders_nav">                        
                <a class='big_arrow_right'></a>
                <a class='big_arrow_left'></a>
                <div class='clr'></div>
            </div>
        </div>
    
        <div class="gbtr_bold_sep"></div>   
    
        <div class="slider-wrapper">
			<div class="slider" id="products-on-sale-<?php echo $sliderrandomid ?>">
                    <?php
            
                    /*$args = array(
                        'post_type' => 'product',
						'post_status' => 'publish',
						'ignore_sticky_posts'   => 1,
						'posts_per_page' => $per_page,
						'orderby' => $orderby,
						'order' => $order,
						'meta_query' => array(
							array(
								'key' => '_visibility',
								'value' => array('catalog', 'visible'),
								'compare' => 'IN'
							),
							array(
								'key' => '_sale_price',
								'value' =>  0,
								'compare'   => '>',
								'type'      => 'NUMERIC'
							)
						)
                    );*/
					
					// Get products on sale
					$product_ids_on_sale = woocommerce_get_product_ids_on_sale();
					$product_ids_on_sale[] = 0;
					
					$meta_query = $woocommerce->query->get_meta_query();
					
					$args = array(
						'posts_per_page' 	=> $per_page,
						'no_found_rows' => 1,
						'post_status' 	=> 'publish',
						'post_type' 	=> 'product',
						'orderby' 		=> 'date',
						'order' 		=> 'ASC',
						'meta_query' 	=> $meta_query,
						'post__in'		=> $product_ids_on_sale
					);
                    
                    $products = new WP_Query( $args );
                    
                    if ( $products->have_posts() ) : ?>
                                
                        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    
                            <ul><?php woocommerce_get_template_part( 'content', 'product' ); ?></ul>
                
                        <?php endwhile; // end of the loop. ?>
                        
                    <?php
                    
                    endif; 
                    
                    ?>
             	</div><!--.slider-->
		</div><!--.slider-wrapper-->
    
    </div>
    
    <?php } ?>

	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


// [custom_latest_products]
function shortcode_custom_latest_products($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" => '',
		'per_page'  => '12',
        'orderby' => 'date',
        'order' => 'desc'
	), $atts));
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if (class_exists('WooCommerce')) {
	?>
    
	<script>
	jQuery(document).ready(function($) {
		
		var latest_products_slider = $("#latest-products-<?php echo $sliderrandomid ?>");
		
		if ( $(".gbtr_items_slider_id_<?php echo $sliderrandomid ?>").parents('.wpb_column').hasClass('vc_span6') ) {
			
			latest_products_slider.owlCarousel({
				items:2,
				itemsDesktop : false,
				itemsDesktopSmall :false,
				itemsTablet: false,
				itemsMobile : false,
				lazyLoad : true,
				/*autoHeight : true,*/
		
			});
			
		} else {
		
			latest_products_slider.owlCarousel({
				items:4,
				itemsDesktop : false,
				itemsDesktopSmall :false,
				itemsTablet: [770,3],
				itemsMobile : [480,2],
				lazyLoad : true,
				/*autoHeight : true,*/
			});
		}
		
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_left',function(){ 
			latest_products_slider.trigger('owl.prev');
		})
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_right',function(){ 
			latest_products_slider.trigger('owl.next');
		})
		
	});
	</script>
    
    <div class="slider-master-wrapper latest-products-wrapper gbtr_items_slider_id_<?php echo $sliderrandomid ?> <?php if ( $title=='' ) echo 'slider-without-title'?>">
    
        <div class="gbtr_items_sliders_header">
            <div class="gbtr_items_sliders_title">
                <div class="gbtr_featured_section_title"><strong><?php echo $title ?></strong></div>
            </div>
            <div class="gbtr_items_sliders_nav">                        
                <a class='big_arrow_right'></a>
                <a class='big_arrow_left'></a>
                <div class='clr'></div>
            </div>
        </div>
    
        <div class="gbtr_bold_sep"></div>   
    
        <div class="slider-wrapper">
			<div class="slider" id="latest-products-<?php echo $sliderrandomid ?>">
                    <?php
            
                    $args = array(
                        'post_type' => 'product',
						'post_status' => 'publish',
						'ignore_sticky_posts'   => 1,
						'posts_per_page' => $per_page
                    );
                    
                    $products = new WP_Query( $args );
                    
                    if ( $products->have_posts() ) : ?>
                                
                        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    
                            <ul><?php woocommerce_get_template_part( 'content', 'product' ); ?></ul>
                
                        <?php endwhile; // end of the loop. ?>
                        
                    <?php
                    
                    endif;
                    
                    ?>
            	</div><!--.slider-->
		</div><!--.slider-wrapper-->
    
    </div>
    
    <?php } ?>

	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


// [products_by_category]
function shortcode_products_by_category($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" => '',
		'per_page'  => '12',
        'orderby' => 'date',
        'order' => 'desc',
		'category' => ''
	), $atts));
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if (class_exists('WooCommerce')) {
	?>
    
	<script>
	jQuery(document).ready(function($) {
		
		var products_by_category_slider = $("#products-by-category-<?php echo $sliderrandomid ?>");
		
		if ( $(".gbtr_items_slider_id_<?php echo $sliderrandomid ?>").parents('.wpb_column').hasClass('vc_span6') ) {
			
			products_by_category_slider.owlCarousel({
				items:2,
				itemsDesktop : false,
				itemsDesktopSmall :false,
				itemsTablet: false,
				itemsMobile : false,
				lazyLoad : true,
				/*autoHeight : true,*/
		
			});
			
		} else {
		
			products_by_category_slider.owlCarousel({
				items:4,
				itemsDesktop : false,
				itemsDesktopSmall :false,
				itemsTablet: [770,3],
				itemsMobile : [480,2],
				lazyLoad : true,
				/*autoHeight : true,*/
			});
		
		}
		
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_left',function(){ 
			products_by_category_slider.trigger('owl.prev');
		})
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_right',function(){ 
			products_by_category_slider.trigger('owl.next');
		})
		
	});
	</script>
    
    <div class="slider-master-wrapper products-by-category-wrapper gbtr_items_slider_id_<?php echo $sliderrandomid ?> <?php if ( $title=='' ) echo 'slider-without-title'?>">
    
        <div class="gbtr_items_sliders_header">
            <div class="gbtr_items_sliders_title">
                <div class="gbtr_featured_section_title"><strong><?php echo $title ?></strong></div>
            </div>
            <div class="gbtr_items_sliders_nav">                        
                <a class='big_arrow_right'></a>
                <a class='big_arrow_left'></a>
                <div class='clr'></div>
            </div>
        </div>
    
        <div class="gbtr_bold_sep"></div>   
    
        <div class="slider-wrapper">
			<div class="slider" id="products-by-category-<?php echo $sliderrandomid ?>">
                    <?php
            
                    $args = array(
                        'post_type' => 'product',
						'post_status' => 'publish',
						'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'field' => 'slug',
								'terms' => $category
							)
						),
						'ignore_sticky_posts'   => 1,
						'posts_per_page' => $per_page
                    );
                    
                    $products = new WP_Query($args);
                    
                    if ( $products->have_posts() ) : ?>
                                
                        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    
                            <ul><?php woocommerce_get_template_part( 'content', 'product' ); ?></ul>
                
                        <?php endwhile; // end of the loop. ?>
                        
                    <?php
                    
                    endif; 
                    
                    ?>
            </div><!--.slider-->
		</div><!--.slider-wrapper-->
    
    </div>
    
    <?php } ?>

	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


// [custom_best_sellers]
function shortcode_custom_best_sellers($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" => '',
		'per_page'  => '12',
        'orderby' => 'date',
        'order' => 'desc'
	), $atts));
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if (class_exists('WooCommerce')) {
	?>
    
    <script>
	jQuery(document).ready(function($) {
		
		var best_sellers_slider = $("#best-sellers-<?php echo $sliderrandomid ?>")
		
		if ( $(".gbtr_items_slider_id_<?php echo $sliderrandomid ?>").parents('.wpb_column').hasClass('vc_span6') ) {
			
			best_sellers_slider.owlCarousel({
				items:2,
				itemsDesktop : false,
				itemsDesktopSmall :false,
				itemsTablet: false,
				itemsMobile : false,
				lazyLoad : true,
				/*autoHeight : true,*/
		
			});
			
		} else {
		
			best_sellers_slider.owlCarousel({
				items:4,
				itemsDesktop : false,
				itemsDesktopSmall :false,
				itemsTablet: [770,3],
				itemsMobile : [480,2],
				lazyLoad : true,
				/*autoHeight : true,*/
			});
			
		}	
		
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_left',function(){ 
			best_sellers_slider.trigger('owl.prev');
		})
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_right',function(){ 
			best_sellers_slider.trigger('owl.next');
		})
		
	});
	</script>
    
    <div class="slider-master-wrapper best-sellers-wrapper gbtr_items_slider_id_<?php echo $sliderrandomid ?> <?php if ( $title=='' ) echo 'slider-without-title'?>">
    
        <div class="gbtr_items_sliders_header">
            <div class="gbtr_items_sliders_title">
                <div class="gbtr_featured_section_title"><strong><?php echo $title ?></strong></div>
            </div>
            <div class="gbtr_items_sliders_nav">                        
                <a class='big_arrow_right'></a>
                <a class='big_arrow_left'></a>
                <div class='clr'></div>
            </div>
        </div>
    
        <div class="gbtr_bold_sep"></div>   
    
       <div class="slider-wrapper">
			<div class="slider" id="best-sellers-<?php echo $sliderrandomid ?>">
                    <?php
					
					$args = array(
						'post_type' 			=> 'product',
						'post_status' 			=> 'publish',
						'ignore_sticky_posts'   => 1,
						'posts_per_page'		=> $per_page,
						'meta_key' 		 		=> 'total_sales',
						'orderby' 		 		=> 'meta_value_num',
						'meta_query' 			=> array(
							array(
								'key' 		=> '_visibility',
								'value' 	=> array( 'catalog', 'visible' ),
								'compare' 	=> 'IN'
							)
						)
					);
                    
                    $products = new WP_Query( $args );
                    
                    if ( $products->have_posts() ) : ?>
                                
                        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    
                            <ul><?php woocommerce_get_template_part( 'content', 'product' ); ?></ul>
                
                        <?php endwhile; // end of the loop. ?>
                        
                    <?php
                    
                    endif; 
                    
                    ?>
             </div><!--.slider-->
		</div><!--.slider-wrapper-->
    
    </div>
    
    <?php } ?>

	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


// [custom_products]
function shortcode_custom_products($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" => '',
        'orderby' => 'date',
        'order' => 'desc'
	), $atts));
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if (class_exists('WooCommerce')) {
	?>
    
	<script>
	jQuery(document).ready(function($) {
		
		var custom_products_slider = $("#custom-products-<?php echo $sliderrandomid ?>");
		
		if ( $(".gbtr_items_slider_id_<?php echo $sliderrandomid ?>").parents('.wpb_column').hasClass('vc_span6') ) {
			
			custom_products_slider.owlCarousel({
				items:2,
				itemsDesktop : false,
				itemsDesktopSmall :false,
				itemsTablet: false,
				itemsMobile : false,
				lazyLoad : true,
				/*autoHeight : true,*/
		
			});
			
		} else {
		
			custom_products_slider.owlCarousel({
				items:4,
				itemsDesktop : false,
				itemsDesktopSmall :false,
				itemsTablet: [770,3],
				itemsMobile : [480,2],
				lazyLoad : true,
				/*autoHeight : true,*/
			});
		
		}
		
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_left',function(){ 
			custom_products_slider.trigger('owl.prev');
		})
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_right',function(){ 
			custom_products_slider.trigger('owl.next');
		})
		
	});
	</script>
    
    <div class="slider-master-wrapper custom-products-wrapper gbtr_items_slider_id_<?php echo $sliderrandomid ?> <?php if ( $title=='' ) echo 'slider-without-title'?>">
    
        <div class="gbtr_items_sliders_header">
            <div class="gbtr_items_sliders_title">
                <div class="gbtr_featured_section_title"><strong><?php echo $title ?></strong></div>
            </div>
            <div class="gbtr_items_sliders_nav">                        
                <a class='big_arrow_right'></a>
                <a class='big_arrow_left'></a>
                <div class='clr'></div>
            </div>
        </div>
    
        <div class="gbtr_bold_sep"></div>   
    
        <div class="slider-wrapper">
			<div class="slider" id="custom-products-<?php echo $sliderrandomid ?>">
                    <?php
            
                    $args = array(
						'post_type'				=> 'product',
						'post_status' 			=> 'publish',
						'ignore_sticky_posts'	=> 1,
						'orderby' 				=> $orderby,
						'order' 				=> $order,
						'posts_per_page' 		=> -1,
						'meta_query' 			=> array(
							array(
								'key' 		=> '_visibility',
								'value' 	=> array('catalog', 'visible'),
								'compare' 	=> 'IN'
							)
						)
					);
			
					if ( isset( $atts['ids'] ) ) {
						$ids = explode( ',', $atts['ids'] );
						$ids = array_map( 'trim', $ids );
						$args['post__in'] = $ids;
					}
                    
                    $products = new WP_Query($args);
                    
                    if ( $products->have_posts() ) : ?>
                                
                        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    
                            <ul><?php woocommerce_get_template_part( 'content', 'product' ); ?></ul>
                
                        <?php endwhile; // end of the loop. ?>
                        
                    <?php
                    
                    endif; 
                    
                    ?>
            </div><!--.slider-->
		</div><!--.slider-wrapper-->
    
    </div>
    
    <?php } ?>

	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}



// [custom_product_attribute]
function shortcode_custom_product_attribute($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		'title'  => '',
		'per_page'  => '12',
		'orderby'   => 'title',
		'order'     => 'asc',
		'attribute' => '',
		'filter'    => ''
	), $atts));
	
	$attribute 	= strstr( $attribute, 'pa_' ) ? sanitize_title( $attribute ) : 'pa_' . sanitize_title( $attribute );

	$args = array(
		'post_type'           => 'product',
		'post_status'         => 'publish',
		'ignore_sticky_posts' => 1,
		'posts_per_page'      => $per_page,
		'orderby'             => $orderby,
		'order'               => $order,
		'meta_query'          => array(
			array(
				'key'               => '_visibility',
				'value'             => array('catalog', 'visible'),
				'compare'           => 'IN'
			)
		),
		'tax_query' 			=> array(
			array(
				'taxonomy' 	=> $attribute,
				'terms'     => array_map( 'sanitize_title', explode( ",", $filter ) ),
				'field' 	=> 'slug'
			)
		)
	);	
	
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if (class_exists('WooCommerce')) {
	?>
    
	<script>
	jQuery(document).ready(function($) {
		
		var custom_products_slider = $("#custom-products-<?php echo $sliderrandomid ?>");
		
		if ( $(".gbtr_items_slider_id_<?php echo $sliderrandomid ?>").parents('.wpb_column').hasClass('vc_span6') ) {
			
			custom_products_slider.owlCarousel({
				items:2,
				itemsDesktop : false,
				itemsDesktopSmall :false,
				itemsTablet: false,
				itemsMobile : false,
				lazyLoad : true,
				/*autoHeight : true,*/
		
			});
			
		} else {
		
			custom_products_slider.owlCarousel({
				items:4,
				itemsDesktop : false,
				itemsDesktopSmall :false,
				itemsTablet: [770,3],
				itemsMobile : [480,2],
				lazyLoad : true,
				/*autoHeight : true,*/
			});
		
		}
		
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_left',function(){ 
			custom_products_slider.trigger('owl.prev');
		})
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_right',function(){ 
			custom_products_slider.trigger('owl.next');
		})
		
	});
	</script>
    
    <div class="slider-master-wrapper custom-products-wrapper gbtr_items_slider_id_<?php echo $sliderrandomid ?> <?php if ( $title=='' ) echo 'slider-without-title'?>">
    
        <div class="gbtr_items_sliders_header">
            <div class="gbtr_items_sliders_title">
                <div class="gbtr_featured_section_title"><strong><?php echo $title ?></strong></div>
            </div>
            <div class="gbtr_items_sliders_nav">                        
                <a class='big_arrow_right'></a>
                <a class='big_arrow_left'></a>
                <div class='clr'></div>
            </div>
        </div>
    
        <div class="gbtr_bold_sep"></div>   
    
        <div class="slider-wrapper">
			<div class="slider" id="custom-products-<?php echo $sliderrandomid ?>">
                    <?php
            
                    $products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );
                    
                    if ( $products->have_posts() ) : ?>
                                
                        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    
                            <ul><?php woocommerce_get_template_part( 'content', 'product' ); ?></ul>
                
                        <?php endwhile; // end of the loop. ?>
                        
                    <?php
                    
                    endif; 
                    
                    ?>
            </div><!--.slider-->
		</div><!--.slider-wrapper-->
    
    </div>
    
    <?php } ?>

	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}



// [custom_top_rated_products]
function shortcode_custom_top_rated_products($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		'title'  => '',
		'per_page'  => '12',
		'orderby'   => 'title',
		'order'     => 'asc',
	), $atts));

	$args = array(
		'post_type' 			=> 'product',
		'post_status' 			=> 'publish',
		'ignore_sticky_posts'   => 1,
		'orderby' 				=> $orderby,
		'order'					=> $order,
		'posts_per_page' 		=> $per_page,
		'meta_query' 			=> array(
			array(
				'key' 			=> '_visibility',
				'value' 		=> array('catalog', 'visible'),
				'compare' 		=> 'IN'
			)
		)
	);
	
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if (class_exists('WooCommerce')) {
	?>
    
	<script>
	jQuery(document).ready(function($) {
		
		var custom_products_slider = $("#custom-products-<?php echo $sliderrandomid ?>");
		
		custom_products_slider.owlCarousel({
			items:4,
			itemsDesktop : false,
			itemsDesktopSmall :false,
			itemsTablet: [770,3],
			itemsMobile : [480,2],
			lazyLoad : true,
			/*autoHeight : true,*/
		});
		
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_left',function(){ 
			custom_products_slider.trigger('owl.prev');
		})
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_right',function(){ 
			custom_products_slider.trigger('owl.next');
		})
		
	});
	</script>
    
    <div class="custom-products-wrapper gbtr_items_slider_id_<?php echo $sliderrandomid ?> <?php if ( $title=='' ) echo 'slider-without-title'?>">
    
        <div class="gbtr_items_sliders_header">
            <div class="gbtr_items_sliders_title">
                <div class="gbtr_featured_section_title"><strong><?php echo $title ?></strong></div>
            </div>
            <div class="gbtr_items_sliders_nav">                        
                <a class='big_arrow_right'></a>
                <a class='big_arrow_left'></a>
                <div class='clr'></div>
            </div>
        </div>
    
        <div class="gbtr_bold_sep"></div>   
    
        <div class="slider-wrapper">
			<div class="slider" id="custom-products-<?php echo $sliderrandomid ?>">
                    <?php
            
                    add_filter( 'posts_clauses', array( 'WC_Shortcodes', 'order_by_rating_post_clauses' ) );

					$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );
			
					remove_filter( 'posts_clauses', array( 'WC_Shortcodes', 'order_by_rating_post_clauses' ) );
                    
                    if ( $products->have_posts() ) : ?>
                                
                        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    
                            <ul><?php woocommerce_get_template_part( 'content', 'product' ); ?></ul>
                
                        <?php endwhile; // end of the loop. ?>
                        
                    <?php
                    
                    endif; 
                    
                    ?>
            </div><!--.slider-->
		</div><!--.slider-wrapper-->
    
    </div>
    
    <?php } ?>

	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


function string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit) {
		array_pop($words);
		return implode(' ', $words) . '...';
	} else {
		return $string;
	}
}

// [from_the_blog]
function shortcode_from_the_blog($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" => 'From The Blog',
		"posts" => '2',
		"category" => ''
	), $atts));
	ob_start();
	?> 
    
	<script>
	jQuery(document).ready(function($) {
		
		var from_the_blog_slider = $("#from-the-blog-<?php echo $sliderrandomid ?>");
		
		from_the_blog_slider.owlCarousel({
			items:2,
			itemsDesktop : false,
			itemsDesktopSmall :false,
			itemsTablet: false,
			itemsTabletSmall:false,
			itemsMobile : [480,1],
			lazyLoad : true,
			/*autoHeight : true,*/
		});
		
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_left',function(){ 
			from_the_blog_slider.trigger('owl.prev');
		})
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.big_arrow_right',function(){ 
			from_the_blog_slider.trigger('owl.next');
		})
		
	});
	</script>
    
    <div class="from-the-blog-section gbtr_items_slider_id_<?php echo $sliderrandomid ?> <?php if ( $title=='' ) echo 'slider-without-title'?>">
    
        <div class="gbtr_items_sliders_header">
            <div class="gbtr_items_sliders_title">
                <div class="gbtr_featured_section_title"><strong><?php echo $title ?></strong></div>
            </div>
            <div class="gbtr_items_sliders_nav">                        
                <a class='big_arrow_right'></a>
                <a class='big_arrow_left'></a>
                <div class='clr'></div>
            </div>
        </div>
    
        <div class="gbtr_bold_sep"></div>   
    
        <div class="slider-wrapper from-the-blog-wrapper">
			<div class="slider" id="from-the-blog-<?php echo $sliderrandomid ?>">
					
					<?php
            
                    $args = array(
                        'post_status' => 'publish',
                        'post_type' => 'post',
						'category_name' => $category,
                        'posts_per_page' => $posts
                    );
                    
                    $recentPosts = new WP_Query( $args );
                    
                    if ( $recentPosts->have_posts() ) : ?>
                                
                        <?php while ( $recentPosts->have_posts() ) : $recentPosts->the_post(); ?>
                    
                            <?php $post_format = get_post_format(get_the_ID()); ?>
                            
                            <ul>
                            <li class="from_the_blog_item <?php echo $post_format; ?> <?php if ( !has_post_thumbnail()) : ?>no_thumb<?php endif; ?>">
                                
                                <a class="from_the_blog_img img_zoom_in" href="<?php the_permalink() ?>">
                                    <?php if ( has_post_thumbnail()) : ?>
                                    	<?php the_post_thumbnail('recent_posts_shortcode') ?>
                                    <?php else : ?>
                                    	<span class="from_the_blog_noimg"></span>
                                    <?php endif; ?>
                                    <span class="from_the_blog_date">
										<span class="from_the_blog_date_day"><?php echo get_the_time('d', get_the_ID()); ?></span>
                                        <span class="from_the_blog_date_month"><?php echo get_the_time('M', get_the_ID()); ?></span>
                                    </span>
                                    <?php if ($post_format != "") : ?>
                                    <span class="post_format_icon"></span>
                                    <?php endif ?>
                                </a>
                                
                                <div class="from_the_blog_content">
                                
                                    <?php if ( ($post_format == "") || ($post_format == "video") ) : ?>
                                    	<a class="from_the_blog_title" href="<?php the_permalink() ?>"><h3><?php echo string_limit_words(get_the_title(), 5); ?></h3></a>
                                    <?php endif ?>	
                                                                
                                    <div class="from_the_blog_excerpt">
										<?php											
											$limit_words = 12;
											if ( ($post_format == "status") || ($post_format == "quote") || ($post_format == "aside") ) {
												$limit_words = 40;
											}
											$excerpt = get_the_excerpt();
                                            echo string_limit_words($excerpt, $limit_words);
                                        ?>
                                    </div>

                                    <?php if ( ($post_format == "") || ($post_format == "quote") || ($post_format == "video") || ($post_format == "image") || ($post_format == "audio") || ($post_format == "gallery") ) : ?>
                                    	<div class="from_the_blog_comments">
											<?php comments_popup_link( __( 'Leave a comment', 'theretailer' ), __( '1 Comment', 'theretailer' ), __( '% Comments', 'theretailer' ), '', '' ); ?>
                                        </div>
                                    <?php endif ?>
                                
                                </div>
                                
                            </li>
                            </ul>
                
                        <?php endwhile; // end of the loop. ?>
                        
                    <?php

                    endif;
                    
                    ?>
            </div><!--.slider-->
		</div><!--.slider-wrapper-->
    
    </div>

	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

// [from_the_portfolio]
function shortcode_from_the_portfolio($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"posts" => '4'
	), $atts));
	ob_start();
	?> 

    <div class="from_the_portfolio">

            <?php
    
            $args = array(
                'post_status' => 'publish',
                'post_type' => 'portfolio',
                'posts_per_page' => $posts
            );
            
            $recentPosts = new WP_Query( $args );
            
            if ( $recentPosts->have_posts() ) : ?>
                        
                <?php while ( $recentPosts->have_posts() ) : $recentPosts->the_post(); ?>
            
                    <div class="from_the_portfolio_item">
                        <a class="from_the_portfolio_img" href="<?php the_permalink() ?>">
                            <?php if ( has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('portfolio_4_col') ?>
                            <?php else : ?>
                            <span class="from_the_portfolio_noimg"></span>
                            <?php endif; ?>
                        </a>
                        
                        <a class="from_the_portfolio_title" href="<?php the_permalink() ?>"><h3><?php the_title(); ?></h3></a>
                        
                        <div class="portfolio_sep"></div>	
                                                    
                        <div class="from_the_portfolio_cats">
                            <?php 
                            echo strip_tags (
                                get_the_term_list( get_the_ID(), 'portfolio_filter', "",", " )
                            );
                            ?>
                        </div>
                    </div>
        
                <?php endwhile; // end of the loop. ?>
                
                <div class="clr"></div>
                
            <?php

            endif;
            
            ?>   
    </div>


	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

// [recent_work_filtered]
function shortcode_recent_work_filtered($atts, $content = null) {
	global $theretailer_theme_options;
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"items_per_row" => '4'
	), $atts));
	ob_start();
	?> 

                
	<?php
    
    $terms = get_terms("portfolio_filter");
    if ( !empty( $terms ) && !is_wp_error( $terms ) ){
        echo '<ul class="portfolio_categories">';
            echo '<li class="filter" data-filter="all">' . __("All", "theretailer") . '</li>';
        foreach ( $terms as $term ) {
            echo '<li class="filter" data-filter=".' . strtolower($term->slug) . '">' . $term->name . '</li>';
        }
        echo '</ul>';
    }
    
    ?>

    <div class="portfolio_section shortcode_portfolio">		
            
        <div class="items_wrapper">
        
        <?php
        
        $number_of_portfolio_items = new WP_Query(array(
            'post_type' => 'portfolio',
            'posts_per_page' => 99999,
        ));
        
        $portfolio_items = $number_of_portfolio_items->post_count;

        $post_counter = 0;
        
        if ((isset($theretailer_theme_options['portfolio_items_per_page'])) && ($theretailer_theme_options['portfolio_items_per_page'] != "0")) {
            $posts_per_page = $theretailer_theme_options['portfolio_items_per_page'];
        } else {
            $posts_per_page = 99999;
        }

        $orderby = 'date';
        $order = 'DESC';

        if ( isset($theretailer_theme_options['portfolio_items_order_by']) && ($theretailer_theme_options['portfolio_items_order_by'] !== "") ) {
	        $orderby = strtolower($theretailer_theme_options['portfolio_items_order_by']);
    	}

    	if ( isset($theretailer_theme_options['portfolio_items_order']) && ($theretailer_theme_options['portfolio_items_order'] !== "") ) {
	        $order = $theretailer_theme_options['portfolio_items_order'];
    	}
        
        $wp_query_portfolio_shortcode = new WP_Query(array(
            'post_type' => 'portfolio',
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby,
            'order' => $order
        ));
                        
        while ($wp_query_portfolio_shortcode->have_posts()) : $wp_query_portfolio_shortcode->the_post();
            $post_counter++;
            $related_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
            
            $terms_slug = get_the_terms( get_the_ID(), 'portfolio_filter' ); // get an array of all the terms as objects.

            $term_slug_class = "";
            
            if ( !empty( $terms_slug ) && !is_wp_error( $terms_slug ) ){
                foreach ( $terms_slug as $term_slug ) {
                    $term_slug_class .=  $term_slug->slug . " ";
                }
            }
            
        ?>

            <div class="portfolio_<?php echo $items_per_row; ?>_col_item_wrapper mix <?php echo $term_slug_class; ?>">
                <div class="portfolio_item">
                    <div class="portfolio_item_img_container">
                        <a class="img_zoom_in" href="<?php echo get_permalink(get_the_ID()); ?>">
                            <img src="<?php echo $related_thumb[0]; ?>" alt="" />
                        </a>
                    </div>
                    <a  class="portfolio-title" href="<?php echo get_permalink(get_the_ID()); ?>"><h3><?php the_title(); ?></h3></a>
                    <div class="portfolio_sep"></div>
                    <div class="portfolio_item_cat">

                    <?php 
                    echo strip_tags (
                        get_the_term_list( get_the_ID(), 'portfolio_filter', "",", " )
                    );
                    ?>
                    
                    </div>
                </div>
            </div>
        
        <?php endwhile; // end of the loop. ?>
        
        </div>
        
        <div class="clr"></div>
        
    </div><!-- #primary .content-area -->
    
	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

// [slide_everything]
function shortcode_slide_everything($atts, $content=null, $code) {
	$sliderrandomid = rand();
	ob_start();
	?> 
    
    <script>
	
	(function($){
		$(window).load(function(){
			
				/* items_slider */
				$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider').iosSlider({
					snapToChildren: true,
					desktopClickDrag: true,
					scrollbar: true,
					scrollbarHide: true,
					scrollbarLocation: 'bottom',
					scrollbarHeight: '2px',
					scrollbarBackground: '#ccc',
					scrollbarBorder: '0',
					scrollbarMargin: '0',
					scrollbarOpacity: '1',
					navNextSelector: $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .slide_everything_next'),
					navPrevSelector: $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .slide_everything_previous'),
					onSliderLoaded: update_height_slide_everything,
					onSlideChange: update_height_slide_everything,
					onSliderResize: update_height_slide_everything
				});
				
				function update_height_slide_everything(args) {
					
					/* update height of the first slider */
					
					setTimeout(function() {
						var setHeight = $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .slide_everything .slide_everything_item:eq(' + (args.currentSlideNumber-1) + ')').outerHeight(true);
						$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .slide_everything').css({ visibility: "visible" });
						$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .slide_everything').stop().animate({ height: setHeight+20 }, 300);
					},0);
					
				}
			
		})
	})(jQuery);

	</script>
    
    <div class="gbtr_items_slider_id_<?php echo $sliderrandomid ?> slide_everything">  
    
        <div class="gbtr_items_slider_wrapper">
            <div class="gbtr_items_slider slide_everything">
                <ul class="slider">
                    
                    <?php
                    if (!preg_match_all("/(.?)\[(slide)\b(.*?)(?:(\/))?\](?:(.+?)\[\/slide\])?(.?)/s", $content, $matches)) {
						return do_shortcode($content);
					} 
					else {
						$output = '';
						for($i = 0; $i < count($matches[0]); $i++) {
										
							$output .= '<li class="slide_everything_item">
											<div class="slide_everything_content">' . do_shortcode(trim($matches[5][$i])) .'</div>
										</li>';
						}
						echo $output;
						
					}
					?>

                </ul>
                                       
                <div class='slide_everything_previous'></div>
                <div class='slide_everything_next'></div>
                    
            </div>
        </div>
    
    </div>

	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}



// [products_slider]
function shortcode_products_slider($atts, $content=null, $code) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		'per_page'  => '12',
        'orderby' => 'date',
        'order' => 'desc'
	), $atts));
	ob_start();
	?> 
    
    <script>
	jQuery(document).ready(function($) {	
		
		var products_slider = $("#products-slider-<?php echo $sliderrandomid ?>");
		
		products_slider.owlCarousel({
			items:4,
			itemsDesktop : [1200,3],
			itemsDesktopSmall : [1000,2],
			itemsTablet: false,
			itemsMobile : [500,1],
			lazyLoad : true,
			/*autoHeight : true,*/
		});
		
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.products_slider_previous',function(){ 
			products_slider.trigger('owl.prev');
		})
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?>').on('click','.products_slider_next',function(){ 
			products_slider.trigger('owl.next');
		})
		
		$(".style_1 .products_slider_item").mouseenter(function(){
			
			var that = $(this);
			
			that.find('.products_slider_infos').stop().fadeTo(100, 0);
			that.find('.products_slider_images img').stop().fadeTo(100, 0.1, function() { 
				that.find('.products_slider_infos').stop().fadeTo(200, 1);
			});
			//alert("aaaaaaa");
		}).mouseleave(function(){
			$(this).find('.products_slider_images img').stop().fadeTo(100, 1);
			$(this).find('.products_slider_infos').stop().fadeTo(100, 0);
		});


	});	
	</script>
    
    <div class="gbtr_items_slider_id_<?php echo $sliderrandomid ?> products_slider">  
    
		<div class="slider-wrapper">
			<div class="slider style_1" id="products-slider-<?php echo $sliderrandomid ?>">
                    
                    <?php
            
					$args = array(
						'post_status' => 'publish',
						'post_type' => 'product',
						'ignore_sticky_posts'   => 1,
						'meta_key' => '_featured',
						'meta_value' => 'yes',
						'posts_per_page' => $per_page,
						'orderby' => $orderby,
						'order' => $order,
					);
					
					$products = new WP_Query( $args );
					
					if ( $products->have_posts() ) : ?>
								
						<?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    
                            <?php woocommerce_get_template_part( 'content', 'product-slider' ); ?>
                
                        <?php endwhile; // end of the loop. ?>
						
					<?php
					
					endif; 
					
					?>
                    
            </div>
        </div>
		 
		<div class='products_slider_previous'></div>
        <div class='products_slider_next'></div>
    
	</div>

	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


// [sourcecode]
function shortcode_sourcecode($params = array(), $content = null) {
	$content = preg_replace('#<br\s*/?>#', "", $content);
	$sourcecode = '<pre class="shortcode_sourcecode">'.$content.'</pre>';
	return $sourcecode;
}

// [code]
function shortcode_code($params = array(), $content = null) {
	$content = preg_replace('#<br\s*/?>#', "", $content);
	$code = '<span class="shortcode_code">'.$content.'</span>';
	return $code;
}

// [testimonial_left]
function shortcode_testimonial_left($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"image_url" => '',
		"name" => '',
		"company" => ''
	), $params));
	$content = preg_replace('#<br\s*/?>#', "", $content);
	$testimonial_left = '
	<div class="testimonial_left">
		<div class="testimonial_left_content">
			<div><span>'.$content.'</span></div>
		</div>
		<div class="testimonial_left_author">
			<img src="'.$image_url.'" alt="'.$name.'" />
			<h4>'.$name.'</h4>
			<h5>'.$company.'</h5>
		</div>
		<div class="clr"></div>
	</div>
	';
	return $testimonial_left;
}

// [testimonial_right]
function shortcode_testimonial_right($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"image_url" => '',
		"name" => '',
		"company" => ''
	), $params));
	$content = preg_replace('#<br\s*/?>#', "", $content);
	$testimonial_right = '
	<div class="testimonial_right">
		<div class="testimonial_right_content">
			<div><span>'.$content.'</span></div>
		</div>
		<div class="testimonial_right_author">
			<img src="'.$image_url.'" alt="'.$name.'" />
			<h4>'.$name.'</h4>
			<h5>'.$company.'</h5>
		</div>
		<div class="clr"></div>
	</div>
	';
	return $testimonial_right;
}

// [light_button]
function shortcode_light_button($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"target" => ''
	), $params));
	$light_button = '<a href="'.$url.'" class="light_button" target="'.$target.'">'.$content.'</a>';
	return $light_button;
}

// [dark_button]
function shortcode_dark_button($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"target" => ''
	), $params));
	$dark_button = '<a href="'.$url.'" class="dark_button" target="'.$target.'">'.$content.'</a>';
	return $dark_button;
}

// [light_grey_button]
function shortcode_light_grey_button($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"target" => ''
	), $params));
	$light_grey_button = '<a href="'.$url.'" class="light_grey_button" target="'.$target.'">'.$content.'</a>';
	return $light_grey_button;
}

// [dark_grey_button]
function shortcode_dark_grey_button($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"target" => ''
	), $params));
	$dark_grey_button = '<a href="'.$url.'" class="dark_grey_button" target="'.$target.'">'.$content.'</a>';
	return $dark_grey_button;
}

// [custom_button]
function shortcode_custom_button($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"color" => '',
		"bg_color" => '',
		"target" => ''
	), $params));
	$custom_button = '<a href="'.$url.'" class="custom_button" target="'.$target.'" style="background-color:'.$bg_color.'; border-color:'.$bg_color.'; color:'.$color.';">'.$content.'</a>';
	return $custom_button;
}



// [title_subtitle]
function shortcode_title_subtitle($atts, $content=null) {
	extract(shortcode_atts(array(
		'title'  => '',
		'title_color' => '#000000',
		'title_size' => '36',
		'subtitle' => '',
		'subtitle_color' => '#000000',
		'subtitle_size' => '17',
		'with_separator' => 'yes',
		'align' => 'center'
	), $atts));
	ob_start();
	?>
    
    <div class="title_subtitle" style="text-align:<?php echo $align; ?>">
        <h3 style="color:<?php echo $title_color; ?> !important; font-size:<?php echo $title_size; ?>px"><?php echo $title; ?></h3>
        <?php if ($with_separator == "yes") { ?><hr class="title_subtitle_separator" style="border-bottom-color:<?php echo $title_color; ?>"></hr><?php } ?>
        <?php if ($subtitle != "") { ?><h4 style="color:<?php echo $subtitle_color; ?> !important; font-size:<?php echo $subtitle_size; ?>px"><?php echo $subtitle; ?></h4><?php } ?>
    </div>

	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

// [slider]

function getbowtied_slider($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'full_height' 	=> 'yes',
		'custom_height' => '',
		'hide_arrows'	=> '',
		'hide_bullets'	=> ''
	), $params));

	if ($full_height == 'no' && !empty($custom_height))
	{
		$height = 'height:'.$custom_height.';';
		$extra_class = '';
	}
	else 
	{
		$height = '';
		$extra_class = 'full_height';
	}

	$getbowtied_slider = '
		
		<div class="shortcode_getbowtied_slider swiper-container '.$extra_class.'" style="'.$height.' width: 100%">
			<div class="swiper-wrapper">
			'.do_shortcode($content).'
			</div>';

	if (!$hide_arrows):
			$getbowtied_slider .= '
				<div class="swiper-button-prev"></div>
    			<div class="swiper-button-next"></div>';
    endif;

    if (!$hide_bullets):
    		$getbowtied_slider .= '
				<div class="quickview-pagination"></div>';
    endif;

	$getbowtied_slider .=	'</div>';
	
	return $getbowtied_slider;
}

add_shortcode('slider', 'getbowtied_slider');

function getbowtied_image_slide($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'title' 					=> '',
		'title_font_size'			=> '60px',
		'title_line_height'			=> '',
		'title_font_family'			=> 'primary_font',
		'description' 				=> '',
		'description_font_size' 	=> '21px',
		'description_line_height'	=> '',
		'description_font_family'	=> 'primary_font',
		'text_color'				=> '#000000',
		'button_text' 				=> '',
		'button_url'				=> '',
		'button_color'				=> '#000000',
		'button_text_color'			=>'#FFFFFF',
		'bg_color'					=> '#CCCCCC',
		'bg_image'					=> '',
		'text_align'				=> 'left'

	), $params));

	switch ($text_align)
	{
		case 'left':
			$class = 'left-align';
			break;
		case 'right':
			$class = 'right-align';
			break;
		case 'center':
			$class = 'center-align';
	}

	if (!empty($title))
	{
		$title_line_height = $title_line_height ? $title_line_height : $title_font_size;
		$title = '<h2 class="'.$title_font_family.'" style="color:'.$text_color.'; font-size:'.$title_font_size.'; line-height: '.$title_line_height.'">'.$title.'</h2>';
	} else {
		$title = "";
	}

	if (is_numeric($bg_image)) 
	{
		$bg_image = wp_get_attachment_url($bg_image);
	} else {
		$bg_image = "";
	}

	if (!empty($description))
	{
		$description_line_height = $description_line_height ? $description_line_height : $description_font_size;
		$description = '<p class="'.$description_font_family.'" style="color:rgba('.getbowtied_hex2rgb($text_color).', 0.66); font-size:'.$description_font_size.'; line-height: '.$description_line_height.'">'.$description.'</p>';
	} else {
		$description = "";
	}

	if (!empty($button_text))
	{
		$button = '<a class="button" style="color:'.$button_text_color.'; background: '.$button_color.'" href="'.$button_url.'">'.$button_text.'</a>';
	} else {
		$button = "";
	}
	

	$getbowtied_image_slide = '
		
		<div class="swiper-slide '.$class.'" 
		style=	"background: '.$bg_color.' url('.$bg_image.') center center no-repeat ;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
				color: '.$text_color.'">
			<div class="slider-content" data-swiper-parallax="-1000">
				<div class="slider-content-wrapper">
					'.$title.'
					'.$description.'
					'.$button.'
				</div>
			</div>
		</div>';
	
	return $getbowtied_image_slide;
}

add_shortcode('image_slide', 'getbowtied_image_slide');

/* Add shortcodes */

add_shortcode('full_column', 'content_grid_12');
add_shortcode('one_half', 'content_grid_6');
add_shortcode('one_third', 'content_grid_4');
add_shortcode('two_third', 'content_grid_2_3');
add_shortcode('one_fourth', 'content_grid_3');
add_shortcode('one_sixth', 'content_grid_2');
add_shortcode('one_twelves', 'content_grid_1');
add_shortcode('column_demo', 'column_demo');
add_shortcode('separator', 'shortcode_separator');
add_shortcode('empty_separator', 'shortcode_empty_separator');
add_shortcode('featured_box', 'shortcode_big_box_txt_bg');
add_shortcode('text_block', 'shortcode_text_block');
add_shortcode('featured_1', 'shortcode_featured_1');
add_shortcode('section_title', 'section_title');
add_shortcode('tabgroup', 'tabgroup');
add_shortcode('tab', 'tab');
add_shortcode('team_member', 'team_member');
add_shortcode('bold_title', 'bold_title');
add_shortcode('our_services', 'our_services');
add_shortcode('icon_box', 'icon_box_shortcode');
add_shortcode('accordion', 'accordion');
add_shortcode('accordion-item', 'accordion');
add_shortcode('container', 'shortcode_container');
add_shortcode('banner_simple', 'banner_simple');
add_shortcode('banner_simple_height', 'banner_simple_height');
add_shortcode("custom_featured_products", "shortcode_custom_featured_products");
add_shortcode("custom_on_sale_products", "shortcode_custom_on_sale_products");
add_shortcode("custom_latest_products", "shortcode_custom_latest_products");
add_shortcode("products_by_category", "shortcode_products_by_category");
add_shortcode("custom_products", "shortcode_custom_products");
add_shortcode("custom_product_attribute", "shortcode_custom_product_attribute");
add_shortcode("custom_top_rated_products", "shortcode_custom_top_rated_products");
add_shortcode("custom_best_sellers", "shortcode_custom_best_sellers");
add_shortcode("from_the_blog", "shortcode_from_the_blog");
add_shortcode("from_the_portfolio", "shortcode_from_the_portfolio");
add_shortcode("recent_work_filtered", "shortcode_recent_work_filtered");
add_shortcode("slide_everything", "shortcode_slide_everything");
add_shortcode("products_slider", "shortcode_products_slider");
add_shortcode('sourcecode', 'shortcode_sourcecode');
add_shortcode('code', 'shortcode_code');
add_shortcode('testimonial_left', 'shortcode_testimonial_left');
add_shortcode('testimonial_right', 'shortcode_testimonial_right');
add_shortcode('light_button', 'shortcode_light_button');
add_shortcode('dark_button', 'shortcode_dark_button');
add_shortcode('light_grey_button', 'shortcode_light_grey_button');
add_shortcode('dark_grey_button', 'shortcode_dark_grey_button');
add_shortcode('custom_button', 'shortcode_custom_button');
add_shortcode("title_subtitle", "shortcode_title_subtitle");



/*****************************************************************/
/******************* THE RETAILER SETTINGS ***********************/
/*****************************************************************/

if ( ! isset( $content_width ) ) $content_width = 620; /* pixels */

if ( ! function_exists( 'theretailer_setup' ) ) :
function theretailer_setup() {
	
	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );
	
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on theretailer, use a find and replace
	 * to change 'theretailer' to the name of your theme in all the template files
	 */

	load_theme_textdomain( 'theretailer', get_template_directory() . '/languages' );
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable($locale_file) ) require_once($locale_file);

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	
	
	
	
	function theretailer_register_custom_background() {
		$args = array(
			'default-color' => 'ffffff',
			'default-image' => '',
		);
	
		$args = apply_filters( 'theretailer_custom_background_args', $args );
	
		add_theme_support( 'custom-background', $args );
	}
	add_action( 'after_setup_theme', 'theretailer_register_custom_background' );
	
	

	function theretailer_add_editor_styles() {
		add_editor_style( 'custom-editor-style.css' );
	}
	add_action( 'init', 'theretailer_add_editor_styles' );

	/**
	 * This theme uses wp_nav_menu() in 4 location.
	 */
	register_nav_menus( array(
		'tools' => __( 'Top Header Navigation', 'theretailer' ),
		'primary' => __( 'Main Navigation', 'theretailer' ),
		'secondary' => __( 'Secondary Navigation', 'theretailer' )
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'video', 'audio', 'gallery', 'image', 'status', 'quote') );
}
endif; // theretailer_setup
add_action( 'after_setup_theme', 'theretailer_setup' );



/*******************************************************/
/******************* WOOCOMMERCE ***********************/
/*******************************************************/


function woocommerce_output_related_products() {
	
	$args = array(
		'posts_per_page' => 12,
		'columns' => 12,
		'orderby' => 'rand'
	);

	woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
}

if (!isset($theretailer_theme_options['gb_header_style'])) $theretailer_theme_options['gb_header_style'] = "0";


// change breadcrumb defaults delimiter
add_filter( 'woocommerce_breadcrumb_defaults', 'theretailer_change_breadcrumb_delimiter' );
function theretailer_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = '&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;';
	return $defaults;
}





/******************************************************************************/
/* WooCommerce Update Number of Items in the cart *****************************/
/******************************************************************************/

add_action('woocommerce_ajax_added_to_cart', 'theretailer_ajax_added_to_cart');
function theretailer_ajax_added_to_cart() {

	add_filter('add_to_cart_fragments', 'theretailer_refresh_minicart_1');
	function theretailer_refresh_minicart_1($fragments) 
	{
		global $woocommerce;
		ob_start(); ?>
            
        <div class="overview"><?php echo WC()->cart->get_cart_total(); ?> <span class="minicart_items">/ <?php echo sprintf( _n( '%d item', '%d items', WC()->cart->cart_contents_count, 'theretailer' ), WC()->cart->cart_contents_count ); ?></span></div>

		<?php
		$fragments['.overview'] = ob_get_clean();
		return $fragments;
	}
	
	add_filter('add_to_cart_fragments', 'theretailer_refresh_minicart_2');
	function theretailer_refresh_minicart_2($fragments) 
	{
		global $woocommerce;
		ob_start(); ?>
            
        <div class="gb_cart_contents_count"><?php echo WC()->cart->cart_contents_count; ?></div>

		<?php
		$fragments['.gb_cart_contents_count'] = ob_get_clean();
		return $fragments;
	}
	
	add_filter('add_to_cart_fragments', 'theretailer_refresh_minicart_3');
	function theretailer_refresh_minicart_3($fragments) 
	{
		global $woocommerce;
		ob_start(); ?>
        
        <a href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" class="gbtr_little_shopping_bag_wrapper_mobiles"><span><?php echo WC()->cart->cart_contents_count; ?></span></a>

		<?php
		$fragments['.gbtr_little_shopping_bag_wrapper_mobiles'] = ob_get_clean();
		return $fragments;
	}
	
	add_filter('add_to_cart_fragments', 'theretailer_refresh_minicart_4');
	function theretailer_refresh_minicart_4($fragments) 
	{
		global $woocommerce;
		ob_start(); ?>
        
        <span class="items_number"><?php echo WC()->cart->cart_contents_count; ?></span>

		<?php
		$fragments['.items_number'] = ob_get_clean();
		return $fragments;
	}

}





// Sidebars
function theretailer_widgets_init() {
	
	global $theretailer_theme_options;
	
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name' => __( 'Sidebar', 'theretailer' ),
			'id' => 'sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		));
		
		register_sidebar(array(
			'name' => __( 'Product listing', 'theretailer' ),
			'id' => 'widgets_product_listing',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		));
		
		if (isset($theretailer_theme_options['light_footer_layout'])) {
			if ((!$theretailer_theme_options['light_footer_layout']) || ($theretailer_theme_options['light_footer_layout'] == "4col")) {
				$light_footer_grid = 3;
			} else {
				$light_footer_grid = 4;
			}
		} else {
			$light_footer_grid = 4;
		}
		
		register_sidebar(array(
			'name' => __( 'Light footer', 'theretailer' ),
			'id' => 'widgets_light_footer',
			'before_widget' => '<div class="grid_'.$light_footer_grid.'"><div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div></div>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		));
		
		
		if (isset($theretailer_theme_options['dark_footer_layout'])) {
			if ((!$theretailer_theme_options['dark_footer_layout']) || ($theretailer_theme_options['dark_footer_layout'] == "4col")) {
				$dark_footer_grid = 3;
			} else {
				$dark_footer_grid = 4;
			}
		} else {
			$dark_footer_grid = 4;
		}
		
		register_sidebar(array(
			'name' => __( 'Dark footer', 'theretailer' ),
			'id' => 'widgets_dark_footer',
			'before_widget' => '<div class="grid_'.$dark_footer_grid.'"><div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div></div>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		));
	}
}
add_action( 'widgets_init', 'theretailer_widgets_init' );



/*********************************************************************************************/
/******************* ADD prettyPhoto rel to [gallery] with link=file  ************************/
/*********************************************************************************************/

add_filter( 'wp_get_attachment_link', 'sant_prettyadd', 10, 6);
function sant_prettyadd ($content, $id, $size, $permalink, $icon, $text) {
    if ($permalink) {
    	return $content;    
    }
    $content = preg_replace("/<a/","<span class=\"fresco\" data-fresco-group=\"\"", $content, 1);
    return $content;
}

/*********************************************************************************************/
/********************************** Number of Products / Page  *******************************/
/*********************************************************************************************/
if ( (!isset($theretailer_theme_options['products_per_page'])) ) {
	$gb_products_per_page = 12;
} else {
	$gb_products_per_page = $theretailer_theme_options['products_per_page'];
}

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . $gb_products_per_page . ';' ), 20 );



/*********************************************************************************************/
/******************************** Remove mediaelement  ***************************************/
/*********************************************************************************************/

// function theretailer_deregister() {
// 	wp_deregister_script('wp-mediaelement');
// 	wp_deregister_script('mediaelement');
	
// 	wp_deregister_style('wp-mediaelement');
// 	wp_deregister_style('mediaelement');
// }
// add_action('wp_enqueue_scripts', 'theretailer_deregister');





/*********************************************************************************************/
/******************************** Disable PRETTY PHOTO ***************************************/
/*********************************************************************************************/



// Remove Woocommerce prettyPhoto
add_action( 'wp_enqueue_scripts', 'the_retailer_remove_woo_lightbox', 99 );
function the_retailer_remove_woo_lightbox() {
	wp_dequeue_script('prettyPhoto-init');
}



/*********************************************************************************************/
/****************************** WooCommerce Category Image ***********************************/
/*********************************************************************************************/

if ( ! function_exists( 'woocommerce_add_category_header_img' ) ) :
	require_once('inc/addons/woocommerce-header-category-image.php');
endif;




/*********************************************************************************************/
/*********** Remove Admin Bar - Only display to administrators *******************************/
/*********************************************************************************************/

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}





/*********************************************************************************************/
/************************** WooCommerce Custom Out of Stock **********************************/
/*********************************************************************************************/


if (isset($theretailer_theme_options['out_of_stock_text'])) {
	add_filter( 'woocommerce_get_availability', 'custom_get_availability', 1, 2);
	function custom_get_availability( $availability, $_product ) {
		global $theretailer_theme_options;
		if ( !$_product->is_in_stock() ) $availability['availability'] = __($theretailer_theme_options['out_of_stock_text'], 'theretailer');
		return $availability;
	}
}




/*********************************************************************************************/
/****************************** WooCommerce Custom Sale **************************************/
/*********************************************************************************************/


if (isset($theretailer_theme_options['sale_text'])) {
	add_filter('woocommerce_sale_flash', 'theretailer_custom_sale_flash', 10, 3);
	function theretailer_custom_sale_flash($text, $post, $_product) {
		global $theretailer_theme_options;
		return '<span class="onsale">'.__($theretailer_theme_options['sale_text'], 'theretailer').'</span>';  
	}
}





/******************************************************************************/
/****** Overwrite WooCommerce Widgets *****************************************/
/******************************************************************************/
 

function overwride_woocommerce_widgets() { 
	if ( class_exists( 'WC_Widget_Cart' ) ) {
		include_once( 'inc/widgets/woocommerce-cart.php' ); 
		register_widget( 'theretailer_WC_Widget_Cart' );
	}
}
add_action( 'widgets_init', 'overwride_woocommerce_widgets', 15 );





/******************************************************************************/
/* Share Product **************************************************************/
/******************************************************************************/

function getbowtied_single_share_product() {
    global $post, $product, $theretailer_theme_options;
    if ( (isset($theretailer_theme_options['sharing_on_product_page'])) && ($theretailer_theme_options['sharing_on_product_page'] == "1" ) ) :
    	$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false, '' );
?>
	
	<div class="gbtr_product_share">
		<ul>    
			<li><a href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="product_share_facebook"><?php _e('<span>Share</span> on Facebook', 'theretailer'); ?></a></li>
			<li><a href="//pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $src[0] ?>&description=<?php strip_tags(the_title()); ?>" target="_blank" class="product_share_pinterest"><?php _e('<span>Pin</span> this item', 'theretailer'); ?></a></li>
			<li><a href="mailto:enteryour@addresshere.com?subject=<?php strip_tags(the_title()); ?>&body=<?php echo strip_tags(apply_filters( 'woocommerce_short_description', $post->post_excerpt )); ?> <?php the_permalink(); ?>" class="product_share_email"><?php _e('<span>Email</span> a friend', 'theretailer'); ?></a></li>
			<li><a href="https://twitter.com/share?url=<?php the_permalink(); ?>" target="_blank" class="product_share_twitter"><?php _e('<span>Tweet</span> this item', 'theretailer'); ?></a></li>   
		</ul>    
	</div>

<?php
    endif;
}
add_filter( 'getbowtied_woocommerce_single_product_share', 'getbowtied_single_share_product', 50 );


/******************************************************************************/
/****** Set woocommerce images sizes ******************************************/
/******************************************************************************/

if ( ! function_exists('theretailer_woocommerce_image_dimensions') ) :
	function theretailer_woocommerce_image_dimensions() {
		global $pagenow;
	 
		if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
			return;
		}

	  	$catalog = array(
			'width' 	=> '190',	// px
			'height'	=> '243',	// px
			'crop'		=> 1 		// true
		);

		$single = array(
			'width' 	=> '510',	// px
			'height'	=> '652',	// px
			'crop'		=> 1 		// true
		);

		$thumbnail = array(
			'width' 	=> '114',	// px
			'height'	=> '145',	// px
			'crop'		=> 0 		// false
		);

		// Image sizes
		update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
		update_option( 'shop_single_image_size', $single ); 		// Single product image
		update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
	}
	add_action( 'after_switch_theme', 'theretailer_woocommerce_image_dimensions', 1 );
endif;

/******************************************************************************/
/****** Remove customize link from top bar*************************************/
/******************************************************************************/
add_action( 'admin_bar_menu', 'remove_customize_link', 999 );
function remove_customize_link( $wp_admin_bar ) 
{
$wp_admin_bar->remove_menu( 'customize' );
}

// -----------------------------------------------------------------------------
// Convert hex to rgb
// -----------------------------------------------------------------------------

function getbowtied_hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);
	
	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);
	return implode(",", $rgb); // returns the rgb values separated by commas
	//return $rgb; // returns an array with the rgb values
}

/******************************************************************************/
/****** Limit number of cross-sells *******************************************/
/******************************************************************************/
add_filter('woocommerce_cross_sells_total', 'cartCrossSellTotal');
function cartCrossSellTotal($total) {
	$total = '1';
	return $total;
}

/******************************************************************************/
/****** Force GetbowtiedTools Update*******************************************/
/******************************************************************************/
if ( ! class_exists( 'GetbowtiedToolsUpdater') ) {
	if ( ! function_exists( 'get_plugins' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}
	$installed_plugins = get_plugins();

	/** We need to display the 'Install' hover link */
	if ( isset( $installed_plugins['getbowtied-tools/index.php'] ) ) {
		require('inc/plugins/plugin-updater.php');
		$plugin_update = new GetbowtiedToolsUpdater('1.0.1', 'https://my.getbowtied.com/getbowtied-tools/update.php', 'getbowtied-tools/index.php');
	}
}

