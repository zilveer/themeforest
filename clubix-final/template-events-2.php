<?php
/* Template Name: Events Style 2 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$prefix = Haze_Meta_Boxes::get_instance()->prefix;

$posts_per_page = rwmb_meta( "{$prefix}events_posts_per_page", $args = array(), get_the_ID() );
$category = rwmb_meta( "{$prefix}events_category", array('type'=>'checkbox_list'), get_the_ID() );

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
                                $ids = clx_get_events_ordered_ids(rwmb_meta("{$prefix}hide_past_events"));
                                if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
                                elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
                                else { $paged = 1; }
                                $args = array(
                                    'post_type'         => EventPostType::get_instance()->postType,
                                    'post_status'       => 'publish',
                                    'paged'             => $paged,
                                    'post__in'          => $ids,
                                    'orderby'           => 'post__in',
                                    'posts_per_page'    => (int)$posts_per_page,
                                    'tax_query'         => ( !empty($category) ? array(
                                            array(
                                                'taxonomy' => EventPostType::get_instance()->postTypeTax,
                                                'field' => 'id',
                                                'terms' => $category
                                            ),
                                        ) : false ),
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
                                                        echo date_i18n('d / M / Y', strtotime($Event['event_start_date']));
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
                                                        <?php echo date_i18n('M d', strtotime($Event['event_start_date'])) . ' - ' . date_i18n('M d', strtotime($Event['event_end_date'])); ?>
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
                    </div>
                    </div>

                    <!-- ==== WIDGETS HERE ==== -->
                    <div class="col-sm-4">
                        <?php get_sidebar('main-sidebar'); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- ================================================== -->
    <!-- =============== END CONTENT-CONTAINER ================ -->
    <!-- ================================================== -->

<?php get_footer(); ?>