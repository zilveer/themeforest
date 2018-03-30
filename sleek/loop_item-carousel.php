<?php
	$theme_settings = sleek_theme_settings();

	$post_classes = '';
	$post_classes .= ' sleek-carousel__item';

	$image_light = get_post_meta( get_the_ID(), 'image_is_light', true );
	if( $image_light ){
		$post_classes .= ' image-light';
	}
?>



<article <?php post_class( $post_classes ); ?>>
<div class="post__inwrap">



	<!-- Format: Standard -->

	<!-- post media -->
	<div class="post__media">
	<?php if ( has_post_thumbnail()) : ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<?php the_post_thumbnail( 'square-m' ); ?>
		</a>
	<?php endif; ?>
	</div>
	<!-- /post media -->


	<!-- post content -->
	<div class="post__text">

		<?php get_template_part('post_meta', 'nodate'); ?>

		<h2>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>

		<?php // sleek_wp_excerpt('sleek_excerpt_length', false); ?>

	</div>
	<!-- /post content -->

	<!-- /Format: Standard -->



</div>
</article>