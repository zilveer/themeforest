<?php
class departments_widget extends WP_Widget 
{
	/** constructor */
    function departments_widget() 
	{
		global $themename;
		$widget_options = array(
			'classname' => 'departments_widget',
			'description' => 'Displays Departments Accordion'
		);
		$control_options = array('width' => 460);
        parent::__construct('medicenter_departments', __('Departments Accordion', 'medicenter'), $widget_options, $control_options);
    }
	
	/** @see WP_Widget::widget */
    function widget($args, $instance) 
	{
		global $themename;
        extract($args);

		//these are our widget options
		$title = isset($instance['title']) ? $instance['title'] : "";
		$animation = isset($instance['animation']) ? $instance['animation'] : "";
		$order = isset($instance['order']) ? $instance['order'] : "";
		$categories = isset($instance['categories']) ? $instance['categories'] : "";
		$departments_page = isset($instance['departments_page']) ? $instance['departments_page'] : "";
		$timetable_page = isset($instance['timetable_page']) ? $instance['timetable_page'] : "";
		$active = isset($instance['active']) ? $instance['active'] : "";
		$tab_color = (isset($instance['tab_custom_color']) && $instance['tab_custom_color']!="" ? $instance['tab_custom_color'] : $instance['tab_color']);
		$tab_icon_color = "";
		if($tab_color=="3156a3" || $tab_color=="0384ce" || $tab_color=="42b3e5")
			$tab_icon_color = "blue";
		else if($tab_color=="43a140" || $tab_color=="008238" || $tab_color=="7cba3d")
			$tab_icon_color = "green";
		else if($tab_color=="f17800" || $tab_color=="cb451b" || $tab_color=="ffa800")
			$tab_icon_color = "orange";
		else if($tab_color=="db5237" || $tab_color=="c03427" || $tab_color=="f37548")
			$tab_icon_color = "red";
		else if($tab_color=="0097b5" || $tab_color=="006688" || $tab_color=="00b6cc")
			$tab_icon_color = "turquoise";
		else if($tab_color=="6969b3" || $tab_color=="3e4c94" || $tab_color=="9187c4")
			$tab_icon_color = "violet";
		$button_color = (!empty($instance['button_custom_color']) ? $instance['button_custom_color'] : $instance['button_color']);
		$button_hover_color = (!empty($instance['button_hover_custom_color']) ? $instance['button_hover_custom_color'] : $instance['button_hover_color']);
		$button_border_color = $button_color;
		$button_hover_border_color = $button_hover_color;
		$button_text_color = isset($instance['button_text_color']) ? $instance['button_text_color'] : "";
		$button_hover_text_color = isset($instance['button_hover_text_color']) ? $instance['button_hover_text_color'] : "";

		echo $before_widget;
		
		query_posts(array( 
			'post_type' => 'departments',
			'posts_per_page' => '-1',
			'post_status' => 'publish',
			'orderby' => 'menu_order', 
			'order' => $order,
			'departments_category' => implode(",", (array)$categories),
		));

		$output = '';
		if($title) 
		{
			$output .= ((int)$animation ? str_replace("box_header", "box_header animation-slide", $before_title) : str_replace("animation-slide", "", $before_title)) . apply_filters("widget_title", $title) . $after_title;
		}
		if(have_posts()):
			if($tab_color!="")
			{
				$output .= '<style type="text/css">
					#' . $this->id . ' .accordion .ui-accordion-header h3
					{
						background-image: url(' . get_template_directory_uri() . '/images/accordion/' . $tab_icon_color . '/accordion_plus.png);
					}
					#' . $this->id . ' .accordion .ui-accordion-header.ui-state-hover h3
					{
						color: #' . $tab_color . ';
					}
					#' . $this->id . ' .accordion .ui-accordion-header.ui-state-active
					{
						background: #' . $tab_color . ';
						border-color: #' . $tab_color . ';
					}
				</style>';
			}
			$output .= '<ul class="accordion" data-active-tab="'.$active.'">';
			while(have_posts()): the_post();
				global $post;
				$output .= '<li>
					<div id="accordion-' . urldecode($post->post_name) . '">
						<h3>' . get_the_title() . '</h3>
					</div>
					<div class="clearfix">
						<div class="item_content clearfix">';
							if(has_post_thumbnail())
								$output .= '<a class="thumb_image" href="' . get_permalink($departments_page) . '#' . urldecode($post->post_name) . '" title="' . get_the_title() . '">
									' . get_the_post_thumbnail(get_the_ID(), $themename . "-small-thumb", array("alt" => get_the_title(), "title" => "")) . '
								</a>';
				$output .= apply_filters('the_excerpt', get_the_excerpt()) . '
						</div>
						<div class="item_footer clearfix">
							<a' . ($button_color!="" || $button_text_color!="" ? ' style="' . ($button_color!="" ? 'background-color:#' . $button_color . ';': '') . ($button_border_color!="" ? 'border-color:#' . $button_border_color . ';': '') . ($button_text_color!="" ? 'color:#' . $button_text_color . ';': '') . '"' : '') . ($button_hover_color!="" || $button_hover_border_color!="" || $button_hover_text_color!="" ? ' onMouseOver="' . ($button_hover_color!="" ? 'this.style.backgroundColor=\'#'.$button_hover_color.'\';' : '' ) . ($button_hover_border_color!="" ? 'this.style.borderColor=\'#'.$button_hover_border_color.'\';' : '' ) . ($button_hover_text_color!="" ? 'this.style.color=\'#'.$button_hover_text_color.'\';' : '' ) . '" onMouseOut="' . ($button_hover_color!="" ? 'this.style.backgroundColor=\'#'.$button_color.'\';' : '' ) . ($button_hover_border_color!="" ? 'this.style.borderColor=\'#'.$button_border_color.'\';' : '' ) . ($button_hover_text_color!="" ? 'this.style.color=\'#'.$button_text_color.'\';' : '') . '"' : '') . ' class="more blue icon_small_arrow margin_right_white" href="' . get_permalink($timetable_page) . '#' . urldecode($post->post_name) . '" title="' . __("Timetable", 'medicenter') . '">' . __("Timetable", 'medicenter') . '</a>
							<a' . ($button_color!="" || $button_text_color!="" ? ' style="' . ($button_color!="" ? 'background-color:#' . $button_color . ';': '') . ($button_border_color!="" ? 'border-color:#' . $button_border_color . ';': '') . ($button_text_color!="" ? 'color:#' . $button_text_color . ';': '') . '"' : '') . ($button_hover_color!="" || $button_hover_border_color!="" || $button_hover_text_color!="" ? ' onMouseOver="' . ($button_hover_color!="" ? 'this.style.backgroundColor=\'#'.$button_hover_color.'\';' : '' ) . ($button_hover_border_color!="" ? 'this.style.borderColor=\'#'.$button_hover_border_color.'\';' : '' ) . ($button_hover_text_color!="" ? 'this.style.color=\'#'.$button_hover_text_color.'\';' : '' ) . '" onMouseOut="' . ($button_hover_color!="" ? 'this.style.backgroundColor=\'#'.$button_color.'\';' : '' ) . ($button_hover_border_color!="" ? 'this.style.borderColor=\'#'.$button_border_color.'\';' : '' ) . ($button_hover_text_color!="" ? 'this.style.color=\'#'.$button_text_color.'\';' : '') . '"' : '') . ' class="more blue icon_small_arrow margin_right_white" href="' . get_permalink($departments_page) . '#' . urldecode($post->post_name) . '" title="' . __("Details", 'medicenter') . '">' . __("Details", 'medicenter') . '</a>
						</div>
					</div>
				</li>';
			endwhile;
			$output .= '</ul>';
		endif;
		//Reset Query
		wp_reset_query();
		echo do_shortcode($output);
        echo $after_widget;
    }
	
