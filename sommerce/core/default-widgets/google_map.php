<?php

class google_map extends WP_Widget 
{
    function __construct()
    {
        $widget_ops = array( 
            'classname' => 'google-map', 
            'description' => __('Box with google map.', 'yiw') 
        );

        $control_ops = array( 'id_base' => 'google-map' );

        WP_Widget::__construct( 'google-map', 'Google Map', $widget_ops, $control_ops );
    }
    
    function widget( $args, $instance ) 
    {
        extract( $args );

        /* User-selected settings. */
        $title = apply_filters('widget_title', $instance['title'] );

        $src = isset( $instance['src'] ) ? $instance['src'] : false;
        $width = isset( $instance['width'] ) ? $instance['width'] : 274;
        $height = isset( $instance['height'] ) ? $instance['height'] : 200;

        echo $before_widget;
        
        if ( $title ) echo $before_title . $title . $after_title;
        
        if( $src ) echo do_shortcode( "[googlemap src=\"$src\" width=\"$width\" height=\"$height\" ]" );
        
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) 
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['src'] = $new_instance['src'];          

        $instance['width'] = $new_instance['width'];          

        $instance['height'] = $new_instance['height'];          

        return $instance;
    }

    function form( $instance ) 
    {
        global $icons_name, $yiw_fxs, $yiw_easings;
        
        
        /* Impostazioni di default del widget */
        $defaults = array( 
            'title' => 'Google Map', 
            'src' => '',
            "width" => '274',
            "height" => '200',
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:
                 <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'src' ); ?>">Src:
                 <input type="text" id="<?php echo $this->get_field_id( 'src' ); ?>" name="<?php echo $this->get_field_name( 'src' ); ?>" value="<?php echo $instance['src']; ?>" class="widefat" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'width' ); ?>">Width:
                 <input type="text" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo $instance['width']; ?>" class="widefat" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'height' ); ?>">Height:
                 <input type="text" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>" class="widefat" />
            </label>
        </p>
    <?php
    }
}

?>
