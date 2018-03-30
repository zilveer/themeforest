<?php
class Theme_Options_Page_Slideshow extends Theme_Options_Page_With_Sub_Tabs {
	public static $slideTypes;
	public $slug = 'slideshow';

	function __construct(){
		$this->name = __('SlideShow Settings','theme_admin');
		self::$slideTypes = array(
			'nivo' => __("Nivo Slider",'theme_admin'),
			'ken'=> __("KenBurner Slider ",'theme_admin'),
			'unleash' => __("Unleash Accordion Slider",'theme_admin'),
			'roundabout' => __("Roundabout Slider",'theme_admin'),
			'fotorama' => __("Fotorama Slider",'theme_admin'),
		);
		parent::__construct();
	}
	function tabs(){
		$default_opts = array();
		foreach (self::$slideTypes as $key => $value) {
			$default_opts[] =$key.'_default'; 
		}
		$default_opts = implode($default_opts,',');
		$options = array(
			array(
				"slug" => 'general',
				"name" => __("SlideShow General",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Create Custom Slider Configuration Presets",'theme_admin'),
						"desc" => __("<p>Striking provides the ability for one to create different preset slider configurations for all the theme sliders, and the select one of them in the <strong>Slideshow Type</strong> when setting a feature header slideshow. &nbsp;&nbsp;One can create as many custom configurations as desired, each different preset for use in the feature header of a different page or post.&nbsp;&nbsp;This overcomes the restriction that used to exist wherein the default slider configuration in Striking 5.1 (and below) was always per the default settings in the Striking Slideshow Panel.</p><p>Select the slider type you wish to make a preset for in the list below, then input the name into the field, and save.&nbsp;&nbsp;The preset will then appear below, and it/they will appear in dropdown list for the <strong>Slideshow Type</strong>when creating a feature header slideshow.",'theme_admin'),
						"id" => "template",
						"function" =>  "_option_customs_function",
						"default" =>$default_opts,
						"type" => "custom",
					),
					array(
						"name" => __("Enable Blog Posts in Slideshows",'theme_admin'),
						"desc" => __("<p>This is a setting which enables the theme sliders to have the ability to also show your blog posts. &nbsp;&nbsp;If toggled to <em>ON</em>, then if one selects a Blog Post Category in the slideshow source, the featured image of each blog post item in that category will be shown in the slideshow, and clicking on the slide image will link directly to that blog single post.&nbsp;&nbsp;It does not show the post content itself, just the featured image of the post and the post title.</p>",'theme_admin'),
						"id" => "post_linkable",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Enable Portfolio Posts in Slideshows",'theme_admin'),
						"desc" => __("<p>This is a setting which enables the theme sliders to have the ability to also show your portfolio posts. &nbsp;&nbsp;If toggled to <em>ON</em>, then if one selects a Portfolio Post Category in the slideshow source, the featured image of each portfolio post item in that category will be shown in the slideshow, and  clicking on that slide image will link directly to that portfolio single post.&nbsp;&nbsp;The slideshow will the show the post title and image only - it does not show any content that you might have in the post body.</p>",'theme_admin'),	
						"id" => "portfolio_linkable",
						"default" => true,
						"type" => "toggle"
					),
				),
			),
		);

		$template = theme_get_option_from_db('slideshow','template');
		if($template){
			$customs = explode(',',$template);
		} else{
			$customs = array();
		}

		$templates = array();
		if(!empty($customs)){
			foreach ($customs as $custom) {
				$custom = explode('_',$custom);
				$templates[$custom[0]][] = $custom[1];
			}
		}

