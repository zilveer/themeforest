<?php
/**
 * Template Name: Slider
 * Description: A Page Template that adds a slider to pages
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
				
				<?php if ( post_password_required() ) : ?>
					<div class="password-protected">
						<?php the_content(); ?>
					</div>
				<?php else : ?>
						
					<?php
					global $post;

					if ( metadata_exists( 'post', $post->ID, '_page_image_gallery' ) ) {
						$page_image_gallery = get_post_meta( $post->ID, '_page_image_gallery', true );
					} else {
						// Backwards compat
						$attachment_ids = array_filter( array_diff( get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' ), array( get_post_thumbnail_id() ) ) );
						$page_image_gallery = implode( ',', $attachment_ids );
					}
								
					$attachments = array_filter( explode( ',', $page_image_gallery ) );
					$thumbs = array();
					if ( $attachments ) { ?>
					
						<div id="carousel-gallery-wrapper" class="container clearfix">
							<div id="carousel-gallery" class="container clearfix">
								<div class = "iosSliderContainer clearfix">
									<div class = "iosSlider clearfix">
										<div class="slider clearfix">
											<?php foreach ( $attachments as $attachment_id) : ?>             
												<?php
													$gallery_image_src = wp_get_attachment_image_src( $attachment_id, 'full' );
													$attachment = get_post( $attachment_id );
													$attachment_title = apply_filters( 'the_title', $attachment->post_title );
												?>
												<div class="item">
													<img src="<?php echo $gallery_image_src[0]; ?>" width="<?php echo $gallery_image_src[1];?>" height="<?php echo $gallery_image_src[2];?>" alt="<?php echo $attachment_title; ?>" />
												</div><!-- .item -->
											<?php endforeach; ?>
										</div><!-- .slider -->
										<div class="iosNext"></div>
										<div class="iosPrev iosUnselectable"></div>
									</div><!-- .iosSlider -->
								</div><!-- .iosSliderContainer -->
							</div><!-- #carousel-gallery -->
						</div><!-- #carousel-gallery-wrapper -->
						
					<?php } else { ?>
					
						<div id="slide-0">
							<div class="entry-content clearfix">
								<p class="no-found"><?php _e( 'No slides found, please add some slides.', 'mega' ); ?></p>
							</div><!-- .entry-content -->
						</div><!-- #slide-0 -->
						
					<?php } ?>
						
				<?php endif; ?>
				
			</div><!-- #content -->
		</div><!-- #primary -->
	
<?php get_footer(); ?>