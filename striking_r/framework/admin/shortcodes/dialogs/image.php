<?php
return array(
	"title" => __("Image", "theme_admin"),
	"shortcode" => 'image',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Image Source",'theme_admin'),
			"id" => "source",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => __("Image Url Source (optional)",'theme_admin'),
			"id" => "upload_source_url",
			"size" => 60,
			"default" => "",
			"type" => "text",
		),
		array(
			"name" => __("Image Caption",'theme_admin'),
			"desc" => __("The text you want to appear under the image in the post content. The text is centered under the image by default",'theme_admin'),
			"size" => 60,
			"id" => "caption",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => __("Alt tag text",'theme_admin'),
			"desc" => __("The alt tag text added to the image.",'theme_admin'),
			"id" => "alt",
			"size" => 60,
			"default" => "",
			"type" => "text",
		),
		array(
			"name" => __("Image Alignment (Optional)&#x200E;",'theme_admin'),
			"desc" => __("If you choose to left or right align an image, except when the image is full column width in size, subsequent text will wrap to the side of the image",'theme_admin'),
			"id" => "align",
			"default" => '',
			"prompt" => __("Choose one..",'theme_admin'),
			"options" => array(
				"left" => __('Left','theme_admin'),
				"right" => __('Right','theme_admin'),
				"center" => __('Center','theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Effect",'theme_admin'),
			"desc" => __("The effect that occures when a cursor hovers over the image. An Icon can be used to imply a link to something, and the grayscale is a fancy black and white hover effect",'theme_admin'),
			"id" => "effect",
			"default" => 'icon',
			"options" => array(
				"icon" => __("Icon",'theme_admin'),
				"grayscale" => __("Grayscale",'theme_admin'),
				"blur" => __("Blur",'theme_admin'),
				"zoom" => __("Zoom",'theme_admin'),
				"rotate" => __("Rotate",'theme_admin'),
				"morph" => __("Morph",'theme_admin'),
				"tilt" => __("Tilt",'theme_admin'),
				"none" => __("None",'theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Icon (Optional)&#x200E;",'theme_admin'),
			"desc" => __("If you selected Icon above, here you select the type of icon you want to appear over the image on mouse hover",'theme_admin'),
			"id" => "icon",
			"default" => '',
			"prompt" => __("Choose one..",'theme_admin'),
			"options" => array(
				"zoom" => __('Zoom','theme_admin'),
				"play" => __('Play','theme_admin'),
				"doc" => __('Doc','theme_admin'),
				"link" => __('Link','theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Size (Optional)&#x200E;",'theme_admin'),
			"desc" => __("Here you choose the size of the image you want to display in the post - the image sizes are as per the Striking Image Panel settings. Or you can use the width & height settings below to set a custom size",'theme_admin'),
			"id" => "size",
			"default" => '',
			"prompt" => __("Choose one..",'theme_admin'),
			"options" => theme_get_image_size(),
			"type" => "select",
		),
		array (
			"name" => __("Width (Optional)&#x200E;",'theme_admin'),
			"id" => "width",
			"default" => 0,
			"min" => 0,
			"max" => 960,
			"step" => "1",
			"type" => "range"
		),
		array (
			"name" => __("Auto Fit layout in mobile view",'theme_admin'),
			"id" => "fitMobile",
			"default" => false,
			"type" => "toggle"
		),
		array (
			"name" => __("Height (Optional)&#x200E;",'theme_admin'),
			"desc" => __("For height you have two choices, set a custom height, or if you have set a width but are unsure of height, use the Auto Adjust Height setting below which sets height scaling automatically for any custom width set above",'theme_admin'),
			"id" => "height",
			"default" => 0,
			"min" => 0,
			"max" => 960,
			"step" => "1",
			"type" => "range"
		),
		array (
			"name" => __("Auto Adjust Height",'theme_admin'),
			"id" => "autoHeight",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Link (Optional)&#x200E;",'theme_admin'),
			"desc" => __("If you want, you can have it so that clicking on the picture links to something else, and here you input the url for that alternative",'theme_admin'),
			"size" => 60,
			"id" => "link",
			"default" => "",
			"type" => "text",
		),
		array(
			"name" => __("Link Target (Optional)&#x200E;",'theme_admin'),
			"desc" => __("If you set a Link above, you have to decide whether you want the link to open in the same page, go to another page, etc",'theme_admin'),
			"id" => "linkTarget",
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
		array (
			"name" => __("Quality (Optional)&#x200E;",'theme_admin'),
			"desc" => __("If you started with a high quality picture, you can increase this but if a low quality picture, do not as it will further distort the image",'theme_admin'),
			"id" => "quality",
			"default" => 75,
			"min" => 75,
			"max" => 100,
			"step" => "1",
			"type" => "range"
		),
		array (
			"name" => __("Lightbox",'theme_admin'),
			"desc" => __("This is for when you choose to have the image pop up in a lightbox. ",'theme_admin'),
	"id" => "lightbox",
			"default" => false,
			"type" => "toggle"
		),
		array (
			"name" => __("Lightbox group (Optional)&#x200E;",'theme_admin'),
			"desc" => __("You can have several images in post body appear together in a lightbox if you put in the same name in this field for each of them - the field functions as a class id to link them",'theme_admin'),
			"id" => "group",
			"size" => 20,
			"default" => '',
			"type" => "text"
		),
		array(
			"name" => __("Lightbox Image Dimension Restriction",'theme_admin'),
			"desc" => __("If you enable this option, the lightbox dimension will be restricted to fit the browse screen size.",'theme_admin'),
			"id" => "lightbox_fittoview",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Lightbox Caption (Optional)&#x200E;",'theme_admin'),
			"desc" => __("The wording appearing under the lightbox once it opens up. It is centered under the image by default.",'theme_admin'),
			"id" => "title",
			"size" => 60,
			"default" => "",
			"type" => "text",
		),
	
	),
	"custom" => '',
);