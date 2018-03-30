<?php
/**
 * Believe functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 */

// Define file directories
define('CH_HOME', get_template_directory());
define('CH_FUNCTIONS', get_template_directory() . '/functions');
define('CH_GLOBAL', get_template_directory() . '/functions/global');
define('CH_WIDGETS', get_template_directory() . '/functions/widgets');
define('CH_CUSTOM_PLUGINS', get_template_directory() . '/functions/plugins');
define('CH_SHORTCODES', get_template_directory() . '/functions/shortcodes');
define('CH_ADMIN', get_template_directory() . '/functions/admin');
define('CH_ADMIN_IMAGES', get_template_directory_uri() . '/functions/admin/images');
define('CH_METABOXES', get_template_directory() . '/functions/admin/metaboxes');
define('CH_SIDEBARS', get_template_directory() . '/functions/admin/sidebars');

// Define theme URI
define('CH_URI', get_template_directory_uri() .'/');
define('CH_GLOBAL_URI', CH_URI . 'functions/global');


define('THEMENAME', 'Charity');
define('SHORTNAME', 'ch');

define('TESTENVIRONMENT', FALSE);

add_action('after_setup_theme', 'ch_setup');
add_filter('widget_text', 'do_shortcode');

// Set max content width
if (!isset($content_width)) {
	$content_width = 900;
}

if (!function_exists('ch_setup')) {

	function ch_setup() {

		// Load Admin elements
		require_once(CH_ADMIN . '/theme-options.php');
		require_once(CH_ADMIN . '/admin-interface.php');
		require_once(CH_ADMIN . '/menu-custom-field.php');
		require_once(CH_ADMIN . '/wysiwyg/wysiwyg.php');
		require_once(CH_FUNCTIONS . '/get-the-image.php');
		require_once(CH_METABOXES . '/layouts.php');
		require_once(CH_METABOXES . '/donations.php');
		require_once(CH_METABOXES . '/video.php');
		require_once(CH_SIDEBARS . '/multiple_sidebars.php');

		// Widgets list
		$widgets = array (
			CH_WIDGETS . '/contactform.php',
			CH_WIDGETS . '/donate.php',
			CH_WIDGETS . '/googlemap.php',
			CH_WIDGETS . '/twitter.php',
			CH_WIDGETS . '/social_links.php',
			CH_WIDGETS . '/advertisement.php',
			CH_WIDGETS . '/recent-posts-plus.php'
		);

		// Load Widgets
		load_files($widgets);

		// Load global elements
		require_once(CH_GLOBAL . '/wp_pagenavi/wp-pagenavi.php');
		require_once(CH_CUSTOM_PLUGINS . '/landing-pages/landing-pages.php');

		// Shortcodes list
		$shortcodes = array (
			CH_SHORTCODES . '/headings.php',
			CH_SHORTCODES . '/quote.php',
			CH_SHORTCODES . '/blog.php',
			CH_SHORTCODES . '/staff.php',
			CH_SHORTCODES . '/causes.php',
			CH_SHORTCODES . '/message-box.php',
			CH_SHORTCODES . '/table.php',
			CH_SHORTCODES . '/buttons.php',
			CH_SHORTCODES . '/typography.php',
			CH_SHORTCODES . '/dividers.php',
			CH_SHORTCODES . '/tabs.php',
			CH_SHORTCODES . '/toggle.php',
			CH_SHORTCODES . '/gallery.php',
			CH_SHORTCODES . '/video.php',
			CH_SHORTCODES . '/columns.php'
		);

		// Load shortcodes
		load_files($shortcodes);

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// Add default posts and comments RSS feed links to <head>.
		add_theme_support('automatic-feed-links');

		// Add support for a variety of post formats
		//add_theme_support('post-formats', array('ac_rehome'));

		// If theme is activated them send to options page
		if (is_admin() && isset($_GET['activated'])) {
			wp_redirect(admin_url('admin.php?page=themeoptions'));
		}
	}
}

// Load Widgets
function load_files ($files) {
	foreach ($files as $file) {
		require_once($file);
	}
}

if (function_exists('add_theme_support')) {
	add_theme_support('post-thumbnails');

	// Default Post Thumbnail dimensions
	set_post_thumbnail_size(150, 150);
}


function tgm_cpt_search( $query ) {
	if ( $query->is_search )
		$query->set( 'post_type', array( 'page', 'post', 'ch_cause', 'ch_staff' ) );
	return $query;
}
add_filter( 'pre_get_posts', 'tgm_cpt_search' );

