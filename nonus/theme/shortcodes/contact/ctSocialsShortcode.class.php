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

		$headerHtml = $header ? '<h4>' . $header . '</h4>' : '';

		$linksHtml = '';
		if ($fb) {
			$linksHtml .= '<a href="http://www.facebook.com/' . $fb . '" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i>Facebook</a><br>';
		}
		if ($twit) {
			$linksHtml .= '<a href="http://www.twitter.com/' . $twit . '" target="_blank" rel="nofollow"><i class="fa fa-twitter"></i>Twitter</a><br>';
		}
		if ($google) {
			$linksHtml .= '<a href="http://plus.google.com/' . $google . '" target="_blank" rel="nofollow"><i class="fa fa-google-plus"></i>Google+</a><br>';
		}
		if ($linkedin) {
			$linksHtml .= '<a href="http://www.linkedin.com/' . $linkedin . '" target="_blank" rel="nofollow"><i class="fa fa-linkedin"></i>LinkedIn</a><br>';
		}
		if ($pinterest) {
			$linksHtml .= '<a href="http://www.pinterest.com/' . $pinterest . '" target="_blank" rel="nofollow"><i class="fa fa-pinterest"></i>Pinterest</a><br>';
		}
		if ($dribbble) {
			$linksHtml .= '<a href="http://dribbble.com/' . $dribbble . '" target="_blank" rel="nofollow"><i class="fa fa-dribbble"></i>Dribbble</a><br>';
		}
		if ($flickr) {
			$linksHtml .= '<a href="http://www.flickr.com/photos/' . $flickr . '" target="_blank" rel="nofollow"><i class="fa fa-flickr"></i>Flickr</a><br>';
		}
		if ($tumblr) {
			$linksHtml .= '<a href="http://' . $tumblr . '.tumblr.com" target="_blank" rel="nofollow"><i class="fa fa-tumblr"></i>Tumblr</a><br>';
		}
		if ($instagram) {
			$linksHtml .= '<a href="http://instagram.com/' . $instagram . '" target="_blank" rel="nofollow"><i class="fa fa-instagram"></i>Instagram</a><br>';
		}
		if ($youtube) {
			$linksHtml .= '<a href="http://www.youtube.com/' . $youtube . '" target="_blank" rel="nofollow"><i class="fa fa-youtube"></i>Youtube</a><br>';
		}
		if ($phone) {
			$linksHtml .= '<a href="callto://+' . $phone . '" target="_blank" rel="nofollow"><i class="fa fa-phone"></i>'.$phonelabel.'</a><br>';
		}
		if ($skype) {
			$linksHtml .= '<a href="skype:' . $skype . '?call" target="_blank" rel="nofollow"><i class="fa fa-skype"></i>Skype</a><br>';
		}
		if ($website) {
			$linksHtml .= '<a href="' . $website . '" target="_blank" rel="nofollow"><i class="fa fa-external-link"></i>' . $website . '</a><br>';
		}
		if ($email) {
			$linksHtml .= '<a href="mailto:' . $email . '" target="_blank" rel="nofollow"><i class="fa fa-envelope"></i>'.$emaillabel.'</a><br>';
		}
		if ($rss == 'yes') {
			$linksHtml .= '<a href="' . current_page_url() . '?feed=rss2" target="_blank" rel="nofollow"><i class="fa fa-rss"></i>RSS</a><br>';
		}


		return $headerHtml . '<div'.$this->buildContainerAttributes(array('class'=>array('social-widget','widget')),$atts).'>
								<p class="social">
	                                ' . $linksHtml . '
	                            </p>
	                         </div>';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'widgetmode' => array('default' => 'false', 'type' => false),
			'header' => array('label' => __("header text", 'ct_theme'), 'default' => '', 'type' => 'input'),
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
			'phone' => array('label' => __("Phone number to call by Skype", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'phonelabel' => array('label' => __("Phone tooltip label", 'ct_theme'), 'default' => __("Phone",'ct_theme'), 'type' => 'input'),
			'skype' => array('label' => __("Skype user", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'website' => array('label' => __("Website url - with http://", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'email' => array('label' => __("Email address", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'emaillabel' => array('label' => __("Email tooltip label", 'ct_theme'), 'default' => __("Email",'ct_theme'), 'type' => 'input'),
			'rss' => array('label' => __('Rss', 'ct_theme'), 'default' => 'no', 'type' => 'select', 'options' => array('no' => __('no', 'ct_theme'), 'yes' => __('yes', 'ct_theme')), 'help' => __("Show rss feed link?", 'ct_theme')),
		);
	}
}

new ctSocialsShortcode();