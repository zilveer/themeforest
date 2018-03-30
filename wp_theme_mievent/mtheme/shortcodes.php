<?php
/*Columns*/
add_shortcode('section', 'mtheme_section');
function mtheme_section($atts, $content = null) {
	extract(shortcode_atts(array(
		'align'  => '',
		'padding'  => '',		
    ), $atts));
	
	switch($align)
	{
		case 'left': $align=' align-left'; break;
		case 'center': $align=' align-center'; break;
		case 'right': $align=' align-right'; break;
	}
	return '<section class="section-padding-'.esc_attr($padding.$align).'"><div class="container">'.do_shortcode($content).'</div></section>';
}

add_shortcode('container', 'mtheme_container');
function mtheme_container($atts, $content = null) {
	extract(shortcode_atts(array(
		'align'  => '',
		'padding'  => '',
    ), $atts));
	
	switch($align)
	{
		case 'left': $align=' align-left'; break;
		case 'center': $align=' align-center'; break;
		case 'right': $align=' align-right'; break;
	}
	return '<div class="container section-padding-'.esc_attr($padding.$align).'"><div class="row">'.do_shortcode($content).'</div></div>';
}

add_shortcode('row', 'mtheme_row');
function mtheme_row($atts, $content = null) {
	extract(shortcode_atts(array(
		'align'  => '',
		'padding'  => 'none',
    ), $atts));
	
	switch($align)
	{
		case 'left': $align=' align-left'; break;
		case 'center': $align=' align-center'; break;
		case 'right': $align=' align-right'; break;
	}
	return '<div class="row section-padding-'.esc_attr($padding.$align).'">'.do_shortcode($content).'</div>';
}

add_shortcode('one_col', 'mtheme_one_col');
function mtheme_one_col($atts, $content = null) {
	extract(shortcode_atts(array(
		'align'  => '',
		'margin'  => 'bottom',
		'column'  => '',
    ), $atts));
	
	if(!empty($column))
	{
		$column='column-'.$column;
	}
	
	switch($align)
	{
		case 'left': $align=' align-left'; break;
		case 'center': $align=' align-center'; break;
		case 'right': $align=' align-right'; break;
	}
	return '<div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 section-margin-'.esc_attr($margin.$align.$column).'">'.do_shortcode($content).'</div>';
}

add_shortcode('two_col', 'mtheme_two_col');
function mtheme_two_col($atts, $content = null) {
	extract(shortcode_atts(array(
		'align'  => '',
		'margin'  => 'bottom',
		'column'  => '',
    ), $atts));
	
	if(!empty($column))
	{
		$column='column-'.$column;
	}
	
	switch($align)
	{
		case 'left': $align=' align-left'; break;
		case 'center': $align=' align-center'; break;
		case 'right': $align=' align-right'; break;
	}
	return '<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 section-margin-'.esc_attr($margin.$align.$column).'">'.do_shortcode($content).'</div>';
}

add_shortcode('three_col', 'mtheme_three_col');
function mtheme_three_col($atts, $content = null) {
	extract(shortcode_atts(array(
		'align'  => '',
		'margin'  => 'bottom',
		'column'  => '',
    ), $atts));
	
	if(!empty($column))
	{
		$column='column-'.$column;
	}	
	
	switch($align)
	{
		case 'left': $align=' align-left'; break;
		case 'center': $align=' align-center'; break;
		case 'right': $align=' align-right'; break;
	}
	return '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 section-margin-'.esc_attr($margin.$align.$column).'">'.do_shortcode($content).'</div>';
}

add_shortcode('four_col', 'mtheme_four_col');
function mtheme_four_col($atts, $content = null) {
	extract(shortcode_atts(array(
		'align'  => '',
		'margin'  => 'bottom',
		'column'  => '',
    ), $atts));
	
	if(!empty($column))
	{
		$column='column-'.$column;
	}	
	
	switch($align)
	{
		case 'left': $align=' align-left'; break;
		case 'center': $align=' align-center'; break;
		case 'right': $align=' align-right'; break;
	}
	return '<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 section-margin-'.esc_attr($margin.$align.$column).'">'.do_shortcode($content).'</div>';
}

add_shortcode('five_col', 'mtheme_five_col');
function mtheme_five_col($atts, $content = null) {
	extract(shortcode_atts(array(
		'align'  => '',
		'margin'  => 'bottom',
		'column'  => '',
    ), $atts));
	
	if(!empty($column))
	{
		$column='column-'.$column;
	}	
	
	switch($align)
	{
		case 'left': $align=' align-left'; break;
		case 'center': $align=' align-center'; break;
		case 'right': $align=' align-right'; break;
	}
	return '<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 section-margin-'.esc_attr($margin.$align.$column).'">'.do_shortcode($content).'</div>';
}

add_shortcode('six_col', 'mtheme_six_col');
function mtheme_six_col($atts, $content = null) {
	extract(shortcode_atts(array(
		'align'  => '',
		'margin'  => 'bottom',
		'column'  => '',
    ), $atts));
	
	if(!empty($column))
	{
		$column='column-'.$column;
	}	
	
	switch($align)
	{
		case 'left': $align=' align-left'; break;
		case 'center': $align=' align-center'; break;
		case 'right': $align=' align-right'; break;
	}
	return '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 section-margin-'.esc_attr($margin.$align.$column).'">'.do_shortcode($content).'</div>';
}

add_shortcode('seven_col', 'mtheme_saven_col');
function mtheme_saven_col($atts, $content = null) {
	extract(shortcode_atts(array(
		'align'  => '',
		'margin'  => 'bottom',
		'column'  => '',
    ), $atts));
	
	if(!empty($column))
	{
		$column='column-'.$column;
	}	
	
	switch($align)
	{
		case 'left': $align=' align-left'; break;
		case 'center': $align=' align-center'; break;
		case 'right': $align=' align-right'; break;
	}
	return '<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 section-margin-'.esc_attr($margin.$align.$column).'">'.do_shortcode($content).'</div>';
}

add_shortcode('eight_col', 'mtheme_eight_col');
function mtheme_eight_col($atts, $content = null) {
	extract(shortcode_atts(array(
		'align'  => '',
		'margin'  => 'bottom',
		'column'  => '',
    ), $atts));
	
	if(!empty($column))
	{
		$column='column-'.$column;
	}	
	
	switch($align)
	{
		case 'left': $align=' align-left'; break;
		case 'center': $align=' align-center'; break;
		case 'right': $align=' align-right'; break;
	}
	return '<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 section-margin-'.esc_attr($margin.$align.$column).'">'.do_shortcode($content).'</div>';
}

add_shortcode('nine_col', 'mtheme_nine_col');
function mtheme_nine_col($atts, $content = null) {
	extract(shortcode_atts(array(
		'align'  => '',
		'margin'  => 'bottom',
		'column'  => '',
    ), $atts));
	
	if(!empty($column))
	{
		$column='column-'.$column;
	}	
	
	switch($align)
	{
		case 'left': $align=' align-left'; break;
		case 'center': $align=' align-center'; break;
		case 'right': $align=' align-right'; break;
	}
	return '<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 section-margin-'.esc_attr($margin.$align.$column).'">'.do_shortcode($content).'</div>';
}

add_shortcode('ten_col', 'mtheme_ten_col');
function mtheme_ten_col($atts, $content = null) {
	extract(shortcode_atts(array(
		'align'  => '',
		'margin'  => 'bottom',
		'column'  => '',
    ), $atts));
	
	if(!empty($column))
	{
		$column='column-'.$column;
	}	
	
	switch($align)
	{
		case 'left': $align=' align-left'; break;
		case 'center': $align=' align-center'; break;
		case 'right': $align=' align-right'; break;
	}
	return '<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 section-margin-'.esc_attr($margin.$align.$column).'">'.do_shortcode($content).'</div>';
}

add_shortcode('eleven_col', 'mtheme_eleven_col');
function mtheme_eleven_col($atts, $content = null) {
	extract(shortcode_atts(array(
		'align'  => '',
		'margin'  => 'bottom',
		'column'  => '',
    ), $atts));
	
	if(!empty($column))
	{
		$column='column-'.$column;
	}	
	
	switch($align)
	{
		case 'left': $align=' align-left'; break;
		case 'center': $align=' align-center'; break;
		case 'right': $align=' align-right'; break;
	}
	return '<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 section-margin-'.esc_attr($margin.$align.$column).'">'.do_shortcode($content).'</div>';
}

add_shortcode('fullwidth', 'mtheme_fullwidth');
function mtheme_fullwidth($atts, $content = null) {
	extract(shortcode_atts(array(
		'align'  => '',
		'margin'  => 'bottom',
		'column'  => '',
    ), $atts));
	
	if(!empty($column))
	{
		$column='column-'.$column;
	}	
	
	switch($align)
	{
		case 'left': $align=' align-left'; break;
		case 'center': $align=' align-center'; break;
		case 'right': $align=' align-right'; break;
	}
	return '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-margin-'.esc_attr($margin.$align.$column).'">'.do_shortcode($content).'</div>';
}

add_shortcode('footer', 'mtheme_footer');
function mtheme_footer($atts, $content = null) {
	extract(shortcode_atts(array(
		'align'  => '',
    ), $atts));
	
	switch($align)
	{
		case 'left': $align=' align-left'; break;
		case 'center': $align=' align-center'; break;
		case 'right': $align=' align-right'; break;
	}
	return '<footer'.esc_attr($align).'>'.do_shortcode($content).'</footer>';
}

add_shortcode('fancy-title', 'mtheme_fancy_title');
function mtheme_fancy_title($atts, $content = null) {
	extract(shortcode_atts(array(
		'align'  => 'center',
		'border'  => 'bottom',
		'heading'  => 'h3',		
    ), $atts));	
	if($border=='title')
	{
		$align='left';
	}
   return '<div class="fancy-title title-'.esc_attr($align).' border-'.esc_attr($border).'"><'.esc_attr($heading).'>'.mtheme_html($content).'</'.esc_attr($heading).'></div>';
}

add_shortcode('hr', 'mtheme_hr');
function mtheme_hr($atts, $content = null) {
	extract(shortcode_atts(array(
		'style' => 'solid',
		'color' => '',
		'size' => '1px',
		'width' => '100',
    ), $atts));
	if(empty($color))
	{
		$color=MthemeCore::getOption("secondary_color","#1bce7c");
	}
	
   return '<hr style="border-style:'.esc_attr($style).';width:'.esc_attr($width).'%;border-color:'.esc_attr($color).';border-width:'.esc_attr($size).';"/>';
}

add_shortcode('esc_shortcode', 'mtheme_esc_shortcode');
function mtheme_esc_shortcode($atts, $content = null) {
   return $content;
}

/*Content*/
add_shortcode('content', 'mtheme_content');
function mtheme_content($atts, $content=null) {
	extract(shortcode_atts(array(		
    ), $atts));
	
	$out=do_shortcode($content);
	
    return $out;
}

/*Button*/
add_shortcode('button','mtheme_button');
function mtheme_button($atts, $content=null) {	
	extract(shortcode_atts(array(
		'type'     	 => 'primary'
    ), $atts));
	
	$out='<button type="button" class="btn btn-'.esc_attr($type).'">'.do_shortcode($content).'</button>';
	
	return $out;
}

/*alert*/
add_shortcode('alert','mtheme_alert');
function mtheme_alert($atts, $content=null) {	
	extract(shortcode_atts(array(
		'type'     	 => 'success',
		'closable'   => '',
		'icon'     	 => ''		
    ), $atts));
	
	$fontIcon='';
	switch($icon)
	{
		case 'success': $fontIcon="<i class='fa fa-gift'></i><strong>Well done!</strong> "; break;
		case 'important': $fontIcon="<i class=' fa fa-hand-o-up '></i><strong>Heads up!</strong> "; break;
		case 'warning': $fontIcon="<i class='fa fa-exclamation-triangle '></i><strong>Warning!</strong> "; break;
		case 'danger': $fontIcon="<i class='fa fa-times-circle '></i><strong>Oh snap!</strong> "; break;		
	}
	
	if(!empty($closable) && $closable=='yes')
	{
		$closable="<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
	}
	else{
		$closable="";
	}
	
	$out='<div class="alert alert-'.esc_attr($type).'">'.$closable.$fontIcon.do_shortcode($content).'</div>';
	
	return $out;
}

/*accordions*/
add_shortcode('accordions','mtheme_accordions');
function mtheme_accordions($atts, $content=null) {	
	extract(shortcode_atts(array(
		'type'     	 => 'bg'
    ), $atts));
	
	
	$out='<div class="accordion accordion-'.esc_attr($type).' clearfix">'.do_shortcode($content).'</div>';
	
	return $out;
}

/*accordion*/
add_shortcode('accordion','mtheme_accordion');
function mtheme_accordion($atts, $content=null) {	
	extract(shortcode_atts(array(
		'title'     	 => ''
    ), $atts));
	
	$out="<div class='acctitle'><i class='acc-closed fa fa-check-circle-o'></i><i class='acc-open fa fa-times-circle-o'></i>$title</div>";
	$out.="<div class='acc_content clearfix'>".do_shortcode($content).'</div>';
	
	return $out;
}
	

/*toggles*/
add_shortcode('toggles','mtheme_toggles');
function mtheme_toggles($atts, $content=null) {	
	extract(shortcode_atts(array(
		'type'     	 => 'bg'
    ), $atts));
	
	
	$out='<div class="toggle toggle-'.esc_attr($type).'">'.do_shortcode($content).'</div>';
	
	return $out;
}

/*toggle*/
add_shortcode('toggle','mtheme_toggle');
function mtheme_toggle($atts, $content=null) {	
	extract(shortcode_atts(array(
		'title'     	 => ''
    ), $atts));
			   
	$out="<div class='toggle-container'><div class='togglet'><i class='toggle-closed fa fa-check-circle-o'></i><i class='toggle-open fa fa-times-circle-o'></i>Our Mission</div>";
	$out.="<div class='togglec'>".do_shortcode($content).'</div></div>';
	
	return $out;
}

/*list*/
add_shortcode('list','mtheme_list');
function mtheme_list($atts, $content=null) {	
	extract(shortcode_atts(array(
		'type'     	 => ''
    ), $atts));
	
	$preOut='<ul class="list">';$postOut='</ul>';
	if($type=='ordered')
	{
		$preOut='<ol>';$postOut='</ol>';
	}
	
	$out=$preOut.do_shortcode($content).$postOut;
	
	return $out;
}

/*item*/
add_shortcode('item','mtheme_item');
function mtheme_item($atts, $content=null) {	
	extract(shortcode_atts(array(
		'type'     	 => '0'
    ), $atts));
	
	if(!empty($type) && $type!='none' && $type!='0')
	{
		$type="<i class='fa fa-".esc_attr($type)."'></i>";
	}
	
	$out='<li>'.$type.do_shortcode($content).'</li>';
	
	return $out;
}
	
/*Tabs*/
add_shortcode('tabs','mtheme_tabs');
function mtheme_tabs($atts, $content=null) {
	extract(shortcode_atts(array(
		'type' => 'horizontal'
    ), $atts));
	
	$out='';
	
	if($type=='vertical') {
		$out.='<div class="tabs side-tabs clearfix"><ul class="tab-nav clearfix">';
	} else {
		$out.='<ul class="nav nav-tabs boot-tabs">';
	}	
	
	$tabs=explode('][', $content);
	
	$count=0;
	$preOut='';
	foreach($tabs as $tab) {
		$title='';
		$count++;		
		preg_match('/tab\s{1,}title=\"(.*)\"/', $tab, $matches);			
		if(isset($matches[1])) {
			$title=$matches[1];
		}		
				
		if(!empty($title)) {
			if($type=='vertical') {
				$out.='<li><a href="#'.mtheme_sanitize_key($title).'">'.mtheme_html($title).'</a></li>';
			} else {				
				$contMatches= mtheme_between($tab,']','[');
				if($count==1){
					$out.='<li class="active"><a href="#'.mtheme_sanitize_key($title).'" data-toggle="tab">'.mtheme_html($title).'</a></li>';
					$preOut.=do_shortcode('[tab title="'.esc_attr($title).'" active="yes"]'.mtheme_html($contMatches).'[/tab]');
				}
				else{
					$out.='<li><a href="#'.mtheme_sanitize_key($title).'" data-toggle="tab">'.mtheme_html($title).'</a></li>';
					$preOut.=do_shortcode('[tab title="'.esc_attr($title).'"]'.mtheme_html($contMatches).'[/tab]');
				}				
			}
		}
		
	}
	
	if($type=='vertical') {
		$out.='</ul><div class="tab-container">';
	} else {
		$out.='</ul><div class="tab-content">';
	}
	if($type=='vertical') {
		$out.=do_shortcode($content);
	}
	else{
		$out.=$preOut;
	}
    
	if($type=='vertical') {
		$out.='</div></div>';
	} else {
		$out.='</div>';
	}
	
    return $out;
}

add_shortcode('tab', 'mtheme_tabs_panes');
function mtheme_tabs_panes($atts, $content=null) {
	extract(shortcode_atts(array(
		'title' => '',
		'active' => '',
    ), $atts));
	
	if($active=='yes') {
		$active=' active';
	}
	
	$out='<div class="tab-pane tab-content'.esc_attr($active).' clearfix" id="'.mtheme_sanitize_key($title).'">'.do_shortcode($content).'</div>';	
    return $out;
}

/*modal*/
add_shortcode('modal', 'mtheme_modal');
function mtheme_modal($atts, $content = null) {
   extract(shortcode_atts(array(
		'title' 	 => 'link',
		'modal_heading' 	 => '',
    ), $atts));
	
	$micosec = uniqid();
	
	if(empty($modal_heading))
	{
		$modal_heading=$title;
	}
	$modal_id="modal_$micosec";
	
	$out='<button class="md-trigger" data-modal="'.esc_attr($modal_id).'">'.mtheme_html($title).'</button>';
	$out.='<div class="md-modal md-effect-9" id="'.esc_attr($modal_id).'">';
	$out.='<div class="md-content padding-none">';
	$out.='<div class="folio">';
	$out.='<div class="sp-name disclaimer"><strong>'.mtheme_html($title).'</strong></div>';
	$out.='<div class="sp-dsc disclaim-border">'.mtheme_html($content).'</div>';
	$out.='<button class="md-close"><i class="fa fa-times"></i></button>';
	$out.='</div></div></div><div class="md-overlay"></div>';
	return $out;
}

/*Event*/
add_shortcode('event_intro','mtheme_event_intro');
function mtheme_event_intro($atts, $content=null) {	
	extract(shortcode_atts(array(
		'event_id' => '',
		'background_image' => '',
		'background_color' => '',
		'heading_color'	=> '',
		'content_color'	=> '',
    ), $atts));
	
	if(empty($background_image))
	{
		$background_image=MthemeCore::getPostMeta($event_id, "event_event_bg_img","");
	}
	if(empty($background_color))
	{
		$background_color=MthemeCore::getPostMeta($event_id, "event_bg_color",MthemeCore::getOption("background_color"));
	}
	if(empty($heading_color))
	{
		$heading_color=MthemeCore::getPostMeta($event_id, "event_heading_color",MthemeCore::getOption("heading_color","#363738"));
	}
	if(empty($content_color))
	{
		$content_color=MthemeCore::getPostMeta($event_id, "event_content_color",MthemeCore::getOption("content_color","#5f6061"));
	}
	
	$title=MthemeCore::getPostMeta($event_id,"event_event_title","About the Event");
	$content=MthemeCore::getPostMeta($event_id,"event_event_content");
	
	if(!empty($background_image))
	{
		$out='<section style="background-image:url(\''.esc_url($background_image).'\');" class="text-center section-padding">';
	}
	else{
		$out='<section style="background-color:'.esc_attr($background_color).';" class="text-center section-padding">';
	}
	
	$out.='<div class="container wow animated fadeInLeft animated" data-wow-duration="1s" data-wow-delay="0.5s">';
	$out.='<div class="row">';
	$out.='<div class="col-lg-8 align-center about">';
	$out.='<h1 style="color:'.esc_attr($heading_color).'">'.mtheme_html($title).'</h1>';
	$out.='<hr>';
	$out.='<p style="color:'.esc_attr($content_color).'">'.mtheme_html($content).'</p>';
	$out.='</div>';
	$out.='</div>';
	$out.='</div>';
	$out.='</section>';
	
	return $out;
}

/*event_brochure*/
add_shortcode('event_brochure','mtheme_event_brochure');
function mtheme_event_brochure($atts, $content=null) {	
	extract(shortcode_atts(array(
		'event_id' => '',
		'download_schedule_title' => '',
		'pdf_url' => '',
		'fb_connect_title' => '',
		'fb_share_link' => '',
		'background_image' => '',		
		'background_color' => '',
		'heading_color'   => '',
		'padding'   => 'section-padding-bottom',
    ), $atts));
	
	if(empty($pdf_url))
	{
		$pdf_url=MthemeCore::getPostMeta($event_id,"event_event_pdf","");
	}
	if(empty($download_schedule_title))
	{
		$download_schedule_title=MthemeCore::getPostMeta($event_id, "event_download_schedule_title","download schedule");
	}
	if(empty($fb_connect_title))
	{
		$fb_connect_title=MthemeCore::getPostMeta($event_id,"event_fb_connect_title","connect via facebook");
	}
	if(empty($fb_share_link))
	{
		$fb_share_link=MthemeCore::getPostMeta($event_id, "event_event_fb_share_link","");
	}
	if(empty($background_color))
	{
		$background_color=MthemeCore::getPostMeta($event_id, "event_sl_bg_color",MthemeCore::getOption("background_color","#FFF"));
	}
	if(empty($heading_color))
	{
		$heading_color=MthemeCore::getOption("heading_color","#363738");
	}
	$out='';
	if(!empty($fb_share_link) || !empty($pdf_url)){
		$class='';
		if(!empty($fb_share_link) && !empty($pdf_url)){
			$class=' left_50';
		}
		if(!empty($background_image))
		{
			$out.='<section style="background-image:url(\''.esc_url($background_image).'\');" class="event-download-social-link '.$padding.'">';
		}
		else{
			$out.='<section style="background-color:'.esc_attr($background_color).';" class="event-download-social-link '.$padding.'">';
		}
		
		$out.='<div class="col-lg-12 col-md-12 align-center">';
		if(!empty($pdf_url)){
			$out.='<a class="d-sch border_bottom text-right'.esc_attr($class).'" href="'.esc_url($pdf_url).'" target="_blank" style="color:'.esc_attr($heading_color).';">'.esc_attr($download_schedule_title).'<i class="fa  fa-2x fa-download"></i></a>';			
			$class=' left_50'.' border_left';
		}if(!empty($fb_share_link)){
			$out.='<a class="fb'.esc_attr($class).'" href="'.esc_url($fb_share_link).'" target="_blank" style="color:'.esc_attr($heading_color).';"><i class="fa  fa-2x fa-facebook"></i>'.esc_attr($fb_connect_title).'</a>';
		}
		$out.='</div></section>';
	}
	
	return $out;
}

