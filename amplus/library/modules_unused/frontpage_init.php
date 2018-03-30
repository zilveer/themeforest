<?php

/**
 * During first time activation of the theme
 * set the frontpage to an existing page
 * so that our live site would not look too blank
 */
function _bfi_frontpage_init($new_theme) {
    if (!bfi_get_option(BFI_FRONTPAGEOPTION)) {
        $onePage = get_pages(array(
            "number" => 1,
        ));
        if (!count($onePage)) return;
        
        bfi_update_option(BFI_FRONTPAGEOPTION, $onePage[0]->ID);
        
        BFIAdminNotificationController::addNotification('Since this is your first activation of the theme, your frontpage has been set to display the page <strong>' . $onePage[0]->post_title . '</strong>. You can change your frontpage in <a href="' . get_admin_url() . 'admin.php?page=bfi_general">' . BFI_THEMENAME . ' &gt; General</a>.', 'warning');
    }
}
add_action('after_switch_theme', '_bfi_frontpage_init');
?>