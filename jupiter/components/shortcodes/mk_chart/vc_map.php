<?php
	vc_map(array(
	    "name" => __("Chart", "mk_framework") ,
	    "base" => "mk_chart",
	    "category" => __('General', 'mk_framework') ,
	    'icon' => 'icon-mk-chart vc_mk_element-icon',
	    'description' => __('Powerful & versatile Chart element.', 'mk_framework') ,
	    "params" => array(
	        array(
	            "type" => "range",
	            "heading" => __("Percent", "mk_framework") ,
	            "param_name" => "percent",
	            "value" => "50",
	            "min" => "0",
	            "max" => "100",
	            "step" => "1",
	            "unit" => '%',
	            "description" => __("", "mk_framework")
	        ) ,
	        array(
	            "type" => "colorpicker",
	            "heading" => __("Bar Color", "mk_framework") ,
	            "param_name" => "bar_color",
	            "value" => $skin_color,
	            "description" => __("The color of the circular bar.", "mk_framework")
	        ) ,
	        array(
	            "type" => "colorpicker",
	            "heading" => __("Track Color", "mk_framework") ,
	            "param_name" => "track_color",
	            "value" => "#ececec",
	            "description" => __("The color of the track for the bar.", "mk_framework")
	        ) ,
	        array(
	            "type" => "range",
	            "heading" => __("Line Width", "mk_framework") ,
	            "param_name" => "line_width",
	            "value" => "10",
	            "min" => "1",
	            "max" => "20",
	            "step" => "1",
	            "unit" => 'px',
	            "description" => __("The bar stroke thickness", "mk_framework")
	        ) ,
	        array(
	            "type" => "range",
	            "heading" => __("Bar Size", "mk_framework") ,
	            "param_name" => "bar_size",
	            "value" => "150",
	            "min" => "1",
	            "max" => "500",
	            "step" => "1",
	            "unit" => 'px',
	            "description" => __("The Diameter of the bar.", "mk_framework")
	        ) ,
	        array(
	            "type" => "dropdown",
	            "heading" => __("Content inside the chart", "mk_framework") ,
	            "param_name" => "content_type",
	            "width" => 200,
	            "value" => array(
	                "Percentage" => "percent",
	                "Icon" => "icon",
	                "Custom Text" => "custom_text"
	            ) ,
	            "description" => __("The content inside the circular bar.", "mk_framework")
	        ) ,
	        array(
	            "type" => "textfield",
	            "heading" => __("Add Icon Class Name", "mk_framework") ,
	            "param_name" => "icon",
	            "value" => "",
	            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework") ,
	            "dependency" => array(
	                'element' => "content_type",
	                'value' => 'icon'
	            )
	        ) ,
	        array(
	            "type" => "range",
	            "heading" => __("Icon Size", "mk_framework") ,
	            "param_name" => "icon_size",
	            "value" => "32",
	            "min" => "1",
	            "max" => "200",
	            "step" => "1",
	            "unit" => 'px',
	            "description" => __("", "mk_framework") ,
	            "dependency" => array(
	                'element' => "content_type",
	                'value' => 'icon'
	            )
	        ) ,
	        array(
	            "type" => "colorpicker",
	            "heading" => __("Icon Color", "mk_framework") ,
	            "param_name" => "icon_color",
	            "value" => "#444",
	            "description" => __("", "mk_framework") ,
	            "dependency" => array(
	                'element' => "content_type",
	                'value' => 'icon'
	            )
	        ) ,

	        array(
	            "type" => "textfield",
	            "heading" => __("Custom Text", "mk_framework") ,
	            "param_name" => "custom_text",
	            "value" => "",
	            "description" => __("This will appear inside the circular chart.", "mk_framework") ,
	            "dependency" => array(
	                'element' => "content_type",
	                'value' => 'custom_text'
	            )
	        ) ,
	         array(
	            "type" => "range",
	            "heading" => __("Custom Text Size", "mk_framework") ,
	            "param_name" => "custom_text_size",
	            "value" => "15",
	            "min" => "10",
	            "max" => "50",
	            "step" => "1",
	            "unit" => 'px',
	            "description" => __("", "mk_framework") ,
	            "dependency" => array(
	                'element' => "content_type",
	                'value' => 'custom_text'
	            )
	        ) ,
	        array(
	            "type" => "range",
	            "heading" => __("Percentage Text Size", "mk_framework") ,
	            "param_name" => "percentage_text_size",
	            "value" => "15",
	            "min" => "10",
	            "max" => "100",
	            "step" => "1",
	            "unit" => 'px',
	            "description" => __("", "mk_framework") ,
	            "dependency" => array(
	                'element' => "content_type",
	                'value' => 'percent'
	            )
	        ) ,
	        array(
	            "type" => "colorpicker",
	            "heading" => __("Percentage Text Color", "mk_framework") ,
	            "param_name" => "percentage_color",
	            "value" => "#444",
	            "description" => __("", "mk_framework") ,
	            "dependency" => array(
	                'element' => "content_type",
	                'value' => 'percent'
	            )
	        ) ,
	        array(
	            "type" => "textfield",
	            "heading" => __("Description", "mk_framework") ,
	            "param_name" => "desc",
	            "value" => "",
	            "description" => __("Description will appear below each chart.", "mk_framework")
	        ) ,
	        array(
	            "type" => "range",
	            "heading" => __("Description Text Size", "mk_framework") ,
	            "param_name" => "desc_text_size",
	            "value" => "15",
	            "min" => "10",
	            "max" => "100",
	            "step" => "1",
	            "unit" => 'px',
	            "description" => __("", "mk_framework")
	        ) ,
	        array(
	            "type" => "colorpicker",
	            "heading" => __("Description Text Color", "mk_framework") ,
	            "param_name" => "desc_color",
	            "value" => "#444",
	            "description" => __("", "mk_framework")
	        ) ,
	        $add_css_animations,
	        array(
	            "type" => "textfield",
	            "heading" => __("Extra class name", "mk_framework") ,
	            "param_name" => "el_class",
	            "value" => "",
	            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
	        )
	    )
	));