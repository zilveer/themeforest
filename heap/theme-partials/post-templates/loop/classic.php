<?php
/**
 * Loop Template Classic Full Width
 */

global $wp_query;

$has_sidebar = false;
if (heap_option('blog_show_sidebar')) {
	$has_sidebar = true;
}

//lets figure out the classes needed for the content wrapper
$classes = 'blog-archive--classic';
if ($has_sidebar) $classes .=' has-sidebar';

//infinite scrolling
$mosaic_classes = '';
if (heap_option('blog_infinitescroll')) {
	$mosaic_classes .= ' infinite_scroll';
	$classes .=' inf_scroll';

	if (heap_option('blog_infinitescroll_show_button')) {
		$mosaic_classes .= ' infinite_scroll_with_button';
	}
} ?>

<div class="page-content  blog-archive <?php echo $classes ?>">
	<?php
	if ($has_sidebar) echo '<div class="page-content__wrapper">';
	if (heap_option('blog_show_breadcrumb')) heap_breadcrumb();
	heap_the_archive_title();

	//first the sticky posts
	// get current page we are on. If not set we can assume we are on page 1.
	$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
	if ( is_front_page() && $current_page == 1) {
		$sticky = get_option('sticky_posts');
		// check if there are any
		if (!empty($sticky)) {
			// optional: sort the newest IDs first
			rsort($sticky);
			// override the query
			$args = array(
				'post__in' => $sticky
			);
			query_posts($args);
			// the loop
			while (have_posts()) : the_post();
				get_template_part('theme-partials/post-templates/loop-content/classic');
			endwhile;

			wp_reset_postdata();
			wp_reset_query();
		}
	}

	if ( have_posts() ):

		if (heap_option('blog_infinitescroll')): ?>
		<div class="classic-infinitescroll-wrapper <?php echo $mosaic_classes ?>" data-maxpages="<?php echo $wp_query->max_num_pages ?>">
		<?php endif;
		while ( have_posts() ) : the_post();
			get_template_part( 'theme-partials/post-templates/loop-content/classic' );
		endwhile;

		if (heap_option('blog_infinitescroll')): ?>
		</div>
		<?php endif; ?>
	<!-- Pagination -->
	<?php 
	echo heap_pagination();
	if (heap_option('blog_infinitescroll') && heap_option('blog_infinitescroll_show_button') && ($wp_query->max_num_pages > 1)): ?>
		<div class="load-more__container">
			<button class="load-more__button"><?php echo heap_option('blog_infinitescroll_button_text') ?></button>
		</div>
	<?php endif;
	else:
		get_template_part( 'no-results' );
	endif; // end if have_posts()
	if ($has_sidebar) echo '</div><!-- .page-content__wrapper -->'; ?>
</div><!-- .page-content -->
<?php if ($has_sidebar) get_template_part('sidebar'); ?>