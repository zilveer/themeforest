<?php
/**
 * jPlayer Shortcode
 * 
 * @since deTube 1.4
 */
function dp_jplayer_shortcode( $atts ) {
	$formats = array(
		'webm', 'webmv', 'webma',
		'ogg', 'ogv', 'oga',
		'mp4', 'mov', 'm4v', 'm4a',
		'flv', 'fla',
		'mp3', 'wav'
	);
	
	$defaults = array(
		'poster' => '',
		'src' => '',
		'supplied' => '',
		'width' => null,
		'height' => null,
		'ratio' => '16:9', // Supported ascept ratio: 16:9, 16:10, 4:3, 3:2, 1:1, 2.4:1 
		'type' => null,
		'solution' => 'html,flash',
		'autoplay' => false,
		'id' => '',
		'container_id' => '',
		'player_id' => '',
		'media_id' => '',
		'gui_id' => ''
	);
	foreach ( $formats as $format )
		$defaults[$format] = '';
		
	if(is_singular()) {
		$autoplay = get_option('dp_single_video_autoplay');
		$defaults['autoplay'] = $autoplay;
	} else {
		$jplayer = get_option('dp_jplayer');
		$autoplay = !empty($jplayer['autoplay']) ? true : false;
		$defaults['autoplay'] = $autoplay;
	}
	
	$args = shortcode_atts($defaults, $atts);
	
    return dp_jplayer($args);
}
add_shortcode('jplayer', 'dp_jplayer_shortcode');

/**
 * Output jPlayer
 * 
 * @since deTube 1.0
 */
function dp_jplayer($args = array()) {
	$formats = array(
		'webm', 'webmv', 'webma',
		'ogg', 'ogv', 'oga',
		'mp4', 'mov', 'm4v', 'm4a',
		'flv', 'fla',
		'mp3', 'wav'
	);
	
	$defaults = array(
		'swfpath' => get_template_directory_uri().'/js',
		'poster' => '',
		'src' => '',
		'supplied' => '',
		'width' => null,
		'height' => null,
		'ratio' => '16:9', // Supported ascept ratio: 16:9, 16:10, 4:3, 3:2, 1:1, 2.4:1 
		'type' => null,
		'solution' => 'html,flash',
		'autoplay' => false,
		'id' => '',
		'container_id' => '',
		'player_id' => '',
		'media_id' => '',
		'gui_id' => '',
		'echo' => false
	);
	foreach ( $formats as $format )
		$defaults[$format] = '';
	
	$args = wp_parse_args($args, $defaults);
	extract($args);
	
	$files = array();
	
	if(!empty($src) && is_array($src)) {
		$files = $src;
	} else {
		if(!empty($src))
			$files['src'] = $src;
		
		foreach($formats as $format) {
			if(!empty($args[$format]))
				$files[$format] = $args[$format];
		}
	}

	if(empty($files))
		return false;
		
	wp_enqueue_script('jquery-jplayer');
	
	// Set unique ID
	if(!$id)
		$id = md5(uniqid(rand()));
	if(!$container_id)
		$container_id = 'jp-container-'.$id;
	if(!$player_id)
		$player_id = 'jp-player-'.$id;
	if(!$media_id)
		$media_id = 'jp-media-'.$id;
	if(!$gui_id)
		$gui_id = 'jp-gui-'.$id;

	$media = '';
	
	$i = 0; 
	$_supplied = array();
	foreach($files as $file) {
		$file = trim($file);
			
		$format = pathinfo($file, PATHINFO_EXTENSION);
		if($format == 'mp4') {
			$format = ($type == 'audio') ? 'm4a' : 'm4v';
			// $solution = 'flash, html';
		} elseif($format == 'ogg') {
			$format = ($type == 'audio') ? 'oga' : 'ogv';
		} elseif($format == 'webm') {
			$format = ($type == 'audio') ? 'webma' : 'webmv';
		} elseif($format == 'mov')
			$format = 'm4v';

		if(in_array($format, $formats)) {
			if($i != 0)
				$media .= ',';

			$_supplied[] = $format;
			$media .= $format.':"'.$file.'"';
				
			$i++;
		}
	}
	
	if(empty($supplied)) {
		$supplied = array_unique($_supplied);
		$supplied = implode(',', $supplied);
	}

	if($poster)
		$media .= ',poster:"'.$poster.'"';

	$size = array();
	if($width) $size[] = 'width:"'.$width.'"';
	if($height) $size[] =  'height:"'.$height.'"';
	$size = implode(',', $size);
	
	$options = array(
		'ready' => 'function() {
			$(this).jPlayer("setMedia", {'.$media.'})'.($autoplay ? '.jPlayer("play")' : '').';
			
			var poster = $(this).find("img");
			if(!poster.attr("src"))
				poster.remove();
		}',
		'play' => 'function() {
			$(this).next(".jp-video-play").hide();
		}',
		'ended' => 'function() {
			$(this).next(".jp-video-play").show();
		}',
		'pause' => 'function() {
			$(this).next(".jp-video-play").show();
		}',
		'resize' => 'function() {
		}',
		'size' => "{{$size}}",
		'swfPath' => "'{$swfpath}'",
		'cssSelectorAncestor' => "'#{$player_id}'",
		'supplied' => "'{$supplied}'",
		'solution' => "'{$solution}'",
		'smoothPlayBar' => 'true',
		'keyEnabled' => 'true'
	);
	$script = '';
	foreach($options as $key => $val)
		$script[] = $key.':'.$val;

	$script = implode(",\n", $script);
	
	$html = '<script type="text/javascript">
