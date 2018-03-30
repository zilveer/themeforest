<?php
/**
*	Shortcodes
*/
/**
 * Disable Automatic Formatting on Posts
 *
 * @param string $content
 * @return string
 */
function raw_formatter($content) {

	$new_content = '';
	
	/* Matches the contents and the open and closing tags */
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	
	/* Matches just the contents */
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	
	/* Divide content into pieces */
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	/* Loop over pieces */
	foreach ($pieces as $piece) {
	
		/* Look for presence of the shortcode */
		if (preg_match($pattern_contents, $piece, $matches)) {
		
			/* Append to content (no formatting) */
			$new_content .= $matches[1];
		
		} else {
		
			/* Format and append to content */
			$new_content .= wptexturize(wpautop($piece));
		
		}
	}

	return $new_content;
}
function place_shortcode($shortcode){
	return do_shortcode(stripslashes($shortcode));
}

/* Remove the 2 main auto-formatters */
remove_filter('the_content',	'wpautop');
remove_filter('the_content',	'wptexturize');

/* Before displaying for viewing, apply this function */
add_filter('the_content', 'raw_formatter', 99);

//shortcode feature list
function themeteam_feature_list_one_third($atts,$content=null){
	extract(shortcode_atts(array('icon' => 'http://origami.gothemeteam.com/wp-content/themes/origami/images/icon_1.png','title' => 'Lorem Ipsum','link' => 'http://gothemeteam.com',), $atts));

	return '<section class="grid_4 feature"><h2><img src="' .$icon. '" alt="" />&nbsp;&nbsp;<a href="'.$link.'">' .$title. '</a></h2><p>'.do_shortcode($content).'</p></section>';
}
add_shortcode('feature_list_third', 'themeteam_feature_list_one_third');

function themeteam_feature_list_one_third_last($atts,$content=null){
	extract(shortcode_atts(array('icon' => 'http://origami.gothemeteam.com/wp-content/themes/origami/images/icon_1.png','title' => 'Lorem Ipsum','link' => 'http://gothemeteam.com',), $atts));
	return '<section class="grid_4 feature"><h2><img src="' .$icon. '" alt="" />&nbsp;&nbsp;<a href="'.$link.'">' .$title. '</a></h2><p>'.do_shortcode($content).'</p></section><div class="clear"><!--clear fix--></div>';
}
add_shortcode('feature_list_third_last', 'themeteam_feature_list_one_third_last');

function themeteam_feature_list_half($atts,$content=null){
	extract(shortcode_atts(array('icon' => 'http://origami.gothemeteam.com/wp-content/themes/origami/images/icon_1.png','title' => 'Lorem Ipsum','link' => 'http://gothemeteam.com',), $atts));

	return '<section class="grid_6 feature"><h2><img src="' .$icon. '" alt="" />&nbsp;&nbsp;<a href="'.$link.'">' .$title. '</a></h2><p>'.do_shortcode($content).'</p></section>';
}
add_shortcode('feature_list_half', 'themeteam_feature_list_half');

function themeteam_feature_list_half_last($atts,$content=null){
	extract(shortcode_atts(array('icon' => 'http://origami.gothemeteam.com/wp-content/themes/origami/images/icon_1.png','title' => 'Lorem Ipsum','link' => 'http://gothemeteam.com',), $atts));
	return '<section class="grid_6 feature"><h2><img src="' .$icon. '" alt="" />&nbsp;&nbsp;<a href="'.$link.'">' .$title. '</a></h2><p>'.do_shortcode($content).'</p></section><div class="clear"><!--clear fix--></div>';
}
add_shortcode('feature_list_half_last', 'themeteam_feature_list_half_last');

function themeteam_feature_list_quarter($atts,$content=null){
	extract(shortcode_atts(array('icon' => 'http://origami.gothemeteam.com/wp-content/themes/origami/images/icon_1.png','title' => 'Lorem Ipsum','link' => 'http://gothemeteam.com',), $atts));

	return '<section class="grid_3 feature"><h2><img src="' .$icon. '" alt="" />&nbsp;&nbsp;<a href="'.$link.'">' .$title. '</a></h2><p>'.do_shortcode($content).'</p></section>';
}
add_shortcode('feature_list_quarter', 'themeteam_feature_list_quarter');

