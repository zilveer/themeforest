<?php
/**
 * @package WordPress
 * @subpackage Chocolate
 */

/* Set the content width based on the theme's design and stylesheet. */
if ( ! isset( $content_width ) ) {
	$content_width = 700;
}

/* Set up theme defaults and registers support for various WordPress features. */
if ( ! function_exists( 'dt_setup' ) ):

	function dt_setup() {
		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 180, 180 ); // default Post Thumbnail dimensions   
		add_image_size( 'dt-l-thumb', 700, 9999, false ); // Large Post Thumbnail
		add_image_size( 'dt-m-thumb', 460, 9999, false ); // Medium Post Thumbnail
		add_image_size( 'dt-s-thumb', 220, 9999, false ); // Small Post Thumbnail

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Make theme available for translation
		// Translations can be filed in the /languages/ directory
		load_theme_textdomain( 'dt', get_template_directory() . '/languages' );
		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";

		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}

		// This theme uses wp_nav_menu() in one location.
		add_theme_support('nav_menus');
		register_nav_menus( array(
			'primary' => __( 'Primary Navigation', 'dt' ),
		) );

		// Include functions/*.php
		include_files_in_dir("/functions/");

		// Include settings/*.php
		include_files_in_dir("/settings/");

		// Include plugins/*/*.php
		include_files_in_dir("/plugins/");
	}

endif;

// add_action( 'init', 'dt_setup' );
add_action( 'after_setup_theme', 'dt_setup' );

// TODO: delete in future
function dt_register_jquery() {
	if( !is_admin() ){
		wp_deregister_script('jquery');
		wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"), false, '1.7.2');
		wp_enqueue_script('jquery');
	}
}
// add_action('wp_enqueue_scripts', 'dt_register_jquery');

/**
 * Enqueue scripts/styles.
 *
 */
