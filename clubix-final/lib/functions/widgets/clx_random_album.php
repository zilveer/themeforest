<?php

/**
 * Next Event Widget
 */
class Clx_Random_Album_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'clx_random_album_widget', // Base ID
            __('Clubix Random Album', LANGUAGE_ZONE), // Name
            array( 'description' => __( 'Adds a random album widget with some info.', LANGUAGE_ZONE ), )
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


        // Create a query loop and display only the first event from the ids array
        $qargs = array(
            'post_type'         => AlbumPostType::get_instance()->postType,
            'post_status'       => 'publish',
            'orderby'           => 'rand',
            'posts_per_page'    => 1
        );
        $query = new WP_Query($qargs);

        if ( $query->have_posts() ) : ?>

            <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                <?php
                $prefix = Haze_Meta_Boxes::get_instance()->prefix;
                ?>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="widget top-albums-widget">
                            <article class="clearfix">
                                <figure class="clearfix">

                                    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                                        <figcaption>
                                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog_image_1'); ?></a>
                                        </figcaption>
                                    <?php endif; ?>

                                    <?php clx_tags(); ?>

                                </figure>
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
                                        <?php the_excerpt(); ?>
                                    </p>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php _e('Read more', LANGUAGE_ZONE); ?>
                                    </a>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>

            <?php endwhile; ?>

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
        }
        else {
            $title = __( 'Random Album', LANGUAGE_ZONE );
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