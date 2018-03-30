<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * CMSMasters Shortcodes
 * Created by CMSMasters
 * 
 */


/**
 * Information Box Shortcode
 */
function cmsmasters_info_box($atts, $content = null) {
    extract(shortcode_atts(array( 
		'box_type' => '' 
    ), $atts));
	
	
    return '<aside class="box ' . $box_type . '_box">' . 
        '<table>' . 
            '<tbody>' . 
                '<tr>' . 
                    '<td>&nbsp;</td>' . 
                    '<td>' . do_shortcode($content) . '</td>' . 
                '</tr>' . 
            '</tbody>' . 
        '</table>' . 
    '</aside>';
}

add_shortcode('info_box', 'cmsmasters_info_box');



/**
 * Featured Block Shortcode
 */
function cmsmasters_featured_block($atts, $content = null) {
    extract(shortcode_atts(array(  
		'button' => '', 
		'buttontext' => '', 
        'buttonlink' => '#', 
        'buttonicon' => '', 
        'target' => '' 
    ), $atts));
    
	
    $out = '<div class="featured_block">' . 
		'<div class="colored_title">' . 
			'<div class="colored_title_inner">' . 
				do_shortcode($content) . 
			'</div>' . 
		'</div>';
	
	
	if ($button != '') {
        $out .= '<a class="colored_button" href="' . $buttonlink . '" title="' . $buttontext . '"';
		
		
		if ($target == '_blank') {
			$out .= ' target="' . $target . '"';
		}
		
		
		$out .= '><span class="icon_banner icon_' . $buttonicon . '"></span><span>' . $buttontext . '</span>' . 
			'</a>';
    }
	
	
	$out .= '</div>';
    
	
    return $out;
}

add_shortcode('featured_block', 'cmsmasters_featured_block');



/**
 * Colored Block Shortcode
 */
function cmsmasters_colored_block($atts, $content = null) {
    extract(shortcode_atts(array( 
		'bgcolor' => '#ff6f24'
    ), $atts));
	
	$id = uniqid();
	
	$out = '<style>' . 
		'#colored_banner_' . $id . '.colored_banner:before {border-left-color:' . $bgcolor . ';} ' . 
		'#colored_banner_' . $id . '.colored_banner:after {border-right-color:' . $bgcolor . ';} ' .
	'</style>' . 
    '<div id="colored_banner_' . $id . '" class="colored_banner">' . 
		'<div class="colored_banner_outer" style="background-color:' . $bgcolor . ';">' . 
			'<div class="colored_banner_inner">' . 
				do_shortcode($content) . 
			'</div>' . 
		'</div>' . 
	'</div>';
    
	
    return $out;
}

add_shortcode('colored_block', 'cmsmasters_colored_block');



/**
 * Person Block Shortcode
 */
function cmsmasters_person_block($atts, $content = null) {
    extract(shortcode_atts(array(  
		'image' => '', 
		'title' => '', 
        'subtitle' => '', 
		'links_texts' => '', 
		'links_links' => '' 
    ), $atts));
    
	
	$out = '';
	
	$out .= '<article class="person_block">';
	
		if ($image != '') {
			$out .= '<figure>' . 
				wp_get_attachment_image($image, 'post-thumbnail', false, array( 
					'class' => 'max_width' 
				)) . 
			'</figure>';
		}
		
		$out .= '<div class="person_info">' . 
			'<header class="entry-header person_header">' . 
			'<h4 class="person_title">' . $title . '</h4>';
			
			if ($subtitle != '') {
				$out .= '<p class="person_subtitle">' . $subtitle . '</p>';
			}
			
			$out .= '</header>';
			
			if ($content != '') {
				$out .= do_shortcode($content);
			}
			
			if ($links_texts != '' && $links_links != '') {
				$out .= '<footer class="entry-meta person_footer">';
				$links_texts_array = explode('||_||', $links_texts);
				
				
				$links_links_array = explode('||_||', $links_links);
				
				
				for ($i = 0; $i < count($links_texts_array); $i++) {
					$out .= '<a href="' . $links_links_array[$i] . '" title="' . $links_texts_array[$i] . '" target="_blank">' . $links_texts_array[$i] . '</a>';
					
					
					if (($i + 1) < count($links_texts_array)) {
						$out .= ' / ';
					}
				}
				$out .= '</footer>';
			}
		
		$out .= '</div>' . 
	'</article>';
	
    return $out;
}

add_shortcode('person_block', 'cmsmasters_person_block');



/**
 * Tabs Shortcode
 */
function cmsmasters_tabs($atts, $content = null) {
	$content_new = str_replace('] [', ']|, |[', trim($content));
	
	
	$shortcode_array = explode('|, |', $content_new);
	
	
	$tabs = array();
	
	
	$matches = array();
	
	
	for ($i = 0; sizeof($shortcode_array) > $i; $i++) {
		preg_match_all("/\b(\w+=([\"'])[^\\2]+?\\2)/", $shortcode_array[$i], $pairs);
		
		
		$pairs = $pairs[0];
		
		
		foreach($pairs as $pair) {
			$atr = array_map("trim_quotes_togg", preg_split("/\s*=\s*/", $pair));
			
			
			$tabs[$i][$atr[0]] = $atr[1];
		}
		
		
		$pattern = "/^\[tab\s.+\](.+)\[\/tab\]$/";
		
		
		preg_match($pattern, $shortcode_array[$i], $matches[$i]);
	}
    
	
	$out = '<div class="tab">' . 
		'<ul class="tabs">';
	
	
	foreach($tabs as $tab) {
		$out .= '<li>' . 
			'<a href="#">' . $tab['tab_title'] . '</a>' . 
		'</li>';
	}
	
	
	$out .= '</ul>' . 
	'<div class="tab_content">';
	
	
	foreach($matches as $match) {
		$out .= '<div class="tabs_tab">' . $match[1] . '</div>';
	}
	
	
	$out .= '</div>' . 
	'</div>';
	
	
    return $out;
}

add_shortcode('tabs', 'cmsmasters_tabs');



/**
 * Toggles Shortcode
 */
function cmsmasters_toggles($atts, $content = null) {
	$content_new = str_replace('] [', ']|, |[', trim($content));
	
	
	$shortcode_array = explode('|, |', $content_new);
	
	
	$toggles = array();
	
	
	$matches = array();
	
	
	for ($i = 0; sizeof($shortcode_array) > $i; $i++) {
		preg_match_all("/\b(\w+=([\"'])[^\\2]+?\\2)/", $shortcode_array[$i], $pairs);
		
		
		$pairs = $pairs[0];
		
		
		foreach($pairs as $pair) {
			$atr = array_map("trim_quotes_togg", preg_split("/\s*=\s*/", $pair));
			
			
			$toggles[$i][$atr[0]] = $atr[1];
		}
		
		
		$pattern = "/^\[toggle\s.+\](.+)\[\/toggle\]$/";
		
		
		preg_match($pattern, $shortcode_array[$i], $matches[$i]);
	}
	
	
	$out = '<div class="toggles">';
	
	
	for ($i = 0; $i < count($toggles); $i++) {
		$out .= '<div class="togg">' . 
			'<a href="#" class="tog">' . 
				'<span class="cmsms_check"></span>' . 
				$toggles[$i]['toggle_title'] . 
			'</a>' . 
			'<div class="tab_content">' . $matches[$i][1] . '</div>' . 
		'</div>';
	}
	
	
	$out .= '</div>';
    
	
    return $out;
}

add_shortcode('toggles', 'cmsmasters_toggles');



