<?php

if(!function_exists('sc_button')) {
	function sc_button( $atts, $content ) {
		ob_start();

		extract( shortcode_atts( array(
			'text_color' => '#ff5732',
			'background_color' => '#e7e7e7',
			'icon' => '',
			'link' => '#',
			'target' => '_self'
		), $atts ) );

		$class="button-1 color shortcode-btn";
		if($icon != '')
		{
			$class .= ' icon';
			$icon = '<i class="fa fa-' . esc_attr($icon) . '"></i>';
		}

		$style = 'color: ' . $text_color. ';';
		$style .= 'background-color: ' . $background_color. ';';

		echo '<a href="' . $link . '" target="' . $target . '" class="' . $class . '" style="' . $style . '">' . $icon . $content . '</a>';

		$return = ob_get_contents();
		ob_end_clean();
		return $return;
	}
}

if(!function_exists('sc_list')) {
	function sc_list( $atts, $content ) {
		ob_start();

		extract( shortcode_atts( array(
			'type' => 'check',
		), $atts ) );

		$class = '';

		$types = array('check', 'hollow', 'plus', 'minus');
		if(in_array($type, $types))
		{
			$class = $type;
		}

		echo '<ul class="' . esc_attr($class) . '">';
			echo do_shortcode($content);
		echo '</ul>';

		$return = ob_get_contents();
		ob_end_clean();
		return $return;
	}
}

if(!function_exists('sc_list_item')) {
	function sc_list_item( $atts, $content ) {
		ob_start();

		echo '<li>' . $content . '</li>';

		$return = ob_get_contents();
		ob_end_clean();
		return $return;
	}
}

if(!function_exists('sc_info_box')) {
	function sc_info_box( $atts, $content ) {
		ob_start();

		extract( shortcode_atts( array(
			'title' => '',
			'type' => ''
		), $atts ) );

		$class = '';
		$types = array('warning', 'success');
		if(in_array($type, $types))
		{
			$class = $type;
		}

		echo '<div class="info-box ' . esc_attr($class) .'">';
			if($title != '')
			{
				echo '<p class="heading">' . $title . '</p>';
			}
			echo '<p>' . $content . '</p>';
		echo '</div>';

		$return = ob_get_contents();
		ob_end_clean();
		return $return;
	}
}