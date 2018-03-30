<?php
namespace Libero\Modules\Shortcodes\ServiceTable;

use Libero\Modules\Shortcodes\Lib\ShortcodeInterface;


/**
 * Class ServiceTable that represents service table shortcode
 * @package Libero\Modules\Shortcodes\ServiceTable
 */
class ServiceTable implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	/**
	 * Sets base attribute and registers shortcode with Visual Composer
	 */
	public function __construct() {
		$this->base = 'mkd_service_table';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base attribute
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer
	 */
	public function vcMap() {
		vc_map(array(
			'name'                      => 'Service Table',
			'base'                      => $this->base,
			'category'                  => 'by MIKADO',
			'icon'                      => 'icon-wpb-service-table extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array_merge(
				libero_mikado_icon_collections()->getVCParamsArray(array(), '', true),
				array(
					array(
						'type' => 'textfield',
						'heading' => 'Title',
						'param_name' => 'title',
					),
					array(
						'type' => 'textfield',
						'heading' => 'Subtitle',
						'param_name' => 'subtitle',
					),
					array(
						'type' => 'textarea_html',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Content',
						'param_name' => 'content',
						'value' => '<li>content content content</li><li>content content content</li><li>content content content</li>',
						'description' => ''
					),
					array(
						'type' => 'textfield',
						'heading' => 'Link/Bottom Text',
						'param_name' => 'link_text',
						'value' => 'More details',
						'save_always' => true,
						'description' => 'Enter text to be displayed in bottom of service table (can be linked if chosen below)'
					),
					array(
						'type' => 'textfield',
						'heading' => 'Link',
						'param_name' => 'link',
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Link Target',
						'param_name' => 'link_target',
						'value' => array(
							'Self' => '_self',
							'Blank' => '_blank'
						),
						'save_always' => true,
						'dependency' => array('element' => 'link', 'not_empty' => true)
					)
				)
			) //close array_merge
		));
	}

	/**
	 * Renders HTML for service table shortcode
	 *
	 * @param array $atts
	 * @param null $content
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {
		$default_atts = array(
			'title' => '',
			'subtitle' => '',
			'link' => '',
			'link_text' => '',
			'link_target' => ''
		);

		$default_atts = array_merge($default_atts, libero_mikado_icon_collections()->getShortcodeParams());
		$params       = shortcode_atts($default_atts, $atts);

		$params['content']= $content;
		$params['icon_params'] = $this->getIconParams($params);
		if (is_array($params['icon_params']) && count($params['icon_params'])){
			$params['show_icon'] = true;
			$params['service_class'] = 'mkd-service-has-icon';
		}
		else{
			$params['show_icon'] = false;
			$params['service_class'] = '';
		}

		return libero_mikado_get_shortcode_module_template_part('templates/service-table-template', 'service-table', '', $params);
	}

	/**
	 * Returns array of icon parameters
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getIconParams($params) {
		$icon_params = array();

		$icon_pack_name = libero_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

		$icon_params['icon_pack']   = $params['icon_pack'];
		$icon_params[$icon_pack_name] = $icon_pack_name !== false ? $params[$icon_pack_name] : '';

		$icon_params['type'] = 'circle';

		if ($icon_params[$icon_pack_name] == ''){
			$icon_params = array();
		}

		return $icon_params;
	}
}