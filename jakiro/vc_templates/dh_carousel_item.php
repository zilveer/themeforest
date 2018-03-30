<?php
global $dh_carousel_visible;
$md_clss = (12/$dh_carousel_visible);
if($dh_carousel_visible == 5){
	$md_clss = '15';
}
$output = '';
$output .='<li class="caroufredsel-item col-md-'.$md_clss.' col-sm-6">';
$output .= wpb_js_remove_wpautop($content);
$output .='</li>';
echo $output;
