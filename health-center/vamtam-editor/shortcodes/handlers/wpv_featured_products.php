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
class WPV_Sc_WooCommerce_Featured {
	/**
	 * Register the shortcode
	 */
	public function __construct() {
		add_shortcode('wpv_featured_products', array(&$this, 'shortcode'));
	}

	/**
	 * Blog shortcode callback
	 *
	 * @param  array  $atts    shortcode attributes
	 * @param  string $content shortcode content
	 * @param  string $code    shortcode name
	 * @return string          output html
	 */
	public function shortcode($atts, $content = null, $code = 'blog') {
		global $woocommerce_loop;

		extract(shortcode_atts(array(
			'per_page' 	=> '12',
			'columns' 	=> '4',
			'orderby' => 'date',
			'order' => 'desc'
		), $atts));

		$args = array(
			'post_type'	=> 'product',
			'post_status' => 'publish',
			'ignore_sticky_posts'	=> 1,
			'posts_per_page' => $per_page,
			'orderby' => $orderby,
			'order' => $order,
			'meta_query' => array(
				array(
					'key' => '_visibility',
					'value' => array('catalog', 'visible'),
					'compare' => 'IN'
				),
				array(
					'key' => '_featured',
					'value' => 'yes'
				)
			)
		);

		ob_start();

		$products = new WP_Query( $args );

		$woocommerce_loop['columns'] = $columns;

		include locate_template(array('templates/woocommerce-scrollable/loop.php'));

		$output = ob_get_clean();

		$products->reset_postdata();
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

new WPV_Sc_WooCommerce_Featured;
