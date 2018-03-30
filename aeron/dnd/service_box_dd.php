<?php

/*********** Shortcode: Service box ************************************************************/
$ABdevDND_shortcodes['service_box_dd'] = array(
	'attributes' => array(
		'title' => array(
			'description' => __('Title', 'dnd-shortcodes'),
		),
		'icon' => array(
			'description' => __('Icon name', 'dnd-shortcodes'),
		),
		'type' => array(
			'description' => __('Type', 'dnd-shortcodes'),
			'default' => 'round',
			'type' => 'select',
			'values' => array(
				'square' =>  __('Square', 'dnd-shortcodes'),
				'square_aside' => __('Square Aside', 'dnd-shortcodes'),
				'square_aside_right' => __('Square Aside With Icon Right', 'dnd-shortcodes'),
			),
		),
		'link' => array(
			'description' => __('Link', 'dnd-shortcodes'),
		),
		'target' => array(
			'description' => __('Target', 'dnd-shortcodes'),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  __('Self', 'dnd-shortcodes'),
				'_blank' => __('Blank', 'dnd-shortcodes'),
			),
		),
		'class' => array(
			'description' => __('Class', 'dnd-shortcodes'),
			'info' => __('Additional custom classes for custom styling', 'dnd-shortcodes'),
		),
	),
	'content' => array(
		'description' => __('Content', 'dnd-shortcodes'),
	),
	'description' => __('Service Box', 'dnd-shortcodes' )
);
function ABdevDND_service_box_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('service_box_dd'), $attributes));

	$class = ' dnd_service_box_'.$type . ' ' . $class;

	$return = '
		<div class="dnd_service_box'.$class.'">
			<div class="dnd_service_box_header">';

			$return .= ($link!='') ? '<a href="'.$link.'" target="'.$target.'" class="dnd_icon_boxed"><i class="'.$icon.'"></i></a>' : '<div class="dnd_icon_boxed"><i class="'.$icon.'"></i></div>';
			$return .= ($link!='') ? '<a href="'.$link.'" target="'.$target.'"><h3>'.$title.'</h3></a>' : '<h3>'.$title.'</h3>';
			
			$return .= '</div>
			<p>'.do_shortcode($content).'</p>
		</div>';

	return $return;
}

