<?php

$options = array();

/* GENERAL ******************************************************* */
$options[] = array("name" => "General Settings",
    "type" => "headingstart");


$options[] = array(
    'id' => 'theme_style',
    'type' => 'toggle',
    'name' => 'Theme Style',
    'desc' => 'Select the theme style you prefer.' . jwUtils::getHelp("2_1-Theme_Style"),
    'std' => 'fullwidth',
    "options" => array("fullwidth" => "Full Width", "boxed" => "Boxed")
);

$options[] = array(
    'id' => 'wide_mode',
    'type' => 'toggle',
    'name' => 'Wide Version',
    'desc' => 'Decide whether or not to use wide version of the theme.',
    'std' => '1',
    "options" => array("1" => "On", "0" => "Off")
);

$options[] = array("name" => "Favicon",
    "desc" => "Upload a 16px &times; 16px PNG/GIF image that will represent your website's favicon.",
    "id" => "custom_favicon",
    "std" => "",
    "type" => "upload");

$options[] = array(
    'id' => 'totop_show',
    'type' => 'toggle',
    'name' => 'To Top Arrow '. jwUtils::getHelp("", "totop.JPG"),
    'desc' => 'Choose whether or not to show the "To Top" arrow.' . jwUtils::getHelp("2_1-To_Top_Arrow"),
    'std' => '0'
);

$options[] = array(
    'id' => 'totop_show_mobile',
    'type' => 'toggle',
    'name' => 'To Top Arrow on Mobile Devices',
    'desc' => 'Choose whether or not to show the "To Top" arrow on mobile devices.',
    'std' => '0'
);

$options[] = array(
    'id' => 'theme_revoComposer',
    'type' => 'toggle',
    'name' => 'Use RevoComposer '. jwUtils::getHelp("", "revocomposer.JPG"),
    'desc' => 'Decide whether or not to enable use of the RevoComposer page builder.',
    'std' => '1',
    "options" => array("1" => "On", "0" => "Off")
);


$options[] = array(
    'id' => 'use_selectric',
    'type' => 'toggle',
    'name' => 'Use Selectric '. jwUtils::getHelp("", "selectric.JPG"),
    'desc' => 'Beautifully selectboxes. If you have some conflict with our selectboxes, please turn it off.',
    'std' => '1',
    "options" => array("1" => "On", "0" => "Off")
);

$options[] = array(
    "name" => "Login",
    "type" => "sectionstart");

$options[] = array(
    "name" => "Redireecting info",
    "id" => "redirecting-wp-login",
    "text" => '<h3><span style="font-weight:bold;color:#D6492F;">Please read before you change it!</span></h3> If you set Hide WP login after you type wrong credentials, you will be redirected to your custom page and when you type /wp-admin (e.g. http://your_site.com/wp-admin), you will be redirected to your custom page as well. So you will be not able to see classic wordpress login page. Please be cautious.',
    "type" => "info",
    "space" => false,
    "message" => "info"
);

$options[] = array(
    'id' => 'redirect_after_wrong_login',
    'type' => 'select',
    'name' => 'Where to redirect after wrong login',
    'desc' => '',
    'std' => 'wp-login',
    "options" => array("wp" => "Wp-login page", "another" => "Another page (define below)")
);

$options[] = array(
    'id' => 'wrong_login_wp_showhide',
    'type' => 'toggle',
    'name' => 'Show / Hide WP Login page '. jwUtils::getHelp("", "wpLoginPage.JPG"),
    'desc' => 'You can choose if you want to show or hide classic wordpress login due to settings below.<span style="font-weight:bold;color:#D6492F;">Be cautious</span> this will be active only if you set page id!</span>',
    'std' => '1',
    "options" => array("1" => "Show", "0" => "Hide")
);

$options[] = array(
    "name" => "Page id After Wrong Login",
    "desc" => "Which page will be showed after enter wrong login. Default is actual page.",
    "id" => "wrong_login_pageid",
    "std" => "",
    "mod" => "medium",
    "type" => "text"
);

$options[] = array(
    "type" => "sectionend");

  $options[] = array(
  'id' => 'isotope_grid',
  'type' => 'toggle',
  'name' => 'Use Masonry or Grid',
  'desc' => 'Use Masonry sorting effect on product or blog page',
  'std' => 'masonry',
  "options" => array("masonry" => "Masonry", "fitRows" => "Grid")
  );
  
  $options[] = array(
    'id' => 'hide_sliders',
    'type' => 'toggle',
    'name' => 'Hide sliders on phones',
    'desc' => '',
    'std' => 'show-sliders',
    "options" => array("hide-sliders" => "Hide", "show-sliders" => "Show")
);
 
$options[] = array("type" => "headingend");
/* GENERAL END ****************************************************** */

/* Header Settings ************************************************** */
$options[] = array("name" => "Header Settings",
    "type" => "headingstart");

$options[] = array(
    'id' => 'header_style',
    "type" => "layout",
    'name' => 'Header Style',
    'desc' => 'Select the header preset style that best suits your needs. There are several combinations of elements and their placement in your site&acute;s header.',
    'std' => 'header-small-444',
    "extend" => 'search_and_archive_sidebar',
    "options" => array(
        'header-big' => ADMIN_DIR . 'assets/images/Big.png',
        'header-small-center' => ADMIN_DIR . 'assets/images/4-l-4.png',
        'header-small-center-search' => ADMIN_DIR . 'assets/images/4-l-4-s.png',
        'header-small-48' => ADMIN_DIR . 'assets/images/l-8.png',
        'header-small-84' => ADMIN_DIR . 'assets/images/l-4.png',
        'header-small-444' => ADMIN_DIR . 'assets/images/l-4-4.png',
        'header-small-66' => ADMIN_DIR . 'assets/images/l-6.png'
    )
);

$options[] = array(
    'id' => 'header_widget_area',
    'type' => 'toggle',
    'name' => 'Header Widget Area',
    'desc' => 'Turn on or off widget positions in the header.',
    'std' => 'on',
    "options" => array("on" => "On", "off" => "Off")
);

$options[] = array(
    "name" => "Top Bar",
    "type" => "sectionstart");

$options[] = array(
    'id' => 'top_bar',
    'type' => 'toggle',
    'name' => 'Top Bar Visible '. jwUtils::getHelp("", "topBar.JPG"),
    'desc' => 'Turn on this option if you want to display the topmost bar.' . jwUtils::getHelp("2_2-Top_Bar"),
    'std' => 'on',
    "options" => array("on" => "On", "off" => "Off")
);

$options[] = array(
    'id' => 'top_bar_fix',
    'type' => 'toggle',
    'name' => 'Fixed Top Bar',
    'desc' => 'If turned on, the bar is permanently shown at the top independently on scrolling the page.',
    'std' => '0'
);

$options[] = array("name" => "Top Bar Span Icon " . jwUtils::getHelp("", "TopBarSpanIcon.jpg"),
    "desc" => "Enter the class of the icon you want to show in the top bar.",
    "id" => "top_bar_span_icon",
    "std" => "",
    "mod" => "medium",
    "type" => "icon"
);

$options[] = array("name" => "Top Bar Span Text " . jwUtils::getHelp("", "TopBarSpanText.jpg"),
    "desc" => "Fill in this field with the text you want to show next to the icon.",
    "id" => "top_bar_span_text",
    "std" => "",
    "mod" => "medium",
    "type" => "text"
);

$options[] = array(
    'id' => 'top_bar_login_button',
    'type' => 'toggle',
    'name' => 'Show Login Button',
    'desc' => 'Choose whether or not to show login button in the top bar.',
    'std' => '0'
);
$options[] = array(
    "name" => "Page ID After Login",
    "desc" => "Which page will be showed after click on login in top bar. Default is WP admin page.",
    "id" => "top_bar_login_pageid",
    "std" => "",
    "mod" => "medium",
    "type" => "text"
);

$options[] = array(
    'id' => 'top_bar_logout',
    'type' => 'toggle',
    'name' => 'Show Logout in "My Account" menu',
    'desc' => 'Show Logout in "My Account" menu.',
    'std' => '0'
);
    
$options[] = array(
    "name" => "Page ID After Logout",
    "desc" => "Which page will be showed after click on logout in top bar My Account menu. Default is WP login page.",
    "id" => "top_bar_logout_pageid",
    "std" => "",
    "mod" => "medium",
    "type" => "text"
);


if (is_plugin_active('yith-woocommerce-wishlist/init.php')) {
    $options[] = array(
        'id' => 'top_bar_wishllist',
        'type' => 'toggle',
        'name' => 'Show Wishlist Content',
        'desc' => 'Choose whether or not to show a wishlist content button in the top bar.',
        'std' => '1'
    );
}
if (class_exists('YITH_Woocompare')) {
    $options[] = array(
        'id' => 'top_bar_compare',
        'type' => 'toggle',
        'name' => 'Show Compare button',
        'desc' => 'Choose whether or not to show a compare button in the top bar.',
        'std' => '0'
    );
}

if (class_exists('WooCommerce')) {
    $top_cart['woo'] = "On";
}
$top_cart['off'] = 'Off';
if (class_exists('WooCommerce')) {
    $options[] = array(
        'id' => 'top_bar_cart',
        'type' => 'toggle',
        'name' => 'Show Cart Content',
        'desc' => 'Select the WooCommerce option to show the cart content.<br><br><b>Note:</b> To make this option available, you need to have installed the WooCommerce solution.',
        'std' => 'off',
        "options" => $top_cart
    );
}

$options[] = array(
    'id' => 'top_bar_search',
    'type' => 'toggle',
    'name' => 'Show Search',
    'desc' => 'Decide whether or not to show a search field in the top bar.',
    'std' => '1'
);

if (class_exists('WooCommerce')) {
    $options[] = array(
        'id' => 'top_bar_search_type',
        'type' => 'toggle',
        'name' => 'Search Type',
        'desc' => 'Classical wordpress or only Woocommerce. <strong>CAUTION! If you set WooCommerce - the settings of Post Styles -> Include Post Types in Search will be overwriten</strong>',
        'std' => 'wordpress',
        'options' => array('wordpress' => 'WordPress', 'woo' => 'WooCommerce')
    );
}

$options[] = array(
    'id' => 'search_placeholder',
    'type' => 'text',
    'name' => 'Search Placeholder',
    'desc' => 'Name your search placeholder.',
    'std' => 'Search...',
    'mod' => 'mini'
);

$options[] = array(
    "type" => "sectionend");

$options[] = array(
    "name" => "Logo Settings",
    "type" => "sectionstart");

$options[] = array("name" => "Logo",
    "desc" => "Upload your logo or remove the uploaded one." . jwUtils::getHelp("2_2_Logo_Settings"),
    "id" => "custom_logo",
    "std" => "",
    "type" => "upload");

$options[] = array("name" => "Logo Margin - Top",
    "desc" => "Set the top margin of the logo in pixels.",
    "id" => "custom_logo_margin_top",
    "std" => "32",
    "mod" => "micro",
    "type" => "text",
    "unit" => "px",
);

$options[] = array("name" => "Logo Margin - Left",
    "desc" => "Set the left margin of the logo in pixels.",
    "id" => "custom_logo_margin_left",
    "std" => "0",
    "mod" => "micro",
    "type" => "text",
    "unit" => "px",
);

$options[] = array("name" => "Logo Margin - Bottom",
    "desc" => "Set the bottom margin of the logo in pixels.",
    "id" => "custom_logo_margin_bottom",
    "std" => "5",
    "mod" => "micro",
    "type" => "text",
    "unit" => "px",
);

$options[] = array(
    'id' => 'logo_retina_ready',
    'type' => 'toggle',
    'name' => 'Retina Ready',
    'desc' => 'Decide whether or not to display logo in high quality on the Retina displays.' . jwUtils::getHelp("2_2-Retina_Ready"),
    'std' => '1'
);

$options[] = array(
    "type" => "sectionend");

$options[] = array(
    "name" => "Menu Bar",
    "type" => "sectionstart");

$options[] = array(
    'id' => 'menu_bar_fix',
    'type' => 'toggle',
    'name' => 'Fixed Menu Bar',
    'desc' => 'Turn on this option if the top menu bar has to be permanently displayed, independently on scrolling the page.' . jwUtils::getHelp("2_2-Menu_Bar"),
    'std' => '0',
    'options' => array('0' => 'Off', '1' => 'On', '2' => 'With Fixed logo')
);

$options[] = array(
    'id' => 'menu_bar_border',
    'type' => 'toggle',
    'name' => 'Border Menu Bar',
    'desc' => 'Decide whether or not to show an unobtrusive grey line at the top and bottom of the menu bar.',
    'std' => 'on',
    "options" => array("on" => "On", "off" => "Off")
);

$options[] = array(
    'id' => 'menu_mobile_type',
    'type' => 'toggle',
    'name' => 'Mobile menu type' . jwUtils::getHelp("", "MobileMenuType.jpg"),
    'desc' => 'Select mobile menu type.',
    'std' => '2',
    "options" => array("1" => "Select box", "2" => "Full menu")
);

$options[] = array(
    "type" => "sectionend");


$options[] = array("type" => "headingend");
/* End Header Settings ********************************************** */

/* Featured Area Settings ******************************************* */
//background
$options[] = array("name" => "Settings",
    "type" => "headingstart");

$options[] = array(
    'id' => 'blog_featured_show',
    'type' => 'toggle',
    'name' => 'Featured Area Placement (Area Under Menu)',
    'desc' => 'Decide where to show the featured area (slider, page), or select Off option if it has not to be used.',
    'std' => 'off',
    'options' => array("off" => "Off", "homepage" => "Home Page", "allweb" => "All web")
);

if (is_plugin_active('revslider/revslider.php')) {
    $blog_featured_source = array("pageid" => "Page ID", "revo-slider" => "Revolution Slider", "jaw-slider" => "JaW Slider");
} else {
    $blog_featured_source = array("pageid" => "Page ID", "jaw-slider" => "JaW Slider");
}
$options[] = array(
    'id' => 'blog_featured_source',
    'type' => 'toggle',
    'name' => 'Featured Area Content Type',
    'desc' => 'Select the type of your featured area&lsquo;s content you prefer.' . jwUtils::getHelp("2_3_1-Featured_Area_Content_Type"),
    'std' => 'pageid',
    'options' => $blog_featured_source
);

if (is_plugin_active('revslider/revslider.php') && class_exists('RevSlider')) {

    $options[] = array(
        "name" => "Slider Options",
        "type" => "sectionstart");

    $slider = new RevSlider();
    $options[] = array(
        'id' => 'blog_featured_type_slider',
        'type' => 'select',
        'name' => 'Revolution Slider Name',
        'desc' => 'Select one from the sliders you have created in the Revolution Slider settings.',
        'std' => '',
        'mod' => 'medium',
        'options' => $slider->getArrSlidersShort()
    );

    $options[] = array(
        "type" => "sectionend");
}

$options[] = array(
    "name" => "Page Options",
    "type" => "sectionstart");

$options[] = array("name" => "Custom Header Page ID",
    "desc" => "Insert ID of the page you want to use in your featured area content.",
    "id" => "blog_header_featured_type_pageid",
    "std" => "",
    "mod" => "medium",
    "type" => "text"
);

$options[] = array(
    "type" => "sectionend");

$options[] = array("type" => "headingend");

$options[] = array("name" => "JaW Slider",
    "type" => "headingstart");

$options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$options[] = array(
    'id' => 'jawslider_full_type',
    'type' => 'toggle',
    'name' => 'Slider Full Width Styles',
    'desc' => 'Select the <b>Off</b> option if you don&acute;t want to use the slider in any full width mode.<br><br><b>Boundary Color</b> adds a full width colored area around the slider.<br><br><b>Full Width</b> expands your slider to the full width mode.',
    'std' => 'off',
    "options" => array("off" => "Off", "on" => "Boundary Color", "full" => "Full Width"),
);

$options[] = array(
    'id' => 'jawslider_post_type',
    'type' => 'toggle',
    'name' => 'Post Type',
    'desc' => 'Choose whether to show posts or products in the slider.',
    'std' => 'post',
    "options" => array("post" => "Post", "product" => "Product")
);

$options[] = array(
    'id' => 'jawslider_posts_per_page',
    'type' => 'range',
    'name' => 'Number of Items',
    'desc' => 'Set number of items you want to have in the slider.' . jwUtils::getHelp("2_3_2-Number_of_Items"),
    'std' => '6',
    'min' => '3',
    'max' => '40',
    'step' => '1',
    'unit' => ''
);

$options[] = array(
    'id' => 'jawslider_order',
    'type' => 'select',
    'name' => 'Post Order',
    'desc' => 'Posts order (ascending or descending).',
    'std' => 'desc',
    'mod' => 'small',
    'options' => array("desc" => "Desc", "asc" => "Asc")
);

$options[] = array(
    'id' => 'jawslider_orderby',
    'type' => 'select',
    'name' => 'Post Order by',
    'desc' => 'Order posts by parameters. Help on <a target="_blank" href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters">Order by Parameters</a>',
    'std' => 'date',
    'mod' => 'medium',
    'options' => array("date" => "Date", "none" => "None", "ID" => "ID",
        "author" => "Author", "title" => "Title", "modified" => "Modified",
        "parent" => "Parent", "rand" => "Rand", "comment_count" => "Comment count")
);



$options[] = array(
    "type" => "sectionend"
);

$options[] = array(
    "name" => "Blog & Posts",
    "type" => "sectionstart"
);

$options[] = array(
    'id' => 'jawslider_category__in',
    'type' => 'multidropdown',
    'name' => 'Include Category (optional)',
    'desc' => 'Choose the post categories you want to fetch posts from.',
    "std" => array(),
    "page" => null,
    "mod" => 'big',
    "chosen" => "true",
    'builder' => 'false',
    "target" => 'cat',
    "prompt" => "Choose category..",
);

$options[] = array(
    'id' => 'jawslider_post__in',
    'type' => 'text',
    'name' => 'Include Posts (optional)',
    'desc' => 'The posts you want to show. Separate their IDs with coma (like 52, 45, 87 etc.). If this field is blank, all posts will be used.',
    "std" => '',
);

$options[] = array(
    'id' => 'jawslider_author__in',
    'type' => 'multidropdown',
    'name' => 'Include Authors (optional)',
    'desc' => 'Select the authors whose posts you want to display. If this field is blank, the posts from all authors will be used.',
    "std" => array(),
    "page" => null,
    'builder' => 'false',
    "mod" => 'big',
    "chosen" => "true",
    "target" => 'author',
    "prompt" => "Choose Authors..",
);

