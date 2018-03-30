<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * Helper functions for various parts of the theme
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 3.5
 * @package     artbees
 */



function get_header_height() {

	global $mk_settings;

	$logo_height = (!empty($mk_settings['logo']['height'])) ? $mk_settings['logo']['height'] : 50;

	return $logo_height + ($mk_settings['header-padding'] * 2);

}



function get_typekit_font_style(){

	global $mk_settings;
	
	$id = !empty($mk_settings['typekit-id']) ? $mk_settings['typekit-id'] : '';
	$elements_list = !empty($mk_settings['typekit-element-names']) ? $mk_settings['typekit-element-names'] : '';
	$font_family = !empty($mk_settings['typekit-font-family']) ? $mk_settings['typekit-font-family'] : '';

	if (!empty($id) && !empty($elements_list) && !empty($font_family)) {
		if (is_array($elements_list)) {
			$elements_list = implode(', ', $elements_list);
		} else {
			$elements_list = $elements_list;
		}
		return $elements_list . ' {font-family: "' . $font_family . '"}';
	}
}



function mk_head_hook(){
	global $mk_shortcode_order, $is_header_shortcode_added;

}

add_action('wp_head', 'mk_head_hook', 1);



/**
 * Collect Shortcode dynamic styles and using javascript inject them to <head>
 */
if (!function_exists('mk_dynamic_styles')) {
    function mk_dynamic_styles() {
	global $app_dynamic_styles;
	
	$post_id = global_get_post_id();

	$saved_styles = get_post_meta($post_id, '_dynamic_styles', true);
	
	$saved_styles_build = get_post_meta($post_id, '_theme_options_build', true);
	$theme_option_build = get_option(THEME_OPTIONS_BUILD);

	$styles =  unserialize(base64_decode(get_post_meta($post_id, '_dynamic_styles', true)));

	if (empty($styles)) {
		$css = '';
		if(is_array($app_dynamic_styles) && !empty($app_dynamic_styles)) {
	        foreach ($app_dynamic_styles as $style) {
	            $css .= $style['inject'];
	        }
    	}
        $css = preg_replace('/\r|\n|\t/', '', $css);
        echo "<style type='text/css'>" . $css . "</style>";
    }

	if(empty($saved_styles) || $saved_styles_build != $theme_option_build) {
		update_post_meta($post_id, '_dynamic_styles', base64_encode(serialize(($app_dynamic_styles))));
		update_post_meta($post_id, '_theme_options_build', $theme_option_build);
	}
    }
    
    //Apply custom styles before runing other javascripts as they might be based on those styles as well. So setting priority as one!
    add_action('wp_footer', 'mk_dynamic_styles', 1);
}