<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */
?>

<?php
	get_header();
	get_template_part('breadcrumbs', 'portfolio-item');
?>

<section id="content">

	<?php get_template_part('loop', 'gallery'); ?>

	<?php if (have_posts()): ?>

		<?php
			the_post();
			extract(Website::po_('options')->toArray(), EXTR_PREFIX_ALL, 'gallery');
			$paged = get_query_var('page') ? get_query_var('page') : 1;
			$gallery_query = new WP_Query(array(
				'post_parent'    => get_the_ID(),
				'post_type'      => 'attachment',
				'post_status'    => 'inherit',
				'posts_per_page' => $gallery_pagination ? $gallery_per_page : -1,
				'paged'          => $paged,
				'orderby'        => $gallery_orderby,
				'order'          => strtoupper($gallery_order)
			));
		?>

		<section class="items <?php echo $gallery_size; ?> clear">

			<?php while ($gallery_query->have_posts()): ?>

				<?php $gallery_query->the_post(); ?>

				<article id="item-<?php the_ID(); ?>" class="item-<?php the_ID(); ?> item">
					<div class="image">
						<a href="<?php $img = wp_get_attachment_image_src(get_the_ID(), 'full'); echo $img[0]; ?>" class="fancybox" rel="gallery" title="<?php echo esc_attr(get_the_excerpt()); ?>">
							<?php echo wp_get_attachment_image(get_the_ID(), 'item-'.$gallery_size); ?>
							<span class="hover"></span>
						</a>
					</div>
				</article>

			<?php endwhile; ?>

			<?php wp_reset_query(); ?>

		</section>

		<?php
			if ($gallery_pagination) {
				$pagination = \Drone\Func::wpPaginateLinks(array(
					'prev_next' => Website::to('gallery/pagination') == 'numbers_navigation',
					'prev_text' => __('previous', 'website'),
					'next_text' => __('next', 'website')
				), $gallery_query);
				if ($pagination) {
					echo "<div class=\"pagination\">{$pagination}</div>";
				}
			}
		?>

	<?php endif; ?>

</section>

<?php get_footer(); ?>