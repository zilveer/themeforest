<?php
namespace QodeStartit\Modules\Particles;

use QodeStartit\Modules\Shortcodes\Lib\ShortcodeInterface;

class Particles implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'qodef_particles';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map( array(
			"name" => "Particles",
			"base" => $this->base,
			"icon" => "icon-wpb-particles extended-custom-icon",
			"category" => 'by SELECT',
			"as_parent" => array('only' => 'qodef_particles_content'),
			"description" => "Create floating particles in the background.",
			"js_view" => 'VcColumnView',
			"params" => array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"value" => array(
						"Adapt to Content Height"	=>	"auto",
						"Fixed Height (px)"	=>	"fixed",
						"Full Screen Height"	=>	"fullscreen",
					),
					'save_always' => true,
					"heading" => "Type",
					"param_name" => "type",
					"description" => "Choose the behavior of the particles container.",
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"value" => "",
					"heading" => "Height (px)",
					"param_name" => "height",
					"dependency" => array('element' => 'type', 'value' => array('fixed')),
				),
				array(
					'type' => 'colorpicker',
					'holder' => 'div',
					'class' => '',
					'heading' => 'Background Color',
					'param_name' => 'bgnd_color',
					'value' => '',
				),
				array(
					"type" => "attach_image",
					"holder" => "div",
					"class" => "",
					"heading" => "Background Image",
					"param_name" => "bgnd_image",
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"value" => array(
						"Low"	=>	"low",
						"Medium"	=>	"medium",
						"High"	=>	"high",
					),
					'save_always' => true,
					"heading" => "Particles Density",
					"param_name" => "particles_density",
					"description" => "High density means more particles on the screen.",
				),
				array(
					'type' => 'colorpicker',
					'holder' => 'div',
					'class' => '',
					'heading' => 'Particles Color',
					'param_name' => 'particles_color',
					'value' => '',
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => 'Particles Opacity (0-1)',
					'param_name' => 'particles_opacity',
					'value' => '',
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => 'Particles Size (1-100)',
					'param_name' => 'particles_size',
					'value' => '',
				),
				/*
				array(
					'type' => 'dropdown',
					'heading' => "Enable Particles Movement",
					'param_name' => 'enable_movement',
					'value' => array(
						"Yes"	=>	"yes",
						"No"	=>	"no",
					)
				),
				*/
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => 'Particles Speed (0 - 10)',
					'param_name' => 'speed',
					'value' => '5',
					'save_always' => true,
					'description' => 'Enter "0" to freeze particles.',
					//"dependency" => array('element' => 'enable_movement', 'value' => array('yes')),
				),
				array(
					'type' => 'checkbox',
					'heading' => "Interconnecting Lines",
					'param_name' => 'show_lines',
					'value' => array( "Connect particles with lines" => 'yes' )
				),
				array(
					'type' => 'textfield',
					'holder' => 'div',
					'class' => '',
					'heading' => 'Maximum Line Length (px)',
					'param_name' => 'line_length',
					'value' => '100',
					'save_always' => true,
					"dependency" => array('element' => 'show_lines', 'value' => array('yes')),
				),
				array(
					'type' => 'checkbox',
					'heading' => "Hover Effect",
					'param_name' => 'hover',
					'value' => array( "Grab nearby particles" => 'yes' )
				),
				array(
					'type' => 'checkbox',
					'heading' => "Click Effect",
					'param_name' => 'click',
					'value' => array( "Insert new particles" => 'yes' )
				),
			)
		) );

	}

	public function render($atts, $content = null) {
		$args = array(
			'type' => '',
			'height' => '',
			'bgnd_color' => '',
			'bgnd_image' => '',
			'particles_density' => '',
			'particles_color' => '',
			'particles_opacity' => '',
			'particles_size' => '',
			//'enable_movement' => '',
			'speed' => '',
			'show_lines' => '',
			'line_length' => '',
			'hover' => '',
			'click' => '',
        );

        extract(shortcode_atts($args, $atts));

        $the_image = wp_get_attachment_image_src($bgnd_image,'full');

        $data_string = ' '.
        	(!empty($particles_density) ? 'data-particles-density="'.$particles_density.'" ' : '') .
        	(!empty($particles_color) ? 'data-particles-color="'.$particles_color.'" ' : '') .
        	(!empty($particles_opacity) ? 'data-particles-opacity="'.$particles_opacity.'" ' : '') .
        	(!empty($particles_size) ? 'data-particles-size="'.$particles_size.'" ' : '') .
        	//(!empty($enable_movement) ? 'data-enable-movement="'.$enable_movement.'" ' : '') .
        	(!empty($speed) ? 'data-speed="'.$speed.'" ' : '') .
        	(!empty($show_lines) ? 'data-show-lines="'.$show_lines.'" ' : '') .
        	(!empty($line_length) ? 'data-line-length="'.$line_length.'" ' : '') .
        	(!empty($hover) ? 'data-hover="'.$hover.'" ' : '') .
        	(!empty($click) ? 'data-click="'.$click.'" ' : '') .
        '';
        $style_string = ' style="'.
        	($type == 'fixed' && !empty($height) ? 'height: '.(int)$height.'px;' : '') .
        	(!empty($bgnd_color) ? 'background-color: '.$bgnd_color.';' : '') .
        	(!empty($bgnd_image) ? 'background-image: url('.$the_image[0].');' : '') .
        '"';

        $html = "";

        $html .= 
            '<div id="qodef-particles" class="'.$type.'"'. $style_string . $data_string .'>' .
				'<div id="qodef-p-particles-container"></div>' .
				do_shortcode($content) .
			'</div>'
        ;

        return $html;
	}
	
}
