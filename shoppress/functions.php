<?php

/////////////////////////////////////// Theme Information ///////////////////////////////////////

$themename = get_option('current_theme'); // Theme Name
$dirname = 'shoppress'; // Directory Name


/////////////////////////////////////// File Directories ///////////////////////////////////////

define("gp", get_template_directory() . '/');
define("gp_inc", get_template_directory() . '/lib/inc/');
define('gp_child_inc', get_stylesheet_directory() . '/lib/inc/');
define("gp_scripts", get_template_directory() . '/lib/scripts/');
define("gp_admin", get_template_directory() . '/lib/admin/inc/');
define("gp_wc", get_template_directory() . '/woocommerce/');


/////////////////////////////////////// Localisation ///////////////////////////////////////

load_theme_textdomain( 'gp_lang', get_template_directory() . '/languages' );
$gp_locale = get_locale();
$gp_locale_file = get_template_directory() . '/languages/$gp_locale.php';
if ( is_readable( $gp_locale_file ) ) { require_once( $gp_locale_file ); }


/////////////////////////////////////// Theme Setup ///////////////////////////////////////

if ( ! function_exists( 'gp_theme_setup' ) ) {
	function gp_theme_setup() {

		global $content_width;

		// Featured images
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 150, 150, true );

		// Background customizer
		add_theme_support( 'custom-background' );

		// Add shortcode support to Text widget
		add_filter( 'widget_text', 'do_shortcode' );

		// This theme styles the visual editor with editor-style.css to match the theme style
		add_editor_style( 'lib/css/editor-style.css' );

		// Set the content width based on the theme's design and stylesheet
		if ( !isset( $content_width ) ) {
			$content_width = 670;
		}

		// Add default posts and comments RSS feed links to <head>
		add_theme_support( 'automatic-feed-links' );

		// WooCommerce Support
		add_theme_support( 'woocommerce' );

		// Title support
		add_theme_support( 'title-tag' );
		
	}
}
add_action( 'after_setup_theme', 'gp_theme_setup' );


/////////////////////////////////////// Additional Functions ///////////////////////////////////////

// Image Resizer
require_once(gp_scripts . 'aq_resizer/aq_resizer.php');

// Main Theme Options
require_once(gp_admin . 'theme-options.php');
require(gp_inc . 'options.php');

// Meta Options
require_once(gp_admin . 'theme-meta-options.php');

// Other Options
if(is_admin()) { require_once(gp_admin . 'theme-other-options.php'); }

// Sidebars
require_once(gp_admin . 'theme-sidebars.php');

// Shortcodes
require_once(gp_admin . 'theme-shortcodes.php');

// TinyMCE
if(is_admin()) { require_once (gp_admin . 'tinymce/tinymce.php'); }

// WP Show IDs
if(is_admin()) { require_once(gp_admin . 'wp-show-ids/wp-show-ids.php'); }

// Auto Install
if(is_admin()) { require_once(gp_admin . 'theme-auto-install.php'); }

// Woocommerce Functions
if(function_exists('is_woocommerce')) { require_once(gp_wc . 'functions-woocommerce.php'); }

// Load Skins
if(isset($_GET['skin']) && $_GET['skin'] == "default") {
	$skin = $_COOKIE['SkinCookie']; 
	setcookie('SkinCookie', $skin, time()-3600);
	$skin = get_option($dirname.'_skin');
} elseif(isset($_GET['skin'])) {
	$skin = $_GET['skin'];
	setcookie('SkinCookie', $skin);			
} elseif(isset($_COOKIE['SkinCookie'])) {
	$skin = $_COOKIE['SkinCookie']; 
}


/////////////////////////////////////// Enqueue Styles ///////////////////////////////////////