function themeteam_feature_list_quarter_last($atts,$content=null){
	extract(shortcode_atts(array('icon' => 'http://origami.gothemeteam.com/wp-content/themes/origami/images/icon_1.png','title' => 'Lorem Ipsum','link' => 'http://gothemeteam.com',), $atts));
	return '<section class="grid_3 feature"><h2><img src="' .$icon. '" alt="" />&nbsp;&nbsp;<a href="'.$link.'">' .$title. '</a></h2><p>'.do_shortcode($content).'</p></section><div class="clear"><!--clear fix--></div>';
}
add_shortcode('feature_list_quarter_last', 'themeteam_feature_list_quarter_last');


/* Pricing grid */
function themeteam_pricing_grid_quarter($atts,$content=null){
	extract(shortcode_atts(array(
		'header_text' => 'Plan 1',
		'price' => '$20',
		'duration' => 'Month',
		'plan_link' => 'http://origami.gothemeteam.com',
		'plan_text' => 'Choose plan',
		'color' => 'darkgreen'
	), $atts));
	
	$out .= '<div class="grid_3"><section class="grid '.$color.'"><h1>';
	$out .= $header_text;
	$out .= '</h1><details open><summary><strong>';
	$out .= $price;
	$out .= '</strong>/<em>'.$duration.'</em></summary>';
	$out .= do_shortcode($content);
	$out .= '<footer><a href="';
	$out .= $plan_link;
	$out .= '" class="button small '.$color.'"><span><span>';
	$out .= $plan_text;
	$out .= '</span></span></a></footer></details></section></div>';
	
	return raw_formatter($out);
}

add_shortcode('pricing_grid_quarter', 'themeteam_pricing_grid_quarter');

function themeteam_pricing_grid_quarter_last($atts,$content=null){
	extract(shortcode_atts(array(
		'header_text' => 'Plan 1',
		'price' => '$20',
		'duration' => 'Month',
		'plan_link' => 'http://origami.gothemeteam.com',
		'plan_text' => 'Choose plan',
		'color' => 'darkgreen'
	), $atts));
	
	$out .= '<div class="grid_3"><section class="grid '.$color.'"><h1>';
	$out .= $header_text;
	$out .= '</h1><details open><summary><strong>';
	$out .= $price;
	$out .= '</strong>/<em>'.$duration.'</em></summary>';
	$out .= do_shortcode($content);
	$out .= '<footer><a href="';
	$out .= $plan_link;
	$out .= '" class="button small '.$color.'"><span><span>';
	$out .= $plan_text;
	$out .= '</span></span></a></footer></details></section></div><div class="clear"> </div>';
	
	return raw_formatter($out);
}

add_shortcode('pricing_grid_quarter_last', 'themeteam_pricing_grid_quarter_last');
//half
function themeteam_pricing_grid_half($atts,$content=null){
	extract(shortcode_atts(array(
		'header_text' => 'Plan 1',
		'price' => '$20',
		'duration' => 'Month',
		'plan_link' => 'http://origami.gothemeteam.com',
		'plan_text' => 'Choose plan',
		'color' => 'darkgreen'
	), $atts));
	
	$out .= '<div class="grid_6"><section class="grid '.$color.'"><h1>';
	$out .= $header_text;
	$out .= '</h1><details open><summary><strong>';
	$out .= $price;
	$out .= '</strong>/<em>'.$duration.'</em></summary>';
	$out .= do_shortcode($content);
	$out .= '<footer><a href="';
	$out .= $plan_link;
	$out .= '" class="button small '.$color.'"><span><span>';
	$out .= $plan_text;
	$out .= '</span></span></a></footer></details></section></div>';
	
	return raw_formatter($out);
}

add_shortcode('pricing_grid_half', 'themeteam_pricing_grid_half');

