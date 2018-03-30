<?php
    
$gallery_ids = get_post_meta( wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix() . 'main_gallery', true );
if (!empty($gallery_ids)) {
	$gallery_ids = explode(',',$gallery_ids);
} else {
	$gallery_ids = array();
}

if ( !empty($gallery_ids) ) {
	$attachments = get_posts( array(
		'post_type' => 'attachment',
		'posts_per_page' => -1,
		'orderby' => "post__in",
		'post__in'     => $gallery_ids
	) );
} else {
	$attachments = array();
}

$image_scale_mode = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix().'post_slider_image_scale', true);
$slider_transition = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix().'post_slider_transition', true);
$slider_autoplay = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix().'post_slider_autoplay', true);
if ($slider_autoplay) {
	$slider_delay = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix().'post_slider_delay', true);
}
$slider_height = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix().'post_slider_height', true);
if($slider_height == '') $slider_height = '525';
$slider_captions = true;

$slider_visiblenearby = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix() . 'post_slider_visiblenearby', true);

// let's get to know this post a little better
$full_width_featured_image = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix() . 'full_width_featured_image', true);
$disable_sidebar = get_post_meta(wpgrade::lang_post_id(get_the_ID()), wpgrade::prefix() . 'disable_sidebar', true);

// let's use what we know
$content_width = $disable_sidebar == 'on' ? 'one-whole' : 'two-thirds';
$featured_image_width = $full_width_featured_image == 'on' || $disable_sidebar == 'on' ? 'one-whole' : 'two-thirds  palm-one-whole';

$arrows_class= '';

if($full_width_featured_image == 'on' || $disable_sidebar == 'on') $arrows_class = '  arrows--outside';

if ($attachments): ?>
<div class="grid__item  float--left  <?php echo $featured_image_width; ?>  article__featured-image">
	<div class="pixslider js-pixslider<?php echo $arrows_class; ?>"
		data-arrows
		data-fullscreen
		data-imagealigncenter
		data-autoscalesliderwidth="1050"
		data-autoscalesliderheight="<?php echo $slider_height; ?>"
		data-imagescale="<?php echo $image_scale_mode; ?>"
		data-slidertransition="<?php echo $slider_transition; ?>"
		<?php if ($slider_autoplay) {
			echo 'data-sliderautoplay="" ';
			echo 'data-sliderdelay="'. $slider_delay.'" ';
		} 
		
		if ($slider_visiblenearby) {
			echo ' data-visiblenearby="" ';
		}
		
		if ($slider_captions) {
			echo 'data-showcaptions="" ';
		}
		?> >
		<?php
		foreach ($attachments as $attachment):
			$class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
			$thumbimg = wp_get_attachment_image_src($attachment->ID, 'blog-big');
			$attachment_fields = get_post_custom( $attachment->ID );

			// check if this attachment has a video url
			$video_url = ( isset($attachment_fields['_video_url'][0] ) && !empty( $attachment_fields['_video_url'][0]) ) ? esc_url( $attachment_fields['_video_url'][0] ) : '';

			//  if there is a video let royal slider know about it
			if ( !empty($video_url) ) { ?>
				<div class="gallery__item video">
					<img src="<?php echo $thumbimg[0]; ?>" class="rsImg  invisible" data-rsVideo="<?php echo $video_url; ?>" />
					<span class="wp-caption  gallery__item__caption  rsCaption">
						<span class="wp-caption-text">
							<?php echo $attachment->post_excerpt; ?>
						</span>
					</span>
				</div>
			<?php } else { ?>
				<div class="gallery__item" itemscope itemtype="http://schema.org/ImageObject" >
					<img src="<?php echo $thumbimg[0]; ?>" class="attachment-blog-big  rsImg  invisible" alt="" itemprop="contentURL" />
					<span class="wp-caption  gallery__item__caption  rsCaption">
						<span class="wp-caption-text">
							<?php echo $attachment->post_excerpt; ?>
						</span>
					</span>
				</div>
			<?php }
		endforeach; ?>
	</div>
</div>
<?php endif; ?>