<?php
/* Theme Support */
function thb_theme_setup() {
	/* Text Domain */
	load_theme_textdomain('north', THB_THEME_ROOT_ABS . '/inc/languages');
	
	/* Custom Background Support */
	add_theme_support( 'custom-background', array( 'default-color' => 'ffffff' ) );
	
	/* Title Support */
	add_theme_support( 'title-tag' );
	
	/* HTML5 Galleries */
	add_theme_support( 'html5', array( 'gallery', 'caption' ) );
	
	/* Editor Styling */
	add_editor_style();
	
	/* WooCommerce Support */
	add_theme_support( 'woocommerce' );
	
	/* Required Settings */
	if(!isset($content_width)) $content_width = 1170;
	add_theme_support( 'automatic-feed-links' );
	
	/* Image Settings */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 70, 60, true );
	add_image_size('north-blog-masonry', 740, 9999, false );
	add_image_size('north-blog-post', 1170, 550, true );
	add_image_size('north-blog-gallery-masonry', 740, 780, true );
	add_image_size('north-blog-grid', 740, 540, true );
	
	/* Products per Page */
	if( $products_per_page = ot_get_option('shop_product_count')) {
		add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . $products_per_page . ';' ), 20 );
	}
	/* Catalog Mode */
	if (ot_get_option('shop_catalog_mode', 'off') == 'on') {
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	}
	/* Hide Admin bar for users */
	if (!current_user_can('administrator') && !is_admin()) {
	  	show_admin_bar(false);
	}
}
add_action( 'after_setup_theme', 'thb_theme_setup' );

/* Filter Excerpt Length */
function thb_custom_excerpt_length( $length ) {
	return 15;
}
add_filter( 'excerpt_length', 'thb_custom_excerpt_length', 999 );
function thb_excerpt_more($more) {
	return '…';
}
add_filter('excerpt_more', 'thb_excerpt_more');

/* Adds custom classes to the array of body classes. */
function thb_body_classes( $classes ) {
	$id = get_queried_object_id();
	
	$page_scroll = (get_post_meta($id, 'page_scroll', true) == 'on' ? 'page_scroll' : '');
	$revslider_arrows = ot_get_option('revslider_arrows', 'on');
	$snap = get_post_meta($id, 'snap_scroll', true) ? get_post_meta($id, 'snap_scroll', true) : 'off';
	$snap_scroll = 'snap_scroll_'.$snap;
	$header_style = 'header_style_'.ot_get_option('header_style', 'style1');
	$classes[] = $page_scroll;
	$classes[] = $revslider_arrows === 'on' ? 'thb-arrows' : false;
	$classes[] = $snap_scroll;
	$classes[] = $header_style;
	
	/* Header Color */
	$menu_color = '';
	if(class_exists('woocommerce')) {
		
		if (is_shop() || is_product_tag()) {
			$shop_menu_color = ot_get_option('shop_menu_color');
		} else if (is_product_category()) {
			$cat = get_queried_object();
			$cat_id = $cat->term_id;
			$shop_menu_color = get_term_meta( $cat_id, 'shop_menu_color_cat', true );
			
		}
	}
	
	if(is_404()) {
		$menu_color = ot_get_option('404_menu_color', 'background--dark');
	}
	if(is_page() && get_post_meta($id, 'header_override', true) === 'on') {
		$menu_color = get_post_meta($id, 'header_menu_color', true);
	}
	$classes[] = $menu_color;
	return $classes;
}
add_filter( 'body_class', 'thb_body_classes' );

