<?php
add_action( 'widgets_init', 'bd_news_in_pic' );
function bd_news_in_pic() {
    register_widget( 'bd_news_in_pic' );
}
class bd_news_in_pic extends WP_Widget {
function bd_news_in_pic() {
    $widget_ops = array('classname' => 'bd-news-in-pic', 'description' => '');
    $control_ops = array('id_base' => 'bd-news-in-pic');
    $this->WP_Widget('bd-news-in-pic', theme_name . ' - News In Pic', $widget_ops, $control_ops);
}
function widget( $args, $instance ) {
    extract( $args );
    $title = apply_filters('widget_title', $instance['cat_posts_title'] );
    $no_of_posts = $instance['no_of_posts'];
    $cats_id = $instance['cats_id'];
    $order = $instance['order'];
    echo $before_widget;
    if($title) {
        echo $before_title.$title.$after_title;
    }
    bd_last_news_pic( $order, $no_of_posts , $cats_id );
    echo $after_widget;
}
function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['cat_posts_title'] = strip_tags( $new_instance['cat_posts_title'] );
    $instance['no_of_posts'] = strip_tags( $new_instance['no_of_posts'] );
    $instance['cats_id'] = implode(',' , $new_instance['cats_id']  );
    $instance['order'] = strip_tags( $new_instance['order'] );
    return $instance;
}
function form( $instance ) {
    $defaults = array( 'cat_posts_title' =>__('News in Pictures' , 'bd'), 'order' => 'latest', 'no_of_posts' => '8' , 'cats_id' => '1' );
    $instance = wp_parse_args( (array) $instance, $defaults );
    $categories_obj = get_categories();
    $categories = array();
    foreach ($categories_obj as $pn_cat) {
        $categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
    }
    ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'cat_posts_title' ); ?>"><?php _e('Title','bd') ?> : </label>
        <input id="<?php echo $this->get_field_id( 'cat_posts_title' ); ?>" name="<?php echo $this->get_field_name( 'cat_posts_title' ); ?>" value="<?php echo $instance['cat_posts_title']; ?>" class="widefat" type="text" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>"><?php _e('Number of posts to show','bd') ?>: </label>
        <input id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php echo $instance['no_of_posts']; ?>" type="text" size="3" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e('Posts order','bd') ?>: </label>
        <select id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>" >
            <option value="latest" <?php if( $instance['order'] == 'latest' ) echo "selected=\"selected\""; else echo ""; ?>><?php _e('Most recent','bd') ?></option>
            <option value="random" <?php if( $instance['order'] == 'random' ) echo "selected=\"selected\""; else echo ""; ?>><?php _e('Random','bd') ?></option>
        </select>
    </p>
    <p>
        <?php $cats_id = explode ( ',' , $instance['cats_id'] ) ; ?>
        <label for="<?php echo $this->get_field_id( 'cats_id' ); ?>">Category : </label>
        <select multiple="multiple" id="<?php echo $this->get_field_id( 'cats_id' ); ?>[]" name="<?php echo $this->get_field_name( 'cats_id' ); ?>[]">
            <?php foreach ($categories as $key => $option) { ?>
                <option value="<?php echo $key ?>" <?php if ( in_array( $key , $cats_id ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
            <?php } ?>
        </select>
    </p>
<?php
}

}
