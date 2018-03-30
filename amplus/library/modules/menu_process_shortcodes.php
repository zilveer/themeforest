<?php
// Filter wp_nav_menu() to process shortcodes
function bfi_menu_process_shortcodes($items) {
    return do_shortcode($items);
}
add_filter( 'wp_nav_menu_items', 'bfi_menu_process_shortcodes' );
?>