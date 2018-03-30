<?php
/**
 * Social Icons Widget
 *
 * @description: A simple widget to display icons from your social profiles.
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

// The widget class
class sd_social_icons_widget extends WP_Widget {
	
	// Widget Settings
	function sd_social_icons_widget() {
	
		$widget_ops = array( 'classname' => 'sd_social_icons_widget', 'description' => __( 'A widget that displays icons from your social profiles.', 'sd-framework' ) );
		$control_ops = "";
		parent::__construct( 'sd_social_icons_widget', __( 'Social Icons', 'sd-framework' ), $widget_ops, $control_ops );
	}
	
	// Widget Output
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		// Before the widget
		echo $before_widget;

		// Display the widget title if one was input
		if ( $title )
		echo $before_title . $title . $after_title;
		?>
		<ul class="sd-social-icons-widget">
			<?php if ( !empty( $instance['phone'] ) ) : ?>
				<li class="sd-social-widget-phone"><i class="fa fa-phone"></i> <?php echo $instance['phone']; ?></li>
			<?php endif; ?>
			<?php if ( !empty( $instance['email'] ) ) : ?>
				<li class="sd-social-widget-email"><a class="sd-link-trans" href="mailto:<?php echo esc_attr( $instance['email'] ); ?>" title="<?php echo esc_attr( $instance['email'] ); ?>" rel="nofollow"><i class="fa fa-envelope-o"></i> <?php echo $instance['email']; ?></a> </li>
			<?php endif; ?>
			<?php if ( !empty( $instance['facebook'] ) ) : ?>
				<li class="sd-social-widget-facebook"><a class="sd-link-trans" href="<?php echo esc_url( $instance['facebook'] ); ?>" title="<?php echo esc_attr( $instance['facebook'] ); ?>" rel="nofollow" target="_blank"><i class="fa fa-facebook"></i></a></li>
			<?php endif; ?>
			<?php if ( !empty( $instance['twitter'] ) ) : ?>
				<li class="sd-social-widget-twitter"><a class="sd-link-trans" href="<?php echo esc_url( $instance['twitter'] ); ?>" title="<?php echo esc_attr( $instance['twitter'] ); ?>" rel="nofollow" target="_blank"><i class="fa fa-twitter"></i></a></li>
			<?php endif; ?>
			<?php if ( !empty( $instance['linkedin'] ) ) : ?>
				<li class="sd-social-widget-linkedin"><a class="sd-link-trans" href="<?php echo esc_url( $instance['linkedin'] ); ?>" title="<?php echo esc_attr( $instance['linkedin'] ); ?>" rel="nofollow" target="_blank"><i class="fa fa-linkedin"></i></a></li>
			<?php endif; ?>
			<?php if ( !empty( $instance['googleplus'] ) ) : ?>
				<li class="sd-social-widget-googleplus"><a class="sd-link-trans" href="<?php echo esc_url( $instance['googleplus'] ); ?>" title="<?php echo esc_attr( $instance['googleplus'] ); ?>" rel="nofollow" target="_blank"><i class="fa fa-google-plus"></i></a></li>
			<?php endif; ?>
			<?php if ( !empty( $instance['youtube'] ) ) : ?>
				<li class="sd-social-widget-youtube"><a class="sd-link-trans" href="<?php echo esc_url( $instance['youtube'] ); ?>" title="<?php echo esc_attr( $instance['youtube'] ); ?>" rel="nofollow" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
			<?php endif; ?>
			<?php if ( !empty( $instance['vimeo'] ) ) : ?>
				<li class="sd-social-widget-vimeo"><a class="sd-link-trans" href="<?php echo esc_url( $instance['vimeo'] ); ?>" title="<?php echo esc_attr( $instance['vimeo'] ); ?>" rel="nofollow" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>
			<?php endif; ?>
			<?php if ( !empty($instance['pinterest'] ) ) : ?>
				<li class="sd-social-widget-pinterest"><a class="sd-link-trans" href="<?php echo esc_url( $instance['pinterest'] ); ?>" title="<?php echo esc_attr( $instance['pinterest'] ); ?>" rel="nofollow" target="_blank"><i class="fa fa-pinterest"></i></a></li>
			<?php endif; ?>
			<?php if ( !empty( $instance['instagram'] ) ) : ?>
				<li class="sd-social-widget-instagram"><a class="sd-link-trans" href="<?php echo esc_url( $instance['instagram'] ); ?>" title="<?php echo esc_attr( $instance['instagram'] ); ?>" rel="nofollow" target="_blank"><i class="fa fa-instagram"></i></a></li>
			<?php endif; ?>
			<?php if ( !empty( $instance['flickr'] ) ) : ?>
				<li class="sd-social-widget-flickr"><a class="sd-link-trans" href="<?php echo esc_url( $instance['flickr'] ); ?>" title="<?php echo esc_attr( $instance['flickr'] ); ?>" rel="nofollow" target="_blank"><i class="fa fa-flickr"></i></a></li>
			<?php endif; ?>
			<?php if ( !empty( $instance['rss'] ) ) : ?>
				<li class="sd-social-widget-rss"><a class="sd-link-trans" href="<?php echo esc_url( $instance['rss'] ); ?>" title="<?php echo esc_attr( $instance['rss'] ); ?>" rel="nofollow" target="_blank"><i class="fa fa-rss"></i></a></li>
			<?php endif; ?>
		</ul>
		<?php 
		// After the widget
		echo $after_widget;
	}
	// Update the widget		
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['phone'] = strip_tags( $new_instance['phone'] );
		$instance['email'] = strip_tags( $new_instance['email'] );
		$instance['facebook'] = strip_tags( $new_instance['facebook'] );
		$instance['twitter'] = strip_tags( $new_instance['twitter'] );
		$instance['linkedin'] = strip_tags( $new_instance['linkedin'] );
		$instance['googleplus'] = strip_tags( $new_instance['googleplus'] );
		$instance['youtube'] = strip_tags( $new_instance['youtube'] );
		$instance['vimeo'] = strip_tags( $new_instance['vimeo'] );
		$instance['pinterest'] = strip_tags( $new_instance['pinterest'] );
		$instance['instagram'] = strip_tags( $new_instance['instagram'] );
		$instance['flickr'] = strip_tags( $new_instance['flickr'] );
		$instance['rss'] = strip_tags( $new_instance['rss'] );

		return $instance;
	}

	// Widget panel settings
	function form( $instance ) {

	// Default widgets settings
		$defaults = array(
		'title' => 'Get Social',
		'phone' => '',
		'email' => '',
		'facebook' => 'https://www.facebook.com/skatdesign',
		'twitter' => 'https://twitter.com/skatdesign',
		'linkedin' => 'http://www.linkedin.com/in/skatdesign',
		'googleplus' => 'https://plus.google.com/u/0/b/116008836048520090738/116008836048520090738/posts',
		'youtube' => 'https://www.youtube.com/zabestof',
		'vimeo' => '',
		'pinterest' => 'http://pinterest.com/skatdesign',
		'instagram' => '',
		'flickr' => '',
		'rss' => 'http://feeds.feedburner.com/skatdesign'
		);
		$instance = wp_parse_args( ( array ) $instance, $defaults ); ?>
		
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'sd-framework' ) ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Phone #:', 'sd-framework' ) ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" value="<?php echo $instance['phone']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'E-Mail:', 'sd-framework' ) ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>" />
		</p>
		<!-- Facebook: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook Url:', 'sd-framework' ) ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" />
		</p>
		<!-- Twitter: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter Url:', 'sd-framework' ) ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" />
		</p>
		<!-- LinkedIn: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e( 'LinkedIn Url:', 'sd-framework' ) ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo $instance['linkedin']; ?>" />
		</p>
		<!-- Google Plus: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'googleplus' ); ?>"><?php _e( 'Google Plus Url:', 'sd-framework' ) ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'googleplus' ); ?>" name="<?php echo $this->get_field_name( 'googleplus' ); ?>" value="<?php echo $instance['googleplus']; ?>" />
		</p>
		<!-- Youtube: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'Youtube Url:', 'sd-framework' ) ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo $instance['youtube']; ?>" />
		</p>
		<!-- Vimeo: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'vimeo' ); ?>"><?php _e( 'Vimeo Url:', 'sd-framework' ) ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" value="<?php echo $instance['vimeo']; ?>" />
		</p>
		<!-- Pinterest: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php _e( 'Pinterest Url:', 'sd-framework' ) ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" value="<?php echo $instance['pinterest']; ?>" />
		</p>
		<!-- Instagram: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e( 'Instagram Url:', 'sd-framework' ) ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" value="<?php echo $instance['instagram']; ?>" />
		</p>
		<!-- Flickr: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'flickr' ); ?>"><?php _e( 'Flickr Url:', 'sd-framework' ) ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" value="<?php echo $instance['flickr']; ?>" />
		</p>
		<!-- RSS: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'rss' ); ?>"><?php _e( 'RSS Url:', 'sd-framework' ) ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php echo $instance['rss']; ?>" />
		</p>


	<?php
	}
}
// Register and load the widget
function sd_social_icons_widget() {
	register_widget( 'sd_social_icons_widget' );
}
add_action( 'widgets_init', 'sd_social_icons_widget' );
?>