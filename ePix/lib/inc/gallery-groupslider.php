<?php 

	$NV_gallerywidth = ( !empty( $NV_gallerywidth ) ) ? $NV_gallerywidth : '980';
	$NV_vertheight = '';

	if( empty($NV_slidercolumns) ) $NV_slidercolumns = '3';

	$NV_slidercolumns_text=numberToWords($NV_slidercolumns); // convert number to word

	if( !empty($NV_imgalign) ) $NV_imgalign = 'imgalign-'.$NV_imgalign; else $NV_imgalign='';

	if($NV_verticalslide=='vertical')
	{ 
		
		/* ------------------------------------
		:: VERTICAL SLIDER VARIABLES
		------------------------------------*/
		
		$NV_sliderformat = 'style="width:'.$NV_gallerywidth.'px;"';
		
		if( !empty($NV_galleryheight) )
		{
			$NV_vertheight = $NV_galleryheight;
			$NV_panelheight = $NV_vertheight/$NV_slidercolumns;
			$NV_panelformat='style="min-height:'.$NV_panelheight.'px;"';
			$NV_vertheight='style="min-height:'.$NV_galleryheight.'px"';
		}
		
	}
	else
	{
	
		/* ------------------------------------
		:: HORIZONTAL SLIDER VARIABLES
		------------------------------------*/
			
		$NV_verticalslide='horizontal';
		$NV_sliderformat =  'style="width:'.$NV_gallerywidth.'px;height:'.$NV_galleryheight.'px"';
		
		if( empty($NV_gallerywidth) )
		{
			$NV_panelwidth = 100/$NV_slidercolumns; $NV_widthtype='%'; 
		} 
		else
		{
			$NV_gallerywidth=$NV_gallerywidth-80; $NV_panelwidth = $NV_gallerywidth/$NV_slidercolumns; $NV_widthtype='px';
		}
		
		if( !empty($NV_galleryheight) )
		{
			$NV_vertheight=$NV_panelformat='style="min-height:'.$NV_galleryheight.'px"';
		}
			
	}

	// Set timthumb width / height values
	if( empty($NV_imgheight) && empty($NV_imgwidth) )
	{
		if( $NV_wide_layout == 'enable' )
		{
			$NV_imgwidth="800";	
		}
		else
		{
			$NV_imgwidth='400';
		}
			
		$NV_image_size = "w=". $NV_imgwidth ."&amp;";
		
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
	
	// Set effect
	if($NV_verticalslide == 'vertical')
	{
		$NV_effect = 'scrollVert';
	}
	else
	{
		$NV_effect = 'scrollHorz';
	}

	$output	 = $load_limit = $load_value = '';  
	
	$load_value 	= $NV_slidercolumns;
	$load_limit 	= $NV_slidercolumns * 2;	
	$query 			= ( is_array( $NV_slidesetid ) ? implode( ',' , $NV_slidesetid ) : $NV_slidesetid );	
	$load_ajax 	= ( get_post_meta( $post->ID, '_cmb_load_ajax', true ) !='' && $NV_datasource == "data-4" ) ? get_post_meta( $post->ID, '_cmb_load_ajax', true ) : '';
	$attributes	= 'content:'. $NV_groupgridcontent .'|excerpt:'. $NV_galleryexcerpt . '|lightbox:'. $NV_lightbox . '|img_width:'. $NV_imgwidth. '|img_height:'. $NV_imgheight. '|imageeffect:'. $NV_imageeffect;			

	echo '<div id="group-slider-main" class="'. ( !empty( $load_ajax ) ? 'tva-ajax-container ' : '' ) .'gallery-wrap group-slider main'. $NV_galleryclass .' nv-skin clearfix '. $NV_verticalslide. '" data-groupslider-fx="'. $NV_effect .'" '. ( !empty( $load_ajax ) && $NV_datasource == "data-4" ? 'data-type="'. $NV_show_slider .'" data-grid-columns="'. $NV_slidercolumns .'" data-load-method="'. $load_ajax .'" data-source="'. $NV_datasource .'" data-attributes="'. $attributes .'" data-query="'. $query .'" data-ajaxurl="'. admin_url() .'admin-ajax.php"' : '' ) .'>';
	echo '<div class="group-slider main row '. $NV_imgalign .'" '. $NV_vertheight .'>';
	echo '<img src="'. get_template_directory_uri() .'/images/blank.gif" />';


	/* ------------------------------------
	:: LOAD DATA SOURCE
	------------------------------------*/
 
	// Check datasource, if no datasource check Post Categories / Slide Set selected (backwards compatibility) 
	if( empty( $NV_datasource ) ) 
	{ 
		if( empty( $NV_slidesetid ) )
		{
			$NV_datasource = 'data-2';
		}
		else
		{
			$NV_datasource = 'data-1';
		}
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
	
	echo $output;

	$postcount = 0;

    echo '</div><!-- / groupslider -->';
    echo '<div class="slidernav-left nvcolor-wrap">';
    
	if($post_count > $NV_slidercolumns)
	{
		echo '<span class="nvcolor"></span><div class="slidernav"><a id="leftnav" href="#"></a></div>';
    }
	
    echo '</div>';
    echo '<div class="slidernav-right nvcolor-wrap">';
    
	if($post_count > $NV_slidercolumns)
	{
		echo '<span class="nvcolor"></span><div class="slidernav"><a id="rightnav" href="#"></a></div>';
	}
    
	echo '</div>';
	echo '<div class="dynamic-frame clearfix" data-offset="'. $load_limit .'" data-total="'. $post_count .'" data-load-value="'. $load_value .'">';
	echo '<input name="group-slider-main_timeout" class="timeout" value="'. $NV_stagetimeout .'" type="hidden" />';
	echo '</div>';
	echo '<div class="clear"></div>';
	echo '</div><!-- / gallery-wrap -->';

	wp_deregister_script('jquery-cycle');
	wp_register_script('jquery-cycle',get_template_directory_uri().'/js/jquery.cycle.plugin.min.js',false,array('jquery'),true);
	wp_enqueue_script('jquery-cycle'); 

	wp_deregister_script('touch-gestures');
	wp_register_script('touch-gestures',get_template_directory_uri().'/js/touch.gestures.min.js',false,array('jquery'),true);
	wp_enqueue_script('touch-gestures');
	
	wp_deregister_script('group-slider');
	wp_register_script('group-slider',get_template_directory_uri().'/js/group.slider.min.js',false,array('jquery-cycle'),true);
	wp_enqueue_script('group-slider');		
