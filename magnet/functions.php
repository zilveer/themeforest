<?php

load_theme_textdomain( 'qode', get_template_directory().'/languages' );

add_editor_style();
add_action('init', 'myStartSession', 1);
add_action('wp_logout', 'myEndSession');
add_action('wp_login', 'myEndSession');

/* Start session */
if (!function_exists('myStartSession')) {
function myStartSession() {
    if(!session_id()) {
        session_start();
    }
		
		if (!empty($_GET['animation']))
			$_SESSION['qode_animation'] = $_GET['animation'];
			
		if (!empty($_GET['home']))
			$_SESSION['qode_home'] = $_GET['home'];
}}

/* End session */

if (!function_exists('myEndSession')) {
function myEndSession() {
    session_destroy ();
}
}


add_filter('widget_text', 'do_shortcode');
add_filter( 'the_excerpt', 'do_shortcode');

define('QODE_ROOT', get_template_directory_uri());
define('QODE_VAR_PREFIX', 'qode_'); 
include_once('widgets/relate_posts_widget.php');
include_once('includes/shortcodes.php');
include_once('includes/qode-options.php');
include_once('includes/custom-fields.php');
include_once('includes/qode-menu.php');

//does woocommerce function exists?
if(function_exists("is_woocommerce")){
	//include woocommerce configuration
	require_once( 'woocommerce/woocommerce_configuration.php' );
}

/* Add css */

