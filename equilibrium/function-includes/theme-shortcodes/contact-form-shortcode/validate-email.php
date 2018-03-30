<?php

/* validate the email */
function check_email( $email ) {
	
	if ( preg_match( '/^\w[-.\w]*@(\w[-._\w]*\.[a-zA-Z]{2,}.*)$/', $email ) ) {
		
		$domain_name = explode( "@", $email );
		$pieces = explode( ".", $domain_name[1] );
	    
	    foreach( $pieces as $piece ) {
	        if ( ! preg_match( '/^[a-z\d][a-z\d-]{0,62}$/i', $piece ) || preg_match( '/-$/', $piece ) ) {
	            return false;
	        }
	    }
		
	    return true;
		
	}
	else {
		
		return false;
		
	}
}
?>