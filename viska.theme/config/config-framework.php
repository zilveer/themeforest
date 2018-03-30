<?php
/**
 * Project of Megadrupal.com
 * Author: duongle
 * Date: 5/11/14
 * Time: 5:18 PM
 */

/**
 * Filter default Layout
 */
add_filter('awe_layout_options','layout_options');
function layout_options()
{
    return array("LM","MR","None");
}


/**
 * Read More Button
 */ 
add_filter('awe_layout_menu_label','layout_menu_label');
function layout_menu_label()
{
    return "Blog Layout";
}
add_filter('the_content_more_link', 'add_more_link_class',10,1);
function add_more_link_class($link)
{
    return str_replace(
        'more-link'
        ,'more-link blog-read-more'
        ,$link
    );
}
//add_filter('awe_read_more_wrap',create_function('', 'return false;'));
add_filter('awe_more_link_class', 'change_more_link_class');
function change_more_link_class()
{
    return 'blog-read-more btn-color btn-effect';
}

add_filter('awe_read_more_label','read_more_label');
function read_more_label()
{
    return __('Read More',LANGUAGE);
}


/**
 * Portfolio format filter
 */
add_filter('awe_format_types', 'portfolio_format_types',10,1);
function portfolio_format_types($types)
{
    $types = array(
        'standard'      =>  'Standard',
        'gallery'       =>  'Gallery',
        'video'         =>  'Video',
        'image'         =>  'Image',
    );
    return $types;
}

add_filter('awe_media_post_type_awe_portfolio', 'portfolio_media_types',10,1);
function portfolio_media_types($types)
{
    $types = array(
        'video'     =>  "Video",
        'gallery'   =>  'Gallery - Image',
    );
    return $types;
}

/**
 * Remove section frame theme
 */

add_filter('display_typography_body_content', create_function('', 'return false;'));

add_filter('display_feature_image_section', create_function('', 'return false;'));

add_filter('display_hight_light_paragraph_section', create_function('', 'return false;'));

add_filter('display_author_box_section', create_function('', 'return false;'));

add_filter('display_related_box_section', create_function('', 'return false;'));

add_filter('display_share_box_section', create_function('', 'return false;'));

add_filter('display_footer_content_section', create_function('', 'return false;'));

add_filter('use_widget_footer_section', create_function('', 'return false;'));

add_filter('use_menu_footer_section', create_function('', 'return false;'));

add_filter('display_breadcrumb_section', create_function('', 'return false;') );

add_filter('display_seo_module', create_function('', 'return false;') );

/* Logo */
add_filter('logo_text', create_function('', 'return false;') );
add_filter('enable_logo_image', create_function('', 'return false;') );

/* Slogan */
add_filter('enable_slogan', create_function('', 'return false;') );
add_filter('slogan_text', create_function('', 'return false;') );

/**
 * Config Widgets
 */
/* hide widgets */
add_filter('hide_widgets', create_function('', 'return array("twitter");') );

/* Display widgets default */
add_filter('config_widgets', 'config_widgets');
function config_widgets()
{
    $new_configs = array(
        'flickr'        =>  1,
        'sound_clound'  =>  1,
    );
    return $new_configs;
}

/**
 * Customize Config
 */
/*logo & slogan */
add_filter('customize_logo_slogo_section', 'customize_logo_slogo_section' );
function customize_logo_slogo_section()
{
    return __("Logo Settings",LANGUAGE);
}
add_filter('customize_enable_slogan', create_function('', 'return false;') );
add_filter('customize_enable_logo_text', create_function('', 'return false;') );
add_filter('customize_enable_image_checkbox', create_function('', 'return false;') );
add_filter('display_typography_logo_slogan', create_function('', 'return false;') );

/**
 * Framework Modules Config
 */

$frame_configs = array(
    'security'              =>  1,
    'portfolio'             =>  1,
    'service'               =>  1,
    'team'                  =>  1,
    'testimonial'           =>  1,
    'aboutus'               =>  1,
    'widgets'               =>  1,
    'pricing_table'         =>  1,
);
/**
 * New Theme Configs
 */
