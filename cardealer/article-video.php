<?php
if (!defined('ABSPATH')) exit();

if (is_single()) {
	$video_width = 840;
	$video_height = 500;
} else {
	$video_width = 460;
	$video_height = 290;
}

$post_type_values = get_post_meta( get_the_ID(), 'post_type_values', true );
$source_url = $post_type_values['video'];
$cover_image = isset($post_type_values['video_cover_image']) ? $post_type_values['video_cover_image'] : '';
$cover_image_on_mobiles = isset($post_type_values['video_cover_image_on_mobiles']) ? (int) $post_type_values['video_cover_image_on_mobiles'] : 0;

$attributes = array(
	'width="' . $video_width . '"',
	'height="' . $video_height . '"',
);

if ($cover_image) {
	$attributes[] = 'cover_image="' . esc_url($cover_image) . '"';

	if ($cover_image_on_mobiles) {
		$attributes[] = 'cover_image_on_mobiles="' . $cover_image_on_mobiles . '"';
	}

} else {
	$attributes[] = 'cover_id="' . $post->ID . '"';
}

if (!empty($source_url)) {
	?>
	<div class='entry-image'>
		<?php echo do_shortcode('[tmm_video ' . implode(' ', $attributes) . ']' . esc_url($source_url) . '[/tmm_video]'); ?>
	</div>
	<?php
}