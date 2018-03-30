<?php
/**
 * Registering meta sections for taxonomies
 *
 * All the definitions of meta sections are listed below with comments, please read them carefully.
 * Note that each validation method of the Validation Class MUST return value.
 *
 * You also should read the changelog to know what has been changed
 *
 */

// Hook to 'admin_init' to make sure the class is loaded before
// (in case using the class in another plugin)
add_action( 'admin_init', 'bk_register_taxonomy_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
function bk_register_taxonomy_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Taxonomy_Meta' ) )
		return;

	$meta_sections = array();

	// First meta section
	$meta_sections[] = array(
		'title'      => __('BK Category Options','bkninja'),             // section title
		'taxonomies' => array('category', 'post_tag'), // list of taxonomies. Default is array('category', 'post_tag'). Optional
		'id'         => 'bk_cat_opt',                 // ID of each section, will be the option name

		'fields' => array(                             // List of meta fields
			// SELECT
			array(
				'name'    => __('Category layout','bkninja'),
				'id'      => 'cat_layout',
				'type'    => 'select',
				'options' => array('global' => __('Global setting','bkninja'),'grid-2' => __('Grid 2 columns','bkninja'), 'grid-3' => __('Grid 3 columns','bkninja'), 'card' => __('Cards', 'bkninja'),'masonry-2'=>__('Masonry 2 columns', 'bkninja'), 'masonry-3'=>__('Masonry 3 columns', 'bkninja'), 'classic-big'=>__('Classic big thumbnail', 'bkninja'), 'classic-small'=>__('Classic small thumbnail', 'bkninja')),
                'std' => 'global',
                'desc' => __('Global setting option is set in Theme Option panel','bkninja')
			),
            // CHECKBOX
			array(
				'name' => __('Display featured slider','bkninja'),
				'id'   => 'cat_feat',
				'type' => 'checkbox',
			),
		),
	);

	foreach ( $meta_sections as $meta_section )
	{
		new RW_Taxonomy_Meta( $meta_section );
	}
}
