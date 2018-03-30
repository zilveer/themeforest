<?php
// GET CUSTOM CSS VARIABLE FONT
//--------------------------------------------------
if (!function_exists('g5plus_custom_css_variable_font')) {
	function g5plus_custom_css_variable_font() {
		$g5plus_options = &G5Plus_Global::get_options();

		$fonts = (object)array();

		$fonts->primary_font = 'Montserrat';
		if (isset($g5plus_options['primary_font']) && ! empty($g5plus_options['primary_font']) && !empty($g5plus_options['primary_font']['font-family'])) {
			$fonts->primary_font = $g5plus_options['primary_font']['font-family'];
		}

		$fonts->secondary_font = 'Playfair Display';
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
		$g5plus_options = &G5Plus_Global::get_options();
		$prefix = 'g5plus_';

		$logo = (object)array();

		// GET logo_max_height, logo_padding
		$header_layout = '';
		if (!empty($page_id)) {
			$header_layout = rwmb_meta($prefix . 'header_layout', array(), $page_id);
		}
		if (($header_layout === '') || ($header_layout == '-1')) {
			$header_layout = $g5plus_options['header_layout'];
		}

		$logo->logo_max_height = '90px';
		$logo->logo_padding_top = '20px';
		$logo->logo_padding_bottom = '20px';
		$logo->main_menu_height = '90px';

		$logo_matrix = array(
			'header-1' => array(90, 20, 20),
			'header-2' => array(90, 20, 20),
			'header-3' => array(90, 20, 20),
			'header-4' => array(90, 20, 20, 60),
			'header-5' => array(90, 20, 20, 60),
			'header-6' => array(90, 20, 20, 60),
			'header-7' => array(216, 40, 60, 51),
			'header-8' => array(174, 20, 20, 70),
		);

		if (isset($logo_matrix[$header_layout])) {
			$logo->logo_max_height = $logo_matrix[$header_layout][0] . 'px';
			$logo->logo_padding_top = $logo_matrix[$header_layout][1] . 'px';
			$logo->logo_padding_bottom = $logo_matrix[$header_layout][2] . 'px';
			if (isset($logo_matrix[$header_layout][3])) {
				$logo->main_menu_height = $logo_matrix[$header_layout][3] . 'px';
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
					$logo->logo_max_height = $logo_matrix[$header_layout][0] . 'px';
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
					$logo->logo_padding_top = $logo_matrix[$header_layout][1] . 'px';
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
					$logo->logo_padding_bottom = $logo_matrix[$header_layout][2] . 'px';
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

		if (!isset($logo_matrix[$header_layout][3])) {
			$logo->main_menu_height = (str_replace('px', '', $logo->logo_max_height)) . 'px';
		}

		return $logo;
	}
}

// GET CUSTOM CSS VARIABLE HEADER
//--------------------------------------------------
if (!function_exists('g5plus_custom_css_variable_header')) {
	function g5plus_custom_css_variable_header($page_id = 0) {
		$g5plus_options = &G5Plus_Global::get_options();
		$prefix = 'g5plus_';

		$header = (object)array();

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

		return $header;
	}
}


// GET CUSTOM CSS VARIABLE FOOTER
//--------------------------------------------------
if (!function_exists('g5plus_custom_css_variable_footer')) {
	function g5plus_custom_css_variable_footer($page_id = 0) {
		$g5plus_options = &G5Plus_Global::get_options();
		$prefix = 'g5plus_';

		$footer = (object)array();

		$footer->footer_bg_color = '#333';
		$footer->footer_bg_color_opacity = 1;
		$footer->footer_main_overlay_color = '#1a1a1a';
		$footer->footer_main_overlay_opacity = 0;

		$footer->footer_text_color = '#8f8f8f';
		$footer->footer_heading_text_color = '#fff';

		$footer->bottom_bar_bg_color = '#333';
		$footer->bottom_bar_bg_color_opacity = 1;
		$footer->bottom_bar_text_color = '#444';

		$footer->footer_above_bg_color = '#ffffff';
		$footer->footer_above_bg_color_opacity = 1;
		$footer->footer_above_text_color = '#444444';

		// Set footer scheme
		$footer_scheme = g5plus_get_post_meta($page_id,$prefix . 'footer_scheme',true);
		if ((!empty($page_id)) && ($footer_scheme != '-1') && ($footer_scheme != '')) {
			switch ($footer_scheme) {
				case 'light':
					$footer->footer_bg_color = '#ffffff';
					$footer->footer_text_color = '#444444';
					$footer->footer_heading_text_color = '#444444';
					$footer->footer_above_bg_color = '#ffffff';
					$footer->footer_above_text_color = '#444444';
					$footer->bottom_bar_bg_color = '#ffffff';
					$footer->bottom_bar_text_color = '#444444';
					break;
				case 'dark':
					$footer->footer_bg_color = '#1a1a1a';
					$footer->footer_text_color = '#8f8f8f';
					$footer->footer_heading_text_color = '#FFFFFF';
					$footer->footer_above_bg_color = '#1a1a1a';
					$footer->footer_above_text_color = '#8f8f8f';
					$footer->bottom_bar_bg_color = '#1a1a1a';
					$footer->bottom_bar_text_color = '#8f8f8f';
					break;
				default:
					$footer_main_overlay_color = g5plus_get_post_meta($page_id, $prefix . 'footer_main_overlay_color', true);
					if ($footer_main_overlay_color != '') {
						$footer->footer_main_overlay_color = $footer_main_overlay_color;
					}

					$footer_main_overlay_opacity = g5plus_get_post_meta($page_id,$prefix. 'footer_main_overlay_opacity' , true);
					if ($footer_main_overlay_opacity != '') {
						$footer->footer_main_overlay_opacity = $footer_main_overlay_opacity / 100.0;
					}

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

					// FOOTER ABOVE
					//==============================================================================
					$footer_above_bg_color = g5plus_get_post_meta($page_id,$prefix. 'footer_above_bg_color',true);
					if ($footer_above_bg_color != '') {
						$footer->footer_above_bg_color = $footer_above_bg_color;
					}

					$footer_above_bg_color_opacity = g5plus_get_post_meta($page_id,$prefix. 'footer_above_bg_color_opacity' , true);
					if ($footer_above_bg_color_opacity != '') {
						$footer->footer_above_bg_color_opacity = $footer_above_bg_color_opacity / 100.0;
					}

					$footer_above_text_color = g5plus_get_post_meta($page_id,$prefix. 'footer_above_text_color',true);
					if ($footer_above_text_color != '') {
						$footer->footer_above_text_color = $footer_above_text_color;
					}

					// BOTTOM BAR
					//==============================================================================
					$bottom_bar_bg_color = g5plus_get_post_meta($page_id,$prefix. 'bottom_bar_bg_color',true);
					if ($bottom_bar_bg_color != '') {
						$footer->bottom_bar_bg_color = $bottom_bar_bg_color;
					}

					$bottom_bar_bg_color_opacity = g5plus_get_post_meta($page_id,$prefix. 'bottom_bar_bg_color_opacity' , true);
					if ($bottom_bar_bg_color_opacity != '') {
						$footer->bottom_bar_bg_color_opacity = $bottom_bar_bg_color_opacity / 100.0;
					}

					$bottom_bar_text_color = g5plus_get_post_meta($page_id,$prefix. 'bottom_bar_text_color',true);
					if ($bottom_bar_text_color != '') {
						$footer->bottom_bar_text_color = $bottom_bar_text_color;
					}
					break;
			}
		} else {
			$footer_scheme = isset($g5plus_options['footer_scheme']) ? $g5plus_options['footer_scheme'] : 'dark';
			switch ($footer_scheme) {
				case 'light':
					$footer->footer_bg_color = '#ffffff';
					$footer->footer_text_color = '#444444';
					$footer->footer_heading_text_color = '#444444';
					$footer->footer_above_bg_color = '#ffffff';
					$footer->footer_above_text_color = '#444444';
					$footer->bottom_bar_bg_color = '#ffffff';
					$footer->bottom_bar_text_color = '#444444';
					break;
				case 'dark':
					$footer->footer_bg_color = '#1a1a1a';
					$footer->footer_text_color = '#8f8f8f';
					$footer->footer_heading_text_color = '#FFFFFF';
					$footer->footer_above_bg_color = '#1a1a1a';
					$footer->footer_above_text_color = '#8f8f8f';
					$footer->bottom_bar_bg_color = '#1a1a1a';
					$footer->bottom_bar_text_color = '#8f8f8f';
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

					$footer_main_overlay = isset($g5plus_options['footer_main_overlay']) ? $g5plus_options['footer_main_overlay'] : array();
					if ($footer_main_overlay) {
						if (isset($footer_main_overlay['color'])) {
							$footer->footer_main_overlay_color = $footer_main_overlay['color'];
						}
						if (isset($footer_main_overlay['alpha'])) {
							$footer->footer_main_overlay_opacity = $footer_main_overlay['alpha'];
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

					$footer_above_bg_color = isset($g5plus_options['footer_above_bg_color']) ? $g5plus_options['footer_above_bg_color'] : array();
					if ($footer_above_bg_color) {
						if (isset($footer_above_bg_color['color'])) {
							$footer->footer_above_bg_color = $footer_above_bg_color['color'];
						}
						if (isset($footer_above_bg_color['alpha'])) {
							$footer->footer_above_bg_color_opacity = $footer_above_bg_color['alpha'];
						}
					}
					$footer_above_text_color = isset($g5plus_options['footer_above_text_color']) ? $g5plus_options['footer_above_text_color'] : '';
					if ($footer_above_text_color != '') {
						$footer->footer_above_text_color = $footer_above_text_color;
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
					$bottom_bar_text_color = isset($g5plus_options['bottom_bar_text_color']) ? $g5plus_options['bottom_bar_text_color'] : '';
					if ($bottom_bar_text_color != '') {
						$footer->bottom_bar_text_color = $bottom_bar_text_color;
					}
					break;
			}
		}


		// Footer Padding
		//==============================================================================
		$footer->footer_padding_top = g5plus_get_post_meta($page_id,$prefix. 'footer_padding_top',true);
		if ($footer->footer_padding_top === '') {
			if (isset($g5plus_options['footer_padding']) && is_array($g5plus_options['footer_padding'])
				&& isset($g5plus_options['footer_padding']['padding-top']) && ($g5plus_options['footer_padding']['padding-top'] != '')) {
				$footer->footer_padding_top = $g5plus_options['footer_padding']['padding-top'];
			}
		} else {
			$footer->footer_padding_top .= 'px';
		}

		if ($footer->footer_padding_top == '') {
			$footer->footer_padding_top = '15px';
		}

		$footer->footer_padding_bottom = g5plus_get_post_meta($page_id,$prefix. 'footer_padding_bottom',true);
		if ($footer->footer_padding_bottom === '') {
			if (isset($g5plus_options['footer_padding']) && is_array($g5plus_options['footer_padding'])
				&& isset($g5plus_options['footer_padding']['padding-bottom']) && ($g5plus_options['footer_padding']['padding-bottom'] != '')) {
				$footer->footer_padding_bottom = $g5plus_options['footer_padding']['padding-bottom'];
			}
		} else {
			$footer->footer_padding_bottom .= 'px';
		}

		if ($footer->footer_padding_bottom == '') {
			$footer->footer_padding_bottom = '30px';
		}

		// Footer Above Padding
		//==============================================================================
		$footer->footer_above_padding_top = g5plus_get_post_meta($page_id,$prefix. 'footer_above_padding_top',true);
		if ($footer->footer_above_padding_top === '') {
			if (isset($g5plus_options['footer_above_padding']) && is_array($g5plus_options['footer_above_padding'])
				&& isset($g5plus_options['footer_above_padding']['padding-top']) && ($g5plus_options['footer_above_padding']['padding-top'] != '')) {
				$footer->footer_above_padding_top = $g5plus_options['footer_above_padding']['padding-top'];
			}
		} else {
			$footer->footer_above_padding_top .= 'px';
		}

		if ($footer->footer_above_padding_top == '') {
			$footer->footer_above_padding_top = '0';
		}

		$footer->footer_above_padding_bottom = g5plus_get_post_meta($page_id,$prefix. 'footer_above_padding_bottom',true);
		if ($footer->footer_above_padding_bottom === '') {
			if (isset($g5plus_options['footer_above_padding']) && is_array($g5plus_options['footer_above_padding'])
				&& isset($g5plus_options['footer_above_padding']['padding-bottom']) && ($g5plus_options['footer_above_padding']['padding-bottom'] != '')) {
				$footer->footer_above_padding_bottom = $g5plus_options['footer_above_padding']['padding-bottom'];
			}
		} else {
			$footer->footer_above_padding_bottom .= 'px';
		}

		if ($footer->footer_above_padding_bottom == '') {
			$footer->footer_above_padding_bottom = '30px';
		}

		// Footer Above Padding
		//==============================================================================
		$footer->bottom_bar_padding_top = g5plus_get_post_meta($page_id,$prefix. 'bottom_bar_padding_top',true);
		if ($footer->bottom_bar_padding_top === '') {
			if (isset($g5plus_options['bottom_bar_padding']) && is_array($g5plus_options['bottom_bar_padding'])
				&& isset($g5plus_options['bottom_bar_padding']['padding-top']) && ($g5plus_options['bottom_bar_padding']['padding-top'] != '')) {
				$footer->bottom_bar_padding_top = $g5plus_options['bottom_bar_padding']['padding-top'];
			}
		} else {
			$footer->bottom_bar_padding_top .= 'px';
		}

		if ($footer->bottom_bar_padding_top == '') {
			$footer->bottom_bar_padding_top = '20px';
		}

		$footer->bottom_bar_padding_bottom = g5plus_get_post_meta($page_id,$prefix. 'bottom_bar_padding_bottom',true);
		if ($footer->bottom_bar_padding_bottom === '') {
			if (isset($g5plus_options['bottom_bar_padding']) && is_array($g5plus_options['bottom_bar_padding'])
				&& isset($g5plus_options['bottom_bar_padding']['padding-bottom']) && ($g5plus_options['bottom_bar_padding']['padding-bottom'] != '')) {
				$footer->bottom_bar_padding_bottom = $g5plus_options['bottom_bar_padding']['padding-bottom'];
			}
		} else {
			$footer->bottom_bar_padding_bottom .= 'px';
		}

		if ($footer->bottom_bar_padding_bottom == '') {
			$footer->bottom_bar_padding_bottom = '20px';
		}

		return $footer;

	}
}

// GET CUSTOM CSS VARIABLE
//--------------------------------------------------
if (!function_exists('g5plus_custom_css_variable')) {
	function g5plus_custom_css_variable($page_id = 0) {
		$g5plus_options = &G5Plus_Global::get_options();
		$prefix = 'g5plus_';

		$primary_color = G5Plus_Global::get_option('primary_color', '#925FAA');
		$secondary_color = G5Plus_Global::get_option('secondary_color', '#FFBD20');
		$tertiary_color = G5Plus_Global::get_option('tertiary_color', '#27A7CC');
		$text_color = G5Plus_Global::get_option('text_color', '#868686');
		$heading_color = G5Plus_Global::get_option('heading_color', '#222222');
		$top_drawer_bg_color = G5Plus_Global::get_option('top_drawer_bg_color', '#2f2f2f');
		$top_drawer_text_color = G5Plus_Global::get_option('top_drawer_text_color', '#c5c5c5');

		// Page Title
		//-------------------
		$page_title_padding = G5Plus_Global::get_option('page_title_padding');
		$page_title_padding_top = '270px';
		if (($page_title_padding !== null) && isset($page_title_padding['padding-top']) && ($page_title_padding['padding-top'] !== '') && ($page_title_padding['padding-top'] != 'px')) {
			$page_title_padding_top = $page_title_padding['padding-top'];
		}
		$page_title_padding_bottom = '0px';
		if (($page_title_padding !== null) && isset($page_title_padding['padding-bottom']) && ($page_title_padding['padding-bottom'] !== '') && ($page_title_padding['padding-bottom'] != 'px')) {
			$page_title_padding_bottom = $page_title_padding['padding-bottom'];
		}

		$page_title_margin_bottom = isset($g5plus_options['page_title_margin']['margin-bottom']) ? $g5plus_options['page_title_margin']['margin-bottom'] : '60px';
		if($page_title_margin_bottom == 'px') {
			$page_title_margin_bottom = '60px';
		}

		$page_title_color = '#fff';
		if (isset($g5plus_options['page_title_color']) && !empty($g5plus_options['page_title_color'])) {
			$page_title_color = $g5plus_options['page_title_color'];
		}

		$page_title_bg_color = 'rgba(0,0,0,0)';
		if (isset($g5plus_options['page_title_bg_color']['rgba']) && !empty($g5plus_options['page_title_bg_color']['rgba'])) {
			$page_title_bg_color = $g5plus_options['page_title_bg_color']['rgba'];
		}

		// Single Blog Title
		//-------------------
		$single_blog_title_padding_top = isset($g5plus_options['single_blog_title_padding']['padding-top']) ? $g5plus_options['single_blog_title_padding']['padding-top'] : '90px';
		if($single_blog_title_padding_top == 'px') {
			$single_blog_title_padding_top = '270px';
		}

		$single_blog_title_padding_bottom = isset($g5plus_options['single_blog_title_padding']['padding-bottom']) ? $g5plus_options['single_blog_title_padding']['padding-bottom'] : '0px';
		if($single_blog_title_padding_bottom == 'px') {
			$single_blog_title_padding_bottom = '0px';
		}

		$single_blog_title_margin_bottom = isset($g5plus_options['single_blog_title_margin']['margin-bottom']) ? $g5plus_options['single_blog_title_margin']['margin-bottom'] : '60px';
		if($single_blog_title_margin_bottom == 'px') {
			$single_blog_title_margin_bottom = '60px';
		}

		$single_blog_title_color = '#fff';
		if (isset($g5plus_options['single_blog_title_color']) && !empty($g5plus_options['single_blog_title_color'])) {
			$single_blog_title_color = $g5plus_options['single_blog_title_color'];
		}

		$single_blog_title_bg_color = 'rgba(0,0,0,0)';
		if (isset($g5plus_options['single_blog_title_bg_color']['rgba']) && !empty($g5plus_options['single_blog_title_bg_color']['rgba'])) {
			$single_blog_title_bg_color = $g5plus_options['single_blog_title_bg_color']['rgba'];
		}

		// Single Product Title
		//-------------------
		$single_product_title_padding_top = isset($g5plus_options['single_product_title_padding']['padding-top']) ? $g5plus_options['single_product_title_padding']['padding-top'] : '90px';
		if($single_product_title_padding_top == 'px') {
			$single_product_title_padding_top = '270px';
		}
		$single_product_title_padding_bottom = isset($g5plus_options['single_product_title_padding']['padding-bottom']) ? $g5plus_options['single_product_title_padding']['padding-bottom'] : '0px';
		if($single_product_title_padding_bottom == 'px') {
			$single_product_title_padding_bottom = '0px';
		}

		$single_product_title_margin_bottom = isset($g5plus_options['single_product_title_margin']['margin-bottom']) ? $g5plus_options['single_product_title_margin']['margin-bottom'] : '60px';
		if($single_product_title_margin_bottom == 'px') {
			$single_product_title_margin_bottom = '60px';
		}

		$single_product_title_color = '#fff';
		if (isset($g5plus_options['single_product_title_color']) && !empty($g5plus_options['single_product_title_color'])) {
			$single_product_title_color = $g5plus_options['single_product_title_color'];
		}

		$single_product_title_bg_color = 'rgba(0,0,0,0)';
		if (isset($g5plus_options['single_product_title_bg_color']['rgba']) && !empty($g5plus_options['single_product_title_bg_color']['rgba'])) {
			$single_product_title_bg_color = $g5plus_options['single_product_title_bg_color']['rgba'];
		}
		//sing event
		$single_event_title_padding_top = isset($g5plus_options['single_event_title_padding']['padding-top']) ? $g5plus_options['single_event_title_padding']['padding-top'] : '90px';
		if($single_event_title_padding_top == 'px') {
			$single_event_title_padding_top = '270px';
		}
		$single_event_title_padding_bottom = isset($g5plus_options['single_event_title_padding']['padding-bottom']) ? $g5plus_options['single_event_title_padding']['padding-bottom'] : '0px';
		if($single_event_title_padding_bottom == 'px') {
			$single_event_title_padding_bottom = '0px';
		}

		$single_event_title_margin_bottom = isset($g5plus_options['single_event_title_margin']['margin-bottom']) ? $g5plus_options['single_event_title_margin']['margin-bottom'] : '60px';
		if($single_event_title_margin_bottom == 'px') {
			$single_event_title_margin_bottom = '60px';
		}

		$single_event_title_color = '#fff';
		if (isset($g5plus_options['single_event_title_color']) && !empty($g5plus_options['single_event_title_color'])) {
			$single_event_title_color = $g5plus_options['single_event_title_color'];
		}

		$single_event_title_bg_color = 'rgba(0,0,0,0)';
		if (isset($g5plus_options['single_event_title_bg_color']['rgba']) && !empty($g5plus_options['single_event_title_bg_color']['rgba'])) {
			$single_event_title_bg_color = $g5plus_options['single_event_title_bg_color']['rgba'];
		}

		// Archive Title
		//-------------------
		$archive_title_padding_top = isset($g5plus_options['archive_title_padding']['padding-top']) ? $g5plus_options['archive_title_padding']['padding-top'] : '90px';
		if($archive_title_padding_top == 'px') {
			$archive_title_padding_top = '270px';
		}
		$archive_title_padding_bottom = isset($g5plus_options['archive_title_padding']['padding-bottom']) ? $g5plus_options['archive_title_padding']['padding-bottom'] : '0px';
		if($archive_title_padding_bottom == 'px') {
			$archive_title_padding_bottom = '0px';
		}

		$archive_title_margin_bottom = isset($g5plus_options['archive_title_margin']['margin-bottom']) ? $g5plus_options['archive_title_margin']['margin-bottom'] : '60px';
		if($archive_title_margin_bottom == 'px') {
			$archive_title_margin_bottom = '60px';
		}

		$archive_title_color = '#fff';
		if (isset($g5plus_options['archive_title_color']) && !empty($g5plus_options['archive_title_color'])) {
			$archive_title_color = $g5plus_options['archive_title_color'];
		}

		$archive_title_bg_color = 'rgba(0,0,0,0)';
		if (isset($g5plus_options['archive_title_bg_color']['rgba']) && !empty($g5plus_options['archive_title_bg_color']['rgba'])) {
			$archive_title_bg_color = $g5plus_options['archive_title_bg_color']['rgba'];
		}


		// Archive Product Title
		//-------------------
		$archive_product_title_padding_top = isset($g5plus_options['archive_product_title_padding']['padding-top']) ? $g5plus_options['archive_product_title_padding']['padding-top'] : '120px';
		if($archive_product_title_padding_top == 'px') {
			$archive_product_title_padding_top = '270px';
		}

		$archive_product_title_padding_bottom = isset($g5plus_options['archive_product_title_padding']['padding-bottom']) ? $g5plus_options['archive_product_title_padding']['padding-bottom'] : '0px';
		if($archive_product_title_padding_bottom == 'px') {
			$archive_product_title_padding_bottom = '0px';
		}

		$archive_product_title_margin_bottom = isset($g5plus_options['archive_product_title_margin']['margin-bottom']) ? $g5plus_options['archive_product_title_margin']['margin-bottom'] : '60px';
		if($archive_product_title_margin_bottom == 'px') {
			$archive_product_title_margin_bottom = '60px';
		}

		$archive_product_title_color = '#fff';
		if (isset($g5plus_options['archive_product_title_color']) && !empty($g5plus_options['archive_product_title_color'])) {
			$archive_product_title_color = $g5plus_options['archive_product_title_color'];
		}

		$archive_product_title_bg_color = 'rgba(0,0,0,0)';
		if (isset($g5plus_options['archive_product_title_bg_color']['rgba']) && !empty($g5plus_options['archive_product_title_bg_color']['rgba'])) {
			$archive_product_title_bg_color = $g5plus_options['archive_product_title_bg_color']['rgba'];
		}
		// Archive Event Title
		//-------------------
		$archive_event_title_padding_top = isset($g5plus_options['archive_event_title_padding']['padding-top']) ? $g5plus_options['archive_event_title_padding']['padding-top'] : '120px';
		if($archive_event_title_padding_top == 'px') {
			$archive_event_title_padding_top = '270px';
		}

		$archive_event_title_padding_bottom = isset($g5plus_options['archive_event_title_padding']['padding-bottom']) ? $g5plus_options['archive_event_title_padding']['padding-bottom'] : '0px';
		if($archive_event_title_padding_bottom == 'px') {
			$archive_event_title_padding_bottom = '0px';
		}

		$archive_event_title_margin_bottom = isset($g5plus_options['archive_event_title_margin']['margin-bottom']) ? $g5plus_options['archive_event_title_margin']['margin-bottom'] : '60px';
		if($archive_event_title_margin_bottom == 'px') {
			$archive_event_title_margin_bottom = '60px';
		}

		$archive_event_title_color = '#fff';
		if (isset($g5plus_options['archive_event_title_color']) && !empty($g5plus_options['archive_event_title_color'])) {
			$archive_event_title_color = $g5plus_options['archive_event_title_color'];
		}

		$archive_event_title_bg_color = 'rgba(0,0,0,0)';
		if (isset($g5plus_options['archive_event_title_bg_color']['rgba']) && !empty($g5plus_options['archive_event_title_bg_color']['rgba'])) {
			$archive_event_title_bg_color = $g5plus_options['archive_event_title_bg_color']['rgba'];
		}


		$logo_mobile_max_height = '92px';
		$logo_mobile_padding = '15px';
		$main_menu_mobile_height = '92px';

		$logo_mobile_matrix = array(
			'header-mobile-1' => array(92, 15),
			'header-mobile-2' => array(92, 15),
			'header-mobile-3' => array(92, 15),
			'header-mobile-4' => array(112, 15),
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

		// GET RESPONSIVE BREAKPOINT
		$responsive_breakpoint = '992px';
		if (isset($g5plus_options['mobile_header_responsive_breakpoint']) && !empty($g5plus_options['mobile_header_responsive_breakpoint'])) {
			$responsive_breakpoint = $g5plus_options['mobile_header_responsive_breakpoint'] . 'px';
		}

		$fonts = g5plus_custom_css_variable_font();
		$logo = g5plus_custom_css_variable_logo($page_id);
		$header = g5plus_custom_css_variable_header($page_id);
		$footer = g5plus_custom_css_variable_footer($page_id);

		$theme_url = G5PLUS_THEME_URL;
		return <<<LESS_VARIABLE
			@responsive_breakpoint:	$responsive_breakpoint;
			@top_drawer_bg_color:	$top_drawer_bg_color;
			@top_drawer_text_color:	$top_drawer_text_color;
			@p_color:               $primary_color;
			@s_color:               $secondary_color;
			@t_color:               $tertiary_color;
			@text_color:			$text_color;
			@heading_color:			$heading_color;
			@footer_bg_color:		$footer->footer_bg_color;
			@footer_bg_color_opacity:	$footer->footer_bg_color_opacity;
			@footer_main_overlay_color:	$footer->footer_main_overlay_color;
			@footer_main_overlay_opacity: $footer->footer_main_overlay_opacity;
			@footer_text_color:		    $footer->footer_text_color;
			@footer_heading_text_color: $footer->footer_heading_text_color;
			@footer_above_bg_color:     $footer->footer_above_bg_color;
			@footer_above_bg_color_opacity:	$footer->footer_above_bg_color_opacity;
			@footer_above_text_color:	    $footer->footer_above_text_color;
			@bottom_bar_bg_color:		    $footer->bottom_bar_bg_color;
			@bottom_bar_bg_color_opacity:	$footer->bottom_bar_bg_color_opacity;
			@bottom_bar_text_color:	    $footer->bottom_bar_text_color;
			@footer_padding_top:	    $footer->footer_padding_top;
			@footer_padding_bottom:	    $footer->footer_padding_bottom;
			@footer_above_padding_top:	$footer->footer_above_padding_top;
			@footer_above_padding_bottom:	$footer->footer_above_padding_bottom;
			@bottom_bar_padding_top:	$footer->bottom_bar_padding_top;
			@bottom_bar_padding_bottom:	$footer->bottom_bar_padding_bottom;
			@s_font:			'$fonts->secondary_font';
			@p_font:			'$fonts->primary_font';
			@logo_max_height:	$logo->logo_max_height;
			@logo_padding_top:	$logo->logo_padding_top;
			@logo_padding_bottom:	$logo->logo_padding_bottom;
			@main_menu_height:	$logo->main_menu_height;
			@logo_mobile_max_height:	$logo_mobile_max_height;
			@logo_mobile_padding:	$logo_mobile_padding;
			@main_menu_mobile_height:	$main_menu_mobile_height;
			@header_nav_layout_padding:	$header->header_nav_layout_padding;
			@header_nav_distance:	$header->header_nav_distance;

			@page_title_padding_top: $page_title_padding_top;
			@page_title_padding_bottom: $page_title_padding_bottom;
			@page_title_margin_bottom: $page_title_margin_bottom;
			@page_title_color: $page_title_color;
			@page_title_bg_color: $page_title_bg_color;

			@single_blog_title_padding_top: $single_blog_title_padding_top;
			@single_blog_title_padding_bottom: $single_blog_title_padding_bottom;
			@single_blog_title_margin_bottom: $single_blog_title_margin_bottom;
			@single_blog_title_color: $single_blog_title_color;
			@single_blog_title_bg_color: $single_blog_title_bg_color;


			@single_product_title_padding_top: $single_product_title_padding_top;
			@single_product_title_padding_bottom: $single_product_title_padding_bottom;
			@single_product_title_margin_bottom: $single_product_title_margin_bottom;
			@single_product_title_color: $single_product_title_color;
			@single_product_title_bg_color: $single_product_title_bg_color;

			@single_event_title_padding_top: $single_event_title_padding_top;
			@single_event_title_padding_bottom: $single_event_title_padding_bottom;
			@single_event_title_margin_bottom: $single_event_title_margin_bottom;
			@single_event_title_color: $single_event_title_color;
			@single_event_title_bg_color: $single_event_title_bg_color;

			@archive_title_padding_top: $archive_title_padding_top;
			@archive_title_padding_bottom: $archive_title_padding_bottom;
			@archive_title_margin_bottom: $archive_title_margin_bottom;
			@archive_title_color: $archive_title_color;
			@archive_title_bg_color: $archive_title_bg_color;

			@archive_product_title_padding_top: $archive_product_title_padding_top;
			@archive_product_title_padding_bottom: $archive_product_title_padding_bottom;
			@archive_product_title_margin_bottom: $archive_product_title_margin_bottom;
			@archive_product_title_color: $archive_product_title_color;
			@archive_product_title_bg_color: $archive_product_title_bg_color;

			@archive_event_title_padding_top: $archive_event_title_padding_top;
			@archive_event_title_padding_bottom: $archive_event_title_padding_bottom;
			@archive_event_title_margin_bottom: $archive_event_title_margin_bottom;
			@archive_event_title_color: $archive_event_title_color;
			@archive_event_title_bg_color: $archive_event_title_bg_color;


			@theme_url:'$theme_url';
LESS_VARIABLE;
	}
}

// GET CUSTOM CSS
//--------------------------------------------------
if (!function_exists('g5plus_custom_css')) {
	function g5plus_custom_css() {
		$g5plus_options = &G5Plus_Global::get_options();
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
			$background_image_url = G5PLUS_THEME_URL . 'assets/images/theme-options/' . $g5plus_options['body_background_pattern'];
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
		global $wp_post_types;
		$g5plus_options = &G5Plus_Global::get_options();
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
			echo '<link rel="stylesheet" type="text/css" media="all" href="'. G5PLUS_HOME_URL . '?custom-page=header-custom-css&amp;current_page_id=' . get_the_ID() . '"/>';
		}
	}
	add_action('wp_head', 'g5plus_enqueue_header_custom_style',100);
}

// GET LOGO URL
if (!function_exists('g5plus_get_logo_url')) {
	function g5plus_get_logo_url($logo_id) {
		$g5plus_options = &G5Plus_Global::get_options();

		$prefix = 'g5plus_';
		$logo_meta_id = rwmb_meta($prefix . $logo_id);
		$logo_meta = rwmb_meta($prefix . $logo_id, 'type=image_advanced');
		$logo_url = '';
		if ($logo_meta !== array() && isset($logo_meta[$logo_meta_id]) && isset($logo_meta[$logo_meta_id]['full_url'])) {
			$logo_url = $logo_meta[$logo_meta_id]['full_url'];
		}

		if ($logo_url === '') {
			if (isset($g5plus_options[$logo_id]['url']) && !empty($g5plus_options[$logo_id]['url'])) {
				$logo_url = $g5plus_options[$logo_id]['url'];
			}
		}
		return $logo_url;
	}
}
//POST VIEW COUNT
add_action('template_redirect', 'g5plus_post_views_counter', 999);
function g5plus_post_views_counter() {
	global $post;
	// Is it a single post
	if ( is_single() ) {
		// Check if user already visited this page
		$visited_posts = array();
		// Check cookie for list of visited posts
		if ( isset($_COOKIE['post_views']) ) {
			// We expect list of comma separated post ids in the cookie
			$visited_posts = array_map('intval', explode(',', $_COOKIE['post_views']) );
		}
		if ( in_array($post->ID, $visited_posts) ) {
			// User already visited this post
			return;
		}
		// The visitor is reading this post first time, so we count
		// Get current view count
		$views = (int)get_post_meta( $post->ID, 'post_views_count', true );
		// Increase by one and save
		update_post_meta( $post->ID, 'post_views_count', $views + 1 );
		// Add post id and set cookie
		$visited_posts[] = $post->ID;
		// Set cookie for one year, it shoudl be set on all pages se we use / as path
		setcookie('post_views', implode(',',$visited_posts), time()+3600*365, '/');
	}
}
if ( !function_exists('g5plus_get_post_views') ) {
	function g5plus_get_post_views($post_id = null) {
		global $post;
		/**
		 * If no given post id, then current post
		 */
		if ( !$post_id && isset($post->ID) ) {
			$post_id = $post->ID;
		}
		if ( !$post_id ) {
			return 0;
		}
		$views = get_post_meta( $post_id, 'post_views_count', true );
		return intval($views);
	}
}