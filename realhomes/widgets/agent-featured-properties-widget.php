<?php
if( !class_exists('Agent_Featured_Properties_Widget') ){
    class Agent_Featured_Properties_Widget extends WP_Widget {

        function __construct(){
            $widget_ops = array( 'classname' => 'Agent_Featured_Properties_Widget', 'description' => __('Important: This widget is only for the Agent Sidebar.','framework') );
            parent::__construct( 'Agent_Featured_Properties_Widget', __('RealHomes - Agent Featured Properties','framework'), $widget_ops );
        }

        function widget($args, $instance) {

            extract($args);

            $title = apply_filters('widget_title', $instance['title']);

            if ( empty($title) ) $title = false;

            $sort_by = $instance['sort_by'];
            $count = intval( $instance['count']);

            $agent_args = array(
                'post_type' => 'property',
                'posts_per_page' => $count,
                'meta_query' => array(
                    array(
                        'key' => 'REAL_HOMES_featured',     // Show only Featured Properties
                        'value' => 1,
                        'compare' => '=',
                        'type'  => 'NUMERIC'
                    )
                )
            );

            // If author user author id otherwise if agent use agent id
            if ( is_author() ) {
                global $wp_query;
                $current_author = $wp_query->get_queried_object();
                $agent_args['author'] = $current_author->ID;
            } elseif ( is_singular( 'agent' ) ) {
                global $post;
                $agent_args['meta_query'][] = array(
                    'key' => 'REAL_HOMES_agents',
                    'value' => $post->ID,
                    'compare' => '='
                );
            }


            //Order by
            if($sort_by == "random"):
                $agent_args['orderby']= "rand";
            else:
                $agent_args['orderby']= "date";
            endif;

            $agent_query = new WP_Query($agent_args);

            if ( is_author() || is_singular( 'agent' ) ) {  // it only works on author page or agent single page

                echo $before_widget;

                if($title):
                    echo $before_title;
                    echo $title;
                    echo $after_title;
                endif;

                if( $agent_query->have_posts() ):
                    ?>
                    <ul class="featured-properties">
                        <?php
                        while( $agent_query->have_posts() ):
                            $agent_query->the_post();
                            ?>
                            <li>
                                <figure>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                        if( has_post_thumbnail() ) {
                                            the_post_thumbnail( 'grid-view-image' );
                                        } else {
                                            inspiry_image_placeholder( 'grid-view-image' );
                                        }
                                        ?>
                                    </a>
                                </figure>

                                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <p><?php framework_excerpt(7); ?> <a href="<?php the_permalink(); ?>"><?php _e('Read More','framework'); ?></a></p>
                                <?php
                                $price = get_property_price();
                                if ( $price ){
                                    echo '<span class="price">'.$price.'</span>';
                                }
                                ?>
                            </li>
                        <?php
                        endwhile;
                        ?>
                    </ul>
                    <?php
                    wp_reset_query();
                else:
                    ?>
                    <ul class="featured-properties">
                        <?php
                        echo '<li>';
                        _e('No Featured Property Found Under Agent ', 'framework');
                        the_title();
                        echo '.</li>';
                        ?>
                    </ul>
                    <?php
                endif;

                echo $after_widget;
            }
        }


        function form($instance)
        {

            $instance = wp_parse_args( (array) $instance, array( 'title' => 'Featured Properties', 'count' => 1 , 'sort_by' => 'random' ) );

            $title= esc_attr($instance['title']);
            $sort_by = $instance['sort_by'];
            $count =  $instance['count'];

            ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'framework'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('sort_by'); ?>"><?php _e('Sort By:', 'framework') ?></label>
                <select name="<?php echo $this->get_field_name('sort_by'); ?>" id="<?php echo $this->get_field_id('sort_by'); ?>" class="widefat">
                    <option value="recent"<?php selected( $sort_by, 'recent' ); ?>><?php _e('Most Recent', 'framework'); ?></option>
                    <option value="random"<?php selected( $sort_by, 'random' ); ?>><?php _e('Random', 'framework'); ?></option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number of Properties', 'framework'); ?></label>
                <input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" size="3" />
            </p>
        <?php
        }

        function update($new_instance, $old_instance)
        {
            $instance = $old_instance;

            $instance['title'] = strip_tags($new_instance['title']);
            $instance['sort_by'] = $new_instance['sort_by'];
            $instance['count'] = $new_instance['count'];

            return $instance;

        }

    }
}
?>