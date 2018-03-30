<?php

	/*	
	*	Goodlayers Package Option File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Goodlayers
	* 	@link		http://goodlayers.com
	* 	@copyright	Copyright (c) Goodlayers
	*	---------------------------------------------------------------------
	*	This file create and contains the price table post_type meta elements
	*	---------------------------------------------------------------------
	*/
	
	add_action( 'init', 'create_package_post' );
	function create_package_post() {
		$package_translation = get_option(THEME_SHORT_NAME.'_package_slug','package');
		
		$labels = array(
			'name' => __('Package', 'gdl_back_office'),
			'singular_name' => __('Package Item', 'gdl_back_office'),
			'add_new' => __('Add New Package', 'gdl_back_office'),
			'add_new_item' => __('Add New Package', 'gdl_back_office'),
			'edit_item' => __('Edit Package', 'gdl_back_office'),
			'new_item' => __('New Package', 'gdl_back_office'),
			'view_item' => __('View Package', 'gdl_back_office'),
			'search_items' => __('Search Package', 'gdl_back_office'),
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
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 5,
			'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields'),
			'rewrite' => array('slug' => $package_translation, 'with_front' => false)
		  ); 
		  
		register_post_type( 'package' , $args);
		
		register_taxonomy(
			"package-category", array("package"), array(
				"hierarchical" => true,
				"label" => "Package Categories", 
				"singular_label" => "Package Categories", 
				"rewrite" => true));
		register_taxonomy_for_object_type('package-category', 'package');
		
		register_taxonomy(
			"package-tag", array("package"), array(
				"hierarchical" => false, 
				"label" => "Package Tag", 
				"singular_label" => "Package Tag", 
				"rewrite" => true));
		register_taxonomy_for_object_type('package-tag', 'package');
		
	}

	// add price table in edit page
	add_filter("manage_edit-package_columns", "show_package_column");	
	function show_package_column($columns){
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Title",
			"author" => "Author",
			"package-category" => "Package Categories",
			"date" => "date");
		return $columns;
	}
	add_action("manage_posts_custom_column","package_custom_columns");
	function package_custom_columns($column){
		global $post;

		switch ($column) {
			case "package-category":
			$first = true;
			$terms = get_the_terms($post->ID, 'package-category');
			if(!empty($terms)){
				foreach( $terms as $term ){
					echo '<a href="edit.php?package-category=' . $term->slug . '&post_type=package">' . $term->name . '</a>';
					echo ($first)? ',': '';
					$first = false;
				}	
			}			
			//echo get_the_term_list($post->ID, 'package-category', '', ', ','');
			break;
		}
	}
	
	$package_meta_boxes = array(	
		// general options
		"Sidebar Template" => array(
			'title'=> __('SIDEBAR TEMPLATE', 'gdl_back_office'), 
			'name'=>'post-option-sidebar-template', 
			'type'=>'radioimage', 
			'default'=>$default_post_sidebar,
			'hr'=>'none',
			'options'=>array(
				'1'=>array('value'=>'right-sidebar','default'=>'selected','image'=>'/include/images/right-sidebar.png'),
				'2'=>array('value'=>'left-sidebar','image'=>'/include/images/left-sidebar.png'),
				'3'=>array('value'=>'both-sidebar','image'=>'/include/images/both-sidebar.png'),
				'4'=>array('value'=>'no-sidebar','image'=>'/include/images/no-sidebar.png'))),

		"Choose Left Sidebar" => array(
			'title'=> __('CHOOSE LEFT SIDEBAR', 'gdl_back_office'),
			'name'=>'post-option-choose-left-sidebar',
			'type'=>'combobox',
			'hr'=>'none'
		),		
		
		"Choose Right Sidebar" => array(
			'title'=> __('CHOOSE RIGHT SIDEBAR', 'gdl_back_office'),
			'name'=>'post-option-choose-right-sidebar',
			'type'=>'combobox'
		),	
		
		"Blog Caption" => array(
			'title'=> __('PAGE HEADER CAPTION', 'gdl_back_office'),
			'name'=>'post-option-blog-header-caption',
			'type'=>'textarea'
		),		

		"Inside Thumbnail" => array(
			'title'=> __('INSIDE PACKAGE THUMBNAIL', 'gdl_back_office'),
			'name'=>'post-option-inside-thumbnail',
			'type'=>'upload'
		),			
		
		"Book Now Link" => array(
			'title'=> __('Book Now Shortcode / Link', 'gdl_back_office'),
			'name'=>'post-option-book-now-link',
			'type'=>'textarea',
			'description'=>'Fill the link ( with http:// at the front) if you want the button to link to specific url'
		),		

		"Available Number" => array(
			'title'=> __('Available Number', 'gdl_back_office'),
			'name'=>'post-option-available-num',
			'type'=>'inputtext',
			'default'=> '-1',
			'description'=>'Only number is allowed here, use "zero" instead of 0 and -1 means to ignore the available number. <br> This option will be reduce after user made payment via paypal ( if the paypal account is correctly set )'
		),		
		
		"Inside Thumbnail Link" => array(
			'title'=> __('INSIDE PACKAGE THUMBNAIL LINK', 'gdl_back_office'),
			'name'=>'post-option-inside-thumbnail-link',
			'type'=>'inputtext'
		),			
		
		"Social Sharing" => array(
			'title'=> __('SOCIAL NETWORK SHARING', 'gdl_back_office'),
			'name'=>'post-option-social-enabled',
			'type'=>'combobox', 
			'options'=>array('0'=>'Yes','1'=>'No')),		
	
		"Date Type" => array(
			'title'=>__('DATE TYPE','gdl_back_office'),
			'name'=>'package-date-type',
			'type'=>'combobox',
			'options'=> array('None', 'Fixed', 'Duration'),
			'hr'=>'none'),	
			
		"Start Date" => array(
			'title'=>__('START DATE','gdl_back_office'),
			'name'=>'package-start-date',
			'meta_body'=>'package-start-date',
			'type'=>'datepicker',
			'hr'=>'none'),
			
		"End Date" => array(
			'title'=>__('END DATE','gdl_back_office'),
			'name'=>'package-end-date',
			'meta_body'=>'package-end-date',
			'type'=>'datepicker',
			'hr'=>'none'),		
			
		"Duration" => array(
			'title'=>__('DURATION','gdl_back_office'),
			'name'=>'package-duration',
			'meta_body'=>'package-duration',
			'type'=>'inputtext'),	
			
		"Price" => array(
			'title'=>__('PRICE','gdl_back_office'),
			'name'=>'package-price',
			'type'=>'inputtext'),	
			
		"Location" => array(
			'title'=>__('Location','gdl_back_office'),
			'name'=>'package-location',
			'type'=>'textarea'),				
			
		"Package Type" => array(
			'title'=>__('RIBBON TYPE','gdl_back_office'),
			'name'=>'package-type',
			'options'=> array('Learn More', 'Last Minute', 'None'),
			'type'=>'combobox',
			'hr'=>'none'),
			
		"Package Type Text" => array(
			'title'=>__('RIBBON DISCOUNT TEXT','gdl_back_office'),
			'name'=>'package-type-text',
			'meta_body'=>'package-type-text',
			'type'=>'inputtext',
			'hr'=>'none'),			

		"Last Minute Widget Text" => array(
			'title'=>__('DISCOUNT PRICE','gdl_back_office'),
			'name'=>'package-last-minute-widget-text',
			'meta_body'=>'package-type-text',
			'type'=>'inputtext'),	
	);
	
	add_action('add_meta_boxes', 'add_package_option');
	function add_package_option(){	
	
		add_meta_box('package-option', __('Package Option','gdl_back_office'), 'add_package_option_element',
			'package', 'normal', 'high');
			
	}
	
	function add_package_option_element(){
	
		global $post, $package_meta_boxes;

		// init array
		$package_meta_boxes['Choose Left Sidebar']['options'] = get_sidebar_name();
		$package_meta_boxes['Choose Right Sidebar']['options'] = $package_meta_boxes['Choose Left Sidebar']['options'];		
		
		echo '<div id="gdl-overlay-wrapper">';
		
		?> <div class="testimonial-option-meta" id="testimonial-option-meta"> <?php
		
			set_nonce();
			
			foreach($package_meta_boxes as $meta_box){

				$meta_box['value'] = get_post_meta($post->ID, $meta_box['name'], true);
				print_meta($meta_box);
				
				if( empty($meta_box['hr']) ){
					echo '<hr class="separator mt20" />';
				}
			}
			
		?> </div> <?php
		
		echo '</div>';
		
	}
	
	function save_package_option_meta($post_id){
	
		global $package_meta_boxes;
		$edit_meta_boxes = $package_meta_boxes;
		
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
		
		// Discount price
		if( !empty($_POST['package-last-minute-widget-text']) && ($_POST['package-type'] == 'Last Minute') ){
			$old_data = get_post_meta($post_id, 'package-min-price',true);
			$price = preg_replace("/[^0-9\.]/", "",$_POST['package-last-minute-widget-text']);
			save_meta_data($post_id, $price, $old_data, 'package-min-price');	
		}else{
			$old_data = get_post_meta($post_id, 'package-min-price',true);
			$price = preg_replace("/[^0-9\.]/", "",$_POST['package-price']);
			save_meta_data($post_id, $price, $old_data, 'package-min-price');	
		}
	}
?>