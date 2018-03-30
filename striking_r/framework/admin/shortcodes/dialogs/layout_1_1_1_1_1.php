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
	if(attrs['column_5'].value == ''){
		attrs['column_5'].value = ' ';
	}
	return '\\n[one_fifth]'+attrs['column_1'].value+'[/one_fifth]\\n[one_fifth]'+attrs['column_2'].value+'[/one_fifth]\\n[one_fifth]'+attrs['column_3'].value+'[/one_fifth]\\n[one_fifth]'+attrs['column_4'].value+'[/one_fifth]\\n[one_fifth_last]'+attrs['column_5'].value+'[/one_fifth_last]\\n';
HTML;
return array(
	"title" => __("Five Columns Layout", "theme_admin"),
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
		array(
			"name" => __("Column 5",'theme_admin'),
			"id" => "column_5",
			"default" => "",
			"type" => "textarea"
		),
	),
	"custom" => $custom_script,
);