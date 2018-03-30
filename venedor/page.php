<?php get_header() ?>

    <div id="content" class="site-content" role="main">
        <?php
        global $venedor_layout, $venedor_settings;
        ?>
        <?php /* The loop */ ?>
        <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header<?php if ($venedor_layout == 'widewidth') echo ' container' ?>">
                    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                    <div class="entry-thumbnail">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <?php endif; ?>

                    <?php if (get_post_meta(get_the_ID(), 'title', true) != 'title') : ?>
                    <h1 class="page-title"><?php the_title(); ?></h1>
					<?php endif; ?>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php the_content(); ?>
                    <div class="<?php if ($venedor_layout == 'widewidth') echo ' container' ?>">
                    <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'venedor' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
                    </div>
                </div><!-- .entry-content -->
                
            </article><!-- #post -->

            <?php if ($venedor_settings['page-comment']) : ?>
            <?php
                wp_reset_postdata();
                comments_template();
            ?>
            <?php endif; ?>
        <?php endwhile; ?>
    </div>

<?php get_footer() ?>