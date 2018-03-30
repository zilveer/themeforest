<?php
vc_map(array(
    "name" => __("Twitter Feeds", "mk_framework"),
    "base" => "vc_twitter",
    'icon' => 'icon-mk-twitter-feeds vc_mk_element-icon',
    'description' => __( 'Adds Twitter Feeds.', 'mk_framework' ),
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
            "heading" => __("Twitter name", "mk_framework"),
            "param_name" => "twitter_name",
            "value" => "",
            "description" => __("Type in twitter profile name from which load tweets.", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Tweets count", "mk_framework"),
            "param_name" => "tweets_count",
            "value" => "5",
            "min" => "1",
            "max" => "30",
            "step" => "1",
            "unit" => 'tweets',
            "description" => __("How many recent tweets to load.", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Text & Icon color", "mk_framework"),
            "param_name" => "text_color",
            "value" => "",
            "description" => __("You can set a color for text and icon color.", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Link Color", "mk_framework"),
            "param_name" => "link_color",
            "value" => "",
            "description" => __("You can change link color.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        ),
        array(
            'type' => 'item_id',
            'heading' => __( 'Item ID', 'mk_framework' ),
            'param_name' => "item_id"
        )
    )
));