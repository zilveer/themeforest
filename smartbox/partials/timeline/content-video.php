<?php
/**
 * Shows a gallery post in timeline
 *
 * @package Smartbox
 * @subpackage Frontend
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */
global $post;
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
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h4>
            <?php
            global $more;    // Declare global $more (before the loop).
            $more = 0;
            $video_shortcode = oxy_get_content_shortcode( $post, 'embed' );
            if( $video_shortcode !== null ) {
                if( isset( $video_shortcode[0] ) ) {
                    $video_shortcode = $video_shortcode[0];
                    if( isset( $video_shortcode[0] ) ) {
                        // use the video in the archives
                        global $wp_embed;
                        echo $wp_embed->run_shortcode( $video_shortcode[0] );
                        $content = str_replace( $video_shortcode[0], '', get_the_content() );
                    }
                }
            }
            else if( has_post_thumbnail() ) {
                $img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                echo '<figure><img alt="featured image" src="'.$img[0].'"></figure>';
            }
            echo apply_filters( 'the_content', isset( $content ) ? $content : get_the_content() );
            ?>
        </div>
        <div class="post-arrow"></div>
    </div>
</li>
