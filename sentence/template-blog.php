<?php 

	global $avia_config, $more;

	$avia_config['new_query'] = array( "paged" => get_query_var( 'paged' ), "posts_per_page"=>get_option('posts_per_page') ) ;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();
 		
	?>


		<!-- ####### MAIN CONTAINER ####### -->
		<div id='main'>
		
			<div class='template-blog inner_container'>	

				<div class='content <?php echo $avia_config['content_class']; ?> units'>
				
				
				
				<?php
				
				/* Run the loop to output the posts.
				* If you want to overload this in a child theme then include a file
				* called loop-index.php and that will be used instead.
				*/
				
				
				$more = 0;
				
				get_template_part( 'includes/loop', 'index' );
				?>
				
				
				<!--end content-->
				</div>
				
				
				
			</div><!--end inner_container-->

	</div>
	<!-- ####### END MAIN CONTAINER ####### -->
	
	
</div> <!--end primary-->	
			
			
			
			<?php 
			
			//get the sidebar
			$avia_config['currently_viewing'] = 'blog';
			get_sidebar();
			
			?>

	</div>
	


<?php get_footer(); ?>