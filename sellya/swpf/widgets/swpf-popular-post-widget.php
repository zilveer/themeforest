<?php

class SWPF_Popular_Post_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'SWPF_Popular_Post_Widget', // Base ID  
                'Popular Post', // Name  
                array(
            'description' => __('Show Popular Post','sellya')
                )
        );
    }

    public function form($instance) {
        $defaults = array(
            'title' => 'Popular Post',
            'count' => '',
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'sellya') ?></label><BR/>
            <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>"style="width:216px;" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Show', 'sellya') ?></label>
            <input type="text" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $instance['count']; ?>" style="width:100%; height:30px" />
        </p>

        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['count'] = strip_tags($new_instance['count']);
        return $instance;
    }

    public function widget($args, $instance) {
        $title = apply_filters('title', $instance['title']);
        $show = $instance['count'];
        extract($args, EXTR_SKIP);
        echo $before_widget;
         echo '<div class="widgets">';
        $title = empty($instance['title']) ? ' ' : apply_filters('title', $instance['title']);
        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        };
        ?>
        <ul class="popular-post">
        <?php
        global $wpdb;
        $query = new WP_Query('posts_per_page='.$show.'&ignore_sticky_posts=1&orderby=comment_count');
        while ($query->have_posts()) : $query->the_post();
            ?>	
                <li>
                    <div class="popular-post-container">
                        <?php the_post_thumbnail(array(43,43), array('class' => 'left')); ?>
						<div class="tab_right">
                            <span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span><br>
                            <span><i class="icon-calendar"></i>&nbsp;<?php the_time(get_option( 'date_format' )); ?></span>
                        </div>
                    </div>
                </li>

        <?php endwhile;
        ?>
        </ul>  
        </div>
        <?php
        echo $after_widget;
    }

}

add_action('widgets_init', create_function('', 'register_widget( "SWPF_Popular_Post_Widget" );'));
?>