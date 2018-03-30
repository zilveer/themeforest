<?php
namespace QodeStartit\Modules\PricingTables;

use QodeStartit\Modules\Shortcodes\Lib\ShortcodeInterface;

class PricingTables implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'qodef_pricing_tables';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {

		vc_map( array(
				'name' => 'Select Pricing Tables',
				'base' => $this->base,
				'as_parent' => array('only' => 'qodef_pricing_table'),
				'content_element' => true,
				'category' => 'by SELECT',
				'icon' => 'icon-wpb-pricing-tables extended-custom-icon',
				'show_settings_on_create' => true,
				'params' => array(
					array(
						'type' => 'dropdown',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Columns',
						'param_name' => 'columns',
						'value' => array(
							'Two'       => 'qodef-two-columns',
							'Three'     => 'qodef-three-columns',
							'Four'      => 'qodef-four-columns',
						),
						'save_always' => true,
						'description' => ''
					)
				),
				'js_view' => 'VcColumnView'
		) );

	}

	public function render($atts, $content = null) {
		$args = array(
			'columns'         => 'qodef-two-columns'
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);
		
		$html = '<div class="qodef-pricing-tables clearfix '.$columns.'">';
		$html .= do_shortcode($content);
		$html .= '</div>';

		return $html;
	}

}
