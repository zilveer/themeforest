<?php
/**
 * Common loop for the pages
 *
 * @package Organique
 */


if( have_posts() ) :
while( have_posts() ) :
	the_post();

?>

	<article <?php echo post_class(); ?>>

		<?php get_template_part( 'entry', 'title' ); ?>

		<div class="the-content">

			<?php the_excerpt(); ?>

			<a href="<?php the_permalink(); ?>" class="btn btn-primary bold higher uppercase"><?php _e('Read more' , 'organique_wp' ); ?></a>
		</div>

		<hr class="divider">

	</article>

<?php

endwhile;
endif;
