<?php

if (in_array('js_composer/js_composer.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	add_action( 'template_redirect', 'init_visual_composer' );
}

if (function_exists('icl_object_id')) {
	if (!isset($_GET['page'])) {
		if (!get_option('redux_wpml')) {
			$reduxMain = get_option('redux');
			$reduxMainTrans = get_option('redux-transients');

			$langs = icl_get_languages('skip_missing=0&orderby=KEY&order=DIR&link_empty_to=str');

			global $sitepress;
			$defaultLang = $sitepress->get_default_language();

			if (count($langs) > 1) {
				update_option('redux_wpml', '1');
				foreach ($langs as $language) {
			        	$optionName = 'redux_'.$language['code'];
			        	$optionNameTrans = 'redux_'.$language['code'].'-transients';

			        	update_option($optionName, $reduxMain);
			        	update_option($optionNameTrans, $reduxMainTrans);
		        }
			}
	        
		}
	}
}


function getTemplateName() {
	$template = get_post_meta(get_the_id(), '_wp_page_template', true);
	return $template;
}

function init_visual_composer() {
	global $post;

	if (is_object($post)) {
		if (isset($post->post_content)) {
			$post->post_content .= '[vc_row el_class="hidden"][vc_column width="1/1"][/vc_column][/vc_row]';
		}
	}
}

add_filter('wp_insert_post_data', 'my_add_ul_class_on_insert');
function my_add_ul_class_on_insert( $postarr ) {
    $postarr['post_content'] = str_replace('<ul>', '<ul class="list">', $postarr['post_content'] );
    $postarr['post_content'] = str_replace('<ol>', '<ol class="list">', $postarr['post_content'] );
    return $postarr;
}

function berg_shortcodes(){
	include_once THEME_INCLUDES . '/shortcodes_lib/shortcodes.php';
}


function berg_getIntro() {
	
	if(is_search() || is_archive() && !berg_is_woocommerce_page())
		return false;

	$page_meta = get_post_meta(berg_getPageId());
	
	if(isset($page_meta['_wp_page_template'])) {
		if ($page_meta['_wp_page_template'][0] != 'restaurant.php' && $page_meta['_wp_page_template'][0] != 'homepage.php' && $page_meta['_wp_page_template'][0] != 'homepage2.php' && $page_meta['_wp_page_template'][0] != 'team.php' && $page_meta['_wp_page_template'][0] != 'contact2.php') {
			$section_intro =  isset($page_meta['section_intro'][0]) ? $page_meta['section_intro'][0] : 'default';
			if($section_intro != 'default') {
				if($section_intro == 'section_intro_2') {
					return 'fullscreen';
				} else if($section_intro == 'section_intro_3') {
					return 'halfscreen';
				} else if($section_intro == 'section_intro_4') {
					return 'custom';
				}
			} else {
				if(YSettings::g('berg_intro_type') == 2) {
					return 'fullscreen';
				} else if(YSettings::g('berg_intro_type') == 3) {
					return 'halfscreen';
				} else if(YSettings::g('berg_intro_type') == 4) {
					return 'custom';
				}
			}			
		} 
	}
	
	return false;
}

function berg_getPageId() {
	$id = get_the_id();
	if(berg_is_woocommerce_page()) {
		if(is_shop()) {
			$id = get_option( 'woocommerce_shop_page_id' );
		}
	}
	return $id; 
}
function berg_getFooter() {
	$page_meta = get_post_meta(berg_getPageId());
	if(isset($page_meta['section_footer'][0])) {
		if ($page_meta['_wp_page_template'][0] != 'restaurant.php') { 
			$section_footer = $page_meta['section_footer'][0];
			if($section_footer != 'default') {
				if($section_footer == 'enabled') {
					get_template_part('footer', 'content'); 
				}

			} else {
				if(YSettings::g('berg_footer_settings') == 1) {
					get_template_part('footer', 'content'); 
				}

			} 
		}
	} else {
		if(YSettings::g('berg_footer_settings') == 1) {
			get_template_part('footer', 'content'); 
		}
	}

	return false;
}

function berg_saveCustomCss() {
	if (isset($_POST['css'])) {
		$contents = stripslashes($_POST['css']);

		$templateFile = THEME_DIR . '/styles/css/custom_user.css';
		$urlAfter = THEME_DIR_URI . '/styles/css/custom_user.css';

		WP_Filesystem();
		global $wp_filesystem;
		$wp_filesystem->put_contents($templateFile, $contents, 0777);

		echo json_encode(array('url'=>$urlAfter));
		die();
	}
}

function load_template_part($template_name, $part_name=null) {
	ob_start();
	get_template_part($template_name, $part_name);
	$var = ob_get_contents();
	ob_end_clean();
	return $var;
}


function berg_loadPosts(){

	if ( isset($_POST['data']['pageId']) && isset($_POST['data']['page']) ){
		$id = $_POST['data']['pageId'];
		$page = $_POST['data']['page'];
		$page_meta = get_post_meta($id);
		$page_info = $page_meta;

		global $pageId;
		$pageId = $id;
		$categories = $page_meta;
		if ( isset($categories['blog_categories'][0]) ) {
			$categories = maybe_unserialize($categories['blog_categories'][0]);
		} else {
			$categories = '';
		}
		$perPage = intval(YSettings::g('blog_post_per_page', $pageId));
		if ( $categories != '' ) {
			$args = array('post_status'=>'publish', 'posts_per_page'=>$perPage, 'paged'=>$page, 'tax_query'=>array(array('taxonomy'=>'category', 'terms'=>$categories, 'field' => 'term_id')));
		} else {
			$args = array('post_status'=>'publish', 'posts_per_page'=>$perPage, 'paged'=>$page);
		}

		$the_query = new WP_Query($args);
		if ( $page <= $the_query->max_num_pages ) {
			$result = '';
			if ( $the_query->have_posts() ){
				while ( $the_query->have_posts() ) {
					$the_query->the_post();

					if ( isset($page_info['_wp_page_template'][0]) && $page_info['_wp_page_template'][0] == 'blog-classic.php' ){
						$result .= load_template_part('content', 'blog-classic');
					} elseif ( isset($page_info['_wp_page_template'][0]) && $page_info['_wp_page_template'][0] == 'blog-list.php') {
						$result .= load_template_part('content', 'blog-list');
					} elseif ( isset($page_info['_wp_page_template'][0]) && $page_info['_wp_page_template'][0] == 'blog-masonry.php') {
						$result .= load_template_part('content', 'blog-masonry');
					} elseif ( isset($page_info['_wp_page_template'][0]) && $page_info['_wp_page_template'][0] == 'blog.php') {
						$result .= load_template_part('content', 'blog-squares');
					} else {
						$result .= load_template_part('content');
					}

				}
			}
			echo $result;
		}
	}

	die();
}


function berg_loadPostsMasonry() {
	global $pageId;
	$page = intval($_POST['data']['page']);
	$layout_index = intval($_POST['data']['layout']);
	$pageId = intval($_POST['data']['pageId']);
	$posts_per_page = YSettings::g('blog_post_per_page', $pageId);
	$post_meta = get_post_meta($pageId);
	$categories = $post_meta;

	
	$excerpt = isset($post_meta['blog_show_excerpt'][0]) ? $post_meta['blog_show_excerpt'][0] : 0;
	$excerptLenght = isset($post_meta['blog_excerpt_length'][0]) ? $post_meta['blog_excerpt_length'][0] : 0;

	if (isset($categories['blog_categories'][0])) {
		$categories = maybe_unserialize($categories['blog_categories'][0]);
	} else {
		$categories = 'all';
	}
	
	$custom_layout = YSettings::g('berg_blog_masonry_layout', $pageId);

	$query_params = array(
		'post_type' 		=> 'post',
		'posts_per_page' 	=> $posts_per_page,
		'paged' 			=> $page,
		'orderby' 			=> 'date ID',
	);

	if ( $categories != 'all' ) {
		$query_params['cat'] = $categories;
	}

	$next_page = $page + 1;

	$load_masonry_query = new WP_Query( $query_params );

	$layouts = berg_portfolio_custom_masonry_layout($custom_layout);
	
	if ( $load_masonry_query->have_posts() ) {
		while ( $load_masonry_query->have_posts() ) {
			$load_masonry_query->the_post();

			include(locate_template('content-blog-masonry.php'));
			$layout_index++;

			if ( !isset($layouts[$layout_index]) ) {
				$layout_index = 0;
			}
		}
	}

	if ($load_masonry_query->max_num_pages >= $next_page) {
		echo '<div class="load-page-counter" data-next-page="'. $next_page .'" data-next-layout="'. $layout_index .'"></div>';
	} else {
		echo '<div class="no-more-posts"></div>';
	}
	wp_reset_postdata();

	die();
}

function berg_loadPortfolioMasonry() {
	$page = intval($_POST['data']['page']);
	$layout_index1 = intval($_POST['data']['layout']);
	$pageId = intval($_POST['data']['pageId']);
	$posts_per_page = YSettings::g('berg_images_per_page', $pageId);
	$post_meta = get_post_meta($pageId);
	$layout = $layout_index1;
	$categories = $post_meta;
	
	$excerpt = isset($post_meta['blog_show_excerpt'][0]) ? $post_meta['blog_show_excerpt'][0] : 0;
	$excerptLenght = isset($post_meta['blog_excerpt_length'][0]) ? $post_meta['blog_excerpt_length'][0] : 0;

	if (isset($categories['portfolio_categories'][0])) {
		$categories = maybe_unserialize($categories['portfolio_categories'][0]);
	} else {
		$categories = '';
	}
	
	$custom_layout = YSettings::g('berg_blog_masonry_layout', $pageId);

	$query_params = array(
		'post_type'=>'berg_portfolio',
		'posts_per_page'=>YSettings::g('berg_images_per_page', $pageId),
		'orderby'=>'date ID',
		'paged'=>$page,
		);
	if ( $categories != '' ) {
		$query_params['tax_query'] = array(array('taxonomy'=>'berg_portfolio_categories', 'terms'=>$categories, 'field' => 'term_id'));
	}

	$next_page = $page + 1;
	$load_masonry_query = new WP_Query( $query_params );
	$layouts = berg_portfolio_custom_masonry_layout($custom_layout);
	
	if ( $load_masonry_query->have_posts() ) {
		while ( $load_masonry_query->have_posts() ) {
			$load_masonry_query->the_post();
			global $post;
			include(locate_template('portfolio-single2.php'));
			$layout_index1++;
			if ( !isset($layouts[$layout_index1]) ) {
				$layout_index1 = 0;
			}
		}
	}

	if ($load_masonry_query->max_num_pages >= $next_page) {
		echo '<div class="load-page-counter" data-next-page="'. $next_page .'" data-next-layout="'. $layout_index1 .'"></div>';
	} else {
		echo '<div class="no-more-posts"></div>';
	}
	wp_reset_postdata();

	die();
}


function berg_loadPortfolio(){

	if ( isset($_POST['data']['pageId']) && isset($_POST['data']['page']) ){
		$id = $_POST['data']['pageId'];
		$page = $_POST['data']['page'];
		$page_meta = get_post_meta($id);
		$page_info = $page_meta;
		$categories = $page_meta;
		if ( isset($categories['portfolio_categories'][0]) ){
			$categories = maybe_unserialize($categories['portfolio_categories'][0]);
		} else {
			$categories = '';
		}
		$args = array('post_type'=>'berg_portfolio', 'posts_per_page'=>YSettings::g('berg_images_per_page', $id), 'orderby'=>'date ID', 'paged'=>$page);
		if($categories != '') {
			$args['tax_query'] = array(array('taxonomy'=>'berg_portfolio_categories', 'terms'=>$categories, 'field' => 'term_id'));
		}
		$pageId = $id;
		$the_query = new WP_Query($args);
		if ( $page <= $the_query->max_num_pages ) {
			// $result = '';
			if ( $the_query->have_posts() ){
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					global $post;
					include(locate_template('portfolio-single.php'));		
				}
			}
			// echo $result;
		}
	}
	die();
}

