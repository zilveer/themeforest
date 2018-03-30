<?php

/*********** Shortcode: Code prettifier ************************************************************/

$ABdevDND_shortcodes['code_dd'] = array(
	'attributes' => array(
		'id' => array(
			'default' => 'code1',
			'description' => __('Unique ID', 'dnd-shortcodes'),
			'info' => __('Required', 'dnd-shortcodes'),
		),
	),
	'content' => array(
		'description' => __('Source Code', 'dnd-shortcodes'),
		'no_editor' => 1,
	),
	'description' => __('Code Prettifier', 'dnd-shortcodes'),
	'info' => __('If you are using multiple code shortcodes on same page every one must have his own Unique ID', 'dnd-shortcodes' )
);
function ABdevDND_code_dd_shortcode( $attributes, $content = null ) {
	global $post;
	extract(shortcode_atts(ABdevDND_extract_attributes('code_dd'), $attributes));
	return '<pre class="dnd_prettyprint prettyprint linenums">'.htmlentities(dnd_get_raw_code($id, $post->post_content), ENT_QUOTES, "UTF-8").'</pre>';
}
function dnd_get_raw_code($id, $str){
	$start = $id ? '[code_dd id="'.$id.'"]' : '[code]';
	$end = '[/code_dd]';
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

