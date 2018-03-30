<?php
/*
YARPP Template: Mental
Description: Requires a theme which supports post thumbnails
Author: Vedmant <vedmant@gmail.com>
*/
defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call
?>

<div class="related-posts">
	<h2 class="rp-title">Related Posts</h2>
	<?php if ( have_posts() ): ?>

		<div class="row">

			<?php while( have_posts() ) : the_post(); ?>
				<?php if ( has_post_thumbnail() ): ?>
					<div class="col-sm-4 text-center">
						<div class="rp-item">
							<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"
							   class="rp-image img-eye-hover">
								<?php the_post_thumbnail( 'medium' ); ?>
							</a>
							<h5><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
						</div>
					</div>
				<?php endif; ?>
			<?php endwhile; ?>

		</div>

	<?php else: ?>
		<p><?php _e( 'No related posts.', 'mental' ) ?></p>
	<?php endif; ?>

</div>
<!-- related-posts -->