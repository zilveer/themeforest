<?php

function porto_check_theme_options() {
    // check default options
    global $porto_settings;

    ob_start();
    include(porto_admin . '/theme_options/default_options.php');
    $options = ob_get_clean();
    $porto_default_settings = json_decode($options, true);

    foreach ($porto_default_settings as $key => $value) {
        if (is_array($value)) {
            foreach ($value as $key1 => $value1) {
                if ($key1 != 'google' && (!isset($porto_settings[$key][$key1]) || !$porto_settings[$key][$key1])) {
                    $porto_settings[$key][$key1] = $porto_default_settings[$key][$key1];
                }
            }
        } else {
            if (!isset($porto_settings[$key])) {
                $porto_settings[$key] = $porto_default_settings[$key];
            }
        }
    }

    return $porto_settings;
}

function porto_options_sidebars() {
    return array(
        'wide-left-sidebar',
        'wide-right-sidebar',
        'left-sidebar',
        'right-sidebar'
    );
}

function porto_options_body_wrapper() {
    return array(
        'wide' => array('alt' => 'Wide', 'img' => porto_options_uri.'/layouts/body_wide.jpg'),
        'full' => array('alt' => 'Full', 'img' => porto_options_uri.'/layouts/body_full.jpg'),
        'boxed' => array('alt' => 'Boxed', 'img' => porto_options_uri.'/layouts/body_boxed.jpg'),
    );
}

function porto_options_layouts() {
    return array(
        "widewidth" => array('alt' => 'Wide Width', 'img' => porto_options_uri.'/layouts/page_wide.jpg'),
        "wide-left-sidebar" => array('alt' => 'Wide Left Sidebar', 'img' => porto_options_uri.'/layouts/page_wide_left.jpg'),
        "wide-right-sidebar" => array('alt' => 'Wide Right Sidebar', 'img' => porto_options_uri.'/layouts/page_wide_right.jpg'),
        "fullwidth" => array('alt' => 'Without Sidebar', 'img' => porto_options_uri.'/layouts/page_full.jpg'),
        "left-sidebar" => array('alt' => "Left Sidebar", 'img' => porto_options_uri.'/layouts/page_full_left.jpg'),
        "right-sidebar" => array('alt' => "Right Sidebar", 'img' => porto_options_uri.'/layouts/page_full_right.jpg')
    );
}

function porto_options_wrapper() {
    return array(
        'wide' => array('alt' => 'Wide', 'img' => porto_options_uri.'/layouts/content_wide.jpg'),
        'full' => array('alt' => 'Full', 'img' => porto_options_uri.'/layouts/content_full.jpg'),
        'boxed' => array('alt' => 'Boxed', 'img' => porto_options_uri.'/layouts/content_boxed.jpg'),
    );
}

function porto_options_banner_wrapper() {
    return array(
        'wide' => array('alt' => 'Wide', 'img' => porto_options_uri.'/layouts/content_wide.jpg'),
        'boxed' => array('alt' => 'Boxed', 'img' => porto_options_uri.'/layouts/content_boxed.jpg'),
    );
}

function porto_options_header_types() {
    return array(
        '1' => array('alt' => 'Header Type 1', 'img' => porto_options_uri.'/headers/header_01.jpg'),
        '2' => array('alt' => 'Header Type 2', 'img' => porto_options_uri.'/headers/header_02.jpg'),
        '3' => array('alt' => 'Header Type 3', 'img' => porto_options_uri.'/headers/header_03.jpg'),
        '4' => array('alt' => 'Header Type 4', 'img' => porto_options_uri.'/headers/header_04.jpg'),
        '5' => array('alt' => 'Header Type 5', 'img' => porto_options_uri.'/headers/header_05.jpg'),
        '6' => array('alt' => 'Header Type 6', 'img' => porto_options_uri.'/headers/header_06.jpg'),
        '7' => array('alt' => 'Header Type 7', 'img' => porto_options_uri.'/headers/header_07.jpg'),
        '8' => array('alt' => 'Header Type 8', 'img' => porto_options_uri.'/headers/header_08.jpg'),
        '9' => array('alt' => 'Header Type 9', 'img' => porto_options_uri.'/headers/header_09.jpg'),
        '10' => array('alt' => 'Header Type 10', 'img' => porto_options_uri.'/headers/header_10.jpg'),
        '11' => array('alt' => 'Header Type 11', 'img' => porto_options_uri.'/headers/header_11.jpg'),
        '12' => array('alt' => 'Header Type 12', 'img' => porto_options_uri.'/headers/header_12.jpg'),
        '13' => array('alt' => 'Header Type 13', 'img' => porto_options_uri.'/headers/header_13.jpg'),
        '14' => array('alt' => 'Header Type 14', 'img' => porto_options_uri.'/headers/header_14.jpg'),
        '15' => array('alt' => 'Header Type 15', 'img' => porto_options_uri.'/headers/header_15.jpg'),
        '16' => array('alt' => 'Header Type 16', 'img' => porto_options_uri.'/headers/header_16.jpg'),
        '17' => array('alt' => 'Header Type 17', 'img' => porto_options_uri.'/headers/header_17.jpg'),
        'side' => array('alt' => 'Header Type(Side Navigation)', 'img' => porto_options_uri.'/headers/header_side.jpg'),


    );
}

