<?php

add_action( 'init', 'register_cpt_event' );

function register_cpt_event() {

    $labels = array( 
        'name' => _x( 'Events', TB_EVENT_CPT ),
        'singular_name' => _x( 'Event', TB_EVENT_CPT ),
        'add_new' => _x( 'Add New', TB_EVENT_CPT ),
        'add_new_item' => _x( 'Add New Event', TB_EVENT_CPT ),
        'edit_item' => _x( 'Edit Event', TB_EVENT_CPT ),
        'new_item' => _x( 'New Event', TB_EVENT_CPT ),
        'view_item' => _x( 'View Event', TB_EVENT_CPT ),
        'search_items' => _x( 'Search Events', TB_EVENT_CPT ),
        'not_found' => _x( 'No events found', TB_EVENT_CPT ),
        'not_found_in_trash' => _x( 'No events found in Trash', TB_EVENT_CPT ),
        'parent_item_colon' => _x( 'Parent Event:', TB_EVENT_CPT ),
        'menu_name' => _x( 'Events', TB_EVENT_CPT ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        
        'supports' => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies' => array( TB_EVENT_TAX ),
        
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
		
		'menu_icon' => PARENT_URL . '/images/icons/event.png',
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( TB_EVENT_CPT, $args );
}

/*--------------------------TAXONOMY--------------------------*/
add_action( 'init', 'register_taxonomy_event_categories' );

function register_taxonomy_event_categories() {

    $labels = array( 
        'name' => _x( 'Event Categories', TB_EVENT_TAX ),
        'singular_name' => _x( 'Event Category', TB_EVENT_TAX ),
        'search_items' => _x( 'Search Event Categories', TB_EVENT_TAX ),
        'popular_items' => _x( 'Popular Event Categories', TB_EVENT_TAX ),
        'all_items' => _x( 'All Event Categories', TB_EVENT_TAX ),
        'parent_item' => _x( 'Parent Event Category', TB_EVENT_TAX ),
        'parent_item_colon' => _x( 'Parent Event Category:', TB_EVENT_TAX ),
        'edit_item' => _x( 'Edit Event Category', TB_EVENT_TAX ),
        'update_item' => _x( 'Update Event Category', TB_EVENT_TAX ),
        'add_new_item' => _x( 'Add New Event Category', TB_EVENT_TAX ),
        'new_item_name' => _x( 'New Event Category', TB_EVENT_TAX ),
        'separate_items_with_commas' => _x( 'Separate event categories with commas', TB_EVENT_TAX ),
        'add_or_remove_items' => _x( 'Add or remove event categories', TB_EVENT_TAX ),
        'choose_from_most_used' => _x( 'Choose from the most used event categories', TB_EVENT_TAX ),
        'menu_name' => _x( 'Event Categories', TB_EVENT_TAX ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'show_admin_column' => false,
        'hierarchical' => true,

        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( TB_EVENT_TAX, array( TB_EVENT_CPT ), $args );
}

/*-----------------------CUSTOM COLUMNS-----------------------*/
add_filter( 'manage_edit-' . TB_EVENT_CPT . '_columns', 'set_custom_edit_event_columns' );
add_action( 'manage_' . TB_EVENT_CPT . '_posts_custom_column' , 'custom_event_column', 10, 2 );

function set_custom_edit_event_columns($columns) {
	$columns = array(
		"cb"			=>	"<input type=\"checkbox\" />",
		"title"			=>	__("Name", 'grace'),
		"_tb_start_date"		=>	__("Starts", 'grace'),
		"_tb_start_time"		=>	__("Time", 'grace'),
		"_tb_venue"				=>	__("Venue", 'grace'),
		"_tb_address"			=>	__("Address", 'grace'),
		"_tb_location"			=>	__("Location", 'grace'),
	);

	return $columns;
}

function custom_event_column( $column, $post_id ) {
    switch ( $column ) {

        case '_tb_address' :
            echo get_post_meta( $post_id , '_tb_address' , true );
            break;

        case '_tb_location' :
            echo get_post_meta( $post_id , '_tb_location' , true );
            break;

        case '_tb_venue' :
            echo get_post_meta( $post_id , '_tb_venue' , true );
            break;
        case '_tb_start_date' :
			$startDate = get_post_meta( $post_id , '_tb_start_date' , true );
			if ($startDate) {
				echo date_i18n(get_option('date_format'), $startDate);
			}
            
            break;

        case '_tb_start_time' :
            echo get_post_meta( $post_id , '_tb_start_time' , true );
            break;
    }
}

?>