$options[] = array(
    'id' => 'jawslider_tag__in',
    'type' => 'multidropdown',
    'name' => 'Include Tags (optional)',
    'desc' => 'Choose the tags which have to be included in the posts you want to fetch.',
    "std" => array(),
    "page" => null,
    'builder' => 'false',
    "mod" => 'big',
    "chosen" => "true",
    "target" => 'tag',
    "prompt" => "Choose tag..",
);

$options[] = array(
    'id' => 'jawslider_sticky_posts',
    'type' => 'select',
    'name' => 'Sticky Posts',
    'desc' => 'Choose how to use your sticky posts.',
    'std' => '0',
    "options" => array("0" => "Use as common posts", "ignore_sticky_posts" => "Ignore sticky posts", "show_only_sticky" => "Show only sticky posts")
);

$options[] = array(
    "type" => "sectionend");

$options[] = array(
    "name" => "Products",
    "type" => "sectionstart");

$options[] = array(
    'id' => 'jawslider_featured_products',
    'type' => 'toggle',
    'name' => 'Show Only Featured Products',
    'desc' => 'Show only the featured products in your slider. If this option is set off, all your products will be displayed.',
    'std' => '0',
    "options" => array("0" => "Off", "1" => "On")
);

$options[] = array(
    'id' => 'jawslider_woo_category__in',
    'type' => 'multidropdown',
    'name' => 'Include Product Category (optional)',
    'desc' => 'Choose the product categories you want to fetch products from.',
    "std" => array(),
    "page" => null,
    "mod" => 'big',
    'builder' => 'false',
    "chosen" => "true",
    "target" => 'product_cat',
    "prompt" => "Choose category..",
);

$options[] = array(
    'id' => 'jawslider_woo_post__in',
    'type' => 'text',
    'name' => 'Include Products (optional)',
    'desc' => 'The specific posts you want to display (in format 52, 45, 87).',
    "std" => '',
);

$options[] = array(
    'id' => 'jawslider_woo_tag__in',
    'type' => 'multidropdown',
    'name' => 'Include Products Tags (optional)',
    'desc' => 'Choose the tags which have to be included in the products you want to fetch.',
    "std" => array(),
    "page" => null,
    "mod" => 'big',
    'builder' => 'false',
    "chosen" => "true",
    "target" => 'product_tag',
    "prompt" => "Choose tag..",
);

$options[] = array(
    "type" => "sectionend"
);

$options[] = array(
    "name" => "Animation",
    "type" => "sectionstart"
);

$options[] = array(
    'id' => 'jawslider_animate_latency',
    'type' => 'range',
    'name' => 'Animation latency',
    'desc' => 'Set a speed value of changing slides in your slider.',
    'std' => '5000',
    'min' => '1000',
    'max' => '10000',
    'step' => '500',
    'unit' => 'ms'
);

$options[] = array(
    'id' => 'jawslider_animate_duration',
    'type' => 'range',
    'name' => 'Animation speed',
    'desc' => 'Depending on this value, slides and descriptions move more or less slowly and smoothly. This only affects the animation effect.',
    'std' => '1500',
    'min' => '100',
    'max' => '3000',
    'step' => '100',
    'unit' => 'ms'
);

$options[] = array(
    "type" => "sectionend");

$options[] = array(
    "name" => "Design",
    "type" => "sectionstart"
);

$options[] = array(
    "name" => "Info Box Text Color",
    "desc" => "Pick a color of your text content of the info box (by default: #000000)." . jwUtils::getHelp("2_3_2-Design-Fig"),
    "id" => "jawslider_info_text_color",
    "std" => "#000000",
    "type" => "color"
);

$options[] = array(
    "name" => "Info Box Color",
    "desc" => "Pick a background color for the info box (by default: #ffffff).",
    "id" => "jawslider_info_color",
    "std" => "#ffffff",
    "type" => "color"
);

$options[] = array(
    'id' => 'jawslider_info_opacity',
    'type' => 'range',
    'name' => 'Info Box Opacity',
    'desc' => 'Set an opacity level.',
    'std' => '90',
    'min' => '0',
    'max' => '100',
    'step' => '10',
    'unit' => '%'
);

$options[] = array(
    "type" => "sectionend");

$options[] = array("type" => "headingend");
/* End Featured Area ************************************************ */

$options[] = array(
    "name" => "Footer",
    "type" => "headingstart"
);

$options[] = array(
    "name" => "Footer Featured Area Options (Area Above Footer)",
    "type" => "sectionstart");

$options[] = array(
    'id' => 'footer_featured_show',
    'type' => 'toggle',
    'name' => 'Footer Featured Area Assignment',
    'desc' => 'Decide whether or not to display your footer featured area and where to assign it.',
    'std' => 'off',
    'options' => array("off" => "Off", "homepage" => "Home Page", "allweb" => "All web")
);

$options[] = array("name" => "Custom Footer Page ID",
    "desc" => "Enter ID of the page you want to use in your featured area content.",
    "id" => "blog_featured_type_pageid",
    "std" => "",
    "mod" => "medium",
    "type" => "text"
);

$options[] = array(
    "type" => "sectionend"
);

$options[] = array(
    'id' => 'footer_style',
    "type" => "layout",
    'name' => 'Footer Layout',
    "extend" => 'search_and_archive_sidebar',
    'desc' => 'Choose a preset number of columns to be available for your widgets.' . jwUtils::getHelp("2_4-Footer_Layout"),
    'std' => 'footer-3-3-3-3',
    "options" => array(
        'footer-12' => ADMIN_DIR . 'assets/images/f-1.png',
        'footer-6-6' => ADMIN_DIR . 'assets/images/f-2-2.png',
        'footer-3-3-3-3' => ADMIN_DIR . 'assets/images/f-4-4-4-4.png',
        'footer-4-4-4' => ADMIN_DIR . 'assets/images/f-3-3-3.png',
        'footer-4-8' => ADMIN_DIR . 'assets/images/f-3-33.png'
    )
);

$options[] = array(
    'id' => 'show_copyright',
    'type' => 'toggle',
    'name' => 'Show Copyright',
    'desc' => 'Decide whether or not to display your copyright info in the footer.',
    'std' => 'on',
    "options" => array("on" => "On", "off" => "Off")
);

$options[] = array("type" => "headingend");

/* Posts settings ************************************************************* */
$options[] = array(
    "name" => "Posts Settings",
    "type" => "headingstart"
);

$options[] = array(
    'id' => 'blog_breadcrumb',
    'type' => 'toggle',
    'name' => 'Show Breadcrumbs '. jwUtils::getHelp("", "breadcrumbs.JPG"),
    'desc' => 'Show breadcrumb navigation in categories, archives, tags, search, portfolio categories and inside posts.',
    'std' => '1',
    'options' => array("1" => "On", "0" => "Off")
);

$options[] = array(
    'id' => 'blog_cut_breadcrumb',
    'type' => 'toggle',
    'name' => 'Cut Breadcrumbs',
    'desc' => 'Cut Name of Post / Product in Breadcrumbs at maximal 50 characters',
    'std' => '50',
    'options' => array("50" => "On", "-1" => "Off")
);

$options[] = array(
    'id' => 'blog_bar_type',
    'type' => 'toggle',
    'name' => 'Category & Tag Bar Type ' . jwUtils::getHelp("", "BarType.jpg"),
    'desc' => 'Choose the category and tag bar type you prefer. Click the preview icon to see where the setting appears.',
    'std' => 'box',
    "builder" => 'true',
    "options" => array("box" => "Box", "big" => "Big Title")
);

$options[] = array(
    'id' => 'boxes_type',
    'name' => 'Post Boxes Type',
    'desc' => 'Select size of boxes for your posts. If the Small+Middle option is chosen, only the latest post will be boxed in the middle size box.',
    'std' => 'mix',
    'mod' => 'small',
    "type" => "layout",
    "options" => array(
        'default' => ADMIN_DIR . 'assets/images/blog_boxes/small.png',
        'middle' => ADMIN_DIR . 'assets/images/blog_boxes/middle.png',
        'mix' => ADMIN_DIR . 'assets/images/blog_boxes/small-middle.png',
        'classical' => ADMIN_DIR . 'assets/images/blog_boxes/classical.png',
        'big' => ADMIN_DIR . 'assets/images/blog_boxes/big.png'
    )
);


$options[] = array(
    'id' => 'blog_postscount',
    'type' => 'text',
    'name' => 'Number of Posts',
    'desc' => 'Set number of posts per page loaded using the Pagination Style specified below. ',
    'std' => '6',
    "mod" => 'micro',
);


$options[] = array("name" => "Post Title - Number of Characters",
    "desc" => "Enter a number of characters in the preview content. '-1' = Do not cut ",
    "id" => "letter_title_blog",
    "std" => -1,
    "mod" => 'micro',
    'maxlength' => 4,
    "type" => "text"
);
$options[] = array("name" => "Post Excerpt - Number of Characters",
    "desc" => "Enter a number of characters in the preview content. '-1' = Do not cut",
    "id" => "letter_excerpt_blog",
    "std" => 275,
    "mod" => 'micro',
    'maxlength' => 4,
    "type" => "text"
);

$options[] = array(
    'id' => 'std_post_image_clickable',
    'type' => 'toggle',
    'name' => 'Hyperlink Post Images',
    'desc' => 'Decide whether post images have to be hyperlinked.',
    'std' => '0',
    'options' => array('0' => 'Off', '1' => 'Hyperlink', '2' => 'PrettyPhoto')
);



$options[] = array(
    'id' => 'blog_pagination',
    'type' => 'select',
    'name' => 'Pagination Style',
    'desc' => 'Select the pagination style you prefer.' . jwUtils::getHelp("Pagination_style"),
    'std' => 'ajax',
    'mod' => 'medium',
    'options' => array("ajax" => "ajax", "infinite" => "infinite", "infinitemore" => "infinite with more", "none" => "none", "number" => "number", "wordpress" => "wordpress"),
);
$options[] = array(
    "name" => "Search",
    "type" => "sectionstart"
);

$options[] = array(
    'id' => 'search_posttypes',
    'type' => 'multidropdown',
    'name' => 'Include Post Types in Search',
    'desc' => 'Here you can choose which post types will be included in search. ',
    "std" => array('post', 'page', 'product'),
    "page" => null,
    'builder' => 'false',
    "mod" => 'big',
    "chosen" => "true",
    "target" => 'post_types',
    "prompt" => "Choose Post types..",
);

$options[] = array(
    'id' => 'search_taxonomies',
    'type' => 'multidropdown',
    'name' => 'Include Taxonomies in Search',
    'desc' => 'Here you can choose which taxonomies types will be included in search. ',
    "std" => array(),
    "page" => null,
    'builder' => 'false',
    "mod" => 'big',
    "chosen" => "true",
    "target" => 'taxonomies',
    "prompt" => "Choose Post types..",
);

$search_opt = array();
foreach (get_post_types(array('public' => true), 'objects') as $post_type) {
    $search_opt[$post_type->name] = esc_html($post_type->labels->name) . ' (' . esc_html($post_type->name) . ')';
}

$options[] = array(
    'id' => 'search_default_posttype',
    'type' => 'select',
    'name' => 'Default Post Type',
    'desc' => 'After search will be open this tab as default.',
    'std' => 'post',
    'mod' => 'medium',
    'options' => $search_opt
);

$options[] = array(
    'id' => 'search_hide_blank_tabs',
    'type' => 'toggle',
    'name' => 'Hide Blank Tabs',
    'desc' => 'Decide whether blank tabs will be shown or hide.',
    'std' => '0',
    'options' => array('1' => 'On', '0' => 'Off')
);

$options[] = array(
    'id' => 'search_show_count',
    'type' => 'toggle',
    'name' => 'Show Count',
    'desc' => 'Show number of count searched items in each tab.',
    'std' => '0',
    'options' => array('1' => 'On', '0' => 'Off')
);

$options[] = array(
    'id' => 'search_woo_type',
    'type' => 'select',
    'name' => 'Product Box Style in Search',
    'desc' => 'Select one from the preset appearances of your product boxes.',
    'std' => '0',
    'mod' => 'small',
    'options' => array("0" => "Light", "1" => "Color", "2" => "Boxed", '10' => 'Small Light', '11' => 'Small Color', '20' => 'List')
);

$options[] = array(
    'id' => 'search_boxes_type',
    'type' => 'select',
    'name' => 'Post Boxes Type',
    'desc' => 'Select size of boxes for your posts. If the Small+Middle option is chosen, only the latest post will be boxed in the middle size box.',
    'std' => 'middle',
    'mod' => 'small',
    'options' => array("default" => "Small", "middle" => "Middle", "mix" => "Small+Middle", "classical" => "Classical", "big" => "Big")
);

$options[] = array("type" => "sectionend");

$options[] = array(
    "name" => "Search/Archive/Category Layout",
    "type" => "sectionstart"
);

$options[] = array(
    "name" => "Search/Archive/Category Layout",
    "desc" => "Select a main content and sidebar alignment.",
    "id" => "search_and_archive_layout",
    "std" => 'fullwidth',
    "type" => "layout",
    "extend" => 'search_and_archive_sidebar',
    "options" => array(
        'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
        'left1' => ADMIN_DIR . 'assets/images/left_sidebar.gif',
        'right1' => ADMIN_DIR . 'assets/images/right_sidebar.gif'
    )
);

$options[] = array(
    'id' => 'search_and_archive_sidebar_left1',
    'type' => 'sidebar_select',
    'name' => 'Search/Archive Left Sidebars',
    'desc' => 'Here you can add some optional sidebars.',
    'std' => null,
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'search_and_archive_sidebar_right1',
    'type' => 'sidebar_select',
    'name' => 'Search/Archive Right Sidebars',
    'desc' => 'Here you can add some optional sidebars.',
    'std' => null,
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'search_sidebar_width',
    'type' => 'toggle',
    'name' => 'Search Sidebar Width',
    'desc' => '',
    'std' => '3',
    'options' => array('3' => 'Thin', '4' => 'Thick')
);

$options[] = array("type" => "sectionend");

/* METAdata */
$options[] = array(
    "name" => "Meta Data",
    "type" => "sectionstart"
);

$options[] = array(
    'id' => 'blog_meta_type_icon',
    'type' => 'toggle',
    'name' => 'Meta Post Format Icon',
    'desc' => 'Choose whether or not to show post format icon in the post preview.<br><br><b>Notice:</b> No icon will be shown in previews of posts in Standard or Quote format.',
    'std' => '1'
);

$options[] = array(
    'id' => 'blog_meta_author',
    'type' => 'toggle',
    'name' => 'Meta Author',
    'desc' => 'Choose whether or not to show author&acute;s name in the post preview.',
    'std' => '1'
);

$options[] = array(
    'id' => 'blog_metadate',
    'type' => 'toggle',
    'name' => 'Meta Date',
    'desc' => 'Choose whether or not to show date in the post preview.',
    'std' => '1'
);

$options[] = array(
    'id' => 'blog_comments_count',
    'type' => 'toggle',
    'name' => 'Meta Number of Comments',
    'desc' => 'Choose whether or not to show number of comments in the post preview.',
    'std' => '1'
);

$options[] = array(
    'id' => 'blog_meta_category',
    'type' => 'toggle',
    'name' => 'Meta Category',
    'desc' => 'Choose whether or not to show category in the post preview.',
    'std' => '1'
);

$options[] = array(
    'id' => 'blog_ratings',
    'type' => 'toggle',
    'name' => 'Ratings',
    'desc' => 'Choose whether or not to show ratings in the post preview.',
    'std' => '1'
);

$options[] = array(
    'id' => 'element_blog_dateformat',
    'type' => 'text',
    'name' => 'Post Date Format',
    'desc' => 'Please visit <a target="_blank" href="http://codex.wordpress.org/Formatting_Date_and_Time">Formatting Date and Time in Wordpress</a> to learn how to use the characters convention.',
    'std' => "F j, Y",
    'mod' => 'mini'
);

$options[] = array("type" => "sectionend");
/* Metadata end  ************************************************************ */

$options[] = array("type" => "headingend");

/* BLOG ********************************************************************* */
$options[] = array(
    "name" => "Main Blog",
    "type" => "headingstart"
);

$options[] = array(
    "name" => "Blog Layout Settings",
    "type" => "sectionstart"
);

$options[] = array(
    "name" => "Blog Page Layout",
    "desc" => "Select the main content and sidebar alignment.",
    "id" => "blog_layout",
    "std" => 'fullwidth',
    "type" => "layout",
    "extend" => 'blog_sidebar',
    "options" => array(
        'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
        'left1' => ADMIN_DIR . 'assets/images/left_sidebar.gif',
        'right1' => ADMIN_DIR . 'assets/images/right_sidebar.gif'
    )
);

$options[] = array(
    'id' => 'blog_sidebar_left1',
    'type' => 'sidebar_select',
    'name' => 'Blog Left Sidebar',
    'desc' => 'Select an optional sidebar from the list of those you have created in <br>Sidebar Manager</b>.',
    'std' => null,
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'blog_sidebar_right1',
    'type' => 'sidebar_select',
    'name' => 'Blog Right Sidebar',
    'desc' => 'Select an optional sidebar from the list of those you have created in <br>Sidebar Manager</b>.',
    'std' => null,
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'blog_show_sorting',
    'type' => 'toggle',
    'name' => 'Show Sorting',
    'desc' => 'Decide whether or not to show sorting.',
    'std' => '1'
);

$options[] = array("type" => "sectionend");

$options[] = array(
    'id' => 'blog_cat',
    'type' => 'multidropdown',
    'name' => 'Include Category',
    'desc' => 'Choose the post categories you want to fetch posts from.',
    "std" => '',
    "page" => null,
    "mod" => 'big',
    'builder' => 'false',
    "chosen" => "true",
    "target" => 'cat',
    "prompt" => "Choose category..",
);

$options[] = array(
    'id' => 'blog_order',
    'type' => 'select',
    'name' => 'Post Order',
    'desc' => 'Posts order (ascending or descending).',
    'std' => 'desc',
    'mod' => 'small',
    'options' => array("desc" => "Desc", "asc" => "Asc")
);

$options[] = array(
    'id' => 'blog_orderby',
    'type' => 'select',
    'name' => 'Post Order by',
    'desc' => 'Order posts by parameters. Help on <a target="_blank" href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters">Order by Parameters</a>',
    'std' => 'date',
    'mod' => 'medium',
    'options' => array("date" => "Date", "none" => "None", "ID" => "ID",
        "author" => "Author", "title" => "Title", "modified" => "Modified",
        "parent" => "Parent", "rand" => "Rand", "comment_count" => "Comment count")
);

$options[] = array("type" => "headingend");
/* BLOG END ***************************************************************** */

/* SINGLE POST ************************************************************** */
$options[] = array("name" => "Single Post",
    "type" => "headingstart"
);

