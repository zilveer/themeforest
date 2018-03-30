<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

global $more, $wp_query;

$more                    = true;
$hide_footer             = ( yit_get_option( 'blog-single-hide-footer' ) == 'yes' ) ? true : false;
$post_format             = ( ! get_post_format() ) ? 'standard' : get_post_format();
$is_quote                = ( $post_format == 'quote' ) ? true : false;
$show_thumbnail          = ( yit_get_option( 'blog-single-show-featured-image' ) == 'yes' && has_post_thumbnail() && $post_format == 'standard' ) ? true : false;
$show_title              = ( yit_get_option( 'blog-single-show-title' ) == 'yes' ) ? true : false;
$show_date               = ( yit_get_option( 'blog-single-show-date' ) == 'yes' ) ? true : false;
$show_author             = ( yit_get_option( 'blog-single-show-author' ) == 'yes'  && get_the_author() != false ) ? true : false;
$show_categories         = ( yit_get_option( 'blog-single-show-categories' ) == 'yes' ) ? true : false;
$show_tags               = ( yit_get_option( 'blog-single-show-tags' ) == 'yes' ) ? true : false;
$show_comments           = ( yit_get_option( 'blog-single-show-comments' ) == 'yes' ) ? true : false;
$show_read_more          = ( yit_get_option( 'blog-single-show-read-more' ) == 'yes' ) ? true : false;
$show_share              = ( yit_get_option( 'blog-single-show-share' ) == 'yes' ) ? true : false;
$show_meta_box           = ( $show_author || $show_date || $show_comments || $show_categories || ( $show_tags && $has_tags ) || $show_share ) ? true : false;
$author_icon_options     = yit_get_option( 'blog-single-author-icon' );
$author_icon_type        = $author_icon_options['select'];
$author_icon             = ( $author_icon_type == 'none' ) ? false : ( ( $author_icon_type == 'icon' ) ? '<i class="fa fa-' . $author_icon_options['icon'] . '"></i>' : 'style="background: transparent url(' . yit_ssl_url( $author_icon_options['custom'] ) . ') top left no-repeat"' );
$author_icon_class       = ( $author_icon_type == 'none' ) ? 'without-icon' : ( ( $author_icon_type == 'custom' ) ? 'with-icon' : 'with-icon awesome' );
$categories_icon_options = yit_get_option( 'blog-single-categories-icon' );
$categories_icon_type    = $categories_icon_options['select'];
$categories_icon         = ( $categories_icon_type == 'none' ) ? false : ( ( $categories_icon_type == 'icon' ) ? '<i class="fa fa-' . $categories_icon_options['icon'] . '"></i>' : 'style="background: transparent url(' . yit_ssl_url( $categories_icon_options['custom'] ) . ') top left no-repeat"' );
$categories_icon_class   = ( $categories_icon_type == 'none' ) ? 'without-icon' : ( ( $categories_icon_type == 'custom' ) ? 'with-icon' : 'with-icon awesome' );
$tags_icon_options       = yit_get_option( 'blog-single-tags-icon' );
$tags_icon_type          = $tags_icon_options['select'];
$tags_icon               = ( $tags_icon_type == 'none' ) ? false : ( ( $tags_icon_type == 'icon' ) ? '<i class="fa fa-' . $tags_icon_options['icon'] . '"></i>' : 'style="background: transparent url(' . yit_ssl_url( $tags_icon_options['custom'] ) . ') top left no-repeat"' );
$tags_icon_class         = ( $tags_icon_type == 'none' ) ? 'without-icon' : ( ( $tags_icon_type == 'custom' ) ? 'with-icon' : 'with-icon awesome' );
$comments_icon_options   = yit_get_option( 'blog-single-comments-icon' );
$comments_icon_type      = $comments_icon_options['select'];
$comments_icon           = ( $comments_icon_type == 'none' ) ? false : ( ( $comments_icon_type == 'icon' ) ? '<i class="fa fa-' . $comments_icon_options['icon'] . '"></i>' : 'style="background: transparent url(' . yit_ssl_url( $comments_icon_options['custom'] ) . ') top left no-repeat"' );
$comments_icon_class     = ( $comments_icon_type == 'none' ) ? 'without-icon' : ( ( $comments_icon_type == 'custom' ) ? 'with-icon' : 'with-icon awesome' );
$share_icon_options      = yit_get_option( 'blog-single-share-icon' );
$share_icon_type         = $share_icon_options['select'];
$share_icon              = ( $share_icon_type == 'none' ) ? false : ( ( $share_icon_type == 'icon' ) ? '<i class="fa fa-' . $share_icon_options['icon'] . '"></i>' : 'style="background: transparent url(' . yit_ssl_url( $share_icon_options['custom'] ) . ') top left no-repeat"' );
$share_icon_class        = ( $share_icon_type == 'none' ) ? 'without-icon' : ( ( $share_icon_type == 'custom' ) ? 'with-icon' : 'with-icon awesome' );
$share_text              = yit_get_option( 'blog-single-share-text' );
$title                   = ( get_the_title() != '' ) ? get_the_title() : __( '(this post does not have a title)', 'yit' );
$has_tags                = ( ! get_the_tags() ) ? false : true;
$post_meta_separator     = ' - ';
$link                    = get_permalink();
$has_pagination          = ( $wp_query->max_num_pages > 1 ) ? true : false;
$image_size              = YIT_Registry::get_instance()->image->get_size( 'blog_single_' . $blog_single_type );

$args = array(
    'show_thumbnail'        => $show_thumbnail,
    'show_title'            => $show_title,
    'show_date'             => $show_date,
    'show_author'           => $show_author,
    'show_categories'       => $show_categories,
    'show_tags'             => $show_tags,
    'show_comments'         => $show_comments,
    'show_share'            => $show_share,
    'show_read_more'        => $show_read_more,
    'show_meta_box'         => $show_meta_box,
    'author_icon'           => $author_icon,
    'author_icon_type'      => $author_icon_type,
    'author_icon_class'     => $author_icon_class,
    'categories_icon'       => $categories_icon,
    'categories_icon_type'  => $categories_icon_type,
    'categories_icon_class' => $categories_icon_class,
    'tags_icon'             => $tags_icon,
    'tags_icon_type'        => $tags_icon_type,
    'tags_icon_class'       => $tags_icon_class,
    'comments_icon'         => $comments_icon,
    'comments_icon_type'    => $comments_icon_type,
    'comments_icon_class'   => $comments_icon_class,
    'share_icon'            => $share_icon,
    'share_icon_type'       => $share_icon_type,
    'share_icon_class'      => $share_icon_class,
    'share_text'            => $share_text,
    'title'                 => $title,
    'post_meta_separator'   => $post_meta_separator,
    'blog_type'             => $blog_single_type,
    'link'                  => $link,
    'has_tags'              => $has_tags,
    'has_pagination'        => $has_pagination,
    'post_format'           => $post_format,
    'image_size'            => $image_size,
    'is_quote'              => $is_quote,
    'hide_footer'           => $hide_footer

);

if( $blog_single_type == 'big' ){
    wp_localize_script( 'page-slider', 'yit_page_slider_options', array( 'action' => 'blog_next_post' ) );
}

yit_get_template( 'blog/' . $blog_single_type . '/single.php', $args );

if ( function_exists( 'yit_pagination' ) && $has_pagination ) {
    yit_pagination();
}

if( YIT_Request()->is_ajax ){
    yit_get_comments_template();
}

?>