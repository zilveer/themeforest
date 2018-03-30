<?php
/* Template Name: Albums Style 1 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$prefix = Haze_Meta_Boxes::get_instance()->prefix;

$order = rwmb_meta( "{$prefix}albums_order", $args = array(), get_the_ID() );
$orderby = rwmb_meta( "{$prefix}albums_order_by", $args = array(), get_the_ID() );
$posts_per_page = rwmb_meta( "{$prefix}albums_posts_per_page", $args = array(), get_the_ID() );
$category = rwmb_meta( "{$prefix}albums_category", array('type'=>'checkbox_list'), get_the_ID() );
$columns = rwmb_meta( "{$prefix}albums_columns", array(), get_the_ID() );
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
                <?= clx_breadcrumbs_filter(AlbumPostType::get_instance()->postTypeTax, $category); ?>

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


            <?php
            /**
             * clubix_before_posts_loop hook
             *
             * @hooked nothing
             */
            do_action( 'clubix_before_posts_loop' );
            ?>

            <div class="filter-container albums-container">

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
                            'post_type'         => AlbumPostType::get_instance()->postType,
                            'post_status'       => 'publish',
                            'paged'             => $paged,
                            'posts_per_page'    => (int)$posts_per_page,
                            'orderby'           => $orderby,
                            'order'             => $order,
                            'tax_query'         => ( !empty($category) ? array(
                                    array(
                                        'taxonomy' => AlbumPostType::get_instance()->postTypeTax,
                                        'field' => 'id',
                                        'terms' => $category
                                    ),
                                ) : false ),
                            //'category__in'      => $category,
                            //'author__in'        => $authors
                        );

                        $query = new WP_Query($args);

                        ?>

                        <?php if ( $query->have_posts() ) : ?>

                            <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                                <?php
                                $artist = rwmb_meta( "{$prefix}album_artist_name" );

                                $terms = wp_get_post_terms( get_the_ID(), AlbumPostType::get_instance()->postTypeTax );
                                ?>

                                <article class="<?= $album_class; ?> <?php foreach($terms as $term) { echo $term->slug . ' '; } ?>">
                                    <figure>
                                        <a href="<?php the_permalink(); ?>" class="back-face">
                                            <h5>
                                                <?php the_title(); ?>
                                            </h5>
                                            <h6>
                                                <?= $artist; ?>
                                            </h6>
                                            <i class="fa fa-link"></i>
                                        </a>
                                        <figcaption>
                                            <div class="desc">
                                                <h5>
                                                    <?php the_title(); ?>
                                                </h5>
                                                <h6>
                                                    <?= $artist; ?>
                                                </h6>
                                            </div>
                                            <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                                                <?php the_post_thumbnail('album_list_1'); ?>
                                            <?php endif; ?>
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
    </div>
    </div>
    <!-- ================================================== -->
    <!-- =============== END CONTENT-CONTAINER ================ -->
    <!-- ================================================== -->

<?php get_footer(); ?>