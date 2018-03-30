<?php
/*
	CONTACT INFORMATION WIDGET
*/
class Artbees_Widget_Contact_Info extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_contact_info', 'description' => 'Displays a list of contact info.' );
		WP_Widget::__construct( 'contact_info', THEME_SLUG.' - '. 'Contact Info', $widget_ops );

	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$name = $instance['name'];
		$cellphone = $instance['cellphone'];
		$phone = $instance['phone'];
		$address = $instance['address'];
		$website = $instance['website'];
		$email = $instance['email'];

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

?>
		<?php
		$output = '<ul '.get_schema_markup('person').'>';
		$output .= !empty( $name )  ? '<li><i class="mk-li-user"></i><span itemprop="name">'.$name.'</span></li>' : '';
		$output .= !empty( $cellphone )  ? '<li><i class="mk-li-phone"></i><span>'.$cellphone.'</span></li>' : '';
		$output .= !empty( $phone )  ? '<li><i class="mk-theme-icon-phone"></i><span>'.$phone.'</span></li>' : '';
		$output .= !empty( $address )  ? '<li><i class="mk-li-pinmap"></i><span itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">'.$address.'</span></li>' : '';
		$output .= !empty( $email )  ? '<li><i class="mk-icon-envelope-o"></i><span><a href="mailto:' . antispambot($email) . '">'.antispambot($email).'</a></span></li>' : '';
		$output .= !empty( $website )  ? '<li><i class="mk-li-web"></i><span temprop="url"><a href="' . $website . '">'.$website.'</a></span></li>' : '';
		$output .= '</ul>';
		echo $output;
		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['name'] = strip_tags( $new_instance['name']);
		$instance['cellphone'] = strip_tags( $new_instance['cellphone']);
		$instance['phone'] = strip_tags( $new_instance['phone']);
		$instance['address'] = strip_tags( $new_instance['address']);
		$instance['website'] = strip_tags( $new_instance['website']);
		$instance['email'] = strip_tags( $new_instance['email']);


		return $instance;
	}

	function form( $instance ) {
		//Defaults
		
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$name = isset( $instance['name'] ) ? esc_attr( $instance['name'] ) : '';
		$cellphone = isset( $instance['cellphone'] ) ? esc_attr( $instance['cellphone'] ) : '';
		$phone = isset( $instance['phone'] ) ? esc_attr( $instance['phone'] ) : '';
		$address = isset( $instance['address'] ) ? esc_attr( $instance['address'] ) : '';
		$email = isset( $instance['email'] ) ? esc_attr( $instance['email'] ) : '';
		$website = isset( $instance['website'] ) ? esc_attr( $instance['website'] ) : '';
		

?>

<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

<p><label for="<?php echo $this->get_field_id( 'name' ); ?>">Name:</label><input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php echo $name; ?>" /></p>

<p><label for="<?php echo $this->get_field_id( 'cellphone' ); ?>">Cellphone:</label><input class="widefat" id="<?php echo $this->get_field_id( 'cellphone' ); ?>" name="<?php echo $this->get_field_name( 'cellphone' ); ?>" type="text" value="<?php echo $cellphone; ?>" /></p>

<p><label for="<?php echo $this->get_field_id( 'phone' ); ?>">Phone:</label><input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" type="text" value="<?php echo $phone; ?>" /></p>

<p><label for="<?php echo $this->get_field_id( 'address' ); ?>">Address:</label><input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" type="text" value="<?php echo $address; ?>" /></p>

<p><label for="<?php echo $this->get_field_id( 'email' ); ?>">Email:</label><input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo $email; ?>" /></p>

<p><label for="<?php echo $this->get_field_id( 'website' ); ?>">Website:</label><input class="widefat" id="<?php echo $this->get_field_id( 'website' ); ?>" name="<?php echo $this->get_field_name( 'website' ); ?>" type="text" value="<?php echo $website; ?>" /></p>




<?php
	}
}
/***************************************************/
