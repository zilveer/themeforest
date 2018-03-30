<?php
namespace Libero\Modules\Header\Types;

use Libero\Modules\Header\Lib\HeaderType;

/**
 * Class that represents Header Standard layout and option
 *
 * Class HeaderStandard
 */
class HeaderStandard extends HeaderType {
    protected $heightOfTransparency;
    protected $heightOfCompleteTransparency;
    protected $headerHeight;

    /**
     * Sets slug property which is the same as value of option in DB
     */
    public function __construct() {
        $this->slug = 'header-standard';

        if(!is_admin()) {

            $logoAreaHeight       = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('top_menu_area_height_header_standard'));
            $this->logoAreaHeight = $logoAreaHeight !== '' ? libero_mikado_filter_px($logoAreaHeight) : 92;

            $menuAreaHeight       = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('menu_area_height_header_standard'));
            $this->menuAreaHeight = $menuAreaHeight !== '' ? $menuAreaHeight : 60;

            $stickyHeight       = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('sticky_header_height'));
            $this->stickyHeight = $stickyHeight !== '' ? $stickyHeight : 60;

            add_action('wp', array($this, 'setHeaderHeightProps'));

            add_filter('libero_mikado_js_global_variables', array($this, 'getGlobalJSVariables'));
            add_filter('libero_mikado_per_page_js_vars', array($this, 'getPerPageJSVariables'));

        }
    }

    /**
     * Loads template file for this header type
     *
     * @param array $parameters associative array of variables that needs to passed to template
     */
    public function loadTemplate($parameters = array()) {

        $parameters['top_menu_area_in_grid'] = libero_mikado_options()->getOptionValue('top_menu_area_in_grid_header_standard') == 'yes' ? true : false;
        $parameters['menu_area_in_grid'] = libero_mikado_options()->getOptionValue('menu_area_in_grid_header_standard') == 'yes' ? true : false;

        $parameters = apply_filters('libero_mikado_header_standard_parameters', $parameters);

        libero_mikado_get_module_template_part('templates/types/'.$this->slug, $this->moduleName, '', $parameters);
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
     * @return int
     */
    public function calculateHeightOfTransparency() {
        $id = libero_mikado_get_page_id();
        $transparencyHeight = 0;
        $logoAreaTransparent = false;
        $menuAreaTransparent = false;

//        if(get_post_meta($id, 'mkd_top_menu_area_background_color_header_standard_meta', true) !== ''){
//            $logoAreaTransparent = get_post_meta($id, 'mkd_top_menu_area_background_color_header_standard_meta', true) !== '' &&
//                                   get_post_meta($id, 'mkd_top_menu_area_background_transparency_header_standard_meta', true) !== '1';
//        } else {
//            $logoAreaTransparent = libero_mikado_options()->getOptionValue('top_menu_area_background_color_header_standard') !== '' &&
//                                   libero_mikado_options()->getOptionValue('top_menu_area_background_transparency_header_standard') !== '1';
//
//        }
//
//        if(get_post_meta($id, 'mkd_menu_area_background_color_header_standard_meta', true) !== ''){
//            $menuAreaTransparent = get_post_meta($id, 'mkd_menu_area_background_color_header_standard_meta', true) !== '' &&
//                                   get_post_meta($id, 'mkd_menu_area_background_transparency_header_standard_meta', true) !== '1';
//        } else {
//            $menuAreaTransparent = libero_mikado_options()->getOptionValue('menu_area_background_color_header_standard') !== '' &&
//                                   libero_mikado_options()->getOptionValue('menu_area_background_transparency_header_standard') !== '1';
//
//        }


        if($logoAreaTransparent || $menuAreaTransparent) {
            if($logoAreaTransparent) {
                $transparencyHeight = $this->logoAreaHeight + $this->menuAreaHeight;
            }

            if(!$logoAreaTransparent && $menuAreaTransparent) {
                $transparencyHeight = $this->menuAreaHeight;
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
        $id = libero_mikado_get_page_id();
        $transparencyHeight = 0;
		$logoAreaTransparent = false;
        $menuAreaTransparent = false;

//        if(get_post_meta($id, 'mkd_top_menu_area_background_color_header_standard_meta', true) !== ''){
//            $logoAreaTransparent = get_post_meta($id, 'mkd_top_menu_area_background_color_header_standard_meta', true) !== '' &&
//                                   get_post_meta($id, 'mkd_top_menu_area_background_transparency_header_standard_meta', true) === '0';
//        } else {
//            $logoAreaTransparent = libero_mikado_options()->getOptionValue('top_menu_area_background_color_header_standard') !== '' &&
//                                   libero_mikado_options()->getOptionValue('top_menu_area_background_transparency_header_standard') === '0';
//        }
//		
//		if(get_post_meta($id, 'mkd_menu_area_background_color_header_standard_meta', true) !== ''){
//            $menuAreaTransparent = get_post_meta($id, 'mkd_menu_area_background_color_header_standard_meta', true) !== '' &&
//                                   get_post_meta($id, 'mkd_menu_area_background_transparency_header_standard_meta', true) === '0';
//        } else {
//            $menuAreaTransparent = libero_mikado_options()->getOptionValue('menu_area_background_color_header_standard') !== '' &&
//                                   libero_mikado_options()->getOptionValue('menu_area_background_transparency_header_standard') === '0';
//       }

        if($logoAreaTransparent || $menuAreaTransparent) {
            if($logoAreaTransparent) {
                $transparencyHeight = $this->logoAreaHeight + $this->menuAreaHeight;
            }

            if(!$logoAreaTransparent && $menuAreaTransparent) {
                $transparencyHeight = $this->menuAreaHeight;
            }
        }

        return $transparencyHeight;
    }


    /**
     * Returns total height of header
     *
     * @return int|string
     */
    public function calculateHeaderHeight() {
        $headerHeight = $this->logoAreaHeight + $this->menuAreaHeight;

        return $headerHeight;
    }

    /**
     * Returns global js variables of header
     *
     * @param $globalVariables
     * @return int|string
     */
    public function getGlobalJSVariables($globalVariables) {
        $globalVariables['mkdLogoAreaHeight'] = 0;
        $globalVariables['mkdMenuAreaHeight'] = $this->headerHeight;
        $globalVariables['mkdStickyHeight'] = $this->stickyHeight;

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
        if(!in_array(libero_mikado_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up','sticky-header-on-scroll-down-up'))) {
            $perPageVars['mkdHeaderTransparencyHeight'] = $this->headerHeight - $this->heightOfCompleteTransparency;
        }else{
            $perPageVars['mkdHeaderTransparencyHeight'] = 0;
        }

        return $perPageVars;
    }
}