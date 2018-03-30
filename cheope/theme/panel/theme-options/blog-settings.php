<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

function yit_blog_type_options( $array ) {
    $array['big']     = __( 'Big Thumbnail', 'yit' );
    $array['small']   = __( 'Small Thumbnail', 'yit' );
    $array['elegant'] = __( 'Elegant', 'yit' );
    $array['pinterest'] = __( 'Pinterest', 'yit' );
    
    return $array;
}
add_filter( 'yit_blog-type_options', 'yit_blog_type_options' );
 
function yit_tab_blog_settings( $items ) {
    unset( $items[65], $items[66] );
    $items[51] = array(
        'id'   => 'blog-single-type',
        'type' => 'select',
        'name' => __( 'Blog single type', 'yit' ),
        'desc' => __( 'Choose the layout for your blog in the post detail page.', 'yit' ),
        'options' => array(
            'big' => __( 'Big Thumbnail', 'yit' ),
            'elegant' => __( 'Elegant', 'yit' )
        ),
        'std' => $items[50]['std'] // Same blog type of the list
    );
    
    $items[90] = array(
        'id'   => 'blog-post-formats-list',
        'type' => 'onoff',
        'name' => __( 'Show post formats on posts list', 'yit' ),
        'desc' => __( 'Select if you want to show the post formats also in the posts list and not only in the post detail page.', 'yit' ),
        'std'  => apply_filters( 'yit_blog-post-formats-list_std', 0 )
    );
    
    return $items;
}
add_filter( 'yit_submenu_tabs_theme_option_blog_settings', 'yit_tab_blog_settings' );

add_filter( 'yit_blog-read-more-text_std', create_function( '', 'return "[read more]";' ) );

function yit_blog_date_icon_std() {
    return array( 'icon' => 'icon-calendar', 'custom' => YIT_THEME_IMG_URL . '/icons/date.png' );
}
add_filter( 'yit_blog-date-icon_std', 'yit_blog_date_icon_std' );

function yit_blog_author_icon_std() {
    return array( 'icon' => 'icon-user', 'custom' => YIT_THEME_IMG_URL . '/icons/author.png' );
}
add_filter( 'yit_blog-author-icon_std', 'yit_blog_author_icon_std' );

function yit_blog_comments_icon_std() {
    return array( 'icon' => 'icon-comment', 'custom' => YIT_THEME_IMG_URL . '/icons/comments.png' );
}
add_filter( 'yit_blog-comments-icon_std', 'yit_blog_comments_icon_std' );