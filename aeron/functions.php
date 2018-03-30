<?php
define('THEME_NAME', 'Aeron');
define('THEME_TRANSLATE_DOMAIN', 'ABdev_aeron');
define('THEME_VERSION', '3.2.0');
define('TEMPPATH', get_template_directory_uri());
define('IMAGES', TEMPPATH . "/images");
define('TEMPDIR', get_template_directory());


/********* theme options - customizer ***********/
require_once( TEMPDIR. '/inc/customizer/customizer.php' );

/********* Timeline Ajax ***********/
include_once( TEMPDIR. '/inc/timeline_ajax.php' );

/********* After Setup Theme ***********/
add_action('after_setup_theme', 'ABdev_aeron_theme_setup');

if ( ! function_exists( 'ABdev_aeron_theme_setup' ) ){
	function ABdev_aeron_theme_setup(){

    	add_theme_support( 'the-creator-vpb' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );

		require_once( TEMPDIR. '/inc/activate_plugins.php' );

		if( !isset($content_width) ){
			$content_width = 1170;
		}

		load_theme_textdomain('ABdev_aeron', TEMPDIR . '/languages');

		/********* Register sidebars ***********/
		require_once( TEMPDIR. '/inc/sidebars.php' );

		/*****Widgets******/
		add_filter('widget_text', 'do_shortcode');
		require_once( TEMPDIR. '/inc/widgets/contact-info.php' );
		require_once( TEMPDIR. '/inc/widgets/flickr.php' );

		/*****Breadcrumbs******/
		require_once( TEMPDIR. '/inc/breadcrumbs.php' );

		/********* Additional fields in page and post editor ***********/
		require_once( TEMPDIR. '/inc/admin/page_additional_fields.php' );
		require_once( TEMPDIR. '/inc/admin/post_additional_fields.php' );

		/********* Additional fields in categories ***********/
		require_once( TEMPDIR. '/inc/admin/categories_additional_fields.php' );

		add_action( 'wp_enqueue_scripts', 'ABdev_aeron_scripts' );
		add_action( 'admin_enqueue_scripts', 'ABdev_aeron_backend_scripts' );
		add_action( 'init', 'ABdev_aeron_register_my_menus' );
		add_filter( 'the_content_more_link', 'ABdev_aeron_remove_more_link_scroll' );

		require_once 'inc/menu_walker.php';
		if ( ! function_exists( 'ABdev_aeron_register_my_menus' ) ){
			function ABdev_aeron_register_my_menus(){
				register_nav_menus(array(
					'header-menu'  => esc_html__('Header Menu', 'ABdev_aeron'),
					'topbar-menu'  => esc_html__('Top Bar Menu', 'ABdev_aeron'),
				));
			}
		}

		/***** Set Revolution Slider as Theme ******/
		if( function_exists( 'set_revslider_as_theme' )){
			add_action( 'init', 'ABdev_aeron_set_revslider_as_theme' );
		}
	}
}

/********* Creator Elements ***********/
if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
	require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}

if( in_array('the-creator-vpb/the-creator-vpb.php', get_option('active_plugins')) || is_plugin_active_for_network('the-creator-vpb/the-creator-vpb.php') ){
	add_action( 'init', 'tcvpb_elements');
}

function tcvpb_elements() {
	global $tcvpb_elements;
	$files = scandir(get_template_directory() . '/elements');

	foreach($files as $file) {
		if(is_file(get_template_directory() . '/elements/'.$file)){
	  		include_once (get_template_directory() . '/elements/'.$file);
		}
	}
}

/********* Menu  ***********/