function berg_loadSinglePortfolio(){
	if ( isset($_POST['data']['id']) ){
		global $post; 
		$id = $_POST['data']['id'];
		$post = get_post($id);
		setup_postdata( $post );
		echo $result = load_template_part('overlay', 'content');
	}

	die();
}

/**
 * Enqueue scripts and styles.
 */
function berg_wp_scripts() {

	$protocol = is_ssl() ? 'https' : 'http';
	wp_deregister_script('jquery');
	wp_register_script('jquery', $protocol . '://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js', false, '2.1.1', false);
	wp_enqueue_script('jquery');
	if(is_page_template('contact.php') || is_page_template('contact2.php')) {
		$key = '';
		$apiKey = YSettings::g('berg_contact_google_api_key');
		if($apiKey != '') {
			$key = '?key='.$apiKey;
		}
		wp_register_script('google-maps', $protocol . '://maps.googleapis.com/maps/api/js'.$key, false, '1.0', false);
		wp_enqueue_script('google-maps');	
	}

	if ( (YSettings::g('berg_less_custom_enable') == 1)){
		wp_enqueue_style( 'berg-wp-style', THEME_DIR_URI .'/styles/css/custom_user.css' );
	} else {
		wp_enqueue_style( 'berg-wp-style', THEME_DIR_URI .'/styles/css/custom.css' );
	}		

	wp_deregister_style('rtb-booking-form');
	wp_deregister_style('contact-form-7');
	wp_deregister_style('pickadate-date');
	wp_deregister_style('pickadate-time');

	wp_dequeue_style('font-awesome');
	wp_enqueue_script('jquery.prettyPhoto', THEME_DIR_URI . '/js/jquery.prettyPhoto.js', array('jquery'), '1.0', true);

	if (in_array('restaurant-reservations/restaurant-reservations.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		wp_enqueue_script('picker', THEME_DIR_URI . '/js/picker.js', array('jquery'), '1.0', true);
		wp_enqueue_script('picker.date', THEME_DIR_URI . '/js/picker.date.js', array('jquery'), '1.0', true);
		wp_enqueue_script('picker.time', THEME_DIR_URI . '/js/picker.time.js', array('jquery'), '1.0', true);
	}
	wp_enqueue_script('libs',  THEME_DIR_URI . '/js/libs.js', array('jquery'), '1.0', true);
	wp_register_script('main',  THEME_DIR_URI . '/js/main.js', array('jquery'), '1.0', true);
	$translation_array = array( 'no_more_posts' => __( 'No more posts', 'BERG'));
	wp_localize_script('main', 'translation', $translation_array );
	if(is_page_template('homepage2.php')) {
		
		$timestamp = strtotime('next Sunday');
		$datepickerNames = array();
		for ($i = 0; $i < 7; $i++) {
		    $datepickerNames['days'][] = __(strftime('%A', $timestamp));
		    $timestamp = strtotime('+1 day', $timestamp);
		}
		$months = array();
		for($iM =1;$iM<=12;$iM++){
			$datepickerNames['months'][] = __(date("F", strtotime("$iM/12/10")));
		}
		$datepickerNames['startOfWeek'] = get_option('start_of_week');
		wp_localize_script('main', 'datepickerNames', $datepickerNames );
	}

	wp_enqueue_script('main');


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

function berg_registerAdminScripts($hook_suffix) {
	$IE6 = (preg_match('/MSIE 6/i', $_SERVER['HTTP_USER_AGENT'])) ? true : false;
	$IE7 = (preg_match('/MSIE 7/i', $_SERVER['HTTP_USER_AGENT'])) ? true : false;
	$IE8 = (preg_match('/MSIE 8/i', $_SERVER['HTTP_USER_AGENT'])) ? true : false;

	$protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_script('jquery');
	wp_enqueue_media();
	wp_register_style('admin-css', THEME_DIR_URI . '/admin/admin.css', false, '1.0');
	wp_enqueue_style('admin-css');

	if (is_rtl()) {
		wp_enqueue_style('style-rtl', THEME_DIR_URI . '/admin/rtl-admin.css', false, '1.0');
	}

	wp_dequeue_style('font-awesome');
	wp_register_style('berg-font-awesome', THEME_DIR_URI . '/admin/font-awesome/css/font-awesome.min.css', false, '1.0');
	wp_enqueue_style('berg-font-awesome');

	wp_enqueue_style('jquery-style', $protocol . '://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css');

	if (($IE6 == 1) || ($IE7 == 1) || ($IE8 == 1)) {
		wp_register_script('ie8', THEME_DIR_URI . "/js/selectivizr.js",array('jquery'));
		wp_register_style('event-ie8', THEME_INCLUDES_URI . "/css/event_ie8.css", null, 1.0, 'screen');	
	}

	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script('wp-color-picker');

	$key = '';
	$apiKey = YSettings::g('berg_contact_google_api_key');
	if($apiKey != '') {
		$key = '?key='.$apiKey;
	}
	wp_register_script('google-maps', $protocol . '://maps.googleapis.com/maps/api/js'.$key, false, '1.0', false);
	wp_enqueue_script('google-maps');	

	if ($hook_suffix == 'appearance_page_yopress-settings' || $hook_suffix == 'toplevel_page__options') {
		wp_register_script('google-maps', $protocol . '://maps.googleapis.com/maps/api/js'.$key, false, '1.0', false);
		wp_enqueue_script('google-maps');

		wp_register_script('admin-js', THEME_DIR_URI . '/admin/admin.js', array('jquery'), '1.0', true);
		wp_enqueue_script('admin-js');

		wp_enqueue_script('jquery-ui-sortable');
	}

	$screen = get_current_screen();
}

function my_admin_script() {
	wp_enqueue_script('my-admin', THEME_DIR_URI.'/js/my-admin.js', array('jquery'));
}

/*
** visual composer remove elements and chcange params
*/

function removeElements() {
	if ( defined('WPB_VC_VERSION') ) {
		vc_remove_element("vc_images_carousel");
		vc_remove_element("vc_posts_grid");
		vc_remove_element("vc_carousel");
		vc_remove_element("vc_video");
		vc_remove_element("vc_progress_bar");
		vc_remove_element("vc_pie");
		vc_remove_element("vc_wp_search");
		vc_remove_element("vc_wp_meta");
		vc_remove_element("vc_wp_calendar");
		vc_remove_element("vc_wp_recentcomments");
		vc_remove_element("vc_wp_pages");
		vc_remove_element("vc_wp_tagcloud");
		vc_remove_element("vc_wp_custommenu");
		vc_remove_element("vc_wp_text");
		vc_remove_element("vc_wp_posts");
		vc_remove_element("vc_wp_categories");
		vc_remove_element("vc_wp_archives");
		vc_remove_element("vc_wp_rss");
		vc_remove_element("vc_wp_search");
		vc_remove_element("vc_flickr");
		vc_remove_element("rev_slider_vc");
		vc_remove_element("vc_gmaps");
		vc_remove_element("contact-form-7");
		vc_remove_element("vc_widget_sidebar");
		vc_remove_element("vc_toggle");
	}
}

if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {
// removeElements();
	if(isset($_REQUEST['post_type'])) {
		if($_REQUEST['post_type'] == 'berg_portfolio') {
			removeElements();
		}
	} else if(isset($_REQUEST['post'])) {
		$type = get_post_type($_REQUEST['post']);
		if($type == 'berg_portfolio') {
			removeElements();
		}
	}
}

//Yopress in admin bar
function berg_link_to_yopress($wp_admin_bar) {
	$args = array(
		'id'    => 'yopress',
		'title' => 'YoPress',
		'href'  => get_admin_url() . 'themes.php?page=yopress-settings',
		'meta'  => array( 'class' => 'yopress-page' )
	);

	$wp_admin_bar->add_node($args);
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function berg_wp_widgets_init() {
	$tmp = YSettings::g('theme_custom_sidebars', '');
	$tmpCustomSidebars = explode('[:split:]', $tmp);

	if (is_array($tmpCustomSidebars)) {
		foreach ($tmpCustomSidebars as $key => $value) {
			if (!empty($value)) {
				register_sidebar( array(
					'name'          => 'Dynamic Sidebar - ' . $value,
					'id'            => 'sidebar-' . $value,
					'description'   => '',
					'before_widget' => '<div class="widget-wrapper">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4 class="widget-title">',
					'after_title'   => '</h4>'
				) );
			}
		}
	}

	register_sidebar( array(
		'name'          => __( 'Sidebar - Blog', 'BERG'),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div class="widget-wrapper %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>'
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar - Default Template', 'BERG'),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<div class="widget-wrapper %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>'
	) );	
	register_sidebar( array(
		'name'          => __( 'Sidebar - Posts', 'BERG'),
		'id'            => 'sidebar-3',
		'description'   => '',
		'before_widget' => '<div class="widget-wrapper %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>'
	) );	
	register_sidebar( array(
		'name'          => __( 'Sidebar - Visual Composer', 'BERG'),
		'id'            => 'sidebar-4',
		'description'   => '',
		'before_widget' => '<div class="widget-wrapper %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>'
	) );
	if (class_exists('WooCommerce')) {
		register_sidebar(array(
			'name'			=> 'WooCommerce Shop',
			'id'			=> 'shop',
			'description'	=> 'This widget area should be used only for WooCommerce Shop',
			'before_widget'	=> '<div class="widget-wrapper %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="widget-title">',
			'after_title'	=> '</h4>'
		));
	}
}

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
function berg_vcSetAsTheme() {
	vc_set_as_theme(true);
	vc_set_default_editor_post_types(array('post', 'page', 'berg_menu', 'berg_restaurant', 'berg_portfolio', 'berg_footer'));
	// print_r(vc_editor_post_types());
}

/*
** custom excerpt length
*/
function custom_excerpt_length( $length ) {
	global $pageId;

	return YSettings::g('blog_excerpt_length', $pageId);
}

/*
** custom excerpt more
*/
function new_excerpt_more( $more ) {
	return '...';
}


function berg_register_plugins() {
	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */

	$plugins = array(
		
		array(
			'name'			=> 'WPBakery Visual Composer', // The plugin name
			'slug'			=> 'js_composer', // The plugin slug (typically the folder name)
			'source'			=> THEME_PLUGINS . '/js_composer.zip', // The plugin source
			'required'			=> true, // If false, the plugin is only 'recommended' instead of required
			'version'			=> '4.12', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'		=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'			=> 'Slider Revolution Responsive WordPress Plugin', // The plugin name
			'slug'			=> 'revslider', // The plugin slug (typically the folder name)
			'source'			=> THEME_PLUGINS . '/revslider.zip', // The plugin source
			'required'			=> true, // If false, the plugin is only 'recommended' instead of required
			'version'			=> '5.2.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'		=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'			=> 'Contact Form 7', // The plugin name
			'slug'			=> 'contact-form-7', // The plugin slug (typically the folder name)
			'source'		=> 'https://downloads.wordpress.org/plugin/contact-form-7.4.4.2.zip',
			//'source'			=> THEME_PLUGINS . '/contact-form-7.zip', // The plugin source
			'required'			=> false, // If false, the plugin is only 'recommended' instead of required
			'version'		=> '4.4.2',
			'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'		=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'			=> 'Restaurant Reservations', // The plugin name
			'slug'			=> 'restaurant-reservations', // The plugin slug (typically the folder name)
			//'source'			=> THEME_PLUGINS . '/restaurant-reservations.zip', // The plugin source
			'source' 		=> 'https://downloads.wordpress.org/plugin/restaurant-reservations.1.5.zip',
			'version'		=>  '1.5',
			'required'			=> false, // If false, the plugin is only 'recommended' instead of required
			'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'		=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'			=> 'Really Simple Captcha', // The plugin name
			'slug'			=> 'really-simple-captcha', // The plugin slug (typically the folder name)
			//'source'			=> THEME_PLUGINS . '/really-simple-captcha.zip', // The plugin source
			'source' 		=> 	'https://downloads.wordpress.org/plugin/really-simple-captcha.1.8.0.1.zip',
			'version'		=> '1.8.0.1',
			'required'			=> false, // If false, the plugin is only 'recommended' instead of required
			'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'		=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'			=> 'WooCommerce - excelling eCommerce', // The plugin name
			'slug'			=> 'woocommerce', // The plugin slug (typically the folder name)
			'source' 		=> 'https://downloads.wordpress.org/plugin/woocommerce.2.6.4.zip',
			'version'		=> '2.6.4',
			'required'			=> false, // If false, the plugin is only 'recommended' instead of required
			'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'		=> '', // If set, overrides default API URL and points to an external URL
		),
		 array(
			'method'				=> 'buy',
			'name'                  => 'The WordPress Multilingual Plugin', // The plugin name
			'slug'                  => 'wpml', // The plugin slug (typically the folder name)
			'source'                => '', //THEME_DIR . '/plugins/revslider.zip', // The plugin source
			'required'              => false, // If false, the plugin is only 'recommended' instead of required
			'version'               => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'          => 'https://wpml.org/?aid=63524&affiliate_key=wP53KkuDHd0l', // If set, overrides default API URL and points to an external URL
        ),
	);
 
	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = THEME_NAME . "-admin";

	$config = array(
		'domain'		=> $theme_text_domain, // Text domain - likely want to be the same as your theme.
		'default_path'		=> '', // Default absolute path to pre-packaged plugins
		'menu'			=> 'install-required-plugins', // Menu slug
		'has_notices'		=> true, // Show admin notices or not
		'is_automatic'		=> true, // Automatically activate plugins after installation or not
		'message'		=> '', // Message to output right before the plugins table
		'strings'		=> array(
			'page_title'			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'				=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'	=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'	=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'		=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'	=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'	=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate'		=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update'		=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update'		=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link'			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link'			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'				=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete'				=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'				=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);
	tgmpa( $plugins, $config );
}

// Sub-menu wrapper
class Child_Wrap extends Walker_Nav_Menu {
	private $curItem;
	private $excluded = array(); 

	function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<div class=\"subnav\"><ul class=\"subnav-wrapper\">\n";

		if (isset($this->curItem->submenu_category)) {
			if ($this->curItem->submenu_category == 1) {

			}
		}
	}

	function end_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul></div>\n";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$this->curItem = $item; 
		$submenuOutput = '';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		$atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

		if (isset($item->submenu_category) && $item->submenu_category == 1) {
			$post = get_post($item->object_id);
			$template = get_metadata('post', $item->object_id, '_wp_page_template', true);

			if ($template == 'menu.php' || $template == 'menu2.php' || $template == 'menu3.php' || $template == 'menu4.php') {
					$categories = get_metadata('post', $item->object_id, 'menu_categories', true);

				if (!empty($categories)) {
					$terms = get_terms('berg_menu_categories', array('include'=>$categories, 'hide_empty' => false, ));
					$termsArray = array();

					foreach ($terms as $term) {
						$termsArray[$term->term_id] = array('id'=>$term->term_id, 'name'=>$term->name, 'slug'=>$term->slug);
					}

					$submenuOutput = "<div class=\"subnav image-subnav\"><ul class=\"subnav-wrapper\">\n";
					foreach($categories as $cat) {
						$t_id = $termsArray[$cat]['id'];
						$imgUrl = get_option("taxonomy_$t_id");

						if (isset($imgUrl['menu_category_icon_image']) && getTemplateName() == 'homepage.php') {
							if(!is_numeric($imgUrl['menu_category_icon_image'])) {
								$imgAttachements = get_attachment_id_from_url($imgUrl['menu_category_icon_image']);
							} else {
								$imgAttachements = $imgUrl['menu_category_icon_image'];
							}


							if (isset($imgAttachements)) {
								$img = wp_get_attachment_image_src($imgAttachements, 'menu_thumb');

								if ($img[0]) {
									$imgUrl = 'background-image: url('.$img[0].')';	
								} else {
									$imgUrl = 'background-image: url('.$imgUrl['menu_category_icon_image'].')';	
								}
							} else {
								$imgUrl = 'background-image: url('.$imgUrl['menu_category_icon_image'].')';
							}
						} else {
							$imgUrl = '';
						}

						$submenuOutput .= '<li><a href="'.esc_url($atts['href']).'#category-'.$termsArray[$cat]['id'].'">'.$termsArray[$cat]['name'].'</a><div><a href="'.esc_url($atts['href']).'#category-'.$termsArray[$cat]['id'].'" class="menu-img" style="'.$imgUrl.'"></a></div></li>';
					}

					$submenuOutput .= "</ul></div>\n";
					$this->excluded[] = $item->ID;
				}
			}  		
		}

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		/** This filter is documented in wp-includes/post-template.php */
		$meta = Menu_Icons_Meta::get( $item->ID );
		if(isset($meta['icon']) && $meta['icon'] != '' ) {
			$icon = '<i class="fa '. $meta['icon'].'"></i> ';
			$item_output .= $icon;
		}		
		if(isset($meta['label_hide']) && $meta['label_hide'] == '1' ) {
			$item_output .= $args->link_before . $args->link_after;
		} else {
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		}
		$item_output .= '</a>';
		$item_output .= $submenuOutput;
		$item_output .= $args->after;

		// $output .= $submenuOutput;

		if(!in_array($item->menu_item_parent, $this->excluded))
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}


}

class Child_Wrapper extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {       
		$indent = str_repeat("\t", $depth +1); 
		$output .= "\n$indent<span class=\"open-children\"><i class=\"fa fa-angle-down\"></i></span><ul class=\"subnav-wrapper\">\n"
		?>
	<?php }
 
	/** END_LVL 
	 * Ends the children list of after the elements are added. */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth +1 ); 

		$output .= "$indent</ul>\n";

		?>  
	<?php }
}

