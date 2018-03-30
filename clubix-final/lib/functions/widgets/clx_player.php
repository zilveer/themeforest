<?php

/**
 * Next Event Widget
 */
class Clx_Player_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'clx_player_widget', // Base ID
            __('Clubix Player', LANGUAGE_ZONE), // Name
            array( 'description' => __( 'Adds a player widget with selected songs in the sidebar.', LANGUAGE_ZONE ), )
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
        $songs = isset( $instance['clx_songs_ids'] ) ? $instance['clx_songs_ids'] : '';

        echo $args['before_widget'];

        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

        echo '<div class="row"><div class="col-sm-12"><div class="widget event-widget"><div class="minimal-player">';
        echo clx_simple_song_player($songs);
        echo '</div></div></div></div>';

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
            $title = __( 'Audio Player', LANGUAGE_ZONE );
        }
        $songs = isset( $instance['clx_songs_ids'] ) ? $instance['clx_songs_ids'] : array();

        $allsongs = get_posts(array('post_type' => SongPostType::get_instance()->postType, 'posts_per_page' => 999 ));
        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'clx_songs_ids' ); ?>"><?php _e( 'Select Songs:' ); ?></label>
            <?php
            foreach($allsongs as $song) :
            ?>

            <br/>
            <input id="<?php echo $this->get_field_id('clx_songs_ids'); ?>" name="<?php echo $this->get_field_name('clx_songs_ids'); ?>[]" type="checkbox" value="<?php echo $song->ID; ?>" <?php echo in_array($song->ID, $songs) ? 'checked="checked"' : ''; ?> /><?php echo $song->post_title;  ?>

            <?php
            endforeach;
            ?>
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
        $instance['clx_songs_ids'] = $new_instance['clx_songs_ids'];

        return $instance;
    }

}