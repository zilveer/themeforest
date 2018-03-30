<?php
/**
 * Creates a Custom Menu Widget which can be placed in sidebar
 *
 * @class       UC_WP_Nav_Menu_Widget
 * @version     1.0.0
 * @package     Widgets
 * @category    Class
 * @author      Transvelo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( ! class_exists( 'UC_WP_Nav_Menu_Widget' ) ) :
	/**
	 * Unicase Navigation Menu widget class
	 *
	 * @since 1.0.0
	 */
	 class UC_WP_Nav_Menu_Widget extends WP_Widget {

	 	public function __construct() {
			$widget_ops = array( 'description' => esc_html__( 'Add a vertical menu to your sidebar.', 'unicase' ) );
			parent::__construct( 'unicase_nav_menu', esc_html__( 'Vertical Menu', 'unicase' ), $widget_ops );
		}

		public function widget($args, $instance) {
			// Get menu
			$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

			if ( !$nav_menu )
				return;

			/** This filter is documented in wp-includes/default-widgets.php */
			$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			$instance['icon_class'] = apply_filters( 'unicase_nav_menu_widget_icon_class', empty( $instance['icon_class'] ) ? '' : $instance['icon_class'], $instance, $this->id_base );

			if ( !empty($instance['icon_class']) ) {
				$instance['title'] = '<i class="' . esc_attr( $instance['icon_class'] ) . '"></i>'.$instance['title'];
			}

			if ( isset( $instance['display_type'] ) && $instance['display_type'] == 'type-2' ) {
				$args['before_widget'] = str_replace( 'widget_unicase_nav_menu', 'widget_unicase_nav_menu menu-alt', $args['before_widget'] );
			}

			echo wp_kses_post( $args['before_widget'] );

			if ( !empty($instance['title']) )
				echo wp_kses_post( $args['before_title'] . $instance['title'] . $args['after_title'] );

			$nav_menu_args = array(
				'theme_location'	=> 'custom-menu-widget',
				'container'			=> 'false',
				'menu_class'        => 'nav navbar-nav',
				'fallback_cb'		=> 'wp_bootstrap_navwalker::fallback',
				'walker'			=> new wp_bootstrap_navwalker(),
				'menu'				=> $nav_menu
			);

			/**
			 * Filter the arguments for the Custom Menu widget.
			 *
			 * @since 1.0.0
			 *
			 * @param array    $nav_menu_args {
			 *     An array of arguments passed to wp_nav_menu() to retrieve a custom menu.
			 *
			 *     @type callback|bool $fallback_cb Callback to fire if the menu doesn't exist. Default empty.
			 *     @type mixed         $menu        Menu ID, slug, or name.
			 * }
			 * @param stdClass $nav_menu      Nav menu object for the current menu.
			 * @param array    $args          Display arguments for the current widget.
			 */
			wp_nav_menu( apply_filters( 'widget_unicase_nav_menu_args', $nav_menu_args, $nav_menu, $args ) );

			echo wp_kses_post( $args['after_widget'] );
		}

		public function update( $new_instance, $old_instance ) {
			
			$instance = $old_instance;

			if ( ! empty( $new_instance['title'] ) ) {
				$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
			}
			if ( ! empty( $new_instance['icon_class'] ) ) {
				$instance['icon_class'] = strip_tags( stripslashes($new_instance['icon_class']) );
			}
			if ( ! empty( $new_instance['display_type'] ) ) {
				$instance['display_type'] = strip_tags( stripslashes($new_instance['display_type']) );
			}
			if ( ! empty( $new_instance['nav_menu'] ) ) {
				$instance['nav_menu'] = (int) $new_instance['nav_menu'];
			}
			return $instance;
		}

		public function form( $instance ) {
			
			$title 			= isset( $instance['title'] ) ? $instance['title'] : '';
			$icon_class 	= isset( $instance['icon_class'] ) ? $instance['icon_class'] : '';
			$display_type	= isset( $instance['display_type'] ) ? $instance['display_type'] : 'type-1';
			$nav_menu 		= isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

			// Get menus
			$menus = wp_get_nav_menus();

			// If no menus exists, direct the user to go and create some.
			?>
			<p class="nav-menu-widget-no-menus-message" <?php if ( ! empty( $menus ) ) { echo ' style="display:none" '; } ?>>
				<?php
				if ( isset( $GLOBALS['wp_customize'] ) && $GLOBALS['wp_customize'] instanceof WP_Customize_Manager ) {
					$url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
				} else {
					$url = admin_url( 'nav-menus.php' );
				}
				?>
				<?php echo sprintf( wp_kses( __( 'No menus have been created yet. <a href="%s">Create some</a>.', 'unicase' ), array( 'a' => array( 'href' => array() ) ) ), esc_attr( $url ) ); ?>
			</p>
			<div class="nav-menu-widget-form-controls" <?php if ( empty( $menus ) ) { echo ' style="display:none" '; } ?>>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'unicase' ) ?></label>
					<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" />
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'icon_class' ) ); ?>"><?php esc_html_e( 'Icon Class:', 'unicase' ) ?></label>
					<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon_class' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_class' ) ); ?>" value="<?php echo esc_attr( $icon_class ); ?>" />
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'display_type' ) ); ?>"><?php esc_html_e( 'Select Type:', 'unicase' ); ?></label>
					<select id="<?php echo esc_attr( $this->get_field_id( 'display_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_type' ) ); ?>" class="widefat">
						<option value="type-1"<?php selected( $display_type, 'type-1' ); ?>><?php esc_html_e( 'Type 1', 'unicase' ); ?></option>
						<option value="type-2"<?php selected( $display_type, 'type-2' ); ?>><?php esc_html_e( 'Type 2', 'unicase' ); ?></option>
					</select>
				</p>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'nav_menu' ) ); ?>"><?php esc_html_e( 'Select Menu:', 'unicase' ); ?></label>
					<select id="<?php echo esc_attr( $this->get_field_id( 'nav_menu' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'nav_menu' ) ); ?>">
						<option value="0"><?php esc_html_e( '&mdash; Select &mdash;', 'unicase' ); ?></option>
						<?php foreach ( $menus as $menu ) : ?>
							<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
								<?php echo esc_html( $menu->name ); ?>
							</option>
						<?php endforeach; ?>
					</select>
				</p>
			</div>
			<?php
		}
	}
endif;