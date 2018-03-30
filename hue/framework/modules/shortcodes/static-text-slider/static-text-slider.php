<?php

namespace Hue\Modules\Shortcodes\StaticTextSlider;

use Hue\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class ZoomingSlider
 */
class StaticTextSlider implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    /**
     * ZoomingSlider constructor.
     */
    public function __construct() {
        $this->base = 'mkd_static_text_slider';

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
            'name'                      => esc_html__('Static Text Slider', 'hue'),
            'base'                      => $this->base,
            'category'                  => 'by MIKADO',
            'icon'                      => 'icon-wpb-static-text-slider extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'attach_images',
                    'heading'     => esc_html__('Images', 'hue'),
                    'param_name'  => 'images',
                    'description' => esc_html__('Select images from media library', 'hue')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Title', 'hue'),
                    'param_name'  => 'title',
                    'description' => esc_html__('Enter slider title', 'hue'),
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textarea',
                    'heading'     => esc_html__('Text', 'hue'),
                    'param_name'  => 'text',
                    'description' => esc_html__('Enter slider text', 'hue')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Button label', 'hue'),
                    'param_name'  => 'button_label',
                    'description' => esc_html__('Enter slider button label', 'hue')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Button link', 'hue'),
                    'param_name'  => 'button_link',
                    'description' => esc_html__('Enter slider button link', 'hue'),
                    'dependency'  => array('element' => 'button_label', 'not_empty' => true)
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Button Link Target', 'hue'),
                    'param_name'  => 'button_link_target',
                    'admin_label' => true,
                    'value'       => array(
                        esc_html__('Same Window', 'hue') => '_self',
                        esc_html__('New Window', 'hue')  => '_blank'
                    ),
                    'dependency'  => array('element' => 'button_label', 'not_empty' => true)
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Button Gradient Style', 'hue'),
                    'param_name'  => 'button_gradient_style',
                    'admin_label' => true,
                    'value'       => array_flip(hue_mikado_get_gradient_left_to_right_styles('-2x', true)),
                    'save_always' => true,
                    'dependency'  => array('element' => 'button_label', 'not_empty' => true)
                ),

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
        $args = array(
            'images'                => '',
            'title'                 => '',
            'text'                  => '',
            'button_label'          => '',
            'button_link'           => '',
            'button_link_target'    => '_self',
            'button_gradient_style' => '',
        );

        $params                = shortcode_atts($args, $atts);
        $params['images']      = $this->getSliderImages($params);
        $params['button_type'] = $this->getSliderbuttonType($params);

        return hue_mikado_get_shortcode_module_template_part('templates/static-text-slider', 'static-text-slider', '', $params);
    }

    /**
     * Return images for slider
     *
     * @param $params
     *
     * @return array
     */
    private function getSliderImages($params) {
        $image_ids = array();
        $images    = array();
        $i         = 0;

        if($params['images'] !== '') {
            $image_ids = explode(',', $params['images']);
        }

        foreach($image_ids as $id) {

            $image['image_id'] = $id;
            $image_original    = wp_get_attachment_image_src($id, 'full');
            $image['url']      = $image_original[0];
            $image['title']    = get_the_title($id);

            $images[$i] = $image;
            $i++;
        }

        return $images;

    }

    /**
     * Return button type
     *
     * @param $params
     *
     * @return string
     */
    private function getSliderbuttonType($params) {

        $type = $params['button_gradient_style'] !== '' ? 'gradient' : 'solid';


        return $type;

    }
}