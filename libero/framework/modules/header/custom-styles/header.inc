<?php

if(!function_exists('libero_mikado_header_standard_menu_area_styles')) {
    /**
     * Generates styles for header standard menu
     */
    function libero_mikado_header_standard_area_styles() {
        global $libero_mikado_options;
        $top_menu_area_height = 92;
        $menu_area_height = 60;

        $top_menu_area_header_standard_styles = array();
        $menu_area_header_standard_styles = array();

        //header top area
        if($libero_mikado_options['top_menu_area_background_color_header_standard'] !== '') {
            $top_menu_area_background_color        = $libero_mikado_options['top_menu_area_background_color_header_standard'];
            $top_menu_area_background_transparency = 1;

//            if($libero_mikado_options['top_menu_area_background_transparency_header_standard'] !== '') {
//                $top_menu_area_background_transparency = $libero_mikado_options['top_menu_area_background_transparency_header_standard'];
//            }

            $top_menu_area_header_standard_styles['background-color'] = libero_mikado_rgba_color($top_menu_area_background_color, $top_menu_area_background_transparency);
        }

        if($libero_mikado_options['top_menu_area_height_header_standard'] !== '') {
            $top_menu_area_height = $libero_mikado_options['top_menu_area_height_header_standard'];
            $top_menu_area_header_standard_styles['height'] = libero_mikado_filter_px($libero_mikado_options['top_menu_area_height_header_standard']).'px';
        }
        echo libero_mikado_dynamic_css('.mkd-header-standard .mkd-page-header .mkd-logo-area', $top_menu_area_header_standard_styles);
		echo libero_mikado_dynamic_css(array(
			'.mkd-header-top-left-widget #lang_sel > ul > li',
			'.mkd-header-top-right-widget #lang_sel > ul > li'
			), array(
			'height' => libero_mikado_filter_px($top_menu_area_height).'px',
				'line-height' => (libero_mikado_filter_px($top_menu_area_height)-2).'px'
				));
		echo libero_mikado_dynamic_css('.mkd-side-menu .mkd-close-side-menu-holder', array('height' => libero_mikado_filter_px($top_menu_area_height).'px'));


        //header bottom area
        if($libero_mikado_options['menu_area_background_color_header_standard'] !== '') {
            $menu_area_background_color        = $libero_mikado_options['menu_area_background_color_header_standard'];
            $menu_area_background_transparency = 1;

//            if($libero_mikado_options['menu_area_background_transparency_header_standard'] !== '') {
//                $menu_area_background_transparency = $libero_mikado_options['menu_area_background_transparency_header_standard'];
//            }

            $menu_area_header_standard_styles['background-color'] = libero_mikado_rgba_color($menu_area_background_color, $menu_area_background_transparency);
        }

        if($libero_mikado_options['menu_area_height_header_standard'] !== '') {

            $menu_area_height = $libero_mikado_options['menu_area_height_header_standard'];
            $menu_area_header_standard_styles['height'] = libero_mikado_filter_px($libero_mikado_options['menu_area_height_header_standard']).'px';

            echo libero_mikado_dynamic_css('.mkd-menu-area .mkd-main-menu > ul > li > a:after', array('line-height' => libero_mikado_filter_px($libero_mikado_options['menu_area_height_header_standard']).'px'));

        }
        echo libero_mikado_dynamic_css('.mkd-header-standard .mkd-page-header .mkd-menu-area', $menu_area_header_standard_styles);

        //set heights for header and logo area
        $max_height = intval(libero_mikado_filter_px($top_menu_area_height) * 0.9).'px';

        echo libero_mikado_dynamic_css('.mkd-header-standard .mkd-page-header .mkd-logo-wrapper a', array('max-height' => $max_height));

        echo libero_mikado_dynamic_css(array(
        	'.mkd-search-cover',
        	'.mkd-search-slide-header-bottom',
        	'.mkd-search-slide-header-bottom.mkd-animated'
        	), array('left' => '-'.($top_menu_area_height + $menu_area_height).'px'));
        echo libero_mikado_dynamic_css(array(
        	'.mkd-search-cover',
        	'.mkd-search-slide-header-bottom',
        	'.mkd-search-slide-header-bottom.mkd-animated'
        	), array('width' => 'calc(100% + '.($top_menu_area_height + $menu_area_height).'px)'));

    }

    add_action('libero_mikado_style_dynamic', 'libero_mikado_header_standard_area_styles');
}

