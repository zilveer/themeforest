<?php
return array(
	'name' => __('Vertical Blank Space', 'health-center') ,
	'value' => 'push',
	'options' => array(
		array(
			"name" => __("Height", 'health-center') ,
			"id" => "h",
			"default" => 30,
			'min' => -200,
			'max' => 200,
			"type" => "range",
		) ,
	) ,
);
