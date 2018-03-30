<?php
/**
 * Project of Awethemes.com
 * Author: duongle
 * Date: 4/14/14
 * Time: 6:06 PM
 */


Define("LANGUAGE","AweFramework");
Define("THEME_NAME","Viska Theme");
Define("THEME_OPTIONS_NAME","wm_options");
Define("AWE_DEBUG",true);
/**
 * Initialize Theme
 */
if ( ! function_exists( 'awe_theme_setup' ) ) :
function awe_theme_setup()
{
    //register primary menu
    register_nav_menus(
        array(
                'main_menu' =>  __('Main Menu',LANGUAGE ),
                'top_menu' => __('Top Menu',LANGUAGE),
                'left_menu' => __('Left Menu',LANGUAGE),
        )
    );

    /* Adding Theme support */
    add_theme_support( 'html5' );
    add_theme_support( 'jquery-cdn' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-formats', array( 'gallery', 'audio', 'link','video', 'image', 'quote','chat','status') );
    /* Add support thumbnail */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 370, 9999 ); // Unlimited height, soft crop
    add_image_size( 'awe-post-thumb', 770, 450, true );
    add_image_size( 'awe-team-thumb', 370, 313, true );
    add_image_size( 'awe-portfolio-thumb', 316, 211, true );
    add_image_size( 'awe-last_post-thumb', 370, 370, true );
    add_filter( 'image_size_names_choose', 'my_custom_sizes' );
    
    function my_custom_sizes( $sizes ) {
        return array_merge( $sizes, array(
            'awe-team-thumb' => __('Team Member Thumb',LANGUAGE),
            'awe-portfolio-thumb' => __('Portfolio Thumb',LANGUAGE),
            'awe-post-thumb' => __('Post Thumb',LANGUAGE)
        ) );
    }
    /* Add support */
    add_post_type_support( 'awe_team', array( 'awe_social'));
    add_post_type_support( 'awe_aboutus', array( 'editor','awe_funfact','awe_skill','thumbnail','awe_feature'));
    add_post_type_support( 'awe_portfolio', array('awe_format','awe_media','awe_client_list'));
    add_post_type_support( 'post', array('post-formats','awe_media'));
    add_post_type_support( 'awe_service', array());
    add_post_type_support( 'awe_pricing_table', array('awe_pricing'));
    

}
endif;

add_action( 'after_setup_theme', 'awe_theme_setup' );

if(defined('EMGDEF_PLUGIN_URL')){
    remove_action( 'wp_enqueue_scripts', 'easymedia_frontend_script' );
    add_action( 'wp_enqueue_scripts', 'easymedia_frontend_script',103 );
    add_action( 'wp_enqueue_scripts', 're_easymedia_frontend_js',102);
    function re_easymedia_frontend_js() {
        wp_deregister_script( 'fittext' );
        wp_deregister_script( 'mootools-core' );
        wp_deregister_script( 'easymedia-core' );
        wp_deregister_script( 'easymedia-isotope' );
        wp_deregister_script( 'easymedia-ajaxfrontend' );
        wp_deregister_script( 'easymedia-frontend' );
        wp_deregister_script( 'easymedia-jpages' );
        wp_deregister_script( 'easymedia-lazyload' );
        // JS ( frontend.php )
        wp_deregister_script('fittext'); // deregister
        wp_register_script( 'fittext', EMGDEF_PLUGIN_URL.'includes/js/jquery/jquery.fittext.js' , array(), null, true );
        wp_register_script( 'mootools-core', EMGDEF_PLUGIN_URL.'includes/js/mootools/mootools-' .easy_get_option( 'easymedia_plugin_core' ). '.js'  , array(), null, true );
        wp_register_script( 'easymedia-core', EMGDEF_PLUGIN_URL.'includes/js/mootools/easymedia.js' , array(), null, true );
        wp_register_script( 'easymedia-isotope', EMGDEF_PLUGIN_URL.'includes/js/jquery/jquery.isotope.min.js' , array(), null, true );
        wp_register_script( 'easymedia-ajaxfrontend', EMGDEF_PLUGIN_URL.'includes/js/func/ajax-frontend.js' , array(), null, true );
        wp_register_script( 'easymedia-frontend', EMGDEF_PLUGIN_URL.'includes/js/func/frontend.js' , array(), null, true );
        wp_register_script( 'easymedia-jpages', EMGDEF_PLUGIN_URL.'includes/js/jquery/jPages.js' , array(), null, true );
        wp_register_script( 'easymedia-lazyload', EMGDEF_PLUGIN_URL.'includes/js/jquery/jquery.lazyload.min.js' , array(), null, true );
    }

}