/*mtheme_features*/
add_shortcode('event_features','mtheme_event_features_fun');
function mtheme_event_features_fun($atts, $content=null) {	
	extract(shortcode_atts(array(
		'title'     => '',
		'event_id' => '',
		'gallery'     => 'show',
		'video'     => 'show',
		'number' => '-1',
		'order' => 'menu_order',
		'category' => '',
		'status' => '',
		'thumbnail_width' => 620,
		'thumbnail_height' => 410,
		'slide_title' => 'show',
		'slide_title_position' => 'top',
		'slide_description' => 'show',
		'slide_description_position' => 'top',
		'hover_active' => 'yes',
		'hover_background_color' => '#1bd982',		
		'background_color'	=> '',
		'primary_color'   => '',
		'secondary_color'	=> '',		
    ), $atts));
	
	
	if(empty($background_color))
	{
		$background_color=MthemeCore::getPostMeta($event_id, "event_event_f_bg_color",MthemeCore::getOption("background_color","#212739"));
	}
	$class='container';
	$head_out='<div class="'.esc_attr($class).'">';
	$foot_out='</div>';

	if($gallery=='show' && $video=='show')
	{
		$class.=' col-lg-6 col-md-12';
		$head_out='<div class="'.esc_attr($class).'">';
	}
	else if($gallery=='show')
	{
		$class.=' col-lg-9 col-md-12';
		$head_out='<div class="'.esc_attr($class).'">';
		$head_out.='<div style="float: left;width: 75%;">';
		$foot_out.='</div>';
	}
	else if($video=='show')
	{
		$class.=' col-lg-9 col-md-12';
		$head_out='<div class="'.esc_attr($class).'">';
		$head_out.='<div style="float: right;width: 75%;">';
		$foot_out.='</div>';
	}
	 
	 
	$out='<section class="event-features clearfix" style="background-color:'.esc_attr($background_color).';">';	
	
	if($gallery=='show')
	{
		$out.=mtheme_ThreeDImageSlider($atts);
	}	
	
	$out.=$head_out.mtheme_event_features($atts).$foot_out;
	
	if($video=='show')
	{
		$out.=mtheme_event_video($atts);
	}	
	$out.='</section>';
	return $out;
}

/*Features*/
add_shortcode('features','mtheme_event_features');
function mtheme_event_features($atts, $content=null) {	
	
	extract(shortcode_atts(array(
		'event_id' => '',
		'primary_color'   => '',
		'tertiary_color'	=> '',
		'secondary_color'	=> '',
		'event_duration'   => '',
		'event_duration_title'	=> '',
		'event_duration_brief'   => '',
		'event_no_speakers'	=> '',
		'event_speakers_brief'   => '',
		'event_speakers_title'   => '',
		'event_no_tech'	=> '',
		'event_tech_title'   => '',
		'event_tech_brief'   => '',
    ), $atts));
	
	if(empty($primary_color))
	{
		$primary_color=MthemeCore::getPostMeta($event_id, "event_event_f_p_color",MthemeCore::getOption("secondary_color","#1bce7c"));
	}
	if(empty($secondary_color))
	{
		$secondary_color=MthemeCore::getPostMeta($event_id, "event_event_f_s_color",MthemeCore::getOption("primary_color","#FFFFFF"));
	}
	if(empty($tertiary_color))
	{
		$tertiary_color=MthemeCore::getOption("tertiary_color","#1bce7c");
	}
	if(empty($event_duration))
	{
		$event_duration=MthemeCore::getPostMeta($event_id, "event_event_duration");
	}
	if(empty($event_duration_title))
	{
		$event_duration_title=MthemeCore::getPostMeta($event_id, "event_event_duration_title");
	}
	
	if(empty($event_duration_brief))
	{
		$event_duration_brief=MthemeCore::getPostMeta($event_id, "event_event_duration_brief");
	}	
	if(empty($event_no_speakers))
	{
		$event_no_speakers=MthemeCore::getPostMeta($event_id, "event_event_no_speakers");
	}
	if(empty($event_speakers_title))
	{
		$event_speakers_title=MthemeCore::getPostMeta($event_id, "event_event_speakers_title");
	}
	if(empty($event_speakers_brief))
	{
		$event_speakers_brief=MthemeCore::getPostMeta($event_id, "event_event_speakers_brief");
	}
	if(empty($event_no_tech))
	{
		$event_no_tech=MthemeCore::getPostMeta($event_id, "event_event_no_tech");
	}
	if(empty($event_tech_title))
	{
		$event_tech_title=MthemeCore::getPostMeta($event_id, "event_event_tech_title");
	}
	if(empty($event_tech_brief))
	{
		$event_tech_brief=MthemeCore::getPostMeta($event_id, "event_event_tech_brief");
	}
	
	$count=0;
	$class="col-md-4 ";		
	if(!empty($event_duration) || !empty($event_duration_title) || !empty($event_duration_brief)) $count++;
	if(!empty($event_no_speakers) || !empty($event_speakers_title) || !empty($event_speakers_brief)) $count++;
	if(!empty($event_no_tech) || !empty($event_tech_title) || !empty($event_tech_brief)) $count++;
	switch($count)
	{
		case 1:$class="col-md-12 ";break;
		case 2:$class="col-md-6 ";break;
	}
	
	$out='<div class="features-wrapper text-center">';
	if(!empty($event_duration) || !empty($event_duration_title) || !empty($event_duration_brief))
	{
		
		$out.='<div class="'.esc_attr($class).'wow animated fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">';
		$out.='<div class="icon" style="color:'.esc_attr($tertiary_color).';">'.mtheme_html($event_duration).'</div>';
		$out.='<h2 style="color:'.esc_attr($primary_color).';">'.mtheme_html($event_duration_title).'</h2>';
		$out.='<p style="color:'.esc_attr($secondary_color).';">'.mtheme_html($event_duration_brief).'</p>';
		$out.='</div>';
	}
	
	if(!empty($event_no_speakers) || !empty($event_speakers_title) || !empty($event_speakers_brief))
	{
		$out.='<div class="'.esc_attr($class).'wow animated fadeInUp" data-wow-duration="1s" data-wow-delay="0.7s">';
		$out.='<div class="icon" style="color:'.esc_attr($tertiary_color).';">'.mtheme_html($event_no_speakers).'</div>';
		$out.='<h2 style="color:'.esc_attr($primary_color).';">'.mtheme_html($event_speakers_title).'</h2>';
		$out.='<p style="color:'.esc_attr($secondary_color).';">'.mtheme_html($event_speakers_brief).'</p>';
		$out.='</div>';
	}
	
	if(!empty($event_no_tech) || !empty($event_tech_title) || !empty($event_tech_brief))
	{		
		$out.='<div class="'.esc_attr($class).'wow animated fadeInUp" data-wow-duration="1s" data-wow-delay="0.9s">';
		$out.='<div class="icon" style="color:'.esc_attr($tertiary_color).';">'.mtheme_html($event_no_tech).'</div>';
		$out.='<h2 style="color:'.esc_attr($primary_color).';">'.mtheme_html($event_tech_title).'</h2>';
		$out.='<p style="color:'.esc_attr($secondary_color).';">'.mtheme_html($event_tech_brief).'</p>';
		$out.='</div>';
		$out.='<div class="clearfix"></div>';
	}
	$out.='</div>';
		
	
	return $out;
}

	
/*Video*/
add_shortcode('event_video','mtheme_event_video');
function mtheme_event_video($atts, $content=null) {	
	
	extract(shortcode_atts(array(	
		'event_id' => '',
		'title'     => 'VIDEO',
		'video_url'     => '',
		'video_type'     => '',
		'background_image' => '',
		'background_color' => '',
		'hover_active' => '',
		'hover_color'	=> '',
		'content_color'	=> '',
    ), $atts));
	
	
	if(empty($video_url))
	{
		if($video_type=='youtube')
		{
			$video_url=MthemeCore::getPostMeta($event_id, "event_event_video",'http://youtu.be/GQRjWxfz-PQ');
		}
		else{
			$video_url=MthemeCore::getPostMeta($event_id, "event_event_video",'http://vimeo.com/75976293');
		}
	}	
	if(empty($video_type))
	{
		$video_type=MthemeCore::getPostMeta($event_id,"event_video_type",'vimeo');
	}
	
	if(empty($background_image))
	{
		$background_image=MthemeCore::getPostMeta($event_id, "event_video_bg_img","");
	}
	if(empty($background_color))
	{
		$background_color=MthemeCore::getPostMeta($event_id, "event_video_bg_color","");
	}
	if(empty($hover_active))
	{
		$hover_active=MthemeCore::getPostMeta($event_id,"event_video_hover_active",'yes');
	}
	if(empty($hover_color))
	{
		$hover_color=MthemeCore::getPostMeta($event_id, "event_video_hover_color",MthemeCore::getOption("secondary_color","#1bce7c"));
	}
	if(empty($content_color))
	{
		$content_color=MthemeCore::getOption("primary_color","#ffffff");
	}
	
	$out=$hoverId='';
	if($hover_active=='yes')
	{
		$hoverId='event_video_hover'.uniqid();
		$out.='<script type="text/javascript">';
		$out.='window.globalEventVideoHoverActive = "yes";';
		$out.='window.globalEventVideoHoverId.push("'.esc_js($hoverId).'");';
		$out.='</script>';
	}
	
	if(!empty($background_image))
	{
		$out.='<div id="'.esc_attr($hoverId).'" data-backtype="image" data-hoverout="'
		.esc_attr($background_image).'" data-hoverin="'.esc_attr($hover_color)
		.'" class="slide_gallery vimeo-video col-lg-3 col-sm-12" style="background: url(\''
		.esc_url($background_image).'\') no-repeat scroll 0 / cover;">';
	}
	else{
		$out.='<div id="'.esc_attr($hoverId).'" data-backtype="color" data-hoverout="'
		.esc_attr($background_color).'" data-hoverin="'.esc_attr($hover_color)
		.'" style="background-color:'.esc_attr($background_color).';" class="slide_gallery vimeo-video col-lg-3 col-sm-12">';
	}	
	
	$out.='<a class="venoboxvid" data-type="'.esc_attr($video_type).'"  href="'.esc_url($video_url).'" target="_self">';
	$out.='<img src="'.CHILD_URI.'/site/img/vdo-icn.png" alt="video_hover"></a>';
	$out.='<a class="gal-span venoboxvid" data-type="'.esc_attr($video_type).'"  href="'.esc_url($video_url).'" target="_self">';
	$out.='<span style="color:'.esc_attr($content_color).';">'.mtheme_html($title).'</span>';
	$out.='</a>';
	$out.='</div>';
	
	return $out;
}

/*ThreeDImageSlider*/
add_shortcode('ThreeDImageSlider', 'mtheme_ThreeDImageSlider');
function mtheme_ThreeDImageSlider($atts) {
	$haveSlidesInGallery=false;
	extract(shortcode_atts(array(
		'gallery_title' => '',
		'number' => '-1',
		'order' => 'menu_order',
		'category' => '',
		'status' => '',
		'thumbnail_width' => 620,
		'thumbnail_height' => 410,
		'slide_title' => '',
		'slide_title_position' => '',
		'slide_description' => '',
		'slide_description_position' => '',
		'hover_background_color' => '',
		'background_image' => '',
		'background_color'	=> '',
		'hover_color' => '',
		'primary_color' => '',
		'heading_color' => '',
		'content_color'	=> ''
    ), $atts));
	
	if($order=='random') {
		$order='rand';
	}
		
	$args=array(
		'post_type' => 'gallery_slide',
		'post_status' => 'publish',
		'showposts' => $number,	
		'orderby' => $order,
		'order' => 'ASC',
		'meta_query' => array(
			array(
				'key' => '_thumbnail_id',
			),
		),
		
	);
	
	if(!empty($status)) {
		$args['meta_query'][]=array(
            'key' => '_gallery_slide_status',
			'value' => $status,
        );
	}
	
	$texanomy= null;	
	$micosec = uniqid();
	
	$unique_id="gallery_$micosec";
	if(!empty($category)) {
		
		$category_int=intval($category);		
		if(empty($category_int))
		{
			$texanomy = get_term_by('slug',$category,'gallery_cat');
			if($texanomy!=null)
			{
				$args['tax_query'][]=array(
					'taxonomy' => 'gallery_cat',
					'terms' => $category,
					'field' => 'slug',
				);
			}
		}
		else{
			$texanomy = get_term_by('term_id',$category,'gallery_cat');
			if($texanomy!=null)
			{
				$args['tax_query'][]=array(
					'taxonomy' => 'gallery_cat',
					'terms' => $category_int,
					'field' => 'term_id',
				);
			}
		}
		
		
	}
	$query=new WP_Query($args);	
	
	if($texanomy)
	{		
		if(empty($gallery_title))
		{
			$gallery_title=$texanomy->name;
		}
		if(empty($slide_title))
		{
			$slide_title=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'gal_'.'slide_title','show');	
		}
		if(empty($slide_title_position))
		{
			$slide_title_position=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'gal_'.'slide_title_position','top');	
		}
		if(empty($slide_description))
		{
			$slide_description=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'gal_'.'slide_description','show');	
		}
		if(empty($slide_description_position))
		{
			$slide_description_position=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'gal_'.'slide_description_position');	
		}
		if(empty($hover_active))
		{
			$hover_active=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'gal_'.'hover_active','yes');	
		}
		if(empty($hover_background_color))
		{
			$hover_background_color=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'gal_'.'hover_background_color');	
		}
		if(empty($background_image))
		{
			$background_image=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'gal_'.'background_img');
			if($background_image)
			{
				$background_image=$background_image['src'];
			}			
		}
		if(empty($background_color))
		{
			$background_color=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'gal_'.'background_color');
		}
		if(empty($heading_color))
		{
			$heading_color=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'gal_'.'heading_color');	
		}
		if(empty($content_color))
		{
			$content_color=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'gal_'.'content_color');	
		}
		
	}
	else{
		if(empty($gallery_title))
		{
			$gallery_title="Gallery";
		}
		if(empty($slide_title))
		{
			$slide_title='show';
		}		
		if(empty($slide_title_position))
		{
			$slide_title_position='top';
		}	
		if(empty($slide_description))
		{
			$slide_description='show';
		}		
		if(empty($slide_description_position))
		{
			$slide_description_position='top';
		}		
		if(empty($hover_active))
		{
			$hover_active='yes';
		}		
		if(empty($hover_background_color))
		{
			$hover_background_color=MthemeCore::getOption('secondary_color','#1bd982');
		}
		if(empty($background_color))
		{
			$background_color=MthemeCore::getOption('background_color','#212739');	
		}	
		if(empty($heading_color))
		{
			$heading_color=MthemeCore::getOption('heading_color','#363738');	
		}
		if(empty($content_color))
		{
			$content_color=MthemeCore::getOption('content_color','#5f6061');	
		}
	}
	
	if(empty($background_color))
	{
		$background_color=MthemeCore::getOption('background_color','#212739');	
	}
	if(empty($hover_background_color) || $hover_background_color=='#')
	{
		$hover_background_color=MthemeCore::getOption('secondary_color','#1bd982');	
	}
	if(empty($primary_color) || $primary_color=='#')
	{
		$primary_color=MthemeCore::getOption('primary_color','#ffffff');	
	}
	if(empty($heading_color) || $heading_color=='#')
	{
		$heading_color=MthemeCore::getOption('heading_color','#363738');	
	}
	if(empty($content_color) || $content_color=='#')
	{
		$content_color=MthemeCore::getOption('content_color','#5f6061');	
	}
	
	$out='<div class="col-lg-3 col-sm-12 nopadding">';
	$out.='<div id="'.esc_attr($unique_id).'" class="grid-gallery"><section class="grid-wrap">';
	$out.='<div class="grid-gal">';	
	
	$hoverId='';
	if($hover_active=='yes')
	{
		$hoverId='threeDImage_hover'.$micosec;
		$out.='<script type="text/javascript">';
		$out.='window.globalThreeDImageHoverActive = "yes";';
		$out.='window.globalThreeDImageId.push("'.$hoverId.'");';
		$out.='</script>';
	}
	
	if(!empty($background_image))
	{
		$out.='<figure id="'.esc_attr($hoverId).'" data-backtype="image" data-hoverout="'
		.esc_attr($background_image).'" data-hoverin="'.esc_attr($hover_background_color)
		.'" class="slide_gallery" style="background: url(\''.esc_url($background_image).'\') no-repeat scroll 0 / cover;">';
	}
	else
	{
		$out.='<figure id="'.esc_attr($hoverId).'" data-backtype="color" data-hoverout="'
		.esc_attr($background_color).'" data-hoverin="'.esc_attr($hover_background_color)
		.'" class="slide_gallery" style="background-color: '.esc_attr($background_color).';">';
	}
	
	$out.='<a href="#"><img src="'.CHILD_URI.'site/img/gallery/gal-icn.png" alt="gallery"></a>';
	$out.='<a class="gal-span" href="#"><span style="color:'.esc_attr($primary_color).'">'.mtheme_html($gallery_title).'</span></a></figure></div></section>';
	
	$out.='<section class="slideshow"><ul>';
	
	while($query->have_posts()){
		$query->the_post();	
		$haveSlidesInGallery=true;
		ob_start();
		
		$temp_out='';
		if(($slide_title=='show' && $slide_title_position=='top') || ($slide_description=='show' && $slide_description_position=='top'))
		{
			$temp_out.='<figcaption>';
			if($slide_title=='show' && $slide_title_position=='top')
			{
				$temp_out.='<h3 style="color:'.esc_attr($heading_color).'">'.get_the_title(get_the_ID()).'</h3>';
			}
			if($slide_description=='show' && $slide_description_position=='top')
			{
				$temp_out.='<hr/><p style="color:'.esc_attr($content_color).'">'.get_the_content(get_the_ID()).'</p>';
			}
			$temp_out.='</figcaption>';
		}
		$temp_out.=get_the_post_thumbnail(get_the_ID(),array($thumbnail_width,$thumbnail_height));
		if(($slide_title=='show' && $slide_title_position=='bottom') || ($slide_description=='show' && $slide_description_position=='bottom'))
		{
			$temp_out.='<figcaption>';
			if($slide_title=='show' && $slide_title_position=='bottom')
			{
				$temp_out.='<h3 style="color:'.esc_attr($heading_color).'">'.get_the_title(get_the_ID()).'</h3>';
			}
			if($slide_description=='show' && $slide_description_position=='bottom')
			{
				$temp_out.='<hr/><p style="color:'.esc_attr($content_color).'">'.get_the_content(get_the_ID()).'</p>';
			}
			$temp_out.='</figcaption>';
		}
		$out.='<li><figure>';
		$out.=$temp_out;
		$out.='</figure></li>';
		
		
		ob_end_clean();
	}
	
	if(!$haveSlidesInGallery)
	{
		$out.='<li style="width: 660px;height: 1000px;"><figure>';
		$out.='<h3>No Slides</h3>';
		$out.='</figure></li>';
	}
	$out.='</ul><nav><span class="nav-prev fa-chevron-left fa fa-2x "></span><span class="nav-next fa-chevron-right fa fa-2x"></span>';
	$out.='<span class="close nav-close"><i class="fa fa-times"></i></span></nav></section>';
	$out.='</div></div>';
	$out.='<script type="text/javascript">window.globalGridGalleryActive ="yes";';
	$out.='window.globalGridGallery.push("'.esc_js($unique_id).'");</script>';
	wp_enqueue_script('classie.grid.gallery-js', CHILD_URI.'site/js/classie.grid.gallery.js',array("jquery-js"),array(),true);
	wp_enqueue_script('modernizr.gridgallery-js', CHILD_URI.'site/js/modernizr.gridgallery.js',array("jquery-js"),array(),true);
	wp_enqueue_script('cbpGridGallery-js', CHILD_URI.'site/js/cbpGridGallery.js',array("jquery-js"),array(),true);
	
	return $out;
}


/*Contact Form*/
add_shortcode('event_registration_form', 'mtheme_registration_form');
function mtheme_registration_form($atts, $content=null) {

	extract(shortcode_atts(array(
		'background_image' => '',
		'background_color' => '',
		'button_heading' => '',
		'primary_color'   => '',
		'secondary_color'	=> '',
    ), $atts));
	
	if(empty($background_image))
	{
		$background_image=MthemeCore::getOption("contact_form_bg_img","");
	}
	if(empty($background_color))
	{
		$background_color=MthemeCore::getOption("contact_form_bg_color","");
	}
	if(empty($primary_color))
	{
		$primary_color=MthemeCore::getOption("contact_form_p_color","#FFFFFF");
	}
	if(empty($secondary_color))
	{
		$secondary_color=MthemeCore::getOption("contact_form_s_color","#1bce7c");
	}
	
	if(empty($background_image) && empty($background_color))
	{
		$background_image=CHILD_URI.'site/img/backgrounds/bg-input.jpg';
	}
	
	
	$micosec = uniqid();	
	$unique_id="contact_$micosec";
	
	if(!empty($background_image))
	{
		$out='<section id="register_me" class="section-padding" style="background:url(\''.esc_url($background_image).'\') no-repeat fixed center center / cover  rgba(0, 0, 0, 0)!important;" class="text-center register_me">';
	}
	else{
		$out='<section id="register_me" class="section-padding" style="background-color:'.esc_attr($background_color).';" class="text-center register_me">';
	}
	
	$title=MthemeCore::getOption("registration_title","");
	$content=MthemeCore::getOption("registration_content");
	
	$out.='<div class="container">';
	if(!empty($title))
	{		
		$out.='<div class="row"><div data-wow-delay="0.5s" data-wow-duration="1s" class="col-md-8 align-center wow animated fadeInLeft animated" style="visibility: visible; animation-duration: 1s; animation-delay: 0.5s; animation-name: fadeInLeft;"><h1 style="color:'.esc_attr($primary_color).';">'.mtheme_html($title).'</h1><hr>';
		if(!empty($content))$out.='<p style="color:'.esc_attr($primary_color).';">'.mtheme_html($content).'</p>';
		$out.='</div></div>';
	}
	$out.='<div class="row">';
	$out.='<div class="col-lg-9 align-center">';
	
	$out.='<form action="'.AJAX_URL.'" method="POST" id="'.esc_attr($unique_id).'" style="color:'.esc_attr($primary_color).';" class="nl-form ajax-form">';	
	
	ob_start();
	MthemeForm::renderContactForm('contact',$button_heading,$secondary_color);
	$out.=ob_get_contents();
	ob_end_clean();		
	
	$out.='<div class=".form-loader-div"><span class="form-loader"></span></div>';
	$out.='<div class="nl-overlay"></div>';
	$out.='<div class="message"></div>';
	$out.='<input type="hidden" name="slug" value="contact" />';
	$out.='<input type="hidden" class="action" value="'.MTHEME_PREFIX.'form_submit" /></form>';
	$out.='<script type="text/javascript">window.globalNLFormActive ="yes";';
	$out.='window.globalNLForm.push("'.esc_js($unique_id).'");</script>';
	wp_enqueue_script('nlform-js', CHILD_URI.'site/js/nlform.js',array("jquery-js"),array(),true);
	
	
	$terms_active=MthemeCore::getOption("terms_active");
	$title=MthemeCore::getOption("terms_title");
	$content=MthemeCore::getOption("terms_content");
	
	if($terms_active=='true' && !empty($title)){
		$out.='<div class="col-md-12 tc">'.MthemeCore::getOption("terms_title_pre","Please read the");
		$out.=do_shortcode("[modal title='$title']".mtheme_html($content)."[/modal]");
		$out.=MthemeCore::getOption("terms_title_suf","carefully.").'</div>';
	}
	$out.='</div></div></div>';
	
	$out.='</section>';
	 
	return $out;
}

