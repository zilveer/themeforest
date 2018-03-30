<?php
/*
Plugin Name: Social Profiles
Version: 1.0
*/

class widget_social_profils extends WP_Widget { 
	
	// Widget Settings
	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'contact',
			// Widget name will appear in UI
			__('Social Profiles', 'jobseek'),
			// Widget description
			array( 'description' => __( 'Display your social profiles', 'jobseek' ), )
		);
	}
	
	// Widget Output
	public function widget($args, $instance) {

		extract($args);

		$title = apply_filters('widget_title', $instance['title']);

		echo($before_widget . $before_title . $title . $after_title);

		if($instance['social_facebook'] || $instance['social_twitter'] || $instance['social_linkedin'] || $instance['social_youtube'] || $instance['social_flickr']):

			if($instance['social_facebook']): ?>
				<a href="<?php echo esc_url($instance['social_facebook']); ?>" class="facebook" title="Facebook" target="_blank"><i class="fa fa-2x fa-facebook-square"></i></a><?php
			endif;

			if($instance['social_twitter']): ?>
				<a href="<?php echo esc_url($instance['social_twitter']); ?>" class="twitter" title="Twitter" target="_blank"><i class="fa fa-2x fa-twitter-square"></i></a><?php
			endif;

			if($instance['social_google']): ?>
				<a href="<?php echo esc_url($instance['social_google']); ?>" class="google" title="Google+" target="_blank"><i class="fa fa-2x fa-google-plus-square"></i></a><?php
			endif;

			if($instance['social_linkedin']): ?>
				<a href="<?php echo esc_url($instance['social_linkedin']); ?>" class="linkedin" title="LinkedIn" target="_blank"><i class="fa fa-2x fa-linkedin-square"></i></a><?php
			endif;

			if($instance['social_youtube']): ?>
				<a href="<?php echo esc_url($instance['social_youtube']); ?>" class="youtube" title="YouTube" target="_blank"><i class="fa fa-2x fa-youtube-square"></i></a><?php
			endif;

			if($instance['social_vimeo']): ?>
				<a href="<?php echo esc_url($instance['social_vimeo']); ?>" class="vimeo" title="Vimeo" target="_blank"><i class="fa fa-2x fa-vimeo-square"></i></a><?php
			endif;

			if($instance['social_instagram']): ?>
				<a href="<?php echo esc_url($instance['social_instagram']); ?>" class="instagram" title="instagram" target="_blank"><i class="fa fa-2x fa-instagram"></i></a><?php
			endif;

			if($instance['social_pinterest']): ?>
				<a href="<?php echo esc_url($instance['social_pinterest']); ?>" class="pinterest" title="Pinterest" target="_blank"><i class="fa fa-2x fa-pinterest-square"></i></a><?php
			endif;

			if($instance['social_flickr']): ?>
				<a href="<?php echo esc_url($instance['social_flickr']); ?>" class="flickr" title="Flickr" target="_blank"><i class="fa fa-2x fa-flickr"></i></a><?php
			endif;

		endif;

		echo($after_widget);
	}

	// Backend Form
	public function form($instance) {
		
		$defaults = array('title' => 'Get In Touch', 'social_facebook' => '', 'social_twitter' => '', 'social_google' => '', 'social_linkedin' => '', 'social_youtube' => '', 'social_vimeo' => '', 'social_instagram' => '', 'social_pinterest' => '', 'social_flickr' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo esc_html( $this->get_field_id('title') ); ?>">Title:</label><br>
			<input class="widefat" style="width: 216px;" id="<?php echo esc_html( $this->get_field_id('title') ); ?>" name="<?php echo esc_html( $this->get_field_name('title') ); ?>" value="<?php echo esc_html( $instance['title'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_html( $this->get_field_id('social_facebook') ); ?>">Facebook URL:</label><br>
			<input class="widefat" style="width: 216px;" id="<?php echo esc_html( $this->get_field_id('social_facebook') ); ?>" name="<?php echo esc_html( $this->get_field_name('social_facebook') ); ?>" value="<?php echo esc_html( $instance['social_facebook'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_html( $this->get_field_id('social_twitter') ); ?>">Twitter URL:</label><br>
			<input class="widefat" style="width: 216px;" id="<?php echo esc_html( $this->get_field_id('social_twitter') ); ?>" name="<?php echo esc_html( $this->get_field_name('social_twitter') ); ?>" value="<?php echo esc_html( $instance['social_twitter'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_html( $this->get_field_id('social_google') ); ?>">Google+ URL:</label><br>
			<input class="widefat" style="width: 216px;" id="<?php echo esc_html( $this->get_field_id('social_google') ); ?>" name="<?php echo esc_html( $this->get_field_name('social_google') ); ?>" value="<?php echo esc_html( $instance['social_google'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_html( $this->get_field_id('social_linkedin') ); ?>">LinkedIn URL:</label><br>
			<input class="widefat" style="width: 216px;" id="<?php echo esc_html( $this->get_field_id('social_linkedin') ); ?>" name="<?php echo esc_html( $this->get_field_name('social_linkedin') ); ?>" value="<?php echo esc_html( $instance['social_linkedin'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_html( $this->get_field_id('social_youtube') ); ?>">YouTube URL:</label><br>
			<input class="widefat" style="width: 216px;" id="<?php echo esc_html( $this->get_field_id('social_youtube') ); ?>" name="<?php echo esc_html( $this->get_field_name('social_youtube') ); ?>" value="<?php echo esc_html( $instance['social_youtube'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_html( $this->get_field_id('social_vimeo') ); ?>">Vimeo URL:</label><br>
			<input class="widefat" style="width: 216px;" id="<?php echo esc_html( $this->get_field_id('social_vimeo') ); ?>" name="<?php echo esc_html( $this->get_field_name('social_vimeo') ); ?>" value="<?php echo esc_html( $instance['social_vimeo'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_html( $this->get_field_id('social_instagram') ); ?>">Instagram URL:</label><br>
			<input class="widefat" style="width: 216px;" id="<?php echo esc_html( $this->get_field_id('social_instagram') ); ?>" name="<?php echo esc_html( $this->get_field_name('social_instagram') ); ?>" value="<?php echo esc_html( $instance['social_instagram'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_html( $this->get_field_id('social_pinterest') ); ?>">Pinterest URL:</label><br>
			<input class="widefat" style="width: 216px;" id="<?php echo esc_html( $this->get_field_id('social_pinterest') ); ?>" name="<?php echo esc_html( $this->get_field_name('social_pinterest') ); ?>" value="<?php echo esc_html( $instance['social_pinterest'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_html( $this->get_field_id('social_flickr') ); ?>">Flickr URL:</label><br>
			<input class="widefat" style="width: 216px;" id="<?php echo esc_html( $this->get_field_id('social_flickr') ); ?>" name="<?php echo esc_html( $this->get_field_name('social_flickr') ); ?>" value="<?php echo esc_html( $instance['social_flickr'] ); ?>">
		</p>
		
    <?php }
	
	// Update
	public function update( $new_instance, $old_instance ) {  
		$instance = $old_instance; 
		
		$instance['title'] = $new_instance['title'];
		$instance['social_facebook'] = $new_instance['social_facebook'];
		$instance['social_twitter'] = $new_instance['social_twitter'];
		$instance['social_google'] = $new_instance['social_google'];
		$instance['social_linkedin'] = $new_instance['social_linkedin'];
		$instance['social_youtube'] = $new_instance['social_youtube'];
		$instance['social_vimeo'] = $new_instance['social_vimeo'];
		$instance['social_instagram'] = $new_instance['social_instagram'];
		$instance['social_pinterest'] = $new_instance['social_pinterest'];
		$instance['social_flickr'] = $new_instance['social_flickr'];

		return $instance;
	}
	
}

add_action('widgets_init',
     create_function('', 'return register_widget("widget_social_profils");')
);