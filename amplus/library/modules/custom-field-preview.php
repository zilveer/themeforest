<?php

if (is_admin()) {
    add_action('save_post', 'bfi_delete_saved_preview_data');
    // add_action('add_meta_boxes', array($this, 'addMetaBox'));
} else {
    add_filter('bfi_get_post_meta', 'bfi_get_post_meta_preview', 10, 3);
}

/**
 * Get saved preview data option,
 * then use that to change values
 * IF we are in a preview
 */
function bfi_get_post_meta_preview($value, $post_id, $key) {
    if (is_preview()) {
        if (bfi_get_option('preview_data_' . $post_id) != '') {
            global $previewData;
            if (!isset($previewData) || !$previewData) {
                $previewData = unserialize(bfi_get_option('preview_data_' . $post_id));
            }
            
            if (array_key_exists(BFI_SHORTNAME . '_' . $key, $previewData)) {
                return $previewData[BFI_SHORTNAME . '_' . $key];
            } else if (array_key_exists($key, $previewData)) {
                return $previewData[$key];
            }
        }
    }
    return $value;
}

function bfi_delete_saved_preview_data($post_id) {
    bfi_delete_option('preview_data_' . $post_id);
}

function bfi_save_preview_data($post_id, $data) {
    bfi_update_option('preview_data_' . $_POST['post_ID'], serialize($data));
}

?>