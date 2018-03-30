<?php
// GET CUSTOM CSS VARIABLE FONT
//--------------------------------------------------
if (!function_exists('g5plus_custom_css_variable_font')) {
	function g5plus_custom_css_variable_font() {
		global $g5plus_options;

		$fonts = (object)array();

		$fonts->menu_font = 'Montserrat';
		if (isset($g5plus_options['menu_font']) && ! empty($g5plus_options['menu_font']) && !empty($g5plus_options['menu_font']['font-family'])) {
			$fonts->menu_font = $g5plus_options['menu_font']['font-family'];
		}

		$fonts->primary_font = 'Raleway';
		if (isset($g5plus_options['body_font']) && ! empty($g5plus_options['body_font']) && !empty($g5plus_options['body_font']['font-family'])) {
			$fonts->primary_font = $g5plus_options['body_font']['font-family'];
		}

		$fonts->secondary_font = 'Montserrat';
		if (isset($g5plus_options['secondary_font']) && ! empty($g5plus_options['secondary_font']) && !empty($g5plus_options['secondary_font']['font-family'])) {
			$fonts->secondary_font = $g5plus_options['secondary_font']['font-family'];
		}


		return $fonts;
	}
}

// GET CUSTOM CSS VARIABLE LOGO
//--------------------------------------------------
if (!function_exists('g5plus_custom_css_variable_logo')) {
	function g5plus_custom_css_variable_logo($page_id = 0) {
		global $g5plus_options;
		$prefix = 'g5plus_';

		$logo = (object)array();

		// GET logo_max_height, logo_padding
		$g5plus_header_layout = '';
		if (!empty($page_id)) {
			$g5plus_header_layout = rwmb_meta($prefix . 'header_layout', array(), $page_id);
		}
		if (($g5plus_header_layout === '') || ($g5plus_header_layout == '-1')) {
			$g5plus_header_layout = $g5plus_options['header_layout'];
		}

		$logo->logo_max_height = '174px';
		$logo->logo_padding_top = '20px';
		$logo->logo_padding_bottom = '20px';
		$logo->main_menu_height = '82px';

		$logo_matrix = array(
			'header-1' => array(174, 20, 20, 82),
			'header-2' => array(174, 20, 20, 82),
			'header-3' => array(122, 20, 20),
			'header-4' => array(174, 20, 20, 82),
			'header-5' => array(132, 20, 20),
			'header-6' => array(174, 20, 20, 70),
			'header-7' => array(174, 20, 20, 70),
			'header-8' => array(174, 20, 20, 70),
			'header-9' => array(132, 20, 20),
		);

		if (isset($logo_matrix[$g5plus_header_layout])) {
			$logo->logo_max_height = $logo_matrix[$g5plus_header_layout][0] . 'px';
			$logo->logo_padding_top = $logo_matrix[$g5plus_header_layout][1] . 'px';
			$logo->logo_padding_bottom = $logo_matrix[$g5plus_header_layout][2] . 'px';
			if (isset($logo_matrix[$g5plus_header_layout][3])) {
				$logo->main_menu_height = $logo_matrix[$g5plus_header_layout][3] . 'px';
			}
		}

		// Get logo max height
		if (!empty($page_id)) {
			$logo->logo_max_height = rwmb_meta($prefix . 'logo_max_height', array(), $page_id);

			if (($logo->logo_max_height === '') || ($logo->logo_max_height == '-1')) {
				if (isset($g5plus_options['logo_max_height']) && isset($g5plus_options['logo_max_height']['height']) && ! empty($g5plus_options['logo_max_height']['height']) && ($g5plus_options['logo_max_height']['height'] != 'px')) {
					$logo->logo_max_height = $g5plus_options['logo_max_height']['height'];
				}
				else {
					$logo->logo_max_height = $logo_matrix[$g5plus_header_layout][0] . 'px';
				}
			}
			else {
				$logo->logo_max_height .= 'px';
			}
		}
		else {
			if (isset($g5plus_options['logo_max_height']) && isset($g5plus_options['logo_max_height']['height']) && ! empty($g5plus_options['logo_max_height']['height']) && ($g5plus_options['logo_max_height']['height'] != 'px')) {
				$logo->logo_max_height = $g5plus_options['logo_max_height']['height'];
			}
		}

		// get logo padding
		if (!empty($page_id)) {
			$logo->logo_padding_top = rwmb_meta($prefix . 'logo_padding_top', array(), $page_id);

			if (($logo->logo_padding_top === '') || ($logo->logo_padding_top == '-1')) {
				if (isset($g5plus_options['logo_padding']) && is_array($g5plus_options['logo_padding'])
					&& isset($g5plus_options['logo_padding']['padding-top']) && !empty($g5plus_options['logo_padding']['padding-top'])) {
					$logo->logo_padding_top = $g5plus_options['logo_padding']['padding-top'];
				}
				else {
					$logo->logo_padding_top = $logo_matrix[$g5plus_header_layout][1] . 'px';
				}
			}
			else {
				$logo->logo_padding_top .= 'px';
			}


			$logo->logo_padding_bottom = rwmb_meta($prefix . 'logo_padding_bottom', array(), $page_id);

			if (($logo->logo_padding_bottom === '') || ($logo->logo_padding_bottom == '-1')) {
				if (isset($g5plus_options['logo_padding']) && is_array($g5plus_options['logo_padding'])
					&& isset($g5plus_options['logo_padding']['padding-bottom']) && !empty($g5plus_options['logo_padding']['padding-bottom'])) {
					$logo->logo_padding_bottom = $g5plus_options['logo_padding']['padding-bottom'];
				}
				else {
					$logo->logo_padding_bottom = $logo_matrix[$g5plus_header_layout][2] . 'px';
				}
			}
			else {
				$logo->logo_padding_bottom .= 'px';
			}

		}
		else {
			if (isset($g5plus_options['logo_padding']) && is_array($g5plus_options['logo_padding'])) {
				if (isset($g5plus_options['logo_padding']['padding-top']) && !empty($g5plus_options['logo_padding']['padding-top'])) {
					$logo->logo_padding_top = $g5plus_options['logo_padding']['padding-top'];
				}
				if (isset($g5plus_options['logo_padding']['padding-bottom']) && !empty($g5plus_options['logo_padding']['padding-bottom'])) {
					$logo->logo_padding_bottom = $g5plus_options['logo_padding']['padding-bottom'];
				}
			}
		}

		if (!isset($logo_matrix[$g5plus_header_layout][3])) {
			$logo->main_menu_height = (str_replace('px', '', $logo->logo_max_height)) . 'px';
		}

		return $logo;
	}
}

