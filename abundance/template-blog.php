<?php 

	global $avia_config, $more;

	$avia_config['new_query'] = array( "paged" => get_query_var( 'paged' ), "posts_per_page"=>get_option('posts_per_page') ) ;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();
 		
 	 $avia_config['layout'] = avia_get_option('blog_layout');
	?>


		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap <?php echo $avia_config['layout']; ?>' id='main'>
		
			<div class='container'>	
				
				<?php avia_title(); ?>
				<div class='template-blog content'>
				
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
				
				<?php 
				wp_reset_query();
				//get the sidebar
				$avia_config['currently_viewing'] = 'blog';
				get_sidebar();
				
				?>
				
			</div><!--end container-->

	</div>
	<!-- ####### END MAIN CONTAINER ####### -->


<?php get_footer(); ?>