<?php

$temp = wp_upload_dir();

@define( 'THEMENAME', 'homeshop' );    // Required!!
@define('SHORTNAME', 'sense');   // Required!!


define('MAD_BASE_PATH', trailingslashit(get_template_directory()));
define('MAD_BASE_TEXTDOMAIN', 'homeshop');


@define( 'HOME_URL',  get_home_url('/'));
@define('ADMIN_PATH', get_template_directory() . '/admin');
@define('LIB_PATH', get_template_directory() . '/libs'.'/');

@define('SHOP_PATH', get_template_directory() . '/woocommerce');
@define('TEMPLATEPATH1', get_template_directory());
@define('UPLOAD_PATH', $temp['path'].'/');
@define('UPLOAD_SUBDIR', $temp['subdir'].'/');
@define('UPLOAD_URL', $temp['baseurl'].'/');



define( 'CX_ACTIVATE_K', 'cx_c26ff42d96d5fd8c09f91' );
define( 'CX_ACTIVATE_T', 'homeshop' );

if( function_exists( 'cx_api' ) ) {
cx_api();
}



defined('CLASS_DIR_PATH') || define('CLASS_DIR_PATH', get_template_directory() . '/php/'); // Path to classes folder in Theme

require( LIB_PATH. 'plugin-bundle.php' );

//Loading jQuery and Scripts Admin
require_once (ADMIN_PATH . '/theme-scripts.php');
// include the library for the wishlist
require_once (ADMIN_PATH . '/yith_wishlist/init.php');

// include the library for the grid/list
require_once (ADMIN_PATH . '/woocommerce-grid-list-toggle/grid-list-toggle.php');







