<?php 
$method = !empty( $method ) ? $method : yit_get_option( 'newsletter-method' );
$action = !empty( $action ) ? $action : yit_get_option( 'newsletter-action' );
$email = !empty( $email ) ? $email : yit_get_option( 'newsletter-email-name' );
$email_label = !empty( $email_label ) ? $email_label : yit_get_option( 'newsletter-email-label' );
$hidden_fields = !empty( $hidden_fields ) ? $hidden_fields : yit_get_option( 'newsletter-hidden' ); 
$submit = !empty( $submit ) ? $submit : yit_get_option( 'newsletter-submit-label' ); 

$email = str_replace( array( '&#91;', '&#93;' ), array( '[', ']' ), $email );
?>
<div class="call-three">
	<?php
	$center = '';
	if ( (isset($title) && $title != '') || (isset($incipit) && $incipit != '') ) : ?>
		<div class="text">
			<?php if ( isset($title) && $title != '' ) : ?><h2><?php echo $title ?></h2><?php endif ?>
			<?php if ( isset($incipit) && $incipit != '' ) : ?><h4><?php echo $incipit ?></h4><?php endif ?>
		</div>
	<?php else :
		$center= 'newsletter-call3-center';
	endif ?>
	<div class="newsletter-call3 <?php echo $center ?> group">
		<form method="<?php echo  $method ?>" action="<?php echo  $action ?>">
			<div class="newsletter-icon"><label for="<?php echo $email ?>"></label></div>
			<div class="newsletter-input">			
				<input type="text" name="<?php echo $email ?>" id="<?php echo $email ?>" placeholder="<?php echo $email_label ?>" class="email-field text-field autoclear" />
			</div>
			<div class="newsletter-submit">
				<?php // hidden fileds
                    if ( $hidden_fields != '' ) {
                        $hidden_fields = explode( '&', $hidden_fields );
                        foreach ( $hidden_fields as $field ) {
                            list( $id_field, $value_field ) = 
                            explode( '=', $field );
                            echo '<input type="hidden" name="' . $id_field . '" value="' . $value_field . '" />';
                        }
                    }
                    
                    echo wp_nonce_field( 'mc_submit_signup_form', '_mc_submit_signup_form_nonce', false, false ); //MailChimp nonce
                    echo wp_nonce_field( 'mymail_form_nonce', '_wpnonce', false, false ); //MyMail nonce
				?>
				<input type="submit" value="<?php echo  $submit ?>" class="submit-field" />
			</div>
		</form>
	</div>
	<div class="clear"></div>
</div>