if ( ! function_exists( 'ABdev_aeron_scripts' ) ){
	function ABdev_aeron_scripts() {

		$icons_deps = '';
		wp_enqueue_style('font_css','//fonts.googleapis.com/css?family=Ubuntu:300,400,500,700');
		wp_enqueue_style('ABdev_core_icons', TEMPPATH.'/css/core-icons/core_style.css', $icons_deps, THEME_VERSION);
		wp_enqueue_style('scripts_css', TEMPPATH.'/css/scripts.css', array(), THEME_VERSION);

		/********* The Creator CSS  ***********/
		if( in_array('the-creator-vpb/the-creator-vpb.php', get_option('active_plugins')) ){
			wp_enqueue_style('tcvpb_css', TEMPPATH.'/css/the-creator.css', array(), THEME_VERSION);
		}

		wp_enqueue_style('main_css', get_stylesheet_uri(), array('font_css','ABdev_core_icons', 'scripts_css', 'wp-mediaelement'), THEME_VERSION);

		$custom_css = '';
		include( TEMPDIR. '/inc/dynamic_css.php' ); //styles from options - appends styles to $custom_css variable

		if(!get_theme_mod('disable_responsiveness', false)){
			wp_enqueue_style('responsive_css', TEMPPATH.'/css/responsive.css', array('main_css'));
		}

		wp_add_inline_style('main_css', $custom_css);


		/********* The Creator JS  ***********/
		if( in_array('the-creator-vpb/the-creator-vpb.php', get_option('active_plugins')) ){
			wp_enqueue_script( 'tcvpb_init', TEMPPATH.'/js/init.js', array( 'jquery' ), '', true );
			wp_enqueue_script( 'tcvpb_charts', TEMPPATH.'/js/chart.js', array( 'jquery' ), '', true );

			$options = get_option( 'tcvpb_settings' );
			$tcvpb_tipsy_opacity = (isset($options['tcvpb_tipsy_opacity'])) ? $options['tcvpb_tipsy_opacity'] : '0.8';
			$tcvpb_custom_map_style = (isset($options['tcvpb_custom_map_style'])) ? $options['tcvpb_custom_map_style'] : '';
			wp_localize_script( 'aeron_custom', 'tcvpb_options', array(
				'tcvpb_tipsy_opacity' => $tcvpb_tipsy_opacity,
				'tcvpb_custom_map_style' => preg_replace('!\s+!', ' ', str_replace(array("\n","\r","\t"), '', $tcvpb_custom_map_style)),
			));
		}

		$google_maps_api_key = get_theme_mod('google_maps_api_key', '');
		$google_maps_api_key_out = '';
		if(isset($google_maps_api_key) && $google_maps_api_key != ''){
			$google_maps_api_key_out = '?key='.$google_maps_api_key;
		}
		wp_enqueue_script( 'google_maps_api', '//maps.googleapis.com/maps/api/js'.esc_attr($google_maps_api_key_out).'','','', true);
		wp_enqueue_script( 'scripts', TEMPPATH.'/js/scripts.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'aeron_custom', TEMPPATH.'/js/custom.js', array( 'scripts', 'wp-mediaelement', 'jquery-ui-accordion', 'jquery-effects-slide' ), THEME_VERSION, true );
		wp_localize_script( 'aeron_custom', 'abdev_timeline_posts', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'noposts' => esc_html__('No older posts found', 'ABdev_aeron')
		));

	}
}

/********* Backend Scripts  ***********/
if ( ! function_exists( 'ABdev_aeron_backend_scripts' ) ){
	function ABdev_aeron_backend_scripts() {
		wp_enqueue_style( 'ABdev_admin_css', TEMPPATH.'/css/admin.css', array(), THEME_VERSION );

		if ( is_singular() ){
			wp_enqueue_script( 'comment-reply' );
		}

	}
}

/********* Set Revolution Slider as Theme ***********/
if (!function_exists('ABdev_aeron_set_revslider_as_theme')) {
	function ABdev_aeron_set_revslider_as_theme() {
		set_revslider_as_theme();
		remove_action('admin_notices', array('RevSliderAdmin', 'add_plugins_page_notices'));
	}
}


/********* Sanitization functions ***********/
if (!function_exists('ABdev_aeron_allowed_tags')) {
	function ABdev_aeron_allowed_tags(){
		return array(
			'a' => array(
		        'href' => array(),
		        'title' => array()
		    ),
		    'br' => array(),
		    'em' => array(),
		    'p' => array(),
		    'strong' => array(),
		    'i' => array(
		    	'class' => array()
		    ),
		    'cite' => array(
		    	'title' => array()
		    ),
		);

	}
}

if(!function_exists('ABdev_aeron_text_sanitization')){
	function ABdev_aeron_text_sanitization($input){
		return wp_kses_post( force_balance_tags($input) );
	}
}

if(!function_exists('ABdev_aeron_checkbox_sanitization')){
	function ABdev_aeron_checkbox_sanitization($input){
		if ( $input == 1 ) {
	        return 1;
	    } else {
	        return '';
	    }
	}
}

