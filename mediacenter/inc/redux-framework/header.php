<?php
/**
 * Functions for implementing Header options
 *
 * @package mediacenter
 */

if( ! function_exists( 'rx_apply_site_favicon' ) ) {
	function rx_apply_site_favicon( $favicon_url ) {
		global $media_center_theme_options;

		if( ! empty( $media_center_theme_options['favicon']['url'] ) ) {
			$favicon_url = $media_center_theme_options['favicon']['url'];
		}

		return $favicon_url;
	}
}

if( ! function_exists( 'rx_apply_header_logo' ) ) {
	function rx_apply_header_logo( $logo ) {
		global $media_center_theme_options;

		if ( ! empty( $media_center_theme_options['use_text_logo'] ) && $media_center_theme_options['use_text_logo'] == '1' ){
			$logo = '<span class="logo-text">' . $media_center_theme_options['logo_text'] . '</span>';
		} elseif ( ! empty( $media_center_theme_options['site_logo']['url'] ) ) {
			$media_center_site_logo = $media_center_theme_options['site_logo'];
			$logo = '<img alt="logo" src="' . $media_center_site_logo['url'] . '" width="' . $media_center_site_logo['width'] . '" height="' . $media_center_site_logo['height'] . '"/>';
		}
	    
	    return $logo;
	}
}

if( ! function_exists( 'rx_apply_header_style' ) ) {
	/**
	 * Header Style
	 */
	function rx_apply_header_style( $header ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['header_style'] ) ) {
			$header = $media_center_theme_options['header_style'];
		}

		return $header;
	}
}

if( ! function_exists( 'rx_toggle_sticky_header' ) ) {
	/**
	 * Sticky Header
	 */
	function rx_toggle_sticky_header( $is_sticky ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['sticky_header'] ) ) {
			$is_sticky = $media_center_theme_options['sticky_header'];
		}

		return $is_sticky;
	}
}

if( ! function_exists( 'rx_toggle_scroll_to_top' ) ) {
	/**
	 * Scroll to top
	 */
	function rx_toggle_scroll_to_top( $is_scroll_to_top ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['scroll_to_top'] ) ) {
			$is_scroll_to_top = $media_center_theme_options['scroll_to_top'];
		}

		return $is_scroll_to_top;
	}
}

if( ! function_exists( 'rx_toggle_live_search' ) ) {
	/**
	 * Live Search
	 */
	function rx_toggle_live_search( $is_live_search ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['live_search'] ) ) {
			$is_live_search = $media_center_theme_options['live_search'];
		}

		return $is_live_search;
	}
}

if( ! function_exists( 'rx_apply_live_search_template' ) ) {
	/**
	 * Live Search Template
	 */
	function rx_apply_live_search_template( $template ) {
		global $media_center_theme_options;
		
		if( ! empty( $media_center_theme_options['live_search_template'] ) ) {
			$template = $media_center_theme_options['live_search_template'];
		}

		return $template;
	}
}

if( ! function_exists( 'rx_toggle_search_dropdown_categories' ) ) {
	/**
	 * Enable/Disables search dropdown categories
	 */
	function rx_toggle_search_dropdown_categories( $enable ) {
		global $media_center_theme_options;

		if( array_key_exists ( 'display_search_categories_filter', $media_center_theme_options ) && '0' === $media_center_theme_options[ 'display_search_categories_filter' ] ) {
			$enable = false;
		}

		return $enable;
	}
}

if( ! function_exists( 'rx_modify_search_dropdown_categories_args' ) ) {
	/**
	 * Implements top level or all categories option
	 */
	function rx_modify_search_dropdown_categories_args( $args ) {
		global $media_center_theme_options;

		if( array_key_exists ( 'header_search_dropdown', $media_center_theme_options ) && 'hsd1' === $media_center_theme_options[ 'header_search_dropdown' ] ) {
			$args[ 'hierarchical' ] = 1;
		} else {
			$args[ 'hierarchical' ] = 1;
			$args[ 'depth' ] 		= 1;
		}

		return $args;
	}
}

if( ! function_exists( 'rx_toggle_top_bar_switch' ) ) {
	/**
	 * Top bar enable
	 */
	function rx_toggle_top_bar_switch( $enable ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['top_bar_switch'] ) ) {
			$enable = $media_center_theme_options['top_bar_switch'];
		}

		return $enable;
	}
}

if( ! function_exists( 'rx_toggle_top_bar_left_switch' ) ) {
	/**
	 * Top bar left enable
	 */
	function rx_toggle_top_bar_left_switch( $enable ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['top_bar_left_switch'] ) ) {
			$enable = $media_center_theme_options['top_bar_left_switch'];
		}

		return $enable;
	}
}

