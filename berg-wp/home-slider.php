<?php
	if ( has_post_thumbnail()) {
	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large_bg');
	}
	$post_meta = get_post_meta(get_the_ID());
	$section_home_opacity = '';
	$opacity = '';

	if(isset($post_meta['section_home_opacity'][0])) {
		$section_home_opacity = $post_meta['section_home_opacity'][0];
		$opacity = $section_home_opacity; 
	} 

?>

<section class="item hidden-xs">
	<div class="slider-wrapper">
		<div id="slides">

			<ul class="slides-container <?php echo 'opacity-'.$opacity;?>">
			<?php
				$slides = get_post_meta(get_the_id(), 'home_slider', true);
				$slides = explode(',', $slides);
				if(is_array($slides)) {
					foreach($slides as $slide) {
						echo '<li>';
						$image = wp_get_attachment_image_src($slide, 'large_bg');
						if($image == '') {
							$imgUrl = 'http://placehold.it/1440x900&amp;text=Please+select+featured+image';
						} else {
							$imgUrl = $image[0];
						}
						echo '<img src="'.$imgUrl.'" alt=""/>';
						echo '</li>';
					}
				}
			?>
			</ul>
		</div>
	</div>
</section>

<script>slideDuration = <?php echo (isset($post_meta['slides_duration'][0]) && $post_meta['slides_duration'][0] > 100 ) ? $post_meta['slides_duration'][0] : 5000; ?></script>