if(!function_exists('ABdev_aeron_sanitize_integer')){
	function ABdev_aeron_sanitize_integer($input){
		if( is_numeric( $input ) ) {
	        return intval( $input );
	    }
	}
}

if ( ! function_exists( 'ABdev_aeron_remove_more_link_scroll' ) ){
	function ABdev_aeron_remove_more_link_scroll( $link ) {
		$link = preg_replace( '|#more-[0-9]+|', '', $link );
		return $link;
	}
}

/********* Search functions ***********/
if ( ! function_exists( 'ABdev_aeron_search_content_highlight' ) ){
	function ABdev_aeron_search_content_highlight() {
		$content = ABdev_aeron_search_res_excerpt(strip_tags(do_shortcode(get_the_content())),get_search_query());
		$keys = implode('|', explode(' ', get_search_query()));
		$content = preg_replace('/(' . $keys .')/iu', '<span class="search-highlight">\0</span>', $content);
		echo $content;
	}
}

if ( ! function_exists( 'ABdev_aeron_search_title_highlight' ) ){
	function ABdev_aeron_search_title_highlight() {
		$title = get_the_title();
		$keys = implode('|', explode(' ', get_search_query()));
		$title = preg_replace('/(' . $keys .')/iu', '<span class="search-highlight">\0</span>', $title);
		echo $title;
	}
}

if ( ! function_exists( 'ABdev_aeron_search_res_excerpt' ) ){
	function ABdev_aeron_search_res_excerpt($text, $phrase, $radius = 200, $ending = "...") {
		$phraseLen = strlen($phrase);
		if ($radius < $phraseLen) {
			$radius = $phraseLen;
		 }
		$phrases = explode (' ',$phrase);
		foreach ($phrases as $phrase) {
			$pos = strpos(strtolower($text), strtolower($phrase));
			if ($pos > -1) {
				break;
			}
		}
		$startPos = 0;
		if ($pos > $radius) {
			$startPos = $pos - $radius;
		}
		$textLen = strlen($text);
		$endPos = $pos + $phraseLen + $radius;
		if ($endPos >= $textLen) {
			$endPos = $textLen;
		}
		$excerpt = substr($text, $startPos, $endPos - $startPos);
		if ($startPos != 0) {
			$excerpt = substr_replace($excerpt, $ending, 0, $phraseLen);
		}
		if ($endPos != $textLen) {
			$excerpt = substr_replace($excerpt, $ending, -$phraseLen);
		}
		return $excerpt;
	}
}

if ( ! function_exists( 'ABdev_aeron_name_to_class' ) ){
	function ABdev_aeron_name_to_class($name){
		$class = str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',), '',$name);
		return $class;
	}
}

/********* Customizer functions ***********/
if ( ! function_exists( 'get_theme_mod_not_empty' ) ){
	function get_theme_mod_not_empty($option,$default){
		$return = get_theme_mod($option, $default);
		if($return==''){
			$return = $default;
		}
		return $return;
	}
}


// retrieves the attachment ID from the file URL
if (!function_exists('ABdev_aeron_get_image_id')){
	function ABdev_aeron_get_image_id($image_url) {
		global $wpdb;
		$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
        return $attachment[0];
	}
}

// Single Event Page Hook for Links
function ABdev_aeron_single_event_links() {

	// don't show on password protected posts
	if ( is_single() && post_password_required() ) {
		return;
	}
	echo '<div class="tribe-events-cal-links">';
	echo '<a class="tribe-events-gcal tribe-events-button" href="' . Tribe__Events__Main::instance()->esc_gcal_url( tribe_get_gcal_link() ) . '" title="' . esc_attr__( 'Add to Google Calendar', 'the-events-calendar' ) . '">' . esc_html__( 'Google Calendar', 'the-events-calendar' ) . '<i class="gm-redo"></i></a>';
	echo '<a class="tribe-events-ical tribe-events-button" href="' . esc_url( tribe_get_single_ical_link() ) . '" title="' . esc_attr__( 'Download .ics file', 'the-events-calendar' ) . '" >' . esc_html__( 'iCal Export', 'the-events-calendar' ) . '<i class="gm-redo"></i></a>';
	echo '</div><!-- .tribe-events-cal-links -->';
}

remove_action('tribe_events_single_event_after_the_content', array('Tribe__Events__iCal', 'single_event_links'));
add_action('tribe_events_single_event_after_the_content', 'ABdev_aeron_single_event_links');