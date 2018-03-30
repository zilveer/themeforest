<?php

global $smof_data;
$background_images = array();

if ( is_404() ) {
	if (!empty($smof_data['404_image'])) {
		$background_images[] = $smof_data['404_image'];
	}
} else {
	if ( is_singular() ) {
		if ( function_exists('has_post_thumbnail') && has_post_thumbnail() ) {
			$image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
			if (!empty($image_url)) {
				$background_images[] = $image_url;
			}
		}
		$additional_images = rwmb_meta( 'additional_images', array('type' => 'image', 'size' => 'large' ) );
		foreach ($additional_images as $image) {
			$background_images[] = $image['full_url'];
		}
	}
}

if (count($background_images)==0) {
	if (empty($smof_data['background_fallback'])) {
		$background_images[] = 'http://placehold.it/1080x860&text=set%20image';
	} else {
		$background_images[] = $smof_data['background_fallback'];
	}
} ?>
	<span id="supersized-loader"></span>
	<ul id="supersized"></ul>
	<a class="supersized-fullscreen"><span></span></a>
	<a class="supersized-prev"><span></span></a>
	<a class="supersized-next"><span></span></a>

	<script type='text/javascript'>
		<?php
		if (!empty($smof_data['supersized_autoplay']))
			echo "var supersized_autoplay = " . $smof_data['supersized_autoplay'] . "; ";
		if (!empty($smof_data['supersized_slide_interval']))
			echo "var supersized_slide_interval = " . ((int) $smof_data['supersized_slide_interval']) * 1000 . "; ";
		if (!empty($smof_data['supersized_transition']))
			echo "var supersized_transition = '" . $smof_data['supersized_transition'] . "'; ";
		if (!empty($smof_data['supersized_transition_speed']))
			echo "var supersized_transition_speed = " . ((int) $smof_data['supersized_transition_speed']) . "; ";
		if (!empty($smof_data['supersized_performance']))
			echo "var supersized_performance = " . str_replace('perf_','',$smof_data['supersized_performance']) . "; ";
?>

		var supersized_slides = [
<?php
		$gallery_count = count($background_images);
		$i = 0;
		if ($gallery_count > 0)
		foreach ($background_images as $image) : ?>
			{
				image : '<?php echo esc_url($image); ?>'
			}<?php if (++$i < $gallery_count) echo ',';

		endforeach; ?>

		];
	</script>
