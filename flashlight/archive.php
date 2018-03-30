<?php 
global $avia_config;


	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();
 
	?>

		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap' id='main'>
		
			<div class='container'>
				
				
				
				<div class='template-blog-overview template-archive-overview template-blog content'>
				
				<div class='box'>
				
					<div class='inner_box'>
				
						<h2 class='firstheading'><?php echo avia_which_archive(); ?></h2>
						<div class="hr"></div>
						<?php
						
					
						/* Run the loop to output the posts.
						* If you want to overload this in a child theme then include a file
						* called loop-index.php and that will be used instead.
						*/
						
						get_template_part( 'includes/loop', 'index');
						
						
						?>
						</div><!--end inner_box-->
						
					</div><!--end box-->
					
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