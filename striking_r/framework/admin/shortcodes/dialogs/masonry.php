<?php
$init_script = <<<HTML
	jQuery('[name="post_type"]').on("change",function(){
		var val = jQuery(this).val();
		
		$.post(ajaxurl, {
			action:'theme-get-taxonomies',
			post_type: val,
			cookie: encodeURIComponent(document.cookie)
		}, function(data){
			jQuery('[name="taxonomy"]').html(data);
		});
		jQuery('[name="terms[]"]').html('');
	}).trigger("change");

	jQuery('[name="taxonomy"]').on("change", function(){
		var val = jQuery(this).val();
		
		$.post(ajaxurl, {
			action:'theme-get-terms',
			taxonomy: val,
			cookie: encodeURIComponent(document.cookie)
		}, function(data){
			jQuery('[name="terms[]"]').html(data);
		});
	});
HTML;
return array(
	"title" => __("Masonry", "theme_admin"),
	"shortcode" => 'masonry',
	"init" => $init_script,
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Column",'theme_admin'),
			"id" => "column",
			"default" => '3',
			"options" => array(
				"2" => sprintf(__("%d Columns",'theme_admin'),2),
				"3" => sprintf(__("%d Columns",'theme_admin'),3),
				"4" => sprintf(__("%d Columns",'theme_admin'),4),
				"5" => sprintf(__("%d Columns",'theme_admin'),5),
			),
			"type" => "select",
		),
		array(
			"name" => __("Post Type",'theme_admin'),
			"id" => "post_type",
			"default" => 'post',
			"target" => 'thumbnail_buildin_post_types',
			"type" => "select",
		),
		array(
			"name" => __("Taxonomy (Optional)&#x200E;",'theme_admin'),
			"id" => "taxonomy",
			"default" => '',
			"options" => array(),
			"type" => "select",
		),
		array(
			"name" => __("Taxonomy terms (Optional)&#x200E;",'theme_admin'),
			"id" => "terms",
			"default" => '',
			"options" => array(),
			"type" => "multiselect",
		),
		array(
			"name" => __("Random Order",'theme_admin'),
			"id" => "random",
			"default" => false,
			"type" => "toggle"
		),		
		array(
			"name" => __("Display Title",'theme_admin'),
			"id" => "title",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Display Description",'theme_admin'),
			"id" => "desc",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Length of Description",'theme_admin'),
			"desc" => __("If it's set to 0, it will use default setting",'theme_admin'),
			"id" => "desc_length",
			"default" => '0',
			"min" => 0,
			"max" => 200,
			"step" => "1",
			"type" => "range"
		),
		array(
			"name" => __("Enable Pagination",'theme_admin'),
			"id" => "paging",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Number",'theme_admin'),
			"desc" => __("Number of posts to show per page",'theme_admin'),
			"id" => "number",
			"default" => '10',
			"min" => 1,
			"max" => 50,
			"step" => "1",
			"type" => "range"
		),
		array (
			"name" => __("Lightbox",'theme_admin'),
			"desc" => __("Enable lightbox support when click on the image",'theme_admin'),
			"id" => "lightbox",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("fitToView",'theme_admin'),
			"desc" => __("If set to true, fancyBox is resized to fit inside viewport before opening.",'theme_admin'),
			"id" => "lightbox_fitToView",
			"default" => 'default',
			"type" => "tritoggle"
		),
	)
);