// GET CUSTOM CSS VARIABLE HEADER
//--------------------------------------------------
if (!function_exists('g5plus_custom_css_variable_header')) {
	function g5plus_custom_css_variable_header($page_id = 0) {
		global $g5plus_options;
		$prefix = 'g5plus_';

		$header = (object)array();

		$header->header_nav_bg_color_color = '#f4f4f4';
		$header->header_nav_bg_color_opacity = 1;
		$header->header_nav_text_color = '#fff';

		$primary_color = '#DDBE86';
		$enable_page_color = (!empty($page_id) && ($page_id !== 0)) ? rwmb_meta($prefix . 'enable_page_color', array(), $page_id) : '0';
		if ($enable_page_color == '1') {
			$primary_color = (!empty($page_id) && ($page_id !== 0)) ? rwmb_meta($prefix . 'primary_color', array(), $page_id) : '';
		}
		else {
			if (isset($g5plus_options['primary_color']) && ! empty($g5plus_options['primary_color'])) {
				$primary_color = $g5plus_options['primary_color'];
			}
		}
		if (empty($primary_color)) {
			$primary_color = '#DDBE86';
		}



		// Header scheme
		$header_scheme = rwmb_meta($prefix . 'header_scheme', array(), $page_id);

		if (($header_scheme === '') || ($header_scheme == '-1')) {
			$header_scheme = isset($g5plus_options['header_scheme']) && !empty($g5plus_options['header_scheme']) ? $g5plus_options['header_scheme'] : 'light';
		}

		$header->header_border_color = '#eee';
		$header_background_color = '#fff';
		$header_background_image = '';
		$header_background_repeat = '';
		$header_background_position = '';
		$header_background_size = '';
		$header_background_attachment = '';
		$header_background_color_opacity = 100;

		$is_set_header_background_css = false;

		switch ($header_scheme) {
			case 'light':
				$header->header_border_color = '#eee';
				$header_background_color = '#fff';
				$header->header_text_color = '#3f3f3f';
				break;
			case 'transparent':
				$header->header_border_color = 'rgba(238,238,238, 0.2)';
				$header_background_color = 'transparent';
				$header->header_text_color = '#fff';
				break;
			case 'customize':
				$is_get_option_background = false;

				if ((!empty($page_id))) {
					$header_background_enable = rwmb_meta($prefix . 'header_background_enable', array(), $page_id);
					if (($header_background_enable == '1')) {
						$header_background_color = rwmb_meta($prefix . 'header_background_color', array(), $page_id);
						$header_background_image = rwmb_meta($prefix . 'header_background_image', 'type=image_advanced', $page_id);
						$header_background_repeat = rwmb_meta($prefix . 'header_background_repeat', array(), $page_id);
						$header_background_position = rwmb_meta($prefix . 'header_background_position', array(), $page_id);
						$header_background_size = rwmb_meta($prefix . 'header_background_size', array(), $page_id);
						$header_background_attachment = rwmb_meta($prefix . 'header_background_attachment', array(), $page_id);
						$header_background_color_opacity = rwmb_meta($prefix . 'header_background_color_opacity', array(), $page_id);

						$header_background_image_id = rwmb_meta($prefix . 'header_background_image', array(), $page_id);
						if (is_array($header_background_image)) {
							$header_background_image = $header_background_image[$header_background_image_id];
						}

						if (($header_background_color !== '' ) && ($header_background_color_opacity !== '')) {
							$header_background_color = g5plus_hex2rgba($header_background_color, $header_background_color_opacity / 100.0);
						}
						$is_set_header_background_css =  true;
						$header_border_color = rwmb_meta($prefix . 'header_border_color', array(), $page_id);
						$header_border_color_opacity = rwmb_meta($prefix . 'header_border_color_opacity', array(), $page_id);
						$header->header_border_color = '#eee';
						if (($header_border_color_opacity !== '') && ($header_border_color !== '')) {
							$header->header_border_color = g5plus_hex2rgba($header_border_color, $header_border_color_opacity * 1.0/100);
						}
						$header->header_text_color = rwmb_meta($prefix . 'header_text_color', array(), $page_id);
						if ($header->header_text_color === '') {
							$header->header_text_color = '#3f3f3f';
						}
					}
					else {
						$is_get_option_background = true;
					}
				}
				else {
					$is_get_option_background = true;
				}
				if ($is_get_option_background) {
					$header_background = isset($g5plus_options['header_background']) ? $g5plus_options['header_background'] : array();
					$header_background_color_opacity = isset($g5plus_options['header_background_color_opacity']) ? $g5plus_options['header_background_color_opacity'] : 100;

					if ($header_background) {
						$is_set_header_background_css =  true;

						$header_background_color = isset($header_background['background-color']) ?
							g5plus_hex2rgba($header_background['background-color'], $header_background_color_opacity/ 100.0) : 'transparent';
						$header_background_image = isset($header_background['background-image']) && !empty($header_background['background-image']) ?
							$header_background['background-image'] : '';
						$header_background_repeat = isset($header_background['background-repeat']) && !empty($header_background['background-repeat']) ?
							$header_background['background-repeat'] : '';
						$header_background_position = isset($header_background['background-position']) && !empty($header_background['background-position']) ?
							$header_background['background-position'] : '';
						$header_background_size = isset($header_background['background-size']) && !empty($header_background['background-size']) ?
							$header_background['background-size'] : '';
						$header_background_attachment = isset($header_background['background-attachment']) && !empty($header_background['background-attachment']) ?
							$header_background['background-attachment'] : '';
					}

					$header_border_color = isset($g5plus_options['header_border_color']) ? $g5plus_options['header_border_color'] : array();
					$header->header_border_color = '#eee';
					if ($header_border_color) {
						if (isset($header_border_color['alpha']) && !empty($header_border_color['alpha'])) {
							$header->header_border_color = $header_border_color['alpha'];
						}
						if (isset($header_border_color['color']) && !empty($header_border_color['color'])) {
							$header->header_border_color =$header_border_color['color'];
						}
					}

					$header->header_text_color = isset($g5plus_options['header_text_color']) && !empty($g5plus_options['header_text_color']) ? $g5plus_options['header_text_color'] : '#3f3f3f';
				}

				break;
		}

		$header->header_background_color = $header_background_color;
		$header->header_background_css = '.header-main-background() {}';
		if ($is_set_header_background_css) {
			$header->header_background_css = sprintf('.header-main-background() {%s%s%s%s%s%s}',
				!empty($header_background_color) ?
					'background-color:' . $header_background_color  . ';' : 'background-color:transparent;',
				!empty($header_background_image) ?
					'background-image:url(' . (is_array($header_background_image) ? $header_background_image['url'] : $header_background_image ) . ');' : 'background-image:none;',
				!empty($header_background_repeat) ?
					'background-repeat:' . $header_background_repeat . ';' : '',
				!empty($header_background_position) ?
					'background-position:' . $header_background_position . ';' : '',
				!empty($header_background_size) ?
					'background-size:' . $header_background_size . ';' : '',
				!empty($header_background_attachment) ?
					'background-attachment:' . $header_background_attachment . ';' : ''
			);
		}

		// Set header nav scheme
		$header_nav_scheme = rwmb_meta($prefix . 'header_nav_scheme', array(), $page_id);
		if ((!empty($page_id)) && ($header_nav_scheme != '-1') && ($header_nav_scheme != '')) {
			switch ($header_nav_scheme) {
				case 'light':
					$header->header_nav_bg_color_color = '#fff';
					$header->header_nav_bg_color_opacity = '1';
					$header->header_nav_text_color = '#333';
					break;
				case 'transparent':
					$header->header_nav_bg_color_color = 'transparent';
					$header->header_nav_bg_color_opacity = '0';
					$header->header_nav_text_color = '#fff';
					break;
				case 'primary-color':
					$header->header_nav_bg_color_color = $primary_color;
					$header->header_nav_bg_color_opacity = '1';
					$header->header_nav_text_color = '#fff';
					break;
				default:
					if (rwmb_meta($prefix . 'header_nav_bg_color_color', array(), $page_id) != '') {
						$header->header_nav_bg_color_color = rwmb_meta($prefix . 'header_nav_bg_color_color', array(), $page_id);
					}
					$header->header_nav_bg_color_opacity = rwmb_meta($prefix . 'header_nav_bg_color_opacity', array(), $page_id);

					if (($header->header_nav_bg_color_opacity == '')) {
						$header->header_nav_bg_color_opacity = 1;
					}
					else {
						$header->header_nav_bg_color_opacity = $header->header_nav_bg_color_opacity/100.0;
					}

					$header->header_nav_text_color = rwmb_meta($prefix . 'header_nav_text_color', array(), $page_id);
					if (($header->header_nav_text_color == '')) {
						$header->header_nav_text_color = '#222';
					}
					break;
			}
		}
		else {
			$header_nav_scheme = isset($g5plus_options['header_nav_scheme']) ? $g5plus_options['header_nav_scheme'] : '';
			switch ($header_nav_scheme) {
				case 'light':
					$header->header_nav_bg_color_color = '#fff';
					$header->header_nav_bg_color_opacity = '1';
					$header->header_nav_text_color = '#191919';
					break;
				case 'transparent':
					$header->header_nav_bg_color_color = 'transparent';
					$header->header_nav_bg_color_opacity = '0';
					$header->header_nav_text_color = '#fff';
					break;
				case 'primary-color':
					$header->header_nav_bg_color_color = $primary_color;
					$header->header_nav_bg_color_opacity = '1';
					$header->header_nav_text_color = '#fff';
					break;
				default:
					$header_nav_bg_color = isset($g5plus_options['header_nav_bg_color']) ? $g5plus_options['header_nav_bg_color'] : array();

					if ($header_nav_bg_color) {
						if (isset($header_nav_bg_color['alpha'])) {
							$header->header_nav_bg_color_opacity = $header_nav_bg_color['alpha'];
						}
						if (isset($header_nav_bg_color['color'])) {
							$header->header_nav_bg_color_color =$header_nav_bg_color['color'];
						}
					}
					if (isset($g5plus_options['header_nav_text_color']) ) {
						$header->header_nav_text_color = $g5plus_options['header_nav_text_color'];
					}
					break;
			}
		}

		$header->header_nav_bg_color = g5plus_hex2rgba($header->header_nav_bg_color_color, $header->header_nav_bg_color_opacity);

		// Set header nav layout
		$header->header_nav_layout_padding = '100';
		if ((!empty($page_id))) {
			$header_nav_layout = rwmb_meta($prefix . 'header_nav_layout', array(), $page_id);
			if (($header_nav_layout == '-1') || ($header_nav_layout === '')) {
				$header->header_nav_layout_padding = isset($g5plus_options['header_nav_layout_padding']) ? $g5plus_options['header_nav_layout_padding'] : '100';
			}
			else if ($header_nav_layout == 'nav-fullwith') {
				$header->header_nav_layout_padding = rwmb_meta($prefix . 'header_nav_layout_padding', array(), $page_id);
				if ($header->header_nav_layout_padding == '') {
					$header->header_nav_layout_padding = '100';
				}
			}

		}
		else {
			$header->header_nav_layout_padding = isset($g5plus_options['header_nav_layout_padding']) ? $g5plus_options['header_nav_layout_padding'] : '100';
			if ($header->header_nav_layout_padding == '') {
				$header->header_nav_layout_padding = '100';
			}
		}
		$header->header_nav_layout_padding .= 'px';


		// Set header navigation distance
		$header->header_nav_distance = rwmb_meta($prefix . 'header_nav_distance', array(), $page_id);
		if ($header->header_nav_distance == '') {
			if (isset($g5plus_options['header_nav_distance']) && isset($g5plus_options['header_nav_distance']['width']) && ($g5plus_options['header_nav_distance']['width'] != 'px')) {
				$header->header_nav_distance = $g5plus_options['header_nav_distance']['width'];
			}
		}
		else {
			$header->header_nav_distance = str_replace('px','', $header->header_nav_distance) . 'px';
		}
		if ($header->header_nav_distance == '') {
			$header->header_nav_distance = '45px';
		}

		$menu_sub_scheme = isset($g5plus_options['menu_sub_scheme']) ? $g5plus_options['menu_sub_scheme'] : 'light';
		$header->menu_sub_bg_color = '#F8F8F8';
		$header->menu_sub_text_color = '#222';
		switch ($menu_sub_scheme) {
			case 'gray':
				$header->menu_sub_bg_color = '#F8F8F8';
				$header->menu_sub_text_color = '#222';
				break;
			case 'light':
				$header->menu_sub_bg_color = '#fff';
				$header->menu_sub_text_color = '#333';
				break;
			case 'dark':
				$header->menu_sub_bg_color = '#222';
				$header->menu_sub_text_color = '#ededed';
				break;
			default:
				if (isset($g5plus_options['menu_sub_bg_color']) && ! empty($g5plus_options['menu_sub_bg_color'])) {
					$header->menu_sub_bg_color = $g5plus_options['menu_sub_bg_color'];
				}
				if (isset($g5plus_options['menu_sub_text_color']) && ! empty($g5plus_options['menu_sub_text_color'])) {
					$header->menu_sub_text_color = $g5plus_options['menu_sub_text_color'];
				}

				break;
		}

		$header->top_drawer_padding_top = '';
		$header->top_drawer_padding_bottom = '';
		if ((!empty($page_id))) {
			$header->top_drawer_padding_top = rwmb_meta($prefix . 'top_drawer_padding_top', array(), $page_id);
			$header->top_drawer_padding_bottom = rwmb_meta($prefix . 'top_drawer_padding_bottom', array(), $page_id);
		}

		if ($header->top_drawer_padding_top == '') {
			$header->top_drawer_padding_top = isset($g5plus_options['top_drawer_padding']) && isset($g5plus_options['top_drawer_padding']['padding-top'])
				? $g5plus_options['top_drawer_padding']['padding-top'] : '0';
		}
		if ($header->top_drawer_padding_bottom == '') {
			$header->top_drawer_padding_bottom = isset($g5plus_options['top_drawer_padding']) && isset($g5plus_options['top_drawer_padding']['padding-bottom'])
				? $g5plus_options['top_drawer_padding']['padding-bottom'] : '0';
		}

		$header->top_drawer_padding_top = str_replace('px', '', $header->top_drawer_padding_top) . 'px';
		$header->top_drawer_padding_bottom = str_replace('px', '', $header->top_drawer_padding_bottom) . 'px';

		return $header;
	}
}


