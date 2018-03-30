<?php
function webnus_iconbox( $attributes, $content = null ) {

	extract(shortcode_atts(array(
		"type"=>'',
		'icon_title'=>'',
		'icon_link_url'=>'',
		'icon_link_text'=>'',
		"icon_name"=>'',
		"iconbox_content"=>'',
		"icon_size"=>'',
		"icon_color"=>'',
		"title_color"=>'',
		"content_color"=>'',
		"link_color"=>'',
		"link_target"=>'',		
		"icon_image"=>'',
	), $attributes));
	ob_start();

		
	$target = ($link_target)?'target="_blank" ':'';
	$type = ($type==0) ? '' : $type ;
	$iconbox_style = ( !empty($icon_color) ) ? ' style="color: ' . $icon_color . '"' : '' ;

	$type17_start_wrap = $type17_end_wrap = '';
	if ( $type==17 ) {
		$type17_start_wrap = '<div class="icon-wrap" style="background-color:'.$icon_color.'">';
		$type17_end_wrap   = '</div>';
	}
	
	echo '<article class="icon-box' . $type . '" ' . $iconbox_style . '>';

		if(!empty($icon_name) && $icon_name != 'none') :
			if(!empty($icon_link_url))
				echo '' . $type17_start_wrap . '<a '.$target.'href="' . $icon_link_url . '">'  . do_shortcode(  "[icon name='$icon_name' size='$icon_size' color='$icon_color']" ).'</a>' . $type17_end_wrap . '';
			else
				echo $type17_start_wrap . do_shortcode(  "[icon name='$icon_name' size='$icon_size' color='$icon_color']" ) . $type17_end_wrap;
		elseif(!empty($icon_image)) :
			if(is_numeric($icon_image)){
				$icon_image = wp_get_attachment_url( $icon_image );
			}
			if(!empty($icon_link_url))
				echo '<a '.$target.'href="'.$icon_link_url.'"><img src="'.$icon_image.'" /></a>' ;
			else
				echo '<img src="'.$icon_image.'" />';
		endif;

	 	$title_style = !empty($title_color)?' style="color:'.$title_color.'"':'';
		 echo '<h4'.$title_style.'>' . $icon_title . '</h4>';
		 $content_style = !empty($content_color)?' style="color:'.$content_color.'"':'';
      	 echo '<p'.$content_style.'>'.$iconbox_content .'</p>' ;
		 $link_style = !empty($link_color)?' style="color:'.$link_color.'"':'';
		 echo (!empty($icon_link_url) &&  (!empty($icon_link_text)) )?'<a '.$target.$link_style.' class="magicmore" href="'.$icon_link_url.'">'.$icon_link_text.'</a>':'';
	echo '</article>';
	
$out = ob_get_contents();
ob_end_clean();
$out = str_replace('<p></p>','',$out);
	return $out;
 }
 add_shortcode('iconbox', 'webnus_iconbox');
?>