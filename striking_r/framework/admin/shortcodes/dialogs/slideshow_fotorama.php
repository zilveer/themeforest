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
	"title" => __("Fotorama Slideshow", "theme_admin"),
	"shortcode" => 'slideshow',
	"attributes" => 'type="fotorama"',
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
			"desc" => __("Stage container width in pixels",'theme_admin'),
			"id" => "width",
			"default" => 630,
			"min" => 100,
			"max" => 960,
			"unit" => 'px',
			"type" => "range"
		),
		// array(
		// 	"name" => __("Min Width",'theme_admin'),
		// 	"desc" => __("Stage container minimum width in pixels.",'theme_admin'),
		// 	"id" => "minwidth",
		// 	"default" => 0,
		// 	"min" => 0,
		// 	"max" => 960,
		// 	"unit" => 'px',
		// 	"type" => "range"
		// ),
		// array(
		// 	"name" => __("Max Width",'theme_admin'),
		// 	"desc" => __("Stage container maximum width in pixels.",'theme_admin'),
		// 	"id" => "maxwidth",
		// 	"default" => 960,
		// 	"min" => 320,
		// 	"max" => 960,
		// 	"unit" => 'px',
		// 	"type" => "range"
		// ),
		array(
			"name" => __("Height",'theme_admin'),
			"desc" => __("Stage container height in pixels",'theme_admin'),
			"id" => "height",
			"default" => 0,
			"min" => 0,
			"max" => 1000,
			"unit" => 'px',
			"type" => "range"
		),
		array(
			"name" => __("Min Height",'theme_admin'),
			"desc" => __("Stage container minimum height in pixels",'theme_admin'),
			"id" => "minHeight",
			"default" => 150,
			"min" => 0,
			"max" => 1000,
			"unit" => 'px',
			"type" => "range"
		),
		array(
			"name" => __("Max Height",'theme_admin'),
			"desc" => __("Stage container maximum height in pixels.",'theme_admin'),
			"id" => "maxHeight",
			"default" => 600,
			"min" => 0,
			"max" => 1200,
			"unit" => 'px',
			"type" => "range"
		),
		array(
			"name" => __("Ratio",'theme_admin'),
			"desc" => __("Width divided by height. ",'theme_admin'),
			"id" => "ratio",
			"default" => 1.7,
			"min" => 0,
			"max" => 3,
			'step' => 0.1,
			"type" => "range"
		),
		// array(
		// 	"name" => __("Margin",'theme_admin'),
		// 	"desc" => __("Horizontal margins for frames in pixels.",'theme_admin'),
		// 	"id" => "margin",
		// 	"default" => 2,
		// 	"min" => 0,
		// 	"max" => 20,
		// 	"unit" => 'px',
		// 	"type" => "range"
		// ),
		// array(
		// 	"name" => __("Glimpse",'theme_admin'),
		// 	"desc" => __("Glimpse size of nearby frames in pixels or percents.",'theme_admin'),
		// 	"id" => "glimpse",
		// 	"default" => 0,
		// 	"min" => 0,
		// 	"max" => 100,
		// 	"unit" => 'px',
		// 	"type" => "range"
		// ),
		array(
			"name" => __("Navigation style",'theme_admin'),
			"id" => "nav",
			"default" => "thumbs",
			"type" => "select",
			"options"=>array(
				'dots'=> __("iPhone-style dots",'theme_admin'),
				'thumbs'=> __("Thumbnails",'theme_admin'),
				'false'=> __("Nothing",'theme_admin'),
			),
		),
		array(
			"name" => __("Nav Position",'theme_admin'),
			"id" => "navPosition",
			"default" => "bottom",
			"type" => "select",
			"options"=>array(
				'bottom'=> __("Bottom",'theme_admin'),
				'top'=> __("Top",'theme_admin'),
			),
		),
		array(
			"name" => __("Thumbnail width in pixels",'theme_admin'),
			"desc" => '',
			"id" => "thumbWidth",
			"default" => 60,
			"min" => 20,
			"max" => 150,
			"unit" => 'px',
			"type" => "range"
		),
		array(
			"name" => __("Thumbnail height in pixels",'theme_admin'),
			"desc" => '',
			"id" => "thumbHeight",
			"default" => 60,
			"min" => 20,
			"max" => 150,
			"unit" => 'px',
			"type" => "range"
		),
		array(
			"name" => __("Size of thumbnail margins",'theme_admin'),
			"desc" => '',
			"id" => "thumbMargin",
			"default" => 5,
			"min" => 0,
			"max" => 50,
			"unit" => 'px',
			"type" => "range"
		),
		array(
			"name" => __("Thumb Border Width",'theme_admin'),
			"desc" => __('Border width of the active thumbnail.','theme_admin'),
			"id" => "thumbBorderWidth",
			"default" => 2,
			"min" => 0,
			"max" => 20,
			"unit" => 'px',
			"type" => "range"
		),
		array(
			"name" => __("Allows fullscreen",'theme_admin'),
			"id" => "allowFullScreen",
			"default" => "true",
			"chosen" => true,
			"type" => "select",
			"options"=>array(
				'false'=> __("false",'theme_admin'),
				'true'=> __("true",'theme_admin'),
				'native'=> __("native",'theme_admin'),
			),
		),
		array(
			"name" => __("Fit",'theme_admin'),
			"desc" => __('How to fit an image into a fotorama:','theme_admin'),
			"id" => "fit",
			"default" => "contain",
			"chosen" => true,
			"type" => "select",
			"options"=>array(
				'contain'=> __("contain",'theme_admin'),
				'cover'=> __("cover",'theme_admin'),
				'scaledown'=> __("scaledown",'theme_admin'),
				'none'=> __("none",'theme_admin'),
			),
		),
		array(
			"name" => __("Transition",'theme_admin'),
			"desc" => __('Defines what transition to use:','theme_admin'),
			"id" => "transition",
			"default" => "slide",
			"chosen" => true,
			"type" => "select",
			"options"=>array(
				'slide'=> __("slide",'theme_admin'),
				'crossfade'=> __("crossfade",'theme_admin'),
				'dissolve'=> __("dissolve",'theme_admin'),
			),
		),
		array(
			"name" => __("Transition Duration",'theme_admin'),
			"desc" => __("Animation length in milliseconds.",'theme_admin'),
			"id" => "transitionDuration",
			"default" => 500,
			"min" => 100,
			"max" => 10000,
			"type" => "range"
		),
		array(
			"name" => __("Captions visibility",'theme_admin'),
			"id" => "captions",
			"default" => false,
			"type"=>"toggle",
		),
		array(
			"name"=>__("Caption Postion"),
			"id" => "captionposition",
			"default" => 'bottomleft',
			"type" => "select",
			"options" => array(
				'bottomleft'=>__("Bottom-Left",'theme_admin'),
				'bottomcenter'=>__("Bottom-Center",'theme_admin'),
				'bottomright'=>__("Bottom-Right",'theme_admin'),
				'topleft'=>__("Top-Left",'theme_admin'),
				'topcenter'=>__("Top-Center",'theme_admin'),
				'topright'=>__("Top-Right",'theme_admin'),					
			)
		),
		array(
			"name" => __("Captions Full Width",'theme_admin'),
			"id" => "captionfullwidth",
			"default" => false,
			"type"=>"toggle",
			),
		array(
			"name" => __("Caption Background Color",'theme_admin'),
			"desc" => "",
			"id" => "fotorama_caption_bg",
			"default" => "",
			"type" => "color"
		),
		array(
			"name" => __("Caption Text Color",'theme_admin'),
			"desc" => "",
			"id" => "fotorama_caption_text",
			"default" => "",
			"type" => "color"
		),
		
		array(
			"name" => __("Loop",'theme_admin'),
			"id" => "loop",
			"default" => true,
			"type"=>"toggle",
		),
		array(
			"name" => __("Autoplay",'theme_admin'),
			"id" => "autoplay",
			"default" => false,
			"type"=>"toggle",
		),
		array(
			"name" => __("Stop Autoplay On Touch",'theme_admin'),
			"desc" => __("Stops slideshow at any user action with the fotorama.",'theme_admin'),
			"id" => "stopAutoplayOnTouch",
			"default" => true,
			"type"=>"toggle",
		),
		array(
			"name" => __("Enables keyboard navigation",'theme_admin'),
			"id" => "keyboard",
			"default" => false,
			"type"=>"toggle",
		),
		array(
			"name" => __("Arrows",'theme_admin'),
			"desc" => __("Turns on navigation arrows over the frames.",'theme_admin'),
			"id" => "arrows",
			"default" => true,
			"type"=>"toggle",
		),
		array(
			"name" => __("Moving between frames by clicking",'theme_admin'),
			"id" => "click",
			"default" => true,
			"type"=>"toggle",
		),
		array(
			"name" => __("Moving between frames by swiping",'theme_admin'),
			"id" => "swipe",
			"default" => true,
			"type"=>"toggle",
		),
		array(
			"name" => __("Trackpad",'theme_admin'),
			"desc" => __("Enables trackpad support and horizontal mouse wheel as well.",'theme_admin'),
			"id" => "trackpad",
			"default" => true,
			"type"=>"toggle",
		),
		array(
			"name" => __("Shuffles frames at launch",'theme_admin'),
			"id" => "shuffle",
			"default" => false,
			"type"=>"toggle",
		),
		array(
			"name" => __("Direction",'theme_admin'),
			"id" => "direction",
			"default" => "ltr",
			"chosen" => true,
			"type" => "select",
			"options"=>array(
				'ltr'=> __("Right to left",'theme_admin'),
				'rtl'=> __("Left to right",'theme_admin'),
			),
		),
		array(
			"name" => __("Enables shadows",'theme_admin'),
			"desc" => '',
			"id" => "shadows",
			"default" => true,
			"type"=>"toggle",
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