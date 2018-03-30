<?php
/**
 * Audio shortcode
 */
class ctAudioShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Audio';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'audio';
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

		$id = rand(100, 1000);
		$this->addInlineJS($this->getInlineJS($id, $attributes));
		$cParams = array(
			'id'=>'jquery_jplayer_' . $id,
			'class'=>array('jp-jplayer'),
			'data-orig-width'=>$width,
			'data-orig-height'=>$posterheight
		);
		return
				'<div'.$this->buildContainerAttributes($cParams, $atts).'></div>
		<div class="jp-audio" style="width:' . $width . 'px">
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

	/**
	 * returns inline js
	 * @param $id
	 * @param $attributes
	 * @return string
	 */
	protected function getInlineJS($id, $attributes) {
		extract($attributes);

		$media = '';
		if ($poster != "") {
			$media .= 'poster:"' . $poster . '", ';
		}
		if ($mp3 != "") {
			$media .= 'mp3:"' . $mp3 . '", ';
		}
		if ($ogg != "") {
			$media .= 'oga:"' . $ogg . '", ';
		}

		$size = '';
		if (!empty($poster)) {
			$size = 'size:{
                        width:"' . $width . 'px",
                        height:"' . $posterheight . 'px"
                    },';
		}

		$supplied = '';
		if ($ogg != "") {
			$supplied .= 'oga, ';
		}
		if ($mp3 != "") {
			$supplied .= 'mp3, ';
		}

		return 'jQuery(document).ready(function (jQuery) {
		            if (jQuery().jPlayer) {
		                jQuery("#jquery_jplayer_' . $id . '").jPlayer({
		                    ready:function () {
		                        jQuery(this).jPlayer("setMedia", {
									' . $media . '
		                            end:""
		                        });
		                    },
							' . $size . '
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
			'mp3' => array('default' => '', 'type' => 'input', 'label' => __('mp3 file link', 'ct_theme'), 'help' => __('Direct link to .mp3 file', 'ct_theme'), 'example' => "http://www.jplayer.org/audio/mp3/Miaow-07-Bubble.mp3"),
			'ogg' => array('default' => '', 'type' => 'input', 'label' => __('ogg file link', 'ct_theme'), 'help' => __('Direct link to .ogg, .oga file', 'ct_theme'), 'example' => "http://www.jplayer.org/audio/ogg/Miaow-07-Bubble.ogg"),
			'poster' => array('default' => '500', 'type' => 'input', 'label' => __('poster link', 'ct_theme')),
			'posterheight' => array('default' => '', 'type' => 'input', 'label' => __('poster height', 'ct_theme')),
			'width' => array('default' => '500', 'type' => 'input', 'label' => __('Width', 'ct_theme')),
		);
	}
}

new ctAudioShortcode();