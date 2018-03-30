<?php
namespace Hue\Modules\SeparatorWithIcon;

use Hue\Modules\Shortcodes\Lib\ShortcodeInterface;

class SeparatorWithIcon implements ShortcodeInterface {

    private $base;

    function __construct() {
        $this->base = 'mkd_separator_with_icon';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {

        vc_map(
            array(
                'name'                    => esc_html__('Separator With Icon', 'hue'),
                'base'                    => $this->base,
                'category'                => 'by MIKADO',
                'icon'                    => 'icon-wpb-separator-with-icon extended-custom-icon',
                'show_settings_on_create' => true,
                'class'                   => 'wpb_vc_separator_with_icon',
                'custom_markup'           => '<div></div>',
                'params'                  => array_merge(
                    \HueMikadoIconCollections::get_instance()->getVCParamsArray(),
                    array(
                        array(
                            'type'        => 'dropdown',
                            'admin_label' => true,
                            'heading'     => esc_html__('Icon Gradient Style', 'hue'),
                            'param_name'  => 'icon_gradient_style',
                            'value'       => array_flip(hue_mikado_get_gradient_left_to_right_styles('-text')),
                            'save_always' => true,
                            'description' => ''
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'heading'    => esc_html__('Separator Color', 'hue'),
                            'param_name' => 'sep_color',
                            'value'      => ''
                        ),
                    )
                )
            ));

    }

    public function render($atts, $content = null) {
        $args = array(
            'icon_gradient_style' => '',
            'sep_color'           => ''
        );

        $default_atts = array_merge($args, hue_mikado_icon_collections()->getShortcodeParams());
        $params       = shortcode_atts($default_atts, $atts);

        $iconPackName = hue_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

        extract($params);

        $params['icon']            = $params[$iconPackName];
        $params['separator_style'] = $this->getSeparatorStyle($params);

        $html = hue_mikado_get_shortcode_module_template_part('templates/separator-with-icon', 'separator-with-icon', '', $params);

        return $html;
    }

    private function getSeparatorStyle($params) {
        $styles = array();

        if($params['sep_color'] !== '') {
            $styles[] = 'border-top: 1px solid '.$params['sep_color'];
        }

        return $styles;
    }


}
