<?php

	/* ------------------------------------
	:: ACCORDION SLIDER
	------------------------------------*/
	
	function postgallery_accordion_shortcode( $atts, $content = null ) {
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
		  'minititles' => '',
		  'id' => '',
		  'align' => '',
		  'excerpt' =>'',
		  'limit' => '',
		  'orderby' => '',	  
		  'sortby' => '',
		  'content_type' => '',
		  'data_source' => '',	    
		  ), $atts ) );
	
		 
		// slider height
		if( !empty($height) )
		{
			$NV_imgheight = $height; // No Reflection
		}
		else
		{
			$NV_imgheight = "350"; // Set default Gallery Height
		}
		
		$NV_image_size = "h=". $NV_imgheight ."&amp;";
		
		// slider width
		if( !empty($width) )
		{
			$NV_gallerywidth = $width;
		} 
		else
		{
			$NV_gallerywidth = "400";
		}	
		
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
	
		// minititles
		$NV_accordiontitles = $minititles;
	
	
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
		
		$NV_shortcode_id = "an".esc_attr($id);
		$NV_show_slider = 'galleryaccordion';
		
		$NV_gallerycat = esc_attr($categories);
		$NV_gallerypostformat = esc_attr($post_format);
		$NV_mediacat = esc_attr($media_categories);
		if( !empty( $portfolio_categories ) ) $NV_mediacat = esc_attr($portfolio_categories);
		$NV_slidesetid = esc_attr($slidesetid);
		$NV_attachedmedia = esc_attr($attached_id);
		$NV_flickrset = esc_attr($flickr_set);
		$NV_productcat = esc_attr($product_categories);
		$NV_producttag = esc_attr($product_tags);
		$NV_pagepost_id = esc_attr($pagepost_id);
	
		// Excerpt
		if( !empty($excerpt) )
		{
			$NV_galleryexcerpt = esc_attr($excerpt);
		}
		else
		{
			$NV_galleryexcerpt = "55";
		}	
		
		/* ------------------------------------
		:: SET VARIABLES *END*
		------------------------------------*/
	
		if( !empty($NV_title) ) echo '<div class="gallery-title"><h4>'.$NV_title.'</h4></div>'; // TITLE
	
		echo '<div id="nv-accordion-'. $NV_shortcode_id .'" class="accordion-gallery-wrap '. ( $NV_imageeffect != 'blackwhite' ? $NV_imageeffect : '' ) .' '. $align .'" data-accordion-autorotate="'. $NV_accordionautoplay .'" style="width:'. $NV_gallerywidth .'px;">';
		echo '<ul class="accordion-gallery" style="height:'. $NV_imgheight .'px;">';
		
	
		/* ------------------------------------
		
		:: LOAD DATA SOURCE
		
		------------------------------------*/
	
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
	
		echo '</ul>';
		echo '<input name="mainstage_timeout" class="timeout" value="'. $NV_stagetimeout .'" type="hidden" />';
		echo '</div><!-- / accordion-gallery -->';
	
		wp_deregister_script('kwicks-slider');
		wp_register_script('kwicks-slider',get_template_directory_uri().'/js/kwicks.slider.min.js',false,array('jquery'),true);
		wp_enqueue_script('kwicks-slider');	  
		
		$output_string=ob_get_contents();
		ob_end_clean();
	
		return $output_string;
	}

	/* ------------------------------------
	:: ACCORDION GALLERY MAP	
	------------------------------------*/

	wpb_map( array(
		"base"		=> "postgallery_accordion",
		"name"		=> __("Accordion Gallery", "js_composer"),
		"class"		=> "nv_options accordion",
		"controls"	=> "edit_popup_delete",
		'deprecated' => '4.6',
		"icon"      => "icon-accordiongallery",
		"category"  => __('Gallery', 'js_composer'),
		"params"	=> array(
			array(
				"type" => "textfield",
				"holder" => "h4",
				"class" => "",
				"heading" => __("Gallery ID", "js_composer"),
				"param_name" => "id",
				"value" => __("accordion_", "js_composer"),
				"description" => __("Enter a unique ID accordion_one.", "js_composer")
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Title", "js_composer"),
				"param_name" => "title",
				"value" => "",
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
				"value" => "",
				"dependency" => Array('element' => 'data_source' /*, 'not_empty' => true*/, 'value' => array('data-2','data-5','data-8','data-6')),
				"description" => __("Set a posts limit.", "js_composer")
			),				
			get_common_options( 'data-3' ),	
			get_common_options( 'data-4' ),	
			get_common_options( 'data-5' ),	
			get_common_options( 'data-5-tags' ),
			get_common_options( 'data-6' ),
			get_common_options( 'content' ),
			get_common_options( 'width' ),
			get_common_options( 'height' ),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __( 'Mini Titles', "js_composer"),
				"param_name" => "minititles",
				"value" => array(
					"Enable" => "enabled",
					"Disable" => "disable",
				)
			),			
			get_common_options( 'align', 'Gallery' ),
			get_common_options( 'imageeffect' ),			
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
				"type" => "textfield",
				"class" => "",
				"heading" => __("CSS Classes", "js_composer"),
				"param_name" => "class",
				"value" => "",
				"description" => __("Add an optional CSS classes.", "js_composer")
			),					
		)		
	) );		


	add_shortcode('postgallery_accordion', 'postgallery_accordion_shortcode');