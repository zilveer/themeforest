<?php

class Artbees_Widget_Contact_Form extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_contact_form', 'description' => 'Displays a email contact form.' );
		WP_Widget::__construct( 'contact_form', THEME_SLUG.' - '.'Contact Form', $widget_ops );
	}



	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? 'Contact Us' : $instance['title'], $instance, $this->id_base );		
		
		Mk_Send_Mail::update_contact_form_email(2342, $args['id'], $instance['email']);

		$phone = !empty( $instance['phone'] )?$instance['phone']:false;
		$captcha = !empty( $instance['captcha'] )?$instance['captcha']:false;
		
		$id = mt_rand(99,999);        
	    $tabindex_1 = $id;
	    $tabindex_2 = $id + 1;
	    $tabindex_3 = $id + 2;
	    $tabindex_4 = $id + 3;
	    $tabindex_5 = $id + 4;

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

?>

	<form class="mk-contact-form" method="post" novalidate="novalidate">
			<input type="text" placeholder="<?php _e( 'Name', 'mk_framework' ); ?>" required="required" name="name" class="text-input" value="" tabindex="<?php echo $tabindex_1; ?>" />
			<?php if($phone == true) { ?>
			<input type="text" placeholder="<?php _e( 'Phone Number', 'mk_framework' ); ?>" name="phone" class="text-input" value="" tabindex="<?php echo $tabindex_2; ?>" />
			<?php } ?>
			<input type="email" data-type="email" required="required" placeholder="<?php _e( 'Email', 'mk_framework' ); ?>" name="email" class="text-input" value="" tabindex="<?php echo $tabindex_3; ?>"  />
			<textarea placeholder="<?php _e( 'Type your message...', 'mk_framework' ); ?>" required="required" name="content" class="textarea" tabindex="<?php echo $tabindex_4; ?>"></textarea>
			<?php if($captcha == true && Mk_Theme_Captcha::is_plugin_active()) { ?>
			<input placeholder="<?php _e( 'Enter Captcha', 'mk_framework' ); ?>" type="text" data-type="captcha" name="captcha" class="captcha-form text-input full" required="required" autocomplete="off" />
                <a href="#" class="captcha-change-image"><?php _e( 'Not readable? Change text.', 'mk_framework' ); ?></a>
                <span class="captcha-image-holder"></span> <br/>
			<?php } ?>
			<div class="mk-form-row-widget">
   		        <button tabindex="<?php echo $tabindex_5; ?>" class="mk-progress-button mk-button contact-form-button mk-skin-button mk-button--dimension-flat text-color-light mk-button--size-small" data-style="move-up">
                    <span class="mk-progress-button-content"><?php _e( 'Send message', 'mk_framework' ); ?></span>
                    <span class="mk-progress">
                        <span class="mk-progress-inner"></span>
                    </span>
                    <span class="state-success"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true,'mk-moon-checkmark'); ?></span>
                    <span class="state-error"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true,'mk-moon-close'); ?></span>
                </button>
            </div>
			<?php wp_nonce_field('mk-contact-form-security', 'security'); ?>
			<?php echo Mk_Send_Mail::contact_form_hidden_values($args['id'], 2342); ?>
			<div class="contact-form-message clearfix"></div>  
	</form>
<?php
		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['email'] = filter_var($new_instance['email'], FILTER_SANITIZE_EMAIL);
		$instance['phone'] = !empty( $new_instance['phone']) ? true : false;
		$instance['captcha'] = !empty( $new_instance['captcha']) ? true : false;
		$instance['check_email'] = ($instance['email'] != $new_instance['email']) ? true : false;
		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$email = isset( $instance['email'] ) ? $instance['email'] : get_bloginfo( 'admin_email' );
		$phone = isset( $instance['phone'] ) ? (bool)$instance['phone']  : false;
		$captcha = isset( $instance['captcha'] ) ? (bool)$instance['captcha']  : true;

		$captcha_plugin_status = '';
		if(!Mk_Theme_Captcha::is_plugin_active()) {
		    $captcha_plugin_status = '<span style="color:red">Captcha plugin is not active! please visit Appearance > Install Plugins to install it.</span>';
		}
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mk_framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<?php
		if($instance['check_email']){
			echo '<span style="color:red">Check your email, we have stripped special chars.</span>';
		}
		?>
		<p><label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e('Email:', 'mk_framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo $email; ?>" /></p>
		<br>
		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'captcha' ); ?>" name="<?php echo $this->get_field_name( 'captcha' ); ?>"<?php checked( $captcha ); ?> />
		<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Show Captcha?', 'mk_framework' ); ?></label>
		<br><?php echo $captcha_plugin_status; ?>
		</p>



		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>"<?php checked( $phone ); ?> />
		<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Show Phone Number Field?', 'mk_framework' ); ?></label></p>


<?php

	}

}

register_widget("Artbees_Widget_Contact_Form");