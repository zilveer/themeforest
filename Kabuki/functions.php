<?php

// Register and enqueue CSS styles
function theme_styles () {
	wp_register_style('sensei',get_template_directory_uri().'/style.css', array(), false, 'all');
	wp_register_style('lessframework',get_template_directory_uri().'/lessframework.css', array(), false, 'all');

	wp_enqueue_style('lessframework');
	wp_enqueue_style('sensei');
}
add_action('wp_enqueue_scripts', 'theme_styles');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Register and enqueue scripts
function sensei_scripts() {
	wp_register_script('submenu', get_template_directory_uri() . '/scripts/submenu/submenu.js', array('jquery'), false, false);
	wp_register_script('overlay', get_template_directory_uri() . '/scripts/filterable-portfolio/overlay.js', array('jquery'), false, false);
	wp_register_script('search', get_template_directory_uri() . '/scripts/search/search.js', array('jquery'), false, false);
	wp_register_script('expcarousel', get_template_directory_uri() . '/scripts/submenu/jquery.contentcarousel.js', array('jquery'), false, false);

	wp_enqueue_script('submenu');
	wp_enqueue_script('overlay');
	wp_enqueue_script('search');
	wp_enqueue_script('expcarousel');
}
add_action('wp_enqueue_scripts', 'sensei_scripts');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Include custom styles
function custom_styles() {
include 'custom-styles.php';
}
add_action('wp_head','custom_styles', 40);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Include header functions
function header_functions() {
include 'header-functions.php';
}
add_action('wp_head','header_functions', 30);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// enables widgetized sidebars
if ( function_exists('register_sidebar') )
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Sidebar Widget
// Location: the sidebar
register_sidebar(array('name'=>'Sidebar',
	'id' => 'sidebar-1',
	'before_widget' => '<div class="widget-area widget-sidebar %2$s">',
	'after_widget' => '<div class="clearleft"></div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="clearleft"></div>',
));
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Footer Widget
// Location: at the top of the footer, above the copyright
register_sidebar(array('name'=>'Footer',
	'id' => 'sidebar-2',
	'before_widget' => '<div class="widget-area widget-footer %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h4>',
	'after_title' => '</h4>',
));
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Post thumbnail support
add_theme_support( 'post-thumbnails' );
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Get URL of first image in a post
function catch_first_image() {
global $post, $posts;
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
$first_img = $matches [1] [0];
return $first_img;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Add RSS links
add_theme_support( 'automatic-feed-links' );
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Adds the post thumbnail to the RSS feed
function get_the_content_with_formatting ($more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
	$content = get_the_content($more_link_text, $stripteaser, $more_file);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}

function cwc_rss_post_thumbnail($content) {
	global $post;
	if(has_post_thumbnail($post->ID)) {
		$content = '<p>' . get_the_post_thumbnail($post->ID) .
		'</p>' . get_the_content_with_formatting();
	}
	return $content;
}
add_filter('the_excerpt_rss', 'cwc_rss_post_thumbnail');
add_filter('the_content_feed', 'cwc_rss_post_thumbnail');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Custom menu support
add_theme_support( 'menus' );
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'main-menu' => 'Main Menu'
		)
	);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Adds Post Format support
// learn more: http://codex.wordpress.org/Post_Formats
// add_theme_support( 'post-formats', array( 'aside', 'gallery','link','image','quote','status','video','audio','chat' ) );

// Removes detailed login error information for security
add_filter('login_errors',create_function('$a', "return null;"));
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Removes the WordPress version from your header for security
function wb_remove_version() {
	return '<!--built on the Whiteboard Framework-->';
}
add_filter('the_generator', 'wb_remove_version');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// Removes Trackbacks from the comment count
add_filter('get_comments_number', 'comment_count', 0);
function comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
		return count($comments_by_type['comment']);
	} else {
		return $count;
	}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// This is needed for the system to create proper versions of uploaded photos and embedded videos
