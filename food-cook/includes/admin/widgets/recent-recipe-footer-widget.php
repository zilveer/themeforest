<?php
/* * ******* Starting Recent Recipe Widget For Footer ******** */

class Recent_Recipe_Footer_Widget extends WP_Widget {

    function Recent_Recipe_Footer_Widget() {
        $widget_ops = array('classname' => 'Recent_Recipe_Footer_Widget', 'description' => __('This widget show recent recipes from all recipes. It is footer specific widget.', 'woothemes'));
         WP_Widget::__construct('recent_recipe_footer_widget', __('Food & Cook: Recent Recipes for Footer', 'woothemes'), $widget_ops);
    }

    /*     * ******* Starting Recent Recipe Widget Function ******** */

    function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);
        if (empty($title)) :
            $title = false;
        endif;

        $rrf_post_count = $instance['post_per_page'];

        if ($title):
            $temp_title = explode(' ', $title);
            $first_letter = $temp_title[0];
            unset($temp_title[0]);
            $title_new = implode(' ', $temp_title);
            $title = $first_letter . '  ' . $title_new . ' ';

        endif;
        //echo $before_widget;

        echo '<h3>' . $title . '</h3><ul class="recent-posts">';

        $args = array('post_type' => 'recipe', 'posts_per_page' => $rrf_post_count);

        $rrf_posts_query = new WP_Query($args);

        if ($rrf_posts_query->have_posts()):
            while ($rrf_posts_query->have_posts()):
                $rrf_posts_query->the_post();
                global $post;
                ?>
                <li>
                    <a href="<?php the_permalink(); ?>#" class="img-box">
                        <?php
                        get_the_image(array(
                            'order' => array('featured', 'default'),
                            'featured' => true,
                            'default' => esc_url(get_template_directory_uri() . '/includes/assets/images/image.jpg'),
                            'size' => 'recent-thumb',
                            'link_to_post' => false,
                        ));
                        ?>
                    </a>
                    <h5><a href="<?php the_permalink(); ?>#"><?php echo woo_fnc_word_trim(get_the_title(), 4, '...'); ?></a></h5>
                    <div class="rating">
                <?php woo_fnc_the_recipe_rating($post->ID); ?>
                    </div>
                </li>			                         						
                <?php
            endwhile;
        endif;
        // add_filter('pre_get_posts', 'query_post_type');
        echo '</ul>';

        //echo $after_widget;
    }

    /*     * ******* Starting Recent Recipe Widget Admin From ******** */

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('title' => 'Recent Recipes', 'post_per_page' => 2, 'excerpt_length' => 10));

        $title = esc_attr($instance['title']);
        $rrf_post_count = $instance['post_per_page'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'woothemes'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('post_per_page'); ?>"><?php _e('Number of Posts', 'woothemes'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('post_per_page'); ?>" name="<?php echo $this->get_field_name('post_per_page'); ?>" type="text" value="<?php echo $rrf_post_count; ?>" />
        </p>

        <?php
    }

    /*     * ******* Starting Recent Recipe Widget Update Function ******** */

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['post_per_page'] = intval($new_instance['post_per_page']);

        return $instance;
    }

}

register_widget('Recent_Recipe_Footer_Widget');
