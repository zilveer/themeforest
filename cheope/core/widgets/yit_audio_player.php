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

if( !class_exists( 'yit_audio_player' ) ) :
class yit_audio_player extends WP_Widget
{
    function __construct() {
        $widget_ops = array( 
            'classname' => 'yit-audio-player', 
            'description' => __( 'Add a SoundCloud audio player', 'yit' )
        );

        $control_ops = array( 'id_base' => 'yit-audio-player', 'width' => 430 );

        WP_Widget::__construct( 'yit-audio-player', __( 'Audio Player', 'yit' ), $widget_ops, $control_ops );
    }
    
    function form( $instance ) {
        global $icons_name;
        
        /* Impostazioni di default del widget */
        $defaults = array( 
            'title' => '',
            'url' => '',
            'auto_play' => false,
            'show_artwork' => false
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
            <label>
                <strong><?php _e( 'Title', 'yit' ) ?>:</strong><br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
            </label>
        </p>
        
        <p>
            <label>
                <strong><?php _e( 'URL', 'yit' ) ?>:</strong><br />
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" value="<?php echo $instance['url']; ?>" />
            </label>
        </p>
        
        <p>
            <label>
                <strong><?php _e( 'Auto Play', 'yit' ) ?>:</strong><br />
                <input type="checkbox" id="<?php echo $this->get_field_id( 'auto_play' ); ?>" name="<?php echo $this->get_field_name( 'auto_play' ); ?>" <?php checked( $instance['auto_play'], true ) ?> />
            </label>
        </p>
        
        <p>
            <label>
                <strong><?php _e( 'Show artwork', 'yit' ) ?>:</strong><br />
                <input type="checkbox" id="<?php echo $this->get_field_id( 'show_artwork' ); ?>" name="<?php echo $this->get_field_name( 'show_artwork' ); ?>" <?php checked( $instance['show_artwork'], true ) ?> />
            </label>
        </p>    
        <?php
    }
    
    function widget( $args, $instance ) {
        extract( $args );

        $title = apply_filters('widget_title', $instance['title'] );
        
        echo $before_widget;                   

        if ( $title ) echo $before_title . $title . $after_title;
        
        echo do_shortcode( '[soundcloud url="' . $instance['url'] . '" auto_play="' . ( $instance['auto_play'] ? 'yes' : 'no' ) . '" show_artwork="' . ( $instance['show_artwork'] ? 'yes' : 'no' ) . '" show_comments="no"]' );
        
        echo $after_widget;
    }                     

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['url'] = esc_url( $new_instance['url'] ); 
        
        $instance['auto_play'] = $new_instance['auto_play'];
        
        $instance['show_artwork'] = $new_instance['show_artwork'];

        return $instance;
    }
    
}     
endif;