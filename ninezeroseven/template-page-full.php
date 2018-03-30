<?php 
/*
Template Name: Full 100% Width
 */

/* Load Header */
get_header();

?>

		<!-- BEGIN MAIN -->

	    <div class="main-content-area full-width-template">

			<div class="page-content clearfix">
				<?php 

					while( have_posts()) : the_post();
						
						the_content();
				
					endwhile; 
				?>

			</div> <!-- ./page-content -->

	    <!-- END Main -->
		</div>


<?php
/* Load Footer */
get_footer();
?>