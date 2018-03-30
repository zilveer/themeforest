<?php if (has_post_thumbnail( $post->ID )) {
		 								
	// Grab the URL for the thumbnail (featured image)
	$thumb = get_post_thumbnail_id(); 
	$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
	
	//Grab the theme options, and set a default if none exist.
	if (ot_get_option('default_image_width')) : 
		$imgwidth = ot_get_option('default_image_width', $theme_options, false, true, 0 );
	else : 
		$imgwidth = "700";
	endif;
	
	if (ot_get_option('default_image_height')) : 
		$imgheight = ot_get_option('default_image_height', $theme_options, false, true, 0 );
	else : 
		$imgheight = "2000";
	endif;
	
	if (ot_get_option('maintain_aspect_ratio') == 'true' ) : 
		$image = vt_resize( $thumb, '', $imgwidth, $imgheight, true );
	else : 
		$image = vt_resize( $thumb, '', $imgwidth, $imgheight, false );
	endif;
		
	
									
	// Check for a lightbox link, if it exists, use that as the value. 
	// If it doesn't, use the featured image URL from above.
	if(get_custom_field('lightbox_link')) { 							
		$lightbox_link = get_custom_field('lightbox_link'); 							
	} else {							
		$lightbox_link = $image_full[0];							
	}
	
	//Check if it's a Video
	if(strstr($lightbox_link, 'youtube.com')) { 
	$dataoption= 'data-options="smartRecognition: true"';
	} 
		
	//Check if it's a Video
	elseif(strstr($lightbox_link, 'vimeo.com')) { 
	$dataoption= 'data-options="smartRecognition: true"';
	} 
	
	else{
		$dataoption= '';
	}

} ?>