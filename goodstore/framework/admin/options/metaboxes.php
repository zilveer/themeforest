<?php

global $metapost, $metacat, $metapage; 

/**
 *  Defines metaboxes for pages and posts
 *  Warning id must prefix "_"  e.g.: id="_layout"
 * 
 * 
 */
$js_post_type = "jQuery(window).ready(function($){
   
if($('input:radio[name=post_format]:checked').val() == 'video'){
    prepinac_video(true);
    prepinac_gallery(false);
}else if($('input:radio[name=post_format]:checked').val() == 'gallery'){
    prepinac_gallery(true);
    prepinac_video(false);
}else{
    prepinac_video(false);
    prepinac_gallery(false);
}

jQuery('.post-format').click(function() {
    prepinac_video(false);
    prepinac_gallery(false);
});

jQuery('#post-format-video').click(function() {
     prepinac_video(true);
     prepinac_gallery(false);
});
jQuery('#post-format-gallery').click(function() {
     prepinac_video(false);
     prepinac_gallery(true);
});


function prepinac_video(sw){
    switch(sw){
    case true: $('#section-_post_video_link').show(300);
        break;
    case false: $('#section-_post_video_link').hide(300);
        break;   
    }
}

function prepinac_gallery(sw){
    switch(sw){
    case true: $('#section-_post_gallery').show(300);
        break;
    case false: $('#section-_post_gallery').hide(300);
        break;   
    }
}

});";

$metapost = array(
    "id" => "jawmetabox",
    "title" => "General Settings",
    "pages" => array('post'),
    "context" => "normal", //Optional. The context within the page where the boxes should show ('normal', 'advanced')
    "priority" => "high", //Optional. The priority within the context where the boxes should show ('high', 'low').
    "desc" => null,
    "js" => $js_post_type, //Oprional. Insert javascript
    "fields" => array()
);
$metapost['fields'][] = array(
    "name" => "Page Layout",
    "desc" => "Choose one of the preset layouts for your page." . ' ' . jwUtils::getHelp("4_1"),
    "id" => "_layout",
    "std" => 'default',
    "type" => "layout",
    "extend" => "_sidebar",
    "options" => array(
        'default' => ADMIN_DIR . 'assets/images/default.gif',
        'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
        'right1' => ADMIN_DIR . 'assets/images/right_sidebar.gif',
        'left1' => ADMIN_DIR . 'assets/images/left_sidebar.gif')
);

$metapost['fields'][] = array(
    'id' => '_sidebar_left1',
    'type' => 'sidebar_select',
    'name' => 'Blog Left Sidebars',
    'desc' => 'Here you can add some optional sidebars.',
    'std' => '',
    'mod' => 'medium'
);

$metapost['fields'][] = array(
    'id' => '_sidebar_right1',
    'type' => 'sidebar_select',
    'name' => 'Blog Right Sidebars',
    'desc' => 'Here you can add some optional sidebars.',
    'std' => '',
    'mod' => 'medium'
);


$metapost['fields'][] = array(
    'id' => '_use_featured',
    'type' => 'select',
    'name' => "Use Featured Image/Gallery/Video in post",
    'desc' => "Use Featured Image or Gallery or Video (depending on a selected post format) at the top of the post page" . ' ' . jwUtils::getHelp("4_1-Use_Featured_ImGaVi_in_Post"),
    "std" => "-1",
    "options" => array("-1" => "by template", "0" => "off", "1" => "on")
);


$metapost['fields'][] = array(
    "name" => "Gallery",
    "desc" => "",
    "id" => "_post_gallery",
    "type" => "media_picker"
);


$metapost['fields'][] = array("name" => "Video src",
    "desc" => "URL video (youtube, vimeo, vine). <b>Use Featured Image for a preview.</b>",
    "id" => "_post_video_link",
    "std" => "",
    "type" => "text");



if (jwUtils::woocommerce_activate() == true) {
    $metapost['fields'][] = array(
        'id' => 'post_connect_woo',
        'type' => 'text',
        'name' => 'Associate Product',
        'desc' => 'Choose a products to associate with. Add ids seperated by comma.',
        "std" => '',
        "page" => null,
        "mod" => 'big',
        "chosen" => "true",
        "target" => 'products',
        "prompt" => "Choose products..",
        "builder" => 'false',
    );
    /* SKU odstraneno - Bylo to narocny na databazi */

}







