<?php

/*********** Shortcode: PRE Block ************************************************************/

$ABdevDND_shortcodes['pre_dd'] = array(
	'attributes' => array(
		'id' => array(
			'default' => 'pre1',
			'description' => __('Unique ID', 'dnd-shortcodes'),
			'info' => __('Required', 'dnd-shortcodes'),
		),
	),
	'content' => array(
		'description' => __('Preformated Content', 'dnd-shortcodes'),
		'no_editor' => 1,
	),
	'description' => __('Preformated Block', 'dnd-shortcodes'),
	'info' => __('If you are using multiple pre shortcodes on same page every one must have his own Unique ID', 'dnd-shortcodes' )
);
function ABdevDND_pre_dd_shortcode( $attributes, $content = null ) {
	global $post;
	extract(shortcode_atts(ABdevDND_extract_attributes('pre_dd'), $attributes));
	return '<pre>'.htmlentities(dnd_get_raw_pre($id, $post->post_content), ENT_QUOTES, "UTF-8").'</pre>';
}
function dnd_get_raw_pre($id, $str){
	$start = $id ? '[pre_dd id="'.$id.'"]' : '[pre_dd]';
	$end = '[/pre_dd]';
	$stpos = strpos($str, $start);
	if ($stpos === FALSE)
		return "";
	$stpos += strlen($start);
	$endpos = strpos($str, $end, $stpos);
	if ($endpos === FALSE)
		return "";
	$len = $endpos - $stpos;
	return substr($str, $stpos, $len);
}

