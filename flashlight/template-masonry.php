<?php 

global $avia_config;
if(isset($avia_config['new_query'])) { query_posts($avia_config['new_query']); }
	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();
	 
	 
	 $protectedPost = post_password_required() ? "protected_post" : "";
	?>
		
		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap <?php echo $avia_config['layout']." ".$protectedPost; ?>' id='main'>
			
			<div class='container'>

				<div class='template-masonry-overview content'>
				
				<div class='box'>
				
					<div class='inner_box'>
				
						<?php
						//display the default content of the portfolio
						if(isset($post->ID))
						{
							the_post();
							$titleClass = $avia_config['layout'];
							echo "<h1 class='post-title $titleClass'>".get_the_title()."</h1>";
							if(get_the_content() != "")
							{
								echo "<div class='post-entry'>";
								echo "<div class='entry-content'>";
								the_content();
								echo "</div>";
								echo "</div>";
								echo "<div class='hr masonry-hr'>";
								//edit_post_link('Edit');
								echo "</div>";	
							}
		
						}
						
						
						/* Run the loop to output the posts.
						* If you want to overload this in a child theme then include a file
						* called loop-portfolio.php and that will be used instead.
						*/
						
						get_template_part( 'includes/loop', 'masonry' );
						
						?>
						<div class='clearboth'></div>
						</div><!--end inner_box-->
						
					</div><!--end box-->
				
				<!--end content-->
				</div>
				
				<?php 

				//get the sidebar
				$avia_config['currently_viewing'] = 'blog';
				if(is_page()) $avia_config['currently_viewing'] = 'page';
				get_sidebar();
				
				?>
				
			</div><!--end container-->

	</div>
	<!-- ####### END MAIN CONTAINER ####### -->


<?php get_footer(); ?>