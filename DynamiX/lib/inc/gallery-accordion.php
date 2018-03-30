<?php 

	if( !empty($NV_imgheight) ) {
		$NV_galleryheight=$NV_imgheight;
	} else {
		$NV_galleryheight="350"; // Set default Gallery Height
		$NV_imgheight="350"; // Set default Gallery Height
	}
	
	$NV_gallerywidth="980";
	$NV_image_size = "h=". $NV_imgheight ."&amp;";

	if( empty($NV_stagetimeout) ) $NV_stagetimeout = '10'; 
    if( empty($NV_accordionautoplay) ) $NV_accordionautoplay = 'false'; else $NV_accordionautoplay = 'true';

	echo '<div id="nv-accordion" class="'. $NV_galleryclass .' nv-skin accordion-gallery-wrap '. $NV_imageeffect .' stage" data-accordion-autorotate="'. $NV_accordionautoplay .'">';
    echo '<ul class="accordion-gallery stage" style="height:'.  $NV_galleryheight .'px">';
	

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

	$postcount = 0;
	
	echo '</ul>';
	echo '<input name="mainstage_timeout" class="timeout" value="'. $NV_stagetimeout .'" type="hidden" />';
	echo '</div><!-- / accordion-gallery -->';

	wp_deregister_script('kwicks-slider');
	wp_register_script('kwicks-slider',get_template_directory_uri().'/js/kwicks.slider.min.js',false,null,true);
	wp_enqueue_script('kwicks-slider');	