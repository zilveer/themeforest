<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */

// Posts
if (have_posts()) {

	// Posts loop
	while (have_posts()) {

		// Post
		the_post();
		$post_type = get_post_type();
		switch ($post_type) {
			case 'post':
				$post_format = get_post_format();
				$post_class  = $post_format or $post_class = 'default';
				break;
			case 'portfolio-item':
				$post_format = Website::po('format/format');
				$post_class  = 'page';
				break;
			case 'portfolio':
				$post_format = null;
				$post_class  = 'page';
				break;
			case 'gallery':
				$post_format = null;
				$post_class  = 'page';
				break;
			case 'attachment':
				$post_format = null;
				$post_class  = 'page';
				break;
			default:
				$post_type   = 'page';
				$post_format = null;
				$post_class  = 'page';
		}

		// Post article
		printf('<article id="post-%s" class="%s">', get_the_ID(), implode(' ', get_post_class(array('post', 'hentry', $post_class))));
		get_template_part('main-'.$post_type, $post_format);
		if (is_singular()) {
			get_template_part('about', 'index');
		}
		if (!is_search() && !is_attachment()) {
			get_template_part('social', 'index');
			get_template_part('meta', 'index');
		}
		echo '</article>';

		// Navigation
		if (is_single() && Website::to(get_post_type().'/navigation')) {
			echo '<div class="pagination">';
			previous_post_link('%link');
			next_post_link('%link');
			echo '</div>';
		}

		// Comments
		if (Website::to(array(get_post_type().'/comments'), 'page/comments')) {
			comments_template();
		}

	}

	// Pagination
	if (is_home() || is_archive() || is_search()) {
		$pagination = \Drone\Func::wpPaginateLinks(array(
			'prev_next' => Website::to('post/pagination') == 'numbers_navigation',
			'prev_text' => __('next posts', 'website'),
			'next_text' => __('previous posts', 'website')
		));
		if ($pagination) {
			echo "<div class=\"pagination\">{$pagination}</div>";
		}
	}

}

// 404
else if (is_404()) {
	?>
	<article class="post page">
		<section class="main">
			<?php if (Website::to('not_found/title')): ?>
				<h1 class="title"><?php echo Website::to('not_found/title'); ?></h1>
			<?php endif; ?>
			<div class="content clear"><?php echo \Drone\Func::wpProcessContent(Website::to('not_found/content')); ?></div>
		</section>
	</article>
	<?php
}

// No posts
else {
	?>
	<article class="post page">
		<section class="main">
			<h1 class="title"><?php
				if (is_search()) {
					_e('Sorry, but nothing matched your search criteria.', 'website');
				} else {
					_e('Sorry, but no posts were found.', 'website');
				}
			?></h1>
		</section>
	</article>
	<?php
}

wp_reset_query();