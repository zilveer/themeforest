<?php
/**
 * WPML Functions
 *
 * @package mediacenter
 */
/**
 * Adds wcml_switch_currency_nonce to localized data
 */
if( ! function_exists( 'add_wcml_switch_currency_nonce' ) ) {
	function add_wcml_switch_currency_nonce( $data ) {
		$data[ 'wcml_switch_currency_nonce' ] = wp_create_nonce( 'switch_currency' );
		return $data;
	}
}

/**
 * Languages Menu
 */
if( ! function_exists( 'media_center_get_languages_menu' ) ) :
function media_center_get_languages_menu() {

	$languages_menu = '';

	if ( function_exists( 'icl_get_languages' ) ) :

		$mc_language_switcher_position = apply_filters( 'mc_language_switcher_position', 'top_bar_left' );
		if ( $mc_language_switcher_position == 'top_bar_left' ) {
			$top_bar_left_dropdown_trigger = apply_filters( 'mc_top-left_dropdown_trigger', 'click', 'top-left' );
			if( $top_bar_left_dropdown_trigger == 'hover' ) {
				$data_hover = 'data-hover="dropdown"';
			} else {
				$data_hover = '';
			}
		} elseif ( $mc_language_switcher_position == 'top_bar_right' ) {
			$top_bar_right_dropdown_trigger = apply_filters( 'mc_top-right_dropdown_trigger', 'click', 'top-right' );
			if( $top_bar_right_dropdown_trigger == 'hover' ) {
				$data_hover = 'data-hover="dropdown"';
			} else {
				$data_hover = '';
			}
		}
			
		$additional_languages = icl_get_languages( 'skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str' );
            
        if ( count( $additional_languages ) > 1 ) { 
        	
        	$languages_menu .= '<li class="dropdown"><a href="#" ' . $data_hover . ' data-toggle="dropdown" class="dropdown-toggle">' . ICL_LANGUAGE_NAME . '</a>';
			$languages_menu .= '<ul class="dropdown-menu">';
                    
            foreach( $additional_languages as $additional_language ) {
				if( ! $additional_language['active'] ) {
					$langs[] = '<li><a href="' . esc_url( $additional_language['url'] ) . '">' . $additional_language['native_name'] . '</a></li>';
				} 
            }

			$languages_menu .= join( '', $langs );

            $languages_menu .= '</ul>';
            $languages_menu .= '</li>';
        }
        
    endif;

    return $languages_menu;
}
endif;

/**
 * Currencies menu
 */
if( ! function_exists( 'media_center_get_currencies_menu' ) ) :
function media_center_get_currencies_menu() {
	
	$currencies_menu = '';

	if( class_exists( 'WCML_Multi_Currency_Support' ) ) {
		global $woocommerce_wpml, $sitepress;

		$mc_currency_switcher_position = apply_filters( 'mc_currency_switcher_position', 'top_bar_left' );
		if ( $mc_currency_switcher_position == 'top_bar_left' ) {
			$top_bar_left_dropdown_trigger = apply_filters( 'mc_top-left_dropdown_trigger', 'click', 'top-left' );
			if( $top_bar_left_dropdown_trigger == 'hover' ) {
				$data_hover = 'data-hover="dropdown"';
			} else {
				$data_hover = '';
			}
		} elseif ( $mc_currency_switcher_position == 'top_bar_right' ) {
			$top_bar_right_dropdown_trigger = apply_filters( 'mc_top-right_dropdown_trigger', 'click', 'top-right' );
			if( $top_bar_right_dropdown_trigger == 'hover' ) {
				$data_hover = 'data-hover="dropdown"';
			} else {
				$data_hover = '';
			}
		}

		$settings = $woocommerce_wpml->get_settings();

		if( !isset( $settings['currencies_order'] ) ) {
            $currencies = $woocommerce_wpml->multi_currency_support->get_currency_codes();
        } else {
            $currencies = $settings['currencies_order'];
        }

		if(	!isset( $args['format'] ) ) {
            $args['format'] = isset( $settings['wcml_curr_template'] ) && $settings['wcml_curr_template'] != '' ? $settings['wcml_curr_template'] : '%name% (%code%)' ;
        }

        $currencies_dropdown = '<ul class="mc_wcml_currency_switcher dropdown-menu">';
        $selected_currency  = '';
        $wc_currencies = get_woocommerce_currencies();

		foreach( $currencies as $currency ) {
            if( $woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1 ) {
				$currency_format = preg_replace( array('#%name%#', '#%symbol%#', '#%code%#'), array( $wc_currencies[$currency], get_woocommerce_currency_symbol( $currency ), $currency ), $args['format'] );                
                
                if( $currency == $woocommerce_wpml->multi_currency_support->get_client_currency() ){
                	$selected_currency = '<a href="#" ' . $data_hover . ' class="dropdown-toggle" data-toggle="dropdown">' . $currency_format . '</a>';
                }
                
                $currencies_dropdown .= '<li><a data-currency="' . esc_attr( $currency ) . '" href="#">' . $currency_format . '</a></li>';
        	}
        }

        $currencies_dropdown .= '</ul>';
        $currencies_menu = '<li class="dropdown">' . $selected_currency . $currencies_dropdown . '</li>';
	}

	return $currencies_menu;
}
endif;