<?php

$general_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_header_toolbar_section",
    "name" => __("General / Header Toolbar", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __("Toolbar Date", "mk_framework") ,
            "desc" => __("If you enable this option today's date will be displayed on header toolbar. make sure your hosting server date configurations works as expected otherwise you might need to fix in hosting settings.", "mk_framework") ,
            "id" => "enable_header_date",
            "default" => 'false',
            "type" => "toggle",
        ) ,
        
        array(
            "name" => __("Toolbar Tagline", "mk_framework") ,
            "desc" => __("Fill this area which represents your site slogan or an important message.", "mk_framework") ,
            "id" => "header_toolbar_tagline",
            "default" => "",
            "type" => "text",
        ) ,
        array(
            "name" => __("Phone Number", "mk_framework") ,
            "desc" => __("", "mk_framework") ,
            "id" => "header_toolbar_phone",
            "default" => "",
            "type" => "text",
        ) ,
        array(
            "name" => __("Email Address", "mk_framework") ,
            "desc" => __("", "mk_framework") ,
            "id" => "header_toolbar_email",
            "default" => "",
            "type" => "text",
        ) ,
        array(
            "name" => __("Show Login Form?", "mk_framework") ,
            "desc" => __("", "mk_framework") ,
            "id" => "header_toolbar_login",
            "default" => "true",
            "type" => "toggle",
        ) ,
        array(
            "name" => __("Show Mailchimp Subscribe Form?", "mk_framework") ,
            "desc" => __("", "mk_framework") ,
            "id" => "header_toolbar_subscribe",
            "default" => "false",
            "type" => "toggle",
        ) ,
        array(
            "name" => __("Mailchimp List Subscribe Form URL", "mk_framework") ,
            "desc" => __('Please read <a href="http://artbees.net/themes/docs/how-to-get-your-mailchimp-form-url/" target="_blank">this article for more infomation</a>', "mk_framework") ,
            "id" => "mailchimp_action_url",
            "default" => "",
            "rows" => 2,
            "type" => "text",
        ) ,
    ) ,
);