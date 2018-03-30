<?php
/**
 * Creates a Products Filter Widget which can be placed in sidebar
 *
 * @class       UC_Products_Filter_Widget
 * @version     1.0.0
 * @package     Widgets
 * @category    Class
 * @author      Transvelo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( class_exists( 'WP_Widget' ) ) :
	/**
	 * Unicase Products Filter widget class
	 *
	 * @since 1.0.0
	 */
	 class UC_Products_Filter_Widget extends WP_Widget {

		public function __construct() {
			$widget_ops = array( 'description' => esc_html__( 'Add products filter sidebar widgets to your sidebar.', 'unicase' ) );
			parent::__construct( 'unicase_products_filter', esc_html__( 'Unicase Product Filter', 'unicase' ), $widget_ops );
		}

		public function widget($args, $instance) {

			$instance['title'] = apply_filters( 'unicase_products_filter_widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			echo wp_kses_post( $args['before_widget'] );

			if ( ! empty($instance['title']) )
				echo wp_kses_post( $args['before_title'] . $instance['title'] . $args['after_title'] );

			if ( ! is_active_sidebar( 'product-filters-1' ) ) {
				if ( function_exists( 'unicase_default_product_filter_widgets' ) ) {
					unicase_default_product_filter_widgets();
				}
			} else {
				dynamic_sidebar( 'product-filters-1' );
			}

			echo wp_kses_post( $args['after_widget'] );
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			if ( ! empty( $new_instance['title'] ) ) {
				$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
			}
			return $instance;
		}

		public function form( $instance ) {
			global $wp_registered_sidebars;

			$title = isset( $instance['title'] ) ? $instance['title'] : '';

			// If no sidebars exists.
			if ( !$wp_registered_sidebars ) {
				echo '<p>'. esc_html__('No sidebars are available.', 'unicase' ) .'</p>';
				return;
			}
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e( 'Title:', 'unicase' ) ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<?php
		}
	}
endif;