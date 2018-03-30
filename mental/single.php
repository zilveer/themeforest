<?php
/**
 * The Template for displaying all single posts
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

	<?php if ( ! get_mental_option( 'show_topmenu' ) ) get_template_part( 'blocks/mobile-header' ) ?>

	<?php if ( have_posts() ): while( have_posts() ) : the_post(); ?>

		<?php if ( get_mental_option( 'show_topmenu' ) ) get_template_part( 'blocks/topmenu' ); ?>

		<?php if ( get_mental_option( 'show_header' ) ): ?>

			<?php azl_get_template_part('blocks/header', '', array('title' => get_the_title())); ?>

		<?php endif ?>

		<?php if( get_mental_option('blog_single_show_top_section') ): ?>

			<div class="section">
				<section>
					<div class="container">
						<?php if ( get_post_format() == 'video' && $video = get_post_video( get_the_content() ) ): ?>

							<div class="responsive-embed">
								<?php echo mental_escape_iframe($video); ?>
							</div>

						<?php elseif ( get_post_format() == 'gallery' && $gallery = get_post_gallery( get_the_ID(), false ) ) : // If Post gallery {?>

							<?php
							$img_srcs = array();
							if ( isset( $gallery['ids']) ) {
								$img_ids = explode( ',', $gallery['ids']);
								foreach ( $img_ids as $img_id ) {
									$img_src = wp_get_attachment_image_src( $img_id, 'large' );
									$img_srcs[] =  $img_src[0];
								}
							} elseif ( isset( $gallery['src'] ) ) {
								$img_srcs = $gallery['src'];
							}
							?>

							<?php if($img_srcs): ?>

								<?php $carousel_id = rand( 1, 999 ) ?>

								<div id="carousel-<?php echo (int) $carousel_id ?>" class="carousel slide" data-ride="carousel">

									<!-- Wrapper for slides -->
									<div class="carousel-inner">
										<?php $i = 0; foreach ( $img_srcs as $img_src ): ?>
											<div class="item <?php echo ( $i == 0 ) ? 'active' : '' ?>">
												<img src="<?php echo esc_url($img_src); ?>" alt="slide">
											</div>
										<?php $i ++; endforeach ?>
									</div>
									<!-- Indicators -->
									<ol class="carousel-indicators">
										<?php $i = 0; foreach ( $img_srcs as $img_src ): ?>
											<li data-target="#carousel-<?php echo (int) $carousel_id ?>" data-slide-to="<?php echo (int) $i ?>" class="<?php echo ( $i == 0 ) ? 'active' : '' ?>"></li>
										<?php $i ++; endforeach ?>
									</ol>

									<!-- Controls -->
									<a class="left carousel-control" href="#carousel-<?php echo (int) $carousel_id ?>" data-slide="prev">
										<span></span>
									</a>
									<a class="right carousel-control" href="#carousel-<?php echo (int) $carousel_id ?>" data-slide="next">
										<span></span>
									</a>

								</div> <!-- carousel -->

							<?php endif ?>

						<?php elseif ( has_post_thumbnail() ) : // Check if Thumbnail exists {?>

							<figure class="image-fit">
								<?php the_post_thumbnail( 'large' ); // Fullsize image for the single post ?>
							</figure>

						<?php endif; ?>

					</div>
				</section>
			</div>

		<?php endif; ?>

		<div class="section single-post">
			<section>
				<div class="container <?php echo get_mental_option( 'sidebar_show' ) ? '' : 'container-800' ?>">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<div class="row sw-description">
							<div class="<?php echo get_mental_option( 'sidebar_show' ) ? 'col-md-8' : 'col-md-12' ?>
								<?php echo ( get_mental_option( 'sidebar_show' ) && get_mental_option( 'sidebar_position' ) == 'left' ) ? 'col-md-push-4' : '' ?>">

								<article>
									<h1><?php the_title(); ?></h1>

									<p class="sp-info">
										<?php _e( 'Posted by', 'mental' ); ?> <?php the_author_posts_link(); ?> <?php _e( 'on', 'mental' ); ?>
										<time  datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'F j, Y' ); ?> <?php the_time( 'g:i a' ); ?></time>
										/ <a href="<?php comments_link(); ?>"><?php $comments_count = wp_count_comments( get_the_ID() ); echo (int) $comments_count->approved; ?> <?php _e( 'Comments', 'mental' ); ?></a>
									</p>

									<div class="sp-content">
										<?php
										if( get_mental_option('blog_single_show_top_section') ) {
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
									</div>

									<div class="sp-footer">
										<footer>
											<div class="row">
												<div class="col col-sm-6">
													<span class="sp-tags-title"><?php _e( 'TAGS', 'mental' ) ?></span>
													<span class="sp-tags">
													<?php echo get_the_tag_list( '', ', ', '' ); ?>
													</span>
												</div>
												<div class="col col-sm-6 text-right">
													<?php if( get_mental_option( 'social_block_show' ) ): ?>
														<span class="sp-share-title"><?php _e( 'SHARE', 'mental' ) ?></span>
														<?php get_template_part( 'blocks/social-share' ) ?>
													<?php endif; ?>
												</div>
											</div>
										</footer>
									</div>

									<?php the_mental_pagination(); ?>

									<?php edit_post_link(); // Always handy to have Edit Post Links available ?>

									<?php
									if ( get_mental_option('blog_single_show_related') && function_exists( 'related_entries' ))
										related_entries();
									?>

								</article>
							</div>
							<?php if ( get_mental_option( 'sidebar_show' ) ): ?>
								<div
									class="col-md-3 <?php echo ( get_mental_option( 'sidebar_position' ) == 'left' ) ? 'col-md-pull-8' : 'col-md-offset-1' ?>">
									<?php get_template_part( 'sidebar' ); ?>
								</div>
							<?php endif ?>
						</div>
					</article>

				</div>
			</section>
		</div> <!-- section -->

		<?php if ( get_mental_option( 'comments_show' ) ): ?>

			<div class="section st-bg-grey-lighter">
				<section>
					<div class="container container-800">

						<?php comments_template(); ?>

					</div>
					<!-- container -->
				</section>
			</div> <!-- section -->

		<?php endif; ?>

		<div class="footer ft-single-post">
			<footer>
				<div class="container">
					<div class="row">
						<div class="col-sm-4 text-left">
							<?php previous_post_link( '%link', __( 'Previous Post', 'mental' ) ); ?>
						</div>
						<div class="col-sm-4 text-center">

						</div>
						<div class="col-sm-4 text-right">
							<?php next_post_link( '%link', __( 'Next Post', 'mental' ) ); ?>
						</div>
					</div>
				</div>
			</footer>
		</div>


	<?php endwhile;
	else: ?>

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

