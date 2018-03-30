<?php
/**
 * Nivo slider in the content of a post/page template.
 */
global $pexeto_page, $post, $pexeto_scripts;

$columns = isset($pexeto_page['columns']) ? $pexeto_page['columns'] : 1;
$img_size = pexeto_get_image_size_options($columns, 'blog');

?>
<div class="post-gallery">
	
	<?php
	//retrieve the attachment images
	$images = pexeto_get_nivo_post_images($post, $img_size);

	//slider navigation
	$options = pexeto_get_nivo_args('_post');
	
	$slider_div_id = 'post-gallery-'.$post->ID;

	echo pexeto_get_nivo_slider_html($images, $options, $slider_div_id, $img_size['height'], $img_size['crop']);

	?>

</div>