if (!function_exists('qode_styles')) {
function qode_styles() {
	global $woocommerce;
	global $qode_options_magnet;
	global $wp_styles;
	wp_enqueue_style("default_style", QODE_ROOT."/style.css");
	wp_enqueue_style("stylesheet", QODE_ROOT."/css/stylesheet.min.css");
	
	wp_enqueue_style('ie7-style',QODE_ROOT . '/css/ie7.min.css');
	$wp_styles->add_data( 'ie7-style', 'conditional', 'IE 7');
	
	wp_enqueue_style('ie8-style',QODE_ROOT . '/css/ie8.min.css');
	$wp_styles->add_data( 'ie8-style', 'conditional', 'IE 8');
	
	wp_enqueue_style('ie9-style',QODE_ROOT . '/css/ie9.min.css');
	$wp_styles->add_data( 'ie9-style', 'conditional', 'IE 9' );
	
	if (isset($woocommerce)) {	
		wp_enqueue_style("woocommerce", QODE_ROOT."/css/woocommerce.min.css");
		wp_enqueue_style("woocommerce_responsive", QODE_ROOT."/css/woocommerce-responsive.min.css");
		wp_enqueue_style("style_dynamic", QODE_ROOT."/css/style_dynamic.php");
		wp_enqueue_style("woocommerce-select2", QODE_ROOT."/css/select2.min.css");
		
		
		$responsiveness = "yes";
		if (isset($qode_options_magnet['responsiveness'])) $responsiveness = $qode_options_magnet['responsiveness'];
		if($responsiveness != "no"):
		
		wp_enqueue_style("responsive", QODE_ROOT."/css/responsive.min.css");
		wp_enqueue_style("style_dynamic_responsive", QODE_ROOT."/css/style_dynamic_responsive.php");
		
		endif;
		
		if($qode_options_magnet['show_toolbar'] == "yes"):
			wp_enqueue_style("toolbar", QODE_ROOT."/css/toolbar.min.css");
			wp_enqueue_style("toolbar_colorpicker", QODE_ROOT."/css/admin/colorpicker.css");
		endif;
		
		wp_enqueue_style("custom_css", QODE_ROOT."/css/custom_css.php");
	}else{
		wp_enqueue_style("style_dynamic", QODE_ROOT."/css/style_dynamic.php");
		
		
		$responsiveness = "yes";
		if (isset($qode_options_magnet['responsiveness'])) $responsiveness = $qode_options_magnet['responsiveness'];
		if($responsiveness != "no"):
		
		wp_enqueue_style("responsive", QODE_ROOT."/css/responsive.min.css");
		wp_enqueue_style("style_dynamic_responsive", QODE_ROOT."/css/style_dynamic_responsive.php");
		
		endif;
		
		if($qode_options_magnet['show_toolbar'] == "yes"):
			wp_enqueue_style("toolbar", QODE_ROOT."/css/toolbar.min.css");
			wp_enqueue_style("toolbar_colorpicker", QODE_ROOT."/css/admin/colorpicker.css");
		endif;
		
		wp_enqueue_style("custom_css", QODE_ROOT."/css/custom_css.php");
	}
	$fonts_array  = array(
						$qode_options_magnet['google_fonts'],
						$qode_options_magnet['h1_google_fonts'],
						$qode_options_magnet['h2_google_fonts'],
						$qode_options_magnet['h3_google_fonts'],
						$qode_options_magnet['h4_google_fonts'],
						$qode_options_magnet['h5_google_fonts'],
						$qode_options_magnet['h6_google_fonts'],
						$qode_options_magnet['text_google_fonts'],
						$qode_options_magnet['menu_google_fonts'],
						$qode_options_magnet['dropdown_google_fonts'],
						$qode_options_magnet['slider_title_google_fonts'],
						$qode_options_magnet['slider_text_google_fonts'],
						$qode_options_magnet['scrollertype2_title_google_fonts'],
						$qode_options_magnet['scrollertype2_text_google_fonts'],
						$qode_options_magnet['scrollertype1_title_google_fonts'],
						$qode_options_magnet['scrollertype1_text_google_fonts'],
						$qode_options_magnet['scrollertype3_title_google_fonts'],
						$qode_options_magnet['scrollertype3_text_google_fonts'],
						$qode_options_magnet['scrollertypecatalog_title_google_fonts'],
						$qode_options_magnet['scrollertypecatalog_text_google_fonts'],
						$qode_options_magnet['button_title_google_fonts'],
						$qode_options_magnet['message_title_google_fonts']
	);
						
	if (isset($qode_options_magnet['dropdown_google_fonts_thirdlvl'])) array_push($fonts_array, $qode_options_magnet['dropdown_google_fonts_thirdlvl']);
	
	$fonts_array=array_diff($fonts_array, array("-1"));
	$google_fonts_string = implode( '|', $fonts_array);
	if(count($fonts_array) > 0) :
		printf("<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic|PT+Sans:400,400italic,700,700italic|%s&subset=latin,latin-ext' type='text/css' />\r\n", str_replace(' ', '+', $google_fonts_string));
	else :
		printf("<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic|PT+Sans:400,400italic,700,700italic&subset=latin,latin-ext' type='text/css' />\r\n");
	endif;
}
}

/* Add js */

if (!function_exists('qode_scripts')) {
function qode_scripts() {
	global $qode_options_magnet;
	global $is_IE;
    global $woocommerce;
        
	wp_enqueue_script("jquery");
	wp_enqueue_script("plugins", QODE_ROOT."/js/plugins.js",array(),false,true);
	if ( $is_IE ) {
		wp_enqueue_script("html5", QODE_ROOT."/js/html5.js",array(),false,true);
	}
	wp_enqueue_script("default_dynamic", QODE_ROOT."/js/default_dynamic.php",array(),false,true);
	wp_enqueue_script("default", QODE_ROOT."/js/default.min.js",array(),false,true);
	wp_enqueue_script("custom_js", QODE_ROOT."/js/custom_js.php",array(),false,true);
	global $wp_scripts;
	$wp_scripts->add_data('comment-reply', 'group', 1 );
	if ( is_singular() ) wp_enqueue_script( "comment-reply");
	
	$has_ajax = false;
	$qode_animation = "";
	if (isset($_SESSION['qode_animation']))
		$qode_animation = $_SESSION['qode_animation'];
	if (($qode_options_magnet['page_transitions'] != "0") && (empty($qode_animation) || ($qode_animation != "no")))
		$has_ajax = true;
	elseif (!empty($qode_animation) && ($qode_animation != "no"))
		$has_ajax = true;
		
	if ($has_ajax) :
		wp_enqueue_script("ajax", QODE_ROOT."/js/ajax.min.js",array(),false,true);
	endif;
	
	if($qode_options_magnet['use_recaptcha'] == "yes") :
	wp_enqueue_script("recaptcha_ajax", "http://www.google.com/recaptcha/api/js/recaptcha_ajax.js",array(),false,true);
	endif;
	
	if($qode_options_magnet['show_toolbar'] == "yes"):
		wp_enqueue_script("toolbar", QODE_ROOT."/js/toolbar.min.js",array(),false,true);
		wp_enqueue_script("toolbar_colorpicker", QODE_ROOT."/js/admin/colorpicker.js",array(),false,true);
	endif;
        
    if($woocommerce) {
        wp_enqueue_script("woocommerce-qode", QODE_ROOT."/js/woocommerce.js",array(),false,true);
        wp_enqueue_script("select2", QODE_ROOT."/js/select2.min.js",array(),false,true);
    }
}
}