// Add new image sizes
if ( function_exists('add_image_size')) {
	add_image_size('tiled-slider', 256, 189, true); // tiled slider images size
	add_image_size('content-slider', 675, 385, true); // content slider images size
	add_image_size('blog-image', 665, 185, true); // blog images size
	add_image_size('blog-image-large', 1014, 282, true); // blog-large images size
	add_image_size('staff-image', 417, 249, true); // staff-image images size

	# Gallery image Cropped sizes
	add_image_size('gallery-large', 305, 305, true); // gallery-large gallery size
	add_image_size('gallery-medium', 125, 125, true); // gallery-medium gallery size
	add_image_size('gallery-small', 80, 80, true); // gallery-small gallery size

	# NON-Cropped sizes
	add_image_size('partners-logo', 300, 60); // partners logo size

}

// Public JS scripts
if (!function_exists('ch_scripts_method')) {
	function ch_scripts_method() {
		// wp_deregister_script('jquery');
		// wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js');
		wp_enqueue_script('jquery');
		wp_enqueue_script('master', get_template_directory_uri() . '/js/master.js', array('jquery'), '', TRUE);
		wp_enqueue_script('thickbox');
		wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', TRUE);
		wp_enqueue_script('jcarousel', get_template_directory_uri() . '/js/jquery.jcarousel.js', array('jquery'), '', TRUE);
		wp_enqueue_script('dotdotdot', get_template_directory_uri() . '/js/jquery.dotdotdot-1.5.6-packed.js', array('jquery'), '', true);
		wp_enqueue_script('modernizr.custom.97074', get_template_directory_uri() . '/js/modernizr.custom.97074.js', array('jquery'), '', true);
		wp_enqueue_script('jquery-ui-1.9.2.custom', get_template_directory_uri() . '/js/jquery-ui-1.9.2.custom.js', array('jquery'), '', TRUE);
		wp_deregister_script('hoverIntent');
		wp_enqueue_script('hoverIntent', get_template_directory_uri() . '/js/jquery.hoverIntent.minified.js', array('jquery'), '', TRUE);
		wp_enqueue_script('superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery'), '', TRUE);
		wp_enqueue_script('hoverdir', get_template_directory_uri() . '/js/jquery.hoverdir.js', array('jquery'), '', TRUE);

		if ( is_singular() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_localize_script( 'master', 'my_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	}
}
add_action('wp_enqueue_scripts', 'ch_scripts_method');

// Public CSS files
if (!function_exists('ch_style_method')) {
	function ch_style_method() {
		wp_enqueue_style('master-css', get_stylesheet_directory_uri() . '/style.css');
		wp_enqueue_style('thickbox');
		wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
		wp_enqueue_style('responive', get_template_directory_uri() . '/css/responsive.css');
		wp_enqueue_style('events', get_template_directory_uri() . '/tribe-events/events.css');

		/* Color scheme css */
		wp_enqueue_style('color-schemes-green', get_template_directory_uri() . '/css/color-schemes/teal.css');
		wp_enqueue_style('color-schemes-red', get_template_directory_uri() . '/css/color-schemes/red.css');
		wp_enqueue_style('color-schemes-autum', get_template_directory_uri() . '/css/color-schemes/autum.css');
		wp_enqueue_style('color-schemes-peace', get_template_directory_uri() . '/css/color-schemes/peace.css');
	}
}
add_action('wp_enqueue_scripts', 'ch_style_method');
add_action('wp_head', 'ch_style_method');

/* Filter categories */
function filter_categories($list) {

	$find    = '(';
	$replace = '[';
	$list    = str_replace( $find, $replace, $list );
	$find    = ')';
	$replace = ']';
	$list    = str_replace( $find, $replace, $list );

	return $list;
}
add_filter('wp_list_categories', 'filter_categories');

/*function custom_tag_cloud_widget($args) {
	$args['orderby'] = 'count';
	$args['order'] = 'DESC';
	$args['smallest'] = 10;
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'custom_tag_cloud_widget' );*/

// Custom Login Logo
function ch_login_logo() {
	$login_logo = get_option('ch_login_logo');

	if ($login_logo != false) {
		echo '
	<style type="text/css">
		#login h1 a { background-image: url("' . $login_logo . '") !important; }
	</style>';
	}
}
add_action('login_head', 'ch_login_logo');

// Admin CSS
function ch_admin_css() {
	wp_enqueue_style( 'ch-admin-css', get_template_directory_uri() . '/functions/admin/css/wp-admin.css' );
}

add_action('admin_head','ch_admin_css');

// Sets the post excerpt length to 40 words.
function ch_excerpt_length($length) {
	return 40;
}
add_filter('excerpt_length', 'ch_excerpt_length');

// Returns a "Continue Reading" link for excerpts
function ch_continue_reading_link() {
	return ' <a href="' . esc_url(get_permalink()) . '">' . __('Continue reading <span class="meta-nav">&rarr;</span>', 'ch') . '</a>';
}

// Replaces "[...]" with an ellipsis.
function ch_auto_excerpt_more($more) {
	return ' &hellip;' . ch_continue_reading_link();
}
add_filter('excerpt_more', 'ch_auto_excerpt_more');

// Adds a pretty "Continue Reading" link to custom post excerpts.
function ch_custom_excerpt_more($output) {
	if (has_excerpt() && !is_attachment()) {
		$output .= ch_continue_reading_link();
	}
	return $output;
}
add_filter('get_the_excerpt', 'ch_custom_excerpt_more');

function my_widget_class($params) {

	// its your widget so you add  your classes
	$classe_to_add = (strtolower(str_replace(array(' '), array(''), $params[0]['widget_name']))); // make sure you leave a space at the end
	$classe_to_add = 'class=" '.$classe_to_add . ' ';
	$params[0]['before_widget'] = str_replace('class="', $classe_to_add, $params[0]['before_widget']);

	return $params;
}
add_filter('dynamic_sidebar_params', 'my_widget_class');

// Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
function ch_page_menu_args($args) {
	$args['show_home'] = true;
	return $args;
}
add_filter('wp_page_menu_args', 'ch_page_menu_args');


// Register menus
function register_ch_menus () {
	register_nav_menus(
		array (
			'primary-menu' => __('Primary Menu', 'ch'),
			'bottom-menu'  => __('Bottom Menu', 'ch')
		)
	);
}
add_action('init', 'register_ch_menus');

// Adds classes to the array of body classes.
function ch_body_classes($classes) {

	if ( class_exists('RevSliderOutput') ) {
		$slider_widget = get_option('widget_rev-slider-widget');

		if ( !empty($slider_widget) ) {
			$rev_slider_options = array_values(get_option('widget_rev-slider-widget'));
			$rev_slider_options = $rev_slider_options[0];

			$homepageCheck = $rev_slider_options["rev_slider_homepage"];
			$homepage = "";
			if($homepageCheck == "on")
				$homepage = "homepage";

			$pages = $rev_slider_options["rev_slider_pages"];
			if(!empty($pages)){
				if(!empty($homepage))
					$homepage .= ",";
				$homepage .= $pages;
			}
			$rev_slider = new RevSliderOutput();

			if ( $rev_slider->isPutIn($homepage) && !empty($homepage) ) {
				$classes[] = 'page-with-rev-slider-widget';
			}
		}
	}
	
	if (is_singular() && !is_home()) {
		$classes[] = 'singular';
	}

	if (is_search()) {
		$search_key = array_search('search', $classes);
		if ($search_key !== false) {
			unset($classes[$search_key]);
		}
	}

	// Color scheme class
	$ch_color_scheme = get_theme_mod( 'ch_color_scheme');
	if ( !empty($ch_color_scheme) ) {
		$classes[] = $ch_color_scheme;
	}

	// Layout (layout-boxed, layout-wide)
	$ch_site_layout_style = get_option( 'ch_site_layout_style');
	if ( empty($ch_site_layout_style) || $ch_site_layout_style == 'boxed' ) {
		$classes[] = 'layout-boxed';
	} else {
		$classes[] = 'layout-wide';
	}

	// If blog shortcode
	global $post;
	if (isset($post->post_content) && false !== stripos($post->post_content, '[blog')) {
		$classes[] = 'page-template-blog';
	}

	return $classes;
}
add_filter('body_class', 'ch_body_classes');

function ch_css_settings() {

	// Vars
	$css        = array();
	$custom_css = get_option('ch_custom_css');

	// Custom CSS
	if(!empty($custom_css)) {
		array_push($css, $custom_css);
	}

		echo "
		<!-- Custom CSS -->
		<style type='text/css'>\n";

		if(!empty($css)) {
			foreach($css as $css_item) {
				echo $css_item . "\n";
			}
		}

		$fonts[SHORTNAME . "_primary_font_dark"]  = '.content p, .content dt, .content dl, .content li, .content table td, .content table th, .accordion-inner, .tab-pane, .video_frame, .breadcrumb, .sidebar-inner .widget .news-item .date, .sidebar-inner .widget li';
		$fonts[SHORTNAME . "_headings_font_h1"]   = 'h1, .page-title h1';
		$fonts[SHORTNAME . "_headings_font_h2"]   = 'h2, .content .entry-title a';
		$fonts[SHORTNAME . "_headings_font_h3"]   = 'h3';
		$fonts[SHORTNAME . "_headings_font_h4"]   = 'h4';
		$fonts[SHORTNAME . "_headings_font_h5"]   = 'h5';
		$fonts[SHORTNAME . "_headings_font_h6"]   = 'h6';
		$fonts[SHORTNAME . "_footer_heading"]     = '.footer-links-container h4';
		$fonts[SHORTNAME . "_footer_text"]        = '.footer-links-container p, .footer-links-container li, .footer-links-container span, .footer-links-container .widget .tweet_list .tweet_text,
													.footer-links-container #calendar_wrap #wp-calendar caption,
													.footer-links-container #calendar_wrap #wp-calendar td,
													.footer-links-container #calendar_wrap #wp-calendar th';
		$fonts[SHORTNAME . "_links_font"]         = '.content a:not(.btn, .entry-title a), .sidebar-inner a:not(.btn, .entry-title a), .sidebar-inner #calendar_wrap #wp-calendar a, .footer-links-container .widget .tagcloud a';
		$fonts[SHORTNAME . "_footer_links"]       = '.footer-links-container .footer-links ul li a,
													.footer-links-container #calendar_wrap #wp-calendar a';

		// Custom fonts styling
		foreach ($fonts as $key => $font) {
			$output                 = '';
			$current['font-family'] = get_option($key . '_font_face');
			$current['font-size']   = get_option($key . '_font_size');
			$current['line-height'] = get_option($key . '_line_height');
			$current['color']       = get_option($key . '_font_color');
			$current['font-weight'] = get_option($key . '_weight');

			foreach ($current as $kkey => $item) {
				$ending = '';
				$before = '';
				if (!empty($item)) {

					if ($kkey == 'font-size' || $kkey == 'line-height') {
						$ending = 'px';
					} else if ($kkey == 'color') {
						$before = '#';
					} else if ($kkey == 'font-family') {
						$before = "'";
						$ending = "'";
						$item   = str_replace("+", " ", $item);
					} else if ($kkey == 'font-weight' && $item == 'italic') {
						$kkey = 'font-style';
					} else if ($kkey == 'font-weight' && $item == 'bold_italic') {
						$kkey = 'font-style';
						$item = 'italic; font-weight: bold';
					}


					$output .= " " . $kkey . ": " . $before . $item . $ending . ";";
				}
			}
			if (!empty($output) && !empty($font)) {
				echo $font . ' { ' . $output . ' }';
			}
		}
		$breadcrumbs = get_option('ch_breadcrumb');
		if ( $breadcrumbs != 'true' ) {
			echo '
			.page-title {
				min-height: 95px;
			}';
		}

		$tiled_image_effect = get_option('ch_tiled_image_effect');
		if ( empty($tiled_image_effect) || $tiled_image_effect == 'black_and_white' ) {
			echo '
			.tiles-slider .tiles-ul li a img {
				filter: grayscale(80%); /* Current draft standard */
				-webkit-filter: grayscale(80%); /* New WebKit */
				-moz-filter: grayscale(80%);
				-ms-filter: grayscale(80%);
				-o-filter: grayscale(80%); /* Not yet supported in Gecko, Opera or IE */
				filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); /* Firefox 3.5+ */
				filter: gray; /* IE */
				-webkit-filter: grayscale(0.8); /* Old WebKit */
			}';
		}

		echo "</style>\n";

}
add_action('wp_head','ch_css_settings', 99);

if (!function_exists('ch_posted_on')) {

	// Prints HTML with meta information for the current post.
	function ch_posted_on() {
		printf(__('<span>Posted: </span><a href="%1$s" title="%2$s" rel="bookmark">%4$s</a><span class="by-author"> by <a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span>', 'ac'),
			esc_url(get_permalink()),
			esc_attr(get_the_time()),
			esc_attr(get_the_date('c')),
			esc_html(get_the_date()),
			esc_url(get_author_posts_url(get_the_author_meta('ID'))),
			sprintf(esc_attr__('View all posts by %s', 'ch'), get_the_author()),
			esc_html(get_the_author())
		);
	}
}

function clear_nav_menu_item_id($id, $item, $args) {
	return "";
}
add_filter('nav_menu_item_id', 'clear_nav_menu_item_id', 10, 3);

function add_nofollow_cat( $text ) {
	$text = str_replace('rel="category"', "", $text);
	return $text;
}
add_filter( 'the_category', 'add_nofollow_cat' );

function ajax_contact() {
	if(!empty($_POST)) {
		$sitename = get_bloginfo('name');
		$siteurl  = home_url();
		$to       = isset($_POST['contact_to'])? trim($_POST['contact_to']) : '';
		$name     = isset($_POST['contact_name'])? trim($_POST['contact_name']) : '';
		$email    = isset($_POST['contact_email'])? trim($_POST['contact_email']) : '';
		$content  = isset($_POST['contact_content'])? trim($_POST['contact_content']) : '';

		$error = false;
		$error = ($to === '' || $email === '' || $content === '' || $name === '') ||
				 (!preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $email)) ||
				 (!preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $to));

		if($error == false) {
			$subject = "$sitename message from $name";
			$body    = "Site: $sitename ($siteurl) \n\nName: $name \n\nEmail: $email \n\nMessage: $content";
			$headers = "From: $name ($sitename) <$email>\r\nReply-To: $email\r\n";
			$sent    = wp_mail($to, $subject, $body, $headers);

			// If sent
			if ($sent) {
				echo 'sent';
				die();
			} else {
				echo 'error';
				die();
			}
		} else {
			echo _e('Please fill all fields!', 'ch');
			die();
		}
	}
}
add_action('wp_ajax_nopriv_contact_form', 'ajax_contact');
add_action('wp_ajax_contact_form', 'ajax_contact');

