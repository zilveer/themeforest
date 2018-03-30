<?php

global $metaprductcat,$metaprduct;
/**
 * Definition metabox for category
 */
$metaprductcat = array(
    "id" => "product_cat",
    "pages" => array("product_cat"),
    "fields" => array()
);

$metaprductcat['fields'][] = array(
    'id' => '_cat_description_mode',
    'type' => 'select',
    'name' => 'Position of Description',
    'desc' => 'Show Description above layout or next to sidebar',
    'std' => 'layout',
    'mod' => 'medium',
    "options" => array(
        'fullwidth' => 'Above layout (above sidebar)',
        'layout' => 'Keep layout (next to sidebar)',
        'bottom' => 'Under poducts (next to sidebar)'
    )
);

if (class_exists('RevSlider')) {
    $slider = new RevSlider();


$of_options = array();

$sliders_list = $slider->getArrSliders();
$sliders = array();

foreach ($sliders_list as $item) {
    $sliders[$item->getParam('alias')] = $item->getParam('title');
}
    $metaprductcat['fields'][] = array(
        'id' => 'slider',
        'type' => 'select',
        'name' => 'Revolution Slider',
        'desc' => '',
        'std' => '',
        'mod' => 'medium',
        'options' => (array('off' => 'off') + $sliders)
    );
}



$metaprductcat['fields'][] = array(
    "name" => "Category Layout",
    "desc" => "Choose one of the preset layouts for your Category.",
    "id" => "_prod_cat_layout",
    "std" => 'default',
    "type" => "layout",
    "extend" => "_cat_sidebar1",
    "options" => array(
        'default' => ADMIN_DIR . 'assets/images/default.gif',
        'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
        'right1' => ADMIN_DIR . 'assets/images/right_sidebar.gif',
        'left1' => ADMIN_DIR . 'assets/images/left_sidebar.gif')
);

$metaprductcat['fields'][] = array(
    'id' => '_prod_cat_sidebar_left1',
    'type' => 'sidebar_select',
    'name' => 'Category Left Sidebars',
    'desc' => 'Here you can add some optional sidebars.',
    'std' => '',
    'mod' => 'medium'
);

$metaprductcat['fields'][] = array(
    'id' => '_prod_cat_sidebar_right1',
    'type' => 'sidebar_select',
    'name' => 'Category Right Sidebars',
    'desc' => 'Here you can add some optional sidebars.',
    'std' => '',
    'mod' => 'medium'
);



$metaprductcat['fields'][] = array(
    "name" => "Category Product Layout",
    "desc" => "Choose one of the preset layouts for products in this category.",
    "id" => "_cat_products_layout",
    "std" => 'default',
    "type" => "layout",
    "options" => array(
        'default' => ADMIN_DIR . 'assets/images/default.gif',
        'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
        'right1' => ADMIN_DIR . 'assets/images/right_sidebar.gif',
        'left1' => ADMIN_DIR . 'assets/images/left_sidebar.gif')
);

$metaprductcat['fields'][] = array(
    'id' => '_cat_products_sidebar_left1',
    'type' => 'sidebar_select',
    'name' => 'Category Posts Left Sidebars',
    'desc' => 'Here you can add some optional sidebars.',
    'std' => '',
    'mod' => 'medium'
);

$metaprductcat['fields'][] = array(
    'id' => '_cat_products_sidebar_right1',
    'type' => 'sidebar_select',
    'name' => 'Category Posts Right Sidebars',
    'desc' => 'Here you can add some optional sidebars.',
    'std' => '',
    'mod' => 'medium'
);

$metaprductcat['fields'][] = array(
    'id' => '_cat_catalog_mode',
    'type' => 'select',
    'name' => 'Category as catalog',
    'desc' => '',
    'std' => 'off',
    'mod' => 'medium',
    "options" => array(
        'off' => 'Off',
        'on' => 'On'
    )
);

$metaprduct = array(
    "id" => "jawproduct",
    "title" => "General Settings",
    "pages" => array('product'),
    "context" => "normal", //Optional. The context within the page where the boxes should show ('normal', 'advanced')
    "priority" => "high", //Optional. The priority within the context where the boxes should show ('high', 'low').
    "desc" => null,
    "fields" => array()
);

$metaprduct['fields'][] = array(
    'id' => '_prod_product_link',
    'type' => 'select',
    'name' => 'Catalog mode - link to normal product',
    'desc' => 'The button with a link to the product.',
    'std' => '2',
    'mod' => 'small',
    'options' => array("2" => "Global", "0" => "Off", "1" => "On")
);

$metaprduct['fields'][] = array(
    'id' => '_prod_product_custom_link',
    'type' => 'text',
    'name' => 'Catalog mode - custom product link',
    'desc' => 'Link to product on another e-shop. If the field is not filled, so apply a link to the current site.',
    'std' => '',
    'mod' => 'big'
);

$metaprduct['fields'][] = array(
    'id' => '_prod_product_custom_desc',
    'type' => 'textarea',
    'name' => 'Catalog mode - custom product description',
    'desc' => 'The custom description of the product in catalog mode.',
    'std' => '',
    'cols' => '100',
    'rows' => '8',
    'mod' => 'big'
);

$metaprduct['fields'][] = array(
    'id' => '_prod_lookbook_alternative_title',
    'type' => 'text',
    'name' => 'Lookbook - custom product title',
    'desc' => 'Alternative product title in lookbook.',
    'std' => '',
    'mod' => 'big'
);

$metaprduct['fields'][] = array(
    'id' => '_prod_lookbook_alternative_desc',
    'type' => 'textarea',
    'name' => 'Lookbook - custom product description',
    'desc' => 'Custom product description in lookbook.',
    'std' => '',
    'cols' => '100',
    'rows' => '8',
    'mod' => 'big'
);

$metaprduct['fields'][] = array(
    "name" => "Product Layout",
    "desc" => "Choose one of the preset layouts for your product.",
    "id" => "_prod_layout",
    "std" => 'default',
    "type" => "layout",
    "extend" => "_sidebar1",
    "options" => array(
        'default' => ADMIN_DIR . 'assets/images/default.gif',
        'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
        'right1' => ADMIN_DIR . 'assets/images/right_sidebar.gif',
        'left1' => ADMIN_DIR . 'assets/images/left_sidebar.gif')
);

$metaprduct['fields'][] = array(
    'id' => '_prod_sidebar_left1',
    'type' => 'sidebar_select',
    'name' => 'Product Left Sidebars',
    'desc' => 'Here you can add some optional sidebars.',
    'std' => '',
    'mod' => 'medium'
);

$metaprduct['fields'][] = array(
    'id' => '_prod_sidebar_right1',
    'type' => 'sidebar_select',
    'name' => 'Product Right Sidebars',
    'desc' => 'Here you can add some optional sidebars.',
    'std' => '',
    'mod' => 'medium'
);