/**
 * Accordion Shortcode
 */
function cmsmasters_accordion($atts, $content = null) {
	$content_new = str_replace('] [', ']|, |[', trim($content));
	
	
	$shortcode_array = explode('|, |', $content_new);
	
	
	$toggles = array();
	
	
	$matches = array();
	
	
	for ($i = 0; sizeof($shortcode_array) > $i; $i++) {
		preg_match_all("/\b(\w+=([\"'])[^\\2]+?\\2)/", $shortcode_array[$i], $pairs);
		
		
		$pairs = $pairs[0];
		
		
		foreach($pairs as $pair) {
			$atr = array_map("trim_quotes_togg", preg_split("/\s*=\s*/", $pair));
			
			
			$toggles[$i][$atr[0]] = $atr[1];
		}
		
		
		$pattern = "/^\[toggle\s.+\](.+)\[\/toggle\]$/";
		
		
		preg_match($pattern, $shortcode_array[$i], $matches[$i]);
	}
	
	
	$out = '<div class="accordion">';
	
	
	for ($i = 0; $i < count($toggles); $i++) {
		$out .= '<div class="acc">' . 
			'<a href="#" class="tog">' . 
				'<span class="cmsms_check"></span>' . 
				$toggles[$i]['toggle_title'] . 
			'</a>' . 
			'<div class="tab_content">' . $matches[$i][1] . '</div>' . 
		'</div>';
	}
	
	
	$out .= '</div>';
    
	
    return $out;
}

add_shortcode('accordion', 'cmsmasters_accordion');



/**
 * Tour Shortcode
 */
function cmsmasters_tour($atts, $content = null) {
	$content_new = str_replace('] [', ']|, |[', trim($content));
	
	
	$shortcode_array = explode('|, |', $content_new);
	
	
	$tabs = array();
	
	
	$matches = array();
	
	
	for ($i = 0; sizeof($shortcode_array) > $i; $i++) {
		preg_match_all("/\b(\w+=([\"'])[^\\2]+?\\2)/", $shortcode_array[$i], $pairs);
		
		
		$pairs = $pairs[0];
		
		
		foreach($pairs as $pair) {
			$atr = array_map("trim_quotes_togg", preg_split("/\s*=\s*/", $pair));
			
			
			$tabs[$i][$atr[0]] = $atr[1];
		}
		
		
		$pattern = "/^\[tab\s.+\](.+)\[\/tab\]$/";
		
		
		preg_match($pattern, $shortcode_array[$i], $matches[$i]);
	}
    
	
	$out = '<div class="tour_content">' . 
		'<ul class="tour">';
	
	
	foreach($tabs as $tab) {
		$out .= '<li>' . 
			'<a href="#">' . 
				'<span class="cmsms_check"></span>' .
				$tab['tab_title'] . 
			'</a>' . 
		'</li>';
	}
	
	
	$out .= '</ul>' . 
	'<div class="tour_box_content">';
	
	
	foreach($matches as $match) {
		$out .= '<div class="tour_box">' . 
			$match[1] . 
		'</div>';
	}
	
	
	$out .= '</div>' . 
		'<div class="cl"></div>' . 
	'</div>';
	
	
    return $out;
}

add_shortcode('tour', 'cmsmasters_tour');



/** 
 * Pricing Table
 **/
function cmsmasters_pricing_table($atts, $content = null) {
    extract(shortcode_atts(array( 
        'title' => '', 
        'buttontext' => '', 
        'buttonlink' => '', 
        'price' => '', 
		'currency' => '', 
		'coins' => '', 
		'period' => '', 
		'bgcolor' => '#58aa30'
    ), $atts));
	
	
	$out = '<div class="cmsms_pricing_table">' . 
		'<div class="cmsms_pricing_table_inner" style="background-color:' . $bgcolor . ';">' . 
			'<h3 class="title">' . $title . '</h3>' . 
			'<span class="cmsms_currency currency">' . $currency . '</span>' . 
			'<span class="cmsms_price price">' . $price . '</span>' . 
			'<span class="cmsms_coins coins">' . $coins . '</span>';
	
		if ($period != '') {
			$out .= '<span class="cmsms_period period">' . $period . '</span>';
		}
	
		$out .= '</div>' . 
		do_shortcode($content) . 
		'<div class="pricing_footer">' . 
			'<a class="button buy" style="background-color:' . $bgcolor . ';" href="' . $buttonlink . '">' . $buttontext . '</a>' . 
		'</div>' . 
	'</div>';
	
	
	return $out;
}

add_shortcode('pricing_table', 'cmsmasters_pricing_table');



/** 
 * Stats
 **/
function cmsmasters_stats($atts, $content = null) {
	return '<div class="percent_parent">' . 
		do_shortcode($content) . 
	'</div>';
}

add_shortcode('stats', 'cmsmasters_stats');



function cmsmasters_stats_bar($atts, $content = null) {
    extract(shortcode_atts(array( 
        'title' => '', 
        'value' => '', 
		'color' => '#ff6f24' 
    ), $atts));
	
	
	return '<div class="percent_item">' . 
		'<div class="percent_item_colored_wrap" style="width:' . $value . '%;">' . 
			'<div class="percent_item_colored" style="background-color:' . $color . ';"></div>' . 
			'<span class="percent_item_text">' . $title . ' </span> ' . 
			'<span class="percent_item_value">' . $value . '%</span>' .
		'</div>' . 
	'</div>';
}

add_shortcode('stats_bar', 'cmsmasters_stats_bar');



/**
 * Embeded Video Shortcode
 */
function cmsmasters_video_widget($atts) {
    extract(shortcode_atts(array( 
        'url' => '' 
    ), $atts));
    
	
    return '<div class="resizable_block">' . 
		get_video_iframe($url) . 
	'</div>';
}

add_shortcode('video', 'cmsmasters_video_widget');



/**
 * HTML5 Video Shortcode
 */
function cmsmasters_html5video_widget($atts, $content = null) {
    extract(shortcode_atts(array( 
		'mp4' => '', 
		'm4v' => '', 
		'ogg' => '', 
		'ogv' => '', 
		'webm' => '', 
		'webmv' => '', 
		'poster' => '', 
		'controls' => '', 
		'autoplay' => '', 
		'loop' => '', 
		'preload' => '' 
	), $atts));
	
	
    $out = '<div class="resizable_block">' . 
		'<video class="fullwidth"';
	
	
    if ($poster != '') {
        $out .= ' poster="' . $poster . '"';
    }
	
	
    if ($controls != '') {
        $out .= ' controls="controls"';
    }
	
	
    if ($autoplay != '') {
        $out .= ' autoplay="autoplay"';
    }
	
	
    if ($loop != '') {
        $out .= ' loop="loop"';
    }
	
	
    if ($preload != '') {
        $out .= ' preload="' . $preload . '"';
    }
	
	
    $out .= '>';
	
	
	if ($mp4 != '') {
        $out .= '<source src="' . $mp4 . '" type="video/mp4" />';
	}
	
	
	if ($m4v != '') {
        $out .= '<source src="' . $m4v . '" type="video/mp4" />';
	}
	
	
	if ($ogg != '') {
        $out .= '<source src="' . $ogg . '" type="video/ogg" />';
	}
	
	
	if ($ogv != '') {
        $out .= '<source src="' . $ogv . '" type="video/ogg" />';
	}
	
	
	if ($webm != '') {
        $out .= '<source src="' . $webm . '" type="video/webm" />';
	}
	
	
	if ($webmv != '') {
        $out .= '<source src="' . $webmv . '" type="video/webm" />';
	}
	
	
	$out .= do_shortcode($content) . 
		'</video>' . 
	'</div>';
	
	
    return $out;
}

