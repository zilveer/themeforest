<?php
namespace Libero\Modules\Shortcodes\ImageWithText;

use Libero\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class ImageWithText
 * @package Libero\Modules\Shortcodes\ImageWithText
 */
class ImageWithText implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	/**
	 *
	 */
	public function __construct() {
		$this->base = 'mkd_image_with_text';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 *
	 */
	public function vcMap() {
		vc_map(array(
			'name'                      => 'Image With Text',
			'base'                      => $this->base,
			'icon'                      => 'icon-wpb-image-with-text extended-custom-icon',
			'category'                  => 'by MIKADO',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
					array(
						'type'       => 'attach_image',
						'heading'    => 'Image',
						'param_name' => 'image'
					),
					array(
						'type'        => 'textfield',
						'heading'     => 'Image Padding',
						'param_name'  => 'image_padding',
						'value'       => '',
						'admin_label' => true,
						'description' => 'Set image padding in form 0px 1px 0px 0px',
						'group'       => 'Design Options'
					),
					array(
						'type'        => 'textfield',
						'heading'     => 'Title',
						'param_name'  => 'title',
						'value'       => '',
						'admin_label' => true
					),
					array(
						'type'       => 'dropdown',
						'heading'    => 'Title Tag',
						'param_name' => 'title_tag',
						'value'      => array(
							''   => '',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
						),
						'dependency' => array('element' => 'title', 'not_empty' => true),
						'group'      => 'Design Options'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => 'Title Color',
						'param_name' => 'title_color',
						'dependency' => array('element' => 'title', 'not_empty' => true),
						'group'      => 'Design Options'
					),
					array(
						'type'        => 'textfield',
						'heading'     => 'Subtitle',
						'param_name'  => 'subtitle',
						'value'       => '',
						'admin_label' => true
					),
					array(
						'type'       => 'textarea',
						'heading'    => 'Text',
						'param_name' => 'text'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => 'Text Color',
						'param_name' => 'text_color',
						'dependency' => array('element' => 'text', 'not_empty' => true),
						'group'      => 'Design Options'
					),
					array(
						'type'       => 'textfield',
						'heading'    => 'Text Left Padding (px)',
						'param_name' => 'text_left_padding',
						'group'      => 'Design Options'
					),
					array(
						'type'		=> 'textfield',
						'heading'	=> 'Link',
						'param_name'=> 'link'
					),
					array(
						'type'		=> 'textfield',
						'heading'	=> 'Link Text',
						'param_name'=> 'link_text',
						'dependency'=> array('element' => 'link', 'not_empty' => true)
					),
					array(
						'type'		=> 'dropdown',
						'heading'	=> 'Link Target',
						'param_name'=> 'link_target',
						'value'		=> array(
							'Default' => '',
							'Self' => '_self',
							'Blank' => '_blank'
						),
						'dependency'=> array('element' => 'link', 'not_empty' => true)
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => 'Link Button Background Color',
						'param_name' => 'link_bckg_color',
						'dependency' => array('element' => 'link', 'not_empty' => true),
						'group'      => 'Design Options'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => 'Link text Color',
						'param_name' => 'link_color',
						'dependency' => array('element' => 'link', 'not_empty' => true),
						'group'      => 'Design Options'
					)
			)
		));
	}

	/**
	 * @param array $atts
	 * @param null $content
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {
		$default_atts = array(
			'image'             => '',
			'image_padding'     => '',
			'title'             => '',
			'title_tag'         => 'h4',
			'title_color'       => '',
			'subtitle'          => '',
			'text'              => '',
			'text_color'        => '',
			'text_left_padding' => '',
			'link'				=> '',
			'link_text'			=> '',
			'link_target'		=> '',
			'link_bckg_color'   => '',
			'link_color'   => '',
		);

		$default_atts = array_merge($default_atts, libero_mikado_icon_collections()->getShortcodeParams());
		$params       = shortcode_atts($default_atts, $atts);

		$params['title_styles'] = $this->getTitleStyles($params);
        $params['image_src'] = $this->getImage($params);
		$params['image_holder_style'] = $this->getImageHolderStyle($params,$params['image_src']);
		$params['content_styles'] = $this->getContentStyles($params);
		$params['text_styles'] = $this->getTextStyles($params);
		$params['button_params'] = $this->getButtonParams($params);

		return libero_mikado_get_shortcode_module_template_part('templates/imagewt-template', 'imagewithtext', '', $params);
	}

    /**
     * Return image
     *
     * @param $params
     * @return false|string
     */
    private function getImage($params) {

        if (is_numeric($params['image'])) {
            $image_src = wp_get_attachment_url($params['image']);
        } else {
            $image_src = $params['image'];
        }

        return $image_src;
    }

	/**
	 * Return image holder style
	 *
	 * @param $params
	 * @param $url
	 * @return false|string
	 */
	private function getImageHolderStyle($params,$url) {
		$image_holder_style = array();

		if ($url !== ''){
			$image_dimension = libero_mikado_get_image_dimensions($url);
			$image_holder_style[] = 'width: '.$image_dimension['width'].'px';
		}

		if ($params['image_padding'] !== ''){
			$image_holder_style[] = 'padding: '.$params['image_padding'];
		}

		return $image_holder_style;
	}

	/**
	 * Return Title Style
	 *
	 * @param $params
	 * @return string
	 */
	private function getTitleStyles($params) {
		$styles = array();

		if(!empty($params['title_color'])) {
			$styles[] = 'color: '.$params['title_color'];
		}

		return $styles;
	}

	/**
	 * Return Text Style
	 *
	 * @param $params
	 * @return string
	 */
	private function getTextStyles($params) {
		$styles = array();

		if(!empty($params['text_color'])) {
			$styles[] = 'color: '.$params['text_color'];
		}

		return $styles;
	}

	/**
	 * Return Content Style
	 *
	 * @param $params
	 * @return string
	 */
	private function getContentStyles($params) {
		$styles = array();

		if($params['text_left_padding'] !== '') {
			$styles[] = 'padding-left: '.libero_mikado_filter_px($params['text_left_padding']).'px';
		}

		return $styles;
	}

	/**
	 * Return Link/button parameters
	 *
	 * @param $params
	 * @return string
	 */
	private function getButtonParams($params) {
		$button_params = array();

		if(!empty($params['link'])) {
			$button_params['link'] = $params['link'];

			if(!empty($params['link_target'])) {
				$button_params['target'] = $params['link_target'];
			}

			if(!empty($params['link_color'])) {
				$button_params['color'] = $params['link_color'];
			}

			if(!empty($params['link_bckg_color'])) {
				$button_params['background_color'] = $params['link_bckg_color'];
			}

			if(!empty($params['link_text'])) {
				$button_params['text'] = $params['link_text'];
			}
			else{
				$button_params['text'] = 'Read More';				
			}

			$button_params['size'] = 'medium';
			$button_params['type'] = 'solid';
			$button_params['custom_class'] = 'mkd-imagewt-btn';
			$button_params['icon_pack'] = 'font_elegant';
			$button_params['fe_icon'] = 'arrow_carrot-right';
		}

		return $button_params;
	}
}