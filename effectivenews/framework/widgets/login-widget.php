<?php 

add_action('widgets_init','mom_widget_login');

function mom_widget_login() {
	register_widget('mom_widget_login');
	
	}

class mom_widget_login extends WP_Widget {
	function mom_widget_login() {
			
		$widget_ops = array('classname' => 'momizat-login','description' => __('Widget display Login form','theme'));
		parent::__construct('momizatLogin',__('Effective - Login form','theme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$register = $instance['register'];
		$reset = $instance['reset'];
		

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
			mom_login_widget($register, $reset);
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['register'] =  $new_instance['register'] ;
		$instance['reset'] =  $new_instance['reset'] ;
	
		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
			'title' => __('Login', 'theme'),
			'register' => '',
			'reset'	=> ''
 			);
		$instance = wp_parse_args( (array) $instance, $defaults );
	
		?>
	
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:','theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'register' ); ?>"><?php _e('Registration URL:','theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'register' ); ?>" name="<?php echo $this->get_field_name( 'register' ); ?>" value="<?php echo $instance['register']; ?>"  class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'reset' ); ?>"><?php _e('Lost password URL:','theme'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'reset' ); ?>" name="<?php echo $this->get_field_name( 'reset' ); ?>" value="<?php echo $instance['reset']; ?>"  class="widefat" />
		</p>
   <?php 
}
	} //end class