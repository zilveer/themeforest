<?php				
/* ----------------------------------------------------- */
/* Shortcodes */
/* ----------------------------------------------------- */

/* ----------------------------------------------------- */
/* Dropcap */
function minti_dropcap( $atts, $content = null ) {
    extract(shortcode_atts(array(), $atts));
	$out = "<span class='dropcap' >" .$content. "</span>";
    return $out;
}

/* ----------------------------------------------------- */
/* Accordion Shortcode */
function minti_accordion($atts, $content, $code) {
	extract(shortcode_atts(array(
		'style' => false
	), $atts));
	if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		$output = '';
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
			if($i == 0){$first = 'class="firsttitle"';}else{$first = '';}
			$output .= '<div class="title"><a href="#acc-' . $i . '" '.$first.'>' . $matches[3][$i]['title'] . '</a></div><div class="inner" id="acc-' . $i . '">' . do_shortcode(trim($matches[5][$i])) .'</div>';
		}
		return '<div class="accordion">' . $output . '</div>';
		
	}
}

/* ----------------------------------------------------- */
/* Alter Block */

function minti_alert( $atts, $content = null) {

extract( shortcode_atts( array(
      'type' => 'warning'
      ), $atts ) );
      //return '<a href="' . $link . '" class="button ' . $color . ' ' . $align . '">' . $content . '</a>';
      return '<div class="alert-message ' . $type . '"><a class="close" href="#">×</a><span>' . do_shortcode($content) . '</span></div>';
}

/* ----------------------------------------------------- */
/* List Shortcodes */
function minti_list( $atts, $content = null ) {
    extract(shortcode_atts(array(
       	'type'      => 'check'
    ), $atts));
	$out = '<ul class="list '.$type.'">'. do_shortcode($content) . '</ul>';
    return $out;
}


function minti_li( $atts, $content = null ) {
	$out = '<li>'. do_shortcode($content) . '</li>';
    return $out;
}

/* ----------------------------------------------------- */
/* Google Map Shortcodes */

