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

				<div class='template-page content'>
				
					<div class='box'>
				
					<div class='inner_box'>
				
					<div class="entry entry-content" id='search-fail'>
					<h2 class='firstheading border-bottom'><?php _e('Error 404', 'avia_framework'); ?></h2>
					<div class='hr'></div>
					<?php get_template_part('includes/error404'); ?>
				</div>
				
				</div>
				
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