<?php

$strings = 'tinyMCE.addI18n( "' . esc_js( _WP_Editors::$mce_locale ) . '.bt_theme",
	{
		drop_cap: "' . esc_js( __( 'Drop Cap', 'bt_theme' ) ) . '",
		highlight: "' . esc_js( __( 'Highlight', 'bt_theme' ) ) . '"
	}
)';