<?php

/* ------------------------------------------------
   Options Panel
------------------------------------------------ */

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/admin/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/admin/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/admin/admin-config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/admin/admin-config.php' );
}

// Redux doesn't return options in functions.php unless you add this
Redux::init( 'qns_data' );

/* ------------------------------------------------
	Theme Setup
------------------------------------------------ */

if ( ! isset( $content_width ) ) $content_width = 640;

add_action( 'after_setup_theme', 'qns_setup' );

if ( ! function_exists( 'qns_setup' ) ):

function qns_setup() {

	add_theme_support( 'post-thumbnails' );
	
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
	        set_post_thumbnail_size( "100", "100" );  
	}

	if ( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'testimonial-thumb', 65, 65, true );
		add_image_size( 'shop-thumb', 65, 65, true );
		add_image_size( 'recent-posts-widget', 66, 66, true );
		add_image_size( 'slideshow-big', 960, 420, true );
		add_image_size( 'blog-thumb-small', 205, 107, true );
		add_image_size( 'blog-thumb-large', 612, 107, true );
		add_image_size( 'gallery-thumb-large', 500, 500, true );
	}
	
	add_theme_support( 'automatic-feed-links' );
	
	load_theme_textdomain( 'qns', get_template_directory() . '/languages' );
	load_theme_textdomain( 'woocommerce', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) ) require_once( $locale_file );

	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'qns' ),
	) );

}
endif;



/* ------------------------------------------------
	Comments Template
------------------------------------------------ */

if( ! function_exists( 'qns_comments' ) ) {
	function qns_comments($comment, $args, $depth) {
	   $path = get_template_directory_uri();
	   $GLOBALS['comment'] = $comment;
	   ?>
	
		<li <?php comment_class('comment_list'); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>" class="comment-wrapper">
				<div class="author-image">
					<?php echo get_avatar( $comment, 32 ); ?>
				</div>
				
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<div class="msg success clearfix"><p><?php _e( 'Your comment is awaiting moderation.', 'qns' ); ?></p></div>
				<?php endif; ?>
				
				<p class="comment-author"><?php printf( __( '%s', 'qns' ), sprintf( '%s', get_comment_author_link() ) ); ?>
				<span>
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<?php printf( __( '%1$s at %2$s', 'qns' ), get_comment_date(),  get_comment_time() ); ?>
					</a>
				</span></p>
				
				<?php comment_text(); ?>
				
				<p><span class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					<?php edit_comment_link( __( '(Edit)', 'qns' ), ' ' ); ?>
				</span></p>
				
			</div>			

	<?php
	}
}




/* ------------------------------------------------
	Register Sidebars
------------------------------------------------ */

function qns_widgets_init() {

	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'qns' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'qns' ),
		'before_widget' => '<div class="widget clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title clearfix"><h4 class="tag-title">',
		'after_title' => '</h4></div>',
	) );
	
	// Area 2, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Widget Area One', 'qns' ),
		'id' => 'footer-widget-area-one',
		'description' => __( 'Footer widget area one', 'qns' ),
		'before_widget' => '<div class="widget clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title clearfix"><h6>',
		'after_title' => '</h6></div>',
	) );
	
	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Widget Area Two', 'qns' ),
		'id' => 'footer-widget-area-two',
		'description' => __( 'Footer widget area two', 'qns' ),
		'before_widget' => '<div class="widget clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title clearfix"><h6>',
		'after_title' => '</h6></div>',
	) );
	
	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Widget Area Three', 'qns' ),
		'id' => 'footer-widget-area-three',
		'description' => __( 'Footer widget area three', 'qns' ),
		'before_widget' => '<div class="widget clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title clearfix"><h6>',
		'after_title' => '</h6></div>',
	) );
	
	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Widget Area Four', 'qns' ),
		'id' => 'footer-widget-area-four',
		'description' => __( 'Footer widget area four', 'qns' ),
		'before_widget' => '<div class="widget clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title clearfix"><h6>',
		'after_title' => '</h6></div>',
	) );
	
	// Area 6, located only on WooCommerce pages. Empty by default.
	register_sidebar( array(
		'name' => __( 'WooCommerce Widget Area', 'qns' ),
		'id' => 'woocommerce-widget-area',
		'description' => __( 'Widgets in this area will only be displayed on WooCommerce store pages', 'qns' ),
		'before_widget' => '<div class="widget clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title clearfix"><h4 class="tag-title">',
		'after_title' => '</h4></div>',
	) );

}