/* Font Awesome Array */
function thb_getIconArray(){
	$icons = array(
		'' => '', 'fa-glass' => 'fa-glass', 'fa-music' => 'fa-music', 'fa-search' => 'fa-search', 'fa-envelope-o' => 'fa-envelope-o', 'fa-heart' => 'fa-heart', 'fa-star' => 'fa-star', 'fa-star-o' => 'fa-star-o', 'fa-user' => 'fa-user', 'fa-film' => 'fa-film', 'fa-th-large' => 'fa-th-large', 'fa-th' => 'fa-th', 'fa-th-list' => 'fa-th-list', 'fa-check' => 'fa-check', 'fa-times' => 'fa-times', 'fa-search-plus' => 'fa-search-plus', 'fa-search-minus' => 'fa-search-minus', 'fa-power-off' => 'fa-power-off', 'fa-signal' => 'fa-signal', 'fa-cog' => 'fa-cog', 'fa-trash-o' => 'fa-trash-o', 'fa-home' => 'fa-home', 'fa-file-o' => 'fa-file-o', 'fa-clock-o' => 'fa-clock-o', 'fa-road' => 'fa-road', 'fa-download' => 'fa-download', 'fa-arrow-circle-o-down' => 'fa-arrow-circle-o-down', 'fa-arrow-circle-o-up' => 'fa-arrow-circle-o-up', 'fa-inbox' => 'fa-inbox', 'fa-play-circle-o' => 'fa-play-circle-o', 'fa-repeat' => 'fa-repeat', 'fa-refresh' => 'fa-refresh', 'fa-list-alt' => 'fa-list-alt', 'fa-lock' => 'fa-lock', 'fa-flag' => 'fa-flag', 'fa-headphones' => 'fa-headphones', 'fa-volume-off' => 'fa-volume-off', 'fa-volume-down' => 'fa-volume-down', 'fa-volume-up' => 'fa-volume-up', 'fa-qrcode' => 'fa-qrcode', 'fa-barcode' => 'fa-barcode', 'fa-tag' => 'fa-tag', 'fa-tags' => 'fa-tags', 'fa-book' => 'fa-book', 'fa-bookmark' => 'fa-bookmark', 'fa-print' => 'fa-print', 'fa-camera' => 'fa-camera', 'fa-font' => 'fa-font', 'fa-bold' => 'fa-bold', 'fa-italic' => 'fa-italic', 'fa-text-height' => 'fa-text-height', 'fa-text-width' => 'fa-text-width', 'fa-align-left' => 'fa-align-left', 'fa-align-center' => 'fa-align-center', 'fa-align-right' => 'fa-align-right', 'fa-align-justify' => 'fa-align-justify', 'fa-list' => 'fa-list', 'fa-outdent' => 'fa-outdent', 'fa-indent' => 'fa-indent', 'fa-video-camera' => 'fa-video-camera', 'fa-picture-o' => 'fa-picture-o', 'fa-pencil' => 'fa-pencil', 'fa-map-marker' => 'fa-map-marker', 'fa-adjust' => 'fa-adjust', 'fa-tint' => 'fa-tint', 'fa-pencil-square-o' => 'fa-pencil-square-o', 'fa-share-square-o' => 'fa-share-square-o', 'fa-check-square-o' => 'fa-check-square-o', 'fa-arrows' => 'fa-arrows', 'fa-step-backward' => 'fa-step-backward', 'fa-fast-backward' => 'fa-fast-backward', 'fa-backward' => 'fa-backward', 'fa-play' => 'fa-play', 'fa-pause' => 'fa-pause', 'fa-stop' => 'fa-stop', 'fa-forward' => 'fa-forward', 'fa-fast-forward' => 'fa-fast-forward', 'fa-step-forward' => 'fa-step-forward', 'fa-eject' => 'fa-eject', 'fa-chevron-left' => 'fa-chevron-left', 'fa-chevron-right' => 'fa-chevron-right', 'fa-plus-circle' => 'fa-plus-circle', 'fa-minus-circle' => 'fa-minus-circle', 'fa-times-circle' => 'fa-times-circle', 'fa-check-circle' => 'fa-check-circle', 'fa-question-circle' => 'fa-question-circle', 'fa-info-circle' => 'fa-info-circle', 'fa-crosshairs' => 'fa-crosshairs', 'fa-times-circle-o' => 'fa-times-circle-o', 'fa-check-circle-o' => 'fa-check-circle-o', 'fa-ban' => 'fa-ban', 'fa-arrow-left' => 'fa-arrow-left', 'fa-arrow-right' => 'fa-arrow-right', 'fa-arrow-up' => 'fa-arrow-up', 'fa-arrow-down' => 'fa-arrow-down', 'fa-share' => 'fa-share', 'fa-expand' => 'fa-expand', 'fa-compress' => 'fa-compress', 'fa-plus' => 'fa-plus', 'fa-minus' => 'fa-minus', 'fa-asterisk' => 'fa-asterisk', 'fa-exclamation-circle' => 'fa-exclamation-circle', 'fa-gift' => 'fa-gift', 'fa-leaf' => 'fa-leaf', 'fa-fire' => 'fa-fire', 'fa-eye' => 'fa-eye', 'fa-eye-slash' => 'fa-eye-slash', 'fa-exclamation-triangle' => 'fa-exclamation-triangle', 'fa-plane' => 'fa-plane', 'fa-calendar' => 'fa-calendar', 'fa-random' => 'fa-random', 'fa-comment' => 'fa-comment', 'fa-magnet' => 'fa-magnet', 'fa-chevron-up' => 'fa-chevron-up', 'fa-chevron-down' => 'fa-chevron-down', 'fa-retweet' => 'fa-retweet', 'fa-shopping-cart' => 'fa-shopping-cart', 'fa-folder' => 'fa-folder', 'fa-folder-open' => 'fa-folder-open', 'fa-arrows-v' => 'fa-arrows-v', 'fa-arrows-h' => 'fa-arrows-h', 'fa-bar-chart' => 'fa-bar-chart', 'fa-twitter-square' => 'fa-twitter-square', 'fa-facebook-square' => 'fa-facebook-square', 'fa-camera-retro' => 'fa-camera-retro', 'fa-key' => 'fa-key', 'fa-cogs' => 'fa-cogs', 'fa-comments' => 'fa-comments', 'fa-thumbs-o-up' => 'fa-thumbs-o-up', 'fa-thumbs-o-down' => 'fa-thumbs-o-down', 'fa-star-half' => 'fa-star-half', 'fa-heart-o' => 'fa-heart-o', 'fa-sign-out' => 'fa-sign-out', 'fa-linkedin-square' => 'fa-linkedin-square', 'fa-thumb-tack' => 'fa-thumb-tack', 'fa-external-link' => 'fa-external-link', 'fa-sign-in' => 'fa-sign-in', 'fa-trophy' => 'fa-trophy', 'fa-github-square' => 'fa-github-square', 'fa-upload' => 'fa-upload', 'fa-lemon-o' => 'fa-lemon-o', 'fa-phone' => 'fa-phone', 'fa-square-o' => 'fa-square-o', 'fa-bookmark-o' => 'fa-bookmark-o', 'fa-phone-square' => 'fa-phone-square', 'fa-twitter' => 'fa-twitter', 'fa-facebook' => 'fa-facebook', 'fa-github' => 'fa-github', 'fa-unlock' => 'fa-unlock', 'fa-credit-card' => 'fa-credit-card', 'fa-rss' => 'fa-rss', 'fa-hdd-o' => 'fa-hdd-o', 'fa-bullhorn' => 'fa-bullhorn', 'fa-bell' => 'fa-bell', 'fa-certificate' => 'fa-certificate', 'fa-hand-o-right' => 'fa-hand-o-right', 'fa-hand-o-left' => 'fa-hand-o-left', 'fa-hand-o-up' => 'fa-hand-o-up', 'fa-hand-o-down' => 'fa-hand-o-down', 'fa-arrow-circle-left' => 'fa-arrow-circle-left', 'fa-arrow-circle-right' => 'fa-arrow-circle-right', 'fa-arrow-circle-up' => 'fa-arrow-circle-up', 'fa-arrow-circle-down' => 'fa-arrow-circle-down', 'fa-globe' => 'fa-globe', 'fa-wrench' => 'fa-wrench', 'fa-tasks' => 'fa-tasks', 'fa-filter' => 'fa-filter', 'fa-briefcase' => 'fa-briefcase', 'fa-arrows-alt' => 'fa-arrows-alt', 'fa-users' => 'fa-users', 'fa-link' => 'fa-link', 'fa-cloud' => 'fa-cloud', 'fa-flask' => 'fa-flask', 'fa-scissors' => 'fa-scissors', 'fa-files-o' => 'fa-files-o', 'fa-paperclip' => 'fa-paperclip', 'fa-floppy-o' => 'fa-floppy-o', 'fa-square' => 'fa-square', 'fa-bars' => 'fa-bars', 'fa-list-ul' => 'fa-list-ul', 'fa-list-ol' => 'fa-list-ol', 'fa-strikethrough' => 'fa-strikethrough', 'fa-underline' => 'fa-underline', 'fa-table' => 'fa-table', 'fa-magic' => 'fa-magic', 'fa-truck' => 'fa-truck', 'fa-pinterest' => 'fa-pinterest', 'fa-pinterest-square' => 'fa-pinterest-square', 'fa-google-plus-square' => 'fa-google-plus-square', 'fa-google-plus' => 'fa-google-plus', 'fa-money' => 'fa-money', 'fa-caret-down' => 'fa-caret-down', 'fa-caret-up' => 'fa-caret-up', 'fa-caret-left' => 'fa-caret-left', 'fa-caret-right' => 'fa-caret-right', 'fa-columns' => 'fa-columns', 'fa-sort' => 'fa-sort', 'fa-sort-desc' => 'fa-sort-desc', 'fa-sort-asc' => 'fa-sort-asc', 'fa-envelope' => 'fa-envelope', 'fa-linkedin' => 'fa-linkedin', 'fa-undo' => 'fa-undo', 'fa-gavel' => 'fa-gavel', 'fa-tachometer' => 'fa-tachometer', 'fa-comment-o' => 'fa-comment-o', 'fa-comments-o' => 'fa-comments-o', 'fa-bolt' => 'fa-bolt', 'fa-sitemap' => 'fa-sitemap', 'fa-umbrella' => 'fa-umbrella', 'fa-clipboard' => 'fa-clipboard', 'fa-lightbulb-o' => 'fa-lightbulb-o', 'fa-exchange' => 'fa-exchange', 'fa-cloud-download' => 'fa-cloud-download', 'fa-cloud-upload' => 'fa-cloud-upload', 'fa-user-md' => 'fa-user-md', 'fa-stethoscope' => 'fa-stethoscope', 'fa-suitcase' => 'fa-suitcase', 'fa-bell-o' => 'fa-bell-o', 'fa-coffee' => 'fa-coffee', 'fa-cutlery' => 'fa-cutlery', 'fa-file-text-o' => 'fa-file-text-o', 'fa-building-o' => 'fa-building-o', 'fa-hospital-o' => 'fa-hospital-o', 'fa-ambulance' => 'fa-ambulance', 'fa-medkit' => 'fa-medkit', 'fa-fighter-jet' => 'fa-fighter-jet', 'fa-beer' => 'fa-beer', 'fa-h-square' => 'fa-h-square', 'fa-plus-square' => 'fa-plus-square', 'fa-angle-double-left' => 'fa-angle-double-left', 'fa-angle-double-right' => 'fa-angle-double-right', 'fa-angle-double-up' => 'fa-angle-double-up', 'fa-angle-double-down' => 'fa-angle-double-down', 'fa-angle-left' => 'fa-angle-left', 'fa-angle-right' => 'fa-angle-right', 'fa-angle-up' => 'fa-angle-up', 'fa-angle-down' => 'fa-angle-down', 'fa-desktop' => 'fa-desktop', 'fa-laptop' => 'fa-laptop', 'fa-tablet' => 'fa-tablet', 'fa-mobile' => 'fa-mobile', 'fa-circle-o' => 'fa-circle-o', 'fa-quote-left' => 'fa-quote-left', 'fa-quote-right' => 'fa-quote-right', 'fa-spinner' => 'fa-spinner', 'fa-circle' => 'fa-circle', 'fa-reply' => 'fa-reply', 'fa-github-alt' => 'fa-github-alt', 'fa-folder-o' => 'fa-folder-o', 'fa-folder-open-o' => 'fa-folder-open-o', 'fa-smile-o' => 'fa-smile-o', 'fa-frown-o' => 'fa-frown-o', 'fa-meh-o' => 'fa-meh-o', 'fa-gamepad' => 'fa-gamepad', 'fa-keyboard-o' => 'fa-keyboard-o', 'fa-flag-o' => 'fa-flag-o', 'fa-flag-checkered' => 'fa-flag-checkered', 'fa-terminal' => 'fa-terminal', 'fa-code' => 'fa-code', 'fa-reply-all' => 'fa-reply-all', 'fa-star-half-o' => 'fa-star-half-o', 'fa-location-arrow' => 'fa-location-arrow', 'fa-crop' => 'fa-crop', 'fa-code-fork' => 'fa-code-fork', 'fa-chain-broken' => 'fa-chain-broken', 'fa-question' => 'fa-question', 'fa-info' => 'fa-info', 'fa-exclamation' => 'fa-exclamation', 'fa-superscript' => 'fa-superscript', 'fa-subscript' => 'fa-subscript', 'fa-eraser' => 'fa-eraser', 'fa-puzzle-piece' => 'fa-puzzle-piece', 'fa-microphone' => 'fa-microphone', 'fa-microphone-slash' => 'fa-microphone-slash', 'fa-shield' => 'fa-shield', 'fa-calendar-o' => 'fa-calendar-o', 'fa-fire-extinguisher' => 'fa-fire-extinguisher', 'fa-rocket' => 'fa-rocket', 'fa-maxcdn' => 'fa-maxcdn', 'fa-chevron-circle-left' => 'fa-chevron-circle-left', 'fa-chevron-circle-right' => 'fa-chevron-circle-right', 'fa-chevron-circle-up' => 'fa-chevron-circle-up', 'fa-chevron-circle-down' => 'fa-chevron-circle-down', 'fa-html5' => 'fa-html5', 'fa-css3' => 'fa-css3', 'fa-anchor' => 'fa-anchor', 'fa-unlock-alt' => 'fa-unlock-alt', 'fa-bullseye' => 'fa-bullseye', 'fa-ellipsis-h' => 'fa-ellipsis-h', 'fa-ellipsis-v' => 'fa-ellipsis-v', 'fa-rss-square' => 'fa-rss-square', 'fa-play-circle' => 'fa-play-circle', 'fa-ticket' => 'fa-ticket', 'fa-minus-square' => 'fa-minus-square', 'fa-minus-square-o' => 'fa-minus-square-o', 'fa-level-up' => 'fa-level-up', 'fa-level-down' => 'fa-level-down', 'fa-check-square' => 'fa-check-square', 'fa-pencil-square' => 'fa-pencil-square', 'fa-external-link-square' => 'fa-external-link-square', 'fa-share-square' => 'fa-share-square', 'fa-compass' => 'fa-compass', 'fa-caret-square-o-down' => 'fa-caret-square-o-down', 'fa-caret-square-o-up' => 'fa-caret-square-o-up', 'fa-caret-square-o-right' => 'fa-caret-square-o-right', 'fa-eur' => 'fa-eur', 'fa-gbp' => 'fa-gbp', 'fa-usd' => 'fa-usd', 'fa-inr' => 'fa-inr', 'fa-jpy' => 'fa-jpy', 'fa-rub' => 'fa-rub', 'fa-krw' => 'fa-krw', 'fa-btc' => 'fa-btc', 'fa-file' => 'fa-file', 'fa-file-text' => 'fa-file-text', 'fa-sort-alpha-asc' => 'fa-sort-alpha-asc', 'fa-sort-alpha-desc' => 'fa-sort-alpha-desc', 'fa-sort-amount-asc' => 'fa-sort-amount-asc', 'fa-sort-amount-desc' => 'fa-sort-amount-desc', 'fa-sort-numeric-asc' => 'fa-sort-numeric-asc', 'fa-sort-numeric-desc' => 'fa-sort-numeric-desc', 'fa-thumbs-up' => 'fa-thumbs-up', 'fa-thumbs-down' => 'fa-thumbs-down', 'fa-youtube-square' => 'fa-youtube-square', 'fa-youtube' => 'fa-youtube', 'fa-xing' => 'fa-xing', 'fa-xing-square' => 'fa-xing-square', 'fa-youtube-play' => 'fa-youtube-play', 'fa-dropbox' => 'fa-dropbox', 'fa-stack-overflow' => 'fa-stack-overflow', 'fa-instagram' => 'fa-instagram', 'fa-flickr' => 'fa-flickr', 'fa-adn' => 'fa-adn', 'fa-bitbucket' => 'fa-bitbucket', 'fa-bitbucket-square' => 'fa-bitbucket-square', 'fa-tumblr' => 'fa-tumblr', 'fa-tumblr-square' => 'fa-tumblr-square', 'fa-long-arrow-down' => 'fa-long-arrow-down', 'fa-long-arrow-up' => 'fa-long-arrow-up', 'fa-long-arrow-left' => 'fa-long-arrow-left', 'fa-long-arrow-right' => 'fa-long-arrow-right', 'fa-apple' => 'fa-apple', 'fa-windows' => 'fa-windows', 'fa-android' => 'fa-android', 'fa-linux' => 'fa-linux', 'fa-dribbble' => 'fa-dribbble', 'fa-skype' => 'fa-skype', 'fa-foursquare' => 'fa-foursquare', 'fa-trello' => 'fa-trello', 'fa-female' => 'fa-female', 'fa-male' => 'fa-male', 'fa-gratipay' => 'fa-gratipay', 'fa-sun-o' => 'fa-sun-o', 'fa-moon-o' => 'fa-moon-o', 'fa-archive' => 'fa-archive', 'fa-bug' => 'fa-bug', 'fa-vk' => 'fa-vk', 'fa-weibo' => 'fa-weibo', 'fa-renren' => 'fa-renren', 'fa-pagelines' => 'fa-pagelines', 'fa-stack-exchange' => 'fa-stack-exchange', 'fa-arrow-circle-o-right' => 'fa-arrow-circle-o-right', 'fa-arrow-circle-o-left' => 'fa-arrow-circle-o-left', 'fa-caret-square-o-left' => 'fa-caret-square-o-left', 'fa-dot-circle-o' => 'fa-dot-circle-o', 'fa-wheelchair' => 'fa-wheelchair', 'fa-vimeo-square' => 'fa-vimeo-square', 'fa-try' => 'fa-try', 'fa-plus-square-o' => 'fa-plus-square-o', 'fa-space-shuttle' => 'fa-space-shuttle', 'fa-slack' => 'fa-slack', 'fa-envelope-square' => 'fa-envelope-square', 'fa-wordpress' => 'fa-wordpress', 'fa-openid' => 'fa-openid', 'fa-university' => 'fa-university', 'fa-graduation-cap' => 'fa-graduation-cap', 'fa-yahoo' => 'fa-yahoo', 'fa-google' => 'fa-google', 'fa-reddit' => 'fa-reddit', 'fa-reddit-square' => 'fa-reddit-square', 'fa-stumbleupon-circle' => 'fa-stumbleupon-circle', 'fa-stumbleupon' => 'fa-stumbleupon', 'fa-delicious' => 'fa-delicious', 'fa-digg' => 'fa-digg', 'fa-pied-piper-pp' => 'fa-pied-piper-pp', 'fa-pied-piper-alt' => 'fa-pied-piper-alt', 'fa-drupal' => 'fa-drupal', 'fa-joomla' => 'fa-joomla', 'fa-language' => 'fa-language', 'fa-fax' => 'fa-fax', 'fa-building' => 'fa-building', 'fa-child' => 'fa-child', 'fa-paw' => 'fa-paw', 'fa-spoon' => 'fa-spoon', 'fa-cube' => 'fa-cube', 'fa-cubes' => 'fa-cubes', 'fa-behance' => 'fa-behance', 'fa-behance-square' => 'fa-behance-square', 'fa-steam' => 'fa-steam', 'fa-steam-square' => 'fa-steam-square', 'fa-recycle' => 'fa-recycle', 'fa-car' => 'fa-car', 'fa-taxi' => 'fa-taxi', 'fa-tree' => 'fa-tree', 'fa-spotify' => 'fa-spotify', 'fa-deviantart' => 'fa-deviantart', 'fa-soundcloud' => 'fa-soundcloud', 'fa-database' => 'fa-database', 'fa-file-pdf-o' => 'fa-file-pdf-o', 'fa-file-word-o' => 'fa-file-word-o', 'fa-file-excel-o' => 'fa-file-excel-o', 'fa-file-powerpoint-o' => 'fa-file-powerpoint-o', 'fa-file-image-o' => 'fa-file-image-o', 'fa-file-archive-o' => 'fa-file-archive-o', 'fa-file-audio-o' => 'fa-file-audio-o', 'fa-file-video-o' => 'fa-file-video-o', 'fa-file-code-o' => 'fa-file-code-o', 'fa-vine' => 'fa-vine', 'fa-codepen' => 'fa-codepen', 'fa-jsfiddle' => 'fa-jsfiddle', 'fa-life-ring' => 'fa-life-ring', 'fa-circle-o-notch' => 'fa-circle-o-notch', 'fa-rebel' => 'fa-rebel', 'fa-empire' => 'fa-empire', 'fa-git-square' => 'fa-git-square', 'fa-git' => 'fa-git', 'fa-hacker-news' => 'fa-hacker-news', 'fa-tencent-weibo' => 'fa-tencent-weibo', 'fa-qq' => 'fa-qq', 'fa-weixin' => 'fa-weixin', 'fa-paper-plane' => 'fa-paper-plane', 'fa-paper-plane-o' => 'fa-paper-plane-o', 'fa-history' => 'fa-history', 'fa-circle-thin' => 'fa-circle-thin', 'fa-header' => 'fa-header', 'fa-paragraph' => 'fa-paragraph', 'fa-sliders' => 'fa-sliders', 'fa-share-alt' => 'fa-share-alt', 'fa-share-alt-square' => 'fa-share-alt-square', 'fa-bomb' => 'fa-bomb', 'fa-futbol-o' => 'fa-futbol-o', 'fa-tty' => 'fa-tty', 'fa-binoculars' => 'fa-binoculars', 'fa-plug' => 'fa-plug', 'fa-slideshare' => 'fa-slideshare', 'fa-twitch' => 'fa-twitch', 'fa-yelp' => 'fa-yelp', 'fa-newspaper-o' => 'fa-newspaper-o', 'fa-wifi' => 'fa-wifi', 'fa-calculator' => 'fa-calculator', 'fa-paypal' => 'fa-paypal', 'fa-google-wallet' => 'fa-google-wallet', 'fa-cc-visa' => 'fa-cc-visa', 'fa-cc-mastercard' => 'fa-cc-mastercard', 'fa-cc-discover' => 'fa-cc-discover', 'fa-cc-amex' => 'fa-cc-amex', 'fa-cc-paypal' => 'fa-cc-paypal', 'fa-cc-stripe' => 'fa-cc-stripe', 'fa-bell-slash' => 'fa-bell-slash', 'fa-bell-slash-o' => 'fa-bell-slash-o', 'fa-trash' => 'fa-trash', 'fa-copyright' => 'fa-copyright', 'fa-at' => 'fa-at', 'fa-eyedropper' => 'fa-eyedropper', 'fa-paint-brush' => 'fa-paint-brush', 'fa-birthday-cake' => 'fa-birthday-cake', 'fa-area-chart' => 'fa-area-chart', 'fa-pie-chart' => 'fa-pie-chart', 'fa-line-chart' => 'fa-line-chart', 'fa-lastfm' => 'fa-lastfm', 'fa-lastfm-square' => 'fa-lastfm-square', 'fa-toggle-off' => 'fa-toggle-off', 'fa-toggle-on' => 'fa-toggle-on', 'fa-bicycle' => 'fa-bicycle', 'fa-bus' => 'fa-bus', 'fa-ioxhost' => 'fa-ioxhost', 'fa-angellist' => 'fa-angellist', 'fa-cc' => 'fa-cc', 'fa-ils' => 'fa-ils', 'fa-meanpath' => 'fa-meanpath', 'fa-buysellads' => 'fa-buysellads', 'fa-connectdevelop' => 'fa-connectdevelop', 'fa-dashcube' => 'fa-dashcube', 'fa-forumbee' => 'fa-forumbee', 'fa-leanpub' => 'fa-leanpub', 'fa-sellsy' => 'fa-sellsy', 'fa-shirtsinbulk' => 'fa-shirtsinbulk', 'fa-simplybuilt' => 'fa-simplybuilt', 'fa-skyatlas' => 'fa-skyatlas', 'fa-cart-plus' => 'fa-cart-plus', 'fa-cart-arrow-down' => 'fa-cart-arrow-down', 'fa-diamond' => 'fa-diamond', 'fa-ship' => 'fa-ship', 'fa-user-secret' => 'fa-user-secret', 'fa-motorcycle' => 'fa-motorcycle', 'fa-street-view' => 'fa-street-view', 'fa-heartbeat' => 'fa-heartbeat', 'fa-venus' => 'fa-venus', 'fa-mars' => 'fa-mars', 'fa-mercury' => 'fa-mercury', 'fa-transgender' => 'fa-transgender', 'fa-transgender-alt' => 'fa-transgender-alt', 'fa-venus-double' => 'fa-venus-double', 'fa-mars-double' => 'fa-mars-double', 'fa-venus-mars' => 'fa-venus-mars', 'fa-mars-stroke' => 'fa-mars-stroke', 'fa-mars-stroke-v' => 'fa-mars-stroke-v', 'fa-mars-stroke-h' => 'fa-mars-stroke-h', 'fa-neuter' => 'fa-neuter', 'fa-genderless' => 'fa-genderless', 'fa-facebook-official' => 'fa-facebook-official', 'fa-pinterest-p' => 'fa-pinterest-p', 'fa-whatsapp' => 'fa-whatsapp', 'fa-server' => 'fa-server', 'fa-user-plus' => 'fa-user-plus', 'fa-user-times' => 'fa-user-times', 'fa-bed' => 'fa-bed', 'fa-viacoin' => 'fa-viacoin', 'fa-train' => 'fa-train', 'fa-subway' => 'fa-subway', 'fa-medium' => 'fa-medium', 'fa-y-combinator' => 'fa-y-combinator', 'fa-optin-monster' => 'fa-optin-monster', 'fa-opencart' => 'fa-opencart', 'fa-expeditedssl' => 'fa-expeditedssl', 'fa-battery-full' => 'fa-battery-full', 'fa-battery-three-quarters' => 'fa-battery-three-quarters', 'fa-battery-half' => 'fa-battery-half', 'fa-battery-quarter' => 'fa-battery-quarter', 'fa-battery-empty' => 'fa-battery-empty', 'fa-mouse-pointer' => 'fa-mouse-pointer', 'fa-i-cursor' => 'fa-i-cursor', 'fa-object-group' => 'fa-object-group', 'fa-object-ungroup' => 'fa-object-ungroup', 'fa-sticky-note' => 'fa-sticky-note', 'fa-sticky-note-o' => 'fa-sticky-note-o', 'fa-cc-jcb' => 'fa-cc-jcb', 'fa-cc-diners-club' => 'fa-cc-diners-club', 'fa-clone' => 'fa-clone', 'fa-balance-scale' => 'fa-balance-scale', 'fa-hourglass-o' => 'fa-hourglass-o', 'fa-hourglass-start' => 'fa-hourglass-start', 'fa-hourglass-half' => 'fa-hourglass-half', 'fa-hourglass-end' => 'fa-hourglass-end', 'fa-hourglass' => 'fa-hourglass', 'fa-hand-rock-o' => 'fa-hand-rock-o', 'fa-hand-paper-o' => 'fa-hand-paper-o', 'fa-hand-scissors-o' => 'fa-hand-scissors-o', 'fa-hand-lizard-o' => 'fa-hand-lizard-o', 'fa-hand-spock-o' => 'fa-hand-spock-o', 'fa-hand-pointer-o' => 'fa-hand-pointer-o', 'fa-hand-peace-o' => 'fa-hand-peace-o', 'fa-trademark' => 'fa-trademark', 'fa-registered' => 'fa-registered', 'fa-creative-commons' => 'fa-creative-commons', 'fa-gg' => 'fa-gg', 'fa-gg-circle' => 'fa-gg-circle', 'fa-tripadvisor' => 'fa-tripadvisor', 'fa-odnoklassniki' => 'fa-odnoklassniki', 'fa-odnoklassniki-square' => 'fa-odnoklassniki-square', 'fa-get-pocket' => 'fa-get-pocket', 'fa-wikipedia-w' => 'fa-wikipedia-w', 'fa-safari' => 'fa-safari', 'fa-chrome' => 'fa-chrome', 'fa-firefox' => 'fa-firefox', 'fa-opera' => 'fa-opera', 'fa-internet-explorer' => 'fa-internet-explorer', 'fa-television' => 'fa-television', 'fa-contao' => 'fa-contao', 'fa-500px' => 'fa-500px', 'fa-amazon' => 'fa-amazon', 'fa-calendar-plus-o' => 'fa-calendar-plus-o', 'fa-calendar-minus-o' => 'fa-calendar-minus-o', 'fa-calendar-times-o' => 'fa-calendar-times-o', 'fa-calendar-check-o' => 'fa-calendar-check-o', 'fa-industry' => 'fa-industry', 'fa-map-pin' => 'fa-map-pin', 'fa-map-signs' => 'fa-map-signs', 'fa-map-o' => 'fa-map-o', 'fa-map' => 'fa-map', 'fa-commenting' => 'fa-commenting', 'fa-commenting-o' => 'fa-commenting-o', 'fa-houzz' => 'fa-houzz', 'fa-vimeo' => 'fa-vimeo', 'fa-black-tie' => 'fa-black-tie', 'fa-fonticons' => 'fa-fonticons', 'fa-reddit-alien' => 'fa-reddit-alien', 'fa-edge' => 'fa-edge', 'fa-credit-card-alt' => 'fa-credit-card-alt', 'fa-codiepie' => 'fa-codiepie', 'fa-modx' => 'fa-modx', 'fa-fort-awesome' => 'fa-fort-awesome', 'fa-usb' => 'fa-usb', 'fa-product-hunt' => 'fa-product-hunt', 'fa-mixcloud' => 'fa-mixcloud', 'fa-scribd' => 'fa-scribd', 'fa-pause-circle' => 'fa-pause-circle', 'fa-pause-circle-o' => 'fa-pause-circle-o', 'fa-stop-circle' => 'fa-stop-circle', 'fa-stop-circle-o' => 'fa-stop-circle-o', 'fa-shopping-bag' => 'fa-shopping-bag', 'fa-shopping-basket' => 'fa-shopping-basket', 'fa-hashtag' => 'fa-hashtag', 'fa-bluetooth' => 'fa-bluetooth', 'fa-bluetooth-b' => 'fa-bluetooth-b', 'fa-percent' => 'fa-percent', 'fa-gitlab' => 'fa-gitlab', 'fa-wpbeginner' => 'fa-wpbeginner', 'fa-wpforms' => 'fa-wpforms', 'fa-envira' => 'fa-envira', 'fa-universal-access' => 'fa-universal-access', 'fa-wheelchair-alt' => 'fa-wheelchair-alt', 'fa-question-circle-o' => 'fa-question-circle-o', 'fa-blind' => 'fa-blind', 'fa-audio-description' => 'fa-audio-description', 'fa-volume-control-phone' => 'fa-volume-control-phone', 'fa-braille' => 'fa-braille', 'fa-assistive-listening-systems' => 'fa-assistive-listening-systems', 'fa-american-sign-language-interpreting' => 'fa-american-sign-language-interpreting', 'fa-deaf' => 'fa-deaf', 'fa-glide' => 'fa-glide', 'fa-glide-g' => 'fa-glide-g', 'fa-sign-language' => 'fa-sign-language', 'fa-low-vision' => 'fa-low-vision', 'fa-viadeo' => 'fa-viadeo', 'fa-viadeo-square' => 'fa-viadeo-square', 'fa-snapchat' => 'fa-snapchat', 'fa-snapchat-ghost' => 'fa-snapchat-ghost', 'fa-snapchat-square' => 'fa-snapchat-square', 'fa-pied-piper' => 'fa-pied-piper', 'fa-first-order' => 'fa-first-order', 'fa-yoast' => 'fa-yoast', 'fa-themeisle' => 'fa-themeisle', 'fa-google-plus-official' => 'fa-google-plus-official', 'fa-font-awesome' => 'fa-font-awesome'
	);
  return $icons;
}

