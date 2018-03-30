<?php

function indonez_run_shortcode( $content ) {
    global $shortcode_tags;
 
    // Backup current registered shortcodes and clear them all out
    $orig_shortcode_tags = $shortcode_tags;
    remove_all_shortcodes();
    
    add_shortcode('col_12', 'indonez_col_12');
    add_shortcode('col_12_last', 'indonez_col_12_last');
    add_shortcode('col_13', 'indonez_col_13');
    add_shortcode('col_13_last', 'indonez_col_13_last');
    add_shortcode('col_14', 'indonez_col_14');
    add_shortcode('col_34', 'indonez_col_34');
    add_shortcode('col_23', 'indonez_col_23');
    add_shortcode('col_23_last', 'indonez_col_23_last');
    add_shortcode('col_34_last', 'indonez_col_34_last');
    add_shortcode('col_14_last', 'indonez_col_14_last');
    add_shortcode('bulletlist', 'indonez_bullelist');
    add_shortcode('arrowlist', 'indonez_arrowlist');
    add_shortcode('checklist', 'indonez_checklist');
    add_shortcode('orderlist', 'indonez_orderlist');
    add_shortcode('squarelist', 'indonez_squarelist');
    add_shortcode('green_arrowlist', 'indonez_green_arrow');
    add_shortcode('deletelist', 'indonez_deletelist');
    add_shortcode('gearlist', 'indonez_gearlist');
    add_shortcode('penlist', 'indonez_penlist');
    add_shortcode('starlist', 'indonez_starlist');
    add_shortcode('warning', 'indonez_warningbox');
    add_shortcode('info', 'indonez_infobox');
    add_shortcode('success', 'indonez_successbox');
    add_shortcode('error', 'indonez_errorbox');
    add_shortcode('pullquote_right', 'indonez_pullquote_right');
    add_shortcode('pullquote_left', 'indonez_pullquote_left');
    add_shortcode('italic_text', 'indonez_italic_text');
    add_shortcode('quotebox', 'indonez_quotebox');
    add_shortcode('dropcap', 'indonez_drop_cap');
    add_shortcode('button', 'indonez_button');
    add_shortcode('image', 'indonez_imagestyle');
    add_shortcode("vimeo_video", "vimeo_code"); 
    add_shortcode("youtube_video", "youTube_code");
    add_shortcode('gmap','theme_shortcode_googlemap');
    add_shortcode('tabs', 'indonez_shortcode_tabs');
    add_shortcode('mini_tabs', 'indonez_shortcode_tabs');
    add_shortcode('accordions', 'indonez_shortcode_accordions');
    add_shortcode('toggle', 'indonez_shortcode_toggle');
    add_shortcode('stafflist','indonez_stafflist_shortcode');
    add_shortcode('divider','indonez_divider');
    add_shortcode('table', 'indonez_table');
    add_shortcode( 'pricing', 'pricing_table_shortcode' );
    add_shortcode( 'item', 'pricing_shortcode' );
    
    // Do the shortcode (only the one above is registered)
    $content = do_shortcode( $content );
 
    // Put the original shortcodes back
    $shortcode_tags = $orig_shortcode_tags;
 
    return $content;
}
 
add_filter( 'the_content', 'indonez_run_shortcode', 7 );
add_filter( 'the_excerpt', 'indonez_run_shortcode', 7 );

/*---------------------------------------------------------
  Columns
-----------------------------------------------------------*/

function indonez_col_12( $atts, $content = null ) {
   return '<div class="col_12">' . do_shortcode($content) . '</div>';
}

function indonez_col_12_last( $atts, $content = null ) {
   return '<div class="col_12_last">' . do_shortcode($content) . '</div>';
}

function indonez_col_13( $atts, $content = null ) {
   return '<div class="col_13">' . do_shortcode($content) . '</div>';
}

function indonez_col_13_last( $atts, $content = null ) {
   return '<div class="col_13_last">' . do_shortcode($content) . '</div>';
}

function indonez_col_14( $atts, $content = null ) {
   return '<div class="col_14">' . do_shortcode($content) . '</div>';
}

function indonez_col_14_last( $atts, $content = null ) {
   return '<div class="col_14_last">' . do_shortcode($content) . '</div>';
}

