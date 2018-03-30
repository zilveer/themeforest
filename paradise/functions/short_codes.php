<?php
// image
function img_shortcode($atts, $content, $code) {
	extract(shortcode_atts(array(
		'align' => '',
		'w' => 0,
		'h' => 0,
		'alt' => '',
		'title' => '',
		'mtop' => '',
		'mright' => '',
		'mbottom' => '',
		'mleft' => '',
	), $atts));
	if (empty($content))
		return;
	$styles = array();
	if ($align == 'left') {
		$styles['float'] = 'left';
		$styles['margin-right'] = '15px';
	} elseif ($align == 'right') {
		$styles['float'] = 'right';
		$styles['margin-left'] = '15px';
	}
	if (!empty($mtop) && is_numeric($mtop)) {
		$styles['margin-top'] = $mtop.'px';
	}
	if (!empty($mbottom) && is_numeric($mbottom)) {
		$styles['margin-bottom'] = $mbottom.'px';
	}
	if (!empty($mright) && is_numeric($mright)) {
		$styles['margin-right'] = $mright.'px';
	}
	if (!empty($mleft) && is_numeric($mleft)) {
		$styles['margin-left'] = $mleft.'px';
	}
	$styles['width'] = $w;
	$styles['height'] = $h;
	$src = get_bloginfo('template_url') . "/timthumb.php?src={$content}";
	if (!empty($w))
		$src .= "&amp;w={$w}";
	if (!empty($h))
		$src .= "&amp;h={$h}";
	$src .= "&amp;zc=1";

	$style = '';
	foreach ($styles as $key => $val) {
		$style .= $key.': '.$val.'; ';
	}
	$out = "<img src=\"{$src}\" style=\"{$style}\" class=\"pic\"";
	$out .= " alt=\"{$alt}\"";
	if (!empty($title))
		$out .= " title=\"{$title}\"";
	$out .= " width=\"{$w}\"";
	$out .= " height=\"{$h}\"";
	$out .= ' />';
	return $out;
}

add_shortcode('img', 'img_shortcode');
// quote
function quotetext_shortcode($atts, $content, $code) {
	extract(shortcode_atts(array(
		'w' => '',
		'align' => 'left',
		'top' => '0',
		'right' => '0',
		'bottom' => '0',
		'left' => '0',
	), $atts));
	if (!empty($w)) {
		$w = "width: {$w}px;";
	}
	return "<div class='align{$align}' style='{$w} margin:{$top}px {$right}px {$bottom}px {$left}px;'><blockquote><p>{$content}</p></blockquote></div>";
}
add_shortcode('quote', 'quotetext_shortcode');

// cufon
function cufon_shortcode($atts, $content, $code) {
	extract(shortcode_atts(array(
		'size' => '22',
		'color' => 'black',
		'top' => '0',
		'right' => '0',
		'bottom' => '0',
		'left' => '0',
	), $atts));
	if (empty($content))
		return;
	switch ($code) {
		case 'cufon_left':
			$class = 'cufon alignleft';
			break;
		case 'cufon_right':
			$class = 'cufon alignright';
			break;
		default:
			$class = 'cufon';
			break;
	}
	return "<div class=\"{$class}\" style=\"font-size:{$size}px; color:{$color}; padding:{$top}px {$right}px {$bottom}px {$left}px;\">{$content}</div>";
}
add_shortcode('cufon', 'cufon_shortcode');

// code
function code_shortcode($atts, $content, $code) {
	$content = htmlentities2($content);
	return "<code>$content</code>";
}
add_shortcode('code_block', 'code_shortcode');

// clearfix
function clear_shortcode($atts, $content, $code) {
	return "<div class=\"clear\"></div>";
}
add_shortcode('clear', 'clear_shortcode');

// testimonial box
function testimonial_shortcode($atts, $content, $code) {
	extract(shortcode_atts(array(
		'author' => '',
	), $atts));
	$out = "<div class=\"bubble_box\">$content</div><div class=\"bubble_corner\"></div>";
	if (!empty($author)) {
		$out .= "<span class=\"testi_author\"><strong>{$author}</strong></span>";
	}
	return $out;
}
add_shortcode('testimonial', 'testimonial_shortcode');

// info boxes
function info_boxes_shortcode($atts, $content, $code) {
	return "<div class=\"{$code}\">{$content}</div>";
}
add_shortcode('succsess_box', 'info_boxes_shortcode');
add_shortcode('warning_box', 'info_boxes_shortcode');
add_shortcode('error_box', 'info_boxes_shortcode');
add_shortcode('info_box', 'info_boxes_shortcode');
add_shortcode('bubble_box', 'bubble_box_shortcode');

