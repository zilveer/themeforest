<?php
/**
 * Plumtree Vendor Products
 *
 * List Vendor products.
 *
 * @author themes.zone
 * @package Plum tree
 * @subpackage Widgets
 * @since 0.01
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'widgets_init', create_function( '', 'register_widget( "pt_vendor_products_widget" );' ) );

class pt_vendor_products_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'pt_vendor_products_widget', // Base ID
			__('PT Vendor Products', 'plumtree'), // Name
			array('description' => __( "Plum Tree special widget. Outputs list of products based on current vendor page.", 'plumtree' ), )
		);
	}

	public function form($instance) {
		$defaults = array(
			'title' => 'Products by Vendor',
			'products-qty' => 3,
			'show' => 'recent',
			'show-vendor-title' => false,
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title: ', 'plumtree' ) ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
            <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('show-vendor-title'); ?>" name="<?php echo $this->get_field_name('show-vendor-title'); ?>"<?php checked( (bool) $instance['show-vendor-title'] ); ?> />
            <label for="<?php echo $this->get_field_id('show-vendor-title'); ?>"><?php _e( 'Add Vendor Shop name to the title?', 'plumtree' ); ?></label>
        </p>
		<p>
			<label for="<?php echo $this->get_field_id('products-qty'); ?>"><?php _e( 'How many products to display: ', 'plumtree' ) ?></label>
			<input size="3" id="<?php echo esc_attr( $this->get_field_id('products-qty') ); ?>" name="<?php echo esc_attr( $this->get_field_name('products-qty') ); ?>" type="number" value="<?php echo esc_attr( $instance['products-qty'] ); ?>" />
		</p>
        <p>
            <label for="<?php echo $this->get_field_id("show"); ?>"><?php _e('Show:', 'plumtree'); ?></label>
        	<select class="widefat" id="<?php echo $this->get_field_id("show"); ?>" name="<?php echo $this->get_field_name("show"); ?>">
          		<option value="featured" <?php selected( $instance["show"], "featured" ); ?>><?php _e( 'Featured Products', 'plumtree' ) ?></option>
          		<option value="recent" <?php selected( $instance["show"], "recent" ); ?>><?php _e( 'Recent Products', 'plumtree' ) ?></option>
          		<option value="sale" <?php selected( $instance["show"], "sale" ); ?>><?php _e( 'On-Sale Products', 'plumtree' ) ?></option>
				<option value="best_selling" <?php selected( $instance["show"], "best_selling" ); ?>><?php _e( 'Best Selling Products', 'plumtree' ) ?></option>
        	</select>
        </p>
	<?php
	}

	public function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['products-qty'] = intval( $new_instance['products-qty'] );
		$instance['show'] = strip_tags( $new_instance['show'] );
		$instance['show-vendor-title'] = $new_instance['show-vendor-title'];

		return $instance;
	}

	public function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title'] );
		$products_qty = ( isset($instance['products-qty']) ? $instance['products-qty'] : 3 );
		$show = ( isset($instance['show']) ? $instance['show'] : 'recent' );

		$vendor_shop = urldecode( get_query_var( 'vendor_shop' ) );
		$vendor_id   = WCV_Vendors::get_vendor_id( $vendor_shop );
		if ( class_exists('WCVendors_Pro') && function_exists('icl_object_id') ) {
			$vendor_id = get_the_author_meta('ID');
		}
		$shop_name   = WCV_Vendors::get_vendor_shop_name( $vendor_id );

		if ( $vendor_id ) {
	        // The Query
			$query_args = array (
	        	'post_type'				=> 'product',
				'post_status'			=> 'publish',
				'author'				=> $vendor_id,
	        	'ignore_sticky_posts' 	=> 1,
				'posts_per_page' 		=> $products_qty,
				'order' 				=> 'desc',
				'no_found_rows'  		=> 1,
				'meta_query' 			=> array()
			);

			$query_args['meta_query'][] = array(
						'key' 		=> '_visibility',
						'value' 	=> array('catalog', 'visible'),
						'compare'	=> 'IN'
					);

			$query_args['meta_query'][] = WC()->query->stock_status_meta_query();
			$query_args['meta_query']   = array_filter( $query_args['meta_query'] );

			switch ( $show ) {
				case 'featured' :
					$query_args['orderby']  = 'date';
					$query_args['meta_query'][] = array(
						'key'   => '_featured',
						'value' => 'yes'
					);
					break;
				case 'sale' :
					$query_args['orderby']  = 'date';
					$product_ids_on_sale    = wc_get_product_ids_on_sale();
					$product_ids_on_sale[]  = 0;
					$query_args['post__in'] = $product_ids_on_sale;
					break;
				case 'recent' :
					$query_args['orderby']  = 'date';
				case 'best_selling' :
					$query_args['meta_key'] = 'total_sales';
					$query_args['orderby']  = 'meta_value_num';
			}

			$the_query = new WP_Query( $query_args );
		}

		if ( $vendor_id && $the_query->have_posts() ) {
			echo $before_widget;

			if ($title) {
				echo $before_title . $title;
				if ( $instance['show-vendor-title'] == true ) {
					echo __(' by ', 'plumtree') . $shop_name;
				}
				echo $after_title;
			}

			echo apply_filters( 'woocommerce_before_widget_product_list', '<ul class="product_list_widget">' );

			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				wc_get_template( 'content-widget-product.php', array( 'show_rating' => false ) );
			endwhile;

			echo apply_filters( 'woocommerce_after_widget_product_list', '</ul>' );

			echo $after_widget;
		}
		wp_reset_postdata();
	}
} ?>
