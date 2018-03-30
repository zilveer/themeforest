<?php 
global $avia_config;


	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();
	?>
		
		<!-- ####### MAIN CONTAINER ####### -->
		<div id='main'>
		
			<div class='template-search'>
			
				<span class='entry-border-overflow extralight-border'></span>
				
				<h1 class='first-title offset-by-one'><?php echo avia_which_archive(); ?></h1>
				
				<div class='content seven units alpha offset-by-one template-search-container'>

				<span class='entry-border-overflow extralight-border'></span>
				<?php
				/* Run the loop to output the posts.
				* If you want to overload this in a child theme then include a file
				* called loop-search.php and that will be used instead.
				*/
				$more = 0;
				get_template_part( 'includes/loop', 'search' );
				?>
				
				
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