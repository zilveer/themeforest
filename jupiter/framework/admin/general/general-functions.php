<?php

/**
 * Whether the current request is in theme options pages
 *
 * @param mixed $post_types
 * @return bool True if inside theme options pages.
 */
function mk_theme_is_options() {
    if ('admin.php' == basename($_SERVER['PHP_SELF'])) {
        return true;
    }
    
    // to be add some check code for validate only in theme options pages
    return false;
}
function mk_theme_is_menus() {
    if ('nav-menus.php' == basename($_SERVER['PHP_SELF'])) {
        return true;
    }
    
    // to be add some check code for validate only in theme options pages
    return false;
}

function mk_theme_is_themes() {

    if ('themes.php' == basename($_SERVER['PHP_SELF'])) {
        return true;
    }

    // to be add some check code for validate only in theme options pages
    return false;
}

function mk_theme_is_widgets() {
    if ('widgets.php' == basename($_SERVER['PHP_SELF'])) {
        return true;
    }
    
    // to be add some check code for validate only in theme options pages
    return false;
}
function mk_theme_is_masterkey() {
    if (isset($_GET['page']) && $_GET['page'] == 'theme_options') {
        return true;
    }
    return false;
}
function mk_is_control_panel() {
    if (isset($_GET['page']) && in_array($_GET['page'], array('Jupiter', 'theme-templates','theme-image-size','theme-status','icon-library', 'theme-support', 'theme-updates', 'theme-announcements'))) {
        return true;
    }
    return false;
}
function mk_theme_is_icon_library() {
    if (isset($_GET['page']) && $_GET['page'] == 'icon-library') {
        return true;
    }
    return false;
}

/**
 * Whether the current request is in post type pages
 *
 * @param mixed $post_types
 * @return bool True if inside post type pages
 */
function mk_theme_is_post_type($post_types = '') {
    if (mk_theme_is_post_type_list($post_types) || mk_theme_is_post_type_new($post_types) || mk_theme_is_post_type_edit($post_types) || mk_theme_is_post_type_post($post_types) || mk_theme_is_post_type_taxonomy($post_types)) {
        return true;
    } 
    else {
        return false;
    }
}

/**
 * Whether the current request is in post type list page
 *
 * @param mixed $post_types
 * @return bool True if inside post type list page
 */
function mk_theme_is_post_type_list($post_types = '') {
    if ('edit.php' != basename($_SERVER['PHP_SELF'])) {
        return false;
    }
    if ($post_types == '') {
        return true;
    } 
    else {
        $check = isset($_GET['post_type']) ? $_GET['post_type'] : (isset($_POST['post_type']) ? $_POST['post_type'] : 'post');
        if (is_string($post_types) && $check == $post_types) {
            return true;
        } 
        elseif (is_array($post_types) && in_array($check, $post_types)) {
            return true;
        }
        return false;
    }
}

/**
 * Whether the current request is in post type new page
 *
 * @param mixed $post_types
 * @return bool True if inside post type new page
 */
function mk_theme_is_post_type_new($post_types = '') {
    if ('post-new.php' != basename($_SERVER['PHP_SELF'])) {
        return false;
    }
    if ($post_types == '') {
        return true;
    } 
    else {
        $check = isset($_GET['post_type']) ? $_GET['post_type'] : (isset($_POST['post_type']) ? $_POST['post_type'] : 'post');
        if (is_string($post_types) && $check == $post_types) {
            return true;
        } 
        elseif (is_array($post_types) && in_array($check, $post_types)) {
            return true;
        }
        return false;
    }
}

/**
 * Whether the current request is in post type post page
 *
 * @param mixed $post_types
 * @return bool True if inside post type post page
 */
function mk_theme_is_post_type_post($post_types = '') {
    if ('post.php' != basename($_SERVER['PHP_SELF'])) {
        return false;
    }
    if ($post_types == '') {
        return true;
    } 
    else {
        $post = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post']) ? $_POST['post'] : false);
        $check = get_post_type($post);
        if (is_string($post_types) && $check == $post_types) {
            return true;
        } 
        elseif (is_array($post_types) && in_array($check, $post_types)) {
            return true;
        }
        return false;
    }
}

/**
 * Whether the current request is in post type edit page
 *
 * @param mixed $post_types
 * @return bool True if inside post type edit page
 */
function mk_theme_is_post_type_edit($post_types = '') {
    if ('post.php' != basename($_SERVER['PHP_SELF'])) {
        return false;
    }
    $action = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : '');
    if ('edit' != $action) {
        return false;
    }
    if ($post_types == '') {
        return true;
    } 
    else {
        $post = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post']) ? $_POST['post'] : false);
        $check = get_post_type($post);
        if (is_string($post_types) && $check == $post_types) {
            return true;
        } 
        elseif (is_array($post_types) && in_array($check, $post_types)) {
            return true;
        }
        return false;
    }
}

/**
 * Whether the current request is in post type taxonomy pages
 *
 * @param mixed $post_types
 * @return bool True if inside post type taxonomy pages
 */
function mk_theme_is_post_type_taxonomy($post_types = '') {
    if ('edit-tags.php' != basename($_SERVER['PHP_SELF'])) {
        return false;
    }
    if ($post_types == '') {
        return true;
    } 
    else {
        $check = isset($_GET['post_type']) ? $_GET['post_type'] : (isset($_POST['post_type']) ? $_POST['post_type'] : 'post');
        if (is_string($post_types) && $check == $post_types) {
            return true;
        } 
        elseif (is_array($post_types) && in_array($check, $post_types)) {
            return true;
        }
        return false;
    }
}

class mk_shortcodes_add_buttons
{
    
    function __construct() {
        add_action('init', array(&$this,
            'init'
        ));
    }
    
