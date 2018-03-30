<?php
return array(
	'name' => __('Google Maps', 'health-center') ,
	'desc' => __('In order to enable Google Map you need:<br>
                 Insert the Google Map element into the editor, open its option panel by clicking on the icon- edit on the right of the element and fill in all fields nesessary.
' , 'health-center'),
		'icon' => array(
		'char' => WPV_Editor::get_icon('location1'),
		'size' => '26px',
		'lheight' => '39px',
		'family' => 'vamtam-editor-icomoon',
	),
	'value' => 'gmap',
	'controls' => 'size name clone edit delete',
	'options' => array(
		array(
			'name' => __('Address (optional)', 'health-center') ,
			'desc' => __('Unless you\'ve filled in the Latitude and Longitude options, please enter the address that you want to be shown on the map. If you encounter any errors about the maximum number of address translation requests per page, you should either use the latitude/longitude options or upgrade to the paid Google Maps API.', 'health-center'),
			'id' => 'address',
			'size' => 30,
			'default' => '',
			'type' => 'text',
		) ,
		array(
			'name' => __('Latitude', 'health-center') ,
			'desc' => __('This option is not necessary if an address is set.<br><br>', 'health-center'),
			'id' => 'latitude',
			'size' => 30,
			'default' => '',
			'type' => 'text',
		) ,
		array(
			'name' => __('Longitude', 'health-center') ,
			'desc' => __('This option is not necessary if an address is set.<br><br>', 'health-center'),
			'id' => 'longitude',
			'size' => 30,
			'default' => '',
			'type' => 'text',
		) ,
		array(
			'name' => __('Zoom', 'health-center') ,
			'desc' => __('Default map zoom level.<br><br>', 'health-center'),
			'id' => 'zoom',
			'default' => '14',
			'min' => 1,
			'max' => 19,
			'step' => '1',
			'type' => 'range'
		) ,
		array(
			'name' => __('Marker', 'health-center') ,
			'desc' => __('Enable an arrow pointing at the address.<br><br>', 'health-center'),
			'id' => 'marker',
			'default' => true,
			'type' => 'toggle'
		) ,
		array(
			'name' => __('HTML', 'health-center') ,
			'desc' => __('HTML code to be shown in a popup above the marker.<br><br>', 'health-center'),
			'id' => 'html',
			'size' => 30,
			'default' => '',
			'type' => 'text',
		) ,
		array(
			'name' => __('Popup Marker', 'health-center') ,
			'desc' => __('Enable to open the popup above the marker by default.<br><br>', 'health-center'),
			'id' => 'popup',
			'default' => false,
			'type' => 'toggle'
		) ,
		array(
			'name' => __('Controls (optional)', 'health-center') ,
			'desc' => sprintf(__('This option is intended to be used only by advanced users and is not necessary for most use cases. Please refer to the <a href="%s" title="Google Maps API documentation">API documentation</a> for details.', 'health-center'), 'https://developers.google.com/maps/documentation/javascript/controls'),
			'id' => 'controls',
			'size' => 30,
			'default' => '',
			'type' => 'text',
		) ,
		array(
			'name' => __('Scrollwheel', 'health-center') ,
			'id' => 'scrollwheel',
			'default' => false,
			'type' => 'toggle'
		) ,
		array(
			'name' => __('Draggable', 'health-center') ,
			'id' => 'draggable',
			'default' => true,
			'type' => 'toggle'
		) ,
		array(
			'name' => __('Maptype (optional)', 'health-center') ,
			'id' => 'maptype',
			'default' => 'ROADMAP',
			'options' => array(
				'ROADMAP' => __('Default road map', 'health-center') ,
				'SATELLITE' => __('Google Earth satellite', 'health-center') ,
				'HYBRID' => __('Mixture of normal and satellite', 'health-center') ,
				'TERRAIN' => __('Physical map', 'health-center') ,
			) ,
			'type' => 'select',
		) ,

		array(
			'name' => __('Color (optional)', 'health-center') ,
			'desc' => __('Defines the overall hue for the map. It is advisable that you avoid gray colors, as they are not well-supported by Google Maps.', 'health-center'),
			'id' => 'hue',
			'default' => '',
			'prompt' => __('Default', 'health-center') ,
			'options' => array(
				'accent1' => __('Accent 1', 'health-center'),
				'accent2' => __('Accent 2', 'health-center'),
				'accent3' => __('Accent 3', 'health-center'),
				'accent4' => __('Accent 4', 'health-center'),
				'accent5' => __('Accent 5', 'health-center'),
				'accent6' => __('Accent 6', 'health-center'),
				'accent7' => __('Accent 7', 'health-center'),
				'accent8' => __('Accent 8', 'health-center'),
			) ,
			'type' => 'select',
		) ,
		array(
			'name' => __('Width (optional)', 'health-center') ,
			'desc' => __('Set to 0 is the full width.<br><br>', 'health-center') ,
			'id' => 'width',
			'default' => 0,
			'min' => 0,
			'max' => 960,
			'step' => '1',
			'type' => 'range'
		) ,
		array(
			'name' => __('Height', 'health-center') ,
			'id' => 'height',
			'default' => '400',
			'min' => 0,
			'max' => 960,
			'step' => '1',
			'type' => 'range'
		) ,


		array(
			'name' => __('Title (optioanl)', 'health-center') ,
			'desc' => __('The title is placed just above the element.<br><br>', 'health-center'),
			'id' => 'column_title',
			'default' => '',
			'type' => 'text'
		) ,
		array(
			'name' => __('Title Type (optional)', 'health-center') ,
			'id' => 'column_title_type',
			'default' => 'single',
			'type' => 'select',
			'options' => array(
				'single' => __('Title with divider next to it', 'health-center'),
				'double' => __('Title with divider below', 'health-center'),
				'no-divider' => __('No Divider', 'health-center'),
			),
		) ,
	) ,
);