if ( ! function_exists( 'gp_enqueue_styles' ) ) {
	function gp_enqueue_styles() { 

		require(gp_inc . 'options.php'); global $dirname, $skin;

		wp_enqueue_style('reset', get_template_directory_uri().'/lib/css/reset.css');

		wp_enqueue_style('gp-style', get_stylesheet_uri());
	
		if(get_option($dirname.'_responsive') == "0") wp_enqueue_style('responsive', get_template_directory_uri().'/responsive.css');

		wp_enqueue_style('prettyphoto', get_template_directory_uri().'/lib/scripts/prettyPhoto/css/prettyPhoto.css');

		if((isset($_GET['skin']) && $_GET['skin'] != "default") OR (isset($_COOKIE['SkinCookie']) && $_COOKIE['SkinCookie'] != "default")) {
		
			wp_enqueue_style('style-skin', get_template_directory_uri().'/style-'.$skin.'.css');		
	
		} else {

			if((is_singular() && !is_attachment() && !is_404()) && (get_post_meta(get_the_ID(), $dirname.'_skin', true) && get_post_meta(get_the_ID(), $dirname.'_skin', true) != "Default")) {

				wp_enqueue_style('style-skin', get_template_directory_uri().'/style-'.get_post_meta(get_the_ID(), $dirname.'_skin', true).'.css');		

			} else {
	
				wp_enqueue_style('style-skin', get_template_directory_uri().'/style-'.get_option($dirname.'_skin').'.css');
			
			}
	
		}

		if(get_option($dirname.'_custom_stylesheet')) wp_enqueue_style('style-theme-custom', get_template_directory_uri().'/'.get_option($dirname.'_custom_stylesheet'));
	
		if((is_single() OR is_page()) && get_post_meta(get_the_ID(), $dirname.'_custom_stylesheet', true)) wp_enqueue_style('style-page-custom', get_template_directory_uri().'/'.get_post_meta(get_the_ID(), $dirname.'_custom_stylesheet', true));

	}
}
add_action('wp_enqueue_scripts', 'gp_enqueue_styles');


/////////////////////////////////////// Enqueue Scripts ///////////////////////////////////////

if ( ! function_exists( 'gp_enqueue_scripts' ) ) {
	function gp_enqueue_scripts() { 
	
		require(gp_inc . 'options.php');

		wp_enqueue_script('gp-modernizr', get_template_directory_uri().'/lib/scripts/modernizr.js', array('jquery'), '', false);
			
		if(is_singular() && comments_open() && get_option('thread_comments')) wp_enqueue_script('comment-reply');

		wp_enqueue_script('gp-jwplayer', get_template_directory_uri().'/lib/scripts/mediaplayer/jwplayer.js', '', '', false);	
	
		wp_enqueue_script('gp-swfobject', 'https://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js', '', '', true);			

		wp_enqueue_script('gp-jqtransform', get_template_directory_uri().'/lib/scripts/jquery.jqtransform.js', array('jquery'), '', true);
	
		wp_enqueue_script('gp-prettyphoto', get_template_directory_uri().'/lib/scripts/prettyPhoto/js/jquery.prettyPhoto.js', array('jquery'), '', true);
	
		wp_register_script('gp-touchswipe', get_template_directory_uri().'/lib/scripts/jquery.touchSwipe.min.js', array('jquery'), '', true);
													
		wp_register_script('gp-flexslider', get_template_directory_uri().'/lib/scripts/jquery.flexslider.js', array('jquery'), '', true);

		wp_register_script('gp-accordion-init', get_template_directory_uri().'/lib/scripts/jquery.accordion.init.js', array('jquery-ui-accordion'), '', true);

		wp_register_script('gp-contact-init', get_template_directory_uri().'/lib/scripts/jquery.contact.init.js', array('jquery'), '', true);
						
		wp_register_script('gp-tabs-init', get_template_directory_uri().'/lib/scripts/jquery.tabs.init.js', array('jquery-ui-tabs'), '', true);

		wp_register_script('gp-toggle-init', get_template_directory_uri().'/lib/scripts/jquery.toggle.init.js', array('jquery'), '', true);
					
		wp_enqueue_script('gp-custom-js', get_template_directory_uri().'/lib/scripts/custom.js', array('jquery'), '', true);
	
		wp_localize_script('gp-custom-js', 'gp_script', array(
			'rootFolder' => get_template_directory_uri(),
			'navigationText' => __('Navigation', 'gp_lang'),
			'emptySearchText' => __('Please enter something in the search box!', 'gp_lang'),
			 'viewproduct' => __('View Product', 'gp_lang'),
		));		
					
	}
}
add_action('wp_enqueue_scripts', 'gp_enqueue_scripts');