/*Contact Form*/
add_shortcode('event_wpcf7_contact_form', 'mtheme_wpcf7_contact_form');
function mtheme_wpcf7_contact_form($atts, $content=null) {

	extract(shortcode_atts(array(
		'id' => '',
		'title' => '',
		'background_image' => '',
		'background_color' => '',
		'button_heading' => '',
		'primary_color'   => '',
		'secondary_color'	=> '',
		
    ), $atts));
	
	if(empty($background_image))
	{
		$background_image=MthemeCore::getOption("contact_form_bg_img","");
	}
	if(empty($background_color))
	{
		$background_color=MthemeCore::getOption("contact_form_bg_color","");
	}
	if(empty($primary_color))
	{
		$primary_color=MthemeCore::getOption("contact_form_p_color","#FFFFFF");
	}
	if(empty($secondary_color))
	{
		$secondary_color=MthemeCore::getOption("contact_form_s_color","#1bce7c");
	}
	
	if(empty($background_image) && empty($background_color))
	{
		$background_image=CHILD_URI.'site/img/backgrounds/bg-input.jpg';
	}
	
	$micosec = uniqid();	
	$unique_id="register_me";
	
	if(!empty($background_image))
	{
		$out='<section id="register_me" class="section-padding" style="background:url(\''.esc_url($background_image).'\') no-repeat fixed center center / cover  rgba(0, 0, 0, 0)!important;" class="text-center register_me">';
	}
	else{
		$out='<section id="register_me" class="section-padding" style="background-color:'.esc_attr($background_color).';" class="text-center register_me">';
	}
	
	$title=MthemeCore::getOption("registration_title","Registration for Event");
	$content=MthemeCore::getOption("registration_content");

	$out.='<div class="container">';
	if(!empty($title))
	{		
		$out.='<div class="row"><div data-wow-delay="0.5s" data-wow-duration="1s" class="col-md-8 align-center wow animated fadeInLeft animated" style="visibility: visible; animation-duration: 1s; animation-delay: 0.5s; animation-name: fadeInLeft;"><h1 style="color:'.esc_attr($primary_color).';">'.mtheme_html($title).'</h1><hr>';
		if(!empty($content))$out.='<p style="color:'.esc_attr($primary_color).';">'.mtheme_html($content).'</p>';
		$out.='</div></div>';
	}
	$out.='<div class="row">';
	$out.='<div class="col-lg-9 align-center">';
	
	$out.=do_shortcode('[contact-form-7 id="'.$id.'" title="'.$title.'"]');;
	
	
	$terms_active=MthemeCore::getOption("terms_active");
	$title=MthemeCore::getOption("terms_title");
	$content=MthemeCore::getOption("terms_content");
	
	if($terms_active=='true' && !empty($title)){
		$out.='<div class="col-md-12 tc">Please read the';
		$out.=do_shortcode("[modal title='$title']".mtheme_html($content)."[/modal]");
		$out.='carefully.</div>';
	}
	$out.='</div></div></div>';
	
	
	$form_font_size=14;
	$button_font_size=14;
	$button_type="button-large";
	switch($button_type)
	{
		case "button-mini":$button_type.='height: 30px;width: 103px;line-height: 24px;margin:10px;font-size: '.$button_font_size.'px;';break;
		case "button-small":$button_type.='height: 35px;width: 125px;line-height: 32px;margin:10px;font-size: '.$button_font_size.'px;';break;
		case "button-medium":$button_type.='height: 38px;width: 150px;line-height: 34px;margin:10px;font-size: '.$button_font_size.'px;';break;
		case "button-large":$button_type.='height: 43px;width: 173px;line-height: 36px;margin:10px;font-size: '.$button_font_size.'px;';break;
		case "button-xlarge":$button_type.='height: 53px;width: 212px;line-height: 45px;margin:10px;font-size: '.$button_font_size.'px;';break;
	}
	$out.='<style type="text/css">#'.$unique_id.' .wpcf7-form .wpcf7-form-control.wpcf7-text,#'.$unique_id.' .wpcf7-form p{';
	$out.='color:'.$secondary_color.';font-size:'.$form_font_size.'px;';
	$out.='}';
	$out.='#'.$unique_id.' .wpcf7-form .wpcf7-form-control.wpcf7-form-control.wpcf7-textarea{';
	$out.='color:'.$secondary_color.';font-size:'.$form_font_size.'px;';
	$out.='}';
	$out.='#'.$unique_id.' .wpcf7-form .wpcf7-form-control.wpcf7-form-control.wpcf7-number{';
	$out.='color:'.$secondary_color.';font-size:'.$form_font_size.'px;';
	$out.='}';
	$out.='#'.$unique_id.' .wpcf7-form .wpcf7-form-control.wpcf7-form-control.wpcf7-wpcf7-range{';
	$out.='color:'.$secondary_color.';font-size:'.$form_font_size.'px;';
	$out.='}';
	$out.='#'.$unique_id.' .wpcf7-form .wpcf7-form-control.wpcf7-form-control.wpcf7-date{';
	$out.='color:'.$secondary_color.';font-size:'.$form_font_size.'px;';
	$out.='}';
	$out.='#'.$unique_id.' .wpcf7-form .wpcf7-form-control.wpcf7-form-control.wpcf7-select{';
	$out.='color:'.$secondary_color.';font-size:'.$form_font_size.'px;';
	$out.='}';
	$out.='#'.$unique_id.' .wpcf7-form .wpcf7-form-control.wpcf7-form-control.wpcf7-quiz{';
	$out.='color:'.$secondary_color.';font-size:'.$form_font_size.'px;';
	$out.='}';
	$out.='#'.$unique_id.' .wpcf7-form .wpcf7-form-control.wpcf7-form-control.wpcf7-submit{';
	$out.='color:'.$secondary_color.';';
	$out.=$button_type;
	$out.='}';
	$out.='</style>';
	
	$out.='</section>';
	 
	return $out;
}

/*carousel_slider*/
add_shortcode('carousel_slider', 'mtheme_carousel_slider');
function mtheme_carousel_slider($atts) {
	
	extract(shortcode_atts(array(
		'number' => '-1',
		'order' => 'menu_order',
		'category' => '',
		'status' => '',
		'thumbnail_width' => 1170,
		'thumbnail_height' => 520
    ), $atts));
	
	if($order=='random') {
		$order='rand';
	}
		
	$args=array(
		'post_type' => 'carousel_slide',
		'post_status' => 'publish',
		'showposts' => $number,	
		'orderby' => $order,
		'order' => 'ASC',
		'meta_query' => array(
			array(
				'key' => '_thumbnail_id',
			),
		),
		
	);
	
	if(!empty($status)) {
		$args['meta_query'][]=array(
            'key' => '_carousel_slide_status',
			'value' => $status,
        );
	}
	
	$out='';
	$micosec = uniqid();	
	$unique_id="carousel_slide_$micosec";
	
	if(!empty($category)) {
		
		$category_int=intval($category);		
		if(empty($category_int))
		{
			$texanomy = get_term_by('slug',$category,'carousel_cat');
			if($texanomy!=null)
			{
				$args['tax_query'][]=array(
					'taxonomy' => 'carousel_cat',
					'terms' => $category,
					'field' => 'slug',
				);
			}			
		}
		else{
			$texanomy = get_term_by('term_id',$category,'carousel_cat');
			if($texanomy!=null)
			{
				$args['tax_query'][]=array(
					'taxonomy' => 'carousel_cat',
					'terms' => $category_int,
					'field' => 'term_id',
				);
			}
		}
	}
	$query=new WP_Query($args);	
	
	if($query->have_posts()){
	
		$out='<div id="'.esc_attr($unique_id).'" class="carousel slide" data-ride="carousel">';	
		$out.='<div class="carousel-inner">';
		
		$posts = $query->get_posts();
		$slideC=0;
		foreach($posts as $post){			
			
			$slideC++;
			if($slideC==1){
				$out.='<div class="item active">';
			}else{
				$out.='<div class="item">';
			}
			$out.=get_the_post_thumbnail($post->ID,array($thumbnail_width,$thumbnail_height));
			$out.='</div>';
		}	
		$out.='</div><a class="left carousel-control" href="#'.esc_attr($unique_id).'" role="button" data-slide="prev">';
		$out.='<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="15.5px" height="28.5px" viewBox="0 0 15.5 28.5" enable-background="new 0 0 15.5 28.5" xml:space="preserve" style="fill:#fff;">';
		$out.='<polygon points="14.068,28.5 15.5,27.091 2.814,14.25 15.5,1.409 14.068,0 0,14.242 0.008,14.25 0,14.258 "/>';
		$out.='</svg>';
		$out.='</a>';
		$out.='<a class="right carousel-control" href="#'.esc_attr($unique_id).'" role="button" data-slide="next">';
		$out.='<svg version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="15.5px" height="28.5px" viewBox="0 0 15.5 28.5" enable-background="new 0 0 15.5 28.5" xml:space="preserve" style="fill:#fff;">';
		$out.='<polygon points="1.432,28.5 0,27.091 12.686,14.25 0,1.409 1.432,0 15.5,14.242 15.492,14.25 15.5,14.258 "/>';
		$out.='</svg>';
		$out.='</a>';
		$out.='</div>';
	}	
		
	return $out;
}

/*Notify Me*/
add_shortcode('event_notify_form', 'mtheme_event_notify_form');
function mtheme_event_notify_form($atts, $content=null) {

	extract(shortcode_atts(array(
		'background_image' => '',
		'background_color' => '',
		'primary_color'   => '',
		'secondary_color'	=> '',
		'button_title'	=> ''
    ), $atts));
	
	
	if(empty($background_image))
	{
		$background_image=MthemeCore::getOption("notify_bg_img","");
	}
	if(empty($background_color))
	{
		$background_color=MthemeCore::getOption("notify_bg_color","");
	}
	if(empty($primary_color))
	{
		$primary_color=MthemeCore::getOption("notify_p_color",MthemeCore::getOption("primary_color","#FFFFFF"));
	}
	if(empty($secondary_color))
	{
		$secondary_color=MthemeCore::getOption("notify_s_color",MthemeCore::getOption("secondary_color","#1bce7c"));
	}
	if(empty($notify_button_heading))
	{
		$button_title=MthemeCore::getOption("notify_button_heading","Subscribe");
	}
	
	$title=MthemeCore::getOption("notify_title","Subscribe for newsletter");
	$content=MthemeCore::getOption("notify_content");

	if(empty($background_image) && empty($background_color))
	{
		$background_image=CHILD_URI.'site/img/macbook.jpg';
	}
	
	$micosec = uniqid();	
	$unique_id="notify_$micosec";
	
	if(!empty($background_image))
	{
		$out='<section style="background:url(\''.esc_url($background_image).'\') no-repeat fixed center center / cover  rgba(0, 0, 0, 0)!important;" class="subscribe text-center">';
	}
	else{
		$out='<section style="background-color:'.esc_attr($background_color).';" class="subscribe text-center">';
	}
	
	$out.='<div class="container wow animated fadeInDown" data-wow-duration="1s" data-wow-delay="0.3s">';
	$out.='<div class="center-block align-center col-lg-5 col-md-5 col-sm-10 col-xs-10">';
	
	if(!empty($content))
	{
		$out.='<h1 style="color:'.esc_attr($primary_color).';margin-bottom:0;">'.mtheme_html($title).'</h1>';
		$out.='<hr><p style="color:'.esc_attr($primary_color).';">'.mtheme_html($content).'</p>';
	}
	else{
		$out.='<h1 style="color:'.esc_attr($primary_color).';">'.mtheme_html($title).'</h1>';
	}
	$out.='<form action="'.AJAX_URL.'" method="POST" id="'.esc_attr($unique_id).'" class="ajax-form">';	

	
	$out.='<div class="input-group col-lg-12 align-center">';
	$out.='<input type="text" class="form-control email-add" name="email" placeholder="Enter Email Address">';
	$out.='<button class="btn btn-default submit-button" style="color:'.esc_attr($secondary_color).';"><i class="fa fa-paper-plane"></i><span>'.$button_title.'</span></button>';
		
	$out.='<input type="hidden" class="action" value="'.MTHEME_PREFIX.'notify_submit" />';
	$out.='</div>';	
	$out.='<div class="message"></div>';
	$out.='</form></div></div>';
	$out.='</section>';
	 
	return $out;
}

/*sponsors*/
add_shortcode('sponsors', 'mtheme_sponsors');
function mtheme_sponsors($atts) {
	
	extract(shortcode_atts(array(
		'number' => '-1',
		'order' => 'menu_order',
		'category' => '',
		'status' => '',
		'thumbnail_width' => 160,
		'thumbnail_height' => 56,
		'slide_width' => 200,
		'slide_height' => 56
    ), $atts));
	
	if($order=='random') {
		$order='rand';
	}
		
	$args=array(
		'post_type' => 'sponsor',
		'post_status' => 'publish',
		'showposts' => $number,	
		'orderby' => $order,
		'order' => 'ASC',
		'meta_query' => array(
			array(
				'key' => '_thumbnail_id',
			),
		),
		
	);
	
	if(!empty($status)) {
		$args['meta_query'][]=array(
            'key' => 'sponsor_status',
			'value' => $status,
        );
	}
	
	$texanomy= null;	
	$haveItems=false;
	$micosec = uniqid();	
	$unique_id="sponsor_$micosec";
	
	if(!empty($category)) {
	
		$category_int=intval($category);
		if(empty($category_int))
		{			
			$texanomy = get_term_by('slug',$category,'sponsor_cat');
			if($texanomy!=null)
			{
				$args['tax_query'][]=array(
					'taxonomy' => 'sponsor_cat',
					'terms' => $category,
					'field' => 'slug',
				);
			}			
		}
		else{
			
			$texanomy = get_term_by('term_id',$category,'sponsor_cat');
			if($texanomy!=null)
			{
				$args['tax_query'][]=array(
					'taxonomy' => 'sponsor_cat',
					'terms' => $category_int,
					'field' => 'term_id',
				);
			}
		}
		
	}
	if($texanomy)
	{
		$slide_width=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spr_'.'slide_width','200');						
		$slide_height=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spr_'.'slide_height','56');
		$thumbnail_width=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spr_'.'thumbnail_width','160');						
		$thumbnail_height=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spr_'.'thumbnail_height','56');		
	}
	
	$query=new WP_Query($args);
	$out='<div class="sponsors-wrap">';	

	if($query->have_posts()){
	
		$out.='<div id="'.esc_attr($unique_id).'" style="position:relative;top:0px;left:0px;width:980px;height:'.esc_attr($slide_height).'px;overflow:hidden;margin:0 auto;">';
		$out.='<div class="inner_carousel" data-u="slides" style="cursor:move;position:absolute;left:0px;top:0px;width:980px; height:'.esc_attr($slide_height).'px;overflow: hidden;">';
			
		while($query->have_posts()){

			$query->the_post();	
			$haveItems=true;
			ob_start();

			$out.='<div>';
			$url=MthemeCore::getPostMeta(get_the_ID(),'sponsor_url');
			if(!empty($url))$out.='<a href="'.$url.'" target="_blank">';
			$out.=get_the_post_thumbnail(get_the_ID(),array($thumbnail_width,$thumbnail_height),array('class'=> "img-responsive",));
			if(!empty($url))$out.='</a>';
			$out.='</div>';


			ob_end_clean();
		}
		$out.='</div></div>';	
	
	}
	if(!$haveItems)
	{		
		$out.='<h3>No Sponsors</h3>';		
	}

	if($haveItems)
	{
		$out.='<script type="text/javascript">';
		$out.='window.globalSponsorGallery.push("'.esc_js($unique_id).'");';
		$out.='window.globalSponsorSlideWidth.push("'.esc_js($slide_width).'");';
		$out.='window.globalSponsorSlideHeight.push("'.esc_js($slide_height).'");';
		$out.='</script>';
		wp_enqueue_script('jssor.core-js', CHILD_URI.'site/js/jssor.core.js',array("jquery-js"),array(),true);
		wp_enqueue_script('jssor.utils-js', CHILD_URI.'site/js/jssor.utils.js',array("jquery-js"),array(),true);
		wp_enqueue_script('jssor.slider-js', CHILD_URI.'site/js/jssor.slider.js',array("jquery-js"),array(),true);
		wp_enqueue_script('sponsor_init-js', CHILD_URI.'site/js/sponsor_init.js',array("jquery-js"),array(),true);
	}
	$out.='</div>';
	return $out;
}

/*mtheme_sponsors*/
add_shortcode('event_sponsors', 'mtheme_sponsors_func');
function mtheme_sponsors_func($atts) {
	
	extract(shortcode_atts(array(
		'title' => '',
		'content' => '',
		'number' => '-1',
		'order' => 'menu_order',
		'category' => '',
		'status' => '',
		'thumbnail_width' => 160,
		'thumbnail_height' => 56,
		'background_image' => '',
		'background_color' => '',
		'heading_color'   => '',
		'content_color'	=> '',
    ), $atts));
		
	$texanomy=null;
	
	if(!empty($category)) {
	
		$category=intval($category);
		if(empty($category))
		{
			$texanomy = get_term_by('slug',$category,'sponsor_cat');			
		}
		else{
			$texanomy = get_term_by('term_id',$category,'sponsor_cat');			
		}
		
	}	
	if($texanomy)
	{
		if(empty($title))
		{
			$title=$texanomy->name;
		}
		if(empty($content))
		{
			$content=$texanomy->description;
		}
		if(empty($background_image))
		{
			$background_image=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spr_'.'bg_img','');
			if($background_image)
			{
				$background_image=$background_image['src'];
			}
		}
		if(empty($background_color))
		{
			$background_color=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spr_'.'bg_color',MthemeCore::getOption("background_color","#FFFFFF"));	
		}
		if(empty($heading_color))
		{
			$heading_color=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spr_'.'p_color',MthemeCore::getOption("heading_color","#363738"));
		}
		if(empty($content_color))
		{
			$content_color=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spr_'.'s_color',MthemeCore::getOption("content_color","#5f6061"));
		}						
	}
	else{
		if(empty($title))
		{
			$title='Sponsors';
		}
	}
	
	if(empty($background_color) || $background_color=='#')
	{
		$background_color="#FFFFFF";	
	}
	if(empty($heading_color) || $heading_color=='#')
	{
		$heading_color=MthemeCore::getOption("heading_color","#363738");
	}
	if(empty($content_color) || $content_color=='#')
	{
		$content_color=MthemeCore::getOption("content_color","#5f6061");	
	}
	
	$out='';
	if(!empty($background_image))
	{
		$out.='<div style="background-image:url(\''.esc_url($background_image).'\');" class="sponsors text-center section-padding">';
	}
	else{
		$out.='<div style="background-color:'.esc_attr($background_color).';" class="sponsors text-center section-padding">';
	}
	

	$out.='<div class="container">';
	if(!empty($title) || !empty($content)){
		$out.='<div class="row bottom-spacing">';
		$out.='<div class="col-md-8 align-center wow animated fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">';
		if(!empty($title)){ $out.='<h1 style="color:'.esc_attr($heading_color).'">'.mtheme_html($title).'</h1><hr>'; }
		if(!empty($content)) { $out.='<p style="color:'.esc_attr($content_color).'">'.mtheme_html($content).'</p>'; }
		$out.='</div>';
		$out.='</div>';
	}
	$out.='<div class="row">';
	$out.=mtheme_sponsors($atts);
	$out.='</div>';
	$out.='</div>';
	$out.='</div>';
	
	return $out;	
}

