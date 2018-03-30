<?php

class portfolio_categories extends WP_Widget

{

    function __construct()

    {

        $widget_ops = array( 

            'classname' => 'portfolio-categories', 

            'description' => __('Get list of portfolio categories, created on portfolio custom type.', 'yiw') 

        );



        $control_ops = array( 'id_base' => 'portfolio-categories' );



        WP_Widget::__construct( 'portfolio-categories', 'Portfolio Categories', $widget_ops, $control_ops );

    }

    

    function form( $instance )

    {

        /* Impostazioni di default del widget */

        $defaults = array( 

            'title' => 'Portfolio Categories'

        );

        

        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        

        <p><label>

            <strong><?php _e( 'Widget Title', 'yiw' ) ?>:</strong><br />

            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />

        </label></p>                     

        

        <p>

            <label for="<?php echo $this->get_field_id( 'project_post_type' ); ?>">Portfolio:

                 <select id="<?php echo $this->get_field_id( 'project_post_type' ); ?>" name="<?php echo $this->get_field_name( 'project_post_type' ); ?>">

                    <?php 
                    
                    $portfolios = yiw_portfolios();

                    foreach( $portfolios as $post_type => $the_ )

                    {

                        $select = '';

                        if($instance['project_post_type'] == $post_type) $select = ' selected="selected"';

                        echo "<option value=\"$post_type\"$select>$the_[title]</option>\n";

                    }

                    ?>

                 </select>

            </label>

        </p>       

        <p><?php _e( 'Show a list of portfolio categories, for portfolio custom types.', 'yiw' ) ?></p>

        <?php

    }

    

    function widget( $args, $instance )

    {                                                

        extract( $args );



        $title = apply_filters('widget_title', $instance['title'] );     

        $project_post_types = isset( $instance['project_post_type']) ? $instance['project_post_type'] : 'portfolio';

        

        echo $before_widget;

        echo $before_title . $title . $after_title;    
        
        
        $portfolios = yiw_portfolios();

        

        echo '<ul id="gallery_categories_widget">';

        //echo '    <li class="segment-1"><a data-value="all" href="' . get_permalink( yiw_get_pageID_by_pagename( 'portfolio' ) ) . '">'.__('All', 'yiw').'</a></li>';
        
        if ( ! is_tax() && ! is_single() )    
            echo '    <li class="segment-1"><a data-value="all" href="#">'.__('All', 'yiw').'</a></li>';

        

            $cat_params = Array(

                'hide_empty'    =>  FALSE,

                'title_li'      =>  ''

            );

            

            $cats = get_terms( sanitize_title( $portfolios[$project_post_types]['tax'] ), $cat_params );


            foreach( $cats as $cat )

            {
            
                if ( ! is_object( $cat ) && empty( $cat ) ) continue;
            
                if( isset( $cat->count ) && $cat->count > 0 ) :
                
                    $url = ( is_tax() || is_single() ) ? get_term_link( $cat, $portfolios[$project_post_types]['tax'] ) : '#';
                                       
                    ?><li class="segment-<?php echo $cat->term_id ?>"><a href="<?php echo $url ?>" data-value="<?php echo $cat->slug ?>"><?php echo $cat->name ?></a></li><?php

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
         
        $instance['project_post_type'] = $new_instance['project_post_type'];



        return $instance;

    }

    

}     

?>