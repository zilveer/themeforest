<?php
/**
 * Template Name: Blog
 *
 * This template allows you to display the latest posts on any page of the site.
 *
 */

    // calling the header.php
    get_header();



?>

		<div id="container-<?php the_ID(); ?>" class="container first">
            
            <div class="clear-top"></div>
	
			<div id="content" class="content">
            
				<?php get_template_part( 'includes/blog' ); ?>
				
			</div><!-- #content -->
		
		
		</div><!-- #container -->
        

<div id="scroll-top">
	<a href="#top"><span></span></a>	
</div>	

<?php get_footer(); ?>