add_action( 'widgets_init', 'qns_widgets_init' );



/* ------------------------------------------------
	Register Menu
------------------------------------------------ */

if( !function_exists( 'qns_register_menu' ) ) {
	function qns_register_menu() {

		register_nav_menus(
		    array(
				'primary' => __( 'Primary Navigation','qns' ),
				'secondary' => __( 'Secondary Navigation','qns' ),
				'footer' => __( 'Footer Navigation','qns' )
		    )
		  );
		
	}

	add_action('init', 'qns_register_menu');
}



/* ------------------------------------------------
	Get Post Type
------------------------------------------------ */

function is_post_type($type){
    global $wp_query;
    if($type == get_post_type($wp_query->post->ID)) return true;
    return false;
}



/* ------------------------------------------------
   Register Dependant Javascript Files
------------------------------------------------ */

add_action('wp_enqueue_scripts', 'qns_load_js');

if( ! function_exists( 'qns_load_js' ) ) {
	function qns_load_js() {
		
		global $qns_data;
		
		if ( $qns_data['gmap-api-key'] != '' ) {
			$qns_api_key = $qns_data['gmap-api-key'];
		} else {
			$gmap_api_key = 'empty';
		}
		
		if ( is_admin() ) {
			
		}
		
		else {
			
			// Load JS
			wp_register_script( 'google-map', '//maps.google.com/maps/api/js?sensor=false&key='.$gmap_api_key, array( 'jquery' ), '1', false );
			wp_register_script( 'hoverintent', get_template_directory_uri() . '/js/hoverIntent.js', array( 'jquery' ), '1.4.8', true );
			wp_register_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ), '1.4.8', true );
			wp_register_script( 'prettyphoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array( 'jquery' ), '1.1.9', true );
			wp_register_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), '1.1.9', true );
			wp_register_script( 'fitvid', get_template_directory_uri() . '/js/jquery.fitvid.js', array( 'jquery' ), '1.0', true );
			wp_register_script( 'froogaloop', get_template_directory_uri() . '/js/froogaloop.js', array( 'jquery' ), '1.0', true );
			wp_register_script( 'selectivizr', get_template_directory_uri() . '/js/selectivizr-min.js', array( 'jquery' ), '1.0.2', true );
			wp_register_script( 'jquery_numeric', get_template_directory_uri() . '/js/jquery.numeric.js', array( 'jquery' ), '1.3', true );
			wp_register_script( 'custom', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1', true );

			wp_enqueue_script( array( 'jquery-ui-core', 'jquery-ui-accordion', 'jquery-ui-tabs', 'jquery-effects-core', 'google-map', 'hoverintent', 'superfish', 'prettyphoto', 'flexslider', 'fitvid', 'froogaloop', 'jquery_numeric', 'custom' ) );
			
			global $is_IE;
			
			if( $is_IE ) wp_enqueue_script( 'selectivizr' );
			if( is_single() ) wp_enqueue_script( 'comment-reply' );
			
			// Load CSS
			wp_enqueue_style('superfish', get_template_directory_uri() .'/css/superfish.css');
			wp_enqueue_style('prettyPhoto', get_template_directory_uri() .'/css/prettyPhoto.css');
			wp_enqueue_style('flexslider', get_template_directory_uri() .'/css/flexslider.css');
			wp_enqueue_style('color', get_template_directory_uri() .'/css/colours/green.css');
			wp_enqueue_style('responsive', get_template_directory_uri() .'/css/responsive.css');

			
		}
	}
}

