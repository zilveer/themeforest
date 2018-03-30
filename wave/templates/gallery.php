<?php 
	
	global $dd_sn;
	global $dd_post_class;
	global $dd_thumb_size;

	$gallery_images = get_post_meta( get_the_ID(), $dd_sn . 'gallery_images', true );
	if ( ! empty( $gallery_images ) )
		$gallery_images_count = count( $gallery_images );
	else
		$gallery_images_count = 0;

	if ( ! is_single() ) {

		if ( has_post_thumbnail() )
			$dd_post_class_append = 'has-thumb';
		else
			$dd_post_class_append = '';

	} else {

		if ( $gallery_images_count > 0 )
			$dd_post_class_append = 'has-thumb ';
		else
			$dd_post_class_append = '';

	}

	if ( ! isset( $dd_thumb_size ) )
		$dd_thumb_size = 'dd-one-third';

?>

<?php if ( is_single() ) : ?>
		
	<div class="gallery-single <?php echo $dd_post_class.$dd_post_class_append; ?>">
		
		<?php if ( $gallery_images_count > 0 ) : ?>

			<div class="gallery-single-slider">

				<div class="flexslider">

					<ul class="slides">

						<?php

							foreach ($gallery_images as $gallery_image) {

								?>
									<li class="slide">
										<div class="slide-inner">
											<a href="<?php echo $gallery_image[$dd_sn . 'gallery_image']; ?>" rel="prettyPhoto[gallery_single]"><img alt="<?php echo esc_attr( $gallery_image['title'] ); ?>" src="<?php echo $gallery_image[$dd_sn . 'gallery_image']; ?>" /></a>
											<?php if (  $gallery_image['title'] !== '' ||  $gallery_image[$dd_sn . 'description'] !== '' ) : ?>
												<div class="slide-inner-info">
													<?php if ( $gallery_image['title'] !== '' ) : ?>
														<div class="slide-inner-title">
															<?php echo $gallery_image['title']; ?>
														</div>
													<?php endif; ?>
													<?php if ( $gallery_image[ $dd_sn . 'description'] !== '' ) : ?>
														<div class="slide-inner-description">
															<?php echo $gallery_image[ $dd_sn . 'description']; ?>
														</div>
													<?php endif; ?>
												</div>
											<?php endif; ?>
										</div><!-- .slider-inner -->
									</li>
								<?php		
							}

						?>

					</ul><!-- .slides -->

				</div><!-- .flexslider -->

				<div class="gallery-slider-nav container">
					<div class="gallery-slider-nav-inner">
						<a href="#" class="gallery-slider-prev"></a>
						<a href="#" class="gallery-slider-next"></a>
					</div>
				</div><!-- .gallery-slider-nav -->

			</div><!-- .gallery-single-slider -->

		<?php endif; ?>

		<div class="gallery-single-main">

			<?php if ( $gallery_images_count > 0 ) : ?>

				<div class="gallery-single-carousel">

					<div class="flexslider">

						<ul class="slides">

							<?php

								foreach ($gallery_images as $gallery_image) {

									?>
										<li class="slide">
											<div class="slide-inner">
												<img src="<?php echo $gallery_image[$dd_sn . 'gallery_image']; ?>" />
											</div><!-- .slider-inner -->
										</li>
									<?php		
								}

							?>

						</ul><!-- .slides -->

					</div><!-- .flexslider -->

					<div class="carousel-nav">
						<div class="carousel-nav-inner">
							<a href="#" class="carousel-prev"></a>
							<a href="#" class="carousel-next"></a>
						</div>
					</div><!-- .carousel-nav -->

				</div><!-- .gallery-single-carousel -->

			<?php endif; ?>

			<div class="gallery-meta clearfix">

				<span class="gallery-title"><?php the_title(); ?></span>
				<span class="gallery-images"><span class="icon-docs"></span><?php echo $gallery_images_count; ?></span>

			</div><!-- .gallery-meta -->

			<div class="gallery-content">

				<?php the_content(); ?>

			</div><!-- .gallery-content -->

		</div><!-- .gallery-single-main -->

	</div><!-- .gallery-single -->

<?php else : ?>

	<div class="gallery <?php echo $dd_post_class.$dd_post_class_append; ?>">

		<div class="gallery-inner">

			<div class="gallery-thumb">

				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $dd_thumb_size ); ?></a>

			</div><!-- .gallery-thumb -->

			<div class="gallery-main">

				<div class="gallery-meta clearfix">

					<a href="<?php the_permalink(); ?>" class="gallery-title"><?php the_title(); ?></a>
					<a href="<?php the_permalink(); ?>" class="gallery-images"><span class="icon-docs"></span><?php echo $gallery_images_count; ?></a>

				</div><!-- .gallery-meta -->

				<div class="gallery-excerpt">

					<?php the_excerpt(); ?>

				</div><!-- .gallery-excerpt -->

				<div class="gallery-permalink">
					<a href="<?php the_permalink(); ?>"><?php _e( 'VIEW GALLERY', 'dd_string' ); ?></a>
				</div>

			</div><!-- .gallery-main -->

		</div><!-- .gallery-inner -->

	</div><!-- .gallery -->

<?php endif; ?>