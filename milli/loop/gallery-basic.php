<div class="isotope-wrapper">

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
		
		/**
		 * Declare image directory
		 */
		$image_directory = get_template_directory_uri() . '/img/';
		
		/**
		 * Get Image Crops
		 */
		$crop_width = get_post_meta( $post->ID, '_ebor_crop_width', true );
		$crop_height = get_post_meta( $post->ID, '_ebor_crop_height', true );
		$crop_resize = get_post_meta( $post->ID, '_ebor_crop_resize', true );
		$item_margin = get_post_meta( $post->ID, '_ebor_item_margin', true );
		
		/**
		 * Validate Image Crops
		 */
		if(!( $crop_width ) || !( is_numeric( $crop_width ) ) || $crop_width == '' )
			$crop_width = 25;
			
		if(!( $crop_height ) || !( is_numeric( $crop_height ) ) || $crop_height == '' )
			$crop_height = 100;
			
		if(!( $item_margin ) || !( is_numeric( $item_margin ) ) || $item_margin == '' )
			$item_margin = 0;
			
		( $crop_resize == '' ) ? $crop_resize = 0 : $crop_reszie = 1;
	?>
	
		<style type="text/css">
			.gallery-image {
				padding: <?php echo $item_margin; ?>px;
				width: <?php echo $crop_width - 0.15; ?>%;
			}
		</style>
		
	<?php
		( get_option('menu_style','side') == 'side' ) ? $crop_width = $crop_width * 10 : $crop_width = $crop_width * 12.4;
		$crop_width = round( $crop_width );
		
		$target = '';
		if( get_post_meta($post->ID, '_ebor_target_blank', true) )
			$target = '_blank';
		
	
	/**
	 * Finally, echo out the gallery of images
	 */	
	foreach ( $attachments as $attachment ) :
		
		/**
		 * Resize Images and grab image meta
		 */
		$resized_image = aq_resize($attachment->guid, $crop_width, $crop_height, $crop_resize);
		$attach_alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
		
		/**
		 * Check if the image actualy resized, otherwise return orignal image
		 */
		($resized_image) ? $final_image = $resized_image : $final_image = $attachment->guid;
		
		echo '<div class="gallery-image">';
		
		if( current_user_can('edit_post', $attachment->ID ) )
			echo '<a onclick="return confirm(\'Do you really want to delete this attachment?\')" href="' . get_delete_post_link( $attachment->ID, '', true ) . '" class="delete-link"><i class="fa fa-times"></i></a>';
		
		if( $attachment->post_excerpt ) {
			echo '<a href="'. esc_url($attachment->post_excerpt) .'" title="'.$attachment->post_title.'" target="' . $target . '">'; 
		} elseif( get_post_meta($post->ID, '_ebor_attachment_link', true) ) {
			echo '<a href="' . get_permalink($attachment->ID) . '" title="'.$attachment->post_title.'" target="' . $target . '">';
		} elseif( get_post_meta($post->ID, '_ebor_no_links', true) ) {
			//nothing
		} else {
			echo '<a href="'.$attachment->guid.'" class="view" rel="gallery" title="'.$attachment->post_title.'">'; 
		}
		
		echo '<img src="' . $image_directory . 'loader.gif" alt="'.$attach_alt.'" data-src="' . $final_image . '" width="'.$crop_width.'" height="'.$crop_height.'"/>';
		
		if(!( get_post_meta($post->ID, '_ebor_no_links', true) ))
			echo '</a>';
		
		echo '</div>';
	
	endforeach;
	
	?>
	
</div>