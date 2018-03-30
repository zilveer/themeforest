<?php
/**
 * Template Name: Home Slider
 * Description: A Page Template that adds a home slider to pages
 *
 * @package WordPress
 * @subpackage Heat
 * @since Heat 1.0
 */

get_header(); ?>

	<div id="main" class="clearfix">

		<div id="primary">
			<div id="content" role="main">	
				<header class="entry-header">
					<h1 class="entry-title"><?php echo the_title();?></h1>
				</header><!-- .entry-header -->
						
				<?php $home_slider = ot_get_option( 'home_slider_list', array() ); ?>
				
				<?php if ( ! empty( $home_slider ) ) { ?>
					
					<div id="full-width-slider" class="royalSlider heroSlider rsMinW clearfix">
							
							<?php foreach( $home_slider as $slide ) : ?>
															
								<div class="rsContent">
									<?php if ( ! empty( $slide['image'] ) ) { ?>
										<img class="rsImg" src="<?php echo $slide['image']; ?>" alt="<?php echo $slide['title']; ?>" />
									<?php } ?>
									
									<?php if ( ! empty( $slide['title'] ) || ! empty( $slide['description'] ) || ! empty( $slide['link'] ) ) { ?>
											<div class="infoBlock rsABlock clearfix" data-fade-effect="" data-move-offset="20" data-move-effect="bottom" data-speed="350">
												<?php if ( ! empty( $slide['link'] ) ) { ?>
													<a class="home-slider-link" href="<?php echo $slide['link']; ?>">
												<?php } ?>
												
													<?php if ( ! empty( $slide['title'] ) ) { ?>
														<header class="clearfix">
															<h2 class="clearfix"><?php echo $slide['title']; ?></h2>
														</header>
													<?php } ?>
													<?php if ( ! empty( $slide['description'] ) ) { ?>
														<div class="home-slider-description clearfix"><?php echo $slide['description']; ?></div>
													<?php } ?>
												
												<?php if ( ! empty( $slide['link'] ) ) { ?>
													</a>
												<?php } ?>
											</div><!-- .infoBlock -->
									<?php } ?>
								</div><!-- .rsContent -->
																
							<?php endforeach; ?>
					
							</div><!-- #full-width-slider -->
					
					<?php } else { ?>
						
						<div id="slide-0">
							<div class="entry-content clearfix">
								<p class="no-found"><?php _e( 'No slides found, please add some slides.', 'mega' ); ?></p>
							</div><!-- .entry-content -->
						</div><!-- #slide-0 -->
						
					<?php } ?>
				
			</div><!-- #content -->
		</div><!-- #primary -->
	
<?php get_footer(); ?>