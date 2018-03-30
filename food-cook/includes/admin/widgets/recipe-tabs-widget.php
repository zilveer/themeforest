<?php
/* * ******* Starting Recipe Sidebar Tabs Widget For Sidebar and Homepage Bottom Area ******** */

class Recipe_Sidebar_Tabed_Widget extends WP_Widget {

    function Recipe_Sidebar_Tabed_Widget() {
        $widget_ops = array('classname' => 'Recipe_Sidebar_Tabed_Widget', 'description' => __('Show Recent or Popular or Random Recipes in Tabs with thumbnail.', 'woothemes'));
         WP_Widget::__construct('recipe_sidebar_widget', __('Food & Cook: Tabs for Recipes', 'woothemes'), $widget_ops);
    }

    /*     * ******* Starting Recipe Sidebar Tabs Widget Function ******** */

    function widget($args, $instance) {
        extract($args);

        // $title = apply_filters('widget_title', $instance['title']);		
        // if ( empty($title) ) 
        // 		$title = false;

        $tab_title_one = $instance['tab_title_one'];
        $tab_title_two = $instance['tab_title_two'];
        $tab_title_three = $instance['tab_title_three'];

        $recipe_tab_one = $instance['recipe_tab_one'];
        $recipe_tab_two = $instance['recipe_tab_two'];
        $recipe_tab_three = $instance['recipe_tab_three'];

        echo $before_widget;

        echo '<div class="tabed"><ul class="tabs">';

        if ($tab_title_one)
            echo '<li class="current">' . $tab_title_one . '</li>';
        if ($tab_title_two)
            echo '<li>' . $tab_title_two . '</li>';
        if ($tab_title_three)
            echo '<li>' . $tab_title_three . '</li>';
        
        echo '</ul><div class="block current"><ul class="highest">';

        $this->recipe_loop($recipe_tab_one);

        echo '</ul></div><!-- end of block div -->';

        if ($tab_title_two) {

            echo '<div class="block"><ul class="highest">';

            $this->recipe_loop($recipe_tab_two);

            echo '</ul></div><!-- end of block div -->';
        }

        if ($tab_title_three) {

            echo '<div class="block"><ul class="highest">';

            $this->recipe_loop($recipe_tab_three);

            echo '</ul></div><!-- end of block div -->';
        }

        echo '<div></div></div><!-- end of tabed div -->';

        // add_filter('pre_get_posts', 'query_post_type');
        echo $after_widget;
    }

    /*     * ******* Recipe Sidebar Tabs Widget Loop ******** */

    function recipe_loop($loop_type = 'popular_posts') {

        $args = array('post_type' => 'recipe');
        $args['posts_per_page'] = 3;

        if ($loop_type == 'popular_posts') {

            $args['orderby'] = 'comment_count';
        }

        if ($loop_type == 'random') {
            $args['orderby'] = 'rand';
        }

        $get_posts_query = new WP_Query($args);

        if ($get_posts_query->have_posts()):
            while ($get_posts_query->have_posts()):
                $get_posts_query->the_post();
                global $post;
                ?>
                <li>
                    <a href="<?php the_permalink(); ?>" class="img-box">
                        <?php get_the_image( array(
                                    'order'         => array( 'featured', 'default' ),
                                    'featured'      => true,
                                    'default'       => esc_url( get_template_directory_uri() . '/includes/assets/images/image.jpg' ),
                                    'size'          => 'sidebar-tabs',
                                    'link_to_post'  => false
                                ) ); ?>
                    </a>
                    <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>							

                    <p class="rate">
                <?php woo_fnc_the_recipe_rating($post->ID); ?>

                    </p>
                </li>			                         						
                <?php
            endwhile;
        endif;
    }

