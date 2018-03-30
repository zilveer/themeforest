<?php
	header("Content-type: text/javascript");
	require_once('../../../../../wp-load.php');


?>
	//form validation
	function validateName(fld) {
			
		var error = "";
				
		if (fld.value === '' || fld.value === 'Nickname' || fld.value === 'Enter Your Name..' || fld.value === 'Your Name..') {
			error = "<?php printf ( __( 'You didn\'t enter Your First Name.' , THEME_NAME ));?>\n";
		} else if ((fld.value.length < 2) || (fld.value.length > 50)) {
			error = "<?php printf ( __( 'First Name is the wrong length.' , THEME_NAME ));?>\n";
		}
		return error;
	}
			
	function validateEmail(fld) {

		var error="";
		var illegalChars = /^[^@]+@[^@.]+\.[^@]*\w\w$/;
				
		if (fld.value === "") {
			error = "<?php printf ( __( 'You didn\'t enter an email address.' , THEME_NAME ));?>\n";
		} else if ( fld.value.match(illegalChars) === null) {
			error = "<?php printf ( __( 'The email address contains illegal characters.' , THEME_NAME ));?>\n";
		}

		return error;

	}
			
	function validateMessage(fld) {

		var error = "";
				
		if (fld.value === '') {
			error = "<?php printf ( __( 'You didn\'t enter Your message.' , THEME_NAME ));?>\n";
		} else if (fld.value.length < 3) {
			error = "<?php printf ( __( 'The message is to short.' , THEME_NAME ));?>\n";
		}

		return error;
	}

