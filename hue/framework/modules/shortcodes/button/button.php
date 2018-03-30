<?php
namespace Hue\Modules\Shortcodes\Button;

use Hue\Modules\Shortcodes\Lib\ShortcodeInterface;


/**
 * Class Button that represents button shortcode
 * @package Hue\Modules\Shortcodes\Button
 */
class Button implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    /**
     * Sets base attribute and registers shortcode with Visual Composer
     */
    public function __construct() {
        $this->base = 'mkd_button';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base attribute
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     */
    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Button', 'hue'),
            'base'                      => $this->base,
            'category'                  => 'by MIKADO',
            'icon'                      => 'icon-wpb-button extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array_merge(
                array(
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Size', 'hue'),
                        'param_name'  => 'size',
                        'value'       => array(
                            esc_html__('Default', 'hue')                => '',
                            esc_html__('Small', 'hue')                  => 'small',
                            esc_html__('Medium', 'hue')                 => 'medium',
                            esc_html__('Large', 'hue')                  => 'large',
                            esc_html__('Extra Large', 'hue')            => 'huge',
                            esc_html__('Extra Large Full Width', 'hue') => 'huge-full-width'
                        ),
                        'save_always' => true,
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Type', 'hue'),
                        'param_name'  => 'type',
                        'value'       => array_flip(hue_mikado_get_btn_types(true)),
                        'save_always' => true,
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Hover Type', 'hue'),
                        'param_name'  => 'hover_type',
                        'value'       => array_flip(hue_mikado_get_btn_types(true)),
                        'save_always' => true,
                        'admin_label' => true,
                        'dependency'  => array(
                            'element' => 'type',
                            'value'   => array(
                                '',
                                'outline',
                                'solid',
                                'white',
                                'white-outline',
                                'black',
                                'gradient'
                            )
                        ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Text', 'hue'),
                        'param_name'  => 'text',
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Link', 'hue'),
                        'param_name'  => 'link',
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Link Target', 'hue'),
                        'param_name'  => 'target',
                        'value'       => array(
                            esc_html__('Self', 'hue')  => '_self',
                            esc_html__('Blank', 'hue') => '_blank'
                        ),
                        'save_always' => true,
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Custom CSS class', 'hue'),
                        'param_name'  => 'custom_class',
                        'admin_label' => true
                    )
                ),
                hue_mikado_icon_collections()->getVCParamsArray(array(), '', true),
                array(
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Hover Animation', 'hue'),
                        'param_name'  => 'hover_animation',
                        'value'       => array_flip(hue_mikado_get_btn_hover_animation_types(true)),
                        'admin_label' => true,
                        'group'       => esc_html__('Advanced Options', 'hue'),
                        'dependency'  => array(
                            'element' => 'type',
                            'value'   => array(
                                '',
                                'outline',
                                'solid',
                                'white',
                                'white-outline',
                                'black',
                                'gradient'
                            )
                        ),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Gradient Style', 'hue'),
                        'param_name'  => 'gradient_style',
                        'admin_label' => true,
                        'value'       => array_flip(hue_mikado_get_gradient_left_to_right_styles('-2x')),
                        'dependency'  => array('element' => 'type', 'value' => array('gradient')),
                        'save_always' => true,
                        'group'       => esc_html__('Advanced Options', 'hue'),
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Color', 'hue'),
                        'param_name'  => 'color',
                        'group'       => esc_html__('Advanced Options', 'hue'),
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Hover Color', 'hue'),
                        'param_name'  => 'hover_color',
                        'group'       => esc_html__('Advanced Options', 'hue'),
                        'admin_label' => true,
                        'dependency'  => array(
                            'element' => 'type',
                            'value'   => array(
                                '',
                                'outline',
                                'solid',
                                'white',
                                'white-outline',
                                'black',
                                'gradient'
                            )
                        ),
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Background Color', 'hue'),
                        'param_name'  => 'background_color',
                        'admin_label' => true,
                        'dependency'  => array('element' => 'type', 'value' => array('solid')),
                        'group'       => esc_html__('Advanced Options', 'hue'),
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Hover Background Color', 'hue'),
                        'param_name'  => 'hover_background_color',
                        'admin_label' => true,
                        'group'       => esc_html__('Advanced Options', 'hue'),
                        'dependency'  => array(
                            'element' => 'type',
                            'value'   => array(
                                '',
                                'outline',
                                'solid',
                                'white',
                                'white-outline',
                                'black',
                                'gradient'
                            )
                        ),
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Border Color', 'hue'),
                        'param_name'  => 'border_color',
                        'admin_label' => true,
                        'group'       => esc_html__('Advanced Options', 'hue'),
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Hover Border Color', 'hue'),
                        'param_name'  => 'hover_border_color',
                        'admin_label' => true,
                        'group'       => esc_html__('Advanced Options', 'hue'),
                        'dependency'  => array(
                            'element' => 'type',
                            'value'   => array(
                                '',
                                'outline',
                                'solid',
                                'white',
                                'white-outline',
                                'black',
                                'gradient'
                            )
                        ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Font Size (px)', 'hue'),
                        'param_name'  => 'font_size',
                        'admin_label' => true,
                        'group'       => esc_html__('Advanced Options', 'hue'),
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Font Weight', 'hue'),
                        'param_name'  => 'font_weight',
                        'value'       => array_flip(hue_mikado_get_font_weight_array(true)),
                        'admin_label' => true,
                        'group'       => esc_html__('Advanced Options', 'hue'),
                        'save_always' => true
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Padding', 'hue'),
                        'param_name'  => 'padding',
                        'description' => esc_html__('Insert padding in format: 0px 0px 1px 0px', 'hue'),
                        'admin_label' => true,
                        'group'       => esc_html__('Advanced Options', 'hue'),
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Margin', 'hue'),
                        'param_name'  => 'margin',
                        'description' => esc_html__('Insert margin in format: 0px 0px 1px 0px', 'hue'),
                        'admin_label' => true,
                        'group'       => esc_html__('Advanced Options', 'hue'),
                    )
                )
            ) //close array_merge
        ));
    }

    /**
     * Renders HTML for button shortcode
     *
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $default_atts = array(
            'size'                   => '',
            'type'                   => '',
            'hover_type'             => '',
            'text'                   => '',
            'link'                   => '',
            'target'                 => '',
            'color'                  => '',
            'hover_color'            => '',
            'background_color'       => '',
            'hover_background_color' => '',
            'border_color'           => '',
            'hover_border_color'     => '',
            'font_size'              => '',
            'font_weight'            => '',
            'padding'                => '',
            'margin'                 => '',
            'custom_class'           => '',
            'html_type'              => 'anchor',
            'input_name'             => '',
            'hover_animation'        => '',
            'gradient_style'         => '',
            'custom_attrs'           => array()
        );

        $default_atts = array_merge($default_atts, hue_mikado_icon_collections()->getShortcodeParams());
        $params       = shortcode_atts($default_atts, $atts);

        if($params['html_type'] !== 'input') {
            $iconPackName   = hue_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
            $params['icon'] = $iconPackName ? $params[$iconPackName] : '';
        }

        $params['size'] = !empty($params['size']) ? $params['size'] : 'medium';
        $params['type'] = !empty($params['type']) ? $params['type'] : 'solid';


        $params['link']   = !empty($params['link']) ? $params['link'] : '#';
        $params['target'] = !empty($params['target']) ? $params['target'] : '_self';

        $params['hover_animation'] = $this->getHoverAnimation($params);

        //prepare params for template
        $params['button_classes']      = $this->getButtonClasses($params);
        $params['button_custom_attrs'] = !empty($params['custom_attrs']) ? $params['custom_attrs'] : array();
        $params['button_styles']       = $this->getButtonStyles($params);
        $params['button_data']         = $this->getButtonDataAttr($params);
        $params['show_icon']           = !empty($params['icon']);
        $params['display_helper']      = $params['hover_animation'] !== '' && ($params['hover_type'] !== 'outline' || $params['hover_type'] !== 'white-outline');
        $params['helper_styles']       = $this->getHelperStyles($params);

        return hue_mikado_get_shortcode_module_template_part('templates/'.$params['html_type'], 'button', '', $params);
    }

    /**
     * Returns array of button styles
     *
     * @param $params
     *
     * @return array
     */
    private function getButtonStyles($params) {
        $styles = array();

        if(!empty($params['color'])) {
            $styles[] = 'color: '.$params['color'];
        }

        if(!empty($params['background_color']) && $params['type'] !== 'outline') {
            $styles[] = 'background-color: '.$params['background_color'];
        }

        if(!empty($params['border_color'])) {
            $styles[] = 'border-color: '.$params['border_color'];
        }

        if(!empty($params['font_size'])) {
            $styles[] = 'font-size: '.hue_mikado_filter_px($params['font_size']).'px';
        }

        if(!empty($params['font_weight'])) {
            $styles[] = 'font-weight: '.$params['font_weight'];
        }

        if(!empty($params['padding'])) {
            $styles[] = 'padding: '.$params['padding'];
        }

        if(!empty($params['margin'])) {
            $styles[] = 'margin: '.$params['margin'];
        }

        return $styles;
    }

    /**
     *
     * Returns array of button data attr
     *
     * @param $params
     *
     * @return array
     */
    private function getButtonDataAttr($params) {
        $data = array();

        if(!empty($params['hover_background_color']) && ($params['hover_animation'] === '' || $params['hover_animation'] === 'disable')) {
            $data['data-hover-bg-color'] = $params['hover_background_color'];
        }

        if(!empty($params['hover_color'])) {
            $data['data-hover-color'] = $params['hover_color'];
        }

        if(!empty($params['hover_color'])) {
            $data['data-hover-color'] = $params['hover_color'];
        }

        if(!empty($params['hover_border_color'])) {
            $data['data-hover-border-color'] = $params['hover_border_color'];
        }

        return $data;
    }

    /**
     * Returns array of HTML classes for button
     *
     * @param $params
     *
     * @return array
     */
    private function getButtonClasses($params) {
        $buttonClasses = array(
            'mkd-btn',
            'mkd-btn-'.$params['size'],
            'mkd-btn-'.$params['type']
        );

        if(!empty($params['hover_background_color'])) {
            $buttonClasses[] = 'mkd-btn-custom-hover-bg';
        }

        if(!empty($params['hover_border_color'])) {
            $buttonClasses[] = 'mkd-btn-custom-border-hover';
        }

        if(!empty($params['hover_color'])) {
            $buttonClasses[] = 'mkd-btn-custom-hover-color';
        }
        if(!empty($params['icon'])) {
            $buttonClasses[] = 'mkd-btn-icon';
        }

        if(!empty($params['custom_class'])) {
            $buttonClasses[] = $params['custom_class'];
        }

        if(!empty($params['hover_animation']) && $params['hover_animation'] !== 'disable') {
            $buttonClasses[] = 'mkd-btn-'.$params['hover_animation'];
            $buttonClasses[] = 'mkd-btn-with-animation';
        }

        if($params['type'] == 'gradient') {
            $buttonClasses[] = $params['gradient_style'];
        }

        $hoverType       = $this->getHoverStyle($params);
        $buttonClasses[] = 'mkd-btn-hover-'.$hoverType;

        return $buttonClasses;
    }

    private function getHoverStyle($params) {
        if(!empty($params['hover_type'])) {
            $hoverType = $params['hover_type'];
        } else {
            switch($params['type']) {
                case 'outline':
                case 'white':
                case 'black':
                    $hoverType = 'solid';
                    break;
                case 'solid':
                    $hoverType = 'outline';
                    break;
                default:
                    $hoverType = 'outline';
                    break;
            }
        }

        return $hoverType;
    }

    private function getHoverAnimation($params) {
        if(!empty($params['hover_animation']) && ($params['hover_type'] !== 'outline' || $params['hover_type'] !== 'white-outline')) {
            return $params['hover_animation'];
        }

        return hue_mikado_options()->getOptionValue('button_hover_animation');
    }

    private function getHelperStyles($params) {
        $styles = array();

        if($params['display_helper']) {
            if(!empty($params['hover_background_color'])) {
                $styles[] = 'background-color: '.$params['hover_background_color'];
            }
        }

        return $styles;
    }
}