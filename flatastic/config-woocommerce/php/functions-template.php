<?php

/* ---------------------------------------------------------------------- */
/*	Template: Woocommerce
/* ---------------------------------------------------------------------- */

if ( ! function_exists( 'mad_wc_get_template' ) ) {
	function mad_wc_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
		if ( function_exists( 'wc_get_template' ) ) {
			wc_get_template( $template_name, $args, $template_path, $default_path );
		} else {
			woocommerce_get_template( $template_name, $args, $template_path, $default_path );
		}
	}
}

if ( ! function_exists( 'mad_woocommerce_product_custom_tab' ) ) {
	function mad_woocommerce_product_custom_tab($key) {
		global $post;

		$mad_title_product_tab = $mad_content_product_tab = '';
		$custom_tabs_array = get_post_meta($post->ID, 'mad_custom_tabs', true);
		$custom_tab = $custom_tabs_array[$key];

		extract($custom_tab);

		if ($mad_title_product_tab != '') {

			preg_match("!\[embed.+?\]|\[video.+?\]!", $mad_content_product_tab, $match_video);
			preg_match("!\[(?:)?gallery.+?\]!", $mad_content_product_tab, $match_gallery);
			$zoom_image = mad_custom_get_option('zoom_image', '');

			if (!empty($match_video)) {

				global $wp_embed;

				$video = $match_video[0];

				$before = "<div class='image-overlay ". esc_attr($zoom_image) ."'>";
					$before .= "<div class='entry-media photoframe'>";
						$before .= $wp_embed->run_shortcode($video);
					$before .= "</div>";
				$before .= "</div>";
				$before = apply_filters('the_content', $before);
				echo $before;

			} elseif (!empty($match_gallery)) {

				$gallery = $match_gallery[0];
				if (strpos($gallery, 'vc_') === false) {
					$gallery = str_replace("gallery", 'mad_gallery image_size="848*370"', $gallery);
				}
				$before = apply_filters('the_content', $gallery);
				echo do_shortcode($before);

			} else {
				echo do_shortcode($mad_content_product_tab);
			}

		}

	}
}

if (!function_exists('mad_woocommerce_show_product_loop_out_of_sale_flash')) {
	function mad_woocommerce_show_product_loop_out_of_sale_flash() {
		mad_wc_get_template( 'loop/out-of-stock-flash.php' );
	}
}

if (!function_exists('mad_woocommerce_shop_link_products')) {
	function mad_woocommerce_shop_link_products() {
		mad_wc_get_template( 'single-product/link-products.php' );
	}
}

if (!function_exists('mad_woocommerce_single_variation_add_to_cart_button')) {
	function mad_woocommerce_single_variation_add_to_cart_button() {
		global $product;
		?>
		<div class="variations_button">

			<table class="description-table">
				<tbody>
				<tr>
					<td><?php _e('Quantity:', 'flatastic'); ?></td>
					<td class="product-quantity">
						<?php woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) ); ?>
					</td>
				</tr>
				</tbody>
			</table><!--/ .description-table-->

			<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

			<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

			<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->id ); ?>" />
			<input type="hidden" name="product_id" value="<?php echo absint( $product->id ); ?>" />
			<input type="hidden" name="variation_id" class="variation_id" value="" />
		</div>
		<?php
	}
}

if (!function_exists('mad_overwrite_catalog_ordering')) {

	function mad_overwrite_catalog_ordering($args) {

		global $mad_config;

//		if (mad_custom_get_option('products_filter')) return $args;

		$keys = array('product_order', 'product_count', 'product_sort');
		if (empty($mad_config['woocommerce'])) $mad_config['woocommerce'] = array();

		foreach ($keys as $key) {
			if (isset($_GET[$key]) ) {
				$_SESSION['mad_woocommerce'][$key] = esc_attr($_GET[$key]);
			}
			if (isset($_SESSION['mad_woocommerce'][$key]) ) {
				$mad_config['woocommerce'][$key] = $_SESSION['mad_woocommerce'][$key];
			}
		}

		if(isset($_GET['product_order']) && !isset($_GET['product_sort']) && isset($_SESSION['mad_woocommerce']['product_sort'])) {
			unset($_SESSION['mad_woocommerce']['product_sort'], $mad_config['woocommerce']['product_sort']);
		}

		if (!isset($_GET['product_count'])) {
			unset($_SESSION['mad_woocommerce']['product_count']);
		}

		extract($mad_config['woocommerce']);

		if (isset($product_order) && !empty($product_order)) {
			switch ( $product_order ) {
				case 'title' : $orderby = 'title'; $order = 'asc'; $meta_key = ''; break;
				case 'price' : $orderby = 'meta_value_num'; $order = 'asc'; $meta_key = '_price'; break;
				case 'date'  : $orderby = 'date'; $order = 'desc'; $meta_key = '';  break;
				case 'popularity' : $orderby = 'meta_value_num'; $order = 'desc'; $meta_key = 'total_sales'; break;
				case 'menu_order':
				default : $orderby = 'menu_order title'; $order = 'asc'; $meta_key = ''; break;
			}
		}

		if(!empty($product_count) && is_numeric($product_count)) {
			$mad_config['shop_overview_product_count'] = (int) $product_count;
		}

		if (!empty($product_sort)) {
			switch ( $product_sort ) {
				case 'desc' : $order = 'desc'; break;
				case 'asc' : $order = 'asc'; break;
				default : $order = 'asc'; break;
			}
		}

		if (isset($orderby)) $args['orderby'] = $orderby;
		if (isset($order)) 	$args['order'] = $order;

		if (!empty($meta_key)) {
			$args['meta_key'] = $meta_key;
		}

		$mad_config['woocommerce']['product_sort'] = $args['order'];

		return $args;
	}

	add_action( 'woocommerce_get_catalog_ordering_args', 'mad_overwrite_catalog_ordering');

}

