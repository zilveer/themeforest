<?php

/*-----------------------------------------------------------------------------------

	Theme Shortcodes 

-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*	Buttons Shortcodes
/*-----------------------------------------------------------------------------------*/

function ag_button( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'link'	=> '#',
    'target'	=> '',
    'color'	=> '',
    'size'	=> '',
    'background'	=> '',
    ), $atts));

	$color = ($color != '') ? ' custom '.$color.'' : '';
	$size = ($size) ? ' '.$size : '';
	$target = ($target == 'blank') ? ' target="_blank"' : '';
	$background = ($background != '') ? ' style="background:'.$background.';" ' : '';
	$backgroundclass = ($background != '') ? ' custom ' : '';

	$out = '<a' .$target. ' class="button'.$color.$size.$backgroundclass.'" href="' .$link. '" '.$background.'>' .do_shortcode($content). '</a>';

    return $out;
}
add_shortcode('button', 'ag_button');

/*-----------------------------------------------------------------------------------*/
/*	Lightbox Shortcodes
/*-----------------------------------------------------------------------------------*/

function ag_lightbox( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'link'	=> '#',
    ), $atts));

	$out = '<a rel="prettyPhoto" href="' .$link. '" class="lightboxhover">' .do_shortcode($content). '</a>';

    return $out;
}
add_shortcode('lightbox', 'ag_lightbox');


/*-----------------------------------------------------------------------------------*/
/*	Divider Shortcodes
/*-----------------------------------------------------------------------------------*/

function ag_divider( $atts, $content = null ) {
    extract(shortcode_atts(array(
    ), $atts));

	$out = '<div class="divider"><h5><span>'.do_shortcode($content).'</span></h5></div>';

    return $out;
}
add_shortcode('divider', 'ag_divider');

/*-----------------------------------------------------------------------------------*/
/*	Featured Slider Full Shortcodes
/*-----------------------------------------------------------------------------------*/

function ag_featuredfulltabs( $atts, $content = null ) {
	extract(shortcode_atts(array(
    'icon'	=> '',
    'desc'	=> '',
    ), $atts));
	
	$icon = ($icon) ? ' '.$icon : '';
	$desc = ($desc) ? ' '.$desc : '';
	
	global $tab_counter_1;
	global $tab_counter_2;
	
	$tab_counter_1++;
	$tab_counter_2++;
	
	$out = NULL;
	
	$out .= '<div class="clear"></div><ul class="tabs">';
	
	$count = 1;
	
	foreach ($atts as $tab) {
		if($count == 1){$first = 'active';}else{$first = '';}
		$out .= '<li><a class="'.$first.'" href="#'.$tab_counter_1.'">'.$tab.'</a></li>';
	
		$tab_counter_1++;
		$count++;
	}
	$out .= '</ul>';
	
	$out .= '<ul class="tabs-content">'.do_shortcode($content) .'</ul><div class="clear"></div>';
	
	return $out;
	
}
add_shortcode('tabs', 'ag_featuredfulltabs');


/*-----------------------------------------------------------------------------------*/
/*	Full Tab Panes Shortcodes
/*-----------------------------------------------------------------------------------*/

function tabfullpanes( $atts, $content = null ) {
	extract(shortcode_atts(array(
    ), $atts));
	
	$out = NULL;
	
	global $tab_counter_2;
	
	if($tab_counter_2 == 1){$first_2 = 'active';}else{$first_2 = '';}
	$out .= '<li id="'.$tab_counter_2.'" class="'.$first_2.'">'. do_shortcode($content) .'</li>';
	
	$tab_counter_2++;
	
	return $out;
}
add_shortcode('tab', 'tabfullpanes');

/*-----------------------------------------------------------------------------------*/
/*	Column Shortcodes
/*-----------------------------------------------------------------------------------*/

function ag_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'ag_one_third');

function ag_one_third_last( $atts, $content = null ) {
   return '<div class="one_third column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'ag_one_third_last');

function ag_two_third( $atts, $content = null ) {
   return '<div class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'ag_two_third');

function ag_two_third_last( $atts, $content = null ) {
   return '<div class="two_third column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_third_last', 'ag_two_third_last');

function ag_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'ag_one_half');

function ag_one_half_last( $atts, $content = null ) {
   return '<div class="one_half column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'ag_one_half_last');

function ag_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'ag_one_fourth');

function ag_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 'ag_one_fourth_last');

function ag_three_fourth( $atts, $content = null ) {
   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'ag_three_fourth');

function ag_three_fourth_last( $atts, $content = null ) {
   return '<div class="three_fourth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fourth_last', 'ag_three_fourth_last');

function ag_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'ag_one_fifth');

function ag_one_fifth_last( $atts, $content = null ) {
   return '<div class="one_fifth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fifth_last', 'ag_one_fifth_last');

function ag_two_fifth( $atts, $content = null ) {
   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'ag_two_fifth');

function ag_two_fifth_last( $atts, $content = null ) {
   return '<div class="two_fifth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_fifth_last', 'ag_two_fifth_last');

function ag_three_fifth( $atts, $content = null ) {
   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'ag_three_fifth');

function ag_three_fifth_last( $atts, $content = null ) {
   return '<div class="three_fifth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fifth_last', 'ag_three_fifth_last');

function ag_four_fifth( $atts, $content = null ) {
   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'ag_four_fifth');

function ag_four_fifth_last( $atts, $content = null ) {
   return '<div class="four_fifth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('four_fifth_last', 'ag_four_fifth_last');

function ag_one_sixth( $atts, $content = null ) {
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'ag_one_sixth');

function ag_one_sixth_last( $atts, $content = null ) {
   return '<div class="one_sixth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_sixth_last', 'ag_one_sixth_last');

function ag_five_sixth( $atts, $content = null ) {
   return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'ag_five_sixth');

function ag_five_sixth_last( $atts, $content = null ) {
   return '<div class="five_sixth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('five_sixth_last', 'ag_five_sixth_last');


/*-----------------------------------------------------------------------------------*/
/*	Tooltip Shortcode
/*-----------------------------------------------------------------------------------*/

function ag_tooltip( $atts, $content = null ) {
    extract(shortcode_atts(array(
    'text'	=> '',
    ), $atts));

	$text = ($text) ? ' '.$text : '';

	$out = '<a href="#" style="position:relative">' .do_shortcode($content). '<span class="tooltip black right">'.$text.'</span></a>';	

    return $out;
}
add_shortcode('tooltip', 'ag_tooltip');
?>