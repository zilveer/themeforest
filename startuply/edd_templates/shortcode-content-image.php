	<?php if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( get_the_ID() ) ) {
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
	} else {
		$thumb = array(get_template_directory_uri().'/images/no_img.jpg');
	} ?>
<span class="item-image" style="background-image: url('<?php echo $thumb['0'];?>')"></span>
