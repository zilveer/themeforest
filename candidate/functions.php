<?php
/**
 * Candidate functions and definitions
 */
 
$temp = wp_upload_dir();

@define( 'THEMENAME', 'candidate' );    // Required!!
@define('SHORTNAME', 'sense');   // Required!!

define('MAD_BASE_PATH', trailingslashit(get_template_directory()));
define('MAD_BASE_TEXTDOMAIN', 'candidate');

@define( 'HOME_URL',  get_home_url('/'));
@define('ADMIN_PATH', get_template_directory() . '/admin');
@define('LIB_PATH', get_template_directory() . '/libs'.'/');
@define('SHOP_PATH', get_template_directory() . '/woocommerce');
@define('TEMPLATEPATH1', get_template_directory());
@define('UPLOAD_PATH', $temp['path'].'/');
@define('UPLOAD_SUBDIR', $temp['subdir'].'/');
@define('UPLOAD_URL', $temp['baseurl'].'/');


require( LIB_PATH. 'plugin-bundle.php' );






if ( ! function_exists( 'candidate_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function candidate_theme_setup() {
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( !isset( $content_width ) ) {
	$content_width = 770;
	}
	
	add_theme_support( 'menus' );
	add_theme_support( 'woocommerce' );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 50, 50, true );
	add_theme_support( 'custom-header');
	
	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background');
	
	

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'main_navigation' => __( 'Main Navigation', 'candidate' )
	) );

	require_once (ADMIN_PATH . '/theme-scripts.php');
	
	require_once(ADMIN_PATH . '/admin_script.php');

	require_once(ADMIN_PATH . '/custom-posttype.php');

	require_once(ADMIN_PATH . '/metabox-class.php');

	require_once(ADMIN_PATH . '/sidebar.php');

	require_once(ADMIN_PATH . '/metabox-sidebar.php');

	require_once(ADMIN_PATH . '/metabox-posts.php');

	require_once get_template_directory() . '/tax-meta-class/tax-meta-class.php';
	
	require_once('widgets/widgets.php');
	
	require_once('widgets/latest-tweets-widget/latest-tweets.php');
	require_once('widgets/facebook-like-box-widget/facebook-like-box-widget.php');
		
	require_once(ADMIN_PATH . '/interface.php');

	require_once ( "shortcodes/shortcodes.php");
	
	if (class_exists('WPBakeryVisualComposerAbstract')) {
		require_once ('vc_extend/vc_extend.php');
	}
	
	
	
	
	if (is_admin()){
	  /* 
	   * prefix of meta keys, optional
	   */
	  $prefix = 'candidate_';
	  /* 
	   * configure your meta box
	   */
	  $config = array(
		'id' => 'demo_meta_box',          // meta box id, unique per meta box
		'title' => 'Demo Meta Box',          // meta box title
		'pages' => array('category', 'product_cat'),        // taxonomy name, accept categories, post_tag and custom taxonomies
		'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
		'fields' => array(),            // list of meta fields (can be added by field arrays)
		'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	  );
	  
	  
	  /*
	   * Initiate your meta box
	   */
	  $my_meta =  new Tax_Meta_Class($config);
	  
	  /*
	   * Add fields to your meta box
	   */
	  
	 
	  //select field
	$my_meta->addSelect($prefix.'select_field_id',array('left'=>'Sidebar Left','right'=>'Sidebar Right','full'=>'Sidebar None'),array('name'=> esc_html__('Sidebar','candidate'), 'std'=> array('left')));
	//Finish Meta Box Decleration
	$my_meta->Finish();
	
	}
	
	

	
	
	
	
	
	/**
     * Plugin Support
     *
     * Tell plugin theme supports it. This leaves all features disabled so they can
     * be enabled explicitly below. When support not added, all features are revealed
     * so user can access content (in case switched to an unsupported theme).
     *
     * This also removes the plugin's "not using compatible theme" message.
     */
 
    add_theme_support( 'church-theme-content' );
 
    /**
     * Plugin Features
     *
     * When array of arguments not given, plugin defaults are used (enabling all taxonomies
     * and fields for feature). It is recommended to explicitly specify taxonomies and
     * fields used by theme so plugin updates don't reveal unsupported features.
     */
    // Sermons
	add_theme_support( 'ctc-sermons', array(
		'taxonomies' => array(
			'ctc_sermon_topic',
			'ctc_sermon_book',
			'ctc_sermon_series',
			'ctc_sermon_speaker',
			'ctc_sermon_tag',
		),
		'fields' => array(
			'_ctc_sermon_has_full_text',
			'_ctc_sermon_video',
			'_ctc_sermon_audio',
			'_ctc_sermon_pdf',
		),
		'field_overrides' => array()
	) );
	// Events
	add_theme_support( 'ctc-events', array(
		'taxonomies' => array(
			'ctc_event_category',
		),
		'fields' => array(
			'_ctc_event_start_date',
			'_ctc_event_end_date',
			'_ctc_event_start_time',
			'_ctc_event_end_time',
			'_ctc_event_hide_time_range',
			'_ctc_event_time',                // time description
			'_ctc_event_recurrence',
			'_ctc_event_recurrence_end_date',
			'_ctc_event_venue',
			'_ctc_event_address',
			'_ctc_event_show_directions_link',
			'_ctc_event_map_lat',
			'_ctc_event_map_lng',
			'_ctc_event_map_type',
			'_ctc_event_map_zoom',
		),
		'field_overrides' => array()
	) );
	// People
	add_theme_support( 'ctc-people', array(
		'taxonomies' => array(
			'ctc_person_group',
		),
		'fields' => array(
			'_ctc_person_position',
			'_ctc_person_phone',
			'_ctc_person_email',
			'_ctc_person_urls',
		),
		'field_overrides' => array()
	) );
	// Locations
	add_theme_support( 'ctc-locations', array(
		'taxonomies' => array(),
		'fields' => array(
			'_ctc_location_address',
			'_ctc_location_show_directions_link',
			'_ctc_location_map_lat',
			'_ctc_location_map_lng',
			'_ctc_location_map_type',
			'_ctc_location_map_zoom',
			'_ctc_location_phone',
			'_ctc_location_email',
			'_ctc_location_times',
		),
		'field_overrides' => array()
	) );
	
	
	
}
endif; // candidate_theme_setup
add_action( 'after_setup_theme', 'candidate_theme_setup' );




add_action('after_setup_theme', 'candidate_load_textdomain');
function candidate_load_textdomain () {
	load_theme_textdomain(MAD_BASE_TEXTDOMAIN, MAD_BASE_PATH  . 'lang');
}







if ( ! function_exists( 'candidate_theme_add_editor_styles' ) ) {
function candidate_theme_add_editor_styles() {
	add_editor_style( 'custom-editor-style.css' );
}
}
add_action( 'init', 'candidate_theme_add_editor_styles' );



/************************************************************************
* Add custom size
*************************************************************************/
if ( function_exists( 'add_image_size' ) ) {  
	add_image_size( 'post-blog', 847, 477, true );
	add_image_size( 'post-full', 1140, 600, true );
	add_image_size( 'th-shop', 266, 266, true );
	add_image_size( 'th-sidebar', 70, 70, true );
	add_image_size( 'latest-post', 263, 177, true ); 
	add_image_size( 'extended-portfolio', 1920, 670, true ); 
	add_image_size( 'portfolio3', 500, 335, true ); 
	add_image_size( 'team1', 555, 480, true ); 
	
} 


//add body custom class
add_filter('body_class','candidate_class_names'); 

if ( ! function_exists( 'candidate_class_names' ) ) {
function candidate_class_names($classes) {  
	$layout_color = 'sticky-header-off ';
	$page_layout = 'wide'; // Page Layout (values: 'boxed', 'wide')

	if(get_option('sense_show_sticky_header') && get_option('sense_show_sticky_header') != 'hide') {
	$layout_color = 'sticky-header-on tablet-sticky-header ';
	}
	
	if(get_option('sense_settings_bg') && get_option('sense_settings_bg') != '') {
	$page_layout = get_option('sense_settings_bg');
	}
	$layout_color .= $page_layout;
	
	$classes[] = $layout_color;
    return $classes;  
}  
}


if ( ! function_exists( 'candidat_filter_wp_title' ) ) {
function candidat_filter_wp_title( $title ) {
	if ( is_feed() ) {
		return $title;
	}
	$sep="-";
	global $page, $paged;
	$title = '';
	// Add the blog name
	$title .= ' '.get_bloginfo( 'name', 'display' );
	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= $sep.' ';
		$title .= $site_description;
	}
	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= $sep . sprintf( __( 'Page %s', 'candidate' ), max( $paged, $page ) );
	}

	return $title;
}
}
// Hook into 'wp_title'
add_filter( 'wp_title', 'candidat_filter_wp_title' );





