<?php
namespace Hue\Modules\PricingTable;

use Hue\Modules\Shortcodes\Lib\ShortcodeInterface;

class PricingTable implements ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'mkd_pricing_table';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Pricing Table', 'hue'),
            'base'                      => $this->base,
            'icon'                      => 'icon-wpb-pricing-table extended-custom-icon',
            'category'                  => 'by MIKADO',
            'allowed_container_element' => 'vc_row',
            'as_child'                  => array('only' => 'mkd_pricing_tables'),
            'params'                    => array(
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Title', 'hue'),
                    'param_name'  => 'title',
                    'value'       => 'Basic Plan',
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Title Size (px)', 'hue'),
                    'param_name'  => 'title_size',
                    'value'       => '',
                    'description' => '',
                    'dependency'  => array('element' => 'title', 'not_empty' => true)
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Price', 'hue'),
                    'param_name'  => 'price'
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Currency', 'hue'),
                    'param_name'  => 'currency'
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Price Period', 'hue'),
                    'param_name'  => 'price_period'
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Label', 'hue'),
                    'param_name'  => 'label',
                    'save_always' => ''
                ),
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Show Button', 'hue'),
                    'param_name'  => 'show_button',
                    'value'       => array(
                        esc_html__('Default', 'hue') => '',
                        esc_html__('Yes', 'hue')     => 'yes',
                        esc_html__('No', 'hue')      => 'no'
                    ),
                    'description' => ''
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Button Text', 'hue'),
                    'param_name'  => 'button_text',
                    'dependency'  => array('element' => 'show_button', 'value' => 'yes')
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Button Link', 'hue'),
                    'param_name'  => 'link',
                    'dependency'  => array('element' => 'show_button', 'value' => 'yes')
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Button Gradient Style', 'hue'),
                    'param_name'  => 'button_gradient_style',
                    'value'       => array_flip(hue_mikado_get_gradient_left_to_right_styles('-2x', true)),
                    'save_always' => true,
                    'dependency'  => array('element' => 'show_button', 'value' => 'yes')
                ),
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Active', 'hue'),
                    'param_name'  => 'active',
                    'value'       => array(
                        esc_html__('No', 'hue')  => 'no',
                        esc_html__('Yes', 'hue') => 'yes'
                    ),
                    'save_always' => true,
                    'description' => ''
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Active Gradient Background', 'hue'),
                    'param_name'  => 'active_gradient_background',
                    'value'       => array_flip(hue_mikado_get_gradient_left_bottom_to_right_top_styles('', false)),
                    'save_always' => true,
                    'dependency'  => array('element' => 'active', 'value' => 'yes')
                ),
                array(
                    'type'        => 'textarea_html',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Content', 'hue'),
                    'param_name'  => 'content',
                    'value'       => '<li>content content content</li><li>content content content</li><li>content content content</li>',
                    'description' => ''
                )
            )
        ));
    }

    public function render($atts, $content = null) {

        $args   = array(
            'title'                        => 'Basic Plan',
            'title_size'                   => '',
            'price'                        => '100',
            'currency'                     => '',
            'price_period'                 => '',
            'label'                        => '',
            'active'                       => 'no',
            'active_gradient_background'   => 'no',
            'show_button'                  => 'yes',
            'link'                         => '',
            'button_text'                  => 'button',
            'button_gradient_style'        => '',
            'active_pricing_table_classes' => ''
        );
        $params = shortcode_atts($args, $atts);
        extract($params);

        $html                  = '';
        $pricing_table_clasess = 'mkd-price-table';

        if($active == 'yes') {
            $pricing_table_clasess .= ' mkd-pt-active';

            $params['active_pricing_table_classes'] = $active_gradient_background;
        }

        $params['pricing_table_classes'] = $pricing_table_clasess;
        $params['content']               = $content;
        $params['button_params']         = $this->getButtonParams($params);

        $params['title_styles'] = array();

        if(!empty($params['title_size'])) {
            $params['title_styles'][] = 'font-size: '.hue_mikado_filter_px($params['title_size']).'px';
        }

        $html .= hue_mikado_get_shortcode_module_template_part('templates/pricing-table-template', 'pricing-table', '', $params);

        return $html;

    }

    private function getButtonParams($params) {
        $buttonParams = array();

        if($params['show_button'] === 'yes' && $params['button_text'] !== '') {
            $buttonParams = array(
                'link' => $params['link'],
                'text' => $params['button_text'],
                'size' => 'small'
            );

            $type = '';
            if($params['button_gradient_style'] !== '') {
                $type = 'gradient';
            }

            $buttonParams['type']           = $params['active'] === 'yes' ? 'white' : $type;
            $buttonParams['hover_type']     = $params['active'] === 'yes' ? 'white' : $type;
            $buttonParams['gradient_style'] = $params['active'] === 'yes' ? '' : $params['button_gradient_style'];
            $buttonParams['border_color']   = 'transparent';
        }

        return $buttonParams;
    }

}
