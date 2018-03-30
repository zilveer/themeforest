<?php
namespace QodeStartit\Modules\MobileShowcaseItem;

use QodeStartit\Modules\Shortcodes\Lib\ShortcodeInterface;

class MobileShowcaseItem implements ShortcodeInterface{

    private $base;

    function __construct() {
        $this->base = 'qodef_mobile_showcase_item';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
                'name' => '3d Mobile Showcase  Item',
                'base' => $this->base,
                'allowed_container_element' => 'vc_row',
                'as_child' => array('only' => 'qodef_mobile_showcase_holder'),
                'category' => 'by SELECT',
                'icon' => 'icon-wpb-mobile-showcase-item extended-custom-icon',
                'params' => array(
                    array(
                        'type'       => 'attach_image',
                        'heading'    => 'Image',
                        'param_name' => 'background_image'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => 'Text',
                        'param_name' => 'text',
                        'admin_label' => true,
                        'description' => ''
                    )
                )
            )
        );
    }

    public function render($atts, $content = null) {

        $args = array(
            'text' => '',
            'background_image' => '',
            'link' => '',
            'target'  => ''
        );

        $params = shortcode_atts($args, $atts);
        $params['mobile_showcase_item_image'] = $this->getMobileShowcaseItemImage($params);

        $html = qode_startit_get_shortcode_module_template_part('templates/mobile-showcase-item-template', 'mobile-showcase', '', $params);

        return $html;
    }

    /**
     * Return Mobile Showcase Item  Background image
     *
     * @param $params
     * @return array
     */
    private function getMobileShowcaseItemImage($params) {

        $element_item_image = '';


        if ($params['background_image'] !== '') {
            $element_item_image = 'background-image: url(' . wp_get_attachment_url($params['background_image']) . ')';
        }

        return $element_item_image;

    }

}