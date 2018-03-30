<?php
/**
 * @package commercegurus
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="image">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail(); ?>
        <?php endif; ?>
    </div>
    <header class="entry-header">
        <h2 class="entry-title"><?php the_title(); ?></h2>
        <div class="entry-meta">
            <?php cg_posted_on(); ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->
    <div class="entry-content">
        <?php the_content(); ?>
        <?php
        wp_link_pages( array(
            'before' => '<div class="page-links">' . __( 'Pages:', 'commercegurus' ),
            'after' => '</div>',
        ) );
        ?>




    </div><!-- .entry-content -->
    <footer class="entry-meta">
        <?php
        /* translators: used between list items, there is a space after the comma */
        $category_list = get_the_category_list( __( ', ', 'commercegurus' ) );

        /* translators: used between list items, there is a space after the comma */
        $tag_list = get_the_tag_list( '', __( ', ', 'commercegurus' ) );

        if ( !cg_categorized_blog() ) {
            // This blog only has 1 category so we just need to worry about tags in the meta text
            if ( '' != $tag_list ) {
                $meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'commercegurus' );
            } else {
                $meta_text = __( 'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'commercegurus' );
            }
        } else {
            // But this blog has loads of categories so we should probably display them here
            if ( '' != $tag_list ) {
                $meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'commercegurus' );
            } else {
                $meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'commercegurus' );
            }
        } // end check for categories on this blog

        printf(
                $meta_text, $category_list, $tag_list, get_permalink()
        );
        ?>

        <?php edit_post_link( __( 'Edit', 'commercegurus' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-meta -->

</article><!-- #post-## -->
