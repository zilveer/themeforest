<?php
$pagesArray = array();

if (is_admin()) {

/**
*
* Home page
*
**/


	$new_page_title = 'Home Page';
	$new_page_content = 'This is the page content';
	$new_page_template = 'homepage.php'; //ex. template-custom.php. Leave blank if you don't want a custom page template.
	//don't change the code bellow, unless you know what you're doing
	$page_check = get_page_by_title($new_page_title);
	$new_page = array(
		'post_type' => 'page',
		'post_title' => $new_page_title,
		'post_content' => $new_page_content,
		'post_status' => 'publish',
		'post_author' => 1,
		);
	if(!isset($page_check->ID)){
		$new_page_id = wp_insert_post($new_page);
		if(!empty($new_page_template)){
			update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
			update_option( 'page_on_front', $new_page_id );
			update_option( 'show_on_front', 'page' );
			update_post_meta( $new_page_id, 'nav_position', 'center' );
			update_post_meta( $new_page_id, 'section_home', 'section_home_1' );
			update_post_meta( $new_page_id, 'section_footer', 'disabled' );
		}
	}


/**
*
* Blog
*
**/



	$new_page_title = 'Blog';
	$new_page_content = 'This is the page content';
	$new_page_template = 'blog.php'; //ex. template-custom.php. Leave blank if you don't want a custom page template.
	//don't change the code bellow, unless you know what you're doing
	$page_check = get_page_by_title($new_page_title);
	$new_page = array(
		'post_type' => 'page',
		'post_title' => $new_page_title,
		'post_content' => $new_page_content,
		'post_status' => 'publish',
		'post_author' => 1,
		);
	if(!isset($page_check->ID)){
		$new_page_id = wp_insert_post($new_page);
		if(!empty($new_page_template)){
			update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
		}
		$pagesArray[] = array('id'=>$new_page_id, 'name'=>$new_page_title);
	}


/**
*
* Food menu
*
**/



	$new_page_title = 'Food Menu';
	$new_page_content = 'This is the page content';
	$new_page_template = 'menu.php'; //ex. template-custom.php. Leave blank if you don't want a custom page template.
	//don't change the code bellow, unless you know what you're doing
	$page_check = get_page_by_title($new_page_title);
	$new_page = array(
		'post_type' => 'page',
		'post_title' => $new_page_title,
		'post_content' => $new_page_content,
		'post_status' => 'publish',
		'post_author' => 1,
		);
	if(!isset($page_check->ID)){
		$new_page_id = wp_insert_post($new_page);
		if(!empty($new_page_template)){
			update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
		}
		$pagesArray[] = array('id'=>$new_page_id, 'name'=>$new_page_title);
	}


/**
*
* About
*
**/



	$new_page_title = 'About';
	$new_page_content = 'This is the page content';
	$new_page_template = 'restaurant.php'; //ex. template-custom.php. Leave blank if you don't want a custom page template.
	//don't change the code bellow, unless you know what you're doing
	$page_check = get_page_by_title($new_page_title);
	$new_page = array(
		'post_type' => 'page',
		'post_title' => $new_page_title,
		'post_content' => $new_page_content,
		'post_status' => 'publish',
		'post_author' => 1,
		);
	if(!isset($page_check->ID)){
		$new_page_id = wp_insert_post($new_page);
		if(!empty($new_page_template)){
			update_post_meta($new_page_id, '_wp_page_template', $new_page_template);

		}
		$pagesArray[] = array('id'=>$new_page_id, 'name'=>$new_page_title);
	}


/**
*
* Portfolio
*
**/



	$new_page_title = 'Portfolio';
	$new_page_content = 'This is the page content';
	$new_page_template = 'portfolio.php'; //ex. template-custom.php. Leave blank if you don't want a custom page template.
	//don't change the code bellow, unless you know what you're doing
	$page_check = get_page_by_title($new_page_title);
	$new_page = array(
		'post_type' => 'page',
		'post_title' => $new_page_title,
		'post_content' => $new_page_content,
		'post_status' => 'publish',
		'post_author' => 1,
		);
	if(!isset($page_check->ID)){
		$new_page_id = wp_insert_post($new_page);
		if(!empty($new_page_template)){
			update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
		}
		$pagesArray[] = array('id'=>$new_page_id, 'name'=>$new_page_title);
	}


/**
*
* Reservation
*
**/



	$new_page_title = 'Reservation';
	$new_page_content = 'This is the page content';
	$new_page_template = 'reservation.php'; //ex. template-custom.php. Leave blank if you don't want a custom page template.
	//don't change the code bellow, unless you know what you're doing
	$page_check = get_page_by_title($new_page_title);
	$new_page = array(
		'post_type' => 'page',
		'post_title' => $new_page_title,
		'post_content' => $new_page_content,
		'post_status' => 'publish',
		'post_author' => 1,
		);
	if(!isset($page_check->ID)){
		$new_page_id = wp_insert_post($new_page);
		if(!empty($new_page_template)){
			update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
			$options = array('booking-page' => $new_page_id, 'party-size' =>'', 'success-message' =>'', 'time-format' =>'', 'i8n' => '');
			update_option('rtb-settings', $options);

		}
		$pagesArray[] = array('id'=>$new_page_id, 'name'=>$new_page_title);
	}


/**
*
* Contact
*
**/

	$new_page_title = 'Contact';
	$new_page_content = '[vc_row][vc_column width="1/3"][vc_column_text]
<h3>Information</h3>
Integer congue tellus laoreet lectus iaculis, sit amet adipiscing elit lacinia. Integer eleifend sapien ut justo tristique, in adipiscing est sagittis.
<div></div>
[/vc_column_text][vc_column_text]
<h3>Check us on</h3>
<div></div>
[/vc_column_text][social][/vc_column][vc_column width="1/3"][vc_row_inner][vc_column_inner width="1/2"][vc_column_text]
<div>
<h3>Address</h3>
<address>Berg Restaurant
Armii Krajowej 17
58-100 Swidnica</address></div>
[/vc_column_text][vc_column_text]Berg Restaurant
Armii Krajowej 17
58-100 Swidnica[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]
<h3>Contact</h3>
<a href="http://192.168.1.233/berg/contact.html#">restaurant@berg.com</a>
<a href="tel:+48889889889">+48 889 889 889</a>
<a href="tel:+48889889889">+48 889 888 860</a>[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/3"][vc_column_text]
<h3>Contact us</h3>
[/vc_column_text][vc_column_text]Activate <strong>Contact Form 7</strong> plugin and insert your form shortcode here.[/vc_column_text][/vc_column][/vc_row]';
	$new_page_template = 'contact.php'; //ex. template-custom.php. Leave blank if you don't want a custom page template.
	//don't change the code bellow, unless you know what you're doing
	$page_check = get_page_by_title($new_page_title);
	$new_page = array(
		'post_type' => 'page',
		'post_title' => $new_page_title,
		'post_content' => $new_page_content,
		'post_status' => 'publish',
		'post_author' => 1,
		);

	if (!isset($page_check->ID)) {
		$new_page_id = wp_insert_post($new_page);

		if (!empty($new_page_template)) {
			update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
		}

		$pagesArray[] = array('id'=>$new_page_id, 'name'=>$new_page_title);
	}

	/**
	*
	* Navigation
	*
	**/

	$menuname = 'Navigation';
	$menulocation = 'primary';
	// Does the menu exist already?
	$menu_exists = wp_get_nav_menu_object( $menuname );

	// If it doesn't exist, let's create it.
	if( !$menu_exists){
		$menu_id = wp_create_nav_menu($menuname);

		foreach($pagesArray as $page) {
			wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-object-id'	=> $page['id'],
				'menu-item-parent-id'	=> 0,
				'menu-item-object'		=> 'page',
				'menu-item-type'		=> 'post_type',
				'menu-item-status'		=> 'publish'
				)
			);		
		}

		if( !has_nav_menu( $menulocation ) ){
			set_theme_mod('nav_menu_locations', array('primary'=>$menu_id) );
		}
	}

	$menumobilename = 'Mobile Navigation';
	$menumobilelocation = 'mobile';
	// Does the menu exist already?
	$menu_mobile_exists = wp_get_nav_menu_object( $menumobilename );

	// If it doesn't exist, let's create it.
	if( !$menu_mobile_exists){
		$menu_id = wp_create_nav_menu($menumobilename);

		foreach($pagesArray as $page) {
			wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-object-id'	=> $page['id'],
				'menu-item-parent-id'	=> 0,
				'menu-item-object'		=> 'page',
				'menu-item-type'		=> 'post_type',
				'menu-item-status'		=> 'publish'
				)
			);		
		}

		if( !has_nav_menu( $menumobilelocation ) ){
			$location = get_theme_mod('nav_menu_locations');
			$location['mobile'] = $menu_id;
			set_theme_mod('nav_menu_locations', $location );
		}
	}


	$new_page_id = berg_create_page('terms', 'berg_terms_page_id', __('Terms', 'BERG'), '', 0, '');

	$menuwoocommercename = 'WooCommerce Navigation';
	$menuwoocommercelocation = 'woocommerce';
	// Does the menu exist already?
	$menu_woocommerce_exists = wp_get_nav_menu_object( $menuwoocommercename );

	// If it doesn't exist, let's create it.
	if (!$menu_woocommerce_exists) {
		$menu_id = wp_create_nav_menu($menuwoocommercename);

		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-object-id'	=> $new_page_id,
			'menu-item-parent-id'	=> 0,
			'menu-item-object'		=> 'page',
			'menu-item-type'		=> 'post_type',
			'menu-item-status'		=> 'publish'
			)
		);

		if (!has_nav_menu($menuwoocommercelocation)) {
			$location = get_theme_mod('nav_menu_locations');
			$location['woocommerce'] = $menu_id;
			set_theme_mod('nav_menu_locations', $location);
		}
	}
}

function berg_create_page($slug, $option, $page_title = '', $page_content = '', $post_parent = 0, $page_name) {
	global $wpdb;

	$option_value = get_option($option);

	if ($option_value > 0 && get_post($option_value)) {
		return;
	}

	$page_found = $wpdb->get_var($wpdb->prepare("SELECT ID FROM " . $wpdb->posts . " WHERE post_name = %s LIMIT 1;", $slug));

	if ($page_found) {
		if (!$option_value) {
			update_option($option, $page_found);
		}

		return;
	}

	$page_data = array(
		'post_status' 		=> 'publish',
		'post_type' 		=> 'page',
		'post_author' 		=> 1,
		'post_name' 		=> $slug,
		'post_title' 		=> $page_title,
		'post_content' 		=> $page_content,
		'post_parent' 		=> $post_parent,
		'comment_status' 	=> 'closed'
	);

	//Add page
	$page_id = wp_insert_post($page_data);
	update_option($option, $page_id);
	//Set page template
	update_post_meta($page_id, '_wp_page_template', $page_name);

	return $page_id;
}
