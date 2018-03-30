<?php

class AZ_Widget_Dribbble extends WP_Widget {
	
	function AZ_Widget_Dribbble() {

		$widget_ops = array(
			'classname' => 'az_widget_dribbble',
			'description' => __('Use this widget to display your Dribbble shots.', AZ_THEME_NAME)
		);
		$control_ops = array('id_base' => 'az_widget_dribbble');
		parent::__construct('az_widget_dribbble', __('Custom Dribbble Widget', AZ_THEME_NAME), $widget_ops, $control_ops);
		
	}
		
	function widget($args, $instance) {

		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		$dribbble_ID = $instance['dribbble_ID'];
		$limit = $instance['limit'];

		echo $before_widget;

		if ($title) {
			echo $before_title . $title . $after_title;
		}

		?>
			
		<div class="dribbble-widget">
        	<ul class="az_dribbble_widget">

			<script type="text/javascript">
				jQuery(function($){
					var $i = 1;
					$.getJSON("http://api.dribbble.com/players/<?php echo $dribbble_ID; ?>/shots?callback=?", function(data) {
						$.each(data.shots, function(index, shot) {
							if(index < <?php echo $limit; ?>) {
								$(".az_dribbble_widget").append("<li class='item-" + $i + "'><a class='dribbble-item" + "' href='" + shot.image_url + "'><img src='" + shot.image_teaser_url + "'></a></li>");
								$i++;
							}
						});
					});
				});
			</script>
            
			</ul>
		</div>
		
		<?php
		echo $after_widget;
		
	}

	function update($new_instance, $old_instance) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['dribbble_ID'] = strip_tags($new_instance['dribbble_ID']);
		$instance['limit'] = $new_instance['limit'];
		return $instance;

	}

	function form($instance) {

		$defaults = array(
			'title' => 'Dribbble Widget',
			'dribbble_ID' => '',
			'limit' => '8'
		);
		
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', AZ_THEME_NAME) ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('dribbble_ID'); ?>"><?php _e('Dribbble Username:', AZ_THEME_NAME) ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('dribbble_ID'); ?>" name="<?php echo $this->get_field_name('dribbble_ID'); ?>" value="<?php echo $instance['dribbble_ID']; ?>">
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Number of Shots:', AZ_THEME_NAME) ?></label>
			<select id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" class="widefat">
                <option <?php if ('1' == $instance['limit']) { echo 'selected="selected"'; } ?>>1</option>
                <option <?php if ('2' == $instance['limit']) { echo 'selected="selected"'; } ?>>2</option>
                <option <?php if ('3' == $instance['limit']) { echo 'selected="selected"'; } ?>>3</option>
                <option <?php if ('4' == $instance['limit']) { echo 'selected="selected"'; } ?>>4</option>
                <option <?php if ('5' == $instance['limit']) { echo 'selected="selected"'; } ?>>5</option>
                <option <?php if ('6' == $instance['limit']) { echo 'selected="selected"'; } ?>>6</option>
                <option <?php if ('7' == $instance['limit']) { echo 'selected="selected"'; } ?>>7</option>
                <option <?php if ('8' == $instance['limit']) { echo 'selected="selected"'; } ?>>8</option>
                <option <?php if ('9' == $instance['limit']) { echo 'selected="selected"'; } ?>>9</option>
                <option <?php if ('10' == $instance['limit']) { echo 'selected="selected"'; } ?>>10</option>
                <option <?php if ('11' == $instance['limit']) { echo 'selected="selected"'; } ?>>11</option>
                <option <?php if ('12' == $instance['limit']) { echo 'selected="selected"'; } ?>>12</option>
                <option <?php if ('13' == $instance['limit']) { echo 'selected="selected"'; } ?>>13</option>
                <option <?php if ('14' == $instance['limit']) { echo 'selected="selected"'; } ?>>14</option>
                <option <?php if ('15' == $instance['limit']) { echo 'selected="selected"'; } ?>>15</option>
                <option <?php if ('16' == $instance['limit']) { echo 'selected="selected"'; } ?>>16</option>
                <option <?php if ('17' == $instance['limit']) { echo 'selected="selected"'; } ?>>17</option>
                <option <?php if ('18' == $instance['limit']) { echo 'selected="selected"'; } ?>>18</option>
                <option <?php if ('19' == $instance['limit']) { echo 'selected="selected"'; } ?>>19</option>
                <option <?php if ('20' == $instance['limit']) { echo 'selected="selected"'; } ?>>20</option>
			</select>
		</p>
			
	<?php
	}
}

add_action('widgets_init', 'az_dribbble_widget');

function az_dribbble_widget() {
	register_widget('AZ_Widget_Dribbble');
}