<?php
#gt3_delete_theme_option("theme_version");

$theme_temp_version = gt3_get_theme_option("theme_version");

if ((int)$theme_temp_version < 3) {
	gt3_update_theme_option("custom.css_request_recompile_file", "yes");
    gt3_update_theme_option("theme_version", 3);
}
if ((int)$theme_temp_version < 4) {
	gt3_update_theme_option("custom.css_request_recompile_file", "yes");
	gt3_update_theme_option('sticky', 'off');
    gt3_update_theme_option("theme_version", 4);
}
if ((int)$theme_temp_version < 5) {
	gt3_update_theme_option("custom.css_request_recompile_file", "yes");
	gt3_update_theme_option('hover_menu_color', 'ef969a');
	gt3_update_theme_option('submenu_act_color', 'ef969a');
    gt3_update_theme_option("theme_version", 5);
}
if ((int)$theme_temp_version < 6) {
	gt3_update_theme_option("google_font_parameters_menu_font", ":300, 900");
    gt3_update_theme_option("theme_version", 6);
}
if ((int)$theme_temp_version < 7) {
	gt3_update_theme_option("custom.css_request_recompile_file", "yes");
    gt3_update_theme_option("theme_version", 7);
}
?>