/* Thb Header Search */
function thb_quick_search() {
 
	
 ?>
	<a href="#searchpopup" rel="inline" data-class="quick-search" id="quick_search"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" width="18" height="18" viewBox="0 0 18 18" enable-background="new 0 0 17.99 18.004" xml:space="preserve"><path d="M17.7 16.5l-4.9-4.8c1-1.2 1.6-2.8 1.6-4.5 0-3.9-3.2-7.2-7.2-7.2C3.2 0 0 3.2 0 7.2c0 3.9 3.2 7.2 7.2 7.2 1.6 0 3.1-0.5 4.3-1.4l4.9 4.8c0.2 0.2 0.4 0.3 0.6 0.3 0.2 0 0.5-0.1 0.6-0.3C18.1 17.4 18.1 16.8 17.7 16.5zM1.8 7.2c0-3 2.4-5.4 5.4-5.4 3 0 5.4 2.4 5.4 5.4 0 3-2.4 5.4-5.4 5.4C4.2 12.5 1.8 10.1 1.8 7.2z"/></svg></a>
	
	<?php
		function thb_add_searchform() { 
			$search_results = ot_get_option('search_results');
		?>
	<aside id="searchpopup" class="mfp-hide">
		<div class="row">
			<div class="small-12 columns">
				<?php 
					if($search_results =='products' && class_exists( 'WooCommerce' ) ) {
						if ( !defined( 'YITH_WCAS' ) ) {
							get_product_search_form(); 
						} else {
							echo do_shortcode('[yith_woocommerce_ajax_search]');
						}
					} else { 
						get_search_form(); 
					} 
				?>
			</div>
		</div>
	</aside>
	<?php
	}
	add_action( 'wp_footer', 'thb_add_searchform', 100 );
}
add_action( 'thb_quick_search', 'thb_quick_search',3 );

