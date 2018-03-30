<?php

// Widgets

get_template_part('inc/widgets/contact-info');
get_template_part('inc/widgets/facebook-like-widget');
get_template_part('inc/widgets/twitter-tweets-widget');
get_template_part('inc/widgets/flickr-widget');
get_template_part('inc/widgets/recent-posts-widget');
get_template_part('inc/widgets/recent-portfolios-widget');
get_template_part('inc/widgets/sidebar-menu-widget');

// Remove Default Widgets
function venedor_unregister_default_widgets() {
    //unregister_widget('WP_Widget_Recent_Posts');
}
//add_action('widgets_init', 'venedor_unregister_default_widgets', 11);

// Register sidebars and widgetized areas

register_sidebar( array(
    'name' => 'Home Sidebar',
    'id' => 'home-sidebar',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
) );

register_sidebar( array(
    'name' => 'Blog Sidebar',
    'id' => 'blog-sidebar',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
) );

register_sidebar( array(
    'name' => 'Portfolio Sidebar',
    'id' => 'portfolio-sidebar',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
) );

if ( class_exists( 'Woocommerce' ) ) {

register_sidebar( array(
    'name' => 'Woocommerce Sidebar',
    'id' => 'woocommerce-sidebar',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
) );

}

register_sidebar( array(
    'name' => 'Content Bottom Widget 1',
    'id' => 'content-bottom-1',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
) );

register_sidebar( array(
    'name' => 'Content Bottom Widget 2',
    'id' => 'content-bottom-2',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
) );

register_sidebar( array(
    'name' => 'Content Bottom Widget 3',
    'id' => 'content-bottom-3',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
) );

register_sidebar( array(
    'name' => 'Content Bottom Widget 4',
    'id' => 'content-bottom-4',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
) );

register_sidebar( array(
    'name' => 'Footer Top Widget',
    'id' => 'footer-top',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
) );

register_sidebar( array(
    'name' => 'Footer Widget 1',
    'id' => 'footer-column-1',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
) );

register_sidebar( array(
    'name' => 'Footer Widget 2',
    'id' => 'footer-column-2',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
) );

register_sidebar( array(
    'name' => 'Footer Widget 3',
    'id' => 'footer-column-3',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
) );

register_sidebar( array(
    'name' => 'Footer Widget 4',
    'id' => 'footer-column-4',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
) );

?>