if(!function_exists('libero_mikado_sticky_header_styles')) {
    /**
     * Generates styles for sticky haeder
     */
    function libero_mikado_sticky_header_styles() {
        global $libero_mikado_options;

        if($libero_mikado_options['sticky_header_background_color'] !== '') {

            $sticky_header_background_color              = $libero_mikado_options['sticky_header_background_color'];
            $sticky_header_background_color_transparency = 1;

            if($libero_mikado_options['sticky_header_transparency'] !== '') {
                $sticky_header_background_color_transparency = $libero_mikado_options['sticky_header_transparency'];
            }

            echo libero_mikado_dynamic_css('.mkd-page-header .mkd-sticky-header .mkd-sticky-holder', array('background-color' => libero_mikado_rgba_color($sticky_header_background_color, $sticky_header_background_color_transparency)));
        }

        if($libero_mikado_options['sticky_header_height'] !== '') {
            $max_height = intval(libero_mikado_filter_px($libero_mikado_options['sticky_header_height']) * 0.9).'px';

            echo libero_mikado_dynamic_css('.mkd-page-header .mkd-sticky-header', array('height' => $libero_mikado_options['sticky_header_height'].'px'));
            echo libero_mikado_dynamic_css('.mkd-page-header .mkd-sticky-header .mkd-logo-wrapper a', array('max-height' => $max_height));
            echo libero_mikado_dynamic_css('.mkd-sticky-header .mkd-main-menu > ul > li > a:after', array('line-height' => libero_mikado_filter_px($libero_mikado_options['sticky_header_height']).'px'));
        }

        $sticky_menu_item_styles = array();
        if($libero_mikado_options['sticky_color'] !== '') {
            $sticky_menu_item_styles['color'] = $libero_mikado_options['sticky_color'];
        }
        if($libero_mikado_options['sticky_google_fonts'] !== '-1') {
            $sticky_menu_item_styles['font-family'] = libero_mikado_get_formatted_font_family($libero_mikado_options['sticky_google_fonts']);
        }
        if($libero_mikado_options['sticky_fontsize'] !== '') {
            $sticky_menu_item_styles['font-size'] = $libero_mikado_options['sticky_fontsize'].'px';
        }
        if($libero_mikado_options['sticky_lineheight'] !== '') {
            $sticky_menu_item_styles['line-height'] = $libero_mikado_options['sticky_lineheight'].'px';
        }
        if($libero_mikado_options['sticky_texttransform'] !== '') {
            $sticky_menu_item_styles['text-transform'] = $libero_mikado_options['sticky_texttransform'];
        }
        if($libero_mikado_options['sticky_fontstyle'] !== '') {
            $sticky_menu_item_styles['font-style'] = $libero_mikado_options['sticky_fontstyle'];
        }
        if($libero_mikado_options['sticky_fontweight'] !== '') {
            $sticky_menu_item_styles['font-weight'] = $libero_mikado_options['sticky_fontweight'];
        }
        if($libero_mikado_options['sticky_letterspacing'] !== '') {
            $sticky_menu_item_styles['letter-spacing'] = $libero_mikado_options['sticky_letterspacing'].'px';
        }

        $sticky_menu_item_selector = array(
            '.mkd-main-menu.mkd-sticky-nav > ul > li > a'
        );

        echo libero_mikado_dynamic_css($sticky_menu_item_selector, $sticky_menu_item_styles);

        $sticky_menu_item_hover_styles = array();
        if($libero_mikado_options['sticky_hovercolor'] !== '') {
            $sticky_menu_item_hover_styles['color'] = $libero_mikado_options['sticky_hovercolor'];
        }

        $sticky_menu_item_hover_selector = array(
            '.mkd-main-menu.mkd-sticky-nav > ul > li:hover > a',
            '.mkd-main-menu.mkd-sticky-nav > ul > li.mkd-active-item:hover > a',
            'body:not(.mkd-menu-item-first-level-bg-color) .mkd-main-menu.mkd-sticky-nav > ul > li:hover > a',
            'body:not(.mkd-menu-item-first-level-bg-color) .mkd-main-menu.mkd-sticky-nav > ul > li.mkd-active-item:hover > a'
        );

        echo libero_mikado_dynamic_css($sticky_menu_item_hover_selector, $sticky_menu_item_hover_styles);
    }

    add_action('libero_mikado_style_dynamic', 'libero_mikado_sticky_header_styles');
}

if(!function_exists('libero_mikado_fixed_header_styles')) {
    /**
     * Generates styles for fixed haeder
     */
    function libero_mikado_fixed_header_styles() {
        global $libero_mikado_options;

        if($libero_mikado_options['fixed_header_grid_background_color'] !== '') {

            $fixed_header_grid_background_color              = $libero_mikado_options['fixed_header_grid_background_color'];
            $fixed_header_grid_background_color_transparency = 1;

            if($libero_mikado_options['fixed_header_grid_transparency'] !== '') {
                $fixed_header_grid_background_color_transparency = $libero_mikado_options['fixed_header_grid_transparency'];
            }

            echo libero_mikado_dynamic_css('.mkd-header-type1 .mkd-fixed-wrapper.fixed .mkd-grid .mkd-vertical-align-containers,
                                    .mkd-header-type3 .mkd-fixed-wrapper.fixed .mkd-grid .mkd-vertical-align-containers',
                array('background-color' => libero_mikado_rgba_color($fixed_header_grid_background_color, $fixed_header_grid_background_color_transparency)));
        }

        if($libero_mikado_options['fixed_header_background_color'] !== '') {

            $fixed_header_background_color              = $libero_mikado_options['fixed_header_background_color'];
            $fixed_header_background_color_transparency = 1;

            if($libero_mikado_options['fixed_header_transparency'] !== '') {
                $fixed_header_background_color_transparency = $libero_mikado_options['fixed_header_transparency'];
            }

            echo libero_mikado_dynamic_css('.mkd-header-type1 .mkd-fixed-wrapper.fixed .mkd-menu-area,
                                    .mkd-header-type3 .mkd-fixed-wrapper.fixed .mkd-menu-area',
                array('background-color' => libero_mikado_rgba_color($fixed_header_background_color, $fixed_header_background_color_transparency)));
        }

    }

    add_action('libero_mikado_style_dynamic', 'libero_mikado_fixed_header_styles');
}