/* Thb Newsletter Popup */
function thb_newsletter() {
	if(!is_admin() && ($popup = ot_get_option('newsletter') == 'on')) {
		$cookie = isset($_COOKIE['newsletter_popup']) ? $_COOKIE['newsletter_popup'] : false;
		if (!$cookie) {
			$newsletter_content = ot_get_option('newsletter_content');
	 	?>
		<aside id="newsletter-popup" rel="inline-auto" class="mfp-hide theme-popup" data-class="newsletter-popup">
			<?php if ($newsletter_content) { echo do_shortcode($newsletter_content); } else { ?>
			<h4><?php _e('Subscribe to our', 'north'); ?></h4>
			<h2><?php _e('Newsletter', 'north'); ?></h2>
			<p><?php _e('Get timely updates from your favorite products', 'north'); ?></p>
			<?php } ?>
			<form id="newsletter-form" action="#" method="post" class="row" data-target="<?php echo THB_THEME_ROOT; ?>/inc/subscribe_save.php">   
				<div class="small-12 columns"><label>E-Mail</label><input type="text" name="email" id="widget_subscribe" class="full"></div>
				<div class="small-12 columns tex-center"><input type="submit" name="submit" class="btn" value="<?php _e("Submit",'north'); ?>" /></div>
				<div class="result"></div>
			</form>
		</aside>
		<?php
		}
	}
}
add_action( 'thb_newsletter', 'thb_newsletter',3 );

