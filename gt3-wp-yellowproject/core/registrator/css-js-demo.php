<?php
#Only demo stuff
#update_theme_option("demo_server", "true");
#delete_theme_option("demo_server");

#Add color panel
if (get_theme_option("demo_server") == "true") {
    if (!function_exists('css_js_demo')) {
        function css_js_demo()
        {
			wp_enqueue_script('color_panel_js', get_template_directory_uri() . '/js/color_panel.js', array(), false, true);
        }
    }
    add_action('wp_enqueue_scripts', 'css_js_demo');
}

?>