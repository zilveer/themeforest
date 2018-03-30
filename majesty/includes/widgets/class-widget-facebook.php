<?php
/*
 * Facebook Widget
 * 
 * @author 		SamaThemes
 * @category 	Widgets
 * @extends 	WP_Widget
 * @version 1.0
 */
 
add_action('widgets_init', 'Sama_Widget_FaceBook::register_this_widget');

class Sama_Widget_FaceBook extends WP_Widget {
		
	function __construct() {
	
		$widget_ops = array(
				'classname'   => 'widget_facebook',
				'description' => esc_html__( 'This places a Facebook page Like Box in your sidebar .', 'theme-majesty')
		);
		
		parent::__construct('widget_facebook', 'SAMA :: '. esc_html__('Facebook Like Box', 'theme-majesty'), $widget_ops);
		
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
		
		$title          = apply_filters( 'widget_title', $instance['title'] );
		$facebookID     = $instance['facebookID'];
		$width          = $instance['width'];
		$height         = $instance['height'];
		$connections    = $instance['connect'];
		$showstream     = $instance['showstream'];
		
		if ($showstream) {
			$showstream = (string) 'true';
		} else {
			$showstream = (string) 'false';
		}
		$showheader     = $instance['showheader'];
		if ($showheader) {
			$showheader = (string) 'true';
		} else {
			$showheader = (string) 'false';
		}
		
		echo $before_widget;
		if ($title) { 
			echo $before_title . $title . $after_title;
		}
	?>
		<div class="facebook">
			<iframe src="http://www.facebook.com/plugins/likebox.php?id=<?php echo esc_attr( $facebookID ); ?>&amp;connections=<?php echo absint( $connections); ?>&amp;stream=<?php echo esc_attr( $showstream ); ?>&amp;header=<?php echo absint( $showheader ); ?>&amp;width=<?php echo absint( $width ); ?>&amp;height=<?php echo absint( $height ); ?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo absint( $width ); ?>px; height:<?php echo absint( $height ); ?>px;" allowTransparency="true">
			</iframe>	
		</div>	
	<?php 
	
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
		
		$instance 					= $old_instance;
		$instance['title']          = esc_attr($new_instance['title']);
		$instance['facebookID']     = esc_attr($new_instance['facebookID']);
		$instance['showstream']     = esc_attr($new_instance['showstream']);
		$instance['showheader']     = esc_attr($new_instance['showheader']);
		$instance['connect'] 		= intval($new_instance['connect']);
		if ( intval($new_instance['width']) != 0 ) {
			$instance['width'] = $new_instance['width'];
		}
		if ( intval($new_instance['height']) != 0 ) {
			$instance['height'] = $new_instance['height'];
		}

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
	
		$defaults = array( 'title'=> '', 'facebookID' => '' , 'connect' => '8','width' => '270', 'height' => '260', 'showstream' => '0', 'showheader' => '0');
		
		$instance = wp_parse_args( (array) $instance, $defaults);
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'theme-majesty'); ?> </label>
		<input class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" size="20" /></p>
		<p><label for="<?php echo $this->get_field_id('facebookID'); ?>"><?php esc_html_e( 'Facebook ID:', 'theme-majesty'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('facebookID');?>" id="<?php echo $this->get_field_id('facebookID');?>" value="<?php echo esc_attr($instance['facebookID']);?>" size="7" /></p>
		<p><label for="<?php echo $this->get_field_id('connect'); ?>"><?php esc_html_e( 'Connections:', 'theme-majesty'); ?> </label><input class="widefat" type="text" name="<?php echo $this->get_field_name('connect');?>" id="<?php echo $this->get_field_id('connect');?>" value="<?php echo esc_attr($instance['connect']);?>" size="7" /></p>
		<p><label for="<?php echo $this->get_field_id('width'); ?>"><?php esc_html_e( 'width:', 'theme-majesty'); ?> </label><input type="text" name="<?php echo $this->get_field_name('width');?>" id="<?php echo $this->get_field_id('width');?>" value="<?php echo esc_attr($instance['width']);?>" size="3" /></p>
		<p><label for="<?php echo $this->get_field_id('height'); ?>"><?php esc_html_e( 'height:', 'theme-majesty'); ?> </label><input type="text" name="<?php echo $this->get_field_name('height');?>" id="<?php echo $this->get_field_id('height');?>" value="<?php echo esc_attr($instance['height']);?>" size="3" /></p>
		<p><input type="checkbox" name="<?php echo $this->get_field_name('showstream'); ?>" id="<?php echo $this->get_field_id('showstream'); ?>" value="1" <?php checked(1,esc_attr($instance['showstream']));?> size="20" /> <label for="<?php echo $this->get_field_id('showstream'); ?>" /><?php esc_html_e('Show stream.', 'theme-majesty'); ?></label></p>
		<p><input type="checkbox" name="<?php echo $this->get_field_name('showheader'); ?>" id="<?php echo $this->get_field_id('showheader'); ?>" value="1" <?php checked(1,esc_attr($instance['showheader']));?> size="20" /> <label for="<?php echo $this->get_field_id('showheader'); ?>" /><?php esc_html_e('Show header.', 'theme-majesty'); ?></label></p>
						
	<?php
	}

} // End of class