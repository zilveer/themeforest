<?php
/**
 * Shows filtered posts
 */
class ctPostsShortcode extends ctShortcodeQueryable {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Posts';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'posts';
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

		$posts = $this->getCollection($attributes);
		$html = '';
		$counter = 0;
		foreach ($posts as $p) {
			$counter++;
			$header = ($counter == 1) ? $header : '';
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
		return $this->getAttributesWithQuery(array(
			'header' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header text", 'ct_theme')),
		));
	}
}

new ctPostsShortcode();