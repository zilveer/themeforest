<?php				
/*
 * After Theme Setup
 */
function iron_theme_setup () {

	register_nav_menu('main-menu', 'Main Menu');

	if ( function_exists('add_theme_support') ) {
		add_theme_support('automatic-feed-links');
		add_theme_support('post-thumbnails');
		add_theme_support( 'html5', array( 'comment-form', 'comment-list' ) );
		add_theme_support( 'favicon' );
		add_theme_support('woocommerce');
	}

	if ( function_exists('add_image_size') ) {
		add_image_size('image-thumb', 300, 230, true);
	}

	// Fix bug with category pages not found after reseting option panel to default
	if ( ! empty($_GET['settings-updated']) ) {
		switch_theme( get_stylesheet() );
	}
	
	$hide_admin_bar = get_iron_option('hide_admin_bar');
	if($hide_admin_bar) {
		add_filter('show_admin_bar', '__return_false');
	}
	
	
	
	// Load theme textdomain
	load_theme_textdomain( IRON_TEXT_DOMAIN, IRON_PARENT_DIR . '/languages' );

}

add_action('after_setup_theme', 'iron_theme_setup');



/*
 * Redirect to options after activation
 */
function iron_theme_activation() {

	flush_rewrite_rules();

	
	if ( ! empty($_GET['activated']) && $_GET['activated'] == 'true' )
	{
		
		update_option('medium_size_w', 559);
		update_option('medium_size_h', 559);
		
		wp_redirect( admin_url('admin.php?page=iron_options') );
		exit;
	}

}
add_action('after_switch_theme', 'iron_theme_activation');


function webmotion_admin_head ()
{
	if ( get_iron_option('meta_favicon') )
	echo '<link rel="shortcut icon" type="image/x-icon" href="' . get_iron_option('meta_favicon') . '" />';
}

add_action('admin_head', 'webmotion_admin_head', 99);



function iron_body_class( $classes ) {

	$lang = defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : 'en';

	$classes[] = 'lang-'.$lang;
	
	if((bool)get_iron_option('enable_fixed_header')) {
		$classes[] = 'fixed_header';
	}
	
	return $classes;
}
add_filter( 'body_class', 'iron_body_class' );


function iron_write_updates() {

	global $iron_updates;

	$static_updates_file = IRON_PARENT_DIR.'/changelog.txt';
	$updates_file = IRON_PARENT_DIR.'/admin/updates.php';

	if(file_exists($static_updates_file) && is_writable($static_updates_file) && !empty($iron_updates)) {

		$static_updates_file_time = filemtime($static_updates_file);
		$updates_file_time = filemtime($updates_file);

		if(($static_updates_file_time < $updates_file_time) || (@filesize($static_updates_file_time) == 0)) {

			$changelog = '';
			foreach($iron_updates as $update) {

				$changelog .= '----------------------------------------------'."\r\n";
				$changelog .= 'V.'.$update["version"].' - '.$update["date"]."\r\n";
				$changelog .= '----------------------------------------------'."\r\n";
				foreach($update["changes"] as $change) {

					$changelog .= '- '.strip_tags(str_replace("<br>", "\r\n  ", $change))."\r\n";

				}
				$changelog .= "\r\n";
			}

			file_put_contents($static_updates_file, $changelog);
		}
	}

}
add_action('init', 'iron_write_updates');


function iron_get_revslider_settings() {

	global $wpdb;
	
	if(function_exists('is_plugin_active') && is_plugin_active('revslider/revslider.php')) {
	
		$styles = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'revslider_css', ARRAY_A);
		$animations = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'revslider_layer_animations', ARRAY_A);
		$sliders = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'revslider_sliders', ARRAY_A);
		$slides = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'revslider_slides', ARRAY_A);
		
		$data = array(
			'styles' => $styles,
			'animations' => $animations,
			'sliders' => $sliders,
			'slides' => $slides
		);
		
		die(json_encode($data));
	}	
}

function iron_get_essgrid_settings() {

	global $wpdb;
	
	if(function_exists('is_plugin_active') && is_plugin_active('essential-grid/essential-grid.php')) {
	
		$data = array();
		
		$data['eg_grids'] = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'eg_grids', ARRAY_A);
		$data['eg_item_elements'] = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'eg_item_elements', ARRAY_A);
		$data['eg_item_skins'] = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'eg_item_skins', ARRAY_A);
		$data['eg_navigation_skins'] = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'eg_navigation_skins', ARRAY_A);

		die(json_encode($data));
	}	
}

if(!empty($_GET["import"])) {
	
	if($_GET["import"] == 'revslider') {
		
		add_action('init', 'iron_get_revslider_settings');
		
	}else if($_GET["import"] == 'essgrid') {
		
		add_action('init', 'iron_get_essgrid_settings');
	}	
}