// button
function button_shortcode($atts, $content, $code) {
	extract(shortcode_atts(array(
		'url' => '#',
		'title' => '',
		'align' => '',
		'target' => '_self',
		'size' => 'small',
		'rounded' => 'false',
		'border_size' => '',
		'border_color' => '',
	), $atts));
	$class = $code;
	$wrap_left = $wrap_right = '';
	$style = 'display:block;';
	switch($align) {
		case 'left':
			$class .= ' alignleft';
		break;
		case 'right':
			$class .= ' alignright';
		break;
		case 'wide':

		break;
		case 'center':
			$wrap_left = '<p style="margin: 0 auto; text-align:center;">';
			$wrap_right = '</p>';
			$style = 'display:inline-block;';
		break;
		default:
			$style = 'display:inline-block;';
		break;
	}
	if ($rounded == 'true') {
		$class .= ' rounded';
	}
	if (!empty($border_size)) {
		$style .= " border: {$border_size}px solid;";
	}
	if (!empty($border_color)) {
		$style .= " border-color: {$border_color};";
	}
	$class .= ' '.$size ;
	return "{$wrap_left}<a href=\"{$url}\" target=\"{$target}\" title=\"{$title}\" class=\"{$class}\" style=\"{$style}\">{$content}</a>{$wrap_right}";
}
add_shortcode('btn', 'button_shortcode');

// TAG <pre>
function pre_shortcode($atts, $content, $code) {
	return "<pre>{$content}</pre>";
}
add_shortcode('pre', 'pre_shortcode');

// columns
function columns_shortcode($atts, $content, $code) {
	global $short_code_row;
	$short_code_row++;
	extract(shortcode_atts(array(
		'indent' => 25,
		'top' => '',
		'bottom' => '',
	), $atts));
	$content = do_shortcode($content);
	$styles = array();
	if (!empty($top)) {
		$styles['margin-top'] = $top.'px';
	}
	if (!empty($bottom)) {
		$styles['margin-bottom'] = $bottom.'px';
	}
	$style = '';
	foreach($styles as $key => $val) {
		$style .= $key.': '.$val.'; ';
	}
	if (!empty($style))
		$style = "style=\"{$style}\"";
	return "<div class=\"auto-row-{$short_code_row}\" {$style}>
	{$content}
	<div class=\"clear\"></div>
</div>
<script type=\"text/javascript\">
	jQuery('.auto-row-{$short_code_row}').autoColumn({$indent}, 'div.auto-column');
	jQuery('.auto-row-{$short_code_row}').autoHeight('div.auto-column');
</script>";
}
add_shortcode('columns', 'columns_shortcode');

// column
function column_shortcode($atts, $content, $code) {
	extract(shortcode_atts(array(
		'places' => 1,
	), $atts));
	$content = do_shortcode($content);
	return "<div data-place=\"{$places}\" class=\"auto-column\">{$content}</div>";
}
add_shortcode('column', 'column_shortcode');

// icon
function icons_shortcode($atts, $content, $code) {
	extract(shortcode_atts(array(
		'src' => '',
		'align' => ''
	), $atts));
	if (empty($src) && isset($atts[0])) {
		$src = get_bloginfo('template_url').'/images/icons/' . strtolower($atts[0]) . '.png';
	}
	if (empty($align) && isset($atts[1])) {
		$align = " class=\"align{$atts[1]}\"";
	}
	if (!empty($src))
		return "<img src=\"{$src}\" {$align} />";
}
add_shortcode('icon', 'icons_shortcode');

// go to top
function top_shortcode($atts, $content, $code) {
	return "<div class=\"gototop\"><a href=\"#header\">top</a></div>";
}
add_shortcode('top', 'top_shortcode');

// headings h1 - h6
function heading_shortcode($atts, $content, $code) {
	extract(shortcode_atts(array(
		'img' => '',
		'icon' => '',
		'top' => '0',
		'right' => '0',
		'bottom' => '0',
		'left' => '0',
	), $atts));
	if (!empty($icon)) {
		$img = "<img src=\"" . get_bloginfo('template_url').'/images/icons/' . strtolower($icon) . '.png' . "\" class=\"iconleft\" />";
	}
	return "<div>{$img}<{$code} style=\"padding:{$top}px {$right}px {$bottom}px {$left}px;\">{$content}</{$code}></div>";
}
add_shortcode('h1', 'heading_shortcode');
add_shortcode('h2', 'heading_shortcode');
add_shortcode('h3', 'heading_shortcode');
add_shortcode('h4', 'heading_shortcode');
add_shortcode('h5', 'heading_shortcode');
add_shortcode('h6', 'heading_shortcode');

