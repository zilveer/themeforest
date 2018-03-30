<?php
global $themename;
//contact info - old shortcode for compatibility with old content
function theme_contact_info($atts, $content)
{
	extract(shortcode_atts(array(
		"top_margin" => "page_margin_top"
	), $atts));
	return '<div class="contact_details ' . $top_margin . '">' . do_shortcode($content) . '</div>';
	
}
add_shortcode("contact_info", "theme_contact_info");

//visual composer
//vc_map( array(
//	"name" => __("Contact Info Old", 'gymbase'),
//	"base" => "contact_info",
//	"class" => "",
//	"controls" => "full",
//	"show_settings_on_create" => true,
//	"icon" => "icon-wpb-layer-shape-text",
//	"category" => __('GymBase', 'gymbase'),
//	"params" => array(
//		array(
//			"type" => "textarea",
//			"class" => "",
//			"heading" => __("Details", 'gymbase'),
//			"param_name" => "content",
//			"description" => __("Please provide your contact details, use shortcodes: [contact_details] [gymbase_map]", 'gymbase'),
//			"value" => ""
//		),
//		array(
//			"type" => "dropdown",
//			"class" => "",
//			"heading" => __("Top margin", 'gymbase'),
//			"param_name" => "top_margin",
//			"value" => array( __("Page (small)", 'gymbase') => "page_margin_top", __("Section (large)", 'gymbase') => "page_margin_top_section", __("None", 'gymbase') => "page_margin_top_none")
//		)
//	)
//));

//contact info - new shortcode, compatible with VC
function theme_contact_info_vc($atts, $content)
{
	extract(shortcode_atts(array(
		"id" => "map",
		"class" => "contact_details_map",
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
		"icon_width" => 29,
		"icon_height" => 38,
		"icon_anchor_x" => 14,
		"icon_anchor_y" => 37,
		"top_margin" => "page_margin_top"
	), $atts));
	
	// contact details shortcode, compatibility with old content
	$contact_details_shortcode = '[contact_details]' . preg_replace('#(\[[\/]?contact_details\]|\[gymbase_map[^\]]*\])#', '', $content) . '[/contact_details]';
	
	// google map shortcode
	if($id!="" && $lat!="" && $lng!="" && $marker_lat!="" && $marker_lng!="") {
		$map_shortcode = '[gymbase_map id="' . $id . '" class="' . $class . '" map_type="' . $map_type . '" lat="' . $lat . '" lng="' . $lng . '" marker_lat="' . $marker_lat . '" marker_lng="' . $marker_lng . '" zoom="' . $zoom . '" scrollwheel="' . $scrollwheel . '" streetviewcontrol="' . $streetviewcontrol . '" maptypecontrol="' . $maptypecontrol . '" map_icon_url="' . $map_icon_url . '" icon_width="' . $icon_width . '" icon_height="' . $icon_height . '" icon_anchor_x="' . $icon_anchor_x . '" icon_anchor_y="' . $icon_anchor_y . '"]';
	}
	
	return '<div class="contact_details ' . $top_margin . '">' . do_shortcode($contact_details_shortcode) . do_shortcode($map_shortcode) . '</div>';
}
add_shortcode("contact_info_vc", "theme_contact_info_vc");

//visual composer
function gb_theme_google_map_vc_init()
{
	global $theme_options;
	vc_map( array(
		"name" => __("Contact Info", 'gymbase'),
		"base" => "contact_info_vc",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-testimonials",
		"category" => __('GymBase', 'gymbase'),
		"params" => array(
			array(
				"type" => "readonly",
				"class" => "",
				"heading" => __("Google API Key", 'carservice'),
				"param_name" => "api_key",
				"value" => $theme_options["google_api_code"],
				"description" => __("Please provide valid Google API Key under <a href='" . admin_url("themes.php?page=ThemeOptions") . "' title='Theme Options'>Theme Options</a>", 'carservice')
			),
			array(
				"type" => "textarea",
				"class" => "",
				"heading" => __("Details", 'gymbase'),
				"param_name" => "content",
				"description" => __("Please provide your contact details, don't use shortcodes: [contact_details] [gymbase_map]", 'gymbase'),
				"value" => ""
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Id", 'gymbase'),
				"param_name" => "id",
				"value" => "map",
				"description" => __("Please provide unique id for each map on the same page/post", 'gymbase')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Class", 'gymbase'),
				"param_name" => "class",
				"value" => "contact_details_map",
				"description" => __("Specifies custom class for the map container.", 'gymbase')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Map type", 'gymbase'),
				"param_name" => "map_type",
				"value" => array(__("Roadmap", 'gymbase') => "ROADMAP", __("Satellite", 'gymbase') => "SATELLITE", __("Hybrid", 'gymbase') => "HYBRID", __("Terrain", 'gymbase') => "TERRAIN")
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Latitude", 'gymbase'),
				"param_name" => "lat",
				"value" => "-37.732304",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'gymbase')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Longitude", 'gymbase'),
				"param_name" => "lng",
				"value" => "144.868641",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'gymbase')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Marker/Point Latitude", 'gymbase'),
				"param_name" => "marker_lat",
				"value" => "-37.732304",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'gymbase')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Marker/point Longitude", 'gymbase'),
				"param_name" => "marker_lng",
				"value" => "144.868641",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'gymbase')
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
				"heading" => __("Street view control", 'gymbase'),
				"param_name" => "streetviewcontrol",
				"value" => array(__("no", 'gymbase') => "false", __("yes", 'gymbase') => "true")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Enable scrollwheel", 'gymbase'),
				"param_name" => "scrollwheel",
				"value" => array(__("yes", 'gymbase') => "true", __("no", 'gymbase') => "false")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Map type control", 'gymbase'),
				"param_name" => "maptypecontrol",
				"value" => array(__("no", 'gymbase') => "false", __("yes", 'gymbase') => "true")
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Marker/Point icon url", 'gymbase'),
				"param_name" => "map_icon_url",
				"value" => get_template_directory_uri() . "/images/map_pointer.png"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon width", 'gymbase'),
				"param_name" => "icon_width",
				"value" => 29
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon height", 'gymbase'),
				"param_name" => "icon_height",
				"value" => 38
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon anchor x", 'gymbase'),
				"param_name" => "icon_anchor_x",
				"value" => 14
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon anchor y", 'gymbase'),
				"param_name" => "icon_anchor_y",
				"value" => 37
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Top margin", 'gymbase'),
				"param_name" => "top_margin",
				"value" => array( __("Page (small)", 'gymbase') => "page_margin_top", __("Section (large)", 'gymbase') => "page_margin_top_section", __("None", 'gymbase') => "page_margin_top_none")
			)
		)
	));
}
add_action("init", "gb_theme_google_map_vc_init");

