<?php

add_action( 'init', 'register_cpt_gallery' );

function register_cpt_gallery() {

    $labels = array( 
        'name' => _x( 'Galleries', TB_GALLERY_CPT ),
        'singular_name' => _x( 'Gallery', TB_GALLERY_CPT ),
        'add_new' => _x( 'Add New', TB_GALLERY_CPT ),
        'add_new_item' => _x( 'Add New Gallery', TB_GALLERY_CPT ),
        'edit_item' => _x( 'Edit Gallery', TB_GALLERY_CPT ),
        'new_item' => _x( 'New Gallery', TB_GALLERY_CPT ),
        'view_item' => _x( 'View Gallery', TB_GALLERY_CPT ),
        'search_items' => _x( 'Search Galleries', TB_GALLERY_CPT ),
        'not_found' => _x( 'No galleries found', TB_GALLERY_CPT ),
        'not_found_in_trash' => _x( 'No galleries found in Trash', TB_GALLERY_CPT ),
        'parent_item_colon' => _x( 'Parent Gallery:', TB_GALLERY_CPT ),
        'menu_name' => _x( 'Galleries', TB_GALLERY_CPT ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        
        'supports' => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies' => array( TB_GALLERY_TAX ),
        
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
		
		'menu_icon' => PARENT_URL . '/images/icons/gallery.png',
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( TB_GALLERY_CPT, $args );
}

/*--------------------------TAXONOMY--------------------------*/
add_action( 'init', 'register_taxonomy_gallery_categories' );

function register_taxonomy_gallery_categories() {

    $labels = array( 
        'name' => _x( 'Gallery Categories', TB_GALLERY_TAX ),
        'singular_name' => _x( 'Gallery Category', TB_GALLERY_TAX ),
        'search_items' => _x( 'Search Gallery Categories', TB_GALLERY_TAX ),
        'popular_items' => _x( 'Popular Gallery Categories', TB_GALLERY_TAX ),
        'all_items' => _x( 'All Gallery Categories', TB_GALLERY_TAX ),
        'parent_item' => _x( 'Parent Gallery Category', TB_GALLERY_TAX ),
        'parent_item_colon' => _x( 'Parent Gallery Category:', TB_GALLERY_TAX ),
        'edit_item' => _x( 'Edit Gallery Category', TB_GALLERY_TAX ),
        'update_item' => _x( 'Update Gallery Category', TB_GALLERY_TAX ),
        'add_new_item' => _x( 'Add New Gallery Category', TB_GALLERY_TAX ),
        'new_item_name' => _x( 'New Gallery Category', TB_GALLERY_TAX ),
        'separate_items_with_commas' => _x( 'Separate gallery categories with commas', TB_GALLERY_TAX ),
        'add_or_remove_items' => _x( 'Add or remove gallery categories', TB_GALLERY_TAX ),
        'choose_from_most_used' => _x( 'Choose from the most used gallery categories', TB_GALLERY_TAX ),
        'menu_name' => _x( 'Gallery Categories', TB_GALLERY_TAX ),
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

    register_taxonomy( TB_GALLERY_TAX, array( TB_GALLERY_CPT ), $args );
}

/*-----------------------CUSTOM COLUMNS-----------------------*/
add_filter( 'manage_edit-' . TB_GALLERY_CPT . '_columns', 'set_custom_edit_gallery_columns' );
add_action( 'manage_' . TB_GALLERY_CPT . '_posts_custom_column' , 'custom_gallery_column', 10, 2 );

function set_custom_edit_gallery_columns($columns) {
	$columns = array(
		"cb"			=>	"<input type=\"checkbox\" />",
		"title"			=>	__("Name", 'grace'),
		"_tb_gallery_thumbnail"		=>	__("Preview Image", 'grace'),
		"_tb_gallery_category"		=>	__("Category", 'grace')
	);

	return $columns;
}

function custom_gallery_column( $column, $post_id ) {
    switch ( $column ) {

        case '_tb_gallery_thumbnail' :
			if (has_post_thumbnail($post_id)) the_post_thumbnail(array(50, 50));
            
            break;

        case '_tb_gallery_category' :
			$gcats = get_the_terms($post_id, TB_GALLERY_TAX);
			if (!empty($gcats))
			{
				$gcatArray = array();
				foreach ($gcats as $gcat)	$gcatArray[] = $gcat->name;

				echo implode($gcatArray, ", ");
			}
            break;
    }
}

?>