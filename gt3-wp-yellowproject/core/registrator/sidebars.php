<?php 

$all_sidebars = get_theme_sidebars_for_admin();

if (function_exists('register_sidebar')){
    
    #default values
    $register_sidebar_attr = array(
        'before_widget' => '<div class="sidepanel %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="sidebar_header">',
        'after_title' => '</h4>'
    );

    #default values
    $register_footer_sidebar_attr = array(
        'before_widget' => '<div class="span3"><div class="sidepanel %2$s">',
        'after_widget' => '</div></div>',
        'before_title' => '<h4 class="sidebar_header">',
        'after_title' => '</h4>'
    );

    #REGISTER DEFAULT SIDEBARS
    $register_sidebar_attr['name'] = "Default";
    $register_sidebar_attr['id'] = 'page-sidebar-1';
    register_sidebar($register_sidebar_attr);

    $register_footer_sidebar_attr['name'] = "Footer";
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