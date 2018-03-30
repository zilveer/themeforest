<?php

// Register sidebars and widgetized areas

add_action('widgets_init', 'porto_register_sidebars');

function porto_register_sidebars() {
    register_sidebar( array(
        'name' => __('Blog Sidebar', 'porto'),
        'id' => 'blog-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __('Home Sidebar', 'porto'),
        'id' => 'home-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    if ( class_exists( 'Woocommerce' ) ) {

        register_sidebar( array(
            'name' => __('Woo Category Sidebar', 'porto'),
            'id' => 'woo-category-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );

        register_sidebar( array(
            'name' => __('Woo Product Sidebar', 'porto'),
            'id' => 'woo-product-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );

    }

    register_sidebar( array(
        'name' => __('Content Bottom Widget 1', 'porto'),
        'id' => 'content-bottom-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __('Content Bottom Widget 2', 'porto'),
        'id' => 'content-bottom-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __('Content Bottom Widget 3', 'porto'),
        'id' => 'content-bottom-3',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __('Content Bottom Widget 4', 'porto'),
        'id' => 'content-bottom-4',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __('Footer Top Widget', 'porto'),
        'id' => 'footer-top',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __('Footer Widget 1', 'porto'),
        'id' => 'footer-column-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __('Footer Widget 2', 'porto'),
        'id' => 'footer-column-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __('Footer Widget 3', 'porto'),
        'id' => 'footer-column-3',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __('Footer Widget 4', 'porto'),
        'id' => 'footer-column-4',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __('Footer Bottom Widget', 'porto'),
        'id' => 'footer-bottom',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}

add_filter('dynamic_sidebar_params', 'porto_add_classes_to_widget');
function porto_add_classes_to_widget($params){
    if ($params[0]['widget_name'] == __("MailPoet Subscription Form", 'wysija-newsletters') || $params[0]['widget_name'] == "MailPoet Subscription Form") {
        $params[0]['before_widget'] = $params[0]['before_widget'] . '<div class="box-content">';
        $params[0]['after_widget'] = '</div>' . $params[0]['after_widget'];
    }
    return $params;
}