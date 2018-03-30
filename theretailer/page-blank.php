<?php
/*
Template Name: Blank
*/
?>

<?php get_header(); ?>

<style>
.gbtr_tools_wrapper,
.gbtr_header_wrapper,
.gbtr_footer_wrapper
{
	display:none;
}
</style>

	<?php while ( have_posts() ) : the_post(); ?>
        
        <div class="page_full_width">
            <div class="entry-content">
                <div class="">
                    <?php the_content(); ?>    
                </div>
            </div><!-- .entry-content -->
        </div>

    <?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>