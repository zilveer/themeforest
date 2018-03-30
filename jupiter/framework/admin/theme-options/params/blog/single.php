<?php
$blog_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_blog_single_post",
    "name" => __("Blog & News / Single Post", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __("Single Post Style", "mk_framework") ,
            "desc" => __("", "mk_framework") ,
            "id" => "single_blog_style",
            "default" => 'compact',
            "options" => array(
                "compact" => __('Traditional & Compact', 'mk_framework') ,
                "bold" => __('Clear & Bold', 'mk_framework') ,
            ) ,
            "type" => "dropdown"
        ) ,
        array(
            "name" => __("Single Layout", "mk_framework") ,
            "desc" => __("This option allows you to define the page layout of Blog Single page as full width without sidebar, left sidebar or right sidebar.", "mk_framework") ,
            "id" => "single_layout",
            "default" => "full",
            "options" => array(
                "left" => __("Left Sidebar", "mk_framework") ,
                "right" => __("Right Sidebar", "mk_framework") ,
                "full" => __("Full Layout", "mk_framework")
            ) ,
            "type" => "dropdown"
        ) ,

        array(
            "name" => __("Make Featured Image Full Height", "mk_framework") ,
            "desc" => __("If disabled you may set a custom height from below option.", "mk_framework") ,
            "id" => "single_bold_hero_full_height",
            "default" => "true",
            "type" => "toggle",
            "dependency" => array(
                   'element' => "single_blog_style",
                   'value' => array(
                       'bold'
                   )
            ),
        ) ,

        array(
            "name" => __("Featured Image Height", "mk_framework") ,
            "desc" => __("Clear & Bold style hero image height.", "mk_framework") ,
            "id" => "bold_single_hero_height",
            "min" => "100",
            "max" => "2000",
            "step" => "1",
            "default" => "800",
            "unit" => 'px',
            "type" => "range",
            "dependency" => array(
                   'element' => "single_blog_style",
                   'value' => array(
                       'bold'
                   )
            ),
        ) ,
        
        array(
            "name" => __("Featured Image Height", "mk_framework") ,
            "desc" => __("Traditional & Compact style featured image height.", "mk_framework") ,
            "id" => "single_featured_image_height",
            "min" => "100",
            "max" => "1000",
            "step" => "1",
            "default" => "300",
            "unit" => 'px',
            "type" => "range",
            "dependency" => array(
                   'element' => "single_blog_style",
                   'value' => array(
                       'compact'
                   )
            ),
        ) ,
        array(
            "name" => __("Featured Image", "mk_framework") ,
            "desc" => __("If you do not want to set a featured image (in case of sound post type : Audio player, in case of video post type : Video Player) kindly disable it here.", "mk_framework") ,
            "id" => "single_disable_featured_image",
            "default" => 'true',
            "type" => "toggle"
        ) ,
        array(
            "name" => __("Image Cropping", "mk_framework") ,
            "desc" => __("If you do not want automatic image cropping disable this option.", "mk_framework") ,
            "id" => "blog_single_img_crop",
            "default" => 'true',
            "type" => "toggle"
        ) ,
        array(
            "name" => __("Single Blog Post Title", "mk_framework") ,
            "desc" => __("", "mk_framework") ,
            "id" => "blog_single_title",
            "default" => 'true',
            "type" => "toggle"
        ) ,
        array(
            "name" => __("Meta Section", "mk_framework") ,
            "desc" => __("Using this option you can show/hide extra information about the blog or post, such as Author, Date Created, etc...", "mk_framework") ,
            "id" => "single_meta_section",
            "default" => 'true',
            "type" => "toggle"
        ) ,
        array(
            "name" => __("Blog Social Share", "mk_framework") ,
            "desc" => __("Using this option you can Enable/Disable social share section from blog archive and single pages.", "mk_framework") ,
            "id" => "single_blog_social",
            "default" => 'true',
            "type" => "toggle"
        ) ,
        array(
            "name" => __("Previous & Next Arrows", "mk_framework") ,
            "desc" => __("Using this option you can turn on/off the navigation arrows when viewing the blog single page.", "mk_framework") ,
            "id" => "blog_prev_next",
            "default" => 'true',
            "type" => "toggle"
        ) ,
        array(
            "name" => __("Show Previous & Next for Same Categories?", "mk_framework") ,
            "desc" => __("If enabled, the same categories in adjacent posts will be shown.", "mk_framework") ,
            "id" => "blog_prev_next_same_category",
            "default" => 'true',
            "type" => "toggle"
        ) ,
        array(
            "name" => __("About Author Box", "mk_framework") ,
            "desc" => __("You can enable or disable the about author box from here. You can modify about author information from your profile settings. Besides, if you add your website URL, your email address and twitter account from extra profile information they will be displayed as an icon link.", "mk_framework") ,
            "id" => "enable_blog_author",
            "default" => 'true',
            "type" => "toggle"
        ) ,
        array(
            "name" => __("Meta Tags", "mk_framework") ,
            "desc" => __("Using this option you can Show/Hide meta tags that you have set in Tags meta box inside each post.", "mk_framework") ,
            "id" => "diable_single_tags",
            "default" => 'true',
            "type" => "toggle"
        ) ,
        array(
            "name" => __("Recommended Posts", "mk_framework") ,
            "desc" => __("Using this option you can Show/Hide Recommended Posts section inside your single post item.", "mk_framework") ,
            "id" => "enable_single_related_posts",
            "default" => 'true',
            "type" => "toggle"
        ) ,
        array(
            "name" => __("Blog Posts Comments", "mk_framework") ,
            "desc" => __("You can Turn On/Off the comments section for blogs here.", "mk_framework") ,
            "id" => "blog_single_comments",
            "default" => 'true',
            "type" => "toggle"
        ) ,
    ) ,
);