add_action('wp_enqueue_scripts', 'qode_styles'); 
add_action('wp_enqueue_scripts', 'qode_scripts');

/* Add admin js and css */

if (!function_exists('my_admin_jquery')) {
function my_admin_jquery() {
		wp_enqueue_script('jquery'); 
		wp_enqueue_style('style', QODE_ROOT.'/css/admin/admin-style.css', false, '1.0', 'screen');
		wp_enqueue_style('colorstyle', QODE_ROOT.'/css/admin/colorpicker.css', false, '1.0', 'screen');
		wp_register_script('colorpickerss', QODE_ROOT.'/js/admin/colorpicker.js', array('jquery'), '1.0.0', false );
		wp_enqueue_script('colorpickerss'); 
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-accordion');
		wp_register_script('default', QODE_ROOT.'/js/admin/default.js', array('jquery'), '1.0.0', false );
		wp_enqueue_script('default'); 
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
	
}
}
add_action('admin_print_scripts', 'my_admin_jquery');


if (!isset( $content_width )) $content_width = 940;

/* Remove Generator from head */

remove_action('wp_head', 'wp_generator'); 

/* Register Menus */

if (!function_exists('register_menus')) {
function register_menus() {
    register_nav_menus(
        array('top-navigation' => __( 'Top Navigation', 'qode')
		)
		
    );
}
}
add_action( 'init', 'register_menus' ); 

/* Add post thumbnails */

if ( function_exists( 'add_theme_support' ) ) { 
add_theme_support( 'post-thumbnails' );
add_image_size( 'blog-type-1-small', 236, 236, true );
add_image_size( 'blog-type-1-medium', 266, 266, true );
add_image_size( 'blog-type-1-big', 360, 360, true );
add_image_size( 'blog-type-3-small', 199, 148, true );
add_image_size( 'blog-type-3-medium', 227, 170, true );
add_image_size( 'blog-type-3-big', 320, 238, true );
add_image_size( 'blog-type-4-small', 318, 237, true );
add_image_size( 'blog-type-4-medium', 360, 268, true );
add_image_size( 'blog-type-4-big', 490, 365, true );
add_image_size( 'blog-type-5-big', 460, 260, true );
add_image_size( 'latest-type-1', 35, 35, true );

}

/* Add feedlinks */

add_theme_support( 'automatic-feed-links' );

/* Qode comments */

if (!function_exists('qode_comment')) {
function qode_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>

<li>                        
	<div class="comment">
	  <div class="image"> <?php echo get_avatar($comment, 60); ?> </div>
	  <div class="text">
		<div class="info"> <span class="left"><?php echo get_comment_author_link(); ?></span> <span class="right"> <?php echo get_comment_date(). " at " . get_comment_time() . " / "; 
										comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?> </span> </div>
		<div class="text_holder"  id="comment-<?php echo comment_ID(); ?>">
		  <?php comment_text() ?>
		</div>
	  </div>
	</div>

                             
                
<?php if ($comment->comment_approved == '0') : ?>
<p><em><?php _e('Your comment is awaiting moderation.', qode); ?></em></p>
<?php endif; ?>                

<?php 
}
}
/* Register Sidebar */

