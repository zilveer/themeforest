<?php
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$search_query = get_search_query();
$prefix = Haze_Meta_Boxes::get_instance()->prefix;

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

                                    <h3 style="text-transform: uppercase;font-size: 22px;font-weight: 400;margin-top: 0;margin-bottom:10px;"><?php _e('Posts', LANGUAGE_ZONE); ?></h3><div class="underline-bg"><div class="underline template-based-element-background-color"></div></div>

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


                            <div class="row">

                                <div class="col-sm-12">

                                    <h3 style="text-transform: uppercase;font-size: 22px;font-weight: 400;margin-top: 0;margin-bottom:10px;"><?php _e('Albums', LANGUAGE_ZONE); ?></h3><div class="underline-bg"><div class="underline template-based-element-background-color"></div></div>

                                    <?php
                                    /**
                                     * clubix_before_posts_loop hook
                                     *
                                     * @hooked nothing
                                     */
                                    do_action( 'clubix_before_posts_loop' );
                                    ?>

                                    <div class="filter-container ablums-posts-right">

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
                                            'posts_per_page'    => 20,
                                            's'                 => $search_query
                                        );

                                        $query = new WP_Query($args);

                                        ?>

                                        <?php if ( $query->have_posts() ) : ?>

                                            <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                                                <?php
                                                /**
                                                 * Remove filter because it stays activated throw all posts.
                                                 */
                                                remove_filter('zen_get_content_more', 'zen_return_empty_string', 15);

                                                $artist = rwmb_meta( "{$prefix}album_artist_name" );

                                                $terms = wp_get_post_terms( get_the_ID(), AlbumPostType::get_instance()->postTypeTax );
                                                ?>

                                                <article class="<?php foreach($terms as $term) { echo $term->slug . ' '; } ?> clearfix">
                                                    <div class="left clearfix">

                                                        <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                                                            <figure class="clearfix">
                                                                <figcaption>
                                                                    <a href="<?php the_permalink(); ?>">
                                                                        <?php the_post_thumbnail('blog_image_1'); ?>
                                                                    </a>
                                                                </figcaption>
                                                                <?php clx_tags(); ?>
                                                            </figure>
                                                        <?php endif; ?>

                                                        <div class="content">
                                                            <h4>
                                                                <a href="<?php the_permalink(); ?>">
                                                                    <?php the_title(); ?>
                                                                </a>
                                                            </h4>
                                                            <div class="rating">
                                                                <?php $rating = rwmb_meta("{$prefix}album_rating"); ?>
                                                                <div class="full" style="width: <?= $rating; ?>%;">
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                </div>
                                                                <div class="empty">
                                                                    <i class="fa fa-star-o"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                </div>
                                                            </div>
                                                            <p>
                                                                <?php zen_the_excerpt(); ?>
                                                            </p>
                                                            <?= zen_get_content_more(); ?>
                                                        </div>
                                                    </div>
                                                    <div class="right clearfix">

                                                        <div class="minimal-player">

                                                            <!-- Here comes the player -->
                                                            <?php
                                                            $ids = rwmb_meta("{$prefix}album_songs", array('type' => 'checkbox_list'));
                                                            ?>
                                                            <?php echo clx_simple_song_player($ids); ?>

                                                        </div>

                                                    </div>
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

                            <br/>

                            <div class="row">

                                <div class="col-sm-12">

                                    <h3 style="text-transform: uppercase;font-size: 22px;font-weight: 400;margin-top: 0;margin-bottom:10px;"><?php _e('Events', LANGUAGE_ZONE); ?></h3><div class="underline-bg"><div class="underline template-based-element-background-color"></div></div>

                                    <?php
                                    /**
                                     * clubix_before_posts_loop hook
                                     *
                                     * @hooked nothing
                                     */
                                    do_action( 'clubix_before_posts_loop' );
                                    ?>

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
                                    $ids = clx_get_events_ordered_ids(true);
                                    if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
                                    elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
                                    else { $paged = 1; }
                                    $args = array(
                                        'post_type'         => EventPostType::get_instance()->postType,
                                        'post_status'       => 'publish',
                                        'paged'             => $paged,
                                        'post__in'          => $ids,
                                        's'                 => $search_query,
                                        'orderby'           => 'post__in',
                                        'posts_per_page'    => 20
                                    );

                                    $query = new WP_Query($args);

                                    ?>

                                    <?php if ( $query->have_posts() ) : ?>

                                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                                            <?php
                                            $Event = clx_get_event_meta(get_the_ID());
                                            ?>

                                            <article class="event-article clearfix">
                                                <figure class="clearfix">
                                                    <figcaption>
                                                        <p>
                                                            <?php // TODO Here, take the date format from the user. ?>
                                                            <?php
                                                            echo date('d / M / Y', strtotime($Event['event_start_date']));
                                                            ?>
                                                        </p>
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                                                                <?php the_post_thumbnail('song_single'); ?>
                                                            <?php endif; ?>
                                                        </a>
                                                    </figcaption>
                                                    <div class="content clearfix">
                                                        <h1>
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php the_title(); ?>
                                                            </a>
                                                        </h1>
                                                        <div class="entry-meta">


                                                            <?php if($Event['event_city'] && $Event['event_country']): ?>
                                                                <span>
                                                            <i class="fa fa-map-marker"></i>
                                                                    <?= $Event['event_city'] . ', ' . $Event['event_country']; ?>
                                                            </span>
                                                            <?php elseif($Event['event_city']) : ?>
                                                                <span>
                                                            <i class="fa fa-map-marker"></i>
                                                                    <?= $Event['event_city']; ?>
                                                            </span>
                                                            <?php elseif($Event['event_country']) : ?>
                                                                <span>
                                                            <i class="fa fa-map-marker"></i>
                                                                    <?= $Event['event_country']; ?>
                                                            </span>
                                                            <?php endif; ?>

                                                            <span>
														<i class="fa fa-clock-o"></i>
                                                                <?php // TODO Here, take the date format from the user. ?>
                                                                <?= date('M d', strtotime($Event['event_start_date'])) . ' - ' . date('M d', strtotime($Event['event_end_date'])); ?>
													</span>
                                                        </div>
                                                        <hr>
                                                        <div class="entry-content">
                                                            <p>
                                                                <?php the_excerpt(); ?>
                                                            </p>
                                                        </div>
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php _e('read more', LANGUAGE_ZONE); ?>
                                                        </a>
                                                    </div>
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

                            <br/>

                            <?php
                            /**
                             * clubix_before_posts_loop hook
                             *
                             * @hooked nothing
                             */
                            do_action( 'clubix_before_posts_loop' );
                            ?>

                            <h3 style="text-transform: uppercase;font-size: 22px;font-weight: 400;margin-top: 0;margin-bottom:10px;"><?php _e('Artists', LANGUAGE_ZONE); ?></h3><div class="underline-bg"><div class="underline template-based-element-background-color"></div></div>


                            <div class="filter-container artists-container">

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
                                    'post_type'         => ArtistPostType::get_instance()->postType,
                                    'post_status'       => 'publish',
                                    'paged'             => $paged,
                                    'posts_per_page'    => 20,
                                    's'                 => $search_query
                                );

                                $query = new WP_Query($args);

                                ?>

                                <?php if ( $query->have_posts() ) : ?>

                                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                                        <?php
                                        $terms = wp_get_post_terms( get_the_ID(), ArtistPostType::get_instance()->postTypeTax );
                                        ?>

                                        <article class="<?= $album_class; ?> <?php foreach($terms as $term) { echo $term->slug . ' '; } ?>">
                                            <figure>
                                                <a href="<?php the_permalink(); ?>" class="back-face">
                                                    <h5>
                                                        <?php the_title(); ?>
                                                    </h5>
                                                    <i class="fa fa-link"></i>
                                                </a>
                                                <figcaption>
                                                    <div class="desc gradient">
                                                        <h5>
                                                            <?php the_title(); ?>
                                                        </h5>
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