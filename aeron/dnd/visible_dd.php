<?php

/*********** Shortcode: Visible ************************************************************/

$ABdevDND_shortcodes['visible_dd'] = array(
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
			'description' => __('Visible on devices', 'dnd-shortcodes'),
		),
	),
	'content' => array(
		'description' => __('Content', 'dnd-shortcodes'),
	),
	'description' => __('Visible Only on Devices', 'dnd-shortcodes'),
	'info' => __('This shortcode will make content visible only on selected devices, using @media css method', 'dnd-shortcodes' )
);
function ABdevDND_visible_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('visible_dd'), $attributes));

	$classes='';
	if($devices=='desktop')    $classes = 'visible-desktop';
	if($devices=='tablet')     $classes = 'visible-tablet';
	if($devices=='phablet')    $classes = 'visible-phablet';
	if($devices=='phone')      $classes = 'visible-phone';
	if($devices=='desktab')    $classes = 'visible-desktab';
	if($devices=='phabphone')  $classes = 'visible-phabphone';
	
    return '<div class="'.$classes.'">'.do_shortcode($content).'</div>';
}
