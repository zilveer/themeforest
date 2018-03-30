<?php
/**
 * Custom functions that deal with the integration of WP Job Manager Products.
 * See: https://astoundify.com/downloads/wp-job-manager-products/
 *
 * @package Listable
 */


/* ------- UTILITY FUNCTIONS --------- */

function listable_get_linked_products( $post_ID = null ) {

	if ( null === $post_ID ) {
		$post_ID = get_the_ID();
	}

	//bail if something is fishy
	if ( empty( $post_ID) || is_wp_error( $post_ID ) ) {
		return false;
	}

	$products = get_post_meta( $post_ID, '_products', true );

	// Stop if there are no products
	if ( ! $products || ! is_array( $products ) ) {
		return false;
	}

	return $products;
}

/**
 * Remove the action that ads the product details after the listing's single content
 */
function listable_remove_wp_job_manager_products_output() {

	if ( class_exists( 'WP_Job_Manager_Products' ) ) {
		//get the instance of WP_Job_Manager_Products that holds the instance of WPJMP_Products
		$wpjmp_instance = WP_Job_Manager_Products::instance();
		remove_action( 'single_job_listing_end', array( $wpjmp_instance->products, 'listing_display_products' ) );
	}
}

// Display products on listing page
add_action( 'single_job_listing_end', 'listable_remove_wp_job_manager_products_output', 1 );
add_filter('submit_job_steps', 'listable_change_submit_preview_function', 10, 1);

// Display product price on listing archives
function listable_add_product_price_for_listing_archives( $post ) {
	$output = '';
	//get linked products
	$products_IDs = listable_get_linked_products( $post->ID );
	if ( ! empty( $products_IDs ) ) {
		$first_productID = array_shift( $products_IDs );
		$product = wc_get_product( $first_productID );
		$output .= '<span class="product__price">' . $product->get_price_html() . '</span>';
	}

	echo $output;
}
add_action( 'listable_job_listing_card_image_bottom', 'listable_add_product_price_for_listing_archives', 10, 1 );

function listable_get_linked_product_classes( $post ) {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return '';
	}
	//get linked products
	$products_IDs = listable_get_linked_products( $post->ID );
	if ( ! empty( $products_IDs ) ) {
		$first_productID = array_shift( $products_IDs );
		//get the product's classes
		$classes = wc_product_post_class( array(), '', $first_productID );

		if ( ! empty( $classes ) ) {
			return 'product ' . implode( ' ', $classes );
		} else {
			return 'product';
		}
	}

	return '';
}

/**
 * @param string $classes
 * @param WP_Post $post
 *
 * @return string
 */
function listable_add_linked_product_listing_classes( $classes, $post ) {
	$product_classes = listable_get_linked_product_classes( $post );

	if ( ! empty( $product_classes ) ) {
		$classes .= ' ' . $product_classes;
	}

	return $classes;
}
add_filter( 'listable_listing_archive_classes', 'listable_add_linked_product_listing_classes', 10, 2 );

/* -------- WIDGETS -------- */

function listable_register_widget_areas_wpjm_products() {
	register_widget( 'Listing_Sidebar_Products_Widget' );
}

add_action( 'widgets_init', 'listable_register_widget_areas_wpjm_products' );

class Listing_Sidebar_Products_Widget extends WP_Widget {

	private $defaults = array(
			'title'           => '',
			'subtitle'        => '',
	);

	function __construct() {
		parent::__construct(
				'listing_sidebar_products', // Base ID
				'&#x1F536; ' . esc_html__( 'Listing', 'listable') . ' &raquo; ' . esc_html__('Products', 'listable' ), // Name
				array(
						'description' => esc_html__( 'The products linked to the current listing.', 'listable' ),
				) // Widget Options
		);
	}

	public function widget( $args, $instance ) {

		$placeholders = $this->get_placeholder_strings();
		//only put in the default title if the user hasn't saved anything in the database e.g. $instance is empty (as a whole)
		$title           = apply_filters( 'widget_sidebar_title', ( empty( $instance ) || ! isset( $instance['title'] ) ) ? $placeholders['title'] : $instance['title'], $instance, $this->id_base );
		$subtitle        = empty( $instance ) ? $placeholders['subtitle'] : $instance['subtitle'];

		$products_IDs = listable_get_linked_products();

		if ( ! empty( $products_IDs ) ) :

			$query_args = apply_filters( 'woocommerce_related_products_args', array(
					'post_type'            => 'product',
					'ignore_sticky_posts'  => 1,
					'no_found_rows'        => 1,
					'posts_per_page'       => -1,
					'post__in'             => $products_IDs,
			) );

			$products = new WP_Query( $query_args );

			echo $args['before_widget']; ?>

			<h3 class="widget_sidebar_title">
				<?php
				echo $title;

				if ( ! empty( $subtitle ) ) { ?>
					<span class="widget_subtitle">
					<?php echo $subtitle; ?>
				</span>
				<?php } ?>
			</h3>

			<?php
			if ( $products->have_posts() ) : ?>

				<div class="listing-products__items">

					<?php
					while ( $products->have_posts() ) : $products->the_post();

						wc_get_template_part( 'content', 'single-product-listing-sidebar' );

					endwhile;

					wp_reset_postdata(); ?>

				</div><!-- .listing-products__items -->

				<?php
			endif;

			echo $args['after_widget'];
		endif;
	}

	public function form( $instance ) {
		$original_instance = $instance;

		//Defaults
		$instance = wp_parse_args(
				(array) $instance,
				$this->defaults );

		$placeholders = $this->get_placeholder_strings();

		$title = esc_attr( $instance['title'] );
		//if the user is just creating the widget ($original_instance is empty)
		if ( empty( $original_instance ) && empty( $title ) ) {
			$title = $placeholders['title'];
		}

		$subtitle = esc_attr( $instance['subtitle'] );
		//if the user is just creating the widget ($original_instance is empty)
		if ( empty( $original_instance ) && empty( $subtitle ) ) {
			$subtitle = $placeholders['subtitle'];
		} ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'listable' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" placeholder="<?php echo esc_attr( $placeholders['title'] ); ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php esc_html_e( 'Subtitle:', 'listable' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" type="text" value="<?php echo $subtitle; ?>" />
		</p>

		<p>
			<?php echo $this->widget_options['description']; ?>
		</p>
	<?php }

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                    = $old_instance;
		$instance['title']           = strip_tags( $new_instance['title'] );
		$instance['subtitle']        = strip_tags( $new_instance['subtitle'] );

		return $instance;
	}

	private function get_placeholder_strings() {
		$placeholders = apply_filters( 'listing_sidebar_products_backend_placeholders', array() );

		$placeholders = wp_parse_args(
				(array) $placeholders,
				array(
						'title'    => esc_html__( 'Make an Online Reservation', 'listable' ),
						'subtitle' => esc_html__( 'Powered by WooCommerce Plugin', 'listable' )
				) );

		return $placeholders;
	}

} // class Listing_Sidebar_Products_Widget