function addhttp($url) {
	if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
		$url = "http://" . $url;
	}
	return $url;
}

function checkShortcode($string) {
	global $post;
	if (isset($post->post_content) && false !== stripos($post->post_content, $string)) {
		return true;
	} else {
		return false;
	}
}

/* ch_cause Post Type */

function create_post_type() {
	$labels = array(
		'name'               => 'Causes',
		'singular_name'      => 'Cause',
		'add_new'            => 'Add New',
		'all_items'          => 'All Causes',
		'add_new_item'       => 'Add New Cause',
		'edit_item'          => 'Edit Cause',
		'new_item'           => 'New Cause',
		'view_item'          => 'View Cause',
		'search_items'       => 'Search Causes',
		'not_found'          =>  'No Causes found',
		'not_found_in_trash' => 'No Causes found in trash',
		'parent_item_colon'  => 'Parent Cause:',
		'menu_name'          => 'Causes'
	);
	$args = array(
		'labels'              => $labels,
		'description'         => "A description for your cause type",
		'public'              => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_nav_menus'   => false,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'menu_icon'           => null,
		'capability_type'     => 'post',
		'hierarchical'        => true,
		'supports'            => array('title','editor','thumbnail','custom-fields','page-attributes'),
		'has_archive'         => false,
		'rewrite'             => false,
		'query_var'           => false,
		'can_export'          => true
	);
	register_post_type('ch_cause', $args);
	flush_rewrite_rules();
}
add_action('init', 'create_post_type');

