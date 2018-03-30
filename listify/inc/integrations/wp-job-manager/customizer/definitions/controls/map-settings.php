<?php
/**
 * Map Settings
 *
 * Lazy in one file for now.
 *
 * @uses $wp_customize
 * @since 1.5.0
 */

// google api
$wp_customize->add_setting( 'map-behavior-api-key', array(
	'default' => ''
) );

$wp_customize->add_control( 'map-behavior-api-key', array(
	'label' => __( 'Google Maps API Key', 'listify' ),
	'description' => sprintf( __( 'Learn how to %s', 'listify' ), '<a href="http://listify.astoundify.com/article/856-create-a-google-maps-api-key" target="_blank">' . __( 'create a Google Maps API key', 'listify' ) . '</a>' ),
	'priority' => 10,
	'section' => 'map-settings'
) );

// info trigger
$wp_customize->add_setting( 'map-behavior-trigger', array(
	'default' => 'mouseover'
) );

$wp_customize->add_control( 'map-behavior-trigger', array(
	'label' => __( 'Marker Popup Trigger', 'listify' ),
	'priority' => 20,
	'type' => 'select',
	'choices' => array(
		'mouseover' => __( 'Hover', 'listify' ),
		'click' => __( 'Click', 'listify' )
	),
	'section' => 'map-settings'
) );

// autopan
$wp_customize->add_setting( 'map-behavior-autopan', array(
	'default' => true
) );

$wp_customize->add_control( 'map-behavior-autopan', array(
	'label' => __( 'Autopan to Popup', 'listify' ),
	'type' => 'checkbox',
	'priority' => 25,
	'section' => 'map-settings'
) );

// autofit
$wp_customize->add_setting( 'map-behavior-autofit', array(
	'default' => true
) );

$wp_customize->add_control( 'map-behavior-autofit', array(
	'label' => __( 'Autofit Pins', 'listify' ),
	'description' => __( 'Ensure all active pins are shown in the initial map view.', 'listify' ),
	'type' => 'checkbox',
	'priority' => 28,
	'section' => 'map-settings'
) );

// center
$wp_customize->add_setting( 'map-behavior-center', array(
	'default' => ''
) );

$wp_customize->add_control( 'map-behavior-center', array(
	'label' => __( 'Default Location View', 'listify' ),
	'description' => __( 'The default coordinates view if autofit is disabled. Ex <code>42.0616453, -88.2670675</code>', 'listify' ),
	'priority' => 30,
	'section' => 'map-settings'
) );

// clusters
$wp_customize->add_setting( 'map-behavior-clusters', array(
	'default' => true
) );

$wp_customize->add_control( 'map-behavior-clusters', array(
	'label' => __( 'Cluster Markers in Proximity', 'listify' ),
	'priority' => 50,
	'type' => 'checkbox',
	'section' => 'map-settings'
) );

// grid size
$wp_customize->add_setting( 'map-behavior-grid-size', array(
	'default' => 60 
) );

$wp_customize->add_control( 'map-behavior-grid-size', array(
	'label' => __( 'Cluster Grid Size (px)', 'listify' ),
	'priority' => 60,
	'description' => __( 'How close the markers are before the clusters appear.', 'listify' ),
	'section' => 'map-settings'
) );

// default zoom
$wp_customize->add_setting( 'map-behavior-zoom', array(
	'default' => 3
) );

$wp_customize->add_control( 'map-behavior-zoom', array(
	'label' => __( 'Default Zoom', 'listify' ),
	'description' => __( '<strong>1</strong>: World, <strong>5</strong>: Landmass/continent, <strong>10</strong>: City, <strong>15</strong>: Streets, <strong>20</strong>: Buildings', 'listify' ),
	'choices' => Listify_Customizer_Utils::array_of_numbers(1, 20),
	'type' => 'select',
	'priority' => 70,
	'section' => 'map-settings'
) );

// max zoom in
$wp_customize->add_setting( 'map-behavior-max-zoom', array(
	'default' => 17
) );

$wp_customize->add_control( 'map-behavior-max-zoom', array(
	'label' => __( 'Maximum Zoom In', 'listify' ),
	'description' => __( 'Must be larger than Default Zoom and Maximum Zoom Out', 'listify' ),
	'choices' => Listify_Customizer_Utils::array_of_numbers(1, 20),
	'type' => 'select',
	'priority' => 80,
	'section' => 'map-settings'
) );

// max zoom out
$wp_customize->add_setting( 'map-behavior-max-zoom-out', array(
	'default' => 3
) );

$wp_customize->add_control( 'map-behavior-max-zoom-out', array(
	'label' => __( 'Maximum Zoom Out', 'listify' ),
	'description' => __( 'Must be equal to or larger than Default Zoom and less than Maximum Zoom In', 'listify' ),
	'choices' => Listify_Customizer_Utils::array_of_numbers(1, 20),
	'type' => 'select',
	'priority' => 90,
	'section' => 'map-settings'
) );

// scrollwheel
$wp_customize->add_setting( 'map-behavior-scrollwheel', array(
	'default' => false
) );

$wp_customize->add_control( 'map-behavior-scrollwheel', array(
	'label' => __( 'Zoom with Scrollwheel', 'listify' ),
	'type' => 'checkbox',
	'priority' => 100,
	'section' => 'map-settings'
) );

// search radius
if ( ! listify_has_integration( 'facetwp' ) ) {

	// search default
	$wp_customize->add_setting( 'map-behavior-search-default', array(
		'default' => 50
	) );

	$wp_customize->add_control( 'map-behavior-search-default', array(
		'label' => sprintf( __( 'Search Radius Default (%s)', 'listify' ), $listify_job_manager->map->template->unit() ),
		'priority' => 105,
		'section' => 'map-settings'
	) );

	// search min
	$wp_customize->add_setting( 'map-behavior-search-min', array(
		'default' => 0
	) );

	$wp_customize->add_control( 'map-behavior-search-min', array(
		'label' => sprintf( __( 'Search Radius Min (%s)', 'listify' ), $listify_job_manager->map->template->unit() ),
		'priority' => 110,
		'section' => 'map-settings'
	) );

	// search max
	$wp_customize->add_setting( 'map-behavior-search-max', array(
		'default' => 100
	) );

	$wp_customize->add_control( 'map-behavior-search-max', array(
		'label' => sprintf( __( 'Search Radius Max (%s)', 'listify' ), $listify_job_manager->map->template->unit() ),
		'priority' => 120,
		'section' => 'map-settings'
	) );
}
