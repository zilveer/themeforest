<?php

$pexeto_slider_options= array( array(
"name" => "Slider Settings",
"type" => "title",
"img" => PEXETO_IMAGES_URL."icon_slider.png"
),

array(
"type" => "open",
"subtitles"=>array(array("id"=>"thumbnail", "name"=>"Thumbnail Slider"), array("id"=>"slider", "name"=>"Content Slider"), array("id"=>"accordion", "name"=>"Accordion Slider"), array("id"=>"nivo", "name"=>"Nivo Slider"))
),

/* ------------------------------------------------------------------------*
 * THUMBNAIL SLIDER
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'thumbnail'
),

array(
"name" => "Automatic image resizing",
"id" => PEXETO_SHORTNAME."_thum_auto_resize",
"type" => "checkbox",
"std" => 'off',
"desc" => 'If ON selected, the images will be resized automatically.'
),

array(
"name" => "Autoplay",
"id" => PEXETO_SHORTNAME."_thum_autoplay",
"type" => "checkbox",
"std" => 'on',
"desc" => 'If ON selected, the images will rotate automatically'
),

array(
"name" => "Rotate Interval",
"id" => PEXETO_SHORTNAME."_thum_interval",
"type" => "text",
"desc" => "The interval between changing the images when autoplay is enabled (in miliseconds)",
"std" => '4000'
),

array(
"name" => "Pause Interval",
"id" => PEXETO_SHORTNAME."_thum_pause",
"type" => "text",
"desc" => "The pause interval (in miliseconds)- when an user clicks on an image or arrow, the autoplay pauses for this interval of time",
"std" => '5000'
),

array(
"name" => "Pause on hover",
"id" => PEXETO_SHORTNAME."_thum_pause_hover",
"type" => "checkbox",
"std" => 'on',
"desc" => 'If ON selected, when the user hovers the image, the automatic rotation will pause.'
),


array(
"name"=>"Add Thumbnail Slider Image",
"id"=>'thumbnail_slider',
"type"=>"custom",
"button_text"=>'Add image',
"preview"=>"_thum_image_name",
"fields"=>array(
	array('id'=>'_thum_image_name', 'type'=>'upload', 'name'=>'Image URL'),
	array('id'=>'_thum_image_link', 'type'=>'text', 'name'=>'Image Link'),
	array('id'=>'_thum_image_desc', 'type'=>'textarea', 'name'=>'Image Description')
)
),

array(
"type"=>"multiple_custom",
"refers"=>"_thum_slider_names",
"button_text"=>'Add image',
"preview"=>"_thum_image_name",
"name"=>"Add image to ",
"fields"=>array(
	array('id'=>'_thum_image_name', 'type'=>'upload', 'name'=>'Image URL'),
	array('id'=>'_thum_image_link', 'type'=>'text', 'name'=>'Image Link'),
	array('id'=>'_thum_image_desc', 'type'=>'textarea', 'name'=>'Image Description')
)
),

array(
"name"=>"Add new thumbnail slider",
"id"=>'thumbnail_sliders',
"type"=>"custom",
"button_text"=>'Add Slider',
"desc" => 'You can add a new slider and insert a different set of images to it. After you add the new
slider, you have to press the "Save Changes" button.  After this the new section for adding images for the new slider
should be displayed just above this field.',
"fields"=>array(
	array('id'=>'_thum_slider_name', 'type'=>'text', 'name'=>'Slider Name')
)
),


array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * CONTENT SLIDER
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'slider'
),

array(
"name" => "Automatic image resizing",
"id" => PEXETO_SHORTNAME."_content_auto_resize",
"type" => "checkbox",
"std" => 'off',
"desc" => 'If enabled, the images will be resized automatically.'
),

array(
"name" => "Show navigation",
"id" => PEXETO_SHORTNAME."_content_navigation",
"type" => "multicheck",
"options" => array(array("id"=>"arrows", "name"=>"Arrows"), array("id"=>"buttons", "name"=>"Navigation Buttons")),
"class"=>"include",
"std" => "arrows,buttons"
),

array(
"name" => "Autoplay",
"id" => PEXETO_SHORTNAME."_content_autoplay",
"type" => "checkbox",
"std" => 'on',
"desc" => 'If ON selected, the images will rotate automatically'
),

array(
"name" => "Animation Effect",
"id" => PEXETO_SHORTNAME."_content_animation",
"type" => "select",
"options" => array(
array('id'=>'','name'=>'None'),
array('id'=>'easeInQuad','name'=>'easeInQuad'),
array('id'=>'easeOutQuad','name'=>'easeOutQuad'),
array('id'=>'easeInOutQuad','name'=>'easeInOutQuad'),
array('id'=>'easeInCubic','name'=>'easeInCubic'),
array('id'=>'easeOutCubic','name'=>'easeOutCubic'),
array('id'=>'easeInOutCubic','name'=>'easeInOutCubic'),
array('id'=>'easeInQuart','name'=>'easeInQuart'),
array('id'=>'easeOutQuart','name'=>'easeOutQuart'),
array('id'=>'easeInOutQuart','name'=>'easeInOutQuart'),
array('id'=>'easeInQuint','name'=>'easeInQuint'),
array('id'=>'easeOutQuint','name'=>'easeOutQuint'),
array('id'=>'easeInOutQuin','name'=>'easeInOutQuin'),
array('id'=>'easeInSine','name'=>'easeInSine'),
array('id'=>'easeOutSine','name'=>'easeOutSine'),
array('id'=>'easeInOutSine','name'=>'easeInOutSine'),
array('id'=>'easeInExpo','name'=>'easeInExpo'),
array('id'=>'easeOutExpo','name'=>'easeOutExpo'),
array('id'=>'easeInOutExpo','name'=>'easeInOutExpo'),
array('id'=>'easeInCirc','name'=>'easeInCirc'),
array('id'=>'easeOutCirc','name'=>'easeOutCirc'),
array('id'=>'easeInOutCirc','name'=>'easeInOutCirc'),
array('id'=>'easeInElastic','name'=>'easeInElastic'),
array('id'=>'easeOutElastic','name'=>'easeOutElastic'),
array('id'=>'easeInOutElastic','name'=>'easeInOutElastic'),
array('id'=>'easeInBack','name'=>'easeInBack'),
array('id'=>'easeOutBack','name'=>'easeOutBack'),
array('id'=>'easeInOutBack','name'=>'easeInOutBack'),
array('id'=>'easeInBounce','name'=>'easeInBounce'),
array('id'=>'easeOutBounce','name'=>'easeOutBounce'),
array('id'=>'easeInOutBounce','name'=>'easeInOutBounce')
),
"std" => 'easeInOutExpo'
),

array(
"name" => "Rotate Interval",
"id" => PEXETO_SHORTNAME."_content_interval",
"type" => "text",
"desc" => "The interval between changing the images when autoplay is enabled (in miliseconds)",
"std" => '4000'
),

array(
"name" => "Pause Interval",
"id" => PEXETO_SHORTNAME."_content_pause",
"type" => "text",
"desc" => "The pause interval (in miliseconds)- when an user clicks on an image or arrow, the autoplay pauses for this interval of time",
"std" => '5000'
),

array(
"name" => "Pause on hover",
"id" => PEXETO_SHORTNAME."_content_pause_hover",
"type" => "checkbox",
"std" => 'on',
"desc" => 'If ON selected, when the user hovers the image, the automatic rotation will pause.'
),

array(
"name"=>"Add Content Slider Image",
"id"=>'content_slider',
"type"=>"custom",
"button_text"=>'Add image',
"preview"=>"_content_image_name",
"fields"=>array(
	array('id'=>'_content_image_name', 'type'=>'upload', 'name'=>'Image URL'),
	array('id'=>'_content_image_title', 'type'=>'text', 'name'=>'Image Title'),
	array('id'=>'_content_image_link', 'type'=>'text', 'name'=>'Image Link'),
	array('id'=>'_content_image_desc', 'type'=>'textarea', 'name'=>'Image Description')
)
),

array(
"type"=>"multiple_custom",
"refers"=>"_content_slider_names",
"button_text"=>'Add image',
"preview"=>"_content_image_name",
"name"=>"Add image to ",
"fields"=>array(
	array('id'=>'_content_image_name', 'type'=>'upload', 'name'=>'Image URL'),
	array('id'=>'_content_image_title', 'type'=>'text', 'name'=>'Image Title'),
	array('id'=>'_content_image_link', 'type'=>'text', 'name'=>'Image Link'),
	array('id'=>'_content_image_desc', 'type'=>'textarea', 'name'=>'Image Description')
)
),

array(
"name"=>"Add new content slider",
"id"=>'content_sliders',
"type"=>"custom",
"desc" => 'You can add a new slider and insert a different set of images to it. After you add the new
slider, you have to press the "Save Changes" button.  After this the new section for adding images for the new slider
should be displayed just above this field.',
"button_text"=>'Add Slider',
"fields"=>array(
	array('id'=>'_content_slider_name', 'type'=>'text', 'name'=>'Slider Name')
)
),




array(
"type" => "close"),


/* ------------------------------------------------------------------------*
 * ACCORDION SLIDER
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'accordion'
),

array(
"name" => "Automatic image resizing",
"id" => PEXETO_SHORTNAME."_accord_auto_resize",
"type" => "checkbox",
"std" => 'off',
"desc" => 'If enabled, the images will be resized automatically.'
),

array(
"name"=>"Add Accordion Slider Image",
"id"=>'accordion_slider',
"type"=>"custom",
"button_text"=>'Add image',
"preview"=>"_accord_image_name",
"fields"=>array(
	array('id'=>'_accord_image_name', 'type'=>'upload', 'name'=>'Image URL'),
	array('id'=>'_accord_image_title', 'type'=>'text', 'name'=>'Image Title'),
	array('id'=>'_accord_image_link', 'type'=>'text', 'name'=>'Image Link'),
	array('id'=>'_accord_image_desc', 'type'=>'textarea', 'name'=>'Image Description')
)
),

array(
"type"=>"multiple_custom",
"refers"=>"_accord_slider_names",
"button_text"=>'Add image',
"preview"=>"_accord_image_name",
"name"=>"Add image to ",
"fields"=>array(
	array('id'=>'_accord_image_name', 'type'=>'upload', 'name'=>'Image URL'),
	array('id'=>'_accord_image_title', 'type'=>'text', 'name'=>'Image Title'),
	array('id'=>'_accord_image_link', 'type'=>'text', 'name'=>'Image Link'),
	array('id'=>'_accord_image_desc', 'type'=>'textarea', 'name'=>'Image Description')
)
),

array(
"name"=>"Add new accordion slider",
"id"=>'accordion_sliders',
"type"=>"custom",
"desc" => 'You can add a new slider and insert a different set of images to it. After you add the new
slider, you have to press the "Save Changes" button.  After this the new section for adding images for the new slider
should be displayed just above this field.',
"button_text"=>'Add Slider',
"fields"=>array(
	array('id'=>'_accord_slider_name', 'type'=>'text', 'name'=>'Slider Name')
)
),




array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * NIVO SLIDER
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'nivo'
),


array(
"name" => "Automatic image resizing",
"id" => PEXETO_SHORTNAME."_nivo_auto_resize",
"type" => "checkbox",
"std" => 'off',
"desc" => 'If enabled, the images will be resized automatically.'
),

array(
"name" => "Show navigation",
"id" => PEXETO_SHORTNAME."_nivo_navigation",
"type" => "multicheck",
"options" => array(array("id"=>"arrows", "name"=>"Arrows"), array("id"=>"buttons", "name"=>"Navigation Buttons")),
"class"=>"include",
"std" => "arrows,buttons"
),

array(
"name" => "Animation Effect",
"id" => PEXETO_SHORTNAME."_nivo_animation",
"type" => "select",
"options" => array(array('id'=>'random','name'=>'Random'),array('id'=>'fold','name'=>'Fold'),array('id'=>'fade','name'=>'Fade'),
array('id'=>'sliceDown','name'=>'Slice Down'),array('id'=>'sliceDownLeft','name'=>'Slice Down Left'),array('id'=>'sliceUp','name'=>'Slice Up'),
array('id'=>'sliceUpDown','name'=>'Slice Up Down'),array('id'=>'sliceUpLeft','name'=>'Slice Up Left'),array('id'=>'sliceUpDownLeft','name'=>'Slice Up Down Left'),array('id'=>'slideInRight','name'=>'Slide In Right'),array('id'=>'slideInLeft','name'=>'Slide In Left'),
array('id'=>'boxRandom','name'=>'Box Random'),array('id'=>'boxRain','name'=>'Box Rain'),array('id'=>'boxRainReverse','name'=>'Box Rain Reverse'),array('id'=>'boxRainGrow','name'=>'Box Rain Grow'),array('id'=>'boxRainGrowReverse','name'=>'Box Rain Grow Reverse')
),
"std" => 'random'
),

array(
"name" => "Number of slices",
"id" => PEXETO_SHORTNAME."_nivo_slices",
"type" => "text",
"std" => "15"
),

array(
"name" => "Number of box rows",
"id" => PEXETO_SHORTNAME."_nivo_rows",
"type" => "text",
"std" => "4",
"desc" => "For box animations only."
),

array(
"name" => "Number of box columns",
"id" => PEXETO_SHORTNAME."_nivo_columns",
"type" => "text",
"std" => "8",
"desc" => "For box animations only."
),

array(
"name" => "Animation Speed",
"id" => PEXETO_SHORTNAME."_nivo_speed",
"type" => "text",
"std" => "800",
"desc" => "The animation speed in miliseconds"
),

array(
"name" => "Pause interval",
"id" => PEXETO_SHORTNAME."_nivo_interval",
"type" => "text",
"std" => "3000",
"desc" => "The time interval between image changes in miliseconds"
),

array(
"name" => "Autoplay",
"id" => PEXETO_SHORTNAME."_nivo_autoplay",
"type" => "checkbox",
"std" => 'on',
"desc" => 'If enabled, the images will rotate automatically'
),

array(
"name" => "Pause on hover",
"id" => PEXETO_SHORTNAME."_nivo_pause_hover",
"type" => "checkbox",
"std" => 'on',
"desc" => 'If enabled, when the user hovers the image, the automatic rotation will pause.'
),

array(
"name"=>"Add Nivo Slider Image",
"id"=>'nivo_slider',
"type"=>"custom",
"button_text"=>'Add image',
"preview"=>"_nivo_image_name",
"fields"=>array(
	array('id'=>'_nivo_image_name', 'type'=>'upload', 'name'=>'Image URL'),
	array('id'=>'_nivo_image_link', 'type'=>'text', 'name'=>'Image Link'),
	array('id'=>'_nivo_image_desc', 'type'=>'textarea', 'name'=>'Image Description')
)
),

array(
"type"=>"multiple_custom",
"refers"=>"_nivo_slider_names",
"button_text"=>'Add image',
"preview"=>"_nivo_image_name",
"name"=>"Add image to ",
"fields"=>array(
	array('id'=>'_nivo_image_name', 'type'=>'upload', 'name'=>'Image URL'),
	array('id'=>'_nivo_image_link', 'type'=>'text', 'name'=>'Image Link'),
	array('id'=>'_nivo_image_desc', 'type'=>'textarea', 'name'=>'Image Description')
)
),

array(
"name"=>"Add new Nivo slider",
"id"=>'nivo_sliders',
"type"=>"custom",
"button_text"=>'Add Slider',
"desc" => 'You can add a new slider and insert a different set of images to it. After you add the new
slider, you have to press the "Save Changes" button.  After this the new section for adding images for the new slider
should be displayed just above this field.',
"fields"=>array(
	array('id'=>'_nivo_slider_name', 'type'=>'text', 'name'=>'Slider Name')
)
),


array(
"type" => "close"),


array(
"type" => "close"));

$new_pexeto_slider_options = pexeto_add_custom_options($pexeto_slider_options);

pexeto_add_options($new_pexeto_slider_options);