<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_theme_setting_menu {

	public $title = 'Theme Settings';
	public $icon = 'fa-th-large';

	public function crazyblog_menu() {
		$return = array(
			array(
				'type' => 'toggle',
				'name' => 'themeRtl',
				'label' => esc_html__( 'RTL', 'crazyblog' ),
				'description' => esc_html__( 'Enable theme RTL', 'crazyblog' ),
			),
			array(
				'type' => 'section',
				'repeating' => true,
				'sortable' => true,
				'title' => esc_html__( 'Color Scheme Settings', 'crazyblog' ),
				'name' => 'color_schemes',
				'description' => esc_html__( 'This section is used for theme color settings', 'crazyblog' ),
				'fields' => array(
					array(
						'type' => 'color',
						'name' => 'custom_color_scheme',
						'label' => esc_html__( 'Colour Scheme', 'crazyblog' ),
						'description' => esc_html__( 'Choose the Custom color scheme for the theme.', 'crazyblog' ),
						'default' => '#EC644B',
					),
				),
			),
			array(
				'type' => 'section',
				'repeating' => false,
				'sortable' => false,
				'title' => esc_html__( 'Layout Settings', 'crazyblog' ),
				'name' => 'layout_settings',
				'description' => esc_html__( 'This section is used for site layout settings', 'crazyblog' ),
				'fields' => array(
					array(
						'type' => 'toggle',
						'name' => 'boxed_layout_status',
						'label' => esc_html__( 'Boxed Layout', 'crazyblog' ),
						'description' => esc_html__( 'Enable to make the layout in boxed version', 'crazyblog' ),
					),
				),
			),
			array(
				'type' => 'section',
				'repeating' => false,
				'sortable' => true,
				'title' => esc_html__( 'Background Settings', 'crazyblog' ),
				'name' => 'background_image_settings',
				'description' => esc_html__( 'This section is used for box layout background settings', 'crazyblog' ),
				'dependency' => array(
					'field' => 'boxed_layout_status',
					'function' => 'vp_dep_boolean',
				),
				'fields' => array(
					array(
						'type' => 'radiobutton',
						'name' => 'background_type',
						'label' => esc_html__( 'Background Type', 'crazyblog' ),
						'items' => array(
							array(
								'value' => 'image',
								'label' => esc_html__( 'Image', 'crazyblog' ),
							),
							array(
								'value' => 'pattern',
								'label' => esc_html__( 'Pattern', 'crazyblog' ),
							),
						),
						'default' => array(
							'image',
						),
					),
					array(
						'type' => 'upload',
						'name' => 'background_image',
						'label' => esc_html__( 'Backegound Image', 'crazyblog' ),
						'description' => esc_html__( 'Insert background image', 'crazyblog' ),
						'default' => '',
						'dependency' => array(
							'field' => 'background_type',
							'function' => 'vp_dep_is_image',
						),
					),
					array(
						'type' => 'select',
						'name' => 'background_repeat',
						'label' => esc_html__( 'Background Repeat', 'crazyblog' ),
						'description' => esc_html__( 'Select to repeat the background or not', 'crazyblog' ),
						'items' => array( array( 'value' => 'repeat', 'label' => 'Repeat' ), array( 'value' => 'no-repeat', 'label' => 'No Repeat' ), ),
						'default' => 'no-repeat',
						'dependency' => array(
							'field' => 'background_type',
							'function' => 'vp_dep_is_image',
						),
					),
					array(
						'type' => 'select',
						'name' => 'background_attachment',
						'label' => esc_html__( 'Background Attachment', 'crazyblog' ),
						'description' => esc_html__( 'Select background attachment to fixed or scroll the image', 'crazyblog' ),
						'items' => array( array( 'value' => 'fixed', 'label' => 'Fixed' ), array( 'value' => 'scroll', 'label' => 'Scroll' ), ),
						'default' => 'fixed',
						'dependency' => array(
							'field' => 'background_type',
							'function' => 'vp_dep_is_image',
						),
					),
					array(
						'type' => 'radioimage',
						'name' => 'patterns',
						'label' => esc_html__( 'Select Patterns', 'crazyblog' ),
						'description' => esc_html__( 'Choose the patterns for boxed version', 'crazyblog' ),
						'items' => array(
							array(
								'value' => '',
								'label' => esc_html__( 'None', 'crazyblog' ),
								'img' => crazyblog_URI . 'core/duffers_panel/panel/public/img/patterns/none.png',
							),
							array(
								'value' => 'pattern-1',
								'label' => esc_html__( 'Pattern 1', 'crazyblog' ),
								'img' => crazyblog_URI . 'core/duffers_panel/panel/public/img/patterns/pattern-1.png',
							),
							array(
								'value' => 'pattern-2',
								'label' => esc_html__( 'Pattern 2', 'crazyblog' ),
								'img' => crazyblog_URI . 'core/duffers_panel/panel/public/img/patterns/pattern-2.png',
							),
							array(
								'value' => 'pattern-3',
								'label' => esc_html__( 'Pattern 3', 'crazyblog' ),
								'img' => crazyblog_URI . 'core/duffers_panel/panel/public/img/patterns/pattern-3.png',
							),
							array(
								'value' => 'pattern-4',
								'label' => esc_html__( 'Pattern 4', 'crazyblog' ),
								'img' => crazyblog_URI . 'core/duffers_panel/panel/public/img/patterns/pattern-4.png',
							),
							array(
								'value' => 'pattern-5',
								'label' => esc_html__( 'Pattern 5', 'crazyblog' ),
								'img' => crazyblog_URI . 'core/duffers_panel/panel/public/img/patterns/pattern-5.png',
							),
							array(
								'value' => 'pattern-6',
								'label' => esc_html__( 'Pattern 6', 'crazyblog' ),
								'img' => crazyblog_URI . 'core/duffers_panel/panel/public/img/patterns/pattern-6.png',
							),
							array(
								'value' => 'pattern-7',
								'label' => esc_html__( 'Pattern 7', 'crazyblog' ),
								'img' => crazyblog_URI . 'core/duffers_panel/panel/public/img/patterns/pattern-7.png',
							),
							array(
								'value' => 'pattern-8',
								'label' => esc_html__( 'Pattern 8', 'crazyblog' ),
								'img' => crazyblog_URI . 'core/duffers_panel/panel/public/img/patterns/pattern-8.png',
							),
							array(
								'value' => 'pattern-9',
								'label' => esc_html__( 'Pattern 9', 'crazyblog' ),
								'img' => crazyblog_URI . 'core/duffers_panel/panel/public/img/patterns/pattern-9.png',
							),
							array(
								'value' => 'pattern-10',
								'label' => esc_html__( 'Pattern 10', 'crazyblog' ),
								'img' => crazyblog_URI . 'core/duffers_panel/panel/public/img/patterns/pattern-10.png',
							),
							array(
								'value' => 'pattern-11',
								'label' => esc_html__( 'Pattern 11', 'crazyblog' ),
								'img' => crazyblog_URI . 'core/duffers_panel/panel/public/img/patterns/pattern-11.png',
							),
							array(
								'value' => 'pattern-12',
								'label' => esc_html__( 'Pattern 12', 'crazyblog' ),
								'img' => crazyblog_URI . 'core/duffers_panel/panel/public/img/patterns/pattern-12.png',
							),
							array(
								'value' => 'pattern-13',
								'label' => esc_html__( 'Pattern 13', 'crazyblog' ),
								'img' => crazyblog_URI . 'core/duffers_panel/panel/public/img/patterns/pattern-13.png',
							),
							array(
								'value' => 'pattern-14',
								'label' => esc_html__( 'Pattern 14', 'crazyblog' ),
								'img' => crazyblog_URI . 'core/duffers_panel/panel/public/img/patterns/pattern-14.png',
							),
						),
						'dependency' => array(
							'field' => 'background_type',
							'function' => 'vp_dep_is_pattern',
						),
					),
				),
			),
		);
		return apply_filters( 'crazyblog_vp_opt_general_', $return );
	}

}
