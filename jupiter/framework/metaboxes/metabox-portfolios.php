<?php
$config = array(
    'title' => sprintf('%s Page Options', THEME_NAME) ,
    'id' => 'mk-metaboxes-general',
    'pages' => array(
        'portfolio',
    ) ,
    'callback' => '',
    'context' => 'normal',
    'priority' => 'core'
);
$options = array(
    array(
        "name" => __("Layout", "mk_framework") ,
        "desc" => __("Please choose this page's layout. If you choose 'Default' then you may modify it from Theme Settings => Portfolio => Portfolio Single Post => Portfolio Single Layout.", "mk_framework") ,
        "id" => "_layout",
        "default" => 'default',
        "options" => array(
            "default" => __("Default Sidebar", "mk_framework") ,
            "left" => __("Left Sidebar", "mk_framework") ,
            "right" => __("Right Sidebar", "mk_framework") ,
            "full" => __("Full Layout", "mk_framework")
        ) ,
        "type" => "select"
    ) ,
    array(
        "name" => __("Manage Page Elements", "mk_framework") ,
        "desc" => __("Depending on your need you can change this page's general layout by making structral changes.", "mk_framework") ,
        "id" => "_template",
        "default" => '',
        "options" => array(
            "no-header" => __('Remove Header', "mk_framework") ,
            "no-title" => __('Remove Page Title', "mk_framework") ,
            "no-header-title" => __('Remove Header & Page Title', "mk_framework") ,
            "no-footer" => __('Remove Footer', "mk_framework") ,
            "no-header-footer" => __('Remove Header & Footer', "mk_framework") ,
            "no-footer-title" => __('Remove Footer & Page Title', "mk_framework") ,
            "no-header-title-footer" => __('Remove Header & Page Title & Footer', "mk_framework")
        ) ,
        "type" => "select"
    ) ,
    array(
        "name" => __("Stick Template?", "mk_framework") ,
        "desc" => __("Enabling this option will remove padding after header and before footer.", "mk_framework") ,
        "id" => "_padding",
        "default" => 'false',
        "type" => "toggle"
    ) ,
    array(
        "name" => __("Page Preloader?", "mk_framework") ,
        "desc" => __("This option will enable preloader for this post only. if you would like to enable it throughout the site consider option in General => Site Preloader => Preloader.", "mk_framework") ,
        "id" => "page_preloader",
        "default" => 'false',
        "type" => "toggle"
    ) ,
    array(
        "name" => __("Page Title Align", "mk_framework") ,
        "desc" => __("You can change title and subtitle text align.", "mk_framework") ,
        "id" => "_introduce_align",
        "default" => 'left',
        "options" => array(
            "left" => 'Left',
            "right" => 'Right',
            "center" => 'Center'
        ) ,
        "type" => "select"
    ) ,
    
    array(
        "name" => __("Custom Page Title", "mk_framework") ,
        "desc" => __("You can add a custom title for this page. (This option have NOTHING to do with title  &lt;title&gt; tag inside HTML.)", "mk_framework") ,
        "id" => "_custom_page_title",
        "rows" => "1",
        "default" => "",
        "type" => "text"
    ) ,
    array(
        "name" => __("Page Heading Subtitle", "mk_framework") ,
        "desc" => __("You can add a subtitle to header section of this page using this option.", "mk_framework") ,
        "id" => "_page_introduce_subtitle",
        "rows" => "3",
        "default" => "",
        "type" => "textarea"
    ) ,
    array(
        "name" => __("Breadcrumb", "mk_framework") ,
        "desc" => __("You can disable Breadcrumb for this page using this option", "mk_framework") ,
        "id" => "_disable_breadcrumb",
        "default" => 'true',
        "type" => "toggle"
    ) ,
    
    array(
        "name" => __("Main Navigation Location", "mk_framework") ,
        "desc" => __("Choose which menu location to be used in this page. If left blank, Primary Menu will be used. You should first <a target='_blank' href='" . admin_url('nav-menus.php') . "'>create menu</a> and then <a target='_blank' href='" . admin_url('nav-menus.php') . "?action=locations'>assign to menu locations</a>", "mk_framework") ,
        "id" => "_menu_location",
        "default" => '',
        "placeholder" => 'true',
        "width" => 400,
        "options" => array(
            "primary-menu" => __('Primary Navigation', "mk_framework") ,
            "second-menu" => __('Second Navigation', "mk_framework") ,
            "third-menu" => __('Third Navigation', "mk_framework") ,
            "fourth-menu" => __('Fourth Navigation', "mk_framework") ,
            "fifth-menu" => __('Fifth Navigation', "mk_framework") ,
            "sixth-menu" => __('Sixth Navigation', "mk_framework") ,
        ) ,
        "type" => "select"
    ) ,
    array(
        "name" => __("Custom Sidebar", "mk_framework") ,
        "desc" => __("You can create a custom sidebar, under Sidebar option and then assign the custom sidebar here to this post. later on you can customize which widgets to show up.", "mk_framework") ,
        "id" => "_sidebar",
        "default" => '',
        "options" => mk_get_sidebar_options() ,
        "type" => "select"
    )
);
new mkMetaboxesGenerator($config, $options);
$config = array(
    'title' => sprintf('%s Portfolio Post Options', THEME_NAME) ,
    'id' => 'mk-metaboxes-posts-options',
    'pages' => array(
        'portfolio'
    ) ,
    'callback' => '',
    'context' => 'normal',
    'priority' => 'core'
);
$options = array(
    array(
        "name" => __("Custom URL", "mk_framework") ,
        "desc" => __("If you may choose to change the permalink to a page, post or external URL. If left empty the single post permalink will be used instead.", "mk_framework") ,
        "id" => "_portfolio_permalink",
        "default" => "",
        "type" => "superlink"
    ) ,
    array(
        "name" => __("Post Type", "mk_framework") ,
        "desc" => __("", "mk_framework") ,
        "id" => "_single_post_type",
        "default" => 'image',
        "preview" => false,
        "options" => array(
            "image" => 'Image',
            "video" => 'Video',
        ) ,
        "type" => "select"
    ) ,
    
    array(
        "name" => __("Video Site", "mk_framework") ,
        "id" => "_single_video_site",
        "default" => 'youtube',
        "options" => array(
            "vimeo" => 'Vimeo',
            "youtube" => 'Youtube',
            "dailymotion" => 'Daily Motion',
        ) ,
        "type" => "select",
        "dependency" => array(
            'element' => "_single_post_type",
            'value' => array(
                'video',
            )
        ) ,
    ) ,
    
    array(
        "name" => __("Video Id", "mk_framework") ,
        "desc" => __("Please fill this option with the required ID. you can find the ID from the link parameters as examplified below:<br /> http://www.youtube.com/watch?v=<strong>ID</strong><br />https://vimeo.com/<strong>ID</strong><br />http://www.dailymotion.com/embed/video/<strong>ID</strong>", "mk_framework") ,
        "id" => "_single_video_id",
        "type" => "text",
        "dependency" => array(
            'element' => "_single_post_type",
            'value' => array(
                'video',
            )
        ) ,
    ) ,
    
    array(
        "name" => __("Masonry Image size", "mk_framework") ,
        "desc" => __("Make your hand picked images larger, wider or taller. Masonry loop style image size. First value represents horizontal wideness, second value how tall the item is. X * X is regular item width and height (will occupy one fifth of a column).", "mk_framework") ,
        "id" => "_masonry_img_size",
        "default" => 'x_x',
        "options" => array(
            "x_x" => __('X * X', 'mk_framework') ,
            "two_x_x" => __('2X * X', 'mk_framework') ,
            "three_x_x" => __('3X * X', 'mk_framework') ,
            "four_x_x" => __('4X * X', 'mk_framework') ,
            "x_two_x" => __('X * 2X', 'mk_framework') ,
            "two_x_two_x" => __('2X * 2X', 'mk_framework') ,
            "three_x_two_x" => __('3X * 2X', 'mk_framework') ,
            "four_x_two_x" => __('4X * 2X', 'mk_framework') ,
        ) ,
        "type" => "select"
    ) ,
    
    array(
        "name" => __('Item Hover Skin', 'mk_framework') ,
        "desc" => __("Using this option you can modify this portfolio item hover skin color in Grid & Masonry loop style > Zoom Out Box hover scenario.", "mk_framework") ,
        "id" => "_hover_skin",
        "default" => "",
        "type" => "color"
    ) ,
    
    array(
        "name" => __("Show Featured Image", "mk_framework") ,
        "desc" => __("If you do not want to set a featured image inside single portfolio kindly disable it here. If you post type is video, featured video player will be disabled.", "mk_framework") ,
        "id" => "_portfolio_featured_image",
        "default" => 'true',
        "type" => "toggle"
    ) ,
    
    array(
        "name" => __("Similiar Posts", "mk_framework") ,
        "desc" => __("If you do not want to show similar posts section inside single portfolio kindly disable it here.", "mk_framework") ,
        "id" => "_portfolio_similar",
        "default" => 'true',
        "type" => "toggle"
    ) ,
    
    array(
        "name" => __("Social Share", "mk_framework") ,
        "desc" => __("If you do not want to show Social share & love post feature int this post disable this option.", "mk_framework") ,
        "id" => "_portfolio_social",
        "default" => 'true',
        "type" => "toggle"
    ) ,
    
    array(
        "name" => __("Portfolio Ajax Content", "mk_framework") ,
        "desc" => __("This content will be used in ajax portfolio and if left blank the main content above will be used instead. Please note that ajax content will not accept fullwidth rows or page sections. So if you are using these in single portfolio main content then use this field for ajax content.", "mk_framework") ,
        "id" => "_ajax_content",
        "default" => '',
        "type" => "editor"
    ) ,
);
new mkMetaboxesGenerator($config, $options);