/** COMMENTS WALKER */
class zipGun_walker_comment extends Walker_Comment {
	 
	// init classwide variables
	var $tree_type = 'comment';
	var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
 
	/** CONSTRUCTOR
	 * You'll have to use this if you plan to get to the top of the comments list, as
	 * start_lvl() only goes as high as 1 deep nested comments */
	function __construct() { ?>
		<div id="comment-list">
		 
	<?php }
	 
	/** START_LVL 
	 * Starts the list before the CHILD elements are added. */
	function start_lvl( &$output, $depth = 0, $args = array() ) {       
		$GLOBALS['comment_depth'] = $depth + 1; ?>
			
				<ul class="children">
	<?php }
 
	/** END_LVL 
	 * Ends the children list of after the elements are added. */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1; ?>
 
		</ul><!-- /.children -->
		 
	<?php }
	 
	/** START_EL */
	function start_el( &$output, $comment, $depth=0, $args = array(), $id = 0 ) {
		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment; 
		$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); 

		?>
		
	   
		<div <?php comment_class( $parent_class ); ?> id="comment-<?php comment_ID() ?>">

			<div class="comment-author vcard">
				<div>
					<div>
						<?php if($comment->comment_type != 'pingback') : ?>
						<a class="avatar">
							<figure>
								<?php echo ( $args['avatar_size'] != 0 ? get_avatar( $comment, $args['avatar_size'] ) :'' ); ?>
							</figure>
						</a>
						<?php endif;?>
						<div class="author">
							<span class="fn n author-name"><?php echo get_comment_author_link(); ?></span>
							<!-- <span> -->
								<div class="comment-meta comment-meta-data">
									<?php echo time_diff_enhanced(); ?> <?php edit_comment_link( '(Edit)' ); ?>
								</div><!-- /.comment-meta -->
							<!-- </span> -->
						</div>
					</div>
				</div>
			</div><!-- /.comment-author -->

			<div id="comment-body-<?php comment_ID() ?>" class="comment-body comment-text">		
				<div id="comment-content-<?php comment_ID(); ?>" class="comment-content">
					<?php if( !$comment->comment_approved) : ?>
					<em class="comment-awaiting-moderation"><?php echo __('Your comment is awaiting moderation.', 'BERG');?></em>
					 
					<?php else: if($comment->comment_type != 'pingback') { comment_text(); }; ?>
					<?php endif; ?>
				</div><!-- /.comment-content -->
			

			</div><!-- /.comment-body -->
	<?php }
 
	function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>
		 
		</div><!-- /#comment-' . get_comment_ID() . ' -->
		 
	<?php }
	 
	/** DESTRUCTOR
	 * I'm just using this since we needed to use the constructor to reach the top 
	 * of the comments list, just seems to balance out nicely:) */
	function __destruct() { ?>
	 
   <!-- /#comment-list -->
 
	<?php }
}