$options[] = array(
    "name" => "Post Layout",
    "desc" => "Select the main content and sidebar alignment.",
    "id" => "post_layout",
    "std" => 'fullwidth',
    "type" => "layout",
    "extend" => 'post_sidebar',
    "options" => array(
        'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
        'left1' => ADMIN_DIR . 'assets/images/left_sidebar.gif',
        'right1' => ADMIN_DIR . 'assets/images/right_sidebar.gif'
    )
);

$options[] = array(
    'id' => 'post_sidebar_left1',
    'type' => 'sidebar_select',
    'name' => 'Post Left Sidebar',
    'desc' => 'Select an optional sidebar from the list of those you have created in <br>Sidebar Manager</b>.',
    'std' => null,
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'post_sidebar_right1',
    'type' => 'sidebar_select',
    'name' => 'Post Right Sidebar',
    'desc' => 'Select an optional sidebar from the list of those you have created in <br>Sidebar Manager</b>.',
    'std' => null,
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'post_share',
    'type' => 'toggle',
    'name' => 'Share Post Bar ' . jwUtils::getHelp("", "ShareIT.jpg"),
    'desc' => 'Choose whether or not to make a bar with various sharing options available below the posts. ',
    'std' => '1',
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'post_relatedpost',
    'type' => 'toggle',
    'name' => 'Related Posts',
    'desc' => 'Enable or disable displaying the latest posts section on your post page.',
    'std' => '0',
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'post_relatedpost_images',
    'type' => 'toggle',
    'name' => 'Related Posts - Showing Images',
    'desc' => 'Enable or disable displaying featured image for the latest posts section on your post page.',
    'std' => '1',
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'post_relatedpost_num',
    'type' => 'text',
    'name' => 'Number of Related Posts',
    'desc' => 'Enter a number of related posts you want to show.',
    'std' => '4',
    'mod' => 'mini'
);

$options[] = array(
    'id' => 'post_image_featured',
    'type' => 'toggle',
    'name' => 'Use Image in Post as Featured',
    'desc' => 'If this option is turned on, an image inserted in post is used as featured.' . jwUtils::getHelp("2_6-Use_Image_in_Post_as_Featured"),
    'std' => '0',
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'post_use_featured',
    'type' => 'toggle',
    'name' => 'Use Featured Image/Gallery/Video in Post',
    'desc' => 'Choose whether or not to display a featured image or gallery or video at the top of your post.' . jwUtils::getHelp("2_6-Use_Featured_ImGaVi_in_Post"),
    'std' => '1',
    'mod' => 'medium'
);

// $options[] = array(
//     'id' => 'post_pp_galery',
//     'type' => 'toggle',
//     'name' => 'Use Pretty Photo for Gallery',
//     'desc' => 'Applies the Pretty Photo effect to your gallery items.',
//     'std' => '0',
//     'mod' => 'medium'
// );

$options[] = array(
    'id' => 'blog_author',
    'type' => 'toggle',
    'name' => 'About Author',
    'desc' => 'Choose whether or not to display autor&acute;s name with photo and description in a post.',
    'std' => '1'
);

$options[] = array(
    "name" => "Meta Options",
    "type" => "sectionstart"
);

$options[] = array(
    'id' => 'post_author',
    'type' => 'toggle',
    'name' => 'Meta Post Author',
    'desc' => 'Decide whether or not to show post author&acute;s name.',
    'std' => '1',
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'post_date',
    'type' => 'toggle',
    'name' => 'Meta Post Date',
    'desc' => 'Decide whether or not to show publishing date.',
    'std' => '1',
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'post_ratings',
    'type' => 'toggle',
    'name' => 'Ratings',
    "builder" => 'true',
    'desc' => 'Decide whether or not to show rating in post.',
    'std' => '1'
);

$options[] = array(
    'id' => 'post_type_icon',
    'type' => 'toggle',
    'name' => 'Post Format Icon',
    'desc' => 'Choose whether or not to show post format icon.<br><br><b>Notice:</b> No icon will be shown in posts in Standard or Quote format.',
    'std' => '1'
);

$options[] = array(
    'id' => 'post_comments_count',
    'type' => 'toggle',
    'name' => 'Number of Comments',
    'desc' => 'Decide whether or not to show number of comments in posts.',
    'std' => '1'
);

$options[] = array(
    'id' => 'post_category',
    'type' => 'toggle',
    'name' => 'Post category',
    'desc' => 'Decide whether or not to show post category.',
    'std' => '1'
);

$options[] = array(
    "type" => "sectionend"
);

$options[] = array(
    "name" => "Sharing Options" . jwUtils::getHelp("", "ShareIT.jpg"),
    "desc" => "Select the social networks or services whose icons have to be added to the Share Post Bar.",
    "type" => "sectionstart");

$options[] = array(
    "name" => "Instagram info",
    "id" => "Instagram-info",
    "text" => 'Select the social networks or services whose icons have to be added to the Share Post Bar.',
    "type" => "info",
    "space" => false,
    "message" => "description"
);

$options[] = array(
    'id' => 'post_share_tw',
    'type' => 'toggle',
    'name' => 'Share Post Twitter',
    'std' => '1',
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'post_share_fb',
    'type' => 'toggle',
    'name' => 'Share Post Facebook',
    'std' => '1',
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'post_share_g',
    'type' => 'toggle',
    'name' => 'Share Post Google',
    'std' => '1',
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'post_share_mail',
    'type' => 'toggle',
    'name' => 'Share Post via E-mail',
    'std' => '1',
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'post_share_mail_content',
    'type' => 'text',
    'name' => 'Default email address',
    'desc' => 'Enter a default email address you want to show.',
    'std' => 'youremail@addresshere.com',
    'mod' => 'mid'
);

$options[] = array(
    'id' => 'post_share_pi',
    'type' => 'toggle',
    'name' => 'Share Post Pinterest',
    'std' => '1',
    'mod' => 'medium'
);



$options[] = array(
    "type" => "sectionend"
);

$options[] = array(
    "name" => "Comments",
    "type" => "sectionstart"
);

$options[] = array(
    'id' => 'show_comments',
    'type' => 'toggle',
    'name' => 'Show Comments',
    'desc' => 'Decide whether or not to show comments.',
    'std' => '1',
    'mod' => 'medium'
);

$options[] = array("type" => "sectionend");

/* FB comments settings */
$options[] = array(
    "name" => "Facebook Comments",
    "type" => "sectionstart"
);

$options[] = array(
    "name" => "Facebook Comments",
    "id" => "info-fb",
    "text" => "Don't forget to enter your Facebook App ID in the Advanced section.",
    "type" => "info",
    "space" => false,
    "message" => "warnings"
);

$options[] = array(
    'id' => 'fbcomments_switch',
    'type' => 'toggle',
    'name' => 'Facebook Comments',
    'desc' => 'Turn On the option to enable Facebook comments. If it is off, the Wordpress comments will be used.',
    'std' => '0'
);

$options[] = array(
    'id' => 'fbcomments_nuberofcomments',
    'type' => 'text',
    'name' => 'Number of Comments',
    'desc' => 'Enter a number of comments to be displayed.',
    'std' => "5",
    'mod' => 'mini'
);

$options[] = array("type" => "sectionend");

$options[] = array("type" => "headingend");
/* SINGLE END *************************************************************** */

/* Custom posttypes ********************************************************** */
if (is_plugin_active('jaw-customposts/jawcustomposts.php')) {
    $options[] = array("name" => "Custom PostTypes",
        "type" => "headingstart");



    $options[] = array(
        "name" => "Portfolio Category Layout Settings",
        "type" => "sectionstart"
    );

    $options[] = array(
        "name" => "Portfolio Category Layout",
        "desc" => "Select the main content and sidebar alignment.",
        "id" => "cat_portfolio_layout",
        "std" => 'fullwidth',
        "type" => "layout",
        "extend" => 'cat_portfolio_sidebar',
        "options" => array(
            'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
            'left1' => ADMIN_DIR . 'assets/images/left_sidebar.gif',
            'right1' => ADMIN_DIR . 'assets/images/right_sidebar.gif'
        )
    );

    $options[] = array(
        'id' => 'cat_portfolio_sidebar_left1',
        'type' => 'sidebar_select',
        'name' => 'Portfolio Category Left Sidebar',
        'desc' => 'Select an optional sidebar from the list of those you have created in <br>Sidebar Manager</b>.',
        'std' => null,
        'mod' => 'medium'
    );

    $options[] = array(
        'id' => 'cat_portfolio_sidebar_right1',
        'type' => 'sidebar_select',
        'name' => 'Portfolio Category Right Sidebar',
        'desc' => 'Select an optional sidebar from the list of those you have created in <br>Sidebar Manager</b>.',
        'std' => null,
        'mod' => 'medium'
    );



    $options[] = array("type" => "sectionend");




    $options[] = array(
        "name" => "Single Portfolio Layout Settings",
        "type" => "sectionstart"
    );

    $options[] = array(
        "name" => "Portfolio Page Layout",
        "desc" => "Select the main content and sidebar alignment.",
        "id" => "portfolio_layout",
        "std" => 'fullwidth',
        "type" => "layout",
        "extend" => 'portfolio_sidebar',
        "options" => array(
            'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
            'left1' => ADMIN_DIR . 'assets/images/left_sidebar.gif',
            'right1' => ADMIN_DIR . 'assets/images/right_sidebar.gif'
        )
    );

    $options[] = array(
        'id' => 'portfolio_sidebar_left1',
        'type' => 'sidebar_select',
        'name' => 'Portfolio Left Sidebar',
        'desc' => 'Select an optional sidebar from the list of those you have created in <br>Sidebar Manager</b>.',
        'std' => null,
        'mod' => 'medium'
    );

    $options[] = array(
        'id' => 'portfolio_sidebar_right1',
        'type' => 'sidebar_select',
        'name' => 'Portfolio Right Sidebar',
        'desc' => 'Select an optional sidebar from the list of those you have created in <br>Sidebar Manager</b>.',
        'std' => null,
        'mod' => 'medium'
    );



    $options[] = array("type" => "sectionend");



    $options[] = array("type" => "headingend");
}
/* custom posttypes end

  /* SIDEBAR MANAGER ********************************************************** */
$options[] = array("name" => "Sidebar Manager",
    "type" => "headingstart");

$options[] = array(
    'id' => 'sidebars',
    'type' => 'sidebars',
    'name' => 'Custom Sidebars',
    'desc' => 'Here you can add some optional sidebars.' . jwUtils::getHelp("2_7-Custom_Sidebars"),
    'std' => null
);

$options[] = array(
    'id' => 'sidebars_bar_type',
    'type' => 'toggle',
    'name' => 'Sidebars Bar Type ' . jwUtils::getHelp("", "BarType.jpg"),
    'desc' => 'Select the heading style of custom sidebars you prefer. Click the preview icon to see where the setting appears.',
    'std' => 'big',
    "builder" => 'true',
    "options" => array("box" => "Box", "big" => "Big Title")
);

$options[] = array("type" => "headingend");
/* SIDEBAR MANAGER END ****************************************************** */

/* STYLING ****************************************************************** */
$options[] = array("name" => "Styling Options",
    "type" => "headingstart");

$options[] = array(
    "name" => "Template Background Settings",
    "type" => "sectionstart");

$options[] = array("name" => "Background Image",
    "desc" => "Click the Upload button to select and upload your background image.",
    "id" => "background_image",
    "std" => "",
    "mod" => "big",
    "type" => "upload");

$bg_images_url = get_template_directory_uri() . '/images/bg_texture/';
$bg_images = jwUtils::fileLoader(THEME_DIR . '/images/bg_texture/', array('.png', '.jpg'), $bg_images_url );

$options[] = array("name" => "Background Texture",
    "desc" => "Choose a background texture. If you select the cross filled box, no texture will be used.",
    "id" => "background_texture",
    "std" => $bg_images_url . "none.png",
    "type" => "tiles",
    "options" => $bg_images,
);

$options[] = array("name" => "Background Color" . jwUtils::getHelp("", "BackgroundColor.jpg"),
    "desc" => "Pick a custom background color for the theme.",
    "id" => "body_background_color",
    "std" => "#fafafa",
    "type" => "color");

$options[] = array("name" => "Box Background Color" . jwUtils::getHelp("", "BackgroundBoxColor.jpg"),
    "desc" => "Pick a custom background color for a box with the main content.",
    "id" => "body_box_background_color",
    "std" => "#fafafa",
    "type" => "color");

$options[] = array(
    "type" => "sectionend"
);

$options[] = array(
    "name" => "Template Color Settings",
    "type" => "sectionstart");

