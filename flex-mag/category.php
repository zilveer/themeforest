<?php get_header(); ?>
<h1 class="cat-head left"><?php single_cat_title(); ?></h1>
<?php $mvp_featured_cat = get_option('mvp_featured_cat'); if ($mvp_featured_cat == "true") { if ( $paged < 2 ) { ?>
	<?php $mvp_feat_cat_layout = get_option('mvp_feat_cat_layout'); if( $mvp_feat_cat_layout == "Featured 2" ) { ?>
		<div id="feat-top-wrap" class="left relative">
			<div id="home-feat-wrap" class="left relative">
				<?php global $do_not_duplicate; global $post; $current_category = single_cat_title("", false); $category_id = get_cat_ID($current_category); $cat_posts = new WP_Query(array( 'cat' => $category_id, 'posts_per_page' => '1'  )); while($cat_posts->have_posts()) : $cat_posts->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
					<div class="home-feat-main left relative">
						<a href="<?php the_permalink(); ?>" rel="bookmark">
						<div id="home-feat-img" class="left relative">
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
								<?php the_post_thumbnail('', array( 'class' => 'reg-img' )); ?>
								<?php the_post_thumbnail('mvp-medium-thumb', array( 'class' => 'mob-img' )); ?>
							<?php } ?>
						</div><!--home-feat-img-->
						<div id="home-feat-text">
							<span class="feat-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
							<?php if(get_post_meta($post->ID, "mvp_featured_headline", true)): ?>
								<h2><?php echo esc_html(get_post_meta($post->ID, "mvp_featured_headline", true)); ?></h2>
								<p><?php the_title(); ?></p>
							<?php else: ?>
								<h2 class="stand-title"><?php the_title(); ?></h2>
							<?php endif; ?>
						</div><!--home-feat-text-->
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
						</a>
					</div><!--home-feat-main-->
				<?php } endwhile; wp_reset_postdata(); ?>
			</div><!--home-feat-wrap-->
		</div><!--feat-top-wrap-->
	<?php } else if( $mvp_feat_cat_layout == "Featured 4" ) { ?>
		<div id="feat-top-wrap" class="left relative">
			<div class="feat-top2-left-wrap left relative">
				<?php global $do_not_duplicate; global $post; $current_category = single_cat_title("", false); $category_id = get_cat_ID($current_category); $cat_posts = new WP_Query(array( 'cat' => $category_id, 'posts_per_page' => '1'  )); while($cat_posts->have_posts()) : $cat_posts->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
					<div class="feat-top2-left left relative">
						<a href="<?php the_permalink(); ?>" rel="bookmark">
						<div class="feat-top2-left-img left relative">
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
								<?php the_post_thumbnail('mvp-post-thumb', array( 'class' => 'reg-img' )); ?>
								<?php the_post_thumbnail('mvp-medium-thumb', array( 'class' => 'mob-img' )); ?>
							<?php } ?>
						</div><!--feat-top-left-img-->
						<div class="feat-top2-left-text">
							<span class="feat-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
							<?php if(get_post_meta($post->ID, "mvp_featured_headline", true)): ?>
								<h2><?php echo esc_html(get_post_meta($post->ID, "mvp_featured_headline", true)); ?></h2>
								<p><?php the_title(); ?></p>
							<?php else: ?>
								<h2 class="stand-title"><?php the_title(); ?></h2>
							<?php endif; ?>
						</div><!--feat-top2-left-text-->
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
						</a>
					</div><!--feat-top2-left-->
				<?php } endwhile; wp_reset_postdata(); ?>
			</div><!--feat-top2-left-wrap-->
			<div class="feat-top2-right-wrap left relative">
				<?php if (isset($do_not_duplicate)) { $current_category = single_cat_title("", false); $category_id = get_cat_ID($current_category); $cat_posts = new WP_Query(array( 'post__not_in' => $do_not_duplicate, 'cat' => $category_id, 'posts_per_page' => '3'  )); while($cat_posts->have_posts()) : $cat_posts->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
					<div class="feat-top2-right left relative">
						<a href="<?php the_permalink(); ?>" rel="bookmark">
						<div class="feat-top2-right-img left relative">
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
								<?php the_post_thumbnail('mvp-medium-thumb', array( 'class' => 'feat-top2-small' )); ?>
								<?php the_post_thumbnail('mvp-post-thumb', array( 'class' => 'feat-top2-big' )); ?>
							<?php } ?>
						</div><!--feat-top2-right-img-->
						<div class="feat-top2-right-text">
							<span class="feat-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
							<h2><?php the_title(); ?></h2>
						</div><!--feat-top2-right-text-->
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
						</a>
					</div><!--feat-top2-right-->
				<?php } endwhile; wp_reset_postdata(); } ?>
			</div><!--feat-top2-right-wrap-->
		</div><!--feat-top-wrap-->
	<?php } else if( $mvp_feat_cat_layout == "Featured 6" ) { ?>
		<div id="feat-top-wrap" class="left relative">
			<?php global $do_not_duplicate; global $post; $current_category = single_cat_title("", false); $category_id = get_cat_ID($current_category); $cat_posts = new WP_Query(array( 'cat' => $category_id, 'posts_per_page' => '1'  )); while($cat_posts->have_posts()) : $cat_posts->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
				<div id="feat-wide-main" class="left relative">
					<a href="<?php the_permalink(); ?>" rel="bookmark">
					<div class="feat-wide1-img left relative">
						<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
							<?php the_post_thumbnail('', array( 'class' => 'reg-img' )); ?>
							<?php the_post_thumbnail('mvp-medium-thumb', array( 'class' => 'mob-img' )); ?>
						<?php } ?>
					</div><!--feat-wide1-img-->
					<div class="feat-wide4-text">
						<span class="feat-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
						<?php if(get_post_meta($post->ID, "mvp_featured_headline", true)): ?>
							<h2><?php echo esc_html(get_post_meta($post->ID, "mvp_featured_headline", true)); ?></h2>
							<p><?php the_title(); ?></p>
						<?php else: ?>
							<h2 class="stand-title"><?php the_title(); ?></h2>
						<?php endif; wp_reset_postdata(); ?>
					</div><!--feat-wide4-text-->
					</a>
				</div><!--feat-wide-main-->
			<?php } endwhile; ?>
			<div id="feat-wide-sub">
				<ul class="feat-wide-sub-list left relative">
					<?php if (isset($do_not_duplicate)) { $current_category = single_cat_title("", false); $category_id = get_cat_ID($current_category); $cat_posts = new WP_Query(array( 'post__not_in' => $do_not_duplicate, 'cat' => $category_id, 'posts_per_page' => '4'  )); while($cat_posts->have_posts()) : $cat_posts->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
						<li>
							<a href="<?php the_permalink(); ?>" rel="bookmark">
							<div class="feat-wide-sub-text left relative">
								<span class="feat-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
								<h2><?php the_title(); ?></h2>
							</div><!--feat-wide-sub-text-->
							</a>
						</li>
					<?php } endwhile; wp_reset_postdata(); } ?>
				</ul>
			</div><!--feat-wide-sub-->
		</div><!--feat-top-wrap-->
	<?php } else if( $mvp_feat_cat_layout == "Featured 8" ) { ?>
		<div id="feat-top-wrap" class="left relative">
			<?php global $do_not_duplicate; global $post; $current_category = single_cat_title("", false); $category_id = get_cat_ID($current_category); $cat_posts = new WP_Query(array( 'cat' => $category_id, 'posts_per_page' => '4'  )); while($cat_posts->have_posts()) : $cat_posts->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
				<div class="feat-wide5-main left relative">
					<a href="<?php the_permalink(); ?>" rel="bookmark">
					<div class="feat-wide5-img left relative">
						<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
							<?php the_post_thumbnail('', array( 'class' => 'reg-img' )); ?>
							<?php the_post_thumbnail('mvp-medium-thumb', array( 'class' => 'mob-img' )); ?>
						<?php } ?>
					</div><!--feat-wide5-img-->
					<div class="feat-wide5-text">
						<span class="feat-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
						<h2><?php the_title(); ?></h2>
					</div><!--feat-wide5-text-->
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
					</a>
				</div><!--feat-wide5-main-->
			<?php } endwhile; wp_reset_postdata(); ?>
		</div><!--feat-top-wrap-->
	<?php } ?>
