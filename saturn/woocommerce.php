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
					<div class="col-md-<?php if( is_active_sidebar( apply_filters( 'saturn_custom_sidebar' , 'woocommerce-primary') ) ):?>9<?php else:?>12<?php endif;?>">
						<div class="primary-content woocommerce-content" id="woocommerce-content">
							<div class="woocommerce-wrapper">
								<?php 
									if( have_posts() ) :
										/**
										 * saturn_breadcrumbs action.
										 * hooked saturn_get_breadcrumbs, 10
										 */
										do_action( 'saturn_breadcrumbs' );									
										woocommerce_content();	
									else:
									// If no content, include the "No posts found" template.
										get_template_part( 'content', 'none' );
									
									endif;
								?>								
							</div>
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
