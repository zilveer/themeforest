<?php 

namespace QodeStartit\Modules\AccordionTab;

use QodeStartit\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
	* class Accordions
*/
class AccordionTab implements ShortcodeInterface{
	/**
	 * @var string
	 */
	private $base;
	function __construct() {
		$this->base = 'qodef_accordion_tab';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if(function_exists('vc_map')){
			vc_map( array(
				"name" =>  esc_html__( 'Select Accordion Tab', 'startit' ),
				"base" => $this->base,
				"as_parent" => array('except' => 'vc_row'),
				"as_child" => array('only' => 'qodef_accordion'),
				'is_container' => true,
				"category" => 'by SELECT',
				"icon" => "icon-wpb-accordion-section extended-custom-icon",
				"show_settings_on_create" => true,
				"js_view" => 'VcColumnView',
				"params" => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title', 'startit' ),
						'param_name' => 'title',
						'admin_label' => true,
						'value' => esc_html__( 'Section', 'startit' ),
						'description' => esc_html__( 'Enter accordion section title.', 'startit' )
					),
					array(
						'type' => 'el_id',
						'heading' => esc_html__( 'Section ID', 'startit' ),
						'param_name' => 'el_id',
						'description' => sprintf( esc_html__( 'Enter optional row ID. Make sure it is unique, and it is valid as w3c specification: %s (Must not have spaces)', 'startit' ), '<a target="_blank" href="http://www.w3schools.com/tags/att_global_id.asp">' . esc_html__( 'link', 'startit' ) . '</a>' ),
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => "Title Tag",
						"param_name" => "title_tag",
						"value" => array(
							""   => "",
							"p"  => "p",
							"h2" => "h2",
							"h3" => "h3",
							"h4" => "h4",
							"h5" => "h5",
							"h6" => "h6",
						),
						"description" => ""
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => 'Title Background Color',
						'param_name'  => 'title_background_color',
						'admin_label' => true
					),
				)

			));
		}
	}	
	public function render($atts, $content = null) {

		$default_atts = (array(
			'title'	=> "Accordion Title",
			'title_tag' => 'h4',
			'title_background_color' => '',
			'el_id' => ''
		));
		
		$params = shortcode_atts($default_atts, $atts);
		extract($params);
		$params['content'] = $content;
		$params['title_style'] = $this->getTitleStyle($params);

		$output = '';
		
		$output .= qode_startit_get_shortcode_module_template_part('templates/accordion-template','accordions', '',$params);

		return $output;
		
	}

	private function getTitleStyle($params) {

		$title_style = array();
		if($params['title_background_color'] != '') {
			$title_style[] = 'background-color:' . $params['title_background_color'];
			$title_style[] = 'border-color:' . $params['title_background_color'];
		}

		return implode(';', $title_style);
	}

}