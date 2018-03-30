<?php
vc_map(array(
    "name" => 'Google Map V3',
    "base" => "cs-extra-map",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CS Hero', 'wp_nuvo'),
    "description" => esc_html__('Map API V3 Unlimited Style', 'wp_nuvo'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => esc_html__('Title', 'wp_nuvo'),
            "param_name" => "title",
            "description" => esc_html__('Title of Map', 'wp_nuvo')
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Heading size", 'wp_nuvo'),
            "param_name" => "heading_size",
            "value" => array(
                "Heading 1" => "h1",
                "Heading 2" => "h2",
                "Heading 3" => "h3",
                "Heading 4" => "h4",
                "Heading 5" => "h5",
                "Heading 6" => "h6"
            ),
            "description" => 'Select your heading size for title.'
        ),
        array(
            "type" => "colorpicker",
            "heading" => esc_html__('Title Color', 'wp_nuvo'),
            "param_name" => "title_color",
            "description" => ''
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('API Key', 'wp_nuvo'),
            "param_name" => "api",
            "value" => '',
            "description" => esc_html__('Enter you api key of map, get key from (https://console.developers.google.com)', 'wp_nuvo')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Address', 'wp_nuvo'),
            "param_name" => "address",
            "value" => 'New York, United States',
            "description" => esc_html__('Enter address of Map', 'wp_nuvo')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Coordinate', 'wp_nuvo'),
            "param_name" => "coordinate",
            "value" => '',
            "description" => esc_html__('Enter coordinate of Map, format input (latitude, longitude)', 'wp_nuvo')
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__('Click Show Info window', 'wp_nuvo'),
            "param_name" => "infoclick",
            "value" => array(
                esc_html__("Yes, please", 'wp_nuvo') => true
            ),
            "description" => esc_html__('Click a marker and show info window (Default Show).', 'wp_nuvo')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Marker Coordinate', 'wp_nuvo'),
            "param_name" => "markercoordinate",
            "value" => '',
            "description" => esc_html__('Enter marker coordinate of Map, format input (latitude, longitude)', 'wp_nuvo')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Marker Title', 'wp_nuvo'),
            "param_name" => "markertitle",
            "value" => '',
            "description" => esc_html__('Enter Title Info windows for marker', 'wp_nuvo')
        ),
        array(
            "type" => "textarea",
            "heading" => esc_html__('Marker Description', 'wp_nuvo'),
            "param_name" => "markerdesc",
            "value" => '',
            "description" => esc_html__('Enter Description Info windows for marker', 'wp_nuvo')
        ),
        array(
            "type" => "attach_image",
            "heading" => esc_html__('Marker Icon', 'wp_nuvo'),
            "param_name" => "markericon",
            "value" => '',
            "description" => esc_html__('Select image icon for marker', 'wp_nuvo')
        ),
        array(
            "type" => "textarea_raw_html",
            "heading" => esc_html__('Marker List', 'wp_nuvo'),
            "param_name" => "markerlist",
            "value" => '',
            "description" => esc_html__('[{"coordinate":"41.058846,-73.539423","icon":"","title":"title demo 1","desc":"desc demo 1"},{"coordinate":"40.975699,-73.717636","icon":"","title":"title demo 2","desc":"desc demo 2"},{"coordinate":"41.082606,-73.469718","icon":"","title":"title demo 3","desc":"desc demo 3"}]', 'wp_nuvo')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Info Window Max Width', 'wp_nuvo'),
            "param_name" => "infowidth",
            "value" => '200',
            "description" => esc_html__('Set max width for info window', 'wp_nuvo')
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Map Type", 'wp_nuvo'),
            "param_name" => "type",
            "value" => array(
                "ROADMAP" => "ROADMAP",
                "HYBRID" => "HYBRID",
                "SATELLITE" => "SATELLITE",
                "TERRAIN" => "TERRAIN"
            ),
            "description" => esc_html__('Select the map type.', 'wp_nuvo')
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Style Template", 'wp_nuvo'),
            "param_name" => "style",
            "value" => array(
                "Default" => "",
                "Custom" => "custom",
                "Light Monochrome" => "light-monochrome",
                "Blue water" => "blue-water",
                "Midnight Commander" => "midnight-commander",
                "Paper" => "paper",
                "Red Hues" => "red-hues",
                "Hot Pink" => "hot-pink"
            ),
            "description" => 'Select your heading size for title.'
        ),
        array(
            "type" => "textarea_raw_html",
            "heading" => esc_html__('Custom Template', 'wp_nuvo'),
            "param_name" => "content",
            "value" => '',
            "description" => esc_html__('Get template from http://snazzymaps.com', 'wp_nuvo')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Zoom', 'wp_nuvo'),
            "param_name" => "zoom",
            "value" => '13',
            "description" => esc_html__('zoom level of map, default is 13', 'wp_nuvo')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Width', 'wp_nuvo'),
            "param_name" => "width",
            "value" => 'auto',
            "description" => esc_html__('Width of map without pixel, default is auto', 'wp_nuvo')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Height', 'wp_nuvo'),
            "param_name" => "height",
            "value" => '350px',
            "description" => esc_html__('Height of map without pixel, default is 350px', 'wp_nuvo')
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__('Scroll Wheel', 'wp_nuvo'),
            "param_name" => "scrollwheel",
            "value" => array(
                esc_html__("Yes, please", 'wp_nuvo') => true
            ),
            "description" => esc_html__('If false, disables scrollwheel zooming on the map. The scrollwheel is disable by default.', 'wp_nuvo')
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__('Pan Control', 'wp_nuvo'),
            "param_name" => "pancontrol",
            "value" => array(
                esc_html__("Yes, please", 'wp_nuvo') => true
            ),
            "description" => esc_html__('Show or hide Pan control.', 'wp_nuvo')
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__('Zoom Control', 'wp_nuvo'),
            "param_name" => "zoomcontrol",
            "value" => array(
                esc_html__("Yes, please", 'wp_nuvo') => true
            ),
            "description" => esc_html__('Show or hide Zoom Control.', 'wp_nuvo')
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__('Scale Control', 'wp_nuvo'),
            "param_name" => "scalecontrol",
            "value" => array(
                esc_html__("Yes, please", 'wp_nuvo') => true
            ),
            "description" => esc_html__('Show or hide Scale Control.', 'wp_nuvo')
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__('Map Type Control', 'wp_nuvo'),
            "param_name" => "maptypecontrol",
            "value" => array(
                esc_html__("Yes, please", 'wp_nuvo') => true
            ),
            "description" => esc_html__('Show or hide Map Type Control.', 'wp_nuvo')
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__('Street View Control', 'wp_nuvo'),
            "param_name" => "streetviewcontrol",
            "value" => array(
                esc_html__("Yes, please", 'wp_nuvo') => true
            ),
            "description" => esc_html__('Show or hide Street View Control.', 'wp_nuvo')
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__('Over View Map Control', 'wp_nuvo'),
            "param_name" => "overviewmapcontrol",
            "value" => array(
                esc_html__("Yes, please", 'wp_nuvo') => true
            ),
            "description" => esc_html__('Show or hide Over View Map Control.', 'wp_nuvo')
        )
    )
));