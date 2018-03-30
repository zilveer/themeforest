<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package iEVENT
 */

get_header(); ?>						

	 <!-- BOF Main Content -->
    <div id="main" role="main" class="main">
        <div id="primary" class="content-area">
            <div class="container">
                <div class="sixteen columns jx-ievent-padding">
                
                    <?php while ( have_posts() ) : the_post(); ?>
        
                        <?php get_template_part( 'template-parts/content', 'page' ); ?>
        
                        <?php
                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
                        ?>
        
                    <?php endwhile; // End of the loop. ?>
                </div>
            </div>
            <!-- EOF Container -->
        </div><!-- #primary -->
    </div>
    
    

<?php get_sidebar(); ?>
<?php get_footer(); ?>