/*schedules*/
add_shortcode('schedules', 'mtheme_schedules');
function mtheme_schedules($atts) {
	$haveSchedules=false;
	$scheduleCount=0;
	extract(shortcode_atts(array(
		'number' => '-1',
		'order' => 'menu_order',
		'category' => '',
		'status' => '',
		'background_image' => '',
		'background_color' => '',
		'primary_color'   => '',
		'secondary_color'	=> '',
		'heading_color'   => '',
		'content_color'	=> '',
    ), $atts));
	
	if($order=='random') {
		$order='rand';
	}
		
	$args=array(
		'post_type' => 'schedule',
		'post_status' => 'publish',
		'showposts' => $number,	
		'orderby' => $order,
		'order' => 'ASC',		
	);
	
	if(!empty($status)) {
		$args['meta_query'][]=array(
            'key' => 'schedule_status',
			'value' => $status,
        );
	}
	
	$texanomy= null;	
	$micosec = uniqid();	
	$schedule_id="schedule_$micosec";
	
	if(!empty($category)) {
		
		$category_int=intval($category);
		if(empty($category_int))
		{			
			$texanomy = get_term_by('slug',$category,'schedule_cat');
			if($texanomy!=null)
			{
				$args['tax_query'][]=array(
					'taxonomy' => 'schedule_cat',
					'terms' => $category,
					'field' => 'slug',
				);
			}
		}
		else{
			$texanomy = get_term_by('term_id',$category,'schedule_cat');
			if($texanomy!=null)
			{
				$args['tax_query'][]=array(
					'taxonomy' => 'schedule_cat',
					'terms' => $category_int,
					'field' => 'term_id',
				);
			}
		}
		
	}
	
	if($texanomy)
	{
		if(empty($heading_color))
		{
			$heading_color=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'sch_'.'t_color',MthemeCore::getOption("heading_color","#363738"));
		}
		if(empty($content_color))
		{
			$content_color=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'sch_'.'a_color',MthemeCore::getOption("content_color","#5f6061"));
		}						
	}
	if(empty($heading_color) || $heading_color=='#')
	{
		$heading_color=MthemeCore::getOption("heading_color","#363738");
	}
	if(empty($content_color) || $content_color=='#')
	{
		$content_color=MthemeCore::getOption("content_color","#5f6061");	
	}
	
	$query=new WP_Query($args);
			
	$out="<div id='$schedule_id' class='tabs'>";
	$tab_out='<nav><ul>';
	$content_out='<div class="content">';
	$events['schedule']=array();
	
	while($query->have_posts()){
		
		$query->the_post();	
		$haveSchedules=true;
		$scheduleCount++;
		ob_start();
		
		$scheduleDate=MthemeCore::getPostMeta(get_the_ID(),"schedule_date");
		$tab_out.='<li><a href="#'.esc_attr($schedule_id.'_'.$scheduleCount).'"><span>'.get_the_title().'</span></a></li>';
		
		$content_out.='<section id="'.esc_attr($schedule_id.'_'.$scheduleCount).'">';
		$content_out.='<div class="container">';
		$content_out.='<div class="accordion">';
		$content_out.='<div class="day">'.mtheme_html($scheduleDate).'</div>';
			
		$events['schedule']=mtheme_filter(MthemeCore::getPostMeta(get_the_ID(), 'schedule_event'));
		foreach($events['schedule'] as $ID => $event) {
			$accordionStyle=$accordionOpen='';
			if(isset($event['active']) && $event['active']=='yes')
			{
				$accordionOpen=' open';
				$accordionStyle=' style="display: block;"';
			}
			
			$content_out.='<div class="item clearfix'.esc_attr($accordionOpen).'">';
			$content_out.='<div class="heading clearfix">';
			$content_out.='<div class="time col-md-3 col-sm-12 col-xs-12"><span style="color:'.$heading_color.'">'.mtheme_html($event['time']).'</span></div>';
			$content_out.='<div class="e-title col-md-9 col-sm-12 col-xs-12">'.mtheme_html($event['title']);
			$content_out.='<br/><span class="name">'.mtheme_html($event['speaker']);
			if(!empty($event['designation'])){
			$content_out.=' - </span><span class="speaker-designaition">'.mtheme_html($event['designation']);
			}
			$content_out.='</span>';
			$content_out.='<span class="up-down-icon"><i class="fa fa-chevron-up"></i><i class="fa fa-chevron-down"></i></span></div></div>';
			$content_out.='<div class="col-md-12 col-sm-12 col-xs-12">';
			$content_out.='<div class="content venue col-md-3 col-sm-12 col-xs-12"'.esc_attr($accordionStyle).'>';
			$content_out.='<span style="color:'.$content_color.';">'.__("Venue","mtheme").': '.mtheme_html($event['venue']).'</span></div>';
			$content_out.='<div class="content details col-md-9 col-sm-12 col-xs-12"'.esc_attr($accordionStyle).'>';
			$content_out.='<p style="color:'.$content_color.';">'.mtheme_html($event['description']).'</p></div>';
			$content_out.='</div></div>';
		}		
		
		$content_out.='</div></div></section>';		
		
		ob_end_clean();
	}
	$tab_out.='</ul></nav>';	
	$content_out.='</div>';
	$out.=$tab_out.$content_out.'</div>';
	
	if(!$haveSchedules)
	{		
		$out='<h3>No Schedule Details</h3>';		
	}
	else{
		$out.='<script type="text/javascript">';
		$out.='window.globalTabsActive = "yes";';
		$out.='window.globalTotalTabs.push("'.esc_js($scheduleCount).'");';
		$out.='window.globalcbpFWTabsId.push("'.esc_js($schedule_id).'");';
		$out.='</script>';
		$out.='<script type="text/javascript">window.globalcbpFWTabsActive ="yes";';
		$out.='window.globalcbpFWTabs.push("'.esc_js($schedule_id).'");</script>';
		wp_enqueue_script('cbpFWTabs-js', CHILD_URI.'site/js/cbpFWTabs.js',array("jquery-js"),array(),true);
	}
	
	return $out;
}

	
/*mtheme_speakers*/
add_shortcode('event_schedules', 'mtheme_schedules_func');
function mtheme_schedules_func($atts) {
	
	extract(shortcode_atts(array(
		'title' => '',
		'content' => '',
		'number' => '-1',
		'order' => 'menu_order',
		'category' => '',
		'status' => '',
		'background_image' => '',
		'background_color' => '',
		'primary_color'   => '',
		'secondary_color'	=> '',
		'heading_color'   => '',
		'content_color'	=> '',		
		'padding'	=> 'section-padding-top',		
    ), $atts));
		
	$texanomy=null;
	if(!empty($category)) {			
		
		$category=intval($category);
		if(empty($category))
		{
			$texanomy = get_term_by('slug',$category,'schedule_cat');		
		}
		else{
			$texanomy = get_term_by('term_id',$category,'schedule_cat');			
		}		
	}	
	
	if($texanomy)
	{
		if(empty($title))
		{
			$title=$texanomy->name;
		}
		if(empty($content))
		{
			$content=$texanomy->description;
		}
		if(empty($background_image))
		{
			$background_image=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'sch_'.'bg_img','');
			if($background_image)
			{
				$background_image=$background_image['src'];
			}
		}
		if(empty($background_color))
		{
			$background_color=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'sch_'.'bg_color',
			MthemeCore::getOption("background_color","#FFFFFF"));	
		}	
		if(empty($heading_color))
		{
			$heading_color=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'sch_'.'p_color',
			MthemeCore::getOption("heading_color","#FFFFFF"));
		}
		if(empty($content_color))
		{
			$content_color=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'sch_'.'s_color',
			MthemeCore::getOption("content_color","#FFFFFF"));
		}	
	}
	else{
		if(empty($title))
		{
			$title='Schedule';
		}
		if(empty($background_color))
		{
			$background_color=MthemeCore::getOption("background_color","#FFFFFF");
		}
	}
	
	if(empty($background_color) || $background_color=='#')
	{
		$background_color=MthemeCore::getOption("background_color","#FFFFFF");	
	}
	if(empty($heading_color) || $heading_color=='#')
	{
		$heading_color=MthemeCore::getOption("heading_color","#363738");
	}
	if(empty($content_color) || $content_color=='#')
	{
		$content_color=MthemeCore::getOption("content_color","#5f6061");	
	}

	$out='';
	
	if(!empty($background_image))
	{
		$out.='<section style="background:url(\''.esc_url($background_image).'\') no-repeat fixed center center / cover!important;" class="schedules text-center '.$padding.'">';
	}
	else{
		$out.='<section style="background-color:'.esc_attr($background_color).';" class="schedules text-center '.$padding.'">';
	}
	
	if(!empty($title) || !empty($content)){
		$out.='<div class="container wow animated fadeInLeft">';
			$out.='<div class="row bottom-spacing">';
				$out.='<div class="col-md-8 align-center wow animated fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">';
					if(!empty($title)){ $out.='<h1 style="color:'.esc_attr($heading_color).'">'.mtheme_html($title).'</h1><hr>'; }
					if(!empty($content)) { $out.='<p style="color:'.esc_attr($content_color).'">'.mtheme_html($content).'</p>'; }
				$out.='</div>';
			$out.='</div>';
		$out.='</div>';
	}
	
	$out.='<div class="container-schedule container wow animated fadeInDown animated" data-wow-duration="1s" data-wow-delay="1s">';
	$out.=mtheme_schedules($atts);
	$out.='</div>';
	
	$out.='</section>';
	
	return $out;	
}



/*speakers*/
add_shortcode('speakers', 'mtheme_speakers');
function mtheme_speakers($atts) {
	$haveSpeakerInGallery=false;
	extract(shortcode_atts(array(
		'number' => '-1',
		'slider' => '',
		'isautoplay' => '',
		'order' => 'menu_order',
		'category' => '',
		'status' => '',
		'thumbnail_width' => 370,
		'thumbnail_height' => 255,
		'speaker_title' => '',
		'speaker_title_position' => '',
		'speaker_designation' => '',
		'speaker_designation_position' => '',
		'detailed_popup' => '',
		'hover_background_color' => '',
		'background_color' => '',
		'heading_color' => '',
		'content_color' => ''
    ), $atts));
	
	if($order=='random') {
		$order='rand';
	}
		
	$args=array(
		'post_type' => 'speaker',
		'post_status' => 'publish',
		'showposts' => $number,	
		'orderby' => $order,
		'order' => 'ASC',
		'meta_query' => array(
			array(
				'key' => '_thumbnail_id',
			),
		),
		
	);
	
	if(!empty($status)) {
		$args['meta_query'][]=array(
            'key' => 'speaker_status',
			'value' => $status,
        );
	}
	
	$texanomy= null;
	if(!empty($category)) {
		
		$category_int=intval($category);
		if(empty($category_int))
		{			
			$texanomy = get_term_by('slug',$category,'speaker_cat');
			if($texanomy!=null)
			{
				$args['tax_query'][]=array(
					'taxonomy' => 'speaker_cat',
					'terms' => $category,
					'field' => 'slug',
				);
			}
			
		}
		else{			
			$texanomy = get_term_by('term_id',$category,'speaker_cat');
			if($texanomy!=null)
			{
				$args['tax_query'][]=array(
					'taxonomy' => 'speaker_cat',
					'terms' => $category_int,
					'field' => 'term_id',
				);
			}
		}				
	}
	if($texanomy)
	{		
		
		if(empty($slider))
		{
			$slider=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spk_'.'slider','yes');	
		}
		if(empty($isautoplay))
		{
			$isautoplay=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spk_'.'isautoplay','true');	
		}
		if(empty($speaker_title))
		{
			$speaker_title=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spk_'.'title','show');	
		}
		if(empty($speaker_title_position))
		{
			$speaker_title_position=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spk_'.'title_position','bottom');	
		}
		if(empty($speaker_designation))
		{
			$speaker_designation=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spk_'.'designation','show');	
		}
		if(empty($speaker_designation_position))
		{
			$speaker_designation_position=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spk_'.'designation_position','bottom');	
		}
		if(empty($detailed_popup))
		{
			$detailed_popup=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spk_'.'detailed_popup','yes');	
		}
		if(empty($hover_background_color))
		{
			$hover_background_color=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spk_'.'hover_background_color');	
		}
		if(empty($background_color))
		{
			$background_color=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spk_'.'bg_color');	
		}
		if(empty($heading_color))
		{
			$heading_color=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spk_'.'p_color');	
		}
		if(empty($content_color))
		{
			$content_color=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spk_'.'s_color');	
		}		
	}
	else{
		if(empty($slider))
		{
			$slider='yes';
		}
		if(empty($isautoplay))
		{
			$isautoplay='true';
		}
		if(empty($speaker_title))
		{
			$speaker_title='show';
		}
		if(empty($speaker_title_position))
		{
			$speaker_title_position='bottom';
		}
		if(empty($speaker_designation))
		{
			$speaker_designation='show';
		}
		if(empty($speaker_designation_position))
		{
			$speaker_designation_position='bottom';
		}
		if(empty($detailed_popup))
		{
			$detailed_popup='yes';
		}
	}
	if(empty($slider))
	{
		$slider='yes';
	}	
	if(empty($isautoplay))
	{
		$isautoplay='true';
	}
	if(empty($hover_background_color) || $hover_background_color=='#')
	{
		$hover_background_color=MthemeCore::getOption('secondary_color','#1bd982');	
	}
	if(empty($background_color) || $background_color=='#')
	{
		$background_color=MthemeCore::getOption('background_color','#212739');	
	}
	if(empty($heading_color) || $heading_color=='#')
	{
		$heading_color=MthemeCore::getOption('secondary_color','#1bd982');	
	}
	if(empty($content_color) || $content_color=='#')
	{
		$content_color=MthemeCore::getOption('primary_color','#ffffff');	
	}
	
	
	$query=new WP_Query($args);
	
	$totalSpeakers=$query->found_posts;
	$speakerDetails='';
	$speakersPerSlide = 3;
	$speakerNo = 0;	
	$totalEquelsSlides=intval($totalSpeakers/$speakersPerSlide)*$speakersPerSlide;
	
	$micosec = uniqid();	
	$unique_id="speaker_$micosec";	
	
	
	$out='<div id="'.esc_attr($unique_id).'"><ul class="slides"><li>';
		
	$inlineStyle='';
	if($slider=='no')
	{
		$inlineStyle=' style="padding-bottom: 30px;"';
	}
	while($query->have_posts()){
		
		if($speakerNo != 0 && $speakerNo % $speakersPerSlide == 0)
		{
			$out.='</li><li>';
		}		
		$class=' col-lg-4 col-md-4 col-sm-6 col-xs-12';

		if( $speakerNo >= $totalEquelsSlides && $totalSpeakers%$speakersPerSlide!=0 
		&& $totalSpeakers-$speakerNo < $speakersPerSlide && $speakerNo%$speakersPerSlide==0)
		{
			switch($totalSpeakers-$speakerNo)
			{
				case 2: $out.='<div class="col-lg-2 col-md-2 col-sm-0 col-xs-0"></div>';break;
				case 1: $out.='<div class="col-lg-4 col-md-4 col-sm-0 col-xs-0"></div>';break;
			}
		}
		$speakerNo++;
		
		
		$query->the_post();	
		$haveSpeakerInGallery=true;
		ob_start();
		
		$out.='<div class="wow animated fadeInUp'.esc_attr($class).'" data-wow-duration="1s" data-wow-delay="0.5s"'.$inlineStyle.'>';
		
		if(($speaker_title=='show' && $speaker_title_position=='top') || ($speaker_designation=='show' && $speaker_designation_position=='top'))
		{
			
			if($speaker_title=='show' && $speaker_title_position=='top')
			{
				$out.='<h2 style="color:'.esc_attr($heading_color).'">'.get_the_title(get_the_ID()).'</h2>';
			}
			if($speaker_designation=='show' && $speaker_designation_position=='top')
			{
				$out.='<p style="color:'.esc_attr($content_color).'" class="padding-bottom-45">'.MthemeCore::getPostMeta(get_the_ID(),"speaker_designation").'</p>';
			}
			
			
		}
		
		$out.='<div class="overlay-effect effects clearfix"><div class="img">';
		$out.=get_the_post_thumbnail(get_the_ID(),array($thumbnail_width,$thumbnail_height));
		if($detailed_popup=='yes')
		{
			$out.='<div class="overlay" style="background: none repeat scroll 0 0 '.esc_attr($hover_background_color).';">';
			$out.='<button class="md-trigger expand" data-modal="'.esc_attr($unique_id).'_speaker_'.esc_attr($speakerNo).'"><i class="fa fa-search"></i><br>'.__('View More', 'mtheme').'</button>';
			$speakerDetails.='<div>';
			$speakerDetails.='<div class="md-modal md-effect-9" id="'.esc_attr($unique_id).'_speaker_'.esc_attr($speakerNo).'">';
			$speakerDetails.='<div class="md-content">';
			$speakerDetails.='<div class="folio">';
			$speakerDetails.='<div class="avatar">'.get_the_post_thumbnail(get_the_ID(),array(103,103)).'</div>';
			$speakerDetails.='<div class="sp-name"><strong>'.get_the_title(get_the_ID()).'</strong><br/>'.MthemeCore::getPostMeta(get_the_ID(),"speaker_designation").'</div>';
			$speakerDetails.='<div class="sp-dsc">'.get_the_content(get_the_ID()).'</div>';
			if(!MthemeCore::isPostMetaEmpty(get_the_ID(),'speaker_twitter') || !MthemeCore::isPostMetaEmpty(get_the_ID(),'speaker_facebook') ||
			!MthemeCore::isPostMetaEmpty(get_the_ID(),'speaker_dribbble')) {
				$speakerDetails.='<div class="sp-social"><ul>';
				if(!MthemeCore::isPostMetaEmpty(get_the_ID(),'speaker_twitter')){
					$speakerDetails.='<li><a href="'.esc_url(MthemeCore::getPostMeta(get_the_ID(),"speaker_twitter")).'" class="social-btn social-btn social-btn-circle"><i class="fa fa-twitter"></i></a></li>';
				}
				if(!MthemeCore::isPostMetaEmpty(get_the_ID(),'speaker_facebook')){
					$speakerDetails.='<li><a href="'.esc_url(MthemeCore::getPostMeta(get_the_ID(),"speaker_facebook")).'" class="social-btn social-btn social-btn-circle"><i class="fa fa-facebook"></i></a></li>';
				}
				if(!MthemeCore::isPostMetaEmpty(get_the_ID(),'speaker_dribbble')){
					$speakerDetails.='<li><a href="'.esc_url(MthemeCore::getPostMeta(get_the_ID(),"speaker_dribbble")).'" class="social-btn social-btn social-btn-circle"><i class="fa fa-dribbble"></i></a></li>';
				}
				$speakerDetails.='</ul></div>';			
			}
			$speakerDetails.='<button class="md-close"><i class="fa fa-times"></i></button></div></div></div><div class="md-overlay"></div>';
			$speakerDetails.='</div>';
			$out.='</div>';
		}
		$out.='</div></div>';
		if(($speaker_title=='show' && $speaker_title_position=='bottom') || ($speaker_designation=='show' && $speaker_designation_position=='bottom'))
		{
			
			if($speaker_title=='show' && $speaker_title_position=='bottom')
			{
				$out.='<h2 style="color:'.esc_attr($heading_color).'">'.get_the_title(get_the_ID()).'</h2>';
			}
			if($speaker_designation=='show' && $speaker_designation_position=='bottom')
			{
				$out.='<p style="color:'.esc_attr($content_color).'" class="padding-bottom-45">'.MthemeCore::getPostMeta(get_the_ID(),"speaker_designation").'</p>';
			}
			
		}
		
		$out.='</div>';
		
		
		ob_end_clean();
	}

	$out.='</li></ul></div>';
	$out.=$speakerDetails;

	if($slider=='yes' && $haveSpeakerInGallery)
	{
		$out.='<script type="text/javascript">window.globalSpeakersSliderActive ="yes";';
		$out.='window.globalSpeakersSlider.push("#'.esc_js($unique_id).'");';
		$out.='window.globalSpeakersSliderAutoplay.push("'.esc_js($isautoplay).'");</script>';
		wp_enqueue_script('jquery.flexslider-js', CHILD_URI.'site/js/jquery.flexslider.js',array("jquery-js"),array(),true);
	}	
	
	return $out;
}


/*mtheme_speakers*/
add_shortcode('event_speakers', 'mtheme_speakers_func');
function mtheme_speakers_func($atts) {
	
	extract(shortcode_atts(array(
		'title' => '',
		'slider' => '',
		'content' => '',
		'number' => '-1',
		'order' => 'menu_order',
		'category' => '',
		'status' => '',
		'background_image' => '',
		'background_color' => '',
		'primary_color'   => '',
		'secondary_color'	=> '',
		'heading_color'   => '',
		'content_color'	=> '',
    ), $atts));
		
	$texanomy=null;
	if(!empty($category)) {			
	
		$category=intval($category);
		if(empty($category))
		{
			$texanomy = get_term_by('slug',$category,'speaker_cat');		
		}
		else{
			$texanomy = get_term_by('term_id',$category,'speaker_cat');			
		}				
	}
	
	if($texanomy)
	{
		if(empty($title))
		{
			$title=$texanomy->name;
		}
		if(empty($content))
		{
			$content=$texanomy->description;
		}
		if(empty($background_image))
		{
			$background_image=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spk_'.'bg_img','');	
			if($background_image)
			{
				$background_image=$background_image['src'];
			}
		}
		if(empty($background_color))
		{
			$background_color=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spk_'.'bg_color','#212739');	
		}
		if(empty($heading_color))
		{
			$heading_color=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spk_'.'p_color');
		}
		if(empty($content_color))
		{
			$content_color=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'spk_'.'s_color');
		}		
	}
	else{
		if(empty($title))
		{
			$title='Speakers';
		}
		if(empty($background_color))
		{
			$background_color=MthemeCore::getOption("background_color","#212739");
		}
	}
	
	if(empty($background_color) || $background_color=='#')
	{
		$background_color=MthemeCore::getOption("background_color","#212739");	
	}
	if(empty($heading_color) || $heading_color=='#')
	{
		$heading_color=MthemeCore::getOption("heading_color","#363738");
	}
	if(empty($content_color) || $content_color=='#')
	{
		$content_color=MthemeCore::getOption("content_color","#5f6061");	
	}	
	
	$out='';
	
	if(!empty($background_image))
	{
		$out.='<section style="background:url(\''.esc_url($background_image).'\') no-repeat fixed center center / cover!important;" class="speakers text-center section-padding">';
	}
	else{
		$out.='<section style="background-color:'.esc_attr($background_color).';" class="speakers text-center section-padding">';
	}
	

	$out.='	<div class="container">';
	if(!empty($title) || !empty($content)){
		$out.='<div class="row bottom-spacing">';
		$out.='<div class="col-md-8 align-center wow animated fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">';
		if(!empty($title)){ $out.='<h1 style="color:'.esc_attr($heading_color).'">'.mtheme_html($title).'</h1><hr>'; }
		if(!empty($content)) { $out.='<p style="color:'.esc_attr($content_color).'">'.mtheme_html($content).'</p>'; }
		$out.='</div>';
		$out.='</div>';
	}
	$out.='<div class="row bottom-spacing">';
	$out.=mtheme_speakers($atts);
	$out.='</div>';
	$out.='</div>';
	$out.='</section>';
	
	return $out;	
}


/*packages*/
add_shortcode('packages', 'mtheme_packages');
function mtheme_packages($atts) {
	
	extract(shortcode_atts(array(
		'number' => '-1',
		'order' => 'menu_order',
		'category' => '',
		'status' => '',
		'register_title' => '',	
		'register_link' => '',
    ), $atts));
	
	
	$pre='package_';
	
	if($order=='random') {
		$order='rand';
	}
		
	$args=array(
		'post_type' => 'package',
		'post_status' => 'publish',
		'showposts' => $number,	
		'orderby' => $order,
		'order' => 'ASC'		
	);
	
	if(!empty($status)) {
		$args['meta_query'][]=array(
            'key' => 'package_status',
			'value' => $status,
        );
	}
	
	$texanomy= null;	
	$haveItems=false;
	$micosec = uniqid();	
	$uniqid_id="package_$micosec";
	
	if(!empty($category)) {		
	
		$category_int=intval($category);
		if(empty($category_int))
		{
			
			$texanomy = get_term_by('slug',$category,'package_cat');
			if($texanomy!=null)
			{
				$args['tax_query'][]=array(
					'taxonomy' => 'package_cat',
					'terms' => $category,
					'field' => 'slug',
				);
			}
		}
		else{
			
			$texanomy = get_term_by('term_id',$category,'package_cat');
			if($texanomy!=null)
			{
				$args['tax_query'][]=array(
					'taxonomy' => 'package_cat',
					'terms' => $category_int,
					'field' => 'term_id',
				);
			}
		}
	} 
	$query=new WP_Query($args);
	
		
	$totalPackages=$query->found_posts;
	$packagesPerSlide = 4;
	$packageNo = 0;
	$totalEquelsPackages=intval($totalPackages/$packagesPerSlide)*$packagesPerSlide;
	
	$out='<div class="packages-wrap '.esc_attr($totalPackages).'"><ul class="slides">';
			
	while($query->have_posts()){
		
		if($packageNo!=0 && ($packageNo%$packagesPerSlide==0))
		{
			$out.='</ul><ul class="slides">';			
		}
		
		$query->the_post();	
		$haveItems=true;
		ob_start();		
		
		if( $packageNo >= $totalEquelsPackages && $totalPackages%$packagesPerSlide!=0
		&& $totalPackages-$packageNo < $packagesPerSlide && $packageNo%$packagesPerSlide==0)
		{
			switch($totalPackages-$packageNo)
			{
				case 3: $out.='<li class="col-lg-1_5 col-sm-0 col-xs-0"></li>';break;
				case 2: $out.='<li class="col-lg-3 col-md-3 col-sm-0 col-xs-0"></li>';break;
				case 1: $out.='<li class="col-lg-4_5 col-sm-0 col-xs-0"></li>';break;
			}
		}
		$packageNo++;
		
		$register_link=MthemeCore::getPostMeta(get_the_ID(), $pre.'register_link',"#register_me");
		$register_title=MthemeCore::getPostMeta(get_the_ID(), $pre.'register_title',"Register");
		
		$register_link_inner=substr($register_link, 0, 1);
		if($register_link_inner=='#')
		{
			$register_link=' data-scroll href="'.esc_url($register_link).'"';
		}
		else
		{
			$register_link=' href="'.esc_url($register_link).'"';
		}
	
		$price=MthemeCore::getPostMeta(get_the_ID(),$pre."price",'$100');
		$primary_heading_background_color=MthemeCore::getPostMeta(get_the_ID(),$pre."primary_heading_background_color",MthemeCore::getOption("background_color","#212739"));
		$secondary_heading_background_color=MthemeCore::getPostMeta(get_the_ID(),$pre."secondary_heading_background_color",MthemeCore::getOption("background_color","#212739"));
		$heading_color=MthemeCore::getPostMeta(get_the_ID(),$pre."heading_color",MthemeCore::getOption("heading_color","#ffffff"));
		$content_background_color=MthemeCore::getPostMeta(get_the_ID(),$pre."content_background_color",MthemeCore::getOption("background_color","#212739"));
		$content_color=MthemeCore::getPostMeta(get_the_ID(),$pre."content_color",MthemeCore::getOption("content_color","#212639"));
		$button_background_color=MthemeCore::getPostMeta(get_the_ID(),$pre."button_background_color",MthemeCore::getOption("background_color","#212739"));
		$button_heading_color=MthemeCore::getPostMeta(get_the_ID(),$pre."button_heading_color",MthemeCore::getOption("heading_color","#ffffff"));
		
		$out.='<li>';
		$out.='<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 wow animated fadeInRight" data-wow-duration="1s" data-wow-delay="0.7s">';
		$out.='<ul class="planContainer pack-'.$packageNo.'" style="background-color:'.esc_attr($content_background_color).'">';
		$out.='<li class="title">';
		$out.='<h2 style="background-color:'.esc_attr($primary_heading_background_color).';color:'.esc_attr($heading_color).';">';
		$out.=$price.'</h2></li>';
		$out.='<li class="price"><p style="background-color:'.esc_attr($secondary_heading_background_color).';color:'.esc_attr($heading_color).';">'.get_the_title().'</p></li>';
		$out.='<li style="color:'.esc_attr($content_color).'">'.get_the_content().'</li>';
		$out.='<li class="buybutton">';
		$out.='<a class="btn-effect register-botton" style="background-color:'.esc_attr($button_background_color).';color:'.esc_attr($button_heading_color).';"'.mtheme_html_content($register_link).'>'.mtheme_html($register_title).'</a></li>';
		$out.='</ul></div>';		
		$out.='</li>';		
		
		ob_end_clean();
	}
	
	
	if(!$haveItems)
	{		
		$out='<h3>No Packages</h3>';		
	}
	
	$out.='</ul></div>';
	
	return $out;
}

