<?php

	/* ==================================================
	
	FAQs Post Type Functions
	
	================================================== */
	    
	    
	$args = array(
	    "label" 						=> __('Topics', "swift-framework-admin"), 
	    "singular_label" 				=> __('Topic', "swift-framework-admin"), 
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => false,
	    'args'                          => array( 'orderby' => 'term_order' ),
	    'rewrite'                       => false,
	    'query_var'                     => true
	);
	
	register_taxonomy( 'faqs-category', 'faqs', $args );
	
	
	add_action('init', 'faqs_register');  
	  
	function faqs_register() {  
	
	    $labels = array(
	        'name' => __('FAQs', "swift-framework-admin"),
	        'singular_name' => __('Question', "swift-framework-admin"),
	        'add_new' => __('Add New', "swift-framework-admin"),
	        'add_new_item' => __('Add New Question', "swift-framework-admin"),
	        'edit_item' => __('Edit Question', "swift-framework-admin"),
	        'new_item' => __('New Question', "swift-framework-admin"),
	        'view_item' => __('View Question', "swift-framework-admin"),
	        'search_items' => __('Search Questions', "swift-framework-admin"),
	        'not_found' =>  __('No questions have been added yet', "swift-framework-admin"),
	        'not_found_in_trash' => __('Nothing found in Trash', "swift-framework-admin"),
	        'parent_item_colon' => ''
	    );
	
	    $args = array(  
	        'labels' => $labels,  
	        'public' => true,  
	        'show_ui' => true,
	        'show_in_menu' => true,
	        'show_in_nav_menus' => false,
	        'menu_icon'=> 'dashicons-editor-help',
	        'rewrite' => false,
	        'supports' => array('title', 'editor'),
	        'has_archive' => true,
	        'taxonomies' => array('faqs-category', 'post_tag')
	       );
	    
	    $args = apply_filters('dante_faqs_post_type_args', $args);  
	  
	    register_post_type( 'faqs' , $args );  
	}  
	
	add_filter("manage_edit-faqs_columns", "faqs_edit_columns");   
	  
	function faqs_edit_columns($columns){  
	        $columns = array(  
	            "cb" => "<input type=\"checkbox\" />",  
	            "title" => __("Question", "swift-framework-admin"),
	            "description" => __("Answer", "swift-framework-admin"),
	            "faqs-category" => __("Topics", "swift-framework-admin")
	        );  
	  
	        return $columns;  
	}

?>