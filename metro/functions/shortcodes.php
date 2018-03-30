<?php

/*************************************************************************************
 *	Shortcodes
 *************************************************************************************/


/*************************************************************************************
 *	Columns
 *************************************************************************************/

function om_sc_columns_workup_content($content) {

	if(substr($content,0,4) == '</p>')
		$content=substr($content,4);

	if(substr($content,0,6) == '<br />')
		$content=substr($content,6);
			
	return $content;
}

/****************/
 
function om_sc_one_half( $atts, $content = null ) {
	return '<div class="one-half">' . do_shortcode( om_sc_columns_workup_content($content) ) . '</div>';
}
add_shortcode('one_half', 'om_sc_one_half');
add_shortcode('two_fourth', 'om_sc_one_half');
add_shortcode('two_fourths', 'om_sc_one_half');
add_shortcode('three_sixth', 'om_sc_one_half');
add_shortcode('three_sixths', 'om_sc_one_half');

function om_sc_one_half_last( $atts, $content = null ) {
	return '<div class="one-half last">' . do_shortcode( om_sc_columns_workup_content($content) ) . '</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'om_sc_one_half_last');
add_shortcode('two_fourth_last', 'om_sc_one_half_last');
add_shortcode('two_fourths_last', 'om_sc_one_half_last');
add_shortcode('three_sixth_last', 'om_sc_one_half_last');
add_shortcode('three_sixths_last', 'om_sc_one_half_last');

/****************/

function om_sc_one_third( $atts, $content = null ) {
	return '<div class="one-third">' . do_shortcode( om_sc_columns_workup_content($content) ) . '</div>';
}
add_shortcode('one_third', 'om_sc_one_third');
add_shortcode('two_sixth', 'om_sc_one_third');
add_shortcode('two_sixths', 'om_sc_one_third');

function om_sc_one_third_last( $atts, $content = null ) {
	return '<div class="one-third last">' . do_shortcode( om_sc_columns_workup_content($content) ) . '</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'om_sc_one_third_last');
add_shortcode('two_sixth_last', 'om_sc_one_third_last');
add_shortcode('two_sixths_last', 'om_sc_one_third_last');

function om_sc_two_third( $atts, $content = null ) {
	return '<div class="two-third">' . do_shortcode( om_sc_columns_workup_content($content) ) . '</div>';
}
add_shortcode('two_third', 'om_sc_two_third');
add_shortcode('two_thirds', 'om_sc_two_third');
add_shortcode('four_sixth', 'om_sc_two_third');
add_shortcode('four_sixths', 'om_sc_two_third');

function om_sc_two_third_last( $atts, $content = null ) {
	return '<div class="two-third last">' . do_shortcode( om_sc_columns_workup_content($content) ) . '</div><div class="clear"></div>';
}
add_shortcode('two_third_last', 'om_sc_two_third_last');
add_shortcode('two_thirds_last', 'om_sc_two_third_last');
add_shortcode('four_sixth_last', 'om_sc_two_third_last');
add_shortcode('four_sixths_last', 'om_sc_two_third_last');

/****************/

function om_sc_one_fourth( $atts, $content = null ) {
	return '<div class="one-fourth">' . do_shortcode( om_sc_columns_workup_content($content) ) . '</div>';
}
add_shortcode('one_fourth', 'om_sc_one_fourth');

function om_sc_one_fourth_last( $atts, $content = null ) {
	return '<div class="one-fourth last">' . do_shortcode( om_sc_columns_workup_content($content) ) . '</div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 'om_sc_one_fourth_last');

function om_sc_three_fourth( $atts, $content = null ) {
	return '<div class="three-fourth">' . do_shortcode( om_sc_columns_workup_content($content) ) . '</div>';
}
add_shortcode('three_fourth', 'om_sc_three_fourth');
add_shortcode('three_fourths', 'om_sc_three_fourth');

function om_sc_three_fourth_last( $atts, $content = null ) {
	return '<div class="three-fourth last">' . do_shortcode( om_sc_columns_workup_content($content) ) . '</div><div class="clear"></div>';
}
add_shortcode('three_fourth_last', 'om_sc_three_fourth_last');
add_shortcode('three_fourths_last', 'om_sc_three_fourth_last');

/****************/

function om_sc_one_fifth( $atts, $content = null ) {
	return '<div class="one-fifth">' . do_shortcode( om_sc_columns_workup_content($content) ) . '</div>';
}
add_shortcode('one_fifth', 'om_sc_one_fifth');

function om_sc_one_fifth_last( $atts, $content = null ) {
	return '<div class="one-fifth last">' . do_shortcode( om_sc_columns_workup_content($content) ) . '</div><div class="clear"></div>';
}
add_shortcode('one_fifth_last', 'om_sc_one_fifth_last');

function om_sc_two_fifth( $atts, $content = null ) {
	return '<div class="two-fifth">' . do_shortcode( om_sc_columns_workup_content($content) ) . '</div>';
}
add_shortcode('two_fifth', 'om_sc_two_fifth');
add_shortcode('two_fifths', 'om_sc_two_fifth');

function om_sc_two_fifth_last( $atts, $content = null ) {
	return '<div class="two-fifth last">' . do_shortcode( om_sc_columns_workup_content($content) ) . '</div><div class="clear"></div>';
}
add_shortcode('two_fifth_last', 'om_sc_two_fifth_last');
add_shortcode('two_fifths_last', 'om_sc_two_fifth_last');

function om_sc_three_fifth( $atts, $content = null ) {
	return '<div class="three-fifth">' . do_shortcode( om_sc_columns_workup_content($content) ) . '</div>';
}
add_shortcode('three_fifth', 'om_sc_three_fifth');
add_shortcode('three_fifths', 'om_sc_three_fifth');

function om_sc_three_fifth_last( $atts, $content = null ) {
	return '<div class="three-fifth last">' . do_shortcode( om_sc_columns_workup_content($content) ) . '</div><div class="clear"></div>';
}
add_shortcode('three_fifth_last', 'om_sc_three_fifth_last');
add_shortcode('three_fifths_last', 'om_sc_three_fifth_last');

function om_sc_four_fifth( $atts, $content = null ) {
	return '<div class="four-fifth">' . do_shortcode( om_sc_columns_workup_content($content) ) . '</div>';
}
add_shortcode('four_fifth', 'om_sc_four_fifth');
add_shortcode('four_fifths', 'om_sc_four_fifth');

function om_sc_four_fifth_last( $atts, $content = null ) {
	return '<div class="four-fifth last">' . do_shortcode( om_sc_columns_workup_content($content) ) . '</div><div class="clear"></div>';
}
add_shortcode('four_fifth_last', 'om_sc_four_fifth_last');
add_shortcode('four_fifths_last', 'om_sc_four_fifth_last');

/****************/

function om_sc_one_sixth( $atts, $content = null ) {
	return '<div class="one-sixth">' . do_shortcode( om_sc_columns_workup_content($content) ) . '</div>';
}
add_shortcode('one_sixth', 'om_sc_one_sixth');

function om_sc_one_sixth_last( $atts, $content = null ) {
	return '<div class="one-sixth last">' . do_shortcode( om_sc_columns_workup_content($content) ) . '</div><div class="clear"></div>';
}
add_shortcode('one_sixth_last', 'om_sc_one_sixth_last');

function om_sc_five_sixth( $atts, $content = null ) {
	return '<div class="five-sixth">' . do_shortcode( om_sc_columns_workup_content($content) ) . '</div>';
}
add_shortcode('five_sixth', 'om_sc_five_sixth');
add_shortcode('five_sixths', 'om_sc_five_sixth');

function om_sc_five_sixth_last( $atts, $content = null ) {
	return '<div class="five-sixth last">' . do_shortcode( om_sc_columns_workup_content($content) ) . '</div><div class="clear"></div>';
}
add_shortcode('five_sixth_last', 'om_sc_five_sixth_last');
add_shortcode('five_sixths_last', 'om_sc_five_sixth_last');

/*************************************************************************************
 *	Buttons
 *************************************************************************************/

$om_sc_button_count=0;

function om_sc_button( $atts, $content = null ) {
	global $om_sc_button_count;
	
	$om_sc_button_count++;
	
	extract(shortcode_atts(array(
		'url'     	 => '',
		'href'     	 => '',
		'target'     => '',
		'color'   => '',
		'hovercolor'   => '',
		'textcolor'   => '#ffffff',
		'size' => 'medium',
		'title' => '',
		'tooltip' => ''
	), $atts));
	
	if(!$href && $url)
		$href=$url;
	
	if(!$href)
		$href='#';
	
	if($target)
		$target=' target="'.$target.'"';
		
	$style=array();
	$style_hover=array();
	
	if($color)
		$style[]='background-color:'.$color.' !important';
		
	$textshadowclass='';
	if($textcolor)
	{
		$tmp=str_replace('#','',$textcolor);
		if(max(base_convert(substr($tmp,0,2),16,10),base_convert(substr($tmp,2,2),16,10),base_convert(substr($tmp,3,2),16,10)) > 127)
			$textshadowclass=' text-bright';
		else
			$textshadowclass=' text-dark';
		$style[]='color:'.$textcolor.' !important';
	}
	
	if($hovercolor)
		$style_hover[]='background-color:'.$hovercolor.' !important';
	
	$out='<a class="button'.((!$hovercolor)?' single-color':'').$textshadowclass.($tooltip?' add-tooltip':'').' size-'.$size.'" href="'.$href.'"'.$target.''.($tooltip?' title="'.htmlspecialchars($tooltip).'"':'').' id="sc_button_'.$om_sc_button_count.'">';
				
	if($size == 'xlarge')
		$out.= '<span class="button-title">'.$title.'</span><span class="button-text">' . $content . '</span>';
	else
		$out.= $content;
	
	$out .= '</a>';
	
	if(!empty($style) || !empty($style_hover))
	{
		$out.='<style>';
		if(!empty($style))
			$out.='#sc_button_'.$om_sc_button_count.'{'.implode(';',$style).'}';
		if(!empty($style_hover))
			$out.='#sc_button_'.$om_sc_button_count.':hover{'.implode(';',$style_hover).'}';
		$out.='</style>';
	}
	return $out;
}
add_shortcode('button', 'om_sc_button');

/*************************************************************************************
 *	Aligned Content
 *************************************************************************************/

function om_sc_full_width_content( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'title'    	 => ''
	), $atts));
	
	if($title)
		$title='<div class="content-title fs-s">'.$title.'</div>';

	return
		'<div class="content-block eat-left eat-right">'.
			do_shortcode($content).
			$title.
		'</div>'
	;
	
}
add_shortcode('full_width_content', 'om_sc_full_width_content');