/*mtheme_packages*/
add_shortcode('event_packages', 'mtheme_packages_func');
function mtheme_packages_func($atts) {
	
	extract(shortcode_atts(array(
		'title' => '',
		'content' => '',
		'number' => '-1',
		'order' => 'menu_order',
		'category' => '',
		'status' => '',
		'background_image' => '',
		'background_color' => '',
		'heading_color'   => '',
		'content_color'	=> '',
    ), $atts));
		
	$texanomy=null;
	if(!empty($category)) {	
	
		$category=intval($category);
		if(empty($category))
		{
			$texanomy = get_term_by('slug',$category,'package_cat');
		}
		else{
			$texanomy = get_term_by('term_id',$category,'package_cat');		
		}
	}	
	
	if($texanomy)
	{
		if(empty($title))
		{
			$title=$texanomy->name;
		}
		if(empty($content))
		{
			$content=$texanomy->description;
		}
		if(empty($background_image))
		{
			$background_image=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'pck_'.'bg_img','');
			if($background_image)
			{
				$background_image=$background_image['src'];
			}
		}
		if(empty($background_color))
		{
			$background_color=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'pck_'.'bg_color','#FFFFFF');	
		}
		if(empty($heading_color))
		{
			$heading_color=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'pck_'.'p_color','#363738');
		}
		if(empty($content_color))
		{
			$content_color=get_tax_meta($texanomy->term_id,MTHEME_PREFIX.'pck_'.'s_color','#5f6061');
		}						
	}
	else{
		if(empty($title))
		{
			$title='Packages';
		}
		if(empty($background_color))
		{
			$background_color=MthemeCore::getOption("primary_color","#FFFFFF");
		}
		
	}
	
	if(empty($background_color) || $background_color=='#')
	{
		$background_color="#FFFFFF";	
	}
	if(empty($heading_color) || $heading_color=='#')
	{
		$heading_color=MthemeCore::getOption("heading_color","#363738");
	}
	if(empty($content_color) || $content_color=='#')
	{
		$content_color=MthemeCore::getOption("content_color","#5f6061");	
	}
	
	$out='';
	if(!empty($background_image))
	{
		$out.='<section style="background:url(\''.esc_url($background_image).'\') no-repeat fixed center center / cover!important;" class="packages text-center section-padding">';
	}
	else{
		$out.='<section style="background-color:'.esc_attr($background_color).';" class="packages text-center section-padding">';
	}
	

	$out.='	<div class="container">';
	if(!empty($title) || !empty($content)){
		$out.='<div class="row bottom-spacing">';
		$out.='<div class="col-md-8 align-center wow animated fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">';
		if(!empty($title)){ $out.='<h1 style="color:'.esc_attr($heading_color).'">'.mtheme_html($title).'</h1><hr>'; }
		if(!empty($content)) { $out.='<p style="color:'.esc_attr($content_color).'">'.mtheme_html($content).'</p>'; }
		$out.='</div>';
		$out.='</div>';
	}
	$out.='<div class="row">';
	$out.=mtheme_packages($atts);
	$out.='</div>';
	$out.='</div>';
	$out.='</section>';
	
	return $out;	
}

/*mtheme_contact*/
add_shortcode('footer_contact','mtheme_contact');
function mtheme_contact($atts, $content=null) {	
	
	extract(shortcode_atts(array(
		'contact_title'     => '',
		'contact_desc'     => '',
		'address_heading'     => '',
		'contact_add'     => '',
		'phone_heading'     => '',		
		'contact_phone'     => '',
		'email_heading'     => '',	
		'contact_email'     => '',
		'gmap_heading'     => '',	
		'contact_gmap'     => '',
		'social_show'     => '',
		'social_background'     => '',
		'contact_dribble'     => '',
		'contact_twitter'     => '',
		'contact_fb'     => '',
		'contact_skype'     => '',
		'contact_soundcloud'     => '',
		'contact_instagram' => '',
		'contact_google' => '',
		'contact_linked' => '',
		'contact_whatsapp' => '',
		'contact_pinterest' => '',
		'contact_flick' => '',
		'contact_behance' => '',
		'contact_rss' => '',
		'contact_btc' => '',
		'contact_mail' => '',
		'background_image' => '',
		'image_url_zoom' => '',
		'background_color' => '',
		'primary_color'   => '',
		'secondary_color'	=> '',
		'heading_color'   => '',
		'content_color'	=> '',
    ), $atts));
	
	
	$out='';
	
	$social_show=(MthemeCore::getOption("social_active","true")=='true');
	if(empty($background_image))
	{
		$background_image=MthemeCore::getOption("contact_bg_img","");
	}
	if(empty($background_color))
	{
		$background_color=MthemeCore::getOption("contact_bg_color","#212739");
	}
	if(empty($primary_color))
	{
		$primary_color=MthemeCore::getOption("contact_p_color","#FFFFFF");
	}
	if(empty($secondary_color))
	{
		$secondary_color=MthemeCore::getOption("contact_s_color","#1bce7c");
	}
		
	if(empty($contact_title))
	{
		$contact_title=MthemeCore::getOption("contact_title",'');
	}
	if(empty($contact_desc))
	{
		$contact_desc=MthemeCore::getOption("contact_desc",'');
	}
	if(empty($address_heading))
	{
		$address_heading=MthemeCore::getOption("contact_address_heading",'Address');
	}
	if(empty($contact_add))
	{
		$contact_add=MthemeCore::getOption("contact_add",'');
	}
	if(empty($phone_heading))
	{
		$phone_heading=MthemeCore::getOption("contact_phone_heading",'Phone');
	}
	if(empty($contact_phone))
	{
		$contact_phone=MthemeCore::getOption("contact_phone",'');
	}	
	if(empty($email_heading))
	{
		$email_heading=MthemeCore::getOption("contact_email_heading",'Email');
	}
	if(empty($contact_email))
	{
		$contact_email=MthemeCore::getOption("contact_email",'');
	}
	if(empty($gmap_heading))
	{
		$gmap_heading=MthemeCore::getOption("contact_gmap_heading",'Get Directions');
	}
	if(empty($contact_gmap))
	{
		$contact_gmap=MthemeCore::getOption("contact_gmap",'');
	}
	if(empty($social_background))
	{
		$social_background=MthemeCore::getOption("social_background",'circle');
	}
	if(empty($contact_dribble))
	{
		$contact_dribble=MthemeCore::getOption("contact_dribble",'');
	}
	if(empty($contact_twitter))
	{
		$contact_twitter=MthemeCore::getOption("contact_twitter",'');
	}
	if(empty($contact_fb))
	{
		$contact_fb=MthemeCore::getOption("contact_fb",'');
	}
	if(empty($contact_skype))
	{
		$contact_skype=MthemeCore::getOption("contact_skype",'');
	}	
	if(empty($contact_soundcloud))
	{
		$contact_soundcloud=MthemeCore::getOption("contact_soundcloud",'');
	}
	if(empty($contact_tube))
	{
		$contact_tube=MthemeCore::getOption("contact_tube",'');
	}
	if(empty($contact_instagram))
	{
		$contact_instagram=MthemeCore::getOption("contact_instagram",'');
	}
	if(empty($contact_google))
	{
		$contact_google=MthemeCore::getOption("contact_google",'');
	}
	if(empty($contact_linked))
	{
		$contact_linked=MthemeCore::getOption("contact_linked",'');
	}
	if(empty($contact_whatsapp))
	{
		$contact_whatsapp=MthemeCore::getOption("contact_whatsapp",'');
	}
	if(empty($contact_pinterest))
	{
		$contact_pinterest=MthemeCore::getOption("contact_pinterest",'');
	}
	if(empty($contact_flickr))
	{
		$contact_flickr=MthemeCore::getOption("contact_flickr",'');
	}
	if(empty($contact_behance))
	{
		$contact_behance=MthemeCore::getOption("contact_behance",'');
	}
	if(empty($contact_rss))
	{
		$contact_rss=MthemeCore::getOption("contact_rss",'');
	}
	if(empty($contact_btc))
	{
		$contact_btc=MthemeCore::getOption("contact_btc",'');
	}
	if(empty($contact_mail))
	{
		$contact_mail=MthemeCore::getOption("contact_mail",'');
	}
	if(empty($heading_color))
	{
		$heading_color=MthemeCore::getOption("contact_p_color","#363738");
	}
	if(empty($content_color))
	{
		$content_color=MthemeCore::getOption("contact_s_color","#5f6061");
	}
	
	if(!empty($contact_title) || !empty($contact_desc) || !empty($contact_add) || !empty($contact_phone) || !empty($contact_email) || !empty($contact_gmap) || !empty($contact_dribble) || !empty($contact_twitter) || !empty($contact_fb) || !empty($contact_skype) || !empty($contact_soundcloud) || !empty($contact_instagram) || !empty($contact_google) || !empty($contact_whatsapp) || !empty($contact_linked) || !empty($contact_tube) || !empty($contact_pinterest) || !empty($contact_behance) || !empty($social_background) || !empty($contact_rss) || !empty($contact_btc) || !empty($contact_mail)){
	
		$micosec = uniqid();	
		$unique_id="contact_$micosec";
		
		if(!empty($background_image))
		{
			$out.='<section id="'.esc_attr($unique_id).'" style="background-image:url(\''.esc_url($background_image).'\');" class="text-center section-padding contact-wrap">';
		}
		else{
			$out.='<section id="'.esc_attr($unique_id).'" style="background-color:'.esc_attr($background_color).';" class="text-center section-padding contact-wrap">';
		}	
		
		$isContactDetails=false;
		$out.='<div class="container">';
		if(!empty($contact_title) || !empty($contact_desc)){
			$out.='<div class="row">';
				$out.='<div class="col-md-8 wow animated fadeInLeft align-center" data-wow-duration="1s" data-wow-delay="0.3s">';
					$out.='<h1 style="color:'.esc_attr($heading_color).'">'.mtheme_html($contact_title).'</h1><hr>';
					$out.='<p style="color:'.esc_attr($content_color).'">'.mtheme_html($contact_desc).'</p>';
				$out.='</div>';
			$out.='</div>';
		} if(!empty($contact_add) || !empty($contact_phone) || !empty($contact_email)){ 
			$contactDC=0;
			$isContactDetails=true;
			$class=" col-md-4";		
			if(!empty($contact_add)) $contactDC++;
			if(!empty($contact_phone)) $contactDC++;
			if(!empty($contact_email)) $contactDC++;
			switch($contactDC)
			{
				case 1:$class=" col-md-4 align-center";break;
				case 2:$class=" col-md-6";break;
			}
			
			$out.='<div class="row contact-details">';
			if(!empty($contact_add)){
				$out.='<div class="wow animated fadeInDown'.esc_attr($class).'" data-wow-duration="1s" data-wow-delay="0.5s">';
					$out.='<div class="light-box box-hover">';
						$out.='<h2><span>'.esc_attr($address_heading).'</span></h2>';
						$out.='<p style="color:'.esc_attr($content_color).'">'.mtheme_html($contact_add).'</p>';
					$out.='</div>';
				$out.='</div>';
			} if(!empty($contact_phone)){
				$out.='<div class="wow animated fadeInDown'.esc_attr($class).'" data-wow-duration="1s" data-wow-delay="0.7s">';
					$out.='<div class="light-box box-hover">';
						$out.='<h2><span>'.esc_attr($phone_heading).'</span></h2>';
						$out.='<p style="color:'.esc_attr($content_color).'">'.mtheme_html($contact_phone).'</p>';
					$out.='</div>';
				$out.='</div>';
			} if(!empty($contact_email)){
				$out.='<div class="wow animated fadeInDown'.esc_attr($class).'" data-wow-duration="1s" data-wow-delay="0.9s">';
					$out.='<div class="light-box box-hover">';
						$out.='<h2><span>'.esc_attr($email_heading).'</span></h2>';
						$out.='<p style="color:'.esc_attr($content_color).'">'.mtheme_html($contact_email).'</p>';
					$out.='</div>';
				$out.='</div>';
			}
			$out.='</div>';
		} if(!empty($contact_gmap)){
			if($isContactDetails) $out.='<div class="row">';
			else $out.='<div class="row section-padding-top">';
			$out.='<a class="learn-more-btn btn-effect get_directions" href="'.esc_url($contact_gmap).'" target="_blank"><i class="fa fa-map-marker"></i><span>'.esc_attr($gmap_heading).'</span></a>';
			$out.='</div>';
		}
		if($social_show=='true' && (!empty($contact_dribble) || !empty($contact_twitter) || !empty($contact_fb) || !empty($contact_skype) || !empty($contact_soundcloud) || !empty($contact_instagram) || !empty($contact_google) || !empty($contact_whatsapp) || !empty($contact_linked) || !empty($contact_tube) || !empty($contact_pinterest) || !empty($contact_behance) || !empty($social_background) || !empty($contact_rss) || !empty($contact_btc) || !empty($contact_mail))){
			$out.='<div class="row">';
				$out.='<div class="col-md-12">';
					$out.='<ul class="social-buttons">';
					if(!empty($contact_dribble)){
					$out.='<li><a href="'.esc_url($contact_dribble).'" class=" social-btn social-btn-'.esc_attr($social_background).'" target="_blank"><i class="fa fa-dribbble"></i></a></li>';
					} if(!empty($contact_twitter)){
					$out.='<li><a href="'.esc_url($contact_twitter).'" class="social-btn social-btn-'.esc_attr($social_background).'" target="_blank"><i class="fa fa-twitter"></i></a></li>';
					} if(!empty($contact_fb)){
					$out.='<li><a href="'.esc_url($contact_fb).'" class="social-btn social-btn-'.esc_attr($social_background).'" target="_blank"><i class="fa fa-facebook"></i></a></li>';
					} if(!empty($contact_skype)){
					$out.='<li><a href="'.esc_url($contact_skype).'" class="social-btn social-btn-'.esc_attr($social_background).'" target="_blank"><i class="fa fa-skype"></i></a></li>';
					}if(!empty($contact_soundcloud)){
					$out.='<li><a href="'.esc_url($contact_soundcloud).'" class="social-btn social-btn-'.esc_attr($social_background).'" target="_blank"><i class="fa fa-soundcloud"></i></a></li>';
					}					
					if(!empty($contact_tube)){
					$out.='<li><a href="'.esc_url($contact_tube).'" class="social-btn social-btn-'.esc_attr($social_background).'" target="_blank"><i class="fa fa-youtube"></i></a></li>';
					}
					if(!empty($contact_instagram)){
					$out.='<li><a href="'.esc_url($contact_instagram).'" class="social-btn social-btn-'.esc_attr($social_background).'" target="_blank"><i class="fa fa-instagram"></i></a></li>';
					}
					if(!empty($contact_google)){
					$out.='<li><a href="'.esc_url($contact_google).'" class="social-btn social-btn-'.esc_attr($social_background).'" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
					}
					if(!empty($contact_linked)){
					$out.='<li><a href="'.esc_url($contact_linked).'" class="social-btn social-btn-'.esc_attr($social_background).'" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
					}
					if(!empty($contact_whatsapp)){
					$out.='<li><a href="'.esc_url($contact_whatsapp).'" class="social-btn social-btn-'.esc_attr($social_background).'" target="_blank"><i class="fa fa-whatsapp"></i></a></li>';
					}
					if(!empty($contact_pinterest)){
					$out.='<li><a href="'.esc_url($contact_pinterest).'" class="social-btn social-btn-'.esc_attr($social_background).'" target="_blank"><i class="fa fa-pinterest"></i></a></li>';
					}
					if(!empty($contact_flickr)){
					$out.='<li><a href="'.esc_url($contact_flickr).'" class="social-btn social-btn-'.esc_attr($social_background).'" target="_blank"><i class="fa fa-flickr"></i></a></li>';
					}
					if(!empty($contact_behance)){
					$out.='<li><a href="'.esc_url($contact_behance).'" class="social-btn social-btn-'.esc_attr($social_background).'" target="_blank"><i class="fa fa-behance"></i></a></li>';
					}
					if(!empty($contact_rss)){
					$out.='<li><a href="'.esc_url($contact_rss).'" class="social-btn social-btn-'.esc_attr($social_background).'" target="_blank"><i class="fa fa-rss"></i></a></li>';
					}
					if(!empty($contact_btc)){
					$out.='<li><a href="'.esc_url($contact_btc).'" class="social-btn social-btn-'.esc_attr($social_background).'" target="_blank"><i class="fa fa-btc"></i></a></li>';
					}
					if(!empty($contact_mail)){
					$out.='<li><a href="mailto:'.esc_attr($contact_mail).'" class="social-btn social-btn-'.esc_attr($social_background).'" target="_blank"><i class="fa fa-envelope-o"></i></a></li>';
					}
					$out.='</ul>';
				$out.='</div>';
			$out.='</div>';
		}
		$out.='</div></section>';
	}
	
	return $out;
}

