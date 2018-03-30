<?php

get_header();
?>

	<div class="entry-header-wrapper">
		<header class="entry-header clearfix">
			<h1 class="entry-title"><?php _e( 'Portfolio Archives', 'mega' ); ?></h1>
		</header><!-- .entry-header -->
	</div>
	<div id="main" class="clearfix">

		<div id="primary">
			
			<div id="content" role="main">
			
			<?php //$portfolios_per_page = ot_get_option( 'portfolios_per_page' ); ?>
			<?php $portfolios_per_page = 12 ?>
			
				<div id="block-portfolio" class="clearfix" data-columns="col4">
					
					<div id="portfolio" class="clearfix">	
						<?php $wp_query = new WP_Query(); ?>
						<?php $wp_query->query('post_type=portfolio&posts_per_page='.$portfolios_per_page.'&post_status=publish'.'&paged='.$paged); ?>
							
						<?php  if ( $wp_query->have_posts() ) : ?>

							<?php /* Start the Loop */ ?>
							<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
							
								<?php
								$post_id = $wp_query->post->ID;
								$thumbnail = '';
									
								$post_thumbnail = $p_img_large = '';

								$post_thumbnail = wpb_getImageBySize(array( 'post_id' => $post_id, 'thumb_size' => '258x200' ));
								$thumbnail = $post_thumbnail['thumbnail'];
								$p_img_large = $post_thumbnail['p_img_large'];
								?>

								<?php //get_template_part( 'content-portfolio' ); ?>
								<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
									<?php $portfolio_custom_url = get_post_meta( get_the_ID(), 'portfolio_custom_url', true ); ?>
									<?php $portfolio_image_lightbox = get_post_meta( get_the_ID(), 'portfolio_image_lightbox', true ); ?>
									<?php $portfolio_video_lightbox = get_post_meta( get_the_ID(), 'portfolio_video_lightbox', true ); ?>
									<?php if ( ! empty( $portfolio_image_lightbox ) ) { ?>
										<a class="portfolio-data fb-lightbox" href="<?php echo esc_url( $portfolio_image_lightbox ); ?>" caption="<?php the_title(); ?>" rel="bookmark">
									<?php } else if ( ! empty( $portfolio_video_lightbox ) ) { ?>
										<a class="portfolio-data fb-lightbox" href="<?php echo esc_url( $portfolio_video_lightbox ); ?>" caption="<?php the_title(); ?>" rel="bookmark">
									<?php } else { ?>
										<a class="portfolio-data" href="<?php if ( ! empty( $portfolio_custom_url ) ) echo esc_url( $portfolio_custom_url ); else the_permalink(); ?>" rel="bookmark">
									<?php } ?>
										<div class="content-wrapper">
										
											<?php if ( $thumbnail ) { ?>
												<div class="post-thumbnail clearfix">
													<div class="overlay"></div>
													<div class="icon-portfolio-wrapper">
													<?php if ( ! empty( $portfolio_image_lightbox ) ) { ?>
														<i class="icomoon-zoom"></i>
													<?php } else if ( ! empty( $portfolio_video_lightbox ) ) { ?>
														<i class="icomoon-play"></i>
													<?php } else { ?>
														<i class="icomoon-plus"></i>
													<?php } ?>
													</div>
													<?php echo $thumbnail; ?>
												</div>
											<?php } ?>
													
													<div class="portfolio-data-wrapper clearfix">
														<header class="entry-header">
															<h2><?php the_title(); ?></h2>
														</header><!-- .entry-header -->
													
														<div class="entry-category"><?php echo custom_taxonomies_terms_links(); ?></div><!-- .entry-category -->
													</div>

										</div><!-- .content-wrapper -->
									</a>
								</article><!-- #post-<?php the_ID(); ?> -->

							<?php endwhile; ?>
							
						<?php else : ?>
									
							<div class="entry-content clearfix">
								<p class="no-found"><?php _e( 'No portfolios found, please add some portfolios.', 'mega' ); ?></p>
							</div><!-- .entry-content -->

						<?php endif; ?>
					</div><!-- #portfolio -->
					
					<?php mega_pagination_content_nav( 'nav-pagination' ); ?>
					
					<?php wp_reset_query(); ?>
					
				</div><!-- #block-portfolio -->
			
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>