function om_sc_content_center( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'title'    	 => ''
	), $atts));
	
	if($title)
		$title='<div class="content-title fs-s">'.$title.'</div>';

	return
		'<div class="content-block center">'.
			do_shortcode($content).
			$title.
		'</div>'
	;
	
}
add_shortcode('content_center', 'om_sc_content_center');

function om_sc_content_left( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'title'    	 => ''
	), $atts));
	
	if($title)
		$title='<div class="content-title fs-s">'.$title.'</div>';

	return
		'<div class="content-block left">'.
			do_shortcode($content).
			$title.
		'</div>'
	;
	
}
add_shortcode('content_left', 'om_sc_content_left');

function om_sc_content_right( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'title'    	 => ''
	), $atts));
	
	if($title)
		$title='<div class="content-title fs-s">'.$title.'</div>';

	return
		'<div class="content-block right">'.
			do_shortcode($content).
			$title.
		'</div>'
	;
	
}
add_shortcode('content_right', 'om_sc_content_right');

/*************************************************************************************
 *	Toggle
 *************************************************************************************/

function om_sc_toggle( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'title'    	 => 'Toggle title goes here',
		'state'		 => ''
	), $atts));

	if($state == 'opened' || $state == 'expanded'  || $state == 'expand')
		$state='open';

	return
		'<div class="toggle">'.
			'<div class="toggle-title'.($state=='open'?' expanded':'').'">'.$title.'</div>'.
			'<div class="toggle-inner"'.($state=='open'?' style="display:block"':'').'>'.
				do_shortcode($content).
			'</div>'.
		'</div>'
	;
	
}
add_shortcode('toggle', 'om_sc_toggle');

