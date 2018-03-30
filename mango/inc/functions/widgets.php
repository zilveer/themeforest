<?php
add_action( 'widgets_init', 'mango_widgets_init' );

function mango_widgets_init() {
    register_sidebar ( array (
        'name' => __ ( 'Blog Sidebar 1', 'mango' ),
        'id' => 'blog-sidebar-1',
        'before_widget' => '<div id="%1$s" class="page-sidebar  %2$s">',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'after_widget' => '</div>'
    ) );
	register_sidebar ( array (
        'name' => __ ( 'Blog Sidebar 2', 'mango' ),
        'id' => 'blog-sidebar-2',
        'before_widget' => '<div id="%1$s" class="page-sidebar %2$s">',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'after_widget' => '</div>'
    ) );
//Page SIdebars
    register_sidebar ( array (
        'name' => __ ( 'Page Sidebar 1', 'mango' ),
        'id' => 'page-sidebar-1',
        'before_widget' => '<div id="%1$s" class="page-sidebar %2$s">',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'after_widget' => '</div>'
    ) );
    register_sidebar ( array (
        'name' => __ ( 'Page Sidebar 2', 'mango' ),
        'id' => 'page-sidebar-2',
        'before_widget' => '<div id="%1$s" class="page-sidebar %2$s">',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'after_widget' => '</div>'
    ) );
//post SIdebars
    register_sidebar ( array (
        'name' => __ ( 'Single Post Sidebar', 'mango' ),
        'id' => 'single-post-sidebar',
        'before_widget' => '<div id="%1$s" class="page-sidebar %2$s">',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'after_widget' => '</div>'
    ) );
//shop page sidebar
//Page SIdebars
    register_sidebar ( array (
        'name' => __ ( 'Shop Page Sidebar 1', 'mango' ),
        'id' => 'shop-page-sidebar-1',
        'before_widget' => '<div id="%1$s" class="page-sidebar %2$s">',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'after_widget' => '</div>'
    ) );
    register_sidebar ( array (
        'name' => __ ( 'Shop Page Sidebar 2', 'mango' ),
        'id' => 'shop-page-sidebar-2',
        'before_widget' => '<div id="%1$s" class="page-sidebar %2$s">',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'after_widget' => '</div>'
    ) );
     register_sidebar ( array (
        'name' => __ ( 'Shop Page Sidebar 3', 'mango' ),
        'id' => 'shop-page-sidebar-3',
        'before_widget' => '<div id="%1$s" class="page-sidebar %2$s">',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'after_widget' => '</div>'
    ) );
     register_sidebar ( array (
        'name' => __ ( 'Wishlist Sidebar', 'mango' ),
        'id' => 'wishlist_sidebar',
        'before_widget' => '<div id="%1$s" class="page-sidebar %2$s">',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'after_widget' => '</div>'
    ) );
     register_sidebar ( array (
        'name' => __ ( 'Checkout Sidebar', 'mango' ),
        'id' => 'checkout_sidebar',
        'before_widget' => '<div id="%1$s" class="page-sidebar %2$s">',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'after_widget' => '</div>'
    ) );
    //product sidebar
    register_sidebar ( array (
        'name' => __ ( 'Single Product Sidebar', 'mango' ),
        'id' => 'single-product-sidebar',
        'before_widget' => '<div id="%1$s" class="page-sidebar %2$s">',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'after_widget' => '</div>'
    ) );
//Portfolio Sidebar
    register_sidebar ( array (
        'name' => __ ( 'Portfolio Page Sidebar', 'mango' ),
        'id' => 'portfolio-page-sidebar',
        'before_widget' => '<div id="%1$s" class="page-sidebar %2$s">',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'after_widget' => '</div>'
    ) );
//Footer Top Widgets
    register_sidebar ( array (
        'name' => __ ( 'Footer Top Widget 1', 'mango' ),
        'id' => 'footer_top_1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'after_widget' => '</div>'
    ) );
   register_sidebar ( array (
        'name' => __ ( 'Footer Top Widget 2', 'mango' ),
        'id' => 'footer_top_2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'after_widget' => '</div>'
    ) );
    register_sidebar ( array (
        'name' => __ ( 'Footer Top Widget 3', 'mango' ),
        'id' => 'footer_top_3',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'after_widget' => '</div>'
    ) );
    register_sidebar ( array (
        'name' => __ ( 'Footer Top Widget 4', 'mango' ),
        'id' => 'footer_top_4',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'after_widget' => '</div>'
    ) );
//Footer Top Widgets V2
    register_sidebar ( array (
        'name' => __ ( 'Footer Top Widget v2 1', 'mango' ),
        'id' => 'footer_top_v2_1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'after_widget' => '</div>'
    ) );
    register_sidebar ( array (
        'name' => __ ( 'Footer Top Widget v2 2', 'mango' ),
        'id' => 'footer_top_v2_2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'after_widget' => '</div>'
    ) );
    register_sidebar ( array (
        'name' => __ ( 'Footer Top Widget v2 3', 'mango' ),
        'id' => 'footer_top_v2_3',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'after_widget' => '</div>'
    ) );
    register_sidebar ( array (
        'name' => __ ( 'Footer Top Widget v3 4', 'mango' ),
        'id' => 'footer_top_v2_4',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'after_widget' => '</div>'
    ) );
//Footer Widgets
    register_sidebar ( array (
        'name' => __ ( 'Footer Widget 1', 'mango' ),
        'id' => 'footer_1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
        'after_widget' => '</div>'
    ) );
    register_sidebar ( array (
        'name' => __ ( 'Footer Widget 2', 'mango' ),
        'id' => 'footer_2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
        'after_widget' => '</div>'
    ) );
    register_sidebar ( array (
        'name' => __ ( 'Footer Widget 3', 'mango' ),
        'id' => 'footer_3',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
        'after_widget' => '</div>'
    ) );
    register_sidebar ( array (
        'name' => __ ( 'Footer Widget 4', 'mango' ),
        'id' => 'footer_4',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
        'after_widget' => '</div>'
    ) );
    register_sidebar ( array (
        'name' => __ ( 'Footer Widget 5', 'mango' ),
        'id' => 'footer_5',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
        'after_widget' => '</div>'
    ) );
}