function minti_googlemap($attr) {

	// default atts
	$attr = shortcode_atts(array(	
									'lat'   => '0', 
									'lon'    => '0',
									'id' => 'map',
									'z' => '8',
									'w' => '100%',
									'h' => '400',
									'maptype' => 'ROADMAP',
									'address' => '',
									'kml' => '',
									'kmlautofit' => 'yes',
									'marker' => '',
									'markerimage' => '',
									'traffic' => 'no',
									'bike' => 'no',
									'fusion' => '',
									'start' => '',
									'end' => '',
									'infowindow' => '',
									'infowindowdefault' => 'yes',
									'directions' => '',
									'hidecontrols' => 'false',
									'scale' => 'false',
									'scrollwheel' => 'true',
									"style" => false // full
									), $attr);
									

	$returnme = '
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <div id="' .$attr['id'] . '" style="width:' . $attr['w'] . 'px;height:' . $attr['h'] . 'px;" class="google_map '.$attr['style'].'"></div>
	';
	
	//directions panel
	if($attr['start'] != '' && $attr['end'] != '') 
	{
		$panelwidth = $attr['w']-20;
		$returnme .= '
		<div id="directionsPanel" style="width:' . $panelwidth . 'px;height:' . $attr['h'] . 'px;border:1px solid gray;padding:10px;overflow:auto;"></div><br>
		';
	}


	$returnme .= '
    

    <script type="text/javascript">

		var latlng = new google.maps.LatLng(' . $attr['lat'] . ', ' . $attr['lon'] . ');
		var myOptions = {
			zoom: ' . $attr['z'] . ',
			center: latlng,
			scrollwheel: ' . $attr['scrollwheel'] .',
			scaleControl: ' . $attr['scale'] .',
			disableDefaultUI: ' . $attr['hidecontrols'] .',
			mapTypeId: google.maps.MapTypeId.' . $attr['maptype'] . '
		};
		var ' . $attr['id'] . ' = new google.maps.Map(document.getElementById("' . $attr['id'] . '"),
		myOptions);
		';
				
		//kml
		if($attr['kml'] != '') 
		{
			if($attr['kmlautofit'] == 'no') 
			{
				$returnme .= '
				var kmlLayerOptions = {preserveViewport:true};
				';
			}
			else
			{
				$returnme .= '
				var kmlLayerOptions = {preserveViewport:false};
				';
			}
			$returnme .= '
			var kmllayer = new google.maps.KmlLayer(\'' . html_entity_decode($attr['kml']) . '\',kmlLayerOptions);
			kmllayer.setMap(' . $attr['id'] . ');
			';
		}

		//directions
		if($attr['start'] != '' && $attr['end'] != '') 
		{
			$returnme .= '
			var directionDisplay;
			var directionsService = new google.maps.DirectionsService();
		    directionsDisplay = new google.maps.DirectionsRenderer();
		    directionsDisplay.setMap(' . $attr['id'] . ');
    		directionsDisplay.setPanel(document.getElementById("directionsPanel"));

				var start = \'' . $attr['start'] . '\';
				var end = \'' . $attr['end'] . '\';
				var request = {
					origin:start, 
					destination:end,
					travelMode: google.maps.DirectionsTravelMode.DRIVING
				};
				directionsService.route(request, function(response, status) {
					if (status == google.maps.DirectionsStatus.OK) {
						directionsDisplay.setDirections(response);
					}
				});


			';
		}
		
		//traffic
		if($attr['traffic'] == 'yes')
		{
			$returnme .= '
			var trafficLayer = new google.maps.TrafficLayer();
			trafficLayer.setMap(' . $attr['id'] . ');
			';
		}
	
		//bike
		if($attr['bike'] == 'yes')
		{
			$returnme .= '			
			var bikeLayer = new google.maps.BicyclingLayer();
			bikeLayer.setMap(' . $attr['id'] . ');
			';
		}
		
		//fusion tables
		if($attr['fusion'] != '')
		{
			$returnme .= '			
			var fusionLayer = new google.maps.FusionTablesLayer(' . $attr['fusion'] . ');
			fusionLayer.setMap(' . $attr['id'] . ');
			';
		}
	
		//address
		if($attr['address'] != '')
		{
			$returnme .= '
		    var geocoder_' . $attr['id'] . ' = new google.maps.Geocoder();
			var address = \'' . $attr['address'] . '\';
			geocoder_' . $attr['id'] . '.geocode( { \'address\': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					' . $attr['id'] . '.setCenter(results[0].geometry.location);
					';
					
					if ($attr['marker'] !='')
					{
						//add custom image
						if ($attr['markerimage'] !='')
						{
							$returnme .= 'var image = "'. $attr['markerimage'] .'";';
						}
						$returnme .= '
						var marker = new google.maps.Marker({
							map: ' . $attr['id'] . ', 
							';
							if ($attr['markerimage'] !='')
							{
								$returnme .= 'icon: image,';
							}
						$returnme .= '
							position: ' . $attr['id'] . '.getCenter()
						});
						';

						//infowindow
						if($attr['infowindow'] != '') 
						{
							//first convert and decode html chars
							$thiscontent = htmlspecialchars_decode($attr['infowindow']);
							$returnme .= '
							var contentString = \'' . $thiscontent . '\';
							var infowindow = new google.maps.InfoWindow({
								content: contentString
							});
										
							google.maps.event.addListener(marker, \'click\', function() {
							  infowindow.open(' . $attr['id'] . ',marker);
							});
							';

							//infowindow default
							if ($attr['infowindowdefault'] == 'yes')
							{
								$returnme .= '
									infowindow.open(' . $attr['id'] . ',marker);
								';
							}
						}
					}
			$returnme .= '
				} else {
				alert("Geocode was not successful for the following reason: " + status);
			}
			});
			';
		}

		//marker: show if address is not specified
		if ($attr['marker'] != '' && $attr['address'] == '')
		{
			//add custom image
			if ($attr['markerimage'] !='')
			{
				$returnme .= 'var image = "'. $attr['markerimage'] .'";';
			}

			$returnme .= '
				var marker = new google.maps.Marker({
				map: ' . $attr['id'] . ', 
				';
				if ($attr['markerimage'] !='')
				{
					$returnme .= 'icon: image,';
				}
			$returnme .= '
				position: ' . $attr['id'] . '.getCenter()
			});
			';

			//infowindow
			if($attr['infowindow'] != '') 
			{
				$returnme .= '
				var contentString = \'' . $attr['infowindow'] . '\';
				var infowindow = new google.maps.InfoWindow({
					content: contentString
				});
							
				google.maps.event.addListener(marker, \'click\', function() {
				  infowindow.open(' . $attr['id'] . ',marker);
				});
				';
				//infowindow default
				if ($attr['infowindowdefault'] == 'yes')
				{
					$returnme .= '
						infowindow.open(' . $attr['id'] . ',marker);
					';
				}				
			}
		}

		$returnme .= '</script>';
		
		return $returnme;
}
add_shortcode('gmap', 'minti_googlemap');


