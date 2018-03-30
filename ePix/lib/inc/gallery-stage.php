<?php 

	// Set the Gallery Type
	if( $NV_show_slider != "stageslider" ) $NV_show_slider = 'stageslider';
	
	if( empty( $NV_imgheight ) && empty( $NV_imgwidth ) )
	{
		if( $NV_wide_layout == 'enable' )
		{
			$NV_imgwidth = "2000";	
		}
		else
		{
			$NV_imgwidth = "1050";
		}
		
		$NV_image_size = "w=". $NV_imgwidth ."&amp;";
	}
	elseif( $NV_imgwidth && empty( $NV_imgheight ) ) 
	{
		$NV_image_size = "w=". $NV_imgwidth ."&amp;";
			
	}
	elseif( $NV_imgheight && empty( $NV_imgwidth ) ) 
	{	
		$NV_image_size = "h=". $NV_imgheight ."&amp;";	
	}
	elseif( $NV_imgheight && $NV_imgwidth ) 
	{
		$NV_image_size = "w=". $NV_imgwidth ."&amp;h=". $NV_imgheight ."&amp;";	
	}

	

	if( empty( $NV_stagetransition ) )
	{ 
		// set default transition type
		$NV_stagetransition = 'fade';
	}
	
	if( empty( $NV_stagetween ) )
	{ 
		// set default tween type
		$NV_stagetween = 'linear';
	}
		
	if( $NV_show_slider == 'stageslider' )
	{	
		// Stage Slider Vars
		$NV_gallery_effect = 'stage';
		$NV_gallery_type = 'stage-slider';
		$NV_gallery_extras = $NV_gallery_format = $NV_gallerywrap_style = '';
	}

	$output	 = $load_limit = $load_value = '';  

	$load_value 	= 1;	
	$query 			= ( is_array( $NV_slidesetid ) ? implode( ',' , $NV_slidesetid ) : $NV_slidesetid );	
	$load_ajax		= ( get_post_meta( $post->ID, '_cmb_load_ajax', true ) !='' && $NV_datasource == "data-4" ) ? get_post_meta( $post->ID, '_cmb_load_ajax', true ) : '';
	$load_limit	= ( get_post_meta( $post->ID, '_cmb_load_limit', true ) !='' && $NV_datasource == "data-4" ) ? get_post_meta( $post->ID, '_cmb_load_limit', true ) : get_option('posts_per_page');
	$attributes	= 'content:'. $NV_groupgridcontent .'|excerpt:'. $NV_galleryexcerpt . '|lightbox:'. $NV_lightbox . '|img_width:'. $NV_imgwidth. '|img_height:'. $NV_imgheight. '|imageeffect:'. $NV_imageeffect;	
	
	if( !empty( $NV_customlayer ) )
	{
		$attributes	.= '|customlayer:yes';	
	}

    echo '<div id="main-stage" class="'. ( !empty( $load_ajax ) ? 'tva-ajax-container ' : '' ) . (  empty( $NV_imgheight ) && $NV_wide_layout == 'enable' ? 'fullwidth ' : '' ) .'gallery-wrap stage stage-slider-wrap clearfix '. $NV_galleryclass .' '. ( $NV_stageplaypause != "disabled" ? 'nav-enable ' : '' ) . $NV_gallery_effect .'" '. $NV_gallerywrap_style .' data-stage-type="'. $NV_show_slider .'" data-stage-nav="'. $NV_stageplaypause .'" data-stage-effect="'. $NV_stagetransition .'" data-stage-easing="'. $NV_stagetween .'" '. ( !empty( $load_ajax ) && $NV_datasource == "data-4" ? 'data-type="'. $NV_show_slider .'" data-load-method="'. $load_ajax .'" data-source="'. $NV_datasource .'" data-attributes="'. $attributes .'" data-query="'. $query .'" data-ajaxurl="'. admin_url() .'admin-ajax.php"' : '' ) .'>';
	
  	// Navigation
	if( $NV_stageplaypause != "disabled" )
	{ 
		if( $NV_stageplaypause == "enabled" || $NV_stageplaypause == 'leftrightonly' || $NV_stageplaypause == 'enabledpause' || $NV_stageplaypause == 'leftrightpause' ) 
		{ 
			echo '<div class="slidernav-left '. ( $NV_stageplaypause == 'leftrightpause' || $NV_stageplaypause == 'enabledpause' ? 'full-nav' : '' ) .' nvcolor-wrap">';
			echo '<span class="nvcolor"></span>';
			echo '<div class="slidernav">';
			echo '<a id="stage-prev" class="poststage-prev nav-prev idstage"></a>';
			echo '</div>';
			echo '</div>';

			echo '<div class="slidernav-right '. ( $NV_stageplaypause == 'leftrightpause' || $NV_stageplaypause == 'enabledpause' ? 'full-nav' : '' ) .' nvcolor-wrap">';
			echo '<span class="nvcolor"></span>';
			echo '<div class="slidernav">';
			echo '<a id="stage-next" class="poststage-next nav-next idstage"></a>';
			echo '</div>';
			echo '</div>';
		} 

		if( $NV_stageplaypause == 'leftrightpause' || $NV_stageplaypause == 'bulletpause' || $NV_stageplaypause == 'enabledpause' ) 
		{ 
			echo '<div class="slidernav-pause nvcolor-wrap">';
			echo '<span class="nvcolor"></span>';
			echo '<div class="slidernav">';
			echo '<a id="stage-pause" class="poststage-pause nav-pause idstage"><i class="fa fa-pause"></i></a>';
			echo '</div>';
			echo '</div>';
		}
		
	}
 
    
	echo '<div class="slider-inner-wrap">';

	
	if( $NV_stageplaypause != "disabled" && $NV_stageplaypause != "leftrightonly" && $NV_stageplaypause != "leftrightpause" ) 
	{ 
		echo '<div class="control-wrap">';
		echo '<div class="control-panel">';
		echo '</div><!-- / control-panel -->';
		echo '</div><!-- / control-wrap -->';			
	}	
        
	echo '<div class="'. $NV_gallery_type .'" '.$NV_gallery_extras .'>';
	
	echo '<img src="'. get_template_directory_uri() .'/images/blank.gif" alt="">';
 
           
	/* ------------------------------------
			
	:: LOAD DATA SOURCE
            
	------------------------------------ */
	
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
	
	echo $output;
	
	$slidenum_chk = $postcount;
	if( !empty($post_count) ) $slidenum_chk=$post_count;
	$postcount = 0;
	
	echo '</div><!-- / slider-inner-wrap -->';
	echo '</div><!-- / stageslider -->';

	echo '<div class="dynamic-frame clearfix" data-offset="'. $load_limit .'" data-total="'. $post_count .'" data-load-value="'. $load_value .'">';
	echo '<input name="mainstage_timeout_array" class="timeout_array" value="'. $NV_slidearray .'" type="hidden" />';
	echo '<input name="mainstage_timeout" class="timeout" value="'. $NV_stagetimeout .'" type="hidden" />';
	echo '</div>';

	echo '</div><!-- / gallery-wrap -->';
	
	// enqueue scripts
	wp_deregister_script('jquery-cycle');
	wp_register_script('jquery-cycle',get_template_directory_uri().'/js/jquery.cycle.plugin.min.js',false,array('jquery'),true);
	wp_enqueue_script('jquery-cycle');	
	
	wp_deregister_script('touch-gestures');
	wp_register_script('touch-gestures',get_template_directory_uri().'/js/touch.gestures.min.js',false,array('jquery'),true);
	wp_enqueue_script('touch-gestures');
	
	wp_deregister_script('stage-slider');
	wp_register_script('stage-slider',get_template_directory_uri().'/js/stage.slider.min.js',false,array('jquery-cycle'),true);
	wp_enqueue_script('stage-slider');