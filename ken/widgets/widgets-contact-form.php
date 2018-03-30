<?php

/*
	CONTACT FORM WIDGET
*/

class Artbees_Widget_Contact_Form extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_contact_form', 'description' => 'Displays a email contact form.' );
		WP_Widget::__construct( 'contact_form', THEME_SLUG.' - '.'Contact Form', $widget_ops );
	}



	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$email= $instance['email'];
		$skin= $instance['skin'];
		$captcha = !empty( $instance['captcha'] )?$instance['captcha']:false;
		Mk_Send_Mail::update_contact_form_email(2342, $args['id'], $instance['email']);

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

$id = mt_rand( 99, 999 );
$tabindex_1 = $id;
$tabindex_2 = $id + 1;
$tabindex_3 = $id + 2;
$tabindex_4 = $id + 3;
$name_str = __( 'FULL NAME', 'mk_framework' );
$email_str = __( 'EMAIL', 'mk_framework' );
$submit_str = __( 'SUBMIT', 'mk_framework' );
$content_str = __( 'SHORT MESSAGE', 'mk_framework' );
$enter_captcha = __( 'Enter Captcha', 'mk_framework' );
$not_readable = __( 'Not readable?', 'mk_framework' );
$change_text= __( 'Change text.', 'mk_framework' );

?>

	<div class="mk-contact-form-wrapper <?php echo $skin; ?>-skin">
    <form class="mk-contact-form" method="post" novalidate="novalidate">
        <div class="mk-form-row"><i class="mk-icon-user"></i><input placeholder="<?php echo $name_str ;?>" type="text" required="required" name="contact_name" class="text-input" value="" tabindex="<?php echo $tabindex_1 ;?>" /></div>
        <div class="mk-form-row"><i class="mk-icon-envelope-o"></i><input placeholder="<?php echo $email_str ;?>" type="email" required="required" name="contact_email" class="text-input" value="" tabindex="<?php echo $tabindex_2 ;?>" /></div>
        <textarea required="required" placeholder="<?php echo $content_str ;?>" name="contact_content" class="mk-textarea" tabindex="<?php echo $tabindex_3 ;?>"></textarea>
       	<?php if($captcha == true) { ?>
       	<div class="mk-form-row"><i class="mk-li-lock"></i>
			<input placeholder="<?php echo $enter_captcha ?>" type="text" name="captcha" class="captcha-form text-input full" required="required" autocomplete="off" />
                <a href="#" class="captcha-change-image"><?php echo $not_readable ?> <?php echo $change_text ?></a>
                <img src="<?php echo THEME_DIR_URI; ?>/captcha/captcha.php" class="captcha-image" alt="captcha txt"> <br/>
        </div>
		<?php } ?>
        <div class="button-row">
        	<button tabindex="<?php echo $tabindex_4 ;?>" class="mk-progress-button mk-button  outline-button medium" data-style="move-up">
                <span class="mk-progress-button-content"><?php echo $submit_str ;?></span>
                <span class="mk-progress">
                    <span class="mk-progress-inner"></span>
                </span>
                <span class="state-success"><i class="mk-icon-check"></i></span>
                <span class="state-error"><i class="mk-icon-times"></i></span>
            </button>
        </div>
        <i class="mk-contact-loading mk-icon-refresh"></i>
        <i class="mk-contact-success mk-theme-icon-tick"></i>
        <?php wp_nonce_field('mk-contact-form-security', 'security'); ?>
        <?php echo Mk_Send_Mail::contact_form_hidden_values($args['id'], 2342); ?>
    </form>
    <div class="clearboth"></div>

</div>
<?php
		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['email'] = $new_instance['email'];
		$instance['skin'] = $new_instance['skin'];
		$instance['captcha'] = !empty( $new_instance['captcha']) ? true : false;
		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$email = isset( $instance['email'] ) ? $instance['email'] : get_bloginfo( 'admin_email' );
		$skin = isset( $instance['skin'] ) ? $instance['skin'] : 'dark';
		$captcha = isset( $instance['captcha'] ) ? (bool)$instance['captcha']  : true;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'email' ); ?>">Email:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo $email; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'skin' ); ?>">Skin</label>
		<select id="<?php echo $this->get_field_id( 'skin' ); ?>" name="<?php echo $this->get_field_name( 'skin' ); ?>">
			<option<?php if ( $skin == 'dark' ) echo ' selected="selected"'?> value="dark">Dark</option>
			<option<?php if ( $skin == 'light' ) echo ' selected="selected"'?> value="light">Light</option>
		</select>
		</p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'captcha' ); ?>" name="<?php echo $this->get_field_name( 'captcha' ); ?>"<?php checked( $captcha ); ?> />
		<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Show Captcha?', 'mk_framework' ); ?></label></p>
		


<?php

	}

}
/***************************************************/