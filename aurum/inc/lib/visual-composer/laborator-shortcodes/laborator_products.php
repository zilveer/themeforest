<?php
/**
 *	Products Shortcode for Visual Composer
 *
 *	Laborator.co
 *	www.laborator.co
 */


class WPBakeryShortCode_laborator_products extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		global $products_columns, $woocommerce_loop;

		if( function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
		}
		
		extract(shortcode_atts(array(
			'products_query' => '',
			'product_types_to_show' => '',
			'columns' => '',
			'el_class' => '',
			'css' => '',
		), $atts));


		$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'lab_wpb_products laborator-woocommerce woocommerce wpb_content_element '.$el_class.vc_shortcode_custom_css_class($css, ' '), $this->settings['base']);

		if ( ! $products_query ) {
			$products_query .= '|post_type:product';
		}
		
		list($args, $products_query) = vc_build_loop_query($products_query);
		
		# Show Featured Products Only
		if($product_types_to_show == 'only_featured')
		{
			$args['meta_key'] = '_featured';
			$args['meta_value'] = 'yes';

			$products_query = new WP_Query($args);
		}
		else
		# Show Products on Sale Only
		if($product_types_to_show == 'only_on_sale')
		{
			$args['meta_query']= array(
				'relation' => 'OR',
				array(
					'key'           => '_sale_price',
					'value'         => 0,
					'compare'       => '>',
					'type'          => 'numeric'
				),
				array(
					'key'           => '_min_variation_sale_price',
					'value'         => 0,
					'compare'       => '>',
					'type'          => 'numeric'
				)
			);

			$products_query = new WP_Query($args);
		}

		if (isset($woocommerce_loop))
			$woocommerce_loop['loop'] = 0;

		ob_start();

		$products_columns = $columns;
		?>
		<div class="<?php echo $css_class; ?>">

			<div class="products">
			<?php if ( $products_query->have_posts() ) : ?>

				<?php while ( $products_query->have_posts() ) : $products_query->the_post(); ?>
				
					<?php
						$product = wc_get_product( $products_query->post );
						if( ! $product->is_visible() ) continue;
					?>

					<?php wc_get_template_part( 'content', 'product' ); ?>


				<?php endwhile; // end of the loop. ?>
				
				<?php wp_reset_postdata(); ?>

			<?php endif; ?>
			</div>

		</div>
		<?php

		$products_columns = null;


		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}
}

// Shortcode Options
$opts = array(
	"name"		=> __("Products", 'lab_composer' ),
	"description" => __('Display shop products on custom query.', 'lab_composer' ),
	"base"		=> "laborator_products",
	"class"		=> "vc_laborator_products",
	"icon"		=> "icon-lab-products",
	"controls"	=> "full",
	"category"  => __('Laborator', 'lab_composer' ),
	"params"	=> array(


		array(
			"type" => "loop",
			"heading" => __("Products Query", 'lab_composer' ),
			"param_name" => "products_query",
			'settings' => array(
				'size' => array('hidden' => false, 'value' => SHOP_COLUMNS * 2),
				'order_by' => array('value' => 'date'),
				'post_type' => array('value' => 'product', 'hidden' => false)
			),
			"description" => __("Create WordPress loop, to populate products from your site.", 'lab_composer' )
		),

		array(
			"type" => "dropdown",
			"heading" => __("Filter Products by Type", TD),
			"param_name" => "product_types_to_show",
			"value" => array(
				"Show all types of products from the above query"  => '',
				"Show only featured products from the above query."  => 'only_featured',
				"Show only products on sale from the above query."  => 'only_on_sale',
			),
			"description" => __("Based on layout columns you use, select number of columns to wrap the product.", TD)
		),

		array(
			"type" => "dropdown",
			"heading" => __("Columns", 'lab_composer' ),
			"param_name" => "columns",
			"std" => '4',
			"value" => array(
				"6 columns per row" => 6,
				"5 columns per row" => 5,
				"4 columns per row" => 4,
				"3 columns per row" => 3,
				"2 columns per row" => 2,
				"1 column per row"  => 1,
			),
			"description" => __("Based on layout columns you use, select when the product items will be cleared to new row.", 'lab_composer' )
		),

		array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'lab_composer' ),
			"param_name" => "el_class",
			"value" => "",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'lab_composer' )
		),

		array(
			"type" => "css_editor",
			"heading" => __('Css', 'lab_composer' ),
			"param_name" => "css",
			"group" => __('Design options', 'lab_composer' )
		)
	)
);

// Add & init the shortcode
vc_map($opts);