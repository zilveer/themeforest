<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'general' => array(
		'title'   => __( 'General Options', 'woffice' ),
		'type'    => 'tab',
		'options' => array(
			'general-box' => array(
				'title'   => __( 'Main options', 'woffice' ),
				'type'    => 'box',
				'options' => array(
					'page_loading'    => array(
						'label' => __( 'Page loading', 'woffice' ),
						'desc'  => __( 'Show the page loading bar above the navbar.', 'woffice' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'yes',
							'label' => __( 'Show', 'woffice' )
						),
						'left-choice'  => array(
							'value' => 'no',
							'label' => __( 'Hide', 'woffice' )
						),
						'value'        => 'yes',
					),
					'hide_seo'    => array(
						'label' => __( 'Hide website ?', 'woffice' ),
						'desc'  => __( 'Do you want to hide the website from Search engines, so it is only accessible by URL.', 'woffice' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'yep',
							'label' => __( 'Yep', 'woffice' )
						),
						'left-choice'  => array(
							'value' => 'nope',
							'label' => __( 'Nope', 'woffice' )
						),
						'value'        => 'nope',
					),
					'topbar_woffice'    => array(
						'label' => __( 'Woffice topbar ?', 'woffice' ),
						'desc'  => __( 'Do you want to see the Woffice topbar links in the admin bar.', 'woffice' ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'yep',
							'label' => __( 'Yep', 'woffice' )
						),
						'left-choice'  => array(
							'value' => 'nope',
							'label' => __( 'Nope', 'woffice' )
						),
						'value'        => 'yep',
					),
                    'gmap_api_key'    => array(
                        'label' => __( 'Google MAP API Key', 'woffice' ),
                        'desc'  => __( 'This key is used for all the Google MAPs (Not the members map creation)', 'woffice' ). ' <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">How to get an Google MAP Javascript API Key</a>',
                        'value'        => '',
                        'type'  => 'gmap-key'
                    ),
				),
			),
			'favicons' => array(
				'title'   => __( 'Favicons', 'woffice' ),
				'type'    => 'box',
				'options' => array(
					'favicon' => array(
						'label' => __( 'Favicon', 'woffice' ),
						'desc'  => __( 'Upload a favicon image (PNG 32px x 32px)', 'woffice' ),
						'type'  => 'upload'
					),
					'favicon_android_1' => array(
						'label' => __( '(Android) Icon 1', 'woffice' ),
						'desc'  => __( 'Upload an image (PNG 192px x 192px). For screens with a density of 4.0', 'woffice' ),
						'type'  => 'upload'
					),
					'favicon_android_2' => array(
						'label' => __( '(Android) Icon 2', 'woffice' ),
						'desc'  => __( 'Upload an image (PNG 144px x 144px). For screens with a density of 3.0', 'woffice' ),
						'type'  => 'upload'
					),
					'favicon_iphone' => array(
						'label' => __( '(Iphone) Icon', 'woffice' ),
						'desc'  => __( 'Upload an image (PNG 114px x 114px)', 'woffice' ),
						'type'  => 'upload'
					),
					'favicon_ipad' => array(
						'label' => __( '(Ipad) Icon', 'woffice' ),
						'desc'  => __( 'Upload an image (PNG 144px x 144px)', 'woffice' ),
						'type'  => 'upload'
					),
				)
			),
		)
	)
);