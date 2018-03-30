<?php
class upcoming_classes_widget extends WP_Widget 
{
	/** constructor */
    function upcoming_classes_widget() 
	{
		global $themename;
		$widget_options = array(
			'classname' => 'upcoming_classes_widget',
			'description' => 'Displays upcoming classes scrolling list'
		);

        parent::__construct('gymbase_upcoming_classes', __('Upcoming Classes', 'gymbase'), $widget_options);
    }
	
	/** @see WP_Widget::widget */
    function widget($args, $instance) 
	{
		global $themename;
		global $blog_id;
		global $wpdb;
		extract($args);
		
		//these are our widget options
		$title = isset($instance['title']) ? $instance['title'] : "";
		$title_color = isset($instance['title_color']) ? $instance['title_color'] : "";
		$subtitle = isset($instance['subtitle']) ? $instance['subtitle'] : "";
		$subtitle_color = isset($instance['subtitle_color']) ? $instance['subtitle_color'] : "";
		$count = isset($instance['count']) ? $instance['count'] : "";
		$mode = isset($instance['mode']) ? $instance['mode'] : "";
		$hour_minute_separator = isset($instance['hour_minute_separator']) ? $instance['hour_minute_separator'] : ".";
		$time_mode = isset($instance['time_mode']) ? $instance['time_mode'] : "";
		$timezone = isset($instance['timezone']) ? $instance['timezone'] : "";
		$classes_page = isset($instance['classes_page']) ? $instance['classes_page'] : "";
		$categories = isset($instance['categories']) ? $instance['categories'] : "";
		$background_color = isset($instance['background_color']) ? $instance['background_color'] : "";
		$text_color = isset($instance['text_color']) ? $instance['text_color'] : "";
		$item_border_color = isset($instance['item_border_color']) ? $instance['item_border_color'] : "";

		echo $before_widget;
		
		if($time_mode=="server")
		{
			$phpDayNumber = date('N', current_time('timestamp', ($timezone=="utc" ? 1 : 0)));
			if($phpDayNumber==7)
				$phpDayNumber = 1;
			else
				$phpDayNumber++;
		}		
		$query = "SELECT TIME_FORMAT(t1.start, '%H" . $hour_minute_separator . "%i') AS start, TIME_FORMAT(t1.end, '%H" . $hour_minute_separator . "%i') AS end, t2.post_title, t2.post_name FROM ".$wpdb->prefix."class_hours AS t1 
			LEFT JOIN {$wpdb->posts} AS t2 ON t1.class_id=t2.ID 
			LEFT JOIN {$wpdb->posts} AS t3 ON t1.weekday_id=t3.ID";
		if(!empty($categories))
			$query .= "
				LEFT JOIN $wpdb->term_relationships ON(t2.ID = $wpdb->term_relationships.object_id)
				LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
				LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
				WHERE $wpdb->terms.slug IN ('" . join("','", (array)$categories) . "')
				AND $wpdb->term_taxonomy.taxonomy = 'classes_category'
				AND";
		else
			$query .= "
				WHERE";
		$query .= "
			t2.post_type='classes' 
			AND t2.post_status='publish'
			AND 
			t3.post_type='" . $themename . "_weekdays' 
			AND 
			t3.menu_order=" . ($time_mode=="server" ? $phpDayNumber : "DAYOFWEEK(CURDATE())") . " 
			AND 
			SUBTIME(t1.start, " . ($time_mode=="server" ? "TIME('" . date('H:i:s', current_time('timestamp', ($timezone=="utc" ? 1 : 0))) . "')" : "CURRENT_TIME()") . ")>0
			GROUP BY t1.class_hours_id
			ORDER BY t1.start, t1.end";
		if((int)$count>0)
			$query .= " LIMIT " . $count;
		$class_hours = $wpdb->get_results($query);
		$class_hours_count = count($class_hours);
		$output = '';
		$output .= '<li class="home_box white"' . ($background_color!='' ? ' style="background-color: #' . $background_color . ';"' : '') . '>
			<div class="clearfix">
				<div class="header_left">';
					if($title) 
					{
						if($title_color!="")
							$before_title = str_replace(">", " style='color: #" . $title_color . ";'>",$before_title);
						$output .= $before_title . $title . $after_title;
					}
		$output .= '<h3' . ($subtitle_color!="" ? ' style="color: #' . $subtitle_color . ';"' : '') . '>' . $subtitle . '</h3>
				</div>
				<div class="header_right">
					<a href="#" class="upcoming_class_prev icon_small_arrow left_black"></a>
					<a href="#" class="upcoming_class_next icon_small_arrow right_black"></a>
				</div>
			</div>
			<div class="upcoming_classes_wrapper">';
		if($class_hours_count):
				$output .= '[items_list class="upcoming_classes clearfix"]';
				for($i=0; $i<$class_hours_count; $i++)
				{
					if($mode=="12h")
					{
						$class_hours[$i]->start = date("h" . $hour_minute_separator . "i a", strtotime($class_hours[$i]->start));
						$class_hours[$i]->end = date("h" . $hour_minute_separator . "i a", strtotime($class_hours[$i]->end));
					}
					$output .= '[item' . ($text_color!='' ? ' value_color="' . $text_color . '"' : '') . ($item_border_color!='' ? ' border_color="' . $item_border_color . '"' : '') . ' value="' .  $class_hours[$i]->start . ' - ' .  $class_hours[$i]->end . '"]<a href="' . get_permalink($classes_page) . '#' . urldecode($class_hours[$i]->post_name) . '" title="' . $class_hours[$i]->post_title . '">' . $class_hours[$i]->post_title . '</a>[/item]';
				}
		$output .= '[/items_list]';
		else:
			$output .= '<p class="message">' . __('No upcoming classes for today', 'gymbase') . '</p>';
		endif;
		$output .= '</div>
		</li>';

		echo do_shortcode($output);
        echo $after_widget;
    }
	
