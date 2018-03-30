<?php

add_action('after_setup_theme', 'suprema_qodef_admin_map_init', 0);

function suprema_qodef_admin_map_init() {

    do_action('suprema_qodef_before_options_map');

    require_once QODE_FRAMEWORK_ROOT_DIR.'/admin/options/elements/map.php';
    require_once QODE_FRAMEWORK_ROOT_DIR.'/admin/options/fonts/map.php';
    require_once QODE_FRAMEWORK_ROOT_DIR.'/admin/options/general/map.php';
    require_once QODE_FRAMEWORK_ROOT_DIR.'/admin/options/page/map.php';
    require_once QODE_FRAMEWORK_ROOT_DIR.'/admin/options/sidebar/map.php';
    require_once QODE_FRAMEWORK_ROOT_DIR.'/admin/options/parallax/map.php';
    require_once QODE_FRAMEWORK_ROOT_DIR.'/admin/options/social/map.php';
    require_once QODE_FRAMEWORK_ROOT_DIR.'/admin/options/contentbottom/map.php';
    require_once QODE_FRAMEWORK_ROOT_DIR.'/admin/options/error404/map.php';
    require_once QODE_FRAMEWORK_ROOT_DIR.'/admin/options/reset/map.php';


    do_action('suprema_qodef_options_map');

    do_action('suprema_qodef_after_options_map');

}