function time_diff_enhanced( $duration = 60 ) {

	$comment_time = get_comment_time('U');
	$human_time = '';

	$time_now = date('U');

	// use human time if less that $duration days ago (60 days by default)
	// 60 seconds * 60 minutes * 24 hours * $duration days
	if ( $comment_time > $time_now - ( 60 * 60 * 24 * $duration ) ) {
		$human_time = sprintf( __( '%s ago', 'BERG'), human_time_diff( $comment_time, current_time( 'timestamp' ) ) );
	} else {
		$human_time = get_comment_date();
	}

	return $human_time;
}

function social_profiles($align = 'left', $el_class = '') {
	$class = '';
	if($align != 'left') {
		$class = 'text-'.$align;
	}
	$output = '';
	$social_profiles = YSettings::g('social_profiles');

	if ( !empty($social_profiles['ids']) ) {
		$social_id_order = explode(',', $social_profiles['ids']);
	}
	if ( !empty($social_profiles['socials']) ) {
		$social_profiles = explode('|', $social_profiles['socials']);
	}
	if ( is_array($social_profiles) && is_array($social_id_order) ) {
		foreach ( $social_profiles as $profile ) {
			foreach ( json_decode($profile, true) as $id => $value ) {
				$socials_arr[$id] = $value[0];
			}
		}
		foreach ( $social_id_order as $id_social ) {
		$output .= '<li>';
			if ( filter_var( $socials_arr[$id_social]['icon'], FILTER_VALIDATE_URL ) ) {
				$output .= '<a href="' . esc_url($socials_arr[$id_social]['link']) . '"><img src="'.$socials_arr[$id_social]['icon'] .'" class=""></a>';
			} else {
				$output .= '<a href="' . esc_url($socials_arr[$id_social]['link']) . '"><i class="'.$socials_arr[$id_social]['icon'].'"></i></a>';
			}
		$output .= '</li>';
		}
	}

	$social = '<div class="social-profiles '.$class.' '.$el_class.'">
		<ul>'.$output.'</ul></div>';

	return $social;
}


function social_func( $atts ) {
   extract( shortcode_atts( array(
	  'position' => 'left',
	  'el_class' => '',
   ), $atts ) );

   return social_profiles($position, $el_class);
}
add_shortcode( 'social', 'social_func' );


add_action( 'vc_before_init', 'socialMediaSettings' );

function socialMediaSettings() {
	vc_map( array(
		"name" => __("Social Profiles", 'BERG'),
		"base" => "social",
		"class" => "",
		"category" => __('Content', 'BERG'),
		"show_settings_on_create" => false,	
		"params" => array(
			array(
				'type' => 'dropdown',
				'heading' => __( 'Icons alignment', 'BERG' ),
				'param_name' => 'position',
				'value' => array(
					__( 'Left', 'BERG' ) => 'left',
					__( 'Center', 'BERG' ) => 'center',
					__( 'Right', 'BERG' ) => 'right'
				),
				'description' => __( 'Select social icons alignment.', 'BERG' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'BERG')
			),

		)
	) );
}








add_action( 'berg_menu_categories_add_form_fields', 'berg_category_add_fields', 10, 2 );
add_action( 'berg_menu_categories_edit_form_fields', 'berg_category_edit_fields', 10, 2 );
// add_action( 'edited_category', 'berg_category_save_fields', 10, 2);
// add_action( 'create_category', 'berg_category_save_fields', 10, 2);


