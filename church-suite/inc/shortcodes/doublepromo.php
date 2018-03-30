<?php
// Picture Box
 function webnus_doublepromo( $attributes, $content = null ) {
 	
	extract(shortcode_atts(array(
	"title" => '',
	"text" => '',
	"link_text" =>'',
	"link_link" =>'',
	"img" =>'',
	"img_alt" =>'',
	"last" =>'true',
	
		), $attributes));

	
	if(is_numeric($img)){
		
		$img = wp_get_attachment_url( $img );
		
	}
	
	
	$out = '<article class="dpromo col-md-6 ' . (( 'true' == $last)?'dpromo2 omega':'') . '">';
    $out .= '<div class="'.(( 'true' == $last )?'brdr-l1 pad-l40':'pad-r10').'">';
    $out .= '<h4><strong>' . $title . '</strong></h4>';
    $out .= '<img src="' . $img . '" class="alignright" alt="' . $img_alt . '">';
    $out .= '<p>' . $text . '</p>';
    if(!empty($link_link) && !empty($link_text))
    $out .= '<a href="' . $link_link . '" class="magicmore">' . $link_text . '</a>';
	$out .= '</div>';
    $out .= '</article>';
	return $out;
 }
 add_shortcode('doublepromo', 'webnus_doublepromo');
?>