function thb_newsletter_cookie() {
	$popup_interval = ot_get_option('newsletter-interval', 1);
	$time = '';
	switch ($popup_interval) {
		case '0':
			$time = 0;
			break;
		case '1':
			$time = DAY_IN_SECONDS;
			break;
		case '2':
			$time = DAY_IN_SECONDS * 2;
			break;
		case '3':
			$time = DAY_IN_SECONDS * 3;
			break;
		case '7':
			$time = WEEK_IN_SECONDS;
			break;
		case '14':
			$time = WEEK_IN_SECONDS * 2;
			break;
		case '21':
			$time = WEEK_IN_SECONDS * 3;
			break;
		case '30':
			$time = DAY_IN_SECONDS * 30;
			break;
	}
	if ($time) {
		if (isset($_COOKIE['newsletter_popup'])) {
			return;
		} else {
			setcookie('newsletter_popup', '1', time() + $time, COOKIEPATH, COOKIE_DOMAIN);
		} 
	} else {
		setcookie('newsletter_popup', '', time() - 3600, COOKIEPATH, COOKIE_DOMAIN );	
	}
}
add_action( 'init', 'thb_newsletter_cookie');

/* THB Social Icons */
function thb_social() {
 ?>
	<?php if (ot_get_option('fb_link')) { ?>
	<a href="<?php echo ot_get_option('fb_link'); ?>" target="_blank" class="facebook icon-1x"><i class="fa fa-facebook"></i></a>
	<?php } ?>
	<?php if (ot_get_option('pinterest_link')) { ?>
	<a href="<?php echo ot_get_option('pinterest_link'); ?>" target="_blank" class="pinterest icon-1x"><i class="fa fa-pinterest"></i></a>
	<?php } ?>
	<?php if (ot_get_option('twitter_link')) { ?>
	<a href="<?php echo ot_get_option('twitter_link'); ?>" target="_blank" class="twitter icon-1x"><i class="fa fa-twitter"></i></a>
	<?php } ?>
	<?php if (ot_get_option('linkedin_link')) { ?>
	<a href="<?php echo ot_get_option('linkedin_link'); ?>" target="_blank" class="linkedin icon-1x"><i class="fa fa-linkedin"></i></a>
	<?php } ?>
	<?php if (ot_get_option('instragram_link')) { ?>
	<a href="<?php echo ot_get_option('instragram_link'); ?>" target="_blank" class="instagram icon-1x"><i class="fa fa-instagram"></i></a>
	<?php } ?>
	<?php if (ot_get_option('yt_link')) { ?>
	<a href="<?php echo ot_get_option('yt_link'); ?>" target="_blank" class="youtube icon-1x"><i class="fa fa-youtube"></i></a>
	<?php } ?>
	<?php if (ot_get_option('xing_link')) { ?>
	<a href="<?php echo ot_get_option('xing_link'); ?>" target="_blank" class="xing icon-1x"><i class="fa fa-xing"></i></a>
	<?php } ?>
	<?php if (ot_get_option('tumblr_link')) { ?>
	<a href="<?php echo ot_get_option('tumblr_link'); ?>" target="_blank" class="tumblr icon-1x"><i class="fa fa-tumblr"></i></a>
	<?php } ?>
	<?php if (ot_get_option('googleplus_link')) { ?>
	<a href="<?php echo ot_get_option('googleplus_link'); ?>" target="_blank" class="google-plus icon-1x"><i class="fa fa-google-plus"></i></a>
	<?php } ?>
	<?php if (ot_get_option('vk_link')) { ?>
	<a href="<?php echo ot_get_option('vk_link'); ?>" target="_blank" class="vk icon-1x"><i class="fa fa-vk"></i></a>
	<?php } ?>
<?php
}
add_action( 'thb_social', 'thb_social',3 );