if( ! function_exists( 'rx_toggle_top_bar_right_switch' ) ) {
	/**
	 * Top bar right enable
	 */
	function rx_toggle_top_bar_right_switch( $enable ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['top_bar_right_switch'] ) ) {
			$enable = $media_center_theme_options['top_bar_right_switch'];
		}

		return $enable;
	}
}

if( ! function_exists( 'rx_toggle_top_bar_on_mobile' ) ) {
	/**
	 * Top bar mobile enable
	 */
	function rx_toggle_top_bar_on_mobile( $enable ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['hide_top_bar_on_mobile'] ) ) {
			if( $media_center_theme_options['hide_top_bar_on_mobile'] === '1' ) {
				$enable = true;
			} else {
				$enable = false;
			}
		}

		return $enable;
	}
}

if( ! function_exists( 'rx_toggle_top_bar_left_language_switcher' ) ) {
	/**
	 * Language Switcher enable
	 */
	function rx_toggle_top_bar_left_language_switcher( $enable ) {
		global $media_center_theme_options;

		if( isset( $media_center_theme_options['language_switcher_position'] ) && isset( $media_center_theme_options['enable_language_switcher'] ) ) {
			if( $media_center_theme_options['language_switcher_position'] == 'top_bar_left' ) {
				$enable = $media_center_theme_options['enable_language_switcher'];
			} else{
				$enable = false;
			}
		}

		return $enable;
	}
}

if( ! function_exists( 'rx_toggle_top_bar_right_language_switcher' ) ) {
	/**
	 * Language Switcher enable
	 */
	function rx_toggle_top_bar_right_language_switcher( $enable ) {
		global $media_center_theme_options;

		if( isset( $media_center_theme_options['language_switcher_position'] ) && isset( $media_center_theme_options['enable_language_switcher'] ) ) {
			if( $media_center_theme_options['language_switcher_position'] == 'top_bar_right' ) {
				$enable = $media_center_theme_options['enable_language_switcher'];
			} else{
				$enable = false;
			}
		}

		return $enable;
	}
}

if( ! function_exists( 'rx_toggle_top_bar_left_currency_switcher' ) ) {
	/**
	 * Currency Switcher enable
	 */
	function rx_toggle_top_bar_left_currency_switcher( $enable ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['currency_switcher_position'] ) && isset( $media_center_theme_options['enable_currency_switcher'] ) ) {
			if( $media_center_theme_options['currency_switcher_position'] == 'top_bar_left' ) {
				$enable = $media_center_theme_options['enable_currency_switcher'];
			} else{
				$enable = false;
			}
		}

		return $enable;
	}
}

if( ! function_exists( 'rx_toggle_top_bar_right_currency_switcher' ) ) {
	/**
	 * Currency Switcher enable
	 */
	function rx_toggle_top_bar_right_currency_switcher( $enable ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['currency_switcher_position'] ) && isset( $media_center_theme_options['enable_currency_switcher'] ) ) {
			if( $media_center_theme_options['currency_switcher_position'] == 'top_bar_right' ) {
				$enable = $media_center_theme_options['enable_currency_switcher'];
			} else{
				$enable = false;
			}
		}

		return $enable;
	}
}

if( ! function_exists( 'rx_toggle_language_switcher_position' ) ) {
	/**
	 * Language Switcher
	 */
	function rx_toggle_language_switcher_position( $position ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['language_switcher_position'] ) ) {
			$position = $media_center_theme_options['language_switcher_position'];
		}

		return $position;
	}
}

if( ! function_exists( 'rx_toggle_currency_switcher_position' ) ) {
	/**
	 * Currency Switcher
	 */
	function rx_toggle_currency_switcher_position( $position ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['currency_switcher_position'] ) ) {
			$position = $media_center_theme_options['currency_switcher_position'];
		}

		return $position;
	}
}

if( ! function_exists( 'rx_header_support_phone' ) ) {
	/**
	 * Header Support Phone
	 */
	function rx_header_support_phone( $phone ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['header_support_phone'] ) && ! empty( $media_center_theme_options['header_support_phone'] ) ) {
			$phone = $media_center_theme_options['header_support_phone'];
		}

		return $phone;
	}
}

if( ! function_exists( 'rx_header_support_email' ) ) {
	/**
	 * Header Support Mail
	 */
	function rx_header_support_email( $email ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['header_support_email'] ) && ! empty( $media_center_theme_options['header_support_email'] ) ) {
			$email = $media_center_theme_options['header_support_email'];
		}

		return $email;
	}
}

if( ! function_exists( 'rx_toggle_breadcrumb_ignore_title' ) ) {
	/**
	 * Breadcrumb Title Enable
	 */
	function rx_toggle_breadcrumb_ignore_title( $enable ) {
		global $media_center_theme_options;
		
		if( isset( $media_center_theme_options['breadcrumb_ignore_title'] ) ) {
			$enable = $media_center_theme_options['breadcrumb_ignore_title'];
		}

		return $enable;
	}
}