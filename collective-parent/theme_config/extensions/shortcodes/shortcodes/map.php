<?php
/**
 * Google map
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * title:
 * width: 590
 * height: 365
 * lat: 0
 * long: 0
 * zoom: 12
 * type: map1, map2, map3
 * address: e.g. Chicago
 * 
 * [map lat="41.887" long="-87.630" zoom="10" type="map1" title=""]
 * 
 * [map lat="41.887" long="-87.630" zoom="10" type="map2" title="Different MapType: <span>HYBRID</span>"]
 * 
 * [map height="500" lat="41.887" long="-87.630" zoom="3" type="map3" address="Chicago" title="Satellite <span>Map with Address</span>"]
 * 
 */

class TFUSE_Map_Shortcode {
    static $add_script;

    static function init() {

        $atts = array(
            'name' => __('Map','tfuse'),
            'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
            'category' => 10,
            'options' => array(
                array(
                    'name' => __('Width','tfuse'),
                    'desc' => __('Specifies the width of the map','tfuse'),
                    'id' => 'tf_shc_map_width',
                    'value' => '614',
                    'type' => 'text'
                ),
                array(
                    'name' => __('Height','tfuse'),
                    'desc' => __('Specifies the height of the map','tfuse'),
                    'id' => 'tf_shc_map_height',
                    'value' => '350',
                    'type' => 'text'
                ),
                array(
                    'name' => __('Latitude','tfuse'),
                    'desc' => __('Specifies the latitude of the map','tfuse'),
                    'id' => 'tf_shc_map_lat',
                    'value' => '41.881831',
                    'type' => 'text'
                ),
                array(
                    'name' => __('Longitude','tfuse'),
                    'desc' => __('Specifies the longitude of the map','tfuse'),
                    'id' => 'tf_shc_map_long',
                    'value' => '-87.629814',
                    'type' => 'text'
                ),
                array(
                    'name' => __('Zoom','tfuse'),
                    'desc' => __('Specifies the zooming of the map','tfuse'),
                    'id' => 'tf_shc_map_zoom',
                    'value' => '10',
                    'type' => 'text'
                ),
                array(
                    'name' => __('Type','tfuse'),
                    'desc' => __('Specifies the type of the map','tfuse'),
                    'id' => 'tf_shc_map_type',
                    'value' => '',
                    'options' => array(
                        'map1' => '1',
                        'map2' => '2',
                        'map3' => '3'
                    ),
                    'type' => 'select'
                ),
                array(
                    'name' => __('Title','tfuse'),
                    'desc' => __('Specifies the title of the map','tfuse'),
                    'id' => 'tf_shc_map_title',
                    'value' => '',
                    'type' => 'text'
                ),
                array(
                    'name' => __('Address','tfuse'),
                    'desc' => __('Specifies the address of the map','tfuse'),
                    'id' => 'tf_shc_map_address',
                    'value' => '',
                    'type' => 'text'
                )
            )
        );

        tf_add_shortcode('map', array(__CLASS__, 'handle_shortcode'), $atts);

        add_action('init', array(__CLASS__, 'register_script'));
        add_action('wp_footer', array(__CLASS__, 'print_script'));
    }

    static function register_script() {
        $template_directory = get_template_directory_uri();
        wp_register_script('maps.google.com', 'http://maps.google.com/maps/api/js?sensor=false', array('jquery'), '1.0', true);
        wp_register_script('jquery.gmap', $template_directory . '/js/jquery.gmap.min.js', array('jquery', 'maps.google.com'), '3.3.0', true);
    }

    static function print_script() {
        if (!self::$add_script)
            return;

        wp_enqueue_script('maps.google.com');
        wp_enqueue_script('jquery.gmap');
    }

    static function handle_shortcode($atts) {
        self::$add_script = true;

        extract(shortcode_atts(array('width' => 590, 'height' => 365, 'lat' => 0,'long' => 0, 'zoom' => 12, 'type' => '', 'address' => '', 'title' => ''), $atts));
        $return = '';
        $rand = rand(600, 700);
        $width = (int) $width;
        $height = (int) $height;

        if (!empty($title))
            $return = '<h2>' . $title . '</h2>';

        if ($type == 'map2') {
            $return .= '<script type="text/javascript">
                            var $j = jQuery.noConflict();
                            $j(window).load(function(){
                                $j("#map' . $rand . '").gMap({
                                    markers: [{
                                        latitude: ' . $lat . ',
                                        longitude: ' . $long . '}],
                                    maptype: google.maps.MapTypeId.HYBRID,
                                    zoom: ' . $zoom . '
                                    });
                            });
                        </script>';
        } elseif ($type == 'map3') {
            $return .= '<script type="text/javascript">
                            var $j = jQuery.noConflict();
                            $j(window).load(function(){
                                $j("#map' . $rand . '").gMap({
                                    markers: [{
                                        latitude: ' . $lat . ',
                                        longitude: ' . $long . ',
                                        html: "' . $address . '",
                                        title: "",
                                        popup: true}],
                                    zoom: ' . $zoom . '
                                    });
                            });
                        </script>';
        } else {
            $return .= '<script type="text/javascript">
                            var $j = jQuery.noConflict();
                            $j(window).load(function(){
                                $j("#map' . $rand . '").gMap({
                                    markers: [{
                                        latitude: ' . $lat . ',
                                        longitude: ' . $long . '}],
                                    zoom: ' . $zoom . '
                                    });
                            });
                        </script>';
        }

        $return .= '<div id="map' . $rand . '" class="map frame_box" style="width: ' . $width . 'px; height: ' . $height . 'px; border: 1px solid #ccc; overflow: hidden;"></div>';

        return $return;
    }

}

TFUSE_Map_Shortcode::init();