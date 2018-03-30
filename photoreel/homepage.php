<?php
/*
Template Name: Homepage
*/
?>
<?php get_header(); ?>

    
<?php if (get_option('themnific_slider_dis') <> "true") {
	
	 get_template_part('/includes/flexslider' );
} ?>
			 
<div class="container">

        <div id="homecontent">
        
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                    
        	<?php the_content() ?>

		<?php endwhile; endif; ?>
               
        </div><!-- #homecontent -->
		
</div>

        
<?php get_footer(); ?>