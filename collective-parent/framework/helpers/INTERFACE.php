<?php
if (!function_exists('tfuse_get_suggest')) :

    function tfuse_get_suggest() {
        global $wpdb;
        global $TFUSE;

        $q      = $TFUSE->request->REQUEST('q');
        $type   = $TFUSE->request->REQUEST('type');
        $name   = $TFUSE->request->REQUEST('name');

        $types = array_map('trim', (array)explode(',', $name));
        $types_sql = array();
        foreach($types as $key=>$typeVal){
            $types_sql[] = $wpdb->prepare("%s", $typeVal);
        }
        $types_sql = implode(',', $types_sql);

        if ($type == 'post') {
            $results = $wpdb->get_results( $wpdb->prepare("SELECT ID, post_title FROM {$wpdb->posts} WHERE post_status = 'publish' AND post_type IN (".$types_sql.") AND post_title LIKE (%s)", '%' . like_escape($q) . '%') );
            foreach (array_keys($results) as $k) {
                $results[$k] = '<a rel="' . $results[$k]->ID . '">' . $results[$k]->post_title . '</a>';
            }
        } elseif ($type == 'taxonomy') {
            $results = $wpdb->get_results( $wpdb->prepare("SELECT t.name, t.term_id FROM $wpdb->term_taxonomy AS tt INNER JOIN $wpdb->terms AS t ON tt.term_id = t.term_id WHERE tt.taxonomy IN (".$types_sql.") AND t.name LIKE (%s)", '%' . like_escape($q) . '%') );
            foreach (array_keys($results) as $k) {
                $results[$k] = '<a rel="' . $results[$k]->term_id . '">' . $results[$k]->name . '</a>';
            }
        }

        echo join($results, "\n");
        die();
    }

endif;
if (!function_exists('tfuse_register_download_group_post_type')) :

    function tfuse_register_download_group_post_type() {
        register_post_type('tfuse_download_group', array(
            'labels' => array(
                'name' => __('ThemeFuse Download Group', 'tfuse'),
            ),
            'public' => true,
            'show_ui' => false,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => false,
            'supports' => array('title', 'editor'),
            'query_var' => false,
            'can_export' => true,
            'show_in_nav_menus' => false
        ));
    }

endif;


if (!function_exists('tfuse_register_gallery_group_post_type')) :

    function tfuse_register_gallery_group_post_type() {
        register_post_type('tfuse_gallery_group', array(
            'labels' => array(
                'name' => __('ThemeFuse Gallery Group', 'tfuse'),
            ),
            'public' => true,
            'show_ui' => false,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => false,
            'supports' => array('title', 'editor'),
            'query_var' => false,
            'can_export' => true,
            'show_in_nav_menus' => false
        ));
    }

endif;

if (!function_exists('tfuse_download_group_post')) :

    /**
     * Get post id by a given token, or create new post and return it's id
     */
    function tfuse_download_group_post($_token) {
        global $wpdb;

        $_id    = 0;
        $_token = strip_tags(strtolower(str_replace(' ', '_', $_token)));

        if ($_token) {
            $_args = array(
                'post_type'     => 'tfuse_download_group',
                'post_name'     => 'tf_download_'. $_token,
                'post_status'   => 'draft',
                'comment_status'=> 'closed',
                'ping_status'   => 'closed'
            );

            $query = "SELECT ID FROM ". $wpdb->posts ." WHERE post_parent = 0";
            foreach ($_args as $k => $v) {
                $query .= " AND ". $k ." = ". $wpdb->prepare('%s', $v);
            }
            $query .= " LIMIT 1";

            $_posts = $wpdb->get_row($query);

            if (count($_posts)) {
                $_id = $_posts->ID;
            } else {
                $_words = explode('_', $_token);
                $_title = join(' ', $_words);
                $_title = ucwords($_title);
                $_post_data = array('post_title' => $_title);
                $_post_data = array_merge($_post_data, $_args);
                $_id = wp_insert_post($_post_data);
            }
        }
        return $_id;
    }

endif;
if (!function_exists('tfuse_gallery_group_post')) :

    /**
     * Get post id by a given token, or create new post and return it's id
     */
    function tfuse_gallery_group_post($_token) {
        global $wpdb;

        $_id    = 0;
        $_token = strip_tags(strtolower(str_replace(' ', '_', $_token)));

        if ($_token) {
            $_args = array(
                'post_type'     => 'tfuse_gallery_group',
                'post_name'     => 'tf_gallery_'. $_token,
                'post_status'   => 'draft',
                'comment_status'=> 'closed',
                'ping_status'   => 'closed'
            );

            $query = "SELECT ID FROM ". $wpdb->posts ." WHERE post_parent = 0";
            foreach ($_args as $k => $v) {
                $query .= " AND ". $k ." = ". $wpdb->prepare('%s', $v);
            }
            $query .= " LIMIT 1";

            $_posts = $wpdb->get_row($query);

            if (count($_posts)) {
                $_id = $_posts->ID;
            } else {
                $_words = explode('_', $_token);
                $_title = join(' ', $_words);
                $_title = ucwords($_title);
                $_post_data = array('post_title' => $_title);
                $_post_data = array_merge($_post_data, $_args);
                $_id = wp_insert_post($_post_data);
            }
        }
        return $_id;
    }

endif;
if (!function_exists('check_if_tfuse_group_post_exists')) :

    function check_if_tfuse_group_post_exists($_token, $type) {
        global $wpdb;

        $_id        = 0;
        $_token     = strip_tags(strtolower(str_replace(' ', '_', $_token)));
        $pname      = str_replace('group_post', '', str_replace('tfuse', 'tf', $type));
        $post_type  = str_replace('_post', '', $type);

        if ($_token && $type) {
            $_args = array(
                'post_type' => $post_type,
                'post_name' => $pname . $_token,
                'post_status' => 'draft',
                'comment_status' => 'closed',
                'ping_status' => 'closed'
            );

            $query = "SELECT ID FROM ". $wpdb->posts ." WHERE post_parent = 0";
            foreach ($_args as $k => $v) {
                $query .= " AND ". $k ." = ". $wpdb->prepare('%s', $v);
            }
            $query .= " LIMIT 1";

            $_posts = $wpdb->get_row($query);

            if (count($_posts))
                return $_posts->ID;
            else
                return false;
        }
    }

endif;
function tfuse_newspromo_check() {
    $response = get_site_transient('themefuse-newspromo');
    if ( !$response )
    {
        $response = wp_remote_get('http://themefuse.com/pages/newspromo/framework_menu_notice.php');
        $response = wp_remote_retrieve_body($response);

        // If an error occurred, return FALSE, store for 1 hour
        if ($response == 'error' || is_wp_error($response)) {
            $response = 'error';
            set_site_transient('themefuse-newspromo', $response, 60 * 60); // store for 1 hour
            return false;
        }

        set_site_transient('themefuse-newspromo', $response, 60 * 60 * 24); // store for 24 hours
    }
    
    return $response;
}