function indonez_col_23( $atts, $content = null ) {
   return '<div class="col_23">' . do_shortcode($content) . '</div>';
}

function indonez_col_23_last( $atts, $content = null ) {
   return '<div class="col_23_last">' . do_shortcode($content) . '</div>';
}

function indonez_col_34($atts, $content = null ) {
   return '<div class="col_34">' . do_shortcode($content) . '</div>';
}

function indonez_col_34_last($atts, $content = null ) {
   return '<div class="col_34_last">' . do_shortcode($content) . '</div>';
}


/*---------------------------------------------------------
  List Style
-----------------------------------------------------------*/
function indonez_bullelist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="circle">', do_shortcode($content));
	return $content;	
}

function indonez_arrowlist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="arrow">', do_shortcode($content));
	return $content;	
}

function indonez_checklist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="checklist">', do_shortcode($content));
	return $content;	
}

function indonez_orderlist( $atts, $content = null ) {
	$content = str_replace('<ol>', '<ol>', do_shortcode($content));
	return $content;	
}

function indonez_green_arrow( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="arrow2">', do_shortcode($content));
	return do_shortcode($content);
}

function indonez_deletelist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="cross">', do_shortcode($content));
	return do_shortcode($content);
}

function indonez_gearlist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="gear">', do_shortcode($content));
	return do_shortcode($content);
}

function indonez_penlist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="pen">', do_shortcode($content));
	return do_shortcode($content);
}

function indonez_starlist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="star">', do_shortcode($content));
	return do_shortcode($content);
}

function indonez_squarelist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="square">', do_shortcode($content));
	return do_shortcode($content);
}
/*---------------------------------------------------------
  Message Box
-----------------------------------------------------------*/
function indonez_warningbox( $atts, $content = null ) {
   return '<div class="warning">' . do_shortcode($content) . '</div>';
}

function indonez_infobox( $atts, $content = null ) {
   return '<div class="info">' . do_shortcode($content) . '</div>';
}

function indonez_successbox( $atts, $content = null ) {
   return '<div class="success">' . do_shortcode($content) . '</div>';
}

function indonez_errorbox( $atts, $content = null ) {
   return '<div class="error">' . do_shortcode($content) . '</div>';
}

/*---------------------------------------------------------
  Highlight
-----------------------------------------------------------*/
function indonez_highlight_yellow( $atts, $content = null ) {
   return '<span class="highlight-yellow">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight_yellow', 'indonez_highlight_yellow');

function indonez_highlight_dark( $atts, $content = null ) {
   return '<span class="highlight-dark">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight_dark', 'indonez_highlight_dark');

function indonez_highlight_green( $atts, $content = null ) {
   return '<span class="highlight-green">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight_green', 'indonez_highlight_green');

function indonez_highlight_red( $atts, $content = null ) {
   return '<span class="highlight-red">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight_red', 'indonez_highlight_red');


/*---------------------------------------------------------
  Pullquote
-----------------------------------------------------------*/

function indonez_pullquote_right( $atts, $content = null ) {
   return '<span class="pullquote_right">' . do_shortcode($content) . '</span>';
}

function indonez_pullquote_left( $atts, $content = null ) {
   return '<span class="pullquote_left">' . do_shortcode($content) . '</span>';
}

function indonez_italic_text( $atts, $content = null ) {
   return '<p class="heading-text">' . do_shortcode($content) . '</p>';
}

/*---------------------------------------------------------
  Quotebox
-----------------------------------------------------------*/
function indonez_quotebox( $atts, $content = null ) {
   return '<div class="box-bq"><blockquote><p>' . do_shortcode($content) . '</p></blockquote></div>';
}

/*---------------------------------------------------------
  Dropcap
-----------------------------------------------------------*/
function indonez_drop_cap( $atts, $content = null ) {
   return '<span class="dropcap">' . do_shortcode($content) . '</span>';
}

/*---------------------------------------------------------
  Button
-----------------------------------------------------------*/
function indonez_button( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'link'	=> '#',
		'color'	=> '',
		'size'	=> '',
	), $atts));
	
	$out = "<a class=\"button $color $size\" href=\"" .$link. "\">" .do_shortcode($content). "</a>";
  
	return $out;
}

