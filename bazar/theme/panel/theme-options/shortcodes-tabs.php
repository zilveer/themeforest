<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */


add_filter( 'yit_tabs-title_std', create_function('',"return array(
            'size'   => 18,
            'unit'   => 'px',
            'family' => 'Oswald',
            'style'  => 'regular',
            'color'  => '#8d8d8d'
			);")
);

add_filter( 'yit_tabs-title-hover_std', create_function('','return "#373736";'));
add_filter( 'yit_tabs-title-current_std', create_function('','return "#373736";'));

add_filter( 'yit_prices-table-special-title_std', create_function('',"return array(
            'size'   => 17,
            'unit'   => 'px',
            'family' => 'Open Sans',
            'style'  => 'extra-bold',
            'color'  => '#ffffff'
			);")
);

add_filter( 'yit_prices-table-normal-title_std', create_function('',"return array(
            'size'   => 17,
            'unit'   => 'px',
            'family' => 'Open Sans',
            'style'  => 'extra-bold',
            'color'  => '#585555'
			);")
);

add_filter( 'yit_prices-table-price_std', create_function('',"return array(
            'size'   => 17,
            'unit'   => 'px',
            'family' => 'Open Sans',
            'style'  => 'bold',
            'color'  => '#585555'
			);")
);

add_filter( 'yit_prices-table-button_std', create_function('',"return array(
            'size'   => 14,
            'unit'   => 'px',
            'family' => 'Open Sans',
            'style'  => 'regular',
            'color'  => '#3f4950'
			);")
);

add_filter( 'yit_prices-table-text_std', create_function('',"return array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Open Sans',
            'style'  => 'regular',
            'color'  => '#808080'
			);")
);

function yit_tabs_title_style( $array ) {
    $array['selectors'] .= ',.woocommerce_tabs ul.tabs li a, #content .woocommerce_tabs ul.tabs li a, .woocommerce-tabs ul.tabs li a, #content .woocommerce-tabs ul.tabs li a';
    return $array;
}
add_filter( 'yit_tabs-title_style', 'yit_tabs_title_style' );

function yit_tabs_title_hover_style( $array ) {
    $array['selectors'] .= ',.woocommerce_tabs ul.tabs li a:hover, #content .woocommerce_tabs ul.tabs li a:hover, .woocommerce-tabs ul.tabs li a:hover, #content .woocommerce-tabs ul.tabs li a:hover';
    return $array;
}
add_filter( 'yit_tabs-title-hover_style', 'yit_tabs_title_hover_style' );

function yit_tabs_title_current_style( $array ) {
    $array['selectors'] .= ',.woocommerce_tabs ul.tabs li.active a, #content .woocommerce_tabs ul.tabs li.active a, .woocommerce-tabs ul.tabs li.active a, #content .woocommerce-tabs ul.tabs li.active a';
    return $array;
}
add_filter( 'yit_tabs-title-current_style', 'yit_tabs_title_current_style' );