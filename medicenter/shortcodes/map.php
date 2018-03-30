<?php
global $themename;
//google map
function theme_map_shortcode($atts)
{
	extract(shortcode_atts(array(
		"id" => "map",
		"width" => "100%",
		"height" => "300px",
		"map_type" => "ROADMAP",
		"lat" => "-37.732304",
		"lng" => "144.868641",
		"marker_lat" => "-37.732304",
		"marker_lng" => "144.868641",
		"zoom" => "12",
		"scrollwheel" => "true",
		"streetviewcontrol" => "false",
		"maptypecontrol" => "false",
		"map_icon_url" => get_template_directory_uri() . "/images/map_pointer.png",
		"icon_width" => 38,
		"icon_height" => 45,
		"icon_anchor_x" => 18,
		"icon_anchor_y" => 44,
		"top_margin" => "page_margin_top"
	), $atts));
	
	$map_type = strtoupper($map_type);
	$width = (substr($width, -1)!="%" && substr($width, -2)!="px" ? $width . "px" : $width);
	$height = (substr($height, -1)!="%" && substr($height, -2)!="px" ? $height . "px" : $height);
	$output = "<div id='" . $id . "'" . ($width!="" || $height!="" ? " style='" . ($width!="" ? "width:" . $width . ";" : "") . ($height!="" ? "height:" . $height . ";" : "") . "'" : "") . ($top_margin!="none" ? " class='" . $top_margin . "'" : "") . "></div>
	<script type='text/javascript'>
	if(typeof(theme_google_maps)=='undefined') 
	{
		var theme_google_maps=[];
	}
	var map_$id = null;
	var coordinate_$id;
	try
    {
        coordinate_$id=new google.maps.LatLng($lat, $lng);
        var mapOptions= 
        {
            zoom:$zoom,
			scrollwheel: $scrollwheel,
            center:coordinate_$id,
            mapTypeId:google.maps.MapTypeId.$map_type,
			streetViewControl:$streetviewcontrol,
			mapTypeControl:$maptypecontrol
        };
        var map_$id = new google.maps.Map(document.getElementById('$id'),mapOptions);
		theme_google_maps.push({map: map_$id, coordinate: coordinate_$id});
		";		
	if($marker_lat!="" && $marker_lng!="")
	{
	$output .= "
		var marker_$id = new google.maps.Marker({
			position: new google.maps.LatLng($marker_lat, $marker_lng),
			map: map_$id" . ($map_icon_url!="" ? ", icon: new google.maps.MarkerImage('$map_icon_url', new google.maps.Size($icon_width, $icon_height), null, new google.maps.Point($icon_anchor_x, $icon_anchor_y))" : "") . "
		});";
		/*var infowindow = new google.maps.InfoWindow();
		infowindow.setContent('<p style=\'color:#000;\'>your html content</p>');
		infowindow.open(map_$id,marker_$id);*/
	}
	$output .= "
    }
    catch(e) {};
	jQuery(document).ready(function($){
		$(window).resize(function(){
			if(map_$id!=null)
				map_$id.setCenter(coordinate_$id);
		});
	});
	</script>";
	return $output;
}
add_shortcode($themename . "_map", "theme_map_shortcode");
//visual composer
function theme_google_map_vc_init()
{
	global $theme_options;
	vc_map( array(
		"name" => __("Google map", 'medicenter'),
		"base" => "medicenter_map",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-map-pin",
		"category" => __('MediCenter', 'medicenter'),
		"params" => array(
			array(
				"type" => "readonly",
				"class" => "",
				"heading" => __("Google API Key", 'medicenter'),
				"param_name" => "api_key",
				"value" => $theme_options["google_api_code"],
				"description" => __("Please provide valid Google API Key under <a href='" . admin_url("themes.php?page=ThemeOptions") . "' title='Theme Options'>Theme Options</a>", 'medicenter')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Id", 'medicenter'),
				"param_name" => "id",
				"value" => "map",
				"description" => __("Please provide unique id for each map on the same page/post.<br/>Use only lowercase letters from a to z and underscores, don't use spaces and dashes as they will cause issues.", 'medicenter')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Width", 'medicenter'),
				"param_name" => "width",
				"value" => "100%"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Height", 'medicenter'),
				"param_name" => "height",
				"value" => "300px"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Map type", 'medicenter'),
				"param_name" => "map_type",
				"value" => array(__("Roadmap", 'medicenter') => "ROADMAP", __("Satellite", 'medicenter') => "SATELLITE", __("Hybrid", 'medicenter') => "HYBRID", __("Terrain", 'medicenter') => "TERRAIN")
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Latitude", 'medicenter'),
				"param_name" => "lat",
				"value" => "-37.732304",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'medicenter')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Longitude", 'medicenter'),
				"param_name" => "lng",
				"value" => "144.868641",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'medicenter')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Marker/Point Latitude", 'medicenter'),
				"param_name" => "marker_lat",
				"value" => "-37.732304",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'medicenter')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Marker/point Longitude", 'medicenter'),
				"param_name" => "marker_lng",
				"value" => "144.868641",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'medicenter')
			),
			array(
				"type" => "dropdown",
				"heading" => __("Map Zoom", "js_composer"),
				"param_name" => "zoom",
				"value" => array(__("12 - Default", "js_composer") => 12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 14, 15, 16, 17, 18, 19, 20)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Street view control", 'medicenter'),
				"param_name" => "streetviewcontrol",
				"value" => array(__("no", 'medicenter') => "false", __("yes", 'medicenter') => "true")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Enable scrollwheel", 'medicenter'),
				"param_name" => "scrollwheel",
				"value" => array(__("yes", 'medicenter') => "true", __("no", 'medicenter') => "false")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Map type control", 'medicenter'),
				"param_name" => "maptypecontrol",
				"value" => array(__("no", 'medicenter') => "false", __("yes", 'medicenter') => "true")
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Marker/Point icon url", 'medicenter'),
				"param_name" => "map_icon_url",
				"value" => get_template_directory_uri() . "/images/map_pointer.png"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon width", 'medicenter'),
				"param_name" => "icon_width",
				"value" => 38
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon height", 'medicenter'),
				"param_name" => "icon_height",
				"value" => 45
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon anchor x", 'medicenter'),
				"param_name" => "icon_anchor_x",
				"value" => 18
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon anchor y", 'medicenter'),
				"param_name" => "icon_anchor_y",
				"value" => 44
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Top margin", 'medicenter'),
				"param_name" => "top_margin",
				"value" => array(__("Page (small)", 'medicenter') => "page_margin_top", __("Section (large)", 'medicenter') => "page_margin_top_section",  __("None", 'medicenter') => "none")
			)
		)
	));
}
add_action("init", "theme_google_map_vc_init");
?>