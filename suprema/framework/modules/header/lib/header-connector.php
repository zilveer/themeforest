<?php
namespace SupremaQodef\Modules\Header\Lib;
/**
 * Class QodeHeaderConnector
 *
 * Connects header module with other modules
 */
class HeaderConnector {
    /**
     * @param HeaderType $object
     */
    public function __construct(HeaderType $object) {
        $this->object = $object;
    }

    /**
     * Connects given object with other modules based on pased config
     *
     * @param array $config
     */
    public function connect($config = array()) {
        do_action('suprema_qodef_pre_header_connect');

        $defaultConfig = array(
            'affect_content' => true,
            'affect_title'   => true,
            'affect_slider'  => true
        );

        if(is_array($config) && count($config)) {
            $config = array_merge($defaultConfig, $config);
        }

        if(!empty($config['affect_content'])) {
            add_filter('suprema_qodef_content_elem_style_attr', array($this, 'contentMarginFilter'));
        }

        if(!empty($config['affect_title'])) {
            add_filter('suprema_qodef_title_content_padding', array($this, 'titlePaddingFilter'));
        }

        if(!empty($config['affect_slider'])) {

            add_filter('suprema_qodef_slider_item_padding', array($this, 'sliderItemPaddingFilter'));
            add_filter('suprema_qodef_slider_navigation_padding', array($this, 'sliderNavigationPaddingFilter'));
        }

        do_action('suprema_qodef_after_header_connect');
    }

    /**
     * Adds margin-top property to content element based on height of transparent parts of header
     *
     * @param $styles
     *
     * @return array
     */
    public function contentMarginFilter($styles) {
        $marginTopValue = $this->object->getHeightOfTransparency();

        if(!empty($marginTopValue)) {
            $styles[] = 'margin-top: -'.$marginTopValue.'px';
        }

        return $styles;
    }

    /**
     * Returns padding value calculated from transparent header parts.
     *
     * Hooks to suprema_qodef_title_content_padding filter
     *
     * @return int
     */
    public function titlePaddingFilter() {
        $heightOfTransparency = $this->object->getHeightOfTransparency();

        return !empty($heightOfTransparency) ? $heightOfTransparency : '';
    }

    /**
     * Returns padding value calculated from header height.
     *
     * Hooks to suprema_qodef_slider_item_padding filter
     *
     * @return int
     */
    public function sliderItemPaddingFilter() {
        $headerHeight = $this->object->calculateHeaderHeight();

        return !empty($headerHeight) ? $headerHeight : '';
    }

    /**
     * Returns padding value calculated from header height.
     *
     * Hooks to suprema_qodef_slider_item_padding filter
     *
     * @return int
     */
    public function sliderNavigationPaddingFilter() {
        $navigationPadding = $this->object->getHeaderHeight() - $this->object->getHeightOfCompleteTransparency();

        return !empty($navigationPadding) ? $navigationPadding : '';
    }
}