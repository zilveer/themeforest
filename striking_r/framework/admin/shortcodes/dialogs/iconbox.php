<?php
theme_enqueue_icon_set();
$init_script = <<<HTML
	function format(state) {
		if (!state.id) return state.text; // optgroup
		return "<i class='icon-" + state.id.toLowerCase() + "'/> " + state.text;
	}
	jQuery('[name="icon"]').select2({
		width: '70%',
		formatResult: format,
		formatSelection: format,
		escapeMarkup: function(m) { return m; }
	});
HTML;
return array(
	"title" => __("Icon Box", "theme_admin"),
	"shortcode" => 'iconbox',
	"type" => 'enclosing',
	"init" => $init_script,
	"options" => array(
		array(
			"name" => __("Icon",'theme_admin'),
			"id" => "icon",
			"default" => '',
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" =>  __("Icon size (Optional)&#x200E;",'theme_admin'),
			"id" => "iconSize",
			"default" => 'default',
			"options" => array(
				"small" => __('small','theme_admin'),
				"default" => __('default','theme_admin'),
				"large" => __('large','theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Icon Color (Optional)&#x200E;",'theme_admin'),
			"id" => "iconColor",
			"default" => "",
			"format" => "hex",
			"type" => "color"
		),
		array(
			"name" => __("title",'theme_admin'),
			"id" => "title",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => __("Content",'theme_admin'),
			"id" => "content",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" =>  __("Type",'theme_admin'),
			"id" => "type",
			"default" => '',
			"options" => array(
				"inline" => __('inline','theme_admin'),
				"left" => __('left','theme_admin'),
				"center" => __('center','theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Class (Optional)&#x200E;",'theme_admin'),
			"id" => "class",
			"default" => "",
			"type" => "text"
		),
	),
	"custom" => '',
);