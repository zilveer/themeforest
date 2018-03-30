<?php
//Template Name: Blog

get_header('blog'); ?>		
	
     <!-- BOF Main Content -->
    <div id="main" role="main" class="main">
        <div id="primary" class="content-area">
                <div class="container with-sidebar">
                    <div class="sixteen columns jx-ievent-padding alpha">
                        <?php if ( have_posts() ) : ?>
                
               
                            <?php query_posts('post_type=post&post_status=publish&"&paged='. get_query_var('paged')); ?>
                            
                            <?php /* Start the Loop */ ?>
                            <?php while ( have_posts() ) : the_post(); ?>
                
                                <?php
                
                                    /*
                                     * Include the Post-Format-specific template for the content.
                                     * If you want to override this in a child theme, then include a file
                                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                     */
                                    get_template_part( 'template-parts/content', get_post_format() );
                                ?>
                
                            <?php endwhile; ?>
                            <div class="row"></div>
                            <div class="jx-ievent-pagination">
                                <?php the_posts_pagination(); ?>
                            </div>
                        <?php else : ?>
                
                            <?php get_template_part( 'template-parts/content', 'none' ); ?>
                
                        <?php endif; ?>
                    </div>
                    <!-- EOF Body Content -->
                    
                    <div id="sidebar" class="four columns right jx-ievent-padding omega">
                        <?php dynamic_sidebar( 'general-sidebar' ); ?>
                    </div>
                    <!-- EOF sidebar-->
                </div>
        </div><!-- #primary -->
    </div>

<?php get_footer(); ?>
