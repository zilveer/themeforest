<?php
namespace Libero\Modules\IconListItem;

use Libero\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Icon List Item
 */

class IconListItem implements ShortcodeInterface{
	/**
	 * @var string
	 */
	private $base;
	function __construct() {
		$this->base = 'mkd_icon_list_item';
		
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
	 */
	
	public function vcMap() {
		vc_map( array(
			'name' => 'Mikado Icon List Item',
			'base' => $this->base,
			'icon' => 'icon-wpb-icon-list-item extended-custom-icon',
			'category' => 'by MIKADO',
			'params' => array_merge(
				\LiberoIconCollections::get_instance()->getVCParamsArray(),
				array(
					array(
						'type' => 'textfield',
						'heading' => 'Icon Size (px)',
						'param_name' => 'icon_size',
						'description' => ''
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Icon Color',
						'param_name' => 'icon_color',
						'description' => ''
					),
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => 'Title',
						'param_name' => 'title',
						'description' => ''
					),
					array(
						'type' => 'textfield',
						'heading' => 'Title size (px)',
						'param_name' => 'title_size',
						'description' => '',
						'dependency' => Array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Title Color',
						'param_name' => 'title_color',
						'description' => '',
						'dependency' => Array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type' => 'textfield',
						'heading' => 'Title Left Margin (px)',
						'param_name' => 'title_left_margin',
						'description' => '',
						'dependency' => Array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Title Text Transform',
						'param_name' => 'title_transform',
						'value' => array_flip(libero_mikado_get_text_transform_array(true)),
						'dependency' => Array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Title Font Weight',
						'param_name' => 'title_font_weight',
						'value' => array_flip(libero_mikado_get_font_weight_array(true)),
						'dependency' => Array('element' => 'title', 'not_empty' => true)
					)
				)
			)
		) );

	}
	
	public function render($atts, $content = null) {
		$args = array(
            'icon_size' => '',
            'icon_color' => '',
            'title' => '',
            'title_color' => '',
            'title_size' => '',
            'title_left_margin' => '',
            'title_transform' => '',
            'title_font_weight' => ''
        );

        $args = array_merge($args, libero_mikado_icon_collections()->getShortcodeParams());
		
        $params = shortcode_atts($args, $atts);
		
		//Extract params for use in method
		extract($params);
		$iconPackName = libero_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$iconClasses = '';
		
		//generate icon holder classes
		$iconClasses .= 'mkd-icon-list-item-icon ';
		$iconClasses .= $params['icon_pack'];
		
		$params['icon_classes'] = $iconClasses;
		$params['icon'] = $params[$iconPackName];		
		$params['icon_attributes']['style'] =  $this->getIconStyle($params);	
		$params['icon_data'] =  $this->getIconData($params);	
		$params['title_style'] =  $this->getTitleStyle($params);
		$params['title_data'] =  $this->getTitleData($params);

		//Get HTML from template
		$html = libero_mikado_get_shortcode_module_template_part('templates/icon-list-item-template', 'icon-list-item', '', $params);
		return $html;
	}
	 /**
     * Generates icon styles
     *
     * @param $params
     *
     * @return array
     */
	private function getIconStyle($params){
		$iconStylesArray = array();
		if(!empty($params['icon_color'])) {
			$iconStylesArray[] = 'color:' . $params['icon_color'];
		}

		if (!empty($params['icon_size'])) {
			$iconStylesArray[] = 'font-size:' .libero_mikado_filter_px( $params['icon_size']) . 'px';
		}
		
		 return implode(';', $iconStylesArray);
	}

	/**
     * Generates icon data styles
     *
     * @param $params
     *
     * @return array
     */
	private function getIconData($params){
		$icon_data = array();

		if (!empty($params['icon_size'])) {
			$icon_data[] = 'data-icon-size=' .libero_mikado_filter_px( $params['icon_size']);
		}
		
		return implode(' ', $icon_data);
	}

	 /**
     * Generates title styles
     *
     * @param $params
     *
     * @return array
     */
	private function getTitleStyle($params){
		$titleStylesArray = array();
		if(!empty($params['title_color'])) {
			$titleStylesArray[] = 'color:' . $params['title_color'];
		}

		if (!empty($params['title_size'])) {
			$titleStylesArray[] = 'font-size:' .libero_mikado_filter_px( $params['title_size']) . 'px';
		}

		if ($params['title_left_margin'] !== '') {
			$titleStylesArray[] = 'padding-left:' .libero_mikado_filter_px( $params['title_left_margin']) . 'px';
		}

		if (!empty($params['title_transform'])) {
			$titleStylesArray[] = 'text-transform:' .$params['title_transform'];
		}

		if (!empty($params['title_font_weight'])) {
			$titleStylesArray[] = 'font-weight:' .$params['title_font_weight'];
		}
		
		 return implode(';', $titleStylesArray);
	}

	/**
     * Generates tezt data styles
     *
     * @param $params
     *
     * @return array
     */
	private function getTitleData($params){
		$text_data = array();

		if (!empty($params['title_size'])) {
			$text_data[] = 'data-title-size=' .libero_mikado_filter_px( $params['title_size']);
		}
		
		return implode(' ', $text_data);
	}
}