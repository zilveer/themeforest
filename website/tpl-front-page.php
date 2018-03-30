<?php
/**
 * @template name: Front page
 * @package        WordPress
 * @subpackage     Website
 * @since          1.0
 */

get_header();
get_template_part('slider', 'front-page');
get_template_part('breadcrumbs', 'front-page');

global $wp_query, $more;

$sidebar = Website::getSidebarName();

foreach (Website::to_('front_page/area')->toArray() as $area => $content) {

	if ($sidebar) {
		switch ($area) {
			case 'c':
				printf('<section id="content" class="%s">', Website::getContentClass());
				break;
			case 'f':
				echo '</section>';
				get_sidebar();
				echo '<div class="clear-this"></div>';
				break;
		}
	}

	switch ($content) {

		// Notice box
		case 'box':
			extract(Website::to_('front_page/box')->toArray());
			$id = md5($area.$title.$text.\Drone\Func::boolToString($close));
			?>
			<section id="optional-box-<?php echo $id; ?>" class="box"<?php if ($close) print ' data-expires="365"'; ?>>
				<h1><?php echo $title; ?></h1>
				<p><?php echo do_shortcode(\Drone\Func::stringToHTML($text, false)); ?></p>
			</section>
			<?php
			break;

		// Featured columns
		case 'columns':
			$count = Website::to('front_page/columns/count');
			$classes = array('one', 'two', 'three', 'four');
			$columns = array();
			for ($i = 0; $i < $count; $i++) {
				extract(Website::to_('front_page/columns/column/'.$i)->toArray());
				$text = \Drone\Func::stringToHTML($text, false);
				if ($more && $link) {
					$text .= sprintf(' <a href="%s" class="more">%s</a>', $link, $more);
				}
				if ($icon) {
					if (is_numeric($icon)) {
						$src = ($img = wp_get_attachment_image_src($icon, 'full')) !== false ? $img[0] : '';
					} else {
						$src = Website::getInstance()->template_uri.'/data/img/icons/32/'.$icon.'.png';
					}
					$icon = $src ? sprintf('<img src="%s" alt="%s" class="icon" width="32" height="32">', $src, $icon) : '';
					// todo: uzyc imageHTML/URI
				}
				$columns[] = sprintf(
					'<li class="column">'.
						'%s'.
						'<h1>%s</h1><p>%s</p>'.
					'</li>',
					$icon, $title, do_shortcode($text)
				);
			}
			?>
			<section class="columns <?php echo $classes[$count-1]; if (Website::to('front_page/columns/hide_mobile')) echo ' hide-lte-mobile'; ?> clear">
				<ul>
					<?php echo implode('', $columns); ?>
				</ul>
			</section>
			<?php
			break;

		// Featured content
		case 'featured':
			extract(Website::to_('front_page/featured')->toArray());
			$posts = array_merge($posts, $pages);
			shuffle($posts);
			$posts = array_slice($posts, 0, $count);
			query_posts(array(
				'post_type'      => array('post', 'page'),
				'post_status'    => 'publish',
				'post__in'       => empty($posts) ? array(0) : $posts,
				'posts_per_page' => -1,
				'orderby'        => $orderby,
				'order'          => $order
			));
			$more = 0;
			get_template_part('loop', 'front-page');
			break;

		// Posts list
		case 'posts':
			extract(Website::to_('front_page/posts')->toArray());
			$query = array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => $count,
				'orderby'        => $orderby,
				'order'          => $order
			);
			if ($filter['enabled']) {
				if (empty($filter['categories'])) {
					continue;
				}
				$query['category__in'] = $filter['categories'];
			}
			if ($exclude_previous) {
				$query['post__not_in'] = Website::getInstance()->posts_stack;
			}
			query_posts($query);
			$wp_query->is_home    = false;
			$wp_query->is_archive = false;
			$more = 0;
			get_template_part('loop', 'front-page');
			if ($goto['visible']) {
				$blog_url = get_option('show_on_front') == 'page' ? get_permalink(get_option('page_for_posts')) : get_home_url('/');
				printf('<div class="pagination"><a href="%s" class="next">%s</a></div>', $blog_url, $goto['text']);
			}
			break;

	}

}

get_footer();