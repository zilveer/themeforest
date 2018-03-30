<?php

/*-----------------------------------------------------------------------------------*/
/*	Tab VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			vc_map(array(
				'name' => __('Tab', 'vivaco'),
				'base' => 'vc_tab',
				'allowed_container_element' => 'vc_row',
				'is_container' => true,
				'content_element' => false,
				'params' => array(
					array(
						'type' => 'tab_id',
						'heading' => __('Tab ID', 'vivaco'),
						'param_name' => "tab_id"
					),
					array(
						'type' => 'textfield',
						'heading' => __('Title', 'vivaco'),
						'param_name' => 'title'
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"heading" => __("Subtitle", "vivaco"),
						"param_name" => "subtitle",
						"value" => ""
					)
				),
				'js_view' => 'VcTabView'
			));
