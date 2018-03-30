<?php
namespace QodeStartit\Modules\ProcessItem;

use QodeStartit\Modules\Shortcodes\Lib\ShortcodeInterface;

class ProcessItem implements ShortcodeInterface{

    private $base;

    function __construct() {
        $this->base = 'qodef_process_item';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
                'name' => 'Process Item',
                'base' => $this->base,
                'allowed_container_element' => 'vc_row',
                'as_child' => array('only' => 'qodef_process_holder'),
                'category' => 'by SELECT',
                'icon' => 'icon-wpb-process-item extended-custom-icon',
                'params' => array_merge(
                    qode_startit_icon_collections()->getVCParamsArray(),
                    array(
                        array(
                            'type' => 'textfield',
                            'heading' => 'Title',
                            'param_name' => 'title',
                            'admin_label' => true,
                            'description' => ''
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Title Tag',
                            'param_name' => 'title_tag',
                            'value' => array(
                                ''   => '',
                                'h2' => 'h2',
                                'h3' => 'h3',
                                'h4' => 'h4',
                                'h5' => 'h5',
                                'h6' => 'h6',
                            ),
                            'description' => ''
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => 'Text',
                            'param_name' => 'text',
                            'admin_label' => true,
                            'description' => ''
                        ),
                    )
                )
            )
        );
    }

    public function render($atts, $content = null) {

        $args = array(
            'title' => '',
            'title_tag' => 'h4',
            'text' => '',
        );

        $args = array_merge($args, qode_startit_icon_collections()->getShortcodeParams());
        $params = shortcode_atts($args, $atts);

        $params['icon_parameters'] = $this->getIconParameters($params);

        $html = qode_startit_get_shortcode_module_template_part('templates/process-item-template', 'process', '', $params);

        return $html;
    }

    private function getIconParameters($params) {
        $iconPackName = qode_startit_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

        $params_array['icon_pack']   = $params['icon_pack'];
        $params_array['type']   = 'circle';
        $params_array[$iconPackName] = $params[$iconPackName];

        return $params_array;
    }
}