function berg_category_add_fields($taxonomy) {
		global $feature_groups;
		?>
		<div class="form-field term-group collection-image-field">
			<div class="upload-img-field-wrapper">
				<a href="javascript:void(0);" class="button insert-img add-collection-img-button" title="<?php esc_attr_e( 'Add img', 'BERG'); ?>"><?php _e( 'Add image', 'BERG' ); ?></a>
				<?php
					$class = 'hidden';
				?>
				<a href="javascript:void(0);" class="button delete-collection-img <?php echo $class ;?>" title="<?php esc_attr_e( 'Del img', 'BERG'); ?>"><?php _e( 'Delete image', 'BERG' ); ?></a>
				<input type="hidden" name="term_meta[menu_category_icon_image]" value="" class="img-form" />
				<div class="upload-img-wrapper">
					<img src="" alt="user-image" class="user-photo upload-img hidden attachment-medium size-medium" style="max-width: 300px; margin-top: 30px;" />
				</div>
			</div>
		</div>

		<?php
	}

function berg_category_edit_fields($term, $taxonomy) {

		$t_id = $term->term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		//echo esc_attr( $term_meta['menu_category_icon_image'] ) ? esc_attr( $term_meta['menu_category_icon_image'] ) : ''; 
		$upload = esc_attr( $term_meta['menu_category_icon_image'] ) ? esc_attr( $term_meta['menu_category_icon_image'] ) : ''; 
		if($upload === false) {
			$upload = '';
		}
		$class = "hidden";
		 
			// retrieve the existing value(s) for this meta field. This returns an array
			$term_meta = get_option( "taxonomy_$t_id" );

			if(is_numeric($upload)) {

			}
		?>
		

		<tr>
			<th><label for="user_img"><?php _e( 'Upload your image', 'BERG' ); ?></label></th>
			<td>	
				<div class="upload-img-field-wrapper">
					<a href="javascript:void(0);" class="button insert-img add-collection-img-button" title="<?php esc_attr_e( 'Add img', 'BERG'); ?>"><?php _e( 'Add image', 'BERG' ); ?></a>
					<?php if($upload != '') {
						$class = '';
					};
					?>
					<a href="javascript:void(0);" class="button delete-collection-img <?php echo $class ;?>" title="<?php esc_attr_e( 'Delete img', 'BERG'); ?>"><?php _e( 'Delete image', 'BERG' ); ?></a>
					<input type="hidden" name="term_meta[menu_category_icon_image]" value="<?php echo $upload; ?>" class="img-form" />
					<div class="upload-img-wrapper">
						<?php if($upload != '' && is_numeric($upload)) {
							$imgUrl = wp_get_attachment_image($upload, 'medium', '', array('class' => 'upload-img upload-img-id'));
							echo $imgUrl;
						} elseif($upload != '' && !is_numeric($upload)) {
							echo '<img src="'.$upload.'" class="user-photo upload-img attachment-medium size-medium" style="max-width: 300px; margin-top:30px;"/>';
						} else {


						?>
						<?php } ?>
						<img src="" alt="user-image" class="user-photo upload-img hidden attachment-medium size-medium" style="max-width: 300px; margin-top:30px;" />

					</div>
				</div>
			</td>
		</tr>

	<?php 
}

function berg_category_save_fields($term_id, $taxonomy) {
	if( isset( $_POST['category']['image'] ) ){
		if($_POST['category']['image'] != '') {
			$image = $_POST['category']['image'];
			update_term_meta($term_id, 'category-image', $image);
		} else {
			delete_term_meta ($term_id, 'category-image');
		}
	}

	if( isset( $_POST['category']['keywords'] ) ){
		if($_POST['category']['keywords'] != '') {
			$keywords = $_POST['category']['keywords'];
			update_term_meta($term_id, 'category-keywords', $keywords);
		} else {
			delete_term_meta ($term_id, 'category-keywords');
		}
	}
}




function berg_save_taxonomy_custom_meta($term_id) {
	if (isset($_POST['term_meta'])) {
		$term_meta = get_option( "taxonomy_$term_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );

		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		$order = get_option('berg_menu_categories_order');
		$order = rtrim($order, ',');
		$order = explode(',', $order);
		if(!in_array($term_id, $order)) {
			$order[] = $term_id;
			$order = implode(',', $order);
			update_option('berg_menu_categories_order', $order);
		}

		// Save the option array.
		update_option("taxonomy_$term_id", $term_meta);

	}
}

add_action('edited_berg_menu_categories', 'berg_save_taxonomy_custom_meta', 10, 2);  
add_action('create_berg_menu_categories', 'berg_save_taxonomy_custom_meta', 10, 2);

function berg_ajaxComment($comment_ID, $comment_status) {
	if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		$parentId = false;

		if (isset($_POST['comment_parent'])) {
			$parentId = (int)$_POST['comment_parent'];
		}

		$comment = get_comment($comment_ID);
		wp_notify_postauthor($comment_ID);
		$commentContent = 'berg_getCommentHTML($comment, $parentId);';
		header('Content-type: application/json');
		echo json_encode(array('status'=>'success', 'contents'=>$commentContent, 'parentId'=>$parentId));
		die();
	}
}

/*
 * Add buttons to tinyMCE
 */
add_action('admin_init', 'add_button');
// add_action('redux/page/redux/menu/after', 'loadTinyMce');

// function loadTinyMce() {
// 	wp_enqueue_script("berg_tinymce_scripts", THEME_DIR_URI. '/tinymc/shortcodes2.js', array(), false, true);
// }

function add_button() {
	if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
		add_filter('mce_external_plugins', 'add_plugin');
		add_filter('mce_buttons_2', 'register_button');
	}
}
add_filter('mce_buttons_2', 'register_button');
function register_button($buttons) {
	array_push($buttons, "yopress");
	return $buttons;
}

function add_plugin($plugin_array) {
	$plugin_array['yopress'] = THEME_DIR_URI. '/tinymc/shortcodes2.js';
	return $plugin_array;
}

add_filter( 'manage_post_columns', 'remove_post_format' );
function remove_post_format() {
	remove_meta_box('formatdiv', 'post', 'side');
}
if ( ! function_exists('is_ajax') ) {
   function is_ajax() {
       return defined( 'DOING_AJAX' );
   }
}
add_filter('pre_get_posts', 'limit_category_posts');
function limit_category_posts($query) {
	if(!is_ajax() && !is_admin()) {
		if ($query->is_category || $query->is_archive) {
			if($query->is_archive) {
				$count = get_option('redux');
				$count = $count['blog_post_per_page'];
				set_query_var('posts_per_page', $count);
			} else {
				if (!isset($query->query['post_type']) && !isset($query->query['product_cat'])) {
					$query->set('posts_per_page', YSettings::g('blog_post_per_page'));				
				}
			}
			
		}
	}
	

	return $query;
}

function get_attachment_id_from_url($attachment_url = '') {
	global $wpdb;
	$attachment_id = false;

	if ( '' == $attachment_url ) {
		return;
	}

	$upload_dir_paths = wp_upload_dir();
 
	if (false !== strpos($attachment_url, $upload_dir_paths['baseurl'])) {
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
	}

	return $attachment_id;
}

if (defined('WPB_VC_VERSION')) {
	add_action('vc_load_default_templates_action','my_custom_template_for_vc');
}

