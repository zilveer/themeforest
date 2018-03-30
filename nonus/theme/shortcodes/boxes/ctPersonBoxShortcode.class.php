<?php
/**
 * Person Box shortcode
 */
class ctPersonBoxShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Person box';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'person_box';
	}

	/**
	 * Shortcode type
	 * @return string
	 */
	public function getShortcodeType() {
		return self::TYPE_SHORTCODE_ENCLOSING;
	}


	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$preLink = '';
		$postLink = '';
		if ($link) {
			$preLink = '<a href="' . $link . '">';
			$postLink = '</a>';
		}

		$linksHtml = '';
		if ($fb) {
			$linksHtml .= '<a href="http://www.facebook.com/' . $fb . '" target="_blank" data-toggle="tooltip" title="Facebook">Facebook</a>';
		}
		if ($twit) {
			$linksHtml .= '<a href="http://www.twitter.com/' . $twit . '" target="_blank" data-toggle="tooltip" title="Twitter">Twitter</a>';
		}
		if ($google) {
			$linksHtml .= '<a href="http://plus.google.com/' . $google . '" target="_blank" data-toggle="tooltip" title="Google+">Google+</a>';
		}
		if ($linkedin) {
			$linksHtml .= '<a href="http://www.linkedin.com/' . $linkedin . '" target="_blank" data-toggle="tooltip" title="LinkedIn">LinkedIn</a>';
		}
		if ($pinterest) {
			$linksHtml .= '<a href="http://www.pinterest.com/' . $pinterest . '" target="_blank" data-toggle="tooltip" title="Pinterest">Pinterest</a>';
		}
		if ($dribbble) {
			$linksHtml .= '<a href="http://dribbble.com/' . $dribbble . '" target="_blank" data-toggle="tooltip" title="Dribbble">Dribbble</a>';
		}
		if ($flickr) {
			$linksHtml .= '<a href="http://www.flickr.com/photos/' . $flickr . '" target="_blank" data-toggle="tooltip" title="Flickr">Flickr</a>';
		}
		if ($tumblr) {
			$linksHtml .= '<a href="http://' . $tumblr . '.tumblr.com" target="_blank" data-toggle="tooltip" title="Tumblr">Tumblr</a>';
		}
		if ($instagram) {
			$linksHtml .= '<a href="http://instagram.com/' . $instagram . '" target="_blank" data-toggle="tooltip" title="Instagram">Instagram</a>';
		}
		if ($youtube) {
			$linksHtml .= '<a href="http://www.youtube.com/' . $youtube . '" target="_blank" data-toggle="tooltip" title="Youtube">Youtube</a>';
		}
		if ($vimeo) {
			$linksHtml .= '<a href="http://vimeo.com/' . $vimeo . '" target="_blank" data-toggle="tooltip" title="Vimeo">Vimeo</a>';
		}
		if ($phone) {
			$linksHtml .= '<a href="callto://+' . $phone . '" target="_blank" data-toggle="tooltip" title="'.$phonelabel.'">'.$phonelabel.'</a>';
		}
		if ($skype) {
			$linksHtml .= '<a href="skype:' . $skype . '?call" target="_blank" data-toggle="tooltip" title="Skype">Skype</a>';
		}
		if ($email) {
			$linksHtml .= '<a href="mailto:' . $email . '" target="_blank" data-toggle="tooltip" title="'.$emaillabel.'">'.$emaillabel.'</a>';
		}

		return do_shortcode('<div'.$this->buildContainerAttributes(array('class'=>array('person-box')),$atts).'>
			                    ' . $preLink . '<img src="' . $imgsrc . '" alt="">' . $postLink . '
			                    <h4>' . $header . '</h4>
			                    <h5>' . $subheader . '</h5>
			                    ' . $linksHtml . '
			                </div>');
	}



	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'imgsrc' => array('label' => __("source", 'ct_theme'), 'default' => '', 'type' => 'image', 'help' => __("Image", 'ct_theme')),
			'header' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header text", 'ct_theme')),
			'subheader' => array('label' => __('subheader', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Subheader text", 'ct_theme')),
			'link' => array('label' => __('link', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Link", 'ct_theme')),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea"),
			'fb' => array('label' => __("Facebook username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'twit' => array('label' => __("Twitter username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'dribbble' => array('label' => __("Dribbble username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'google' => array('label' => __("Google+ username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'linkedin' => array('label' => __("LinkedIn username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'pinterest' => array('label' => __("Pinterest username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'flickr' => array('label' => __("Flickr username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'tumblr' => array('label' => __("Tumblr username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'instagram' => array('label' => __("Instagram username", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'youtube' => array('label' => __("Youtube movie", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'vimeo' => array('label' => __("Vimeo movie", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'phone' => array('label' => __("Phone number to call by Skype", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'phonelabel' => array('label' => __("Phone tooltip label", 'ct_theme'), 'default' => __("Phone",'ct_theme'), 'type' => 'input'),
			'skype' => array('label' => __("Skype user", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'email' => array('label' => __("Email address", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'emaillabel' => array('label' => __("Email tooltip label", 'ct_theme'), 'default' => __("Email",'ct_theme'), 'type' => 'input'),
		);
	}
}

new ctPersonBoxShortcode();