// dropcap
function dropcap_shortcode($atts, $content, $code) {
	$content = do_shortcode($content);
	return "<p class=\"dropcap\">{$content}</p>";
}
add_shortcode('dropcap', 'dropcap_shortcode');

// block
function block_shortcode($atts, $content, $code) {
	extract(shortcode_atts(array(
		'bg' => '',
		'border' => '',
		'textcolor' => '',
	), $atts));
	if (empty($bg) && isset($atts[0])){
		$bg = $atts[0];
	}
	if (empty($border) && isset($atts[1])){
		$border = $atts[1];
	}
	if (empty($textcolor) && isset($atts[2])){
		$textcolor = $atts[2];
	}
	$style = '';
	if (!empty($bg))
		$style .= 'background:'.$bg.'; ';
	if (!empty($border))
		$style .= 'border-color:'.$border.'; ';
	if (!empty($textcolor))
		$style .= 'color:'.$textcolor.'; ';
	if (!empty($style))
		$style = " style=\"{$style}\"";
	return "<div class=\"clear\"></div></div><div class=\"box\"{$style}>";
}
add_shortcode('block', 'block_shortcode');

// toggle block (only for developers)
function toggle_shortcode($atts, $content, $code) {
	$content = do_shortcode($content);
	$out = '<div class="dcs-toggle-flat" style="margin-left:0px;margin-bottom:15px;"><div class="toggle-flat-icon-open"></div><span class="toggle-flat-triger" style="font-weight: normal; color: rgb(255, 163, 25); background-color: rgb(10, 10, 10); ">'.__('Get the Code', TEMPLATENAME).'</span><div class="toggle-flat-content" style="padding-right: 10px; padding-left: 10px; display: none; padding-top: 15px; padding-bottom: 15px; ">';
	$out .= $content;
	$out .= '</div></div>';
	return $out;
}
add_shortcode('toggle', 'toggle_shortcode');

// hover box
function hover_box_shortcode($atts, $content, $code) {
	extract(shortcode_atts(array(
		'txt_color' => '',
		'txt_size' => '',
		'txt_align' => 'left',
		'round_corners' => 'false',
		'top' => '',
		'bottom' => '',
		'right' => '',
		'left' => '',
	), $atts));
	$style = '';
	if (!empty($txt_color))
		$style .= 'color: '.$txt_color.'; ';
	if (!empty($txt_size))
		$style .= 'font-size: '.$txt_size.'px; ';
	if (!empty($txt_align))
		$style .= 'text-align: '.$txt_align.'; ';
	if (!empty($top))
		$style = " margin-top=\"{$top}\"px; ";
	if (!empty($bottom))
		$style = " margin-bottom=\"{$bottom}\"px; ";
	if (!empty($right))
		$style = " margin-right=\"{$right}\"px; ";
	if (!empty($left))
		$style = " margin-left=\"{$left}\"px; ";
	if (!empty($style)) {
		$style = "style=\"{$style}\"";
	}
	$rounded = ($round_corners == 'true') ? ' rounded' : '';
	$content = do_shortcode($content);
	$out = "<div class=\"hover_box {$rounded}\" {$style}>{$content}</div>";
	return $out;
}
add_shortcode('hover_box', 'hover_box_shortcode');

// lists
function list_shortcode($atts, $content, $code) {
	$class = 'ordered';
	$list = 'ol';
	if (isset($atts[0])) {
		switch ($atts[0]) {
			case 'unordered':
				$list = 'ul';
				$class = $atts[0];
			break;
		}
	}
	$items = explode("\r\n", $content);
	$out = '';
	if (!empty($items)) {
		$out = '<div>';
		$out .= "<{$list} class=\"{$class}\">";
		foreach ($items as $item) {
			if (empty($item))
				continue;
			$out .= "<li><span>{$item}</span></li>";
		}
		$out .= "</{$list}>";
		$out .= '</div>';
	}
	return $out;
}
add_shortcode('list', 'list_shortcode');

// formatter [raw] (clears wordpress default additional unnecessary tags)
function my_formatter($content) {
		 $new_content = '';
		 $pattern_full = '{(\[raw\].*?\[/raw\])}is';
		 $pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
		 $pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

		 foreach ($pieces as $piece) {
					if (preg_match($pattern_contents, $piece, $matches)) {
							  $new_content .= $matches[1];
					} else {
							  $new_content .= wptexturize(wpautop($piece));
					}
		 }

		 return $new_content;
}
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');
add_filter('the_content', 'my_formatter', 99);

add_filter('widget_text', 'do_shortcode');

?>