/* ----------------------------------------------------- */
/* Video Shortcodes */

function minti_video($atts, $content=null) {
	extract(shortcode_atts(array(
		'type' 	=> '',
		'id' 	=> '',
		'width' 	=> false,
		'height' 	=> false,
		'autoplay' 	=> ''
	), $atts));
	
	if ($height && !$width) $width = intval($height * 16 / 9);
	if (!$height && $width) $height = intval($width * 9 / 16) + 25;
	if (!$height && !$width){
		$height = 320;
		$width = 480;
	}
	
	//$link = $link?' href="'.$link.'"':'';
	
	$autoplay = ($autoplay == 'yes' ? '1' : false);
		
	if($type == "vimeo") $return = "<div class='video-embed'><iframe src='http://player.vimeo.com/video/$id?autoplay=$autoplay&amp;title=0&amp;byline=0&amp;portrait=0' width='$width' height='$height' class='iframe'></iframe></div>";
	else if($type == "youtube") $return = "<div class='video-embed'><iframe src='http://www.youtube.com/embed/$id?HD=1;rel=0;showinfo=0' width='$width' height='$height' class='iframe'></iframe></div>";
	else if($type == "dailymotion") $return ="<div class='video-embed'><iframe src='http://www.dailymotion.com/embed/video/$id?width=$width&amp;autoPlay={$autoplay}&foreground=%23FFFFFF&highlight=%23CCCCCC&background=%23000000&logo=0&hideInfos=1' width='$width' height='$height' class='iframe'></iframe></div>";
	if (!empty($id)){
		return $return;
	}
}
add_shortcode('video', 'minti_video');

/* ----------------------------------------------------- */
/* HR */

function minti_hr() {  
    return '<div class="hr"></div>';  
}

function minti_hr2() {  
    return '<div class="hr2"></div>';  
}

function minti_hr3() {  
    return '<div class="hr3"></div>';  
}

function minti_clear() {  
    return '<div class="clear"></div>';  
}


/* ----------------------------------------------------- */
/* Buttons */

function minti_buttons( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'link'      => '#',
        'target'    => '_self',
		'size'      => 'normal',
		'style'      => 'default', //light, dark, normal
		'align'     =>''
    ), $atts));

	$out = "<a href=\"" .$link. "\" target=\"" .$target. "\" class=\"button ".$style." ".$size." ".$align."\">" .do_shortcode($content). "</a>";
    return $out;
}

/* ----------------------------------------------------- */
/* Toggle Shortcode */

function minti_toggle( $atts, $content = null)
{
 extract(shortcode_atts(array(
        'title' => '',
        ), $atts));
   return '<div class="toggle"><div class="title">'.$title.'<span></span></div><div class="inner"><div>'. do_shortcode($content) . '</div></div></div>';
}

/* ----------------------------------------------------- */
/* Tabs Shortcode */

