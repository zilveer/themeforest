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
	"title" => __("Milestone", "theme_admin"),
	"shortcode" => 'milestone',
	"type" => 'self-closing',
	"init" => $init_script,
	"options" => array(
		array(
			"name" => __("Number From (Optional)&#x200E;",'theme_admin'),
			"id" => "numberFrom",
			"default" => "",
			"type" => "text",
		),
		array(
			"name" => __("Number To",'theme_admin'),
			"id" => "number",
			"default" => "",
			"type" => "text",
		),
		array(
			"name" => __("Subject",'theme_admin'),
			"id" => "subject",
			"default" => "",
			"type" => "text",
		),
		array(
			"name" =>  __("Size",'theme_admin'),
			"id" => "size",
			"default" => 'default',
			"options" => array(
				"small" => __('small','theme_admin'),
				"default" => __('default','theme_admin'),
				"large" => __('large','theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Number Color (Optional)&#x200E;",'theme_admin'),
			"id" => "numberColor",
			"default" => "",
			"format" => "hex",
			"type" => "color"
		),
		array(
			"name" => __("Subject Color (Optional)&#x200E;",'theme_admin'),
			"id" => "subjectColor",
			"default" => "",
			"format" => "hex",
			"type" => "color"
		),
		array(
			"name" => __("Icon (Optional)&#x200E;",'theme_admin'),
			"id" => "icon",
			"default" => '',
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
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
			"name" => __("Animation Speed",'theme_admin'),
			"desc" => __("Define the duration of the animations.",'theme_admin'),
			"id" => "speed",
			"min" => "200",
			"max" => "5000",
			"step" => "100",
			'unit' => 'miliseconds',
			"default" => "1500",
			"type" => "range"
		),
	),
);
