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
		var steps_number = jQuery(this).val();
		jQuery('.shortcode-item').each(function(i){
			if(i>(2+steps_number*7)){
				jQuery(this).hide();
			}else{
				jQuery(this).show();
			}
		});
	}).trigger("change");
HTML;
$custom_script = <<<HTML
	var number = attrs['number'].value;
	var type = attrs['type'].value;
	var size = attrs['size'].value;

	type = ' type="'+type+'"';
	
	if(size != 'horizontal'){
		size = ' size="'+size+'"';
	}else{
		size = '';
	}
	if(number != '3'){
		number_attr = ' number="'+number+'"';
	}else{
		number_attr = '';
	}
	
	var ret = '\\n[process_steps'+type+size+number_attr+']\\n';
	var icon = '', icon_image = '', icon_image_json;
	for(var i=1;i<=number;i++){
		if(attrs['process_steps', 'icon_'+i].value){
			icon = ' icon="'+attrs['process_steps', 'icon_'+i].value+'"';
			if(attrs['process_steps', 'icon_color_'+i].value){
				icon += ' icon_color="'+attrs['process_steps', 'icon_color_'+i].value+'"';
			}
			icon_image = '';
		}else if(attrs['process_steps', 'icon_image_'+i].value){
			icon_image_json = $.parseJSON(attrs['process_steps', 'icon_image_'+i].value);
			if(icon_image_json.value){
				icon_image = ' icon_image="'+icon_image_json.value+'"';
			} else {
				icon_image = '';
			}
			icon = '';
		}else{
			icon_image = '';
			icon = '';
		}
		if(attrs['process_steps', 'link_'+i].value){
			link = ' link="'+attrs['process_steps', 'link_'+i].value+'"';
		}else{
			link = '';
		}
		if(attrs['process_steps', 'target_'+i].value){
			target = ' target="'+attrs['process_steps', 'target_'+i].value+'"';
		}else{
			target = '';
		}	
		ret +='[process_step title="'+attrs['process_steps','title_'+i].value+'"'+icon+icon_image+link+target+']\\n'+attrs['process_steps','content_'+i].value+'\\n[/process_step]\\n';
	}
	ret +='[/process_steps]\\n';
	return ret;
