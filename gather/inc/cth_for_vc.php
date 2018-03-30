<?php
/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
add_action('vc_before_init', 'cththemes_gather_vcSetAsTheme');
function cththemes_gather_vcSetAsTheme() {
    vc_set_as_theme($disable_updater = true);
}



//if(class_exists('WPBakeryVisualComposerSetup')){
function cththemes_gather_theme_custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {
    if ($tag == 'vc_row' || $tag == 'vc_row_inner') {
        $class_string = str_replace('vc_row', 'row', $class_string);
    }
    if ($tag == 'vc_column' || $tag == 'vc_column_inner') {
        $class_string = preg_replace('/vc_col-(xs|sm|md|lg)-(\d{1,2})/', 'col-$1-$2', $class_string);
        $class_string = preg_replace('/vc_col-(xs|sm|md|lg)-offset-(\d{1,2})/', 'col-$1-offset-$2', $class_string);

    }
    return $class_string;
}

// Filter to Replace default css class for vc_row shortcode and vc_column

// add_filter('vc_shortcodes_css_class', 'cththemes_gather_theme_custom_css_classes_for_vc_row_and_vc_column', 10, 2);

function cththemes_gather_ace_settings_field($settings, $value) {
    if (!isset($settings['ace_mode'])) {
        $settings['ace_mode'] = 'html';
    }
    if (isset($settings['ace_style'])) {
        $ace_style = 'style="' . $settings['ace_style'] . '"';
    } 
    else {
        $ace_style = 'style="min-height:300px;border:1px solid #bbb;"';
    }
    return '<div id="cth_ace_editor" ' . $ace_style . '>' . '</div>' . '<input name="' . esc_attr($settings['param_name']) . '" class="wpb_vc_param_value wpb-hidden ' . esc_attr($settings['param_name']) . ' ' . esc_attr($settings['type']) . '_field" type="hidden" value="' . esc_attr($value) . '" />' . '<script src="' . get_template_directory_uri() . '/vc_extend/ace/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>' . '<script src="' . get_template_directory_uri() . '/vc_extend/ace/src-min-noconflict/mode-' . esc_attr($settings['ace_mode']) . '.js" type="text/javascript" charset="utf-8"></script>' . '<script>'
    
    //. "function htmlEntities(str) {return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/\"/g, '&quot;');}"
     . 'var cth_ace_editor = ace.edit("cth_ace_editor");' . 'cth_ace_editor.getSession().setMode("ace/mode/' . esc_attr($settings['ace_mode']) . '");' . 'cth_ace_editor.setValue( decodeURIComponent( atob( jQuery("#cth_ace_editor").next(".cth_ace_field").val() ) ) );' . 'cth_ace_editor.getSession().on("change", function(e) {' . 'jQuery("#cth_ace_editor").next(".cth_ace_field").val( btoa( encodeURIComponent(  cth_ace_editor.getValue() ) ) );'
    
    //. 'jQuery(".content.cth_ace").html(  htmlEntities(cth_ace_editor.getValue()) );'
     . '});' . '</script>';
}


// if(function_exists('add_shortcode_param')){
//     add_shortcode_param('cth_ace', 'cththemes_gather_ace_settings_field');
// }



// Add new Param in Row

