<?php
/**
 * Shows a simple gallery post
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
<article id="post-<?php the_ID(); ?>" <?php post_class('row-fluid'); ?>>
    <?php get_template_part( 'partials/post-gutter' ); ?>
    <div class="<?php echo  oxy_get_option( 'blog_image_size' ) == 'normal'? 'span10':'span12'; ?> post-body">
        <div class="post-head">
            <h2 class="small-screen-center">
                <?php if ( is_single() ) : ?>
                    <?php the_title(); ?>
                <?php else : ?>
                    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', THEME_FRONT_TD ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                        <?php the_title(); ?>
                    </a>
                <?php endif; // is_single() ?>
            </h2>
            <?php get_template_part( 'partials/post-extras' ); ?>
        </div>
        <div class="entry-content">
            <?php
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
            get_template_part( 'partials/social-links', null );
            ?>
        </div>
    </div>
</article>