	/** @see WP_Widget::update */
    function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = isset($new_instance['title']) ? strip_tags($new_instance['title']) : '';
		$instance['title_color'] = isset($new_instance['title_color']) ? strip_tags($new_instance['title_color']) : '';
		$instance['subtitle'] = isset($new_instance['subtitle']) ? strip_tags($new_instance['subtitle']) : '';
		$instance['subtitle_color'] = isset($new_instance['subtitle_color']) ? strip_tags($new_instance['subtitle_color']) : '';
		$instance['count'] = isset($new_instance['count']) ? strip_tags($new_instance['count']) : '';
		$instance['mode'] = isset($new_instance['mode']) ? strip_tags($new_instance['mode']) : '';
		$instance['hour_minute_separator'] = isset($new_instance['hour_minute_separator']) ? strip_tags($new_instance['hour_minute_separator']) : '';
		$instance['time_mode'] = isset($new_instance['time_mode']) ? strip_tags($new_instance['time_mode']) : '';
		$instance['timezone'] = isset($new_instance['timezone']) ? strip_tags($new_instance['timezone']) : '';
		$instance['classes_page'] = isset($new_instance['classes_page']) ? strip_tags($new_instance['classes_page']) : '';
		$instance['categories'] = isset($new_instance['categories']) ? $new_instance['categories'] : '';
		$instance['background_color'] = isset($new_instance['background_color']) ? strip_tags($new_instance['background_color']) : '';
		$instance['text_color'] = isset($new_instance['text_color']) ? strip_tags($new_instance['text_color']) : '';
		$instance['item_border_color'] = isset($new_instance['item_border_color']) ? strip_tags($new_instance['item_border_color']) : '';
		return $instance;
    }
	
	 /** @see WP_Widget::form */
	function form($instance) 
	{	
		global $themename;
		
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$title_color = isset($instance['title_color']) ? esc_attr($instance['title_color']) : '';
		$subtitle = isset($instance['subtitle']) ? esc_attr($instance['subtitle']) : '';
		$subtitle_color = isset($instance['subtitle_color']) ? esc_attr($instance['subtitle_color']) : '';
		$count = isset($instance['count']) ? esc_attr($instance['count']) : '';
		$mode = isset($instance['mode']) ? esc_attr($instance['mode']) : '';
		$time_mode = isset($instance['time_mode']) ? esc_attr($instance['time_mode']) : '';
		$hour_minute_separator = isset($instance['hour_minute_separator']) ? esc_attr($instance['hour_minute_separator']) : '';
		$timezone = isset($instance['timezone']) ? esc_attr($instance['timezone']) : '';
		$classes_page = isset($instance['classes_page']) ? esc_attr($instance['classes_page']) : '';
		$categories = isset($instance['categories']) ? $instance['categories'] : '';
		$background_color = isset($instance['background_color']) ? esc_attr($instance['background_color']) : '';
		$text_color = isset($instance['text_color']) ? esc_attr($instance['text_color']) : '';
		$item_border_color = isset($instance['item_border_color']) ? esc_attr($instance['item_border_color']) : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('title_color'); ?>"><?php _e('Title color', 'gymbase'); ?></label>
			<input class="widefat color" id="<?php echo $this->get_field_id('title_color'); ?>" name="<?php echo $this->get_field_name('title_color'); ?>" type="text" value="<?php echo $title_color; ?>" data-default-color="FFFFFF" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Subtitle', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo $subtitle; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('subtitle_color'); ?>"><?php _e('Subtitle color', 'gymbase'); ?></label>
			<input class="widefat color" id="<?php echo $this->get_field_id('subtitle_color'); ?>" name="<?php echo $this->get_field_name('subtitle_color'); ?>" type="text" value="<?php echo $subtitle_color; ?>" data-default-color="FFFFFF" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Count', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('mode'); ?>"><?php _e('Mode', 'gymbase'); ?></label>
			<select name="<?php echo $this->get_field_name('mode'); ?>">
				<option value="24h"<?php echo ($mode=="24h" ? " selected='selected'" : ""); ?>><?php _e('24h', 'gymbase'); ?></option>
				<option value="12h"<?php echo ($mode=="12h" ? " selected='selected'" : ""); ?>><?php _e('12h', 'gymbase'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('hour_minute_separator'); ?>"><?php _e('Hour minute separator', 'gymbase'); ?></label>
			<select name="<?php echo $this->get_field_name('hour_minute_separator'); ?>">
				<option value="."<?php echo ($hour_minute_separator=="." ? " selected='selected'" : ""); ?>><?php _e('.', 'gymbase'); ?></option>
				<option value=":"<?php echo ($hour_minute_separator==":" ? " selected='selected'" : ""); ?>><?php _e(':', 'gymbase'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('time_mode'); ?>"><?php _e('Time from', 'gymbase'); ?></label>
			<select id="upcoming_classes_time_from" name="<?php echo $this->get_field_name('time_mode'); ?>">
				<option value="server"<?php echo ($time_mode=="server" ? " selected='selected'" : ""); ?>><?php _e('server', 'gymbase'); ?></option>
				<option value="database"<?php echo ($time_mode=="database" ? " selected='selected'" : ""); ?>><?php _e('database', 'gymbase'); ?></option>
			</select>
		</p>
		<p class="upcoming_classes_timezone_row" <?php echo ($time_mode=="database" ? " style='display: none;'" : ""); ?>>
			<label for="<?php echo $this->get_field_id('timezone'); ?>"><?php _e('Timezone', 'gymbase'); ?></label>
			<select name="<?php echo $this->get_field_name('timezone'); ?>">
				<option value="localtime"<?php echo ($timezone=="localtime" ? " selected='selected'" : ""); ?>><?php _e('localtime', 'gymbase'); echo " (now: " .  date('H:i:s', current_time('timestamp')) . ")"; ?></option>
				<option value="utc"<?php echo ($timezone=="utc" ? " selected='selected'" : ""); ?>><?php _e('utc', 'gymbase'); echo " (now: " .  date('H:i:s', current_time('timestamp', 1)) . ")"; ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('classes_page'); ?>"><?php _e('Classes Page', 'gymbase'); ?></label>
			<select id="<?php echo $this->get_field_id('classes_page'); ?>" name="<?php echo $this->get_field_name('classes_page'); ?>">
				<?php
				$args = array(
					'post_type' => 'page',
					'post_status' => 'publish',
					'posts_per_page' => -1,
					'orderby' => 'title', 
					'order' => 'ASC',
					'suppress_filters' => true
				);
				query_posts($args);
				if(have_posts()) : while (have_posts()) : the_post();
					global $post;
				?>
					<option <?php echo ($classes_page==get_the_ID() ? ' selected="selected"':'');?> value='<?php the_ID(); ?>'><?php the_title(); ?></option>
				<?php
				endwhile;
				endif;
				wp_reset_query();
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e('Categories', 'gymbase'); ?></label>
			<select multiple="multiple" id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>[]">
			<?php
			$classes_categories = get_terms("classes_category");
			foreach($classes_categories as $classes_category)
			{
			?>
				<option <?php echo (is_array($categories) && in_array($classes_category->slug, $categories) ? ' selected="selected"':'');?> value='<?php echo $classes_category->slug;?>'><?php echo $classes_category->name; ?></option>
			<?php
			}
			?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('background_color'); ?>"><?php _e('Background color', 'gymbase'); ?></label>
			<input class="widefat color" id="<?php echo $this->get_field_id('background_color'); ?>" name="<?php echo $this->get_field_name('background_color'); ?>" type="text" value="<?php echo $background_color; ?>" data-default-color="FFFFFF" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('text_color'); ?>"><?php _e('Text color', 'gymbase'); ?></label>
			<input class="widefat color" id="<?php echo $this->get_field_id('text_color'); ?>" name="<?php echo $this->get_field_name('text_color'); ?>" type="text" value="<?php echo $text_color; ?>" data-default-color="FFFFFF" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('item_border_color'); ?>"><?php _e('Item border color', 'gymbase'); ?></label>
			<input class="widefat color" id="<?php echo $this->get_field_id('item_border_color'); ?>" name="<?php echo $this->get_field_name('item_border_color'); ?>" type="text" value="<?php echo $item_border_color; ?>" data-default-color="FFFFFF" />
		</p>
		<script type="text/javascript">
		jQuery(document).ready(function($){
			$("[id$='<?php echo $this->id; ?>'] .color").ColorPicker({
				onChange: function(hsb, hex, rgb, el) {
					$(el).val(hex);
				},
				onSubmit: function(hsb, hex, rgb, el){
					$(el).val(hex);
					$(el).ColorPickerHide();
				},
				onBeforeShow: function (){
					var color = (this.value!="" ? this.value : $(this).attr("data-default-color"));
					console.log(color);
					$(this).ColorPickerSetColor(color);
				}
			}).on('keyup', function(event, param){
				$(this).ColorPickerSetColor(this.value);
			});
		});
		</script>
		<?php
	}
}
//register widget
add_action('widgets_init', create_function('', 'return register_widget("upcoming_classes_widget");'));
?>