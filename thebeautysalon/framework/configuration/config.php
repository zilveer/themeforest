<?php
/** Elderberry Configuration File
  *
  * Defines the settings required to run the Elderberry Framework
  *
  * @package Elderberry
  * @subpackage The Vacation Rental Admin
  *
  */


define( 'EB_PATH', get_template_directory() . '/elderberry' );
define( 'EB_URL', get_template_directory_uri() . '/elderberry' );
define( 'EB_THEME_NAME', 'thevacationrental' );
define( 'EB_THEME_PREFIX', 'tvr_' );
define( 'EB_ENVIRONMENT', 'production' );
define( 'EB_ADMIN_THEME_NAME', 'redfactory' );
define( 'EB_ADMIN_THEME_URL', EB_URL . '/themes/' . EB_ADMIN_THEME_NAME );
define( 'EB_OPTION_NAME', 'eb_settings_' . EB_THEME_NAME );
define( 'EB_WEBFONTS_API_KEY', 'AIzaSyCJZggJlUMRIooRncfkyT7Gk7zJaiLCoC8' );

$eb_config = array(
	'error_support_text' => 'If you are not sure how to resolve this, please submit a support request to the Red Factory <a href="http://www.redfactory.nl/themes/forum">Support Forum</a>',
	'settings_promotion' => '<a href="http://redfactory.nl/themes/" class="more-themes">check out more themes</a>',
);


?>