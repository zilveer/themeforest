<?php

define('WP_DEBUG', false);
define('DOING_AJAX', true);
define('WP_ADMIN', true);

require_once('../../../../../../../wp-load.php');
require_once('../../../../../../../wp-admin/includes/admin.php');


@header('Content-Type: text/html; charset=' . get_option('blog_charset'));
send_nosniff_header();

do_action('admin_init');

$post_ID = intval($_POST['post_id']);
$thumbnail_id = intval($_POST['thumbnail_id']);

if (!is_user_logged_in()) die('-1');
if ($post_ID > 0 AND !current_user_can('edit_post', $post_ID)) die('-1');
check_ajax_referer('set_post_thumbnail-' . $post_ID);

die(_wp_post_thumbnail_html($thumbnail_id));