<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <?php the_content(); ?>
    </div>
    <?php wp_link_pages( array(
        'before'      => '<div class="zorka-page-links"><span class="zorka-page-links-title">' . esc_html__('Pages:', 'zorka' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span class="zorka-page-link">',
        'link_after'  => '</span>',
    ) ); ?>
    <!-- .entry-content -->
    <?php edit_post_link( esc_html__('Edit', 'zorka' ), '<div class="entry-footer-edit"><span class="edit-link">', '</span></div>' ); ?>
</div>