function themeteam_pricing_grid_half_last($atts,$content=null){
	extract(shortcode_atts(array(
		'header_text' => 'Plan 1',
		'price' => '$20',
		'duration' => 'Month',
		'plan_link' => 'http://origami.gothemeteam.com',
		'plan_text' => 'Choose plan',
		'color' => 'darkgreen'
	), $atts));
	
	$out .= '<div class="grid_6"><section class="grid '.$color.'"><h1>';
	$out .= $header_text;
	$out .= '</h1><details open><summary><strong>';
	$out .= $price;
	$out .= '</strong>/<em>'.$duration.'</em></summary>';
	$out .= do_shortcode($content);
	$out .= '<footer><a href="';
	$out .= $plan_link;
	$out .= '" class="button small '.$color.'"><span><span>';
	$out .= $plan_text;
	$out .= '</span></span></a></footer></details></section></div><div class="clear"> </div>';
	
	return raw_formatter($out);
}

add_shortcode('pricing_grid_half_last', 'themeteam_pricing_grid_half_last');
//third
function themeteam_pricing_grid_third($atts,$content=null){
	extract(shortcode_atts(array(
		'header_text' => 'Plan 1',
		'price' => '$20',
		'duration' => 'Month',
		'plan_link' => 'http://origami.gothemeteam.com',
		'plan_text' => 'Choose plan',
		'color' => 'darkgreen'
	), $atts));
	
	$out .= '<div class="grid_4"><section class="grid '.$color.'"><h1>';
	$out .= $header_text;
	$out .= '</h1><details open><summary><strong>';
	$out .= $price;
	$out .= '</strong>/<em>'.$duration.'</em></summary>';
	$out .= do_shortcode($content);
	$out .= '<footer><a href="';
	$out .= $plan_link;
	$out .= '" class="button small '.$color.'"><span><span>';
	$out .= $plan_text;
	$out .= '</span></span></a></footer></details></section></div>';
	
	return raw_formatter($out);
}

add_shortcode('pricing_grid_third', 'themeteam_pricing_grid_third');

function themeteam_pricing_grid_third_last($atts,$content=null){
	extract(shortcode_atts(array(
		'header_text' => 'Plan 1',
		'price' => '$20',
		'duration' => 'Month',
		'plan_link' => 'http://origami.gothemeteam.com',
		'plan_text' => 'Choose plan',
		'color' => 'darkgreen'
	), $atts));
	
	$out .= '<div class="grid_4"><section class="grid '.$color.'"><h1>';
	$out .= $header_text;
	$out .= '</h1><details open><summary><strong>';
	$out .= $price;
	$out .= '</strong>/<em>'.$duration.'</em></summary>';
	$out .= do_shortcode($content);
	$out .= '<footer><a href="';
	$out .= $plan_link;
	$out .= '" class="button small '.$color.'"><span><span>';
	$out .= $plan_text;
	$out .= '</span></span></a></footer></details></section></div><div class="clear"> </div>';
	
	return raw_formatter($out);
}

add_shortcode('pricing_grid_third_last', 'themeteam_pricing_grid_third_last');
//small
function themeteam_pricing_grid_small($atts,$content=null){
	extract(shortcode_atts(array(
		'header_text' => 'Plan 1',
		'price' => '$20',
		'duration' => 'Month',
		'plan_link' => 'http://origami.gothemeteam.com',
		'plan_text' => 'Choose plan',
		'color' => 'darkgreen'
	), $atts));
	
	$out .= '<div class="grid_2"><section class="grid '.$color.'"><h1>';
	$out .= $header_text;
	$out .= '</h1><details open><summary><strong>';
	$out .= $price;
	$out .= '</strong>/<em>'.$duration.'</em></summary>';
	$out .= do_shortcode($content);
	$out .= '<footer><a href="';
	$out .= $plan_link;
	$out .= '" class="button small '.$color.'"><span><span>';
	$out .= $plan_text;
	$out .= '</span></span></a></footer></details></section></div>';
	
	return raw_formatter($out);
}

add_shortcode('pricing_grid_small', 'themeteam_pricing_grid_small');

