<?php

/*** SETTINGS
 ****************************************************************/
function wize_post_settings_load() {
    add_meta_box('post_settings_load', __('Post settings', 'wizedesign'), 'wize_post_settings', 'post', 'normal', 'high');
}

function wize_post_settings($post) {
    $values  = get_post_custom($post->ID);
    $feature = isset($values['post_feature']) ? esc_attr($values['post_feature'][0]) : '';
    wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
?>	
	
	<p>
		<input type="checkbox" name="post_feature" id="post_feature" <?php
    checked($feature, 'yes');
?> />
		<label for="post_feature">Article feature</label>
	</p>

	<?php
}

function wize_post_settings_save($post_id) {
    // Bail if we're doing an auto save
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    
    // if our nonce isn't there, or we can't verify it, bail
    if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'my_meta_box_nonce'))
        return;
    
    // if our current user can't edit this post, bail
    if (!current_user_can('edit_post'))
        return;
    
    // now we can actually save the data
    $allowed = array(
        'a' => array( // on allow a tags
            'href' => array() // and those anchords can only have href attribute
        )
    );
    
    // Probably a good idea to make sure your data is set
    if (isset($_POST['post_youtube']))
        update_post_meta($post_id, 'post_youtube', wp_kses($_POST['post_youtube'], $allowed));
    
    if (isset($_POST['post_vimeo']))
        update_post_meta($post_id, 'post_vimeo', wp_kses($_POST['post_vimeo'], $allowed));
    
    
    // This is purely my personal preference for saving checkboxes
    
    $chk_feature = (isset($_POST['post_feature']) && $_POST['post_feature']) ? 'yes' : 'no';
    update_post_meta($post_id, 'post_feature', $chk_feature);
    
    $chk_cover = (isset($_POST['post_cover']) && $_POST['post_cover']) ? 'yes' : 'no';
    update_post_meta($post_id, 'post_cover', $chk_cover);
    
    $chk_gallery = (isset($_POST['post_gallery']) && $_POST['post_gallery']) ? 'yes' : 'no';
    update_post_meta($post_id, 'post_gallery', $chk_gallery);
	
	$chk_video = (isset($_POST['post_video']) && $_POST['post_video']) ? 'yes' : 'no';
    update_post_meta($post_id, 'post_video', $chk_video);
    
}

add_action('add_meta_boxes', 'wize_post_settings_load');
add_action('save_post', 'wize_post_settings_save');


/*** SIDEBAR
 ****************************************************************/
function wize_post_sidebar_load() {
    add_meta_box('post_sidebar_load', __('Sidebar layout settings', 'wizedesign'), 'wize_post_sidebar', 'post', 'normal', 'core');
}

function wize_post_sidebar() {
    global $post;
    $layouts        = array(
        array(
            'icon' => 'sidebar-left.png',
            'name' => 'sidebar-left'
        ),
        array(
            'icon' => 'sidebar-full.png',
            'name' => 'sidebar-full'
        ),
        array(
            'icon' => 'sidebar-right.png',
            'name' => 'sidebar-right'
        )
    );
    $layout_default = 'sidebar-right';
    $wz_sidebar     = null;
    $custom         = get_post_custom($post->ID);
    // Check if there is a setup layout
    if (array_key_exists('sidebar-layout', $custom)) {
        $wz_sidebar = $custom["sidebar-layout"][0];
    } else {
        $wz_sidebar = $layout_default;
    }
    echo '<div class="clearfix">';
    foreach ($layouts as $key => $layout) {
        $class = null;
        if ($wz_sidebar == $layout['name']) {
            $class = " active";
        } else {
            $class = null;
        }
        echo '<div style="background:url(' . get_template_directory_uri() . '/includes/images/' . $layout['icon'] . ') no-repeat;" class="wz-sidebar-post' . esc_attr($class) . '"  id="' . esc_attr($layout['name']) . '" ></div>';
    }
    echo '</div>';
    echo '<input type="hidden" id="wz-sidebar-post" name="wz-sidebar-post" value="' . esc_attr($wz_sidebar) . '" />';
}

function wize_post_sidebar_save($post_ID = 0) {
    $post_ID     = (int) $post_ID;
    $page        = get_page($post_ID);
    $post_status = get_post_status($post_ID);
	if ($page && "auto-draft" != $post_status && isset($_POST['wz-sidebar-post']) ) { 
        update_post_meta($post_ID, "sidebar-layout", $_POST["wz-sidebar-post"]);
    }
}

function wize_post_sidebar_layout($default = "sidebar-right") {
    global $post;
    $item_meta = get_post_custom($post->ID); // get the item custom variables
    if (is_array($item_meta) && array_key_exists('sidebar-layout', $item_meta)) {
        $layout = $item_meta["sidebar-layout"][0];
        if ($layout != null) {
            $default = $layout;
        }
    }
    return $default;
}

add_action('admin_menu', 'wize_post_sidebar_load');
add_action('save_post', 'wize_post_sidebar_save');