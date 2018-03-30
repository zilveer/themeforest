<?php
class contact_info extends WP_Widget
{
    function __construct()
    {
		$widget_ops = array( 
            'classname' => 'contact-info', 
            'description' => __( 'Widget with a simple contact information.', 'yiw' )
        );

		$control_ops = array( 'id_base' => 'contact-info' );

		WP_Widget::__construct( 'contact-info', __( 'Contact Info', 'yiw' ), $widget_ops, $control_ops );
	}
	
	function form( $instance )
	{
		global $icons_name;
		
        /* Impostazioni di default del widget */
		$defaults = array( 
            'title' => __( 'Contacts', 'yiw' ),
            'phone' => '',
            'fax' => ''
        );
        
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label>
				<strong><?php _e( 'Title', 'yiw' ) ?>:</strong><br />
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
			</label>
		</p>                  
		
		<p>
			<label><?php _e( 'Phone', 'yiw' ) ?>:
				<input type="text" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" value="<?php echo $instance['phone']; ?>" />
			</label>
        </p>             
		
		<p>
			<label><?php _e( 'Fax', 'yiw' ) ?>:
				<input type="text" id="<?php echo $this->get_field_id( 'fax' ); ?>" name="<?php echo $this->get_field_name( 'fax' ); ?>" value="<?php echo $instance['fax']; ?>" />
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
		$text .= '    <li class="phone-icon"><span>' . $instance['phone'] . '</span></li>';
		$text .= '    <li class="fax-icon"><span>' . $instance['fax'] . '</span></li>';
		$text .= '  </ul>';
		$text .= '</div>'; 
		
		echo $text . $after_widget;
	}                     

    function update( $new_instance, $old_instance ) 
    {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['phone'] = $new_instance['phone'];

		$instance['fax'] = $new_instance['fax'];

		return $instance;
	}
	
}     
?>
