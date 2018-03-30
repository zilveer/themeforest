<?php

function infobox_shortcode ($atts, $content = null) {
	extract(shortcode_atts(array(
		'title' 		=>'',
		'icon_image'	=>'',
		'icon_name'		=>''
	), $atts));
	ob_start();


 	echo '<div class="infobox">';	
	echo '<div class="infobox-overlay">';
	if(!empty($icon_name) && $icon_name != 'none')
	echo do_shortcode(  "[icon name='$icon_name']" );
	echo '<h4>' . $title . '</h4>';
	echo '</div>'; // end over
	echo '<div class="infobox-content">';
	if(!empty($icon_name) && $icon_name != 'none')
	echo '<h4>' . do_shortcode(  "[icon name='$icon_name']" ) . '<span>' . $title . '</span></h4>';
	echo '<p>' . $content . '</p>';
	echo '</div>'; // end content
	echo '</div>';

$out = ob_get_contents();
ob_end_clean();
$out = str_replace('<p></p>','',$out);
	
	return $out;
}
add_shortcode('infobox','infobox_shortcode');

?>