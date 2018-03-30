<?php	 		 	
	// Template Name: Custom Page
?>
<?php get_header() ?>
	<?php  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    	<div class="container oi_container_holder_vc">
            <div class="oi_page_holder_custom">
                <?php the_content();  ?>
            </div>
        </div>
    <?php endwhile; endif; ?>
<?php  get_footer(); ?>