// Filter to replace default css class names for vc_row shortcode and vc_column
add_filter( 'vc_shortcodes_css_class', 'candidat_custom_css_classes_for_vc_row_and_vc_column', 10, 2 );
if ( ! function_exists( 'candidat_custom_css_classes_for_vc_row_and_vc_column' ) ) {
function candidat_custom_css_classes_for_vc_row_and_vc_column( $class_string, $tag ) {
  if ( $tag == 'vc_row' || $tag == 'vc_row_inner' ) {
    $class_string = str_replace( 'vc_row-fluid', 'row', $class_string ); 
  }
  if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
   // $class_string = preg_replace( '/vc_col-sm-(\d{1,2})/', 'col-sm-$1', $class_string ); 
  }
  return $class_string; 
}
}
/*
* Get Fontello icons
*/
if ( ! function_exists( 'candidat_custom_fontello_classes' ) ) {
	function candidat_custom_fontello_classes() {
			

		$fontIcons       = 'icon-docs, icon-emo-happy, icon-odnoklassniki-rect-1, icon-emo-wink2, icon-emo-unhappy, icon-emo-sleep, icon-emo-thumbsup, icon-emo-devil, icon-emo-surprised, icon-emo-tongue, icon-emo-coffee, icon-emo-sunglasses, icon-emo-displeased, icon-emo-beer, icon-emo-grin, icon-emo-angry, icon-emo-saint, icon-emo-cry, icon-emo-shoot, icon-emo-squint, icon-emo-laugh, icon-spin1, icon-spin2, icon-spin3, icon-spin4, icon-spin5, icon-spin6, icon-firefox, icon-chrome-1, icon-opera, icon-ie-1, icon-crown, icon-crown-plus, icon-crown-minus, icon-marquee, icon-glass, icon-music, icon-search, icon-mail, icon-mail-alt, icon-heart, icon-heart-empty, icon-star, icon-star-empty, icon-star-half, icon-star-half-alt, icon-user, icon-users, icon-male, icon-female, icon-video, icon-videocam, icon-picture, icon-camera, icon-camera-alt, icon-th-large, icon-th, icon-th-list, icon-ok, icon-ok-circled, icon-ok-circled2, icon-ok-squared, icon-cancel, icon-cancel-circled, icon-cancel-circled2, icon-plus, icon-plus-circled, icon-plus-squared, icon-plus-squared-alt, icon-minus, icon-minus-circled, icon-minus-squared, icon-minus-squared-alt, icon-help, icon-help-circled, icon-info-circled, icon-info, icon-home, icon-link, icon-unlink, icon-link-ext, icon-link-ext-alt, icon-attach, icon-lock, icon-lock-open, icon-lock-open-alt, icon-pin, icon-eye, icon-eye-off, icon-tag, icon-tags, icon-bookmark, icon-bookmark-empty, icon-flag, icon-flag-empty, icon-flag-checkered, icon-thumbs-up, icon-thumbs-down, icon-thumbs-up-alt, icon-thumbs-down-alt, icon-download, icon-upload, icon-download-cloud, icon-upload-cloud, icon-reply, icon-reply-all, icon-forward, icon-quote-left, icon-quote-right, icon-code, icon-export, icon-export-alt, icon-pencil, icon-pencil-squared, icon-edit, icon-print, icon-retweet, icon-keyboard, icon-gamepad, icon-comment, icon-chat, icon-comment-empty, icon-chat-empty, icon-bell, icon-bell-alt, icon-attention-alt, icon-attention, icon-attention-circled, icon-location, icon-direction, icon-compass, icon-trash, icon-doc, icon-docs-1, icon-doc-text, icon-doc-inv, icon-doc-text-inv, icon-folder, icon-folder-open, icon-folder-empty, icon-folder-open-empty, icon-box, icon-rss, icon-rss-squared, icon-phone, icon-phone-squared, icon-menu, icon-cog, icon-cog-alt, icon-wrench, icon-basket, icon-calendar, icon-calendar-empty, icon-login, icon-logout, icon-mic, icon-mute, icon-volume-off, icon-volume-down, icon-volume-up, icon-headphones, icon-clock, icon-lightbulb, icon-block, icon-resize-full, icon-resize-full-alt, icon-resize-small, icon-resize-vertical, icon-resize-horizontal, icon-move, icon-zoom-in, icon-zoom-out, icon-down-circled2, icon-up-circled2, icon-left-circled2, icon-right-circled2, icon-down-dir, icon-up-dir, icon-left-dir, icon-right-dir, icon-down-open, icon-left-open, icon-right-open, icon-up-open, icon-angle-left, icon-angle-right, icon-angle-up, icon-angle-down, icon-angle-circled-left, icon-angle-circled-right, icon-angle-circled-up, icon-angle-circled-down, icon-angle-double-left, icon-angle-double-right, icon-angle-double-up, icon-angle-double-down, icon-down, icon-left, icon-right, icon-up, icon-down-big, icon-left-big, icon-emo-wink, icon-up-big, icon-right-hand, icon-left-hand, icon-up-hand, icon-down-hand, icon-left-circled, icon-right-circled, icon-up-circled, icon-down-circled, icon-cw, icon-ccw, icon-arrows-cw, icon-level-up, icon-level-down, icon-shuffle, icon-exchange, icon-expand, icon-collapse, icon-expand-right, icon-collapse-left, icon-play, icon-play-circled, icon-play-circled2, icon-stop, icon-pause, icon-to-end, icon-to-end-alt, icon-to-start, icon-to-start-alt, icon-fast-fw, icon-fast-bw, icon-eject, icon-target, icon-signal, icon-award, icon-desktop, icon-laptop, icon-tablet, icon-mobile, icon-inbox, icon-globe, icon-sun, icon-cloud, icon-flash, icon-moon, icon-umbrella, icon-flight, icon-fighter-jet, icon-leaf, icon-font, icon-bold, icon-italic, icon-text-height, icon-text-width, icon-align-left, icon-align-center, icon-align-right, icon-align-justify, icon-list, icon-indent-left, icon-indent-right, icon-list-bullet, icon-list-numbered, icon-strike, icon-underline, icon-superscript, icon-subscript, icon-table, icon-columns, icon-crop, icon-scissors, icon-paste, icon-briefcase, icon-suitcase, icon-ellipsis, icon-ellipsis-vert, icon-off, icon-road, icon-list-alt, icon-qrcode, icon-barcode, icon-book, icon-ajust, icon-tint, icon-check, icon-check-empty, icon-circle, icon-circle-empty, icon-dot-circled, icon-asterisk, icon-gift, icon-fire, icon-magnet, icon-chart-bar, icon-ticket, icon-credit-card, icon-floppy, icon-megaphone, icon-hdd, icon-key, icon-fork, icon-rocket, icon-bug, icon-certificate, icon-tasks, icon-filter, icon-beaker, icon-magic, icon-truck, icon-money, icon-euro, icon-pound, icon-dollar, icon-rupee, icon-yen, icon-rouble, icon-try, icon-won, icon-bitcoin, icon-sort, icon-sort-down, icon-sort-up, icon-sort-alt-up, icon-sort-alt-down, icon-sort-name-up, icon-sort-name-down, icon-sort-number-up, icon-sort-number-down, icon-hammer, icon-gauge, icon-sitemap, icon-spinner, icon-coffee, icon-food, icon-beer, icon-user-md, icon-stethoscope, icon-ambulance, icon-medkit, icon-h-sigh, icon-hospital, icon-building, icon-smile, icon-frown, icon-meh, icon-anchor, icon-terminal, icon-eraser, icon-puzzle, icon-shield, icon-extinguisher, icon-bullseye, icon-wheelchair, icon-adn, icon-android, icon-apple, icon-bitbucket, icon-bitbucket-squared, icon-css3, icon-dribbble, icon-dropbox, icon-facebook, icon-facebook-squared, icon-flickr, icon-foursquare, icon-github, icon-github-squared, icon-github-circled, icon-gittip, icon-gplus-squared, icon-gplus, icon-html5, icon-instagramm, icon-linkedin-squared, icon-linux, icon-linkedin, icon-maxcdn, icon-pagelines, icon-pinterest-circled, icon-pinterest-squared, icon-renren, icon-skype, icon-stackexchange, icon-stackoverflow, icon-trello, icon-tumblr, icon-tumblr-squared, icon-twitter-squared, icon-twitter, icon-vimeo-squared, icon-vkontakte, icon-weibo, icon-windows, icon-xing, icon-xing-squared, icon-youtube, icon-youtube-squared, icon-youtube-play, icon-blank, icon-lemon, icon-note, icon-note-beamed, icon-music-1, icon-search-1, icon-flashlight, icon-mail-1, icon-heart-1, icon-heart-empty-1, icon-star-1, icon-star-empty-1, icon-user-1, icon-users-1, icon-user-add, icon-video-1, icon-picture-1, icon-camera-1, icon-layout, icon-menu-1, icon-check-1, icon-cancel-1, icon-cancel-circled-1, icon-cancel-squared, icon-plus-1, icon-plus-circled-1, icon-plus-squared-1, icon-minus-1, icon-minus-circled-1, icon-minus-squared-1, icon-help-1, icon-help-circled-1, icon-info-1, icon-info-circled-1, icon-back, icon-home-1, icon-link-1, icon-attach-1, icon-lock-1, icon-lock-open-1, icon-eye-1, icon-tag-1, icon-bookmark-1, icon-bookmarks, icon-flag-1, icon-thumbs-up-1, icon-thumbs-down-1, icon-download-1, icon-upload-1, icon-upload-cloud-1, icon-reply-1, icon-reply-all-1, icon-forward-1, icon-quote, icon-code-1, icon-export-1, icon-pencil-1, icon-feather, icon-print-1, icon-retweet-1, icon-keyboard-1, icon-comment-1, icon-chat-1, icon-bell-1, icon-attention-1, icon-alert, icon-vcard, icon-address, icon-location-1, icon-map, icon-direction-1, icon-compass-1, icon-cup, icon-trash-1, icon-doc-1, icon-doc-landscape, icon-doc-text-1, icon-doc-text-inv-1, icon-newspaper, icon-book-open, icon-book-1, icon-folder-1, icon-archive, icon-box-1, icon-rss-1, icon-phone-1, icon-cog-1, icon-tools, icon-share, icon-shareable, icon-basket-1, icon-bag, icon-calendar-1, icon-login-1, icon-logout-1, icon-mic-1, icon-mute-1, icon-sound, icon-volume, icon-clock-1, icon-hourglass, icon-lamp, icon-light-down, icon-light-up, icon-adjust, icon-block-1, icon-resize-full-1, icon-resize-small-1, icon-popup, icon-publish, icon-window, icon-arrow-combo, icon-down-circled-1, icon-left-circled-1, icon-right-circled-1, icon-up-circled-1, icon-down-open-1, icon-left-open-1, icon-right-open-1, icon-up-open-1, icon-down-open-mini, icon-left-open-mini, icon-right-open-mini, icon-up-open-mini, icon-down-open-big, icon-left-open-big, icon-right-open-big, icon-up-open-big, icon-down-1, icon-left-1, icon-right-1, icon-up-1, icon-down-dir-1, icon-left-dir-1, icon-right-dir-1, icon-up-dir-1, icon-down-bold, icon-left-bold, icon-right-bold, icon-up-bold, icon-down-thin, icon-left-thin, icon-right-thin, icon-up-thin, icon-ccw-1, icon-cw-1, icon-arrows-ccw, icon-level-down-1, icon-level-up-1, icon-shuffle-1, icon-loop, icon-switch, icon-play-1, icon-stop-1, icon-pause-1, icon-record, icon-to-end-1, icon-to-start-1, icon-fast-forward, icon-fast-backward, icon-progress-0, icon-progress-1, icon-progress-2, icon-progress-3, icon-target-1, icon-palette, icon-list-1, icon-list-add, icon-signal-1, icon-trophy, icon-battery, icon-back-in-time, icon-monitor, icon-mobile-1, icon-network, icon-cd, icon-inbox-1, icon-install, icon-globe-1, icon-cloud-1, icon-cloud-thunder, icon-flash-1, icon-moon-1, icon-flight-1, icon-paper-plane, icon-leaf-1, icon-lifebuoy, icon-mouse, icon-briefcase-1, icon-suitcase-1, icon-dot, icon-dot-2, icon-dot-3, icon-brush, icon-magnet-1, icon-infinity, icon-erase, icon-chart-pie, icon-chart-line, icon-chart-bar-1, icon-chart-area, icon-tape, icon-graduation-cap, icon-language, icon-ticket-1, icon-water, icon-droplet, icon-air, icon-credit-card-1, icon-floppy-1, icon-clipboard, icon-megaphone-1, icon-database, icon-drive, icon-bucket, icon-thermometer, icon-key-1, icon-flow-cascade, icon-flow-branch, icon-flow-tree, icon-flow-line, icon-flow-parallel, icon-rocket-1, icon-gauge-1, icon-traffic-cone, icon-cc, icon-cc-by, icon-cc-nc, icon-cc-nc-eu, icon-cc-nc-jp, icon-cc-sa, icon-cc-nd, icon-cc-pd, icon-cc-zero, icon-cc-share, icon-cc-remix, icon-github-1, icon-github-circled-1, icon-flickr-1, icon-flickr-circled, icon-vimeo, icon-vimeo-circled, icon-twitter-1, icon-twitter-circled, icon-facebook-1, icon-facebook-circled, icon-facebook-squared-1, icon-gplus-1, icon-gplus-circled, icon-pinterest, icon-pinterest-circled-1, icon-tumblr-1, icon-tumblr-circled, icon-linkedin-1, icon-linkedin-circled, icon-dribbble-1, icon-dribbble-circled, icon-stumbleupon, icon-stumbleupon-circled, icon-lastfm, icon-lastfm-circled, icon-rdio, icon-rdio-circled, icon-spotify, icon-spotify-circled, icon-qq, icon-instagram, icon-dropbox-1, icon-evernote, icon-flattr, icon-skype-1, icon-skype-circled, icon-renren-1, icon-sina-weibo, icon-paypal, icon-picasa, icon-soundcloud, icon-mixi, icon-behance, icon-google-circles, icon-vkontakte-1, icon-smashing, icon-sweden, icon-db-shape, icon-logo-db, icon-music-outline, icon-music-2, icon-search-outline, icon-search-2, icon-mail-2, icon-heart-2, icon-heart-filled, icon-star-2, icon-star-filled, icon-user-outline, icon-user-2, icon-users-outline, icon-users-2, icon-user-add-outline, icon-user-add-1, icon-user-delete-outline, icon-user-delete, icon-video-2, icon-videocam-outline, icon-videocam-1, icon-picture-outline, icon-picture-2, icon-camera-outline, icon-camera-2, icon-th-outline, icon-th-1, icon-th-large-outline, icon-th-large-1, icon-th-list-outline, icon-th-list-1, icon-ok-outline, icon-ok-1, icon-cancel-outline, icon-cancel-2, icon-cancel-alt, icon-cancel-alt-filled, icon-cancel-circled-outline, icon-cancel-circled-2, icon-plus-outline, icon-plus-2, icon-minus-outline, icon-minus-2, icon-divide-outline, icon-divide, icon-eq-outline, icon-eq, icon-info-outline, icon-info-2, icon-home-outline, icon-home-2, icon-link-outline, icon-link-2, icon-attach-outline, icon-attach-2, icon-lock-2, icon-lock-filled, icon-lock-open-2, icon-lock-open-filled, icon-pin-outline, icon-pin-1, icon-eye-outline, icon-eye-2, icon-tag-2, icon-tags-1, icon-bookmark-2, icon-flag-2, icon-flag-filled, icon-thumbs-up-2, icon-thumbs-down-2, icon-download-outline, icon-download-2, icon-upload-outline, icon-upload-2, icon-upload-cloud-outline, icon-upload-cloud-2, icon-reply-outline, icon-reply-2, icon-forward-outline, icon-forward-2, icon-code-outline, icon-code-2, icon-export-outline, icon-export-2, icon-pencil-2, icon-pen, icon-feather-1, icon-edit-1, icon-print-2, icon-comment-2, icon-chat-2, icon-chat-alt, icon-bell-2, icon-attention-2, icon-attention-filled, icon-warning-empty, icon-warning, icon-contacts, icon-vcard-1, icon-address-1, icon-location-outline, icon-location-2, icon-map-1, icon-direction-outline, icon-direction-2, icon-compass-2, icon-trash-2, icon-doc-2, icon-doc-text-2, icon-doc-add, icon-doc-remove, icon-news, icon-folder-2, icon-folder-add, icon-folder-delete, icon-archive-1, icon-box-2, icon-rss-outline, icon-rss-2, icon-phone-outline, icon-phone-2, icon-menu-outline, icon-menu-2, icon-cog-outline, icon-cog-2, icon-wrench-outline, icon-wrench-1, icon-basket-2, icon-calendar-outlilne, icon-calendar-2, icon-mic-outline, icon-mic-2, icon-volume-off-1, icon-volume-low, icon-volume-middle, icon-volume-high, icon-headphones-1, icon-clock-2, icon-wristwatch, icon-stopwatch, icon-lightbulb-1, icon-block-outline, icon-block-2, icon-resize-full-outline, icon-resize-full-2, icon-resize-normal-outline, icon-resize-normal, icon-move-outline, icon-move-1, icon-popup-1, icon-zoom-in-outline, icon-zoom-in-1, icon-zoom-out-outline, icon-zoom-out-1, icon-popup-2, icon-left-open-outline, icon-left-open-2, icon-right-open-outline, icon-right-open-2, icon-down-2, icon-left-2, icon-right-2, icon-up-2, icon-down-outline, icon-left-outline, icon-right-outline, icon-up-outline, icon-down-small, icon-left-small, icon-right-small, icon-up-small, icon-cw-outline, icon-cw-2, icon-arrows-cw-outline, icon-arrows-cw-1, icon-loop-outline, icon-loop-1, icon-loop-alt-outline, icon-loop-alt, icon-shuffle-2, icon-play-outline, icon-play-2, icon-stop-outline, icon-stop-2, icon-pause-outline, icon-pause-2, icon-fast-fw-outline, icon-fast-fw-1, icon-rewind-outline, icon-rewind, icon-record-outline, icon-record-1, icon-eject-outline, icon-eject-1, icon-eject-alt-outline, icon-eject-alt, icon-bat1, icon-bat2, icon-bat3, icon-bat4, icon-bat-charge, icon-plug, icon-target-outline, icon-target-2, icon-wifi-outline, icon-wifi, icon-desktop-1, icon-laptop-1, icon-tablet-1, icon-mobile-2, icon-contrast, icon-globe-outline, icon-globe-2, icon-globe-alt-outline, icon-globe-alt, icon-sun-1, icon-sun-filled, icon-cloud-2, icon-flash-outline, icon-flash-2, icon-moon-2, icon-waves-outline, icon-waves, icon-rain, icon-cloud-sun, icon-drizzle, icon-snow, icon-cloud-flash, icon-cloud-wind, icon-wind, icon-plane-outline, icon-plane, icon-leaf-2, icon-lifebuoy-1, icon-briefcase-2, icon-brush-1, icon-pipette, icon-power-outline, icon-power, icon-check-outline, icon-check-2, icon-gift-1, icon-temperatire, icon-chart-outline, icon-chart, icon-chart-alt-outline, icon-chart-alt, icon-chart-bar-outline, icon-chart-bar-2, icon-chart-pie-outline, icon-chart-pie-1, icon-ticket-2, icon-credit-card-2, icon-clipboard-1, icon-database-1, icon-key-outline, icon-key-2, icon-flow-split, icon-flow-merge, icon-flow-parallel-1, icon-flow-cross, icon-certificate-outline, icon-certificate-1, icon-scissors-outline, icon-scissors-1, icon-flask, icon-wine, icon-coffee-1, icon-beer-1, icon-anchor-outline, icon-anchor-1, icon-puzzle-outline, icon-puzzle-1, icon-tree, icon-calculator, icon-infinity-outline, icon-infinity-1, icon-pi-outline, icon-pi, icon-at, icon-at-circled, icon-looped-square-outline, icon-looped-square-interest, icon-sort-alphabet-outline, icon-sort-alphabet, icon-sort-numeric-outline, icon-sort-numeric, icon-dribbble-circled-1, icon-dribbble-2, icon-facebook-circled-1, icon-facebook-2, icon-flickr-circled-1, icon-flickr-2, icon-github-circled-2, icon-github-2, icon-lastfm-circled-1, icon-lastfm-1, icon-linkedin-circled-1, icon-linkedin-2, icon-pinterest-circled-2, icon-pinterest-1, icon-skype-outline, icon-skype-2, icon-tumbler-circled, icon-tumbler, icon-twitter-circled-1, icon-twitter-2, icon-vimeo-circled-1, icon-vimeo-1, icon-search-3, icon-mail-3, icon-heart-3, icon-heart-empty-2, icon-star-3, icon-user-3, icon-video-3, icon-picture-3, icon-camera-3, icon-ok-2, icon-ok-circle, icon-cancel-3, icon-cancel-circle, icon-plus-3, icon-plus-circle, icon-minus-3, icon-minus-circle, icon-help-2, icon-info-3, icon-home-3, icon-link-3, icon-attach-3, icon-lock-3, icon-lock-empty, icon-lock-open-3, icon-lock-open-empty, icon-pin-2, icon-eye-3, icon-tag-3, icon-tag-empty, icon-download-3, icon-upload-3, icon-download-cloud-1, icon-upload-cloud-3, icon-quote-left-1, icon-quote-right-1, icon-quote-left-alt, icon-quote-right-alt, icon-pencil-3, icon-pencil-neg, icon-pencil-alt, icon-undo, icon-comment-3, icon-comment-inv, icon-comment-alt, icon-comment-inv-alt, icon-comment-alt2, icon-comment-inv-alt2, icon-chat-3, icon-chat-inv, icon-location-3, icon-location-inv, icon-location-alt, icon-compass-3, icon-trash-3, icon-trash-empty, icon-doc-3, icon-doc-inv-1, icon-doc-alt, icon-doc-inv-alt, icon-article, icon-article-alt, icon-book-open-1, icon-folder-3, icon-folder-empty-1, icon-box-3, icon-rss-3, icon-rss-alt, icon-cog-3, icon-wrench-2, icon-share-1, icon-calendar-3, icon-calendar-inv, icon-calendar-alt, icon-mic-3, icon-volume-off-2, icon-volume-up-1, icon-headphones-2, icon-clock-3, icon-lamp-1, icon-block-3, icon-resize-full-3, icon-resize-full-alt-1, icon-resize-small-2, icon-resize-small-alt, icon-resize-vertical-1, icon-resize-horizontal-1, icon-move-2, icon-popup-3, icon-down-3, icon-left-3, icon-right-3, icon-up-3, icon-down-circle, icon-left-circle, icon-right-circle, icon-up-circle, icon-cw-3, icon-loop-2, icon-loop-alt-1, icon-exchange-1, icon-split, icon-arrow-curved, icon-play-3, icon-play-circle2, icon-stop-3, icon-pause-3, icon-to-start-2, icon-to-end-2, icon-eject-2, icon-target-3, icon-signal-2, icon-award-1, icon-award-empty, icon-list-2, icon-list-nested, icon-bat-empty, icon-bat-half, icon-bat-full, icon-bat-charge-1, icon-mobile-3, icon-cd-1, icon-equalizer, icon-cursor, icon-aperture, icon-aperture-alt, icon-steering-wheel, icon-book-2, icon-book-alt, icon-brush-2, icon-brush-alt, icon-eyedropper, icon-layers, icon-layers-alt, icon-sun-2, icon-sun-inv, icon-cloud-3, icon-rain-1, icon-flash-3, icon-moon-3, icon-moon-inv, icon-umbrella-1, icon-chart-bar-3, icon-chart-pie-2, icon-chart-pie-alt, icon-key-3, icon-key-inv, icon-hash, icon-at-1, icon-pilcrow, icon-dial, icon-search-4, icon-mail-4, icon-heart-4, icon-star-4, icon-user-4, icon-user-woman, icon-user-pair, icon-video-alt, icon-videocam-2, icon-videocam-alt, icon-camera-4, icon-th-2, icon-th-list-2, icon-ok-3, icon-cancel-4, icon-cancel-circle-1, icon-plus-4, icon-home-4, icon-lock-4, icon-lock-open-4, icon-eye-4, icon-tag-4, icon-thumbs-up-3, icon-thumbs-down-3, icon-download-4, icon-export-3, icon-pencil-4, icon-pencil-alt-1, icon-edit-2, icon-chat-4, icon-print-3, icon-bell-3, icon-attention-3, icon-info-4, icon-question, icon-location-4, icon-trash-4, icon-doc-4, icon-article-1, icon-article-alt-1, icon-rss-4, icon-wrench-3, icon-basket-3, icon-basket-alt, icon-calendar-4, icon-calendar-alt-1, icon-volume-off-3, icon-volume-down-1, icon-volume-up-2, icon-bullhorn, icon-clock-4, icon-clock-alt, icon-stop-4, icon-resize-full-4, icon-resize-small-3, icon-zoom-in-2, icon-zoom-out-2, icon-popup-4, icon-down-dir-2, icon-left-dir-2, icon-right-dir-2, icon-up-dir-2, icon-down-4, icon-up-4, icon-cw-4, icon-signal-3, icon-award-2, icon-mobile-4, icon-mobile-alt, icon-tablet-2, icon-ipod, icon-cd-2, icon-grid, icon-book-3, icon-easel, icon-globe-3, icon-chart-1, icon-chart-bar-4, icon-chart-pie-3, icon-dollar-1, icon-at-2, icon-colon, icon-semicolon, icon-squares, icon-money-1, icon-facebook-3, icon-facebook-rect, icon-twitter-3, icon-twitter-bird, icon-twitter-rect, icon-youtube-1, icon-windy-rain-inv, icon-snow-inv, icon-snow-heavy-inv, icon-hail-inv, icon-clouds-inv, icon-clouds-flash-inv, icon-temperature, icon-compass-4, icon-na, icon-celcius, icon-fahrenheit, icon-clouds-flash-alt, icon-sun-inv-1, icon-moon-inv-1, icon-cloud-sun-inv, icon-cloud-moon-inv, icon-cloud-inv, icon-cloud-flash-inv, icon-drizzle-inv, icon-rain-inv, icon-windy-inv, icon-sunrise, icon-sun-3, icon-moon-4, icon-eclipse, icon-mist, icon-wind-1, icon-snowflake, icon-cloud-sun-1, icon-cloud-moon, icon-fog-sun, icon-fog-moon, icon-fog-cloud, icon-fog, icon-cloud-4, icon-cloud-flash-1, icon-cloud-flash-alt, icon-drizzle-1, icon-rain-2, icon-windy, icon-windy-rain, icon-snow-1, icon-snow-alt, icon-snow-heavy, icon-hail, icon-clouds, icon-clouds-flash, icon-search-5, icon-mail-5, icon-heart-5, icon-heart-broken, icon-star-5, icon-star-empty-2, icon-star-half-1, icon-star-half_empty, icon-user-5, icon-user-male, icon-user-female, icon-users-3, icon-movie, icon-videocam-3, icon-isight, icon-camera-5, icon-menu-3, icon-th-thumb, icon-th-thumb-empty, icon-th-list-3, icon-ok-4, icon-ok-circled-1, icon-cancel-5, icon-cancel-circled-3, icon-plus-5, icon-help-circled-2, icon-help-circled-alt, icon-info-circled-2, icon-info-circled-alt, icon-home-5, icon-link-4, icon-attach-4, icon-lock-5, icon-lock-alt, icon-lock-open-5, icon-lock-open-alt-1, icon-eye-5, icon-download-5, icon-upload-4, icon-download-cloud-2, icon-upload-cloud-4, icon-reply-3, icon-pencil-5, icon-export-4, icon-print-4, icon-retweet-2, icon-comment-4, icon-chat-5, icon-bell-4, icon-attention-4, icon-attention-alt-1, icon-location-5, icon-trash-5, icon-doc-5, icon-newspaper-1, icon-folder-4, icon-folder-open-1, icon-folder-empty-2, icon-folder-open-empty-1, icon-cog-4, icon-calendar-5, icon-login-2, icon-logout-2, icon-mic-4, icon-mic-off, icon-clock-5, icon-stopwatch-1, icon-hourglass-1, icon-zoom-in-3, icon-zoom-out-3, icon-down-open-2, icon-left-open-3, icon-right-open-3, icon-up-open-2, icon-down-5, icon-left-4, icon-right-4, icon-up-5, icon-down-bold-1, icon-left-bold-1, icon-right-bold-1, icon-up-bold-1, icon-down-fat, icon-left-fat, icon-right-fat, icon-up-fat, icon-ccw-2, icon-shuffle-3, icon-play-4, icon-pause-4, icon-stop-5, icon-to-end-3, icon-to-start-3, icon-fast-forward-1, icon-fast-backward-1, icon-trophy-1, icon-monitor-1, icon-tablet-3, icon-mobile-5, icon-data-science, icon-data-science-inv, icon-inbox-2, icon-globe-4, icon-globe-inv, icon-flash-4, icon-cloud-5, icon-coverflow, icon-coverflow-empty, icon-math, icon-math-circled, icon-math-circled-empty, icon-paper-plane-1, icon-paper-plane-alt, icon-paper-plane-alt2, icon-fontsize, icon-color-adjust, icon-fire-1, icon-chart-bar-5, icon-hdd-1, icon-connected-object, icon-ruler, icon-vector, icon-vector-pencil, icon-at-3, icon-hash-1, icon-female-1, icon-male-1, icon-spread, icon-king, icon-anchor-2, icon-joystick, icon-spinner1, icon-spinner2, icon-github-3, icon-github-circled-3, icon-github-circled-alt, icon-github-circled-alt2, icon-twitter-4, icon-twitter-circled-2, icon-facebook-4, icon-facebook-circled-2, icon-gplus-2, icon-gplus-circled-1, icon-linkedin-3, icon-linkedin-circled-2, icon-dribbble-3, icon-dribbble-circled-2, icon-instagram-1, icon-instagram-circled, icon-soundcloud-1, icon-soundcloud-circled, icon-mfg-logo, icon-mfg-logo-circled, icon-aboveground-rail, icon-airfield, icon-airport, icon-art-gallery, icon-bar, icon-baseball, icon-basketball, icon-beer-2, icon-belowground-rail, icon-bicycle, icon-bus, icon-cafe, icon-campsite, icon-cemetery, icon-cinema, icon-college, icon-commerical-building, icon-credit-card-3, icon-cricket, icon-embassy, icon-fast-food, icon-ferry, icon-fire-station, icon-football, icon-fuel, icon-garden, icon-giraffe, icon-golf, icon-grocery-store, icon-harbor, icon-heliport, icon-hospital-1, icon-industrial-building, icon-library, icon-lodging, icon-london-underground, icon-minefield, icon-monument, icon-museum, icon-pharmacy, icon-pitch, icon-police, icon-post, icon-prison, icon-rail, icon-religious-christian, icon-religious-islam, icon-religious-jewish, icon-restaurant, icon-roadblock, icon-school, icon-shop, icon-skiing, icon-soccer, icon-swimming, icon-tennis, icon-theatre, icon-toilet, icon-town-hall, icon-trash-6, icon-tree-1, icon-tree-2, icon-warehouse, icon-duckduckgo, icon-aim, icon-delicious, icon-paypal-1, icon-flattr-1, icon-android-1, icon-eventful, icon-smashmag, icon-gplus-3, icon-wikipedia, icon-lanyrd, icon-calendar-6, icon-stumbleupon-1, icon-fivehundredpx, icon-pinterest-2, icon-bitcoin-1, icon-w3c, icon-foursquare-1, icon-html5-1, icon-ie, icon-call, icon-grooveshark, icon-ninetyninedesigns, icon-forrst, icon-digg, icon-spotify-1, icon-reddit, icon-guest, icon-gowalla, icon-appstore, icon-blogger, icon-cc-1, icon-dribbble-4, icon-evernote-1, icon-flickr-3, icon-google, icon-viadeo, icon-instapaper, icon-weibo-1, icon-klout, icon-linkedin-4, icon-meetup, icon-vk, icon-plancast, icon-disqus, icon-rss-5, icon-skype-3, icon-twitter-5, icon-youtube-2, icon-vimeo-2, icon-windows-1, icon-xing-1, icon-yahoo, icon-chrome, icon-email, icon-macstore, icon-myspace, icon-podcast, icon-amazon, icon-steam, icon-cloudapp, icon-dropbox-2, icon-ebay, icon-facebook-5, icon-github-4, icon-github-circled-4, icon-googleplay, icon-itunes, icon-plurk, icon-songkick, icon-lastfm-2, icon-gmail, icon-pinboard, icon-openid, icon-quora, icon-soundcloud-2, icon-tumblr-2, icon-eventasaurus, icon-wordpress, icon-yelp, icon-intensedebate, icon-eventbrite, icon-scribd, icon-posterous, icon-stripe, icon-opentable, icon-cart, icon-print-5, icon-angellist, icon-instagram-2, icon-dwolla, icon-appnet, icon-statusnet, icon-acrobat, icon-drupal, icon-buffer, icon-pocket, icon-bitbucket-1, icon-lego, icon-login-3, icon-stackoverflow-1, icon-hackernews, icon-lkdto, icon-facebook-6, icon-facebook-rect-1, icon-twitter-6, icon-twitter-bird-1, icon-vimeo-3, icon-vimeo-rect, icon-tumblr-3, icon-tumblr-rect, icon-googleplus-rect, icon-github-text, icon-github-5, icon-skype-4, icon-icq, icon-yandex, icon-yandex-rect, icon-vkontakte-rect, icon-odnoklassniki, icon-odnoklassniki-rect, icon-friendfeed, icon-friendfeed-rect, icon-blogger-1, icon-blogger-rect, icon-deviantart, icon-jabber, icon-lastfm-3, icon-lastfm-rect, icon-linkedin-5, icon-linkedin-rect, icon-picasa-1, icon-wordpress-1, icon-instagram-3, icon-instagram-filled, icon-diigo, icon-box-4, icon-box-rect, icon-tudou, icon-youku, icon-win8, icon-amex, icon-discover, icon-visa, icon-mastercard, icon-glass-1, icon-music-3, icon-search-6, icon-search-circled, icon-mail-6, icon-mail-circled, icon-heart-6, icon-heart-circled, icon-heart-empty-3, icon-star-6, icon-star-circled, icon-star-empty-3, icon-user-6, icon-group, icon-group-circled, icon-torso, icon-video-4, icon-video-circled, icon-video-alt-1, icon-videocam-4, icon-video-chat, icon-picture-4, icon-camera-6, icon-photo, icon-photo-circled, icon-th-large-2, icon-th-3, icon-th-list-4, icon-view-mode, icon-ok-5, icon-ok-circled-2, icon-ok-circled2-1, icon-cancel-6, icon-cancel-circled-4, icon-cancel-circled2-1, icon-plus-6, icon-plus-circled-2, icon-minus-4, icon-minus-circled-2, icon-help-3, icon-help-circled-3, icon-info-circled-3, icon-home-6, icon-home-circled, icon-website, icon-website-circled, icon-attach-5, icon-attach-circled, icon-lock-6, icon-lock-circled, icon-lock-open-6, icon-lock-open-alt-2, icon-eye-6, icon-eye-off-1, icon-tag-5, icon-tags-2, icon-bookmark-3, icon-bookmark-empty-1, icon-flag-3, icon-flag-circled, icon-thumbs-up-4, icon-thumbs-down-4, icon-download-6, icon-download-alt, icon-upload-5, icon-share-2, icon-quote-1, icon-quote-circled, icon-export-5, icon-pencil-6, icon-pencil-circled, icon-edit-3, icon-edit-circled, icon-edit-alt, icon-print-6, icon-retweet-3, icon-comment-5, icon-comment-alt-1, icon-bell-5, icon-warning-1, icon-exclamation, icon-error, icon-error-alt, icon-location-6, icon-location-circled, icon-compass-5, icon-compass-circled, icon-trash-7, icon-trash-circled, icon-doc-6, icon-doc-circled, icon-doc-new, icon-doc-new-circled, icon-folder-5, icon-folder-circled, icon-folder-close, icon-folder-open-2, icon-rss-6, icon-phone-3, icon-phone-circled, icon-cog-5, icon-cog-circled, icon-cogs, icon-wrench-4, icon-wrench-circled, icon-basket-4, icon-basket-circled, icon-calendar-7, icon-calendar-circled, icon-mic-5, icon-mic-circled, icon-volume-off-4, icon-volume-down-2, icon-volume-1, icon-volume-up-3, icon-headphones-3, icon-clock-6, icon-clock-circled, icon-lightbulb-2, icon-lightbulb-alt, icon-block-4, icon-resize-full-5, icon-resize-full-alt-2, icon-resize-small-4, icon-resize-vertical-2, icon-resize-horizontal-2, icon-move-3, icon-zoom-in-4, icon-zoom-out-4, icon-down-open-3, icon-left-open-4, icon-right-open-4, icon-up-open-3, icon-down-6, icon-left-5, icon-right-5, icon-up-6, icon-down-circled-2, icon-left-circled-2, icon-right-circled-2, icon-up-circled-2, icon-down-hand-1, icon-left-hand-1, icon-right-hand-1, icon-up-hand-1, icon-cw-5, icon-cw-circled, icon-arrows-cw-2, icon-shuffle-4, icon-play-5, icon-play-circled-1, icon-play-circled2-1, icon-stop-6, icon-stop-circled, icon-pause-5, icon-pause-circled, icon-record-2, icon-eject-3, icon-backward, icon-backward-circled, icon-fast-backward-2, icon-fast-forward-2, icon-forward-3, icon-forward-circled, icon-step-backward, icon-step-forward, icon-target-4, icon-signal-4, icon-desktop-2, icon-desktop-circled, icon-laptop-2, icon-laptop-circled, icon-network-1, icon-inbox-3, icon-inbox-circled, icon-inbox-alt, icon-globe-5, icon-globe-alt-1, icon-cloud-6, icon-cloud-circled, icon-flight-2, icon-leaf-3, icon-font-1, icon-fontsize-1, icon-bold-1, icon-italic-1, icon-text-height-1, icon-text-width-1, icon-align-left-1, icon-align-center-1, icon-align-right-1, icon-align-justify-1, icon-list-3, icon-indent-left-1, icon-indent-right-1, icon-briefcase-3, icon-off-1, icon-road-1, icon-qrcode-1, icon-barcode-1, icon-braille, icon-book-4, icon-adjust-1, icon-tint-1, icon-check-3, icon-check-empty-1, icon-asterisk-1, icon-gift-2, icon-fire-2, icon-magnet-2, icon-chart-2, icon-chart-circled, icon-credit-card-4, icon-megaphone-2, icon-clipboard-2, icon-hdd-2, icon-key-4, icon-certificate-2, icon-tasks-1, icon-filter-1, icon-gauge-2, icon-smiley, icon-smiley-circled, icon-address-book, icon-address-book-alt, icon-asl, icon-glasses, icon-hearing-impaired, icon-iphone-home, icon-person, icon-adult, icon-child, icon-blind, icon-guidedog, icon-accessibility, icon-universal-access, icon-male-2, icon-female-2, icon-behance-1, icon-blogger-2, icon-cc-2, icon-css, icon-delicious-1, icon-deviantart-1, icon-digg-1, icon-dribbble-5, icon-facebook-7, icon-flickr-4, icon-foursquare-2, icon-friendfeed-1, icon-friendfeed-rect-1, icon-github-6, icon-github-text-1, icon-googleplus, icon-instagram-4, icon-linkedin-6, icon-path, icon-picasa-2, icon-pinterest-3, icon-reddit-1, icon-skype-5, icon-slideshare, icon-stackoverflow-2, icon-stumbleupon-2, icon-twitter-7, icon-tumblr-4, icon-vimeo-4, icon-vkontakte-2, icon-w3c-1, icon-wordpress-2, icon-youtube-3, icon-music-4, icon-search-7, icon-mail-7, icon-heart-7, icon-star-7, icon-user-7, icon-videocam-5, icon-camera-7, icon-photo-1, icon-attach-6, icon-lock-7, icon-eye-7, icon-tag-6, icon-thumbs-up-5, icon-pencil-7, icon-comment-6, icon-location-7, icon-cup-1, icon-trash-8, icon-doc-7, icon-note-1, icon-cog-6, icon-params, icon-calendar-8, icon-sound-1, icon-clock-7, icon-lightbulb-3, icon-tv, icon-desktop-3, icon-mobile-6, icon-cd-3, icon-inbox-4, icon-globe-6, icon-cloud-7, icon-paper-plane-2, icon-fire-3, icon-graduation-cap-1, icon-megaphone-3, icon-database-2, icon-key-5, icon-beaker-1, icon-truck-1, icon-money-2, icon-food-1, icon-shop-1, icon-diamond, icon-t-shirt, icon-wallet, icon-search-8, icon-mail-8, icon-heart-8, icon-heart-empty-4, icon-star-8, icon-user-8, icon-video-5, icon-picture-5, icon-th-large-3, icon-th-4, icon-th-list-5, icon-ok-6, icon-ok-circle-1, icon-cancel-7, icon-cancel-circle-2, icon-plus-circle-1, icon-minus-circle-1, icon-link-5, icon-attach-7, icon-lock-8, icon-lock-open-7, icon-tag-7, icon-reply-4, icon-reply-all-2, icon-forward-4, icon-code-3, icon-retweet-4, icon-comment-7, icon-comment-alt-2, icon-chat-6, icon-attention-5, icon-location-8, icon-doc-8, icon-docs-landscape, icon-folder-6, icon-archive-2, icon-rss-7, icon-rss-alt-1, icon-cog-7, icon-logout-3, icon-clock-8, icon-block-5, icon-resize-full-6, icon-resize-full-circle, icon-popup-5, icon-left-open-5, icon-right-open-5, icon-down-circle-1, icon-left-circle-1, icon-right-circle-1, icon-up-circle-1, icon-down-dir-3, icon-right-dir-3, icon-down-micro, icon-up-micro, icon-cw-circle, icon-arrows-cw-3, icon-updown-circle, icon-target-5, icon-signal-5, icon-progress-4, icon-progress-5, icon-progress-6, icon-progress-7, icon-progress-8, icon-progress-9, icon-progress-10, icon-progress-11, icon-font-2, icon-list-4, icon-list-numbered-1, icon-indent-left-2, icon-indent-right-2, icon-cloud-8, icon-terminal-1, icon-facebook-rect-2, icon-twitter-bird-2, icon-vimeo-rect-1, icon-tumblr-rect-1, icon-googleplus-rect-1, icon-linkedin-rect-1, icon-skype-6, icon-vkontakte-rect-1, icon-youtube-4, icon-right-big';	
		$fontIcons       = explode( ', ', $fontIcons );
		$menuIcons = array();
		$menuIcons['none'] = __( '- select icon -', 'candidate' );
		foreach ( $fontIcons as $icon ) {
			$menuIcons[$icon] = ucwords( str_replace( '-', ' ', substr( $icon, 4 ) ) );
		}	

			return $fontIcons;
	}
} 



