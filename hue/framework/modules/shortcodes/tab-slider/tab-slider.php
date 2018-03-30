<?php
namespace Hue\Modules\Shortcodes\TabSlider;

use Hue\Modules\Shortcodes\Lib\ShortcodeInterface;

class TabSlider implements ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_tab_slider';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                    => esc_html__('Tab Slider', 'hue'),
            'base'                    => $this->base,
            'as_parent'               => array('only' => 'mkd_tab_slider_item'),
            'content_element'         => true,
            'show_settings_on_create' => true,
            'category'                => 'by MIKADO',
            'icon'                    => 'icon-wpb-tab-slider extended-custom-icon',
            'js_view'                 => 'VcColumnView',
            'params'                  => array()
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = array();

        $params = array('content' => $content);

        return hue_mikado_get_shortcode_module_template_part('templates/tab-slider-holder', 'tab-slider', '', $params);
    }

}