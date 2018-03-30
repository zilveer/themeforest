<?php
if( !class_exists('Agent_Properties_Widget') ){
    class Agent_Properties_Widget extends WP_Widget {

        function __construct(){
            $widget_ops = array( 'classname' => 'Agent_Properties_Widget', 'description' => __('Displays random, recent or featured properties based on selected agent.','framework') );
            parent::__construct( 'Agent_Properties_Widget', __('RealHomes - Agent Related Properties','framework'), $widget_ops );
        }

        function widget($args, $instance) {

            extract($args);

            $title = apply_filters('widget_title', $instance['title']);

            if ( empty($title) ) $title = false;

            $agent = $instance['agent'];
            $sort_by = $instance['sort_by'];
            $count = intval( $instance['count']);
            $featured = isset( $instance['featured'] ) ? (bool) $instance['featured'] : false;

            $agent_args = array(
                'post_type' => 'property',
                'posts_per_page' => $count,
                'meta_query' => array(
                    array(
                        'key' => 'REAL_HOMES_agents',
                        'value' => $agent,
                        'compare' => '='
                    )
                )
            );

            // If show only Featured Properties
            if($featured){
                $agent_args['meta_query'][] = array(
                        'key' => 'REAL_HOMES_featured',
                        'value' => 1,
                        'compare' => '=',
                        'type'  => 'NUMERIC'

                );
            }

            //Order by
            if($sort_by == "random"):
                $agent_args['orderby']= "rand";
            else:
                $agent_args['orderby']= "date";
            endif;

            $agent_query = new WP_Query($agent_args);

            echo $before_widget;

            if($title):
                echo $before_title;
                echo $title;
                echo $after_title;
            endif;

            if($agent_query->have_posts()):
                ?>
                <ul class="featured-properties">
                    <?php
                    while($agent_query->have_posts()):
                        $agent_query->the_post();
                        ?>
                        <li>

                            <figure>
                                <a href="<?php the_permalink(); ?>">
                                    <?php
                                    if( has_post_thumbnail() ){
                                        the_post_thumbnail('grid-view-image');
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
                    _e('No Property Found Under Selected Agent!', 'framework');
                    echo '</li>';
                    ?>
                </ul>
            <?php
            endif;

            echo $after_widget;
        }


        function form( $instance )
        {

            $instance = wp_parse_args( (array) $instance, array( 'title' => 'Agent Related Properties', 'count' => 1 , 'sort_by' => 'random' ) );

            $title= esc_attr($instance['title']);
            $agent = null;
            if( isset( $instance['agent'] ) ){
                $agent = $instance['agent'];
            }
            $sort_by = $instance['sort_by'];
            $count =  $instance['count'];
            $featured = isset( $instance['featured'] ) ? (bool) $instance['featured'] : false;

            ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'framework'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('agent'); ?>"><?php _e('Select an Agent:', 'framework') ?></label>
                <select name="<?php echo $this->get_field_name('agent'); ?>" id="<?php echo $this->get_field_id('agent'); ?>" class="widefat">
                    <?php generate_posts_list('agent', $agent); ?>
                </select>
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
            <p>
                <input class="checkbox" id="<?php echo $this->get_field_id('featured'); ?>" name="<?php echo $this->get_field_name('featured'); ?>" type="checkbox" <?php checked( $featured ); ?>/>
                <label for="<?php echo $this->get_field_id('featured'); ?>"><?php _e('Show only Featured Properties.', 'framework'); ?></label>
            </p>
        <?php
        }

        function update($new_instance, $old_instance)
        {
            $instance = $old_instance;

            $instance['title'] = strip_tags($new_instance['title']);
            $instance['agent'] = $new_instance['agent'];
            $instance['sort_by'] = $new_instance['sort_by'];
            $instance['count'] = $new_instance['count'];
            $instance['featured'] = isset( $new_instance['featured'] ) ? (bool) $new_instance['featured'] : false;

            return $instance;

        }

    }
}
?>