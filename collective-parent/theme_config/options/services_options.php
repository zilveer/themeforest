<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for categories area.             */
/* ----------------------------------------------------------------------------------- */

$options = array(
    // Page Title
    array('name' => __('Title','tfuse'),
        'desc' => __('Select your preferred Page Title.','tfuse'),
        'id' => TF_THEME_PREFIX . '_page_title',
        'value' => 'default_title',
        'options' => array('hide_title' => __('Hide Title','tfuse'), 'default_title' => __('Default Title','tfuse'), 'custom_title' => __('Custom Title','tfuse')),
        'type' => 'select'
    ),
    // Custom Title
    array('name' => __('Custom Title','tfuse'),
        'desc' => __('Enter your custom title for this page.','tfuse'),
        'id' => TF_THEME_PREFIX . '_custom_title',
        'value' => '',
        'type' => 'text'
    ),
    // Custom Subtitle
    array('name' => __('Custom Subtitle','tfuse'),
        'desc' => __('Enter your custom subtitle for this page.','tfuse'),
        'id' => TF_THEME_PREFIX . '_custom_subtitle',
        'value' => '',
        'type' => 'text'
    ),
    // Subtitle alignment
    array('name' => __('Subtitle Alignment','tfuse'),
        'desc' => __('Select your preferred Subtitle Alignment.','tfuse'),
        'id' => TF_THEME_PREFIX . '_subtitle_alignment',
        'value' => 'right',
        'options' => array('right' => __('Right','tfuse'), 'center' => __('Center','tfuse')),
        'type' => 'select'
    ),
    // Image
    array('name' => __('Image','tfuse'),
        'desc' => __('Upload an image for category','tfuse'),
        'id' => TF_THEME_PREFIX . '_image',
        'value' => '',
        'type' => 'upload'
    ),
    // Background
    array('name' => __('Background','tfuse'),
        'desc' => __('Set background for the image','tfuse'),
        'id' => TF_THEME_PREFIX . '_bg_image',
        'value' => '',
        'type' => 'colorpicker'
    ),
    // Element of Header
    array('name' => __('Header Element','tfuse'),
        'desc' => __('Select what do you want in your post header','tfuse'),
        'id' => TF_THEME_PREFIX . '_header_element_cat',
        'value' => 'none',
        'options' => array('none' => __('Without Element','tfuse'), 'image' => __('Image','tfuse'), 'slider' => __('Slider','tfuse'), 'full_slider' => __('Full Slider','tfuse'), 'map' => __('Map','tfuse')),
        'type' => 'select',
    ),
    // Image of Header
    array('name' => __('Image','tfuse'),
        'desc' => __('Upload an image for your header, or specify the image address of your online image. (http://yoursite.com/image.png)','tfuse'),
        'id' => TF_THEME_PREFIX . '_header_image_cat',
        'value' => '',
        'type' => 'upload',
    ),
    // Select Slider
    $this->ext->slider->model->has_sliders() ?
        array(
            'name' => __('Slider','tfuse'),
            'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
            'id' => TF_THEME_PREFIX . '_select_slider_cat',
            'value' => '',
            'options' => $TFUSE->ext->slider->get_sliders_dropdown(array('image_video','fullbanner','featured')),
            'type' => 'select'
        ) :
        array(
            'name' => __('Slider','tfuse'),
            'desc' => '',
            'id' => TF_THEME_PREFIX . '_select_slider_cat',
            'value' => '',
            'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
            'type' => 'raw'
        ),
    // Select After Header Slider
    $this->ext->slider->model->has_sliders() ?
        array(
            'name' => __('Full Slider','tfuse'),
            'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
            'id' => TF_THEME_PREFIX . '_select_slider_after_header_cat',
            'value' => '',
            'options' => $TFUSE->ext->slider->get_sliders_dropdown('carousel'),
            'type' => 'select'
        ) :
        array(
            'name' => __('Full Slider','tfuse'),
            'desc' => '',
            'id' => TF_THEME_PREFIX . '_select_slider_after_header_cat',
            'value' => '',
            'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
            'type' => 'raw'
        ),
    //map on header
    array(
        'name' => __('Map position','tfuse'),
        'desc' => '',
        'value' => '',
        'id' => TF_THEME_PREFIX . '_page_map_cat',
        'type' => 'maps'
    ),
    array(
        'name' => __('Text','tfuse'),
        'desc' => __('Enter the text for location.','tfuse'),
        'id' => TF_THEME_PREFIX . '_map_text_cat',
        'value' => 'We are here',
        'type' => 'text'
    ),
    array(
        'name' => __('Zoom','tfuse'),
        'desc' => __('Enter the zoom of map.Ex: 13, 14, 15','tfuse'),
        'id' => TF_THEME_PREFIX . '_map_zoom_cat',
        'value' => '13',
        'type' => 'text'
    ),
    // Top Shortcodes
    array('name' => __('Shortcodes Before Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_top_cat',
        'value' => '',
        'type' => 'textarea'
    ),
    // Element of Footer
    array('name' => __('Element of Content','tfuse'),
        'desc' => __('Select type of element on the footer.','tfuse'),
        'id' => TF_THEME_PREFIX . '_footer_element_cat',
        'value' => 'none',
        'options' => array('none' => __('Without Content Element','tfuse'), 'slider' => __('Slider','tfuse')),
        'type' => 'select',
    ),
    // Select Footer Slider
    $this->ext->slider->model->has_sliders() ?
        array(
            'name' => __('Slider','tfuse'),
            'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
            'id' => TF_THEME_PREFIX . '_select_slider_footer_cat',
            'value' => '',
            'options' => $TFUSE->ext->slider->get_sliders_dropdown('carousel'),
            'type' => 'select'
        ) :
        array(
            'name' => __('Slider','tfuse'),
            'desc' => '',
            'id' => TF_THEME_PREFIX . '_select_slider_footer_cat',
            'value' => '',
            'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
            'type' => 'raw'
        ),
    // Bottom Shortcodes
    array('name' => __('Shortcodes After Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_bottom_cat',
        'value' => '',
        'type' => 'textarea'
    ),
    /* Background Options */
    array('name' => __('Background','tfuse'),
        'id' => TF_THEME_PREFIX . '_background_option',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    // Background Image
    array('name' => __('Background Image','tfuse'),
        'desc' => __('Upload an image for your background.','tfuse'),
        'id' => TF_THEME_PREFIX . '_background_image',
        'value' => '',
        'type' => 'upload',
    ),
    // Repeat Image
    array('name' => __('Repeat Image','tfuse'),
        'desc' => __('Select type for repeat image.','tfuse'),
        'id' => TF_THEME_PREFIX . '_repeat_image',
        'value' => '',
        'options' => array('' => 'repeat-x repeat-y', 'no-repeat' => 'no-repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y'),
        'type' => 'select',
    ),
    // Background-color
    array('name' => __('Background-color','tfuse'),
        'desc' => __('Enter background-color ex: #ccc','tfuse'),
        'id' => TF_THEME_PREFIX . '_background_color',
        'value' => '',
        'type' => 'colorpicker',
    ),
    // Background-position
    array('name' => __('Background-position','tfuse'),
        'desc' => __('Enter background-position ex: center top','tfuse'),
        'id' => TF_THEME_PREFIX . '_background_position',
        'value' => '',
        'type' => 'text',
        'divider' =>true
    ),

    //top ad
    array('name' => __('Enable 728x90 banner','tfuse'),
        'desc' => __('Enable the top banner ad space. Note: you can set a specific banner for all categories and posts in the <a href="' . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>','tfuse'),
        'id' => TF_THEME_PREFIX . '_top_ad_space',
        'value' => 'false',
        'options' => array('false' => __('No','tfuse'), 'true' => __('Yes','tfuse')),
        'type' => 'select',
    ),
    array(
        'name'=> __('Ad image(728px x 90px)','tfuse'),
        'desc' => __('Enter the URL to the ad image 728x90 location','tfuse'),
        'id' => TF_THEME_PREFIX . '_top_ad_image',
        'value' => '',
        'type' =>'upload'
    ),
    array(
        'name' => __('Ad URL','tfuse'),
        'desc' => __('Enter the URL where this ad points to.','tfuse'),
        'id'=> TF_THEME_PREFIX . '_top_ad_url',
        'value' => '',
        'type' =>'text'
    ),
    array(
        'name' => __('Adsense code','tfuse'),
        'desc' => __('Enter your adsense code (or other ad network code) here.','tfuse'),
        'id'=> TF_THEME_PREFIX . '_top_ad_adsense',
        'value' => '',
        'type' =>'textarea',
    ),
    //125x125 banner
    array('name' => __('Enable 125x125 banners','tfuse'),
        'desc' => __('Enable before content banner space. Note: you can set specific banners for all categories and posts in the <a href="' . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>','tfuse'),
        'id' => TF_THEME_PREFIX . '_bfcontent_ads_space',
        'value' => 'false',
        'options' => array('false' => __('No','tfuse'), 'true' => __('Yes','tfuse')),
        'type' => 'select'
    ),
    array('name' => __('Type of ads','tfuse'),
        'desc' => __('Choose the type of your adds.','tfuse'),
        'id' => TF_THEME_PREFIX . '_bfcontent_type',
        'value' => 'image',
        'options' => array('image' => __('Image Type','tfuse'), 'adsense' => __('Adsense Type','tfuse')),
        'type' => 'select'
    ),
    array('name' => __('No of 125x125 ads','tfuse'),
        'desc' => __('Choose the numbers of ads to display before content.','tfuse'),
        'id' => TF_THEME_PREFIX . '_bfcontent_number',
        'value' => '7',
        'options' => array('one' => '1', 'two' => '2' , 'three' => '3', 'four' => '4', 'five' => '5', 'six' => '6', 'seven' => '7'),
        'type' => 'select'
    ),
    array(
        'name' => __('Ad image (125px x 125px)','tfuse'),
        'desc'=> __('Enter the URL to the ad image 125x125 location','tfuse'),
        'id' => TF_THEME_PREFIX . '_bfcontent_ads_image1',
        'value' => '',
        'type' =>'upload'
    ),
    array(
        'name' => __('Ad URL','tfuse'),
        'desc' => __('Enter the URL where this ad points to.','tfuse'),
        'id' => TF_THEME_PREFIX . '_bfcontent_ads_url1',
        'value' => '',
        'type' =>'text'
    ),
    array(
        'name' => __('Adsense code for before content ads','tfuse'),
        'desc' => __('Enter your adsense code (or other ad network code) here.','tfuse'),
        'id' => TF_THEME_PREFIX . '_bfcontent_ads_adsense1',
        'value' => '',
        'type' =>'textarea'
    ),
    array(
        'name'=>__('Ad image (125px x 125px)','tfuse'),
        'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
        'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image2',
        'value' => '',
        'type' =>'upload'
    ),
    array(
        'name'=>__('Ad URL','tfuse'),
        'desc'=>__('Enter the URL where this ad points to.','tfuse'),
        'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url2',
        'value' => '',
        'type' =>'text'
    ),
    array(
        'name'=>__('Adsense code for before content ads','tfuse'),
        'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
        'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense2',
        'value' => '',
        'type' =>'textarea'
    ),
    array(
        'name'=>__('Ad image (125px x 125px)','tfuse'),
        'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
        'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image3',
        'value' => '',
        'type' =>'upload'
    ),
    array(
        'name'=>__('Ad URL','tfuse'),
        'desc'=>__('Enter the URL where this ad points to.','tfuse'),
        'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url3',
        'value' => '',
        'type' =>'text'
    ),
    array(
        'name'=>__('Adsense code for before content ads','tfuse'),
        'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
        'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense3',
        'value' => '',
        'type' =>'textarea'
    ),
    array(
        'name'=>__('Ad image (125px x 125px)','tfuse'),
        'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
        'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image4',
        'value' => '',
        'type' =>'upload'
    ),
    array(
        'name'=>__('Ad URL','tfuse'),
        'desc'=>__('Enter the URL where this ad points to.','tfuse'),
        'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url4',
        'value' => '',
        'type' =>'text'
    ),
    array(
        'name'=>__('Adsense code for before content ads','tfuse'),
        'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
        'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense4',
        'value' => '',
        'type' =>'textarea'
    ),
    array(
        'name'=>__('Ad image (125px x 125px)','tfuse'),
        'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
        'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image5',
        'value' => '',
        'type' =>'upload'
    ),
    array(
        'name'=>__('Ad URL','tfuse'),
        'desc'=>__('Enter the URL where this ad points to.','tfuse'),
        'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url5',
        'value' => '',
        'type' =>'text'
    ),
    array(
        'name'=>__('Adsense code for before content ads','tfuse'),
        'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
        'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense5',
        'value' => '',
        'type' =>'textarea'
    ),
    array(
        'name'=>__('Ad image (125px x 125px)','tfuse'),
        'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
        'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image6',
        'value' => '',
        'type' =>'upload'
    ),
    array(
        'name'=>__('Ad URL','tfuse'),
        'desc'=>__('Enter the URL where this ad points to.','tfuse'),
        'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url6',
        'value' => '',
        'type' =>'text'
    ),
    array(
        'name'=>__('Adsense code for before content ads','tfuse'),
        'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
        'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense6',
        'value' => '',
        'type' =>'textarea'
    ),
    array(
        'name'=>__('Ad image (125px x 125px)','tfuse'),
        'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
        'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image7',
        'value' => '',
        'type' =>'upload'
    ),
    array(
        'name'=>__('Ad URL','tfuse'),
        'desc'=>__('Enter the URL where this ad points to.','tfuse'),
        'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url7',
        'value' => '',
        'type' =>'text'
    ),
    array(
        'name'=>__('Adsense code for before content ads','tfuse'),
        'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
        'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense7',
        'value' => '',
        'type' =>'textarea'
    ),
    //468x60 banner
    array('name' => __('Enable 468x60 banner','tfuse'),
        'desc' => __('Enable after content banner space. Note: you can set a specific banner for all categories and posts in the <a href="' . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>','tfuse'),
        'id' => TF_THEME_PREFIX . '_hook_space',
        'value' => 'false',
        'options' => array('false' => __('No','tfuse'), 'true' => __('Yes','tfuse')),
        'type' => 'select',
    ),
    array(
        'name'=>__('Ad image(468px x 60px)','tfuse'),
        'desc'=>__('Enter the URL to the ad image 468x60 location','tfuse'),
        'id'=> TF_THEME_PREFIX . '_hook_image',
        'value' => '',
        'type' =>'upload'
    ),
    array(
        'name'=>__('Ad URL','tfuse'),
        'desc'=>__('Enter the URL where this ad points to.','tfuse'),
        'id'=> TF_THEME_PREFIX . '_hook_url',
        'value' => '',
        'type' =>'text'
    ),
    array(
        'name'=>__('Adsense code','tfuse'),
        'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
        'id'=> TF_THEME_PREFIX . '_hook_adsense',
        'value' => '',
        'type' =>'textarea',
    ),
);
?>