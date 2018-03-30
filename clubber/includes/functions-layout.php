<?php
add_action('admin_menu', 'layout_box');
add_action('admin_menu', 'layout_meta_custom');
add_action('save_post', 'layout_box_update');
function layout_meta_custom() {
        remove_meta_box('postcustom', 'page', 'normal');
}
function layout_box() {
        add_meta_box('layout_box', __('Sidebar layout settings', 'clubber'), 'layout_sidebar_box', 'page', 'normal', 'high');
}
function layout_sidebar_box() {
    global $post;
    $layouts        = array(
        array(
            'icon' => 'layout-sidebar-left.png',
            'name' => 'layout-sidebar-left'
        ),
        array(
            'icon' => 'layout-full.png',
            'name' => 'layout-full'
        ),
        array(
            'icon' => 'layout-sidebar-right.png',
            'name' => 'layout-sidebar-right'
        )
    );
    $layout_default = 'layout-sidebar-right';
    $wz_page_layout = null;
    $custom         = get_post_custom($post->ID);
    // Check if there is a setup layout
    if (array_key_exists('page-layout', $custom)) {
        $wz_page_layout = $custom["page-layout"][0];
    } else {
        $wz_page_layout = $layout_default;
    }
    echo '<div class="clearfix">';
    foreach ($layouts as $key => $layout) {
        $class = null;
        if ($wz_page_layout == $layout['name']) {
            $class = " active";
        } else {
            $class = null;
        }
        echo '<div style="background:url(' . get_template_directory_uri() . '/includes/images/' . $layout['icon'] . ') no-repeat;" class="wz-page-layout' . $class . '"  id="' . $layout['name'] . '" ></div>';
    }
    echo '</div>';
    echo '<input type="hidden" id="wz-page-layout" name="wz-page-layout" value="' . $wz_page_layout . '" />';
}
function layout_box_update($post_ID = 0) {
    $post_ID = (int) $post_ID;  
    $page = get_page( $post_ID );
    $post_status = get_post_status( $post_ID ); 
    if ( $page && "auto-draft" != $post_status && isset($_POST['wz-page-layout']) ) { 
    update_post_meta($post_ID, "page-layout", $_POST["wz-page-layout"]);
    }

}
function sidebar_layout($default = "layout-sidebar-right") {
    global $post;
    $item_meta = get_post_custom($post->ID); // get the item custom variables
    if (is_array($item_meta) && array_key_exists('page-layout', $item_meta)) {
        $layout = $item_meta["page-layout"][0];
        if ($layout != null) {
            $default = $layout;
        }
    }
    return $default;
}
function wz_setSection($columns = 0) {
    apply_filters("debug", "setSection : " . $columns);
}
function wz_setZone($width = 0) {
    apply_filters("debug", "setZone : " . $width);
}
?>