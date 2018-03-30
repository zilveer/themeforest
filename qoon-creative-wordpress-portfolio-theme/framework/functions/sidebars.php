<?php
/*=======================================
	Register Sidebar
=======================================*/

add_action( 'widgets_init', 'qoon_widgets_init' );
function qoon_widgets_init() {
    register_sidebar(array(
		'id' => 'qoon_blog_sidebar',
		'name' => 'Blog Sidebar',
        'before_widget' => '<div class="oi_widget">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="oi_widget_title"><span>',
        'after_title' => '</span></h6>'
    ));
	register_sidebar(array(
		'id' => 'qoon_footer_sidebar',
		'name' => 'Footer Sidebar',
        'before_widget' => '<div class="col-md-4"><div class="oi_widget oi_footer_widget">',
        'after_widget' => '</div></div>',
        'before_title' => '<h6 class="oi_footer_widget_title"><span>',
        'after_title' => '</span></h6>'
    ));
	register_sidebar(array(
		'id' => 'qoon_page_sidebar',
		'name' => 'Page Sidebar',
        'before_widget' => '<div class="oi_widget">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="oi_widget_title"><span>',
        'after_title' => '</span></h6>'
    ));
	register_sidebar(array(
		'id' => 'qoon_shop_sidebar',
		'name' => 'Shop Sidebar',
        'before_widget' => '<div class="oi_widget">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="oi_widget_title"><span>',
        'after_title' => '</span></h6>'
    ));
	register_sidebar(array(
		'id' => 'qoon_page_sidebar1',
		'name' => 'Page Sidebar 1',
        'before_widget' => '<div class="oi_widget">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="oi_widget_title"><span>',
        'after_title' => '</span></h6>'
    ));
	register_sidebar(array(
		'id' => 'qoon_page_sidebar2',
		'name' => 'Page Sidebar 2',
        'before_widget' => '<div class="oi_widget">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="oi_widget_title"><span>',
        'after_title' => '</span></h6>'
    ));
	register_sidebar(array(
		'id' => 'qoon_page_sidebar3',
		'name' => 'Page Sidebar 3',
        'before_widget' => '<div class="oi_widget">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="oi_widget_title"><span>',
        'after_title' => '</span></h6>'
    ));
	
};

?>