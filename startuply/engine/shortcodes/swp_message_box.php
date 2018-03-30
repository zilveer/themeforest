<?php

/*-----------------------------------------------------------------------------------*/
/*	Message box VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			vc_map(array(
				'name' => __('Message Box', 'vivaco'),
				'base' => 'vc_message',
				'icon' => 'icon-wpb-information-white',
				'wrapper_class' => 'alert',
				'category' => __('Content', 'vivaco'),
				'description' => __('Notification box', 'vivaco'),
				'params' => array(
					array(
						'type' => 'dropdown',
						'heading' => __('Message box type', 'vivaco'),
						'param_name' => 'color',
						'value' => array(
							__('Success', 'vivaco') => 'alert-success',
							__('Informational', 'vivaco') => 'alert-info',
							__('Warning', 'vivaco') => 'alert-warning',
							__('Error', 'vivaco') => "alert-danger"
						),
						'description' => __('Select message type', 'vivaco')
					),
					array(
						'type' => 'textarea_html',
						'holder' => 'div',
						'class' => 'messagebox_text',
						'heading' => __('Message text', 'vivaco'),
						'param_name' => 'content',
						'value' => __('<p>I am message box. Click edit button to change this text.</p>', 'vivaco')
					),
					array(
						'type' => 'textfield',
						'heading' => __('Extra class name', 'vivaco'),
						'param_name' => 'el_class',
						'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'vivaco')
					)
				),
				'js_view' => 'VcMessageView'
			));





/*-----------------------------------------------------------------------------------*/
/*	Message box VC Render (Front-end)
/*-----------------------------------------------------------------------------------*/
function vc_message_shortcode($atts, $content = null) {
	$output = $class = $color = $text = $el_class = '';
	extract(shortcode_atts(array(
		'color' => 'alert-success',
		'text' => '',
		'el_class' => ''
	), $atts));

	$icons = array(
		'alert-success' => 'icon-badges-votes-10',
		'alert-info' => 'icon-alerts-18',
		'alert-warning' => 'icon-alerts-01',
		'alert-danger' => 'icon-badges-votes-11'
	);

	$class .= 'alert ' . $el_class . ' ' . $color;

	$output .= '<div class="' . $class . '">';
	$output .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	$output .= $content . '<i class="icon ' . $icons[$color] . '"></i>';
	$output .= '</div>';

	return $output;

}
add_shortcode('vc_message', 'vc_message_shortcode');
