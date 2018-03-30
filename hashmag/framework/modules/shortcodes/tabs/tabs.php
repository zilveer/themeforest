<?php
namespace Hashmag\Modules\Tabs;

use Hashmag\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Tabs
 */

class Tabs implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;
	function __construct() {
		$this->base = 'mkdf_tabs';
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
			'name' => esc_html__('Mikado Tabs', 'hashmag'),
			'base' => $this->getBase(),
			'as_parent' => array('only' => 'mkdf_tab'),
			'content_element' => true,
			'show_settings_on_create' => true,
			'category' => 'by MIKADO',
			'icon' => 'icon-wpb-tabs extended-custom-icon',
			'js_view' => 'VcColumnView',
			'params' => array(
                array(
                    'type' => 'dropdown',
                    'heading' => 'Tabs Style',
                    'param_name' => 'tabs_style',
                    'value' => array(
                        'Default' => '',
                        'Dark' => 'dark',
                        'Light' => 'light'
                    ),
                    'description' => ''
                )
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'tabs_style' => '',
			'tabs_title' => '',
			'title_tag' => 'h6'
		);
		
		$args = array_merge($args, hashmag_mikado_icon_collections()->getShortcodeParams());
        $params  = shortcode_atts($args, $atts);
		
		extract($params);
		
		// Extract tab titles
		preg_match_all('/title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);
		$tab_titles = array();

		$params['tabs_classes'] = $this->getTabsClasses($params);


		/**
		 * get tab titles array
		 *
		 */
		if (isset($matches[0])) {
			$tab_titles = $matches[0];
		}
		
		$tab_title_array = array();
		
		foreach($tab_titles as $tab) {
			preg_match('/title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE);
			$tab_title_array[] = $tab_matches[1][0];
		}
		
		$params['tabs_titles'] = $tab_title_array;

		// Extract tab titles images
		preg_match_all('/title_image="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);

		$params['content'] = $content;

		$output = hashmag_mikado_get_shortcode_module_template_part('templates/tabs-template','tabs', '', $params);
		
		return $output;
	}

	/**
	 * Return tabs classes
	 *
	 * @param $params
	 * @return string
	 */
	private function getTabsClasses($params) {
		$tabs_classes = array();

		if ($params['tabs_style'] !== ''){
			$tabs_classes[] = 'mkdf-tabs-skin-'.$params['tabs_style'];
		}

		return implode(' ', $tabs_classes);
	}
}