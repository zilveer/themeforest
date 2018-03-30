<?php
/* custom post types */
function retro_cpt() {

	$portfolios = get_pages( array( 'meta_key' => '_wp_page_template', 'meta_value' => 'template-portfolio.php' ) );
	
	foreach ( $portfolios as $page ) {
				
		$args = array(
			'labels' => array(
				'menu_name' => $page->post_title,
				'name' => __( 'All Items', 'openframe' ),
				'add_new' => __( 'New Item', 'openframe' ),
				'add_new_item' => __( 'New Item', 'openframe' ),
				'edit_item' => __( 'Edit Item', 'openframe' ),
				'all_items' => __( 'All Items', 'openframe' )
			),
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 20,
			'query_var' => true,
			'capability_type' => 'page',
			'has_archive' => false,
			'exclude_from_search' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'tags', 'post-formats', 'comments' ),
			'rewrite' => array( 'with_front' => false, 'slug' => $page->post_name ),
			'taxonomies' => array( 'tags-' . $page->ID )
		);
	  	
		register_post_type( 'portfolio-' . $page->ID, $args );
		
		register_taxonomy( 'tags-' . $page->ID, 'portfolio-' . $page->ID );
			
	}
		
	if ( $home = get_retro_home_page() ) {
		
		$args = array(
			'labels' => array(
				'menu_name' => __( 'Homepage', 'openframe' ),
				'name' => __( 'All Sections', 'openframe' ),
				'add_new' => __( 'New Section', 'openframe' ),
				'add_new_item' => __( 'New Section', 'openframe' ),
				'edit_item' => __( 'Edit Section', 'openframe' ),
				'all_items' => __( 'All Sections', 'openframe' )
			),
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 55,
			'query_var' => true,
			'capability_type' => 'page',
			'has_archive' => false,
			'exclude_from_search' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'rewrite' => false
		);
						
		register_post_type( $home->post_name, $args );	
			
	}
		
}

add_action( 'init', 'retro_cpt' );
add_action( 'after_switch_theme', create_function( '', 'flush_rewrite_rules();' ) );

?>