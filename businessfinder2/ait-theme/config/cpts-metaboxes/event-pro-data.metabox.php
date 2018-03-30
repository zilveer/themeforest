<?php

return array(

	'headerType' => array(
		'label' => __('Event Header', 'ait-events-pro'),
		'type' => 'select',
		'selected' => 'image',
		'default' => array(
			'none'  => __('No header', 'ait-events-pro'),
			'map'   => __('Map', 'ait-events-pro'),
			'image' => __('Image', 'ait-events-pro'),
		),
		'help' => __('Select type of header on page', 'ait-events-pro'),
	),

	array('section' => array('id' => 'headerType-image', 'title' => __('Image Options', 'ait-events-pro'))),

	'headerImage' => array(
		'label'   => __('Header Image', 'ait-events-pro'),
		'type'    => 'image',
		'default' => '',
		'help'    => __('Image displayed in header', 'ait-events-pro'),
	),

	array('section' => array('title' => __('General', 'ait-events-pro'))),

	'dates' => array(
		'label' => __('Dates', 'ait-events-pro'),
		'type' => 'clone',
		'items' => array(
			'dateFrom' => array(
				'label'   => __('Date From', 'ait-events-pro'),
				'type'    => 'date',
				'format'  => 'D, d M yy',
				'default' => 'none',
				'picker'  => 'datetime',
				'help'    => __('Starting date of event', 'ait-events-pro'),
			),
			'dateTo' => array(
				'label'   => __('Date To', 'ait-events-pro'),
				'type'    => 'date',
				'format'  => 'D, d M yy',
				'default' => 'none',
				'picker'  => 'datetime',
				'help'    => __('Ending date of event', 'ait-events-pro'),
			),
		),
		'default' => array(),
		'help' => __('Create more inputs if event is recurring', 'ait-events-pro'),
	),

	'fee' => array(
		'label' => __('Fee', 'ait-events-pro'),
		'type' => 'clone',
		'items' => array(
			'name' => array(
				'label'   => __('Label', 'ait-events-pro'),
				'type'    => 'text',
				'default' => '',
				'help'    => __('Optional', 'ait-events-pro'),
			),
			'price' => array(
				'label'   => __('Price', 'ait-events-pro'),
				'type'    => 'number',
				'step'    => 'any',
				'default' => 0,
				'help'    => __('Set 0 or leave empty for free', 'ait-events-pro'),
			),
			'url' => array(
				'label'   => __('Ticket Url', 'ait-events-pro'),
				'type'    => 'url',
				'default' => '',
				'help'    => __('Optional external link for tickets shop. Use valid url with http://.', 'ait-events-pro'),
			),
			'desc' => array(
				'label'   => __('Description', 'ait-events-pro'),
				'type'    => 'text',
				'default' => '',
				'help'    => __('Optional', 'ait-events-pro'),
			),
		),
		'default' => array(),
		'help' => __('Leave empty for free', 'ait-events-pro'),
	),

	'currency' => array(
		'label' => __('Currency', 'ait-events-pro'),
		'type' => 'select',
		'selected' => 'USD',
		'default' => array(
			'AUD' => __('Australian Dollar (AUD)', 'ait-events-pro'),
			'BRL' => __('Brazilian Real (BRL)', 'ait-events-pro'),
			'CAD' => __('Canadian Dollar (CAD)', 'ait-events-pro'),
			'CZK' => __('Czech Koruna (CZK)', 'ait-events-pro'),
			'DKK' => __('Danish Krone (DKK)', 'ait-events-pro'),
			'EUR' => __('Euro (EUR)', 'ait-events-pro'),
			'HKD' => __('Hong Kong Dollar (HKD)', 'ait-events-pro'),
			'HUF' => __('Hungarian Forint (HUF)', 'ait-events-pro'),
			'ILS' => __('Israeli New Sheqel (ILS)', 'ait-events-pro'),
			'JPY' => __('Japanese Yen (JPY)', 'ait-events-pro'),
			'MYR' => __('Malaysian Ringgit (MYR)', 'ait-events-pro'),
			'MXN' => __('Mexican Peso (MXN)', 'ait-events-pro'),
			'NOK' => __('Norwegian Krone (NOK)', 'ait-events-pro'),
			'NZD' => __('New Zealand Dollar (NZD)', 'ait-events-pro'),
			'PHP' => __('Philippine Peso (PHP)', 'ait-events-pro'),
			'PLN' => __('Polish Zloty (PLN)', 'ait-events-pro'),
			'GBP' => __('Pound Sterling (GBP)', 'ait-events-pro'),
			'RUB' => __('Russian Ruble (RUB)', 'ait-events-pro'),
			'SGD' => __('Singapore Dollar (SGD)', 'ait-events-pro'),
			'SEK' => __('Swedish Krona (SEK)', 'ait-events-pro'),
			'CHF' => __('Swiss Franc (CHF)', 'ait-events-pro'),
			'TWD' => __('Taiwan New Dollar (TWD)', 'ait-events-pro'),
			'THB' => __('Thai Baht (THB)', 'ait-events-pro'),
			'TRY' => __('Turkish Lira (TRY)', 'ait-events-pro'),
			'USD' => __('U.S. Dollar (USD)', 'ait-events-pro'),
		),
	),

	'item' => array(
		'label'        => __('Item', 'ait-events-pro'),
		'type'         => 'posts',
		'cpt'          => 'ait-item',
		'translatable' => true,
		'default'      => '',
		'help'         => __('Related Item', 'ait-events-pro'),
	),

	'useItemLocation' => array(
		'label'    => __("Use Item's Location", 'ait-events-pro'),
		'type'     => 'select',
		'selected' => 'no',
		'default' => array(
			'yes' => __('yes', 'ait-events-pro'),
			'no'  => __('no', 'ait-events-pro'),
		),
		'help' => __('Event and related item will have the same address', 'ait-events-pro'),
	),

	array('section' => array('id' => 'useItemLocation-no')),

	'map' => array(
		'label' => __('Address', 'ait-events-pro'),
		'type' => 'map',
		'default' => array(
			'address'    => '',
			'latitude'   => '0',
			'longitude'  => '0',
			'streetview' => false,
		),
	),
);
