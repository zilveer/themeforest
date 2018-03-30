<?php
/**
 * FacetWP
 *
 * @uses $wp_customize
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! listify_has_integration( 'facetwp' ) ) {
	return;
}

global $listify_facetwp;

$wp_customize->add_setting( 'listing-archive-facetwp-position', array(
	'default' => 'side'
) );

$wp_customize->add_control( 'listing-archive-facetwp-position', array(
	'label' => __( 'Display Position', 'listify' ),
	'description' => __( 'Map must be output on top to output filters on the side.', 'listify' ),
	'type' => 'select',
	'choices' => array(
		'side' => __( 'Side', 'listify' ),
		'top' => __( 'Top', 'listify' )
	),
	'section' => 'search-filters',
	'priority' => 20
) );

$wp_customize->add_setting( 'facetwp-header-search-facet', array(
	'default' => 'keyword'
) );

$wp_customize->add_control( new Listify_Customize_Control_Multiselect(
	$wp_customize,
	'facetwp-header-search-facet', 
	array(
		'label' => __( 'Header Search Filter', 'listify' ),
		'description' => __( 'The filter to use when the search icon is toggled in the page header.', 'listify' ),
		'type' => 'multiselect',
		'choices' => $listify_facetwp->get_facet_choices( array( 'checkboxes', 'dropdown', 'fselect', 'hierarchy', 'slider', 'date_range', 'number_range', 'proximity' ) ),
		'section' => 'search-filters',
		'priority' => 25 
	) 
) );

$wp_customize->add_setting( 'listing-archive-facetwp-home', array(
	'default' => array( 'keyword', 'location', 'category' )
) );

$wp_customize->add_control( new Listify_Customize_Control_Multiselect(
	$wp_customize,
	'listing-archive-facetwp-home', 
	array(
		'label' => __( 'Homepage Filters', 'listify' ),
		'type' => 'multiselect',
		'description' => __( '3-4 facets recommended on the homepage hero search.', 'listify' ),
		'choices' => $listify_facetwp->get_facet_choices( apply_filters( 'listify_facetwp_homepage_blacklist', array( 'checkboxes', 'slider', 'date_range', 'number_range' ) ) ),
		'section' => 'search-filters',
		'priority' => 30
	)
) );

$wp_customize->add_setting( 'listing-archive-facetwp-defaults', array(
	'default' => 'keyword, location, category'
) );

$wp_customize->add_control( new Listify_Customize_Control_Multiselect(
	$wp_customize,
	'listing-archive-facetwp-defaults', 
	array(
		'label' => __( 'Results Page Filters', 'listify' ),
		'description' => __( 'The facets chosen for the homepage and header must be included here to allow those filters to be updated.', 'listify' ),
		'type' => 'multiselect',
		'choices' => $listify_facetwp->get_facet_choices(),
		'section' => 'search-filters',
		'priority' => 40
	) 
) );

$wp_customize->add_setting( 'listing-archive-facetwp-more', array(
	'default' => array()
) );

$wp_customize->add_control( new Listify_Customize_Control_Multiselect(
	$wp_customize,
	'listing-archive-facetwp-more', 
	array(
		'label' => __( 'Extra Results Page Filters', 'listify' ),
		'description' => __( 'These filters are hidden by default with an option to expand.', 'listify' ),
		'type' => 'multiselect',
		'choices' => $listify_facetwp->get_facet_choices(),
		'section' => 'search-filters',
		'priority' => 50
	) 
) );
