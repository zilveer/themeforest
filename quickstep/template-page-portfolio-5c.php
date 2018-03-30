<?php
/*
Template Name: Portfolio 5 Columns
*/
    // calling the header.php
    get_header();

?>

		<div id="container-<?php the_ID(); ?>" class="container first">
            
            <div class="clear-top"></div>
	
			<div id="content" class="content">

                <?php the_post(); ?>
	
				<?php get_template_part( 'includes/portfolio-5c' ); ?>
	
			</div><!-- #content -->
			
		</div><!-- #container -->

<?php 

    // calling footer.php
    get_footer();

?>