if ( ! function_exists( 'candidat_pagenavi' ) ) {
function candidat_pagenavi($before='', $after='', $echo=true) {
	/* ================  ================ */
	$dd = 0;
	$text_num_page = '';
	$num_pages = 3; 
	$stepLink = 3; 
	$dotright_text = ''; 
	$dotright_text2 = '…'; 
	$backtext = '<i class="icons icon-left-dir"></i>'; 
	$nexttext = '<i class="icons icon-right-dir"></i>'; 
	$first_page_text = 'first page  '; 
	$last_page_text = '  last page'; 
	/* ================  ================ */ 
	global $wp_query;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 

	$max_page = $wp_query->max_num_pages;
	if($max_page <= 1 ) return false; 
	if(empty($paged) || $paged == 0) $paged = 1;
	$pages_to_show = intval($num_pages);
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2); 
	$start_page = $paged - $half_page_start; 
	$end_page = $paged + $half_page_end;

	if($start_page <= 0) $start_page = 1;
	if(($end_page - $start_page) != $pages_to_show_minus_1) $end_page = $start_page + $pages_to_show_minus_1;
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = (int) $max_page;
	}

	if($start_page <= 0) $start_page = 1;
	$out='';
		$out.= $before;
				if ($text_num_page){
					$text_num_page = preg_replace ('!{current}|{last}!','%s',$text_num_page);
					$out.= sprintf ("<span class='pages'>$text_num_page</span>",$paged,$max_page);
				}
				if ($start_page >= 2 && $pages_to_show < $max_page) {
					if($start_page!=2) $out.= '<span class="extend">'.$dotright_text.'</span>';
				}

				if ($paged!=1) $out.= '<a  class="button" href="'. esc_url(get_pagenum_link(($paged-1))) .'">'.$backtext.'</a>';
				for($i = $start_page; $i <= $end_page; $i++) {
					if($i == $paged) {
						$out.= '<a class="active-button button">'.$i.'</a>';
					} else {
						$out.= '<a class="button"  href="'. esc_url(get_pagenum_link($i)) .'">'.$i.'</a>';
					}
				}

				if ($stepLink && $end_page < $max_page){
					for($i=$end_page+1; $i<=$max_page; $i++) {
						if($i % $stepLink == 0 && $i!==$num_pages) {
							if (++$dd == 1) $out.= '<span class="extend">'.$dotright_text2.'</span>';
							$out.= '<a class="button"  href="'. esc_url(get_pagenum_link($i)) .'">'.$i.'</a>';
						}
					}
				}

				if ( $paged!=$end_page) $out.= '<a class="button"  href="'. esc_url(get_pagenum_link(($paged+1))) .'">'.$nexttext.'</a>';

				if ($end_page < $max_page) {
					if($end_page!=($max_page-1)) $out.= '';
				}

		$out.= $after."\n";
	if ($echo) echo $out;
	else return $out;
}
}


