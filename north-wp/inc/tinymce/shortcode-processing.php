<?php
/* Small Title Shortcodes */
function small_title($atts, $content = null ) {
    extract(shortcode_atts(array(
    	'title'      => 'Title'
    ), $atts));

	$out = '<div class="smalltitle">' .$title. '</div>';
	
  return $out;
}
add_shortcode('small_title', 'small_title');

/* Inline Label Shortcodes */
function tags($atts, $content = null ) {
    extract(shortcode_atts(array(
    	'color'      => 'gray'
    ), $atts));

	$out = '<span class="highlight '.$color.'">' .$content. '</span>';
	
    return $out;
}
add_shortcode('tags', 'tags');

/* Blockquote */
function blockquotes( $atts, $content = null ) {
    extract(shortcode_atts(array(
       	'pull'      => '',
       	'author'    => ''
    ), $atts));
	$authorhtml = '';
	if ($author) {
		$authorhtml = '<cite>'. $author. '</cite>';
	}
	$out = '<blockquote class="styled '.$pull.'"><p>' .$content. $authorhtml. '</p></blockquote>';
    return $out;
}
add_shortcode('blockquote', 'blockquotes');

/* Icons */
function icons( $atts, $content = null ) {
    extract(shortcode_atts(array(
       	'type'      => '',
       	'url'				=> '',
       	'box'				=> '',
       	'size'			=> 'icon-1x'
    ), $atts));
 
		$out = '<i class="fa '.$type.'"></i>';

  	if ($box) {

  		$class = '';
  		
  		switch ($type) {
  			case 'fa-facebook':
  				$class = 'facebook';
  				break;
  			case 'fa-twitter':
	  			$class = 'twitter';
	  			break;
	  		case 'fa-pinterest':
	  			$class = 'pinterest';
	  			break;
	  		case 'fa-linkedin':
	  			$class = 'linkedin';
	  			break;
	  		case 'fa-instagram':
	  			$class = 'instagram';
	  			break;
  		}
  		if ($type == 'fa-facebook' || $type == 'fa-twitter' || $type == 'fa-google-plus' || $type == 'fa-pinterest' || $type == 'fa-linkedin') {
  			$class = substr($type, 3);
  		}
  		$out = '<a href="'.$url.'" class="boxed-icon '.$class.' '. $size.'">'.$out.'</a>';
  	}	else {
  		$out = '<span class="inline-icon '. $size.' no-link"><i class="fa '.$type.' '. $size.'"></i></span>';
  	}
  	
  	return $out;
}
add_shortcode('icon', 'icons');

/* Dropcap */
function dropcap( $atts, $content = null ) {
    extract(shortcode_atts(array(
       	'boxed'      => 'black'
    ), $atts));
 		
		$out = '<span class="dropcap '.$boxed.'">'.$content.'</span>';
  	
  	return $out;
}
add_shortcode('dropcap', 'dropcap');