/*---------------------------------------------------------
  Image
-----------------------------------------------------------*/
function indonez_imagestyle( $atts, $content = null,$code ) {
    extract(shortcode_atts(array(
		'source'	=> '#',
		'align'	=> '',
		'border'	=> false
		), $atts));

$class_align = '';
switch ($align) {
	case "left" :
		$class_align="alignleft";
	break;
	case "right" :
		$class_align="alignright";
	break;
	case "center" :
		$class_align="aligncenter";
	break;
}

if ($border == "true") {
	$out = "<img class=\"".$class_align." roundborder\" src=\"" .$source. "\" alt=\"\" />"; 
	} else {
	$out = "<img class=\"".$class_align."\" src=\"" .$source. "\" alt=\"\" />";
	}
return $out;
}


/*---------------------------------------------------------
  Vimeo
-----------------------------------------------------------*/
function vimeo_code($atts,$content = null){

	extract(shortcode_atts(array(  
		"id" 		=> '',
		"width"		=> $width, 
		"height" 	=> $height
	), $atts)); 
	 
	$data = "<object width='$width' height='$height' data='http://vimeo.com/moogaloop.swf?clip_id=$id&amp;server=vimeo.com' type='application/x-shockwave-flash'>
			<param name='allowfullscreen' value='true' />
			<param name='allowscriptaccess' value='always' />
			<param name='wmode' value='opaque'>
			<param name='movie' value='http://vimeo.com/moogaloop.swf?clip_id=$id&amp;server=vimeo.com' />
		</object>";
	return $data;
} 

/*---------------------------------------------------------
  Youtube
-----------------------------------------------------------*/
function youTube_code($atts,$content = null){

	extract(shortcode_atts(array(  
      "id" 		=> '',
  		"width"		=> $width, 
  		"height" 	=> $height
		 ), $atts)); 
	 
	$data = "<object width='$width' height='$height' data='http://www.youtube.com/v/$id' type='application/x-shockwave-flash'>
			<param name='allowfullscreen' value='true' />
			<param name='allowscriptaccess' value='always' />
			<param name='FlashVars' value='playerMode=embedded' />
			<param name='wmode' value='opaque'>
			<param name='movie' value='http://www.youtube.com/v/$id' />
		</object>";
	return $data;
} 

/*---------------------------------------------------------
  Google map
-----------------------------------------------------------*/
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
	
	//wp_print_scripts( 'jquery.gmap');
	
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
<div id="map_wrapper"><div id="google_map_{$id}" class="google_map{$align}" style="{$width}{$height}"></div></div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	var tabs = jQuery("#google_map_{$id}").parents('.tabs_container,.mini_tabs_container,.accordion');
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
	if(tabs.size()!=0){
		tabs.find('ul.tabs,ul.mini_tabs,.accordion').data("tabs").onClick(function(index) {
			this.getCurrentPane().find('.google_map').each(function(){
				if(jQuery(this).data("gMapInited")==false){
					jQuery(this).trigger('initGmap');
				}
			});
		});
	}else{
		jQuery("#google_map_{$id}").trigger('initGmap');
	}
});
</script>
HTML;
	}else{
return <<<HTML
<div id="map_wrapper"><div id="google_map_{$id}" class="google_map{$align}" style="{$width}{$height}"></div></div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	var tabs = jQuery("#google_map_{$id}").parents('.tabs_container,.mini_tabs_container,.accordion');
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
	if(tabs.size()!=0){
		tabs.find('ul.tabs,ul.mini_tabs,.accordion').data("tabs").onClick(function(index) {
			this.getCurrentPane().find('.google_map').each(function(){
				if(jQuery(this).data("gMapInited")==false){
					jQuery(this).trigger('initGmap');
				}
			});
		});
	}else{
		jQuery("#google_map_{$id}").trigger('initGmap');
	}
});
</script>
HTML;
	}
}

/*---------------------------------------------------------
  Tabs
-----------------------------------------------------------*/
function indonez_shortcode_tabs($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => false
	), $atts));
	
	if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
		$output = '<div class="tabs-wrapper"><ul class="'.$code.'">';
		
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<li><a href="#">' . $matches[3][$i]['title'] . '</a></li>';
		}
		$output .= '</ul>';
		$output .= '<div class="panes">';
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<div class="pane">' . do_shortcode(trim($matches[5][$i])) . '</div>';
		}
		$output .= '</div></div>';
		
		return '<div class="'.$code.'_container">' . $output . '</div>';
	}
}

