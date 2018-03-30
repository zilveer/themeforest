<?php

$options = array(

	// IMAGE SETTINGS



array("name" => "Image resizing method",
"id" => "",
"desc" => "Dynamic image resizing (recommended) resizes images on the fly, and can be changed at any time. Wordpress default image resizing only resizes the image once ( when you upload the image ). This theme does not use timthumb for resizing images because of security issues with the timthumb script.",
"type" => "subheading"),

array("name" => "Select image resizing method",
"desc" => "",
"id" => $shortname."_image_resize",
"type" => "radiogroup",
"std" => "wordpress",
"options" => array(
		'wordpress' => "Wordpress default",
		'vt-resize'  => "Dynamic resizing"
	),
),



array("name" => "Image heights",
"id" => "",
"desc" => "Here you can define height for featured images. Since this is a responsive theme, these image sizes will change according to the window width.",
"type" => "subheading"),


array("name" => "Slider image height",
"desc" => "The height of images in slideshow. Width = 900px",
"id" => $shortname."_thumbnail_slideshowfullwidth_image_height",
"type" => "text",
"std" => ""),


array("name" => "Image height - 4 column featured pages module",
"desc" => "The height of featured images in featured pages module - 4 column grid. Width = 210px",
"id" => $shortname."_thumbnail_featured_image_height",
"type" => "text",
"std" => ""),

array("name" => "Image height - 4 column portfolio",
"desc" => "The height of featured images in portfolio lists - 4 column grid. Width = 210px",
"id" => $shortname."_thumbnail_210_image_height",
"type" => "text",
"std" => ""),

array("name" => "Image height - 3 column  portfolio",
"desc" => "The height of featured images in portfolio lists - 3 column grid. Width = 290px",
"id" => $shortname."_thumbnail_280_image_height",
"type" => "text",
"std" => ""),

array("name" => "Image height - 2 column portfolio",
"desc" => "The height of featured images in portfolio lists - 2 column grid. Width = 440px",
"id" => $shortname."_thumbnail_430_image_height",
"type" => "text",
"std" => ""),

array("name" => "Image height - regular post images",
"desc" => "The height of featured images in pages and post with sidebar. Width = 590px",
"id" => $shortname."_thumbnail_590_image_height",
"type" => "text",
"std" => ""),

array("name" => "Image height - fullwidth post images",
"desc" => "The height of featured images in pages and post without sidebar. Width = 900px",
"id" => $shortname."_thumbnail_900_image_height",
"type" => "text",
"std" => ""),


);

return apply_filters('epic_theme_images_options', $options);	

?>