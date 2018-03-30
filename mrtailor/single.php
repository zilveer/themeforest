<?php 
$blog_with_sidebar = "";
if ( (isset($mr_tailor_theme_options['sidebar_blog_listing'])) && ($mr_tailor_theme_options['sidebar_blog_listing'] == "1" ) ) $blog_with_sidebar = "yes";
if (isset($_GET["blog_with_sidebar"])) $blog_with_sidebar = $_GET["blog_with_sidebar"];    
?>

<?php get_header(); ?>

	<div id="primary" class="content-area">
        
        <?php if ( $blog_with_sidebar == "yes" ) : ?>
            <div class="row"><div class="large-8 columns with-sidebar">
        <?php endif; ?>
        
                <div id="content" class="site-content" role="main">
    
                    <?php while ( have_posts() ) : the_post(); ?>
            
                        <?php get_template_part( 'content', get_post_format() ); ?>
                        
                        <hr />
            
                        <?php mr_tailor_content_nav( 'nav-below' ); ?>
            
                        <?php
                            // If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || '0' != get_comments_number() )
                                comments_template();
                        ?>
            
                    <?php endwhile; // end of the loop. ?>
    
                </div><!-- #content -->
            
            <?php if ( $blog_with_sidebar == "yes" ) : ?>
        		</div><!-- .columns -->
            <?php endif; ?>
    
            <?php if ( $blog_with_sidebar == "yes" ) : ?>
				<div class="large-4 columns">        					
					<?php get_sidebar(); ?>			           
                </div><!-- .columns -->
            <?php endif; ?>
            
        <?php if ( $blog_with_sidebar == "yes" ) : ?>
        	</div><!-- .row -->
        <?php endif; ?>
           
    </div><!-- #primary -->

<?php get_footer(); ?>