function themeteam_pricing_grid_small_last($atts,$content=null){
	extract(shortcode_atts(array(
		'header_text' => 'Plan 1',
		'price' => '$20',
		'duration' => 'Month',
		'plan_link' => 'http://origami.gothemeteam.com',
		'plan_text' => 'Choose plan',
		'color' => 'darkgreen'
	), $atts));
	
	$out .= '<div class="grid_2"><section class="grid '.$color.'"><h1>';
	$out .= $header_text;
	$out .= '</h1><details open><summary><strong>';
	$out .= $price;
	$out .= '</strong>/<em>'.$duration.'</em></summary>';
	$out .= do_shortcode($content);
	$out .= '<footer><a href="';
	$out .= $plan_link;
	$out .= '" class="button small '.$color.'"><span><span>';
	$out .= $plan_text;
	$out .= '</span></span></a></footer></details></section></div><div class="clear"> </div>';
	
	return raw_formatter($out);
}

add_shortcode('pricing_grid_small_last', 'themeteam_pricing_grid_small_last');

/*column shortcodes*/
function themeteam_column_half($atts,$content=null){
	$out .= '<section class="grid_6 entry">';
	$out .= do_shortcode($content);
	$out .= '</section>';
	
	return raw_formatter($out);
}
add_shortcode('column_half', 'themeteam_column_half');

function themeteam_column_half_last($atts,$content=null){
	$out .= '<section class="grid_6 entry">';
	$out .= do_shortcode($content);
	$out .= '</section><div class="clear"> </div>';
	
	return raw_formatter($out);
}
add_shortcode('column_half_last', 'themeteam_column_half_last');

function themeteam_column_third($atts,$content=null){
	$out .= '<section class="grid_4 entry">';
	$out .= do_shortcode($content);
	$out .= '</section>';
	
	return raw_formatter($out);
}
add_shortcode('column_third', 'themeteam_column_third');

function themeteam_column_third_last($atts,$content=null){
	$out .= '<section class="grid_4 entry">';
	$out .= do_shortcode($content);
	$out .= '</section><div class="clear"> </div>';
	
	return raw_formatter($out);
}
add_shortcode('column_third_last', 'themeteam_column_third_last');

function themeteam_column_quarter($atts,$content=null){
	$out .= '<section class="grid_3 entry">';
	$out .= do_shortcode($content);
	$out .= '</section>';
	
	return raw_formatter($out);
}
add_shortcode('column_quarter', 'themeteam_column_quarter');

function themeteam_column_quarter_last($atts,$content=null){
	$out .= '<section class="grid_3 entry">';
	$out .= do_shortcode($content);
	$out .= '</section><div class="clear"> </div>';
	
	return raw_formatter($out);
}
add_shortcode('column_quarter_last', 'themeteam_column_quarter_last');

function themeteam_column_one_sixth($atts,$content=null){
	$out .= '<section class="grid_2 entry">';
	$out .= do_shortcode($content);
	$out .= '</section>';
	
	return raw_formatter($out);
}
add_shortcode('column_one_sixth', 'themeteam_column_one_sixth');

function themeteam_column_one_sixth_last($atts,$content=null){
	$out .= '<section class="grid_2 entry">';
	$out .= do_shortcode($content);
	$out .= '</section><div class="clear"> </div>';
	
	return raw_formatter($out);
}
add_shortcode('column_one_sixth_last', 'themeteam_column_one_sixth_last');


function themeteam_column_three_quarter($atts,$content=null){
	$out .= '<section class="grid_9 entry">';
	$out .= do_shortcode($content);
	$out .= '</section>';
	
	return raw_formatter($out);
}
add_shortcode('column_three_quarter', 'themeteam_column_three_quarter');

function themeteam_column_three_quarter_last($atts,$content=null){
	$out .= '<section class="grid_9 entry">';
	$out .= do_shortcode($content);
	$out .= '</section><div class="clear"> </div>';
	
	return raw_formatter($out);
}
add_shortcode('column_three_quarter_last', 'themeteam_column_three_quarter_last');

function themeteam_column_two_thirds($atts,$content=null){
	$out .= '<section class="grid_8 entry">';
	$out .= do_shortcode($content);
	$out .= '</section>';
	
	return raw_formatter($out);
}
add_shortcode('column_two_thirds', 'themeteam_column_two_thirds');

function themeteam_column_two_thirds_last($atts,$content=null){
	$out .= '<section class="grid_8 entry">';
	$out .= do_shortcode($content);
	$out .= '</section><div class="clear"> </div>';
	
	return raw_formatter($out);
}
add_shortcode('column_two_thirds_last', 'themeteam_column_two_thirds_last');

