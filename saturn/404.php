<?php get_header();?>
	<section class="main-content">
		<?php 
		/**
		 * saturn_cover_media action.
		 * hooked saturn_cover_media, 10
		 */
		do_action( 'saturn_cover_media' );
		?>
		<div class="container">
			<div class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="primary-content">					
							<article class="post">						
								<div class="post-content">
									<h3 class="post-title"><?php _e('404','saturn');?></h3>
									<p><?php _e('It looks like nothing was found at this location.','saturn');?></p>
								</div>								
							</article>
						</div>
					</div>
				</div>				
			</div><!-- end content -->
		</div><!-- end container -->
	</section>
<?php get_footer();?>