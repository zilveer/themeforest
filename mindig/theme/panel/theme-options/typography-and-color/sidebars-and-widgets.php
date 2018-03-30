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
            'size'      => 18,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#1f1f1f',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style' => array(
            'selectors'   => '.widget h3,
                              #bbpress-forums li.bbp-header > ul > li,
                              .widget h3 a.rsswidget',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'type' => 'title',
        'name' => __( 'General Entry Title', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'widget-general-hentry-title',
        'type' => 'typography',
        'name' => __( 'Widget general entry title font', 'yit' ),
        'desc' => __( 'Choose the font type, size and color.', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-title',
        'std'   => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#686868',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style' => array(
            'selectors'   => '.widget.yit-recent-posts .recent-post .text > div.post-content > a.title,
                              .widget.widget_recent_entries ul li a,
                              .widget.widget_rss ul li a.rsswidget,
                              .comments-info-wrapper span.author a, .widget.testimonial-widget .name-testimonial,
                              .sidebar .widget.yit_text_image div.widget_text h5,
                              .widget.contact-info .info-container h5,
                              .contact-info .info-container h5,
                              .widget.contact-info .info-container h5 span,
                              .contact-info .info-container h5 span,
                              .contact-info .info-container h5,
                              .sidebar .widget.yit_text_image div.widget_text h5 span,
                              .widget.yit_recent_reviews .review-meta-avatar .author',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
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
        'default_font_id' => 'typography-website-title',
        'std'   => array(
            'size'      => 18,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'bold',
            'color'     => '#1f1f1f',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style' => array(
            'selectors'   => '.widget.teaser .image_banner_inside  .title',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )

    ),

    array(
        'id' => 'widget-teaser-subslogan-font',
        'type' => 'typography',
        'name' => __( 'Widget Teaser subslogan font', 'yit' ),
        'desc' => __( 'Choose the font type, size and color.', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-title',
        'std'   => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#474747',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style' => array(
            'selectors'   => '.widget.teaser .image_banner_inside .subtitle, .btn-ghost, .teaser .btn-ghost, ul.blog_posts li div.blog_post .yit_post_meta span.title a',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),
    array(
        'type' => 'title',
        'name' => __( 'Contact form', 'yit' ),
        'desc' => ''
    ),
    array(
        'id' => 'shortcode-contact-form-label-font',
        'type' => 'typography',
        'name' => __( 'Contact form label font', 'yit' ),
        'desc' => __( 'Choose the font type, size and color.', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-title',
        'std'   => array(
            'size'      => 13,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#a4a4a4',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style' => array(
            'selectors'   => '.contact-form label, #bbpress-forums fieldset label[for]',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
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
        'default_font_id' => 'typography-website-title',
        'std'   => array(
            'size'      => 13,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#a4a4a4',
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
        )
    ),

    array(
        'id' => 'widget-toggle-submenu-font',
        'type' => 'typography',
        'name' => __( 'Widget Toggle Submenu font', 'yit' ),
        'desc' => __( 'Choose the font type, size and color.', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-title',
        'std'   => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#a4a4a4',
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
        )
    ),

);