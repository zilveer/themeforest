<?php
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header(); ?>

    <!-- ================================================== -->
    <!-- =============== START BREADCRUMB ================ -->
    <!-- ================================================== -->
    <div class="container">
        <div class="row">
            <div class="breadcrumb-container clearfix">

                <!-- BREADCRUMB TITLE -->
                <?php haze_page_title(); ?>

                <!-- BREADCRUMB -->
                <?= zen_breadcrumbs(); ?>

            </div>
        </div>
    </div>
    <!-- ================================================== -->
    <!-- =============== END BREADCRUMB ================ -->
    <!-- ================================================== -->

    <!-- ================================================== -->
    <!-- =============== START CONTENT-CONTAINER ================ -->
    <!-- ================================================== -->
    <div class="container">
    <div class="row">
    <div class="content-container">
    <div class="content-container-inner clearfix">
    <div class="col-sm-8">
    <div class="container-row">

        <?php
        /**
         * clubix_before_posts_loop hook
         *
         * @hooked nothing
         */
        do_action( 'clubix_before_posts_loop' );
        ?>

        <div class="row">
            <div class="col-sm-12">

                <?php
                /**
                 * clubix_before_posts hook
                 *
                 * @hooked nothing
                 */
                do_action( 'clubix_before_posts' );
                ?>

                <?php if ( have_posts() ) : ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php
                        /* Get the content template */
                        get_template_part( 'content', get_post_format() );
                        ?>

                    <?php endwhile; ?>

                <?php else : ?>

                    <?php
                    /* Get the none-content template (error) */
                    get_template_part( 'content', 'none' );
                    ?>

                <?php endif; ?>

                <?php
                /**
                 * clubix_after_posts hook
                 *
                 * @hooked nothing
                 */
                do_action( 'clubix_after_posts' );
                ?>

            </div>
        </div>

        <?php
        /**
         * clubix_after_posts_loop hook
         *
         * @hooked nothing
         */
        global $wp_query;
        do_action( 'clubix_after_posts_loop', $wp_query, '', 2 );
        ?>

    </div>
    </div>

    <!-- ============= WIDGETS ============= -->
    <div class="col-sm-4">
        <?php get_sidebar('main-sidebar'); ?>
    </div>
    <!-- ============= END WIDGETS ============= -->

    </div>
    </div>
    </div>
    </div>
    <!-- ================================================== -->
    <!-- =============== END CONTENT-CONTAINER ================ -->
    <!-- ================================================== -->

<?php get_footer(); ?>