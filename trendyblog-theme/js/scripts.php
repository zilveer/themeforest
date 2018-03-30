<?php
	if(df_get_option(THEME_NAME."_scriptLoad") != "on") {
		header("Content-type: text/javascript");
	}


	function df_custom_js() { 
		if(df_get_option(THEME_NAME."_scriptLoad") == "on") {
			echo "<script>";
		} 

?>



			//form validation
			function validateName(fld) {
				"use strict";
				var error = "";
						
				if (fld.value === '' || fld.value === 'Nickname' || fld.value === 'Enter Your Name..' || fld.value === 'Your Name..') {
					error = "<?php  echo esc_js("You did not enter your first name." , THEME_NAME );?>";
				} else if ((fld.value.length < 2) || (fld.value.length > 200)) {
					error = "<?php echo esc_js( 'First name is the wrong length.' , THEME_NAME );?>";
				}
				return error;
			}
					
			function validateEmail(fld) {
				"use strict";
				var error="";
				var illegalChars = /^[^@]+@[^@.]+\.[^@]*\w\w$/;
						
				if (fld.value === "") {
					error = "<?php echo esc_js( "You did not enter an email address." , THEME_NAME );?>";
				} else if ( fld.value.match(illegalChars) === null) {
					error = "<?php echo esc_js( 'The email address contains illegal characters.' , THEME_NAME );?>";
				}

				return error;

			}
					
			function valName(text) {
				"use strict";
				var error = "";
						
				if (text === '' || text === 'Nickname' || text === 'Enter Your Name..' || text === 'Your Name..') {
					error = "<?php echo esc_js( "You did not enter Your First Name." , THEME_NAME );?>";
				} else if ((text.length < 2) || (text.length > 50)) {
					error = "<?php echo esc_js( 'First Name is the wrong length.' , THEME_NAME );?>";
				}
				return error;
			}
					
			function valEmail(text) {
				"use strict";
				var error="";
				var illegalChars = /^[^@]+@[^@.]+\.[^@]*\w\w$/;
						
				if (text === "") {
					error = "<?php echo esc_js( "You did not enter an email address." , THEME_NAME );?>";
				} else if ( text.match(illegalChars) === null) {
					error = "<?php echo esc_js( 'The email address contains illegal characters.' , THEME_NAME );?>";
				}

				return error;

			}
					
			function validateMessage(fld) {
				"use strict";
				var error = "";
						
				if (fld.value === '') {
					error = "<?php echo esc_js( "You did not enter Your message." , THEME_NAME );?>";
				} else if (fld.value.length < 3) {
					error = "<?php echo esc_js( 'The message is to short.' , THEME_NAME );?>";
				}

				return error;
			}		

			function validatecheckbox() {
				"use strict";
				var error = "<?php echo esc_js( 'Please select at least one checkbox!' , THEME_NAME );?>";
				return error;
			}

<?php
		if(df_get_option(THEME_NAME."_scriptLoad") == "on") {
			echo "</script>";
		}
	}

	if(df_get_option(THEME_NAME."_scriptLoad") != "on") {
		df_custom_js();	
	} 
?>