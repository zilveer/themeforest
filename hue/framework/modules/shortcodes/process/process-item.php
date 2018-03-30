<?php
namespace Hue\Modules\Shortcodes\Process;

use Hue\Modules\Shortcodes\Lib\ShortcodeInterface;

class ProcessItem implements ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_process_item';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                    => esc_html__('Process Item', 'hue'),
            'base'                    => $this->getBase(),
            'as_child'                => array('only' => 'mkd_process_holder'),
            'category'                => 'by MIKADO',
            'icon'                    => 'icon-wpb-process-item extended-custom-icon',
            'show_settings_on_create' => true,
            'params'                  => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Number', 'hue'),
                    'param_name'  => 'number',
                    'save_always' => true,
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Title', 'hue'),
                    'param_name'  => 'title',
                    'save_always' => true,
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textarea',
                    'heading'     => esc_html__('Text', 'hue'),
                    'param_name'  => 'text',
                    'save_always' => true,
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Number Gradient Style', 'hue'),
                    'param_name'  => 'number_gradient_style',
                    'admin_label' => true,
                    'value'       => array_flip(hue_mikado_get_gradient_bottom_to_top_styles('-text', true)),
                    'save_always' => true,
                    'group'       => esc_html__('Design Options', 'hue'),
                ),
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'number'                => '',
            'number_gradient_style' => '',
            'title'                 => '',
            'text'                  => '',
        );

        $params = shortcode_atts($default_atts, $atts);

        return hue_mikado_get_shortcode_module_template_part('templates/process-item-template', 'process', '', $params);
    }

}