//google map details
function theme_contact_details($atts, $content)
{
	global $theme_options;
	
	$output = '<div class="contact_details_about">';
	if($theme_options["contact_logo_first_part_text"]!="")
		$output .= '<span class="logo_left">' . $theme_options["contact_logo_first_part_text"] . '</span>';
	if($theme_options["contact_logo_second_part_text"]!="")
		$output .= '<span class="logo_right">' . $theme_options["contact_logo_second_part_text"] . '</span>';
	$output .= do_shortcode(apply_filters('the_content', $content));
	if($theme_options["contact_phone"]!="" || $theme_options["contact_fax"]!="" || $theme_options["contact_email"]!="")
		$output .= '<ul class="contact_data">'
			. ($theme_options["contact_phone"]!="" ? '<li class="phone">' . $theme_options["contact_phone"] . '</li>' : '')
			. ($theme_options["contact_fax"]!="" ? '<li class="fax">' . $theme_options["contact_fax"] . '</li>' : '')		
			. ($theme_options["contact_email"]!="" ? '<li class="email">' . $theme_options["contact_email"] . '</li>' : '')				
		. '</ul>';
	$output .= '</div>';
	return $output;
}
add_shortcode("contact_details", "theme_contact_details");

//google map
function theme_map_shortcode($atts)
{
	extract(shortcode_atts(array(
		"id" => "map",
		"class" => "contact_details_map",
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
		"icon_width" => 29,
		"icon_height" => 38,
		"icon_anchor_x" => 14,
		"icon_anchor_y" => 37,
		"top_margin" => "page_margin_top_none"
	), $atts));

	$output = "<div id='" . $id . "' class='" . $class . " " . $top_margin . "'></div>
	<script type='text/javascript'>
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
        var map_$id = new google.maps.Map(document.getElementById('$id'),mapOptions);";
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
	vc_map( array(
		"name" => __("Google map", 'gymbase'),
		"base" => "gymbase_map",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-map-pin",
		"category" => __('GymBase', 'gymbase'),
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Id", 'gymbase'),
				"param_name" => "id",
				"value" => "map",
				"description" => __("Please provide unique id for each map on the same page/post", 'gymbase')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Class", 'gymbase'),
				"param_name" => "class",
				"value" => "contact_details_map",
				"description" => __("Specifies custom class for the map container.", 'gymbase')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Map type", 'gymbase'),
				"param_name" => "map_type",
				"value" => array(__("Roadmap", 'gymbase') => "ROADMAP", __("Satellite", 'gymbase') => "SATELLITE", __("Hybrid", 'gymbase') => "HYBRID", __("Terrain", 'gymbase') => "TERRAIN")
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Latitude", 'gymbase'),
				"param_name" => "lat",
				"value" => "-37.732304",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'gymbase')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Longitude", 'gymbase'),
				"param_name" => "lng",
				"value" => "144.868641",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'gymbase')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Marker/Point Latitude", 'gymbase'),
				"param_name" => "marker_lat",
				"value" => "-37.732304",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'gymbase')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Marker/point Longitude", 'gymbase'),
				"param_name" => "marker_lng",
				"value" => "144.868641",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'gymbase')
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
				"heading" => __("Street view control", 'gymbase'),
				"param_name" => "streetviewcontrol",
				"value" => array(__("no", 'gymbase') => "false", __("yes", 'gymbase') => "true")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Enable scrollwheel", 'gymbase'),
				"param_name" => "scrollwheel",
				"value" => array(__("yes", 'gymbase') => "true", __("no", 'gymbase') => "false")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Map type control", 'gymbase'),
				"param_name" => "maptypecontrol",
				"value" => array(__("no", 'gymbase') => "false", __("yes", 'gymbase') => "true")
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Marker/Point icon url", 'gymbase'),
				"param_name" => "map_icon_url",
				"value" => get_template_directory_uri() . "/images/map_pointer.png"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon width", 'gymbase'),
				"param_name" => "icon_width",
				"value" => 29
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon height", 'gymbase'),
				"param_name" => "icon_height",
				"value" => 38
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon anchor x", 'gymbase'),
				"param_name" => "icon_anchor_x",
				"value" => 14
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon anchor y", 'gymbase'),
				"param_name" => "icon_anchor_y",
				"value" => 37
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Top margin", 'gymbase'),
				"param_name" => "top_margin",
				"value" => array(__("None", 'gymbase') => "page_margin_top_none", __("Page (small)", 'gymbase') => "page_margin_top", __("Section (large)", 'gymbase') => "page_margin_top_section")
			)
		)
	));
}
add_action("init", "theme_google_map_vc_init");

?>