/*hero_background*/
add_shortcode('hero_background','hero_background');
function hero_background($atts, $content=null) {	
	
	extract(shortcode_atts(array(
		'slider_id'=>'',
		'logo_position'     => '',
		'height_type'	=> '',
		'height' => '',
		'alignment' => '',		
		'type'     => '',
		'header_transparent'     => '',
		'html5_video_audio'     => '',
		'youtube_video_audio'     => '',
		'vimeo_video_audio'     => '',
		'youtube_sound_icon'     => '',
		'vimeo_sound_icon'     => '',
		'html5_sound_icon'     => '',
		'slider_effect'     => '',
		'coming_soon'     => '',
		'videoUrl'     => '',
		'youtubeID'     => '',		 
		'vimeoId'     => '',
		'background_image'	=> '',				
		'icon_padding_top' => '',
		'slider_icon_option' => '',
		'icon_title' => '',
		'icon_bg_option' => '',
		'icon_bg_color' => '',
		'icon_font_color' => '',
		'slider_heading_option' => '',
		'heading_font_style' => '',
		'heading_font_type' => '',
		'heading_text_transform' => '',
		'heading_font_color' => '',
		'hr_option' => '',
		'hr_color' => '',
		'hr_border_width' => '',		
		'slider_title' => '',		
		'slider_content_option' => '',
		'content_padding_top' => '',
		'content_font_color' => '',
		'content_text_transform' => '',	
		'content_font_style' => '',	
		'slider_content'   => '',
		'first_button_option' => '',
		'button_padding_top' => '',
		'first_button_transpermt_option' => '',	
		'first_button_hover_transpermt_option' => '',
		'button_size' => '',
		'button_text_transform' => '',
		'button_color' => '',
		'button_font_color' => '',
		'button_border_radius' => '',
		'button_border' => '',
		'register_title'=>'',
		'register_link'=>'',
		'button_border_type' => '',
		'second_button_padding_top' => '',
		'second_button_border_type' => '',
		'button_border_color' => '',
		'second_button_border_color' => '',
		'button_hover_bg_color' => '',
		'button_hover_font_color' => '',
		'second_button_transpermt_option' => '',
		'second_button_option' => '',
		'second_button_size' => '',
		'second_button_border' => '',
		'second_button_text_transform' => '',
		'second_button_color' => '',
		'second_button_font_color' => '',
		'second_button_border_radius' => '',
		'second_button_hover_bg_color' => '',
		'second_button_hover_font_color' => '',
		'second_button_hover_transpermt_option' => '',
		'notify_form_padding_top' => '',	
		'notify_form_option' => '',
		'notify_form_column' => '',
		'notify_form_heading' => '',
		'notify_font_color' => '',
		'notify_style' => '',
		'notify_button_background_color' => '',
		'notify_button_heading' => '',
		'slider_date_padding_top' => '',
		'event_date_font_color' => '',
		'date_background_transparent' => '',
		'event_date_background_color' => '',
		'event_date_border_radius' => '',
		'event_date_border' => '',
		'event_date_border_color' => '',
		'event_date_border_type' => '',
		'event_date_text_color' => '',
		'event_date_text_transform' => '',
	), $atts));
	
	
	$theme_background_color=MthemeCore::getOption('background_color','#212739');
	$theme_primary_color=MthemeCore::getOption('primary_color','#FFFFFF');
	$theme_secondary_color=MthemeCore::getOption('secondary_color','#0c59d8');
	$theme_tertiary_color=MthemeCore::getOption('tertiary_color','#1bd982');
	$theme_heading_color=MthemeCore::getOption('heading_color','#363636');
	$theme_content_color=MthemeCore::getOption('content_color','#8b8b8b');
	
	$out='';
	$pre='event_slider_';
	
	if(empty($alignment))
	{
		$alignment=MthemeCore::getPostMeta($slider_id,$pre."alignment","align-center");
	}
	if(empty($landing_text_padding_top))
	{
		$landing_text_padding_top=MthemeCore::getPostMeta($slider_id,$pre."landing_text_padding_top","25");
	}
	/*slider_icon*/
	if(empty($slider_icon_option))
	{
		$slider_icon_option=MthemeCore::getPostMeta($slider_id,$pre."slider_icon_option","fasle");
	}
	if(empty($icon_padding_top))
	{
		$icon_padding_top=MthemeCore::getPostMeta($slider_id,$pre."icon_padding_top","15");
	} 
	if(empty($icon_title))
	{
		$icon_title=MthemeCore::getPostMeta($slider_id,$pre."icon_title","dashicons|dashicons-format-quote");
	}
	if(empty($icon_bg_option))
	{
		$icon_bg_option=MthemeCore::getPostMeta($slider_id,$pre."icon_bg_option","icon-bg-circle");
	}
	if(empty($icon_bg_color))
	{
		$icon_bg_color=MthemeCore::getPostMeta($slider_id,$pre."icon_bg_color","");
	}
	if(empty($icon_font_color))
	{
		$icon_font_color=MthemeCore::getPostMeta($slider_id,$pre."icon_font_color",$theme_primary_color);
	}
	/*slider_icon*/
	/*slider_hr*/
	if(empty($hr_option))
	{
		$hr_option=MthemeCore::getPostMeta($slider_id,$pre."hr_option","true");
	} 
	if(empty($hr_color)) 
	{
		$hr_color=MthemeCore::getPostMeta($slider_id,$pre."hr_color",$theme_secondary_color);
	}
	if(empty($hr_border_width))
	{
		$hr_border_width=MthemeCore::getPostMeta($slider_id,$pre."hr_border_width","1");
	} 
	if(empty($hr_width))
	{
		$hr_width=MthemeCore::getPostMeta($slider_id,$pre."hr_width","3");
	}
	if(empty($hr_border_type))
	{
		$hr_border_type=MthemeCore::getPostMeta($slider_id,$pre."hr_border_type","solid");
	}
	/*slider_hr*/
	/*slider_heading*/	
	if(empty($heading_padding_top))
	{
		$heading_padding_top=MthemeCore::getPostMeta($slider_id,$pre."heading_padding_top","15");
	}
	if(empty($slider_heading_option))
	{
		$slider_heading_option=MthemeCore::getPostMeta($slider_id,$pre."slider_heading_option","true");
	}
	if(empty($heading_font_style))
	{
		$heading_font_style=MthemeCore::getPostMeta($slider_id,$pre."heading_font_style","h1");
	}
	if(empty($heading_font_type))
	{
		$heading_font_type=MthemeCore::getPostMeta($slider_id,$pre."heading_font_type","normal");
	}
	if(empty($slider_title))
	{
		$slider_title=MthemeCore::getPostMeta($slider_id,$pre."title",'Welcome To Multia');
	}
	if(empty($content_font_type))
	{
		$content_font_type=MthemeCore::getPostMeta($slider_id,$pre."content_font_type","normal");
	}
	if(empty($heading_font_color))
	{
		$heading_font_color=MthemeCore::getPostMeta($slider_id,$pre."heading_font_color",$theme_primary_color);
	}
	if(empty($heading_text_transform))
	{
		$heading_text_transform=MthemeCore::getPostMeta($slider_id,$pre."heading_text_transform",'uppercase');
	}	
	/*slider_heading*/
	/*slider_content*/	
	if(empty($slider_content_option))
	{
		$slider_content_option=MthemeCore::getPostMeta($slider_id,$pre."slider_content_option","true");
	}
	if(empty($content_padding_top))
	{
		$content_padding_top=MthemeCore::getPostMeta($slider_id,$pre."content_padding_top","15");
	} 
	if(empty($slider_content))
	{
		$slider_content=MthemeCore::getPostMeta($slider_id,$pre."content",'We Design for Tomorrow');
	}	
	if(empty($content_font_color))
	{
		$content_font_color=MthemeCore::getPostMeta($slider_id,$pre."content_font_color",$theme_primary_color);
	}
	if(empty($content_font_style))
	{
		$content_font_style=MthemeCore::getPostMeta($slider_id,$pre."content_font_style","h3");
	}
	if(empty($content_text_transform))
	{
		$content_text_transform=MthemeCore::getPostMeta($slider_id,$pre."content_text_transform","uppercase");
	}	
	/*slider_content*/	
	/*coming_soon*/
	if(empty($slider_date_padding_top))
	{
		$slider_date_padding_top=MthemeCore::getPostMeta($slider_id,$pre."slider_date_padding_top","15");
	}
	if(empty($coming_soon))
	{
		$coming_soon=MthemeCore::getPostMeta($slider_id,$pre."coming_soon","false");
	}	
	if($coming_soon=='true')
	{
		$lD=MthemeCore::getPostMeta($slider_id,$pre."date","2015/12/21 12:00");
		$out.='<script type="text/javascript">';
		$out.='window.globalDateVar = "'.esc_js($lD).'";';
		$out.='</script>';
	}
	if(empty($event_date_font_color))
	{
		$event_date_font_color=MthemeCore::getPostMeta($slider_id,$pre."event_date_font_color",$theme_primary_color);
	}
	if(empty($date_background_transparent))
	{
		$date_background_transparent=MthemeCore::getPostMeta($slider_id,$pre."date_background_transparent","true");
	}	
	if(empty($event_date_background_color))
	{
		$event_date_background_color=MthemeCore::getPostMeta($slider_id,$pre."event_date_background_color",$theme_background_color);
	}
	if(empty($event_date_border_radius))
	{
		$event_date_border_radius=MthemeCore::getPostMeta($slider_id,$pre."event_date_border_radius","simple");
	}
	if(empty($event_date_border))
	{
		$event_date_border=MthemeCore::getPostMeta($slider_id,$pre."event_date_border","none");
	}
	if(empty($event_date_border_color))
	{
		$event_date_border_color=MthemeCore::getPostMeta($slider_id,$pre."event_date_border_color","#FF1751");
	}
	if(empty($event_date_border_type))
	{
		$event_date_border_type=MthemeCore::getPostMeta($slider_id,$pre."event_date_border_type", "solid");
	}
	if(empty($event_date_text_transform))
	{
		$event_date_text_transform=MthemeCore::getPostMeta($slider_id,$pre."event_date_text_transform", "capitalize");
	}
	if(empty($event_date_text_color))
	{
		$event_date_text_color=MthemeCore::getPostMeta($slider_id,$pre."event_date_text_color", $theme_primary_color);
	}
	/*coming_soon*/
	/*notify_me*/
	if(empty($notify_form_padding_top))  
	{
		$notify_form_padding_top=MthemeCore::getPostMeta($slider_id,$pre."notify_form_padding_top","15");
	}
	if(empty($notify_form_option))
	{
		$notify_form_option=MthemeCore::getPostMeta($slider_id,$pre."notify_form_option","false");
	}
	if(empty($notify_form_column))
	{
		$notify_form_column=MthemeCore::getPostMeta($slider_id,$pre."notify_form_column","6");
	}
	if(empty($notify_form_heading))
	{
		$notify_form_heading=MthemeCore::getPostMeta($slider_id,$pre."notify_form_heading","");
	}
	if(empty($notify_style))
	{
		$notify_style=MthemeCore::getPostMeta($slider_id,$pre."notify_style","style2");
	}
	if(empty($notify_font_color))
	{
		$notify_font_color=MthemeCore::getPostMeta($slider_id,$pre."notify_font_color",$theme_primary_color);
	}
	if(empty($notify_button_background_color))
	{
		$notify_button_background_color=MthemeCore::getPostMeta($slider_id,$pre."notify_button_background_color",$theme_background_color);
	}
	if(empty($notify_button_heading))
	{
		$notify_button_heading=MthemeCore::getPostMeta($slider_id,$pre."notify_button_heading","Subscribe");
	}
	/*notify_me*/
	/*first_button_option*/
	if(empty($button_padding_top))
	{
		$button_padding_top=MthemeCore::getPostMeta($slider_id,$pre."button_padding_top","30");
	}
	if(empty($first_button_option))
	{
		$first_button_option=MthemeCore::getPostMeta($slider_id,$pre."first_button_option","true");
	}	
	if(empty($button_size))
	{
		$button_size=MthemeCore::getPostMeta($slider_id,$pre."button_size","large");
	}
	if(empty($button_text_transform))
	{
		$button_text_transform=MthemeCore::getPostMeta($slider_id,$pre."button_text_transform","Capitalize");
	}
	if(empty($button_color))
	{
		$button_color=MthemeCore::getPostMeta($slider_id,$pre."button_color",$theme_background_color);
	}
	if(empty($button_font_color))
	{
		$button_font_color=MthemeCore::getPostMeta($slider_id,$pre."button_font_color",$theme_primary_color);
	}
	if(empty($button_border_radius))
	{
		$button_border_radius=MthemeCore::getPostMeta($slider_id,$pre."button_border_radius","none");
	}
	if(empty($button_border))
	{
		$button_border=MthemeCore::getPostMeta($slider_id,$pre."button_border","none");
	}
	if(empty($button_border_type))
	{
		$button_border_type=MthemeCore::getPostMeta($slider_id,$pre."button_border_type","solid");
	}
	if(empty($button_border_color))
	{
		$button_border_color=MthemeCore::getPostMeta($slider_id,$pre."button_border_color",$theme_tertiary_color);
	}
	if(empty($button_hover_border_color))
	{
		$button_hover_border_color=MthemeCore::getPostMeta($slider_id,$pre."button_hover_border_color",$theme_tertiary_color);
	}
	if(empty($button_hover_bg_color))
	{
		$button_hover_bg_color=MthemeCore::getPostMeta($slider_id,$pre."button_hover_bg_color",$theme_secondary_color);
	}
	if(empty($button_hover_font_color))
	{
		$button_hover_font_color=MthemeCore::getPostMeta($slider_id,$pre."button_hover_font_color",$theme_primary_color);
	}
	if(empty($first_button_transpermt_option))
	{
		$first_button_transpermt_option=MthemeCore::getPostMeta($slider_id,$pre."first_button_transpermt_option","false");
	}	
	if(empty($first_button_hover_transpermt_option))
	{
		$first_button_hover_transpermt_option=MthemeCore::getPostMeta($slider_id,$pre."first_button_hover_transpermt_option","true");
	}
	if(empty($register_title))
	{
		$register_title=MthemeCore::getPostMeta($slider_id,$pre."event_link_title","Register");
	}
	if(empty($register_link))
	{
		$register_link=MthemeCore::getPostMeta($slider_id,$pre."event_link","http://multiathemes.com");
	}	
	/*first_button_option*/
	/*second_button_option*/
	if(empty($second_button_padding_top))
	{
		$second_button_padding_top=MthemeCore::getPostMeta($slider_id,$pre."second_button_padding_top","15");
	}
	if(empty($second_button_option))
	{
		$second_button_option=MthemeCore::getPostMeta($slider_id,$pre."second_button_option","false");
	}
	if(empty($second_button_border))
	{
		$second_button_border=MthemeCore::getPostMeta($slider_id,$pre."second_button_border","none");
	}
	if(empty($second_button_border_type))
	{
		$second_button_border_type=MthemeCore::getPostMeta($slider_id,$pre."second_button_border_type","solid");
	}
	if(empty($second_button_border_color))
	{
		$second_button_border_color=MthemeCore::getPostMeta($slider_id,$pre."second_button_border_color",$theme_tertiary_color);
	}
	if(empty($second_button_hover_border_color))
	{
		$second_button_hover_border_color=MthemeCore::getPostMeta($slider_id,$pre."second_button_hover_border_color",$theme_tertiary_color);
	}
	if(empty($second_button_hover_transpermt_option))
	{
		$second_button_hover_transpermt_option=MthemeCore::getPostMeta($slider_id,$pre."second_button_hover_transpermt_option","true");
	}
	if(empty($second_button_transpermt_option))
	{
		$second_button_transpermt_option=MthemeCore::getPostMeta($slider_id,$pre."second_button_transpermt_option","fasle");
	}
	if(empty($second_button_size))
	{
		$second_button_size=MthemeCore::getPostMeta($slider_id,$pre."second_button_size","large");
	}
	if(empty($second_button_text_transform))
	{
		$second_button_text_transform=MthemeCore::getPostMeta($slider_id,$pre."second_button_text_transform","Capitalize");
	}
	if(empty($second_button_color))
	{
		$second_button_color=MthemeCore::getPostMeta($slider_id,$pre."second_button_color",$theme_background_color);
	}
	if(empty($second_button_font_color))
	{
		$second_button_font_color=MthemeCore::getPostMeta($slider_id,$pre."second_button_font_color",$theme_primary_color);
	}
	if(empty($second_button_border_radius))
	{
		$second_button_border_radius=MthemeCore::getPostMeta($slider_id,$pre."second_button_border_radius","none");
	}	
	if(empty($second_button_hover_bg_color))
	{
		$second_button_hover_bg_color=MthemeCore::getPostMeta($slider_id,$pre."second_button_hover_bg_color",$theme_secondary_color);
	}
	if(empty($second_register_title))
	{
		$second_register_title=MthemeCore::getPostMeta($slider_id,$pre."second_event_link_title","Register");
	}
	if(empty($second_register_link))
	{
		$second_register_link=MthemeCore::getPostMeta($slider_id,$pre."second_event_link","http://multiathemes.com");
	}
	/*second_button_option*/	
	if(empty($html5_sound_icon))
	{
		$html5_sound_icon=MthemeCore::getPostMeta($slider_id,$pre."html5_sound_icon", 'no');
	}	
	if(empty($youtube_sound_icon))
	{
		$youtube_sound_icon=MthemeCore::getPostMeta($slider_id,$pre."youtube_sound_icon", 'no');
	}
	if(empty($vimeo_sound_icon))
	{
		$vimeo_sound_icon=MthemeCore::getPostMeta($slider_id,$pre."vimeo_sound_icon", 'no');
	}
	if(empty($html5_video_audio))
	{
		$html5_video_audio=MthemeCore::getPostMeta($slider_id,$pre."html5_video_audio", '');
	}	
	if(empty($youtube_video_audio))
	{
		$youtube_video_audio=MthemeCore::getPostMeta($slider_id,$pre."youtube_video_audio", '');
	}	
	if(empty($vimeo_video_audio))
	{
		$vimeo_video_audio=MthemeCore::getPostMeta($slider_id,$pre."vimeo_video_audio", '');
	}
	if(empty($header_transparent))
	{
		$header_transparent=MthemeCore::getPostMeta($slider_id,$pre."header_transparent", 'true');
	}	
	if(empty($type))
	{
		$type=MthemeCore::getPostMeta($slider_id,$pre."type", 'image');
	}
	if(empty($height_type))
	{
		$height_type=MthemeCore::getPostMeta($slider_id,$pre."height_type","auto");
	}
	if(empty($slider_effect))
	{
		$slider_effect=MthemeCore::getPostMeta($slider_id,$pre."effect", 'none');
	}
	
	if($slider_effect=='rain')
	{
		$lD=MthemeCore::getOption('rain_img',CHILD_URI.'site/img/rain.jpg');
		$out.='<script type="text/javascript">';
		$out.='window.globalRainVar = "'.esc_url($lD).'";';
		$out.='</script>';	
		
		wp_enqueue_script('rainyday-js', CHILD_URI.'site/js/rainyday.js',array("jquery-js"),array(),true);
		wp_enqueue_script('rain-init-js', CHILD_URI.'site/js/rain-init.js',array("jquery-js"),array(),true);
	}
	if($slider_effect=='snow')
	{
		$lD=MthemeCore::getPostMeta($slider_id,$pre.'snow_img',CHILD_URI.'site/img/ParticleSmoke.png');
		$out.='<script type="text/javascript">';
		$out.='window.globalSnowVar = "'.esc_url($lD).'";';
		$out.='</script>';
		
		wp_enqueue_script('ThreeCanvas-js', CHILD_URI.'site/js/ThreeCanvas.js',array("jquery-js"),array(),true);
		wp_enqueue_script('Snow-js', CHILD_URI.'site/js/Snow.js',array("jquery-js"),array(),true);
		wp_enqueue_script('snowfall-init-js', CHILD_URI.'site/js/snowfall-init.js',array("jquery-js"),array(),true);
	}
	if($slider_effect=='triangle')
	{
		$out.='<script type="text/javascript">';
		$out.='window.globalTriangleActive = "yes";';
		$out.='</script>';
		
		wp_enqueue_script('TweenLite-js', CHILD_URI.'site/js/TweenLite.min.js',array("jquery-js"),array(),true);
		wp_enqueue_script('EasePack-js', CHILD_URI.'site/js/EasePack.min.js',array("jquery-js"),array(),true);
		wp_enqueue_script('rAF-js', CHILD_URI.'site/js/rAF.js',array("jquery-js"),array(),true);
		wp_enqueue_script('canvas-js', CHILD_URI.'site/js/canvas.js',array("jquery-js"),array(),true);
	}
	
	
	$register_link_inner=substr($register_link, 0, 1);
	if($register_link_inner=='#')
	{
		$register_link=' data-scroll href="'.esc_url($register_link).'"';
	}
	else
	{
		$register_link=' href="'.esc_url($register_link).'"';
	}
	$register_link_inner=substr($second_register_link, 0, 1);
	if($register_link_inner=='#')
	{
		$second_register_link=' data-scroll href="'.esc_url($second_register_link).'"';
	}
	else
	{
		$second_register_link=' href="'.esc_url($second_register_link).'"';
	}
	
	$micosec = uniqid();
	$unique_id="slider_$micosec";
	
	$off_opacity=0;$on_opacity=0;
	if($height_type=='auto')
	{
		$out.='<section class="autoheight home_slider">';		
		$out.='<div class="inner-slider">';
		
		if($type=='html5video' && $html5_sound_icon=='yes'){
			if($html5_video_audio=='play'){$off_opacity=0;$on_opacity=1;}
			else{$off_opacity=1;$on_opacity=0;} 
			$out.='<a class="sound-option" href="#" style="bottom:30px;right:0;">';
			$out.='<i class="fa fa-volume-up" style="opacity:'.$on_opacity.'; font-size:30px;position:absolute;right:20px;bottom:20px;z-index: 109;cursor: pointer;"></i>';
			$out.='<i class="fa fa-volume-off" style="opacity:'.$off_opacity.';font-size:30px;position:absolute;right:20px;bottom:20px;z-index: 109;cursor: pointer;"></i></a>';
		}if($type=='youtube' && $youtube_sound_icon=='yes'){
			if($youtube_video_audio=='play'){$off_opacity=0;$on_opacity=1;}
			else{$off_opacity=1;$on_opacity=0;} 
			$out.='<a class="sound-option" href="#" style="bottom:30px;right:0;">';
			$out.='<i class="fa fa-volume-up" style="opacity:'.$on_opacity.'; font-size:30px;position:absolute;right:20px;bottom:20px;z-index: 109;cursor: pointer;"></i>';
			$out.='<i class="fa fa-volume-off" style="opacity:'.$off_opacity.';font-size:30px;position:absolute;right:20px;bottom:20px;z-index: 109;cursor: pointer;"></i></a>';
		}
		if($type=='vimeo' && $vimeo_sound_icon=='yes'){
			if($vimeo_video_audio=='play'){$off_opacity=0;$on_opacity=1;}
			else{$off_opacity=1;$on_opacity=0;} 
			$out.='<a class="sound-option" href="#" style="bottom:30px;right:0;">';
			$out.='<i class="fa fa-volume-up" style="opacity:'.$on_opacity.'; font-size:30px;position:absolute;right:20px;bottom:20px;z-index: 109;cursor: pointer;"></i>';
			$out.='<i class="fa fa-volume-off" style="opacity:'.$off_opacity.';font-size:30px;position:absolute;right:20px;bottom:20px;z-index: 109;cursor: pointer;"></i></a>';
		}
	}
	else{
		$height=MthemeCore::getPostMeta($slider_id,$pre."height","600");
		$out.='<section class="home_slider" style="height:'.esc_attr($height).'px;">';
		$out.='<div class="inner-slider">';
		
		if($type=='html5video' && $html5_sound_icon=='yes'){		
			if($html5_video_audio=='play'){$off_opacity=0;$on_opacity=1;}
			else{$off_opacity=1;$on_opacity=0;} 
			$out.='<a class="sound-option" href="#" style="top:0;right:0;">';
			$out.='<i class="fa fa-volume-up" style="opacity:'.$on_opacity.'; font-size:30px;position:absolute;right:20px;top:20px;z-index: 109;cursor: pointer;"></i>';
			$out.='<i class="fa fa-volume-off" style="opacity:'.$off_opacity.';font-size:30px;position:absolute;right:20px;top:20px;z-index: 109;cursor: pointer;"></i></a>';
		}if($type=='youtube' && $youtube_sound_icon=='yes'){
			if($youtube_video_audio=='play'){$off_opacity=0;$on_opacity=1;}
			else{$off_opacity=1;$on_opacity=0;} 
			$out.='<a class="sound-option" href="#" style="top:0;right:0;">';
			$out.='<i class="fa fa-volume-up" style="opacity:'.$on_opacity.'; font-size:30px;position:absolute;right:20px;top:20px;z-index: 109;cursor: pointer;"></i>';
			$out.='<i class="fa fa-volume-off" style="opacity:'.$off_opacity.';font-size:30px;position:absolute;right:20px;top:20px;z-index: 109;cursor: pointer;"></i></a>';
		}
		if($type=='vimeo' && $vimeo_sound_icon=='yes'){
			if($vimeo_video_audio=='play'){$off_opacity=0;$on_opacity=1;}
			else{$off_opacity=1;$on_opacity=0;} 
			$out.='<a class="sound-option" href="#" style="top:0;right:0;">';
			$out.='<i class="fa fa-volume-up" style="opacity:'.$on_opacity.'; font-size:30px;position:absolute;right:20px;top:20px;z-index: 109;cursor: pointer;"></i>';
			$out.='<i class="fa fa-volume-off" style="opacity:'.$off_opacity.';font-size:30px;position:absolute;right:20px;top:20px;z-index: 109;cursor: pointer;"></i></a>';
		}
		
		$out.='<script type="text/javascript">';
		$out.='window.globalBackHeightActive = "yes";';
		$out.='window.globalBackHeight = "'.esc_js($height).'";';
		$out.='</script>';
	}
	$contentOut="";
	if($slider_heading_option=='true' || $slider_icon_option=='true' || $slider_content_option=='true' || $coming_soon=='true' || $first_button_option=='true' || $notify_form_option=='true') { 
		$contentOut.='<div class="col-lg-12 landing-text-pos image_content wow animated fadeInDown" data-wow-duration="1s" data-wow-delay="1s" style="top:'.$landing_text_padding_top.'%;">';
		$contentOut.='<div class="slider_inner_content">';
		if($logo_position=='banner' || $logo_position=='both'){	
			$contentOut.='<div class="container '.$alignment.'">';
			$contentOut.='<a class="coming-brand '.$alignment.'" href="'.SITE_URL.'"><img src="'.MthemeCore::getOption("site_logo",CHILD_URI."site/img/logo.png").'" alt="logo"/></a></div>';
		}
		
		if($slider_icon_option=='true'){
			$contentOut.='<div class="background-containt-icon container '.$alignment.'" style="padding-top:'.$icon_padding_top.'px;">';
			$contentOut.='<i class="'.esc_attr(mtheme_get_icon($icon_title)).' '.$icon_bg_option.'" style="font-size:30px; background-color:'.$icon_bg_color.'; color:'.$icon_font_color.';"></i>';						
			$contentOut.='</div>';		
		}
		
		if($slider_heading_option=='true'){
			if(!empty($slider_title)) {
				$contentOut.='<div class="container '.$alignment.'" style="padding-top:'.$heading_padding_top.'px;">';
				
				$contentOut.='<'.$heading_font_style.' class="background-containt-heading wow animated fadeInDown" data-wow-duration="1s" data-wow-delay="1s" style="color:'.$heading_font_color.';font-style:'.$heading_font_type.';text-transform:'.$heading_text_transform.';">'.mtheme_html($slider_title).'</'.$heading_font_style.'>';
				
				if($hr_option=='true'){
					if($alignment=='align-left'){
						$contentOut.='<div class="lefthr" style="color:'.$hr_color.';border-width:'.$hr_border_width.'px;border-style:'.$hr_border_type.';width:'.$hr_width.'%;">';
						$contentOut.='</div>';	
					}else if($alignment=='align-center'){
						$contentOut.='<div class="centerhr" style="color:'.$hr_color.';border-width:'.$hr_border_width.'px; border-style:'.$hr_border_type.';width:'.$hr_width.'%;">';
						$contentOut.='</div>';	
					}else if($alignment=='align-right'){
						$contentOut.='<div class="righthr" style="color:'.$hr_color.';border-width:'.$hr_border_width.'px; border-style:'.$hr_border_type.';width:'.$hr_width.'%;">';$contentOut.='</div>';	
					}
				}				
				$contentOut.='</div>';		
			}
		}
		if( $slider_content_option=='true' ) {
			if(!empty($slider_content)) {
			
				$contentOut.='<div class="container '.$alignment.'" style="padding-top:'.$content_padding_top.'px;">';
					$contentOut.='<'.$content_font_style.' class="hero_s_content wow animated fadeInUp" data-wow-duration="1s" data-wow-delay="1s" style="color:'.$content_font_color.';font-style:'.$content_font_type.';text-transform:'.$content_text_transform.';">'.mtheme_html($slider_content).'</'.$content_font_style.'>';
				$contentOut.='</div>';	
			}
		}
		if( $coming_soon=='true' ) {
			$contentOut.='<div class="container" style="padding-top:'.$slider_date_padding_top.'px;">';
			
			if(($event_date_border_radius=='50%') || ($event_date_border_radius=='0%')) 
			{
				
				$contentOut.='<div class="'.$alignment.' clearfix">';
				$contentOut.='<div id="defaultCountdown" class="align-center clearfix"></div>';
				$contentOut.='</div>';	
				if($date_background_transparent=='true')
				{
					$event_date_background_color="transparent";
				}
				$contentOut.='<style type="text/css">';
				if( $alignment=='align-center' ){
					$contentOut.='#defaultCountdown .countdown-row {margin:0 auto;}';
				}
				if( $alignment=='align-left' ){
					$contentOut.='#defaultCountdown .countdown-row {float:left;}';
				}
				$contentOut.='#defaultCountdown .countdown-row .countdown-section .countdown-amount {background-color:'.$event_date_background_color.'!important; color:'.$event_date_font_color.'; border-radius:'.$event_date_border_radius.'; border:'.$event_date_border.' '.$event_date_border_color.' '.$event_date_border_type.';}';
				$contentOut.='#defaultCountdown .countdown-row .countdown-section .countdown-period{text-transform:'.$event_date_text_transform.'; color:'.$event_date_text_color.';}';
				$contentOut.='</style>';
				
				
			}else{
				$contentOut.='<div class="'.$alignment.'  clearfix">';
				$contentOut.='<div id="defaultCountdown" class="align-center clearfix"></div>';
				$contentOut.='</div>';	
				
				$contentOut.='<style type="text/css">';
				if( $alignment=='align-center' ){
					$contentOut.='#defaultCountdown .countdown-row {margin:0 auto;}';
				}
				if( $alignment=='align-left' ){
					$contentOut.='#defaultCountdown .countdown-row {float:left;}';
				}
				$contentOut.='#defaultCountdown .countdown-row .countdown-section .countdown-amount { color:'.$event_date_font_color.';}';
				$contentOut.='#defaultCountdown .countdown-row .countdown-section .countdown-period{text-transform:'.$event_date_text_transform.'; color:'.$event_date_text_color.';}';
				$contentOut.='</style>';
			}
			$contentOut.='</div>';
		}
				
		if($notify_form_option=='true'){  
			
			$contentOut.='<div class="container" style="padding-top:'.$notify_form_padding_top.'px;">';
			if($notify_style=='style1')
			{
				if($alignment=='align-left'){
					$contentOut.='<div class="col-lg-'.$notify_form_column.' left subscribe notify" style="padding: 0;">';
				}
				else if($alignment=='align-center'){
					$contentOut.='<div class="col-lg-'.$notify_form_column.' align-center subscribe notify" style="padding: 0;">';
				}
				if(!empty($notify_form_heading))
				$contentOut.='<h3 '.$alignment.' style="color:'.$notify_font_color.';">'.$notify_form_heading.'</h3>';
				$contentOut.='<form action="'.AJAX_URL.'" method="POST" id="'.esc_attr($unique_id).'" class="ajax-form">';
				$contentOut.='<div class=" align-center top-padding-15">';
				$contentOut.='<input type="text" placeholder="Your Email ID" name="email" class="form-control-2 email-add-2 gray"/>';
				$contentOut.='<button class="btn btn-default notify-button"><i class="fa fa-paper-plane"></i><span>'.$notify_button_heading.'</span></button>';
				$contentOut.='<input type="hidden" class="action" value="'.MTHEME_PREFIX.'notify_submit" />';
				$contentOut.='</div>';
				$contentOut.='<div class="message"></div>';
				$contentOut.='</form>';
				$contentOut.='</div>';
			}else{
				$contentOut.='<form action="'.AJAX_URL.'" method="POST" id="'.esc_attr($unique_id).'" class="ajax-form">';	
				if($alignment=='align-left'){
					$contentOut.='<div class="no-padding col-lg-'.$notify_form_column.' left input notify">';
				}
				else if($alignment=='align-center'){
					$contentOut.='<div class="no-padding col-lg-'.$notify_form_column.' align-center input notify">';
				}
				if(!empty($notify_form_heading))
				$contentOut.='<h3 '.$alignment.' style="color:'.$notify_font_color.';">'.$notify_form_heading.'</h3>';
				$contentOut.='<input type="text" class="form-control-1 email-add-1 black" name="email" placeholder="Enter Email Address"/>';
				$contentOut.='<button class="button button-large button-fullcolor submit-button" style="background-color:'.$notify_button_background_color.';"><span>'.$notify_button_heading.'</span></button>';
				$contentOut.='<input type="hidden" class="action" value="'.MTHEME_PREFIX.'notify_submit" />';
				$contentOut.='</div>';	
				$contentOut.='<div class="message"></div>';
				$contentOut.='</form>';
			} 
			$contentOut.='</div>';
		}		
		if($first_button_option=='true'){  
			if($first_button_transpermt_option=='true'){
				$button_color="transparent";
			}
			$btnEffect="";
			$contentOut.='<div id="'.$unique_id.'-buttons" class="background-containt-button container '.$alignment.'" style="padding-top:'.$button_padding_top.'px;">';
			
			if($first_button_hover_transpermt_option=='true'){
				$btnEffect=" btn-effect";
			}
			$contentOut.='<a class="first-button button button-'.$button_size.' radius-'.$button_border_radius.$btnEffect.' wow animated fadeIn" data-wow-duration="0.5s" data-wow-delay="1.5s"'.mtheme_html_content($register_link).' style="text-transform:'.$button_text_transform.'; background-color:'.$button_color.';border:'.$button_border.' '.$button_border_type.' '.$button_border_color.';">';
			
			$contentOut.=mtheme_html($register_title).'</a>';							
						
			$contentOut.='<style type="text/css">#'.$unique_id.'-buttons .first-button.button{color:'.$button_font_color.';}';
			if($first_button_hover_transpermt_option=='true'){
			$contentOut.='#'.$unique_id.'-buttons .first-button.button:hover::after{background-color:'.$button_hover_bg_color.'!important;color:'.$button_hover_font_color.'!important;}';
			}			
			$contentOut.='</style>';
			
			if($second_button_option=='true'){	
				if($second_button_transpermt_option=='true'){
					$second_button_color="transparent";
				}
				if($second_button_hover_transpermt_option=='true'){
					$btnEffect=" btn-effect";
				}
				$contentOut.='<a class="second-button button button-'.$second_button_size.' radius-'.$second_button_border_radius.$btnEffect.' wow animated fadeIn" data-wow-duration="0.5s" data-wow-delay="1.5s"'.mtheme_html_content($second_register_link).' style="text-transform:'.$second_button_text_transform.'; background-color:'.$second_button_color.';border:'.$second_button_border.' '.$second_button_border_type.' '.$second_button_border_color.';margin-left:45px;">';
				$contentOut.=mtheme_html($second_register_title).'</a>';
											
				$contentOut.='<style type="text/css">#'.$unique_id.'-buttons .second-button.button{color:'.$second_button_font_color.'!important;}';
				if($second_button_hover_transpermt_option=='true'){
				$contentOut.='#'.$unique_id.'-buttons .second-button.button:hover::after{background-color:'.$second_button_hover_bg_color.'!important; color:'.$second_button_hover_font_color.'!important;}';
				}
				$contentOut.='</style>';
			}
			$contentOut.='</div>';		
		}
		$contentOut.='</div></div>';
	}
			
	$hasSliderEmpty=false;
	if($type=='slider') {
		$hasSliderEmpty=true;
		wp_enqueue_style('superslides-style', CHILD_URI.'site/css/superslides.css');
		wp_enqueue_script('jquery.superslides-js', CHILD_URI.'site/js/jquery.superslides.js',array("jquery-js"),array(),true);
		
		$args=array(
			'post_type' =>'slide',
			'showposts' => -1,
			'order' => 'ASC',
			'meta_query' => array(
				array(
					'key' => '_thumbnail_id',
				),
			),
		);
		
		$category=MthemeCore::getPostMeta($slider_id,$pre."slide_cat");
		if(!empty($category)) {
			
			$category_int=intval($category);
			if(empty($category_int))
			{				
				$texanomy = get_term_by('slug',$category,'slide_cat');
				if($texanomy!=null)
				{
					$args['tax_query'][]=array(
						'taxonomy' => 'slide_cat',
						'terms' => $category,
						'field' => 'slug',
					);
				}
			}
			else{				
				$texanomy = get_term_by('term_id',$category,'slide_cat');
				if($texanomy!=null)
				{
					$args['tax_query'][]=array(
						'taxonomy' => 'slide_cat',
						'terms' => $category_int,
						'field' => 'term_id',
					);
				}
			}
			
		}
		
		$query=new WP_Query($args);
		
		if($query->have_posts()) {
			$hasSliderEmpty=false;

			if(empty($overlay_image))
			{
				$overlay_image=MthemeCore::getPostMeta($slider_id,$pre."overlay_image");
			}
			
			$out.='<div id="'.esc_attr($unique_id).'">';
			$out.='<div class="slides-container">';	
			$c=0;
			while($query->have_posts()) {
				$query->the_post();
				$out.=get_the_post_thumbnail(get_the_ID(),'large');
			}
			$out.='</div>';
			
			$slider_autoplay=MthemeCore::getPostMeta($slider_id,$pre."slider_autoplay","true");
			$slider_speed="off";
			if($slider_autoplay=='true'){
				$slider_speed=MthemeCore::getPostMeta($slider_id,$pre."slider_speed","5000");
				if(MthemeCore::getPostMeta($slider_id,$pre."slides_nav","false")=='false'){
					$out.='<nav class="slides-navigation">';
					$out.='<a href="#" class="next fa fa-2x fa-chevron-right"></a>';
					$out.='<a href="#" class="prev fa fa-2x fa-chevron-left"></a>';
					$out.='</nav>';
				}
			}
			else{
				$out.='<nav class="slides-navigation">';
				$out.='<a href="#" class="next fa fa-2x fa-chevron-right"></a>';
				$out.='<a href="#" class="prev fa fa-2x fa-chevron-left"></a>';
				$out.='</nav>';
			}
			$out.='</div>';
			if(MthemeCore::getPostMeta($slider_id,$pre."overlay_active",'true')=='true' && !empty($overlay_image)){
			$out.='<div class="slider_overlay" style="background-image:url(\''.esc_url($overlay_image).'\');"></div>';
			}
		
			$out.=$contentOut;
			
			$out.='<script type="text/javascript">';
			$out.='window.globalSlides = "#'.esc_js($unique_id).'";';
			$out.='window.globalSliderSpeed = "'.esc_js($slider_speed).'";';
			$out.='window.globalSlidesActive = "yes";';
			$out.='</script>';

		}
		
	}
	elseif($type=='html5video') {

		if(empty($background_image))
		{
			$background_image=MthemeCore::getPostMeta($slider_id,$pre."html_5_bg_image",CHILD_URI.'site/img/backgrounds/bg1.jpg');
		}if(empty($overlay_image))
		{
			$overlay_image=MthemeCore::getPostMeta($slider_id,$pre."overlay_image");
		}
		if(empty($videoUrl))
		{
			$videoUrl=MthemeCore::getPostMeta($slider_id,$pre."html_5_url",CHILD_URI."site/video.mp4");
		}		
		if(MthemeCore::getPostMeta($slider_id,$pre."overlay_active",'true')=='true' && !empty($overlay_image)){
			$out.='<div class="video_overlay" style="background-image:url(\''.esc_url($overlay_image).'\');"></div>';
		}
		if($html5_video_audio=='play') $html5_video_audio=='';
		$out.='<div class="video-bg" style="background-image:url(\''.esc_url($background_image).'\');"></div>';
		$out.='<video id="home_video" autoplay="autoplay" loop '.$html5_video_audio.'>';
		$out.='<source src="'.esc_url($videoUrl).'" type="video/mp4">';
		$out.='<source src="'.esc_url($videoUrl).'" type="video/ogg">';
		$out.='your browser does not support HTML5';
		$out.='</video>';
		
		$out.=$contentOut;
	}
	elseif($type=='vimeo') {
		
		if(empty($background_image))
		{
			$background_image=MthemeCore::getPostMeta($slider_id,$pre."vimeo_bg_image",CHILD_URI.'site/img/backgrounds/bg1.jpg');
		}if(empty($overlay_image))
		{
			$overlay_image=MthemeCore::getPostMeta($slider_id,$pre."overlay_image");
		}
		if(empty($vimeoId))
		{
			$vimeoId=MthemeCore::getPostMeta($slider_id,$pre."vimeo_url","14663047");
		}
		if(MthemeCore::getPostMeta($slider_id,$pre."overlay_active",'true')=='true' && !empty($overlay_image)){
			$out.='<div class="viemo_overlay" style="background-image:url(\''.esc_url($overlay_image).'\');"></div>';
		}
		$out.='<div id="vimeo_c" class="video-bg" style="background-image:url(\''.esc_url($background_image).'\');"></div>';
		
		$out.=$contentOut;
	
		$out.='<script type="text/javascript">';
		$out.='window.globalVimeoMedia = "'.esc_js($vimeoId).'";';
		$out.='window.globalVimeoActive = "yes";';
		$out.='window.globalVideoAudio = "'.$vimeo_video_audio.'";';
		$out.='</script>';		
		
		wp_enqueue_script('vimeo-js', CHILD_URI.'site/js/okvideo.js',array("jquery-js"),array(),true);
		
	}
	elseif($type=='youtube') {

		if(empty($background_image))
		{
			$background_image=MthemeCore::getPostMeta($slider_id,$pre."youtube_bg_image",CHILD_URI.'site/img/backgrounds/bg1.jpg');
		}
		if(empty($overlay_image))
		{
			$overlay_image=MthemeCore::getPostMeta($slider_id,$pre."overlay_image");
		}
		if(empty($youtubeID))
		{
			$youtubeID=MthemeCore::getPostMeta($slider_id,$pre."youtube_url","9bZkp7q19f0");
		}
		if(MthemeCore::getPostMeta($slider_id,$pre."overlay_active",'true')=='true' && !empty($overlay_image)){
			$out.='<div class="video_overlay" style="background-image:url(\''.esc_url($overlay_image).'\');"></div>';
		}
		
		$out.='<div class="video-bg" style="background-image:url(\''.esc_url($background_image).'\');"></div>';
		$out.='<div class="youtube">';
		$out.='<div id="'.esc_attr($unique_id).'"></div>';
		$out.='</div>';
	
		$out.=$contentOut;
		
		$out.='<script type="text/javascript">';
		$out.='window.globalYoutubeMedia = "'.esc_js($youtubeID).'";';
		$out.='window.globalYoutubeId = "#'.esc_js($unique_id).'";';
		$out.='window.globalYoutubeActive = "yes";';
		$out.='window.globalVideoAudio = "'.$youtube_video_audio.'";';
		$out.='</script>';	
		
		wp_enqueue_script('jquery.tubular-js', CHILD_URI.'site/js/jquery.tubular.1.0.js',array("jquery-js"),array(),true);
	}
	if($hasSliderEmpty || $type=='image') {

		if(empty($background_image))
		{
			$background_image=MthemeCore::getPostMeta($slider_id,$pre."image_url",CHILD_URI.'site/img/backgrounds/bg1.jpg');
		}if(empty($overlay_image))
		{
			$overlay_image=MthemeCore::getPostMeta($slider_id,$pre."overlay_image");
		}
		if(empty($image_url_zoom))
		{
			$image_url_zoom=MthemeCore::getPostMeta($slider_id,$pre."image_url_zoom",'on');
		}
		if(MthemeCore::getPostMeta($slider_id,$pre."overlay_active",'true')=='true' && !empty($overlay_image)){
		$out.='<div class="image_overlay" style="background-image:url(\''.esc_url($overlay_image).'\');"></div>';
		}
		
		$out.='<div class="image-bg" style="background-image:url(\''.esc_url($background_image).'\');"></div>';
		
		$out.=$contentOut;	
				
		if($image_url_zoom=='off')
		{
			$out.='<style type="text/css">';
			$out.='.image-bg{animation:none!important;}';
			$out.='</style>';
		}
	}
	if($header_transparent=='true')
	{
		$out.='<script type="text/javascript">';
		$out.='window.globalHeaderTransparentActive = "yes";';
		$out.='</script>';
	}		
	if($slider_effect=='astronomy')
	{
		$dotColor=MthemeCore::getPostMeta($slider_id,$pre.'dotColor','#919191');
		$lineColor=MthemeCore::getPostMeta($slider_id,$pre.'lineColor','#919191');
		$lineWidth=MthemeCore::getPostMeta($slider_id,$pre.'lineWidth','0.51');
		$particleRadius=MthemeCore::getPostMeta($slider_id,$pre.'particleRadius','3');
		$out.='<script type="text/javascript">';
		$out.='window.dotColor = "'.esc_js($dotColor).'";';
		$out.='window.lineColor = "'.esc_js($lineColor).'";';
		$out.='window.lineWidth = "'.esc_js($lineWidth).'";';
		$out.='window.particleRadius = "'.esc_js($particleRadius).'";';
		$out.='</script>';
		$out.='<div id="particles"></div>';
		wp_enqueue_script('jquery.particleground-js', CHILD_URI.'site/js/jquery.particleground.min.js',array("jquery-js"),array(),true);
		wp_enqueue_script('astronomy-init-js', CHILD_URI.'site/js/astronomy-init.js',array("jquery-js"),array(),true);
	}
	$out.='</section>';
	$out.='</section>';
	return $out;
}

