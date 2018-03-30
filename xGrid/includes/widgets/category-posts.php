<?php
add_action( 'widgets_init', 'bd_cate_posts' );
function bd_cate_posts() {
    register_widget( 'bd_cate_posts' );
}
class bd_cate_posts extends WP_Widget {
function bd_cate_posts() {
    $widget_ops = array('classname' => 'bd-cate-posts', 'description' => '');
    $control_ops = array('id_base' => 'bd-cate-posts');
    $this->WP_Widget('bd-cate-posts', theme_name . ' - Category Posts', $widget_ops, $control_ops);
}
function widget( $args, $instance ) {
    extract( $args );
    $title = apply_filters('widget_title', $instance['title'] );
    $number = $instance['number'];
    $cats_id = $instance['cats_id'];
    echo $before_widget;
    if($title) {
        echo $before_title.$title.$after_title;
    }
    bd_last_posts_cats($number, $cats_id);
    echo $after_widget;
}
function update( $new_instance, $old_instance )
{
    $instance = $old_instance;
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['number'] = strip_tags( $new_instance['number'] );
    $instance['cats_id'] = implode(',' , $new_instance['cats_id']  );
    return $instance;
}
function form( $instance ) {
    $defaults = array( 'title' =>__( 'Category Posts' , 'bd'), 'number' => '5' , 'cats_id' => '1');
    $instance = wp_parse_args( (array) $instance, $defaults );
    $categories_obj = get_categories();
    $categories = array();
    foreach ($categories_obj as $pn_cat) {
        $categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
    }
    ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:' , 'bd'); ?></label>
        <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width: 216px" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Number of posts to show:' , 'bd'); ?></label>
        <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" size="3" />
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