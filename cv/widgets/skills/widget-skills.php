<?php
define('SKILLS_INNER_COLORPICKER', false);

/**
 * Add function to widgets_init that will load our widget.
 */
add_action( 'widgets_init', 'skills_load_widgets' );

/**
 * Register our widget.
 */
function skills_load_widgets() {
	register_widget( 'Skills_Widget' );
}

/**
 * Widget class.
 */
class Skills_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Skills_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_skills', 'description' => 'Show your skills levels' );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'skills-widget' );

		/* Create the widget. */
		parent::__construct( 'skills-widget', 'WP Space - Skills', $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {

		wp_enqueue_style( 'widget-skills', get_template_directory_uri() . '/widgets/skills/widget-skills.css' );

		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$subtitle = $instance['subtitle'];
		$style = isset($_REQUEST['prn']) ? 1 : $instance['style'];

		$skills_output = '';
		$skills_summ = 0;
		$i = 0;
		foreach ($instance as $k => $skills_title) {
			if (my_substr($k, 0, 6) == 'title_' && $skills_title != '') {
				$i++;
				$num = (int) my_substr($k, 6);
				$skills_level = isset($instance['level_' . $num]) ? (int) $instance['level_' . $num] : 0;
				$skills_summ += $skills_level;
				$skills_color = isset($instance['color_' . $num]) ? $instance['color_' . $num] : '#000000';
				if ($style == 2) {
					$skills_output .= '<div class="skills_row ' . ($i%2==0 ? 'even' : 'odd') . ($i==1 ? ' first' : '') . '">'
						. '<span class="legend" style="background-color:' . $skills_color . ';"></span>'
						. '<span class="caption">' . $skills_title . '</span>'
						. '</div>';
				} else {
					$skills_output .= '<div class="skills_row ' . ($i%2==0 ? 'even' : 'odd') . ($i==1 ? ' first' : '') . '">'
						. '<span class="caption">' . $skills_title . '</span>'
						. '<span class="progressbar"><span class="progress" style="background-color:' . $skills_color . ';" rel="'.$skills_level.'%">' 
						. ($style==1 ? '<span class="value">' . $skills_level . '%</span>' : '')
						. '</span></span>'
						. '</div>';
				}
			}
		}
		
		if ($i == 0) return;

		if ($style == 2) {
			$pie_output = '';
			$startAngle = 0;
			$endAngle = 0;
			$w = 128;
			$w2 = floor($w/2);
			$x = $w2+2; $y = $w2+2; $r1 = $w2; $r2 = floor($w2*0.64);
			foreach ($instance as $k => $skills_title) {
				if (my_substr($k, 0, 6) == 'title_' && $skills_title != '') {
					$num = (int) my_substr($k, 6);
					$skills_level = isset($instance['level_' . $num]) ? (int) $instance['level_' . $num] : 0;
					$c = isset($instance['color_' . $num]) ? $instance['color_' . $num] : '#000000';
					$startAngle = $endAngle;
					$endAngle = $startAngle + round(360 * $skills_level / $skills_summ);
					$x1 = round($x + $r1*cos(pi()*$startAngle/180));
					$y1 = round($y + $r1*sin(pi()*$startAngle/180));
					$x2 = round($x + $r1*cos(pi()*$endAngle/180));
					$y2 = round($y + $r1*sin(pi()*$endAngle/180));
					$d = "M".$x.",".$y."  L".$x1.",".$y1."  A".$r1.",".$r1." 0 ".(($endAngle-$startAngle > 180) ? 1 : 0).",1 ".$x2.",".$y2." z";
					$pie_output .= '<path d="'.$d.'" fill="'.$c.'"></path>';
				}
			}
			$pie_output .= '<circle cx="'.$x.'" cy="'.$y.'" r="'.$r2.'" fill="#ffffff"></circle>';
		}
		
		/* Before widget (defined by themes). */			
		echo $before_widget;		

		if ($subtitle) echo '<div class="widget_subtitle">' . $subtitle . '</div>';
		echo $before_title . $title . $after_title;
?>			
		<div class="widget_inner style_<?php echo $style; ?>">
			<?php 
				echo $skills_output; 
				if ($style == 2 && $pie_output!='') echo '<div class="svg"><svg class="piechart" xmlns="http://www.w3.org/2000/svg">' . $pie_output . '</svg></div>';
			?>
		</div>
<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['subtitle'] = strip_tags( $new_instance['subtitle'] );
		$instance['style'] = max(0, min(4, (int) $new_instance['style'] ));
		foreach ($new_instance as $k => $skills_title) {
//			if (my_substr($k, 0, 6) == 'title_' && $skills_title != '') {
				$num = (int) my_substr($k, 6);
				$instance[$k] = strip_tags( $skills_title );
				$instance['level_'.$num] = isset($new_instance['level_' . $num]) ? max(0, min(100, (int) $new_instance['level_' . $num])) : 0;
				$instance['color_'.$num] = strip_tags($new_instance['color_' . $num]);
//			}
		}
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {
		
		/* Widget admin side css */
		wp_enqueue_style( 'widget-skills-style',   get_template_directory_uri() . '/widgets/skills/widget-skills-admin.css' );
		wp_enqueue_script('widget-skills-script',  get_template_directory_uri() . '/widgets/skills/widget-skills-admin.js', array('jquery'), '1.2.6', true);
		if (!SKILLS_INNER_COLORPICKER) {
			wp_enqueue_style('color-picker',  get_template_directory_uri().'/js/colorpicker/colorpicker.css');
			wp_enqueue_script('color-picker', get_template_directory_uri().'/js/colorpicker/colorpicker.js', array('jquery'), '1.2.6', true);
		}
		
		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'subtitle' => '', 'style'=>1, 'title_1'=>'', 'level_1'=>'', 'color_1'=>'', 'description' => 'Show your skills levels' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		
		?>
		<div class="widget_skills">
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Title:'; ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php echo 'Subtitle (if need):'; ?></label>
			<input id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" value="<?php echo $instance['subtitle']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php echo 'Style:'; ?></label>
			<select id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>" size="1" style="width:100%;">
            	<option value="1" <?php echo $instance['style']==1 ? 'selected="selected"' : ''; ?>>Progressbar</option>
            	<option value="2" <?php echo $instance['style']==2 ? 'selected="selected"' : ''; ?>>Piechart with legend</option>
            	<option value="3" <?php echo $instance['style']==3 ? 'selected="selected"' : ''; ?>>Circles</option>
            </select>
		</p>
        <div id="<?php echo $this->get_field_id( 'skills_data' ); ?>" class="skills_data">
<?php
		$i = 0;
		foreach ($instance as $k => $skills_title) {
			if (my_substr($k, 0, 6) == 'title_' && $skills_title != '') {
				$num = (int) my_substr($k, 6);
				$l = 'level_' . $num;
				$c = 'color_' . $num;
				$i++;
?>
				<div class="skills_row">
                    <p class="title">
                    <?php if ($i==1) { ?>
                    <label for="<?php echo $this->get_field_id( $k ); ?>">Skill Title:</label>
                    <?php } ?>
                    <input id="<?php echo $this->get_field_id( $k ); ?>" name="<?php echo $this->get_field_name( $k ); ?>" value="<?php echo $skills_title; ?>" onfocus="initSkills()" />
                    </p>
                    <p class="level">
                    <?php if ($i==1) { ?>
                    <label for="<?php echo $this->get_field_id( $l ); ?>">Level:</label>
                    <?php } ?>
                    <input id="<?php echo $this->get_field_id( $l ); ?>" name="<?php echo $this->get_field_name( $l ); ?>" value="<?php echo $instance[$l]; ?>" onfocus="initSkills()" />%
                    </p>
                    <p class="color">
                    <?php if ($i==1) { ?>
                    <label>Color:</label>
                    <?php } ?>
                    <input id="<?php echo $this->get_field_id( $c ); ?>" name="<?php echo $this->get_field_name( $c ); ?>" value="<?php echo $instance[$c]; ?>" onfocus="initSkills()" class="iColorPicker" style="background-color:<?php echo $instance[$c]; ?>" />
                    </p>
				</div>
<?php
			}
		}
		if ($i == 0) {
			$k = 'title_1';
			$l = 'level_1';
			$c = 'color_1';
?>
				<div class="skills_row">
                    <p class="title">
                    <label for="<?php echo $this->get_field_id( $k ); ?>">Skill Title:</label>
                    <input id="<?php echo $this->get_field_id( $k ); ?>" name="<?php echo $this->get_field_name( $k ); ?>" value="" onfocus="initSkills()" />
                    </p>
                    <p class="level">
                    <label for="<?php echo $this->get_field_id( $l ); ?>">Level:</label>
                    <input id="<?php echo $this->get_field_id( $l ); ?>" name="<?php echo $this->get_field_name( $l ); ?>" value="" onfocus="initSkills()" />%
                    </p>
                    <p class="color">
                    <label>Color:</label>
                    <input id="<?php echo $this->get_field_id( $c ); ?>" name="<?php echo $this->get_field_name( $c ); ?>" value="" onfocus="initSkills()" class="iColorPicker" />
                    </p>
				</div>
<?php
		}
?>
        </div>
		<p>
			<a href="#" class="add_skills" id="<?php echo $this->get_field_id( 'add_skills' ); ?>">Add skills</a>
        </p>
        
        <script type="text/javascript">
			jQuery(document).ready(function() {
				initSkills();
			});
		</script>
        </div>
	<?php
	}
}
?>