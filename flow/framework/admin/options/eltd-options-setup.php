<?php

add_action('after_setup_theme', 'flow_elated_admin_map_init', 0);

function flow_elated_admin_map_init() {

    do_action('flow_elated_before_options_map');

    require_once ELATED_FRAMEWORK_ROOT_DIR.'/admin/options/elements/map.php';
    require_once ELATED_FRAMEWORK_ROOT_DIR.'/admin/options/fonts/map.php';
    require_once ELATED_FRAMEWORK_ROOT_DIR.'/admin/options/general/map.php';
    require_once ELATED_FRAMEWORK_ROOT_DIR.'/admin/options/page/map.php';
    require_once ELATED_FRAMEWORK_ROOT_DIR.'/admin/options/sidebar/map.php';
    require_once ELATED_FRAMEWORK_ROOT_DIR.'/admin/options/parallax/map.php';
    require_once ELATED_FRAMEWORK_ROOT_DIR.'/admin/options/social/map.php';
    require_once ELATED_FRAMEWORK_ROOT_DIR.'/admin/options/contentbottom/map.php';
    require_once ELATED_FRAMEWORK_ROOT_DIR.'/admin/options/error404/map.php';
    require_once ELATED_FRAMEWORK_ROOT_DIR.'/admin/options/reset/map.php';


    do_action('flow_elated_options_map');

    do_action('flow_elated_after_options_map');

}