<?php
if(!function_exists('theme_shortcode_button')){
function theme_shortcode_button($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'id' => false,
		'class' => false,
		'size' => 'small',
		'link' => '',
		'linktarget' => '',
		'color' => 'primary',
		'bgcolor' => '',
		'width' => false,
		'textcolor' => '',
		'hoverbgcolor' => '',
		'hovertextcolor' => '',
		'full' => "false",
		'align' => false,
		'button' => "false",
		'nofollow' => "false",
		'icon' => false,
		'icon_color' => false,
	), $atts));
	$id = $id?' id="'.$id.'"':'';
	$full = ($full==="false")?'':' full';
	$color = $color?' '.$color:'';
	$class = $class?' '.$class:'';
	$link = $link?' href="'.$link.'"':' href="javascript:;"';
	$linktarget = $linktarget?' target="'.$linktarget.'"':'';
	
	$hoverbgcolor = $hoverbgcolor?($bgcolor?' data-bg="'.$bgcolor.'"':'').' data-hoverBg="'.$hoverbgcolor.'"':'';
	$hovertextcolor = $hovertextcolor?($textcolor?' data-color="'.$textcolor.'"':'').' data-hoverColor="'.$hovertextcolor.'"':'';
	
	$bgcolor = $bgcolor?' style="background-color:'.$bgcolor.'"':'';
	if($width){
		if(is_numeric($width)){
			$width = $width.'px';
		}
		$width = 'width:'.$width;
	}else{
		$width = '';
	}
	$textcolor = $textcolor?'color:'.$textcolor.';':'';
	
	if($align != 'center' && $align !== false){
		$aligncss = ' align'.$align;
	}else{
		$aligncss = '';
	}
	if($button == 'true'){
		$tag = 'button';
	}else{
		$tag = 'a';
	}
	if($nofollow == 'true'){
		$follow_tag = ' rel="nofollow"';
	}else{
		$follow_tag = '';
	}

	if($icon) {
		if($icon_color){
			$icon_color_style = ' style="color:'.$icon_color.'"';
		} else {
			$icon_color_style = '';
		}
		$icon = '<i class="icon-'.$icon.'"'.$icon_color_style.'></i>';
	}else {
		$icon = '';
	}
	$content = '<'.$tag.$id.$link.$linktarget.$bgcolor.$hoverbgcolor.$hovertextcolor.' class="'.apply_filters( 'theme_css_class', 'button' ).' '.$size.$color.$full.$class.$aligncss.'"'.$follow_tag.'><span'.(($textcolor!==''||$width!='')?' style="'.$textcolor.$width.'"':'').'>' . $icon. trim($content) . '</span></'.$tag.'>';
	if($align === 'center'){
		return '<p class="center">'.$content.'</p>';
	}else{
		return $content;
	}
}
}
add_shortcode('button','theme_shortcode_button');