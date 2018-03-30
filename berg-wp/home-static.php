<?php
	$imgUrl = 'http://placehold.it/1440x900&amp;text=Please+select+featured+image';
	if ( has_post_thumbnail()) {
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large_bg');
		$imgUrl = $large_image_url[0];
	};
	$post_meta = get_post_meta(get_the_ID());
	$section_home_opacity = 0;
	$opacity = 70;

	if(isset($post_meta['section_home_opacity'][0])) {
		$section_home_opacity = $post_meta['section_home_opacity'][0];
		$opacity = $section_home_opacity; 
	}

?>


<div class="home-bg-image opacity-<?php echo $opacity ;?>" data-background="<?php echo $imgUrl ?>"></div>