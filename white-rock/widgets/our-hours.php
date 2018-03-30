<?php
add_action('widgets_init', 'our_hours_load_widgets');

function our_hours_load_widgets()
{
	register_widget('Our_Hours_Widget');
}

class Our_Hours_Widget extends WP_Widget {
	
	function Our_Hours_Widget()
	{
		$widget_ops = array('classname' => 'hours', 'description' => 'Location Hours.');

		$control_ops = array('id_base' => 'our-hours-widget');

		parent::__construct('our-hours-widget', 'Progression: Business Hours', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$mon_date = $instance['mon_date'];
		$tues_date = $instance['tues_date'];
		$weds_date = $instance['weds_date'];
		$thurs_date = $instance['thurs_date'];
		$fri_date = $instance['fri_date'];
		$sat_date = $instance['sat_date'];
		$sun_date = $instance['sun_date'];

		echo $before_widget;

		if($title) {
			echo  $before_title.$title.$after_title;
		} ?>
			

			<ul id="open-hours">
				<li>
					<div class="date-day grid2column"><h6><?php _e( 'Monday', 'progression' ); ?></h6></div><div class="hours-date grid2column lastcolumn"><?php echo $mon_date; ?></div><div class="clearfix"></div>
				</li>
				<li>
					<div class="date-day grid2column"><h6><?php _e( 'Tuesday', 'progression' ); ?></h6></div><div class="hours-date grid2column lastcolumn"><?php echo $tues_date; ?></div><div class="clearfix"></div>
				</li>
				<li>
					<div class="date-day grid2column"><h6><?php _e( 'Wednesday', 'progression' ); ?></h6></div><div class="hours-date grid2column lastcolumn"><?php echo $weds_date; ?></div><div class="clearfix"></div>
				</li>
				<li>
					<div class="date-day grid2column"><h6><?php _e( 'Thursday', 'progression' ); ?></h6></div><div class="hours-date grid2column lastcolumn"><?php echo $thurs_date; ?></div><div class="clearfix"></div>
				</li>
				<li>
					<div class="date-day grid2column"><h6><?php _e( 'Friday', 'progression' ); ?></h6></div><div class="hours-date grid2column lastcolumn"><?php echo $fri_date; ?></div><div class="clearfix"></div>
				</li>
				<li>
					<div class="date-day grid2column"><h6><?php _e( 'Saturday', 'progression' ); ?></h6></div><div class="hours-date grid2column lastcolumn"><?php echo $sat_date; ?></div><div class="clearfix"></div>
				</li>
				<li>
					<div class="date-day grid2column"><h6><?php _e( 'Sunday', 'progression' ); ?></h6></div><div class="hours-date grid2column lastcolumn"><?php echo $sun_date; ?></div><div class="clearfix"></div>
				</li>
			</ul>
	
		
		
		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['mon_date'] = $new_instance['mon_date'];
		$instance['tues_date'] = $new_instance['tues_date'];
		$instance['weds_date'] = $new_instance['weds_date'];
		$instance['thurs_date'] = $new_instance['thurs_date'];
		$instance['fri_date'] = $new_instance['fri_date'];
		$instance['sat_date'] = $new_instance['sat_date'];
		$instance['sun_date'] = $new_instance['sun_date'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Our Hours', 'mon_date' => '', 'tues_date' => '', 'weds_date' => '', 'thurs_date' => '', 'fri_date' => '', 'sat_date' => '', 'sun_date' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('mon_date'); ?>">Monday Hours:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('mon_date'); ?>" name="<?php echo $this->get_field_name('mon_date'); ?>" value="<?php echo $instance['mon_date']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('tues_date'); ?>">Tuesday Hours:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('tues_date'); ?>" name="<?php echo $this->get_field_name('tues_date'); ?>" value="<?php echo $instance['tues_date']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('weds_date'); ?>">Wednesday Hours:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('weds_date'); ?>" name="<?php echo $this->get_field_name('weds_date'); ?>" value="<?php echo $instance['weds_date']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('thurs_date'); ?>">Thursday Hours:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('thurs_date'); ?>" name="<?php echo $this->get_field_name('thurs_date'); ?>" value="<?php echo $instance['thurs_date']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('fri_date'); ?>">Friday Hours:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('fri_date'); ?>" name="<?php echo $this->get_field_name('fri_date'); ?>" value="<?php echo $instance['fri_date']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('sat_date'); ?>">Saturday Hours:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('sat_date'); ?>" name="<?php echo $this->get_field_name('sat_date'); ?>" value="<?php echo $instance['sat_date']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('sun_date'); ?>">Sunday Hours:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('sun_date'); ?>" name="<?php echo $this->get_field_name('sun_date'); ?>" value="<?php echo $instance['sun_date']; ?>" />
		</p>
		
	<?php
	}
}
?>