	/** @see WP_Widget::update */
    function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = isset($new_instance['title']) ? strip_tags($new_instance['title']) : "";
		$instance['animation'] = isset($new_instance['animation']) ? strip_tags($new_instance['animation']) : "";
		$instance['order'] = isset($new_instance['order']) ? strip_tags($new_instance['order']) : "";
		$instance['categories'] = isset($new_instance['categories']) ? $new_instance['categories'] : "";
		$instance['departments_page'] = isset($new_instance['departments_page']) ? strip_tags($new_instance['departments_page']) : "";
		$instance['timetable_page'] = isset($new_instance['timetable_page']) ? strip_tags($new_instance['timetable_page']) : "";
		$instance['active'] = isset($new_instance['active']) ? (int)$new_instance['active'] : "";
		$instance['tab_color'] = isset($new_instance['tab_color']) ? strip_tags($new_instance['tab_color']) : "";
		$instance['tab_custom_color'] = isset($new_instance['tab_custom_color']) ? strip_tags($new_instance['tab_custom_color']) : "";
		$instance['button_color'] = isset($new_instance['button_color']) ? strip_tags($new_instance['button_color']) : "";
		$instance['button_custom_color'] = isset($new_instance['button_custom_color']) ? strip_tags($new_instance['button_custom_color']) : "";
		$instance['button_hover_color'] = isset($new_instance['button_hover_color']) ? strip_tags($new_instance['button_hover_color']) : "";
		$instance['button_hover_custom_color'] = isset($new_instance['button_hover_custom_color']) ? strip_tags($new_instance['button_hover_custom_color']) : "";
		/*$instance['button_border_color'] = strip_tags($new_instance['button_border_color']);
		$instance['button_border_custom_color'] = strip_tags($new_instance['button_border_custom_color']);
		$instance['button_hover_border_color'] = strip_tags($new_instance['button_hover_border_color']);
		$instance['button_hover_border_custom_color'] = strip_tags($new_instance['button_hover_border_custom_color']);*/
		$instance['button_text_color'] = isset($new_instance['button_text_color']) ? strip_tags($new_instance['button_text_color']) : "";
		$instance['button_hover_text_color'] = isset($new_instance['button_hover_text_color']) ? strip_tags($new_instance['button_hover_text_color']) : "";
		return $instance;
    }
	
	 /** @see WP_Widget::form */
	function form($instance) 
	{	
		global $themename;
		$title = isset($instance['title']) ? esc_attr($instance['title']) : "";
		$animation = isset($instance['animation']) ? esc_attr($instance['animation']) : "";
		$order = isset($instance['order']) ? esc_attr($instance['order']) : "";
		$categories = isset($instance['categories']) ? $instance['categories'] : "";
		$departments_page = isset($instance['departments_page']) ? esc_attr($instance['departments_page']) : "";
		$timetable_page = isset($instance['timetable_page']) ? esc_attr($instance['timetable_page']) : "";
		$active = isset($instance['active']) ? esc_attr($instance['active']) : "";
		$tab_color = isset($instance['tab_color']) ? esc_attr($instance['tab_color']) : "";
		$tab_custom_color = isset($instance['tab_custom_color']) ? esc_attr($instance['tab_custom_color']) : "";
		$button_color = isset($instance['button_color']) ? esc_attr($instance['button_color']) : "";
		$button_custom_color = isset($instance['button_custom_color']) ? esc_attr($instance['button_custom_color']) : "";
		$button_hover_color = isset($instance['button_hover_color']) ? esc_attr($instance['button_hover_color']) : "";
		$button_hover_custom_color = isset($instance['button_hover_custom_color']) ? esc_attr($instance['button_hover_custom_color']) : "";
		/*$button_border_color = esc_attr($instance['button_border_color']);
		$button_border_custom_color = esc_attr($instance['button_border_custom_color']);
		$button_hover_border_color = esc_attr($instance['button_hover_border_color']);
		$button_hover_border_custom_color = esc_attr($instance['button_hover_border_custom_color']);*/
		$button_text_color = isset($instance['button_text_color']) ? esc_attr($instance['button_text_color']) : "";
		$button_hover_text_color = isset($instance['title']) ? esc_attr($instance['button_hover_text_color']) : "";
		$mc_colors_arr = array(__("Dark blue", "js_composer") => "3156a3", __("Blue", "js_composer") => "0384ce", __("Light blue", "js_composer") => "42b3e5", __("Black", "js_composer") => "000000", __("Gray", "js_composer") => "AAAAAA", __("Dark gray", "js_composer") => "444444", __("Light gray", "js_composer") => "CCCCCC", __("Green", "js_composer") => "43a140", __("Dark green", "js_composer") => "008238", __("Light green", "js_composer") => "7cba3d", __("Orange", "js_composer") => "f17800", __("Dark orange", "js_composer") => "cb451b", __("Light orange", "js_composer") => "ffa800", __("Red", "js_composer") => "db5237", __("Dark red", "js_composer") => "c03427", __("Light red", "js_composer") => "f37548", __("Turquoise", "js_composer") => "0097b5", __("Dark turquoise", "js_composer") => "006688", __("Light turquoise", "js_composer") => "00b6cc", __("Violet", "js_composer") => "6969b3", __("Dark violet", "js_composer") => "3e4c94", __("Light violet", "js_composer") => "9187c4", __("White", "js_composer") => "FFFFFF", __("Yellow", "js_composer") => "fec110");
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'medicenter'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('animation'); ?>"><?php _e('Title border animation', 'medicenter'); ?></label>
			<select id="<?php echo $this->get_field_id('animation'); ?>" name="<?php echo $this->get_field_name('animation'); ?>">
				<option value="0"><?php _e('no', 'medicenter'); ?></option>
				<option value="1"<?php echo ((int)$animation==1 ? ' selected="selected"' : ''); ?>><?php _e('yes', 'medicenter'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order', 'medicenter'); ?></label>
			<select id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
				<option <?php echo ($order=='ASC' ? ' selected="selected"':'');?> value='ASC'><?php _e("ASC", 'medicenter'); ?></option>
				<option <?php echo ($order=='DESC' ? ' selected="selected"':'');?> value='DESC'><?php _e("DESC", 'medicenter'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e('Categories', 'medicenter'); ?></label>
			<select multiple="multiple" id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>[]">
			<?php
			$departments_categories = get_terms("departments_category");
			foreach($departments_categories as $departments_category)
			{
			?>
				<option <?php echo (is_array($categories) && in_array($departments_category->slug, $categories) ? ' selected="selected"':'');?> value='<?php echo $departments_category->slug;?>'><?php echo $departments_category->name; ?></option>
			<?php
			}
			?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('departments_page'); ?>"><?php _e('Departments Page', 'medicenter'); ?></label>
			<select id="<?php echo $this->get_field_id('departments_page'); ?>" name="<?php echo $this->get_field_name('departments_page'); ?>">
				<?php
				$args = array(
					'post_type' => 'page',
					'post_status' => 'publish',
					'posts_per_page' => -1,
					'orderby' => 'title', 
					'order' => 'ASC',
					'suppress_filters' => true,
				);
				query_posts($args);
				if(have_posts()) : while (have_posts()) : the_post();
					global $post;
				?>
					<option <?php echo ($departments_page==get_the_ID() ? ' selected="selected"':'');?> value='<?php the_ID(); ?>'><?php the_title(); ?></option>
				<?php
				endwhile;
				endif;
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('timetable_page'); ?>"><?php _e('Timetable Page', 'medicenter'); ?></label>
			<select id="<?php echo $this->get_field_id('timetable_page'); ?>" name="<?php echo $this->get_field_name('timetable_page'); ?>">
				<?php
				if(have_posts()) : while (have_posts()) : the_post();
				?>
					<option <?php echo ($timetable_page==get_the_ID() ? ' selected="selected"':'');?> value='<?php the_ID(); ?>'><?php the_title(); ?></option>
				<?php
				endwhile;
				endif;
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('active'); ?>"><?php _e('Active tab number', 'medicenter'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('active'); ?>" name="<?php echo $this->get_field_name('active'); ?>" type="text" value="<?php echo $active; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('tab_color'); ?>"><?php _e('Tab color', 'medicenter'); ?></label>
			<select id="<?php echo $this->get_field_id('tab_color'); ?>" name="<?php echo $this->get_field_name('tab_color'); ?>">
				<?php
				foreach($mc_colors_arr as $mc_color=>$key)
					echo '<option value="' . $key . '"' . ($tab_color==$key ? ' selected="selected"' : '') . '>' . $mc_color . '</option>';
				?>
			</select>
			<?php _e('or pick custom one: ', 'medicenter'); ?>
			<span class="color_preview" style="background-color: #<?php echo ($tab_custom_color!="" ? $tab_custom_color : '3156A3'); ?>;"></span>
			<input class="regular-text color" id="<?php echo $this->get_field_id('tab_custom_color'); ?>" name="<?php echo $this->get_field_name('tab_custom_color'); ?>" type="text" value="<?php echo $tab_custom_color; ?>" data-default-color="3156A3" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('button_color'); ?>"><?php _e('Button color', 'medicenter'); ?></label>
			<select id="<?php echo $this->get_field_id('button_color'); ?>" name="<?php echo $this->get_field_name('button_color'); ?>">
				<?php
				foreach($mc_colors_arr as $mc_color=>$key)
					echo '<option value="' . $key . '"' . ($button_color==$key ? ' selected="selected"' : '') . '>' . $mc_color . '</option>';
				?>
			</select>
			<?php _e('or pick custom one: ', 'medicenter'); ?>
			<span class="color_preview" style="background-color: #<?php echo ($button_custom_color!="" ? $button_custom_color : 'FFFFFF'); ?>;"></span>
			<input class="regular-text color" id="<?php echo $this->get_field_id('button_custom_color'); ?>" name="<?php echo $this->get_field_name('button_custom_color'); ?>" type="text" value="<?php echo $button_custom_color; ?>" data-default-color="FFFFFF" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('button_hover_color'); ?>"><?php _e('Button hover color', 'medicenter'); ?></label>
			<select id="<?php echo $this->get_field_id('button_hover_color'); ?>" name="<?php echo $this->get_field_name('button_hover_color'); ?>">
				<?php
				foreach($mc_colors_arr as $mc_color=>$key)
					echo '<option value="' . $key . '"' . ($button_hover_color==$key ? ' selected="selected"' : '') . '>' . $mc_color . '</option>';
				?>
			</select>
			<?php _e('or pick custom one: ', 'medicenter'); ?>
			<span class="color_preview" style="background-color: #<?php echo ($button_hover_custom_color!="" ? $button_hover_custom_color : 'FFFFFF'); ?>;"></span>
			<input class="regular-text color" id="<?php echo $this->get_field_id('button_hover_custom_color'); ?>" name="<?php echo $this->get_field_name('button_hover_custom_color'); ?>" type="text" value="<?php echo $button_hover_custom_color; ?>" data-default-color="FFFFFF" />
		</p>
		<?php
		/*<p>
			<label for="<?php echo $this->get_field_id('button_border_color'); ?>"><?php _e('Button border color', 'medicenter'); ?></label>
			<select id="<?php echo $this->get_field_id('button_border_color'); ?>" name="<?php echo $this->get_field_name('button_border_color'); ?>">
				<?php
				foreach($mc_colors_arr as $mc_color=>$key)
					echo '<option value="' . $key . '"' . ($button_color==$key ? ' selected="selected"' : '') . '>' . $mc_color . '</option>';
				?>
			</select>
			<?php _e('or pick custom one: ', 'medicenter'); ?>
			<span class="color_preview" style="background-color: #<?php echo ($button_border_custom_color!="" ? $button_border_custom_color : 'FFFFFF'); ?>;"></span>
			<input class="regular-text color" id="<?php echo $this->get_field_id('button_border_custom_color'); ?>" name="<?php echo $this->get_field_name('button_border_custom_color'); ?>" type="text" value="<?php echo $button_border_custom_color; ?>" data-default-color="FFFFFF" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('button_hover_border_color'); ?>"><?php _e('Button hover border color', 'medicenter'); ?></label>
			<select id="<?php echo $this->get_field_id('button_hover_border_color'); ?>" name="<?php echo $this->get_field_name('button_hover_border_color'); ?>">
				<?php
				foreach($mc_colors_arr as $mc_color=>$key)
					echo '<option value="' . $key . '"' . ($button_hover_border_color==$key ? ' selected="selected"' : '') . '>' . $mc_color . '</option>';
				?>
			</select>
			<?php _e('or pick custom one: ', 'medicenter'); ?>
			<span class="color_preview" style="background-color: #<?php echo ($button_hover_border_custom_color!="" ? $button_hover_border_custom_color : 'FFFFFF'); ?>;"></span>
			<input class="regular-text color" id="<?php echo $this->get_field_id('button_hover_border_custom_color'); ?>" name="<?php echo $this->get_field_name('button_hover_border_custom_color'); ?>" type="text" value="<?php echo $button_hover_border_custom_color; ?>" data-default-color="FFFFFF" />
		</p>*/ ?>
		<p>
			<label for="<?php echo $this->get_field_id('button_text_color'); ?>"><?php _e('Button text color', 'medicenter'); ?></label>
			<span class="color_preview" style="background-color: #<?php echo ($button_text_color!="" ? $button_text_color : 'FFFFFF'); ?>;"></span>
			<input class="regular-text color" id="<?php echo $this->get_field_id('button_text_color'); ?>" name="<?php echo $this->get_field_name('button_text_color'); ?>" type="text" value="<?php echo $button_text_color; ?>" data-default-color="FFFFFF" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('button_hover_text_color'); ?>"><?php _e('Button hover text color', 'medicenter'); ?></label>
			<span class="color_preview" style="background-color: #<?php echo ($button_hover_text_color!="" ? $button_hover_text_color : 'FFFFFF'); ?>;"></span>
			<input class="regular-text color" id="<?php echo $this->get_field_id('button_hover_text_color'); ?>" name="<?php echo $this->get_field_name('button_hover_text_color'); ?>" type="text" value="<?php echo $button_hover_text_color; ?>" data-default-color="FFFFFF" />
		</p>
		<script type="text/javascript">
		jQuery(document).ready(function($){
			$("[id$='<?php echo $this->id; ?>'] .color").ColorPicker({
				onChange: function(hsb, hex, rgb, el) {
					$(el).val(hex);
					$(el).prev(".color_preview").css("background-color", "#" + hex);
				},
				onSubmit: function(hsb, hex, rgb, el){
					$(el).val(hex);
					$(el).ColorPickerHide();
				},
				onBeforeShow: function (){
					var color = (this.value!="" ? this.value : $(this).attr("data-default-color"));
					$(this).ColorPickerSetColor(color);
					$(this).prev(".color_preview").css("background-color", color);
				}
			}).on('keyup', function(event, param){
				$(this).ColorPickerSetColor(this.value);

				var default_color = $(this).attr("data-default-color");
				$(this).prev(".color_preview").css("background-color", (this.value!="none" ? "#" + (this.value!="" ? (typeof(param)=="undefined" ? $(".colorpicker:visible .colorpicker_hex input").val() : this.value) : default_color) : "transparent"));
			});
			$("#<?php echo $this->get_field_id('tab_color'); ?>").change(function(){
				$(this).next().next().val($(this).val()).trigger("keyup", [1]);
			});
			$("#<?php echo $this->get_field_id('button_color'); ?>").change(function(){
				$(this).next().next().val($(this).val()).trigger("keyup", [1]);
			});
			$("#<?php echo $this->get_field_id('button_hover_color'); ?>").change(function(){
				$(this).next().next().val($(this).val()).trigger("keyup", [1]);
			});
		});
		</script>
		<?php
	}
}
//register widget
add_action('widgets_init', create_function('', 'return register_widget("departments_widget");'));
?>