<?php
/**
 * MNKY Side Menu
 *
 */
 
 class WP_Side_Menu_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __('Use this widget to add one of your custom menus as a widget.', 'mnky-admin') );
		parent::__construct( 'side_menu', __('CUSTOM - Side Menu', 'mnky-admin'), $widget_ops );
	}

	function widget($args, $instance) {
		// Get menu
		$side_menu = ! empty( $instance['side_menu'] ) ? wp_get_nav_menu_object( $instance['side_menu'] ) : false;

		if ( !$side_menu )
			return;

		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];

		wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $side_menu ) );

		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['side_menu'] = (int) $new_instance['side_menu'];
		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$side_menu = isset( $instance['side_menu'] ) ? $instance['side_menu'] : '';

		// Get menus
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.', 'mnky-admin'), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'mnky-admin') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('side_menu'); ?>"><?php _e('Select Menu:', 'mnky-admin'); ?></label>
			<select id="<?php echo $this->get_field_id('side_menu'); ?>" name="<?php echo $this->get_field_name('side_menu'); ?>">
		<?php
			foreach ( $menus as $menu ) {
				echo '<option value="' . $menu->term_id . '"'
					. selected( $side_menu, $menu->term_id, false )
					. '>'. $menu->name . '</option>';
			}
		?>
			</select>
		</p>
		<?php
	}
}

function register_sidemenu_widget() {
	register_widget( 'WP_Side_Menu_Widget' );
}

add_action( 'widgets_init', 'register_sidemenu_widget' );
?>