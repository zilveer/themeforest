<?php 
global $avia_config;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();

	?>
		
		<!-- ####### MAIN CONTAINER ####### -->
		<div id='main'>
						
			<div class='template-page'>
			
				<div class='content seven units alpha offset-by-one'>
					
					<div class='post-entry'>	
					<div class="entry entry-content" id='search-fail'>
					
					<span class='entry-border-overflow extralight-border'></span>
					
					<h1><?php _e('Error 404 - page not found', 'avia_framework'); ?></h1>
					<?php get_template_part('includes/error404'); ?>
					</div>
				</div>
				
				
				<!--end content-->
				</div>
				
				
			</div><!--end container-->

	</div>
	<!-- ####### END MAIN CONTAINER ####### -->

</div>
	<?php 

	//get the sidebar
	$avia_config['currently_viewing'] = 'page';
	get_sidebar();
	
	?>
</div>

<?php get_footer(); ?>