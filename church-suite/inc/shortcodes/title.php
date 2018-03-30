<?php

  // Subtitle
 function webnus_subtitle ($atts, $content = null) {
 	extract(shortcode_atts(array(
 	'type'      => '1',
 	'subtitle_content'      => '',
 	
						), $atts));

$out= '';
	switch($type){
		case 1:
		 	$out = '<h4 class="subtitle">';
		 	$out .= $subtitle_content;
		 	$out .= '</h4>';
		break;
		case 2:
			$out =  '<div class="title">';
			$out .= '<h4>'. $subtitle_content .'</h4>';
			$out .= '</div>';			
		break;
		case 3:
			$out =  '<div class="sub-content">';
			$out .= '<h6 class="h-sub-content">'. $subtitle_content .'</h6>';
			$out .= '</div>';			
		break;
		case 4:
		
			$out =  '<div class="subtitle-four"><h4>'. $subtitle_content .'</h4></div>';		
		break;
		case 5:
			$out =  '<div class="sub-title"><h4>'. $subtitle_content .'</h4></div>';		
		break;
	}
 	return $out;
 }
 add_shortcode('subtitle','webnus_subtitle');




/*  bigtitle */


function bigtitle_shortcode ($atts, $content = null) {
	extract(shortcode_atts(array(
	'heading'  		 => '2',
	'bigtitle_content' => '',
	'aligncenter'	 => '',
	), $atts));

	$align=($aligncenter)?' aligncenter':'';
	$out = '<h'.$heading.' class="big-title1'.$align.'">'. $bigtitle_content .'</h'.$heading.'>';	
	
	return $out;
}

add_shortcode('big_title','bigtitle_shortcode');






function bigtitle2_shortcode ($atts, $content = null) {
	extract(shortcode_atts(array(
	'title'      => '',
	'bigtitle'      => '',
	
		), $atts));

	
	$out = '<h2 class="mex-title">'. $bigtitle .'</h2>';
	
	return $out;
}
add_shortcode('big_title2','bigtitle2_shortcode');

function webnus_title($atts, $content = null)
{
	extract(shortcode_atts(array(
	'type'      => '4',

	), $atts));

	$out = '<h'.$type.'><strong>'.$content.'</strong></h'.$type.'>';
	return $out;
}

add_shortcode('title', 'webnus_title');



 // Max Title


function maxtitle_shortcode ($atts, $content = null) {
	extract(shortcode_atts(array(
	'type'      => '1',
	'heading'   =>'2',
	'maxtitle_content' => '',
						), $atts));
						
		$out = '<div class="max-title'.$type.'"><h' .$heading.'>'. $maxtitle_content .'</h2></div>';	
	
	return $out;
}
add_shortcode('maxtitle','maxtitle_shortcode');





?>