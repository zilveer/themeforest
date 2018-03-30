<?php

class more_projects extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array(
            'classname' => 'more_projects', 
            'description' => __('Show a slider with a list of projects, added into portfolio Post Type.', 'yiw') 
        );

        $control_ops = array( 'id_base' => 'more_projects' );
        WP_Widget::__construct( 'more_projects', 'More Project', $widget_ops, $control_ops );
    }

    function widget( $args, $instance ) 
    {
        $yiw_portfolio = yiw_portfolios();
        
        extract( $args );              
        
        global $post;
        $post_id = isset( $post->ID ) ? $post->ID : 0;               

        $project_speed_fx = isset( $instance['project_speed_fx']) ? $instance['project_speed_fx'] : false;
        $project_n_items = isset( $instance['project_n_items']) ? $instance['project_n_items'] : 5;   
        $project_post_types = isset( $instance['project_post_type']) ? $instance['project_post_type'] : false;

        /* User-selected settings. */
        $title = apply_filters('widget_title', $instance['title'] );
        
        if ( ! $project_post_types || empty( $project_post_types ) )
            $post_type = get_post_meta( $post_id, '_portfolio_post_type', true );  
        else
            $post_type = $project_post_types;
            
        if ( empty( $post_type ) )
            $post_type = get_post_type();    
        
        $portfolio_tax = sanitize_title( $yiw_portfolio[$post_type]['tax'] );

        global $more;
        $more = 0;

        $project_posts = new WP_Query("post_type=$post_type&posts_per_page=-1");

        if( $project_posts->have_posts() )
        {
            echo $before_widget;

            if ( $title ) echo $before_title . $title . $after_title;

            echo '<div class="more-projects-widget">';
                echo '<div class="top">';
                    echo '<a class="prev" href="#">Prev</a>';
                echo '</div>';
                echo '<div class="sliderWrap">';
                    echo '<ul>';

                    while( $project_posts->have_posts() )
                    {
                        $project_posts->the_post();

                        echo '<li class="work-item group">';
                            echo '<a class="work-thumb" href="' . get_permalink() . '">';
                                the_post_thumbnail( 'thumb_more_projects' );    
                            echo '</a>';
                            the_title( '<a class="meta work-title" href="' . get_permalink() . '">', '</a>' );

                            //the_terms( get_the_ID(), 'category-project', '<p class="meta categories">', ', ', '</p>' );
                            $terms = "";
                            echo '<p class="meta categories">';           
                            
                            if( ! empty( $portfolio_tax ) && get_the_terms(get_the_ID(), $portfolio_tax) ){
                                foreach( get_the_terms(get_the_ID(), $portfolio_tax) as $term ) {
                                    $terms .= '<a href="' . get_term_link( $term, $portfolio_tax ) . '">'.$term->name ."</a>, ";
                                }
                            }

                            echo substr($terms,0, strlen($terms)-2);
                            echo '</p>';
                        echo '</li>';
                    }
                    echo '</ul>';    
                echo '</div>';
                echo '<div class="controls">';
                    echo '<a class="next" href="#">Next</a>';
                echo '</div>';
            echo '</div>';

            $script = "<script type=\"text/javascript\">
                jQuery(document).ready(function($){
                    var slider_wrap = $('.more-projects-widget');
                    var height_item = $('li', slider_wrap).outerHeight();
                    var height_ul   = $('ul', slider_wrap).height();
                    var height_wrap = $('.sliderWrap', slider_wrap).height();
                    var n_items     = $('li', slider_wrap).length;
                    var visible     = $project_n_items;

                    $('.controls, .top', slider_wrap).show();

                    // adjust height, according to visible item
                    $('.sliderWrap', slider_wrap).css('height', height_item * visible - 6);

                    function check_position() {    
                        var margin_top_ul = $('ul', slider_wrap).css('margin-top');
                        var max_offset  = ( n_items - visible ) * height_item * -1;

                        if ( margin_top_ul == '0px' ) {
                            $('.prev', slider_wrap).addClass('disabled');
                        }

                        if ( margin_top_ul == max_offset+'px' ) {
                            $('.next', slider_wrap).addClass('disabled');
                        }
                    }

                    check_position();

                    $('.next:not(.disabled)', slider_wrap).live('click',function(){
                        $('ul', slider_wrap).animate( {marginTop:'-='+height_item}, $project_speed_fx, function(){ check_position(); } );
                        $('.prev', slider_wrap).removeClass('disabled');
                        return false;
                    });

                    $('.prev:not(.disabled)', slider_wrap).live('click',function(){
                        $('ul', slider_wrap).animate( {marginTop:'+='+height_item}, $project_speed_fx, function(){ check_position(); } );
                        $('.next', slider_wrap).removeClass('disabled');
                        return false;
                    });

                    $('.disabled', slider_wrap).live('click', function(){
                        return false;
                    });
                });
            </script>";

            echo $script;
            echo $after_widget;
        }
    }

    function update( $new_instance, $old_instance ) 
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['project_n_items'] = $new_instance['project_n_items'];
        $instance['project_speed_fx'] = $new_instance['project_speed_fx'];
        $instance['project_post_type'] = $new_instance['project_post_type'];
        return $instance;
    }

    function form( $instance ) 
    {
        global $icons_name, $fxs, $easings;

        /* Impostazioni di default del widget */
        $defaults = array(
            'title' => 'Featured Projects',
            'project_n_items' => 4,
            'project_speed_fx' => 200,
            'project_post_type' => '' 
        );

        $categories = get_categories('hide_empty=1&orderby=name');
        $wp_cats = array();

        foreach ($categories as $category_list )
        {
            $wp_cats[$category_list->category_nicename] = $category_list->cat_name;
        }

        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:
                 <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
            </label>
        </p> 
        
        <p>       
            <label for="<?php echo $this->get_field_id( 'project_post_type' ); ?>">Portfolio:       
                 <select id="<?php echo $this->get_field_id( 'project_post_type' ); ?>" name="<?php echo $this->get_field_name( 'project_post_type' ); ?>">   
                    <option></option>
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

        <p>
            <label for="<?php echo $this->get_field_id( 'project_n_items' ); ?>">Items:
                 <select id="<?php echo $this->get_field_id( 'project_n_items' ); ?>" name="<?php echo $this->get_field_name( 'project_n_items' ); ?>">
                    <?php
                    for($i=1;$i<=20;$i++)
                    {
                        $select = '';
                        if($instance['project_n_items'] == $i) $select = ' selected="selected"';
                        echo "<option value=\"$i\"$select>$i</option>\n";
                    }
                    ?>
                 </select>
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'project_speed_fx' ); ?>">Speed Animation (ms):
                 <input type="text" id="<?php echo $this->get_field_id( 'project_speed_fx' ); ?>" name="<?php echo $this->get_field_name( 'project_speed_fx' ); ?>" value="<?php echo $instance['project_speed_fx']; ?>" size="4" />
            </label>
        </p>
    <?php
    }
}

?>