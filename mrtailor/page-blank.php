<?php
/*
Template Name: Blank
*/
?>

<?php get_header(); ?>

<style>
#site-top-bar,
.site-header,
.site-header-sticky,
#site-footer
{
	display:none;
}
</style>
    
    <div class="blank-page full-width-page">
		
        <div id="primary" class="content-area">
           
            <div id="content" class="site-content" role="main">
                    
                    <?php while ( have_posts() ) : the_post(); ?>
        
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div><!-- .entry-content -->
        
                    <?php endwhile; // end of the loop. ?>
    
            </div><!-- #content -->           
            
        </div><!-- #primary -->
		
	</div><!-- .boxed-page -->
    
<?php get_footer(); ?>