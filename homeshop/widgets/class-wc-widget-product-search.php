<?php
/**
 * Product Search Widget
 *
 * @author 		WooThemes
 * @category 	Widgets
 * @package 	WooCommerce/Widgets
 * @version 	2.1.0
 * @extends 	WC_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Custom_WC_Widget_Product_Search extends WC_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_product_search';
		$this->widget_description = __( 'A Search box for products only.', 'homeshop' );
		$this->widget_id          = 'woocommerce_product_search';
		$this->widget_name        = 'homeshop'.' - '.__( 'WooCommerce Product Search', 'homeshop' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Search Products', 'homeshop' ),
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
	function widget( $args, $instance ) {
		extract( $args );

		$title = $instance['title'];
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);

		$color             =  $instance['color'] ;
		$icon             =  $instance['icon'] ;
		
		//echo $before_widget;

		//if ( $title ) echo $before_title . $title . $after_title;

		echo '<div class="row sidebar-box '. esc_attr($color) .'">
						
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="sidebar-box-heading">
					<i class="icons '. esc_attr($icon) .'"></i>
					<h4>'. esc_html($title) .'</h4>
				</div>
				<div class="sidebar-box-content  sidebar-padding-box">';
		
		get_product_search_form1();

		//echo $after_widget;
		echo '</div>
                </div>		
				</div>';
		
	}
}




if ( ! function_exists( 'get_product_search_form1' ) ) {

	/**
	 * Output Product search forms.
	 *
	 * @access public
	 * @subpackage	Forms
	 * @param bool $echo (default: true)
	 * @return string
	 * @todo This function needs to be broken up in smaller pieces 
	 */
	function get_product_search_form1( $echo = true  ) {
		do_action( 'get_product_search_form'  );

		$search_form_template = locate_template( 'product-searchform.php' );
		if ( '' != $search_form_template  ) {
			require $search_form_template;
			return;
		}

		$form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
			<div>
				<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search for products', 'homeshop' ) . '" style="width: 63%;" />
				<input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search', 'homeshop' ) .'" />
				<input type="hidden" name="post_type" value="product" />
			</div>
		</form>';

		if ( $echo  )
			echo apply_filters( 'get_product_search_form', $form );
		else
			return apply_filters( 'get_product_search_form', $form );
	}
}