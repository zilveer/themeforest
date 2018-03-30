<?php
vc_map(array(
    "base" => "mk_contact_info",
    "name" => __("Contact Info", "mk_framework"),
    'icon' => 'icon-mk-contact-info vc_mk_element-icon',
    "category" => __('Social', 'mk_framework'),
    'description' => __( 'Adds Contact info details.', 'mk_framework' ),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "mk_framework"),
            "param_name" => "title",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Phone", "mk_framework"),
            "param_name" => "phone",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Fax", "mk_framework"),
            "param_name" => "fax",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Email", "mk_framework"),
            "param_name" => "email",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Address", "mk_framework"),
            "param_name" => "address",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Person", "mk_framework"),
            "param_name" => "person",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Company", "mk_framework"),
            "param_name" => "company",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Skype Username", "mk_framework"),
            "param_name" => "skype",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Website", "mk_framework"),
            "param_name" => "website",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.", "mk_framework")
        )
    )
));