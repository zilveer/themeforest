<?php
/**
 * Single Gallery item template with description
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */
defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call
?>

<?php get_header(); ?>

<?php if ( get_mental_option( 'show_menubar' ) ) { get_template_part( 'blocks/menubar' ); } ?>

<div id="main" role="main">

	<?php $footer_parallax_effect = ( get_mental_option( 'footer_parallax' ) && get_mental_option( 'footer_show' ) )? true : false ; ?>

	<?php if ( $footer_parallax_effect ): ?>
	<div class="parallax-footer">
	<?php endif ?>

	<?php if ( get_mental_option( 'show_topmenu' ) ) get_template_part( 'blocks/mobile-header' ) ?>

	<?php if ( have_posts() ): while( have_posts() ) : the_post(); ?>

		<?php if ( get_mental_option( 'show_topmenu' ) ) get_template_part( 'blocks/topmenu' ); ?>

		<?php if ( get_mental_option( 'show_header' ) ): ?>

			<?php azl_get_template_part('blocks/header', '', array('title' => get_the_title())); ?>

		<?php endif ?>

			<div class="section single-work st-invert">
				<section>
					<div class="container">
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<?php if( get_mental_option('gallery_single_show_top_section') ): ?>

								<?php if ( get_post_format() == 'video' && $video = get_post_video( get_the_content() ) ): ?>

									<div class="responsive-embed">
										<?php echo mental_escape_iframe($video); ?>
									</div>

								<?php elseif ( get_post_format() == 'gallery' && $gallery = get_post_gallery( get_the_ID(), false ) ) : // If Post gallery {?>

									<div id="carousel-single-post" class="carousel slide" data-ride="carousel">

										<!-- Wrapper for slides -->
										<div class="carousel-inner">
											<?php
											$img_ids = explode( ',', $gallery['ids'] );
											$i = 0;
											foreach ( $img_ids as $img_id ):
											?>
												<?php $img_src = wp_get_attachment_image_src( $img_id, 'large' ) ?>
												<div class="item <?php echo ( $i == 0 ) ? 'active' : '' ?>">
													<img src="<?php echo esc_url($img_src[0]) ?>" alt="slide">
												</div>
											<?php $i ++; endforeach ?>
										</div>
										<!-- Indicators -->
										<ol class="carousel-indicators">
											<?php $i = 0; foreach ( $img_ids as $img_id ): ?>
												<li data-target="#carousel-single-post" data-slide-to="<?php echo (int) $i; ?>" class="<?php echo ( $i == 0 ) ? 'active' : '' ?>"></li>
											<?php $i ++; endforeach ?>
										</ol>

										<!-- Controls -->
										<a class="left carousel-control" href="#carousel-single-post" data-slide="prev">
											<span></span>
										</a>
										<a class="right carousel-control" href="#carousel-single-post" data-slide="next">
											<span></span>
										</a>

									</div> <!-- carousel -->

								<?php elseif ( has_post_thumbnail() ) : // Check if Thumbnail exists {?>

									<figure class="image-fit">
										<?php if ( get_mental_option( 'gallery_single_full_show_controls_above_image' ) ) { ?>
											<div class="section st-invert ft-single-post gallery-controls">
												<section>
													<div class="container">
														<div class="row">
															<div class="col-sm-4 text-left">
																<?php previous_post_link( '%link', __( 'Previous image', 'mental' ) ); ?>
															</div>
															<div class="col-sm-4 text-center">
																<?php if ( $bck2gl_link = mental_get_back_to_gallery_link() ): ?>
																	<a href="<?php echo esc_url( $bck2gl_link ); ?>" class="ft-back2gallery"><?php _e( 'Back to Gallery', 'mental' ); ?></a>
																<?php endif ?>
															</div>
															<div class="col-sm-4 text-right">
																<?php next_post_link( '%link', __( 'Next image', 'mental' ) ); ?>
															</div>
														</div>
													</div>
												</section>
											</div>
										<?php } ?>
										<?php the_post_thumbnail( 'large' ); // Fullsize image for the single post ?>
									</figure>

								<?php endif; ?>

							<?php endif; ?>

							<div class="row sw-description">
								<div class="col-md-<?php echo get_mental_option( 'gallery_single_show_info_column' ) ? 9 : 12; ?>">
									<h4><?php the_title(); ?></h4>

									<?php
									if( get_mental_option('gallery_single_show_top_section') ) {
										if ( get_post_format() == 'gallery' ) { // Remove gallery shortcode from content
											echo apply_filters( 'the_content', strip_shortcode_gallery( get_the_content() ) );
										} elseif ( get_post_format() == 'video' ) {
											echo apply_filters( 'the_content', strip_embed_content( get_the_content() ) );
										} else {
											the_content();
										}
									} else {
										the_content();
									}
									?>

									<?php if( get_mental_option( 'social_block_show' ) ): ?>
										<div class="mb-social">
											<h6><?php _e( 'SHARE', 'mental' ) ?></h6>
											<?php get_template_part( 'blocks/social-share' ) ?>
										</div>
									<?php endif; ?>

									<?php edit_post_link(); // Always handy to have Edit Post Links available ?>

								</div>
								<?php if( get_mental_option( 'gallery_single_show_info_column' ) ): ?>
									<div class="col-md-3">
										<?php if( $categories = azl_get_categories(', ', 'gallery_category') ): ?>
										<h5><?php _e( 'Categories', 'mental' ); ?></h5>
											<p><?php echo $categories; ?></p>
										<?php endif ?>
										<h5><?php _e( 'Date', 'mental' ); ?></h5>
										<p><?php the_time( 'F j, Y' ); ?> <?php the_time( 'g:i a' ); ?></p>
										<h5><?php _e( 'Author', 'mental' ); ?></h5>
										<p><?php the_author_posts_link(); ?></p>
									</div>
								<?php endif ?>
							</div>
						</article>

					</div>
				</section>
			</div> <!-- section -->

		<div class="section st-invert ft-single-post">
			<section>
				<div class="container">
					<div class="row">
						<div class="col-sm-4 text-left">
							<?php previous_post_link( '%link', __( 'Previous image', 'mental' ) ); ?>
						</div>
						<div class="col-sm-4 text-center">
							<?php if( $bck2gl_link = mental_get_back_to_gallery_link() ): ?>
								<a href="<?php echo esc_url($bck2gl_link); ?>" class="ft-back2gallery"><?php _e( 'Back to Gallery', 'mental'); ?></a>
							<?php endif ?>
						</div>
						<div class="col-sm-4 text-right">
							<?php next_post_link( '%link', __( 'Next image', 'mental' ) ); ?>
						</div>
					</div>
				</div>
			</section>
		</div>

		<?php if ( get_mental_option( 'comments_show' ) ): ?>

			<div class="section st-invert st-black cm-invert">
				<section>
					<div class="container container-800">

						<?php comments_template(); ?>

					</div>
					<!-- container -->
				</section>
			</div> <!-- section -->

		<?php endif; ?>

		<?php if ( comments_open() ): ?>
			<div class="footer ft-single-post">
				<footer>
					<div class="container">
						<div class="row">
							<div class="col-sm-4 text-left">
								<?php previous_post_link( '%link', __( 'Previous image', 'mental' ) ); ?>
							</div>
							<div class="col-sm-4 text-center">
								<?php if( $bck2gl_link = mental_get_back_to_gallery_link() ): ?>
									<a href="<?php echo esc_url($bck2gl_link); ?>" class="ft-back2gallery"><?php _e( 'Back to Gallery', 'mental'); ?></a>
								<?php endif ?>							</div>
							<div class="col-sm-4 text-right">
								<?php next_post_link( '%link', __( 'Next image', 'mental' ) ); ?>
							</div>
						</div>
					</div>
				</footer>
			</div>
		<?php endif ?>

	<?php endwhile; else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'mental' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>

<?php if ( $footer_parallax_effect ): ?>
	</div>
<?php endif ?>

	<?php if ( get_mental_option( 'footer_show' ) ) get_template_part( 'blocks/widget-footer' ) ?>

</div> <!-- main -->

<?php get_footer(); ?>