if( !function_exists( 'custom_js' ) ) {

    function custom_js() {
		
		global $qns_data; //fetch options stored in $qns_data
		
		echo '<script>';
		
		// Set slideshow autoplay on/off
		if ( $qns_data['slideshow_autoplay'] ) :
			echo 'var slideshow_autoplay = true;';
		else :
			echo 'var slideshow_autoplay = false;';
		endif;
		
		// Set slideshow speed
		if ( $qns_data['slideshow_speed'] ) :
			echo 'var slideshow_speed = ' . $qns_data['slideshow_speed'] . ';';
		else :
			echo 'var slideshow_speed = 7000;';
		endif;
		
		// Check if slideshow contains video
		if ( $qns_data['slideshow_video'] ) :
			echo 'var slideshow_video = true;';
		else :
			echo 'var slideshow_video = false;';
		endif;
		
		echo 'var goText = "' . __('Go to...','qns') . '";';

		echo "</script>\n\n";
		
    }

}

add_action('wp_footer', 'custom_js');



/* ------------------------------------------------
   Load Files
------------------------------------------------ */

// Meta Boxes
include 'functions/post_meta.php';
include 'functions/slides_meta.php';
include 'functions/testimonial_meta.php';

// Shortcodes
include 'functions/shortcodes/slideshow.php';
include 'functions/shortcodes/accordion.php';
include 'functions/shortcodes/googlemap.php';
include 'functions/shortcodes/gallery.php';
include 'functions/shortcodes/toggle.php';
include 'functions/shortcodes/list.php';
include 'functions/shortcodes/button.php';
include 'functions/shortcodes/columns.php';
include 'functions/shortcodes/video.php';
include 'functions/shortcodes/title.php';
include 'functions/shortcodes/message.php';
include 'functions/shortcodes/dropcap.php';
include 'functions/shortcodes/tabs.php';


// Widgets
include 'functions/widgets/widget-contact.php';
include 'functions/widgets/widget-flickr.php';
include 'functions/widgets/widget-tags.php';
include 'functions/widgets/widget-recent-posts.php';



/* ------------------------------------------------
	Custom CSS
------------------------------------------------ */

