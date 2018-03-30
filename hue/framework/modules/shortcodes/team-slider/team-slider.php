<?php

namespace Hue\Modules\Shortcodes\TeamSlider;

use Hue\Modules\Shortcodes\Lib\ShortcodeInterface;

class TeamSlider implements ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_team_slider';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'         => esc_html__('Team Slider', 'hue'),
            'base'         => $this->base,
            'category'     => 'by MIKADO',
            'icon'         => 'icon-wpb-team-slider extended-custom-icon',
            'is_container' => true,
            'js_view'      => 'VcColumnView',
            'as_parent'    => array('only' => 'mkd_team_slider_item'),
            'params'       => array(
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Navigation Skin', 'hue'),
                    'param_name'  => 'skin',
                    'description' => '',
                    'value'       => array(
                        esc_html__('Dark', 'hue')  => 'dark',
                        esc_html__('Light', 'hue') => 'light'
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Number of Items in Row', 'hue'),
                    'param_name'  => 'number_of_items',
                    'description' => '',
                    'value'       => array(
                        '3' => '3',
                        '4' => '4',
                        '5' => '5'
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Enable AutoPlay?', 'hue'),
                    'param_name'  => 'auto_play',
                    'description' => '',
                    'value'       => array(
                        esc_html__('Yes', 'hue') => 'true',
                        esc_html__('No', 'hue')  => 'false'
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Enable Pagination?', 'hue'),
                    'param_name'  => 'show_dots',
                    'description' => '',
                    'value'       => array(
                        esc_html__('Yes', 'hue') => 'true',
                        esc_html__('No', 'hue')  => 'false'
                    ),
                ),
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'skin'            => '',
            'number_of_items' => '3',
            'auto_play'       => 'true',
            'show_dots'       => 'true'
        );
        $params       = shortcode_atts($default_atts, $atts);

        $nav = '';
        if($params['skin'] == 'light') {
            $nav = ' mkd-nav-light';
        }

        $params['light_nav'] = $nav;

        $dots = '';
        if($params['show_dots'] === 'false') {
            $dots = ' mkd-without-bullets';
        }

        $params['show_bullets'] = $dots;

        $params['content'] = $content;

        $params['data_attribute'] = $this->getDataAttribute($params);

        return hue_mikado_get_shortcode_module_template_part('templates/team-slider-template', 'team-slider', '', $params);
    }

    private function getDataAttribute($params) {
        $slider_data = '';

        if($params['number_of_items'] !== '') {
            $slider_data['data-items'] = $params['number_of_items'];
        }

        if($params['auto_play'] !== '') {
            $slider_data['data-play'] = $params['auto_play'];
        }

        if($params['show_dots'] !== '') {
            $slider_data['data-dots'] = $params['show_dots'];
        }

        return $slider_data;
    }
}