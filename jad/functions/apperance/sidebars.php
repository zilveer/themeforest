<?php

require_once SG_TEMPLATEPATH . '/functions/sgpanel/modules/sgp-sidebars.php';

function sg_get_default_sidebars()
{
	$sb = array(
		'pages_sidebar' => array(
			'name' => __('Pages Sidebar', SG_TDN),
			'desc' => __('Widgets inserted here will show up in the sidebar sections for pages.', SG_TDN),
			'pos' => 'content',
		),
	);

	return $sb;
}

function sg_get_sidebars_positions()
{
	$sbp = array(
		'content' => __('Content', SG_TDN),
		'footer' => __('Footer', SG_TDN),
	);

	return $sbp;
}

function sg_get_sidebars()
{
	$dsb = sg_get_default_sidebars();
	$sb = SGP_Sidebars_Module::getVars();

	return array_merge($dsb, $sb);
}

add_action('widgets_init', 'sg_register_sidebars');

function sg_register_sidebars()
{
	$sb = sg_get_sidebars();
	$sbp = sg_get_sidebars_positions();

	foreach ($sb as $id => $p) {
		if ($p['pos'] == 'content') {
			register_sidebar(
				array(
					'id' => $id,
					'name' => $p['name'],
					'description' => $p['desc'] . ' (' . __('Position', SG_TDN) . ': ' . $sbp[$p['pos']] . ')',
					'before_widget' => '<div id="%1$s" class="%2$s bottom-2_4em">',
					'after_widget' => '</div>',
					'before_title' => '<h5>',
					'after_title' => '</h5>',
				)
			);
		}
		if ($p['pos'] == 'footer') {
			register_sidebar(
				array(
					'id' => $id,
					'name' => $p['name'],
					'description' => $p['desc'] . ' (' . __('Position', SG_TDN) . ': ' . $sbp[$p['pos']] . ')',
					'before_widget' => '<div id="%1$s" class="%2$s ef-col ef-gu4 bottom-2_4em">',
					'after_widget' => '</div>',
					'before_title' => '<h5>',
					'after_title' => '</h5>',
				)
			);
		}
	}
}