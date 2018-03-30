<?php
/*
Template Name: Blank
*/
?>

<?php get_header(); ?>

<style>
.top-headers-wrapper,
#site-footer
{
	display:none;
}

.content-area {
	margin:0 !important;
	padding:0 !important;
}
</style>

    <div class="blank-page full-width-page page-title-hidden">
		
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