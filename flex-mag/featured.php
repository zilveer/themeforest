<?php if ( is_page_template('page-home.php') ) { ?>			
	<?php $mvp_feat_posts = get_option('mvp_feat_posts'); if ($mvp_feat_posts == "true") { ?>
		<?php $mvp_feat_layout = get_option('mvp_feat_layout'); if( $mvp_feat_layout == "Featured 3" ) { ?>
			<div id="feat-wide-wrap" class="left relative">
				<?php global $do_not_duplicate; global $post; $recent = new WP_Query(array( 'tag' => get_option('mvp_feat_posts_tags'), 'posts_per_page' => '1'  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
					<div id="feat-wide-main" class="left relative">
						<a href="<?php the_permalink(); ?>" rel="bookmark">
						<div class="feat-wide1-img left relative">
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
								<?php the_post_thumbnail('', array( 'class' => 'reg-img' )); ?>
								<?php the_post_thumbnail('mvp-medium-thumb', array( 'class' => 'mob-img' )); ?>
							<?php } ?>
						</div><!--feat-wide1-img-->
						<div class="feat-wide1-text">
							<span class="feat-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
							<?php if(get_post_meta($post->ID, "mvp_featured_headline", true)): ?>
								<h2><?php echo esc_html(get_post_meta($post->ID, "mvp_featured_headline", true)); ?></h2>
								<p><?php the_title(); ?></p>
							<?php else: ?>
								<h2 class="stand-title"><?php the_title(); ?></h2>
							<?php endif; ?>
						</div><!--feat-wide1-text-->
						<?php $post_views = get_post_meta($post->ID, "post_views_count", true); if ( $post_views >= 1) { ?>
							<div class="feat-info-wrap">
								<div class="feat-info-views">
									<i class="fa fa-eye fa-2"></i> <span class="feat-info-text"><?php mvp_post_views(); ?></span>
								</div><!--feat-info-views-->
								<?php if (get_comments_number()==0) { } else { ?>
									<div class="feat-info-comm">
										<i class="fa fa-comment"></i> <span class="feat-info-text"><?php comments_number( '0', '1', '%' ); ?></span>
									</div><!--feat-info-comm-->
								<?php } ?>
							</div><!--feat-info-wrap-->
						<?php } ?>
						<?php if ( has_post_format( 'video' )) { ?>
							<div class="feat-vid-but">
								<i class="fa fa-play fa-3"></i>
							</div><!--feat-vid-but-->
						<?php } ?>
						</a>
					</div><!--feat-wide-main-->
				<?php } endwhile; wp_reset_postdata(); ?>
			</div><!--feat-wide-wrap-->
		<?php } else if( $mvp_feat_layout == "Featured 5" ) { ?>
			<div id="feat-wide-wrap" class="left relative">
				<div class="feat-top2-left-wrap left relative">
					<?php global $do_not_duplicate; global $post; $recent = new WP_Query(array( 'tag' => get_option('mvp_feat_posts_tags'), 'posts_per_page' => '1'  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
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
									<?php if (get_comments_number()==0) { } else { ?>
										<div class="feat-info-comm">
											<i class="fa fa-comment"></i> <span class="feat-info-text"><?php comments_number( '0', '1', '%' ); ?></span>
										</div><!--feat-info-comm-->
									<?php } ?>
								</div><!--feat-info-wrap-->
							<?php } ?>
							<?php if ( has_post_format( 'video' )) { ?>
								<div class="feat-vid-but">
									<i class="fa fa-play fa-3"></i>
								</div><!--feat-vid-but-->
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
									<?php if (get_comments_number()==0) { } else { ?>
										<div class="feat-info-comm">
											<i class="fa fa-comment"></i> <span class="feat-info-text"><?php comments_number( '0', '1', '%' ); ?></span>
										</div><!--feat-info-comm-->
									<?php } ?>
								</div><!--feat-info-wrap-->
							<?php } ?>
							<?php if ( has_post_format( 'video' )) { ?>
								<div class="feat-vid-but">
									<i class="fa fa-play fa-3"></i>
								</div><!--feat-vid-but-->
							<?php } ?>
							</a>
						</div><!--feat-top2-right-->
					<?php } endwhile; wp_reset_postdata(); } ?>
				</div><!--feat-top2-right-wrap-->
			</div><!--feat-wide-wrap-->
		<?php } else if( $mvp_feat_layout == "Featured 7" ) { ?>
			<div id="feat-wide-wrap" class="left relative">
				<?php global $do_not_duplicate; global $post; $recent = new WP_Query(array( 'tag' => get_option('mvp_feat_posts_tags'), 'posts_per_page' => '1'  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
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
			</div><!--feat-wide-wrap-->
		<?php } else if( $mvp_feat_layout == "Featured 9" ) { ?>
			<div id="feat-wide-wrap" class="left relative">
				<?php global $do_not_duplicate; global $post; $recent = new WP_Query(array( 'tag' => get_option('mvp_feat_posts_tags'), 'posts_per_page' => '4'  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
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
								<?php if (get_comments_number()==0) { } else { ?>
									<div class="feat-info-comm">
										<i class="fa fa-comment"></i> <span class="feat-info-text"><?php comments_number( '0', '1', '%' ); ?></span>
									</div><!--feat-info-comm-->
								<?php } ?>
							</div><!--feat-info-wrap-->
						<?php } ?>
						<?php if ( has_post_format( 'video' )) { ?>
							<div class="feat-vid-but">
								<i class="fa fa-play fa-3"></i>
							</div><!--feat-vid-but-->
						<?php } ?>
						</a>
					</div><!--feat-wide5-main-->
				<?php } endwhile; wp_reset_postdata(); ?>
			</div><!--feat-wide-wrap-->
		<?php } ?>
	<?php } ?>
<?php } else if ( is_category() ) { ?>
	<?php $mvp_featured_cat = get_option('mvp_featured_cat'); if ($mvp_featured_cat == "true") { if ( $paged < 2 ) { ?>
		<?php $mvp_feat_cat_layout = get_option('mvp_feat_cat_layout'); if( $mvp_feat_cat_layout == "Featured 3" ) { ?>
			<div id="feat-wide-wrap" class="left relative">
				<?php global $do_not_duplicate; global $post; $current_category = single_cat_title("", false); $category_id = get_cat_ID($current_category); $cat_posts = new WP_Query(array( 'cat' => $category_id, 'posts_per_page' => '1'  )); while($cat_posts->have_posts()) : $cat_posts->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
					<div id="feat-wide-main" class="left relative">
						<a href="<?php the_permalink(); ?>" rel="bookmark">
						<div class="feat-wide1-img left relative">
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
								<?php the_post_thumbnail('', array( 'class' => 'reg-img' )); ?>
								<?php the_post_thumbnail('mvp-medium-thumb', array( 'class' => 'mob-img' )); ?>
							<?php } ?>
						</div><!--feat-wide1-img-->
						<div class="feat-wide1-text">
							<span class="feat-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
							<?php if(get_post_meta($post->ID, "mvp_featured_headline", true)): ?>
								<h2><?php echo esc_html(get_post_meta($post->ID, "mvp_featured_headline", true)); ?></h2>
								<p><?php the_title(); ?></p>
							<?php else: ?>
								<h2 class="stand-title"><?php the_title(); ?></h2>
							<?php endif; ?>
						</div><!--feat-wide1-text-->
						<?php $post_views = get_post_meta($post->ID, "post_views_count", true); if ( $post_views >= 1) { ?>
							<div class="feat-info-wrap">
								<div class="feat-info-views">
									<i class="fa fa-eye fa-2"></i> <span class="feat-info-text"><?php mvp_post_views(); ?></span>
								</div><!--feat-info-views-->
								<?php if (get_comments_number()==0) { } else { ?>
									<div class="feat-info-comm">
										<i class="fa fa-comment"></i> <span class="feat-info-text"><?php comments_number( '0', '1', '%' ); ?></span>
									</div><!--feat-info-comm-->
								<?php } ?>
							</div><!--feat-info-wrap-->
						<?php } ?>
						<?php if ( has_post_format( 'video' )) { ?>
							<div class="feat-vid-but">
								<i class="fa fa-play fa-3"></i>
							</div><!--feat-vid-but-->
						<?php } ?>
						</a>
					</div><!--feat-wide-main-->
				<?php } endwhile; wp_reset_postdata(); ?>
			</div><!--feat-wide-wrap-->
		<?php } else if( $mvp_feat_cat_layout == "Featured 5" ) { ?>
			<div id="feat-wide-wrap" class="left relative">
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
									<?php if (get_comments_number()==0) { } else { ?>
										<div class="feat-info-comm">
											<i class="fa fa-comment"></i> <span class="feat-info-text"><?php comments_number( '0', '1', '%' ); ?></span>
										</div><!--feat-info-comm-->
									<?php } ?>
								</div><!--feat-info-wrap-->
							<?php } ?>
							<?php if ( has_post_format( 'video' )) { ?>
								<div class="feat-vid-but">
									<i class="fa fa-play fa-3"></i>
								</div><!--feat-vid-but-->
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
									<?php if (get_comments_number()==0) { } else { ?>
										<div class="feat-info-comm">
											<i class="fa fa-comment"></i> <span class="feat-info-text"><?php comments_number( '0', '1', '%' ); ?></span>
										</div><!--feat-info-comm-->
									<?php } ?>
								</div><!--feat-info-wrap-->
							<?php } ?>
							<?php if ( has_post_format( 'video' )) { ?>
								<div class="feat-vid-but">
									<i class="fa fa-play fa-3"></i>
								</div><!--feat-vid-but-->
							<?php } ?>
							</a>
						</div><!--feat-top2-right-->
					<?php } endwhile; wp_reset_postdata(); } ?>
				</div><!--feat-top2-right-wrap-->
			</div><!--feat-wide-wrap-->
		<?php } else if( $mvp_feat_cat_layout == "Featured 7" ) { ?>
			<div id="feat-wide-wrap" class="left relative">
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
			</div><!--feat-wide-wrap-->
		<?php } else if( $mvp_feat_cat_layout == "Featured 9" ) { ?>
			<div id="feat-wide-wrap" class="left relative">
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
								<?php if (get_comments_number()==0) { } else { ?>
									<div class="feat-info-comm">
										<i class="fa fa-comment"></i> <span class="feat-info-text"><?php comments_number( '0', '1', '%' ); ?></span>
									</div><!--feat-info-comm-->
								<?php } ?>
							</div><!--feat-info-wrap-->
						<?php } ?>
						<?php if ( has_post_format( 'video' )) { ?>
							<div class="feat-vid-but">
								<i class="fa fa-play fa-3"></i>
							</div><!--feat-vid-but-->
						<?php } ?>
						</a>
					</div><!--feat-wide5-main-->
				<?php } endwhile; wp_reset_postdata(); ?>
			</div><!--feat-wide-wrap-->
		<?php } ?>
	<?php } } ?>
<?php } ?>