add_shortcode('html5video', 'cmsmasters_html5video_widget');



/**
 * Single Video Player Shortcode
 */
function cmsmastersSingleVideoPlayer($atts, $content = null) {
    extract(shortcode_atts(array( 
		'mp4' => '', 
		'm4v' => '', 
		'ogg' => '', 
		'ogv' => '', 
		'webm' => '', 
		'webmv' => '', 
		'poster' => '' 
	), $atts));
	
	
    $unique_id = uniqid();
	
	
    $out = '<script type="text/javascript"> ' . 
        'jQuery(document).ready(function () { ' . 
            "jQuery('#jquery_jplayer_" . $unique_id . "').jPlayer( { " . 
                'ready : function () { ' . 
                    "jQuery(this).jPlayer('setMedia', { ";
					
					
                    if ($mp4 != '') {
                        $out .= "m4v : '" . $mp4 . "', ";
                    }
					
					
                    if ($m4v != '') {
                        $out .= "m4v : '" . $m4v . "', ";
                    }
					
					
                    if ($ogg != '') {
                        $out .= "ogv : '" . $ogg . "', ";
                    }
					
					
                    if ($ogv != '') {
                        $out .= "ogv : '" . $ogv . "', ";
                    }
					
					
                    if ($webm != '') {
                        $out .= "webmv : '" . $webm . "', ";
                    }
					
					
                    if ($webmv != '') {
                        $out .= "webmv : '" . $webmv . "', ";
                    }
					
					
                    $out .= "poster : '" . $poster . "' " . 
                    '} ); ' . 
                '}, ' . 
                "cssSelectorAncestor : '#jp_container_" . $unique_id . "', " . 
                "swfPath : '" . get_template_directory_uri() . "/css/', " . 
                "supplied : 'mp4, m4v, ogg, ogv, webm, webmv', " . 
				'size : { ' . 
					"width : '100%', " . 
					"height : '100%' " . 
				'} ' . 
            '} ); ' . 
        '} ); ' . 
    '</script>' . 
    '<div id="jp_container_' . $unique_id . '" class="jp-video fullwidth">' . 
        '<div class="jp-type-single">' . 
			'<div id="jquery_jplayer_' . $unique_id . '" class="jp-jplayer"></div>' .
			'<div class="jp-gui">' . 
				'<div class="jp-video-play">' . 
					'<a href="javascript:;" class="jp-video-play-icon" tabindex="1" title="' . __('Play', 'cmsmasters') . '">' . __('Play', 'cmsmasters') . '</a>' . 
				'</div>' . 
				'<div class="jp-interface">' . 
					'<div class="jp-progress">' . 
						'<div class="jp-seek-bar">' . 
							'<div class="jp-play-bar"></div>' . 
						'</div>' . 
					'</div>' . 
					'<div class="jp-duration"></div>' . 
					'<div class="jp-time-sep">/</div>' . 
					'<div class="jp-current-time"></div>' . 
					'<div class="jp-controls-holder">' . 
						'<ul class="jp-controls">' . 
							'<li><a href="javascript:;" class="jp-play" tabindex="1" title="' . __('Play', 'cmsmasters') . '"><span>' . __('Play', 'cmsmasters') . '</span></a></li>' . 
							'<li><a href="javascript:;" class="jp-pause" tabindex="1" title="' . __('Pause', 'cmsmasters') . '"><span>' . __('Pause', 'cmsmasters') . '</span></a></li>' . 
							'<li class="li-jp-stop"><a href="javascript:;" class="jp-stop" tabindex="1" title="' . __('Stop', 'cmsmasters') . '"><span>' . __('Stop', 'cmsmasters') . '</span></a></li>' . 
						'</ul>' . 
						'<div class="jp-volume-bar">' . 
							'<div class="jp-volume-bar-value"></div>' . 
						'</div>' . 
						'<ul class="jp-toggles">' . 
							'<li><a href="javascript:;" class="jp-mute" tabindex="1" title="' . __('Mute', 'cmsmasters') . '"><span>' . __('Mute', 'cmsmasters') . '</span></a></li>' . 
							'<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="' . __('Unmute', 'cmsmasters') . '"><span>' . __('Unmute', 'cmsmasters') . '</span></a></li>' . 
							'<li class="li-jp-full-screen"><a href="javascript:;" class="jp-full-screen" tabindex="1" title="' . __('Full Screen', 'cmsmasters') . '"><span>' . __('Full Screen', 'cmsmasters') . '</span></a></li>' . 
							'<li class="li-jp-restore-screen"><a href="javascript:;" class="jp-restore-screen" tabindex="1" title="' . __('Restore Screen', 'cmsmasters') . '"><span>' . __('Restore Screen', 'cmsmasters') . '</span></a></li>' . 
						'</ul>' . 
						'<div class="jp-title">' . 
							'<ul>' . 
								'<li></li>' . 
							'</ul>' . 
						'</div>' . 
					'</div>' . 
				'</div>' . 
				'<div class="jp-no-solution">' . 
					'<span>' . __('Update Required', 'cmsmasters') . ' </span>' . 
					__('To play the media you will need to either update your browser to a recent version or update your', 'cmsmasters') . ' <a href="http://get.adobe.com/flashplayer/" target="_blank">' . __('Flash plugin', 'cmsmasters') . '</a>.' . 
				'</div>' . 
			'</div>' . 
        '</div>' . 
    '</div>';
	
	
    return $out;
}

add_shortcode('single_video_player', 'cmsmastersSingleVideoPlayer');



/**
 * Multiple Video Player Shortcode
 */
