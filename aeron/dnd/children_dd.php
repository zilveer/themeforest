<?php

/*********** Shortcode: Children of page ************************************************************/

$ABdevDND_shortcodes['children_dd'] = array(
	'attributes' => array(
		'id' => array(
			'description' => __('Parent Page ID', 'dnd-shortcodes'),
		),
		'depth' => array(
			'default' => '9',
			'description' => __('Depth', 'dnd-shortcodes'),
		),
		'class' => array(
			'description' => __('Class', 'dnd-shortcodes'),
			'info' => __('Additional custom classes for custom styling', 'dnd-shortcodes'),
		),
	),
	'description' => __('Children of Page', 'dnd-shortcodes' )
);
function ABdevDND_children_dd_shortcode($attributes) {
	extract(shortcode_atts(ABdevDND_extract_attributes('children_dd'), $attributes));
	$id = ($id == '')? get_the_ID() : $id;
	$children = wp_list_pages('title_li=&child_of='.$id.'&echo=0&depth='.$depth);
	if ($children)
		return '<ul class="dnd_children '.$class.'">'.$children.'</ul>'; 
	else
		return '';
}

