<?php
namespace QodeStartit\Modules\UnderlineIconBox;

use QodeStartit\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class UnderlineIconBox
 */
class UnderlineIconBox implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'qodef_underline_icon_box';

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

		vc_map( array(
			'name' => 'Select Underline Icon Box',
			'base' => $this->getBase(),
			'category' => 'by SELECT',
			'admin_enqueue_css' => array(qode_startit_get_skin_uri().'/assets/css/qodef-vc-extend.css'),
			'icon' => 'icon-wpb-underline-icon-box extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' =>array_merge(
				qode_startit_icon_collections()->getVCParamsArray(),
			array(
					array(
						'type' => 'dropdown',
						'heading' => 'Alignment',
						'param_name' => 'alignment',
						'value' => array(
							'Left' => 'left',
							'Right' => 'right',
							'Center' => 'center'
						),
						'save_always' => true,
						'description' => ''
					),
					array(
						'type' => 'textfield',
						'heading' => 'Title',
						'param_name' => 'title',
						'admin_label' => true,
						'description' => ''
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Title Tag',
						'param_name' => 'title_tag',
						'value' => array(
							''   => '',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
						),
						'description' => ''
					),
					array(
						'type' => 'textfield',
						'heading' => 'Text',
						'param_name' => 'text',
						'admin_label' => true,
						'description' => ''
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Enable border',
						'param_name' => 'enable_border',
						'value' => array(
							'No' => 'no',
							'Yes' => 'yes'
						),
						'save_always' => true,
						'description' => ''
					),
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

		$default_atts = array(
			'alignment' => '',
			'title' => '',
			'title_tag' => 'h4',
			'text' => '',
			'enable_border' => 'no'
		);

		$default_atts = array_merge($default_atts, qode_startit_icon_collections()->getShortcodeParams());
		$params       = shortcode_atts($default_atts, $atts);

		$params['icon_parameters'] = $this->getIconParameters($params);
		$params['holder_classes']  = $this->getHolderClasses($params);

		//get correct heading value. If provided heading isn't valid get the default one
		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');
		$params['title_tag'] = (in_array($params['title_tag'], $headings_array)) ? $params['title_tag'] : $default_atts['title_tag'];

		//Get HTML from template
		$html = qode_startit_get_shortcode_module_template_part('templates/underline-icon-box-template', 'underline-icon-box', '', $params);

		return $html;

	}

	private function getIconParameters($params) {
		$iconPackName = qode_startit_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

		$params_array['icon_pack']   = $params['icon_pack'];
		$params_array[$iconPackName] = $params[$iconPackName];

		return $params_array;
	}

	private function getHolderClasses($params) {
		$classes = array('qodef-underline-icon-box-holder');

		$classes[] = $params['alignment'];

		if($params['enable_border'] == 'yes') {
			$classes[] = 'qodef-with-border';
			$classes[] = 'qodef-background-animation';
		}
		else {
			$classes[] = 'qodef-underline-animation';
		}

		return $classes;
	}
}