<?php

add_filter('admin_notices', '_v_3_2_changes_notices');

function _v_3_2_changes_notices() {
    if ( BFI_THEMEVERSION != 'v3.2' ) {
        return;
    }
    
    $screen = get_current_screen();
    if ( in_array( $screen->post_type, array('post', 'portfolio_item') ) 
         && $screen->base == 'post' ) {
         BFIAdminNotificationController::addNotification('The <strong>Preview Image</strong> custom option for blog posts and portfolio posts have been removed in this update. <strong>Blog posts and portfolio posts now use Featured Images instead</strong>. <em>This is backward compatible, if you have old content, you don\'t need to change anything in your posts.</em>', 'warning');
    }
    
}

// backward compatible front page
if ( bfi_get_option( BFI_FRONTPAGEOPTION ) ) {
    update_option( 'page_on_front', bfi_get_option( BFI_FRONTPAGEOPTION ) );
    update_option( 'show_on_front', 'page' );
    bfi_delete_option( BFI_SHORTNAME . '_' . BFI_FRONTPAGEOPTION );
    bfi_delete_option( BFI_FRONTPAGEOPTION );
    
    BFIAdminNotificationController::addNotification('Selecting a front page has changed from the previous version. You can now choose your front page by the normal WordPress way, by selecting it in <strong>Settings > Reading</strong>. <em>Since you just updated the theme you, I already made the changes for you.</em>', 'warning');
}