/*home_events*/
add_shortcode('events', 'mtheme_events');
function mtheme_events($atts) {
	
	extract(shortcode_atts(array(
		'title' => '',
		'number' => '-1',
		'columns' => '4',
		'order' => 'menu_order',
		'category' => '',
		'status' => '',
		'thumbnail_width' => 431,
		'thumbnail_height' => 305
    ), $atts));
	
	if($order=='random') {
		$order='rand';
	}
		
	$args=array(
		'post_type' => 'event',
		'post_status' => 'publish',
		'showposts' => $number,	
		'orderby' => $order,
		'order' => 'ASC',
		'meta_query' => array(
			array(
				'key' => '_thumbnail_id',
			),
		),
		
	);
	
	
	if(!empty($status)) {
		$args['meta_query'][]=array(
            'key' => 'event_status',
			'value' => $status,
        );
	}
	
	$texanomy= null;	
	$haveItems=false;
	$micosec = uniqid();	
	$unique_id="event_$micosec";
	
	if(!empty($category)) {
	
		$category_int=intval($category);
		if(empty($category_int))
		{	
			$texanomy = get_term_by('slug',$category,'event_cat');
			if($texanomy!=null)
			{
				$args['tax_query'][]=array(
					'taxonomy' => 'event_cat',
					'terms' => $category,
					'field' => 'slug',
				);
			}			
		}
		else{		
			$texanomy = get_term_by('term_id',$category,'event_cat');
			if($texanomy!=null)
			{
				$args['tax_query'][]=array(
					'taxonomy' => 'event_cat',
					'terms' => $category_int,
					'field' => 'term_id',
				);
			}
		}
		
	}
	
	
	if($texanomy)
	{		
		if(empty($title))
		{
			$title=$texanomy->name;
		}
	}
	
	$query=new WP_Query($args);
			
	$out='<div id="'.esc_attr($unique_id).'">';
	$out.='<h3 class="text-center head">'.mtheme_html($title).'</h3>';
	
	$class="col-lg-3 col-md-3 col-sm-6 col-xs-12";
	switch($columns)
	{
		case 1: $class="col-lg-12 col-md-12 col-sm-12 col-xs-12";break;
		case 2: $class="col-lg-6 col-md-6 col-sm-12 col-xs-12";break;
		case 3: $class="col-lg-4 col-md-4 col-sm-8 col-xs-12";break;
	}
		
	while($query->have_posts()){
		
		$query->the_post();	
		$haveItems=true;
		ob_start();
		
		$out.='<div class="'.esc_attr($class).' padding-col">';
		$out.='<a class="hover-anchor" target="_blank" href="'.esc_url(get_permalink($post->ID)).'">';
		$out.=get_the_post_thumbnail(get_the_ID(),array($thumbnail_width,$thumbnail_height));
		$out.='</a>';
		$out.='<p class="text-center event-name">'.get_the_title().'</p>';
		
		$out.='</div>';
		
		
		ob_end_clean();
	}
		
	if(!$haveItems)
	{		
		$out='<h3>No Events</h3>';		
	}
	
	$out.='</div>';	
	
	return $out;
}

