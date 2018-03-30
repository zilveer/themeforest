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
$insert_script = <<<HTML
	$("#theme-button-insert").click(function () {
		var win = window.dialogArguments || opener || parent || top;
		win.tb_remove();

		var type = $('#type').val();
		var color = $('#color').val();

		win.themeInsertIcon(type, color);
	});
HTML;
return array(
	"title" => __("Icon Font", "theme_admin"),
	"shortcode" => 'icon_font',
	"type" => 'enclosing',
	"init" => $init_script,
	"insert" => $insert_script,
	"options" => array(
		array(
			"name" => __("Type",'theme_admin'),
			"id" => "type",
			"default" => isset($_GET['type'])?$_GET['type']:'',
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => __("Color (Optional)&#x200E;",'theme_admin'),
			"id" => "color",
			"default" => isset($_GET['color'])?$_GET['color']:'',
			"type" => "color",
			"format" => "rgb",
		),
	),
	"custom" => '',
);