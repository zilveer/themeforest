<?php
$init_script = <<<HTML
	jQuery('[name="_source[]"]').on("change",function(){
		var __val = jQuery(this).val();
		var _val={};
		jQuery.each(__val, function(key, value) { 
			if(value.indexOf('|')!=-1){
				var source = value.split('|');
				if(_val[source[0]] == undefined){
					_val[source[0]]=[];
				}
				if(_val[source[0]] != true){
					_val[source[0]].push(source[1])
				}
			}else{
				_val[value] = true;
			}
		});
		var val=[];
		jQuery.each(_val, function(key, value) { 
			if($.isArray(value)){
				val.push('{'+key+':'+value.join(',')+'}');
			}else{
				val.push('{'+key+'}');
			}
		});
		jQuery('[name="source"]').val(val.join(''));
	});
HTML;
if (! function_exists("theme_dialog_slideshow_source")) {
	function theme_dialog_slideshow_source($option){
		include_once (THEME_HELPERS . '/baseOptionsGenerator.php');
		$generator = new baseOptionsGenerator();
		echo '<input type="hidden" id="' . $option['id'] . '" name="' . $option['id'] . '" value="" />';
		$option['id'] = '_source';
		$generator->multiselect($option);
	}
}
return array(
	"title" => __("Ken Burner Slideshow", "theme_admin"),
	"shortcode" => 'slideshow',
	"attributes" => 'type="ken"',
	"type" => 'enclosing',
	"init" => $init_script,
	"options" => array(
		array(
			"name" => __("Images Srcs (Optional)&#x200E;",'theme_admin'),
			"desc" => __("separated by linebreak",'theme_admin'),
			"id" => "content",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" => __("Number (Optional)&#x200E;",'theme_admin'),
			"desc" => __("Sets the number of images to display.<br> 0: Display all images.",'theme_admin'),
			"id" => "number",
			"default" => '0',
			"min" => 0,
			"max" => 20,
			"step" => "1",
			"type" => "range"
		),
		array(
			"name" => __("SlideShow Source (Optional)&#x200E;",'theme_admin'),
			"desc" => __("Select which SlideShow Source to show.",'theme_admin'),
			"id" => "source",
			"options" => array(
				"g" => __('Self Gallery','theme_admin'),
			),
			"default" => "",
			"chosen" => true,
			"prompt" => __("Select Source..",'theme_admin'),
			'target' => 'slideshow_source',
			'function' => 'theme_dialog_slideshow_source',
			"type" => "custom"
		),
		array(
			"name" => __("Width",'theme_admin'),
			"desc" => __("Width of slider.",'theme_admin'),
			"id" => "width",
			"min" => "10",
			"max" => "960",
			"step" => "1",
			"unit" => 'px',
			"default" => "630",
			"type" => "range"
		),
		array(
			"name" => __("Height",'theme_admin'),
			"desc" => __("Height of slider.",'theme_admin'),
			"id" => "height",
			"min" => "10",
			"max" => "1000",
			"step" => "1",
			"unit" => 'px',
			"default" => "300",
			"type" => "range"
		),
		array(
			"name" => __("Control Navigation",'theme_admin'),
			"desc" => __("If you want show Navigation on the slidershow, turn on the button.",'theme_admin'),
			"id" => "navi",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Pause On Hover",'theme_admin'),
			"desc" => __("If you want stop animation while hovering, turn on the button.",'theme_admin'),
			"id" => "pauseOnHover",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Caption",'theme_admin'),
			"desc" => __("If you want display the title of slider item, turn on the button.",'theme_admin'),
			"id" => "caption",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" =>  __("Align (Optional)&#x200E;",'theme_admin'),
			"id" => "align",
			"default" => '',
			"prompt" => __("Default",'theme_admin'),
			"options" => array(
				"left" => __('left','theme_admin'),
				"right" => __('right','theme_admin'),
				"center" => __('center','theme_admin'),
			),
			"type" => "select",
		),
	),
);