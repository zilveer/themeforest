<?php

class footer_recent_posts extends WP_Widget 
{
    function __construct()
    {
        $widget_ops = array( 
            'classname' => 'recent-posts', 
            'description' => __('The latest posts, with a preview thumb. (Use it only in the footer!)', 'yiw') 
        );

        $control_ops = array( 'id_base' => 'footer-recent-posts' );

        WP_Widget::__construct( 'footer-recent-posts', 'Footer Recent Posts', $widget_ops, $control_ops );
    }
    
    function widget( $args, $instance ) 
    {
        extract( $args );

        /* User-selected settings. */
        $title = apply_filters('widget_title', empty( $instance['title'] ) ? 'Recent posts' : $instance['title'] );

        $items = isset( $instance['items'] ) ? $instance['items'] : '';
        $limit = isset( $instance['limit'] ) ? $instance['limit'] : 20;        

        echo $before_widget;
        
        if ( $title ) echo $before_title . $title . $after_title;
        
        $args = array(
           'posts_per_page' => $items,
           'orderby' => 'date',
           'ignore_sticky_posts' => 1
        );
        
        $args['order'] = 'DESC'; 
        
        $myposts = new WP_Query( $args );    
                        
        $html = "\n";       
        
        if( $myposts->have_posts() ) : ?>
            <div class="recent-post">
            <?php
            while( $myposts->have_posts() ) : $myposts->the_post();
            
                ob_start(); ?>
                <div <?php post_class() ?>>
                    <div class="text">
                        <h3><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h3>
                        <p><?php echo yit_content( 'excerpt', $limit ) ?></p>
                    </div>
                </div>
                <?php
                echo ob_get_clean();        
            
            endwhile;
            ?></div><?php
        endif;
        
        wp_reset_query();
        
        echo $html;
        
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) 
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );    

        $instance['items'] = $new_instance['items'];           
        
        $instance['limit'] = intval( $new_instance['limit'] );

        return $instance;
    }

    function form( $instance ) 
    {
        global $icons_name, $yiw_fxs, $yiw_easings;
        
        
        /* Impostazioni di default del widget */
        $defaults = array( 
            'title' => 'Recent Posts', 
            'items' => 3,
            'limit' => 20
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'yiw' ) ?>:
                 <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'items' ); ?>"><?php _e( 'Items', 'yiw' ) ?>:
                 <input type="text" id="<?php echo $this->get_field_id( 'items' ); ?>" name="<?php echo $this->get_field_name( 'items' ); ?>" value="<?php echo $instance['items']; ?>" size="3" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Excerpt', 'yiw' ) ?>:
                 <input type="text" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" value="<?php echo $instance['limit']; ?>" size="3" />
            </label>
        </p>
    
    <?php
    }
}

?>
