<article <?php post_class(); ?>>
<div class="post__inwrap">



	<?php if( has_post_thumbnail() ): ?>

		<div class="post__media">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail( 'xs' ); ?>
			</a>
		</div>

	<?php endif; ?>



	<div class="post__text">
		<h6>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_title(); ?>
			</a>
		</h6>
	</div>



</div>
</article>