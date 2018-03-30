<?php
/**
 *  Archive Horizontal template page for bulk gallery
 * 
 * @package Toranj
 * @author owwwlab
 */
 
?>


<!-- Page main wrapper -->
		<div id="main-content" class="abs dark-template">
			<!-- <div class="page-wrapper"> -->
				
				<!-- Page sidebar -->
				<div class="page-side">
					<div class="inner-wrapper vcenter-wrapper">
						<div class="side-content vcenter">

							<!-- Page title -->
							<h1 class="title">
								<span class="second-part"><?php echo ot_get_option('bulk_gallery_title_1'); ?></span>
								<span><?php echo ot_get_option('bulk_gallery_title_2'); ?></span>
							</h1>
							<!-- /Page title -->

							<div class="hidden-sm hidden-xs">
								<?php echo ot_get_option('bulk_gallery_side_content'); ?>
							</div>
							
						</div>
					</div>
				</div>
				<!-- /Page sidebar -->

				<!-- Page main content -->
				<div class="page-main horizontal-folio-wrapper set-height-mobile">

					<!-- Portfolio wrapper -->	
					<div class="horizontal-folio">
						
						<?php if ( have_posts() ) : while( have_posts() ) : 
							the_post(); 
							
							
							if( get_post_status()=='private' ) continue;

							$owlabgal_meta = get_post_meta( $post->ID );
							$owlabbulk_meta = unserialize($owlabgal_meta['_owlabbulkg_slider_data'][0]);
							
							$short_des = isset($owlabbulk_meta['config']['short_des']) ? $owlabbulk_meta['config']['short_des'] : '';

						 	$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-thumb' );
						 	?>
							<!-- Portfolio Item -->		
							<div class="gp-item tj-circle-hover">
								<a href="<?php the_permalink(); ?>" class="set-bg">
									<?php owlab_lazy_image($thumb_url, get_the_title(), true); ?>

									<!-- Item Overlay -->		
									<div class="tj-overlay">
										<div class="content">
											<div class="circle">
												<i class="fa fa-link"></i>
											</div>
											<div class="details">
												<h4 class="title"><?php the_title(); ?></h4>
												<h5 class="subtitle"><?php echo $short_des; ?></h5>
											</div>	
										</div>
									</div>
									<!-- /Item Overlay -->	
								</a>
							</div>
							<!-- /Portfolio Item -->

						<?php endwhile; else: ?>
							<?php _e('No items found.','toranj'); ?>
						<?php endif; ?>						
							
	
					</div>
					<!-- /Portfolio wrapper -->	
				</div>
				<!-- Page main content -->
			<!-- </div> -->
		</div>
		<!-- /Page main wrapper -->

<?php do_action('owlab_after_content'); ?>
