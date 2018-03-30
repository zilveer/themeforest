<?php
/**
 * This file is part of the BTP_Flare_Theme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



class BTP_Contact_Form_Widget extends WP_Widget {
	
	function BTP_Contact_Form_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_btp_contact_form', 'description' => __('Well, just a contact form', 'btp_theme') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'btp_contact_form_widget' );

		/* Create the widget. */
		parent::__construct( 'btp_contact_form_widget', __('BTP Contact Form', 'btp_theme'), $widget_ops, $control_ops );
	}
	
	/* Display widget */
	function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );		
		
		/* Start composing output */
		$out = '';
				
		/* Before widget (defined by themes). */
		$out .= $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			$out .= $before_title . $title . $after_title;
		
		$btp_shortcode = '[contact_form ';
			$btp_shortcode .= 'email="'.$instance['email'].'" ';
			$btp_shortcode .= 'name="'.$instance['name'].'" ';
			$btp_shortcode .= 'subject="'.$instance['subject'].'" ';
			$btp_shortcode .= 'success="'.$instance['success'].'" ';
			$btp_shortcode .= 'failure="'.$instance['failure'].'" ';
		$btp_shortcode .= ']';	
			
		$out .= do_shortcode($btp_shortcode);		
		
		/* After widget (defined by themes). */
		$out .= $after_widget;
						
		/* Render Widget */
		echo $out;
	}
	
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Filter input data */		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['email'] = strip_tags( $new_instance['email'] );
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['subject'] = strip_tags( $new_instance['subject'] );
		$instance['success'] = strip_tags( $new_instance['success'] );
		$instance['failure'] = strip_tags( $new_instance['failure'] );
		
		return $instance;
	}
	
	/* Display widget form */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
			'title'			=> __('Contact Form', 'btp_theme'),
			'email'			=> '',
			'name'			=> '',	
			'subject'		=> '',			
			'success'		=> '',
			'failure'		=> ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e('Recipient email', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e('Recipient name', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo $instance['name']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'subject' ); ?>"><?php _e('Subject', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'subject' ); ?>" name="<?php echo $this->get_field_name( 'subject' ); ?>" value="<?php echo $instance['subject']; ?>" style="width:100%;" />
		</p>
			
		<p>
			<label for="<?php echo $this->get_field_id( 'success' ); ?>"><?php _e('Success text', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'success' ); ?>" name="<?php echo $this->get_field_name( 'success' ); ?>" value="<?php echo $instance['success']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'failure' ); ?>"><?php _e('Failure text', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'failure' ); ?>" name="<?php echo $this->get_field_name( 'failure' ); ?>" value="<?php echo $instance['failure']; ?>" style="width:100%;" />
		</p>
		
	<?php
	}
}



/* Function called by action/hook 'widgets_init' */
function btp_init_contact_form_widget() {
	register_widget( 'BTP_Contact_Form_Widget' );
}
add_action( 'widgets_init', 'btp_init_contact_form_widget' );
?>