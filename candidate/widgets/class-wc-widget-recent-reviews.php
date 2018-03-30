<?php
/**
 * Recent Reviews Widget
 *
 * @author 		WooThemes
 * @category 	Widgets
 * @package 	WooCommerce/Widgets
 * @version 	2.1.0
 * @extends 	WC_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Candidat_WC_Widget_Recent_Reviews extends WC_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_recent_reviews';
		$this->widget_description = __( 'Display a list of your most recent reviews on your site.', 'candidate' );
		$this->widget_id          = 'woocommerce_recent_reviews';
		$this->widget_name        = __( 'WooCommerce Recent Reviews', 'candidate' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Recent Reviews', 'candidate' ),
				'label' => __( 'Title', 'candidate' )
			),
			'number' => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => '',
				'std'   => 10,
				'label' => __( 'Number of reviews to show', 'candidate' )
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
		global $comments, $comment;

		if ( $this->get_cached_widget( $args ) )
			return;

		ob_start();
		extract( $args );

		$title    = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$number   = absint( $instance['number'] );
		$comments = get_comments( array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish', 'post_type' => 'product' ) );

		if ( $comments ) {
			echo $before_widget;
			if ( $title ) echo $before_title . $title . $after_title;
			echo '<ul class="shop-items-widget">';

			foreach ( (array) $comments as $comment ) {

				$_product = wc_get_product( $comment->comment_post_ID );

				$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

				$rating_html = $_product->get_rating_html( $rating );
				$average = $_product->get_average_rating();
				
				echo '<li><div class="featured-image">
						'. $_product->get_image() .'
					</div>
					<div class="shop-item-content">
						<h6><a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '"  >'. $_product->get_title() .'</a></h6>';

				printf( '<span class="price reviewer">' . _x( 'by %1$s', 'by comment author', 'candidate' ) . '</span>', get_comment_author() );
				
				echo '<div class="shop-rating read-only-small" data-score="'. esc_html( $average ) .'"></div>	
					  </div></li>';
			}

			echo '</ul>';
			echo $after_widget;
		}

		$content = ob_get_clean();

		echo $content;

		$this->cache_widget( $args, $content );
	}
}
