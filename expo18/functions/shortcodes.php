<?php

/*************************************************************************************
 *	Shortcodes
 *************************************************************************************/


/*************************************************************************************
 *	Columns
 *************************************************************************************/
 
function om_sc_one_half( $atts, $content = null ) {
	return '<div class="one-half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'om_sc_one_half');

function om_sc_one_half_last( $atts, $content = null ) {
	return '<div class="one-half last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'om_sc_one_half_last');

/****************/

function om_sc_one_third( $atts, $content = null ) {
	return '<div class="one-third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'om_sc_one_third');

function om_sc_one_third_last( $atts, $content = null ) {
	return '<div class="one-third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'om_sc_one_third_last');

function om_sc_two_third( $atts, $content = null ) {
	return '<div class="two-third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'om_sc_two_third');

function om_sc_two_third_last( $atts, $content = null ) {
	return '<div class="two-third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_third_last', 'om_sc_two_third_last');

/****************/

function om_sc_one_fourth( $atts, $content = null ) {
	return '<div class="one-fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'om_sc_one_fourth');

function om_sc_one_fourth_last( $atts, $content = null ) {
	return '<div class="one-fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 'om_sc_one_fourth_last');

function om_sc_three_fourth( $atts, $content = null ) {
	return '<div class="three-fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'om_sc_three_fourth');

function om_sc_three_fourth_last( $atts, $content = null ) {
	return '<div class="three-fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fourth_last', 'om_sc_three_fourth_last');

/****************/

function om_sc_one_fifth( $atts, $content = null ) {
	return '<div class="one-fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'om_sc_one_fifth');

function om_sc_one_fifth_last( $atts, $content = null ) {
	return '<div class="one-fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fifth_last', 'om_sc_one_fifth_last');

function om_sc_two_fifth( $atts, $content = null ) {
	return '<div class="two-fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'om_sc_two_fifth');

function om_sc_two_fifth_last( $atts, $content = null ) {
	return '<div class="two-fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_fifth_last', 'om_sc_two_fifth_last');

function om_sc_three_fifth( $atts, $content = null ) {
	return '<div class="three-fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'om_sc_three_fifth');

function om_sc_three_fifth_last( $atts, $content = null ) {
	return '<div class="three-fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fifth_last', 'om_sc_three_fifth_last');

function om_sc_four_fifth( $atts, $content = null ) {
	return '<div class="four-fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'om_sc_four_fifth');

function om_sc_four_fifth_last( $atts, $content = null ) {
	return '<div class="four-fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('four_fifth_last', 'om_sc_four_fifth_last');

/****************/

function om_sc_one_sixth( $atts, $content = null ) {
	return '<div class="one-sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'om_sc_one_sixth');

function om_sc_one_sixth_last( $atts, $content = null ) {
	return '<div class="one-sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_sixth_last', 'om_sc_one_sixth_last');

function om_sc_five_sixth( $atts, $content = null ) {
	return '<div class="five-sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'om_sc_five_sixth');

function om_sc_five_sixth_last( $atts, $content = null ) {
	return '<div class="five-sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('five_sixth_last', 'om_sc_five_sixth_last');

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
										
	return '<div class="tabs-tab tab-'. sanitize_title( $title ) .'">'. do_shortcode( $content ) .'</div>';
}
add_shortcode( 'tab', 'om_sc_tab' );

function om_sc_tabs( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'vertical' => ''
	), $atts ));
		
	$titles='';
	if( preg_match_all( '/\[[^\]]*tab[^\]]*title="([^\"]+)"[^\]]*\]/i', $content, $m ) ) {
		
		foreach($m[1] as $v) {
			$titles.='<li><a href="#tab-'. sanitize_title ( $v ) .'"><span>'.$v.'</span></a></li>';
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
 *	Images
 *************************************************************************************/

function om_sc_full_width_image( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'title'    	 => ''
	), $atts));
	
	if($title)
		$title='<div class="image-title">'.$title.'</div>';

	return
		'<div class="image-block full-width">'.
			do_shortcode($content).
			$title.
		'</div>'
	;
	
}
add_shortcode('full_width_image', 'om_sc_full_width_image');

function om_sc_image_center( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'title'    	 => ''
	), $atts));
	
	if($title)
		$title='<div class="image-title">'.$title.'</div>';

	return
		'<div class="image-block center">'.
			do_shortcode($content).
			$title.
		'</div>'
	;
	
}
add_shortcode('image_center', 'om_sc_image_center');

function om_sc_image_left( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'title'    	 => ''
	), $atts));
	
	if($title)
		$title='<div class="image-title">'.$title.'</div>';

	return
		'<div class="image-block left">'.
			do_shortcode($content).
			$title.
		'</div>'
	;
	
}
add_shortcode('image_left', 'om_sc_image_left');

function om_sc_image_right( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'title'    	 => ''
	), $atts));
	
	if($title)
		$title='<div class="image-title">'.$title.'</div>';

	return
		'<div class="image-block right">'.
			do_shortcode($content).
			$title.
		'</div>'
	;
	
}
add_shortcode('image_right', 'om_sc_image_right');

/*************************************************************************************
 *	Table
 *************************************************************************************/
 
function om_sc_custom_table( $atts, $content = null ) {

	return
		'<div class="custom-table-wrapper">'.
			do_shortcode($content).
		'</div>'
	;
	
}
add_shortcode('custom_table', 'om_sc_custom_table');

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
 *	Clear
 *************************************************************************************/

function om_sc_clear( $atts, $content = null ) {
	return '<div class="clear"></div>';
}
add_shortcode('clear', 'om_sc_clear');

/*************************************************************************************
 *	Biginfopane
 *************************************************************************************/

function om_sc_biginfopane( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'url'     	 => '',
		'href'     	 => '',
		'target'     => '',
		'title' => '',
		'buttontitle' => ''
	), $atts));
	
	if(!$href && $url)
		$href=$url;
	
	if(!$href)
		$href='#';
	
	if($target)
		$target=' target="'.$target.'"';

	return
		'<div class="binfopane-wrapper">'.
			'<div class="binfopane">'.
				'<div class="binfopane-inner">'.
					'<div class="text">'.
						($title?'<div class="big">'.$title.'</div>':'').
						'<div>'.$content.'</div>'.
					'</div>'.
					($buttontitle?'<div class="i-button"><a href="'.$href.'"'.$target.' class="binfopane-button">'.$buttontitle.'</a></div>':'').
				'</div>'.
			'</div>'.
		'</div>'
		;

}
add_shortcode('biginfopane', 'om_sc_biginfopane');

