<?php
//WP_CONTENT_DIR .
include_once  'wpalchemy/MetaBox.php';

// global styles for the meta boxes
if (is_admin()) add_action('admin_enqueue_scripts', 'metabox_style');

function metabox_style() {
	wp_enqueue_style('wpalchemy-metabox', get_template_directory_uri() . '/inc/metaboxes/meta.css');
}

/* eof */