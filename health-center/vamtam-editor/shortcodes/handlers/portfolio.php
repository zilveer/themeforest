<?php

/**
 * Portfolio shortcode handler
 *
 * @package wpv
 * @subpackage editor
 */

/**
 * class WPV_Portfolio
 */
class WPV_Portfolio {
	/**
	 * Register the shortcode
	 */
	public function __construct() {
		add_shortcode('portfolio', array(__CLASS__, 'shortcode'));
	}

	/**
	 * Portfolio shortcode callback
	 *
	 * @param  array  $atts    shortcode attributes
	 * @param  string $content shortcode content
	 * @param  string $code    shortcode name
	 * @return string          output html
	 */
	public static function shortcode($atts, $content = null, $code = 'portfolio') {
		global $post;

		extract(shortcode_atts(array(
			'column' => 4,
			'cat' => '',
			'ids' => '',
			'max' => 4,
			'height' => 400,
			'title' => 'overlay',
			'desc' => 'false',
			'more' => 'button text',
			'nopaging' => 'false',
			'group' => 'true',
			'layout' => 'static',
			'post__not_in' => '',
			'engine' => 'isotope',
			'class' => '',
			'fancy_page' => false,
		), $atts));

		$moreText = $more;
		$more = !empty($moreText);
		$cat = empty($cat) ?
				array() :
				(is_array($cat) ? $cat : explode(',', $cat));

		$desc = wpv_sanitize_bool($desc);

		// number of columns - get the css class
		$column = intval($column);

		// get the overall portfolio width
		$central_width = wpv_get_central_column_width();

		$column_width = intval($central_width / $column);
		$size = array($central_width, $height);

		// set the width of a column (without blank space)
		if($column > 1)
			$size[0] = round( ($central_width * (1-0.02 * ($column-1))) /$column);

		$sortable = ($layout === 'fit-rows' || $layout === 'masonry') ? $layout : '';
		$paging_preference = !empty($sortable) ? 'paged' : null;

		$scrollable = ($layout === 'scrollable');
		if($scrollable)
			$nopaging = 'true';

		$rel_group = 'portfolio_'.rand(1,1000); //for lightbox group

		$old_column = isset($GLOBALS['wpv_portfolio_column']) ? $GLOBALS['wpv_portfolio_column'] : null;
		$GLOBALS['wpv_portfolio_column'] = $column;

		$query = array(
			'post_type' => 'portfolio',
			'orderby' => array(
				'menu_order' => 'ASC',
				'date' => 'DESC',
			),
			'posts_per_page' => $max,
			'paged' => $nopaging === 'false' ? (
			                ( get_query_var('paged') > 1 ) ?
			                    get_query_var('paged') : (get_query_var('page') ?
			                                                get_query_var('page') : 1)
			                    ) : 1,
		);

		if(!empty($cat) && !empty($cat[0])) {
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'portfolio_category',
					'field' => 'slug',
					'terms' => $cat,
				)
			);
		}

		if($ids && $ids != 'null')
			$query['post__in'] = explode(',',$ids);


		if(!empty($post__not_in))
			$query['post__not_in'] = explode(',',$post__not_in);

		query_posts($query);

		ob_start();

		include(locate_template('templates/portfolio/loop.php'));

		$GLOBALS['wpv_portfolio_column'] = $old_column;

		wp_reset_query();

		return ob_get_clean();
	}

	/**
	 * Returns the number of portfolio items in a list of categories
	 * @param  array $categories array of categories
	 * @return int               number of items
	 */
	public static function in_category($categories) {
		$query = new WP_Query(array(
			'post_type' => 'portfolio',
			'tax_query' => array(
				array(
					'taxonomy' => 'portfolio_category',
					'field' => 'slug',
					'terms' => $categories,
				),
			),
			'posts_per_page' => -1
		));

		return $query->post_count;
	}
}

new WPV_Portfolio;
