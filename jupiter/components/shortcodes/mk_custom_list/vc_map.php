<?php
	vc_map(array(
	    "name" => __("Custom List", "mk_framework") ,
	    "base" => "mk_custom_list",
	    "category" => __('Typography', 'mk_framework') ,
	    'icon' => 'icon-mk-custom-list vc_mk_element-icon',
	    'description' => __('Powerful list styles with icons.', 'mk_framework') ,
	    "params" => array(
	        array(
	            "type" => "textfield",
	            "heading" => __("List Title", "mk_framework") ,
	            "param_name" => "title",
	            "value" => "",
	            "description" => __("", "mk_framework")
	        ) ,
	        array(
	            "type" => "textarea_html",
	            "holder" => "div",
	            "heading" => __("Add your unordered list into this textarea. Allowed Tags : [ul][li][strong][i][em][u][b][a][small]", "mk_framework") ,
	            "param_name" => "content",
	            "value" => "<ul><li>List Item</li></ul>",
	            "description" => __("", "mk_framework")
	        ) ,
	        array(
	            "type" => "textfield",
	            "heading" => __("Add Icon Class Name  or Character Code", "mk_framework") ,
	            "param_name" => "style",
	            "value" => "f00c",
	            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the class name or icon Character code.", "mk_framework")
	        ) ,
	        array(
	            "type" => "colorpicker",
	            "heading" => __("Icons Color", "mk_framework") ,
	            "param_name" => "icon_color",
	            "value" => $skin_color,
	            "description" => __("", "mk_framework") ,
	            "group" => "Design",
	        ) ,
	        array(
	            "type" => "range",
	            "heading" => __("Margin Button", "mk_framework") ,
	            "param_name" => "margin_bottom",
	            "value" => "30",
	            "min" => "-30",
	            "max" => "500",
	            "step" => "1",
	            "unit" => 'px',
	            "description" => __("", "mk_framework") ,
	            "group" => "Design",
	        ) ,
	        array(
	            "type" => "dropdown",
	            "heading" => __("Align", "mk_framework") ,
	            "param_name" => "align",
	            "width" => 150,
	            "value" => array(
	                __('No Align', "mk_framework") => "none",
	                __('Left', "mk_framework") => "left",
	                __('Center', "mk_framework") => "center",
	                __('Right', "mk_framework") => "right"
	            ) ,
	            "description" => __("Please note that align left and right will make the shortcode to float, therefore in order to keep your page elements from wrapping into each other you should add a padding divider shortcode right after this shortcode.", "mk_framework") ,
	            "group" => "Design",
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