class candidate_Nav_Walker extends Walker_Nav_Menu {

	function check_current($classes) {
		return preg_match('/(current[-_])|active|dropdown/', $classes);
	  }


	  function start_lvl(&$output, $depth = 0, $args = array()) {
		  if($depth == 0)
		  {
			$output .= "\n<ul class=\"DropMenu\">\n";
		  }else
		  {
			  $output .= "\n<ul>\n";
		  }
	  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    $item_html = '';
    parent::start_el($item_html, $item, $depth, $args);
	if ($item->title == 'Home' && ($depth === 0)) {
	$item->title = 'Home1';
	}
	
	
	$item_html = str_replace('current_page_item', ' current-menu-item', $item_html);
	$item_html = str_replace('current-menu-parent', ' current-menu-item', $item_html);
	$item_html = str_replace('current-menu-ancestor', ' current-menu-item', $item_html);

	
    $output .= $item_html;
  }

  function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
    $element->is_dropdown = !empty($children_elements[$element->ID]);

    if ($element->is_dropdown) {
      if ($depth === 0) {
        $element->classes[] = '';
      } elseif ($depth === 1) {
        $element->classes[] = '';
      }
    }
    parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
  }
}



if ( ! function_exists( 'candidat_theme_roots_nav_menu_args' ) ) {
function candidat_theme_roots_nav_menu_args($args = '') {
  $roots_nav_menu_args['container'] = false;
  if (!$args['items_wrap']) {
    $roots_nav_menu_args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
  }
  if (current_theme_supports('firmasite-top-navbar')) {
    $roots_nav_menu_args['depth'] = 0;
  }
  if (!$args['walker']) {
    $roots_nav_menu_args['walker'] = new candidate_Nav_Walker();
  }
  return array_merge($args, $roots_nav_menu_args);
}
}
add_filter('wp_nav_menu_args', 'candidat_theme_roots_nav_menu_args');



add_filter( 'wp_nav_menu_objects', 'candidate_page_nav_links' );

if ( ! function_exists( 'candidate_page_nav_links' ) ) {
function candidate_page_nav_links( $items ) {
	foreach ( $items as $item ) {
		
	if( ('custom' == $item->type && home_url( '/' ) == $item->url) || $item->classes[0] == 'home-link' ){
		$item->title = '<i class="icons icon-home"></i>';
		$item->classes[] = 'home-button';
		}	
	}
	return $items;   
}
}

if ( ! function_exists( 'firmasite_is_element_empty' ) ) {
function firmasite_is_element_empty($element) {
  $element = trim($element);
  return empty($element) ? false : true;
}
}
/**

 * END WALKER

 */





if ( !function_exists('candidat_get_featured_image') )
{
	function candidat_get_featured_image($post_id, $size, $class, $title)
	{
		if($class == NULL) { $class = 'wp-featured-image'; } else { $class = $class . ' wp-featured-image'; }
		if($post_id == NULL) { $post_id = get_post_thumbnail_id(); }
		$wp_featured_image = wp_get_attachment_image_src($post_id, $size, true);
		$src = $wp_featured_image[0];
		$output = '<img src="'. esc_url($src) .'" class="'. esc_attr($class) .'" alt="'. esc_attr($title) .'" title="'. esc_attr($title) .'" />';
		return $output;
	}
}