function themeteam_column_full($atts,$content=null){
	$out .= '<section class="grid_12 entry">';
	$out .= do_shortcode($content);
	$out .= '</section><div class="clear"> </div>';
	
	return raw_formatter($out);
}

add_shortcode('column_full', 'themeteam_column_full');

function themeteam_divider($atts,$content=null){
	$out .= '<div class="clear"> </div>';
	
	return raw_formatter($out);
}
add_shortcode('divider', 'themeteam_divider');

/* buttons */
function themeteam_buttons($atts,$content=null){
	extract(shortcode_atts(array(
		'link' => 'http://www.envato.com',
		'color' => 'slateblue',
		'size' => 'small',
		'title' => 'Button'
	), $atts));

	$out .= '<a class="button '.$size.' '.$color.'" href="'.$link.'"><span><span>';
	$out .= $title;
	$out .= '</span></span></a>';
	
	return $out;
}
add_shortcode('button','themeteam_buttons');

/* Box Styles */
function themeteam_boxes($atts, $content = null){
	extract(shortcode_atts(array(
		'size' => 'quarter',
		'style' => 'box-v1',
		'color' => '',
		'title' => ''
	), $atts));
	
	switch($size){
		case 'quarter':
			$out .= '<div class="grid_3">';
		break;
		case 'full':
			$out .= '<div class="grid_12">';
		break;
	}
	$colorOption = $color;
	$colorOptionHeader = $color;
	if($style == 'box-v4' && $color == ''){ $colorOption = $GLOBALS['button_css'];}
	if($style == 'box-v2' && $color == ''){ $colorOptionHeader = $GLOBALS['button_css'];}
	
	$out .= '<article class="box '.$style.' '.$colorOption.'"><header class="'.$colorOptionHeader.'">';
	$out .= $title;
	$out .= '</header><details open class="clearfix entry">';
	$out .= do_shortcode($content);
	$out .= '</details></article></div>';
	
	return $out;
}
add_shortcode('boxes','themeteam_boxes');

/* Drop Caps */
function themeteam_drop_caps($atts, $content = null){
	extract(shortcode_atts(array(
		'style' => 'dropcap-v1',
		'color' => '',
		'title' => ''
	), $atts));
	
	$colorOption = $GLOBALS['button_css'];
	if($color){
		$colorOption = $color;
	}
	$out .= '<article class="entry"><h6>'.$title.'</h6><details open class="entry '.$style.' '.$colorOption.'">';
	$out .= do_shortcode($content);
	$out .= '</details></article>';
	
	return $out;
}
add_shortcode('drop_caps','themeteam_drop_caps');

/* Alert Boxes */
function themeteam_alert_boxes($atts, $content = null){
	extract(shortcode_atts(array(
		'style' => 'download',
		'title' => '',
		'link' => ''
	), $atts));
	
	$out .= '<a href="'.$link.'" class="link-button '.$style.'">'.$title.'</a>&nbsp;&nbsp;&nbsp;';
	
	return $out;
}
add_shortcode('alert_boxes','themeteam_alert_boxes');

/* Fancy Links */
function themeteam_fancy_links($atts, $content = null){
	extract(shortcode_atts(array(
		'style' => 'link-download',
		'color' => '',
		'title' => '',
		'link' => ''
	), $atts));
	
	$colorOption = $GLOBALS['button_css'];
	if($color){
		$colorOption = $color;
	}
	$out .= '<a href="'.$link.'" class="'.$style.' '.$colorOption.'">'.$title.'</a>';
	
	return $out;
}
add_shortcode('fancy_link','themeteam_fancy_links');

/* themeteam_pullquote_wrapper*/
function themeteam_pullquote_wrapper($atts, $content = null){
	extract(shortcode_atts(array(
		'size' => 'grid_8',
		'title' => ''
	), $atts));
	
	$out .= '<div class="'.$size.'">';
    $out .= '<h2 class="h2">'.$title.'</h2>';
    $out .= '<article class="entry">';
	$out .= do_shortcode($content);
	$out .= '</article></div>';
	
	return $out;
}
add_shortcode('pullquote_wrapper','themeteam_pullquote_wrapper');