function my_custom_template_for_vc() {
    $data               = array();
    $data['name']       = __( 'Demo Footer', 'BERG');
    $data['image_path'] = preg_replace( '/\s/', '%20', THEME_DIR_URI.'/img/example_content.png'); // always use preg replace to be sure that "space" will not break logic
    $data['custom_class'] = '';
    $data['content']    = <<<CONTENT
        [vc_row][vc_column width="1/1"][vc_column_text]
<h2 style="text-align: center;">BERG | Restaurant Reinvented</h2>
[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="1/4"][vc_column_text]
<h5>Monday - Thursday
7.00 - 21.00</h5>
[/vc_column_text][/vc_column][vc_column width="1/4"][vc_column_text]
<h5>Friday - Sunday
7.00 - 23.00</h5>
[/vc_column_text][/vc_column][vc_column width="1/4"][vc_column_text]
<h5>Armii Krajowej 17
58-100 Walichnowy</h5>
[/vc_column_text][/vc_column][vc_column width="1/4"][vc_column_text]
<h5>+ 48 555 555 555
<a href="mailto:resturant@berg.com">restaurant@berg.com</a></h5>
[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="1/1"][social][/vc_column][/vc_row][vc_row][vc_column width="1/1"][vc_column_text]
<p style="text-align: center;"><span>&copy; 2014 BERG Restaurant.</span><span> All Rights Reserved.</span></p>
[/vc_column_text][/vc_column][/vc_row]
CONTENT;
 
    vc_add_default_templates( $data );

    $data               = array();
    $data['name']       = __( 'Example content', 'BERG');
    $data['image_path'] = preg_replace( '/\s/', '%20', THEME_DIR_URI.'/img/example_content.png'); // always use preg replace to be sure that "space" will not break logic
    $data['custom_class'] = '';
    $data['content']    = <<<CONTENT
 [vc_row][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_custom_heading font_container="tag:h2|font_size:40|text_align:center" google_fonts="font_family:Satisfy%3Aregular|font_style:400%20regular%3A400%3Anormal" text="We are BERG, we love food. "][vc_separator color="grey" style="dotted"][/vc_column][vc_column width="1/6"][/vc_column][/vc_row][vc_row][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_row_inner][vc_column_inner width="1/1"][vc_column_text]
<p style="text-align: right;"><img class="alignleft wp-image-1067 size-medium" src="http://placehold.it/300x300" alt="sevihe" width="300" height="300" />[dropcap]W[/dropcap]e believe in click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. am text block.</p>
<p style="text-align: right;">I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet.</p>
<p style="text-align: right;"><img class="alignnone size-thumbnail wp-image-1084" src="http://placehold.it/150x150" alt="signature" width="150" height="150" /></p>
[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_separator color="grey" style="dotted"][vc_empty_space height="52px"][/vc_column][vc_column width="1/6"][/vc_column][/vc_row][vc_row][vc_column width="1/3"][vc_custom_heading text="We are open" font_container="tag:h2|font_size:30|text_align:center" google_fonts="font_family:Satisfy%3Aregular|font_style:400%20regular%3A400%3Anormal"][vc_separator color="grey" style="dotted" el_width="80"][vc_column_text]Monday[label color="label-danger"]Closed[/label]
Tuesday - Thursday [label color="label-default"]12:00 - 21:00[/label]
Friday - Saturday [label color="label-default"]12:00 - 23:00[/label]
Sunday [label color="label-default"]12:00 - 20:00[/label]

[/vc_column_text][/vc_column][vc_column width="1/3"][vc_custom_heading text="Bookings" font_container="tag:h2|font_size:30|text_align:center" google_fonts="font_family:Satisfy%3Aregular|font_style:400%20regular%3A400%3Anormal"][vc_separator color="grey" style="dotted" el_width="80"][vc_column_text][dropcap]M[/dropcap]ake sure you book your place in advance for the best experience possible. If you have questions make sure you give us a call.
<p style="text-align: center;">[btn href="" color="btn-default" size="btn-lg"]Book Now[/btn]</p>
[/vc_column_text][vc_empty_space height="32px"][/vc_column][vc_column width="1/3"][vc_custom_heading text="Summer Menu" font_container="tag:h2|font_size:30|text_align:center" google_fonts="font_family:Satisfy%3Aregular|font_style:400%20regular%3A400%3Anormal"][vc_separator color="grey" style="dotted" el_width="80"][vc_column_text][dropcap]O[/dropcap]ur menu is here. Tasty as always. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
<p style="text-align: center;">[btn href="" color="btn-default" size="btn-lg"]Menu[/btn]</p>
[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="1/1"][vc_column_text]
<h6><span style="color: #999999;">Programs we participate</span></h6>
[/vc_column_text][vc_row_inner][vc_column_inner width="1/6"][vc_single_image css_animation="left-to-right" border_color="grey" img_link_target="_self" img_size="full"][/vc_column_inner][vc_column_inner width="1/6"][vc_single_image css_animation="left-to-right" border_color="grey" img_link_target="_self" img_size="full"][/vc_column_inner][vc_column_inner width="1/6"][vc_single_image css_animation="appear" border_color="grey" img_link_target="_self" img_size="full"][/vc_column_inner][vc_column_inner width="1/6"][vc_single_image css_animation="appear" border_color="grey" img_link_target="_self" img_size="full"][/vc_column_inner][vc_column_inner width="1/6"][vc_single_image css_animation="right-to-left" border_color="grey" img_link_target="_self" img_size="full"][/vc_column_inner][vc_column_inner width="1/6"][vc_single_image css_animation="right-to-left" border_color="grey" img_link_target="_self" img_size="full"][/vc_column_inner][/vc_row_inner][vc_empty_space height="52px"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][vc_row_inner][vc_column_inner width="1/2"][vc_single_image css_animation="appear" border_color="grey" img_link_target="_self" img_size="600x400"][/vc_column_inner][vc_column_inner width="1/2"][vc_custom_heading text="Summer Menu" font_container="tag:h2|font_size:30|text_align:center" google_fonts="font_family:Satisfy%3Aregular|font_style:400%20regular%3A400%3Anormal"][vc_separator color="grey" style="dotted" el_width="80"][vc_column_text][dropcap]T[/dropcap]o see click button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.
<p style="text-align: center;">[btn href="" color="btn-default" size="btn-lg"]Menu[/btn]</p>
[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row][vc_column width="1/1"][vc_empty_space height="72px"][/vc_column][/vc_row][vc_row][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_custom_heading text="The Team" font_container="tag:h2|font_size:30|text_align:center" google_fonts="font_family:Satisfy%3Aregular|font_style:400%20regular%3A400%3Anormal"][vc_separator color="grey" style="dotted" el_width="80"][vc_column_text][dropcap]V[/dropcap]ivamus sagittis <strong>passion</strong> vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur <strong>teamwork</strong> elit. Cras mattis consectetur purus sit amet fermentum. Cras mattis <strong>effort</strong> purus sit amet fermentum. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.[/vc_column_text][vc_empty_space height="52px"][/vc_column][vc_column width="1/6"][/vc_column][/vc_row][vc_row][vc_column width="1/3"][vc_single_image border_color="grey" img_link_target="_self" img_size="full"][vc_column_text]
<h3>Marion Kalis</h3>
[label color="label-primary"]Owner[/label] [label color="label-default"]marion@berg.com[/label]
I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/3"][vc_single_image border_color="grey" img_link_target="_self" img_size="full"][vc_column_text]
<h3>Lukas Valaski</h3>
[label color="label-primary"]Manager[/label] [label color="label-default"]lukas@berg.com[/label]
I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][vc_column width="1/3"][vc_single_image border_color="grey" img_link_target="_self" img_size="full"][vc_column_text]
<h3>Hallina Sas</h3>
[label color="label-primary"]PR[/label] [label color="label-default"]hallina@berg.com[/label]
I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="1/1"][vc_empty_space height="72px"][vc_empty_space height="52px"][/vc_column][/vc_row][vc_row][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_custom_heading text="The Place" font_container="tag:h2|font_size:30|text_align:center" google_fonts="font_family:Satisfy%3Aregular|font_style:400%20regular%3A400%3Anormal"][vc_separator color="grey" style="dotted" el_width="80"][vc_column_text][dropcap]P[/dropcap]ivamus sagittis <strong>passion</strong> vel augue laoreet rutrum faucibus dolor auctor. Lorem ipsum dolor sit amet, consectetur <strong>teamwork</strong> elit. Cras mattis consectetur purus sit amet fermentum. Cras mattis <strong>effort</strong> purus sit amet fermentum. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.[/vc_column_text][vc_empty_space height="52px"][/vc_column][vc_column width="1/6"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][vc_row_inner][vc_column_inner width="1/2"][vc_single_image border_color="grey" img_link_target="_self" img_size="full"][/vc_column_inner][vc_column_inner width="1/2"][vc_single_image border_color="grey" img_link_target="_self" img_size="full"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/2"][vc_single_image border_color="grey" img_link_target="_self" img_size="full"][/vc_column_inner][vc_column_inner width="1/2"][vc_single_image border_color="grey" img_link_target="_self" img_size="full"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row][vc_column width="1/1"][vc_column_text]
<h6><span style="color: #999999;">Advertisments</span></h6>
[/vc_column_text][vc_single_image css_animation="appear" alignment="center" border_color="grey" img_link_target="_self" img_size="full" link="http://demo.yosoftware.com/wp/berg-wp/?page_id=593"][vc_empty_space height="52px"][/vc_column][/vc_row][vc_row][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_custom_heading text="Latest News" font_container="tag:h2|font_size:30|text_align:center" google_fonts="font_family:Satisfy%3Aregular|font_style:400%20regular%3A400%3Anormal"][vc_separator color="grey" style="dotted" el_width="80"][vc_empty_space height="52px"][/vc_column][vc_column width="1/6"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][vc_posts_grid loop="size:6|order_by:date|post_type:post|categories:44" grid_columns_count="3" grid_layout="title|link_post,text|excerpt" grid_link_target="_self" grid_layout_mode="fitRows"][/vc_column][/vc_row]
CONTENT;
 
    vc_add_default_templates( $data );
}

