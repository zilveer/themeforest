<?php

$el_class = $output = '';

extract( shortcode_atts( array(
			'el_class' => '',
			'style' => 'square',
			'align' => 'none',
			'margin' => '4',
			'skin' => 'dark',
			'border_color' => '#ccc',
			'bg_color' => '',
			'bg_hover_color' => '#232323',
			'icon_color' => '#ccc',
			'icon_hover_color' => '#eee',
			'facebook' => "",
			'twitter' => "",
			'rss' => "",
			'dribbble' => "",
			'instagram' => "",
			'pinterest' => "",
			'google_plus' => "",
			'linkedin' => "",
			'youtube' => "",
			'tumblr' => "",

			'behance' => "",
			'whatsapp' => "",
			'qzone' => "",
			'vkcom' => "",
			'imdb' => "",
			'renren' => "",
			'wechat' => "",
			'weibo' => "",
			'vimeo' => "",
			'spotify' => "",
			'animation' => '',
		), $atts ) );

$id = Mk_Static_Files::shortcode_id();


$animation_css = ($animation != '') ? (' class="mk-animate-element ' . $animation . '" ') : '';

if($style == 'simple'){
	$border_color = $bg_color = $bg_hover_color = 'transparent';
}

if($skin == 'custom'){
	Mk_Static_Files::addCSS('
		#social-networks-'.$id.' a i{
			color:'.$icon_color.';
		}
		#social-networks-'.$id.' a:hover i{
			color:'.$icon_hover_color.';
		}
		
		#social-networks-'.$id.' a {
			border-color: '.$border_color.' !important;
			background-color: '.$bg_color.';
		}
		#social-networks-'.$id.' a:hover {
			border-color: '.$bg_hover_color.' !important;
			background-color: '.$bg_hover_color.';
		}
	', $id);

}

$output .= '<div class=" '.$el_class.'">';
$output .= '<div id="social-networks-'.$id.'" class="mk-social-network '.$style.'-style social-align-'.$align.' '.$el_class.'">';
$output .= '<ul>';
$output .= !empty( $facebook )  ? '<li'.$animation_css.'><a style="margin: '.$margin.'px;" target="_blank" class="facebook-hover '.$skin.'" href="'.$facebook.'"><i class="mk-icon-facebook"></i></a></li>' : '';
$output .= !empty( $twitter )  ? '<li'.$animation_css.'><a style="margin: '.$margin.'px;" target="_blank" class="twitter-hover '.$skin.'" href="'.$twitter.'"><i class="mk-icon-twitter"></i></a></li>' : '';
$output .= !empty( $rss )  ? '<li'.$animation_css.'><a style="margin: '.$margin.'px;" target="_blank" class="rss-hover '.$skin.'" href="'.$rss.'"><i class="mk-icon-rss"></i></a></li>' : '';
$output .= !empty( $vimeo )  ? '<li'.$animation_css.'><a style="margin: '.$margin.'px;" target="_blank" class="vimeo-hover '.$skin.'" href="'.$vimeo.'"><i class="mk-theme-icon-social-vimeo"></i></a></li>' : '';
$output .= !empty( $dribbble )  ? '<li'.$animation_css.'><a style="margin: '.$margin.'px;" target="_blank" class="dribbble-hover '.$skin.'" href="'.$dribbble.'"><i class="mk-icon-dribbble"></i></a></li>' : '';
$output .= !empty( $instagram )  ? '<li'.$animation_css.'><a style="margin: '.$margin.'px;" target="_blank" class="instagram-hover '.$skin.'" href="'.$instagram.'"><i class="mk-icon-instagram"></i></a></li>' : '';
$output .= !empty( $spotify )  ? '<li'.$animation_css.'><a style="margin: '.$margin.'px;" target="_blank" class="spotify-hover '.$skin.'" href="'.$spotify.'"><i class="mk-theme-icon-social-spotify"></i></a></li>' : '';
$output .= !empty( $pinterest )  ? '<li'.$animation_css.'><a style="margin: '.$margin.'px;" target="_blank" class="pinterest-hover '.$skin.'" href="'.$pinterest.'"><i class="mk-icon-pinterest"></i></a></li>' : '';
$output .= !empty( $google_plus )  ? '<li'.$animation_css.'><a style="margin: '.$margin.'px;" target="_blank" class="googleplus-hover '.$skin.'" href="'.$google_plus.'"><i class="mk-icon-google-plus"></i></a></li>' : '';
$output .= !empty( $linkedin )  ? '<li'.$animation_css.'><a style="margin: '.$margin.'px;" target="_blank" class="linkedin-hover '.$skin.'" href="'.$linkedin.'"><i class="mk-icon-linkedin"></i></a></li>' : '';
$output .= !empty( $youtube )  ? '<li'.$animation_css.'><a style="margin: '.$margin.'px;" target="_blank" class="youtube-hover '.$skin.'" href="'.$youtube.'"><i class="mk-icon-youtube"></i></a></li>' : '';
$output .= !empty( $tumblr )  ? '<li'.$animation_css.'><a style="margin: '.$margin.'px;" target="_blank" class="tumblr-hover '.$skin.'" href="'.$tumblr.'"><i class="mk-icon-tumblr"></i></a></li>' : '';

$output .= !empty( $behance )  ? '<li'.$animation_css.'><a style="margin: '.$margin.'px;" target="_blank" class="behance-hover '.$skin.'" href="'.$behance.'"><i class="mk-theme-icon-behance"></i></a></li>' : '';
$output .= !empty( $whatsapp )  ? '<li'.$animation_css.'><a style="margin: '.$margin.'px;" target="_blank" class="whatsapp-hover '.$skin.'" href="'.$whatsapp.'"><i class="mk-theme-icon-whatsapp"></i></a></li>' : '';
$output .= !empty( $qzone )  ? '<li'.$animation_css.'><a style="margin: '.$margin.'px;" target="_blank" class="qzone-hover '.$skin.'" href="'.$qzone.'"><i class="mk-theme-icon-qzone"></i></a></li>' : '';
$output .= !empty( $vkcom )  ? '<li'.$animation_css.'><a style="margin: '.$margin.'px;" target="_blank" class="vkcom-hover '.$skin.'" href="'.$vkcom.'"><i class="mk-theme-icon-vk"></i></a></li>' : '';
$output .= !empty( $imdb )  ? '<li'.$animation_css.'><a style="margin: '.$margin.'px;" target="_blank" class="imdb-hover '.$skin.'" href="'.$imdb.'"><i class="mk-theme-icon-imdb"></i></a></li>' : '';
$output .= !empty( $renren )  ? '<li'.$animation_css.'><a style="margin: '.$margin.'px;" target="_blank" class="renren-hover '.$skin.'" href="'.$renren.'"><i class="mk-theme-icon-renren"></i></a></li>' : '';
$output .= !empty( $wechat )  ? '<li'.$animation_css.'><a style="margin: '.$margin.'px;" target="_blank" class="wechat-hover '.$skin.'" href="'.$wechat.'"><i class="mk-theme-icon-wechat"></i></a></li>' : '';
$output .= !empty( $weibo )  ? '<li'.$animation_css.'><a style="margin: '.$margin.'px;" target="_blank" class="weibo-hover '.$skin.'" href="'.$weibo.'"><i class="mk-theme-icon-weibo"></i></a></li>' : '';
$output .= '</ul>';
$output .= '</div>';
$output .= '</div>';

echo $output;
