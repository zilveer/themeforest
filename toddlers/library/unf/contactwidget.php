<?php

/*-----------------------------------------------------------------------------------*/
// START CONTACT WIDGET
/*-----------------------------------------------------------------------------------*/

// I hereby declare..
class contact_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'contact_widget',

// Widget name will appear in UI
__('Contact Widget', 'toddlers'),

// Widget description
array( 'description' => __( 'Quick Links to Facebook Twitter and Your Phone Number', 'toddlers' ), )
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
	extract( $args );
        $title = isset($instance['title']) ? $instance['title'] : '';

        $phonenumber = $instance['phonenumber'];

        $facebooktitle = $instance['facebooktitle'];
        $facebookurl = $instance['facebookurl'];

        $emailtitle = $instance['emailtitle'];
        $emailaddy = $instance['emailaddy'];

        // CHANGE COLOUR TO PURPLE
        $before_widget = str_replace('orange', 'purple', $before_widget);
        echo $before_widget;
        echo $title ? ($before_title . $title . $after_title) : '';
?>
<?php if ( !empty( $phonenumber ) ) { ?>
<a href="tel:<?php echo esc_attr($phonenumber); ?>" class="cw-phone-button"><img src="<?php echo get_template_directory_uri();?>/library/img/callbutton.svg"  data-no-retina="" class="contact-callicon"> <?php echo esc_html($phonenumber); ?></a>
<?php } ?>

<?php if ( !empty( $facebooktitle ) ) { ?>
<a href="<?php if ( !empty( $facebookurl ) ) { echo esc_url($facebookurl); } else { echo 'http://facebook.com/getunfamous';}; ?>" class="cw-facebook-button" target="_blank"><img src="<?php echo get_template_directory_uri();?>/library/img/facebookthumb.svg" data-no-retina="" class="contact-fbthumb"> <?php echo esc_html($facebooktitle); ?></a>
<?php  } ?>

<?php if ( !empty( $emailtitle ) ) { ?>
<a href="<?php if ( !empty( $emailaddy ) && is_email($emailaddy) ) {
	$emailaddy = sanitize_email($emailaddy);
			echo 'mailto:';
			echo antispambot($emailaddy,1);
		}
		else {
			echo 'mailto:' . get_option( 'admin_email');
		};
?>" class="cw-email-button">
	<img src="<?php echo get_template_directory_uri();?>/library/img/emailicon.svg" data-no-retina="" class="contact-emailicon">
	<?php echo esc_html($emailtitle); ?>
</a>
<?php } ?>

<?php echo $args['after_widget'];
}

// Widget Backend
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}
else {
	$title = __( 'Contact Us', 'toddlers' );
}

if ( isset( $instance[ 'phonenumber' ] ) ) {
	$phonenumber = $instance[ 'phonenumber' ];
}
else {
	$phonenumber = __( '1800 000 000', 'toddlers' );
}

if ( isset( $instance[ 'facebooktitle' ] ) ) {
	$facebooktitle = $instance[ 'facebooktitle' ];
}
else {
	$facebooktitle = __( 'Our Facebook', 'toddlers' );
}

if ( isset( $instance[ 'facebookurl' ] ) ) {
	$facebookurl = $instance[ 'facebookurl' ];
}
else {
	$facebookurl = __( 'http://facebook.com/getunfamous', 'toddlers' );
}

if ( isset( $instance[ 'emailtitle' ] ) ) {
	$emailtitle = $instance[ 'emailtitle' ];
}
else {
	$emailtitle = __( 'Email Us', 'toddlers' );
}

if ( isset( $instance[ 'emailaddy' ] ) ) {
	$emailaddy = $instance[ 'emailaddy' ];
}
else {
	$emailaddy = get_option( 'admin_email' );
}
// Widget admin form=
?>
<p>
<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:','toddlers' ); ?></label>
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<p>
<label for="<?php echo esc_attr($this->get_field_id( 'phonenumber' )); ?>"><?php _e( 'Phone Number:','toddlers' ); ?></label>
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'phonenumber' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'phonenumber' )); ?>" type="text" value="<?php echo esc_attr( $phonenumber ); ?>" />
</p>

<p>
<label for="<?php echo esc_attr($this->get_field_id( 'facebooktitle' )); ?>"><?php _e( 'Facebook Title:','toddlers' ); ?></label>
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'facebooktitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebooktitle' )); ?>" type="text" value="<?php echo esc_attr( $facebooktitle ); ?>" />
</p>

<p>
<label for="<?php echo esc_attr($this->get_field_id( 'facebookurl' )); ?>"><?php _e( 'Facebook URL:','toddlers' ); ?></label>
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'facebookurl' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebookurl' )); ?>" type="text" value="<?php echo esc_attr( $facebookurl ); ?>" />
</p>

<p>
<label for="<?php echo esc_attr($this->get_field_id( 'emailtitle' )); ?>"><?php _e( 'Email Title:','toddlers' ); ?></label>
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'emailtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'emailtitle' )); ?>" type="text" value="<?php echo esc_attr( $emailtitle ); ?>" />
</p>

<p>
<label for="<?php echo esc_attr($this->get_field_id( 'emailaddy' )); ?>"><?php _e( 'Email Address:','toddlers' ); ?></label>
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'emailaddy' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'emailaddy' )); ?>" type="text" value="<?php echo esc_attr( $emailaddy ); ?>" />
</p>

<?php
}

// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['phonenumber'] = ( ! empty( $new_instance['phonenumber'] ) ) ? strip_tags( $new_instance['phonenumber'] ) : '';

$instance['facebooktitle'] = ( ! empty( $new_instance['facebooktitle'] ) ) ? strip_tags( $new_instance['facebooktitle'] ) : '';
$instance['facebookurl'] = ( ! empty( $new_instance['facebookurl'] ) ) ? strip_tags( $new_instance['facebookurl'] ) : '';

$instance['emailtitle'] = ( ! empty( $new_instance['emailtitle'] ) ) ? strip_tags( $new_instance['emailtitle'] ) : '';
$instance['emailaddy'] = ( ! empty( $new_instance['emailaddy'] ) ) ? strip_tags( $new_instance['emailaddy'] ) : '';

return $instance;
}
} // Class contact_widget ends here

// Register and load the widget
function contact_load_widget() {
	register_widget( 'contact_widget' );
}
add_action( 'widgets_init', 'contact_load_widget' );