<?php 

global $avia_config;


	//set a deafult query with all portfolio items in case the user just selected to display the page tempalte instead of setting up a portfolio properly
	if(!isset($avia_config['new_query']['tax_query'][0]['terms'][0]) || $avia_config['new_query']['tax_query'][0]['terms'][0] == "null") 
	{ 
		if(!isset($avia_config['portfolio_item_count'])) $avia_config['portfolio_item_count'] = '-1';
	
		$avia_config['new_query'] = array("paged" => get_query_var( 'paged' ),  "posts_per_page" => $avia_config['portfolio_item_count'],  "post_type"=>"portfolio"); 
	}


	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();
 	 if(empty($avia_config['portfolio_columns'])) $avia_config['portfolio_columns'] = 3;
	?>
		
		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap' id='main'>
			
			<div class='container portfolio-size-<?php echo $avia_config['portfolio_columns']; ?>'>

				<div class='template-portfolio-overview content portfolio-size-<?php echo $avia_config['portfolio_columns']; ?>'>
				
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
								echo "<div class='hr portfolio-hr'>";
								//edit_post_link('Edit');
								echo "</div>";	
							}
		
						}
						
						
						/* Run the loop to output the posts.
						* If you want to overload this in a child theme then include a file
						* called loop-portfolio.php and that will be used instead.
						*/
						
						get_template_part( 'includes/loop', 'portfolio' );
						
						?>
						</div><!--end inner_box-->
						
					</div><!--end box-->
				
				<!--end content-->
				</div>
				
				<?php
				//get the sidebar
				 $avia_config['currently_viewing'] = 'page';
				 wp_reset_query();
				get_sidebar();
				?>
				
			</div><!--end container-->

	</div>
	<!-- ####### END MAIN CONTAINER ####### -->


<?php get_footer(); ?>