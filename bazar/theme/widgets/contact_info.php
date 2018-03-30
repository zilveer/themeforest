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

		$control_ops = array( 'id_base' => 'contact-info', 'width' => 300 );

		WP_Widget::__construct( 'contact-info', __( 'Contact Info', 'yit' ), $widget_ops, $control_ops );
		if ( is_admin() ){
            wp_enqueue_script( 'media-upload' );
        }
	}
	
	function form( $instance )
	{
		global $icons_name;
		
        /* Impostazioni di default del widget */
		$defaults = array( 
            'title' => __( 'Contacts', 'yit' ),
            'address' => '',
            'address_image' => '',
            'phone' => '',
            'phone_image' => '',
            'mobile' => '',
            'mobile_image' => '',
            'email' => '',
            'email_image' => '',
            'fax' => '',
            'fax_image' => ''
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
            <label><?php _e( 'Address icon', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'address_image' ); ?>" name="<?php echo $this->get_field_name( 'address_image' ); ?>" value="<?php echo $instance['address_image']; ?>" />
                <a href="media-upload.php?type=image&TB_iframe=true" class="upload-image button-secondary">Upload</a>
            </label>
        </p>
        
        <p>
            <label><?php _e( 'Phone', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" value="<?php echo $instance['phone']; ?>" />
            </label>
        </p>   
        
        <p>
            <label><?php _e( 'Phone icon', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'phone_image' ); ?>" name="<?php echo $this->get_field_name( 'phone_image' ); ?>" value="<?php echo $instance['phone_image']; ?>" />
                <a href="media-upload.php?type=image&TB_iframe=true" class="upload-image button-secondary">Upload</a>
            </label>
        </p>
        
        <p>
            <label><?php _e( 'Mobile', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'mobile' ); ?>" name="<?php echo $this->get_field_name( 'mobile' ); ?>" value="<?php echo $instance['mobile']; ?>" />
            </label>
        </p>          
        
        <p>
            <label><?php _e( 'Mobile icon', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'mobile_image' ); ?>" name="<?php echo $this->get_field_name( 'mobile_image' ); ?>" value="<?php echo $instance['mobile_image']; ?>" />
                <a href="media-upload.php?type=image&TB_iframe=true" class="upload-image button-secondary">Upload</a>
            </label>
        </p>
        
        <p>
            <label><?php _e( 'Fax', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'fax' ); ?>" name="<?php echo $this->get_field_name( 'fax' ); ?>" value="<?php echo $instance['fax']; ?>" />
            </label>
        </p>
        
        <p>
            <label><?php _e( 'Fax icon', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'fax_image' ); ?>" name="<?php echo $this->get_field_name( 'fax_image' ); ?>" value="<?php echo $instance['fax_image']; ?>" />
                <a href="media-upload.php?type=image&TB_iframe=true" class="upload-image button-secondary">Upload</a>
            </label>
        </p>
        
        <p>
            <label><?php _e( 'Email', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>" />
            </label>
        </p>
        
        <p>
            <label><?php _e( 'Email icon', 'yit' ) ?>:
                <input type="text" id="<?php echo $this->get_field_id( 'email_image' ); ?>" name="<?php echo $this->get_field_name( 'email_image' ); ?>" value="<?php echo $instance['email_image']; ?>" />
                <a href="media-upload.php?type=image&TB_iframe=true" class="upload-image button-secondary">Upload</a>
            </label>
        </p>
        
		<?php
	}
	
	function widget( $args, $instance )
	{
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		
		echo $before_widget . "<div class=\"border\">";                

		if ( $title ) echo $before_title . $title . $after_title;   
		
		$address_image = ( isset($instance['address_image']) && $instance['address_image'] != '') ? '<img src="' . $instance['address_image'] . '" alt="' . __( 'Location', 'yit' ) . '" />' : '';
		$phone_image = ( isset($instance['phone_image']) && $instance['phone_image'] != '') ? '<img src="' . $instance['phone_image'] . '" alt="' . __( 'Phone', 'yit' ) . '" />' : '';
		$mobile_image = ( isset($instance['mobile_image']) && $instance['mobile_image'] != '') ? '<img src="' . $instance['mobile_image'] . '" alt="' . __( 'Mobile', 'yit' ) . '" />' : '';
		$fax_image = ( isset($instance['fax_image']) && $instance['fax_image'] != '') ? '<img src="' . $instance['fax_image'] . '" alt="' . __( 'Fax', 'yit' ) . '" />' : '';
		$email_image = ( isset($instance['email_image']) && $instance['email_image'] != '') ? '<img src="' . $instance['email_image'] . '" alt="' . __( 'Email', 'yit' ) . '" />' : '';

		$text = '<div class="sidebar-nav">';
		$text .= '  <ul>';
            $text .= ( !empty( $instance['address'] ) ) ? '<li>' . $address_image . '<strong>' . __( 'Location', 'yit' ) . ':</strong> ' . do_shortcode( $instance['address'] ) . '</li>' : '';
            $text .= ( !empty( $instance['phone'] ) ) ? '<li>' . $phone_image . '<strong>' . __( 'Phone', 'yit' ) . ':</strong> ' . do_shortcode( $instance['phone'] ) . '</li>' : '';
            $text .= ( !empty( $instance['mobile'] ) ) ? '<li>' . $mobile_image . '<strong>' . __( 'Mobile', 'yit' ) . ':</strong> ' . do_shortcode( $instance['mobile'] ) . '</li>' : '';
            $text .= ( !empty( $instance['fax'] ) ) ? '<li>' . $fax_image . '<strong>' . __( 'Fax', 'yit' ) . ':</strong> ' . do_shortcode( $instance['fax'] ) . '</li>' : '';
            $text .= ( !empty( $instance['email'] ) ) ? '<li>' . $email_image . '<strong>' . __( 'Email', 'yit' ) . ':</strong> ' . do_shortcode( $instance['email'] ) . '</li>' : '';
		$text .= '  </ul>';
		$text .= '</div>'; 
		
		echo $text . "</div>" . $after_widget;
	}                     

    function update( $new_instance, $old_instance ) 
    {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['phone'] = str_replace( '"', "'", $new_instance['phone'] );
		
        $instance['phone_image'] = $new_instance['phone_image'];
        
        $instance['mobile'] = str_replace( '"', "'", $new_instance['mobile'] );
		
        $instance['mobile_image'] = $new_instance['mobile_image'];
        
        $instance['email'] = str_replace( '"', "'", $new_instance['email'] );
		
        $instance['email_image'] = $new_instance['email_image'];
        
        $instance['address'] = str_replace( '"', "'", $new_instance['address'] );
		
        $instance['address_image'] = $new_instance['address_image'];

		$instance['fax'] = str_replace( '"', "'", $new_instance['fax'] );
		
        $instance['fax_image'] = $new_instance['fax_image'];

		return $instance;
	}
	
}     
endif;