// GET CUSTOM CSS VARIABLE FOOTER
//--------------------------------------------------
if (!function_exists('g5plus_custom_css_variable_footer')) {
	function g5plus_custom_css_variable_footer($page_id = 0) {
		global $g5plus_options;
		$prefix = 'g5plus_';

		$footer = (object)array();

		$footer->footer_bg_color = '#333';
		$footer->footer_bg_color_opacity = 1;

		$footer->footer_text_color = '#aaa';
		$footer->footer_heading_text_color = '#fff';

		$footer->bottom_bar_bg_color = '#333';
		$footer->bottom_bar_bg_color_opacity = 1;

		$footer->bottom_bar_text_color = '#777';

		// Set footer scheme
		$footer_scheme = g5plus_get_post_meta($page_id,$prefix . 'footer_scheme',true);
		if ((!empty($page_id)) && ($footer_scheme != '-1') && ($footer_scheme != '')) {
			switch ($footer_scheme) {
				case 'gray':
					$footer->footer_bg_color = '#f4f4f4';
					$footer->footer_text_color = '#545454';
					$footer->footer_heading_text_color = '#333333';
					$footer->bottom_bar_bg_color = '#f4f4f4';
					$footer->bottom_bar_text_color = '#333333';
					break;
				case 'light':
					$footer->footer_bg_color = '#ffffff';
					$footer->footer_text_color = '#999999';
					$footer->footer_heading_text_color = '#333333';
					$footer->bottom_bar_bg_color = '#ffffff';
					$footer->bottom_bar_text_color = '#999999';
					break;
				case 'dark':
					$footer->footer_bg_color = '#333';
					$footer->footer_text_color = '#aaa';
					$footer->footer_heading_text_color = '#fff';
					$footer->bottom_bar_bg_color = '#333';
					$footer->bottom_bar_text_color = '#777';
					break;
				default:
					$footer_bg_color = g5plus_get_post_meta($page_id, $prefix . 'footer_bg_color', true);
					if ($footer_bg_color != '') {
						$footer->footer_bg_color = $footer_bg_color;
					}

					$footer_bg_color_opacity = g5plus_get_post_meta($page_id,$prefix. 'footer_bg_color_opacity' , true);
					if ($footer_bg_color_opacity != '') {
						$footer->footer_bg_color_opacity = $footer_bg_color_opacity / 100.0;
					}

					$footer_text_color = g5plus_get_post_meta($page_id,$prefix. 'footer_text_color',true);
					if ($footer_text_color != '') {
						$footer->footer_text_color = $footer_text_color;
					}

					$footer_heading_text_color = g5plus_get_post_meta($page_id,$prefix. 'footer_heading_text_color',true);
					if ($footer_heading_text_color != '') {
						$footer->footer_heading_text_color = $footer_heading_text_color;
					}

					$bottom_bar_bg_color = g5plus_get_post_meta($page_id,$prefix. 'bottom_bar_bg_color',true);
					if ($bottom_bar_bg_color != '') {
						$footer->bottom_bar_bg_color = $bottom_bar_bg_color;
					}

					$bottom_bar_bg_color_opacity = g5plus_get_post_meta($page_id,$prefix. 'bottom_bar_bg_color_opacity' , true);
					if ($bottom_bar_bg_color_opacity != '') {
						$footer->bottom_bar_bg_color_opacity = $bottom_bar_bg_color_opacity / 100.0;
					}
					break;
			}
		} else {
			$footer_scheme = isset($g5plus_options['footer_scheme']) ? $g5plus_options['footer_scheme'] : 'dark';
			switch ($footer_scheme) {
				case 'gray':
					$footer->footer_bg_color = '#f4f4f4';
					$footer->footer_text_color = '#545454';
					$footer->footer_heading_text_color = '#333333';
					$footer->bottom_bar_bg_color = '#f4f4f4';
					$footer->bottom_bar_text_color = '#333333';
					break;
				case 'light':
					$footer->footer_bg_color = '#ffffff';
					$footer->footer_text_color = '#999999';
					$footer->footer_heading_text_color = '#333333';
					$footer->bottom_bar_bg_color = '#ffffff';
					$footer->bottom_bar_text_color = '#999999';
					break;
				case 'dark':
					$footer->footer_bg_color = '#333';
					$footer->footer_text_color = '#aaa';
					$footer->footer_heading_text_color = '#fff';
					$footer->bottom_bar_bg_color = '#333';
					$footer->bottom_bar_text_color = '#777';
					break;
				default:
					$footer_bg_color = isset($g5plus_options['footer_bg_color']) ? $g5plus_options['footer_bg_color'] : array();
					if ($footer_bg_color) {
						if (isset($footer_bg_color['color'])) {
							$footer->footer_bg_color = $footer_bg_color['color'];
						}
						if (isset($footer_bg_color['alpha'])) {
							$footer->footer_bg_color_opacity = $footer_bg_color['alpha'];
						}
					}


					$footer_text_color = isset($g5plus_options['footer_text_color']) ? $g5plus_options['footer_text_color'] : '';
					if ($footer_text_color != '') {
						$footer->footer_text_color = $footer_text_color;
					}

					$footer_heading_text_color = isset($g5plus_options['footer_heading_text_color']) ? $g5plus_options['footer_heading_text_color'] : '';
					if ($footer_heading_text_color != '') {
						$footer->footer_heading_text_color = $footer_heading_text_color;
					}



					$bottom_bar_bg_color = isset($g5plus_options['bottom_bar_bg_color']) ? $g5plus_options['bottom_bar_bg_color'] : array();
					if ($bottom_bar_bg_color) {
						if (isset($bottom_bar_bg_color['color'])) {
							$footer->bottom_bar_bg_color = $bottom_bar_bg_color['color'];
						}
						if (isset($bottom_bar_bg_color['alpha'])) {
							$footer->bottom_bar_bg_color_opacity = $bottom_bar_bg_color['alpha'];
						}
					}
					break;
			}
		}


		// get footer padding

		$footer->footer_padding_top = g5plus_get_post_meta($page_id,$prefix. 'footer_padding_top',true);
		if ($footer->footer_padding_top === '') {
			if (isset($g5plus_options['footer_padding']) && is_array($g5plus_options['footer_padding'])
				&& isset($g5plus_options['footer_padding']['padding-top']) && !(empty($g5plus_options['footer_padding']['padding-top']))) {
				$footer->footer_padding_top = $g5plus_options['footer_padding']['padding-top'];
			}
		} else {
			$footer->footer_padding_top .= 'px';
		}

		if (empty($footer->footer_padding_top)) {
			$footer->footer_padding_top = '100px';
		}

		$footer->footer_padding_bottom = g5plus_get_post_meta($page_id,$prefix. 'footer_padding_bottom',true);
		if ($footer->footer_padding_bottom === '') {
			if (isset($g5plus_options['footer_padding']) && is_array($g5plus_options['footer_padding'])
				&& isset($g5plus_options['footer_padding']['padding-bottom']) && !(empty($g5plus_options['footer_padding']['padding-bottom']))) {
				$footer->footer_padding_bottom = $g5plus_options['footer_padding']['padding-bottom'];
			}
		} else {
			$footer->footer_padding_bottom .= 'px';
		}

		if (empty($footer->footer_padding_bottom)) {
			$footer->footer_padding_bottom = '100px';
		}

		return $footer;

	}
}

