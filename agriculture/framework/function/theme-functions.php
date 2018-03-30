<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.6.4
 * 
 * Theme Functions
 * Created by CMSMasters
 * 
 */


/* Register JS Scripts */
function register_js_scripts() {
	if (!is_admin()) {
		
		$cmsms_option = cmsms_get_global_options();
	
		wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.custom.all.min.js', array(), '2.5.2', false);
		wp_register_script('respond', get_template_directory_uri() . '/js/respond.min.js', array(), '1.1.0', false);
		wp_register_script('easing', get_template_directory_uri() . '/js/jquery.easing.min.js', array('jquery'), '1.3.0', false);
		wp_register_script('jackbox-lib', get_template_directory_uri() . '/js/jackbox-lib.js', array('jquery'), '1.0.0', true);
		wp_register_script('jackbox', get_template_directory_uri() . '/js/jackbox.js', array('jquery'), '1.0.0', true);
		wp_register_script('script', get_template_directory_uri() . '/js/jquery.script.js', array('jquery'), '1.0.0', true);
		wp_register_script('jPlayer', get_template_directory_uri() . '/js/jquery.jPlayer.min.js', array('jquery'), '2.1.0', true);
		wp_register_script('jPlayerPlaylist', get_template_directory_uri() . '/js/jquery.jPlayer.playlist.min.js', array('jquery', 'jPlayer'), '1.0.0', true);
		
		wp_register_script('gMapAPI', '//maps.googleapis.com/maps/api/js?key=' . $cmsms_option[CMSMS_SHORTNAME . '_gmap_api_key'], array('jquery'), '1.0.0', true);	
		wp_register_script('gMap', get_template_directory_uri() . '/js/jquery.gMap.min.js', array('jquery', 'gMapAPI'), '3.2.0', true);
		
		wp_register_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery'), '1.5.19', true);
		wp_register_script('isotopeRun', get_template_directory_uri() . '/js/jquery.isotope.run.js', array('jquery', 'isotope'), '1.0.0', true);
		
		// Woocommerce functions
		if (class_exists('woocommerce')) {
			wp_register_script('cmsms-woocommerce-script', get_template_directory_uri() . '/js/jquery.cmsms-woocommerce-script.js', array('jquery'), '1.0.0', true);
		}
		
		wp_enqueue_script('modernizr');
		wp_enqueue_script('respond');
		wp_enqueue_script('easing');
		wp_enqueue_script('jackbox-lib');
		wp_enqueue_script('jackbox');
		wp_enqueue_script('script');
		wp_enqueue_script('jPlayer');
		wp_enqueue_script('jPlayerPlaylist');
		wp_enqueue_script('twitter');
		
		if (class_exists('woocommerce')) {
			wp_enqueue_script('cmsms-woocommerce-script');
		}
	}
}

add_action('init', 'register_js_scripts');



/* Register CSS Styles */
function register_css_styles() {
	if (!is_admin()) {
		global $wp_styles;
		
		
		$cmsms_option = cmsms_get_global_options();
		
		
		wp_register_style('theme-style', get_stylesheet_uri(), array(), '1.0.0', 'screen');
		wp_register_style('theme-fonts', get_template_directory_uri() . '/css/fonts.php', array(), '1.0.0', 'screen');
		wp_register_style('theme-adapt', get_template_directory_uri() . '/css/adaptive.css', array(), '1.0.0', 'screen');
		wp_register_style('theme-retina', get_template_directory_uri() . '/css/retina.css', array(), '1.0.0', 'screen');
		wp_register_style('theme-cmsms-woocommerce-style', get_template_directory_uri() . '/css/cmsms-woocommerce-style.css', array(), '1.0.0', 'screen');
		wp_register_style('jackbox', get_template_directory_uri() . '/css/jackbox.css', array(), '1.0.0', 'screen');
		wp_register_style('jPlayer', get_template_directory_uri() . '/css/jquery.jPlayer.css', array(), '2.1.0', 'screen');
		wp_register_style('isotope', get_template_directory_uri() . '/css/jquery.isotope.css', array(), '1.5.19', 'screen');
		
		wp_enqueue_style('theme-style');
		wp_enqueue_style('theme-fonts');
		
		if ($cmsms_option[CMSMS_SHORTNAME . '_responsive']) {
			wp_enqueue_style('theme-adapt');
		}
		
		if ($cmsms_option[CMSMS_SHORTNAME . '_retina']) {
			wp_enqueue_style('theme-retina');
		}
		
		if (class_exists('woocommerce')) {
			wp_enqueue_style('theme-cmsms-woocommerce-style');
		}
		
		wp_enqueue_style('jackbox');
		wp_enqueue_style('jPlayer');
		wp_enqueue_style('isotope');
		
		wp_register_style('jackbox-ie8', get_template_directory_uri() . '/css/jackbox-ie8.css', array(), '1.0.0', 'screen');
		wp_register_style('jackbox-ie9', get_template_directory_uri() . '/css/jackbox-ie9.css', array(), '1.0.0', 'screen');
		
		wp_enqueue_style('theme-ie', get_template_directory_uri() . '/css/ie.css', array(), '1.0.0', 'screen');
		wp_enqueue_style('theme-ieCss3', get_template_directory_uri() . '/css/ieCss3.php', array(), '1.0.0', 'screen');
		
		$wp_styles->add_data('jackbox-ie8', 'conditional', 'lt IE 9');
		$wp_styles->add_data('jackbox-ie9', 'conditional', 'gt IE 8');
		
		$wp_styles->add_data('theme-ie', 'conditional', 'lt IE 9');
		$wp_styles->add_data('theme-ieCss3', 'conditional', 'lt IE 9');
	}
}

