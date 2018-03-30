<?php

#Frontend
if (!function_exists('css_js_register')) {
	function css_js_register()
	{
        #CSS
    	wp_enqueue_style('css_bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
		wp_enqueue_style('css_bootstrap_responsive', get_template_directory_uri() . '/css/bootstrap-responsive.css');
		wp_enqueue_style('css_main', get_template_directory_uri() . '/css/main.css');
		wp_enqueue_style('css_theme', get_template_directory_uri() . '/css/core/theme.php');

        #JS
		wp_enqueue_script("jquery");
        wp_enqueue_script(array("jquery-ui-core"));
        wp_enqueue_script('js_run', get_template_directory_uri() . '/js/run.js');
        wp_enqueue_script('js_main', get_template_directory_uri() . '/js/main.js', array(), false, true);
		wp_enqueue_script('js_theme', get_template_directory_uri() . '/js/core/theme.php', array(), false, true);
	}
}
add_action('wp_enqueue_scripts', 'css_js_register');

#Additional files for WooCommerce
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('woocommerce/woocommerce.php')) {
    if (!function_exists('woo_files')) {
        function woo_files()
        {
            wp_enqueue_style('css_woo', get_template_directory_uri() . '/css/woo.css');
            wp_enqueue_script('js_woo', get_template_directory_uri() . '/js/woo.js', array(), false, true);
        }
    }
    add_action('wp_print_styles', 'woo_files');
}


#Admin
add_action('admin_init', 'admin_init');
function admin_init()
{
	#CSS (MAIN)
	wp_enqueue_style('jquery-ui', get_template_directory_uri() . '/core/admin/css/jquery-ui.css');
	wp_enqueue_style('colorpicker_css', get_template_directory_uri() . '/core/admin/css/colorpicker.css');
	wp_enqueue_style('gallery_css', get_template_directory_uri() . '/core/admin/css/gallery.css');
	wp_enqueue_style('colorbox_css', get_template_directory_uri() . '/core/admin/css/colorbox.css');
	wp_enqueue_style('selectBox_css', get_template_directory_uri() . '/core/admin/css/jquery.selectBox.css');
    wp_enqueue_style('admin_css', get_template_directory_uri() . '/core/admin/css/admin.css');
    #CSS OTHER
	
	#JS (MAIN)
	wp_enqueue_script('admin_js', get_template_directory_uri() . '/core/admin/js/admin.js');
	wp_enqueue_script('ajaxupload_js', get_template_directory_uri() . '/core/admin/js/ajaxupload.js');
	wp_enqueue_script('colorpicker_js', get_template_directory_uri() . '/core/admin/js/colorpicker.js');
	wp_enqueue_script('gallery_js', get_template_directory_uri() . '/core/admin/js/gallery.js');
	wp_enqueue_script('colorbox_js', get_template_directory_uri() . '/core/admin/js/jquery.colorbox-min.js');
	wp_enqueue_script('selectBox_js', get_template_directory_uri() . '/core/admin/js/jquery.selectBox.js');
	wp_enqueue_script('backgroundPosition_js', get_template_directory_uri() . '/core/admin/js/jquery.backgroundPosition.js');
	wp_enqueue_script(array("jquery-ui-core", "jquery-ui-dialog", "jquery-ui-sortable"));
    #JS OTHER

}

?>