//Comment template
 if ( ! function_exists( 'candidate_comment_reply_link' ) ) {
	 function candidate_comment_reply_link( $link ) {  
		global $user_ID;  
	  
		if ( get_option( 'comment_registration' ) && ! $user_ID )  
			return str_replace( 'comment-reply-link', 'reply', $link );  
		else  
			return str_replace( 'comment-reply-link', 'reply', $link );  
	}
 }  
add_filter( 'comment_reply_link', 'candidate_comment_reply_link' );


if ( ! function_exists( 'candidate_comment' ) ) :
	function candidate_comment( $comment, $args, $depth )
	{
	$GLOBALS['comment'] = $comment;
	$com = get_comment_author_url();
	
	switch ( $comment->comment_type ) :
		case '' :
	?>
    <li>
	<div class="comment animate-onscroll">							
		<div class="comment-author">
			<?php echo get_avatar( $comment, 70 ); ?>
			<div class="author-meta">
				<?php if( $com != "" && $com != "http://Website") { ?>
					<a href="<?php echo esc_url($com); ?>"><h6><?php comment_author();?></h6></a>
					<?php } else { ?>
					<h6><?php comment_author();?></h6>
				<?php } ?> 
				<div class="comment-meta">
					<span><?php echo  get_comment_date(); ?></span>
					<span>
					<?php 
					comment_reply_link( array_merge( $args, array('reply_text' => __('Reply', 'candidate'), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); 
					?> 
					</span>
				</div>
			</div>
		</div>
		
		<div class="comment-content">
			<p><?php comment_text(); ?></p>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<p><?php _e( 'Your comment is awaiting moderation.', 'candidate' ); ?></p>
			<?php endif; ?>
		</div>
	
	</div>
    </li>  
   <?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'candidate' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'candidate'), ' ' ); ?></p>
	</li>  	
	<?php
			break;
	endswitch;
}
endif;



//portfolio category///////////////////////////////////////////////////////////////////////////
 if ( ! function_exists( 'candidat_theme_get_portfolio_category' ) ) {
	function candidat_theme_get_portfolio_category($id = null){
		$categories = get_the_terms( $id, 'portfolio-category' );
		$res = '';
		if(!empty($categories)){
			foreach ( $categories as $val ) {
				$res .= $val->slug;
				$res .= ' ';
			}
		}
		return  $res;
	}
 }
 
 if ( ! function_exists( 'candidat_theme_get_portfolio_category2' ) ) { 
	function candidat_theme_get_portfolio_category2($id = null){
		$categories = get_the_terms( $id, 'portfolio-category' );
		$res = '';
		if(!empty($categories)){
			foreach ( $categories as $val ) {
				$res .= $val->slug;
				$res .= ', ';
			}
		}
		return  $res;
	}
 }
 
  if ( ! function_exists( 'candidat_theme_the_related_portfolio' ) ) { 
	function candidat_theme_the_related_portfolio ($post_num = 4, $category_post, $esclude_post, $post_class='col-lg-4 col-md-4 col-sm-4'){ 
		$post_id = '';
		$post_class = $post_class;
		global $post;
		$tmp_post = $post;
		$args = array( 'orderby' => 'menu_order',
					   'post_type' => 'portfolio_post',
					   'portfolio-category' => $category_post,					   
					   'exclude' => $esclude_post,
					   'numberposts' => $post_num);
		$myposts = get_posts($args);

		foreach( $myposts as $post ) : setup_postdata($post);
		$urlThumb='';
		?>
		<div class="<?php echo esc_attr($post_class); ?>">
			
			<?php 
			$post_id = $post->ID;
			$format = 'image';
			if(get_meta_option('portfolio_post_type', $post->ID) && get_meta_option('portfolio_post_type', $post->ID) !=''){
			$format = get_meta_option('portfolio_post_type', $post->ID); 
			}
			$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); 
			$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'latest-post'); 
			$post_link = get_permalink(); 
			$title1 = get_the_title();
				if($title1 == '') {
				$title1 = 'No Title';
				}
				if($format == 'video') {
								if( get_meta_option('portfolio_video_type', $post->ID) == 'html5') {
								$jackbox_link = get_meta_option('portfolio_post_video', $post_id); 
								}
							
								if( get_meta_option('portfolio_video_type', $post->ID) == 'vimeo') {
								$jackbox_link = 'http://vimeo.com/'. get_meta_option('portfolio_post_video', $post_id); 
								}
							
								if( get_meta_option('portfolio_video_type', $post->ID) == 'youtube') {
								$jackbox_link = 'http://www.youtube.com/watch?v='. get_meta_option('portfolio_post_video', $post_id); 
								}
				} else {
				$jackbox_link = $large_image_url[0];
				}	
				?>	
						
			
							<!-- Media Item -->
							<div <?php post_class('media-item gallery-media animate-onscroll '); ?>>
								<?php 
									if($format != 'gallery'){
								?>
								<div class="media-image">
								
									<?php if( has_post_thumbnail() ) { 
									the_post_thumbnail('latest-post'); 
									} else { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/img/media/media1-medium.jpg" alt="">
									<?php } ?>
									
									<div class="media-hover">
										<div class="media-icons">
											<a href="<?php if(isset($jackbox_link)) echo esc_url($jackbox_link); ?>" data-group="media-jackbox" data-thumbnail="<?php if(isset($thumb_image_url[0])) echo esc_url($thumb_image_url[0]); ?>" class="jackbox media-icon"><i class="icons <?php if($format == 'image') echo 'icon-zoom-in'; else if($format == 'video') echo 'icon-play'; ?>"></i></a>
											<a href="<?php echo esc_url($post_link); ?>" class="media-icon"><i class="icons icon-link"></i></a>
										</div>
									</div>
								
								</div>
									<?php 
										} else {
									
								
										$type = 'latest-post';
										$slider_image_gallery = get_meta_option('portfolio_post_gallery', $post->ID);
										$attachments = array_filter( explode( ',', $slider_image_gallery ) );
										?>
										<!-- Portfolio Slideshow -->
										<div class="portfolio-slideshow media-image flexslider">
											
											<ul class="slides">
											
												<?php 
												foreach ($attachments as $attachment) 
												{
												$attachment_id = get_post( $attachment );
												$caption = trim(strip_tags($attachment_id->post_excerpt));
												$alt = trim(strip_tags(get_post_meta($attachment, '_wp_attachment_image_alt', true)));
												echo '<li>';
												echo candidat_get_featured_image($attachment, $type, 'portfolio-image', $alt);
												echo '</li>'."\n";
												}
												?>
												
											</ul>
											
										</div>
									<?php 
										} 
									?>
									
									<h4 class="related-title"><a href="<?php echo esc_url($post_link); ?>"><?php echo esc_html($title1); ?></a></h4>
							</div>
							<!-- /Media Item -->	
	
		</div>
        <?php 
		
		endforeach;
		$post = $tmp_post; 
}  
  }

///post category///////////////////////////////////////////////////////////////////////////
  if ( ! function_exists( 'candidat_theme_get_post_category' ) ) { 
	function candidat_theme_get_post_category($id = null){
		$categories = get_the_terms( $id, 'category' );
		$res = '';
		if(!empty($categories)){
			foreach ( $categories as $val ) {
				$res .= $val->slug;
				$res .= ', ';
			}
		}
		return  $res;
	}
  }
  
  
 if ( ! function_exists( 'candidat_theme_the_related_post' ) ) {   
	function candidat_theme_the_related_post ($post_num = 4, $category_post, $esclude_post, $post_class='col-lg-4 col-md-4 col-sm-4'){ 
		$post_id = '';
		$post_class = $post_class;
		global $post;
		$tmp_post = $post;
		$args = array( 'orderby' => 'post_date',
					   'category_name' => $category_post,					   
					   'exclude' => $esclude_post,
					   'numberposts' => $post_num);
		$myposts = get_posts($args);

		foreach( $myposts as $post ) : setup_postdata($post);
		
			$format = 'standard';
			if(get_post_meta($post->ID,'meta_blogposttype',true) && get_post_meta($post->ID,'meta_blogposttype',true) !=''){
			$format = get_post_meta($post->ID,'meta_blogposttype',true); 
			}
			
		?>
		<div class="<?php echo esc_attr($post_class); ?>">
			
			<!-- Blog Post -->
			<div class="blog-post animate-onscroll">
				
				
				<div class="post-image">
				
				<?php if(has_post_thumbnail() || 
									$format == 'video' ){ ?>
										
										
						<?php if(has_post_thumbnail() && $format != 'video') { ?>
							<a href="<?php echo esc_url(get_permalink()); ?>">
							<?php the_post_thumbnail('latest-post'); ?>
							</a>
						<?php } ?>				
										
						
						<?php if($format == 'video') {
								 if( get_post_meta($post->ID,'meta_blogvideoservice',true) == 'html5' && ! post_password_required() ) { ?>

								<video width="100%" height="177"  id="home_video" class="entry-video video-js vjs-default-skin" poster="<?php $url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "latest-post" ); echo esc_url($url[0]); ?>" data-aspect-ratio='2.41' data-setup="{}" controls>
									<source src="<?php echo esc_url(get_post_meta($post->ID,'meta_blogvideourl',true)); ?>" type="video/mp4"/>
									<source src="<?php echo esc_url(get_post_meta($post->ID,'meta_blogvideourl',true)); ?>" type="video/webm"/>
									<source src="<?php echo esc_url(get_post_meta($post->ID,'meta_blogvideourl',true)); ?>" type="video/ogg"/>
								</video>

								<?php } ?>


								<?php if( get_post_meta($post->ID,'meta_blogvideoservice',true) == 'vimeo' && ! post_password_required() ) { ?>
									<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta($post->ID,'meta_blogvideourl',true); ?>?js_api=1&amp;js_onLoad=player<?php echo get_post_meta($post->ID,'meta_blogvideourl',true); ?>_1798970533.player.moogaloopLoaded" width="100%" height="177"  allowFullScreen></iframe>
								<?php } ?>


								<?php if( get_post_meta($post->ID,'meta_blogvideoservice',true) == 'youtube' && ! post_password_required() ) { ?>
									<iframe width="100%" height="177" src="http://www.youtube.com/embed/<?php echo get_post_meta($post->ID,'meta_blogvideourl',true); ?>" allowfullscreen></iframe>
								<?php } ?>
						<?php } ?>
				<?php 
				} else { ?>
				<a href="<?php echo esc_url(get_permalink()); ?>">
				<img src="<?php echo get_template_directory_uri() ?>/img/media/media1-medium.jpg" alt="">
				</a>
				<?php } ?>
				</div>
				
				
				
				<h4 class="post-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></h4>
				
				
				<?php if(get_option('sense_show_author_single_related') != '_hide') { ?>
				<div class="post-meta">
					<span><?php _e( 'by', 'candidate' ); ?> <?php the_author_posts_link(); ?></span>
					<span><?php  the_time('M d Y'); ?></span>
				</div>
				<?php } ?>
				
				
				
			</div>
			<!-- /Blog Post -->
			
		</div>
        <?php 
		
		endforeach;
		$post = $tmp_post; 
	}  
 }


if ( !function_exists('get_meta_option') )
{
	function get_meta_option($var, $post_id='') 
	{
		$prefix = 'mm_';
		global $post;
		$id = '';
		
		if($post_id !='') {
		$id = $post_id;
		}else{
		$id = $post->ID;
		}
		if($id) {
		return get_post_meta($id, $prefix.$var, true);
		} else {
		return '';
		}
		
	}
}

/////// Add custom field 'Blogpost type' to post type  ////////

  add_action('add_meta_boxes','candidat_theme_init_metabox_blogposttype');
  if ( ! function_exists( 'candidat_theme_init_metabox_blogposttype' ) ) {  
	  function candidat_theme_init_metabox_blogposttype(){
		  add_meta_box('meta_blogposttype', 'Post Type', 'candidat_theme_meta_blogposttype_cb', 'post', 'normal');
	  }
    }
	  
	  
if ( ! function_exists( 'candidat_theme_meta_blogposttype_cb' ) ) {    
  function candidat_theme_meta_blogposttype_cb($post){
      $dispo = get_post_meta($post->ID,'meta_blogposttype',true);
      echo '<label for="meta_blogposttype">Media :</label>';
      echo '<select id="meta_blogposttype" name="meta_blogposttype">';
		echo '<option value="standard" '.selected($dispo, 'standard').'>Image Featured Post</option>';
		echo '<option value="slideshow" '.selected($dispo, 'slideshow').'>Image Gallery Post</option>';
        echo '<option value="video" '.selected($dispo, 'video').'>Video Post</option>';
        echo '<option value="audio" '.selected($dispo, 'audio').'>Audio Post</option>';
        echo '<option value="blockquote" '.selected($dispo, 'blockquote').'>Blockquote Post</option>';
        echo '<option value="link" '.selected($dispo, 'link').'>Link Post</option>';
      echo '</select>';
  }
}

  add_action('save_post','candidat_theme_save_metabox_blogposttype');

  if ( ! function_exists( 'candidat_theme_save_metabox_blogposttype' ) ) {
	  function candidat_theme_save_metabox_blogposttype($post_id){
		  if(isset($_POST['meta_blogposttype']))
			  update_post_meta($post_id, 'meta_blogposttype', esc_html($_POST['meta_blogposttype']));
	  }
  }
 

//// Add custom field 'video type' to blog post type  /////////////////////////////////////////////////////
  add_action('add_meta_boxes','candidat_theme_init_metabox_blogvideoservice');
if ( ! function_exists( 'candidat_theme_init_metabox_blogvideoservice' ) ) {
  function candidat_theme_init_metabox_blogvideoservice(){
      add_meta_box('meta_blogvideoservice', 'Video Service', 'candidat_theme_meta_blogvideoservice_cb', 'post', 'normal');
  }
 }
 
 
if ( ! function_exists( 'candidat_theme_meta_blogvideoservice_cb' ) ) { 
  function candidat_theme_meta_blogvideoservice_cb($post){
      $dispo1 = get_post_meta($post->ID,'meta_blogvideoservice',true);
      $dispo2 = get_post_meta($post->ID,'meta_blogvideourl',true);
      echo '<label for="meta_blogvideoservice">Service :</label>';
      echo '<select id="meta_blogvideoservice" name="meta_blogvideoservice">';
      echo '<option value="vimeo" '.selected($dispo1, 'vimeo').'>Vimeo</option>';
      echo '<option value="youtube" '.selected($dispo1, 'youtube').'>YouTube</option>';
	  echo '<option value="html5" '.selected($dispo1, 'html5').'>HTML5</option>';
      echo '</select>';
      echo '<br /><label for="meta_blogvideourl">Video ID :</label>';
      echo '<input id="meta_blogvideourl" name="meta_blogvideourl" value="'.$dispo2.'">';
  }
} 
  
  add_action('save_post','candidat_theme_save_metabox_blogvideoservice');
  
  
  if ( ! function_exists( 'get_page_number' ) ) {
	function get_page_number() {
		if ( get_query_var('paged') ) {
			print ' | ' . __( 'Page ' , 'candidate') . get_query_var('paged');
		}
	} 
	}

	
