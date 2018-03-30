<?php
function webnus_teaserbox ($atts, $content = null) {
 	extract(shortcode_atts(array(
	"type"		  =>'1',
 	"img"         =>'',
 	"img_alt"     =>'',
 	'subtitle'    =>'',
 	'subtitle_bg' =>'',
	'title'	      =>'',
	"link_url"   =>'#',
	'text'        =>'',
 	'icon'	      =>'',
 	'icon_bg'     =>'',
	), $atts));
	
	$out = '';
	
	if(is_numeric($img)){
		
		$img = wp_get_attachment_url( $img );
		
	}

	switch ($type) {
		case 1:
			$subtitle_style = !empty($subtitle_bg) ? 'class="subtitle-bg" style="background-color:'.$subtitle_bg.';"' : '' ;
			$out .= '<div class="teaser-box1">';
			// image wrapper
			$out .= '<div class="image-wrapper">';
			$out .= '<div class="iconbg-w" style="background-color:'.$icon_bg.'"><i class="'.$icon.'"></i></div>';
			$out .= '<img src="'. $img .'" alt="' . $img_alt . '">';
			$out .= '</div>';
			// content wrapper
			$out .= '<div class="content-wrapper">';
			$out .= '<a href="'.$link_url.'">';
			if (!empty($subtitle))
			$out .= '<h5 '.$subtitle_style.'>'.$subtitle.'</h5>';
			$out .= '<h4>'.$title.'</h4>';
			$out .= '</a>';
			$out .= '<p>'.$text.'</p>';
			$out .= '</div></div>';
		break;
		
		case 2:
			$out .= '<div class="teaser-box2">';
			// image
			$out .= '<img src="'. $img .'" alt="">';
			// content and icon wrapper
			$out .= '<div class="content-wrapper">';
			if ( !empty($icon) && $icon!='none' ) 
			$out .= '<div class="iconbg-w" style="background-color:'.$icon_bg.'"><i class="'.$icon.'"></i></div>';
			$out .= '<a href="'.$link_url.'">';
			if (!empty($subtitle))
			$out .= '<h5 style="background-color:'.$subtitle_bg.'">'.$subtitle.'</h5>';
			$out .= '<h2><strong>'.$title.'</strong></h2>';
			$out .= '</a>';
			if (!empty($text))
			$out .= '<p>'.$text.'</p>';
			$out .= '<div class="line"></div>';
			$out .= '</div></div>';
		break;
	}

return $out;
}
 add_shortcode('teaserbox','webnus_teaserbox');
?>