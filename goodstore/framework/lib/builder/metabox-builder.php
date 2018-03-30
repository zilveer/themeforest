<?php

global $metapagebuild;

//TEMPLATES ====================================================================
//HOME =========================================================================
$home[] = array(
    "name" => "About Author",
    "desc" => '',
    "id" => "build_author",
    "type" => "builder",
    'desc' => '',
    "img" => THEME_FRAMEWORK_URI . '/lib/builder/assets/images/author.png',
    'icon' => 'icon-user4',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$home[] = array(
    "name" => "Big Blog",
    "desc" => '',
    "id" => "build_blog_big",
    "type" => "builder",
    "img" => THEME_FRAMEWORK_URI . '/lib/builder/assets/images/blog.png',
    "icon" => 'icon-newspaper',
    "sizes" => '9,12',
    "size" => 12
);

$home[] = array(
    "name" => "Blog",
    "desc" => '',
    "id" => "build_blog",
    "type" => "builder",
    "img" => THEME_FRAMEWORK_URI . '/lib/builder/assets/images/blog.png',
    "icon" => 'icon-newspaper',
    "sizes" => '4,8,12',
    "size" => 12
);

$home[] = array(
    "name" => "Button",
    "desc" => '',
    "id" => "build_button",
    'desc' => '',
    "img" => THEME_FRAMEWORK_URI . '/lib/builder/assets/images/button.png',
    "type" => "builder",
    'icon' => 'icon-radio-checked ',
    "sizes" => '1,2,3,4,5,6,7,8,9,10,11,12',
    "size" => 2
);

if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
    $home[] = array(
        "name" => "Contact Form 7",
        "desc" => '',
        "id" => "build_contact_form",
        "type" => "builder",
        "img" => THEME_FRAMEWORK_URI . '/lib/builder/assets/images/ContactForm.png',
        'icon' => 'icon-envelope3 ',
        "sizes" => '3,4,5,6,7,8,9,10,11,12',
        "size" => 12
    );
}

