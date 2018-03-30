<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Clubix_Slider_Events_Shortcode {

    protected static $instance = null;

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {
        add_shortcode( 'clx_slider_events', array( &$this, 'shortcode' ) );
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
            'posts_per_page'    => 5
        );
        $query = new WP_Query($args);

        if ( $query->have_posts() ) :

            $output .= '<div class="event-widget tp-caption owl-event-widget sfl">';

            while ( $query->have_posts() ) : $query->the_post();

                $Event = clx_get_event_meta(get_the_ID());

                $output .= '<figure class="clearfix"><figcaption>';
                if ( has_post_thumbnail() && ! post_password_required() ) :
                    $output .= '<a href="'. get_the_permalink() .'">'. get_the_post_thumbnail(get_the_ID(),'album_list_1') .'</a>';
                endif;
                $output .= '</figcaption><section>';

                // Construct the date into an accepted Date object of jQuery
                // Send the date with the dateTo attribute
                // Take it in jQuery and construct the countdown
                $timestamp = strtotime($Event['event_start_date'] . ' ' . $Event['event_start_hour'].':'.$Event['event_start_minute'] .' '. $Event['event_start_am_pm'] );
                $dateTo = date('Y,m,', $timestamp);
                $dateTo .= (date('j', $timestamp) - 1);
                $dateTo .= date(',h,i,s', $timestamp);

                $output .= '<ul class="timer clearfix"
                            data-year="'. date('Y', $timestamp) .'"
                            data-month="'. (date('m', $timestamp) - 1).'"
                            data-day="'. date('j', $timestamp).'"
                            data-hour="'. date('H', $timestamp).'"
                            data-minute="'. date('i', $timestamp).'"
                            data-days-t="'. __('days', LANGUAGE_ZONE).'"
                            data-hours-t="'. __('hours', LANGUAGE_ZONE).'"
                            data-minutes-t="'. __('min', LANGUAGE_ZONE).'"
                            data-seconds-t="'. __('sec', LANGUAGE_ZONE).'"
                            >
                            </ul>';
                $output .= '<div><a href="'. get_the_permalink().'">';
                $output .= __('more info', LANGUAGE_ZONE);
                $output .= '</a></div><div>';

                if($Event['event_city']) :
                    $output .= '<p><i class="fa fa-map-marker"></i>';
                    $output .= $Event['event_city'];
                    $output .= '</p>';
                elseif($Event['event_country']) :
                    $output .= '<p><i class="fa fa-map-marker"></i>';
                    $output .= $Event['event_country'];
                    $output .= '</p>';
                endif;

                if( $Event['event_all_day'] ):
                    $output .= '<p><i class="fa fa-clock-o"></i>';
                    $output .= __('All day.', LANGUAGE_ZONE);
                    $output .= '</p>';
                else :
                    $output .= '<p><i class="fa fa-clock-o"></i>';
                    $output .= $Event['event_start_hour']. ':' . $Event['event_start_minute']. ' ' .$Event['event_start_am_pm'];
                    $output .= '</p>';
                endif;



                $output .= '</div></section></figure>';

            endwhile;

        $output .= '</div>';

        else :

            /* Get the none-content template (error) */
            $output .= __('No events found.', LANGUAGE_ZONE);

        endif;

        wp_reset_postdata();
        // End The Loop

        return $output;
    }

}

Clubix_Slider_Events_Shortcode::get_instance();