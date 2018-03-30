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

function yit_submenu_tabs_theme_option_popup_settings( $array ) {
    return array_merge( $array, array(
        70 => array(
            'id' => 'popup-border1-color',
            'type' => 'colorpicker',
            'name' => __( 'External border color', 'yit' ),
            'desc' => __( 'Select the color of the external border of the popup.', 'yit' ),
            'std' => apply_filters( 'yit_popup-border1-color_std', '#DDDDDD' ),
            'style' => array(
                'selectors' => '#popupWrap .popup .border-1',
                'properties' => 'border-color'
            )
        ),
        80 => array(
            'id' => 'popup-border2-color',
            'type' => 'colorpicker',
            'name' => __( 'Internal border color', 'yit' ),
            'desc' => __( 'Select the color of the internal border of the popup.', 'yit' ),
            'std' => apply_filters( 'yit_popup-border2-color_std', '#F1C070' ),
            'style' => array(
                'selectors' => '#popupWrap .popup .border-2',
                'properties' => 'border-color'
            )
        ),
        90 => array(
            'id' => 'popup-submit-color',
            'type' => 'colorpicker',
            'name' => __( 'Newsletter submit', 'yit' ),
            'desc' => __( 'Select the color of the newsletter submit button of the popup.', 'yit' ),
            'std' => apply_filters( 'yit_popup-submit-color_std', '#C58408' ),
            'style' => array(
                'selectors' => '#popupWrap .popup .popup-newsletter-section .input-prepend .submit-field',
                'properties' => 'background-color'
            )
        ),
        100 => array(
            'id' => 'popup-submit-color-hover',
            'type' => 'colorpicker',
            'name' => __( 'Newsletter submit (hover)', 'yit' ),
            'desc' => __( 'Select the color of the newsletter submit button of the popup when is hover.', 'yit' ),
            'std' => apply_filters( 'yit_popup-submit-color_std', '#e79c0c' ),
            'style' => array(
                'selectors' => '#popupWrap .popup .popup-newsletter-section .input-prepend .submit-field:hover',
                'properties' => 'background-color'
            )
        ),
    ) );
}
add_filter( 'yit_submenu_tabs_theme_option_popup_settings', 'yit_submenu_tabs_theme_option_popup_settings' );

function yit_popup_title_std( $array ) {
    $array['size'] = 20;
    $array['color'] = '#3e3d3d';
    $array['family'] = 'Oswald';
    $array['style'] = 'regular';
    
    return $array;
}
add_filter( 'yit_popup-title_std', 'yit_popup_title_std' );

function yit_popup_title_style( $array ) {
    $array['selectors'] = '#popupWrap div.popup h3.title';
    
    return $array;
}
add_filter( 'yit_popup-title_style', 'yit_popup_title_style' );


function yit_popup_content_std( $array ) {
    $array['size'] = 12;
    $array['family'] = 'Play';
    $array['color'] = '#747373';
    
    return $array;
}
add_filter( 'yit_popup-content_std', 'yit_popup_content_std' );
