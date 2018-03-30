<?php
/**
 * @package WordPress
 * @subpackage U-Design
 */
/**
 * Template Name: Contact page
 */
if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( $udesign_options['recaptcha_enabled'] == 'yes' ) {
    // Add 'async' and 'defer' to the theme's reCAPTCHA enqueued script using the "script_loader_tag" filter
    function udesign_add_async_defer_to_recaptcha_script( $tag, $handle ) {
        if ( is_admin() || 'udesign-recaptcha' !== $handle ) {
            return $tag;
        }
        global $udesign_options;
        // Add language code. reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
        $lang = $udesign_options['recaptcha_lang']; // ex. "en"
        $tag = str_replace( '?ver=', '?hl='.$lang.'&amp;ver=', $tag );
        // Add the 'async' and 'defer' to the $tag
        return str_replace( '></script>', ' async defer></script>', $tag );
    }
    add_filter( 'script_loader_tag', 'udesign_add_async_defer_to_recaptcha_script', 10, 2 );

    // Register API keys at https://www.google.com/recaptcha/admin
    $user_recaptcha_site_key = $udesign_options['recaptcha_publickey'];
    $user_recaptcha_secret_key = $udesign_options['recaptcha_privatekey'];
    
    $response = isset( $_POST['g-recaptcha-response'] ) ? esc_attr( $_POST['g-recaptcha-response'] ) : '';
    $remote_ip = $_SERVER["REMOTE_ADDR"];
    // make a GET request to the Google reCAPTCHA Server
    $request = wp_remote_get(
            'https://www.google.com/recaptcha/api/siteverify?secret='.$user_recaptcha_secret_key.'&response=' . $response . '&remoteip=' . $remote_ip
    );
    // get the request response body
    $response_body = wp_remote_retrieve_body( $request );
    $result = json_decode( $response_body, true );
    $captcha_verified = $result['success'];
}

get_header();

$content_position = ( $udesign_options['contact_sidebar'] == 'left' ) ? 'grid_16 push_8' : 'grid_16';
if ( $udesign_options['remove_contact_sidebar'] == 'yes' ) $content_position = 'grid_24';
$NA_phone_format = $udesign_options['NA_phone_format'] ? '_NA_format' : '';