if ( ! function_exists( 'candidat_theme_save_metabox_blogvideoservice' ) ) { 	
	function candidat_theme_save_metabox_blogvideoservice($post_id){
      if(isset($_POST['meta_blogvideoservice']))
          update_post_meta($post_id, 'meta_blogvideoservice', esc_html($_POST['meta_blogvideoservice']));
      if(isset($_POST['meta_blogvideourl']))
          update_post_meta($post_id, 'meta_blogvideourl', esc_html($_POST['meta_blogvideourl']));
    }
}

///Excerpt functions////////////////////////////////////////////////////////////////
if ( ! function_exists( 'candidate_excerpt_length' ) ) { 
	function candidate_excerpt_length( $length ) {
		return 100; 
	}
}
add_filter( 'excerpt_length', 'candidate_excerpt_length', 999 );


if ( ! function_exists( 'candidate_excerpt_more' ) ) { 
	 function candidate_excerpt_more( $more ) {
		 return '...';
	 }
}
 add_filter('excerpt_more', 'candidate_excerpt_more');


if ( ! function_exists( 'candidate_tag_cloud_widget' ) ) { 
	function candidate_tag_cloud_widget($args) {
		$args['number'] = 10; //adding a 0 will display all tags
		$args['largest'] = 13; //largest tag
		$args['smallest'] = 13; //smallest tag
		$args['unit'] = 'px'; //tag font unit
		$args['format'] = 'flat'; //ul with a class of wp-tag-cloud
		$args['separator'] = ''; 
		return $args;
	}
}
add_filter( 'widget_tag_cloud_args', 'candidate_tag_cloud_widget' );


if ( ! function_exists( 'candidate_tag_cloud_widget1' ) ) { 
	function candidate_tag_cloud_widget1($args) {
		$args['number'] = 10; //adding a 0 will display all tags
		$args['largest'] = 13; //largest tag
		$args['smallest'] = 13; //smallest tag
		$args['unit'] = 'px'; //tag font unit
		$args['format'] = 'flat'; //ul with a class of wp-tag-cloud
		$args['separator'] = ''; 
		return $args;
	}
}
add_filter( 'woocommerce_product_tag_cloud_widget_args', 'candidate_tag_cloud_widget1' );



if ( ! function_exists( 'candidat_the_excerpt_max_charlength' ) ) { 
	function candidat_the_excerpt_max_charlength($limit=20){
		$text = get_the_excerpt();
		$explode = explode(' ',$text); 
		$string  = ''; 
		$dots = '...'; 
		if(count($explode) <= $limit){ 
			$dots = ''; 
			$string .= $text;
		} else {
			for($i=0;$i<$limit;$i++){ 
				$string .= $explode[$i]." "; 
			} 
		}		
		echo $string.$dots; 
	} 
}


if ( ! function_exists( 'candidat_get_the_excerpt_max_charlength' ) ) { 
	function candidat_get_the_excerpt_max_charlength($limit=20){
		$text = get_the_excerpt();
		$explode = explode(' ',$text); 
		$string  = ''; 
		$dots = '...'; 
		if(count($explode) <= $limit){ 
			$dots = ''; 
			$string .= $text;
		} else {
			for($i=0;$i<$limit;$i++){ 
				$string .= $explode[$i]." "; 
			} 
		}		
		return $string.$dots; 
	}
}


if ( ! function_exists( 'candidat_the_excerpt_max_charlength_text' ) ) { 
	function candidat_the_excerpt_max_charlength_text($text1='', $limit=5){
		$text = $text1;
		$string  = ''; 
		$dots = ''; 
		if($text != '') {
				$explode = explode(' ',$text); 	
				$dots = '...'; 
				if(count($explode) <= $limit){ 
					$dots = ''; 
					$string  .= $text;
				} else{
						for($i=0;$i<$limit;$i++){ 
							$string .= $explode[$i]." "; 
						} 
				  } 
		}	  
		return $string.$dots; 
	}  
}



add_action('wp_ajax_add_to_mailchimp_list', 'candidate_add_to_mailchimp_list');
add_action('wp_ajax_nopriv_add_to_mailchimp_list', 'candidate_add_to_mailchimp_list');

if ( ! function_exists( 'candidate_add_to_mailchimp_list' ) ) { 

	function candidate_add_to_mailchimp_list() {

		check_ajax_referer('MailChimp', 'ajax_nonce');
		$_POST = array_map('stripslashes_deep', $_POST);

		$email = sanitize_email($_POST['email']);
		$data_mailchimp_api = get_option('sense_mailchimp_api'); 
		$data_mailchimp_id = get_option('sense_mailchimp_id'); 
		$data_mailchimp_center = get_option('sense_mailchimp_center');
		
		if (is_email($email)) {
			$submit_url = 'http://'.$data_mailchimp_center.'.api.mailchimp.com/1.3/?method=listSubscribe';
			
			$data = array(
				'email_address'	=> $email,
				'apikey'	=> $data_mailchimp_api,
				'id'		=> $data_mailchimp_id,
				'double_optin'	=> true,
				'send_welcome'	=> false,
				'email_type'	=> 'html'
			);
			
			$payload = json_encode($data);
			
			$ch = wp_remote_post($submit_url, array(
			'method' => 'POST',
			'timeout' => 45,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => array(),
			'body' => urlencode($payload),
			'cookies' => array()));
			$result = wp_remote_retrieve_body( $ch );
			
			$data = json_decode($result);

			if ($data === true) {
				echo 'added';
			} else if (is_object($data) && $data->error) {
				echo ($data->code === 214) ? 'already subscribed' : 'error';	    
			} else if (is_null($data)) {
				echo 'error';
			}
		} else {
			echo 'invalid email';		
		}
		die();
	}
}

//Add widgets support
if ( ! function_exists( 'candidat_widgets_init' ) ) { 
function candidat_widgets_init() {


	global $mm_option;
	$custom_sidebar_args = array( 
		'post_type' => 'sidebar',
		'posts_per_page' => -1,
		'order' => 'ASC',
		'post_status' => 'publish'
	);
	$custom_sidebars = get_posts( $custom_sidebar_args );
	if($custom_sidebars)
	{
		foreach ($custom_sidebars as $custom_sidebar) 
		{
			global $post;
			$id = $custom_sidebar->ID;
			$name = get_the_title($id);
			register_sidebar( array (
				'name' => $name,
				'id' => 'custom-widget-area-'.$id,
				'before_widget' => '<div class="sidebar-box white widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="custom_sidebar_title">',
				'after_title' => '</h3>'
			));
		}
	}

	/**
	 * Register widget area.
	 */
	register_sidebar( 
		array(
			'id'          =>   'shop',
			'name'        => __( 'shop' , 'candidate' ),
			'before_widget' => '<div id="%1$s" class="sidebar-box white widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="custom_sidebar_title">',
			'after_title'   => '</h3>',
			'description' => __( 'This sidebar is located the page shop.' , 'candidate' ),
		)
	 );

	 register_sidebar( 
		array(
			'id'          =>   'blog_default',
			'name'        => __( 'Blog default' , 'candidate' ),
			'before_widget' => '<div id="%1$s" class="sidebar-box white widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="custom_sidebar_title">',
			'after_title'   => '</h3>',
			'description' => __( 'This sidebar is located the default blog.' , 'candidate' ),
		)
	 );
	
		
	 
	 
	/*-------------------------------------------------------------------------------------------
		Footer sidebars
	--------------------------------------------------------------------------------------*/

	if ( get_option('sense_fsidebar1_columns') &&  get_option('sense_fsidebar1_columns') != '' ) {	
		$f_row1 = (int)get_option('sense_fsidebar1_columns');
		if ( function_exists('register_sidebars') ) {	
			if ( $f_row1 > 1 ) {
				$args = array(
					'name'          => 'Footer row 1 - widget %d',
					'id'            => "shfooter",
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title' => '<h4 class="footer_widget_title">',
					'after_title' => '</h4>' ); 

				register_sidebars($f_row1 ,$args);
			}
			else{
				$args = array(
					'name'          => 'Footer row 1 - widget 1',
					'id'            => "shfooter",
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title' => '<h4 class="footer_widget_title">',
					'after_title' => '</h4>' ); 
				register_sidebars( 1,$args );
			}
		}
	}
	
}
}
add_action( 'widgets_init', 'candidat_widgets_init' );
	
	
	
add_action( 'wp_print_scripts', 'de_script', 100 );
if ( ! function_exists( 'de_script' ) ) {
	function de_script() {
			wp_dequeue_script ('vc_pageable_owl-carousel');
			wp_deregister_script( 'vc_pageable_owl-carousel' );
	}	
}		
 /*--------------------------------------------------------------------------
	Shop
---------------------------------------------------------------------------*/ 

add_filter( 'woocommerce_enqueue_styles', 'candidat_dequeue_styles' );
if ( ! function_exists( 'candidat_dequeue_styles' ) ) { 
	function candidat_dequeue_styles( $enqueue_styles ) {
		unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
		unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
		unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
		unset( $enqueue_styles['woocommerce_chosen_styles'] );	
		
		
		//unset( $enqueue_styles['bp-legacy-css'] );	
		//unset( $enqueue_styles['bbp-default'] );	
		
		wp_dequeue_style( 'woocommerce_chosen_styles' );
		wp_dequeue_style ('woocommerce_fancybox_styles');
		wp_dequeue_style ('woocommerce_prettyPhoto_css');
		

		//wp_dequeue_style ('bbp-default');
		
		
		
		return $enqueue_styles;
	}
}

add_filter( 'woocommerce_enqueue_styles', '__return_false' );

if( !function_exists( 'candidat_is_shop_installed' ) ) {
    function candidat_is_shop_installed() {
        global $woocommerce;
        if( isset( $woocommerce ) || defined( 'JIGOSHOP_VERSION' ) ) {
            return true;
        } else {
            return false;
        }
    }
}


add_filter( 'woocommerce_short_description', 'candidat_product_short_description', 11 );

if ( ! function_exists( 'candidat_product_short_description' ) ) { 
	function candidat_product_short_description( $excerpt ) {
		global $post;
		$limit = 30;
		$text = $excerpt;
		$explode = explode(' ',$text); 
		$string  = ''; 
		$dots = '...'; 
		if(count($explode) <= $limit){ 
			$dots = ''; 
			$string .= $text;
		} else {
			for($i=0;$i<$limit;$i++){ 
				$string .= $explode[$i]." "; 
			} 
		}	
		return $string.$dots; 	
	}
}

$def_num_product = 4;
if( get_option('sense_num_product') && get_option('sense_num_product') != '' ) {
$def_num_product = get_option('sense_num_product');
}

add_filter('loop_shop_per_page', create_function('$cols', 'return '.$def_num_product.';'));
 
 
add_filter( 'woocommerce_subcategory_count_html', 'candidat_woo_remove_category_products_count' );

if ( ! function_exists( 'candidat_woo_remove_category_products_count' ) ) { 
	function candidat_woo_remove_category_products_count() {
		return;
	}
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

if ( ! function_exists( 'candidat_woocommerce_breadcrumbs' ) ) { 
	function candidat_woocommerce_breadcrumbs() {
		return array(
				'delimiter'   => ' / ',
				'wrap_before' => '<p class="breadcrumb">',
				'wrap_after'  => '</p>',
				'before'      => '',
				'after'       => '',
				'home'        => _x( 'Home', 'breadcrumb', 'candidate' ),
			);
	}
}
add_filter( 'woocommerce_breadcrumb_defaults', 'candidat_woocommerce_breadcrumbs' );

add_action('woocommerce_before_main_content', 'candidat_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'candidat_theme_wrapper_end', 10);


if ( ! function_exists( 'candidat_theme_wrapper_start' ) ) { 
  function candidat_theme_wrapper_start() {
    echo '';
  }
}

if ( ! function_exists( 'candidat_theme_wrapper_end' ) ) { 
  function candidat_theme_wrapper_end() {
    echo '';
  }
}


if ( ! function_exists( 'candidat_the_breadcrumbs' ) ) {    
function candidat_the_breadcrumbs() {
 
        global $post;
		
		echo '<p class="breadcrumb">';
		
        if (!is_home()) {
 
            echo "<a href='";
            echo esc_url(home_url('/'));
            echo "'>";
            echo __( 'Home', 'candidate' );
            echo "</a>";
 
            if (is_category() || is_single()) {
 
                echo ' / ';
				
				if ( get_post_type() == 'post' ) {
					$cats = get_the_category( $post->ID );
					
	 
					foreach ( $cats as $cat ){
						$category_link = get_category_link( $cat->term_id );
					
						echo '<a href="'. esc_url($category_link) .'">'. esc_attr($cat->cat_name) .'</a>';
						
						echo ' / ';
					}
				}
				
                if (is_single()) {
                   echo esc_attr(get_the_title());
                }
            } elseif (is_page()) {
 
                if($post->post_parent){
                    $anc = get_post_ancestors( $post->ID );
                    $anc_link = get_page_link( $post->post_parent );
 
                    foreach ( $anc as $ancestor ) {
                        $output = ' / <a href="'. esc_url($anc_link) .'">'. esc_attr(get_the_title($ancestor)) .'</a> / ';
                    }
 
                    echo $output;
                    echo esc_attr(get_the_title());
 
                } else {
                    echo ' / ';
                    echo esc_attr(get_the_title());
                }
            }
        }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo __( 'Archive: ', 'candidate' ); the_time('F jS, Y'); }
    elseif (is_month()) {echo __( 'Archive: ', 'candidate' ); the_time('F, Y'); }
    elseif (is_year()) {echo __( 'Archive:', 'candidate' ); the_time('Y'); }
    elseif (is_author()) {echo __( 'Author archive: ', 'candidate' ); }
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo __( 'Blogarchive: ', 'candidate' ); echo'';}
    elseif (is_search()) {echo __( 'Search results: ', 'candidate' ); }
	
	echo '</p>';
}
}




add_action( 'wp_enqueue_scripts', 'candidat_remove_gridlist_styles', 30 );

