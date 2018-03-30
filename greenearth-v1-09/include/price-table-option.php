<?php

	/*	
	*	Goodlayers Price Table Option File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Goodlayers
	* 	@link		http://goodlayers.com
	* 	@copyright	Copyright (c) Goodlayers
	*	---------------------------------------------------------------------
	*	This file create and contains the price table post_type meta elements
	*	---------------------------------------------------------------------
	*/
	
	add_action( 'init', 'create_price_table' );
	function create_price_table() {
	
		$labels = array(
			'name' => _x('Price Table', 'Price Table General Name', 'gdl_back_office'),
			'singular_name' => _x('Price Table Item', 'Price Table Singular Name', 'gdl_back_office'),
			'add_new' => _x('Add New', 'Add New Price Table Name', 'gdl_back_office'),
			'add_new_item' => __('Price Table Name', 'gdl_back_office'),
			'edit_item' => __('Price Table Name', 'gdl_back_office'),
			'new_item' => __('New Price Table', 'gdl_back_office'),
			'view_item' => '',
			'search_items' => __('Search Price Table', 'gdl_back_office'),
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
			//'menu_icon' => GOODLAYERS_PATH . '/include/images/portfolio-icon.png',
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 5,
			"show_in_nav_menus" => false,
			'exclude_from_search' => true,
			'supports' => array('title','editor','author','thumbnail','excerpt','comments')
		); 
		  
		register_post_type( 'price_table' , $args);
		
		register_taxonomy(
			"price-table-category", array("price-table"), array(
				"hierarchical" => true, 
				"label" => "Price Categories", 
				"singular_label" => "Price Categories", 
				"show_in_nav_menus" => false,
				"rewrite" => true));
		register_taxonomy_for_object_type('price-table-category', 'price_table');
		
	}

	// add price table in edit page
	add_filter("manage_edit-price_table_columns", "show_price_table_column");	
	function show_price_table_column($columns){
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Title",
			"author" => "Author",
			"price-table-category" => "Price Table Categories",
			"date" => "date");
		return $columns;
	}
	add_action("manage_posts_custom_column","price_table_custom_columns");
	function price_table_custom_columns($column){
		global $post;

		switch ($column) {
			case "price-table-category":
			echo get_the_term_list($post->ID, 'price-table-category', '', ', ','');
			break;
		}
	}
	
	$price_table_meta_boxes = array(
		"Price Tag" => array(
			'title'=>__('Price Tag','gdl_back_office'),
			'name'=>'price-table-price-tag',
			'type'=>'inputtext'),
		"Button Link" => array(
			'title'=> __('BUTTON LINK TO URL', 'gdl_back_office'),
			'name'=>'price-table-option-url',
			'type'=>'inputtext'),
		"Best Price" => array(
			'title'=>__('BEST PRICE','gdl_back_office'),
			'name'=>'price-table-best-price',
			'type'=>'combobox',
			'options'=>array('1'=>'Yes','2'=>'No'),
			'default'=>'No',
			'hr'=>'none',
			'description'=>'The best price box item will be larger than normal price and have a unique color. You can set the best price color in admin panel.')
	);
	
	add_action('add_meta_boxes', 'add_price_table_option');
	function add_price_table_option(){	
	
		add_meta_box('price-table-option', __('Price Table Option','gdl_back_office'), 'add_price_table_option_element',
			'price_table', 'normal', 'high');
			
	}
	
	function add_price_table_option_element(){
	
		global $post, $price_table_meta_boxes;
		echo '<div id="gdl-overlay-wrapper">';
		
		?> <div class="testimonial-option-meta" id="testimonial-option-meta"> <?php
		
			set_nonce();
			
			foreach($price_table_meta_boxes as $meta_box){

				$meta_box['value'] = get_post_meta($post->ID, $meta_box['name'], true);
				print_meta($meta_box);
				
				if( empty($meta_box['hr']) ){
					echo '<hr class="separator mt20" />';
				}
			}
			
		?> </div> <?php
		
		echo '</div>';
		
	}
	
	function save_price_table_option_meta($post_id){
	
		global $price_table_meta_boxes;
		$edit_meta_boxes = $price_table_meta_boxes;
		
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