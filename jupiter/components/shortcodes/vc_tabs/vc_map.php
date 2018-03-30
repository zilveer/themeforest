<?php
$tab_id_1 = time() . '-1-' . rand(0, 100);
$tab_id_2 = time() . '-2-' . rand(0, 100);
vc_map(array(
    "name" => __("Tabs", "mk_framework") ,
    "base" => "vc_tabs",
    "show_settings_on_create" => false,
    "is_container" => true,
    'icon' => 'icon-mk-tabs vc_mk_element-icon',
    "category" => __('Content', 'mk_framework') ,
    'description' => __('Tabbed content', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "mk_framework") ,
            "param_name" => "heading_title",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework") ,
            "param_name" => "style",
            "value" => array(
                "Default" => "default",
                "Simple" => "simple"
            ) ,
            "description" => __("Please choose your tabs style", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Orientation", "mk_framework") ,
            "param_name" => "orientation",
            "value" => array(
                "Horizontal" => "horizental",
                "Vertical" => "vertical"
            ) ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'default'
                )
            ) ,
            "description" => __("Note : This option is only for deafult style", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Tab location", "mk_framework") ,
            "param_name" => "tab_location",
            "value" => array(
                "Left" => "left",
                "Right" => "right"
            ) ,
            "description" => __("Which side would you like the tabs list appear?", "mk_framework") ,
            "dependency" => array(
                'element' => "orientation",
                'value' => array(
                    'vertical'
                )
            )
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Mobile Friendly Tabs?", "mk_framework") ,
            "description" => __("If enabled tabs functionality will removed in mobile devices, each tab and its content will be inserted below each other.", "mk_framework") ,
            "param_name" => "responsive",
            "value" => array(
                "Yes please!" => "true",
                "No!" => "false"
            ) ,
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Container Background Color", "mk_framework") ,
            "param_name" => "container_bg_color",
            "value" => "#fff",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )
    ) ,
    "custom_markup" => '
  <div class="wpb_tabs_holder wpb_holder vc_container_for_children">
  <ul class="tabs_controls">
  </ul>
  %content%
  </div>',
    'default_content' => '
  [vc_tab title="' . __('Tab 1', 'mk_framework') . '" tab_id="' . $tab_id_1 . '"][/vc_tab]
  [vc_tab title="' . __('Tab 2', 'mk_framework') . '" tab_id="' . $tab_id_2 . '"][/vc_tab]
  ',
    "js_view" => 'VcTabsView'
));