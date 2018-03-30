<?php

	/*	
	*	Goodlayers Portfolio Option File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Goodlayers
	* 	@link		http://goodlayers.com
	* 	@copyright	Copyright (c) Goodlayers
	*	---------------------------------------------------------------------
	*	This file create and contains the portfolio post_type meta elements
	*	---------------------------------------------------------------------
	*/
	
	add_action( 'init', 'create_portfolio' );
	function create_portfolio() {
		$portfolio_translation = get_option(THEME_SHORT_NAME.'_gdl_portfolio_slug','portfolio');
		
		$labels = array(
			'name' => __('Portfolio', 'gdl_back_office'),
			'singular_name' => __('Portfolio Item', 'gdl_back_office'),
			'add_new' => __('Add New', 'gdl_back_office'),
			'add_new_item' => __('Add New Portfolio', 'gdl_back_office'),
			'edit_item' => __('Edit Portfolio', 'gdl_back_office'),
			'new_item' => __('New Portfolio', 'gdl_back_office'),
			'view_item' => __('View Portfolio', 'gdl_back_office'),
			'search_items' => __('Search Portfolio', 'gdl_back_office'),
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
			'supports' => array('revisions', 'title','editor','author','thumbnail','excerpt','comments','custom-fields'),
			'rewrite' => array('slug' => $portfolio_translation, 'with_front' => false)
		  ); 
		  
		register_post_type( 'portfolio' , $args);
		
		register_taxonomy(
			"portfolio-category", array("portfolio"), array(
				"hierarchical" => true,
				"label" => "Portfolio Categories", 
				"singular_label" => "Portfolio Categories", 
				"rewrite" => true));
		register_taxonomy_for_object_type('portfolio-category', 'portfolio');
		
		register_taxonomy(
			"portfolio-tag", array("portfolio"), array(
				"hierarchical" => false, 
				"label" => "Portfolio Tag", 
				"singular_label" => "Portfolio Tag", 
				"rewrite" => true));
		register_taxonomy_for_object_type('portfolio-tag', 'portfolio');
		
	}

	// add filter for adjacent custom post type
	add_filter('get_previous_post_where', 'gdl_echo', 10, 2);
	add_filter('get_next_post_where', 'gdl_echo', 10, 2);
	function gdl_echo( $where, $in_same_cat ){ 
		global $post; 
		if ( $post->post_type != 'portfolio' ) return $where;	
		
		$current_taxonomy = 'portfolio-category'; 
		$cat_array = wp_get_object_terms($post->ID, $current_taxonomy, array('fields' => 'ids')); 
		if($cat_array){ 
			$where .= " AND tt.taxonomy = '$current_taxonomy' AND tt.term_id IN (" . implode(',', $cat_array) . ")"; 
		} 
		return $where; 
	} 	
	
	add_filter('get_previous_post_join', 'get_portfolio_adjacent', 10, 2);
	add_filter('get_next_post_join', 'get_portfolio_adjacent', 10, 2);	
	function get_portfolio_adjacent($join, $in_same_cat){ 
		global $post, $wpdb; 
		if ( $post->post_type != 'portfolio' ) return $join;	
		
		$current_taxonomy = 'portfolio-category'; 
		
		if(wp_get_object_terms($post->ID, $current_taxonomy)){ 
			$join .= " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id"; 
		} 
		
		return $join; 
	}
	
	// filter for portfolio first page
	add_filter("manage_edit-portfolio_columns", "show_portfolio_column");	
	function show_portfolio_column($columns){
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Title",
			"author" => "Author",
			"portfolio-tags" => "Portfolio Tags",
			"portfolio-category" => "Portfolio Categories",
			"date" => "date");
		return $columns;
	}
	add_action("manage_posts_custom_column","portfolio_custom_columns");
	function portfolio_custom_columns($column){
		global $post;

		switch ($column) {
			case "portfolio-tags":
			echo get_the_term_list($post->ID, 'portfolio-tag', '', ', ','');
			break;
			
			case "portfolio-category":
			echo get_the_term_list($post->ID, 'portfolio-category', '', ', ','');
			break;
		}
	}	
	
	// add portfolio tag to tag cloud	
	//function custom_tag_cloud_widget($args) {
	//	$args['taxonomy'] = array('post_tag', 'portfolio-tag');
	//	return $args;
	//}
	//add_filter( 'widget_tag_cloud_args', 'custom_tag_cloud_widget' );	
	
	// starting to edit portfolio 
	$portfolio_meta_boxes = array(	
		
		// general options
		"Sidebar Template" => array(
			'title'=> __('SIDEBAR TEMPLATE', 'gdl_back_office'), 
			'name'=>'post-option-sidebar-template', 
			'type'=>'radioimage', 
			'default'=>'no-sidebar',
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
			'type'=>'combobox',
		),

		"Clients Name" => array(
			'title'=> __('CLIENTS NAME', 'gdl_back_office'),
			'name'=>'post-option-clients-name',
			'type'=>'inputtext',
			'description'=>'Please leave this field blank if you want to hide it.'),		

		"Skill Value" => array(
			'title'=> __('SKILL VALUE', 'gdl_back_office'),
			'name'=>'post-option-skill-value',
			'type'=>'inputtext',
			'description'=>'Please leave this field blank if you want to hide it.'),
			
		"Website Url" => array(
			'title'=> __('WEBSITE URL', 'gdl_back_office'),
			'name'=>'post-option-website-url',
			'type'=>'inputtext',
			'description'=>'Please leave this field blank if you want to hide it.'),

		"Portfolio Header" => array(
			'title'=> __('PORT HEADER TITLE', 'gdl_back_office'),
			'name'=>'post-option-blog-header-title',
			'type'=>'inputtext'
		),		
		
		"Portfolio Caption" => array(
			'title'=> __('PORT HEADER CAPTION', 'gdl_back_office'),
			'name'=>'post-option-blog-header-caption',
			'type'=>'textarea'
		),			
			
		"Author Infomation" => array(
			'title'=> __('SHOW AUTHOR INFORMATION', 'gdl_back_office'),
			'name'=>'post-option-author-info-enabled',
			'type'=>'combobox', 
			'options'=>array('0'=>'Yes','1'=>'No'),
			'description'=>'Show the author information in the blog page'),			
			
		"Social Sharing" => array(
			'title'=> __('SOCIAL NETWORK SHARING', 'gdl_back_office'),
			'name'=>'post-option-social-enabled',
			'type'=>'combobox', 
			'default'=>'No',
			'options'=>array('0'=>'Yes','1'=>'No'),
			'description'=>'Show the social network sharing in the blog page.'),
		
			
		// thumbnail
		"Thumbnail Types" => array(
			'title'=> __('THUMBNAIL TYPES', 'gdl_back_office'),
			'name'=>'post-option-thumbnail-types',
			'options'=>array(
				'0'=>'Image',
				'1'=>'Video',
				'2'=>'Slider',
				'3'=>'HTML5 Video'),
			'type'=>'combobox',
			'hr'=>'none',
			'description'=>'This is the thumbnail of the portfolio when using the portfolio item in page options.'),
			
		// image thumbnail
		"Open Thumbnail Image" => array('type'=>'open','id'=>'thumbnail-feature-image'),
			
		"Thumbnail Image Type" => array(
			'title'=> __('USE FEATURED IMAGE AS', 'gdl_back_office'),
			'name'=>'post-option-featured-image-type',
			'type'=>'combobox',
			'hr'=>'none',
			'options'=>array(
				'0'=>'Link to Current Post', 
				'1'=>'Link to URL',
				'2'=>'Lightbox to Current Thumbnail', 
				'3'=>'Lightbox to Picture',
				'4'=>'Lightbox to Video',)
			),
			
		"Thumbnail Image URL" => array(
			'title'=> __('SPECIFIC URL', 'gdl_back_office'),
			'name'=>'post-option-featured-image-url',
			'type'=>'inputtext',
			),		
			
		"Close Thumbnail Image" => array('type'=>'close'),
		
		// video thumbnail
		"Open Thumbnail Video" => array('type'=>'open','id'=>'thumbnail-video'),
		
		"Thumbnail Video Url" => array(
			'title'=> __('VIDEO URL', 'gdl_back_office'),
			'name'=>'post-option-thumbnail-video',
			'type'=>'inputtext',
			'description'=>'Place the url of video you want here. This theme only supports video from Youtube and Vimeo.'),
		
		"Close Thumbnail Video" => array('type'=>'close'),
		
		// slider thumbnail
		"Open Thumbnail Slider" => array('type'=>'open','id'=>'thumbnail-slider'),
		
		"Thumbnail Slider" => array(
			'type'=> 'imagepicker',
			'title'=> __('SELECT IMAGES', 'gdl_back_office'),
			'xml'=>'post-option-thumbnail-xml',
			'name'=>array(
				'image'=>'post-option-thumbnail-slider-image',
				'title'=>'post-option-thumbnail-slider-title',
				'caption'=>'post-option-thumbnail-slider-caption',
				'link'=>'post-option-thumbnail-slider-link',
				'linktype'=>'post-option-thumbnail-slider-linktype'),
			'hr'=>'none'
		),
		
		"Close Thumbnail Slider" => array('type'=>'close'),
		
		// post thumbnail html5 video
		"Open Thumbnail HTML5 Video" => array('type'=>'open','id'=>'thumbnail-html5-video'),
		
		"Thumbnail HTML5 Video" => array(
			'title'=> __('HTML5 VIDEO', 'gdl_back_office'),
			'name'=>'post-option-thumbnail-html5-video',
			'description'=>'You have to install the JWPlayer plugin for wordpress before this option can be used.' . 
				' Please try seeing more information in the documentation we provided.',			
			'type'=>'media-upload'),
		
		"Close Thumbnail HTML5 Video" => array('type'=>'close'),			
		
		// inside post thumbnails
		"Inside Thumbnail Types" => array(
			'title'=> __('INSIDE POST THUMBNAIL TYPES', 'gdl_back_office'),
			'name'=>'post-option-inside-thumbnail-types',
			'options'=>array(
				'0'=>'Image',
				'1'=>'Video',
				'2'=>'Slider',
				'3'=>'Stack Images',
				'4'=>'HTML5 Video'),
			'type'=>'combobox',
			'hr'=>'none',
			'description'=>'This is the thumbnail inside portfolio post.'),
		
		// inside post thumbnail image
		"Open Inside Thumbnail Image" => array('type'=>'open','id'=>'inside-thumbnail-image'),
			
		"Inside Thumbnail Image" => array(
			'title'=> __('SELECT IMAGE', 'gdl_back_office'),
			'name'=>'post-option-inside-thumbnial-image',
			'type'=>'upload',
			'hr'=>'none'),
			
		"Close Inside Thumbnail Image" => array('type'=>'close'),
		
		// inside post thumbnail video
		"Open Inside Thumbnail Video" => array('type'=>'open','id'=>'inside-thumbnail-video'),
		
		"Inside Thumbnail Video Url" => array(
			'title'=> __('VIDEO URL', 'gdl_back_office'),
			'name'=>'post-option-inside-thumbnail-video',
			'type'=>'inputtext',
			'hr'=>'none',
			'description'=>'Place the url of video you want here. This theme only supports video from Youtube and Vimeo.'),
		
		"Close Inside Thumbnail Video" => array('type'=>'close'),
		
		// inside post thumbnail slider
		"Open Inside Thumbnail Slider" => array('type'=>'open','id'=>'inside-thumbnail-slider'),
		
		"Inside Thumbnail Slider" => array(
			'type'=>'imagepicker',
			'title'=> __('SELECT IMAGES', 'gdl_back_office'),
			'xml'=>'post-option-inside-thumbnail-xml',
			'name'=>array(
				'image'=>'post-option-inside-thumbnail-slider-image',
				'title'=>'post-option-inside-thumbnail-slider-title',
				'caption'=>'post-option-inside-thumbnail-slider-caption',
				'link'=>'post-option-inside-thumbnail-slider-link',
				'linktype'=>'post-option-inside-thumbnail-slider-linktype'),
			'hr'=>'none'
		),
		
		"Close Inside Thumbnail Slider" => array('type'=>'close'),

		// inside post thumbnail html5 video
		"Open Inside Thumbnail HTML5 Video" => array('type'=>'open','id'=>'inside-thumbnail-html5-video'),
		
		"Inside Thumbnail HTML5 Video Url" => array(
			'title'=> __('HTML5 VIDEO', 'gdl_back_office'),
			'name'=>'post-option-inside-thumbnail-html5-video',
			'type'=>'media-upload',
			'description'=>'You have to install the JWPlayer plugin for wordpress before this option can be used.' . 
				' Please try seeing more information in the documentation we provided.',
			'hr'=>'none'),
		
		"Close Inside Thumbnail HTML5 Video" => array('type'=>'close'),
		
	);
	
	add_action('add_meta_boxes', 'add_portfolio_option');
	function add_portfolio_option(){	
	
		add_meta_box('portfolio-option', __('Portfolio Option','gdl_back_office'), 'add_portfolio_option_element',
			'portfolio', 'normal', 'high');
			
	}
	function add_portfolio_option_element(){
	
		global $post, $portfolio_meta_boxes;
		
		// init array
		$portfolio_meta_boxes['Choose Left Sidebar']['options'] = get_sidebar_name();
		$portfolio_meta_boxes['Choose Right Sidebar']['options'] = $portfolio_meta_boxes['Choose Left Sidebar']['options'];
				
		if( get_option(THEME_SHORT_NAME.'_use_portfolio_as') == 'portfolio style' ){
			unset( $portfolio_meta_boxes['Author Infomation'] );
			unset( $portfolio_meta_boxes['Portfolio Header'] );
			unset( $portfolio_meta_boxes['Social Sharing'] );
		}else{
			unset( $portfolio_meta_boxes['Clients Name'] );
			unset( $portfolio_meta_boxes['Skill Value'] );		
			unset( $portfolio_meta_boxes['Website Url'] );		
		}	
		
		echo '<div id="gdl-overlay-wrapper">';
		
		?> <div class="post-option-meta" id="post-option-meta"> <?php
		
			set_nonce();
			
			foreach($portfolio_meta_boxes as $meta_box){
			
				if( $meta_box['type'] == 'imagepicker' ){
				
					$xml_string = get_post_meta($post->ID, $meta_box['xml'], true);
					if( !empty($xml_string) ){
					
						$xml_val = new DOMDocument();
						$xml_val->loadXML( $xml_string );
						$meta_box['value'] = $xml_val->documentElement;
						
					}
					
					
				}else if( $meta_box['type'] == 'open' || $meta_box['type'] == 'close' ){
				
				}else{
				
					$meta_box['value'] = get_post_meta($post->ID, $meta_box['name'], true);
					
				}
				
				print_meta($meta_box);
				
				if( ($meta_box['type'] != 'open' && $meta_box['type'] != 'close') ){
						echo "<div class='clear'></div>";
						echo ( empty($meta_box['hr']) )? '<hr class="separator mt20">': '';
				}
				
			}
			
		?> </div> <?php
		
		echo '</div>';
		
	}
	
	// call when user save portfolio
	function save_portfolio_option_meta($post_id){
	
		global $portfolio_meta_boxes;
		$edit_meta_boxes = $portfolio_meta_boxes;
	
		// save
		foreach ($edit_meta_boxes as $edit_meta_box){
		
			if( $edit_meta_box['type'] != 'header' && $edit_meta_box['type'] != 'text' &&
				$edit_meta_box['type'] != 'open' && $edit_meta_box['type'] != 'close' ){
				
				// save function for slider
				if( $edit_meta_box['type'] == 'imagepicker' ){
				
					if(isset($_POST[$edit_meta_box['name']['image']])){
					
						$num = sizeof($_POST[$edit_meta_box['name']['image']]) - 1;
						
					}else{
					
						$num = -1;
						
					}
					
					$slider_xml_old = get_post_meta($post_id,$edit_meta_box['xml'],true);
					$slider_xml = "<slider-item>";
					
					for($i=0; $i<=$num; $i++){
					
						$slider_xml = $slider_xml. "<slider>";
						$image_new = stripslashes($_POST[$edit_meta_box['name']['image']][$i]);
						$slider_xml = $slider_xml. create_xml_tag('image',$image_new);
						$title_new = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['title']][$i]));
						$slider_xml = $slider_xml. create_xml_tag('title',$title_new);
						$caption_new = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['caption']][$i]));
						$slider_xml = $slider_xml. create_xml_tag('caption',$caption_new);
						$linktype_new = stripslashes($_POST[$edit_meta_box['name']['linktype']][$i]);
						$slider_xml = $slider_xml. create_xml_tag('linktype',$linktype_new);
						$link_new = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['link']][$i]));
						$slider_xml = $slider_xml. create_xml_tag('link',$link_new);
						$slider_xml = $slider_xml . "</slider>";
						
					}
					
					$slider_xml = $slider_xml . "</slider-item>";
					save_meta_data($post_id, $slider_xml, $slider_xml_old, $edit_meta_box['xml']);
					
				}else{
				
					if(isset($_POST[$edit_meta_box['name']])){
					
						$new_data = stripslashes($_POST[$edit_meta_box['name']]);
						
					}else{
					
						$new_data = '';
						
					}
					
					$old_data = get_post_meta($post_id, $edit_meta_box['name'],true);
					save_meta_data($post_id, $new_data, $old_data, $edit_meta_box['name']);
					
				}
				
			}
			
		}
		
	}
?>