/*************************************************************************************
 *	Accordion
 *************************************************************************************/

function om_sc_accordion( $atts, $content = null ) {
	

	return
		'<div class="accordion">'.
			do_shortcode($content).
		'</div>'
	;
	
}
add_shortcode('accordion', 'om_sc_accordion');

/*************************************************************************************
 *	Tabs
 *************************************************************************************/

function om_sc_tab( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'title' => 'Tab'
	), $atts ));
										
	return '<div class="tabs-tab tab-'. preg_replace('/[^A-Za-z0-9-]/' ,'', sanitize_title( $title ) ) .'">'. do_shortcode( $content ) .'</div>';
}
add_shortcode( 'tab', 'om_sc_tab' );

function om_sc_tabs( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'vertical' => ''
	), $atts ));
	$vertical=false; // disable vertical layout
		
	$titles='';
	if( preg_match_all( '/\[tab[^\]]*title="([^\"]+)"[^\]]*\]/i', $content, $m ) ) {
		
		foreach($m[1] as $v) {
			$titles.='<li><a href="#tab-'. preg_replace('/[^A-Za-z0-9-]/' ,'', sanitize_title ( $v ) ) .'"><span>'.$v.'</span></a></li>';
		}
	}
			
	return 
		'<div class="tabs'.($vertical?' vertical':'').'">'.
			'<ul class="tabs-control">'.
				$titles.
			'</ul>'.
			'<div class="tabs-tabs">'.
				do_shortcode( $content ).
			'</div>'.
			'<div class="clear"></div>'.
		'</div>'
	;
}
add_shortcode( 'tabs', 'om_sc_tabs' );

/*************************************************************************************
 *	Dropcaps
 *************************************************************************************/

function om_sc_dropcap( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'size'     	 => '220%',
		'textcolor'     	 => '',
		'bgcolor'     => ''
	), $atts));
	
	$style=array();
	if($textcolor)
		$style[]='color:'.$textcolor;
	if($bgcolor && $bgcolor != 'theme')
		$style[]='background-color:'.$bgcolor;
	if(strpos($size,'%') !== false) {
		$size=intval($size);
		if($size)
			$size.='%';
	} else {
		$size=intval($size);
		if($size)
			$size.='px';
	}
	if($size)
		$style[]='font-size:'.$size;
		
	return
		'<span class="dropcap'.($bgcolor=='theme'?' bgcolor-theme':'').($bgcolor?' with-bg-color':'').'"'.(!empty($style)?' style="'.implode(';',$style).'"':'').'>'.$content.'</span>'	
		;

}
add_shortcode('dropcap', 'om_sc_dropcap');

/*************************************************************************************
 *	Icon
 *************************************************************************************/

function om_sc_icon( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'url'     	 => '',
		'target'     => '',
		'icon' => '',
		'tooltip' => ''
	), $atts));
	
	
	if($target)
		$target=' target="'.$target.'"';
		
	if($icon)
	{
		if(strpos($icon, '/') === false)
			$icon=TEMPLATE_DIR_URI.'/img/icons/'.$icon;
	}
	
	if($url)
		$out='<a href="'.$url.'"'.$target.' class="with-icon-inside'.($tooltip?' add-tooltip':'').'"'.($tooltip?' title="'.htmlspecialchars($tooltip).'"':'').'><span class="icon" style="background-image:url('.$icon.')"></span>'.$content.'</a>';	
	else
		$out='<span class="with-icon'.($tooltip?' add-tooltip':'').'" style="background-image:url('.$icon.')"'.($tooltip?' title="'.htmlspecialchars($tooltip).'"':'').'>'.do_shortcode($content).'</span>';	
	
	return $out;

}
add_shortcode('icon', 'om_sc_icon');

/*************************************************************************************
 *	Bullets
 *************************************************************************************/

