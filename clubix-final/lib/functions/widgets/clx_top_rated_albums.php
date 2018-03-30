<?php

/**
 * Next Event Widget
 */
class Clx_Top_Rated_Albums_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'clx_top_rated_albums_widget', // Base ID
            __('Clubix Top Rated Albums', LANGUAGE_ZONE), // Name
            array( 'description' => __( 'Adds a top rated albums widget.', LANGUAGE_ZONE ), )
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
        $per_page = isset( $instance['clx_nr_of_events'] ) ? $instance['clx_nr_of_events'] : 3;

        echo $args['before_widget'];

        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

        $prefix = Haze_Meta_Boxes::get_instance()->prefix;

        // Create a query loop and display only the first event from the ids array
        $qargs = array(
            'post_type'         => AlbumPostType::get_instance()->postType,
            'post_status'       => 'publish',
            'posts_per_page'    => $per_page,
            'meta_key'          => "{$prefix}album_rating",
            'orderby'           => 'meta_value_num',
            'order'             => 'DESC',
        );
        $query = new WP_Query($qargs);

        if ( $query->have_posts() ) : ?>

            <div class="row">
                <div class="col-sm-12">
                    <div class="widget top-rated-albums-widget">

                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                            <article>
                                <figure>

                                    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                                        <figcaption>
                                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog_image_1'); ?></a>
                                        </figcaption>
                                    <?php endif; ?>

                                    <div class="content">
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
                                        <h5>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h5>
                                        <p>
                                            <?php _e('by', LANGUAGE_ZONE); ?>
                                            <a>
                                                <?= $artist = rwmb_meta( "{$prefix}album_artist_name" ); ?>
                                            </a>
                                        </p>
                                    </div>
                                </figure>
                            </article>


                        <?php endwhile; ?>

                    </div></div></div>

        <?php else : ?>

            <?php
            /* Get the none-content template (error) */
            _e('You don\'t have any albums.', LANGUAGE_ZONE);
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
            $title = __( 'Top Rated Albums', LANGUAGE_ZONE );
        }
        if ( isset( $instance[ 'clx_nr_of_events' ] ) ) {
            $nr = $instance[ 'clx_nr_of_events' ];
        } else {
            $nr = 5;
        }
        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'clx_nr_of_events' ); ?>"><?php _e( 'Number of events:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'clx_nr_of_events' ); ?>" name="<?php echo $this->get_field_name( 'clx_nr_of_events' ); ?>" type="number" value="<?php echo esc_attr( $nr ); ?>">
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

        return $instance;
    }

}