if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'name' => 'Sidebar',
				'id' => 'sidebar',
        'description' => 'Default sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s posts_holder">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));
		register_sidebar(array(
        'name' => 'SidebarPage',
				'id' => 'sidebar_page',
        'description' => 'Sidebar for Page',
        'before_widget' => '<div id="%1$s" class="widget %2$s posts_holder">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));
		register_sidebar(array(
				'name' => 'Header right',
				'id' => 'header_right',
				'description' => 'Header right',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));
		register_sidebar(array(
        'name' => 'WoocommerceSidebar',
				'id' => 'woocommerce_sidebar',
        'description' => 'Sidebar for Woocommerce',
        'before_widget' => '<div id="%1$s" class="widget %2$s posts_holder">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));
		register_sidebar(array(
				'name' => 'Footer column 1',
				'id' => 'footer_column_1',
        'description' => 'Footer column 1',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));
		register_sidebar(array(
				'name' => 'Footer column 2',
				'id' => 'footer_column_2',
        'description' => 'Footer column 2',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));
		register_sidebar(array(
				'name' => 'Footer column 3',
				'id' => 'footer_column_3',
        'description' => 'Footer column 3',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));
		register_sidebar(array(
				'name' => 'Footer column 4',
				'id' => 'footer_column_4',
        'description' => 'Footer column 4',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));
		register_sidebar(array(
        'name' => 'Footer left',
				'id' => 'footer_left',
        'description' => 'Footer left',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
		register_sidebar(array(
        'name' => 'Footer right',
				'id' => 'footer_right',
        'description' => 'Footer right',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
   
}

/* Add class on body for ajax */

if (!function_exists('ajax_classes')) {
function ajax_classes($classes) {
	global $qode_options_magnet;
	$qode_animation="";
	if (isset($_SESSION['qode_animation'])) $qode_animation = $_SESSION['qode_animation'];
	if(($qode_options_magnet['page_transitions'] === "0") && ($qode_animation == "no")) :
		$classes[] = '';
	elseif($qode_options_magnet['page_transitions'] === "1" && (empty($qode_animation) || ($qode_animation != "no"))) :
		$classes[] = 'ajax_updown';
		$classes[] = 'page_not_loaded';
	elseif($qode_options_magnet['page_transitions'] === "2" && (empty($qode_animation) || ($qode_animation != "no"))) :
		$classes[] = 'ajax_fade';
		$classes[] = 'page_not_loaded';
	elseif($qode_options_magnet['page_transitions'] === "3" && (empty($qode_animation) || ($qode_animation != "no"))) :
		$classes[] = 'ajax_updown_fade';
		$classes[] = 'page_not_loaded';
	elseif($qode_options_magnet['page_transitions'] === "4" && (empty($qode_animation) || ($qode_animation != "no"))) :
		$classes[] = 'ajax_curtain';
		$classes[] = 'page_not_loaded';
	elseif(!empty($qode_animation) && $qode_animation != "no") :
		$classes[] = 'page_not_loaded';
	else:
	$classes[] ="";
	endif;

	return $classes;
}
}
add_filter('body_class','ajax_classes');


/* Add class on body boxed layout */

if (!function_exists('boxed_class')) {
function boxed_class($classes) {
	global $qode_options_magnet;
	
	$qode_layout = "";
	if (isset($_SESSION['qode_layout'])) $qode_layout = $_SESSION['qode_layout'];
	
	if($qode_options_magnet['boxed'] == "yes" && (empty($qode_layout) || ($qode_layout != "wide"))) :
		$classes[] = 'boxed';
	else:
	$classes[] ="";
	endif;

	return $classes;
}
}
add_filter('body_class','boxed_class');

/* Excerpt more */

if (!function_exists('qode_excerpt_more')) {
function qode_excerpt_more( $more ) {
    return '...';
}
}
add_filter('excerpt_more', 'qode_excerpt_more');

/* Excerpt lenght */

if (!function_exists('qode_excerpt_length')) {
function qode_excerpt_length( $length ) {
	global $qode_options_magnet;
	if($qode_options_magnet['number_of_chars']){
		 return $qode_options_magnet['number_of_chars'];
	} else {
		return 45;
	}
}
}
add_filter( 'excerpt_length', 'qode_excerpt_length', 999 );

/* Create Portfolio post type */

if (!function_exists('create_post_type')) {
function create_post_type() {
	register_post_type( 'portfolio_page',
		array(
			'labels' => array(
				'name' => __( 'Portfolio','qode' ),
				'singular_name' => __( 'Portfolio Item','qode' ),
				'add_item' => __('New Portfolio Item','qode'),
                'add_new_item' => __('Add New Portfolio Item','qode'),
                'edit_item' => __('Edit Portfolio Item','qode')
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'portfolio_page'),
			'menu_position' => 4,
			'show_ui' => true,
            'supports' => array('author', 'title', 'editor', 'thumbnail', 'excerpt', 'post-formats', 'page-attributes')
		)
	);
	  flush_rewrite_rules();
}
}
add_action( 'init', 'create_post_type' );

/* Create Portfolio Categories */

add_action( 'init', 'create_portfolio_taxonomies', 0 );
if (!function_exists('create_portfolio_taxonomies')) {
function create_portfolio_taxonomies() 
{
   $labels = array(
    'name' => __( 'Portfolio Categories', 'taxonomy general name' ),
    'singular_name' => __( 'Portfolio Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Portfolio Categories','qode' ),
    'all_items' => __( 'All Portfolio Categories','qode' ),
    'parent_item' => __( 'Parent Portfolio Category','qode' ),
    'parent_item_colon' => __( 'Parent Portfolio Category:','qode' ),
    'edit_item' => __( 'Edit Portfolio Category','qode' ), 
    'update_item' => __( 'Update Portfolio Category','qode' ),
    'add_new_item' => __( 'Add New Portfolio Category','qode' ),
    'new_item_name' => __( 'New Portfolio Category Name','qode' ),
    'menu_name' => __( 'Portfolio Categories','qode' ),
  );     

  register_taxonomy('portfolio_category',array('portfolio_page'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'portfolio-category' ),
  ));

}
}

/* Pagination */

if (!function_exists('pagination')) {
function pagination($pages = '', $range = 4, $paged = 1)
{  
	global $qode_options_magnet;
	$showitems = $range+1;  

	if($pages == '')
	{
		 global $wp_query;
		 $pages = $wp_query->max_num_pages;
		 if(!$pages)
		 {
				 $pages = 1;
		 }
	}   

	if(1 != $pages)
	{	
		 echo "<div class='pagination'><div class='blog_prev'><a href='".get_pagenum_link($paged - 1)."'><span class='prev_button'><span class='inner'><span></span></span></a></div><ul>";
		 for ($i=1; $i <= $pages; $i++)
		 {
			 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			 {
					 echo ($paged == $i)? "<li class='active'><span>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive'>".$i."</a></li>";
			 }
		 }
		echo "</ul><div class='blog_next'><a href='".get_pagenum_link($paged + 1)."'><span class='next_button'><span class='inner'><span></span></span></a></div></div>";
	}
}
}
add_filter('the_content', 'shortcode_empty_paragraph_fix');

/* Empty paragraph fix in shortcode */

if (!function_exists('shortcode_empty_paragraph_fix')) {
function shortcode_empty_paragraph_fix($content)
{   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr($content, $array);

    return $content;
}
}

/* Use slider instead of image for post */

if (!function_exists('slider_blog')) {
function slider_blog($post_id) {
	$sliders = get_post_meta($post_id, "qode_sliders", true);		
	$slider = $sliders[1];
	if($slider) {
		$html .= '<div class="flexslider"><ul class="slides">';
		$i=0;
		while ($slider[$i])
		{
			$slide = $slider[$i];
			
			$href = $slide[link];
			$baseurl = home_url();
			$baseurl = str_replace('http://', '', $baseurl);
			$baseurl = str_replace('www', '', $baseurl);
			$host = parse_url($href, PHP_URL_HOST);
			if($host != $baseurl) {
				$target = 'target="_blank"';
			}
			else {
				$target = 'target="_self"';
			}
			
			$html .= '<li class="slide ' . $slide[imgsize] . '">';
			$html .= '<div class="image"><img src="' . $slide[img] . '" alt="' . $slide[title] . '" /></div>';
			
			$html .= '</li>';
			$i++; 
		}
		$html .= '</ul></div>';
	}
	return $html;
}
}

if (!function_exists('compareSlides')) {
function compareSlides($a, $b)
{
	if (isset($a['ordernumber']) && isset($b['ordernumber'])) {
    if ($a['ordernumber'] == $b['ordernumber']) {
        return 0;
    }
    return ($a['ordernumber'] < $b['ordernumber']) ? -1 : 1;
  }
  return 0;
}
}

if (!function_exists('comparePortfolioImages')) {
function comparePortfolioImages($a, $b)
{
	if (isset($a['portfolioimgordernumber']) && isset($b['portfolioimgordernumber'])) {
    if ($a['portfolioimgordernumber'] == $b['portfolioimgordernumber']) {
        return 0;
    }
    return ($a['portfolioimgordernumber'] < $b['portfolioimgordernumber']) ? -1 : 1;
  }
  return 0;
}
}

if (!function_exists('comparePortfolioOptions')) {
function comparePortfolioOptions($a, $b){
	if (isset($a['optionlabelordernumber']) && isset($b['optionlabelordernumber'])) {
    if ($a['optionlabelordernumber'] == $b['optionlabelordernumber']) {
        return 0;
    }
    return ($a['optionlabelordernumber'] < $b['optionlabelordernumber']) ? -1 : 1;
  }
  return 0;
}
}

if(!function_exists('qode_is_woocommerce_installed')) {
	/**
	 * Function that checks if woocommerce is installed
	 * @return bool
	 */
	function qode_is_woocommerce_installed() {
		return function_exists('is_woocommerce');
	}
}

if(!function_exists('qode_get_woocommerce_pages')) {
	/**
	 * Function that returns all url woocommerce pages
	 * @return array array of WooCommerce pages
	 *
	 * @version 0.1
	 */
	function qode_get_woocommerce_pages() {
		$woo_pages_array = array();

		if(qode_is_woocommerce_installed()) {
			if(get_option('woocommerce_shop_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option('woocommerce_shop_page_id')); }
			if(get_option('woocommerce_cart_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option('woocommerce_cart_page_id')); }
			if(get_option('woocommerce_checkout_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option('woocommerce_checkout_page_id')); }
			if(get_option('woocommerce_pay_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option(' woocommerce_pay_page_id ')); }
			if(get_option('woocommerce_thanks_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option(' woocommerce_thanks_page_id ')); }
			if(get_option('woocommerce_myaccount_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option(' woocommerce_myaccount_page_id ')); }
			if(get_option('woocommerce_edit_address_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option(' woocommerce_edit_address_page_id ')); }
			if(get_option('woocommerce_view_order_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option(' woocommerce_view_order_page_id ')); }
			if(get_option('woocommerce_terms_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option(' woocommerce_terms_page_id ')); }

			$woo_products = get_posts(array('post_type' => 'product','post_status' => 'publish', 'posts_per_page' => '-1') );

			foreach($woo_products as $product) {
				$woo_pages_array[] = get_permalink($product->ID);
			}
		}

		return $woo_pages_array;
	}
}

?>