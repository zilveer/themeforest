<?php
/**
 * @package WordPress
 * @subpackage Arapah-WP
 */
 ?>

    <?php get_header();  //the Header ?>
        
    <?php get_template_part( 'menu', 'index' ); //the  menu + logo/site title ?>
	
	<section id="maincontent">
		<div class="container">	
			<?php get_template_part( 'loop', 'index' ); //the Loop ?> 
				 
			<?php get_template_part( 'sidebar', 'index' ); //the Sidebar ?>
		</div>
	</section>
            
    <?php get_footer(); //the Footer ?>
                        
           
