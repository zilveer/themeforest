<?php
/**
 *  Single template page for portfolio - right sidebar
 * 
 * @package Toranj
 * @author owwwlab
 */
?>

<!-- Page main wrapper -->
<div id="main-content" class="dark-template">

	<!-- Portfolio -->
	<div class="page-wrapper rightside-folio">
		
		<!-- Sidebar -->
		<div class="page-side hidden-xs hidden-sm">
			<div class="inner-wrapper">
				<div class="side-content">
					<h2 class="side-title nmtop"><?php the_title(); ?></h2>
					<ul class="list-items">
						<?php owlab_portfolio_meta($owlabpfl_meta); ?>
					</ul>	
					<div>
						<?php echo wpautop(array_key_exists('owlabpfl_side_des', $owlabpfl_meta) ? $owlabpfl_meta["owlabpfl_side_des"][0] : ''); ?>

					</div>
				</div>
				
			</div>
			<!-- portfolio nav -->
			<?php owlab_portfolio_single_nav(); ?>
			<!--/ portfolio nav -->
		</div>
		<!-- Sidebar -->

		<!-- Main Content -->
		<div class="page-main">
			<div class="inner-wrapper">
				<?php $img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) , 'large' ); ?>
				<?php if(array_key_exists('owlabpfl_use_video', $owlabpfl_meta ) ) : 
					if($owlabpfl_meta["owlabpfl_use_video"][0]!='on'): ?>
						<!-- Header -->
						<div id="project-header" class="parallax-parent">
							<div class="header-cover parallax-parent set-bg">
								<img src="<?php echo $img_url ?>" alt="<?php the_title(); ?>" >
							</div>
							<div class="header-content tj-parallax">
								<div class="text-center">
									<h2 class="project-title">
										<?php the_title(); ?>
									</h2>
								</div>
							</div>
							<div class="project-caption">
								<p>
									<?php echo $owlabpfl_meta["owlabpfl_short_des"][0] ?>
								</p>
							</div>
						</div>

					<?php else: ?>
							<a href="<?php echo $owlabpfl_meta["owlabpfl_video_mp4"][0]; ?>" class="videobg-fallback">
								
								<div id="project-header">
									
									<div class="header-cover parallax-parent">
										<div class="owl-videobg autoplay" 
											data-src="<?php echo $owlabpfl_meta['owlabpfl_video_mp4'][0]; ?>"
											<?php if ( array_key_exists("owlabpfl_video_webm", $owlabpfl_meta) ): ?>
											data-src-webm="<?php echo $owlabpfl_meta['owlabpfl_video_webm'][0]; ?>"
											<?php endif; ?>
											<?php if ( array_key_exists("owlabpfl_video_ogg", $owlabpfl_meta) ): ?>
											data-src-ogg="<?php echo $owlabpfl_meta['owlabpfl_video_ogg'][0]; ?>"
											<?php endif; ?>
											data-poster="<?php echo $img_url; ?>">
										</div>

										<div class="header-content tj-parallax">
											<div class="text-center">
												<h2 class="project-title">
													<?php the_title(); ?>
												</h2>
											</div>
										</div>
									</div>
									<?php if ( array_key_exists('owlabpfl_short_des', $owlabpfl_meta)) :?>
									<div class="project-caption">
										<p>
											<?php echo $owlabpfl_meta["owlabpfl_short_des"][0] ?>
										</p>
									</div>
									<?php endif; ?>
								</div>
								
							</a>
					<?php endif; ?>
				<?php else: ?>
					<div id="project-header" class="parallax-parent">
						<div class="header-cover parallax-parent set-bg">
							<img src="<?php echo $img_url; ?>" alt="<?php the_title(); ?>" >
						</div>
						<div class="header-content tj-parallax">
							<div class="text-center">
								<h2 class="project-title">
									<?php the_title(); ?>
								</h2>
							</div>
						</div>
						<?php if (array_key_exists('owlabpfl_short_des', $owlabpfl_meta)): ?>
						<div class="project-caption">
							<p>
								<?php echo array_key_exists('owlabpfl_short_des', $owlabpfl_meta) ? $owlabpfl_meta["owlabpfl_short_des"][0] : '';?>
							</p>
						</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<!-- /Header -->

				<!-- Contents -->
				<div class="project-content">
					
					<!-- Duplicated details will be shown only at mobile devices -->
					<div class="portfolio-md-detail hidden-md hidden-lg">
						<ul class="list-items">
							<?php owlab_portfolio_meta($owlabpfl_meta); ?>
						</ul>	
						<div>
							<?php echo wpautop($owlabpfl_meta["owlabpfl_side_des"][0]); ?>
						</div>

						<!-- portfolio nav -->
						<?php owlab_portfolio_single_nav(); ?>
						<!--/ portfolio nav -->
					</div>
					<!-- /Details -->

					<!-- Portfolio Body -->
					<div class="body">
						<div class="contents">
							<?php the_content() ?>
						</div>
					</div>
					<!-- /Portfolio Body -->

				</div>
				<!-- Contents -->

			</div>
		</div>
		<!-- /Main Content -->

	</div>
	<!-- /Portfolio -->

</div>
<!-- /Page main wrapper -->