<?php
/**
 * The loop that displays a single post.
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class('single'); ?>>
					<div class="entry-meta">
						<?php cherry_posted_on(); ?>
                        <div class="blog-post-img-wrapper">
                        <?php the_post_thumbnail('blog-single'); ?>
                        <h2 class="entry-title"><?php the_title(); ?></h2>
                        </div>
                    </div><!-- .entry-meta -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'cherry' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

					<div class="entry-utility">
						<?php cherry_posted_in(); ?>
					</div><!-- .entry-utility -->
				</div><!-- #post-## -->
				
                <div class="clear"></div>
        		<h1 class="homepage-section-title"><span><?php _e( 'Navigate', 'cherry' ); ?></span></h1>
				<div id="nav-below" class="navigation">
                    <div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&#171;', 'Previous post link', 'cherry' ) . '</span> %title' ); ?></div>
                    <div class="nav-next"><?php next_post_link( '%link', '%title  <span class="meta-nav">' . _x( '&#187;', 'Next post link', 'cherry' ) . '</span>' ); ?></div>
                </div><!-- #nav-below -->
				
				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>