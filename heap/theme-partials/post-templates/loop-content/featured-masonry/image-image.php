<?php
if ( has_post_thumbnail() ) {
	$archive_image_size = 'small-size';

	// adapt the image size by the number of columns
	$masonry_medium_width = heap_option( 'blog_layout_masonry_medium_columns' );
	$masonry_big_width    = heap_option( 'blog_layout_masonry_big_columns' );

	// we need images bigger than 400px when there might be an one column archive type(except the mobile devices where they fit)
	if ( $masonry_big_width < 2 || $masonry_medium_width < 2 ) {
		$archive_image_size = 'medium-size';
	}

	$image       = wp_get_attachment_image_src( get_post_thumbnail_id(), $archive_image_size );
	$image_ratio = 70; //some default aspect ratio in case something has gone wrong and the image has no dimensions - it happens
	if ( isset( $image[1] ) && isset( $image[2] ) && $image[1] > 0 ) {
		$image_ratio = $image[2] * 100 / $image[1];
	}
} else {
	// we need to search for an image in the content
	// like it should be
	$image    = array();
	$image[0] = heap_get_post_format_first_image_src();

	$image_ratio = 70; //some default aspect ratio in case something has gone wrong and the image has no dimensions - it happens
}

if ( ! empty( $image[0] ) ) { ?>
	<div class="article__featured-image" style="padding-top: <?php echo $image_ratio; ?>%">
		<a href="<?php the_permalink(); ?>">
			<img src="<?php echo $image[0] ?>" alt="<?php the_title(); ?>"/>

			<div class="article__featured-image-meta">
				<div class="flexbox">
					<div class="flexbox__item">
						<hr class="separator"/>
						<span class="read-more"><?php _e( 'Read more', 'heap' ) ?></span>
						<hr class="separator"/>
					</div>
				</div>
			</div>
		</a>
	</div>
<?php }