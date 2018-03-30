<?php
	$post_classes = ' sleek-slider__item js-sleek-slider-item ';
?>



<?php if( has_post_thumbnail() ): ?>

	<article <?php post_class( $post_classes ); ?>>
	<div class="post__inwrap sleek-slider__item-inwrap">

		<!-- post media -->
			<div class="post__media">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail( 's' ); ?>
				</a>
			</div>
		<!-- /post media -->

		<!-- post content -->
		<div class="post__text">

			<h4>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_title(); ?>
				</a>
			</h4>

			<?php sleek_wp_excerpt('sleek_excerpt_length', false); ?>

		</div>
		<!-- /post content -->

	</div>
	</article>

<?php endif; ?>