add_action('wp_print_styles', 'register_css_styles');



/* Google Fonts Generate Function */
function cmsms_theme_google_fonts_generate() {
	$cmsms_option = cmsms_get_global_options();
	
	
	$i = 1;
	
	
	foreach (cmsms_google_fonts_list() as $key => $value) {
		if ( 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_content_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_content_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_link_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_link_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_nav_title_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_nav_title_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_nav_dropdown_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_nav_dropdown_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_h1_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_h1_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_h2_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_h2_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_h3_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_h3_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_h4_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_h4_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_h5_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_h5_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_h6_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_h6_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_quote_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_quote_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_dropcap_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_dropcap_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_code_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_code_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_small_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_small_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_input_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_input_font_google_font'] && $key != '')
		) {
			cmsms_theme_google_font($key, $i);
			
			
			$i++;
		}
	}
}

add_action('wp_print_styles', 'cmsms_theme_google_fonts_generate');



/* Google Fonts Enqueue Function */
function cmsms_theme_google_font($font, $i) {
	$protocol = is_ssl() ? 'https' : 'http';
	
	
	wp_enqueue_style('cmsms-google-font-' . $i, $protocol . '://fonts.googleapis.com/css?family=' . $font);
}



/* Register Admin Panel Favicon */
function admin_favicon() {
    echo '<link rel="shortcut icon" type="image/x-icon" href="' . get_template_directory_uri() . '/img/favicon.ico" />';
}

add_action('admin_head', 'admin_favicon');



/* Register Default Theme Sidebars */
function the_widgets_init() {
    if (!function_exists('register_sidebars')) {
        return;
    }
    
    register_sidebar(
        array(
            'name' => __('Sidebar', 'cmsmasters'), 
            'id' => 'sidebar_default', 
            'description' => __('Widgets in this area will be shown in all left and right sidebars till you don\'t use custom sidebar.', 'cmsmasters'), 
            'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
            'after_widget' => '</aside>', 
            'before_title' => '<h6 class="widgettitle">', 
            'after_title' => '</h6>'
        )
    );
    
    register_sidebar(
        array(
            'name' => __('Top Sidebar', 'cmsmasters'), 
            'id' => 'sidebar_top', 
            'description' => __('Widgets in this area will be shown at the top of middle block, above the content.', 'cmsmasters'), 
            'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
            'after_widget' => '</aside>', 
            'before_title' => '<h6 class="widgettitle">', 
            'after_title' => '</h6>'
        )
    );
    
    register_sidebar(
        array(
            'name' => __('Middle Sidebar', 'cmsmasters'), 
            'id' => 'sidebar_middle', 
            'description' => __('Widgets in this area will be shown at the bottom of middle block below the content, but above bottom sidebar and footer.', 'cmsmasters'), 
            'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
            'after_widget' => '</aside>', 
            'before_title' => '<h6 class="widgettitle">', 
            'after_title' => '</h6>'
        )
    );
    
    register_sidebar(
        array(
            'name' => __('Bottom Sidebar', 'cmsmasters'), 
            'id' => 'sidebar_bottom', 
            'description' => __('Widgets in this area will be shown at the bottom of middle block below the content and middle sidebar, but above footer.', 'cmsmasters'), 
            'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
            'after_widget' => '</aside>', 
            'before_title' => '<h6 class="widgettitle">', 
            'after_title' => '</h6>'
        )
    );
	
	
	$cmsms_option = cmsms_get_global_options();
	
	
	if (isset($cmsms_option[CMSMS_SHORTNAME . '_sidebar']) && sizeof($cmsms_option[CMSMS_SHORTNAME . '_sidebar']) > 0) {
		foreach ($cmsms_option[CMSMS_SHORTNAME . '_sidebar'] as $sidebar) {
			register_sidebar(array( 
				'name' => $sidebar, 
				'id' => generateSlug($sidebar, 45), 
				'description' => __('Custom sidebar created with cmsmasters admin panel.', 'cmsmasters'), 
				'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
				'after_widget' => '</aside>', 
				'before_title' => '<h6 class="widgettitle">', 
				'after_title' => '</h6>' 
			) );
		}
	}
}

