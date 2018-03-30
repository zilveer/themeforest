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

function yit_tab_typography_header( $items ) {
    return array_merge( $items, array(
        5 => array(
            'id'   => 'topbar-font',
            'type' => 'typography',
            'name' => __( 'Topbar font', 'yit' ),
            'desc' => __( 'Select the type to use for the topbar.', 'yit' ),
            'min'  => 1,
            'max'  => 18,
            'std'  => apply_filters( 'yit_topbar-font_std', array(
                    'size'   => 14,
                    'unit'   => 'px',
                    'family' => 'Oswald',
                    'style'  => 'regular',
                    'color'  => '#c5c3c3'
            ) ),
            'style' => array(
				'selectors' => '#topbar, #topbar p, #topbar a, #topbar li',
				'properties' => 'font-size, font-family, color, font-style, font-weight'
			)
        ),
        

        6 => array(
            'id' => 'topbar-links',
            'type' => 'colorpicker',
            'name' => __( 'Topbar links color', 'yit' ),
            'desc' => __( 'Select the color of the links in topbar.', 'yit' ),
            'std' => '#c5c3c3',
            'style' => array(
            	'selectors' => '#topbar a, #topbar #lang_sel a',
            	'properties' => 'color'
			)
        ),
        7 => array(
            'id' => 'topbar-links-hover',
            'type' => 'colorpicker',
            'name' => __( 'Topbar links hover color', 'yit' ),
            'desc' => __( 'Select the hover color of the links in topbar.', 'yit' ),
            'std' => '#cc9833',
            'style' => array(
            	'selectors' => '#topbar a:hover, #topbar #lang_sel a:hover',
            	'properties' => 'color'
			)
        ),

        8 => array(
            'id' => 'topbar-welcome-color',
            'type' => 'colorpicker',
            'name' => __( 'Topbar "Welcome user" color', 'yit' ),
            'desc' => __( 'Select the color of the user name in top bar.', 'yit' ),
            'std' => '#828181',
            'style' => array(
            	'selectors' => '#topbar span.welcome_username',
            	'properties' => 'color'
			)
        ),

        12 => array(
            'id'   => 'logo-tagline-highlight-font',
            'type' => 'typography',
            'name' => __( 'Tagline font highlight', 'yit' ),
            'desc' => __( 'Select the type to use for the tagline highlight.', 'yit' ),
            'min'  => 14,
            'max'  => 40,
            'std'  => apply_filters( 'yit_logo-tagline-highlight-font_std', array(
                    'size'   => 17,
                    'unit'   => 'px',
                    'family' => 'Play',
                    'style'  => 'regular',
                    'color'  => '#8d8d8d' 
            ) ),
            'style' => array(
				'selectors' => '#header #logo #tagline span',
				'properties' => 'font-size, font-family, color, font-style, font-weight'
			)
        )
    ) );
}
add_filter( 'yit_submenu_tabs_theme_option_typography_header', 'yit_tab_typography_header' );

add_filter( 'yit_logo-font_std', create_function( '', "return array(
                    'size'   => 48,
                    'unit'   => 'px',
                    'family' => 'Oswald',
                    'style'  => 'bold',
                    'color'  => '#373737' 
                );" ) );

function yit_logo_font_style( $array ) {
	$array['selectors'] = '#header #logo #textual, span.logo';    
    return $array;
}                
add_filter( 'yit_logo-font_style', 'yit_logo_font_style' ); 

add_filter( 'yit_logo-highlight-font_std', create_function( '', "return array(
                    'size'   => 48,
                    'unit'   => 'px',
                    'family' => 'Oswald',
                    'style'  => 'bold',
                    'color'  => '#cc9833' 
                );" ) );

add_filter( 'yit_logo-tagline-font_std', create_function( '', "return array(
                    'size'   => 17,
                    'unit'   => 'px',
                    'family' => 'Play',
                    'style'  => 'regular',
                    'color'  => '#8d8d8d' 
                );" ) );
				
add_filter( 'yit_logo-tagline-highlight-font_std', create_function( '', "return array(
                    'size'   => 17,
                    'unit'   => 'px',
                    'family' => 'Play',
                    'style'  => 'regular',
                    'color'  => '#cc9833' 
                );" ) );				           