<?php
/**
 * Shows single post
 */
class ctPostShortcode extends ctShortcodeQueryable implements ICtShortcodeSingleQueryable {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Post';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'post';
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

		$headerHtml = '';
		if ($header) {
			$headerHtml = '[header line="crossLine" strong="yes"]' . $header . '[/header]';
		}

		if($date){
			$month = date('M', strtotime($date));
			$day = date('d', strtotime($date));
		}

		//all user fields are empty - let's try to find something...
		if ($date == '' && $link == '' && $title == '' && $summary == '') {

			if ($post = $this->getSingle($attributes)) {
				$link = get_permalink($post);
				$title = $post->post_title;
				$summary = $post->post_excerpt;

				$month = get_the_time('M', $post);
				$day = get_the_time('d', $post);
			}
		}


		$html = '<div class="rightPadd20">' . $headerHtml . '
					<div class="row-fluid">
						<div class="span1">
							<span class="date">' . strtoupper($month) . ' <em>' . $day . '</em></span>
						</div>
						<div class="span11 leftPadd10">
							<h3><a href="' . $link . '" class="vmedium vorange">' . $title . '</a></h3>

							<p>' . $summary . '</p>
						</div>
					</div>
				</div>';

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
		return $this->getAttributesWithQuery(
			array(
				'id' => array('default' => '', 'type' => 'posts_select', 'label' => __("Post", 'ct_theme')),
				'header' => array('label' => __('header', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header text", 'ct_theme')),
				'date' => array('label' => __('date', 'ct_theme'), 'default' => '', 'type' => 'input'),
				'title' => array('label' => __('title', 'ct_theme'), 'default' => '', 'type' => 'input'),
				'summary' => array('label' => __('summary', 'ct_theme'), 'default' => '', 'type' => 'input'),
				'link' => array('label' => __('link', 'ct_theme'), 'default' => '', 'type' => 'input'),
				'month' => array('type' => false),
				'day' => array('type' => false),
			));
	}
}

new ctPostShortcode();