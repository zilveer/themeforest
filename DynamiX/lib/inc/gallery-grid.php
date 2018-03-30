<?php 

	if( empty($NV_gridcolumns) ) 
	{ 
		// Set default columns number
		$NV_gridcolumns = "3";
	}

	$NV_gridcolumns_text = numberToWords($NV_gridcolumns); // convert number to word

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
	
	$output	 = $load_limit = $load_value = '';  

	$query 			= ( is_array( $NV_slidesetid ) ? implode( ',' , $NV_slidesetid ) : $NV_slidesetid );	
	$load_ajax 	= ( get_post_meta( $post->ID, '_cmb_load_ajax', true ) !='' ) ? get_post_meta( $post->ID, '_cmb_load_ajax', true ) : '';
	$load_limit	= ( get_post_meta( $post->ID, '_cmb_load_limit', true ) !='' && $NV_datasource == "data-4" ) ? get_post_meta( $post->ID, '_cmb_load_limit', true ) : get_option('posts_per_page');
	$load_value	= ( get_post_meta( $post->ID, '_cmb_load_value', true ) !='' && $NV_datasource == "data-4" ) ? get_post_meta( $post->ID, '_cmb_load_value', true ) : $NV_gridcolumns * 2;
	$attributes	= 'content:'. $NV_groupgridcontent .'|excerpt:'. $NV_galleryexcerpt . '|lightbox:'. $NV_lightbox . '|img_width:'. $NV_imgwidth. '|img_height:'. $NV_imgheight. '|imageeffect:'. $NV_imageeffect.'|zoomhover:'. $NV_zoomhover;
	
	if( $load_ajax == 'auto_load' )
	{
		$load_ajax = 'click_load';	
	}

	if( !empty( $load_ajax ) && $NV_datasource == "data-4" )
	{
		if( $load_ajax == 'scroll_load' )
		{
			wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array('jquery'), true );
		}
			
		wp_enqueue_script(	 'loadposts', get_template_directory_uri() . '/js/load-ajax.js',array( 'jquery' ), true );		
	}	

	/* ------------------------------------
	:: LOAD DATA SOURCE
	------------------------------------*/

	echo '<div id="grid-main" data-grid-columns="'. $NV_gridcolumns .'" class="'. ( !empty( $load_ajax ) ? 'tva-ajax-container ' : '' ) .'gallery-wrap grid-gallery row '. $NV_galleryclass .' '. $masonry .' '. ' '. $columnpadding .' nv-skin" '. ( !empty( $load_ajax ) && $NV_datasource == "data-4" ? 'data-type="'. $NV_show_slider .'" data-load-method="'. $load_ajax .'" data-source="'. $NV_datasource .'" data-attributes="'. $attributes .'" data-query="'. $query .'" data-ajaxurl="'. admin_url() .'admin-ajax.php"' : '' ) .'>';	

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

	if( !empty( $load_ajax ) )
	{
		$output .= '<div class="tva-ajax-loading"></div>';
	}

	if( $load_ajax == 'click_load' )
	{
		$output .= '<div class="button-wrap tva-ajax-loaddata medium-text aligncenter"><div class="button link_color"><a>'. __('Load More', 'themeva' ) .'</a></div></div>';
	}
	
	echo $output;	

	$postcount = 0;

	$baseURL = get_permalink();
	
	echo '</div>';
	echo '<div class="clear"></div>';


	if( $NV_datasource == "data-2" || $NV_datasource == "data-5" || $NV_datasource == "data-6" && empty($NV_slidesetid) ) {
		pagination($featured_query,$baseURL);
	}

	$masonry = ( get_post_meta( $post->ID, '_cmb_gridmasonry', true ) !='' ) ? get_post_meta( $post->ID, '_cmb_gridmasonry', true ) : '';

	if( $NV_gridfilter == 'yes' || !empty( $masonry ) ) 
	{
		wp_deregister_script('jquery-isotope');
		wp_register_script('jquery-isotope',get_template_directory_uri().'/js/jquery.isotope.min.js',false,array('jquery'),true);
		wp_enqueue_script('jquery-isotope');	
	}