/////////////////////////////////////// WP Header Hooks ///////////////////////////////////////

if ( ! function_exists( 'gp_wp_header' ) ) {
	function gp_wp_header() {
	
		require(gp_inc . 'options.php'); global $dirname;

		// Title fallback for versions earlier than WordPress 4.1
		if ( ! function_exists( '_wp_render_title_tag' ) && ! function_exists( 'gp_render_title' ) ) {
			function gp_render_title() { ?>
				<title><?php wp_title( '|', true, 'right' ); ?></title>
			<?php }
		}
				
		echo '<!--[if lte IE 9]><style>#header{behavior: url("'.get_template_directory_uri().'/lib/scripts/pie/PIE.php");}</style><![endif]-->';

		require_once(gp_inc . 'style-settings.php');

		if(get_option($dirname."_retina") == "0") {
			echo '<script>jQuery(document).ready(function(){window.devicePixelRatio>=2&&jQuery(".post-thumbnail img").each(function(){jQuery(this).attr({src:jQuery(this).attr("data-rel")})})});</script>';
		}
	
		if(function_exists('is_woocommerce')) {
			if(get_option($dirname.'_add_to_cart_button') == "Hide") { echo '<script>jQuery(document).ready(function(){ jQuery("ul.products li.product .add_to_cart_button").remove(); });</script>'; }
			if(get_option($dirname.'_view_product_button') == "Hide") { echo '<script>jQuery(document).ready(function(){ jQuery("ul.products li.product .view_product_button").remove(); });</script>'; }
		}		

		if(get_option($dirname.'_scripts')) { echo stripslashes(get_option($dirname.'_scripts')); }
		
	}
}
add_action('wp_head', 'gp_wp_header');


/////////////////////////////////////// Navigation Menus ///////////////////////////////////////

if ( ! function_exists( 'gp_register_menus' ) ) {
	function gp_register_menus() {
		register_nav_menus(array(
			'header-nav' => __('Header Navigation', 'gp_lang'),
			'body-nav' => __('Body Navigation', 'gp_lang')
		));
	}
}
add_action('init', 'gp_register_menus');

/*************************************** Mobile Navigation Walker ***************************************/	

if ( ! class_exists( 'gp_mobile_menu' ) ) {
	class gp_mobile_menu extends Walker_Nav_Menu {

		var $to_depth = -1;

		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$output .= '</option>';
		}

		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth); // don't output children closing tag
		}

		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){
			$indent = ($depth) ? str_repeat("- ", $depth) : '';
			$class_names = $value = '';
			$classes = empty($item->classes) ? array() : (array) $item->classes;
			$classes[] = 'mobile-menu-item-' . $item->ID;
			$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
			$class_names = ' class="' . esc_attr($class_names) . '"';
			$id = apply_filters('nav_menu_item_id', 'mobile-menu-item-'. $item->ID, $item, $args);
			$id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';
			$value = ' value="'. $item->url .'"';
			$output .= '<option'.$id.$value.$class_names.'>';
			$item_output = $args->before;
			$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
			$output .= $indent.$item_output;
		}

		function end_el( &$output, $item, $depth = 0, $args = array() ) {
			if(substr($output, -9) != '</option>')
				$output .= "</option>"; // replace closing </li> with the option tag
		}

	}
}


/////////////////////////////////////// Excerpts ///////////////////////////////////////

