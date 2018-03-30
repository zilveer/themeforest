<?php
/**
 * The template used to display  Archive pages
 *
 */
 
get_header(); ?>

		<section id="main" class="content-box grid_8 alpha">
			<div class="inner-content">
			<?php if ( have_posts() ) : ?>

				<div class="page-header">
					<span class="page-title">
					<?php 
					
					    //check which archive is used(Tags, Author or Category)
				        if( is_tag() ) {
							printf( __( 'All posts in %s', 'stylico'), '<span>' . single_tag_title( '', false ) . '</span>' );
						}
						else if ( is_author() ) {
							global $post;
							printf( __( 'All posts by %s', 'stylico'), '<span>' . get_the_author_meta( 'nickname', $post->post_author ) . '</span>' );
						}
						else if ( is_category() ) {
							printf( __( 'All posts in %s', 'stylico'), '<span>' . single_cat_title( '', false ) . '</span>' );
						}
					?>
                    </span>
				</div>

				<?php while ( have_posts() ) : the_post();
                    
					//include loop
					get_template_part('loop');
					
					//loop end
					endwhile; 
					
					//include pagination nav
					stylico_content_nav();
					
				?>

			<?php else : ?>

				<article>
					<div class="entry-header">
						<span class="entry-title"><?php _e( 'Nothing Found', 'stylico'); ?></span>
					</div>

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'stylico'); ?></p>
					</div> 
				</article>

			<?php endif; ?>

			</div>
		</section>

        <?php get_sidebar(); ?>
        
<?php get_footer(); ?>
