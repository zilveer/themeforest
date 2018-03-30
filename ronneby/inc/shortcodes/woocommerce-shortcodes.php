<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
 * Best selling products
 */
/* TODO: Remove 'sb_best_selling_products' shortcode when theme is ready */
function sb_best_selling_products($atts, $content = null) {
	global $woocommerce_loop;

	extract(shortcode_atts(array('per_page' => '12', 'columns' => 4, 'show_title' => false), $atts));

	$show_title = (bool) $show_title;

	ob_start();

	best_selling_products($per_page, $columns, $show_title);

	return ob_get_clean();
}

function best_selling_products($posts_per_page = 12, $columns = 4, $show_title = false) {
	woocommerce_get_template('best_selling_products.php', array(
		'posts_per_page' => $posts_per_page,
		'columns' => $columns,
		'show_title' => $show_title
	));
}

add_shortcode('sb_best_selling_products', 'sb_best_selling_products');

/*
 * Product categories carousel
 */

function dfd_wc_product_categories_carousel($atts, $content=null) {
	if (!is_plugin_active('woocommerce/woocommerce.php')) {
		return false;
	}
	
	woocommerce_get_template('product-categories-carousel.php');
}

class DFD_WC_Product_Categories_Carousel_Walker extends Walker {
	
	var $tree_type = 'product_cat';
	var $db_fields = array ( 'parent' => 'parent', 'id' => 'term_id', 'slug' => 'slug' );
	
	public function start_lvl( &$output, $depth = 0, $args = array() ) {}
	
	public function end_lvl( &$output, $depth = 0, $args = array() ) {}
	
	public function start_el(&$output, $cat, $depth = 0, $args = array(), $current_object_id = 0) {
		$thumbnail_id = get_woocommerce_term_meta($cat->term_id, 'thumbnail_id', true);
		
		if ( $thumbnail_id ) {
			$image_buf = wp_get_attachment_image_src($thumbnail_id, 'full');
			if (!empty($image_buf)) {
				$image_url = $image_buf[0];
			}
		}
		
		$output .= '<div class="cat-item cat-item-' . $cat->term_id;
		if ($cat->term_id == $args['current_category']) {
			$output .= ' cat-item-current';
		}
		$output .= '"><div class="cover">';
		$output .= '<div class="img-wrap"><a href="' . get_term_link( (int) $cat->term_id, 'product_cat' ) . '">';
		if (!empty($image_url)) {
			$image = dfd_aq_resize($image_url, 300, 230, true, true, true);
			if(!$image) {
				$image = $image_url;
			}
		} else {
			$image = false;
		}
		if ( $image ) {
			$output .= '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $cat->name ) . '" />';
		} else {
			$output .= wc_placeholder_img(array(300, 230));
		}
		
		$output .= '</a></div>';
		$output .= '<div class="cat-meta">';
		$output .= '<div class="box-name"><a href="' . get_term_link( (int) $cat->term_id, 'product_cat' ) . '">' . $cat->name . '</a></div>';
		$output .= '<div class="dopinfo">'.$cat->count.' '.__('items', 'dfd').'</div>';
		$output .= '</div>';
		$output .= '</div>';
	}
	
	public function end_el(&$output, $cat, $depth = 0, $args = array()) {
		$output .= "</div>\n";
	}
	
	public function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		if ( ! $element || 0 === $element->count ) {
			return;
		}
		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

add_shortcode('wc_product_categories_carousel', 'dfd_wc_product_categories_carousel');