// GET CUSTOM CSS VARIABLE
//--------------------------------------------------
if (!function_exists('g5plus_custom_css_variable')) {
	function g5plus_custom_css_variable($page_id = 0) {
		global $g5plus_options;
		$prefix = 'g5plus_';

		$top_drawer_bg_color = '#2f2f2f';
		if (isset($g5plus_options['top_drawer_bg_color']) && ! empty($g5plus_options['top_drawer_bg_color'])) {
			$top_drawer_bg_color = $g5plus_options['top_drawer_bg_color'];
		}

		$top_drawer_text_color = '#c5c5c5';
		if (isset($g5plus_options['top_drawer_text_color']) && ! empty($g5plus_options['top_drawer_text_color'])) {
			$top_drawer_text_color = $g5plus_options['top_drawer_text_color'];
		}

		$top_bar_bg_color = '#F9F9F9';
		$top_bar_text_color = '#878787';
		$primary_color = '#DDBE86';
		$link_color = '#e8aa00';
		$link_color_hover = '#e8aa00';
		$link_color_active = '#e8aa00';
		$enable_page_color = (!empty($page_id) && ($page_id !== 0)) ? rwmb_meta($prefix . 'enable_page_color', array(), $page_id) : '0';
		if ($enable_page_color == '1') {
			$primary_color = rwmb_meta($prefix . 'primary_color', array(), $page_id);
			$link_color = rwmb_meta($prefix . 'link_color', array(), $page_id);
			$link_color_hover = rwmb_meta($prefix . 'link_color_hover', array(), $page_id);
			$link_color_active = rwmb_meta($prefix . 'link_color_active', array(), $page_id);

			$top_bar_text_color = rwmb_meta($prefix . 'top_bar_text_color', array(), $page_id);
			$top_bar_bg_color = rwmb_meta($prefix . 'top_bar_bg_color', array(), $page_id);
			$top_bar_bg_color_opacity = rwmb_meta($prefix . 'top_bar_bg_color_opacity', array(), $page_id);
			$top_bar_bg_color = g5plus_hex2rgba($top_bar_bg_color, $top_bar_bg_color_opacity);
		}
		else {
			if (isset($g5plus_options['top_bar_bg_color']) && ! empty($g5plus_options['top_bar_bg_color'])) {
				if (isset($g5plus_options['top_bar_bg_color']['rgba'])) {
					$top_bar_bg_color = $g5plus_options['top_bar_bg_color']['rgba'];
				}
				elseif (isset($g5plus_options['top_bar_bg_color']['color'])) {
					$top_bar_bg_color = $g5plus_options['top_bar_bg_color']['color'];
				}
			}

			if (isset($g5plus_options['top_bar_text_color']) && ! empty($g5plus_options['top_bar_text_color'])) {
				$top_bar_text_color = $g5plus_options['top_bar_text_color'];
			}
			if (isset($g5plus_options['primary_color']) && ! empty($g5plus_options['primary_color'])) {
				$primary_color = $g5plus_options['primary_color'];
			}
			if (isset($g5plus_options['link_color']) && ! empty($g5plus_options['link_color']) && !empty($g5plus_options['link_color']['regular'])) {
				$link_color = $g5plus_options['link_color']['regular'];
			}
			if (isset($g5plus_options['link_color']) && ! empty($g5plus_options['link_color']) && !empty($g5plus_options['link_color']['hover'])) {
				$link_color_hover =  $g5plus_options['link_color']['hover'];
			}
			if (isset($g5plus_options['link_color']) && ! empty($g5plus_options['link_color']) && !empty($g5plus_options['link_color']['active'])) {
				$link_color_active = $g5plus_options['link_color']['active'];
			}
		}
		if (empty($top_bar_bg_color)) {
			$top_bar_bg_color = '#F9F9F9';
		}
		if (empty($top_bar_text_color)) {
			$top_bar_text_color = '#878787';
		}
		if (empty($primary_color)) {
			$primary_color = '#DDBE86';
		}
		if (empty($link_color)) {
			$link_color = '#e8aa00';
		}
		if (empty($link_color_hover)) {
			$link_color_hover = '#e8aa00';
		}
		if (empty($link_color_active)) {
			$link_color_active = '#e8aa00';
		}

		$secondary_color = '#444444';
		if (isset($g5plus_options['secondary_color']) && ! empty($g5plus_options['secondary_color'])) {
			$secondary_color = $g5plus_options['secondary_color'];
		}

		$text_color = '#888';
		if (isset($g5plus_options['text_color']) && ! empty($g5plus_options['text_color'])) {
			$text_color = $g5plus_options['text_color'];
		}


		$heading_color = '#1e1e1e';
		if (isset($g5plus_options['heading_color']) && ! empty($g5plus_options['heading_color'])) {
			$heading_color = $g5plus_options['heading_color'];
		}

		// Page Title
		//-------------------

		$page_title_bg_color = '#fff';
		if (isset($g5plus_options['page_title_bg_color']) && ! empty($g5plus_options['page_title_bg_color'])) {
			$page_title_bg_color = $g5plus_options['page_title_bg_color'];
		}

		$page_title_overlay_color = '#000';
		if (isset($g5plus_options['page_title_overlay_color']) && ! empty($g5plus_options['page_title_overlay_color'])) {
			$page_title_overlay_color = $g5plus_options['page_title_overlay_color'];
		}

		$page_title_overlay_opacity = '0.5';
		if (isset($g5plus_options['page_title_overlay_opacity']) && ! empty($g5plus_options['page_title_overlay_opacity'])) {
			$page_title_overlay_opacity = $g5plus_options['page_title_overlay_opacity']/100;
		}

		$logo_mobile_max_height = '42px';
		$logo_mobile_padding = '15px';
		$main_menu_mobile_height = '72px';

		$logo_mobile_matrix = array(
			'header-mobile-1' => array(72, 15),
			'header-mobile-2' => array(122, 25, 52),
			'header-mobile-3' => array(72, 15),
			'header-mobile-4' => array(72, 15),
			'header-mobile-5' => array(72, 15),
		);

		// GET logo_max_height, logo_padding
		$mobile_header_layout = isset($g5plus_options['mobile_header_layout']) ? $g5plus_options['mobile_header_layout'] : 'header-mobile-2';

		if (isset($logo_mobile_matrix[$mobile_header_layout])) {
			$logo_mobile_max_height = $logo_mobile_matrix[$mobile_header_layout][0] . 'px';
			$logo_mobile_padding = $logo_mobile_matrix[$mobile_header_layout][1] . 'px';
			if (isset($logo_mobile_matrix[$mobile_header_layout][2])) {
				$main_menu_mobile_height = $logo_mobile_matrix[$mobile_header_layout][2] . 'px';
			}
			else {
				$main_menu_mobile_height = ($logo_mobile_matrix[$mobile_header_layout][0] + $logo_mobile_matrix[$mobile_header_layout][1] * 2) . 'px';
			}
		}

		if (isset($g5plus_options['logo_mobile_max_height']) && isset($g5plus_options['logo_mobile_max_height']['height']) && ! empty($g5plus_options['logo_mobile_max_height']['height']) && ($g5plus_options['logo_mobile_max_height']['height'] != 'px')) {
			$logo_mobile_max_height = $g5plus_options['logo_mobile_max_height']['height'];
		}

		if (isset($g5plus_options['logo_mobile_padding']) && isset($g5plus_options['logo_mobile_padding']['height']) && ! empty($g5plus_options['logo_mobile_padding']['height']) && ($g5plus_options['logo_mobile_padding']['height'] != 'px')) {
			$logo_mobile_padding = $g5plus_options['logo_mobile_padding']['height'];
		}

		$fonts = g5plus_custom_css_variable_font();
		$logo = g5plus_custom_css_variable_logo($page_id);
		$header = g5plus_custom_css_variable_header($page_id);
		$footer = g5plus_custom_css_variable_footer($page_id);

		ob_start();

		echo "@top_drawer_bg_color:		$top_drawer_bg_color;", PHP_EOL;
		echo "@top_drawer_text_color:	$top_drawer_text_color;", PHP_EOL;
		echo "@top_bar_bg_color:		$top_bar_bg_color;", PHP_EOL;
		echo "@top_bar_text_color:		$top_bar_text_color;", PHP_EOL;
		echo "@primary_color:			$primary_color;", PHP_EOL;
		echo "@secondary_color:			$secondary_color;", PHP_EOL;
		echo "@text_color:				$text_color;", PHP_EOL;
		echo "@heading_color:			$heading_color;", PHP_EOL;


		echo "@footer_bg_color:			$footer->footer_bg_color;", PHP_EOL;
		echo "@footer_bg_color_opacity:			$footer->footer_bg_color_opacity;", PHP_EOL;
		echo "@footer_text_color:		$footer->footer_text_color;", PHP_EOL;
		echo "@footer_heading_text_color: $footer->footer_heading_text_color;", PHP_EOL;
		echo "@bottom_bar_bg_color:		$footer->bottom_bar_bg_color;", PHP_EOL;
		echo "@bottom_bar_bg_color_opacity:		$footer->bottom_bar_bg_color_opacity;", PHP_EOL;
		echo "@bottom_bar_text_color:	$footer->bottom_bar_text_color;", PHP_EOL;
		echo "@footer_padding_top:	$footer->footer_padding_top;", PHP_EOL;
		echo "@footer_padding_bottom:	$footer->footer_padding_bottom;", PHP_EOL;



		echo "@link_color:				$link_color;", PHP_EOL;
		echo "@link_color_hover:		$link_color_hover;", PHP_EOL;
		echo "@link_color_active:		$link_color_active;", PHP_EOL;
		echo "@menu_font:				'$fonts->menu_font';", PHP_EOL;
		echo "@secondary_font:			'$fonts->secondary_font';", PHP_EOL;
		echo "@primary_font:			'$fonts->primary_font';", PHP_EOL;

		echo "@page_title_bg_color:		$page_title_bg_color;", PHP_EOL;
		echo "@page_title_overlay_color:	$page_title_overlay_color;", PHP_EOL;
		echo "@page_title_overlay_opacity:	$page_title_overlay_opacity;", PHP_EOL;

		echo "@logo_max_height:	$logo->logo_max_height;", PHP_EOL;
		echo "@logo_padding_top:	$logo->logo_padding_top;", PHP_EOL;
		echo "@logo_padding_bottom:	$logo->logo_padding_bottom;", PHP_EOL;
		echo "@main_menu_height:	$logo->main_menu_height;", PHP_EOL;

		echo "@logo_mobile_max_height:	$logo_mobile_max_height;", PHP_EOL;
		echo "@logo_mobile_padding:	$logo_mobile_padding;", PHP_EOL;
		echo "@main_menu_mobile_height:	$main_menu_mobile_height;", PHP_EOL;

		echo "@header_nav_layout_padding:	$header->header_nav_layout_padding;", PHP_EOL;
		echo "@header_nav_distance:	$header->header_nav_distance;", PHP_EOL;
		echo "@header_nav_text_color:	$header->header_nav_text_color;", PHP_EOL;
		echo "@menu_sub_bg_color:	$header->menu_sub_bg_color;", PHP_EOL;
		echo "@menu_sub_text_color:	$header->menu_sub_text_color;", PHP_EOL;

		echo "@header_text_color: $header->header_text_color;", PHP_EOL;
		echo "@header_border_color: $header->header_border_color;", PHP_EOL;
		echo "@header_nav_bg_color: $header->header_nav_bg_color;", PHP_EOL;
		echo "@header_background_color: $header->header_background_color;", PHP_EOL;

		echo "@top_drawer_padding_top: $header->top_drawer_padding_top;", PHP_EOL;
		echo "@top_drawer_padding_bottom: $header->top_drawer_padding_bottom;", PHP_EOL;


		echo '@theme_url:"'. THEME_URL . '";', PHP_EOL;

		echo sprintf('%s', $header->header_background_css), PHP_EOL;

		return ob_get_clean();
	}
}

