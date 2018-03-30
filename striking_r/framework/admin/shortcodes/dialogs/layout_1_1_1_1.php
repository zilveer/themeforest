<?php
$custom_script = <<<HTML
	if(attrs['column_1'].value == ''){
		attrs['column_1'].value = ' ';
	}
	if(attrs['column_2'].value == ''){
		attrs['column_2'].value = ' ';
	}
	if(attrs['column_3'].value == ''){
		attrs['column_3'].value = ' ';
	}
	if(attrs['column_4'].value == ''){
		attrs['column_4'].value = ' ';
	}
	return '\\n[one_fourth]'+attrs['column_1'].value+'[/one_fourth]\\n[one_fourth]'+attrs['column_2'].value+'[/one_fourth]\\n[one_fourth]'+attrs['column_3'].value+'[/one_fourth]\\n[one_fourth_last]'+attrs['column_4'].value+'[/one_fourth_last]\\n';
HTML;
return array(
	"title" => __("Four Columns Layout", "theme_admin"),
	'contentOption' => 'column_1',
	"type" => 'custom',
	"options" => array(
		array(
			"name" => __("Column 1",'theme_admin'),
			"id" => "column_1",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" => __("Column 2",'theme_admin'),
			"id" => "column_2",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" => __("Column 3",'theme_admin'),
			"id" => "column_3",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" => __("Column 4",'theme_admin'),
			"id" => "column_4",
			"default" => "",
			"type" => "textarea"
		),
	),
	"custom" => $custom_script,
);