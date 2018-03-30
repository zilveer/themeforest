<?php
namespace Hue\Modules\Shortcodes\Process;

use Hue\Modules\Shortcodes\Lib\ShortcodeInterface;

class ProcessHolder implements ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_process_holder';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                    => esc_html__('Process', 'hue'),
            'base'                    => $this->getBase(),
            'as_parent'               => array('only' => 'mkd_process_item'),
            'content_element'         => true,
            'show_settings_on_create' => true,
            'category'                => 'by MIKADO',
            'icon'                    => 'icon-wpb-process extended-custom-icon',
            'js_view'                 => 'VcColumnView',
            'params'                  => array(
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'number_of_items',
                    'heading'     => esc_html__('Number of Process Items', 'hue'),
                    'value'       => array(
                        esc_html__('Three', 'hue') => 'three',
                        esc_html__('Four', 'hue')  => 'four'
                    ),
                    'save_always' => true,
                    'admin_label' => true,
                    'description' => ''
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'number_of_items' => ''
        );

        $params            = shortcode_atts($default_atts, $atts);
        $params['content'] = $content;

        $params['holder_classes'] = array(
            'mkd-process-holder',
            'mkd-process-holder-items-'.$params['number_of_items']
        );

        return hue_mikado_get_shortcode_module_template_part('templates/process-holder-template', 'process', '', $params);
    }
}