function porto_options_footer_types() {
    return array(
        '1' => array('alt' => 'Footer Type 1', 'img' => porto_options_uri.'/footers/footer_01.jpg'),
        '2' => array('alt' => 'Footer Type 2', 'img' => porto_options_uri.'/footers/footer_02.jpg'),
        '3' => array('alt' => 'Footer Type 3', 'img' => porto_options_uri.'/footers/footer_03.jpg')


    );
}

function porto_demo_filters() {
    return array(
        '*' => 'Show All',
        'demos' => 'Demos',
        'classic' => 'Classic',
        'corporate' => 'Corporate',
        'shop' => 'Shop',
        'dark' => 'Dark',
        'rtl' => 'RTL',
    );
}

function porto_demo_types() {
    return array(
        'classic-original' => array('alt' => 'Main Demo', 'img' => porto_options_uri.'/demos/classic_original.jpg', 'filter' => 'demos'),
        'construction' => array('alt' => 'Construction', 'img' => porto_options_uri.'/demos/demo_construction.jpg', 'filter' => 'demos'),
        'hotel' => array('alt' => 'Hotel', 'img' => porto_options_uri.'/demos/demo_hotel.jpg', 'filter' => 'demos'),
        'restaurant' => array('alt' => 'Restaurant', 'img' => porto_options_uri.'/demos/demo_restaurant.jpg', 'filter' => 'demos'),
        'law-firm' => array('alt' => 'Law Firm', 'img' => porto_options_uri.'/demos/demo_law_firm.jpg', 'filter' => 'demos'),
        'digital-agency' => array('alt' => 'Digital Agency', 'img' => porto_options_uri.'/demos/demo_digital_agency.jpg', 'filter' => 'demos'),
        'medical' => array('alt' => 'Medical', 'img' => porto_options_uri.'/demos/demo_medical.jpg', 'filter' => 'demos'),
        'landing' => array('alt' => 'Landing', 'img' => porto_options_uri.'/demos/landing.jpg', 'filter' => 'classic'),
        'classic-color' => array('alt' => 'Classic Color', 'img' => porto_options_uri.'/demos/classic_color.jpg', 'filter' => 'classic'),
        'classic-light' => array('alt' => 'Classic Light', 'img' => porto_options_uri.'/demos/classic_light.jpg', 'filter' => 'classic'),
        'classic-video' => array('alt' => 'Classic Video', 'img' => porto_options_uri.'/demos/classic_video.jpg', 'filter' => 'classic'),
        'classic-video-light' => array('alt' => 'Classic Video Light', 'img' => porto_options_uri.'/demos/classic_video_light.jpg', 'filter' => 'classic'),
        'corporate1' => array('alt' => 'Corporate 1', 'img' => porto_options_uri.'/demos/corporate_1.jpg', 'filter' => 'corporate'),
        'corporate2' => array('alt' => 'Corporate 2', 'img' => porto_options_uri.'/demos/corporate_2.jpg', 'filter' => 'corporate'),
        'corporate3' => array('alt' => 'Corporate 3', 'img' => porto_options_uri.'/demos/corporate_3.jpg', 'filter' => 'corporate'),
        'corporate4' => array('alt' => 'Corporate 4', 'img' => porto_options_uri.'/demos/corporate_4.jpg', 'filter' => 'corporate'),
        'corporate5' => array('alt' => 'Corporate 5', 'img' => porto_options_uri.'/demos/corporate_5.jpg', 'filter' => 'corporate'),
        'corporate6' => array('alt' => 'Corporate 6', 'img' => porto_options_uri.'/demos/corporate_6.jpg', 'filter' => 'corporate'),
        'corporate7' => array('alt' => 'Corporate 7', 'img' => porto_options_uri.'/demos/corporate_7.jpg', 'filter' => 'corporate'),
        'corporate8' => array('alt' => 'Corporate 8', 'img' => porto_options_uri.'/demos/corporate_8.jpg', 'filter' => 'corporate'),
        'corporate-hosting' => array('alt' => 'Corporate Hosting', 'img' => porto_options_uri.'/demos/corporate_hosting.jpg', 'filter' => 'corporate'),
        'shop1' => array('alt' => 'Shop 1', 'img' => porto_options_uri.'/demos/shop_1.jpg', 'filter' => 'shop'),
        'shop2' => array('alt' => 'Shop 2', 'img' => porto_options_uri.'/demos/shop_2.jpg', 'filter' => 'shop'),
        'shop3' => array('alt' => 'Shop 3', 'img' => porto_options_uri.'/demos/shop_3.jpg', 'filter' => 'shop'),
        'shop4' => array('alt' => 'Shop 4', 'img' => porto_options_uri.'/demos/shop_4.jpg', 'filter' => 'shop'),
        'shop5' => array('alt' => 'Shop 5', 'img' => porto_options_uri.'/demos/shop_5.jpg', 'filter' => 'shop'),
        'shop6' => array('alt' => 'Shop 6', 'img' => porto_options_uri.'/demos/shop_6.jpg', 'filter' => 'shop'),
        'shop7' => array('alt' => 'Shop 7', 'img' => porto_options_uri.'/demos/shop_7.jpg', 'filter' => 'shop'),
        'shop8' => array('alt' => 'Shop 8', 'img' => porto_options_uri.'/demos/shop_8.jpg', 'filter' => 'shop'),
        'shop9' => array('alt' => 'Shop 9', 'img' => porto_options_uri.'/demos/shop_9.jpg', 'filter' => 'shop'),
        'shop10' => array('alt' => 'Shop 10', 'img' => porto_options_uri.'/demos/shop_10.jpg', 'filter' => 'shop'),
        'dark' => array('alt' => 'Dark Original', 'img' => porto_options_uri.'/demos/dark_original.jpg', 'filter' => 'dark'),
        'rtl' => array('alt' => 'RTL Original', 'img' => porto_options_uri.'/demos/rtl_original.jpg', 'filter' => 'rtl'),
    );
}