function custom_css() {
	
	global $qns_data; //fetch options stored in $qns_data
	
	// Set Font Family
	if ( !$qns_data['custom_font'] ) { 
		$custom_font = "'Cardo', serif"; } 
	else { 
		$custom_font =  $qns_data['custom_font']; 
	}
	
	// Output Custom CSS
	$output = '<style type="text/css">
	
		h1, h2, h3, h4, h5, h6, #ui-datepicker-div .ui-datepicker-title, .dropcap, .ui-tabs .ui-tabs-nav li, 
		#title-wrapper h1, #main-menu li, #main-menu li span, .flex-caption p, .accommodation_img_price, .single_variation .price, .site-intro, .product-image .onsale {
		font-family: ' . $custom_font . ';
	}';
	
	if ( $qns_data['image_logo_width'] ) { 
		$site_title_width = $qns_data['image_logo_width'];
	}
	else {
		$site_title_width = '220';
	}
	
	$output .= '#site-title {
		width: ' . $site_title_width . 'px;
	}';
	
	if ( $qns_data['body_background'] and $qns_data['body_background_image']['url'] ) {
		
		if ( $qns_data['background_repeat'] ) {
			$background_repeat = $qns_data['background_repeat'];
		}
		else {
			$background_repeat = 'repeat';
		}
		
		$output .= 'body {
			background: url(' . $qns_data['body_background_image']['url'] . ') ' . $qns_data['body_background'] . ' fixed ' . $qns_data['background_repeat'] . ' !important;
		}';
	}
	
	elseif ( $qns_data['body_background'] ) { 
		$output .= 'body {
			background: ' . $qns_data['body_background'] . ' !important;
		}';
	}
	
	elseif ( !empty($qns_data['body_background_image']['url']) ) { 
		$output .= 'body {
			background: url(' . $qns_data['body_background_image']['url'] . ') fixed ' . $qns_data['background_repeat'] . ' !important;
		}';
	}
	
	if ( $qns_data['main_color'] ) { 
		$output .= '.topbar-right ul li a:hover, .accordion h4.ui-state-active, .toggle .active, .widget .latest-posts-list li a {
			color: ' . $qns_data['main_color'] . ';
		}
		
		.woocommerce .star-rating span:before, .woocommerce-page .star-rating span:before {
		color: ' . $qns_data['main_color'] . ' !important;
		}
		
		.pagination-wrapper a.selected,
		.pagination-wrapper a:hover,
		.wp-pagenavi .current,
		.wp-pagenavi a:hover {
			background: ' . $qns_data['main_color'] . ';
			border: ' . $qns_data['main_color'] . ' 1px solid;
			color: #fff !important;
		}

		.pagination-wrapper a,
		.wp-pagenavi .current {
			border: ' . $qns_data['main_color'] . ' 1px solid;
		}

		.woocommerce p.stars a:hover:before,.woocommerce-page p.stars a:hover:before,.woocommerce p.stars a:focus:before,.woocommerce-page p.stars a:focus:before,
		.woocommerce p.stars a.active:before,.woocommerce-page p.stars a.active:before, .star-rating {
			color: ' . $qns_data['main_color'] . ' !important;
		}
		
		.button2 {color:#3f3f3f !important;}
		
		.wrapper a:hover, button:hover, .page-content p a, .page-content span a, .product-title, header a, .navigation a, table a {
			color: ' . $qns_data['main_color'] . ';
		}
		
		.search-results li a {
			color: ' . $qns_data['main_color'] . ';
		}
		
		.button2:hover, .blog-title h3 a, #site-title h1 a, .product-table a {
			color: ' . $qns_data['main_color'] . ' !important;
		}
		
		a.button2 {
			color: #424242 !important;
		}
		
		.wrapper .cart-top p a:hover {
			color: #fff !important;
		}
		
		.wrapper, #main-menu-wrapper, #main-menu li.current-menu-item a, #main-menu li.current_page_item a, #main-menu li.current-menu-parent a, #main-menu li.current_page_parent a, #main-menu li a:hover, #main-menu li.sfHover a,
		#main-menu a:focus, #main-menu a:hover, #main-menu a:active, #main-menu li ul, blockquote, .page-content table,
		.ui-tabs .ui-tabs-nav li.ui-state-active, #footer {
			border-color: ' . $qns_data['main_color'] . ' !important;
		}
		
		.page-content table {
			border-top: ' . $qns_data['main_color'] . ' 5px solid !important;
		}
		
		.page-content table {
		    border-left: #dee0e0 1px solid !important;
		}
		
		.ui-tabs .ui-tabs-nav li.ui-state-active {
			border-bottom: #fff 1px solid !important;
		}
		
		.plus, .minus, .button1, .blog-title .comment-count, .blog-title-single .comment-count, #footer-bottom, .tag-title, span.onsale, .price_slider_wrapper .ui-slider .ui-slider-handle {
			background: ' . $qns_data['main_color'] . ' !important;
		}

		.flex-control-paging li a.flex-active, #fancybox-close:hover {
			background: ' . $qns_data['main_color'] . ' !important;
		}

		#twitter_icon:hover, #pinterest_icon:hover, #facebook_icon:hover, #googleplus_icon:hover, #skype_icon:hover, #flickr_icon:hover, #linkedin_icon:hover, #vimeo_icon:hover, #youtube_icon:hover, #rss_icon:hover, #instagram_icon:hover {
			background-color: ' . $qns_data['main_color'] . ' !important;
		}

		.blog-title .comment-count .comment-point,
		.blog-title-single .comment-count .comment-point {
			background: url(' . get_template_directory_uri() . '/images/comment-point.png) ' . $qns_data['main_color'] . ' no-repeat !important;
		}

		.cart-top {
			background: url(' . get_template_directory_uri() . '/images/tagbottom.png) no-repeat bottom center ' . $qns_data['main_color'] . ' !important;
		}

		.flex-direction-nav .flex-prev, .flex-direction-nav .flex-next {
			background: url(' . get_template_directory_uri() . '/images/slide-arrows.png) ' . $qns_data['main_color'] . ' no-repeat !important;
		}

		.flex-direction-nav .flex-prev {
			background-position: 7px 6px !important;
		}

		.flex-direction-nav .flex-next {
			background-position: -51px 6px  !important;
		}
		
		.flex-direction-nav .flex-prev:hover {
			background: url(' . get_template_directory_uri() . '/images/slide-arrows.png) #fff no-repeat !important;
			background-position: 7px -49px !important;
		}

		.flex-direction-nav .flex-next:hover {
			background: url(' . get_template_directory_uri() . '/images/slide-arrows.png) #fff no-repeat !important;
			background-position: -51px -49px !important;
		}
		
		.tag-title:before {
			border-color: ' . $qns_data['main_color'] . ' transparent ' . $qns_data['main_color'] . ' transparent !important;
		}
		
		.ie8 .flex-caption p {
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#70' . $qns_data['main_color'] . ',endColorstr=#70' . $qns_data['main_color'] . ');
		}';
	
	}
	
	if ( $qns_data['main_colortext'] ) { 
		$output .= '#footer-bottom, #footer-bottom a:hover {
			color: ' . $qns_data['main_colortext'] . ' !important;
		}';
	}
	
	if ( $qns_data['main_colorrgba'] ) { 
		$output .= '.flex-caption p {
			background: ' . $qns_data['main_colorrgba'] . ' !important;
		}';
	}
	
	if( !$qns_data['main_menu_search'] ) {
		$output .= '#main-menu {width: 100% !important;}';
	}
	
	$output .= $qns_data['custom_css'];
	
	$output .= '</style>';
	
  return $output;
}

