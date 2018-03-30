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
	
	$i = 0;
	

/**
 * Finally, echo out the gallery of images
 */	
foreach ( $attachments as $attachment ) :
	$i++;
	
	( $i % 5 == 0 ) ? $last = 'last' : $last = '';
	
	/**
	 * Resize Images and grab image meta
	 */
	$resized_image = aq_resize($attachment->guid, 280, 280, 1);
	$attach_alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
	
	echo '<div class="one_fifth '. $last .'">';
	
	if( current_user_can('edit_post', $attachment->ID ) )
		echo '<a onclick="return confirm(\'Do you really want to delete this attachment?\')" href="' . get_delete_post_link( $attachment->ID, '', true ) . '" class="delete-link"><i class="fa fa-times"></i></a>';
	
	echo '<a href="'.$attachment->guid.'" class="view" rel="gallery-'. get_the_ID() .'" title="'.$attachment->post_title.'">'; 
	echo '<img src="' . $image_directory . 'loader.gif" alt="'.$attach_alt.'" data-src="' . $resized_image . '" />';
	echo '</a></div>';

endforeach;