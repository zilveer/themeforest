<?php
/*
 * Social Icons
 * 
 * @author 		SamaThemes
 * @category 	Widgets
 * @extends 	WP_Widget
 * @version 1.2.3
 * @update  1.3.1
 */
 
add_action('widgets_init', 'Sama_Widget_Socialicon::register_this_widget');

class Sama_Widget_Socialicon extends WP_Widget {
		
	function __construct() {
	
		$widget_ops = array(
				'classname'   => 'widget_social_icon',
				'description' => esc_html__( 'Social Icon.', 'theme-majesty')
		);
		
		parent::__construct('widget_social_icon', 'SAMA :: '. esc_html__('Social Icon', 'theme-majesty'), $widget_ops);
		
	}
	
	static function register_this_widget () {
		register_widget(__class__);
	}
	
	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget ($args, $instance) {
	
		extract($args);
		
		$title      = apply_filters( 'widget_title', $instance['title'] );
		//$instance['link_target']   	= esc_attr($new_instance['link_target']);
		$output		= '';
		$target = '_self';
		if( isset( $instance['link_target'] ) && $instance['link_target'] ) {
			$target = '_blank';
		}
		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
		
		if ( ! empty( $instance['facebook'] ) ) {
			$output .= '<li><a class="social-facebook" target="'. $target .'" href="'. esc_url( $instance['facebook'] ).'"><i class="fa fa-facebook"></i></a></li>';
		}
		if ( ! empty( $instance['twitter'] ) ) {
			$output .= '<li><a class="social-twitter" target="'. $target .'" href="'. esc_url( $instance['twitter'] ).'"><i class="fa fa-twitter"></i></a></li>';
		}
		if ( ! empty( $instance['dribbble'] ) ) {
			$output .= '<li><a class="social-dribbble" target="'. $target .'" href="'. esc_url( $instance['dribbble'] ) .'"><i class="fa fa-dribbble"></i></a></li>';
		}
		if ( ! empty( $instance['linkedin'] ) ) {
			$output .= '<li><a class="social-linkedin" target="'. $target .'" href="'. esc_url( $instance['linkedin'] ).'"><i class="fa fa-linkedin"></i></a></li>';
		}
		if ( ! empty( $instance['gplus'] ) ) {
			$output .= '<li><a class="social-gplus" target="'. $target .'" href="'. esc_url( $instance['gplus'] ) .'"><i class="fa fa-google-plus"></i></a></li>';
		}
		if ( ! empty( $instance['youtube'] ) ) {
			$output .= '<li><a class="social-youtube" target="'. $target .'" href="'. esc_url( $instance['youtube'] ).'"><i class="fa fa-youtube"></i></a></li>';
		}
		if ( ! empty( $instance['instagram'] ) ) {
			$output .= '<li><a class="social-rss" target="'. $target .'" href="'. esc_url( $instance['instagram'] ).'"><i class="fa fa-instagram"></i></a></li>';
		}
		if ( ! empty( $instance['rss'] ) ) {
			$output .= '<li><a class="social-rss" target="'. $target .'" href="'. esc_url( $instance['rss'] ).'"><i class="fa fa-rss"></i></a></li>';
		}
		
		echo '<ul class="social-network-footer cricle-icons white-icons">'. wp_kses_post($output) .'</ul>';
		echo $after_widget;
	}
	
	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update ($new_instance, $old_instance) {
		$instance 	= $old_instance;
		$instance['title']             	= esc_attr($new_instance['title']);
		$instance['facebook']     	   	= esc_url($new_instance['facebook']);
		$instance['twitter']		   	= esc_url($new_instance['twitter']);
		$instance['dribbble']          	= esc_url($new_instance['dribbble']);
		$instance['linkedin']          	= esc_url($new_instance['linkedin']);
		$instance['gplus']			   	= esc_url($new_instance['gplus']);
		$instance['youtube']          	= esc_url($new_instance['youtube']);
		$instance['rss']          		= esc_url($new_instance['rss']);
		$instance['instagram']          = esc_url($new_instance['instagram']);
		$instance['link_target']   		= esc_attr($new_instance['link_target']);
		return $instance;		
	}
	
	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form ($instance) {
	
		$defaults = array(  
			'title'  		=> '',
			'facebook'		=> '',
			'twitter' 		=> '',
			'dribbble'		=> '',
			'linkedin' 		=> '',
			'gplus'			=> '',
			'youtube'		=> '',
			'rss'			=> '',
			'instagram'		=> '',
			'link_target'  	=> '0',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults);
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'title:', 'theme-majesty'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" size="20" /></p>
		<p><label for="<?php echo $this->get_field_id('facebook'); ?>"><?php esc_html_e( 'Facebook URL:', 'theme-majesty'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('facebook'); ?>" id="<?php echo $this->get_field_id('facebook'); ?>" value="<?php echo esc_attr($instance['facebook']); ?>" size="20" /></p>
		<p><label for="<?php echo $this->get_field_id('twitter'); ?>"><?php esc_html_e( 'Twitter URL:', 'theme-majesty'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('twitter'); ?>" id="<?php echo $this->get_field_id('twitter'); ?>" value="<?php echo esc_attr($instance['twitter']); ?>" size="20" /></p>
		<p><label for="<?php echo $this->get_field_id('dribbble'); ?>"><?php esc_html_e( 'Dribbble URL:', 'theme-majesty'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('dribbble'); ?>" id="<?php echo $this->get_field_id('dribbble'); ?>" value="<?php echo esc_attr($instance['dribbble']); ?>" size="20" /></p>
		<p><label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php esc_html_e( 'Linkedin URL:', 'theme-majesty'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('linkedin'); ?>" id="<?php echo $this->get_field_id('linkedin'); ?>" value="<?php echo esc_attr($instance['linkedin']); ?>" size="20" /></p>
		<p><label for="<?php echo $this->get_field_id('gplus'); ?>"><?php esc_html_e( 'Google plus URL:', 'theme-majesty'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('gplus'); ?>" id="<?php echo $this->get_field_id('gplus'); ?>" value="<?php echo esc_attr($instance['gplus']); ?>" size="20" /></p>
		<p><label for="<?php echo $this->get_field_id('youtube'); ?>"><?php esc_html_e( 'Youtube URL:', 'theme-majesty'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('youtube'); ?>" id="<?php echo $this->get_field_id('youtube'); ?>" value="<?php echo esc_attr($instance['youtube']); ?>" size="20" /></p>
		<p><label for="<?php echo $this->get_field_id('instagram'); ?>"><?php esc_html_e( 'Instagram URL:', 'theme-majesty'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('instagram'); ?>" id="<?php echo $this->get_field_id('instagram'); ?>" value="<?php echo esc_attr($instance['instagram']); ?>" size="20" /></p>
		<p><label for="<?php echo $this->get_field_id('rss'); ?>"><?php esc_html_e( 'RSS URL:', 'theme-majesty'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('rss'); ?>" id="<?php echo $this->get_field_id('rss'); ?>" value="<?php echo esc_attr($instance['rss']); ?>" size="20" /></p>
		<p><input type="checkbox" name="<?php echo $this->get_field_name('link_target'); ?>" id="<?php echo $this->get_field_id('link_target'); ?>" value="1" <?php checked(1,esc_attr($instance['link_target']));?> size="20" /> <label for="<?php echo $this->get_field_id('link_target'); ?>" /><?php esc_html_e('Open link in new window ?', 'theme-majesty'); ?></label></p>
		<p>
	<?php
	}

} // End of class