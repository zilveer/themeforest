<?php
/**
 * Generate theme menu
 *
 * @since Collective 1.0
 */

global $menus;

// -----------------------------------------------
register_nav_menus(array(
    'default' => __('Default Navigation', 'tfuse')
));

if (!function_exists('tfuse_load_megamenu_walker'))
{
    function tfuse_load_megamenu_walker()
    {
        global $TFUSE;
        $TFUSE->load->ext_helper('MEGAMENU', 'TF_MENU_WALKER');
        $TFUSE->load->ext_helper('MEGAMENU', 'TF_MEGAMENU_OPTHELP');

    }
}
tfuse_load_megamenu_walker();

$menus = array(
    'default' => array(
        'depth' => 3,
        'container'    => 'nav',
        'container_id' => 'topmenu',
        'menu_class' => 'dropdown',
        'theme_location' => 'default',
        'fallback_cb' => 'tfuse_select_menu_msg',
        'link_before'     => '<span>',
        'link_after'      => '</span>'
    )
);

$disabled_extensions = apply_filters('tfuse_get_disabled_extensions', null);
if (!in_array('megamenu', $disabled_extensions)) {
    $menus['default']['walker'] = new TF_FRONT_END_MENU_WALKER();
}

// -----------------------------------------------
function tfuse_menu($menu_type) {
    global $menus;
    if (isset($menus[$menu_type])) {
        wp_nav_menu($menus[$menu_type]);
    }
}

function tfuse_select_menu_msg()
{
    echo '<div id="topmenu"><p>Please go to the <a href="' . admin_url('nav-menus.php') . '" target="_blanck">Menu</a> section, create a  menu and then select the newly created menu from the Theme Locations box from the left.</p></div>';
}