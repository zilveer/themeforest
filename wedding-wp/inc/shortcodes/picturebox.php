<?php
// Picture Box
 function webnus_picturebox( $attributes, $content = null ) {
 	
	extract(shortcode_atts(array(
	"title" => '',
	"text" => '',
	"link_text" =>'',
	"link_link" =>'#',
	"img" =>'',
	"img_alt" =>'',
	"last" =>'',
	
		), $attributes));

	
	$out = '<article class="col-md-6 ' . (( 'true' == $last)?'alpha omega':'') . '">';
    $out .= '<div class="'.(( 'true' == $last )?'brdr-l1 pad-l40':'pad-r10').'">';
    $out .= '<h4><strong>' . $title . '</strong></h4>';
    $out .= '<img src="' . $img . '" class="alignright" alt="' . $img_alt . '">';
    $out .= '<p>' . $text . '</p>';
    $out .= '<a href="' . $link_link . '" class="magicmore">' . $link_text . '</a>';
	$out .= '</div>';
    $out .= '</article>';
	return $out;
 }
 add_shortcode('picturebox', 'webnus_picturebox');
?>