<?php

/*
* Displays some video
*/

function ch_video($atts, $content = null){
	$tmp = new shortcode_video;
	return $tmp->get_html($atts, $content);
}
add_shortcode('video', 'ch_video');

class shortcode_video {
	public function get_html($atts, $content) {
		if(!isset($atts['type']))
			return '';

		$size = shortcode_atts(array(
			'width'  => false,
			'height' => false
		), $atts);

		if($size['height'] && !$size['width'])
			$size['width'] = intval($size['height'] * 16 / 9);
		if(!$size['height'] && $size['width'])
			$size['height'] = intval($size['width'] * 9 / 16);
		if(!$size['height'] && !$size['width']) {
			$size['height'] = get_option('video_height', 306);
			$size['width']  = get_option('video_width', 545);
		}

		return $this->$atts['type']($atts, $size, $content);
	}

	private function html5($atts, $size, $content) {
		$atts = shortcode_atts(array(
			'mp4'      => '',
			'webm'     => '',
			'ogg'      => '',
			'src'      => '',
			'autoplay' => false
		), $atts);
		extract($atts);
		extract($size);

		if(preg_match('/\.mp4$/i', $src)) {
			$atts['mp4'] = $src;
		} elseif(preg_match('/\.webm$/i', $src)) {
			$atts['webm'] = $src;
		} elseif(preg_match('/\.og(g|v)/i', $src)) {
			$atts['ogg'] = $src;
		}

		$sources['mp4_source']  = '';
		$sources['webm_source'] = '';
		$sources['ogg_source']  = '';
		$available_sources = array(
			'mp4'  => 'avc1.42E01E, mp4a.40.2',
			'webm' => 'vp8, vorbis',
			'ogg'  => 'theora, vorbis'
		);

		foreach($available_sources as $source => $codecs) {
			if($atts[$source]) {
				$sources[$source . '_source'] = '<source src="' . $atts[$source] . '" type=\'video/' . $source . '; codecs="' . $codecs . '"\'>';
				$sources[$source . '_link'] = '<a href="' . $source . '">' . $source . '</a>';
			}
		}

		if($autoplay) {
			$autoplay_attribute = "autoplay";
			$flow_player_autoplay = ',"autoPlay":true';
		} else {
			$autoplay_attribute = "";
			$flow_player_autoplay = ',"autoPlay":false';
		}

		$content = do_shortcode($content);

		$output = <<<HTML
	<div class="video_frame">
		<video width="{$width}" height="{$height}" controls preload="auto" {$autoplay_attribute}>
			{$sources['mp4_source']}
			{$sources['webm_source']}
			{$sources['ogg_source']}
			<object class="vjs-flash-fallback" width="{$width}" height="{$height}" type="application/x-shockwave-flash"
				data="http://releases.flowplayer.org/swf/flowplayer-3.2.5.swf">
				<param name="movie" value="http://releases.flowplayer.org/swf/flowplayer-3.2.5.swf" />
				<param name="allowfullscreen" value="true" />
				<param name="wmode" value="opaque" />
				<param name="flashvars" value='config={"clip":{"url":"$mp4" $flow_player_autoplay "autoBuffering":true ,"wmode":"opaque"}}' />
			</object>
		</video>
		<div>{$content}</div>
	</div>
HTML;

		return $output;
	}

	private function youtube($atts, $size, $content) {
		extract(shortcode_atts(array(
			'clip_id' => '',
			'src' => '',
		), $atts));
		extract($size);

		if(empty($clip_id)) {
			preg_match('%youtu(?:\.be|be\.com)/(?:.*v(?:/|=)|(?:.*/)?)([a-zA-Z0-9-_]+)%', $src, $matches);

			if(isset($matches[1])) {
				$clip_id = $matches[1];
			}
		}

		if(!empty($clip_id)) {
			return
				"<div class='video_frame'>
					<iframe src='http://www.youtube.com/embed/{$clip_id}?wmode=opaque' width='$width' height='$height'></iframe>
					" . do_shortcode($content) . "
				</div>";
		}
	}

	private function vimeo($atts, $size, $content) {
		extract(shortcode_atts(array(
			'clip_id' => '',
			'src'     => '',
			'title'   => 'false',
		), $atts));
		extract($size);

		if($title != 'false')
			$title = 1;
		else
			$title = 0;

		if(empty($clip_id)) {
			preg_match('%vimeo\.com/(?:.*#|.*/videos/)?([0-9]+)%', $src, $matches);

			if(isset($matches[1])) {
				$clip_id = $matches[1];
			}
		}

		if(!empty($clip_id) && is_numeric($clip_id)) {
			return
				"<div class='video_frame'>
					<iframe src='http://player.vimeo.com/video/$clip_id?title={$title}&amp;byline=0&amp;portrait=0' width='$width' height='$height'></iframe>
					" . do_shortcode($content) . "
				</div>";
		}
	}

	private function dailymotion($atts, $size, $content) {
		extract(shortcode_atts(array(
			'clip_id' => '',
			'src'     => '',
		), $atts));
		extract($size);

		if(empty($clip_id)) {
			preg_match('%dailymotion\.com/video/([a-z\d]+)_%', $src, $matches);

			if(isset($matches[1])) {
				$clip_id = $matches[1];
			}
		}

		if(!empty($clip_id)) {
			return
				"<div class='video_frame'>
					<iframe src='http://www.dailymotion.com/embed/video/$clip_id?width=$width&theme=none&foreground=%23F7FFFD&highlight=%23FFC300&background=%23171D1B&start=&animatedTitle=&iframe=1&additionalInfos=0&autoPlay=0&hideInfos=0&wmode=transparent' width='$width' height='$height'></iframe>
					" . do_shortcode($content) . "
				</div>";
		}
	}
}