<?php
/**
 * Socials shortcode
 */
class ctSocialsShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Socials';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'socials';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$linksHtml = '';

		if ($fbuser) {
			$linksHtml .= $this->link('http://www.facebook.com/' . $fbuser, $fbtext, 'facebook');
		}
		if ($twituser) {
			$linksHtml .= $this->link('http://www.twitter.com/' . $twituser, $twittext, 'twitter');
		}
		if ($gplususer) {
			$linksHtml .= $this->link('http://www.plus.google.com/' . $gplususer, $gplustext, 'gplus');
		}
		if ($linkedinuser) {
			$linksHtml .= $this->link('http://www.linkedin.com/' . $linkedinuser, $linkedintext, 'linkedin');
		}
		
		if ($pinterestuser) {
			$linksHtml .= $this->link('http://www.pinterest.com/' . $pinterestuser, $pinteresttext, 'pinterest');
		}

		if ($tumblruser) {
			$linksHtml .= $this->link('http://'.$tumblruser.'.tumblr.com/', $tumblrtext, 'tumblr');
		}
		
		if ($delicioususer) {
			$linksHtml .= $this->link('http://delicious.com/' . $delicioususer, $delicioustext, 'delicious');
		}
		if ($deviantartuser) {
			$linksHtml .= $this->link('http://' . $deviantartuser . '.deviantart.com', $deviantarttext, 'deviantart');
		}
		if ($digguser) {
			$linksHtml .= $this->link('http://digg.com/users/' . $digguser, $diggtext, 'digg');
		}
		if ($flickruser) {
			$linksHtml .= $this->link('http://www.flickr.com/photos/' . $flickruser, $flickrtext, 'flickr');
		}
		if ($stumbleuser) {
			$linksHtml .= $this->link('http://' . $stumbleuser . '.stumbleupon.com', $stumbletext, 'stumble');
		}
		if ($youtubeuser) {
			$linksHtml .= $this->link('http://youtube.com/user/' . $youtubeuser, $youtubetext, 'youtube');
		}
		if ($vimeouser) {
			$linksHtml .= $this->link('http://vimeo.com/' . $vimeouser, $vimeotext, 'vimeo');
		}

		if ($dribbbleuser) {
			$linksHtml .= $this->link('http://dribbble.com/' . $dribbbleuser, $dribbbletext, 'dribbble');
		}

		return '<div class="doCenter"><h3 class="vbright vsmall">' . $headertext . '</h3>' . $linksHtml . '</div>';
	}

	protected function link($link, $text, $icon) {
		return '<a target="_blank" href="' . $link . '" class="social"><i class="ico-' . $icon . '"></i>' . $text . '</a>';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'headertext' => array('label' => __("header text", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'fbuser' => array('label' => __("facebook username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'fbtext' => array('label' => __("facebook text", 'ct_theme'), 'default' => '', 'type' => 'input'),

			'twituser' => array('label' => __("twitter username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'twittext' => array('label' => __("twitter text", 'ct_theme'), 'default' => '', 'type' => 'input'),

			'gplususer' => array('label' => __("google+ username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'gplustext' => array('label' => __("google+ text", 'ct_theme'), 'default' => '', 'type' => 'input'),

			'linkedinuser' => array('label' => __("LinkedIn username", 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Try: in/username", 'ct_theme')),
			'linkedintext' => array('label' => __("LinkedIn text", 'ct_theme'), 'default' => '', 'type' => 'input'),

			'pinterestuser' => array('label' => __("Pinterest username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'pinteresttext' => array('label' => __("Pinterest text", 'ct_theme'), 'default' => '', 'type' => 'input'),

			'tumblruser' => array('label' => __("tumblr username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'tumblrtext' => array('label' => __("tumblr text", 'ct_theme'), 'default' => '', 'type' => 'input'),


			'delicioususer' => array('label' => __("Delicious username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'delicioustext' => array('label' => __("Delicious text", 'ct_theme'), 'default' => '', 'type' => 'input'),

			'deviantartuser' => array('label' => __("deviantArt username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'deviantarttext' => array('label' => __("deviantArt text", 'ct_theme'), 'default' => '', 'type' => 'input'),

			'digguser' => array('label' => __("digg username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'diggtext' => array('label' => __("digg text", 'ct_theme'), 'default' => '', 'type' => 'input'),

			'flickruser' => array('label' => __("flickr username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'flickrtext' => array('label' => __("flickr text", 'ct_theme'), 'default' => '', 'type' => 'input'),

			'stumbleuser' => array('label' => __("StumbleUpon username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'stumbletext' => array('label' => __("StumbleUpon text", 'ct_theme'), 'default' => '', 'type' => 'input'),

			'youtubeuser' => array('label' => __("youtube username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'youtubetext' => array('label' => __("youtube text", 'ct_theme'), 'default' => '', 'type' => 'input'),

			'vimeouser' => array('label' => __("vimeo username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'vimeotext' => array('label' => __("vimeo text", 'ct_theme'), 'default' => '', 'type' => 'input'),

			'dribbbleuser' => array('label' => __("dribbble username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'dribbbletext' => array('label' => __("dribbble text", 'ct_theme'), 'default' => '', 'type' => 'input'),
		);
	}
}

new ctSocialsShortcode();