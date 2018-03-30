<?php if(! defined('ABSPATH')){ return; }

/**
 * Navigation Menu widget class
 *
 * @since 3.0.0
 */
class ZN_Nav_Menu_Widget extends WP_Widget
{

	function __construct()
	{
		$widget_ops = array ( 'description' => __( 'Use this widget to add one of your custom menus as a widget.This widget will dysplay two menu items on a row.', 'zn_framework' ) );
		parent::__construct( 'sbs_nav_menu', __( '[ Kallyas ] Side by side Menu', 'zn_framework' ), $widget_ops );
	}

	function widget( $args, $instance )
	{
		// Get menu
		$nav_menu = ! empty( $instance['sbs_nav_menu'] ) ? $instance['sbs_nav_menu'] : false;

		if ( ! $nav_menu ) {
			return;
		}

		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}

		echo '<div class="zn_sbs">';

		$sbs_nav_menu_depth = !empty( $instance['sbs_nav_menu_depth'] ) ? $instance['sbs_nav_menu_depth'] : '0';

		wp_nav_menu( array (
				'menu'        => $nav_menu,
				'fallback_cb' => '',
				'depth'           => $sbs_nav_menu_depth,
			) );

		echo '</div>';

		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance )
	{
		$instance['title']        = strip_tags( stripslashes( $new_instance['title'] ) );
		$instance['sbs_nav_menu'] = (int) $new_instance['sbs_nav_menu'];
		$instance['sbs_nav_menu_depth'] = (int) $new_instance['sbs_nav_menu_depth'];
		return $instance;
	}

	function form( $instance )
	{
		$title    = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['sbs_nav_menu'] ) ? $instance['sbs_nav_menu'] : '';
		$sbs_nav_menu_depth = isset( $instance['sbs_nav_menu_depth'] ) ? $instance['sbs_nav_menu_depth'] : '0';

		// Get menus
		$menus = get_terms( 'nav_menu', array ( 'hide_empty' => false ) );

		// If no menus exists, direct the user to go and create some.
		if ( ! $menus ) {
			echo '<p>' . sprintf( __( 'No menus have been created yet. <a href="%s">Create some</a>.', 'zn_framework' ), admin_url( 'nav-menus.php' ) ) . '</p>';
			return;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'zn_framework' ) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
				   name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>"/>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'sbs_nav_menu' ); ?>"><?php _e( 'Select Menu:', 'zn_framework' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'sbs_nav_menu' ); ?>"
					name="<?php echo $this->get_field_name( 'sbs_nav_menu' ); ?>">
				<?php
					foreach ( $menus as $menu ) {
						$selected = $nav_menu == $menu->term_id ? ' selected="selected"' : '';
						echo '<option' . $selected . ' value="' . $menu->term_id . '">' . $menu->name . '</option>';
					}
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'sbs_nav_menu_depth' ); ?>"><?php _e( 'Menu depth :', 'zn_framework' ); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'sbs_nav_menu_depth' ); ?>" value="<?php echo $sbs_nav_menu_depth; ?>" name="<?php echo $this->get_field_name( 'sbs_nav_menu_depth' ); ?>"/>
		</p>

	<?php
	}
}
function register_widget_ZN_Nav_Menu_Widget(){
	register_widget( "ZN_Nav_Menu_Widget" );
}


add_action( 'widgets_init', 'register_widget_ZN_Nav_Menu_Widget' );
