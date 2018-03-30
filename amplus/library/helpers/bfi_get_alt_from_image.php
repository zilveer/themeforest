<?php
/*
 */
 
/**
 * Gets the alt text value from the list of all image attachments in WP
 * from the given image url
 *
 * @see http://wordpress.stackexchange.com/questions/11662/get-all-images-in-media-gallery
 * @param string $url the image url from the media uploader
 * @return string alt string
 */
function bfi_get_alt_from_image($url) {
    global $_allImageAlts;
    
    if (!isset($_allImageAlts)) {
        $query_images_args = array(
            'post_type'      => 'attachment', 
            'post_mime_type' => 'image', 
            'post_status'    => 'inherit', 
            'posts_per_page' => -1,
        );

        $query_images = new WP_Query($query_images_args);
        $_allImageAlts = array();
        foreach ($query_images->posts as $attachment) {
            $_allImageAlts[wp_get_attachment_url($attachment->ID)] = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
        }
        unset($query_images);
    }
    
    return array_key_exists($url, $_allImageAlts) ? $_allImageAlts[$url] : '';
}
