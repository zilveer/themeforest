<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * List products Carousel. One widget to rule them all.
 *
 * @category Widgets
 * @package  Unicase
 * @extends  WC_Widget
 */
class UC_Widget_Products_Carousel extends WC_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass    = 'unicase widget_products_carousel';
		$this->widget_description = esc_html__( 'Display a list of products carousel on your site.', 'unicase' );
		$this->widget_id          = 'widget_products_carousel';
		$this->widget_name        = esc_html__( 'Unicase Products Carousel', 'unicase' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => esc_html__( 'Products', 'unicase' ),
				'label' => esc_html__( 'Title', 'unicase' )
			),
			'number' => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => '',
				'std'   => 5,
				'label' => esc_html__( 'Number of products to show', 'unicase' )
			),
			'show' => array(
				'type'  => 'select',
				'std'   => '',
				'label' => esc_html__( 'Show', 'unicase' ),
				'options' => array(
					''         => esc_html__( 'All Products', 'unicase' ),
					'featured' => esc_html__( 'Featured Products', 'unicase' ),
					'onsale'   => esc_html__( 'On-sale Products', 'unicase' ),
				)
			),
			'orderby' => array(
				'type'  => 'select',
				'std'   => 'date',
				'label' => esc_html__( 'Order by', 'unicase' ),
				'options' => array(
					'date'   => esc_html__( 'Date', 'unicase' ),
					'price'  => esc_html__( 'Price', 'unicase' ),
					'rand'   => esc_html__( 'Random', 'unicase' ),
					'sales'  => esc_html__( 'Sales', 'unicase' ),
				)
			),
			'order' => array(
				'type'  => 'select',
				'std'   => 'desc',
				'label' => esc_html_x( 'Order', 'Sorting order', 'unicase' ),
				'options' => array(
					'asc'  => esc_html__( 'ASC', 'unicase' ),
					'desc' => esc_html__( 'DESC', 'unicase' ),
				)
			),
			'hide_free' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => esc_html__( 'Hide free products', 'unicase' )
			),
			'show_hidden' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => esc_html__( 'Show hidden products', 'unicase' )
			)
		);

		parent::__construct();
	}

	/**
	 * Query the products and return them
	 * @param  array $args
	 * @param  array $instance
	 * @return WP_Query
	 */
	public function get_products( $args, $instance ) {
		$number  = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : $this->settings['number']['std'];
		$show    = ! empty( $instance['show'] ) ? sanitize_title( $instance['show'] ) : $this->settings['show']['std'];
		$orderby = ! empty( $instance['orderby'] ) ? sanitize_title( $instance['orderby'] ) : $this->settings['orderby']['std'];
		$order   = ! empty( $instance['order'] ) ? sanitize_title( $instance['order'] ) : $this->settings['order']['std'];

		$query_args = array(
			'posts_per_page' => $number,
			'post_status'    => 'publish',
			'post_type'      => 'product',
			'no_found_rows'  => 1,
			'order'          => $order,
			'meta_query'     => array()
		);

		if ( empty( $instance['show_hidden'] ) ) {
			$query_args['meta_query'][] = WC()->query->visibility_meta_query();
			$query_args['post_parent']  = 0;
		}

		if ( ! empty( $instance['hide_free'] ) ) {
			$query_args['meta_query'][] = array(
				'key'     => '_price',
				'value'   => 0,
				'compare' => '>',
				'type'    => 'DECIMAL',
			);
		}

		$query_args['meta_query'][] = WC()->query->stock_status_meta_query();
		$query_args['meta_query']   = array_filter( $query_args['meta_query'] );

		switch ( $show ) {
			case 'featured' :
				$query_args['meta_query'][] = array(
					'key'   => '_featured',
					'value' => 'yes'
				);
				break;
			case 'onsale' :
				$product_ids_on_sale    = wc_get_product_ids_on_sale();
				$product_ids_on_sale[]  = 0;
				$query_args['post__in'] = $product_ids_on_sale;
				break;
		}

		switch ( $orderby ) {
			case 'price' :
				$query_args['meta_key'] = '_price';
				$query_args['orderby']  = 'meta_value_num';
				break;
			case 'rand' :
				$query_args['orderby']  = 'rand';
				break;
			case 'sales' :
				$query_args['meta_key'] = 'total_sales';
				$query_args['orderby']  = 'meta_value_num';
				break;
			default :
				$query_args['orderby']  = 'date';
		}

		return new WP_Query( apply_filters( 'unicase_products_carousel_widget_query_args', $query_args ) );
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		if ( $this->get_cached_widget( $args ) ) {
			return;
		}

		$show    = ! empty( $instance['show'] ) ? sanitize_title( $instance['show'] ) : $this->settings['show']['std'];

		ob_start();

		if ( ( $products = $this->get_products( $args, $instance ) ) && $products->have_posts() ) {
			$this->widget_start( $args, $instance );
			?>
			
			<div id="widget_products_carousel_<?php echo esc_attr( $show ); ?>" class="owl-carousel unicase-owl-carousel owl-outer-nav has-grid products">
	            <?php
	            while ( $products->have_posts() ) : $products->the_post();
	                unicase_get_template( 'sections/products-carousel-item.php' );
	            endwhile;
	             ?>
	        </div>
	        <script type="text/javascript">
	            jQuery(document).ready(function($) {
	                $("#widget_products_carousel_<?php echo esc_attr( $show ); ?>").owlCarousel({
	                    items : 1,
	                    nav : true,
	                    slideSpeed : 300,
	                    dots: false,
	                    <?php if( is_rtl() ) : ?>
                        rtl: true,
                        <?php endif; ?>
	                    paginationSpeed : 400,
	                    navText: ["", ""],
	                    responsive:{
							0:{
								items:1
							},
							600:{
								items:2
							},
							1000:{
								items:1
							}
						}
	                });
	            });
	        </script>
			
			<?php
			$this->widget_end( $args );
		}

		wp_reset_postdata();

		wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '1.10.2', true );

		echo $this->cache_widget( $args, ob_get_clean() );
	}
}