if (function_exists('vc_add_param')) {
    
    vc_add_param(
        'vc_row', 
        array(
            "type" => "dropdown", 
            "heading" => __('Section Layout', 'gather'), 
            "param_name" => "cth_layout", 
            "value" => array(
                __('Default', 'gather') => 'default', 
                __('Gather Header','gather') => 'gather_header',
                __('Gather Header Video','gather') => 'gather_header_video',
                __('Gather Header Youtube Video','gather') => 'gather_header_yt_video',
                __('Gather Page Section','gather') => 'gather_sec',
                __('Gather Header Slideshow','gather') => 'gather_slideshow_sec',
            ), 
            "description" => __("Select one of the pre made page sections or using default", 'gather'),
            "group" => esc_html__("Gather Theme",'gather'),
        )
        
    );

    vc_add_param('vc_row',array(
                                "type" => "attach_images",
                                "class"=>"",
                                "heading" => __('Slideshow Background Image', 'gather'),
                                "param_name" => "slideshow_imgs",
                                
                                //"description" => __("Set this to Yes if you want to display single item only", 'gather'), 
                                'dependency' => array(
                                    'element' => 'cth_layout',
                                    'value' => array( 'gather_slideshow_sec' ),
                                    'not_empty' => false,
                                ),
                                "group" => esc_html__("Gather Theme",'gather'),
                            )

    );

    vc_add_param(
        'vc_row',
        array(
            "type" => "dropdown",
            "class"=>"",
            "heading" => __('Video Background Settings', 'gather'),
            "param_name" => "usevideobg",
            "value" => array(     
                __('No', 'gather') => 'no', 
                __('Yes', 'gather') => 'yes',                                                                                   
                                                                                              
            ),
            'dependency' => array(
                'element' => 'cth_layout',
                'value' => array( 'gather_header_video' ),
                'not_empty' => false,
            ),
            "group" => esc_html__("Gather Theme",'gather'),
        )
    );
    vc_add_param(
        'vc_row',
        array(
            "type"      => "textfield",
            //"holder"    => "div",
            "class"     => "",
            "heading"   => __(".MP4 Video Link", 'gather'),
            "param_name"=> "mp4video",
            "description" => __(".MP4 Video Link", 'gather'),
            'dependency' => array(
                'element' => 'usevideobg',
                'value' => array( 'yes' ),
                'not_empty' => false,
            ),
            "group" => esc_html__("Gather Theme",'gather'),
        )
    );
    vc_add_param(
        'vc_row',
        array(
            "type"      => "textfield",
            //"holder"    => "div",
            "class"     => "",
            "heading"   => __(".WebM Video Link", 'gather'),
            "param_name"=> "webmvideo",
            "description" => __(".WebM Video Link", 'gather'),
            'dependency' => array(
                'element' => 'usevideobg',
                'value' => array( 'yes' ),
                'not_empty' => false,
            ),
            "group" => esc_html__("Gather Theme",'gather'),
        )
    );
    vc_add_param(
        'vc_row',
        array(
            "type"      => "textfield",
            //"holder"    => "div",
            "class"     => "",
            "heading"   => __(".Ogg Video Link", 'gather'),
            "param_name"=> "oggvideo",
            "description" => __(".Ogg Video Link", 'gather'),
            'dependency' => array(
                'element' => 'usevideobg',
                'value' => array( 'yes' ),
                'not_empty' => false,
            ),
            "group" => esc_html__("Gather Theme",'gather'),
        )
    );
    vc_add_param(
        'vc_row',
        array(
            "type"      => "attach_image",
            //"holder"    => "div",
            "class"     => "",
            "heading"   => __("Video Background Image", 'gather'),
            "param_name"=> "videobgimg",
            "description" => __("Video Background Image", 'gather'),
            'dependency' => array(
                'element' => 'usevideobg',
                'value' => array( 'yes' ),
                'not_empty' => false,
            ),
            "group" => esc_html__("Gather Theme",'gather'),
        )
    );

    vc_add_param(
        'vc_row',
        array(
            "type"      => "textfield",
            //"holder"    => "div",
            "class"     => "",
            "heading"   => __("Youtube Video(Link or ID)", 'gather'),
            "param_name"=> "youtubevideo",
            "description" => __("The URL of the page containing the video: 'https://www.youtube.com/watch?v=V2rifmjZuKQ'. The short URL available fron the YouTube share panel: 'http://youtu.be/V2rifmjZuKQ'. The video ID: 'V2rifmjZuKQ'", 'gather'),
            'dependency' => array(
                    'element' => 'cth_layout',
                    'value' => array( 'gather_header_yt_video' ),
                    'not_empty' => false,
            ),
            "group" => esc_html__("Gather Theme",'gather'),
        )
    );
    // vc_add_param(
    //     'vc_row',
    //     array(
    //         "type"      => "attach_image",
    //         //"holder"    => "div",
    //         "class"     => "",
    //         "heading"   => __("Video Background Image", 'gather'),
    //         "param_name"=> "ytvideobgimg",
    //         "description" => __("Video Background Image", 'gather'),
    //         'dependency' => array(
    //                 'element' => 'cth_layout',
    //                 'value' => array( 'gather_header_yt_video' ),
    //                 'not_empty' => false,
    //         ),
    //         "group" => esc_html__("Gather Theme",'gather'),
    //     )
    // );
    vc_add_param(
        'vc_row',
        array(
            "type" => "dropdown",
            "class"=>"",
            "heading" => __('Autoplay', 'gather'),
            "param_name" => "yt_autoplay",
            "value" => array(   
                __('Yes', 'gather') => 'yes',  
                __('No', 'gather') => 'no', 
                                                                                                 
                                                                                              
            ),
            'dependency' => array(
                'element' => 'cth_layout',
                'value' => array( 'gather_header_yt_video' ),
                'not_empty' => false,
            ),  
            "group" => esc_html__("Gather Theme",'gather'),
        )
    );
    vc_add_param(
        'vc_row',
        array(
            "type" => "dropdown",
            "class"=>"",
            "heading" => __('Show Controls', 'gather'),
            "param_name" => "yt_controls",
            "value" => array(   
                __('Yes', 'gather') => 'yes',  
                __('No', 'gather') => 'no',                                                                                
            ),
            'dependency' => array(
                'element' => 'cth_layout',
                'value' => array( 'gather_header_yt_video' ),
                'not_empty' => false,
            ),  
            "group" => esc_html__("Gather Theme",'gather'),
        )
    );
    vc_add_param(
        'vc_row',
        array(
            "type" => "dropdown",
            "class"=>"",
            "heading" => __('Loop', 'gather'),
            "param_name" => "yt_loop",
            "value" => array(   
                __('Yes', 'gather') => 'yes',  
                __('No', 'gather') => 'no',                                                                               
            ),
            'dependency' => array(
                'element' => 'cth_layout',
                'value' => array( 'gather_header_yt_video' ),
                'not_empty' => false,
            ),
            "group" => esc_html__("Gather Theme",'gather'),  
        )
    );
    vc_add_param(
        'vc_row',
        array(
            "type" => "dropdown",
            "class"=>"",
            "heading" => __('Mute', 'gather'),
            "param_name" => "yt_mute",
            "value" => array(   
                            __('Yes', 'gather') => 'yes',  
                            __('No', 'gather') => 'no', 
                                                                                                             
                                                                                                          
                        ),
            'dependency' => array(
                    'element' => 'cth_layout',
                    'value' => array( 'gather_header_yt_video' ),
                    'not_empty' => false,
            ),  
            "group" => esc_html__("Gather Theme",'gather'),
        )
    );
    vc_add_param(
        'vc_row',
        array(
            "type"      => "textfield",
            //"holder"    => "div",
            "class"     => "",
            "heading"   => __("Opacity", 'gather'),
            "param_name"=> "yt_opacity",
            "description" => __("0 to 1 (number) define the opacity of the video.", 'gather'),
            "value" => '1',
            'dependency' => array(
                    'element' => 'cth_layout',
                    'value' => array( 'gather_header_yt_video' ),
                    'not_empty' => false,
            ),
            "group" => esc_html__("Gather Theme",'gather'),
        )
    );
    vc_add_param(
        'vc_row',
        array(
            "type"      => "textfield",
            //"holder"    => "div",
            "class"     => "",
            "heading"   => __("Quality", 'gather'),
            "param_name"=> "yt_quality",
            "description" => __("'default' or 'small', 'medium', 'large', 'hd720', 'hd1080', 'highres'", 'gather'),
            "value" => 'default',
            'dependency' => array(
                    'element' => 'cth_layout',
                    'value' => array( 'gather_header_yt_video' ),
                    'not_empty' => false,
            ),
            "group" => esc_html__("Gather Theme",'gather'),
        )
    );
    vc_add_param(
        'vc_row',
        array(
            "type" => "dropdown",
            "class"=>"",
            "heading" => __('Add Raster', 'gather'),
            "param_name" => "yt_raster",
            "description" => __('Show or hide a raster image over the video.','gather'),
            "value" => array(   
                        __('No', 'gather') => 'no',
                            __('Yes', 'gather') => 'yes',  
                             
                                                                                                             
                                                                                                          
                        ),
            'dependency' => array(
                    'element' => 'cth_layout',
                    'value' => array( 'gather_header_yt_video' ),
                    'not_empty' => false,
            ),  
            "group" => esc_html__("Gather Theme",'gather'),
        )
    );

    vc_add_param('vc_column',array(
                                  "type" => "dropdown",
                                  "heading" => __('Use Animation', 'gather'),
                                  "param_name" => "animation",
                                  "value" => array(   
                                                    __('No', 'gather') => 'no',  
                                                    __('Yes', 'gather') => 'yes',                                                                                
                                                  ),
                                  "description" => __("Use animation effect or not", 'gather'),
                                  "group" => esc_html__("Gather Theme",'gather'),      
                                ) 
        );

        vc_add_param('vc_column',array(
                                  "type" => "dropdown",
                                  "heading" => __('Data effect', 'gather'),
                                  "param_name" => "effect",
                                  "value" => array(
                                                    __('bounce','gather')=>'bounce',
                                                    __('flash','gather')=>'flash',
                                                    __('pulse','gather')=>'pulse',
                                                    __('rubberBand','gather')=>'rubberBand',
                                                    __('shake','gather')=>'shake',
                                                    __('swing','gather')=>'swing',
                                                    __('tada','gather')=>'tada',
                                                    __('wobble','gather')=>'wobble',

                                                    __('bounceIn','gather')=>'bounceIn',
                                                    __('bounceInUp','gather')=>'bounceInUp',
                                                    __('bounceInDown','gather')=>'bounceInDown',
                                                    __('bounceInLeft','gather')=>'bounceInLeft',
                                                    __('bounceInRight','gather')=>'bounceInRight',
                                                    __('bounceOut','gather')=>'bounceOut',
                                                    __('bounceOutUp','gather')=>'bounceOutUp',
                                                    __('bounceOutDown','gather')=>'bounceOutDown',
                                                    __('bounceOutLeft','gather')=>'bounceOutLeft',
                                                    __('bounceOutRight','gather')=>'bounceOutRight',

                                                    __('fadeIn','gather')=>'fadeIn',
                                                    __('fadeInUp','gather')=>'fadeInUp',
                                                    __('fadeInDown','gather')=>'fadeInDown',
                                                    __('fadeInLeft','gather')=>'fadeInLeft',
                                                    __('fadeInRight','gather')=>'fadeInRight',
                                                    __('fadeInUpBig','gather')=>'fadeInUpBig',
                                                    __('fadeInDownBig','gather')=>'fadeInDownBig',
                                                    __('fadeInLeftBig','gather')=>'fadeInLeftBig',
                                                    __('fadeInRightBig','gather')=>'fadeInRightBig',

                                                    __('fadeOut','gather')=>'fadeOut',
                                                    __('fadeOutUp','gather')=>'fadeOutUp',
                                                    __('fadeOutDown','gather')=>'fadeOutDown',
                                                    __('fadeOutLeft','gather')=>'fadeOutLeft',
                                                    __('fadeOutRight','gather')=>'fadeOutRight',
                                                    __('fadeOutUpBig','gather')=>'fadeOutUpBig',
                                                    __('fadeOutDownBig','gather')=>'fadeOutDownBig',
                                                    __('fadeOutLeftBig','gather')=>'fadeOutLeftBig',
                                                    __('fadeOutRightBig','gather')=>'fadeOutRightBig',

                                                    __('flipInX','gather')=>'flipInX',
                                                    __('flipInY','gather')=>'flipInY',
                                                    __('flipOutX','gather')=>'flipOutX',
                                                    __('flipOutY','gather')=>'flipOutY',
                                                    __('rotateIn','gather')=>'rotateIn',
                                                    __('rotateInDownLeft','gather')=>'rotateInDownLeft',
                                                    __('rotateInDownRight','gather')=>'rotateInDownRight',
                                                    __('rotateInUpLeft','gather')=>'rotateInUpLeft',
                                                    __('rotateInUpRight','gather')=>'rotateInUpRight',

                                                    __('rotateOut','gather')=>'rotateOut',
                                                    __('rotateOutDownLeft','gather')=>'rotateOutDownLeft',
                                                    __('rotateOutDownRight','gather')=>'rotateOutDownRight',
                                                    __('rotateOutUpLeft','gather')=>'rotateOutUpLeft',
                                                    __('rotateOutUpRight','gather')=>'rotateOutUpRight',

                                                    __('rotateOut','gather')=>'rotateOut',
                                                    __('rotateOutDownLeft','gather')=>'rotateOutDownLeft',
                                                    __('rotateOutDownRight','gather')=>'rotateOutDownRight',
                                                    __('rotateOutUpLeft','gather')=>'rotateOutUpLeft',
                                                    __('rotateOutUpRight','gather')=>'rotateOutUpRight',

                                                    __('slideInDown','gather')=>'slideInDown',
                                                    __('slideInLeft','gather')=>'slideInLeft',
                                                    __('slideInRight','gather')=>'slideInRight',
                                                    __('slideOutLeft','gather')=>'slideOutLeft',
                                                    __('slideOutRight','gather')=>'slideOutRight',
                                                    __('slideOutUp','gather')=>'slideOutUp',
                                                    __('slideInUp','gather')=>'slideInUp',
                                                    __('slideOutDown','gather')=>'slideOutDown',

                                                    __('hinge','gather')=>'hinge',

                                                    __('rollIn','gather')=>'rollIn',
                                                    __('rollOut','gather')=>'rollOut',
                                                    

                                                    __('zoomIn','gather')=>'zoomIn',
                                                    __('zoomInUp','gather')=>'zoomInUp',
                                                    __('zoomInDown','gather')=>'zoomInDown',
                                                    __('zoomInLeft','gather')=>'zoomInLeft',
                                                    __('zoomInRight','gather')=>'zoomInRight',

                                                    __('zoomOut','gather')=>'zoomOut',
                                                    __('zoomOutUp','gather')=>'zoomOutUp',
                                                    __('zoomOutDown','gather')=>'zoomOutDown',
                                                    __('zoomOutLeft','gather')=>'zoomOutLeft',
                                                    __('zoomOutRight','gather')=>'zoomOutRight',
                                                ),                              
                                  "description" => __("Add data effect", 'gather'),      
                                  "group" => esc_html__("Gather Theme",'gather'),
                                ) 

        );

        vc_add_param('vc_column',
            array(
                "type" => "textfield",
                "heading" => __('Animation Delay', 'gather'),
                "param_name" => "delay",
                "value" => "",
                "description" => __("Animation delay in second like 2s", 'gather'),
                "group" => esc_html__("Gather Theme",'gather'),
            ) 

        );
}

//if(function_exists('vc_remove_param')){ }