/* Payment Icons */
function thb_payment() {
?>
	<?php if (ot_get_option('payment_visa') != 'off') { ?>
		<figure class="paymenttypes visa"></figure>
	<?php } ?>
	<?php if (ot_get_option('payment_mc') != 'off') { ?>
		<figure class="paymenttypes mc"></figure>
	<?php } ?>
	<?php if (ot_get_option('payment_pp') != 'off') { ?>
		<figure class="paymenttypes paypal"></figure>
	<?php } ?>
	<?php if (ot_get_option('payment_discover') != 'off') { ?>
		<figure class="paymenttypes discover"></figure>
	<?php } ?>
	<?php if (ot_get_option('payment_amazon') != 'off') { ?>
		<figure class="paymenttypes amazon"></figure>
	<?php } ?>
	<?php if (ot_get_option('payment_stripe') != 'off') { ?>
		<figure class="paymenttypes stripe"></figure>
	<?php } ?>
	<?php if (ot_get_option('payment_amex') != 'off') { ?>
		<figure class="paymenttypes amex"></figure>
	<?php } ?>
	<?php if (ot_get_option('payment_diners') != 'off') { ?>
		<figure class="paymenttypes diners"></figure>
	<?php } ?>
	<?php if (ot_get_option('payment_wallet') != 'off') { ?>
		<figure class="paymenttypes wallet"></figure>
	<?php } ?>
<?php
}
add_action( 'thb_payment', 'thb_payment',3 );

