<?php

	/*	
	*	Goodlayers Personnal Option File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Goodlayers
	* 	@link		http://goodlayers.com
	* 	@copyright	Copyright (c) Goodlayers
	*	---------------------------------------------------------------------
	*	This file create and contains the personnal post_type meta elements
	*	---------------------------------------------------------------------
	*/
	
	add_action( 'init', 'create_personnal' );
	function create_personnal() {
	
		$labels = array(
			'name' => __('Personnel', 'gdl_back_office'),
			'singular_name' => __('Personnel Item', 'gdl_back_office'),
			'add_new' => __('Add New', 'gdl_back_office'),
			'add_new_item' => __('Personnel Name', 'gdl_back_office'),
			'edit_item' => __('Personnel Name', 'gdl_back_office'),
			'new_item' => __('New Personnel', 'gdl_back_office'),
			'view_item' => '',
			'search_items' => __('Search Personnel', 'gdl_back_office'),
			'not_found' =>  __('Nothing found', 'gdl_back_office'),
			'not_found_in_trash' => __('Nothing found in Trash', 'gdl_back_office'),
			'parent_item_colon' => ''
		);
		
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'personnel', 'with_front' => false),
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 5,
			'exclude_from_search' => true,
			'supports' => array('title','editor','author','thumbnail','excerpt')
		); 
		  
		register_post_type( 'personnal' , $args);
		
		register_taxonomy(
			"personnal-category", array("personnal"), array(
				"hierarchical" => true, 
				"label" => "Personnel Categories", 
				"singular_label" => "Categories", 
				"rewrite" => true));
		register_taxonomy_for_object_type('personnal-category', 'personnal');
	}
	
	// add table column in edit page
	add_filter("manage_edit-personnal_columns", "show_personnal_column");	
	function show_personnal_column($columns){
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Title",
			"author" => "Author",
			"personnal-category" => "personnel Categories",
			"date" => "date");
		return $columns;
	}
	add_action("manage_posts_custom_column","personnal_custom_columns");
	function personnal_custom_columns($column){
		global $post;

		switch ($column) {
			case "personnal-category":
			echo get_the_term_list($post->ID, 'personnal-category', '', ', ','');
			break;
		}
	}

	$personnal_meta_boxes = array(	
		"Position" => array(
			'title'=> __('POSITION', 'gdl_back_office'),
			'name'=>'personnal-option-position',
			'type'=>'inputtext'),
		"Social Info" => array(
			'title'=> __('SOCIAL INFO', 'gdl_back_office'),
			'name'=>'personnal-option-social-info',
			'type'=>'textarea',
			'description'=>'You see the social shortcode here. (http://themes.goodlayers2.com/maxima/social-icon) ')			
	);
	
	add_action('add_meta_boxes', 'add_personnal_option');
	function add_personnal_option(){	
	
		add_meta_box('personnal-option', __('Personnal Option','gdl_back_office'), 'add_personnal_option_element',
			'personnal', 'normal', 'high');
			
	}
	
	function add_personnal_option_element(){
	
		global $post, $personnal_meta_boxes;
		echo '<div id="gdl-overlay-wrapper">';
		
		?> <div class="testimonial-option-meta" id="testimonial-option-meta"> <?php
		
			set_nonce();
			
			foreach($personnal_meta_boxes as $meta_box){

				$meta_box['value'] = get_post_meta($post->ID, $meta_box['name'], true);
				print_meta($meta_box);
				
			}
			
		?> </div> <?php
		
		echo '</div>';
		
	}
	
	function save_personnal_option_meta($post_id){
	
		global $personnal_meta_boxes;
		$edit_meta_boxes = $personnal_meta_boxes;
		
				// save
		foreach ($edit_meta_boxes as $edit_meta_box){
		
			if(isset($_POST[$edit_meta_box['name']])){	
				$new_data = stripslashes($_POST[$edit_meta_box['name']]);		
			}else{
				$new_data = '';
			}
			
			$old_data = get_post_meta($post_id, $edit_meta_box['name'],true);
			save_meta_data($post_id, $new_data, $old_data, $edit_meta_box['name']);
			
		}
		
	}	
?>