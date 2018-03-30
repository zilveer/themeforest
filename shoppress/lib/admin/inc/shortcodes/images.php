<?php

if ( ! function_exists( 'gp_image' ) ) {
	function gp_image($atts, $content = null) {
		extract(shortcode_atts(array(
			'url' => '',
			'width' => '',
			'height' => '',
			'link' => '',
			'target' => '_self',
			'border' => 'false',
			'align' => 'alignleft',
			'margins' => '',
			'top' => '',
			'right' => '',
			'bottom' => '',
			'left' => '',		
			'alt' => '',
			'title' => '',
			'lightbox' => 'none',
			'preload' => 'false',
			'caption' => '',
			'caption_position' => 'caption-bottomleft',
			'caption_size' => '',
			'caption_link' => '',	
			'caption_link_text' => __( 'View &raquo;', 'gp_lang' ),
			'classes' => '',
		),$atts));
	
		global $dirname;
	
	
		// Position
	
		if($top != '' OR $bottom != '' OR $left != '' OR $right != '') {
			$position = "position: absolute; ";
		} else {
			$position = "";
		}
		if($top != '') {
			$top = 'top:'.$top.'px; ';
		} else {
			$top = '';
		}
		if($right != '') {
			$right = 'right:'.$right.'px; ';
		} else {
			$right = '';
		}
		if($bottom != '') {
			$bottom = 'bottom:'.$bottom.'px; ';
		} else {
			$bottom = '';
		}
		if($left != '') {
			$left = 'left:'.$left.'px; ';
		} else {
			$left = '';
		}
	

		// Margins
	
		if($margins != "") {
			if(preg_match('/%/', $margins) OR preg_match('/em/', $margins) OR preg_match('/px/', $margins)) {
				$margins = str_replace(",", " ", $margins);
				$margins = 'margin: '.$margins.'; ';
			} else {
				$margins = str_replace(",", "px ", $margins);
				$margins = 'margin: '.$margins.'px; ';
			}
			$margins = str_replace("autopx", "auto", $margins);
		} else {
			$margins = "";
		}
	
	
		// Lightbox
	
		if($lightbox == "image") {
			$lightbox_hover = '<span class="hover-image"></span>';
			$rel = "prettyPhoto";
		} elseif($lightbox == "video") {
			$lightbox_hover = '<span class="hover-video"></span>';
			$rel = "prettyPhoto";
		} else {
			$lightbox_hover = '';
			$rel = '';
		}
		
		
		// Image Link
	
		if($link != "") {
			if($lightbox != "none") {
				$link1 = '<a href="'.$link.'" title="'.$title.'" rel="'.$rel.'" target="'.$target.'">';
			} else {
				$link1 = '<a href="'.$link.'" title="'.$title.'" target="'.$target.'">';
			}
			$link2 = '</a>';
		} else {
			$link1 = '';	
			$link2 = '';
		}


		// Image Border
	
		if($border == "true") {
			$border = "image-border";
		} else {
			$border = "";
		}
	
	
		// Image URL
	
		if(!preg_match("/http:/", $url) && !preg_match("/https:/", $url)) { $url = site_url().'/'.$url; }
	
		if($width OR $height) {
			$url = aq_resize($url, $width, $height, true, true, true);
		} else {
			$url = $url;
		}
	
	
		// Retina
	
		if(get_option($dirname."_retina") == "0") { 
			$retina = aq_resize($url, $width*2, $height*2, true, true, true);
		} else {
			$retina = "";
		}
	

		// Caption

		if($caption_link_text) {
			$caption_link_text = '<a href="'.$caption_link.'" title="'.$title.'" rel="'.$rel.'" target="'.$target.'" class="caption-link">'.$caption_link_text.'</a>';
		} else {
			$caption_link_text = "";
		}
	
		if($caption) {
			$caption = '<div class="caption '.$caption_position.'" style="font-size: '.$caption_size.'px;"><div class="caption-title">'.$caption.'</div>'.$caption_link_text.'</div>';
		} else {
			$caption = '';
		}
		
		
		return '
	
		<div class="sc-image '.$align.' '.$border.' ' . $classes . '" style="'.$position.$top.$bottom.$left.$right.$margins.' width: '.$width.'px; height: '.$height.'px;">
		
			'.$lightbox_hover.$caption.'
		
			'.$link1.'<img src="'.$url.'" data-rel="'.$retina.'" alt="'.$alt.'" width="'.$width.'" height="'.$height.'" />'.$link2.'
		
		</div>
	
		';

	}
}
add_shortcode("image", "gp_image");

?>