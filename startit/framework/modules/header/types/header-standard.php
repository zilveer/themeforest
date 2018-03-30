<?php
namespace QodeStartit\Modules\Header\Types;

use QodeStartit\Modules\Header\Lib\HeaderType;

/**
 * Class that represents Header Standard layout and option
 *
 * Class HeaderStandard
 */
class HeaderStandard extends HeaderType {
    protected $heightOfTransparency;
    protected $heightOfCompleteTransparency;
    protected $headerHeight;
    protected $stickyHeight;
    protected $mobileHeaderHeight;

    /**
     * Sets slug property which is the same as value of option in DB
     */
    public function __construct() {
        $this->slug = 'header-standard';

        if(!is_admin()) {

            $menuAreaHeight       = qode_startit_filter_px(qode_startit_options()->getOptionValue('menu_area_height_header_standard'));
            $this->menuAreaHeight = $menuAreaHeight !== '' ? (float) $menuAreaHeight : 100;

            $stickyHeight       = qode_startit_filter_px(qode_startit_options()->getOptionValue('sticky_header_height'));
            $this->stickyHeight = $stickyHeight !== '' ? (float) $stickyHeight : 60;

            $mobileHeaderHeight       = qode_startit_filter_px(qode_startit_options()->getOptionValue('mobile_header_height'));
            $this->mobileHeaderHeight = $mobileHeaderHeight !== '' ? (float) $mobileHeaderHeight : 100;

            add_action('wp', array($this, 'setHeaderHeightProps'));

            add_filter('qode_startit_js_global_variables', array($this, 'getGlobalJSVariables'));
            add_filter('qode_startit_per_page_js_vars', array($this, 'getPerPageJSVariables'));

        }
    }

    /**
     * Loads template file for this header type
     *
     * @param array $parameters associative array of variables that needs to passed to template
     */
    public function loadTemplate($parameters = array()) {

        $parameters['menu_area_in_grid'] = qode_startit_get_meta_field_intersect('menu_area_in_grid_header_standard') == 'yes' ? true : false;

        $parameters = apply_filters('qode_startit_header_standard_parameters', $parameters);

        qode_startit_get_module_template_part('templates/types/'.$this->slug, $this->moduleName, '', $parameters);
    }

    /**
     * Sets header height properties after WP object is set up
     */
    public function setHeaderHeightProps(){
        $this->heightOfTransparency         = $this->calculateHeightOfTransparency();
        $this->heightOfCompleteTransparency = $this->calculateHeightOfCompleteTransparency();
        $this->headerHeight                 = $this->calculateHeaderHeight();
        $this->stickyHeight                 = $this->calculateStickyHeaderHeight();
        $this->mobileHeaderHeight           = $this->calculateMobileHeaderHeight();
    }

    /**
     * Returns total height of transparent parts of header
     *
     * @return int
     */
    public function calculateHeightOfTransparency() {
        $id = qode_startit_get_page_id();
        $transparencyHeight = 0;

        if(get_post_meta($id, 'qodef_menu_area_background_color_header_standard_meta', true) !== ''){
            $menuAreaTransparent = get_post_meta($id, 'qodef_menu_area_background_color_header_standard_meta', true) !== '' &&
                                   get_post_meta($id, 'qodef_menu_area_background_transparency_header_standard_meta', true) !== '';
        } elseif(qode_startit_options()->getOptionValue('menu_area_background_color_header_standard') == '') {
            $menuAreaTransparent = qode_startit_options()->getOptionValue('menu_area_grid_background_color_header_standard') !== '' &&
                                   qode_startit_options()->getOptionValue('menu_area_grid_background_transparency_header_standard') !== '';
        } else {
            $menuAreaTransparent = qode_startit_options()->getOptionValue('menu_area_background_color_header_standard') !== '' &&
                                   qode_startit_options()->getOptionValue('menu_area_background_transparency_header_standard') !== '';
        }

        $sliderExists = get_post_meta($id, 'qodef_page_slider_meta', true) !== '';

        if($sliderExists){
            $menuAreaTransparent = true;
        }

        if($menuAreaTransparent) {
            $transparencyHeight = $this->menuAreaHeight;
            if(($sliderExists && qode_startit_is_top_bar_enabled())
                || qode_startit_is_top_bar_enabled() &&qode_startit_is_top_bar_transparent()) {
                $transparencyHeight += qode_startit_get_top_bar_height();
            }
        }

        return $transparencyHeight;
    }

    /**
     * Returns height of completely transparent header parts
     *
     * @return int
     */
    public function calculateHeightOfCompleteTransparency() {
        $id = qode_startit_get_page_id();
        $transparencyHeight = 0;

        if(get_post_meta($id, 'menu_area_background_color_header_standard_meta', true) !== ''){
            $menuAreaTransparent = get_post_meta($id, 'menu_area_background_color_header_standard_meta', true) !== '' &&
                                   get_post_meta($id, 'menu_area_background_transparency_header_standard_meta', true) === '0';
        } elseif(qode_startit_options()->getOptionValue('menu_area_background_color_header_standard') == '') {
            $menuAreaTransparent = qode_startit_options()->getOptionValue('menu_area_grid_background_color_header_standard') !== '' &&
                                   qode_startit_options()->getOptionValue('menu_area_grid_background_transparency_header_standard') === '0';
        } else {
            $menuAreaTransparent = qode_startit_options()->getOptionValue('menu_area_background_color_header_standard') !== '' &&
                                   qode_startit_options()->getOptionValue('menu_area_background_transparency_header_standard') === '0';
        }

        if($menuAreaTransparent) {
            $transparencyHeight = $this->menuAreaHeight;
        }

        return $transparencyHeight;
    }


    /**
     * Returns total height of header
     *
     * @return int|string
     */
    public function calculateHeaderHeight() {
        $headerHeight = $this->menuAreaHeight;
        if(qode_startit_is_top_bar_enabled()) {
            $headerHeight += qode_startit_get_top_bar_height();
        }

        return $headerHeight;
    }


    /**
     * Returns total height of mobile header
     *
     * @return int|string
     */
    public function calculateMobileHeaderHeight() {
        $mobileHeaderHeight = $this->mobileHeaderHeight;

        return $mobileHeaderHeight;
    }

    public function calculateStickyHeaderHeight() {
        $stickyHeaderHeight = $this->stickyHeight;

        return $stickyHeaderHeight;
    }

    /**
     * Returns global js variables of header
     *
     * @param $globalVariables
     * @return int|string
     */
    public function getGlobalJSVariables($globalVariables) {
        $globalVariables['qodefLogoAreaHeight'] = 0;
        $globalVariables['qodefMenuAreaHeight'] = $this->headerHeight;
        $globalVariables['qodefStickyHeight'] = $this->stickyHeight;
        $globalVariables['qodefMobileHeaderHeight'] = $this->mobileHeaderHeight;

        return $globalVariables;
    }

    /**
     * Returns per page js variables of header
     *
     * @param $perPageVars
     * @return int|string
     */
    public function getPerPageJSVariables($perPageVars) {
        //calculate transparency height only if header has no sticky behaviour
        if(!in_array(qode_startit_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up','sticky-header-on-scroll-down-up'))) {
            $perPageVars['qodefHeaderTransparencyHeight'] = $this->headerHeight - (qode_startit_get_top_bar_height() + $this->heightOfCompleteTransparency);
        }else{
            $perPageVars['qodefHeaderTransparencyHeight'] = 0;
        }

        return $perPageVars;
    }
}