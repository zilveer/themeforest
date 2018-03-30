<?php
$root = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
} elseif ( file_exists( $root.'/wp-config.php' ) ) {
    require_once( $root.'/wp-config.php' );
}
header('Content-type: text/javascript');

?>

<?php

if($qode_options_passage['menu_lineheight'] != ""){
	$line_height = $qode_options_passage['menu_lineheight'];
}else{
	$line_height = 75;
}

?>

var line_height = <?php echo $line_height; ?>;
var logo_height; // it's value is calculated in window load function
var height_span = <?php echo $line_height; ?> - 5;

function headerSize(scroll){
	"use strict";
<?php
	if(isset($qode_options_passage['fixed_menu_resize'])){
		if($qode_options_passage['fixed_menu_resize'] === "yes"){
			$fixed_menu_resize = 'yes';
		}else{
			$fixed_menu_resize = 'no';
		}
	}else{
		$fixed_menu_resize = 'yes';
	}

	if($fixed_menu_resize === "yes"){
?>		
		
	if((line_height - scroll) > line_height){	
		$j('header .header_inner nav.main_menu > ul > li > a').stop().animate({'line-height': line_height+'px'},200);
		$j('header .header_inner nav.main_menu > ul > li > a > span').stop().animate({'height': height_span+'px'},200);
		$j('header .header_inner .header_right_widget').stop().animate({'line-height': line_height+'px'},200);
		$j('header .header_inner .drop_down .second').stop().animate({'top': line_height+'px'},100);
		$j('header .header_inner .drop_down2 .second').stop().animate({'top': line_height+'px'},100);
		$j('header .header_right_widget #lang_sel ul ul').stop().animate({'top': line_height+'px'},100);
		$j('header .header_right_widget #lang_sel_click ul ul').stop().animate({'top': line_height+'px'},100);	
	}else if((line_height - scroll) < line_height){
		$j('header').addClass('move_menu');
		$j('header .header_inner nav.main_menu > ul > li > a').stop().animate({'line-height': '50px'},200);
		$j('header .header_inner nav.main_menu > ul > li > a > span').stop().animate({'height': '45px'},200);
		$j('header .header_inner .header_right_widget').stop().animate({'line-height': '50px'},200);
		$j('header .header_inner .drop_down .second').stop().animate({'top': '50px'},100);
		$j('header .header_inner .drop_down2 .second').stop().animate({'top': '50px'},100);
		$j('header .header_right_widget #lang_sel ul ul').stop().animate({'top': '50px'},100);
		$j('header .header_right_widget #lang_sel_click ul ul').stop().animate({'top': '50px'},100);
	}else if(scroll === 0){
		$j('header .header_inner nav.main_menu > ul > li > a').stop().animate({'line-height': line_height+'px'},100);
		$j('header .header_inner nav.main_menu > ul > li > a > span').stop().animate({'height': height_span+'px'},200);
		$j('header .header_inner .header_right_widget').stop().animate({'line-height': line_height+'px'},100);
		$j('header .header_inner .drop_down .second').stop().animate({'top': line_height+'px'},200);
		$j('header .header_inner .drop_down2 .second').stop().animate({'top': line_height+'px'},200);
		$j('header .header_right_widget #lang_sel_click ul ul').stop().animate({'top': line_height+'px'},200);
		$j('header .header_right_widget #lang_sel ul ul').stop().animate({'top': line_height+'px'},200);
		$j('header').removeClass('move_menu');
	}
		
		
	if(scroll === 0 && line_height - logo_height >= 10){
		$j('.logo a').height(logo_height);
	}else if(scroll === 0 && line_height - logo_height < 10){
		$j('.logo a').height(line_height - 10);
	}else if( scroll !== 0 && logo_height >= 50){
		$j('.logo a').height(45);
	}else if( scroll !== 0 && logo_height < 50){
		$j('.logo a').height(logo_height);
	}
<?php
	} else {
?>	
		if(line_height > 50){	
			$j('header').addClass('move_menu');
			$j('header .header_inner nav.main_menu > ul > li > a').stop().animate({'line-height': line_height+'px'},200);
			$j('header .header_inner nav.main_menu > ul > li > a > span').stop().animate({'height': height_span+'px'},200);
			$j('header .header_inner .header_right_widget').stop().animate({'line-height': line_height+'px'},200);
			$j('header .header_inner .drop_down .second').stop().animate({'top': line_height+'px'},100);
			$j('header .header_inner .drop_down2 .second').stop().animate({'top': line_height+'px'},100);
			$j('header .header_right_widget #lang_sel ul ul').stop().animate({'top': line_height+'px'},100);
			$j('header .header_right_widget #lang_sel_click ul ul').stop().animate({'top': line_height+'px'},100);
		}else if(line_height <= 50){
			$j('header').addClass('move_menu');
			$j('header .header_inner nav.main_menu > ul > li > a').stop().animate({'line-height': '50px'},200);
			$j('header .header_inner nav.main_menu > ul > li > a > span').stop().animate({'height': '45px'},200);
			$j('header .header_inner .header_right_widget').stop().animate({'line-height': '50px'},200);
			$j('header .header_inner .drop_down .second').stop().animate({'top': '50px'},100);
			$j('header .header_inner .drop_down2 .second').stop().animate({'top': '50px'},100);
			$j('header .header_right_widget #lang_sel ul ul').stop().animate({'top': '50px'},100);
			$j('header .header_right_widget #lang_sel_click ul ul').stop().animate({'top': '50px'},100);
		}

		if(scroll === 0){
			$j('header').removeClass('move_menu');
		}
<?php
	}
?>	
}

