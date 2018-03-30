<?php
namespace Flow\Modules\Header\Types;

use Flow\Modules\Header\Lib\HeaderType;

class HeaderType2 extends HeaderType {
    protected $heightOfTransparency;
    protected $heightOfCompleteTransparency;
    protected $headerHeight;

    public function __construct() {
        $this->slug = 'header-type2';

        if(!is_admin()) {
            $logoAreaHeight       = flow_elated_filter_px(flow_elated_options()->getOptionValue('logo_area_height_header_type2'));
            $this->logoAreaHeight = $logoAreaHeight !== '' ? (int) flow_elated_filter_px($logoAreaHeight) : 200;

            $menuAreaHeight       = flow_elated_filter_px(flow_elated_options()->getOptionValue('menu_area_height_header_type2'));
            $this->menuAreaHeight = $menuAreaHeight !== '' ? (int) $menuAreaHeight : 50;

            add_action('wp', array($this, 'setHeaderHeightProps'));

            add_filter('flow_elated_js_global_variables', array($this, 'getGlobalJSVariables'));
            add_filter('flow_elated_per_page_js_vars', array($this, 'getPerPageJSVariables'));
        }
    }

    /**
     * Loads template for header type
     *
     * @param array $parameters associative array of variables to pass to template
     */
    public function loadTemplate($parameters = array()) {

        $parameters['logo_area_in_grid'] = flow_elated_options()->getOptionValue('logo_area_in_grid_header_type2') == 'yes' ? true : false;
        $parameters['menu_area_in_grid'] = flow_elated_options()->getOptionValue('menu_area_in_grid_header_type2') == 'yes' ? true : false;

        $parameters = apply_filters('flow_elated_header_type2_parameters', $parameters);

        flow_elated_get_module_template_part('templates/types/'.$this->slug, $this->moduleName, '', $parameters);
    }

    /**
     * Sets header height properties after WP object is set up
     */
    public function setHeaderHeightProps(){
        $this->heightOfTransparency         = $this->calculateHeightOfTransparency();
        $this->heightOfCompleteTransparency = $this->calculateHeightOfCompleteTransparency();
        $this->headerHeight                 = $this->calculateHeaderHeight();
    }

    /**
     * Returns total height of transparent parts of header
     *
     * @return mixed
     */
    public function calculateHeightOfTransparency() {

        $transparencyHeight = 0;

        if(flow_elated_options()->getOptionValue('logo_area_background_color_header_type2') == '') {
            $logoAreaTransparent = flow_elated_options()->getOptionValue('logo_area_grid_background_color_header_type2') !== '' && flow_elated_options()->getOptionValue('logo_area_grid_background_transparency_header_type2') !== '1';
        } else {
            $logoAreaTransparent = flow_elated_options()->getOptionValue('logo_area_background_color_header_type2') !== '' && flow_elated_options()->getOptionValue('logo_area_background_transparency_header_type2') !== '1';
        }

        $menuAreaTransparent = flow_elated_options()->getOptionValue('menu_area_background_color_header_type2') !== '' && flow_elated_options()->getOptionValue('menu_area_background_transparency_header_type2') !== '1';

        if($logoAreaTransparent || $menuAreaTransparent) {

            if($logoAreaTransparent) {
                $transparencyHeight += $this->logoAreaHeight;

                if($menuAreaTransparent) {
                    $transparencyHeight += $this->menuAreaHeight;

                    if(flow_elated_is_top_bar_enabled() && flow_elated_is_top_bar_transparent()) {
                        $transparencyHeight += flow_elated_get_top_bar_height();
                    }
                }
            }
        }

        return $transparencyHeight;
    }

    public function calculateHeightOfCompleteTransparency() {
        $transparencyHeight = 0;

        if(flow_elated_options()->getOptionValue('logo_area_background_color_header_type2') == '') {
            $logoAreaTransparent = flow_elated_options()->getOptionValue('logo_area_grid_background_color_header_type2') !== '' &&
                                   flow_elated_options()->getOptionValue('logo_area_grid_background_transparency_header_type2') === '0';
        } else {
            $logoAreaTransparent = flow_elated_options()->getOptionValue('logo_area_background_color_header_type2') !== '' &&
                                   flow_elated_options()->getOptionValue('logo_area_background_transparency_header_type2') === '0';
        }

        $menuAreaTransparent = flow_elated_options()->getOptionValue('menu_area_background_color_header_type2') !== '' &&
                               flow_elated_options()->getOptionValue('menu_area_background_transparency_header_type2') === '0';

        if($logoAreaTransparent || $menuAreaTransparent) {

            if($logoAreaTransparent) {
                $transparencyHeight += $this->logoAreaHeight;

                if($menuAreaTransparent) {
                    $transparencyHeight += $this->menuAreaHeight;

                    if(flow_elated_is_top_bar_enabled() && flow_elated_is_top_bar_completely_transparent()) {
                        $transparencyHeight += flow_elated_get_top_bar_height();
                    }
                }
            }
        }

        return $transparencyHeight;
    }

    public function calculateHeaderHeight() {
        $headerHeight = $this->logoAreaHeight + $this->menuAreaHeight;
        if(flow_elated_is_top_bar_enabled()) {
            $headerHeight += flow_elated_get_top_bar_height();
        }

        return $headerHeight;
    }

    /**
     * Returns global js variables of header
     *
     * @param $globalVariables
     * @return int|string
     */
    public function getGlobalJSVariables($globalVariables) {
        $globalVariables['eltdLogoAreaHeight'] = 0;
        $globalVariables['eltdMenuAreaHeight'] = $this->headerHeight;

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
        if(!in_array(flow_elated_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up','sticky-header-on-scroll-down-up'))) {
            $perPageVars['eltdHeaderTransparencyHeight'] = $this->headerHeight - (flow_elated_get_top_bar_height() + $this->heightOfCompleteTransparency);
        }else{
            $perPageVars['eltdHeaderTransparencyHeight'] = 0;
        }

        return $perPageVars;
    }
}