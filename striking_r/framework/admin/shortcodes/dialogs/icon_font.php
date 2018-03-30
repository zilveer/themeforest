<?php
theme_enqueue_icon_set();
$init_script = <<<HTML
	function format(state) {
		if (!state.id) return state.text; // optgroup
		return "<i class='icon-" + state.id.toLowerCase() + "'/> " + state.text;
	}
	jQuery('[name="type"]').select2({
		width: '70%',
		formatResult: format,
		formatSelection: format,
		escapeMarkup: function(m) { return m; }
	});
HTML;
return array(
	"title" => __("Icon Font", "theme_admin"),
	"shortcode" => 'icon_font',
	"type" => 'self-closing',
	"init" => $init_script,
	"options" => array(
		array(
			"name" => __("Type",'theme_admin'),
			"id" => "type",
			"default" => '',
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => __("Link (Optional)&#x200E;",'theme_admin'),
			"id" => "link",
			"default" => "",
			"type" => "text",
		),
		array(
			"name" => __("Link Target (Optional)&#x200E;",'theme_admin'),
			"id" => "linkTarget",
			"default" => '',
			"prompt" => __("Choose one..",'theme_admin'),
			"options" => array(
				"_blank" => __('Load in a new window','theme_admin'),
				"_self" => __('Load in the same frame as it was clicked','theme_admin'),
				"_parent" => __('Load in the parent frameset','theme_admin'),
				"_top" => __('Load in the full body of the window','theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Color (Optional)&#x200E;",'theme_admin'),
			"id" => "color",
			"default" => "",
			"type" => "color",
			"format" => "hex",
		),
		array(
			"name" => __("Background Color (Optional)&#x200E;",'theme_admin'),
			"desc" => "",
			"id" => "bgColor",
			"default" => "",
			"type" => "color"
		),
		array(
			"name" => __("Border Color (Optional)&#x200E;",'theme_admin'),
			"desc" => "",
			"id" => "borderColor",
			"default" => "",
			"type" => "color"
		),
		array(
			"name" => __("Color Hover (Optional)&#x200E;",'theme_admin'),
			"id" => "hoverColor",
			"default" => "",
			"type" => "color",
			"format" => "hex",
		),
		array(
			"name" => __("Background Hover Color (Optional)&#x200E;",'theme_admin'),
			"desc" => "",
			"id" => "hoverBgColor",
			"default" => "",
			"type" => "color"
		),
		array(
			"name" => __("Border Hover Color (Optional)&#x200E;",'theme_admin'),
			"desc" => "",
			"id" => "hoverBorderColor",
			"default" => "",
			"type" => "color"
		),
		array(
			"name" => __("Size (Optional)&#x200E;",'theme_admin'),
			"id" => "size",
			"desc" => __("To increase the size of icons relative to its container.", 'theme_admin'),
			"default" => '',
			"options" => array(
				"" => 'none',
				"large" => 'Large',
				"2x" => '2x',
				"3x" => '3x',
				"4x" => '4x',
				"5x" => '5x',
			),
			"type" => "select",
		),
		array(
			"name" => __("Pull (Optional)&#x200E;",'theme_admin'),
			"id" => "pull",
			"default" => '',
			"options" => array(
				"" => 'none',
				"left" => 'Left',
				"right" => 'Right',
			),
			"type" => "select",
		),
		array(
			"name" => __("Border",'theme_admin'),
			"id"   => 'border',
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Border radius",'theme_admin'),
			"id" => "borderRadius",
			"default" => 'rounded',
			"options" => array(
				"rounded" => 'Rounded',
				"square" => 'Square',
				"circle" => 'Circle',
			),
			"type" => "select",
		),
		array (
			"name" => __("Padding",'theme_admin'),
			"id" => "padding",
			"default" => 0,
			"min" => 0,
			"max" => 1,
			"step" => "0.1",
			"type" => "range",
			'unit' => 'em'
		),
		array(
			"name" => __("Spin / Pulse",'theme_admin'),
			"desc" => __("If set icon will spin continuously or icon will spin in pulse mode.", 'theme_admin'),
			"id" => "spin",
			"default" => '',
			"options" => array(
				"" => 'No Spin',
				"true" => 'Spin',
				"pulse" => 'Pulse',
			),
			"type" => "select",
		),		
		
		array(
			"name" => __("Rotate (Optional)&#x200E;",'theme_admin'),
			"id" => "rotate",
			"default" => '',
			"options" => array(
				"" => 'none',
				"90" => '90',
				"180" => '180',
				"270" => '270',
				"horizontal" => 'Flip Horizontal',
				"vertical" => 'Flip vertical',
			),
			"type" => "select",
		),
	),
	"custom" => '',
);