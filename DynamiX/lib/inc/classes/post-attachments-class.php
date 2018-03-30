<?php
	$postcount = $post_count = $data_id = 0;
	$NV_slidearray = $NV_navimg = $slider_frame = $post_gallery = '';
	
	$post = $wp_query->post;

	
	if( get_post_meta( $post->ID, '_cmb_datasource_selector', true ) !='' )
	{
		 $NV_attachedmedia = get_children(array(
				'post_parent' => $post->ID,
				'post_type' => 'attachment',
				'numberposts' => $numposts,
				'order' =>$orderby,
				'orderby' =>$sortby,
				'post_mime_type' => 'image,video',
		));
		
		$images_ids = $NV_attachedmedia;
		$post_gallery = 'yes';

	}
	else
	{
		// Image ID Array
		$images_ids = empty( $NV_attachedmedia ) ? array() : explode( ',', trim( $NV_attachedmedia ) );
	}
	
	// Get Slider Frame Path
	$slider_frame = get_slider_frame( $NV_show_slider );
	
	
	/* ------------------------------------
	
	:: POST / PAGE ATTACHMENT MEDIA DATA
	
	------------------------------------ */
	
		$post_count = count($images_ids);
		
	
		/* ------------------------------------
		:: BLACK AND WHITE EFFECT	
		------------------------------------ */
	
		if( $NV_imageeffect == 'shadowblackwhite' || $NV_imageeffect == 'frameblackwhite' || $NV_imageeffect == 'blackwhite' )
		{
			$NV_blackwhite = 'blackwhite';
			
			if( $NV_imageeffect == 'shadowblackwhite' ) $NV_imageeffect = 'shadow';
			if( $NV_imageeffect == 'frameblackwhite' ) $NV_imageeffect = 'frame';
			if( $NV_imageeffect == 'blackwhite' ) $NV_imageeffect = 'none';
	
			// enqueue black and white script
			wp_deregister_script('jquery-blackandwhite');	
			wp_register_script('jquery-blackandwhite', get_template_directory_uri().'/js/jquery.blackandwhite.min.js',false,array('jquery'),true);
			wp_enqueue_script('jquery-blackandwhite');
		}
		else
		{
			$NV_blackwhite = '';
		}		
		
		/* ------------------------------------
		
		:: GRID ONLY
		
		------------------------------------*/
		
		if($NV_show_slider=='gridgallery')
		{
			$output .= '<div class="nv-sortable row">';
		}
		
		/* ------------------------------------
		
		:: GRID ONLY *END*
		
		------------------------------------*/

				
		foreach( $images_ids as $image ) {
			
		/* ------------------------------------
		
		:: GET INDIVIDUAL ATTACHMENT DATA
		
		------------------------------------ */
		
				if( $post_gallery == 'yes' )
				{
					$image = $image->ID;
				}
			 
				$size="full";
				$image_src = wp_get_attachment_image_src($image, $size,false);
				$image_url = $image_src[0];
				
				$image_type = get_post_mime_type( $image );
				
				if( preg_match("/^image/", $image_type ) )
				{
					$image_type = 'image';
				}
				
				if(empty($NV_stagegallery)) $NV_stagegallery='';
				if(empty($NV_displaytitle)) $NV_displaytitle='';	
				if(empty($NV_groupgridcontent)) $NV_groupgridcontent='';
				if(empty($NV_cssclasses))	$NV_cssclasses='';
				
				if( $image_type == 'image' ) {
					//$NV_previewimgurl	=	parse_url($image_url, PHP_URL_PATH); // Preview Image URL
					$NV_previewimgurl	=	$image_url; // Preview Image URL
					
					if(get_post_meta($image, 'gallery-video-url', true)!='') {
						$NV_movieurl		=	get_post_meta($image, 'gallery-video-url', true);
						if( empty( $NV_lightbox ) ) { 
							$NV_videotype	=	'jwp';
						} 
						$NV_videoautoplay	=	'1';
						$NV_slidetimeout	=	get_post_meta($image, 'gallery-slide-timeout', true);	
						$video_id			=   $image->ID;
					} else {
						$NV_movieurl		=	'';
						$NV_videotype		=	'';
						$NV_slidetimeout	=	'';
						$NV_videoautoplay	=	'';			
					}
					
				} else {
					$NV_movieurl 		=	wp_get_attachment_url($image);  // Movie File URL
					$NV_videotype		=	'jwp';
					$NV_previewimgurl	=	'none';
					$video_id			=   $image->ID;
					$NV_slidetimeout	=	get_post_meta($image, 'gallery-slide-timeout', true);	
				}		
				
		
				$NV_galexturl=		get_post_meta($image, 'gallery-link-url', true);
				
				if(empty( $NV_galexturl))  $NV_galexturl ='';
				
				if($NV_galexturl=='') $NV_disablegallink='yes'; else  $NV_disablegallink='';
				
				$NV_disablereadmore ='';
				
				$image_attrs = get_post( $image ); // Get post by ID
				
				$NV_posttitle		= $image_attrs->post_title;
				$NV_description	= $image_attrs->post_content;
				
				if(isset($NV_imgzoomcrop)) $NV_imgzoomcrop = $NV_imgzoomcrop; else $NV_imgzoomcrop='';
				
				if($NV_imgzoomcrop=="zoom") {
					$NV_imgzoomcrop="1";
				} elseif($NV_imgzoomcrop=="zoom crop") {
					$NV_imgzoomcrop="3";
				} else {
					$NV_imgzoomcrop="1";
				}
				
				if($NV_videoautoplay) {
					$NV_videoautoplay = "1";
				} else {
					$NV_videoautoplay ="0";	
				}
	
	/* ------------------------------------
	
	:: GET INDIVIDUAL ATTACHMENT DATA *END*
	
	------------------------------------ */
	
	/* ------------------------------------
	
	:: 3D ONLY
	
	------------------------------------ */
	
	if(empty($NV_3dsegments)) 	$NV_3dsegments='';
	if(empty($NV_3dtween))  	$NV_3dtween='';
	if(empty($NV_3dtweentime)) 	$NV_3dtweentime='';
	if(empty($NV_3dtweendelay)) $NV_3dtweendelay='';
	if(empty($NV_3dzdistance)) 	$NV_3dzdistance='';
	if(empty($NV_3dexpand))		$NV_3dexpand='';
	
	$NV_3dsegments_slide	= $NV_3dsegments;
	$NV_3dtween_slide		= $NV_3dtween;
	$NV_3dtweentime_slide	= $NV_3dtweentime;
	$NV_3dtweendelay_slide	= $NV_3dtweendelay;
	$NV_3dzdistance_slide	= $NV_3dzdistance;
	$NV_3dexpand_slide		= $NV_3dexpand;
	
	$NV_transitions='';
	$NV_transitions = array($NV_transitions,'<Transition Pieces="'.$NV_3dsegments_slide.'" Time="'.$NV_3dtweentime_slide.'" Transition="'.$NV_3dtween_slide.'" Delay="'.$NV_3dtweendelay_slide.'"  DepthOffset="'.$NV_3dzdistance_slide.'" CubeDistance="'.$NV_3dexpand_slide.'"></Transition>');
	
	/* ------------------------------------
	
	:: 3D ONLY *END*
	
	------------------------------------ */
	
				$postcount++;
				
				if($NV_videotype !="" && $postcount!="1") { // Stop IE autoplaying hidden video onload. 
					$display_none ="";
					$display_none = "yes";
				}
				
				$slide_id='';
				$slide_id="slide-".get_the_ID();
				
				if( empty($NV_customlayer) ) $NV_customlayer='';
	
				// Check is Timthumb is Enabled or Disabled
				if( of_get_option('timthumb_disable') !='disable' && empty( $NV_customlayer ) )
				{  
					require_once NV_FILES . '/adm/functions/BFI_Thumb.php';
					
					if( !empty( $NV_imgwidth ) )
					{
						$params['width'] = $NV_imgwidth;
					}
			
					if( !empty( $NV_imgheight ) )
					{
						$params['height'] = $NV_imgheight;	
					}		
					
					if( $NV_imgzoomcrop == '0' )
					{
						$params['crop'] = true;	
					}			
					
					$NV_imagepath = bfi_thumb( dyn_getimagepath($NV_previewimgurl) , $params );
				}
				else 
				{
					$NV_imagepath = dyn_getimagepath($NV_previewimgurl);
				}			
				
		/* ------------------------------------
		:: GET SLIDER FRAME
		------------------------------------ */			
				
		require $slider_frame;
	
		/* ------------------------------------
		:: / GET SLIDER FRAME
		------------------------------------ */	
	
		if(empty($NV_slidearray)) $NV_slidearray='';
		if(empty($NV_stagetimeout)) $NV_stagetimeout='';
		if(empty($NV_slidetimeout)) $NV_slidetimeout='';
			
		if($NV_slidetimeout!='') {
			$NV_slidearray = $NV_slidearray . $NV_slidetimeout .","; 
		} elseif($NV_stagetimeout!='') {
			$NV_slidearray = $NV_slidearray . $NV_stagetimeout .","; 
		} else {
			$NV_slidearray = $NV_slidearray . "10,";
		} 
						
		if($NV_show_slider=='islider') {
			if($NV_previewimgurl) { $NV_navimg.=$NV_previewimgurl.','; } elseif($image) { $NV_navimg.=$image.','; }
		}
		
	}

	
	/* ------------------------------------
	
	:: GROUP SLIDER ONLY 
	
	------------------------------------ */
	
	if($NV_show_slider=='groupslider')
	{
		if($postcount!="0") 
		{ 
			$postcount="0"; // CHECK NEEDS END TAG
			$output .= '</div><!--  / row -->';
		} 
	}
	
	/* ------------------------------------
	
	:: GRID ONLY 
	
	------------------------------------ */
	
	if($NV_show_slider=='gridgallery')
	{
		$output .= '<div class="clear"></div>';
		$output .= '</div><!--  / row -->';
	}
	
	/* ------------------------------------
	
	:: GRID ONLY *END*
	
	------------------------------------ */

