<?php

/**
 * Blog shortcode handler
 *
 * @package wpv
 * @subpackage editor
 */

/**
 * class WPV_Blog
 */
class WPV_Blog {
	/**
	 * Register the shortcode
	 */
	public function __construct() {
		add_shortcode('blog', array(__CLASS__, 'shortcode'));
	}

	/**
	 * Blog shortcode callback
	 *
	 * @param  array  $atts    shortcode attributes
	 * @param  string $content shortcode content
	 * @param  string $code    shortcode name
	 * @return string          output html
	 */
	public static function shortcode($atts, $content = null, $code = 'blog') {
		global $wp_filter;

		extract(shortcode_atts(array(
			'count' => 3,
			'column' => 1,
			'cat' => '',
			'posts' => '',
			'image' => 'true',
			'show_content' => false,
			'nopaging' => true,
			'paged' => '',
			'width' => 'full',
			'layout' => 'normal',
			'post__not_in' => '',
		), $atts));

		$show_content = wpv_sanitize_bool($show_content);
		$nopaging = wpv_sanitize_bool($nopaging);
		$news = in_array($layout, array('scroll-x', 'small', 'masonry'));
		$scrollable = $news && $layout === 'scroll-x';

		$query = array(
			'posts_per_page' => (int)$count,
			'post_type'=>'post',
		);

		if($paged)
			$query['paged'] = $paged;

		if(!empty($cat)) {
			$query['category__in'] = is_array($cat) ? $cat : explode(',', $cat);
		}

		if($posts)
			$query['post__in'] = explode(',',$posts);

		if($nopaging) {
			$query['paged'] = 1;
		} else {
			$query['paged'] = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
		}

		if(!empty($post__not_in))
				$query['post__not_in'] = explode(',',$post__not_in);

		if(!$news)
			$column = 1;

		$called_from_shortcode = true;

		$column = (int)$column;
		if($column > 1) {
			$denominator = array('','', 'half', 'third', 'fourth', 'fifth', 'sixth');

			$width = 'one_'.$denominator[$column];
		}

		ob_start();
		query_posts($query);

		if($scrollable) {
			include locate_template(array('templates/blog-scrollable.php'));
		} else {
			include locate_template(array('loop.php'));
		}

		$output = ob_get_contents();
		ob_end_clean();

		wp_reset_query();
		wp_reset_postdata();

		return $output;
	}

	/**
	 * Returns the number of posts in a list of categories
	 * @param  array $categories array of categories
	 * @return int               number of items
	 */
	public static function in_category($categories) {
		$query = new WP_Query(array(
			'category__in' => $categories,
			'posts_per_page' => -1
		));
		return $query->post_count;
	}
}

new WPV_Blog;
