<?php
    /* Archive list */
    $post_type = get_post_type();
    global $tl_display_read_more;
    $tl_display_read_more = true;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'push-bottom-large' ); ?>>

    <?php do_action('layers_before_list_post_title');

    /**
    * Featured image if any & page/post title
    */
    get_template_part( 'partials/content', 'single-page-title-part' );


    do_action('layers_after_list_post_title'); ?>


    <div class="story-wrapper">
        <?php if($post_type == 'post'): // Only for a post ?>
            <?php get_template_part( 'partials/content', 'single-page-meta-part' ); ?>
        <?php endif; ?>

        <?php if( '' != get_the_excerpt() || '' != get_the_content() ) { ?>
            <?php do_action('layers_before_list_post_content'); ?>
            <div class="story">
                <?php
                /**
                 * Display the Excerpt
                 */
                the_excerpt(); ?>
            </div>
            <?php do_action('layers_after_list_post_content'); ?>
        <?php } ?>
    </div>

    <?php get_template_part( 'partials/content', 'single-page-social-part' ); ?>

</article>