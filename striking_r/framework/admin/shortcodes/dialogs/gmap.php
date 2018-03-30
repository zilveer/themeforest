<?php
$init_script = <<<HTML
	jQuery('[name="controls"]').on("change",function(){
		if(this.checked){
			jQuery('.shortcode-item[data-option="panControl"]').show();
			jQuery('.shortcode-item[data-option="zoomControl"]').show();
			jQuery('.shortcode-item[data-option="mapTypeControl"]').show();
			jQuery('.shortcode-item[data-option="scaleControl"]').show();
			jQuery('.shortcode-item[data-option="streetViewControl"]').show();
			jQuery('.shortcode-item[data-option="overviewMapControl"]').show();
		}else{
			jQuery('.shortcode-item[data-option="panControl"]').hide();
			jQuery('.shortcode-item[data-option="zoomControl"]').hide();
			jQuery('.shortcode-item[data-option="mapTypeControl"]').hide();
			jQuery('.shortcode-item[data-option="scaleControl"]').hide();
			jQuery('.shortcode-item[data-option="streetViewControl"]').hide();
			jQuery('.shortcode-item[data-option="overviewMapControl"]').hide();
		}
	}).trigger("change");
HTML;
$custom_script = <<<HTML
	if(attrs['html'].value!=''){
		attrs['html'].value = attrs['html'].value.replace(/\\n/gi,"{linebreak}");
		attrs['html'].attributeText = attrs['html'].attributeText.replace(/\\n/gi,"{linebreak}");
	}
	return '[gmap' + this.builtAttributesChain(attrs) + '] ';
HTML;
return array(
	"title" => __("Google Map", "theme_admin"),
	"shortcode" => 'gmap',
	"type" => 'custom',
	"init" => $init_script,
	"custom" => $custom_script,
	"options" => array(
		array (
			"name" => __("Width (Optional)&#x200E;",'theme_admin'),
			"desc" => __("set to 0 is the full width",'theme_admin'),
			"id" => "width",
			"default" => "",
			"min" => 0,
			"max" => 960,
			"step" => "1",
			"units" => array('px','%'),
			'default_unit' => 'px',
			"type" => "measurement",
		),
		array (
			"name" => __("Height",'theme_admin'),
			"id" => "height",
			"default" => '400',
			"min" => 0,
			"max" => 960,
			"step" => "1",
			'unit' => 'px',
			"type" => "range",
		),
		array(
			"name" => __("Address (Optional)&#x200E;",'theme_admin'),
			"id" => "address",
			"size" => 30,
			"default" => "",
			"type" => "text",
		),
		array(
			"name" => __("Latitude",'theme_admin'),
			"id" => "latitude",
			"size" => 30,
			"default" => "",
			"type" => "text",
		),
		array(
			"name" => __("longitude",'theme_admin'),
			"id" => "longitude",
			"size" => 30,
			"default" => "",
			"type" => "text",
		),
		array (
			"name" => __("Zoom",'theme_admin'),
			"id" => "zoom",
			"default" => '14',
			"min" => 1,
			"max" => 19,
			"step" => "1",
			"type" => "range"
		),
		array (
			"name" => __("Marker",'theme_admin'),
			"id" => "marker",
			"default" => true,
			"type" => "toggle"
		),
		array (
			"name" => __("Html",'theme_admin'),
			"id" => "html",
			"size" => 30,
			"default" => "",
			"type" => "textarea",
		),
		array (
			"name" => __("Popup Marker",'theme_admin'),
			"id" => "popup",
			"default" => false,
			"type" => "toggle"
		),
		array (
			"name" => __("Controls",'theme_admin'),
			"id" => "controls",
			"default" => false,
			"type" => "toggle"
		),
		array (
			"name" => __("panControl",'theme_admin'),
			"id" => "panControl",
			"default" => true,
			"type" => "toggle"
		),
		array (
			"name" => __("zoomControl",'theme_admin'),
			"id" => "zoomControl",
			"default" => true,
			"type" => "toggle"
		),
		array (
			"name" => __("doubleClickZoom",'theme_admin'),
			"id" => "doubleclickzoom",
			"default" => true,
			"type" => "toggle"
		),
		array (
			"name" => __("mapTypeControl",'theme_admin'),
			"id" => "mapTypeControl",
			"default" => true,
			"type" => "toggle"
		),
		array (
			"name" => __("scaleControl",'theme_admin'),
			"id" => "scaleControl",
			"default" => true,
			"type" => "toggle"
		),
		array (
			"name" => __("streetViewControl",'theme_admin'),
			"id" => "streetViewControl",
			"default" => true,
			"type" => "toggle"
		),
		array (
			"name" => __("overviewMapControl",'theme_admin'),
			"id" => "overviewMapControl",
			"default" => true,
			"type" => "toggle"
		),
		array (
			"name" => __("Scrollwheel",'theme_admin'),
			"id" => "scrollwheel",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Maptype (Optional)&#x200E;",'theme_admin'),
			"id" => "maptype",
			"default" => 'ROADMAP',
			"prompt" => __("Choose one..",'theme_admin'),
			"options" => array(
				"ROADMAP" => __('Default road map','theme_admin'),
				"SATELLITE" => __('Google Earth satellite','theme_admin'),
				"HYBRID" => __('Mixture of normal and satellite','theme_admin'),
				"TERRAIN" => __('Physical map','theme_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Align (Optional)&#x200E;",'theme_admin'),
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
	),
);