function admin_style() {
	wp_enqueue_style('admin-css', get_template_directory_uri().'/css/admin.css');
}



/* -------------------------------------------------------
	Remove width / height attributes from gallery images
------------------------------------------------------- */

add_filter('wp_get_attachment_link', 'remove_img_width_height', 10, 1);

function remove_img_width_height($html) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}



/* ------------------------------------------------
	Remove rel attribute from the category list
------------------------------------------------ */

function remove_category_list_rel($output)
{
  $output = str_replace(' rel="category"', '', $output);
  return $output;
}
add_filter('wp_list_categories', 'remove_category_list_rel');
add_filter('the_category', 'remove_category_list_rel');



/* -----------------------------------------------------
	Remove <p> / <br> tags from nested shortcode tags
----------------------------------------------------- */

add_filter('the_content', 'shortcode_fix');
function shortcode_fix($content)
{   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr($content, $array);

	return $content;
}



/* ------------------------------------------------
	Excerpt Length
------------------------------------------------ */

function qns_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'qns_excerpt_length' );



/* ------------------------------------------------
	Excerpt More Link
------------------------------------------------ */

function qns_continue_reading_link() {
	
	// Don't Display Read More Button On Search Results / Archive Pages
	if ( is_post_type( "accommodation" )) {
		$btn_text = __('Details','qns');
	}
	
	else {
		$btn_text = __('Read More','qns');
	}
	
	
	if ( !is_search() && !is_archive() ) {
		return ' <p><a href="'. get_permalink() . '"' . __( ' class="button2">' . $btn_text . ' &raquo;</a></p>', 'qns' );
	}
	
}

function qns_auto_excerpt_more( $more ) {
	return qns_continue_reading_link();
}
add_filter( 'excerpt_more', 'qns_auto_excerpt_more' );



/* ------------------------------------------------
	The Title
------------------------------------------------ */

function qns_filter_wp_title( $title, $separator ) {
	
	if ( is_feed() )
		return $title;

	global $paged, $page;

	if ( is_search() ) {
		$title = sprintf( __( 'Search results for %s', 'qns' ), '"' . get_search_query() . '"' );
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'qns' ), $paged );
		$title .= " $separator " . home_url( 'name', 'display' );
		return $title;
	}

	$title .= get_bloginfo( 'name', 'display' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'qns' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'qns_filter_wp_title', 10, 2 );



/* ------------------------------------------------
	Sidebar Position
------------------------------------------------ */

function sidebar_position( $position ) {
	
	global $qns_data; //fetch options stored in $qns_data
	
	if ( $qns_data['sidebar_position'] ) { 
		$sidebar = $qns_data['sidebar_position']; 
	}

	else { 
		$sidebar = 'right';
	}
	
	if ( $sidebar == 'left' && $position == 'primary-content' ) {
		$output = 'col-main-right';
	}
	
	if ( $sidebar == 'right' && $position == 'primary-content' ) {
		$output = 'col-main';
	}
	
	if ( $sidebar == 'left' && $position == 'secondary-content' ) {
		$output = 'col-sidebar-left';
	}
	
	if ( $sidebar == 'right' && $position == 'secondary-content' ) {
		$output = 'col-sidebar';
	}
	
	if ( $sidebar == 'none' && $position == 'primary-content' ) {
		$output = 'full-width';
	}
	
	if ( $sidebar == 'none' && $position == 'secondary-content' ) {
		$output = 'full-width';
	}
	
	return $output;

}



