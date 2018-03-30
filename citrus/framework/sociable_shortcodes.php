<?php

add_shortcode('map_wrapper','map_wrapper');
function map_wrapper( $attrs = null, $content = null,$shortcodename ="" ){
	return "<div class='map-wrapper'></div>";
}

/** fblike
  * Objective:
  *		1.Facebook Widget.
**/
add_shortcode('fblike','fblike');
function fblike( $attrs = null, $content = null,$shortcodename ="" ){
	extract(shortcode_atts(array('layout'=>'box_count','width'=>'','height'=>'','send'=>false,'show_faces'=>false,'action'=>'like','font'=> 'lucida+grande'
				,'colorscheme'=>'light'), $attrs));

	if ($layout == 'standard') { $width = '450'; $height = '35';  if ($show_faces == 'true') { $height = '80'; } }
	if ($layout == 'box_count') { $width = '55'; $height = '65'; }
	if ($layout == 'button_count') { $width = '90'; $height = '20'; }
	$layout = 'data-layout = "'.$layout.'" ';
	$width = 'data-width = "'.$width.'" ';
	$font = 'data-font = "'.str_replace("+", " ", $font).'" ';
	$colorscheme = 'data-colorscheme = "'.$colorscheme.'" ';
	$action = 'data-action = "'.$action.'" ';
	if ( $show_faces ) { $show_faces = 'data-show-faces = "true" '; } else { $show_faces = ''; }
	if ( $send ) { $send = 'data-send = "true" '; } else { $send = ''; }
	
    $out = '<div id="fb-root"></div><script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";fjs.parentNode.insertBefore(js, fjs);}(document, "script", "facebook-jssdk"));</script>';
	$out .= '<div class = "fb-like" data-href = "'.get_permalink().'" '.$layout.$width.$font.$colorscheme.$action.$show_faces.$send.'></div>';
return $out;
}


/** googleplusone
  * Objective:
  *		1.googleplusone Widget.
**/
add_shortcode('googleplusone','googleplusone');	
function googleplusone( $attrs = null, $content = null,$shortcodename ="" ){
	extract(shortcode_atts(array('size'=> '','lang'=> ''), $attrs));
	$size = empty($size) ? "size='small'" : "size='{$size}'";
	$lang = empty($lang) ? "{lang:en_GB}" : "{lang:'{$lang}'}";
	
	$out = '<script type="text/javascript" src="https://apis.google.com/js/plusone.js">'.$lang.'</script>';
	$out .= '<g:plusone '.$size.'></g:plusone>';
	return $out;
}

/** twitter
  * Objective:
  *		1.twitter Widget.
**/
add_shortcode('twitter','twitter');
function twitter( $attrs = null, $content = null,$shortcodename ="" ){
	extract(shortcode_atts(array('layout'=>'vertical','username'=>'','text'=>'','url'=>'','related'=> '','lang'=> ''), $attrs));
	
	$p_url= get_permalink();
	$p_title = get_the_title();
	
	$text = !empty($text) ? "data-text='{$text}'" :"data-text='{$p_title}'";
	$url = !empty($url) ? "data-url='{$url}'" :"data-url='{$p_url}'";
	$related = !empty($related) ? "data-related='{$related}'" :'';
	$lang = !empty($lang) ? "data-lang='{$lang}'" :'';
	$twitter_url = "http://twitter.com/share";
		$out = '<a href="{$twitter_url}" class="twitter-share-button" '.$url.' '.$lang.' '.$text.' '.$related.' data-count="'.$layout.'" data-via="'.$username.'">'.
	__('Tweet','dt_themes').'</a>';
		$out .= '<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>';
	return $out;	
}

/** stumbleupon
  * Objective:
  *		1.Stumbleupon Widget.
**/
add_shortcode('stumbleupon','stumbleupon');
function stumbleupon( $attrs = null, $content = null,$shortcodename ="" ){
	extract(shortcode_atts(array('layout'=>'5','url'=>get_permalink()),$attrs));
	$url = "&r='{$url}'";
	$out = '<script src="http://www.stumbleupon.com/hostedbadge.php?s='.$layout.$url.'"></script>';
	return $out;	
}

/** linkedin
  * Objective:
  *		1.linkedin Widget.
**/
add_shortcode('linkedin','linkedin');
function linkedin( $attrs = null, $content = null,$shortcodename ="" ){
	extract(shortcode_atts(array('layout'=>'2','url'=>get_permalink()),$attrs));
	
    	if ($url != '') { $url = "data-url='".$url."'"; }
	    if ($layout == '2') { $layout = 'right'; }
		if ($layout == '3') { $layout = 'top'; }
		$out = '<script type="text/javascript" src="http://platform.linkedin.com/in.js"></script><script type="in/share" data-counter = "'.$layout.'" '.$url.'></script>';
	return $out;	
}

