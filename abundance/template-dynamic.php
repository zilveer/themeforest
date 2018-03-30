<?php 
	
	global $avia_config;
	 /* 
	  * create a new dynamic template object and display it.
	  * The rendering class is located in includes/helper-templates.php
	  */
	 $post_id = avia_get_the_ID();
	 $template_name = avia_post_meta($post_id, 'dynamic_templates');	 
 	 $template = new avia_dynamic_template($template_name);
 	
 	 $template -> set_layout();
 	 $template -> generate_html();
 	 $template -> special_slider_config();





 	 /*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
 	 get_header();
	 if(isset($avia_config['new_query'])) { query_posts($avia_config['new_query']); the_post(); }
 	 

	 ?>
	

		
		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap <?php echo $avia_config['layout']; ?>' id='main'>
		
			<div class='container'>
			
				<?php $template -> element_on_condition('heading', 0); ?>

				<div class='content template-dynamic template-dynamic-<?php echo $template_name; ?>'>
				
				<?php
				
				$template -> display();
				
				?>
				
				
				<!--end content-->
				</div>
				
				<?php 

				//get the sidebar
				wp_reset_query();
				
				if(!isset($avia_config['currently_viewing']))
				{
					$avia_config['currently_viewing'] = 'page';
				}
				get_sidebar();
				
				?>
				
				
			</div><!--end container-->

	</div>
	<!-- ####### END MAIN CONTAINER ####### -->


<?php get_footer(); ?>