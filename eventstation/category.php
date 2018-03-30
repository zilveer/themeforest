<?php
/*
	* The template for displaying category
*/
get_header(); ?>

	<?php
		$blog_heading_navigation = ot_get_option( 'blog_heading_navigation' );
		if( $blog_heading_navigation == "on" or !$blog_heading_navigation == "off" ) {
			eventstation_heading_navigation();
		} else {
	?>
		<?php eventstation_no_header_code(); ?>
	<?php } ?>
			
	<?php eventstation_site_sub_content_start(); ?>
		<?php eventstation_container_fluid_before(); ?>
			<?php eventstation_alternative_row_before(); ?>
				<?php eventstation_content_area_start(); ?>
					<?php if ( have_posts() ) : ?>
						<div class="category-post-list post-list category-item-list">
							<?php while ( have_posts() ) : the_post(); ?>
								<article id="post-<?php the_ID(); ?>" <?php post_class( 'animate anim-fadeIn' ); ?>>
									<div class="post-wrapper">
										<div class="post-header">
											<?php
												$blog_post_information = ot_get_option( 'blog_post_information' );
												if( $blog_post_information == "on" or !$blog_post_information == "off" ) {
											?>
												<ul class="post-information">
													<li class="author"><i class="fa fa-user"></i> <?php echo esc_html__( 'Author:', 'eventstation' ); ?> <span><?php the_author_posts_link(); ?></span></li>
													<li class="separator">&#45;</li>
													<li class="date"><i class="fa fa-calendar-check-o"></i> <?php echo esc_html__( 'Date:', 'eventstation' ); ?> <span><?php the_time( get_option( 'date_format' ) ); ?></span></li>
												</ul>
											<?php } ?>
											<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
											<?php
												$blog_post_title_excerpt = ot_get_option( 'blog_post_title_excerpt' );
												if( $blog_post_title_excerpt == "on" or !$blog_post_title_excerpt == "off" ) {
													$post_excerpt_two = get_post_meta( get_the_ID(), "excerpt_two_meta_box_text", true );
													if( !empty( $post_excerpt_two ) ) {
											?>
													<div class="post-excerpt-two">
														<?php echo esc_attr( $post_excerpt_two ); ?>
													</div>
													<?php } ?>
												<?php } ?>
										</div>
										<?php
											$blog_post_image = ot_get_option( 'blog_post_image' );
											if( $blog_post_image == "on" or !$blog_post_image == "off" ) {
										?>
											<?php if ( has_post_thumbnail() ) : ?>
												<div class="post-image">
													<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
														<?php the_post_thumbnail( 'eventstation-blog-list' ); ?>
													</a>
													<?php 
														$blog_post_category_name = ot_get_option( 'blog_post_category_name' );
														if( $blog_post_category_name == "on" or !$blog_post_category_name == "off" ) {
													?>
														<div class="category"><?php the_category( '', '' ); ?></div>
													<?php } ?>
												</div>
											<?php endif; ?>
										<?php } ?>
										<?php
											$blog_post_excerpt = ot_get_option( 'blog_post_excerpt' );
											if( $blog_post_excerpt == "on" or !$blog_post_excerpt == "off" ) { ?>
												<div class="post-excerpt">
													<?php the_excerpt(); ?>
												</div>
											<?php } ?>
										<div class="post-bottom">
											<?php
												$blog_post_read_more = ot_get_option( 'blog_post_read_more' );
												if( $blog_post_read_more == "on" or !$blog_post_read_more == "off" ) {
											?>
												<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="more"><span><?php printf( esc_html__( 'Read More', 'eventstation' ) ); ?></span><i class="fa fa-angle-right"></i></a>
											<?php } ?>
											<?php
												$blog_post_share_buttons = ot_get_option( 'blog_post_share_buttons' );
												if( $blog_post_share_buttons == "on" or !$blog_post_share_buttons == "off" ) {
											?>
												<?php eventstation_post_content_social_share(); ?>
											<?php } ?>
										</div>
									</div>
								</article>
							<?php endwhile; ?>
						</div>
						<?php eventstation_pagination(); ?>
					<?php else : ?>
						<?php get_template_part( 'include/formats/content', 'none' ); ?>
					<?php endif; ?>
				<?php eventstation_content_area_end(); ?>
				
				<?php get_sidebar(); ?> 
				
			<?php eventstation_alternative_row_after(); ?>
			
		<?php eventstation_container_fluid_after(); ?>
	<?php eventstation_site_sub_content_end(); ?>

<?php get_footer();