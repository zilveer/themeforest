<?php
if (function_exists('register_sidebar')) {
    /**	Page Sidebars
     **/
	register_sidebar(array(
        'id' => 'homepage-page',
        'name' => __('HomePage', 'wizedesign'),
        'description' => __('HomePage - Sidebar', 'wizedesign'),
        'before_title' => '<h3 class="wd-title"><span>',
        'after_title' => '</span></h3>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));
	register_sidebar(array(
        'id' => 'single-page',
        'name' => __('Blog Single', 'wizedesign'),
        'description' => __('Blog Single - Sidebar', 'wizedesign'),
        'before_title' => '<h3 class="wd-title"><span>',
        'after_title' => '</span></h3>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'id' => 'blog-one-page',
        'name' => __('Blog #1 Page', 'wizedesign'),
        'description' => __('Blog Style 1 - Sidebar', 'wizedesign'),
        'before_title' => '<h3 class="wd-title"><span>',
        'after_title' => '</h3>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'id' => 'blog-two-page',
        'name' => __('Blog #2 Page', 'wizedesign'),
        'description' => __('Blog #2 Page - Sidebar', 'wizedesign'),
        'before_title' => '<h3 class="wd-title"><span>',
        'after_title' => '</span></h3>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'id' => 'audio-page',
        'name' => __('Audio Page', 'wizedesign'),
        'description' => __('Audio - Sidebar', 'wizedesign'),
        'before_title' => '<h3 class="wd-title"><span>',
        'after_title' => '</span></h3>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'id' => 'video-page',
        'name' => __('Video Page', 'wizedesign'),
        'description' => __('Video - Sidebar', 'wizedesign'),
        'before_title' => '<h3 class="wd-title"><span>',
        'after_title' => '</span></h3>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));
	register_sidebar(array(
        'id' => 'photo-page',
        'name' => __('Photo Page', 'wizedesign'),
        'description' => __('Photo - Sidebar', 'wizedesign'),
        'before_title' => '<h3 class="wd-title"><span>',
        'after_title' => '</span></h3>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));
	register_sidebar(array(
        'id' => 'mix-single',
        'name' => __('Mix Single', 'wizedesign'),
        'description' => __('Mix Single - Sidebar', 'wizedesign'),
        'before_title' => '<h3 class="wd-title"><span>',
        'after_title' => '</span></h3>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));
	register_sidebar(array(
        'id' => 'mix-page',
        'name' => __('Mix Page', 'wizedesign'),
        'description' => __('Mix - Sidebar', 'wizedesign'),
        'before_title' => '<h3 class="wd-title"><span>',
        'after_title' => '</span></h3>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));
	register_sidebar(array(
        'id' => 'event-single',
        'name' => __('Event Single', 'wizedesign'),
        'description' => __('Event Single - Sidebar', 'wizedesign'),
        'before_title' => '<h3 class="wd-title"><span>',
        'after_title' => '</span></h3>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));
	register_sidebar(array(
        'id' => 'event-one-page',
        'name' => __('Event #1 Page', 'wizedesign'),
        'description' => __('Event #1 Page - Sidebar', 'wizedesign'),
        'before_title' => '<h3 class="wd-title"><span>',
        'after_title' => '</span></h3>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));
	register_sidebar(array(
        'id' => 'event-two-page',
        'name' => __('Event #2 Page', 'wizedesign'),
        'description' => __('Event #2 Page - Sidebar', 'wizedesign'),
        'before_title' => '<h3 class="wd-title"><span>',
        'after_title' => '</span></h3>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));
	register_sidebar(array(
        'id' => 'sidebar-page',
        'name' => __('Page', 'wizedesign'),
        'description' => __('Sidebar Page', 'wizedesign'),
        'before_title' => '<h3 class="wd-title"><span>',
        'after_title' => '</span></h3>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'id' => 'contact-page',
        'name' => __('Contact', 'wizedesign'),
        'description' => __('Contact Sidebar', 'wizedesign'),
        'before_title' => '<h3 class="wd-title"><span>',
        'after_title' => '</span></h3>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));
}
/** Footer sidebar
 **/
register_sidebar(array(
    'id' => 'footer-left',
    'name' => __('Footer Widget 1', 'wizedesign'),
    'description' => __('In the footer the left column', 'wizedesign'),
    'before_title' => '<h3 class="wd-title">',
    'after_title' => '</h3>',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>'
));
register_sidebar(array(
    'id' => 'footer-center',
    'name' => __('Footer Widget 2', 'wizedesign'),
    'description' => __('In the footer the center column', 'wizedesign'),
    'before_title' => '<h3 class="wd-title">',
    'after_title' => '</h3>',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>'
));
register_sidebar(array(
    'id' => 'footer-right',
    'name' => __('Footer Widget 3', 'wizedesign'),
    'description' => __('In the footer the right column', 'wizedesign'),
    'before_title' => '<h3 class="wd-title">',
    'after_title' => '</h3>',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>'
));