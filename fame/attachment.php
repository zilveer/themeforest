<?php
/**
 * The template for displaying attachments.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $content_width;

get_header(); ?>

<?php the_post(); ?>

<?php a13_title_bar(); ?>

<article id="content" class="clearfix">

    <div id="col-mask">

        <div id="post-<?php the_ID(); ?>" <?php post_class('post-content'); /* we add .post-content to don't repeat styles with .attachment  */?>>
            <div class="real-content">
                <?php

                if ( wp_attachment_is_image() ) :
                    $attachments = array_values(
                        get_children(
                            array(
                                'post_parent' => $post->post_parent,
                                'post_status' => 'inherit',
                                'post_type' => 'attachment',
                                'post_mime_type' => 'image',
                                'order' => 'ASC',
                                'orderby' => 'menu_order ID'
                            )
                        )
                    );

                foreach ( $attachments as $k => $attachment ) {
                    if ( $attachment->ID == $post->ID )
                        break;
                }

                $k++;
                // If there is more than 1 image attachment in a gallery
                if ( count( $attachments ) > 1 ) {
                    if ( isset( $attachments[ $k ] ) )
                        // get the URL of the next image attachment
                        $next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
                    else
                        // or get the URL of the first image attachment
                        $next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
                }
                else {
                    // or, if there's only 1 image attachment, get the URL of the image
                    $next_attachment_url = wp_get_attachment_url();
                }

                ?>
                <p class="attachment"><a href="<?php echo esc_url($next_attachment_url); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
                    echo wp_get_attachment_image( $post->ID, 'apollo-post-thumb'. (defined('A13_FULL_WIDTH')? '-big' : '') );
                    ?></a></p>

                <?php else : ?>
                <a href="<?php echo esc_url(wp_get_attachment_url()); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
                <?php endif; ?>

                <div class="attachment-info">
                    <?php if ( ! empty( $post->post_parent ) ) : ?>
                    <span><a href="<?php echo esc_url(get_permalink( $post->post_parent )); ?>" title="<?php esc_attr( printf( __( 'Return to %s', 'fame' ), get_the_title( $post->post_parent ) ) ); ?>" rel="gallery"><?php
                        /* translators: %s - title of parent post */
                        printf( __( 'Return to %s', 'fame' ), get_the_title( $post->post_parent ) );
                        ?></a></span>
                    <?php endif; ?>

                    <span><?php
                        printf( __( 'By %1$s', 'fame' ),
                            sprintf( '<a class="author" href="%1$s" title="%2$s" rel="author">%3$s</a>',
                                esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )),
                                sprintf( esc_attr( __('View all posts by %s', 'fame' ) ), get_the_author() ),
                                get_the_author()
                            )
                        );
                        ?></span>

                    <?php
                    printf( __( '<span>Published %1$s</span>', 'fame' ),
                        sprintf( '<abbr class="published" title="%1$s">%2$s</abbr>',
                            esc_attr( get_the_time() ),
                            get_the_date()
                        )
                    );
                    if ( wp_attachment_is_image() ) {
                        $metadata = wp_get_attachment_metadata();
                        echo ' <span>';
                        printf( __( 'Full size is %s pixels', 'fame' ),
                            sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
                                esc_url(wp_get_attachment_url()),
                                esc_attr( __( 'Link to full-size image', 'fame' ) ),
                                $metadata['width'],
                                $metadata['height']
                            )
                        );
                        echo '</span>';
                    }
                    ?>
                    <?php edit_post_link( __( 'Edit', 'fame' ), '' ); ?>
                </div>

                <div class="clear"></div>

            </div>


        </div>

        <?php get_sidebar(); ?>

    </div>

</article>

<?php get_footer(); ?>