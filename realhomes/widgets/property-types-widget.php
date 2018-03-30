<?php
if( !class_exists('Property_Types_Widget') ){
class Property_Types_Widget extends WP_Widget {

    function __construct(){
        $widget_ops = array( 'classname' => 'Property_Types_Widget', 'description' => __('This widget displays a list of Property Types.', 'framework'));
        parent::__construct( 'property_types_widget', __('RealHomes - Property Types', 'framework'), $widget_ops );
    }

    function widget($args,  $instance) {
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);

        if ( empty($title) ){
            $title = false;
        }

        echo $before_widget;

        if($title):
            echo $before_title;
            echo $title;
            echo $after_title;
        endif;

        $this->property_types();

        echo $after_widget;

    }


    function form($instance) {
        $instance = wp_parse_args( (array) $instance, array( 'title'=> __('Property Types', 'framework') ) );
        $title = esc_attr($instance['title']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'framework'); ?></label>
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" class="widefat" />
        </p>
        <?php
    }


    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }


    function property_types(){
        $terms = get_terms('property-type',array( 'parent'=> 0 ));
        $count = count($terms);
        if ( $count > 0 ){
            $this->show_hierarchical_property_types( $terms );
        }
    }


    function show_hierarchical_property_types( $terms, $top_level = true ){
        $count = count( $terms );
        if ( $count > 0 ){

            if( $top_level ){
                echo '<ul>';
            }else{
                echo '<ul class="children">';
            }

            foreach ($terms as $term){
                echo '<li><a href="' . get_term_link( $term->slug, $term->taxonomy ) . '">' . $term->name . '</a>';
                $child_terms = get_terms('property-type',array( 'parent'=> $term->term_id ));
                if( $child_terms ){
                    $this->show_hierarchical_property_types( $child_terms, false );
                }
                echo '</li>';
            }
            echo '</ul>';
        }
    }

}

}
?>