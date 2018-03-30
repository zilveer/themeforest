<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_filter( 'cmb_meta_boxes', 'to_top_metaboxes' );

/**
 * Special Features Metabox.
 *
 * @param array $meta_boxes Metabox options.
 *
 * @return array
 */
function to_top_metaboxes( array $meta_boxes ) {
	//$types = get_post_types( array( 'public' => true ) );
	//$types = array_keys( $types );

	$meta_boxes[] = array(
		'id'         => 'dfd_special_features_box',
		'title'      => esc_attr__( 'Special Features', 'dfd' ),
		'pages'      =>  array('page','post','my-product','product','gallery'),
		'context'    => 'side',
		'priority'   => 'default',
		'show_names' => true,
		'fields'     => array(
			array(
				'name' => esc_attr__( 'Enable white space', 'dfd' ),
				'desc' => '',
				'id'   => 'dfd_enable_page_spacer',
				'type' => 'checkbox',
			),
			array(
				'name' => esc_attr__( 'Parallax footer', 'dfd' ),
				'desc' => esc_attr__( 'Please check this checkbox if you would like to enable parallax effect for footer section', 'dfd' ),
				'id'   => 'crum_page_custom_footer_parallax',
				'type' => 'checkbox',
			),
		),
	);

	return $meta_boxes;
}