$om_sc_bullets_count=0;
function om_sc_bullets( $atts, $content = null ) {
	global $om_sc_bullets_count;
	
	$om_sc_bullets_count++;
	
	extract(shortcode_atts(array(
		'icon' => '',
	), $atts));
	
	if($icon)
	{
		if(strpos($icon, '/') === false)
			$icon=TEMPLATE_DIR_URI.'/img/icons/'.$icon;
	}
	
	$out= '<div class="bullets" id="sc_bullets_'.$om_sc_bullets_count.'">'.do_shortcode($content).'</div>';
	if($icon)
		$out.='<style>#sc_bullets_'.$om_sc_bullets_count.' ul li{background-image:url('.$icon.')}</style>';
	
	return $out;
}
add_shortcode('bullets', 'om_sc_bullets');

/*************************************************************************************
 *	Individual Bullets
 *************************************************************************************/

function om_sc_ul( $atts, $content = null ) {

	$content=preg_replace('#/li\][^\[]+?\[li#i','/li][li',$content);
	$content=preg_replace('#^[^\[]+?\[#','[',$content);
	$content=preg_replace('#\][^\]]+?$#',']',$content);
	return '<div class="bullets"><ul>'.do_shortcode($content).'</ul></div>';
}
add_shortcode('ul', 'om_sc_ul');

function om_sc_li( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'icon' => '',
	), $atts));
	
	if($icon)
	{
		if(strpos($icon, '/') === false)
			$icon=TEMPLATE_DIR_URI.'/img/icons/'.$icon;
	}
	
	return '<li'.($icon?' style="background-image:url('.$icon.')"':'').'>'.do_shortcode($content).'</li>';
}
add_shortcode('li', 'om_sc_li');

/*************************************************************************************
 *	Marker
 *************************************************************************************/

function om_sc_marker( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'textcolor'     	 => '',
		'bgcolor'     => '',
		'tooltip' => ''
	), $atts));
	
	$style=array();
	if($textcolor)
		$style[]='color:'.$textcolor;
	if($bgcolor)
		$style[]='background-color:'.$bgcolor;
		
	return
		'<span class="marker'.($tooltip?' add-tooltip':'').'"'.(!empty($style)?' style="'.implode(';',$style).'"':'').($tooltip?' title="'.htmlspecialchars($tooltip).'"':'').'>'.$content.'</span>'	
		;

}
add_shortcode('marker', 'om_sc_marker');

/*************************************************************************************
 *	Infopane
 *************************************************************************************/

function om_sc_infopane( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'color'     	 => '1',
		'icon'     	 => '',
	), $atts));
	
	$color=intval($color);
	if($color < 1)
		$color=1;
	
	if($icon)
	{
		if(strpos($icon, '/') === false)
			$icon=TEMPLATE_DIR_URI.'/img/icons/'.$icon;
		return '<div class="infopane color-'.$color.'"><div class="inner" style="background-image:url('.$icon.')">' . do_shortcode($content) . '</div></div>';
	}
	else
		return '<div class="infopane color-'.$color.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('infopane', 'om_sc_infopane');

/*************************************************************************************
 *	Biginfopane
 *************************************************************************************/

function om_sc_biginfopane( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'url'     	 => '',
		'href'     	 => '',
		'target'     => '',
		'color'   => '',
		'textcolor'   => '#ffffff',
		'title' => '',
		'button_title' => '',
		'full_width' => false
	), $atts));
	
	if(!$href && $url)
		$href=$url;
	
	if(!$href)
		$href='#';
	
	$style=array();
	
	$textshadowclass='';
	if($textcolor)
	{
		$tmp=str_replace('#','',$textcolor);
		if(max(base_convert(substr($tmp,0,2),16,10),base_convert(substr($tmp,2,2),16,10),base_convert(substr($tmp,3,2),16,10)) > 127)
			$textshadowclass=' text-bright';
		else
			$textshadowclass=' text-dark';
		$style[]='color:'.$textcolor.' !important';
	}
	if($color)
		$style[]='background-color:'.$color;
			
	if($target)
		$target=' target="'.$target.'"';

	return
		'<div class="biginfopane'.($full_width?' eat-left eat-right':'').'"'.(!empty($style)?' style="'.implode(';',$style).'"':'').'>'.
			'<div class="inner">'.
				'<div class="text-block'.$textshadowclass.'">'.($title?'<div class="text-block-title">'.$title.'</div>':'').$content.'</div>'.
				($button_title?'<div class="button-block"><a href="'.$href.'"'.$target.'>'.$button_title.'</a></div>':'').
			'</div>'.
		'</div>'	
		;

}
add_shortcode('biginfopane', 'om_sc_biginfopane');

/*************************************************************************************
 *	Table
 *************************************************************************************/
 
function om_sc_custom_table( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'style' => '1',
	), $atts));
	
	if(!$style)
		$style=1;
		
	return
		'<div class="custom-table-wrapper style-'.$style.'">'.
			do_shortcode($content).
		'</div>'
	;
	
}
add_shortcode('custom_table', 'om_sc_custom_table');



/*************************************************************************************
 *	Clear
 *************************************************************************************/

function om_sc_clear( $atts, $content = null ) {
	return '<div class="clear"></div>';
}
add_shortcode('clear', 'om_sc_clear');

/*************************************************************************************
 *	Space
 *************************************************************************************/

