<?php
vc_map(array(
    "name" => __("Message Box", "mk_framework") ,
    "base" => "mk_message_box",
    'icon' => 'icon-mk-message-box vc_mk_element-icon',
    "category" => __('General', 'mk_framework') ,
    'description' => __('Message Box with multiple types.', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "heading" => __("Write your message inside the text box", "mk_framework") ,
            "param_name" => "content",
            "value" => __("", "mk_framework") ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Type", "mk_framework") ,
            "param_name" => "type",
            "value" => array(
                "Confirm" => "confirm-message",
                "Comment" => "comment-message",
                "Warning" => "warning-message",
                "Error" => "error-message",
                "Info" => "info-message"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));