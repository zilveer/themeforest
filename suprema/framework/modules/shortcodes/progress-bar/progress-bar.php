<?php
namespace SupremaQodef\Modules\Shortcodes\ProgressBar;

use SupremaQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

class ProgressBar implements ShortcodeInterface{
	private $base;
	
	function __construct() {
		$this->base = 'qodef_progress_bar';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {

		vc_map( array(
			'name' => esc_html__('Select Progress Bar', 'suprema'),
			'base' => $this->base,
			'icon' => 'icon-wpb-progress-bar extended-custom-icon',
			'category' => 'by SELECT',
			'allowed_container_element' => 'vc_row',
			'params' => array(
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Title',
					'param_name' => 'title',
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'admin_label' => true,
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
					'admin_label' => true,
					'heading' => 'Percentage',
					'param_name' => 'percent',
					'description' => ''
				),	
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => 'Percentage Type',
					'param_name' => 'percentage_type',
					'value' => array(
						'Floating'  => 'floating',
						'Static' => 'static'
					),
					'dependency' => Array('element' => 'percent', 'not_empty' => true)
				),	
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => 'Floating Type',
					'param_name' => 'floating_type',
					'value' => array(
						'Outside Floating'  => 'floating_outside',
						'Inside Floating' => 'floating_inside'
					),
					'dependency' => array('element' => 'percentage_type', 'value' => array('floating'))
				),
				array(
					'type' => 'colorpicker',
					'admin_label' => true,
					'heading' => 'Active Bar Color',
					'param_name' => 'active_bar_color',
					'description' => ''
				),
				array(
					'type' => 'colorpicker',
					'admin_label' => true,
					'heading' => 'Inactive Bar Color',
					'param_name' => 'inactive_bar_color',
					'description' => ''
				)
			)
		) );

	}

	public function render($atts, $content = null) {
		$args = array(
            'title' => '',
            'title_tag' => 'h4',
            'percent' => '100',
            'percentage_type' => 'floating',
            'floating_type' => 'floating_outside',
			'active_bar_color' => '',
			'inactive_bar_color' => ''
        );
		$params = shortcode_atts($args, $atts);
		
		//Extract params for use in method
		extract($params);
		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

        //get correct heading value. If provided heading isn't valid get the default one
        $title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];
		
		$params['percentage_classes'] = $this->getPercentageClasses($params);
		$params['active_bar_style'] = $this->getActiveBarStyle($params);
		$params['inactive_bar_style'] = $this->getInactiveBarStyle($params);

        //init variables
		$html = suprema_qodef_get_shortcode_module_template_part('templates/progress-bar-template', 'progress-bar', '', $params);
		
        return $html;
		
	}
	/**
    * Generates css classes for progress bar
    *
    * @param $params
    *
    * @return array
    */
	private function getPercentageClasses($params){
		
		$percentClassesArray = array();
		
		if(!empty($params['percentage_type']) !=''){
			
			if($params['percentage_type'] == 'floating'){
				
				$percentClassesArray[]= 'qodef-floating';
				
				if($params['floating_type'] == 'floating_outside'){
					
					$percentClassesArray[] = 'qodef-floating-outside';
					
				}
				
				elseif($params['floating_type'] == 'floating_inside'){
					
					$percentClassesArray[] = 'qodef-floating-inside';
				}

			}
			elseif($params['percentage_type'] == 'static'){
				
				$percentClassesArray[] = 'qodef-static';
				
			}
		}
		return implode(' ', $percentClassesArray);
	}

	private function getActiveBarStyle($params) {
		$style = array();

		if($params['active_bar_color'] != '') {
			$style[] = 'background-color: ' . $params['active_bar_color'];
		}

		return implode(';', $style);
	}

	private function getInactiveBarStyle($params) {
		$style = array();

		if($params['inactive_bar_color'] != '') {
			$style[] = 'background-color: ' . $params['inactive_bar_color'];
		}

		return implode(';', $style);
	}
}