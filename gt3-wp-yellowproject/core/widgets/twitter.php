<?php

class twitter extends WP_Widget {

    function twitter() {
        parent::__construct( false, 'Twitter (current theme)' );
    }

    function widget( $args, $instance ) {
        extract($args);

        echo $before_widget;
        echo $before_title;
        echo $instance['widget_title'];
        echo $after_title;

        $rand = mt_rand(0, 10000);

        echo '
        <div class="twitter_list tweet_'.$rand.'"></div>
        <script>
            jQuery(document).ready(function(){
                jQuery(".tweet_'.$rand.'").tweet({
                    modpath: themerooturl+"/js/core/twitter/index.php",
                    count: '.$instance['twitter_widget_number'].',
                    username : "'.$instance['twitter_widget_nick'].'"
                 });
            });
        </script>
        ';

        echo $after_widget;
    }


    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['widget_title'] = esc_attr( $new_instance['widget_title'] );
        $instance['twitter_widget_nick'] = esc_attr( $new_instance['twitter_widget_nick'] );
        $instance['twitter_widget_number'] = absint( $new_instance['twitter_widget_number'] );

        return $instance;
    }

    function form( $instance ) {
        $defaultValues = array(
            'widget_title' => 'Latest Tweets',
            'twitter_widget_nick' => 'themedev',
            'twitter_widget_number' => '3'
        );
        $instance = wp_parse_args((array) $instance, $defaultValues);
        ?>
        <table class="fullwidth">
            <tr>
                <td>Title:</td>
                <td><input type='text' class="fullwidth" name='<?php echo $this->get_field_name( 'widget_title' ); ?>' value='<?php echo $instance['widget_title']; ?>'/></td>
            </tr>
            <tr>
                <td>Nick:</td>
                <td><input type='text' class="fullwidth" name='<?php echo $this->get_field_name( 'twitter_widget_nick' ); ?>' value='<?php echo $instance['twitter_widget_nick']; ?>'/></td>
            </tr>
            <tr>
                <td>Tweets number:</td>
                <td><input type='text' class="fullwidth" name='<?php echo $this->get_field_name( 'twitter_widget_number' ); ?>' value='<?php echo $instance['twitter_widget_number']; ?>'/></td>
            </tr>
        </table>
    <?php
    }
}

function twitter_register_widgets() { register_widget( 'twitter' ); }
add_action( 'widgets_init', 'twitter_register_widgets' );

?>