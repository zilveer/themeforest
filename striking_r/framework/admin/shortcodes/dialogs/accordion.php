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
		var accordion_number = jQuery(this).val();
		jQuery('.shortcode-item').each(function(i){
			if(i>(1+accordion_number*4)){
				jQuery(this).hide();
			}else{
				jQuery(this).show();
			}
		});
		var select=jQuery('[name="initialAccordion"]');
		var selectedOption = select.val();
		jQuery('option', select).remove();
		for (i=0;i<=accordion_number;i++){
			select.append(jQuery("<option></option>").attr("value",i).text(i)); 
		}
		if(!selectedOption){
			selectedOption = 1;
		}
		select.val(selectedOption);
	}).trigger("change");
HTML;
$custom_script = <<<HTML
	var number = attrs['number'].value;
	var initialAccordion = attrs['initialAccordion'].value;
	if(initialAccordion != 1){
		initialAccordion = ' initialAccordion="'+initialAccordion+'"';
	}else{
		initialAccordion = '';
	}
	var ret = '\\n[accordions'+initialAccordion+']\\n';
	var icon = '';
	for(var i=1;i<=number;i++){
		if(attrs['tabs', 'icon_'+i].value){
			icon = ' icon="'+attrs['tabs', 'icon_'+i].value+'"';
			if(attrs['tabs', 'icon_color_'+i].value){
				icon += ' icon_color="'+attrs['tabs', 'icon_color_'+i].value+'"';
			}
		}else{
			icon = '';
		}
		ret +='[accordion title="'+attrs['tabs','title_'+i].value+'"'+icon+']\\n'+attrs['tabs','content_'+i].value+'\\n[/accordion]\\n';
	}
	ret +='[/accordions]\\n';
	return ret;
HTML;
return array(
	"title" => __("Accordion",'theme_admin'),
	"type" => 'custom',
	'contentOption' => 'content_1',
	"options" => array(
		array(
			"name" => __("Number of pans",'theme_admin'),
			"id" => "number",
			"min" => "1",
			"max" => "8",
			"step" => "1",
			"default" => "2",
			"type" => "range"
		),
		array(
			"name" => __("Initial Accordion",'theme_admin'),
			"id" => "initialAccordion",
			"desc" => __("Specifies the tab that is initially opened when the page loads.",'theme_admin'),
			"options" => array(),
			"default" => "1",
			"type" => "select"
		),
		array(
			"name" => sprintf(__("Accordion %d Title",'theme_admin'),1),
			"id" => "title_1",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Accordion %d Title Icon (Optional)&#x200E;",'theme_admin'),1),
			"id" => "icon_1",
			"default" => "",
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => sprintf(__("Accordion %d Title Icon Color (Optional)&#x200E;",'theme_admin'),1),
			"id" => "icon_color_1",
			"default" => "",
			"format" => "hex",
			"type" => "color",
		),
		array(
			"name" => sprintf(__("Accordion %d Content",'theme_admin'),1),
			"id" => "content_1",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" => sprintf(__("Accordion %d Title",'theme_admin'),2),
			"id" => "title_2",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Accordion %d Title Icon (Optional)&#x200E;",'theme_admin'),2),
			"id" => "icon_2",
			"default" => "",
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => sprintf(__("Accordion %d Title Icon Color (Optional)&#x200E;",'theme_admin'),2),
			"id" => "icon_color_2",
			"default" => "",
			"format" => "hex",
			"type" => "color",
		),
		array(
			"name" => sprintf(__("Accordion %d Content",'theme_admin'),2),
			"id" => "content_2",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" => sprintf(__("Accordion %d Title",'theme_admin'),3),
			"id" => "title_3",
			"default" => "",
			"type" => "text",
		),
		array(
			"name" => sprintf(__("Accordion %d Title Icon (Optional)&#x200E;",'theme_admin'),3),
			"id" => "icon_3",
			"default" => "",
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => sprintf(__("Accordion %d Title Icon Color (Optional)&#x200E;",'theme_admin'),3),
			"id" => "icon_color_3",
			"default" => "",
			"format" => "hex",
			"type" => "color",
		),
		array(
			"name" => sprintf(__("Accordion %d Content",'theme_admin'),3),
			"id" => "content_3",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" => sprintf(__("Accordion %d Title",'theme_admin'),4),
			"id" => "title_4",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Accordion %d Title Icon (Optional)&#x200E;",'theme_admin'),4),
			"id" => "icon_4",
			"default" => "",
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => sprintf(__("Accordion %d Title Icon Color (Optional)&#x200E;",'theme_admin'),4),
			"id" => "icon_color_4",
			"default" => "",
			"format" => "hex",
			"type" => "color",
		),
		array(
			"name" => sprintf(__("Accordion %d Content",'theme_admin'),4),
			"id" => "content_4",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" => sprintf(__("Accordion %d Title",'theme_admin'),5),
			"id" => "title_5",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Accordion %d Title Icon (Optional)&#x200E;",'theme_admin'),5),
			"id" => "icon_5",
			"default" => "",
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => sprintf(__("Accordion %d Title Icon Color (Optional)&#x200E;",'theme_admin'),5),
			"id" => "icon_color_5",
			"default" => "",
			"format" => "hex",
			"type" => "color",
		),
		array(
			"name" => sprintf(__("Accordion %d Content",'theme_admin'),5),
			"id" => "content_5",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" => sprintf(__("Accordion %d Title",'theme_admin'),6),
			"id" => "title_6",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Accordion %d Title Icon (Optional)&#x200E;",'theme_admin'),6),
			"id" => "icon_6",
			"default" => "",
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => sprintf(__("Accordion %d Title Icon Color (Optional)&#x200E;",'theme_admin'),6),
			"id" => "icon_color_6",
			"default" => "",
			"format" => "hex",
			"type" => "color",
		),
		array(
			"name" => sprintf(__("Accordion %d Content",'theme_admin'),6),
			"id" => "content_6",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" => sprintf(__("Accordion %d Title",'theme_admin'),7),
			"id" => "title_7",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Accordion %d Title Icon (Optional)&#x200E;",'theme_admin'),7),
			"id" => "icon_7",
			"default" => "",
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => sprintf(__("Accordion %d Title Icon Color (Optional)&#x200E;",'theme_admin'),7),
			"id" => "icon_color_7",
			"default" => "",
			"format" => "hex",
			"type" => "color",
		),
		array(
			"name" => sprintf(__("Accordion %d Content",'theme_admin'),7),
			"id" => "content_7",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" => sprintf(__("Accordion %d Title",'theme_admin'),8),
			"id" => "title_8",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Accordion %d Title Icon (Optional)&#x200E;",'theme_admin'),8),
			"id" => "icon_8",
			"default" => "",
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => sprintf(__("Accordion %d Title Icon Color (Optional)&#x200E;",'theme_admin'),8),
			"id" => "icon_color_8",
			"default" => "",
			"format" => "hex",
			"type" => "color",
		),
		array(
			"name" => sprintf(__("Accordion %d Content",'theme_admin'),8),
			"id" => "content_8",
			"default" => "",
			"type" => "textarea"
		),
	),
	"custom" => $custom_script,
	"init" => $init_script,
);