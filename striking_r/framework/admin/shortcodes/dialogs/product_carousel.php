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
	"title" => __("Product Carousel",'theme_admin'),
	"shortcode" => 'product_carousel',
	"init" => $init_script,
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Image Width",'theme_admin'),
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
			"id" => "title",
			"default" => "",
			"type" => "text",
			"class" => 'full'
		),
		array (
			"name" => __("Nav",'theme_admin'),
			"id" => "nav",
			"default" => false,
			"type" => "toggle"
		),
		array (
			"name" => __("Autoplay",'theme_admin'),
			"id" => "autoplay",
			"default" => true,
			"type" => "toggle"
		),
		array (
			"name" => __("Circular",'theme_admin'),
			"id" => "circular",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Delay",'theme_admin'),
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
			"id" => "touch",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Post Type",'theme_admin'),
			"id" => "post_type",
			"default" => '',
			"target" => 'thumbnail_custom_post_types',
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
			"name" => __("Number of images",'theme_admin'),
			"id" => "number",
			"min" => "0",
			"max" => "15",
			"step" => "1",
			"default" => "0",
			"type" => "range"
		),
		array (
			"name" => __("Random",'theme_admin'),
			"id" => "random",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Link Target",'theme_admin'),
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
	),
);
