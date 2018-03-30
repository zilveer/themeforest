<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */


/**
 * Return an array with the options for Theme Options > Typography and Color > Sidebars
 *
 * @package Yithemes
 * @author Andrea Frascaspata <andrea.frascapsata@yithemes.com>
 * @since 2.0.0
 * @return mixed array
 *
 */
return array(

     /* Typography and Color > widgets and sidebars */
    array(
        'type' => 'title',
        'name' => __( 'Sidebars', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'sidebar-title-font',
        'type' => 'typography',
        'name' => __( 'Sidebar title font', 'yit' ),
        'desc' => __( 'Choose the font type, size and color.', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-title',
        'std'   => array(
            'size'      => 17,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'bold',
            'color'     => '#000000',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style' => array(
            'selectors'   => '.widget h3,
                              #buddypress div.item-list-tabs:not(#subnav) ul li a:hover,
                              #buddypress div.item-list-tabs:not(#subnav) ul li.selected a,
                              #buddypress div.item-list-tabs:not(#subnav) ul li.current a',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ),
        'in_skin'        => true,
    ),

    array(
        'type' => 'title',
        'name' => __( 'Contact Info', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'widget-contact-info-title',
        'type' => 'typography',
        'name' => __( 'Widget contact info title font', 'yit' ),
        'desc' => __( 'Choose the font type, size and color.', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'   => array(
            'size'      => 15,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#000000',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style' => array(
            'selectors'   => '.contact-info > h3',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ) ,
        'in_skin'        => true,
    ),
    array(
        'id' => 'widget-contact-info-subtitle',
        'type' => 'typography',
        'name' => __( 'Widget contact info subtitle font', 'yit' ),
        'desc' => __( 'Choose the font type, size and color.', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'   => array(
            'size'      => 24,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'bold',
            'color'     => '#000000',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style' => array(
            'selectors'   => '.contact-info > h2',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ) ,
        'in_skin'        => true,
    ),
    array(
        'id' => 'widget-contact-info-label',
        'type' => 'typography',
        'name' => __( 'Widget contact info label font', 'yit' ),
        'desc' => __( 'Choose the font type, size and color.', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'   => array(
            'size'      => 16,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'bold',
            'color'     => '#202020',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style' => array(
            'selectors'   => '.contact-info ul li strong',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ) ,
        'in_skin'        => true,
    ),
    array(
        'id' => 'widget-contact-info-value',
        'type' => 'typography',
        'name' => __( 'Widget contact info value font', 'yit' ),
        'desc' => __( 'Choose the font type, size and color.', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'   => array(
            'size'      => 16,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#5f5d5d',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style' => array(
            'selectors'   => '.contact-info ul li',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ) ,
        'in_skin'        => true,
    ),

    array(
        'type' => 'title',
        'name' => __( 'Teaser', 'yit' ),
        'desc' => ''
    ),
    array(
        'id' => 'widget-teaser-slogan-font',
        'type' => 'typography',
        'name' => __( 'Widget Teaser slogan font', 'yit' ),
        'desc' => __( 'Choose the font type, size and color.', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'   => array(
            'size'      => 24,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#ffffff',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style' => array(
            'selectors'   => '.widget.teaser .image-banner-text .title',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ),
        'in_skin'        => true,

    ),

    array(
        'id' => 'widget-teaser-subslogan-font',
        'type' => 'typography',
        'name' => __( 'Widget Teaser subslogan font', 'yit' ),
        'desc' => __( 'Choose the font type, size and color.', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'   => array(
            'size'      => 18,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#f7c104',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style' => array(
            'selectors'   => '.widget.teaser .image-banner-text .subtitle',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )  ,
        'in_skin'        => true,

    ),

    array(
        'type' => 'title',
        'name' => __( 'Toggle Menu', 'yit' ),
        'desc' => ''
    ),
    array(
        'id' => 'widget-toggle-menu-font',
        'type' => 'typography',
        'name' => __( 'Widget Toggle Menu font', 'yit' ),
        'desc' => __( 'Choose the font type, size and color.', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'   => array(
            'size'      => 15,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '700',
            'color'     => '#000000',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style' => array(
            'selectors'   => '.widget.yit_toggle_menu ul.menu > li > a',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ) ,
        'in_skin'        => true,

    ),

    array(
        'id' => 'widget-toggle-submenu-font',
        'type' => 'typography',
        'name' => __( 'Widget Toggle Submenu font', 'yit' ),
        'desc' => __( 'Choose the font type, size and color.', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'   => array(
            'size'      => 15,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#5f5d5d',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style' => array(
            'selectors'   => '.widget.yit_toggle_menu ul.sub-menu li a',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ) ,
        'in_skin'        => true,

    ),

);