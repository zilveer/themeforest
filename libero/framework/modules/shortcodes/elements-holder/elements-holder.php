<?php
namespace Libero\Modules\ElementsHolder;

use Libero\Modules\Shortcodes\Lib\ShortcodeInterface;

class ElementsHolder implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'mkd_elements_holder';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => 'Elements Holder',
			'base' => $this->base,
			'icon' => 'icon-wpb-elements-holder extended-custom-icon',
			'category' => 'by MIKADO',
			'as_parent' => array('only' => 'mkd_elements_holder_item'),
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type' => 'colorpicker',
					'class' => '',
					'heading' => 'Background Color',
					'param_name' => 'background_color',
					'value' => '',
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'class' => '',
					'heading' => 'Columns',
					'admin_label' => true,
					'param_name' => 'number_of_columns',
					'value' => array(
						'1 Column'      => 'one-column',
						'2 Columns'    	=> 'two-columns',
						'3 Columns'     => 'three-columns',
						'4 Columns'     => 'four-columns',
						'5 Columns'     => 'five-columns',
						'6 Columns'     => 'six-columns'
					),
					'description' => ''
				),
				array(
					'type' => 'checkbox',
					'class' => '',
					'heading' => 'Items Float Left',
					'param_name' => 'items_float_left',
					'value' => array('Make Items Float Left?' => 'yes'),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'class' => '',
					'group' => 'Width & Responsiveness',
					'heading' => 'Switch to One Column',
					'param_name' => 'switch_to_one_column',
					'value' => array(
						'Default'    		=> '',
						'Below 1280px' 		=> '1280',
						'Below 1024px'    	=> '1024',
						'Below 768px'     	=> '768',
						'Below 600px'    	=> '600',
						'Below 480px'    	=> '480',
						'Never'    			=> 'never'
					),
					'description' => 'Choose on which stage item will be in one column'
				),
				array(
					'type' => 'dropdown',
					'class' => '',
					'group' => 'Width & Responsiveness',
					'heading' => 'Choose Alignment In Responsive Mode',
					'param_name' => 'alignment_one_column',
					'value' => array(
						'Default'    	=> '',
						'Left' 			=> 'left',
						'Center'    	=> 'center',
						'Right'     	=> 'right'
					),
					'description' => 'Alignment When Items are in One Column'
				)
			)
		));
	}

	public function render($atts, $content = null) {
	
		$args = array(
			'number_of_columns' 		=> '',
			'switch_to_one_column'		=> '',
			'alignment_one_column' 		=> '',
			'items_float_left' 			=> '',
			'background_color' 			=> ''
		);
		$params = shortcode_atts($args, $atts);
		extract($params);

		$html						= '';

		$elements_holder_classes = array();
		$elements_holder_classes[] = 'mkd-elements-holder';
		$elements_holder_style = '';

		if($number_of_columns != ''){
			$elements_holder_classes[] .= 'mkd-'.$number_of_columns ;
		}

		if($switch_to_one_column != ''){
			$elements_holder_classes[] = 'mkd-responsive-mode-' . $switch_to_one_column ;
		} else {
			$elements_holder_classes[] = 'mkd-responsive-mode-768' ;
		}

		if($alignment_one_column != ''){
			$elements_holder_classes[] = 'mkd-one-column-alignment-' . $alignment_one_column ;
		}

		if($items_float_left !== ''){
			$elements_holder_classes[] = 'mkd-elements-items-float';
		}

		if($background_color != ''){
			$elements_holder_style .= 'background-color:'. $background_color . ';';
		}

		$elements_holder_class = implode(' ', $elements_holder_classes);

		$html .= '<div ' . libero_mikado_get_class_attribute($elements_holder_class) . ' ' . libero_mikado_get_inline_attr($elements_holder_style, 'style'). '>';
			$html .= do_shortcode($content);
		$html .= '</div>';

		return $html;

	}

}