$bg_images_url = get_template_directory_uri() . '/images/cat_bg_color/';
$options[] = array("name" => "Load Color Scheme",
    "desc" => "Choose the color scheme you prefer. Selected color affects the main graphic elements of the theme. <br><br><b>Selecting an color scheme will cause loss of the existing color settings.</b>",
    "id" => "template_body_main_color",
    "std" => "darkgrey",
    "type" => "tiles",
    "index" => true,
    "mod" => "big",
    "options" => array(
        "blue" => array('thumbnail' => $bg_images_url . 'blue.png',
            'template_color_1' => '#00475b',
            'template_color_2' => '#c7d3da',
            'template_color_3' => '#eeeeee',
            'body_main_font_color' => '#000000',
            'body_main_alternative_font_color' => '#ffffff',
            'body_main_color_link' => '#5e605f',
            'body_main_color_link_hover' => '#c94732',
            'body_sticky_font_color' => '#0084A8',
            'page_title_background_color' => '#006683',
            'page_title_link_color' => '#ffffff',
            'page_title_link_hover_color' => '#c94732',
            'top_bar_backgroundcolor' => '#00475b',
            'top_bar_fontcolor' => '#c1c2c4',
            'top_bar_fontcolor_active' => '#ffffff',
            'logo_bar_backgroundcolor' => '#ffffff',
            'menu_bar_backgroundcolor' => '#fafafa',
            'menu_bar_bordercolor' => '#c1c2c4',
            'menu_bar_font_color' => '#00475B',
            'menu_bar_fontactive_color' => '#c94732',
            'menu_bar_submenu_background_color' => '#FBFBFB',
            'menu_bar_submenu_font_color' => '#000000',
            'menu_bar_submenu_fontactive_color' => '#c94732',
            'footer_background_color' => '#00475b',
            'footer_top_border_color' => '#5e605f',
            'footer_color_1' => '#fafafa',
            'footer_color_2' => '#F5F5F5',
            'footer_color_3' => '#00475b',
            'footer_font_color' => '#fafafa',
            'footer_link_color' => '#bdbdbd',
            'footer_link_hover_color' => '#c94732',
            'featured_footer_background_color' => '#fafafa',
            'post_title_font_color' => '#00475B',
            'post_font_color' => '#000000',
            'post_font_link' => '#00475B',
            'post_font_link_hover' => '#c94732',
            'product_title_font_color' => '#00475B',
            'product_font_color' => '#000000',
            'product_font_link' => '#00475B',
            'product_font_link_hover' => '#c94732',
            'product_addtocart_background_color' => '#c94732',
            'product_addtocart_font_color' => '#ffffff',
            'woo_featured_background_color' => '#c94732',
            'woo_featured_font_color' => '#ffffff',
            'woo_sale_background_color' => '#c94732',
            'woo_sale_font_color' => '#ffffff',
            'woo_new_background_color' => '#76BAD1',
            'woo_new_font_color' => '#ffffff',
            'woo_soldout_background_color' => '#c1c2c4',
            'woo_soldout_font_color' => '#ffffff',
            'message_background_color' => '#68b8a3',
            'message_font_color' => '#ffffff',
            'messageinfo_background_color' => '#1E85BE',
            'messageinfo_font_color' => '#ffffff',
            'messagewarning_background_color' => '#ffeeb0',
            'messagewarning_font_color' => '#ffae33',
            'messageerror_background_color' => '#B81C23',
            'messageerror_font_color' => '#ffffff',
            'comments_background_color' => '#eeeeee',
            'comments_font_color' => '#000000',
            'comments_link_color' => '#5e605f',
            'comments_link_hover_color' => '#c94732',
            'rating_style_color' => '#c94732'),
        "black_red" => array('thumbnail' => $bg_images_url . 'black_red.png',
            'template_color_1' => '#e32b23',
            'template_color_2' => '#222222',
            'template_color_3' => '#eeeeee',
            'body_main_font_color' => '#000000',
            'body_main_alternative_font_color' => '#ffffff',
            'body_main_color_link' => '#5e605f',
            'body_main_color_link_hover' => '#e32b23',
            'body_sticky_font_color' => '#000000',
            'page_title_background_color' => '#eeeeee',
            'page_title_link_color' => '#0222222',
            'page_title_link_hover_color' => '#e32b23',
            'top_bar_backgroundcolor' => '#000000',
            'top_bar_fontcolor' => '#c1c2c4',
            'top_bar_fontcolor_active' => '#ffffff',
            'logo_bar_backgroundcolor' => '#222222',
            'menu_bar_backgroundcolor' => '#e32b23',
            'menu_bar_bordercolor' => '#ffffff',
            'menu_bar_font_color' => '#fafafa',
            'menu_bar_fontactive_color' => '#222222',
            'menu_bar_submenu_background_color' => '#eeeeee',
            'menu_bar_submenu_font_color' => '#000000',
            'menu_bar_submenu_fontactive_color' => '#E32B23',
            'footer_background_color' => '#222222',
            'footer_top_border_color' => '#5e605f',
            'footer_color_1' => '#fafafa',
            'footer_color_2' => '#F5F5F5',
            'footer_color_3' => '#222222',
            'footer_font_color' => '#fafafa',
            'footer_link_color' => '#bdbdbd',
            'footer_link_hover_color' => '#c94732',
            'featured_footer_background_color' => '#fafafa',
            'post_title_font_color' => '#222222',
            'post_font_color' => '#000000',
            'post_font_link' => '#222222',
            'post_font_link_hover' => '#E32B23',
            'product_title_font_color' => '#222222',
            'product_font_color' => '#000000',
            'product_font_link' => '#222222',
            'product_font_link_hover' => '#E32B23',
            'product_addtocart_background_color' => '#E32B23',
            'product_addtocart_font_color' => '#ffffff',
            'woo_featured_background_color' => '#E32B23',
            'woo_featured_font_color' => '#ffffff',
            'woo_sale_background_color' => '#E32B23',
            'woo_sale_font_color' => '#ffffff',
            'woo_new_background_color' => '#76BAD1',
            'woo_new_font_color' => '#ffffff',
            'woo_soldout_background_color' => '#a4a6ab',
            'woo_soldout_font_color' => '#ffffff',
            'message_background_color' => '#68b8a3',
            'message_font_color' => '#ffffff',
            'messageinfo_background_color' => '#1E85BE',
            'messageinfo_font_color' => '#ffffff',
            'messagewarning_background_color' => '#1E85BE',
            'messagewarning_font_color' => '#ffffff',
            'messageerror_background_color' => '#B81C23',
            'messageerror_font_color' => '#ffffff',
            'comments_background_color' => '#eeeeee',
            'comments_font_color' => '#000000',
            'comments_link_color' => '#5e605f',
            'comments_link_hover_color' => '#E32B23',
            'rating_style_color' => '#E37D23'),
        "pink" => array('thumbnail' => $bg_images_url . 'pink.png',
            'template_color_1' => '#E976AD',
            'template_color_2' => '#525252',
            'template_color_3' => '#eeeeee',
            'body_main_font_color' => '#525252',
            'body_main_alternative_font_color' => '#ffffff',
            'body_main_color_link' => '#000000',
            'body_main_color_link_hover' => '#525252',
            'body_sticky_font_color' => '#9C4F74',
            'page_title_background_color' => '#575757',
            'page_title_link_color' => '#ffffff',
            'page_title_link_hover_color' => '#E976AD',
            'top_bar_backgroundcolor' => '#E976AD',
            'top_bar_fontcolor' => '#e6e6e6',
            'top_bar_fontcolor_active' => '#ffffff',
            'logo_bar_backgroundcolor' => '#ffffff',
            'menu_bar_backgroundcolor' => '#ffffff',
            'menu_bar_bordercolor' => '#525252',
            'menu_bar_font_color' => '#525252',
            'menu_bar_fontactive_color' => '#E976AD',
            'menu_bar_submenu_background_color' => '#ffffff',
            'menu_bar_submenu_font_color' => '#525252',
            'menu_bar_submenu_fontactive_color' => '#E976AD',
            'footer_background_color' => '#575757',
            'footer_top_border_color' => '#5e605f',
            'footer_color_1' => '#fafafa',
            'footer_color_2' => '#F5F5F5',
            'footer_color_3' => '#575757',
            'footer_font_color' => '#fafafa',
            'footer_link_color' => '#bdbdbd',
            'footer_link_hover_color' => '#E976AD',
            'featured_footer_background_color' => '#fafafa',
            'post_title_font_color' => '#525252',
            'post_font_color' => '#000000',
            'post_font_link' => '#00475B',
            'post_font_link_hover' => '#E976AD',
            'product_title_font_color' => '#525252',
            'product_font_color' => '#000000',
            'product_font_link' => '#00475B',
            'product_font_link_hover' => '#E976AD',
            'product_addtocart_background_color' => '#E976AD',
            'product_addtocart_font_color' => '#ffffff',
            'woo_featured_background_color' => '#c94732',
            'woo_featured_font_color' => '#ffffff',
            'woo_sale_background_color' => '#E976AD',
            'woo_sale_font_color' => '#ffffff',
            'woo_new_background_color' => '#A1CFB3',
            'woo_new_font_color' => '#ffffff',
            'woo_soldout_background_color' => '#c1c2c4',
            'woo_soldout_font_color' => '#ffffff',
            'message_background_color' => '#A1CFB3',
            'message_font_color' => '#ffffff',
            'messageinfo_background_color' => '#1E85BE',
            'messageinfo_font_color' => '#ffffff',
            'messagewarning_background_color' => '#ffeeb0',
            'messagewarning_font_color' => '#ffae33',
            'messageerror_background_color' => '#B81C23',
            'messageerror_font_color' => '#ffffff',
            'comments_background_color' => '#eeeeee',
            'comments_font_color' => '#000000',
            'comments_link_color' => '#5e605f',
            'comments_link_hover_color' => '#E976AD',
            'rating_style_color' => '#E88076'),
        "blackwhite" => array('thumbnail' => $bg_images_url . 'blackwhite.png',
            'template_color_1' => '#404040',
            'template_color_2' => '#c7d3da',
            'template_color_3' => '#eeeeee',
            'body_main_font_color' => '#000000',
            'body_main_alternative_font_color' => '#ffffff',
            'body_main_color_link' => '#404040',
            'body_main_color_link_hover' => '#c94732',
            'body_sticky_font_color' => '#7D2C22',
            'page_title_background_color' => '#ebebeb',
            'page_title_link_color' => '#404040',
            'page_title_link_hover_color' => '#c94732',
            'top_bar_backgroundcolor' => '#404040',
            'top_bar_fontcolor' => '#fafafa',
            'top_bar_fontcolor_active' => '#dedede',
            'logo_bar_backgroundcolor' => '#F7F7F7',
            'menu_bar_backgroundcolor' => '#666666',
            'menu_bar_bordercolor' => '#c1c2c4',
            'menu_bar_font_color' => '#fafafa',
            'menu_bar_fontactive_color' => '#c94732',
            'menu_bar_submenu_background_color' => '#FBFBFB',
            'menu_bar_submenu_font_color' => '#000000',
            'menu_bar_submenu_fontactive_color' => '#c94732',
            'footer_background_color' => '#404040',
            'footer_top_border_color' => '#5e605f',
            'footer_color_1' => '#fafafa',
            'footer_color_2' => '#F5F5F5',
            'footer_color_3' => '#00475b',
            'footer_font_color' => '#fafafa',
            'footer_link_color' => '#bdbdbd',
            'footer_link_hover_color' => '#c94732',
            'featured_footer_background_color' => '#fafafa',
            'post_title_font_color' => '#000000',
            'post_font_color' => '#000000',
            'post_font_link' => '#404040',
            'post_font_link_hover' => '#c94732',
            'product_title_font_color' => '#404040',
            'product_font_color' => '#000000',
            'product_font_link' => '#404040',
            'product_font_link_hover' => '#c94732',
            'product_addtocart_background_color' => '#c94732',
            'product_addtocart_font_color' => '#ffffff',
            'woo_featured_background_color' => '#c94732',
            'woo_featured_font_color' => '#ffffff',
            'woo_sale_background_color' => '#c94732',
            'woo_sale_font_color' => '#ffffff',
            'woo_new_background_color' => '#76BAD1',
            'woo_new_font_color' => '#ffffff',
            'woo_soldout_background_color' => '#c1c2c4',
            'woo_soldout_font_color' => '#ffffff',
            'message_background_color' => '#60d283',
            'message_font_color' => '#ffffff',
            'messageinfo_background_color' => '#1E85BE',
            'messageinfo_font_color' => '#ffffff',
            'messagewarning_background_color' => '#ffeeb0',
            'messagewarning_font_color' => '#ffae33',
            'messageerror_background_color' => '#B81C23',
            'messageerror_font_color' => '#ffffff',
            'comments_background_color' => '#eeeeee',
            'comments_font_color' => '#000000',
            'comments_link_color' => '#5e605f',
            'comments_link_hover_color' => '#c94732',
            'rating_style_color' => '#c94732'),
        "titan" => array('thumbnail' => $bg_images_url . 'titan.png',
            'template_color_1' => '#5c8cab',
            'template_color_2' => '#c7d3da',
            'template_color_3' => '#eeeeee',
            'body_main_font_color' => '#000000',
            'body_main_alternative_font_color' => '#ffffff',
            'body_main_color_link' => '#5e605f',
            'body_main_color_link_hover' => '#c94732',
            'body_sticky_font_color' => '#0084A8',
            'page_title_background_color' => '#5c8cab',
            'page_title_link_color' => '#ffffff',
            'page_title_link_hover_color' => '#c94732',
            'top_bar_backgroundcolor' => '#5c8cab',
            'top_bar_fontcolor' => '#dedede',
            'top_bar_fontcolor_active' => '#ffffff',
            'logo_bar_backgroundcolor' => '#ffffff',
            'menu_bar_backgroundcolor' => '#ffffff',
            'menu_bar_bordercolor' => '#ffffff',
            'menu_bar_font_color' => '#555555',
            'menu_bar_fontactive_color' => '#5c8cab',
            'menu_bar_submenu_background_color' => '#fafafa',
            'menu_bar_submenu_font_color' => '#000000',
            'menu_bar_submenu_fontactive_color' => '#5c8cab',
            'footer_background_color' => '#5c8cab',
            'footer_top_border_color' => '#555555',
            'footer_color_1' => '#fafafa',
            'footer_color_2' => '#F5F5F5',
            'footer_color_3' => '#555555',
            'footer_font_color' => '#fafafa',
            'footer_link_color' => '#bdbdbd',
            'footer_link_hover_color' => '#c94732',
            'featured_footer_background_color' => '#fafafa',
            'post_title_font_color' => '#00475B',
            'post_font_color' => '#000000',
            'post_font_link' => '#00475B',
            'post_font_link_hover' => '#c94732',
            'product_title_font_color' => '#00475B',
            'product_font_color' => '#000000',
            'product_font_link' => '#00475B',
            'product_font_link_hover' => '#c94732',
            'product_addtocart_background_color' => '#c94732',
            'product_addtocart_font_color' => '#ffffff',
            'woo_featured_background_color' => '#c94732',
            'woo_featured_font_color' => '#ffffff',
            'woo_sale_background_color' => '#c94732',
            'woo_sale_font_color' => '#ffffff',
            'woo_new_background_color' => '#76BAD1',
            'woo_new_font_color' => '#ffffff',
            'woo_soldout_background_color' => '#c1c2c4',
            'woo_soldout_font_color' => '#ffffff',
            'message_background_color' => '#68b8a3',
            'message_font_color' => '#ffffff',
            'messageinfo_background_color' => '#1E85BE',
            'messageinfo_font_color' => '#ffffff',
            'messagewarning_background_color' => '#ffeeb0',
            'messagewarning_font_color' => '#ffae33',
            'messageerror_background_color' => '#B81C23',
            'messageerror_font_color' => '#ffffff',
            'comments_background_color' => '#eeeeee',
            'comments_font_color' => '#000000',
            'comments_link_color' => '#5e605f',
            'comments_link_hover_color' => '#c94732',
            'rating_style_color' => '#c94732'),    
        "bluewhite" => array('thumbnail' => $bg_images_url . 'blue_white.png',
            'template_color_1' => '#758991',
            'template_color_2' => '#525252',
            'template_color_3' => '#eeeeee',
            'body_main_font_color' => '#1F1F1F',
            'body_main_alternative_font_color' => '#ffffff',
            'body_main_color_link' => '#758991',
            'body_main_color_link_hover' => '#c94732',
            'body_sticky_font_color' => '#c94732',
            'page_title_background_color' => '#E6E6E6',
            'page_title_link_color' => '#525252',
            'page_title_link_hover_color' => '#c94732',
            'top_bar_backgroundcolor' => '#758991',
            'top_bar_fontcolor' => '#1F1F1F',
            'top_bar_fontcolor_active' => '#525252',
            'logo_bar_backgroundcolor' => '#ffffff',
            'menu_bar_backgroundcolor' => '#ffffff',
            'menu_bar_bordercolor' => '#E6E6E6',
            'menu_bar_font_color' => '#1F1F1F',
            'menu_bar_fontactive_color' => '#c94732',
            'menu_bar_submenu_background_color' => '#ffffff',
            'menu_bar_submenu_font_color' => '#1F1F1F',
            'menu_bar_submenu_fontactive_color' => '#c94732',
            'footer_background_color' => '#525252',
            'footer_top_border_color' => '#525252',
            'footer_color_1' => '#fafafa',
            'footer_color_2' => '#F5F5F5',
            'footer_color_3' => '#eeeeee',
            'footer_font_color' => '#fafafa',
            'footer_link_color' => '#bdbdbd',
            'footer_link_hover_color' => '#c94732',
            'featured_footer_background_color' => '#fafafa',
            'post_title_font_color' => '#525252',
            'post_font_color' => '#000000',
            'post_font_link' => '#758991',
            'post_font_link_hover' => '#c94732',
            'product_title_font_color' => '#525252',
            'product_font_color' => '#000000',
            'product_font_link' => '#758991',
            'product_font_link_hover' => '#c94732',
            'product_addtocart_background_color' => '#c94732',
            'product_addtocart_font_color' => '#ffffff',
            'woo_featured_background_color' => '#525252',
            'woo_featured_font_color' => '#ffffff',
            'woo_sale_background_color' => '#c94732',
            'woo_sale_font_color' => '#ffffff',
            'woo_new_background_color' => '#76BAD1',
            'woo_new_font_color' => '#ffffff',
            'woo_soldout_background_color' => '#525252',
            'woo_soldout_font_color' => '#ffffff',
            'message_background_color' => '#A1CFB3',
            'message_font_color' => '#ffffff',
            'messageinfo_background_color' => '#1E85BE',
            'messageinfo_font_color' => '#ffffff',
            'messagewarning_background_color' => '#ffeeb0',
            'messagewarning_font_color' => '#ffae33',
            'messageerror_background_color' => '#B81C23',
            'messageerror_font_color' => '#ffffff',
            'comments_background_color' => '#eeeeee',
            'comments_font_color' => '#000000',
            'comments_link_color' => '#5e605f',
            'comments_link_hover_color' => '#c94732',
            'rating_style_color' => '#c94732'
    ),    
        "brown" => array('thumbnail' => $bg_images_url . 'brown.png',
            'template_color_1' => '#AF6C63',
            'template_color_2' => '#525252',
            'template_color_3' => '#eeeeee',
            'body_main_font_color' => '#1F1F1F',
            'body_main_alternative_font_color' => '#ffffff',
            'body_main_color_link' => '#758991',
            'body_main_color_link_hover' => '#AF6C63',
            'body_sticky_font_color' => '#AF6C63',
            'page_title_background_color' => '#E6E6E6',
            'page_title_link_color' => '#525252',
            'page_title_link_hover_color' => '#AF6C63',
            'top_bar_backgroundcolor' => '#c3a18e',
            'top_bar_fontcolor' => '#e8dfdf',
            'top_bar_fontcolor_active' => '#ffffff',
            'logo_bar_backgroundcolor' => '#c7c7c7',
            'menu_bar_backgroundcolor' => '#ffffff',
            'menu_bar_bordercolor' => '#E6E6E6',
            'menu_bar_font_color' => '#1F1F1F',
            'menu_bar_fontactive_color' => '#AF6C63',
            'menu_bar_submenu_background_color' => '#ffffff',
            'menu_bar_submenu_font_color' => '#1F1F1F',
            'menu_bar_submenu_fontactive_color' => '#AF6C63',
            'footer_background_color' => '#525252',
            'footer_top_border_color' => '#525252',
            'footer_color_1' => '#fafafa',
            'footer_color_2' => '#F5F5F5',
            'footer_color_3' => '#eeeeee',
            'footer_font_color' => '#fafafa',
            'footer_link_color' => '#bdbdbd',
            'footer_link_hover_color' => '#AF6C63',
            'featured_footer_background_color' => '#fafafa',
            'post_title_font_color' => '#525252',
            'post_font_color' => '#000000',
            'post_font_link' => '#758991',
            'post_font_link_hover' => '#AF6C63',
            'product_title_font_color' => '#525252',
            'product_font_color' => '#000000',
            'product_font_link' => '#758991',
            'product_font_link_hover' => '#c94732',
            'product_addtocart_background_color' => '#c94732',
            'product_addtocart_font_color' => '#ffffff',
            'woo_featured_background_color' => '#525252',
            'woo_featured_font_color' => '#ffffff',
            'woo_sale_background_color' => '#c94732',
            'woo_sale_font_color' => '#ffffff',
            'woo_new_background_color' => '#758991',
            'woo_new_font_color' => '#ffffff',
            'woo_soldout_background_color' => '#525252',
            'woo_soldout_font_color' => '#ffffff',
            'message_background_color' => '#A1CFB3',
            'message_font_color' => '#ffffff',
            'messageinfo_background_color' => '#1E85BE',
            'messageinfo_font_color' => '#ffffff',
            'messagewarning_background_color' => '#ffeeb0',
            'messagewarning_font_color' => '#ffae33',
            'messageerror_background_color' => '#B81C23',
            'messageerror_font_color' => '#ffffff',
            'comments_background_color' => '#eeeeee',
            'comments_font_color' => '#000000',
            'comments_link_color' => '#5e605f',
            'comments_link_hover_color' => '#c94732',
            'rating_style_color' => '#c94732'
    )
    ),
);

$options[] = array(
    "type" => "sectionend"
);

$options[] = array(
    "name" => "Main Color Settings",
    "type" => "sectionstart");

$options[] = array("name" => "Template Main Color 1",
    "desc" => "Pick a template color 1 for the theme. This color affects the main elements like bars, titles etc.",
    "id" => "template_color_1",
    "std" => "#00475b",
    "type" => "color");

$options[] = array("name" => "Template Main Color 2",
    "desc" => "Pick a template color 2 for the theme. This color affects lines, borders and similar elements.    ",
    "id" => "template_color_2",
    "std" => "#c7d3da",
    "type" => "color");

$options[] = array("name" => "Template Main Color 3",
    "desc" => "Pick a template color 3 for the theme. This color affects especially background of text elements like boxes, comments etc.",
    "id" => "template_color_3",
    "std" => "#eeeeee",
    "type" => "color");

$options[] = array(
    "type" => "sectionend"
);

$options[] = array(
    "name" => "Font Color Settings",
    "type" => "sectionstart");

$options[] = array("name" => "Font Color",
    "desc" => "Pick a font color for paragraphs.",
    "id" => "body_main_font_color",
    "std" => "#000000",
    "type" => "color");

$options[] = array("name" => "Alternative font color",
    "desc" => "Pick an alternative font color for the theme.",
    "id" => "body_main_alternative_font_color",
    "std" => "#ffffff",
    "type" => "color"
);

$options[] = array("name" => "Link Color",
    "desc" => "Pick a link color for the theme.",
    "id" => "body_main_color_link",
    "std" => "#5e605f",
    "type" => "color");

$options[] = array("name" => "Link Hover Color",
    "desc" => "Pick a link hover color for the theme.",
    "id" => "body_main_color_link_hover",
    "std" => "#c94732",
    "type" => "color");


$options[] = array("name" => "Sticky Font Color",
    "desc" => "Title Font Color for Sticky Posts.",
    "id" => "body_sticky_font_color",
    "std" => "#0084A8",
    "type" => "color");

$options[] = array(
    "type" => "sectionend"
);

$options[] = array(
    "name" => "Page Title Color Settings",
    "type" => "sectionstart");

$options[] = array("name" => "Background Color" . jwUtils::getHelp("", "TitleBackground.jpg"),
    "desc" => "Pick a color of page title&acute;s background.",
    "id" => "page_title_background_color",
    "std" => "#006683",
    "type" => "color");
/*
  $options[] = array("name" => "Font Color",
  "desc" => "Pick a color of page titles.",
  "id" => "page_title_font_color",
  "std" => "#464646",
  "type" => "color"); */

