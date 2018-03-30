<?php
/**
 * The template for displaying image attachments.
 *
 * @package commercegurus
 */
get_header();
?>
<div class="container">
    <div class="content">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-9 col-md-push-3 col-lg-push-3">
                <div id="primary" class="content-area image-attachment">
                    <main id="main" class="site-main" role="main">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <header class="entry-header">
                                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                                    <div class="entry-meta">
                                        <?php
                                        $metadata = wp_get_attachment_metadata();
                                        printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s">%4$s &times; %5$s</a> in <a href="%6$s" rel="gallery">%7$s</a>', 'commercegurus' ), esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ), esc_url( wp_get_attachment_url() ), $metadata['width'], $metadata['height'], esc_url( get_permalink( $post->post_parent ) ), get_the_title( $post->post_parent )
                                        );

                                        edit_post_link( __( 'Edit', 'commercegurus' ), '<span class="edit-link">', '</span>' );
                                        ?>
                                    </div><!-- .entry-meta -->
                                    <nav role="navigation" id="image-navigation" class="image-navigation">
                                        <div class="nav-previous"><?php previous_image_link( false, __( '<span class="meta-nav">&larr;</span> Previous', 'commercegurus' ) ); ?></div>
                                        <div class="nav-next"><?php next_image_link( false, __( 'Next <span class="meta-nav">&rarr;</span>', 'commercegurus' ) ); ?></div>
                                    </nav><!-- #image-navigation -->
                                </header><!-- .entry-header -->
                                <div class="entry-content">
                                    <div class="entry-attachment">
                                        <div class="attachment">
                                            <?php cg_the_attached_image(); ?>
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
                                        'before' => '<div class="page-links">' . __( 'Pages:', 'commercegurus' ),
                                        'after' => '</div>',
                                    ) );
                                    ?>
                                </div><!-- .entry-content -->
                                <?php edit_post_link( __( 'Edit', 'commercegurus' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
                            </article><!-- #post-## -->
                            <?php
                            $cg_comments_status = $cg_options['cg_page_comments'];
                            if ( $cg_comments_status == 'yes' ) {
                                if ( comments_open() || '0' != get_comments_number() ) {
                                    comments_template();
                                }
                            }
                            ?>

                        <?php endwhile; // end of the loop. ?>
                    </main><!-- #main -->
                </div><!-- #primary -->
            </div><!--/9 -->
            <div class="col-lg-3 col-md-3 col-md-pull-9 col-lg-pull-9">
                <?php get_sidebar(); ?>
            </div>
        </div><!--/content -->
    </div>
</div><!--/container -->

<?php get_footer(); ?>
