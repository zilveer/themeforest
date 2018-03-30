<?php 

namespace Libero\Modules\AccordionTab;

use Libero\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
	* class Accordions
*/
class AccordionTab implements ShortcodeInterface{
	/**
	 * @var string
	 */
	private $base;
	function __construct() {
		$this->base = 'mkd_accordion_tab';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if(function_exists('vc_map')){
			vc_map( array(
				"name" =>  esc_html__( 'Mikado Accordion Tab', 'libero' ),
				"base" => $this->base,
				"as_parent" => array('except' => 'vc_row'),
				"as_child" => array('only' => 'mkd_accordion'),
				'is_container' => true,
				"category" => 'by MIKADO',
				"icon" => "icon-wpb-accordion-section extended-custom-icon",
				"show_settings_on_create" => true,
				"js_view" => 'VcColumnView',
				"params" => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title', 'libero' ),
						'param_name' => 'title',
						'admin_label' => true,
						'value' => esc_html__( 'Section', 'libero' ),
						'description' => esc_html__( 'Enter accordion section title.', 'libero' )
					),
					array(
						'type' => 'el_id',
						'heading' => esc_html__( 'Section ID', 'libero' ),
						'param_name' => 'el_id',
						'description' => sprintf( esc_html__( 'Enter optional row ID. Make sure it is unique, and it is valid as w3c specification: %s (Must not have spaces)', 'libero' ), '<a target="_blank" href="http://www.w3schools.com/tags/att_global_id.asp">' . esc_html__( 'link', 'libero' ) . '</a>' ),
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
						'type' => 'textfield',
						'heading' => 'Title Top/Bottom Padding (px)',
						'param_name' => 'title_padding',
						'admin_label' => true,
						'value' => '',
						'description' => ''
					),
					array(
						'type' => 'textfield',
						'heading' => 'Content Padding',
						'param_name' => 'content_padding',
						'admin_label' => true,
						'value' => '',
						'description' => 'Enter padding in format 0px 1px 0px 0px'
					)
				)

			));
		}
	}	
	public function render($atts, $content = null) {

		$default_atts = (array(
			'title'	=> "Accordion Title",
			'title_tag' => 'h6',
			'title_padding' => '',
			'content_padding' => '',
			'el_id' => ''
		));
		
		$params = shortcode_atts($default_atts, $atts);
		extract($params);
		$params['content'] = $content;
		$params['content_style'] = $this->getContentStyle($params);
		$params['title_style'] = $this->getTitleStyle($params);
		
		$output = '';
		
		$output .= libero_mikado_get_shortcode_module_template_part('templates/accordion-template','accordions', '',$params);

		return $output;
		
	}

	/**
	 * Returns array of content styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getContentStyle($params){
		$content_style = array();

		if ($params['content_padding'] !== ''){
			$content_style[] = 'padding: '.$params['content_padding'];
		}

		return implode('; ', $content_style);
	}


	/**
	 * Returns array of title styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getTitleStyle($params){
		$title_style = array();

		if ($params['title_padding'] !== ''){
			$title_style[] = 'padding: '.libero_mikado_filter_px($params['title_padding']).'px 0';
		}

		return implode('; ', $title_style);
	}

}