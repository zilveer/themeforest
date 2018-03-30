<?php

add_action( 'init', 'register_cpt_church' );

function register_cpt_church() {

    $labels = array( 
        'name' => _x( 'Churches', TB_CHURCH_CPT ),
        'singular_name' => _x( 'Church', TB_CHURCH_CPT ),
        'add_new' => _x( 'Add New', TB_CHURCH_CPT ),
        'add_new_item' => _x( 'Add New Church', TB_CHURCH_CPT ),
        'edit_item' => _x( 'Edit Church', TB_CHURCH_CPT ),
        'new_item' => _x( 'New Church', TB_CHURCH_CPT ),
        'view_item' => _x( 'View Church', TB_CHURCH_CPT ),
        'search_items' => _x( 'Search Churches', TB_CHURCH_CPT ),
        'not_found' => _x( 'No churches found', TB_CHURCH_CPT ),
        'not_found_in_trash' => _x( 'No churches found in Trash', TB_CHURCH_CPT ),
        'parent_item_colon' => _x( 'Parent Church:', TB_CHURCH_CPT ),
        'menu_name' => _x( 'Churches', TB_CHURCH_CPT ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
		
		'menu_icon' => PARENT_URL . '/images/icons/church.png',
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( TB_CHURCH_CPT, $args );
}

/*-----------------------CUSTOM COLUMNS-----------------------*/
add_filter( 'manage_edit-' . TB_CHURCH_CPT . '_columns', 'set_custom_edit_church_columns' );
add_action( 'manage_' . TB_CHURCH_CPT . '_posts_custom_column' , 'custom_church_column', 10, 2 );

function set_custom_edit_church_columns($columns) {
	$columns = array(
		"cb"			=>	"<input type=\"checkbox\" />",
		"title"			=>	__("Name", 'grace'),
		"_tb_address"			=>	__("Address", 'grace'),
		"_tb_phone"			=>	__("Phone", 'grace'),
		"_tb_mobile"			=>	__("Mobile", 'grace')
	);

	return $columns;
}

function custom_church_column( $column, $post_id ) {
    switch ( $column ) {

        case '_tb_address' :
            echo get_post_meta( $post_id , '_tb_address' , true );
            break;

        case '_tb_phone' :
            echo get_post_meta( $post_id , '_tb_phone' , true );
            break;

        case '_tb_mobile' :
            echo get_post_meta( $post_id , '_tb_mobile' , true );
            break;
    }
}

?>