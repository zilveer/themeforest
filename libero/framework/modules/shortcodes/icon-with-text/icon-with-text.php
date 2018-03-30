<?php
namespace Libero\Modules\Shortcodes\IconWithText;

use Libero\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class IconWithText
 * @package Libero\Modules\Shortcodes\IconWithText
 */
class IconWithText implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    /**
     *
     */
    public function __construct() {
        $this->base = 'mkd_icon_with_text';

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
            'name'                      => 'Icon With Text',
            'base'                      => $this->base,
            'icon'                      => 'icon-wpb-icon-with-text extended-custom-icon',
            'category'                  => 'by MIKADO',
            'allowed_container_element' => 'vc_row',
            'params'                    => array_merge(
                libero_mikado_icon_collections()->getVCParamsArray(),
                array(
                    array(
                        'type'       => 'attach_image',
                        'heading'    => 'Custom Icon',
                        'param_name' => 'custom_icon'
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Icon Position',
                        'param_name'  => 'icon_position',
                        'value'       => array(
                            'Top'             => 'top',
                            'Left'            => 'left',
                            'Left From Title' => 'left-from-title',
                            'Right'           => 'right'
                        ),
                        'description' => 'Icon Position',
                        'save_always' => true,
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Icon Type',
                        'param_name'  => 'icon_type',
                        'value'       => array(
                            'Default' => '',
                            'Normal' => 'normal',
                            'Circle' => 'circle',
                            'Square' => 'square'
                        ),
                        'admin_label' => true,
                        'group'       => 'Icon Settings'
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Icon Size',
                        'param_name'  => 'icon_size',
                        'value'       => array(
                        	'Default'    => '',
                            'Tiny'       => 'mkd-icon-tiny',
                            'Small'      => 'mkd-icon-small',
                            'Medium'     => 'mkd-icon-medium',
                            'Large'      => 'mkd-icon-large',
                            'Very Large' => 'mkd-icon-huge'
                        ),
                        'admin_label' => true,
                        'group'       => 'Icon Settings'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => 'Custom Icon Size (px)',
                        'param_name' => 'custom_icon_size',
                        'group'      => 'Icon Settings'
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Icon Animation',
                        'param_name'  => 'icon_animation',
                        'value'       => array(
                            'No'  => '',
                            'Yes' => 'yes'
                        ),
                        'group'       => 'Icon Settings',
                        'save_always' => true,
                        'admin_label' => true
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => 'Icon Animation Delay (ms)',
                        'param_name' => 'icon_animation_delay',
                        'group'      => 'Icon Settings',
                        'dependency' => array('element' => 'icon_animation', 'value' => array('yes'))
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => 'Icon Margin',
                        'param_name'  => 'icon_margin',
                        'value'       => '',
                        'description' => 'Margin should be set in a top right bottom left format',
                        'admin_label' => true,
                        'group'       => 'Icon Settings',
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => 'Shape Size (px)',
                        'param_name'  => 'shape_size',
                        'description' => '',
                        'admin_label' => true,
                        'group'       => 'Icon Settings'
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => 'Icon Color',
                        'param_name' => 'icon_color',
                        'group'      => 'Icon Settings'
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => 'Icon Hover Color',
                        'param_name' => 'icon_hover_color',
                        'group'      => 'Icon Settings'
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => 'Icon Background Color',
                        'param_name'  => 'icon_background_color',
                        'description' => 'Icon Background Color',
                        'dependency'  => array('element' => 'icon_type', 'value' => array('square', 'circle','')),
                        'group'       => 'Icon Settings'
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => 'Icon Hover Background Color',
                        'param_name'  => 'icon_hover_background_color',
                        'description' => 'Icon Hover Background Color',
                        'dependency'  => array('element' => 'icon_type', 'value' => array('square', 'circle','')),
                        'group'       => 'Icon Settings'
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
                            'h1' => 'h1',
                            'h2' => 'h2',
                            'h3' => 'h3',
                            'h4' => 'h4',
                            'h5' => 'h5',
                            'h6' => 'h6',
                        ),
                        'dependency' => array('element' => 'title', 'not_empty' => true),
                        'group'      => 'Text Settings'
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => 'Title Color',
                        'param_name' => 'title_color',
                        'dependency' => array('element' => 'title', 'not_empty' => true),
                        'group'      => 'Text Settings'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => 'Title Top Margin (px)',
                        'param_name' => 'title_margin_top',
                        'dependency' => array('element' => 'title', 'not_empty' => true),
                        'group'      => 'Text Settings'
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
                        'group'      => 'Text Settings'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => 'Text Left Padding (px)',
                        'param_name' => 'text_left_padding',
                        'dependency' => array('element' => 'icon_position', 'value' => array('left')),
                        'group'      => 'Text Settings'
                    ),
                    array(
                        'type'       => 'textfield',
                        'heading'    => 'Text Right Padding (px)',
                        'param_name' => 'text_right_padding',
                        'dependency' => array('element' => 'icon_position', 'value' => array('right')),
                        'group'      => 'Text Settings'
                    ),
                    array(
                    	'type'		=> 'textfield',
                    	'heading'	=> 'Link',
                    	'param_name'=> 'link'
                	)
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
            'custom_icon'                 => '',
            'icon_position'               => '',
            'icon_type'                   => 'circle',
            'icon_size'                   => 'mkd-icon-small',
            'custom_icon_size'            => '',
            'icon_animation'              => '',
            'icon_animation_delay'        => '',
            'icon_margin'                 => '',
            'shape_size'                  => '',
            'icon_color'                  => '',
            'icon_hover_color'            => '',
            'icon_background_color'       => '',
            'icon_hover_background_color' => '',
            'title'                       => '',
            'title_tag'                   => 'h4',
            'title_color'                 => '',
            'subtitle'                    => '',
            'text'                        => '',
            'text_color'                  => '',
            'title_margin_top'            => '',
            'text_left_padding'           => '',
            'text_right_padding'          => '',
            'link'                        => ''
        );

        $default_atts = array_merge($default_atts, libero_mikado_icon_collections()->getShortcodeParams());
        $params       = shortcode_atts($default_atts, $atts);

        $params['icon_parameters'] = $this->getIconParameters($params);
        $params['holder_classes']  = $this->getHolderClasses($params);
        $params['title_styles']    = $this->getTitleStyles($params);
        $params['content_styles']  = $this->getContentStyles($params);
        $params['text_styles']     = $this->getTextStyles($params);

        return libero_mikado_get_shortcode_module_template_part('templates/iwt', 'icon-with-text', $params['icon_position'], $params);
    }

    /**
     * Returns parameters for icon shortcode as a string
     *
     * @param $params
     *
     * @return array
     */
    private function getIconParameters($params) {
        $params_array = array();

        if(empty($params['custom_icon'])) {
            $iconPackName = libero_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

            $params_array['icon_pack']   = $params['icon_pack'];
            $params_array[$iconPackName] = $params[$iconPackName];

            if(!empty($params['icon_size'])) {
                $params_array['size'] = $params['icon_size'];
            }

            if(!empty($params['custom_icon_size'])) {
                $params_array['custom_size'] = $params['custom_icon_size'];
            }

            if(!empty($params['icon_type'])) {
                $params_array['type'] = $params['icon_type'];
            }

            $params_array['shape_size'] = $params['shape_size'];

            if(!empty($params['icon_background_color'])) {
                $params_array['background_color'] = $params['icon_background_color'];
            }

            if(!empty($params['icon_hover_background_color'])) {
                $params_array['hover_background_color'] = $params['icon_hover_background_color'];
            }

            $params_array['icon_color'] = $params['icon_color'];

            if(!empty($params['icon_hover_color'])) {
                $params_array['hover_icon_color'] = $params['icon_hover_color'];
            }

            $params_array['icon_animation'] = $params['icon_animation'];
            $params_array['icon_animation_delay'] = $params['icon_animation_delay'];
            $params_array['margin'] = $params['icon_margin'];
            $params_array['link'] = $params['link'];
            $params_array['target'] = "_blank";
        }

        return $params_array;
    }

    /**
     * Returns array of holder classes
     *
     * @param $params
     *
     * @return array
     */
    private function getHolderClasses($params) {
        $classes = array('mkd-iwt', 'clearfix');

        if(!empty($params['icon_position'])) {
            switch($params['icon_position']) {
                case 'top':
                    $classes[] = 'mkd-iwt-icon-top';
                    break;
                case 'left':
                    $classes[] = 'mkd-iwt-icon-left';
                    break;
                case 'right':
                    $classes[] = 'mkd-iwt-icon-right';
                    break;
                case 'left-from-title':
                    $classes[] = 'mkd-iwt-left-from-title';
                    break;
                default:
                    break;
            }
        }

        if(!empty($params['icon_type'])){
            $classes[] = 'mkd-iwt-icon-'.$params['icon_type'];
        }

        if(!empty($params['icon_size'])) {
            $classes[] = 'mkd-iwt-'.str_replace('mkd-', '', $params['icon_size']);
        }

        return $classes;
    }

    private function getTitleStyles($params) {
        $styles = array();

        if(!empty($params['title_color'])) {
            $styles[] = 'color: '.$params['title_color'];
        }

        if(!empty($params['title_margin_top'])) {
            $styles[] = 'margin-top: '.libero_mikado_filter_px($params['title_margin_top']).'px';
        }

        return $styles;
    }

    private function getTextStyles($params) {
        $styles = array();

        if(!empty($params['text_color'])) {
            $styles[] = 'color: '.$params['text_color'];
        }

        return $styles;
    }

    private function getContentStyles($params) {
        $styles = array();

        if($params['icon_position'] == 'left' && !empty($params['text_left_padding'])) {
            $styles[] = 'padding-left: '.libero_mikado_filter_px($params['text_left_padding']).'px';
        }

        if($params['icon_position'] == 'right' && !empty($params['text_right_padding'])) {
            $styles[] = 'padding-right: '.libero_mikado_filter_px($params['text_right_padding']).'px';
        }

        return $styles;
    }
}