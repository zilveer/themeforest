<?php

// Create
if ( !function_exists( 'ishyoboy_register_slides_posttype' ) ){
	function ishyoboy_register_slides_posttype() {
	    $labels = array(
	        'name'              => _x( 'Slides', 'post type general name', 'ishyoboy' ),
	        'singular_name'     => _x( 'Slide', 'post type singular name', 'ishyoboy' ),
	        'add_new'           => __( 'Add New Slide', 'ishyoboy' ),
	        'add_new_item'      => __( 'Add New Slide', 'ishyoboy' ),
	        'edit_item'         => __( 'Edit Slide', 'ishyoboy' ),
	        'new_item'          => __( 'New Slide', 'ishyoboy' ),
	        'view_item'         => __( 'View Slide', 'ishyoboy' ),
	        'search_items'      => __( 'Search Slides', 'ishyoboy' ),
	        'not_found'         => __( 'Slide', 'ishyoboy' ),
	        'not_found_in_trash'=> __( 'Slide', 'ishyoboy' ),
	        'parent_item_colon' => __( 'Slide', 'ishyoboy' ),
	        'menu_name'         => __( 'Slides', 'ishyoboy' )
	    );
	    $taxonomies = array();
	    $supports = array('title', 'editor', 'thumbnail', 'page-attributes');
	    $post_type_args = array(
	        'labels'            => $labels,
	        'singular_label'    => __( 'Slide' , 'ishyoboy' ),
	        'public'            => true,
	        'show_ui'           => true,
	        'show_in_menu'      => true,
	        'publicly_queryable'=> false,
	        'exclude_from_search' => true,
	        'query_var'         => true,
	        'capability_type'   => 'post',
	        'has_archive'       => false,
	        'hierarchical'      => false,
	        'rewrite'           => array( 'slug' => 'slides', 'with_front' => false ),
	        'supports'          => $supports,
	        'menu_position'     => null,
	        'menu_icon'         => null, //get_template_directory_uri() . '/inc/slider/images/icon.png',
	        'taxonomies'        => $taxonomies
	    );
	    register_post_type( 'ishyoboy_slides' , $post_type_args );
	}
}

/*******************************************************************************************************************
 * Create Filter for Slides post type
 */
if ( !function_exists( 'ishyoboy_register_slides_category' ) ){
	function ishyoboy_register_slides_category()
	{
	    $labels = array(
	        'name'                          => __( 'Sliders', 'ishyoboy' ),
	        'singular_name'                 => __( 'Slider', 'ishyoboy' ),
	        'search_items'                  => __( 'Search Sliders', 'ishyoboy' ),
	        'popular_items'                 => __( 'Popular Sliders', 'ishyoboy' ),
	        'all_items'                     => __( 'All Sliders', 'ishyoboy' ),
	        'parent_item'                   => __( 'Parent Slider', 'ishyoboy' ),
	        'edit_item'                     => __( 'Edit Slider', 'ishyoboy' ),
	        'update_item'                   => __( 'Update Slider', 'ishyoboy' ),
	        'add_new_item'                  => __( 'Add New Slider', 'ishyoboy' ),
	        'new_item_name'                 => __( 'New Slider', 'ishyoboy' ),
	        'separate_items_with_commas'    => __( 'Separate Sliders with commas', 'ishyoboy' ),
	        'add_or_remove_items'           => __( 'Add or remove Slider', 'ishyoboy' ),
	        'choose_from_most_used'         => __( 'Choose from most used Sliders', 'ishyoboy' )
	    );

	    $args = array(
	        'labels'                        => $labels,
	        'public'                        => true,
	        'hierarchical'                  => true,
	        'show_ui'                       => true,
	        'show_in_nav_menus'             => true,
	        'query_var'                     => true
	    );

	    register_taxonomy( 'slides_categories', 'ishyoboy_slides', $args );
	}
}

/*******************************************************************************************************************
 * Backend columns
 */

