<?php
namespace Libero\Modules\PricingTable;

use Libero\Modules\Shortcodes\Lib\ShortcodeInterface;

class PricingTable implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'mkd_pricing_table';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => 'Mikado Pricing Table',
			'base' => $this->base,
			'icon' => 'icon-wpb-pricing-table extended-custom-icon',
			'category' => 'by MIKADO',
			'allowed_container_element' => 'vc_row',
			'as_child' => array('only' => 'mkd_pricing_tables'),
			'params' => array(
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Title',
					'param_name' => 'title',
					'value' => 'Basic Plan',
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Price',
					'param_name' => 'price',
					'description' => 'Default value is 100'
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Currency',
					'param_name' => 'currency',
					'description' => 'Default mark is $'
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Price Period',
					'param_name' => 'price_period',
					'description' => 'Default label is "mo"'
				),
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => 'Show Button',
					'param_name' => 'show_button',
					'value' => array(
						'Default' => '',
						'Yes' => 'yes',
						'No' => 'no'
					),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Button Text',
					'param_name' => 'button_text',
					'dependency' => array('element' => 'show_button',  'value' => 'yes') 
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Button Link',
					'param_name' => 'link',
					'dependency' => array('element' => 'show_button',  'value' => 'yes')
				),
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => 'Active',
					'param_name' => 'active',
					'value' => array(
						'No' => 'no',
						'Yes' => 'yes'
					),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Active text',
					'param_name' => 'active_text',
					'description' => 'Best choice',
					'dependency' => array('element' => 'active', 'value' => 'yes')
				),
				array(
					'type' => 'textarea_html',
					'holder' => 'div',
					'class' => '',
					'heading' => 'Content',
					'param_name' => 'content',
					'value' => '<li>content content content</li><li>content content content</li><li>content content content</li>',
					'description' => ''
				)
			)
		));
	}

	public function render($atts, $content = null) {
	
		$args = array(
			'title'         			   => 'Basic Plan',
			'price'         			   => '100',
			'currency'      			   => '$',
			'price_period'  			   => 'mo',
			'active'        			   => 'no',
			'active_text'   			   => 'Best',
			'show_button'				   => 'yes',
			'link'          			   => '',
			'button_text'   			   => 'Purchase'
		);
		$params = shortcode_atts($args, $atts);
		extract($params);

		$html						= '';
		$pricing_table_clasess		= '';
		
		if($active == 'yes') {
			$pricing_table_clasess .= ' mkd-active';
		}
		
		$params['pricing_table_classes'] = $pricing_table_clasess;
		$params['content']= $content;
		$params['button_params']= $this->buttonParams($params);
		
		$html .= libero_mikado_get_shortcode_module_template_part('templates/pricing-table-template','pricing-table', '', $params);
		return $html;

	}


	/*
	* Returns Button Parameters
	* @param $params
	* @return array
	*/

	private function buttonParams($params){
		$buttonParams = array();

		if($params['button_text'] !== ''){
			$buttonParams['text'] = $params['button_text'];
		}

		if($params['link'] !== ''){
			$buttonParams['link'] = $params['link'];
		}

		$buttonParams['size'] = 'large';
		$buttonParams['icon_pack'] = 'simple_line_icons';
		$buttonParams['simple_line_icons'] = 'icon-arrow-right-circle';

		return $buttonParams;
	}

}
