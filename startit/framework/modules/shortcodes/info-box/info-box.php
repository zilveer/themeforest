<?php
namespace QodeStartit\Modules\InfoBox;

use QodeStartit\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class UnderlineIconBox
 */
class InfoBox implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'qodef_info_box';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 *
	 * @see qode_core_get_carousel_slider_array_vc()
	 */
	public function vcMap() {

		vc_map( array(
			'name' => 'Select Info Box',
			'base' => $this->getBase(),
			'category' => 'by SELECT',
			'admin_enqueue_css' => array(qode_startit_get_skin_uri().'/assets/css/qodef-vc-extend.css'),
			'icon' => 'icon-wpb-underline-icon-box extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' =>array(
				array(
					'type'       => 'attach_image',
					'heading'    => 'Custom Icon',
					'param_name' => 'custom_icon'
				),
				array(
					'type' => 'textfield',
					'heading' => 'Title',
					'param_name' => 'title',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
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
					'description' => '',
					'dependency' => Array('element' => 'title', 'not_empty' => true)
				),
				array(
					'type' => 'textfield',
					'heading' => 'Text',
					'param_name' => 'text',
					'admin_label' => true,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Enable Rotating Animation',
					'param_name' => 'enable_animation',
					'value' => array(
						'No' => 'no',
						'Yes' => 'yes'
					),
					'save_always' => true,
					'description' => ''
				),

				array(
					'type' => 'textfield',
					'heading' => 'Back Side Text',
					'param_name' => 'back_text',
					'admin_label' => true,
					'description' => '',
					'dependency' => array('element' => 'enable_animation', 'value' => array('yes'))
				),

				array(
					'type' 			=> 'dropdown',
					'heading' 		=> 'Show Button',
					'param_name' 	=> 'show_button',
					'value' 		=> array(
						'No' 		=> 'no',
						'Yes' 		=> 'yes'
					),
					'admin_label' 	=> true,
					'save_always' 	=> true,
					'description' 	=> '',
					'dependency' => array('element' => 'enable_animation', 'value' => array('yes'))
				),
				array(
					'type' => 'textfield',
					'heading' => 'Button Text',
					'param_name' => 'button_text',
					'admin_label' 	=> true,
					'description' => 'Default text is "button"',
					'dependency' => array('element' => 'show_button', 'value' => array('yes'))
				),
				array(
					'type' => 'textfield',
					'heading' => 'Button Link',
					'param_name' => 'button_link',
					'description' => '',
					'admin_label' 	=> true,
					'dependency' => array('element' => 'show_button', 'value' => array('yes'))
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Button Target',
					'param_name' => 'button_target',
					'value' => array(
						'' => '',
						'Self' => '_self',
						'Blank' => '_blank'
					),
					'description' => '',
					'dependency' => array('element' => 'show_button', 'value' => array('yes'))
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Enable Front Side Border',
					'param_name' => 'enable_border',
					'value' => array(
						'Yes' => 'yes',
						'No' => 'no'
					),
					'save_always' => true,
					'description' => '',
					'group' => 'Design Options'
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => 'Front Side Background Color',
					'param_name'  => 'background_color',
					'admin_label' => true,
					'description' => '',
					'group' => 'Design Options'
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Front Side Style',
					'param_name' => 'front_side_style',
					'value' => array(
						'Dark' => 'dark',
						'Light' => 'light'
					),
					'save_always' => true,
					'description' => '',
					'group' => 'Design Options'
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => 'Back Side Background Color',
					'param_name'  => 'back_background_color',
					'admin_label' => true,
					'description' => '',
					'group' => 'Design Options',
					'dependency' => array('element' => 'enable_animation', 'value' => array('yes'))
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Back Side Style',
					'param_name' => 'back_side_style',
					'value' => array(
						'Light' => 'light',
						'Dark' => 'dark'

					),
					'save_always' => true,
					'description' => '',
					'group' => 'Design Options',
					'dependency' => array('element' => 'enable_animation', 'value' => array('yes'))
				),
                array(
                    'type' => 'textfield',
                    'heading' => 'Image Padding Bottom (px)',
                    'param_name' => 'image_padding_bottom',
                    'admin_label' => true,
                    'description' => '',
                    'group' => 'Design Options'
                )
			)
		) );

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {

		$default_atts = array(
			'title' => '',
			'title_tag' => 'h6',
			'text' => '',
			'enable_border' => 'yes',
			'custom_icon' => '',
			'background_color' => '',
			'back_background_color' => '',
			'enable_animation' => 'no',
			'back_text' => '',
			'show_button' => 'no',
			'button_text' => 'button',
			'button_link' => '',
			'button_target' => '',
			'front_side_style' => 'dark',
			'back_side_style' => 'light',
			'image_padding_bottom' => ''
		);

		$params       = shortcode_atts($default_atts, $atts);

		$params['holder_classes']  = $this->getHolderClasses($params);
		$params['button_parameters'] = $this->getButtonParameters($params);
		$params['front_bkg'] = $this->getFrontBackground($params);
		$params['back_bkg'] = $this->getBackBackground($params);
		$params['front_style'] = $this->getFrontStyle($params);
		$params['back_style'] = $this->getBackStyle($params);
		$params['image_style'] = $this->getImageStyle($params);

		//get correct heading value. If provided heading isn't valid get the default one
		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');
		$params['title_tag'] = (in_array($params['title_tag'], $headings_array)) ? $params['title_tag'] : $default_atts['title_tag'];

		//Get HTML from template
		$html = qode_startit_get_shortcode_module_template_part('templates/info-box-template', 'info-box', '', $params);

		return $html;

	}


	private function getHolderClasses($params) {

		$classes = array('qodef-info-box');

		if($params['enable_border'] == 'yes') {
			$classes[] = 'qodef-with-border';
		}

		if($params['enable_animation'] == 'yes') {
			$classes[] = 'qodef-animate';
		}

		if($params['enable_animation'] == 'yes' && $params['show_button'] == 'yes' && $params['back_text'] !=='') {
			$classes[] = 'qodef-back-margin';
		}

		return $classes;
	}

	private function getButtonParameters($params) {
		$button_params_array = array();

		if(!empty($params['button_link'])) {
			$button_params_array['link'] = $params['button_link'];
		}

		if(!empty($params['button_target'])) {
			$button_params_array['target'] = $params['button_target'];
		}

		if(!empty($params['button_text'])) {
			$button_params_array['text'] = $params['button_text'];
		}

		$button_params_array['type'] = 'outline';

		return $button_params_array;
	}

	private function getFrontBackground($params){

		$front_bkg= array();

		if(!empty($params['background_color'])) {
			$front_bkg[] = 'background-color: '.$params['background_color'];
		}

		return $front_bkg;

	}

	private function getBackBackground($params){

		$back_bkg= array();

		if(!empty($params['back_background_color'])) {
			$back_bkg[] = 'background-color: '.$params['back_background_color'];
		}

		return $back_bkg;

	}

	private function getFrontStyle($params){
		return ($params['front_side_style'] !== '') ? 'qodef-'.$params['front_side_style'] : '';
	}

	private function getBackStyle($params){
		return ($params['back_side_style'] !== '') ? 'qodef-'.$params['back_side_style'] : '';
	}

    private function getImageStyle($params){

        $image_style = array();

        if(!empty($params['image_padding_bottom'])) {
            $image_style[] = 'padding-bottom: '.$params['image_padding_bottom'] . 'px';
        }

        return $image_style;

    }
}