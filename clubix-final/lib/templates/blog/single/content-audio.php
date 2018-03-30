<?php
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$classes = array('post-article', 'single-post', 'clearfix');
$post_class = '';

?>


<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

    <!---- ========== POST THUMBNAIL ========== ---->
    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
        <div class="thumbnail-article">

            <figure class="clearfix">

                <figcaption>
                    <?php
                    $post_thumbnail_id = get_post_thumbnail_id();
                    $post_attachment = zen_get_attachment($post_thumbnail_id);
                    $video_url = $post_attachment['video_url'];
                    ?>

                    <?php if ( $video_url != '' ) : ?>
                        <?php

                        // Display the video
                        echo wp_oembed_get( $video_url, array('height' => '396') );

                        ?>
                    <?php else: ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('blog_image_2'); ?>
                        </a>
                    <?php endif; ?>
                </figcaption>

            </figure>

        </div>
    <?php else: $post_class = 'no-featured-image-post'; endif; ?>
    <!---- ========== END POST THUMBNAIL ========== ---->


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
            <?php the_content(); ?>

            <!-- Displaying post pagination links in case we have multiple page posts -->
            <?php zen_single_post_pagination(); ?>
        </div>

    </div>
    <!---- ========== END POST CONTENT ========== ---->

</article>