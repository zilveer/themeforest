<?php
	/* Template Name: Latest Videos */
?>
<?php get_header(); ?>
<div id="home-main-wrap" class="left relative">
	<div class="home-wrap-out1">
		<div class="home-wrap-in1">
			<div id="home-left-wrap" class="left relative">
				<div id="home-left-col" class="relative">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<h1 class="cat-head"><?php the_title(); ?></h1>
					<?php endwhile; endif; ?>
						<div id="latest-video-wrap" class="left relative">
							<?php $mvp_videos_num = esc_html(get_option('mvp_videos_num')); $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts(array( 'tax_query' => array( array( 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => 'post-format-video' )), 'posts_per_page' => '1', 'paged' => $paged )); if (have_posts()) : while (have_posts()) : the_post(); ?>
								<div id="latest-video-main" class="left relative flexslider">
									<div class="video-main-top left relative">
										<div id="video-embed" class="left relative">
											<?php echo html_entity_decode(get_post_meta($post->ID, "mvp_video_embed", true)); ?>
										</div><!--video-embed-->
									</div><!--video-main-left-->
									<div class="video-main-text left relative">
										<span class="side-list-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
										<h2><?php the_title(); ?></h2>
										<p><?php echo wp_trim_words( get_the_excerpt(), 22, '...' ); ?></p>
										<div class="social-sharing-top">
											<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><div class="facebook-share"><span class="fb-but1"><i class="fa fa-facebook fa-2"></i></span><span class="social-text"><?php _e( 'Share', 'mvp-text' ); ?></span></div></a>
											<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&amp;url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><div class="twitter-share"><span class="twitter-but1"><i class="fa fa-twitter fa-2"></i></span><span class="social-text"><?php _e( 'Tweet', 'mvp-text' ); ?></span></div></a>
											<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'mvp-post-thumb' ); echo $thumb['0']; ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><div class="pinterest-share"><span class="pinterest-but1"><i class="fa fa-pinterest-p fa-2"></i></span><span class="social-text"><?php _e( 'Share', 'mvp-text' ); ?></span></div></a>
											<a href="mailto:?subject=<?php the_title(); ?>&amp;BODY=<?php _e( 'I found this article interesting and thought of sharing it with you. Check it out:', 'mvp-text' ); ?> <?php the_permalink(); ?>"><div class="email-share"><span class="email-but"><i class="fa fa-envelope fa-2"></i></span><span class="social-text"><?php _e( 'Email', 'mvp-text' ); ?></span></div></a>
										</div><!--social-sharing-top-->
									</div><!--video-main-text-->
								</div><!--latest-video-main-->
							<?php endwhile; endif; ?>
						</div><!--latest-video-wrap-->
					<div id="home-mid-wrap" class="left relative">
						<div id="archive-list-wrap" class="left relative">
							<?php if(get_option('mvp_arch_layout') == 'Column' ) { ?>
								<ul class="archive-col-list left relative infinite-content">
							<?php } else { ?>
								<ul class="archive-list left relative infinite-content">
							<?php } ?>
								<?php $mvp_posts_num = esc_html(get_option('mvp_posts_num')); $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts(array( 'tax_query' => array( array( 'taxonomy' => 'post_format', 'field' => 'slug', 'terms' => 'post-format-video' )), 'posts_per_page' => $mvp_posts_num, 'paged' => $paged )); if (have_posts()) : while (have_posts()) : the_post(); ?>
									<li class="infinite-post">
										<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
										<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
										<div class="archive-list-out">
											<div class="archive-list-img left relative">
												<?php the_post_thumbnail('mvp-medium-thumb', array( 'class' => 'reg-img' )); ?>
												<?php the_post_thumbnail('mvp-small-thumb', array( 'class' => 'mob-img' )); ?>
												<?php $post_views = get_post_meta($post->ID, "post_views_count", true); if ( $post_views >= 1) { ?>
													<div class="feat-info-wrap">
														<div class="feat-info-views">
															<i class="fa fa-eye fa-2"></i> <span class="feat-info-text"><?php mvp_post_views(); ?></span>
														</div><!--feat-info-views-->
														<?php $disqus_id = get_option('mvp_disqus_id'); if ( ! $disqus_id ) { if (get_comments_number()==0) { } else { ?>
															<div class="feat-info-comm">
																<i class="fa fa-comment"></i> <span class="feat-info-text"><?php comments_number( '0', '1', '%' ); ?></span>
															</div><!--feat-info-comm-->
														<?php } } ?>
													</div><!--feat-info-wrap-->
												<?php } ?>
												<?php if ( has_post_format( 'video' )) { ?>
													<div class="feat-vid-but">
														<i class="fa fa-play fa-3"></i>
													</div><!--feat-vid-but-->
												<?php } ?>
											</div><!--archive-list-img-->
											<div class="archive-list-in">
												<div class="archive-list-text left relative">
													<span class="side-list-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
													<h2><?php the_title(); ?></h2>
													<p><?php echo wp_trim_words( get_the_excerpt(), 22, '...' ); ?></p>
												</div><!--archive-list-text-->
											</div><!--archive-list-in-->
										</div><!--archive-list-out-->
										</a>
										<?php } else { ?>
											<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
											<div class="archive-list-text left relative">
												<span class="side-list-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
												<h2><?php the_title(); ?></h2>
												<p><?php echo wp_trim_words( get_the_excerpt(), 22, '...' ); ?></p>
											</div><!--archive-list-text-->
											</a>
										<?php } ?>
									<?php endwhile; endif; ?>
								</li>
							</ul>
							<?php $mvp_infinite_scroll = get_option('mvp_infinite_scroll'); if ($mvp_infinite_scroll == "true") { if (isset($mvp_infinite_scroll)) { ?>
								<a href="#" class="inf-more-but"><?php _e( 'More Posts', 'mvp-text' ); ?></a>
							<?php } } ?>
							<div class="nav-links">
								<?php if (function_exists("pagination")) { pagination($wp_query->max_num_pages); } ?>
							</div><!--nav-links-->
						</div><!--archive-list-wrap-->
					</div><!--home-mid-wrap-->
				</div><!--home-left-col-->
			</div><!--home-left-wrap-->
		</div><!--home-wrap-in1-->
		<div id="arch-right-col" class="relative">
			<?php get_sidebar(); ?>
		</div><!--home-right-col-->
	</div><!--home-wrap-out1-->
</div><!--home-main-wrap-->
<?php get_footer(); ?>