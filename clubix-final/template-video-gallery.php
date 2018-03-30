<?php
/* Template Name: Videos Galleries*/

// File Security Check
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

$order = rwmb_meta( "{$prefix}vgallery_order", $args = array(), get_the_ID() );
$orderby = rwmb_meta( "{$prefix}vgallery_order_by", $args = array(), get_the_ID() );
$posts_per_page = rwmb_meta( "{$prefix}vgallery_posts_per_page", $args = array(), get_the_ID() );
$category = rwmb_meta( "{$prefix}vgallery_category", array('type'=>'checkbox_list'), get_the_ID() );
$columns = rwmb_meta( "{$prefix}vgallery_columns", array(), get_the_ID() );
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
                <?php haze_page_title(); ?>

                <!-- BREADCRUMB -->
                <?php
                echo clx_breadcrumbs_filter(VideoPostType::get_instance()->postTypeTax, $category);
                ?>
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
                                <?php
                                if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
                                elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
                                else { $paged = 1; }

                                $args = array(
                                    'post_type'         => VideoPostType::get_instance()->postType,
                                    'post_status'       => 'publish',
                                    'paged'             => $paged,
                                    'posts_per_page'    => (int)$posts_per_page,
                                    'orderby'           => $orderby,
                                    'order'             => $order,
                                    'tax_query'         => ( !empty($category) ? array(
                                            array(
                                                'taxonomy' => VideoPostType::get_instance()->postTypeTax,
                                                'field' => 'id',
                                                'terms' => $category
                                            ),
                                        ) : false ),
                                    //'category__in'      => $categories,
                                    //'author__in'        => $authors
                                );
                                $query = new WP_Query($args);
                                ?>

                                <?php if ( $query->have_posts() ) : ?>

                                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                                        <?php $terms = wp_get_post_terms( get_the_ID(), VideoPostType::get_instance()->postTypeTax ); ?>

                                        <article class="<?= $album_class; ?> <?php foreach($terms as $term) {echo $term->slug.' ';} ?>">
                                            <figure>


                                                <a href="<?php the_permalink(); ?>" class="back-face">


                                                    <h5>
                                                        <?php the_title(); ?>
                                                    </h5>
                                                    <h6>
                                                        <?php foreach($terms as $term){
                                                            echo $term->name.' ';
                                                        }

                                                        ?>
                                                    </h6>
                                                    <i class="fa fa-link"></i>
                                                </a>
                                                <figcaption>
                                                    <div class="desc">
                                                        <h5>
                                                            <?php the_title(); ?>
                                                        </h5>
                                                        <h6>
                                                            <?php foreach($terms as $term){
                                                                echo $term->name.' ';
                                                            }

                                                            ?>
                                                        </h6>
                                                    </div>
                                                    <?php  the_post_thumbnail('album_list_1'); ?>
                                                </figcaption>
                                            </figure>

                                        </article>
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

        </div>

    </div>
    <!-- ================================================== -->
    <!-- =============== END CONTENT-CONTAINER ================ -->
    <!-- ================================================== -->

<?php get_footer(); ?>