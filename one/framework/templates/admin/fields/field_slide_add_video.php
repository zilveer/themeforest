<?php
	$preview = '';

	if( !empty($field_value_id) ) {
		$preview = thb_get_video_thumbnail( $field_value_id, 'thumbnail_small' );
		$previewClass = '';
	}

	if( $preview == '' ) {
		$preview = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==';
		$previewClass = 'video';
	}
?>

<span class="thb-video-preview <?php echo $previewClass; ?>">
	<img src="<?php echo $preview; ?>" class="thb-preview <?php echo $previewClass; ?>" alt="video preview">
</span>

<a class="thb-btn-edit" data-key="<?php echo $field->getName(); ?>" data-subtype="video" title="<?php _e( 'Edit', 'thb_text_domain' ) ?>"><?php _e( 'Edit', 'thb_text_domain' ) ?></a>
<a class="thb-btn-clone" title="<?php _e( 'Clone', 'thb_text_domain' ) ?>"><?php _e( 'Clone', 'thb_text_domain' ) ?></a>