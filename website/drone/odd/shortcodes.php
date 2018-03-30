<?php










if (!defined('ABSPATH')) {
	exit;
}








function drone_shortcodes_locale() {
	return array(
		'title' => __('Shortcodes', 'website')
	);
}



$strings = sprintf(
	"tinyMCE.addI18n('%s.droneshortcodes', %s);\n",
	_WP_Editors::$mce_locale,
	json_encode(drone_shortcodes_locale())
);