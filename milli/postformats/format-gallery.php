<?php
	/**
	 * If attachments exist, decalare post and get ready to process attachments
	 */
	global $post;
	
	/**
	 * Get post attachments
	 */
	$thumb_id = get_post_thumbnail_id( $post->ID );
	$args = array(
	    'post_type' => 'attachment',
	    'post_mime_type'  => 'image/jpeg',
	    'orderby' => 'menu_order',
	    'numberposts' => -1,
	    'order' => 'ASC',
	    'post_parent' => $post->ID,
	    'exclude' => $thumb_id // Exclude featured thumbnail
	);
	$attachments = get_posts($args);
	
	/**
	 * First, check for attachments, if none exist, exit this file and contine page load as normal.
	 */
	if(! $attachments )
		return false;
?>

<div class="flexslider">
  <ul class="slides">
  
		<?php 
			/**
			 * Finally, echo out the gallery of images
			 */	
			foreach ( $attachments as $attachment ) :
				
				$resized_image = aq_resize($attachment->guid, 938, 9999, 0);
				if(!( $resized_image ))
					$resized_image = $attachment->guid;
				$attach_alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
		
				echo '<li><img src="' . $resized_image . '" alt="'. $attach_alt .'" width="938" height="600"/>';
				if( $attachment->post_excerpt )
					echo '<p class="flex-caption">'. $attachment->post_excerpt .'</p>';
				echo '</li>';
			
			endforeach;
		?>

  </ul>
</div>