/* Swiper Navigation */
function thb_arrow_nav() {
	?>
	<div class="thb-cursor-area left">
		<svg version="1.1" class="thb-arrow arrow-left" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="50px" height="40px" viewBox="0 0 50 40" enable-background="new 0 0 50 40" xml:space="preserve">
		<path fill-rule="evenodd" clip-rule="evenodd" d="M0,0v40h50V0H0z M48,38H2V2h46V38z"/>
		<path d="M15.313,19.204c-0.021,0.021-0.041,0.044-0.059,0.066c-0.01,0.012-0.019,0.024-0.028,0.037
			c-0.004,0.006-0.008,0.012-0.014,0.019c-0.131,0.183-0.21,0.408-0.21,0.653c0,0.245,0.079,0.47,0.21,0.653
			c0.006,0.008,0.012,0.016,0.018,0.024c0.008,0.01,0.015,0.02,0.023,0.03c0.018,0.023,0.039,0.046,0.061,0.07l3.796,3.913
			c0.417,0.429,1.092,0.429,1.508,0c0.417-0.43,0.417-1.125,0-1.555l-1.976-2.037h15.289c0.59,0,1.066-0.492,1.066-1.099
			c0-0.607-0.477-1.099-1.066-1.099H18.643l1.976-2.037c0.417-0.43,0.417-1.125,0-1.555c-0.416-0.43-1.091-0.43-1.508,0l-3.795,3.912
			C15.314,19.202,15.314,19.203,15.313,19.204z"/>
		</svg>
		
	</div>
	<div class="thb-cursor-area right">
		<svg version="1.1" class="thb-arrow arrow-right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="50px" height="40px" viewBox="0 0 50 40" enable-background="new 0 0 50 40" xml:space="preserve">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M0,0v40h50V0H0z M2,2h46v36H2V2z"/>
			<path d="M34.686,19.201L30.89,15.29c-0.417-0.43-1.092-0.43-1.508,0c-0.417,0.429-0.417,1.125,0,1.555l1.976,2.037H16.068
				c-0.59,0-1.066,0.492-1.066,1.099c0,0.606,0.477,1.099,1.066,1.099h15.289l-1.977,2.037c-0.416,0.43-0.416,1.125,0,1.555
				c0.417,0.429,1.092,0.429,1.509,0l3.796-3.913c0.022-0.023,0.043-0.047,0.061-0.07c0.01-0.01,0.016-0.021,0.023-0.03
				c0.007-0.008,0.013-0.017,0.019-0.024c0.132-0.183,0.21-0.408,0.21-0.653c0-0.246-0.078-0.471-0.21-0.653
				c-0.005-0.007-0.009-0.013-0.014-0.019c-0.01-0.012-0.019-0.025-0.028-0.037c-0.018-0.022-0.038-0.045-0.059-0.066
				C34.686,19.203,34.686,19.202,34.686,19.201z"/>
		</svg>
	</div>
	<?php
}
add_action( 'thb_arrow_nav', 'thb_arrow_nav' );

