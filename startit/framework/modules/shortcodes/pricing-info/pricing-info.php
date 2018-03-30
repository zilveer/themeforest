<?php
namespace QodeStartit\Modules\PricingInfo;

use QodeStartit\Modules\Shortcodes\Lib\ShortcodeInterface;

class PricingInfo implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    /**
     * Sets base attribute and registers shortcode with Visual Composer
     */
    public function __construct() {
        $this->base = 'qodef_pricing_info';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base attribute
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     */
    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Select Pricing Info', 'startit'),
            'base'                      => $this->base,
            'category'                  => 'by SELECT',
            'icon'                      => 'icon-wpb-pricing-info extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Title',
                    'param_name' => 'title',
                    'value' => 'Basic',
                    'description' => ''
                ),
                array(
                    'type' => 'dropdown',
                    'admin_label' => true,
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
                    'type'       => 'textarea',
                    'heading'    => 'Description',
                    'param_name' => 'description'
                ),
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Price',
                    'param_name' => 'price',
                    'description' => 'Default value is 100'
                ),
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Currency',
                    'param_name' => 'currency',
                    'description' => 'Default mark is $'
                ),
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Price Period',
                    'param_name' => 'price_period',
                    'description' => 'Default label is monthly'
                ),
                array(
                    'type' => 'dropdown',
                    'admin_label' => true,
                    'heading' => 'Show Button',
                    'param_name' => 'show_button',
                    'value' => array(
                        'Default' => '',
                        'Yes' => 'yes',
                        'No' => 'no'
                    ),
                    'description' => ''
                ),
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Button Text',
                    'param_name' => 'button_text',
                    'dependency' => array('element' => 'show_button',  'value' => 'yes')
                ),
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Button Link',
                    'param_name' => 'link',
                    'dependency' => array('element' => 'show_button',  'value' => 'yes')
                ),
                array(
                    'type' => 'dropdown',
                    'admin_label' => true,
                    'heading' => 'Active',
                    'param_name' => 'active',
                    'value' => array(
                        'No' => 'no',
                        'Yes' => 'yes'
                    ),
                    'save_always' => true,
                    'description' => ''
                ),
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Active Text',
                    'param_name' => 'active_text',
                    'dependency' => array('element' => 'active',  'value' => 'yes')
                ),
            )
        ));
    }

    /**
     * Renders HTML for product list shortcode
     *
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $default_atts = array(
            'title'         			   => 'Basic',
            'description'      			   => '',
            'title_tag'                    => 'h5',
            'price'         			   => '100',
            'currency'      			   => '$',
            'price_period'  			   => 'Monthly',
            'active'        			   => 'no',
            'show_button'				   => 'no',
            'link'          			   => '',
            'button_text'   			   => 'button',
            'active_text'   			   => 'Best choice'
        );

        $params = shortcode_atts($default_atts, $atts);
        //Extract params for use in method
        extract($params);

        $pricing_info_clasess		= '';
        if($active == 'yes') {
            $pricing_info_clasess .= ' qodef-active';
        }

        $params['pricing_info_classes'] = $pricing_info_clasess;

        return qode_startit_get_shortcode_module_template_part('templates/pricing-info', 'pricing-info', '', $params);
    }
}