function get_post_details($class = '', $type = 'posts', $pageId) {
	$comments_in_author = (YSettings::g($type.'_show_author', $pageId) == 1 && YSettings::g($type.'_show_cat', $pageId) == 1);
	$content = '<ul class="post_details '.$class.'">';

	if (is_sticky() && is_home() && ! is_paged()) {
		$content .= '<li><span class="highlight highlight-color"><i class="icon-pin"></i> <strong>' . __( 'Sticky', 'BERG') . '</strong></span></li>';
	}

	if (YSettings::g($type.'_show_author', $pageId) == 1) {
		$content .= '<li><span>' . __('by', 'BERG') . '</span> <a href="'.get_author_posts_url(get_the_author_meta( 'ID' )).'">'.get_the_author().'</a> ';

		if ($comments_in_author) {
			$categories = '';

			foreach (get_the_category() as $category) {
				$categories .= '<li><a href="'.esc_url(get_category_link($category->term_id)).'" title="'.$category->name.'">'.$category->name.'</a></li>';
			}

			$content .= '<span>' . __('in', 'BERG') . '</span> <ul>'.$categories.'</ul>';	
			// $content .= '<ul>'.$categories.'</ul>';			
		}

		$content .= '</li>';
	}

	if (!$comments_in_author) {
		if (YSettings::g($type.'_show_cat', $pageId) == 1) {
			$categories = '';

			foreach(get_the_category() as $category) {
				$categories .= '<li><a href="'.esc_url(get_category_link($category->term_id)).'" title="'.$category->name.'">'.$category->name.'</a></li>';
			}

			$content .= '<li><ul>'.$categories.'</ul></li>';
		}
	}
	
	// if (YSettings::g($type.'_show_comments', 1) == 1) {
	// 	$content .= '<li><a href="'.esc_url(get_comments_link()).'" title="">'.get_comments_number_text().'</a></li>';
	// }

	$content .= '</ul>';
	return $content; 
}

function berg_is_cart_or_checkout() {
	if (class_exists('Woocommerce')) {
		if (is_cart() || is_checkout()) {
			return true;
		}
	}

	return false;
}

function berg_is_woocommerce_page() {
	if (class_exists('Woocommerce')) {
		if (is_cart() || is_checkout() || is_woocommerce() || is_account_page()) {
			return true;
		}
	}
	return false;
}

/* Demo Importer */
include_once THEME_INCLUDES . '/import2/importer.php';

global $yopress_Demo_Importer;
$yopress_Demo_Importer = new Demo_Importer();

function yopress_Import() {
	global $yopress_Demo_Importer;
	$yopress_Demo_Importer->imagesURL = 'http://demo.yosoftware.com/import/berg-wp/';

	$folder = "demo1/";
	if (!empty($_POST['demo'])) {
		$folder = $_POST['demo'] . "/";
	}

	$yopress_Demo_Importer->import($folder . 'demo.sql');
	$yopress_Demo_Importer->import_redux($folder . 'redux.txt');
	die();
}

add_action('wp_ajax_yopress_import', 'yopress_Import');

function berg_append_to_content($content) {
	$settings = get_option( 'rtb-settings' );
	if (function_exists('icl_object_id')) {
		$booking_page = (int)icl_object_id($settings['booking-page'], 'page', true);
	} else {
		$booking_page = (int)$settings['booking-page'];
	}

	if (!is_main_query() || !in_the_loop()) {
		return $content;
	}

	if (empty($booking_page)) {
		return $content;
	}

	global $post;
	if ($post->ID !== $booking_page) {
		return $content;
	}

	return $content . rtb_print_booking_form();
}

if (in_array('restaurant-reservations/restaurant-reservations.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	if (function_exists('icl_object_id')) {
		remove_filter('the_content', 'append_to_content');
		add_filter('the_content', 'berg_append_to_content' );
	}
}

function berg_themeforest_themes_update($updates) {
	if (isset($updates->checked)) {
		$username = YSettings::g('themeforest_username', '');
		$apikey = YSettings::g('themeforest_api_key', '');

		if (($username != '') && ($apikey != '')) {
			if (!class_exists('Pixelentity_Themes_Updater')) {
				require_once(THEME_INCLUDES . "/pixelentity-themes-updater/class-pixelentity-themes-updater.php");
			}

			$updater = new Pixelentity_Themes_Updater($username, $apikey);
			$updates = $updater->check($updates);
		}
	}

	return $updates;
}

add_filter("pre_set_site_transient_update_themes", "berg_themeforest_themes_update");

if (!function_exists('berg_woocommerce_assets')) {
	/**
	 * Function that includes all necessary scripts for WooCommerce if installed
	 */
	function berg_woocommerce_assets() {
		global $redux;

		if (function_exists('is_woocommerce')) {
			//get woocommerce specific scripts
			wp_enqueue_script("silesia_woocommerce_script", THEME_DIR_URI . "/js/woocommerce.js", array(), false, true);
		}
	}

	add_action('wp_enqueue_scripts', 'berg_woocommerce_assets');
}

add_action('init', 'woocommerce_clear_cart_url');

function woocommerce_clear_cart_url() {
	global $woocommerce;

	if (isset($_REQUEST['clear-cart'])) {
		$woocommerce->cart->empty_cart();
	}
}

function berg_portfolio_custom_masonry_layout($custom_layout) {
	$default_layout = array(
		'w2-h2', 'w2-h1', 'w1-h1', 'w1-h1',
		'w1-h1', 'w1-h2', 'w1-h1', 'w1-h1', 'w1-h1', 'w2-h1',
		'w1-h1', 'w1-h1', 'w2-h2', 'w1-h1', 'w1-h1',
		'w2-h1', 'w1-h1', 'w1-h1',
		'w2-h1', 'w1-h2', 'w1-h1', 'w1-h1', 'w1-h1', 'w1-h1',
		'w2-h1', 'w1-h1', 'w1-h1', 'w1-h1', 'w1-h1', 'w2-h1',
		'w1-h1', 'w2-h1', 'w1-h1',
		'w1-h1', 'w1-h1', 'w2-h1',
		'w1-h1', 'w2-h2', 'w1-h1', 'w1-h1', 'w1-h1',
	);
	if ( isset($custom_layout) && $custom_layout != '' ) {

		$custom_layout = str_replace('1', 'w1-h1', $custom_layout);
		$custom_layout = str_replace('2', 'w2-h1', $custom_layout);
		$custom_layout = str_replace('3', 'w1-h2', $custom_layout);
		$custom_layout = str_replace('4', 'w2-h2', $custom_layout);
		$custom_layout = explode(',', $custom_layout);
		return $custom_layout;
	} else {
		return $default_layout;
	}
}

function wp_get_attachment( $attachment_id ) {
    $attachment = get_post( $attachment_id );
    if(isset($attachment)) {
    	return $attachment->post_excerpt;
    }
    // return array(
    //     // 'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
    //     'caption' => $attachment->post_excerpt,
    //     // 'description' => $attachment->post_content,
    //     // 'href' => get_permalink( $attachment->ID ),
    //     // 'src' => $attachment->guid,
    //     // 'title' => $attachment->post_title
    // );
}

global $socialIcons;
include_once THEME_INCLUDES . '/font-awesome-map.php';
$socialIcons = $fa_icons;

function berg_get_social_profiles() {
	$socialIcons = YSettings::g('social_profiles');
	$output = '<div class="social-profiles"><ul>';

	$socials_arr = array();
	$social_id_order = '';
	$social_profiles = '';

	if ( !empty($socialIcons['ids']) ) {
		$social_id_order = explode(',', $socialIcons['ids']);
	}
	if ( !empty($socialIcons['socials']) ) {
		$social_profiles = explode('|', $socialIcons['socials']);
	}
	if ( is_array($social_profiles) && is_array($social_id_order) ) {
		foreach ( $social_profiles as $profile ) {
			foreach ( json_decode($profile, true) as $id => $value ) {
				$socials_arr[$id] = $value[0];
			}
		}
		foreach ( $social_id_order as $id_social ) {
		$output .= '<li>';
			if ( filter_var( $socials_arr[$id_social]['icon'], FILTER_VALIDATE_URL ) ) {
				$output .= '<a href="' . esc_url($socials_arr[$id_social]['link']) . '"><img src="'.$socials_arr[$id_social]['icon'] .'" class=""></a>';
			} else {
				$output .= '<a href="' . esc_url($socials_arr[$id_social]['link']) . '"><i class="'.$socials_arr[$id_social]['icon'].'"></i></a>';
			}
		$output .= '</li>';
		}
	}
	$output .= '</ul></div>';

	return $output; 
}

function berg_get_sidebars_array() {
	global $wp_registered_sidebars;
	$sidebars = array();
	$sidebars_data = $wp_registered_sidebars;
	
	foreach ($sidebars_data as $sidebar ) {
		$sidebars[$sidebar['id']] = $sidebar['name'];
	}

	return $sidebars;
}

