<?php 
global $avia_config;

	avia_get_template();

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();
	 
	?>

		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap <?php echo $avia_config['layout']; ?>' id='main'>
		
			<div class='container'>
				
				<?php avia_title(); ?>
				<div class='template-blog template-single-blog content'>
				
				<?php
				/* Run the loop to output the posts.
				* If you want to overload this in a child theme then include a file
				* called loop-index.php and that will be used instead.
				*
				*/
				
					get_template_part( 'includes/loop', 'index' );
					
					//show related posts based on tags if there are any
					get_template_part( 'includes/related-posts');
					
					//wordpress function that loads the comments template "comments.php"
					comments_template( '/includes/comments.php'); 
				
				?>
				
				
				<!--end content-->
				</div>
				
				<?php 
				$avia_config['currently_viewing'] = "blog";
				//get the sidebar
				get_sidebar();
				
				?>
				
			</div><!--end container-->

	</div>
	<!-- ####### END MAIN CONTAINER ####### -->


<?php get_footer(); ?>