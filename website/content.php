<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */
?>

<?php $post_format = get_post_format() or $post_format = 'default'; ?>

<?php if (get_post_type() != 'post' || is_single() || !Website::to("format_post/{$post_format}/content/hide")): ?>
	<div class="content clear"><?php
		if (is_search()) {
			$sq = preg_quote(get_search_query(), '/');
			$excerpt = explode('<!-- more-link -->', get_the_excerpt());
			$excerpt[0] = preg_replace("/\b{$sq}\b/i", '<mark class="search">\0</mark>', $excerpt[0]);
			echo '<p>'.implode('', $excerpt).'</p>';
		} else if (is_singular()) {
			the_content(Website::to('post/readmore'));
			$pages = wp_link_pages(array(
				'before' => '',
				'after'  => '',
				'echo'   => false
			));
			if ($pages) {
				printf('<div class="pagination">%s</div>', preg_replace('/ ([0-9]+)/', ' <span class="current">\1</span>', $pages));
			}
		} else {
			switch (Website::to('post/content')) {
				case 'excerpt':
					the_excerpt();
					break;
				case 'excerpt_content':
					if (has_excerpt()) {
						the_excerpt();
						break;
					}
				case 'content':
					the_content(Website::to('post/readmore'));
					break;
			}
		}
	?></div>
<?php endif; ?>