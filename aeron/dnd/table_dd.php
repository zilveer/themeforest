<?php

/*********** Shortcode: Table ************************************************************/

$ABdevDND_shortcodes['table_dd'] = array(
	'attributes' => array(
		'alternative_style' => array(
			'default' => '0',
			'description' => __('Alternative Styling', 'dnd-shortcodes'),
			'type' => 'checkbox',
		),
		'hover' => array(
			'default' => '0',
			'description' => __('Rows with Hover', 'dnd-shortcodes'),
			'type' => 'checkbox',
		),
		'striped' => array(
			'default' => '0',
			'description' => __('Striped Rows', 'dnd-shortcodes'),
			'type' => 'checkbox',
		),
		'condensed' => array(
			'default' => '0',
			'description' => __('Condensed Table', 'dnd-shortcodes'),
			'type' => 'checkbox',
		),
		'class' => array(
			'description' => __('Class', 'dnd-shortcodes'),
			'info' => __('Additional custom classes for custom styling', 'dnd-shortcodes'),
		),
	),
	'content' => array(
		'default' => 'HTML table source here',
		'description' => __('Content', 'dnd-shortcodes'),
	),
	'description' => __('Table', 'dnd-shortcodes' )
);
function ABdevDND_table_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('table_dd'), $attributes));

	$classes[] = 'dnd-table';

	if($alternative_style==1){
		$classes[] = 'dnd-table-alternative';
	}
	if($hover==1){
		$classes[] = 'dnd-table-hover';
	}
	if($striped==1){
		$classes[] = 'dnd-table-striped';
	}
	if($condensed==1){
		$classes[] = 'dnd-table-condensed';
	}
	$classes = implode(' ', $classes).' '.$class;

	return '<div class="'.$classes.'">'.do_shortcode($content).'</div>';
}