$theme_new_configs=array(
    'logo'              =>  array(
        'image'               =>  get_template_directory_uri()."/assets/images/logo.png",
    ),
    'logo_stickey'              =>  array(
        'image'               =>  get_template_directory_uri()."/assets/images/logo-scroll.png",
    ),
    'logo_preload_1'    => array(
        'image'                 => get_template_directory_uri().'/assets/images/preloader/img-1.png',
    ),
    'logo_preload_2'    => array(
        'image'                 => get_template_directory_uri().'/assets/images/preloader/img-2.jpg',
    ),
    'content'           =>  array(
        'add-lead'          =>  0,
        'limit'             =>  250,
        'feature-image'     =>  0,
        'author-box'        =>  0,
        'related-box'       =>  0,
        'meta-box'          =>  1,
        'share-box'         =>  1,
        'show-cm'           =>  1,
    ),
    'twitter'           =>  array(
        'enable'            =>  1,
    )
);

/**
 * Enable generate custom color css
 */

add_filter('enable_custom_color_css',create_function('', 'return true;'));
$generate_custom_color = array(
    //use for generate custom color file css
    'color_default'     =>  '#ff2b42',
    'rgba_default'      =>  'rgba(225, 43, 66, 0.85)',
    'file_source'       =>  'colors/red.css',
    'file_name'         =>  'colors/viska-color-css.css',
    //end custom color file
);
/**
 * Default Framework configs
 */
