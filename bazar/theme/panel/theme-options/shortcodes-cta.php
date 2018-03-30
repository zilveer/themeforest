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

function yit_tab_shortcodes_cta( $items ) {

	$items[90] = array(
        'id'   => 'call-to-action-newsletter',
        'type' => 'title',
        'name' => __( 'Call to action newsletter', 'yit' ),
        'desc' => __( 'Choose the font type, size and color for the call to action newsletter.', 'yit' )                
    );
    $items[100] = array(
        'id'   => 'call-to-action-newsletter-title',
        'type' => 'typography',
        'name' => __( 'Title', 'yit' ),
        'desc' => __( 'Choose the font type, size and color for the title.', 'yit' ),
        'min'  => 1,
        'max'  => 30,
        'std'  => apply_filters( 'yit_call-to-action-newsletter-title_std', array(
            'size'   => 20,
            'unit'   => 'px',
            'family' => 'Oswald',
            'style'  => 'regular',
            'color'  => '#030303' 
        ) ),
        'style' => apply_filters('yit_call-to-action-newsletter-title_style',array(
			'selectors' => '.call-three .text h2',
			'properties' => 'font-size, font-family, color, font-style, font-weight'
		))
    );
    $items[110] = array(
        'id'   => 'call-to-action-newsletter-incipit',
        'type' => 'typography',
        'name' => __( 'Incipit', 'yit' ),
        'desc' => __( 'Choose the font type, size and color for the incipit.', 'yit' ),
        'min'  => 1,
        'max'  => 30,
        'std'  => apply_filters( 'yit_call-to-action-newsletter-incipit_std', array(
            'size'   => 16,
            'unit'   => 'px',
            'family' => 'Play',
            'style'  => 'regular',
            'color'  => '#696464' 
        ) ),
        'style' => apply_filters('yit_call-to-action-newsletter-incipit_style',array(
			'selectors' => '.call-three .text h4',
			'properties' => 'font-size, font-family, color, font-style, font-weight'
		))
    );
    $items[120] = array(
        'id'   => 'call-to-action-newsletter-background',
        'type' => 'colorpicker',
        'name' => __( 'Call to action newsletter background color', 'yit' ),
        'desc' => __( 'Select the background for Call to action newsletter.', 'yit' ),
        'std'  => apply_filters( 'yit_call-to-action-newsletter-background_std', '#f8f7f7' ),
        'style' => apply_filters( 'yit_call-to-action-newsletter-background_style', array(
			'selectors' => 'div.call-three',
			'properties' => 'background-color'
		) )
    );
	$items[130] = array(
        'id'   => 'call-to-action-newsletter-border',
        'type' => 'colorpicker',
        'name' => __( 'Call to action newsletter border color', 'yit' ),
        'desc' => __( 'Select the border for Call to action newsletter.', 'yit' ),
        'std'  => apply_filters( 'yit_call-to-action-newsletter-border_std', '#f2f0f0' ),
        'style' => apply_filters( 'yit_call-to-action-newsletter-border_style', array(
			'selectors' => 'div.call-three',
			'properties' => 'border-color'
		) )
    );
    
    return $items;
}
add_filter( 'yit_submenu_tabs_theme_option_shortcodes_cta', 'yit_tab_shortcodes_cta' );

add_filter( 'yit_call-to-action-title_std', create_function('',"return array(
            'size'   => 20,
            'unit'   => 'px',
            'family' => 'Oswald',
            'style'  => 'regular',
            'color'  => '#0C243D'
			);")
);

add_filter( 'yit_call-to-action-incipit_std', create_function('',"return array(
            'size'   => 14,
            'unit'   => 'px',
            'family' => 'Play',
            'style'  => 'regular',
            'color'  => '#464444'
			);")
);

add_filter( 'yit_call-to-action-phone_std', create_function('',"return array(
            'size'   => 42,
            'unit'   => 'px',
            'family' => 'Play',
            'style'  => 'bold',
            'color'  => '#838383'
			);")
);

add_filter( 'yit_call-to-action-button-text_std', create_function('',"return array(
            'size'   => 20,
            'unit'   => 'px',
            'family' => 'Oswald',
            'style'  => 'regular',
            'color'  => '#2c2b2b'
			);")
);

add_filter( 'yit_call-to-action-button-background_std', create_function('','return "#eeeeee";'));

add_filter( 'yit_call-to-action-button-border_std', create_function('','return "#cfcece";'));