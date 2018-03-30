<?php
namespace Hashmag\Modules\Header\Types;

use Hashmag\Modules\Header\Lib\HeaderType;

/**
 * Class that represents Header Type 1 layout and option
 *
 * Class HeaderType3
 */
class HeaderType3 extends HeaderType
{

    protected $heightOfTransparency;
    protected $heightOfHeader;

    /**
     * Sets slug property which is the same as value of option in DB
     */
    public function __construct() {
        $this->slug = 'header-type3';

        if (!is_admin()) {
            $logoAreaHeight = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('logo_area_height_header_type3'));
            $this->logoAreaHeight = $logoAreaHeight !== '' ? hashmag_mikado_filter_px($logoAreaHeight) : 175;

            $menuAreaHeight = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('menu_area_height_header_type3'));
            $this->menuAreaHeight = $menuAreaHeight !== '' ? (int)$menuAreaHeight : 55;

            add_action('wp', array($this, 'setHeaderHeightProps'));

            add_filter('hashmag_mikado_js_global_variables', array($this, 'getGlobalJSVariables'));
            add_filter('hashmag_mikado_per_page_js_vars', array($this, 'getPerPageJSVariables'));
        }
    }

    /**
     * Sets header height properties after WP object is set up
     */
    public function setHeaderHeightProps() {
        $this->heightOfTransparency = $this->calculateHeightOfTransparency();
        $this->heightOfHeader = $this->calculateHeightOfNonTransparentHeader();
    }

    /**
     * Returns total height of transparent parts of header
     *
     * @return int
     */
    public function calculateHeightOfTransparency() {
        $id = hashmag_mikado_get_page_id();
        $transparencyHeight = 0;
        $headerTransparent = false;

        if (hashmag_mikado_get_meta_field_intersect('header_style', $id) == 'transparent') {
            $headerTransparent = true;
        }

        if ($headerTransparent) {
            $transparencyHeight = $this->logoAreaHeight + $this->menuAreaHeight + hashmag_mikado_get_top_bar_height();
        }

        return $transparencyHeight;
    }

    /**
     * Returns total height of header parts, needed in full screen post slider
     *
     * @return int
     */
    public function calculateHeightOfNonTransparentHeader() {
        $id = hashmag_mikado_get_page_id();
        $headerTransparent = false;

        if (hashmag_mikado_get_meta_field_intersect('header_style', $id) == 'transparent') {
            $headerTransparent = true;
        }

        if ($headerTransparent) {
            $transparencyHeight = 0;
        } else {
            $transparencyHeight = $this->logoAreaHeight + $this->menuAreaHeight + hashmag_mikado_get_top_bar_height();
        }

        return $transparencyHeight;
    }

    /**
     * Loads template file for this header type
     *
     * @param array $parameters associative array of variables that needs to passed to template
     */
    public function loadTemplate($parameters = array()) {

        $parameters = apply_filters('hashmag_mikado_header_type3_parameters', $parameters);

        $parameters['alignment'] = ($parameters['logo_position'] == 'left') ? 'mkdf-50-50' : 'mkdf-centered-logo';

        hashmag_mikado_get_module_template_part('templates/types/' . $this->slug, $this->moduleName, '', $parameters);
    }

    /**
     * Returns global js variables of header
     *
     * @param $globalVariables
     * @return int|string
     */
    public function getGlobalJSVariables($globalVariables) {
        $globalVariables['mkdfLogoAreaHeight'] = $this->logoAreaHeight;
        $globalVariables['mkdfMenuAreaHeight'] = $this->menuAreaHeight;

        return $globalVariables;
    }

    /**
     * Returns per page js variables of header
     *
     * @param $perPageVars
     * @return int|string
     */
    public function getPerPageJSVariables($perPageVars) {

        $perPageVars['mkdfHeaderTransparencyHeight'] = $this->heightOfTransparency;
        $perPageVars['mkdfHeaderHeight'] = $this->heightOfHeader;

        return $perPageVars;
    }
}