function cmsmastersMultipleVideoPlayer($atts, $content = null) {
    $unique_id = uniqid();
	
	
	$out = '<script type="text/javascript"> ' . 
        'jQuery(document).ready(function () { ' . 
            'new jPlayerPlaylist( { ' . 
				"jPlayer : '#jquery_jplayer_" . $unique_id . "', " . 
                "cssSelectorAncestor : '#jp_container_" . $unique_id . "', " . 
			'}, [' . do_shortcode($content) . '], { ' . 
                "swfPath : '" . get_template_directory_uri() . "/css/', " . 
                "supplied : 'mp4, m4v, ogg, ogv, webm, webmv', " . 
				'size : { ' . 
					"width : '100%', " . 
					"height : '100%' " . 
				'} ' . 
            '} ); ' . 
        '} ); ' . 
    '</script>' . 
    '<div id="jp_container_' . $unique_id . '" class="jp-video fullwidth playlist">' . 
		'<div class="jp-type-playlist">' . 
			'<div class="jp-type-list-parent">' . 
				'<div class="jp-type-list">' . 
					'<div id="jquery_jplayer_' . $unique_id . '" class="jp-jplayer"></div>' . 
					'<div class="jp-gui">' . 
						'<div class="jp-video-play">' . 
							'<a href="javascript:;" class="jp-video-play-icon" tabindex="1" title="' . __('Play', 'cmsmasters') . '">' . __('Play', 'cmsmasters') . '</a>' . 
						'</div>' . 
						'<div class="jp-interface">' . 
							'<div class="jp-progress">' . 
								'<div class="jp-seek-bar">' . 
									'<div class="jp-play-bar"></div>' . 
								'</div>' . 
							'</div>' . 
							'<div class="jp-duration"></div>' . 
							'<div class="jp-time-sep">/</div>' . 
							'<div class="jp-current-time"></div>' . 
							'<div class="jp-controls-holder">' . 
								'<ul class="jp-controls">' . 
									'<li><a href="javascript:;" class="jp-play" tabindex="1" title="' . __('Play', 'cmsmasters') . '"><span>' . __('Play', 'cmsmasters') . '</span></a></li>' . 
									'<li><a href="javascript:;" class="jp-pause" tabindex="1" title="' . __('Pause', 'cmsmasters') . '"><span>' . __('Pause', 'cmsmasters') . '</span></a></li>' . 
									'<li class="li-jp-stop"><a href="javascript:;" class="jp-stop" tabindex="1" title="' . __('Stop', 'cmsmasters') . '"><span>' . __('Stop', 'cmsmasters') . '</span></a></li>' . 
									'<li class="li-jp-previous"><a href="javascript:;" class="jp-previous" tabindex="1" title="' . __('Previous', 'cmsmasters') . '"><span>' . __('Previous', 'cmsmasters') . '</span></a></li>' . 
									'<li class="li-jp-next"><a href="javascript:;" class="jp-next" tabindex="1" title="' . __('Next', 'cmsmasters') . '"><span>' . __('Next', 'cmsmasters') . '</span></a></li>' . 
								'</ul>' . 
								'<div class="jp-volume-bar">' . 
									'<div class="jp-volume-bar-value"></div>' . 
								'</div>' . 
								'<ul class="jp-toggles">' . 
									'<li><a href="javascript:;" class="jp-mute" tabindex="1" title="' . __('Mute', 'cmsmasters') . '"><span>' . __('Mute', 'cmsmasters') . '</span></a></li>' . 
									'<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="' . __('Unmute', 'cmsmasters') . '"><span>' . __('Unmute', 'cmsmasters') . '</span></a></li>' . 
									'<li class="li-jp-full-screen"><a href="javascript:;" class="jp-full-screen" tabindex="1" title="' . __('Full Screen', 'cmsmasters') . '"><span>' . __('Full Screen', 'cmsmasters') . '</span></a></li>' . 
									'<li class="li-jp-restore-screen"><a href="javascript:;" class="jp-restore-screen" tabindex="1" title="' . __('Restore Screen', 'cmsmasters') . '"><span>' . __('Restore Screen', 'cmsmasters') . '</span></a></li>' . 
								'</ul>' . 
								'<div class="jp-title">' . 
									'<ul>' . 
										'<li></li>' . 
									'</ul>' . 
								'</div>' . 
							'</div>' . 
						'</div>' . 
						'<div class="jp-no-solution">' . 
							'<span>' . __('Update Required', 'cmsmasters') . '</span>' . 
							__('To play the media you will need to either update your browser to a recent version or update your', 'cmsmasters') . ' <a href="http://get.adobe.com/flashplayer/" target="_blank">' . __('Flash plugin', 'cmsmasters') . '</a>.' . 
						'</div>' . 
					'</div>' . 
				'</div>' . 
			'</div>' . 
			'<div class="jp-playlist">' . 
				'<ul>' . 
					'<li>' . 
						'<div>' . 
							'<a href="javascript:;" class="jp-playlist-item-remove"></a>' . 
							'<a href="javascript:;" class="jp-playlist-item"></a>' . 
						'</div>' . 
					'</li>' . 
				'</ul>' . 
			'</div>' . 
		'</div>' . 
    '</div>';
	
	
    return $out;
}

add_shortcode('multiple_video_player', 'cmsmastersMultipleVideoPlayer');



function cmsmastersPlaylistVideo($atts, $content = null) {
    extract(shortcode_atts(array( 
		'mp4' => '', 
		'm4v' => '', 
		'ogg' => '', 
		'ogv' => '', 
		'webm' => '', 
		'webmv' => '', 
		'poster' => '', 
		'title' => '' 
	), $atts));
	
	
    $out = '{ ';
	
	
    if ($mp4 != '') {
        $out .= "m4v : '" . $mp4 . "', ";
    }
	
	
    if ($m4v != '') {
        $out .= "m4v : '" . $m4v . "', ";
    }
	
	
    if ($ogg != '') {
        $out .= "ogv : '" . $ogg . "', ";
    }
	
	
    if ($ogv != '') {
        $out .= "ogv : '" . $ogv . "', ";
    }
	
	
    if ($webm != '') {
        $out .= "webmv : '" . $webm . "', ";
    }
	
	
    if ($webmv != '') {
        $out .= "webmv : '" . $webmv . "', ";
    }
	
	
    $out .= "poster : '" . $poster . "', " . 
        "title : '" . $title . "' " . 
    '}';
	
	
    return $out;
}

add_shortcode('video_playlist', 'cmsmastersPlaylistVideo');



/**
 * HTML5 Audio Shortcode
 */
function cmsmasters_html5audio_widget($atts, $content = null) {
    extract(shortcode_atts(array( 
        'mp3' => '', 
        'mp4' => '', 
        'm4a' => '', 
        'ogg' => '', 
        'oga' => '', 
        'webm' => '', 
        'webma' => '', 
        'wav' => '', 
		'preload' => 'none', 
		'controls' => '', 
		'autoplay' => '', 
		'loop' => '' 
	), $atts));
	
	
    $out = '<audio style="width:100%;"';
	
	
    if ($controls != '') {
        $out .= ' controls="' . $controls . '"';
    }
	
	
    if ($autoplay != '') {
        $out .= ' autoplay="' . $autoplay . '"';
    }
	
	
    if ($loop != '') {
        $out .= ' loop="' . $loop . '"';
    }
	
	
    if ($preload != 'preload') {
        $out .= ' preload="' . $preload . '"';
    } else {
        $out .= ' preload=""';
    }
	
	
    $out .= '>';
	
	
    if ($mp3 != '') {
        $out .= '<source src="' . $mp3 . '" type="audio/mpeg" />';
    }
	
	
    if ($mp4 != '') {
        $out .= '<source src="' . $mp4 . '" type="audio/mpeg" />';
    }
	
	
    if ($m4a != '') {
        $out .= '<source src="' . $m4a . '" type="audio/mpeg" />';
    }
	
	
    if ($ogg != '') {
        $out .= '<source src="' . $ogg . '" type="audio/ogg" />';
    }
	
	
    if ($oga != '') {
        $out .= '<source src="' . $oga . '" type="audio/ogg" />';
    }
	
	
    if ($webm != '') {
        $out .= '<source src="' . $webm . '" type="audio/webm" />';
    }
	
	
    if ($webma != '') {
        $out .= '<source src="' . $webma . '" type="audio/webm" />';
    }
	
	
    if ($wav != '') {
        $out .= '<source src="' . $wav . '" type="audio/wav" />';
    }
	
	
    $out .= do_shortcode($content) . 
    '</audio>';
	
	
    return $out;
}

add_shortcode('html5audio', 'cmsmasters_html5audio_widget');



/**
 * Single Audio Player Shortcode
 */
