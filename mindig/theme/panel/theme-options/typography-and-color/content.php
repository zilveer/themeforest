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
 * Return an array with the options for Theme Options > Typography and Color > Content
 *
 * @package Yithemes
 * @author  Andrea Grillo <andrea.grillo@yithemes.com>
 * @author  Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since   2.0.0
 * @return mixed array
 *
 */
return array(

    /* Typography and Color > Content > 404 Page */
    array(
        'type' => 'title',
        'name' => __( '404 Page', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'content-not-found-general-font',
        'type'            => 'typography',
        'name'            => __( 'Custom 404 page general font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 30,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#1f1f1f',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.error-404-text',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    /* Typography and Color > Content > FAQ */
    array(
        'type' => 'title',
        'name' => __( 'FAQ', 'yit' ),
        'desc' => '',
    ),

    array(
        'id'              => 'content-faq-title-font',
        'type'            => 'typography',
        'name'            => __( 'FAQ\'s title font', 'yit' ),
        'desc'            => __( 'Choose the font type, size, text transform and align for faq\'s.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'bold',
            'color'     => '#686868',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '#faqs-container .faq-wrapper .faq-title h4, .filters.faq li a',
            'properties' => 'font-size,
                             font-family,
                             font-weight,
                             color,
                             text-transform,
                             text-align'
        ),
    ),


    /* Typography and Color > Content > Blog & Portfolios */
    array(
        'type' => 'title',
        'name' => __( 'Blog & Portfolios', 'yit' ),
        'desc' => '',
    ),

    array(
        'id'              => 'content-blog-portfolios-title-font',
        'type'            => 'typography',
        'name'            => __( 'Blog & Portfolios page title font', 'yit' ),
        'desc'            => __( 'Choose the font type, size, text transform and align for blog and portfolios page.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 18,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.blog.big h3.post-title a,
                            .blog.small h3.post-title a,
                            .share-container .share-text,
                            .blog.masonry h3.post-title a,
                            #portfolio_big li .info h3.title a,
                            #portfolio_small li .info h3.title a',
            'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-transform,
                             text-align'
        ),
    ),

    array(
        'id'              => 'content-blog-portfolios-single-title-font',
        'type'            => 'typography',
        'name'            => __( 'Blog & Portfolios single page title font', 'yit' ),
        'desc'            => __( 'Choose the font type, size, text transform and align for single blog & portfolios page.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 18,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.blog.big.single h1.post-title a, .blog.big.single h1.post-title, #portfolio_nav .title h1.portfolios-title, ul#portfolio li div.portfolio-title a',
            'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-transform,
                             text-align'
        ),
    ),

    array(
        'id'         => 'content-blog-portfolios-title-link-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Title Color', 'yit' ),
            'hover'  => __( 'Title Color Hover', 'yit' )
        ),
        'linked_to'  => array(
            'hover' => 'theme-color-2'
        ),
        'name'       => __( 'Blog & Portfolios Title Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the links title in normal state and on hover.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#1f1f1f',
                'hover'  => '#fab000'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '.blog.big h3.post-title a,
                                 .blog.small h3.post-title a,
                                 .blog.masonry h3.post-title a,
                                 .blog h2.quote-title a,
                                 .blog_section.post_meta .title a,
                                 .morph-button-inflow.open .content-style-social a,
                                 .shortcode.morph-button-inflow > button a,
                                 .shortcode.morph-button-inflow > button,
                                 .shortcode.morph-button-inflow.open .content-style-social a,
                                 .blog.big.single h1.post-title a,
                                 .blog.big.single h1.post-title,
                                 #portfolio_big li .info h3.title a,
                                 #portfolio_small li .info h3.title a,
                                 #portfolio_nav .title h1.portfolios-title,
                                 ul#portfolio li div.portfolio-title a',
                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '.blog.big h3.post-title a:hover,
                                 .blog.small h3.post-title a:hover,
                                 .blog.masonry h3.post-title a:hover,
                                 .blog h2.quote-title a:hover,
                                 .blog_section.post_meta .title a:hover,
                                 .format-quote .blog.big h3.post-title a:hover,
                                 .blog.single .morph-button-inflow.open .content-style-social a:hover,
                                 .shortcode.morph-button-inflow > button a:hover,
                                 .shortcode.morph-button-inflow > button:hover,
                                 .shortcode.morph-button-inflow.open .content-style-social a:hover,
                                 #portfolio_big li .info h3.title a:hover,
                                 #portfolio_small li .info h3.title a:hover,
                                 ul#portfolio li div.portfolio-title a:hover',
                'properties' => 'color'
            )
        ),
    ),

    array(
        'id'              => 'content-blog-meta-font',
        'type'            => 'typography',
        'name'            => __( 'Meta info box', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color for meta info box.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 10,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#6b6868',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.blog .yit_post_meta,
                            .yit_shortcodes.recent-post .blog .yit_post_meta,
                            .yit_shortcodes.recent-post .yit_post_meta span.author,
                            .yit_shortcodes.recent-post span.author a,
                            .widget.yit-recent-posts .recent-post span.author,
                            .widget.yit-recent-posts .recent-post span.author a,
                            .widget.yit-recent-posts .recent-post span.num-comments,
                            .widget.yit-recent-posts .recent-post span.num-comments a,
                            .widget.yit-recent-posts .recent-post span.num-comments',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'         => 'content-blog-meta-link-hover-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Meta Link', 'yit' ),
            'hover'  => __( 'Meta Link Hover', 'yit' )
        ),
        'linked_to'  => array(
            'hover' => 'theme-color-2'
        ),
        'name'       => __( 'Meta Links', 'yit' ),
        'desc'       => __( 'Select the colors to use for the links in normal state and on hover.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#686868',
                'hover'  => '#fab000'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '.blog.big .yit_post_meta span a,
                                .blog.big .yit_post_meta span a:visited,
                                .blog.small .yit_post_meta a,
                                .blog.small .yit_post_meta a:visited,
                                .blog.masonry .yit_post_meta a,
                                .blog.masonry .yit_post_meta a:visited',
                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '.blog-masonry .masonry-brick .yit_post_content  .yit_post_meta span a:hover,
                                 .blog.big .yit_post_meta span a:hover,
                                 .blog.big .yit_post_meta span a:active,
                                 .blog.small .yit_post_meta a:hover,
                                 .blog.small .yit_post_meta a:active,
                                 .blog.masonry .yit_post_meta a:hover,
                                 .blog.masonry .yit_post_meta a:active,
                                 .blog.big.single .morph-button-inflow-2 > button span:hover',
                'properties' => 'color'
            )
        ),
    ),

    array(
        'id'              => 'content-blog-big-font',
        'type'            => 'typography',
        'name'            => __( 'Content font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color for content.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#1f1f1f',
            'align'     => 'center',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '.blog.big .yit_post_content p,
                             .blog.big.single .morph-button-inflow-2 > button',
            'properties' => 'font-size,
                              font-family,
                              font-family,
                              font-weight,
                              color,
                              text-align,
                              text-transform'
        ),
        'deps'            => array(
            'ids'    => 'blog-type',
            'values' => 'big'
        )
    ),

    array(
        'id'              => 'content-blog-small-font',
        'type'            => 'typography',
        'name'            => __( 'Content font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color for content.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#686868',
            'align'     => 'center',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '.blog.small .yit_post_content p,
                            .blog .small .yit_the_content p,
                            .blog.masonry .yit_post_content p,
                            .blog .masonry .yit_the_content p',
            'properties' => 'font-size,
                              font-family,
                              font-family,
                              font-weight,
                              color,
                              text-align,
                              text-transform'
        ),
        'deps'            => array(
            'ids'    => 'blog-type',
            'values' => 'small'
        )
    ),

    array(
        'id'              => 'content-blog-postformat-quote-content-font',
        'type'            => 'typography',
        'name'            => __( 'Postformat quote: Content', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color for the content in quote postformat.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 18,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#1f1f1f',
            'align'     => 'center',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '.format-quote .blog.big .yit_post_content p, .format-quote .blog.big.single .yit_the_content p',
            'properties' => 'font-size,
                             font-family,
                             font-family,
                             font-weight,
                             color,
                             text-align,
                             text-transform'
        ),
    ),

    array(
        'id'              => 'content-blog-postformat-quote-title-font',
        'type'            => 'typography',
        'name'            => __( 'Postformat quote: Title', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color for the title in quote postformat.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 10,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#6b6868',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.format-quote .blog.big h3.post-title a',
            'properties' => 'font-size,
                             font-family,
                             font-family,
                             font-weight,
                             color,
                             text-align,
                             text-transform'
        ),
    ),

    array(
        'id'         => 'content-blog-date-background-color',
        'type'       => 'colorpicker',
        'name'       => __( 'Blog: Post date background color', 'yit' ),
        'desc'       => __( 'Select the background color to use for the post date box.', 'yit' ),
        'variations' => array(
            'background' => __( 'Background Color', 'yit' ),
            'color'      => __( 'Text Color', 'yit' )
        ),
        'std'        => array(
            'color' => array(
                'background' => '#fab000',
                'color'      => '#ffffff'
            )
        ),
        'linked_to'  => array(
            'background' => 'general-background-color'
        ),
        'style'      => array(
            'background' => array(
                'selectors'  => '.blog .yit_post_meta_date',
                'properties' => 'background-color'
            ),
            'color'      => array(
                'selectors'  => '.blog .yit_post_meta_date .day, .blog .yit_post_meta_date .month',
                'properties' => 'color'
            )
        ),
    ),

    /* Typography and Color > Content > Comments */
    array(
        'type' => 'title',
        'name' => __( 'Comments', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'content-comments-font',
        'type'            => 'typography',
        'name'            => __( 'Comments Link font', 'yit' ),
        'desc'            => __( 'the font type, size, text transform and align.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'transform' => 'uppercase',
            'color'     => '#555555'
        ),
        'style'           => array(
            'selectors'  => '.reply_link, .comment-reply-link, #commentform .logged-in-as a, .comment-navigation .nav-previous a, .comment-navigation .nav-next a',
            'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-transform,
                             color'
        )
    ),

    /* Typography and Color > Content > Pagination */
    array(
        'type' => 'title',
        'name' => __( 'Pagination', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'content-pagination-font',
        'type'            => 'typography',
        'name'            => __( 'Pagination font', 'yit' ),
        'desc'            => __( 'the font type, size, text transform and align.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'   => 18,
            'unit'   => 'px',
            'family' => 'default',
            'style'  => 'regular',
            'align'  => 'center',
        ),
        'style'           => array(
            'selectors'  => '.general-pagination',
            'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-align'
        )
    ),

    array(
        'id'         => 'content-pagination-text-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal'   => __( 'Normal Color', 'yit' ),
            'hover'    => __( 'Hover Color', 'yit' ),
            'selected' => __( 'Selected Color', 'yit' )
        ),
        'name'       => __( 'Pagination Number Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the pagination links.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal'   => '#686868',
                'hover'    => '#fab000',
                'selected' => '#686868',
            )
        ),
        'linked_to'  => array(
            'hover' => 'theme-color-1',
        ),
        'style'      => array(
            'normal'   => array(
                'selectors'  => '.general-pagination a',
                'properties' => 'color'
            ),
            'hover'    => array(
                'selectors'  => '.general-pagination a:hover, #commentform .logged-in-as a:hover, .comment-navigation .nav-previous a:hover, .comment-navigation .nav-next a:hover',
                'properties' => 'color'
            ),
            'selected' => array(
                'selectors'  => '.general-pagination a.selected, .general-pagination a:hover.selected',
                'properties' => 'color'
            )
        )
    ),

    array(
        'id'         => 'content-pagination-background-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal'   => __( 'Normal Color', 'yit' ),
            'hover'    => __( 'Hover Color', 'yit' ),
            'selected' => __( 'Selected Color', 'yit' )
        ),
        'name'       => __( 'Pagination Background Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the pagination links.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal'   => '#ffffff',
                'hover'    => '#ffffff',
                'selected' => '#ffffff',
            )
        ),
        'style'      => array(
            'normal'   => array(
                'selectors'  => '.general-pagination a',
                'properties' => 'background-color'
            ),
            'hover'    => array(
                'selectors'  => '.general-pagination a:hover',
                'properties' => 'background-color'
            ),
            'selected' => array(
                'selectors'  => '.general-pagination a.selected',
                'properties' => 'background-color'
            )
        )
    ),

     /* Typography and Color > Content > Portfolio Masonry */
    array(
        'type' => 'title',
        'name' => __( 'Portfolio Masonry', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'         => 'content-portfolio-masonry-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal'   => __( 'Normal Color', 'yit' ),
            'hover'    => __( 'Hover Color', 'yit' ),
        ),
        'name'       => __( 'Portfolio Masonry Title Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the title of portfolio masonry.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal'   => '#ffffff',
                'hover'    => '#fab000',
            )
        ),
        'style'      => array(
            'normal'   => array(
                'selectors'  => 'a.eg-howardtaft-element-0,
                                 a.eg-howardtaft-element-1,
                                 a.eg-howardtaft-element-2,
                                 a.eg-howardtaft-element-3,
                                 a.eg-howardtaft-element-4,
                                 a.eg-howardtaft-element-5,
                                 a.eg-howardtaft-element-6,
                                 a.eg-howardtaft-element-7',
                'properties' => 'color'
            ),
            'hover'    => array(
                'selectors'  => 'a.eg-howardtaft-element-0:hover,
                                 a.eg-howardtaft-element-1:hover,
                                 a.eg-howardtaft-element-2:hover,
                                 a.eg-howardtaft-element-3:hover,
                                 a.eg-howardtaft-element-4:hover,
                                 a.eg-howardtaft-element-5:hover,
                                 a.eg-howardtaft-element-6:hover,
                                 a.eg-howardtaft-element-7:hover',
                'properties' => 'color'
            ),
        )
    ),


);