global $options_extra;
$options_extra = array(
    'skin'                      =>  'light',
    'style_color'               =>  'color-red',
    'style_color_custom'        =>  '#54BABB',
    'aboutus'                   =>  0,
    'porfolio_display'          => 'expanding',
    'intro_bg_data'             =>  '{"type":"slider","static":{"image":"'.get_template_directory_uri().'/assets/images/parallax.jpg","mouse":1},"color":"#fff","slider":{"images":["'.get_template_directory_uri().'/assets/images/parallax.jpg","'.get_template_directory_uri().'/assets/images/parallax.jpg","'.get_template_directory_uri().'/assets/images/parallax.jpg"],"transition":"fade","speed":"4000"},"video":{"url":"https://www.youtube.com/watch?v=L2HXlcgfwKc","hide":0,"autoplay":1,"control":1,"loop":1,"mute":0,"placeholder":0,"video_place_holder":"'.get_template_directory_uri().'/assets/images/parallax.jpg"},"overlay":{"enable":"1","type":["color","pattern"],"color":"rgba(0,0,0,.4)","pattern":"'.get_template_directory_uri().'/assets/images/bg-pattern.png"}}',
    'intro_data'                =>  '{"logo":{"enable":1,"url":"'.get_template_directory_uri().'/assets/images/logo.png"},"slogan":{"enable":1,"type":"slider","style":"border","static_text":"Hello World !","slider_text":["Hello world !","We Love Ugly"],"transition":"fade","speed":"4000"},"button":{"enable":1,"text":"Brands. Websites. Results"}}',
    'nav_style'                 =>  'logo-center',
    'blog_bg'             =>  '{"type":"slider","static":{"image":"'.get_template_directory_uri().'/assets/images/parallax.jpg"},"overlay":{"enable":"1","type":["color","pattern"],"color":"rgba(0,0,0,.4)","pattern":"'.get_template_directory_uri().'/assets/images/bg-pattern.png"}}',
    'blog_data'                =>  '{"slogan":{"enable":1,"type":"slider","style":"border","static_text":"Hello World !","slider_text":["Hello world !","We Love Ugly"],"transition":"fade","speed":"4000"},"button":{"enable":1,"text":"Brands. Websites. Results"}}',
    'nav_style'                 =>  'logo-center',
    'about'         =>  array(
        'header'        =>  array(
            'enable'        =>  1,
            'style'         =>  'line-top',
            'animation'     => 'fadeInUp',
        ),
        'content'       =>  array(
            'animation'     =>  'fadeInhalf-text',
        ),
        'footer' => array(
            'enable' => 1,
            'button' => array('enable'=>1,'text'=>'OUR WORK','link'=>'#'),
        ),
        'overlay' => '{"enable":"0","type":["color","pattern"],"color":"rgba(0,0,0,.4)","pattern":"'.get_template_directory_uri().'/assets/images/bg-pattern.png"}',
        'parallax'      =>  '{"color":"","transparent":"","image":"","enable":0}',
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
        'overlay' => '{"enable":"0","type":["color","pattern"],"color":"#fff","pattern":"'.get_template_directory_uri().'/assets/images/bg-pattern.png"}',
        'parallax'      =>  '{"color":"","transparent":"","image":"'.get_template_directory_uri().'/assets/images/parallax.jpg","enable":1}',
        'show'          =>  1,
    ),
    'team'          =>  array(
        'header'        =>  array(
            'enable'        =>  1,
            'style'         =>  'line-bottom',
            'title'         =>  'Creative Teams',
            'subtitle'      =>  array('enable'=>1,'text'=>'Our creative minds will make your ideas possible'),
            'animation'     => 'fadeInUp',
        ),
        'content'       =>  array(
            'animation'     =>  'fadeInhalf-text',
            'join' => 1,
            'join_image'    => get_template_directory_uri().'/assets/images/team-logo.png',
            'join_text'     => 'Join Our Team',
            'join_link'     => '#',
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
        'slider'        =>  '{"enable":0,"num":"4"}',
        'parallax'      =>  '{"color":"","transparent":"","image":"","enable":0}',
        'show'          =>  1,
    ),
    'funfact'       =>  array(
        'show'          =>  1,
    ),
    'idea'          =>  array(
        'header'        =>  array(
            'enable'        =>  1,
            'style'         =>  'normal',
            'title'         =>  'OUR PROCESS',
            'subtitle'      =>  array('enable'=>1,'text'=>'We are branding & digital studio from New York'),
            'animation'     => 'fadeInhalf-text',
        ),
        'content'       =>  array(
            'animation'     =>  'fadeInhalf-text',
        ),
        'slider'        =>  '{"enable":0,"num":"3"}',
        'footer' => array(
            'enable' => 1,
            'style' => 'style-1',
            'style_options' =>  array('style-1'=>'Style 1','style-2'=>'Style 2','style-3'=>'Style 3','style-4'=>'Style 4'),
            'animation'     =>  'fadeInhalf-text',
            'title'         => array('enable'=>1,'text'=>'Do you Love us Yet'),
            'subtitle'      =>  array('enable'=>0,'text'=>'We are branding & digital studio from New York'),
            'desc'          => array('enable'=>0,'text'=>'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.'),
            'button' => array('enable'=>1,'text'=>'OUR WORK','link'=>'#'),
        ),
        'overlay' => '{"enable":"0","type":["color","pattern"],"color":"rgba(0,0,0,.4)","pattern":"'.get_template_directory_uri().'/assets/images/bg-pattern.png"}',
        'parallax'      =>  '{"color":"","transparent":"","image":"","enable":0}',
        'show'          =>  1,
    ),
    'client'          =>  array(
        'header'        =>  array(
            'enable'        =>  1,
            'style'         =>  'line-bottom',
            'title'         =>  'OUR CLIENTS',
            'subtitle'      =>  array('enable'=>1,'text'=>'We have worked with some of the world\'s bigget brands '),
            'animation'     => 'fadeInUp',
        ),
        'content'       =>  array(
            'animation'     =>  'fadeInhalf-text',
        ),
        'slider'        =>  '{"enable":0,"num":"5"}',
        'parallax'      =>  '{"color":"","transparent":"","image":"","enable":0}',
        'show'          =>  1,
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
        'overlay' => '{"enable":"0","type":["color","pattern"],"color":"rgba(0, 0, 0, 0.4)","pattern":"'.get_template_directory_uri().'/assets/images/bg-pattern.png"}',
    ),
    'portfolio'          =>  array(
        'header'        =>  array(
            'enable'        =>  1,
            'style'         =>  'line-bottom',
            'title'         =>  'PORTFOLIO',
            'subtitle'      =>  array('enable'=>1,'text'=>'We are branding & digital studio from New York'),
            'animation'     => 'fadeInhalf-text',
        ),
        // 'content'       =>  array(
        //     'style'         =>  'style-1',
        //     'style_options' =>  array('style-1'=>'Style 1','style-2'=>'Style 2'),
        //     'hover_transparent' =>  '',
        // ),
        'parallax'      =>  '{"color":"","transparent":"","image":"","enable":0}',
        'show'          =>  1,
    ),
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
        'parallax'      =>  '{"color":"","transparent":"","image":"'.get_template_directory_uri().'/assets/images/parallax.jpg","enable":1}',
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
            'subtitle'      =>  array('enable'=>0,'text'=>'We are branding & digital studio from New York'),
        ),
        'overlay' => '{"enable":"1","type":["color","pattern"],"color":"rgba(0, 0, 0, 0.4)","pattern":"'.get_template_directory_uri().'/assets/images/bg-pattern.png"}',
        'parallax'      =>  '{"color":"","transparent":"","image":"","enable":0}',
        'show'          =>  1,
    ),
    'service'         =>  array(
        'header'        =>  array(
            'enable'        =>  1,
            'style'         =>  'title-big',
            'title'         =>  'SERVICES',
            'subtitle'      =>  array('enable'=>1,'text'=>'We are branding & digital studio from New York'),
            'animation'     => 'fadeInUp',
        ),
        'content'       =>  array(
            'animation'     =>  'fadeInUp',
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
        'parallax'      =>  '{"color":"","transparent":"","image":"'.get_template_directory_uri().'/assets/images/parallax.jpg","enable":1}',
        'show'          =>  1,
    ),
    'pricing'         =>  array(
        'display'       =>  '',
        'header'        =>  array(
            'enable'        =>  1,
            'style'         =>  'line-bottom',
            'title'         =>  'Pricing Table',
            'subtitle'      =>  array('enable'=>1,'text'=>'We are branding & digital studio from New York'),
            'animation'     => 'fadeInUp',
        ),
        'content'       =>  array(
            'style'         =>  'style-1',
            'style_options' =>  array('style-1'=>'Style 1','style-2'=>'Style 2'),
            'animation'     =>  'fadeInUp',
        ),
        'slider'        =>  '{"enable":0,"num":"3"}',
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
        'overlay' => '{"enable":"0","type":["color","pattern"],"color":"rgba(0, 0, 0, 0.4)","pattern":"'.get_template_directory_uri().'/assets/images/bg-pattern.png"}',
        'button'        =>  array(
            'label'         =>  'Sign Up',
            'url'           =>  '#',
        ),
        'parallax'      =>  '{"color":"","transparent":"","image":"","enable":0}',
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
        'parallax'      =>  '{"color":"","transparent":"","image":"","enable":0}',
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
    'address'     =>  array(
        'header'        =>  array(
            'enable'        =>  1,
            'style'         =>  'title-big',
            'title'         =>  'Contact./',
            'subtitle'      =>  array('enable'=>1,'text'=>'We are branding & digital studio from New York'),
        ),
        'content'       =>  array(
            'animation'     =>  'fadeInUp',
            'address'       =>  '24 Rue de Saint Martin, Paris 1297,France',
            'phone'         =>  '+ 84 944 - 657 - 972 - 123',
            'email'         =>  'sayhell@wandmcreative.com',
            'studio'        => 'Viska Studio',
        ),
        'parallax'      =>  '{"color":"","transparent":"","image":"","enable":0}',
        'show'          =>  1,
        'overlay' => '{"enable":"0","type":["color","pattern"],"color":"rgba(0, 0, 0, 0.4)","pattern":"'.get_template_directory_uri().'/assets/images/bg-pattern.png"}',
    ),
    'contact'   =>  array(
        'form'          =>  '',
    ),
    'map'       =>array(
        'marker'     =>  get_template_directory_uri().'/assets/images/marker.png',
        'latitude'      =>  '45.738028',
        'longitude'     =>  '21.224535',
        'tooltip'       =>  array(
            'heading'       =>  'Viska Studio',
            'content'       =>  'Come here and drink a coffee',
        ),
        'show'          =>  1,
    ),
    'sort_section'              =>  'about,service,funfact,team,skill,portfolio,idea,twitter,pricing,lastedpost,client,testimonial,contact,map',
    'footer_skin'       =>  'dark',
);
/**
 * Loading Framework
 */
require_once('config-wpml.php');
require_once('config-framework.php');


/**
 * Loading Default Option
 */

function get_options()
{
    global $options_extra;
    $name = apply_filters('awe_get_option_by_lang',THEME_OPTIONS_NAME);
    if($wm_options = get_option($name) )
        return array_merge($options_extra,$wm_options['extra']);
    else return $options_extra;
}