function cmsmastersSingleAudioPlayer($atts, $content = null) {
    extract(shortcode_atts(array( 
        'mp3' => '', 
        'mp4' => '', 
        'm4a' => '', 
        'ogg' => '', 
        'oga' => '', 
        'webma' => '', 
        'webm' => '', 
        'wav' => '' 
    ), $atts));
    
	
    $unique_id = uniqid();
    
	
    $out = '<script type="text/javascript"> ' . 
        'jQuery(document).ready(function () { ' . 
            "jQuery('#jquery_jplayer_" . $unique_id . "').jPlayer( { " . 
                'ready : function () { ' . 
                    "jQuery(this).jPlayer('setMedia', { ";
					
					
                    if ($mp3 != '') {
                        $out .= "m4a : '" . $mp3 . "', ";
                    }
					
					
                    if ($mp4 != '') {
                        $out .= "m4a : '" . $mp4 . "', ";
                    }
					
					
                    if ($m4a != '') {
                        $out .= "m4a : '" . $m4a . "', ";
                    }
					
					
                    if ($ogg != '') {
                        $out .= "oga : '" . $ogg . "', ";
                    }
					
					
                    if ($oga != '') {
                        $out .= "oga : '" . $oga . "', ";
                    }
					
					
                    if ($webma != '') {
                        $out .= "webma : '" . $webma . "', ";
                    }
					
					
                    if ($webm != '') {
                        $out .= "webma : '" . $webm . "', ";
                    }
					
					
                    if ($wav != '') {
                        $out .= "wav : '" . $wav . "', ";
                    }
					
					
                    $out .= '} ); ';
					
					
                    $out = str_replace(', }', ' }', $out);
					
					
					$out .= '} , ' . 
                "cssSelectorAncestor : '#jp_container_" . $unique_id . "', " . 
                "swfPath : '" . get_template_directory_uri() . "/css/', " . 
                "supplied : 'mp3, m4a, ogg, oga, webm, webma, wav', " . 
                "wmode : 'window' " . 
            '} ); ' . 
        '} ); ' . 
    '</script>' . 
    '<div id="jquery_jplayer_' . $unique_id . '" class="jp-jplayer" style="display:none;"></div>' . 
    '<div id="jp_container_' . $unique_id . '" class="jp-audio">' . 
        '<div class="jp-type-single">' . 
			'<div class="jp-gui jp-interface">' . 
				'<div class="jp-progress">' . 
					'<div class="jp-seek-bar">' . 
						'<div class="jp-play-bar"></div>' . 
					'</div>' . 
				'</div>' . 
				'<div class="jp-duration"></div>' . 
				'<div class="jp-time-sep">/</div>' . 
				'<div class="jp-current-time"></div>' .
				'<div class="jp-controls-holder">' .  
					'<ul class="jp-controls">' . 
						'<li><a href="javascript:;" class="jp-play" tabindex="1" title="' . __('Play', 'cmsmasters') . '"><span>' . __('Play', 'cmsmasters') . '</span></a></li>' . 
						'<li><a href="javascript:;" class="jp-pause" tabindex="1" title="' . __('Pause', 'cmsmasters') . '"><span>' . __('Pause', 'cmsmasters') . '</span></a></li>' . 
						'<li><a href="javascript:;" class="jp-stop" tabindex="1" title="' . __('Stop', 'cmsmasters') . '"><span>' . __('Stop', 'cmsmasters') . '</span></a></li>' . 
					'</ul>' . 
					'<div class="jp-volume-bar">' . 
						'<div class="jp-volume-bar-value"></div>' . 
					'</div>' . 
					'<ul class="jp-toggles">' . 
						'<li><a href="javascript:;" class="jp-mute" tabindex="1" title="' . __('Mute', 'cmsmasters') . '"><span>' . __('Mute', 'cmsmasters') . '</span></a></li>' . 
						'<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="' . __('Unmute', 'cmsmasters') . '"><span>' . __('Unmute', 'cmsmasters') . '</span></a></li>' . 
					'</ul>' . 
				'</div>' . 
			'</div>' . 
			'<div class="jp-title">' . 
				'<ul>' . 
					'<li></li>' . 
				'</ul>' . 
			'</div>' . 
			'<div class="jp-no-solution">' . 
				'<span>' . __('Update Required', 'cmsmasters') . '</span>' . 
				__('To play the media you will need to either update your browser to a recent version or update your', 'cmsmasters') . ' <a href="http://get.adobe.com/flashplayer/" target="_blank">' . __('Flash plugin', 'cmsmasters') . '</a>.' . 
			'</div>' . 
        '</div>' . 
    '</div>';
    
	
    return $out;
}

add_shortcode('single_audio_player', 'cmsmastersSingleAudioPlayer');



/**
 * Multiple Audio Player Shortcode
 */
function cmsmastersMultipleAudioPlayer($atts, $content = null) {
    $unique_id = uniqid();
	
	
    $out = '<script type="text/javascript"> ' . 
        'jQuery(document).ready(function () { ' . 
            'new jPlayerPlaylist( { ' . 
				"jPlayer : '#jquery_jplayer_" . $unique_id . "', " . 
                "cssSelectorAncestor : '#jp_container_" . $unique_id . "' " . 
			'} , [' . do_shortcode($content) . '], { ' . 
                "swfPath : '" . get_template_directory_uri() . "/css/', " . 
                "supplied : 'mp3, m4a, ogg, oga, webm, webma, wav', " . 
                "wmode : 'window' " . 
            '} ); ' . 
        '} ); ' . 
    '</script>' . 
    '<div id="jquery_jplayer_' . $unique_id . '" class="jp-jplayer" style="display:none;"></div>' . 
	'<div id="jp_container_' . $unique_id . '" class="jp-audio">' . 
		'<div class="jp-type-playlist">' . 
			'<div class="jp-gui jp-interface">' . 
				'<div class="jp-progress">' . 
					'<div class="jp-seek-bar">' . 
						'<div class="jp-play-bar"></div>' . 
					'</div>' . 
				'</div>' . 
				'<div class="jp-duration"></div>' . 
				'<div class="jp-time-sep">/</div>' . 
				'<div class="jp-current-time"></div>' . 
				'<div class="jp-controls-holder">' .  
					'<ul class="jp-controls">' . 
						'<li><a href="javascript:;" class="jp-play" tabindex="1" title="' . __('Play', 'cmsmasters') . '"><span>' . __('Play', 'cmsmasters') . '</span></a></li>' . 
						'<li><a href="javascript:;" class="jp-pause" tabindex="1" title="' . __('Pause', 'cmsmasters') . '"><span>' . __('Pause', 'cmsmasters') . '</span></a></li>' . 
						'<li><a href="javascript:;" class="jp-stop" tabindex="1" title="' . __('Stop', 'cmsmasters') . '"><span>' . __('Stop', 'cmsmasters') . '</span></a></li>' . 
						'<li><a href="javascript:;" class="jp-previous" tabindex="1" title="' . __('Previous', 'cmsmasters') . '"><span>' . __('Previous', 'cmsmasters') . '</span></a></li>' . 
						'<li><a href="javascript:;" class="jp-next" tabindex="1" title="' . __('Next', 'cmsmasters') . '"><span>' . __('Next', 'cmsmasters') . '</span></a></li>' . 
					'</ul>' . 
					'<div class="jp-volume-bar">' . 
						'<div class="jp-volume-bar-value"></div>' . 
					'</div>' . 
					'<ul class="jp-toggles">' . 
						'<li><a href="javascript:;" class="jp-mute" tabindex="1" title="' . __('Mute', 'cmsmasters') . '"><span>' . __('Mute', 'cmsmasters') . '</span></a></li>' . 
						'<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="' . __('Unmute', 'cmsmasters') . '"><span>' . __('Unmute', 'cmsmasters') . '</span></a></li>' . 
					'</ul>' . 
				'</div>' . 
            '</div>' . 
			'<div class="jp-title">' . 
				'<ul>' . 
					'<li></li>' . 
				'</ul>' . 
			'</div>' . 
			'<div class="jp-no-solution">' . 
				'<span>' . __('Update Required', 'cmsmasters') . '</span>' . 
				__('To play the media you will need to either update your browser to a recent version or update your', 'cmsmasters') . ' <a href="http://get.adobe.com/flashplayer/" target="_blank">' . __('Flash plugin', 'cmsmasters') . '</a>.' . 
			'</div>' . 
        '</div>' . 
		'<div class="jp-playlist">' . 
			'<ul>' . 
				'<li>' . 
					'<div>' . 
						'<a href="javascript:;" class="jp-playlist-item-remove"></a>' . 
						'<a href="javascript:;" class="jp-playlist-item"></a>' . 
					'</div>' . 
				'</li>' . 
			'</ul>' . 
		'</div>' . 
    '</div>';
    
	
    return $out;
}