//If the form is submitted
if( isset($_POST['submit']) ) {
    // Get form vars
    $contact_name = strip_tags(trim(stripslashes($_POST['contact_name'])));
    $contact_email = trim($_POST['contact_email']);
    $contact_phone = trim($_POST["contact_phone{$NA_phone_format}"]);
    $contact_ext = trim($_POST["contact_ext{$NA_phone_format}"]);
    $contact_message = strip_tags(trim(stripslashes($_POST['contact_message'])));
    $g_recaptcha_response = trim($_POST['g-recaptcha-response']);
    
    if( ( $udesign_options['recaptcha_enabled'] == 'yes' ) && ( !$captcha_verified || $g_recaptcha_response == '' ) ) {
	$recaptchaError = __('Please respond to the reCAPTCHA question', 'udesign');
    }

    // Error checking if JS is turned off
    if( $contact_name == '' ) { //Check to make sure that the name field is not empty
	$nameError = __('Please enter a name', 'udesign');
    } else if( strlen($contact_name) < 2 ) {
	$nameError = __('Your name must consist of at least 2 characters', 'udesign');
    }

    if( $contact_email == '' ) {
	$emailError = __('Please enter a valid email address', 'udesign');
    } else if( !is_email( $contact_email ) ) {
	$emailError = __('Please enter a valid email address', 'udesign');
    }

    if( $NA_phone_format ) {
	if( !isPhoneNumberValid( $contact_phone ) || ( $contact_phone == '' && $contact_ext != '' ) ) {
	    $phoneError = __('phone number', 'udesign');
	}
	if( !preg_match("/^[0-9]{0,5}$/", $contact_ext) ) { // check if the extension consists of 1 to 5 digits, or empty
	    $extError = __('extension', 'udesign');
	}
    }
    if( isset($phoneError) && isset($extError) ) {
	$phone_extError = sprintf(__('Please enter a valid %1$s and %2$s', 'udesign'), $phoneError, $extError );
    } else if( isset($phoneError) ) {
	$phone_extError = sprintf(__('Please enter a valid %s', 'udesign'), $phoneError );
    } else if( isset($extError) ) {
	$phone_extError = sprintf(__('Please enter a valid %s', 'udesign'), $extError );
    }

    if( $contact_message == '' ) {
	$messageError = __('Please enter your message', 'udesign');
    }
    
    if( !isset($nameError) && !isset($emailError) && !isset($messageError) && !isset($rCaptcha_error) && !isset($recaptchaError) ) {
	$ext = ( $contact_ext != '' ) ? __('ext.', 'udesign').$contact_ext : '';
	$phone = ( $contact_phone != '' ) ? __('Phone: ', 'udesign').$contact_phone.' '.$ext."\r\n" : '';
	// Send email
	$email_address_to = explode(",", $udesign_options['email_receipients']);
	$subject = sprintf(__('Contact Form submission from %s', 'udesign'), get_option('blogname') );
	$message_contents = __("This email was submitted from: ", 'udesign') . esc_url( get_permalink() ) . "\r\n" .
                            __("Sender's name: ", 'udesign') . $contact_name . "\r\n" .
			    __('E-mail: ', 'udesign') . $contact_email . "\r\n" .
			    $phone ."\r\n" .
			    __('Message: ', 'udesign') . $contact_message . " \r\n";

	$header = "From: $contact_name <".$email_address_to[0].">\r\n";
	$header .= "Reply-To: $contact_email\r\n";
	$header .= "Return-Path: $contact_email\r\n";
	$emailSent = ( @wp_mail( $email_address_to, $subject, $message_contents, $header ) ) ? true : false;

	$contact_name_thx = $contact_name;

	// Clear the form
	$contact_name = $contact_email = $contact_phone = $contact_ext = $contact_message = '';
    }
}


//Contact Information Fields from the Admin Options
$contact_field_array = array(
    array(
	'desc' => $udesign_options['contact_field_name1'],
	'value' => $udesign_options['contact_field_value1'] ),
    array(
	'desc' => $udesign_options['contact_field_name2'],
	'value' => $udesign_options['contact_field_value2'] ),
    array(
	'desc' => $udesign_options['contact_field_name3'],
	'value' => $udesign_options['contact_field_value3'] ),
    array(
	'desc' => $udesign_options['contact_field_name4'],
	'value' => $udesign_options['contact_field_value4'] ),
    array(
	'desc' => $udesign_options['contact_field_name5'],
	'value' => $udesign_options['contact_field_value5'] ),
    array(
	'desc' => $udesign_options['contact_field_name6'],
	'value' => $udesign_options['contact_field_value6'] ),
    array(
	'desc' => $udesign_options['contact_field_name7'],
	'value' => $udesign_options['contact_field_value7']
    )
);


?>

<div id="content-container" class="container_24">
    <div id="main-content" class="<?php echo $content_position; ?>">
	<div class="main-content-padding">
<?php       udesign_main_content_top( is_front_page() ); ?>
<?php       if (have_posts()) : while (have_posts()) : the_post();
                if($post->post_content != "") : ?>
                    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<?php                   udesign_entry_before(); ?>
                        <div class="entry">
<?php                       udesign_entry_top(); ?>
<?php                       the_content(__('<p class="serif">Read the rest of this page &raquo;</p>', 'udesign')); ?>
<?php                       udesign_entry_bottom(); ?>
                        </div>
<?php                   udesign_entry_after(); ?>
                    </div>
<?php           endif;
            endwhile; endif; ?>

            <div class="clear"></div>

