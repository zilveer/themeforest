<?php
/* ------------------------------------------------------------------------------------------------------------

	Template Name: Home

------------------------------------------------------------------------------------------------------------ */
?>
<?php get_header(); ?>
<?php
	the_post();
	$content = get_the_content();
?>
<?php if (_sg('Home')->showDescription()) { ?>
	<div class="ef-welcome">
		<h2><?php _sg('Home')->eDescription(); ?></h2>
	</div>
	<?php if (!empty($content) OR _sg('Home')->showExtras() OR _sg('Home')->showLatestP() OR _sg('Home')->showLatestB()) { ?>
		<hr class="bottom-3_em" />
	<?php } ?>
<?php } ?>
<?php
	if (!empty($content) AND _sg('Home')->getContentPosition() == 'top') {
		wp_reset_query(); the_content();
	}
?>
<?php if (_sg('Home')->showExtras()) { ?>
	<?php
		$args = array();
		$args['post_type'] = 'extra';
		$args['posts_per_page'] = -1;
		$args['order'] = 'ASC';
		if (_sg('Home')->getExtrasCategory() != 0) {
			$args['post__in'] = get_objects_in_term(_sg('Home')->getExtrasCategory(), 'extra_category');
		}
		query_posts($args);
	?>
	<?php if (!empty($content) AND _sg('Home')->getContentPosition() == 'top') echo '<hr class="ef-blank" />'; ?>
	<?php if (_sg('Home')->showExtrasTitle()) { ?>
		<div class="divider-title bottom-3_em"><span><span><?php _sg('Home')->eExtrasTitle(); ?></span></span></div>
	<?php } ?>
	<div class="ef-extras">
		<?php if (have_posts()) { ?>
			<?php while (have_posts()) : the_post(); ?>
				<div class="ef-col1-4 bottom-1_2em">
					<div class="ef-indent">
						<?php _sg('Extra', TRUE)->eExtraIcon(get_the_ID()); ?>
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<div class="extras-descrp bottom-1_2em"><?php _sg('Extra', TRUE)->eDescription(get_the_ID()); ?></div>
						<p><?php echo str_replace('<p>', '', str_replace('</p>', '<br />', sg_text_trim(get_the_excerpt(), 180))); ?></p>
					</div>
				</div>
			<?php endwhile; ?>
			<div class="clear"></div>
		<?php } else {
			$empty_extras = __('Extras is empty', SG_TDN);
			echo sg_message($empty_extras);
		} ?>
	</div>
<?php } ?>
<?php
	if (!empty($content) AND _sg('Home')->getContentPosition() == 'middle') {
		if (_sg('Home')->showExtras()) echo '<hr class="ef-blank" />';
		wp_reset_query(); the_content();
	}
