<?php
global $post;

$gallery_ids = get_post_meta( get_the_ID(), '_heap_main_gallery', true );
if (!empty($gallery_ids)) {
	$gallery_ids = explode(',',$gallery_ids);
} else {
	// empty gallery_ids
	// search for the first gallery shortcode
	$gallery_matches = null;
	preg_match('!\[gallery.*ids="(.*?)".*\]!', $post->post_content, $gallery_matches);

	//get the id list comma separated
	if ( ! empty($gallery_matches) && ! empty($gallery_matches[1])) {
		//some cleanup first
		$gallery_matches[1] = str_replace(' ','',trim($gallery_matches[1]));

		//now the mighty array - kboom
		$gallery_ids= explode(',',$gallery_matches[1]);
	}
	else { // gallery_matches is empty or no ids found
		$gallery_ids = '';
	}
}

if ( !empty($gallery_ids) ) {
	$attachments = get_posts( array(
		'post_type' => 'attachment',
		'posts_per_page' => -1,
		'orderby' => "post__in",
		'post__in' => $gallery_ids
	) );
} else {
	$attachments = array();
}

//lets get to work
if (!empty($attachments)):

	$image_scale_mode = get_post_meta(get_the_ID(), '_heap_'.'post_image_scale_mode', true);
	$slider_transition = get_post_meta(get_the_ID(), '_heap_'.'post_slider_transition', true);
	$slider_autoplay = get_post_meta(get_the_ID(), '_heap_'.'post_slider_autoplay', true);
	if ($slider_autoplay) {
		$slider_delay = get_post_meta(get_the_ID(), '_heap_'.'post_slider_delay', true);
	}
	$slider_height = get_post_meta(get_the_ID(), '_heap_'.'post_slider_height', true);
	if($slider_height == '') {
		$slider_height = '525';
	}
	$slider_captions = true;

	$slider_visiblenearby = get_post_meta(get_the_ID(), '_heap_post_slider_visiblenearby', true);

?>
	<div class="article__featured-image">
		<div class="pixslider js-pixslider"
			 data-arrows
			 data-imagealigncenter
			 <?php if ($slider_height == '0')
				 echo 'data-autoHeight="" ' . PHP_EOL;
			 else
				 echo 'data-autoscalesliderheight="'. $slider_height.'"' . PHP_EOL;
			 ?>
			 data-imagescale="<?php echo $image_scale_mode; ?>"
			 data-slidertransition="<?php echo $slider_transition; ?>"
			<?php if ($slider_autoplay) {
				echo 'data-sliderautoplay="" ';
				echo 'data-sliderdelay="'. $slider_delay.'" ' . PHP_EOL;
			}

			if ($slider_visiblenearby) {
				echo 'data-visiblenearby="" ' . PHP_EOL;
			}

			if ($slider_captions) {
				echo 'data-showcaptions="" ';
			}
			?> >
			<?php
			foreach ($attachments as $attachment):
				$class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
				$thumbimg = wp_get_attachment_image_src($attachment->ID, 'medium-size');
			?>
			<div class="gallery__item" itemscope itemtype="http://schema.org/ImageObject" >
				<a class="attachment-medium-size  rsImg  invisible" href="<?php echo $thumbimg[0]; ?>"></a>
				<?php if (! empty($attachment->post_excerpt)) : ?>
				<span class="wp-caption  gallery__item__caption  rsCaption">
					<span class="wp-caption-text">
						<?php echo $attachment->post_excerpt; ?>
					</span>
				</span>
				<?php endif; ?>
			</div>

			<?php
			endforeach; ?>
		</div>
	</div>
<?php endif;