/* pullquote */
function themeteam_pullquote($atts, $content = null){
	extract(shortcode_atts(array(
		'color' => '',
		'align' => 'left'
	), $atts));
	
	$colorOption = $GLOBALS['button_css'];
	if($color){
		$colorOption = $color;
	}
	
	$out .= '<blockquote class="'.$align.' '.$color.'">'.do_shortcode($content).'</blockquote>';
	
	return $out;
}
add_shortcode('pullquote','themeteam_pullquote');

/* quotes */
function themeteam_quote($atts, $content = null){
	extract(shortcode_atts(array(
		'color' => ''
	), $atts));
	
	$colorOption = $GLOBALS['button_css'];
	if($color){
		$colorOption = $color;
	}
	$out .= '<q class="'.$color.'">'.do_shortcode($content).'</q>';
	
	return $out;
}
add_shortcode('quote','themeteam_quote');


/* Message Slider */
function themeteam_message_slider($atts, $content = null){
	extract(shortcode_atts(array(
		'isSlider' => 'yes',
		'unique_id' => 'one',
		'autoplay' => 'false',
		'pause' => '3000'
	), $atts));
	
	$out .= '<div class="grid_12"><article class="box box-v6" id="'.$unique_id.'"><div><div><ul>'.do_shortcode($content).'</ul></div></div></article></div>';

	if($isSlider == 'yes'){
		themeteam_message_js($autoplay,$pause,$unique_id);
	}else{
		echo '<style>#rightBtn'.$unique_id.'{display:none;}#leftBtn'.$unique_id.'{display:none;}</style>';
	}
	
	return $out;
}
add_shortcode('message_slider','themeteam_message_slider');

function themeteam_message_js($autoplay,$pause,$id) {
		

		echo '
		<style type="text/css">
			.box-v6 #prevBtn'.$id.', .box-v6 #nextBtn'.$id.' { position: absolute; width: 17px; height:24px; font-size:0; overflow:hidden; background-image:url(/wp-content/themes/origami/images/arrows.png); background-repeat: no-repeat; cursor:pointer; top:50%; margin-top:-12px;}
			.box-v6 #prevBtn'.$id.' { background-position: left top; left:20px;}
			.box-v6 #nextBtn'.$id.' { background-position: right top; right:20px;}
		</style>
		<script type="text/javascript">
		/* <![CDATA[ */
		jQuery(document).ready(function(){
			$messageContainer_'.$id.' = jQuery("#'.$id.' > div > div");
		
		if ($messageContainer_'.$id.'.length)
		{
			$messageContainer_'.$id.'.easySlider
			({
				prevId:			"prevBtn'.$id.'",
				nextId:			"nextBtn'.$id.'",	
				auto:			'.$autoplay.',
				pause:			'.$pause.',
				continuous:		true,
				numericPrev:	true,
				numericNext:	true
			});
		}
		});
		/* ]]> */
		</script>';
}

/**
 * Tooltip Shortcode 
 */
function themeteam_tooltip( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'trigger' => '',
		'style' => 'v1',
    ), $atts));

	$out .= '<a class="'.$style.'" href="#" onclick="return false;">' .$trigger. '</a>';
	$out .= '<div class="tooltip '.$style.'"><div><p>'.$content.'</p><span class="triangle"></span></div></div>';

	return $out;
}
add_shortcode('tooltip', 'themeteam_tooltip');

/************************************************************************************************


/* Videos/Images */
function themeteam_images_video($atts,$content=null){
	extract(shortcode_atts(array(
		'style' => 'rc_inner_shadow',
		'type' => 'image',
		'title' => '',
		'image_url' => '',
		'video_url' => ''
	), $atts));
	
	$out .= '<div class="grid_4"><div class="portfolio"><div class="imgframe">';
	switch($type){
		case 'image':
			$out .= '<a href="'.$image_url.'" rel="prettyPhoto">'.themeteam_resize($image_url,$title,$title,'300','165').'<span class="frame"><span><span><span><span><span class="empty"><em class="zoom"> </em></span></span></span></span></span></span></a>';
		break;
		case 'video':
			$out .= '<a href="'.$video_url.'" rel="prettyPhoto">'.themeteam_resize($image_url,$title,$title,'300','165').'<span class="frame"><span><span><span><span><span class="empty"><em class="play"> </em></span></span></span></span></span></span></a>';
		break;
	}
	
	$out .= '</div></div><div class="grid_4 clearCode"> </div><article class="entry">';
	$out .= do_shortcode($content);
	$out .= '</article></div>';
	return raw_formatter($out);
}
add_shortcode('image_video','themeteam_images_video');

