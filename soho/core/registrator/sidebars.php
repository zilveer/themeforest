<?php 

$all_sidebars = gt3_get_theme_sidebars_for_admin();

if (function_exists('register_sidebar')){
    
    #default values
    $register_sidebar_attr = array(
        'description' => __('Add the widgets appearance for Custom Sidebar. Drag the widget from the available list on the left, configure widgets options and click Save button. Select the sidebar on the posts or pages in just few clicks.', 'theme_localization'),
        'before_widget' => '<div class="sidepanel %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="sidebar_header">',
        'after_title' => '</h6>'
    );

    #default values
    $register_footer_sidebar_attr = array(
        'description' => __('Add the widgets to display them in the Side Menu. Drag the widget from the available list on the left, configure widgets options and click Save button. They will appear below the menu items list.', 'theme_localization'),
        'before_widget' => '<div class="span12"><div class="sidepanel %2$s">',
        'after_widget' => '</div></div>',
        'before_title' => '<h6 class="sidebar_header">',
        'after_title' => '</h6>'
    );

    #REGISTER DEFAULT SIDEBARS
    $register_sidebar_attr['name'] = "Default";
    $register_sidebar_attr['id'] = 'page-sidebar-1';
    register_sidebar($register_sidebar_attr);

    $register_footer_sidebar_attr['name'] = "Widgets Area";
    $register_footer_sidebar_attr['id'] = 'page-sidebar-2';
    register_sidebar($register_footer_sidebar_attr);

    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if (is_plugin_active('woocommerce/woocommerce.php')) {
        $register_sidebar_attr['name'] = "WooCommerce";
        $register_sidebar_attr['id'] = 'page-sidebar-99';
        register_sidebar($register_sidebar_attr);
    }

    
    $sidebar_id = 100;
    if (is_array($all_sidebars)) {
        foreach ($all_sidebars as $sidebarName) {
            $register_sidebar_attr['name'] = $sidebarName;
            $register_sidebar_attr['id'] = 'page-sidebar-' . $sidebar_id++ ;
            register_sidebar($register_sidebar_attr);
            $sidebar_id++;
        }
    }
}

?>