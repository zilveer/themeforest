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
	"title" => __("Nivo Slideshow", "theme_admin"),
	"shortcode" => 'slideshow',
	"attributes" => 'type="nivo"',
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
			"name" => __("Transition Effects",'theme_admin'),
			"desc" => __("Select which effect to use on the slideshow.",'theme_admin'),
			"id" => "effects",
			"default" => 'random',
			"options" => array(
				'random'=> __("random",'theme_admin'),
				'sliceDownRight'=> __("sliceDownRight",'theme_admin'),
				'sliceDownLeft'=> __("sliceDownLeft",'theme_admin'),
				'sliceUpRight'=> __("sliceUpRight",'theme_admin'),
				'sliceUpLeft'=> __("sliceUpLeft",'theme_admin'),
				'sliceUpDown'=> __("sliceUpDown",'theme_admin'),
				'sliceUpDownLeft'=> __("sliceUpDownLeft",'theme_admin'),
				'fold'=> __("fold",'theme_admin'),
				'fade'=> __("fade",'theme_admin'),
				'boxRandom'=> __("boxRandom",'theme_admin'),
				'boxRain'=> __("boxRain",'theme_admin'),
				'boxRainReverse'=> __("boxRainReverse",'theme_admin'),
				'boxRainGrow'=> __("boxRainGrow",'theme_admin'),
				'boxRainGrowReverse'=> __("boxRainGrowReverse",'theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Segments",'theme_admin'),
			"desc" => __("Number of segments in which the image will be sliced for slice animations.",'theme_admin'),
			"id" => "slices",
			"min" => "1",
			"max" => "30",
			"step" => "1",
			"default" => "10",
			"type" => "range"
		),
		array(
			"name" => __("Box Columns",'theme_admin'),
			"desc" => __("Number of Columns in which the image will be sliced for box animations.",'theme_admin'),
			"id" => "boxCols",
			"min" => "1",
			"max" => "30",
			"step" => "1",
			"default" => "8",
			"type" => "range"
		),
		array(
			"name" => __("Box Rows",'theme_admin'),
			"desc" => __("Number of Rows in which the image will be sliced for box animations.",'theme_admin'),
			"id" => "boxRows",
			"min" => "1",
			"max" => "30",
			"step" => "1",
			"default" => "4",
			"type" => "range"
		),
		array(
			"name" => __("Animation Speed",'theme_admin'),
			"desc" => __("Define the duration of the animations.",'theme_admin'),
			"id" => "animSpeed",
			"min" => "200",
			"max" => "3000",
			"step" => "100",
			'unit' => 'miliseconds',
			"default" => "500",
			"type" => "range"
		),
		array(
			"name" => __("Pause Time",'theme_admin'),
			"desc" => __("Define the delay which each slide will have to wait to be played",'theme_admin'),
			"id" => "pauseTime",
			"min" => "1000",
			"max" => "30000",
			"step" => "500",
			"unit" => 'miliseconds',
			"default" => "3000",
			"type" => "range"
		),
		array(
			"name" => __("Show Next & Prev Navigation Arrows",'theme_admin'),
			"desc" => __("If you want show navigation arrows on the slideshow, turn this setting to <em>ON</em>.",'theme_admin'),
			"id" => "directionNav",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Hide Next & Prev Nav Arrows on Non-Hover",'theme_admin'),
			"desc" => __("If you want hide the navigation arrows so that they only appear if a cursor is hovering over the slider, toggle this setting to <em>ON</em>.&nbsp;&nbsp;The <b>Show Next & Prev Navigation Arrows</b> setting above must be active in order for this Hide setting to work.",'theme_admin'),
			"id" => "directionNavHide",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Enable Control Navigation Buttons",'theme_admin'),
			"desc" => __("If you want show the little navigation circles that indicate the number of slides in the slideshow, toggle this setting to <em>ON</em>.",'theme_admin'),
			"id" => "controlNav",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Hide Control Navigation Buttons on Non-Hover",'theme_admin'),
			"desc" => __("If you want hide the navigation buttons until a user is hovering their cursor over the the slider, toggle this setting to <em>ON</em>.",'theme_admin'),
			"id" => "controlNavHide",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Nivo Slider Random Start",'theme_admin'),
			"desc" => __("If you want the nivo slider to randomly choose the slide it starts upon toggle this setting to <em>ON</em>.&nbsp;&nbsp;Normally the slider would start with the first slide of the group of slides.&nbsp;&nbsp;With this setting toggled on, it will commence with a different slide in the group each time the page is loaded.",'theme_admin'),
			"id" => "randomStart",
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
			"name" => __("Caption Type",'theme_admin'),
			"id" => "captionType",
			"default" => "title",
			"chosen" => true,
			"type" => "select",
			"options"=>array(
				'title'=> __("Show title",'theme_admin'),
				'excerpt'=> __("Show excerpt",'theme_admin'),
				'title_excerpt'=> __("Show title & excerpt",'theme_admin'),
			),
		),
		array(
			"name" => __("Caption Opacity",'theme_admin'),
			"desc" => __("The Opacity of Caption with it's background.",'theme_admin'),
			"id" => "captionOpacity",
			"min" => "0",
			"max" => "1",
			"step" => "0.1",
			"default" => "0.8",
			"type" => "range"
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
		array(
			"name" => __("Stop Slideshow At End",'theme_admin'),
			"desc" => __("If this option is toggled <em>ON</em>, the slideshow will stop cycling upon reaching the last image in the Nivo Slideshow.",'theme_admin'),
			"id" => "stopAtEnd",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Show Slider After Init",'theme_admin'),
			"desc" => __("Enable this setting and the Slider will appear after the initialisation of the slides. It creates a different loading effect of the nivo slider and prevents annoying stacking and/or leftside loading of the slider images on slow servers.",'theme_admin'),
			"id" => "showAfterInit",
			"default" => false,
			"type" => "toggle"
		),
	),
);
