<?php
if (is_plugin_active('revslider/revslider.php')) {
    global $wpdb;
    $rs         = $wpdb->get_results("
      SELECT id, title, alias
      FROM " . $wpdb->prefix . "revslider_sliders
      ORDER BY id ASC LIMIT 999
      ");
    $revsliders = array();
    if ($rs) {
        foreach ($rs as $slider) {
            $revsliders[$slider->title] = $slider->alias;
        }
    } else {
        $revsliders["No sliders found"] = 0;
    }
    vc_map(array(
        "name" => __("Revolution Slider", "mk_framework"),
        "base" => "mk_revslider",
        'icon' => 'icon-mk-image-slideshow vc_mk_element-icon',
        "category" => __('Slideshows', 'mk_framework'),
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => __("Select Slideshow", "mk_framework"),
                "param_name" => "id",
                'save_always' => true,
                "value" => $revsliders,
                "description" => __("", "mk_framework")
            ),
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "mk_framework"),
                "param_name" => "el_class",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
            )
        )
    ));
}