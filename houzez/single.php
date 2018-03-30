<?php
/**
 * The Template for displaying all single posts
 * @since Houzez 1.0
 */

get_header();
$sticky_sidebar = houzez_option('sticky_sidebar');
?>

    <section class="section-detail-content">

            <div class="row">
            <div class="col-sm-12">
                <div class="page-title breadcrumb-single">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php get_template_part( 'inc/breadcrumb' )?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 container-contentbar">
                <div class="article-main">
                    
                    <?php
                        // Start the Loop.
                        while ( have_posts() ) : the_post(); ?>

                            <article class="blog-article">
                                <div class="page-title">
                                    <h2><?php the_title(); ?></h2>
                                    <?php get_template_part( 'single-post/post-meta' ); ?>
                                </div>
                                <?php houzez_post_thumbnail(); ?>

                                <div class="article-detail">
                                    <?php the_content(); ?>

                                    <?php
                                    $args = array(
                                        'before'           => '<div class="pagination-main"><ul class="pagination">' . esc_html__('Pages:','houzez'),
                                        'after'            => '</ul></div>',
                                        'link_before'      => '<span>',
                                        'link_after'       => '</span>',
                                        'next_or_number'   => 'next',
                                        'nextpagelink'     => '<span aria-hidden="true"><i class="fa fa-angle-right"></i></span>',
                                        'previouspagelink' => '<span aria-hidden="true"><i class="fa fa-angle-left"></i></span>',
                                        'pagelink'         => '%',
                                        'echo'             => 1
                                    );
                                    wp_link_pages( $args );
                                    ?>
                                </div>
                                <?php get_template_part( 'single-post/tags' ); ?>
                            </article>

                            <?php get_template_part( 'single-post/post-nav' ); ?>

                            <?php get_template_part( 'single-post/author' ); ?>

                            <?php get_template_part( 'single-post/related-posts' ); ?>

                            <?php
                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) {
                                comments_template();
                            }
                        endwhile;
                    ?>

                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-md-offset-0 col-sm-offset-3 container-sidebar  <?php if( isset( $sticky_sidebar['default_sidebar'] ) && $sticky_sidebar['default_sidebar'] != 0 ){ echo 'houzez_sticky'; }?>">
                <?php get_sidebar(); ?>
            </div>
        </div>

    </section>

<?php
get_footer();