/* ------------------------------------------------
	Menu Fallback
------------------------------------------------ */

function wp_page_menu_qns( $args = array() ) {
	$defaults = array('sort_column' => 'menu_order, post_title', 'menu_class' => 'menu', 'echo' => true, 'link_before' => '', 'link_after' => '');
	$args = wp_parse_args( $args, $defaults );
	$args = apply_filters( 'wp_page_menu_qns_args', $args );

	$menu = '';

	$list_args = $args;

	// Show Home in the menu
	if ( ! empty($args['show_home']) ) {
		if ( true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'] )
			$text = __('Home','qns');
		else
			$text = $args['show_home'];
		$class = '';
		if ( is_front_page() && !is_paged() )
			$class = 'class="current_page_item"';
		$menu .= '<li ' . $class . '><a href="' . home_url( '/' ) . '" title="' . esc_attr($text) . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
		// If the front page is a page, add it to the exclude list
		if (get_option('show_on_front') == 'page') {
			if ( !empty( $list_args['exclude'] ) ) {
				$list_args['exclude'] .= ',';
			} else {
				$list_args['exclude'] = '';
			}
			$list_args['exclude'] .= get_option('page_on_front');
		}
	}

	$list_args['echo'] = false;
	$list_args['title_li'] = '';
	$menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages($list_args) );

	if ( $menu )
		$menu = '<ul id="main-menu" class="fl">' . $menu . '</ul>';

	$menu = $menu . "\n";
	$menu = apply_filters( 'wp_page_menu_qns', $menu, $args );
	if ( $args['echo'] )
		echo $menu;
	else
		return $menu;
}



/* ------------------------------------------------
	Password Protected Post Form
------------------------------------------------ */

add_filter( 'the_password_form', 'qns_password_form' );

function qns_password_form() {
	
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$form = '<div class="msg fail clearfix"><p class="nopassword">' . __( 'This post is password protected. To view it please enter your password below', 'qns' ) . '</p></div>
<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post"><label for="' . $label . '">' . __( 'Password', 'qns' ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" /><div class="clearboth"></div><input id="submit" type="submit" value="' . esc_attr__( "Submit" ) . '" name="submit"></form>';
	return $form;
	
}



/* ------------------------------------------------
	Google Fonts
------------------------------------------------ */

function google_fonts() {
	
	global $qns_data; //fetch options stored in $qns_data
	
	$output = '';
	
	if ( !$qns_data['custom_font_code'] ) {
		$output .= "<link href='http://fonts.googleapis.com/css?family=Cardo:400,400italic,700' rel='stylesheet' type='text/css'>"; 
	}

	else { 
		$output .= $qns_data['custom_font_code']; 
	}
	
	return $output;
	
}



/* ------------------------------------------------
	Page Header
------------------------------------------------ */

function page_header( $url ) {
	
	global $qns_data; //fetch options stored in $qns_data
	
	$header_url = '';
	
	// If custom page header is set
	if ( $url != '' ) {
		$header_url = $url;
	}
	
	// If default page header is set and custom header is not set
	if ( $qns_data['default_header_url'] && $url == '' ) {
		$header_url = $qns_data['default_header_url'];
	}
	
	$output = '<div id="page-header">';
	
	// If either of the above is set
	if ( $header_url != '' ) {
		$output .= '<img src="' . $header_url . '" alt="" />';
	}
	
	$output .= '</div>';
		
	return $output;
	
}



/* ------------------------------------------------
	Email Validation
------------------------------------------------ */

function valid_email($email) {
	
	$result = TRUE;
	
	if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) {
    	$result = FALSE;
	}
  	
	return $result;
	
}



/* ------------------------------------------------
	Add PrettyPhoto for Attached Images
------------------------------------------------ */

