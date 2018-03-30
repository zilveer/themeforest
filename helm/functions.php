<?php
/**
 * @Functions
 * 
 */
?>
<?php
/*-------------------------------------------------------------------------*/
/* Theme name settings which is shared to some functions */
/*-------------------------------------------------------------------------*/
// Theme Title
$ThemeTitle= "Helm";
// Theme Name
$themename = "Helm";
$themefolder = "helm";
// Notifier Info
$notifier_name = "Helm";
$notifier_url = "http://www.imaginemthemes.com/notifier/rime/notifier.xml";
// Theme name in short
$shortname = "mtheme_p2";
define('MTHEME', $shortname);
define('MTHEME_NAME', $themename);

// Constants for the theme name, folder and remote XML url
define( 'MTHEME_NOTIFIER_THEME_NAME', $themefolder ); // The theme name
define( 'MTHEME_NOTIFIER_THEME_FOLDER_NAME', $themefolder ); // The theme folder name
define( 'MTHEME_NOTIFIER_XML_FILE', $notifier_url ); // The remote notifier XML file containing the latest version of the theme and changelog
define( 'MTHEME_NOTIFIER_CACHE_INTERVAL', 1 ); // The time interval for the remote XML cache in the database (21600 seconds = 6 hours)

// Stylesheet path
$theme_path = get_template_directory_uri();
// Theme Options Thumbnail
$theme_icon= $theme_path . '/images/options/thumbnail.jpg';
// Minimum contents area
if ( ! isset( $content_width ) ) { $content_width = 692; }
define('MIN_CONTENT_WIDTH', $content_width);
// Maximum contents area
define('MAX_CONTENT_WIDTH', "920");
define('FULLPAGE_WIDTH', "1020");
// Max Sidebar Count
define('MAX_SIDEBARS', "20");
// Demo Status
define('DEMO_STATUS', "0");
// Theme build mode flag. Disables default enqueue font.
define('MTHEME_BUILDMODE', "0");
//Session start if demo is switched On
if (DEMO_STATUS) {
	session_start();
}
/*-------------------------------------------------------------------------*/
/* Constants */
/*-------------------------------------------------------------------------*/
function mtheme_constants() {
	$theme_path = get_template_directory_uri();
	$template_path=get_template_directory();
	define('PARENT_DIR', $template_path);
	define('MTHEME_PARENTDIR', $template_path);
	define('FRAMEWORK_PLUGINS', MTHEME_PARENTDIR . '/framework/plugins/' );
	define('OPTIONS_ROOT', MTHEME_PARENTDIR . '/framework/options/' );
	define('FRAMEWORK_ADMIN', MTHEME_PARENTDIR . '/framework/admin/' );
	define('FRAMEWORK_NOTIFIER', MTHEME_PARENTDIR . '/framework/notifier/' );
	define('FRAMEWORK_FUNCTIONS', MTHEME_PARENTDIR . '/framework/functions/' );
	define('MTHEME_FUNCTIONS', MTHEME_PARENTDIR . '/functions/' );
	define('MTHEME_SHORTCODEGENS', MTHEME_FUNCTIONS . 'shortcodegens/' );
	define('MTHEME_SHORTCODES', MTHEME_FUNCTIONS . 'shortcodes/' );
	define('MTHEME_INCLUDES', MTHEME_PARENTDIR . '/includes/' );
	define('MTHEME_WIDGETS', MTHEME_PARENTDIR . '/widgets/' );
	define('MTHEME_IMAGES', MTHEME_PARENTDIR . '/images/' );
	define('MTHEME_PATH', $theme_path );
	define('MTHEME_FONTJS', $theme_path . '/js/font/' );
}
mtheme_constants();
/*-------------------------------------------------------------------------*/
/* Load Options */
/*-------------------------------------------------------------------------*/
	require_once(OPTIONS_ROOT .'options-caller.php');	// THEME SPECIFIC Grab options from themes folder
