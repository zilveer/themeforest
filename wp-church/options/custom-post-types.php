<?php
/**
 * registering the custom post types
 *
 */

function lets_define_custom_posttypes() {

	$lets_make_posttype_array = array(
		'slideshow' => array(
				'singular' => 'slideshow',
				'plural' => 'slideshows',
				'description' => 'Slideshow post type',
				'supports' => array('title','editor','thumbnail'),
				'show_men' => true,
				'show_nav' => false,
				'make_categories' => false,
				'menu_position' => 51,
				'taxonomy' => '',
		),
		'calendar' => array(
				'singular' => 'calendar',
				'plural' => 'calendars',
				'description' => 'Calendar post types',
				'supports' => array('title','editor','thumbnail'),
				'show_men' => true,
				'show_nav' => true,
				'make_categories' => false,
				'menu_position' => 52,
				'taxonomy' => '',
		),
		'utility' => array(
				'singular' => 'group',
				'plural' => 'group',
				'description' => 'Group functions',
				'supports' => array('title','editor','thumbnail'),
				'show_men' => true,
				'show_nav' => true,
				'make_categories' => true,
				'menu_position' => 53,
				'taxonomy' => 'groups',
		),
		'gallery' => array(
				'singular' => 'verse',
				'plural' => 'verses',
				'description' => 'verses functions',
				'supports' => array('title'),
				'show_men' => true,
				'show_nav' => false,
				'make_categories' => false,
				'menu_position' => 54,
				'taxonomy' => '',
		),
		'album' => array(
				'singular' => 'message',
				'plural' => 'messages',
				'description' => 'Message functions',
				'supports' => array('title','editor','thumbnail','comments'),
				'show_men' => true,
				'show_nav' => true,
				'make_categories' => true,
				'menu_position' => 55,
				'taxonomy' => 'messagetypes',
		),
		'member' => array(
				'singular' => 'member',
				'plural' => 'members',
				'description' => 'Member functions',
				'supports' => array('title','editor','thumbnail'),
				'show_men' => true,
				'show_nav' => true,
				'make_categories' => false,
				'menu_position' => 56,
				'taxonomy' => '',
		),
		'link' => array(
				'singular' => 'link',
				'plural' => 'link',
				'description' => 'Link functions',
				'supports' => array('title','editor','thumbnail'),
				'show_men' => true,
				'show_nav' => false,
				'make_categories' => false,
				'menu_position' => 57,
				'taxonomy' => '',
		)
	);
	return apply_filters( 'lets_define_custom-posttypes', $lets_make_posttype_array );
}


add_action('init', 'lets_create_types');


function lets_create_types() {
	foreach ( lets_define_custom_posttypes() as $field ) {	
		$labels = array(
    		'name' => _x(ucfirst($field['plural']), 'post type general name'),
    		'singular_name' => _x(ucfirst($field['singular']), 'post type singular name'),
    		'add_new' => _x('Add New', ucfirst($field['singular'])),
    		'add_new_item' => __('Add New ' . ucfirst($field['singular'])),
    		'edit_item' => __('Edit ' . ucfirst($field['singular'])),
    		'new_item' => __('New ' . ucfirst($field['singular'])),
    		'view_item' => __('View ' . ucfirst($field['singular'])),
    		'search_items' => __('Search ' . ucfirst($field['singular'])),
    		'not_found' =>  __('No ' . ucfirst($field['plural']) .  ' found'),
    		'not_found_in_trash' => __('No ' . ucfirst($field['plural']) . ' found in Trash'), 
    		'parent_item_colon' => ''
  		);
  		
  		$args = array(
    		'labels' => $labels, 
    		'description' => $field['description'],
    		'menu_icon' => get_bloginfo('template_url'). '/images/' . $field['singular'] . '.png',
    		'public' => true,  
			'show_ui' => true, 		
			'publicly_queryable' => true,		
			'exclude_from_search' => false, 
			'show_in_nav_menus' => $field['show_nav'], 
			'can_export' => true, 
			'hierarchical' => true, 
			'show_in_menu' => $field['show_men'], 
  			'menu_position' => $field['menu_position'],
			'supports' => $field['supports'],	
    		'query_var' => true,
    		'rewrite' => true,
    		'capability_type' => 'post', 
    		'has_archive' => 'true'
  		); 	 		
  		register_post_type($field['plural'],$args);
	}
}


add_filter('post_updated_messages', 'lets_make_messages');
function lets_make_messages( $messages ) {
	global $post, $post_ID, $netlabs_post_types; 
	foreach ( lets_define_custom_posttypes() as $field ) {	
  		$messages[$field['plural']] = array(
    		0 => '', 
    		1 => sprintf( __(ucfirst($field['singular']) . ' updated. <a href="%s">View ' . ucfirst($field['singular']) . '</a>'), esc_url( get_permalink($post_ID) ) ),
    		2 => __('Custom field updated.'),
    		3 => __('Custom field deleted.'),
    		4 => __(ucfirst($field['singular']) . ' updated.'),
    		5 => isset($_GET['revision']) ? sprintf( __(ucfirst($field['singular']) . ' restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    		6 => sprintf( __(ucfirst($field['singular']) . ' published. <a href="%s">View ' . ucfirst($field['singular']) . '</a>'), esc_url( get_permalink($post_ID) ) ),
    		7 => __(ucfirst($field['singular']) . ' saved.'),
    		8 => sprintf( __(ucfirst($field['singular']) . ' submitted. <a target="_blank" href="%s">Preview ' . ucfirst($field['singular']) . '</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    		9 => sprintf( __(ucfirst($field['singular']) . ' scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview ' . ucfirst($field['singular']) . '</a>'),
      		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    		10 => sprintf( __(ucfirst($field['singular']) . ' draft updated. <a target="_blank" href="%s">Preview ' . ucfirst($field['singular']) . '</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  		); 		
  		return $messages;	
	}
}


// hook into the init action and call create_book_taxonomies() when it fires
add_action( 'init', 'lets_create_taxonomies', 0 );


function lets_create_taxonomies() {

	foreach ( lets_define_custom_posttypes() as $field ) {	
	
		if ($field['make_categories'] == true) {
	
			$labels = array(
				'name' => _x( ucfirst($field['singular']) . ' categories', 'taxonomy general name' ),
				'singular_name' => _x( ucfirst($field['singular'])  . ' category', 'taxonomy singular name' ),
				'search_items' =>  __( 'Search ' . ucfirst($field['singular']) . ' categories' ),
				'all_items' => __( 'All ' . ucfirst($field['singular']) . ' categories' ),
				'parent_item' => __( 'Parent ' . ucfirst($field['singular']) . ' category' ),
				'parent_item_colon' => __( 'Parent ' . ucfirst($field['singular']) . ' category' ),
				'edit_item' => __( 'Edit ' . ucfirst($field['singular']) . ' category' ),
				'update_item' => __( 'Update' . ucfirst($field['singular']) . ' category' ),
				'add_new_item' => __( 'Add New ' . ucfirst($field['singular']) . ' category' ),
				'new_item_name' => __( 'New ' . ucfirst($field['singular']) . ' category Name' ),
			);
		
			register_taxonomy( $field['taxonomy'] , array( $field['plural'] ), array(
				'hierarchical' => true,
				'labels' => $labels, /* NOTICE: Here is where the $labels variable is used */
				'show_ui' => true,
				'query_var' => true,
				'show_in_nav_menus' => true,
			));

		}
	}
}


?>