add_action('init', 'the_widgets_init');



/* Register Theme Navigations */
register_nav_menus(array(
    'primary' => __('Primary Navigation', 'cmsmasters'),
    'footer' => __('Footer Navigation', 'cmsmasters')
));



/* Register Post Formats, Feed Links, Post Thumbnails and Set Image Sizes*/
if (function_exists('add_theme_support')) {
    add_theme_support('post-formats', array( 
		'aside', 
		'quote', 
		'link', 
		'image', 
		'gallery', 
		'video', 
		'audio' 
	));
    
    
    add_theme_support('automatic-feed-links');
	
	
    add_theme_support('post-thumbnails');
    
    set_post_thumbnail_size(670, 390, true);
	
	
	add_theme_support('woocommerce');
}

if (function_exists('add_image_size')) {
	add_image_size('project-thumb', 440, 295, true);
	add_image_size('project-thumb-half', 559, 372, true);
	add_image_size('project-thumb-full', 1130, 752, true);
	add_image_size('open-project-thumb', 845, 567, true);
	add_image_size('slider-thumb', 670, 9999);
	add_image_size('full-thumb', 896, 521, true);
	add_image_size('full-slider-thumb', 896, 9999);
	add_image_size('cmsms_woocommerce_thumb', 50, 50, true);
}



/* Register Full Screen Content Editor Width & Visual Content Editor CSS Stylesheet */
if (!isset($content_width)) {
    $content_width = 845;
}

add_editor_style('framework/admin/inc/css/custom-editor-style.css');



/* Register Theme Options Menu Items in Admin Bar */
function theme_admin_bar_render() {
	include_once(ABSPATH . 'wp-admin/includes/plugin.php');
	
	
	global $wp_admin_bar;
	
	
	$wp_admin_bar->add_menu(array( 
		'id' => CMSMS_SHORTNAME . '_options', 
		'title' => __('Theme Settings', 'cmsmasters'), 
		'href' => admin_url('admin.php?page=cmsms-settings') 
	));
	
	$wp_admin_bar->add_menu(array( 
		'parent' => CMSMS_SHORTNAME . '_options', 
		'id' => CMSMS_SHORTNAME . '_theme_settings', 
		'title' => __('Theme Settings', 'cmsmasters'), 
		'href' => admin_url('admin.php?page=cmsms-settings') 
	));
	
	
	if (is_plugin_active('contact-form-builder/contact-form-builder.php')) {
		$wp_admin_bar->add_menu(array( 
			'parent' => CMSMS_SHORTNAME . '_options', 
			'id' => CMSMS_SHORTNAME . '_form_builder', 
			'title' => __('Form Builder', 'cmsmasters'), 
			'href' => admin_url('admin.php?page=form-builder') 
		));
	}
}

add_action('wp_before_admin_bar_render', 'theme_admin_bar_render');



/* Unregister Default Wordpress Widgets */
function my_unregister_widgets() {
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Text');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Nav_Menu_Widget');
}

add_action('widgets_init', 'my_unregister_widgets');



/* Register Shortcodes for Excerpts and Widgets */
add_filter('the_excerpt', 'do_shortcode');

add_filter('widget_text', 'do_shortcode');



/* Register Removing 'More Text' From Excerpt */
function new_excerpt_more($more) {
	return '...';
}

add_filter('excerpt_more', 'new_excerpt_more');



/* Register Custom Excerpt Length Function */
class Excerpt {
	public static $length = 55;
	
