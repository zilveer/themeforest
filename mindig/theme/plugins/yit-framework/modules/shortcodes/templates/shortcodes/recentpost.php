<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for shows last post of a specific category
 *
 * @package Yithemes
 * @author  Francesco Licandro <francesco.licandro@yithemes.com>
 * @since   1.0.0
 */

global $icons_name;

remove_filter( 'the_content_more_link', 'yit_sc_more_link', 10, 3 ); //shortcode in more links

$args = array(
    'posts_per_page'      => $items,
    'orderby'             => 'date',
    'ignore_sticky_posts' => 1
);

if ( isset( $popular ) && $popular != 'no' ) {
    $args['orderby'] = 'comment_count';
}

if ( isset( $cat_name ) && ! empty( $cat_name ) && $cat_name != 'null' && $cat_name != "a:0:{}" ) {
    $args['category_name'] = $cat_name;
}
$author_name = get_the_author_link();
$author      = isset( $author ) && ! empty( $author_name )  ? $author : 'no';

$args['order'] = 'DESC';

$myposts = new WP_Query( $args );

$animate_data = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate = ( $animate != '' ) ? ' yit_animate ' . $animate : '';

$html = "\n";
$html .= '<div class="yit_shortcodes recent-post group ' . esc_attr( $animate . $vc_css ) . '" ' . $animate_data . '>' . "\n";

if ( $myposts->have_posts() ) : while ( $myposts->have_posts() ) : $myposts->the_post();

    $img = '';
    if ( has_post_thumbnail() ) {
        if( function_exists('yit_image') ):
            $img = yit_image( "size=blog_thumb", false );
        else:
            $img = get_the_post_thumbnail( get_the_ID() );
        endif;
    }

    $html .= '<div class="hentry-post group">' . "\n";
    if ( $date == "yes" ) {
        $html .= '<p class="post-date"><span class="day">' . get_the_time( 'd' ) . '</span><span class="month">' . get_the_time( 'M' ) . '</span></p>';
    }
    if ( $showthumb == 'yes' && $img != '' ) {
        $html .= "    <div class=\"thumb-img\"><a href=\"" . get_permalink() . "\">$img</a></div>\n";
    }
    $html .= '<div class="text">';
    $html .= the_title( '<a href="' . get_permalink() . '" title="' . get_the_title() . '" class="title">', '</a>', false );

    if ( strpos( $readmore, "href='#'" ) ) {
        $post_readmore = str_replace( "href='#'", "href='" . get_permalink() . "'", $readmore );
    }
    else {
        $post_readmore = $readmore;
    }
    if( $excerpt != 'no'){
        $html .= yit_plugin_content( 'excerpt', $excerpt_length, $post_readmore ) . '';
    }
    $html .= '<div class="post-meta">';
    if( $author == 'yes' ){
        $html .= '<span class="author">' . __( 'by', 'yit' ) . ' ' . '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author_link(). '</a></span>';
    }
    if( $author == 'yes' && $comments == 'yes' ){
        $html .= " // ";
    }
    if( $comments == 'yes' ){
        $html .= '<span class="comments"><a href="'.get_comments_link( get_the_ID() ).'">'.get_comments_number() . ( get_comments_number() == 1 ? __( ' comment', 'yit' ) : __( ' comments', 'yit' ) ). '</a></span>';
    }
    $html .= '</div>';
    $html .= '</div>' . "\n";
    $html .= '</div>' . "\n";
    $html .= '<div class="clear"></div>';

endwhile; endif;

wp_reset_query();
$html .= '</div>';

add_filter( 'the_content_more_link', 'yit_sc_more_link', 10, 3 ); //shortcode in more links
?>
<?php echo $html; ?>