function om_sc_space( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'size' => '',
	), $atts));
	
	$size=intval($size);
	if($size < 0)
		return '<div style="margin-top:'.$size.'px"></div>';
	elseif($size)
		return '<div class="clear" style="height:'.$size.'px"></div>';
	else
		return '<div class="clear" style="height:16px"></div>';
}
add_shortcode('space', 'om_sc_space');

/*************************************************************************************
 *	Custom Gallery
 *************************************************************************************/

function om_sc_custom_gallery( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'id' => '0',
		'layout' => '',
	), $atts));

	if(!$id)
		return '';
	
	$out='';
	
	if($layout == 'masonry') {
		
		$out = om_get_slides_gallery_m($id);
		if($out)
			$out='<div class="eat-left eat-right">'.$out.'</div>';
		
	} else {
	
		if( is_page_template('template-full-width.php') )
			$out = om_get_slides_gallery($id, 'full');
		else
			$out = om_get_slides_gallery($id);

		if($out)
			$out='<div class="eat-left eat-right">'.$out.'</div>';

	}
	
	return $out;
}
add_shortcode('custom_gallery', 'om_sc_custom_gallery');


/*************************************************************************************
 *	Table
 *************************************************************************************/

function om_sc_table( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'style' => '1',
	), $atts));
	
	if(!$style)
		$style=1;
	
	$out='';
	
	if(preg_match_all('#[\s\S]*?\[tr\]([\s\S]*?)\[/tr\][\s\S]*?#',$content,$rows)) {
		
		$out.='<table class="custom-table style-'.$style.'">';
		
		foreach($rows[1] as $row) {
			
			$out.='<tr>';
			
			if(preg_match_all('#[\s\S]*?\[(td|th)\]([\s\S]*?)\[/(td|th)\][\s\S]*?#',$row,$cols)) {
				foreach($cols[2] as $k=>$col) {
					$out.='<'.$cols[1][$k].'>'.do_shortcode($col).'</'.$cols[1][$k].'>';
				}
			}
			
			$out.='</tr>';
			
		}
		
		$out.='</table>';
	}
	
	return $out;
}
add_shortcode('table', 'om_sc_table');

/*************************************************************************************
 *	Video Embed
 *************************************************************************************/

function om_sc_video_embed( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'maxwidth' => '0',
	), $atts));
	
	$maxwidth=intval($maxwidth);
	
	if(preg_match_all('#<iframe[^>]*src="(http://www\.youtube\.com[^"]+)"[^>]*>[\s\S]*?</iframe>#i',$content,$m)) {
		foreach($m[1] as $v) {
			if(strpos($v,'wmode=opaque') === false) {
				if(strpos($v,'?') === false)
					$content=str_replace($v,$v.'?wmode=opaque',$content);
				else
					$content=str_replace($v,$v.'&wmode=opaque',$content);
			}
		}
	}

	if($maxwidth)
		$out='<div style="max-width:'.$maxwidth.'px;margin:0 auto"><div class="video-embed">'.$content.'</div></div>';
	else
		$out='<div class="video-embed eat-left eat-right">'.$content.'</div>';
		
	return $out;
}
add_shortcode('video_embed', 'om_sc_video_embed');

/*************************************************************************************
 *	Pullquote
 *************************************************************************************/

function om_sc_pullquote( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'style' => '',
	), $atts));
	
	if($style)
		$out='<div class="pullquote '.$style.'">'.$content.'</div>';
	else
		$out='<blockquote>'.$content.'</blockquote>';
		
	return $out;
}
add_shortcode('pullquote', 'om_sc_pullquote');

/*************************************************************************************
 *	Contact Form
 *************************************************************************************/

function om_sc_contact_form( $atts, $content = null ) {

	$fields_option = 'form_fields';
	global $sitepress;
	if(defined('ICL_PLUGIN_INACTIVE') && isset($sitepress) && $sitepress->get_default_language()) {
		$curr=$sitepress->get_current_language();
		if($curr != $sitepress->get_default_language())
			$fields_option.='_'.$curr;
	}
	
	$email = get_option(OM_THEME_PREFIX.'form_email');
	$button_title = get_option(OM_THEME_PREFIX.'form_button_title');
	$fields = get_option(OM_THEME_PREFIX.$fields_option);
	$form_success = get_option(OM_THEME_PREFIX.'form_success');
		
	if(!$email)
		return '';

	if(empty($fields))
		return '';
		
	if(!is_array($fields))
		return '';
	
	$f='';

	foreach($fields as $v)
	{
		$v['name']=trim($v['name']);
		if($v['name'] == '')
			continue;

		switch($v['type']) {
			
			case 'text':
				$f.='<div class="line"><input type="text" name="fields['.base64_encode($v['name']).']" placeholder="'.htmlspecialchars($v['name']).(@$v['required']?'*':'').'" value=""  '.(@$v['required']?' class="required"':'').' /></div>';
			break;
			
			case 'textarea':
				$f.='<div class="line"><textarea rows="4" name="fields['.base64_encode($v['name']).']" placeholder="'.htmlspecialchars($v['name']).(@$v['required']?'*':'').'" '.(@$v['required']?' class="required"':'').'></textarea></div>';
			break;

			case 'checkbox':
				$f.='<div class="line"><div class="checkbox-wrapper">'.$v['name'].' <input type="hidden" name="fields['.base64_encode($v['name']).']" value="No" /><input type="checkbox" name="fields['.base64_encode($v['name']).']" value="Yes" '.(@$v['required']?' class="required"':'').' /></div></div>';
			break;
			
		}
		
	}
	
	if(!$f)
		return '';
		
	$content = 
		'<form method="post" action="'.admin_url('admin-ajax.php').'" class="contact-form" id="contact-form"><input type="hidden" name="action" value="om_ajax_contact_form">'.
			$f;
	if(get_option(OM_THEME_PREFIX."form_captcha") == 'true')
		$content.='<div id="om-contact-form-captcha"></div><br/>';
	$content.=
			'<input type="submit" '.($button_title?'value="'.$button_title.'"':'').' />'.
		'</form>'.
		'<div id="contact-form-success" class="infopane color-1 dn"><div class="inner" style="background-image:url('.get_template_directory_uri().'/img/icons/0101.png)">'.$form_success.'</div></div>'.
		'<div id="contact-form-error" class="infopane color-5 dn"><div class="inner" style="background-image:url('.get_template_directory_uri().'/img/icons/0100.png)">'.__('Sorry, an error has occured.','om_theme').'</div></div>'
	;
	
	return $content;
	
}
add_shortcode('contact_form', 'om_sc_contact_form');

