<?php
add_action( 'widgets_init', 'bd_search_widget' );
function bd_search_widget() {
    register_widget( 'bd_search_widget' );
}
class bd_search_widget extends WP_Widget {
function bd_search_widget() {
    $widget_ops = array('classname' => 'bd-search-widget', 'description' => '');
    $control_ops = array('id_base' => 'bd-search-widget');
    $this->WP_Widget('bd-search-widget', theme_name . ' - Search', $widget_ops, $control_ops);
}
function widget( $args, $instance ) {
    extract( $args );
    $title = apply_filters('widget_title', $instance['title'] );
    echo $before_widget;
    if($title) {
        echo $before_title.$title.$after_title;
    }
    ?>
    <div class="post-warpper">
        <form method="get" action="<?php echo home_url();?>">
            <input class="search-text" type="text" id="s" name="s" placeholder="Search"  /><button value="Search" name="Submit" type="submit" class="btn"><?php _e('Search','bd')?></button>
            <?php $select = wp_dropdown_categories('show_option_all='.__('All Content','bd').'&orderby=name&hierarchical=0&selected=-1&depth=1&show_count=1'); ?>
        </form>
    </div>
    <?php
    echo $after_widget;
}
function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags( $new_instance['title'] );
    return $instance;
}
function form( $instance ) {
    $defaults = array( 'title' =>__( 'Search' , 'bd'));
    $instance = wp_parse_args( (array) $instance, $defaults );
    ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title','bd')?> : </label>
        <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
    </p>
<?php
}

}
