<?php
namespace SupremaQodef\Modules\Shortcodes\CallToAction;

use SupremaQodef\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class CallToAction
 */
class CallToAction implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'qodef_call_to_action';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 *
	 * @see qode_core_get_carousel_slider_array_vc()
	 */
	public function vcMap() {

		$call_to_action_button_icons_array = array();
		$call_to_action_button_IconCollections = suprema_qodef_icon_collections()->iconCollections;
		foreach($call_to_action_button_IconCollections as $collection_key => $collection) {

			$call_to_action_button_icons_array[] = array(
				'type' => 'dropdown',
				'heading' => 'Button Icon',
				'param_name' => 'button_'.$collection->param,
				'value' => $collection->getIconsArray(),
				'save_always' => true,
				'dependency' => Array('element' => 'button_icon_pack', 'value' => array($collection_key))
			);

		}

		vc_map( array(
				'name' => esc_html__('Select Call To Action', 'suprema'),
				'base' => $this->getBase(),
				'category' => 'by SELECT',
				'icon' => 'icon-wpb-call-to-action extended-custom-icon',
				'allowed_container_element' => 'vc_row',
				'params' => array_merge(
					array(
						array(
							'type'          => 'dropdown',
							'heading'       => 'Full Width',
							'param_name'    => 'full_width',
							'admin_label'	=> true,
							'value'         => array(
								'Yes'       => 'yes',
								'No'        => 'no'
							),
							'save_always' 	=> true,
							'description'   => '',
						),
						array(
							'type'          => 'dropdown',
							'heading'       => 'Content in grid',
							'param_name'    => 'content_in_grid',
							'value'         => array(
								'Yes'       => 'yes',
								'No'        => 'no'
							),
							'save_always'	=> true,
							'description'   => '',
							'dependency'    => array('element' => 'full_width', 'value' => 'yes')
						),
						array(
							'type'          => 'dropdown',
							'heading'       => 'Grid size',
							'param_name'    => 'grid_size',
							'value'         => array(
								'75/25'     => '75',
								'50/50'     => '50',
								'66/33'     => '66'
							),
							'save_always' 	=> true,
							'description'   => '',
							'dependency'    => array('element' => 'content_in_grid', 'value' => 'yes')
						),
						array(
							'type' 			=> 'dropdown',
							'heading'		=> 'Type',
							'param_name' 	=> 'type',
							'admin_label' 	=> true,
							'value' 		=> array(
								'Normal' 	=> 'normal',
								'With Icon' => 'with-icon',
							),
							'save_always' 	=> true,
							'description' 	=> ''
						)
					),
					suprema_qodef_icon_collections()->getVCParamsArray(array('element' => 'type', 'value' => array('with-icon'))),
					array(
						array(
							'type' 			=> 'textfield',
							'heading' 		=> 'Icon Size (px)',
							'param_name' 	=> 'icon_size',
							'description' 	=> '',
							'dependency' 	=> Array('element' => 'type', 'value' => array('with-icon')),
							'group'			=> 'Design Options'
						),
						array(
							'type' 			=> 'colorpicker',
							'heading' 		=> 'Backgrounr Color',
							'param_name' 	=> 'background_color',
							'admin_label' 	=> true,
							'description' 	=> '',
							'group'			=> 'Design Options'
						),
						array(
							'type' 			=> 'attach_image',
							'heading' 		=> 'Background Image',
							'param_name' 	=> 'background_image',
							'admin_label' 	=> true,
							'description' 	=> '',
							'group'			=> 'Design Options'
						),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> 'Box Padding (top right bottom left) px',
							'param_name' 	=> 'box_padding',
							'admin_label' 	=> true,
							'description' 	=> 'Default padding is 20px on all sides',
							'group'			=> 'Design Options'
						),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> 'Default Text Font Size (px)',
							'param_name' 	=> 'text_size',
							'description' 	=> 'Font size for p tag',
							'group'			=> 'Design Options'
						),
						array(
							'type' 			=> 'dropdown',
							'heading' 		=> 'Show Button',
							'param_name' 	=> 'show_button',
							'value' 		=> array(
								'Yes' 		=> 'yes',
								'No' 		=> 'no'
							),
							'admin_label' 	=> true,
							'save_always' 	=> true,
							'description' 	=> ''
						),
						array(
							'type' => 'dropdown',
							'heading' => 'Button Position',
							'param_name' => 'button_position',
							'value' => array(
								'Default/right' => '',
								'Center' => 'center',
								'Left' => 'left'
							),
							'description' => '',
							'dependency' => array('element' => 'show_button', 'value' => array('yes'))
						),
						array(
							'type' => 'dropdown',
							'heading' => 'Button Size',
							'param_name' => 'button_size',
							'value' => array(
								'Default' => '',
								'Small' => 'small',
								'Medium' => 'medium',
								'Large' => 'large',
								'Extra Large' => 'big_large'
							),
							'description' => '',
							'dependency' => array('element' => 'show_button', 'value' => array('yes')),
							'group'			=> 'Design Options',
						),
						array(
							'type'        => 'dropdown',
							'heading'     => 'Button Type',
							'param_name'  => 'button_type',
							'value'       => array(
								'Default' => '',
								'Outline' => 'outline',
								'Solid'   => 'solid'
							),
							'save_always' => true,
							'description' => '',
							'dependency' => array('element' => 'show_button', 'value' => array('yes')),
							'group'			=> 'Design Options',
						),
						array(
							'type' => 'textfield',
							'heading' => 'Button Text',
							'param_name' => 'button_text',
							'admin_label' 	=> true,
							'description' => 'Default text is "button"',
							'dependency' => array('element' => 'show_button', 'value' => array('yes'))
						),
						array(
							'type' => 'textfield',
							'heading' => 'Button Link',
							'param_name' => 'button_link',
							'description' => '',
							'admin_label' 	=> true,
							'dependency' => array('element' => 'show_button', 'value' => array('yes'))
						),
						array(
							'type' => 'dropdown',
							'heading' => 'Button Target',
							'param_name' => 'button_target',
							'value' => array(
								'' => '',
								'Self' => '_self',
								'Blank' => '_blank'
							),
							'description' => '',
							'dependency' => array('element' => 'show_button', 'value' => array('yes'))
						),
						array(
							'type'        => 'colorpicker',
							'heading'     => 'Button Color',
							'param_name'  => 'button_color',
							'group'       => 'Design Options',
							'admin_label' => true
						),
						array(
							'type'        => 'colorpicker',
							'heading'     => 'Button Hover Color',
							'param_name'  => 'button_hover_color',
							'group'       => 'Design Options',
							'admin_label' => true
						),
						array(
							'type'        => 'colorpicker',
							'heading'     => 'Button Background Color',
							'param_name'  => 'button_background_color',
							'dependency'  => array('element' => 'button_type', 'value' => array('solid', '')),
							'admin_label' => true,
							'group'       => 'Design Options'
						),
						array(
							'type'        => 'colorpicker',
							'heading'     => 'Button Hover Background Color',
							'param_name'  => 'button_hover_background_color',
							'dependency'  => array('element' => 'button_type', 'value' => array('solid', '', 'outline')),
							'admin_label' => true,
							'group'       => 'Design Options'
						),
						array(
							'type'        => 'colorpicker',
							'heading'     => 'Button Border Color',
							'param_name'  => 'button_border_color',
							'admin_label' => true,
							'dependency'  => array('element' => 'button_type', 'value' => array('outline')),
							'group'       => 'Design Options'
						),
						array(
							'type'        => 'colorpicker',
							'heading'     => 'Button Hover Border Color',
							'param_name'  => 'button_hover_border_color',
							'admin_label' => true,
							'dependency'  => array('element' => 'button_type', 'value' => array('outline')),
							'group'       => 'Design Options'
						),
						array(
							'type'        => 'textfield',
							'heading'     => 'Button Font Size (px)',
							'param_name'  => 'button_font_size',
							'admin_label' => true,
							'group'       => 'Design Options'
						),
						array(
							'type'        => 'dropdown',
							'heading'     => 'Button Font Weight',
							'param_name'  => 'button_font_weight',
							'value'       => array(
								'Default' => '',
								'Thin' 	=> '100',
								'Extra Light'   => '200',
								'Light'   => '300',
								'Normal'   => '400',
								'Medium'   => '500',
								'Semi Bold'   => '600',
								'Bold'   => '700',
								'Extra Bold'   => '800',
								'Ultra Bold'   => '900'
							),
							'admin_label' => true,
							'group'       => 'Design Options',
							'save_always' => true
						),
						array(
							'type' => 'dropdown',
							'heading' => 'Button Icon Pack',
							'param_name' => 'button_icon_pack',
							'value' => array_merge(array('No Icon' => ''),suprema_qodef_icon_collections()->getIconCollectionsVC()),
							'save_always' => true,
							'dependency' => array('element' => 'show_button', 'value' => array('yes'))
						)
					),
					$call_to_action_button_icons_array,
					array(
						array(
							'type' => 'textarea_html',
							'admin_label' => true,
							'heading' => 'Content',
							'param_name' => 'content',
							'value' => '<p>'.'I am test text for Call to action.'.'</p>',
							'description' => ''
						)
					)
				)
		) );
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'type' => 'normal',
			'full_width' => 'yes',
			'content_in_grid' => 'yes',
			'grid_size' => '75',
			'icon_size' => '',
			'box_padding' => '20px',
			'text_size' => '',
			'show_button' => 'yes',
			'button_position' => 'right',
			'button_size' => '',
			'button_type' => '',
			'button_link' => '',
			'button_text' => 'button',
			'button_target' => '',
			'button_icon_pack' => '',
			'background_color' => '',
			'background_image' => '',
			'button_color'            => '',
			'button_hover_color'            => '',
			'button_background_color'       => '',
			'button_hover_background_color' => '',
			'button_border_color'           => '',
			'button_hover_border_color'     => '',
			'button_font_size'              => '',
			'button_font_weight'            => '',
		);

		$call_to_action_icons_form_fields = array();

		foreach (suprema_qodef_icon_collections()->iconCollections as $collection_key => $collection) {

			$call_to_action_icons_form_fields['button_' . $collection->param ] = '';

		}

		$args = array_merge($args, suprema_qodef_icon_collections()->getShortcodeParams(),$call_to_action_icons_form_fields);

		$params = shortcode_atts($args, $atts);

		$params['content'] = $content;
		$params['text_wrapper_classes'] = $this->getTextWrapperClasses($params);
		$params['content_styles'] = $this->getContentStyles($params);
		$params['call_to_action_styles'] = $this->getCallToActionStyles($params);
		$params['icon'] = $this->getCallToActionIcon($params);
		$params['button_parameters'] = $this->getButtonParameters($params);

		//Get HTML from template
		$html = suprema_qodef_get_shortcode_module_template_part('templates/call-to-action-template', 'calltoaction', '', $params);

		return $html;

	}


	/**
	 * Return Classes for Call To Action text wrapper
	 *
	 * @param $params
	 * @return string
	 */
	private function getTextWrapperClasses($params) {
		return ( $params['show_button'] == 'yes') ? 'qodef-call-to-action-column1 qodef-call-to-action-cell' : '';
	}

	/**
	 * Return CSS styles for Call To Action Icon
	 *
	 * @param $params
	 * @return string
	 */
	private function getIconStyles($params) {
		$icon_style = array();

		if ($params['icon_size'] !== '') {
			$icon_style[] = 'font-size: ' . $params['icon_size'] . 'px';
		}

		return implode(';', $icon_style);
	}

	/**
	 * Return CSS styles for Call To Action Content
	 *
	 * @param $params
	 * @return string
	 */
	private function getContentStyles($params) {
		$content_styles = array();

		if ($params['text_size'] !== '') {
			$content_styles[] = 'font-size: ' . $params['text_size'] . 'px';
		}

		return implode(';', $content_styles);
	}

	/**
	 * Return CSS styles for Call To Action shortcode
	 *
	 * @param $params
	 * @return string
	 */
	private function getCallToActionStyles($params) {
		$call_to_action_styles = array();

		if ($params['box_padding'] != '') {
			$call_to_action_styles[] = 'padding: ' . $params['box_padding'] . ';';
		}

		if ($params['background_color'] != '') {
			$call_to_action_styles[] = 'background-color: ' . $params['background_color'] . ';';
		}

		if($params['background_image'] != '') {
			$call_to_action_styles[] = 'background-image: url(' . wp_get_attachment_url($params['background_image']) . ')';
		}

		return implode(';', $call_to_action_styles);
	}

	/**
	 * Return Icon for Call To Action Shortcode
	 *
	 * @param $params
	 * @return mixed
	 */
	private function getCallToActionIcon($params) {

		$icon = suprema_qodef_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$iconStyles = array();
		$iconStyles['icon_attributes']['style'] = $this->getIconStyles($params);
		$call_to_action_icon = '';
		if(!empty($params[$icon])){			
			$call_to_action_icon = suprema_qodef_icon_collections()->renderIcon( $params[$icon], $params['icon_pack'], $iconStyles );
		}
		return $call_to_action_icon;

	}
	
	private function getButtonParameters($params) {
		$button_params_array = array();
		
		if(!empty($params['button_link'])) {
			$button_params_array['link'] = $params['button_link'];
		}
		
		if(!empty($params['button_size'])) {
			$button_params_array['size'] = $params['button_size'];
		}

		if(!empty($params['button_type'])) {
			$button_params_array['type'] = $params['button_type'];
		}



		if(!empty($params['button_color'])) {
			$button_params_array['color'] = $params['button_color'];
		}

		if(!empty($params['button_hover_color'])) {
			$button_params_array['hover_color'] = $params['button_hover_color'];
		}

		if(!empty($params['button_background_color'])) {
			$button_params_array['background_color'] = $params['button_background_color'];
		}

		if(!empty($params['button_hover_background_color'])) {
			$button_params_array['hover_background_color'] = $params['button_hover_background_color'];
		}

		if(!empty($params['button_border_color'])) {
			$button_params_array['border_color'] = $params['button_border_color'];
		}

		if(!empty($params['button_hover_border_color'])) {
			$button_params_array['hover_border_color'] = $params['button_hover_border_color'];
		}

		if(!empty($params['button_font_size'])) {
			$button_params_array['font_size'] = $params['button_font_size'];
		}

		if(!empty($params['button_font_weight'])) {
			$button_params_array['font_weight'] = $params['button_font_weight'];
		}

		
		if(!empty($params['button_icon_pack'])) {
			$button_params_array['icon_pack'] = $params['button_icon_pack'];
			$iconPackName = suprema_qodef_icon_collections()->getIconCollectionParamNameByKey($params['button_icon_pack']);
			$button_params_array[$iconPackName] = $params['button_'.$iconPackName];		
		}
				
		if(!empty($params['button_target'])) {
			$button_params_array['target'] = $params['button_target'];
		}
		
		if(!empty($params['button_text'])) {
			$button_params_array['text'] = $params['button_text'];
		}
		
		return $button_params_array;
	}
}