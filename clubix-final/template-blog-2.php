<?php
/* Template Name: Blog Style 2 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$prefix = Haze_Meta_Boxes::get_instance()->prefix;

$order = rwmb_meta( "{$prefix}order", $args = array(), get_the_ID() );
$orderby = rwmb_meta( "{$prefix}order_by", $args = array(), get_the_ID() );
$posts_per_page = rwmb_meta( "{$prefix}posts_per_page", $args = array(), get_the_ID() );
$category = rwmb_meta( "{$prefix}category", array('type'=>'checkbox_list'), get_the_ID() );
$has_slider = rwmb_meta("{$prefix}rev_slider_enable", array(), get_the_ID());
$has_big_player = rwmb_meta("{$prefix}big_player_enable", array(), get_the_ID());
$has_featured = rwmb_meta("{$prefix}featured_widget_enable", array(), get_the_ID());
$has_title = rwmb_meta("{$prefix}text_title_enable", array(), get_the_ID());

get_header(); ?>

    <!-- ================================================== -->
    <!-- =============== START BREADCRUMB ================ -->
    <!-- ================================================== -->
    <?php if($has_slider || $has_big_player || $has_featured || $has_title) : ?>
        <?php
        if($has_slider) {
            // Get the slider
            zen_slider_header();
        }
        if($has_big_player) {
            // Get the player
            clx_header_big_player();
        }
        if($has_featured) {
            // Get featured
            clx_header_featured();
        }
        if($has_title) {
            // Get the title
            clx_header_title();
        }
        ?>
    <?php else: ?>
        <div class="container">
            <div class="row">
                <div class="breadcrumb-container clearfix">

                    <!-- BREADCRUMB TITLE -->
                    <h1><?php the_title(); ?></h1>

                    <!-- BREADCRUMB -->
                    <?= zen_breadcrumbs(); ?>

                </div>
            </div>
        </div>
    <?php endif; ?>
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

                    <?php

                    // Construct the query
                    if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
                    elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
                    else { $paged = 1; }
                    $args = array(
                        'post_type'         => 'post',
                        'post_status'       => 'publish',
                        'paged'             => $paged,
                        'posts_per_page'    => (int)$posts_per_page,
                        'orderby'           => $orderby,
                        'order'             => $order,
                        'category__in'      => $category,
                        //'author__in'        => $authors
                    );

                    $query = new WP_Query($args);

                    ?>

                    <?php if ( $query->have_posts() ) : ?>

                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                            <?php
                            /* Get the content template */
                            get_template_part( 'lib/templates/blog/two/content', get_post_format() );
                            ?>

                        <?php endwhile; ?>

                    <?php else : ?>

                        <?php
                        /* Get the none-content template (error) */
                        get_template_part( 'content', 'none' );
                        ?>

                    <?php endif; ?>
                    <?php
                    wp_reset_postdata();
                    // End The Loop
                    ?>

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
            do_action( 'clubix_after_posts_loop', $query, '', 2 );
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