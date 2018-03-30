<?php
add_action( 'widgets_init', 'bd_tabs_widget' );
function bd_tabs_widget(){
    register_widget( 'tabs_widget' );
}

class tabs_widget extends WP_Widget {

    function tabs_widget() {
        $widget_ops = array('classname' => 'bd-tabs-widget', 'description' => 'The most ( Popular - Recent - Comments )');
        $control_ops = array('id_base' => 'bd-tabs-widget');
        $this->WP_Widget('bd-tabs-widget', theme_name .' - Tabs', $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title              = apply_filters('widget_title', $instance['title']);
        $p_number           = $instance['p_number'];
        $l_number           = $instance['l_number'];
        $c_number           = $instance['c_number'];
        $popular_posts_by   = $instance['popular_posts_by'];
        ?>
        <div class="widget widget_tabs" id="<?php echo $args['widget_id']; ?>">
            <div class="widget_container">

                <ul class="tabs_nav">
                    <li class="active">
                        <a href="#tab1">
                            <?php _e('Popular' , 'bd') ?>
                        </a>
                    </li>
                    <li>
                        <a href="#tab2">
                            <?php _e('Recent' , 'bd') ?>
                        </a>
                    </li>
                    <li>
                        <a href="#tab3">
                            <i class="fa fa-comments"></i>
                        </a>
                    </li>
                </ul>

                <div class="tabs_content">

                    <div class="tab_container" id="tab1">
                        <?php
                        if( $popular_posts_by == 'comments' ){

                            bd_popular_posts( $p_number );

                        } elseif( $popular_posts_by == 'views' ) {

                            bd_popular_posts_views( $p_number );

                        }
                        ?>
                    </div>

                    <div class="tab_container" id="tab2">
                        <?php bd_last_posts($l_number); ?>
                    </div>

                    <div class="tab_container" id="tab3">
                        <?php bd_comments($c_number); ?>
                    </div>

                </div>
            </div>
        </div>
    <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance                       = $old_instance;
        $instance['title']              = strip_tags( $new_instance['title'] );
        $instance['p_number']           = strip_tags( $new_instance['p_number'] );
        $instance['l_number']           = strip_tags( $new_instance['l_number'] );
        $instance['c_number']           = strip_tags( $new_instance['c_number'] );
        $instance['popular_posts_by']   = strip_tags( $new_instance['popular_posts_by'] );
        return $instance;
    }

    function form( $instance ) {
        $defaults = array('title' =>__( 'Tabs' , 'bd'), 'p_number' => '5', 'l_number' => '5', 'c_number' => '5', 'popular_posts_by' => 'comments' );
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'p_number' ); ?>"><?php _e('Popular Number of posts to show:' , 'bd'); ?></label>
            <input id="<?php echo $this->get_field_id( 'p_number' ); ?>" name="<?php echo $this->get_field_name( 'p_number' ); ?>" value="<?php echo $instance['p_number']; ?>" size="3" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'popular_posts_by' ); ?>">Popular posts by : </label>
            <select id="<?php echo $this->get_field_id( 'popular_posts_by' ); ?>" name="<?php echo $this->get_field_name( 'popular_posts_by' ); ?>" >
                <option value="views" <?php if( !empty( $instance['popular_posts_by'] ) && $instance['popular_posts_by'] == 'views' ) echo "selected=\"selected\""; else echo ""; ?>>Views</option>
                <option value="comments" <?php if( !empty( $instance['popular_posts_by'] ) && $instance['popular_posts_by'] == 'comments' ) echo "selected=\"selected\""; else echo ""; ?>>Comments Count</option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'l_number' ); ?>"><?php _e('Recent Number of posts to show:' , 'bd'); ?></label>
            <input id="<?php echo $this->get_field_id( 'l_number' ); ?>" name="<?php echo $this->get_field_name( 'l_number' ); ?>" value="<?php echo $instance['l_number']; ?>" size="3" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'c_number' ); ?>"><?php _e('Comments Number of posts to show:' , 'bd'); ?></label>
            <input id="<?php echo $this->get_field_id( 'c_number' ); ?>" name="<?php echo $this->get_field_name( 'c_number' ); ?>" value="<?php echo $instance['c_number']; ?>" size="3" />
        </p>

    <?php
    }
}
?>