add_shortcode('multiple_audio_player', 'cmsmastersMultipleAudioPlayer');



function cmsmastersPlaylistAudio($atts, $content = null) {
    extract(shortcode_atts(array( 
        'mp3' => '', 
        'mp4' => '', 
        'm4a' => '', 
        'ogg' => '', 
        'oga' => '', 
        'webm' => '', 
        'webma' => '', 
        'wav' => '', 
        'title' => '' 
    ), $atts));
    
	
    $out = '{ ';
	
	
    if ($mp3 != '') {
        $out .= "m4a : '" . $mp3 . "', ";
    }
	
	
    if ($mp4 != '') {
        $out .= "m4a : '" . $mp4 . "', ";
    }
	
	
    if ($m4a != '') {
        $out .= "m4a : '" . $m4a . "', ";
    }
	
	
    if ($ogg != '') {
        $out .= "oga : '" . $ogg . "', ";
    }
	
	
    if ($oga != '') {
        $out .= "oga : '" . $oga . "', ";
    }
	
	
    if ($webma != '') {
        $out .= "webma : '" . $webma . "', ";
    }
	
	
    if ($webm != '') {
        $out .= "webma : '" . $webm . "', ";
    }
	
	
    if ($wav != '') {
        $out .= "wav : '" . $wav . "', ";
    }
	
	
    $out .= "title : '" . $title . "' " . 
    '}';
	
	
    return $out;
}

add_shortcode('audio_playlist', 'cmsmastersPlaylistAudio');



/**
 * Post Types Shortcode
 */
