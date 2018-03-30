<?php

if(is_admin() && isset($_GET['activated']) && $pagenow == "themes.php") {

	global $dirname;

	if(get_option($dirname.'_theme_auto_install') !== '1') {
	

		/////////////////////////////////////// Delete Default Content ///////////////////////////////////////	

		// Default Posts
		$post = get_page_by_path('hello-world', OBJECT, 'post');
		if($post) { wp_delete_post($post->ID,true); }

		// Default Pages		
		$post = get_page_by_path('sample-page', OBJECT, 'page');
		if($post) { wp_delete_post($post->ID,true); }
		
				
		/////////////////////////////////////// Create Attachments ///////////////////////////////////////	


		require_once(ABSPATH . 'wp-admin/includes/file.php');
		require_once(ABSPATH . 'wp-admin/includes/media.php');
		require(ABSPATH . 'wp-admin/includes/image.php');		
		
		$filename1 = get_template_directory_uri().'/lib/images/placeholder.png';
		$description1 = 'Image Description 1';
		media_sideload_image($filename1, 0, $description1);
		$last_attachment1 = $wpdb->get_row($query = "SELECT * FROM {$wpdb->prefix}posts ORDER BY ID DESC LIMIT 1", ARRAY_A);
		$attachment_id1 = $last_attachment1['ID'];
		
		
		/////////////////////////////////////// Create Pages ///////////////////////////////////////	


		/*************************************** Homepage ***************************************/	
		
		$new_page_title = 'Homepage';
		$new_page_content = 
'[threefourths]

[slider width="662" height="450" margins="0,0,20,0"]

[two][image url="'.wp_get_attachment_url($attachment_id1).'" width="324" height="215" caption="New Men T-Shirts" caption_link="#"][/two]

[two_last][image url="'.wp_get_attachment_url($attachment_id1).'" width="324" height="215" caption="New Dresses" caption_link="#"][/two_last]

[/threefourths]

[onefourth_last]

[image url="'.wp_get_attachment_url($attachment_id1).'" width="221" height="480" margins="0,0,20,0" caption="New Mens Jackets" caption_link="#"][/one]

[small_clear]

[image url="'.wp_get_attachment_url($attachment_id1).'" width="221" height="185" caption="Kids Clothing" caption_link="#"]

[/one]

[/onefourth_last]

[clear]

[text]Featured Products[/text]

[featured_products per_page="5" columns="5"]

[clear]

[text]Recent Products[/text]

[recent_products per_page="5" columns="5"]';
		$page_check = get_page_by_title($new_page_title);
		$new_page = array(
			'post_type' => 'page',
			'post_title' => $new_page_title,
			'post_content' => $new_page_content,
			'post_status' => 'publish',
			'post_author' => 1,
			'comment_status' => 'closed'
		);
		if(!isset($page_check->ID)){
			$new_page_id = wp_insert_post($new_page);
			update_option('page_on_front', $new_page_id);
			update_option('show_on_front', 'page');
			update_post_meta($new_page_id, $dirname.'_layout', 'fullwidth');
			update_post_meta($new_page_id, $dirname.'_title', 'Hide');
			update_post_meta($new_page_id, $dirname.'_breadcrumbs', 'Hide');	
		}
		
		
		/*************************************** Register Page ***************************************/	
		
		$new_page_title = 'Register';
		$new_page_content = '';
		$page_check = get_page_by_title($new_page_title);
		$new_page = array(
			'post_type' => 'page',
			'post_title' => $new_page_title,
			'post_content' => $new_page_content,
			'post_status' => 'publish',
			'post_author' => 1,
			'comment_status' => 'closed'
		);
		if(!isset($page_check->ID)){
			$new_page_id = wp_insert_post($new_page);
			update_post_meta($new_page_id, '_wp_page_template', 'register.php');
		}
	

		/*************************************** Blog Page ***************************************/	
		
		$new_page_title = 'Blog Page';
		$new_page_content = '[posts]';
		$page_check = get_page_by_title($new_page_title);
		$new_page = array(
			'post_type' => 'page',
			'post_title' => $new_page_title,
			'post_content' => $new_page_content,
			'post_status' => 'publish',
			'post_author' => 1,
			'comment_status' => 'closed'
		);
		if(!isset($page_check->ID)){
			$new_page_id = wp_insert_post($new_page);
		}
		
			
		/*************************************** Contact Page ***************************************/	
		
		$new_page_title = 'Contact Page';
		$new_page_content = '[contact email="youraddress@email.com"]';
		$page_check = get_page_by_title($new_page_title);
		$new_page = array(
			'post_type' => 'page',
			'post_title' => $new_page_title,
			'post_content' => $new_page_content,
			'post_status' => 'publish',
			'post_author' => 1,
			'comment_status' => 'closed'
		);
		if(!isset($page_check->ID)){
			$new_page_id = wp_insert_post($new_page);
		}
		

		/////////////////////////////////////// Create Products ///////////////////////////////////////	


		/*************************************** Product Page 1 ***************************************/	

		$new_page_title = 'Product 1';
		$new_page_content =
'Assertively fashion visionary e-business via installed base technologies. Appropriately reconceptualize error-free initiatives with value-added customer service. Monotonectally syndicate impactful core competencies via user. 
	
Rapidiously initiate premier functionalities and functionalized catalysts for change. Credibly incentivize just in time niche markets through wireless systems. Appropriately envisioneer distributed collaboration and idea-sharing with viral communities. Uniquely maximize next-generation innovation before multifunctional catalysts for change. Monotonectally integrate professional technologies vis-a-vis top-line leadership.';
		$page_check = get_page_by_title($new_page_title, '', 'product');
		$new_page = array(
			'post_type' => 'product',
			'post_title' => $new_page_title,
			'post_content' => $new_page_content,
			'post_status' => 'publish',
			'post_author' => 1,
			'comment_status' => 'open',
			'post_excerpt' => 'Rapidiously initiate premier functionalities and functionalized catalysts for change. Credibly incentivize just in time niche markets through wireless systems. Appropriately envisioneer distributed collaboration and idea-sharing with viral communities. Uniquely maximize next-generation innovation before multifunctional catalysts for change. Monotonectally integrate professional technologies vis-a-vis top-line leadership.'
		);
		if(!isset($page_check->ID)){
			$new_page_id = wp_insert_post($new_page);
			update_post_meta($new_page_id, '_visibility', 'visible');
			update_post_meta($new_page_id, '_sku', 'WZ4500');
			update_post_meta($new_page_id, '_price', '109.99');
			update_post_meta($new_page_id, '_regular_price', '139.99');
			update_post_meta($new_page_id, '_sale_price', '109.99');
			update_post_meta($new_page_id, '_featured', 'yes');
			set_post_thumbnail($new_page_id, $attachment_id1);
		}
		
		
		/*************************************** Product Page 2 ***************************************/	

		$new_page_title = 'Product 2';
		$new_page_content =
'Assertively fashion visionary e-business via installed base technologies. Appropriately reconceptualize error-free initiatives with value-added customer service. Monotonectally syndicate impactful core competencies via user. 
	
Rapidiously initiate premier functionalities and functionalized catalysts for change. Credibly incentivize just in time niche markets through wireless systems. Appropriately envisioneer distributed collaboration and idea-sharing with viral communities. Uniquely maximize next-generation innovation before multifunctional catalysts for change. Monotonectally integrate professional technologies vis-a-vis top-line leadership.';
		$page_check = get_page_by_title($new_page_title, '', 'product');
		$new_page = array(
			'post_type' => 'product',
			'post_title' => $new_page_title,
			'post_content' => $new_page_content,
			'post_status' => 'publish',
			'post_author' => 1,
			'comment_status' => 'open',
			'post_excerpt' => 'Rapidiously initiate premier functionalities and functionalized catalysts for change. Credibly incentivize just in time niche markets through wireless systems. Appropriately envisioneer distributed collaboration and idea-sharing with viral communities. Uniquely maximize next-generation innovation before multifunctional catalysts for change. Monotonectally integrate professional technologies vis-a-vis top-line leadership.'
		);
		if(!isset($page_check->ID)){
			$new_page_id = wp_insert_post($new_page);
			update_post_meta($new_page_id, '_visibility', 'visible');
			update_post_meta($new_page_id, '_sku', 'PE1000');
			update_post_meta($new_page_id, '_price', '19.99');
			update_post_meta($new_page_id, '_regular_price', '19.99');
			update_post_meta($new_page_id, '_featured', 'yes');
			set_post_thumbnail($new_page_id, $attachment_id1);
		}
			

		/////////////////////////////////////// Create Slides ///////////////////////////////////////	

	
		/*************************************** Slide 1 ***************************************/	
		
		$new_page_title = 'Image Slide';
		$new_page_content = '';
		$page_check = get_page_by_title($new_page_title, '', 'slide');
		$new_page = array(
			'post_type' => 'slide',
			'post_title' => $new_page_title,
			'post_content' => $new_page_content,
			'post_status' => 'publish',
			'post_author' => 1,
			'comment_status' => 'closed'
		);
		if(!isset($page_check->ID)){
			$new_page_id = wp_insert_post($new_page);
			update_post_meta($new_page_id, $dirname.'_slide_caption_link_text', 'Click Here &raquo;');
			update_post_meta($new_page_id, $dirname.'_slide_caption_link', '#');
			update_post_meta($new_page_id, $dirname.'_slide_caption_position', 'Bottom Left Overlay');
			set_post_thumbnail($new_page_id, $attachment_id1);
		}


		/*************************************** Slide 2 ***************************************/	
				
		$new_page_title = 'Video Slide';
		$new_page_content = '';
		$page_check = get_page_by_title($new_page_title, '', 'slide');
		$new_page = array(
			'post_type' => 'slide',
			'post_title' => $new_page_title,
			'post_content' => $new_page_content,
			'post_status' => 'publish',
			'post_author' => 1,
			'comment_status' => 'closed'
		);
		if(!isset($page_check->ID)){
			$new_page_id = wp_insert_post($new_page);
			update_post_meta($new_page_id, $dirname.'_slide_title', true);
			update_post_meta($new_page_id, $dirname.'_slide_video', 'http://vimeo.com/36006533');
			set_post_thumbnail($new_page_id, $attachment_id1);
		}


		/////////////////////////////////////// Create Navigation ///////////////////////////////////////	


		/*************************************** Header Nav ***************************************/	
		
		$menu_name = 'Header';
		$menu_location = 'header-nav';
		$menu_exists = wp_get_nav_menu_object($menu_name);			
		if(!$menu_exists) {
			$menu_id = wp_create_nav_menu($menu_name);
			wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' => 'Contact',
				'menu-item-object' => 'page',
				'menu-item-object-id' => get_page_by_path('contact-page')->ID,
				'menu-item-type' => 'post_type',
				'menu-item-status' => 'publish')
			);
			if(!has_nav_menu($menu_location)) {
				$locations = get_theme_mod('nav_menu_locations');
				$locations[$menu_location] = $menu_id;
				set_theme_mod('nav_menu_locations', $locations);
			}
		}     
		   
		   
		/*************************************** Body Nav ***************************************/	
		
		$menu_name = 'Body';
		$menu_location = 'body-nav';
		$menu_exists = wp_get_nav_menu_object($menu_name);
		if(!$menu_exists) {
			$menu_id = wp_create_nav_menu($menu_name);
			wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' => 'Home',
				'menu-item-classes' => 'home',
				'menu-item-url' => home_url('/'), 
				'menu-item-status' => 'publish')
			);
			wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' => 'Shop',
				'menu-item-classes' => '',
				'menu-item-url' => home_url('/shop'), 
				'menu-item-status' => 'publish')
			);    
			wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' => 'Blog',
				'menu-item-object' => 'page',
				'menu-item-object-id' => get_page_by_path('blog-page')->ID,
				'menu-item-description' => 'An example of a blog page.',
				'menu-item-type' => 'post_type',
				'menu-item-status' => 'publish')
			);			                                      		
			if(!has_nav_menu($menu_location)) {
				$locations = get_theme_mod('nav_menu_locations');
				$locations[$menu_location] = $menu_id;
				set_theme_mod('nav_menu_locations', $locations);
			}	
		}    

		
		/////////////////////////////////////// WooCommerce Defaults ///////////////////////////////////////	


		add_action('init', 'gp_woocommerce_defaults', 1);		
		function gp_woocommerce_defaults() {		
			update_option('shop_catalog_image_size', array('width' => 200, 'height' => 200, 'crop' => 1));
			update_option('shop_thumbnail_image_size', array('width' => 90, 'height' => 90, 'crop' => 1)); 
			update_option('shop_single_image_size', array('width' => 300, 'height' => 300, 'crop' => 1));
			update_option('woocommerce_frontend_css', 1);
			update_option('woocommerce_enable_lightbox', 1);
		}	
		
			
	}
			
	update_option($dirname.'_theme_auto_install', '1');
		
}	

?>