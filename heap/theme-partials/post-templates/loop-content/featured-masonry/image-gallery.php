<?php
global $post;

$gallery_ids = get_post_meta( get_the_ID(), '_heap_main_gallery', true );
if ( ! empty( $gallery_ids ) ) {
	$gallery_ids = explode( ',', $gallery_ids );
} else {
	// empty gallery_ids
	// search for the first gallery shortcode
	$gallery_matches = null;
	preg_match( '!\[gallery.*ids="(.*?)".*\]!', $post->post_content, $gallery_matches );

	//get the id list comma separated
	if ( ! empty( $gallery_matches ) && ! empty( $gallery_matches[1] ) ) {
		//some cleanup first
		$gallery_matches[1] = str_replace( ' ', '', trim( $gallery_matches[1] ) );

		//now the mighty array - kboom
		$gallery_ids = explode( ',', $gallery_matches[1] );
	} else { // gallery_matches is empty or no ids found
		$gallery_ids = '';
	}
}

if ( ! empty( $gallery_ids ) ) {
	$attachments = get_posts( array(
		'post_type'      => 'attachment',
		'posts_per_page' => - 1,
		'orderby'        => "post__in",
		'post__in'       => $gallery_ids
	) );
} else {
	$attachments = array();
}

//lets get to work
if ( ! empty( $attachments ) ) {

	$slider_transition = get_post_meta( get_the_ID(), '_heap_post_slider_transition', true );
	$slider_autoplay   = get_post_meta( get_the_ID(), '_heap_post_slider_autoplay', true );
	if ( $slider_autoplay ) {
		$slider_delay = get_post_meta( get_the_ID(), '_heap_post_slider_delay', true );
	}

	$slider_height = get_post_meta( get_the_ID(), '_heap_post_slider_height', true );
	if ( $slider_height == '' || $slider_height == '0' ) {
		$slider_height = '300';
	}

	$slider_visiblenearby = get_post_meta( get_the_ID(), '_heap_post_slider_visiblenearby', true );

	$archive_image_size = 'small-size';

	// adapt the image size by the number of columns
	$masonry_medium_width = heap_option( 'blog_layout_masonry_medium_columns' );
	$masonry_big_width    = heap_option( 'blog_layout_masonry_big_columns' );

	// we need images bigger than 400px when there might be an one column archive type(except the mobile devices where they fit)
	if ( $masonry_big_width < 2 || $masonry_medium_width < 2 ) {
		$archive_image_size = 'medium-size';
	} ?>
	<div class="article__featured-image">
		<div class="pixslider js-pixslider"
		     data-customarrows
		     data-imagealigncenter
		     data-autoscalesliderwidth="300"
		     data-autoscalesliderheight="300"

		     data-imagescale="fill"
		     data-slidertransition="<?php echo $slider_transition; ?>"
			<?php if ( $slider_autoplay ) {
				echo 'data-sliderautoplay="" ';
				echo 'data-sliderdelay="' . $slider_delay . '" ';
			} ?> >
			<?php
			foreach ( $attachments as $attachment ) {
				$class    = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
				$thumbimg = wp_get_attachment_image_src( $attachment->ID, $archive_image_size ); ?>
				<div class="gallery__item" itemscope itemtype="http://schema.org/ImageObject">
					<a href="<?php echo $thumbimg[0]; ?>" class="attachment-medium-size  rsImg  invisible"></a>
					<?php if ( ! empty( $attachment->post_excerpt ) ) { ?>
						<span class="wp-caption  gallery__item__caption  rsCaption">
					<span class="wp-caption-text">
						<?php echo $attachment->post_excerpt; ?>
					</span>
				</span>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>
<?php }
