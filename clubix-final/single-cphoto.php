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

$columns = rwmb_meta( "{$prefix}pgallery_columns", array(), get_the_ID() );
$album_class = '';
switch($columns) { case '2': $album_class = 'col-sm-6 col-xs-6'; break; case '3': $album_class = 'col-sm-4 col-xs-6'; break; case '4': $album_class = 'col-sm-3 col-xs-6'; break; }



get_header(); ?>

    <!-- ================================================== -->
    <!-- =============== START BREADCRUMB ================ -->
    <!-- ================================================== -->
    <div class="container">
        <div class="row">
            <div class="breadcrumb-container clearfix">

                <!-- BREADCRUMB TITLE -->
                <h1><?php _e('Photos', LANGUAGE_ZONE) ?></h1>

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
    <div class="row">
    <div class="col-sm-12">
        <div class="filter-container photos-container">


                    <?php if ( have_posts() ) : ?>

                        <?php while ( have_posts() ) : the_post(); ?>

                           <?php
                            $images = rwmb_meta( "{$prefix}photo_gallery", array('type' => 'image_advanced', 'size' => 'album_list_1') );
                            $images_full = rwmb_meta( "{$prefix}photo_gallery", array('type' => 'image_advanced', 'size' => 'full') );

                            foreach($images as $key => $image):

                            ?>
                            <article class="<?php echo $album_class; ?>">
                                <figure>


                                    <a href="<?php echo $images_full[$key]["url"]; ?>" rel="prettyPhoto[gallery]" class="back-face">


                                    <h5>
                                        <?php echo $image["title"]; ?>
                                    </h5>
                                    <h6>
                                        <?php the_title(); ?>
                                    </h6>
                                    <i class="fa fa-search"></i>
                                    </a>
                                    <figcaption>
                                        <div class="desc">
                                            <h5>
                                                <?php echo $image["title"]; ?>
                                            </h5>
                                            <h6>
                                                <?php the_title(); ?>
                                            </h6>
                                        </div>
                                        <img src="<?php echo $image["url"]; ?>" alt="">
                                    </figcaption>
                                </figure>

                            </article>
                            <?php endforeach; ?>
                        <?php endwhile; ?>

                    <?php else : ?>

                        <?php
                        /* Get the none-content template (error) */
                        get_template_part( 'content', 'none' );
                        ?>

                    <?php endif; ?>



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
    </div>
    <!-- ================================================== -->
    <!-- =============== END CONTENT-CONTAINER ================ -->
    <!-- ================================================== -->

<?php get_footer(); ?>