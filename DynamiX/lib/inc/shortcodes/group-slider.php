<?php

	/* ------------------------------------
	:: GROUP SLIDER
	------------------------------------*/
	
	function postgallery_slider_shortcode( $atts, $content = null ) {
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
		  'height' => '',
		  'width' => '',
		  'imgheight' => '',
		  'imgwidth' => '',
		  'title' => '',
		  'id' => '',
		  'lightbox' => '',	 
		  'shadow' => '', 
		  'limit' => '',
		  'excerpt' => '',
		  'orderby' => '',	  
		  'sortby' => '',
		  'timeout' => '', 
		  'vertical' => '',	
		  'align' => '',
		  'columns' => '',
		  'class' => '',
		  'image_align' => '',  
		  'animation' => '',
		  'tween' => '',
		  'content_type' => '',
		  'data_source' => '',  	  
		  ), $atts ) );
	 
		$NV_gallerysortby =  esc_attr($sortby);
		$NV_galleryorderby =  esc_attr($orderby);
		$NV_gallerynumposts= esc_attr($limit);
	
		if( !empty( $content_type ) )
		{
			$NV_groupgridcontent = $content_type;
		}
		elseif( !empty( $content ) )
		{
			$NV_groupgridcontent = $content;
		}
		
		$NV_vertheight = '';
		
		$NV_gallerywidth = esc_attr($width);
		$NV_shadowsize = esc_attr($shadow);
		$NV_imageeffect = esc_attr($imageeffect);
		$NV_imgheight = esc_attr($imgheight);
		$NV_imgwidth = esc_attr($imgwidth);
		$NV_galleryheight = esc_attr($height);
		$NV_lightbox = esc_attr($lightbox);
		$NV_title = esc_attr($title);
	
		$NV_verticalslide = esc_attr($vertical);
		$NV_slidercolumns = esc_attr($columns);
		if( empty($NV_slidercolumns) ) $NV_slidercolumns = '3';
	
		$NV_slidercolumns_text = numberToWords($NV_slidercolumns); // convert number to word
	
		$NV_imgalign = esc_attr($image_align);
		$NV_class = esc_attr($class);
	
		if( !empty($NV_imgalign) ) $NV_imgalign = 'imgalign-'.$NV_imgalign; else $NV_imgalign='';
	
		if( $NV_verticalslide == 'yes' ) $NV_verticalslide='vertical'; else $NV_verticalslide='horizontal';
	
	
		if( $NV_verticalslide == 'vertical' )
		{
			/* ------------------------------------
			:: VERTICAL SLIDER VARIABLES
			------------------------------------*/
			
			$NV_sliderformat =  'style="max-width:'.$NV_gallerywidth.'px;"';
			
			if( !empty($NV_galleryheight) )
			{
				$NV_vertheight = $NV_galleryheight;
				$NV_panelheight = $NV_vertheight / $NV_slidercolumns;
				$NV_panelformat='style="min-height:'.$NV_panelheight.$NV_widthtype.'px;"';
			}
		}
		else
		{
			/* ------------------------------------
			:: HORIZONTAL SLIDER VARIABLES
			------------------------------------*/
	
			$NV_verticalslide='horizontal';
			$NV_vertheight=$NV_galleryheight;
			$NV_sliderformat =  'style="max-width:'.$NV_gallerywidth.'px;"';
			
			if( empty($NV_gallerywidth) )
			{
				$NV_panelwidth = 100/$NV_slidercolumns; $NV_widthtype='%'; 
			} 
			else
			{
				$NV_gallerywidth = $NV_gallerywidth; 
				$NV_panelwidth = $NV_gallerywidth/$NV_slidercolumns; 
				$NV_widthtype='px';
			}
			
			if( !empty($NV_galleryheight) )
			{
				$NV_vertheight=$NV_panelformat='style="min-height:'.$NV_galleryheight.'px"';
			}
			
		}
	
	
		/* ------------------------------------
		:: DEFAULT IMAGE SIZES
		------------------------------------*/
	
		// Set timthumb width / height values
		if( empty($NV_imgheight) && empty($NV_imgwidth) )
		{
			$NV_imgheight = '100';
			$NV_image_size = "h=". $NV_imgheight ."&amp;";	
		}
		elseif( !empty($NV_imgwidth) && empty($NV_imgheight) )
		{
			$NV_image_size = "w=". $NV_imgwidth ."&amp;";	
		} 
		elseif( !empty($NV_imgheight) && empty($NV_imgwidth) )
		{
			$NV_image_size = "h=". $NV_imgheight ."&amp;";	
		}
		elseif( !empty($NV_imgheight) && !empty($NV_imgwidth) )
		{
			$NV_image_size = "w=". $NV_imgwidth ."&amp;h=". $NV_imgheight ."&amp;";	
		}
		
	
		if( empty($NV_galleryheight) ) $NV_galleryheight = $NV_imgheight+$NV_imgheight/100*12;
	
	
		// Set effect
		if($NV_verticalslide == 'vertical')
		{
			$NV_effect = 'scrollVert';
		}
		elseif( !empty( $animation ) )
		{
			$NV_effect = $animation;
		}
		else
		{
			$NV_effect = 'scrollHorz';
		}
		 
		// Tween
		if(esc_attr($tween)) {
			$NV_tween=esc_attr($tween);
		} else {
			$NV_tween="easeInOutExpo";
		} 
	
		// Excerpt
		if( !empty($excerpt) )
		{
			$NV_galleryexcerpt = esc_attr($excerpt);
		}
		else
		{
			$NV_galleryexcerpt = "55";
		}
	
	
		ob_start();
		
		/* ------------------------------------
		:: SET SOURCE VARIABLES
		------------------------------------*/
		
		$NV_shortcode_id="gp".esc_attr($id);
		$NV_show_slider = 'groupslider';
		
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
		:: SET SOURCE VARIABLES *END*
		------------------------------------*/
	
		if($NV_title) echo '<div class="gallery-title"><h4>'.$NV_title.'</h4></div>'; // TITLE
	
		echo '<div id="group-slider-'. $NV_shortcode_id .'" class="gallery-wrap group-slider shortcode '. $NV_class .' '. $align .' nv-skin clearfix '. $NV_verticalslide. '" '. $NV_sliderformat .' data-groupslider-fx="'. $NV_effect .'">';
		echo '<div class="group-slider '. $NV_imgalign .'" '. $NV_vertheight .'>';
		
		if( $NV_groupgridcontent != 'text' )
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
	
	
		$postcount = 0;
	
	
		echo '</div><!-- / groupslider -->';
		echo '<div class="slidernav-left nvcolor-wrap">';
		
		if($post_count>$NV_slidercolumns)
		{
			echo '<span class="nvcolor"></span><div class="slidernav"><a href="#"></a></div>';
		}
		
		echo '</div>';
		echo '<div class="slidernav-right nvcolor-wrap">';
		
		if($post_count>$NV_slidercolumns)
		{
			echo '<span class="nvcolor"></span><div class="slidernav"><a href="#"></a></div>';
		}
		
		echo '</div>';
		echo '<input name="group-slider-'. $NV_shortcode_id .'_timeout" class="timeout" value="'. $timeout .'" type="hidden" />';
		echo '</div><!-- / gallery-wrap -->';
		echo '<div class="clear"></div>';
	
		wp_deregister_script('jquery-cycle');
		wp_register_script('jquery-cycle',get_template_directory_uri().'/js/jquery.cycle.plugin.min.js',false,array('jquery'));
		wp_enqueue_script('jquery-cycle'); 
	
		wp_deregister_script('touch-gestures');
		wp_register_script('touch-gestures',get_template_directory_uri().'/js/touch.gestures.min.js',false,array('jquery'),true);
		wp_enqueue_script('touch-gestures');
		
		wp_deregister_script('group-slider');
		wp_register_script('group-slider',get_template_directory_uri().'/js/group.slider.min.js',false,array('jquery-cycle'),true);
		wp_enqueue_script('group-slider');	
		
	
		$output_string=ob_get_contents();
		ob_end_clean();
		
		return $output_string;
	
	}

	/* ------------------------------------
	:: GROUP GALLERY MAP
	------------------------------------*/

	wpb_map( array(
		"base"		=> "postgallery_slider",
		"name"		=> __("Group Gallery", "js_composer"),
		"class"		=> "nv_options group",
		"controls"	=> "edit_popup_delete",
		"icon"      => "icon-groupgallery",
		"category"  => __('Gallery', 'js_composer'),
		"params"	=> array(
			array(
				"type" => "textfield",
				"holder" => "h4",
				"class" => "",
				"heading" => __("Gallery ID", "js_composer"),
				"param_name" => "id",
				"value" => __("group_", "js_composer"),
				"description" => __("Enter a unique ID group_one.", "js_composer")
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
				"heading" => __("Posts Limit", "js_composer"),
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
			get_common_options( 'timeout' ),
			get_common_options( 'columns' ),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Vertical Layout", "js_composer"),
				"param_name" => "vertical",
				"value" => array(
					'Enable' => 'yes',
				)
			),			
			get_common_options( 'width' ),
			get_common_options( 'height', 'grid' ),
			get_common_options( 'align', 'Gallery' ),
			get_common_options( 'imageeffect' ),
			get_common_options( 'imgwidth' ),	
			get_common_options( 'imgheight' ),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __( 'Image Align', "js_composer"),
				"param_name" => "image_align",
				"value" => array(
					'Center' => '',
					'Left' => 'left',
					'Right' => 'right'
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
	
	add_shortcode('postgallery_slider', 'postgallery_slider_shortcode');