<?php get_header(); ?>
<?php
global $wp_query;
$settings = crazyblog_opt();
$queried_object = get_queried_object();
if ( crazyblog_set( $queried_object, 'ID' ) ) {
	$page_meta = get_post_meta( crazyblog_set( $queried_object, 'ID' ), 'crazyblog_page_meta', true );
	$show_banner = crazyblog_set( $page_meta, 'page_title_section' );
	$bg = (crazyblog_set( $page_meta, 'title_section_bg' )) ? 'background:url(' . crazyblog_set( $page_meta, 'title_section_bg' ) . ')' : '';
	$sidebar = (crazyblog_set( $page_meta, 'layout' ) != "full") ? crazyblog_set( $page_meta, 'sidebar' ) : "";
	$layout = (crazyblog_set( $page_meta, 'layout' ) != "full") ? crazyblog_set( $page_meta, 'layout' ) : "";
	$cols = ($layout != "full" && $sidebar ) ? "col-md-8" : 'col-md-12';
	$title = get_the_title( crazyblog_set( $queried_object, 'ID' ) );
} else {
	$index_settings = $settings;
	$show_banner = (crazyblog_set( $index_settings, 'blog_page_title_section' )) ? crazyblog_set( $index_settings, 'blog_page_title_section' ) : true;
	$title = (crazyblog_set( $index_settings, 'blog_page_title' )) ? crazyblog_set( $index_settings, 'blog_page_title' ) : "Blog Posts";
	$sidebar = (crazyblog_set( $index_settings, 'blog_page_sidebar' )) ? crazyblog_set( $index_settings, 'blog_page_sidebar' ) : "primary-widget-area";
	$layout = (crazyblog_set( $index_settings, 'blog_sidebar_layout' )) ? crazyblog_set( $index_settings, 'blog_sidebar_layout' ) : "right";
	$cols = ($layout == "full") ? "col-md-12" : 'col-md-8';
	$bg = (crazyblog_set( $index_settings, 'title_section_bg' )) ? 'background:url(' . crazyblog_set( $index_settings, 'title_section_bg' ) . ')' : "";
}
$no_image = '';
$year = get_the_time( 'Y' );
$month = get_the_time( 'm' );
$day = get_the_time( 'd' );

$general_settings = $settings;
$limit = crazyblog_set( $general_settings, 'character_limit' );
crazyblog_VIEW::get_instance()->crazyblog_enqueue_scripts( array( 'df-isotope', 'df-init-isotope' ) );
?>

<?php if ( $show_banner ) : ?>
	<div class="pagetop" style="<?php echo esc_attr( $bg ); ?>">
		<div class="page-name">
			<div class="container">
				<span><?php echo esc_html( $title ); ?></span>
				<?php echo crazyblog_get_breadcrumbs(); ?>
			</div>
		</div>
	</div><!-- Page Top -->
