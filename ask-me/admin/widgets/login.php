<?php
/* Login */
add_action( 'widgets_init', 'widget_login_widget' );
function widget_login_widget() {
	register_widget( 'Widget_Login' );
}

class Widget_Login extends WP_Widget {

	function Widget_Login() {
		$widget_ops = array( 'classname' => 'login-widget'  );
		$control_ops = array( 'id_base' => 'login-widget' );
		parent::__construct( 'login-widget','Ask me - Login', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title                = apply_filters('widget_title', $instance['title'] );
		$not_login            = esc_attr($instance['not_login']);
		$register_like_button = esc_attr($instance['register_like_button']);
		if (empty($not_login) || !is_user_logged_in()) {
			echo $before_widget;
				if ( $title )
					echo $before_title.esc_attr($title).$after_title;?>
				<div class="widget_login">
					<?php if (!is_user_logged_in()) {
						echo '<div class="form-style form-style-2">
							'.do_shortcode("[ask_login".(isset($register_like_button) && $register_like_button == "on"?" register='button'":"").(empty($register_like_button)?" ask_login register_2='yes'":"")."]");
							echo '<div class="clearfix"></div>
						</div>';
					}else {
						echo is_user_logged_in_data(vpanel_options("user_links"));
					}?>
				</div>
				<?php
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance		                  = $old_instance;
		$instance['title']                = strip_tags( $new_instance['title'] );
		$instance['not_login']            = $new_instance['not_login'];
		$instance['register_like_button'] = $new_instance['register_like_button'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __('Login','vbegy'));
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo (isset($instance['title'])?esc_attr($instance['title']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo (isset($instance['not_login']) && $instance['not_login'] == "on"?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'not_login' ); ?>" name="<?php echo $this->get_field_name( 'not_login' ); ?>">
			<label for="<?php echo $this->get_field_id( 'not_login' ); ?>">Display it for not login only ?</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo (isset($instance['register_like_button']) && $instance['register_like_button'] == "on"?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'register_like_button' ); ?>" name="<?php echo $this->get_field_name( 'register_like_button' ); ?>">
			<label for="<?php echo $this->get_field_id( 'register_like_button' ); ?>">Register like button ?</label>
		</p>
	<?php
	}
}
?>