$min = (AWE_DEBUG==true) ? ".min" :"";
$default_config = array(
    "support"               =>  array(
        'skype'                 =>  array('theocean87','kidiwp','dangy1989','nguyen_dttn'),
        'video'                 =>  '01Avrz-Q8ks',
        'doc'                   =>  'http://awethemes.com/docs/viska',
        'forum'                 =>  'http://awethemes.com/forum/theme-support/viska',
    ),
    "generate_custom_color" =>  $generate_custom_color,
    "frame_options"         =>  $frame_configs,
    "theme_options_name"    =>  apply_filters('awe_get_option_by_lang',THEME_OPTIONS_NAME),
    "theme_new_configs"     =>  $theme_new_configs,
    "extra_options"         =>  $options_extra,
    "extra_tab_name"        =>  "Viska Settings",
    "extra_tpl"             =>  dirname( __FILE__ )."/extra_tpl.php",
    "extra_css"             =>  get_template_directory_uri()."/assets/css/extra.css",
    "extra_js"              =>  get_template_directory_uri()."/assets/js/extra".$min.".js",
    // "spectrum_js"           =>  get_template_directory_uri().""
    "menu_name"             =>  array("Main Menu", "Top Menu","Left Menu"),
    "menu_id"               =>  'main-menu',
    "contact_form_name"     =>  "Viska Contact",
    "contact_option"        =>  "form",
    // "profile_name"          =>  "Jonathan Doe",
    // "profile_option"        =>  "profile",
    "homegpage_name"        =>  'Home Page',
    "about_name"            =>  "Hello world !",
    "about_option"          =>  "aboutus",
    "pricing_name"          =>  "Pricng",
    "pricing_option"        =>  "display",
    "options_demo"          =>  array(
        'intro_bg_data'=>  '{"type":"video","static":{"image":"http://demo.awethemes.com/viska/wp-content/uploads/2014/08/image-parallax-11.jpg","mouse":1},"color":"#fff","slider":{"images":["http://demo.awethemes.com/viska/wp-content/uploads/2014/08/image-parallax-5.jpg","http://demo.awethemes.com/viska/wp-content/uploads/2014/08/image-parallax-6.jpg"],"transition":"fade","speed":"4000"},"video":{"url":"https://www.youtube.com/watch?v=L2HXlcgfwKc","hide":0,"autoplay":0,"control":1,"loop":1,"mute":0,"placeholder":1,"video_place_holder":"http://demo.awethemes.com/viska/wp-content/uploads/2014/08/image-parallax-11.jpg"},"overlay":{"enable":"1","type":["color","pattern"],"color":"rgba(255,255,255,.4)","pattern":"'.get_template_directory_uri().'/assets/images/bg-pattern-white.png"}}',
        
        'blog_bg' =>  '{"type":"static","static":{"image":"http://demo.awethemes.com/viska/wp-content/uploads/2014/08/image-parallax-7.jpg"},"overlay":{"enable":"1","type":["color","pattern"],"color":"rgba(255,255,255,.4)","pattern":"'.get_template_directory_uri().'/assets/images/bg-pattern-white.png"}}',
        'testimonial'          =>  array(
            'header'        =>  array(
                'enable'        =>  0,
                'style'         =>  'normal',
                'title'         =>  'TESTIMONIALS',
                'subtitle'      =>  array('enable'=>1,'text'=>'We are branding & digital studio from New York'),
            ),
            'content' => array(
                'animation' => 'fadeInUp',
            ),
            'overlay' => '{"enable":"1","type":["color","pattern"],"color":"rgba(0, 0, 0, 0.4)","pattern":"'.get_template_directory_uri().'/assets/images/bg-pattern.png"}',
            'parallax'      =>  '{"color":"","transparent":"","image":"http://demo.awethemes.com/viska/wp-content/uploads/2014/08/image-parallax-6.jpg","enable":1}',
            'footer' => array(
                'enable' => 0,
                'style' => 'style-1',
                'style_options' =>  array('style-1'=>'Style 1','style-2'=>'Style 2','style-3'=>'Style 3','style-4'=>'Style 4'),
                'animation'     =>  'fadeInhalf-text',
                'title'         => array('enable'=>0,'text'=>'Do you Love us Yet'),
                'subtitle'      =>  array('enable'=>0,'text'=>'We are branding & digital studio from New York'),
                'desc'          => array('enable'=>0,'text'=>'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.'),
                'button' => array('enable'=>0,'text'=>'OUR WORK','link'=>'#'),
            ),
            'show'          =>  1,
        ),
        'twitter'          =>  array(
            'header'        =>  array(
                'enable'        =>  0,
                'style'         =>  'normal',
                'title'         =>  'Twitter',
                'subtitle'      =>  array('enable'=>1,'text'=>'We are branding & digital studio from New York'),
            ),
            'overlay' => '{"enable":"1","type":["color","pattern"],"color":"rgba(0, 0, 0, 0.4)","pattern":"'.get_template_directory_uri().'/assets/images/bg-pattern.png"}',
            'parallax'      =>  '{"color":"","transparent":"","image":"http://demo.awethemes.com/viska/wp-content/uploads/2014/08/image-parallax-4.jpg","enable":1}',
            'show'          =>  1,
        ),
        'service'         =>  array(
            'header'        =>  array(
                'enable'        =>  1,
                'style'         =>  'title-big',
                'title'         =>  'SERVICES',
                'subtitle'      =>  array('enable'=>1,'text'=>'We are branding & digital studio from New York'),
                'animation'     => 'fadeInRightBig',
            ),
            'content'       =>  array(
                'animation'     =>  'fadeInhalf-symbolBig',
            ),
            'footer' => array(
                'enable' => 0,
                'style' => 'style-1',
                'style_options' =>  array('style-1'=>'Style 1','style-2'=>'Style 2','style-3'=>'Style 3','style-4'=>'Style 4'),
                'animation'     =>  'fadeInhalf-text',
                'title'         => array('enable'=>0,'text'=>'Do you Love us Yet'),
                'subtitle'      =>  array('enable'=>0,'text'=>'We are branding & digital studio from New York'),
                'desc'          => array('enable'=>0,'text'=>'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.'),
                'button' => array('enable'=>0,'text'=>'OUR WORK','link'=>'#'),
            ),
            'overlay' => '{"enable":"1","type":["color","pattern"],"color":"rgba(0, 0, 0, 0.4)","pattern":"'.get_template_directory_uri().'/assets/images/bg-pattern.png"}',
            'slider'        =>  '{"enable":1,"num":"3"}',
            'parallax'      =>  '{"color":"","transparent":"","image":"http://demo.awethemes.com/viska/wp-content/uploads/2014/08/image-parallax-2.jpg","enable":1}',
            'show'          =>  1,
        ),
        'skill'         =>  array(
            'header'        =>  array(
                'enable'        =>  1,
                'style'         =>  'normal',
                'title'         =>  'Our Skills',
                'subtitle'      =>  array('enable'=>1,'text'=>'We are branding & digital studio from New York'),
                'animation'     => 'fadeInUp',
            ),
            'content'       =>  array(
                'animation'     =>  'fadeInhalf-text',
            ),
            'slider'        =>  '{"enable":0,"num":"4"}',
            'overlay' => '{"enable":"1","type":["color","pattern"],"color":"rgba(0, 0, 0, 0.4)","pattern":"'.get_template_directory_uri().'/assets/images/bg-pattern.png"}',
            'parallax'      =>  '{"color":"","transparent":"","image":"http://demo.awethemes.com/viska/wp-content/uploads/2014/08/image-parallax-3.jpg","enable":1}',
            'show'          =>  1,
        ),
        'lastedpost'     =>  array(
            'header'        =>  array(
                'enable'        =>  1,
                'style'         =>  'normal',
                'title'         =>  'LASTED POST',
                'subtitle'      =>  array('enable'=>1,'text'=>'We are branding & digital studio from New York'),
                'animation' => 'swing',
            ),
            'content'       =>  array(
                'animation'     =>  'fadeInUp',
            ),
            'button'        =>  array(
                'label'         =>  'Read More',
            ),
            'parallax'      =>  '{"color":"","transparent":"","image":"http://demo.awethemes.com/viska/wp-content/uploads/2014/08/image-parallax-5.jpg","enable":1}',
            'show'          =>  1,
            'limit_display' =>  5,
            'footer' => array(
                'enable' => 0,
                'style' => 'style-1',
                'style_options' =>  array('style-1'=>'Style 1','style-2'=>'Style 2','style-3'=>'Style 3','style-4'=>'Style 4'),
                'animation'     =>  'fadeInhalf-text',
                'title'         => array('enable'=>0,'text'=>'Do you Love us Yet'),
                'subtitle'      =>  array('enable'=>0,'text'=>'We are branding & digital studio from New York'),
                'desc'          => array('enable'=>0,'text'=>'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.'),
                'button' => array('enable'=>0,'text'=>'OUR WORK','link'=>'#'),
            ),
            'overlay' => '{"enable":"1","type":["color","pattern"],"color":"rgba(0, 0, 0, 0.4)","pattern":"'.get_template_directory_uri().'/assets/images/bg-pattern.png"}',
        ),
    ),
    "widgets"               =>  array(
        //sidebarSlug => widgets
        "sidebar"    =>  array(
            //wdigetSlug    => array($countMod, $widgetSettings)
            'search'            =>  array(0,array("title"=>"Search")),
            'categories'        =>  array(0,array("title"=>"Categories","count"=>"1")),
            'tag_cloud'         =>  array(0,array("title"=>"Tags","taxonomy"=>"post_tag")),
            'awew_flickr'       =>  array(0,array("title"=>"Flickr","limit"=>"12","id"=>"52617155@N08")),
            'archives'          =>  array(0,array("title"=>"Archives")),

        ),
    ),
    'menu_replace'          =>  'http://demo.awethemes.com/viska',
    'plugins'               =>  array(
//        array(
//            'name'               => 'Chulan Coming Soon Plugin', // The plugin name.
//            'slug'               => 'chulan-comingsoon', // The plugin slug (typically the folder name).
//            'source'             => get_stylesheet_directory() .'/plugins/chulan-comingsoon.zip', // The plugin source.
//            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
//            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
//        ),
       array(
           'name'      => 'Contact Form 7',
           'slug'      => 'contact-form-7',
           'required'  => true,
       ),
    ),
);

/**
 * Main Framework filter
 */

add_filter("display_shortcodes_module",create_function('', 'return false;') );
add_filter("display_widgets_module",create_function('', 'return true;') );
add_filter("display_pagenotfound_module",create_function('', 'return false;') );

/**
 * Initialize AWE FrameWork
 */
include(get_template_directory() .'/Framework/AWE-Framework.php');
if(class_exists("AweFramework")){
    $AWE = new AweFramework($default_config);
}

?>