function posttype_shortcode($atts, $content = null) {
    extract(shortcode_atts(array( 
		'post_title' => '&nbsp;', 
        'post_type' => 'post', 
        'post_sort' => 'latest', 
        'post_category' => '', 
        'post_number' => '4', 
        'post_slide' => 'false', 
        'show_images' => 'true', 
        'show_content' => 'false', 
        'show_info' => 'false', 
		'show_post_link' => 'false', 
		'post_link_text' => '', 
		'post_link_address' => '' 
    ), $atts));
    
	
	global $cmsms_layout;
	
	
	$unid = uniqid();
	
	
    $queryArgs = array( 
		'posts_per_page' => $post_number, 
		'post_status' => 'publish', 
		'ignore_sticky_posts' => 1, 
		'post_type' => $post_type 
	);
	
	
    switch ($post_sort) {
    case 'category':
        if ($post_type == 'post') {
            $queryArgs['category_name'] = $post_category;
        } else if ($post_type == 'project') {
            $queryArgs['tax_query'] = array(
                array( 
                    'taxonomy' => 'pj-categs', 
                    'field' => 'slug', 
                    'terms' => array($post_category) 
                )
            );
        } else if ($post_type == 'testimonial') {
            $queryArgs['tax_query'] = array(
                array( 
                    'taxonomy' => 'tl-categs', 
                    'field' => 'slug', 
                    'terms' => array($post_category) 
                )
            );
        }
        
		
        break;
    case 'popular':
        $queryArgs['order'] = 'DESC';
        $queryArgs['orderby'] = 'meta_value';
        $queryArgs['meta_key'] = 'cmsms_likes';
        
		
        break;
    }
	
	
	$col_width = ($cmsms_layout == 'fullwidth') ? 'one_fourth' : 'one_third';
    
	
	$col_counter = 0;
	
	
    $posttype_query = new WP_Query($queryArgs);
	
	
	if ($post_slide == 'true') {
		$out = '<section id="portfolio_shortcode_' . $unid . '" class="post_type_shortcode'; 
			if ($post_type == 'testimonial') {
				$out .= ' type_testimonial';
			}
			
			if ($post_type == 'post') {
				$out .= ' type_post';
			}
			
			if ($post_title == '') {
				$post_title = '&nbsp;';
			}
			
			$out .= '"><div class="post_type_shortcode_inner">' . 
			'<h3';
				if ($post_title == '&nbsp;') {
					$out .= ' class="no_title"';
				}
			$out .= '>' . $post_title . '</h3>' . 
			'<script type="text/javascript"> ' . 
				'jQuery(document).ready(function () { ' . 
					"jQuery('#portfolio_shortcode_$unid .post_type_list').cmsmsResponsiveContentSlider( { " . 
						"sliderWidth : '100%', " . 
						"sliderHeight : 'auto', " . 
						'animationSpeed : 500, ' . 
						"animationEffect : 'slide', " . 
						"animationEasing : 'easeInOutExpo', " . 
						'pauseTime : 0, ' . 
						'activeSlide : 1, ' . 
						'touchControls : true, ' . 
						'pauseOnHover : false, ' . 
						'arrowNavigation : true, ' . 
						'slidesNavigation : false ' . 
					'} ); ' . 
				'} ); ' . 
			'</script>' . 
			'<ul class="post_type_list portfolio_container responsiveContentSlider">' . 
				'<li>';
    } else {
		$out = '<section class="post_type_shortcode' . (($post_type == 'post') ? ' type_post' : '') . '"><div class="post_type_shortcode_inner">';
		
		if ($post_title != '') {
			$out .= '<h3 class="no_sliding">' . 
				$post_title . 
				(($show_post_link == 'true' && $post_link_text != '' && $post_link_address) ? '<a href="' . $post_link_address . '" class="cmsms_post_type_link">' . $post_link_text . '</a>' : '') . 
			'</h3>';
		}
	}
    
	
    if ($posttype_query->have_posts()) :
        while ($posttype_query->have_posts()) : $posttype_query->the_post();
			if ($post_type == 'project') {
				$type = get_post_meta(get_the_ID(), 'cmsms_project_format', true);
			} else {
				$type = get_post_format();
			}
			
			
			$classes = '';
			
			
			if ($post_type == 'project') {
				$new_classes = $col_width . ' format-' . $type;
			} elseif ($post_type == 'testimonial') {
				$new_classes = 'one_first';
			} else {
				$new_classes = $col_width;
			}
			
			
			foreach (get_post_class(array($new_classes)) as $class) {
				$classes .= ' ' . $class;
			}
			
			if ($post_type != 'testimonial') {
			
				if ($post_slide == 'true') {
					if ($cmsms_layout == 'fullwidth' && $col_counter == 4) {
						$out .= '</li>' . 
						'<li>';
						
						
						$col_counter = 0;
					} elseif ($cmsms_layout != 'fullwidth' && $col_counter == 3) {
						$out .= '</li>' . 
						'<li>';
						
						
						$col_counter = 0;
					}
				}
			} elseif ($post_slide == 'true') {
				if ($col_counter == 1) {
					$out .= '</li>' . 
					'<li>';
					
					$col_counter = 0;
				}
			}
			
			
			$out .= '<article class="' . ltrim($classes) . '">';
			
			if ($post_type == 'testimonial') {
				$cmsms_testimonial_author = get_post_meta(get_the_ID(), 'cmsms_testimonial_author', true);
				$cmsms_testimonial_author_link = get_post_meta(get_the_ID(), 'cmsms_testimonial_author_link', true);
				$cmsms_testimonial_company = get_post_meta(get_the_ID(), 'cmsms_testimonial_company', true);
			} elseif ($post_type == 'project') {
				$img_number_list = explode(',', str_replace(' ', '', str_replace('img_', '', get_post_meta(get_the_ID(), 'cmsms_project_images', true))));
			} else {
				$img_number_list = explode(',', str_replace(' ', '', str_replace('img_', '', get_post_meta(get_the_ID(), 'cmsms_post_images', true))));
				
				
				$cmsms_post_image_link = get_post_meta(get_the_ID(), 'cmsms_post_image_link', true);
				
				$cmsms_post_link_text = get_post_meta(get_the_ID(), 'cmsms_post_link_text', true);
				
				$cmsms_post_link_address = get_post_meta(get_the_ID(), 'cmsms_post_link_address', true);
			}
			
			if ($post_type != 'testimonial') {
				if ($show_images == 'true' && $post_type != 'post') {
					if ($type == 'slider' || $type == 'album' || $type == 'gallery') {
						if (has_post_thumbnail()) {
							$out .= '<figure>' . 
								'<a class="preloader" href="' . get_permalink() . '"' . ' title="' . cmsms_title(get_the_ID(), false) . '">' . 
									get_the_post_thumbnail(get_the_ID(), 'project-thumb', array( 
										'class' => 'fullwidth', 
										'alt' => cmsms_title(get_the_ID(), false), 
										'title' => cmsms_title(get_the_ID(), false) 
									)) . 
								'</a>' . 
							'</figure>';
						} else if (sizeof($img_number_list) > 0 && !has_post_thumbnail()) {
							$out .= '<figure>' . 
								'<a class="preloader" href="' . get_permalink() . '"' . ' title="' . cmsms_title(get_the_ID(), false) . '">' . 
									wp_get_attachment_image($img_number_list[0], 'project-thumb', false, array( 
										'class' => 'fullwidth', 
										'alt' => cmsms_title(get_the_ID(), false), 
										'title' => cmsms_title(get_the_ID(), false) 
									)) . 
								'</a>' . 
							'</figure>';
						} else {
							$out .= '<figure>' . 
								'<a class="preloader" href="' . get_permalink() . '"' . ' title="' . cmsms_title(get_the_ID(), false) . '">' . 
									'<img src="' . get_template_directory_uri() . '/img/PT-gallery.jpg' . '" alt="' . cmsms_title(get_the_ID(), false) . '" title="' . cmsms_title(get_the_ID(), false) . '" class="fullwidth" />' . 
								'</a>' . 
							'</figure>';
						}
					} else if ($type == 'image' && $cmsms_post_image_link) {
						$out .= cmsms_thumb(get_the_ID(), 'project-thumb', true, false, true, false, true, false, $cmsms_post_image_link);
					} else {
						if (has_post_thumbnail()) {
							$out .= cmsms_thumb(get_the_ID(), 'project-thumb', true, false, true, false, true, false, false);
						} else {
							$out .= '<figure>' . 
								'<a class="preloader" href="' . get_permalink() . '"' . ' title="' . cmsms_title(get_the_ID(), false) . '">' . 
									'<img src="' . get_template_directory_uri() . '/img/PT-' . (($type == 'image' || $type == '') ? 'placeholder' : $type) . '.jpg' . '" alt="' . cmsms_title(get_the_ID(), false) . '" title="' . cmsms_title(get_the_ID(), false) . '" class="fullwidth" />' . 
								'</a>' . 
							'</figure>';
						}
					}
				} else if ($show_images == 'true' && $post_type == 'post' && has_post_thumbnail() != '') {
					$out .= '<figure class="cmsms_post_type_img">' . 
						get_the_post_thumbnail(get_the_ID(), 'thumbnail', array( 
							'alt' => cmsms_title(get_the_ID(), false), 
							'title' => cmsms_title(get_the_ID(), false), 
							'style' => 'width:125px; height:125px;' 
						)) . 
					'</figure>' . "\n";
				}
				
				
				$out .= '<header class="entry-header">';
					if ($type != 'link') {
						$out .= '<h4 class="entry-title">' . 
							'<a href="' . get_permalink() . '">' . cmsms_title(get_the_ID(), false) . '</a>' . 
						'</h4>';
					} else {
						$out .= '<h4 class="entry-title">' . 
							'<a href="' . $cmsms_post_link_address . '">' . $cmsms_post_link_text . '</a>' . 
						'</h4>';
					}
				$out .= '</header>';
				
				if ($show_content == 'true' && theme_excerpt(1, false)) {
					$out .= '<div class="entry-content">' . 
						'<p>' . theme_excerpt(20, false) . '</p>' . 
					'</div>';
				}
				
				if ($show_info == 'true') {
					$out .= '<footer class="entry-meta">';
						if ($post_type == 'project') {
							if (get_the_terms(get_the_ID(), 'pj-sort-categs')) {
								$out .= '<span class="post_category">' . 
									get_the_term_list(get_the_ID(), 'pj-sort-categs', '', ', ', '') . 
								'</span>';
							}
						} else {
							if (get_the_category()) {
								$out .= '<span class="post_category">' . 
									get_the_category_list(', ') . 
								'</span>';
							}
						}
					$out .= '</footer>';
				}
				
				
			} else {
				$out .= '<div class="tl-content_wrap">'; 
					if ($show_images == 'true' && has_post_thumbnail() != '') {
						$out .= '<figure class="tl_author_img">' . 
							get_the_post_thumbnail(get_the_ID(), 'thumbnail', array( 
								'alt' => cmsms_title(get_the_ID(), false), 
								'title' => cmsms_title(get_the_ID(), false), 
								'style' => 'width:125px; height:125px;' 
							)) . 
						'</figure>' . "\n";
					}
					
					$out .= '<div class="tl-content">' . 
						'<blockquote>' . 
							theme_excerpt(60, false) . 
						'</blockquote>' .  "\r\t";
						
						if ($show_info == 'true') {
							if ($cmsms_testimonial_author != '' || $cmsms_testimonial_company != '') {
								$out .= '<div class="tl_author_info">';
									if ( 
										$cmsms_testimonial_author != '' && 
										$cmsms_testimonial_author_link != '' 
									) {
										$out .= '<p class="tl_author"><a target="_blank" href="' . $cmsms_testimonial_author_link . '">' . $cmsms_testimonial_author . '</a></p>' . "\n";
									} elseif ($cmsms_testimonial_author != '') {
										$out .= '<p class="tl_author">' . $cmsms_testimonial_author . '</p>' . "\n";
									}
									
									if ($cmsms_testimonial_company != '') {
										if ($cmsms_testimonial_author != '') {
											$out .= ' / ';
										}
										$out .= '<p class="tl_company">' . $cmsms_testimonial_company . '</p>' . "\n";
									}
								$out .= '</div>';
							}
						}
						
					$out .= '</div>' . 
				'</div>' . "\n";
			}
			
			$out .= '</article>';
			
			
			$col_counter++;
			
			
			if ($post_slide == 'false') {
				if ($cmsms_layout == 'fullwidth' && $col_counter == 4) {
					$out .= '<div class="cl"></div>';
					
					
					$col_counter = 0;
				} elseif ($cmsms_layout != 'fullwidth' && $col_counter == 3) {
					$out .= '<div class="cl"></div>';
					
					
					$col_counter = 0;
				}
			}
        endwhile;
    endif;
	
	if ($post_slide == 'true') {
		$out .= '</li>' . 
		'</ul>';
	}
	
	
    $out .= '<div class="cl"></div>' . 
    '</div></section>';
    
	
    wp_reset_postdata();
    
	
    return $out;
}