if ( ! isset( $content_width ) ) $content_width = 686;
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// invite rss subscribers to comment
function rss_comment_footer($content) {
	if (is_feed()) {
		if (comments_open()) {
			$content .= 'Comments are open! <a href="'.get_permalink().'">Add yours!</a>';
		}
	}
	return $content;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// custom excerpt ellipses for 2.9+
function custom_excerpt_more($more) {
	return 'Read More &raquo;';
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

add_filter('excerpt_more', 'custom_excerpt_more');
// no more jumping for read more link
function no_more_jumping($post) {
	if(isset($post->ID)) { return '<a href="'.get_permalink($post->ID).'" class="read-more">'.'&nbsp; Continue Reading &raquo;'.'</a>'; }
}
add_filter('excerpt_more', 'no_more_jumping');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// category id in body and post class
function category_id_class($classes) {
	if(is_page || is_post) {
	global $post;
	foreach((get_the_category($post->ID)) as $category)
		$classes [] = 'cat-' . $category->cat_ID . '-id';
		return $classes;
}
add_filter('post_class', 'category_id_class');
add_filter('body_class', 'category_id_class'); }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// adds a class to the post if there is a thumbnail
function has_thumb_class($classes) {
	global $post;
	if( has_post_thumbnail($post->ID) ) { $classes[] = 'has_thumb'; }
		return $classes;
}
add_filter('post_class', 'has_thumb_class');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// add_action( 'admin_init', 'theme_options_init' );
// add_action( 'admin_menu', 'theme_options_add_page' );

// Init plugin options to white list our options
// function theme_options_init(){
// 	register_setting( 'tat_options', 'tat_theme_options', 'theme_options_validate' );
// }

// Load up the menu page
// function theme_options_add_page() {
// 	add_theme_page( __( 'Theme Options', 'tat_theme' ), __( 'Theme Options', 'tat_theme' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
// }

// Make theme available for translation
// Translations can be filed in the /languages/ directory
load_theme_textdomain('satori', get_template_directory() . '/languages');

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// enable threaded comments
function enable_threaded_comments(){
if (!is_admin()) {
	if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
		wp_enqueue_script('comment-reply');
	}
}
add_action('get_header', 'enable_threaded_comments');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//add fancybox support
// DEF

define( 'EASY_FANCYBOX_VERSION', '1.3.4.9' );
define( 'FANCYBOX_VERSION', '1.3.4' );
define( 'MOUSEWHEEL_VERSION', '3.0.4' );
define( 'EASING_VERSION', '1.3' );
define( 'METADATA_VERSION', '2.1' );
define( 'FANCYBOX_SUBDIR', '/includes/easy-fancybox' );



require_once(dirname(__FILE__) . FANCYBOX_SUBDIR . '/easy-fancybox-settings.php');

$easy_fancybox_array = easy_fancybox_settings();

// FUNCTIONS //

function easy_fancybox() {
global $easy_fancybox_array;

echo '
<!-- Easy FancyBox ' . EASY_FANCYBOX_VERSION . ' using FancyBox ' . FANCYBOX_VERSION . ' - RavanH (http://4visions.nl/en/wordpress-plugins/easy-fancybox/) -->';

// check for any enabled sections
$do_fancybox = false;
foreach ($easy_fancybox_array['Global']['options']['Enable']['options'] as $value) {
	// anything enabled?
	if ( '1' == get_option($value['id'],$value['default']) ) {
		$do_fancybox = true;
		break;
	}
}
// and break off when none are active
if (!$do_fancybox) {
	echo '
<!-- No sections enabled under Settings > Media > FancyBox -->

';
	return;
}

// begin output FancyBox settings
echo '
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
var fb_timeout = null;';

/*
 * Global settings routine
 */
$more=0;
echo '
var fb_opts = {';
foreach ($easy_fancybox_array['Global']['options'] as $globals) {
	foreach ($globals['options'] as $_key => $_value) {
		if( isset($_value['default']) && isset($_value['id'])) { $parm = ($_value['id']) ? get_option($_value['id'], $_value['default']) : $_value['default']; }
		if( isset($_value['input'])) { $parm = ('checkbox'==$_value['input'] && ''==$parm) ? '0' : $parm; }
		if( isset($_value['hide']) && !$_value['hide'] && $parm!='') {
			$quote = (is_numeric($parm) || $_value['noquotes']) ? '' : '\'';
			if ($more>0)
				echo ',';
			echo ' \''.$_key.'\' : ';
			if ('checkbox'==$_value['input'])
				echo ( '1' == $parm ) ? 'true' : 'false';
			else
				echo $quote.$parm.$quote;
			$more++;
		} else {
			$$_key = $parm;
		}
	}
}
echo ' };';

foreach ($easy_fancybox_array as $key => $value) {
	// check if not enabled or hide=true then skip
	if ( isset($value['hide']) && $value['hide'] || !get_option($easy_fancybox_array['Global']['options']['Enable']['options'][$key]['id'], $easy_fancybox_array['Global']['options']['Enable']['options'][$key]['default']) )
		continue;

	echo '
/* ' . $key . ' */';
	/*
	 * Auto-detection routines (2x)
	 */
	$autoAttribute = get_option( $value['options']['autoAttribute']['id'], $value['options']['autoAttribute']['default'] );
	// update from previous version:
	if($attributeLimit == '.not(\':empty\')')
		$attributeLimit = ':not(:empty)';
	elseif($attributeLimit == '.has(\'img\')')
		$attributeLimit = ':has(img)';
	
	if(!empty($autoAttribute)) {
		if(is_numeric($autoAttribute)) {
			echo '
$(\'a['.$value['options']['autoAttribute']['selector'].']:not(.nofancybox)'.$attributeLimit.'\')';
			if ($value['options']['autoAttribute']['href-replace'])
				echo '.attr(\'href\', function(index, attr){'.$value['options']['autoAttribute']['href-replace'].'})';
			echo '.addClass(\''.$value['options']['class']['default'].'\');';
		} else {
			// set selectors
			$file_types = array_filter( explode( ' ', str_replace( ',', ' ', $autoAttribute ) ) );
			$more=0;
			echo '
var fb_'.$key.'_select = \'';
			foreach ($file_types as $type) {
				if ($more>0)
					echo ',';
				echo 'a['.$value['options']['autoAttribute']['selector'].'".'.$type.'"]:not(.nofancybox)'.$attributeLimit.',a['.$value['options']['autoAttribute']['selector'].'".'.strtoupper($type).'"]:not(.nofancybox)'.$attributeLimit;
				$more++;
			}
			echo '\';';

			// class and rel depending on settings
			if( '1' == get_option($value['options']['autoAttributeLimit']['id'],$value['options']['autoAttributeLimit']['default']) ) {
				// add class
				echo '
var fb_'.$key.'_sections = jQuery(\''.get_option($value['options']['autoSelector']['id'],$value['options']['autoSelector']['default']).'\');
fb_'.$key.'_sections.each(function() { jQuery(this).find(fb_'.$key.'_select).addClass(\''.$value['options']['class']['default'].'\')';
				// and set rel
				switch( get_option($value['options']['autoGallery']['id'],$value['options']['autoGallery']['default']) ) {
					case '':
					default :
						echo '; });';
						break;
					case '1':
						echo '.attr(\'rel\', \'gallery-\' + fb_'.$key.'_sections.index(this)); });';
						break;
					case '2':
						echo '.attr(\'rel\', \'gallery\'); });';
				}
			} else {
				// add class
				echo '
$(fb_'.$key.'_select).addClass(\''.$value['options']['class']['default'].'\')';
				// set rel
				switch( get_option($value['options']['autoGallery']['id'],$value['options']['autoGallery']['default']) ) {
					case '':
					default :
						echo ';';
						break;
					case '1':
						echo ';
var fb_'.$key.'_sections = jQuery(\''.get_option($value['options']['autoSelector']['id'],$value['options']['autoSelector']['default']).'\');
fb_'.$key.'_sections.each(function() { jQuery(this).find(fb_'.$key.'_select).attr(\'rel\', \'gallery-\' + fb_'.$key.'_sections.index(this)); });';
						break;
					case '2':
						echo '.attr(\'rel\', \'gallery\');';
				}
			}
			
		}
	}
	
	if( isset($value['autoAttributeAlt']) ) {
	$autoAttributeAlt = get_option( $value['options']['autoAttributeAlt']['id'], $value['options']['autoAttributeAlt']['default'] ); }
	if(!empty($autoAttributeAlt) && is_numeric($autoAttributeAlt)) {
		echo '
$(\'a['.$value['options']['autoAttributeAlt']['selector'].']:not(.nofancybox)'.$attributeLimit.'\')';
		if ($value['options']['autoAttributeAlt']['href-replace'])
			echo '.attr(\'href\', function(index, attr){'.$value['options']['autoAttributeAlt']['href-replace']. '})';
		echo '.addClass(\''.$value['options']['class']['default'].'\');';
	}
	
	/*
	 * Append .fancybox() function
	 */
	$trigger='';
	if( $key == $autoClick )
		$trigger = '.filter(\':first\').trigger(\'click\')';

	echo '
$(\'';
	$tags = array_filter( explode( ',' , $value['options']['tag']['default'] ));
	$more=0;
	foreach ($tags as $_tag) {
		if ($more>0)
			echo ',';
		echo $_tag.'.'.$value['options']['class']['default'];
		$more++;
	}
	echo '\').fancybox( $.extend({}, fb_opts, {';
	$more=0;
	foreach ($value['options'] as $_key => $_values) {
		if( isset($_value['id'])) { $parm = ($_values['id']) ? get_option($_values['id'], $_values['default']) : $_values['default']; }
		if( isset($_value['input'])) { $parm = ('checkbox'==$_values['input'] && ''==$parm) ? '0' : $parm; }
		if( isset($_value['hide']) && !$_value['hide'] && $parm!='') {
			$quote = (is_numeric($parm) || $_values['noquotes']) ? '' : '\'';
			if ($more>0)
				echo ',';
			echo ' \''.$_key.'\' : ';
			if ('checkbox'==$_values['input'])
				echo ( '1' == $parm ) ? 'true' : 'false';
			else
				echo $quote.$parm.$quote;
			$more++;
		}
	}
	echo ' }) )'.$trigger.';';

}

switch( $autoClick ) {
	case '':
	default :
		break;
	case '1':
		echo '
/* Auto-click */ 
$(\'#fancybox-auto\').trigger(\'click\');';
		break;
	case '99':
		echo '
/* Auto-load */ 
$(\'a[class*="fancybox"]\').filter(\':first\').trigger(\'click\');';
		break;
}
echo '
});
/* ]]> */
</script>
<style type="text/css">.fancybox-hidden{display:none}';

if ('1' == $overlaySpotlight)
	echo '#fancybox-overlay{background-image:url("'. get_stylesheet_directory_uri().'/includes/easy-fancybox/light-mask.png");background-position:50% -3%;background-repeat:no-repeat;-o-background-size:100%;-webkit-background-size:100%;-moz-background-size:100%;-khtml-background-size:100%;background-size:100%;position:fixed}';
if ('' != $backgroundColor)
	echo '#fancybox-outer{background-color:'.$backgroundColor.'}';
if ('' != $paddingColor)
	echo '#fancybox-content{border-color:'.$paddingColor.'}';
if ('' != $textColor)
	echo '#fancybox-content{color:'.$textColor.'}';
if ('' != $frameOpacity) {
	$frameOpacity_percent = (int)$frameOpacity*100;
	echo '#fancybox-outer{filter:alpha(opacity='.$frameOpacity_percent.');-moz-opacity:'.$frameOpacity.';opacity:'.$frameOpacity.'}';
}
echo '</style>
';

}

// FancyBox Media Settings Section on Settings > Media admin page
function easy_fancybox_settings_section() {
// 	echo '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=ravanhagen%40gmail%2ecom&item_name=Easy%20FancyBox&item_number=&no_shipping=0&tax=0&bn=PP%2dDonationsBF&charset=UTF%2d8&lc=us" title="'.__('Donate to Easy FancyBox plugin development with PayPal - it\'s fast, free and secure!','easy-fancybox').'"><img src="https://www.paypal.com/en_US/i/btn/x-click-but7.gif" style="border:none;float:right;margin:0 0 10px 10px" alt="'.__('Donate to Easy FancyBox plugin development with PayPal - it\'s fast, free and secure!','easy-fancybox').'" width="72" height="29" /></a><p>'.__('The options in this section are provided by the plugin <strong><a href="http://4visions.nl/en/wordpress-plugins/easy-fancybox/">Easy FancyBox</a></strong> and determine the <strong>Media Lightbox</strong> overlay appearance and behaviour controlled by <strong><a href="http://fancybox.net/">FancyBox</a></strong>.','easy-fancybox').' '.__('First enable each sub-section that you need. Then save and come back to adjust its specific settings.','easy-fancybox').'</p><p>'.__('Note: Each additional sub-section and features like <em>Auto-detection</em>, <em>Elastic transitions</em> and all <em>Easing effects</em> (except Swing) will have some extra impact on client-side page speed. Enable only those sub-sections and options that you actually need on your site.','easy-fancybox').' '.__('Some setting like Transition options are unavailable for SWF video, PDF and iFrame content to ensure browser compatibility and readability.','easy-fancybox').'</p>';
}

// FancyBox Media Settings Fields
function easy_fancybox_settings_fields($args){
if (isset ($args['input'])) {
switch($args['input']) {
	case 'multiple':
	case 'deep':
		foreach ($args['options'] as $options)
			easy_fancybox_settings_fields($options);
		if (isset ($args['description'])) { echo $args['description']; }
		break;
	case 'select':
		if( !empty($args['label_for']) )
			echo '<label for="'.$args['label_for'].'">'.$args['title'].'</label> ';
		else
			echo $args['title'];
		echo '
		<select name="'.$args['id'].'" id="'.$args['id'].'">';
		foreach ($args['options'] as $optionkey => $optionvalue) {
			$selected = (get_option($args['id'], $args['default']) == $optionkey) ? ' selected="selected"' : '';
			echo '
			<option value="'.esc_attr($optionkey).'"'.$selected.'>'.$optionvalue.'</option>';
		}
		echo '
		</select> ';
		if( empty($args['label_for']) )
			echo '<label for="'.$args['id'].'">'.$args['description'].'</label> ';
		else
			echo $args['description'];
		break;
	case 'checkbox':
		if( !empty($args['label_for']) )
			echo '<label for="'.$args['label_for'].'">'.$args['title'].'</label> ';
		else
			if (isset($args['title'])) { echo $args['title']; }
		$value = esc_attr( get_option($args['id'], $args['default']) );
		if ($value == "1")
			$checked = ' checked="checked"';
		else
			$checked = '';
		if ($args['default'] == "1")
			$default = __('Checked','easy-fancybox');
		else
			$default = __('Unchecked','easy-fancybox');
		if( empty($args['label_for']) )
			echo '
		<label><input type="checkbox" name="'.$args['id'].'" id="'.$args['id'].'" value="1" '.$checked.'/> '.$args['description'].'</label><br />';
		else
			echo '
		<input type="checkbox" name="'.$args['id'].'" id="'.$args['id'].'" value="1" '.$checked.'/> '.$args['description'].'<br />';
		break;
	case 'text':
		if( !empty($args['label_for']) )
			echo '<label for="'.$args['label_for'].'">'.$args['title'].'</label> ';
		else
			echo $args['title'];
		echo '
		<input type="text" name="'.$args['id'].'" id="'.$args['id'].'" value="'.esc_attr( get_option($args['id'], $args['default']) ).'" class="'.$args['class'].'"/> ';
		if( empty($args['label_for']) )
			echo '<label for="'.$args['id'].'">'.$args['description'].'</label> ';
		else
			if ( isset($args['description']) ) { echo $args['description']; }
		break;
	default:
		echo $args['description'];
}
}
}


function easy_fancybox_register_settings($args){
global $easy_fancybox_array;
foreach ($args as $key => $value) {
	// check to see if the section is enabled, else skip to next
	if ( array_key_exists($key, $easy_fancybox_array['Global']['options']['Enable']['options']) && !get_option($easy_fancybox_array['Global']['options']['Enable']['options'][$key]['id'], $easy_fancybox_array['Global']['options']['Enable']['options'][$key]['default']) )
		continue;
		
	switch($value['input']) {
		case 'deep':
			// go deeper and loop back on itself 
			easy_fancybox_register_settings($value['options']);
			break;
		case 'multiple':
			add_settings_field( 'fancybox_'.$key, $value['title'], 'easy_fancybox_settings_fields', 'media', 'fancybox_section', $value);
			foreach ($value['options'] as $_value)
				if (isset($_value['id']) && $_value['id']) register_setting( 'media', $_value['id'] );	
			break;
		default:
			if ($value['id']) register_setting( 'media', 'fancybox_'.$key );
	}
}
}

function easy_fancybox_admin_init(){
load_plugin_textdomain('easy-fancybox', false, "/includes/easy-fancybox");

add_settings_section('fancybox_section', __('FancyBox','easy-fancybox'), 'easy_fancybox_settings_section', 'media');

global $easy_fancybox_array;
easy_fancybox_register_settings($easy_fancybox_array);
}

function easy_fancybox_enqueue_scripts() {
global $easy_fancybox_array;

// check for any enabled sections plus the need for easing script
$do_fancybox = false;
$easing = false;

foreach ($easy_fancybox_array['Global']['options']['Enable']['options'] as $value) {
	// anything enabled?
	if ( '1' == get_option($value['id'],$value['default']) ) {
		$do_fancybox = true;
		break;
	}
}

// break off if there is no need for any script files
if (!$do_fancybox) 
	return;

// ENQUEUE
// register main fancybox script
wp_enqueue_script('jquery.fancybox', get_template_directory_uri().FANCYBOX_SUBDIR.'/fancybox/jquery.fancybox-'.FANCYBOX_VERSION.'.pack.js', array('jquery'), FANCYBOX_VERSION);

// easing in IMG settings?
if ( ( 'elastic' == get_option($easy_fancybox_array['IMG']['options']['transitionIn']['id'],$easy_fancybox_array['IMG']['options']['transitionIn']['default']) || 
	'elastic' == get_option($easy_fancybox_array['IMG']['options']['transitionOut']['id'],$easy_fancybox_array['IMG']['options']['transitionOut']['default']) ) 
	&& 
	( '' != get_option($easy_fancybox_array['IMG']['options']['easingIn']['id'],$easy_fancybox_array['IMG']['options']['easingIn']['default']) || 
	'' != get_option($easy_fancybox_array['IMG']['options']['easingOut']['id'],$easy_fancybox_array['IMG']['options']['easingOut']['default']) ) ) {
	// first get rid of previously registered variants of jquery.easing by other plugins or theme
	// wp_deregister_script('jquery.easing');
	// wp_deregister_script('jqueryeasing');
	// wp_deregister_script('jquery-easing');
	// wp_deregister_script('easing');
	// then register our version
	wp_enqueue_script('jquery.easing', get_template_directory_uri().FANCYBOX_SUBDIR.'/fancybox/jquery.easing-'.EASING_VERSION.'.pack.js', array('jquery'), EASING_VERSION, true);
}

// first get rid of previously registered variants of jquery.mousewheel (by other plugins)
// wp_deregister_script('jquery.mousewheel');
// wp_deregister_script('jquerymousewheel');
// wp_deregister_script('jquery-mousewheel');
// wp_deregister_script('mousewheel');
// then register our version
wp_enqueue_script('jquery.mousewheel', get_template_directory_uri().FANCYBOX_SUBDIR.'/fancybox/jquery.mousewheel-'.MOUSEWHEEL_VERSION.'.pack.js', array('jquery'), MOUSEWHEEL_VERSION, true);

}

function easy_fancybox_enqueue_styles() {
// register style
wp_enqueue_style('easy-fancybox.css', get_template_directory_uri().FANCYBOX_SUBDIR.'/easy-fancybox.css.php', false, FANCYBOX_VERSION, 'screen');
}

// Hack to fix missing wmode in (auto)embed code based on Crantea Mihaita's work-around on
// http://www.mehigh.biz/wordpress/adding-wmode-transparent-to-wordpress-3-media-embeds.html
// + own hack for dailymotion iframe embed...
if(!function_exists('add_video_wmode_opaque')) {
function add_video_wmode_opaque($html, $url, $attr) {
if (strpos($html, "<embed src=" ) !== false) {
	$html = str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $html);
	return $html;
} elseif(strpos($html, "<iframe src=\"http://player..vimeo.com/video/" ) !== false) {
	$html = str_replace('" width', '?theme=none&wmode=opaque" width', $html);
	return $html;
} else {
	return $html;
}
}
}

// HOOKS //

add_filter('embed_oembed_html', 'add_video_wmode_opaque', 10, 3);
add_action('wp_print_styles', 'easy_fancybox_enqueue_styles', 999);
add_action('wp_enqueue_scripts', 'easy_fancybox_enqueue_scripts', 999);
add_action('wp_head', 'easy_fancybox', 999);

add_action('admin_init','easy_fancybox_admin_init');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// add a social media widget
include_once( get_template_directory(). '/includes/social-media-widget/social-widget.php' );
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// add a twitter widget
include_once( get_template_directory(). '/includes/twitter-widget/twitter-widget.php' );
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// integrate shortcodes
include_once( get_template_directory(). '/includes/shortcodes-ultimate/shortcodes-ultimate.php' );
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// add a pager
require_once( get_template_directory(). '/includes/pager/pager.php' );
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// add the recent posts widget
include_once( get_template_directory(). '/includes/better-recent-posts/better-recent-posts.php' );
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// add dropdown menus for mobile screens
include_once( get_template_directory(). '/includes/dropdown-menus/dropdown-menus.php' );
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// add affiliate link cloaking
include_once( get_template_directory(). '/includes/link-cloaking/affiliatelinkcloaking.php' );
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// add localization
include_once( get_template_directory(). '/includes/quick-localization/index.php' );
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// add the SEO module
include_once( get_template_directory(). '/includes/seo/seo.php' );
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// custom tag cloud 
add_filter('widget_tag_cloud_args','set_largest_tags');
function set_largest_tags($args) {
$args = array('largest'    => 8);
return $args; }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Grunion contact form 
include_once( get_template_directory(). '/includes/contact-form/grunion-contact-form.php' );
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Option Tree integration
include_once( get_template_directory(). '/includes/option-tree/index.php' );
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Create filterable portfolio 
add_action('init', 'project_custom_init');      

function project_custom_init()  
{  
// The following is all the names, in our tutorial, we use "Project"
$labels = array(
	'name' => _x('Projects', 'post type general name', 'satori'),
	'singular_name' => _x('Project', 'post type singular name', 'satori'),
	'add_new' => _x('Add New', 'project', 'satori'),
	'add_new_item' => __('Add New Project', 'satori'),
	'edit_item' => __('Edit Project', 'satori'),
	'new_item' => __('New Project', 'satori'),
	'view_item' => __('View Project', 'satori'),
	'search_items' => __('Search Projects', 'satori'),
	'not_found' =>  __('No projects found', 'satori'),
	'not_found_in_trash' => __('No projects found in Trash', 'satori'),
	'parent_item_colon' => '',
	'menu_name' => __('Portfolio', 'satori')
);

// Some arguments and in the last line 'supports', we say to WordPress what features are supported on the Project post type
$args = array(
	'labels' => $labels,
	'public' => true,
	'publicly_queryable' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	'query_var' => true,
	'rewrite' => true,
	'capability_type' => 'post',
	'has_archive' => true,
	'hierarchical' => false,
	'menu_position' => null,
	'supports' => array('title','editor','author','thumbnail','excerpt','comments')
);

// We call this function to register the custom post type
register_post_type('project',$args);

// Initialize Taxonomy Labels
$labels = array(
	'name' => _x( 'Tags', 'taxonomy general name' , 'satori'),
	'singular_name' => _x( 'Tag', 'taxonomy singular name', 'satori' ),
	'search_items' =>  __( 'Search Types' , 'satori'),
	'all_items' => __( 'All Tags', 'satori' ),
	'parent_item' => __( 'Parent Tag', 'satori' ),
	'parent_item_colon' => __( 'Parent Tag:', 'satori' ),
	'edit_item' => __( 'Edit Tags', 'satori' ),
	'update_item' => __( 'Update Tag', 'satori' ),
	'add_new_item' => __( 'Add New Tag', 'satori' ),
	'new_item_name' => __( 'New Tag Name', 'satori' ),
);

// Register Custom Taxonomy
register_taxonomy('tagportfolio',array('project'), array(
	'hierarchical' => true, // define whether to use a system like tags or categories
	'labels' => $labels,
	'show_ui' => true,
	'query_var' => true,
	'rewrite' => array( 'slug' => 'tag-portfolio' ),
));


}  

add_filter('post_updated_messages', 'project_updated_messages');

function project_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['project'] = array(
	0 => '', // Unused. Messages start at index 1.
	1 => sprintf( __('Project updated. <a href="%s">View project</a>', 'satori'), esc_url( get_permalink($post_ID) ) ),
	2 => __('Custom field updated.', 'satori'),
	3 => __('Custom field deleted.', 'satori'),
	4 => __('Project updated.', 'satori'),
	/* translators: %s: date and time of the revision */
	5 => isset($_GET['revision']) ? sprintf( __('Project restored to revision from %s', 'satori'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
	6 => sprintf( __('Project published. <a href="%s">View project</a>', 'satori'), esc_url( get_permalink($post_ID) ) ),
	7 => __('Project saved.', 'satori'),
	8 => sprintf( __('Project submitted. <a target="_blank" href="%s">Preview project</a>', 'satori'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	9 => sprintf( __('Project scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview project</a>', 'satori'),
	  // translators: Publish box date format, see http://php.net/date
	  date_i18n( __( 'M j, Y @ G:i' , 'satori'), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
	10 => sprintf( __('Project draft updated. <a target="_blank" href="%s">Preview project</a>', 'satori'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

function enqueue_filterable()
{
	wp_register_script( 'filterable', get_template_directory_uri() . '/scripts/filterable-portfolio/filterable.js', array( 'jquery' ) );
	wp_enqueue_script( 'filterable' );
}
add_action('wp_enqueue_scripts', 'enqueue_filterable'); 
if ( function_exists( 'add_theme_support' ) )  
{  
add_theme_support(  'post-thumbnails' );
add_image_size( 'portfolio', 500, 300, true ); 
}  

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// Custom exerpt for portfolio items
function new_excerpt_more( $more ) {
if ( is_page_template('page_portfolio-two-column.php') ) {
return '...';
} }
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
if ( is_page_template('page_portfolio-two-column.php') or is_page_template('page_portfolio-one-column.php') or is_page_template('page_portfolio-three-column.php') or is_page_template('page_portfolio-four-column.php') ) {
return 40;
} }
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/* Remove Option Tree From User Profile */
global $ot_admin;remove_action( 'show_user_profile', array( $ot_admin, 'option_tree_extra_profile_fields' ) );remove_action( 'edit_user_profile', array( $ot_admin, 'option_tree_extra_profile_fields' ) );remove_action( 'personal_options_update', array( $ot_admin, 'option_tree_save_extra_profile_fields' ) );remove_action( 'edit_user_profile_update', array( $ot_admin, 'option_tree_save_extra_profile_fields' ) );


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// Custom search form
function fuji_search_form( $form ) {
$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
<div><input type="text" value="'.__('Find..', 'satori').'" name="s" id="s" />
<input type="submit" id="searchsubmit" value="" />
</div>
</form>';
return $form;
}
add_filter( 'get_search_form', 'fuji_search_form' );
////////////////////////////////////////////////////////////////////////////////////////////////////


// Integrate Ads Manager
include_once( get_template_directory(). '/includes/quick-adsense/quick-adsense.php' );

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// Custom sidebars
include_once( get_template_directory(). '/includes/custom-sidebars/customsidebars.php' );

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// Full-screen background and slider
include_once( get_template_directory(). '/includes/supersized/index.php' );

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


?>