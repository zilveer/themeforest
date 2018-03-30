<?php
namespace Hue\Modules\Header\Types;

use Hue\Modules\Header\Lib\HeaderType;

/**
 * Class that represents Header Standard layout and option
 *
 * Class HeaderStandard
 */
class HeaderStandard extends HeaderType {
	protected $heightOfTransparency;
	protected $heightOfCompleteTransparency;
	protected $headerHeight;
	protected $mobileHeaderHeight;

	/**
	 * Sets slug property which is the same as value of option in DB
	 */
	public function __construct() {
		$this->slug = 'header-standard';

		if(!is_admin()) {

			$menuAreaHeight       = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('menu_area_height_header_standard'));
			$this->menuAreaHeight = $menuAreaHeight !== '' ? $menuAreaHeight : 92;

			$mobileHeaderHeight       = hue_mikado_filter_px(hue_mikado_options()->getOptionValue('mobile_header_height'));
			$this->mobileHeaderHeight = $mobileHeaderHeight !== '' ? $mobileHeaderHeight : 100;

			add_action('wp', array($this, 'setHeaderHeightProps'));

			add_filter('hue_mikado_js_global_variables', array($this, 'getGlobalJSVariables'));
			add_filter('hue_mikado_per_page_js_vars', array($this, 'getPerPageJSVariables'));
			add_filter('hue_mikado_add_page_custom_style', array($this, 'headerPerPageStyles'));
		}
	}

	public function headerPerPageStyles($style) {
		$id                     = hue_mikado_get_page_id();
		$class_prefix           = hue_mikado_get_unique_page_class();
		$main_menu_style        = array();
		$main_menu_grid_style   = array();
        $disable_border = hue_mikado_get_meta_field_intersect('menu_area_border_header_standard',$id) == 'no';
        $disable_grid_border = hue_mikado_get_meta_field_intersect('menu_area_in_grid_border_header_standard',$id) == 'no';

		$main_menu_selector = array($class_prefix.'.mkd-header-standard .mkd-menu-area');
		$main_menu_grid_selector = array($class_prefix.'.mkd-header-standard .mkd-page-header .mkd-menu-area .mkd-grid .mkd-vertical-align-containers');

        /* header style - start */
		if(!$disable_border) {
			$header_border_color = get_post_meta($id, 'mkd_menu_area_border_color_header_standard_meta', true);

			if($header_border_color !== '') {
				$main_menu_style['border-color'] = $header_border_color;
			}
		}

		$menu_area_background_color        = get_post_meta($id, 'mkd_menu_area_background_color_header_standard_meta', true);
		$menu_area_background_transparency = get_post_meta($id, 'mkd_menu_area_background_transparency_header_standard_meta', true);

		if($menu_area_background_transparency === '') {
			$menu_area_background_transparency = 1;
		}

		$menu_area_background_color_rgba = hue_mikado_rgba_color($menu_area_background_color, $menu_area_background_transparency);

		if($menu_area_background_color_rgba !== null) {
			$main_menu_style['background-color'] = $menu_area_background_color_rgba;
		}
        /* header style - end */

        /* header in grid style - start */

        if(!$disable_grid_border) {
            $header_grid_border_color = get_post_meta($id, 'mkd_menu_area_in_grid_border_color_header_standard_meta', true);

            if($header_grid_border_color !== '') {
                $main_menu_grid_style['border-bottom'] = '1px solid '.$header_grid_border_color;
            }
        }

        $menu_area_grid_background_color        = get_post_meta($id, 'mkd_menu_area_grid_background_color_header_standard_meta', true);
        $menu_area_grid_background_transparency = get_post_meta($id, 'mkd_menu_area_grid_background_transparency_header_standard_meta', true);

        if($menu_area_grid_background_transparency === '') {
            $menu_area_grid_background_transparency = 1;
        }

        $menu_area_grid_background_color_rgba = hue_mikado_rgba_color($menu_area_grid_background_color, $menu_area_grid_background_transparency);

        if($menu_area_grid_background_color_rgba !== null) {
            $main_menu_grid_style['background-color'] = $menu_area_grid_background_color_rgba;
        }

        /* header in grid style - end */

		$style[] = hue_mikado_dynamic_css($main_menu_selector, $main_menu_style);
		$style[] = hue_mikado_dynamic_css($main_menu_grid_selector, $main_menu_grid_style);

		return $style;
	}

	/**
	 * Loads template file for this header type
	 *
	 * @param array $parameters associative array of variables that needs to passed to template
	 */
	public function loadTemplate($parameters = array()) {
        $id  = hue_mikado_get_page_id();

		$parameters['menu_area_in_grid'] = hue_mikado_get_meta_field_intersect('menu_area_in_grid_header_standard',$id) == 'yes' ? true : false;

		$parameters = apply_filters('hue_mikado_header_standard_parameters', $parameters);

		hue_mikado_get_module_template_part('templates/types/'.$this->slug, $this->moduleName, '', $parameters);
	}

	/**
	 * Sets header height properties after WP object is set up
	 */
	public function setHeaderHeightProps() {
		$this->heightOfTransparency         = $this->calculateHeightOfTransparency();
		$this->heightOfCompleteTransparency = $this->calculateHeightOfCompleteTransparency();
		$this->headerHeight                 = $this->calculateHeaderHeight();
		$this->mobileHeaderHeight           = $this->calculateMobileHeaderHeight();
	}

	/**
	 * Returns total height of transparent parts of header
	 *
	 * @return int
	 */
	public function calculateHeightOfTransparency() {
		$id                 = hue_mikado_get_page_id();
		$transparencyHeight = 0;

		if(get_post_meta($id, 'mkd_menu_area_background_color_header_standard_meta', true) !== '') {
			$menuAreaTransparent = get_post_meta($id, 'mkd_menu_area_background_color_header_standard_meta', true) !== '' &&
			                       get_post_meta($id, 'mkd_menu_area_background_transparency_header_standard_meta', true) !== '1';
		} elseif(hue_mikado_options()->getOptionValue('menu_area_background_color_header_standard') == '') {
			$menuAreaTransparent = hue_mikado_options()->getOptionValue('menu_area_grid_background_color_header_standard') !== '' &&
			                       hue_mikado_options()->getOptionValue('menu_area_grid_background_transparency_header_standard') !== '1';
		} else {
			$menuAreaTransparent = hue_mikado_options()->getOptionValue('menu_area_background_color_header_standard') !== '' &&
			                       hue_mikado_options()->getOptionValue('menu_area_background_transparency_header_standard') !== '1';
		}


		$sliderExists        = get_post_meta($id, 'mkd_page_slider_meta', true) !== '';
		$contentBehindHeader = get_post_meta($id, 'mkd_page_content_behind_header_meta', true) === 'yes';

		if($sliderExists || $contentBehindHeader) {
			$menuAreaTransparent = true;
		}

		if($menuAreaTransparent) {
			$transparencyHeight = $this->menuAreaHeight;

			if(($sliderExists && hue_mikado_is_top_bar_enabled())
			   || hue_mikado_is_top_bar_enabled() && hue_mikado_is_top_bar_transparent()
			) {
				$transparencyHeight += hue_mikado_get_top_bar_height();
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
		$id                 = hue_mikado_get_page_id();
		$transparencyHeight = 0;

		if(get_post_meta($id, 'mkd_menu_area_background_color_header_standard_meta', true) !== '') {
			$menuAreaTransparent = get_post_meta($id, 'mkd_menu_area_background_color_header_standard_meta', true) !== '' &&
			                       get_post_meta($id, 'mkd_menu_area_background_transparency_header_standard_meta', true) === '0';
		} elseif(hue_mikado_options()->getOptionValue('menu_area_background_color_header_standard') == '') {
			$menuAreaTransparent = hue_mikado_options()->getOptionValue('menu_area_grid_background_color_header_standard') !== '' &&
			                       hue_mikado_options()->getOptionValue('menu_area_grid_background_transparency_header_standard') === '0';
		} else {
			$menuAreaTransparent = hue_mikado_options()->getOptionValue('menu_area_background_color_header_standard') !== '' &&
			                       hue_mikado_options()->getOptionValue('menu_area_background_transparency_header_standard') === '0';
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
		if(hue_mikado_is_top_bar_enabled()) {
			$headerHeight += hue_mikado_get_top_bar_height();
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

	/**
	 * Returns global js variables of header
	 *
	 * @param $globalVariables
	 *
	 * @return int|string
	 */
	public function getGlobalJSVariables($globalVariables) {
		$globalVariables['mkdLogoAreaHeight']     = 0;
		$globalVariables['mkdMenuAreaHeight']     = $this->headerHeight;
		$globalVariables['mkdMobileHeaderHeight'] = $this->mobileHeaderHeight;

		return $globalVariables;
	}

	/**
	 * Returns per page js variables of header
	 *
	 * @param $perPageVars
	 *
	 * @return int|string
	 */
	public function getPerPageJSVariables($perPageVars) {
		//calculate transparency height only if header has no sticky behaviour
		if(!in_array(hue_mikado_get_meta_field_intersect('header_behaviour'), array(
			'sticky-header-on-scroll-up',
			'sticky-header-on-scroll-down-up'
		))
		) {
			$perPageVars['mkdHeaderTransparencyHeight'] = $this->headerHeight - (hue_mikado_get_top_bar_height() + $this->heightOfCompleteTransparency);
		} else {
			$perPageVars['mkdHeaderTransparencyHeight'] = 0;
		}

		return $perPageVars;
	}
}