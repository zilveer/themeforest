<?php 
global $avia_config;

	avia_get_template();

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();
	 
	?>

		<!-- ####### MAIN CONTAINER ####### -->
		<div id='main'>
		
			<div class='template-blog template-single-blog'>
				
				<div class='content units <?php echo $avia_config['content_class']; ?>'>
				
				<?php
				/* Run the loop to output the posts.
				* If you want to overload this in a child theme then include a file
				* called loop-index.php and that will be used instead.
				*
				*/
					get_template_part( 'includes/loop', 'index' );
					
					?>
					<div class='offset-by-one large_element'>
						<div class='post_nav'><span class='post_nav_sep'></span>
							<div class='previous_post_link_align'>
								<?php previous_post_link('<span class="previous_post_link post-nav-link"><span>&larr;</span> %link </span>'); ?>
							</div>
							<div class='next_post_link_align'>
								<?php next_post_link('<span class="next_post_link post-nav-link">%link <span>&rarr;</span></span>'); ?>
							</div>
						</div> <!-- end navigation -->
					</div>
					<?php
					//show related posts based on tags if there are any
					get_template_part( 'includes/related-posts');
					
					//wordpress function that loads the comments template "comments.php"
					comments_template( '/includes/comments.php'); 
				
				?>
				
				
				<!--end content-->
				</div>
				
			</div><!--end container-->

	</div>
	<!-- ####### END MAIN CONTAINER ####### -->
</div>
		
<?php 
wp_reset_query();
//get the sidebar
$avia_config['currently_viewing'] = 'blog';
get_sidebar();

?>
</div>

<?php get_footer(); ?>