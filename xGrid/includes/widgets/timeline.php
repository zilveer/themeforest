<?php
/**
 * Time Line widget
 * ----------------------------------------------------------------------------- *
 */

function bd_timeline_widget() {
    register_widget( 'timeline_widget' );
}
add_action( 'widgets_init', 'bd_timeline_widget' );

class timeline_widget extends WP_Widget {

    function timeline_widget() {
        $widget_ops = array( 'classname' => 'timeline-widget' );
        $control_ops = array( 'id_base' => 'timeline-widget' );
        $this->WP_Widget( 'timeline-widget',theme_name .' - Timeline', $widget_ops, $control_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters('widget_title', $instance['text_html_title'] );
        $no_of_posts = $instance['no_of_posts'];
        $cats_id = $instance['cats_id'];

        echo $before_widget;
        echo $before_title;
        echo $title ;
        echo $after_title;

        ?>
        <ul class="timeline-wrap">
            <?php bd_timeline($no_of_posts , $cats_id); ?>
        </ul>
        <!-- .timeline-wrap -->
        <?php

        echo $after_widget;
    }

    function update( $new_instance, $old_instance ){
        $instance = $old_instance;
        $instance['text_html_title'] = strip_tags( $new_instance['text_html_title'] );
        $instance['no_of_posts'] = strip_tags( $new_instance['no_of_posts'] );
        $instance['cats_id'] = implode(',' , $new_instance['cats_id']  );
        return $instance;
    }

    function form( $instance ) {
        $defaults = array( 'text_html_title' =>__( 'Timeline' , LANG ), 'no_of_posts' => '5' , 'cats_id' => '1'  );
        $instance = wp_parse_args( (array) $instance, $defaults );

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'text_html_title' ); ?>">Title : </label>
            <input id="<?php echo $this->get_field_id( 'text_html_title' ); ?>" name="<?php echo $this->get_field_name( 'text_html_title' ); ?>" value="<?php echo $instance['text_html_title']; ?>" class="widefat" type="text" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>"><?php _e( 'Number of posts to show:' , LANG ) ?></label>
            <input id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php echo $instance['no_of_posts']; ?>" type="text" size="3" />
        </p>
        <p>
            <?php
            ## GET Category
            $categories_obj = get_categories();
            $categories = array();
            foreach ($categories_obj as $pn_cat) {
                $categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
            }
            $cats_id = explode ( ',' , $instance['cats_id'] ) ;
            ?>

            <label for="<?php echo $this->get_field_id( 'cats_id' ); ?>"><?php _e( 'Category :' , LANG ) ?></label>
            <select multiple="multiple" id="<?php echo $this->get_field_id( 'cats_id' ); ?>[]" name="<?php echo $this->get_field_name( 'cats_id' ); ?>[]">
                <?php foreach ($categories as $key => $option) { ?>
                    <option value="<?php echo $key ?>" <?php if ( in_array( $key , $cats_id ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
                <?php } ?>
            </select>
        </p>
    <?php
    }
}
?>