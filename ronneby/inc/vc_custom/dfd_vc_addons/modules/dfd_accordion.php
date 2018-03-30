<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/*
 * Add-on Name: Announcement Line
 */
if (!class_exists('Dfd_Accordion')) {

	/**
	 * Class Dfd_Announcement
	 */
	class Dfd_Accordion {

		/**
		 * Main construct class.
		 */
		function __construct() {
			add_action('init', array ($this, '_dfd_accordion_init'));
//			add_shortcode('dfd_accordion', array ($this, '_dfd_accordion_shortcode'));
		}

		/**
		 * Block options.
		 */
		function _dfd_accordion_init() {
			$module_images_accordion = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/accordion/';

			vc_map(array (
					'name' => __('DFD Accordion', 'js_composer'),
					'base' => 'dfd_accordion',
					'icon' => 'icon-wpb-ui-accordion',
					'is_container' => true,
					'show_settings_on_create' => true,
					'as_parent' => array (
							'only' => 'vc_tta_section',
					),
					'category' => __('Ronneby 2.0', 'js_composer'),
					'description' => __('Collapsible content panels', 'js_composer'),
					'params' => array (
							array (
									'type' => 'radio_image_select',
									'heading' => esc_html__('Style', 'dfd'),
									'description' => '',
									'param_name' => 'style',
									'simple_mode' => false,
									'options'     => array(
										'style-1'	=> array(
											'tooltip'	=> esc_attr__('Square Bordered','dfd'),
											'src'		=> $module_images_accordion . 'style-1.png'
										),
										'style-2'	=> array(
											'tooltip'	=> esc_attr__('Square Background','dfd'),
											'src'		=> $module_images_accordion . 'style-2.png'
										),
										'style-3'	=> array(
											'tooltip'	=> esc_attr__('Round Bordered','dfd'),
											'src'		=> $module_images_accordion . 'style-3.png'
										),
										'style-4'	=> array(
											'tooltip'	=> esc_attr__('Round Background','dfd'),
											'src'		=> $module_images_accordion . 'style-4.png'
										),
										'style-6'	=> array(
											'tooltip'	=> esc_attr__('Square Underline','dfd'),
											'src'		=> $module_images_accordion . 'style-6.png'
										),
									),
									"value" => "style-2",
							),
							array (
									'type' => 'dropdown',
									'param_name' => 'autoplay',
									'value' => array (
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
									'description' => __('Select auto rotate for accordion in seconds (Note: disabled by default).', 'js_composer'),
							),
							array (
									'edit_field_class' => 'vc_ui-panel',
									'type' => 'checkbox',
									'param_name' => 'collapsible_all',
									'heading' => __('Allow collapse all?', 'js_composer'),
									'description' => __('Allow collapse all accordion sections.', 'js_composer'),
							),
							
							// Control Icons END
							array (
									'type' => 'textfield',
									'param_name' => 'active_section',
									'heading' => __('Active section', 'js_composer'),
									'value' => 1,
									'description' => __('Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'js_composer'),
							),
							
							array (
									'type' => 'number',
									'class' => '',
									'heading' => __('Border radius', 'dfd'),
									'param_name' => 'border_radius',
									'value' => '',
									'min' => 1,
									'max' => 10,
									'suffix' => 'px',
									'group' => "Tabs Style",
							),
							array (
									"type" => "colorpicker",
									"class" => "",
									"heading" => __("Tab background", 'dfd'),
									"param_name" => "tab_background",
									"value" => "",
									"description" => "",
									'group' => "Tabs Style",
							),
							array (
									"type" => "colorpicker",
									"class" => "",
									"heading" => __("Tab hover background", 'dfd'),
									"param_name" => "tab_hover_background",
									"value" => "",
									"description" => "",
									'group' => "Tabs Style",
							),
							array (
									"type" => "colorpicker",
									"class" => "",
									"heading" => __("Active tab background", 'dfd'),
									"param_name" => "active_tab_background",
									"value" => "",
									"description" => "",
									'group' => "Tabs Style",
							),
							array (
									"type" => "colorpicker",
									"class" => "",
									"heading" => __("Border Color", 'dfd'),
									"param_name" => "border_color_radius",
									"value" => "",
									"description" => "",
									'group' => "Tabs Style",
							),
							array (
									"type" => "colorpicker",
									"class" => "",
									"heading" => __("Border Color active tab", 'dfd'),
									"param_name" => "border_color_active",
									"value" => "",
									"description" => "",
									'group' => "Tabs Style",
							),
							array (
									"type" => "colorpicker",
									"class" => "",
									"heading" => __("Background color content area", 'dfd'),
									"param_name" => "color_content_area",
									"value" => "",
									"description" => "",
									'group' => "Content Style",
							),
							array (
									'type' => 'dropdown',
									'param_name' => 'c_align',
									'value' => array (
											__('Left', 'js_composer') => 'left',
											__('Right', 'js_composer') => 'right',
											__('Center', 'js_composer') => 'center',
									),
									'heading' => __('Alignment', 'js_composer'),
									'description' => __('Select accordion section title alignment.', 'js_composer'),
									'group' => "Text Style",
							),
							array (
									'type' => 'number',
									'class' => '',
									'heading' => __('Font size', 'dfd'),
									'param_name' => 'font_size',
									'value' => 14,
									'min' => 1,
									'max' => 100,
									'suffix' => 'px',
									'group' => "Text Style",
							),
							array (
									"type" => "colorpicker",
									"class" => "",
									"heading" => __("Tab hover text color", 'dfd'),
									"param_name" => "tab_hover_text_color",
									"value" => "",
									"description" => "",
									'group' => "Text Style",
							),
							array (
									"type" => "colorpicker",
									"class" => "",
									"heading" => __("Tab text color", 'dfd'),
									"param_name" => "tab_text_color",
									"value" => "",
									"description" => "",
									'group' => "Text Style",
							),
							array (
									"type" => "colorpicker",
									"class" => "",
									"heading" => __("Active tab color text", 'dfd'),
									"param_name" => "tab_active_color_text",
									"value" => "",
									"description" => "",
									'group' => "Text Style",
							),
							array (
									'type' => 'ult_switch',
									'class' => '',
									'heading' => __('Show text underline in tab', 'dfd'),
									'param_name' => 'underline',
									'value' => 'off',
									'options' => array (
											'on' => array (
													'on' => 'Yes',
													'off' => 'No',
											),
									),
									'group' => "Text Style",
							),
							
							array (
									'type' => 'dropdown',
									'param_name' => 'c_icon',
									'edit_field_class' => 'vc_ui-panel',
									'value' => array (
											__('None', 'js_composer') => '',
											__('Chevron', 'js_composer') => 'chevron',
											__('Plus', 'js_composer') => 'plus',
											__('Triangle', 'js_composer') => 'triangle',
									),
									'std' => 'plus',
									'heading' => __('Icon', 'js_composer'),
									'description' => __('Select accordion navigation icon.', 'js_composer'),
									'group' => "Icon Style",
							),
							// Control Icons
							array (
									'type' => 'dropdown',
									'param_name' => 'c_position',
									'value' => array (
											__('Left', 'js_composer') => 'left',
											__('Right', 'js_composer') => 'right',
									),
									'dependency' => array (
											'element' => 'c_icon',
											'not_empty' => true,
									),
									'heading' => __('Section icon Position', 'js_composer'),
									'description' => __('Select accordion open/close icon position.', 'js_composer'),
									'group' => "Icon Style",
							),
								array (
									'type' => 'dropdown',
									'param_name' => 'c_icon_position',
									'value' => array (
											__('Left', 'js_composer') => 'left',
											__('Right', 'js_composer') => 'right',
									),
									'dependency' => array (
											'element' => 'c_icon',
											'not_empty' => true,
									),
									'heading' => __('Icon Position', 'js_composer'),
									'description' => __('Select accordion icon position.', 'js_composer'),
									'group' => "Icon Style",
							),
							array (
									"type" => "colorpicker",
									"class" => "",
									"heading" => __("Icon Color", 'dfd'),
									"param_name" => "icon_color",
									"value" => "",
									"description" => "",
									'group' => "Icon Style",
							),
							array (
									'type' => 'number',
									'class' => '',
									'heading' => __('Icon size', 'dfd'),
									'param_name' => 'icon_size',
									'value' => 14,
									'min' => 1,
									'max' => 100,
									'suffix' => 'px',
									'group' => "Icon Style",
							),
							array (
									'type' => 'css_editor',
									'heading' => __('CSS box', 'js_composer'),
									'param_name' => 'css',
									'group' => __('Design Options', 'js_composer'),
							),
							array (
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
					'js_view' => 'VcBackendTtaAccordionView',
					'custom_markup' => '
<div class="vc_tta-container" data-vc-action="collapseAll">
	<div class="vc_general vc_tta vc_tta-accordion vc_tta-color-backend-accordion-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-o-shape-group vc_tta-controls-align-left vc_tta-gap-2">
	   <div class="vc_tta-panels vc_clearfix {{container-class}}">
	      {{ content }}
	      <div class="vc_tta-panel vc_tta-section-append">
	         <div class="vc_tta-panel-heading">
	            <h4 class="vc_tta-panel-title vc_tta-controls-icon-position-left">
	               <a href="javascript:;" aria-expanded="false" class="vc_tta-backend-add-control">
	                   <span class="vc_tta-title-text">' . __('Add Section', 'js_composer') . '</span>
	                    <i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i>
					</a>
	            </h4>
	         </div>
	      </div>
	   </div>
	</div>
</div>',
					'default_content' => '[vc_tta_section title="' . sprintf('%s %d', __('Section', 'js_composer'), 1) . '"][/vc_tta_section][vc_tta_section title="' . sprintf('%s %d', __('Section', 'js_composer'), 2) . '"][/vc_tta_section]',
			));
		}

		/**
		 * Shortcode handler function.
		 *
		 * @param array  $atts    Shortcode atributes.
		 * @param string $content Text Field.
		 *
		 * @return string
		 */
		function _dfd_accordion_shortcode($atts, $content) {
//			return  "Hello";
		}

	}

}
if (class_exists('Dfd_Accordion')) {
	$Dfd_Accordion = new Dfd_Accordion;
}
