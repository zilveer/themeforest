<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
class crum_list_widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'list_widget', // Base ID
            'Widget: Styled list', // Name
            array( 'description' => __( 'List of ', 'dfd' ), ) // Args
        );
    }


    public function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );

        $html = $instance['html'];

        echo $before_widget;
        if ($title) {

            echo $before_title;
            echo $title;
            echo $after_title;

        }
        echo '<ul class="styled-widget-list">';
        echo $html;
        echo '</ul>'; ?>

        <?php echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['html'] = $new_instance['html'];

        return $instance;
    }

    /**
     * Back-end widget form.
     */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Styled list', 'dfd' );
        }

        if ( isset( $instance[ 'html' ] ) ) {
            $html = $instance[ 'html' ];
        }

        ?>
    <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'dfd' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>


    <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'html' )); ?>"><?php _e( 'Items wrapped in: li HTML tags', 'dfd' ); ?>:</label>
        <textarea  class="widefat" cols="40" rows="20" id="<?php echo esc_attr($this->get_field_id( 'html' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'html' )); ?>"><?php echo $html; ?></textarea>
    </p>


    <?php
    }

}