/*************************************************************************************
 *	Logos
 *************************************************************************************/

function om_sc_logos( $atts, $content = null ) {
	
	return '<div class="logos">'.$content.'<div class="clear"></div></div>';

}
add_shortcode('logos', 'om_sc_logos');


/*************************************************************************************
 *	Testimonials
 *************************************************************************************/

function om_sc_testimonials( $atts, $content = null ) {
	global $post;

	extract(shortcode_atts(array(
		'mode' => '',
		'timeout' => '0',
		'pause' => false,
		'category' => 0,
	), $atts));
	
	$out='';

	$args=array (
		'post_type' => 'testimonials',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page' => -1
	);
	if($category != 0) {
		$args['tax_query']=array(
			array('taxonomy'=>'testimonials-type', 'terms' => $category),
		);
	}
	$query = new WP_Query($args);
	
	if( $query->have_posts() ) {
		
		
		$timeout=intval($timeout);
		$out .= '<div class="testimonials-block eat-left eat-right'.($mode=='list'?' no-scroll':'').'"'.($timeout?' data-timeout="'.$timeout.'"':'').($pause?' data-pause="1"':'').'><div class="items">';
	
		while ( $query->have_posts() ) {
			
			$query->the_post(); 

			$out .= '<div class="item'.( ( function_exists('has_post_thumbnail') && has_post_thumbnail() )?' with-pic':' no-pic'  ).'"><div class="item-inner">';
			
			$desc=get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'testimonial_author_desc', true);
			$out .= '<div class="name-qo block-2 no-mar"><div class="block-inner"><div class="name-qo-inner">';
				$out .= '<div class="name"><div class="name-name"><a href="'.get_permalink().'">'.( get_the_title() ).'</a></div>'.($desc?'<div class="name-desc">'.$desc.'</div>':'').'</div>';
				$out .= '<div class="qo"></div>';
			$out .= '</div></div></div>';
			if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
				$out .= '<div class="pic block-1 zero-mar"><div class="move-left">'. get_the_post_thumbnail() .'</div></div>';
			}

			global $more;
		  $more = 0;

			$out .= '<div class="text"><div class="block-inner">'.get_the_content(__('Read more...','om_theme')).'</div></div>';
			
			$out .= '</div></div>';
		}
		
		$out .= '</div>';
		if($mode!='list')
			$out .= '<div class="controls"><a href="#" class="prev">&larr;</a><a href="#" class="next">&rarr;</a></div>';
		$out .= '</div>';
	}
	
	/*				
					<div <?php post_class('portfolio-thumb bg-color-main isotope-item block-3 show-hover-link '.$term_list); ?> id="post-<?php the_ID(); ?>">
						<div class="pic block-h-2">
							<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
							<?php the_post_thumbnail('portfolio-thumb'); ?>
							<?php } else { echo '&nbsp'; } ?>
						</div>
						<div class="desc block-h-1">
							<div class="title"><?php the_title(); ?></div>
							<div class="tags"><?php the_terms($post->ID, 'portfolio-type', '', ', ', ''); ?></div>
						</div>
						<a href="<?php the_permalink(); ?>" class="link"><span class="after"></span></a>
					</div>
*/
		
	wp_reset_postdata();
		
	return $out;
	
}
add_shortcode('testimonials', 'om_sc_testimonials');

/*************************************************************************************
 *	Pricing Table
 *************************************************************************************/