/* SIngle Images */
function themeteam_single_image($atts,$content=null){
	extract(shortcode_atts(array(
		'width' => '300',
		'height' => '165',
		'image_url' => ''
	), $atts));

	$out .= '<div class="grid_4"><div class="portfolio"><div class="imgframe">';
	$out .= '<a href="'.$image_url.'" rel="prettyPhoto">'.themeteam_resize($image_url,$title,$title,$width,$height).'<span class="frame"><span><span><span><span><span class="empty"><em class="zoom"> </em></span></span></span></span></span></span></a>';
	$out .= '</div></div></div>';
	
	return raw_formatter($out);
}
add_shortcode('single_image','themeteam_single_image');

/* Galleria */
function themeteam_galleria( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'size' => 'grid_12',
    	'transition' => 'fade',
		'height' => '300',
		'width' => '600',
		'autoplay' => 'true',
		'type' => 'classic',

    ), $atts));

	themeteam_galleria_js($transition,$height,$autoplay,$type);
	
	
	if(preg_match_all('!http://.+\.(?:jpe?g|png|gif)!Ui',$content,$matches)){

		$out .=  '<div class="'.$size.'"><div id="galleria" style="width:' .$width. 'px;height:' .$height. 'px;">';

		foreach ($matches[0] as $img) {
			$main_img = gallery_image_resize($height,$width,$img);
			$out .= '<a href="'.$main_img.'"><img alt="" src="'.gallery_image_resize('40','60',$img).'"/></a>';
		}
		$out .=  '</div></div>';

	}

	return $out;
}
add_shortcode('galleria', 'themeteam_galleria');

function themeteam_galleria_js($transition,$height,$autoplay,$type) {

		
		if($type == 'classic'){
			$switch_type_css = THEMETEAM_JS.'galleria/themes/classic/galleria.classic.js';
		}else if($type == 'dots') {
			$switch_type_css = THEMETEAM_JS.'galleria/themes/dots/galleria.dots.js';
		}
		echo '<script type="text/javascript">
		/* <![CDATA[ */
		jQuery(document).ready(function(){
			Galleria.loadTheme("'.$switch_type_css.'");
			jQuery("#galleria").galleria({
				height: ' .$height. ',
				autoplay: ' .$autoplay. ',
			    transition: "' .$transition. '",
				image_crop: true
			});
		});
		/* ]]> */
		</script>';
}
/* bullets and lists */
function themeteam_bullet_list($atts,$content=null){
	extract(shortcode_atts(array(
		'style' => 'bullet_add',
		'grid_length' => 'grid_2'
	), $atts));
	
	$out .= '<div class="'.$grid_length.'">';
	$out .= '<ul class="ul '.$style.'">';
	$out .= do_shortcode($content);
	$out .= '</ul></div>';
	
	return raw_formatter($out);
}
add_shortcode('bullet_list','themeteam_bullet_list');
/* Header */
function themeteam_headers($atts,$content=null){
	extract(shortcode_atts(array(
		'color' => '',
		'type' => 'h1'
	), $atts));
	
	$out .= '<'.$type.' class="'.$color.'">';
	$out .= do_shortcode($content);
	$out .= '</'.$type.'>';
	
	return raw_formatter($out);
}
add_shortcode('headers','themeteam_headers');

/* Mark */
function themeteam_mark($atts,$content=null){
	extract(shortcode_atts(array(
		'color' => '',
		'type' => 'h1'
	), $atts));
	
	$out .= '<mark class="'.$color.'">';
	$out .= do_shortcode($content);
	$out .= '</mark>';
	
	return $out;
}
add_shortcode('mark','themeteam_mark');
?>