<?php
/**
 * Template Name: Blank Page 
 *
 * @package WordPress
 * @subpackage Majesty
 * @since Majesty 1.0
 */
 
get_header(); ?>
			
		<?php 
			if ( have_posts() ) :
							
				while ( have_posts() ) : the_post();
				
					the_content();
				
				endwhile;
				
			else :
				get_template_part( 'content', 'none' );
			endif;
		?>
		
 <!--  scroll to top of the page-->
 </div><!-- end of #content -->
    <a href="#" id="scroll_up" ><i class="fa fa-angle-up"></i></a>
</div><!-- ends of wrapper -->
<?php wp_footer(); ?>
</body>
</html>