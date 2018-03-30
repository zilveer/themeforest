<?php

	function recent_products1( $atts ) {
		global $woocommerce_loop;

		$atts = shortcode_atts( array(
			'per_page' 	=> '12',
			'columns' 	=> '4',
			'orderby' 	=> 'date',
			'order' 	=> 'desc'
		), $atts );

		$meta_query = WC()->query->get_meta_query();

		$args = array(
			'post_type'				=> 'product',
			'post_status'			=> 'publish',
			'ignore_sticky_posts'	=> 1,
			'posts_per_page' 		=> $atts['per_page'],
			'orderby' 				=> $atts['orderby'],
			'order' 				=> $atts['order'],
			'meta_query' 			=> $meta_query
		);

		ob_start();

		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		$columns = absint( $atts['columns'] );
		$woocommerce_loop['columns'] = $columns;

		if ( $products->have_posts() ) : ?>

			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

		<?php endif;

		wp_reset_postdata();

		return '<div class="woocommerce columns-' . $columns . '">' . ob_get_clean() . '</div>';
	}

//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("WC Products", "themeum"),
		"base" => "recent_products1",
		"description" => __("WC Products", "themeum"),
		"category" => __('Themeum', "themeum"),
		"params" => array(

			array(
				"type" => "textfield",
				"heading" => __("Products Per Page", "themeum"),
				"param_name" => "per_page",
				"value" => "12",
				),

			array(
				"type" => "textfield",
				"heading" => __("Columns", "themeum"),
				"param_name" => "columns"
				),

			)
		));
}
