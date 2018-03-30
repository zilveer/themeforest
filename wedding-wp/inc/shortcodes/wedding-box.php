<?php

function weddingbox_shortcode ($atts, $content = null) {
	extract(shortcode_atts(array(
		'title' 	=>'',
		'detail' 	=>'',
		'desc'		=>'',
		'mirror'=>'',	
	
	), $atts));
		 	$out  = '<div class="wedding-box '.$mirror.'">';
			$out .= '<h3>'.$title.'</h3>';
			$out .= '<h2>'.$detail.'</h2>';
			$out .= '<p>'.$desc.'</p>';
			$out .= '</div>';
			
return $out;
}
add_shortcode('weddingbox','weddingbox_shortcode');

?>