<?php
/**
 * Most recent posts
 */
class ctRecentPostShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Most recent post';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'recent_post';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));


		$get_posts = new WP_Query;
		$posts = $get_posts->query(array('showposts' => $limit));
		$html = '';
		$counter = 0;
		foreach ($posts as $p) {
			$counter++;
			$header = ($counter==1) ? $header : '';
			$month = get_the_time('M', $p);
			$day = get_the_time('d', $p);
			$link = get_permalink($p);
			$title = $p->post_title;
			$summary = $p->post_excerpt;
			$html .= $this->embedShortcode('post', array(
									'summary' => $summary,
									'month' => $month,
									'day' => $day,
									'title' => $title,
									'link' => $link,
									'header' => $header,
								));
		}

		return do_shortcode($html);
	}

	/**
	 * Shortcode type
	 * @return string
	 */
	public function getShortcodeType() {
		return self::TYPE_SHORTCODE_SELF_CLOSING;
	}


	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'header' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header text", 'ct_theme')),
			'limit' => array('label' => __('limit', 'ct_theme'), 'default' => 1, 'type' => 'input'),
		);
	}
}

new ctRecentPostShortcode();