		foreach(self::$slideTypes as $key => $value){
			$option = array(
				"name"=>$value." ".__("Settings",'theme_admin'),
				"hasChild"=>true,
				"slug" => $key,
				'options'=>array(),
			);
			$optFun = $key.'Option';
			$option['options']['default'] = array(
				"name"=>__("Default Settings",'theme_admin'),
				"options"=>$this->{$optFun}('default'),
			);
			if(array_key_exists($key,$templates) && is_array($templates[$key])){
				foreach ($templates[$key] as $value) {
					if($value != 'default'){
						$option['options'][$value] =array(
							"name"=>sprintf(__("%s Settings",'theme_admin'),ucwords($value)), 
							"options"=>self::$optFun($value),
						);
					}
				}
			}
			$options[] = $option;
		}
		return $options;
	}

	public static function kenOption($field){
		return array(
			array(
				"name" => __("Margin Top",'theme_admin'),
				"desc" => "",
				"id" => "ken_".$field."_marginTop",
				"default" => 25,
				"min" => 0,
				"max" => 100,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Margin Bottom",'theme_admin'),
				"desc" => "",
				"id" => "ken_".$field."_marginBottom",
				"default" => 15,
				"min" => 0,
				"max" => 100,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Pause On Hover",'theme_admin'),
				"id" => "ken_".$field."_pauseOnMain",
				"default" => true,
				"type"=>"toggle",
			),
			array(
				"name" => __("Slider Width",'theme_admin'),
				"desc" => "",
				"id" => "ken_".$field."_width",
				"default" => 960,
				"min" => 400,
				"max" => 960,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Slider Height",'theme_admin'),
				"desc" => "",
				"id" => "ken_".$field."_height",
				"default" => 320,
				"min" => 200,
				"max" => 800,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Navigation Type",'theme_admin'),
				"id" => "ken_".$field."_naviType",
				"default" => 'bullet',
				"options" => array(
					"none" => __("None",'theme_admin'),
					"bullet" => __("Pager",'theme_admin'),
					"thumb" => __("Thumbnail",'theme_admin'),
				),
				"type" => "select",
			),
			array(
				"name" => __("Border Width",'theme_admin'),
				"desc" => "",
				"id" => "ken_".$field."_border",
				"default" => 10,
				"min" => 0,
				"max" => 20,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Thumbnail Image Width",'theme_admin'),
				"desc" => "",
				"id" => "ken_".$field."_thumbWidth",
				"default" => 80,
				"min" => 50,
				"max" => 200,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Thumbnail Image Height",'theme_admin'),
				"desc" => "",
				"id" => "ken_".$field."_thumbHeight",
				"default" => 50,
				"min" => 30,
				"max" => 200,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Thumbnail Amount",'theme_admin'),
				"desc" => "",
				"id" => "ken_".$field."_thumbAmount",
				"default" => 5,
				"min" => 3,
				"max" => 8,
				"type" => "range"
			),
			array(
				"name" => __("Show Thumbnail When Screen Smaller Than 980 ",'theme_admin'),
				"id" => "ken_".$field."_showthumbmini",
				"default" => false,
				"type"=>"toggle",
			),
			array(
				"name"=>__("Show Description After animation"),
				"id" => "ken_".$field."_description",
				"default" => true,
				"type"=>"toggle",
			),
		);
	}

	public static function unleashOption($field){
		return array(
			array(
				"name" => __("Margin Top",'theme_admin'),
				"desc" => "",
				"id" => "unleash_".$field."_marginTop",
				"default" => 20,
				"min" => 0,
				"max" => 100,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Margin Bottom",'theme_admin'),
				"desc" => "",
				"id" => "unleash_".$field."_marginBottom",
				"default" => 20,
				"min" => 0,
				"max" => 100,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Slider Width",'theme_admin'),
				"desc" => __("This can be considered as the total slider width given the above 2 values, it is essential for scaling the slider when screen width changes.",'theme_admin'),
				"id" => "unleash_".$field."_max_width",
				"default" => 960,
				"min" => 600,
				"max" => 1920,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Image Width",'theme_admin'),
				"desc" =>  __("The width that you want it to appear when slide is opened.",'theme_admin'),
				"id" => "unleash_".$field."_slide_width",
				"default" => 600,
				"min" => 300,
				"max" => 1500,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Image Height",'theme_admin'),
				"desc" =>  __("Your desired slide height (typically image height).",'theme_admin'),
				"id" => "unleash_".$field."_slide_height",
				"default" => 300,
				"min" => 100,
				"max" => 800,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("RTL",'theme_admin'),
				"desc"=>__("Start sliding from right to left for certin languages.",'theme_admin'),
				"id" => "unleash_".$field."_rtl",
				"default" => false,
				"type"=>"toggle",
			),
			array(
				"name" => __("Event",'theme_admin'),
				"desc"=>__("Event for expanding slide (hover or click).",'theme_admin'),
				"id" => "unleash_".$field."_Event",
				"default" => 'hover',
				"options" => array(
					"hover" => __("Hover",'theme_admin'),
					"click" => __("Click",'theme_admin'),
				),
				"type" => "select",
			),
			array(
				"name" => __("Duration",'theme_admin'),
				"desc" => __("The duration that the slide takes to open and caption appears.",'theme_admin'),
				"id" => "unleash_".$field."_duration",
				"default" => 700,
				"min" => 500,
				"max" => 3000,
				"type" => "range"
			),
			array(
				"name" => __("Slide Duration",'theme_admin'),
				"desc" => __("The duration the slide takes before the next one opens in slideshow mode.",'theme_admin'),
				"id" => "unleash_".$field."_slide_duration",
				"default" => 6000,
				"min" => 1000,
				"max" => 15000,
				"type" => "range"
			),
			array(
				"name"=>__("AutoPlay"),
				"desc"=>__("Automatically change slides. &nbsp;The slider will start autoplaying after opening whatever was set to be the the initial opening slide (setting for that is below).",'theme_admin'),
				"id" => "unleash_".$field."_slideshow",
				"default" => true,
				"type"=>"toggle",
			),
			array(
				"name" => __("Initially Open Slide",'theme_admin'),
				"desc" => __("Choose a slide to be opened when page loads. 0 is for it to commence with the first slide.",'theme_admin'),
				"id" => "unleash_".$field."_initially_open_slide",
				"default" => 0,
				"min" => 0,
				"max" => 8,
				"type" => "range"
			),
			
			array(
				"name" => __("Collapse On Mouse Leave",'theme_admin'),
				"desc"=>__("Do you want all slides to close when mouse is not on the slider.",'theme_admin'),
				"id" => "unleash_".$field."_collapse_on_mouseout",
				"default" => true,
				"type"=>"toggle",
			),
			array(
				"name" => __("Easing",'theme_admin'),
				"desc"=>__("Easing for slides.",'theme_admin'),
				"id" => "unleash_".$field."_easing",
				"default" => 'easeOutQuad',
				"options" => array(
					'swing'=>__("Swing",'theme_admin'),
					'linear'=>__("linear",'theme_admin'),
					'easeInQuad'=>__("easeInQuad",'theme_admin'),
					'easeOutQuad'=>__("easeOutQuad",'theme_admin'),
					'easeInOutQuad'=>__("easeInOutQuad",'theme_admin'),
					'easeInCubic'=>__("easeInCubic",'theme_admin'),
					'easeOutCubic'=>__("easeOutCubic",'theme_admin'),
					'easeInOutCubic'=>__("easeInOutCubic",'theme_admin'),
					'easeInQuart'=>__("easeInQuart",'theme_admin'),
					'easeOutQuart'=>__("easeOutQuart",'theme_admin'),
					'easeInOutQuart'=>__("easeInOutQuart",'theme_admin'),
					'easeInQuint'=>__("easeInQuint",'theme_admin'),
					'easeOutQuint'=>__("easeOutQuint",'theme_admin'),
					'easeInOutQuint'=>__("easeInOutQuint",'theme_admin'),
					'easeInSine'=>__("easeInSine",'theme_admin'),
					'easeOutSine'=>__("easeOutSine",'theme_admin'),
					'easeInOutSine'=>__("easeInOutSine",'theme_admin'),
					'easeInExpo'=>__("easeInExpo",'theme_admin'),
					'easeOutExpo'=>__("easeOutExpo",'theme_admin'),
					'easeInCirc'=>__("easeInCirc",'theme_admin'),
					'easeOutCirc'=>__("easeOutCirc",'theme_admin'),
					'easeInOutCirc'=>__("easeInOutCirc",'theme_admin'),
					'easeInElastic'=>__("easeInElastic",'theme_admin'),
					'easeOutElastic'=>__("easeOutElastic",'theme_admin'),
					'easeInOutSine'=>__("easeInOutSine",'theme_admin'),
					'easeInBack'=>__("easeInBack",'theme_admin'),
					'easeOutBack'=>__("easeOutBack",'theme_admin'),
					'easeInOutBack'=>__("easeInOutBack",'theme_admin'),
					'easeInBounce'=>__("easeInBounce",'theme_admin'),
					'easeOutBounce'=>__("easeOutBounce",'theme_admin'),
					'easeInOutBounce'=>__("easeInOutBounce",'theme_admin'),
					"backEaseIn" => __("backEaseIn",'theme_admin'),
					"backEaseOut" => __("backEaseOut",'theme_admin'),
					"backEaseInOut" => __("backEaseInOut",'theme_admin'),
					"bounceEaseIn" => __("bounceEaseIn",'theme_admin'),
					"bounceEaseOut" => __("bounceEaseOut",'theme_admin'),
					"circEaseIn" => __("circEaseIn",'theme_admin'),
					"circEaseOut" => __("circEaseOut",'theme_admin'),
					"circEaseInOut" => __("circEaseInOut",'theme_admin'),
					"cubicEaseIn" => __("cubicEaseIn",'theme_admin'),
					"cubicEaseOut" => __("cubicEaseOut",'theme_admin'),
					"elasticEaseIn" => __("elasticEaseIn",'theme_admin'),
					"elasticEaseIn" => __("elasticEaseIn",'theme_admin'),
					"expoEaseIn" => __("expoEaseIn",'theme_admin'),
					"expoEaseOut" => __("expoEaseOut",'theme_admin'),
					"expoEaseInOut" => __("expoEaseInOut",'theme_admin'),
					"quadEaseIn" => __("quadEaseIn",'theme_admin'),
					"quadEaseOut" => __("quadEaseOut",'theme_admin'),
					"quadEaseInOut" => __("quadEaseInOut",'theme_admin'),
					"quartEaseIn" => __("quartEaseIn",'theme_admin'),
					"quartEaseOut" => __("quartEaseOut",'theme_admin'),
					"quartEaseInOut" => __("quartEaseInOut",'theme_admin'),
					"sineEaseIn" => __("sineEaseIn",'theme_admin'),
					"sineEaseOut" => __("sineEaseOut",'theme_admin'),
					"sineEaseInOut" => __("sineEaseInOut",'theme_admin'),
				),
				"type" => "select",
			),
			array(
				"name"=>__("Caption"),
				"id" => "unleash_".$field."_caption",
				"default" => true,
				"type"=>"toggle",
			),
			array(
				"name" => __('Caption Style', 'theme_admin'),
				"id" => "unleash_".$field."_captionCss",
				"default" => 'unleash-caption',
				"options" => array(
					'' => 'Default',
					'unleash-caption-1' => 'Caption 1',
					'unleash-caption-2' => 'Caption 2',
					'unleash-caption-3' => 'Caption 3',
				),
				"type" => "select",
			),
			
			array(
				"name"=>__("Caption Animation"),
				"desc"=>__("Caption animation type.",'theme_admin'),
				"id" => "unleash_".$field."_caption_animation",
				"default" => 'opacity',
				"options" => array(
					"opacity" => __("Opacity",'theme_admin'),
					"pop-up" => __("Pop-up",'theme_admin'),
					"alwaysshow"=> __("Always Show",'theme_admin'),
				),
				"type"=>"select",
			),
			array(
				"name" => __("Caption Animation Easing",'theme_admin'),
				"desc"=>__("Easing for captions.",'theme_admin'),
				"id" => "unleash_".$field."_caption_animation_easing",
				"default" => 'easeInOutBack',
				"options" => array(
					'swing'=>__("Swing",'theme_admin'),
					'linear'=>__("linear",'theme_admin'),
					//"backEaseIn" => __("backEaseIn",'theme_admin'),
					"backEaseOut" => __("backEaseOut",'theme_admin'),
					"backEaseInOut" => __("backEaseInOut",'theme_admin'),
					"bounceEaseIn" => __("bounceEaseIn",'theme_admin'),
					"bounceEaseOut" => __("bounceEaseOut",'theme_admin'),
					"circEaseIn" => __("circEaseIn",'theme_admin'),
					"circEaseOut" => __("circEaseOut",'theme_admin'),
					"circEaseInOut" => __("circEaseInOut",'theme_admin'),
					"cubicEaseIn" => __("cubicEaseIn",'theme_admin'),
					"cubicEaseOut" => __("cubicEaseOut",'theme_admin'),
					"elasticEaseIn" => __("elasticEaseIn",'theme_admin'),
					"elasticEaseIn" => __("elasticEaseIn",'theme_admin'),
					"expoEaseIn" => __("expoEaseIn",'theme_admin'),
					"expoEaseOut" => __("expoEaseOut",'theme_admin'),
					"expoEaseInOut" => __("expoEaseInOut",'theme_admin'),
					"quadEaseIn" => __("quadEaseIn",'theme_admin'),
					"quadEaseOut" => __("quadEaseOut",'theme_admin'),
					"quadEaseInOut" => __("quadEaseInOut",'theme_admin'),
					"quartEaseIn" => __("quartEaseIn",'theme_admin'),
					"quartEaseOut" => __("quartEaseOut",'theme_admin'),
					"quartEaseInOut" => __("quartEaseInOut",'theme_admin'),
					"sineEaseIn" => __("sineEaseIn",'theme_admin'),
					"sineEaseOut" => __("sineEaseOut",'theme_admin'),
					"sineEaseInOut" => __("sineEaseInOut",'theme_admin'),

				),
				"type" => "select",
			),
			// array(
			// 	"name"=>__("Caption Class Name"),
			// 	"id" => "unleash_".$field."_captionClassName",
			// 	"default" => "",
			// 	"type" => "text"
			// ),
			array(
				"name"=>__("Enable Controls"),
				"id" => "unleash_".$field."_controls",
				"default" => false,
				"type"=>"toggle",
			),
			array(
				"name"=>__("Hide Controls"),
				"desc"=>__("Hides the control buttons and make them only appear when mouse is over the slide.",'theme_admin'),
				"id" => "unleash_".$field."_hide_controls",
				"default" => true,
				"type"=>"toggle",
			),
			array(
				"name"=>__("Pauses On Mouse Over"),
				"desc"=>__("Pauses the slideshow when mouse is over the slider.",'theme_admin'),
				"id" => "unleash_".$field."_pause_onmouseover",
				"default" => true,
				"type"=>"toggle",
			),
		);
	}

	public static function roundaboutOption($field){
		return array(
			array(
				"name" => __("Margin Top",'theme_admin'),
				"desc" => "",
				"id" => "roundabout_".$field."_marginTop",
				"default" => 15,
				"min" => 0,
				"max" => 200,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Margin Bottom",'theme_admin'),
				"desc" => "",
				"id" => "roundabout_".$field."_marginBottom",
				"default" => 15,
				"min" => 0,
				"max" => 200,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Slider Width",'theme_admin'),
				"desc" => "",
				"id" => "roundabout_".$field."_slideWidth",
				"default" => 600,
				"min" => 300,
				"max" => 960,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Slider Height",'theme_admin'),
				"desc" => "",
				"id" => "roundabout_".$field."_slideHeight",
				"default" => 300,
				"min" => 100,
				"max" => 800,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Image Width",'theme_admin'),
				"desc" => "",
				"id" => "roundabout_".$field."_imageWidth",
				"default" => 600,
				"min" => 300,
				"max" => 1500,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Image Height",'theme_admin'),
				"desc" => "",
				"id" => "roundabout_".$field."_imageHeight",
				"default" => 300,
				"min" => 100,
				"max" => 800,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Offset Top",'theme_admin'),
				"desc" => "",
				"id" => "roundabout_".$field."_offsetTop",
				"default" => 20,
				"min" => -100,
				"max" => 100,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Offset Bottom",'theme_admin'),
				"desc" => "",
				"id" => "roundabout_".$field."_offsetBottom",
				"default" => 20,
				"min" => -100,
				"max" => 100,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name"=>__("Shape"),
				"desc"=>__("The path that moving elements follow. ",'theme_admin'),
				"id" => "roundabout_".$field."_shape",
				"default" => 'lazySusan',
				"options" => array(
					"lazySusan"=>__("lazySusan",'theme_admin'),
					"theJuggler"=>__("theJuggler",'theme_admin'),
					"figure8"=>__("figure8",'theme_admin'),
					"waterWheel"=>__("waterWheel",'theme_admin'),
					"square"=>__("square",'theme_admin'),
					"conveyorBeltLeft"=>__("conveyorBeltLeft",'theme_admin'),
					"conveyorBeltRight"=>__("conveyorBeltRight",'theme_admin'),
					"goodbyeCruelWorld"=>__("goodbyeCruelWorld",'theme_admin'),
					"diagonalRingLeft"=>__("diagonalRingLeft",'theme_admin'),
					"diagonalRingRight"=>__("diagonalRingRight",'theme_admin'),
					"rollerCoaster"=>__("rollerCoaster",'theme_admin'),
					"tearDrop"=>__("tearDrop",'theme_admin'),
					"tickingClock"=>__("tickingClock",'theme_admin'),
					"flurry"=>__("flurry",'theme_admin'),
					"nowSlide"=>__("nowSlide",'theme_admin'),
					"risingEssence"=>__("risingEssence",'theme_admin'),
				),
				"type"=>"select",
			),
			array(
				"name" => __("Easing",'theme_admin'),
				"id" => "roundabout_".$field."_easing",
				"default" => 'swing',
				"type" => "select",
				"options" => array(
					'swing'=>__("Swing",'theme_admin'),
					'linear'=>__("linear",'theme_admin'),
					'easeInQuad'=>__("easeInQuad",'theme_admin'),
					'easeOutQuad'=>__("easeOutQuad",'theme_admin'),
					'easeInOutQuad'=>__("easeInOutQuad",'theme_admin'),
					'easeInCubic'=>__("easeInCubic",'theme_admin'),
					'easeOutCubic'=>__("easeOutCubic",'theme_admin'),
					'easeInOutCubic'=>__("easeInOutCubic",'theme_admin'),
					'easeInQuart'=>__("easeInQuart",'theme_admin'),
					'easeOutQuart'=>__("easeOutQuart",'theme_admin'),
					'easeInOutQuart'=>__("easeInOutQuart",'theme_admin'),
					'easeInQuint'=>__("easeInQuint",'theme_admin'),
					'easeOutQuint'=>__("easeOutQuint",'theme_admin'),
					'easeInOutQuint'=>__("easeInOutQuint",'theme_admin'),
					'easeInSine'=>__("easeInSine",'theme_admin'),
					'easeOutSine'=>__("easeOutSine",'theme_admin'),
					'easeInOutSine'=>__("easeInOutSine",'theme_admin'),
					'easeInExpo'=>__("easeInExpo",'theme_admin'),
					'easeOutExpo'=>__("easeOutExpo",'theme_admin'),
					'easeInCirc'=>__("easeInCirc",'theme_admin'),
					'easeOutCirc'=>__("easeOutCirc",'theme_admin'),
					'easeInOutCirc'=>__("easeInOutCirc",'theme_admin'),
					'easeInElastic'=>__("easeInElastic",'theme_admin'),
					'easeOutElastic'=>__("easeOutElastic",'theme_admin'),
					'easeInOutSine'=>__("easeInOutSine",'theme_admin'),
					'easeInBack'=>__("easeInBack",'theme_admin'),
					'easeOutBack'=>__("easeOutBack",'theme_admin'),
					'easeInOutBack'=>__("easeInOutBack",'theme_admin'),
					'easeInBounce'=>__("easeInBounce",'theme_admin'),
					'easeOutBounce'=>__("easeOutBounce",'theme_admin'),
					'easeInOutBounce'=>__("easeInOutBounce",'theme_admin'),
					"backEaseIn" => __("backEaseIn",'theme_admin'),
					"backEaseOut" => __("backEaseOut",'theme_admin'),
					"backEaseInOut" => __("backEaseInOut",'theme_admin'),
					"bounceEaseIn" => __("bounceEaseIn",'theme_admin'),
					"bounceEaseOut" => __("bounceEaseOut",'theme_admin'),
					"circEaseIn" => __("circEaseIn",'theme_admin'),
					"circEaseOut" => __("circEaseOut",'theme_admin'),
					"circEaseInOut" => __("circEaseInOut",'theme_admin'),
					"cubicEaseIn" => __("cubicEaseIn",'theme_admin'),
					"cubicEaseOut" => __("cubicEaseOut",'theme_admin'),
					"elasticEaseIn" => __("elasticEaseIn",'theme_admin'),
					"elasticEaseIn" => __("elasticEaseIn",'theme_admin'),
					"expoEaseIn" => __("expoEaseIn",'theme_admin'),
					"expoEaseOut" => __("expoEaseOut",'theme_admin'),
					"expoEaseInOut" => __("expoEaseInOut",'theme_admin'),
					"quadEaseIn" => __("quadEaseIn",'theme_admin'),
					"quadEaseOut" => __("quadEaseOut",'theme_admin'),
					"quadEaseInOut" => __("quadEaseInOut",'theme_admin'),
					"quartEaseIn" => __("quartEaseIn",'theme_admin'),
					"quartEaseOut" => __("quartEaseOut",'theme_admin'),
					"quartEaseInOut" => __("quartEaseInOut",'theme_admin'),
					"sineEaseIn" => __("sineEaseIn",'theme_admin'),
					"sineEaseOut" => __("sineEaseOut",'theme_admin'),
					"sineEaseInOut" => __("sineEaseInOut",'theme_admin'),
				),
			),
			array(
				"name" => __("Tilt",'theme_admin'),
				"desc" => __("Slightly alters the calculations of moving elements.",'theme_admin'),
				"id" => "roundabout_".$field."_tilt",
				"default" => 0,
				"min" => -1,
				"max" => 1,
				"step"=>0.1,
				"type" => "range"
			),
			array(
				"name" => __("Reflect",'theme_admin'),
				"desc" => __("When true, reverses the direction in which Roundabout will operate.",'theme_admin'),
				"id" => "roundabout_".$field."_reflect",
				"default" => false,
				"type"=>"toggle",
			),
			array(
				"name" => __("Min Image Z-index",'theme_admin'),
				"desc" => __("The lowest opacity that will be assigned to a moving element. ",'theme_admin'),
				"id" => "roundabout_".$field."_minz",
				"default" => 100,
				"min" => 100,
				"max" => 400,
				"step"=>20,
				"type" => "range"
			),
			array(
				"name" => __("Max Image Z-index",'theme_admin'),
				"desc" => __("The greatest opacity that will be assigned to a moving element. ",'theme_admin'),
				"id" => "roundabout_".$field."_maxz",
				"default" => 280,
				"min" => 100,
				"max" => 400,
				"step"=>20,
				"type" => "range"
			),
			array(
				"name" => __("Min Image Opacity",'theme_admin'),
				"desc" => __("The lowest opacity that will be assigned to a moving element. ",'theme_admin'),
				"id" => "roundabout_".$field."_minOpacity",
				"default" => 0.6,
				"min" => 0.1,
				"max" => 1,
				"step"=>0.1,
				"type" => "range"
			),
			array(
				"name" => __("Max Image Opacity",'theme_admin'),
				"desc" => __("The greatest opacity that will be assigned to a moving element. ",'theme_admin'),
				"id" => "roundabout_".$field."_maxOpacity",
				"default" => 1,
				"min" => 0.1,
				"max" => 1,
				"step"=>0.1,
				"type" => "range"
			),
			array(
				"name" => __("Min Image Scale",'theme_admin'),
				"desc" => __("The lowest size (relative to its starting size) that will be assigned to a moving element. ",'theme_admin'),
				"id" => "roundabout_".$field."_minScale",
				"default" => 0.4,
				"min" => 0.1,
				"max" => 2,
				"step"=>0.1,
				"type" => "range"
			),
			array(
				"name" => __("Max Image Scale",'theme_admin'),
				"desc" => __("The greatest  size (relative to its starting size) that will be assigned to a moving element. ",'theme_admin'),
				"id" => "roundabout_".$field."_maxScale",
				"default" => 1,
				"min" => 0.1,
				"max" => 2,
				"step"=>0.1,
				"type" => "range"
			),
			array(
				"name" => __("Auto Play",'theme_admin'),
				"id" => "roundabout_".$field."_autoplay",
				"default" => false,
				"type"=>"toggle",
			),
			array(
				"name" => __("Auto Play Initial Delay",'theme_admin'),
				"desc" => __("The length of time (in milliseconds) to delay the start of Roundabout's configured autoplay option.",'theme_admin'),
				"id" => "roundabout_".$field."_autoplayInitialDelay",
				"default" => 500,
				"min" => 0,
				"max" => 5000,
				"step"=>100,
				"type" => "range"
			),
			array(
				"name" => __("Auto Play Duration",'theme_admin'),
				"id" => "roundabout_".$field."_autoplayDuration",
				"default" => 3000,
				"min" => 0,
				"max" => 10000,
				"step"=>100,
				"type" => "range"
			),
			array(
				"name" => __("Auto Play Pause On Hover",'theme_admin'),
				"id" => "roundabout_".$field."_autoplayPauseOnHover",
				"default" => false,
				"type"=>"toggle",
			),
			array(
				"name" => __("Enable Navigation",'theme_admin'),
				"id" => "roundabout_".$field."_navi",
				"default" => true,
				"type"=>"toggle",
			),
			array(
				"name" => __("Navigation Show On Hover",'theme_admin'),
				"id" => "roundabout_".$field."_navihover",
				"default" => false,
				"type"=>"toggle",
			),
			array(
				"name"=>__("Caption"),
				"id" => "roundabout_".$field."_caption",
				"default" => true,
				"type"=>"toggle",
			),
			array(
				"name"=>__("Caption Show On Hover"),
				"id" => "roundabout_".$field."_captionHover",
				"default" => true,
				"type"=>"toggle",
			),
			array(
				"name"=>__("Caption Postion"),
				"id" => "roundabout_".$field."_captionPosition",
				"default" => 'bottom',
				"type" => "select",
				"options" => array(
					'top'=>__("Top",'theme_admin'),
					'center'=>__("Center",'theme_admin'),
					'bottom'=>__("Bottom",'theme_admin'),
				)
			),
			array(
				"name"=>__("Caption Custom Style"),
				"id" => "roundabout_".$field."_captionStyle",
				"default" => "",
				'rows' => '10',
				"type" => "textarea"
			),
		);
	}
	public static function nivoOption($field){
		return array(
			array(
				"name" => __("Margin Top",'theme_admin'),
				"desc" => "",
				"id" => "nivo_".$field."_marginTop",
				"default" => 10,
				"min" => 0,
				"max" => 100,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Margin Bottom",'theme_admin'),
				"desc" => "",
				"id" => "nivo_".$field."_marginBottom",
				"default" => 10,
				"min" => 0,
				"max" => 100,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Slider Width",'theme_admin'),
				"desc" => "",
				"id" => "nivo_".$field."_width",
				"default" => 960,
				"min" => 400,
				"max" => 1920,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Slider Height",'theme_admin'),
				"desc" => "",
				"id" => "nivo_".$field."_height",
				"default" => 400,
				"min" => 300,
				"max" => 800,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Effects",'theme_admin'),
				"id" => "nivo_".$field."_effects",
				"default" => "random",
				"chosen" => true,
				"type" => "select",
				"options"=>array(
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
			),
			array(
				"name" => __("Autoplay",'theme_admin'),
				"id" => "nivo_".$field."_autoplay",
				"default" => true,
				"type"=>"toggle",
			),
			array(
				"name" => __("Animation Speed",'theme_admin'),
				"desc" => __("Define the duration of the animations.",'theme_admin'),
				"id" => "nivo_".$field."_animSpeed",
				"default" => 500,
				"min" => 100,
				"max" => 10000,
				"type" => "range"
			),
			array(
				"name" => __("Pause Time",'theme_admin'),
				"desc" => __("Define the delay which each slide will have to wait to be played",'theme_admin'),
				"id" => "nivo_".$field."_pauseTime",
				"default" => 3000,
				"min" => 1000,
				"max" => 10000,
				"type" => "range"
			),
			array(
				"name" => __("Pause On Hover",'theme_admin'),
				"id" => "nivo_".$field."_pauseOnHover",
				"default" => true,
				"type"=>"toggle",
			),
			array(
				"name" => __("Show Next & Prev Navigation Arrows",'theme_admin'),
				"desc" => __("If you want show navigation arrows on the slideshow, turn this setting to <em>ON</em>.",'theme_admin'),
				"id" => "nivo_".$field."_directionNav",
				"default" => true,
				"type" => "toggle"
			),
			array(
				"name" => __("Hide Next & Prev Nav Arrows on Non-Hover",'theme_admin'),
				"desc" => __("If you want hide the navigation arrows so that they only appear if a cursor is hovering over the slider, toggle this setting to <em>ON</em>.&nbsp;&nbsp;The <b>Show Next & Prev Navigation Arrows</b> setting above must be active in order for this Hide setting to work.",'theme_admin'),
				"id" => "nivo_".$field."_directionNavHide",
				"default" => true,
				"type" => "toggle"
			),
			array(
				"name" => __("Enable Control Navigation Buttons",'theme_admin'),
				"desc" => __("If you want show the little navigation circles that indicate the number of slides in the slideshow, toggle this setting to <em>ON</em>.",'theme_admin'),
				"id" => "nivo_".$field."_controlNav",
				"default" => true,
				"type" => "toggle"
			),
			array(
				"name" => __("Hide Control Navigation Buttons on Non-Hover",'theme_admin'),
				"desc" => __("If you want hide the navigation buttons until a user is hovering their cursor over the the slider, toggle this setting to <em>ON</em>.",'theme_admin'),
				"id" => "nivo_".$field."_controlNavHide",
				"default" => false,
				"type" => "toggle"
			),
			array(
				"name" => __("Nivo Slider Random Start",'theme_admin'),
				"desc" => __("If you want the nivo slider to randomly choose the slide it starts upon toggle this setting to <em>ON</em>.&nbsp;&nbsp;Normally the slider would start with the first slide of the group of slides.&nbsp;&nbsp;With this setting toggled on, it will commence with a different slide in the group each time the page is loaded.",'theme_admin'),
				"id" => "nivo_".$field."_randomStart",
				"default" => false,
				"type" => "toggle"
			),

			array(
				"name" => __("Slices",'theme_admin'),
				"desc" => __("Number of segments in which the image will be sliced for slice animations.",'theme_admin'),
				"id" => "nivo_".$field."_slices",
				"default" => 15,
				"min" => 5,
				"max" => 20,
				"type" => "range"
			),
			array(
				"name" => __("Box Cols",'theme_admin'),
				"desc" => __("Number of Columns in which the image will be sliced for box animations.",'theme_admin'),
				"id" => "nivo_".$field."_boxCols",
				"default" => 8,
				"min" => 5,
				"max" => 15,
				"type" => "range"
			),
			array(
				"name" => __("Box Rows",'theme_admin'),
				"desc" => __("Number of Rows in which the image will be sliced for box animations.",'theme_admin'),
				"id" => "nivo_".$field."_boxRows",
				"default" => 4,
				"min" => 3,
				"max" => 10,
				"type" => "range"
			),
			array(
				"name" => __("Enable Captions",'theme_admin'),
				"id" => "nivo_".$field."_caption",
				"default" => true,
				"type"=>"toggle",
			),
			array(
				"name" => __("Caption Type",'theme_admin'),
				"id" => "nivo_".$field."_captionType",
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
				"id" => "nivo_".$field."_captionOpacity",
				"min" => "0",
				"max" => "1",
				"step" => "0.1",
				"default" => "0.8",
				"type" => "range"
			),
			array(
				"name" => __("Stop Slideshow At End",'theme_admin'),
				"desc" => __("If this option is toggled <em>ON</em>, the slideshow will stop cycling upon reaching the last image in the Nivo Slideshow.",'theme_admin'),
				"id" => "nivo_".$field."_stopAtEnd",
				"default" => false,
				"type" => "toggle"
			),
			array(
				"name" => __("Show Slider After Init",'theme_admin'),
				"desc" => __("Enable this setting and the Slider will appear after the initialisation of the slides. It creates a different loading effect of the nivo slider and prevents annoying stacking and/or leftside loading of the slider images on slow servers.",'theme_admin'),
				"id" => "nivo_".$field."_showAfterInit",
				"default" => false,
				"type" => "toggle"
			),
		);
		
	}

	public static function fotoramaOption($field){
		return array(
			array(
				"name" => __("Fotorama Height - Desktop Viewport",'theme_admin'),
				"desc" => __("This setting is for the slider height in pixels in the regular desktop viewport.  &nbsp;The max height available is 1000px.",'theme_admin'),
				"id" => "fotorama_".$field."_height",
				"default" => 0,
				"min" => 0,
				"max" => 1000,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Minimum Fotorama Height - Responsive Viewports (Optional)&#x200E;",'theme_admin'),
				"desc" => __("This setting is for the viewport minimum height in pixels. &nbsp;It is an optional setting as one can also utilize the Ratio Setting below. &nbsp;The minimum default height is otherwise set at 200px, meaning in the smallest mobile viewport, the slider would have a minimum height of 200px.",'theme_admin'),
				"id" => "fotorama_".$field."_minheight",
				"default" => 200,
				"min" => 0,
				"max" => 1000,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Maximum Fotorama Height - Responsive Viewports (Optional)&#x200E;",'theme_admin'),
				"desc" => __("This setting is for the viewport maximum height in pixels. &nbsp;It is an optional setting as one can also utilize the Ratio Setting below. &nbsp;The maximum height is otherwise set at 1200px, meaning in the largest mobile viewport, the slider would have a maximum height of 1200px.  &nbsp;The default value for mobile viewports is 680px",'theme_admin'),
				"id" => "fotorama_".$field."_maxheight",
				"default" => 680,
				"min" => 0,
				"max" => 1200,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Ratio",'theme_admin'),
				"desc" => __("<p>The ratio settings is seemingly complex to understand, so please read this info carefully. &nbsp;In each mobile viewport, there is of course a defined width - the width of the phone or tablet. &nbsp;This setting will calculate the slideshow height based on the ration of width to height that is set below.</p>
<p>This setting calculates the height based on the following formula:  height = width / ratio. &nbsp;If the forumula calculation is greater then max-height setting value above, it will use max-height value, and if it less then min-height, it will use min-height value.</p> ",'theme_admin'),
				"id" => "fotorama_".$field."_ratio",
				"default" => 1.7,
				"min" => 0,
				"max" => 3,
				'step' => 0.1,
				"type" => "range"
			),
			array(
				"name" => __("Left and Right Main Photo Margin",'theme_admin'),
				"desc" => __("Horizontal margins for frames in pixels.",'theme_admin'),
				"id" => "fotorama_".$field."_margin",
				"default" => 2,
				"min" => 0,
				"max" => 20,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Glimpse",'theme_admin'),
				"desc" => __("Glimpse size of nearby frames in pixels or percents.",'theme_admin'),
				"id" => "fotorama_".$field."_glimpse",
				"default" => 0,
				"min" => 0,
				"max" => 100,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Navigation style",'theme_admin'),
				"id" => "fotorama_".$field."_nav",
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
				"id" => "fotorama_".$field."_navposition",
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
				"id" => "fotorama_".$field."_thumbwidth",
				"default" => 64,
				"min" => 20,
				"max" => 150,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Thumbnail height in pixels",'theme_admin'),
				"desc" => '',
				"id" => "fotorama_".$field."_thumbheight",
				"default" => 64,
				"min" => 20,
				"max" => 150,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Size of Thumbnail margins",'theme_admin'),
				"desc" => '',
				"id" => "fotorama_".$field."_thumbmargin",
				"default" => 2,
				"min" => 0,
				"max" => 50,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Thumb Border Width",'theme_admin'),
				"desc" => __('Border width of the active thumbnail.','theme_admin'),
				"id" => "fotorama_".$field."_thumbborderwidth",
				"default" => 2,
				"min" => 0,
				"max" => 20,
				"unit" => 'px',
				"type" => "range"
			),
			array(
				"name" => __("Allow fullscreen",'theme_admin'),
				"id" => "fotorama_".$field."_allowfullscreen",
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
				"id" => "fotorama_".$field."_fit",
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
				"id" => "fotorama_".$field."_transition",
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
				"id" => "fotorama_".$field."_transitionduration",
				"default" => 500,
				"min" => 100,
				"max" => 10000,
				"type" => "range"
			),
			array(
				"name" => __("Captions visibility",'theme_admin'),
				"id" => "fotorama_".$field."_captions",
				"default" => true,
				"type"=>"toggle",
			),
			array(
				"name"=>__("Caption Postion"),
				"id" => "fotorama_".$field."_captionposition",
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
				"id" => "fotorama_".$field."_captionfullwidth",
				"default" => false,
				"type"=>"toggle",
			),
			array(
				"name" => __("Caption Background Color",'theme_admin'),
				"desc" => "",
				"id" => "fotorama_".$field."_fotorama_caption_bg",
				"default" => "",
				"type" => "color"
			),
			array(
				"name" => __("Caption Text Color",'theme_admin'),
				"desc" => "",
				"id" => "fotorama_".$field."_fotorama_caption_text",
				"default" => "",
				"type" => "color"
			),
				
			array(
				"name" => __("Loop",'theme_admin'),
				"id" => "fotorama_".$field."_loop",
				"default" => true,
				"type"=>"toggle",
			),
			array(
				"name" => __("Autoplay",'theme_admin'),
				"id" => "fotorama_".$field."_autoplay",
				"default" => false,
				"type"=>"toggle",
			),
			array(
				"name" => __("Stop Autoplay On Touch",'theme_admin'),
				"desc" => __("Stops slideshow at any user action with the fotorama.",'theme_admin'),
				"id" => "fotorama_".$field."_stopautoplayontouch",
				"default" => true,
				"type"=>"toggle",
			),
			array(
				"name" => __("Enables keyboard navigation",'theme_admin'),
				"id" => "fotorama_".$field."_keyboard",
				"default" => false,
				"type"=>"toggle",
			),
			array(
				"name" => __("Arrows",'theme_admin'),
				"desc" => __("Turns on navigation arrows over the frames.",'theme_admin'),
				"id" => "fotorama_".$field."_arrows",
				"default" => true,
				"type"=>"toggle",
			),
			array(
				"name" => __("Moving between frames by clicking",'theme_admin'),
				"id" => "fotorama_".$field."_click",
				"default" => true,
				"type"=>"toggle",
			),
			array(
				"name" => __("Moving between frames by swiping",'theme_admin'),
				"id" => "fotorama_".$field."_swipe",
				"default" => true,
				"type"=>"toggle",
			),
			array(
				"name" => __("Trackpad",'theme_admin'),
				"desc" => __("Enables trackpad support and horizontal mouse wheel as well.",'theme_admin'),
				"id" => "fotorama_".$field."_trackpad",
				"default" => true,
				"type"=>"toggle",
			),
			array(
				"name" => __("Shuffles frames at launch",'theme_admin'),
				"id" => "fotorama_".$field."_shuffle",
				"default" => false,
				"type"=>"toggle",
			),
			array(
				"name" => __("Direction",'theme_admin'),
				"id" => "fotorama_".$field."_direction",
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
				"id" => "fotorama_".$field."_shadows",
				"default" => true,
				"type"=>"toggle",
			),
		);
	}
	function _option_customs_function($value, $default) {
		if(!empty($default)){
			$customs = explode(',',$default);
		}else{
			$customs = array();
		}
		$customs = array_unique($customs);
		$templates = array();
		foreach ($customs as $custom) {
			$custom = explode('_',$custom);
			$templates[$custom[0]][] = $custom[1];
		}
		echo <<<HTML
<script type="text/javascript">
jQuery(document).ready( function($) {

	//select slide type;
	var tmpl = $('#custom-template');
	var list = tmpl.find('.custom-list');

	var slideType = $('#slide-type').val();

	tmpl.find('.'+slideType).addClass('active');
	$("#slide-type").change(function(){
		list.removeClass('active');
		var slideType = $('#slide-type').val();
		tmpl.find('.'+slideType).addClass('active');
	});

	$(".add_custom").validator({effect:'option'});

	tmpl.closest('form').submit(function(e) {
		var activeList = tmpl.find('.custom-list.active');
		var slideType = $('#slide-type').val();
		var newTmpl = activeList.find('.add_custom').val();
		if (!e.isDefaultPrevented() && newTmpl) {
			newTmpl = slideType + '_'+ newTmpl;

			if($('#customs').val()){
				$('#customs').val($('#customs').val()+','+newTmpl);
			}else{
				$('#customs').val(newTmpl);
			}
		}
	});

	$(".custom-item input:button").click(function(){
		$(this).closest(".custom-item").fadeOut("normal",function(){
			$(this).remove();
			$('#customs').val('');
			$(".custom-item-value").each(function(){
				var slideType = $(this).closest('.custom-list').data('type');
				var newTmpl = slideType+'_'+$(this).val();
				if($('#customs').val()){
					$('#customs').val($('#customs').val()+','+newTmpl);
				}else{
					$('#customs').val(newTmpl);
				}
			});
		});

	});

});
</script>
<style type="text/css">
.custom-title {
	margin:20px 0 5px;
	font-weight:bold;
}
.custom-item {
	padding-left:10px;
}
.custom-item span {
	margin-right:10px;
}
.custom-list{
	display:none;
}
.custom-list.active{
	display:block;
}
#custom-template label{
	margin-right:20px;
	font-weight:bold;
}
#slide-type{
	margin-bottom:20px;
}
</style>
HTML;
		echo '<div class="theme-option-content">';
		echo '<select id="slide-type">';
		foreach(self::$slideTypes as $type => $label){
			echo '<option value="'.$type.'">'.$label.'</option>';
		}
		echo '</select>';
		echo '<div id="custom-template">';

		foreach(self::$slideTypes as $type => $label){
			echo '<div class="custom-list '.$type.'" data-type="'.$type.'">';
			echo '<label for="custom-'.$type.'">'.sprintf(__('Input the new preset name for %s','theme_admin'),$label).'</label>';
			echo '<input type="text" id="custom-'.$type.'" class="add_custom" name="add_custom'.$type.'" pattern="([a-zA-Z\x7f-\xff][a-zA-Z0-9\x7f-\xff]*){0,1}" data-message="'.__('Please input a valid name which starts with a letter, followed by letters, numbers.','theme_admin').'" maxlength="20" /><span class="validator-error"></span>';
			if(array_key_exists($type,$templates)){
				if(count($templates[$type]) > 1 )
					echo '<div class="custom-title">'.sprintf(__('Below are the Presets you have created for %s','theme_admin'),$label).'</div>';
				foreach($templates[$type] as $template){
					if ($template == 'default') {
						echo '<input type="hidden" class="custom-item-value" value="default"/>';
					}else{
						echo '<div class="custom-item"><span>'.$template.'</span><input type="hidden" class="custom-item-value" value="'.$template.'"/><input type="button" class="button" value="'.__('Delete','theme_admin').'"/></div>';
					}
				}
			}

			echo '</div>';

		}
		echo '</div>';

		echo '<input type="hidden" value="' . implode($customs,',') . '" name="' . $value['id'] . '" id="customs"/>';
		echo '</div>';

	}		
}