	function __construct($length) {
		Excerpt::$length = $length;
		
		add_filter('excerpt_length', array('Excerpt', 'new_length'));
	}
	
	public function new_length() {
		return Excerpt::$length;
	}
	
	function output() {
		the_excerpt();
	}
	
	function return_out() {
		return get_the_excerpt();
	}
}

function theme_excerpt($length = 55, $show = true) {
	if ($show) {
		$result = new Excerpt($length);
		
		$result->output();
	} else {
		$result = new Excerpt($length);
		
		return $result->return_out();
	}
}



/* Register Transformation from Empty 'p' Tags to 'br' Tags */
function ptobr_content($content) {
    global $post;
	
    $content = str_replace('<p>&nbsp;</p>', '<br />', $content);
	
    return $content;
}

add_filter('the_content', 'ptobr_content');



/* Register Removing 'p' Tags that Wrap Shortcodes */
function shortpdel_content($content) {
    global $post;
	
    $content = str_replace(']</p>', ']', $content);
    $content = str_replace('<p>[/', '[/', $content);
	
    return $content;
}

add_filter('the_content', 'shortpdel_content');



/* Register Removing Edit Blocks */
function editdel_content($content) {
    global $post;
	
    $content = str_replace('<div class="cmsms_shortcode_edit_column">Edit</div>', '', $content);
    $content = str_replace('<div class="cmsms_shortcode_edit_box">Edit</div>', '', $content);
    $content = str_replace('<div class="cmsms_shortcode_edit_tab">Edit</div>', '', $content);
    $content = str_replace('<div class="cmsms_shortcode_edit_price">Edit</div>', '', $content);
	
    return $content;
}

add_filter('the_content', 'editdel_content');



/* Register Showing Home Page on Default Wordpress Pages Menu */
function cmsmasters_page_menu_args($args) {
    $args['show_home'] = true;
    
    return $args;
}

add_filter('wp_page_menu_args', 'cmsmasters_page_menu_args');



/* Generate Slug Function */
function generateSlug($phrase, $maxLength) {
	$result = strtolower($phrase);
	
	$result = preg_replace("/[^a-z0-9\s-]/", "", $result);
	$result = trim(preg_replace("/[\s-]+/", " ", $result));
	$result = trim(substr($result, 0, $maxLength));
	$result = preg_replace("/\s/", "-", $result);
	
	return $result;
}



/* Trim Quotes Function */
function trim_quotes_togg($data) {
	$data = preg_replace("/(^['\"]|['\"]$)/", '', $data);
	
	
	return $data;
}



/* Default Sidebar Content Function */
function sidebarDefaultText() {
	echo '<div class="one_third">' . "\n" . 
		'<aside class="widget widget_search">';

	get_search_form();

	echo '</aside>' . "\n" . 
	'</div>' . "\n" . 
	'<div class="one_third">' . "\n" . 
		'<aside id="archives" class="widget widget_archive">' . "\n" . 
			'<h6 class="widgettitle">' . __('Archives', 'cmsmasters') . '</h6>' . "\n" . 
			'<ul>' . "\n";
	
	wp_get_archives(array( 
		'type' => 'monthly' 
	));
	
	echo '</ul>' . "\n" . 
		'</aside>' . "\n" . 
	'</div>' . "\n" . 
	'<div class="one_third">' . "\n" . 
		'<aside id="meta" class="widget widget_meta">' . "\n" . 
			'<h6 class="widgettitle">' . __('Meta', 'cmsmasters') . '</h6>' . "\n" . 
			'<ul>' . "\n\t";
	
	wp_register();
	
	echo "\n\t" . '<li>';
	
	wp_loginout();
	
	echo '</li>' . "\n\t";
	
	wp_meta();
	
	echo '<li>' . 
		'<a href="';
	
	bloginfo('rss2_url');
	
	echo '" title="' . __('Syndicate this site using RSS 2.0', 'cmsmasters') . '">' . __('Entries', 'cmsmasters') . ' ' . 
			'<abbr title="' . __('Really Simple Syndication', 'cmsmasters') . '">' . __('RSS', 'cmsmasters') . '</abbr>' . 
		'</a>' . 
	'</li>' . "\n\t" . 
	'<li>' . 
		'<a href="';
	
	bloginfo('comments_rss2_url');
	
	echo '" title="' . __('The latest comments to all posts in RSS', 'cmsmasters') . '">' . __('Comments', 'cmsmasters') . ' ' . 
						'<abbr title="' . __('Really Simple Syndication', 'cmsmasters') . '">' . __('RSS', 'cmsmasters') . '</abbr>' . 
					'</a>' . 
				'</li>' . "\n\t" . 
				'<li>' . 
					'<a href="http://wordpress.org/" title="' . __('Powered by WordPress, state-of-the-art semantic personal publishing platform.', 'cmsmasters') . '">WordPress.org</a>' . 
				'</li>' . "\r" . 
			'</ul>' . "\n" . 
		'</aside>' . "\n" . 
	'</div>' . "\n";
}