/* ch_staff Post Type */

function create_staff_post_type() {
	$labels = array(
		'name'               => 'Staff',
		'singular_name'      => 'Staff',
		'add_new'            => 'Add New',
		'all_items'          => 'All Staff',
		'add_new_item'       => 'Add New member',
		'edit_item'          => 'Edit member',
		'new_item'           => 'New member',
		'view_item'          => 'View member',
		'search_items'       => 'Search staff',
		'not_found'          => 'No staff found',
		'not_found_in_trash' => 'No staff found in trash',
		'parent_item_colon'  => 'Parent staff:',
		'menu_name'          => 'Staff'
	);
	$args = array(
		'labels'              => $labels,
		'description'         => "A description for your staff type",
		'public'              => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_nav_menus'   => false,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'menu_icon'           => null,
		'capability_type'     => 'post',
		'hierarchical'        => true,
		'supports'            => array('title','editor','thumbnail','custom-fields','page-attributes'),
		'has_archive'         => false,
		'rewrite'             => false,
		'query_var'           => false,
		'can_export'          => true
	);
	register_post_type('ch_staff', $args);
	flush_rewrite_rules();
}
add_action('init', 'create_staff_post_type');

function member_position_meta_box() {
	add_meta_box("ch_staff-meta", "Member position", "ch_staff_meta_options", "ch_staff", "side", "low");
}
add_action("admin_init", "member_position_meta_box");