$options[] = array("name" => "Link Color" . jwUtils::getHelp("", "TitleLink.jpg"),
    "desc" => "Pick a color of hyperlinked page titles.",
    "id" => "page_title_link_color",
    "std" => "#ffffff",
    "type" => "color");

$options[] = array("name" => "Link Hover Color" . jwUtils::getHelp("", "TitleLinkHover.jpg"),
    "desc" => "Pick a hover color of hyperlinked page titles.",
    "id" => "page_title_link_hover_color",
    "std" => "#c94732",
    "type" => "color");

$options[] = array(
    "type" => "sectionend"
);

$options[] = array(
    "name" => "Header Color Settings ",
    "type" => "sectionstart");

$options[] = array("name" => "Top Bar Color " . jwUtils::getHelp("", "TopBarColor.jpg"),
    "desc" => "Pick a custom background color for the topbar. ",
    "id" => "top_bar_backgroundcolor",
    "std" => "#00475b",
    "type" => "color");

$options[] = array("name" => "Top Bar Font Color " . jwUtils::getHelp("", "TopBarFontColor.jpg"),
    "desc" => "Pick a custom font color for the topbar. ",
    "id" => "top_bar_fontcolor",
    "std" => "#c1c2c4",
    "type" => "color");

$options[] = array("name" => "Top Bar Font Color 2 " . jwUtils::getHelp("", "TopBarFontActiveColor.jpg"),
    "desc" => "Pick a custom font active color for the topbar. ",
    "id" => "top_bar_fontcolor_active",
    "std" => "#ffffff",
    "type" => "color");

$options[] = array("name" => "Logo Background Row Color " . jwUtils::getHelp("", "LogoBackgroundRowColor.jpg"),
    "desc" => "Pick a custom background color for the logo bar. Works only with the Small header style.",
    "id" => "logo_bar_backgroundcolor",
    "std" => "#FFFFFF",
    "type" => "color"
);

$options[] = array(
    "type" => "sectionend"
);

$options[] = array(
    "name" => "Menu Color Settings",
    "type" => "sectionstart");

$options[] = array("name" => "Menu Background Row Color " . jwUtils::getHelp("", "MenuBackgroundRowColor.jpg"),
    "desc" => "Pick a background color for menu rows. Works only with the Small header style.",
    "id" => "menu_bar_backgroundcolor",
    "std" => "#fafafa",
    "type" => "color"
);

$options[] = array("name" => "Menu Border Row Color " . jwUtils::getHelp("", "MenuBorderRowColor.jpg"),
    "desc" => "Pick a border color for menu rows.",
    "id" => "menu_bar_bordercolor",
    "std" => "#c1c2c4",
    "type" => "color"
);

$options[] = array("name" => "Menu Font Color " . jwUtils::getHelp("", "MenuFontColor.jpg"),
    "desc" => "Pick a font color for the main menu rows. Works only with the Small header style.",
    "id" => "menu_bar_font_color",
    "std" => "#00475B",
    "type" => "color"
);

$options[] = array("name" => "Menu Font Active Color " . jwUtils::getHelp("", "MenuFontActiveColor.jpg"),
    "desc" => "Pick a font active color for the main menu rows. Works only with the Small header style.",
    "id" => "menu_bar_fontactive_color",
    "std" => "#c94732",
    "type" => "color"
);

$options[] = array(
    "type" => "sectionend"
);


$options[] = array(
    "name" => "Submenu Color Settings",
    "type" => "sectionstart");

$options[] = array("name" => "Submenu Background Color" . jwUtils::getHelp("", "SubMenuBackgroundColor.jpg"),
    "desc" => "Pick a background color for submenus.",
    "id" => "menu_bar_submenu_background_color",
    "std" => "#FBFBFB",
    "type" => "color"
);

$options[] = array("name" => "Submenu Font Color " . jwUtils::getHelp("", "SubMenuFontColor.jpg"),
    "desc" => "Pick a custom background color for menu rows.",
    "id" => "menu_bar_submenu_font_color",
    "std" => "#000000",
    "type" => "color"
);

$options[] = array("name" => "Submenu Active Font Color " . jwUtils::getHelp("", "SubMenuActiveFontColor.jpg"),
    "desc" => "Pick a font color for active submenu items.",
    "id" => "menu_bar_submenu_fontactive_color",
    "std" => "#c94732",
    "type" => "color"
);



$options[] = array(
    "type" => "sectionend"
);

$options[] = array(
    "name" => "Mobile Menu Color Settings",
    "type" => "sectionstart");

$options[] = array(
    "name" => "Mobile menu info",
    "id" => "mobile-menu-info",
    "text" => 'This settings will be aplying only if you set "Header Settings" -> "Mobile menu type" to "Full Menu"',
    "type" => "info",
    "space" => false,
    "message" => "info"
);

$options[] = array("name" => "Mobile Menu Background Row Color " ,
    "desc" => "Pick a background color for menu rows. Works only with the Small header style.",
    "id" => "mobile_menu_bar_backgroundcolor",
    "std" => jwOpt::get_option('menu_bar_backgroundcolor', '#fafafa'),
    "type" => "color"
);

$options[] = array("name" => "Mobile Menu Font Color " . jwUtils::getHelp("", "MenuFontColor.jpg"),
    "desc" => "Pick a font color for the main menu rows. Works only with the Small header style.",
    "id" => "mobile_menu_bar_font_color",
    "std" => jwOpt::get_option('menu_bar_font_color', '#00475B'),
    "type" => "color"
);

$options[] = array("name" => "Mobile Menu Font Active Color " . jwUtils::getHelp("", "MenuFontActiveColor.jpg"),
    "desc" => "Pick a font active color for the main menu rows. Works only with the Small header style.",
    "id" => "mobile_menu_bar_fontactive_color",
    "std" => jwOpt::get_option('menu_bar_fontactive_color', '#c94732'),
    "type" => "color"
);


$options[] = array(
    "type" => "sectionend"
);

$options[] = array(
    "name" => "Footer Color Settings",
    "type" => "sectionstart");

$options[] = array("name" => "Footer Background Color" . jwUtils::getHelp("", "FooterBackgroundColor.jpg"),
    "desc" => "Pick a background color for the footer.",
    "id" => "footer_background_color",
    "std" => "#00475b",
    "type" => "color");

$options[] = array("name" => "Footer Top Border Color" . jwUtils::getHelp("", "FooterBorderColor.jpg"),
    "desc" => "Pick a color for the top border of the footer.",
    "id" => "footer_top_border_color",
    "std" => "#5e605f",
    "type" => "color");

$options[] = array("name" => "Footer Main Color 1",
    "desc" => "Pick a footer color 1. This color affects the main elements like bars, titles etc. in the footer.",
    "id" => "footer_color_1",
    "std" => "#fafafa",
    "type" => "color");

$options[] = array("name" => "Footer Main Color 2",
    "desc" => "Pick a footer color 2. This color affects lines, borders and similar elements in the footer. ",
    "id" => "footer_color_2",
    "std" => "#F5F5F5",
    "type" => "color");

$options[] = array("name" => "Footer Main Color 3",
    "desc" => "Pick a footer color 2. This color affects especially background of text elements in the footer.",
    "id" => "footer_color_3",
    "std" => "#00475b",
    "type" => "color");

$options[] = array("name" => "Footer Font Color" . jwUtils::getHelp("", "FooterText.jpg"),
    "desc" => "Pick a footer font color for the theme.",
    "id" => "footer_font_color",
    "std" => "#fafafa",
    "type" => "color");

$options[] = array("name" => "Footer Link Color" . jwUtils::getHelp("", "FooterLink.jpg"),
    "desc" => "Pick a footer link color for the theme.",
    "id" => "footer_link_color",
    "std" => "#bdbdbd",
    "type" => "color");

$options[] = array("name" => "Footer Link Color Hover" . jwUtils::getHelp("", "FooterLinkHover.jpg"),
    "desc" => "Pick a link hover color for the theme.",
    "id" => "footer_link_hover_color",
    "std" => "#c94732",
    "type" => "color");

$options[] = array("name" => "Featured Footer Background Color" . jwUtils::getHelp("", "FooterFeaturedBackground.jpg"),
    "desc" => "Pick a background color for the footer featured area.",
    "id" => "featured_footer_background_color",
    "std" => "#fafafa",
    "type" => "color");

$options[] = array(
    "type" => "sectionend"
);

$options[] = array(
    "name" => "Post Font Color Settings",
    "type" => "sectionstart");

$options[] = array("name" => "Post Title Font Color" . jwUtils::getHelp("", "PostTitle.jpg"),
    "desc" => "Pick a post title font color.",
    "id" => "post_title_font_color",
    "std" => "#00475B",
    "type" => "color");

$options[] = array("name" => "Post Text Font Color" . jwUtils::getHelp("", "PostText.jpg"),
    "desc" => "Pick a post font color.",
    "id" => "post_font_color",
    "std" => "#000000",
    "type" => "color");

$options[] = array("name" => "Post Link Color" . jwUtils::getHelp("", "PostLink.jpg"),
    "desc" => "Pick a post link color for the theme.",
    "id" => "post_font_link",
    "std" => "#00475B",
    "type" => "color");

$options[] = array("name" => "Post Link Hover Color" . jwUtils::getHelp("", "PostLinkHover.jpg"),
    "desc" => "Pick a post link hover color for the theme.",
    "id" => "post_font_link_hover",
    "std" => "#c94732",
    "type" => "color");

$options[] = array(
    "type" => "sectionend"
);
if (class_exists('WooCommerce')) {
    $options[] = array(
        "name" => "WooCommerce Color Settings",
        "type" => "sectionstart");

    $options[] = array("name" => "Product Title Font Color" . jwUtils::getHelp("", "ProductTitleFont.jpg"),
        "desc" => "Pick a product title font color.",
        "id" => "product_title_font_color",
        "std" => "#00475B",
        "type" => "color");

    $options[] = array("name" => "Product Text Font Color" . jwUtils::getHelp("", "ProductText.jpg"),
        "desc" => "Pick a product font color.",
        "id" => "product_font_color",
        "std" => "#000000",
        "type" => "color");

    $options[] = array("name" => "Product Link Color" . jwUtils::getHelp("", "ProductLinkFont.jpg"),
        "desc" => "Pick a product link color for the theme.",
        "id" => "product_font_link",
        "std" => "#00475B",
        "type" => "color");

    $options[] = array("name" => "Product Link Hover Color" . jwUtils::getHelp("", "ProductLinkHoverFont.jpg"),
        "desc" => "Pick a product link hover color for the theme.",
        "id" => "product_font_link_hover",
        "std" => "#c94732",
        "type" => "color");

    $options[] = array("name" => "Add to Cart Button Background Color" . jwUtils::getHelp("", "ProductButton.jpg"),
        "desc" => "Pick a background color for the Add to Card button.",
        "id" => "product_addtocart_background_color",
        "std" => "#c94732",
        "type" => "color");

    $options[] = array("name" => "Add to Cart Font Color" . jwUtils::getHelp("", "ProductButtonText.jpg"),
        "desc" => "Pick a color of the Add to Cart button&acute;s label.",
        "id" => "product_addtocart_font_color",
        "std" => "#ffffff",
        "type" => "color");

    $options[] = array("name" => "Featured Info Background Color" . jwUtils::getHelp("", "FeaturedInfo.jpg"),
        "desc" => "Pick a featured info background color.",
        "id" => "woo_featured_background_color",
        "std" => "#c94732",
        "type" => "color");

    $options[] = array("name" => "Featured Info Font Color" . jwUtils::getHelp("", "FeaturedInfoText.jpg"),
        "desc" => "Pick a featured product info text color for the theme.",
        "id" => "woo_featured_font_color",
        "std" => "#ffffff",
        "type" => "color");

    $options[] = array("name" => "SALE Label Background Color" . jwUtils::getHelp("", "SaleInfo.jpg"),
        "desc" => "Pick a background color of the SALE label.",
        "id" => "woo_sale_background_color",
        "std" => "#c94732",
        "type" => "color");

    $options[] = array("name" => "SALE Label Font Color" . jwUtils::getHelp("", "SaleInfoText.jpg"),
        "desc" => "Pick a color of the SALE label text.",
        "id" => "woo_sale_font_color",
        "std" => "#ffffff",
        "type" => "color");

    $options[] = array("name" => "NEW Info Background Color" . jwUtils::getHelp("", "NewInfo.jpg"),
        "desc" => "Pick a background color of the NEW label.",
        "id" => "woo_new_background_color",
        "std" => "#188ebf",
        "type" => "color");

    $options[] = array("name" => "NEW Label Font Color" . jwUtils::getHelp("", "NewInfoText.jpg"),
        "desc" => "Pick a color of the NEW label text.",
        "id" => "woo_new_font_color",
        "std" => "#ffffff",
        "type" => "color");

    $options[] = array("name" => "SOLD OUT label background color" . jwUtils::getHelp("", "SoldOutInfo.jpg"),
        "desc" => "Pick a background color of the SOLD OUT label.",
        "id" => "woo_soldout_background_color",
        "std" => "#c1c2c4",
        "type" => "color");

    $options[] = array("name" => "SOLD OUT Font Color" . jwUtils::getHelp("", "SoldOutInfoText.jpg"),
        "desc" => "Pick a color of the SOLD OUT label text.",
        "id" => "woo_soldout_font_color",
        "std" => "#ffffff",
        "type" => "color");

    $options[] = array(
        'id' => 'woo_categories_opacity',
        'type' => 'range',
        'name' => 'Product Categories Info Opacity' . jwUtils::getHelp("", "CategoriesInfoOpacity.jpg"),
        'desc' => 'Set an opacity of background in the categories overview.',
        'std' => '90',
        'min' => '0',
        'max' => '100',
        'step' => '1',
        'unit' => ''
    );

    $options[] = array(
        "type" => "sectionend"
    );
}
/* Message color settings ******************************************* */

$options[] = array(
    "name" => "Message Color Settings",
    "type" => "sectionstart");

$options[] = array("name" => "Success Message Background Color",
    "desc" => "Pick a success message background color.",
    "id" => "message_background_color",
    "std" => "#68b8a3",
    "type" => "color");

$options[] = array("name" => "Success Message Font Color",
    "desc" => "Pick a success message font color.",
    "id" => "message_font_color",
    "std" => "#ffffff",
    "type" => "color");

$options[] = array("name" => "Info Message Background Color",
    "desc" => "Pick an info message background color.",
    "id" => "messageinfo_background_color",
    "std" => "#1E85BE",
    "type" => "color");

$options[] = array("name" => "Info Message Font Color",
    "desc" => "Pick an info message font color.",
    "id" => "messageinfo_font_color",
    "std" => "#ffffff",
    "type" => "color");

$options[] = array("name" => "Warning Message Background Color",
    "desc" => "Pick a warning message background color.",
    "id" => "messagewarning_background_color",
    "std" => "#ffeeb0",
    "type" => "color");

$options[] = array("name" => "Warning Message Font Color",
    "desc" => "Pick a warning message font color.",
    "id" => "messagewarning_font_color",
    "std" => "#ffae33",
    "type" => "color");

$options[] = array("name" => "Error Message Background Color",
    "desc" => "Pick an error message background color.",
    "id" => "messageerror_background_color",
    "std" => "#B81C23",
    "type" => "color");

$options[] = array("name" => "Error Message Font Color",
    "desc" => "Pick an error message font color.",
    "id" => "messageerror_font_color",
    "std" => "#ffffff",
    "type" => "color");

$options[] = array(
    "type" => "sectionend"
);

/* End message color settings *************************************** */

/* Comments color settings ****************************************** */

$options[] = array(
    "name" => "Comments Color Settings",
    "type" => "sectionstart");

$options[] = array("name" => "Comments Color Settings" . jwUtils::getHelp("", "CommentsBackground.jpg"),
    "desc" => "Pick a background color of the comment area.",
    "id" => "comments_background_color",
    "std" => "#eeeeee",
    "type" => "color");

$options[] = array("name" => "Comments Font Color" . jwUtils::getHelp("", "CommentsText.jpg"),
    "desc" => "Pick a font color of comments.",
    "id" => "comments_font_color",
    "std" => "#000000",
    "type" => "color");

$options[] = array("name" => "Comments Link Color" . jwUtils::getHelp("", "CommentsLink.jpg"),
    "desc" => "Pick a color of links in comments.",
    "id" => "comments_link_color",
    "std" => "#5e605f",
    "type" => "color");

$options[] = array("name" => "Comments Link Hover Color" . jwUtils::getHelp("", "CommentsLinkHover.jpg"),
    "desc" => "Pick a color of hovered links in comments.",
    "id" => "comments_link_hover_color",
    "std" => "#c94732",
    "type" => "color");

$options[] = array(
    "type" => "sectionend"
); 

$options[] = array(
    "name" => "Template Fonts Settings",
    "type" => "sectionstart");


$options[] = array(
    "name" => "Fonts info",
    "id" => "fonts-info",
    "text" => "If you want to use custom fonts, so please read instructions in /css/custom_styles/readme.md file.",
    "type" => "info",
    "space" => false,
    "message" => "description"
);

$options[] = array(
    'id' => 'use_google_fonts',
    'type' => 'toggle',
    'name' => 'Use Google Fonts',
    'desc' => 'Choose whether your fonts are Google or Websafe fonts',
    'std' => '1'
);


$options[] = array(
    'id' => 'title_font',
    'type' => 'text',
    'name' => 'Title Font',
    'desc' => 'Here you can change the title font. This doesn&acute;t affect the font size, both the typeface and color remain standard. <a href="http://www.google.com/webfonts">Use font from this web</a>',
    'std' => 'Lato',
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'big_title_font_size',
    'type' => 'text',
    "mod" => 'micro',
    'name' => 'Big Title Font Size',
    'desc' => 'Set font size for the Big type of titles.',
    'std' => '24',
);

$options[] = array(
    'id' => 'footer_big_title_font_size',
    'type' => 'text',
    "mod" => 'micro',
    'name' => 'Footer Big Title Font Size',
    'desc' => 'Set font size for the Big type of titles in footer.',
    'std' => '22',
);

$options[] = array("name" => "Paragraph Font",
    "desc" => "Copy the Font Name (e. g. 'Open Sans') here and choose a size, style and color. <a href='http://www.google.com/webfonts'>Use font from this web</a>",
    "id" => "text_font",
    "std" => array('size' => '14px', 'face' => 'Open Sans', 'style' => 'normal', 'color' => '#000000'),
    "type" => "typography",
    "mod" => "mini");


$options[] = array(
    "type" => "sectionend"
);

$options[] = array(
    "name" => "Other Styling Settings",
    "type" => "sectionstart");

