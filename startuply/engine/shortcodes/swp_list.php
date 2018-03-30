<?php

/*-----------------------------------------------------------------------------------*/
/*	Icon List VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			vc_map(array(
				"name" => __("List", "vivaco"),
				"icon" => "icon-list",
				"description" => "List element with icon style",
				"base" => "vsc-list",
				"weight" => 15,
				"class" => "list_extended",
				"category" => __("Content", "vivaco"),
				"params" => array(
					array(
						"type" => "textarea_html",
						"holder" => "div",
						"class" => "",
						"heading" => __("List Rows", "vivaco"),
						"param_name" => "content",
						"value" => "<ul class=\"customlist\"><li>Lorem ipsum</li><li>Consectetur adipisicing</li><li>Ullamco laboris</li><li>Quis nostrud exercitation</li>",
						"description" => __("Create your list using the WordPress default functionality", "vivaco")
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Extra class name", "vivaco"),
						"param_name" => "el_class"
					),
				)
			));





/*-----------------------------------------------------------------------------------*/
/*	Icon List VC Render (Front-end)
/*-----------------------------------------------------------------------------------*/
function vsc_list_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'icon' => 'ok',
		'el_class' => ''
	), $atts));

	return '<div class="customlist list-icon-fa-' . $icon . ' ' . $el_class .'">' . do_shortcode($content) . '</div>';
}

add_shortcode('vsc-list', 'vsc_list_shortcode');
