<?php
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$prefix = Haze_Meta_Boxes::get_instance()->prefix;
// Get the featured image option
$has_featured_image = rwmb_meta("{$prefix}hide_featured_image");
$has_widget = rwmb_meta("{$prefix}page_sidebar");
if ($has_widget == 'none') $has_widget = false; else $has_widget = true;

get_header(); ?>

    <!-- ================================================== -->
    <!-- =============== START BREADCRUMB ================ -->
    <!-- ================================================== -->
    <div class="container">
        <div class="row">
            <div class="breadcrumb-container clearfix">

                <!-- BREADCRUMB TITLE -->
                <h1><?php _e('Blog', LANGUAGE_ZONE) ?></h1>

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
    <div class="<?php if($has_widget) {echo 'col-sm-8';} else {echo 'col-sm-12';} ?>">
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

                            <?php
                            /* Get the content template */
                            get_template_part( 'lib/templates/blog/single/content', get_post_format() );
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

    <!-- ============= WIDGETS ============= -->
    <?php if($has_widget): ?>
    <div class="col-sm-4">
        <?php get_sidebar('main-sidebar'); ?>
    </div>
    <?php endif; ?>
    <!-- ============= END WIDGETS ============= -->

    </div>
    </div>
    </div>
    </div>
    <!-- ================================================== -->
    <!-- =============== END CONTENT-CONTAINER ================ -->
    <!-- ================================================== -->

<?php get_footer(); ?>