function ch_staff_meta_options() {
	global $post;
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
	$custom          = get_post_custom($post->ID);
	$member_position = $custom["member_position"][0];
?>
	<label>Member position:</label> <input name="member_position" value="<?php echo $member_position; ?>" />
<?php
}

function save_member_position() {
	global $post;

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return $post_id;
	} elseif( !empty( $_POST ) && isset($_POST["member_position"]) ) {
		update_post_meta($post->ID, "member_position", $_POST["member_position"]);
	}
}
add_action('save_post', 'save_member_position');

function the_content_filter($content) {

	// array of Believe theme custom shortcodes requiring the fix
	// all other which are not included in this list will NOT be affected
	$block = join( "|",
				array(
					"list",
					"alert-message",
					"alert-success",
					"alert-error",
					"alert-info",
					"custom_table",
					"custom_message",
					"toggle",
					"accordions",
					"blog",
					"one_half",
					"one_third",
					"one_fourth",
					"one_fifth",
					"one_sixth",
					"two_thirds",
					"three_fourths",
					"two_fifths",
					"three_fifths",
					"four_fifths",
					"five_sixths",
					"one_half_last",
					"one_third_last",
					"one_fourth_last",
					"one_fifth_last",
					"one_sixth_last",
					"two_thirds_last",
					"three_fourths_last",
					"two_fifths_last",
					"three_fifths_last",
					"four_fifths_last",
					"five_sixths_last"
				)
			 );

	// opening tag
	$rep = preg_replace( "/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content );

	// closing tag
	$rep = preg_replace( "/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", "[/$2]", $rep );

	return $rep;
}
add_filter("the_content", "the_content_filter");

// custom comment fields
function ch_custom_comment_fields($fields) {
	global $post, $commenter;

	$fields['author'] = '<p class="comment-form-author">
							<input id="author" name="author" type="text" class="span9" placeholder="' . __( 'Name', 'ch' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" aria-required="true" size="30" />
						 </p>';

	$fields['email'] = '<p class="comment-form-email">
							<input id="email" name="email" type="text" class="span9" placeholder="' . __( 'Email', 'ch' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '" aria-required="true" size="30" />
						</p>';

	$fields['url'] = '<p class="comment-form-url">
						<input id="url" name="url" type="text" class="span9" placeholder="' . __( 'Website', 'ch' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />
					  </p>';

	$fields = array( $fields['author'], $fields['email'], $fields['url'] );
	return $fields;
}
add_filter( 'comment_form_default_fields', 'ch_custom_comment_fields' );

if ( ! function_exists( 'ch_comment' ) ) {
	/**
	 * Template for comments and pingbacks.
	 *
	 * To override this walker in a child theme without modifying the comments template
	 * simply create your own ac_comment(), and that function will be used instead.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 */
	function ch_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		<li class="post pingback">
			<p><?php _e( 'Pingback:', 'ch' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'ch' ), '<span class="edit-link button blue">', '</span>' ); ?></p>
		<?php
				break;
			default :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>" class="comment">
				<div class="comment-meta">
					<div class="comment-author vcard">
						<?php
							$avatar_size = 50;

							echo get_avatar( $comment, $avatar_size );

							/* translators: 1: comment author, 2: date and time */
							printf( __( '%1$s <span class="sep">|</span> %2$s ', 'ch' ),
								sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
								sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
									esc_url( get_comment_link( $comment->comment_ID ) ),
									get_comment_time( 'c' ),
									/* translators: 1: date, 2: time */
									sprintf( __( '%1$s at %2$s', 'ch' ), get_comment_date(), get_comment_time() )
								)
							);
						?>
					</div><!-- .comment-author .vcard -->

					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'ac' ); ?></em>
						<br />
					<?php endif; ?>

				</div>

				<div class="comment-content">
					<?php comment_text(); ?>
					<div class="reply-edit-container">
						<span class="reply">
							<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'ch' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</span><!-- end of reply -->
						<?php edit_comment_link( __( 'Edit', 'ch' ), '<span class="edit-link button blue">', '</span>' ); ?>
					</div>
					<div class="clearer"></div>
				</div>
			</div><!-- end of comment -->

		<?php
				break;
		endswitch;
	}
}

