<?php
/**
 * Template part. Must be called within the loop.
 */

$post_type = get_post_type();

do_action('layers_before_single_post');

/**
 * Featured image if any & page/post title
 */
get_template_part( 'partials/content', 'single-page-title-part' ); ?>

    <div class="story-wrapper">
        <?php if($post_type == 'post'): // Only for a post ?>
            <?php get_template_part( 'partials/content', 'single-page-meta-part' ); ?>
        <?php endif; ?>

        <?php get_template_part( 'partials/content', 'single-page-content-part' ); ?>

        <?php if($post_type == 'post' || $post_type == 'tl_service'): // Only for a post ?>
            <?php get_template_part( 'partials/content', 'single-page-tags-part' ); ?>
        <?php endif; ?>
    </div>

<?php get_template_part( 'partials/content', 'single-page-social-part' );


if(!is_page()) {

    /**
     * Display related posts
     */
    \Handyman\Front\tl_related_posts();

    if( get_post_type() == 'post'){
        /**
         * Display the Post Comments
         */
        comments_template();
    }
}
?>
<?php do_action('layers_after_single_post'); ?>