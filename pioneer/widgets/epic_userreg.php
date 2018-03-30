<?php
/**
 * Plugin Name: Epic User Login and Registration
 * Plugin URI: http://epicthemes.net
 * Description: Displays a module with a login form and user registration form.
 * Version: 1.0
 * Author: Epic Media Labs Ltd.
 * Author URI: http://epicthemes.net

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'epic_userreg_load_widgets' );

/**
 * Register our widget.
 * 'Epic_Latestposts_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function epic_userreg_load_widgets() {
	register_widget( 'Epic_Userreg_Widget' );
}

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class Epic_Userreg_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Epic_Userreg_Widget() {
		/* Widget settings. */
		$epicuserregwidget_ops = array( 'classname' => 'widget_register', 'description' => __('Displays a Login- and user registration form', 'epic') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'epicuserreg-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'epicuserreg-widget', __('Epic - User Login- and Registration', 'epic'), $epicuserregwidget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$login_title = apply_filters('widget_text', $instance['login_title']);
		$login_text = apply_filters('widget_text',$instance['login_text']);
		$login_subtext = apply_filters('widget_text',$instance['login_subtext']);
		
		$signup_title = apply_filters('widget_text',$instance['signup_title']);
		$signup_text = $instance['signup_text'];
		$signup_subtext = $instance['signup_subtext'];
		
		$welcome_text = $instance['welcome_text'];
		$welcome_subtext = $instance['welcome_subtext'];
		

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			//echo $before_title . $title . $after_title;
			
		echo epic_user_module($login_title, $login_text, $login_subtext, $signup_title, $signup_text, $signup_subtext, $welcome_text, $welcome_subtext, 'widget');
		
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['login_title'] = strip_tags( $new_instance['login_title'] );
		$instance['login_text'] = strip_tags($new_instance['login_text'] );
		$instance['login_subtext'] = $new_instance['login_subtext'];
		
		$instance['signup_title'] = strip_tags( $new_instance['signup_title'] );
		$instance['signup_text'] = strip_tags($new_instance['signup_text']);
		$instance['signup_subtext'] = $new_instance['signup_subtext'];
		
		$instance['welcome_text'] = strip_tags($new_instance['welcome_text']);
		$instance['welcome_subtext'] = $new_instance['welcome_subtext'];
		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		
		$defaults = array( 'title' => __('Sign in and register', 'epic') );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
?>




		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'epic'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<!-- Your Name: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'login_title' ); ?>"><?php _e('Login title:', 'epic'); ?></label>
			<input id="<?php echo $this->get_field_id( 'login_title' ); ?>" name="<?php echo $this->get_field_name( 'login_title' ); ?>" value="<?php echo $instance['login_title']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'login_text' ); ?>"><?php _e('Login text:', 'epic'); ?></label>
			<textarea id="<?php echo $this->get_field_id( 'login_text' ); ?>" name="<?php echo $this->get_field_name( 'login_text' ); ?>" style="width:100%;" ><?php echo $instance['login_text']; ?></textarea>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'login_subtext' ); ?>"><?php _e('Login sub-text:', 'epic'); ?></label>
			<textarea id="<?php echo $this->get_field_id( 'login_subtext' ); ?>" name="<?php echo $this->get_field_name( 'login_subtext' ); ?>" style="width:100%;" ><?php echo $instance['login_subtext']; ?></textarea>
		</p>
		
		<!-- Your Name: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'signup_title' ); ?>"><?php _e('Signup title:', 'epic'); ?></label>
			<input id="<?php echo $this->get_field_id( 'signup_title' ); ?>" name="<?php echo $this->get_field_name( 'signup_title' ); ?>" value="<?php echo $instance['signup_title']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'signup_text' ); ?>"><?php _e('Signup text:', 'epic'); ?></label>
			<textarea id="<?php echo $this->get_field_id( 'signup_text' ); ?>" name="<?php echo $this->get_field_name( 'signup_text' ); ?>" style="width:100%;" ><?php echo $instance['signup_text']; ?>	</textarea>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'signup_subtext' ); ?>"><?php _e('Signup sub-text:', 'epic'); ?></label>
			<textarea id="<?php echo $this->get_field_id( 'signup_subtext' ); ?>" name="<?php echo $this->get_field_name( 'signup_subtext' ); ?>" style="width:100%;" ><?php echo $instance['signup_subtext']; ?></textarea>
		</p>
		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'welcome_text' ); ?>"><?php _e('Welcome back title:', 'epic'); ?></label>
			<textarea id="<?php echo $this->get_field_id( 'welcome_text' ); ?>" name="<?php echo $this->get_field_name( 'welcome_text' ); ?>" style="width:100%;" ><?php echo $instance['welcome_text']; ?>	</textarea>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'welcome_subtext' ); ?>"><?php _e('Welcome back text:', 'epic'); ?></label>
			<textarea id="<?php echo $this->get_field_id( 'welcome_subtext' ); ?>" name="<?php echo $this->get_field_name( 'welcome_subtext' ); ?>" style="width:100%;" ><?php echo $instance['welcome_subtext']; ?></textarea>
		</p>


		
		

	<?php
	}
}

?>