if(!function_exists('libero_mikado_main_menu_styles')) {
    /**
     * Generates styles for main menu
     */
    function libero_mikado_main_menu_styles() {
		global $libero_mikado_options;
		$menu_typography = array();
		$menu_border_style = array();
		$menu_lh_padding_style = array();
		$dropdown_padding_style = array();
		$dropdown_typography = array();
		$dropdown_wide_typography = array();
		$dropdown_wide_hover_style = array();
		$dropdown_thrd_lvl_typography = array();
		$dropdown_wide_thrd_lvl_typography = array();
		$menu_typography_selector = array(
			'.mkd-main-menu.mkd-default-nav > ul > li > a',
			'.mkd-page-header #lang_sel > ul > li > a',
			'.mkd-page-header #lang_sel_click > ul > li > a',
			'.mkd-page-header #lang_sel ul > li:hover > a'
		);
		$menu_hover_clr_selector_imp = array(
			'.mkd-main-menu.mkd-default-nav > ul > li:hover > a',
			'.mkd-main-menu.mkd-default-nav > ul > li.mkd-active-item:hover > a',
			'body:not(.mkd-menu-item-first-level-bg-color) .mkd-main-menu.mkd-default-nav > ul > li:hover > a',
			'body:not(.mkd-menu-item-first-level-bg-color) .mkd-main-menu.mkd-default-nav > ul > li.mkd-active-item:hover > a',
			'.mkd-page-header #lang_sel ul li a:hover',
			'.mkd-page-header #lang_sel_click > ul > li a:hover'
		);
		$menu_active_clr_selector = array(
			'.mkd-main-menu.mkd-default-nav > ul > li.mkd-active-item > a',
			'body:not(.mkd-menu-item-first-level-bg-color) .mkd-main-menu.mkd-default-nav > ul > li.mkd-active-item > a'
		);
		$menu_hover_active_bckg_selector = array(
			'.mkd-main-menu.mkd-default-nav > ul > li:hover > a',
			'.mkd-main-menu.mkd-default-nav > ul > li.mkd-active-item > a'
		);
		$menu_light_border_selector = array(
			'.light .mkd-main-menu.mkd-default-nav > ul > li',
			'.light .mkd-main-menu.mkd-default-nav > ul > li:hover',
			'.light .mkd-main-menu.mkd-default-nav > ul > li.mkd-active-item'
		);
		$menu_dark_border_selector = array(
			'.dark .mkd-main-menu.mkd-default-nav > ul > li',
			'.dark .mkd-main-menu.mkd-default-nav > ul > li:hover',
			'.dark .mkd-main-menu.mkd-default-nav > ul > li.mkd-active-item'
		);
		$menu_hover_active_brdr_selector = array(
			'.mkd-main-menu.mkd-default-nav > ul > li:hover ',
			'.mkd-main-menu.mkd-default-nav > ul > li.mkd-active-item',
			'header:not(.mkd-menu-item-first-level-bg-color) .mkd-main-menu.mkd-default-nav > ul > li.mkd-active-item',
			'header:not(.mkd-menu-item-first-level-bg-color) .mkd-main-menu.mkd-default-nav > ul > li:hover',
		);
		$dropdown_background_color_selector = array(
			'.mkd-drop-down .second .inner ul',
			'.mkd-drop-down .second .inner ul li ul',
			'.shopping_cart_dropdown',
			'li.narrow .second .inner ul',
			'.mkd-main-menu.mkd-default-nav #lang_sel ul ul',
			'.mkd-main-menu.mkd-default-nav #lang_sel_click  ul ul',
			'.header-widget.widget_nav_menu ul ul',
			'.mkd-drop-down .wide.wide_background .second'
		);
		$dropdown_padding_selector = array(
			'li.narrow .second .inner ul',
			'.mkd-drop-down .wide .second .inner > ul'
		);
		$dropdown_top_position_selector = array(
			'.mkd-drop-down .narrow .second .inner ul li ul',
			'body.mkd-slide-from-bottom .mkd-drop-down .narrow .second .inner ul li:hover ul',
			'body.mkd-slide-from-top .narrow .second .inner ul li:hover ul'
		);
		$dropdown_typography_selector = array(
			'.mkd-drop-down .second .inner > ul > li > a',
			'.mkd-drop-down .second .inner > ul > li > h4',
			'.mkd-drop-down .wide .second .inner > ul > li > h4',
			'.mkd-drop-down .wide .second .inner > ul > li > a',
			'.mkd-drop-down .wide .second ul li ul li.menu-item-has-children > a',
			'.mkd-drop-down .wide .second .inner ul li.sub ul li.menu-item-has-children > a',
			'.mkd-drop-down .wide .second .inner > ul li.sub .flexslider ul li  h4 a',
			'.mkd-drop-down .wide .second .inner > ul li .flexslider ul li  h4 a',
			'.mkd-drop-down .wide .second .inner > ul li.sub .flexslider ul li  h4',
			'.mkd-drop-down .wide .second .inner > ul li .flexslider ul li  h4',
            '.mkd-main-menu.mkd-default-nav #lang_sel ul li li a',
            '.mkd-main-menu.mkd-default-nav #lang_sel_click ul li ul li a',
            '.mkd-main-menu.mkd-default-nav #lang_sel ul ul a',
            '.mkd-main-menu.mkd-default-nav #lang_sel_click ul ul a'
		);
		$dropdown_hover_clr_imp_selector = array(
			'.mkd-drop-down .second .inner > ul > li:hover > a',
			'.mkd-drop-down .wide .second ul li ul li.menu-item-has-children:hover > a',
			'.mkd-drop-down .wide .second .inner ul li.sub ul li.menu-item-has-children:hover > a',
			'.mkd-main-menu.mkd-default-nav #lang_sel ul li li:hover a',
			'.mkd-main-menu.mkd-default-nav #lang_sel_click ul li ul li:hover a',
			'.mkd-main-menu.mkd-default-nav #lang_sel ul li:hover > a',
			'.mkd-main-menu.mkd-default-nav #lang_sel_click ul li:hover > a'
		);
		$dropdown_item_padding_selector = array(
			'.mkd-drop-down .wide .second>.inner>ul>li.sub>ul>li>a',
			'.mkd-drop-down .second .inner ul li a',
			'.mkd-drop-down .wide .second ul li a',
			'.mkd-drop-down .second .inner ul.right li a'
		);
		$dropdown_wide_item_padding_selector = array(
			'.mkd-drop-down .wide .second>.inner > ul > li.sub > ul > li > a',
			'.mkd-drop-down .wide .second .inner ul li a',
			'.mkd-drop-down .wide .second ul li a',
			'.mkd-drop-down .wide .second .inner ul.right li a'
		);

		$menu_color = $libero_mikado_options['menu_color'];
		if($menu_color !== ''){
			$menu_typography['color'] = $menu_color;
		}

		$menu_fontsize = $libero_mikado_options['menu_fontsize'];
		if($menu_fontsize !== ''){
			$menu_typography['font-size'] = libero_mikado_filter_px($menu_fontsize).'px';
		}

		$menu_fontstyle = $libero_mikado_options['menu_fontstyle'];
		if($menu_fontstyle !== ''){
			$menu_typography['font-style'] = $menu_fontstyle;
		}

		$menu_fontweight = $libero_mikado_options['menu_fontweight'];
		if($menu_fontweight !== ''){
			$menu_typography['font-weight'] = $menu_fontweight;
		}

		$menu_texttransform = $libero_mikado_options['menu_texttransform'];
		if($menu_texttransform !== ''){
			$menu_typography['text-transform'] = $menu_texttransform;
		}

		$menu_letterspacing = $libero_mikado_options['menu_letterspacing'];
		if($menu_letterspacing !== ''){
			$menu_typography['letter-spacing'] = libero_mikado_filter_px($menu_letterspacing).'px';
		}

		$menu_google_fonts = $libero_mikado_options['menu_google_fonts'];
		if(libero_mikado_is_font_option_valid($menu_google_fonts)){
			$menu_typography['font-family'] = libero_mikado_get_font_option_val($menu_google_fonts);
			echo libero_mikado_dynamic_css('.mkd-page-header #lang_sel_list',array('font-family' => libero_mikado_get_font_option_val($menu_google_fonts).' !important'));
		}

		if (is_array($menu_typography) && count($menu_typography)){
			echo libero_mikado_dynamic_css($menu_typography_selector,$menu_typography);
		}

		$menu_hover_active_color = $libero_mikado_options['menu_hover_active_color'];
		if ($menu_hover_active_color !== ''){
			echo libero_mikado_dynamic_css($menu_hover_clr_selector_imp,array('color' => $menu_hover_active_color.' !important'));
			echo libero_mikado_dynamic_css($menu_active_clr_selector,array('color' => $menu_hover_active_color));
		}

		$menu_text_background_color = $libero_mikado_options['menu_text_background_color'];
		if ($menu_text_background_color !== ''){
			echo libero_mikado_dynamic_css('.mkd-main-menu > ul > li > a',array('background-color' => $menu_text_background_color));
		}

		$menu_hover_active_background_color = $libero_mikado_options['menu_hover_active_background_color'];
		$menu_hover_active_bckg_color_transparency = 1;
		if ($menu_hover_active_background_color !== ''){
			if ($libero_mikado_options['menu_hover_active_bckg_color_transparency'] !== ''){
				$menu_hover_active_bckg_color_transparency = $libero_mikado_options['menu_hover_active_bckg_color_transparency'];
			}
			echo libero_mikado_dynamic_css($menu_hover_active_bckg_selector,array('background-color' => libero_mikado_rgba_color($menu_hover_active_background_color,$menu_hover_active_bckg_color_transparency)));
		}

		$menu_lineheight = $libero_mikado_options['menu_lineheight'];
		if ($menu_lineheight !== ''){
			$menu_lh_padding_style['line-height'] = libero_mikado_filter_px($menu_lineheight).'px';
		}

		$menu_padding_left_right = $libero_mikado_options['menu_padding_left_right'];
		if ($menu_padding_left_right !== ''){
			$menu_lh_padding_style['padding'] = '0 '.libero_mikado_filter_px($menu_padding_left_right).'px';
		}

		if (is_array($menu_lh_padding_style) && count($menu_lh_padding_style)){
			echo libero_mikado_dynamic_css('.mkd-main-menu.mkd-default-nav > ul > li > a span.item_inner',$menu_lh_padding_style);
		}

		$menu_margin_left_right = $libero_mikado_options['menu_margin_left_right'];
		if($menu_margin_left_right !== '') {
			echo libero_mikado_dynamic_css('.mkd-main-menu.mkd-default-nav > ul > li',array('margin' => '0 '.libero_mikado_filter_px($menu_margin_left_right).'px'));
		}

		$dropdown_background_color = $libero_mikado_options['dropdown_background_color'];
		$dropdown_background_transparency = 1;
		if ($dropdown_background_color !== ''){
			if ($libero_mikado_options['dropdown_background_transparency'] !== ''){
				$dropdown_background_transparency = $libero_mikado_options['dropdown_background_transparency'];
			}
			echo libero_mikado_dynamic_css($dropdown_background_color_selector,array('background-color' => libero_mikado_rgba_color($dropdown_background_color,$dropdown_background_transparency)));
		}

		$dropdown_top_padding = $libero_mikado_options['dropdown_top_padding'];
		if ($dropdown_top_padding !== ''){
			$dropdown_padding_style['padding-top'] = libero_mikado_filter_px($dropdown_top_padding).'px';
			echo libero_mikado_dynamic_css($dropdown_top_position_selector,array('top' => '-'.libero_mikado_filter_px($dropdown_top_padding).'px'));
		}

		$dropdown_bottom_padding = $libero_mikado_options['dropdown_bottom_padding'];
		if ($dropdown_bottom_padding !== ''){
			$dropdown_padding_style['padding-bottom'] = libero_mikado_filter_px($dropdown_bottom_padding).'px';
		}

		if (is_array($dropdown_padding_style) && count($dropdown_padding_style)){
			echo libero_mikado_dynamic_css($dropdown_padding_selector,$dropdown_padding_style);
		}

		$dropdown_vertical_separator_color = $libero_mikado_options['dropdown_vertical_separator_color'];
		if($dropdown_vertical_separator_color !== '') {
			echo libero_mikado_dynamic_css('.mkd-drop-down .wide .second ul li',array('border-left-color' => $dropdown_vertical_separator_color));
		}

		$dropdown_top_position = $libero_mikado_options['dropdown_top_position'];
		if($dropdown_top_position !== '') {
			if (!libero_mikado_string_ends_with($dropdown_top_position,'%')){
				$dropdown_top_position.='%';
			}

			echo libero_mikado_dynamic_css('header .mkd-drop-down .second',array('top' => $dropdown_top_position));
		}

		$dropdown_color = $libero_mikado_options['dropdown_color'];
		if ($dropdown_color !== ''){
			$dropdown_typography['color'] = $dropdown_color;
			if(libero_mikado_is_woocommerce_installed()){
				echo libero_mikado_dynamic_css(array(
					'.shopping_cart_dropdown ul li',
					'.item_info_holder .item_left a',
					'.shopping_cart_dropdown ul li .item_info_holder .item_right .amount',
					'.shopping_cart_dropdown .cart_bottom .subtotal_holder .total',
					'.shopping_cart_dropdown .cart_bottom .subtotal_holder .total_amount'
					),
					array('color' => $dropdown_color));
			}
		}

		$dropdown_fontsize = $libero_mikado_options['dropdown_fontsize'];
		if ($dropdown_fontsize !== ''){
			$dropdown_typography['font-size'] = libero_mikado_filter_px($dropdown_fontsize).'px';
		}

		$dropdown_lineheight = $libero_mikado_options['dropdown_lineheight'];
		if ($dropdown_lineheight !== ''){
			$dropdown_typography['line-height'] = libero_mikado_filter_px($dropdown_lineheight).'px';
		}

		$dropdown_fontstyle = $libero_mikado_options['dropdown_fontstyle'];
		if ($dropdown_fontstyle !== ''){
			$dropdown_typography['font-style'] = $dropdown_fontstyle;
		}

		$dropdown_fontweight = $libero_mikado_options['dropdown_fontweight'];
		if ($dropdown_fontweight !== ''){
			$dropdown_typography['font-weight'] = $dropdown_fontweight;
		}

		$dropdown_texttransform = $libero_mikado_options['dropdown_texttransform'];
		if ($dropdown_texttransform !== ''){
			$dropdown_typography['text-transform'] = $dropdown_texttransform;
		}

		$dropdown_letterspacing = $libero_mikado_options['dropdown_letterspacing'];
		if ($dropdown_letterspacing !== ''){
			$dropdown_typography['letter-spacing'] = libero_mikado_filter_px($dropdown_letterspacing).'px';
		}

		$dropdown_google_fonts = $libero_mikado_options['dropdown_google_fonts'];
		if (libero_mikado_is_font_option_valid($dropdown_google_fonts)){
			$dropdown_typography['font-family'] = libero_mikado_get_font_option_val($dropdown_google_fonts);
		}

		if (is_array($dropdown_typography) && count($dropdown_typography)){
			echo libero_mikado_dynamic_css($dropdown_typography_selector,$dropdown_typography);
		}

		$dropdown_hovercolor = $libero_mikado_options['dropdown_hovercolor'];
		if ($dropdown_hovercolor !== ''){
			echo libero_mikado_dynamic_css($dropdown_hover_clr_imp_selector,array('color' => $dropdown_hovercolor.' !important'));
		}

		$dropdown_background_hovercolor = $libero_mikado_options['dropdown_background_hovercolor'];
		if ($dropdown_background_hovercolor !== ''){
			echo libero_mikado_dynamic_css('.mkd-drop-down li:not(.wide) .second .inner > ul > li:hover',array('background-color' => $dropdown_background_hovercolor));
		}

		$dropdown_padding_top_bottom = $libero_mikado_options['dropdown_padding_top_bottom'];
		if ($dropdown_padding_top_bottom !== ''){
			$dropdown_padding_top_bottom = libero_mikado_filter_px($dropdown_padding_top_bottom).'px';
			echo libero_mikado_dynamic_css($dropdown_item_padding_selector,array(
				'padding-top' => $dropdown_padding_top_bottom,
				'padding-bottom' => $dropdown_padding_top_bottom)
			);
		}

		$dropdown_wide_color = $libero_mikado_options['dropdown_wide_color'];
		if ($dropdown_wide_color !== ''){
			$dropdown_wide_typography['color'] = $dropdown_wide_color;
		}

		$dropdown_wide_fontsize = $libero_mikado_options['dropdown_wide_fontsize'];
		if ($dropdown_wide_fontsize !== ''){
			$dropdown_wide_typography['font-size'] = libero_mikado_filter_px($dropdown_wide_fontsize).'px';
		}

		$dropdown_wide_lineheight = $libero_mikado_options['dropdown_wide_lineheight'];
		if ($dropdown_wide_lineheight !== ''){
			$dropdown_wide_typography['line-height'] = libero_mikado_filter_px($dropdown_wide_lineheight).'px';
		}

		$dropdown_wide_fontstyle = $libero_mikado_options['dropdown_wide_fontstyle'];
		if ($dropdown_wide_fontstyle !== ''){
			$dropdown_wide_typography['font-style'] = $dropdown_wide_fontstyle;
		}

		$dropdown_wide_fontweight = $libero_mikado_options['dropdown_wide_fontweight'];
		if ($dropdown_wide_fontweight !== ''){
			$dropdown_wide_typography['font-weight'] = $dropdown_wide_fontweight;
		}

		$dropdown_wide_texttransform = $libero_mikado_options['dropdown_wide_texttransform'];
		if ($dropdown_wide_texttransform !== ''){
			$dropdown_wide_typography['text-transform'] = $dropdown_wide_texttransform;
		}

		$dropdown_wide_letterspacing = $libero_mikado_options['dropdown_wide_letterspacing'];
		if ($dropdown_wide_letterspacing !== ''){
			$dropdown_wide_typography['letter-spacing'] = libero_mikado_filter_px($dropdown_wide_letterspacing).'px';
		}

		$dropdown_wide_google_fonts = $libero_mikado_options['dropdown_wide_google_fonts'];
		if (libero_mikado_is_font_option_valid($dropdown_wide_google_fonts)){
			$dropdown_wide_typography['font-family'] = libero_mikado_get_font_option_val($dropdown_wide_google_fonts);
		}

		if (is_array($dropdown_wide_typography) && count($dropdown_wide_typography)){
			echo libero_mikado_dynamic_css('.mkd-drop-down .wide .second .inner > ul > li > a',$dropdown_wide_typography);
		}

		$dropdown_wide_hovercolor = $libero_mikado_options['dropdown_wide_hovercolor'];
		if ($dropdown_wide_hovercolor !== ''){
			$dropdown_wide_hover_style['color'] = $dropdown_wide_hovercolor.' !important';
		}

		$dropdown_wide_background_hovercolor = $libero_mikado_options['dropdown_wide_background_hovercolor'];
		if ($dropdown_wide_background_hovercolor !== ''){
			$dropdown_wide_hover_style['background-color'] = $dropdown_wide_background_hovercolor;
		}

		if (is_array($dropdown_wide_hover_style) && count($dropdown_wide_hover_style)){
			echo libero_mikado_dynamic_css('.mkd-drop-down .wide .second .inner > ul > li:hover > a',$dropdown_wide_hover_style);
		}

		$dropdown_wide_padding_top_bottom = $libero_mikado_options['dropdown_wide_padding_top_bottom'];
		if ($dropdown_wide_padding_top_bottom !== ''){
			$dropdown_wide_padding_top_bottom = libero_mikado_filter_px($dropdown_wide_padding_top_bottom).'px';
			echo libero_mikado_dynamic_css($dropdown_wide_item_padding_selector,array(
				'padding-top' => $dropdown_wide_padding_top_bottom,
				'padding-bottom' => $dropdown_wide_padding_top_bottom
			));
		}

		$dropdown_color_thirdlvl = $libero_mikado_options['dropdown_color_thirdlvl'];
		if ($dropdown_color_thirdlvl !== ''){
			$dropdown_thrd_lvl_typography['color'] = $dropdown_color_thirdlvl;
		}

		$dropdown_fontsize_thirdlvl = $libero_mikado_options['dropdown_fontsize_thirdlvl'];
		if ($dropdown_fontsize_thirdlvl !== ''){
			$dropdown_thrd_lvl_typography['font-size'] = libero_mikado_filter_px($dropdown_fontsize_thirdlvl).'px';
		}

		$dropdown_lineheight_thirdlvl = $libero_mikado_options['dropdown_lineheight_thirdlvl'];
		if ($dropdown_lineheight_thirdlvl !== ''){
			$dropdown_thrd_lvl_typography['line-height'] = libero_mikado_filter_px($dropdown_lineheight_thirdlvl).'px';
		}

		$dropdown_fontstyle_thirdlvl = $libero_mikado_options['dropdown_fontstyle_thirdlvl'];
		if ($dropdown_fontstyle_thirdlvl !== ''){
			$dropdown_thrd_lvl_typography['font-style'] = $dropdown_fontstyle_thirdlvl;
		}

		$dropdown_fontweight_thirdlvl = $libero_mikado_options['dropdown_fontweight_thirdlvl'];
		if ($dropdown_fontweight_thirdlvl !== ''){
			$dropdown_thrd_lvl_typography['font-weight'] = $dropdown_fontweight_thirdlvl;
		}

		$dropdown_texttransform_thirdlvl = $libero_mikado_options['dropdown_texttransform_thirdlvl'];
		if ($dropdown_texttransform_thirdlvl !== ''){
			$dropdown_thrd_lvl_typography['text-transform'] = $dropdown_texttransform_thirdlvl;
		}

		$dropdown_letterspacing_thirdlvl = $libero_mikado_options['dropdown_letterspacing_thirdlvl'];
		if ($dropdown_letterspacing_thirdlvl !== ''){
			$dropdown_thrd_lvl_typography['letter-spacing'] = libero_mikado_filter_px($dropdown_letterspacing_thirdlvl).'px';
		}

		$dropdown_google_fonts_thirdlvl = $libero_mikado_options['dropdown_google_fonts_thirdlvl'];
		if (libero_mikado_is_font_option_valid($dropdown_google_fonts_thirdlvl)){
			$dropdown_thrd_lvl_typography['font-family'] = libero_mikado_get_font_option_val($dropdown_google_fonts_thirdlvl);
		}

		if (is_array($dropdown_thrd_lvl_typography) && count($dropdown_thrd_lvl_typography)){
			echo libero_mikado_dynamic_css('.mkd-drop-down .second .inner ul li.sub ul li a',$dropdown_thrd_lvl_typography);
		}

		$dropdown_hovercolor_thirdlvl = $libero_mikado_options['dropdown_hovercolor_thirdlvl'];
		if ($dropdown_hovercolor_thirdlvl !== ''){
			echo libero_mikado_dynamic_css(array(
					'.mkd-drop-down .second .inner ul li.sub ul li:not(.flex-active-slide):hover > a:not(.flex-prev):not(.flex-next)',
					'.mkd-drop-down .second .inner ul li ul li:not(.flex-active-slide):hover > a:not(.flex-prev):not(.flex-next)'
				),array('color' => $dropdown_hovercolor_thirdlvl.' !important'));
		}

		$dropdown_background_hovercolor_thirdlvl = $libero_mikado_options['dropdown_background_hovercolor_thirdlvl'];
		if ($dropdown_background_hovercolor_thirdlvl !== ''){
			echo libero_mikado_dynamic_css(array(
				'.mkd-drop-down .second .inner ul li.sub ul li:hover',
				'.mkd-drop-down .second .inner ul li ul li:hover'
				),array('background-color' => $dropdown_background_hovercolor_thirdlvl));
		}



		$dropdown_wide_color_thirdlvl = $libero_mikado_options['dropdown_wide_color_thirdlvl'];
		if ($dropdown_wide_color_thirdlvl !== ''){
			$dropdown_wide_thrd_lvl_typography['color'] = $dropdown_wide_color_thirdlvl;
		}

		$dropdown_wide_fontsize_thirdlvl = $libero_mikado_options['dropdown_wide_fontsize_thirdlvl'];
		if ($dropdown_wide_fontsize_thirdlvl !== ''){
			$dropdown_wide_thrd_lvl_typography['font-size'] = libero_mikado_filter_px($dropdown_wide_fontsize_thirdlvl).'px';
		}

		$dropdown_wide_lineheight_thirdlvl = $libero_mikado_options['dropdown_wide_lineheight_thirdlvl'];
		if ($dropdown_wide_lineheight_thirdlvl !== ''){
			$dropdown_wide_thrd_lvl_typography['line-height'] = libero_mikado_filter_px($dropdown_wide_lineheight_thirdlvl).'px';
		}

		$dropdown_wide_fontstyle_thirdlvl = $libero_mikado_options['dropdown_wide_fontstyle_thirdlvl'];
		if ($dropdown_wide_fontstyle_thirdlvl !== ''){
			$dropdown_wide_thrd_lvl_typography['font-style'] = $dropdown_wide_fontstyle_thirdlvl;
		}

		$dropdown_wide_fontweight_thirdlvl = $libero_mikado_options['dropdown_wide_fontweight_thirdlvl'];
		if ($dropdown_wide_fontweight_thirdlvl !== ''){
			$dropdown_wide_thrd_lvl_typography['font-weight'] = $dropdown_wide_fontweight_thirdlvl;
		}

		$dropdown_wide_texttransform_thirdlvl = $libero_mikado_options['dropdown_wide_texttransform_thirdlvl'];
		if ($dropdown_wide_texttransform_thirdlvl !== ''){
			$dropdown_wide_thrd_lvl_typography['text-transform'] = $dropdown_wide_texttransform_thirdlvl;
		}

		$dropdown_wide_letterspacing_thirdlvl = $libero_mikado_options['dropdown_wide_letterspacing_thirdlvl'];
		if ($dropdown_wide_letterspacing_thirdlvl !== ''){
			$dropdown_wide_thrd_lvl_typography['letter-spacing'] = libero_mikado_filter_px($dropdown_wide_letterspacing_thirdlvl).'px';
		}

		$dropdown_wide_google_fonts_thirdlvl = $libero_mikado_options['dropdown_wide_google_fonts_thirdlvl'];
		if (libero_mikado_is_font_option_valid($dropdown_wide_google_fonts_thirdlvl)){
			$dropdown_wide_thrd_lvl_typography['font-family'] = libero_mikado_get_font_option_val($dropdown_wide_google_fonts_thirdlvl);
		}

		if (is_array($dropdown_wide_thrd_lvl_typography) && count($dropdown_wide_thrd_lvl_typography)){
			echo libero_mikado_dynamic_css(array(
				'.mkd-drop-down .wide .second .inner ul li.sub ul li a',
				'.mkd-drop-down .wide .second ul li ul li a'
            ),$dropdown_wide_thrd_lvl_typography);
		}

		$dropdown_wide_hovercolor_thirdlvl = $libero_mikado_options['dropdown_wide_hovercolor_thirdlvl'];
		if ($dropdown_wide_hovercolor_thirdlvl !== ''){
			echo libero_mikado_dynamic_css(array(
					'.mkd-drop-down .wide .second .inner ul li.sub ul li:not(.flex-active-slide) > a:not(.flex-prev):not(.flex-next):hover',
					'.mkd-drop-down .wide .second .inner ul li ul li:not(.flex-active-slide) > a:not(.flex-prev):not(.flex-next):hover'
				),array('color' => $dropdown_wide_hovercolor_thirdlvl.' !important'));
		}

		$dropdown_wide_background_hovercolor_thirdlvl = $libero_mikado_options['dropdown_wide_background_hovercolor_thirdlvl'];
		if ($dropdown_wide_background_hovercolor_thirdlvl !== ''){
			echo libero_mikado_dynamic_css(array(
				'.mkd-drop-down .wide .second .inner ul li.sub ul li:hover',
				'.mkd-drop-down .wide .second .inner ul li ul li:hover'
				),array('background-color' => $dropdown_wide_background_hovercolor_thirdlvl));
		}
    }

    add_action('libero_mikado_style_dynamic', 'libero_mikado_main_menu_styles');
}