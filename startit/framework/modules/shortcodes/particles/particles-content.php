<?php
namespace QodeStartit\Modules\ParticlesContent;

use QodeStartit\Modules\Shortcodes\Lib\ShortcodeInterface;

class ParticlesContent implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'qodef_particles_content';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map( array(
			"name" => "Particles Front Content",
			"base" => $this->base,
			"icon" => "icon-wpb-particles-content extended-custom-icon",
			"category" => 'by SELECT',
			"as_parent" => array('except' => 'vc_row'),
			"as_child" => array('only' => 'qodef_particles'),
			"js_view" => 'VcColumnView',
			"params" => array(
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"value" => "",
					"save_always" => true,
					"heading" => "Width of the Content (%)",
					"param_name" => "width",
					"description" => "Width in percentage of the Particles width. Leave empty to make the width automatic.",
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"value" => "",
					"save_always" => true,
					"heading" => "Margin Top",
					"param_name" => "margin_top",
					"description" => "Top margin for the content in px or %. Does not have effect if Particles type is set to Full Screen or Fixed Height.",
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"value" => "",
					"save_always" => true,
					"heading" => "Margin Bottom",
					"param_name" => "margin_bottom",
					"description" => "Bottom margin for the content in px or %. Does not have effect if Particles type is set to Full Screen or Fixed Height.",
				),
			)
		) );

	}

	public function render($atts, $content = null) {
		$args = array(
			'width' => '',
			'margin_top' => '',
			'margin_bottom' => '',
        );

        extract(shortcode_atts($args, $atts));

        $html = "";

        $html .= 
            '<div class="qodef-p-content"' . (!empty($width) ? ' data-width="'.(int)$width.'"' : '') . (!empty($margin_top) ? ' data-margin-top="'.$margin_top.'"' : '') . (!empty($margin_bottom) ? ' data-margin-bottom="'.$margin_bottom.'"' : '') .  '>' .
            	do_shortcode($content) .
            '</div>'
        ;

        return $html;
	}
	
}