function ch_breadcrumbs() {

	$disable_breadcrumb = get_option('ch_breadcrumb') ? get_option('ch_breadcrumb') : 'false';
	$delimiter = get_option('ch_breadcrumb_delimiter') ? get_option('ch_breadcrumb_delimiter') : '<span class="delimiter">></span>';
	$custom_post = get_option('ch_breadcrumb_custom', 'ch_staff:1270:ch_cause:1695');
	$array = explode(':',$custom_post);
	$array2 = array_chunk($array,2);
	$simple = 'true';

	$home = 'Home'; // text for the 'Home' link
	$before = '<span class="current">'; // tag before the current crumb
	$after = '</span>'; // tag after the current crumb

	if (!is_home() && !is_front_page() && $disable_breadcrumb == 'false') {
		global $post;
		$homeLink = home_url();

		$output = '<div class="breadcrumb">';
		$output .= '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

		if (is_category()) {
			global $wp_query;
			$cat_obj   = $wp_query->get_queried_object();
			$thisCat   = $cat_obj->term_id;
			$thisCat   = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0)
				$output .= get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' ');
			$output .= $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
		} elseif (is_day()) {
			$output .= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			$output .= '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			$output .= $before . get_the_time('d') . $after;
		} elseif (is_month()) {
			$output .= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			$output .= $before . get_the_time('F') . $after;
		} elseif (is_year()) {
			$output .= $before . get_the_time('Y') . $after;
		} elseif (is_single() && !is_attachment()) {
			if (get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				foreach ($array2 as $value) {
					if ( get_post_type() == $value[0] ) {
						$output .= '<a href="' . get_permalink( $value[1] ) . '">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
						$simple = 'false';
					}
				}
				if ($simple == 'true') {
					$output .= '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
				}
				// if ( get_post_type() == $custom_post_type ) {
				// 	$output .= '<a href="' . get_permalink( $custom_redirect ) . '">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
				// } else {
				// 	$output .= '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
				// }
				$output .= $before . get_the_title() . $after;
			} else {
				$cat = get_the_category();
				$cat = $cat[0];
				$output .= get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				$output .= $before . get_the_title() . $after;
			}
		} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
			$post_type = get_post_type_object(get_post_type());
			$output .= $before . $post_type->labels->singular_name . $after;
		} elseif (is_attachment()) {
			$parent = get_post($post->post_parent);
			$cat    = get_the_category($parent->ID);
			if ( isset($cat[0]) ) {
				$cat = $cat[0];
			}

			//$output .= get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			$output .= '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
			$output .= $before . get_the_title() . $after;
		} elseif (is_page() && !$post->post_parent) {
			$output .= $before . get_the_title() . $after;
		} elseif (is_page() && $post->post_parent) {
			$parent_id   = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page          = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id     = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) {
				$output .= $crumb . ' ' . $delimiter . ' ';
			}
			$output .= $before . get_the_title() . $after;
		} elseif (is_search()) {
			$output .= $before . 'Search results for "' . get_search_query() . '"' . $after;
		} elseif (is_tag()) {
			$output .= $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
		} elseif (is_author()) {
			global $ch_author;
			$userdata = get_userdata($ch_author);
			$output .= $before . 'Articles posted by ' . $userdata->display_name . $after;
		} elseif (is_404()) {
			$output .= $before . 'Error 404' . $after;
		}

		if (get_query_var('paged')) {
			if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
				$output .= ' (';
			$output .= __('Page', 'ch') . ' ' . get_query_var('paged');
			if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
				$output .= ')';
		}

		$output .= '</div>';

		return $output;
	}
}

