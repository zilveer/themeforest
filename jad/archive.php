<?php get_header(); ?>
<div class="<?php echo (sg_get_tpl() == 'portfolio|default') ? '' : 'ef-row '; ?>clearfix">
	<div class="ef-recent alignleft">
		<?php if (have_posts()) { ?>
			<?php if (sg_get_tpl() == 'portfolio|default') { ?>
				<div id="ef-portfolio-archive" class="clearfix">
					<?php while (have_posts()) : the_post(); ?>
						<div class="ef-col1-4 ef-item" data-type="<?php sg_the_portfolio_category(get_the_ID()); ?>" data-id="<?php the_ID(); ?>">
							<div class="proj-img<?php if (_sg('PortfolioPost', TRUE)->getType(get_the_ID()) == 'video') echo ' proj-video'; ?>">
								<?php the_post_thumbnail('sg_portfolio'); ?>
								<div class="proj-description">
									<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									<p><?php echo sg_the_tag_list('portfolio_tag', ', '); ?></p>
									<div class="ef-proj-links">
										<div class="alignright">
											<?php $big = (FALSE AND _sg('PortfolioPost', TRUE)->getType(get_the_ID()) == 'video') ? _sg('PortfolioPost', TRUE)->getVideoUrl(get_the_ID()) : wp_get_attachment_url(get_post_thumbnail_id()); ?>
											<a class="ef-view ef-proj-zoom" rel="ef-group" title="<?php the_title(); ?>" href="<?php echo $big; ?>"></a>
											<a href="<?php the_permalink(); ?>" class="ef-proj-more"></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			<?php } else { ?>
				<div id="ef-bloglist" class="clearfix">
					<?php while (have_posts()) : the_post(); ?>
						<?php
							$img = get_the_post_thumbnail(null, 'sg_post_small', array('alt' => get_the_title()));
							$img_e = (empty($img)) ? FALSE : TRUE;
						?>
						<div id="post-<?php the_ID(); ?>" <?php post_class('ef-blog-post ef-col1-4 bottom-2_4em'); ?>>
							<div class="ef-col">
								<?php if ($img_e) { ?>
									<div class="proj-img bottom-1_2em">
										<?php if (_sg('Post', TRUE)->getType(get_the_ID()) == 'slider' AND _sg('Post', TRUE)->showSlider(get_the_ID())) { ?>
											<div class="ef-post-slider">
												<ul class="slides">
													<?php echo '<li>' . $img . '</li>'; _sg('Post', TRUE)->eSlider(get_the_ID(), 'sg_post_small'); ?>
												</ul>
											</div>
										<?php } else { ?>
											<a href="<?php the_permalink(); ?>"><?php echo $img; ?></a>
										<?php } ?>
									</div>
								<?php } ?>
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<div class="extras-descrp"><?php echo sg_the_tag_list('category', ', '); ?></div>
								<div class="ef-date-comments">
									<div><?php the_time('d'); ?><span><?php the_time('M'); ?></span></div>
									<div><?php echo sg_comments_count() . '<span>' . ((sg_comments_count() == 1) ? __('Comment', SG_TDN) : __('Comments', SG_TDN)) . '</span>'; ?></div>
								</div>
								<p><?php echo str_replace('<p>', '', str_replace('</p>', '<br />', sg_text_trim(get_the_excerpt(), 300))); ?></p>
								<a class="ef-read-more" href="<?php the_permalink(); ?>"><span><?php _e('More', SG_TDN); ?></span></a>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			<?php } ?>
		<?php } else {
			echo sg_message(__('Empty', SG_TDN));
		} ?>
	</div>
	<div class="ef-sidebar">
		<div class="ef-col">
			<?php
				sg_right_sidebar();
				if (sg_term() == 'portfolio') {
					sg_right_sidebar_p();
				} else {
					sg_right_sidebar_b();
				}
			?>
		</div>
	</div>
</div>
<?php sg_pagination($wp_query->max_num_pages); ?>
<?php get_footer(); ?>