/* Theme Header Styles Function */
function cmsms_theme_header_styles() {
	$cmsms_option = cmsms_get_global_options();
	
	
	echo '<style type="text/css">' . 
		'#header > .header_inner { ' . 
			'height : ' . $cmsms_option[CMSMS_SHORTNAME . '_header_height'] . 'px; ' . 
		'} ' . 
		'#header > .header_inner > a.logo { ' . 
			'top : ' . $cmsms_option[CMSMS_SHORTNAME . '_logo_top'] . 'px; ' . 
			((is_rtl()) ? 'right' : 'left') . ' : ' . $cmsms_option[CMSMS_SHORTNAME . '_logo_left'] . 'px; ' . 
		'} ' . 
		'#header > .header_inner > a.logo, ' . 
		'#header > .header_inner > a.logo > img { ' . 
			'width : ' . $cmsms_option[CMSMS_SHORTNAME . '_logo_width'] . 'px; ' . 
			'height : ' . $cmsms_option[CMSMS_SHORTNAME . '_logo_height'] . 'px; ' . 
		'} ' . 
		'#header nav { ' . 
			((is_rtl()) ? 'left' : 'right') . ' : ' . $cmsms_option[CMSMS_SHORTNAME . '_header_nav_right'] . 'px; ' . 
		'} ';
		
		if ($cmsms_option[CMSMS_SHORTNAME . '_responsive']) {
			echo '@media only screen and (max-width : 1023px) { ' . 
				'#header > .header_inner > a.logo { ' . 
					'top : auto; ' . 
					'left : auto; ' . 
					'right : auto; ' . 
				'} ' .
				'#header > .header_inner { ' . 
					'height : auto; ' .
				'} ' . 
				'#header nav { ' . 
					'right : auto; ' . 
					'left : auto; ' . 
				'} ' . 
			'} ';
		}
		
	echo '</style>';
}

add_action('wp_head', 'cmsms_theme_header_styles');


/* Theme Background Styles Function */
function cmsms_theme_bg_styles() {
	global $post;
	
	
	$cmsms_option = cmsms_get_global_options();
	
	
	if ( 
		!is_home() && 
		!is_404() && 
		!is_archive() && 
		!is_search() 
	) {
		$cmsms_bg_default = get_post_meta($post->ID, 'cmsms_bg_default', true);
		$cmsms_bg_col = get_post_meta($post->ID, 'cmsms_bg_col', true);
		$cmsms_bg_img_enable = get_post_meta($post->ID, 'cmsms_bg_img_enable', true);
		$cmsms_bg_img = get_post_meta($post->ID, 'cmsms_bg_img', true);
		$cmsms_bg_pos = get_post_meta($post->ID, 'cmsms_bg_pos', true);
		$cmsms_bg_rep = get_post_meta($post->ID, 'cmsms_bg_rep', true);
		$cmsms_bg_att = get_post_meta($post->ID, 'cmsms_bg_att', true);
	}
	
	
	echo '<style type="text/css">';
	
	
	if ( 
		!is_home() && 
		!is_404() && 
		!is_archive() && 
		!is_search() && 
		$cmsms_bg_default != 'true' 
	) {
		echo 'body { ' . 
			'background-color : ' . $cmsms_bg_col . '; ' . 
			'background-image : ' . (($cmsms_bg_img_enable == 'true') ? 'url(' . ((is_numeric($cmsms_bg_img)) ? array_shift(wp_get_attachment_image_src($cmsms_bg_img, 'full')) : $cmsms_bg_img) . ')' : 'none') . '; ' . 
			'background-position : ' . (($cmsms_bg_img_enable == 'true') ? $cmsms_bg_pos : 'top center') . '; ' . 
			'background-repeat : ' . (($cmsms_bg_img_enable == 'true') ? $cmsms_bg_rep : 'repeat') . '; ' . 
			'background-attachment : ' . (($cmsms_bg_img_enable == 'true') ? $cmsms_bg_att : 'scroll') . '; ' . 
		'}';
	} else {
		echo 'body { ' . 
			'background-color : ' . $cmsms_option[CMSMS_SHORTNAME . '_bg_col'] . '; ' . 
			'background-image : ' . (($cmsms_option[CMSMS_SHORTNAME . '_bg_img_enable']) ? 'url(' . ((is_numeric($cmsms_option[CMSMS_SHORTNAME . '_bg_img'])) ? array_shift(wp_get_attachment_image_src($cmsms_option[CMSMS_SHORTNAME . '_bg_img'], 'full')) : $cmsms_option[CMSMS_SHORTNAME . '_bg_img']) . ')' : 'none') . '; ' . 
			'background-position : ' . (($cmsms_option[CMSMS_SHORTNAME . '_bg_img_enable']) ? $cmsms_option[CMSMS_SHORTNAME . '_bg_pos'] : 'top center') . '; ' . 
			'background-repeat : ' . (($cmsms_option[CMSMS_SHORTNAME . '_bg_img_enable']) ? $cmsms_option[CMSMS_SHORTNAME . '_bg_rep'] : 'repeat') . '; ' . 
			'background-attachment : ' . (($cmsms_option[CMSMS_SHORTNAME . '_bg_img_enable']) ? $cmsms_option[CMSMS_SHORTNAME . '_bg_att'] : 'scroll') . '; ' . 
		'}';
	}
	
	
	echo '</style>';
}

