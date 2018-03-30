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
	"title" => __("Slogan", "theme_admin"),
	"shortcode" => 'slogan',
	"type" => 'enclosing',
	"init" => $init_script,
	"options" => array(
		array(
			"name" => __("Size",'theme_admin'),
			"id" => "size",
			"default" => 'medium',
			"options" => array(
				"small" => __("Small",'theme_admin'),
				"medium" => __("Medium",'theme_admin'),
				"large" => __("Large",'theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Slogan Content",'theme_admin'),
			"id" => "content",
			"default" => "",
			"type" => "textarea",
		),
		array(
			"name" => __("Button Text",'theme_admin'),
			"id" => "buttonText",
			"default" => "",
			"type" => "text",
		),
		array(
			"name" => __("Button Link (Optional)&#x200E;",'theme_admin'),
			"id" => "buttonLink",
			"default" => "",
			"type" => "text",
		),
		array(
			"name" => __("Button Link Target (Optional)&#x200E;",'theme_admin'),
			"id" => "buttonLinkTarget",
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
			"name" => __("Class (Optional)&#x200E;",'theme_admin'),
			"id" => "class",
			"default" => "",
			"type" => "text",
		),
		array(
			"name" => __("Content Color (Optional)&#x200E;",'theme_admin'),
			"id" => "color",
			"default" => "",
			"format" => "hex",
			"type" => "color"
		),
		array(
			"name" => __("Button Color (Optional)&#x200E;",'theme_admin'),
			"id" => "buttonColor",
			"default" => "",
			"prompt" => __("Choose one..",'theme_admin'),
			"options" => array(
				"black" => 'Black',
				"gray" => 'Gray',
				"white" => 'White',
				"red" => 'Red',
				"yellow" => 'Yellow',
				"blue" => 'Blue',
				"pink" => 'Pink',
				"green" => 'Green',
				"rosy" => 'Rosy',
				"orange" => 'Orange',
				"magenta" => 'Magenta',
			),
			"type" => "select",
		),
		array(
			"name" => __("Button Background Color (Optional)&#x200E;",'theme_admin'),
			"id" => "buttonBgColor",
			"default" => "",
			"type" => "color"
		),
		array(
			"name" => __("Button Text Color (Optional)&#x200E;",'theme_admin'),
			"id" => "buttonTextColor",
			"default" => "",
			"type" => "color"
		),
		array(
			"name" => __("Button Hover Background Color (Optional)&#x200E;",'theme_admin'),
			"id" => "buttonHoverBgColor",
			"default" => "",
			"type" => "color"
		),
		array(
			"name" => __("Button Hover Text Color (Optional)&#x200E;",'theme_admin'),
			"id" => "buttonHoverTextColor",
			"default" => "",
			"type" => "color"
		),
		array(
			"name" => __("Button Icon (Optional)&#x200E;",'theme_admin'),
			"id" => "buttonIcon",
			"default" => '',
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => __("Button Icon Color (Optional)&#x200E;",'theme_admin'),
			"id" => "buttonIconColor",
			"default" => "",
			"format" => "hex",
			"type" => "color"
		),
	),
);