add_filter( 'wp_get_attachment_link', 'sant_prettyadd');
function sant_prettyadd ($content) {
     $content = preg_replace("/<a/","<a
rel=\"prettyPhoto[slides]\"",$content,1);
     return $content;
}



/* ------------------------------------------------
	Social Icons
------------------------------------------------ */

function no_icons() {
	
	global $qns_data; //fetch options stored in $qns_data
	
	if( $qns_data['social_twitter'] ) { $twitter = $qns_data['social_twitter']; }
	else { $twitter = ''; }
	
	if( $qns_data['social_pinterest'] ) { $pinterest = $qns_data['social_pinterest']; }
	else { $pinterest = ''; }

	if( $qns_data['social_facebook'] ) { $facebook = $qns_data['social_facebook']; }
	else { $facebook = ''; }

	if( $qns_data['social_googleplus'] ) { $googleplus = $qns_data['social_googleplus']; }
	else { $googleplus = ''; }

	if( $qns_data['social_skype'] ) { $skype = $qns_data['social_skype']; }
	else { $skype = ''; }

	if( $qns_data['social_flickr'] ) { $flickr = $qns_data['social_flickr']; }
	else { $flickr = ''; }

	if( $qns_data['social_linkedin'] ) { $linkedin = $qns_data['social_linkedin']; }
	else { $linkedin = ''; }

	if( $qns_data['social_vimeo'] ) { $vimeo = $qns_data['social_vimeo']; }
	else { $vimeo = ''; }

	if( $qns_data['social_youtube'] ) { $youtube = $qns_data['social_youtube']; }
	else { $youtube = ''; }

	if( $qns_data['social_rss'] ) { $rss = $qns_data['social_rss']; }
	else { $rss = ''; }
	
	if( $qns_data['social_instagram'] ) { $rss = $qns_data['social_instagram']; }
	else { $instagram = ''; }
	
	if ( $twitter == '' && $pinterest == '' && $facebook == '' && $googleplus == '' && $skype == '' && $flickr == '' && $linkedin == '' && $vimeo == '' && $youtube == '' && $rss == '' && $instagram == '' ) {
		return true;
	}
}

function display_social() {
	
	global $qns_data; //fetch options stored in $qns_data
	
	if( $qns_data['social_twitter'] ) { $twitter = $qns_data['social_twitter']; }
	else { $twitter = ''; }
	
	if( $qns_data['social_pinterest'] ) { $pinterest = $qns_data['social_pinterest']; }
	else { $pinterest = ''; }

	if( $qns_data['social_facebook'] ) { $facebook = $qns_data['social_facebook']; }
	else { $facebook = ''; }

	if( $qns_data['social_googleplus'] ) { $googleplus = $qns_data['social_googleplus']; }
	else { $googleplus = ''; }

	if( $qns_data['social_skype'] ) { $skype = $qns_data['social_skype']; }
	else { $skype = ''; }

	if( $qns_data['social_flickr'] ) { $flickr = $qns_data['social_flickr']; }
	else { $flickr = ''; }

	if( $qns_data['social_linkedin'] ) { $linkedin = $qns_data['social_linkedin']; }
	else { $linkedin = ''; }

	if( $qns_data['social_vimeo'] ) { $vimeo = $qns_data['social_vimeo']; }
	else { $vimeo = ''; }

	if( $qns_data['social_youtube'] ) { $youtube = $qns_data['social_youtube']; }
	else { $youtube = ''; }

	if( $qns_data['social_rss'] ) { $rss = $qns_data['social_rss']; }
	else { $rss = ''; }
	
	if( $qns_data['social_instagram'] ) { $instagram = $qns_data['social_instagram']; }
	else { $instagram = ''; }
	
	$output = '';
	
	if ( no_icons() !== true ) {
		$output .= '<ul class="social-icons fl">';
	}	

	if( $twitter !== '' ) {
		$output .= '<li><a href="' . $twitter . '" target="_blank"><span id="twitter_icon"></span></a></li>';
	}
	
	if( $pinterest !== '' ) {
		$output .= '<li><a href="' . $pinterest . '" target="_blank"><span id="pinterest_icon"></span></a></li>';
	}

	if( $facebook !== '' ) {
		$output .= '<li><a href="' . $facebook . '" target="_blank"><span id="facebook_icon"></span></a></li>';
	}

	if( $googleplus !== '' ) {
		$output .= '<li><a href="' . $googleplus . '" target="_blank"><span id="googleplus_icon"></span></a></li>';
	}

	if( $skype !== '' ) {
		$output .= '<li><a href="' . $skype . '" target="_blank"><span id="skype_icon"></span></a></li>';
	 }

	if( $flickr !== '' ) {
		$output .= '<li><a href="' . $flickr . '" target="_blank"><span id="flickr_icon"></span></a></li>';
	}

	if( $linkedin !== '' ) {
		$output .= '<li><a href="' . $linkedin . '" target="_blank"><span id="linkedin_icon"></span></a></li>';
	}

	if( $vimeo !== '' ) {
		$output .= '<li><a href="' . $vimeo . '" target="_blank"><span id="vimeo_icon"></span></a></li>';
	}

	if( $youtube !== '' ) {
		$output .= '<li><a href="' . $youtube . '" target="_blank"><span id="youtube_icon"></span></a></li>';
	}

	if( $rss !== '' ) {
		$output .= '<li><a href="' . $rss . '" target="_blank"><span id="rss_icon"></span></a></li>';
	}
	
	if( $instagram !== '' ) {
		$output .= '<li><a href="' . $instagram . '" target="_blank"><span id="instagram_icon"></span></a></li>';
	}

	if ( no_icons() !== true ) {
		$output .= '</ul>';
	}
	
	return $output;
	
}