// GET CUSTOM CSS
//--------------------------------------------------
if (!function_exists('g5plus_custom_css')) {
	function g5plus_custom_css() {
		global $g5plus_options;
		$custom_css = '';
		$background_image_css = '';

		$body_background_mode = $g5plus_options['body_background_mode'];
		if ($body_background_mode == 'background') {
			$background_image_url = isset($g5plus_options['body_background']['background-image']) ? $g5plus_options['body_background']['background-image'] : '';
			$background_color = isset($g5plus_options['body_background']['background-color']) ? $g5plus_options['body_background']['background-color'] : '';

			if (!empty($background_color)) {
				$background_image_css .= 'background-color:' . $background_color . ';';
			}

			if (!empty($background_image_url)) {
				$background_repeat = isset($g5plus_options['body_background']['background-repeat']) ? $g5plus_options['body_background']['background-repeat'] : '';
				$background_position = isset($g5plus_options['body_background']['background-position']) ? $g5plus_options['body_background']['background-position'] : '';
				$background_size = isset($g5plus_options['body_background']['background-size']) ? $g5plus_options['body_background']['background-size'] : '';
				$background_attachment = isset($g5plus_options['body_background']['background-attachment']) ? $g5plus_options['body_background']['background-attachment'] : '';

				$background_image_css .= 'background-image: url("'. $background_image_url .'");';


				if (!empty($background_repeat)) {
					$background_image_css .= 'background-repeat: '. $background_repeat .';';
				}

				if (!empty($background_position)) {
					$background_image_css .= 'background-position: '. $background_position .';';
				}

				if (!empty($background_size)) {
					$background_image_css .= 'background-size: '. $background_size .';';
				}

				if (!empty($background_attachment)) {
					$background_image_css .= 'background-attachment: '. $background_attachment .';';
				}
			}

		}

		if ($body_background_mode == 'pattern') {
			$background_image_url = THEME_URL . 'assets/images/theme-options/' . $g5plus_options['body_background_pattern'];
			$background_image_css .= 'background-image: url("'. $background_image_url .'");';
			$background_image_css .= 'background-repeat: repeat;';
			$background_image_css .= 'background-position: center center;';
			$background_image_css .= 'background-size: auto;';
			$background_image_css .= 'background-attachment: scroll;';
		}

		if (!empty($background_image_css)) {
			$custom_css.= 'body{'.$background_image_css.'}';
		}



		if (isset($g5plus_options['custom_css'])) {
			$custom_css .=  $g5plus_options['custom_css'];
		}

		$custom_scroll = isset($g5plus_options['custom_scroll']) ? $g5plus_options['custom_scroll'] : 0;
		if ($custom_scroll == 1) {
			$custom_scroll_width = isset($g5plus_options['custom_scroll_width']) ? $g5plus_options['custom_scroll_width'] : '10';
			$custom_scroll_color = isset($g5plus_options['custom_scroll_color']) ? $g5plus_options['custom_scroll_color'] : '#333333';
			$custom_scroll_thumb_color = isset($g5plus_options['custom_scroll_thumb_color']) ? $g5plus_options['custom_scroll_thumb_color'] : '#e8aa00';

			$custom_css .= 'body::-webkit-scrollbar {width: '.$custom_scroll_width.'px;background-color: '.$custom_scroll_color .';}';
			$custom_css .= 'body::-webkit-scrollbar-thumb{background-color: '.$custom_scroll_thumb_color .';}';
		}

		$footer_bg_image = isset($g5plus_options['footer_bg_image']) && isset($g5plus_options['footer_bg_image']['url']) ?
			$g5plus_options['footer_bg_image']['url'] : '';

		if (!empty($footer_bg_image)) {
			$footer_bg_css = 'background-image:url(' . $footer_bg_image . ');';
			$footer_bg_css .= 'background-size: cover;';
			$footer_bg_css .= 'background-attachment: fixed;';
			$custom_css .= 'footer.main-footer-wrapper {' . $footer_bg_css . '}';
		}


		$custom_css = str_replace( "\r\n", '', $custom_css );
		$custom_css = str_replace( "\n", '', $custom_css );
		$custom_css = str_replace( "\t", '', $custom_css );
		return $custom_css;
	}
}

