<?php
add_shortcode( 'themeum_social_media', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'color' => '#62A83D',
		'size' => '36',
		'border_color' => 'rgba(255, 255, 255, 0)',
		'background' => '#ffffff',
		'border_width' => '4',
		'border_radius' => '100',
		'padding' => '20',
		'class' => '',
		'facebook_url' => '',
		'twitter_url' => '',
		'gplus_url' => '',
		'linkedin_url' => '',
		'pinterest_url' => '',
		'delicious_url' => '',
		'tumblr_url' => '',
		'stumbleupon_url' => '',
		'apple_url' => '',
		'behance_url' => '',
		'codepen_url' => '',
		'digg_url' => '',
		'dropbox_url' => '',
		'flickr_url' => '',
		'github_url' => '',
		'google_url' => '',
		'hackernews_url' => '',
		'html5_url' => '',
		'instagram_url' => '',
		'joomla_url' => '',
		'reddit_url' => '',
		'skype_url' => '',
		'soundcloud_url' => '',
		'stackoverflow_url' => '',
		'trello_url' => '',
		'vimeo_url' => '',
		'wechat_url' => '',
		'wordpress_url' => '',
		'yahoo_url' => '',
		'envelope_url' => '',
		'heart_url' => '',
		'xing_url' => '',
		'rss_url' => '',
		'jsfiddle_url' => '',
		'windows_url' => '',
		'sharealt_url' => '',
		'vk_url' => '',
		'weibo_url' => '',
		'btc_url' => '',
		'dribble_url' => ''
		), $atts));

	$style = 'text-align:center;';
	$font_size = '';
	$align = '';
	$style_hover='';

	if($color) $style .= 'color:' . $color  . ';';
	if($background) $style .= 'background-color:' . $background  . ';';
	if($padding) $style .= 'padding:' . (int) $padding  . 'px;';
	if($border_color) $style .= 'border-style:solid;border-color:' . $border_color  . ';';
	if($border_width) $style .= 'border-width:' . (int) $border_width  . 'px;';
	if($border_radius) $style .= 'border-radius:' . (int) $border_radius  . 'px;';
	if($size) $style .= 'line-height:' . (int) $size . 'px;';

	if($size) $font_size .= 'font-size:' . (int) $size . 'px;width:' . (int) $size . 'px;height:' . (int) $size . 'px;line-height:' . (int) $size . 'px;';


	$output 	 ='';
	$output 	.= '<div id="social-media">';
	$output 	.= '<ul class="social-media '.$class.'">';

	if(isset($facebook_url) && !empty($facebook_url)) {
		$output 	.= '<li><a class="facebook" style="display:inline-block; '. $style .'" href="' . $facebook_url . '" target="_blank"><i class="fa fa-facebook" style="'. $font_size. '"></i></a></li>';
	}

	if(isset($twitter_url) && !empty($twitter_url)) {
		$output 	.= '<li><a class="twitter" style="display:inline-block; '. $style .'" href="' . $twitter_url . '" target="_blank" ><i class="fa fa-twitter" style="'. $font_size. '"></i></a></li>';
	}	

	if(isset($gplus_url) && !empty($gplus_url)) {
		$output 	.= '<li><a class="g-plus" style="display:inline-block; '. $style .'" href="' . $gplus_url . '" target="_blank"><i class="fa fa-google-plus" style="'. $font_size. '"></i></a></li>';
	}	

	if(isset($linkedin_url) && !empty($linkedin_url)) {
		$output 	.= '<li><a class="linkedin" style="display:inline-block; '. $style .'" href="' . $linkedin_url . '" target="_blank"><i class="fa fa-linkedin" style="'. $font_size. '"></i></a></li>';
	}

	if(isset($pinterest_url) && !empty($pinterest_url)) {
		$output 	.= '<li><a class="pinterest" style="display:inline-block; '. $style .'" href="' . $pinterest_url . '" target="_blank"><i class="fa fa-pinterest" style="'. $font_size. '"></i></a></li>';
	}	

	if(isset($delicious_url) && !empty($delicious_url)) {
		$output 	.= '<li><a class="delicious" style="display:inline-block; '. $style .'" href="' . $delicious_url . '" target="_blank"><i class="fa fa-delicious" style="'. $font_size. '"></i></a></li>';
	}	

	if(isset($tumblr_url) && !empty($tumblr_url)) {
		$output 	.= '<li><a class="tumblr" style="display:inline-block; '. $style .'" href="' . $tumblr_url . '" target="_blank"><i class="fa fa-tumblr" style="'. $font_size. '"></i></a></li>';
	}	

	if(isset($stumbleupon_url) && !empty($stumbleupon_url)) {
		$output 	.= '<li><a class="stumbleupon" style="display:inline-block; '. $style .'" href="' . $stumbleupon_url . '" target="_blank"><i class="fa fa-stumbleupon" style="'. $font_size. '"></i></a></li>';
	}	

	if(isset($dribble_url) && !empty($dribble_url)) {
		$output 	.= '<li><a class="dribbble" style="display:inline-block; '. $style .'" href="' . $dribble_url . '" target="_blank"><i class="fa fa-dribbble" style="'. $font_size. '"></i></a></li>';
	}

	if(isset($apple_url) && !empty($apple_url)) {
		$output 	.= '<li><a class="apple" style="display:inline-block; '. $style .'" href="' . $apple_url . '" target="_blank"><i class="fa fa-apple" style="'. $font_size. '"></i></a></li>';
	}
	
	if(isset($behance_url) && !empty($behance_url)) {
		$output 	.= '<li><a class="behance" style="display:inline-block; '. $style .'" href="' . $behance_url . '" target="_blank"><i class="fa fa-behance" style="'. $font_size. '"></i></a></li>';
	}	
	
	if(isset($codepen_url) && !empty($codepen_url)) {
		$output 	.= '<li><a class="codepen" style="display:inline-block; '. $style .'" href="' . $codepen_url . '" target="_blank"><i class="fa fa-codepen" style="'. $font_size. '"></i></a></li>';
	}
		
	if(isset($digg_url) && !empty($digg_url)) {
		$output 	.= '<li><a class="digg" style="display:inline-block; '. $style .'" href="' . $digg_url . '" target="_blank"><i class="fa fa-digg" style="'. $font_size. '"></i></a></li>';
	}
		
	if(isset($dropbox_url) && !empty($dropbox_url)) {
		$output 	.= '<li><a class="dropbox" style="display:inline-block; '. $style .'" href="' . $dropbox_url . '" target="_blank"><i class="fa fa-dropbox" style="'. $font_size. '"></i></a></li>';
	}
			
	if(isset($flickr_url) && !empty($flickr_url)) {
		$output 	.= '<li><a class="flickr" style="display:inline-block; '. $style .'" href="' . $flickr_url . '" target="_blank"><i class="fa fa-flickr" style="'. $font_size. '"></i></a></li>';
	}	
			
	if(isset($github_url) && !empty($github_url)) {
		$output 	.= '<li><a class="github" style="display:inline-block; '. $style .'" href="' . $github_url . '" target="_blank"><i class="fa fa-github" style="'. $font_size. '"></i></a></li>';
	}
				
	if(isset($google_url) && !empty($google_url)) {
		$output 	.= '<li><a class="google" style="display:inline-block; '. $style .'" href="' . $google_url . '" target="_blank"><i class="fa fa-google" style="'. $font_size. '"></i></a></li>';
	}
				
	if(isset($hackernews_url) && !empty($hackernews_url)) {
		$output 	.= '<li><a class="hacker-news" style="display:inline-block; '. $style .'" href="' . $hackernews_url . '" target="_blank"><i class="fa fa-hacker-news" style="'. $font_size. '"></i></a></li>';
	}

	if(isset($html5_url) && !empty($html5_url)) {
		$output 	.= '<li><a class="html5" style="display:inline-block; '. $style .'" href="' . $html5_url . '" target="_blank"><i class="fa fa-html5" style="'. $font_size. '"></i></a></li>';
	}
	
	if(isset($instagram_url) && !empty($instagram_url)) {
		$output 	.= '<li><a class="instagram" style="display:inline-block; '. $style .'" href="' . $instagram_url . '" target="_blank"><i class="fa fa-instagram" style="'. $font_size. '"></i></a></li>';
	}
	
	if(isset($joomla_url) && !empty($joomla_url)) {
		$output 	.= '<li><a class="joomla" style="display:inline-block; '. $style .'" href="' . $joomla_url . '" target="_blank"><i class="fa fa-joomla" style="'. $font_size. '"></i></a></li>';
	}
		
	if(isset($reddit_url) && !empty($reddit_url)) {
		$output 	.= '<li><a class="reddit" style="display:inline-block; '. $style .'" href="' . $reddit_url . '" target="_blank"><i class="fa fa-reddit" style="'. $font_size. '"></i></a></li>';
	}
		
	if(isset($skype_url) && !empty($skype_url)) {
		$output 	.= '<li><a class="skype" style="display:inline-block; '. $style .'" href="' . $skype_url . '" target="_blank"><i class="fa fa-skype" style="'. $font_size. '"></i></a></li>';
	}
		
	if(isset($soundcloud_url) && !empty($soundcloud_url)) {
		$output 	.= '<li><a class="soundcloud" style="display:inline-block; '. $style .'" href="' . $soundcloud_url . '" target="_blank"><i class="fa fa-soundcloud" style="'. $font_size. '"></i></a></li>';
	}
		
	if(isset($stackoverflow_url) && !empty($stackoverflow_url)) {
		$output 	.= '<li><a class="stack-overflow" style="display:inline-block; '. $style .'" href="' . $stackoverflow_url . '" target="_blank"><i class="fa fa-stack-overflow" style="'. $font_size. '"></i></a></li>';
	}

	if(isset($trello_url) && !empty($trello_url)) {
		$output 	.= '<li><a class="trello" style="display:inline-block; '. $style .'" href="' . $trello_url . '" target="_blank"><i class="fa fa-trello" style="'. $font_size. '"></i></a></li>';
	}

	if(isset($vimeo_url) && !empty($vimeo_url)) {
		$output 	.= '<li><a class="vimeo" style="display:inline-block; '. $style .'" href="' . $vimeo_url . '" target="_blank"><i class="fa fa-vimeo-square" style="'. $font_size. '"></i></a></li>';
	}

	if(isset($wechat_url) && !empty($wechat_url)) {
		$output 	.= '<li><a class="wechat" style="display:inline-block; '. $style .'" href="' . $wechat_url . '" target="_blank"><i class="fa fa-wechat" style="'. $font_size. '"></i></a></li>';
	}

	if(isset($wordpress_url) && !empty($wordpress_url)) {
		$output 	.= '<li><a class="wordpress" style="display:inline-block; '. $style .'" href="' . $wordpress_url . '" target="_blank"><i class="fa fa-wordpress" style="'. $font_size. '"></i></a></li>';
	}

	if(isset($yahoo_url) && !empty($yahoo_url)) {
		$output 	.= '<li><a class="yahoo" style="display:inline-block; '. $style .'" href="' . $yahoo_url . '" target="_blank"><i class="fa fa-yahoo" style="'. $font_size. '"></i></a></li>';
	}

	if(isset($envelope_url) && !empty($envelope_url)) {
		$output 	.= '<li><a class="envelope" style="display:inline-block; '. $style .'" href="' . $envelope_url . '" target="_blank"><i class="fa fa-envelope" style="'. $font_size. '"></i></a></li>';
	}

	if(isset($heart_url) && !empty($heart_url)) {
		$output 	.= '<li><a class="heart" style="display:inline-block; '. $style .'" href="' . $heart_url . '" target="_blank"><i class="fa fa-heart" style="'. $font_size. '"></i></a></li>';
	}

	if(isset($xing_url) && !empty($xing_url)) {
		$output 	.= '<li><a class="xing" style="display:inline-block; '. $style .'" href="' . $xing_url . '" target="_blank"><i class="fa fa-xing" style="'. $font_size. '"></i></a></li>';
	}

	if(isset($rss_url) && !empty($rss_url)) {
		$output 	.= '<li><a class="rss" style="display:inline-block; '. $style .'" href="' . $rss_url . '" target="_blank"><i class="fa fa-rss" style="'. $font_size. '"></i></a></li>';
	}
	
	if(isset($jsfiddle_url) && !empty($jsfiddle_url)) {
		$output 	.= '<li><a class="jsfiddle" style="display:inline-block; '. $style .'" href="' . $jsfiddle_url . '" target="_blank"><i class="fa fa-jsfiddle" style="'. $font_size. '"></i></a></li>';
	}
	
	if(isset($windows_url) && !empty($windows_url)) {
		$output 	.= '<li><a class="windows" style="display:inline-block; '. $style .'" href="' . $windows_url . '" target="_blank"><i class="fa fa-windows" style="'. $font_size. '"></i></a></li>';
	}
	
	if(isset($sharealt_url) && !empty($sharealt_url)) {
		$output 	.= '<li><a class="share-alt" style="display:inline-block; '. $style .'" href="' . $sharealt_url . '" target="_blank"><i class="fa fa-share-alt" style="'. $font_size. '"></i></a></li>';
	}

	if(isset($vk_url) && !empty($vk_url)) {
		$output 	.= '<li><a class="vk" style="display:inline-block; '. $style .'" href="' . $vk_url . '" target="_blank"><i class="fa fa-vk" style="'. $font_size. '"></i></a></li>';
	}
	
	if(isset($weibo_url) && !empty($weibo_url)) {
		$output 	.= '<li><a class="weibo" style="display:inline-block; '. $style .'" href="' . $weibo_url . '" target="_blank"><i class="fa fa-weibo" style="'. $font_size. '"></i></a></li>';
	}

	if(isset($btc_url) && !empty($btc_url)) {
		$output 	.= '<li><a class="btc" style="display:inline-block; '. $style .'" href="' . $btc_url . '" target="_blank"><i class="fa fa-btc" style="'. $font_size. '"></i></a></li>';
	}

	$output 	.= '</ul>';
	$output 	.= '</div>';

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Themeum Social Media", "themeum"),
		"base" => "themeum_social_media",
		'icon' => 'icon-thm-social-media',
		"class" => "",
		"description" => __("Widget Title Heading", "themeum"),
		"category" => __('Themeum', "themeum"),
		"params" => array(
		
			array(
				"type" => "textfield",
				"heading" => __("Custom Size", "themeum"),
				"param_name" => "size",
				"value" => "",
				),	

			array(
				"type" => "colorpicker",
				"heading" => __("Icon Color", "themeum"),
				"param_name" => "color",
				"value" => "",
				),				
				
			array(
				"type" => "colorpicker",
				"heading" => __("Background", "themeum"),
				"param_name" => "background",
				"value" => "",
				),					

			array(
				"type" => "textfield",
				"heading" => __("Border Radius", "themeum"),
				"param_name" => "border_radius",
				"value" => "",
				),	


			array(
				"type" => "textfield",
				"heading" => __("Border Width", "themeum"),
				"param_name" => "border_width",
				"value" => "",
				),	

			array(
				"type" => "colorpicker",
				"heading" => __("Border Color", "themeum"),
				"param_name" => "border_color",
				"value" => "",
				),	

			array(
				"type" => "textfield",
				"heading" => __("Padding ", "themeum"),
				"param_name" => "padding",
				"value" => "",
				),	

			array(
				"type" => "textfield",
				"heading" => __("Custom Class", "themeum"),
				"param_name" => "class",
				"value" => "",
				),										

			array(
				"type" => "textfield",
				"heading" => __("Facebook URL", "themeum"),
				"param_name" => "facebook_url",
				"value" => "",
				),			

			array(
				"type" => "textfield",
				"heading" => __("Twitter URL", "themeum"),
				"param_name" => "twitter_url",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Google Plus URL", "themeum"),
				"param_name" => "gplus_url",
				"value" => "",
				),			

			array(
				"type" => "textfield",
				"heading" => __("Linkedin URL", "themeum"),
				"param_name" => "linkedin_url",
				"value" => "",
				),			

			array(
				"type" => "textfield",
				"heading" => __("Pinterest URL", "themeum"),
				"param_name" => "pinterest_url",
				"value" => "",
				),			

			array(
				"type" => "textfield",
				"heading" => __("Delicious URL", "themeum"),
				"param_name" => "delicious_url",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Tumblr URL", "themeum"),
				"param_name" => "tumblr_url",
				"value" => "",
				),			

			array(
				"type" => "textfield",
				"heading" => __("Stumbleupon URL", "themeum"),
				"param_name" => "stumbleupon_url",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Dribble URL", "themeum"),
				"param_name" => "dribble_url",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Apple URL", "themeum"),
				"param_name" => "apple_url",
				"value" => "",
				),				

			array(
				"type" => "textfield",
				"heading" => __("Behance URL", "themeum"),
				"param_name" => "behance_url",
				"value" => "",
				),				

			array(
				"type" => "textfield",
				"heading" => __("Codepen URL", "themeum"),
				"param_name" => "codepen_url",
				"value" => "",
				),				

			array(
				"type" => "textfield",
				"heading" => __("Digg URL", "themeum"),
				"param_name" => "digg_url",
				"value" => "",
				),				

			array(
				"type" => "textfield",
				"heading" => __("Dropbox URL", "themeum"),
				"param_name" => "dropbox_url",
				"value" => "",
				),	

			array(
				"type" => "textfield",
				"heading" => __("Flickr URL", "themeum"),
				"param_name" => "flickr_url",
				"value" => "",
				),				

			array(
				"type" => "textfield",
				"heading" => __("Github URL", "themeum"),
				"param_name" => "github_url",
				"value" => "",
				),			

			array(
				"type" => "textfield",
				"heading" => __("Google URL", "themeum"),
				"param_name" => "google_url",
				"value" => "",
				),				

			array(
				"type" => "textfield",
				"heading" => __("Hacker News URL", "themeum"),
				"param_name" => "hackernews_url",
				"value" => "",
				),				

			array(
				"type" => "textfield",
				"heading" => __("HTML5 URL", "themeum"),
				"param_name" => "html5_url",
				"value" => "",
				),				

			array(
				"type" => "textfield",
				"heading" => __("Instagram URL", "themeum"),
				"param_name" => "instagram_url",
				"value" => "",
				),			

			array(
				"type" => "textfield",
				"heading" => __("Joomla URL", "themeum"),
				"param_name" => "joomla_url",
				"value" => "",
				),					

			array(
				"type" => "textfield",
				"heading" => __("Reddit URL", "themeum"),
				"param_name" => "reddit_url",
				"value" => "",
				),				

			array(
				"type" => "textfield",
				"heading" => __("Skype URL", "themeum"),
				"param_name" => "skype_url",
				"value" => "",
				),				

			array(
				"type" => "textfield",
				"heading" => __("Soundcloud URL", "themeum"),
				"param_name" => "soundcloud_url",
				"value" => "",
				),	

			array(
				"type" => "textfield",
				"heading" => __("Stack Overflow URL", "themeum"),
				"param_name" => "stackoverflow_url",
				"value" => "",
				),				

			array(
				"type" => "textfield",
				"heading" => __("Trello URL", "themeum"),
				"param_name" => "trello_url",
				"value" => "",
				),				

			array(
				"type" => "textfield",
				"heading" => __("Vimeo URL", "themeum"),
				"param_name" => "vimeo_url",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Wechat URL", "themeum"),
				"param_name" => "wechat_url",
				"value" => "",
				),	

			array(
				"type" => "textfield",
				"heading" => __("Wordpress URL", "themeum"),
				"param_name" => "wordpress_url",
				"value" => "",
				),				

			array(
				"type" => "textfield",
				"heading" => __("Yahoo URL", "themeum"),
				"param_name" => "yahoo_url",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Envelope URL", "themeum"),
				"param_name" => "envelope_url",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Heart URL", "themeum"),
				"param_name" => "heart_url",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Xing URL", "themeum"),
				"param_name" => "xing_url",
				"value" => "",
				),	

			array(
				"type" => "textfield",
				"heading" => __("RSS URL", "themeum"),
				"param_name" => "rss_url",
				"value" => "",
				),	

			array(
				"type" => "textfield",
				"heading" => __("Jsfiddle URL", "themeum"),
				"param_name" => "jsfiddle_url",
				"value" => "",
				),	

			array(
				"type" => "textfield",
				"heading" => __("Windows URL", "themeum"),
				"param_name" => "windows_url",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Sharea Alt URL", "themeum"),
				"param_name" => "sharealt_url",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("VK URL", "themeum"),
				"param_name" => "vk_url",
				"value" => "",
				),

			array(
				"type" => "textfield",
				"heading" => __("Weibo URL", "themeum"),
				"param_name" => "weibo_url",
				"value" => "",
				),	

			array(
				"type" => "textfield",
				"heading" => __("BTC URL", "themeum"),
				"param_name" => "btc_url",
				"value" => "",
				),				

			)
		));
}