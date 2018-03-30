<?php
/*GOOGLE MAP*/
add_shortcode('vc_g_map', 'vc_g_map_f');
function vc_g_map_f( $atts, $content = null)
{
	extract(shortcode_atts(
		array(
			'address' => '7th Ave, New York, NY',
			'zoom' => '13',
			'height' => '450px',
		), $atts)
	);
	$content ='<div id="map" style="height:'.$height.'">
			   </div>
			   <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
			   <script>
				jQuery.noConflict()(function($){
				$("#map").gmap3({
					
					marker:{     
					// address:"93 Worth St, New York, NY",
					address :"'.$address.'", 
					options:{ icon: "'.get_template_directory_uri().'/framework/css/img/marker.png"}},
					map:{
					options:{
					styles: [ {
					stylers: [ { "saturation":-100 }, { "lightness": 0 }, { "gamma": 0.5 }]},
					],
					zoom: '.$zoom.',
					scrollwheel:false,
					draggable: true }
					}
					});	
				});
				</script>';
	return $content;
};

vc_map( array(
	"name" => __("Google Map",'orangeidea'),
	"base" => "vc_g_map",
	"admin_enqueue_css" => array(get_template_directory_uri().'/framework/vc_extend/style.css'),
	"class" => "",
	"category" => __('BUILDER','orangeidea'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "address",
			"heading" => __("Addres", "orangeidea"),
			"value" => '7th Ave, New York, NY',
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "zoom",
			"heading" => __("Zoom", "orangeidea"),
			"value" => '13',
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "height",
			"heading" => __("Map Height", "orangeidea"),
			"value" => '450px',
		),
	)
) );


