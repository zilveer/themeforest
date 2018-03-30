<?php

	/* ==================================================
	
	Team Post Type Functions
	
	================================================== */
	    
	    
	$args = array(
	   	"label" 						=> __('Team Categories', "swift-framework-admin"), 
	   	"singular_label" 				=> __('Team Category', "swift-framework-admin"),  
	    'public'                        => true,
	    'hierarchical'                  => true,
	    'show_ui'                       => true,
	    'show_in_nav_menus'             => false,
	    'args'                          => array( 'orderby' => 'term_order' ),
	    'rewrite'                       => false,
	    'query_var'                     => true
	);
	
	register_taxonomy( 'team-category', 'team', $args );
	
	
	add_action('init', 'team_register');  
	  
	function team_register() {  
	
	    $labels = array(
	        'name' => __('Team', "swift-framework-admin"),
	        'singular_name' => __('Team Member', "swift-framework-admin"),
	        'add_new' => __('Add New', 'team member', "swift-framework-admin"),
	        'add_new_item' => __('Add New Team Member', "swift-framework-admin"),
	        'edit_item' => __('Edit Team Member', "swift-framework-admin"),
	        'new_item' => __('New Team Member', "swift-framework-admin"),
	        'view_item' => __('View Team Member', "swift-framework-admin"),
	        'search_items' => __('Search Team Members', "swift-framework-admin"),
	        'not_found' =>  __('No team members have been added yet', "swift-framework-admin"),
	        'not_found_in_trash' => __('Nothing found in Trash', "swift-framework-admin"),
	        'parent_item_colon' => ''
	    );
	
	    $args = array(  
	        'labels' => $labels,  
	        'public' => true,  
	        'show_ui' => true,
	        'show_in_menu' => true,
	        'show_in_nav_menus' => false,
	        'menu_icon'=> 'dashicons-groups',
	        'rewrite' => false,
	        'supports' => array('title', 'editor', 'thumbnail'),
	        'has_archive' => true,
	        'taxonomies' => array('team-category', 'post_tag')
	       );  
	  	
	  	$args = apply_filters('dante_team_post_type_args', $args); 
	  	
	    register_post_type( 'team' , $args );  
	}  
	
	add_filter("manage_edit-team_columns", "team_edit_columns");   
	  
	function team_edit_columns($columns){  
	        $columns = array(  
	            "cb" => "<input type=\"checkbox\" />",  
	            "thumbnail" => "",
	            "title" => __("Team Member", "swift-framework-admin"),
	            "description" => __("Description", "swift-framework-admin"),
	            "team-category" => __("Categories", "swift-framework-admin")
	        );  
	  
	        return $columns;  
	}

?>