    function init() {
        if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
            return;
        }
        
        if (get_user_option('rich_editing') == 'true') {
            add_filter('mce_external_plugins', array(&$this,
                'mk_shortcodes_plugin'
            ));
            add_filter('mce_buttons', array(&$this,
                'mk_shortcodes_register'
            ));
        }
    }
    
    function mk_shortcodes_plugin($plugin_array) {
        if (floatval(get_bloginfo('version')) >= 3.9) {
            $tinymce_js = THEME_ADMIN_ASSETS_URI . '/js/tinymce-button.js';
        } 
        else {
            $tinymce_js = THEME_ADMIN_ASSETS_URI . '/js/tinymce-button-old.js';
        }
        $plugin_array['mk_shortcodes'] = $tinymce_js;
        return $plugin_array;
    }
    
    function mk_shortcodes_register($buttons) {
        array_push($buttons, 'mk_shortcodes_button');
        return $buttons;
    }
}

$mk_shortcodes = new mk_shortcodes_add_buttons;

/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function mk_posts_like_stats_widget() {
    
    wp_add_dashboard_widget('mk_posts_like_stats', 'Popular Post Stats', 'mk_posts_like_stats_func');
    
    wp_enqueue_style('mk-posts-likes-widget', THEME_ADMIN_ASSETS_URI . '/stylesheet/css/wp-dashboard-styles.css');
}
add_action('wp_dashboard_setup', 'mk_posts_like_stats_widget');

/**
 * Create the function to output the contents of our Dashboard Widget.
 */
function mk_posts_like_stats_func() {
    
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 5,
        'order' => 'DESC',
        'orderby' => 'meta_value_num',
        'meta_key' => '_mk_post_love',
    );
    
    $query = new WP_Query($args);
    
    echo '<p>' . __('Popular Blog & Portfolio posts based on the number of post likes.', 'mk_framework') . '</p>';
    
    echo '<span class="mk-like-post-posttype-title">' . __('Popular Blog Posts', 'mk_framework') . '</span>';
    echo '<ol class="mk_posts_like_stats_ol">';
    
    // The Loop
    while ($query->have_posts()):
        $query->the_post();
        $love_count = get_post_meta(get_the_id() , '_mk_post_love', true);
        
        echo '<li>';
        
        echo '<a target="_blank" href="' . esc_url( get_permalink() ) . '" class="mk-like-post-title">' . get_the_title() . '</a>';
        echo '<span class="mk-like-post-count"><i class="dashicons dashicons-heart"></i>' . $love_count . '</span>';
        echo '<span class="mk-like-post-category">' . get_the_category_list(', ') . '</span>';
        
        echo '</li>';
    endwhile;
    echo '</ol>';
    wp_reset_postdata();
    
    $args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => 5,
        'order' => 'DESC',
        'orderby' => 'meta_value_num',
        'meta_key' => '_mk_post_love',
    );
    
    $query = new WP_Query($args);
    
    echo '<span class="mk-like-post-posttype-title">' . __('Popular Portfolio Posts', 'mk_framework') . '</span>';
    echo '<ol class="mk_posts_like_stats_ol">';
    
    // The Loop
    while ($query->have_posts()):
        $query->the_post();
        $love_count = get_post_meta(get_the_id() , '_mk_post_love', true);
        
        echo '<li>';
        
        echo '<a target="_blank" href="' . esc_url( get_permalink() ) . '" class="mk-like-post-title">' . get_the_title() . '</a>';
        echo '<span class="mk-like-post-count"><i class="dashicons dashicons-heart"></i>' . $love_count . '</span>';
        echo '<span class="mk-like-post-category">' . implode(', ', mk_get_custom_tax(get_the_id() , 'portfolio', false)) . '</span>';
        
        echo '</li>';
    endwhile;
    echo '</ol>';
    wp_reset_postdata();
}

add_action('wp_ajax_mk_save_image_sizes', 'mk_save_image_sizes');

function mk_save_image_sizes() {
    
    check_ajax_referer('ajax-image-sizes-options', 'security');
    $options = isset($_POST['options']) ? $_POST['options'] : array();
    $options_array = array();
    if (!empty($options)) {
        foreach ($options as $sizes) {
            parse_str($sizes, $output);
            $options_array[] = $output;
        }
    }
    if (update_option(IMAGE_SIZE_OPTION, $options_array)) {
        
        update_option(THEME_OPTIONS_BUILD, uniqid());
        wp_die('1');
    } 
    else {
        wp_die('2');
    }
}


add_action('admin_head', 'mk_global_admin_styles');

function mk_global_admin_styles()
{
    ?>
    <style>
        .menu-theme-options {
            line-height: 22px;
            display: block;
            width: 160px;
            padding: 7px 12px;
            color: #fff;
            margin:0 0 -6px -11px;
            background: rgba(79,122,216,1);
            background: -moz-linear-gradient(left, rgba(79,122,216,1) 0%, rgba(221,92,161,1) 100%);
            background: -webkit-gradient(left top, right top, color-stop(0%, rgba(79,122,216,1)), color-stop(100%, rgba(221,92,161,1)));
            background: -webkit-linear-gradient(left, rgba(79,122,216,1) 0%, rgba(221,92,161,1) 100%);
            background: -o-linear-gradient(left, rgba(79,122,216,1) 0%, rgba(221,92,161,1) 100%);
            background: -ms-linear-gradient(left, rgba(79,122,216,1) 0%, rgba(221,92,161,1) 100%);
            background: linear-gradient(to right, rgba(79,122,216,1) 0%, rgba(221,92,161,1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4f7ad8', endColorstr='#dd5ca1', GradientType=1 );
        }

        .menu-theme-options .dashicons-before {
            margin-right: 5px;
        }
    </style>
    <?php
}
