<?php
$init_script = <<<HTML
	jQuery('[name="type"]').on("change",function(){
		if(this.value === 'inline'){
			jQuery('.shortcode-item[data-option="inline_id"]').show();
			jQuery('.shortcode-item[data-option="inline_html"]').show();
			jQuery('.shortcode-item[data-option="href"]').hide();
		}else{
			jQuery('.shortcode-item[data-option="inline_id"]').hide();
			jQuery('.shortcode-item[data-option="inline_html"]').hide();
			jQuery('.shortcode-item[data-option="href"]').show();
		}
	}).trigger("change");
HTML;
$custom_script = <<<HTML
	var options = new Array();
	var extra = '';
	if(attrs['type'].value == 'inline'){
		attrs['href'].value = '#' + attrs['inline_id'].value;
		attrs['href'].attributeText = 'href="'+ attrs['href'].value +'"';
		extra = '<div class="hidden"><div id="'+ attrs['inline_id'].value +'">'+ attrs['inline_html'].value +'</div></div>';
	}

	var use = ['title','group','type','close','href','width','height','autoSize','autoWidth','autoHeight','fitToView','aspectRatio','closeClick','imageSource','imageEffect','imageWidth','imageHeight','imageAlign','imageIcon','imageSize'];
		
	for (x in use) {
		options[use[x]] = attrs[use[x]];
	}
	return '[lightbox' + this.builtAttributesChain(options) + ']'+  attrs['content'].value +'[/lightbox] '+ extra;
