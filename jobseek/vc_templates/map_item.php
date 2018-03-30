<?php
 
/* Map Item 
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('map_item')) {

    function map_item($atts, $content = null) {

        extract(shortcode_atts(array(
            'icon_url' => '',
            'title' => '',
            'lat' => '',
            'lng' => '',
            'subtitle' => '',
            'phone' => '',
            'address' => '',
            'email' => '',
            'web' => '',
            'content' => '',
            'open' => '',
        ), $atts));

        if (!empty($lat) and ! empty($lng)) {

            $image = wp_get_attachment_image_src($icon_url, 'full');

            $output = '
        mapMarkers.push(
                        {
                            "id": "' . $lat . '_' . $lng . '",
                            "lat": ' . $lat . ',
                            "lng": ' . $lng . ',
                            "icon": "custom",
                            "icon_url": "' . $image[0] . '",
                            "title": "' . $title . '"
                        }
                    );
        mapInfoWindows.push(
                        {
                            "marker_id": "' . $lat . '_' . $lng . '",
                            "title": "' . $title . '",
                            "subtitle": "' . $subtitle . '",
                            "phone": "' . $phone . '",
                            "address": "' . $address . '",
                            "email": "' . $email . '",
                            "web": "' . $web . '",
                            "content": "' . $content . '",
                            "open": 0
                        }
                    );';

            return $output;
        };
    }

}

add_shortcode('map_item', 'map_item');