// Character Length
if ( ! function_exists( 'gp_excerpt_length' ) ) {
	function gp_excerpt_length( $gp_length ) {
		return 10000;
	}
}
add_filter( 'excerpt_length', 'gp_excerpt_length' );

// Excerpt Output
if ( ! function_exists( 'gp_excerpt' ) ) {
	function gp_excerpt($count, $ellipsis = '...') {
		$excerpt = get_the_excerpt();
		$excerpt = strip_tags($excerpt);
		if(function_exists('mb_strlen') && function_exists('mb_substr')) { 
			if(mb_strlen($excerpt) > $count) {
				$excerpt = mb_substr($excerpt, 0, $count).$ellipsis;
			}
		} else {
			if(strlen($excerpt) > $count) {
				$excerpt = substr($excerpt, 0, $count).$ellipsis;
			}	
		}
		return $excerpt;
	}
}

// Replace Excerpt Ellipsis
if ( ! function_exists( 'gp_excerpt_more' ) ) {
	function gp_excerpt_more($more) {
		return '';
	}
}
add_filter('excerpt_more', 'gp_excerpt_more');

// Content More Text
if ( ! function_exists( 'gp_more_link' ) ) {
	function gp_more_link($more_link, $more_link_text) {
		return str_replace('more-link', 'more-link read-more', $more_link);
	}
}
add_filter('the_content_more_link', 'gp_more_link', 10, 2);


/////////////////////////////////////// Add Excerpt Support To Pages ///////////////////////////////////////

if ( ! function_exists( 'gp_add_excerpts_to_pages' ) ) {
	function gp_add_excerpts_to_pages() {
		 add_post_type_support( 'page', 'excerpt' );
	}
}
add_action( 'init', 'gp_add_excerpts_to_pages' );


/////////////////////////////////////// Title Length ///////////////////////////////////////

if ( ! function_exists( 'gp_the_title_limit' ) ) {
	function gp_the_title_limit($count, $ellipsis = '...') {
		$title = the_title_attribute( 'echo=0' );
		$title = strip_tags($title);
		if(function_exists('mb_strlen') && function_exists('mb_substr')) { 
			if(mb_strlen($title) > $count) {
				$title = mb_substr($title, 0, $count).$ellipsis;
			}
		} else {
			if(strlen($title) > $count) {
				$title = substr($title, 0, $count).$ellipsis;
			}	
		}
		return $title;
	}
}


/////////////////////////////////////// Change Insert Into Post Text ///////////////////////////////////////	

if ( is_admin() && $pagenow == 'themes.php' ) {
	if ( ! function_exists( 'gp_change_image_button' ) ) {
		add_filter( 'gettext', 'gp_change_image_button', 10, 3);
		function gp_change_image_button( $gp_translation, $gp_text, $gp_domain ) {
			if ( 'default' == $gp_domain && 'Insert into post' == $gp_text ) {
				remove_filter( 'gettext', 'gp_change_image_button' );
				return __( 'Use Image', 'gp_lang' );
			}
			return $gp_translation;
		}
	}
}


/////////////////////////////////////// Page Navigation ///////////////////////////////////////

if ( ! function_exists( 'gp_pagination' ) ) {
	function gp_pagination($pages = '', $range = 2) {  
		 $showitems = ($range * 2)+1;  

		 global $paged;
	 
		 if (get_query_var('paged')) {
			 $paged = get_query_var('paged');
		 } elseif (get_query_var('page')) {
			 $paged = get_query_var('page');
		 } else {
			 $paged = 1;
		 }

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
			echo "<div class='clear'></div><div class='wp-pagenavi cat-navi'>";
			echo '<span class="pages">'.__('Page', 'gp_lang').' '.$paged.' '.__('of', 'gp_lang').' '.$pages.'</span>';
			 if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
			 if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

			 for ($i=1; $i <= $pages; $i++)
			 {
				 if (1 != $pages &&(!($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems))
				 {
					 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
				 }
			 }

			 if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
			 if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
			 echo "</div>\n";
		 }
	}
}


