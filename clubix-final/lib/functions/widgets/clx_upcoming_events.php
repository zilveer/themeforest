<?php

/**
 * Next Event Widget
 */
class Clx_Upcoming_Events_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'clx_upcoming_events_widget', // Base ID
            __('Clubix Upcoming Events', LANGUAGE_ZONE), // Name
            array( 'description' => __( 'Adds a widget with the upcoming events info.', LANGUAGE_ZONE ), )
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
       
	   if($instance['clx_events_category'] != '') {$events_cat = array($instance['clx_events_category']);} else {$events_cat = array();}
        $per_page = isset( $instance['clx_nr_of_events'] ) ? $instance['clx_nr_of_events'] : 3;

        echo $args['before_widget'];

        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

		// Get all events ids in order
        $next_events = clx_get_events_ordered_ids($instance['clx_show_passed']);
		
		
        // Create a query loop and display only the first event from the ids array
        $qargs = array(
            'post_type'         => EventPostType::get_instance()->postType,
            'post_status'       => 'publish',
            'post__in'          => $next_events,
            'orderby'           => 'post__in',
            'posts_per_page'    => $per_page,
            'tax_query'         => ( !empty($events_cat) ? array(
                    array(
                        'taxonomy' => EventPostType::get_instance()->postTypeTax,
                        'field' => 'id',
                        'terms' => $events_cat
                    ),
                ) : false ),
        );
        $query = new WP_Query($qargs);

		  if ( $query->have_posts() ) : ?>

            <div class="row">
            <div class="col-sm-12">
            <div class="widget event-widget">
			
			<?php
			if (empty($next_events) && !isset($instance['clx_show_passed']) ){
					echo 'No events to show';
					exit;
			}
			?>
      
			
			
			
			
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                <?php
                $Event = clx_get_event_meta(get_the_ID());
                ?>

                <figure class="clearfix">
					
				    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                        <figcaption>
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog_image_1'); ?></a>
                        </figcaption>
                    <?php endif; ?>

                    <section>
                        <ul class="date clearfix">
                            <?php
                            // Construct the date into an accepted Date object of jQuery
                            // Send the date with the dateTo attribute
                            // Take it in jQuery and construct the countdown
                            $timestamp = strtotime($Event['event_start_date'] . ' ' . $Event['event_start_hour'].':'.$Event['event_start_minute'] .' '. $Event['event_start_am_pm'] );
                            ?>
                            <li>
                                <?= date('j', $timestamp); ?>
                            </li>
                            <li>
                                <?= (date('m', $timestamp)); ?>
                            </li>
                            <li>
                                <?= date('Y', $timestamp); ?>
                            </li>
                        </ul>
                        <div>
                            <a href="<?php the_permalink(); ?>">
                                <?php _e('more info', LANGUAGE_ZONE); ?>
                            </a>
                        </div>
                        <div>
                            <p>
                                <i class="fa fa-map-marker"></i>
                                <?= $Event['event_city']; ?>
                            </p>
                            <p>
                                <i class="fa fa-clock-o"></i>
                                <?= $Event['event_start_hour']; ?>:<?= $Event['event_start_minute']; ?> <?= $Event['event_start_am_pm']; ?>
                            </p>
                        </div>
                    </section>
                </figure>

            <?php endwhile; ?>

            </div></div></div>

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
        } else {
            $title = __( 'Upcoming Events', LANGUAGE_ZONE );
        }
        
		if ( isset( $instance[ 'clx_nr_of_events' ] ) ) {
            $nr = $instance[ 'clx_nr_of_events' ];
        } else {
            $nr = 3;
        }
		
		if ( isset( $instance[ 'clx_show_passed'] ) ) {
            $checkbox = $instance[ 'clx_show_passed' ];
        } else {
            $checkbox = 'off';
        }
		
        $events_cat = isset( $instance['clx_events_category'] ) ? $instance['clx_events_category'] : '';

        $terms = get_terms(EventPostType::get_instance()->postTypeTax);
        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'clx_nr_of_events' ); ?>"><?php _e( 'Number of events:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'clx_nr_of_events' ); ?>" name="<?php echo $this->get_field_name( 'clx_nr_of_events' ); ?>" type="number" value="<?php echo esc_attr( $nr ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'clx_events_category' ); ?>"><?php _e( 'Event Category:' ); ?></label>
            <select class="widefat" name="<?php echo $this->get_field_name( 'clx_events_category' ); ?>" id="<?php echo $this->get_field_id( 'clx_events_category' ); ?>">

                <option value=""><?php _e('All events', LANGUAGE_ZONE); ?></option>

                <?php
                foreach($terms as $term) :
                ?>

                <option value="<?= $term->term_id; ?>" <?= selected( $events_cat, $term->term_id, false ); ?>><?= esc_html($term->name); ?></option>

                <?php
                endforeach;
                ?>

            </select>
        </p>
		<p>
            <label for="<?php echo $this->get_field_id( 'clx_show_passed' ); ?>"><?php _e( 'Show Passed Events:' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'clx_show_passed' ); ?>" name="<?php echo $this->get_field_name( 'clx_show_passed' ); ?>" type="checkbox" <?php checked( 'on',$checkbox ); ?> />
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
        $instance['clx_nr_of_events'] = (int) $new_instance['clx_nr_of_events'];
        $instance['clx_events_category'] = (int) $new_instance['clx_events_category'];
		$instance['clx_show_passed'] = $new_instance['clx_show_passed'];
		
        return $instance;
    }

}