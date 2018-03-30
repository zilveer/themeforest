<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
 * Add-on Name: Announcement Line
 */
if (!class_exists('Dfd_Tabs')) {

	/**
	 * Class Dfd_Announcement
	 */
	class Dfd_Tabs {

		/**
		 * Main construct class.
		 */
		function __construct() {
			add_action('init', array($this, '_dfd_tabs_init'));
		}

		/**
		 * Block options.
		 */
		function _dfd_tabs_init() {
			$module_images_accordion = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/tabs/';

			vc_map(array(
				'name' => __('DFD Tabs', 'js_composer'),
				'base' => 'dfd_tta_tabs',
				'icon' => 'icon-wpb-ui-tab-content',
				'is_container' => true,
				'show_settings_on_create' => true,
				'as_parent' => array(
					'only' => 'vc_tta_section',
				),
				'category' => __('Ronneby 2.0', 'dfd'),
				'description' => __('Tabbed content', 'js_composer'),
				'params' => array(
					array(
						'type' => 'radio_image_select',
						'heading' => esc_html__('Style', 'dfd'),
						'description' => '',
						'param_name' => 'style',
						'simple_mode' => false,
						'options' => array(
							'classic' => array(
								'tooltip' => esc_attr__('Classic Rounded', 'dfd'),
								'src' => $module_images_accordion . 'classic.png'
							),
							'classic_empty' => array(
								'tooltip' => esc_attr__('Simple', 'dfd'),
								'src' => $module_images_accordion . 'classic_empty.png'
							),
							'collapse' => array(
								'tooltip' => esc_attr__('Square Background', 'dfd'),
								'src' => $module_images_accordion . 'collapse.png'
							),
							'big_icon' => array(
								'tooltip' => esc_attr__('Big Icon', 'dfd'),
								'src' => $module_images_accordion . 'big_icon.png'
							),
						),
						"value" => "classic",
					),
					array(
						'type' => 'number',
						'class' => '',
						'heading' => __('Border radius', 'dfd'),
						'param_name' => 'border_radius',
						'value' => 42,
						'min' => 1,
						'max' => 100,
						'suffix' => 'px',
						'weight' => 450,
						'dependency' => Array('element' => 'style', 'value' => array("classic", "classic_empty")),
						'group' => 'Tabs Style'
					),
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Border Color", 'dfd'),
						"param_name" => "border_color_radius",
						"value" => "",
						"description" => "",
						'weight' => 400,
						'group' => 'Tabs Style'
					),
					array(
						'type' => 'dropdown',
						'param_name' => 'tab_position',
						'value' => array(
							__('Top', 'js_composer') => 'top',
							__('Bottom', 'js_composer') => 'bottom',
						),
						'heading' => __('Position', 'js_composer'),
						'description' => __('Select tabs navigation position.', 'js_composer'),
						'group' => 'Tabs Style'
					),
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Tab background", 'dfd'),
						"param_name" => "tab_background",
						"value" => "",
						"description" => "",
						'group' => 'Tabs Style'
					),
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Tab hover background", 'dfd'),
						"param_name" => "tab_hover_background",
						"value" => "",
						"description" => "",
						'group' => 'Tabs Style'
					),
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Active tab background", 'dfd'),
						"param_name" => "active_tab_background",
						"value" => "",
						"description" => "",
						'group' => 'Tabs Style'
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
						'weight' => 450,
						'dependency' => Array('element' => 'style', 'value' => array("classic", "classic_empty", "collapse")),
						'group' => 'Text Style'
					),
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Tab text color", 'dfd'),
						"param_name" => "tab_text_color",
						"value" => "",
						"description" => "",
						'dependency' => Array('element' => 'style', 'value' => array("classic", "classic_empty", "collapse")),
						'group' => 'Text Style'
					),
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Tab hover text color", 'dfd'),
						"param_name" => "tab_hover_text_color",
						"value" => "",
						"description" => "",
						'dependency' => Array('element' => 'style', 'value' => array("classic", "classic_empty", "collapse")),
						'group' => 'Text Style'
					),
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Active tab color text", 'dfd'),
						"param_name" => "tab_active_color_text",
						"value" => "",
						"description" => "",
						'dependency' => Array('element' => 'style', 'value' => array("classic", "classic_empty", "collapse")),
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
						'weight' => 300,
						'dependency' => Array('element' => 'style', 'value' => array("classic_empty")),
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
						'description' => __('Select tabs section title alignment.', 'js_composer'),
						'group' => 'Text Style'
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
						'weight' => 400,
						'group' => 'Content Style'
					),
					array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Background color content area", 'dfd'),
						"param_name" => "color_content_area",
						"value" => "",
						"description" => "",
						'weight' => 350,
						'group' => 'Content Style'
					),
					array(
						'type' => 'dropdown',
						'param_name' => 'gap',
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
						'heading' => __('Gap', 'js_composer'),
						'description' => __('Select tabs gap.', 'js_composer'),
						'group' => 'Content Style'
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
						'value' => 30,
						'min' => 1,
						'max' => 100,
						'suffix' => 'px',
						'group' => 'Icon Style'
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
						'description' => __('Select auto rotate for tabs in seconds (Note: disabled by default).', 'js_composer'),
					),
					array(
						'type' => 'textfield',
						'param_name' => 'active_section',
						'heading' => __('Active section', 'js_composer'),
						'value' => 1,
						'description' => __('Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'js_composer'),
					),
					array(
						'type' => 'css_editor',
						'heading' => __('CSS box', 'js_composer'),
						'param_name' => 'css',
						'group' => __('Design Options', 'js_composer'),
					),
					array(
						'type' => 'textfield',
						'heading' => __('Extra class name', 'js_composer'),
						'param_name' => 'el_class',
						'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer'),
					),
						array(
								'type'       => 'dropdown',
								'class'      => '',
								'heading'    => esc_html__( 'Animation', 'dfd' ),
								'param_name' => 'module_animation',
								'value'      => dfd_module_animation_styles(),
							),
				),
				'js_view' => 'VcBackendTtaTabsView',
				'custom_markup' => '
<div class="vc_tta-container" data-vc-action="collapse">
	<div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
		<div class="vc_tta-tabs-container">'
				. '<ul class="vc_tta-tabs-list">'
				. '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="vc_tta_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">{{ section_title }}</span></a></li>'
				. '</ul>
		</div>
		<div class="vc_tta-panels vc_clearfix {{container-class}}">
		  {{ content }}
		</div>
	</div>
</div>',
				'default_content' => '
[vc_tta_section title="' . sprintf('%s %d', __('Tab', 'js_composer'), 1) . '"][/vc_tta_section]
[vc_tta_section title="' . sprintf('%s %d', __('Tab', 'js_composer'), 2) . '"][/vc_tta_section]
	',
				'admin_enqueue_js' => array(
					vc_asset_url('lib/vc_tabs/vc-tabs.min.js'),
				),
				'front_enqueue_js' => get_template_directory_uri() . '/assets/js/tabsModelextended.js'
			));
		}

	}

}
if (class_exists('Dfd_Tabs')) {
	$Dfd_Tour = new Dfd_Tabs;
}
