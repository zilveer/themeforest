<?php
class gallery_categories extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array( 
            'classname' => 'gallery-categories', 
            'description' => __('Get list of gallery categories, created on gallery custom type.', 'yiw')
        );

        $control_ops = array( 'id_base' => 'gallery-categories' );

        WP_Widget::__construct( 'gallery-categories', 'Gallery Categories', $widget_ops, $control_ops );
    }
    
    function form( $instance )
    {
        /* Impostazioni di default del widget */
        $defaults = array( 
            'title' => 'Gallery Categories'
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p><label>
            <strong><?php _e( 'Widget Title', 'yiw' ) ?>:</strong><br />
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </label></p>
        <p><?php _e( 'Show a list of gallery categories, for gallery custom types.', 'yiw' ) ?></p>
        <?php
    }
    
    function widget( $args, $instance )
    {                                                
        extract( $args );

        $title = apply_filters('widget_title', $instance['title'] );
        
        echo $before_widget;
        echo $before_title . $title . $after_title;
        
        echo '<ul id="gallery_categories_widget">';
        echo '    <li class="segment-1"><a data-value="all" href="' . get_permalink( yiw_get_pageID_by_pagename( 'gallery' ) ) . '">'.__('All', 'yiw').'</a></li>';
        
            $cat_params = Array(
                'hide_empty'    =>  FALSE,
                'title_li'      =>  ''
            );
            
            $cats = get_terms( 'category-photo', $cat_params );
            
            foreach( $cats as $cat )
            {
                $url = '#';
                if ( ! is_page() )
                    $url = get_term_link( $cat->slug, 'category-photo' );
                if( $cat->count > 0 ) :
                    ?><li class="segment-<?php echo $cat->term_id ?>"><a href="<?php echo $url; ?>" data-value="<?php echo strtolower(preg_replace('/\s+/', '-', $cat->slug)) ?>"><?php echo $cat->name ?></a></li><?php
                else :
                    ?><li><?php echo $cat->name ?></li><?php
                endif;
            }
            
        echo '</ul>';
        echo $after_widget;
    }                     

    function update( $new_instance, $old_instance ) 
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        return $instance;
    }
    
}     
?>