$metacat = array(
    "id" => "custom",
    "pages" => array("category"),
    "fields" => array()
);



if (class_exists('RevSlider')) {
    $slider = new RevSlider();

    $metacat['fields'][] = array(
        'id' => 'slider',
        'type' => 'select',
        'name' => 'Revolution Slider',
        'desc' => '',
        'std' => '',
        'mod' => 'medium',
         'options' => array('off' => 'Off')+$slider->getArrSlidersShort()
    );
}

$metacat['fields'][] = array(
    "name" => "Category Layout",
    "desc" => "Choose one of the preset layouts for your Category.",
    "id" => "_cat_layout",
    "std" => 'default',
    "type" => "layout",
    "options" => array(
        'default' => ADMIN_DIR . 'assets/images/default.gif',
        'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
        'right1' => ADMIN_DIR . 'assets/images/right_sidebar.gif',
        'left1' => ADMIN_DIR . 'assets/images/left_sidebar.gif')
);

$metacat['fields'][] = array(
    'id' => '_cat_sidebar_left1',
    'type' => 'sidebar_select',
    'name' => 'Category Left Sidebars',
    'desc' => 'Here you can add some optional sidebars. <strong>Affects only with set Category Layout above</strong>',
    'std' => '',
    'mod' => 'medium'
);

$metacat['fields'][] = array(
    'id' => '_cat_sidebar_right1',
    'type' => 'sidebar_select',
    'name' => 'Category Right Sidebars',
    'desc' => 'Here you can add some optional sidebars. <strong>Affects only with set Category Layout above</strong>',
    'std' => '',
    'mod' => 'medium'
);


$metacat['fields'][] = array(
    "name" => "Category Posts Layout",
    "desc" => "Choose one of the preset layouts for posts in this category.",
    "id" => "_cat_posts_layout",
    "std" => 'default',
    "type" => "layout",
    "options" => array(
        'default' => ADMIN_DIR . 'assets/images/default.gif',
        'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
        'right1' => ADMIN_DIR . 'assets/images/right_sidebar.gif',
        'left1' => ADMIN_DIR . 'assets/images/left_sidebar.gif')
);

$metacat['fields'][] = array(
    'id' => '_cat_posts_sidebar_left1',
    'type' => 'sidebar_select',
    'name' => 'Category Posts Left Sidebars',
    'desc' => 'Here you can add some optional sidebars. <strong>Affects only with set Category Posts Layout above</strong>',
    'std' => '',
    'mod' => 'medium'
);

$metacat['fields'][] = array(
    'id' => '_cat_posts_sidebar_right1',
    'type' => 'sidebar_select',
    'name' => 'Category Posts Right Sidebars',
    'desc' => 'Here you can add some optional sidebars. <strong>Affects only with set Category Posts Layout above</strong>',
    'std' => '',
    'mod' => 'medium'
);





$metapage = array(
    "id" => "jawmetabox",
    "title" => "General Settings",
    "pages" => array('page'),
    "context" => "normal", //Optional. The context within the page where the boxes should show ('normal', 'advanced')
    "priority" => "high", //Optional. The priority within the context where the boxes should show ('high', 'low').
    "desc" => null,
    "fields" => array()
);


$metapage['fields'][] = array(
    'id' => '_display_page_name',
    'type' => 'select',
    'name' => 'Page Title Bar',
    'desc' => 'Decide whether or not to enable the page title bar.',
    'std' => '0',
    "options" => array("1" => "On", "0" => "Off")
);

$metapage['fields'][] = array(
    'id' => '_page_breadcrumbs',
    'type' => 'select',
    'name' => 'Breadcrumbs On Page',
    'desc' => 'Turn on or off the breadcrumb navigation on this page.',
    'std' => '0',
    "options" => array("1" => "On", "0" => "Off")
);

$metapage['fields'][] = array(
    'id' => 'show_comments_page',
    'type' => 'select',
    'name' => 'Comments on this page',
    'desc' => 'Show comment area under this page',
    'std' => '0',
    "options" => array("1" => "On", "0" => "Off")
);

