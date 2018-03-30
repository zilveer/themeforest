<?php
/*-------------------------------------------------------------------------*/
/* Inject Theme path to JS scripts */
/*-------------------------------------------------------------------------*/
function path_to_js_script() { 
	// Load only if its theme options
	if ('admin.php' == basename($_SERVER['PHP_SELF'])) {
	?>
		<script type="text/javascript">
		var mtheme_uri="<?php echo get_stylesheet_directory_uri(); ?>";
		</script>
		<?php
	}
}
add_action('admin_head', 'path_to_js_script');
/*-------------------------------------------------------------------------*/
/* Enable shortcodes to Text Widgets */
/*-------------------------------------------------------------------------*/
add_filter('widget_text', 'do_shortcode');
/*-------------------------------------------------------------------------*/
/* Excerpt Lenght */
/*-------------------------------------------------------------------------*/
function new_excerpt_length($length) {
	return 80;
}
add_filter('excerpt_length', 'new_excerpt_length');
/*-------------------------------------------------------------------------*/
/* Add default posts and comments RSS feed links to head */
/*-------------------------------------------------------------------------*/
add_theme_support( 'automatic-feed-links' );
/*-------------------------------------------------------------------------*/
/* Add Post Thumbnails */
/*-------------------------------------------------------------------------*/
if (function_exists('add_theme_support')) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 90, true ); // default thumbnail size
	add_image_size('post-image', 600, 1024); // for post images
	add_image_size('featured', 960, 1024); // for featured

	add_image_size('featured-thumbnail', 169, 90,true); // for featured
	add_image_size('portfolio-four', 185, 142,true); // Portfolio
	add_image_size('portfolio-three', 260, 150,true); // Portfolio
	add_image_size('portfolio-two', 410, 272,true); // Portfolio
	add_image_size('portfolio-one', 560, 472,true); // Portfolio

	add_image_size('sidebar-thumbnail', 95, 65,true); // Sidebar
	add_image_size('sidebar-gallery', 68, 68,true); // Sidebar
	add_image_size('blog-post', 580, '',true); // Blog post cropped
	add_image_size('blog-full', 960, '',true); // Blog post images
}
/*-------------------------------------------------------------------------*/
/* Internationalize for easy localizing */
/*-------------------------------------------------------------------------*/
load_theme_textdomain( 'mthemelocal', TEMPLATEPATH . '/languages' );
$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );
/*-------------------------------------------------------------------------*/
/* Enqueue comment reply script */
/*-------------------------------------------------------------------------*/
function mtheme_comment_reply() {
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
}
add_action('get_header', 'mtheme_comment_reply');
/*-------------------------------------------------------------------------*/
/* Admin Functions
/*-------------------------------------------------------------------------*/
function load_admin_functions() {
	//require_once (FRAMEWORK_FUNCTIONS . 'shortcodesGenerator.php');
}
/*-------------------------------------------------------------------------*/
/* Admin JS and CSS */
/*-------------------------------------------------------------------------*/
function mtheme_adminscripts() {
	// Load only if its theme options
	if (function_exists('add_thickbox')) add_thickbox();
	$file_dir=get_template_directory_uri();
	wp_enqueue_style("styles", $file_dir ."/framework/admin/css/style.css", false, "1.0", "all");
	
	if ('edit.php' == basename($_SERVER['PHP_SELF'])) {
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script("post-sorter", $file_dir."/framework/admin/js/post-sorter.js", array( 'jquery' ), "1.0");
	}
	
	if ('admin.php' == basename($_SERVER['PHP_SELF'])) {
		//wp_enqueue_script("jqueryui", $file_dir."/framework/admin/js/jquery-ui-1.8.7.custom.min.js", array( 'jquery' ), "1.0");
		//wp_enqueue_script('jquery-ui-core');
		//wp_enqueue_script('jquery-ui-tabs');
		//wp_enqueue_script('jquery-ui-sortable');
		//wp_enqueue_script('jquery-ui-slider');
		//wp_enqueue_style( 'wp-color-picker' );
		//wp_enqueue_script( 'wp-color-picker' );
		//wp_enqueue_script("range_script", $file_dir."/framework/admin/js/rangeinput.js", array( 'jqueryui' ), "1.0");
		//wp_enqueue_script("iphonecheckbox_script", $file_dir."/framework/admin/js/iphone-style-checkboxes.js", array( 'jquery' ), "1.0");
		//wp_enqueue_script("init-script", $file_dir . "/framework/admin/js/init.js", array( 'jquery' ), "1.0");
		//wp_enqueue_script("color_script", $file_dir."/framework/admin/js/mColorPicker.js", array( 'jquery' ), "1.0",false);
	} else {
		if ( is_admin() ) {
		//wp_enqueue_script("jquery_tools", $file_dir."/framework/admin/js/jquery.tools.min.js", array( 'jquery' ), "1.0",false);
		}
	}
}
add_action('admin_menu', 'mtheme_adminscripts');
load_admin_functions()
?>