/*
 * This theme supports custom background color and image, and here
 * we also set up the default background color.
 */
add_theme_support( 'custom-background', array(
	'default-color' => '060606',
) );

/**
 * Add postMessage support for the Theme Customizer.
 */
function ch_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$wp_customize->add_section( 'color_scheme_section', array(
		'title'    => __( 'Color Scheme', 'ch' ),
		'priority' => 35,
	) );

	$wp_customize->add_setting( 'ch_color_scheme', array(
		'default'   => 'blue-color-scheme',
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new Customize_Scheme_Control( $wp_customize, 'ch_color_scheme', array(
		'label'    => 'Choose color scheme',
		'section'  => 'color_scheme_section',
		'settings' => 'ch_color_scheme',
	) ) );

	// Layouts (boxed, wide)
	$wp_customize->add_section( 'ch_layout_section' , array(
		'title'       => __('Layouts', 'ch'),
		'priority'    => 30,
		'description' => __( 'Please choose your desired layout type', 'themename' ),
	) );

	$wp_customize->add_setting( 'ch_site_layout_style' , array(
		'default'   => 'boxed',
		'type'      => 'option',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'ch_site_layout_style', array(
			'label'    => __( 'Layout style', 'ch' ), //Admin-visible name of the control
			'section'  => 'ch_layout_section', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
			'settings' => 'ch_site_layout_style',
			'type'     => 'radio',
			'choices'  => array(
				'boxed' => 'boxed',
				'wide'  => 'semi wide',
			),
		)
	);
}
add_action( 'customize_register', 'ch_customize_register' );

/**
 * Binds CSS and JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ch_customize_preview_js_css() {
	wp_enqueue_script( 'ch-customizer-js', get_template_directory_uri() . '/functions/admin/js/theme-customizer.js', array( 'jquery', 'customize-preview' ), '20130101', true );
}
add_action( 'customize_preview_init', 'ch_customize_preview_js_css' );


if (class_exists('WP_Customize_Control')) {
	class Customize_Scheme_Control extends WP_Customize_Control {
		public $type = 'radio';

		public function render_content() {
		?>
			<style>

				/* Customizer */

				.input_hidden {
					position: absolute;
					left: -9999px;
				}

				.radio-images img {
					border: 2px solid #fff;
				}

				.radio-images img.selected {
					border: 2px solid #888;
					border-radius: 5px;
				}

				.radio-images label {
					display: inline-block;
					cursor: pointer;
				}
			</style>
			<script type="text/javascript">
				jQuery('.radio-images input:radio').addClass('input_hidden');
				jQuery('.radio-images img').live('click', function() {
					jQuery('.radio-images img').removeClass('selected');
					jQuery(this).addClass('selected');
				});
			</script>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<div class="radio-images">
				<input type="radio" class="input_hidden" name="ch_color_scheme" <?php $this->link(); ?> id="blue-color-scheme" value="blue-color-scheme" />
				<label for="blue-color-scheme">
					<img src="<?php echo get_template_directory_uri() . '/functions/admin/images/schemes/color-scheme-blue.png'; ?>"<?php echo ( $this->value() == 'blue-color-scheme' ) ? ' checked="checked" class="selected"' : ''; ?> style="width: 50px; height: 50px;" alt="Blue Color Scheme" />
				</label>
				<input type="radio" class="input_hidden" name="ch_color_scheme" <?php $this->link(); ?> id="teal-color-scheme" value="teal-color-scheme" />
				<label for="teal-color-scheme">
					<img src="<?php echo get_template_directory_uri() . '/functions/admin/images/schemes/color-scheme-teal.png'; ?>"<?php echo ( $this->value() == 'teal-color-scheme' ) ? ' checked="checked" class="selected"' : ''; ?> style="width: 50px; height: 50px;" alt="Teal Color Scheme" />
				</label>
				<input type="radio" class="input_hidden" name="ch_color_scheme" <?php $this->link(); ?> id="red-color-scheme" value="red-color-scheme" />
				<label for="red-color-scheme">
					<img src="<?php echo get_template_directory_uri() . '/functions/admin/images/schemes/color-scheme-red.png'; ?>"<?php echo ( $this->value() == 'red-color-scheme' ) ? ' checked="checked" class="selected"' : ''; ?> style="width: 50px; height: 50px;" alt="Red Color Scheme" />
				</label>
				<input type="radio" class="input_hidden" name="ch_color_scheme" <?php $this->link(); ?> id="autum-color-scheme" value="autum-color-scheme" />
				<label for="autum-color-scheme">
					<img src="<?php echo get_template_directory_uri() . '/functions/admin/images/schemes/color-scheme-autum.png'; ?>"<?php echo ( $this->value() == 'autum-color-scheme' ) ? ' checked="checked" class="selected"' : ''; ?> style="width: 50px; height: 50px;" alt="Autum Color Scheme" />
				</label>
				<input type="radio" class="input_hidden" name="ch_color_scheme" <?php $this->link(); ?> id="peace-color-scheme" value="peace-color-scheme" />
				<label for="peace-color-scheme">
					<img src="<?php echo get_template_directory_uri() . '/functions/admin/images/schemes/color-scheme-peace.png'; ?>"<?php echo ( $this->value() == 'peace-color-scheme' ) ? ' checked="checked" class="selected"' : ''; ?> style="width: 50px; height: 50px;" alt="Peace Color Scheme" />
				</label>
			</div>
		<?php
		}
	}
}