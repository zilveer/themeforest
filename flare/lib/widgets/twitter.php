<?php
/**
 * This file is part of the BTP_Flare_Theme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



class BTP_Twitter_Widget extends WP_Widget {
	
	function BTP_Twitter_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_btp_twitter', 'description' => __('Most recent tweets', 'btp_theme') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'btp_twitter_widget' );

		/* Create the widget. */
		parent::__construct( 'btp_twitter_widget', __('BTP Twitter', 'btp_theme'), $widget_ops, $control_ops );
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
		if ( $title ) {
			$out .= $before_title . $title . $after_title;
		}	
		
		$out .= do_shortcode( '[twitter username="' . $instance['username'] . '" max="' . $instance['max'] . '"]' );
		
		/* After widget (defined by themes). */
		$out .= $after_widget;
						
		/* Render Widget */
		echo $out;
	}
	
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Filter input data */
		$instance[ 'title' ] 		= strip_tags( $new_instance[ 'title' ] );
		$instance[ 'username' ] 	= strip_tags( $new_instance[ 'username' ] );
		$instance[ 'max' ] 			= absint( $new_instance[ 'max' ] );

		return $instance;
	}
	
	/* Display widget form */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
			'title' 			=> __('Recent tweets', 'btp_theme'),
			'username'			=> 'bringthepixel',
			'max'				=> '3',			
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Username', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'max' ); ?>"><?php _e('Maximum number of items', 'btp_theme'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'max' ); ?>" name="<?php echo $this->get_field_name( 'max' ); ?>" value="<?php echo $instance['max']; ?>" style="width:100%;" />
		</p>
		
	<?php
	}	
}

/* Function called by action/hook 'widgets_init' */
function btp_init_twitter_widget() {
	register_widget( 'BTP_Twitter_Widget' );
}
add_action( 'widgets_init', 'btp_init_twitter_widget' );
?>