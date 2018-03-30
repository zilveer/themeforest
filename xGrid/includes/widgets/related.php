<?php
add_action( 'widgets_init', 'bd_related' );
function bd_related() {
    register_widget( 'bd_related' );
}
class bd_related extends WP_Widget {
function bd_related() {
    $widget_ops = array('classname' => 'bd-related', 'description' => '');
    $control_ops = array('id_base' => 'bd-related');
    $this->WP_Widget('bd-related', theme_name . ' - Related Posts', $widget_ops, $control_ops);
}
function widget( $args, $instance ) {
    extract( $args );
    if ( is_single() ) :
    $title = apply_filters('widget_title', $instance['title'] );
    $number = $instance['number'];

    echo $before_widget;
    if($title) {
        echo $before_title.$title.$after_title;
    }
?>
<?php
    global $post;
    $cats = get_the_category($post->ID);
    if ($cats) :
        $cat_ids = array();
        foreach($cats as $individual_cat){ $cat_ids[] = $individual_cat->cat_ID;}
        $args=array(
            'category__in' => $cat_ids,
            'post__not_in' => array($post->ID),
            'showposts'=> $number,
            'ignore_sticky_posts'=>1
        );

        query_posts($args);
        echo '<div class="widget-posts-lists">';
    ?>
        <?php while ( have_posts() ) : the_post(); ?>
        <?php if ( has_post_thumbnail() ) { $has_class =  ''; } else { $has_class =  ' no-thumb'; } ?>
        <div class="post-warpper<?php echo $has_class ?>">
            <?php bd_wp_thumb('55','55',''); ?>
            <div class="post-caption">
                <h3 class="post-title">
                    <a href="<?php the_permalink() ?>" title="<?php printf(__( '%s', 'bd' ), the_title_attribute( 'echo=0' )); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h3><!-- .post-title/-->
                <div class="post-meta">
                    <span class="meta-date"><?php the_time('F j, Y'); ?></span> <?php echo bd_wp_post_rate() ?>
                </div><!-- .post-meta/-->
            </div><!-- .post-caption/-->
            <div class="clear"></div>
        </div>
        <?php endwhile; endif; ?>
    <?php
        echo '</div>';
    wp_reset_query();
?>
<?php
    echo $after_widget;
    endif;
}
function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['number'] = strip_tags( $new_instance['number'] );
    return $instance;
}
function form( $instance ) {
    $defaults = array( 'title' =>__( 'Related Posts' , 'bd'), 'number' => '5');
    $instance = wp_parse_args( (array) $instance, $defaults );
    ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:' , 'bd'); ?></label>
        <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width: 216px" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Number of posts to show:' , 'bd'); ?></label>
        <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" size="3" />
    </p>

<?php
}

}
