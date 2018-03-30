<?php

/*********** Shortcode: Raw Block ************************************************************/

$ABdevDND_shortcodes['raw_dd'] = array(
	'hide_in_dnd' => true,
	'attributes' => array(
		'id' => array(
			'default' => 'raw1',
			'description' => __('Unique Block ID', 'dnd-shortcodes'),
			'info' => __('Required', 'dnd-shortcodes'),
		),
	),
	'content' => array(
		'description' => __('Content', 'dnd-shortcodes'),
		'no_editor' => 1,
	),
	'description' => __('Raw Block', 'dnd-shortcodes'),
	'info' => __('If you are using multiple raw shortcodes on same page every one must have his own Unique ID', 'dnd-shortcodes' )
);
function ABdevDND_raw_dd_shortcode($attributes, $content = null){
	global $post;
	extract(shortcode_atts(ABdevDND_extract_attributes('raw_dd'), $attributes));
	$return = htmlentities(dnd_get_raw($id, $post->post_content), ENT_QUOTES, "UTF-8");
	return $return;
}
function dnd_get_raw($id, $str){
	$start = $id ? '[raw_dd id="'.$id.'"]' : '[raw_dd]';
	$end = '[/raw_dd]';
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

