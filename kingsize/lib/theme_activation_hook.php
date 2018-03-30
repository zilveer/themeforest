<?php
/**
 * Provides activation/deactivation hook for wordpress theme.
 *
 * @author KingSize WP Theme @ OurWebMedia Managed by Bryce & Kumar 
 *
 * Usage:
 * ----------------------------------------------
 * Include this file in your theme code.
 * ----------------------------------------------
 * function my_theme_activate() {
 *    // code to execute on theme activation
 * }
 * wp_register_theme_activation_hook('mytheme', 'my_theme_activate');
 *
 * function my_theme_deactivate() {
 *    // code to execute on theme deactivation
 * }
 * wp_register_theme_deactivation_hook('mytheme', 'my_theme_deactivate');
 * ----------------------------------------------
 * 
 * 
 */

 // code to execute on theme activation
 function kingsize_activate_template_change() {

 	//colorbox
	$pages_colorbox = get_pages(array(
	'meta_key' => '_wp_page_template',
	'meta_value' => 'colorbox.php',
	'hierarchical' => 0
	));

	foreach($pages_colorbox as $page_colorbox){
		update_post_meta($page_colorbox->ID, "_wp_page_template", "template-colorbox.php", "colorbox.php");
	}

	//prettyphoto
	$pages_prettybox = get_pages(array(
	'meta_key' => '_wp_page_template',
	'meta_value' => 'prettyphoto.php',
	'hierarchical' => 0
	));

	foreach($pages_prettybox as $page_prettybox){
		update_post_meta($page_prettybox->ID, "_wp_page_template", "template-prettyphoto.php", "prettyphoto.php");
	}
	
	//fancybox.php
	$pages_fancybox = get_pages(array(
	'meta_key' => '_wp_page_template',
	'meta_value' => 'fancybox.php',
	'hierarchical' => 0
	));

	foreach($pages_fancybox as $page_fancybox){
		update_post_meta($page_fancybox->ID, "_wp_page_template", "template-fancybox.php", "fancybox.php");
	}

	//galleria.php
	$pages_galleria = get_pages(array(
	'meta_key' => '_wp_page_template',
	'meta_value' => 'galleria.php',
	'hierarchical' => 0
	));

	foreach($pages_galleria as $page_galleria){
		update_post_meta($page_galleria->ID, "_wp_page_template", "template-galleria.php", "galleria.php");
	}

	//slideviewer.php
	$pages_slideviewer = get_pages(array(
	'meta_key' => '_wp_page_template',
	'meta_value' => 'slideviewer.php',
	'hierarchical' => 0
	));

	foreach($pages_slideviewer as $page_slideviewer){
		update_post_meta($page_slideviewer->ID, "_wp_page_template", "template-slideviewer.php", "slideviewer.php");
	}

	//template_blog.php
	$pages_blog = get_pages(array(
	'meta_key' => '_wp_page_template',
	'meta_value' => 'template_blog.php',
	'hierarchical' => 0
	));

	foreach($pages_blog as $page_blog){
		update_post_meta($page_blog->ID, "_wp_page_template", "template-blog.php", "template_blog.php");
	}

	//contact.php
	$pages_contact = get_pages(array(
	'meta_key' => '_wp_page_template',
	'meta_value' => 'contact.php',
	'hierarchical' => 0
	));

	foreach($pages_contact as $page_contact){
		update_post_meta($page_contact->ID, "_wp_page_template", "template-contact.php", "contact.php");
	}

 }

wp_register_theme_activation_hook('kingsize', 'kingsize_activate_template_change');





/**
 *
 * @desc registers a theme activation hook
 * @param string $code : Code of the theme. This can be the base folder of your theme. Eg if your theme is in folder 'mytheme' then code will be 'mytheme'
 * @param callback $function : Function to call when theme gets activated.
 */
function wp_register_theme_activation_hook($code, $function) {
    $optionKey="theme_is_activated_" . $code;
    if(!get_option($optionKey)) {
        call_user_func($function);
        update_option($optionKey , 1);
    }
}

/**
 * @desc registers deactivation hook
 * @param string $code : Code of the theme. This must match the value you provided in wp_register_theme_activation_hook function as $code
 * @param callback $function : Function to call when theme gets deactivated.
 */
function wp_register_theme_deactivation_hook($code, $function) {
    // store function in code specific global
    $GLOBALS["wp_register_theme_deactivation_hook_function" . $code]=$function;

    // create a runtime function which will delete the option set while activation of this theme and will call deactivation function provided in $function
    $fn=create_function('$theme', ' call_user_func($GLOBALS["wp_register_theme_deactivation_hook_function' . $code . '"]); delete_option("theme_is_activated_' . $code. '");');

    // add above created function to switch_theme action hook. This hook gets called when admin changes the theme.
    // Due to wordpress core implementation this hook can only be received by currently active theme (which is going to be deactivated as admin has chosen another one.
    // Your theme can perceive this hook as a deactivation hook.
    add_action("switch_theme", $fn);
}
