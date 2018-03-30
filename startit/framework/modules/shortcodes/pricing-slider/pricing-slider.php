<?php
namespace QodeStartit\Modules\PricingSlider;

use QodeStartit\Modules\Shortcodes\Lib\ShortcodeInterface;


/**
 * Class PricingInfo that represents pricing info shortcode
 * @package QodeStartit\Modules\Shortcodes\PricingInfo
 */
class PricingSlider implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    /**
     * Sets base attribute and registers shortcode with Visual Composer
     */
    public function __construct() {
        $this->base = 'qodef_pricing_slider';

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
            'name'                      => esc_html__('Select Pricing Slider', 'startit'),
            'base'                      => $this->base,
            'category'                  => 'by SELECT',
            'icon'                      => 'icon-wpb-pricing-slider extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Unit name',
                    'param_name' => 'unit_name',
                    'description' => 'Enter singular name of unit you will charge for (ex. unit)'
                ),
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Units range',
                    'param_name' => 'units_range',
                    'description' => 'Enter maximum number of units you will charge (ex. 1000)'
                ),
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Units breakpoints',
                    'param_name' => 'units_breakpoints',
                    'description' => 'Enter breakpoint value where price per unit will be reduced (ex. 100)'
                ),
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Price Per Unit',
                    'param_name' => 'price_per_unit',
                    'description' => 'Enter value of price that will be charged per unit (ex. 5)'
                ),
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Price Reduce Per Breakpoint',
                    'param_name' => 'price_reduce_per_breakpoint',
                    'description' => 'Enter value for which price will be reduced on each breakpoint (ex. 0.2)'
                ),
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Price Period Button Label',
                    'param_name' => 'price_period',
                    'description' => 'Enter pricing period you will be charging by (ex. Monthly Pricing)'
                ),
                array(
                    'type' => 'dropdown',
                    'admin_label' => true,
                    'heading' => 'Enable Extra Period',
                    'param_name' => 'extra_period',
                    'value' => array(
                        'Default' => '',
                        'Yes' => 'yes',
                        'No' => 'no'
                    ),
                    'description' => 'Enable this option if you need extra pricing period (ex. Yearly)'
                ),
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Price Per Unit',
                    'param_name' => 'price_per_unit_extra',
                    'description' => 'Enter value of price that will be charged per unit (ex. 5)',
                    'group' => 'Extra Period',
                    'dependency' => array('element' => 'extra_period', 'value' => 'yes')

                ),
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Price Reduce Per Breakpoint',
                    'param_name' => 'price_reduce_per_breakpoint_extra',
                    'description' => 'Enter value for which price will be reduced on each breakpoint (ex. 0.2)',
                    'group' => 'Extra Period',
                    'dependency' => array('element' => 'extra_period', 'value' => 'yes')
                ),
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Price Period Button Label',
                    'param_name' => 'price_period_extra',
                    'description' => 'Enter pricing period you will be charging by (ex. Yearly Pricing)',
                    'group' => 'Extra Period',
                    'dependency' => array('element' => 'extra_period', 'value' => 'yes')
                ),
                array(
                    'type' => 'dropdown',
                    'admin_label' => true,
                    'heading' => 'Initially Active',
                    'param_name' => 'extra_initially_active',
                    'value' => array(
                        'Default' => '',
                        'No' => 'no',
                        'Yes' => 'yes'
                    ),
                    'description' => 'Set extra period to be initially active state',
                    'group' => 'Extra Period',
                    'dependency' => array('element' => 'extra_period', 'value' => 'yes')
                ),
                /* Pricing info parameters */
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Title',
                    'param_name' => 'title',
                    'value' => 'Pay what you need',
                    'description' => '',
                    'group' => 'Pricing Info'
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
                    'description' => '',
                    'group' => 'Pricing Info'
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => 'Description',
                    'param_name' => 'description',
                    'group' => 'Pricing Info'
                ),
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Currency',
                    'param_name' => 'currency',
                    'description' => 'Default mark is $',
                    'group' => 'Pricing Info'
                ),
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Price Period',
                    'param_name' => 'price_period_info',
                    'description' => 'Default label is monthly',
                    'group' => 'Pricing Info'
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
                    'description' => '',
                    'group' => 'Pricing Info'
                ),
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Button Text',
                    'param_name' => 'button_text',
                    'dependency' => array('element' => 'show_button',  'value' => 'yes'),
                    'group' => 'Pricing Info'
                ),
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Button Link',
                    'param_name' => 'link',
                    'dependency' => array('element' => 'show_button',  'value' => 'yes'),
                    'group' => 'Pricing Info'
                ),
                array(
                    'type' => 'colorpicker',
                    'admin_label' => true,
                    'heading' => 'Button Text Color',
                    'param_name' => 'button_text_color',
                    'group' => 'Design Options'
                ),
                array(
                    'type' => 'colorpicker',
                    'admin_label' => true,
                    'heading' => 'Unit Text Color',
                    'param_name' => 'unit_text_color',
                    'group' => 'Design Options'
                )
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
            'unit_name'         		        => 'unit',
            'units_range'         		        => '0',
            'units_breakpoints'      	        => '0',
            'price_per_unit'      	            => '0',
            'price_reduce_per_breakpoint'       => '0',
            'price_period'                      => 'Monthly',
            'extra_period'                      => 'no',
            'price_per_unit_extra'              => '0',
            'price_reduce_per_breakpoint_extra' => '0',
            'price_period_extra'                => 'Yearly',
            'extra_initially_active'            => 'no',
            'title'         			        => 'Pay what you need',
            'description'      			        => '',
            'title_tag'                         => 'h5',
            'currency'      			        => '$',
            'price_period_info'			        => 'Monthly',
            'show_button'				        => 'no',
            'link'          			        => '',
            'button_text'   			        => 'button',
            'button_text_color'   			    => '',
            'unit_text_color'   			    => ''
        );

        $params = shortcode_atts($default_atts, $atts);
        //Extract params for use in method
        extract($params);

        $params['button_value'] = $this->getButtonData($params);
        $params['button_value_extra'] = $this->getButtonDataExtra($params);
        $params['pricing_info_params'] = $this->getPricingInfoParams($params);
        $params['slider_data'] = $this->getSliderData($params);
        $params['unit_text_style'] = $this->getStyleForUnitText($params);

        $html = qode_startit_get_shortcode_module_template_part('templates/pricing-slider', 'pricing-slider', '', $params);

        return $html;
    }

    /**
     * Return data attributes for button
     *
     * @param $params
     * @return array
     */
    private function getButtonData($params) {

        $buttonData = array();

        if( $params['price_per_unit'] !== '' ) {
            $buttonData['data-price-per-unit'] = $params['price_per_unit'];
        }

        if( $params['price_reduce_per_breakpoint'] !== '' ) {
            $buttonData['data-price-reduce-per-breakpoint'] = $params['price_reduce_per_breakpoint'];
        }


        return $buttonData;

    }

    /**
     * Return data attributes for button
     *
     * @param $params
     * @return array
     */
    private function getButtonDataExtra($params) {

        $buttonData = array();

        if( $params['price_per_unit_extra'] !== '' ) {
            $buttonData['data-price-per-unit'] = $params['price_per_unit_extra'];
        }

        if( $params['units_breakpoints'] !== '' ) {
            $buttonData['data-price-reduce-per-breakpoint'] = $params['price_reduce_per_breakpoint_extra'];
        }


        return $buttonData;

    }

    /**
     * Return data attributes for slider
     *
     * @param $params
     * @return array
     */
    private function getSliderData($params) {

        $sliderData = array();

        if( $params['units_range'] !== '' ) {
            $sliderData['data-units-range'] = $params['units_range'];
        }

        if( $params['units_breakpoints'] !== '' ) {
            $sliderData['data-units-breakpoints'] = $params['units_breakpoints'];
        }

        if( $params['unit_name'] !== '' ) {
            $sliderData['data-unit-name'] = $params['unit_name'];
        }


        return $sliderData;

    }

    /**
     * Return data attributes for button
     *
     * @param $params
     * @return string
     */
    private function getPricingInfoParams($params) {

        $shortcodeParams = '';
        //$price = $params['extra_initially_active'] === 'yes' ? $params['price_per_unit_extra'] : $params['price_per_unit'];
        //$price_period = $params['extra_initially_active'] === 'yes' ? $params['price_period_extra'] : $params['price_period'];

        $shortcodeParams .= ' show_button="' .$params["show_button"] .'" ';
        $shortcodeParams .= ' description="' .$params["description"] .'" ';
        $shortcodeParams .= ' title_tag="' .$params["title_tag"] .'" ';
        $shortcodeParams .= ' title="' .$params["title"] .'" ';
        $shortcodeParams .= ' currency="' .$params["currency"] .'" ';
        $shortcodeParams .= ' price="0"';
        $shortcodeParams .= ' price_period="' . $params['price_period_info'] .'" ';
        $shortcodeParams .= ' button_text="' .$params["button_text"] .'" ';
        $shortcodeParams .= ' link="' .$params["link"] .'" ';

        return $shortcodeParams;
    }

    /**
     * Return string with styles for unit text
     *
     * @param $params
     * @return string
     */
    private function getStyleForUnitText($params) {
        $unitStyle = array();

        if($params['unit_text_color'] !== '') {
            $unitStyle[] = "color: " . $params['unit_text_color'];
        }

        return implode(';', $unitStyle);
    }
}