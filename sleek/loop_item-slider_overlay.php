<?php
	$theme_settings = sleek_theme_settings();

	$post_classes = '';
	$post_classes .= ' sleek-slider__item js-sleek-slider-item ';

	$image_light = get_post_meta( get_the_ID(), 'image_is_light', true );
	if( $image_light ){
		$post_classes .= ' image-light';
	}


?>



<article <?php post_class( $post_classes ); ?>>
<div class="post__inwrap sleek-slider__item-inwrap">



	<!-- Format: Standard -->

	<!-- post media -->

	<?php
		$featured_image_url = '';
		if ( has_post_thumbnail() ){
			$featured_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'xl' );
			$featured_image_url = $featured_image_url[0];
		}
	?>
	<div class="post__media" style="background-image:url(<?php echo $featured_image_url; ?>);">
	</div>

	<!-- /post media -->


	<!-- post content -->
	<div class="post__text">

		<h2>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>

		<?php sleek_wp_excerpt('sleek_excerpt_length', false); ?>

	</div>
	<!-- /post content -->

	<!-- /Format: Standard -->



</div>
</article>