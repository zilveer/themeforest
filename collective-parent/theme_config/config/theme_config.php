<?php
/**
 * Generate theme details
 */
global $wp_version;
if(version_compare('3.3.2',$wp_version,'>=')) {
    $theme_info = get_theme_data(get_template_directory() . '/style.css');
    $cfg['theme_version'] = $theme_info['Version'];
} else {
    $theme_info = wp_get_theme(null, WP_CONTENT_DIR . '/themes/');
    if ( is_child_theme() )
        $cfg['theme_version'] = $theme_info->parent()->display('Version');
    else
        $cfg['theme_version'] = $theme_info->display('Version');
}
$cfg['mods_version'] = '1.0.3';
$cfg['theme_name'] = 'Collective';
$cfg['prefix'] = sanitize_title($cfg['theme_name']);
$cfg['author_name'] = 'ThemeFuse';
$cfg['theme_author'] = '<a target="_blank" href="http://themefuse.com">ThemeFuse</a> - ';
$cfg['forum_url'] = 'http://themefuse.com/forum/collective-wp/';
$cfg['manual_url'] = 'http://themefuse.com/wp-docs/collective/';

$cfg['disabled_extensions'] = array();

$cfg['screen_options']['nav-menus'] = array('add-post','add-post_tag');

$cfg['install_options']['tax'] = array($cfg['prefix'] . '_homepage_category', 'categories_select');
$cfg['install_options']['pos'] = array('posts_select');
