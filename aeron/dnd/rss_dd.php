<?php

/*********** Shortcode: RSS feed ************************************************************/
$ABdevDND_shortcodes['rss_dd'] = array(
	'attributes' => array(
		'feed' => array(
			'description' => __('Feed URL', 'dnd-shortcodes'),
		),
		'num' => array(
			'default' => '5',
			'description' => __('Number of Posts', 'dnd-shortcodes'),
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
	),
	'description' => __('RSS Feed', 'dnd-shortcodes' )
);
include_once(ABSPATH.WPINC.'/feed.php');
function ABdevDND_rss_dd_shortcode($attributes) {
    extract(shortcode_atts(ABdevDND_extract_attributes('rss_dd'), $attributes));
	
	$maxitems = $rss_items = '';
	$rss = fetch_feed($feed);
	if (!is_wp_error( $rss ) ) {
		$maxitems = $rss->get_item_quantity($num); 
		$rss_items = $rss->get_items(0, $maxitems); 
	}

	if($target!='')
		$target_output=' target="'.$target.'"';

	$return='<ul class="dnd_rss">';
	if ($maxitems == 0){
		$return .= '<li>'.__('No RSS items loaded','dnd-shortcodes').'</li>';
	}
	else{
		foreach ( $rss_items as $item ) 
			$return.='<li><a href="'. esc_url( $item->get_permalink() ).'" title="'.__('Posted','dnd-shortcodes').' '.$item->get_date('j F Y | g:i a').'"'.$target_output.'>'.esc_html( $item->get_title() ).'</a></li>';
	}
	$return.='</ul>';

	return $return;
}