function minti_tabs($atts, $content = null, $code) {
	extract(shortcode_atts(array(
	), $atts));
	if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
		$output = '<ul class="tabNavigation clearfix">';
		
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<li><a title="' . $matches[3][$i]['title'] .  '" href="#tab-' . $i . '">' . $matches[3][$i]['title'] . '</a></li>';
		}
		$output .= '</ul><div class="clearnav"></div>';
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<div id="tab-' . $i . '" class="tabcontent">' . do_shortcode(trim($matches[5][$i])) .'</div>';
		}
		
		return '<div class="tabs">' . $output . '</div>';
	}
}


/* ----------------------------------------------------- */
/* Pricing Table */

function minti_plan( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'name'      => 'Premium',
		'link'      => 'http://www.google.de',
		'linkname'      => 'Sign Up',
		'price'      => '39.00$',
		'per'      => false,
		'color'    => false, // grey, green, red, blue
		'featured' => false
    ), $atts));
    
    if($featured == true) {
    	$return = " featured";
    	$return2 = " large light";
    }
    else{
    	$return = "";
    	$return2 = " ";
    }
    if($per != false) {
    	$return3 = "/ ".$per."";
    }
    else{
    	$return3 = "";
    }
    $return5 = "";
    if($color != false) {
    	if($featured == true){
    		$return5 = "style='border-color:".$color.";' ";
    	}
    	$return4 = "style='background-color:".$color.";' ";
    }
    else{
    	$return4 = "";
    }
	
	$out = "
		<div class='plan".$return."' ".$return5.">
			<div class='plan-head'><h3 ".$return4.">".$name."</h3>
			<div class='price' ".$return4.">".$price." <span>".$return3."</span></div></div>
			<ul>" .do_shortcode($content). "</ul><div class='signup'><a class='button ".$return2."' href='".$link."'>".$linkname."</a></div>
		</div>";
    return $out;
}


/* ----------------------------------------------------- */
/* Pricing Table */

function minti_pricing( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'col'      => '3'
    ), $atts));
	
	$out = "<div class='pricing-table col-".$col."'>" .do_shortcode($content). "</div><div class='clear'></div>";
    return $out;
}

/* ----------------------------------------------------- */
/* Slider */
function minti_slideshow($atts, $content = null){
	global $wp_filter;
	$the_content_filter_backup = $wp_filter['the_content'];
	extract(shortcode_atts(array(
		'pausetime' => '3000',
		'directionnav' => 'true',
		'controlnav' => 'true'
	), $atts));
	
	$id = rand(1,9999);
	
	if($directionnav ==='true'){
		$directionnav = 'true';
	}else{
		$directionnav = 'false';
	}
	
	$content = trim($content);
	$images = !empty($content)?preg_split("/(\r?\n)/", $content):'';
	
	$themePath = get_template_directory_uri();
	
	if(!empty($images) && is_array($images)){
		$content = '';
		foreach($images as $image){
			$image = trim(strip_tags($image));
			
			if(!empty($image)){
				$content .= '<li><img src="'.strip_tags($image).'" title="" alt="" /></li>';
			}
		}
	}

	$wp_filter['the_content'] = $the_content_filter_backup;
return <<<HTML

<script type="text/javascript">
$(document).ready(function() {
    
    $('#flex_slider_{$id}').flexslider({
          animation: "fade",
          directionNav : {$directionnav},
          controlNav: {$controlnav},
          slideshowSpeed: {$pausetime}
    });
	
});
</script>
<div id="flex_slider_{$id}" class="flexslider inpageslider"><ul class="slides">{$content}</ul></div>
HTML;
}
add_shortcode('slideshow', 'minti_slideshow');

/* ----------------------------------------------------- */
/* Columns */

function minti_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}

