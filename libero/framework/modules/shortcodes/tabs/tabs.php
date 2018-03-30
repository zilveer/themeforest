<?php
namespace Libero\Modules\Tabs;

use Libero\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Tabs
 */

class Tabs implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;
	function __construct() {
		$this->base = 'mkd_tabs';
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
			'name' => 'Mikado Tabs',
			'base' => $this->getBase(),
			'as_parent' => array('only' => 'mkd_tab'),
			'content_element' => true,
			'show_settings_on_create' => true,
			'category' => 'by MIKADO',
			'icon' => 'icon-wpb-tabs extended-custom-icon',
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type' => 'dropdown',
					'admin-label' => true,
					'param_name' => 'style',
					'value' => array(
						'Horizontal With Text' => 'horizontal_with_text',
						'Horizontal With Icons' => 'horizontal_with_icons',
						'Horizontal With Text And Icons' => 'horizontal_with_text_and_icons',
						'Vertical With Text' => 'vertical_with_text',
						'Vertical With Icons' => 'vertical_with_icons',
						'Vertical With Text and Icons' => 'vertical_with_text_and_icons'
					),
					'save_always' => true,
					'description' => ''
				)
			)
		));

	}

	public function render($atts, $content = null) {
		$args = array(
			'style' => 'horizontal with_text'
		);
		
		$args = array_merge($args, libero_mikado_icon_collections()->getShortcodeParams());
        $params  = shortcode_atts($args, $atts);
		
		extract($params);
		
		// Extract tab titles
		preg_match_all('/tab_title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);
		$tab_titles = array();

		/**
		 * get tab titles array
		 *
		 */
		if (isset($matches[0])) {
			$tab_titles = $matches[0];
		}
		
		$tab_title_array = array();
		
		foreach($tab_titles as $tab) {
			preg_match('/tab_title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE);
			$tab_title_array[] = $tab_matches[1][0];
		}
		
		$params['tabs_titles'] = $tab_title_array;
		$params['tab_class'] = $this->getTabClass($params); 
		$params['content'] = $content;
		$tabs_type = $this->getTabType($params);
		
		$output = '';
		
		$output .= libero_mikado_get_shortcode_module_template_part('templates/'.$tabs_type,'tabs', '', $params);
		
		return $output;
		}
		
		/**
		   * Generates tabs type
		   *
		   * @param $params
		   *
		   * @return string
		   */
		private function getTabType($params){
			$tabStyle = $params['style'];
			$tabType = 'with_text';
			if (strpos($tabStyle, 'with_text_and_icons') !== false) {
				$tabType = 'with_text_and_icons';
			}elseif(strpos($tabStyle, 'with_icons') !== false){
				$tabType = 'with_icons';
			}elseif(strpos($tabStyle, 'with_text') !== false){
				$tabType = 'with_text';
			}
			return $tabType;
		}
		/**
		   * Generates tabs class
		   *
		   * @param $params
		   *
		   * @return string
		   */
		private function getTabClass($params){
			$tabStyle = $params['style'];
			$tabClass = 'with_text';
			
			switch ($tabStyle) {
				case 'horizontal_with_text':
					$tabClass = 'mkd-horizontal mkd-tab-text';
					break;
				case 'horizontal_with_icons':
					$tabClass = 'mkd-horizontal mkd-tab-icon';
					break;
				case 'horizontal_with_text_and_icons':
					$tabClass = 'mkd-horizontal mkd-tab-text-icon';
					break;
				case 'vertical_with_text':
					$tabClass = 'mkd-vertical mkd-tab-text';
					break;
				case 'vertical_with_icons':
					$tabClass = 'mkd-vertical mkd-tab-icon';
					break; 
				case 'vertical_with_text_and_icons':
					$tabClass = 'mkd-vertical mkd-tab-text-icon';
					break;
			}
			return $tabClass;
		}
}