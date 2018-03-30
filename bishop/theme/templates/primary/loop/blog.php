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

$more        = false;
$post_format = ( ! get_post_format() ) ? 'standard' : get_post_format();
$is_quote    = ( $post_format == 'quote' ) ? true : false;

if ( $blog_type == 'small' ) {
    $show_thumbnail = ( yit_get_option( 'blog-show-featured-image' ) == 'yes' && has_post_thumbnail() && $post_format != 'quote' ) ? true : false;
}
else {
    $show_thumbnail = ( yit_get_option( 'blog-big-show-post-formats' ) == 'yes' && has_post_thumbnail() && $post_format != 'quote' ) ? true : false;
}
$what_formats_show       = yit_get_option( 'blog-big-what-show' );
$show_title              = ( yit_get_option( 'blog-show-title' ) == 'yes' ) ? true : false;
$show_excerpt            = ( yit_get_option( 'blog-show-excerpt' ) == 'yes' ) ? true : false;
$show_date               = ( yit_get_option( 'blog-show-date' ) == 'yes' ) ? true : false;
$show_author             = ( yit_get_option( 'blog-show-author' ) == 'yes' && get_the_author() != false ) ? true : false;
$show_categories         = ( yit_get_option( 'blog-show-categories' ) == 'yes' ) ? true : false;
$show_tags               = ( yit_get_option( 'blog-show-tags' ) == 'yes' ) ? true : false;
$show_comments           = ( yit_get_option( 'blog-show-comments' ) == 'yes' ) ? true : false;
$show_post_format_icon   = ( yit_get_option( 'blog-post-format-icon' ) == 'yes' ) ? true : false;
$show_read_more          = ( yit_get_option( 'blog-show-read-more' ) == 'yes' ) ? true : false;
$has_tags                = ( ! get_the_tags() ) ? false : true;
$show_meta_box           = ( $show_author || $show_date || $show_comments || $show_categories || ( $show_tags && $has_tags ) ) ? true : false;
$author_icon_options     = yit_get_option( 'blog-author-icon' );
$author_icon_type        = $author_icon_options['select'];
$author_icon             = ( $author_icon_type == 'none' ) ? false : ( ( $author_icon_type == 'icon' ) ? '<i class="fa fa-' . $author_icon_options['icon'] . '"></i>' : 'style="background: transparent url(' . yit_ssl_url( $author_icon_options['custom'] ) . ') top left no-repeat"' );
$author_icon_class       = ( $author_icon_type == 'none' ) ? 'without-icon' : ( ( $author_icon_type == 'custom' ) ? 'with-icon' : 'with-icon awesome' );
$categories_icon_options = yit_get_option( 'blog-categories-icon' );
$categories_icon_type    = $categories_icon_options['select'];
$categories_icon         = ( $categories_icon_type == 'none' ) ? false : ( ( $categories_icon_type == 'icon' ) ? '<i class="fa fa-' . $categories_icon_options['icon'] . '"></i>' : 'style="background: transparent url(' . yit_ssl_url( $categories_icon_options['custom'] ) . ') top left no-repeat"' );
$categories_icon_class   = ( $categories_icon_type == 'none' ) ? 'without-icon' : ( ( $categories_icon_type == 'custom' ) ? 'with-icon' : 'with-icon awesome' );
$tags_icon_options       = yit_get_option( 'blog-tags-icon' );
$tags_icon_type          = $tags_icon_options['select'];
$tags_icon               = ( $tags_icon_type == 'none' ) ? false : ( ( $tags_icon_type == 'icon' ) ? '<i class="fa fa-' . $tags_icon_options['icon'] . '"></i>' : 'style="background: transparent url(' . yit_ssl_url( $tags_icon_options['custom'] ) . ') top left no-repeat"' );
$tags_icon_class         = ( $tags_icon_type == 'none' ) ? 'without-icon' : ( ( $tags_icon_type == 'custom' ) ? 'with-icon' : 'with-icon awesome' );
$comments_icon_options   = yit_get_option( 'blog-comments-icon' );
$comments_icon_type      = $comments_icon_options['select'];
$comments_icon           = ( $comments_icon_type == 'none' ) ? false : ( ( $comments_icon_type == 'icon' ) ? '<i class="fa fa-' . $comments_icon_options['icon'] . '"></i>' : 'style="background: transparent url(' . yit_ssl_url( $comments_icon_options['custom'] ) . ') top left no-repeat"' );
$comments_icon_class     = ( $comments_icon_type == 'none' ) ? 'without-icon' : ( ( $comments_icon_type == 'custom' ) ? 'with-icon' : 'with-icon awesome' );
$title                   = ( get_the_title() != '' ) ? get_the_title() : __( '(this post does not have a title)', 'yit' );
$read_more_text          = yit_get_option( 'blog-read-more-text' ) != '' ? yit_get_option( 'blog-read-more-text' ) : __( 'Read More', 'yit' );
$post_meta_separator     = ' - ';
$link                    = get_permalink();
$has_pagination          = ( $wp_query->max_num_pages > 1 ) ? true : false;
$image_size              = YIT_Registry::get_instance()->image->get_size( 'blog_' . $blog_type );

$args = array(
    'show_thumbnail'        => $show_thumbnail,
    'show_title'            => $show_title,
    'show_excerpt'          => $show_excerpt,
    'show_date'             => $show_date,
    'show_author'           => $show_author,
    'show_categories'       => $show_categories,
    'show_post_format_icon' => $show_post_format_icon,
    'show_tags'             => $show_tags,
    'show_comments'         => $show_comments,
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
    'title'                 => $title,
    'read_more_text'        => $read_more_text,
    'post_meta_separator'   => $post_meta_separator,
    'blog_type'             => $blog_type,
    'link'                  => $link,
    'has_tags'              => $has_tags,
    'has_pagination'        => $has_pagination,
    'blog_type'             => $blog_type,
    'post_format'           => $post_format,
    'is_quote'              => $is_quote,
    'image_size'            => $image_size,
    'what_formats_show'     => $what_formats_show
);

yit_get_template( 'blog/' . $blog_type . '/markup.php', $args );