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
	jQuery('[name="number"]').on("change",function(){
		var steps_number = jQuery(this).val();
		jQuery('.shortcode-item').each(function(i){
			if(i>(12+steps_number*3)){
				jQuery(this).hide();
			}else{
				jQuery(this).show();
			}
		});
	}).trigger("change");
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
$custom_script = <<<HTML
	var number = attrs['number'].value;	
	var source = attrs['source'].value;
	var title = attrs['title'].value;
	var nav = attrs['nav'].value;
	var autoplay = attrs['autoplay'].value;
	var circular = attrs['circular'].value;
	var lightbox = attrs['lightbox'].value;
	var touch = attrs['touch'].value;
	var speed = attrs['speed'].value;
	var delay = attrs['delay'].value;
	var link_target = attrs['link_target'].value;
	var number_attr = '';

	if(source){
		source = ' source="'+source+'"';

		if(number !== '0'){
			number_attr = ' number="'+number+'"';
		}
	}
	if(title){
		title = ' title="'+title+'"';
	}
	if(nav === 'true'){
		nav = ' nav="'+nav+'"';
	}else{
		nav = '';
	}
	if(touch === 'false'){
		touch = ' touch="'+touch+'"';
	}else{
		touch = '';
	}
	if(speed !== '1000'){
		speed = ' speed="'+speed+'"';
	}else{
		speed = '';
	}
	if(delay !== '4000'){
		delay = ' delay="'+delay+'"';
	}else{
		delay = '';
	}
	if(autoplay === 'false'){
		autoplay = ' autoplay="'+autoplay+'"';
	}else{
		autoplay = '';
	}
	if(circular === 'true'){
		circular = ' circular="'+circular+'"';
	}else{
		circular = '';
	}
	if(lightbox === 'true'){
		lightbox = ' lightbox="'+lightbox+'"';
	}else{
		lightbox = '';
	}
	if(link_target !== '_self'){
		link_target = ' link_target="'+link_target+'"';
	}else{
		link_target = '';
	}
	
	var ret = '\\n[carousel width="'+attrs['width'].value+'" height="'+attrs['height'].value+'"'+source+number_attr+title+nav+autoplay+circular+touch+delay+speed+lightbox+link_target+']\\n';
	var caption = '';
	var imgSource = '';
	for(var i=1;i<=number;i++){
		if(attrs['source_'+i].value){
			imgSource = jQuery.parseJSON(attrs['source_'+i].value);
			if(attrs['caption_'+i].value){
				caption = ' caption="'+attrs['caption_'+i].value+'"';
			}else{
				caption = '';
			}
			if(attrs['link_'+i].value){
				link = ' link="'+attrs['link_'+i].value+'"';
			}else{
				link = '';
			}

			ret +='  [carousel_image source_type="'+imgSource.type+'" source_value="'+imgSource.value+'"'+caption+link+']\\n';
		}
	}
	ret +='[/carousel]\\n';
	return ret;
