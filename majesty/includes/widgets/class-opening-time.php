<?php
/*
 * Facebook Widget
 * 
 * @author 		SamaThemes
 * @category 	Widgets
 * @extends 	WP_Widget
 * @version 1.0
 */
 
add_action('widgets_init', 'Sama_Widget_Openingtimes::register_this_widget');

class Sama_Widget_Openingtimes extends WP_Widget {
		
	function __construct() {
	
		$widget_ops = array(
				'classname'   => 'widget_opening_times',
				'description' => esc_html__( 'Opening Times.', 'theme-majesty')
		);
		$control_ops = array( 'width' => 500, 'height' => 450, 'id_base' => 'widget_opening_times' );
		parent::__construct('widget_opening_times', 'SAMA :: '. esc_html__('Opening Times.', 'theme-majesty'), $widget_ops);
		
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
		global $majesty_allowed_tags;
		
		extract($args);
		
		$title          = apply_filters( 'widget_title', $instance['title'] );
		$all_days = array();
		for ($i = 1; $i <= 7; $i++) {
			$day = array(
				'name' 	=> $instance['day-'.$i],
				'time' 	=> $instance['day-'. $i .'-t'],
				'close' => $instance['day-'. $i .'-x'],
			);
			$all_days[] = $day; 
		}
		
		echo $before_widget;
		if ($title) { 
			echo $before_title . $title . $after_title;
		}
		$output = '';
		foreach( $all_days as $day ) {
			if( ! empty( $day['name'] ) ) {
				if( $day['close'] ) {
					$output .= '<li><p>'.esc_attr( $day['name'] ) .'<span class="label label-default">'. esc_attr( $day['time'] ) .'</span></p></li>';
				} else {
					$output .= '<li><p>'.esc_attr( $day['name'] ) .'<span>'. esc_attr( $day['time'] ) .'</span></p></li>';
				}
			}
		}
		
		echo '<div class="opening_time"><ul>'. wp_kses( $output, $majesty_allowed_tags ) .'</ul></div>';
	
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
		$instance['day-1']    		= esc_attr($new_instance['day-1']);
		$instance['day-2']     		= esc_attr($new_instance['day-2']);
		$instance['day-3']     		= esc_attr($new_instance['day-3']);
		$instance['day-4']     		= esc_attr($new_instance['day-4']);
		$instance['day-5']     		= esc_attr($new_instance['day-5']);
		$instance['day-6']     		= esc_attr($new_instance['day-6']);
		$instance['day-7']     		= esc_attr($new_instance['day-7']);
		$instance['day-1-t']     	= esc_attr($new_instance['day-1-t']);
		$instance['day-2-t']     	= esc_attr($new_instance['day-2-t']);
		$instance['day-3-t']     	= esc_attr($new_instance['day-3-t']);
		$instance['day-4-t']     	= esc_attr($new_instance['day-4-t']);
		$instance['day-5-t']     	= esc_attr($new_instance['day-5-t']);
		$instance['day-6-t']     	= esc_attr($new_instance['day-6-t']);
		$instance['day-7-t']     	= esc_attr($new_instance['day-7-t']);
		$instance['day-1-x']     	= esc_attr($new_instance['day-1-x']);
		$instance['day-2-x']     	= esc_attr($new_instance['day-2-x']);
		$instance['day-3-x']     	= esc_attr($new_instance['day-3-x']);
		$instance['day-4-x']     	= esc_attr($new_instance['day-4-x']);
		$instance['day-5-x']     	= esc_attr($new_instance['day-5-x']);
		$instance['day-6-x']     	= esc_attr($new_instance['day-6-x']);
		$instance['day-7-x']     	= esc_attr($new_instance['day-7-x']);

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
			'day-1'			=> 'Monday',
			'day-2'			=> 'Tuesday',
			'day-3'			=> 'Wednesday',
			'day-4'			=> 'Thursday',
			'day-5'			=> 'Friday',
			'day-6'			=> 'Saturday',
			'day-7'			=> 'Sunday',
			'day-1-t'		=> '1 pm - 10 pm',
			'day-2-t'		=> '1 pm - 10 pm',
			'day-3-t'		=> '1 pm - Midnight',
			'day-4-t'		=> '1 pm - 10 pm',
			'day-5-t'		=> '1 pm - Midnight',
			'day-6-t'		=> 'Closed',
			'day-7-t'		=> '1 pm - 10 pm',
			'day-1-x'		=> 0,
			'day-2-x'		=> 0,
			'day-3-x'		=> 0,
			'day-4-x'		=> 0,
			'day-5-x'		=> 0,
			'day-6-x'		=> 1,
			'day-7-x'		=> 0,
		);
		$instance = wp_parse_args( (array) $instance, $defaults);
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'theme-majesty'); ?> </label>
		<input class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" size="20" /></p>
		<table class="table">
			<thead>
                <tr>
                  <th><?php esc_html_e('Day', 'theme-majesty'); ?></th>
                  <th><?php esc_html_e('Opening time', 'theme-majesty'); ?></th>
                  <th><?php esc_html_e('Close day', 'theme-majesty'); ?></th>
                </tr>
            </thead>
			<tbody>
				<tr>
					<td>
						<input class="widefat" type="text" name="<?php echo $this->get_field_name('day-1');?>" id="<?php echo $this->get_field_id('day-1');?>" value="<?php echo esc_attr($instance['day-1']);?>" />
					</td>
					<td>
						<input class="widefat" type="text" name="<?php echo $this->get_field_name('day-1-t');?>" id="<?php echo $this->get_field_id('day-1-t');?>" value="<?php echo esc_attr($instance['day-1-t']);?>" />
					</td>
					<td>
						<input type="checkbox" name="<?php echo $this->get_field_name('day-1-x'); ?>" id="<?php echo $this->get_field_id('day-1-x'); ?>" value="1" <?php checked(1,esc_attr($instance['day-1-x']));?> />
					</td>
                </tr>
				<tr>
					<td>
						<input class="widefat" type="text" name="<?php echo $this->get_field_name('day-2');?>" id="<?php echo $this->get_field_id('day-2');?>" value="<?php echo esc_attr($instance['day-2']);?>" />
					</td>
					<td>
						<input class="widefat" type="text" name="<?php echo $this->get_field_name('day-2-t');?>" id="<?php echo $this->get_field_id('day-2-t');?>" value="<?php echo esc_attr($instance['day-2-t']);?>" />
					</td>
					<td>
						<input type="checkbox" name="<?php echo $this->get_field_name('day-2-x'); ?>" id="<?php echo $this->get_field_id('day-2-x'); ?>" value="1" <?php checked(1,esc_attr($instance['day-2-x']));?> />
					</td>
                </tr>
				<tr>
					<td>
						<input class="widefat" type="text" name="<?php echo $this->get_field_name('day-3');?>" id="<?php echo $this->get_field_id('day-3');?>" value="<?php echo esc_attr($instance['day-3']);?>" />
					</td>
					<td>
						<input class="widefat" type="text" name="<?php echo $this->get_field_name('day-3-t');?>" id="<?php echo $this->get_field_id('day-3-t');?>" value="<?php echo esc_attr($instance['day-3-t']);?>" />
					</td>
					<td>
						<input type="checkbox" name="<?php echo $this->get_field_name('day-3-x'); ?>" id="<?php echo $this->get_field_id('day-3-x'); ?>" value="1" <?php checked(1,esc_attr($instance['day-3-x']));?> />
					</td>
                </tr>
				<tr>
					<td>
						<input class="widefat" type="text" name="<?php echo $this->get_field_name('day-4');?>" id="<?php echo $this->get_field_id('day-4');?>" value="<?php echo esc_attr($instance['day-4']);?>" />
					</td>
					<td>
						<input class="widefat" type="text" name="<?php echo $this->get_field_name('day-4-t');?>" id="<?php echo $this->get_field_id('day-4-t');?>" value="<?php echo esc_attr($instance['day-4-t']);?>" />
					</td>
					<td>
						<input type="checkbox" name="<?php echo $this->get_field_name('day-4-x'); ?>" id="<?php echo $this->get_field_id('day-4-x'); ?>" value="1" <?php checked(1,esc_attr($instance['day-4-x']));?> />
					</td>
                </tr>
				<tr>
					<td>
						<input class="widefat" type="text" name="<?php echo $this->get_field_name('day-5');?>" id="<?php echo $this->get_field_id('day-5');?>" value="<?php echo esc_attr($instance['day-5']);?>" />
					</td>
					<td>
						<input class="widefat" type="text" name="<?php echo $this->get_field_name('day-5-t');?>" id="<?php echo $this->get_field_id('day-5-t');?>" value="<?php echo esc_attr($instance['day-5-t']);?>" />
					</td>
					<td>
						<input type="checkbox" name="<?php echo $this->get_field_name('day-5-x'); ?>" id="<?php echo $this->get_field_id('day-5-x'); ?>" value="1" <?php checked(1,esc_attr($instance['day-5-x']));?> />
					</td>
                </tr>
				<tr>
					<td>
						<input class="widefat" type="text" name="<?php echo $this->get_field_name('day-6');?>" id="<?php echo $this->get_field_id('day-6');?>" value="<?php echo esc_attr($instance['day-6']);?>" />
					</td>
					<td>
						<input class="widefat" type="text" name="<?php echo $this->get_field_name('day-6-t');?>" id="<?php echo $this->get_field_id('day-6-t');?>" value="<?php echo esc_attr($instance['day-6-t']);?>" />
					</td>
					<td>
						<input type="checkbox" name="<?php echo $this->get_field_name('day-6-x'); ?>" id="<?php echo $this->get_field_id('day-6-x'); ?>" value="1" <?php checked(1,esc_attr($instance['day-6-x']));?> />
					</td>
                </tr>
				<tr>
					<td>
						<input class="widefat" type="text" name="<?php echo $this->get_field_name('day-7');?>" id="<?php echo $this->get_field_id('day-7');?>" value="<?php echo esc_attr($instance['day-7']);?>" />
					</td>
					<td>
						<input class="widefat" type="text" name="<?php echo $this->get_field_name('day-7-t');?>" id="<?php echo $this->get_field_id('day-7-t');?>" value="<?php echo esc_attr($instance['day-7-t']);?>" />
					</td>
					<td>
						<input type="checkbox" name="<?php echo $this->get_field_name('day-7-x'); ?>" id="<?php echo $this->get_field_id('day-7-x'); ?>" value="1" <?php checked(1,esc_attr($instance['day-7-x']));?> />
					</td>
                </tr>
			</tbody>
		</table>					
	<?php
	}

} // End of class