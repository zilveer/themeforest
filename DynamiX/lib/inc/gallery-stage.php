<?php 

	if( $NV_show_slider=='gallery3d' ) $NV_show_slider ='stageslider';

	// Set the Gallery Type
	if( $NV_show_slider=='stageslider' ) 
	{ 
		$NV_gallery_type='stage-slider';	
		
	} 
	elseif( $NV_show_slider=='islider' )
	{ 	
		$NV_gallery_type='stage-slider islider';
		
	}
	elseif( $NV_show_slider=='nivo' )
	{
		$NV_gallery_type='stage-slider-nivo stage';
	}
	
	if( empty( $NV_imgheight ) && empty( $NV_imgwidth ) ) {
		
		if( $NV_show_slider=='islider' )
		{
			$NV_imgwidth="784";
		} else 
		{
			$NV_imgwidth = ( of_get_option('max_sitewidth') != '' ? of_get_option('max_sitewidth') : '1140' );
		}
		
		$NV_image_size = "w=". $NV_imgwidth ."&amp;";
		
	}
	elseif( $NV_imgwidth && empty( $NV_imgheight ) ) 
	{
		$NV_image_size = "w=". $NV_imgwidth ."&amp;";
			
	}
	elseif( $NV_imgheight && empty( $NV_imgwidth ) ) 
	{
		if( $NV_show_slider=='islider' ) 
		{
			$NV_imgwidth="784";
		} 
		
		$NV_image_size = "h=". $NV_imgheight ."&amp;";	
	}
	elseif( $NV_imgheight && $NV_imgwidth ) 
	{
		$NV_image_size = "w=". $NV_imgwidth ."&amp;h=". $NV_imgheight ."&amp;";	
	}


	if( $NV_show_slider=='nivo' )
	{
		if( empty( $NV_imgwidth ) ) 	$NV_imgwidth = ( of_get_option('max_sitewidth') != '' ? of_get_option('max_sitewidth') : '1140' );
		if( empty( $NV_imgheight ) ) 	$NV_galleryheight=$NV_imgheight='350';
		
		$NV_image_size = "w=". $NV_imgwidth ."&amp;h=". $NV_imgheight ."&amp;";	
	}	
	
	
	$NV_gallery_width = $NV_imgwidth;
	$NV_effectheight = 'height:'.$NV_galleryheight.'px';
	
	if( empty( $NV_stagetransition ) )
	{ 
		// set default transition type
		$NV_stagetransition='fade';
	}
	
	if( empty( $NV_stagetween ) )
	{ 
		// set default tween type
		$NV_stagetween='linear';
	}
	
	if( $NV_show_slider=='islider' )
	{
		// iSlider Vars
		$NV_navimg_width = $NV_imgwidth/100*25;
		$NV_gallery_width = $NV_imgwidth+$NV_navimg_width;
		$NV_gallery_format = 'style="float:left;"';
		$NV_gallery_effect = $NV_imageeffect.' islider';
		$NV_gallerywrap_style = 'style="max-width:'. $NV_gallery_width .'px;"';
		$NV_imageeffect = $NV_gallery_extras='';
	}
	
	if( $NV_show_slider=='nivo' )
	{
		// Nivo Slider Vars
		$NV_gallery_format='style="max-width:'.$NV_imgwidth.'px;"';
		$NV_gallery_effect=$NV_imageeffect.' nivo';
		$NV_imageeffect = $NV_gallery_extras = $NV_gallerywrap_style='';
		$NV_stagetransition = ( empty( $NV_nivoeffect ) ? $NV_nivoeffect : 'random' );
		$NV_stagetimeout = ( empty($NV_stagetimeout) ? $NV_stagetimeout=10000 : $NV_stagetimeout = $NV_stagetimeout*1000 );
	} 
	
	if( $NV_show_slider=='stageslider' )
	{	
		// Stage Slider Vars
		$NV_gallery_effect = 'stage';
		$NV_gallery_extras = $NV_gallery_format = $NV_gallerywrap_style = '';
	}

    echo '<div id="main-stage" class="gallery-wrap stage stage-slider-wrap '. $NV_galleryclass .' ';  
    
	if( $NV_stageplaypause!="disabled" ) echo 'nav-enable ';
	
	echo $NV_gallery_effect .'" '. $NV_gallerywrap_style .' 
	data-stage-type="'. $NV_show_slider .'" 
	data-stage-nav="'. $NV_stageplaypause .'" 
	data-stage-effect="'. $NV_stagetransition .'" 
	data-stage-easing="'. $NV_stagetween .'">';
	
    if( $NV_show_slider!='islider' )
	{
        if( $NV_stageplaypause!="disabled" )
		{ 
            if( $NV_stageplaypause=="enabled" || $NV_stageplaypause=='leftrightonly' ) 
			{ 
				echo '<div class="slidernav-left nvcolor-wrap">';
				echo '<span class="nvcolor"></span>';
				echo '<div class="slidernav">';
				echo '<a id="stage-prev" class="nivo-prevNav poststage-prev nav-prev idstage"></a>';
				echo '</div>';
				echo '</div>';
				echo '<div class="slidernav-right nvcolor-wrap">';
				echo '<span class="nvcolor"></span>';
				echo '<div class="slidernav">';
				echo '<a id="stage-next" class="nivo-nextNav poststage-next nav-next idstage"></a>';
				echo '</div>';
				echo '</div>';
			} 
        }
    } 
    
	echo '<div class="slider-inner-wrap" '. $NV_gallery_format .'>';

	if( $NV_show_slider!='islider' ) 
	{
		if( $NV_stageplaypause!="disabled" && $NV_stageplaypause!="leftrightonly" ) 
		{ 
			echo '<div class="control-wrap">';
			echo '<div class="control-panel">';
			echo '</div><!-- / control-panel -->';
			echo '</div><!-- / control-wrap -->';			
		}
	} 
		
        
	echo '<div class="'. $NV_gallery_type .'" '.$NV_gallery_extras .'>';
            
	if( $NV_gallery_type=='stage-slider' ) 
	{
		echo '<img src="'. get_template_directory_uri() .'/images/blank.gif" />';
	} 
            
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
	
	
	$slidenum_chk = $postcount;
	if( !empty($post_count) ) $slidenum_chk=$post_count;
	$postcount = 0;
	
	echo '</div><!-- / slider-inner-wrap -->';
	echo '</div><!-- / stageslider -->';
		
	if( $NV_show_slider=='islider' )
	{ 
		// iSlider Image Nav
		if( !empty( $NV_imgheight ) )
		{ 		
			$NV_navimg_height = $NV_imgheight/3+1;
		}
		
        $NV_navimg = rTrim($NV_navimg,',');
        $NV_navimg = explode(',',$NV_navimg);

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
				echo '<li><a href="#"><img src="'. bfi_thumb( dyn_getimagepath($NV_navimg) , $params ) .'" /></a></li>';
			}
			
		echo '</ul>';
		echo '</li>';
		echo '</ul>';
		echo '</div>'; 
	}

	echo '<input name="mainstage_timeout_array" class="timeout_array" value="'. $NV_slidearray .'" type="hidden" />';
	echo '<input name="mainstage_timeout" class="timeout" value="'. $NV_stagetimeout .'" type="hidden" />';
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
	
