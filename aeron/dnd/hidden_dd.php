<?php

/*********** Shortcode: Hidden ************************************************************/

$ABdevDND_shortcodes['hidden_dd'] = array(
	'attributes' => array(
		'devices' => array(
			'default' => 'desktop',
			'type' => 'select',
			'values' => array(
				'desktop' =>  __('Desktop', 'dnd-shortcodes'),
				'tablet' =>  __('Tablet', 'dnd-shortcodes'),
				'phablet' =>  __('Phablet', 'dnd-shortcodes'),
				'phone' =>  __('Phone', 'dnd-shortcodes'),
				'desktab' =>  __('Deskop and Tablet', 'dnd-shortcodes'),
				'phabphone' =>  __('Phabplet and Phone', 'dnd-shortcodes'),
			),
			'description' => __('Hide on Devices', 'dnd-shortcodes'),
		),
	),
	'content' => array(
		'description' => __('Content', 'dnd-shortcodes'),
	),
	'description' => __('Hidden on devices', 'dnd-shortcodes'),
	'info' => __('This shortcode will make content hidden on selected devices, using @media css method', 'dnd-shortcodes' )
);
function ABdevDND_hidden_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('hidden_dd'), $attributes));

	$classes='';
	if($devices=='desktop')    $classes = 'hidden-desktop';
	if($devices=='tablet')     $classes = 'hidden-tablet';
	if($devices=='phablet')    $classes = 'hidden-phablet';
	if($devices=='phone')      $classes = 'hidden-phone';
	if($devices=='desktab')    $classes = 'hidden-desktab';
	if($devices=='phabphone')  $classes = 'hidden-phabphone';
	
    return '<div class="'.$classes.'">'.do_shortcode($content).'</div>';
}


