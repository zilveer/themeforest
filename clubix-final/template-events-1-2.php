<?php
/* Template Name: Events Style 1 - Dates Filter */

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
                <nav class="categories-portfolio">
                    <ul data-option-key="filter" class="option-set">
                        <li><a class="selected" data-option-value="*"><?php _e('All', LANGUAGE_ZONE); ?></a></li>
                        <li><a data-option-value=".today"><?php _e('Today', LANGUAGE_ZONE); ?></a></li>
                        <li><a data-option-value=".tomorrow"><?php _e('Tomorrow', LANGUAGE_ZONE); ?></a></li>
                        <li><a data-option-value=".thisweek"><?php _e('This Week', LANGUAGE_ZONE); ?></a></li>
                        <li><a data-option-value=".nextweek"><?php _e('Next Week', LANGUAGE_ZONE); ?></a></li>
                    </ul>
                </nav>

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

            <div class="filter-container events-container">

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

                        $data_filter = '';
                        $eventDate = $Event['event_start_date'];
                        $eventDateCmp = strtotime($eventDate);
                        $todaysDate = date("Y-m-d");
                        $todaysDateCmp = strtotime($todaysDate);

                        if ( $eventDateCmp == $todaysDateCmp ) {
                            $data_filter .= 'today ';
                        }

                        if ( $eventDateCmp > $todaysDateCmp && $eventDateCmp <= strtotime("+1 day") )
                        { $data_filter .= 'tomorrow '; }

                        if ( $eventDateCmp > $todaysDateCmp && $eventDateCmp < strtotime("next Monday") )
                        { $data_filter .= 'thisweek '; }

                        if ( $eventDateCmp >= strtotime("next Monday") && $eventDateCmp < strtotime("next Monday +1 week") )
                        { $data_filter .= 'nextweek '; }



                        ?>

                        <article class="<?= 'col-sm-4 col-xs-6'; ?> <?php echo $data_filter; ?>">
                            <figure>

                                <figcaption>
                                    <div class="min-info">
                                        <h4>
                                            <?php the_title(); ?>
                                        </h4>
                                        <hr/>
                                        <div class="desc">

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

                                            <p>
                                                <i class="fa fa-calendar"></i>
                                                <?php // TODO Here, take the date format from the user. ?>
                                                <?php echo date_i18n('M d', strtotime($Event['event_start_date'])) . ' '. __('-', LANGUAGE_ZONE) . ' ' . date_i18n('M d', strtotime($Event['event_end_date'])); ?>
                                            </p>
                                        </div>
                                    </div>
                                    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                                        <?php the_post_thumbnail('event_list_1'); ?>
                                    <?php endif; ?>
                                </figcaption>

                                <div class="main-content">
                                    <h4>
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h4>
                                    <hr>
                                    <div>
                                        <div class="event-date">
                                            <?php // TODO Here, take the date format from the user. ?>
                                            <?php
                                            echo date_i18n('d / M / Y', strtotime($Event['event_start_date']));
                                            ?>
                                        </div>
                                        <?php the_excerpt(); ?>
                                        <br>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php _e('more info', LANGUAGE_ZONE); ?>
                                        </a>
                                        <div class="details-event">
                                            <p>
                                                <?php if($Event['event_city'] && $Event['event_country']): ?>

                                                    <i class="fa fa-map-marker"></i>
                                                    <?= $Event['event_city'] . ', ' . $Event['event_country']; ?>

                                                <?php elseif($Event['event_city']) : ?>

                                                    <i class="fa fa-map-marker"></i>
                                                    <?= $Event['event_city']; ?>

                                                <?php elseif($Event['event_country']) : ?>

                                                    <i class="fa fa-map-marker"></i>
                                                    <?= $Event['event_country']; ?>

                                                <?php endif; ?>
                                            </p>

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
                                    </div>
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