add_shortcode('posttype', 'posttype_shortcode');



/**
 * Google Map Shortcode
 */
function cmsmasters_googlemap($atts, $content = null) {
    extract(shortcode_atts(array( 
        'map_type' => 'ROADMAP', 
        'zoom' => '14', 
        'address' => '', 
        'latitude' => '', 
        'longitude' => '', 
        'marker' => '', 
        'popup_html' => '', 
        'popup' => 'false', 
        'scroll_wheel' => 'false', 
        'map_type_control' => 'false', 
        'zoom_control' => 'false', 
        'pan_control' => 'false', 
        'scale_control' => 'false', 
        'street_view_control' => 'false' 
    ), $atts));
    
	
	wp_enqueue_script('gMapAPI');
	wp_enqueue_script('gMap');
    
	
    $id = uniqid();
	
	
    if (isset($latitude) && isset($longitude) && !empty($latitude) && !empty($longitude)) {
        $l = 'latitude : ' . $latitude . ', ' . 
        'longitude : ' . $longitude . ', ';
    } else {
        $l = '';
    }
    
	
    if (isset($marker) && $marker == 'true') {
        if (isset($latitude) && isset($longitude) && !empty($latitude) && !empty($longitude)) {
            $location = 'markers : [ { ' . 
                $l . 
                'html : "' . $popup_html . '", ' . 
                'popup : ' . $popup . 
            ' } ] , ';
        } else {
            $location = 'markers : [ { ' . 
                'address : "' . $address . '", ' . 
                'html : "' . $popup_html . '", ' . 
                'popup : ' . $popup . 
            ' } ] , ';
        }
    } else {
        if (isset($latitude) && isset($longitude) && !empty($latitude) && !empty($longitude)) {
            $location = $l;
        } else {
            $location = 'address : "' . $address . '", ';
        }
    }
    
	
    $options = $location . 
    'zoom : ' . $zoom . ', ' . 
    'maptype : google.maps.MapTypeId.' . $map_type . ', ' . 
    'scrollwheel : ' . $scroll_wheel . ', ' . 
    'mapTypeControl : ' . $map_type_control . ', ' . 
    'zoomControl : ' . $zoom_control . ', ' . 
    'panControl : ' . $pan_control . ', ' . 
    'scaleControl : ' . $scale_control . ', ' . 
    'streetViewControl : ' . $street_view_control;
    
	
    $out = '<div class="resizable_block">' . 
		'<div id="google_map_' . $id . '" class="google_map fullwidth"></div>' . 
	'</div>' . 
    '<script type="text/javascript">' . 
        'jQuery(document).ready(function () { ' . 
            'jQuery("#google_map_' . $id . '").gMap( { ' . $options . ' } );' . 
        ' } );' . 
    '</script>';
    
	
    return $out;
}

add_shortcode('googlemap', 'cmsmasters_googlemap');



/**
 * Content Responsive Slider Shortcode
 */
function cmsmasters_content_slider($atts, $content = null) {
    extract(shortcode_atts(array( 
		'height' => 'auto', 
		'animation_speed' => '500', 
		'effect' => 'slide', 
		'easing' => 'easeInOutExpo', 
		'pause_time' => '7000', 
		'active_slide' => '1', 
		'pause_on_hover' => 'false', 
		'touch_control' => 'true', 
		'slides_control' => 'true', 
		'arrow_control' => 'false' 
	), $atts));
	
	
    $id = uniqid();
	
	
	$images = explode(',', do_shortcode($content));
	
	
    $out = '<div class="shortcode_slideshow slider_shortcode" id="slideshow_' . $id . '">' . 
		'<div class="shortcode_slideshow_body">' . 
			'<script type="text/javascript">' . 
				'jQuery(document).ready(function () { ' . 
					"jQuery('#slideshow_" . $id . " .shortcode_slideshow_slides').cmsmsResponsiveContentSlider( { " . 
						"sliderWidth : '100%', " . 
						"sliderHeight : " . (($height == 'auto') ? "'auto'" : $height) . ", " . 
						'animationSpeed : ' . ($animation_speed * 1000) . ', ' . 
						"animationEffect : '" . $effect . "', " . 
						"animationEasing : '" . $easing . "', " . 
						'pauseTime : ' . ($pause_time * 1000) . ', ' . 
						'activeSlide : ' . $active_slide . ', ' . 
						'pauseOnHover : ' . (($pause_on_hover == 'true') ? 'true' : 'false') . ', ' . 
						'touchControls : ' . (($touch_control == 'true') ? 'true' : 'false') . ', ' . 
						'slidesNavigation : ' . (($slides_control == 'true') ? 'true' : 'false') . ', ' . 
						'slidesNavigationHover : false, ' . 
						'arrowNavigation : ' . (($arrow_control == 'true') ? 'true' : 'false') . ', ' . 
						'arrowNavigationHover : false ' . 
					'} ); ' . 
				'} );' . 
			'</script>' . 
			'<div class="shortcode_slideshow_container">' . 
				'<ul class="shortcode_slideshow_slides responsiveContentSlider">';
	
	
	foreach ($images as $image) { 
		$out .= '<li>' . 
			'<figure>' . 
				wp_get_attachment_image($image, 'full', false, array( 
					'class' => 'fullwidth' 
				)) . 
			'</figure>' . 
		'</li>';
	}
	
	
    $out .= '</ul>' . 
			'</div>' . 
		'</div>' . 
	'</div>' . 
	'<br />';
	
	
    return $out;
}

add_shortcode('content_slider', 'cmsmasters_content_slider');



/**
 * Clients Slider Shortcode
 */
function cmsmasters_clients_slider($atts, $content = null) {
    extract(shortcode_atts(array( 
		'clients_in_page' => '5'
	), $atts));
	
	
    $id = uniqid();
	
	
	$images = explode(',', do_shortcode($content));
	
	
    $out = '<div class="cmsms_clients_slider" id="cmsms_clients_slider' . $id . '">' . 
		'<script type="text/javascript">' . 
			'jQuery(document).ready(function () { ' . 
				"jQuery('#cmsms_clients_slider" . $id . "').cmsmsClientsSlider( { " . 
					"sliderBlock : '#cmsms_clients_slider" . $id . "', " . 
					"sliderItems : '.cmsms_clients_items', " . 
					"clientsInPage : " . $clients_in_page . ", " .
				'} ); ' . 
			'} );' . 
		'</script>' . 
		'<a href="javascript:void(0);" class="cmsms_clients_slider_arrow_prev"></a>' . 
		'<a href="javascript:void(0);" class="cmsms_clients_slider_arrow_next"></a>' . 
		'<ul class="cmsms_clients_items">';
	
	
		foreach ($images as $image) { 
			$link = get_post($image);
			
			
			$out .= '<li class="cmsms_clients_item">' . 
					(($link->post_content != '') ? '<a href="' . $link->post_content . '" target="_blank">' : '') . 
						wp_get_attachment_image($image, 'full', false, array( 
							'class' => 'cmsms_clients_img' 
						)) . 
					(($link->post_content != '') ? '</a>' : '') . 
			'</li>';
		}
	
	
		$out .= '</ul>' . 
	'</div>' . 
	'<br />';
	
	
    return $out;
}

add_shortcode('clients_slider', 'cmsmasters_clients_slider');