function berg_getMapTemplate() {
	$uuid = $_POST['id'];
	$i = $_POST['i'];
	$name = 'redux[multiple_contact_map_div]';
	?>
			<tr class="form-field field-map map_id_<?php echo $uuid; ?>">
				<th scope="row">
					<label for="map_canvas"><?php echo __('Location ', 'BERG');?>#<?php echo $i; ?></label>
				</th>
				<td><div style="width: 100%; height: 250px;" id="map_<?php echo $uuid; ?>" class="mulitiple_map_canvas map_<?php echo $uuid; ?>" data-uuid="<?php echo $uuid; ?>"></div></td>
			</tr>

			<tr class="form-field field-location map_id_<?php echo $uuid; ?>">
				<th scope="row"><label for="multiple_contact_map_address_id"><?php echo __('Find Location', 'BERG');?></label></th>
				<td><?php 

					$locations = YSettings::g("multiple_contact_map_div"); 
 					if(!isset($locations["multiple_contact_map_address_".$uuid])) {
 						$locations["multiple_contact_map_address_".$uuid] = 'Świdnica';
 					}					
 					if(!isset($locations["multiple_contact_map_lat_".$uuid])) {
 						$locations["multiple_contact_map_lat_".$uuid] = '50.8498434';
 					}
 					if(!isset($locations["multiple_contact_map_lng_".$uuid])) {
 						$locations["multiple_contact_map_lng_".$uuid] = '16.475679000000014';
 					}
 					if(!isset($locations["multiple_contact_map_zoom_".$uuid])) {
 						$locations["multiple_contact_map_zoom_".$uuid] = 10;
 					}
 					if(!isset($locations["multiple_contact_marker_width_".$uuid])) {
 						$locations["multiple_contact_marker_width_".$uuid] = 0;
 					}
 					if(!isset($locations["multiple_contact_marker_height_".$uuid])) {
 						$locations["multiple_contact_marker_height_".$uuid] = 0;
 					} 					

				?>
					<input style="width:310px;" type="text" class="<?php echo $uuid; ?>" id="multiple_contact_map_address_<?php echo $uuid; ?>_id" name="<?php echo $name . '[multiple_contact_map_address_'.$uuid.']'; ?>" value="<?php echo $locations['multiple_contact_map_address_'.$uuid]; ?>"> <button id="multiple_contact_map_search_<?php echo $uuid; ?>" data-uuid="<?php echo $uuid; ?>" class="button button-search"><?php echo __('Search', 'BERG');?></button>
					<input type="text" class="hidden" name="<?php echo $name.'[multiple_contact_map_lat_'.$uuid.']';?>" id="multiple_contact_map_lat_<?php echo $uuid; ?>_id" value="<?php echo $locations["multiple_contact_map_lat_".$uuid]; ?>" />
					<input type="text" class="hidden" name="<?php echo $name . '[multiple_contact_map_lng_'.$uuid.']'; ?>" id="multiple_contact_map_lng_<?php echo $uuid; ?>_id" value="<?php echo $locations["multiple_contact_map_lng_".$uuid]; ?>" />
					<input type="text" class="hidden" name="<?php echo $name.'[multiple_contact_map_zoom_'.$uuid.']'; ?>" id="multiple_contact_map_zoom_<?php echo $uuid; ?>_id" value="<?php echo $locations["multiple_contact_map_zoom_".$uuid]; ?>" />
					<input type="text" class="hidden" name="<?php echo $name.'[multiple_contact_marker_width_'.$uuid.']'; ?>" id="multiple_contact_marker_width_<?php echo $uuid; ?>_id" value="<?php echo $locations["multiple_contact_marker_width_".$uuid]; ?>" />
					<input type="text" class="hidden" name="<?php echo $name.'[multiple_contact_marker_height_'.$uuid.']'; ?>" id="multiple_contact_marker_height_<?php echo $uuid; ?>_id" value="<?php echo $locations["multiple_contact_marker_height_".$uuid]; ?>" />
				</td>
			</tr>
			<?php 
				// if(isset($locations["multiple_contact_map_marker_image_".$uuid])) {
					//$marker_image = $locations["multiple_contact_map_marker_image_".$uuid]; 
				// } else {
				// 	$marker_image = '';
				// }
			;?>
			<tr valign="form-field" class="form-field field-marker map_id_<?php echo $uuid; ?>">
				<th>
					<label for="multiple_contact_map_marker_image_<?php echo $uuid; ?>_id"><?php echo __('Marker Image', 'BERG');?></label>
				</th>
				<td>
					<input id="upload_image" type="text" size="20" style="width:310px;" name="<?php echo $name.'[multiple_contact_map_marker_image_'.$uuid.']'; ?>" value="" class="marker_image_<?php echo $uuid; ?>">
					<input id="upload_image_button" class="button button-secondary upload_image_button" type="button" value="Upload" data-id="2">
					<input id="multiple_contact_map_marker_image_<?php echo $uuid; ?>_id" class="hidden" value="">
					<input class="button button-secondary upload_image_remove_button" type="button" value="Remove" data-id="2">
				</td>
			</tr>
			<tr class="form-field field-header-info map_id_<?php echo $uuid; ?> <?php //echo $class_border ;?>">
				<th scope="row"><label><?php echo __('Location header', 'BERG');?></label></th>
				<td>
					<input style="width:310px;" type="text" class="header_<?php echo $uuid; ?>" id="multiple_contact_address_header_<?php echo $uuid; ?>_id" name="<?php echo $name.'[multiple_contact_address_header_'.$uuid.']'; ?>" value=""> 
				</td>
			</tr>
			<tr class="form-field field-desc-info map_id_<?php echo $uuid; ?> <?php //echo $class_border ;?>">
				<th scope="row"><label><?php echo __('Location description', 'BERG');?></label></th>
				<td>
					<?php 
					
 					if(!isset($locations["multiple_contact_address_desc_".$uuid])) {
 						$locations["multiple_contact_address_desc_".$uuid] = '';
 					}					
 					$content = $locations["multiple_contact_address_desc_".$uuid];
 					// $content = '';
				?>
				
				<div id="wp-multiple_contact_address_desc_<?php echo $uuid;?>_id-wrap" class="wp-core-ui wp-editor-wrap tmce-active">
					<div id="wp-multiple_contact_address_desc_<?php echo $uuid;?>_id-editor-tools" class="wp-editor-tools hide-if-no-js">
						<div class="wp-editor-tabs">
							<button type="button" id="multiple_contact_address_desc_<?php echo $uuid;?>_id-tmce" class="wp-switch-editor switch-tmce" data-wp-editor-id="multiple_contact_address_desc_<?php echo $uuid;?>_id"><?php echo __('Visual');?></button>
							<!-- <button type="button" id="multiple_contact_address_desc_<?php echo $uuid;?>_id-html" class="wp-switch-editor switch-html" data-wp-editor-id="multiple_contact_address_desc_<?php echo $uuid;?>_id"><?php echo _x( 'Text', 'Name for the Text editor tab (formerly HTML)'); ?></button> -->
						</div>
					</div>
					<div id="wp-multiple_contact_address_desc_<?php echo $uuid;?>_id-editor-container" class="wp-editor-container">
						<div id="qt_multiple_contact_address_desc_<?php echo $uuid;?>_id_toolbar" class="quicktags-toolbar"></div>
						<textarea class="<?php echo $uuid;?> contact-editor wp-editor-area" rows="<?php echo get_option('default_post_edit_rows', 2);?>" autocomplete="off" cols="40" name="redux[multiple_contact_map_div][multiple_contact_address_desc_<?php echo $uuid;?>]" id="multiple_contact_address_desc_<?php echo $uuid;?>_id"></textarea>
					</div>
				</div>			

				</td>
			</tr>
			<?php //if ($i > 0) : ?>
			<tr class="form-field field-remove-location map_id_<?php echo $uuid; ?>">
				<th scope="row"><label><?php echo __('Remove', 'BERG');?></label></th>
				<td><button id="multiple_contact_map_search" data-uuid="<?php echo $uuid; ?>" class="button button-remove button-remove-map"><?php echo __('Remove this location', 'BERG');?></button></td>
			</tr>
			<?php //endif; ?>
			<!-- <tr class="form-field map_id_<?php //echo $uuid; ?>">
				<th scope="row"><hr/></th>
				<td><hr/></td>
			</tr> -->
			<?php

	die();
}

/* Move to some helper clases */
class YSettings {

	public static function gWPML($settingName, $default = '') {
		if (function_exists('icl_t')) {
			return icl_t('yopress', $settingName, $default);
		} else {
			// return YoPressStorageModule::instance()->getOption($settingName, $default);	
		}
	}

	public static function g($settingName, $default = '', $loadYopress = false){
		global $redux;

			// $redux = get_option('redux');

		if (function_exists('icl_object_id')  && !function_exists('pll_is_translated_post_type')) {
			global $sitepress;
			$default_language = $sitepress->get_default_language();
			if ( ICL_LANGUAGE_CODE != $default_language ) {
				if ( isset($GLOBALS['redux_'.ICL_LANGUAGE_CODE]) ) {
					$redux = $GLOBALS['redux_'.ICL_LANGUAGE_CODE];
				}
			}
		}

		if(isset($redux[$settingName]) && $loadYopress == false) {

			$page_meta = get_post_meta($default, $settingName, true);
			if($page_meta == '' || $page_meta == 'default') {
				return $redux[$settingName];
			} else {
				return $page_meta;
			}
		}
		if($loadYopress == true) {
			$yopress = get_option('YoPress-Berg');
			if(is_array($yopress)) {
					
				if(isset($yopress[$settingName])) {
					$output = $yopress[$settingName];
				} else {
					$output = '';
				}
				return $output;
			}
		}
		return false;
	}
}