<?php 
global $avia_config;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();

	?>
		
		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap <?php echo $avia_config['layout']; ?>' id='main'>
						
			<div class='container'>
			
				<?php echo avia_title(false,false,__('Error 404', 'avia_framework')); ?>

				<div class='template-page content'>
				
					<div class="entry entry-content" id='search-fail'>
					<?php get_template_part('includes/error404'); ?>
				</div>
				
				
				<!--end content-->
				</div>
				
				<?php 

				//get the sidebar
				$avia_config['currently_viewing'] = 'page';
				get_sidebar();
				
				?>
				
			</div><!--end container-->

	</div>
	<!-- ####### END MAIN CONTAINER ####### -->


<?php get_footer(); ?>