$options[] = array("name" => "Rating Color",
    "desc" => "Pick a color of the rating stars.",
    "id" => "rating_style_color",
    "std" => "#c94732",
    "type" => "color");




$options[] = array(
    "type" => "sectionend"
);

$options[] = array("type" => "headingend");
/* STYLING END ******************************************************* */

/* CUSTOM ************************************************************* */
$options[] = array("name" => "Custom Code",
    "type" => "headingstart");

$options[] = array("name" => "Custom CSS",
    "desc" => "Simply add some CSS to your theme by adding it to this field.",
    "id" => "custom_css",
    "std" => "",
    "type" => "textarea");

$options[] = array("name" => "Custom Javascript Footer",
    "desc" => "Simply add some javascript to your theme by adding it to this field. <strong>Don't use script tags</strong>",
    "id" => "custom_js",
    "std" => "",
    "type" => "textarea");

$options[] = array("name" => "Custom Javascript Header",
    "desc" => "Simply add some javascript to your theme by adding it to this field.<strong> Use it for Google DFP.</strong> For custom code add 'script' tag",
    "id" => "custom_js_header",
    "std" => "",
    "type" => "textarea");

$options[] = array("name" => "Analytics code",
    "desc" => "Paste your Google (or other) Analytics tracking code here. This will be added into the footer template of your theme.",
    "id" => "google_analytics",
    "std" => "",
    "type" => "textarea");

$options[] = array("name" => "Footer Text",
    "desc" => "Fill the field with your own plain or HTML tagged text to be displayed in the footer.",
    "id" => "footer_text",
    "std" => 'Copyright &copy; 2014 Design by Jawtemplates.com.',
    "type" => "textarea");

$options[] = array("type" => "headingend");
/* CUSTOM END ************************************************** */

/* BANNERY  ********************************************************* */
//background
$options[] = array("name" => "Banner - Background",
    "type" => "headingstart");

$options[] = array(
    'id' => 'background_banner_show',
    'type' => 'toggle',
    'name' => 'Show Banner' . jwUtils::getHelp("2_10_1-Banner-Background"),
    'desc' => 'Choose whether or not to display banner background ads.',
    'std' => '0'
);

$options[] = array("name" => "Background Banner Image",
    "desc" => "Click the Upload button to select your prepared background ad.",
    "id" => "background_banner",
    "std" => "",
    "type" => "upload");

$options[] = array("name" => "Target Link on Left Side",
    "desc" => "Insert a target URL for the left side of your background ad.",
    "id" => "background_banner_link_left",
    "std" => "http://",
    "type" => "text"
);

$options[] = array("name" => "Width of Area for a Target Link on Left Side",
    "desc" => "Enter a width of the left side banner&acute;s area which has to be an active link (in pixels, e.g. 150).",
    "id" => "background_banner_link_width_right",
    "std" => "",
    "type" => "text",
    "mod" => "medium"
);

$options[] = array("name" => "Target Link on Right Side",
    "desc" => "Insert a target URL for the right side of your background ad.",
    "id" => "background_banner_link_right",
    "std" => "http://",
    "type" => "text"
);

$options[] = array("name" => "Width of Area for a Target Link on Right Side",
    "desc" => "Enter a width of the right side banner&acute;s area which has to be an active link (in pixels, e.g. 150).",
    "id" => "background_banner_link_width_left",
    "std" => "",
    "type" => "text",
    "mod" => "medium"
);

$options[] = array("name" => "Banner Link Target",
    "desc" => "Specify where to open an advertiser&acute;s link.",
    "id" => "background_banner_target",
    "std" => "_blank",
    "type" => "select",
    "options" => array("_blank" => "_blank", "_top" => "_top", "_parent" => "_parent", "_self" => "_self"));

$options[] = array("type" => "headingend");



//leader
$options[] = array("name" => "Banner - Leaderboard",
    "type" => "headingstart");

$options[] = array(
    'id' => 'leader_banner_show',
    'type' => 'toggle',
    'name' => 'Show Banner' . jwUtils::getHelp("", "BannerLeader.jpg"),
    'desc' => 'Choose whether or not to display banner.',
    'std' => '0'
);

$options[] = array("name" => "Banner Type",
    "desc" => "Select the banner type you prefer.",
    "id" => "banner_leader_type",
    "std" => "image",
    "type" => "select",
    "options" => array("image" => "Image Banner", "google" => "Google Ads"));

$options[] = array("name" => "Banner Image",
    "desc" => "Click the Upload button to select and upload your banner.",
    "id" => "leader_banner",
    "std" => "",
    "type" => "upload");

$options[] = array("name" => "Target Link",
    "desc" => "Insert a target URL for the Leaderboard banner.",
    "id" => "leader_banner_link",
    "std" => "http://",
    "type" => "text"
);

$options[] = array("name" => "Banner Link Target",
    "desc" => "Specify where to open an advertiser&acute;s link.",
    "id" => "banner_lead_link_target",
    "std" => "_blank",
    "type" => "select",
    "options" => array("_blank" => "_blank", "_top" => "_top", "_parent" => "_parent", "_self" => "_self"));

$options[] = array("name" => "Custom Ads Code (e.g. Google)",
    "desc" => "Insert the (e.g. Google) Ads Code. <b>Notice: You may have maximally 3 google ads on one page.</b>",
    "id" => "leader_banner_google",
    "std" => "",
    "type" => "textarea");

$options[] = array("type" => "headingend");



// Skyscrapper - Right
$options[] = array("name" => "Banner - Skyscrapper Right",
    "type" => "headingstart");

$options[] = array(
    'id' => 'skyscrapper_right_show',
    'type' => 'toggle',
    'name' => 'Show Banner' . jwUtils::getHelp("", "BannerSky.jpg"),
    'desc' => 'Choose whether or not to display banner.',
    'std' => '0'
);

$options[] = array("name" => "Banner Type",
    "desc" => "Choose the banner type you prefer.",
    "id" => "banner_skyscrapper_right_type",
    "std" => "image",
    "type" => "select",
    "options" => array("image" => "Image Banner", "google" => "Google Ads"));


$options[] = array("name" => "Banner Image",
    "desc" => "Click the Upload button to select and upload your banner.",
    "id" => "skyscrapper_right",
    "std" => "",
    "type" => "upload");

$options[] = array("name" => "Target Link",
    "desc" => "Insert a target URL for the banner.",
    "id" => "skyscrapper_right_link",
    "std" => "http://",
    'maxlength' => 255,
    "type" => "text"
);
$options[] = array("name" => "Banner Link Target",
    "desc" => "Specify where to open an advertiser&acute;s link.",
    "id" => "banner_ss_r_link_target",
    "std" => "_blank",
    "type" => "select",
    "options" => array("_blank" => "_blank", "_top" => "_top", "_parent" => "_parent", "_self" => "_self"));


$options[] = array("name" => "Custom Ads Code (e.g. Google)",
    "desc" => "Insert the (e.g. Google) Ads Code. <b>Notice: You may have maximally 3 google ads on one page.</b>",
    "id" => "skyscrapper_right_link_google",
    "std" => "",
    "type" => "textarea");

$options[] = array("type" => "headingend");


// Skyscrapper left
$options[] = array("name" => "Banner - Skyscrapper Left",
    "type" => "headingstart");

$options[] = array(
    'id' => 'skyscrapper_left_show',
    'type' => 'toggle',
    'name' => 'Show Banner' . jwUtils::getHelp("", "BannerSky.jpg"),
    'desc' => 'Choose whether or not to display banner.',
    'std' => '0'
);

$options[] = array("name" => "Banner Type",
    "desc" => "Choose the banner type you prefer.",
    "id" => "banner_skyscrapper_left_type",
    "std" => "image",
    "type" => "select",
    "options" => array("image" => "Image Banner", "google" => "Google Ads"));

$options[] = array("name" => "Banner Image",
    "desc" => "Click the Upload button to select and upload your banner.",
    "id" => "skyscrapper_left",
    "std" => "",
    "type" => "upload");

$options[] = array("name" => "Target Link",
    "desc" => "Insert a target URL for the banner.",
    "id" => "skyscrapper_left_link",
    "std" => "http://",
    'maxlength' => 255,
    "type" => "text"
);
$options[] = array("name" => "Banner Link Target",
    "desc" => "Specify where to open an advertiser&acute;s link.",
    "id" => "banner_ss_l_link_target",
    "std" => "_blank",
    "type" => "select",
    "options" => array("_blank" => "_blank", "_top" => "_top", "_parent" => "_parent", "_self" => "_self"));

$options[] = array("name" => "Custom Ads Code (e.g. Google)",
    "desc" => "Insert the (e.g. Google) Ads Code. <b>Notice: You may have maximally 3 google ads on one page.</b>",
    "id" => "skyscrapper_left_link_google",
    "std" => "",
    "type" => "textarea");

$options[] = array("type" => "headingend");


// Banner IN TOP POST 
$options[] = array("name" => "Banner in Post - Top",
    "type" => "headingstart");

$options[] = array(
    'id' => 'banner_posttop_show',
    'type' => 'toggle',
    'name' => 'Show Banner' . jwUtils::getHelp("", "BannerInPost.jpg"),
    'desc' => 'Choose whether or not to display banner.',
    'std' => '0'
);

$options[] = array("name" => "Banner Type",
    "desc" => "Choose the banner type you prefer.",
    "id" => "banner_posttop_type",
    "std" => "image",
    "type" => "select",
    "options" => array("image" => "Image Banner", "google" => "Google Ads"));

$options[] = array("name" => "Banner Image",
    "desc" => "Click the Upload button to select and upload your banner.",
    "id" => "banner_posttop",
    "std" => "",
    "type" => "upload");

$options[] = array("name" => "Target Link",
    "desc" => "Insert a target URL for the banner.",
    "id" => "banner_posttop_link",
    "std" => "http://",
    'maxlength' => 255,
    "type" => "text"
);
$options[] = array("name" => "Banner Link Target",
    "desc" => "Specify where to open an advertiser&acute;s link.",
    "id" => "banner_posttop_target",
    "std" => "_blank",
    "type" => "select",
    "options" => array("_blank" => "_blank", "_top" => "_top", "_parent" => "_parent", "_self" => "_self"));

$options[] = array("name" => "Custom Ads Code (e.g. Google)",
    "desc" => "Insert the (e.g. Google) Ads Code. <b>Notice: You may have maximally 3 google ads on one page.</b>",
    "id" => "banner_posttop_google",
    "std" => "",
    "type" => "textarea");

$options[] = array("type" => "headingend");


// Banner IN Bottom POSt
$options[] = array("name" => "Banner in Post - Bottom",
    "type" => "headingstart");

$options[] = array(
    'id' => 'banner_postbottom_show',
    'type' => 'toggle',
    'name' => 'Show Banner ' . jwUtils::getHelp("", "BannerInPost.jpg"),
    'desc' => 'Choose whether or not to display banner.',
    'std' => '0'
);

$options[] = array("name" => "Banner Type",
    "desc" => "Choose the banner type you prefer.",
    "id" => "banner_postbottom_type",
    "std" => "image",
    "type" => "select",
    "options" => array("image" => "Image Banner", "google" => "Google Ads"));



$options[] = array("name" => "Banner Image",
    "desc" => "Click the Upload button to select and upload your banner.",
    "id" => "banner_postbottom",
    "std" => "",
    "type" => "upload");

$options[] = array("name" => "Target Link",
    "desc" => "Insert a target URL for the banner.",
    "id" => "banner_postbottom_link",
    "std" => "http://",
    'maxlength' => 255,
    "type" => "text"
);
$options[] = array("name" => "Banner Link Target",
    "desc" => "Specify where to open an advertiser&acute;s link.",
    "id" => "banner_postbottom_target",
    "std" => "_blank",
    "type" => "select",
    "options" => array("_blank" => "_blank", "_top" => "_top", "_parent" => "_parent", "_self" => "_self"));

$options[] = array("name" => "Custom Ads Code (e.g. Google)",
    "desc" => "Insert the (e.g. Google) Ads Code. <b>Notice: You may have maximally 3 google ads on one page.</b>",
    "id" => "banner_postbottom_google",
    "std" => "",
    "type" => "textarea");

$options[] = array("type" => "headingend");



// Banner Custom Widget - 1 
$options[] = array("name" => "Banner - Custom 1",
    "type" => "headingstart");

$options[] = array(
    'id' => 'banner_custom_1_show',
    'type' => 'toggle',
    'name' => 'Show Banner ' . jwUtils::getHelp("help", "BannerCustom.jpg", "http://support.jawtemplates.com/goodstore/web/?p=1125"),
    'desc' => 'Choose whether or not to display banner.' . jwUtils::getHelp("2_10_7"),
    'std' => '0'
);

$options[] = array("name" => "Banner Type",
    "desc" => "Choose the banner type you prefer.",
    "id" => "banner_custom_1_type",
    "std" => "image",
    "type" => "select",
    "options" => array("image" => "Image Banner", "google" => "Google Ads"));



$options[] = array("name" => "Banner Image",
    "desc" => "Click the Upload button to select and upload your banner.",
    "id" => "banner_custom_1",
    "std" => "",
    "type" => "upload");

$options[] = array("name" => "Target Link",
    "desc" => "Insert a target URL for the banner.",
    "id" => "banner_custom_1_link",
    "std" => "http://",
    'maxlength' => 255,
    "type" => "text"
);
$options[] = array("name" => "Banner Link Target",
    "desc" => "Specify where to open an advertiser&acute;s link.",
    "id" => "banner_w_1_link_target",
    "std" => "_blank",
    "type" => "select",
    "options" => array("_blank" => "_blank", "_top" => "_top", "_parent" => "_parent", "_self" => "_self"));

$options[] = array("name" => "Custom Ads Code (e.g. Google)",
    "desc" => "Insert the (e.g. Google) Ads Code. <b>Notice: You may have maximally 3 google ads on one page.</b>",
    "id" => "banner_custom_1_google",
    "std" => "",
    "type" => "textarea");

$options[] = array("type" => "headingend");

// Banner into Post - 1 
$options[] = array("name" => "Banner - Custom 2",
    "type" => "headingstart");

$options[] = array(
    'id' => 'banner_custom_2_show',
    'type' => 'toggle',
    'name' => 'Show Banner' . jwUtils::getHelp("help", "BannerCustom.jpg", "http://support.jawtemplates.com/goodstore/web/?p=1125"),
    'desc' => 'Choose whether or not to display banner.' . jwUtils::getHelp("2_10_7"),
    'std' => '0'
);

$options[] = array("name" => "Banner Type",
    "desc" => "Choose the banner type you prefer.",
    "id" => "banner_custom_2_type",
    "std" => "image",
    "type" => "select",
    "options" => array("image" => "Image Banner", "google" => "Google Ads"));


$options[] = array("name" => "Banner Image",
    "desc" => "Click the Upload button to select and upload your banner.",
    "id" => "banner_custom_2",
    "std" => "",
    "type" => "upload");

$options[] = array("name" => "Target Link",
    "desc" => "Insert a target URL for the banner.",
    "id" => "banner_custom_2_link",
    "std" => "http://",
    'maxlength' => 255,
    "type" => "text"
);
$options[] = array("name" => "Banner Link Target",
    "desc" => "Specify where to open an advertiser&acute;s link.",
    "id" => "banner_w_2_link_target",
    "std" => "_blank",
    "type" => "select",
    "options" => array("_blank" => "_blank", "_top" => "_top", "_parent" => "_parent", "_self" => "_self"));

$options[] = array("name" => "Custom Ads Code (e.g. Google)",
    "desc" => "Insert the (e.g. Google) Ads Code. <b>Notice: You may have maximally 3 google ads on one page.</b>",
    "id" => "banner_custom_2_google",
    "std" => "",
    "type" => "textarea");

$options[] = array("type" => "headingend");

/* END BANNERS ******************************************************* */

/* 404  **************************************************** */
$options[] = array("name" => "Error 404",
    "type" => "headingstart");



$options[] = array("name" => "404 HTML",
    "desc" => "Insert a HTML code of the content you want to appear instead of common browser&acute;s page when the 404 error occurs." . jwUtils::getHelp("2_11_Error_404"),
    "id" => "error_custom_html",
    "rows" => 20,
    "std" => '		<h1>File Not Found</h1>
				<div class="error">
					<p class="bottom">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
				</div>
				<p>Please try the following:</p>
				<ul> 
					<li>Return to the <a href="' . SITE_URL . '">home page</a></li>
				</ul>',
    "type" => "textarea");


$options[] = array(
    "name" => "Error 404 Layout",
    "type" => "sectionstart");

$options[] = array(
    "name" => "Error 404 Layout",
    "desc" => "Select a main content and sidebar alignment.",
    "id" => "error_404_layout",
    "std" => 'fullwidth',
    "type" => "layout",
    "extend" => 'error_404_sidebar',
    "options" => array(
        'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
        'left1' => ADMIN_DIR . 'assets/images/left_sidebar.gif',
        'right1' => ADMIN_DIR . 'assets/images/right_sidebar.gif'
    )
);

$options[] = array(
    'id' => 'error_404_sidebar_left1',
    'type' => 'sidebar_select',
    'name' => 'Error 404 Left Sidebars',
    'desc' => 'Select an optional sidebar. You can create your custom sidebars in <b>Sidebar Manager</b>.',
    'std' => null,
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'error_404_sidebar_right1',
    'type' => 'sidebar_select',
    'name' => 'Error 404 Right Sidebars',
    'desc' => 'Select an optional sidebar. You can create your custom sidebars in <b>Sidebar Manager</b>.',
    'std' => null,
    'mod' => 'medium'
);

$options[] = array(
    "type" => "sectionend");

$options[] = array("type" => "headingend");




/* BACKUP  **************************************************** */
$options[] = array("name" => "Backup Options",
    "type" => "headingstart");

$options[] = array("name" => "Backup and Restore Options",
    "id" => "of_backup",
    "std" => "",
    "type" => "backup",
    "desc" => 'You can use the two buttons below to backup your current options, and then restore them back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.<br><br>You can also transfer your saved options or presets data between different installations by copying texts inside the text boxes below.',
);


$options[] = array("name" => "Backup to Google Drive",
    "id" => "of_backup_gdrive",
    "std" => "",
    "type" => "gdrive",
    "desc" => '<b>First, save your settings, please.</b><br>All the setting will be encoded and uploaded to your Google Drive.',
);

$options[] = array("name" => "Transfer Theme Options Data",
    "id" => "of_transfer",
    "std" => "",
    "type" => "transfer",
    "target" => "themeoptions",
    "desc" => "To import data from another installation, replace the data in the text box with the one from another install and click the Import Theme Options.",
);
/* $options[] = array("name" => "Transfer Menu Options Data",
  "id" => "of_transfer_menus",
  "std" => "",
  "type" => "transfer",
  "target" => "menus",
  "desc" => "To import data from another installation, replace the data in the text box with the one from another install and click the Import Menu Options."  ,
  ); */
