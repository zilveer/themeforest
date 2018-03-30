<?php
namespace Libero\Modules\Tab;

use Libero\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class Tab
 */

class Tab implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;
	function __construct() {
		$this->base = 'mkd_tab';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}
	public function vcMap() {

		vc_map( array(
			'name' => 'Mikado Tab',
			'base' => $this->getBase(),
			'as_parent' => array('except' => 'vc_row'),
			'as_child' => array('only' => 'mkd_tabs'),
			'is_container' => true,
			'category' => 'by MIKADO',
			'icon' => 'icon-wpb-tab extended-custom-icon',
			'show_settings_on_create' => true,
			'js_view' => 'VcColumnView',
			'params' => array_merge(
				 \LiberoIconCollections::get_instance()->getVCParamsArray(),
				array(
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => 'Title',
						'param_name' => 'tab_title',
						'description' => ''
					),
					array(
						'type' => 'attach_image',
						'admin_label' => true,
						'heading' => 'Background Image',
						'param_name' => 'background_image',
						'description' => ''
					)
				)
			)
		));

	}

	public function render($atts, $content = null) {
		
		$default_atts = array(
			'tab_title'        => 'Tab',
			'tab_id'           => '',
			'background_image' => ''
		);
		
		$default_atts = array_merge($default_atts, libero_mikado_icon_collections()->getShortcodeParams());
		$params       = shortcode_atts($default_atts, $atts);
		extract($params);

		$iconPackName = libero_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$params['icon'] = $params[$iconPackName];
		$params['content'] = $content;
		$params['tab_styles'] = $this->getImageStyles($params);
		$params['tab_classes'] = $this->getTabClasses($params);

		$output = '';
		$output .= libero_mikado_get_shortcode_module_template_part('templates/tab_content','tabs', '', $params);
		return $output;

	}

	private function getImageStyles($params) {
		$styles = array();

		if ($params['background_image'] != '') {
				$styles[] = 'background-image: url(' .wp_get_attachment_url($params['background_image']).')';
		}
		return $styles;
	}

	private function getTabClasses($params) {
		$classes = array('mkd-tab-container');

		if ($params['background_image'] != '') {
			$classes[] = 'mkd-tab-image';
		}

		return $classes;
	}
}