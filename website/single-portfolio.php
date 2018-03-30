<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */
?>

<?php
	get_header();
	get_template_part('breadcrumbs', 'portfolio');
?>

<section id="content">

	<?php get_template_part('loop', 'portfolio'); ?>

	<?php if (have_posts()): ?>

		<?php
			the_post();
			extract(Website::po_('content')->toArray(), EXTR_PREFIX_ALL, 'portfolio');
			extract(Website::po_('options')->toArray(), EXTR_PREFIX_ALL, 'portfolio');
			$paged = get_query_var('page') ? get_query_var('page') : 1;
			$portfolio_content = Website::po_('options/content');
			$portfolio_query = new WP_Query(array(
				'post_type'      => 'portfolio-item',
				'post_status'    => 'publish',
				'post__in'       => empty($portfolio_items) ? array(0) : $portfolio_items,
				'posts_per_page' => $portfolio_pagination ? $portfolio_per_page : -1,
				'paged'          => $paged,
				'orderby'        => $portfolio_orderby,
				'order'          => strtoupper($portfolio_order),
			));
		?>

		<?php if ($portfolio_filter): ?>

			<?php
				$filter = array();
				while ($portfolio_query->have_posts()) {
					$portfolio_query->the_post();
					$terms = get_the_terms(get_the_ID(), 'portfolio-item-'.$portfolio_filter);
					if ($terms !== false) {
						foreach ($terms as $term) {
							$filter[$term->slug] = $term->name;
						}
					}
				}
				asort($filter);
				$portfolio_query->rewind_posts();
			?>

			<?php if (!empty($filter)): ?>
				<section class="filter">
					<a href="#" title="<?php esc_attr_e('All', 'website'); ?>"><?php _e('All', 'website'); ?></a>
					<?php
						foreach ($filter as $slug => $name) {
							printf('<a href="#%1$s" title="%2$s">%2$s</a> ', $slug, $name);
						}
					?>
				</section>
			<?php endif; ?>

		<?php endif; ?>

		<section class="items <?php echo $portfolio_size; ?> clear">

			<?php while ($portfolio_query->have_posts()): ?>

				<?php
					$portfolio_query->the_post();
					$categories = array();
					if ($portfolio_filter) {
						$terms = get_the_terms(get_the_ID(), 'portfolio-item-'.$portfolio_filter);
						if ($terms !== false) {
							foreach ($terms as $term) {
								$categories[] = $term->slug;
							}
						}
					}
					if (Website::po('format/format') == 'link') {
						$url = Website::po('link/url') or $url = get_permalink();
					} else {
						$url = get_permalink();
					}
				?>
				<article id="item-<?php the_ID(); ?>" class="item-<?php the_ID(); ?> item" data-category="<?php echo implode(' ', $categories); ?>">
					<?php if (has_post_thumbnail()): ?>
						<div class="image">
							<a href="<?php echo $url; ?>" title="<?php the_title_attribute(); ?>">
								<?php the_post_thumbnail('item-'.$portfolio_size); ?>
								<span class="hover"></span>
							</a>
						</div>
					<?php endif; ?>
					<?php $_portfolio_content = $portfolio_content->value; ?>
					<?php if (!empty($_portfolio_content)): ?>
						<section class="main">
							<?php if ($portfolio_content->value('title')): ?>
								<h1 class="title">
									<a href="<?php echo $url; ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
								</h1>
							<?php endif; ?>
							<div class="content">
								<?php if ($portfolio_content->value('excerpt') && has_excerpt()): ?>
									<?php the_excerpt(); ?>
								<?php endif; ?>
								<?php
									if ($portfolio_content->value('tags')) {
										$terms = get_the_terms(get_the_ID(), 'portfolio-item-tag');
										if ($terms !== false) {
											$tags = array();
											foreach ($terms as $term) {
												$tags[] = sprintf('<span>%s</span>', $term->name);
											}
											printf('<p class="tags">%s</p>', implode(' ', $tags));
										}
									}
								?>
							</div>
						</section>
					<?php endif; ?>
				</article>

			<?php endwhile; ?>

			<?php wp_reset_query(); ?>

		</section>

		<?php
			if ($portfolio_pagination) {
				$pagination = \Drone\Func::wpPaginateLinks(array(
					'prev_next' => Website::to('portfolio/pagination') == 'numbers_navigation',
					'prev_text' => __('previous', 'website'),
					'next_text' => __('next', 'website')
				), $portfolio_query);
				if ($pagination) {
					echo "<div class=\"pagination\">{$pagination}</div>";
				}
			}
		?>

	<?php endif; ?>

</section>

<?php get_footer(); ?>