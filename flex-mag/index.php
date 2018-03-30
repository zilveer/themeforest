<?php get_header(); ?>
<div id="home-main-wrap" class="left relative">
	<div class="home-wrap-out1">
		<div class="home-wrap-in1">
			<div id="home-left-wrap" class="left relative">
				<div id="home-left-col" class="relative">
					<div id="home-mid-wrap" class="left relative">
						<div id="archive-list-wrap" class="left relative">
							<?php if(get_option('mvp_arch_layout') == 'Column' ) { ?>
								<ul class="archive-col-list left relative infinite-content">
							<?php } else { ?>
								<ul class="archive-list left relative infinite-content">
							<?php } ?>
									<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
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
										</li>
								<?php endwhile; endif; ?>
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
			<?php if(get_option('mvp_home_side') == 'Popular') { ?>
				<?php get_template_part('popular'); ?>
			<?php } else { ?>
				<?php get_sidebar(); ?>
			<?php } ?>
		</div><!--home-right-col-->
	</div><!--home-wrap-out1-->
</div><!--home-main-wrap-->
<?php get_footer(); ?>