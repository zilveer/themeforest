<?php
/*
 * Ads Widget
 * 
 * @author 		SamaThemes
 * @category 	Widgets
 * @extends 	WP_Widget
 * @version 1.0
 */
 
add_action('widgets_init', 'Sama_Widget_Ads::register_this_widget');

class Sama_Widget_Ads extends WP_Widget {
		
	function __construct() {
	
		$widget_ops = array(
				'classname'   => 'widget_ads',
				'description' => esc_html__( 'Responsive image Ads.', 'theme-majesty')
		);
		
		parent::__construct('widget_ads', 'SAMA :: '. esc_html__('Ads', 'theme-majesty'), $widget_ops);
		
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
				
		echo $before_widget;		
		
		echo '<div class="widegt-ads"><a href="'. esc_url($instance['link_url']).'" title="'. esc_attr( $instance['link_title'] ).'"><img src="'.esc_url($instance['img_url']).'" alt="'. esc_attr( $instance['img_alt'] ).'" class="img-responsive"></a></div>';
		
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
		$instance['img_url']        = esc_url($new_instance['img_url']);
		$instance['img_alt']     	= esc_attr($new_instance['img_alt']);
		$instance['link_url']     	= esc_url($new_instance['link_url']);
		$instance['link_title']     = esc_attr($new_instance['link_title']);
			 
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
			'img_url'  		=> '',
			'img_alt'		=> '',
			'link_url' 		=> '',
			'link_title' 	=> '',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults);
	?>
		<p><label for="<?php echo $this->get_field_id('img_url'); ?>"><?php esc_html_e( 'Image URL:', 'theme-majesty'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('img_url'); ?>" id="<?php echo $this->get_field_id('img_url'); ?>" value="<?php echo esc_attr($instance['img_url']); ?>" size="20" /></p>
		<p><label for="<?php echo $this->get_field_id('img_alt'); ?>"><?php esc_html_e( 'Image Alt:', 'theme-majesty'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('img_alt'); ?>" id="<?php echo $this->get_field_id('img_alt'); ?>" value="<?php echo esc_attr($instance['img_alt']); ?>" size="20" /></p>
		<p><label for="<?php echo $this->get_field_id('link_url'); ?>"><?php esc_html_e( 'Link URL:', 'theme-majesty'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('link_url'); ?>" id="<?php echo $this->get_field_id('link_url'); ?>" value="<?php echo esc_url($instance['link_url']); ?>" size="20" /></p>
		<p><label for="<?php echo $this->get_field_id('link_title'); ?>"><?php esc_html_e( 'Link Title:', 'theme-majesty'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('link_title'); ?>" id="<?php echo $this->get_field_id('link_title'); ?>" value="<?php echo esc_attr($instance['link_title']); ?>" size="20" /></p>
	<?php
	}

} // End of class