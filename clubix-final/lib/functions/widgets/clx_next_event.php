<?php

/**
 * Next Event Widget
 */
class Clx_Next_Event_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'clx_next_event_widget', // Base ID
            __('Clubix Next Event', LANGUAGE_ZONE), // Name
            array( 'description' => __( 'Adds a widget with the next event countdown and info.', LANGUAGE_ZONE ), )
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );

        echo $args['before_widget'];
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

        // Get all events ids in order
        $next_events = clx_get_events_ordered_ids();

        // Create a query loop and display only the first event from the ids array
        $qargs = array(
            'post_type'         => EventPostType::get_instance()->postType,
            'post_status'       => 'publish',
            'post__in'          => $next_events,
            'orderby'           => 'post__in',
            'posts_per_page'    => 1
        );
        $query = new WP_Query($qargs);

        if ( $query->have_posts() ) : ?>

            <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                <?php
                $Event = clx_get_event_meta(get_the_ID());
                ?>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="widget event-widget">
                            <figure class="clearfix">

                                <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                                <figcaption>
                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog_image_1'); ?></a>
                                </figcaption>
                                <?php endif; ?>

                                <section>
                                    <?php
                                    // Construct the date into an accepted Date object of jQuery
                                    // Send the date with the dateTo attribute
                                    // Take it in jQuery and construct the countdown
                                    $timestamp = strtotime($Event['event_start_date'] . ' ' . $Event['event_start_hour'].':'.$Event['event_start_minute'] .' '. $Event['event_start_am_pm'] );
                                    ?>
                                    <ul class="timer clearfix"
                                        data-year="<?php echo date('Y', $timestamp); ?>"
                                        data-month="<?php echo (date('m', $timestamp) - 1); ?>"
                                        data-day="<?php echo date('j', $timestamp); ?>"
                                        data-hour="<?php echo date('H', $timestamp); ?>"
                                        data-minute="<?php echo date('i', $timestamp); ?>"
                                        data-days-t="<?php _e('days', LANGUAGE_ZONE); ?>"
                                        data-hours-t="<?php _e('hours', LANGUAGE_ZONE); ?>"
                                        data-minutes-t="<?php _e('min', LANGUAGE_ZONE); ?>"
                                        data-seconds-t="<?php _e('sec', LANGUAGE_ZONE); ?>"
                                        >
                                    </ul>
                                    <div>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php _e('more info', LANGUAGE_ZONE); ?>
                                        </a>
                                    </div>
                                    <div>
                                        <p>
                                            <i class="fa fa-map-marker"></i>
                                            <?php echo $Event['event_city']; ?>
                                        </p>
                                        <p>
                                            <i class="fa fa-clock-o"></i>
                                            <?php echo $Event['event_start_hour']; ?>:<?php echo $Event['event_start_minute']; ?> <?php echo $Event['event_start_am_pm']; ?>
                                        </p>
                                    </div>
                                </section>
                            </figure>
                        </div>
                    </div>
                </div>

            <?php endwhile; ?>

        <?php else : ?>

            <?php
            /* Get the none-content template (error) */
            _e('You don\'t have any upcoming events.', LANGUAGE_ZONE);
            ?>

        <?php endif;
        wp_reset_postdata();
        // End The Loop

        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     * @param array $instance
     * @return string|void
     */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Next Event', LANGUAGE_ZONE );
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
    <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }

}