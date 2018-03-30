<?php

#Enable console output into PB area
$gt3_pbconfig['dev_console'] = false;
#update_theme_option("dev_console", "true");
#delete_theme_option("dev_console");

#main pb block settings
$gt3_pbconfig['slider_and_bg_area'] = true;
$gt3_pbconfig['slider_and_bg_area_enable_for'] = array('gallery', 'post', 'port', 'page');

#background / slider settings
$gt3_pbconfig['enable_fullscreen_slider'] = true;
$gt3_pbconfig['enable_fullwidth_slider'] = false;
$gt3_pbconfig['enable_background_image'] = true;
$gt3_pbconfig['enable_background_color'] = true;

#For this post types we enable page builder
$gt3_pbconfig['page_builder_enable_for_posts'] = array('post', 'port', 'page', 'gallery');

#detail settings for page customization
$gt3_pbconfig['pb_modules_enabled_for'] = array('page', 'port');
$gt3_pbconfig['page_settings_enabled_for'] = array('page', 'post', 'team', 'port');
$gt3_pbconfig['fullcreen_slider_enabled_for'] = array('gallery');
$gt3_pbconfig['fullwidth_slider_enabled_for'] = array();
$gt3_pbconfig['bg_image_enabled_for'] = array('post', 'port', 'page');
$gt3_pbconfig['bg_color_enabled_for'] = array('post', 'port', 'page');

#List bg types for pages
$gt3_pbconfig['page_bg_available_types'] = array('center', 'repeat', 'stretched');

#BG position for pages
$gt3_pbconfig['page_default_bg_position'] = "stretched";

#all_available_headers_for_module
$gt3_pbconfig['all_available_headers_for_module'] = array("h1", "h2", "h3", "h4", "h5", "h6");

#default heading in module
$gt3_pbconfig['default_heading_in_module'] = "h4";

#available quote types
$gt3_pbconfig['all_available_quote_types'] = array("normal" => "Dark", "type1" => "Light", "type2" => "Colored");

#gallery
$gt3_pbconfig['gallery_module_default_width'] = "100px";
$gt3_pbconfig['gallery_module_default_height'] = "150px";

#blog default posts per page
$gt3_pbconfig['blog_default_posts_per_page'] = 7;

#portfolio default posts per page
$gt3_pbconfig['portfolio_default_items_on_start'] = 4;
$gt3_pbconfig['portfolio_default_items_load_per_click'] = 4;
$gt3_pbconfig['all_available_portfolio_types'] = array("1 column", "2 columns", "3 columns", "4 columns");

#featured posts number of posts (not main blog module!)
$gt3_pbconfig['featured_posts_default_number_of_posts'] = 12;
$gt3_pbconfig['featured_posts_default_posts_per_line'] = 4;
$gt3_pbconfig['featured_posts_letters_in_excerpt'] = 130;
$gt3_pbconfig['featured_posts_available_post_types'] = array(
    "post" => "Post",
    "port" => "Portfolio",
    "page" => "Page",
);
$gt3_pbconfig['featured_posts_available_sorting_type'] = array("new", "random");

#default video height
$gt3_pbconfig['default_video_height'] = "450px";

#default number of workers for team module
$gt3_pbconfig['team_default_numbers'] = 20;

#testimonials
$gt3_pbconfig['default_number_of_testimonials'] = 3;
$gt3_pbconfig['all_available_testimonial_display_type'] = array("type1", "type2");

#all available testimonial sorting type
$gt3_pbconfig['all_available_testimonial_sorting_type'] = array("new", "random");

#all available iconboxes
$gt3_pbconfig['all_available_iconboxes'] = array("a", "b", "c");

#iconboxes img preview
$gt3_pbconfig['iconboxes_img_preview_url'] = THEMEROOTURL . "/core/admin/img/available_iconboxes.jpg";