<?php       // Contact Fields...
            if ( $udesign_options['show_contact_fields'] ) : ?>
                <div id="contactInfo">
<?php               foreach( $contact_field_array as $field_array ) :
                        if( $field_array['value'] != '' ) : ?>
                            <div class="grid_4 contactFieldDesc"><?php echo $field_array['desc']; ?></div>
                            <div class="grid_11 contactFieldValue"><?php echo $field_array['value']; ?></div>
                            <div class="clear"></div>
<?php                   endif;
                    endforeach; ?>
                </div>
                <div class="clear"></div>
<?php       endif; ?>

            <div id="contact-wrapper">
<?php           // Message Area.  It shows a message upon successful email submission
                if( isset( $emailSent ) && $emailSent == true ) : ?>
                    <div class="success">
                        <div class="msg-box-icon">
                            <strong><?php esc_html_e('Email Successfully Sent!', 'udesign'); ?></strong><br />
                            <?php printf(__('Thank you <strong>%s</strong> for using our contact form! Your email was successfully sent and we will be in touch with you shortly.', 'udesign'), $contact_name_thx) ?>
                        </div>
                    </div>
<?php           elseif ( isset( $emailSent ) && $emailSent == false ) : ?>
                    <div class="erroneous">
                        <div class="msg-box-icon">
                            <?php esc_html_e('Failed to connect to mailserver!', 'udesign'); ?>
                        </div>
                    </div>
<?php           endif; ?>

                <form id="contactForm" class="cmxform" method="post" action="<?php echo the_permalink(); ?>#contact-wrapper">
                    <strong><?php esc_html_e('Please use the form below to send us an email:', 'udesign'); ?></strong>
                    <div id="contact-name-fld-1">
                        <label for="contact_name"><?php esc_html_e('Name', 'udesign'); ?> </label><em><?php esc_html_e('(required, at least 2 characters)', 'udesign'); ?></em><br />
                        <input id="contact_name" name="contact_name" size="30" class="required<?php if(isset($nameError)) echo ' error'; ?>" minlength="2" value="<?php echo ( isset($contact_name) ) ? esc_attr($contact_name) : ''; ?>" />
                        <input type="hidden" id="rules_contact_message" value="<?php esc_html_e( 'required', 'udesign' ); ?>" />
                        <input type="hidden" id="contact_name_required" value="<?php esc_html_e( 'Please enter a name', 'udesign' ); ?>" />
                        <input type="hidden" id="contact_name_min_length" value="<?php esc_html_e( 'Your name must consist of at least 2 characters', 'udesign' ); ?>" />
<?php                   if(isset($nameError)) echo '<label class="error" for="contact_name" generated="true">'.$nameError.'</label>'; ?>
                    </div>
                    <div id="contact-email-address-fld-1">
                        <label for="contact_email"><?php esc_html_e('E-Mail', 'udesign'); ?> </label><em><?php esc_html_e('(required)', 'udesign'); ?></em><br />
                        <input id="contact_email" name="contact_email" size="30"  class="required email<?php if(isset($emailError)) echo ' error'; ?>" value="<?php echo ( isset($contact_email) ) ? esc_attr($contact_email) : ''; ?>" />
                        <input type="hidden" id="messages_contact_email" value="<?php esc_html_e( 'Please enter a valid email address', 'udesign' ); ?>" />
