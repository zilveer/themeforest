<?php
/**
 * Shows a simple single post
 *
 * @package Smartbox
 * @subpackage Frontend
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */
$pattern = get_shortcode_regex();
$link = null;

// look for an embeded video in the post content
if( preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches ) && array_key_exists( 2, $matches ) && in_array( 'link', $matches[2] ) ) {
    $link = $matches[0];
}
$author_id = get_the_author_meta('ID');
?>
<li class="timeline-item">
    <div class="well post">
        <div class="post-info">
            <h5 class="text-center light">
                  <?php the_time(get_option('date_format')); ?>
            </h5>
            <div class="round-box box-small">
                <?php echo get_avatar( $author_id, 300 ); ?>
            </div>
            <h5 class="text-center">
                 <?php the_author(); ?>
            </h5>
        </div>
        <div class="post-body clearfix">
            <h4 class="post-title small-screen-center">
                <?php
                $link_shortcode = oxy_get_content_shortcode( $post, 'link' );
                if( $link_shortcode !== null ) {
                    if( isset( $link_shortcode[5] ) ) {
                        $link_shortcode = $link_shortcode[5];
                        if( isset( $link_shortcode[0] ) ) {
                            $title = '<a href="' . $link_shortcode[0] . '">' . get_the_title( $post->ID ) . ' <i class="icon-double-angle-right"></i></a>';
                        }
                    }
                }
                echo empty( $title ) ? the_title() : $title;
                ?>
            </h4>
            <?php
            if ( has_post_thumbnail() ){
                $img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                echo '<figure>' . '<img alt="featured image" src="'.$img[0].'">' . '</figure>';
            }
            global $more;    // Declare global $more (before the loop).
            $more = 0;
            the_content();
            ?>
        </div>
        <div class="post-arrow"></div>
    </div>
</li>
