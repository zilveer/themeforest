<?php

/**
 * @package Gather - Event Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 10-8-2015
 *
 * @copyright  Copyright ( C ) 2014 - 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

//Home Slider
if(function_exists('vc_map')){

    vc_map( array(
        "name"      => __("Google Map", 'gather'),
        "description" => __("Google Map",'gather'),
        "base"      => "domik_gmap",
        "class"     => "",
        "icon" => get_template_directory_uri() . "/vc_extend/cth-icon.png",
        "category"  => 'Gather',
        //'admin_enqueue_css'=> get_template_directory_uri() . "/vc_extend/admin_style.css",

        "params"    => array(
            array(
                "type"      => "textfield",
                "class"     => "",
                "holder"     => "span",
                "heading"   => __("Address Latitude", 'gather'),
                "param_name"=> "latitude",
                "value"     => "59.3292956",
                "description" => __("Enter your address latitude. You can get your value from: <a href='http://www.gps-coordinates.net/' target='_blank'>http://www.gps-coordinates.net/</a>", 'gather')
            ),
            array(
                "type"      => "textfield",
                "class"     => "",
                "holder"     => "span",
                "heading"   => __("Address Longitude", 'gather'),
                "param_name"=> "longitude",
                "value"     => "18.0686451",
                "description" => __("Enter your address longitude. You can get your value from: <a href='http://www.gps-coordinates.net/' target='_blank'>http://www.gps-coordinates.net/</a>", 'gather')
            ),
            array(
                "type"      => "textfield",
                "class"     => "",
                "holder"     => "span",
                "heading"   => __("Address String", 'gather'),
                "param_name"=> "address",
                "value"     => "Stockholm, Sweden",
                "description" => __("Address string", 'gather')
            ),
            array(
                "type"      => "textfield",
                "class"     => "",
                //"holder"     => "span",
                "heading"   => __("Zoom", 'gather'),
                "param_name"=> "zoom",
                "value"     => "2",
                // "description" => __("", 'gather')
            ),
            array(
                "type"      => "attach_image",
                "class"     => "",
                "heading"   => __("Marker", 'gather'),
                "param_name"=> "marker",
                "value"     => get_template_directory_uri() ."/images/marker.png",
                "description" => __("Upload google map marker or leave it empty to use default.", 'gather')
            ),
            array(
                "type"      => "textfield",
                "class"     => "",
                //"holder"     => "span",
                "heading"   => __("Map Height", 'gather'),
                "param_name"=> "mapheight",
                "value"     => "400",
                // "description" => __("", 'gather')
            ),
            array(
                "type" => "dropdown",
                "class"=>"",
                "heading" => __('Color', 'gather'),
                "param_name" => "colorbg",
                "value" => array(   
                    __('Green', 'gather') => 'green',  
                    __('Red', 'gather') => 'red',  
                    __('Orange', 'gather') => 'orange',       
                    __('Yellow', 'gather') => 'yellow',  
                    __('Mint', 'gather') => 'mint',  
                    __('Aqua', 'gather') => 'aqua',  
                    __('Blue', 'gather') => 'blue',  
                    __('Purple', 'gather') => 'purple',  
                    __('Pink', 'gather') => 'pink',  
                    __('White', 'gather') => 'white',  
                    __('Grey', 'gather') => 'grey',  
                    __('Black', 'gather') => 'black',  
                    __('Invert', 'gather') => 'invert',  
                ),
                //"description" => __("", 'gather'),  
                "default"=>'green',    
            ),
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "domik"),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'gather')
            ),
        )
    ));

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Domik_Gmap extends WPBakeryShortCode {}
    }


    vc_map( array(
        "name" => __("Count Down", "gather"),
        "base" => "cth_countdown",
        "content_element" => true,
        "icon" => get_template_directory_uri() . "/vc_extend/cth-icon.png",
        "category"=>"Gather",
        "params" => array(
            array(
                "type" => "dropdown",
                "class"=>"",
                "holder"=>'span',
                "heading" => __('Date', 'gather'),
                "param_name" => "date",
                "value" => array(   
                                __('Date 01', 'gather') => '01',  
                                __('Date 02', 'gather') => '02',  
                                __('Date 03', 'gather') => '03',  
                                __('Date 04', 'gather') => '04',  
                                __('Date 05', 'gather') => '05',  
                                __('Date 06', 'gather') => '06',   
                                __('Date 07', 'gather') => '07',   
                                __('Date 08', 'gather') => '08',   
                                __('Date 09', 'gather') => '09',   
                                __('Date 10', 'gather') => '10',   
                                __('Date 11', 'gather') => '11',   
                                __('Date 12', 'gather') => '12',   
                                __('Date 13', 'gather') => '13',   
                                __('Date 14', 'gather') => '14',   
                                __('Date 15', 'gather') => '15',   
                                __('Date 16', 'gather') => '16',   
                                __('Date 17', 'gather') => '17',   
                                __('Date 18', 'gather') => '18',   
                                __('Date 19', 'gather') => '19',   
                                __('Date 20', 'gather') => '20',   
                                __('Date 21', 'gather') => '21',   
                                __('Date 22', 'gather') => '22',   
                                __('Date 23', 'gather') => '23',   
                                __('Date 24', 'gather') => '24',   
                                __('Date 25', 'gather') => '25',   
                                __('Date 26', 'gather') => '26',   
                                __('Date 27', 'gather') => '27',   
                                __('Date 28', 'gather') => '28',   
                                __('Date 29 (not all months)', 'gather') => '29',   
                                __('Date 30 (not all months)', 'gather') => '30',   
                                __('Date 31 (not all months)', 'gather') => '31',   
                                                                                                              
                            ),
                "description" => __("Set countdown date", 'gather'), 
            ),
            
            array(
                "type" => "dropdown",
                "class"=>"",
                "holder"=>'span',
                "heading" => __('Month', 'gather'),
                "param_name" => "month",
                "value" => array(   
                                __('January', 'gather') => 'January',  
                                __('February', 'gather') => 'February',  
                                __('March', 'gather') => 'March',  
                                __('April', 'gather') => 'April',  
                                __('May', 'gather') => 'May',  
                                __('June', 'gather') => 'June',   
                                __('July', 'gather') => 'July',   
                                __('August', 'gather') => 'August',   
                                __('September', 'gather') => 'September',   
                                __('October', 'gather') => 'October',   
                                __('November', 'gather') => 'November',   
                                __('December', 'gather') => 'December',   
                                                                                                              
                            ),
                "description" => __("Set countdown month", 'gather'), 
            ),
            array(
                "type" => "dropdown",
                "class"=>"",
                "holder"=>'span',
                "heading" => __('Year', 'gather'),
                "param_name" => "year",
                "value" => array(   
                                __('2015', 'gather') => '2015',  
                                __('2016', 'gather') => '2016',  
                                __('2017', 'gather') => '2017',  
                                __('2018', 'gather') => '2018',  
                                __('2019', 'gather') => '2019',  
                                __('2020', 'gather') => '2020',   
                                                                                                              
                            ),
                "description" => __("Set countdown year", 'gather'), 
            ),
            array(
                "type"      => "textfield",
                "class"     => "",
                "holder"=>'span',
                "heading"   => __("Time", 'gather'),
                "param_name"=> "time",
                "value"     => "09:00:00",
                "description" => __("Count down time (hh:mm:ss, for example: 09:00:00)", 'gather')
            ),
            array(
                "type"      => "textarea_html",
                "holder"    => "div",
                "class"     => "",
                "heading"   => __("Count Down Title", 'gather'),
                "param_name"=> "content",
                "value"     => '<h6 class="countdown_title text-center">EVENT WILL START IN</h6>',
                //"description" => __("Background Image, will display in mobile device", 'gather')
            ),
             
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "gather"),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "gather")
            ),
            
            
            
        )
    ));

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Cth_CountDown extends WPBakeryShortCode {     
        }
    }

    vc_map( array(
        "name" => __("Add to Calendar", "gather"),
        "base" => "cth_addtocalendar",
        "content_element" => true,
        "icon" => get_template_directory_uri() . "/vc_extend/cth-icon.png",
        "category"=>"Gather",
        "params" => array(
            array(
                "type"      => "textfield",
                "class"     => "",
                "holder"=>'div',
                "heading"   => __("Date and time of event start", 'gather'),
                "param_name"=> "event_start",
                "value"     => "2016-05-04 12:00:00",
                "description" => __("Date and time of event start (YYYY-MM-DD hh24:mm:ss)", 'gather')
            ),
            array(
                "type"      => "textfield",
                "class"     => "",
                "holder"=>'div',
                "heading"   => __("Date and time of event end", 'gather'),
                "param_name"=> "event_end",
                "value"     => "2016-05-04 18:00:00",
                "description" => __("Date and time of event end (YYYY-MM-DD hh24:mm:ss)", 'gather')
            ),
            array(
                "type"      => "textfield",
                "class"     => "",
                "holder"=>'div',
                "heading"   => __("Time zone name.", 'gather'),
                "param_name"=> "timezone",
                "value"     => "Europe/London",
                "description" => __("Time zone name. Visit <a href=\"http://addtocalendar.com\" target=\"_blank\">http://addtocalendar.com</a> -> Event data options tab. Example: Europe/London.", 'gather')
            ),
            array(
                "type"      => "textfield",
                "class"     => "",
                "holder"=>'div',
                "heading"   => __("Event Title", 'gather'),
                "param_name"=> "event_title",
                "value"     => "Gather Event Theme",
                "description" => __("Event Title", 'gather')
            ),
            array(
                "type"      => "textarea",
                "holder"    => "div",
                "class"     => "",
                "heading"   => __("Event Description", 'gather'),
                "param_name"=> "content",
                "value"     => 'Gather is a responsive event theme with many awesome features including add to my calendar feature. Awesome. huh?',
                //"description" => __("Background Image, will display in mobile device", 'gather')
            ),
            array(
                "type"      => "textfield",
                "class"     => "",
                "holder"=>'div',
                "heading"   => __("Location of the event.", 'gather'),
                "param_name"=> "location",
                "value"     => "tockholm, Sweden",
                "description" => __("Location of the event.", 'gather')
            ),
            array(
                "type"      => "textfield",
                "class"     => "",
                //"holder"=>'div',
                "heading"   => __("Organizer of the event.", 'gather'),
                "param_name"=> "organizer",
                "value"     => "",
                "description" => __("Organizer of the event.", 'gather')
            ),
            array(
                "type"      => "textfield",
                "class"     => "",
                //"holder"=>'div',
                "heading"   => __("Organizer email for contacts.", 'gather'),
                "param_name"=> "organizer_email",
                "value"     => "",
                "description" => __("Organizer email for contacts.", 'gather')
            ),
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "gather"),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "gather")
            ),
            
            
            
        )
    ));

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Cth_AddToCalendar extends WPBakeryShortCode {     
        }
    }

    vc_map( array(
        "name"      => __("Direction", 'gather'),
        "description" => __("Google direction",'gather'),
        "base"      => "cth_directions",
        "class"     => "",
        "icon" => get_template_directory_uri() . "/vc_extend/cth-icon.png",
        "category"  => 'Gather',
        //'admin_enqueue_css'=> get_template_directory_uri() . "/vc_extend/admin_style.css",

        "params"    => array(
            
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "domik"),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'gather')
            ),
        )
    ));

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Cth_Directions extends WPBakeryShortCode {}
    }

    vc_map( array(
        "name"      => __("MailChimp Subscribe", 'gather'),
        "description" => __("MailChimp Subscribe",'gather'),
        "base"      => "cth_mailchimp",
        "class"     => "",
        "icon" => get_template_directory_uri() . "/vc_extend/cth-icon.png",
        "category"  => 'Gather',
        // 'admin_enqueue_css'=> get_template_directory_uri() . "/vc_extend/admin_style.css",

        "params"    => array(


            array(
                "type"      => "textarea_html",
                "holder"    => "div",
                "class"     => "",
                "heading"   => __("Description", 'gather'),
                "param_name"=> "content",
                "value"     => '<h6 class="susbcribe-head wow fadeInLeft"> SUBSCRIBE <small>TO OUR NEWSLETTER</small></h6>',
                //"description" => __("Background Image, will display in mobile device", 'gather')
            ),
            
            array(
                "type"      => "textfield",
                "class"     => "",
                //"holder"=>'div',
                "heading"   => __("Success Message", 'gather'),
                "param_name"=> "success_msg",
                "value"     => "Almost finished. Please check your email and verify.",
                //"description" => __("Organizer email for contacts.", 'gather')
            ),
            array(
                "type"      => "textfield",
                "class"     => "",
                //"holder"=>'div',
                "heading"   => __("Error Message", 'gather'),
                "param_name"=> "error_msg",
                "value"     => "Oops. Something went wrong.",
                //"description" => __("Organizer email for contacts.", 'gather')
            ),
            array(
                "type" => "dropdown", 
                "class" => "", 
                "heading" => __('Layout', 'gather'), 
                "param_name" => "layout", 
                "value" => array(
                    __('Normal', 'gather') => 'normal', 
                    __('Home Header', 'gather') => 'header',
                    
                    
                ), 
                //"description" => __("When set this option to Modal you need a modal trigger button to get this form display.", 'gather'),
                "default" => 'normal',
            ), 
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "domik"),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'gather')
            ),
        )
    ));

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Cth_MailChimp extends WPBakeryShortCode {}
    }

    vc_map( array(
        "name"      => __("Our Sponsors", 'gather'),
        "description" => __("Our Sponsors",'gather'),
        "base"      => "cth_sponsors",
        "class"     => "",
        "icon" => get_template_directory_uri() . "/vc_extend/cth-icon.png",
        "category"  => 'Gather',
        //'admin_enqueue_css'=> get_template_directory_uri() . "/vc_extend/admin_style.css",
        "params"    => array(

            array(
                "type"      => "attach_images",
                "holder"    => "div",
                "class"     => "",
                "heading"   => __("Sponsors Images", 'gather'),
                "param_name"=> "sponsorsimgs",
                "description" => __("Sponsors Images", 'gather')
            ),

            array(
                "type"      => "textarea",
                //"holder"    => "div",
                "class"     => "",
                "heading"   => __("Slide Links", 'gather'),
                "param_name"=> "content",
                "value"     => '',
                "description" => __("Enter links for each slide (Note: divide links with linebreaks (Enter)).", 'gather')
            ),
            array(
                "type"      => "textfield",
                "class"     => "",
                //"holder"=>'div',
                "heading"   => __("Slides to show", 'gather'),
                "param_name"=> "slidestoshow",
                "value"     => "3",

                "description" => __("Number of slides which will display in viewport.", 'gather')
            ),
            array(
                "type" => "dropdown",
                //"class"=>"",
                "heading" => __('Show Navigation', 'gather'),
                "param_name" => "arrows",
                "value" => array(   
                                __('Yes', 'gather') => 'true',  
                                __('No', 'gather') => 'false', 
                                
                                                                                                               
                            ),
                //"description" => __("Set this to No to hide filter buttons bar.", "gather"), 
            ),
            array(
                "type" => "dropdown",
                //"class"=>"",
                "heading" => __('Show Pagination', 'gather'),
                "param_name" => "dots",
                "value" => array(   
                                __('No', 'gather') => 'false', 
                                __('Yes', 'gather') => 'true',  
                                                                                                               
                            ),
                //"description" => __("Set this to No to hide filter buttons bar.", "gather"), 
            ),
            array(
                "type" => "dropdown",
                //"class"=>"",
                "heading" => __('Use Center Mode', 'gather'),
                "param_name" => "centermode",
                "value" => array(   
                                __('No', 'gather') => 'false', 
                                __('Yes', 'gather') => 'true',  
                                                                                                               
                            ),
                //"description" => __("Set this to No to hide filter buttons bar.", "gather"), 
            ),
            array(
                "type" => "dropdown",
                //"class"=>"",
                "heading" => __('Auto Play', 'gather'),
                "param_name" => "autoplay",
                "value" => array(   
                                __('No', 'gather') => 'false', 
                                __('Yes', 'gather') => 'true',  
                                                                                                               
                            ),
                //"description" => __("Set this to No to hide filter buttons bar.", "gather"), 
            ),
            array(
                "type"      => "textfield",
                "class"     => "",
                //"holder"=>'div',
                "heading"   => __("Responsive Setting", 'gather'),
                "param_name"=> "responsive",
                "value"     => "768:3|480:1",

                "description" => __("Separated by a '|'. Format: viewport width and number of slides to show separated by a ':'. Example: 768:3|480:1", 'gather')
            ),
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "gather"),
                "param_name" => "el_class",
                "value"=>'wow bounceIn',
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'gather')
            ),
        )
    ));

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Cth_Sponsors extends WPBakeryShortCode {}
    }

    vc_map( array(
        "name"      => __("Our Speakers", 'gather'),
        "description" => __("Our Speakers",'gather'),
        "base"      => "cth_speakers",
        "category"  => 'Gather',
        "as_parent" => array('only' => 'cth_speakers_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        "content_element" => true,
        "show_settings_on_create" => false,
        "class"     => "cth_speakers",
        "icon" => get_template_directory_uri() . "/vc_extend/cth-icon.png",
        //'admin_enqueue_css'=> get_template_directory_uri() . "/vc_extend/admin_style.css",
        "params"    => array(
            array(
                "type"      => "textfield",
                "class"     => "",
                //"holder"=>'div',
                "heading"   => __("Slides to show", 'gather'),
                "param_name"=> "slidestoshow",
                "value"     => "6",

                "description" => __("Number of slides which will display in viewport.", 'gather')
            ),
            array(
                "type" => "dropdown",
                //"class"=>"",
                "heading" => __('Show Navigation', 'gather'),
                "param_name" => "arrows",
                "value" => array(   
                                __('Yes', 'gather') => 'true',  
                                __('No', 'gather') => 'false', 
                                
                                                                                                               
                            ),
                //"description" => __("Set this to No to hide filter buttons bar.", "gather"), 
            ),
            array(
                "type" => "dropdown",
                //"class"=>"",
                "heading" => __('Show Pagination', 'gather'),
                "param_name" => "dots",
                "value" => array(   
                                __('No', 'gather') => 'false', 
                                __('Yes', 'gather') => 'true',  
                                                                                                               
                            ),
                //"description" => __("Set this to No to hide filter buttons bar.", "gather"), 
            ),
            array(
                "type" => "dropdown",
                //"class"=>"",
                "heading" => __('Use Center Mode', 'gather'),
                "param_name" => "centermode",
                "value" => array(   
                                __('No', 'gather') => 'false', 
                                __('Yes', 'gather') => 'true',  
                                                                                                               
                            ),
                //"description" => __("Set this to No to hide filter buttons bar.", "gather"), 
            ),
            array(
                "type" => "dropdown",
                //"class"=>"",
                "heading" => __('Auto Play', 'gather'),
                "param_name" => "autoplay",
                "value" => array(   
                                __('No', 'gather') => 'false', 
                                __('Yes', 'gather') => 'true',  
                                                                                                               
                            ),
                //"description" => __("Set this to No to hide filter buttons bar.", "gather"), 
            ),
            array(
                "type"      => "textfield",
                "class"     => "",
                //"holder"=>'div',
                "heading"   => __("Responsive Setting", 'gather'),
                "param_name"=> "responsive",
                "value"     => "1200:5|992:3|520:1",

                "description" => __("Separated by a '|'. Format: viewport width and number of slides to show separated by a ':'. Example: 1200:5|992:3|520:1", 'gather')
            ),
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "gather"),
                "param_name" => "el_class",
                "value"=>'',
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'gather')
            ),
        ),
        "js_view" => 'VcColumnView'
    ));

    vc_map( array(
        "name" => __("Speaker Item", 'gather'),
        "base" => "cth_speakers_item",
        "content_element" => true,
        "icon" => get_template_directory_uri() . "/vc_extend/cth-icon.png",
        "as_child" => array('only' => 'cth_speakers'),
        "params" => array(
            
            array(
                "type"      => "attach_image",
                "holder"    => "div",
                "class"     => "",
                "heading"   => __("Speaker Avatar", 'gather'),
                "param_name"=> "speakeravatar",
                "description" => __("Speaker Avatar", 'gather')
            ),
            array(
                "type"      => "textfield",
                "class"     => "",
                "heading"   => __("Speaker Name", 'gather'),
                "param_name"=> "speakername",
                "value"     => "George Burton",
                // "description" => __("", 'gather')
            ),
            array(
                "type"      => "textfield",
                "class"     => "",
                "heading"   => __("Speaker Job", 'gather'),
                "param_name"=> "speakerjob",
                "value"     => "Flow Interactive",
                // "description" => __("", 'gather')
            ),
            array(
                "type"      => "textarea_html",
                "holder"    => "div",
                "class"     => "",
                "heading"   => __("Additional Info", 'gather'),
                "param_name"=> "content",
                "description" => __("Additional Info", 'gather')
            ), 
            array(
              "type" => "dropdown",
              "heading" => __('Use Animation', 'gather'),
              "param_name" => "animation",
              "value" => array(   
                                __('No', 'gather') => 'no',  
                                __('Yes', 'gather') => 'yes',                                                                                
                              ),
              "description" => __("Use animation effect or not", "gather"),      
            ),
            array(
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
              "description" => __("Add data effect", "gather"),      
            ),
            array(
                "type" => "textfield",
                "heading" => __('Animation Delay', 'gather'),
                "param_name" => "delay",
                "value" => "",
                "description" => __("Animation delay in second like 2s", "gather"),
            ),
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "gather"),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "gather")
            ),
        )
    ));
    
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_Cth_Speakers extends WPBakeryShortCodesContainer {}
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Cth_Speakers_Item extends WPBakeryShortCode {}
    }

    // featurebox_item
    if(function_exists('vc_map')){
       vc_map( array(
       "name"      => __("Feature Box", 'gather'),
       "description" => __("Feature Box with icon",'gather'),
       "base"      => "cth_featurebox",
       "class"     => "",
       "icon" => get_template_directory_uri() . "/vc_extend/cth-icon.png",
       "category"  => 'Gather',
       "params"    => array(
          
          array(
             "type"      => "textfield",
             "class"     => "",
             "heading"   => __("Icon", 'gather'),
             "param_name"=> "icon",
             "value"     => "icon-bubble-love-streamline-talk",
             "description" => __("Search icon : <a href='http://demo.web3canvas.com/themeforest/gather/streamline-icons.html' target='_blank'>StreamLine Icons</a>", 'gather')
          ),
          array(
             "type"      => "textfield",
             "holder"    => "div",
             "class"     => "",
             "heading"   => __("Title", 'gather'),
             "param_name"=> "title",
             "value"     => "One great night",
             "description" => __("Title display in featurebox.", 'gather')
          ),
          array(
             "type"      => "textarea_html",
             "holder"    => "div",
             "class"     => "",
             "heading"   => __("Content", 'gather'),
             "param_name"=> "content",
             "value"     => "<p class='no-rep'>We’re honoured to have 4 amazing industry experts Mike Kus, Jeremy Keith, Robin Christopherson and Sarah Parmenter!</p>",
             "description" => __("Content display in featurebox.", 'gather')
          ),
          // array(
          //    "type"      => "textfield",
          //    "class"     => "",
          //    "heading"   => __("Link", 'gather'),
          //    "param_name"=> "link",
          //    "value"     => "#",
          //    "description" => __("Link address to additional info.", 'gather')
          // ),
          array(
              "type" => "textfield",
              "heading" => __("Extra class name", "gather"),
              "param_name" => "el_class",
              "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "gather")
            ),
        )));
    }

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Cth_Featurebox extends WPBakeryShortCode {}
    }

    vc_map( array(
       "name"      => __("Twitter Widget", 'gather'),
       "description" => __("Embed Twitter status to your site",'gather'),
       "base"      => "cth_twitter_widget",
       "class"     => "",
       "icon" => get_template_directory_uri() . "/vc_extend/cth-icon.png",
       "category"  => 'Gather',
       "params"    => array(
          
          array(
             "type"      => "textfield",
             "class"     => "",
             "holder"    => "span",
             "heading"   => __("Status Link", 'gather'),
             "param_name"=> "statuslink",
             "value"     => "",
             "description" => __("Status link: https://twitter.com/ScottKellum/status/611220071587954688", 'gather')
          ),
          array(
              "type" => "dropdown",
              "heading" => __('Hide Card', 'gather'),
              "param_name" => "hidecard",
              "value" => array(   
                                __('Yes', 'gather') => 'yes',  
                                __('No', 'gather') => 'no',                                                                                
                                                                                                    
                              ),
              "description" => __("When set to Yes, links in a Tweet are not expanded to photo, video, or link previews.", "gather"),      
            ),
          array(
             "type"      => "textfield",
             "class"     => "",
             //"holder"    => "span",
             "heading"   => __("Language", 'gather'),
             "param_name"=> "lang",
             "value"     => "en",
             "description" => __('<a href="https://dev.twitter.com/overview/general/adding-international-support-to-your-apps" target="_blank">A supported Twitter language code</a>', 'gather')
          ),
          array(
             "type"      => "textfield",
             "class"     => "",
             //"holder"    => "span",
             "heading"   => __("Widget Width", 'gather'),
             "param_name"=> "width",
             "value"     => "550",
             "description" => __('The maximum width of the rendered Tweet in whole pixels. This value should be between 250 and 550 pixels.', 'gather')
          ),
          array(
              "type" => "dropdown",
              "heading" => __('Alignment', 'gather'),
              "param_name" => "align",
              "value" => array(   
                                __('Center', 'gather') => 'center',  
                                __('Left', 'gather') => 'left',                                                                                
                                __('Right', 'gather') => 'right',                                                                                
                              ),
              "description" => __("Float the Tweet left, right, or center relative to its container. Typically set to allow text or other content to wrap around the Tweet.", "gather"),      
            ),
          
          array(
              "type" => "textfield",
              "heading" => __("Extra class name", "gather"),
              "param_name" => "el_class",
              "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "gather")
            ),
        )));

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Cth_Twitter_Widget extends WPBakeryShortCode {}
    }

   vc_map( array(
       "name"      => __("Hotels Search", 'gather'),
       "description" => __("Map hotels which located near your event place.",'gather'),
       "base"      => "cth_hotel_search",
       "class"     => "",
       "icon" => get_template_directory_uri() . "/vc_extend/cth-icon.png",
       "category"  => 'Gather',
       "params"    => array(
          
          array(
                "type"      => "textfield",
                "class"     => "",
                "holder"     => "span",
                "heading"   => __("Event Address Latitude", 'gather'),
                "param_name"=> "latitude",
                "value"     => "59.3292956",
                "description" => __("Enter your address latitude. You can get your value from: <a href='http://www.gps-coordinates.net/' target='_blank'>http://www.gps-coordinates.net/</a>", 'gather')
            ),
            array(
                "type"      => "textfield",
                "class"     => "",
                "holder"     => "span",
                "heading"   => __("Event Address Longitude", 'gather'),
                "param_name"=> "longitude",
                "value"     => "18.0686451",
                "description" => __("Enter your address longitude. You can get your value from: <a href='http://www.gps-coordinates.net/' target='_blank'>http://www.gps-coordinates.net/</a>", 'gather')
            ),

            array(
                "type"      => "textfield",
                "class"     => "",
                //"holder"     => "span",
                "heading"   => __("Search Distance", 'gather'),
                "param_name"=> "distance",
                "value"     => "1500",
                "description" => __("Defines the distance (in meters) within which to return place results. The maximum allowed radius is 50 000 meters.", 'gather')
            ),
            array(
                "type"      => "textfield",
                "class"     => "",
                //"holder"     => "span",
                "heading"   => __("Search Types", 'gather'),
                "param_name"=> "types",
                "value"     => "lodging,restaurant",
                "description" => __("Restricts the results to places matching at least one of the specified types. Types should be separated with a comma (type1,type2,etc). <a href=\"https://developers.google.com/places/supported_types\" target=\"_blank\">Supported Types</a>", 'gather')
            ),
            
            
            array(
                "type"      => "textfield",
                "class"     => "",
                "holder"     => "span",
                "heading"   => __("Zoom", 'gather'),
                "param_name"=> "zoom",
                "value"     => "15",
                // "description" => __("", 'gather')
            ),
            array(
                "type"      => "textfield",
                "class"     => "",
                //"holder"     => "span",
                "heading"   => __("Map Height", 'gather'),
                "param_name"=> "mapheight",
                "value"     => "500",
                // "description" => __("", 'gather')
            ),
          
          array(
              "type" => "textfield",
              "heading" => __("Extra class name", "gather"),
              "param_name" => "el_class",
              "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "gather")
            ),
        )));

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Cth_Hotel_Search extends WPBakeryShortCode {}
    }

    vc_map( array(
       "name"      => __("Counter", 'gather'),
       "description" => __("Animated Counter",'gather'),
       "base"      => "cth_counter",
       "class"     => "",
       "icon" => get_template_directory_uri() . "/vc_extend/cth-icon.png",
       "category"  => 'Gather',
       "params"    => array(
            array(
                'type' => 'textfield',
                'param_name' => 'from_number',
                'heading' => __( 'From Number', 'gather' ),
                'description' => __( 'the number the element should start at', 'gather' ),
                "value"     => "0",
            ),
            array(
                'type' => 'textfield',
                'param_name' => 'to_number',
                "holder"=>'div',
                'heading' => __( 'Target Number', 'gather' ),
                'description' => __( 'the number the element should end at', 'gather' ),
                "value"     => "500",
            ),
            array(
                'type' => 'textfield',
                'param_name' => 'speed',
                'heading' => __( 'Speed', 'gather' ),
                'description' => __( 'how long it should take to count between the target numbers', 'gather' ),
                "value"     => "1000",
            ),
            array(
                "type" => "textfield",
                "heading" => __("Icon Class", "gather"),
                "param_name" => "icon_class",
                "value"     => "fa fa-magic",
                "description" => __("Search icon : <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>Awesome Icons</a>", 'gather')
            ),
            array(
                "type" => "textarea",
                "holder"=>'div',
                "heading" => __("Content", "gather"),
                "param_name" => "content",
                "description" => __("Content", "gather")
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Extra class name', 'gather' ),
                'param_name' => 'el_class',
                'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'gather' )
            )
            
            
        ),
    ));

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Cth_Counter extends WPBakeryShortCode {}
    }

    vc_map( array(
       "name"      => __("Testimonail Block", 'gather'),
       "description" => __("Old fashioned testimonial block instead of twitter",'gather'),
       "base"      => "cth_testimonial",
       "class"     => "",
       "icon" => get_template_directory_uri() . "/vc_extend/cth-icon.png",
       "category"  => 'Gather',
       "params"    => array(
            array(
                "type" => "textarea",
                "holder"=>'div',
                "heading" => __("Testimonail", "gather"),
                "param_name" => "content",
                "description" => __("Testimonail", "gather")
            ),
            array(
                "type"      => "attach_image",
                // "holder"    => "div",
                "class"     => "",
                "heading"   => __("Avatar", 'gather'),
                "param_name"=> "avatar",
                "description" => __("Avatar", 'gather')
            ),
            array(
                'type' => 'textfield',
                'param_name' => 'name',
                "holder"=>'div',
                'heading' => __( 'Name', 'gather' ),
                // 'description' => __( '', 'gather' ),
                "value"     => "Johnathan Doe",
            ),
            array(
                'type' => 'textfield',
                'param_name' => 'job',
                
                'heading' => __( 'Job', 'gather' ),
                // 'description' => __( '', 'gather' ),
                "value"     => "Event Manager at",
            ),
            array(
                'type' => 'textfield',
                'param_name' => 'company',
                'heading' => __( 'Company', 'gather' ),
                'description' => __( 'Company', 'gather' ),
                "value"     => "Event Inc",
            ),
            array(
                "type" => "textfield",
                "heading" => __("Company Website", "gather"),
                "param_name" => "com_web",
                "value"     => "",
                "description" => __("Company website", 'gather')
            ),
            
            array(
                'type' => 'textfield',
                'heading' => __( 'Extra class name', 'gather' ),
                'param_name' => 'el_class',
                'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'gather' )
            )
            
            
        ),
    ));

    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Cth_Testimonial extends WPBakeryShortCode {}
    }

    vc_map( array(
       "name"      => __("Latest Posts", 'gather'),
       "description" => __("Grid of latest posts",'gather'),
       "base"      => "cth_latest_posts",
       "class"     => "",
       "icon" => get_template_directory_uri() . "/vc_extend/cth-icon.png",
       "category"  => 'Gather',
       "params"    => array(
            array(
                "type"      => "textfield",
                "holder"    => "div",
                "class"     => "",
                "heading"   => __("Count", 'gather'),
                "param_name"=> "count",
                "value"     => "3",
                "description" => __("Number of posts to show", 'gather')
            ),
            array(
                "type" => "dropdown",
                "class"=>"",
                "heading" => __('Order by', 'gather'),
                "param_name" => "order_by",
                "value" => array(   
                    __('Date', 'gather') => 'date',  
                    __('ID', 'gather') => 'ID',  
                    __('Author', 'gather') => 'author',       
                    __('Title', 'gather') => 'title',  
                    __('Modified', 'gather') => 'modified',  
                ),
                "description" => __("Order by", 'gather'),  
                "default"=>'date',    
            ),
            array(
                "type" => "dropdown",
                "class"=>"",
                "heading" => __('Order', 'gather'),
                "param_name" => "order",
                "value" => array(   
                                __('Descending', 'gather') => 'DESC',
                                __('Ascending', 'gather') => 'ASC',  
                                                                                                                  
                                ),
                "description" => __("Order", 'gather'),      
            ),
            array(
                "type" => "textfield",
                "heading" => __("Or Enter Post IDs", "gather"),
                "param_name" => "ids",
                "description" => __("Enter post ids to show, separated by a comma.", "gather")
            ),
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "gather"),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "gather")
            ),
        )
    ));
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Cth_Latest_Posts extends WPBakeryShortCode {}
    }

    vc_map( array(
        "name"      => __("Carousel Slider", 'gather'),
        "description" => __("Carousel with slick slider plugin",'gather'),
        "base"      => "cth_slickslider",
        "category"  => 'Gather',
        "as_parent" => array('only' => 'cth_slickslider_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        "content_element" => true,
        "show_settings_on_create" => false,
        "class"     => "cth_slickslider",
        "icon" => get_template_directory_uri() . "/vc_extend/cth-icon.png",
        //'admin_enqueue_css'=> get_template_directory_uri() . "/vc_extend/admin_style.css",
        "params"    => array(
            array(
                "type"      => "textfield",
                "class"     => "",
                //"holder"=>'div',
                "heading"   => __("Slides to show", 'gather'),
                "param_name"=> "slidestoshow",
                "value"     => "6",

                "description" => __("Number of slides which will display in viewport.", 'gather')
            ),
            array(
                "type" => "dropdown",
                //"class"=>"",
                "heading" => __('Show Navigation', 'gather'),
                "param_name" => "arrows",
                "value" => array(   
                                __('Yes', 'gather') => 'true',  
                                __('No', 'gather') => 'false', 
                                
                                                                                                               
                            ),
                //"description" => __("Set this to No to hide filter buttons bar.", "gather"), 
            ),
            array(
                "type" => "dropdown",
                //"class"=>"",
                "heading" => __('Show Pagination', 'gather'),
                "param_name" => "dots",
                "value" => array(   
                                __('No', 'gather') => 'false', 
                                __('Yes', 'gather') => 'true',  
                                                                                                               
                            ),
                //"description" => __("Set this to No to hide filter buttons bar.", "gather"), 
            ),
            array(
                "type" => "dropdown",
                //"class"=>"",
                "heading" => __('Use Center Mode', 'gather'),
                "param_name" => "centermode",
                "value" => array(   
                                __('No', 'gather') => 'false', 
                                __('Yes', 'gather') => 'true',  
                                                                                                               
                            ),
                //"description" => __("Set this to No to hide filter buttons bar.", "gather"), 
            ),
            array(
                "type" => "dropdown",
                //"class"=>"",
                "heading" => __('Auto Play', 'gather'),
                "param_name" => "autoplay",
                "value" => array(   
                                __('No', 'gather') => 'false', 
                                __('Yes', 'gather') => 'true',  
                                                                                                               
                            ),
                //"description" => __("Set this to No to hide filter buttons bar.", "gather"), 
            ),
            array(
                "type"      => "textfield",
                "class"     => "",
                //"holder"=>'div',
                "heading"   => __("Responsive Setting", 'gather'),
                "param_name"=> "responsive",
                "value"     => "1200:5|992:3|520:1",

                "description" => __("Separated by a '|'. Format: viewport width and number of slides to show separated by a ':'. Example: 1200:5|992:3|520:1", 'gather')
            ),
            array(
              "type" => "dropdown",
              "heading" => __('Use Animation', 'gather'),
              "param_name" => "animation",
              "value" => array(   
                                __('No', 'gather') => 'no',  
                                __('Yes', 'gather') => 'yes',                                                                                
                              ),
              "description" => __("Use animation effect or not", "gather"),      
            ),
            array(
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
              "description" => __("Add data effect", "gather"),      
            ),
            array(
                "type" => "textfield",
                "heading" => __('Animation Delay', 'gather'),
                "param_name" => "delay",
                "value" => "",
                "description" => __("Animation delay in second like 2s", "gather"),
            ),
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "gather"),
                "param_name" => "el_class",
                "value"=>'',
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'gather')
            ),
        ),
        "js_view" => 'VcColumnView'
    ));

    vc_map( array(
        "name" => __("Slide Item", 'gather'),
        "base" => "cth_slickslider_item",
        "content_element" => true,
        "icon" => get_template_directory_uri() . "/vc_extend/cth-icon.png",
        "as_child" => array('only' => 'cth_slickslider'),
        "params" => array(
            
            array(
                "type"      => "attach_image",
                "holder"    => "div",
                "class"     => "",
                "heading"   => __("Image", 'gather'),
                "param_name"=> "slideimg",
                "description" => __("Slider image", 'gather')
            ),
            
            array(
                "type"      => "textarea_html",
                "holder"    => "div",
                "class"     => "",
                "heading"   => __("Caption", 'gather'),
                "param_name"=> "content",
                "description" => __("Caption", 'gather')
            ), 
            
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "gather"),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "gather")
            ),
        )
    ));
    
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_Cth_Slickslider extends WPBakeryShortCodesContainer {}
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Cth_Slickslider_Item extends WPBakeryShortCode {}
    }

    vc_map( array(
        "name" => __("Flexslider", "gather"),
        "description" => __("Slider using flexslider plugin",'gather'),
        "base" => "cth_flexslider",
        "category"  => 'Gather',
        "as_parent" => array('only' => 'cth_flexslider_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        "content_element" => true,
        "show_settings_on_create" => false,
        "class"=>'',
        "icon" => get_template_directory_uri() . "/vc_extend/cth-icon.png", // Simply pass url to your icon here
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => __("Auto Play", "gather"),
                "param_name" => "slideshow",
                "value" => array(   
                                __('Yes', 'gather') => 'true',  
                                __('No', 'gather') => 'false',                                                                                
                            ),
                "description" => __("Animate slider automatically?", "gather")
            ),
            array(
                "type" => "dropdown",
               // "class"=>"",
                "heading" => __('Animation Type', 'gather'),
                "param_name" => "animation",
                "value" => array(   
                                __('Fade', 'gather') => 'fade',  
                                __('Slide', 'gather') => 'slide',                                                                                
                            ),
                "description" => __("Select your animation type", "gather"), 
            ),
            array(
                "type" => "dropdown",
                //"class"=>"",
                "heading" => __('Direction', 'gather'),
                "param_name" => "direction",
                "value" => array(   
                                __('Horizontal', 'gather') => 'horizontal',  
                                __('Vertical', 'gather') => 'vertical',                                                                                
                            ),
                "description" => __("Select the sliding direction", "gather"), 
            ),
            array(
                "type" => "dropdown",
                "heading" => __("SmoothHeight", "domik"),
                "param_name" => "smoothheight",
                "value" => array(   
                                __('No', 'gather') => 'false',
                                __('Yes', 'gather') => 'true',  
                                                                                                                
                            ),
                "description" => __("Allow height of the slider to animate smoothly in horizontal mode", "gather")
            ),
            array(
                "type" => "textfield",
                "heading" => __("Slide Speed", "gather"),
                "param_name" => "slideshowspeed",
                "description" => __("Set the speed of the slideshow cycling, in milliseconds", "gather"),
                "value" => "7000"
            ),
            array(
                "type" => "dropdown",
                "heading" => __("controlNav", "gather"),
                "param_name" => "controlnav",
                "value" => array(   
                                
                                __('Yes', 'gather') => 'true',
                                __('No', 'gather') => 'false',  
                                                                                                                
                            ),
                "description" => __("Create navigation for paging control of each slide? Note: Leave true for manualControls usage", "gather")
            ),
            array(
                "type" => "dropdown",
                "heading" => __("directionNav", "gather"),
                "param_name" => "directionnav",
                "value" => array(   
                                
                                __('Yes', 'gather') => 'true',
                                __('No', 'gather') => 'false',  
                                                                                                                
                            ),
                "description" => __("Boolean: Create navigation for previous/next navigation?", "gather")
            ),
            // array(
            //     "type" => "dropdown",
            //     //"class"=>"",
            //     "heading" => __('Skin', 'gather'),
            //     "param_name" => "sliderskin",
            //     "value" => array(   
            //                     __('Default', 'gather') => 'default',  
            //                     __('Iphone', 'gather') => 'iphone',                                                                                
            //                     __('Macbook', 'gather') => 'macbook',                                                                                
            //                 ),
            //     //"default"=>'testimonial',
            //     "description" => __("Slider skin", "gather"), 
            // ),
            array(
                "type" => "textfield",
                "heading" => __("ID", "gather"),
                "param_name" => "el_id",
                "description" => __("Slider id", "gather")
            ),
            
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "gather"),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "gather")
            ),
            
        ),
        "js_view" => 'VcColumnView'
    ));

    vc_map( array(
        "name" => __("Slide Item", "gather"),
        "base" => "cth_flexslider_item",
        "content_element" => true,
        "icon" => get_template_directory_uri() . "/vc_extend/cth-icon.png",
        "as_child" => array('only' => 'cth_flexslider'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "gather"),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "gather")
            ),
            array(
                "type"      => "attach_image",
                "holder"    => "div",
                "class"     => "",
                "heading"   => __("Slide Image", 'gather'),
                "param_name"=> "slideimg",
                "description" => __("Slide Image", 'gather')
            ),
            array(
                "type" => "textarea_html",
                "heading" => __("Content", "gather"),
                "param_name" => "content",
                "description" => __("Content.", "gather")
            ),
  
        )
    ));

    //Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_Cth_Flexslider extends WPBakeryShortCodesContainer {}
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Cth_Flexslider_Item extends WPBakeryShortCode {
            
        }
    }

     vc_map( array(
            "name"      => __("Eventbrite Registration", 'gather'),
            "base"      => "cth_eventbrite",
            //"class"     => "",
            "icon" => get_template_directory_uri() . "/vc_extend/cth-icon.png",
            "category"=>"Gather",
            "params"    => array(

                array(
                    "type" => "textarea_raw_html", 
                    "heading" => __("Embed Code", "gather"), 
                    "param_name" => "content",
                    "holder"=>'div', 
                    "value" => '<iframe  src="http://eventbrite.com/tickets-external?eid=18380787430&amp;ref=etckt&amp;v=2" height="350"></iframe>',
                    "description" => __('Your eventbrite widget embed code.','gather')
                ), 

                array(
                    "type" => "dropdown", 
                    "class" => "", 
                    "heading" => __('Layout', 'gather'), 
                    "param_name" => "layout", 
                    "value" => array(
                        __('Modal', 'gather') => 'modal',
                        __('Normal', 'gather') => 'normal', 
                        
                    ), 
                    "description" => __("When set this option to Modal you need a modal trigger button to get this form display.", 'gather'),
                    "default" => 'normal',
                ), 
                
                array(
                    "type" => "textfield",
                    "heading" => __("Extra class name", "gather"),
                    "param_name" => "el_class",
                    "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "gather")
                ),

            )));


        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_Cth_Eventbrite extends WPBakeryShortCode {}
        }
    
}
?>