HTML;
return array(
	"title" => __("Lightbox", "theme_admin"),
	"shortcode" => 'lightbox',
	"type" => 'custom',
	"init" => $init_script,
	"custom" => $custom_script,
	"options" => array(
		array(
			"name" => __("Content",'theme_admin'),
			"id" => "content",
			"default" => "",
			"type" => "textarea"
		),
		array(
			"name" => __("Type",'theme_admin'),
			"desc" => __("Overrides type for content. ",'theme_admin'),
			"id" => "type",
			"default" => '',
			"options" => array(
				"" => __("None",'theme_admin'),
				"image" => __("Image",'theme_admin'),
				"inline" => __("Inline",'theme_admin'),
				"ajax" => __("Ajax",'theme_admin'),
				"iframe" => __("Iframe",'theme_admin'),
				"swf" => __("Swf",'theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Href",'theme_admin'),
			"id" => "href",
			"size" => 30,
			"default" => "",
			"type" => "text",
		),
		array(
			"name" => __("Inline Id",'theme_admin'),
			"desc" => __('unique id for inline content.','theme_admin'),
			"id" => "inline_id",
			"default" => '',
			"type" => "text"
		),
		array(
			"name" => __("Inline Html",'theme_admin'),
			"desc" => __('You can use shortcode here.','theme_admin'),
			"id" => "inline_html",
			"default" => '',
			"type" => "textarea"
		),
		array(
			"name" => __("Title",'theme_admin'),
			"desc" => __("The title you want to display on the bottom of the lightbox.",'theme_admin'),
			"id" => "title",
			"size" => 30,
			"default" => "",
			"type" => "text",
		),
		array (
			"name" => __("Group (Optional)&#x200E;",'theme_admin'),
			"desc" => __("This allows the user to group any combination of elements together for a gallery.",'theme_admin'),
			"id" => "group",
			"default" => '',
			"type" => "text"
		),
		array(
			"name" => __("Width (Optional)&#x200E;",'theme_admin'),
			"desc" => __("Default width for 'iframe' and 'swf' content. Also for 'inline', 'ajax' and 'html' if 'autoSize' is set to 'false'. Can be numeric or 'auto'.	",'theme_admin'),
			"id" => "width",
			"default" => 0,
			"min" => 0,
			"max" => 1200,
			"step" => "1",
			'unit' => 'px',
			"type" => "range",
		),
		array(
			"name" => __("Height (Optional)&#x200E;",'theme_admin'),
			"desc" => __("Default height for 'iframe' and 'swf' content. Also for 'inline', 'ajax' and 'html' if 'autoSize' is set to 'false'. Can be numeric or 'auto'. ",'theme_admin'),
			"id" => "height",
			"default" => 0,
			"min" => 0,
			"max" => 1000,
			"step" => "1",
			'unit' => 'px',
			"type" => "range",
		),
		array(
			"name" => __("autoSize",'theme_admin'),
			"desc" => __("If true, then sets both autoHeight and autoWidth to true.",'theme_admin'),
			"id" => "autoSize",
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("autoHeight",'theme_admin'),
			"desc" => __("If set to true, for 'inline', 'ajax' and 'html' type content width is auto determined. If no dimensions set this may give unexpected results.",'theme_admin'),
			"id" => "autoHeight",
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("autoWidth",'theme_admin'),
			"desc" => __("If set to true, for 'inline', 'ajax' and 'html' type content height is auto determined. If no dimensions set this may give unexpected results.",'theme_admin'),
			"id" => "autoWidth",
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("fitToView",'theme_admin'),
			"desc" => __("If set to true, fancyBox is resized to fit inside viewport before opening.",'theme_admin'),
			"id" => "fitToView",
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("aspectRatio",'theme_admin'),
			"desc" => __("If set to true, resizing is constrained by the original aspect ratio (images always keep ratio).",'theme_admin'),
			"id" => "aspectRatio",
			"default" => 'default',
			"type" => "tritoggle"
		),
		array (
			"name" => __("Display Close Button",'theme_admin'),
			"id" => "close",
			"default" => 'default',
			"type" => "tritoggle"
		),
		array (
			"name" => __("Fancybox close Click",'theme_admin'),
			"desc" => __("If you enable this option, fancyBox will be closed when user clicks the content.",'theme_admin'),
			"id" => "closeClick",
			"default" => 'default',
			"type" => "tritoggle"
		),
		array(
			"name" => __("Image Source (Optional)&#x200E;",'theme_admin'),
			"desc" => __("If you select a image, the lightbox will show this image for trigger content",'theme_admin'),
			"id" => "imageSource",
			"size" => 30,
			"default" => "",
			"type" => "upload",
		),
		array(
			"name" => __("Image Alignment (Optional)&#x200E;",'theme_admin'),
			"desc" => __("If you choose to left or right align an image, except when the image is full column width in size, subsequent text will wrap to the side of the image",'theme_admin'),
			"id" => "imageAlign",
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
			"name" => __("Image Effect (Optional)&#x200E;",'theme_admin'),
			"desc" => __("The effect that occures when a cursor hovers over the image. An Icon can be used to imply a link to something, and the grayscale is a fancy black and white hover effect",'theme_admin'),
			"id" => "imageEffect",
			"default" => 'icon',
			"options" => array(
				"icon" => __("Icon",'theme_admin'),
				"grayscale" => __("Grayscale",'theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Image Icon (Optional)&#x200E;",'theme_admin'),
			"desc" => __("If you selected Icon above, here you select the type of icon you want to appear over the image on mouse hover",'theme_admin'),
			"id" => "imageIcon",
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
			"name" => __("Image Size (Optional)&#x200E;",'theme_admin'),
			"desc" => __("Here you choose the size of the image you want to display in the post - the image sizes are as per the Striking Image Panel settings. Or you can use the width & height settings below to set a custom size",'theme_admin'),
			"id" => "imageSize",
			"default" => '',
			"prompt" => __("Choose one..",'theme_admin'),
			"options" => theme_get_image_size(),
			"type" => "select",
		),
		array (
			"name" => __("Image Width (Optional)&#x200E;",'theme_admin'),
			"id" => "imageWidth",
			"default" => 0,
			"min" => 0,
			"max" => 960,
			"step" => "1",
			"type" => "range"
		),
		array (
			"name" => __("Image Height (Optional)&#x200E;",'theme_admin'),
			"desc" => __("For height you have two choices, set a custom height, or if you have set a width but are unsure of height, use the Auto Adjust Height setting below which sets height scaling automatically for any custom width set above",'theme_admin'),
			"id" => "imageHeight",
			"default" => 0,
			"min" => 0,
			"max" => 960,
			"step" => "1",
			"type" => "range"
		),
	),
);