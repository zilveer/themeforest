<?php
class almost_all_categories extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array( 
            'classname' => 'almost-all-categories', 
            'description' => __('Get list of categories, without categories excluded from options panel.', 'yiw') 
        );

        $control_ops = array( 'id_base' => 'almost-all-categories' );

        WP_Widget::__construct( 'almost-all-categories', 'Almost Categories', $widget_ops, $control_ops );
    }
    
    function form( $instance )
    {
        /* Impostazioni di default del widget */
        $defaults = array( 
            'title' => 'Categories',
            'show_count' => 1
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p><label>
            <strong><?php _e( 'Widget Title', 'yiw' ) ?>:</strong><br />
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </label></p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'show_count' ); ?>"><?php _e( 'Toggles the display of the current count of posts in each category', 'yiw' ) ?>:
                 <select id="<?php echo $this->get_field_id( 'show_count' ); ?>" name="<?php echo $this->get_field_name( 'show_count' ); ?>">
                    <option value="1" <?php selected( $instance['show_count'], '1' ) ?>><?php _e( 'Yes', 'yiw' ) ?></option>
                    <option value="0" <?php selected( $instance['show_count'], '0' ) ?>><?php _e( 'No', 'yiw' ) ?></option>
                 </select>
            </label>
        </p> 
        
        <p><?php _e( 'Configure this widget on the Theme Option Admin, to exclude the categories from this list.', 'yiw' ) ?></p>
        <?php
    }
    
    function widget( $args, $instance )
    {
        extract( $args );   
        
        /* Impostazioni di default del widget */
        $defaults = array( 
            'title' => 'Categories',
            'show_count' => 1
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults ); 

        $title = apply_filters('widget_title', $instance['title'] );
        
        echo $before_widget;
        echo $before_title . $title . $after_title;
        
        echo '<ul id="almost_all_categories_widget">';
            $cat_params = Array(
                    'hide_empty'    =>  FALSE,
                    'title_li'      =>  '',
                    'show_count'    =>  $instance['show_count']
                );                                                  
            $exclude = maybe_unserialize( yiw_get_option( 'blog_cats_exclude_2' ) );
            if( ! empty( $exclude ) ){
                $cat_params['exclude'] = trim( yiw_get_option( 'blog_cats_exclude_2' ) );
            }
            wp_list_categories( $cat_params );
        echo '</ul>';
        echo $after_widget;
    }                     

    function update( $new_instance, $old_instance ) 
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['show_count'] = $new_instance['show_count'];

        return $instance;
    }
    
}     
?>