if (!function_exists('mad_woocommerce_output_product_data_tabs')) {
	function mad_woocommerce_output_product_data_tabs() {
		echo '<div class="clear"></div>';
		woocommerce_output_product_data_tabs();
	}
}

if (!function_exists('mad_woocommerce_output_related_products')) {
	function mad_woocommerce_output_related_products() {
		global $mad_config;

		$mad_config['shop_single_column'] = ($mad_config['sidebar_position'] != 'no_sidebar') ? 3 : 4; // columns for related products
		$mad_config['shop_single_column_items'] = mad_custom_get_option('shop_single_column_items'); // number of items for related products

		ob_start();

		woocommerce_related_products(
			array(
				'columns' => $mad_config['shop_single_column'],
				'posts_per_page' => $mad_config['shop_single_column_items']
			)
		);

		$content = ob_get_clean(); ?>

		<?php if ($content): ?>

			<div class="products-container view-grid" data-columns="<?php echo esc_attr($mad_config['shop_single_column']) ?>">
				<?php echo $content; ?>
			</div><!--/ .products-container-->

		<?php endif;
	}
}


if (!function_exists('flatastic_dropdown_categories')) {

	function flatastic_dropdown_categories( $args = '' ) {
		$defaults = array(
			'show_option_all' => '', 'show_option_none' => '',
			'orderby' => 'id', 'order' => 'ASC',
			'show_count' => 0,
			'hide_empty' => 1, 'child_of' => 0,
			'exclude' => '', 'echo' => 1,
			'selected' => 0, 'hierarchical' => 0,
			'name' => 'cat', 'id' => '',
			'class' => 'postform', 'depth' => 0,
			'tab_index' => 0, 'taxonomy' => 'category',
			'hide_if_empty' => false, 'option_none_value' => -1,
			'value_field' => 'term_id',
		);

		$defaults['selected'] = ( is_category() ) ? get_query_var( 'cat' ) : 0;

		// Back compat.
		if ( isset( $args['type'] ) && 'link' == $args['type'] ) {
			/* translators: 1: "type => link", 2: "taxonomy => link_category" alternative */
			_deprecated_argument( __FUNCTION__, '3.0',
				sprintf( __( '%1$s is deprecated. Use %2$s instead.' ),
					'<code>type => link</code>',
					'<code>taxonomy => link_category</code>'
				)
			);
			$args['taxonomy'] = 'link_category';
		}

		$r = wp_parse_args( $args, $defaults );
		$option_none_value = $r['option_none_value'];

		if ( ! isset( $r['pad_counts'] ) && $r['show_count'] && $r['hierarchical'] ) {
			$r['pad_counts'] = true;
		}

		$tab_index = $r['tab_index'];

		$tab_index_attribute = '';
		if ( (int) $tab_index > 0 ) {
			$tab_index_attribute = " tabindex=\"$tab_index\"";
		}

		$get_terms_args = $r;
		unset( $get_terms_args['name'] );
		$categories = get_terms( array(
			'taxonomy' => $r['taxonomy']
		), $get_terms_args );

		$name = esc_attr( $r['name'] );
		$class = esc_attr( $r['class'] );
		$id = $r['id'] ? esc_attr( $r['id'] ) : $name;

		if ( ! $r['hide_if_empty'] || ! empty( $categories ) ) {
			$output = "<select name='$name' id='$id' class='$class' $tab_index_attribute>\n";
		} else {
			$output = '';
		}
		if ( empty( $categories ) && ! $r['hide_if_empty'] && ! empty( $r['show_option_none'] ) ) {
			$show_option_none = apply_filters( 'list_cats', $r['show_option_none'] );
			$output .= "\t<option value='" . esc_attr( $option_none_value ) . "' selected='selected'>$show_option_none</option>\n";
		}

		if ( ! empty( $categories ) ) {

			if ( $r['show_option_all'] ) {

				/** This filter is documented in wp-includes/category-template.php */
				$show_option_all = apply_filters( 'list_cats', $r['show_option_all'] );
				$selected = ( '0' === strval($r['selected']) ) ? " selected='selected'" : '';
				$output .= "\t<option value='&'$selected>$show_option_all</option>\n";
			}

			if ( $r['show_option_none'] ) {

				/** This filter is documented in wp-includes/category-template.php */
				$show_option_none = apply_filters( 'list_cats', $r['show_option_none'] );
				$selected = selected( $option_none_value, $r['selected'], false );
				$output .= "\t<option value='" . esc_attr( $option_none_value ) . "'$selected>$show_option_none</option>\n";
			}

			if ( $r['hierarchical'] ) {
				$depth = $r['depth'];  // Walk the full depth.
			} else {
				$depth = -1; // Flat.
			}
			$output .= walk_category_dropdown_tree( $categories, $depth, $r );
		}

		if ( ! $r['hide_if_empty'] || ! empty( $categories ) ) {
			$output .= "</select>\n";
		}

		$output = apply_filters( 'wp_dropdown_cats', $output, $r );

		if ( $r['echo'] ) {
			echo $output;
		}
		return $output;
	}

}