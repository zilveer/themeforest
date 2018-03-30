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

if( !class_exists( 'popular_posts' ) ) :
class popular_posts extends WP_Widget {
    function __construct() {
        $widget_ops = array( 
            'classname' => 'popular-posts', 
            'description' => __('Show a list of popular posts, in order of comments, with a preview thumb.', 'yit') 
        );

        $control_ops = array( 'id_base' => 'popular-posts' );

        WP_Widget::__construct( 'popular-posts', __('Popular Posts', 'yit'), $widget_ops, $control_ops );
    }
    
    function widget( $args, $instance ) {
        extract( $args );

        /* User-selected settings. */
        if( !isset( $instance['title'] ) )
            $instance['title'] = '';
            
        $title = apply_filters('widget_title', $instance['title'] );

        $items = isset( $instance['items']) ? $instance['items'] : '';
        $show_thumb = isset( $instance['show_thumb'] ) ? $instance['show_thumb'] : 'yes';
        $date = isset( $instance['date_excerpt']) ? $instance['date_excerpt'] : 'no';

        echo $before_widget;
        
        if ( $title ) echo $before_title . $title . $after_title;
        
        echo do_shortcode( '[popularpost items="'.$items.'" showthumb="'.$show_thumb.'" date="'.$date.'"]' );
        
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );          

        $instance['show_thumb'] = $new_instance['show_thumb'];    
                                                                             
        $instance['items'] = $new_instance['items'];           

        $instance['date_excerpt'] = $new_instance['date_excerpt'];

        return $instance;
    }

    function form( $instance ) {
        global $icons_name, $yit_fxs, $yit_easings;
        
        
        /* Impostazioni di default del widget */
        $defaults = array( 
            'title' => __('Popular Posts', 'yit'), 
            'items' => 3,     
            'show_thumb' => 'no',
            'date_excerpt' => 'no'
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'yit' ) ?>:
                 <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
            </label>
        </p>               
        
        <p>
            <label for="<?php echo $this->get_field_id( 'show_thumb' ); ?>"><?php _e( 'Show thumbnail', 'yit' ) ?>:
                 <select id="<?php echo $this->get_field_id( 'show_thumb' ); ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>">
                    <option value="yes" <?php selected( $instance['show_thumb'], 'yes' ) ?>><?php _e( 'Yes', 'yit' ) ?></option>
                    <option value="no" <?php selected( $instance['show_thumb'], 'no' ) ?>><?php _e( 'No', 'yit' ) ?></option>
                 </select>
            </label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'items' ); ?>"><?php _e('Items', 'yit' ) ?>:
                 <input type="text" id="<?php echo $this->get_field_id( 'items' ); ?>" name="<?php echo $this->get_field_name( 'items' ); ?>" value="<?php echo $instance['items']; ?>" size="3" />
            </label>
        </p>        
        
        <p>
            <label for="<?php echo $this->get_field_id( 'date_excerpt' ); ?>"><?php _e( 'Show Post Date', 'yit' ) ?>:
                 <select id="<?php echo $this->get_field_id( 'date_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'date_excerpt' ); ?>">
                    <option value="yes" <?php selected( $instance['date_excerpt'], 'yes' ) ?>><?php _e( 'Yes', 'yit' ) ?></option>
                    <option value="no" <?php selected( $instance['date_excerpt'], 'no' ) ?>><?php _e( 'No', 'yit' ) ?></option>
                 </select>
            </label>
        </p>
    <?php
    }
}
endif;