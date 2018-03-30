<?php
	
	/* ==================================================
	
	Jobs Post Type Functions
	
	================================================== */
	    
	    
	$args = array(
	    "label" 						=> __('Job Categories', "swift-framework-admin"), 
	    "singular_label" 				=> __('Job Category', "swift-framework-admin"), 
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => false,
	    'args'                          => array( 'orderby' => 'term_order' ),
	    'rewrite'                       => false,
	    'query_var'                     => true
	);
	
	register_taxonomy( 'jobs-category', 'jobs', $args );
	
	
	add_action('init', 'jobs_register');  
	  
	function jobs_register() {  
	
	    $labels = array(
	        'name' => __('Jobs', "swift-framework-admin"),
	        'singular_name' => __('Job', "swift-framework-admin"),
	        'add_new' => __('Add New', "swift-framework-admin"),
	        'add_new_item' => __('Add New Job', "swift-framework-admin"),
	        'edit_item' => __('Edit Job', "swift-framework-admin"),
	        'new_item' => __('New Job', "swift-framework-admin"),
	        'view_item' => __('View Job', "swift-framework-admin"),
	        'search_items' => __('Search Jobs', "swift-framework-admin"),
	        'not_found' =>  __('No jobs have been added yet', "swift-framework-admin"),
	        'not_found_in_trash' => __('Nothing found in Trash', "swift-framework-admin"),
	        'parent_item_colon' => ''
	    );
	
	    $args = array(  
	        'labels' => $labels,  
	        'public' => true,  
	        'show_ui' => true,
	        'show_in_menu' => true,
	        'show_in_nav_menus' => false,
	        'menu_icon'=> 'dashicons-hammer', 
	        'rewrite' => false,
	        'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
	        'has_archive' => true,
	        'taxonomies' => array('jobs-category', 'post_tag')
	       );
	    
	    $args = apply_filters('dante_jobs_post_type_args', $args); 
	  
	    register_post_type( 'jobs' , $args );  
	}  
	
	add_filter("manage_edit-jobs_columns", "jobs_edit_columns");   
	  
	function jobs_edit_columns($columns){  
	        $columns = array(  
	            "cb" => "<input type=\"checkbox\" />",  
	            "thumbnail" => "",
	            "title" => __("Job", "swift-framework-admin"),
	            "description" => __("Description", "swift-framework-admin"),
	            "jobs-category" => __("Categories", "swift-framework-admin")
	        );  
	  
	        return $columns;  
	}  

?>