function minti_one_third_last( $atts, $content = null ) {
   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

function minti_two_third( $atts, $content = null ) {
   return '<div class="two_third">' . do_shortcode($content) . '</div>';
}

function minti_two_third_last( $atts, $content = null ) {
   return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

function minti_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}

function minti_one_half_last( $atts, $content = null ) {
   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

function minti_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}

function minti_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

function minti_three_fourth( $atts, $content = null ) {
   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}

function minti_three_fourth_last( $atts, $content = null ) {
   return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

function minti_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}

function minti_one_fifth_last( $atts, $content = null ) {
   return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

function minti_two_fifth( $atts, $content = null ) {
   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}

function minti_two_fifth_last( $atts, $content = null ) {
   return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

function minti_three_fifth( $atts, $content = null ) {
   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}

function minti_three_fifth_last( $atts, $content = null ) {
   return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

function minti_four_fifth( $atts, $content = null ) {
   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}

function minti_four_fifth_last( $atts, $content = null ) {
   return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

function minti_one_sixth( $atts, $content = null ) {
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}

function minti_one_sixth_last( $atts, $content = null ) {
   return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

function minti_five_sixth( $atts, $content = null ) {
   return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}

function minti_five_sixth_last( $atts, $content = null ) {
   return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}



/* ----------------------------------------------------- */
/* Pre Process Shortcodes */
/* ----------------------------------------------------- */

function pre_process_shortcode($content) {
    global $shortcode_tags;
 
    // Backup current registered shortcodes and clear them all out
    $orig_shortcode_tags = $shortcode_tags;
    $shortcode_tags = array();
 
    add_shortcode('one_third', 'minti_one_third');
    add_shortcode('one_third_last', 'minti_one_third_last');
    add_shortcode('two_third', 'minti_two_third');
    add_shortcode('two_third_last', 'minti_two_third_last');
    add_shortcode('one_half', 'minti_one_half');
    add_shortcode('one_half_last', 'minti_one_half_last');
    add_shortcode('one_fourth', 'minti_one_fourth');
    add_shortcode('one_fourth_last', 'minti_one_fourth_last');
    add_shortcode('three_fourth', 'minti_three_fourth');
    add_shortcode('three_fourth_last', 'minti_three_fourth_last');
    add_shortcode('one_fifth', 'minti_one_fifth');
    add_shortcode('one_fifth_last', 'minti_one_fifth_last');
    add_shortcode('two_fifth', 'minti_two_fifth');
    add_shortcode('two_fifth_last', 'minti_two_fifth_last');
    add_shortcode('three_fifth', 'minti_three_fifth');
    add_shortcode('three_fifth_last', 'minti_three_fifth_last');
    add_shortcode('four_fifth', 'minti_four_fifth');
    add_shortcode('four_fifth_last', 'minti_four_fifth_last');
    add_shortcode('one_sixth', 'minti_one_sixth');
    add_shortcode('one_sixth_last', 'minti_one_sixth_last');
    add_shortcode('five_sixth', 'minti_five_sixth');
    add_shortcode('five_sixth_last', 'minti_five_sixth_last');
    
    add_shortcode('accordion', 'minti_accordion');
    
    add_shortcode('alert', 'minti_alert');
    
    add_shortcode('dropcap', 'minti_dropcap');
    
    add_shortcode('toggle', 'minti_toggle');
    
    add_shortcode('list', 'minti_list');
    add_shortcode('li', 'minti_li');
    
    add_shortcode('button', 'minti_buttons');
    
    add_shortcode('hr3', 'minti_hr3');
	add_shortcode('hr2', 'minti_hr2');
	add_shortcode('hr', 'minti_hr');
	add_shortcode('clear', 'minti_clear');
	
	add_shortcode('tabs', 'minti_tabs');
	
	add_shortcode('pricing-table', 'minti_pricing');
	add_shortcode('plan', 'minti_plan');
 
    // Do the shortcode (only the one above is registered)
    $content = do_shortcode($content);
 
    // Put the original shortcodes back
    $shortcode_tags = $orig_shortcode_tags;
 
    return $content;
}
 
add_filter('the_content', 'pre_process_shortcode', 7);
						
/* ----------------------------------------------------- */
/* EOF */
/* ----------------------------------------------------- */
?>