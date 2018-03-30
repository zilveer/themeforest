<?php
/**
 * INIT - includes all the required files adepending on the current section.
 *
 * @author Pexeto
 */

//styles and scripts
require_once 'scripts-and-styles.php';

//portfolio functionality
require_once 'portfolio.php';

//general theme functions
require_once 'functions-general.php';

//meta functionality
require_once 'meta.php';

//data initialization functionality
require_once 'init-data.php';

//sidebars functionality
require_once 'sidebars.php';

//register shortcodes functionality
require_once 'shortcodes.php';

//register gallery functionality
require_once 'gallery.php';

//HTML building functions
require_once 'html-builders.php';

//front-end AJAX functions
require_once 'ajax.php';

//term splitting functionality
require_once 'class-pexeto-term-splitting.php';

if ( is_admin() ) {
	//formatting buttons
	require_once 'formatting-buttons/buttons-init.php';
}

//comments functionality
if ( !is_admin() ) {
	require_once 'comments.php';
}


if ( !function_exists( 'pexeto_load_captcha_lib' ) ) {
	function pexeto_load_captcha_lib() {
		require_once PEXETO_LIB_PATH.'utils/recaptchalib.php';
	}
}