/*************************************************************************************
 *	Dropcaps
 *************************************************************************************/

function om_sc_dropcap( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'size'     	 => '36',
		'textcolor'     	 => '',
		'bgcolor'     => ''
	), $atts));
	
	$style=array();
	if($textcolor)
		$style[]='color:'.$textcolor;
	if($bgcolor && $bgcolor != 'theme')
		$style[]='background-color:'.$bgcolor;
	$size=intval($size);
	if($size)
		$style[]='font-size:'.$size.'px;line-height:'.$size.'px';
		
	return
		'<span class="dropcap'.($bgcolor=='theme'?' bgcolor-theme':'').($bgcolor?' with-bg-color':'').'"'.(!empty($style)?' style="'.implode(';',$style).'"':'').'>'.$content.'</span>'	
		;

}
add_shortcode('dropcap', 'om_sc_dropcap');

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
 *	Individual Bullets
 *************************************************************************************/

function om_sc_space( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'size' => '',
	), $atts));
	
	$size=intval($size);
	if($size)
		return '<div class="clear" style="height:'.$size.'px"></div>';
	else
		return '<div class="clear" style="height:18px"></div>';
}
add_shortcode('space', 'om_sc_space');

/*************************************************************************************
 *	Dots Divider
 *************************************************************************************/

function om_sc_dots_divider( $atts, $content = null ) {

	return '<div class="dots-divider"></div>';
}
add_shortcode('dots_divider', 'om_sc_dots_divider');


/*************************************************************************************
 *	Testimonial
 *************************************************************************************/

function om_sc_testimonial( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'author'     	 => '',
		'author_comment'     	 => '',
		'photo'     => ''
	), $atts));
	
	return
	'<div class="testimonial-wrapper">'.
		'<div class="testimonial">'.
			'<div class="text">'.
				$content.
			'</div>'.
			'<div class="author">'.
				'<div class="author-inner">'.
					'<div class="name">'.
						$author.
						($author_comment?'<div class="t-comment">'.$author_comment.'</div>':'').
					'</div>'.
					($photo?'<div class="photo"><img src="'.$photo.'" alt="'.htmlspecialchars($author).'" /></div>':'').
				'</div>'.
			'</div>'.
		'</div>'.
	'</div>'
	;

}
add_shortcode('testimonial', 'om_sc_testimonial');



/*************************************************************************************
 *	Big Header
 *************************************************************************************/

function om_sc_bigheader( $atts, $content = null ) {
	
	return
		'<div class="h-bg">'.$content.'</div>'
	;

}
add_shortcode('big_header', 'om_sc_bigheader');

/*************************************************************************************
 *	Agenda
 *************************************************************************************/

function om_sc_agenda( $atts, $content = null ) {
	
	return
		'<div class="pane-wraper"><div class="pane agenda">'.do_shortcode($content).'</div></div>';
	;

}
add_shortcode('agenda', 'om_sc_agenda');

function om_sc_agenda_day( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'date'     	 => ''
	), $atts));
	
	return
		'<div class="agenda-day">'.$content.($date?'<span class="date">'.$date.'</span>':'').'</div>';
	;

}
add_shortcode('day', 'om_sc_agenda_day');

