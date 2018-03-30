<?php
/**
 */
 
/**
 * Displays a widget area (sidebar), use this instead of WP's dynamic_sidebar()
 *
 * @package API\WordPress Replacements
 * @param string $sidebarIndex The ID of the sidebar to display
 * @return null
 */
function bfi_dynamic_sidebar($sidebarIndex) {
    if (is_active_sidebar($sidebarIndex)) {
        dynamic_sidebar($sidebarIndex);
    }
}