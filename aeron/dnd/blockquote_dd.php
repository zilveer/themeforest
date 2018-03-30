<?php

/*********** Shortcode: Blockquote ************************************************************/

$ABdevDND_shortcodes['blockquote_dd'] = array(
	'attributes' => array(
		'author' => array(
			'description' => __('Author', 'dnd-shortcodes'),
		),
		'url' => array(
			'description' => __('URL', 'dnd-shortcodes'),
		),
		'source' => array(
			'description' => __('Source', 'dnd-shortcodes'),
		),
	),
	'content' => array(
		'description' => __('Blockquote', 'dnd-shortcodes'),
	),
	'description' => __('Blockquote Block', 'dnd-shortcodes' )
);
function ABdevDND_blockquote_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('blockquote_dd'), $attributes));
	if($source!='')
		$source='<cite title="'.$source.'">'.$source.'</cite>';
	if($author!='' && $url!='')
		$content.='<small><a href="'.$url.'">'.$author.'</a> '.$source.'</small>';
	if($author!='' && $url=='')
		$content.='<small>'.$author.' '.$source.'</small>';
	return '<blockquote class="dnd_blockquote">
		<p>'.$content.'</p>
	</blockquote>';
}

