<?php 

	
	if( empty( $NV_imgheight ) && empty( $NV_imgwidth ) )
	{
		if( $NV_wide_layout == 'enable' )
		{
			$NV_imgwidth="1500";	
		}
		else
		{
			$NV_imgwidth="1000";
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
 
 	$output	 = $load_limit = $load_value = '';  

	$load_value 	= 6;	
	$query 			= ( is_array( $NV_slidesetid ) ? implode( ',' , $NV_slidesetid ) : $NV_slidesetid );		 
	$ratio 			= ( get_post_meta( $post->ID, '_cmb_carousel_ratio', true ) !='' ) ? get_post_meta( $post->ID, '_cmb_carousel_ratio', true ) : '16:9';
	$load_ajax		= ( get_post_meta( $post->ID, '_cmb_load_ajax', true ) !='' && $NV_datasource == "data-4" ) ? get_post_meta( $post->ID, '_cmb_load_ajax', true ) : '';
	$load_limit	= ( get_post_meta( $post->ID, '_cmb_load_limit', true ) !='' && $NV_datasource == "data-4" ) ? get_post_meta( $post->ID, '_cmb_load_limit', true ) : 6;
	$attributes	= 'content:'. $NV_groupgridcontent .'|excerpt:'. $NV_galleryexcerpt . '|lightbox:'. $NV_lightbox . '|img_width:'. $NV_imgwidth. '|img_height:'. $NV_imgheight. '|imageeffect:'. $NV_imageeffect;			
	
	echo '<div id="tva-corousel-main" class="'. ( !empty( $load_ajax ) ? 'tva-ajax-container ' : '' ) .'zoomflow carousel" data-timeout="'. $NV_stagetimeout .'" data-ratio="'. $ratio .'" '. ( !empty( $load_ajax ) && $NV_datasource == "data-4" ? 'data-type="'. $NV_show_slider .'" data-load-method="'. $load_ajax .'" data-load-method="'. $load_ajax .'" data-source="'. $NV_datasource .'" data-attributes="'. $attributes .'" data-query="'. $query .'" data-ajaxurl="'. admin_url() .'admin-ajax.php"' : '' ) .'>';
	echo '<div class="items-wrap">';
	echo '<div class="items">';
 
           
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
	
	echo '</div>';
	echo '</div>';
	echo '<div class="dynamic-frame" data-offset="'. $load_limit .'" data-total="'. $post_count .'" data-load-value="'. $load_value .'"></div>';
	echo '</div><!-- / zoomflow -->';
	
	// enqueue scripts
	wp_deregister_script('zoomflow');
	wp_register_script('zoomflow',get_template_directory_uri().'/js/zoomflow.min.js',false,array('jquery'),true);
	wp_enqueue_script('zoomflow');	  
	
	wp_register_style('zoomflow-styles',get_template_directory_uri().'/stylesheets/zoomflow/zoomflow.css');
	wp_enqueue_style('zoomflow-styles');