<?php


add_action( 'init', 'register_cpt_priest' );

function register_cpt_priest() {

    $labels = array( 
        'name' => _x( 'Priests', TB_PRIEST_CPT ),
        'singular_name' => _x( 'Priest', TB_PRIEST_CPT ),
        'add_new' => _x( 'Add New', TB_PRIEST_CPT ),
        'add_new_item' => _x( 'Add New Priest', TB_PRIEST_CPT ),
        'edit_item' => _x( 'Edit Priest', TB_PRIEST_CPT ),
        'new_item' => _x( 'New Priest', TB_PRIEST_CPT ),
        'view_item' => _x( 'View Priest', TB_PRIEST_CPT ),
        'search_items' => _x( 'Search Priests', TB_PRIEST_CPT ),
        'not_found' => _x( 'No priests found', TB_PRIEST_CPT ),
        'not_found_in_trash' => _x( 'No priests found in Trash', TB_PRIEST_CPT ),
        'parent_item_colon' => _x( 'Parent Priest:', TB_PRIEST_CPT ),
        'menu_name' => _x( 'Priests', TB_PRIEST_CPT ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
		
		'menu_icon' => PARENT_URL . '/images/icons/priest.png',
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( TB_PRIEST_CPT, $args );
}

/*-----------------------CUSTOM COLUMNS-----------------------*/
add_filter( 'manage_edit-' . TB_PRIEST_CPT . '_columns', 'set_custom_edit_priest_columns' );
add_action( 'manage_' . TB_PRIEST_CPT . '_posts_custom_column' , 'custom_priest_column', 10, 2 );

function set_custom_edit_priest_columns($columns) {
	$columns = array(
		"cb"			=>	"<input type=\"checkbox\" />",
		"title"			=>	__("Priest Name", 'grace'),
		"_tb_title"			=>	__("Priest Title", 'grace'),
		"_tb_church"	=>	__("Church", 'grace'),
	);

	return $columns;
}

function custom_priest_column( $column, $post_id ) {
    switch ( $column ) {

        case '_tb_title' :
            echo get_post_meta( $post_id , '_tb_title' , true );
            break;

        case '_tb_church' :
            echo get_the_title(get_post_meta( $post_id , '_tb_church' , true ));
            break;

    }
}

?>