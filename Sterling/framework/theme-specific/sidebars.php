<?php
function truethemes_widgets_init() {

register_sidebar( array(
'name' => __( 'Top Left Toolbar', 'tt_theme_framework' ),
'description' => __( 'This sidebar is displayed in the top left region above the logo.', 'tt_theme_framework' ),
'before_widget' => '<div class="sidebar-widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<span class="display-none">',
'after_title' => '</span>',
));

register_sidebar( array(
'name' => __( 'Top Right Toolbar', 'tt_theme_framework' ),
'description' => __( 'This sidebar is displayed in the top right region above the navigation.', 'tt_theme_framework' ),
'before_widget' => '<div class="sidebar-widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<span class="display-none">',
'after_title' => '</span>',
));

register_sidebar( array(
'name' => __( 'Homepage Sidebar', 'tt_theme_framework' ),
'description' => __( 'This sidebar is displayed in the homepage. (sidebar template required)', 'tt_theme_framework' ),
'before_widget' => '<div class="sidebar-widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<p class="widget-heading">',
'after_title' => '</p>',
));

register_sidebar( array(
'name' => __( 'Blog Sidebar', 'tt_theme_framework' ),
'description' => __( 'This sidebar is displayed on all Blog pages.', 'tt_theme_framework' ),
'before_widget' => '<div class="sidebar-widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<p class="widget-heading">',
'after_title' => '</p>',
));

register_sidebar( array(
'name' => __( 'Contact Sidebar', 'tt_theme_framework' ),
'description' => __( 'This sidebar is displayed on the contact page.', 'tt_theme_framework' ),
'before_widget' => '<div class="sidebar-widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<p class="widget-heading">',
'after_title' => '</p>',
));

register_sidebar( array(
'name' => __( 'Search Results Sidebar', 'tt_theme_framework' ),
'description' => __( 'This sidebar is displayed on the Search Results page.', 'tt_theme_framework' ),
'before_widget' => '<div class="sidebar-widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<p class="widget-heading">',
'after_title' => '</p>',
));

register_sidebar( array(
'name' => __( 'First Footer Column', 'tt_theme_framework' ),
'description' => __( 'First Footer Column.', 'tt_theme_framework' ),
'before_widget' => '<div class="sidebar-widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<p class="foot-heading">',
'after_title' => '</p>',
));

register_sidebar( array(
'name' => __( 'Second Footer Column', 'tt_theme_framework' ),
'description' => __( 'Second Footer Column.', 'tt_theme_framework' ),
'before_widget' => '<div class="sidebar-widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<p class="foot-heading">',
'after_title' => '</p>',
));

register_sidebar( array(
'name' => __( 'Third Footer Column', 'tt_theme_framework' ),
'description' => __( 'Third Footer Column.', 'tt_theme_framework' ),
'before_widget' => '<div class="sidebar-widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<p class="foot-heading">',
'after_title' => '</p>',
));

register_sidebar( array(
'name' => __( 'Fourth Footer Column', 'tt_theme_framework' ),
'description' => __( 'Fourth Footer Column.', 'tt_theme_framework' ),
'before_widget' => '<div class="sidebar-widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<p class="foot-heading">',
'after_title' => '</p>',
));

register_sidebar( array(
'name' => __( 'Fifth Footer Column', 'tt_theme_framework' ),
'description' => __( 'Fifth Footer Column.', 'tt_theme_framework' ),
'before_widget' => '<div class="sidebar-widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<p class="foot-heading">',
'after_title' => '</p>',
));

register_sidebar( array(
'name' => __( 'First Under Construction Column', 'tt_theme_framework' ),
'description' => __( 'First Under Construction Column.', 'tt_theme_framework' ),
'before_widget' => '<div class="sidebar-widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<p class="foot-heading">',
'after_title' => '</p>',
));

register_sidebar( array(
'name' => __( 'Second Under Construction Column', 'tt_theme_framework' ),
'description' => __( 'Second Under Construction Column.', 'tt_theme_framework' ),
'before_widget' => '<div class="sidebar-widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<p class="foot-heading">',
'after_title' => '</p>',
));

register_sidebar( array(
'name' => __( 'Third Under Construction Column', 'tt_theme_framework' ),
'description' => __( 'Third Under Construction Column.', 'tt_theme_framework' ),
'before_widget' => '<div class="sidebar-widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<p class="foot-heading">',
'after_title' => '</p>',
));

// START Woo-check
if (class_exists('woocommerce')){
//since version 1.0.6.
//%2$s is needed for widget class to be added by woocommence or any other plugin.
//In this case, this is needed for ajax add to cart on shop page to work.
//probably need to add to all other sidebars.
register_sidebar( array(
'name' => __( 'WooCommerce Sidebar', 'tt_theme_framework' ),
'description' => __( 'This sidebar is displayed on your WooCommerce pages.', 'tt_theme_framework' ),
'before_widget' => '<div class="sidebar-widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<p class="widget-heading">',
'after_title' => '</p>',
));

register_sidebar( array(
'name' => __( 'WooCommerce - Cart + Checkout', 'tt_theme_framework' ),
'description' => __( 'This sidebar is displayed on your WooCommerce Shopping Cart and Checkout pages.', 'tt_theme_framework' ),
'before_widget' => '<div class="sidebar-widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<p class="widget-heading">',
'after_title' => '</p>',
));

} // END Woo-check

}
add_action( 'widgets_init', 'truethemes_widgets_init' );