/* Post Categories Array */
function thb_blogCategories(){
	$blog_categories = get_categories();
	$out = array();
	foreach($blog_categories as $category) {
		$out[$category->name] = $category->cat_ID;
	}
	return $out;
}

/* Product Categories Array */
function thb_productCategories(){
	if(class_exists('woocommerce')) {
		
		$args = array(
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => '0'
		);
		
		$product_categories = get_terms( 'product_cat', $args );
		$out = array();
		if ($product_categories) {
			foreach($product_categories as $product_category) {
				$out[$product_category->name] = $product_category->slug;
			}
		}
		return $out;
	}
	
}
/* Out of Stock Check */
function thb_out_of_stock() {
  global $post;
  $id = $post->ID;
  $status = get_post_meta($id, '_stock_status',true);
  
  if ($status == 'outofstock') {
  	return true;
  } else {
  	return false;
  }
}
/* Social Sharing */
function thb_social_article_detail($id = false, $class = false, $boxed = false) {
	$id = $id ? $id : get_the_ID();
	$permalink = get_permalink($id);
	$title = the_title_attribute(array('echo' => 0, 'post' => $id) );
	$image_id = get_post_thumbnail_id($id);
	$image = wp_get_attachment_image_src($image_id,'full');
	$twitter_user = ot_get_option('twitter_bar_username', 'anteksiler');
	$sharing_type = ot_get_option('sharing_buttons') ? ot_get_option('sharing_buttons') : array();
	$sharing_buttons = ot_get_option('sharing_buttons_content') ? ot_get_option('sharing_buttons_content') : array(); 
	if (is_singular('post')) {
		$type = 'blog';
	} else if (is_singular('product')) {
		$type = 'products';
	} else {
		$type = 'blog';	  
	}
	$boxed_class = $boxed ? 'boxed-icon ' : '';
 ?>
 	<?php if (in_array($type, (!empty($sharing_buttons) ? $sharing_buttons : array()))) { ?>
	<aside id="product_share" class="share-article hide-on-print <?php echo esc_attr($class); ?>">
		<?php if (in_array('facebook',$sharing_type)) { ?>
		<a href="<?php echo 'http://www.facebook.com/sharer.php?u=' . urlencode( esc_url( $permalink ) ).''; ?>" class="facebook <?php echo esc_attr($boxed_class); ?>social"><i class="fa fa-facebook"></i></a>
		<?php } ?>
		<?php if (in_array('twitter',$sharing_type)) { ?>
		<a href="<?php echo 'https://twitter.com/intent/tweet?text=' . htmlspecialchars(urlencode(html_entity_decode($title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . '&url=' . urlencode( esc_url( $permalink ) ) . '&via=' . urlencode( $twitter_user ? $twitter_user : get_bloginfo( 'name' ) ) . ''; ?>" class="twitter <?php echo esc_attr($boxed_class); ?>social"><i class="fa fa-twitter"></i></a>
		<?php } ?>
		<?php if (in_array('google-plus',$sharing_type)) { ?>
		<a href="<?php echo 'http://plus.google.com/share?url=' . esc_url( $permalink ) . ''; ?>" class="google-plus social"><i class="fa fa-google-plus"></i></a>
		<?php } ?>
		<?php if (in_array('pinterest',$sharing_type)) { ?>
		<a href="<?php echo 'http://pinterest.com/pin/create/link/?url=' . esc_url( $permalink ) . '&amp;media=' . ( ! empty( $image[0] ) ? $image[0] : '' ) . ''; ?>" class="pinterest <?php echo esc_attr($boxed_class); ?>social" nopin="nopin" data-pin-no-hover="true"><i class="fa fa-pinterest"></i></a>
		<?php } ?>
	</aside>
	<?php } ?>
<?php
}
add_action( 'thb_social_article_detail', 'thb_social_article_detail', 3, 3 );
add_action( 'woocommerce_share', 'thb_social_article_detail', 3, 3 );

/* Human time */
function thb_human_time_diff_enhanced( $duration = 60 ) {

	$post_time = get_the_time('U');
	$human_time = '';

	$time_now = date('U');

	// use human time if less that $duration days ago (60 days by default)
	// 60 seconds * 60 minutes * 24 hours * $duration days
	if ( $post_time > $time_now - ( 60 * 60 * 24 * $duration ) ) {
		$human_time = sprintf( __( '%s ago', 'north'), human_time_diff( $post_time, current_time( 'timestamp' ) ) );
	} else {
		$human_time = get_the_date();
	}

	return $human_time;

}
/* Encoding */
function thb_encode( $value ) {

  $func = 'base64' . '_encode';
  return $func( $value );
  
}
function thb_decode( $value ) {

  $func = 'base64' . '_decode';
  return $func( $value );
  
}
/* RevSlider Activation Nag */
add_action('plugins_loaded', function(){
	remove_action('admin_notices', array('RevSliderAdmin', 'add_plugins_page_notices'));
} );

/* DNS Prefetch */
function thb_dns_prefetch() {
	echo '<meta http-equiv="x-dns-prefetch-control" content="on">
	<link rel="dns-prefetch" href="//fonts.googleapis.com" />
	<link rel="dns-prefetch" href="//fonts.gstatic.com" />
	<link rel="dns-prefetch" href="//0.gravatar.com/" />
	<link rel="dns-prefetch" href="//2.gravatar.com/" />
	<link rel="dns-prefetch" href="//1.gravatar.com/" />';
}
add_action('wp_head', 'thb_dns_prefetch', 0);

/*--------------------------------------------------------------------*/                							
/*  ADD DASHBOARD LINK			                							
/*--------------------------------------------------------------------*/
function admin_menu_new_items() {
    global $submenu;
    $submenu['index.php'][500] = array( 'Fuelthemes.net', 'manage_options' , 'http://fuelthemes.net/?ref=wp_sidebar' ); 
}
add_action( 'admin_menu' , 'admin_menu_new_items' );


/*--------------------------------------------------------------------*/         							
/*  FOOTER TYPE EDIT									 					
/*--------------------------------------------------------------------*/
function thb_footer_admin() {  
  echo sprintf(
  	__( 'Thank you for choosing %1$sFuel Themes%2$s', 'north' ),
  	'<a href="http://fuelthemes.net/?ref=wp_footer" target="blank">',
  	'</a>'
  );
}
add_filter('admin_footer_text', 'thb_footer_admin'); 