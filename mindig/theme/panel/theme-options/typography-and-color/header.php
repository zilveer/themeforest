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
 * Return an array with the options for Theme Options > Typography and Color > Header
 *
 * @package Yithemes
 * @author  Andrea Grillo <andrea.grillo@yithemes.com>
 * @author  Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since   2.0.0
 * @return mixed array
 *
 */
return array(

    /* Typography and Color > General Custom Background */
    array(
        'type' => 'title',
        'name' => __( 'General Custom Background', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'    => 'header-background-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Header background color', 'yit' ),
        'desc'  => __( 'Select the color to use as background on your header', 'yit' ),
        'std'   => array(
            'color'   => '#ffffff',
            'opacity' => 100,
        ),
        'style' => array(
            'selectors'  => '#header',
            'properties' => 'background-color'
        )
    ),

    array(
        'id'    => 'typography-header-background-image',
        'type'  => 'upload',
        'name'  => __( 'Header background image', 'yit' ),
        'desc'  => __( 'Select the image to use as background on your page header', 'yit' ),
        'std'   => '',
        'style' => array(
            'selectors'  => '#header',
            'properties' => 'background-image'
        )
    ),

    array(
        'id'      => 'typography-header-background-repeat',
        'type'    => 'select',
        'options' => array(
            'repeat'    => __( 'Repeat', 'yit' ),
            'repeat-x'  => __( 'Repeat Horizontally', 'yit' ),
            'repeat-y'  => __( 'Repeat Vertically', 'yit' ),
            'no-repeat' => __( 'No Repeat', 'yit' )
        ),
        'name'    => __( 'Background repeat', 'yit' ),
        'desc'    => __( 'Select the repeat mode for the background image of header.', 'yit' ),
        'std'     => 'no-repeat',
        'style'   => array(
            'selectors'  => '#header',
            'properties' => 'background-repeat'
        )
    ),

    array(
        'id'      => 'typography-header-background-position',
        'type'    => 'select',
        'options' => array(
            'center'        => __( 'Center', 'yit' ),
            'top left'      => __( 'Top Left', 'yit' ),
            'top center'    => __( 'Top Center', 'yit' ),
            'top right'     => __( 'Top Right', 'yit' ),
            'bottom left'   => __( 'Bottom Left', 'yit' ),
            'bottom center' => __( 'Bottom Center', 'yit' ),
            'bottom right'  => __( 'Bottom Right', 'yit' ),
        ),
        'name'    => __( 'Background position', 'yit' ),
        'desc'    => __( 'Select the position for the background image of header.', 'yit' ),
        'std'     => 'top left',
        'style'   => array(
            'selectors'  => '#header',
            'properties' => 'background-position'
        )
    ),

    array(
        'id'      => 'typography-header-background-attachment',
        'type'    => 'select',
        'options' => array(
            'scroll' => __( 'Scroll', 'yit' ),
            'fixed'  => __( 'Fixed', 'yit' )
        ),
        'name'    => __( 'Background attachment', 'yit' ),
        'desc'    => __( 'Select the attachment for the background image of header.', 'yit' ),
        'std'     => 'scroll',
        'style'   => array(
            'selectors'  => '#header',
            'properties' => 'background-attachment'
        )
    ),

    array(
        'id'              => 'typography-header-logo-font',
        'type'            => 'typography',
        'name'            => __( 'Logo font', 'yit' ),
        'desc'            => __( 'Select the type to use for the logo font.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 48,
            'unit'      => 'px',
            'family'    => 'Open Sans',
            'style'     => '800',
            'color'     => '#383838',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '#logo #textual',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'typography-header-logo-highlight-font',
        'type'            => 'typography',
        'name'            => __( 'Logo font highlight', 'yit' ),
        'desc'            => __( 'Select the type to use for the logo font highlight.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 48,
            'unit'      => 'px',
            'family'    => 'Open Sans',
            'style'     => '800',
            'color'     => '#fab000',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'linked_to'       => 'theme-color-1',
        'style'           => array(
            'selectors'  => '#logo span.title-highlight',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'typography-header-tagline-font',
        'type'            => 'typography',
        'name'            => __( 'Tagline font', 'yit' ),
        'desc'            => __( 'Select the type to use for the tagline below the logo.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#a4a4a4',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '#tagline, #portfolio_nav .prev-label, #portfolio_nav .next-label',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'typography-header-tagline-highlight-font',
        'type'            => 'typography',
        'name'            => __( 'Tagline font highlight', 'yit' ),
        'desc'            => __( 'Select the type to use for the tagline highlight.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#fab000',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'linked_to'       => 'theme-color-1',
        'style'           => array(
            'selectors'  => '#tagline.highlight',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    /* Typography and Color > Slogan */
    array(
        'type' => 'title',
        'name' => __( 'Slogan', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'typography-header-slogan-font',
        'type'            => 'typography',
        'name'            => __( 'Slogan font', 'yit' ),
        'desc'            => __( 'Select the type to use for the slogan.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 40,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#1f1f1f',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '#slogan h2, #slogan h2 span',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'typography-header-subslogan-font',
        'type'            => 'typography',
        'name'            => __( 'Sub Slogan font', 'yit' ),
        'desc'            => __( 'Select the type to use for the sub slogan.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 16,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#dda213',
            'align'     => 'center',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '#slogan p',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'        => 'typography-slogan-highlight',
        'type'      => 'colorpicker',
        'name'      => __( 'Slogan title highlight', 'yit' ),
        'desc'      => __( 'Select the color to use for the highlight of titles', 'yit' ),
        'std'       => array(
            'color' => '#fab000'
        ),
        'linked_to' => 'theme-color-2',
        'style'     => array(
            'selectors'  => '#slogan h2 span.title-highlight, #slogan p span.title-highlight, #slogan.yith-checkout-single span.current',
            'properties' => 'color'
        )
    ),

    array(
        'id'    => 'typography-slogan-background-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Slogan background color', 'yit' ),
        'desc'  => __( 'Select the color to use as background on your slogans', 'yit' ),
        'std'   => array(
            'color' => '#ffffff'
        ),
        'style' => array(
            'selectors'  => '#slogan',
            'properties' => 'background-color'
        )
    ),


    /* Typography and Color > Topbar */
    array(
        'type' => 'title',
        'name' => __( 'Topbar', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'typography-topbar-font',
        'type'            => 'typography',
        'name'            => __( 'Topbar font', 'yit' ),
        'desc'            => __( 'Select the font to use for the topbar.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 13,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#383838',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'linked_to'       => array(
            ''
        ),
        'style'           => array(
            'selectors'  => '#topbar, #topbar a .welcome_username b, #header .widget.yit_text_image div.widget_text h6,
            #header-row .widget_text h6',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'typography-topbar-highlight-font',
        'type'            => 'typography',
        'name'            => __( 'Topbar highlight font', 'yit' ),
        'desc'            => __( 'Select the font to use for the highlight text topbar.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 13,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#a4a4a4',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'linked_to'       => array(
            ''
        ),
        'style'           => array(
            'selectors'  => '#topbar .shortcode-highlight,
                             #header .widget.yit_text_image div.widget_text p,
                             #header-row .widget_text p',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'    => 'typography-topbar-background-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Topbar background color', 'yit' ),
        'desc'  => __( 'Select the color to use as background on your page topbar', 'yit' ),
        'std'   => array(
            'color' => '#f1eeee'
        ),
        'style' => array(
            'selectors'  => '#topbar',
            'properties' => 'background-color'
        )
    ),

    array(
        'id'    => 'typography-topbar-border-bottom-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Topbar border bottom color', 'yit' ),
        'desc'  => __( 'Select the color to use as border bottom on your topbar', 'yit' ),
        'std'   => array(
            'color' => '#f1eeee'
        ),
        'style' => array(
            'selectors'  => '#topbar .header-wrapper',
            'properties' => 'border-bottom-color'
        )
    ),
    array(
        'id'         => 'topbar-link-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Links', 'yit' ),
            'hover'  => __( 'Links hover', 'yit' )
        ),
        'name'       => __( 'Links', 'yit' ),
        'desc'       => __( 'Select the type to use for the links in your page header.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#a4a4a4',
                'hover'  => '#fab000'
            )
        ),
        'linked_to'  => array(
            'hover' => 'theme-color-1',
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '#topbar a , #topbar a i',
                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '#topbar a:hover, #topbar a:hover i',
                'properties' => 'color'
            ),
        )
    ),


    array(
        'id'         => 'topbar-menu-link-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Links', 'yit' ),
            'hover'  => __( 'Links hover', 'yit' )
        ),
        'name'       => __( 'Topbar Menu Link color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the links in topbar menu', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#a4a4a4',
                'hover'  => '#dda213'
            )
        ),
        'linked_to'       => array(
            'hover'  => ''
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '#topnav .nav, .nav > ul > li:after',
                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '#topbar .nav a:hover,
                                #topbar .nav ul > li:hover > a,
                                #topbar .nav .current-menu-item > a,
                                #topbar .nav .current-menu-ancestor > a,
                                #topbar .nav .current-page-item > a
                                #topbar .nav ul.sub-menu li a:hover,
                                #topbar .nav ul.children li a:hover,
                                #topbar .nav ul.sub-menu li a:hover,
                                #topbar .nav ul.children li a:hover,
                                #topbar .nav div.submenu li > div.submenu li a:hover',
                'properties' => 'color'
            ),
        )
    ),



    /* Typography and Color > Navigation */
    array(
        'type' => 'title',
        'name' => __( 'Navigation', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'typography-navigation-menu-font',
        'type'            => 'typography',
        'name'            => __( 'Navigation font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color for the navigation.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 13,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.nav ul > li a,
                             .nav ul > li a span,
                             .st-menu ul > li a,
                             .st-menu ul > li a span,
                             #customer_login label,
                             .login-box .wp-social-login-widget #wp-social-login-connect-with,
                             .wp-social-login-widget .wp-social-login-connect-with,
                             .ywsl-label',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'         => 'typography-navigation-menu-link-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Links', 'yit' ),
            'hover'  => __( 'Links hover', 'yit' ),
        ),
        'name'       => __( 'Navigation Links Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the links in navigation menu', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#a4a4a4',
                'hover'  => '#dda213'
            )
        ),
        'linked_to'  => array(
            'hover' => 'theme-color-2',
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '.nav ul > li a, #nav > ul > li:after, .st-menu  ul > li a,
                                 #customer_login label,
                                 .login-box .wp-social-login-widget #wp-social-login-connect-with,
                                 .wp-social-login-widget .wp-social-login-connect-with, .ywsl-label',
                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '.nav ul > li a:hover,
                #header-sidebar #lang_sel ul > li > ul > li a:hover,
                .nav ul > li a:hover,
                .nav ul > li a:focus,
                .st-menu ul > li a:hover,
                .st-menu ul > li a:focus,
                .search_mini_content .sbHolder a:hover,
                .st-menu .current-menu-item > a,
                .st-menu .current-menu-ancestor > a,
                .st-menu .current-page-item > a,

                .nav ul > li:hover > a,
                .st-menu ul > li:hover > a,
                #header .nav li.menu-close > a',
                'properties' => 'color'
            )
        )
    ),



    /* Typography and Color > Sub Navigation */
    array(
        'type' => 'title',
        'name' => __( 'Sub Navigation', 'yit' ),
        'desc' => ''
    ),
    array(
        'id'    => 'typography-subnavigation-background-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Sub Navigation background color', 'yit' ),
        'desc'  => __( 'Select the color to use as background on your subnavigation bar', 'yit' ),
        'std'   => array(
            'color' => '#ffffff'
        ),
        'style' => array(
            'selectors'  => '.nav > ul  li  ul.sub-menu, .st-menu > ul  li  ul.sub-menu, #lang_sel > ul > li > ul,
            #welcome-menu-login .login-box,
            #header-row .yit-custom-megamenu ul.yit-cm > li > div.submenu > ul.sub-menu > li > div.submenu,
            #header-row .yit-custom-megamenu ul.yit-cm > li > div.submenu  ul.sub-menu,
            .yit-vertical-megamenu .nav > ul > li > div.submenu > ul,
            .yit-vertical-megamenu .nav > ul > li > div.submenu  ul.sub-menu',
            'properties' => 'background-color'
        )
    ),


    array(
        'id'              => 'typography-subnavigation-menu-font',
        'type'            => 'typography',
        'name'            => __( 'Sub Navigation font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color for the subnavigation.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 13,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '300',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.nav > ul > li > div.submenu ul.sub-menu li a,
            #header-row .yit-custom-megamenu ul.yit-cm > li > div.submenu > ul.sub-menu > li a,
            .nav #lang_sel > ul > li > ul li a span, .nav #lang_sel > ul > li > ul li a,
            .widget_search_mini .search_mini_content .sbHolder a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'         => 'typography-subnavigation-menu-link-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Links', 'yit' ),
            'hover'  => __( 'Links hover', 'yit' ),
        ),
        'name'       => __( 'Subnavigation Links Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the links in submenu', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#a4a4a4',
                'hover'  => '#dda213',
            )
        ),
        'linked_to'  => array(
            'hover' => 'theme-color-2',
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '#header-row .yit-custom-megamenu ul.yit-cm > li > div.submenu > ul.sub-menu > li a, .yit-vertical-megamenu .nav > ul > li a,
                .widget_search_mini .search_mini_content .sbHolder a',
                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '.nav ul.sub-menu li a:hover,
                                 .nav ul > li:hover > a,
                                 .nav ul.children li a:hover,
                                 .nav ul.sub-menu li a:hover,
                                 .nav ul.children li a:hover,
                                 .nav div.submenu li > div.submenu li a:hover,

                                 .st-menu ul.sub-menu li a:hover,
                                 .st-menu ul > li:hover > a,
                                 .st-menu ul.children li a:hover,
                                 .st-menu ul.sub-menu li a:hover,
                                 .st-menu ul.children li a:hover,
                                 .st-menu div.submenu li > div.submenu li a:hover,

                                 #header-row .yit-custom-megamenu ul.yit-cm > li > div.submenu > ul.sub-menu > li a:hover,
                                 .widget_search_mini .search_mini_content .sbHolder a:hover,
                                 .yit-vertical-megamenu .nav > ul > li a:hover


                ',
                'properties' => 'color'
            )
        )
    ),

    /* Typography and Color > Megamenu */
    array(
        'type' => 'title',
        'name' => __( 'Bigmenu', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'typography-big-menu-title-menu-font',
        'type'            => 'typography',
        'name'            => __( 'Sub Navigation Title Big Menu font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color for the title in subnavigation.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.st-menu .bigmenu > .submenu > ul.sub-menu > li > a,
                #topbar .nav .bigmenu > .submenu > ul.sub-menu > li > a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'typography-big-menu-subnavigation-menu-font',
        'type'            => 'typography',
        'name'            => __( 'Sub Navigation Big Menu font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color for the subnavigation.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 13,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '300',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.nav .bigmenu div.submenu li > div.submenu li a,
            				 .st-menu .bigmenu div.submenu li > div.submenu li a,
                #topbar .nav .bigmenu div.submenu li > div.submenu li a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'         => 'typography-big-menu-link-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'title-normal'   => __( 'Title', 'yit' ),
            'title-hover'    => __( 'Title hover', 'yit' ),
            'submenu-normal' => __( 'Submenu', 'yit' ),
            'submenu-hover'  => __( 'Submenu hover', 'yit' )
        ),
        'name'       => __( 'Bigmenu Links Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the links in bigmenu', 'yit' ),
        'std'        => array(
            'color' => array(
                'title-normal'   => '#000000',
                'title-hover'    => '#000000',
                'submenu-normal' => '#8a8a8a',
                'submenu-hover'  => '#fab000'
            )
        ),
        'linked_to'  => array(
            'submenu-hover' => 'theme-color-2',
        ),
        'style'      => array(
            'title-normal'   => array(
                'selectors'  => '.nav .bigmenu > .submenu > ul.sub-menu > li > a,
                .st-menu .bigmenu > .submenu > ul.sub-menu > li > a,
                #topbar .nav .bigmenu > .submenu > ul.sub-menu > li > a',
                'properties' => 'color'
            ),
            'title-hover'    => array(
                'selectors'  => '.nav .bigmenu > .submenu > ul.sub-menu > li > a:hover,
                                 .nav .bigmenu > .submenu > ul.sub-menu > li:hover > a,
                                 .st-menu .bigmenu > .submenu > ul.sub-menu > li > a:hover,
                                 .st-menu .bigmenu > .submenu > ul.sub-menu > li:hover > a,
                                 #topbar .nav .bigmenu > .submenu > ul.sub-menu > li > a:hover,
                                 #topbar .nav .bigmenu > .submenu > ul.sub-menu > li:hover > a',
                'properties' => 'color'
            ),
            'submenu-normal' => array(
                'selectors'  => '.nav .bigmenu div.submenu li > div.submenu li a,
                #topbar .nav .bigmenu div.submenu li > div.submenu li a',
                'properties' => 'color'
            ),
            'submenu-hover'  => array(
                'selectors'  => '.nav .bigmenu div.submenu li > div.submenu li a:hover,
                                 .nav .bigmenu div.submenu li > div.submenu li:hover a,
                                 .nav .bigmenu div.submenu li > div.submenu li.current-menu-item a,
                                 .st-menu .bigmenu div.submenu li > div.submenu li a:hover,
                                 .st-menu .bigmenu div.submenu li > div.submenu li:hover a,
                                 .st-menu .bigmenu div.submenu li > div.submenu li.current-menu-item a,
                                 #topbar .nav .bigmenu div.submenu li > div.submenu li a:hover,
                                 #topbar .nav .bigmenu div.submenu li > div.submenu li:hover a,
                                 #topbar .nav .bigmenu div.submenu li > div.submenu li.current-menu-item a',
                'properties' => 'color'
            ),
        )
    ),

    array(
        'type' => 'title',
        'name' => __( 'Mini Search Colors', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'         => 'mini-search-label-text',
        'type'       => 'typography',
        'name'       => __( 'Mini Search Font', 'yit' ),
        'desc'       => __( 'Choose the font type, size and color for the mini search', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 13,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#a4a4a4',
            'align'     => 'left',
            'transform' => 'uppercase'
        ),
        'style'           => array(
            'selectors'  => '.widget_search_mini .search_mini_content label,
                             .widget_search_mini .select-wrapper .holder,
                             #mini-search-submit,
                             .yith-ajaxsearchform-container #yith-searchsubmit,
                             #header .search_mini_content .sbSelector
                             ',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform,
                              color,
                              text-align'
        )
    ),

    array(
        'id'         => 'mini-search-text',
        'type'       => 'typography',
        'name'       => __( 'Mini Search Input Text Font', 'yit' ),
        'desc'       => __( 'Choose the font type, size and color for the text input of mini search', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 13,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#a4a4a4',
            'align'     => 'left',
            'transform' => 'none'
        ),
        'style'           => array(
            'selectors'  => '.widget_search_mini input#search_mini',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform,
                              color,
                              text-align'
        )
    ),


    array(
        'id'         => 'mini-search-widget-button-colors',
        'type'       => 'colorpicker',
        'variations' => array(

            'border'     => __( 'Border', 'yit' ),
            'background' => __( 'Background', 'yit' ),
            'text-color' => __( 'Text Color', 'yit' ),
        ),
        'name'       => __( 'Mini Search Widget Button Colors', 'yit' ),
        'desc'       => __( 'Select the colors to use for the mini search widget button border and background', 'yit' ),
        'std'        => array(
            'color' => array(

                'border'     => '#1f1f1f',
                'background' => '#1f1f1f',
                'text-color' => '#ffffff',
            )
        ),
       'style'      => array(
           'text-color'     => array(
               'selectors'  => '#mini-search-submit, .yith-ajaxsearchform-container #yith-searchsubmit',
               'properties' => 'color'
           ),
            'border'     => array(
                'selectors'  => '#mini-search-submit, .yith-ajaxsearchform-container #yith-searchsubmit',
                'properties' => 'border-color'
            ),
            'background' => array(
                'selectors'  => '#mini-search-submit, .yith-ajaxsearchform-container #yith-searchsubmit',
                'properties' => 'background-color'
            )
        )
    ),


);
