<?php
/*-----------------------------------------------------------------------------------

    Plugin Name: Custom Social Widget
    Plugin URI: http://www.alessioatzeni.com
    Description: A widget that displays your social icon profiles
    Version: 1.0
    Author: Alessio Atzeni
    Author URI: http://www.alessioatzeni.com
-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*  Widget class
/*-----------------------------------------------------------------------------------*/

class az_widget_social extends WP_Widget {
	
	function az_widget_social() {
		// Widget settings
		$widget_ops = array(
			'classname' => 'social_widget', 
			'description' => __('Show your social Profiles.', AZ_THEME_NAME));

		// Create the widget
		parent::__construct('social-widget', __('Social Profiles', AZ_THEME_NAME), $widget_ops);
	}

	function form($instance) {
		$defaults = array(
			'title' => 'Social Profiles',
		);
		
		$instance = wp_parse_args((array) $instance, $defaults);
?>
		
	<p>
		<label><?php __('Title:', AZ_THEME_NAME); ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
	</p>
		
<?php	
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		return $instance;
	}
	
	function widget($args, $instance) {
		
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		
		$output = '';
		
		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title; 
		
		global $socials_profiles;
		$theme_options = get_option('ibuki');
	
		foreach ($socials_profiles as $social_profile):
		
		if( $theme_options[$social_profile.'-url'] )
		{
			echo '<a href="'.$theme_options[$social_profile.'-url'].'" target="_blank"><i class="font-icon-social-'.$social_profile.'"></i></a>';
		}
		
		endforeach;

		
		echo $output;
							
		echo $after_widget;

	}
		
}

add_action( 'widgets_init', 'az_widget_social_init' );

function az_widget_social_init() {
	register_widget('az_widget_social');
}

?>
