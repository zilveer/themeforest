<?php

    /*
    *
    *	Custom Flickr Widget
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    */

    class sf_flickr_widget extends WP_Widget {

        function __construct() {
            $widget_ops = array(
                'classname'   => 'flickr-widget',
                'description' => 'Show off your favorite Flickr photos'
            );
            parent::__construct( 'flickr-widget', 'Swift Framework Flickr Widget', $widget_ops );
        }

        function form( $instance ) {

            $instance   = wp_parse_args( (array) $instance, array(
                    'title'      => 'Flickr Photos',
                    'number'     => 8,
                    'flickr_api' => '',
                    'flickr_id'  => ''
                ) );
            $title      = esc_attr( $instance['title'] );
            $flickr_api = $instance['flickr_api'];
            $flickr_id  = $instance['flickr_id'];
            $number     = absint( $instance['number'] );

            $id_getter_url = "http://idgettr.com";

            ?>
            <p>
                <label
                    for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'swiftframework' ); ?>
                    :</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
                       value="<?php echo $title; ?>"/>
            </p>

            <p>
                <label
                    for="<?php echo $this->get_field_id( 'flickr_id' ); ?>"><?php _e( 'Flickr ID', 'swiftframework' ); ?>
                    :</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'flickr_id' ); ?>"
                       name="<?php echo $this->get_field_name( 'flickr_id' ); ?>" type="text"
                       value="<?php echo $flickr_id; ?>"/>
                <small>Don't know your ID? Head on over to <a href="<?php echo $id_getter_url; ?>">idgettr</a> to find
                    it.
                </small>
            </p>

            <p>
                <label
                    for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of Photos', 'swiftframework' ); ?>
                    :</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>"
                       name="<?php echo $this->get_field_name( 'number' ); ?>" type="text"
                       value="<?php echo $number; ?>"/>
            </p>

        <?php
        }

        function update( $new_instance, $old_instance ) {

            $instance = $old_instance;

            $instance['title']      = strip_tags( $new_instance['title'] );
            $instance['flickr_api'] = $new_instance['flickr_api'];
            $instance['flickr_id']  = $new_instance['flickr_id'];
            $instance['number']     = $new_instance['number'];

            return $instance;
        }

        function widget( $args, $instance ) {

            extract( $args );

            $title     = apply_filters( 'widget_title', $instance['title'] );
            $flickrid  = $instance['flickr_id'];
            $count     = $instance['number'];
            $widget_id = "flickr-" . rand();

            if ( $title ) {
                echo $before_title . $title . $after_title;
            }

            echo $before_widget;

            // let's get into the javascript...
            ?>

            <ul id="<?php echo $widget_id; ?>" class="flickr_images clearfix"></ul>

            <script type="text/javascript">
                jQuery( document ).ready(
                    function( $ ) {
                        var count = parseInt( <?php echo $count; ?>, 10 );
                        $.getJSON(
                            "//api.flickr.com/services/feeds/photos_public.gne?ids=<?php echo $flickrid; ?>&lang=en-us&format=json&jsoncallback=?",
                            function( data ) {
                                $.each(
                                    data.items, function( index, item ) {
                                        $( "<img class='flickr'/>" ).attr(
                                            "src", item.media.m
                                        ).appendTo( '#<?php echo $widget_id; ?>' )
                                            .wrap( "<li><a href='" + item.link + "' class='flickr-img-link' target='_blank'></a></li>" );
                                        return index + 1 < count;
                                    }
                                );
                            }
                        );
                    }
                );
            </script>
            <?php

            echo $after_widget;
        }

    }

    add_action( 'widgets_init', 'sf_load_flickr_widget' );

    function sf_load_flickr_widget() {
        register_widget( 'sf_flickr_widget' );
    }

?>