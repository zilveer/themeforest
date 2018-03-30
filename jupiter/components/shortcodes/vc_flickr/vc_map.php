<?php
vc_map(array(
    "base" => "vc_flickr",
    "name" => __("Flickr Feeds", "mk_framework"),
    'icon' => 'icon-mk-flickr-feeds vc_mk_element-icon',
    'description' => __( 'Show your Flickr Feeds.', 'mk_framework' ),
    "category" => __('Social', 'mk_framework'),
    "params" => array(
       array(
               "type" => "textfield",
               "heading" => __("Widget Title", "mk_framework"),
               "param_name" => "title",
               "value" => "",
               "description" => __("", "mk_framework")
          ),
       array(
               "type" => "textfield",
               "heading" => __("Flickr API key", "mk_framework"),
               "param_name" => "api_key",
               "value" => "",
               "description" => __('You must fill this field in order to get this shortcode working. You can obtain your API key from <a href="http://www.flickr.com/services/api/misc.api_keys.html">Flickr The App Garden</a>.', "mk_framework")
          ),
          array(
               "type" => "textfield",
               "heading" => __("Flickr ID", "mk_framework"),
               "param_name" => "flickr_id",
               "value" => "",
               "description" => __('To find your flickID visit <a href="http://idgettr.com/" target="_blank">idGettr</a>.', "mk_framework")
          ),
          array(
               "type" => "range",
               "heading" => __("Number of photos", "mk_framework"),
               "param_name" => "count",
               "value" => "6",
               "min" => "1",
               "max" => "100",
               "step" => "1",
               "unit" => 'photos'
          ),
          array(
               "type" => "range",
               "heading" => __("How many photos in one row?", "mk_framework"),
               "param_name" => "column",
               "value" => "6",
               "min" => "1",
               "max" => "12",
               "step" => "1",
               "unit" => 'columns'
          ),
         /* 
          Removed in V5.0
         array(
               "type" => "dropdown",
               "heading" => __("Thumbnail Size", "mk_framework"),
               "param_name" => "thumb_size",
               "value" => array(
                    __("Small", "mk_framework") => "s",
                    __("Medium", "mk_framework") => "m",
                    __("Thumbnail", "mk_framework") => "t"
               ),
               "description" => __("Photo order", "mk_framework")
          ),
          array(
               "type" => "dropdown",
               "heading" => __("Type", "mk_framework"),
               "param_name" => "type",
               "value" => array(
                    __("User", "mk_framework") => "user",
                    __("Group", "mk_framework") => "group"
               ),
               "description" => __("Photo stream type", "mk_framework")
          ),
          array(
               "type" => "dropdown",
               "heading" => __("Display", "mk_framework"),
               "param_name" => "display",
               "value" => array(
                    __("Latest", "mk_framework") => "latest",
                    __("Random", "mk_framework") => "random"
               ),
               "description" => __("Photo order", "mk_framework")
          ),*/
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.", "mk_framework")
        )
    )
));