<?php

/* Modules */
require_once SG_TEMPLATEPATH . '/functions/sgpanel/modules/sgp-module.php';

function sgp_options()
{
	$sgp_options = array(
		'general' => array(
			'name' => __('General', SG_TDN),
			'modules' => array(
				'General' => array(),
				'Modules' => array(),
			),
		),
		'view' => array(
			'name' => __('View', SG_TDN),
			'modules' => array(
				'GlobalSettings' => array(),
			),
		),
		'style' => array(
			'name' => __('Style', SG_TDN),
			'modules' => array(
				'Theme' => array(),
			),
		),
		'sidebars' => array(
			'name' => __('Sidebars', SG_TDN),
			'modules' => array(
				'Sidebars' => array(),
			),
		),
	);

	return $sgp_options;
}