function om_sc_pricing( $atts, $content = null ) {

	$out='';
	
	$cells=array();
	//$max_row=0;
	
	if(preg_match_all('#[\s\S]*?\[pricing_column\]([\s\S]*?)\[/pricing_column\][\s\S]*?#',$content,$cols)) {
		
		$i=0;
		foreach($cols[1] as $k=>$col) {
			
			if(preg_match_all('#[\s\S]*?\[(pricing_column_name|price[^]]*|line|button[^]]*)\]([\s\S]*?)\[/(pricing_column_name|price|line|button)\][\s\S]*?#',$col,$rows)) {
				
				$cells[$i]=array();
				$j=0;
				foreach($rows[2] as $k_=>$row) {
					
					if($rows[1][$k_] == 'pricing_column_name')
						$cells[$i][$j]='<li class="pricing-title">'.do_shortcode($row).'</li>';
					elseif($rows[1][$k_] == 'line')
						$cells[$i][$j]='<li>'.do_shortcode($row).'</li>';
					elseif(substr($rows[1][$k_],0,5) == 'price') {
						$rows[1][$k_]=str_replace('&#8220;','"',$rows[1][$k_]);
						$rows[1][$k_]=str_replace('&#8221;','"',$rows[1][$k_]);
						$rows[1][$k_]=str_replace('&#171;','"',$rows[1][$k_]);
						$rows[1][$k_]=str_replace('&#187;','"',$rows[1][$k_]);
						$comment='';
						if( preg_match('#comment="([^"]*)"#',$rows[1][$k_],$m) )
							$comment=$m[1];
						$cells[$i][$j]='<li class="pricing-price">'.do_shortcode($row).($comment?'<div class="price-comment">'.$comment.'</div>':'').'</li>';
					}
					elseif(substr($rows[1][$k_],0,6) == 'button')
						$cells[$i][$j]='<li class="pricing-button">'.do_shortcode('['.$rows[1][$k_].']'.$row.'[/button]').'</li>';
					
					//if($j > $max_row)
					//	$max_row=$j;
					$j++;
				}

				$i++;				
			}
			
		}
		
		$out .= '<div class="pricing-table-wrapper"><div class="pricing-table">';

		foreach($cells as $c) {
			
			$out .= '<ul class="pricing-column">';
			
			foreach($c as $r) {
				
				$out .= $r;
				
			}
			
			$out .='</ul>';
		}

		$out .= '<div class="clear"></div></div></div>';
		
	}
	
	
/*
	if(preg_match_all('#[\s\S]*?\[tr\]([\s\S]*?)\[/tr\][\s\S]*?#',$content,$rows)) {
		
		$out.='<table class="custom-table style-'.$style.'">';
		
		foreach($rows[1] as $row) {
			
			$out.='<tr>';
			
			if(preg_match_all('#[\s\S]*?\[(td|th)\]([\s\S]*?)\[/(td|th)\][\s\S]*?#',$row,$cols)) {
				foreach($cols[2] as $k=>$col) {
					$out.='<'.$cols[1][$k].'>'.do_shortcode($col).'</'.$cols[1][$k].'>';
				}
			}
			
			$out.='</tr>';
			
		}
		
		$out.='</table>';
	}
*/
	
	return $out;
}
add_shortcode('pricing', 'om_sc_pricing');

/*************************************************************************************
 *	Recent Posts
 *************************************************************************************/

