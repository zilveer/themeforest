<?php
$custom_script = <<<HTML
	var class_str='';
	if(attrs['class'].value){
		class_str=' class="'+attrs['class'].value+'"';
	}
	switch(attrs['type'].value){
		case 'info':
			return '[info'+class_str+']'+attrs['content'].value+'[/info]';
		case 'success':
			return '[success'+class_str+']'+attrs['content'].value+'[/success]';
		case 'error':
			return '[error'+class_str+']'+attrs['content'].value+'[/error]';
		case 'error_msg':
			return '[error_msg'+class_str+']'+attrs['content'].value+'[/error_msg]';
		case 'notice':
			return '[notice'+class_str+']'+attrs['content'].value+'[/notice]';
	}
HTML;
return array(
	"title" => __("Message Boxes", "theme_admin"),
	"shortcode" => 'message_box',
	"type" => 'custom',
	"options" => array(
		array(
			"name" => __("Type",'theme_admin'),
			"id" => "type",
			"default" => '',
			"options" => array(
				"info" => __("Info",'theme_admin'),
				"success" => __("Success",'theme_admin'),
				"error" => __("Error",'theme_admin'),
				"error_msg" => __("Error Msg",'theme_admin'),
				"notice" => __("Notice",'theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Content",'theme_admin'),
			"id" => "content",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" => __("Class (Optional)&#x200E;",'theme_admin'),
			"id" => "class",
			"default" => "",
			"type" => "text"
		),
	),
	"custom" => $custom_script,
);