<?php

// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'widgets_init', 'gorilla_social_load_widget' );

function gorilla_social_load_widget() {
	register_widget( 'gorilla_social_widget' );
}

class gorilla_social_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		parent::__construct(
			'gorilla_social_widget', // Base ID
			__( 'Alison - Social Icons', 'alison' ), // Name
			array(
				'description' => __( 'A widget that displays your social network', 'alison' ), 
				'classname' => 'gorilla_social_widget',
				'width' => 250,
		    	'height' => 350
			) 
		);
	}

	/**
	 * How to display the widget on the screen.
	 */
	public function widget( $args, $instance ) {
		extract( $args );

		if(empty($instance)){
			$instance = array( 'title' => 'Connect Us', 'facebook' => 'on', 'twitter' => 'on', 'googleplus' => 'on', 'instagram' => 'on','linkedin' => 'on','youtube' => 'on','tumblr' => 'on','googleplus' => 'on','pinterest' => 'on', 'bloglovin' => 'on' );
		}

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$facebook = $instance['facebook'];
		$twitter = $instance['twitter'];
		$googleplus = $instance['googleplus'];
		$instagram = $instance['instagram'];
		$linkedin = $instance['linkedin'];
		$youtube = $instance['youtube'];
		$tumblr = $instance['tumblr'];
		$pinterest = $instance['pinterest'];
		$bloglovin = !$instance['bloglovin'] ? $instance['bloglovin'] : $instance['bloglovin'] = "on" ;
		
		/* Before widget (defined by themes). */
		echo wp_kses($before_widget, wp_kses_allowed_html( 'post' ));

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo wp_kses($before_title, wp_kses_allowed_html( 'post' )) . wp_kses($title, wp_kses_allowed_html( 'post' )) . wp_kses($after_title, wp_kses_allowed_html( 'post' ));

		?>
		
			<div class="widget-social-links">
				<?php if($facebook) : ?><a href="<?php echo get_theme_mod('gorilla_facebook','#'); ?>" target="_blank"><span class="fa fa-facebook"></span></a><?php endif; ?>
				<?php if($twitter) : ?><a href="<?php echo get_theme_mod('gorilla_twitter','#'); ?>" target="_blank"><span class="fa fa-twitter"></span></a><?php endif; ?>
				<?php if($instagram) : ?><a href="<?php echo get_theme_mod('gorilla_instagram','#'); ?>" target="_blank"><span class="fa fa-instagram"></span></a><?php endif; ?>
				<?php if($pinterest) : ?><a href="<?php echo get_theme_mod('gorilla_pinterest','#'); ?>" target="_blank"><span class="fa fa-pinterest"></span></a><?php endif; ?>
				<?php if($linkedin) : ?><a href="<?php echo get_theme_mod('gorilla_linkedin'); ?>" target="_blank"><span class="fa fa-linkedin"></span></a><?php endif; ?>
				<?php if($googleplus) : ?><a href="<?php echo get_theme_mod('gorilla_google'); ?>" target="_blank"><span class="fa fa-google-plus"></span></a><?php endif; ?>
				<?php if($youtube) : ?><a href="<?php echo get_theme_mod('gorilla_youtube'); ?>" target="_blank"><span class="fa fa-youtube"></span></a><?php endif; ?>
				<?php if($tumblr) : ?><a href="<?php echo get_theme_mod('gorilla_tumblr'); ?>" target="_blank"><span class="fa fa-tumblr"></span></a><?php endif; ?>
				<?php if($bloglovin) : ?><a href="<?php echo get_theme_mod('gorilla_bloglovin'); ?>" target="_blank"><span class="fa fa-heart"></span></a><?php endif; ?>
			</div>
			
		<?php

		/* After widget (defined by themes). */
		echo wp_kses($after_widget, wp_kses_allowed_html( 'post' ));
	}

	/**
	 * Update the widget settings.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['facebook'] = strip_tags( $new_instance['facebook'] );
		$instance['twitter'] = strip_tags( $new_instance['twitter'] );
		$instance['googleplus'] = strip_tags( $new_instance['googleplus'] );
		$instance['instagram'] = strip_tags( $new_instance['instagram'] );
		$instance['linkedin'] = strip_tags( $new_instance['linkedin'] );
		$instance['youtube'] = strip_tags( $new_instance['youtube'] );
		$instance['tumblr'] = strip_tags( $new_instance['tumblr'] );
		$instance['pinterest'] = strip_tags( $new_instance['pinterest'] );
		$instance['bloglovin'] = strip_tags( $new_instance['bloglovin'] );

		return $instance;
	}
	

	/**
	 * form in widget update area
	 */
	public function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Connect Us', 'facebook' => 'on', 'twitter' => 'on', 'googleplus' => 'on', 'instagram' => 'on','linkedin' => 'on','youtube' => 'on','tumblr' => 'on','googleplus' => 'on','pinterest' => 'on', 'bloglovin' => 'on' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p><small>You need to define your social accounts in Customizer > Social Media Settings.</small></p>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">Title:</label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:90%;" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>">Facebook:</label>
			<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook' )); ?>" <?php checked( (bool) $instance['facebook'], true ); ?> />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>">Twitter:</label>
			<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter' )); ?>" <?php checked( (bool) $instance['twitter'], true ); ?> />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'instagram' )); ?>">Instagram:</label>
			<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'instagram' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'instagram' )); ?>" <?php checked( (bool) $instance['instagram'], true ); ?> />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'pinterest' )); ?>">Pinterest:</label>
			<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'pinterest' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'pinterest' )); ?>" <?php checked( (bool) $instance['pinterest'], true ); ?> />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'linkedin' )); ?>">Linkedin:</label>
			<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'linkedin' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'linkedin' )); ?>" <?php checked( (bool) $instance['linkedin'], true ); ?> />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'googleplus' )); ?>">Google Plus:</label>
			<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'googleplus' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'googleplus' )); ?>" <?php checked( (bool) $instance['googleplus'], true ); ?> />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'youtube' )); ?>">Youtube:</label>
			<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'youtube' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'youtube' )); ?>" <?php checked( (bool) $instance['youtube'], true ); ?> />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'tumblr' )); ?>">Tumblr:</label>
			<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'tumblr' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'tumblr' )); ?>" <?php checked( (bool) $instance['tumblr'], true ); ?> />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'bloglovin' )); ?>">Bloglovin:</label>
			<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'bloglovin' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'bloglovin' )); ?>" <?php checked( (bool) $instance['bloglovin'], true ); ?> />
		</p>


	<?php
	}
}

?>