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
		  'shadow' => '',
		  'timeout' => '',
		  'lightbox' => '',
		  'playnav' => '',
		  'navigation' => '',
		  'height' => '',
		  'width' => '1140',
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
	
		/* ------------------------------------
		:: SET VARIABLES *END*
		------------------------------------*/
	
		$NV_show_slider='';
		
		if( $code=='postgallery_image' )
		{
			$NV_show_slider='stageslider';
		}
		elseif( $code=='postgallery_islider' )
		{
			$NV_show_slider='islider';
		} 
		elseif( $code=='postgallery_nivo' )
		{
			$NV_show_slider='nivo';
		}
		
		$NV_gallery_format ='';
		$NV_speed =  esc_attr($speed);
		$NV_customlayer = esc_attr($customlayer);
		$NV_title = esc_attr($title);
		$NV_lightbox =  esc_attr($lightbox);
		$NV_slidesetid = esc_attr($slidesetid);
		$NV_stageplaypause= esc_attr($playnav);
		$NV_stageplaypause= esc_attr($navigation);
		
		if(esc_attr($excerpt)) {
			$NV_galleryexcerpt = esc_attr($excerpt);
		} else {
			$NV_galleryexcerpt = "55";
		}
		 
		if(esc_attr($animation)) {
			$NV_animation=esc_attr($animation);
		} else {
			if($NV_show_slider=='nivo') {
				$NV_animation="random";
			} else {
				$NV_animation="fade";
			}
		}
		 
		if(esc_attr($tween)) {
			$NV_tween=esc_attr($tween);
		} else {
			$NV_tween="linear";
		} 
		 
		$NV_imgwidth = esc_attr($width);
		$NV_imgheight = esc_attr($height);
		$NV_galleryheight = $NV_imgheight;
		$NV_imageeffect = esc_attr($imageeffect);
		$NV_gallery_width = $NV_imgwidth;
		
		$NV_gallerysortby =  esc_attr($sortby);
		$NV_galleryorderby = esc_attr($orderby);
		$NV_gallerynumposts = esc_attr($limit);
	
		if($NV_imgwidth && !$NV_imgheight) {
			$NV_image_size = "w=". $NV_imgwidth ."&amp;";	
		} elseif($NV_imgheight && !$NV_imgwidth) {
			$NV_image_size = "h=". $NV_imgheight ."&amp;";	
		} elseif($NV_imgheight && $NV_imgwidth) {
			$NV_image_size = "w=". $NV_imgwidth ."&amp;h=". $NV_imgheight ."&amp;";	
		}
	
	
		if($NV_show_slider=='nivo' && !$NV_imgheight) {
			$NV_galleryheight=$NV_imgheight='350';
			
			$NV_image_size = "w=". $NV_imgwidth ."&amp;h=". $NV_imgheight ."&amp;";	
		}	
		
	
		if($NV_show_slider == 'stageslider') { // Set the Gallery Type
		 $NV_gallery_type='stage-slider';	
		} elseif($NV_show_slider == 'islider') {
		 $NV_gallery_type='stage-slider islider id'.$NV_shortcode_id;
		} elseif($NV_show_slider == 'nivo') {
		 $NV_gallery_type='stage-slider-nivo id'.$NV_shortcode_id;
		}
	
	
		if($NV_show_slider=='islider')
		{
			// iSlider Vars
			$NV_navimg_width = $NV_imgwidth/100*25;
			$NV_gallery_width = $NV_imgwidth+$NV_navimg_width;
			$NV_gallery_format = 'style="float:left;"';
			$NV_gallery_effect = $NV_imageeffect.' islider';
			$NV_imageeffect =  $NV_gallery_extras = '';
			$NV_gallerywrap_style = 'max-width:'. $NV_imgwidth .'px;';
		}
		
		
		if($NV_show_slider=='nivo')
		{
			// Nivo Slider Vars
			$NV_gallery_format = 'style="max-width:'.$NV_imgwidth.'px"';
			$NV_gallerywrap_style = 'max-width:'.$NV_gallery_width.'px';
			$NV_gallery_effect = $NV_imageeffect.' nivo';
			$NV_imageeffect =  $NV_gallery_extras = '';
			$NV_stagetransition = ( !empty( $NV_nivoeffect ) ? $NV_nivoeffect : 'random' );
			$NV_stagetimeout = ( empty($NV_stagetimeout) ? $NV_stagetimeout=10000 : $NV_stagetimeout = $NV_stagetimeout*1000 );	
		} 
		
	
		if($NV_show_slider=='stageslider')
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
	
		ob_start();
	
		if( !empty($NV_title) ) echo '<div class="gallery-title"><h4>'.$NV_title.'</h4></div>'; // TITLE
	
		echo '<div id="id-'. $NV_shortcode_id .'" class="post-gallery-wrap shortcode nv-skin id-'. $NV_shortcode_id .' '. $align .' gallery-wrap ';
		
		if( !empty($NV_gallery_effect) ) echo $NV_gallery_effect;
		
		echo '" style="'; 
		
		if( empty($NV_customlayer) ) echo $NV_gallerywrap_style;
		
		echo '" 
		data-stage-type="'. $NV_show_slider .'" 
		data-stage-nav="'. $NV_stageplaypause .'" 
		data-stage-effect="'. $NV_animation .'" 
		data-stage-easing="'. $NV_tween .'">';
	
	
		if( $NV_show_slider!='islider' )
		{
			if( $NV_stageplaypause=="enabled" || $NV_stageplaypause=="leftrightonly" )
			{
				echo '<div class="slidernav-left nvcolor-wrap">';
				echo '<span class="nvcolor"></span>';
				echo '<div class="slidernav">';
				echo '<a class="nivo-prevNav poststage-prev nav-prev"></a>';
				echo '</div>';
				echo '</div>';
				echo '<div class="slidernav-right nvcolor-wrap">';
				echo '<span class="nvcolor"></span>';
				echo '<div class="slidernav">';
				echo '<a class="nivo-nextNav poststage-next nav-next"></a>';
				echo '</div>';
				echo '</div>';	
			} 
			
			if( $NV_stageplaypause!="disabled" && $NV_stageplaypause!="leftrightonly" ) 
			{
				echo '<div class="control-wrap">';
				echo '<div class="control-panel">';
				echo '</div><!-- / control-panel -->';
				echo '</div><!-- / control-wrap -->';
			} 
		}
		 
		echo '<div class="slider-inner-wrap" '. $NV_gallery_format .'>';
		echo '<div class="' .$NV_gallery_type .'" '. $NV_gallery_extras .'>';
		
		if( $NV_gallery_type=='stage-slider' ) 
		{
			echo '<img src="'. get_template_directory_uri() .'/images/blank.gif">';
		} 
	
	
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
	
		$slidenum_chk=$postcount;
		if( !empty($post_count) ) $slidenum_chk=$post_count;
	
		echo '</div><!-- / slider-inner-wrap -->';
		echo '</div><!-- / stageslider -->';
	
		if( $NV_show_slider == 'islider' ) 
		{ 
			// iSlider Image Nav
			$NV_navimg = rTrim($NV_navimg,',');
			$NV_navimg = explode(',',$NV_navimg);

			if( !empty( $NV_imgheight ) )
			{ 		
				$NV_navimg_height = $NV_imgheight/3+1;
			}
	
			$params = '';
	
			$params['width'] = $NV_navimg_width;
			
			if( !empty( $NV_navimg_height ) )
			{ 
				$params['height'] = $NV_navimg_height;
			}
			
			$params['crop'] = true;					
	 
			echo '<div class="islider-nav-wrap">';
			echo '<div class="nvcolor-wrap">';
			echo '<span class="nvcolor"></span>';
			echo '<div class="nav-prev islider-nav"></div>';
			echo '</div>';
			echo '<ul class="islider-nav-ul" style="height:' .$NV_imgheight .'px">';
			echo '<li class="copynav">';
			echo '<ul>';
			
				foreach ($NV_navimg as $NV_navimg)
				{
					echo '<li><a href="#"><img src="'. dyn_getimagepath($NV_navimg) .'" /></a></li>';
				}
			
			echo '</ul>';
			echo '</li>';
			echo '</ul>';
			echo '</div>'; 
	
		}
		
		echo '<input name="'. $NV_shortcode_id .'_timeout_array" class="timeout_array" value="'. $NV_slidearray .'" type="hidden" />';
		echo '<input name="'. $NV_shortcode_id .'_timeout" class="timeout" value="'. $NV_stagetimeout .'" type="hidden" />';
		echo '<div class="clear"></div>';
		echo '</div><!-- / gallery-wrap -->';
	
	
		// enqueue scripts
		if( $NV_show_slider == 'nivo' )
		{
			wp_deregister_script('nivo-slider');
			wp_register_script('nivo-slider',get_template_directory_uri().'/js/nivo.slider.min.js',false,array('jquery'),true);
			wp_enqueue_script('nivo-slider');			
		}
		else
		{
			wp_deregister_script('jquery-cycle');
			wp_register_script('jquery-cycle',get_template_directory_uri().'/js/jquery.cycle.plugin.min.js',false,array('jquery'),true);
			wp_enqueue_script('jquery-cycle');	
		
			wp_deregister_script('touch-gestures');
			wp_register_script('touch-gestures',get_template_directory_uri().'/js/touch.gestures.min.js',false,array('jquery'),true);
			wp_enqueue_script('touch-gestures');
		
			wp_deregister_script('stage-slider');
			wp_register_script('stage-slider',get_template_directory_uri().'/js/stage.slider.min.js',false,array('jquery-cycle'),true);
			wp_enqueue_script('stage-slider');			
		}
	
		$output_string=ob_get_contents();	
		ob_end_clean();
	
		return $output_string;
	
	}

	/* ------------------------------------
	:: NIVO MAP
	------------------------------------*/

	wpb_map( array(
		"base"		=> "postgallery_nivo",
		"name"		=> __("Nivo Gallery", "js_composer"),
		"class"		=> "nv_options islider",
		"controls"	=> "edit_popup_delete",
		'deprecated' => '4.6',
		"icon"      => "icon-nivogallery",
		"category"  => __('Gallery', 'js_composer'),
		"params"	=> array(
			array(
				"type" => "textfield",
				"holder" => "h4",
				"class" => "",
				"heading" => __("Gallery ID", "js_composer"),
				"param_name" => "id",
				"value" => __("nivo_", "js_composer"),
				"description" => __("Enter a unique ID nivo_one.", "js_composer")
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
			get_common_options( 'width' ),
			get_common_options( 'height' ),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __( 'Effect', "js_composer"),
				"param_name" => "animation",
				"value" => array("random","sliceDown","sliceDownLeft", "sliceUp", "sliceUpLeft", "sliceUpDown", "sliceUpDownLeft", "fold", "fade", "slideInRight", "slideInLeft", "boxRandom", "boxRain", "boxRainReverse", "boxRainGrow", "boxRainGrowReverse"
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
				"dependency" => Array('element' => 'data_source' /*, 'not_empty' => true*/, 'value' => array('data-2')),
				"description" => __("Set a posts limit.", "js_composer")
			),				
			get_common_options( 'data-3' ),	
			get_common_options( 'data-4' ),	
			get_common_options( 'data-5' ),	
			get_common_options( 'data-5-tags' ),
			get_common_options( 'data-6' ),
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
					'Bullet + Directional Navigation' => 'enabled',
					'Directional Navigation' => 'leftrightonly',
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

	/* ------------------------------------
	:: iSLIDER MAP
	------------------------------------*/

	wpb_map( array(
		"base"		=> "postgallery_islider",
		"name"		=> __("iSlider Gallery", "js_composer"),
		"class"		=> "nv_options islider",
		"controls"	=> "edit_popup_delete",
		"icon"      => "icon-islidergallery",
		"category"  => __('Gallery', 'js_composer'),
		"params"	=> array(
			array(
				"type" => "textfield",
				"holder" => "h4",
				"class" => "",
				"heading" => __("Gallery ID", "js_composer"),
				"param_name" => "id",
				"value" => __("islider_", "js_composer"),
				"description" => __("Enter a unique ID islider_one.", "js_composer")
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
				"dependency" => Array('element' => 'data_source' /*, 'not_empty' => true*/, 'value' => array('data-2')),
				"description" => __("Set a posts limit.", "js_composer")
			),				
			get_common_options( 'data-3' ),	
			get_common_options( 'data-4' ),	
			get_common_options( 'data-5' ),	
			get_common_options( 'data-5-tags' ),
			get_common_options( 'data-6' ),		
			get_common_options( 'width' ),
			get_common_options( 'height' ),
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
	
	add_shortcode('postgallery_nivo', 'postgallery_image_shortcode');
	add_shortcode('postgallery_image', 'postgallery_image_shortcode');
	add_shortcode('postgallery_islider', 'postgallery_image_shortcode');