add_action('wp_head', 'cmsms_theme_bg_styles');

/* Twitter Widget Function */
function cmsms_get_tweets($username, $count) {

	$cmsms_option = cmsms_get_global_options();

	require_once locate_template('/framework/class/twitteroauth.php');
	
	$excludeReplies = 1;
	$name = $username;
	$numTweets = $count;
	$cacheTime = 1;
	$backupName = 'cmsms_' . CMSMS_SHORTNAME . '_bottom_tweets_list_backup';
	
	
	$connection = new TwitterOAuth( 
		(($cmsms_option[CMSMS_SHORTNAME . '_api_key'] != '') ? $cmsms_option[CMSMS_SHORTNAME . '_api_key'] : ''), 
		(($cmsms_option[CMSMS_SHORTNAME . '_api_secret'] != '') ? $cmsms_option[CMSMS_SHORTNAME . '_api_secret'] : ''), 
		(($cmsms_option[CMSMS_SHORTNAME . '_access_token'] != '') ? $cmsms_option[CMSMS_SHORTNAME . '_access_token'] : ''), 
		(($cmsms_option[CMSMS_SHORTNAME . '_access_token_secret'] != '') ? $cmsms_option[CMSMS_SHORTNAME . '_access_token_secret'] : '') 
	);
	
	
	$totalToFetch = ($excludeReplies) ? max(50, $numTweets * 3) : $numTweets;
	
	
	$fetchedTweets = $connection->get( 
		'https://api.twitter.com/1.1/statuses/user_timeline.json', 
		array( 
			'screen_name' => $name, 
			'count' => $totalToFetch,
			'exclude_replies' => true 
		) 
	);
	
	
	if ($connection->http_code != 200) {
		$tweets = get_option($backupName);
	} else {
		$limitToDisplay = min($numTweets, count($fetchedTweets));
		
		
		for ($i = 0; $i < $limitToDisplay; $i++) {
			$tweet = $fetchedTweets[$i];
			
			$name = $tweet->user->name;
			
			$permalink = 'http://twitter.com/' . $name . '/status/' . $tweet->id_str;
			
			$image = $tweet->user->profile_image_url;
			
			$pattern = '/(http|https):(\S)+/';
			
			$replace = '<a href="${0}" target="_blank" rel="nofollow">${0}</a>';
			
			$text = preg_replace($pattern, $replace, $tweet->text);
			
			$time = $tweet->created_at;
			$time = date_parse($time);
			
			$uTime = mktime($time['hour'], $time['minute'], $time['second'], $time['month'], $time['day'], $time['year']);
			
			
			$tweets[] = array( 
				'text' => $text, 
				'name' => $name, 
				'permalink' => $permalink, 
				'image' => $image, 
				'time' => $uTime 
			);
		}
		
		
		update_option($backupName, $tweets);
	}
	
	
	return $tweets;
}