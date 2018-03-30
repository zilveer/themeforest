<?php
/**
 * List products. One widget to rule them all.
 *
 * @author 		WooThemes
 * @category 	Widgets
 * @package 	WooCommerce/Widgets
 * @version 	2.1.0
 * @extends 	WC_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly






class Custom_WC_Widget_Products extends WC_Widget {
	
	
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_products1';
		$this->widget_description = __( 'Display a list of your products on your site.', 'homeshop' );
		$this->widget_id          = 'woocommerce_products1';
		$this->widget_name        = __( 'WooCommerce Products', 'homeshop' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Products', 'homeshop' ),
				'label' => __( 'Title', 'homeshop' )
			),
			
			'icon' => array(
				'type'  => 'select',
				'std'   => 'icon-folder-open-empty',
				'label' => __( 'Select Icon', 'homeshop' ),
				'options' => wm_fontello_classes(),
			),
			'color' => array(
				'type'  => 'select',
				'std'   => 'red',
				'label' => __( 'Select Color', 'homeshop' ),
				'options' => array(
					'default' => __( 'Default', 'homeshop' ),
					'red' => __( 'Red', 'homeshop' ),
					'green' => __( 'Green', 'homeshop' ),
					'blue' => __( 'Blue', 'homeshop' ),
					'orange' => __( 'Orange', 'homeshop' ),
					'purple'  => __( 'Purple', 'homeshop' )
				)
			),
			
			'style' => array(
				'type'  => 'select',
				'std'   => 'simple',
				'label' => __( 'Style', 'homeshop' ),
				'options' => array(
					'simple' => __( 'Simple', 'homeshop' ),
					'carousel' => __( 'Carousel', 'homeshop' )
				)
			),
			'cat_prod1' => array(
				'type'  => 'select',
				'std'   => 'all',
				'label' => __( 'Select Category', 'homeshop' ),
				'options' => homeshop_category_prod(),
			),
			
			
			'number' => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => '',
				'std'   => 5,
				'label' => __( 'Number of products to show', 'homeshop' )
			),
			'show' => array(
				'type'  => 'select',
				'std'   => '',
				'label' => __( 'Show', 'homeshop' ),
				'options' => array(
					''         => __( 'All Products', 'homeshop' ),
					'featured' => __( 'Featured Products', 'homeshop' ),
					'onsale'   => __( 'On-sale Products', 'homeshop' ),
				)
			),
			'orderby' => array(
				'type'  => 'select',
				'std'   => 'date',
				'label' => __( 'Order by', 'homeshop' ),
				'options' => array(
					'date'   => __( 'Date', 'homeshop' ),
					'price'  => __( 'Price', 'homeshop' ),
					'rand'   => __( 'Random', 'homeshop' ),
					'sales'  => __( 'Sales', 'homeshop' ),
				)
			),
			'order' => array(
				'type'  => 'select',
				'std'   => 'desc',
				'label' => _x( 'Order', 'Sorting order', 'homeshop' ),
				'options' => array(
					'asc'  => __( 'ASC', 'homeshop' ),
					'desc' => __( 'DESC', 'homeshop' ),
				)
			),
			'hide_free' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Hide free products', 'homeshop' )
			),
			'show_hidden' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Show hidden products', 'homeshop' )
			)
		);
		parent::__construct();
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	public function widget( $args, $instance ) {

		if ( $this->get_cached_widget( $args ) )
			return;

		ob_start();
		extract( $args );

		$title       = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$number      = absint( $instance['number'] );
		$show        = sanitize_title( $instance['show'] );
		$orderby     = sanitize_title( $instance['orderby'] );
		$order       = sanitize_title( $instance['order'] );
		$show_rating = false;

		$color             =  $instance['color'] ;
		$icon             =  $instance['icon'] ;
		
		
    	$query_args = array(
    		'posts_per_page' => $number,
    		'post_status' 	 => 'publish',
    		'post_type' 	 => 'product',
    		'no_found_rows'  => 1,
    		'order'          => $order == 'asc' ? 'asc' : 'desc'
    	);

    	$query_args['meta_query'] = array();

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
    			$product_ids_on_sale = wc_get_product_ids_on_sale();
				$product_ids_on_sale[] = 0;
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

		$r = new WP_Query( $query_args );

		if ( $r->have_posts() ) {

			//echo $before_widget;

			//if ( $title ) echo $before_title . $title . $after_title;

			echo '<div class="row sidebar-box '. esc_attr($color) .'">
						
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="sidebar-box-heading">
					<i class="icons '. esc_attr($icon) .'"></i>
					<h4>'. esc_html($title) .'</h4>
				</div>
				<div class="sidebar-box-content">';	
			
			
			echo '<table class="bestsellers-table">';

			while ( $r->have_posts()) {
				$r->the_post();
				wc_get_template( 'content-widget-product.php', array( 'show_rating' => $show_rating ) );
			}

			echo '</table>';

			//echo $after_widget;
			
			echo  '</div></div></div>';
		}

		wp_reset_postdata();

		$content = ob_get_clean();

		echo $content;

		$this->cache_widget( $args, $content );
	}
}

