<?php
function kingsize_video($postid) {
	
	$video_url = get_post_meta($postid, 'kingsize_video_url', true);
	$height = get_post_meta($postid, 'kingsize_video_height', true);
	$embeded_code = get_post_meta($postid, 'kingsize_embed_code', true);
	
	if($height == '')
		$height = 300;

	if(trim($embeded_code) == '') 
	{
		
		if(preg_match('/youtube/', $video_url)) 
		{
			
			if(preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $video_url, $matches))
			{
				
				$output = '<object width="460" height="'.$height.'"><param name="movie" value="http://www.youtube.com/v/'.$matches[1].'"></param>
				<param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/'.$matches[1].'" type="application/x-shockwave-flash" wmode="transparent" width="460" height="'.$height.'"></embed></object>';
			
			}
			else 
			{
				$output = __('Sorry that seems to be an invalid <strong>YouTube</strong> URL. Please check it again.', 'kslang');
			}
			
		}
		elseif(preg_match('/vimeo/', $video_url)) 
		{
			
			if(preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $matches))
			{
				$output = '<iframe src="//player.vimeo.com/video/'.$matches[1].'" width="460" height="'.$height.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			}
			else 
			{
				$output = __('Sorry that seems to be an invalid <strong>Vimeo</strong> URL. Please check it again. Make sure there is a string of numbers at the end.', 'kslang');
			}
			
		}
		else 
		{
			$output = __('Sorry that is an invalid YouTube or Vimeo URL.', 'kslang');
		}
		
		echo $output;
		
	}
	else
	{
		echo stripslashes(htmlspecialchars_decode($embeded_code));
	}
	
}

//Credit http://philipnewcomer.net/2012/11/get-the-attachment-id-from-an-image-url-in-wordpress/
function kingsize_get_attachment_id_from_url( $attachment_url = '' ) {
 
	global $wpdb;
	$attachment_id = false;
 
	// If there is no url, return.
	if ( '' == $attachment_url )
		return;
 
	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();
 
	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
 
		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 
		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
 
	}
 
	return $attachment_id;
}

function kingsize_get_the_post_thumbnail_url($id = null, $size = 'full') {
    //if no post thumbnail is set, return empty string
    if(!has_post_thumbnail($id))
        return '';

    //get the post thumbnail
    $text = get_the_post_thumbnail($id, $size);

    //initialize the variables
    $src = '';
    $matches = array();

    //set the match string
    $src_pattern = '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i';

    //match it
    if(preg_match($src_pattern, $text, $matches)) {
        $src = $matches[1];
    }

    return trim($src);
}

