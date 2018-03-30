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