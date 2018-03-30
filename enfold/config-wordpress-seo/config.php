<?php
/*
 * Adjustments for the Yoast WordPress SEO Plugin
 */
if(!defined('WPSEO_VERSION') && !class_exists('wpSEO')) return;

function avia_wpseo_register_assets()
{
	wp_enqueue_script( 'avia-yoast-seo-js', AVIA_BASE_URL.'config-wordpress-seo/wpseo-mod.js', array('jquery'), 1, true);
}

if(is_admin()){ add_action('init', 'avia_wpseo_register_assets'); }





/*
 * There's no need for the default set follow function. Yoast SEO takes care of it and user can set custom robot meta values for each post/page.
 */
if(!function_exists('avia_wpseo_deactivate_avia_set_follow'))
{
    function avia_wpseo_deactivate_avia_set_follow($meta)
    {
        return false;
    }

    add_filter('avf_set_follow','avia_wpseo_deactivate_avia_set_follow', 10, 1);
}

/*
 * Yoast SEO takes care of the title. It uses the wp_title() hook and the output data is stored in $wptitle. So just return $wptitle and leave everything else to Yoast.
 */
if(!function_exists('avia_wpseo_change_title_adjustment'))
{
    function avia_wpseo_change_title_adjustment($title, $wptitle)
    {
        return $wptitle;
    }

    add_filter('avf_title_tag', 'avia_wpseo_change_title_adjustment', 10, 2);
}