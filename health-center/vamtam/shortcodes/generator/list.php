<?php

return array(
	"name" => __("Styled List", 'health-center') ,
	"value" => "list",
	"options" => array(
		array(
			'name' => __('Style', 'health-center') ,
			'id' => 'style',
			'default' => '',
			'type' => 'icons',
		) ,
		array(
			"name" => __("Color", 'health-center') ,
			"id" => "color",
			"default" => "",
			"options" => array(
				'accent1' => __('Accent 1', 'health-center'),
				'accent2' => __('Accent 2', 'health-center'),
				'accent3' => __('Accent 3', 'health-center'),
				'accent4' => __('Accent 4', 'health-center'),
				'accent5' => __('Accent 5', 'health-center'),
				'accent6' => __('Accent 6', 'health-center'),
				'accent7' => __('Accent 7', 'health-center'),
				'accent8' => __('Accent 8', 'health-center'),
			) ,
			"type" => "select",
		) ,
		array(
			"name" => __("Content", 'health-center') ,
			"desc" => __("Please insert a valid HTML unordered list", 'health-center') ,
			"id" => "content",
			"default" => "<ul>
				<li>list item</li>
				<li>another item</li>
			</ul>",
			"type" => "textarea"
		) ,
	)
);