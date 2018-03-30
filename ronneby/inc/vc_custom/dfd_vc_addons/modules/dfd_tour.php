<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
 * Add-on Name: Announcement Line
 */
if (!class_exists('Dfd_Tour')) {

	/**
	 * Class Dfd_Announcement
	 */
	class Dfd_Tour {

		/**
		 * Main construct class.
		 */
		function __construct() {
			add_action('init', array($this, '_dfd_tour_init'));
		}

		/**
		 * Block options.
		 */
		function _dfd_tour_init() {
			$module_images_accordion = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/tour/';

			vc_map(array(
				'name' => __('DFD Tour', 'js_composer'),
				'base' => 'dfd_tta_tour',
				'icon' => 'icon-wpb-ui-tab-content-vertical',
				'is_container' => true,
				'show_settings_on_create' => true,
				'as_parent' => array(
					'only' => 'vc_tta_section',
				),
				'category' => __('Ronneby 2.0', 'js_composer'),
				'description' => __('Vertical tabbed content', 'js_composer'),
				'params' => array(
					array(
						'type' => 'radio_image_select',
						'heading' => esc_html__('Style', 'dfd'),
						'description' => '',
						'param_name' => 'style',
						'simple_mode' => false,
						'options' => array(
							'style-1' => array(
								'tooltip' => esc_attr__('Square Background', 'dfd'),
								'src' => $module_images_accordion . 'style-1.png'
							),
							'style-2' => array(
								'tooltip' => esc_attr__('Square Bordered', 'dfd'),
								'src' => $module_images_accordion . 'style-2.png'
							),
							'style-3' => array(
								'tooltip' => esc_attr__('Rounded Bordered', 'dfd'),
								'src' => $module_images_accordion . 'style-3.png'
							),
							'style-4' => array(
								'tooltip' => esc_attr__('Rounded Background', 'dfd'),
								'src' => $module_images_accordion . 'style-4.png'
							),
							'style-5' => array(
								'tooltip' => esc_attr__('Square Underline', 'dfd'),
								'src' => $module_images_accordion . 'style-5.png'
							),
						),
						"value" => "style-1",
					),
					array(
						'type' => 'number',
						'class' => '',
						'heading' => __('Font size', 'dfd'),
						'param_name' => 'font_size',
						'value' => 14,
						'min' => 1,
						'max' => 100,
						'suffix' => 'px',
						'group' => 'Text Style'
					),
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Tab text color", 'dfd'),
						"param_name" => "tab_text_color",
						"value" => "",
						"description" => "",
						'group' => 'Text Style'
					),
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Active tab color text", 'dfd'),
						"param_name" => "tab_active_color_text",
						"value" => "",
						"description" => "",
						'group' => 'Text Style'
					),
					array(
						'type' => 'ult_switch',
						'class' => '',
						'heading' => __('Show text underline in tab', 'dfd'),
						'param_name' => 'underline',
						'value' => 'off',
						'options' => array(
							'on' => array(
								'on' => 'Yes',
								'off' => 'No',
							),
						),
						'group' => 'Text Style'
					),
					array(
						'type' => 'dropdown',
						'param_name' => 'alignment',
						'value' => array(
							__('Left', 'js_composer') => 'left',
							__('Right', 'js_composer') => 'right',
							__('Center', 'js_composer') => 'center',
						),
						'heading' => __('Alignment', 'js_composer'),
						'description' => __('Select tour section title alignment.', 'js_composer'),
						'group' => 'Text Style'
					),
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Tab hover text color", 'dfd'),
						"param_name" => "tab_hover_text_color",
						"value" => "",
						"description" => "",
						'group' => 'Text Style'
					),
					array(
						'type' => 'dropdown',
						'param_name' => 'tab_position',
						'value' => array(
							__('Left', 'js_composer') => 'left',
							__('Right', 'js_composer') => 'right',
						),
						'heading' => __('Position', 'js_composer'),
						'description' => __('Select tour navigation position.', 'js_composer'),
						'group' => 'Tab Style'
					),
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Tab background", 'dfd'),
						"param_name" => "tab_background",
						"value" => "",
						"description" => "",
						'group' => 'Tab Style'
					),
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Tab hover background", 'dfd'),
						"param_name" => "tab_hover_background",
						"value" => "",
						"description" => "",
						'group' => 'Tab Style'
					),
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Active tab background", 'dfd'),
						"param_name" => "active_tab_background",
						"value" => "",
						"description" => "",
						'group' => 'Tab Style'
					),
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Border Color", 'dfd'),
						"param_name" => "border_color_radius",
						"value" => "",
						"description" => "",
						'group' => 'Tab Style'
					),
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Border Color active tab", 'dfd'),
						"param_name" => "border_color_active",
						"value" => "",
						"description" => "",
						'group' => 'Tab Style'
					),
					array(
						'type' => 'number',
						'class' => '',
						'heading' => __('Border radius', 'dfd'),
						'param_name' => 'border_radius',
						'value' => '',
						'min' => 1,
						'max' => 10,
						'suffix' => 'px',
						'group' => 'Tab Style'
					),
					array(
						'type' => 'textfield',
						'param_name' => 'active_section',
						'heading' => __('Active section', 'js_composer'),
						'value' => 1,
						'description' => __('Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'js_composer'),
						'group' => 'Tab Style'
					),
					array(
						'type' => 'dropdown',
						'param_name' => 'controls_size',
						'value' => array(
							__('Medium', 'js_composer') => 'md',
							__('Auto', 'js_composer') => '',
							__('Extra large', 'js_composer') => 'xl',
							__('Large', 'js_composer') => 'lg',
							__('Small', 'js_composer') => 'sm',
							__('Extra small', 'js_composer') => 'xs',
						),
						'heading' => __('Navigation width', 'js_composer'),
						'description' => __('Select tour navigation width.', 'js_composer'),
						'group' => 'Tab Style'
					),
					array(
						'type' => 'dropdown',
						'param_name' => 'spacing',
						'value' => array(
							__('None', 'js_composer') => '',
							'1px' => '1',
							'2px' => '2',
							'3px' => '3',
							'4px' => '4',
							'5px' => '5',
							'10px' => '10',
							'15px' => '15',
							'20px' => '20',
							'25px' => '25',
							'30px' => '30',
							'35px' => '35',
						),
						'heading' => __('Spacing', 'js_composer'),
						'description' => __('Select tour spacing.', 'js_composer'),
						'std' => '5',
						'group' => 'Tab Style'
					),
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Icon Color", 'dfd'),
						"param_name" => "icon_color",
						"value" => "",
						"description" => "",
						'group' => 'Icon Style'
					),
					array(
						'type' => 'number',
						'class' => '',
						'heading' => __('Icon size', 'dfd'),
						'param_name' => 'icon_size',
						'value' => 14,
						'min' => 1,
						'max' => 100,
						'suffix' => 'px',
						'group' => 'Icon Style'
					),
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Background color content area", 'dfd'),
						"param_name" => "color_content_area",
						"value" => "",
						"description" => "",
						'group' => 'Content Style'
					),
					array(
						'type' => 'dropdown',
						'param_name' => 'gap',
						'value' => array(
							'20px' => '20',
							__('None', 'js_composer') => '',
							'1px' => '1',
							'2px' => '2',
							'3px' => '3',
							'4px' => '4',
							'5px' => '5',
							'10px' => '10',
							'15px' => '15',
							'25px' => '25',
							'30px' => '30',
							'35px' => '35',
						),
						'heading' => __('Gap', 'js_composer'),
						'description' => __('Select tour gap.', 'js_composer'),
						'group' => 'Content Style'
					),
					array(
						'type' => 'ult_switch',
						'class' => '',
						'heading' => __('Show separator line between tabs and content', 'dfd'),
						'param_name' => 'show_separator_line',
						'value' => 'on',
						'options' => array(
							'on' => array(
								'on' => 'Yes',
								'off' => 'No',
							),
						),
						'group' => 'Content Style'
					),
					array(
						'type' => 'dropdown',
						'param_name' => 'pagination_style',
						'value' => array(
							__('None', 'js_composer') => '',
							/* Dfd style pagination */
							__('Dfd Style rounded', 'js_composer') => 'dfdrounded-',
							__('Dfd Style fill rounded', 'js_composer') => 'dfdfillrounded-',
							__('Dfd Style fill square', 'js_composer') => 'dfdfillsquare-',
							__('Dfd Style empty rounded', 'js_composer') => 'dfdemptyrounded-',
							__('Dfd Style line', 'js_composer') => 'dfdline-',
							__('Dfd Style advance square', 'js_composer') => 'dfdadvancesquare-',
						),
						'heading' => __('Pagination style', 'js_composer'),
						'description' => __('Select pagination style.', 'js_composer'),
					),
					array(
						'type' => 'dropdown',
						'param_name' => 'autoplay',
						'value' => array(
							__('None', 'js_composer') => 'none',
							'1' => '1',
							'2' => '2',
							'3' => '3',
							'4' => '4',
							'5' => '5',
							'10' => '10',
							'20' => '20',
							'30' => '30',
							'40' => '40',
							'50' => '50',
							'60' => '60',
						),
						'std' => 'none',
						'heading' => __('Autoplay', 'js_composer'),
						'description' => __('Select auto rotate for tour in seconds (Note: disabled by default).', 'js_composer'),
					),
					array(
						'type' => 'textfield',
						'heading' => __('Extra class name', 'js_composer'),
						'param_name' => 'el_class',
						'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer'),
					),
					array(
						'type' => 'css_editor',
						'heading' => __('CSS box', 'js_composer'),
						'param_name' => 'css',
						'group' => __('Design Options', 'js_composer'),
					),
						array(
								'type'       => 'dropdown',
								'class'      => '',
								'heading'    => esc_html__( 'Animation', 'dfd' ),
								'param_name' => 'module_animation',
								'value'      => dfd_module_animation_styles(),
							),
				),
				'js_view' => 'VcBackendTtaTourView',
				'custom_markup' => '
<div class="vc_tta-container" data-vc-action="collapse">
	<div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-left vc_tta-controls-align-left">
		<div class="vc_tta-tabs-container">'
				. '<ul class="vc_tta-tabs-list">'
				. '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}"><a href="javascript:;" data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}" data-vc-tabs>{{ section_title }}</a></li>'
				. '</ul>
		</div>
		<div class="vc_tta-panels {{container-class}}">
		  {{ content }}
		</div>
	</div>
</div>',
				'default_content' => '
[vc_tta_section title="' . sprintf('%s %d', __('Section', 'js_composer'), 1) . '"][/vc_tta_section]
[vc_tta_section title="' . sprintf('%s %d', __('Section', 'js_composer'), 2) . '"][/vc_tta_section]
	',
				'admin_enqueue_js' => array(
					vc_asset_url('lib/vc_tabs/vc-tabs.min.js')
				),
				'front_enqueue_js' => get_template_directory_uri() . '/assets/js/tabsModelextended.js'
			));
		}

	}

}
if (class_exists('Dfd_Accordion')) {
	$Dfd_Tour = new Dfd_Tour;
}