#all available custom list types
$gt3_pbconfig['all_available_custom_list_types'] = array(
    "ordered" => "Ordered",
    "list_type1" => "Arrow",
    "list_type2" => "Plus",
    "" => "Normal",
    "list_type3" => "Download",
    "list_type4" => "Print",
    "list_type5" => "Edit",
    "list_type6" => "Attach"
);

#all available custom buttons
$gt3_pbconfig['all_available_custom_buttons'] = array(
    "btn_small btn_type1" => "Small Black",
    "btn_small btn_type2" => "Small Grey",
    "btn_small btn_type3" => "Small Light Grey",
    "btn_small btn_type4" => "Small Colored",
    "btn_small btn_type5" => "Small Yellow",
    "btn_small btn_type6" => "Small Orange",
    "btn_small btn_type7" => "Small Red",
    "btn_small btn_type8" => "Small Pink",
    "btn_small btn_type9" => "Small Violet",
    "btn_small btn_type10" => "Small Blue",
    "btn_small btn_type11" => "Small Light Blue",
    "btn_small btn_type12" => "Small Green",
    "btn_small btn_type13" => "Small Lime",
    "btn_normal btn_type1" => "Medium Black",
    "btn_normal btn_type2" => "Medium Grey",
    "btn_normal btn_type3" => "Medium Light Grey",
    "btn_normal btn_type4" => "Medium Colored",
    "btn_normal btn_type5" => "Medium Yellow",
    "btn_normal btn_type6" => "Medium Orange",
    "btn_normal btn_type7" => "Medium Red",
    "btn_normal btn_type8" => "Medium Pink",
    "btn_normal btn_type9" => "Medium Violet",
    "btn_normal btn_type10" => "Medium Blue",
    "btn_normal btn_type11" => "Medium Light Blue",
    "btn_normal btn_type12" => "Medium Green",
    "btn_normal btn_type13" => "Medium Lime",
    "btn_large btn_type1" => "Large Black",
    "btn_large btn_type2" => "Large Grey",
    "btn_large btn_type3" => "Large Light Grey",
    "btn_large btn_type4" => "Large Colored",
    "btn_large btn_type5" => "Large Yellow",
    "btn_large btn_type6" => "Large Orange",
    "btn_large btn_type7" => "Large Red",
    "btn_large btn_type8" => "Large Pink",
    "btn_large btn_type9" => "Large Violet",
    "btn_large btn_type10" => "Large Blue",
    "btn_large btn_type11" => "Large Light Blue",
    "btn_large btn_type12" => "Large Green",
    "btn_large btn_type13" => "Large Lime"
);

#all available custom buttons
$gt3_pbconfig['all_available_target_for_custom_buttons'] = array(
    "_blank" => "Blank",
    "_self" => "Self"
);

#all available dropcaps
$gt3_pbconfig['all_available_dropcaps'] = array(
    "" => "Normal",
    "light" => "Light",
    "colored" => "Colored"
);

#all available messageboxes
$gt3_pbconfig['messagebox_available_types'] = array(
    "box_type1" => "Black",
    "box_type2" => "Colored",
    "box_type3" => "Red",
    "box_type4" => "Yellow",
    "box_type5" => "Green"
);

#all available highlighters
$gt3_pbconfig['all_available_highlighters'] = array(
    "colored" => "Colored",
    "dark" => "Dark",
    "light" => "Light"
);

#all available dividers
$gt3_pbconfig['all_available_dividers'] = array(
    "" => "normal",
    "light" => "Light",
    "dark" => "Dark",
    "colored" => "Colored"
);

