<?php

	/* ------------------------------------
	:: STAGE SLIDER
	------------------------------------*/
	
	function postgallery_image_shortcode( $atts, $content = null, $code ) {
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
		  'timeout' => '',
		  'lightbox' => '',
		  'navigation' => '',
		  'height' => '',
		  'width' => '',
		  'title' => '',	  
		  'align' => '',
		  'id' => '',
		  'limit' => '',
		  'orderby' => '',	  
		  'sortby' => '',
		  'animation' => '',
		  'tween' => '',
		  'speed' => '',
		  'excerpt' => '',
		  'customlayer' => '',
		  'data_source' => '',
		  'content_type' => '',
		  'load_ajax' => '',
		  'load_limit' => ''			  
		  ), $atts ) );
	
	
		/* ------------------------------------
		:: SET VARIABLES
		------------------------------------*/
	
		$NV_shortcode_id="sg".esc_attr($id);
		
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
		$NV_groupgridcontent = esc_attr($content_type);

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
	
		/* ------------------------------------
		:: SET VARIABLES *END*
		------------------------------------*/
	

	
		$NV_show_slider = 'stageslider';
		
		$NV_gallery_format = '';
		$NV_speed =  esc_attr($speed);
		$NV_customlayer = esc_attr($customlayer);
		$NV_title = esc_attr($title);
		$NV_lightbox =  esc_attr($lightbox);
		$NV_slidesetid = esc_attr($slidesetid);
		$NV_stageplaypause = esc_attr($navigation);
		
		if(esc_attr($excerpt)) {
			$NV_galleryexcerpt = esc_attr($excerpt);
		} else {
			$NV_galleryexcerpt = "55";
		}
		 
		if(esc_attr($animation))
		{
			$NV_animation = esc_attr($animation);
		}
		else
		{
			$NV_animation="fade";
		}
		 
		if(esc_attr($tween))
		{
			$NV_tween = esc_attr($tween);
		}
		else
		{
			$NV_tween = "linear";
		} 
		 
		$NV_imgwidth = esc_attr($width);
		$NV_imgheight = esc_attr($height);
		$NV_galleryheight = $NV_imgheight;
		$NV_imageeffect = esc_attr($imageeffect);
		$NV_gallery_width = $NV_imgwidth;
		
		$NV_gallerysortby =  esc_attr($sortby);
		$NV_galleryorderby =  esc_attr($orderby);
		$NV_gallerynumposts = esc_attr($limit);
	
		if($NV_imgwidth && !$NV_imgheight) {
			$NV_image_size = "w=". $NV_imgwidth ."&amp;";	
		} elseif($NV_imgheight && !$NV_imgwidth) {
			$NV_image_size = "h=". $NV_imgheight ."&amp;";	
		} elseif($NV_imgheight && $NV_imgwidth) {
			$NV_image_size = "w=". $NV_imgwidth ."&amp;h=". $NV_imgheight ."&amp;";	
		}
	
		// Set the Gallery Type
		$NV_gallery_type = 'stage-slider';	
		
	
		if( $NV_show_slider == 'stageslider' )
		{
			// Stage Slider Vars
			$NV_gallerywrap_style = 'max-width:'.$NV_gallery_width.'px';
			$NV_gallery_effect = ' stage';
			$NV_gallery_extras = 'style="height:'.$NV_galleryheight.'px;"';
			$NV_gallery_format = '';
		} 	
		
		if(esc_attr($timeout)) {
			$NV_stagetimeout = esc_attr($timeout);
		}
		
		$load_value 	= 1;
		$output 		= '';
		$query 			= $NV_slidesetid;
		$attributes	= 'content:'. $NV_groupgridcontent .'|excerpt:'. $NV_galleryexcerpt . '|lightbox:'. $NV_lightbox . '|img_width:'. $NV_imgwidth. '|img_height:'. $NV_imgheight. '|imageeffect:'. $NV_imageeffect;		
	
		if( !empty($NV_title) ) $output .= '<div class="gallery-title"><h4>'.$NV_title.'</h4></div>'; // TITLE
	
		$output .= '<div id="id-'. $NV_shortcode_id .'" class="'. ( !empty( $load_ajax ) ? 'tva-ajax-container ' : '' ) .'post-gallery-wrap shortcode nv-skin id-'. $NV_shortcode_id .' '. $align .' gallery-wrap '. ( !empty($NV_gallery_effect) ? $NV_gallery_effect : '' ) . '" ';
		$output .= 'style="'. ( empty($NV_customlayer) ? $NV_gallerywrap_style : '' ) .'" ';
		$output .= 'data-stage-type="'. $NV_show_slider .'" 	data-stage-nav="'. $NV_stageplaypause .'" data-stage-effect="'. $NV_animation .'" 	data-stage-easing="'. $NV_tween .'" '. ( !empty( $load_ajax ) && $NV_datasource == 'data-4' ? 'data-type="'. $NV_show_slider .'" data-load-method="'. $load_ajax .'" data-source="'. $NV_datasource .'" data-attributes="'. $attributes .'" data-query="'. $query .'" data-ajaxurl="'. admin_url() .'admin-ajax.php"' : '' ) .'>';

		if( $NV_stageplaypause == "enabled" || $NV_stageplaypause == 'leftrightonly' || $NV_stageplaypause == 'enabledpause' || $NV_stageplaypause == 'leftrightpause' )
		{
			$output .= '<div class="slidernav-left '. ( $NV_stageplaypause == 'leftrightpause' || $NV_stageplaypause == 'enabledpause' ? 'full-nav' : '' ) .' nvcolor-wrap">';
			$output .= '<span class="nvcolor"></span>';
			$output .= '<div class="slidernav">';
			$output .= '<a class="nivo-prevNav poststage-prev nav-prev"></a>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '<div class="slidernav-right '. ( $NV_stageplaypause == 'leftrightpause' || $NV_stageplaypause == 'enabledpause' ? 'full-nav' : '' ) .' nvcolor-wrap">';
			$output .= '<span class="nvcolor"></span>';
			$output .= '<div class="slidernav">';
			$output .= '<a class="nivo-nextNav poststage-next nav-next"></a>';
			$output .= '</div>';
			$output .= '</div>';	
		} 

		if( $NV_stageplaypause == 'leftrightpause' || $NV_stageplaypause == 'bulletpause' || $NV_stageplaypause == 'enabledpause' ) 
		{ 
			$output .= '<div class="slidernav-pause nvcolor-wrap">';
			$output .= '<span class="nvcolor"></span>';
			$output .= '<div class="slidernav">';
			$output .= '<a id="stage-pause" class="poststage-pause nav-pause idstage"><i class="fa fa-pause"></i></a>';
			$output .= '</div>';
			$output .= '</div>';
		}		
			
		if( $NV_stageplaypause != "disabled" && $NV_stageplaypause != "leftrightonly" && $NV_stageplaypause != "leftrightpause" ) 
		{
			$output .= '<div class="control-wrap">';
			$output .= '<div class="control-panel">';
			$output .= '</div><!-- / control-panel -->';
			$output .= '</div><!-- / control-wrap -->';
		} 		
	
		 
		$output .= '<div class="slider-inner-wrap" '. $NV_gallery_format .'>';
		$output .= '<div class="' .$NV_gallery_type .'" '. $NV_gallery_extras .'>';
		
		if( $NV_gallery_type=='stage-slider' ) 
		{
			$output .= '<img src="'. get_template_directory_uri() .'/images/blank.gif">';
		} 
	
	
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
	
		$slidenum_chk=$postcount;
		if( !empty($post_count) ) $slidenum_chk=$post_count;
	
		$output .= '</div><!-- / slider-inner-wrap -->';
		$output .= '</div><!-- / stageslider -->';
	
		$output .= '<div class="dynamic-frame clearfix" data-offset="'. $load_limit .'" data-total="'. $post_count .'" data-load-value="'. $load_value .'">';		
		$output .= '<input name="'. $NV_shortcode_id .'_timeout_array" class="timeout_array" value="'. $NV_slidearray .'" type="hidden" />';
		$output .= '<input name="'. $NV_shortcode_id .'_timeout" class="timeout" value="'. $NV_stagetimeout .'" type="hidden" />';
		$output .= '</div>';
		$output .= '<div class="clear"></div>';
		$output .= '</div><!-- / gallery-wrap -->';
	
	
	
		wp_deregister_script('jquery-cycle');
		wp_register_script('jquery-cycle',get_template_directory_uri().'/js/jquery.cycle.plugin.min.js',false,array('jquery'),true);
		wp_enqueue_script('jquery-cycle');	
		
		wp_deregister_script('touch-gestures');
		wp_register_script('touch-gestures',get_template_directory_uri().'/js/touch.gestures.min.js',false,array('jquery'),true);
		wp_enqueue_script('touch-gestures');
		
		wp_deregister_script('stage-slider');
		wp_register_script('stage-slider',get_template_directory_uri().'/js/stage.slider.min.js',false,array('jquery-cycle'),true);
		wp_enqueue_script('stage-slider');			
	
		return $output;
	
	}

	/* ------------------------------------
	:: STAGE
	------------------------------------*/

	wpb_map( array(
		"base"		=> "postgallery_image",
		"name"		=> __("Stage Gallery", "js_composer"),
		"class"		=> "nv_options stage",
		"controls"	=> "edit_popup_delete",
		"icon"      => "icon-stagegallery",
		"category"  => __('Gallery', 'js_composer'),
		"params"	=> array(
			array(
				"type" => "textfield",
				"holder" => "h4",
				"class" => "",
				"heading" => __("Gallery ID", "js_composer"),
				"param_name" => "id",
				"value" => __("stage_", "js_composer"),
				"description" => __("Enter a unique ID stage_one.", "js_composer")
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
				"dependency" => Array('element' => 'data_source' /*, 'not_empty' => true*/, 'value' => array('data-2','data-8','data-5')),
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
			get_common_options( 'width' ),
			get_common_options( 'height' ),
			get_common_options( 'align', 'Gallery' ),
			get_common_options( 'imageeffect' ),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __( 'Animation Type', "js_composer"),
				"param_name" => "animation",
				"value" => get_options_array( 'animation' )
			),	
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __( 'Animation Tween', "js_composer"),
				"param_name" => "tween",
				"value" => get_options_array( 'transition' )
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __( 'Navigation', "js_composer"),
				"param_name" => "navigation",
				"value" => array(
					'Bullet Navigation' => '',
					'Bullet + Pause' => 'bulletpause',
					'Bullet + Directional Navigation' => 'enabled',
					'Bullet + Directional Navigation + Pause' => 'enabledpause',
					'Directional Navigation' => 'leftrightonly',
					'Directional Navigation + Pause' => 'leftrightpause',
					'Disable Navigation' => 'disabled'
				)
			),			
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


	add_shortcode('postgallery_image', 'postgallery_image_shortcode');