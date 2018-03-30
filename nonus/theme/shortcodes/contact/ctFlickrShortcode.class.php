<?php
/**
 * Flickr shortcode
 */
class ctFlickrShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Flickr';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'flickr';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		$headerHtml = $header ? ($widgetmode == 'true' ? ('<h3>' . $header . '</h3>') : ('<h3 class="std">' . $header . '</h3>')) : '';

		$html = '';
		$src = $user ? ('user&amp;user=' . $user) : ($group ? ('group&amp;group=' . $group) : ($set ? ('user_set&amp;set=' . $set) : ''));

		if ($src) {
			$html .= '<div'.$this->buildContainerAttributes(array('class'=>array('flickr_badge')),$atts).'>
						<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=' . $num . '&amp;display=' . $order . '&amp;size='.$size.'&amp;layout=x&amp;source=' . $src . '"></script>
					</div>';
		}
		return $headerHtml . $html;
	}


	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'widgetmode' => array('default' => 'false', 'type' => false),
			'header' => array('label' => __("header text", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'user' => array('label' => __("user ID", 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __('Pulling from a Flickr user. You can find ID <a target="_blank" href="http://idgettr.com/">' . __('here', 'ct_theme') . '</a>', 'ct_theme')),
			'group' => array('label' => __("group ID", 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __('Pulling from a Flickr group. You can find ID <a target="_blank" href="http://idgettr.com/">' . __('here', 'ct_theme') . '</a>', 'ct_theme')),
			'set' => array('label' => __("set ID", 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Pulling from a Flickr user's set. You can find ID <a target=\"_blank\" href=\"http://idgettr.com/\">" . __('here', 'ct_theme') . '</a>', 'ct_theme')),
			'num' => array('label' => __("number of images", 'ct_theme'), 'default' => '6', 'type' => 'input'),
			'order' => array('label' => __('order', 'ct_theme'), 'default' => 'latest', 'type' => 'select', 'choices' => array('latest' => __('latest', 'ct_theme'), 'random' => __('random', 'ct_theme')), 'help' => __("Order type", 'ct_theme')),
			'size' => array('label' => __('size', 'ct_theme'), 'default' => 's', 'type' => 'select', 'choices' => array('s' => __('small square box', 'ct_theme'), 't' => __('thumbnail', 'ct_theme'),'m'=>__('medium','ct_theme')), 'help' => __("Size", 'ct_theme')),
		);
	}
}

new ctFlickrShortcode();