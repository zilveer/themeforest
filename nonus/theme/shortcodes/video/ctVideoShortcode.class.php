<?php

/**
 * Video shortcode
 */
class ctVideoShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Video';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'video';
	}

	/**
	 * Add styles
	 */

	public function enqueueHeadScripts() {
		wp_register_style('ct-jplayer-style', CT_THEME_ASSETS . '/css/jplayer.css');
		wp_enqueue_style('ct-jplayer-style');
	}

	public function enqueueScripts() {
		wp_register_script('ct-jplayer', CT_THEME_ASSETS . '/js/jquery.jplayer.min.js', array('jquery'));
		wp_enqueue_script('ct-jplayer');
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		$attributes = shortcode_atts($this->extractShortcodeAttributes($atts), $atts);
		extract($attributes);

		if ($m4v || $ogv) {
			$id = rand(100, 1000);
			$this->addInlineJS($this->getInlineJS($id, $attributes));
			$cParams = array(
					'id' => 'jquery_jplayer_' . $id,
					'class' => array('jp-jplayer'),
					'data-orig-width' => $width,
					'data-orig-height' => $posterheight
			);

			return

					'<div'.$this->buildContainerAttributes($cParams,$atts).'></div>
		<div class="video jp-audio" style="width:' . $width . '">
		  <div class="jp-type-single">
		    <div class="jp-gui jp-interface"  id="jp_interface_' . $id . '" >
		      <ul class="jp-controls">
		        <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
		        <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
		        <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
		        <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
		        <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
		        <li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
		      </ul>
		      <div class="jp-progress">
		        <div class="jp-seek-bar">
		          <div class="jp-play-bar"></div>
		        </div>
		      </div>
		      <div class="jp-volume-bar">
		        <div class="jp-volume-bar-value"></div>
		      </div>
		      <div class="jp-time-holder">
		        <div class="jp-current-time"></div>
		        <div class="jp-duration"></div>
		        <ul class="jp-toggles">
		          <li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
		          <li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
		        </ul>
		      </div>
		    </div>
		    <div class="jp-no-solution">
		      <span>Update Required</span>
		      To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
		    </div>
		  </div>
		</div>
		';

		}

		if ($link) {
			global $wp_embed;
			return $wp_embed->run_shortcode('<div class="videoFrameContainer">[embed]' . $link . '[/embed]</div>');
		}

		if (!$clipid && !$src) {
			return '';
		}
		$url = '';

		switch ($type) {
			case 'youtube':
				$url = 'http://www.youtube.com/embed/' . $clipid;
				break;
			case 'vimeo':
				$url = 'http://player.vimeo.com/video/' . $clipid;
				break;
			case 'dailymotion':
				$url = 'http://www.dailymotion.com/embed/video/' . $clipid;
				break;
			case 'flash':
				return '<div class="videoFrameContainer">
							<object class="flash" width="' . $width . '" height="' . $height . '" type="application/x-shockwave-flash" data="' . $src . '">
								<param name="movie" value="' . $src . '" />
								<param name="allowFullScreen" value="true" />
								<param name="allowscriptaccess" value="always" />
								<param name="play" value="false"/>
								<param name="wmode" value="transparent" />
								<embed src="' . $src . '" type="application/x-shockwave-flash" wmode="transparent" allowscriptaccess="always" allowfullscreen="true" width="' . $width . '" height="' . $height . '" />
							</object>
						</div>';

		}

		if ($params) {
			$url .= '?' . $params;
		}

		$style = 'max-height:' . $height . ';max-width:' . $width . ';';
		if (isset($atts['fullscreen'])) {
			$style = '';
		}
		return "<iframe src=\"{$url}\" style=\"{$style}\" class=\"{$type}\" width=\"$width\" height=\"$height\" frameborder=\"0\"></iframe>";
	}

	/**
	 * returns inline js
	 * @param $id
	 * @param $attributes
	 * @return string
	 */
	protected function getInlineJS($id, $attributes) {
		extract($attributes);

		$media = '';
		if ($m4v != "") {
			$media .= 'm4v:"' . $m4v . '", ';
		}
		if ($ogv != "") {
			$media .= 'ogv:"' . $ogv . '", ';
		}

		$supplied = '';
		if ($m4v != "") {
			$supplied .= 'm4v, ';
		}
		if ($ogv != "") {
			$supplied .= 'ogv, ';
		}

		$autoparam = $autoplay == 'false' ? '.jPlayer("pause",0.1)' : '.jPlayer("play")';

		return 'jQuery(document).ready(function (jQuery) {
			            if (jQuery().jPlayer) {
			                jQuery("#jquery_jplayer_' . $id . '").jPlayer({
			                    ready:function () {
			                        jQuery(this).jPlayer("setMedia", {
										' . $media . '
			                            end:""
			                        })' . $autoparam . ';
			                    },
								size:{
			                        width:"' . $width . '",
			                        height:"' . $height . '"
			                    },
			                    swfPath:"' . get_template_directory_uri() . '/js",
			                    cssSelectorAncestor:"#jp_interface_' . $id . '",
			                    supplied:"' . $supplied . 'all"
			                });
			            }
			        });';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
				'link' => array('default' => '', 'type' => 'input', 'label' => __('Link', 'ct_theme'), 'help' => __('Direct movie link', 'ct_theme'), 'example' => "http://www.youtube.com/watch?v=Vpg9yizPP_g"),
				'type' => array('default' => 'youtube', 'type' => 'select', 'choices' => array('youtube' => 'Youtube', 'vimeo' => 'Vimeo', 'dailymotion' => 'Dailymotion', 'flash' => 'Flash'), 'label' => __('Type', 'ct_theme'), 'help' => __('Video type (used only if link not given)', 'ct_theme')),
				'clipid' => array('default' => '', 'type' => 'input', 'label' => __('Clip id', 'ct_theme'), 'help' => __("Used for Youtube, Vimeo and Dailymotion used only if link not given)", "ct_theme")),
				'src' => array('default' => '', 'type' => 'input', 'label' => __('Flash movie source', 'ct_theme'), 'help' => __("Used only for flash movies", "ct_theme")),
				'm4v' => array('default' => '', 'type' => 'input', 'label' => __('M4V URL', 'ct_theme'), 'help' => __(".m4v self hosted video url", "ct_theme")),
				'ogv' => array('default' => '', 'type' => 'input', 'label' => __('OGV URL', 'ct_theme'), 'help' => __(".ogv self hosted video url", "ct_theme")),
				'width' => array('default' => '500px', 'type' => 'input', 'label' => __('Width', 'ct_theme')),
				'height' => array('default' => '300px', 'type' => 'input', 'label' => __('Height', 'ct_theme')),
				'autoplay' => array('label' => __('autoplay', 'ct_theme'), 'type' => "checkbox", 'default' => 'false', 'help' => __('Autoplay video?', 'ct_theme')),
				'params' => array('default' => '', 'type' => "input", 'label' => __("Additional params", 'ct_theme'), 'help' => __("Params which will be added to url like: type=1&full=1"))
		);
	}
}

new ctVideoShortcode();