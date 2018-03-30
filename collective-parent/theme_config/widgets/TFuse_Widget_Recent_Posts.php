<?php
// =============================== Recent Posts Widget ======================================

class TFuse_Recent_Posts extends WP_Widget {

    function TFuse_Recent_Posts() {
        $widget_ops = array('description' => '' );
        parent::WP_Widget(false, __('TFuse - Recent Posts', 'tfuse'),$widget_ops);
    }

    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts','tfuse') : $instance['title'], $instance, $this->id_base);
        $title = tfuse_qtranslate($title);
        $number = esc_attr($instance['number']);
        if ($number>0) {} else $number = 5;
    ?>

    <div class="widget-container widget_recent_posts">
        <?php if($title != ''){ ?>
            <div class="widget_title clearfix"><h3 class="clearfix"><?php echo $title; ?></h3></div>
        <?php } ?>
        <ul class="post_list recent_posts">
            <?php
            $pop_posts =  tfuse_shortcode_posts(array(
                                'sort' => 'recent',
                                'items' => $number,
                                'image_post' => true,
                                'image_width' => 54,
                                'image_height' => 54,
                                'image_class' => 'thumbnail',
                                'date_post' => true,
                                'date_format' => 'F j, Y'
                            ));
            foreach($pop_posts as $post_val): ?>
                <li class="clearfix">
                    <a href="<?php echo $post_val['post_link']; ?>">
                        <?php if($post_val['post_img']!='') echo $post_val['post_img'];
                    else echo '<img src="'.get_template_directory_uri().'/images/recent_post_img.jpg'.'" width="54" height="54">';
                        echo $post_val['post_title']; ?>
                    </a>
                    <div class="date">
                        <?php if(tfuse_options('date_time')): ?>
                            <span class="post-date"><?php echo $post_val['post_date_post']; ?></span>
                        <?php endif;?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <?php
    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function form($instance) {
        $instance = wp_parse_args( (array) $instance, array(  'title' => '', 'number' => '') );
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number = esc_attr($instance['number']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts','tfuse'); ?>:</label>
            <input type="text" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $number; ?>" class="widefat" id="<?php echo $this->get_field_id('number'); ?>" />
        </p>

    <?php
    }
}
function TFuse_Unregister_WP_Widget_Recent_Posts() {
    unregister_widget('WP_Widget_Recent_Posts');
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Recent_Posts');

register_widget('TFuse_Recent_Posts');