#all available social icons
$gt3_pbconfig['all_available_social_icons'] = array(
    "ico_socialize_facebook1" => "Facebook 1",
    "ico_socialize_facebook2" => "Facebook 2",
    "ico_socialize_twitter1" => "Twitter 1",
    "ico_socialize_twitter2" => "Twitter 2",
    "ico_socialize_twitter3" => "Twitter 3",
    "ico_socialize_digg1" => "Digg 1",
    "ico_socialize_digg2" => "Digg 2",
    "ico_socialize_google1" => "Google 1",
    "ico_socialize_google2" => "Google 2",
    "ico_socialize_tumbler" => "Tumblr",
    "ico_socialize_delicious" => "Delicious",
    "ico_socialize_plixi" => "Plixi",
    "ico_socialize_dribbble1" => "Dribbble 1",
    "ico_socialize_dribbble2" => "Dribbble 2",
    "ico_socialize_stubleUpon" => "StubleUpon",
    "ico_socialize_lastfm" => "LastFm",
    "ico_socialize_moby" => "Moby",
    "ico_socialize_vimeo" => "Vimeo",
    "ico_socialize_youtube1" => "YouTube 1",
    "ico_socialize_youtube2" => "YouTube 2",
    "ico_socialize_myspace" => "Myspace",
    "ico_socialize_linkedIn" => "LinkedIn",
    "ico_socialize_pinterest" => "Pinterest",
    "ico_socialize_flickr" => "Flickr",
    "ico_socialize_vk1" => "VK1",
    "ico_socialize_vk2" => "VK2",
    "ico_socialize_odnoklassniki" => "Odnoklassniki",
    "ico_socialize_gowalla" => "Gowalla",
    "ico_socialize_dropbox" => "Dropbox",
    "ico_socialize_skype" => "Skype",
    "ico_socialize_iChat" => "iChat",
    "ico_socialize_instagram" => "Instagram",
    "ico_socialize_evernote" => "Evernote",
    "ico_socialize_deviantart" => "Deviantart",
    "ico_socialize_blogspot" => "Blogspot",
    "ico_socialize_reddit" => "Reddit",
    "ico_socialize_technorati" => "Technorati",
    "ico_socialize_yahoo" => "Yahoo",
    "ico_socialize_diigo" => "Diigo",
    "ico_socialize_blinklist" => "Blinklist",
    "ico_socialize_bing" => "Bing",
    "ico_socialize_behnce" => "Behnce",
    "ico_socialize_picasa" => "Picasa",
    "ico_socialize_forrst" => "Forrst",
    "ico_socialize_ffffound" => "Ffffound",
    "ico_socialize_viddler" => "Viddler",
    "ico_socialize_friendfeed" => "Friendfeed",
    "ico_socialize_mobileMe" => "MobileMe",
    "ico_socialize_wordpress" => "Wordpress",
    "ico_socialize_drupal" => "Drupal",
    "ico_socialize_paypal" => "Paypal",
    "ico_socialize_share" => "Share",
    "ico_socialize_mail" => "Mail",
    "ico_socialize_rss" => "Rss",
    "ico_socialize_phone" => "Phone",
    "ico_socialize_home" => "Home",
);

#all available social icon type
$gt3_pbconfig['all_available_social_icons_type'] = array(
    "type1" => "Normal",
);

#partners number
$gt3_pbconfig['partners_default_number']= 6;

#Padding after modules
$gt3_pbconfig['available_padding_after_module'] = array(
    "module_normal_padding" => "Default",
    "module_medium_padding" => "Medium",
    "module_small_padding" => "Small",
    "module_none_padding" => "None",
);

#View type for Meta module
$gt3_pbconfig['available_postinfo_module_view_types'] = array(
    "portfolio_type1" => "Vertical",
    "portfolio_type2" => "Horizontal"
);

#how many images from media library show on one page
$gt3_pbconfig['images_from_media_library'] = 30;

#How many items in OUR TEAM per line
$gt3_pbconfig['available_workers_per_line'] = array(
    "1" => "1",
    "2" => "2",
    "3" => "3",
    "4" => "4",
);

#How many items in FEATURED POSTS per line
$gt3_pbconfig['available_posts_per_line'] = array(
    "1" => "1",
    "2" => "2",
    "3" => "3",
    "4" => "4",
);


#Some const
define("PBROOTURL", THEMEROOTURL . "/core/page-builder");
define("PBIMGURL", THEMEROOTURL . "/core/page-builder/img");
?>