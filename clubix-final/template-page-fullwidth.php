<?php
/* Template Name: Page FullWidth */
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$prefix = Haze_Meta_Boxes::get_instance()->prefix;
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
                    <div class="col-sm-12">
                        <div class="container-row">

                            <div class="row">
                                <div class="col-sm-12">

                                    <?php
                                    /**
                                     * clubix_before_post hook
                                     *
                                     * @hooked nothing
                                     */
                                    do_action( 'clubix_before_post' );
                                    ?>

                                    <?php if ( have_posts() ) : ?>

                                        <?php while ( have_posts() ) : the_post(); ?>

                                            <?php the_content(); ?>

                                        <?php endwhile; ?>

                                    <?php else : ?>

                                        <?php
                                        /* Get the none-content template (error) */
                                        get_template_part( 'content', 'none' );
                                        ?>

                                    <?php endif; ?>

                                    <?php
                                    /**
                                     * clubix_after_post hook
                                     *
                                     * @hooked nothing
                                     */
                                    do_action( 'clubix_after_post' );
                                    ?>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="comment-container">
                                        <div class="col-sm-12">
                                            <!-- ============== COMMENTS CONTAINER ============= -->
                                            <?php comments_template('', true); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- ================================================== -->
    <!-- =============== END CONTENT-CONTAINER ================ -->
    <!-- ================================================== -->

<?php get_footer(); ?>