/*---------------------------------------------------------
  Accordion
-----------------------------------------------------------*/
function indonez_shortcode_accordions($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => false,
		'initialtab' => 1
	), $atts));
	
	if (!preg_match_all("/(.?)\[(accordion)\b(.*?)(?:(\/))?\](?:(.+?)\[\/accordion\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
		$output = '';
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<div class="tab">' . $matches[3][$i]['title'] . '</div>';
			$output .= '<div class="pane">' . do_shortcode(trim($matches[5][$i])) . '</div>';
		}
		if($initialtab!="1"){
			$initialIndex = $initialtab -1;
			$data_initialIndex = ' data-initialIndex="'.$initialIndex.'"';
		}else{
			$data_initialIndex = '';
		}
		
		return '<div class="accordion"'.$data_initialIndex.'>' . $output . '</div>';
	}
}

/*---------------------------------------------------------
  Toggle
-----------------------------------------------------------*/
function indonez_shortcode_toggle($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'title' => false
	), $atts));
	return '<div class="toggle"><div class="toggle_title">' . $title . '</div><div class="toggle_content"><p>' . do_shortcode(trim($content)) . '</p></div></div>';
}
/*---------------------------------------------------------
  Staff List
-----------------------------------------------------------*/
function indonez_stafflist_shortcode($atts,$content=null) {
  global $post;
  
  extract(shortcode_atts(array(
    "num" => '',
    "orderby" => '',
    "title" => ''
  ),$atts));
  
  return indonez_stafflist($num,$orderby,$title);
}

/*---------------------------------------------------------
  Divider
-----------------------------------------------------------*/
function indonez_divider( $atts, $content = null ) {
   return '<div class="divider">' . do_shortcode($content) . '</div>';
}

/*---------------------------------------------------------
  Table
-----------------------------------------------------------*/

function indonez_table( $atts, $content = null ) {
  extract(shortcode_atts(array(
        'color'      => ''
    ), $atts));
    
	$content = "<div class=\"table-$color\">".str_replace('<table>', '<table class="table">', do_shortcode($content))."</div>";
	return $content;
	
}

/*-----------------------------------------------------------------------------------*/
/*	Pricing Tables
/*-----------------------------------------------------------------------------------*/

/*main*/
function pricing_table_shortcode( $atts, $content = null  ) {
  
  extract( shortcode_atts( array(
		'column' => '4',
	), $atts ) );
	
	
	//set variables
	if($column == '3') {
		$column_size = 'third-col';
	}
	if($column =='4') {
		$column_size = 'fourth-col';
	}
	if($column =='5') {
		$column_size = 'fifth-col';
	}
	$out = '<div class="pricing-wrapper '.$column_size.'">'; 
	$out .= do_shortcode($content);
	$out .= '<div class="clr"></div></div>';

	return $out;
}


/*section*/
function pricing_shortcode( $atts, $content = null  ) {
	
	extract( shortcode_atts( array(
		'featured' => '',
		'title' => '',
    'subtitle' => '',
		'price' => '',
		'per' => '',
		'button_url' => '',
		'button_text' => 'Order'
	), $atts ) );
	
  $pricing_content = '';
  
  if ($featured =="yes") {
    $pricing_content .= '<div class="pricing-column feature-package">';
  } else {
    $pricing_content .= '<div class="pricing-column">';
  }
  $pricing_content .= '<h4 class="pricing-title">'.$title.'</h4>';
  $pricing_content .= '<div class="pricing-price">';
  $pricing_content .= '<h1>'. $price. '</h1>';
  $pricing_content .= '<p>'.$per.'<br/>'.$subtitle.'</p> ';
  $pricing_content .= '</div>';                 
  $pricing_content .= '<div class="pricing-feature">'.do_shortcode($content).'</div>';                
  $pricing_content .= '<div class="pricing-button">';
  $pricing_content .= '<a href="'. $button_url .'" class="button large gray">'. $button_text .'</a>';
  $pricing_content .= '</div>';                  
  $pricing_content .= '</div>';
  
	return $pricing_content;
}

?>