jQuery(document).ready(function($){if(jQuery().jPlayer) {jQuery("#'.$media_id.'").jPlayer({'.$script.'});}});</script>';

	$html .= '
	<div id="'.$container_id.'" class="jp-container jp-ratio jp-ratio-'.str_replace(':', '', $ratio).'" data-ratio="'.$ratio.'">
	<div id="'.$player_id.'" class="jp-player jp-'.$type.'">
	
	<div class="jp-type-single">
		
		<div id="'.$media_id.'" class="jp-media" data-type="'.$type.'"></div>
			
		<div class="jp-video-play">
			<a href="javascript:;" class="jp-video-play-icon" tabindex="1">'.__('Play', 'dp').'</a>
		</div>
		
		<div class="jp-gui" id="'.$gui_id.'">			
			<div class="jp-control">
				<a href="#" class="jp-play" tabindex="1" title="'.__('Play', 'dp').'">'.__('Play', 'dp').'</a>
				<a href="#" class="jp-pause" tabindex="1" title="'.__('Pause', 'dp').'">'.__('Pause', 'dp').'</a>
			</div>
        
			<div class="jp-progress-container">
				<div class="jp-progress">
					<div class="jp-seek-bar">
						<div class="jp-play-bar"></div>
					</div>
				</div>
			</div>
		
			<a href="#" class="jp-mute" tabindex="2" title="'.__('Mute', 'dp').'">'.__('Mute', 'dp').'</a>
			<a href="#" class="jp-unmute" tabindex="2" title="'.__('Unmute', 'dp').'">'.__('Unmute', 'dp').'</a>
			<div class="jp-volume-bar"><div class="jp-volume-bar-value"></div></div>
		
			<a href="#" class="jp-full-screen" tabindex="3" title="'.__('Full screen', 'dp').'">'.__('Full screen', 'dp').'</a>
			<a href="#" class="jp-restore-screen" tabindex="3" title="'.__('Exit full screen', 'dp').'">'.__('Exit full screen', 'dp').'</a>
		</div><!-- end .jp-gui -->
	
	</div><!-- end .jp-type-single -->
	
	</div><!-- end .jp-player -->
	
	<div class="jp-aspect"></div>
	
	</div><!-- end .jp-container -->';
	
	if($echo)
		echo $html;
	else
		return $html;
}

function dp_jplayer_ratio() {
	$ratios = array(
		'16:9' 	=> __('Wide Screen TV', 'dp'),
		'16:10'	=> __('Monitor Screen', 'dp'),
		'4:3'	=> __('Classic TV', 'dp'),
		'3:2'	=> __('Photo Camera', 'dp'),
		'1:1'	=> __('Square', 'dp'),
		'2.4:1'	=> __('Cinemascope', 'dp')
	);
	
	return $ratios;
}