    /*     * ******* Starting Recipe Sidebar Tabs Widget Admin Form ******** */

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array(//'title' => 'MISC Recipes',
            'tab_title_one' => 'Recent',
            'tab_title_two' => 'Popular',
            'tab_title_three' => 'Random',
            'recipe_tab_one' => 'recent_posts',
            'recipe_tab_two' => 'popular_posts',
            'recipe_tab_three' => 'random'));

        // $title= esc_attr($instance['title']);

        $tab_title_one = esc_attr($instance['tab_title_one']);
        $tab_title_two = esc_attr($instance['tab_title_two']);
        $tab_title_three = esc_attr($instance['tab_title_three']);

        $recipe_tab_one = $instance['recipe_tab_one'];
        $recipe_tab_two = $instance['recipe_tab_two'];
        $recipe_tab_three = $instance['recipe_tab_three'];
        ?>
        <!-- <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'woothemes'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p> -->
        <p>
            <label for="<?php echo $this->get_field_id('tab_title_one'); ?>"><?php _e('First Tab Title', 'woothemes'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('tab_title_one'); ?>" name="<?php echo $this->get_field_name('tab_title_one'); ?>" type="text" value="<?php echo $tab_title_one; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tab_title_two'); ?>"><?php _e('Second Tab Title', 'woothemes'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('tab_title_two'); ?>" name="<?php echo $this->get_field_name('tab_title_two'); ?>" type="text" value="<?php echo $tab_title_two; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tab_title_three'); ?>"><?php _e('Third Tab Title', 'woothemes'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('tab_title_three'); ?>" name="<?php echo $this->get_field_name('tab_title_three'); ?>" type="text" value="<?php echo $tab_title_three; ?>" />
        </p>
        <p> 
            <label for="<?php echo $this->get_field_id('recipe_tab_one'); ?>"><?php _e('First Tab Posts View', 'woothemes'); ?></label>
            <select name="<?php echo $this->get_field_name('recipe_tab_one'); ?>" id="<?php echo $this->get_field_id('recipe_tab_one'); ?>">
                <option value="recent_posts"<?php selected($instance['recipe_tab_one'], 'recent_posts'); ?>><?php _e('Recent Posts', 'woothemes'); ?></option>
                <option value="popular_posts"<?php selected($instance['recipe_tab_one'], 'popular_posts'); ?>><?php _e('Most Popular Posts', 'woothemes'); ?></option>
                <option value="random"<?php selected($instance['recipe_tab_one'], 'random'); ?>><?php _e('Random Recipes', 'woothemes'); ?></option>
            </select>
        </p>
        <p> 
            <label <?php echo $this->get_field_id('recipe_tab_two'); ?>><?php _E('Second Tab Posts View', 'woothemes'); ?></label>
            <select name="<?php echo $this->get_field_name('recipe_tab_two'); ?>" id="<?php echo $this->get_field_id('recipe_tab_two'); ?>">
                <option value="recent_posts" <?php selected($instance['recipe_tab_two'], 'recent_posts'); ?>><?php _e('Recent Posts', 'woothemes'); ?></option>
                <option value="popular_posts"<?php selected($instance['recipe_tab_two'], 'popular_posts'); ?>><?php _e('Most Popular Posts', 'woothemes'); ?></option>
                <option value="random"<?php selected($instance['recipe_tab_two'], 'random'); ?>><?php _e('Random Recipes', 'woothemes'); ?></option>
            </select>
        </p>
        <p> 
            <label<?php echo $this->get_field_id('recipe_tab_three'); ?>><?php _e('Third Tab Posts View', 'woothemes'); ?></label>
            <select name="<?php echo $this->get_field_name('recipe_tab_three'); ?>" id="<?php echo $this->get_field_id('recipe_tab_three'); ?>">
                <option value="recent_posts"<?php selected($instance['recipe_tab_three'], 'recent_posts'); ?>><?php _e('Recent Recipes', 'woothemes'); ?></option>
                <option value="popular_posts"<?php selected($instance['recipe_tab_three'], 'popular_posts'); ?>><?php _e('Most Popular Recipes', 'woothemes'); ?></option>
                <option value="random"<?php selected($instance['recipe_tab_three'], 'random'); ?>><?php _e('Random Recipes', 'woothemes'); ?></option>
            </select>
        </p>

        <?php
    }

    /*     * ******* Starting Recipe Sidebar Tabs Widget Update Function ******** */

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        // $instance['title'] = strip_tags($new_instance['title']);
        $instance['tab_title_one'] = strip_tags($new_instance['tab_title_one']);
        $instance['tab_title_two'] = strip_tags($new_instance['tab_title_two']);
        $instance['tab_title_three'] = strip_tags($new_instance['tab_title_three']);
        $instance['recipe_tab_one'] = $new_instance['recipe_tab_one'];
        $instance['recipe_tab_two'] = $new_instance['recipe_tab_two'];
        $instance['recipe_tab_three'] = $new_instance['recipe_tab_three'];

        return $instance;
    }

}

register_widget('Recipe_Sidebar_Tabed_Widget');