/*-------------------------------------------------------------------------*/
/* Load Admin */
/*-------------------------------------------------------------------------*/
	require_once (TEMPLATEPATH . '/framework/admin/admin_setup.php');
/*-------------------------------------------------------------------------*/
/* Core Libraries */
/*-------------------------------------------------------------------------*/
function load_core_libaries() {
	require_once (FRAMEWORK_FUNCTIONS . 'framework-functions.php');
	require_once (FRAMEWORK_FUNCTIONS . 'framework-shortcodes.php');
	if ( of_get_option('notifier_status') ) {
		require_once (FRAMEWORK_NOTIFIER . 'update-notifier.php');
	}
}
/*-------------------------------------------------------------------------*/
/* Theme Specific Libraries */
/*-------------------------------------------------------------------------*/
function load_theme_libaries() {
	require_once (MTHEME_FUNCTIONS . 'scripts-styles-register.php');
	require_once (MTHEME_FUNCTIONS . 'common-scripts.php');
	require_once (MTHEME_FUNCTIONS . 'widgetize-theme.php');
	require_once (MTHEME_FUNCTIONS . 'custom-post-types.php');
	require_once (MTHEME_FUNCTIONS . 'custom-post-sorter.php');
}
function load_theme_shortcodes() {
	require_once (MTHEME_SHORTCODES . 'general.php');
	require_once (MTHEME_SHORTCODES . 'icons.php');
	require_once (MTHEME_SHORTCODES . 'slideshow.php');
	require_once (MTHEME_SHORTCODES . 'video.php');
	require_once (MTHEME_SHORTCODES . 'gmaps.php');
	}
function load_theme_metaboxes() {
	require_once (MTHEME_FUNCTIONS . 'page-metaboxes.php');
	require_once (MTHEME_FUNCTIONS . 'post-metaboxes.php');
}
function load_theme_shortcodegens() {
	require_once (MTHEME_SHORTCODEGENS . 'columns/tinymce.php');
	require_once (MTHEME_SHORTCODEGENS . 'type/tinymce.php');
	require_once (MTHEME_SHORTCODEGENS . 'buttons/tinymce.php');
	require_once (MTHEME_SHORTCODEGENS . 'notices/tinymce.php');
	require_once (MTHEME_SHORTCODEGENS . 'postpages/tinymce.php');
	require_once (MTHEME_SHORTCODEGENS . 'accordiontabs/tinymce.php');
	require_once (MTHEME_SHORTCODEGENS . 'dividers/tinymce.php');
	require_once (MTHEME_SHORTCODEGENS . 'picture/tinymce.php');
	require_once (MTHEME_SHORTCODEGENS . 'slideshow/tinymce.php');
	require_once (MTHEME_SHORTCODEGENS . 'thumbnails/tinymce.php');
	require_once (MTHEME_SHORTCODEGENS . 'videos/tinymce.php');
}
/*-------------------------------------------------------------------------*/
/* Load Widgets */
/*-------------------------------------------------------------------------*/
function load_theme_widgets() {
	require_once (MTHEME_WIDGETS . 'twitter/widget.php');
	require_once (MTHEME_WIDGETS . 'sidebar-gallery.php');
	require_once (MTHEME_WIDGETS . 'recent.php');
	require_once (MTHEME_WIDGETS . 'popular.php');
	require_once (MTHEME_WIDGETS . 'social.php');
	require_once (MTHEME_WIDGETS . 'flickr.php');
	require_once (MTHEME_WIDGETS . 'address.php');
	require_once (MTHEME_WIDGETS . 'video.php');
}
/*-------------------------------------------------------------------------*/
/* Load Constants : Core Libraries : Update Notifier*/
/*-------------------------------------------------------------------------*/
//mtheme_options_check();
load_core_libaries();
load_theme_libaries();
load_theme_metaboxes();
load_theme_shortcodes();
load_theme_shortcodegens();
load_theme_widgets();
?>