if ( ! function_exists( 'homeShop_theme_setup' ) ):


	function homeShop_theme_setup() {
		
	load_theme_textdomain('homeshop', get_template_directory()  . '/lang');
	
	global $content_width;
	if ( !isset( $content_width ) ) {
	$content_width = 770;
	}
	
	add_theme_support( 'woocommerce' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header');
	add_theme_support( 'custom-background');

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	register_nav_menus( array(
		'main_navigation' => __( 'Main Navigation', 'homeshop' ),
		'top_navigation' => __( 'Top Navigation', 'homeshop' )
	) );
	
	

	
	
	require_once(ADMIN_PATH . '/admin_script.php');

	require_once(ADMIN_PATH . '/custom-posttype.php');

	require_once(ADMIN_PATH . '/metabox-class.php');

	require_once(ADMIN_PATH . '/sidebar.php');

	require_once(ADMIN_PATH . '/metabox-sidebar.php');

	require_once(ADMIN_PATH . '/metabox-posts.php');

	require_once('widgets/widgets.php');
	
	
	require_once('widgets/facebook-like-box-widget/facebook-like-box-widget.php');
	
	require_once('widgets/recent-searches-widget/recent-searches-widget.php');

	require_once(ADMIN_PATH . '/interface.php');

	//post-ratings
	require_once( "post-ratings/post-ratings.php" );
	//shortcodes
	require_once ( "shortcodes/shortcodes.php");
	
	if (class_exists('WPBakeryVisualComposerAbstract')) {
		require_once ('vc_extend/vc_extend.php');
	}

	}
endif;
add_action( 'after_setup_theme', 'homeShop_theme_setup' );

locate_template(array('wpml-integration.php'), true, true);


// add_action('after_setup_theme', 'homeshop_load_textdomain');
// function homeshop_load_textdomain () {
	// load_theme_textdomain(MAD_BASE_TEXTDOMAIN, MAD_BASE_PATH  . 'lang');
// }


if ( ! function_exists( 'homeShop_theme_add_editor_styles' ) ) {
	function homeShop_theme_add_editor_styles() {
		add_editor_style( 'custom-editor-style.css' );
	}
}
add_action( 'init', 'homeShop_theme_add_editor_styles' );



add_filter('the_content', 'do_shortcode');

//add body custom class
add_filter('body_class','loft_class_names');  

if ( ! function_exists( 'loft_class_names' ) ) {
	function loft_class_names($classes) {  
		$layout_color = 'default';

		$classes[] = $layout_color;
		return $classes;  
	}  
}

/************************************************************************
* Add custom size
*************************************************************************/
if ( function_exists( 'add_image_size' ) ) {  
	add_image_size( 'post-blog', 870, 405, true );
	add_image_size( 'th-shop', 460, 460, true );
	add_image_size( 'post-full', 1170, 405, true );
	add_image_size( 'prod-archive', 869, 300, true );
	add_image_size( 'latest-post', 158, 158, true ); 
	add_image_size( 'banner-slider', 270, 400, true ); 
}  









/*
* Get Fontello icons
*/
if ( ! function_exists( 'wm_fontello_classes' ) ) {
	function wm_fontello_classes() {
		
		$fontIcons       = '';
		$fontIcons       .= 'icon-docs, icon-emo-happy, icon-odnoklassniki-rect-1, icon-emo-wink2, icon-emo-unhappy, icon-emo-sleep, icon-emo-thumbsup, icon-emo-devil, icon-emo-surprised, icon-emo-tongue, icon-emo-coffee, icon-emo-sunglasses, icon-emo-displeased, icon-emo-beer, icon-emo-grin, icon-emo-angry, icon-emo-saint, icon-emo-cry, icon-emo-shoot, icon-emo-squint, icon-emo-laugh, icon-spin1, icon-spin2, icon-spin3, icon-spin4, icon-spin5, icon-spin6, icon-firefox, icon-chrome-1, icon-opera, icon-ie-1, icon-crown, icon-crown-plus, icon-crown-minus, icon-marquee, icon-glass, icon-music, icon-search, icon-mail, icon-mail-alt, icon-heart, icon-heart-empty, icon-star, icon-star-empty, icon-star-half, icon-star-half-alt, icon-user, icon-users, icon-male, icon-female, icon-video, icon-videocam, icon-picture, icon-camera, icon-camera-alt, icon-th-large, icon-th, icon-th-list, icon-ok, icon-ok-circled, icon-ok-circled2, icon-ok-squared, icon-cancel, icon-cancel-circled, icon-cancel-circled2, icon-plus, icon-plus-circled, icon-plus-squared, icon-plus-squared-alt, icon-minus, icon-minus-circled, icon-minus-squared, icon-minus-squared-alt, icon-help, icon-help-circled, icon-info-circled, icon-info, icon-home, icon-link, icon-unlink, icon-link-ext, icon-link-ext-alt, icon-attach, icon-lock, icon-lock-open, icon-lock-open-alt, icon-pin, icon-eye, icon-eye-off, icon-tag, icon-tags, icon-bookmark, icon-bookmark-empty, icon-flag, icon-flag-empty, icon-flag-checkered, icon-thumbs-up, icon-thumbs-down, icon-thumbs-up-alt, icon-thumbs-down-alt, icon-download, icon-upload, icon-download-cloud, icon-upload-cloud, icon-reply, icon-reply-all, icon-forward, icon-quote-left, icon-quote-right, icon-code, icon-export, icon-export-alt, icon-pencil, icon-pencil-squared, icon-edit, icon-print, icon-retweet, icon-keyboard, icon-gamepad, icon-comment, icon-chat, icon-comment-empty, icon-chat-empty, icon-bell, icon-bell-alt, icon-attention-alt, icon-attention, icon-attention-circled, icon-location, icon-direction, icon-compass, icon-trash, icon-doc, icon-docs-1, icon-doc-text, icon-doc-inv, icon-doc-text-inv, icon-folder, icon-folder-open, icon-folder-empty, icon-folder-open-empty, icon-box, icon-rss, icon-rss-squared, icon-phone, icon-phone-squared, icon-menu, icon-cog, icon-cog-alt, icon-wrench, icon-basket, icon-calendar, icon-calendar-empty, icon-login, icon-logout, icon-mic, icon-mute, icon-volume-off, icon-volume-down, icon-volume-up, icon-headphones, icon-clock, icon-lightbulb, icon-block, icon-resize-full, icon-resize-full-alt, icon-resize-small, icon-resize-vertical, icon-resize-horizontal, icon-move, icon-zoom-in, icon-zoom-out, icon-down-circled2, icon-up-circled2, icon-left-circled2, icon-right-circled2, icon-down-dir, icon-up-dir, icon-left-dir, icon-right-dir, icon-down-open, icon-left-open, icon-right-open, icon-up-open, icon-angle-left, icon-angle-right, icon-angle-up, icon-angle-down, icon-angle-circled-left, icon-angle-circled-right, icon-angle-circled-up, icon-angle-circled-down, icon-angle-double-left, icon-angle-double-right, icon-angle-double-up, icon-angle-double-down, icon-down, icon-left, icon-right, icon-up, icon-down-big, icon-left-big, icon-emo-wink, icon-up-big, icon-right-hand, icon-left-hand, icon-up-hand, icon-down-hand, icon-left-circled, icon-right-circled, icon-up-circled, icon-down-circled, icon-cw, icon-ccw, icon-arrows-cw, icon-level-up, icon-level-down, icon-shuffle, icon-exchange, icon-expand, icon-collapse, icon-expand-right, icon-collapse-left, icon-play, icon-play-circled, icon-play-circled2, icon-stop, icon-pause, icon-to-end, icon-to-end-alt, icon-to-start, icon-to-start-alt, icon-fast-fw, icon-fast-bw, icon-eject, icon-target, icon-signal, icon-award, icon-desktop, icon-laptop, icon-tablet, icon-mobile, icon-inbox, icon-globe, icon-sun, icon-cloud, icon-flash, icon-moon, icon-umbrella, icon-flight, icon-fighter-jet, icon-leaf, icon-font, icon-bold, icon-italic, icon-text-height, icon-text-width, icon-align-left, icon-align-center, icon-align-right, icon-align-justify, icon-list, icon-indent-left, icon-indent-right, icon-list-bullet, icon-list-numbered, icon-strike, icon-underline, icon-superscript, icon-subscript, icon-table, icon-columns, icon-crop, icon-scissors, icon-paste, icon-briefcase, icon-suitcase, icon-ellipsis, icon-ellipsis-vert, icon-off, icon-road, icon-list-alt, icon-qrcode, icon-barcode, icon-book, icon-ajust, icon-tint, icon-check, icon-check-empty, icon-circle, icon-circle-empty, icon-dot-circled, icon-asterisk, icon-gift, icon-fire, icon-magnet, icon-chart-bar, icon-ticket, icon-credit-card, icon-floppy, icon-megaphone, icon-hdd, icon-key, icon-fork, icon-rocket, icon-bug, icon-certificate, icon-tasks, icon-filter, icon-beaker, icon-magic, icon-truck, icon-money, icon-euro, icon-pound, icon-dollar, icon-rupee, icon-yen, icon-rouble, icon-try, icon-won, icon-bitcoin';

		$fontIcons       .= 'icon-sort, icon-sort-down, icon-sort-up, icon-sort-alt-up, icon-sort-alt-down, icon-sort-name-up, icon-sort-name-down, icon-sort-number-up, icon-sort-number-down, icon-hammer, icon-gauge, icon-sitemap, icon-spinner, icon-coffee, icon-food, icon-beer, icon-user-md, icon-stethoscope, icon-ambulance, icon-medkit, icon-h-sigh, icon-hospital, icon-building, icon-smile, icon-frown, icon-meh, icon-anchor, icon-terminal, icon-eraser, icon-puzzle, icon-shield, icon-extinguisher, icon-bullseye, icon-wheelchair, icon-adn, icon-android, icon-apple, icon-bitbucket, icon-bitbucket-squared, icon-css3, icon-dribbble, icon-dropbox, icon-facebook, icon-facebook-squared, icon-flickr, icon-foursquare, icon-github, icon-github-squared, icon-github-circled, icon-gittip, icon-gplus-squared, icon-gplus, icon-html5, icon-instagramm, icon-linkedin-squared, icon-linux, icon-linkedin, icon-maxcdn, icon-pagelines, icon-pinterest-circled, icon-pinterest-squared, icon-renren, icon-skype, icon-stackexchange, icon-stackoverflow, icon-trello, icon-tumblr, icon-tumblr-squared, icon-twitter-squared, icon-twitter, icon-vimeo-squared, icon-vkontakte, icon-weibo, icon-windows, icon-xing, icon-xing-squared, icon-youtube, icon-youtube-squared, icon-youtube-play, icon-blank, icon-lemon, icon-note, icon-note-beamed, icon-music-1, icon-search-1, icon-flashlight, icon-mail-1, icon-heart-1, icon-heart-empty-1, icon-star-1, icon-star-empty-1, icon-user-1, icon-users-1, icon-user-add, icon-video-1, icon-picture-1, icon-camera-1, icon-layout, icon-menu-1, icon-check-1, icon-cancel-1, icon-cancel-circled-1, icon-cancel-squared, icon-plus-1, icon-plus-circled-1, icon-plus-squared-1, icon-minus-1, icon-minus-circled-1, icon-minus-squared-1, icon-help-1, icon-help-circled-1, icon-info-1, icon-info-circled-1, icon-back, icon-home-1, icon-link-1, icon-attach-1, icon-lock-1, icon-lock-open-1, icon-eye-1, icon-tag-1, icon-bookmark-1, icon-bookmarks, icon-flag-1, icon-thumbs-up-1, icon-thumbs-down-1, icon-download-1, icon-upload-1, icon-upload-cloud-1, icon-reply-1, icon-reply-all-1, icon-forward-1, icon-quote, icon-code-1, icon-export-1, icon-pencil-1, icon-feather, icon-print-1, icon-retweet-1, icon-keyboard-1, icon-comment-1, icon-chat-1, icon-bell-1, icon-attention-1, icon-alert, icon-vcard, icon-address, icon-location-1, icon-map, icon-direction-1, icon-compass-1, icon-cup, icon-trash-1, icon-doc-1, icon-doc-landscape, icon-doc-text-1, icon-doc-text-inv-1, icon-newspaper, icon-book-open, icon-book-1, icon-folder-1, icon-archive, icon-box-1, icon-rss-1, icon-phone-1, icon-cog-1, icon-tools, icon-share, icon-shareable, icon-basket-1, icon-bag, icon-calendar-1, icon-login-1, icon-logout-1, icon-mic-1, icon-mute-1, icon-sound, icon-volume, icon-clock-1, icon-hourglass, icon-lamp, icon-light-down, icon-light-up, icon-adjust, icon-block-1, icon-resize-full-1, icon-resize-small-1, icon-popup, icon-publish, icon-window, icon-arrow-combo, icon-down-circled-1, icon-left-circled-1, icon-right-circled-1, icon-up-circled-1, icon-down-open-1, icon-left-open-1, icon-right-open-1, icon-up-open-1, icon-down-open-mini, icon-left-open-mini, icon-right-open-mini, icon-up-open-mini, icon-down-open-big, icon-left-open-big, icon-right-open-big, icon-up-open-big, icon-down-1, icon-left-1, icon-right-1, icon-up-1, icon-down-dir-1, icon-left-dir-1, icon-right-dir-1, icon-up-dir-1, icon-down-bold, icon-left-bold, icon-right-bold, icon-up-bold, icon-down-thin, icon-left-thin, icon-right-thin, icon-up-thin, icon-ccw-1, icon-cw-1, icon-arrows-ccw, icon-level-down-1, icon-level-up-1, icon-shuffle-1, icon-loop, icon-switch, icon-play-1, icon-stop-1, icon-pause-1, icon-record, icon-to-end-1, icon-to-start-1, icon-fast-forward, icon-fast-backward, icon-progress-0, icon-progress-1, icon-progress-2, icon-progress-3, icon-target-1, icon-palette, icon-list-1, icon-list-add, icon-signal-1, icon-trophy, icon-battery, icon-back-in-time, icon-monitor, icon-mobile-1, icon-network, icon-cd, icon-inbox-1, icon-install, icon-globe-1, icon-cloud-1, icon-cloud-thunder, icon-flash-1, icon-moon-1, icon-flight-1, icon-paper-plane, icon-leaf-1, icon-lifebuoy, icon-mouse, icon-briefcase-1, icon-suitcase-1, icon-dot, icon-dot-2, icon-dot-3, icon-brush, icon-magnet-1, icon-infinity, icon-erase, icon-chart-pie, icon-chart-line, icon-chart-bar-1, icon-chart-area, icon-tape, icon-graduation-cap, icon-language, icon-ticket-1, icon-water, icon-droplet, icon-air, icon-credit-card-1, icon-floppy-1, icon-clipboard, icon-megaphone-1, icon-database, icon-drive, icon-bucket, icon-thermometer, icon-key-1, icon-flow-cascade, icon-flow-branch, icon-flow-tree, icon-flow-line, icon-flow-parallel, icon-rocket-1, icon-gauge-1, icon-traffic-cone, icon-cc, icon-cc-by, icon-cc-nc, icon-cc-nc-eu, icon-cc-nc-jp, icon-cc-sa, icon-cc-nd, icon-cc-pd, icon-cc-zero, icon-cc-share, icon-cc-remix, icon-github-1, icon-github-circled-1, icon-flickr-1, icon-flickr-circled, icon-vimeo, icon-vimeo-circled, icon-twitter-1, icon-twitter-circled, icon-facebook-1, icon-facebook-circled, icon-facebook-squared-1, icon-gplus-1, icon-gplus-circled, icon-pinterest, icon-pinterest-circled-1, icon-tumblr-1, icon-tumblr-circled, icon-linkedin-1, icon-linkedin-circled, icon-dribbble-1, icon-dribbble-circled, icon-stumbleupon, icon-stumbleupon-circled, icon-lastfm, icon-lastfm-circled, icon-rdio, icon-rdio-circled, icon-spotify, icon-spotify-circled, icon-qq, icon-instagram, icon-dropbox-1, icon-evernote, icon-flattr, icon-skype-1, icon-skype-circled, icon-renren-1, icon-sina-weibo, icon-paypal, icon-picasa, icon-soundcloud, icon-mixi, icon-behance, icon-google-circles, icon-vkontakte-1, icon-smashing, icon-sweden, icon-db-shape, icon-logo-db, icon-music-outline, icon-music-2, icon-search-outline, icon-search-2, icon-mail-2, icon-heart-2, icon-heart-filled, icon-star-2, icon-star-filled, icon-user-outline, icon-user-2, icon-users-outline, icon-users-2, icon-user-add-outline, icon-user-add-1, icon-user-delete-outline, icon-user-delete, icon-video-2, icon-videocam-outline, icon-videocam-1, icon-picture-outline, icon-picture-2, icon-camera-outline, icon-camera-2, icon-th-outline, icon-th-1, icon-th-large-outline, icon-th-large-1, icon-th-list-outline, icon-th-list-1, icon-ok-outline, icon-ok-1, icon-cancel-outline, icon-cancel-2, icon-cancel-alt, icon-cancel-alt-filled, icon-cancel-circled-outline, icon-cancel-circled-2, icon-plus-outline, icon-plus-2, icon-minus-outline, icon-minus-2, icon-divide-outline, icon-divide, icon-eq-outline, icon-eq, icon-info-outline, icon-info-2, icon-home-outline, icon-home-2, icon-link-outline, icon-link-2, icon-attach-outline, icon-attach-2, icon-lock-2, icon-lock-filled, icon-lock-open-2, icon-lock-open-filled, icon-pin-outline, icon-pin-1, icon-eye-outline, icon-eye-2, icon-tag-2, icon-tags-1, icon-bookmark-2, icon-flag-2, icon-flag-filled, icon-thumbs-up-2, icon-thumbs-down-2, icon-download-outline, icon-download-2, icon-upload-outline, icon-upload-2, icon-upload-cloud-outline, icon-upload-cloud-2, icon-reply-outline, icon-reply-2, icon-forward-outline, icon-forward-2, icon-code-outline, icon-code-2, icon-export-outline, icon-export-2, icon-pencil-2, icon-pen, icon-feather-1, icon-edit-1, icon-print-2, icon-comment-2, icon-chat-2, icon-chat-alt, icon-bell-2, icon-attention-2, icon-attention-filled, icon-warning-empty, icon-warning, icon-contacts, icon-vcard-1, icon-address-1, icon-location-outline, icon-location-2, icon-map-1, icon-direction-outline, icon-direction-2, icon-compass-2, icon-trash-2, icon-doc-2, icon-doc-text-2, icon-doc-add, icon-doc-remove, icon-news, icon-folder-2, icon-folder-add, icon-folder-delete, icon-archive-1, icon-box-2, icon-rss-outline, icon-rss-2, icon-phone-outline, icon-phone-2, icon-menu-outline, icon-menu-2, icon-cog-outline, icon-cog-2, icon-wrench-outline, icon-wrench-1, icon-basket-2';
	
		$fontIcons       .= 'icon-calendar-outlilne, icon-calendar-2, icon-mic-outline, icon-mic-2, icon-volume-off-1, icon-volume-low, icon-volume-middle, icon-volume-high, icon-headphones-1, icon-clock-2, icon-wristwatch, icon-stopwatch, icon-lightbulb-1, icon-block-outline, icon-block-2, icon-resize-full-outline, icon-resize-full-2, icon-resize-normal-outline, icon-resize-normal, icon-move-outline, icon-move-1, icon-popup-1, icon-zoom-in-outline, icon-zoom-in-1, icon-zoom-out-outline, icon-zoom-out-1, icon-popup-2, icon-left-open-outline, icon-left-open-2, icon-right-open-outline, icon-right-open-2, icon-down-2, icon-left-2, icon-right-2, icon-up-2, icon-down-outline, icon-left-outline, icon-right-outline, icon-up-outline, icon-down-small, icon-left-small, icon-right-small, icon-up-small, icon-cw-outline, icon-cw-2, icon-arrows-cw-outline, icon-arrows-cw-1, icon-loop-outline, icon-loop-1, icon-loop-alt-outline, icon-loop-alt, icon-shuffle-2, icon-play-outline, icon-play-2, icon-stop-outline, icon-stop-2, icon-pause-outline, icon-pause-2, icon-fast-fw-outline, icon-fast-fw-1, icon-rewind-outline, icon-rewind, icon-record-outline, icon-record-1, icon-eject-outline, icon-eject-1, icon-eject-alt-outline, icon-eject-alt, icon-bat1, icon-bat2, icon-bat3, icon-bat4, icon-bat-charge, icon-plug, icon-target-outline, icon-target-2, icon-wifi-outline, icon-wifi, icon-desktop-1, icon-laptop-1, icon-tablet-1, icon-mobile-2, icon-contrast, icon-globe-outline, icon-globe-2, icon-globe-alt-outline, icon-globe-alt, icon-sun-1, icon-sun-filled, icon-cloud-2, icon-flash-outline, icon-flash-2, icon-moon-2, icon-waves-outline, icon-waves, icon-rain, icon-cloud-sun, icon-drizzle, icon-snow, icon-cloud-flash, icon-cloud-wind, icon-wind, icon-plane-outline, icon-plane, icon-leaf-2, icon-lifebuoy-1, icon-briefcase-2, icon-brush-1, icon-pipette, icon-power-outline, icon-power, icon-check-outline, icon-check-2, icon-gift-1, icon-temperatire, icon-chart-outline, icon-chart, icon-chart-alt-outline, icon-chart-alt, icon-chart-bar-outline, icon-chart-bar-2, icon-chart-pie-outline, icon-chart-pie-1, icon-ticket-2, icon-credit-card-2, icon-clipboard-1, icon-database-1, icon-key-outline, icon-key-2, icon-flow-split, icon-flow-merge, icon-flow-parallel-1, icon-flow-cross, icon-certificate-outline, icon-certificate-1, icon-scissors-outline, icon-scissors-1, icon-flask, icon-wine, icon-coffee-1, icon-beer-1, icon-anchor-outline, icon-anchor-1, icon-puzzle-outline, icon-puzzle-1, icon-tree, icon-calculator, icon-infinity-outline, icon-infinity-1, icon-pi-outline, icon-pi, icon-at, icon-at-circled, icon-looped-square-outline, icon-looped-square-interest, icon-sort-alphabet-outline, icon-sort-alphabet, icon-sort-numeric-outline, icon-sort-numeric, icon-dribbble-circled-1, icon-dribbble-2, icon-facebook-circled-1, icon-facebook-2, icon-flickr-circled-1, icon-flickr-2, icon-github-circled-2, icon-github-2, icon-lastfm-circled-1, icon-lastfm-1, icon-linkedin-circled-1, icon-linkedin-2, icon-pinterest-circled-2, icon-pinterest-1, icon-skype-outline, icon-skype-2, icon-tumbler-circled, icon-tumbler, icon-twitter-circled-1, icon-twitter-2, icon-vimeo-circled-1, icon-vimeo-1, icon-search-3, icon-mail-3, icon-heart-3, icon-heart-empty-2, icon-star-3, icon-user-3, icon-video-3, icon-picture-3, icon-camera-3, icon-ok-2, icon-ok-circle, icon-cancel-3, icon-cancel-circle, icon-plus-3, icon-plus-circle, icon-minus-3, icon-minus-circle, icon-help-2, icon-info-3, icon-home-3, icon-link-3, icon-attach-3, icon-lock-3, icon-lock-empty, icon-lock-open-3, icon-lock-open-empty, icon-pin-2, icon-eye-3, icon-tag-3, icon-tag-empty, icon-download-3, icon-upload-3, icon-download-cloud-1, icon-upload-cloud-3, icon-quote-left-1, icon-quote-right-1, icon-quote-left-alt, icon-quote-right-alt, icon-pencil-3, icon-pencil-neg, icon-pencil-alt, icon-undo, icon-comment-3, icon-comment-inv, icon-comment-alt, icon-comment-inv-alt, icon-comment-alt2, icon-comment-inv-alt2, icon-chat-3, icon-chat-inv, icon-location-3, icon-location-inv, icon-location-alt, icon-compass-3, icon-trash-3, icon-trash-empty, icon-doc-3, icon-doc-inv-1, icon-doc-alt, icon-doc-inv-alt, icon-article, icon-article-alt, icon-book-open-1, icon-folder-3, icon-folder-empty-1, icon-box-3, icon-rss-3, icon-rss-alt, icon-cog-3, icon-wrench-2, icon-share-1, icon-calendar-3, icon-calendar-inv, icon-calendar-alt, icon-mic-3, icon-volume-off-2, icon-volume-up-1, icon-headphones-2, icon-clock-3, icon-lamp-1, icon-block-3, icon-resize-full-3, icon-resize-full-alt-1, icon-resize-small-2, icon-resize-small-alt, icon-resize-vertical-1, icon-resize-horizontal-1, icon-move-2, icon-popup-3, icon-down-3, icon-left-3, icon-right-3, icon-up-3, icon-down-circle, icon-left-circle, icon-right-circle, icon-up-circle, icon-cw-3, icon-loop-2, icon-loop-alt-1, icon-exchange-1, icon-split, icon-arrow-curved, icon-play-3, icon-play-circle2, icon-stop-3, icon-pause-3, icon-to-start-2, icon-to-end-2, icon-eject-2, icon-target-3, icon-signal-2, icon-award-1, icon-award-empty, icon-list-2, icon-list-nested, icon-bat-empty, icon-bat-half, icon-bat-full, icon-bat-charge-1, icon-mobile-3, icon-cd-1, icon-equalizer, icon-cursor, icon-aperture, icon-aperture-alt, icon-steering-wheel, icon-book-2, icon-book-alt, icon-brush-2, icon-brush-alt, icon-eyedropper, icon-layers, icon-layers-alt, icon-sun-2, icon-sun-inv, icon-cloud-3, icon-rain-1, icon-flash-3, icon-moon-3, icon-moon-inv, icon-umbrella-1, icon-chart-bar-3, icon-chart-pie-2, icon-chart-pie-alt, icon-key-3, icon-key-inv, icon-hash, icon-at-1, icon-pilcrow, icon-dial, icon-search-4, icon-mail-4, icon-heart-4, icon-star-4, icon-user-4, icon-user-woman, icon-user-pair, icon-video-alt, icon-videocam-2, icon-videocam-alt, icon-camera-4, icon-th-2, icon-th-list-2, icon-ok-3, icon-cancel-4, icon-cancel-circle-1, icon-plus-4, icon-home-4, icon-lock-4, icon-lock-open-4, icon-eye-4, icon-tag-4, icon-thumbs-up-3, icon-thumbs-down-3, icon-download-4, icon-export-3, icon-pencil-4, icon-pencil-alt-1, icon-edit-2, icon-chat-4, icon-print-3, icon-bell-3, icon-attention-3, icon-info-4, icon-question, icon-location-4, icon-trash-4, icon-doc-4, icon-article-1, icon-article-alt-1, icon-rss-4, icon-wrench-3, icon-basket-3, icon-basket-alt, icon-calendar-4, icon-calendar-alt-1, icon-volume-off-3, icon-volume-down-1, icon-volume-up-2, icon-bullhorn, icon-clock-4, icon-clock-alt, icon-stop-4, icon-resize-full-4, icon-resize-small-3, icon-zoom-in-2, icon-zoom-out-2, icon-popup-4, icon-down-dir-2, icon-left-dir-2, icon-right-dir-2, icon-up-dir-2, icon-down-4, icon-up-4, icon-cw-4, icon-signal-3, icon-award-2, icon-mobile-4, icon-mobile-alt, icon-tablet-2, icon-ipod, icon-cd-2, icon-grid, icon-book-3, icon-easel, icon-globe-3, icon-chart-1, icon-chart-bar-4, icon-chart-pie-3, icon-dollar-1, icon-at-2, icon-colon, icon-semicolon, icon-squares, icon-money-1, icon-facebook-3, icon-facebook-rect, icon-twitter-3, icon-twitter-bird, icon-twitter-rect, icon-youtube-1, icon-windy-rain-inv, icon-snow-inv, icon-snow-heavy-inv, icon-hail-inv, icon-clouds-inv, icon-clouds-flash-inv, icon-temperature, icon-compass-4, icon-na, icon-celcius, icon-fahrenheit, icon-clouds-flash-alt, icon-sun-inv-1, icon-moon-inv-1, icon-cloud-sun-inv, icon-cloud-moon-inv, icon-cloud-inv, icon-cloud-flash-inv, icon-drizzle-inv, icon-rain-inv, icon-windy-inv, icon-sunrise, icon-sun-3, icon-moon-4, icon-eclipse, icon-mist, icon-wind-1, icon-snowflake, icon-cloud-sun-1, icon-cloud-moon, icon-fog-sun, icon-fog-moon, icon-fog-cloud, icon-fog, icon-cloud-4, icon-cloud-flash-1, icon-cloud-flash-alt, icon-drizzle-1, icon-rain-2, icon-windy, icon-windy-rain, icon-snow-1, icon-snow-alt, icon-snow-heavy, icon-hail, icon-clouds, icon-clouds-flash, icon-search-5, icon-mail-5, icon-heart-5, icon-heart-broken, icon-star-5, icon-star-empty-2, icon-star-half-1, icon-star-half_empty, icon-user-5, icon-user-male, icon-user-female, icon-users-3, icon-movie, icon-videocam-3, icon-isight, icon-camera-5, icon-menu-3, icon-th-thumb, icon-th-thumb-empty, icon-th-list-3, icon-ok-4, icon-ok-circled-1, icon-cancel-5, icon-cancel-circled-3, icon-plus-5, icon-help-circled-2, icon-help-circled-alt, icon-info-circled-2, icon-info-circled-alt, icon-home-5, icon-link-4, icon-attach-4, icon-lock-5, icon-lock-alt, icon-lock-open-5, icon-lock-open-alt-1, icon-eye-5, icon-download-5, icon-upload-4, icon-download-cloud-2, icon-upload-cloud-4, icon-reply-3, icon-pencil-5, icon-export-4, icon-print-4, icon-retweet-2, icon-comment-4, icon-chat-5, icon-bell-4, icon-attention-4, icon-attention-alt-1, icon-location-5, icon-trash-5, icon-doc-5, icon-newspaper-1, icon-folder-4, icon-folder-open-1, icon-folder-empty-2, icon-folder-open-empty-1, icon-cog-4, icon-calendar-5, icon-login-2, icon-logout-2, icon-mic-4, icon-mic-off, icon-clock-5, icon-stopwatch-1, icon-hourglass-1, icon-zoom-in-3, icon-zoom-out-3, icon-down-open-2, icon-left-open-3, icon-right-open-3, icon-up-open-2, icon-down-5, icon-left-4, icon-right-4, icon-up-5, icon-down-bold-1, icon-left-bold-1, icon-right-bold-1, icon-up-bold-1, icon-down-fat, icon-left-fat, icon-right-fat, icon-up-fat, icon-ccw-2, icon-shuffle-3, icon-play-4, icon-pause-4, icon-stop-5, icon-to-end-3, icon-to-start-3, icon-fast-forward-1, icon-fast-backward-1, icon-trophy-1, icon-monitor-1, icon-tablet-3, icon-mobile-5, icon-data-science, icon-data-science-inv, icon-inbox-2, icon-globe-4, icon-globe-inv, icon-flash-4, icon-cloud-5, icon-coverflow, icon-coverflow-empty, icon-math, icon-math-circled, icon-math-circled-empty, icon-paper-plane-1, icon-paper-plane-alt, icon-paper-plane-alt2, icon-fontsize, icon-color-adjust, icon-fire-1, icon-chart-bar-5, icon-hdd-1, icon-connected-object, icon-ruler, icon-vector, icon-vector-pencil, icon-at-3, icon-hash-1, icon-female-1, icon-male-1, icon-spread, icon-king, icon-anchor-2, icon-joystick, icon-spinner1, icon-spinner2, icon-github-3, icon-github-circled-3, icon-github-circled-alt, icon-github-circled-alt2, icon-twitter-4, icon-twitter-circled-2, icon-facebook-4, icon-facebook-circled-2, icon-gplus-2, icon-gplus-circled-1, icon-linkedin-3, icon-linkedin-circled-2, icon-dribbble-3, icon-dribbble-circled-2, icon-instagram-1, icon-instagram-circled, icon-soundcloud-1, icon-soundcloud-circled, icon-mfg-logo, icon-mfg-logo-circled, icon-aboveground-rail, icon-airfield, icon-airport, icon-art-gallery, icon-bar, icon-baseball, icon-basketball, icon-beer-2, icon-belowground-rail, icon-bicycle, icon-bus, icon-cafe, icon-campsite, icon-cemetery, icon-cinema, icon-college, icon-commerical-building, icon-credit-card-3, icon-cricket, icon-embassy, icon-fast-food, icon-ferry, icon-fire-station, icon-football, icon-fuel, icon-garden, icon-giraffe, icon-golf, icon-grocery-store, icon-harbor, icon-heliport, icon-hospital-1, icon-industrial-building, icon-library, icon-lodging, icon-london-underground, icon-minefield, icon-monument, icon-museum, icon-pharmacy, icon-pitch, icon-police, icon-post, icon-prison, icon-rail, icon-religious-christian, icon-religious-islam, icon-religious-jewish, icon-restaurant, icon-roadblock, icon-school, icon-shop, icon-skiing, icon-soccer, icon-swimming, icon-tennis, icon-theatre, icon-toilet, icon-town-hall, icon-trash-6, icon-tree-1, icon-tree-2, icon-warehouse, icon-duckduckgo, icon-aim, icon-delicious, icon-paypal-1, icon-flattr-1, icon-android-1, icon-eventful, icon-smashmag, icon-gplus-3, icon-wikipedia, icon-lanyrd, icon-calendar-6, icon-stumbleupon-1, icon-fivehundredpx, icon-pinterest-2, icon-bitcoin-1, icon-w3c, icon-foursquare-1, icon-html5-1, icon-ie, icon-call, icon-grooveshark, icon-ninetyninedesigns, icon-forrst, icon-digg, icon-spotify-1, icon-reddit, icon-guest, icon-gowalla, icon-appstore, icon-blogger, icon-cc-1, icon-dribbble-4, icon-evernote-1, icon-flickr-3, icon-google, icon-viadeo, icon-instapaper, icon-weibo-1, icon-klout, icon-linkedin-4, icon-meetup, icon-vk, icon-plancast, icon-disqus, icon-rss-5, icon-skype-3, icon-twitter-5, icon-youtube-2, icon-vimeo-2, icon-windows-1, icon-xing-1, icon-yahoo, icon-chrome, icon-email, icon-macstore, icon-myspace, icon-podcast, icon-amazon, icon-steam, icon-cloudapp, icon-dropbox-2, icon-ebay, icon-facebook-5, icon-github-4, icon-github-circled-4, icon-googleplay, icon-itunes, icon-plurk, icon-songkick, icon-lastfm-2, icon-gmail, icon-pinboard, icon-openid, icon-quora, icon-soundcloud-2, icon-tumblr-2, icon-eventasaurus, icon-wordpress, icon-yelp, icon-intensedebate, icon-eventbrite, icon-scribd, icon-posterous, icon-stripe, icon-opentable, icon-cart, icon-print-5, icon-angellist, icon-instagram-2, icon-dwolla, icon-appnet, icon-statusnet, icon-acrobat, icon-drupal, icon-buffer, icon-pocket, icon-bitbucket-1, icon-lego, icon-login-3, icon-stackoverflow-1, icon-hackernews, icon-lkdto, icon-facebook-6, icon-facebook-rect-1, icon-twitter-6, icon-twitter-bird-1, icon-vimeo-3, icon-vimeo-rect, icon-tumblr-3, icon-tumblr-rect, icon-googleplus-rect, icon-github-text, icon-github-5, icon-skype-4, icon-icq, icon-yandex, icon-yandex-rect, icon-vkontakte-rect, icon-odnoklassniki, icon-odnoklassniki-rect, icon-friendfeed, icon-friendfeed-rect, icon-blogger-1, icon-blogger-rect, icon-deviantart, icon-jabber, icon-lastfm-3, icon-lastfm-rect, icon-linkedin-5, icon-linkedin-rect, icon-picasa-1, icon-wordpress-1';

		$fontIcons       .= 'icon-instagram-3, icon-instagram-filled, icon-diigo, icon-box-4, icon-box-rect, icon-tudou, icon-youku, icon-win8, icon-amex, icon-discover, icon-visa, icon-mastercard, icon-glass-1, icon-music-3, icon-search-6, icon-search-circled, icon-mail-6, icon-mail-circled, icon-heart-6, icon-heart-circled, icon-heart-empty-3, icon-star-6, icon-star-circled, icon-star-empty-3, icon-user-6, icon-group, icon-group-circled, icon-torso, icon-video-4, icon-video-circled, icon-video-alt-1, icon-videocam-4, icon-video-chat, icon-picture-4, icon-camera-6, icon-photo, icon-photo-circled, icon-th-large-2, icon-th-3, icon-th-list-4, icon-view-mode, icon-ok-5, icon-ok-circled-2, icon-ok-circled2-1, icon-cancel-6, icon-cancel-circled-4, icon-cancel-circled2-1, icon-plus-6, icon-plus-circled-2, icon-minus-4, icon-minus-circled-2, icon-help-3, icon-help-circled-3, icon-info-circled-3, icon-home-6, icon-home-circled, icon-website, icon-website-circled, icon-attach-5, icon-attach-circled, icon-lock-6, icon-lock-circled, icon-lock-open-6, icon-lock-open-alt-2, icon-eye-6, icon-eye-off-1, icon-tag-5, icon-tags-2, icon-bookmark-3, icon-bookmark-empty-1, icon-flag-3, icon-flag-circled, icon-thumbs-up-4, icon-thumbs-down-4, icon-download-6, icon-download-alt, icon-upload-5, icon-share-2, icon-quote-1, icon-quote-circled, icon-export-5, icon-pencil-6, icon-pencil-circled, icon-edit-3, icon-edit-circled, icon-edit-alt, icon-print-6, icon-retweet-3, icon-comment-5, icon-comment-alt-1, icon-bell-5, icon-warning-1, icon-exclamation, icon-error, icon-error-alt, icon-location-6, icon-location-circled, icon-compass-5, icon-compass-circled, icon-trash-7, icon-trash-circled, icon-doc-6, icon-doc-circled, icon-doc-new, icon-doc-new-circled, icon-folder-5, icon-folder-circled, icon-folder-close, icon-folder-open-2, icon-rss-6, icon-phone-3, icon-phone-circled, icon-cog-5, icon-cog-circled, icon-cogs, icon-wrench-4, icon-wrench-circled, icon-basket-4, icon-basket-circled, icon-calendar-7, icon-calendar-circled, icon-mic-5, icon-mic-circled, icon-volume-off-4, icon-volume-down-2, icon-volume-1, icon-volume-up-3, icon-headphones-3, icon-clock-6, icon-clock-circled, icon-lightbulb-2, icon-lightbulb-alt, icon-block-4, icon-resize-full-5, icon-resize-full-alt-2, icon-resize-small-4, icon-resize-vertical-2, icon-resize-horizontal-2, icon-move-3, icon-zoom-in-4, icon-zoom-out-4, icon-down-open-3, icon-left-open-4, icon-right-open-4, icon-up-open-3, icon-down-6, icon-left-5, icon-right-5, icon-up-6, icon-down-circled-2, icon-left-circled-2, icon-right-circled-2, icon-up-circled-2, icon-down-hand-1, icon-left-hand-1, icon-right-hand-1, icon-up-hand-1, icon-cw-5, icon-cw-circled, icon-arrows-cw-2, icon-shuffle-4, icon-play-5, icon-play-circled-1, icon-play-circled2-1, icon-stop-6, icon-stop-circled, icon-pause-5, icon-pause-circled, icon-record-2, icon-eject-3, icon-backward, icon-backward-circled, icon-fast-backward-2, icon-fast-forward-2, icon-forward-3, icon-forward-circled, icon-step-backward, icon-step-forward, icon-target-4, icon-signal-4, icon-desktop-2, icon-desktop-circled, icon-laptop-2, icon-laptop-circled, icon-network-1, icon-inbox-3, icon-inbox-circled, icon-inbox-alt, icon-globe-5, icon-globe-alt-1, icon-cloud-6, icon-cloud-circled, icon-flight-2, icon-leaf-3, icon-font-1, icon-fontsize-1, icon-bold-1, icon-italic-1, icon-text-height-1, icon-text-width-1, icon-align-left-1, icon-align-center-1, icon-align-right-1, icon-align-justify-1, icon-list-3, icon-indent-left-1, icon-indent-right-1, icon-briefcase-3, icon-off-1, icon-road-1, icon-qrcode-1, icon-barcode-1, icon-braille, icon-book-4, icon-adjust-1, icon-tint-1, icon-check-3, icon-check-empty-1, icon-asterisk-1, icon-gift-2, icon-fire-2, icon-magnet-2, icon-chart-2, icon-chart-circled, icon-credit-card-4, icon-megaphone-2, icon-clipboard-2, icon-hdd-2, icon-key-4, icon-certificate-2, icon-tasks-1, icon-filter-1, icon-gauge-2, icon-smiley, icon-smiley-circled, icon-address-book, icon-address-book-alt, icon-asl, icon-glasses, icon-hearing-impaired, icon-iphone-home, icon-person, icon-adult, icon-child, icon-blind, icon-guidedog, icon-accessibility, icon-universal-access, icon-male-2, icon-female-2, icon-behance-1, icon-blogger-2, icon-cc-2, icon-css, icon-delicious-1, icon-deviantart-1, icon-digg-1, icon-dribbble-5, icon-facebook-7, icon-flickr-4, icon-foursquare-2, icon-friendfeed-1, icon-friendfeed-rect-1, icon-github-6, icon-github-text-1, icon-googleplus, icon-instagram-4, icon-linkedin-6, icon-path, icon-picasa-2, icon-pinterest-3, icon-reddit-1, icon-skype-5, icon-slideshare, icon-stackoverflow-2, icon-stumbleupon-2, icon-twitter-7, icon-tumblr-4, icon-vimeo-4, icon-vkontakte-2, icon-w3c-1, icon-wordpress-2, icon-youtube-3, icon-music-4, icon-search-7, icon-mail-7, icon-heart-7, icon-star-7, icon-user-7, icon-videocam-5, icon-camera-7, icon-photo-1, icon-attach-6, icon-lock-7, icon-eye-7, icon-tag-6, icon-thumbs-up-5, icon-pencil-7, icon-comment-6, icon-location-7, icon-cup-1, icon-trash-8, icon-doc-7, icon-note-1, icon-cog-6, icon-params, icon-calendar-8, icon-sound-1, icon-clock-7, icon-lightbulb-3, icon-tv, icon-desktop-3, icon-mobile-6, icon-cd-3, icon-inbox-4, icon-globe-6, icon-cloud-7, icon-paper-plane-2, icon-fire-3, icon-graduation-cap-1, icon-megaphone-3, icon-database-2, icon-key-5, icon-beaker-1, icon-truck-1, icon-money-2, icon-food-1, icon-shop-1, icon-diamond, icon-t-shirt, icon-wallet, icon-search-8, icon-mail-8, icon-heart-8, icon-heart-empty-4, icon-star-8, icon-user-8, icon-video-5, icon-picture-5, icon-th-large-3, icon-th-4, icon-th-list-5, icon-ok-6, icon-ok-circle-1, icon-cancel-7, icon-cancel-circle-2, icon-plus-circle-1, icon-minus-circle-1, icon-link-5, icon-attach-7, icon-lock-8, icon-lock-open-7, icon-tag-7, icon-reply-4, icon-reply-all-2, icon-forward-4, icon-code-3, icon-retweet-4, icon-comment-7, icon-comment-alt-2, icon-chat-6, icon-attention-5, icon-location-8, icon-doc-8, icon-docs-landscape, icon-folder-6, icon-archive-2, icon-rss-7, icon-rss-alt-1, icon-cog-7, icon-logout-3, icon-clock-8, icon-block-5, icon-resize-full-6, icon-resize-full-circle, icon-popup-5, icon-left-open-5, icon-right-open-5, icon-down-circle-1, icon-left-circle-1, icon-right-circle-1, icon-up-circle-1, icon-down-dir-3, icon-right-dir-3, icon-down-micro, icon-up-micro, icon-cw-circle, icon-arrows-cw-3, icon-updown-circle, icon-target-5, icon-signal-5, icon-progress-4, icon-progress-5, icon-progress-6, icon-progress-7, icon-progress-8, icon-progress-9, icon-progress-10, icon-progress-11, icon-font-2, icon-list-4, icon-list-numbered-1, icon-indent-left-2, icon-indent-right-2, icon-cloud-8, icon-terminal-1, icon-facebook-rect-2, icon-twitter-bird-2, icon-vimeo-rect-1, icon-tumblr-rect-1, icon-googleplus-rect-1, icon-linkedin-rect-1, icon-skype-6, icon-vkontakte-rect-1, icon-youtube-4, icon-right-big';	
		
		$fontIcons       = explode( ', ', $fontIcons );
		$menuIcons = array();
		$menuIcons['none'] = __( '- select icon -', 'homeshop' );
		foreach ( $fontIcons as $icon ) {
			$menuIcons[$icon] = ucwords( str_replace( '-', ' ', substr( $icon, 4 ) ) );
		}	
			
			
			//output
			//sort( $menuIcons );
			return $menuIcons;
	}
} 



if ( ! function_exists( 'wm_fontello_social' ) ) {
	function wm_fontello_social() {
			
		$fontIcons       = 'icon-instagram-1, icon-instagram-circled, icon-instagram-2, icon-instagram-3, icon-instagram-filled, icon-instagram-4, icon-odnoklassniki-rect-1, icon-twitter, icon-twitter-squared, icon-twitter-rect, icon-twitter-1, icon-twitter-2, icon-twitter-3, icon-twitter-circled, icon-twitter-circled-1, icon-twitter-circled-2, icon-twitter-4, icon-twitter-5, icon-twitter-6, icon-twitter-7, icon-twitter-bird, icon-twitter-bird-2, icon-twitter-bird-1, icon-pinterest, icon-pinterest-1, icon-pinterest-2, icon-pinterest-3, icon-pinterest-circled, icon-pinterest-circled-1, icon-pinterest-circled-2, icon-pinterest-squared, icon-rss, icon-rss-squared, icon-rss-7, icon-rss-alt-1, icon-facebook, icon-facebook-1, icon-facebook-circled-1, icon-facebook-squared, icon-facebook-rect-2, icon-facebook-2, icon-facebook-3, icon-facebook-4, icon-facebook-5, icon-facebook-6, icon-facebook-7,  icon-vimeo-rect-1, icon-tumblr-rect-1, icon-googleplus-rect-1, icon-googleplus, icon-google-circles, icon-google, icon-linkedin-rect-1, icon-skype-6, icon-vkontakte-rect-1, icon-youtube, icon-youtube-squared, icon-youtube-1, icon-youtube-2, icon-youtube-3, icon-youtube-4';
		
		$fontIcons       = explode( ', ', $fontIcons );
		$menuIcons = array();
		$menuIcons['none'] = __( '- select icon -', 'homeshop' );
		foreach ( $fontIcons as $icon ) {
			$menuIcons[$icon] = ucwords( str_replace( '-', ' ', substr( $icon, 4 ) ) );
		}	

			//output
			//sort( $menuIcons );
			return $menuIcons;
	}
} 













/********************************************

  Get the featured image

********************************************/
if ( !function_exists('get_featured_image') )
{
	function get_featured_image($post_id, $size, $class, $title)
	{
		if($class == NULL) { $class = 'wp-featured-image'; } else { $class = $class . ' wp-featured-image'; }
		if($post_id == NULL) { $post_id = get_post_thumbnail_id(); }
		$wp_featured_image = wp_get_attachment_image_src($post_id, $size, true);
		$src = $wp_featured_image[0];
		$output = '<img src="'. esc_url($src) .'" class="'. esc_attr($class) .'" alt="'. esc_attr($title) .'" title="'. esc_attr($title) .'" />';
		return $output;
	}
}


//custom menu
class homeShop_Nav_Walker extends Walker_Nav_Menu {
private $curItem;

   function start_lvl(&$output, $depth = 0, $args = array()) {

	$item1 = $this->curItem;
	$mega  = get_post_meta($item1, '_menu_item_megamenu', true);
	
   
	   if($depth == 0)
	   {
		   if($mega == '1') {
    	    $output .= "\n<ul class=\"wide-dropdown normalAniamtion\">\n";
		   } else {
		    $output .= "\n<ul class=\"normal-dropdown normalAnimation\">\n";
		   }
	   }else
	   {
		   $output .= "\n<ul class=\"normalAnimation\">\n";
	   }
   }

  function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0)
    {
	
	global $wp_query;
	$this->curItem = $item->ID;
	$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

	$class_names = $value = '';
	$prepend = '';
	$append = '';
	$description  = ! empty( $item->description ) ? '<span class="nav-description">'.esc_attr( $item->description ).'</span>' : '';
	$icon  = get_post_meta($item->ID, '_menu_item_icon', true);
	$icon  = ! empty( $icon ) ? '<i class="icons '.$icon.'"></i>' : '';
	
	$cf = get_post_meta($item->ID, '_menu_item_color', true);

		if($depth == 0  ) {
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names .= ' '.$cf;
        $class_names = ' class="'. esc_attr( $class_names ) . '"';
		}
		
        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

	



        $item_output = $args->before;

        if($depth == 0  ) {
	        $item_output .= '<a'. $attributes .' >';
			$item_output .= $icon;
			 $item_output .= '<span class="nav-caption" >';
	        $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
	        $item_output .= $args->link_after;
			 $item_output .= '</span>';
	        $item_output .= $description;
	        $item_output .= '</a>';
		} else {
	        $item_output .= '<a'. $attributes .' ';
			if($item->is_dropdown) {
			$item_output .= 'class="sub1"';
			}
	        $item_output .= '>';
	        $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
	        $item_output .= $args->link_after;
			
	        $item_output .= '</a>';
		}

        $item_output .= $args->after;

		
		$item_output = str_replace('current_page_item', ' current-item', $item_output);
		$item_output = str_replace('current-menu-parent', ' current-item', $item_output);
		$item_output = str_replace('current_page_ancestor', ' current-item', $item_output);
		
		
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
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





if ( !function_exists( 'is_login_page' ) ) {

	function is_login_page() {
		return in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) );
	}
}



