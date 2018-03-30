<?php
#Get media for postid
add_action('wp_ajax_get_media_for_postid', 'get_media_for_postid');
if (!function_exists('get_media_for_postid')) {
    function get_media_for_postid()
    {
        if (is_admin()) {
            $postid = absint($_POST['post_id']);
            $page = esc_attr($_POST['page']);
            $media_for_this_post = get_media_for_this_post($postid, $page);
            if (is_array($media_for_this_post) && count($media_for_this_post) > 0) {
                echo get_media_html($media_for_this_post, "small");
            } else {
                echo "no_items";
            }
        }

        die();
    }
}


#Get module html
add_action('wp_ajax_get_module_html', 'get_module_html');
if (!function_exists('get_module_html')) {
    function get_module_html()
    {
        if (is_admin()) {
            $module_caption = esc_attr($_POST['module_caption']);
            $module_name = esc_attr($_POST['module_name']);
            $postid = absint($_POST['postid_for_module']);

            echo get_pb_module($module_name, $module_caption, get_unused_id(), "", "", "");
        }

        die();
    }
}
?>