<?php

//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("WC Products", "themeum"),
		"base" => "recent_products",
		"description" => __("WC Products", "themeum"),
		"category" => __('Themeum', "themeum"),
		"params" => array(

			array(
				"type" => "textfield",
				"heading" => __("Products Per Page", "themeum"),
				"param_name" => "per_page",
				"value" => "12",
				),

			array(
				"type" => "textfield",
				"heading" => __("Columns", "themeum"),
				"param_name" => "columns"
				),

			)
		));
}
