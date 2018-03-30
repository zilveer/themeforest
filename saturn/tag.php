<?php get_header();?>
	<section class="main-content">
		<?php 
		/**
		 * saturn_cover_media action.
		 * hooked saturn_cover_media, 10
		 */
		do_action( 'saturn_cover_media' );
		/**
		 * saturn_archive_heading action
		 * hooked saturn_archive_heading, 10
		 */
		do_action( 'saturn_archive_heading' );
		?>
		<div class="container">
			<?php
			/**
			 * want to display the banner/ads, hook into this.
			 */ 
			do_action( 'saturn_before_content' );
			?>		
			<div class="content">
				<div class="row">
					<div class="col-md-<?php print function_exists( 'saturn_col_main_content_size' ) ? saturn_col_main_content_size() : 9;?> col-main-content">
						<div class="primary-content" id="primary-content">
							<?php 
								/**
								 * saturn_breadcrumbs action.
								 * hooked saturn_get_breadcrumbs, 10
								 */
								do_action( 'saturn_breadcrumbs' );		
								if( have_posts() ) :
									// Start the Loop.
									while ( have_posts() ) : the_post();
										/*
										 * Include the post format-specific template for the content. If you want to
										* use this in a child theme, then include a file called called content-___.php
										* (where ___ is the post format) and that will be used instead.
										*/			
										get_template_part( 'content', get_post_format() );
										
									endwhile;
									
									// Previous/next post navigation.
									if( function_exists( 'saturn_navigation' ) ):
										saturn_navigation();
									endif;
									
								else:
								// If no content, include the "No posts found" template.
									get_template_part( 'content', 'none' );
								
								endif;
							?>
						</div>
					</div>
					<?php get_sidebar();?>
				</div>				
			</div><!-- end content -->
			<?php
			do_action( 'saturn_after_content' );
			?>			
		</div><!-- end container -->
	</section>
<?php get_footer();?>