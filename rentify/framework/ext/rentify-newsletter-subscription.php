<?php
/**
 * Newsletter widget.  Provies a subscribe form for integration with Google/Feedburner. 
 * Newsletter widget class.
 *
 * @since 0.1.0
 */

ob_start();
class Rentify_Widget_Newsletter extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		/* Set up the widget options. */
		$widget_options = array( 
			'classname' => 'newsletter', 
			'description' => esc_html__( 'Displays a subscription form for your Google/Feedburner account.', 'rentify' ) 
		);
		/* Set up the widget control options. */
		$control_options = array( 
			'width' => 200, 
			'height' => 350, 
			'id_base' => 'newsletter'
		);
		/* Create the widget. */
		// $this->WP_Widget( 'newsletter', __( 'Newsletter', 'unique' ), $widget_options, $control_options );
		parent::__construct('sb-newsletter', esc_html__('Rentify Newsletter','rentify' ), $widget_options, $control_options);

	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 0.1.0
	 */
	function widget( $sidebar, $instance ) {
		extract( $sidebar );

		echo apply_filters( 'Newsletter_before',  $args['before_widget'] );

		if ( $instance['title'] )

            echo apply_filters('Newsletter_before_title',$args['before_title']). esc_attr($title) . apply_filters('Newsletter_after_title',$args['after_title']);  

		?>
	
<?php $rentify_option_data = rentify_option_data(); ?>

<?php if(($rentify_option_data['sb-multi-footer-image']==5)||($rentify_option_data['sb-multi-footer-image']==6)){?>
<?php } else {?>
<div class="col-md-3 col-sm-6">
<?php } ?>

          <h5>Newsletter</h5>
<?php if(($rentify_option_data['sb-multi-footer-image']==5)||($rentify_option_data['sb-multi-footer-image']==6)){?>
<?php } else{?>
<p>Subscribe to our newsletter to receive our latest news and updates. We do not spam.</p>
<?php } ?>
		<form class="newsletter-form" action="http://feedburner.google.com/fb/a/mailverify" method="post">
		<p>
			<input type="email" placeholder="Enter your email address" value="<?php echo esc_attr( $instance['input_text'] ); ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
			<input type="submit" class="btn btn-primary" value="<?php echo esc_attr( $instance['submit_text'] ); ?>" />
			<input type="hidden" value="<?php echo esc_attr( $instance['id'] ); ?>" name="uri" />
			<input type="hidden" name="loc" value="en_US" />
		</p>
		</form>

<?php if(($rentify_option_data['sb-multi-footer-image']==5)||($rentify_option_data['sb-multi-footer-image']==6)){?>
<?php } else {?>
</div>
<?php } ?>

<?php
        echo apply_filters( 'Newsletter_after',  $args['after_widget'] );
	}
	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 0.1.0
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance = $new_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['id'] = strip_tags( $new_instance['id'] );
		$instance['input_text'] = strip_tags( $new_instance['input_text'] );
		$instance['submit_text'] = strip_tags( $new_instance['submit_text'] );
		return $instance;
	}
	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 0.1.0
	 */
	function form( $instance ) {
		//Defaults
		$defaults = array(
			'title' => esc_html__( 'Newsletter', 'unique' ),
			'input_text' => esc_html__( 'you@site.com', 'unique' ),
			'submit_text' => esc_html__( 'Subscribe', 'unique' ),
			'id' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<div class="hybrid-widget-controls columns-1">
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'rentify' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'id' )); ?>"><?php esc_html_e( 'Google/Feedburner ID:', 'rentify' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'id' )); ?>" value="<?php echo esc_attr( $instance['id'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'input_text' )); ?>"><?php esc_html_e( 'Input Text:', 'rentify' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'input_text' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'input_text' )); ?>" value="<?php echo esc_attr( $instance['input_text'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'submit_text' )); ?>"><?php esc_html_e( 'Submit Text:', 'rentify' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'submit_text' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'submit_text' )); ?>" value="<?php echo esc_attr( $instance['submit_text'] ); ?>" />
		</p>
		</div>
		<div style="clear:both;">&nbsp;</div>
	<?php
	}
}



add_action('widgets_init', 'rentify_widget_newsletter');

function rentify_widget_newsletter(){

    register_widget('Rentify_Widget_Newsletter');

}