<?php
/**
 * The template for displaying image attachments.
 *
 * @package CookingPress
 */

get_header(); ?>

<div id="primary" class="col-md-12 content-area image-attachment">
    <main id="main" class="site-main" role="main">

        <?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php if ( ! empty( $post->post_parent ) ) : ?>
                <a class="page-title published-time" href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php esc_attr( printf( __( 'Return to %s', 'cookingpress' ), get_the_title( $post->post_parent ) ) ); ?>" rel="gallery">
                    <span><?php printf( __( '<span class="meta-nav">&larr;</span> %s', 'cookingpress' ), get_the_title( $post->post_parent ) ); ?></span>
                </a>
            <?php endif; ?>
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'cookingpress'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        </header><!-- .entry-header -->

        <div class="entry-content">
            <div class="entry-attachment">
                <div class="attachment">
                 <nav role="navigation" id="image-navigation" class="image-navigation">
                    <div class="nav-previous"><?php previous_image_link( false, __( '<span class="meta-nav">&larr;</span> Previous', 'cookingpress' ) ); ?></div>
                    <div class="nav-next"><?php next_image_link( false, __( 'Next <span class="meta-nav">&rarr;</span>', 'cookingpress' ) ); ?></div>
                </nav><!-- #image-navigation -->
                <?php cookingpress_the_attached_image(); ?>
            </div><!-- .attachment -->

            <?php if ( has_excerpt() ) : ?>
            <div class="entry-caption">
                <?php the_excerpt(); ?>
            </div><!-- .entry-caption -->
        <?php endif; ?>
    </div><!-- .entry-attachment -->

    <?php
    the_content();
    wp_link_pages( array(
        'before' => '<div class="page-links">' . __( 'Pages:', 'cookingpress' ),
        'after'  => '</div>',
        ) );
        ?>
    </div><!-- .entry-content -->
    <div class="entry-content">
        <?php
        $metadata = wp_get_attachment_metadata();
        printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a>', 'cookingpress' ),
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() ),
            esc_url( wp_get_attachment_url() ),
            $metadata['width'],
            $metadata['height'],
            esc_url( get_permalink( $post->post_parent ) ),
            esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
            get_the_title( $post->post_parent )
            );

        edit_post_link( __( 'Edit', 'cookingpress' ), ' <span class="edit-link">', '</span>' );
        ?>
    </div><!-- .entry-meta -->

</article><!-- #post-## -->

<?php
                // If comments are open or we have at least one comment, load up the comment template
if ( comments_open() || '0' != get_comments_number() )
    comments_template();
?>

<?php endwhile; // end of the loop. ?>

</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
