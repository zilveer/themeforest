<?php
/**
 * Your Inspiration Themes 
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if( !class_exists( 'almost_all_categories' ) ) :
class almost_all_categories extends WP_Widget{
    
    function __construct() {
        $widget_ops = array( 
            'classname' => 'almost-all-categories', 
            'description' => __('Get list of categories, without categories excluded from options panel.', 'yit') 
        );

        $control_ops = array( 'id_base' => 'almost-all-categories' );

        WP_Widget::__construct( 'almost-all-categories', __('Almost Categories', 'yit'), $widget_ops, $control_ops );
    }
    
    function form( $instance ) {
        /* Impostazioni di default del widget */
        $defaults = array( 
            'title' => __('Categories', 'yit'),
            'show_count' => 1
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p><label>
            <strong><?php _e( 'Widget Title', 'yit' ) ?>:</strong><br />
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </label></p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'show_count' ); ?>"><?php _e( 'Toggles the display of the current count of posts in each category', 'yit' ) ?>:
                 <select id="<?php echo $this->get_field_id( 'show_count' ); ?>" name="<?php echo $this->get_field_name( 'show_count' ); ?>">
                    <option value="1" <?php selected( $instance['show_count'], '1' ) ?>><?php _e( 'Yes', 'yit' ) ?></option>
                    <option value="0" <?php selected( $instance['show_count'], '0' ) ?>><?php _e( 'No', 'yit' ) ?></option>
                 </select>
            </label>
        </p> 
        
        <p><?php _e( 'Configure this widget on the Theme Option Admin, to exclude the categories from this list.', 'yit' ) ?></p>
        <?php
    }
    
    function widget( $args, $instance ) {
        extract( $args );   
        
        /* Impostazioni di default del widget */
        $defaults = array( 
            'title' => __( 'Categories', 'yit' ),
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
            $exclude = maybe_unserialize( yit_get_option( 'blog-cats-exclude' ) );
            if( ! empty( $exclude[2] ) ){
                $cat_params['exclude'] = array_map('trim', $exclude[2] );
            }
            wp_list_categories( $cat_params );
        echo '</ul>';
        echo $after_widget;
    }                     

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['show_count'] = $new_instance['show_count'];

        return $instance;
    }
    
}
endif;