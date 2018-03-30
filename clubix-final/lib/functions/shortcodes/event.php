<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Clubix_Next_Events_Shortcode {

    protected static $instance = null;

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {
        add_shortcode( 'clx_next_events', array( &$this, 'shortcode' ) );
    }

    public function shortcode( $atts ) {
        $output = $event_id = '';

        extract( shortcode_atts( array(
            'event_id'          => '',
        ), $atts ) );

        // Construct the query
        $ids = clx_get_events_ordered_ids();
        $args = array(
            'post_type'         => EventPostType::get_instance()->postType,
            'post_status'       => 'publish',
            'post__in'          => $ids,
            'orderby'           => 'post__in',
            'posts_per_page'    => 2
        );
        $query = new WP_Query($args);

        if ( $query->have_posts() ) :

            ?> <div class="events-container"> <?php

            while ( $query->have_posts() ) : $query->the_post();

                $Event = clx_get_event_meta(get_the_ID()); ?>

                <article class="<?= 'col-sm-6 col-xs-6'; ?>">
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
                                        <?= date('M d', strtotime($Event['event_start_date'])) . ' '. __('-', LANGUAGE_ZONE) . ' ' . date('M d', strtotime($Event['event_end_date'])); ?>
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
                                    echo date('d / M / Y', strtotime($Event['event_start_date']));
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
                                            <?= $Event['event_start_hour']; ?>:<?= $Event['event_start_minute']; ?> <?= $Event['event_start_am_pm']; ?> - <?= $Event['event_end_hour']; ?>:<?= $Event['event_end_minute']; ?> <?= $Event['event_end_am_pm']; ?>
                                        </p>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>

                    </figure>
                </article>

            <?php endwhile; ?>

            </div>

        <?php else : ?>

            <?php
            /* Get the none-content template (error) */
            get_template_part( 'content', 'none' );
            ?>

        <?php endif; ?>
        <?php
        wp_reset_postdata();
        // End The Loop

        return;
    }

}

Clubix_Next_Events_Shortcode::get_instance();