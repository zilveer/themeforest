<?php
/**
 * Blog Options Page
 *
 * @package Smartbox
 * @subpackage options-pages
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */

return array(
    'page_title' => THEME_NAME . ' - ' . __('Blog Options', THEME_ADMIN_TD),
    'menu_title' => __('Blog', THEME_ADMIN_TD),
    'slug'       => THEME_SHORT . '-blog',
    'main_menu'  => false,
    'sections'   => array(
        'blog-section' => array(
            'title'   => __('Blog', THEME_ADMIN_TD),
            'header'  => __('Setup your blog here', THEME_ADMIN_TD),
            'fields' => array(
                array(
                    'name'    => __('Show Comments On', THEME_ADMIN_TD),
                    'desc'    => __('Where to allow comments. All (show all), Pages (only on pages), Posts (only on posts), Off (all comments are off)', THEME_ADMIN_TD),
                    'id'      => 'site_comments',
                    'type'    => 'radio',
                    'options' => array(
                        'all'   => __('All', THEME_ADMIN_TD),
                        'pages' => __('Pages', THEME_ADMIN_TD),
                        'posts' => __('Posts', THEME_ADMIN_TD),
                        'Off'   => __('Off', THEME_ADMIN_TD)
                    ),
                    'default' => 'posts',
                ),
                array(
                    'name' => __('Blog title', THEME_ADMIN_TD),
                    'desc' => __('The title that appears at the top of your blog', THEME_ADMIN_TD),
                    'id' => 'blog_title',
                    'type' => 'text',
                    'default' => 'Our Blog',
                ),
                array(
                    'name'    => __('Blog Layout', THEME_ADMIN_TD),
                    'desc'    => __('Layout of your blog page. Choose among right sidebar, left sidebar, fullwidth layout', THEME_ADMIN_TD),
                    'id'      => 'blog_layout',
                    'type'    => 'radio',
                    'options' => array(
                        'sidebar-right' => __('Right Sidebar', THEME_ADMIN_TD),
                        'sidebar-left'  => __('Left Sidebar', THEME_ADMIN_TD),
                        'full-width'    => __('FullWidth', THEME_ADMIN_TD),
                    ),
                    'default' => 'sidebar-right',
                ),
                array(
                    'name'    => __('Post image size', THEME_ADMIN_TD),
                    'desc'    => __('Choosing large will hide avatar on the left of the post', THEME_ADMIN_TD),
                    'id'      => 'blog_image_size',
                    'type'    => 'radio',
                    'options' => array(
                        'large'   => __('Large', THEME_ADMIN_TD),
                        'normal'  => __('Normal', THEME_ADMIN_TD),
                    ),
                    'default' => 'normal',
                ),
                array(
                    'name' => __('Blog read more link', THEME_ADMIN_TD),
                    'desc' => __('The text that will be used for your read more links', THEME_ADMIN_TD),
                    'id' => 'blog_readmore',
                    'type' => 'text',
                    'default' => '<strong>Read</strong> More',
                ),
                array(
                    'name'    => __('Display avatars', THEME_ADMIN_TD),
                    'desc'    => __('Toggle avatars on/off', THEME_ADMIN_TD),
                    'id'      => 'site_avatars',
                    'type'    => 'radio',
                    'options' => array(
                        'on'   => __('On', THEME_ADMIN_TD),
                        'off'  => __('Off', THEME_ADMIN_TD),
                    ),
                    'default' => 'on',
                ),
                array(
                    'name'    => __('Display categories', THEME_ADMIN_TD),
                    'desc'    => __('Toggle categories on/off in post header', THEME_ADMIN_TD),
                    'id'      => 'blog_categories',
                    'type'    => 'radio',
                    'options' => array(
                        'on'   => __('On', THEME_ADMIN_TD),
                        'off'  => __('Off', THEME_ADMIN_TD),
                    ),
                    'default' => 'on',
                ),
                array(
                    'name'    => __('Display tags', THEME_ADMIN_TD),
                    'desc'    => __('Toggle tags on/off in post header', THEME_ADMIN_TD),
                    'id'      => 'blog_tags',
                    'type'    => 'radio',
                    'options' => array(
                        'on'   => __('On', THEME_ADMIN_TD),
                        'off'  => __('Off', THEME_ADMIN_TD),
                    ),
                    'default' => 'on',
                ),
                array(
                    'name'    => __('Display comment count', THEME_ADMIN_TD),
                    'desc'    => __('Toggle comment count on/off in post header', THEME_ADMIN_TD),
                    'id'      => 'blog_comment_count',
                    'type'    => 'radio',
                    'options' => array(
                        'on'   => __('On', THEME_ADMIN_TD),
                        'off'  => __('Off', THEME_ADMIN_TD),
                    ),
                    'default' => 'on',
                ),
                array(
                    'name'    => __('Show related posts', THEME_ADMIN_TD),
                    'desc'    => __('toogle related posts on/off', THEME_ADMIN_TD),
                    'id'      => 'related_posts',
                    'type'    => 'radio',
                    'options' => array(
                        'on'   => __('On', THEME_ADMIN_TD),
                        'off'  => __('Off', THEME_ADMIN_TD),
                    ),
                    'default' => 'on',
                ),
                array(
                    'name'    => __('Number of related posts', THEME_ADMIN_TD),
                    'desc'    => __('choose how many related posts are displayed', THEME_ADMIN_TD),
                    'id'      => 'related_posts_number',
                    'type'    => 'radio',
                    'options' => array(
                        '4'   => __('4', THEME_ADMIN_TD),
                        '6'   => __('6', THEME_ADMIN_TD),
                    ),
                    'default' => '4',
                ),
                array(
                    'name'    => __('Show author bio', THEME_ADMIN_TD),
                    'desc'    => __('Display author bio after the post content', THEME_ADMIN_TD),
                    'id'      => 'author_bio',
                    'type'    => 'radio',
                    'options' => array(
                        'on'   => __('On', THEME_ADMIN_TD),
                        'off'  => __('Off', THEME_ADMIN_TD),
                    ),
                    'default' => 'on',
                ),
                array(
                    'name'    => __('Fancybox in single blog view', THEME_ADMIN_TD),
                    'desc'    => __('Use fancybox with featured images in single blog view', THEME_ADMIN_TD),
                    'id'      => 'blog_fancybox',
                    'type'    => 'radio',
                    'options' => array(
                        'on'   => __('On', THEME_ADMIN_TD),
                        'off'  => __('Off', THEME_ADMIN_TD),
                    ),
                    'default' => 'on',
                ),
            )
        ),
    )
);