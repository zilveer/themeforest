<?php
	/* Template Name: Home */
?>
<?php get_header(); ?>
<?php $mvp_feat_posts = get_option('mvp_feat_posts'); if ($mvp_feat_posts == "true") { ?>
	<?php $mvp_feat_layout = get_option('mvp_feat_layout'); if( $mvp_feat_layout == "Featured 2" ) { ?>
		<div id="feat-top-wrap" class="left relative">
			<div id="home-feat-wrap" class="left relative">
				<?php global $do_not_duplicate; global $post; $recent = new WP_Query(array( 'tag' => get_option('mvp_feat_posts_tags'), 'posts_per_page' => '1'  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
					<div class="home-feat-main left relative">
						<a href="<?php the_permalink(); ?>" rel="bookmark">
						<div id="home-feat-img" class="left relative">
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
								<?php the_post_thumbnail('', array( 'class' => 'unlazy reg-img' )); ?>
								<?php the_post_thumbnail('mvp-medium-thumb', array( 'class' => 'unlazy mob-img' )); ?>
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
	<?php } else if( $mvp_feat_layout == "Featured 4" ) { ?>
		<div id="feat-top-wrap" class="left relative">
			<div class="feat-top2-left-wrap left relative">
				<?php global $do_not_duplicate; global $post; $recent = new WP_Query(array( 'tag' => get_option('mvp_feat_posts_tags'), 'posts_per_page' => '1'  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
					<div class="feat-top2-left left relative">
						<a href="<?php the_permalink(); ?>" rel="bookmark">
						<div class="feat-top2-left-img left relative">
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
								<?php the_post_thumbnail('mvp-post-thumb', array( 'class' => 'unlazy reg-img' )); ?>
								<?php the_post_thumbnail('mvp-medium-thumb', array( 'class' => 'unlazy mob-img' )); ?>
							<?php } ?>
						</div><!--feat-top-left-img-->
						<?php if ( has_post_format( 'video' )) { ?>
							<div class="feat-vid-but">
								<i class="fa fa-play fa-3"></i>
							</div><!--feat-vid-but-->
						<?php } ?>
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
				<?php if (isset($do_not_duplicate)) { $recent = new WP_Query(array( 'post__not_in' => $do_not_duplicate, 'tag' => get_option('mvp_feat_posts_tags'), 'posts_per_page' => '3'  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
					<div class="feat-top2-right left relative">
						<a href="<?php the_permalink(); ?>" rel="bookmark">
						<div class="feat-top2-right-img left relative">
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
								<?php the_post_thumbnail('mvp-medium-thumb', array( 'class' => 'unlazy feat-top2-small' )); ?>
								<?php the_post_thumbnail('mvp-post-thumb', array( 'class' => 'unlazy feat-top2-big' )); ?>
							<?php } ?>
						</div><!--feat-top2-right-img-->
						<?php if ( has_post_format( 'video' )) { ?>
							<div class="feat-vid-but">
								<i class="fa fa-play fa-3"></i>
							</div><!--feat-vid-but-->
						<?php } ?>
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
	<?php } else if( $mvp_feat_layout == "Featured 6" ) { ?>
		<div id="feat-top-wrap" class="left relative">
							<?php global $do_not_duplicate; global $post; $recent = new WP_Query(array( 'tag' => get_option('mvp_feat_posts_tags'), 'posts_per_page' => '1'  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
								<div id="feat-wide-main" class="left relative">
									<a href="<?php the_permalink(); ?>" rel="bookmark">
									<div class="feat-wide1-img left relative">
										<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
											<?php the_post_thumbnail('', array( 'class' => 'unlazy reg-img' )); ?>
											<?php the_post_thumbnail('mvp-medium-thumb', array( 'class' => 'unlazy mob-img' )); ?>
										<?php } ?>
									</div><!--feat-wide1-img-->
									<?php if ( has_post_format( 'video' )) { ?>
										<div class="feat-vid-but">
											<i class="fa fa-play fa-3"></i>
										</div><!--feat-vid-but-->
									<?php } ?>
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
									<?php if (isset($do_not_duplicate)) { $recent = new WP_Query(array( 'post__not_in' => $do_not_duplicate, 'tag' => get_option('mvp_feat_posts_tags'), 'posts_per_page' => '4'  )); while($recent->have_posts()) : $recent->the_post(); ?>
										<li>
											<a href="<?php the_permalink(); ?>" rel="bookmark">
											<div class="feat-wide-sub-text left relative">
												<span class="feat-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
												<h2><?php the_title(); ?></h2>
											</div><!--feat-wide-sub-text-->
											</a>
										</li>
									<?php endwhile; wp_reset_postdata(); } ?>
								</ul>
							</div><!--feat-wide-sub-->
		</div><!--feat-top-wrap-->
	<?php } else if( $mvp_feat_layout == "Featured 8" ) { ?>
		<div id="feat-top-wrap" class="left relative">
							<?php global $do_not_duplicate; global $post; $recent = new WP_Query(array( 'tag' => get_option('mvp_feat_posts_tags'), 'posts_per_page' => '4'  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
								<div class="feat-wide5-main left relative">
									<a href="<?php the_permalink(); ?>" rel="bookmark">
									<div class="feat-wide5-img left relative">
										<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
											<?php the_post_thumbnail('', array( 'class' => 'unlazy reg-img' )); ?>
											<?php the_post_thumbnail('mvp-medium-thumb', array( 'class' => 'unlazy mob-img' )); ?>
										<?php } ?>
									</div><!--feat-wide5-img-->
									<?php if ( has_post_format( 'video' )) { ?>
										<div class="feat-vid-but">
											<i class="fa fa-play fa-3"></i>
										</div><!--feat-vid-but-->
									<?php } ?>
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
<?php } ?>
<div id="home-main-wrap" class="left relative">
	<div class="home-wrap-out1">
		<div class="home-wrap-in1">
			<div id="home-left-wrap" class=" left relative">
				<div class="home-wrap-out2">
					<div class="home-wrap-in2">
						<div id="tab-col1" class="home-left-col relative tab-col-cont">
							<?php $mvp_feat_posts = get_option('mvp_feat_posts'); $mvp_feat_layout = get_option('mvp_feat_layout'); if( $mvp_feat_layout !== "Featured 1" || $mvp_feat_posts !== "true") { ?>
								<div class="side-title-wrap left relative">
									<h3 class="side-list-title"><?php echo esc_html(get_option('mvp_feat_head')); ?></h3>
								</div><!--side-title-wrap-->
							<?php } ?>
							<?php $mvp_feat_layout = get_option('mvp_feat_layout'); $paged = get_query_var('page'); if ( $mvp_feat_layout == "Featured 1" && $paged > 1 ) { ?>
								<div class="side-title-wrap left relative">
									<h3 class="side-list-title"><?php echo esc_html(get_option('mvp_feat_head')); ?></h3>
								</div><!--side-title-wrap-->
							<?php } ?>
							<?php $mvp_feat_posts = get_option('mvp_feat_posts'); if ($mvp_feat_posts == "true") { ?>
								<?php $mvp_feat_layout = get_option('mvp_feat_layout'); if( $mvp_feat_layout == "Featured 1" ) { ?>
								<div id="home-feat-wrap" class="left relative">
									<?php global $do_not_duplicate; global $post; $recent = new WP_Query(array( 'tag' => get_option('mvp_feat_posts_tags'), 'posts_per_page' => '1'  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
										<div class="home-feat-main left relative">
											<a href="<?php the_permalink(); ?>" rel="bookmark">
											<div id="home-feat-img" class="left relative">
												<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
													<?php the_post_thumbnail('mvp-post-thumb', array( 'class' => 'unlazy reg-img' )); ?>
													<?php the_post_thumbnail('mvp-medium-thumb', array( 'class' => 'unlazy mob-img' )); ?>
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
									<div class="feat-title-wrap">
										<h3 class="home-feat-title"><?php echo esc_html(get_option('mvp_feat_head')); ?></h3>
									</div><!--feat-title-wrap-->
								</div><!--home-feat-wrap-->
								<?php } ?>
							<?php } ?>
							<div id="home-mid-wrap" class="left relative">
								<?php if(get_option('mvp_home_layout') == 'Widgets' || get_option('mvp_home_layout') == 'Widgets and Blog') { ?>
									<?php global $paged; $paged = (get_query_var('page')) ? get_query_var('page') : 1; if ( $paged < 2 ) : ?>
										<?php if ( is_active_sidebar( 'homepage-widget' ) ) { ?>
											<?php dynamic_sidebar( 'homepage-widget' ); ?>
										<?php } ?>
									<?php endif; ?>
								<?php } ?>
								<?php if(get_option('mvp_home_layout') == 'Blog' || get_option('mvp_home_layout') == 'Widgets and Blog') { ?>
									<div class="home-widget left relative">
			<div class="blog-widget-wrap left relative">
				<ul class="blog-widget-list left relative infinite-content">
					<?php if (isset($do_not_duplicate)) { ?>
						<?php global $post; $mvp_posts_num = esc_html(get_option('mvp_posts_num')); $paged = (get_query_var('page')) ? get_query_var('page') : 1; query_posts(array( 'posts_per_page' => $mvp_posts_num, 'post__not_in'=>$do_not_duplicate, 'paged' =>$paged )); if (have_posts()) : while (have_posts()) : the_post(); ?>
						<li class="infinite-post">

							<a href="<?php the_permalink(); ?>" rel="bookmark">
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
								<div class="blog-widget-img left relative">
									<?php the_post_thumbnail('mvp-mid-thumb', array( 'class' => 'reg-img' )); ?>
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
								</div><!--blog-widget-img-->
							<?php } ?>
							<div class="blog-widget-text left relative">
								<span class="side-list-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
								<h2><?php the_title(); ?></h2>
								<p><?php echo wp_trim_words( get_the_excerpt(), 22, '...' ); ?></p>
							</div><!--blog-widget-text-->
							</a>
						</li>
						<?php endwhile; endif; ?>
					<?php } else { ?>
						<?php $mvp_posts_num = esc_html(get_option('mvp_posts_num')); $paged = (get_query_var('page')) ? get_query_var('page') : 1; query_posts(array( 'posts_per_page' => $mvp_posts_num, 'paged' =>$paged )); if (have_posts()) : while (have_posts()) : the_post(); ?>
						<li class="infinite-post">

							<a href="<?php the_permalink(); ?>" rel="bookmark">
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
								<div class="blog-widget-img left relative">
									<?php the_post_thumbnail('mvp-mid-thumb', array( 'class' => 'reg-img' )); ?>
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
								</div><!--blog-widget-img-->
							<?php } ?>
							<div class="blog-widget-text left relative">
								<span class="side-list-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
								<h2><?php the_title(); ?></h2>
								<p><?php echo wp_trim_words( get_the_excerpt(), 22, '...' ); ?></p>
							</div><!--blog-widget-text-->
							</a>
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
			</div><!--blog-widget-wrap-->
									</div><!--home-widget-->
								<?php } ?>
							</div><!--home-mid-wrap-->
						</div><!--home-left-col-->
					</div><!--home-wrap-in2-->
					<?php $mvp_show_latest = get_option('mvp_show_latest'); if ($mvp_show_latest == "true") { ?>
						<div id="tab-col2" class="home-mid-col relative tab-col-cont">
							<?php if(get_option('mvp_home_side_left') == 'Popular') { ?>
								<?php get_template_part('popular'); ?>
							<?php } else if(get_option('mvp_home_side_left') == 'Latest') { ?>
								<?php get_template_part('latest'); ?>
							<?php } else { ?>
								<div id="sidebar-wrap" class="left relative">
									<?php if ( is_active_sidebar( 'sidebar-widget-home-left' ) ) { ?>
										<?php dynamic_sidebar( 'sidebar-widget-home-left' ); ?>
									<?php } ?>
								</div><!--sidebar-wrap-->
							<?php } ?>
						</div><!--home-mid-col-->
					<?php } ?>
				</div><!--home-wrap-out2-->
			</div><!--home-left-wrap-->
		</div><!--home-wrap-in1-->
		<div id="tab-col3" class="home-right-col relative tab-col-cont">
			<?php if(get_option('mvp_home_side') == 'Popular') { ?>
				<?php get_template_part('popular'); ?>
			<?php } else if(get_option('mvp_home_side') == 'Latest') { ?>
				<?php get_template_part('latest'); ?>
			<?php } else { ?>
				<?php get_sidebar(); ?>
			<?php } ?>
		</div><!--home-right-col-->
	</div><!--home-wrap-out1-->
</div><!--home-main-wrap-->
<?php get_footer(); ?>