if ( ! function_exists( 'candidat_remove_gridlist_styles' ) ) { 
	function candidat_remove_gridlist_styles() {
		wp_dequeue_style( 'grid-list-button' );
		//wp_deregister_script( 'universefunder_chosen_enqueue' );
		wp_dequeue_style( 'universefunder_chosen_style_enqueue' );	
	}
}

add_action('init', 'candidat_woocommerce_clear_cart_url');

if ( ! function_exists( 'candidat_woocommerce_clear_cart_url' ) ) { 
	function candidat_woocommerce_clear_cart_url() {
		global $woocommerce;
		if( isset($_REQUEST['clear-cart']) ) {
			$woocommerce->cart->empty_cart();
		}
	}
}


add_filter( 'woocommerce_product_tabs', 'candidat_woo_remove_product_tabs', 98 );
if ( ! function_exists( 'candidat_woo_remove_product_tabs' ) ) { 
	function candidat_woo_remove_product_tabs( $tabs ) {
		unset( $tabs['additional_information'] );  	// Remove the additional information tab
		return $tabs;
	}  
}

add_filter('next_post_link', 'candidat_post_link_attributes1');
add_filter('previous_post_link', 'candidat_post_link_attributes2');
 
 if ( ! function_exists( 'candidat_post_link_attributes1' ) ) { 
	function candidat_post_link_attributes1($output) {
		$code = 'class=" button big next "';
		return str_replace('<a href=', '<a '.$code.' href=', $output);
	}
 }
 
 if ( ! function_exists( 'candidat_post_link_attributes2' ) ) { 
	function candidat_post_link_attributes2($output) {
		$code = 'class=" button big previous "';
		return str_replace('<a href=', '<a '.$code.' href=', $output);
	}
 }		
	
	
	
		
////////////tribe_events//////////////////////////////////////////////////////////////////////	
 if ( ! function_exists( 'candidat_tribe_events_the_previous_month_link1' ) ) { 
	function candidat_tribe_events_the_previous_month_link1() {
		$html = '';
		$url = tribe_get_previous_month_link();
		$date = Tribe__Events__Main ::instance()->previousMonth( tribe_get_month_view_date() );

		if ( $date >= tribe_events_earliest_date( Tribe__Date_Utils::DBYEARMONTHTIMEFORMAT ) ) {
			$text = tribe_get_previous_month_text();
			$html = '<a class="button big button-arrow-before" data-month="' . $date . '" href="' . esc_url($url) . '" rel="prev">' . esc_html($text) . ' </a>';
		}

		echo apply_filters('tribe_events_the_previous_month_link', $html);
	}		
 }



 if ( ! function_exists( 'candidat_tribe_events_the_next_month_link1' ) ) { 
	function candidat_tribe_events_the_next_month_link1() {
		$html = '';
		$url = tribe_get_next_month_link();
		$text = tribe_get_next_month_text();

		if ( ! empty( $url ) ) {
			$date = Tribe__Events__Main ::instance()->nextMonth( tribe_get_month_view_date() );
			if ( $date <= tribe_events_latest_date( Tribe__Date_Utils::DBYEARMONTHTIMEFORMAT ) )
				$html = '<a class="button big button-arrow" data-month="' . $date . '" href="' . esc_url($url) . '" rel="next">' . esc_html($text) . '</a>';
		}

		echo apply_filters('tribe_events_the_next_month_link', $html);
	}	
 }		
	

	
 if ( ! function_exists( 'candidat_tribe_the_day_link1' ) ) { 	
	function candidat_tribe_the_day_link1( $date = null, $text = null ) {
		$html = '';

		try {
			if ( is_null( $text ) ) {
				$text = tribe_get_the_day_link_label( $date );
			}

			$css1 = 'button big button-arrow';

			if($date == 'previous day') {
			$css1 = 'button big button-arrow-before';
			}
			
			$date = tribe_get_the_day_link_date( $date );
			$link = tribe_get_day_link( $date );

			$earliest = tribe_events_earliest_date( Tribe__Date_Utils::DBDATEFORMAT );
			$latest   = tribe_events_latest_date( Tribe__Date_Utils::DBDATEFORMAT );
			
			
			if ( $date >= $earliest && $date <= $latest ) {
				$html = '<a class="'. esc_attr($css1) .'"   href="' . esc_url($link) . '" data-day="' . $date . '" rel="prev">' . esc_html($text) . '</a>';
			}

		} catch ( OverflowException $e ) {
		}

		echo apply_filters( 'tribe_the_day_link', $html );
	}	
 }	

 
 
 if ( ! function_exists( 'candidat_tribe_get_event_categories1' ) ) {  
	function candidat_tribe_get_event_categories1( $post_id = null, $args = array() ) {
		$post_id = is_null( $post_id ) ? get_the_ID() : $post_id;
		$defaults = array(
			'echo' => false,
			'label' => null,
			'label_before' => '<div>',
			'label_after' => '</div>',
			'wrap_before' => '<ul class="tribe-event-categories">',
			'wrap_after' => '</ul>' );
		$args = wp_parse_args( $args, $defaults );
		$categories = tribe_get_event_taxonomy( $post_id, $args );

		// check for the occurances of links in the returned string
		$label = is_null( $args['label'] ) ? _n( 'Event Category', 'Event Categories', substr_count( $categories, "<a href" ), 'tribe-events-calendar' ) : $args['label'];

		$html = !empty( $categories ) ? sprintf( '%s%s%s %s%s%s',
			$args['label_before'],
			$label,
			$args['label_after'],
			$args['wrap_before'],
			$categories,
			$args['wrap_after']
		) : '';
		if ( $args['echo'] ) {
			echo apply_filters( 'tribe_get_event_categories', $html, $post_id, $args, $categories );
		} else {
			return apply_filters( 'tribe_get_event_categories', $html, $post_id, $args, $categories );
		}
	}
 }

 
 if ( ! function_exists( 'candidat_tribe_meta_event_tags1' ) ) {  
	function candidat_tribe_meta_event_tags1( $label=null, $separator=', ', $echo = true ) {
		if ( !$label ) { $label = __( 'Tags', 'tribe-events-calendar' ); }

		$tribe_ecp = Tribe__Events__Main ::instance();
		$list = get_the_term_list( get_the_ID(), 'post_tag', '<p class="title">'.$label.'</p><dd class="tribe-event-tags">', $separator, '</dd>' );
		$list = apply_filters( 'tribe_meta_event_tags', $list, $label, $separator, $echo );
		if ( $echo ) {
			echo $list;
		} else {
			return $list;
		}
	}
 }
 
 
 if ( ! function_exists( 'candidat_tribe_meta_event_tags2' ) ) {  
	function candidat_tribe_meta_event_tags2( $label=null, $separator=', ', $echo = true ) {
		if ( !$label ) { $label = __( 'Tags', 'candidate' ); }

		$tribe_ecp = Tribe__Events__Main ::instance();
		$list = get_the_term_list( get_the_ID(), 'post_tag', '<td>'.$label.'</td><td>', $separator, '</td>' );
		$list = apply_filters( 'tribe_meta_event_tags', $list, $label, $separator, $echo );
		if ( $echo ) {
			echo $list;
		} else {
			return $list;
		}
	}
 }

  if ( ! function_exists( 'candidat_get_events_category' ) ) {
	function candidat_get_events_category($id = null){
		$categories = get_the_terms( $id, 'tribe_events_cat' );
		$res = '';
		if(!empty($categories)){
			foreach ( $categories as $val ) {
				$res .= $val->slug;
				$res .= ', ';
			}
		}
		return  $res;
	}
  }

  
  
   if ( ! function_exists( 'candidat_the_related_events' ) ) { 
	function candidat_the_related_events ($post_num = 3, $category_post, $esclude_post, $post_class='col-lg-4 col-md-4 col-sm-4 animate-onscroll'){ 
		$post_id = '';
		$post_class = $post_class;
		global $post;
		$tmp_post = $post;
		//'tribe_events_cat' => $category_post,

		$args = array( 'post_type' => 'tribe_events',				   
					   'exclude' => $esclude_post,
					   'meta_key' => '_EventStartDate',
					   'orderby' => '_EventStartDate',
					   'order'    => 'DESC',
					   'numberposts' => $post_num);
		$myposts = get_posts($args);

		
		
		foreach( $myposts as $post ) : setup_postdata($post);
		$urlThumb='';
		?>
		<div class="<?php echo esc_attr($post_class); ?>">
			
			<?php 
			$event_id = $post->ID;
			$type_event = get_meta_option('events_type_meta_box');
			$time_format = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT );
			$time_range_separator = tribe_get_option('timeRangeSeparator', ' - ');

			$start_datetime = tribe_get_start_date();
			$start_date = tribe_get_start_date( null, false );
			$start_time = tribe_get_start_date( null, false, $time_format );
			$start_ts = tribe_get_start_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

			$end_datetime = tribe_get_end_date();
			$end_date = tribe_get_end_date( null, false );
			$end_time = tribe_get_end_date( null, false,  $time_format );
			$end_ts = tribe_get_end_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );
			$address = tribe_address_exists() ? '' . tribe_get_full_address() . '' : '';
			
			$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'portfolio3'); 
			$post_link = get_permalink();


			$start_day = tribe_get_start_date( null, false, 'd' );
		    $start_month = tribe_get_start_date( null, false, 'M' );

			
			$title1 = get_the_title();
				if($title1 == '') {
				$title1 = 'No Title';
				}
				
				?>	
						
			
							<!-- Media Item -->
							<div <?php post_class('event-item'); ?>>
							
							<a href="<?php echo esc_url($post_link); ?>">
								<div class="event-image">
									<?php if( has_post_thumbnail() ) { ?>
									<img src="<?php echo esc_url($thumb_image_url[0]); ?>" alt="">
									<?php } else { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/img/media/media1-medium.jpg" alt="">
									<?php } ?>
								</div>
							</a>

							
								<div class="event-info">
							
									<div class="date">
										<span>
											<span class="day"><?php echo $start_day; ?></span>
											<span class="month"><?php echo $start_month; ?></span>
										</span>
									</div>
									
									<div class="event-content">
										<h6><a href="<?php echo esc_url($post_link); ?>"><?php echo esc_html($title1); ?> </a></h6>
										<ul class="event-meta">
											<li><i class="icons icon-clock"></i> <?php esc_html_e( $start_time . $time_range_separator . $end_time, 'tribe-events-calendar' ); ?></li>
											<li><i class="icons icon-location"></i> <?php if ( ! empty( $address ) ) echo '' . "$address "; ?></li>
										</ul>
									</div>
								
								</div>
					
							</div>
							<!-- /Media Item -->	
	
		</div>
        <?php 
		
		endforeach;
		$post = $tmp_post; 
}  
   }
   
   
/** Forms ****************************************************************/

