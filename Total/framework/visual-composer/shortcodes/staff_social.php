<?php
/**
 * Visual Composer Staff Social
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @version 3.3.0
 */

function vcex_staff_social_vc_map() {
	return array(
		'name' => esc_html__( 'Staff Social Links', 'total' ),
		'description' => esc_html__( 'Single staff social links', 'total' ),
		'base' => 'staff_social',
		'category' => wpex_get_theme_branding(),
		'icon' => 'vcex-staff-social vcex-icon fa fa-share-alt',
		'params' => array(
			array(
				'type' => 'autocomplete',
				'heading' => esc_html__( 'Staff Member ID', 'total' ),
				'param_name' => 'post_id',
				'admin_label' => true,
				'param_holder_class' => 'vc_not-for-custom',
				'description' => esc_html__( 'Select a staff member to display their social links. By default it will diplay the current staff member links.', 'total'),
				'settings' => array(
					'multiple' => false,
					'min_length' => 1,
					'groups' => false,
					'unique_values' => true,
					'display_inline' => true,
					'delay' => 0,
					'auto_focus' => true,
				),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Style', 'total' ),
				'param_name' => 'style',
				'value' => array_flip( wpex_social_button_styles() ),
				'admin_label' => true,
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Link Target', 'total' ),
				'param_name' => 'link_target',
				'value' => array(
					__( 'Blank', 'total' ) => 'blank',
					__( 'Self', 'total') => 'self',
				),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'total' ),
				'param_name' => 'font_size',
			),
			array(
				'type' => 'css_editor',
				'heading' => esc_html__( 'CSS', 'total' ),
				'param_name' => 'css',
				'group' => esc_html__( 'CSS', 'total' ),
			),
		)
	);
}
vc_lean_map( 'staff_social', 'vcex_staff_social_vc_map' );

// Get autocomplete suggestion
add_filter( 'vc_autocomplete_staff_social_post_id_callback', 'vcex_suggest_staff_members', 10, 1 );

// Render autocomplete suggestions
add_filter( 'vc_autocomplete_staff_social_post_id_render', 'vcex_render_staff_members', 10, 1 );