<?php                   if(isset($emailError)) echo '<label class="error" for="contact_email" generated="true">'.$emailError.'</label>'; ?>
                    </div>
                    <div id="contact-phone-ext-fld-1">
                        <label for="contact_phone"><?php esc_html_e('Phone', 'udesign'); ?> </label><em><?php esc_html_e('(optional)', 'udesign'); ?></em><br />
                        <input id="contact_phone<?php echo $NA_phone_format; ?>" name="contact_phone<?php echo $NA_phone_format; ?>" size="14" class="phone<?php if(isset($phoneError)) echo ' error'; ?>" value="<?php echo ( isset($contact_phone) ) ? esc_attr($contact_phone) : ''; ?>" maxlength="14" />
                        <label for="contact_ext"><?php esc_html_e('ext.', 'udesign'); ?> </label>
                        <input id="contact_ext<?php echo $NA_phone_format; ?>" name="contact_ext<?php echo $NA_phone_format; ?>" size="5" class="ext<?php if(isset($extError)) echo ' error'; ?>" value="<?php echo ( isset($contact_ext) ) ? esc_attr($contact_ext) : ''; ?>" maxlength="5" />
<?php                   if(isset($phone_extError)) echo '<label class="error" for="contact_phone" generated="true">'.$phone_extError.'</label>'; ?>
                    </div>
                    <div id="contact-message-box-fld-1">
                        <label for="contact_message"><?php esc_html_e('Your comment', 'udesign'); ?> </label><em><?php esc_html_e('(required)', 'udesign'); ?></em><br />
                        <textarea id="contact_message" name="contact_message" cols="70" rows="7" class="required<?php if(isset($messageError)) echo ' error'; ?>"><?php echo ( isset($contact_message) ) ? esc_attr($contact_message) : ''; ?></textarea>
                        <input type="hidden" id="messages_contact_message" value="<?php esc_html_e( '<br />Please enter your message', 'udesign' ); ?>" />
<?php                   if(isset($messageError)) echo '<br /><label class="error" for="contact_message" generated="true">'.$messageError.'</label>'; ?>
                    </div>

<?php               if ( $udesign_options['recaptcha_enabled'] == 'yes' ) : ?>
                        <div class="reCAPTCHA-wrapper">
<?php                       if ( isset( $_POST['submit'] ) && ( !$captcha_verified ) ) {
                                echo '<div class="error">' . $recaptchaError . '</div>';
                            } ?>
                            <div class="g-recaptcha" data-sitekey="<?php echo $user_recaptcha_site_key;?>"></div>
                            <noscript>
                                <div style="width: 320px; height: 530px;">
                                    <div style="width: 320px; height: 525px; position: relative;">
<?php                                   //if( isset( $recaptchaError ) ) echo '<label class="error" for="recaptcha_message" generated="true">'.$recaptchaError.'</label>'; ?>
                                        <div style="width: 320px; height: 525px; position: absolute;">
                                            <iframe src="https://www.google.com/recaptcha/api/fallback?k=<?php echo $user_recaptcha_site_key;?>"
                                                    frameborder="0" scrolling="no"
                                                    style="width: 320px; height:540px; border-style: none;">
                                            </iframe>
                                        </div>
                                        <div style="width: 250px; height: 80px; position: absolute; border-style: none;
                                                    bottom: 0; left: 25px; margin: 0px; padding: 0px; right: 25px;">
                                            <textarea id="g-recaptcha-response" name="g-recaptcha-response"
                                                      class="g-recaptcha-response"
                                                      style="width: 250px; height: 50px; border: 1px solid #c1c1c1;
                                                           margin: 0px; padding: 0px; resize: none;" value=""></textarea>
                                        </div>
                                    </div>
                                </div>
                            </noscript>
                        </div>
<?php               endif; ?>
                    <div class="clear"></div>
                    <div id="contact-page-submit-form">
                        <input name="submit" class="submit" type="submit" value="<?php esc_attr_e('Submit', 'udesign'); ?>"/>
                    </div>
                </form>

            </div><!-- end contact-wrapper -->
<?php       udesign_main_content_bottom(); ?>
	</div><!-- end main-content-padding -->
    </div><!-- end main-content -->


<?php if( ( !$udesign_options['remove_contact_sidebar'] == 'yes' ) && sidebar_exist('ContactSidebar') ) { get_sidebar('ContactSidebar'); } ?>

</div><!-- end content-container -->

<div class="clear"></div>

<?php

get_footer();




