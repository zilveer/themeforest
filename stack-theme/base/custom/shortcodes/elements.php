<?php

// Spacer
add_shortcode('su_nt_spacer', 'theme_shortcode_spacer');
add_shortcode('spacer', 'theme_shortcode_spacer');
function theme_shortcode_spacer($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'size' => '20', // 20, 40
	), $atts));
	$return = '<div class="spacer" style="padding: '.($size/2).'px 0;"></div>';
	return $return;
}

// Divider
add_shortcode('su_nt_divider', 'theme_shortcode_divider');
add_shortcode('divider', 'theme_shortcode_divider');
function theme_shortcode_divider($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => '1', // 1, 2
	), $atts));
	if( $style == 1 ) $return = '<div class="divider"></div>';
	elseif ( $style == 2 ) $return = '<div class="divider"><div class="spot"></div></div>';
	return $return;
}

// Video
add_shortcode('su_nt_video', 'theme_shortcode_video');
add_shortcode('video', 'theme_shortcode_video');
function theme_shortcode_video($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'type' => 'youtube', // youtube, vimeo
		'id' => false,
		'width' => '185',
		'height' => '150'
	), $atts));
	$return = '<div class="video-container" style="width: '.$width.'px">';
	if( $type == 'youtube' ) $return .= '<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$id.'?showinfo=0&controls=1&rel=0" frameborder="0" allowfullscreen></iframe>';
	elseif( $type == 'vimeo' ) $return .= '<iframe src="http://player.vimeo.com/video/'.$id.'?title=0" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
	$return .= '</div>';
	return $return;
}

// Button
add_shortcode('su_nt_button', 'theme_shortcode_button');
add_shortcode('button', 'theme_shortcode_button');
function theme_shortcode_button($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'size' => 'small', // small, medium, large
		'target' => '_blank',
		'type' => 'primary',
		'style' => 'default',
		'url' => '#'
	), $atts));
	$size = $size ? 'button-' . $size : '';
	$type = $type ? 'button-' . $type : '';
	$style = $style ? 'button-' . $style : '';
	$content = do_shortcode( trim( $content ) );
	$return = '<a href="'.$url.'" target="'.$target.'" class="button '.$size.' '.$type.' '.$style.'">' . $content . '</a>';
	return $return;
}

// Icon
add_shortcode('su_nt_icon', 'theme_shortcode_icon');
add_shortcode('icon', 'theme_shortcode_icon');
function theme_shortcode_icon($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'id' => 'icon-circle' // more detail: http://fortawesome.github.com/Font-Awesome/
	), $atts));
	$return = '<i class="icon '.$id.'"></i>';	
	return $return;
}

// Box
add_shortcode('su_nt_box', 'theme_shortcode_box');
add_shortcode('box', 'theme_shortcode_box');
function theme_shortcode_box($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => 'grey', // grey, green, red, yellow
		'closable' => 'closable', // closable, un-closable
	), $atts));
	$style = 'box-' . $style;
	$closable = 'box-' . $closable;
	$content = do_shortcode( trim( $content ) );
	return '<div class="box '.$style.' '.$closable.'">'.$content.' <i class="icon icon-times-circle"></i></div>';
}

// Blockquote
add_shortcode('su_nt_quote', 'theme_shortcode_quote');
add_shortcode('quote', 'theme_shortcode_quote');
function theme_shortcode_quote($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'name' => false,
		'meta' => false
	), $atts));
	$content = apply_filters('the_content', $content);
	$name = $name ? '<cite><strong>'. $name .'</strong>'. $meta .'</cite>' : '';
	return <<<EOT
<blockquote>$content$name</blockquote>
EOT;
}

// Dropcap
add_shortcode('su_nt_dropcap', 'theme_shortcode_dropcap');
add_shortcode('dropcap', 'theme_shortcode_dropcap');
function theme_shortcode_dropcap($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'letter' => 'A',
	), $atts));
	return '<span class="dropcap">'.$letter.'</span>';
}

