<?php

/*********** Shortcode: Sitemap ************************************************************/

$ABdevDND_shortcodes['sitemap_dd'] = array(
	'attributes' => array(
		'hide_pages' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => __('Hide Pages', 'dnd-shortcodes'),
		),
		'hide_categories' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => __('Hide Categories', 'dnd-shortcodes'),
		),
		'hide_authors' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => __('Hide Authors', 'dnd-shortcodes'),
		),
	),
	'description' => __('Sitemap', 'dnd-shortcodes' )
);
function ABdevDND_sitemap_dd_shortcode($attributes){
	extract(shortcode_atts(ABdevDND_extract_attributes('sitemap_dd'), $attributes));
	$return = '';
	$return .= ($hide_pages != 1) ? '<h4>'.__('Pages', 'dnd-shortcodes').'</h4><ul class="dnd_sitemap">'.wp_list_pages('title_li=&echo=0').'</ul>' : '';
	$return .= ($hide_categories != 1) ? '<h4>'.__('Categories', 'dnd-shortcodes').'</h4><ul class="dnd_sitemap">'.wp_list_categories('title_li=&echo=0').'</ul>' : '';
	$return .= ($hide_authors != 1) ? '<h4>'.__('Authors', 'dnd-shortcodes').'</h4><ul class="dnd_sitemap">'.wp_list_authors('echo=0&hide_empty=0').'</ul>' : '';
	return $return;
}

