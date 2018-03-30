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

if( !class_exists( 'yit_text_quote' ) ) :
class yit_text_quote extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array( 
            'classname' => 'yit_text_quote', 
            'description' => __( 'Simple quote to use in your theme', 'yit' )
        );

        $control_ops = array( 'id_base' => 'yit_text_quote', 'width' => 430 );

        WP_Widget::__construct( 'yit_text_quote', __( 'Quote', 'yit' ), $widget_ops, $control_ops );

        if ( is_admin() ){
            wp_enqueue_style( 'thickbox' );
            wp_enqueue_script( 'thickbox' );
            wp_enqueue_script( 'media-upload' );
        }
    }
    
    function form( $instance )
    {
        
        /* Impostazioni di default del widget */
        $defaults = array( 
            'quote' => '',
            'author' => ''
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
            <label>
                <strong><?php _e( 'Quote', 'yit' ) ?>:</strong><br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'quote' ); ?>" name="<?php echo $this->get_field_name( 'quote' ); ?>" value="<?php echo $instance['quote']; ?>" />
            </label>
        </p>                  
        
        <p>
            <label>
                <strong><?php _e( 'Author', 'yit' ) ?>:</strong><br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'author' ); ?>" name="<?php echo $this->get_field_name( 'author' ); ?>" value="<?php echo $instance['author']; ?>" />
            </label>
        </p>                  


        <?php
    }
    
    function widget( $args, $instance )
    {
        extract( $args );
        
        if ( preg_match( '/span([0-9]{1,2})/', $before_widget, $matches ) && preg_match( '/yit-widget/', $before_widget ) ) {
            $span = $matches[1];
            if ( $span == '3' ) $before_widget = str_replace( 'span3', 'span6', $before_widget );   
        }

        echo $before_widget;                 
        echo '<blockquote class="text-quote-quote">' . $instance['quote'] . '</blockquote>';
        echo '<cite class="text-quote-author">' . $instance['author'] . '</cite>';
        echo $after_widget;
    }                     

    function update( $new_instance, $old_instance ) 
    {
        $instance = $old_instance;
        $instance['author'] = strip_tags( $new_instance['author'] );
        $instance['quote'] = $new_instance['quote'];

        return $instance;
    }
    
}     
endif;