/*post_background*/
add_shortcode('post_background','post_background');
function post_background($atts, $content=null) {	
	
	extract(shortcode_atts(array(
		'post_id' => '',
		'type'=>'image',
		'author_id' => '',
		'sound_icon' => '',
		'video_audio' => '',
		'height_type'	=> '',
		'overlay_image' => '',
		'header_transparent' => '',
		'height' => '',
		'background_image' => '',
		'image_url_zoom' => '',
		
	), $atts));
	
	$out='';
	$micosec = uniqid();
	$unique_id="slider_$micosec";
	
	$off_opacity=0;$on_opacity=0;
	
	if(empty($height_type)){
		$height_type=MthemeCore::getOption("post_height_type","auto");
	}	
	if(empty($sound_icon)){
		$sound_icon=MthemeCore::getOption("post_sound_icon","yes");
	}
	if(empty($video_audio))
	{
		$video_audio=MthemeCore::getOption("post_video_audio","");
	}
	if(empty($header_transparent))
	{
		$header_transparent=MthemeCore::getOption("post_header_transparent","true");
	}
	
	if($height_type=='auto')
	{
		$out.='<div class="home_slider autoheight">';
		$out.='<div class="inner-slider">';
		
		if($sound_icon=='yes' && ($type=='html5video' || $type=='youtube' || $type=='vimeo' || $type=='audio')){
			if($video_audio=='play'){$off_opacity=0;$on_opacity=1;}
			else{$off_opacity=1;$on_opacity=0;} 
			$out.='<a class="sound-option" href="#" style="bottom:30px;right:0;">';
			$out.='<i class="fa fa-volume-up" style="opacity:'.$on_opacity.'; font-size:30px;position:absolute;right:20px;bottom:20px;z-index: 109;cursor: pointer;"></i>';
			$out.='<i class="fa fa-volume-off" style="opacity:'.$off_opacity.';font-size:30px;position:absolute;right:20px;bottom:20px;z-index: 109;cursor: pointer;"></i></a>';
		}
	}
	else{
		$height=MthemeCore::getOption("post_bg_height","600");
		$out.='<div class="home_slider" style="height:'.esc_attr($height).'px;">';
		$out.='<div class="inner-slider">';
		
		if($sound_icon=='yes' && ($type=='html5video' || $type=='youtube' || $type=='vimeo' || $type=='audio')){		
			if($video_audio=='play'){$off_opacity=0;$on_opacity=1;}
			else{$off_opacity=1;$on_opacity=0;} 
			$out.='<a class="sound-option" href="#" style="top:0;right:0;">';
			$out.='<i class="fa fa-volume-up" style="opacity:'.$on_opacity.'; font-size:30px;position:absolute;right:20px;top:20px;z-index: 109;cursor: pointer;"></i>';
			$out.='<i class="fa fa-volume-off" style="opacity:'.$off_opacity.';font-size:30px;position:absolute;right:20px;top:20px;z-index: 109;cursor: pointer;"></i></a>';
		}		
		
		$out.='<style type="text/css">';
		$out.='#tubular-container{ height:'.$height.'px!important;}';
		$out.='</style>';
	}
	$author_url=get_author_posts_url($author_id);
	$contentOut='';
		if($height_type=='auto'){
			$contentOut.='<div class="post-details-header auto-height clearfix">';
		}else{
			$contentOut.='<div class="post-details-header custom-height clearfix">';
		}	
		$contentOut.='<div class="author-detail clearfix">';
			$contentOut.='<div class="author-cmp-detail clearfix">';
				$contentOut.='<div class="author-img author-img4">'.get_avatar($author_id).'</div>';
				$contentOut.='<div class="author-name">';
					$contentOut.='<p class="author-title"><span> by </span>';
					$contentOut.='<a href="'.$author_url.'">'.get_the_author_meta("display_name",$author_id).'</a></p>';
				$contentOut.='</div>';
			$contentOut.='<h1 class="h1-72 white">'.get_the_title().'</h1>';
			$contentOut.='</div>';
			$contentOut.='</div>';
			$contentOut.='</div>';
	$contentOut.='</div>';
	$contentOut.='<div class="category-land-div">';
		$category_detail=get_the_category(get_the_ID());
		if($category_detail){
			$contentOut.='<span class="post-cat">';
			$category_out="";
			foreach($category_detail as $cd){
				$category_out.='<a href="' . get_category_link( $cd->term_id ) . '">'.$cd->cat_name;
				$category_out.='</a>, ';
			}
			$contentOut.=substr($category_out, 0, -2);
			$contentOut.='</span>';
		}
	$contentOut.='</div>';
	$contentOut.='<div class="date-land-div"><span class="post-date">'.esc_attr(get_the_date('M j, Y')).'</span></div>';
	
	$hasSliderEmpty=false;
	if($type=='slider') {
		$hasSliderEmpty=true;
		wp_enqueue_style('superslides-style', CHILD_URI.'site/css/superslides.css');
		wp_enqueue_script('jquery.superslides-js', CHILD_URI.'site/js/jquery.superslides.js',array("jquery-js"),array(),true);
		
		$args=array(
			'post_type' => 'carousel_slide',
			'showposts' => -1,
			'order' => 'ASC',
			'meta_query' => array(
				array(
					'key' => '_thumbnail_id',
				),
			),
		);
		
		$category=MthemeCore::getPostMeta($post_id,"post_gallery_cat");
		
		if(!empty($category)) {
			
			$category_int=intval($category);
			if(empty($category_int))
			{				
				$texanomy = get_term_by('slug',$category,'carousel_cat');
				if($texanomy!=null)
				{
					$args['tax_query'][]=array(
						'taxonomy' => 'carousel_cat',
						'terms' => $category,
						'field' => 'slug',
					);
				}
			}
			else{				
				$texanomy = get_term_by('term_id',$category,'carousel_cat');
				if($texanomy!=null)
				{
					$args['tax_query'][]=array(
						'taxonomy' => 'carousel_cat',
						'terms' => $category_int,
						'field' => 'term_id',
					);
				}
			}
		}
		
		$query=new WP_Query($args);
		
		if($query->have_posts()) {
			$hasSliderEmpty=false;

			if(empty($post_overlay_image))
			{
				$post_overlay_image=MthemeCore::getOption("post_overlay_image",'');
			}
			
			$out.='<div id="'.esc_attr($unique_id).'">';
			$out.='<div class="slides-container">';	
			$c=0;
			while($query->have_posts()) {
				ob_start();	
				$query->the_post();
				$out.=get_the_post_thumbnail(get_the_ID(),'large');
				ob_end_clean();	
			}
			$out.='</div>';
			
			$post_slider_autoplay=MthemeCore::getOption("post_slider_autoplay","true");
			$post_slider_speed="off";
			if($post_slider_autoplay=='true'){
				$post_slider_speed=MthemeCore::getOption("post_slider_speed","5000");
				if(MthemeCore::getOption("post_slides_nav","false")=='false'){
					$out.='<nav class="slides-navigation" style="opacity:1;">';
					$out.='<a href="#" class="next fa fa-2x fa-chevron-right"></a>';
					$out.='<a href="#" class="prev fa fa-2x fa-chevron-left"></a>';
					$out.='</nav>';
				}else{
					$out.='<nav class="slides-navigation" style="opacity:0;">';
					$out.='<a href="#" class="next fa fa-2x fa-chevron-right"></a>';
					$out.='<a href="#" class="prev fa fa-2x fa-chevron-left"></a>';
					$out.='</nav>';
				}
			}
			else{
				$out.='<nav class="slides-navigation" style="opacity:1;">';
				$out.='<a href="#" class="next fa fa-2x fa-chevron-right"></a>';
				$out.='<a href="#" class="prev fa fa-2x fa-chevron-left"></a>';
				$out.='</nav>';
			}
			$out.='</div>';
			if(MthemeCore::getOption("post_overlay_active",'true')=='true' && !empty($post_overlay_image)){
			$out.='<div class="slider_overlay" style="background-image:url(\''.esc_url($post_overlay_image).'\');"></div>';
			}
		
			$out.=$contentOut;
			
			$out.='<script type="text/javascript">';
			$out.='window.globalSlides = "#'.esc_js($unique_id).'";';
			$out.='window.globalSliderSpeed = "'.esc_js($post_slider_speed).'";';
			$out.='window.globalSlidesActive = "yes";';
			$out.='</script>';
		}		
	}
	elseif($type=='html5video') {

		if(empty($background_image))
		{
			$background_image=CHILD_URI.'site/img/backgrounds/bg1.jpg';
		}
		if(empty($post_overlay_image))
		{
			$post_overlay_image=MthemeCore::getOption("post_overlay_image",'');
		}		
		
		$videoUrl=MthemeCore::getPostMeta($post_id,"post_html_5_url",CHILD_URI."site/video.mp4");
		
		if(MthemeCore::getOption("post_overlay_active",'true')=='true' && !empty($post_overlay_image)){
			$out.='<div class="video_overlay" style="background-image:url(\''.esc_url($post_overlay_image).'\');"></div>';
		}
		
		if($video_audio=='play') $video_audio='';
		$out.='<div class="video-bg" style="background-image:url(\''.esc_url($background_image).'\');"></div>';
		$out.='<video id="home_video" autoplay="autoplay" loop '.$video_audio.'>';
		$out.='<source src="'.esc_url($videoUrl).'" type="video/mp4">';
		$out.='<source src="'.esc_url($videoUrl).'" type="video/ogg">';
		$out.='your browser does not support HTML5';
		$out.='</video>';
		$out.=$contentOut;
	
	}
	elseif($type=='vimeo') {
		
		if(empty($background_image))
		{
			$background_image=CHILD_URI.'site/img/backgrounds/bg1.jpg';
		}
		if(empty($overlay_image))
		{
			$overlay_image=MthemeCore::getOption("post_overlay_image",'');
		}
		
		$vimeoId=MthemeCore::getPostMeta($post_id,"post_vimeo_url","http://player.vimeo.com/video/75976293");
		
		if(MthemeCore::getOption("post_overlay_active",'true')=='true' && !empty($overlay_image)){
			$out.='<div class="viemo_overlay" style="background-image:url(\''.esc_url($overlay_image).'\');"></div>';
		}
		
		$out.='<div id="vimeo_c" class="video-bg" style="background-image:url(\''.esc_url($background_image).'\');"></div>';
		$out.=$contentOut;
		$out.='<script type="text/javascript">';
		$out.='window.globalVimeoMedia = "'.esc_js($vimeoId).'";';
		$out.='window.globalVimeoActive = "yes";';
		$out.='window.globalVideoAudio = "'.$video_audio.'";';
		$out.='</script>';		
		wp_enqueue_script('vimeo-js', CHILD_URI.'site/js/okvideo.js',array("jquery-js"),array(),true);
		
	}
	elseif($type=='youtube') {

		if(empty($background_image))
		{
			$background_image=CHILD_URI.'site/img/backgrounds/bg1.jpg';
		}
		if(empty($overlay_image))
		{
			$overlay_image=MthemeCore::getOption("post_overlay_image",'');
		}
		
		$youtubeID=MthemeCore::getPostMeta($post_id,"post_youtube_url","Cg4lEyWlm28");
		if(MthemeCore::getOption("post_overlay_active",'true')=='true' && !empty($overlay_image)){
			$out.='<div class="video_overlay" style="background-image:url(\''.esc_url($overlay_image).'\');"></div>';
		}
		
		$out.='<div class="video-bg"></div>';
		$out.='<div class="youtube">';
		$out.='<div id="'.esc_attr($unique_id).'"></div>';
		$out.='</div>';
		
		$out.=$contentOut;
		
		$out.='<script type="text/javascript">';
		$out.='window.globalYoutubeMedia = "'.esc_js($youtubeID).'";';
		$out.='window.globalYoutubeId = "#'.esc_js($unique_id).'";';
		$out.='window.globalYoutubeActive = "yes";';
		$out.='window.globalVideoAudio = "'.$video_audio.'";';
		$out.='</script>';	
			
		wp_enqueue_script('jquery.tubular-js', CHILD_URI.'site/js/jquery.tubular.1.0.js',array("jquery-js"),array(),true);
	}
	elseif($type=='audio'){

		if($video_audio=='play') $video_audio=true;else $video_audio=false;
		if(empty($background_image))
		{
			$background_image=CHILD_URI.'site/img/backgrounds/bg1.jpg';
		}
		if(empty($overlay_image))
		{
			$overlay_image=MthemeCore::getOption("post_overlay_image",'');
		}
		if(empty($image_url_zoom))
		{
			$image_url_zoom=MthemeCore::getOption("image_url_zoom",'on');
		}
		if(MthemeCore::getOption("post_overlay_active",'true')=='true' && !empty($overlay_image)){
		$out.='<div class="image_overlay" style="background-image:url(\''.esc_url($overlay_image).'\');"></div>';
		}
		
		$audio_url=MthemeCore::getPostMeta($post_id,"post_audio_url","https://api.soundcloud.com/tracks/145175216");
		
		$out.='<div style="visibility:hidden;position:fixed"><iframe id="audio-frame" class="audio-frame post"  src="https://w.soundcloud.com/player/?url='.$audio_url.'&amp;auto_play='.$video_audio.'&amp;hide_related=false&amp;show_comments=false&amp;show_user=true&amp;show_reposts=true&amp;visual=true"></iframe></div>';	
		
		wp_enqueue_script('player.api-js', 'http://w.soundcloud.com/player/api.js',array("jquery-js"),array(),true);
		
		$out.='<div class="image-bg" style="background-image:url(\''.esc_url($background_image).'\');"></div>';
		
		$out.=$contentOut;
		
		if($image_url_zoom=='off')
		{
			$out.='<style type="text/css">';
			$out.='.image-bg{animation:none!important;}';
			$out.='</style>';
		}
	}else{
		if(empty($background_image))
		{
			$background_image=CHILD_URI.'site/img/backgrounds/bg1.jpg';
		}
		if(empty($overlay_image))
		{
			$overlay_image=MthemeCore::getOption("post_overlay_image",'');
		}
		if(empty($image_url_zoom))
		{
			$image_url_zoom=MthemeCore::getOption("image_url_zoom",'on');
		}
		if(MthemeCore::getOption("post_overlay_active",'true')=='true' && !empty($overlay_image)){
		$out.='<div class="image_overlay" style="background-image:url(\''.esc_url($overlay_image).'\');"></div>';
		}
		
		$out.='<div class="image-bg" style="background-image:url(\''.esc_url($background_image).'\');"></div>';
		
		$out.=$contentOut;
		
		if($image_url_zoom=='off')
		{
			$out.='<style type="text/css">';
			$out.='.image-bg{animation:none!important;}';
			$out.='</style>';
		}
	}
	if($header_transparent=='true')
	{
		$out.='<style type="text/css">';
		$out.='.header { background-color: transparent;}';
		$out.='</style>';
	}
	$out.='</div></div>';
	return $out;
}


/*Blog*/
add_shortcode('mtheme_blog', 'mtheme_blog');
function mtheme_blog($atts){
	extract(shortcode_atts(array(
		'number' => '3',
		'background' => '#fff',
		'description' => '',
		'title' => '',
		'align_style'=>'',
		'order' => 'ID',
		'image_column' => '2',
		'category' => '',
		'status' => '',
		'thumbnail_width' => 160,
		'thumbnail_height' => 56,
		'post_name' => '',
		'post_date' => '',
		'post_overview' => '',
		'post_category' => '',
		'post_youtube_url' => '',
		'post_vimeo_url' => '',
		'post_audio_url' => '',
		'post_gallery_cat' => '',
		'post_type' => '',
		'url' =>'',
		'post_html_5_url' =>'',
		'column' => '3',
		'blog_image_position' => 'top',
		'sliders_on' => '',
		'isautoplay' => '',
		'sliders_type' => '',
		'nav_color' => '',
		'nav_bg' => '',
		'heading_color' => '',
		'content_color'=> '',
		'sub_heading_color' => '',
		'head_font_style' => '',
		'des_font_style' => '',
		'sub_font_style' => '',
	), $atts));
	
	if(empty($nav_color) || $nav_color=="#")
	{
		$nav_color=MthemeCore::getOption("secondary_color","#0c59d8");
	}
	if(empty($nav_bg) || $nav_bg=="#")
	{
		$nav_bg=MthemeCore::getOption('background_color','#212739');
	}
	if(empty($heading_color) || $heading_color=="#")
	{	
		$heading_color=MthemeCore::getOption('post_heading_color','#363636');
	} 
	if(empty($sub_heading_color) || $sub_heading_color=="#")
	{
		$sub_heading_color=MthemeCore::getOption('secondary_color','#8b8b8b');
	}	
	if(empty($content_color) || $content_color=="#")
	{
		$content_color=MthemeCore::getOption('post_content_color','#8b8b8b');
	}
	if(empty($sub_content_color) || $sub_content_color=="#")
	{
		$sub_content_color=MthemeCore::getOption('post_content_color','#8b8b8b');
	}
	if(empty($head_font_style))
	{
		$head_font_style='normal';
	}
	if(empty($sub_font_style))
	{
		$sub_font_style='normal';
	}
	if(empty($des_font_style))
	{
		$des_font_style='normal';
	}
	if($order=='random') {
		$order='rand';
	}
	
	$args=array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'showposts' => $number,	
		'orderby' => $order,
		'order' => 'DESC'
	);
	if(!empty($status)) {
		$args['meta_query'][]=array(
            'key' => 'post_status',
			'value' => $status,
        );
	}	
	$totalBlogs=0;
	$query=new WP_Query($args);
	while($query->have_posts()){		
		$query->the_post();	
		$totalBlogs++;
	}
	$query=new WP_Query($args);
	
	$blogsPerSlide = $column;
	$blogNo = 0;
	$totalEquelSlides=intval($totalBlogs/$blogsPerSlide)*$blogsPerSlide;
	
	$texanomy= null;	
	$haveItems=false;
	$micosec = uniqid();	
	$unique_id="post_$micosec";
	
	if(!empty($category)) {
	
		$category_int=intval($category);
		if(empty($category_int))
		{			
			$texanomy = get_term_by('slug',$category,'category');
			if($texanomy!=null)
			{
				$args['tax_query'][]=array(
					'taxonomy' => 'category',
					'terms' => $category,
					'field' => 'slug',
				);
			}			
		}
		else{
			$texanomy = get_term_by('term_id',$category,'category');
			if($texanomy!=null)
			{
				$args['tax_query'][]=array(
					'taxonomy' => 'category',
					'terms' => $category_int,
					'field' => 'term_id',
				);
			}
		}
	}
	
	switch($column)
	{
		case 1: $column='col-lg-12 col-md-12 col-sm-12 col-xs-12';break;
		case 2: $column='col-lg-6 col-md-6 col-sm-12 col-xs-12';break;
		case 3: $column='col-lg-4 col-md-4 col-sm-12 col-xs-12';break;
		case 4: $column='col-lg-3 col-md-3 col-sm-12 col-xs-12';break;
		default: $column='col-lg-6 col-md-6 col-sm-12 col-xs-12';break;
	}
	
	if($blog_image_position=='left')
	{
		switch($image_column)
		{
			case 1: $image_column=$content_column='col-lg-12 col-md-12 col-sm-12 col-xs-12';break;
			case 2: $image_column=$content_column='col-lg-6 col-md-6 col-sm-12 col-xs-12';break;
			case 3: $image_column='col-lg-4 col-md-4 col-sm-12 col-xs-12';
				$content_column='col-lg-8 col-md-8 col-sm-12 col-xs-12';break;
			case 4: $image_column='col-lg-3 col-md-3 col-sm-12 col-xs-12';
				$content_column='col-lg-9 col-md-9 col-sm-12 col-xs-12';break;
			default: $image_column='col-lg-6 col-md-6 col-sm-12 col-xs-12';break;
		}
	}
	else
	{
		$image_column=$content_column='col-lg-12 col-md-12 col-sm-12 col-xs-12';
	}
	
	$prePost="post_";
	$query=new WP_Query($args);
	$out='<section class="blogs-wrapper section-padding" style="background-color:'.$background.'">';
	$out.='<div class="container">';
	$out.='<div class="row">';
		$out.='<div class="col-md-8 wow animated fadeInLeft align-center" data-wow-duration="1s" data-wow-delay="0.3s">';
			$out.='<h1 style="color:'.esc_attr($heading_color).'">'.mtheme_html($title).'</h1><hr>';
			$out.='<p style="color:'.esc_attr($content_color).'">'.mtheme_html($description).'</p>';
		$out.='</div>';
	$out.='</div>';	
	
	$out.='<div class="row">';	
	if($query->have_posts()){
		
		while($query->have_posts()){
				
			if($blogNo != 0 && $blogNo % $blogsPerSlide == 0){
				$out.='</div><div class="row">';
			}
			$blogNo++;
			ob_start();
			$query->the_post();
			
			$post_type=MthemeCore::getPostMeta(get_the_ID(),"post_type","image");
			$out.='<div class="'.$column.'">';
				$out.='<div class="blog">';
					$out.='<div class="'.$image_column.'">';
					if($post_type=='slider')
					{
						$out.='<div class="blog-slider">';
						$category=MthemeCore::getPostMeta(get_the_ID(),$prePost."gallery_cat");
						$out.=do_shortcode('[carousel_slider category="'.$category.'"]');
						$out.='</div>';
					}elseif($post_type=='html5video'){
						$url=MthemeCore::getPostMeta(get_the_ID(),$prePost."html_5_url",CHILD_URI."site/video.mp4");
						$out.='<div class="blog-html-video ">';
						$out.='<video class="html5video-post" controls>';
							$out.='<source src="'.esc_url($url).'" type="video/mp4">';
							$out.='<source src="'.esc_url($url).'" type="video/ogg">';
							$out.='<p>your browser does not support HTML5</p>';
						$out.='</video>';
						$out.='</div>';
					}elseif($post_type=='youtube'){
						$url=MthemeCore::getPostMeta(get_the_ID(),$prePost."youtube_url","Cg4lEyWlm28");
						$out.='<div class="blog-youtube-video ">';
							$out.='<div class="youtube_parent">';
								$out.='<iframe width="100%" height="auto" src="http://www.youtube.com/embed/'.esc_attr($url).'"></iframe>';
							$out.='</div>';
						$out.='</div>';		
					}elseif($post_type=='vimeo'){
						$url=MthemeCore::getPostMeta(get_the_ID(),$prePost."vimeo_url","75976293");
							$out.='<div class="blog-vimeo-video ">';
								$out.='<div class="video">';
									$out.='<iframe width="100%" height="auto" src="http://player.vimeo.com/video/'.esc_attr($url).'" ></iframe>';
								$out.='</div>';
							$out.='</div>';
					}elseif($post_type=='audio'){
					$url=MthemeCore::getPostMeta(get_the_ID(),$prePost."audio_url",
					"https://api.soundcloud.com/tracks/145175216");
						$out.='<div class="blog-audio">';
							$out.='<iframe class="audio-frame"  src="https://w.soundcloud.com/player/?url='.esc_url($url).'&amp;auto_play=false&amp;hide_related=false&amp;show_comments=false&amp;show_user=true&amp;show_reposts=true&amp;visual=true"></iframe>';
						$out.='</div>';	
					}else{
						$out.='<div class="blog-image ">';
							$out.=get_the_post_thumbnail(get_the_ID(),"small");	
						$out.='</div>';
					}
					$author_url=get_author_posts_url(get_the_author_meta( "ID" ) );
					$out.='</div>';
					$out.='<div class="'.$content_column.'">';	
						$out.='<div class="blog-cont '.$align_style.'">';
							$out.='<div class="blog-name">';
							$out.='<div class="heading"><span style="color:'.$heading_color.';font-style:'.$head_font_style.';">'.get_the_title().'</span></div>';
							$out.='<div class="sub-heading"><span class="author-name"><a href="'.esc_url($author_url).'" style="color:'.$sub_heading_color.';font-style:'.$sub_font_style.';">'.get_the_author().'</a></span>';
							$out.='<span class="author-date" style="color:'.$sub_heading_color.';font-style:'.$sub_font_style.';"">| '.esc_attr(get_the_date('M j, Y'));
							$out.='</span>';
							$category_detail=get_the_category(get_the_ID());
							if($category_detail){
							$out.='<span class="post-cat">';
							foreach($category_detail as $cd){
								$out.='<a href="' . get_category_link( $cd->term_id ) . '" style="color:'.$sub_heading_color.';font-style:'.$sub_font_style.';"">| '.$cd->cat_name;
								$out.='</a>';
							}
							$out.='</span>';
							}
							
							$out.='</div><p class="sub-cont" style="color:'.$sub_content_color.';font-style:'.$des_font_style.';">'.MthemeCore::getPostMeta(get_the_ID(),$prePost."overview").'</p>';
							$out.='<a class="post-link" href="'.esc_url(get_permalink()).'"><u>'.__('Read More', 'mtheme').'</u></a>';
							$out.='</div>'; 
						$out.='</div>';
					$out.='</div>';	
				$out.='</div><!--blog-->';
			$out.='</div><!--column-->';
			ob_end_clean();
		}
		
		
	}
	$out.='</div><!--row-->';
	$out.='</div><!--container-->';
	$out.='</section><!--section-->';
	return $out;
}
