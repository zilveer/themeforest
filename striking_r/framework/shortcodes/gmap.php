<?php
if(!function_exists('theme_shortcode_googlemap')){
function theme_shortcode_googlemap($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		"width" => false,
		"height" => '400',
		"address" => '',
		"latitude" => 0,
		"longitude" => 0,
		"zoom" => 14,
		"html" => '',
		"popup" => 'false',
		"controls" => 'false',
		'pancontrol' => 'true',
		'zoomcontrol' => 'true',
		'maptypecontrol' => 'true',
		'scalecontrol' => 'true',
		'streetviewcontrol' => 'true',
		'overviewmapcontrol' => 'true',
		"scrollwheel" => 'true',
		'doubleclickzoom' =>'true',
		"maptype" => 'ROADMAP',
		"marker" => 'true',
		'align' => false,
	), $atts));
	
	if($width){
		if(is_numeric($width)){
			$width = $width.'px';
		}
		$width = 'width:'.$width.';';
	}else{
		$width = '';
		$align = false;
	}
	if($height){
		if(is_numeric($height)){
			$height = $height.'px';
		}
		$height = 'height:'.$height.';';
	}else{
		$height = '';
	}
	$html = str_replace('{linebreak}', '<br/>', $html);
	$html = str_replace('{', '<', $html);
	$html = str_replace('}', '>', $html);
	wp_enqueue_script( 'jquery-gmap');
	
	/* fix */
	$search  = array('G_NORMAL_MAP', 'G_SATELLITE_MAP', 'G_HYBRID_MAP', 'G_DEFAULT_MAP_TYPES', 'G_PHYSICAL_MAP');
	$replace = array('ROADMAP', 'SATELLITE', 'HYBRID', 'HYBRID', 'TERRAIN');
	$maptype = str_replace($search, $replace, $maptype);
	/* end fix */
	
	if($controls == 'true'){
		$controls = <<<HTML
{
	panControl: {$pancontrol},
	zoomControl: {$zoomcontrol},
	mapTypeControl: {$maptypecontrol},
	scaleControl: {$scalecontrol},
	streetViewControl: {$streetviewcontrol},
	overviewMapControl: {$overviewmapcontrol}
}
HTML;
	}
	
	$align = $align?' align'.$align:'';
	$id = rand(100,1000);
	if($marker != 'false'){
		return <<<HTML
<div id="google_map_{$id}" class="google_map{$align}" style="{$width}{$height}"></div>
<script type="text/javascript">
jQuery(document).ready(function($) {
	var tabs = jQuery("#google_map_{$id}").parents('.tabs_container,.mini_tabs_container,.accordion, .theme_accordion');
	var toggle = jQuery("#google_map_{$id}").parents('.toggle');
	jQuery("#google_map_{$id}").bind('initGmap',function(){
		jQuery(this).gMap({
			zoom: {$zoom},
			markers:[{
				address: "{$address}",
				latitude: {$latitude},
				longitude: {$longitude},
				html: "{$html}",
				popup: {$popup}
			}],
			controls: {$controls},
			maptype: '{$maptype}',
			doubleclickzoom:{$doubleclickzoom},
			scrollwheel:{$scrollwheel}
		});
		jQuery(this).data("gMapInited",true);
	}).data("gMapInited",false);
	if(tabs.length!=0){
		tabs.each(function(){
			var api = null;
			if($(this).is('.accordion, .theme_accordion')){
				api = $(this).data("tabs");
			}else{
				api = $(this).find('.tabs, .theme_tabs, .mini_tabs, .theme_mini_tabs').data("tabs");
			}
			api.onClick(function(index) {
				this.getCurrentPane().find('.google_map').each(function(){
					if(jQuery(this).data("gMapInited")==false){
						jQuery(this).trigger('initGmap');
					}
				});
			});
		});
	}else if(toggle.length!=0){
		toggle.find('.toggle_title').on('toggle::open', function(){
			jQuery("#google_map_{$id}").trigger('initGmap');
		});
	} else {
		jQuery("#google_map_{$id}").trigger('initGmap');
	}
});
</script>
HTML;
	}else{
return <<<HTML
<div id="google_map_{$id}" class="google_map{$align}" style="{$width}{$height}"></div>
<script type="text/javascript">
jQuery(document).ready(function($) {
	var tabs = jQuery("#google_map_{$id}").parents('.tabs_container,.mini_tabs_container,.accordion, .theme_accordion');
	var toggle = jQuery("#google_map_{$id}").parents('.toggle');
	jQuery("#google_map_{$id}").bind('initGmap',function(){
		jQuery("#google_map_{$id}").gMap({
			zoom: {$zoom},
			latitude: {$latitude},
			longitude: {$longitude},
			address: "{$address}",
			controls: {$controls},
			maptype: '{$maptype}',
			doubleclickzoom:{$doubleclickzoom},
			scrollwheel:{$scrollwheel}
		});
		jQuery(this).data("gMapInited",true);
	}).data("gMapInited",false);
	if(tabs.length!=0){
		tabs.each(function(){
			var api = null;
			if($(this).is('.accordion, .theme_accordion')){
				api = $(this).data("tabs");
			}else{
				api = $(this).find('.tabs, .theme_tabs, .mini_tabs, .theme_mini_tabs').data("tabs");
			}
			api.onClick(function(index) {
				this.getCurrentPane().find('.google_map').each(function(){
					if(jQuery(this).data("gMapInited")==false){
						jQuery(this).trigger('initGmap');
					}
				});
			});
		});
	}else if(toggle.length!=0){
		toggle.find('.toggle_title').on('toggle::open', function(){
			jQuery("#google_map_{$id}").trigger('initGmap');
		});
	} else {
		jQuery("#google_map_{$id}").trigger('initGmap');
	}
});
</script>
HTML;
	}
}
}
add_shortcode('gmap','theme_shortcode_googlemap');