/* ------------------------------------------------
	WooCommerce Settings
------------------------------------------------ */

/*-----------------------------------------------------------------------------------*/
/* Hook in on activation */
/*-----------------------------------------------------------------------------------*/

global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action('init', 'organic_shop_woocommerce_image_dimensions', 1);

/*-----------------------------------------------------------------------------------*/
/* Define image sizes / hard crop */
/*-----------------------------------------------------------------------------------*/

function organic_shop_woocommerce_image_dimensions() {

// Image sizes
update_option( 'woocommerce_thumbnail_image_width', '600' ); // Image gallery thumbs
update_option( 'woocommerce_thumbnail_image_height', '600' );
update_option( 'woocommerce_single_image_width', '600' ); // Featured product image
update_option( 'woocommerce_single_image_height', '600' );
update_option( 'woocommerce_catalog_image_width', '600' ); // Product category thumbs
update_option( 'woocommerce_catalog_image_height', '600' );

// Hard Crop [0 = false, 1 = true]
update_option( 'woocommerce_thumbnail_image_crop', 1 );
update_option( 'woocommerce_single_image_crop', 1 );
update_option( 'woocommerce_catalog_image_crop', 1 );

}



/* ------------------------------------------------
	Remove width/height dimensions from <img> tags
------------------------------------------------ */

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}



/* ------------------------------------------------
	Disable WooCommerce Breadcrumbs
------------------------------------------------ */

remove_action('woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);



/* ------------------------------------------------
	Disable Product Count on Shop Pages
------------------------------------------------ */

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );



/* ------------------------------------------------
	Disable Catalog Order
------------------------------------------------ */

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );



/* ------------------------------------------------
	This theme supports WooCommerce, woo!
------------------------------------------------ */

add_theme_support( 'woocommerce' );



/* ------------------------------------------------
	Set Number of Items to be Displayed Per Page
------------------------------------------------ */

if ( !empty($qns_data['shop_per_page']) ) :
	$shop_per_page = $qns_data['shop_per_page'];
else :
	$shop_per_page = '9';
endif;

add_filter('loop_shop_per_page', create_function('$cols', 'return ' . $shop_per_page . ';'));



/* ------------------------------------------------
	Change number or products per row to 3
------------------------------------------------ */
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}



/* ------------------------------------------------
	Allow for plugin detection
------------------------------------------------ */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );



/* ------------------------------------------------
	Ajax Cart
------------------------------------------------ */
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment( $fragments ) {
global $woocommerce;
ob_start();
?>
<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'qns'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'qns'), $woocommerce->cart->cart_contents_count);?></a>
<?php
$fragments['a.cart-contents'] = ob_get_clean();
return $fragments;
}