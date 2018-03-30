<?php
namespace Libero\Modules\Shortcodes\InteractiveIcon;

use Libero\Modules\Shortcodes\Lib\ShortcodeInterface;

class InteractiveIcon implements ShortcodeInterface{

	private $base;

	/**
	 * Interactive Icon constructor.
	 */
	public function __construct() {
		$this->base = 'mkd_interactive_icon';

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
	 * @see mkd_core_get_carousel_slider_array_vc()
	 */
	public function vcMap() {

		vc_map(array(
			'name'                      => 'Mikado Interactive Icon',
			'base'                      => $this->getBase(),
			'category'                  => 'by MIKADO',
			'icon'                      => 'icon-wpb-interactive-icon extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'			=> 'attach_image',
					'heading'		=> 'Icon',
					'param_name'	=> 'icon',
					'description'	=> 'Select icon image from media library.'
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Title',
					'param_name'	=> 'title',
					'description'   => 'Enter the title to be displayed.'
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Text',
					'param_name'	=> 'text',
					'description'   => 'Enter the text to be displayed.'
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Title and Text Color',
					'param_name' => 'typography_color',
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Separator',
					'param_name' => 'separator_color',
					'description' => ''
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'URL',
					'param_name'	=> 'url',
					'description'   => 'Enter the URL to link to.'
				),
				array(
					'type'			=>'dropdown',
					'heading'		=>'Add Right Border',
					'param_name'	=> 'right_border',
					'value'         => array(
						'Yes'       => 'yes',
						'No'        => 'no'
					),
					'save_always'   => 'true',
					'description'	=>'Sets right border for the entire element.'
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Hide Right Border Under',
					'param_name'	=> 'hide_right_border',
					'value'			=> array(
						'Default'			=> '',
						'Below 1280px'		=> '1280',
						'Below 1024px'		=> '1024',
						'Below 768px'		=> '768',
						'Below 600px'		=> '600',
						'Below 480px'		=> '480'
					),
					'description'	=> 'Choose width under whitch right border will be hidden',
					'dependency'	=> array('element' => 'right_border', 'value' => 'yes'),
					'group'			=> 'Responsive'
				),
				array(
					'type'			=>'dropdown',
					'heading'		=>'Add Bottom Border',
					'param_name'	=> 'bottom_border',
					'value'         => array(
						'No'        => 'no',
						'Yes'       => 'yes'
					),
					'save_always'   => 'true',
					'description'	=>'Sets bottom border for the entire element.'
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Show Bottom Border Under',
					'param_name'	=> 'show_bottom_border',
					'value'			=> array(
						'Default'			=> '',
						'Always'			=> 'always',
						'Below 1280px'		=> '1280',
						'Below 1024px'		=> '1024',
						'Below 768px'		=> '768',
						'Below 600px'		=> '600',
						'Below 480px'		=> '480',
					),
					'description'	=> 'Choose width under whitch bottom border will be shown',
					'dependency'	=> array('element' => 'bottom_border', 'value' => 'yes'),
					'group'			=> 'Responsive'
				)
			)
		));

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
			'icon'					=> '',
			'title'					=> '',
			'text'					=> '',
			'typography_color'		=> '',
			'separator_color'		=> '',
			'url'					=> '',
			'right_border'			=> 'yes',
			'hide_right_border'		=> '',
			'bottom_border'			=> '',
			'show_bottom_border'	=> '768',

		);

		$params = shortcode_atts($args, $atts);

		$params['typography_styles'] = $this->getTypographyStyles($params);
		$params['separator_styles'] = $this->getSeparatorStyles($params);
		$params['interactive_icon_classes'] = $this->getInteractiveIconClasses($params);

		$html = libero_mikado_get_shortcode_module_template_part('templates/interactive-icon-template', 'interactive-icon', '', $params);

		return $html;

	}

	/**
	 * Return CSS styles for Typography elements
	 *
	 * @param $params
	 * @return string
	 */
	private function getTypographyStyles($params) {
		$typography_styles = array();

		if ($params['typography_color'] !== '') {
			$typography_styles[] = 'color: ' . $params['typography_color'] ;
		}

		return implode(';', $typography_styles);
	}

	/**
	 * Return CSS styles for Separator element
	 *
	 * @param $params
	 * @return string
	 */
	private function getSeparatorStyles($params) {
		$separator_styles = array();

		if ($params['separator_color'] !== '') {
			$separator_styles[] = 'background-color: ' . $params['separator_color'] ;
		}

		return implode(';', $separator_styles);
	}


	/**
	 * Return Classes for Interactive Icon
	 *
	 * @param $params
	 * @return string
	 */
	private function getInteractiveIconClasses($params) {

		$interactive_icon_classes = '';

		if ($params['right_border'] == 'yes') {
			$interactive_icon_classes .= 'mkd-right-border-added';

			if ($params['hide_right_border'] !== ''){
				$interactive_icon_classes .= ' mkd-right-border-hide-'.$params['hide_right_border'];
			}
		}

		if ($params['bottom_border'] == 'yes') {
			$interactive_icon_classes .= ' mkd-bottom-border-added';

			if ($params['show_bottom_border'] !== ''){
				$interactive_icon_classes .= ' mkd-bottom-border-show-'.$params['show_bottom_border'];
			}
		}

		return $interactive_icon_classes;
	}

}