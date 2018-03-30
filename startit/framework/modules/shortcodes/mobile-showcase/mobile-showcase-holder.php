<?php
namespace QodeStartit\Modules\MobileShowcaseHolder;

use QodeStartit\Modules\Shortcodes\Lib\ShortcodeInterface;

class MobileShowcaseHolder implements ShortcodeInterface {

    private $base;

    function __construct() {
        $this->base = 'qodef_mobile_showcase_holder';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
                'name' => '3d Mobile Showcase Holder',
                'base' => $this->base,
                'icon' => 'icon-wpb-mobile-showcase-holder extended-custom-icon',
                'category' => 'by SELECT',
                'as_parent' => array('only' => 'qodef_mobile_showcase_item'),
                'js_view' => 'VcColumnView',
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'class' => '',
                        'heading' => 'Number of Layers',
                        'admin_label' => true,
                        'param_name' => 'number_of_layers',
                        'value' => array(
                            'One' => 'layers-1',
                            'Two' => 'layers-2',
                            'Three' => 'layers-3',
                            'Four' => 'layers-4',
                            'Five' => 'layers-5'
                        ),
                        'description' => '',
                        'save_always' => true
                    ),
                    array(
                        'type'       => 'attach_image',
                        'heading'    => 'Image',
                        'param_name' => 'image',
                        'description' => 'Upload image to show on devices where 3d animation is not supported '
                    )
                )
            )
        );
    }

    public function render($atts, $content = null) {

        $args = array(
            'number_of_layers' =>  '',
            'image' => ''
        );

        $params = shortcode_atts($args, $atts);
        extract($params);

        $process_holder_class = array();
        $process_holder_class[] = 'qodef-mobile-showcase';
        $process_holder_class[] = $params['number_of_layers'];

        $html = '';

        $html .= '<div  ' . qode_startit_get_class_attribute($process_holder_class) . '>';
        $html.= '<div class="qodef-mobile-wrapper">';
        $html.= '<div class="qodef-mobile-preview-image">';
        $html.=  wp_get_attachment_image($image, 'full');
        $html.= '</div>';
        $html.= '<div class="qodef-perspective">';
        $html.= '<div class="qodef-device">';
        $html.= '<div class="qodef-object">';
        $html.= '<div class="qodef-front"></div>';
        $html.= '</div>';
        $html.='<div class="qodef-screens">';
        $html .= do_shortcode($content);
        $html.= '</div>';
        $html.= '</div>';
        $html.= '</div>';
        $html.= '</div>';
        $html.= '</div>';

        return $html;
    }
}