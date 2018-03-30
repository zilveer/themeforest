<?php
/**
 * Template Name: Left Hand Sidebar
 *
 * This template creates a left hand sidebar with content in a right hand column
 * 
 *
 */


    // calling the header.php
    get_header();


?>


		<div id="container-<?php the_ID(); ?>" class="container first">
            
            <div class="clear-top"></div>
	
			<div id="content" class="content">
            
            	<?php the_post(); ?>
	
				<?php get_template_part( 'includes/columnright' ); ?>
                
	
			</div><!-- #content -->
                                  
		</div><!-- #container -->
        
        

<div id="scroll-top">
	<a href="#top"><span></span></a>	
</div>	

<?php get_footer(); ?>