?>
<?php if (_sg('Home')->showLatestP()) { ?>
	<?php
		$args = array();
		$args['post_type'] = 'portfolio';
		$args['posts_per_page'] = 12;
		$args['meta_key'] = '_thumbnail_id';
		if (_sg('Home')->getLatestPCategory() != 0) {
			$args['post__in'] = get_objects_in_term(_sg('Home')->getLatestPCategory(), 'portfolio_category');
		}
		query_posts($args);
	?>
	<?php if ((!empty($content) AND _sg('Home')->getContentPosition() != 'bottom') OR _sg('Home')->showExtras()) echo '<hr class="ef-blank" />'; ?>
	<?php if (_sg('Home')->showLatestPHead()) { ?>
		<div class="divider-title bottom-3_em"><span><span><?php _sg('Home')->eLatestPHead(); ?></span></span></div>
	<?php } ?>
	<?php if (have_posts()) { ?>
		<?php
			$cats = array();
			if (_sg('Home')->getLatestPCategory() == 0) {
				$tags = get_terms('portfolio_category');
				foreach ($tags as $tag) {
					if (empty($prc)) {
						$cats[$tag->term_id] = $tag->name;
					} elseif (in_array($tag->term_id, $prc)) {
						$cats[$tag->term_id] = $tag->name;
					}
				}
			}
			if (count($cats) > 0) {
		?>
			<ul id="ef-filter" class="option-set" data-option-key="filter">
				<li class="p-current"><a data-option-value="*" href="#"><?php _e('All works', SG_TDN) ?></a></li>
				<?php
					foreach ($cats as $id => $cname) {
						echo '<li><a data-option-value="' . str_replace(' ', '-', strtolower($cname)) . '" href="' . esc_url(get_term_link($id, 'portfolio_category')) . '">' . $cname . '</a></li>';
					}
				?>
			</ul>
		<?php } ?>
		<div id="ef-portfolio" class="ef-latest-works clearfix bottom-1_2em">
			<?php if (_sg('Home')->showLatestPText()) { ?>
				<div class="ef-col1-4 ef-item ef-module-descrp" data-type="*">
					<div class="ef-indent">
						<?php _sg('Home')->eLatestPText(); ?>
					</div>
				</div>
			<?php } ?>
			<?php while (have_posts()) : the_post(); ?>
				<?php
					$img = _sg('PortfolioPost', TRUE)->isFeatured(get_the_ID()) ? 'sg_portfolio_large' : 'sg_portfolio';
				?>
				<div class="ef-col1-4<?php if ($img == 'sg_portfolio_large') echo ' ef-featured'; ?> ef-item" data-type="<?php sg_the_portfolio_category(get_the_ID()); ?>" data-id="<?php the_ID(); ?>">
					<div class="proj-img<?php if (_sg('PortfolioPost', TRUE)->getType(get_the_ID()) == 'video') echo ' proj-video'; ?>">
						<?php the_post_thumbnail($img); ?>
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
	<?php } else {
		$empty_extras = __('Portfolio is empty', SG_TDN);
		echo sg_message($empty_extras);
	} ?>
<?php } ?>
<?php if (_sg('Home')->showLatestB()) { ?>
	<?php
		$args = array();
		$args['post_type'] = 'post';
		$args['posts_per_page'] = 4;
		if (_sg('Home')->getLatestBCategory() != 0) {
			$args['post__in'] = get_objects_in_term(_sg('Home')->getLatestBCategory(), 'category');
		}
		query_posts($args);
		$i = 0;
	?>
	<?php if ((!empty($content) AND _sg('Home')->getContentPosition() != 'bottom') OR _sg('Home')->showExtras() OR _sg('Home')->showLatestP()) echo '<hr class="ef-blank" />'; ?>
	<?php if (_sg('Home')->showLatestBHead()) { ?>
		<div class="divider-title bottom-3_em"><span><span><?php _sg('Home')->eLatestBHead(); ?></span></span></div>
	<?php } ?>
	<?php if (have_posts()) { ?>
		<div class="ef-from-blog clearfix">
			<?php if (_sg('Home')->showLatestBText()) { ?>
				<div class="ef-col1-4 ef-module-descrp">
					<div class="ef-indent">
						<?php _sg('Home')->eLatestBText(); $i++; ?>
					</div>
				</div>
			<?php } ?>
			<?php while (have_posts()) : the_post(); $i++; ?>
				<?php if ($i <= 4) { ?>
					<div class="ef-col1-4 bottom-2_4em ef-blog-post">
						<?php
							$img = get_the_post_thumbnail(null, 'sg_post_small', array('alt' => get_the_title()));
							$img_e = (empty($img)) ? FALSE : TRUE;
						?>
						<?php if ($img_e) { ?>
							<?php if (_sg('Post', TRUE)->getType(get_the_ID()) == 'slider' AND _sg('Post', TRUE)->showSlider(get_the_ID())) { ?>
								<div class="proj-img">
									<div class="ef-post-slider">
										<ul class="slides">
											<?php echo '<li>' . $img . '</li>'; _sg('Post', TRUE)->eSlider(get_the_ID(), 'sg_post_small'); ?>
										</ul>
									</div>
								</div>
							<?php } else { ?>
								<div class="proj-img">
									<a href="<?php the_permalink(); ?>"><?php echo $img; ?></a>
								</div>
							<?php } ?>
						<?php } ?>
						<div class="ef-indent">
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
				<?php } ?>
			<?php endwhile; ?>
		</div>
	<?php } else {
		$empty_extras = __('Portfolio is empty', SG_TDN);
		echo sg_message($empty_extras);
	} ?>
<?php } ?>
<?php
	if (!empty($content) AND _sg('Home')->getContentPosition() == 'bottom') {
		if (_sg('Home')->showExtras() OR _sg('Home')->showLatestP()) echo '<hr class="ef-blank" />';
		wp_reset_query(); the_content();
	}
?>
<?php get_footer(); ?>