/////////////////////////////////////// Shortcode Empty Paragraph Fix ///////////////////////////////////////

if ( ! function_exists( 'gp_shortcode_empty_paragraph_fix' ) ) {
	function gp_shortcode_empty_paragraph_fix($content) {   
		$array = array (
			'<p>[' => '[', 
			']</p>' => ']',
			']<br />' => ']'
		);
		$content = strtr($content, $array);
		return $content;
	}
}
add_filter('the_content', 'gp_shortcode_empty_paragraph_fix');


/////////////////////////////////////// Breadcrumbs ///////////////////////////////////////

if ( ! function_exists( 'gp_breadcrumbs' ) ) {
	function gp_breadcrumbs() {
		
		global $post;
		
		if (!is_home()) {
			echo '<a href="'.home_url().'">'.__('Home', 'gp_lang').'</a>';
			if (is_category()) {
				echo " &rsaquo; ";
				echo single_cat_title();
			} elseif(is_singular('post') && !is_attachment()) {
				$cat = get_the_category(); $cat = $cat[0];
				echo " &rsaquo; ";
				if(get_the_category()) { 
					$cat = get_the_category(); $cat = $cat[0];
					echo get_category_parents($cat, TRUE, ' &rsaquo; ');
				}
				echo the_title_attribute( 'echo=0' );
			} elseif (is_search()) {
				echo " &rsaquo; ";
				_e('Search', 'gp_lang');
			} elseif (is_page() && $post->post_parent) {
				echo ' &rsaquo; <a href="'.get_permalink($post->post_parent).'">';
				echo get_the_title($post->post_parent);
				echo "</a> &rsaquo; ";
				echo the_title_attribute( 'echo=0' );
			}
			elseif (is_page() OR is_attachment()) {
				echo " &rsaquo; "; 
				echo the_title_attribute( 'echo=0' );
			} elseif (is_404()) {
				echo " &rsaquo; "; 
				_e('Page Not Found', 'gp_lang');
			} else {
				echo " &rsaquo; "; 
				if ( ! function_exists( '_wp_render_title_tag' ) && ! function_exists( 'socialize_render_title' ) ) { 
					_e( 'Archives', 'gp_lang' );
				} else {
					the_archive_title();
				}
			}
		}
	}
}


/////////////////////////////////////// Tab Title Fix For WordPress 4.0.1+  ///////////////////////////////////////	

if ( ! function_exists( 'gp_shortcode_parse_atts' ) ) {
	function gp_shortcode_parse_atts( $text ) {
		$text = str_replace( array( '&#8221;', '&#8243;', '&#8217;', '&#8242;' ), array( '"', '"', '\'', '\'' ), $text );
		return shortcode_parse_atts( $text ) ;
	}
}


/////////////////////////////////////// TMG Plugin Activation ///////////////////////////////////////	

if ( version_compare( phpversion(), '5.2.4', '>=' ) ) {
	require_once( gp_admin . 'class-tgm-plugin-activation.php' );
} else {
	require_once( gp_admin . 'class-tgm-plugin-activation-2.4.2.php' );
}

if ( ! function_exists( 'gp_register_required_plugins' ) ) {

	function gp_register_required_plugins() {

		$plugins = array(

			array(
				'name' => 'ShopPress Plugin',
				'slug' => 'shoppress-plugin',
				'source' => get_template_directory() . '/lib/plugins/shoppress-plugin.zip',
				'required' => true,
				'force_activation' => true,
				'force_deactivation' => false,
				'version' => '1.1'
			),

			array(
				'name' => 'WooCommerce',
				'slug' => 'woocommerce',
				'required' 	=> false,
			),

			array(
				'name'      => 'Yoast SEO',
				'slug'      => 'wordpress-seo',
				'required' 	=> false,
			),
			
		);

		$config = array(
			'default_path' => '',                      // Default absolute path to pre-packaged plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => true,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );

	}
}
add_action('tgmpa_register', 'gp_register_required_plugins');


?>