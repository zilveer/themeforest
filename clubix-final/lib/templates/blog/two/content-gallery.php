<?php
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$classes = array('post-article', 'format-image-post-type','clearfix');
$post_class = '';

/**
 * Remove filter because it stays activated throw all posts.
 */
remove_filter('zen_get_content_more', 'zen_return_empty_string', 15);
?>


<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

    <!---- ========== POST THUMBNAIL & TAGS ========== ---->
    <?php if ( ! post_password_required() ) : ?>
        <div class="thumbnail-article">

            <figure class="clearfix">

                <figcaption>
                    <?php

                    // Print the slider with the images & videos
                    $gallery_images = zen_get_gallery_images();
                    if ( has_post_thumbnail() && ! post_password_required() ) {

                        $featured_image_id = get_post_thumbnail_id( $post->ID );
                        $featured_image = get_post($featured_image_id);
                        array_unshift($gallery_images['images'], $featured_image);
                        $gallery_images['count']++;

                    }

                    echo zen_the_post_rs($gallery_images);

                    ?>
                </figcaption>

            </figure>

        </div>
    <?php else: $post_class = 'no-featured-image-post'; endif; ?>
    <!---- ========== END POST THUMBNAIL & TAGS ========== ---->


    <!---- ========== POST CONTENT ========== ---->
    <div class="content-article clearfix">

        <h1>
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h1>

        <div class="entry-meta">

            <?php zen_entry_meta(); ?>

            <?php zen_comments_information(); ?>

            <?= zen_the_date(); ?>

            <?php zen_edit_link(); ?>

        </div>
        <hr>

        <div class="entry-content">
            <?php zen_the_excerpt(); ?>
        </div>

        <?= zen_get_content_more(); ?>

    </div>
    <!---- ========== END POST CONTENT ========== ---->

</article>