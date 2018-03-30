<?php
namespace QodeStartit\Modules\FullwidthSliderItem;

use QodeStartit\Modules\Shortcodes\Lib\ShortcodeInterface;

class FullwidthSliderItem implements ShortcodeInterface{

    private $base;

    function __construct() {
        $this->base = 'qodef_fullwidth_slider_item';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
                'name' => 'Fullwidth Slider Item',
                'base' => $this->base,
                'allowed_container_element' => 'vc_row',
                'as_child' => array('only' => 'qodef_fullwidth_slider_holder'),
                'category' => 'by SELECT',
                'icon' => 'icon-wpb-fullwidth-slider-item extended-custom-icon',
                'params' => array_merge(
                    array(
                        array(
                            'type'       => 'attach_image',
                            'heading'    => 'Image',
                            'param_name' => 'image'
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
                            'description' => ''
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => 'Subtitle',
                            'param_name' => 'subtitle',
                            'admin_label' => true,
                            'description' => ''
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Subtitle Tag',
                            'param_name' => 'subtitle_tag',
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
                            'heading' => 'Text',
                            'param_name' => 'text',
                            'admin_label' => true,
                            'description' => ''
                        ),
                        array(
                            'type' 			=> 'dropdown',
                            'heading' 		=> 'Show Button',
                            'param_name' 	=> 'show_button',
                            'value' 		=> array(
                                'Yes' 		=> 'yes',
                                'No' 		=> 'no'
                            ),
                            'admin_label' 	=> true,
                            'save_always' 	=> true,
                            'description' 	=> ''
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Button Size',
                            'param_name' => 'button_size',
                            'value' => array(
                                'Default' => '',
                                'Small' => 'small',
                                'Medium' => 'medium',
                                'Large' => 'large',
                                'Extra Large' => 'big_large'
                            ),
                            'description' => '',
                            'dependency' => array('element' => 'show_button', 'value' => array('yes'))
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Button Type',
                            'param_name' => 'button_type',
                            'value' => array(
                                'Default' => '',
                                'Outline' => 'outline',
                                'Solid'   => 'solid'
                            ),
                            'description' => '',
                            'dependency' => array('element' => 'show_button', 'value' => array('yes'))
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
                            'heading' => 'Show Button Icon',
                            'param_name' => 'button_icon',
                            'value' => array(
                                'Yes' => 'yes',
                                'No'   => 'no'
                            ),
                            'description' => '',
                            'dependency' => array('element' => 'show_button', 'value' => array('yes'))
                        ),
                    ),
                    qode_startit_icon_collections()->getVCParamsArray(array('element' => 'button_icon', 'value' => array('yes')))
                )
            )
        );
    }

    public function render($atts, $content = null) {

        $args = array(
            'image' => '',
            'title' => '',
            'title_tag' => 'h4',
            'subtitle' => '',
            'subtitle_tag' => 'h4',
            'text' => '',
            'show_button' => 'yes',
            'button_size' => '',
            'button_type' => '',
            'button_link' => '',
            'button_text' => 'button',
            'button_target' => '',
            'button_icon' => 'yes',
        );

        $args = array_merge($args, qode_startit_icon_collections()->getShortcodeParams());
        $params = shortcode_atts($args, $atts);

        $params['button_parameters'] = $this->getButtonParameters($params);
        $params['image'] = $this->getImageSrc($params);
        $params['slide_holder_style'] = $this->getSlideHolderStyle($params);

        $html = qode_startit_get_shortcode_module_template_part('templates/fullwidth-slider-item-template', 'fullwidth-slider', '', $params);

        return $html;
    }

    private function getButtonParameters($params) {
        $button_params_array = array();

        if(!empty($params['button_link'])) {
            $button_params_array['link'] = $params['button_link'];
        }

        if(!empty($params['button_size'])) {
            $button_params_array['size'] = $params['button_size'];
        }

        if(!empty($params['button_type'])) {
            $button_params_array['type'] = $params['button_type'];
        }

        if($params['button_icon'] == 'yes') {
            $iconPackName = qode_startit_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

            $button_params_array['icon_pack'] = $params['icon_pack'];
            $button_params_array[$iconPackName] = $params[$iconPackName];
        }

        if(!empty($params['button_target'])) {
            $button_params_array['target'] = $params['button_target'];
        }

        if(!empty($params['button_text'])) {
            $button_params_array['text'] = $params['button_text'];
        }

        return $button_params_array;
    }

    private function getImageSrc($params) {



        if (is_numeric($params['image'])) {
            $image_src = wp_get_attachment_url($params['image']);
        } else {
            $image_src = $params['image'];
        }

        return $image_src;

    }

    private function getSlideHolderStyle($params) {

        $slide_holder_style = array();

        if (is_numeric($params['image'])) {
            $slide_holder_style[] = 'background-image: url(' . wp_get_attachment_url($params['background_image']) . ')';
        }
        else {
            $slide_holder_style[] = 'background-image: url(' . $params['image'] . ')';
        }

        return implode(';', $slide_holder_style);
    }

}