<?php } } ?>
<div id="home-main-wrap" class="left relative">
	<div class="home-wrap-out1">
		<div class="home-wrap-in1">
			<div id="home-left-wrap" class="left relative">
				<div id="home-left-col" class="relative">
					<?php $mvp_featured_cat = get_option('mvp_featured_cat'); if ($mvp_featured_cat == "true") { if ( $paged < 2 ) { ?>
						<?php $mvp_feat_cat_layout = get_option('mvp_feat_cat_layout'); if( $mvp_feat_cat_layout == "Featured 1" ) { ?>
						<div id="home-feat-wrap" class="left relative">
							<?php global $do_not_duplicate; global $post; $current_category = single_cat_title("", false); $category_id = get_cat_ID($current_category); $cat_posts = new WP_Query(array( 'cat' => $category_id, 'posts_per_page' => '1'  )); while($cat_posts->have_posts()) : $cat_posts->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
								<div class="home-feat-main left relative">
									<a href="<?php the_permalink(); ?>" rel="bookmark">
									<div id="home-feat-img" class="left relative">
										<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
											<?php the_post_thumbnail('mvp-post-thumb', array( 'class' => 'reg-img' )); ?>
											<?php the_post_thumbnail('mvp-medium-thumb', array( 'class' => 'mob-img' )); ?>
										<?php } ?>
									</div><!--home-feat-img-->
									<div id="home-feat-text">
										<?php if(get_post_meta($post->ID, "mvp_featured_headline", true)): ?>
											<h2><?php echo esc_html(get_post_meta($post->ID, "mvp_featured_headline", true)); ?></h2>
											<p><?php the_title(); ?></p>
										<?php else: ?>
											<h2 class="stand-title"><?php the_title(); ?></h2>
										<?php endif; ?>
									</div><!--home-feat-text-->
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
									</a>
								</div><!--home-feat-main-->
							<?php } endwhile; wp_reset_postdata(); ?>
						</div><!--home-feat-wrap-->
						<?php } ?>
					<?php } } ?>
					<div id="home-mid-wrap" class="left relative">
						<div id="archive-list-wrap" class="left relative">
							<?php if(get_option('mvp_arch_layout') == 'Column' ) { ?>
								<ul class="archive-col-list left relative infinite-content">
							<?php } else { ?>
								<ul class="archive-list left relative infinite-content">
							<?php } ?>
								<?php global $do_not_duplicate; if (isset($do_not_duplicate)) { ?>
									<?php if (have_posts()) : while (have_posts()) : the_post(); if (in_array($post->ID, $do_not_duplicate)) continue; ?>
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
																<h2><?php the_title(); ?></h2>
																<p><?php echo wp_trim_words( get_the_excerpt(), 22, '...' ); ?></p>
															</div><!--archive-list-text-->
														</div><!--archive-list-in-->
													</div><!--archive-list-out-->
													</a>
												<?php } else { ?>
													<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
													<div class="archive-list-text left relative">
														<h2><?php the_title(); ?></h2>
														<p><?php echo wp_trim_words( get_the_excerpt(), 22, '...' ); ?></p>
													</div><!--archive-list-text-->
													</a>
												<?php } ?>
											</li>
									<?php endwhile; endif; ?>
								<?php } else { ?>
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
														<h2><?php the_title(); ?></h2>
														<p><?php echo wp_trim_words( get_the_excerpt(), 22, '...' ); ?></p>
													</div><!--archive-list-text-->
												</div><!--archive-list-in-->
											</div><!--archive-list-out-->
											</a>
											<?php } else { ?>
												<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
												<div class="archive-list-text left relative">
													<h2><?php the_title(); ?></h2>
													<p><?php echo wp_trim_words( get_the_excerpt(), 22, '...' ); ?></p>
												</div><!--archive-list-text-->
												</a>
											<?php } ?>
										</li>
									<?php endwhile; endif; ?>
								<?php } ?>
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