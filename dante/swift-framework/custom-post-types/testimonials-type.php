<?php

	/* ==================================================
	
	Testimonials Post Type Functions
	
	================================================== */
	    
	    
	$args = array(
	    "label" 						=> __('Testimonial Categories', "swift-framework-admin"), 
	    "singular_label" 				=> __('Testimonial Category', "swift-framework-admin"),
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => false,
	    'args'                          => array( 'orderby' => 'term_order' ),
	    'rewrite'                       => false,
	    'query_var'                     => true
	);
	
	register_taxonomy( 'testimonials-category', 'testimonials', $args );
	
	
	add_action('init', 'testimonials_register');  
	  
	function testimonials_register() {  
	
	    $labels = array(
	        'name' => __('Testimonials', "swift-framework-admin"),
	        'singular_name' => __('Testimonial', "swift-framework-admin"),
	        'add_new' => __('Add New', "swift-framework-admin"),
	        'add_new_item' => __('Add New Testimonial', "swift-framework-admin"),
	        'edit_item' => __('Edit Testimonial', "swift-framework-admin"),
	        'new_item' => __('New Testimonial', "swift-framework-admin"),
	        'view_item' => __('View Testimonial', "swift-framework-admin"),
	        'search_items' => __('Search Testimonials', "swift-framework-admin"),
	        'not_found' =>  __('No testimonials have been added yet', "swift-framework-admin"),
	        'not_found_in_trash' => __('Nothing found in Trash', "swift-framework-admin"),
	        'parent_item_colon' => ''
	    );
	
	    $args = array(  
	        'labels' => $labels,  
	        'public' => true,  
	        'show_ui' => true,
	        'show_in_menu' => true,
	        'show_in_nav_menus' => false,
	        'menu_icon'=> 'dashicons-format-quote',
	        'rewrite' => false,
	        'supports' => array('title', 'editor'),
	        'has_archive' => true,
	        'taxonomies' => array('testimonials-category', 'post_tag')
	       );
	    
	    $args = apply_filters('dante_testimonials_post_type_args', $args); 
	  
	    register_post_type( 'testimonials' , $args );  
	}  
	
	add_filter("manage_edit-testimonials_columns", "testimonials_edit_columns");   
	
	function testimonials_edit_columns($columns){  
	        $columns = array(  
	            "cb" => "<input type=\"checkbox\" />",  
	            "title" => __("Testimonial", "swift-framework-admin"),
	            "testimonials-category" => __("Categories", "swift-framework-admin")
	        );  
	  
	        return $columns;  
	}

?>