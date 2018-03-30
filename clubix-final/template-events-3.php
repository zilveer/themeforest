<?php
/* Template Name: Events Style 3 */

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

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h3 style="text-transform: uppercase;font-size: 22px;font-weight: 400;margin-top: 0;"><?php _e('Upcoming Events', LANGUAGE_ZONE); ?></h3>
                                            <div class="underline-bg">
                                                <div class="underline template-based-element-background-color"></div>
                                            </div>
                                        </div>
                                    </div>

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
                                    $i = 0;
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

                                            // Show this if we are on the first event from the past.
                                            $Event = clx_get_event_meta(get_the_ID());
                                            $date = strtotime($Event['event_start_date'] . ' ' . $Event['event_start_hour'].':'.$Event['event_start_minute'] .' '. $Event['event_start_am_pm'] );
                                            $now = strtotime('now');
                                            if($i == 0 && $date < $now) {
                                                ?>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h3 style="text-transform: uppercase;font-size: 22px;font-weight: 400;margin-top: 0;"><?php _e('Past Events', LANGUAGE_ZONE); ?></h3>
                                                        <div class="underline-bg">
                                                            <div class="underline template-based-element-background-color"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                $i++;
                                            }
                                            ?>

                                            <?php

                                            if ( $i != 0 || $Event['event_tickets_type'] != 'selling' ) {
                                                $event_class = 'simple-event end clearfix';
                                            } else {
                                                $event_class = 'simple-event clearfix';
                                            }

                                            ?>

                                            <article class="<?= $event_class; ?>">

                                                <div class="left"><?php echo date_i18n( 'd M Y', strtotime($Event['event_start_date'] ) ); ?>
                                                </div>

                                                <div class="right">

                                                    <?php if($Event['event_enable_tickets']) : ?>
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php
                                                            switch($Event['event_tickets_type']) {
                                                                case 'selling': _e('Buy Tickets', LANGUAGE_ZONE); break;
                                                                case 'free': _e('Free Entry', LANGUAGE_ZONE); break;
                                                                case 'cancelled': _e('Cancelled', LANGUAGE_ZONE); break;
                                                                case 'soldout': _e('Sold Out', LANGUAGE_ZONE); break;
                                                            }
                                                        ?>
                                                    </a>
                                                    <?php else: ?>
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php
                                                        _e('Read More', LANGUAGE_ZONE);
                                                        ?>
                                                    </a>
                                                    <?php endif; ?>

                                                    <h4>
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h4>

                                                    <?php if($Event['event_city'] && $Event['event_country']): ?>
                                                        <p>
                                                            <i class="fa fa-map-marker"></i>
                                                            <?= $Event['event_city'] . ', ' . $Event['event_country']; ?>
                                                        </p>
                                                    <?php elseif($Event['event_city']) : ?>
                                                        <p>
                                                            <i class="fa fa-map-marker"></i>
                                                            <?= $Event['event_city']; ?>
                                                        </p>
                                                    <?php elseif($Event['event_country']) : ?>
                                                        <p>
                                                            <i class="fa fa-map-marker"></i>
                                                            <?= $Event['event_country']; ?>
                                                        </p>
                                                    <?php endif; ?>

                                                    <?php if( $Event['event_all_day'] ): ?>

                                                        <p>
                                                            <i class="fa fa-clock-o"></i>
                                                            <?php _e('All day.', LANGUAGE_ZONE); ?>
                                                        </p>

                                                    <?php else : ?>
                                                        <p>
                                                            <i class="fa fa-clock-o"></i>
                                                            <?php
                                                            global $clx_data;
                                                            $c12h = $clx_data['event-time-format'];
                                                            $event_start_hour = absint( $Event['event_start_hour'] );
                                                            $event_end_hour = absint( $Event['event_end_hour'] );
                                                            
                                                            if( ! $clx_data['event-time-format'] ) {
                                                                if( 'pm' == $Event['event_start_am_pm'] ) {
                                                                	$event_start_hour += 12;
                                                                }
                                                                
                                                                if( 'pm' == $Event['event_end_am_pm'] ) {
                                                                	$event_end_hour += 12;
                                                                }
                                                            }
                                                            
                                                            echo $event_start_hour;
                                                            echo ':';
                                                            echo $Event['event_start_minute'];
                                                            
                                                            if( $clx_data['event-time-format'] ) {
                                                                echo ' ';
                                                                echo $Event['event_start_am_pm'];
                                                            }
                                                            
                                                            echo ' &ndash; ';
                                                            echo $event_end_hour;
                                                            echo ':';
                                                            echo $Event['event_end_minute'];
                                                            
                                                            if( $clx_data['event-time-format'] ) {
                                                                echo ' ';
                                                                echo $Event['event_end_am_pm'];
                                                            }
                                                            ?>
                                                        </p>
                                                    <?php endif; ?>

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