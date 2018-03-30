<?php
class WebnusContactForm extends WP_Widget{
	function __construct(){
		$params = array('description'=> 'A contact form will be displayed','name'=> 'Webnus-Contact Form',);
		parent::__construct('WebnusContactForm', 'WebnusContactForm', $params);
	}
	public function form($instance){
		extract($instance); ?>
		<p><label for="<?php echo $this->get_field_id('title') ?>">Title:</label><input type="text" class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" value="<?php if( isset($title) )  echo esc_attr($title); ?>" /><span><?php esc_html_e( 'The title that you want to show for this widget.', 'webnus_framework' ); ?></span></p>
		<?php 
	}
	public function widget($args, $instance){
		extract($args);
		extract($instance);
		$werrors = array();
		$wisError = false;
		$werrorName = esc_html__( 'Please enter your name.', 'webnus_framework' );
		$werrorEmail = esc_html__( 'Please enter a valid email address.', 'webnus_framework' );
		$werrorMessage = esc_html__( 'Please enter the message.', 'webnus_framework' );
		if ( isset( $_POST['wis-submitted'] ) ) {
			$wname    = $_POST['wcName'];
			$wemail   = $_POST['wcEmail'];
			$wmessage = $_POST['wcMessage'];
			if ( ! webnus_validate_length( $wname, 2 ) ) {
				$wisError             = true;
				$werrors['werrorName'] = $werrorName;
			}
			if ( ! is_email( $wemail ) ) {
				$wisError              = true;
				$werrors['werrorEmail'] = $werrorEmail;
			}
			if ( ! webnus_validate_length( $wmessage, 2 ) ) {
				$wisError                = true;
				$werrors['werrorMessage'] = $werrorMessage;
			}
			if ( ! $wisError ) {
				$wemailReceiver = get_option( 'admin_email' );
				$wemailSubject = sprintf( esc_html__( 'You have been contacted by %s', 'webnus_framework' ), $wname );
				$wemailBody    = sprintf( esc_html__( 'You have been contacted by %1$s. Their message is:', 'webnus_framework' ), $wname ) . PHP_EOL . PHP_EOL;
				$wemailBody    .= $wmessage . PHP_EOL . PHP_EOL;
				$wemailBody    .= sprintf( esc_html__( 'You can contact %1$s via email at %2$s', 'webnus_framework' ), $wname, $wemail );
				$wemailBody    .= PHP_EOL . PHP_EOL;
				$wemailHeaders[] = "Reply-To: $wemail" . PHP_EOL;
				add_filter( 'wp_mail_from_name', 'custom_wp_mail_from_name' );
					function custom_wp_mail_from_name( $wname ) {
						return 'Webnus Contact form';
				}
				$wemailIsSent = wp_mail( $wemailReceiver, $wemailSubject, $wemailBody, $wemailHeaders );
			}
		}
		echo $before_widget; ?>
		<div class="contact-inf">
		<?php 
		if(!empty($title))
		echo $before_title.$title.$after_title; 
		?>
			<form action="#" method="POST" id="wcontact-form" class="frmContact" role="form" novalidate>
				<input type="text" name="wcName" placeholder="<?php esc_html_e( 'Your Name','webnus_framework' ); ?>..." value="<?php if ( isset( $_POST['wcName'] ) ) { echo esc_html( $_POST['wcName'] ); } ?>" />
				<?php if ( isset( $werrors['werrorName'] ) ) : ?>
					<span class="bad-field"><?php echo esc_html( $werrors['werrorName'] ); ?></span>
				<?php endif; ?>
				<input  type="text" name="wcEmail" placeholder="<?php esc_html_e( 'Your Email Address','webnus_framework' ); ?>..." value="<?php if ( isset( $_POST['wcEmail'] ) ) { echo esc_html( $_POST['wcEmail'] ); } ?>" />
				<?php if ( isset( $werrors['werrorEmail'] ) ) : ?>
					<span class="bad-field"><?php echo esc_html( $werrors['werrorEmail'] ); ?></span>
				<?php endif; ?>
				<textarea name="wcMessage" placeholder="<?php esc_html_e( 'Your Message','webnus_framework' ); ?>..."><?php if ( isset( $_POST['wcMessage'] ) ) { echo esc_html( $_POST['wcMessage'] ); } ?></textarea>
				<?php if ( isset( $werrors['werrorMessage'] ) ) : ?>
					<span class="bad-field"><?php echo esc_html( $werrors['werrorMessage'] ); ?></span>
				<?php endif; ?>
				<input type="hidden" name="wis-submitted" value="true">
				<button type="submit" class="btnSend" ><?php esc_html_e( 'Send Your Message','webnus_framework' ); ?></button>
				<?php if ( isset( $wemailIsSent ) && $wemailIsSent ) { ?>
					<div class="alert alert-success">
						<?php esc_html_e( 'Your message has been sucessfully sent, thank you!', 'webnus_framework' ); ?>
					</div> <!-- end alert -->
				<?php } elseif ( isset( $wisError ) && $wisError ) { ?>
					<div class="alert-alert-danger">
						<?php esc_html_e( 'Sorry, it seems there was an error.', 'webnus_framework' ); ?>
					</div> <!-- end alert -->
				<?php } ?>
			</form>
		</div>
		<?php echo $after_widget;
	} 
}
add_action('widgets_init', 'register_webnuscontactform');
function register_webnuscontactform(){
	register_widget('WebnusContactForm');
}