$home[] = array(
    "name" => "Custom Text",
    "desc" => '',
    "id" => "build_custom_text",
    "type" => "builder",
    'icon' => 'icon-pencil2',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$home[] = array(
    "name" => "Divider",
    "desc" => 'Divider line over whole page',
    "id" => "build_divider",
    "type" => "builder",
    "sizes" => 'false',
    "img" => THEME_FRAMEWORK_URI . '/lib/builder/assets/images/divider.png',
    "size" => 12,
    'icon' => 'icon-minus',
    'edit_name' => 'false'
);

$home[] = array(
    "name" => "Image",
    "desc" => '',
    "id" => "build_image",
    "type" => "builder",
    'icon' => 'icon-image',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);
$home[] = array(
    "name" => "Advanced List",
    "desc" => 'Advanced list',
    "id" => "build_list_advanced",
    "type" => "builder",
    'icon' => 'icon-list2',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$home[] = array(
    "name" => "List",
    "desc" => 'Classic ul list',
    "id" => "build_list",
    "type" => "builder",
    'icon' => 'icon-list2',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$home[] = array(
    "name" => "Page",
    "desc" => 'Page allows you to e.g. nested content from another RevoComposer into this content. So you can create rich structure of your homepage.',
    "id" => "build_page",
    "type" => "builder",
    'icon' => 'icon-file5',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$home[] = array(
    "name" => "Title",
    "desc" => '',
    "id" => "build_title",
    "type" => "builder",
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12,
    'icon' => 'icon-type ',
    'edit_name' => 'false'
);

$metabuild[] = array(
    "name" => "Composer",
    "desc" => '',
    "id" => "build_bookmark_home",
    "type" => "builder_bookmark",
    'content' => $home,
    "header" => false
);


//SOCIAL & MEDIA ===============================================================
$media[] = array(
    "name" => "Social Icons",
    "desc" => '',
    "id" => "build_social_icons",
    "type" => "builder",
    'desc' => '',
    "img" => THEME_FRAMEWORK_URI . '/lib/builder/assets/images/social.png',
    'icon' => 'icon-facebook4',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$media[] = array(
    "name" => "Vimeo Video",
    "desc" => '',
    "id" => "build_v_video",
    "type" => "builder",
    'icon' => 'icon-vimeo3',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$media[] = array(
    "name" => "YouTube Video",
    "desc" => '',
    "id" => "build_y_video",
    "type" => "builder",
    'icon' => 'icon-youtube',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$metabuild[] = array(
    "name" => "Social & Media",
    "desc" => '',
    "id" => "build_bookmark_media",
    "type" => "builder_bookmark",
    'content' => $media,
    "header" => false
);

//TEXT (content) ===============================================================
$content[] = array(
    "name" => "Accordion",
    "desc" => '',
    "id" => "build_accordion",
    "type" => "builder",
    'icon' => ' icon-stack-list ',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$content[] = array(
    "name" => "Blockquote",
    "desc" => 'Quotation of a large section',
    "img" => THEME_FRAMEWORK_URI . '/lib/builder/assets/images/quote.png',
    "id" => "build_quote",
    "type" => "builder",
    'icon' => 'icon-quotes-left',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$content[] = array(
    "name" => "Call to Action",
    "desc" => '',
    "img" => THEME_FRAMEWORK_URI . '/lib/builder/assets/images/cta.png',
    "id" => "build_cta",
    "type" => "builder",
    'icon' => 'icon-newspaper',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$content[] = array(
    "name" => "Google Fonts",
    "desc" => '',
    "id" => "googlefonts",
    "type" => "builder",
    'icon' => ' icon-font ',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$content[] = array(
    "name" => "Info Box",
    "desc" => '',
    "img" => THEME_FRAMEWORK_URI . '/lib/builder/assets/images/info_box.png',
    "id" => "build_panel_box",
    "type" => "builder",
    'icon' => ' icon-info ',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$content[] = array(
    "name" => "Message Text",
    "desc" => '',
    "img" => THEME_FRAMEWORK_URI . '/lib/builder/assets/images/message.png',
    "id" => "build_message",
    "type" => "builder",
    'icon' => 'icon-pen',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$content[] = array(
    "name" => "Tabs",
    "desc" => '',
    "id" => "build_tabs",
    "type" => "builder",
    "desc" => '',
    "img" => THEME_FRAMEWORK_URI . '/lib/builder/assets/images/tabs.png',
    'icon' => 'icon-insert-template',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$metabuild[] = array(
    "name" => "Text Content",
    "desc" => '',
    "id" => "build_bookmark_content",
    "type" => "builder_bookmark",
    'content' => $content,
    "header" => false
);

//Featured =====================================================================
$featured[] = array(
    "name" => "Bing Maps",
    "desc" => '',
    "img" => THEME_FRAMEWORK_URI . '/lib/builder/assets/images/bing_map.png',
    "id" => "build_bing_map",
    "type" => "builder",
    'icon' => 'icon-map2',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$featured[] = array(
    "name" => "Circle Chart",
    "desc" => '',
    "id" => "build_circle_chart",
    "type" => "builder",
    'icon' => 'icon-pie',
    "sizes" => '3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$featured[] = array(
    "name" => "Comments",
    "desc" => '',
    "id" => "build_comments",
    "type" => "builder",
    'icon' => 'icon-bubbles5 ',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$featured[] = array(
    "name" => "Contact",
    "desc" => '',
    "id" => "build_contact",
    "type" => "builder",
    'icon' => 'icon-phone ',
    "sizes" => '3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$featured[] = array(
    "name" => "Countdown",
    "desc" => '',
    "img" => THEME_FRAMEWORK_URI . '/lib/builder/assets/images/countdown.png',
    "id" => "build_countdown",
    "type" => "builder",
    'icon' => 'icon-clock ',
    "sizes" => '3,4,5,6,7,8,9,10,11,12',
    "size" => 6
);

$featured[] = array(
    "name" => "Custom Banner",
    "desc" => '',
    "id" => "build_banner",
    "type" => "builder",
    'icon' => 'icon-file8 ',
    "sizes" => '3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$featured[] = array(
    "name" => "Custom Code",
    "desc" => '',
    "id" => "build_custom_code",
    "type" => "builder",
    'icon' => 'icon-code',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$featured[] = array(
    "name" => "Gallery",
    "desc" => '',
    "id" => "build_gallery",
    "type" => "builder",
    'icon' => 'icon-images2',
    "sizes" => '3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$featured[] = array(
    "name" => "Google Maps",
    "desc" => '',
    "img" => THEME_FRAMEWORK_URI . '/lib/builder/assets/images/google_map.png',
    "id" => "build_google_map",
    "type" => "builder",
    'icon' => 'icon-map',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$featured[] = array(
    "name" => "Icon",
    "desc" => '',
    "id" => "build_icon",
    "type" => "builder",
    'icon' => 'icon-IcoMoon',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$featured[] = array(
    "name" => "Iframe",
    "desc" => '',
    "id" => "build_iframe",
    "type" => "builder",
    'icon' => 'icon-file3',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$featured[] = array(
    "name" => "Inline Sidebar",
    "desc" => 'With this you can put widget to page content',
    "id" => "build_sidebar",
    "type" => "builder",
    'icon' => 'icon-file ',
    "sizes" => '3,4',
    "size" => 4
);

$featured[] = array(
    "name" => "Login & Registration Form",
    "desc" => '',
    "id" => "build_login",
    "type" => "builder",
    "img" => THEME_FRAMEWORK_URI . '/lib/builder/assets/images/login.png',
    'icon' => 'icon-lock4',
    "sizes" => '3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$featured[] = array(
    "name" => "QRcode",
    "desc" => '',
    "id" => "build_qrcode",
    "type" => "builder",
    'icon' => 'icon-qrcode  ',
    "img" => THEME_FRAMEWORK_URI . '/lib/builder/assets/images/qrcode.png',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 2
);

$featured[] = array(
    "name" => "Paralax",
    "desc" => '',
    "id" => "build_paralax_text",
    "type" => "builder",
    'icon' => 'icon-image2',
    "sizes" => '12',
    "size" => 12
);

$featured[] = array(
    "name" => "Paralax video",
    "desc" => '',
    "id" => "build_paralax_video",
    "type" => "builder",
    'icon' => 'icon-play4',
    "sizes" => '12',
    "size" => 12
);

$featured[] = array(
    "name" => "Progress Bar",
    "desc" => '',
    "id" => "build_progressbar",
    "type" => "builder",
    'icon' => 'icon-bars2 ',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$featured[] = array(
    "name" => "Shortcode",
    "desc" => '',
    "id" => "build_shortcode",
    "type" => "builder",
    'icon' => 'icon-file-css',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

if (is_plugin_active('wysija-newsletters/index.php')) {
    $featured[] = array(
        "name" => "Wysija Newsletter Form",
        "desc" => '',
        "img" => THEME_FRAMEWORK_URI . '/lib/builder/assets/images/newsletter.png',
        "id" => "build_wysija_form",
        "type" => "builder",
        'icon' => 'icon-envelope3',
        "sizes" => '3,4,5,6,7,8,9,10,11,12',
        "size" => 3
    );
}

$metabuild[] = array(
    "name" => "Features",
    "desc" => '',
    "id" => "build_bookmark_featured",
    "type" => "builder_bookmark",
    'content' => $featured,
    "header" => false
);

//Post types ===================================================================
$post_types[] = array(
    "name" => "FAQ",
    "desc" => '',
    "id" => "build_faq",
    "type" => "builder",
    "img" => THEME_FRAMEWORK_URI . '/lib/builder/assets/images/faq.png',
    'icon' => ' icon-question ',
    "sizes" => '3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$post_types[] = array(
    "name" => "Portfolio",
    "desc" => '',
    "id" => "build_portfolio",
    "img" => THEME_FRAMEWORK_URI . '/lib/builder/assets/images/portfolio.png',
    "type" => "builder",
    'icon' => 'icon-notebook',
    "sizes" => '4,8,12',
    "size" => 12
);

$post_types[] = array(
    "name" => "Team",
    "desc" => '',
    "id" => "build_team",
    "type" => "builder",
    "img" => THEME_FRAMEWORK_URI . '/lib/builder/assets/images/team.png',
    'icon' => 'icon-users4 ',
    "sizes" => '3,6,9,12',
    "size" => 12
);

$post_types[] = array(
    "name" => "Testimonial",
    "desc" => '',
    "id" => "build_testimonial",
    "type" => "builder",
    "img" => THEME_FRAMEWORK_URI . '/lib/builder/assets/images/testimonial.png',
    'icon' => 'icon-bubble6 ',
    "sizes" => '4,8,12',
    "size" => 12
);

$metabuild[] = array(
    "name" => "Post Types",
    "desc" => '',
    "id" => "build_bookmark_post_types",
    "type" => "builder_bookmark",
    'content' => $post_types,
    "header" => false
);

// CAROUSELS ===================================================================
$carousel[] = array(
    "name" => "Custom HTML Carousel",
    "desc" => '',
    "id" => "build_html_carousel",
    "type" => "builder",
    'icon' => 'icon-stack-picture ',
    "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
    "size" => 12
);

$carousel[] = array(
    "name" => "Blog Carousel",
    "desc" => '',
    "id" => "build_blog_carousel",
    "type" => "builder",
    'icon' => 'icon-stack-picture ',
    "sizes" => '4,8,12',
    "size" => 12
);

$carousel[] = array(
    "name" => "Blog Carousel Vertical",
    "desc" => '',
    "id" => "build_blog_carousel_vertical",
    "type" => "builder",
    'icon' => 'icon-stack-picture ',
    "sizes" => '4,8,12',
    "size" => 12
);

$carousel[] = array(
    "name" => "Testimonial Carousel",
    "desc" => '',
    "id" => "build_testimonial_carousel",
    "type" => "builder",
    'icon' => 'icon-stack-picture ',
    "sizes" => '4,8,12',
    "size" => 12
);

$carousel[] = array(
    "name" => "Testimonial Carousel Vertical",
    "desc" => '',
    "id" => "build_testimonial_carousel_vertical",
    "type" => "builder",
    'icon' => 'icon-stack-picture ',
    "sizes" => '4,8,12',
    "size" => 12
);

if (class_exists('WooCommerce')) {
    $carousel[] = array(
        "name" => "Small WooCommerce Products Carousel",
        "desc" => '',
        "id" => "build_woo_carousel_small",
        "type" => "builder",
        'icon' => 'icon-stack-picture ',
        "sizes" => '2,4,6,8,10,12',
        "size" => 12
    );

    $carousel[] = array(
        "name" => "Small WooCommerce Products Carousel Vertical",
        "desc" => '',
        "id" => "build_woo_carousel_vertical_small",
        "type" => "builder",
        'icon' => 'icon-stack-picture ',
        "sizes" => '2,4,6,8,10,12',
        "size" => 12
    );

    $carousel[] = array(
        "name" => "WooCommerce Products Carousel",
        "desc" => '',
        "id" => "build_woo_carousel",
        "type" => "builder",
        'icon' => 'icon-stack-picture ',
        "sizes" => '3,6,9,12',
        "size" => 12
    );

    $carousel[] = array(
        "name" => "WooCommerce Products Carousel Vertical",
        "desc" => '',
        "id" => "build_woo_carousel_vertical",
        "type" => "builder",
        'icon' => 'icon-stack-picture ',
        "sizes" => '3,6,9,12',
        "size" => 12
    );
}

$metabuild[] = array(
    "name" => "Carousels",
    "desc" => '',
    "id" => "build_carousel",
    "type" => "builder_bookmark",
    'content' => $carousel,
    "header" => false
);

// Slider submenu ==============================================================
$sliders[] = array(
    "name" => "JaW Slider",
    "desc" => '',
    "id" => "build_slider",
    "type" => "builder",
    'icon' => 'icon-notebook',
    "sizes" => '12',
    "size" => 12,
);

$sliders[] = array(
    "name" => "JaW Grid",
    "desc" => '',
    "id" => "build_grid",
    "type" => "builder",
    'icon' => 'icon-table2',
    "sizes" => '12',
    "size" => 12,
);

if (is_plugin_active('revslider/revslider.php')) {
    $sliders[] = array(
        "name" => "Revolution Slider",
        "desc" => '',
        "id" => "build_slider_revolution",
        "type" => "builder",
        'icon' => 'icon-notebook',
        "sizes" => '3,4,5,6,7,8,9,10,11,12',
        "size" => 12,
    );
}
if (class_exists('Essential_Grid')) {
    $sliders[] = array(
        "name" => "Essential Grid",
        "desc" => '',
        "id" => "build_ess_grid",
        "type" => "builder",
        'icon' => 'icon-table2',
        "sizes" => '3,4,5,6,7,8,9,10,11,12',
        "size" => 12,
    );
}

if (isset($sliders)) {
    $metabuild[] = array(
        "name" => "Sliders",
        "desc" => '',
        "id" => "build_slider",
        "type" => "builder_bookmark",
        'content' => $sliders,
        "header" => false
    );
}

// WOO submenu =================================================================

if (class_exists('WooCommerce')) {
    $woo[] = array(
        "name" => "Order Tracking",
        "desc" => '',
        "id" => "build_woo_order_tracking",
        "type" => "builder",
        "icon" => 'icon-location',
        "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
        "size" => 12,
    );
    $woo[] = array(
        "name" => "Product Price/Cart Button",
        "desc" => '',
        "id" => "build_woo_product_button",
        "type" => "builder",
        "icon" => ' icon-coin ',
        "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
        "size" => 12,
    );

    $woo[] = array(
        "name" => "Big Products by SKU/ID",
        "desc" => '',
        "id" => "build_woo_products_by_big",
        "type" => "builder",
        "icon" => 'icon-bag ',
        "sizes" => '3,6,9,12',
        "size" => 12,
    );

    $woo[] = array(
        "name" => "Small Products by SKU/ID",
        "desc" => '',
        "id" => "build_woo_products_by_small",
        "type" => "builder",
        "icon" => 'icon-bag ',
        "sizes" => '2,4,6,8,10,12',
        "size" => 12,
    );

    $woo[] = array(
        "name" => "List of Products by SKU/ID",
        "desc" => '',
        "id" => "build_woo_products_by_list",
        "type" => "builder",
        "icon" => 'icon-bag ',
        "sizes" => '9',
        "size" => 9,
    );

    $woo[] = array(
        "name" => "Product Categories",
        "desc" => '',
        "id" => "build_woo_product_categories",
        "type" => "builder",
        "icon" => 'icon-basket ',
        "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
        "size" => 12,
    );

    $woo[] = array(
        "name" => "Big Products by Category Slug",
        "desc" => '',
        "id" => "build_woo_product_by_category_big",
        "type" => "builder",
        "icon" => 'icon-cart',
        "sizes" => '3,6,9,12',
        "size" => 12,
    );
    
    $woo[] = array(
        "name" => "Small Sale Products",
        "desc" => '',
        "id" => "build_woo_sale_products_small",
        "type" => "builder",
        "icon" => 'icon-coin ',
        "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
        "size" => 12,
    );

    $woo[] = array(
        "name" => "Big Sale Products",
        "desc" => '',
        "id" => "build_woo_sale_products_big",
        "type" => "builder",
        "icon" => 'icon-coin',
        "sizes" => '3,6,9,12',
        "size" => 12,
    );


    $woo[] = array(
        "name" => "Small Products by Category Slug",
        "desc" => '',
        "id" => "build_woo_product_by_category_small",
        "type" => "builder",
        "icon" => 'icon-cart',
        "sizes" => '2,4,6,8,10,12',
        "size" => 12,
    );

    $woo[] = array(
        "name" => "List Products by Category Slug",
        "desc" => '',
        "id" => "build_woo_product_by_category_list",
        "type" => "builder",
        "icon" => 'icon-cart',
        "sizes" => '9',
        "size" => 9,
    );

    $woo[] = array(
        "name" => "Big Recent Product",
        "desc" => '',
        "id" => "build_woo_recent_product_big",
        "type" => "builder",
        "icon" => 'icon-cart-checkout ',
        "sizes" => '3,6,9,12',
        "size" => 12,
    );

    $woo[] = array(
        "name" => "Small Recent Product",
        "desc" => '',
        "id" => "build_woo_recent_product_small",
        "type" => "builder",
        "icon" => 'icon-cart-checkout ',
        "sizes" => '2,4,6,8,10,12',
        "size" => 12,
    );
    $woo[] = array(
        "name" => "List Recent Product",
        "desc" => '',
        "id" => "build_woo_recent_product_list",
        "type" => "builder",
        "icon" => 'icon-cart-checkout ',
        "sizes" => '9',
        "size" => 9,
    );

    $woo[] = array(
        "name" => "Big Featured Products",
        "desc" => '',
        "id" => "build_woo_featured_products_big",
        "type" => "builder",
        "icon" => 'icon-star3 ',
        "sizes" => '3,6,9,12',
        "size" => 12,
    );

    $woo[] = array(
        "name" => "Small Featured Products",
        "desc" => '',
        "id" => "build_woo_featured_products_small",
        "type" => "builder",
        "icon" => 'icon-star3',
        "sizes" => '2,4,6,8,10,12',
        "size" => 12,
    );
    $woo[] = array(
        "name" => "List Featured Products",
        "desc" => '',
        "id" => "build_woo_featured_products_list",
        "type" => "builder",
        "icon" => 'icon-star3',
        "sizes" => '9',
        "size" => 9,
    );

    $woo[] = array(
        "name" => "Shop Mesages",
        "desc" => '',
        "id" => "build_woo_messages",
        "type" => "builder",
        "icon" => 'icon-pencil',
        "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
        "size" => 12,
    );

    $woo[] = array(
        "name" => "Woo Page",
        "desc" => '',
        "id" => "build_woo_page",
        "type" => "builder",
        "icon" => 'icon-file5',
        "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
        "size" => 12,
    );

    if (is_plugin_active('yith-woocommerce-wishlist/init.php')) {
        $woo[] = array(
            "name" => "Wishlist",
            "desc" => '',
            "id" => "build_woo_wishlist",
            "type" => "builder",
            "icon" => 'icon-gift',
            "sizes" => '2,3,4,5,6,7,8,9,10,11,12',
            "size" => 12,
        );
    }

    $metabuild[] = array(
        "name" => "WooCommerce ",
        "desc" => '',
        "id" => "build_woo",
        "type" => "builder_bookmark",
        'content' => $woo,
        "header" => false
    );
}

$all_items = array_merge($home, $media, $content, $featured, $post_types, $carousel, ((isset($sliders) && is_array($sliders)) ? $sliders : array()), ((isset($woo) && is_array($woo)) ? $woo : array()), ((isset($edd) && is_array($edd)) ? $edd : array()));

// all button ==================================================================
$metabuild[] = array(
    "name" => "All",
    "desc" => '',
    "id" => "build_all",
    "type" => "builder_bookmark",
    'content' => jwUtils::aasort($all_items, "name"),
    "header" => false
);

// LIVE button =================================================================
$metabuild[] = array(
    "name" => "LIVE Preview",
    "desc" => '',
    "id" => "revo_composer_live",
    "type" => "revo_composer_live",
    'icon' => 'icon-eye ',
    'ng-click' => 'switch_live_preview()',
    "header" => false,
    'row' => '0'
);

// ELEMENT PRESSETS ====================================================================

$elements_presets[] = array(
    "name" => "Presets",
    "desc" => "",
    "id" => "build_element_presets",
    "std" => 'blog',
    "type" => "element_preset",
    "extend" => 'jaw-pb-sidebar',
    "header" => false,
    "template" => 'true',
    "options" => array()
);

$metabuild[] = array(
    "name" => "  Element Presets",
    "desc" => '',
    "id" => "build_element_preset_bookmark",
    "type" => "builder_bookmark",
    'content' => $elements_presets,
    'icon' => 'icon-book2 ',
    "header" => false
);


// PRESSETS ====================================================================
$presets[] = array(
    "name" => "Presets",
    "desc" => "",
    "id" => "build_presets",
    "std" => 'blog',
    "type" => "preset",
    "extend" => 'jaw-pb-sidebar',
    "header" => false,
    "template" => 'true',
    "options" => array(//'CONTENT' MUSÍ BÝT ZADÁN S DVOJTÝMI UVOZOVKAMI: "  - jinak katastrofa
        'none' => array(
            'img' => ADMIN_DIR . 'assets/images/none.png',
            'layout' => 'fullwidth',
            'layout-size' => array("left1" => array("name" => "sidebar", "size" => 3), "left2" => array("name" => "sidebar", "size" => 3), "right1" => array("name" => "sidebar", "size" => 3), "right2" => array("name" => "sidebar", "size" => 3)),
            'content' => array()
        )
    )
);

$metabuild[] = array(
    "name" => "  Presets",
    "desc" => '',
    "id" => "build_preset_bookmark",
    "type" => "builder_bookmark",
    'content' => $presets,
    'icon' => 'icon-book2 ',
    "header" => false
);

// LAYOUT ======================================================================
$layout[] = array(
    "name" => "Page Layout",
    "desc" => "",
    "id" => "build_layout",
    "type" => "layout_pb",
    "extend" => 'jaw-pb-sidebar',
    "header" => false,
    "template" => 'true',
    "options" => array(
        'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
        'left1' => ADMIN_DIR . 'assets/images/left_sidebar.gif',
        'right1' => ADMIN_DIR . 'assets/images/right_sidebar.gif',
        'left1_right1' => ADMIN_DIR . 'assets/images/right_left_sidebar.gif',
        'left1_left2' => ADMIN_DIR . 'assets/images/left_left_sidebar.gif',
        'right1_right2' => ADMIN_DIR . 'assets/images/right_right_sidebar.gif',
        'left1_left2_right1' => ADMIN_DIR . 'assets/images/left_left_right_sidebar.gif',
        'left1_right1_right2' => ADMIN_DIR . 'assets/images/left_right_right_sidebar.gif'
    )
);

$metabuild[] = array(
    "name" => "  Page Layout",
    "desc" => '',
    "id" => "build_layout_bookmark",
    "type" => "builder_bookmark",
    'content' => $layout,
    'icon' => 'icon-table2 ',
    "header" => false
);



$metapagebuild = array(
    "id" => "jaw_page_builder",
    "type" => "page_builder",
    "title" => "RevoComposer", //"Ultra Mega Awesome Greatest Smartest Page builder",
    "pages" => array('page', 'themeoptions'),
    "context" => "normal", //Optional. The context within the page where the boxes should show ('normal', 'advanced')
    "priority" => "high", //Optional. The priority within the context where the boxes should show ('high', 'low').
    "desc" => null,
    "fields" => $metabuild
);

