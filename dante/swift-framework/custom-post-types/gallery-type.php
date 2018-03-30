<?php

	/* ==================================================
	
	Gallery Post Type Functions
	
	================================================== */
	
	
	$args = array(
	    "label" 						=> __('Gallery Categories', "swift-framework-admin"), 
	    "singular_label" 				=> __('Gallery Category', "swift-framework-admin"), 
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => false,
	    'args'                          => array( 'orderby' => 'term_order' ),
		'rewrite' 						=> false,
	    'query_var'                     => true
	);
	
	register_taxonomy( 'gallery-category', 'gallery', $args );
	
	add_action('init', 'galleries_register');  
	  
	function galleries_register() {
			
	    $labels = array(
	        'name' => __('Galleries', "swift-framework-admin"),
	        'singular_name' => __('Gallery', "swift-framework-admin"),
	        'add_new' => __('Add New', "swift-framework-admin"),
	        'add_new_item' => __('Add New Gallery', "swift-framework-admin"),
	        'edit_item' => __('Edit Gallery', "swift-framework-admin"),
	        'new_item' => __('New Gallery', "swift-framework-admin"),
	        'view_item' => __('View Gallery', "swift-framework-admin"),
	        'search_items' => __('Search Galleries', "swift-framework-admin"),
	        'not_found' =>  __('No galleries have been added yet', "swift-framework-admin"),
	        'not_found_in_trash' => __('Nothing found in Trash', "swift-framework-admin"),
	        'parent_item_colon' => ''
	    );
			
	    $args = array(  
	        'labels' => $labels,  
	        'public' => true,  
	        'show_ui' => true,
	        'show_in_menu' => true,
	        'show_in_nav_menus' => false,
	        'menu_icon'=> 'dashicons-format-gallery',
	        'hierarchical' => false,
	        'rewrite' => false,
	        'supports' => array('title', 'thumbnail'),
	        'has_archive' => true,
	        'taxonomies' => array('gallery-category')
	       );  
	    
	    $args = apply_filters('dante_gallery_post_type_args', $args); 
	  
	    register_post_type( 'galleries' , $args );  
	}  
	
	add_filter("manage_edit-galleries_columns", "galleries_edit_columns");   
	  
	function galleries_edit_columns($columns){  
	        $columns = array(  
	            "cb" => "<input type=\"checkbox\" />", 
	            "thumbnail" => "",
	            "title" => __("Gallery", "swift-framework-admin"),
	            "gallery-category" => __("Categories", "swift-framework-admin")  
	        );  
	  
	        return $columns;  
	}

?>