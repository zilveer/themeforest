<?php
namespace Hue\Modules\Shortcodes\WorkingHours;

use Hue\Modules\Shortcodes\Lib\ShortcodeInterface;

class WorkingHours implements ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_working_hours';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Mikado Working Hours', 'hue'),
            'base'                      => $this->base,
            'category'                  => 'by MIKADO',
            'icon'                      => 'icon-wpb-working-hours extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Title', 'hue'),
                    'param_name'  => 'title',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Text', 'hue'),
                    'param_name'  => 'text',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Working Hours Style', 'hue'),
                    'param_name'  => 'style',
                    'admin_label' => true,
                    'value'       => array(
                        esc_html__('Dark', 'hue')  => 'dark',
                        esc_html__('Light', 'hue') => 'light'
                    ),
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Use Shortened Version?', 'hue'),
                    'param_name'  => 'use_shortened_version',
                    'admin_label' => true,
                    'value'       => array(
                        esc_html__('Yes', 'hue') => 'yes',
                        esc_html__('No', 'hue')  => 'no'
                    ),
                    'save_always' => true
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Monday To Friday', 'hue'),
                    'param_name'  => 'monday_to_friday',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true,
                    'group'       => esc_html__('Settings', 'hue'),
                    'dependency'  => array('element' => 'use_shortened_version', 'value' => 'yes')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Saturday', 'hue'),
                    'param_name'  => 'saturday_short',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true,
                    'group'       => esc_html__('Settings', 'hue'),
                    'dependency'  => array('element' => 'use_shortened_version', 'value' => 'yes')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Sunday', 'hue'),
                    'param_name'  => 'sunday_short',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true,
                    'group'       => esc_html__('Settings', 'hue'),
                    'dependency'  => array('element' => 'use_shortened_version', 'value' => 'yes')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Monday', 'hue'),
                    'param_name'  => 'monday',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true,
                    'group'       => esc_html__('Settings', 'hue'),
                    'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Tuesday', 'hue'),
                    'param_name'  => 'tuesday',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true,
                    'group'       => esc_html__('Settings', 'hue'),
                    'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Wednesday', 'hue'),
                    'param_name'  => 'wednesday',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true,
                    'group'       => esc_html__('Settings', 'hue'),
                    'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Thursday', 'hue'),
                    'param_name'  => 'thursday',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true,
                    'group'       => esc_html__('Settings', 'hue'),
                    'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Friday', 'hue'),
                    'param_name'  => 'friday',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true,
                    'group'       => esc_html__('Settings', 'hue'),
                    'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Saturday', 'hue'),
                    'param_name'  => 'saturday',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true,
                    'group'       => esc_html__('Settings', 'hue'),
                    'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Sunday', 'hue'),
                    'param_name'  => 'sunday',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true,
                    'group'       => esc_html__('Settings', 'hue'),
                    'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'title'                 => '',
            'text'                  => '',
            'style'                 => '',
            'use_shortened_version' => '',
            'monday_to_friday'      => '',
            'saturday_short'        => '',
            'sunday_short'          => '',
            'monday'                => '',
            'tuesday'               => '',
            'wednesday'             => '',
            'thursday'              => '',
            'friday'                => '',
            'saturday'              => '',
            'sunday'                => ''
        );

        $params = shortcode_atts($default_atts, $atts);

        $params['working_hours']  = $this->getWorkingHours($params);
        $params['holder_classes'] = $this->getHolderClasses($params);

        return hue_mikado_get_shortcode_module_template_part('templates/working-hours-template', 'working-hours', '', $params);
    }

    private function getWorkingHours($params) {
        $workingHours = array();

        if(!empty($params['use_shortened_version']) && $params['use_shortened_version'] === 'yes') {
            if(!empty($params['monday_to_friday'])) {
                $workingHours[] = array(
                    'label' => esc_html__('Monday > Friday:', 'hue'),
                    'time'  => $params['monday_to_friday']
                );
            }

            if(!empty($params['saturday_short'])) {
                $workingHours[] = array(
                    'label' => esc_html__('Saturday:', 'hue'),
                    'time'  => $params['saturday_short']
                );
            }
            if(!empty($params['sunday_short'])) {
                $workingHours[] = array(
                    'label' => esc_html__('Sunday:', 'hue'),
                    'time'  => $params['sunday_short']
                );
            }
        } else {
            if(!empty($params['monday'])) {
                $workingHours[] = array(
                    'label' => esc_html__('Monday:', 'hue'),
                    'time'  => $params['monday']
                );
            }

            if(!empty($params['tuesday'])) {
                $workingHours[] = array(
                    'label' => esc_html__('Tuesday:', 'hue'),
                    'time'  => $params['tuesday']
                );
            }

            if(!empty($params['wednesday'])) {
                $workingHours[] = array(
                    'label' => esc_html__('Wednesday:', 'hue'),
                    'time'  => $params['wednesday']
                );
            }

            if(!empty($params['thursday'])) {
                $workingHours[] = array(
                    'label' => esc_html__('Thursday:', 'hue'),
                    'time'  => $params['thursday']
                );
            }

            if(!empty($params['friday'])) {
                $workingHours[] = array(
                    'label' => esc_html__('Friday:', 'hue'),
                    'time'  => $params['friday']
                );
            }

            if(!empty($params['saturday'])) {
                $workingHours[] = array(
                    'label' => esc_html__('Saturday:', 'hue'),
                    'time'  => $params['saturday']
                );
            }

            if(!empty($params['sunday'])) {
                $workingHours[] = array(
                    'label' => esc_html__('Sunday:', 'hue'),
                    'time'  => $params['sunday']
                );
            }
        }

        return $workingHours;
    }

    private function getHolderClasses($params) {
        $classes = array(
            'mkd-working-hours-holder',
            'mkd-working-hours-'.$params['style']
        );

        return $classes;
    }

}