function setLogoHeightOnLoad(){
	"use strict";
	
	if(line_height - logo_height >= 10){
		$j('.logo a').height(logo_height);
	}else if(line_height - logo_height < 10){
		$j('.logo a').height(line_height - 10);
	}
	$j('.logo a img').css('height','100%');
}

function ajaxSubmitCommentForm(){
	"use strict";

	var options = { 
		success: function(){
			$j("#commentform textarea").val("");
			$j("#commentform .success p").text("<?php _e('Comment has been sent!','qode'); ?>");
		}
	}; 
	
	$j('#commentform').submit(function() {
		$j(this).find('input[type="submit"]').next('.success').remove();
		$j(this).find('input[type="submit"]').after('<div class="success"><p></p></div>');
		$j(this).ajaxSubmit(options); 
		return false; 
	}); 
}

<?php
if($qode_options_passage['enable_google_map'] != ""){
?>

var geocoder;
var map;

function initialize() {
	"use strict";

	geocoder = new google.maps.Geocoder();
	var latlng = new google.maps.LatLng(-34.397, 150.644);
	var myOptions = {
<?php
$google_maps_scroll_wheel = false;
if(isset($qode_options_passage['google_maps_scroll_wheel'])){
	if ($qode_options_passage['google_maps_scroll_wheel'] == "yes")
		$google_maps_scroll_wheel = true;
}
$google_maps_zoom = 12;
if(isset($qode_options_passage['google_maps_zoom'])){
	if (intval($qode_options_passage['google_maps_zoom']) > 0)
		$google_maps_zoom = intval($qode_options_passage['google_maps_zoom']);
}
?>
		zoom: <?php echo $google_maps_zoom; ?>,
		<?php if ($google_maps_scroll_wheel) { ?>
    scrollwheel: false,
		<?php } ?>
		center: latlng,
		zoomControl: true,
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.SMALL,
			position: google.maps.ControlPosition.RIGHT_CENTER
		},
		scaleControl: false,
			scaleControlOptions: {
			position: google.maps.ControlPosition.LEFT_CENTER
		},
		streetViewControl: false,
			streetViewControlOptions: {
			position: google.maps.ControlPosition.LEFT_CENTER
		},
		panControl: false,
		panControlOptions: {
			position: google.maps.ControlPosition.LEFT_CENTER
		},
		mapTypeControl: false,
		mapTypeControlOptions: {
			mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'pink_parks'],
			style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
			position: google.maps.ControlPosition.LEFT_CENTER
		},
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
}

function codeAddress(data) {
	"use strict";

	var contentString = '<div id="content">'+
	'<div id="siteNotice">'+
	'</div>'+
	'<div id="bodyContent">'+
	'<p>'+data+'</p>'+
	'</div>'+
	'</div>';
	var infowindow = new google.maps.InfoWindow({
		content: contentString
	});
	geocoder.geocode( { 'address': data}, function(results, status) {
		if (status === google.maps.GeocoderStatus.OK) {
			map.setCenter(results[0].geometry.location);
			var marker = new google.maps.Marker({
				map: map, 
				position: results[0].geometry.location,
				<?php if(isset($qode_options_passage['google_maps_pin_image'])){ ?>
				icon:  '<?php echo $qode_options_passage['google_maps_pin_image']; ?>',
				<?php } ?>
				title: data['store_title']
			});
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map,marker);
			});
			//infowindow.open(map,marker);
		}
	});
}

var $j = jQuery.noConflict();

$j(document).ready(function() {
	"use strict";

	showContactMap();
});
<?php
}
?>

function showContactMap() {
	"use strict";

	if($j("#map_canvas").length > 0){
		initialize();
		codeAddress('<?php if(isset($qode_options_passage['google_maps_address'])) { echo $qode_options_passage['google_maps_address']; } ?>');
	}
}


var no_ajax_pages = [];
var root = '<?php echo home_url(); ?>/';
<?php if($qode_options_passage['parallax_speed'] != ''){ ?>
var parallax_speed = <?php echo $qode_options_passage['parallax_speed']; ?>;
<?php }else{ ?>
var parallax_speed = 1;
<?php } ?>


<?php 
$pages = get_pages(); 
foreach ($pages as $page) {
	if(get_post_meta($page->ID, "qode_show-animation", true) == "no_animation") :
?>
		no_ajax_pages.push('<?php echo get_permalink($page->ID) ?>');
<?php
	endif;
}

if(function_exists('icl_get_languages')) { 
	$language_pages = icl_get_languages('skip_missing=0');
		foreach($language_pages as $language_page) {
?>
			no_ajax_pages.push('<?php echo $language_page["url"]; ?>');	
				
<?php } }

if (isset($qode_options_passage['internal_no_ajax_links'])) {
	foreach (explode(',', $qode_options_passage['internal_no_ajax_links']) as $no_ajax_link) {
?>
		no_ajax_pages.push('<?php echo trim($no_ajax_link); ?>');
<?php
	}
}
?>