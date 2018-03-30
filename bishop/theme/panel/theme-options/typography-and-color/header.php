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
        ),
        'in_skin' => true
    ),

    array(
        'id'    => 'header-background-color-sticky',
        'type'  => 'colorpicker',
        'name'  => __( 'Header background color in sticky position', 'yit' ),
        'desc'  => __( 'Select the color to use as background on your header when is in sticky position', 'yit' ),
        'std'   => array(
            'color'   => '#ffffff',
            'opacity' => 90,
        ),
        'style' => array(
            'selectors'  => '#header.sticky-header, #header.fixed-header, .force-sticky-header #header',
            'properties' => 'background-color'
        ),
        'in_skin' => true
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
            'size'      => 42,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#3a3a39',
            'align'     => 'left',
            'transform' => 'none',
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
            'size'      => 42,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#f7c104',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'linked_to'       => 'theme-color-1',
        'in_skin'        => true,
        'style'           => array(
            'selectors'  => '#logo #textual.highlight',
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
            'color'     => '#3a3a39',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '#tagline',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ),
        'in_skin'        => true
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
            'color'     => '#f7c104',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'linked_to'       => 'theme-color-1',
        'in_skin'        => true,
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
            'size'      => 24,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'bold',
            'color'     => '#000000',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '#slogan h2',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ),
        'in_skin'        => true
    ),

    array(
        'id'              => 'typography-header-subslogan-font',
        'type'            => 'typography',
        'name'            => __( 'Sub Slogan font', 'yit' ),
        'desc'            => __( 'Select the type to use for the sub slogan.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 16,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#555555',
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
        ),
        'in_skin'        => true
    ),

    array(
        'id'        => 'typography-slogan-highlight',
        'type'      => 'colorpicker',
        'name'      => __( 'Slogan title highlight', 'yit' ),
        'desc'      => __( 'Select the color to use for the highlight of titles', 'yit' ),
        'std'       => array(
            'color' => '#d3a310'
        ),
        'linked_to' => 'theme-color-2',
        'in_skin'        => true,
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
            'color' => '#f8f8f8'
        ),
        'style' => array(
            'selectors'  => '#slogan, .sticky .blog.small, .sticky .blog.big, .blog-masonry .sticky.masonry-brick .yit_post_content, .portfolio_small_image.portfolio-title-bar, #title_bar, #buddypress div.item-list-tabs ul:after, #buddypress div.item-list-tabs ul li a, #buddypress div.item-list-tabs ul li span, #buddypress div#invite-list, .buddypress .ac_results ul li',
            'properties' => 'background-color'
        ),
        'in_skin'        => true
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
        'default_font_id' => 'typography-website-paragraph',
        'in_skin'        => true,
        'std'             => array(
            'size'      => 15,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#ffffff',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'linked_to'       => array(
            ''
        ),
        'style'           => array(
            'selectors'  => '#topbar',
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
            'color' => '#212121'
        ),
        'style' => array(
            'selectors'  => '#topbar, #topbar #lang_sel > ul > li > ul, #topbar #wcml_currency_switcher > ul > li > ul, #topbar #wcml_currency_switcher ul.sbOptions',
            'properties' => 'background-color'
        ),
        'in_skin'        => true
    ),

    array(
        'id'    => 'typography-topbar-border-bottom-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Topbar border bottom color', 'yit' ),
        'desc'  => __( 'Select the color to use as border bottom on your topbar', 'yit' ),
        'std'   => array(
            'color' => '#212121'
        ),
        'style' => array(
            'selectors'  => '#topbar',
            'properties' => 'border-bottom-color'
        ),
        'in_skin'        => true
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
                'normal' => '#ffffff',
                'hover'  => '#f7c104'
            )
        ),
        'in_skin'        => true,
        'linked_to'  => array(
            'hover' => 'theme-color-1',
        ),
        'style'      => array(
            'normal' => array(
                //'selectors'   => '#header a, #header a:visited',
                'selectors'  => '#topbar a , #topbar a i',
                'properties' => 'color'
            ),
            'hover'  => array(
                //'selectors'   => '#header a:hover, #header a:active',
                'selectors'  => '#topbar a:hover, #topbar a:hover i',
                'properties' => 'color'
            ),
        )
    ),


    array(
        'id'              => 'typography-topbar-nav-font',
        'type'            => 'typography',
        'name'            => __( 'Topbar Navigation Font', 'yit' ),
        'desc'            => __( 'Select the font to use in a menu for the topbar.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#ffffff',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'linked_to'       => array(
            ''
        ),
        'in_skin'        => true,
        'style'           => array(
            'selectors'  => '#topbar  #lang_sel > ul > li a, #topbar #wcml_currency_switcher > ul > li a.sbSelector,
            #topbar #lang_sel > ul > li > ul > li a, #wcml_currency_switcher > ul > li > ul > li a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
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
                'normal' => '#ffffff',
                'hover'  => '#f7c104'
            )
        ),
        'linked_to'       => array(
            'hover'  => ''
        ),
        'in_skin'        => true,
        'style'      => array(
            'normal' => array(
                //'selectors'   => '#header a, #header a:visited',
                'selectors'  => '#topbar #wcml_currency_switcher > ul > li a.sbSelector, #topbar #lang_sel > ul > li a,
                #topbar #wcml_currency_switcher > ul > li a.sbSelector, #topbar #lang_sel > ul > li > ul > li a,
                #wcml_currency_switcher > ul > li > ul > li a, #topbar #wcml_currency_switcher ul li a',
                'properties' => 'color'
            ),
            'hover'  => array(
                //'selectors'   => '#header a:hover, #header a:active',
                'selectors'  => '#lang_sel > ul > li > a:hover span, #topbar #lang_sel:hover > ul > li a > #topbar #wcml_currency_switcher > ul > li a.sbSelector:hover,
                #topbar #lang_sel > ul > li a:hover, #topbar #wcml_currency_switcher > ul > li a.sbSelector:hover,
                #topbar #lang_sel > ul > li > ul > li a:hover,
                #wcml_currency_switcher > ul > li > ul > li a:hover,
                #topbar #wcml_currency_switcher > ul > li a.sbToggle,
                #wcml_currency_switcher .sbHolder a.sbToggle.sbToggleOpen,
                #topbar #wcml_currency_switcher ul li a:hover,
                #topbar #lang_sel:hover > ul > li > a,
                #topbar #wcml_currency_switcher:hover > ul > li a.sbSelector,
                #topbar #wcml_currency_switcher:hover > ul > li > a',
                'properties' => 'color'
            ),
        )
    ),


    /* Infobar */

    array(
        'type' => 'title',
        'name' => __( 'Infobar', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'infobar-font',
        'type'            => 'typography',
        'name'            => __( 'Infobar font', 'yit' ),
        'desc'            => __( 'Select the font to use for the infobar.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 15,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#a6a6a6',
            'align'     => 'center',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '#infobar',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ),
        'in_skin'        => true
    ),

    array(
        'id'    => 'infobar-background-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Infobar background color', 'yit' ),
        'desc'  => __( 'Select the color to use as background on your page infobar', 'yit' ),
        'std'   => array(
            'color'   => '#f8f8f8',
            'opacity' => 100,
        ),
        'style' => array(
            'selectors'  => '#infobar',
            'properties' => 'background-color'
        ),
        'in_skin'        => true
    ),

    array(
        'id'    => 'infobar-background-image',
        'type'  => 'upload',
        'name'  => __( 'Infobar background image', 'yit' ),
        'desc'  => __( 'Select the image to use as background on your page infobar', 'yit' ),
        'std'   => '',
        'style' => array(
            'selectors'  => '#infobar',
            'properties' => 'background-image'
        )
    ),

    array(
        'id'      => 'infobar-background-repeat',
        'type'    => 'select',
        'options' => array(
            'repeat'    => __( 'Repeat', 'yit' ),
            'repeat-x'  => __( 'Repeat Horizontally', 'yit' ),
            'repeat-y'  => __( 'Repeat Vertically', 'yit' ),
            'no-repeat' => __( 'No Repeat', 'yit' )
        ),
        'name'    => __( 'Background repeat', 'yit' ),
        'desc'    => __( 'Select the repeat mode for the background image of infobar.', 'yit' ),
        'std'     => 'no-repeat',
        'style'   => array(
            'selectors'  => '#infobar',
            'properties' => 'background-repeat'
        )
    ),

    array(
        'id'      => 'infobar-background-position',
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
            'selectors'  => '#infobar',
            'properties' => 'background-position'
        )
    ),

    array(
        'id'      => 'infobar-background-attachment',
        'type'    => 'select',
        'options' => array(
            'scroll' => __( 'Scroll', 'yit' ),
            'fixed'  => __( 'Fixed', 'yit' )
        ),
        'name'    => __( 'Background attachment', 'yit' ),
        'desc'    => __( 'Select the attachment for the background image of header.', 'yit' ),
        'std'     => 'scroll',
        'style'   => array(
            'selectors'  => '#infobar',
            'properties' => 'background-attachment'
        )
    ),

    array(
        'id'         => 'infobar-link-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Links', 'yit' ),
            'hover'  => __( 'Links hover', 'yit' )
        ),
        'name'       => __( 'Links', 'yit' ),
        'desc'       => __( 'Select the type to use for the links in your infobar', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#f7c104',
                'hover'  => '#ffffff'
            )
        ),
        'linked_to'  => array(
            'normal' => 'theme-color-1',
        ),
        'in_skin'        => true,
        'style'      => array(
            'normal' => array(
                'selectors'  => '#infobar a',
                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '#infobar a:hover',
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
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.nav ul > li a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform,
                              text-align'
        ),
        'in_skin'        => true
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
                'normal' => '#000000',
                'hover'  => '#d3a310',
            )
        ),
        'linked_to'  => array(
            'hover' => 'theme-color-2',
        ),
        'in_skin'        => true,
        'style'      => array(
            'normal' => array(
                'selectors'  => '.nav ul > li a',
                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '#header-sidebar #lang_sel ul > li > ul > li a:hover, .nav ul > li a:hover, .nav ul > li a:focus,
                .nav .current-menu-item > a, .nav .current-menu-ancestor > a ,.nav .current-page-item > a, .nav ul > li:hover > a,
                #header .nav li.menu-close > a',
                'properties' => 'color'
            )
        )
    ),


    array(
        'id'        => 'typography-navigation-menu-animation-border-color',
        'type'      => 'colorpicker',
        'name'      => __( 'Animation of navigation item border color', 'yit' ),
        'desc'      => __( 'Choose the color of borders in animation when the status is "hover".', 'yit' ),
        'std'       => array(
            'color' => '#f7c104'
        ),
        'linked_to' => 'theme-color-1',
        'in_skin'        => true,
        'style'     => array(
            'selectors'  => '.nav ul > li a::before,
.nav ul > li a::after, #header-sidebar #lang_sel > ul > li > a::before, #header-sidebar #lang_sel > ul > li > a::after',
            'properties' => 'background'
        )
    ),

    array(
        'id'         => 'typography-navigation-menu-home',
        'type'       => 'colorpicker',
        'variations' => array(
            'background' => __( 'Background Color', 'yit' ),
            'home'       => __( 'Home Color', 'yit' ),
        ),
        'name'       => __( 'Home Icon menu item', 'yit' ),
        'desc'       => __( 'Choose the colors of home icon when this menu item has class "icon-home"', 'yit' ),
        'std'        => array(
            'color' => array(
                'background' => '#f7c104',
                'home'       => '#ffffff',
            )
        ),
        'linked_to'  => array(
            'background' => 'theme-color-1',
        ),
        'in_skin'        => true,
        'style'      => array(
            'background' => array(
                'selectors'  => '.nav ul > li.icon-home',
                'properties' => 'background'
            ),
            'home'       => array(
                'selectors'  => 'nav ul > li.icon-home a, nav ul > li.icon-home a:hover, nav ul > li.icon-home:hover a,  .nav ul > li.icon-home a:hover, .nav ul > li.icon-home a',
                'properties' => 'color'
            )
        )
    ),


    array(
        'id'        => 'typography-navigation-border-color',
        'type'      => 'colorpicker',
        'name'      => __( 'Navigation border color', 'yit' ),
        'desc'      => __( 'Select the color to use as border on your navigation bar', 'yit' ),
        'std'       => array(
            'color' => '#f7c104'
        ),
        'linked_to' => 'theme-color-1',
        'in_skin'        => true,
        'style'     => array(
            'selectors'  => '.nav div.submenu > ul.sub-menu,
                            #welcome-menu-login.nav ul li.login-menu div.submenu,
                            #header-sidebar #lang_sel ul li ul,
                            #header-sidebar .widget_nav_menu li:hover ul.sub-menu,
                            #header-sidebar .widget_nav_menu #lang_sel:hover ul li ul,
                            .nav .megamenu .submenu,
                            #welcome-menu-login.nav ul li.login-menu div.submenu,
                            .nav .bigmenu >.submenu',
            'properties' => 'border-color'
        )
    ),

    array(
        'id'              => 'typography-nav-highlight-font',
        'type'            => 'typography',
        'name'            => __( 'Navigation Hightlight font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color for the navigation hightlight.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 10,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '700',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.nav  span.highlight, .nav  span.highlight-inverse',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform,
                              text-align'
        ),
        'in_skin'        => true
    ),


    array(
        'id'         => 'typography-nav-highlight-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'text'       => __( 'Text', 'yit' ),
            'background' => __( 'Background', 'yit' ),
        ),
        'name'       => __( 'Highlight Colors', 'yit' ),
        'desc'       => __( 'Select the colors to use for the highlight text in menu item when the title is marked by []', 'yit' ),
        'std'        => array(
            'color' => array(
                'text'       => '#000000',
                'background' => '#f7c104',
            )
        ),
        'linked_to'  => array(
            'background' => 'theme-color-1',
        ),
        'in_skin'        => true,
        'style'      => array(
            'text'       => array(
                'selectors'  => '.nav  span.highlight',
                'properties' => 'color'
            ),
            'background' => array(
                'selectors'  => '.nav  span.highlight',
                'properties' => 'background'
            )
        )
    ),

    array(
        'id'         => 'typography-nav-highlight-color-inverse',
        'type'       => 'colorpicker',
        'variations' => array(
            'text'       => __( 'Text', 'yit' ),
            'background' => __( 'Background', 'yit' ),
        ),
        'name'       => __( 'Highlight Colors Inverse', 'yit' ),
        'desc'       => __( 'Select the colors to use for the highlight text in menu item when the title is marked by {}', 'yit' ),
        'std'        => array(
            'color' => array(
                'text'       => '#f7c104',
                'background' => '#000000',
            )
        ),
        'linked_to'  => array(
            'text' => 'theme-color-1',
        ),
        'in_skin'        => true,
        'style'      => array(
            'text'       => array(
                'selectors'  => '.nav  span.highlight-inverse',
                'properties' => 'color'
            ),
            'background' => array(
                'selectors'  => '.nav  span.highlight-inverse',
                'properties' => 'background'
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
            'selectors'  => '.nav .bigmenu >.submenu,
                            .nav ul.sub-menu,
                            #header-sidebar #lang_sel ul li ul,
                            .nav .megamenu div.submenu,
                            #welcome-menu-login.nav ul li.login-menu div.submenu,
                            #menu-welcome-login > li div > div.login-box.with_registration',
            'properties' => 'background-color'
        ),
        'in_skin'        => true,
    ),


    array(
        'id'              => 'typography-subnavigation-menu-font',
        'type'            => 'typography',
        'name'            => __( 'Sub Navigation font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color for the subnavigation.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.nav ul.sub-menu li a, .nav ul.children li a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform,
                              text-align'
        ),
        'in_skin'        => true,
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
                'normal' => '#797979',
                'hover'  => '#d3a310',
            )
        ),
        'linked_to'  => array(
            'hover' => 'theme-color-2',
        ),
        'in_skin'        => true,
        'style'      => array(
            'normal' => array(
                'selectors'  => '.nav ul.sub-menu li a, .nav ul.children li a, .nav li.megamenu ul.sub-menu li a, .nav li.bigmenu ul.sub-menu li a',
                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '.nav ul.sub-menu li a:hover, .nav ul.children li a:hover,  .nav ul.sub-menu li a:hover, .nav ul.children li a:hover',
                'properties' => 'color'
            )
        )
    ),

    /* Typography and Color > Megamenu */
    array(
        'type' => 'title',
        'name' => __( 'Megamenu and Big Menu', 'yit' ),
        'desc' => ''
    ),
    array(
        'id'              => 'typography-mega-menu-font',
        'type'            => 'typography',
        'name'            => __( 'Mega Menu font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color for the mega menu', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.nav .megamenu ul.sub-menu li a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform,
                              text-align'
        ),
        'in_skin'        => true,
    ),

    array(
        'id'         => 'typography-mega-menu-link-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'title-normal'   => __( 'Title', 'yit' ),
            'title-hover'    => __( 'Title hover', 'yit' ),
            'submenu-normal' => __( 'Submenu', 'yit' ),
            'submenu-hover'  => __( 'Submenu hover', 'yit' )
        ),
        'name'       => __( 'Megamenu Links Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the links in megamenu', 'yit' ),
        'std'        => array(
            'color' => array(
                'title-normal'   => '#000000',
                'title-hover'    => '#000000',
                'submenu-normal' => '#797979',
                'submenu-hover'  => '#d3a310'
            )
        ),
        'linked_to'  => array(
            'submenu-hover' => 'theme-color-2',
        ),
        'in_skin'        => true,
        'style'      => array(
            'title-normal'   => array(
                'selectors'  => '.nav .megamenu > .submenu > ul.sub-menu > li > a, .nav .bigmenu > .submenu > ul.sub-menu > li > a',
                'properties' => 'color'
            ),
            'title-hover'    => array(
                'selectors'  => '.nav .megamenu > .submenu > ul.sub-menu > li > a:hover, .nav .megamenu > .submenu > ul.sub-menu > li:hover > a
                , .nav .bigmenu > .submenu > ul.sub-menu > li > a:hover, .nav .bigmenu > .submenu > ul.sub-menu > li:hover > a',
                'properties' => 'color'
            ),
            'submenu-normal' => array(
                'selectors'  => '.nav div.submenu li > div.submenu li a, .nav .megamenu div.submenu li > div.submenu li a, .nav .bigmenu div.submenu li > div.submenu li a',
                'properties' => 'color'
            ),
            'submenu-hover'  => array(
                'selectors'  => '.nav div.submenu li > div.submenu li a:hover, .nav .megamenu div.submenu li > div.submenu li a:hover, .nav .megamenu div.submenu li > div.submenu li:hover a, .nav .bigmenu div.submenu li > div.submenu li a:hover, .nav .bigmenu div.submenu li > div.submenu li:hover a',
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
        'id'         => 'mini-search-widget-colors',
        'type'       => 'colorpicker',
        'variations' => array(
            'border'     => __( 'Border', 'yit' ),
            'background' => __( 'Background', 'yit' ),
        ),
        'name'       => __( 'Mini Search Widget Colors', 'yit' ),
        'desc'       => __( 'Select the colors to use for the mini search widget border and background', 'yit' ),
        'std'        => array(
            'color' => array(
                'border'     => '#f7c104',
                'background' => '#ffffff',
            )
        ),
        'linked_to'  => array(
            'border' => 'theme-color-1',
        ),
        'in_skin'        => true,
        'style'      => array(
            'border'     => array(
                'selectors'  => '#header-sidebar .widget_search_mini .search_mini_content.animated, .skin1 #header-sidebar .widget_search_mini .search_mini_content, .skin2 #header-sidebar .widget_search_mini .search_mini_content.animated',
                'properties' => 'border-color'
            ),
            'background' => array(
                'selectors'  => '#header-sidebar .widget_search_mini .search_mini_content.animated, .skin1 #header-sidebar .widget_search_mini .search_mini_content',
                'properties' => 'background'
            )
        )
    ),


    array(
        'id'         => 'mini-search-widget-button-colors',
        'type'       => 'colorpicker',
        'variations' => array(
            'border'     => __( 'Border', 'yit' ),
            'background' => __( 'Background', 'yit' ),
        ),
        'name'       => __( 'Mini Search Widget Button Colors', 'yit' ),
        'desc'       => __( 'Select the colors to use for the mini search widget button border and background', 'yit' ),
        'std'        => array(
            'color' => array(
                'border'     => '#D3A310',
                'background' => '#f7c104',
            )
        ),
        'linked_to'  => array(
            'border'     => 'theme-color-2',
            'background' => 'theme-color-1',
        ),
        'in_skin'        => true,
        'style'      => array(
            'border'     => array(
                'selectors'  => '#mini-search-submit, .yith-ajaxsearchform-container #yith-searchsubmit, .skin2 #mini-search-submit, .skin2 .yith-ajaxsearchform-container #yith-searchsubmit',
                'properties' => 'border-color'
            ),
            'background' => array(
                'selectors'  => '#mini-search-submit, .yith-ajaxsearchform-container #yith-searchsubmit, .skin2 #mini-search-submit, .skin2 .yith-ajaxsearchform-container #yith-searchsubmit',
                'properties' => 'background-color'
            )
        )
    ),
);
