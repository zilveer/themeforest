<?php
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$classes = array('post-article', 'single-post', 'clearfix');
$post_class = '';

$prefix = Haze_Meta_Boxes::get_instance()->prefix;
// Get the featured image option
$has_featured_image = rwmb_meta("{$prefix}hide_featured_image");
$has_widget = rwmb_meta("{$prefix}page_sidebar");
if ($has_widget == 'none') $has_widget = false; else $has_widget = true;

?>


<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

    <!---- ========== POST THUMBNAIL ========== ---->
    <?php if ( has_post_thumbnail() && ! post_password_required() && $has_featured_image ) : ?>
        <div class="thumbnail-article">

            <figure class="clearfix">

                <figcaption>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('blog_image_2'); ?>
                    </a>
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