HTML;
return array(
	"title" => __("Process Steps",'theme_admin'),
	"type" => 'custom',
	'contentOption' => 'content_1',
	"options" => array(
		array(
			"name" => __("Size",'theme_admin'),
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
			"name" => __("Type",'theme_admin'),
			"id" => "type",
			"default" => 'horizontal',
			"options" => array(
				'horizontal' => __('Horizontal', 'theme_admin'),
				'vertical' => __('Vertical', 'theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Number of steps",'theme_admin'),
			"id" => "number",
			"min" => "2",
			"max" => "5",
			"step" => "1",
			"default" => "3",
			"type" => "range"
		),
		array(
			"name" => sprintf(__("Step %d Title",'theme_admin'),1),
			"id" => "title_1",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Step %d Icon (Optional)&#x200E;",'theme_admin'),1),
			"id" => "icon_1",
			"default" => "",
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => sprintf(__("Step %d Icon Color (Optional)&#x200E;",'theme_admin'),1),
			"id" => "icon_color_1",
			"default" => "",
			"format" => "hex",
			"type" => "color",
		),
		array(
			"name" => sprintf(__("Step %d Icon Image (Optional)&#x200E;",'theme_admin'),1),
			"id" => "icon_image_1",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => sprintf(__("Step %d Icon Link (Optional)&#x200E;",'theme_admin'),1),
			"id" => "link_1",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => __("Link Target (Optional)&#x200E;",'theme_admin'),
			"id" => "target_1",
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
			"name" => sprintf(__("Step %d Content",'theme_admin'),1),
			"id" => "content_1",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" =>  sprintf(__("Step %d Title",'theme_admin'),2),
			"id" => "title_2",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Step %d Icon (Optional)&#x200E;",'theme_admin'),2),
			"id" => "icon_2",
			"default" => "",
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => sprintf(__("Step %d Icon Color (Optional)&#x200E;",'theme_admin'),2),
			"id" => "icon_color_2",
			"default" => "",
			"format" => "hex",
			"type" => "color",
		),
		array(
			"name" => sprintf(__("Step %d Icon Image (Optional)&#x200E;",'theme_admin'),2),
			"id" => "icon_image_2",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => sprintf(__("Step %d Icon Link (Optional)&#x200E;",'theme_admin'),2),
			"id" => "link_2",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => __("Link Target (Optional)&#x200E;",'theme_admin'),
			"id" => "target_2",
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
			"name" => sprintf(__("Step %d Content",'theme_admin'),2),
			"id" => "content_2",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" =>  sprintf(__("Step %d Title",'theme_admin'),3),
			"id" => "title_3",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Step %d Icon (Optional)&#x200E;",'theme_admin'),3),
			"id" => "icon_3",
			"default" => "",
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => sprintf(__("Step %d Icon Color (Optional)&#x200E;",'theme_admin'),3),
			"id" => "icon_color_3",
			"default" => "",
			"format" => "hex",
			"type" => "color",
		),
		array(
			"name" => sprintf(__("Step %d Icon Image (Optional)&#x200E;",'theme_admin'),3),
			"id" => "icon_image_3",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => sprintf(__("Step %d Icon Link (Optional)&#x200E;",'theme_admin'),3),
			"id" => "link_3",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => __("Link Target (Optional)&#x200E;",'theme_admin'),
			"id" => "target_3",
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
			"name" => sprintf(__("Step %d Content",'theme_admin'),3),
			"id" => "content_3",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" =>  sprintf(__("Step %d Title",'theme_admin'),4),
			"id" => "title_4",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Step %d Icon (Optional)&#x200E;",'theme_admin'),4),
			"id" => "icon_4",
			"default" => "",
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => sprintf(__("Step %d Icon Color (Optional)&#x200E;",'theme_admin'),4),
			"id" => "icon_color_4",
			"default" => "",
			"format" => "hex",
			"type" => "color",
		),
		array(
			"name" => sprintf(__("Step %d Icon Image (Optional)&#x200E;",'theme_admin'),4),
			"id" => "icon_image_4",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => sprintf(__("Step %d Icon Link (Optional)&#x200E;",'theme_admin'),4),
			"id" => "link_4",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => __("Link Target (Optional)&#x200E;",'theme_admin'),
			"id" => "target_4",
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
			"name" => sprintf(__("Step %d Content",'theme_admin'),4),
			"id" => "content_4",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" =>  sprintf(__("Step %d Title",'theme_admin'),5),
			"id" => "title_5",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Step %d Icon (Optional)&#x200E;",'theme_admin'),5),
			"id" => "icon_5",
			"default" => "",
			"prompt" => __("None",'theme_admin'),
			"options" => theme_get_icon_sets(),
			"type" => "select",
		),
		array(
			"name" => sprintf(__("Step %d Icon Color (Optional)&#x200E;",'theme_admin'),5),
			"id" => "icon_color_5",
			"default" => "",
			"format" => "hex",
			"type" => "color",
		),
		array(
			"name" => sprintf(__("Step %d Icon Image (Optional)&#x200E;",'theme_admin'),5),
			"id" => "icon_image_5",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => sprintf(__("Step %d Icon Link (Optional)&#x200E;",'theme_admin'),5),
			"id" => "link_5",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => __("Link Target (Optional)&#x200E;",'theme_admin'),
			"id" => "target_5",
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
			"name" => sprintf(__("Step %d Content",'theme_admin'),5),
			"id" => "content_5",
			"default" => "",
			"type" => "textarea"
		),
	),
	"custom" => $custom_script,
	"init" => $init_script,
);