$options[] = array("name" => "Transfer Category Options Data",
    "id" => "of_transfer_category",
    "std" => "",
    "type" => "transfer",
    "target" => "category",
    "desc" => "To import data from another install, replace the data in the text box with the one from another install and click Import Category Options.",
);
$options[] = array("name" => "Transfer RevoComposer presets Data",
    "id" => "of_transfer_builder",
    "std" => "",
    "type" => "transfer",
    "target" => "builder",
    "desc" => "To import data from another install, replace the data in the text box with the one from another install and click Import RevoComposer Presets.",
);


$options[] = array("type" => "headingend");


// DEMO **********************************************************
$options[] = array("name" => "Demo Data",
    "type" => "headingstart");

$options[] = array(
    "name" => "Imort DEMO",
    "id" => "info-demo",
    "text" => "<h3 style=\"margin: 0 0 10px;\">Warning:</h3> When uploading the demo content you may lose your data. Don&acute;t forget to back-up your database before you choose this option, please.<br><br> When you import the demo at the first time, the whole data will be imported. You will get only the presets at the next updates.<br><br>Import only into a fresh Wordpress installation.",
    "type" => "info",
    "space" => false,
    "message" => "warnings"
);


$options[] = array(
    "name" => "Imort DEMO",
    "id" => "info-demo-info",
    "text" => "<h3>Here you can see all 8 Styles.</h3><h3>Each style has variations, that can be changed in Settings -> Reading -> Frontpage. </h3>",
    "type" => "info",
    "space" => false,
    "message" => "warnings"
);



$options[] = array(
    "name" => "Import Sample Data (just click at image) ". jwUtils::getHelp("import", "", "http://support.jawtemplates.com/goodstore/web/?p=986"),
    "space" => true,
    "id" => "import-sample-preset1",
    "file" => array("demo1", 'demo2', 'demo3', 'demo4','demo5','demo6','demo7','demo8'),
    "description" => array("Click the thumbnail to make your site look like our demo.<br /><b>Please read carefully the Warning above before you select this option.</b>","Click the thumbnail to make your site look like our demo.<br /><b>Please read carefully the Warning above before you select this option.</b>","Click the thumbnail to make your site look like our demo.<br /><b>Please read carefully the Warning above before you select this option.</b>","Click the thumbnail to make your site look like our demo.<br /><b>Please read carefully the Warning above before you select this option.</b>", "Click the thumbnail to make your site look like our demo.<br /><b>Please read carefully the Warning above before you select this option.</b>", "Click the thumbnail to make your site look like our demo.<br /><b>Please read carefully the Warning above before you select this option.</b>", "Click the thumbnail to make your site look like our demo.<br /><b>Please read carefully the Warning above before you select this option.</b>", "Click the thumbnail to make your site look like our demo.<br /><b>Please read carefully the Warning above before you select this option.</b>"),
    "img" => array("demo1.jpg", "demo2.jpg", "demo3.jpg", "demo4.jpg", "demo5.jpg", "demo6.jpg", "demo7.jpg", "demo8.jpg"), //in /demo/images folder
    "type" => "importpreset"
);



$options[] = array("type" => "headingend");


 //TRANSLATIONS ******************************************************
    $options[] = array("name" => "Translations",
    "type" => "headingstart");
    
    $options[] = array(
    'id' => 'use_translation',
    'type' => 'toggle',
    'name' => 'Use This Translation',
    'desc' => '',
    'std' => '0'
    );
    
    $options[] = array(
    'id' => 'translation',
    'type' => 'translation',
    'name' => 'Translations',
    'desc' => '',
    'class' => 'fullwidth-option'
    );
    
    
    $options[] = array("type" => "headingend");
    
    
    
// Advanced **********************************************************
$options[] = array("name" => "Advanced",
    "type" => "headingstart");

/* $options[] = array(
  'id' => 'site_rtl',
  'type' => 'toggle',
  'name' => 'Right to Left',
  'desc' => 'Support for RTL languages.',
  'std' => '0'
  ); */


$options[] = array(
    'id' => 'switch_udate',
    'type' => 'toggle',
    'name' => 'Notification of New Updates',
    'desc' => 'Decide whether you want to be informed about new available updates.',
    'std' => '1'
);

$options[] = array(
    'id' => 'use_prettyphoto',
    'type' => 'toggle',
    'name' => 'Use prettyPhoto (lightbox) for images',
    'desc' => '',
    'std' => '1'
);

$options[] = array(
    'id' => 'social_comments_language',
    'type' => 'text',
    'name' => 'Social Plugins Language',
    'desc' => 'To change the language, use a value from <a href="' . THEME_URI . '/languages/language_code.html?amp;TB_iframe=true" class="thickbox">this</a> list.',
    'std' => "en_GB",
    'mod' => 'mini'
);


$options[] = array(
    "name" => "Modal Window on Start " . jwUtils::getHelp("", "ModalWindow.jpg"),
    "type" => "sectionstart");

$options[] = array(
    'id' => 'woo_modal',
    'type' => 'toggle',
    'name' => 'Show Modal Window on Start',
    'desc' => 'Turn on this option to show a modal window when visitor opens your site first time.',
    'std' => '0',
    'options' => array("1" => "On", "0" => "Off")
);

$options[] = array("name" => "Modal Window Page ID",
    "desc" => "Insert ID of the page that you want to show as content of your modal window",
    "id" => "woo_modal_page_id",
    "std" => "",
    "mod" => "medium",
    "type" => "text"
);

$options[] = array(
    "type" => "sectionend");
//START FB
$options[] = array(
    "name" => "<i class='icon-facebook4 '></i> Facebook API",
    "type" => "sectionstart");

            
$options[] = array(
    "name" => "FB info",
    "id" => "fb-info",
    "text" => '<b>1.</b> Create a new application <a href="https://developers.facebook.com/apps/" target="_blank">HERE</a><br><br>
    <b>2.</b> Select "website" and name your application<br><br>
    <b>3.</b> Click "Create new Facebook APP ID"<br><br>
    <b>4.</b> Select category and click "Create App ID"<br><br>
    <b>5.</b> Click "Skip quick start" in right top corner<br><br>
    <b>6.</b> Copy App ID and App Secret<br><br>
    <strong><u>Save the Theme Options and refresh this page.</u></strong><br><br>
    <b>7.</b> Now you should see App Token here<br><br>
    <strong><u>Save the Theme Options and refresh this page again.</u></strong>',
    "type" => "info",
    "space" => false,
    "message" => "info"
);

$options[] = array(
    'id' => 'fbcomments_appid',
    'type' => 'text',
    'mod' => 'large',
    'name' => 'Facebook App ID',
    'desc' => 'For sharing your site and create FB commentary. For more information please visit <a href="https://developers.facebook.com/apps/">HERE</a>.',
    'std' => "",
);

 $options[] = array(
    'id' => 'fbcomments_secret',
    'type' => 'text',
    'mod' => 'large',
    'name' => 'Facebook App Secret',
    'desc' => 'For sharing your site and create FB commentary. For more information please visit <a href="https://developers.facebook.com/apps/">HERE</a>.',
    'std' => "",
);
$options[] = array(
    'id' => 'fb_token',
    'type' => 'facebook',
    'name' => 'Facebook App Token',
    'desc' => 'Follow the instructions in the cyan box above, please.',
    'std' => "",
);

$options[] = array(
    'id' => 'fbcomments_moderated',
    'type' => 'button',
    'name' => 'Comment Moderation Area',
    'desc' => "When you're a moderator you will see notifications within facebook.com. If you don't want to have moderator status or want to see all comments in one area, use the link to the left.",
    'std' => '1',
    'href' => 'https://developers.facebook.com/tools/comments',
    'title' => 'Comment Moderation Area',
    'target' => '_blank'
);

        
$options[] = array(
    "type" => "sectionend");
//END FB
//START TWITTER
$options[] = array(
    "name" => "<i class='icon-twitter3'></i> Twitter API " . jwUtils::getHelp("", "twitter_api.jpg"),
    "type" => "sectionstart");

$options[] = array(
    'id' => 'tw_consumer_id',
    'type' => 'text',
    'mod' => 'large',
    'name' => 'API Key',
    'desc' => 'To get this key, please go to <a href="https://dev.twitter.com/apps/new">https://dev.twitter.com/apps/new</a>',
    'std' => "",
);
$options[] = array(
    'id' => 'tw_consumer_secret',
    'type' => 'text',
    'mod' => 'large',
    'name' => 'API Secret',
    'desc' => 'To get this key, please go to <a href="https://dev.twitter.com/apps/new">https://dev.twitter.com/apps/new</a>',
    'std' => "",
);
$options[] = array(
    'id' => 'tw_access_id',
    'type' => 'text',
    'mod' => 'large',
    'name' => 'Access Token',
    'desc' => 'To get this key, please go to <a href="https://dev.twitter.com/apps/new">https://dev.twitter.com/apps/new</a>',
    'std' => "",
);
$options[] = array(
    'id' => 'tw_access_secret',
    'type' => 'text',
    'mod' => 'large',
    'name' => 'Access Token Secret',
    'desc' => 'To get this key, please go to <a href="https://dev.twitter.com/apps/new">https://dev.twitter.com/apps/new</a>',
    'std' => "",
);


$options[] = array(
    "type" => "sectionend");
//END TWITTER
//START INSTAGRAM
$options[] = array(
    "name" => "<i class='icon-instagram'></i> Instagram API",
    "type" => "sectionstart");

$options[] = array(
    "name" => "Instagram info",
    "id" => "Instagram-info",
    "text" => '<b>1.</b> Create a new application <a href="http://instagram.com/developer/clients/manage/#">HERE</a>.<br><br><b>Set the "Redirect URI" to "' . SITE_URL . '/wp-admin/themes.php?page=optionsframework"</b>. <br><br>Get both the "Client ID" and the "Client Secret" keys and paste them into the appropriate fields below.
                        <br><br><strong><u>Save the Theme Options and refresh this page (F5).</u></strong>
                        <br><br>
                        <b>2.</b> Now click on the "Get Instagram Access Token". 
                        <br><br><strong><u>Save the Theme Options and refresh this page again.</u></strong>
                        <br><br>
                        <i>To get your USER ID, please click <a href="http://jelled.com/instagram/lookup-user-id">here</a> (you need this ID for setting up the J&W - Social Widget).</i>',
    "type" => "info",
    "space" => false,
    "message" => "info"
);

$options[] = array(
    'id' => 'i_client_id',
    'type' => 'text',
    'mod' => 'large',
    'name' => 'App Client ID',
    'desc' => 'To get this key, please go to <a href="http://instagram.com/developer/clients/manage/#">http://instagram.com/developer/clients/manage/#</a>',
    'std' => "",
);

$options[] = array(
    'id' => 'i_client_secret',
    'type' => 'text',
    'mod' => 'large',
    'name' => 'App Client Secret',
    'desc' => 'To get this key, please go to <a href="http://instagram.com/developer/clients/manage/#">http://instagram.com/developer/clients/manage/#</a>',
    'std' => "",
);


$options[] = array(
    'id' => 'instagram_token',
    'type' => 'instagram',
    'name' => 'Instagram App',
    'desc' => 'Follow the instructions in the cyan box above, please.',
    'std' => "",
);

$options[] = array(
    "type" => "sectionend");
    
    
    
//START youtube
$options[] = array(
    "name" => "<i class='jaw-icon-instagram'></i> YouTube API",
    "type" => "sectionstart");

$options[] = array(
    "name" => "YouTube info",
    "id" => "youtube-info",
    "text" => '<b>1.</b> Create a new project <a href="https://console.developers.google.com/project" target="_blank">HERE</a>.<br><br>
    <b>2.</b> Set the name. Click "Create"<br><br>
    <b>3.</b> Go to APIs&auth -> APIs (on the left side) and click the YouTube Data API.<br><br>
    <b>4.</b> Click the Enable API.<br><br>
    <b>5.</b> Got to APIs&auth -> APIs -> Credentials. Create new Client ID. Select "Web application". Click the "Configure consent screen". <br><br>
    <b>6.</b> Set the "Product name" and click the "Save" button.<br><br>
    <b>7.</b> Set the "Authorized JavaScript origins" url to your domain url.<br><br>
    <b>8.</b> Set the"Authorized redirect URIs" to "' . SITE_URL . '/wp-admin/themes.php?page=optionsframework". Click the "Create Client ID"<br><br>
    <b>9.</b> Get both the "Client ID" and the "Client Secret" keys and paste them into the appropriate fields below.
    <br><br><strong><u>Save the Theme Options and refresh this page (F5).</u></strong>
    <br><br>
    <b>10.</b> Now click on the "Get YouTube Access Token". 
    <br><br><strong><u>Save the Theme Options and refresh this page again.</u></strong>
    <br><br>
    <i>To get your USER ID, please click <a href="http://jelled.com/instagram/lookup-user-id">here</a> (you need this ID for setting up the J&W - Social Widget).</i>',
    "type" => "info",
    "space" => false,
    "message" => "info"
);

$options[] = array(
    'id' => 'y_client_id',
    'type' => 'text',
    'mod' => 'large',
    'name' => 'App Client ID',
    'desc' => 'To get this key, please go to <a href="https://console.developers.google.com/project" target="_blank">HERE</a>',
    'std' => "",
);

$options[] = array(
    'id' => 'y_client_secret',
    'type' => 'text',
    'mod' => 'large',
    'name' => 'App Client Secret',
    'desc' => 'To get this key, please go to <a href="https://console.developers.google.com/project" target="_blank">HERE</a>',
    'std' => "",
);


$options[] = array(
    'id' => 'youtube_token',
    'type' => 'youtube',
    'name' => 'YouTube App Tokens',
    'desc' => 'Follow the instructions in the cyan box above, please.',
    'std' => "",
);

$options[] = array(
    "type" => "sectionend");
// END youtube


$options[] = array(
    "name" => "<i class='icon-thumblr2'></i> Thumblr API",
    "type" => "sectionstart");

$options[] = array(
    'id' => 't_api_key',
    'type' => 'text',
    'mod' => 'large',
    'name' => 'Api key',
    'desc' => 'To get this key, please go to <a href="https://www.tumblr.com/oauth/apps">https://www.tumblr.com/oauth/apps</a>',
    'std' => "",
);

$options[] = array(
    'id' => 't_api_secret',
    'type' => 'text',
    'mod' => 'large',
    'name' => 'Api secret',
    'desc' => 'To get this key, please go to <a href="https://www.tumblr.com/oauth/apps">https://www.tumblr.com/oauth/apps</a>',
    'std' => "",
);



$options[] = array(
    "type" => "sectionend");




$options[] = array(
    "name" => "Comments Antispam Question " . jwUtils::getHelp("", "Comments.jpg"),
    "type" => "sectionstart");


$options[] = array(
    'id' => 'comments_antispam_toggle',
    'type' => 'toggle',
    'name' => 'Enable an Antispam Question',
    'desc' => 'Turn on this option to add an antispam question to all comment box.',
    'std' => '0'
);


$options[] = array(
    'id' => 'comments_antispam_question',
    'type' => 'text',
    'mod' => 'large',
    'name' => 'Comments Antispam Question',
    'desc' => 'Fill in the field with a question to be answered by user before inserting comment.',
    'std' => "1+1=",
);

$options[] = array(
    'id' => 'comments_antispam_answer',
    'type' => 'text',
    'mod' => 'large',
    'name' => 'Comments Antispam Answer',
    'desc' => 'Insert a proper answer to the question above.',
    'std' => "2",
);

$options[] = array(
    "type" => "sectionend");

//START Animation
$options[] = array(
    "name" => "Animation",
    "type" => "sectionstart");

$options[] = array(
    'id' => 'animate',
    'type' => 'toggle',
    'name' => 'Animate Image',
    'desc' => 'Decide whether or not to apply an animation effect to your images with a globall effectiveness.',
    'std' => 'animate',
    "options" => array("no-animate" => "NO animate", "animate" => "Animate")
);


$options[] = array(
    'id' => 'animate_style',
    'type' => 'select',
    'name' => 'Animation Style',
    'desc' => 'Select the animation style you prefer.',
    'std' => 'slide',
    'mod' => 'medium',
    "options" => array("blind" => "Blind", "bounce" => "Bounce", "clip" => "Clip"
        , "drop" => "Drop", "explode" => "Explode", "fold" => "Fold", "highlight" => "Highlight"
        , "puff" => "Puff", "pulsate" => "Pulsate", "shake" => "Shake", "slide" => "Slide")
);

$options[] = array(
    'id' => 'animate_direction',
    'type' => 'select',
    'name' => 'Animation Direction',
    'desc' => 'Select a direction. This option takes effect just on some animation styles.',
    'std' => 'left',
    'mod' => 'medium',
    "options" => array("left" => "Left", "right" => "Right", "top" => "Top", "down" => "Down")
);

$options[] = array(
    'id' => 'animate_duration',
    'type' => 'range',
    'name' => 'Animation Speed',
    'desc' => 'Set animation speed in miliseconds.',
    'std' => '800',
    'min' => '100',
    'max' => '3000',
    'step' => '100',
    'unit' => 'ms'
);

$options[] = array(
    'id' => 'animate_easing',
    'type' => 'select',
    'name' => 'Animation Easing',
    'desc' => 'Select the easing effect you prefer. To learn more about the available effects, visit this <a href="http://jqueryui.com/resources/demos/effect/easing.html">help</a> link, please.',
    'std' => 'swing',
    'mod' => 'medium',
    "options" => array('linear' => 'linear', 'swing' => 'swing',
        'easeInQuad' => 'easeInQuad', 'easeOutQuad' => 'easeOutQuad',
        'easeInOutQuad' => 'easeInOutQuad', 'easeInCubic' => 'easeInCubic',
        'easeOutCubic' => 'easeOutCubic', 'easeInOutCubic' => 'easeInOutCubic',
        'easeInQuart' => 'easeInQuart', 'easeOutQuart' => 'easeOutQuart',
        'easeInOutQuart' => 'easeInOutQuart', 'easeInQuint' => 'easeInQuint',
        'easeOutQuint' => 'easeOutQuint', 'easeInOutQuint' => 'easeInOutQuint',
        'easeInExpo' => 'easeInExpo', 'easeOutExpo' => 'easeOutExpo',
        'easeInOutExpo' => 'easeInOutExpo', 'easeInSine' => 'easeInSine',
        'easeOutSine' => 'easeOutSine', 'easeInOutSine' => 'easeInOutSine',
        'easeInCirc' => 'easeInCirc', 'easeOutCirc' => 'easeOutCirc',
        'easeInOutCirc' => 'easeInOutCirc', 'easeInElastic' => 'easeInElastic',
        'easeOutElastic' => 'easeOutElastic', 'easeInOutElastic' => 'easeInOutElastic',
        'easeInBack' => 'easeInBack', 'easeOutBack' => 'easeOutBack',
        'easeInOutBack' => 'easeInOutBack', 'easeInBounce' => 'easeInBounce',
        'easeOutBounce' => 'easeOutBounce', 'easeInOutBounce' => 'easeInOutBounce')
);

