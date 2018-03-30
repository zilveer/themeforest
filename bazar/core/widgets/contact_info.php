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
 
if( !class_exists( 'contact_info' ) ) :
class contact_info extends WP_Widget
{
    function __construct()
    {
		$widget_ops = array( 
            'classname' => 'contact-info', 
            'description' => __( 'Widget with a simple contact information.', 'yit' )
        );

		$control_ops = array( 'id_base' => 'contact-info' );

		WP_Widget::__construct( 'contact-info', __( 'Contact Info', 'yit' ), $widget_ops, $control_ops );
	}
	
	function form( $instance )
	{
		global $icons_name;
		
        /* Impostazioni di default del widget */
		$defaults = array( 
            'title' => __( 'Contacts', 'yit' ),
            'address' => '',
            'phone' => '',
            'mobile' => '',
            'email' => '',
            'fax' => ''
        );
        
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label>
				<strong><?php _e( 'Title', 'yit' ) ?>:</strong><br />
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
			</label>
		</p>                  
		
        <p>
            <label><?php _e( 'Address', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" value="<?php echo $instance['address'] ?>" />
            </label>
        </p>             
        
        <p>
            <label><?php _e( 'Phone', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" value="<?php echo $instance['phone']; ?>" />
            </label>
        </p>   
        
        <p>
            <label><?php _e( 'Mobile', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'mobile' ); ?>" name="<?php echo $this->get_field_name( 'mobile' ); ?>" value="<?php echo $instance['mobile']; ?>" />
            </label>
        </p>          
        
        <p>
            <label><?php _e( 'Fax', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'fax' ); ?>" name="<?php echo $this->get_field_name( 'fax' ); ?>" value="<?php echo $instance['fax']; ?>" />
            </label>
        </p>
        
        <p>
            <label><?php _e( 'Email', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>" />
            </label>
        </p>
        
		<?php
	}
	
	function widget( $args, $instance )
	{
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		
		echo $before_widget;                

		if ( $title ) echo $before_title . $title . $after_title;   

		$text = '<div class="sidebar-nav">';
		$text .= '  <ul>';
            $text .= ( !empty( $instance['address'] ) ) ? '<li>' . do_shortcode( $instance['address'] ) . '</li>' : '';
            $text .= ( !empty( $instance['phone'] ) ) ? '<li>' . do_shortcode( $instance['phone'] ) . '</li>' : '';
            $text .= ( !empty( $instance['mobile'] ) ) ? '<li>' . do_shortcode( $instance['mobile'] ) . '</li>' : '';
            $text .= ( !empty( $instance['fax'] ) ) ? '<li>' . do_shortcode( $instance['fax'] ) . '</li>' : '';
            $text .= ( !empty( $instance['email'] ) ) ? '<li>' . do_shortcode( $instance['email'] ) . '</li>' : '';
		$text .= '  </ul>';
		$text .= '</div>'; 
		
		echo $text . $after_widget;
	}                     

    function update( $new_instance, $old_instance ) 
    {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['phone'] = str_replace( '"', "'", $new_instance['phone'] );
        
        $instance['mobile'] = str_replace( '"', "'", $new_instance['mobile'] );
        
        $instance['email'] = str_replace( '"', "'", $new_instance['email'] );
        
        $instance['address'] = str_replace( '"', "'", $new_instance['address'] );

		$instance['fax'] = str_replace( '"', "'", $new_instance['fax'] );

		return $instance;
	}
	
}     
endif;