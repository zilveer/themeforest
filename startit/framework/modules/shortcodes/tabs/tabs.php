<?php
namespace QodeStartit\Modules\Tabs;

use QodeStartit\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Tabs
 */

class Tabs implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;
	function __construct() {
		$this->base = 'qodef_tabs';
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
			'name' => 'Select Tabs',
			'base' => $this->getBase(),
			'as_parent' => array('only' => 'qodef_tab'),
			'content_element' => true,
			'show_settings_on_create' => true,
			'category' => 'by SELECT',
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
		
		$args = array_merge($args, qode_startit_icon_collections()->getShortcodeParams());
        $params  = shortcode_atts($args, $atts);
		
		extract($params);
		
		// Extract tab titles
        preg_match_all( '/qodef_tab(\s[a-zA-Z_\-="0-9\']*)*\stitle="([^\"]+)"/', $content, $tabs_string );
        $tabs_string = implode(' ', $tabs_string[0]);

		preg_match_all('/title="([^\"]+)"/i', $tabs_string, $matches, PREG_OFFSET_CAPTURE);

		/**
		 * get tab titles array
		 *
		 */
        $tab_titles = array();
		if (isset($matches[0])) {
			$tab_titles = $matches[0];
		}
		
		$tab_title_array = array();
		
		foreach($tab_titles as $tab) {
			preg_match('/title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE);
			$tab_title_array[] = $tab_matches[1][0];
		}
		
		$params['tabs_titles'] = $tab_title_array;
		$params['tab_class'] = $this->getTabClass($params); 
		$params['content'] = $content;
		$tabs_type = $this->getTabType($params);
		
		$output = '';
		
		$output .= qode_startit_get_shortcode_module_template_part('templates/'.$tabs_type,'tabs', '', $params);
		
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
					$tabClass = 'qodef-horizontal qodef-tab-text';
					break;
				case 'horizontal_with_icons':
					$tabClass = 'qodef-horizontal qodef-tab-icon';
					break;
				case 'horizontal_with_text_and_icons':
					$tabClass = 'qodef-horizontal qodef-tab-text-icon';
					break;
				case 'vertical_with_text':
					$tabClass = 'qodef-vertical qodef-tab-text';
					break;
				case 'vertical_with_icons':
					$tabClass = 'qodef-vertical qodef-tab-icon';
					break; 
				case 'vertical_with_text_and_icons':
					$tabClass = 'qodef-vertical qodef-tab-text-icon';
					break;
			}
			return $tabClass;
		}
}