$options[] = array(
    "type" => "sectionend");
//END Animation




$options[] = array(
    "name" => "SEO",
    "type" => "sectionstart"
);


$options[] = array(
    'id' => 'use_jaw_seo',
    'type' => 'toggle',
    'name' => 'Use Built-in SEO',
    'desc' => 'You can deactivate build-in SEO if you want to use some SEO plugin.',
    'std' => '1',
);

$options[] = array(
    'id' => 'use_jaw_seo_logo',
    'type' => 'toggle',
    'name' => 'Logo in H1',
    'desc' => '',
    'std' => '1',
);


$options[] = array(
    "type" => "sectionend"
);


$options[] = array("type" => "headingend");

// WooCommerce **********************************************************
$options[] = array("name" => "Woocommerce",
    "type" => "headingstart");

if (!class_exists('WooCommerce')) {
    $options[] = array(
        "name" => "Install Woocommerce",
        "id" => "info-woo",
        "text" => "<h3 style=\"margin: 0 0 10px;\">Info:</h3> You have probably not installed woocommerce plugin. Please install it from <a href=\'http://wordpress.org/plugins/woocommerce/\'>here</a>.",
        "type" => "info",
        "space" => false,
        "message" => "info"
    );  
}

$options[] = array(
    'id' => 'woo_catalog',
    'type' => 'toggle',
    'name' => 'All Site Catalog Mod',
    'desc' => '',
    'std' => '0',
    'options' => array("1" => "On", "0" => "Off")
);

$options[] = array(
    'id' => 'woo_signedin_price',
    'type' => 'toggle',
    'name' => 'Show price for logged users only',
    'desc' => '',
    'std' => '0',
    'options' => array("1" => "On", "0" => "Off")
);

$options[] = array("name" => "Products per Page",
    "desc" => "Enter a number of Products per Page.",
    "id" => "products_per_page",
    "std" => get_option('posts_per_page'),
    "mod" => 'micro',
    "type" => "text"
);


$options[] = array(
    'id' => 'woo_type',
    'name' => 'Product Box Style',
    'desc' => 'Select one from the preset appearances of your product boxes.',
    'std' => '0',
    'mod' => 'small',
    "type" => "layout",
    "options" => array(
        '0' => ADMIN_DIR . 'assets/images/product_boxees/product-light.png',
        '1' => ADMIN_DIR . 'assets/images/product_boxees/product-color.png',
        '2' => ADMIN_DIR . 'assets/images/product_boxees/product-boxed.png',
        '10' => ADMIN_DIR . 'assets/images/product_boxees/product-small-light.png',
        '11' => ADMIN_DIR . 'assets/images/product_boxees/product-small-color.png',
        '20' => ADMIN_DIR . 'assets/images/product_boxees/product-list.png'
    )
);

$options[] = array(
    'id' => 'woo_animation',
    'type' => 'toggle',
    'name' => 'Product Box Image Animation',
    'desc' => 'Choose a behaviour of images in the product boxes when mouse is moved over them. Select Off option to disable a mouse-over effect.',
    'std' => 'simple',
    'mod' => 'small',
    'options' => array("off" => "Off", "simple" => "Simple Hover", "animated" => "Fade")
);

$options[] = array(
    'id' => 'woo_breadcrumbs',
    'type' => 'toggle',
    'name' => 'Show Breadcrumbs',
    'desc' => 'Show a breadcrumb navigation in product categories and inside products.',
    'std' => '1',
    'options' => array("1" => "On", "0" => "Off")
);

$options[] = array(
    'id' => 'woo_breadcrumbs_show_shop',
    'type' => 'toggle',
    'name' => 'Show "Shop" in Breadcrumbs',
    'desc' => 'Show a link to Shop page on breadcrumb navigation in product categories and inside products.',
    'std' => '0',
    'options' => array("1" => "On", "0" => "Off")
);

$options[] = array(
    'id' => 'woo_bar_type',
    'type' => 'toggle',
    'name' => 'Product Category & Tag Bar Type ' . jwUtils::getHelp("", "BarType.jpg"),
    'desc' => 'Select the style of category titles you prefer.',
    'std' => 'big',
    "options" => array("line" => "Line", "box" => "Box", "big" => "Big Title")
);

$options[] = array("name" => "Product Titles - Number of Characters",
    "desc" => "Enter a number of characters for your post titles.",
    "id" => "letter_excerpt_title",
    "std" => -1,
    "mod" => 'micro',
    'maxlength' => 4,
    "type" => "text"
);


$options[] = array("name" => "Excerpt - Number of Characters",
    "desc" => "Enter a number of characters in the preview content.",
    "id" => "letter_excerpt",
    "std" => -1,
    "mod" => 'micro',
    'maxlength' => 4,
    "type" => "text"
);

$options[] = array("name" => "Category Titles - Number of Characters",
    "desc" => 'Number of characters in category boxes.',
    "id" => "letter_excerpt_cat_title",
    "std" => -1,
    "mod" => 'micro',
    'maxlength' => 4,
    "type" => "text"
);
$options[] = array("name" => "Cut Category Titles in Widget",
    "desc" => 'Number of characters in category names in Widget Product Categories.',
    "id" => "cut_category_titles",
    "std" => 'non-shorten-category-names',
    "type" => "toggle",
    "options" => array("shorten-category-names" => "On", "non-shorten-category-names" => "Off")
);
$options[] = array(
    'id' => 'woo_number_of_items',
    'type' => 'toggle',
    'name' => 'Product Category Box - Show Number of Items',
    'desc' => '',
    'std' => '1',
);
$options[] = array("name" => "Widget Product Tag Limit",
    "desc" => 'Number of Product Tags Showing in Widget.',
    "id" => "product_tag_limit",
    "std" => 0,
    "mod" => 'micro',
    'maxlength' => 4,
    "type" => "text"
);




/* Shop page */
$options[] = array(
    "name" => "Shop Page",
    "type" => "sectionstart");

$options[] = array(
    "name" => "Shop Page Layout",
    "desc" => "Select a main content and sidebar alignment.",
    "id" => "shop_layout",
    "std" => 'fullwidth',
    "type" => "layout",
    "extend" => 'woo__shop_sidebar',
    "options" => array(
        'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
        'left1' => ADMIN_DIR . 'assets/images/left_sidebar.gif',
        'right1' => ADMIN_DIR . 'assets/images/right_sidebar.gif'
    )
);

$options[] = array(
    'id' => 'woo__shop_sidebar_left1',
    'type' => 'sidebar_select',
    'name' => 'Shop Left Sidebars',
    'desc' => 'Select an optional sidebar. You can create your custom sidebars in <b>Sidebar Manager</b>.',
    'std' => null,
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'woo__shop_sidebar_right1',
    'type' => 'sidebar_select',
    'name' => 'Shop Right Sidebars',
    'desc' => 'Select an optional sidebar. You can create your custom sidebars in <b>Sidebar Manager</b>.',
    'std' => null,
    'mod' => 'medium'
);

$options[] = array(
    "type" => "sectionend");


/* Product */
$options[] = array(
    "name" => "Product Page",
    "type" => "sectionstart");

$options[] = array(
    "name" => "Product Page Layout",
    "desc" => "Select a main content and sidebar alignment.",
    "id" => "product_layout",
    "std" => 'fullwidth',
    "type" => "layout",
    "extend" => 'woo_sidebar',
    "options" => array(
        'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
        'left1' => ADMIN_DIR . 'assets/images/left_sidebar.gif',
        'right1' => ADMIN_DIR . 'assets/images/right_sidebar.gif'
    )
);

$options[] = array(
    'id' => 'woo_sidebar_left1',
    'type' => 'sidebar_select',
    'name' => 'Product Left Sidebars',
    'desc' => 'Select an optional sidebar. You can create your custom sidebars in <b>Sidebar Manager</b>.',
    'std' => null,
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'woo_sidebar_right1',
    'type' => 'sidebar_select',
    'name' => 'Product Right Sidebars',
    'desc' => 'Select an optional sidebar. You can create your custom sidebars in <b>Sidebar Manager</b>.',
    'std' => null,
    'mod' => 'medium'
);
$options[] = array(
    'id' => 'woo_show_sale',
    'type' => 'toggle',
    'name' => 'Amount Saved (on sale products)',
    'desc' => 'Show amount saved in product details.',
    'std' => '0',
    'options' => array("0" => "Off", "price" => "Differce of price", 'percentagle' => 'Pecentagle difference')
);
$options[] = array(
    'id' => 'woo_product_thumbnails_columns',
    'type' => 'text',
    'name' => 'Number of Thumbnails per One Row under Featured image',
    'desc' => 'Number of Thumbnails per One Row on Product Details Page. Maximum is 6',
    'std' => '3',
    'mod' => 'mini'
);
$options[] = array(
    'id' => 'woo_social_share',
    'type' => 'toggle',
    'name' => 'Show Social Share on Product Page',
    'desc' => '',
    'std' => '1'
);

$options[] = array(
    'id' => 'woo_single_product_categories',
    'type' => 'toggle',
    'name' => 'Show Product Categories on Product Page',
    'desc' => '',
    'std' => '1'
);

$options[] = array(
    'id' => 'woo_product_tags',
    'type' => 'toggle',
    'name' => 'Show Product Tags on Product Page',
    'desc' => '',
    'std' => '1'
);

$options[] = array(
    'id' => 'woo_skus',
    'type' => 'toggle',
    'name' => 'Show Product SKU on Product Page',
    'desc' => '',
    'std' => '1'
);

$options[] = array(
    'id' => 'woo_tabs_style',
    'type' => 'toggle',
    'name' => 'Style of Description',
    'desc' => '',
    'std' => 'tabs',
    'options' => array("tabs" => "Tabs", "list" => "List")
);

$options[] = array(
    'id' => 'woo_number_related_produts',
    'type' => 'text',
    'name' => 'Number of Related Products',
    'desc' => 'Set number of related products.',
    'std' => '6',
    'mod' => 'mini'
);

$options[] = array(
    'id' => 'woo_related_type',
    'type' => 'toggle',
    'name' => 'Related Product Box Style',
    'desc' => 'Select one of the preset appearances of your product boxes for the related products.',
    'std' => '0',
    'mod' => 'small',
    'options' => array("0" => "Light", "1" => "Color", "2" => "Boxed")
);


$options[] = array(
    "type" => "sectionend");

/* Product Page - Catalog mode ********************************************** */
$options[] = array(
    "name" => "Product Page - Catalog mode",
    "type" => "sectionstart");

$options[] = array(
    'id' => 'woo_product_product_link',
    'type' => 'toggle',
    'name' => 'Normal product link',
    'desc' => 'Show button with link to product.',
    'std' => '1',
    'mod' => 'small',
    'options' => array("1" => "On", "0" => "Off")
);
$options[] = array(
    "name" => "Normal product link target",
    "desc" => "",
    "id" => "woo_product_product_target",
    "std" => "_self",
    "type" => "select",
    "options" => array("_blank" => "_blank", "_top" => "_top", "_parent" => "_parent", "_self" => "_self"));


$options[] = array(
    "type" => "sectionend");



$options[] = array(
    "name" => "Product Page - Sharing Options",
    "desc" => "Select the social networks or services whose icons have to be added to the Share Product Bar.",
    "type" => "sectionstart");


$options[] = array(
    'id' => 'product_share_fb',
    'type' => 'toggle',
    'name' => 'Share Post Facebook',
    'std' => '1',
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'product_share_tw',
    'type' => 'toggle',
    'name' => 'Share Post Twitter',
    'std' => '1',
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'product_share_g',
    'type' => 'toggle',
    'name' => 'Share Post Google',
    'std' => '1',
    'mod' => 'medium'
);
$options[] = array(
    'id' => 'product_share_pi',
    'type' => 'toggle',
    'name' => 'Share Post Pinterest',
    'std' => '1',
    'mod' => 'medium'
);
$options[] = array(
    'id' => 'product_share_mail',
    'type' => 'toggle',
    'name' => 'Share Post via E-mail',
    'std' => '1',
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'product_share_mail_content',
    'type' => 'text',
    'name' => 'Default email address',
    'desc' => 'Enter a default email address you want to show.',
    'std' => 'youremail@addresshere.com',
    'mod' => 'mid'
);





$options[] = array(
    "type" => "sectionend"
);

/* Product CAT */
$options[] = array(
    "name" => "Product Category",
    "type" => "sectionstart");

$options[] = array(
    "name" => "Product Category Layout",
    "desc" => "Select a main content and sidebar alignment.",
    "id" => "product_cat_layout",
    "std" => 'right',
    "type" => "layout",
    "extend" => 'product_cat_sidebar',
    "options" => array(
        'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
        'left1' => ADMIN_DIR . 'assets/images/left_sidebar.gif',
        'right1' => ADMIN_DIR . 'assets/images/right_sidebar.gif'
    )
);

$options[] = array(
    'id' => 'product_cat_sidebar_left1',
    'type' => 'sidebar_select',
    'name' => 'Product Category Left Sidebars',
    'desc' => 'Select an optional sidebar. You can create your custom sidebars in <b>Sidebar Manager</b>.',
    'std' => null,
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'product_cat_sidebar_right1',
    'type' => 'sidebar_select',
    'name' => 'Product Category Right Sidebars',
    'desc' => 'Select an optional sidebar. You can create your custom sidebars in <b>Sidebar Manager</b>.',
    'std' => null,
    'mod' => 'medium'
);

$options[] = array(
    "type" => "sectionend");

/* Product TAG */
$options[] = array(
    "name" => "Product Tag",
    "type" => "sectionstart");

$options[] = array(
    "name" => "Product Tag Layout",
    "desc" => "Select a main content and sidebar alignment.",
    "id" => "product_tag_layout",
    "std" => 'right',
    "type" => "layout",
    "extend" => 'product_tag_sidebar',
    "options" => array(
        'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
        'left1' => ADMIN_DIR . 'assets/images/left_sidebar.gif',
        'right1' => ADMIN_DIR . 'assets/images/right_sidebar.gif'
    )
);

$options[] = array(
    'id' => 'product_tag_sidebar_left1',
    'type' => 'sidebar_select',
    'name' => 'Product Tag Left Sidebars',
    'desc' => 'Select an optional sidebar. You can create your custom sidebars in <b>Sidebar Manager</b>.',
    'std' => null,
    'mod' => 'medium'
);

$options[] = array(
    'id' => 'product_tag_sidebar_right1',
    'type' => 'sidebar_select',
    'name' => 'Product Tag Right Sidebars',
    'desc' => 'Select an optional sidebar. You can create your custom sidebars in <b>Sidebar Manager</b>.',
    'std' => null,
    'mod' => 'medium'
);

$options[] = array(
    "type" => "sectionend");

$options[] = array(
    "name" => "eCommerce Google Analytics",
    "type" => "sectionstart");

$options[] = array(
    'id' => 'woo_analytics',
    'type' => 'toggle',
    'name' => 'Use eCommerce Google Analytics',
    'desc' => '',
    'std' => '0',
    'options' => array("1" => "On", "0" => "Off")
);

$options[] = array(
    'id' => 'woo_analytics_code',
    'type' => 'text',
    'name' => 'Google Analytics Code',
    'desc' => '',
    'std' => 'UA-XXXXXXXX'
);

$options[] = array(
    "type" => "sectionend");

$options[] = array("type" => "headingend");


$menu['generalsettings'] = array('submenu' => 0, 'name' => 'General Settings');
$menu['headersettings'] = array('submenu' => 0, 'name' => 'Header Settings');

$menu['featuredarea'] = array('submenu' => 1, 'name' => 'Featured Area');
$menu['settings'] = array('submenu' => 1, 'name' => 'Settings');
$menu['jawslider'] = array('submenu' => -1, 'name' => 'JaW Slider');

$menu['footer'] = array('submenu' => 0, 'name' => 'Footer Settings');

$menu['blogposts'] = array('submenu' => 1, 'name' => 'Blog & Posts');
$menu['postssettings'] = array('submenu' => 1, 'name' => 'Posts Settings');
if (is_plugin_active('jaw-customposts/jawcustomposts.php')) {
    $menu['mainblog'] = array('submenu' => 1, 'name' => 'Main Blog');
    $menu['customposttypes'] = array('submenu' => -1, 'name' => 'Custom PostTypes');
} else {
    $menu['mainblog'] = array('submenu' => -1, 'name' => 'Main Blog');
}

$menu['singlepost'] = array('submenu' => 0, 'name' => 'Single Post');

$menu['sidebarmanager'] = array('submenu' => 0, 'name' => 'Sidebar Manager');

$menu['customcode'] = array('submenu' => 0, 'name' => 'Custom Code');

$menu['stylingoptions'] = array('submenu' => 0, 'name' => 'Styling Options');

$menu['advertisementd'] = array('submenu' => 1, 'name' => 'Advertisement');
$menu['banner-background'] = array('submenu' => 1, 'name' => 'Banner - Background');
$menu['banner-leaderboard'] = array('submenu' => 1, 'name' => 'Banner - Leaderboard');

$menu['banner-skyscrapperright'] = array('submenu' => 1, 'name' => 'Banner - Skyscraper Right');
$menu['banner-skyscrapperleft'] = array('submenu' => 1, 'name' => 'Banner - Skyscraper Left');
$menu['bannerinpost-top'] = array('submenu' => 1, 'name' => 'Banner in Post - Top');
$menu['bannerinpost-bottom'] = array('submenu' => 1, 'name' => 'Banner in Post - Bottom');
$menu['banner-custom1'] = array('submenu' => 1, 'name' => 'Banner - Custom 1');
$menu['banner-custom2'] = array('submenu' => -1, 'name' => 'Banner - Custom 2');

$menu['error404'] = array('submenu' => 0, 'name' => 'Error 404');

$menu['backupoptions'] = array('submenu' => 0, 'name' => 'Backup');

$menu['demodata'] = array('submenu' => 0, 'name' => 'Demo');

$menu['translations'] = array('submenu' => 0, 'name' => 'Translations');

$menu['advanced'] = array('submenu' => 0, 'name' => 'Advanced');

if (class_exists('WooCommerce')) {
    $menu['woocommerce'] = array('submenu' => 0, 'name' => 'Woocommerce');
}


