<?php

class Aviators_Widget_Call_To_Action extends WP_Widget {
    function __construct( $id_base = null, $name = null, $widget_options = array(), $control_options = array() )  {
        if( !$id_base ) {
            $id_base = 'aviators_call_to_action';
        }

        if ( ! $name ) {
            $name = __( 'Call To Action', 'aviators' );
        }

        $widget_ops = array( 'description' => __( 'Call to action button.', 'aviators' ) );

        parent::__construct( $id_base, $name, $widget_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );

       ?>

        <?php echo wp_kses( $args['before_widget'], wp_kses_allowed_html( 'post' ) ); ?>

        <div class="<?php echo esc_attr( $instance['class'] ); ?>">
            <div class="row">
                <div class="call-to-action-text col-sm-12 col-md-9">
                    <?php echo wp_kses( $instance[ 'text' ], wp_kses_allowed_html( 'post' ) ); ?>
                </div>
                <div class="col-sm-12 col-md-3">
                    <a href="<?php echo wp_kses( $instance[ 'button_link' ], wp_kses_allowed_html( 'post' ) ); ?>" class="btn btn-primary" >
                        <?php echo wp_kses( $instance[ 'button_text' ], wp_kses_allowed_html( 'post' ) ); ?>
                    </a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.fullwidth -->

        <?php echo wp_kses( $args['after_widget'], wp_kses_allowed_html( 'post' ) ); ?>

    <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['text'] = ( ! empty( $new_instance['text'] ) ) ? ( $new_instance['text'] ) : '';
        $instance['button_text'] = ( ! empty( $new_instance['button_text'] ) ) ? ( $new_instance['button_text'] ) : '';
        $instance['button_link'] = ( ! empty( $new_instance['button_link'] ) ) ? ( $new_instance['button_link'] ) : '';

        $instance['class'] = ( ! empty( $new_instance['class'] ) ) ? ( $new_instance['class'] ) : '';

        return $instance;
    }

    function form( $instance ) {
        ?>

        <?php $text = ( isset( $instance[ 'text' ] ) ) ? $instance[ 'text' ] : ''; ?>
        <?php $button_text = ( isset( $instance[ 'button_text' ] ) ) ? $instance[ 'button_text' ] : ''; ?>
        <?php $button_link = ( isset( $instance[ 'button_link' ] ) ) ? $instance[ 'button_link' ] : ''; ?>
        <?php $class = ( isset( $instance[ 'class' ] ) ) ? $instance[ 'class' ] : 'fullwidth background-primary'; ?>

        <p>
            <?php echo __( 'Text:', 'aviators' ); ?>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>"/>
        </p>

        <p>
            <?php echo __( 'Button Text:', 'aviators' ); ?>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_text' ) ); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>"/>
        </p>

        <p>
            <?php echo __( 'Button Link:', 'aviators' ); ?>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_link' ) ); ?>" type="text" value="<?php echo esc_attr( $button_link ); ?>"/>
        </p>

        <p>
            <?php echo __( 'Extra classes:', 'aviators' ); ?>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'class' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'class' ) ); ?>" type="text" value="<?php echo esc_attr( $class ); ?>"/>
        </p>

        <?php
    }
}
