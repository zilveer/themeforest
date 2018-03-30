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
                $gallery_shortcode = oxy_get_content_shortcode( $post, 'gallery' );
                if( $gallery_shortcode !== null ) {
                    if( isset( $gallery_shortcode[0] ) ) {
                        // show gallery
                        $gallery_ids = null;
                        if( array_key_exists( 3, $gallery_shortcode ) ) {
                            if( array_key_exists( 0, $gallery_shortcode[3] ) ) {
                                $gallery_attrs = shortcode_parse_atts( $gallery_shortcode[3][0] );
                                if( array_key_exists( 'ids', $gallery_attrs) ) {
                                    $gallery_ids = explode( ',', $gallery_attrs['ids'] );
                                }
                            }
                        }
                        if( $gallery_ids !== null ) { ?>
                            <div class="post-media">
                                <?php oxy_create_flexslider( $gallery_ids ); ?>
                            </div>
                        <?php
                        }
                        // strip shortcode from the content
                        $gallery_shortcode = $gallery_shortcode[0];
                        if( isset( $gallery_shortcode[0] ) ) {
                            global $more;
                            $more = 0;
                            $content = str_replace( $gallery_shortcode[0], '', get_the_content() );
                        }
                    }
                }
            	// if post has featured image , display it also.
                else if( has_post_thumbnail() ) {
                    $img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                    echo '<figure>'
                        .   '<img alt="featured image" src="'.$img[0].'">'
                        .'</figure>';
                }
                global $more;    // Declare global $more (before the loop).
                $more = 0;
                echo apply_filters( 'the_content', isset( $content ) ? $content : get_the_content() );
            ?>
        </div>
        <div class="post-arrow"></div>
    </div>
</li>
