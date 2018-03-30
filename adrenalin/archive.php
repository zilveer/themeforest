<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package commercegurus
 */
global $cg_options;
$cg_blog_sidebar = '';
if ( isset( $cg_options['cg_blog_sidebar'] ) ) {
    $cg_blog_sidebar = $cg_options['cg_blog_sidebar'];
}

get_header();
?>
<?php if ( have_posts() ) : ?>
    <div class="header-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <header class="entry-header">
                        <h1 class="cg-page-title">
                            <?php
                            if ( is_category() ) :
                                single_cat_title();

                            elseif ( is_tag() ) :
                                single_tag_title();

                            elseif ( is_author() ) :
                                /* Queue the first post, that way we know
                                 * what author we're dealing with (if that is the case).
                                 */
                                the_post();
                                printf( __( 'Author: %s', 'commercegurus' ), '<span class="vcard">' . get_the_author() . '</span>' );
                                /* Since we called the_post() above, we need to
                                 * rewind the loop back to the beginning that way
                                 * we can run the loop properly, in full.
                                 */
                                rewind_posts();

                            elseif ( is_day() ) :
                                printf( __( 'Day: %s', 'commercegurus' ), '<span>' . get_the_date() . '</span>' );

                            elseif ( is_month() ) :
                                printf( __( 'Month: %s', 'commercegurus' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

                            elseif ( is_year() ) :
                                printf( __( 'Year: %s', 'commercegurus' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

                            elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
                                _e( 'Asides', 'commercegurus' );

                            elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
                                _e( 'Images', 'commercegurus' );

                            elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
                                _e( 'Videos', 'commercegurus' );

                            elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
                                _e( 'Quotes', 'commercegurus' );

                            elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
                                _e( 'Links', 'commercegurus' );

                            else :
                                _e( 'Archives', 'commercegurus' );

                            endif;
                            ?>                            
                        </h1>
                    </header>
                </div>
            </div>
        </div>
    </div> 
<?php endif; ?>
<div class="container">
    <div class="content">
        <div class="row">
            <?php if ( ( $cg_blog_sidebar == 'default' ) || ( $cg_blog_sidebar == '' ) ) { ?>

                <div class="col-lg-9 col-md-9 col-sm-9 col-md-push-3 col-lg-push-3">
                    <section id="primary" class="content-area">
                        <main id="main" class="site-main" role="main">
                            <?php if ( have_posts() ) : ?>
                                <div>
                                    <?php /* Start the Loop */ ?>
                                    <?php while ( have_posts() ) : the_post(); ?>
                                        <?php
                                        /* Include the Post-Format-specific template for the content.
                                         * If you want to override this in a child theme, then include a file
                                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                         */
                                        get_template_part( 'content', get_post_format() );
                                        ?>
                                    <?php endwhile; ?>
                                    <?php cg_content_nav( 'nav-below' ); ?>
                                <?php else : ?>
                                    <?php get_template_part( 'no-results', 'archive' ); ?>
                                <?php endif; ?>
                            </div>
                        </main><!-- #main -->
                    </section><!-- #primary -->
                </div><!--/9 -->
                <div class="col-lg-3 col-md-3 col-sm-3 col-md-pull-9 col-lg-pull-9">
                    <?php get_sidebar(); ?>
                </div>

            <?php } else if ( $cg_blog_sidebar == 'right' ) { ?>

                <div class="col-lg-9 col-md-9 col-sm-9">
                    <section id="primary" class="content-area">
                        <main id="main" class="site-main" role="main">
                            <?php if ( have_posts() ) : ?>
                                <div>
                                    <?php /* Start the Loop */ ?>
                                    <?php while ( have_posts() ) : the_post(); ?>
                                        <?php
                                        /* Include the Post-Format-specific template for the content.
                                         * If you want to override this in a child theme, then include a file
                                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                         */
                                        get_template_part( 'content', get_post_format() );
                                        ?>
                                    <?php endwhile; ?>
                                    <?php cg_content_nav( 'nav-below' ); ?>
                                <?php else : ?>
                                    <?php get_template_part( 'no-results', 'archive' ); ?>
                                <?php endif; ?>
                            </div>
                        </main><!-- #main -->
                    </section><!-- #primary -->
                </div><!--/9 -->
                <div class="col-lg-3 col-md-3">
                    <?php get_sidebar(); ?>
                </div>

            <?php } else if ( $cg_blog_sidebar == 'none' ) { ?>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <section id="primary" class="content-area">
                        <main id="main" class="site-main" role="main">
                            <?php if ( have_posts() ) : ?>
                                <div>
                                    <?php /* Start the Loop */ ?>
                                    <?php while ( have_posts() ) : the_post(); ?>
                                        <?php
                                        /* Include the Post-Format-specific template for the content.
                                         * If you want to override this in a child theme, then include a file
                                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                         */
                                        get_template_part( 'content', get_post_format() );
                                        ?>
                                    <?php endwhile; ?>
                                    <?php cg_content_nav( 'nav-below' ); ?>
                                <?php else : ?>
                                    <?php get_template_part( 'no-results', 'archive' ); ?>
                                <?php endif; ?>
                            </div>
                        </main><!-- #main -->
                    </section><!-- #primary -->
                </div><!--/12 -->
            <?php } ?>
        </div><!--/row -->
    </div><!--/content -->
</div><!--/container -->

<?php get_footer(); ?>