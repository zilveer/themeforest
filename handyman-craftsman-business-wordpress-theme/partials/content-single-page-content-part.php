<?php
/**
 * Display the content itself
 */
if ( '' != get_the_content() ) { ?>

    <?php do_action('layers_before_single_content'); ?>

    <div class="story">
        <?php
        /**
         * Display the Content
         */
        the_content(); ?>
    </div>

    <?php
    /**
     * Display In-Post Pagination
     */
    wp_link_pages( array(
        'link_before'   => '<span>',
        'link_after'    => '</span>',
        'before'        => '<p class="inner-post-pagination">' . __('<span>Pages:</span>', 'ocmx'),
        'after'     => '</p>'
    )); ?>

    <?php do_action('layers_after_single_content'); ?>
<?php } // '' != get_the_content()