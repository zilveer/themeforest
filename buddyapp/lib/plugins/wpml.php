<?php

/***************************************************
:: WPML language switch
 ***************************************************/



add_filter( 'kleo_theme_settings', 'kleo_wpml_settings' );

function kleo_wpml_settings( $kleo )
{
    //
    // Settings Sections
    //

    $kleo['sec']['kleo_section_wpml'] = array(
        'title' => esc_html__( 'WPML', 'buddyapp' ),
        'priority' => 18
    );

    $kleo['set'][] = array(
        'id' => 'wpml_header',
        'title' => esc_html__('Enable language switch in header', 'buddyapp'),
        'type' => 'switch',
        'default' => '1',
        'section' => 'kleo_section_wpml',
        'description' => esc_html__('Shows the language switch in the header', 'buddyapp'),
        'customizer' => true,
        'transport' => 'refresh'
    );

    return $kleo;
}

add_filter( 'kleo_header_class', 'kleo_wpml_header_class' );
add_action( 'kleo_header_language', 'kleo_show_language_menu' );

function kleo_wpml_header_class( $classes ) {
    if ( sq_option( 'wpml_header', true ) ) {
        $classes[] = 'has-language';
    }

    return $classes;
}

function kleo_show_language_menu() {

    if ( ! sq_option( 'wpml_header', true ) ) {
        return;
    }

    $output = kleo_get_languages();

    echo $output;
}

function kleo_get_languages() {

    $output = '';
    $active = '';
    $items = '';

    if ( function_exists('icl_get_languages')) {
        $languages = icl_get_languages('skip_missing=0&orderby=code');

        if( ! empty( $languages ) ){
            foreach( $languages as $code => $lang )
            {
                $items .= '<li>';

                $entry = strtoupper( $code );

                if( $lang['active'] ) {
                    $active .= '<a class="open-submenu" href="' . esc_url($lang['url']) . '">' . esc_html( $entry ) . '</a>';
                } else {
                    $items .= '<a href="' . esc_url($lang['url']) . '">' . esc_html( $entry ) . '</a>';
                }

                $items .= '</li>';
            }
        }

        $output .= '<div class="basic-menu language-menu">' .
                       '<div class="' . ( count( $languages ) > 1 ? 'has-submenu' : '' ) . '">' .
                            $active .
                            '<ul class="submenu">' .
                                $items .
                            '</ul>' .
                        '</div>' .
                    '</div>';
    }

    return $output;
}