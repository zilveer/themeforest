<?php

	/* ------------------------------------
	:: CAROUSEL SLIDER
	------------------------------------*/
	
	function carousel_slider_shortcode( $atts, $content = null ) {
	   extract( shortcode_atts( array(
		  'content' => '',
		  'categories' => '',
		  'post_format'=> '',
		  'product_categories' => '',
		  'product_tags' => '',	  
		  'slidesetid' => '',
		  'attached_id' => '', 
		  'pagepost_id' => '',
		  'media_categories' => '', 
		  'portfolio_categories' => '',
		  'flickr_set' => '',  	  
		  'imageeffect' => '',
		  'shadow' => '',
		  'timeout' => '',
		  'autoplay' => '',
		  'height' => '',
		  'width' => '',
		  'title' => '',
		  'lightbox' => '',	  
		  'id' => '',
		  'align' => '',
		  'excerpt' =>'',
		  'limit' => '',
		  'orderby' => '',	  
		  'sortby' => '',
		  'content_type' => '',
		  'data_source' => '',	
		  'ratio' => '',
		  'load_ajax' => '',
		  'load_limit' => ''			  
		  ), $atts ) );
	
		 
		// slider image width / height	
		$NV_imgwidth = "1000";
		
		// autorotate
		if( !empty($autoplay) )
		{
			$NV_accordionautoplay = "true";
		}
		else
		{
			$NV_accordionautoplay = "false";
		}
		
		// timeout
		if( !empty($timeout) )
		{
			$NV_stagetimeout=$timeout;
			$NV_poststagetimeout = esc_attr($timeout);
		} 
		else
		{
			$NV_stagetimeout = "10";
		}	
	
		$NV_imageeffect=$imageeffect;
		$NV_title = $title;
		$NV_lightbox = $lightbox; 	
	
		if( !empty( $content_type ) )
		{
			$NV_groupgridcontent = $content_type;
		}
		elseif( !empty( $content ) )
		{
			$NV_groupgridcontent = $content;
		}
	
		$NV_slidesetid = $slidesetid;
		$NV_gallerysortby =  $sortby;
		$NV_galleryorderby =  $orderby;
		$NV_gallerynumposts = $limit;
		 
		ob_start();
		
		/* ------------------------------------
		:: SET VARIABLES
		------------------------------------*/
		
		$NV_shortcode_id = "caro".esc_attr($id);
		$NV_show_slider = 'carousel';
		
		$NV_gallerycat = $categories;
		$NV_gallerypostformat = $post_format;
		$NV_mediacat = $media_categories;
		if( !empty( $portfolio_categories ) ) $NV_mediacat = $portfolio_categories;
		$NV_slidesetid = $slidesetid;
		$NV_attachedmedia = $attached_id;
		$NV_flickrset = $flickr_set;
		$NV_productcat = $product_categories;
		$NV_producttag = $product_tags;
		$NV_pagepost_id = $pagepost_id;

		if( empty( $data_source ) )
		{
			if( !empty( $NV_attachedmedia ) ) $NV_datasource = 'data-1';
			if( !empty( $NV_gallerycat ) || !empty($NV_gallerypostformat ) ) $NV_datasource = 'data-2';
			if( !empty( $NV_flickrset ) )  $NV_datasource = 'data-3';
			if( !empty( $NV_slidesetid ) ) $NV_datasource = 'data-4';
			if( !empty( $NV_productcat ) || !empty( $NV_producttag ) ) $NV_datasource = 'data-5';
			if( !empty( $NV_mediacat ) ) $NV_datasource = 'data-6';
			if( !empty( $NV_pagepost_id ) ) $NV_datasource = 'data-8';
		}
		else
		{
			$NV_datasource = $data_source;
		}		
	
		// Excerpt
		if( !empty($excerpt) )
		{
			$NV_galleryexcerpt = $excerpt;
		}
		else
		{
			$NV_galleryexcerpt = "55";
		}
		
		/* ------------------------------------
		:: SET VARIABLES *END*
		------------------------------------*/

		$query 			= $NV_slidesetid;
		$output 		= '';
		$load_value	= 6;
		$attributes	= 'content:'. $NV_groupgridcontent .'|excerpt:'. $NV_galleryexcerpt . '|lightbox:'. $NV_lightbox . '|img_width:'. $NV_imgwidth. '|imageeffect:'. $NV_imageeffect;			
	
		if( !empty($NV_title) ) $output .= '<div class="gallery-title"><h4>'.$NV_title.'</h4></div>'; // TITLE
		 
		$output .= '<div id="tva-corousel-'. $NV_shortcode_id .'" class="zoomflow carousel" data-timeout="'. $NV_stagetimeout .'" data-ratio="'. $ratio .'" '. ( !empty( $load_ajax ) && $NV_datasource == 'data-4' ? 'data-type="'. $NV_show_slider .'" data-load-method="'. $load_ajax .'" data-source="'. $NV_datasource .'" data-attributes="'. $attributes .'" data-query="'. $query .'" data-ajaxurl="'. admin_url() .'admin-ajax.php"' : '' ) .'>';
		$output .= '<div class="items-wrap">';
		$output .= '<div class="items">';
	   
	
		/* ------------------------------------
		:: LOAD DATA SOURCE
		------------------------------------*/
	
		if( $NV_datasource == "data-1" ) 
		{
			include(NV_FILES .'/inc/classes/post-attachments-class.php');		
		}
		elseif( $NV_datasource == "data-2" ||  $NV_datasource == "data-5" || $NV_datasource == "data-6" || $NV_datasource == "data-8" ) 
		{
			include(NV_FILES .'/inc/classes/post-categories-class.php');		
		}
		elseif( $NV_datasource == "data-3" )
		{
			include(NV_FILES .'/inc/classes/flickr-class.php');			
		}
		elseif( $NV_datasource == "data-4" )
		{
			include(NV_FILES .'/inc/classes/slideset-class.php');		
		}
	
		/* ------------------------------------
		
		:: LOAD DATA SOURCE *END*
	
		------------------------------------*/
	
		$output .= '</div>';
		$output .= '</div>';
		
		$output .= '<div class="dynamic-frame" data-offset="'. $load_limit .'" data-total="'. $post_count .'" data-load-value="'. $load_value .'"></div>';
		$output .= '</div><!-- / zoomflow -->';
	
		wp_deregister_script('zoomflow');
		wp_register_script('zoomflow',get_template_directory_uri().'/js/zoomflow.min.js',false,array('jquery'),true);
		wp_enqueue_script('zoomflow');	  
	
		wp_register_style('zoomflow-styles',get_template_directory_uri().'/stylesheets/zoomflow/zoomflow.css');
		wp_enqueue_style('zoomflow-styles');	  	
	
		return $output;
	}

	/* ------------------------------------
	:: Carousel MAP	
	------------------------------------*/

	wpb_map( array(
		"base"		=> "carousel_slider",
		"name"		=> __("Carousel Slider", "js_composer"),
		"class"		=> "nv_options carousel",
		"controls"	=> "edit_popup_delete",
		"icon"      => "icon-carousel",
		"category"  => __('Gallery', 'js_composer'),
		"params"	=> array(
			array(
				"type" => "textfield",
				"holder" => "h4",
				"class" => "",
				"heading" => __("Gallery ID", "js_composer"),
				"param_name" => "id",
				"value" => __("carousel", "js_composer"),
				"description" => __("Enter a unique ID e.g. carousel_one.", "js_composer")
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Title", "js_composer"),
				"param_name" => "title",
				"value" => __("", "js_composer"),
				"description" => __("Add an optional title.", "js_composer")
			),						
			get_common_options( 'datasource' ),
			get_common_options( 'data-1' ),
			get_common_options( 'data-2' ),
			get_common_options( 'data-2-formats' ),
			get_common_options( 'data-8' ),
			get_common_options( 'orderby' ),
			get_common_options( 'sortby' ),
			get_common_options( 'excerpt' ),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Post Limit", "js_composer"),
				"param_name" => "limit",
				"value" => __("", "js_composer"),
				"dependency" => Array('element' => 'data_source' /*, 'not_empty' => true*/, 'value' => array('data-2')),
				"description" => __("Set a posts limit.", "js_composer")
			),				
			get_common_options( 'data-3' ),	
			get_common_options( 'data-4' ),	
			get_common_options( 'data-5' ),	
			get_common_options( 'data-5-tags' ),
			get_common_options( 'data-6' ),
			array(
				"type" => "dropdown",
				"heading" => __("Ajax Lazy Load", "js_composer"),
				"param_name" => "load_ajax",
				"value" => array( 
					__("Disabled", "js_composer") => '',
					__("Enable", "js_composer") => 'auto_load',	
				),
				"description" => __("Load Gallery content in via Ajax ( Reduces page load time ).", "js_composer"),
			),		
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Lazy Load Initial Limit", "js_composer"),
				"param_name" => "load_limit",
				"value" => "",
				"description" => __("Enter how many slides you wish to display on initial load.", "js_composer"),
				"dependency" => Array('element' => 'load_ajax', 'not_empty' => true ),
			),				
			get_common_options( 'content' ),
			get_common_options( 'timeout' ),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Lightbox", "js_composer"),
				"param_name" => "lightbox",
				"value" => array(
					'Enable' => 'yes',
				)
			),			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __( 'Ratio', "js_composer"),
				"param_name" => "ratio",
				"value" => array(
					"16:9" => "16:9",
					"4:3" => "4:3",
					"1:1" => "1:1",
					"9:16" => "9:16",
					"3:4" => "3:4",
					"3:2" => "3:2",
					"2:3" => "2:3"			
				)
			),			
			get_common_options( 'align', 'Gallery' ),									
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("CSS Classes", "js_composer"),
				"param_name" => "class",
				"value" => __("", "js_composer"),
				"description" => __("Add an optional CSS classes.", "js_composer")
			),					
		)		
	) );	
	
	add_shortcode('carousel_slider', 'carousel_slider_shortcode');