// UNREGISTER CUSTOM POST TYPES
//--------------------------------------------------
if (!function_exists('g5plus_unregister_post_type')) {
	function g5plus_unregister_post_type( $post_type, $slug = '' ) {
		global $g5plus_options, $wp_post_types;
		if ( isset( $g5plus_options['cpt-disable'] ) ) {
			$cpt_disable = $g5plus_options['cpt-disable'];
			if ( ! empty( $cpt_disable ) ) {
				foreach ( $cpt_disable as $post_type => $cpt ) {
					if ( $cpt == 1 && isset( $wp_post_types[ $post_type ] ) ) {
						unset( $wp_post_types[ $post_type ] );
					}
				}
			}
		}
	}
	add_action( 'init', 'g5plus_unregister_post_type', 20 );
}

// ADD HEADER CUSTOMIZE CSS
//--------------------------------------------------
if (!function_exists('g5plus_enqueue_header_custom_style')) {
	function g5plus_enqueue_header_custom_style() {
		if (is_singular()) {
			echo '<link rel="stylesheet" type="text/css" media="all" href="'. HOME_URL . '?custom-page=header-custom-css&amp;current_page_id=' . get_the_ID() . '"/>';
		}
	}
	add_action('wp_head', 'g5plus_enqueue_header_custom_style',100);
}
