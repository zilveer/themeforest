<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package iEVENT
 */

get_header('blog'); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <div class="container with-sidebar">
                <div class="sixteen columns jx-ievent-padding alpha">
                    <?php while ( have_posts() ) : the_post(); ?>
            
                        <?php get_template_part( 'template-parts/content', 'single' ); ?>
                            
                            <!-- BDF Autor Box -->
                            
                             <div class="jx-ievent-author-box jx-ievent-border-thick">
                                
                                <div class="jx-ievent-author-image">
                                <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php echo get_avatar( get_the_author_meta('user_email'), '100', '' ); ?></a>
                                </div>
                                
                                <div class="jx-ievent-author-details">
                                    <div class="jx-ievent-author-name jx-ievent-black"><a href="<?php the_author_link(); ?>"> <?php the_author(); ?> </a></div>
                                    <div class="jx-ievent-author-details"><?php the_author_meta('description'); ?></div>
                                </div>
                                
                            </div>
                        
                            <!-- EDF Autor Box -->
                        <div class="row"></div>
                        	
                        <?php the_post_navigation(); ?>
            
                        <?php
                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
                        ?>
            
                    <?php endwhile; // End of the loop. ?>
                </div>
                <!-- EOF Body Content -->
                
                <div id="sidebar" class="four columns right jx-ievent-padding omega">
                	<?php dynamic_sidebar( 'general-sidebar' ); ?>
                </div>
                <!-- EOF sidebar -->
                
            </div>
            <!-- EOF container -->
		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>