<?php endif; ?>
<section>
	<div class="block">
		<div class="container">
			<div class="row">
				<?php if ( $sidebar && is_active_sidebar( $sidebar ) && $layout == "left" ) : ?>
					<aside class="col-md-4 column left-sidebar sidebar">
						<?php dynamic_sidebar( $sidebar ); ?>
					</aside>
				<?php endif; ?>
				<div class="<?php echo esc_attr( $cols ); ?>">
					<div class="row">
						<div class="texty-style">
							<div class="masonary">
								<?php
								if ( have_posts() ) : while ( have_posts() ) : the_post();
										$view = (get_post_meta( get_the_ID(), 'crazyblog_post_views', true )) ? get_post_meta( get_the_ID(), 'crazyblog_post_views', true ) : '0';
										$format = get_post_format();
										if ( $format == '' ) {
											$format = 'standerd';
										}
										$innter_col = ($format == 'gallery') ? 'col-md-12' : crazyblog_set( $general_settings, 'blog_post_column' );
										$gridCol = crazyblog_set( $general_settings, 'blog_post_column' );
										if ( $gridCol == 'col-md-12' || $gridCol == 'col-md-6' ) {
											$imgSize = 'crazyblog_1170x590';
										} else {
											$imgSize = 'crazyblog_454x344';
										}
										?>
										<div class="<?php echo esc_attr( $innter_col ) ?>">
											<?php
											$no_image = (has_post_thumbnail()) ? "" : "no-image";
											?>
											<div <?php post_class( 'texty-post ' . $no_image ); ?>>
												<div class="texty-post-img">
													<?php
													if ( $format == 'gallery' ) {
														$post_meta = get_post_meta( get_the_ID(), 'crazyblog_post_meta', true );
														$gallery = crazyblog_set( crazyblog_set( $post_meta, 'crazyblog_post_format_options' ), '0' );
														$gal_ids = crazyblog_set( $gallery, 'crazyblog_post_gallery' );
														if ( !empty( $gal_ids ) ) {
															$ids = explode( ',', $gal_ids );
															if ( count( $ids ) > 0 ) {
																$loop = (count( $ids ) > 1) ? 'true' : 'false';
																crazyblog_Core::get_instance()->view->crazyblog_enqueue_scripts( array( 'df-owl','df-owl-initialization' ) );
																echo '<div class="carousel">';
																foreach ( $ids as $id ) {
																	$src = wp_get_attachment_image_src( $id, $imgSize );
																	echo '<img src="' . esc_url( crazyblog_set( $src, '0' ) ) . '" alt="" />';
																}
																echo '</div>';
																
															}
														} else {
															?>
															<div class="post-thumb">
																<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
																	<?php the_post_thumbnail( $imgSize ); ?>
																</a>
															</div>

															<?php
														}
													} else {
														?>
														<div class="post-thumb">
															<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
																<?php the_post_thumbnail( $imgSize ); ?>
															</a>
														</div>

														<?php
													}
													?>

													<?php if ( crazyblog_set( $general_settings, 'blog_post_author' ) == 'show' ) : ?>
														<a title="" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
															<?php echo get_avatar( get_the_author_meta( 'ID' ), 45 ); ?>
														</a>
													<?php endif; ?>
												</div>
												<div class="texty-post-detail">
													<?php if ( crazyblog_set( $general_settings, 'blog_post_category' ) == 'show' ) : ?>
														<div class="categories">
															<?php echo crazyblog_get_post_categories( get_the_ID() ); ?>
														</div>
													<?php endif; ?>
													<h2><a title="" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
													<?php if ( crazyblog_set( $general_settings, 'blog_post_date' ) == 'show' || crazyblog_set( $general_settings, 'blog_post_author' ) == 'show' ) : ?>
														<ul class="meta">
															<?php
															if ( crazyblog_set( $general_settings, 'blog_post_date' ) == 'show' ) :
																$url = '';
																if ( !get_the_title() ) {
																	$url = get_the_permalink();
																} else {
																	$url = get_day_link( $year, $month, $day );
																}
																?>
																<li><a title="" href="<?php echo esc_url( $url ); ?>"><?php echo get_the_date( get_option( 'post_format' ) ); ?></a></li>
															<?php endif; ?>
															<?php if ( crazyblog_set( $general_settings, 'blog_post_author' ) == 'show' ) : ?>
																<li><?php esc_html_e( 'By ', 'crazyblog' ); ?><a title="" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></li>
															<?php endif; ?>
														</ul>
													<?php endif; ?>
													<?php the_excerpt() ?>

													<?php if ( crazyblog_set( $general_settings, 'blog_post_comments' ) == 'show' || crazyblog_set( $general_settings, 'blog_post_view' ) == 'show' || crazyblog_set( $general_settings, 'blog_post_social_share' ) == 'show' ) : ?>
														<div class="post-info">
															<?php if ( crazyblog_set( $general_settings, 'blog_post_comments' ) == 'show' ) : ?>
																<span class="view"><i class="fa fa-comments"></i><span><?php echo crazyblog_restyle_text( get_comments_number( get_the_ID() ) ) ?></span></span>
															<?php endif; ?>
															<?php if ( crazyblog_set( $general_settings, 'blog_post_view' ) == 'show' ) : ?>
																<span class="view"><i class="fa fa-eye"></i><span><?php echo crazyblog_restyle_text( $view ) ?></span></span>
															<?php endif; ?>
															<?php if ( crazyblog_set( $general_settings, 'blog_post_social_share' ) == 'show' ) : ?>
																<span>
																	<i class="fa fa-share-alt"></i>
																	<span class="share-link">
																		<?php crazyblog_social_share_output( array( 'facebook', 'twitter', 'pinterest' ) ); ?>
																	</span>
																</span>
															<?php endif; ?>
														</div>
													<?php endif; ?>
												</div>
											</div><!-- Texty Post -->
										</div>
										<?php
									endwhile;
									wp_reset_postdata();
								endif;
								?>
								<?php crazyblog_the_pagination(); ?>
							</div>
						</div>
					</div>
				</div>
				<?php if ( $sidebar && is_active_sidebar( $sidebar ) && $layout == "right" ) : ?>
					<aside class="col-md-4 right-sidebar column sidebar">
						<?php dynamic_sidebar( $sidebar ); ?>
					</aside>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>