function kingsize_thumb_box($postid,$str_crop='') {

	global $no_of_page_columns,$data;

	$lightbox = "true";

	$image_portfolio = get_post_meta($postid, 'upload_image', true);
	$video_thumb_image = get_post_meta($postid, 'upload_image_thumb', true);
	$video = get_post_meta($postid, 'kingsize_video_url', true);
	$height = get_post_meta($postid, 'kingsize_video_height', true);
	$embed = trim(get_post_meta($postid, 'kingsize_embed_code', true));
	
	if($height=='')
		$lightbox_height = 350;
	else
		$lightbox_height = $height + 20;

	if($image_portfolio != '')
		$overview_image = $image_portfolio;
	elseif($video_thumb_image!='')
		$overview_image = $video_thumb_image;
	else
		$overview_image = kingsize_get_the_post_thumbnail_url($postid);

	
	
	//Added in V 4.1.3 to exclude the featured image into portfolio lightbox
		$exclude_featured = false;
	if(get_post_meta( $postid, 'kingsize_exclude_portfolio_thumb', true ) == 1)
		$exclude_featured = true;
	else
		$exclude_featured = false;

	#### Getting the attachments image items for portfoio V4 ####
	$args = array('post_type' => 'attachment', 'post_parent' => $postid,  'orderby' => "menu_order ID", 'order' => 'ASC'); 
	$attachments = get_children($args); 
			



	##### Getting the number of columns	#####
	if(empty($no_of_page_columns))
		$no_of_page_columns = "2columns";
	
	if($no_of_page_columns=="2columns"){
		/*Make it responsive V5*/
		$url_post_img = wm_image_resize('400','250', $overview_image,$str_crop);
	}
	elseif($no_of_page_columns=="3columns"){
		$url_post_img = wm_image_resize('400','250', $overview_image,$str_crop);
	}
	elseif($no_of_page_columns=="4columns"){
		$url_post_img = wm_image_resize('400','250', $overview_image,$str_crop);
	}
	elseif($no_of_page_columns=="grid"){
		$url_post_img = wm_image_resize('112','112', $overview_image,$str_crop);
		$url_post_img = wm_image_resize('500','500', $overview_image,$str_crop);
	}
	//7/29/2014 

	if(empty($no_of_page_columns))
		$no_of_page_columns = "2columns";

	if($no_of_page_columns=="2columns"){
		$class_hover = "gallery_2col";
	}
	elseif($no_of_page_columns=="3columns"){
		$class_hover = "gallery_3col";
	}
	elseif($no_of_page_columns=="4columns"){
		$class_hover = "gallery_4col";
	}
	elseif($no_of_page_columns=="grid"){
		$class_hover = "gallery_grid";
	}
	
	###### End number of columns ######

	#### Getting the thumbnail ####
	if($overview_image == '')
	{
		if ( function_exists('has_post_thumbnail') && has_post_thumbnail($postid) ) 
		{

		 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($postid), 'thumbnail-post' );

		if (!$thumbnail[0]) 
			return false;
		else 
			$url_post_img = $thumbnail[0];
		}
	}

	if($data["wm_lazyloader_option"] == "Enable Lazyloader") :
		$thumb = '<img class="lazy" data-original="'.$url_post_img.'" src="'.get_template_directory_uri().'/images/loading.gif" title="'.get_the_title().'">';
	else :
		$thumb = '<img src="'.$url_post_img.'"  title="'.get_the_title().'">';
	endif;
	
	###### SETTING of the portfolio thumbnail link #########
	if(get_post_meta( $postid, 'portfolios_thumbnail_link', true ) != '') :
		$lightbox = 'false';
		$permalink = get_post_meta( $postid, 'portfolios_thumbnail_link', true );
	else :
		$lightbox = 'true';	
		$permalink = get_permalink( $postid );
	endif;

	#### SETTING of Lightbox on Portfolio write up panel #######
	if(get_post_meta( $postid, 'portfolios_lightbox_disable', true ) == 'disable') :
		$lightbox = 'false';
	else :
		$lightbox = 'true';		
	endif;
	
	####### CHECKING of lightbox effect is enabled or not ######
	if($lightbox == 'true') {			

		if($embed != '')
		{
			// we get the width & height
			preg_match('/width="([0-9]+)"/', $embed, $matches_width);
			preg_match('/height="([0-9]+)"/', $embed, $matches_height);
			$height = $matches_height[1];
			$width = $matches_width[1];

			$output = '<a rel="prettyPhoto[gallery-'.$postid.']" title="'.get_the_title($postid).'" href="'.get_template_directory_uri().'/lib/portfolio/kingsize-portfolio-video.php?id='.$postid.'&iframe=true&width='.$width.'&height='.$height.'" class="video '.$class_hover.'">'.$thumb.'</a>';
		}
		elseif($video != '' && $embed == '') 
		{
			$output = '<a rel="prettyPhoto[gallery-'.$postid.']" title="'.get_the_title($postid).'" href="'.$video.'" class="video '.$class_hover.'">'.$thumb.'</a>';
		}
		else
		{
			####### Getting the file name ########
			//patched in 4.1 thumbnail not showing in lightbox correct size
			$attachment_id = kingsize_get_attachment_id_from_url($overview_image);
			$image_attributes = wp_get_attachment_image_src( $attachment_id,"full" );			
			
			if($image_attributes["0"]!='')
				$image_path  = $image_attributes["0"];
			else
				$image_path  = $overview_image;
			
			//Added in V 4.1.3 to exclude the portfolio thumb
			if($exclude_featured == true)
			{
				
				if ($attachments) { 

					$i = 0;
					$featured_exclude_img_fst = "";
					$featured_exclude_attachID_fst = "";
					
					foreach ($attachments as $attachment) 
					{ 	
						if($attachment_id != $attachment->ID) {

							if($i == 0):
								//Image URL
							    $featured_exclude_attachID_fst = $attachment->ID;
								$featured_exclude_img_fst = wp_get_attachment_url($attachment->ID);
								
								//Title and Description
								if(!empty($attachment->post_content))
									$post_title = $attachment->post_title."<p>".strip_tags($attachment->post_content)."</p>";
								else
									$post_title = $attachment->post_title;

								if(get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) == "")
									$post_alt = $attachment->post_title;
								else
									$post_alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);

							endif;
							
						$i++;
					  }

					}
					$output = '<a rel="prettyPhoto[gallery-'.$postid.']" title="'.$post_title.'" href="'.$featured_exclude_img_fst.'" class="image '.$class_hover.'">'.$thumb.'</a>';
				}

			}	
			else{

				$attachment = get_post( $attachment_id );
				
				//Title and Description
				if(!empty($attachment->post_content))
					$post_title = $attachment->post_title."<p>".strip_tags($attachment->post_content)."</p>";
				else
					$post_title = $attachment->post_title;

				if(get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) == "")
					$post_alt = $attachment->post_title;
				else
					$post_alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);


				$output = '<a rel="prettyPhoto[gallery-'.$postid.']" title="'.$post_title.'" href="'.$image_path.'" class="image '.$class_hover.'">'.$thumb.'</a>';
			}

		}	

		#### Getting the attachments image items for portfoio V4 ####
			if ($attachments) { 
				$i=0;
				foreach ($attachments as $attachment) 
				{ 	
					if($exclude_featured == true) //exclude has been checked for feature image
					{
						if($featured_exclude_attachID_fst != $attachment->ID && $attachment_id != $attachment->ID ) //ignoring first image
						{
							//Title and Description	
							if(!empty($attachment->post_content))
								$post_title = $attachment->post_title."<p>".strip_tags($attachment->post_content)."</p>";
							else
								$post_title = $attachment->post_title;

							if(get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) == "")
								$post_alt = $attachment->post_title;
							else
								$post_alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);


							$url_post_img = wm_image_resize('330','220', wp_get_attachment_url($attachment->ID),$str_crop);
		
							$output .= '<ul style="display:none;"><li><a href="'.wp_get_attachment_url($attachment->ID).'" title="'.$post_title.'" rel="prettyPhoto[gallery-'.$postid.']"><img  src="'.$url_post_img.'"  title="'.$post_title.'" /></a></li></ul>';
						}
					}
					else{ //exclude has been not checked for feature image
					
						if( $attachment_id != $attachment->ID ) //ignoring first image
						{
							//Title and Description	
							if(!empty($attachment->post_content))
								$post_title = $attachment->post_title."<p>".strip_tags($attachment->post_content)."</p>";
							else
								$post_title = $attachment->post_title;

							if(get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) == "")
								$post_alt = $attachment->post_title;
							else
								$post_alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);


							$url_post_img = wm_image_resize('330','220', wp_get_attachment_url($attachment->ID),$str_crop);
		
							$output .= '<ul style="display:none;"><li><a href="'.wp_get_attachment_url($attachment->ID).'" title="'.$post_title.'" rel="prettyPhoto[gallery-'.$postid.']"><img  src="'.$url_post_img.'"  title="'.$post_title.'" /></a></li></ul>';
						}
					}
					
			    }
			}
		#### End attachments image items for portfoio V4 #######
	}
	else {			
		$output = '<a title="'.get_the_title($postid).'" href="'.$permalink.'" class="custom-port">'.$thumb.'</a>';
	}
	
	echo $output;
}

?>
