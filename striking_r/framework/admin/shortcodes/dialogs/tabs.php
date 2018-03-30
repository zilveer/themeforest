<?php
theme_enqueue_icon_set();
$init_script = <<<HTML
	function format(state) {
		if (!state.id) return state.text; // optgroup
		return "<i class='icon-" + state.id.toLowerCase() + "'/> " + state.text;
	}
	jQuery('select[name^="icon_"]').select2({
		width: '70%',
		formatResult: format,
		formatSelection: format,
		escapeMarkup: function(m) { return m; }
	});
	jQuery('[name="number"]').on("change",function(){
		var tabs_number = jQuery(this).val();
		jQuery('.shortcode-item').each(function(i){
			if(i>(3+tabs_number*5)){
				jQuery(this).hide();
			}else{
				jQuery(this).show();
			}
		});
		var select=jQuery('[name="initialTab"]');
		var selectedOption = select.val();
		jQuery('option', select).remove();
		for (i=1;i<=tabs_number;i++){
			select.append(jQuery("<option></option>").attr("value",i).text(i)); 
		}
		if(!selectedOption){
			selectedOption = 1;
		}
		select.val(selectedOption);
	}).trigger("change");
HTML;
$custom_script = <<<HTML
	var type = attrs['type'].value;
	var number = attrs['number'].value;
	var history = attrs['history'].value;
	var initialTab = attrs['initialTab'].value;
	if(type == ''){
		type = 'tabs';
	}
	if(history == 'true'){
		history = ' history="true"';
	}else{
		history = '';
	}
	if(initialTab != 1){
		initialTab = ' initialTab="'+initialTab+'"';
	}else{
		initialTab = '';
	}
	var ret = '\\n['+type+history+initialTab+']\\n';
	var icon = '';
	var anchor = '';
	for(var i=1;i<=number;i++){
		if(attrs['tabs', 'icon_'+i].value){
			icon = ' icon="'+attrs['tabs', 'icon_'+i].value+'"';
			if(attrs['tabs', 'icon_color_'+i].value){
				icon += ' icon_color="'+attrs['tabs', 'icon_color_'+i].value+'"';
			}
		}else{
			icon = '';
		}
		if(attrs['tabs', 'anchor_'+i].value){
			anchor = ' anchor="'+attrs['tabs', 'anchor_'+i].value+'"';
		} else {
			anchor = '';
		}
		ret +='[tab title="'+attrs['tabs','title_'+i].value+'"'+anchor+icon+']\\n'+attrs['tabs','content_'+i].value+'\\n[/tab]\\n';
	}
	ret +='[/'+type+']\\n';
	return ret;
