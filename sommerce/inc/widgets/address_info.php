<?php
class address_info extends WP_Widget
{
    function __construct()
    {
		$widget_ops = array( 
            'classname' => 'address-info', 
            'description' => __( 'Widget with a simple address information.', 'yiw' )
        );

		$control_ops = array( 'id_base' => 'address-info' );

		WP_Widget::__construct( 'address-info', __( 'Address Info', 'yiw' ), $widget_ops, $control_ops );
	}
	
	function form( $instance )
	{
		global $icons_name;
		
        /* Impostazioni di default del widget */
		$defaults = array( 
            'title' => __( 'Find Us', 'yiw' ),
            'name' => 'Beauty & Clean',
            'address' => 'Street Red 15',
            'zip-code' => '0000185',
            'state' => 'NY',
            'city' => 'New York'
        );
        
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label>
				<strong><?php _e( 'Title', 'yiw' ) ?>:</strong><br />
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
			</label>
		</p>                  
		
		<p>
			<label><?php _e( 'Name', 'yiw' ) ?>:
				<input type="text" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo $instance['name']; ?>" />
			</label>
        </p>             
		
		<p>
			<label><?php _e( 'Address', 'yiw' ) ?>:
				<input type="text" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" value="<?php echo $instance['address']; ?>" />
			</label>
        </p>             
		
		<p>
			<label><?php _e( 'Zip Code', 'yiw' ) ?>:
				<input type="text" id="<?php echo $this->get_field_id( 'zip-code' ); ?>" name="<?php echo $this->get_field_name( 'zip-code' ); ?>" value="<?php echo $instance['zip-code']; ?>" />
			</label>
        </p>             
		
		<p>
			<label><?php _e( 'State', 'yiw' ) ?>:
				<input type="text" id="<?php echo $this->get_field_id( 'state' ); ?>" name="<?php echo $this->get_field_name( 'state' ); ?>" value="<?php echo $instance['state']; ?>" />
			</label>
        </p>             
		
		<p>
			<label><?php _e( 'City', 'yiw' ) ?>:
				<input type="text" id="<?php echo $this->get_field_id( 'city' ); ?>" name="<?php echo $this->get_field_name( 'city' ); ?>" value="<?php echo $instance['city']; ?>" />
			</label>
        </p>    
        
		<?php
	}
	
	function widget( $args, $instance )
	{
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		
		echo $before_widget;                

		if ( $title != '' ) echo $before_title . $title . $after_title;   

		$text = '
<div class="address-icon vcard">
    <address class="adr">
        <strong class="fn org">' . $instance['name'] . '</strong>  - <span class="street-address">' . $instance['address'] . '</span><br>
        <span class="postal-code">' . $instance['zip-code'] . '</span> <span class="region">' . $instance['state'] . '</span> - <span class="locality">' . $instance['city'] . '</span> 
    </address>
</div>'; 
		
		echo $text . $after_widget;
	}                     

    function update( $new_instance, $old_instance ) 
    {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['name'] = strip_tags( $new_instance['name'] );

		$instance['address'] = $new_instance['address'];

		$instance['zip-code'] = $new_instance['zip-code'];

		$instance['state'] = $new_instance['state'];

		$instance['city'] = $new_instance['city'];

		return $instance;
	}
	
}     
?>
