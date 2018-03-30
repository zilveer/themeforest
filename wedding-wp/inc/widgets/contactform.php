<?php
include_once str_replace("\\","/",get_template_directory()). '/inc/helpers/woptions.php';
class WebnusContactForm extends WP_Widget{

	var $woptions;
	
	function __construct(){

		$params = array(
		'description'=> 'Webnus Contact Form',
		'name'=> 'Webnus-Contact Form',
		
		);
		
		$this->woptions = new webnus_options();
		//var_dump($this->woptions->webnus_contact_email());
		parent::__construct('WebnusContactForm', 'WebnusContactForm', $params);

	}

	public function form($instance){


		extract($instance); ?>
		<p>
		<label for="<?php echo $this->get_field_id('title') ?>">Title:</label>
		<input
		type="text"
		class="widefat"
		id="<?php echo $this->get_field_id('title') ?>"
		name="<?php echo $this->get_field_name('title') ?>"
		value="<?php if( isset($title) )  echo esc_attr($title); ?>"
		/>
		</p> <?php 
	}
	
	
	public function widget($args, $instance){
		//36587311
		extract($args);
		extract($instance);

		$werrors = array();
		$wisError = false;

		$werrorName = __( 'Please enter your name.', 'WEBNUS_TEXT_DOMAIN' );
		$werrorEmail = __( 'Please enter a valid email address.', 'WEBNUS_TEXT_DOMAIN' );
		$werrorMessage = __( 'Please enter the message.', 'WEBNUS_TEXT_DOMAIN' );

		// Get the posted variables and validate them.
		if ( isset( $_POST['wis-submitted'] ) ) {
			$wname    = $_POST['wcName'];
			$wemail   = $_POST['wcEmail'];
			$wmessage = $_POST['wcMessage'];

			// Check the name
			if ( ! webnus_validate_length( $wname, 2 ) ) {
				$wisError             = true;
				$werrors['werrorName'] = $werrorName;
			}

			// Check the email
			if ( ! is_email( $wemail ) ) {
				$wisError              = true;
				$werrors['werrorEmail'] = $werrorEmail;
			}

			// Check the message
			if ( ! webnus_validate_length( $wmessage, 2 ) ) {
				$wisError                = true;
				$werrors['werrorMessage'] = $werrorMessage;
			}


			// If there's no error, send email
			if ( ! $wisError ) {
				// Get admin email
				$wemailReceiver = get_option( 'admin_email' );

				$wemailSubject = sprintf( __( 'You have been contacted by %s', 'WEBNUS_TEXT_DOMAIN' ), $wname );
				$wemailBody    = sprintf( __( 'You have been contacted by %1$s. Their message is:', 'WEBNUS_TEXT_DOMAIN' ), $wname ) . PHP_EOL . PHP_EOL;
				$wemailBody    .= $wmessage . PHP_EOL . PHP_EOL;
				$wemailBody    .= sprintf( __( 'You can contact %1$s via email at %2$s', 'WEBNUS_TEXT_DOMAIN' ), $wname, $wemail );
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
			<form action="<?php the_permalink(); ?>" method="POST" id="wcontact-form" class="frmContact" role="form" novalidate>
				
				<input type="text" name="wcName" placeholder="<?php esc_html_e( 'Your Name','WEBNUS_TEXT_DOMAIN' ); ?>..." value="<?php if ( isset( $_POST['wcName'] ) ) { echo esc_html( $_POST['wcName'] ); } ?>" />
				<?php if ( isset( $werrors['werrorName'] ) ) : ?>
					<span class="bad-field"><?php echo esc_html( $werrors['werrorName'] ); ?></span>
				<?php endif; ?>

				<input  type="text" name="wcEmail" placeholder="<?php esc_html_e( 'Your Email Address','WEBNUS_TEXT_DOMAIN' ); ?>..." value="<?php if ( isset( $_POST['wcEmail'] ) ) { echo esc_html( $_POST['wcEmail'] ); } ?>" />
				<?php if ( isset( $werrors['werrorEmail'] ) ) : ?>
					<span class="bad-field"><?php echo esc_html( $werrors['werrorEmail'] ); ?></span>
				<?php endif; ?>

				<textarea name="wcMessage" placeholder="<?php esc_html_e( 'Your Message','WEBNUS_TEXT_DOMAIN' ); ?>..."><?php if ( isset( $_POST['wcMessage'] ) ) { echo esc_html( $_POST['wcMessage'] ); } ?></textarea>
				<?php if ( isset( $werrors['werrorMessage'] ) ) : ?>
					<span class="bad-field"><?php echo esc_html( $werrors['werrorMessage'] ); ?></span>
				<?php endif; ?>

				<input type="hidden" name="wis-submitted" value="true">
				<button type="submit" class="btnSend" ><?php esc_html_e( 'Send Your Message','WEBNUS_TEXT_DOMAIN' ); ?></button>

				<?php if ( isset( $wemailIsSent ) && $wemailIsSent ) { ?>
					<div class="alert alert-success">
						<?php esc_html_e( 'Your message has been sucessfully sent, thank you!', 'WEBNUS_TEXT_DOMAIN' ); ?>
					</div> <!-- end alert -->
				<?php } elseif ( isset( $wisError ) && $wisError ) { ?>
					<div class="alert-alert-danger">
						<?php esc_html_e( 'Sorry, it seems there was an error.', 'WEBNUS_TEXT_DOMAIN' ); ?>
					</div> <!-- end alert -->
				<?php } ?>

			</form>
		</div>

		<?php echo $after_widget; ?>
		  
		<?php 
	} 
}

add_action('widgets_init', 'register_webnuscontactform');

function register_webnuscontactform(){
	
	register_widget('WebnusContactForm');
	
}