function dt_enqueue_scripts() {
	$theme_uri = get_template_directory_uri();
	$theme_options = dt_get_theme_options();
	$responsiveness_is_on = !$theme_options['turn_off_responsivness'];

	$is_home_slider = is_page_template('home-slider.php');
	$is_home_3d = is_page_template('home-3d.php');
	$is_home_static = is_page_template('home-static.php');
	$is_home_video = is_page_template('home-video.php');

	$dt_ajax = array(
		'ajaxurl' => esc_url_raw( admin_url( 'admin-ajax.php' ) ),
		'post_id' => (isset($post->ID) ? $post->ID : ''),
		'hs_graphicsDir' => get_template_directory_uri() . '/js/plugins/highslide/graphics/'
	);

	wp_enqueue_style( 'dt-html5reset', $theme_uri . '/css/html5reset.css' );
	wp_enqueue_style( 'dt-style', $theme_uri . '/css/style.css' );
	wp_enqueue_style( 'dt-skin', $theme_uri . '/css/skin.css' );
	wp_enqueue_style( 'dt-wp', $theme_uri . '/css/wp.css' );
	wp_enqueue_style( 'dt-shortcodes', $theme_uri . '/css/shortcodes.css' );

	// responsiveness
	if ( $responsiveness_is_on ) {
		wp_enqueue_style( 'dt-media', $theme_uri . '/css/media.css' );
	}

	// styless for homepages
	if ( defined('GAL_HOME') || $is_home_slider || $is_home_3d || $is_home_static || $is_home_video ) {

		wp_enqueue_style( 'dt-home', $theme_uri . '/css/home.css' );

		if ( $responsiveness_is_on ) {
			wp_enqueue_style( 'dt-home-media', $theme_uri . '/css/home-media.css' );
		}
	}

	wp_enqueue_style( 'dt-plugins-validator', $theme_uri . '/js/plugins/validator/validationEngine.jquery.css' );
	wp_enqueue_style( 'dt-plugins-highslide', $theme_uri . '/js/plugins/highslide/highslide.css' );
	wp_enqueue_style( 'dt-custom', $theme_uri . '/css/custom.css' );

	wp_enqueue_script( 'dt-jquery-easing', $theme_uri . '/js/jquery.easing.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'dt-cufon-yui', $theme_uri . '/js/cufon-yui.js', array('jquery') );

	if ( $theme_options['cufon_enabled'] ) {

		if ( DEMO ) {

			wp_enqueue_script( 'dt-demo-cufon', $theme_uri . '/fonts/' . get_demo_option('font') . '.font.js', array('dt-cufon-yui') );
		} elseif ( !empty($theme_options['custom_cufon']) ) {

			$upload_dir = wp_upload_dir();
			wp_enqueue_script( 'dt-custom-cufon', $upload_dir['baseurl'] . '/dt_uploads/' . $theme_options['custom_cufon'], array('dt-cufon-yui') );
		} else {

			wp_enqueue_script( 'dt-cufon-font', $theme_uri . '/fonts/' . $theme_options['font'] . '.font.js', array('dt-cufon-yui') );
		}

		wp_enqueue_script( 'dt-load-cufon', $theme_uri . '/js/load-cufon.js', array('dt-cufon-yui') );
	}

	if ( $is_home_slider || $is_home_3d || $is_home_static || $is_home_video || defined('GAL_HOME') ) {

		wp_enqueue_script( 'dt-jquery-wipetouch', $theme_uri . '/js/jquery.wipetouch.js', array('jquery'), null, true );
	}

	wp_enqueue_script( 'dt-plugins-placeholder', $theme_uri . '/js/plugins/placeholder/jquery.placeholder.js', array('jquery'), null, true );
	wp_enqueue_script( 'dt-plugins-validator', $theme_uri . '/js/plugins/validator/jquery.validationEngine.js', array('jquery'), null, true );
	wp_enqueue_script( 'dt-plugins-validator-lang', $theme_uri . '/js/plugins/validator/languages/jquery.validationEngine-en.js', array('jquery'), null, true );

	// highslide
	wp_enqueue_script( 'dt-plugins-highslide-full', $theme_uri . '/js/plugins/highslide/highslide-full.js', array('jquery'), null, true );
	wp_enqueue_script( 'dt-plugins-highslide-config', $theme_uri . '/js/plugins/highslide/highslide.config.js', array('jquery'), null, true );
	wp_enqueue_script( 'dt-plugins-highslide-mobile', $theme_uri . '/js/plugins/highslide/highslide.mobile.js', array('jquery'), null, true );

	wp_enqueue_script( 'dt-jquery-transit', $theme_uri . '/js/jquery.transit.js', array('jquery'), null, true );

	// supersized
	wp_register_style( 'dt-supersized', $theme_uri . '/css/supersized.css' );
	wp_register_script( 'dt-supersized', $theme_uri . '/js/supersized.3.2.7.js', array('jquery'), null, true );

	wp_register_style( 'dt-supersized-shutter', $theme_uri . '/css/supersized.shutter.css' );
	wp_register_script( 'dt-supersized-shutter', $theme_uri . '/js/supersized.shutter.js', array('jquery'), null, true );

	if ( $is_home_video ) {

		if ( dt_jwplayer_exists() ) {
			wp_enqueue_script( 'dt-jwplayer', $theme_uri . '/js/jwplayer/jwplayer.js', array('jquery'), null, true );
		} else {
			wp_enqueue_script( 'dt-jplayer', $theme_uri . '/js/jplayer/jquery.jplayer.min.js', array('jquery'), null, true );
		}
	} elseif ( $is_home_slider ) {

		wp_enqueue_style( 'dt-supersized' );
		wp_enqueue_script( 'dt-supersized' );

		wp_enqueue_style( 'dt-supersized-shutter' );
		wp_enqueue_script( 'dt-supersized-shutter' );

		$slider_data = dt_get_images_for_sliders( 'homeslider_new' );
		$slider_images = array();
		$default_slider_options = array(
			'dt_autoplay' => 0,
			'dt_interval' => 0,
			'dt_transition' => 0,
			'portrait' => 0,
			'landscape' => 0
		);

		if ( !empty($slider_data['options']) ) {

			$slider_images = $slider_data['images'];
			$slider_options = array_map( 'intval', array_intersect_key( $slider_data['options'], $default_slider_options ) );
			$slider_options = wp_parse_args( $slider_options, $default_slider_options );
		}

		$dt_ajax['home_slider_data'] = array(
			'slides' => $slider_images,
		);

		$dt_ajax['home_slider_data'] = array_merge( $dt_ajax['home_slider_data'], $slider_options );

	} elseif ( $is_home_3d ) {

		wp_enqueue_style( 'dt-plugins-slider3d', $theme_uri . '/js/plugins/3d-slider/slider3d.css' );

		wp_enqueue_script( 'dt-plugins-slider3d-ui-core', $theme_uri . '/js/plugins/3d-slider/jquery.ui.core.js', array('jquery'), null, true );
		wp_enqueue_script( 'dt-plugins-slider3d-ui-widget', $theme_uri . '/js/plugins/3d-slider/jquery.ui.widget.js', array('jquery'), null, true );
		wp_enqueue_script( 'dt-plugins-slider3d-depthumb', $theme_uri . '/js/plugins/3d-slider/jquery.ui.slider3d-depthumb.js', array('jquery'), null, true );

		$slider_data = dt_get_images_for_sliders( 'homeslider_3d' );
		$slider_images = array();

		if ( !empty($slider_data['options']) ) {
			$slider_images = $slider_data['images'];
		}

		$slides3d = $slider_images;

		// localize 3d slides
		wp_localize_script('dt-plugins-slider3d-depthumb', 'slides3D', $slides3d );
	} elseif ( $is_home_static ) {

		wp_enqueue_style( 'dt-supersized' );
		wp_enqueue_script( 'dt-supersized' );

		if ( has_post_thumbnail() ) {
			$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
		} else {
			$img[0] = get_template_directory_uri().'/images/noimage.jpg';
		}

		$dt_ajax['home_static_data'] = array(
			'slides' => array(
				array(
					'image' => $img[0],
					'title' => get_the_title()
				)
			)
		);
	}

	wp_enqueue_script( 'dt-jquery-masonry', $theme_uri . '/js/jquery.masonry.min.js', array('jquery'), null, true );

	wp_enqueue_script( 'dt-scripts', $theme_uri . '/js/scripts.js', array('jquery'), null, true );

	if ( defined('GAL_HOME') ) {

		wp_enqueue_script( 'dt-gallery', $theme_uri . '/js/gallery.js', array('jquery'), null, true );
	}

	// localize script
	wp_localize_script('dt-scripts', 'dt_ajax', $dt_ajax );
}
add_action('wp_enqueue_scripts', 'dt_enqueue_scripts');

// add custom post type to search query
function filter_search($query) {
	if ($query->is_search) {
		$query->set('post_type', array('post', 'page', 'dt_gallery_plus', 'dt_portfolio'));
	};
	return $query;
}
add_filter('pre_get_posts', 'filter_search');

function dt_generate_contact_id() {
	static $id = 1;
	return $id++;
}

/**
 * Remove wootumblog from admin menu.
 *
 */
function dt_remove_wootumblog_from_admin_menu() {
	global $menu, $submenu;

	if( isset($submenu['edit.php'][17]) && 'edit-tags.php?taxonomy=tumblog' == $submenu['edit.php'][17][2]) {
		unset( $submenu['edit.php'][17]);
	}
}
add_action( 'admin_menu', 'dt_remove_wootumblog_from_admin_menu' );

function dt_get_theme_options( $option = '' ) {
	$options = get_option( LANGUAGE_ZONE.'_theme_options' );

	if ( !$options ) {
		return false;
	}

	if ( $option ) {
		if ( isset($options[$option]) ) {
			return $options[$option];
		}

		return false;
	}

	return $options;
}

function dt_get_images_for_sliders( $box_name = '' ) {
	global $dt_options, $post, $wpdb;
	$dt_options = $images = array();
	$options = get_post_meta( $post->ID, 'dt_'.$box_name.'_options', true );

	if ( !$options ) {
		return array();
	}

	$dt_options = $options;
	$arr = isset($options['show_'. $box_name. '_'. $options['show']]) ? $options['show_'. $box_name. '_'. $options['show']] : 'all';

	$args = array(
		'post_type' 		=>'attachment', 
		'post_mime_type'	=>'image',
		'post_status' 		=>'inherit',
		'orderby'			=>'menu_order',
		'order'				=>'ASC',
		'posts_per_page'	=>-1
	);

	$query_str = sprintf( 'SELECT `ID` FROM %s WHERE `post_type`="%s" AND post_status="publish"', $wpdb->posts, 'main_slider' );
	if ( is_array($arr) ) {
		$query_str .= ' AND ID';
		if ( 'except' == $options['show'] ) {
			$query_str .= ' NOT';
		}
		$query_str .= sprintf( ' IN(%s)', implode( ',', $arr ) );
	}
	$query_str .= ' ORDER BY post_date DESC';

	// send query to filter
	dt_parent_where_query( $query_str );

	add_filter( 'posts_where' , 'dt_posts_parents_where' );
	$slides = new Wp_Query( $args );
	remove_filter( 'posts_where' , 'dt_posts_parents_where' );

	// process images
	foreach( $slides->posts as $slide ) {
		$image = wp_get_attachment_image_src($slide->ID, 'large');
		$small_image = '';

		if ( isset($image[0]) ) {
			$tmp_src = dt_clean_thumb_url($image[0]);
			$small_image = esc_attr( get_template_directory_uri()."/thumb.php?src={$tmp_src}&w=102&h=62zc=1" );
		}

		$hide_title = get_post_meta( $slide->ID, '_dt_slider_hdesc', true );

		$title = '';
		if ( !$hide_title ) {
			$title = apply_filters('the_title', $slide->post_excerpt);
		}
/*
		$images[] = <<<HDOCK
		{image : '{$image[0]}', title : '{$title}', thumb : '{$small_image}', url : ''}
HDOCK;
*/
		$images[] = array(
			'image' => $image[0],
			'title' => $title,
			'thumb' => $small_image,
			'url' => ''
		);
	}

	return array( 'images' => $images, 'options' => $options );
}

include( get_template_directory() . '/dt-pagenavi.php');

function include_files_in_dir( $dir, $no_more = FALSE ) {
	$dir_init = $dir;
	$dir = dirname(__FILE__).$dir;

	if (!file_exists($dir)) {
		throw new Exception("Folder $dir does not exist");
	}

	$files = array();

	if ($handle = opendir( $dir )) {
		while ( false !== ($file = @readdir($handle)) ) {
			if ( is_dir( $dir.$file ) && !preg_match('/^\./', $file) && !$no_more ) {

				include_files_in_dir($dir_init.$file."/", TRUE);
			} elseif ( preg_match('/^[^~]{1}.*\.php$/', $file) ) {

				$files[] = $dir.$file;
			}
		}

		@closedir($handle);
	}

	sort($files);

	foreach ( $files as $file ) {
		include_once $file;
	}
}

/**
 * Check if jwplayer exists.
 *
 */
function dt_jwplayer_exists() {
	return file_exists( get_template_directory().'/js/jwplayer/jwplayer.js' );
}