function om_sc_agenda_event( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'time'     	 => '',
		'room'     	 => ''
	), $atts));
	
	return
		'<div class="agenda-item">'.
			'<div class="agenda-item-inner">'.
				'<div class="time"><span class="icon-time">'.str_replace('-','&mdash;',$time).'</span></div>'.
					'<div class="description">'.
					'<p>'.do_shortcode($content).'</p>'.
				'</div>'.
				($room?'<div class="room-cell"><div class="room">'.$room.'</div></div>':'').
			'</div>'.
		'</div>'
	;

}
add_shortcode('event', 'om_sc_agenda_event');

function om_sc_agenda_lunch( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'time'     	 => '',
		'room'     	 => ''
	), $atts));

						
	return
		'<div class="agenda-item gray">'.
			'<div class="agenda-item-inner">'.
				'<div class="time"><span class="icon-lunch">'.str_replace('-','&mdash;',$time).'</span></div>'.
					'<div class="description">'.
					'<p>'.$content.'</p>'.
				'</div>'.
				($room?'<div class="room-cell"><div class="room">'.$room.'</div></div>':'').
			'</div>'.
		'</div>'
	;

}
add_shortcode('lunch', 'om_sc_agenda_lunch');


/*************************************************************************************
 *	Speakers
 *************************************************************************************/

function om_sc_speaker( $atts, $content = null ) {
	
	
	extract(shortcode_atts(array(
		'photo'     	 => '',
		'name'     	 => '',
		'post'     => '',
		'company'     => '',
		'link'     => '',
		'target'     => ''
	), $atts));
	
	if($photo) {
		$photo_=om_http2local($photo);
		if(stripos($photo_, 'http') !== 0)
			$im_size=@getimagesize($photo);
		else
			$im_size[3]='';
	}
	
	if($target)
		$target=' target="'.$target.'"';
	
	return
		'<div class="speaker-item">'.
			($link?'<a href="'.$link.'" class="pic"'.$target.'>':'<div class="pic">').
				($photo?'<img src="'.$photo.'" alt="" '.$im_size[3].'/>':'').
				'<div class="name">'.$name.'</div>'.
			($link?'</a>':'</div>').
			'<div class="text">'.
				($post||$company?'<p><i>'.$post.($post&&$company?',<br/>':'').'<span>'.$company.'</span></i></p>':'').
				'<p>'.$content.'</p>'.
			'</div>'.
		'</div>'
	;

}
add_shortcode('speaker', 'om_sc_speaker');

/*************************************************************************************
 *	Speakers
 *************************************************************************************/

function om_sc_logos( $atts, $content = null ) {
	
	return '<div class="logos">'.$content.'<div class="clear"></div></div>';

}
add_shortcode('logos', 'om_sc_logos');

/*************************************************************************************
 *	Registration Form
 *************************************************************************************/

function om_sc_registration_form( $atts, $content = null ) {

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
				$f.='<div class="line">'.$v['name'].(@$v['required']?'*':'').' <input type="hidden" name="fields['.base64_encode($v['name']).']" value="No" /><input type="checkbox" name="fields['.base64_encode($v['name']).']" value="Yes" '.(@$v['required']?' class="required"':'').' /></div>';
			break;
			
		}
		
	}
	
	if(!$f)
		return '';
		
	$content = 
		'<form method="post" action="'.admin_url('admin-ajax.php').'" class="registration-form" id="registration-form"><input type="hidden" name="action" value="om_ajax_registration_form">'.
			$f.
			'<input type="submit" '.($button_title?'value="'.$button_title.'"':'').' />'.
		'</form>'.
		'<div id="registration-form-success" class="infopane color-1 dn"><div class="inner" style="background-image:url('.get_template_directory_uri().'/img/icons/0101.png)">'.$form_success.'</div></div>'.
		'<div id="registration-form-error" class="infopane color-5 dn"><div class="inner" style="background-image:url('.get_template_directory_uri().'/img/icons/0100.png)">'.__('Sorry, an error has occured.','om_theme').'</div></div>'
	;
	
	return $content;
	
}
add_shortcode('registration_form', 'om_sc_registration_form');

/*************************************************************************************
 *	Map
 *************************************************************************************/

function om_sc_map( $atts, $content = null ) {
	
	
	extract(shortcode_atts(array(
		'height'     	 => '',
	), $atts));

	if ( is_numeric( $height ) ) {
		$content = preg_replace( '/height="[0-9]*"/', 'height="' . $height . '"', $content );
	} else {
		$paddingb='';
		if(preg_match('|width="([0-9]+)".*?height="([0-9]+)"|',$content,$m)) {
			if($m[1] && $m[2])
				$paddingb=' style="padding-bottom:'.($m[2]/$m[1]*100).'%"';
		}
		$content = '<div class="responsive-embed"'.$paddingb.'>'.$content.'</div>';
	}
	
	return
		'<div class="om-gmap">'.
			$content.
		'</div>'
	;

}
add_shortcode('map', 'om_sc_map');