<?php
vc_map(array(
    "name" => __("Accordion", "mk_framework") ,
    "base" => "vc_accordions",
    "show_settings_on_create" => false,
    "is_container" => true,
    'icon' => 'icon-mk-accordion vc_mk_element-icon',
    'description' => __('Collapsible content panels', 'mk_framework') ,
    "category" => __('Content', 'mk_framework') ,
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
            "width" => 150,
            "value" => array(
                __('Fancy', "mk_framework") => "fancy-style",
                __('Simple', "mk_framework") => "simple-style"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Action Style", "mk_framework") ,
            "param_name" => "action_style",
            "width" => 400,
            "value" => array(
                __('One Toggle Open At A Time', "mk_framework") => "accordion-action",
                __('Multiple Toggles Open At A Time', "mk_framework") => "toggle-action"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Initial Index", "mk_framework") ,
            "param_name" => "open_toggle",
            "value" => "0",
            "min" => "-1",
            "max" => "50",
            "step" => "1",
            "unit" => 'index',
            "description" => __("Specify which toggle to be open by default when The page loads. please note that this value is zero based therefore zero is the first item. this option works when you have chosen [One Toggle Open At A Time] option from above setting. -1 will close all accordions on page load.", "mk_framework") ,
            "dependency" => array(
                "element" => "action_style",
                "value" => array(
                    "accordion-action"
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Container Background Color", "mk_framework") ,
            "param_name" => "container_bg_color",
            "value" => "#fff",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Mobile Friendly Accordions?", "mk_framework") ,
            "description" => __("If enabled accordion functionality will removed in mobile devices, each toggle and its content will be inserted below each other.", "mk_framework") ,
            "param_name" => "responsive",
            "value" => array(
                "Yes please!" => "true",
                "No!" => "false"
            ) ,
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )
    ) ,
    "custom_markup" => '
  <div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
  %content%
  </div>
  <div class="tab_controls">
  <a class="add_tab" title="' . __('Add section', 'mk_framework') . '"><span class="vc_icon"></span> <span class="tab-label">' . __('Add section', 'mk_framework') . '</span></a>
  </div>
  ',
    'default_content' => '
  [vc_accordion_tab title="' . __('Section 1', "mk_framework") . '"][/vc_accordion_tab]
  [vc_accordion_tab title="' . __('Section 2', "mk_framework") . '"][/vc_accordion_tab]
  ',
    'js_view' => 'VcAccordionView'
));