if ( ! function_exists( 'candidat_woocommerce_form_field1' ) ) {

	function candidat_woocommerce_form_field1( $key, $args, $value = null ) {
		$defaults = array(
			'type'              => 'text',
			'label'             => '',
			'placeholder'       => '',
			'maxlength'         => false,
			'required'          => false,
			'class'             => array(),
			'label_class'       => array(),
			'input_class'       => array(),
			'return'            => false,
			'options'           => array(),
			'custom_attributes' => array(),
			'validate'          => array(),
			'default'		    => '',
		);

		$args = wp_parse_args( $args, $defaults  );

		if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';

		if ( $args['required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' *';
		} else {
			$required = '';
		}

		$args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint( $args['maxlength'] ) . '"' : '';

		if ( is_string( $args['label_class'] ) )
			$args['label_class'] = array( $args['label_class'] );

		if ( is_null( $value ) )
			$value = $args['default'];

		// Custom attribute handling
		$custom_attributes = array();

		if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) )
			foreach ( $args['custom_attributes'] as $attribute => $attribute_value )
				$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';

		if ( ! empty( $args['validate'] ) )
			foreach( $args['validate'] as $validate )
				$args['class'][] = 'validate-' . $validate;

		switch ( $args['type'] ) {
		case "country" :

			$countries = $key == 'shipping_country' ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

			if ( sizeof( $countries ) == 1 ) {

				$field = '<div class="animate-onscroll ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';

				if ( $args['label'] )
					$field .= '<label class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']  . '</label>';

				$field .= '<strong>' . current( array_values( $countries ) ) . '</strong>';

				$field .= '<input type="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" value="' . current( array_keys($countries ) ) . '" ' . implode( ' ', $custom_attributes ) . ' class="country_to_state" />';

				$field .= '</div>' . $after;

			} else {

				$field = '<div class="animate-onscroll ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">'
						. '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label'] . $required  . '</label>'
						. '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" class="chosen-select country_to_state country_select" ' . implode( ' ', $custom_attributes ) . '>'
						. '<option value="">'.__( 'Select a country&hellip;', 'candidate' ) .'</option>';

				foreach ( $countries as $ckey => $cvalue )
					$field .= '<option value="' . esc_attr( $ckey ) . '" '.selected( $value, $ckey, false ) .'>'. $cvalue .'</option>';

				$field .= '</select>';

				$field .= '<noscript><input type="submit" name="woocommerce_checkout_update_totals" value="' . __( 'Update country', 'candidate' ) . '" /></noscript>';

				$field .= '</div>' . $after;

			}

			break;
		case "state" :

			/* Get Country */
			$country_key = $key == 'billing_state'? 'billing_country' : 'shipping_country';

			if ( isset( $_POST[ $country_key ] ) ) {
				$current_cc = wc_clean( $_POST[ $country_key ] );
			} elseif ( is_user_logged_in() ) {
				$current_cc = get_user_meta( get_current_user_id() , $country_key, true );
				if ( ! $current_cc) {
					$current_cc = apply_filters('default_checkout_country', (WC()->customer->get_country()) ? WC()->customer->get_country() : WC()->countries->get_base_country());
				}
			} elseif ( $country_key == 'billing_country' ) {
				$current_cc = apply_filters('default_checkout_country', (WC()->customer->get_country()) ? WC()->customer->get_country() : WC()->countries->get_base_country());
			} else {
				$current_cc = apply_filters('default_checkout_country', (WC()->customer->get_shipping_country()) ? WC()->customer->get_shipping_country() : WC()->countries->get_base_country());
			}

			$states = WC()->countries->get_states( $current_cc );

			if ( is_array( $states ) && empty( $states ) ) {

				$field  = '<div class="animate-onscroll  ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field" style="display: none">';

				if ( $args['label'] )
					$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label'] . $required . '</label>';
				$field .= '<input type="hidden" class="hidden" name="' . esc_attr( $key )  . '" id="' . esc_attr( $key ) . '" value="" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" />';
				$field .= '</div>' . $after;

			} elseif ( is_array( $states ) ) {

				$field  = '<div class="animate-onscroll  ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';

				if ( $args['label'] )
					$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>';
				$field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" class="chosen-select state_select" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '">
					<option value="">'.__( 'Select a state&hellip;', 'candidate' ) .'</option>';

				foreach ( $states as $ckey => $cvalue )
					$field .= '<option value="' . esc_attr( $ckey ) . '" '.selected( $value, $ckey, false ) .'>'. $cvalue .'</option>';

				$field .= '</select>';
				$field .= '</div>' . $after;

			} else {

				$field  = '<div class="animate-onscroll  ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';

				if ( $args['label'] )
					$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>';
				$field .= '<input type="text" class="input-text ' . implode( ' ', $args['input_class'] ) .'" value="' . esc_attr( $value ) . '"  placeholder="' . esc_attr( $args['placeholder'] ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" ' . implode( ' ', $custom_attributes ) . ' />';
				$field .= '</div>' . $after;

			}

			break;
		case "textarea" :

			$field = '<div class="animate-onscroll  ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';

			if ( $args['label'] )
				$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required  . '</label>';

			$field .= '<textarea name="' . esc_attr( $key ) . '" class="input-text ' . implode( ' ', $args['input_class'] ) .'" id="' . esc_attr( $key ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '"' . ( empty( $args['custom_attributes']['rows'] ) ? ' rows="2"' : '' ) . ( empty( $args['custom_attributes']['cols'] ) ? ' cols="5"' : '' ) . implode( ' ', $custom_attributes ) . '>'. esc_textarea( $value  ) .'</textarea>
				</div>' . $after;

			break;
		case "checkbox" :

			$field = '<div class="animate-onscroll  ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">
					<input type="' . esc_attr( $args['type'] ) . '" class="input-checkbox" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" value="1" '.checked( $value, 1, false ) .' />
					<label for="' . esc_attr( $key ) . '" class="checkbox ' . implode( ' ', $args['label_class'] ) .'" ' . implode( ' ', $custom_attributes ) . '>' . $args['label'] . $required . '</label>
				</div>' . $after;

			break;
		case "password" :

			$field = '<div class="animate-onscroll  ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';

			if ( $args['label'] )
				$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>';

			$field .= '<input type="password" class="input-text ' . implode( ' ', $args['input_class'] ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />
				</div>' . $after;

			break;
		case "text" :

			$field = '<div class="animate-onscroll  ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';

			if ( $args['label'] )
				$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label'] . $required . '</label>';

			$field .= '<input type="text" class="input-text ' . implode( ' ', $args['input_class'] ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" '.$args['maxlength'].' value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />
				</div>' . $after;

			break;
		case "select" :

			$options = '';

			if ( ! empty( $args['options'] ) )
				foreach ( $args['options'] as $option_key => $option_text )
					$options .= '<option value="' . esc_attr( $option_key ) . '" '. selected( $value, $option_key, false ) . '>' . esc_attr( $option_text ) .'</option>';

				$field = '<div class="animate-onscroll  ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';

				if ( $args['label'] )
					$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>';

				$field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" class="select" ' . implode( ' ', $custom_attributes ) . '>
						' . $options . '
					</select>
				</div>' . $after;

			break;
		default :

			$field = apply_filters( 'woocommerce_form_field_' . $args['type'], '', $key, $args, $value );

			break;
		}

		if ( $args['return'] ) return $field; else echo $field;
	}
}





  if ( ! function_exists( 'candidate_link_pages' ) ) { 
	function candidate_link_pages() {
	/* ================ Settings ================ */
	$text_num_page = '';
	$num_pages = 10;
	$stepLink = 10; 
	$dotright_text = '…'; 
	$dotright_text2 = '…'; 
	$backtext = '<i class="icons icon-left-dir"></i>'; 
	$nexttext = '<i class="icons icon-right-dir"></i>'; 
	$first_page_text = ''; 
	$last_page_text = ''; 
	/* ================ End Settings ================ */ 

	global $page, $numpages;
	$paged = (int) $page;
	$max_page = $numpages;

	if($max_page <= 1 ) return false; 

	if(empty($paged) || $paged == 0) $paged = 1;

	$pages_to_show = intval($num_pages);
	$pages_to_show_minus_1 = $pages_to_show-1;

	$half_page_start = floor($pages_to_show_minus_1/2); 
	$half_page_end = ceil($pages_to_show_minus_1/2); 

	$start_page = $paged - $half_page_start; 
	$end_page = $paged + $half_page_end; 
	if($start_page <= 0) $start_page = 1;
	if(($end_page - $start_page) != $pages_to_show_minus_1) $end_page = $start_page + $pages_to_show_minus_1;
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = (int) $max_page;
	}

	if($start_page <= 0) $start_page = 1;

	$out='';
		$out.= "<div class='wp-page-break'><div class='pagination'>\n";
				if ($text_num_page){
					$text_num_page = preg_replace ('!{current}|{last}!','%s',$text_num_page);
					$out.= sprintf ("<span class='pages'>$text_num_page</span>",$paged,$max_page);
				}

				if ($backtext && $paged!=1) $out.= _wp_link_page(($paged-1)) . $backtext.'</a>';

				if ($start_page >= 2 && $pages_to_show < $max_page) {
					$out.= _wp_link_page(1). ($first_page_text?$first_page_text:1) .'</a>';
					if($dotright_text && $start_page!=2) $out.= '<span class="extend">'.$dotright_text.'</span>';
				}

				for($i = $start_page; $i <= $end_page; $i++) {
					if($i == $paged) {
						$out.= '<span class="page-numbers current">'.$i.'</span>';
					} else {

						$out.= '<span class="page-numbers">'._wp_link_page($i).$i.'</span></a>';
					}
				}

				
				if ($stepLink && $end_page < $max_page){
					for($i=$end_page+1; $i<=$max_page; $i++) {
						if($i % $stepLink == 0 && $i!==$num_pages) {
							if (++$dd == 1) $out.= '<span class="extend">'.$dotright_text2.'</span>';
							$out.= '<a href="'. esc_url(_wp_link_page($i)) .'">'.$i.'</a>';
						}
					}
				}

				if ($end_page < $max_page) {
					if($dotright_text && $end_page!=($max_page-1)) $out.= '<span class="extend">'.$dotright_text2.'</span>';
					$out.= _wp_link_page($max_page) . ($last_page_text?$last_page_text:$max_page) .'</a>';
				}

				if ($nexttext && $paged!=$end_page) $out.= _wp_link_page(($paged+1)) . $nexttext.'</a>';

		$out.= "</div></div>";
	
	return $out;
}	
  }

	
	
	
	
			
if ( ! function_exists( 'candidat_sc_hexToRgb' ) ) {
	function candidat_sc_hexToRgb($hex) {
		$hex = str_replace("#", "", $hex);
		$color = array();

		$color['r'] = '';
		$color['g'] = '';
		$color['b'] = '';
		
		if(strlen($hex) == 3) {
			$color['r'] = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
			$color['g'] = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
			$color['b'] = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
		}
		else if(strlen($hex) == 6) {
			$color['r'] = hexdec(substr($hex, 0, 2));
			$color['g'] = hexdec(substr($hex, 2, 2));
			$color['b'] = hexdec(substr($hex, 4, 2));
		}
		return $color;
	}
}	
		
	
	

if ( ! function_exists( 'candidat_hex2rgb' ) ) {
	function candidat_hex2rgb($hex, $op=1) {
		$hex = str_replace("#", "", $hex);
		$color = array();

		$color['r'] = '';
		$color['g'] = '';
		$color['b'] = '';
		
		if(strlen($hex) == 3) {
			$color['r'] = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
			$color['g'] = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
			$color['b'] = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
		}
		else if(strlen($hex) == 6) {
			$color['r'] = hexdec(substr($hex, 0, 2));
			$color['g'] = hexdec(substr($hex, 2, 2));
			$color['b'] = hexdec(substr($hex, 4, 2));
		}
		//return $color;
		return 'rgba('.$color['r'].','.$color['g'].','.$color['b'].','. $op .')';
	}
}	
		
	
	
	
	
	
	
function homeshop_get_woocommerce_currencies() {
	return array(
				'AED' => __( 'United Arab Emirates Dirham', 'candidate' ),
				'AUD' => __( 'Australian Dollars', 'candidate' ),
				'BDT' => __( 'Bangladeshi Taka', 'candidate' ),
				'BRL' => __( 'Brazilian Real', 'candidate' ),
				'BGN' => __( 'Bulgarian Lev', 'candidate' ),
				'CAD' => __( 'Canadian Dollars', 'candidate' ),
				'CLP' => __( 'Chilean Peso', 'candidate' ),
				'CNY' => __( 'Chinese Yuan', 'candidate' ),
				'COP' => __( 'Colombian Peso', 'candidate' ),
				'CZK' => __( 'Czech Koruna', 'candidate' ),
				'DKK' => __( 'Danish Krone', 'candidate' ),
				'DOP' => __( 'Dominican Peso', 'candidate' ),
				'EUR' => __( 'Euros', 'candidate' ),
				'HKD' => __( 'Hong Kong Dollar', 'candidate' ),
				'HRK' => __( 'Croatia kuna', 'candidate' ),
				'HUF' => __( 'Hungarian Forint', 'candidate' ),
				'ISK' => __( 'Icelandic krona', 'candidate' ),
				'IDR' => __( 'Indonesia Rupiah', 'candidate' ),
				'INR' => __( 'Indian Rupee', 'candidate' ),
				'NPR' => __( 'Nepali Rupee', 'candidate' ),
				'ILS' => __( 'Israeli Shekel', 'candidate' ),
				'JPY' => __( 'Japanese Yen', 'candidate' ),
				'KIP' => __( 'Lao Kip', 'candidate' ),
				'KRW' => __( 'South Korean Won', 'candidate' ),
				'MYR' => __( 'Malaysian Ringgits', 'candidate' ),
				'MXN' => __( 'Mexican Peso', 'candidate' ),
				'NGN' => __( 'Nigerian Naira', 'candidate' ),
				'NOK' => __( 'Norwegian Krone', 'candidate' ),
				'NZD' => __( 'New Zealand Dollar', 'candidate' ),
				'PYG' => __( 'Paraguayan Guaraní', 'candidate' ),
				'PHP' => __( 'Philippine Pesos', 'candidate' ),
				'PLN' => __( 'Polish Zloty', 'candidate' ),
				'GBP' => __( 'Pounds Sterling', 'candidate' ),
				'RON' => __( 'Romanian Leu', 'candidate' ),
				'RUB' => __( 'Russian Ruble', 'candidate' ),
				'SGD' => __( 'Singapore Dollar', 'candidate' ),
				'ZAR' => __( 'South African rand', 'candidate' ),
				'SEK' => __( 'Swedish Krona', 'candidate' ),
				'CHF' => __( 'Swiss Franc', 'candidate' ),
				'TWD' => __( 'Taiwan New Dollars', 'candidate' ),
				'THB' => __( 'Thai Baht', 'candidate' ),
				'TRY' => __( 'Turkish Lira', 'candidate' ),
				'UAH' => __( 'Ukrainian Hryvnia', 'candidate' ),
				'USD' => __( 'US Dollars', 'candidate' ),
				'VND' => __( 'Vietnamese Dong', 'candidate' ),
				'EGP' => __( 'Egyptian Pound', 'candidate' ),
	);
}
	
	
function homeshop_get_woocommerce_currency_symbol( $currency = '' ) {
	

	switch ( $currency ) {
		case 'AED' :
			$currency_symbol = 'د.إ';
			break;
		case 'AUD' :
		case 'CAD' :
		case 'CLP' :
		case 'COP' :
		case 'HKD' :
		case 'MXN' :
		case 'NZD' :
		case 'SGD' :
		case 'USD' :
			$currency_symbol = '&#36;';
			break;
		case 'BDT':
			$currency_symbol = '&#2547;&nbsp;';
			break;
		case 'BGN' :
			$currency_symbol = '&#1083;&#1074;.';
			break;
		case 'BRL' :
			$currency_symbol = '&#82;&#36;';
			break;
		case 'CHF' :
			$currency_symbol = '&#67;&#72;&#70;';
			break;
		case 'CNY' :
		case 'JPY' :
		case 'RMB' :
			$currency_symbol = '&yen;';
			break;
		case 'CZK' :
			$currency_symbol = '&#75;&#269;';
			break;
		case 'DKK' :
			$currency_symbol = 'kr.';
			break;
		case 'DOP' :
			$currency_symbol = 'RD&#36;';
			break;
		case 'EGP' :
			$currency_symbol = 'EGP';
			break;
		case 'EUR' :
			$currency_symbol = '&euro;';
			break;
		case 'GBP' :
			$currency_symbol = '&pound;';
			break;
		case 'HRK' :
			$currency_symbol = 'Kn';
			break;
		case 'HUF' :
			$currency_symbol = '&#70;&#116;';
			break;
		case 'IDR' :
			$currency_symbol = 'Rp';
			break;
		case 'ILS' :
			$currency_symbol = '&#8362;';
			break;
		case 'INR' :
			$currency_symbol = 'Rs.';
			break;
		case 'ISK' :
			$currency_symbol = 'Kr.';
			break;
		case 'KIP' :
			$currency_symbol = '&#8365;';
			break;
		case 'KRW' :
			$currency_symbol = '&#8361;';
			break;
		case 'MYR' :
			$currency_symbol = '&#82;&#77;';
			break;
		case 'NGN' :
			$currency_symbol = '&#8358;';
			break;
		case 'NOK' :
			$currency_symbol = '&#107;&#114;';
			break;
		case 'NPR' :
			$currency_symbol = 'Rs.';
			break;
		case 'PHP' :
			$currency_symbol = '&#8369;';
			break;
		case 'PLN' :
			$currency_symbol = '&#122;&#322;';
			break;
		case 'PYG' :
			$currency_symbol = '&#8370;';
			break;
		case 'RON' :
			$currency_symbol = 'lei';
			break;
		case 'RUB' :
			$currency_symbol = '&#1088;&#1091;&#1073;.';
			break;
		case 'SEK' :
			$currency_symbol = '&#107;&#114;';
			break;
		case 'THB' :
			$currency_symbol = '&#3647;';
			break;
		case 'TRY' :
			$currency_symbol = '&#8378;';
			break;
		case 'TWD' :
			$currency_symbol = '&#78;&#84;&#36;';
			break;
		case 'UAH' :
			$currency_symbol = '&#8372;';
			break;
		case 'VND' :
			$currency_symbol = '&#8363;';
			break;
		case 'ZAR' :
			$currency_symbol = '&#82;';
			break;
		default :
			$currency_symbol = '';
			break;
	}

	return $currency_symbol;
}	







	