/** Comment template

--------------------------------------------------------------------------------------------------------------------------------- 

*/ 
if ( ! function_exists( 'homeshop_comment_reply_link' ) ) {
	 function homeshop_comment_reply_link( $link ) {  
		global $user_ID;  
	  
		if ( get_option( 'comment_registration' ) && ! $user_ID )  
			return str_replace( 'comment-reply-link', 'reply', $link );  
		else  
			return str_replace( 'comment-reply-link', 'reply', $link );  
	}  
}
add_filter( 'comment_reply_link', 'homeshop_comment_reply_link' );

if ( ! function_exists( 'homeshop_comment' ) ) :
	function homeshop_comment( $comment, $args, $depth )
	{
	$GLOBALS['comment'] = $comment;
	
	?>
	
    <li>
		<p><strong>
		<?php 
		$com = get_comment_author_url();
			
		if( $com != "" && $com != "http://Website") { ?>
			<a href="<?php echo esc_url($com); ?>"><?php comment_author();?></a>
			<?php } else { ?>
			<?php comment_author();  ?>
		<?php } ?> 
		</strong></p>
		
		<a href="<?php echo esc_url(get_comment_author_url()); ?>">
		<?php echo get_avatar( $comment, 80 ); ?>
		</a>
		
		<span class="date"><?php echo  get_comment_date(); ?></span>
		
		<?php 
		comment_reply_link( array_merge( $args, array('reply_text' => '<i class="icons icon-reply"></i>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); 
		?> 
	
		<?php comment_text(); ?>
		
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<p><?php _e( 'Your comment is awaiting moderation.', 'homeshop' ); ?></p>
		<?php endif; ?>
	

    </li>  
  <?php
}
endif;







/** Latest post 

------------------------------------------------------ 

$post_num (5) = number posts

*/  
if ( ! function_exists( 'homeshop_the_recent_posts' ) ) {
function homeshop_the_recent_posts ($post_num=5){ 
		global $post;
		$tmp_post = $post;
		$myposts = get_posts('numberposts='.$post_num.'&order=DESC&orderby=post_date');

		foreach( $myposts as $post ) : setup_postdata($post);
			$title1 = get_the_title();
			if($title1 == '') {
			$title1 = 'No Title';
			}
			?>
        	<li>
			<a href="<?php echo esc_url( get_permalink() ); ?>"><i class="icons icon-right-dir"></i> <?php echo esc_html($title1); ?></a>
			</li>

		<?php endforeach;
		$post = $tmp_post; 
}  
}




/********************************************

  Get meta boxes

********************************************/
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

/////// Add custom field 'Blogpost type' to post type  ////////////////////////////////////////////////////////////////////////////////////////////////////
  add_action('add_meta_boxes','init_metabox_blogposttype');
  
  if ( ! function_exists( 'init_metabox_blogposttype' ) ) {
	  function init_metabox_blogposttype(){
		  add_meta_box('meta_blogposttype', 'Post Type', 'meta_blogposttype_cb', 'post', 'normal');
	  }
  }
  
 if ( ! function_exists( 'meta_blogposttype_cb' ) ) {  
  function meta_blogposttype_cb($post){
      $dispo = get_post_meta($post->ID,'meta_blogposttype',true);
      echo '<label for="meta_blogposttype">Media :</label>';
      echo '<select id="meta_blogposttype" name="meta_blogposttype">';
		echo '<option value="standard" '.selected($dispo, 'standard').'>Image Featured Post</option>';
		echo '<option value="slideshow" '.selected($dispo, 'slideshow').'>Image Gallery Post</option>';
        echo '<option value="video" '.selected($dispo, 'video').'>Video Post</option>';
      echo '</select>';
  }
 }
 
  add_action('save_post','save_metabox_blogposttype');

 if ( ! function_exists( 'save_metabox_blogposttype' ) ) {    
	  function save_metabox_blogposttype($post_id){
		  if(isset($_POST['meta_blogposttype']))
			  update_post_meta($post_id, 'meta_blogposttype', esc_html($_POST['meta_blogposttype']));
	  }
 }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

 

//// Add custom field 'video type' to blog post type  ///////////////////////////////////////////////////////////////////////////////////////////////
  add_action('add_meta_boxes','init_metabox_blogvideoservice');
  
 if ( ! function_exists( 'init_metabox_blogvideoservice' ) ) { 
  function init_metabox_blogvideoservice(){
      add_meta_box('meta_blogvideoservice', 'Video Service', 'meta_blogvideoservice_cb', 'post', 'normal');
  }
 }
 
  if ( ! function_exists( 'meta_blogvideoservice_cb' ) ) { 
  function meta_blogvideoservice_cb($post){
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
  add_action('save_post','save_metabox_blogvideoservice');
  
  
  
  if ( ! function_exists( 'get_page_number' ) ) {
	function get_page_number() {
		if ( get_query_var('paged') ) {
			print ' | ' . __( 'Page ' , 'homeshop') . get_query_var('paged');
		}
	} 
	}

	
  if ( ! function_exists( 'save_metabox_blogvideoservice' ) ) { 	
	function save_metabox_blogvideoservice($post_id){
      if(isset($_POST['meta_blogvideoservice']))
          update_post_meta($post_id, 'meta_blogvideoservice', esc_html($_POST['meta_blogvideoservice']));
      if(isset($_POST['meta_blogvideourl']))
          update_post_meta($post_id, 'meta_blogvideourl', esc_html($_POST['meta_blogvideourl']));
    }
  }


 



//////////////Excerpt functions////////////////////////////////////////////////////////////////////////////////////////////////////
  if ( ! function_exists( 'homeshop_excerpt_length' ) ) { 
	function homeshop_excerpt_length( $length ) {
		return 100; 
	}
  }	
add_filter( 'excerpt_length', 'homeshop_excerpt_length', 999 );


  if ( ! function_exists( 'homeshop_excerpt_more' ) ) { 
	 function homeshop_excerpt_more( $more ) {
		 return '...';
	 }
  }
 add_filter('excerpt_more', 'homeshop_excerpt_more');



if ( ! function_exists( 'get_tagss' ) ) {
	function get_tagss()
	{
	the_tags('Tags:', ', ', '<br />');  
	}
}

if ( ! function_exists( 'homeshop_tag_cloud_widget' ) ) {
	function homeshop_tag_cloud_widget($args) {
		$args['number'] = 20; //adding a 0 will display all tags
		$args['largest'] = 14; //largest tag
		$args['smallest'] = 14; //smallest tag
		$args['unit'] = 'px'; //tag font unit
		$args['format'] = 'flat'; //ul with a class of wp-tag-cloud
		$args['separator'] = ''; 
		return $args;
	}
}
add_filter( 'widget_tag_cloud_args', 'homeshop_tag_cloud_widget' );



if ( ! function_exists( 'homeshop_tag_cloud_widget1' ) ) {
	function homeshop_tag_cloud_widget1($args) {
		$args['number'] = 20; //adding a 0 will display all tags
		$args['largest'] = 14; //largest tag
		$args['smallest'] = 14; //smallest tag
		$args['unit'] = 'px'; //tag font unit
		$args['format'] = 'flat'; //ul with a class of wp-tag-cloud
		$args['separator'] = ''; 
		return $args;
	}
}

add_filter( 'woocommerce_product_tag_cloud_widget_args', 'homeshop_tag_cloud_widget1' );


add_filter ( 'wp_tag_cloud', 'homeshop_tag_cloud_slug_class' );


if ( ! function_exists( 'homeshop_tag_cloud_slug_class' ) ) {
	function homeshop_tag_cloud_slug_class( $taglinks ) {
		$tags = explode('</a>', $taglinks);

		$regex = "#(.*class=')(.*)(' title.*)#e"; 
			foreach( $tags as $tag ) {
			$tag = preg_replace($regex, "('$1tag-size-1  tag-item $2$3')", $tag );
			 $tagn[] =  $tag;
			}
		$taglinks = implode('</a>', $tagn);
		return $taglinks;
	}
}

if ( ! function_exists( 'the_excerpt_max_charlength' ) ) {
	function the_excerpt_max_charlength($limit=20){
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


if ( ! function_exists( 'the_excerpt_max_charlength_text' ) ) {
	function the_excerpt_max_charlength_text($text1='', $limit=5){
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

if ( ! function_exists( 'product_max_charlength_text' ) ) {
	function product_max_charlength_text($text1='', $limit=15){
		$text = $text1;
		$string  = ''; 
		$dots = ''; 
		if($text != '') {
				//$explode = str_split($text); 
				$explode = preg_split('//u',$text,-1,PREG_SPLIT_NO_EMPTY);		
				$dots = '...'; 
				if(count($explode) <= $limit){ 
					$dots = ''; 
					$string  .= $text;
				} else{
						for($i=0;$i<$limit;$i++){ 
							$string .= $explode[$i].""; 
						} 
				  } 
		}	

		
		return $string.$dots; 
	}  
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action('wp_ajax_add_to_mailchimp_list', 'add_to_mailchimp_list_homeshop');
add_action('wp_ajax_nopriv_add_to_mailchimp_list', 'add_to_mailchimp_list_homeshop');

if ( ! function_exists( 'add_to_mailchimp_list_homeshop' ) ) {
	function add_to_mailchimp_list_homeshop() {

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




//login url
if ( ! function_exists( 'homeShop_curPageURL' ) ) {
    function homeShop_curPageURL() {
    	$pageURL = 'http';
    	if ( isset( $_SERVER["HTTPS"] ) AND $_SERVER["HTTPS"] == "on" ) 
    		$pageURL .= "s";
    	
    	$pageURL .= "://";
    	
    	if ( isset( $_SERVER["SERVER_PORT"] ) AND $_SERVER["SERVER_PORT"] != "80" ) 
    		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    	else
    		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    	
    	return $pageURL;
    }         
} 


#Add widgets support
if ( function_exists('register_sidebar') )
{
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
				'before_widget' => '<div class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="top-1">',
				'after_title' => '</h4>'
			));
		}
	}
}

register_sidebar( 
	array(
		'id'          =>   'shop_product_search_sidebar',
		'name'        => __( 'Shop Product Search' , 'homeshop' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
		'description' => __( 'This sidebar is located the product search page.' , 'homeshop' ),
	)
 );

register_sidebar( 
	array(
		'id'          =>   'shop_category_sidebar',
		'name'        => __( 'Shop Category Sidebar' , 'homeshop' ),
		'before_widget' => '<div id="%1$s" class="widget sidebar-box %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="sidebar-box-heading"><i class="icons icon-docs"></i><h4>',
		'after_title'   => '</h4></div>',
		'description' => __( 'This sidebar is located the category shop.' , 'homeshop' ),
	)
 );
 
 register_sidebar( 
	array(
		'id'          =>   'currency_converter_sidebar',
		'name'        => 'Currency Converter Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
		'description' => __( 'This sidebar is located the cyrrency converter block.' , 'homeshop' ),
	)
 );
  
 
 
 
 
 /*--------------------------------------------------------------------------------------------------
	Footer sidebars
--------------------------------------------------------------------------------------------------*/

	if ( get_option('sense_fsidebar1_columns') &&  get_option('sense_fsidebar1_columns') != '' ) {

			
		$f_row1 = (int)get_option('sense_fsidebar1_columns');

		if ( function_exists('register_sidebars') ) {	

			if ( $f_row1 > 1 ) {

				$args = array(
					'name'          => 'Footer row 1 - widget %d',
					'id'            => "shfooter",
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title' => '<h3 class="widgettitle title">',
					'after_title' => '</h3>' ); 

				register_sidebars($f_row1 ,$args);
			}
			else{
				$args = array(
					'name'          => 'Footer row 1 - widget 1',
					'id'            => "shfooter",
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title' => '<h3 class="widgettitle title">',
					'after_title' => '</h3>' ); 
				register_sidebars( 1,$args );
			}
			
		}

	}
	

 
	if ( get_option('sense_fsidebar2_columns') &&  get_option('sense_fsidebar2_columns') != '' ) {

			
		$f_row2 = (int)get_option('sense_fsidebar2_columns');

		if ( function_exists('register_sidebars') ) {	

			if ( $f_row2 > 1 ) {

				$args = array(
					'name'          => 'Footer row 2 - widget %d',
					'id'            => "shfooter",
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title' => '<h3 class="widgettitle title">',
					'after_title' => '</h3>' ); 

				register_sidebars($f_row2 ,$args);
			}
			else{
				$args = array(
					'name'          => 'Footer row 2 - widget 1',
					'id'            => "shfooter",
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title' => '<h3 class="widgettitle title">',
					'after_title' => '</h3>' ); 
				register_sidebars( 1,$args );
			}
			
		}

	}
 
 
 
 
 
 /*--------------------------------------------------------------------------------------------------
	Shop
--------------------------------------------------------------------------------------------------*/ 
// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );

if ( ! function_exists( 'jk_dequeue_styles' ) ) {
	function jk_dequeue_styles( $enqueue_styles ) {
		unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
		unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
		unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
		unset( $enqueue_styles['woocommerce_chosen_styles'] );
		
		wp_dequeue_style( 'woocommerce_chosen_styles' );
		
		return $enqueue_styles;
	}
}
// Or just remove them all in one line
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
if( !function_exists( 'is_shop_installed' ) ) {
    function is_shop_installed() {
        global $woocommerce;
        if( isset( $woocommerce ) || defined( 'JIGOSHOP_VERSION' ) ) {
            return true;
        } else {
            return false;
        }
    }
}

add_filter( 'woocommerce_short_description', 'yourprefix_product_short_description', 11 );

if ( ! function_exists( 'yourprefix_product_short_description' ) ) {
	function yourprefix_product_short_description( $excerpt ) {
		global $post;

		$limit = 30;
		if(get_option('sense_num_product_short_des') && get_option('sense_num_product_short_des') != '') {
			$limit = (int)get_option('sense_num_product_short_des');
		}
		
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



add_filter( 'woocommerce_subcategory_count_html', 'woo_remove_category_products_count' );


if ( ! function_exists( 'woo_remove_category_products_count' ) ) {
	function woo_remove_category_products_count() {
		return;
	}
}

$num_p = '4';
if(get_option('sense_num_product') && get_option('sense_num_product') != '') {
$num_p = get_option('sense_num_product');
}

add_filter('loop_shop_per_page', create_function('$cols', 'return '.$num_p.';'), 20);




remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

if ( ! function_exists( 'my_woocommerce_breadcrumbs' ) ) {
	function my_woocommerce_breadcrumbs() {
		return array(
				'delimiter'   => ' <i class="icons icon-right-dir"></i> ',
				'wrap_before' => '<div class="col-lg-12 col-md-12 col-sm-12"><div class="breadcrumbs"><p>',
				'wrap_after'  => '</p></div></div>',
				'before'      => '',
				'after'       => '',
				'home'        => _x( 'Home', 'breadcrumb', 'homeshop' ),
			);
	}
}	 
add_filter( 'woocommerce_breadcrumb_defaults', 'my_woocommerce_breadcrumbs' );

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

if ( ! function_exists( 'my_theme_wrapper_start' ) ) {
  function my_theme_wrapper_start() {
    echo '';
  }
}

if ( ! function_exists( 'my_theme_wrapper_end' ) ) {
  function my_theme_wrapper_end() {
    echo '';
  }
}
  
if ( ! function_exists( 'the_breadcrumbs' ) ) {  
	function the_breadcrumbs() {
 
        global $post;
		
		echo '<div class="col-lg-12 col-md-12 col-sm-12"><div class="breadcrumbs"><p>';
		
        if (!is_home()) {
 
            echo "<a href='";
            echo esc_url(home_url());
            echo "'>";
            echo __( 'Home', 'homeshop' );
            echo "</a>";
 
            if (is_category() || is_single()) {
 
                echo ' <i class="icons icon-right-dir"></i> ';
                $cats = get_the_category( $post->ID );
 
                foreach ( $cats as $cat ){
                    echo $cat->cat_name;
                    echo '  <i class="icons icon-right-dir"></i>  ';
                }
                if (is_single()) {
                   echo esc_html(get_the_title());
                }
            } elseif (is_page()) {
 
                if($post->post_parent){
                    $anc = get_post_ancestors( $post->ID );
                    $anc_link = esc_url(get_page_link( $post->post_parent ));
 
                    foreach ( $anc as $ancestor ) {
                        $output = ' <i class="icons icon-right-dir"></i> <a href="'. $anc_link .'">';
						$output .= get_the_title($ancestor);
						$output .= '</a> <i class="icons icon-right-dir"></i>';
                    }
 
                    echo $output;
                    echo esc_html(get_the_title());
 
                } else {
                    echo '  <i class="icons icon-right-dir"></i>  ';
                    echo esc_html(get_the_title());
                }
            }
        }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {_e( 'Archive', 'homeshop' ); echo ": "; the_time('F jS, Y'); }
    elseif (is_month()) {_e( 'Archive', 'homeshop' ); echo ": "; the_time('F, Y'); }
    elseif (is_year()) {_e( 'Archive', 'homeshop' ); echo": "; the_time('Y'); }
    elseif (is_author()) {_e( 'Author archive', 'homeshop' ); echo": "; }
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {_e( 'Blogarchive', 'homeshop' ); echo ": "; echo' ';}
    elseif (is_search()) {_e( 'Search results', 'homeshop' ); echo": "; }
	
	echo '</p></div></div>';
}
}





add_action( 'wp_enqueue_scripts', 'remove_gridlist_styles', 30 );
if ( ! function_exists( 'remove_gridlist_styles' ) ) {  
	function remove_gridlist_styles() {
		wp_dequeue_style( 'grid-list-button' );
	}
}




//add_action('woocommerce_after_shop_loop_item', 'show_add_to_wishlist', 50 );
if ( ! function_exists( 'show_add_to_wishlist' ) ) {  
	function show_add_to_wishlist()
	{
	echo do_shortcode('[yith_wcwl_add_to_wishlist]');
	}
}


add_action('init', 'woocommerce_clear_cart_url');
if ( ! function_exists( 'woocommerce_clear_cart_url' ) ) { 
	function woocommerce_clear_cart_url() {
		global $woocommerce;
		if( isset($_REQUEST['clear-cart']) ) {
			$woocommerce->cart->empty_cart();
		}
	}
}





//hook into the init action and call create_book_taxonomies when it fires
//add_action( 'init', 'homeshop_create_product_taxonomies', 0 );
//add_action('admin_init', 'flush_rewrite_rules'); 

//create two taxonomies, genres and writers for the post type "product_brand"
if ( ! function_exists( 'homeshop_create_product_taxonomies' ) ) { 
	function homeshop_create_product_taxonomies()
	{
	  // Add new taxonomy, make it hierarchical (like categories)
	  $labels = array(
		'name' => _x( 'Manufacturer', 'homeshop' ),
		'singular_name' => _x( 'Manufacturer', 'homeshop' ),
		'search_items' =>  __( 'Search Manufacturer', 'homeshop' ),
		'all_items' => __( 'All Manufacturer', 'homeshop' ),
		'parent_item' => __( 'Parent Manufacturer', 'homeshop' ),
		'parent_item_colon' => __( 'Parent Manufacturer:', 'homeshop' ),
		'edit_item' => __( 'Edit Manufacturer', 'homeshop' ),
		'update_item' => __( 'Update Manufacturer', 'homeshop' ),
		'add_new_item' => __( 'Add New Manufacturer', 'homeshop' ),
		'new_item_name' => __( 'New Manufacturer Name', 'homeshop' ),
		'menu_name' => __( 'Manufacturer', 'homeshop' ),
	  );     

	  register_taxonomy('product_brand',array('product'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		//'rewrite' => true,
		'rewrite' => array( 'slug' => 'brands', 'with_front' => true ),
	  ));
	}
}
  
  
  if ( ! function_exists( 'filter_post_type_link' ) ) { 
	function filter_post_type_link($link, $post)
	{
		if ($post->post_type != 'product')
			return $link;
	  if ($cats = get_the_terms($post->ID, 'product_brand'))
		if ($cats = get_the_terms($post->ID, 'product_brand'))
			$link = str_replace('%product_brand%', array_pop($cats)->slug, $link);
		return $link;
	}
  }
//add_filter('post_type_link', 'filter_post_type_link', 10, 2);  
  
  
  
  
  
  
  
  
  
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
  if ( ! function_exists( 'woo_remove_product_tabs' ) ) { 
	function woo_remove_product_tabs( $tabs ) {

		unset( $tabs['additional_information'] );  	// Remove the additional information tab
		
		if(get_option('sense_product_reviews')  && get_option('sense_product_reviews') == 'hide' ) {
		unset( $tabs['reviews'] ); 	// Remove the reviews tab
		}
		
		return $tabs;
	 
	}  
  } 

  
  
  
  
  
  
  
 if ( ! function_exists( 'rc_woocommerce_recently_viewed_products' ) ) { 
	function rc_woocommerce_recently_viewed_products( $per_page = 5, $num_show = 3) {
	// Get WooCommerce Global
	global $woocommerce;

	// Get recently viewed product cookies data
	$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
	$viewed_products = array_filter( array_map( 'absint', $viewed_products ) );

	
	// If no data, quit
	if ( empty( $viewed_products ) ) {
		return '<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="carousel-heading">
								<h4>'.__( 'Recently Viewed Products', 'homeshop' ).'</h4>
							</div>
						</div><br><p style="padding-left:15px;" >'.__( 'You have not viewed any product yet!', 'homeshop' ).'</p>';
	}
	// Create the object
	ob_start();

	
	// Get products per page
	if( !isset( $per_page ) ? $number = 5 : $number = $per_page )

	// Create query arguments array
    $query_args = array(
    				'posts_per_page' => $number, 
    				'no_found_rows'  => 1, 
    				'post_status'    => 'publish', 
    				'post_type'      => 'product', 
    				'post__in'       => $viewed_products, 
    				'orderby'        => 'rand'
    				);

	// Add meta_query to query args
	$query_args['meta_query'] = array();

    // Check products stock status
    $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();

	// Create a new query
	$r = new WP_Query($query_args);
	$custom_class = '';
	$content = '';
	// If query return results
	if ( $r->have_posts() ) {

		$content = '<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="carousel-heading">
								<h4>'.__( 'Recently Viewed Products', 'homeshop' ).'</h4>';
								
				if( count($r) > $num_show ) {				
				$content .= '<div class="carousel-arrows">
									<i class="icons icon-left-dir"></i>
									<i class="icons icon-right-dir"></i>
							</div>';
					}			
								
		$content .= '</div>
						</div>';
		
		$content .= '<div class="carousel owl-carousel-wrap col-lg-12 col-md-12 col-sm-12">
							<div class="owl-carousel" data-max-items="'. $num_show .'">';

		// Start the loop
		while ( $r->have_posts()) {
			$r->the_post();
			global $product;
			$price_html = $product->get_price_html();
			$num_rating = (int) $product->get_average_rating();
			$current_db_version = get_option( 'woocommerce_db_version', null );	
			$current_product = $product;
			$show_add_to_cart = true;
			$product_id = $r->post->ID;
			$add_to_cart_button_class = 'add_to_cart_link_type';
			
			
				if (class_exists('WC_CVO_Visibility_Options')) {
					global $wc_cvo;
					/**
					 * Check show or hide price
					 */
					 if (($wc_cvo->setting('wc_cvo_prices') == 'secured' && !catalog_visibility_user_has_access()) || $wc_cvo->setting('wc_cvo_prices') == 'disabled') {
						 $product_price = '';
					 }
					 
					 /**
					 * Check show or hide add to cart button
					 */
					 if (($wc_cvo->setting('wc_cvo_atc') == 'secured' && !catalog_visibility_user_has_access()) || $wc_cvo->setting('wc_cvo_atc') == 'disabled') {
						 $show_add_to_cart = false;
					 }
				}
			
			
			$content .= '<div><div class="product">
			<div class="product-image">';
			
			if(get_option('sense_quick_view') && get_option('sense_quick_view') != 'show') {
			$content .= '<a href="' . esc_url(get_permalink()) . '" class="img-product-hover">';
			}
			
			$content .= '' . ( has_post_thumbnail() ? get_the_post_thumbnail( $r->post->ID, 'th-shop' ) : woocommerce_placeholder_img( 'shop_thumbnail' ) ) . '';
			
			if(get_option('sense_quick_view') && get_option('sense_quick_view') != 'show') {
			$content .= '</a>';
			}
			
			if(get_option('sense_quick_view') && get_option('sense_quick_view') != 'hide') {
				$content .= '<a href="' . esc_url(get_permalink()) . '" class="product-hover">
					<i class="icons icon-eye-1"></i> '. __("Quick View", 'homeshop') .'
				</a>';
			}	
			$content .= '</div>
			
			<div class="product-info">
				<h5><a href="' . esc_url(get_permalink()) . '">' . product_max_charlength_text(get_the_title($product_id), (int) get_option('sense_num_product_title')) . '</a></h5>';
				
				$content .=  categories_product1($r->post->ID);
				
				$content .= '<span class="price">'. $price_html .'</span>
							<div class="rating readonly-rating" data-score="'. $num_rating .'"></div>
			</div>';
			
			
			$content .= '<div class="product-actions">';
			
			if ($show_add_to_cart && $current_product->is_in_stock() && $price_html != '') {
					$add_to_cart_text_external = __( 'Add to cart', 'homeshop' );
					
					
						if ( $current_product->product_type != 'external' ) {
							$cart_url = add_query_arg('add-to-cart',$product_id, get_option('siteurl').'/?post_type=product');
						} else if ( $current_product->product_type == 'external' ) {
							if ( version_compare( $current_db_version, '2.0', '<' ) && null !== $current_db_version ) {
								$cart_url = get_post_meta( $product_id, '_product_url', true  );
								$add_to_cart_text_external = get_post_meta( $product_id, '_button_text', true  );
								( $add_to_cart_text_external ) ? $add_to_cart_text_external : __( 'Buy product', 'homeshop' );
							} else {
								$cart_url = $current_product->product_url;
								$add_to_cart_text_external = $current_product->get_button_text();
							}
						}
						
						
						switch (get_post_type($product_id)) :
							case "product_variation" :
								$class 	= 'is_variation';
								$cart_url = WC_Compare_Functions::get_product_url($product_id);
								break;
							default :
								$class  = 'simple';
								break;
						endswitch;
						
						if ( $current_product->product_type == 'external' ) {
							$content .= sprintf('<span class="add-to-cart"><a href="%s" rel="nofollow" class="add_to_cart_button %s product_type_%s %s" target="_blank"> 
							
								<span class="action-wrapper">
									<i class="icons icon-basket-2"></i>
									<span class="action-name">%s</span>
								</span >
							
							</a><a class="virtual_added_to_cart" href="#">&nbsp;</a></span>', $cart_url, $add_to_cart_button_class, $class, $custom_class, $add_to_cart_text_external);
						} else {
							$content .= sprintf('<span class="add-to-cart"><a href="%s" data-product_id="%s" class="add_to_cart_button %s product_type_%s %s" target="_blank"> 
							
								<span class="action-wrapper">
									<i class="icons icon-basket-2"></i>
									<span class="action-name">%s</span>
								</span >
							
							</a><a class="virtual_added_to_cart" href="#" style="position: absolute; top:0;" >&nbsp;</a></span>', $cart_url, $product_id, $add_to_cart_button_class, $class, $custom_class, $add_to_cart_text_external);
						}
						
					}		
			
			
			
			if( class_exists( 'YITH_WCWL_Shortcode' ) ) {
				$content .= do_shortcode('[yith_wcwl_add_to_wishlist]');
				}
			
			
			
		if ( function_exists('woo_add_compare_button' ) && woo_add_compare_button() != '' ) {
			
			$content .= '<span class="add-to-compare">
			<span class="action-wrapper">
				<i class="icons icon-docs"></i>
				<span class="action-name">'. woo_add_compare_button() .'</span>
			</span>
		</span>';
			
			}
			$content .= '</div>';
			
			
			
			$content .= '</div></div>';
		}

		$content .= '</div></div>';

	}

	// Get clean object
	$content .= ob_get_clean();

	// Return whole content
	return $content;
}
 }

add_filter('next_post_link', 'post_link_attributes1');
add_filter('previous_post_link', 'post_link_attributes2');
 
 
  if ( ! function_exists( 'post_link_attributes1' ) ) { 
	function post_link_attributes1($output) {
		$code = 'class=" button grey regular right-icon "';
		return str_replace('<a href=', '<a '.$code.' href=', $output);
	}
  }
  
  if ( ! function_exists( 'post_link_attributes2' ) ) {  
	function post_link_attributes2($output) {
		$code = 'class=" button grey regular "';
		return str_replace('<a href=', '<a '.$code.' href=', $output);
	}
  }

	
	
if ( ! function_exists( 'get_compare_list_html_popup1' ) ) { 	
	function get_compare_list_html_popup1() {
		global $woo_compare_comparison_page_global_settings, $woo_compare_page_style, $woo_compare_table_style, $woo_compare_table_content_style, $woo_compare_addtocart_style, $woo_compare_viewcart_style;
		global $woo_compare_product_prices_style;
		$current_db_version = get_option( 'woocommerce_db_version', null );
		$compare_list = WC_Compare_Functions::get_compare_list();
		$woo_compare_basket_icon = get_option('woo_compare_basket_icon');
		if (trim($woo_compare_basket_icon) == '') $woo_compare_basket_icon = WOOCP_IMAGES_URL.'/compare_remove.png';
		$html = '';
		$product_cats = array();
		$products_fields = array();
		$products_prices = array();
		$custom_class = '';
		$add_to_cart_text = $woo_compare_addtocart_style['addtocart_link_text'];
		$add_to_cart_button_class = 'add_to_cart_link_type';
		
		if (is_array($compare_list) && count($compare_list)>0) {
			$html .= '';
			$html .= '<table  class="compare-table" >';
			
			
			//table name
			$html .= '<tr><th>'. __('Product Name', 'homeshop' ) .'</th>';

			foreach ($compare_list as $product_id) {
			$product_cat = get_post_meta( $product_id, '_woo_compare_category', true );
				if ($product_cat > 0) {
					$product_cats[] = $product_cat;
				}
			$products_fields[$product_id] = WC_Compare_Categories_Fields_Data::get_fieldid_results($product_cat);
			
			
			
			$product_name = WC_Compare_Functions::get_variation_name($product_id);
			$product_url = WC_Compare_Functions::get_product_url($product_id);
			$html .= '<td ><h5><a href="'. esc_url($product_url) .'">'.$product_name.'</a></h5></td>';
			}
			$html .= '</tr>';
			
			//table image
			$html .= '<tr><th>'. __('Image', 'homeshop' ) .'</th>';

			foreach ($compare_list as $product_id) {
			$image_src = WC_Compare_Functions::get_post_thumbnail($product_id, 150, 150);
			$product_url = WC_Compare_Functions::get_product_url($product_id);
			$product_name = WC_Compare_Functions::get_variation_name($product_id);
			
			if (trim($image_src) == '') {
				$image_src = '<img alt="'.$product_name.'" src="'. ( ( version_compare( $current_db_version, '2.1.0', '<' ) && null !== $current_db_version ) ? woocommerce_placeholder_img_src() : wc_placeholder_img_src() ) .'" />';
			}
			$html .= '<td class="compare-image"><a href="'. esc_url($product_url) .'">'.$image_src.'</a></td>';
			}
			$html .= '</tr>';
			
			
			
			//table rating
			$html .= '<tr><th>'. __('Rating', 'homeshop' ) .'</th>';

			foreach ($compare_list as $product_id) {

				if (get_option('woocommerce_enable_review_rating') != 'no') {
				
					if ( version_compare( $current_db_version, '2.0', '<' ) && null !== $current_db_version ) {
					$current_product1 = new WC_Product($product_id);
					} else {
					$current_product1 = get_product($product_id);
					}
					$num_rating = (int) $current_product1->get_average_rating();
					$html .= '<td><div class="rating readonly-rating" data-score="'. $num_rating .'"></div></td>';	
				}

			}
			$html .= '</tr>';
			
			
			
			
			//table Price
			$html .= '<tr><th>'. __('Price', 'homeshop' ) .'</th>';

			foreach ($compare_list as $product_id) {
				if ( version_compare( $current_db_version, '2.0', '<' ) && null !== $current_db_version ) {
					$current_product2 = new WC_Product($product_id);
				} else {
					$current_product2 = get_product($product_id);
				}
				$product_price = $current_product2->get_price_html();
				
				$show_add_to_cart = true;
				if (class_exists('WC_CVO_Visibility_Options')) {
					global $wc_cvo;
					/**
					 * Check show or hide price
					 */
					 if (($wc_cvo->setting('wc_cvo_prices') == 'secured' && !catalog_visibility_user_has_access()) || $wc_cvo->setting('wc_cvo_prices') == 'disabled') {
						 $product_price = '';
					 }
					 
					 /**
					 * Check show or hide add to cart button
					 */
					 if (($wc_cvo->setting('wc_cvo_atc') == 'secured' && !catalog_visibility_user_has_access()) || $wc_cvo->setting('wc_cvo_atc') == 'disabled') {
						 $show_add_to_cart = false;
					 }
				}
				$products_prices[$product_id] = $product_price;

			$html .= ' <td><span class="price">'.$products_prices[$product_id].'</span></td>';
			}
			$html .= '</tr>';
			
			

			
			//table Description
			$html .= '<tr><th>'. __('Description', 'homeshop' ) .'</th>';

			foreach ($compare_list as $product_id) {
			$post = get_post( $product_id );
			$product_des = ( $post->post_excerpt ) ? $post->post_excerpt : $post->post_content;
			
			$html .= '<td><p>'. the_excerpt_max_charlength_text($product_des, 20) .'</p></td>';
			}
			$html .= '</tr>';
			
			
			
			
			
			//table Manufacturer
			$html .= '<tr><th>'. __('Manufacturer', 'homeshop' ) .'</th>';

			foreach ($compare_list as $product_id) {
			$product_terms = wp_get_object_terms($product_id, 'product_brand');
			
			$html .= '<td>';
			
				if(!empty($product_terms)){
					if(!is_wp_error( $product_terms )){
			
						foreach($product_terms as $term){
						$html .= '<p>'. $term->name .'</p>';
						}
					}
				}
			$html .= '</td>';
			
			}
			$html .= '</tr>';
			
			
			
			
			
			//table Availability
			$html .= '<tr><th>'. __('Availability', 'homeshop' ) .'</th>';

			foreach ($compare_list as $product_id) {
			$html .= '<td>';
				if ( version_compare( $current_db_version, '2.0', '<' ) && null !== $current_db_version ) {
					$current_product = new WC_Product($product_id);
				} else {
					$current_product = get_product($product_id);
				}

				if (  $current_product->is_purchasable() ) {
					$availability = $current_product->get_availability();

					if ( $availability['availability'] ) {
					$html .= '<p><span class="green">'. esc_html( $availability['availability'] ) .'</span></p>';
					}
				}
				
			$html .= '</td>';	
			}
			$html .= '</tr>';
			
			
			
			
			
			//table Product Code
			$html .= '<tr><th>'. __('Product Code', 'homeshop' ) .'</th>';

			foreach ($compare_list as $product_id) {
				if ( version_compare( $current_db_version, '2.0', '<' ) && null !== $current_db_version ) {
					$current_product = new WC_Product($product_id);
				} else {
					$current_product = get_product($product_id);
				}
			
			
			$html .= '<td>';
				if ( wc_product_sku_enabled() && ( $current_product->get_sku() || $current_product->is_type( 'variable' ) ) ) {
				$html .= '<p>'.( $sku = $current_product->get_sku() ) ? $sku : __( 'n/a', 'homeshop' ).'</p>';
				}
			$html .= '</td>';	
			}
			$html .= '</tr>';
			
			
			
			
			
			
			
			//table Weight
			$html .= '<tr><th>'. __('Weight', 'homeshop' ) .'</th>';

			foreach ($compare_list as $product_id) {
				if ( version_compare( $current_db_version, '2.0', '<' ) && null !== $current_db_version ) {
					$current_product = new WC_Product($product_id);
				} else {
					$current_product = get_product($product_id);
				}

			$html .= '<td>';
				if ( $current_product->enable_dimensions_display() && ($current_product->has_weight() )) {
				
					$html .= '<p>'.$current_product->get_weight().' '. esc_attr( get_option( 'woocommerce_weight_unit' ) ) .'</p>';
					
				}
			$html .= '</td>';
			
			}
			$html .= '</tr>';
			
			
			
			
			//table Dimensions
			$html .= '<tr><th>'. __('Dimensions', 'homeshop' ) .'<br>(L x W x H)</th>';

			foreach ($compare_list as $product_id) {
				if ( version_compare( $current_db_version, '2.0', '<' ) && null !== $current_db_version ) {
					$current_product = new WC_Product($product_id);
				} else {
					$current_product = get_product($product_id);
				}

			$html .= '<td>';
				if ( $current_product->enable_dimensions_display() && ( $current_product->has_dimensions() )) {
				
					$html .= '<p>'.$current_product->get_dimensions().'</p>';
					
				}
			$html .= '</td>';
			
			}
			$html .= '</tr>';
			
			
			
			
			
			
			
				
			
			
			
			
			$product_cats = implode(",", $product_cats);
			$compare_fields = WC_Compare_Categories_Fields_Data::get_results('cat_id IN('.$product_cats.')', 'cf.cat_id ASC, cf.field_order ASC');
			if (is_array($compare_fields) && count($compare_fields)>0) {
				$j = 1;
				foreach ($compare_fields as $field_data) {
					$j++;
					$html .= '<tr class="row_'.$j.'">';
					if (trim($field_data->field_unit) != '')
						$html .= '<th class="column_first"><div class="compare_value">'.stripslashes($field_data->field_name).' ('.trim(stripslashes($field_data->field_unit)).')</div></th>';
					else
						$html .= '<th class="column_first"><div class="compare_value">'.stripslashes($field_data->field_name).'</div></th>';
					$i = 0;
					foreach ($compare_list as $product_id) {
						$i++;
						$empty_cell_class = '';
						$empty_text_class = '';
						if (in_array($field_data->id, $products_fields[$product_id])) {
							$field_value = get_post_meta( $product_id, '_woo_compare_'.$field_data->field_key, true );
							if (is_serialized($field_value)) $field_value = maybe_unserialize($field_value);
							if (is_array($field_value) && count($field_value) > 0) $field_value = implode(', ', $field_value);
							elseif (is_array($field_value) && count($field_value) < 0) $field_value = $woo_compare_table_content_style['empty_text'];
							if (trim($field_value) == '') $field_value = $woo_compare_table_content_style['empty_text'];
						}else {
							$field_value = $woo_compare_table_content_style['empty_text'];
						}
						if ($field_value == $woo_compare_table_content_style['empty_text']) {
							$empty_cell_class = 'empty_cell';
							$empty_text_class = 'empty_text';
						}
						$html .= '<td class="column_'.$i.' '.$empty_cell_class.'"><div class="td-spacer '.$empty_text_class.' compare_'.$field_data->field_key.'">'.$field_value.'</div></td>';
					}
					$html .= '</tr>';
					if ($j==2) $j=0;
				}
				
					$j++;
					if ($j>2) $j=1;
					//$html .= '<tr class="row_'.$j.' row_end"><th class="column_first">&nbsp;</th>';
					$i = 0;
			}
			
			
			
			
			
			
			
			
			
			
			
			
			//table action
			$html .= '<tr><th>'. __('Actions', 'homeshop' ) .'<br></th>';

			foreach ($compare_list as $product_id) {
				
				if ( version_compare( $current_db_version, '2.0', '<' ) && null !== $current_db_version ) {
					$current_product = new WC_Product($product_id);
				} else {
					$current_product = get_product($product_id);
				}

				$show_add_to_cart = true;
				if (class_exists('WC_CVO_Visibility_Options')) {
					global $wc_cvo;
					/**
					 * Check show or hide price
					 */
					 if (($wc_cvo->setting('wc_cvo_prices') == 'secured' && !catalog_visibility_user_has_access()) || $wc_cvo->setting('wc_cvo_prices') == 'disabled') {
						 $product_price = '';
					 }
					 
					 /**
					 * Check show or hide add to cart button
					 */
					 if (($wc_cvo->setting('wc_cvo_atc') == 'secured' && !catalog_visibility_user_has_access()) || $wc_cvo->setting('wc_cvo_atc') == 'disabled') {
						 $show_add_to_cart = false;
					 }
				}
				
				
				
			$html .= '<td>';
				
				
					if ($show_add_to_cart && $current_product->is_in_stock() && trim($products_prices[$product_id]) != '') {
						if ( $current_product->product_type != 'external' ) {
							$cart_url = add_query_arg('add-to-cart',$product_id, get_option('siteurl').'/?post_type=product');
						} else if ( $current_product->product_type == 'external' ) {
							if ( version_compare( $current_db_version, '2.0', '<' ) && null !== $current_db_version ) {
								$cart_url = get_post_meta( $product_id, '_product_url', true  );
								$add_to_cart_text_external = get_post_meta( $product_id, '_button_text', true  );
								( $add_to_cart_text_external ) ? $add_to_cart_text_external : __( 'Buy product', 'homeshop' );
							} else {
								$cart_url = $current_product->product_url;
								$add_to_cart_text_external = $current_product->get_button_text();
							}
						}
						switch (get_post_type($product_id)) :
							case "product_variation" :
								$class 	= 'is_variation';
								$cart_url = WC_Compare_Functions::get_product_url($product_id);
								break;
							default :
								$class  = 'simple';
								break;
						endswitch;
						
						if ( $current_product->product_type == 'external' ) {
							$html .= sprintf('<a href="%s" rel="nofollow" class="add_to_cart_button %s product_type_%s %s" target="_blank"> <span class="add-to-cart">
                                                <span class="action-wrapper">
                                                    <i class="icons icon-basket-2"></i>
                                                    <span class="action-name">%s</span>
                                                </span>
                                            </span></a>', $cart_url, $add_to_cart_button_class, $class, $custom_class, $add_to_cart_text_external);
						} else {
							$html .= sprintf('<a href="%s" data-product_id="%s" class="add_to_cart_button %s product_type_%s %s" target="_blank"> <span class="add-to-cart">
                                                <span class="action-wrapper">
                                                    <i class="icons icon-basket-2"></i>
                                                    <span class="action-name">%s</span>
                                                </span>
                                            </span></a>', $cart_url, $product_id, $add_to_cart_button_class, $class, $custom_class, $add_to_cart_text);
						}
						$html .= '<a class="virtual_added_to_cart" href="#">&nbsp;</a>';
						
					}
					
				
				
				$html .= '<a  href="#" class="woo_compare_popup_remove_product" rel="'.$product_id.'" style="cursor:pointer;" >
                                            <span class="add-to-trash">
                                                <span class="action-wrapper">
                                                    <i class="icons icon-trash-8"></i>
                                                    <span class="action-name">'. __( 'Remove', 'homeshop') .'</span>
                                                </span>
                                            </span>
                                        </a>';
				
				
				
				
			$html .= '</td>';
			
			}
			$html .= '</tr>';
			
			
			
			

			//table tags
			$html .= '<tr><th>'. __('Tags', 'homeshop' ) .'</th>';

			foreach ($compare_list as $product_id) {
				if ( version_compare( $current_db_version, '2.0', '<' ) && null !== $current_db_version ) {
					$current_product = new WC_Product($product_id);
				} else {
					$current_product = get_product($product_id);
				}
			$tag_count = sizeof( get_the_terms( $product_id, 'product_tag' ) );
			
			$html .= '<td>';
	
			$html .= '<p class="compare-tags" >'.$current_product->get_tags( ' ', '', '' ) .'</p>';

			$html .= '</td>';
			}
			$html .= '</tr>';
			
			
			
			
			$html .= '</table>';
			$html .= '';
		}else {
			
			if( function_exists( 'icl_t' ) ) {
			$no_compare_list = icl_t('Homeshop', 'no_compare_list', 'You do not have any product to compare.');
			} else {
			$no_compare_list = 'You do not have any product to compare.';
			}
			
			$html .= '<div class="no_compare_list">'. $no_compare_list .'</div>';
		}
		return $html;
	}

}


		
		
		
		
		
		
		
		
		
//contact		
// AJAX HENDLERS

add_action('wp_ajax_send_contact_form', 'sc_ajax_send_contact_form');
add_action('wp_ajax_nopriv_send_contact_form', 'sc_ajax_send_contact_form');

if ( ! function_exists( 'sc_ajax_send_contact_form' ) ) {
	function sc_ajax_send_contact_form() {
		require_once CLASS_DIR_PATH . 'contactsend.php';
		die();
	}
}
	
		
		
		


/////convert homeshop_hex2rgb//////////////////////////////////////////////////////////////////////	
if ( ! function_exists( 'homeshop_hex2rgb' ) ) {
	function homeshop_hex2rgb($hex, $op=1) {
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
	
/////convert hex2rgb//////////////////////////////////////////////////////////////////////	
if ( ! function_exists( 'hex2rgb' ) ) {
	function hex2rgb($hex, $op=1) {
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
		
		
if ( ! function_exists( 'sc_hexToRgb' ) ) {
	function sc_hexToRgb($hex) {
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

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment_basketcount');
 
 
 if ( ! function_exists( 'woocommerce_header_add_to_cart_fragment_basketcount' ) ) { 
	function woocommerce_header_add_to_cart_fragment_basketcount($fragments) {
	global $woocommerce;
	ob_start();
	
	if( function_exists( 'icl_t' ) ) {
	$items_title = icl_t('Homeshop', 'top_items', 'Items');
	} else {
	$items_title = __('Items', 'homeshop');
	}
	
	
	?>
	<a  class="top_cart_a" id="top_cart_basket" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>"><i class="icons icon-basket-2"></i>
	
	<?php echo sprintf( _n( '%s Item', '%s Items', max($woocommerce->cart->cart_contents_count, 1), 'homeshop' ), number_format_i18n($woocommerce->cart->cart_contents_count) ); ?>
	

	</a>
	 <?php 
	$fragments['#top_cart_basket'] = ob_get_clean();
	ob_start();
	?>
				
									<li class="orange top_cart" id="top_cart_list">
									<a  class="top_cart_a"  href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>"><i class="icons icon-basket-2"></i>
									
									<?php echo sprintf( _n( '%s Item', '%s Items', max($woocommerce->cart->cart_contents_count, 1), 'homeshop' ), number_format_i18n($woocommerce->cart->cart_contents_count) ); ?>
									

									
									</a>
                                    	
										<?php if (sizeof($woocommerce->cart->cart_contents)>0) :?>	
										<ul id="cart-dropdown" class="box-dropdown parent-arrow" id="cart_drop_down">
											<li>
                                            	
												
												
												
												
												
			<form action="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" method="post"  id="cart_form" class="cart_form">
            <div class="box-wrapper parent-border">
			<p class="cart-info-f" >
			<?php 
			if( function_exists( 'icl_t' ) ) {
			$added_title = icl_t('Homeshop', 'recently_added_item', 'Recently added item(s)');
			} else {
			$added_title = __('Recently added item(s)','homeshop');
			}
			echo $added_title;
			?>
			</p>    
				
				<table class="cart-table">
                    <?php
                    if (sizeof($woocommerce->cart->get_cart()) > 0) {
                        foreach ($woocommerce->cart->get_cart() as $cart_item_key => $values) {
                            $_product = $values['data'];
                            ?>
							<tr>
								<td class="product_image">
									<?php
									$thumbnail = apply_filters('woocommerce_in_cart_product_thumbnail', $_product->get_image(), $values, $cart_item_key);

									if (!$_product->is_visible() || (!empty($_product->variation_id) && !$_product->parent_is_visible() ))
										echo $thumbnail;
									else
										printf('<a href="%s">%s</a>', esc_url(get_permalink(apply_filters('woocommerce_in_cart_product_id', $values['product_id']))), $thumbnail);
									?>
								</td>
								
								<td class="product_desc">
									<h6><?php echo esc_html($_product->get_title()); ?></h6>
									<p><?php _e( 'Product code', 'homeshop' ) ?> <?php echo ( $sku = $_product->get_sku() ) ? $sku : __( 'n/a', 'homeshop' ); ?></p>	
								</td>
								
								<td class="product_quantity">
								<span class="quantity"><span class="light"><?php echo  $values['quantity'] ?> x</span> <?php
							    echo apply_filters('woocommerce_cart_item_subtotal', $woocommerce->cart->get_product_subtotal($_product, $values['quantity']), $values, $cart_item_key);
									?>
								</span>
									
								<?php
									echo apply_filters('woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="delete parent-color" title="%s">%s</a>', esc_url($woocommerce->cart->get_remove_url($cart_item_key)), __('Remove', 'homeshop'), __('Remove', 'homeshop')), $cart_item_key);
								?>
								
								</td>

							</tr>
						
                            <?php
                        }
                    }
                    ?>
					
                </table>
				<br class="clearfix">
			</div>	

			<div class="footer">
				<table class="checkout-table pull-right">

					<tr>
						<td class="align-right"><strong><?php _e( 'Total', 'homeshop' ) ?>:</strong></td>
						<td><strong class="parent-color"><?php echo $woocommerce->cart->get_cart_subtotal(); ?></strong></td>
					</tr>
					
	
					
				</table>
			</div>

			<div class="box-wrapper no-border">
				<a class="button pull-right parent-background" href="<?php echo esc_url($woocommerce->cart->get_checkout_url()); ?>"><?php _e( 'Checkout', 'homeshop' ) ?></a>
				<a class="button pull-right" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>"><?php _e( 'View Cart', 'homeshop' ) ?></a>
			</div>

            </form>
												

											</li>
										</ul>
										<?php endif; ?>		
										
                                    </li>
	<?php 
	$fragments['#top_cart_list'] = ob_get_clean();
		ob_start();
	?>
	<?php if(get_option('sense_show_compare') != '' && get_option('sense_show_compare') != 'hide'  && is_shop_installed() && class_exists('WC_Compare_Functions')) {  ?>	
									<li class="blue top_compare" id="compare_button">
										<a id="top_compare_basket" href="<?php echo esc_url(get_option('sense_link_compare')); ?>"><i class="icons icon-docs"></i>
										
										<?php echo sprintf( _n( '%s Item', '%s Items', max(WC_Compare_Functions::get_total_compare_list(), 1), 'homeshop' ), number_format_i18n(WC_Compare_Functions::get_total_compare_list()) ); ?>
										
										
										</a>
                                    </li>
									
	<?php }  ?>

	
	<?php
	$fragments['#compare_button'] =  ob_get_clean();
	return $fragments;
	
}
 }

 
 if ( ! function_exists( 'template_chooser' ) ) { 
	function template_chooser($template)   
	{    
	 global $wp_query;   
	 $post_type = get_query_var('post_type');   
	 if( isset($_GET['s']) && $post_type == 'product' )   
	 {
	  return locate_template('product-search.php');  //  redirect to archive-search.php
	 }   
	 return $template;   
	}
 }
add_filter('template_include', 'template_chooser');







 if ( ! function_exists( 'homeshop_filter_wp_title' ) ) { 
	function homeshop_filter_wp_title( $title ) {
		if ( is_feed() ) {
			return $title;
		}
		$sep="-";
		global $page, $paged;

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
			$title .= $sep . sprintf( __( 'Page %s', 'homeshop' ), max( $paged, $page ) );
		}

		return $title;
	}
 }
// Hook into 'wp_title'
add_filter( 'wp_title', 'homeshop_filter_wp_title' );






 if ( ! function_exists( 'homeshop_link_pages' ) ) { 
	function homeshop_link_pages() {
	/* ================ Settings ================ */
	$text_num_page = '';
	$num_pages = 10;
	$stepLink = 10; 
	$dotright_text = '…'; 
	$dotright_text2 = '…'; 
	$backtext = '<div class="previous"><i class="icons icon-left-dir"></i></div>'; 
	$nexttext = '<div class="next"><i class="icons icon-right-dir"></i></div>'; 
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
		$out.= "<div class='wp-page-break col-lg-12 col-md-12 col-sm-12'><div class='pagination'>\n";
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
							$out.= '<a href="'._wp_link_page($i).'">'.$i.'</a>';
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


if (function_exists('icl_register_string')) {
    icl_register_string('Homeshop', 'top_items', 'Items');
    icl_register_string('Homeshop', 'recently_added_item', 'Recently added item(s)');

    icl_register_string('Homeshop', 'menu_text_item', 'Menu');
    icl_register_string('Homeshop', 'navigation_text_item', 'Navigation');
	
	icl_register_string('Homeshop', 'product_text_review1', 'Now please write a (short) review....(min. 200, max. 2000 characters)');
	icl_register_string('Homeshop', 'product_text_review2', 'First: Rate the product. Please select a rating between 0 (poorest) and 5 stars (best)');
	icl_register_string('Homeshop', 'product_delete', 'Delete');
	
	icl_register_string('Homeshop', 'no_compare_list', 'You do not have any product to compare.');
	
	icl_register_string('Homeshop', 'no_wcwl_list', 'You need to be logged in to add product to wishlist.');
}




















 if ( ! function_exists( 'categories_product1' ) ) { 
function categories_product1($id) {


		$where_show = get_option( 'mgb_where_show' );

		if ( $where_show == 2 ) {
			return;
		}
		if ( is_admin() || ! $id ) {
			return;
		}

		$product_id = $id;
		
		$brands_list =  wp_get_object_terms($product_id, 'product_brand');
	
	
	    if ( is_wp_error($brands_list)) {
			return;
		}
	
		$brands_list_output = '';
		$brands_list_comma = ', ';
		$i = 0;
		$show = '';
		
		foreach ( $brands_list as $brand ) {

			$brands_list_output .= '<a href="'.get_term_link( $brand->slug, 'product_brand' ).'">'.$brand->name.'</a>';

			if($i < count($brands_list) - 1) {
				$brands_list_output .= $brands_list_comma;
			}
			
			$i++;
		}

		
		
		if( count($brands_list) > 0 ) {

			$show = '<span class="mg-brand-wrapper mg-brand-wrapper-category" style="margin-top: -5px;"> '.$brands_list_output.'</span>';
	
		}
		
		return $show;
	}
 }

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
/**
 * Add new register fields for WooCommerce registration.
 *
 * @return string Register fields HTML.
 */
  if ( ! function_exists( 'wooc_extra_register_fields' ) ) { 
function wooc_extra_register_fields() {
	?>

	<div class="row">	
		<div class="col-lg-4 col-md-4 col-sm-4">
			<p><?php _e( 'First name', 'homeshop' ); ?>*</p>
		</div>
		<div class="col-lg-8 col-md-8 col-sm-8">
			<input type="text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
		</div>	
	</div>
	
	
	<div class="row">	
		<div class="col-lg-4 col-md-4 col-sm-4">
			<p><?php _e( 'Last name', 'homeshop' ); ?>*</p>
		</div>
		<div class="col-lg-8 col-md-8 col-sm-8">
			<input type="text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
		</div>	
	</div>

	<div class="clear"></div>

	<div class="row">	
		<div class="col-lg-4 col-md-4 col-sm-4">
			<p><?php _e( 'Phone', 'homeshop' ); ?>*</p>
		</div>
		<div class="col-lg-8 col-md-8 col-sm-8">
			<input type="text" name="billing_phone" id="reg_billing_phone" value="<?php if ( ! empty( $_POST['billing_phone'] ) ) esc_attr_e( $_POST['billing_phone'] ); ?>" />
		</div>	
	</div>

	<?php
}
  }
add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' ); 
 
 
/**
 * Validate the extra register fields.
 *
 * @param  string $username          Current username.
 * @param  string $email             Current email.
 * @param  object $validation_errors WP_Error object.
 *
 * @return void
 */
   if ( ! function_exists( 'wooc_validate_extra_register_fields' ) ) { 
function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {
	if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
		$validation_errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', 'homeshop' ) );
	}

	if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
		$validation_errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required!.', 'homeshop' ) );
	}


	if ( isset( $_POST['billing_phone'] ) && empty( $_POST['billing_phone'] ) ) {
		$validation_errors->add( 'billing_phone_error', __( '<strong>Error</strong>: Phone is required!.', 'homeshop' ) );
	}
}
   }
add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 ); 
 
 
/**
 * Save the extra register fields.
 *
 * @param  int  $customer_id Current customer ID.
 *
 * @return void
 */
    if ( ! function_exists( 'wooc_save_extra_register_fields' ) ) { 
function wooc_save_extra_register_fields( $customer_id ) {
	if ( isset( $_POST['billing_first_name'] ) ) {
		// WordPress default first name field.
		update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );

		// WooCommerce billing first name.
		update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
	}

	if ( isset( $_POST['billing_last_name'] ) ) {
		// WordPress default last name field.
		update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );

		// WooCommerce billing last name.
		update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
	}

	if ( isset( $_POST['billing_phone'] ) ) {
		// WooCommerce billing phone
		update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
	}
}
	}
add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' ); 













    if ( ! function_exists( 'register_link_url' ) ) { 
function register_link_url( $url ) {
      if ( ! is_user_logged_in() ) {
        if ( get_option('users_can_register') )
            $url = '<li><a href="' . get_bloginfo( 'url' ) . "/register" . '">' . __('Register', 'homeshop') . '</a></li>';
        else
            $url = '';
    } else {
        $url = '<li><a href="' . admin_url() . '">' . __('Site Admin', 'homeshop') . '</a></li>';
    }
 
   return $url;
   }
	}
//add_filter( 'register', 'register_link_url', 10, 2 );





	

  if ( ! function_exists( 'homeshop_end_login_fail' ) ) { 
		function homeshop_end_login_fail($username){
			$referrer = $_SERVER['HTTP_REFERER'];

			if(!empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin')){
				//wp_redirect($referrer . '/register'); 
				wp_redirect(get_permalink( get_option('woocommerce_myaccount_page_id') )); 
				exit;
			}
		}
  }
//add_action('wp_login_failed', 'homeshop_end_login_fail'); 

function check_username_password( $login, $username, $password ) {
 

	if(!empty($_SERVER['HTTP_REFERER'])) {
 
 
		$referrer = $_SERVER['HTTP_REFERER'];
 
		if( !empty( $referrer ) && !strstr( $referrer,'wp-login' ) && !strstr( $referrer,'wp-admin' ) ) { 
			if( $username == "" || $password == "" ){
				wp_redirect( get_permalink( get_option('woocommerce_myaccount_page_id') ) );
				exit;
			}
		}


	}
}
//add_action( 'authenticate', 'check_username_password', 1, 3);







 function homeshop_disable_comment_url($fields) { 
     unset($fields['url']);
     return $fields;
 }
 add_filter('comment_form_default_fields','homeshop_disable_comment_url');


if (class_exists('WooCommerce')) {
WC()->query->layered_nav_product_ids =array();
}
