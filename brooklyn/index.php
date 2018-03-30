<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package unitedthemes
 */
global $wp_query;

get_header(); ?>


<?php /* start output for classic blog , search , category tag or archive page */ ?>

    <div class="grid-container">
    	
        <?php $grid = is_active_sidebar('blog-widget-area') ? 'grid-75 tablet-grid-75 mobile-grid-100' : 'grid-100 tablet-grid-100 mobile-grid-100'; ?>
        
        <div id="primary" class="grid-parent <?php echo $grid; ?>">
        
                    <?php if ( have_posts() ) : ?>
        
                        <?php /* Start the Loop */ ?>
                    
                        <?php while ( have_posts() ) : the_post(); ?>
                    
                        <?php
                            
                            /* Include the Post-Format-specific template for the content.
                             * If you want to overload this in a child theme then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                             
                            get_template_part( 'partials/content', get_post_format() );
                        ?>
                    
                        <?php endwhile; ?>
        
                    <?php else : ?>
            
                        <?php get_template_part( 'no-results', 'index' ); ?>
            
                <?php endif; ?>
         
        </div><!-- primary --> 
        
        <?php get_sidebar(); ?>
       
    </div><!-- grid-container -->   
   	
    <?php if( $wp_query->max_num_pages > 1 ) : ?>

        <div id="ut-blog-navigation">

            <div class="grid-container">

                <div class="grid-100 mobile-grid-100 tablet-grid-100">

                <?php if ( have_posts() ) : ?>
                    <?php unitedthemes_content_nav( 'nav-below' ); ?>
                <?php endif; ?>

                </div><!-- .grid-100 -->

            </div><!-- .grid-container -->

        </div><!-- #ut-blog-navigation -->

    <?php endif; ?> 

<?php /* end output for classic blog , search , category tag or archive page */ ?>

<?php get_footer(); ?>