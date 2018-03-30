<?php
vc_map(array(
    "name" => __("Event Countdown", "mk_framework") ,
    "base" => "mk_countdown",
    'icon' => 'icon-mk-event-countdown vc_mk_element-icon',
    'description' => __('Countdown module for your events.', 'mk_framework') ,
    "category" => __('General', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "mk_framework") ,
            "param_name" => "title",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Upcoming Event Date", "mk_framework") ,
            "param_name" => "date",
            "value" => "12/24/2016 12:00:00",
            "description" => __("Enter the due date for Event. eg : 12/24/2016 12:00:00 => month/day/year hour:minute:second", "mk_framework")
        ) ,
        array(
            "heading" => __("UTC Timezone", "mk_framework") ,
            "param_name" => "offset",
            "value" => array(
                "-12" => "-12",
                "-11" => "-11",
                "-10" => "-10",
                "-9" => "-9",
                "-8" => "-8",
                "-7" => "-7",
                "-6" => "-6",
                "-5" => "-5",
                "-4" => "-4",
                "-3" => "-3",
                "-2" => "-2",
                "-1" => "-1",
                "0" => "0",
                "+1" => "+1",
                "+2" => "+2",
                "+3" => "+3",
                "+4" => "+4",
                "+5" => "+5",
                "+6" => "+6",
                "+7" => "+7",
                "+8" => "+8",
                "+9" => "+9",
                "+10" => "+10",
                "+12" => "+12"
            ) ,
            "type" => "dropdown"
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.", "mk_framework")
        )
    )
));