HTML;
return array(
	"title" => __("Carousel",'theme_admin'),
	"type" => 'custom',
	"options" => array(
		array(
			"name" => __("Image Width",'theme_admin'),
			"desc" => __("The image width can be set from a range of 50px to 500px in width.  All images will be the same width in the carousel.",'theme_admin'),
			"id" => "width",
			"min" => "50",
			"max" => "500",
			"step" => "1",
			"default" => "200",
			"unit" => 'px',
			"type" => "range"
		),
		array(
			"name" => __("Image Height",'theme_admin'),
			"desc" => __("The image height can be set from a range of 50px to 500px in height.  All images will be the same height in the carousel.",'theme_admin'),
			"id" => "height",
			"min" => "50",
			"max" => "500",
			"step" => "1",
			"default" => "150",
			"unit" => 'px',
			"type" => "range"
		),
		array(
			"name" => __("Title (Optional)&#x200E;",'theme_admin'),
			"desc" => __("Text entered into this field will show as a left justified title h3 in size above the carousel.",'theme_admin'),
			"id" => "title",
			"default" => "",
			"type" => "text",
			"class" => 'full'
		),
		array (
			"name" => __("Nav",'theme_admin'),
			"desc" => __("To display a set of navigation allowing a viewer to manually progress the carousel. The default setting is not to display the nav toggles.",'theme_admin'),
			"id" => "nav",
			"default" => false,
			"type" => "toggle"
		),
		array (
			"name" => __("Autoplay",'theme_admin'),
			"desc" => __("The default for autoplay is true, and the autoplay will advance the carousel image by image per the delay setting below.",'theme_admin'),
			"id" => "autoplay",
			"default" => true,
			"type" => "toggle"
		),
		array (
			"name" => __("Circular",'theme_admin'),
			"desc" => __("When Circular is ON, the carousel will cycle from image to image continually. If left in the default position OFF, once the last image in the group is reached, the carousel &#34;cycles&#34; the carousel back to the first image in the group, in a nifty rewind effect.",'theme_admin'),
			"id" => "circular",
			"default" => false,
			"type" => "toggle"
		),
		array (
			"name" => __("Lightbox",'theme_admin'),
			"desc" => __("If Lightbox is enabled and the source is a slideshow source or custom images with no linking, then this will enable lightbox support when a viewer clicks on the image.",'theme_admin'),
			"id" => "lightbox",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Delay",'theme_admin'),
			"desc" => __("The period of time images are set for viewing before the slider advances by an image.  The min delay is 500 milliseconds, and the max is 20,000 milliseconds, in 100ms intervals.",'theme_admin'),
			"id" => "delay",
			"min" => "500",
			"max" => "20000",
			"step" => "100",
			'unit' => 'miliseconds',
			"default" => "4000",
			"type" => "range"
		),
		array(
			"name" => __("Speed",'theme_admin'),
			"desc" => __("Speed is the amount of time for the transition, from very slow such as 10,000ms, to very fast quick transitions below a 1000ms.  The fastest transition available is 500ms, and the slowest 10,000ms.  ",'theme_admin'),
			"id" => "speed",
			"min" => "500",
			"max" => "10000",
			"step" => "100",
			'unit' => 'miliseconds',
			"default" => "1000",
			"type" => "range"
		),
		array (
			"name" => __("Touch",'theme_admin'),
			"desc" => __("Enabling swipe support for mobile devices.",'theme_admin'),
			"id" => "touch",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("SlideShow Source (Optional)&#x200E;",'theme_admin'),
			"desc" => __("Select which SlideShow Source to show. Options are a slideshow category, Self Gallery, a blog or portfolio category, or to load custom images using the settings below.  Slider images will link if a url link was set in the single slide option.  An easy slideshow category can also be a carousel source.  Post images will link to the single post. Custom images below have a link option.",'theme_admin'),
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
			"name" => __("Link Target",'theme_admin'),
			"desc" => __("This target type applies to all types other then slider images which, if linked, load in the same frame.",'theme_admin'),
			"id" => "link_target",
			"default" => '_self',
			"options" => array(
				"_blank" => __('Load in a new window','theme_admin'),
				"_self" => __('Load in the same frame as it was clicked','theme_admin'),
				"_parent" => __('Load in the parent frameset','theme_admin'),
				"_top" => __('Load in the full body of the window','theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Number of images",'theme_admin'),
			"desc" => __("Use the slider toggle to set the number of images, and then new fields will appear below with options to load the image, set a custom caption, and link.  The max number of custom images is 15.",'theme_admin'),
			"id" => "number",
			"min" => "0",
			"max" => "15",
			"step" => "1",
			"default" => "0",
			"type" => "range"
		),
		array(
			"name" =>sprintf(__("Image %d Source",'theme_admin'),1),
			"id" => "source_1",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => sprintf(__("Image %d Caption (Optional)&#x200E;",'theme_admin'),1),
			"id" => "caption_1",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Image %d Link (Optional)&#x200E;",'theme_admin'),1),
			"id" => "link_1",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),

		array(
			"name" =>sprintf(__("Image %d Source",'theme_admin'),2),
			"id" => "source_2",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => sprintf(__("Image %d Caption (Optional)&#x200E;",'theme_admin'),2),
			"id" => "caption_2",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Image %d Link (Optional)&#x200E;",'theme_admin'),2),
			"id" => "link_2",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),

		array(
			"name" =>sprintf(__("Image %d Source",'theme_admin'),3),
			"id" => "source_3",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => sprintf(__("Image %d Caption (Optional)&#x200E;",'theme_admin'),3),
			"id" => "caption_3",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Image %d Link (Optional)&#x200E;",'theme_admin'),3),
			"id" => "link_3",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),

		array(
			"name" =>sprintf(__("Image %d Source",'theme_admin'),4),
			"id" => "source_4",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => sprintf(__("Image %d Caption (Optional)&#x200E;",'theme_admin'),4),
			"id" => "caption_4",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Image %d Link (Optional)&#x200E;",'theme_admin'),4),
			"id" => "link_4",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),

		array(
			"name" =>sprintf(__("Image %d Source",'theme_admin'),5),
			"id" => "source_5",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => sprintf(__("Image %d Caption (Optional)&#x200E;",'theme_admin'),5),
			"id" => "caption_5",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Image %d Link (Optional)&#x200E;",'theme_admin'),5),
			"id" => "link_5",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),

		array(
			"name" =>sprintf(__("Image %d Source",'theme_admin'),6),
			"id" => "source_6",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => sprintf(__("Image %d Caption (Optional)&#x200E;",'theme_admin'),6),
			"id" => "caption_6",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Image %d Link (Optional)&#x200E;",'theme_admin'),6),
			"id" => "link_6",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),

		array(
			"name" =>sprintf(__("Image %d Source",'theme_admin'),7),
			"id" => "source_7",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => sprintf(__("Image %d Caption (Optional)&#x200E;",'theme_admin'),7),
			"id" => "caption_7",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Image %d Link (Optional)&#x200E;",'theme_admin'),7),
			"id" => "link_7",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),

		array(
			"name" =>sprintf(__("Image %d Source",'theme_admin'),8),
			"id" => "source_8",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => sprintf(__("Image %d Caption (Optional)&#x200E;",'theme_admin'),8),
			"id" => "caption_8",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Image %d Link (Optional)&#x200E;",'theme_admin'),8),
			"id" => "link_8",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),

		array(
			"name" =>sprintf(__("Image %d Source",'theme_admin'),9),
			"id" => "source_9",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => sprintf(__("Image %d Caption (Optional)&#x200E;",'theme_admin'),9),
			"id" => "caption_9",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Image %d Link (Optional)&#x200E;",'theme_admin'),9),
			"id" => "link_9",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),

		array(
			"name" =>sprintf(__("Image %d Source",'theme_admin'),10),
			"id" => "source_10",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => sprintf(__("Image %d Caption (Optional)&#x200E;",'theme_admin'),10),
			"id" => "caption_10",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Image %d Link (Optional)&#x200E;",'theme_admin'),10),
			"id" => "link_10",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),

		array(
			"name" =>sprintf(__("Image %d Source",'theme_admin'),11),
			"id" => "source_11",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => sprintf(__("Image %d Caption (Optional)&#x200E;",'theme_admin'),11),
			"id" => "caption_11",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Image %d Link (Optional)&#x200E;",'theme_admin'),11),
			"id" => "link_11",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),

		array(
			"name" =>sprintf(__("Image %d Source",'theme_admin'),12),
			"id" => "source_12",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => sprintf(__("Image %d Caption (Optional)&#x200E;",'theme_admin'),12),
			"id" => "caption_12",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Image %d Link (Optional)&#x200E;",'theme_admin'),12),
			"id" => "link_12",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),

		array(
			"name" =>sprintf(__("Image %d Source",'theme_admin'),13),
			"id" => "source_13",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => sprintf(__("Image %d Caption (Optional)&#x200E;",'theme_admin'),13),
			"id" => "caption_13",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Image %d Link (Optional)&#x200E;",'theme_admin'),13),
			"id" => "link_13",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),

		array(
			"name" =>sprintf(__("Image %d Source",'theme_admin'),14),
			"id" => "source_14",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => sprintf(__("Image %d Caption (Optional)&#x200E;",'theme_admin'),14),
			"id" => "caption_14",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Image %d Link (Optional)&#x200E;",'theme_admin'),14),
			"id" => "link_14",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),

		array(
			"name" =>sprintf(__("Image %d Source",'theme_admin'),15),
			"id" => "source_15",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => sprintf(__("Image %d Caption (Optional)&#x200E;",'theme_admin'),15),
			"id" => "caption_15",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
		array(
			"name" => sprintf(__("Image %d Link (Optional)&#x200E;",'theme_admin'),15),
			"id" => "link_15",
			"default" => "",
			"class"=> 'full',
			"type" => "text"
		),
	),
	"custom" => $custom_script,
	"init" => $init_script,
);