function iron_get_demos() {

	$themes = false;
	$themes_url = 'http://drivr.irontemplates.com/import/themes.php';
	if (@fopen($themes_url, "r")) {
		$themes = file_get_contents($themes_url);
		$themes = unserialize($themes);
	}
	die(json_encode($themes));
}
add_action('wp_ajax_iron_get_demos', 'iron_get_demos');
add_action('wp_ajax_nopriv_iron_get_demos', 'iron_get_demos');



/*
 * Import default Theme Data
 */
function iron_import_default_data() {

	global $wpdb;

	require_once IRON_PARENT_DIR . '/includes/classes/autoimporter.class.php';

	$importPath = IRON_PARENT_DIR . '/import/';
		
	$placeholders = true;	
/*
	if($_SERVER['HTTP_HOST'] == 'irontemplates.com' || $_SERVER['HTTP_HOST'] == 'staging.irontemplates.com' || strpos($_SERVER['HTTP_HOST'], '.dev') !== false) {
		$placeholders = false;
	}
*/
	
	$file = $importPath . 'default-data.xml';
	$file_tmp = $importPath.'default-data-tmp.xml';
	$theme = (!empty($_POST["theme"]) && $_POST["theme"] != 'default') ? '-'.$_POST["theme"] : '';
	$redux = !empty($_POST["redux"]) ? $_POST["redux"] : '';
	$revslider = !empty($_POST["revslider"]) ? $_POST["revslider"] : '';
	$essgrid = 'http://drivr.irontemplates.com/import/essgrid'.$theme.'.json';

	if (false === file_get_contents($essgrid,0,null,0,1)) {
	    $essgrid = false;
	}

	$file_content = file_get_contents('http://drivr.irontemplates.com/import/default-data'.$theme.'.xml');

	if($placeholders) {
		$file_content = preg_replace("/http:\/\/drivr.irontemplates\.com\/wp-content\/uploads\/(.*?).(jpg|jpeg|png|gif)\</", "http://placehold.it/400x400/text/color/placeholder.jpg<", $file_content);
	}

    if (!is_writable($file) || !file_put_contents($file , $file_content) ) {

		$message = "Oops! An issue has been found. Don't worry, you have 2 different ways to fix it.<br><br>";

		$message .= "<strong>Option 1)</strong> Make sure this file is writable: ".$file."<br>To do this, you need to set this folder permission and this file permission to 777. Check this video to know how to set folder permission using FileZilla: <a href='http://www.youtube.com/watch?v=MKgfquaVAgM'>http://www.youtube.com/watch?v=MKgfquaVAgM</a><br><br>";

		$message .= "<strong>Option 2)</strong> Import the default data using Wordpress importer. Read this faq for more info: <a href='http://it.ticksy.com/faq/180'>http://it.ticksy.com/faq/1800</a>";

		$data['error'] = true;
		$data['msg'] = '<p style="color: red;">' . $message . '</p>';

	    die( json_encode($data) );
	}
	
	
	if ( @file_exists($file) )
	{

		if ( @copy($file, $file_tmp) )
		{
		
		
			/* Import Reduc Settings
			   ========================================================================== */
	
			if(!empty($redux)) {
			
				set_transient('redux-opts-saved', '1', 1000 );
				
				$import = wp_remote_retrieve_body(wp_remote_get($redux));
			            
			    $imported_options = unserialize(trim($import,'###'));
			    if(is_array($imported_options) && isset($imported_options['redux-opts-backup']) && $imported_options['redux-opts-backup'] == '1'){
			        $imported_options['imported'] = 1;
			       
					global $Redux_Options;
					$Redux_Options->options = $imported_options;
			        update_option(IRON_TEXT_DOMAIN, $imported_options);
			    }
		    } 
		    
		    if(!empty($revslider) && function_exists('is_plugin_active') && is_plugin_active('revslider/revslider.php')) {
		    
		    	$revslider_data = file_get_contents($revslider);
		    	$revslider_data = json_decode($revslider_data, true);
		    	
		    	$wpdb->query("TRUNCATE TABLE ".$wpdb->prefix."revslider_css");
		    	$wpdb->query("TRUNCATE TABLE ".$wpdb->prefix."revslider_layer_animations");
		    	$wpdb->query("TRUNCATE TABLE ".$wpdb->prefix."revslider_sliders");
		    	$wpdb->query("TRUNCATE TABLE ".$wpdb->prefix."revslider_slides");
		    	
		    	if(!empty($revslider_data["sliders"])) {
		    	
		    		$styles = $revslider_data["styles"];
		    		$animations = $revslider_data["animations"];
		    		$sliders = $revslider_data["sliders"];
					$slides = $revslider_data["slides"];
					
					foreach($styles as $style) {
						
						$wpdb->insert( 
							$wpdb->prefix.'revslider_css', 
							$style
						);
					}
					
					foreach($animations as $animation) {
						
						$wpdb->insert( 
							$wpdb->prefix.'revslider_layer_animations', 
							$animation
						);
					}
					
					foreach($sliders as $slider) {
						
						$wpdb->insert( 
							$wpdb->prefix.'revslider_sliders', 
							$slider
						);
					}
					
					foreach($slides as $slide) {
						
						$wpdb->insert( 
							$wpdb->prefix.'revslider_slides', 
							$slide
						);
					}	

		    	}
		    }
		    
		    if(!empty($essgrid) && function_exists('is_plugin_active') && is_plugin_active('essential-grid/essential-grid.php')) {
		    
		    	$essgrid_data = file_get_contents($essgrid);
		    	$essgrid_data = json_decode($essgrid_data, true);
		    	

				$im = new Essential_Grid_Import();
				
				
				if(!empty($essgrid_data['skins'])) {
				
					$skins = $essgrid_data['skins'];
					$skin_ids = array();
					foreach($skins as $skin){
						$skin_ids[] = $skin['id'];
					}
					$im->import_skins($skins,$skin_ids);

				}
				
				if(!empty($essgrid_data['navigation-skins'])) {
				
					$navskins = $essgrid_data['navigation-skins'];
					$navskin_ids = array();
					foreach($navskins as $navskin){
						$navskin_ids[] = $navskin['id'];
					}
					$im->import_navigation_skins($navskins,$navskin_ids);

				}
				
				if(!empty($essgrid_data['global-css'])) {
				
					$im->import_global_styles($essgrid_data['global-css']);
				}
				
				if(!empty($essgrid_data['punch-fonts'])) {
				
					$im->import_punch_fonts($essgrid_data['punch-fonts']);
				}	
				
				if(!empty($essgrid_data['grids'])) {

					$im->import_grids($essgrid_data['grids']);
				
				}

		    }    

			/* Import XML
			   ========================================================================== */
			 

			$args = array(
				'file'        => $file_tmp,
				'map_user_id' => 1
			);

			$removed = array();
			if($wpdb->query("TRUNCATE TABLE $wpdb->posts")) $removed[] = __('Posts removed', IRON_TEXT_DOMAIN);
			if($wpdb->query("TRUNCATE TABLE $wpdb->postmeta")) $removed[] = __('Postmeta removed', IRON_TEXT_DOMAIN);
			if($wpdb->query("TRUNCATE TABLE $wpdb->comments")) $removed[] = __('Comments removed', IRON_TEXT_DOMAIN);
			if($wpdb->query("TRUNCATE TABLE $wpdb->commentmeta")) $removed[] = __('Commentmeta removed', IRON_TEXT_DOMAIN);
			if($wpdb->query("TRUNCATE TABLE $wpdb->links")) $removed[] = __('Links removed', IRON_TEXT_DOMAIN);
			if($wpdb->query("TRUNCATE TABLE $wpdb->terms")) $removed[] = __('Terms removed', IRON_TEXT_DOMAIN);
			if($wpdb->query("TRUNCATE TABLE $wpdb->term_relationships")) $removed[] = __('Term relationships removed', IRON_TEXT_DOMAIN);
			if($wpdb->query("TRUNCATE TABLE $wpdb->term_taxonomy")) $removed[] = __('Term Taxonomy removed', IRON_TEXT_DOMAIN);
			if($wpdb->query("DELETE FROM $wpdb->options WHERE `option_name` LIKE ('%_transient_%')")) $removed[] = __('Transients removed', IRON_TEXT_DOMAIN);
			$wpdb->query("OPTIMIZE TABLE $wpdb->options");

			foreach ( $removed as $item ) {
				$output[] = '' . $item . '<br>';
			}

			$output[] = '<hr>';

			ob_start();

			auto_import( $args );
			$raw = ob_get_contents();

			ob_end_clean();

			$output[] = $raw;

			/* Ugly hack to avoid duplicated Menu Items
			   ========================================================================== */

			$keep_safe = array();

			$results = $wpdb->get_results("select MIN(m2.meta_value) as parent from $wpdb->postmeta m1
			INNER JOIN $wpdb->postmeta m2 ON m1.post_id = m2.post_id AND m2.meta_key = '_menu_item_menu_item_parent'
			WHERE m1.meta_key = '_menu_item_object_id' AND m2.meta_value != 0 group by m1.meta_value having count(*) > 1");

			foreach($results as $res) {
				$keep_safe[] = $res->parent;
			}

			$results = $wpdb->get_results("select MAX(m2.meta_value) as parent, m1.post_id, m1.meta_value, MAX(m1.meta_id) from $wpdb->postmeta m1
			INNER JOIN $wpdb->postmeta m2 ON m1.post_id = m2.post_id AND m2.meta_key = '_menu_item_menu_item_parent'
			WHERE m1.meta_key = '_menu_item_object_id' AND m2.meta_value != 0 group by m1.meta_value having count(*) > 1");

			foreach($results as $res) {


				$wpdb->query($wpdb->prepare("DELETE FROM $wpdb->postmeta WHERE `post_id` = %d", $res->post_id));
				wp_delete_post($res->post_id);

				$wpdb->query($wpdb->prepare("DELETE FROM $wpdb->postmeta WHERE `post_id` = %d", $res->parent));
				wp_delete_post($res->parent);

			}

			$results = $wpdb->get_results("select m1.post_id, m1.meta_value, MAX(m1.meta_id) from $wpdb->postmeta m1
			INNER JOIN $wpdb->postmeta m2 ON m1.post_id = m2.post_id AND m2.meta_key = '_menu_item_menu_item_parent'
			WHERE m1.meta_key = '_menu_item_object_id' AND m2.meta_value = 0 group by m1.meta_value having count(*) > 1");

			foreach($results as $res) {

				if(!in_array($res->post_id, $keep_safe)) {
					$wpdb->query($wpdb->prepare("DELETE FROM $wpdb->postmeta WHERE `post_id` = %d", $res->post_id));
					wp_delete_post($res->post_id);
				}
			}




			/* Setup Widgets
			   ========================================================================== */

			/**
			 * Default sidebars also set in /admin/options.php:widget_areas
			 */

			if ( class_exists('WP_Widget') )
			{
				// Disable default WordPress sidebars from fresh install
				//update_option( 'widget_search', array() );
				update_option( 'widget_recent-posts', array() );
				update_option( 'widget_recent-comments', array() );
				update_option( 'widget_archives', array() );
				update_option( 'widget_categories', array() );
				update_option( 'widget_meta', array() );
				update_option( 'sidebars_widgets', array(
					  'wp_inactive_widgets'     => array()
					, IRON_SIDEBAR_PREFIX . '0' => array()
					, IRON_SIDEBAR_PREFIX . '1' => array()
					, IRON_SIDEBAR_PREFIX . '2' => array()
					, IRON_SIDEBAR_PREFIX . '3' => array()
					, IRON_SIDEBAR_PREFIX . '4' => array()
				) );

				global $wp_registered_sidebars;

				### Setup Widget Instances
				$sidebar_widgets = wp_get_sidebars_widgets();
				$widget_areas = get_iron_option('widget_areas', null, array());



				### Sidebar "Default Footer"
				if ( array_key_exists(IRON_SIDEBAR_PREFIX . '2', $sidebar_widgets) )
				{
					$sidebar_widgets[IRON_SIDEBAR_PREFIX . '2'] = array(
						'iron-newsletter-2'
					);

					update_option( 'widget_iron-newsletter', array(
						2 => array(
							'title' => __('Subscribe to our newsletter', IRON_TEXT_DOMAIN)
						)
						, '_multiwidget' => 1
					) );

					set_iron_option('footer-area_id', IRON_SIDEBAR_PREFIX . '2');
				}



				### Sidebar "Default Blog Sidebar"
				if ( array_key_exists(IRON_SIDEBAR_PREFIX . '0', $sidebar_widgets) )
				{
					$sidebar_widgets[IRON_SIDEBAR_PREFIX . '0'] = array(
						'iron-terms-2'
					);

					update_option( 'widget_iron-terms', array(
						2 => array(
							  'title'        => __('Categories')
							, 'taxonomy'     => 'category'
							, 'count'        => 1
							, 'hierarchical' => 0
							, 'dropdown'     => 0
						)
						, '_multiwidget' => 1
					) );

					$query = new WP_Query( array(
						  'post_type'      => 'page'
						, 'posts_per_page' => -1
						, 'no_found_rows'  => true
						, 'meta_query' => array(
							array(
								'key' => '_wp_page_template',
								'value' => 'index',
								'compare' => 'LIKE'
							)
						)
					) );

					if ( $query->have_posts() )
					{
						foreach ( $query->posts as $post )
						{
							update_post_meta( $post->ID, 'sidebar-position', 'right', 'disabled' );
							update_post_meta( $post->ID, 'sidebar-area_id', IRON_SIDEBAR_PREFIX . '0', '' );
						}
					}
				}



				### Sidebar "Default Video Sidebar"
				if ( array_key_exists(IRON_SIDEBAR_PREFIX . '1', $sidebar_widgets) )
				{
					$sidebar_widgets[IRON_SIDEBAR_PREFIX . '1'] = array(
						'iron-terms-3'
					);

					$widget_instances = get_option('widget_iron-terms');

					unset( $widget_instances['_multiwidget'] );

					$widget_instances[] = array(
						  'title'        => __('Categories')
						, 'taxonomy'     => 'video-category'
						, 'count'        => 1
						, 'hierarchical' => 0
						, 'dropdown'     => 0
					);

					$widget_instances['_multiwidget'] = 1;

					update_option( 'widget_iron-terms', $widget_instances );

					$query = new WP_Query( array(
						  'post_type'      => 'page'
						, 'posts_per_page' => -1
						, 'no_found_rows'  => true
						, 'meta_query' => array(
							array(
								'key' => '_wp_page_template',
								'value' => 'archive-video',
								'compare' => 'LIKE'
							)
						)
					) );

					if ( $query->have_posts() )
					{
						foreach ( $query->posts as $post )
						{
							update_post_meta( $post->ID, 'sidebar-position', 'right', 'disabled' );
							update_post_meta( $post->ID, 'sidebar-area_id', IRON_SIDEBAR_PREFIX . '1', '' );
						}
					}
				}

				wp_set_sidebars_widgets( $sidebar_widgets );
				

	
				/* Set Menu Location
				   ========================================================================== */
	
				$menu_slug = 'main-menu';
				$menu_id = (int) $wpdb->get_var($wpdb->prepare("SELECT term_id FROM $wpdb->terms WHERE slug = %s", $menu_slug));
	
				if ( is_numeric($menu_id) ) {
					$locations = get_theme_mod('nav_menu_locations');
					$locations[$menu_slug] = $menu_id;
					set_theme_mod('nav_menu_locations', $locations);
				}

				

				$output[] = '<hr>';
				$output[] = '<p>' . __('Widgets assigned to sidebars.', IRON_TEXT_DOMAIN) . '</p>';
			}

			/* ========================================================================== */



			flush_rewrite_rules();

			$data['error'] = false;
			$data['msg'] = implode('', $output) . '<p style="color: green;"><strong>' . __('Import Succeded!', IRON_TEXT_DOMAIN) . '</strong></p>';

		} else {

			$data['error'] = true;
			$data['msg'] = '<p style="color: red;"><strong>' . __('Unable to generate temporary copy of import file. Permission denied.', IRON_TEXT_DOMAIN) . '</strong></p>';

		}

	} else {

		$data['error'] = true;
		$data['msg'] = '<p style="color: red;"><strong>' . __('Import file is missing:', IRON_TEXT_DOMAIN) . ' ' . $file . '</strong></p>';

	}

	die( json_encode($data) );
}
add_action('wp_ajax_iron_import_default_data', 'iron_import_default_data');
add_action('wp_ajax_nopriv_iron_import_default_data', 'iron_import_default_data');


function iron_import_assign_templates() {

	$pages = get_pages();

	$data["error"] = false;
	$data["msg"] = "";

	$front_page = false;
	$blog_page = false;

	foreach($pages as $page) {

		$template = false;

		if($page->post_name == 'home') {

			$front_page = $page;
			
		}else if($page->post_name == 'news' || $page->post_name == 'blog') {

			$template = 'index.php';
			$blog_page = $page;

		}else if($page->post_name == 'events') {

			$template = 'archive-event.php';

		}else if($page->post_name == 'albums') {

			$template = 'archive-album.php';

		}else if($page->post_name == 'videos') {

			$template = 'archive-video.php';

		}else if($page->post_name == 'photos') {

			$template = 'archive-photo-album.php';

		}

		if($template !== false){
			update_post_meta( $page->ID, '_wp_page_template', sanitize_text_field($template) );
			$data['msg'] .= 'Assigned Page: ('.$page->post_title.') To Template: ('.$template.')<br>';

		}

	}


	$data['msg'] .= '<p style="color: green;"><strong>Templates Assigned Successfully!</strong></p>';

	$data['msg'] .= '<hr><p><strong>Assigning Static Pages...</strong></p>';


	// Use a static front page
	$errors = 0;
	if($front_page !== false) {

		update_option( 'page_on_front', $front_page->ID );
		update_option( 'show_on_front', 'page' );
		$data['msg'] .= 'Assigned: ('.$front_page->post_title.') As Static Front Page<br>';

	}else{
		$errors++;
	}

	// Set the blog page
	if($blog_page !== false) {

		update_option( 'page_for_posts', $blog_page->ID );
		$data['msg'] .= 'Assigned: ('.$blog_page->post_title.') As Static Blog Page<br>';

	}else{
		$errors++;
	}

	if($errors == 0)
		$data['msg'] .= '<p style="color: green;"><strong>Static Pages Assigned Successfully!</strong></p>';
	else
		$data['msg'] .= '<p style="color: red;"><strong>Failed Assigning Static Pages!</strong></p>';

	die(json_encode($data));
}

add_action('wp_ajax_iron_import_assign_templates', 'iron_import_assign_templates');
add_action('wp_ajax_nopriv_iron_import_assign_templates', 'iron_import_assign_templates');



/**
 * Adjusts content_width value for video post formats and attachment templates.
 *
 * @return void
 */

function iron_content_width ()
{
	global $content_width;

	if ( is_page() )
		$content_width = 1064;
	elseif ( 'album' == get_post_type() )
		$content_width = 693;
	elseif ( 'event' == get_post_type() )
		$content_width = 700;
}

add_action('template_redirect', 'iron_content_width');



/*
 * Register Widgetized Areas
 */

function iron_widgets_init() {

	global $iron_widgets;
	
	if ( function_exists('get_iron_option') ) :

		$params = array(
			  'before_widget' => '<aside id="%1$s" class="widget atoll %2$s">'
			, 'after_widget'  => '</aside>'
			, 'before_title'  => '<div class="panel__heading"><h3 class="widget-title">'
			, 'after_title'   => '</h3></div>'
		);

		$widget_areas = get_iron_option( 'widget_areas', null, array() );

		

		if ( ! empty($widget_areas) && is_array($widget_areas) )
		{
			ksort( $widget_areas );
			
			foreach ( $widget_areas as $w_id => $w_area )
			{
				$args = array(
					  'id'            => /*IRON_SIDEBAR_PREFIX .*/ $w_id
					, 'name'          => empty( $w_area['sidebar_name'] ) ? '' : $w_area['sidebar_name']
					, 'description'   => empty( $w_area['sidebar_desc'] ) ? '' : $w_area['sidebar_desc']
					, 'before_widget' => $params['before_widget']
					, 'after_widget'  => $params['after_widget']
					, 'before_title'  => $params['before_title']
					, 'after_title'   => $params['after_title']
				);

				register_sidebar( $args );
			}

		}

	endif;


	foreach($iron_widgets as $key => $widget) {

		register_widget($key);
	}
	
	unregister_widget('nmMailChimp');

}

add_action('widgets_init', 'iron_widgets_init');



/*
 * Swap Widget Semantics
 */

function iron_adjust_widget_areas ($params) {
	global $iron_widgets, $alternative_home;

	$params[0]['before_title'] = str_replace('%1$s', '', $params[0]['before_title']);

	if ( ( is_front_page() || is_page_template('page-home.php') || !empty($alternative_home) ) && did_action('get_footer') === 0 )
	{
		$params[0]['before_widget'] = str_replace('<aside', '<section', $params[0]['before_widget']);
		$params[0]['after_widget']  = str_replace('aside>', 'section>', $params[0]['after_widget']);
	} else {
		$params[0]['before_widget'] = str_replace(' atoll', '', $params[0]['before_widget']);
	}

	return $params;
}

add_filter('dynamic_sidebar_params', 'iron_adjust_widget_areas');



/*
 * Enqueue Theme Styles
 */

function iron_enqueue_styles() {

	if ( is_admin() || iron_is_login_page() ) return;

	global $wp_query, $post;

	// Styled by the theme
	wp_dequeue_style('contact-form-7');
	
	$protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_style('font-josefin', "$protocol://fonts.googleapis.com/css?family=Josefin+Sans:400,600,700", false, '', 'all' );
	wp_enqueue_style('font-opensans', "$protocol://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,600,600italic,700", false, '', 'all' );
	iron_enqueue_style('iron-fancybox', IRON_PARENT_URL.'/css/fancybox.css', false, '', 'all' );
	iron_enqueue_style('owl-carousel', IRON_PARENT_URL.'/css/owl.carousel.css', false, '', 'all' );
	iron_enqueue_style('owl-theme', IRON_PARENT_URL.'/css/owl.theme.css', false, '', 'all' );
	wp_enqueue_style('font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', false, '', 'all' );
	
	if(get_iron_option('menu_type') == 'classic-menu')
		iron_enqueue_style('iron-classic-menu', IRON_PARENT_URL.'/classic-menu/css/classic.css', false, '', 'all' );
	
	iron_enqueue_style('iron-master', IRON_CHILD_URL.'/style.css', false, '', 'all' );

	if (!empty($_SERVER['HTTP_USER_AGENT']) && preg_match('/(?i)msie [6-8]/',$_SERVER['HTTP_USER_AGENT']) )
		iron_enqueue_style('iron-msie', IRON_PARENT_URL.'/css/ie.css', array('iron-master'), '', 'all');

	$custom_styles_url = home_url('/').'?load=custom-style.css';

	if(is_home() && get_option('page_for_posts') != '') {

		$custom_styles_url .= '&post_id='.get_option('page_for_posts');

	}else if(is_front_page() && get_option('page_on_front') != '') {
	
		$custom_styles_url .= '&post_id='.get_option('page_on_front');
		
	}else if(function_exists('is_shop') && is_shop() && get_option('woocommerce_shop_page_id') != '') {
	
		$custom_styles_url .= '&post_id='.get_option('woocommerce_shop_page_id');
	
	}elseif($wp_query && !empty($wp_query->queried_object) && !empty($wp_query->queried_object->ID)) {
	
		$custom_styles_url .= '&post_id='.$wp_query->queried_object->ID;
		
	}
		
	wp_enqueue_style('custom-styles', $custom_styles_url, array('iron-master'), '', 'all' );

}

add_action('wp_enqueue_scripts', 'iron_enqueue_styles');


/*
 * Enqueue Theme Admin Styles
 */

function iron_enqueue_admin_styles() {

	iron_enqueue_style('iron-vc', IRON_PARENT_URL.'/admin/assets/css/vc.css', false, '', 'all' );
	iron_enqueue_style('iron-acf', IRON_PARENT_URL.'/admin/assets/css/acf.css', false, '', 'all' );
	

}
add_action('admin_enqueue_scripts', 'iron_enqueue_admin_styles' );


/*
 * Enqueue Theme Scripts
 */

function iron_enqueue_scripts() {

	if ( is_admin() || iron_is_login_page() ) return;

	if ( is_singular() && comments_open() && get_option('thread_comments') )
		wp_enqueue_script('comment-reply');
/*
	if ( is_singular() && get_iron_option('custom_social_actions') )
		wp_enqueue_script('addthis', '//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-51719dd0019cdf21', array(), null, true);
*/

	// HTML5 Shim
	if (!empty($_SERVER['HTTP_USER_AGENT']) && preg_match('/(?i)msie [6-8]/',$_SERVER['HTTP_USER_AGENT']) ) {
		$html5shim = '//html5shim.googlecode.com/svn/trunk/html5.js';
		wp_enqueue_script('html5shim', ( @fopen($html5shim, 'r') ? $html5shim : IRON_PARENT_URL . '/js/html5.js' ), array(), '3.6.2pre', false);
	}

/*
	if ( preg_match('/(?i)msie [6-8]/',$_SERVER['HTTP_USER_AGENT']) )
		wp_enqueue_script('respondjs', IRON_PARENT_URL.'/js/respond.min.js', array(), null, false);
*/

	if(get_iron_option('menu_type') == 'classic-menu')
		iron_enqueue_script('iron-classic-menu', IRON_PARENT_URL.'/classic-menu/js/classic.js', false, '', true );


	// VENDORS
	iron_enqueue_script('iron-utilities', IRON_PARENT_URL.'/js/utilities.min.js', array('jquery'), null, true);
	iron_enqueue_script('iron-plugins', IRON_PARENT_URL.'/js/plugins.all.min.js', array('jquery'), null, true);
	iron_enqueue_script('iron-parallax', IRON_PARENT_URL.'/js/jquery.parallax.js', array('jquery'), null, true);
	iron_enqueue_script('iron-twitter', IRON_PARENT_URL.'/js/twitter/jquery.tweet.min.js', array('jquery'), null, true);
	
	if(defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE && ICL_LANGUAGE_CODE != 'en') {
		
		iron_enqueue_script('iron-countdown-l10n', IRON_PARENT_URL.'/js/countdown-l10n/jquery.countdown-'.ICL_LANGUAGE_CODE.'.js', array('jquery'), null, true);
	}
	
	iron_enqueue_script('iron-main', IRON_PARENT_URL.'/js/main.js', array('jquery', 'iron-plugins'), null, true);

	wp_localize_script('iron-main', 'iron_vars', array(
		'theme_url' => IRON_PARENT_URL,
		'ajaxurl' => admin_url('admin-ajax.php').(defined('ICL_LANGUAGE_CODE') ? '?lang='.ICL_LANGUAGE_CODE : ''),
		'enable_nice_scroll' => get_iron_option('enable_nice_scroll') == "0" ? false : true,
		'enable_fixed_header' => get_iron_option('enable_fixed_header') == "0" ? false : true,
		'header_top_menu_hide_on_scroll' => get_iron_option('header_top_menu_hide_on_scroll'),
		'lightbox_transition' => get_iron_option('lightbox-transition'),
		'menu_position' => !empty($_GET["mpos"]) ? $_GET["mpos"] : get_iron_option('menu_position'),
		'menu_transition' => !empty($_GET["mtype"]) ? $_GET["mtype"] : get_iron_option('menu_transition'),
		'lightbox_transition' => get_iron_option('lightbox-transition'),
		'lang' => (defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : 'en'),
		'custom_js' => get_iron_option('custom_js'),
		'portfolio' => array(

			'slider_autoplay' => (bool)get_iron_option( 'portfolio_slider_autoplay'),
			'slider_stop_hover' => (bool)get_iron_option( 'portfolio_slider_stop_hover'),
			'slider_arrows' => (bool)get_iron_option( 'portfolio_slider_arrows'),
			'slider_slide_speed' => (bool)get_iron_option( 'portfolio_slider_slide_speed'),
			'slider_slide_speed' => (bool)get_iron_option( 'portfolio_slider_slide_speed'),
			
		)
	));

}


			
add_action('wp_enqueue_scripts', 'iron_enqueue_scripts');


/*
 * Enqueue Theme Admin Scripts
 */

function iron_enqueue_admin_scripts() {

	iron_enqueue_script('iron-admin-custom', IRON_PARENT_URL.'/admin/assets/js/custom.js', array('jquery'), null, true);
	iron_enqueue_script('iron-admin-vc', IRON_PARENT_URL.'/admin/assets/js/vc.js', array('jquery'), null, true);
	
	wp_localize_script('iron-admin-vc', 'iron_vars', array(
		'patterns_url' => IRON_PARENT_URL.'/admin/assets/img/vc/patterns/'
	));

}
add_action('admin_enqueue_scripts', 'iron_enqueue_admin_scripts' );



function iron_metadata_icons () {
	$output = array();

	if ( get_iron_option('meta_apple_mobile_web_app_title') ) :
		$output[] = '<meta name="apple-mobile-web-app-title" content="' . esc_attr( get_iron_option('meta_apple_mobile_web_app_title') ) . '">';
	endif;

	if ( get_iron_option('meta_favicon') ) :
		$output[] = '<link rel="shortcut icon" type="image/x-icon" href="' . esc_url( get_iron_option('meta_favicon') ) . '">';
	endif;

	if ( get_iron_option('meta_apple_touch_icon') ) :
		$output[] = '<link rel="apple-touch-icon-precomposed" href="' . esc_url( get_iron_option('meta_apple_touch_icon') ) . '">';
	endif;

	if ( get_iron_option('meta_apple_touch_icon_72x72') ) :
		$output[] = '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="' . esc_url( get_iron_option('meta_apple_touch_icon_72x72') ) . '">';
	endif;

	if ( get_iron_option('meta_apple_touch_icon_114x114') ) :
		$output[] = '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="' . esc_url( get_iron_option('meta_apple_touch_icon_114x114') ) . '">';
	endif;

	if ( get_iron_option('meta_apple_touch_icon_144x144') ) :
		$output[] = '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="' . esc_url( get_iron_option('meta_apple_touch_icon_144x144') ) . '">';
	endif;

	if ( ! empty($output) )
		echo "\n\t" . implode("\n\t", $output);
}

add_action('wp_head', 'iron_metadata_icons', 100);



 
function iron_upload_mimes ( $existing_mimes=array() ) {
 
    // add the file extension to the array
 
    $existing_mimes['ico'] = 'image/x-icon';
 
        // call the modified list of extensions
    return $existing_mimes;
 
}
add_filter('upload_mimes', 'iron_upload_mimes');


/**
 * Disable inline CSS injected by WordPress.
 *
 * Always apply your styles from an external file.
 */

add_filter('use_default_gallery_style', '__return_false');



/*
| -------------------------------------------------------------------
| Loading Dynamic Assets
| -------------------------------------------------------------------
| */

function iron_load_dynamic_assets() {

	if(is_admin() || iron_is_login_page()) return -1;

	if(!empty($_GET["load"])) {

		if($_GET["load"] == 'custom-style.css') {
			include_once(IRON_PARENT_DIR.'/css/custom-style.php');
			exit;
		}

	}
}
add_action( 'init', 'iron_load_dynamic_assets');


/*
| -------------------------------------------------------------------
| Enqueue Latest Script based on timestamp.
| This Avoids flushing browser cache
| -------------------------------------------------------------------
| */

function iron_enqueue_script($handle, $src, $deps = array(), $ver = false, $in_footer = false ) {

	$src_path = str_replace(get_template_directory_uri(), get_template_directory(), $src);
	$file_time = filemtime($src_path);
	$src = $src."?t=".$file_time;

	wp_enqueue_script($handle, $src, $deps, $ver, $in_footer);
}

/*
| -------------------------------------------------------------------
| Enqueue Latest Style based on timestamp.
| This Avoids flushing browser cache
| -------------------------------------------------------------------
| */

function iron_enqueue_style($handle, $src, $deps = array(), $ver = false, $media = "all") {

	$src_path = str_replace(get_template_directory_uri(), get_template_directory(), $src);
	$file_time = filemtime($src_path);
	$src = $src."?t=".$file_time;

	wp_enqueue_style($handle, $src, $deps, $ver, $media);
}
