<?php
/* ------------------------------------------------------------------------------------------------------------

	Template Name: Portfolio

------------------------------------------------------------------------------------------------------------ */
?>
<?php get_header(); ?>
<div class="ef-inner clearfix">
	<?php _sg('Portfolio')->eText(); ?>
	<?php
		$prc = _sg('Portfolio')->getRequiredCategories();
		$args = array(
			'post_type' => 'portfolio',
			'posts_per_page' => -1,
		);
		if (!empty($prc)) $args['post__in'] = get_objects_in_term($prc, 'portfolio_category');

		query_posts($args);
	?>
	<?php if (have_posts()) { ?>
		<?php
			$tags = get_terms('portfolio_category');
			$cats = array();

			foreach ($tags as $tag) {
				if (empty($prc)) {
					$cats[$tag->term_id] = $tag->name;
				} elseif (in_array($tag->term_id, $prc)) {
					$cats[$tag->term_id] = $tag->name;
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
		<div id="ef-portfolio" class="<?php echo (_sg('Portfolio')->getFilter() == 'filter') ? 'ef-portfolio ' : ''; ?>clearfix bottom-1_2em">
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
		echo sg_message(__('Portfolio is empty', SG_TDN));
	} ?>
</div>
<?php get_footer(); ?>