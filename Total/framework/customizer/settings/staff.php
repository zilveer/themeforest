<?php
/**
 * Staff Customizer Options
 *
 * @package Total WordPress Theme
 * @subpackage Customizer
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Single blocks
$blocks = apply_filters( 'wpex_staff_single_blocks', array(
	'title'    => esc_html__( 'Post Title', 'total' ),
	'meta'    => esc_html__( 'Meta', 'total' ),
	'media'    => esc_html__( 'Media', 'total' ),
	'content'  => esc_html__( 'Content', 'total' ),
	'share'    => esc_html__( 'Social Share', 'total' ),
	'comments' => esc_html__( 'Comments', 'total' ),
	'related'  => esc_html__( 'Related Posts', 'total' ),
) );

// Archives
$this->sections['wpex_staff_archives'] = array(
	'title' => esc_html__( 'Archives', 'total' ),
	'panel' => 'wpex_staff',
	'desc' => esc_html__( 'The following options are for the post type category and tag archives.', 'total' ),
	'settings' => array(
		array(
			'id' => 'staff_archive_layout',
			'default' => 'full-width',
			'control' => array(
				'label' => esc_html__( 'Layout', 'total' ),
				'type' => 'select',
				'choices' => $post_layouts,
			),
		),
		array(
			'id' => 'staff_archive_grid_style',
			'default' => 'fit-rows',
			'control' => array(
				'label' => esc_html__( 'Grid Style', 'total' ),
				'type' => 'select',
				'choices' => array(
					'fit-rows' => esc_html__( 'Fit Rows','total' ),
					'masonry' => esc_html__( 'Masonry','total' ),
					'no-margins' => esc_html__( 'No Margins','total' ),
				),
			),
		),
		array(
			'id' => 'staff_archive_grid_equal_heights',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Equal Heights', 'total' ),
				'type' => 'checkbox',
				'desc'   => esc_html__( 'Displays the content containers (with the title and excerpt) in equal heights. Will NOT work with the "Masonry" layouts.', 'total' ),
			),
		),
		array(
			'id' => 'staff_entry_columns',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Columns', 'total' ),
				'type' => 'select',
				'choices' => wpex_grid_columns(),
			),
		),
		array(
			'id' => 'staff_archive_posts_per_page',
			'default' => '12',
			'control' => array(
				'label' => esc_html__( 'Posts Per Page', 'total' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'staff_entry_overlay_style',
			'default' => 'none',
			'control' => array(
				'label' => esc_html__( 'Archives Entry: Image Overlay', 'total' ),
				'type' => 'select',
				'choices' => wpex_overlay_styles_array()
			),
		),
		array(
			'id' => 'staff_entry_details',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Archives Entry: Details', 'total' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'staff_entry_position',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Archives Entry: Position', 'total' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'staff_entry_excerpt_length',
			'default' => '20',
			'control' => array(
				'label' => esc_html__( 'Archives Entry: Excerpt Length', 'total' ),
				'type' => 'text',
				'desc' => esc_html__( 'Enter 0 or leave blank to disable', 'total' ),
			),
		),
		array(
			'id' => 'staff_entry_social',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Archives Entry: Social Links', 'total' ),
				'type' => 'checkbox',
			),
		),
	),
);

// Single
$this->sections['wpex_staff_single'] = array(
	'title' => esc_html__( 'Single', 'total' ),
	'panel' => 'wpex_staff',
	'settings' => array(
		array(
			'id' => 'staff_single_layout',
			'default' => 'right-sidebar',
			'control' => array(
				'label' => esc_html__( 'Layout', 'total' ),
				'type' => 'select',
				'choices' => $post_layouts,
			),
		),
		array(
			'id' => 'staff_single_header_position',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Display Position Under Title', 'total' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'staff_next_prev',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Next & Previous Links', 'total' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'staff_related_title',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Related Posts Title', 'total' ),
				'type' => 'text',
				'active_callback' => 'wpex_cac_has_staff_related',
			),
		),
		array(
			'id' => 'staff_related_count',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Related Posts Count', 'total' ),
				'type' => 'text',
				'active_callback' => 'wpex_cac_has_staff_related',
			),
		),
		array(
			'id' => 'staff_related_columns',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Related Posts Columns', 'total' ),
				'type' => 'select',
				'choices' => wpex_grid_columns(),
				'active_callback' => 'wpex_cac_has_staff_related',
			),
		),
		array(
			'id' => 'staff_related_excerpts',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Related Posts Content', 'total' ),
				'type' => 'checkbox',
				'active_callback' => 'wpex_cac_has_staff_related',
			),
		),
		array(
			'id' => 'staff_post_composer',
			'default' => 'content,related',
			'control' => array(
				'label' => esc_html__( 'Post Layout Elements', 'total' ),
				'type' => 'wpex-sortable',
				'choices' => $blocks,
				'desc' => esc_html__( 'Click and drag and drop elements to re-order them.', 'total' ),
			),
		),
	),
);

// Unset vars
unset( $blocks );