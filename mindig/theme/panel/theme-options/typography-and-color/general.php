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
 * Return an array with the options for Theme Options > Typography and Color > General Settings
 *
 * @package Yithemes
 * @author  Andrea Grillo <andrea.grillo@yithemes.com>
 * @author  Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since   2.0.0
 * @return mixed array
 *
 */
return array(

    /* Typography and Color > General Settings */
    array(
        'type' => 'title',
        'name' => __( 'General Settings', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'         => 'typography-website-title',
        'type'       => 'typography',
        'name'       => __( 'Website title typography', 'yit' ),
        'desc'       => __( 'Select the font used in the theme for the titles', 'yit' ),
        'min'        => 1,
        'max'        => 80,
        'preview'    => false,
        'is_default' => true,
        'std'        => array(
            'family' => 'Oswald',
        ),
        'style'      => array(
            'selectors'  => 'h1, h2, h3, h4, h5, h6,
                            .blog .yit_post_meta_date span,
                            div.blog_post .yit_post_date span, a[class^=eg-portfolio-masonry],
                            .call-to-action-two .call-to-action-two-container div.incipit span,
                            .call-three .newsletter-cta-form-container .text span.newsletter-cta-title,
                            .call-three .newsletter-cta-form-container .text span.newsletter-cta-incipit,
                            .counter .number',
            'properties' => 'font-family'
        )
    ),

    array(
        'id'         => 'typography-website-paragraph',
        'type'       => 'typography',
        'name'       => __( 'Website paragraph typography', 'yit' ),
        'desc'       => __( 'Select the font used in the theme for the paragraphs', 'yit' ),
        'min'        => 1,
        'max'        => 80,
        'preview'    => false,
        'is_default' => true,
        'std'        => array(
            'family' => 'Source Sans Pro',
        ),
        'style'      => array(
            'selectors'  => 'body, p, li, address, dd, blockquote, td, th, .blog.single .content-style-social:after',
            'properties' => 'font-family'
        )
    ),

    array(
        'id'        => 'typography-website-title-highlight',
        'type'      => 'colorpicker',
        'name'      => __( 'Website title highlight color', 'yit' ),
        'desc'      => __( 'Select the color used in the theme for the highlighted titles', 'yit' ),
        'std'       => array(
            'color' => '#fab000'
        ),
        'style'     => array(
            'selectors'  => '.highlight, .numbers-sections h4 span.title-highlight',
            'properties' => 'color'
        ),
        'linked_to' => 'theme-color-1'
    ),

    array(
        'id'              => 'typography-website-special-font',
        'type'            => 'typography',
        'name'            => __( 'Special font', 'yit' ),
        'desc'            => __( 'Select the type to use for the special font.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'Oswald',
            'style'     => 'regular',
            'color'     => '#3a3a39',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '.special-font, .special-font a.btn-alternative,a.checkout-button.button.alt.wc-forward',
            'properties' => 'font-size,
                             font-family,
                             font-weight,
                             color,
                             text-transform,
                             text-align'
        )
    ),

     array(
        'id'              => 'typography-website-quote-font',
        'type'            => 'typography',
        'name'            => __( 'Quote icon', 'yit' ),
        'desc'            => __( 'Select the type to use for the quote icon.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 72,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#fab000',
        ),
        'style'           => array(
            'selectors'  => '.quote-icon, .testimonial-wrapper .testimonial-cit:before, .testimonials-slider ul.testimonial-content li blockquote p:before',
            'properties' => 'font-size,
                             font-family,
                             font-weight,
                             color'
        )
    ),


    /* Typography and Color > Background colors */
    array(
        'type' => 'title',
        'name' => __( 'Background and Colors', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'   => 'background-style',
        'type' => 'bgpreview',
        'name' => __( 'Custom background', 'yit' ),
        'desc' => __( 'Select a background for the body of all pages.', 'yit' ),
        'std'  => array( 'image' => '', 'color' => '#ffffff' ),
         'style'   => array(
            'selectors'  => 'body, .st-content, .st-content-inner, .stretched-layout .blog.single .content-style-social,
            .shortcode .content-style-social,
            #portfolio_nav .prev a[rel=prev], #portfolio_nav .next a[rel=next], #product-nav > a, .team-section .member-social',
            'properties' => 'background-color'
        ),
    ),

    array(
        'id'    => 'background-custom-image',
        'type'  => 'upload',
        'name'  => __( 'Background custom image', 'yit' ),
        'desc'  => __( 'Select a custom image, if you have set "Custom" in the above option', 'yit' ),
        'std'   => '',
        'style' => array(
            'selectors'  => 'body',
            'properties' => 'background-image'
        ),
        'deps'  => array(
            'ids'    => "typography-background-style_image",
            'values' => 'custom'
        )
    ),

    array(
        'id'      => 'background-repeat',
        'type'    => 'select',
        'options' => array(
            'repeat'    => __( 'Repeat', 'yit' ),
            'repeat-x'  => __( 'Repeat Horizontally', 'yit' ),
            'repeat-y'  => __( 'Repeat Vertically', 'yit' ),
            'no-repeat' => __( 'No Repeat', 'yit' )
        ),
        'name'    => __( 'Background repeat', 'yit' ),
        'desc'    => __( 'Select the repeat mode for the background image.', 'yit' ),
        'std'     => 'no-repeat',
        'style'   => array(
            'selectors'  => 'body',
            'properties' => 'background-repeat'
        )
    ),

    array(
        'id'      => 'background-position',
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
        'desc'    => __( 'Select the position for the background image.', 'yit' ),
        'std'     => 'top left',
        'style'   => array(
            'selectors'  => 'body',
            'properties' => 'background-position'
        )
    ),

    array(
        'id'      => 'background-attachment',
        'type'    => 'select',
        'options' => array(
            'scroll' => __( 'Scroll', 'yit' ),
            'fixed'  => __( 'Fixed', 'yit' )
        ),
        'name'    => __( 'Background attachment', 'yit' ),
        'desc'    => __( 'Select the attachment for the background image.', 'yit' ),
        'std'     => 'scroll',
        'style'   => array(
            'selectors'  => 'body',
            'properties' => 'background-attachment'
        )
    ),

    array(
        'id'      => 'container-background-color',
        'type'    => 'colorpicker',
        'name'    => __( 'Background color for container in boxed layout', 'yit' ),
        'desc'    => __( 'Select a background color for the container of all pages in boxed layout.', 'yit' ),
        'std'     => array(
            'color' => '#ffffff'
        ),
        'style'   => array(
            'selectors'  => '.boxed-layout #wrapper, .boxed-layout .blog.single .content-style-social',
            'properties' => 'background-color'
        ),
        'deps' => array(
            'ids' => 'general-layout-type',
            'values' => 'boxed'
        )
    )
);

