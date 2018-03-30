<?php
function theme_mce_escape($text) {
	global $mce_locale;

	if ( 'en' == $mce_locale )
		return $text;
	else
		return esc_js($text);
}
$strings = 'tinyMCE.addI18n("' . $mce_locale . '.shortcode_generator",{
desc:"' . theme_mce_escape( __('Insert Shortcode','theme_admin') ) . '"
});
';