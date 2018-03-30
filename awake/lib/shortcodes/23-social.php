<?php
/**
 *
 */
class mysiteSocial {

	/**
	 *  ReTweet button
	 */
	function tweet( $atts = null, $content = null ) {
	
		if( $atts == 'generator' ) {
			$option = array( 
				"name" => __( "Twitter", MYSITE_ADMIN_TEXTDOMAIN ),
				"value" => "tweet",
				"options" => array(
					array(
						"name" => __( "Twitter Username", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "username",
						"desc" => __( 'Type out your twitter username here.  You can find your twitter username by logging into your twitter account.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __( "Tweet Position", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "layout",
						"desc" => __( 'Choose whether you want your tweets to display vertically, horizontally, or none at all.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"vertical" => __( "Vertical", MYSITE_ADMIN_TEXTDOMAIN ),
							"horizontal" => __( "Horizontal", MYSITE_ADMIN_TEXTDOMAIN ),
							"none" => __( "None", MYSITE_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					array(
						"name" => __( "Custom Text", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "text",
						"desc" => __( 'This is the text that people will include in their Tweet when they share from your website.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __( "Custom URL", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "url",
						"desc" => __( 'By default the URL from your page will be used but you can input a custom URL here.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __( "Related Users", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "related",
						"desc" => __( 'You can input another twitter username for recommendation.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __( "Language", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "lang",
						"desc" => __( 'Select which language you would like to display the button in.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"fr" => __( "French", MYSITE_ADMIN_TEXTDOMAIN ),
							"de" => __( "German", MYSITE_ADMIN_TEXTDOMAIN ),
							"it" => __( "Italian", MYSITE_ADMIN_TEXTDOMAIN ),
							"ja" => __( "Japanese", MYSITE_ADMIN_TEXTDOMAIN ),
							"ko" => __( "Korean", MYSITE_ADMIN_TEXTDOMAIN ),
							"ru" => __( "Russian", MYSITE_ADMIN_TEXTDOMAIN ),
							"es" => __( "Spanish", MYSITE_ADMIN_TEXTDOMAIN ),
							"tr" => __( "Turkish", MYSITE_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					"shortcode_has_atts" => true,
				)
			);

			return $option;
		}
		
		extract(shortcode_atts(array(
			'layout'        => 'vertical',
			'username'		  => '',
			'text' 			  => '',
			'url'			  => '',
			'related'		  => '',
			'lang'			  => '',
	    	), $atts));
	
		if( is_feed() ) return;
	    	
	    if ($text != '') { $text = "data-text='".$text."'"; }
	    if ($url != '') { $url = "data-url='".$url."'"; }
	    if ($related != '') { $related = "data-related='".$related."'"; }
	    if ($lang != '') { $lang = "data-lang='".$lang."'"; }
		
		$out = '<div class = "mysite_sociable"><a href="http://twitter.com/share" class="twitter-share-button" '.$url.' '.$lang.' '.$text.' '.$related.' data-count="'.$layout.'" data-via="'.$username.'">Tweet</a>';
		$out .= '<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div>';
		
		return $out;
	}
	
	/**
	 *  Facebook Like button
	 */
	function fblike( $atts = null, $content = null ) {

	    if( $atts == 'generator' ) {
	        $option = array(
	            "name" => __( "Facebook Like", MYSITE_ADMIN_TEXTDOMAIN ),
	            "value" => "fblike",
	            "options" => array(
	                array(
	                    "name" => __( "Layout", MYSITE_ADMIN_TEXTDOMAIN ),
	                    "id" => "layout",
	                    "desc" => __( 'Choose the layout you would like to use with your facebook button.', MYSITE_ADMIN_TEXTDOMAIN ),
	                    "default" => "",
	                    "options" => array(
	                        "standard" => __( "Standard", MYSITE_ADMIN_TEXTDOMAIN ),
	                        "box_count" => __( "Box Count", MYSITE_ADMIN_TEXTDOMAIN ),
	                        "button_count" => __( "Button Count", MYSITE_ADMIN_TEXTDOMAIN ),
	                    ),
	                    "type" => "select"
	                ),
	                array(
	                    "name" => __( "Add send button?", MYSITE_ADMIN_TEXTDOMAIN ),
	                    "id" => "send",
	                    "desc" => __( 'Check to add the send button alongside the like button.', MYSITE_ADMIN_TEXTDOMAIN ),
	                    'options' => array( 'true' => __( 'Yes', MYSITE_ADMIN_TEXTDOMAIN )),
	                    'default' => '',
	                    'type' => 'checkbox'
	                ),
	                array(
	                    "name" => __( "Show Faces?", MYSITE_ADMIN_TEXTDOMAIN ),
	                    "id" => "show_faces",
	                    "desc" => __( 'Check to display faces.', MYSITE_ADMIN_TEXTDOMAIN ),
	                    'options' => array( 'true' => __( 'Yes', MYSITE_ADMIN_TEXTDOMAIN )),
	                    'default' => '',
	                    'type' => 'checkbox'
	                ),
	                array(
	                    "name" => __( "Action", MYSITE_ADMIN_TEXTDOMAIN ),
	                    "id" => "action",
	                    "desc" => __( 'This is the text that gets displayed on the button.', MYSITE_ADMIN_TEXTDOMAIN ),
	                    "default" => "",
	                    "options" => array(
	                        "like" => __( "Like", MYSITE_ADMIN_TEXTDOMAIN ),
	                        "recommend" => __( "Recommend", MYSITE_ADMIN_TEXTDOMAIN ),
	                    ),
	                    "type" => "select"
	                ),
	                array(
	                    "name" => __( "Font", MYSITE_ADMIN_TEXTDOMAIN ),
	                    "id" => "font",
	                    "desc" => __( 'Select which font you would like to use.', MYSITE_ADMIN_TEXTDOMAIN ),
	                    "default" => "",
	                    "options" => array(
	                        "lucida+grande" => __( "Lucida Grande", MYSITE_ADMIN_TEXTDOMAIN ),
	                        "arial" => __( "Arial", MYSITE_ADMIN_TEXTDOMAIN ),
	                        "segoe+ui" => __( "Segoe Ui", MYSITE_ADMIN_TEXTDOMAIN ),
	                        "tahoma" => __( "Tahoma", MYSITE_ADMIN_TEXTDOMAIN ),
	                        "trebuchet+ms" => __( "Trebuchet MS", MYSITE_ADMIN_TEXTDOMAIN ),
	                        "verdana" => __( "Verdana", MYSITE_ADMIN_TEXTDOMAIN ),
	                    ),
	                    "type" => "select"
	                ),
	                array(
	                    "name" => __( "Color Scheme", MYSITE_ADMIN_TEXTDOMAIN ),
	                    "id" => "colorscheme",
	                    "desc" => __( 'Select the color scheme you would like to use.', MYSITE_ADMIN_TEXTDOMAIN ),
	                    "default" => "",
	                    "options" => array(
	                        "light" => __( "Light", MYSITE_ADMIN_TEXTDOMAIN ),
	                        "dark" => __( "Dark", MYSITE_ADMIN_TEXTDOMAIN ),
	                    ),
	                    "type" => "select"
	                ),
	                "shortcode_has_atts" => true,
	            )
	        );

	        return $option;
	    }

	    extract(shortcode_atts(array(
	            'layout'        => 'box_count',
	            'width'            => '',
	            'height'        => '',
	            'send'            => false,
	            'show_faces'    => false,
	            'action'        => 'like',
	            'font'            => 'lucida+grande',
	            'colorscheme'    => 'light',
	        ), $atts));

	    if( is_feed() ) return;

	    if ($layout == 'standard') { $width = '450'; $height = '35';  if ($show_faces == 'true') { $height = '80'; } }
	    if ($layout == 'box_count') { $width = '55'; $height = '65'; }
	    if ($layout == 'button_count') { $width = '90'; $height = '20'; }

	    $layout = 'data-layout = "'.$layout.'"';
	    $width = 'data-width = "'.$width.'"';
	    $font = 'data-font = "'.str_replace("+", " ", $font).'"';
	    $colorscheme = 'data-colorscheme = "'.$colorscheme.'"';
	    $action = 'data-action = "'.$action.'"';
	    if ( $show_faces ) { $show_faces = 'data-show-faces = "true"'; } else { $show_faces = ''; }
	    if ( $send ) { $send = 'data-send = "true"'; } else { $send = ''; }

	    $out = '<div class = "mysite_sociable">';
	    $out .= '<div id="fb-root"></div><script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";fjs.parentNode.insertBefore(js, fjs);}(document, "script", "facebook-jssdk"));</script>';
	    $out .= '<div class = "fb-like" data-href = "'.get_permalink().'" '.$layout.$width.$font.$colorscheme.$action.$show_faces.$send.'></div>';
	    $out .= '</div>';

	    return $out;
	}
	
	
	/**
	 *  Google +1
	 */
	function googleplusone( $atts = null, $content = null ) {
	
		if( $atts == 'generator' ) {
			$option = array( 
				"name" => __( "Google +1", MYSITE_ADMIN_TEXTDOMAIN ),
				"value" => "googleplusone",
				"options" => array(
					array(
						"name" => __( "Size", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "size",
						"desc" => __( 'Choose how you would like to display the google plus button.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"small" => __( "Small", MYSITE_ADMIN_TEXTDOMAIN ),
							"standard" => __( "Standard", MYSITE_ADMIN_TEXTDOMAIN ),
							"medium" => __( "Medium", MYSITE_ADMIN_TEXTDOMAIN ),
							"tall" => __( "Tall", MYSITE_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					array(
						"name" => __( "Language", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "lang",
						"desc" => __( 'Select which language you would like to display the button in.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"ar" => __( "Arabic", MYSITE_ADMIN_TEXTDOMAIN ),
							"bn" => __( "Bengali", MYSITE_ADMIN_TEXTDOMAIN ),
							"bg" => __( "Bulgarian", MYSITE_ADMIN_TEXTDOMAIN ),
							"ca" => __( "Catalan", MYSITE_ADMIN_TEXTDOMAIN ),
							"zh" => __( "Chinese", MYSITE_ADMIN_TEXTDOMAIN ),
							"zh_CN" => __( "Chinese (China)", MYSITE_ADMIN_TEXTDOMAIN ),
							"zh_HK" => __( "Chinese (Hong Kong)", MYSITE_ADMIN_TEXTDOMAIN ),
							"zh_TW" => __( "Chinese (Taiwan)", MYSITE_ADMIN_TEXTDOMAIN ),
							"hr" => __( "Croation", MYSITE_ADMIN_TEXTDOMAIN ),
							"cs" => __( "Czech", MYSITE_ADMIN_TEXTDOMAIN ),
							"da" => __( "Danish", MYSITE_ADMIN_TEXTDOMAIN ),
							"nl" => __( "Dutch", MYSITE_ADMIN_TEXTDOMAIN ),
							"en_IN" => __( "English (India)", MYSITE_ADMIN_TEXTDOMAIN ),
							"en_IE" => __( "English (Ireland)", MYSITE_ADMIN_TEXTDOMAIN ),
							"en_SG" => __( "English (Singapore)", MYSITE_ADMIN_TEXTDOMAIN ),
							"en_ZA" => __( "English (South Africa)", MYSITE_ADMIN_TEXTDOMAIN ),
							"en_GB" => __( "English (United Kingdom)", MYSITE_ADMIN_TEXTDOMAIN ),
							"fil" => __( "Filipino", MYSITE_ADMIN_TEXTDOMAIN ),
							"fi" => __( "Finnish", MYSITE_ADMIN_TEXTDOMAIN ),
							"fr" => __( "French", MYSITE_ADMIN_TEXTDOMAIN ),
							"de" => __( "German", MYSITE_ADMIN_TEXTDOMAIN ),
							"de_CH" => __( "German (Switzerland)", MYSITE_ADMIN_TEXTDOMAIN ),
							"el" => __( "Greek", MYSITE_ADMIN_TEXTDOMAIN ),
							"gu" => __( "Gujarati", MYSITE_ADMIN_TEXTDOMAIN ),
							"iw" => __( "Hebrew", MYSITE_ADMIN_TEXTDOMAIN ),
							"hi" => __( "Hindi", MYSITE_ADMIN_TEXTDOMAIN ),
							"hu" => __( "Hungarian", MYSITE_ADMIN_TEXTDOMAIN ),
							"in" => __( "Indonesian", MYSITE_ADMIN_TEXTDOMAIN ),
							"it" => __( "Italian", MYSITE_ADMIN_TEXTDOMAIN ),
							"ja" => __( "Japanese", MYSITE_ADMIN_TEXTDOMAIN ),
							"kn" => __( "Kannada", MYSITE_ADMIN_TEXTDOMAIN ),
							"ko" => __( "Korean", MYSITE_ADMIN_TEXTDOMAIN ),
							"lv" => __( "Latvian", MYSITE_ADMIN_TEXTDOMAIN ),
							"ln" => __( "Lingala", MYSITE_ADMIN_TEXTDOMAIN ),
							"lt" => __( "Lithuanian", MYSITE_ADMIN_TEXTDOMAIN ),
							"ms" => __( "Malay", MYSITE_ADMIN_TEXTDOMAIN ),
							"ml" => __( "Malayalam", MYSITE_ADMIN_TEXTDOMAIN ),
							"mr" => __( "Marathi", MYSITE_ADMIN_TEXTDOMAIN ),
							"no" => __( "Norwegian", MYSITE_ADMIN_TEXTDOMAIN ),
							"or" => __( "Oriya", MYSITE_ADMIN_TEXTDOMAIN ),
							"fa" => __( "Persian", MYSITE_ADMIN_TEXTDOMAIN ),
							"pl" => __( "Polish", MYSITE_ADMIN_TEXTDOMAIN ),
							"pt_BR" => __( "Portugese (Brazil)", MYSITE_ADMIN_TEXTDOMAIN ),
							"pt_PT" => __( "Portugese (Portugal)", MYSITE_ADMIN_TEXTDOMAIN ),
							"ro" => __( "Romanian", MYSITE_ADMIN_TEXTDOMAIN ),
							"ru" => __( "Russian", MYSITE_ADMIN_TEXTDOMAIN ),
							"sr" => __( "Serbian", MYSITE_ADMIN_TEXTDOMAIN ),
							"sk" => __( "Slovak", MYSITE_ADMIN_TEXTDOMAIN ),
							"sl" => __( "Slovenian", MYSITE_ADMIN_TEXTDOMAIN ),
							"es" => __( "Spanish", MYSITE_ADMIN_TEXTDOMAIN ),
							"sv" => __( "Swedish", MYSITE_ADMIN_TEXTDOMAIN ),
							"gsw" => __( "Swiss German", MYSITE_ADMIN_TEXTDOMAIN ),
							"ta" => __( "Tamil", MYSITE_ADMIN_TEXTDOMAIN ),
							"te" => __( "Telugu", MYSITE_ADMIN_TEXTDOMAIN ),
							"th" => __( "Thai", MYSITE_ADMIN_TEXTDOMAIN ),
							"tr" => __( "Turkish", MYSITE_ADMIN_TEXTDOMAIN ),
							"uk" => __( "Ukranian", MYSITE_ADMIN_TEXTDOMAIN ),
							"vi" => __( "Vietnamese", MYSITE_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					"shortcode_has_atts" => true,
				)
			);

			return $option;
		}
		
		extract(shortcode_atts(array(
				'size'			=> '',
				'lang'			=> '',
	    ), $atts));
		
		if( is_feed() ) return;
		
	    if ($size != '') { $size = "size='".$size."'"; }
	    if ($lang != '') { $lang = "{lang: '".$lang."'}"; }
	    
		$out = '<div class = "mysite_sociable"><script type="text/javascript" src="https://apis.google.com/js/plusone.js">'.$lang.'</script>';
		$out .= '<g:plusone '.$size.'></g:plusone></div>';
	    		
		return $out;
	}
	
	/**
	 *  Digg button
	 */
	function digg( $atts = null, $content = null ) {
	
		if( $atts == 'generator' ) {
			$option = array( 
				"name" => __( "Digg", MYSITE_ADMIN_TEXTDOMAIN ),
				"value" => "digg",
				"options" => array(
					array(
						"name" => __( "Layout", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "layout",
						"desc" => __( 'Choose how you would like to display the digg button.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"DiggWide" => __( "Wide", MYSITE_ADMIN_TEXTDOMAIN ),
							"DiggMedium" => __( "Medium", MYSITE_ADMIN_TEXTDOMAIN ),
							"DiggCompact" => __( "Compact", MYSITE_ADMIN_TEXTDOMAIN ),
							"DiggIcon" => __( "Icon", MYSITE_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					array(
						"name" => __( "Custom URL", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "url",
						"desc" => __( 'In case you wish to use a different URL you can input it here.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __( "Custom Title", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "title",
						"desc" => __( 'In case you wish to use a different title you can input it here.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __( "Article Type", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "type",
						"desc" => __( 'You can set the article type here for digg.<br /><br />For example if you wanted to set it in the gaming or entertainment topics then you would type this, "gaming, entertainment".', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __( "Custom Description", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "description",
						"desc" => __( 'You can set a custom description to be displayed within digg here.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __( "Related Stories", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "related",
						"desc" => __( 'This option allows you to specify whether links to related stories should be present in the pop up window that may appear when users click the button.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"true" => __( "Disable related stories?", MYSITE_ADMIN_TEXTDOMAIN ),
						),
						"type" => "checkbox"
					),
					"shortcode_has_atts" => true,
				)
			);			
			
			return $option;
		}
				
		extract(shortcode_atts(array(
			'layout'        => 'DiggMedium',
			'url'			=> get_permalink(),
			'title'			=> '',
			'type'			=> '',
			'description'	=> '',
			'related'		=> '',
	    	), $atts));
	
		if( is_feed() ) return;
	    
	    if ($title != '') { $title = "&title='".$title."'"; }
	    if ($type != '') { $type = "rev='".$type."'"; }
	    if ($description != '') { $description = "<span style = 'display: none;'>".$description."</span>"; }
	    if ($related != '') { $related = "&related=no"; }
	    	
		$out = '<div class = "mysite_sociable"><a class="DiggThisButton '.$layout.'" href="http://digg.com/submit?url='.$url.$title.$related.'"'.$type.'>'.$description.'</a>';
		$out .= '<script type = "text/javascript" src = "http://widgets.digg.com/buttons.js"></script></div>';
		
		return $out;
	}
	
	/**
	 *  Stumbleupon button
	 */
	function stumbleupon( $atts = null, $content = null ) {
	
		if( $atts == 'generator' ) {
			$option = array( 
				"name" => __( "Stumbleupon", MYSITE_ADMIN_TEXTDOMAIN ),
				"value" => "stumbleupon",
				"options" => array(
					array(
						"name" => __( "Layout", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "layout",
						"desc" => __( 'Choose how you would like to display the stumbleupon button.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"1" => __( "Style 1", MYSITE_ADMIN_TEXTDOMAIN ),
							"2" => __( "Style 2", MYSITE_ADMIN_TEXTDOMAIN ),
							"3" => __( "Style 3", MYSITE_ADMIN_TEXTDOMAIN ),
							"4" => __( "Style 4", MYSITE_ADMIN_TEXTDOMAIN ),
							"5" => __( "Style 5", MYSITE_ADMIN_TEXTDOMAIN ),
							"6" => __( "Style 6", MYSITE_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					array(
						"name" => __( "Custom URL", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "url",
						"desc" => __( 'You can set a custom URL to be displayed within stumbleupon here.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					"shortcode_has_atts" => true,
				)
			);			
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'layout'        => '5',
			'url'			=> '',
	    	), $atts));
	
		if( is_feed() ) return;
	    	
	    if ($url != '') { $url = "&r=".$url; }
	    	
		return '<div class = "mysite_sociable"><script src="http://www.stumbleupon.com/hostedbadge.php?s='.$layout.$url.'"></script></div>';
	}
	
	/**
	 *  Reddit button
	 */
	function reddit( $atts = null, $content = null ) {
	
		if( $atts == 'generator' ) {
			$option = array( 
				"name" => __( "Reddit", MYSITE_ADMIN_TEXTDOMAIN ),
				"value" => "reddit",
				"options" => array(
					array(
						"name" => __( "Layout", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "layout",
						"desc" => __( 'Choose how you would like to display the reddit button.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"1" => __( "Style 1", MYSITE_ADMIN_TEXTDOMAIN ),
							"2" => __( "Style 2", MYSITE_ADMIN_TEXTDOMAIN ),
							"3" => __( "Style 3", MYSITE_ADMIN_TEXTDOMAIN ),
							"4" => __( "Style 4", MYSITE_ADMIN_TEXTDOMAIN ),
							"5" => __( "Style 5", MYSITE_ADMIN_TEXTDOMAIN ),
							"6" => __( "Style 6", MYSITE_ADMIN_TEXTDOMAIN ),
							"7" => __( "Interactive 1", MYSITE_ADMIN_TEXTDOMAIN ),
							"8" => __( "Interactive 2", MYSITE_ADMIN_TEXTDOMAIN ),
							"9" => __( "Interactive 3", MYSITE_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					array(
						"name" => __( "Custom URL", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "url",
						"desc" => __( 'You can set a custom URL to be displayed with your button instead of the current page.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __( "Custom Title", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "title",
						"desc" => __( 'If using the interactive buttons you can specify a custom title to use here.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __( "Styling", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "disablestyle",
						"desc" => __( 'Checking this will disable the reddit styling used for the button.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"true" => __( "Disable reddit styling?", MYSITE_ADMIN_TEXTDOMAIN ),
						),
						"type" => "checkbox"
					),
					array(
						"name" => __( "Target", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "target",
						"desc" => __( 'Select the target for this button.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"true" => __( "Display in new window?", MYSITE_ADMIN_TEXTDOMAIN ),
						),
						"type" => "checkbox"
					),
					array(
						"name" => __( "Community", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "community",
						"desc" => __( 'If using the interactive buttons you can specify a community to target here.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					"shortcode_has_atts" => true,
				)
			);			
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'layout'        => '8',
			'url'			=> '',
			'disablestyle'	=> '',
			'target'		=> '',
			'community'		=> '',
			'title'			=> '',
	    	), $atts));
	
		if( is_feed() ) return;
	    	
	    if ($disablestyle != '') { $disablestyle = "&styled=off"; }
	    if ($target != '') { $target = "&newwindow=1"; }
	    if ($layout == '7' || $layout == '8' || $layout == '9') { $url = "reddit_url='".$url."';"; } else { if ($url != '') { $url = "&url='".$url."'"; } }
	    if ($title != '') { $title = "reddit_title='".$title."';"; }
	    if ($community != '') { $community = "reddit_target='".$community."';"; }
	    if ($layout == '7' || $layout == '8' || $layout == '9') { $target = "reddit_newwindow='1';"; }
	    	
		switch ($layout)
		{
			case 1: return '<div class = "mysite_sociable"><script type="text/javascript" src="http://www.reddit.com/buttonlite.js?i=0'.$disablestyle.$url.$target.'"></script></div>'; break;
			case 2: return '<div class = "mysite_sociable"><script type="text/javascript" src="http://www.reddit.com/buttonlite.js?i=1'.$disablestyle.$url.$target.'"></script></div>'; break;		
			case 3: return '<div class = "mysite_sociable"><script type="text/javascript" src="http://www.reddit.com/buttonlite.js?i=2'.$disablestyle.$url.$target.'"></script></div>'; break;		
			case 4: return '<div class = "mysite_sociable"><script type="text/javascript" src="http://www.reddit.com/buttonlite.js?i=3'.$disablestyle.$url.$target.'"></script></div>'; break;		
			case 5: return '<div class = "mysite_sociable"><script type="text/javascript" src="http://www.reddit.com/buttonlite.js?i=4'.$disablestyle.$url.$target.'"></script></div>'; break;		
			case 6: return '<div class = "mysite_sociable"><script type="text/javascript" src="http://www.reddit.com/buttonlite.js?i=5'.$disablestyle.$url.$target.'"></script></div>'; break;	
			case 7: $out = '<div class = "mysite_sociable"><script type="text/javascript" src="http://www.reddit.com/static/button/button1.js"></script>'; 
					$out .= '<script type = "text/javascript">'.$url.$title.$community.$target.'</script></div>';
					return $out; break;
			case 8: $out = '<div class = "mysite_sociable"><script type="text/javascript" src="http://www.reddit.com/static/button/button2.js"></script>';
					$out .= '<script type = "text/javascript">'.$url.$title.$community.$target.'</script></div>';
					return $out; break;
			case 9: $out = '<div class = "mysite_sociable"><script type="text/javascript" src="http://www.reddit.com/static/button/button3.js"></script>'; 
					$out .= '<script type = "text/javascript">'.$url.$title.$community.$target.'</script></div>';
					return $out; break;	
		}
	}
	
	/**
	 *  LinkedIn button
	 */
	function linkedin( $atts = null, $content = null ) {
	
		if( $atts == 'generator' ) {
			$option = array( 
				"name" => __( "LinkedIn", MYSITE_ADMIN_TEXTDOMAIN ),
				"value" => "linkedin",
				"options" => array(
					array(
						"name" => __( "Layout", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "layout",
						"desc" => __( 'Choose how you would like to display the linkedin button.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"1" => __( "Style 1", MYSITE_ADMIN_TEXTDOMAIN ),
							"2" => __( "Style 2", MYSITE_ADMIN_TEXTDOMAIN ),
							"3" => __( "Style 3", MYSITE_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					array(
						"name" => __( "Custom URL", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "url",
						"desc" => __( 'You can set a custom URL to be displayed within linkedin here.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					"shortcode_has_atts" => true,
				)
			);			
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'layout'        => '3',
			'url'			=> '',
	    	), $atts));
	
		if( is_feed() ) return;
	    	
	    if ($url != '') { $url = "data-url='".$url."'"; }
	    if ($layout == '2') { $layout = 'right'; }
		if ($layout == '3') { $layout = 'top'; }
	    	
		return '<div class = "mysite_sociable"><script type="text/javascript" src="http://platform.linkedin.com/in.js"></script><script type="in/share" data-counter = "'.$layout.'" '.$url.'></script></div>';
	}
	
	/**
	 *  Delicious button
	 */
	function delicious( $atts = null, $content = null ) {
	
		if( $atts == 'generator' ) {
			$option = array( 
				"name" => __( "Delicious", MYSITE_ADMIN_TEXTDOMAIN ),
				"value" => "delicious",
				"options" => array(
					array(
						"name" => __( "Custom Text", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "text",
						"desc" => __( 'You can set some text to display alongside your delicious button.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					"shortcode_has_atts" => true,
				)
			);			
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'text'			=> '',
	    ), $atts));
	
		if( is_feed() ) return;
	    	
		return '<div class = "mysite_sociable"><img src="http://www.delicious.com/static/img/delicious.small.gif" height="10" width="10" alt="Delicious" />&nbsp;<a href="http://www.delicious.com/save" onclick="window.open(&#39;http://www.delicious.com/save?v=5&noui&jump=close&url=&#39;+encodeURIComponent(location.href)+&#39;&title=&#39;+encodeURIComponent(document.title), &#39;delicious&#39;,&#39;toolbar=no,width=550,height=550&#39;); return false;">'.$text.'</a></div>';
	}
	
	/**
	 *  Pinterest button
	 */
	function pinterest( $atts = null, $content = null ) {
	
		if( $atts == 'generator' ) {
			$option = array( 
				"name" => __( "Pinterest", MYSITE_ADMIN_TEXTDOMAIN ),
				"value" => "pinterest",
				"options" => array(
					array(
						"name" => __( "Description", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "text",
						"desc" => __( 'You can set some text to display alongside your Pinterest button.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text"
					),
					array(
						"name" => __( "Layout", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "layout",
						"desc" => __( 'Choose how you would like to display the Pinterest button.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"options" => array(
							"horizontal" => __( "Horizontal", MYSITE_ADMIN_TEXTDOMAIN ),
							"vertical" => __( "Vertical", MYSITE_ADMIN_TEXTDOMAIN ),
							"none" => __( "None", MYSITE_ADMIN_TEXTDOMAIN ),
						),
						"type" => "select"
					),
					array(
						"name" => __( "Image URL", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "image",
						"desc" => __( 'Paste the URL of the image you want to be pinned here.', MYSITE_ADMIN_TEXTDOMAIN ),
						"default" => "",
						"type" => "text",
					),
					array(
						"name" => __( "Auto Prompt", MYSITE_ADMIN_TEXTDOMAIN ),
						"id" => "prompt",
						"desc" => __( 'Check this if you wish to have a prompt display to select your image when clicking on the Pinterest button. This will disable the count bubble.', MYSITE_ADMIN_TEXTDOMAIN ),
						"options" => array( "true" => __( "Use Auto Prompt", MYSITE_ADMIN_TEXTDOMAIN ) ),  
						"default" => "",
						"type" => "checkbox",
					),
					"shortcode_has_atts" => true,
				)
			);			
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'text'			=> '',
			'layout'		=> '',
			'image'			=> '',
			'url'			=> '',
			'prompt'	=> '',
	    ), $atts));
	
		if( is_feed() ) return;
	    	
		if ($url == '') { $url = get_permalink(); }
		if ($layout == '') { $layout = 'horizontal'; }
			
		$out = '<div class = "mysite_sociable"><a href="http://pinterest.com/pin/create/button/?url='.$url.'&media='.$image.'&description='.$text.'" class="pin-it-button" count-layout="'.$layout.'">Pin It</a>';
		$out .= '<script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script></div>';
		
		if ( $prompt ) {
			$out = '<div class = "mysite_sociable"><a title="Pin It on Pinterest" class="pin-it-button" href="javascript:void(0)">pin it</a>';
			$out .= '<script type = "text/javascript">';
			$out .= 'jQuery(document).ready(function(){';
				$out .= 'jQuery(".pin-it-button").click(function(event) {';
				$out .= 'event.preventDefault();';
				$out .= 'jQuery.getScript("http://assets.pinterest.com/js/pinmarklet.js?r=" + Math.random()*99999999);';
				$out .= '});';
			$out .= '});';
			$out .= '</script>';
			$out .= '<style type = "text/css">a.pin-it-button {position: absolute;background: url(http://assets.pinterest.com/images/pinit6.png);font: 11px Arial, sans-serif;text-indent: -9999em;font-size: .01em;color: #CD1F1F;height: 20px;width: 43px;background-position: 0 -7px;}a.pin-it-button:hover {background-position: 0 -28px;}a.pin-it-button:active {background-position: 0 -49px;}</style></div>';
		}
			
		return $out;
	}
	
	/**
	 *
	 */
	function _options( $class ) {
		$shortcode = array();
		
		$class_methods = get_class_methods( $class );
		
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' )
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
		}
		
		$options = array(
			"name" => __( 'Social', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of social button you wish to use.', MYSITE_ADMIN_TEXTDOMAIN ),
			"value" => "social",
			"options" => $shortcode,
			"shortcode_has_types" => true
		);
		
		return $options;
	}
}

?>