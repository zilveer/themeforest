<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Advanced Text Widget
 	Plugin URI: http://www.color-theme.com
 	Description: Advanced Text Widget
 	Version: 1.0
 	Author: Zerge
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'ct_adv_text_widget' );

function ct_adv_text_widget()
{
	register_widget('CT_Advanced_Text_Widget');
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_Advanced_Text_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function CT_Advanced_Text_Widget()
	{
		/* Widget settings. */
		$widget_ops = array(	'classname'		=> 'ct-adv-text-widget',
								'description'	=> __( 'Advanced Text Widget' , 'color-theme-framework' )
					);

		/* Widget control settings. */
		$control_ops = array(	'width'		=> 255,
								'height'	=> 350,
								'id_base'	=> 'ct-adv-text-widget'
						);

		/* Create the widget. */
		parent::__construct( 'ct-adv-text-widget', __( 'CT: Advanced Text Widget' , 'color-theme-framework' ), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);

		$title = apply_filters ('widget_title', $instance ['title']);
		$text = apply_filters ('widget_text', $instance ['text'], $instance);
		$remove_background = isset($instance['remove_background']) ? 'true' : 'false';
		$remove_margins = isset($instance['remove_margins']) ? 'true' : 'false';
		$text_align = $instance['text_align'];
		$font_style = $instance['font_style'];
		$font_weight = $instance['font_weight'];
		$text_transform = $instance['text_transform'];
		$font_size = $instance['font_size'];
		$line_height = $instance['line_height'];
		$font_color = $instance['font_color'];
		$background = $instance['background'];
		$background_title = $instance['background_title'];

		$margins = 0;
		$margins_null = '';
		$padding_top = '';
		?>

		<!-- BEGIN WIDGET -->
		<?php

		/* Before widget (defined by themes). */
		echo "\n<!-- START ADVANCED TEXT WIDGET -->\n";
		echo $before_widget;

		if ( $title ){
			if ( $remove_margins == 'true' ) { $margins = 0; }
			echo '<h3 class="widget-title" style="background:'.$background_title.';">'.$title.'<span class="bottom-triangle" style="border-top-color:'.$background_title.';"></span></h3>';		
		}
		?>

		<?php 
		global $ct_options;

		$output_text = do_shortcode($text);

		if ( $remove_background == 'true' ) { ?>

			<script type="text/javascript">
			/* <![CDATA[ */
				jQuery.noConflict()(function($){
					"use strict";
					$(document).ready(function(){
						$('.ct-adv-text-widget').css("background","none");
					});
				});
			/* ]]> */
			</script>

		<?php }


		if ( $title ){
			$padding_top = '20px';
			if ( $remove_margins == 'true' ) { $margins = '-20'; }
			if ( $remove_background == 'true' ) { $background = 'none'; }
			echo '<div class="ct-adv-text-wrapper" style="background:' . $background . '; padding-top:'.$padding_top.'; margin:' . $margins . 'px;">';
		} else {
			$padding_top = '0';
			if ( $remove_margins == 'true' ) { $margins = '-20'; }
			if ( $remove_background == 'true' ) { $background = 'none'; }
			echo '<div class="ct-adv-text-wrapper" style="background:' . $background . ';padding-top:'.$padding_top.'; margin:' . $margins . 'px;">';
		}

		echo '<div class="ct-text-widget" style="overflow: hidden; font-style:' .$font_style. '; font-weight:' .$font_weight. '; text-align:' . $text_align . '; color:' . $font_color . '; font-size:' . $font_size. 'px; line-height:' . $line_height . 'px; text-transform: '. $text_transform .';">' . $output_text . '</div>';
		echo '</div>';
		?>
		<!-- END WIDGET -->

		<?php
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['text'] = $new_instance['text'];

		$instance['remove_background'] = $new_instance['remove_background'];
		$instance['remove_margins'] = $new_instance['remove_margins'];
		$instance['display_quote'] = $new_instance['display_quote'];
		$instance['text_align'] = $new_instance['text_align'];
		$instance['font_style'] = $new_instance['font_style'];
		$instance['font_weight'] = $new_instance['font_weight'];		
		$instance['text_transform'] = $new_instance['text_transform'];
		$instance['font_size'] = $new_instance['font_size'];
		$instance['line_height'] = $new_instance['line_height'];
		$instance['font_color'] = strip_tags($new_instance['font_color']);
		$instance['background'] = strip_tags($new_instance['background']);
		$instance['background_title'] = strip_tags($new_instance['background_title']);
				
		return $instance;
	}


	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form($instance)
	{
		/* Set up some default widget settings. */
		$defaults = array(	'title'					=> __( 'Text' ,	'color-theme-framework' ),
							'remove_background'		=> 'off',
							'remove_margins'		=> 'off',
							'font_color'			=> '#000000',
							'background'			=> '#FFFFFF',
							'background_title'		=> '#FF0000',
							'text'					=> 'Some text for Text widget',
							'text_align'			=> 'left',
							'font_size'				=> '12',
							'line_height'			=> '19',
							'text_transform'		=> 'none',
							'font_style'			=> 'normal',
							'font_weight'			=> 'normal'
					);

		$instance = wp_parse_args((array) $instance, $defaults); 
		$font_color = esc_attr($instance['font_color']);
		$background = esc_attr($instance['background']); ?>

		<script type="text/javascript">
		//<![CDATA[
			jQuery(document).ready(function($) {  
				$('.ct-color-picker').wpColorPicker();
			});
		//]]>   
		</script>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<textarea class="widefat" rows="9" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $instance['text']; ?></textarea>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['remove_background'], 'on'); ?> id="<?php echo $this->get_field_id('remove_background'); ?>" name="<?php echo $this->get_field_name('remove_background'); ?>" /> 
			<label for="<?php echo $this->get_field_id('remove_background'); ?>"><?php _e( 'Remove background' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['remove_margins'], 'on'); ?> id="<?php echo $this->get_field_id('remove_margins'); ?>" name="<?php echo $this->get_field_name('remove_margins'); ?>" /> 
			<label for="<?php echo $this->get_field_id('remove_margins'); ?>"><?php _e( 'Remove margins' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'text_align' ); ?>"><?php _e('Text align:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'text_align' ); ?>" name="<?php echo $this->get_field_name( 'text_align' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'center' == $instance['text_align'] ) echo 'selected="selected"'; ?>>center</option>
				<option <?php if ( 'left' == $instance['text_align'] ) echo 'selected="selected"'; ?>>left</option>
				<option <?php if ( 'right' == $instance['text_align'] ) echo 'selected="selected"'; ?>>right</option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'text_transform' ); ?>"><?php _e('Text transform:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'text_transform' ); ?>" name="<?php echo $this->get_field_name( 'text_transform' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'none' == $instance['text_transform'] ) echo 'selected="selected"'; ?>>none</option>
				<option <?php if ( 'uppercase' == $instance['text_transform'] ) echo 'selected="selected"'; ?>>uppercase</option>
				<option <?php if ( 'capitalize' == $instance['text_transform'] ) echo 'selected="selected"'; ?>>capitalize</option>
				<option <?php if ( 'lowercase' == $instance['text_transform'] ) echo 'selected="selected"'; ?>>lowercase</option>				
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'font_style' ); ?>"><?php _e('Font style:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'font_style' ); ?>" name="<?php echo $this->get_field_name( 'font_style' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'normal' == $instance['font_style'] ) echo 'selected="selected"'; ?>>normal</option>
				<option <?php if ( 'italic' == $instance['font_style'] ) echo 'selected="selected"'; ?>>italic</option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'font_weight' ); ?>"><?php _e('Font weight:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'font_weight' ); ?>" name="<?php echo $this->get_field_name( 'font_weight' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'normal' == $instance['font_weight'] ) echo 'selected="selected"'; ?>>normal</option>
				<option <?php if ( 'bold' == $instance['font_weight'] ) echo 'selected="selected"'; ?>>bold</option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('font_size'); ?>"><?php _e( 'Font size (px):' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="50" class="widefat" id="<?php echo $this->get_field_id('font_size'); ?>" name="<?php echo $this->get_field_name('font_size'); ?>" value="<?php echo $instance['font_size']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('line_height'); ?>"><?php _e( 'Line height (px):' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="50" class="widefat" id="<?php echo $this->get_field_id('line_height'); ?>" name="<?php echo $this->get_field_name('line_height'); ?>" value="<?php echo $instance['line_height']; ?>" />
		</p>

		<p>
          <label for="<?php echo $this->get_field_id('font_color'); ?>" style="display:block;"><?php _e('Font color:', 'color-theme-framework'); ?></label> 
          <input class="ct-color-picker" id="<?php echo $this->get_field_id('font_color'); ?>" name="<?php echo $this->get_field_name('font_color'); ?>" type="text" value="<?php if($font_color) { echo $font_color; } else { echo '#000000'; } ?>" data-default-color="#000000" />
        </p>

		<p>
			<label for="<?php echo $this->get_field_id('background'); ?>" style="display:block;"><?php _e('Background color:', 'color-theme-framework'); ?></label> 
			<input class="ct-color-picker" id="<?php echo $this->get_field_id('background'); ?>" name="<?php echo $this->get_field_name('background'); ?>" type="text" value="<?php if($background) { echo $background; } else { echo '#FFFFFF'; } ?>" data-default-color="#FFFFFF" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('background_title'); ?>" style="display:block;"><?php _e('Title Background color:', 'color-theme-framework'); ?></label> 
			<input class="ct-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_title' ); ?>" name="<?php echo $this->get_field_name( 'background_title' ); ?>" value="<?php echo esc_attr( $instance['background_title'] ); ?>" data-default-color="#2b373f" />
		</p>		
	<?php 
	}
}
?>