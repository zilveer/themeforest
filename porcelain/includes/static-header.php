<div class="static-header-img">
	<?php
	if ( has_post_thumbnail() ) {
		global $post, $pexeto_content_sizes;
		$img_url = pexeto_get_featured_image_url($post->ID);
		$img_url = pexeto_get_resized_image($img_url, $pexeto_content_sizes['container'], pexeto_option('static_header_height'));
		?><img src="<?php echo $img_url; ?>" /><?php 
	} ?>
</div>
