<?php
get_header();
get_template_part('template-parts/banner');
?>
<div class=" page-top clearfix">
    <div class="container">
        <div class="row">
            <div class="<?php bc('9', '8', '12', ''); ?>">
                <nav class="bread-crumb">
                    <?php theme_breadcrumb(); ?>
                </nav>
            </div>
            <div class="<?php bc('3', '4', '12', ''); ?>">
                <?php get_template_part('search-form'); ?>
            </div>
        </div>
    </div>
</div>

<div class="blog-page clearfix">
    <div class="container">
        <div class="row">
            <div class="<?php bc('9', '8', '12', ''); ?>">
                <div class="blog-post-single clearfix">
                    <?php
                    if (have_posts()):
                        while (have_posts()):
                            the_post();
                            ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(' clearfix'); ?> >
                                <div class="left_meta clearfix entry-meta">
                                    <time class="entry-date published updated" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date( 'M' ); ?>
                                        <strong><?php echo get_the_date( 'd' ); ?></strong></time>
                                    <span class="comments_count clearfix entry-comments-link"><?php comments_popup_link(__('0', 'framework'), __('1', 'framework'), __('%', 'framework')); ?></span>
                                </div>
                                <div class="right-contents">
                                    <header class="entry-header">
                                        <?php
                                        /* Get post header based on format */
                                        $format = get_post_format($post->ID);
                                        if (false === $format) {
                                            $format = 'standard';
                                        }
                                        get_template_part("post-formats/$format");

                                        if ( $format !== 'link' && $format !== 'quote' ) {
                                            ?>
                                            <h1 class="entry-title"><?php the_title(); ?></h1>

                                            <span class="entry-author">
                                                <?php _e('Posted by', 'framework') ?>
                                                <span class="entry-author-link vcard">
                                                    <?php
                                                    printf( '<a class="url fn" href="%1$s" title="%2$s" rel="author">%3$s</a>',
                                                        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                                                        esc_attr( sprintf( __( 'View all posts by %s', 'framework' ), get_the_author() ) ),
                                                        get_the_author()
                                                    );
                                                    ?>
                                                </span>
                                            </span>
                                            <?php
                                        }
                                        ?>
                                    </header>

                                    <div class="entry-content">
                                        <?php
                                        /* output post contents */
                                        the_content();

                                        // WordPress Link Pages
                                        wp_link_pages(array('before' => '<div class="page-nav-btns clearfix">', 'after' => '</div>', 'next_or_number' => 'next'));
                                        ?>
                                    </div>

                                    <footer class="entry-footer">
                                        <p class="entry-meta">
                                            <span class="entry-categories">
                                                <i class="fa fa-folder-o"></i>&nbsp; <?php the_category(', '); ?>
                                            </span>
                                            <span class="entry-tags">
                                                <i class="fa fa-tags"></i>&nbsp; <?php the_tags('', ', ', ''); ?>
                                            </span>
                                        </p>
                                    </footer>
                                </div>
                            </article>
                        <?php
                        endwhile;
                    endif;
                    ?>
                </div>

                <div class="comments-wrapper">
                    <div class="row">
                        <div class="<?php bc_all('12'); ?>">
                            <?php comments_template(); ?>
                        </div>
                    </div>
                </div>

            </div>

            <div class="<?php bc('3', '4', '12', ''); ?>">
                <?php get_sidebar(); ?>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>
