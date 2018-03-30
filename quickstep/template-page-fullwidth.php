<?php
/**
 * Template Name: Full Width
 *
 * This Full Width template removes the primary and secondary asides so that content
 * can be displayed the entire width of the #content area.
 *
 */


    // calling the header.php
    get_header();

?>


		<div id="container-<?php the_ID(); ?>" class="container first">
            
            <div class="clear-top"></div>
	
			<div id="content" class="content">
            	
                <?php the_post(); ?>
	
				<?php get_template_part( 'includes/fullwidth' ); ?>
	
			</div><!-- #content -->
			
		</div><!-- #container -->

<?php 

    // calling footer.php
    //get_footer();

?>

<div id="scroll-top">
	<a href="#top"><span></span></a>	
</div>	

<?php get_footer(); ?>