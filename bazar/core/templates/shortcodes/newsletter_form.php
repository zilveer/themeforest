<?php
$method = !empty( $method ) ? $method : yit_get_option( 'newsletter-method' );
$action = !empty( $action ) ? $action : yit_get_option( 'newsletter-action' );
$email = !empty( $email ) ? $email : yit_get_option( 'newsletter-email-name' );
$email_label = !empty( $email_label ) ? $email_label : yit_get_option( 'newsletter-email-label' );
$hidden_fields = !empty( $hidden_fields ) ? $hidden_fields : yit_get_option( 'newsletter-hidden' );
$submit = !empty( $submit ) ? $submit : yit_get_option( 'newsletter-submit-label' );  

	$html = '';
    
    $html .= '<div class="newsletter-section group">';
        
        $html .= '<p class="description special-font">'; 
        $html .= ($title) ? '<strong>' . $title . '</strong> ' : false; 
        $html .= $description; 
        $html .= '</p>'; 
    
        $html .= '<form method="' . $method . '" action="' . $action . '">';
        
            $html .= '<fieldset>'; 
            
                $html .= '<ul class="group">';
            
                    $html .= '<li>';
                    $html .= '<label for="' . $email . '">' . $email_label . '</label>';
                    $html .= '<input type="text" name="' . $email . '" id="' . $email . '" class="email-field text-field autoclear" />';
                    $html .= '</li>';     
            
                    $html .= '<li>';  
                    // hidden fileds
                    if ( $hidden_fields != '' ) {
                        $hidden_fields = explode( '&', $hidden_fields );
                        foreach ( $hidden_fields as $field ) {
                            list( $id_field, $value_field ) = explode( '=', $field );
                            $html .= '<input type="hidden" name="' . $id_field . '" value="' . $value_field . '" />';
                        }
                    }
                    
                    $html .= wp_nonce_field( 'mc_submit_signup_form', '_mc_submit_signup_form_nonce', false, false ); //MailChimp nonce
                    $html .= wp_nonce_field( 'mymail_form_nonce', '_wpnonce', false, false ); //MyMail nonce
                    $html .= '<input type="submit" value="' . $submit . '" class="submit-field" />';
                    $html .= '</li>';
            
                $html .= '</ul>';
            
            $html .= '</fieldset>'; 
        
        $html .= '</form>';
    
    $html .= '</div>';
	
?>
<?php echo $html; ?>