/** delicious
  * Objective:
  *		1.Delicious Widget.
**/
add_shortcode('delicious','delicious');
function delicious( $attrs = null, $content = null,$shortcodename ="" ){
	extract(shortcode_atts(array('text'=>__("Delicious",'dt_themes')),$attrs));
	
	$delicious_url = "http://www.delicious.com/save";
	
	$out = '<img src="http://www.delicious.com/static/img/delicious.small.gif" height="10" width="10" alt="Delicious" />&nbsp;<a href="{$delicious_url}" onclick="window.open(&#39;http://www.delicious.com/save?v=5&noui&jump=close&url=&#39;+encodeURIComponent(location.href)+&#39;&title=&#39;+encodeURIComponent(document.title), &#39;delicious&#39;,&#39;toolbar=no,width=550,height=550&#39;); return false;">'.$text.'</a>';
	return $out;	
}

/** pintrest
  * Objective:
  *		1.Pintrest Widget.
**/
add_shortcode('pintrest','pintrest');
function pintrest( $attrs = null, $content = null,$shortcodename ="" ){
	extract(shortcode_atts(array('text'=>get_the_excerpt(),'layout'=>'horizontal','image'=>'','url'=>get_permalink(),'prompt'=>false),$attrs));
	$out = '<div class = "mysite_sociable"><a href="http://pinterest.com/pin/create/button/?url='.$url.'&media='.$image.'&description='.$text.'" class="pin-it-button" count-layout="'.$layout.'">'.__("Pin It",'dt_themes').'</a>';
	$out .= '<script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script>';
	
	if($prompt):
		$out = '<a title="'.__('Pin It on Pinterest','dt_themes').'" class="pin-it-button" href="javascript:void(0)">'.__("Pin It",'dt_themes').'</a>';
		$out .= '<script type = "text/javascript">';
		$out .= 'jQuery(document).ready(function(){';
			$out .= 'jQuery(".pin-it-button").click(function(event) {';
			$out .= 'event.preventDefault();';
			$out .= 'jQuery.getScript("http://assets.pinterest.com/js/pinmarklet.js?r=" + Math.random()*99999999);';
			$out .= '});';
		$out .= '});';
		$out .= '</script>';
		$out .= '<style type = "text/css">a.pin-it-button {position: absolute;background: url(http://assets.pinterest.com/images/pinit6.png);font: 11px Arial, sans-serif;text-indent: -9999em;font-size: .01em;color: #CD1F1F;height: 20px;width: 43px;background-position: 0 -7px;}a.pin-it-button:hover {background-position: 0 -28px;}a.pin-it-button:active {background-position: 0 -49px;}</style>';
	
	endif;
	return $out;
}

/** digg
  * Objective:
  *		1.Digg Widget.
**/
add_shortcode('digg','digg');
function digg( $attrs = null, $content = null,$shortcodename ="" ){
	extract(shortcode_atts(array('layout'=>'DiggMedium','url'=>get_permalink(),'title'=>get_the_title(),'type'=>'','description'=>get_the_content(),'related'=>''),$attrs));
	
	if ($title != '') { $title = "&title='".$title."'"; }
	if ($type != '') { $type = "rev='".$type."'"; }
	if ($description != '') { $description = "<span style = 'display: none;'>".$description."</span>"; }
	if ($related != '') { $related = "&related=no"; }

	$out = '<a class="DiggThisButton '.$layout.'" href="http://digg.com/submit?url='.$url.$title.$related.'"'.$type.'>'.$description.'</a>';
	$out .= '<script type = "text/javascript" src = "http://widgets.digg.com/buttons.js"></script>';
	return $out;
}

add_shortcode('dt_sc_social','dt_sc_social'); 
function dt_sc_social($attrs, $content=null,$shortcodename="") {
	$dttheme_options = get_option(IAMD_THEME_SETTINGS);

	if( isset($dttheme_options['general']['show-sociables']) && isset($dttheme_options['social']) ):
		$out = "<ul class='social-icons'>";
			foreach($dttheme_options['social'] as $social):
				$link = $social['link'];
				$icon = $social['icon'];
				$out .= "<li><a href='{$link}' target='_blank'>";
				$out .= '<span class="fa '.$icon.'"></span>';
				$out .= "</a></li>"; 
			endforeach;
		$out .= "</ul>";
	return $out;	
	endif;	
}
?>