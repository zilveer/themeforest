<?php 
global $avia_config;

	/*
	 * check which page template should be applied: 
	 * cecks for dynamic pages as well as for portfolio, fullwidth, blog, contact and any other possibility :)
	 * Be aware that if a match was found another template wil be included and the code bellow will not be executed
 	 * located at the bottom of includes/helper-templates.php
	 */
	 avia_get_template();


	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();
	 
	
	$protectedPost = post_password_required() ? "protected_post" : "";
	?>
		
		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap' id='main'>
		
			<div class='container <?php echo $avia_config['layout']." ".$protectedPost; ?>'>
				
				<div class='template-page content'>
				

						<?php 
						
						/* Run the loop to output the posts.
						* If you want to overload this in a child theme then include a file
						* called loop-page.php and that will be used instead.
						*/
						$loop = '';
						$content_style = avia_post_meta(avia_get_the_ID(), 'entry_layout'); 
						
						if(strpos($content_style,'mini') !== false) 
						{
							$loop = 'page-mini';
						}
						else
						{
							echo "<div class='box'>";
							
								echo "<div class='inner_box'>";
								
								do_action('avia_page_title');
						
								get_template_part( 'includes/loop', 'page' );
								
								echo "</div><!--end inner_box-->";
							
							echo "</div><!--end box-->";
						}
						?>
						
				
				<!--end content-->
				</div>
				
				<?php 
				
				if($loop) get_template_part( 'includes/loop', $loop );
				
				//get the sidebar
				$avia_config['currently_viewing'] = 'page';

				get_sidebar();
				
				?>
				
			</div><!--end container-->

	</div>
	<!-- ####### END MAIN CONTAINER ####### -->


<?php get_footer(); ?>