<?php
/**
 * Draws Work
 */
class ctWorkShortcode extends ctShortcodeQueryable implements ICtShortcodeSingleQueryable {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Work';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'work';
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

		if ($summary == '' && $link == '' && $imgsrc == '' && $title == '') {
			if ($post = $this->getSingle($attributes, array('post_type' => 'portfolio'))) {
				$title = $post->post_title;
				$summary = $post->post_excerpt;
				$imgsrc = ct_get_feature_image_src($post->ID, 'thumbnail');
				$link = get_permalink($post);
				$categories = ct_get_categories_string($post->ID, ',', 'portfolio_category');
			}
		}

		$catsHtml = '';
		$catsArray = array();
		if ($categories) {
			$catsArray = explode(',', $categories);
		}
		foreach ($catsArray as $cat) {
			$catsHtml .= ('<span class="btn">' . strtoupper($cat) . '</span>');
		}

		$html = '<div class="doCenter portfolioItem">
	                <a href="' . $link . '" class="thumbnail" >
	                    <span class="circleFrame doCenter" style="background: url(' . $imgsrc . ') no-repeat top center;">
                            [img src="' . $imgsrc . '" alt="" width="180" height="180"]
                        </span>
	                </a>
                    <h3><a href="' . $link . '" class="vmedium vorange">' . $title . '</a></h3>' . $catsHtml . '<p class="summary">' . $summary . '</p>
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
		$atts = $this->getAttributesWithQuery(array(
			'id' => array('label' => __('id', 'ct_theme'), 'default' => '', 'type' => 'input'),
			'link' => array('label' => __('link', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("ex. http://www.google.com", 'ct_theme')),
			'imgsrc' => array('label' => "image", 'default' => '', 'type' => 'image', 'help' => __("ex. http://www.google.com", 'ct_theme')),
			'title' => array('label' => __('title', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Header text", 'ct_theme')),
			'categories' => array('label' => __("categories", 'ct_theme'), 'default' => '', 'type' => 'textarea', 'help' => __("Categories names separated by commas", 'ct_theme')),
			'summary' => array('label' => __("summary", 'ct_theme'), 'default' => '', 'type' => 'textarea'),
		));

		if (isset($atts['cat'])) {
			unset($atts['cat']);
		}
		return $atts;
	}
}

new ctWorkShortcode();