function porto_options_breadcrumbs_types() {
    return array(
        '1' => array('alt' => 'Breadcrumbs Type 1', 'img' => porto_options_uri.'/breadcrumbs/breadcrumbs_01.jpg'),
        '2' => array('alt' => 'Breadcrumbs Type 2', 'img' => porto_options_uri.'/breadcrumbs/breadcrumbs_02.jpg'),
        '3' => array('alt' => 'Breadcrumbs Type 3', 'img' => porto_options_uri.'/breadcrumbs/breadcrumbs_03.jpg'),
        '4' => array('alt' => 'Breadcrumbs Type 4', 'img' => porto_options_uri.'/breadcrumbs/breadcrumbs_04.jpg'),
        '5' => array('alt' => 'Breadcrumbs Type 5', 'img' => porto_options_uri.'/breadcrumbs/breadcrumbs_05.jpg'),


    );
}

function porto_options_footer_columns() {
    return array(
        '1' => __('1 column - 1/12', 'porto'),
        '2' => __('2 columns - 1/6', 'porto'),
        '3' => __('3 columns - 1/4', 'porto'),
        '4' => __('4 columns - 1/3', 'porto'),
        '5' => __('5 columns - 5/12', 'porto'),
        '6' => __('6 columns - 1/2', 'porto'),
        '7' => __('7 columns - 7/12', 'porto'),
        '8' => __('8 columns - 2/3', 'porto'),
        '9' => __('9 columns - 3/4', 'porto'),
        '10' => __('10 columns - 5/6', 'porto'),
        '11' => __('11 columns - 11/12)', 'porto'),
        '12' => __('12 columns - 1/1', 'porto')
    );
}