add_filter("manage_edit-ishyoboy_slides_columns", "ishyoboy_ishyoboy_slides_edit_columns");
if ( !function_exists( 'ishyoboy_ishyoboy_slides_edit_columns' ) ){
	function ishyoboy_ishyoboy_slides_edit_columns( $columns ){
	    $columns = array(
	        "cb" => "<input type=\"checkbox\" />",
	        "title" => __( 'Title', 'ishyoboy' ),
	        "slider" => __( 'Slider', 'ishyoboy' ),
	        "thumbnail" => __( 'Image', 'ishyoboy' ),
	        "menu_order" => __( 'Order', 'ishyoboy' ),
	        "author" => __( 'Author', 'ishyoboy' ),
	        "date" => __( 'Date', 'ishyoboy' )
	    );

	    return $columns;
	}
}

if ( !function_exists( 'ishyoboy_ishyoboy_slides_custom_columns' ) ){
	function ishyoboy_ishyoboy_slides_custom_columns($column){
	    global $post;

	    switch ($column)
	    {
	        case "thumbnail":
	            the_post_thumbnail('thumbnail');
	            break;
	        case "slider":
	            echo get_the_term_list($post->ID, 'slides_categories', '', ', ','');
	            break;
	        case "menu_order":
	            echo $post->menu_order;
	            break;
	    }
	}
}
add_action( 'manage_ishyoboy_slides_posts_custom_column' , 'ishyoboy_ishyoboy_slides_custom_columns', 10, 2 );


/**
 * make column sortable
 */
if ( !function_exists( 'ishyoboy_ishyoboy_slides_sortable_columns' ) ){
	function ishyoboy_ishyoboy_slides_sortable_columns($columns){
		$columns['menu_order'] = 'menu_order';
		/*$columns['slider'] = 'slider';*/
		return $columns;
	}
}
add_filter('manage_edit-ishyoboy_slides_sortable_columns','ishyoboy_ishyoboy_slides_sortable_columns');


/**
 * Add dropdown filter for sliders
 */

add_action( 'restrict_manage_posts', 'ishyoboy_restrict_listings_by_category' );
if ( !function_exists( 'ishyoboy_restrict_listings_by_category' ) ){
	function ishyoboy_restrict_listings_by_category() {
	    global $typenow, $wp_query;



	    if ( isset($typenow) && 'ishyoboy_slides' == $typenow ) {

	        $taxonomy = 'slides_categories';

	        $term = isset( $wp_query->query[$taxonomy]) ? $wp_query->query[$taxonomy] : '';

	        $slider_taxonomy = get_taxonomy($taxonomy);
	        wp_dropdown_categories(array(
	            'show_option_all' =>  __("Show all", 'ishyoboy') . ' ' . $slider_taxonomy->label,
	            'taxonomy'        =>  $taxonomy,
	            'name'            =>  $taxonomy,
	            'orderby'         =>  'name',
	            'selected'        =>  $term,
	            'hierarchical'    =>  false,
	            'depth'           =>  0,
	            'show_count'      =>  true, // Show # listings in parens
	            'hide_empty'      =>  false, // Don't show businesses w/o listings
	        ));
	    }
	}
}

if ( !function_exists( 'taxonomy_filter_ishyoboy_slides_request' ) ){
	function taxonomy_filter_ishyoboy_slides_request( $query ) {
	    global $pagenow, $typenow;

	    if ( isset($pagenow) && 'edit.php' == $pagenow ) {

	        $filters = get_object_taxonomies( $typenow );
	        if ( isset($filters) && '' != $filters){
	            foreach ( $filters as $tax_slug ) {
	                $var = &$query->query_vars[$tax_slug];
	                if ( isset($var) && '' != $var ) {
	                    $term = get_term_by( 'id', $var, $tax_slug );
	                    if ( isset($term) && '' !=  $term ) {
	                        $var = $term->slug;
	                    }
	                }
	            }
	        }
	    }
	}
}
add_filter( 'parse_query', 'taxonomy_filter_ishyoboy_slides_request' );

/* *********************************************************************************************************************
 * Register post type
 */

add_action( 'init', 'ishyoboy_register_slides_posttype' );
add_action( 'init', 'ishyoboy_register_slides_category', 0 );