HTML;
return array(
	"title" => __("Tabs",'theme_admin'),
	"type" => 'custom',
	'contentOption' => 'content_1',
	"options" => array(
		array(
			"name" => __("Type",'theme_admin'),
			"id" => "type",
			"default" => 'tabs',
			"options" => array(
				"tabs" => __("Framed Tabs",'theme_admin'),
				"mini_tabs" => __("Mini Tabs",'theme_admin'),
				"vertical_tabs" => __("Vertical Tabs",'theme_admin'),
			),
			"type" => "select",
		),
		array (
			"name" => __("History (Optional)&#x200E;",'theme_admin'),
			"desc" => __("Enable this to get browser's back and forward buttons support.",'theme_admin'),
			"id" => "history",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Number of tabs",'theme_admin'),
			"id" => "number",
			"min" => "1",
			"max" => "8",
			"step" => "1",
			"default" => "2",
			"type" => "range"
		),
		array(
			"name" => __("Initial Tab",'theme_admin'),
			"id" => "initialTab",
			"desc" => __("Specifies the tab that is initially opened when the page loads.</br>When the history feature is enabled, this will not take effect.",'theme_admin'),
			"options" => array(),
			"default" => "1",
			"type" => "select"
		),
		array(
			"name" => sprintf(__("Tab %d Title",'theme_admin'),1),
			"id" => "title_1",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Tab %d Anchor Text (Optional)&#x200E;",'theme_admin'),1),
			"id" => "anchor_1",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Tab %d Title Icon (Optional)&#x200E;",'theme_admin'),1),
			"id" => "icon_1",
			"default" => "",
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => sprintf(__("Tab %d Title Icon Color (Optional)&#x200E;",'theme_admin'),1),
			"id" => "icon_color_1",
			"default" => "",
			"format" => "hex",
			"type" => "color",
		),
		array(
			"name" => sprintf(__("Tab %d Content",'theme_admin'),1),
			"id" => "content_1",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" =>  sprintf(__("Tab %d Title",'theme_admin'),2),
			"id" => "title_2",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Tab %d Anchor Text (Optional)&#x200E;",'theme_admin'),2),
			"id" => "anchor_2",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Tab %d Title Icon (Optional)&#x200E;",'theme_admin'),2),
			"id" => "icon_2",
			"default" => "",
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => sprintf(__("Tab %d Title Icon Color (Optional)&#x200E;",'theme_admin'),2),
			"id" => "icon_color_2",
			"default" => "",
			"format" => "hex",
			"type" => "color",
		),
		array(
			"name" => sprintf(__("Tab %d Content",'theme_admin'),2),
			"id" => "content_2",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" =>  sprintf(__("Tab %d Title",'theme_admin'),3),
			"id" => "title_3",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Tab %d Anchor Text (Optional)&#x200E;",'theme_admin'),3),
			"id" => "anchor_3",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Tab %d Title Icon (Optional)&#x200E;",'theme_admin'),3),
			"id" => "icon_3",
			"default" => "",
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => sprintf(__("Tab %d Title Icon Color (Optional)&#x200E;",'theme_admin'),3),
			"id" => "icon_color_3",
			"default" => "",
			"format" => "hex",
			"type" => "color",
		),
		array(
			"name" => sprintf(__("Tab %d Content",'theme_admin'),3),
			"id" => "content_3",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" =>  sprintf(__("Tab %d Title",'theme_admin'),4),
			"id" => "title_4",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Tab %d Anchor Text (Optional)&#x200E;",'theme_admin'),4),
			"id" => "anchor_4",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Tab %d Title Icon (Optional)&#x200E;",'theme_admin'),4),
			"id" => "icon_4",
			"default" => "",
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => sprintf(__("Tab %d Title Icon Color (Optional)&#x200E;",'theme_admin'),4),
			"id" => "icon_color_4",
			"default" => "",
			"format" => "hex",
			"type" => "color",
		),
		array(
			"name" => sprintf(__("Tab %d Content",'theme_admin'),4),
			"id" => "content_4",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" =>  sprintf(__("Tab %d Title",'theme_admin'),5),
			"id" => "title_5",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Tab %d Anchor Text (Optional)&#x200E;",'theme_admin'),5),
			"id" => "anchor_5",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Tab %d Title Icon (Optional)&#x200E;",'theme_admin'),5),
			"id" => "icon_5",
			"default" => "",
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => sprintf(__("Tab %d Title Icon Color (Optional)&#x200E;",'theme_admin'),5),
			"id" => "icon_color_5",
			"default" => "",
			"format" => "hex",
			"type" => "color",
		),
		array(
			"name" => sprintf(__("Tab %d Content",'theme_admin'),5),
			"id" => "content_5",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" => sprintf(__("Tab %d Title",'theme_admin'),6),
			"id" => "title_6",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Tab %d Anchor Text (Optional)&#x200E;",'theme_admin'),6),
			"id" => "anchor_6",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Tab %d Title Icon (Optional)&#x200E;",'theme_admin'),6),
			"id" => "icon_6",
			"default" => "",
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => sprintf(__("Tab %d Title Icon Color (Optional)&#x200E;",'theme_admin'),6),
			"id" => "icon_color_6",
			"default" => "",
			"format" => "hex",
			"type" => "color",
		),
		array(
			"name" => sprintf(__("Tab %d Content",'theme_admin'),6),
			"id" => "content_6",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" =>  sprintf(__("Tab %d Title",'theme_admin'),7),
			"id" => "title_7",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Tab %d Anchor Text (Optional)&#x200E;",'theme_admin'),7),
			"id" => "anchor_7",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Tab %d Title Icon (Optional)&#x200E;",'theme_admin'),7),
			"id" => "icon_7",
			"default" => "",
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => sprintf(__("Tab %d Title Icon Color (Optional)&#x200E;",'theme_admin'),7),
			"id" => "icon_color_7",
			"default" => "",
			"format" => "hex",
			"type" => "color",
		),
		array(
			"name" => sprintf(__("Tab %d Content",'theme_admin'),7),
			"id" => "content_7",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" =>  sprintf(__("Tab %d Title",'theme_admin'),8),
			"id" => "title_8",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Tab %d Anchor Text (Optional)&#x200E;",'theme_admin'),8),
			"id" => "anchor_8",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Tab %d Title Icon (Optional)&#x200E;",'theme_admin'),8),
			"id" => "icon_8",
			"default" => "",
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => sprintf(__("Tab %d Title Icon Color (Optional)&#x200E;",'theme_admin'),8),
			"id" => "icon_color_8",
			"default" => "",
			"format" => "hex",
			"type" => "color",
		),
		array(
			"name" => sprintf(__("Tab %d Content",'theme_admin'),8),
			"id" => "content_8",
			"default" => "",
			"type" => "textarea"
		),
	),
	"custom" => $custom_script,
	"init" => $init_script,
);