function om_sc_recent_posts( $atts, $content = null ) {
	global $post;

	extract(shortcode_atts(array(
		'count' => 3,
		'thumbnails' => false,
		'thumbnails_align' => '',
		'thumbnails_first_big' => false,
		'category' => 0,
		'category_title' => false,
		'offset' => 0,
	), $atts));
	
	$category_=trim($category);
	
	$count=intval($count);
	$offset=intval($offset);
	if(strpos($category, ',') !== false) {
		$category=explode(',',$category);
		for($i=0;$i<count($category);$i++) {
			$category[$i]=intval(trim($category[$i]));
		}
		$category=array_diff($category, array(0));
	} else {
		$category=intval($category);
	}
	/* Demo content has slug in the attribute for correct import. So fetching category id by slug if slug specified
	 */
	if( empty($category) && $category_ != '' && $category_ != '0' ) {
		if ($categoryObj = get_category_by_slug($category_))
			$category=$categoryObj->term_id;
	}
	
	$out='';
	
	if($category_title) {
		$category_arr=get_category($category);
		$out.='<div class="post-small-category-title"><h2><a href="' . get_category_link( $category ) . '">'.$category_arr->name.'</a></h2></div><hr/>';
	}

	$args=array(
		'posts_per_page' => $count,
		'offset' => $offset,
	);
	if(!empty($category)) {
		if(is_array($category))
			$args['category__in']=$category;
		else
			$args['category__in']=array($category);
	}

	$q = new WP_Query($args);
			
	if ($q->have_posts()) {

		$i=0;
		$last_post_type='';
		while ($q->have_posts()) {
			$q->the_post(); 
			if($i && $last_post_type != 'big') $out.= '<hr />';
			
			$format = get_post_format(); 
	
			if($i == 0 && $thumbnails_first_big && ($format=='video'  || $format == 'audio' || has_post_thumbnail()) ) {

				$out.='<div class="post-small post-big-thumb">';

				$out.='<div class="post-title"><h3><a href="'. get_permalink() .'">';
				if($format == 'quote')
					$out.= '&ldquo;'.get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'quote', true);
				else
					$out.=get_the_title();
				
				$out.='</a></h3>';
				if($format == 'quote') { $out.='<p class="post-title-comment">&mdash; '. get_the_title() .'</p>'; }
				if($format == 'link') { $link=get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'link_url', true); if($link) { $out.='<p class="post-title-link"><a href="'. $link .'" target="_blank">'. str_replace('http://','',$link) .'</a></p>'; }  }

				$out.='</div>
					<div class="post-meta">
						<div class="post-date">'. get_the_time( get_option('date_format') ) .'</div>
					</div>
				';

				if($format == 'video') {
					$out.='<div class="post-big-pic eat-left eat-right">';
					if($embed = get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'video_embed', true))
						$out.= '<div class="video-embed" style="padding-bottom:68.33%">'.$embed.'</div>';
					else {
						ob_start();
						om_video_player($post->ID, false);
				    $out .= ob_get_contents();
				    ob_end_clean();
					}
					$out .='</div>';
				} elseif($format == 'audio') {
					$out.='<div class="post-big-pic eat-left eat-right">';
					ob_start();
					om_audio_player($post->ID, false);
			    $out .= ob_get_contents();
			    ob_end_clean();
					$out .='</div>';
				} else {
					if(has_excerpt())
						$excerpt = om_custom_excerpt_more( get_the_excerpt() , true );
					else
						$excerpt = get_the_excerpt();
					$excerpt=preg_replace('#<a[^>]*>([\s\S]+?)</a>#','<span class="cutted-link">$1</span>',$excerpt);
					$out.='<a href="'. get_permalink() .'" class="post-big-pic eat-left eat-right">
						<span class="post-big-pic-pic">'. get_the_post_thumbnail($post->ID, 'portfolio-thumb') .'</span>
						<span class="post-big-pic-over"></span>
						<span class="post-big-pic-text"><span class="block-inner">' . strip_tags($excerpt, '<span>') . '</span></span>
					</a>';
				}
		
				
				$out.='
					<div class="clear"></div>
				</div>';
				
				$last_post_type='big';
								
			} else {
				
				$out.='<div class="post-small'.($thumbnails_align=='right'?' thumbnail-right':'').'">';
				if($thumbnails && has_post_thumbnail()) {
					$out.='<div class="post-pic block-1 zero-mar">
						<div class="block-inner inner '.($thumbnails_align=='right'?'move-right':'move-left').'">
							<a href="'. get_permalink() .'">'. get_the_post_thumbnail() .'</a>
						</div>
					</div>';
				}
				$out.='<div class="post-title"><h3><a href="'. get_permalink() .'">';
		
				$format = get_post_format();
				if($format == 'quote')
					$out.= '&ldquo;'.get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'quote', true);
				else
					$out.=get_the_title();
				
				$out.='</a></h3>';
				
				if($format == 'quote') { $out.='<p class="post-title-comment">&mdash; '. get_the_title() .'</p>'; }
				if($format == 'link') { $link=get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'link_url', true); if($link) { $out.='<p class="post-title-link"><a href="'. $link .'" target="_blank">'. str_replace('http://','',$link) .'</a></p>'; }  }
				
				$out.='</div>
					<div class="post-meta">
						<div class="post-date">'. get_the_time( get_option('date_format') ) .'</div>
					</div>
					<div class="post-text">';
					
				if(has_excerpt())
					$out .= om_custom_excerpt_more( get_the_excerpt() , true );
				else
					$out .= get_the_excerpt();
				//else {
				//	$tmp=explode('<!--more-->',$post->post_content);
				//	if(strpos( $post->post_content , "<!--more-->" ) !== false)
				//		$out .=om_custom_excerpt_more(apply_filters('the_content',$tmp[0]), true);
				//	else
				//		$out .= apply_filters('the_content',$tmp[0]);
				//}
				
				$out.='
					</div>
					<div class="clear"></div>
				</div>';
				
				$last_post_type='small';
			}
			    	
			$i++;
		}
	}
	
	wp_reset_query();
		
	return $out;
}
add_shortcode('recent_posts', 'om_sc_recent_posts');

/*************************************************************************************
 *	Recent Portfolios
 *************************************************************************************/

function om_sc_recent_portfolios( $atts, $content = null ) {
	global $post;

	extract(shortcode_atts(array(
		'count' => 3,
		'category' => 0,
		'randomize' => false
	), $atts));
	
	$count=intval($count);
	$category=intval($category);
	$out='';

	$args=array(
		'posts_per_page' => $count,
		'post_type' => 'portfolio',
		'orderby' => 'menu_order',
		'order' => 'ASC',
	);

	if($randomize) {
		$args['orderby']='rand';
	} else {
		$sort=get_option(OM_THEME_PREFIX . 'portfolio_sort');
		if($sort == 'date_asc') {
			$args['orderby'] = 'date';
			$args['order'] = 'ASC';
		} elseif($sort == 'date_desc') {
			$args['orderby'] = 'date';
			$args['order'] = 'DESC';
		}
	}	
	
	if($category != 0) {
		$args['tax_query']=array(
			array('taxonomy'=>'portfolio-type', 'terms' => $category),
		);
	}

	$q = new WP_Query($args);
			
	if ($q->have_posts()) {

		$out.='<div class="portfolio-shortcode eat-left eat-right"><div class="eat-outer-margins"><div class="portfolio-wrapper">';

		while ($q->have_posts()) {
			$q->the_post(); 

			$link=get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'portfolio_custom_link', true);
			if(!$link)
				$link=get_permalink();
							
			$out.='<div class="portfolio-thumb block-3 show-hover-link">
				<div class="pic block-h-2">';
			if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
				$out.= get_the_post_thumbnail($post->ID, 'portfolio-thumb');
			} else { $out.= '&nbsp'; }
			$out.='
				</div>
				<div class="desc block-h-1">
					<div class="title">'. get_the_title() .'</div>
					<div class="tags">'. get_the_term_list($post->ID, 'portfolio-type', '', ', ', '') .'</div>
				</div>
				<a href="'. $link .'" class="link"><span class="after"></span></a>
			</div>';
				
		}
		
		$out.='<div class="clear"></div></div></div></div>';
	}
	
	wp_reset_query();
		
	return $out;
}
add_shortcode('recent_portfolios', 'om_sc_recent_portfolios');