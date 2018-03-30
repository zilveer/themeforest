<?php
namespace QodeStartit\Modules\ProcessHolder;

use QodeStartit\Modules\Shortcodes\Lib\ShortcodeInterface;

class ProcessHolder implements ShortcodeInterface {

    private $base;

    function __construct() {
        $this->base = 'qodef_process_holder';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
                'name' => 'Process Holder',
                'base' => $this->base,
                'icon' => 'icon-wpb-process-holder extended-custom-icon',
                'category' => 'by SELECT',
                'as_parent' => array('only' => 'qodef_process_item'),
                'js_view' => 'VcColumnView',
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'class' => '',
                        'heading' => 'Columns',
                        'admin_label' => true,
                        'param_name' => 'number_of_columns',
                        'value' => array(
                            'Three'      => 'columns-3',
                            'Four'       => 'columns-4',
                            'Five'       => 'columns-5'
                        ),
                        'description' => '',
                        'save_always' => true
                    )
                )
            )
        );
    }

    public function render($atts, $content = null) {

        $args = array(
            'number_of_columns' =>  ''
        );

        $params = shortcode_atts($args, $atts);
        extract($params);

        $process_holder_class = array();
        $process_holder_class[] = 'qodef-process-holder';
        $process_holder_class[] = $params['number_of_columns'];

        $html = '';

        $html .= '<div  ' . qode_startit_get_class_attribute($process_holder_class) . '>';
        $html .= '<div class="qodef-process-holder-inner">';
            $html .= do_shortcode($content);
        $html.= '</div>';
        $html.= '</div>';

        return $html;
    }
}