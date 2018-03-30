<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Return an array with the options for Theme Options > Header > Logo
 *
 * @package Yithemes
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 * @author Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since 2.0.0
 * @return mixed array
 *
 */

$wp_logo = function_exists( 'has_custom_logo' ) && has_custom_logo() ;

return array(

    /* Header > Logo Settings */
    array(
        'type' => 'title',
        'name' => __( 'General', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'header-skin',
        'type' => 'select',
        'name' => __('Header Skin', 'yit'),
        'desc' => __('Select the skin for the header', 'yit' ),
        'options' => array(
            'skin1' => __( 'Skin1 - Logo, menu, search, cart in one row', 'yit' ),
            'skin2' => __( 'Skin2 - Menu under the logo', 'yit' )
        ),
        'std' => 'skin1',
        'in_skin'        => true
    ),

    array(
        'id' => 'header-sticky',
        'type' => 'onoff',
        'name' => __('Header Sticky', 'yit'),
        'desc' => __('Want to use a stycky header?', 'yit' ),
        'std' => 'yes',
        'in_skin'        => true
    ),

    /* Header > Logo Settings */
    $wp_logo ? false : array(
        'type' => 'title',
        'name' => __( 'Logo', 'yit' ),
        'desc' => ''
    ),

    $wp_logo ? false : array(
        'id' => 'header-custom-logo',
        'type' => 'onoff',
        'name' => __('Custom logo', 'yit'),
        'desc' => __('Want to use a custom image as logo?', 'yit' ),
        'std' => 'yes',
        'in_skin'        => true
    ),

    $wp_logo ? false : array(
        'id' => 'header-custom-logo-image',
        'type' => 'upload',
        'name' => __( 'Custom logo image', 'yit' ),
        'desc' => __( 'Select the custom image to use as logo', 'yit' ),
        'std' => YIT_THEME_ASSETS_URL . '/images/logo.png',
        'deps' => array(
            'ids' => 'header-custom-logo',
            'values' => 'yes'
         )
    ),

    array(
        'id' => 'header-logo-tagline',
        'type' => 'onoff',
        'name' => __('Logo Tagline', 'yit'),
        'desc' => __('Specify if you want the tagline to show below the logo. ', 'yit' ),
        'std' => 'no'
    ),

    array(
        'id' => 'header-logo-tagline-mobile',
        'type' => 'onoff',
        'name' => __('Show logo Tagline in mobile', 'yit'),
        'desc' => __('Specify if you want the tagline to show below the logo on mobile devices. ', 'yit' ),
        'std' => 'no',
        'deps' => array(
            'ids' => 'header-logo-tagline',
            'values' => 'yes'
        )
    ),

    array(
        'id'   => 'header-search-mini',
        'type' => 'title',
        'name' => __( 'Search mini', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'      => 'search_type',
        'type'    => 'select',
        'name'    => __( 'Search type header', 'yit' ),
        'desc'    => __( 'Select the type of posts you want to search with searchform of the header.', 'yit' ),
        'options' => array(
            'product' => __( 'Products', 'yit' ),
            'post'    => __( 'Posts', 'yit' ),
            'any'     => __( 'All', 'yit' ),
        ),
        'std'     => 'product',
    ),

    array(
        'id'      => 'header-search-mini-icon',
        'type'    => 'select-icon',
        'options' => array(
            'select' => array(
                'icon'   => __( 'Theme Icon', 'yit' ),
                'custom' => __( 'Custom Icon', 'yit' ),
                'none'   => __( 'None', 'yit' )
            ),
            'icon'   => YIT_Plugin_Common::get_awesome_icons(),
        ),
        'name'    => __( 'Select search mini icon', 'yit' ),
        'desc'    => __( 'Select the icon for search mini', 'yit' ),
        'std'     => array(
            'select' => 'custom',
            'icon'   => 'search',
            'custom' => YIT_THEME_ASSETS_URL . '/images/icon_search.png'
        ),
        'in_skin' => true
    ),

    array(
        'id'         => 'header-search-mini-icon-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Links', 'yit' ),
            'hover'  => __( 'Links hover', 'yit' )
        ),
        'name'       => __( 'Search mini icon color', 'yit' ),
        'desc'       => __( 'Select the type to use for the icon in search mini.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#484848',
                'hover'  => '#f7c104'
            )
        ),
        'deps'    => array(
            'ids'    => 'header-search-mini-icon',
            'values' => 'icon'
        ),
        'linked_to'  => array(
            'hover' => 'theme-color-1',
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '#header-sidebar .widget_search_mini > a > i',
                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '#header-sidebar .widget_search_mini > a > i:hover',
                'properties' => 'color'
            ),
        ),
        'in_skin'        => true,
    ),



);

