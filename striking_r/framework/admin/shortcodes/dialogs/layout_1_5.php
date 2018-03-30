<?php
$custom_script = <<<HTML
	if(attrs['column_1'].value == ''){
		attrs['column_1'].value = ' ';
	}
	if(attrs['column_2'].value == ''){
		attrs['column_2'].value = ' ';
	}
	return '\\n[one_sixth]'+attrs['column_1'].value+'[/one_sixth]\\n[five_sixth_last]'+attrs['column_2'].value+'[/five_sixth_last]\\n';
HTML;
return array(
	"title" => __("One Sixth - Five Sixth Columns Layout", "theme_admin"),
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
	),
	"custom" => $custom_script,
);