// Image
add_shortcode('su_nt_image', 'theme_shortcode_image');
add_shortcode('image', 'theme_shortcode_image');
function theme_shortcode_image($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'source' => false,
		'width' => 'full', // full, full_sidebar, one_half, one_third, two_third, one_fourth, three_fourth
		'lightbox' => false, // image, youtube, vimeo
		'link' => false,
		'target' => '_self' // _self, _blank 
	), $atts));
	switch ($width) {
		case 'full':
			$width = 940;
			break;
		case 'full_sidebar':
			$width = 600;
			break;
		case 'one_half':
			$width = 460;
			break;
		case 'one_third':
			$width = 300;
			break;
		case 'two_third':
			$width = 620;
			break;
		case 'one_fourth':
			$width = 290;
			break;
		case 'three_fourth':
			$width = 700;
			break;
	}
	

	$ret = gen_responsive_image_block( $source, array(
					array( 'width' => $width ),
					array( 'width' => $width*2, 'media' => '(-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' )
				)
			);

	if( $lightbox == 'youtube' || $lightbox == 'vimeo' ) {
		$ret .= '<i class="icon icon-play-circle overlay-icon overlay-icon-stay"></i>';
	} else if( $lightbox == 'image' ) {
		$ret .= '<i class="icon icon-plus overlay-icon"></i>';
	}

	if( $link ) {
		$fancy = ( $lightbox ) ? 'fancy-'.$lightbox : '';
		$ret = '<a href="'.$link.'" class="'.$fancy.'" target="'.$target.'" data-group="group">' . $ret . '</a>';
	}

	return '<div class="img-box">'.$ret.'</div>';
}

// List
add_shortcode('su_nt_list', 'theme_shortcode_ul');
add_shortcode('ul', 'theme_shortcode_ul');
function theme_shortcode_ul($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'icon' => 'icon-circle', // more detail on : http://fortawesome.github.io/Font-Awesome/
		'color' => 'default' // default, grey, red, green, blue, yellow, magenta
	), $atts));
	$color = $color ? ' list-'. $color : '';

	if (!preg_match_all("/(.?)\[(li)\b(.*?)(?:(\/))?\](?:(.+?)\[\/li\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		
		$output = '';
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<li><i class="icon '.$icon.'"></i> ' . do_shortcode(trim($matches[5][$i])) . '</li>';
		}
		
		return '<ul class="bullet-less-list ' . $color . '">' . $output . '</ul>';
	}
}

// Tab
add_shortcode('su_nt_tabs', 'theme_shortcode_tabs');
add_shortcode('tabs', 'theme_shortcode_tabs');
function theme_shortcode_tabs($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'type' => 'normal',
		'active_tab' => 1 // index from 1
	), $atts));
	
	$active_tab -= 1;
	$active_tab = 'data-active="'. $active_tab .'"';
	
	if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
	
		$output = '<ul class="tabs '.$code.'" '. $active_tab .'>';
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<li>' . $matches[3][$i]['title'] . '</li>';
		}
		$output .= '</ul>';
			
		$output .= '<div class="panes">';
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<div class="pane">' . do_shortcode(trim($matches[5][$i])) . '</div>';
		}
		$output .= '</div>';
		
		return '<div class="tabs-wrap '. $code .'-wrap">' . $output . '</div>';
	}
}

// Accordion
add_shortcode('su_nt_accordions', 'theme_shortcode_accordions');
add_shortcode('accordions', 'theme_shortcode_accordions');
function theme_shortcode_accordions($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'active_tab' => 1
	), $atts));
	
	$active_tab -= 1;
	$active_tab = 'data-active="'. $active_tab .'"';
	
	if (!preg_match_all("/(.?)\[(accordion)\b(.*?)(?:(\/))?\](?:(.+?)\[\/accordion\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
		
		$output = '';
		for($i = 0; $i < count($matches[0]); $i++) {
			$href = '#';
			$output .= '<div class="tab"><i class="icon icon-plus"></i><i class="icon icon-minus"></i> '. $matches[3][$i]['title'] .'</div>';
			$output .= '<div class="pane clearfix">'. do_shortcode(trim($matches[5][$i])) .'</div>';
		}
		
		return '<div class="accordions-wrap '. $code .'-wrap" '. $active_tab .'>' . $output . '</div>';
	}
}

// Toggle
add_shortcode('su_nt_toggle', 'theme_shortcode_toggle');
add_shortcode('toggle', 'theme_shortcode_toggle');
function theme_shortcode_toggle($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'state' => 'open',
		'title' => 'Toggle'
	), $atts));
	return '<div class="toggle-wrap" data-state="'.$state.'"><div class="tab"><i class="icon icon-plus"></i><i class="icon icon-minus"></i> '. $title .'</div><div class="pane clearfix">' . do_shortcode(trim($content)) . '</div></div>';
}
